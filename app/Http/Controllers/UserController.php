<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //除了这些动作，其他动作都使用auth过滤
        $this->middleware('auth',[
            'except' => ['index','show','create','store']
        ]);

        //未登录用户只能访问create页面
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(6);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
        //这里 update 是指授权类里的 update 授权方法
        //当前登录用户id如果和要修改的id不相等，跳403错误
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(User $user,Request $request){
        //这里 update 是指授权类里的 update 授权方法
        //当前登录用户id如果和要修改的id不相等，跳403错误
        $this->authorize('update', $user);
        $this->validate($request,[
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'//nullable可以为空
        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user->id);
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
        Auth::login($user);
        session()->flash('success', '注册成功~!');
        return redirect()->route('users.show',[$user]);//route() 方法会自动获取 Model 的主键 等同于[$user->id]
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
