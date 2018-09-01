<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Article as Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

	public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest:user');
    }

    public function addView()
    {
    	$user = Auth::user('user');
    	$view = view('admin.article.add')->with('user',$user);
    	return $view;
    }

    public function listView()
    {
    	$user = Auth::user('user');
    	$view = view('admin.article.list')->with('user',$user);
    	$listData = Article::where('author',$user['name'])->orderBy('created_at','desc')->get();
    	$shownum = 12;
    	$pagenum = $listData->count() / $shownum;
    	$view->with('list',$listData);
    	$view->with('pagenum',ceil($pagenum));
    	return $view;
    }

    public function scanView($id)
    {
    	$user = Auth::user('user');
    	$view = view('admin.article.scan')->with('user',$user);
    	$collection = Article::where('id',$id)->first();
    	$view->with('scandata',$collection);
    	$url = $collection->content;
    	$url = str_replace('/storage', '', $url);
    	$contents = Storage::disk('public')->get($url);
    	$view->with('content',$contents);
    	return $view;
    }

    public function editView($id)
    {
    	$user = Auth::user('user');
    	$view = view('admin.article.edit')->with('user',$user);
    	$collection = Article::where('id',$id)->first();
    	$view->with('editdata',$collection);
    	$url = $collection->content;
    	$url = str_replace('/storage', '', $url);
    	$contents = Storage::disk('public')->get($url);
    	$view->with('content',$contents);
    	return $view;
    }

    public function localUpload(Request $request)
    {
    	$file = $request->file('image');
        $tempPath = $_FILES["image"]['tmp_name'];
        $fileSize = $_FILES["image"]['size'];
        $fileStr = $file->getClientOriginalName();
        $extension = $file->guessExtension();
        $prefix = 'img_';
        $fileName = $prefix.substr(md5($fileStr.time()),10,12).'.'.$extension;
        $disk = Storage::disk('qiniu');
        $outLink = $disk->getAdapter()->getUrl($fileName);
        $config = 
        [
            'asFile'    => true,
            'policy'    => null,
            'expires'   => 3600*24,
            'params'    => null,
            'mime'      => 'application/octet-stream'
        ];
        $response = $disk->put($fileName, $tempPath, $config); 
        $jsonArray = 
        [
        	'response'	=> $response,
        	'type'		=> 'image',
        	'filename'	=> $fileName,
        	'outlink'	=> $outLink
        ];
        echo json_encode($jsonArray);
    }

    public function storeArticle(Request $request){
    	$user = Auth::user('user');
    	$input = $request->input();
    	$bannerName = "banner_".date("Ymd",time())."_".rand(1000,9999).'.png';
    	$bannerUrl = '/storage/'.$request->file('banner')->storeAs('banner',$bannerName,'public');
    	$prefix = 'html_';
    	$extension = 'txt';
        $fileName = 'draft/'.$prefix.substr(md5($input['title'].time()),10,12).'.'.$extension;
        Storage::disk('public')->put($fileName,$input['article']);
        $localUrl = Storage::url($fileName);
        $table = Article::create([
        	'title'		=>	$input['title'],
        	'abstract'	=>	$input['abstract'],
        	'banner'	=>	$bannerUrl,
        	'author'	=>	$user['name'],
        	'content'	=>	$localUrl
        ]);

    	return view('admin.redirect',[
    		'title'			=>	'操作成功',	
    		'redirecturl'	=>	route('list'),
    		'imgurl'		=>	'/img/front/success.png',
    		'info'			=>	'添加成功'
    	]);
    }

    public function updateArticle(Request $request){
    	$user = Auth::user('user');
    	$input = $request->input();
    	$origin = Article::where('id',$input['id'])->first();
    	if ($user['name'] != $origin->author) {
    		return view('admin.redirect',[
	    		'title'			=>	'操作失败',	
	    		'redirecturl'	=>	route('list'),
	    		'imgurl'		=>	'/img/front/failure.png',
	    		'info'			=>	'没有修改权限'
	    	]);
    	}
    	$disk = Storage::disk('public');
    	$data = 
    		[
    			'title' 	=> $input['title'],
    			'abstract'	=> $input['abstract']
    		];
    	if (is_null($request->file('banner'))) {
    		//echo "banner is not modified";
    	}else{
    		$image_url = $origin->banner;
	    	$image = str_replace('/storage', '', $image_url);

	    	if ($disk->exists($image)) {
	    		$disk->delete($image);
	    	}else{
	    		echo "file is not existed";
	    	}

	    	$image_name = str_replace('/banner/', '', $image);
	    	$request->file('banner')->storeAs('banner',$image_name,'public');
    	}

    	$url = $origin->content;
    	$file = str_replace('/storage', '', $url);
    	$contents = $disk->get($file);

    	if ($contents != $input['article']) {
    		$disk->delete($file);
    		$disk->put($file,$input['article']);
    	}else{
    		//echo "content is not modified";
    	}

    	Article::where('id',$input['id'])->update($data);

    	return view('admin.redirect',[
    		'title'			=>	'操作成功',	
    		'redirecturl'	=>	route('list'),
    		'imgurl'		=>	'/img/front/success.png',
    		'info'			=>	'修改成功'
    	]);
    }

    public function deleteArticle($id){
    	$user = Auth::user('user');
    	$origin = Article::where('id',$id)->first();
    	$disk = Storage::disk('public');
    	if ($user['name'] != $origin->author) {
    		return view('admin.redirect',[
	    		'title'			=>	'操作失败',	
	    		'redirecturl'	=>	route('list'),
	    		'imgurl'		=>	'/img/front/failure.png',
	    		'info'			=>	'没有删除权限'
	    	]);
    	}else{
    		$image_url = $origin->banner;
	    	$image = str_replace('/storage', '', $image_url);
	    	$url = $origin->content;
    		$file = str_replace('/storage', '', $url);

	    	if ($disk->exists($image)) {
	    		$disk->delete($image);
	    	}

	    	if ($disk->exists($file)) {
	    		$disk->delete($file);
	    	}

	    	Article::where('id',$id)->delete();

	    	return view('admin.redirect',[
	    		'title'			=>	'操作成功',	
	    		'redirecturl'	=>	route('list'),
	    		'imgurl'		=>	'/img/front/success.png',
	    		'info'			=>	'删除成功'
	    	]);
    	}
    }

}