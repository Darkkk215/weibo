<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        //attempt根据给定的数组去指定数据库中查找，正确后会自动开启一个会话
        //check() 验证是否登录
        //logout()退出登录
        //login($user) 登录
        if(Auth::attempt($credentials,$request->has('remember'))){//Auth是laravel自带的认证工具 config/auth.php里配置
            session()->flash('success', '欢迎回来！');
           return redirect()->route('users.show', [Auth::user()]);
        }else{
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(){
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect()->route('login');
    }
}
