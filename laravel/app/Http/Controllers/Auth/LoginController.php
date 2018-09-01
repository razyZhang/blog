<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Model\User as User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    protected function guard()
    {
        return Auth::guard('user');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        if (Auth::check()) {
            $this->logout();
        }
    }

    public function login($data = [])
    {
        if (Auth::user()) {
            return redirect()->route('home');
        }
        $warning = '';
        $hidden = "style = display:none";
        if ($data) {
            $warning = $data['info'];
            $hidden = '';
        }

        return view('admin.login',[
            'title' => '后台登录',
            'login' => url("/login/auth"),
            'regist' => url("/regist"),
            'check' => url("/login/valid"),
            'getkey' => url("/key"),
            'warning' => $warning, 
            'hidden' => $hidden
        ]);
    }

    public function authenticate(Request $request)
    {
        $post = $request->input();
        $remember = $post['remember'] > 0 ? true:false;
        if (Auth::guard('user')->attempt(['name' => $post['user'], 'password' => $post['password']], $remember)) {
            $user = Auth::user();
            $data = [
                'status' => 200,
                'info' => '登录成功',
                'user' => [
                    'name' => $user['name'],
                    'avatar' => $user['avatar'],
                    'id' => Session::getId(),
                ]
            ];

            return redirect()->route('home');
        } else {
            $data = [
                'status' => 403,
                'info' => 'password is wrong',
            ];
            return $this->login($data);
        }
        // $json = json_encode($data);
        // return response()->json($data);
    }

    public function check()
    {
        if (Auth::check()) {
            return ['auth' => 'Authenticated'];
        }
        return ['auth' => 'Unauthenticated'];
    }

    public function logout()
    {
        Auth::logout();
        $data = [
            'status' => 200,
            'info' => '退出成功',
        ];
        return redirect()->route('login');
    }

    public function testview(){
        return view('test',[
            'title' => '测试',
            'url' => url("/test")
        ]);
    }

    public function test(Request $request)
    {
        // $file = $request->file('file');
        // $tempPath = $_FILES["file"]['tmp_name'];
        // $fileSize = $_FILES["file"]['size'];
        // $fileStr = $file->getClientOriginalName();
        // $extension = $file->guessExtension();
        // $prefix = 'img_';
        // $fileName = $prefix.substr(md5($fileStr.time()),10,12).'.'.$extension;
        // $disk = Storage::disk('qiniu');
        // $outLink = $disk->getAdapter()->getUrl($fileName);
        // $config = 
        // [
        //     'asFile'    => true,
        //     'policy'    => null,
        //     'expires'   => 3600*24,
        //     'params'    => null,
        //     'mime'      => 'application/octet-stream'
        // ];
        // $response = $disk->put($fileName, $tempPath, $config); 
        // $jsonArray = 
        // [
        //     'response'  => $response,
        //     'type'      => 'image',
        //     'filename'  => $fileName,
        //     'outlink'   => $outLink
        // ];
        // echo json_encode($jsonArray);
    }

}
