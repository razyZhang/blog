<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Persimmon\Interfaces\CreatorInterface;
use App\Http\Controllers\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Razy\Signature\Facade\Signature;
use App\Model\User as User;
use App\Model\Invite as Invite;

class HomeController extends Controller
{

	public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest:user');
    }

    public function welcome()
    {
        $user = Auth::user('user');
        $weather = session('weather');
        if (!is_array($weather)) {
            $weather = $this->getAddress(); 
            session('weather',$weather);
        }

        return view('admin.welcome',[
            'user'      => $user,
            'weather'   => $weather,
            'date'      => $this->getDate()
        ]);
    }

    public function getAddress()
    {
        $data = getweather();
        $weather = [
            'temp' => $data['temp'],
            'weather' => $data['weather'],
            'wind' => $data['wind'],
            'wet' => $data['wet'],
            'address' => $data['address']
        ];
        return $weather;
    }

    public function getDate(){
        $json = getcurl("http://www.sojson.com/open/api/lunar/json.shtml");
        $data = json_decode($json);
        if ($data->status == 200) {
            $data = $data->data;
            $result['date'] = $data->hyear.'年'.$data->cnmonth.'月'.$data->cnday.'日';
            $result['jq'] = [];
            foreach ($data->jieqi as $key => $value) {
                array_push($result['jq'],$value.'('.$key.')');
            }
        }else{
            $result = false;
        }

        $date['y'] = date("Y");
        $date['m'] = date("M");
        $date['d'] = date("d");
        $date['q'] = date("D");
        $date['t'] = date("H:i");
        $date['a'] = date("a");
        $date['cn'] = $result;
        return $date;
    }

    public function setUserInfo(Request $request)
    {
        $user = Auth::user('user');
        $validator = Validator::make($request->all(),[
            'nickname'  => 'nullable|string|max:30',
            'email'     => 'required|string|email|max:255',
            'intro'     => 'nullable|string|max:100',
            'avatar'    => 'nullable|image|max:1048576',
            'label'     => 'nullable|string|max:100',
            'experience'=> 'nullable|string|max:200',
        ]);

        if($validator->passes()){
            $image = $request->file('avatar');
            $data = $request->input();
            array_shift($data);

            if (!is_null($image)) {
                $src = User::find($user->id)->first()->avatar;
                $src = str_replace('/storage/','',$src);
                $disk =  Storage::disk('public');
                if ($disk->exists($src)) {
                    $disk->delete($src);
                }
                $src = str_replace('avatar/','',$src);
                $disk->putFileAs('avatar',$image,$src);
            }

            foreach ($data as $key => $value) {
                if (!is_null($value)) {
                    User::where('id',$user->id)->update([$key => $value]);
                }
            }

            $redirect = [
                'title'         =>  '操作成功', 
                'redirecturl'   =>  route('home'),
                'imgurl'        =>  '/img/front/success.png',
                'info'          =>  '修改成功'
            ];

        }else{
            $redirect = [
                'title'         =>  '操作失败', 
                'redirecturl'   =>  route('userinfo'),
                'imgurl'        =>  '/img/front/failure.png',
                'info'          =>  '内容过长或图片大于1MB'
            ];
        }

        return view('admin.redirect',$redirect);
    }

    public function settingView()
    {
        $user = Auth::user('user');
        $view = view('admin.user.setting')->with('user',$user);

        $invite_code = Invite::where('host',$user->name)->first();
        if (is_null($invite_code)) {
            $origin = base64_encode($user->name."||".md5(substr($user->password,rand(0,20),rand(1,39))));
            Invite::create([
                'host'  =>  $user->name,
                'code'  =>  $origin,
            ]);

        }else{
            $origin = $invite_code->code;
        }

        $view->with('code',$origin);

        return $view;
    }

    public function resetPass(Request $request){
        $user = Auth::user('user');
        $data = $request->input();
        $validator = Validator::make($data,[
            'originPass'    =>  'required|string|alpha_dash|min:4|max:20',
            'newPass'       =>  'required|string|alpha_dash|min:4|max:20'
        ]);
        $auth = Auth::guard('user')->attempt(['name' => $user['name'], 'password' => $data['originPass']]);
        if ($auth&&$validator->passes()) {
            User::where('id',$user->id)->update(['password' => bcrypt($data['newPass'])]);
            return view('admin.redirect',['title' => '操作成功','imgurl' => url('img/front/success.png'),'info' => '修改成功,即将跳回登录界面','redirecturl' => route('logout')]);
        }else{
            return view('admin.redirect',['title' => '操作失败','imgurl' => url('img/front/failure.png'),
                    'info' => '填写信息有误','redirecturl' => route('reset')]);
        }
    }

    public function userView(){
        $user = Auth::user('user');
        $view = view('admin.user.userinfo')->with('user',$user);
        return $view;
    }

    public function passView(){
        $user = Auth::user('user');
        $view = view('admin.user.pass')->with('user',$user);
        return $view;
    }

}

