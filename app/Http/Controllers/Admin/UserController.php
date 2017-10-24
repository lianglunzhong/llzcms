<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserRoles;

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


    /**
     * 新增用户
     * @return [type] [<description>]
     * @author llz 2017/10/24 <[<email address>]>
     */
    public function create(Request $request)
    {
        //数据验证
        $this->validate($request, [
            'name'      => 'required|min:2|max:16|unique:users',
            'email'     => 'required|email|max:255|unique:users',
        ]);

        $data = $request->all();

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = password_hash('111111', PASSWORD_BCRYPT);
        //验证密码时使用：password_verify($password, $hashedValue)

        if($user->save())
        {   
            $role = isset($data['role']) ? $data['role'] : 1;
            $user->userRole()->save(new UserRoles(['role' => $role]));
            
            return response()->json(['msg' => 'User successfully Created']);
        } 

        return response()->json(['msg' => 'Create user failed'], 422);
    }
}
