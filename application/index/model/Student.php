<?php
namespace app\index\model;

use think\Model;

class Student extends Model
{
    // 开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    // 定义自动完成的属性
    // protected $insert = ['status' => 1];

    // 定义关联方法
    public function kclass()
    {
        return $this->belongsTo('kclass');
    }
}

