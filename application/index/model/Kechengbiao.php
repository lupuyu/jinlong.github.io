<?php
namespace app\index\model;

use think\Model;

class Kechengbiao extends Model
{
    // 课程时间修改器
    protected $type       = [
        // 设置birthday为时间戳类型（整型）
        'start_time' => 'timestamp',
        'end_time' => 'timestamp',

    ]; 

    // 定义自动完成的属性


    // status属性读取器
    protected function getStatusAttr($value)
    {
        $status = [ 0 => '未考勤', 1 => '正常', 2 => '旷课', 3 => '请假', 4 => '迟到', 5 => '早退'];
        return $status[$value];
    }



    /**
     * 获取对应的教师（辅导员）信息
     * @return Teacher 教师
     */
    public function getTeacher()
    {
        $teacherId = $this->getData('teacher_id');
        $Teacher = Teacher::get($teacherId);
        return $Teacher;
    }

    public function getKclass()
    {
        $kclassId = $this->getData('kclass_id');
        $Kclass = Kclass::get($kclassId);
        return $Kclass;
    }

    public function getStudent()
    {
        $studentId = $this->getData('student_id');
        $Student = Student::get($studentId);
        return $Student;
    }

        public function getCourse()
    {
        $courseId = $this->getData('course_id');
        $Course = Course::get($courseId);
        return $Course;
    }


}