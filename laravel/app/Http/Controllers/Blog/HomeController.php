<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Razy\Signature\Facade\Signature;

class HomeController extends Controller
{

	public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function mainView()
    {
    	return view('blog.home');
    }

}