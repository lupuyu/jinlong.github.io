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
    
        $result = Count::view('kechengbiao','id,status')
		    ->view('student',['num','kclass','name','phone'],'kechengbiao.student_id=student.id')
		    ->where('teacher_id',$teacherid)
		    ->where('start_time','>=',$start_time)
		    ->where('end_time','<=',$end_time)
		    ->where('course_id',$course)
		    ->order('id desc')
		    ->select();
		$temp=count($result);
		$this->assign('count', $temp);
					
        foreach($result as $row){
			//判断是否为空
			if(isset($tongjia_info[$row['num']])){
			    
			    if ($row['status']=='2')$tongjia_info[$row['num']]['kk'] +=1;
			    else if($row['status'] == '3') $tongjia_info[$row['num']]['qj'] +=1;
			    else if($row['status'] == '4') $tongjia_info[$row['num']]['cd'] +=1;
			    else if($row['status'] == '5') $tongjia_info[$row['num']]['zt'] +=1;
			    else $tongjia_info[$row['num']]['zc'] +=1;
			    $tongjia_info[$row['num']]['kq'] +=1;
			}else{
				//初始化数组并累加第一次
			    $tongjia_info[$row['num']]['kclass'] = $row['kclass'];
			    $tongjia_info[$row['num']]['name'] = $row['name'];
            	$tongjia_info[$row['num']]['phone'] = $row['phone'];
            	$tongjia_info[$row['num']]['kq']=0;
            	$tongjia_info[$row['num']]['zc']=0;
            	$tongjia_info[$row['num']]['kk']=0;
            	$tongjia_info[$row['num']]['qj']=0;
            	$tongjia_info[$row['num']]['cd']=0;
            	$tongjia_info[$row['num']]['zt']=0;
            	if ($row['status']=='2')$tongjia_info[$row['num']]['kk'] +=1;
			    else if($row['status'] == '3') $tongjia_info[$row['num']]['qj'] +=1;
			    else if($row['status'] == '4') $tongjia_info[$row['num']]['cd'] +=1;
			    else if($row['status'] == '5') $tongjia_info[$row['num']]['zt'] +=1;
			    else $tongjia_info[$row['num']]['zc'] +=1;
			    $tongjia_info[$row['num']]['kq'] +=1;

			}
		}
        
            $this->assign('tongjia_info', $tongjia_info);
            return $this->fetch();

    }

}