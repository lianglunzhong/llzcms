<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['role', 'user_id'];


    /**
     * 获取对应的用户
     */
    public function user() {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
