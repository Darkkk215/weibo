<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://cravatar.cn/avatar/$hash?s=$size";
    }

    //boot 方法会在用户模型类完成初始化之后进行加载
    public static function boot()
    {
        parent::boot();
        //creating 用于监听模型被创建之前的事件
        //created 用于监听模型被创建之后的事件
        static::creating(function ($user) {
            $user->activation_token = Str::random(10);
        });
    }

    public function feed()
    {
        //return $this->statuses()->orderBy('created_at', 'desc');
        /*
            $user->followings 与 $user->followings()返回的内容不一样
            $user->followings  返回 模型集合
            $user->followings()返回 请求构造器
            正确使用方法 $user->followings()->get() 或者 $user->followings()->paginate()才会返回模型
        */
        $user_ids = $this->followings->pluck('id')->toArray();
        array_push($user_ids, $this->id);
        return Status::whereIn('user_id', $user_ids)->with('user')->orderBy('created_at', 'desc');
    }

    public function follow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    public function unfollow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
    public function followers()
    {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
}
