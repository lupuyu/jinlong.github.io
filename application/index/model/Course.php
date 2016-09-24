<?php
namespace app\index\model;

use think\Model;

class Course extends Model
{
    // 开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    // 定义多对多关联
    public function Teachers()
    {
        // 角色 BELONGS_TO_MANY 用户
        return $this->belongsToMany('Teacher', 'boyun_access');
    }


}
