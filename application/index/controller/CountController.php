<?php
namespace app\index\controller;
use app\index\model\Count;
use app\index\model\Teacher;
use app\index\model\Course;
use app\index\model\Kclass;


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
    	$course1=Course::get($course);
        $tongjia_info = array();
         
        $result = Count::view('kechengbiao','id,status')
		    ->view('student',['num','kclass','name','phone','birth','nation','location'],'kechengbiao.student_id=student.id')
		    ->where('teacher_id',$teacherid)
		    ->where('start_time','>=',$start_time)
		    ->where('end_time','<=',$end_time)
		    ->where('course_id',$course)
		    ->order('id desc')
		    ->select();
		$temp=count($result);
		$this->assign('count', $temp);
		$this->assign('course1', $course1);
					
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
            	$tongjia_info[$row['num']]['birth'] = $row['birth'];
            	$tongjia_info[$row['num']]['nation'] = $row['nation'];
            	$tongjia_info[$row['num']]['location'] = $row['location'];
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

    //班主任统计
    public function bzr(){
    	$teacherid=input('session.teacherId');
    	$kclasses = Kclass::all(['teacher_id'=>$teacherid]);
    	$this->assign('list',$kclasses);
    	return $this->fetch();
    }
    
    public function bzrtj(){
    	$teacherid=input('session.teacherId');
    	$start_time=input('post.start');
    	$end_time=input('post.end');
    	$kclasses=input('post.co');
    	$kclasses1=Kclass::get($kclasses);
    	$this->assign('kclasses1', $kclasses1);
    	// 获取当前教师所管理的班级
    	// 

    	$kclassid=input('post.co');

    	$tongjia_info = array();
    	

    	$result = Count::view('v_kechengbiao','id,status,cname,end_time')
		    ->view('student',['num','kclass','name','phone','birth','nation','location'],'v_kechengbiao.student_id=student.id')
		    ->where('teacher_id',$teacherid)
		    ->where('start_time','>=',$start_time)
		    ->where('end_time','<=',$end_time)
		    ->where('v_kechengbiao.kclass_id',$kclassid)
		    ->order('id desc')
		    ->select();
		    // halt($result);
	    	$temp=count($result);
			$this->assign('count', $temp);

	    foreach($result as $row){
			//判断是否为空
			if(isset($tongjia_info[$row['num']])){
			    
			    if ($row['status']=='2'){
            		$tongjia_info[$row['num']]['kk'] +=1;
            		$tongjia_info[$row['num']]['kkmx']=$tongjia_info[$row['num']]['kkmx'].'<li class="text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i>'.'<strong>'.$row['cname'].'</strong> [<span class="text-muted">'.$row['end_time'].'</span>]</li>';
            	}
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
            	$tongjia_info[$row['num']]['birth'] = $row['birth'];
            	$tongjia_info[$row['num']]['nation'] = $row['nation'];
            	$tongjia_info[$row['num']]['location'] = $row['location'];
            	$tongjia_info[$row['num']]['kq']=0;
            	$tongjia_info[$row['num']]['zc']=0;
            	$tongjia_info[$row['num']]['kk']=0;
            	$tongjia_info[$row['num']]['qj']=0;
            	$tongjia_info[$row['num']]['cd']=0;
            	$tongjia_info[$row['num']]['zt']=0;
            	$tongjia_info[$row['num']]['kkmx']='';
            	if ($row['status']=='2'){
            		$tongjia_info[$row['num']]['kk'] +=1;
            		$tongjia_info[$row['num']]['kkmx']=$tongjia_info[$row['num']]['kkmx'].'<li class="text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i>'.'<strong>'.$row['cname'].'</strong> [<span class="text-muted">'.time("Y/m/d",$row['end_time']).'</span>]</li>';
            	}
			    else if($row['status'] == '3') $tongjia_info[$row['num']]['qj'] +=1;
			    else if($row['status'] == '4') $tongjia_info[$row['num']]['cd'] +=1;
			    else if($row['status'] == '5') $tongjia_info[$row['num']]['zt'] +=1;
			    else $tongjia_info[$row['num']]['zc'] +=1;
			    $tongjia_info[$row['num']]['kq'] +=1;

			}
		}
		// halt($tongjia_info);
		$this->assign('tongjia_info', $tongjia_info);
            return $this->fetch();


    }
    //按照课程表查考勤
    public function calendar()
    {
        $teacherid=input('session.teacherId');
        $courses = Teacher::get($teacherid);
        $temp=$courses->courses;
        $this->assign('list',$temp);

         return $this->fetch();
    }



  

    public function calendarDo()
    {    

        

        $teacherid=input('session.teacherId');
        // $start='2016-10-05 08:00:00';
        // $end='2016-10-05 10:00:00';
        // $course_id='2';
        echo '请求参数：';
        
        $start=input('start');
        $end=input('end');
        $starttime=date('Y-m-d H:i:s',(substr($start, 0,10)-28800));
        $endtime=date('Y-m-d H:i:s',(substr($end, 0,10)-28800));
        dump($starttime);
        dump($endtime);
        
        



        // $result=Count::table('boyun_v_kechengbiao','name,kname')
        // ->where('teacher_id','eq',$teacherid)
        // ->where('course_id',$course_id)
        // ->where('start_time','EGT',$start)
        // ->where('end_time','ELT',$end)
        // ->where('status',2)
        // ->select();

        // foreach($result as $user){
        //     echo '<i class="ace-icon fa fa-times bigger-110 red"></i>'.$user['name'];
        //     echo '['.$user['kname'].']';
        // }

        
    }

    public function calendarJson(){
        $teacherid=input('session.teacherId');
        $data = array();

         $result= Count::query('SELECT DISTINCT boyun_v_kechengbiao.start_time as start,boyun_v_kechengbiao.end_time as end,boyun_v_kechengbiao.teacher_id,boyun_v_kechengbiao.class as title,boyun_v_kechengbiao.color as color
            FROM boyun_v_kechengbiao where  boyun_v_kechengbiao.teacher_id =  ?  ',[$teacherid]); 
         echo json_encode($result);
            // halt($result);

    }

}