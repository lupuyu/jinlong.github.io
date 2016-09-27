<?php
namespace app\index\controller;
use app\index\model\Kechengbiao;
use app\index\model\Teacher;
use app\index\model\Course;
use app\index\model\Count;


use think\Controller;
/**
 * 考勤
 */
class KechengbiaoController extends IndexController
{
    public function index()
    {
        $teacherid=input('session.teacherId');
        $courses = Teacher::get($teacherid);
        $temp=$courses->courses;    

        

        

        // $currentTime=time();//当前时间
         // var_dump($teacherName);
         //   die();
        

        $kechengbiao = Kechengbiao::query('select * from boyun_v_kechengbiao where current_TIMESTAMP() between start_time and end_time and teacher_id = ?',[$teacherid]);
        $kechengbiao2 = Kechengbiao::query('select cname from boyun_v_kechengbiao where current_TIMESTAMP() between start_time and end_time and teacher_id = ? group by cname',[$teacherid]);
        $kechengbiao3= Kechengbiao::query('select kname,kclass_id from boyun_v_kechengbiao where current_TIMESTAMP() between start_time and end_time and teacher_id = ? group by kname order by kclass_id asc',[$teacherid]);

        halt($kechengbiao3);
        $this->assign('kechengbiao', $kechengbiao);
        $this->assign('kechengbiao3', $kechengbiao3);
        $this->assign('count', count($kechengbiao));

        return $this->fetch();



    }

    public function read()
    {
        $kechengbiao = Kechengbiao::all();
        $this->assign('kechengbiaos', $kechengbiao);
        return $this->fetch();

    }

    //编辑记录，调试完成
    public function edit()
    {
        // 接收ID
        $id = input('');

        // 在Teacher表模型中获取当前记录
        if (false === $kechengbiao = kechengbiao::get($id))
        {
            return '系统未找到ID为' . $id . '的记录';
        } 

        // 将数据传给V层
        $this->assign('kechengbiao', $kechengbiao);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;

    }

        public function insert()
    {
            //$kechengbiao = input('post.');
            //var_dump($kechengbiao);

            // 引用Teacher模型
            $kechengbiao = new kechengbiao($_POST);
            
            // 插入数据
            $kechengbiao->allowField(['status'])->save();

    }

        public function add()
    {
            $htmls = $this->fetch();
            return $htmls;    
        }

    
    //删除记录，调试完成
    public function delete()
    {
    
        // 接收ID
        $id = input('');

        // 获取要删除的对象
        $kechengbiao = kechengbiao::get($id);

        if (false === $kechengbiao)
        {
            return $this->error('不存在id为' . $id . '的记录，删除失败');
        }

        // 删除获取到的对象
        if (false === $kechengbiao->delete())
        {
            return $this->error('删除失败:' . $kechengbiao->getError());
        }

        // 进行跳转
        return $this->success('删除成功', url('index'));
    }


    //调试完毕
    public function update()
    {
        // 接收ID
        $id = input('id');

        // 将数据存入Teacher表
        $kechengbiao = kechengbiao::get($id);

        // 写入要更新的数据
        $kechengbiao->kclass_id = input('kclass_id');
        $kechengbiao->course_id = input('course_id');
        $kechengbiao->student_id = input('student_id');
        $kechengbiao->teacher_id = input('teacher_id');
        $kechengbiao->class = input('class');
        $kechengbiao->status = input('status');

        $kechengbiao->save();
        return $this->success('考勤成功', url('index'));
    }





    public function save()
    {

        // 接收ID
        $id = input('id');

        // 将数据存入Teacher表
        $kechengbiao = kechengbiao::get($id);

        // 写入要更新的数据
        
        $kechengbiao->status = input('status');

        $kechengbiao->save();
        return $this->success('考勤成功', url('index'));
    }
}