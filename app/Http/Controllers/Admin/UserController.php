<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * 检查用户名是否已存在
     * @return 
     * @author llz 2017/10/19
     */
    public function nameExistCheck(Request $request)
    {
    	$name = $request->get('name', null);

    	if($name)
    	{
    		$user = User::where('name', $name)->first();
    		if($user)
    		{
    			return response()->json(['msg' => 'name has already been taken.']);
    		}
    	}
    	
    	return response()->json(['msg' => 'name is not exists.'], 422);
    }


    /**
     * 检查email是否已存在
     * @return 
     * @author llz 2017/10/19
     */
    public function emailExistCheck(Request $request)
    {
    	$email = $request->get('email', null);

    	if($email)
    	{
    		$user = User::where('email', $email)->first();
    		if($user)
    		{
    			return response()->json(['msg' => 'email has already been taken.']);
    		}
    	}
    	
    	return response()->json(['msg' => 'email is not exists.'], 422);
    }
}
