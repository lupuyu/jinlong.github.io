<?php
namespace app\index\model;

use think\Model;

class StuEx extends Model
{
    // 设置数据表（不含前缀）
    protected $name = 'student_extend';

    // 定义类型转换
    protected $type = [
        'birth'    => 'timestamp:Y/m/d',
        'update_time'    => 'timestamp:Y/m/d',
        'create_time'    => 'timestamp:Y/m/d',

    ];

    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    public function student()
    {
        // 档案 BELONGS TO 关联用户
        return $this->belongsTo('student');
    }
}