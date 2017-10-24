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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


/*
 *后台路由
 */
Route::group(['prefix' => 'admin'], function() {
	//登录页面
	Route::get('/login', ['uses' => 'Admin\LoginController@index']);
	//用户登录
	Route::post('/login', ['uses' => 'Admin\LoginController@login']);
	//注册页面
	Route::get('/register', 'Admin\LoginController@showRegister');
	//用户注册
	Route::post('/register', 'Admin\LoginController@register');

	Route::group(['prefix' => 'user'], function() {
		//检查用户名是否已存在
		Route::post('/name-exist-check', 'Admin\UserController@nameExistCheck');
		//检查email是否已存在
		Route::post('/email-exist-check', 'Admin\UserController@emailExistCheck');
	});

	Route::group(['middleware' => 'role:1'], function() {
		//退出登录
		Route::get('/logout', 'Admin\LoginController@logout');
		
		//匹配angularjs中的路由
		Route::get('/views/{name}', function($name) {
			return view($name);
		});

		//angular中的路由去掉#号之后，会被当做服务器的路由，
		//此处定义当在服务器端匹配不到时候的跳转
		Route::get('{path?}', function() {
			return view('admin.layouts.master');
		})->where('path', ".+");
	});

});