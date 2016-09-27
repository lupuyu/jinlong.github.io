<?php
namespace app\index\controller;

use app\index\model\Teacher;
use think\Controller;

class TeacherController  extends IndexController
{
    // 获取教师数据列表
    public function index()
    {
        $teacherid=input('session.teacherId');
        $teacher = Teacher::get($teacherid);
        $this->assign('teacher', $teacher);
        return $this->fetch();
        

        // $list = Teacher::all();
        // $list = Teacher::paginate(10);
        // $this->assign('list', $list);
        // $this->assign('count', count($list));
        
        
    }
    // 新增教师数据
    public function add()
    {
    $Teacher = new Teacher;
    if ($Teacher->allowField(true)->validate(true)->save(input('post.'))) {
        return '教师[ ' . $Teacher->name . ':' . $Teacher->id . ' ]新增成功';
    } else {
        return $Teacher->getError();
    }
    }
    // 读取教师数据
    public function read($id='')
    {
        $teacher = Teacher::get($id);
        // dump($teacher->hidden(['create_time','update_time'])->toArray());
        dump($teacher->visible(['id','name','email'])->toArray());
        //echo $teacher->toJson();// 读取用户数据输出JSON
    }
    // 更新教师数据
    
    public function update($id)
    {
        $teacher           = teacher::get($id);
        $teacher->name = '刘晨';
        $teacher->email    = 'liu21st@gmail.com';
        if (false !== $teacher->save()) {
            return '更新教师成功';
        } else {
            return $teacher->getError();
        }
    }

    // 删除教师数据
    public function delete($id)
    {
        $teacher = teacher::get($id);
        if ($teacher) {
            $teacher->delete();
            return '删除教师成功';
        } else {
            return '删除的教师不存在';
        }
    }

    // 创建用户数据页面
    public function create()
    {
        return view();
    }
}