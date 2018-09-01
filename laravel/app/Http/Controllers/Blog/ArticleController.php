<?php

namespace App\Http\Controllers\Blog;

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
    }

    public function catalogView()
    {
    	$view = view('blog.article.list');
    	$listData = Article::orderBy('created_at','desc')->get();
    	$shownum = 10;
    	$pagenum = $listData->count() / $shownum;
    	$view->with('list',$listData);
    	$view->with('pagenum',ceil($pagenum));
    	return $view;
    }

    public function articleView($id)
    {
        $view = view('blog.article.detail');
        $data = Article::where('id',$id)->first();
        $view->with('article_info',$data);
        $url = $data->content;
        $url = str_replace('/storage', '', $url);
        $content = Storage::disk('public')->get($url);
        $view->with('article_content',$content);
        return $view;
    }
}