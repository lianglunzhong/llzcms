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


    /**
     * 获取用户列表  -- 带分页和搜索
     * @return [type] [<description>]
     * @author llz 2017/10/25 <[<email address>]>
     */
    public function getUsers(Request $request)
    {   
        $data = $request->all();
        if(isset($data['keyword']))
        {
            $users = User::where('name', 'like', '%' . $data['keyword'] . '%')
                            ->orWhere('email', 'like', '%' . $data['keyword'] . '%')
                            ->orderBy('users.created_at', 'desc')->paginate(5);
        } else {
            $users = User::with('userRole')->orderBy('users.created_at', 'desc')->paginate(5);
        }

        return $users;
    }


    /**
     * 获取单个用户
     * @return array [<description>]
     * @author llz 2017/10/26 <[<email address>]>
     */
    public function getUser(Request $request)
    {
        $id = $request->get('id', null);
        return User::with('userRole')->find($id);
    }
    

    /**
     * 编辑用户
     * @author [name] <[<email address>]>
     * @author llz 2017/10/26 <[<email address>]>
     */
    public function edit(Request $request)
    {
        $id = $request->get('id', null);

        $this->validate($request, [
            'name'      => 'required|min:2|max:16|unique:users,name,' . $id,
            'email'     => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        $data = $request->all();

        $user = User::find($id);

        if(isset($data['reset']))
        {
            $this->validate($request, [
                'password' => 'required|min:6|max:24|',
            ]);

            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

       if($user->update($data))
       {
            $user->userRole->update(['role' => $data['user_role']['role']]);

            return response()->json(['msg' => 'update successfully']);
       }

        return response()->json(['msg' => 'update user info fail'], 422);
    }


    /**
     * 删除用户
     * @author llz 2017/10/27 <[<email address>]>
     */
    public function delete(Request $request)
    {
        $id = $request->get('id', null);

        User::destroy($id);

        return response()->json(['msg' => 'delete user successfully']);
    }
}
