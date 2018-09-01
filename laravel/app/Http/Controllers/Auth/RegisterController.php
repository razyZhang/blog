<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Razy\Signature\Facade\Signature;
use App\Model\User as User;
use App\Model\Sign as Sign;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user' => 'required|string|alpha_dash|max:20|notexist:backend_users,name',
            'mail' => 'required|string|email|max:255|notexist:backend_users,email',
            'password' => 'required|string|alpha_dash|min:4|max:20|same:retype',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $info = array(
            'commonName'  => $data['user'],
            'emailAddress' => $data['mail'],
        );

        $signer = Signature::signer('rsa')->createKey($info);

        if ($signer) {
            $pub_path = 'signature/'.substr(md5($data['password']),0,12).'.pem';
            $pri_path = 'signature/'.substr(md5($data['password']),16,12).'.pem';
            Storage::disk('private')->put($pub_path,$signer['public']);
            Storage::disk('private')->put($pri_path,$signer['private']);

            Sign::create([
                'name'  =>  $data['user'],
                'rsa_private_key' => $pri_path,
                'rsa_public_key'  => $pub_path,
                'hash_key'  =>  $data['password']
            ]);
        }

        return User::create([
            'name' => $data['user'],
            'email' => $data['mail'],
            'password' => bcrypt($data['password']),
            'invitor' => $data['invitor'],
            'avatar' => $data['avatar']
        ]);
    }

    protected function store_avatar($data)
    {
        $avatarName = "avatar_".date("Ymd",time())."_".rand(1000,9999).'.png';
        if (strstr($data,",")){
            $data = explode(',',$data);
            $data = $data[1];
        }
        $src = 'avatar/'.$avatarName;
        Storage::disk('public')->put($src,base64_decode($data));
        $url = Storage::url($src);
        return $url;
    }

    public function getPublicKey(Request $request)
    {
        $host = $request->input('host');
        $origin =  $request->input('origin');
        $sign = Sign::where('name',$host)->first();
        $pub_key = Storage::disk('private')->get($sign->rsa_public_key);
        $pri_key = Storage::disk('private')->get($sign->rsa_private_key);
        $signer = Signature::signer('rsa')->setPrivateKey($pri_key)->setPublicKey($pub_key)->setAlgo('sha1')->sign($origin);
        echo($signer);
    }

}