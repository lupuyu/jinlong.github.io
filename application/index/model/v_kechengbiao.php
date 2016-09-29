<?php
namespace app\index\model;

use think\Model;

class V_kechengbiao extends Model
{
    // course_time上课时间读取器
    protected function getCourseTimerAttr($value,$data)
    {
        return date('Y-m-d', $data['end_time']);
    }
}