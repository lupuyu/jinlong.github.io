<?php
namespace app\index\controller;
use app\index\model\Count;
use app\index\model\Teacher;
use app\index\model\Course;


use think\Controller;


class CountController extends IndexController
{
    public function index()
    {
    	$teacherid=input('session.teacherId');
    	$courses = Teacher::get($teacherid);
    	$temp=$courses->courses;
    	$this->assign('list',$temp);

		 return $this->fetch();
    }


    public function tj()
    {
    	$teacherid=input('session.teacherId');
    	$start_time=input('post.start');
    	$end_time=input('post.end');
    	$course=input('post.co');
    	// var_dump($start_time);
    	// var_dump($end_time);
    	// var_dump($course);
    	// die();
        $result = Count::view('kechengbiao','id,status')
		    ->view('student',['num','kclass','name','phone'],'kechengbiao.student_id=student.id')
		    ->where('teacher_id',$teacherid)
		    ->where('start_time','>=',$start_time)
		    ->where('end_time','<=',$end_time)
		    ->where('course_id',$course)
		    ->order('id desc')
		    ->select();
		    $this->assign('result', $result);
		dump($result);
    }

}