<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::namespace('Auth')->group(function () {
	Route::get('/login', 'LoginController@login')->name('login');
	Route::get('/logout', 'LoginController@logout')->name('logout');
	Route::get('/testview','LoginController@testview');
	Route::post('/test','LoginController@test');
	Route::post('/login/auth', 'LoginController@authenticate');
	Route::post('/regist', 'RegisterController@register');
	Route::post('/key','RegisterController@getPublicKey');
});

Route::namespace('Blog')->name('blog.')->group(function () {
	Route::get('/', 'HomeController@mainView')->name('home');
	Route::get('/blog/catalog', 'ArticleController@catalogView')->name('catalog');
	Route::get('/blog/article/{id}', 'ArticleController@articleView');
	Route::get('/blog/about', 'AboutController@mainView')->name('about');
});

Route::namespace('Content')->group(function () {
	Route::get('/setting', 'HomeController@settingView')->name('setting');
	Route::get('/userinfo', 'HomeController@userView')->name('userinfo');
	Route::get('/reset', 'HomeController@passView')->name('reset');
	Route::get('/home', 'HomeController@welcome')->name('home');
	Route::get('/add_article','ArticleController@addView')->name('write');
	Route::get('/list_article','ArticleController@listView')->name('list');
	Route::get('/scan_article/{id}','ArticleController@scanView');
	Route::get('/edit_article/{id}','ArticleController@editView');
	Route::get('/delete_article/{id}','ArticleController@deleteArticle')->name('delete');
	Route::post('/setinfo', 'HomeController@setUserInfo')->name('setinfo');
	Route::post('/setpass', 'HomeController@resetPass')->name('setpass');
	Route::post('/upload_article','ArticleController@localUpload')->name('upload');
	Route::post('/store_article','ArticleController@storeArticle')->name('store');
	Route::post('/update_article','ArticleController@updateArticle')->name('edit');
});

Route::post('/login/valid', function(){})->middleware('auto.valid');

