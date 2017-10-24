<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\UserRoles;

class LoginController extends Controller
{
    /**
     * 登录页面展示
     *
     * @return Response
     */
    public function index()
    {

    	if(Auth::check() && Auth::user()->UserRole->role >= 1)
    	{
    		return redirect('/admin/dashboard');
    	}

    	return View('admin.login.index');
    }


    /**
     * 登录页面展示
     *
     * @return Response
     * @author llz 2017/10/20 <[<email address>]>
     */
    public function login(Request $request)
    {
        //数据验证
        $this->validate($request, [
            'email'     => 'required|email',
            'password' => 'required|min:6|max:24',
        ]);

        $data = $request->all();
        $email = isset($data['email']) ? $data['email'] : null;
        $password = isset($data['password']) ? $data['password'] : null;
        $remember = isset($data['remember']) ? $data['remember'] : null;

        if(Auth::attempt(['email' => $email, 'password' => $password], $remember))
        {
            if(Auth::user()->UserRole->role > 1)
            {
                return response()->json(['msg' => 'welcome']);
            }

            return response()->json(['The email or password you entered is not correct 2'], 422);
        }

        return response()->json(['The email or password you entered is not correct 1 '], 422);
    }

    /**
     * 注册页面展示
     */
    public function showRegister()
    {
    	return View('admin.login.register');
    }

    /**
     * 用户注册
     * @return  array() 
     * @author llz 2017/10/19 <[<email address>]>
     */
    public function register(Request $request)
    {	
        $result = array();

    	//数据验证
    	$this->validate($request, [
    		'name'		=> 'required|min:2|max:16|unique:users',
            'email'     => 'required|email|max:255|unique:users',
    		'password' => 'required|min:6|max:24|confirmed',
    	]);

        $data = $request->all();

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        // $user->password = bcrypt($data['password']);
        $user->password = password_hash($data['password'], PASSWORD_BCRYPT);
        //验证密码时使用：password_verify($password, $hashedValue)

        if($user->save())
        {   
            //用户角色
            $user->userRole()->save(new UserRoles(['role' => 1]));

            //注册时记住登录信息
            Auth::guard()->login($user);
            return response()->json(['msg' => 'success']);
        }

        return response()->json(['msg' => 'fail'], 422);
    }


    /**
     * 退出登录
     * @return [type] [<description>]
     * @author llz 2017/10/23 <[<email address>]>
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
