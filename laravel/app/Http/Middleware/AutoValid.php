<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class AutoValid //自动验证s类
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    public function user_exist(array $data){//检测用户名是否存在
        return Validator::make($data, ['user' => 'required|exists:backend_users,name']);
    }

    public function handle($request, Closure $next)
    {
        $type = $request->input('type');

        switch ($type) {
            case 'exist':
                $result = ($this->user_exist($request->all())->passes()) ? "exist" : "not exist";
                break;
            
            default:
                # code...
                break;
        }

        echo($result);
        
        return $next($request);
    }
}
