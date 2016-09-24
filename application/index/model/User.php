<?php
namespace app\index\model;

use think\Model;

class User extends Model
{
    // 开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    // 定义自动完成的属性
    protected $insert = ['status' => 1];

    // 定义一对一关联
    public function profile()
    {
        return $this->hasOne('Profile');
    }

    // 定义一对多关联
    public function books()
    {
        return $this->hasMany('Book');
    }

    // 定义多对多关联
    public function roles()
    {
        // 用户 BELONGS_TO_MANY 角色
        return $this->belongsToMany('Role', 'boyun_access');
    }
}