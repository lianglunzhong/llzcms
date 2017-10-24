<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.可以被批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * 获取用户关联的角色
     */
    public function userRole() {
        return $this->hasOne('App\UserRoles', 'user_id', 'id');
    }
}
