<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
<<<<<<< HEAD
        session()->flash('success', '注册成功~');
=======

        Auth::login($user);
        session()->flash('success', '注册成功~!');
>>>>>>> 7827954 (登录时记住我2)
        return redirect()->route('users.show',[$user]);//route() 方法会自动获取 Model 的主键 等同于[$user->id]
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
