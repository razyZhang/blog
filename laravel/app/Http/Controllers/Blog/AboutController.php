<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User as User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
	public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function mainView()
    {
    	$view = view('blog.about.main');
    	$users = User::orderBy('id')->take(2)->get();
    	$index = 0;
    	foreach ($users as $user) {
    		$data[$index] = $user;
    		$index++;
    	}
    	$view->with('about_members',$data);
    	return $view;
    }
}