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
        $tongjia_info = array();
     //    for($i=0;$i<9;$i++){
     //    	for($i=0;$i<9;$i++){$tongjia_info[][]=$i;}
        	 
     //    }
    	// // var_dump($start_time);
    	// // var_dump($end_time);
    	// var_dump($tongjia_info);
    	// die();
        $result = Count::view('kechengbiao','id,status')
		    ->view('student',['num','kclass','name','phone'],'kechengbiao.student_id=student.id')
		    ->where('teacher_id','2')
		    ->where('start_time','>=','2016-09-01')
		    ->where('end_time','<=','2016-09-30')
		    ->where('course_id','2')
		    ->order('id desc')
		    ->select();

		 //    $row = mysql_fetch_array($result);
			// var_dump($row);
		 //    die();
        //     //如果还没收录此人
        //     if($tongjia_info[$row['num']][0] == '' ){
        //         $tongjia_info[$row['num']][0] = $row['num'];
        //         $tongjia_info[$row['num']][1] = $row['name'];
        //         $tongjia_info[$row['num']][2] = $row['phone'];
        //         $tongjia_info[$row['num']][3] = 0; //考勤次数
        //         $tongjia_info[$row['num']][4] = 0; //正常次数
        //         $tongjia_info[$row['num']][5] = 0; //旷课次数
        //         $tongjia_info[$row['num']][6] = 0; //请假次数
        //         $tongjia_info[$row['num']][7] = 0; //迟到次数
        //         $tongjia_info[$row['num']][8] = 0; //早退次数
        //         if($row['status'] == '2') $tongjia_info[$row['num']][5]++;
        //         else if($row['status'] == '3') $tongjia_info[$row['num']][6]++;
        //         else if($row['status'] == '4') $tongjia_info[$row['num']][7]++;
        //         else if($row['status'] == '5') $tongjia_info[$row['num']][8]++;
        //         else $tongjia_info[$row['num']][4]++;
        //         $tongjia_info[$row['num']][3]++;
        //     }else{//已经收录
        //         if($row['status'] == '2') $tongjia_info[$row['num']][5]++;
        //         else if($row['status'] == '3') $tongjia_info[$row['num']][6]++;
        //         else if($row['status'] == '4') $tongjia_info[$row['num']][7]++;
        //         else if($row['status'] == '5') $tongjia_info[$row['num']][8]++;
        //         else $tongjia_info[$row['num']][4]++;
        //         $tongjia_info[$row['num']][3]++;
        //     }
        // }
        // 
        // 
    

        foreach ($result as $row ) {
                    
            $tongjia_info[$row['num']]['num'] = $row['num'];
            $tongjia_info[$row['num']]['name'] = $row['name'];
            $tongjia_info[$row['num']]['phone'] = $row['phone'];
           if ($tongjia_info[$row['num']][3]->isEmpty()) {
            	$tongjia_info[$row['num']][3]=0;
            } $tongjia_info[$row['num']][3] ++;  //考勤次数
            // $tongjia_info[$row['num']][4] = 0; //正常次数
            // $tongjia_info[$row['num']][5] = 0; //旷课次数
            // $tongjia_info[$row['num']][6] = 0; //请假次数
            // $tongjia_info[$row['num']][7] = 0; //迟到次数
            // $tongjia_info[$row['num']][8] = 0; //早退次数
            // if($row['status'] == '2') $tongjia_info[$row['num']][5]++;
            // else if($row['status'] == '3') $tongjia_info[$row['num']][6]++;
            // else if($row['status'] == '4') $tongjia_info[$row['num']][7]++;
            // else if($row['status'] == '5') $tongjia_info[$row['num']][8]++;
            // else $tongjia_info[$row['num']][4]++;
            
            
        }
		    dump($tongjia_info);
            die();
            $this->assign('tongjia_info', $tongjia_info);
            return $this->fetch();

    }

}