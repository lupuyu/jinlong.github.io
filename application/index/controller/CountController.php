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
    	//定义开除旷课次数
    	$kaichu=6;
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
			    $tongjia_info[$row['num']]['bfb']=round($tongjia_info[$row['num']]['kk']/$kaichu*100,2);
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
            	$tongjia_info[$row['num']]['bfb']=0;
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
			    $tongjia_info[$row['num']]['bfb']=round($tongjia_info[$row['num']]['kk']/$kaichu*100,2);

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

    //辅导员课程表查课
    public function calendarbzr()
    {
        $teacherid=input('session.teacherId');
        $courses = Teacher::get($teacherid);
        $temp=$courses->courses;
        $this->assign('list',$temp);

         return $this->fetch();
    }



  

    public function calendarDo()
    {    

        

        // $start='2016-10-05 08:00:00';
        // $end='2016-10-05 10:00:00';
        // $course_id='2';
        $teacherid=input('session.teacherId');
        echo '<ul class="list-unstyled spaced">';
        
        $start=date('Y-m-d H:i:s',(substr(input('start'), 0,10)-28800));
        $end=date('Y-m-d H:i:s',(substr(input('end'), 0,10)-28800));
        // dump($start);
        // dump($end); 
        $result=Count::table('boyun_v_kechengbiao','name,kname')
        ->where('teacher_id','eq',$teacherid)
        ->where('start_time','EGT',$start)
        ->where('end_time','ELT',$end)
        ->where('status',2)
        ->select();
        $kktj=count($result);
        echo '<h5>旷课'.$kktj.'人</h5>';
        foreach($result as $user){
            echo '<li> <i class="ace-icon fa fa-times bigger-110 red"></i>'.$user['name'];
            echo '['.$user['kname'].']'.'</li>';
        }
        echo '</ul>';

        
    }


    public function calendarDobzr()
    {    

        

        // $start='2016-10-05 08:00:00';
        // $end='2016-10-05 10:00:00';
        // $course_id='2';
        $teacherid=input('session.teacherId');
        $kclassid = Kclass::table('boyun_kclass')
    	->where('teacher_id',$teacherid)
    	->value('id');
    	$courseid=input('id');
        echo '<ul class="list-unstyled spaced">';
        
        $start=date('Y-m-d H:i:s',(substr(input('start'), 0,10)-28800));
        $end=date('Y-m-d H:i:s',(substr(input('end'), 0,10)-28800));
        
        // dump($end); 
        $result=Count::table('boyun_v_kechengbiao','name,kname')
        ->where('kclass_id','eq',$kclassid)
        ->where('course_id','eq',$courseid)
        ->where('start_time','EGT',$start)
        ->where('end_time','ELT',$end)
        ->where('status',2)
        ->select();
        $kktj=count($result);
        echo '<h5>旷课'.$kktj.'人</h5>';
        foreach($result as $user){
            echo '<li> <i class="ace-icon fa fa-times bigger-110 red"></i>'.$user['name'].'</li>';
        }
        echo '</ul>';

        
    }

    public function calendarJson(){
        $teacherid=input('session.teacherId');
        $data = array();

         $result= Count::query('SELECT DISTINCT boyun_v_kechengbiao.start_time as start,boyun_v_kechengbiao.end_time as end,boyun_v_kechengbiao.teacher_id,boyun_v_kechengbiao.class as title,boyun_v_kechengbiao.color as color
            FROM boyun_v_kechengbiao where  boyun_v_kechengbiao.teacher_id =  ?  ',[$teacherid]); 
         echo json_encode($result);
            // halt($result);

    }

    public function calendarJsonbzr(){
        $teacherid=input('session.teacherId');
    	$kclassid = Kclass::table('boyun_kclass')
    	->where('teacher_id',$teacherid)
    	->value('id');
    	// halt($kclassid);
    	

        $data = array();

         $result= Count::query('SELECT DISTINCT boyun_v_kechengbiao.start_time as start,boyun_v_kechengbiao.end_time as end,boyun_v_kechengbiao.course_id as id,boyun_v_kechengbiao.cname as title,boyun_v_kechengbiao.color as color
            FROM boyun_v_kechengbiao where  boyun_v_kechengbiao.kclass_id =  ?  ',[$kclassid]); 
         echo json_encode($result);
            // halt($result);

    }

}