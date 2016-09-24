<?php
namespace app\index\model;

use think\Model;

/**
 * 班级
 */
class Kclass extends Model
{
    /**
     * 获取对应的教师（辅导员）信息
     * @return Teacher 教师
     * @author panjie <panjie@yunzhiclub.com>
     */
    public function getTeacher()
    {
        $teacherId = $this->getData('teacher_id');
        $Teacher = Teacher::get($teacherId);
        return $Teacher;
    }


    // 定义关联一个班有好多学生
    public function students()
    {
        return $this->hasMany('student');
    }
}