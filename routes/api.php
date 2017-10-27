<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group(['prifix' => 'api'], function() {
	Route::get('/test', function() {
		return "<h1 style='text-align: center; margin-top: 4em;'>Api test</h1>";;
	});

	Route::group(['prefix' => 'user'], function() {
		//新增用户
		Route::post('/create', 'Admin\UserController@create');
		//获取用户列表
		Route::post('/getUsers', 'Admin\UserController@getUsers');
		//获取单个用户
		Route::post('/getUser', 'Admin\UserController@getUser');
		//编辑用户
		Route::post('/edit', 'Admin\UserController@edit');
	});
});