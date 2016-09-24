<?php
namespace app\index\controller;

use app\index\model\Kclass;

use app\index\model\Teacher;


use think\Controller;

class KclassController extends Controller
{
    public function index()
    {
        $kclasses = Kclass::paginate();
        $this->assign('kclasses', $kclasses);
        return $this->fetch();
    }


    public function add()
    {
        // 获取所有的教师信息
        $teachers = Teacher::all();
        $this->assign('teachers', $teachers);
        return $this->fetch();
    }

    public function save()
    {
        $kclass = new Kclass();
        $kclass->name = input('post.name');
        $kclass->teacher_id = input('post.teacher_id/d');
        $kclass->save();
        return $this->success('保存成功', url('index'));
    }

        public function edit($id)
    {
        // $id = input('get.id/d');

        // 获取所有的教师信息
        $teachers = Teacher::all();
        $this->assign('teachers', $teachers);

        // 获取用户操作的班级信息
        if (false === $Kclass = Kclass::get($id))
        {
            return $this->error('系统未找到ID为' . $id . '的记录');
        }

        $this->assign('Kclass', $Kclass);
        return $this->fetch();
    }

    public function update()
    {
        $id = input('post.id/d');

        // 获取传入的班级信息
        $Kclass = Kclass::get($id);
        if (false === $Kclass)
        {
            return $this->error('系统未找到ID为' . $id . '的记录');
        }

        // 数据更新
        $Kclass->name = input('post.name');
        $Kclass->teacher_id = input('post.teacher_id');
        if (false === $Kclass->validate(true)->save())
        {
            return $this->error('更新错误：' . $Kclass->getError());
        } else {
            return $this->success('操作成功', url('index'));
        }
    }


        public function delete($id)
    {


        // 获取要删除的对象
        $Kclass = Kclass::get($id);

        if (false === $Kclass)
        {
            return $this->error('不存在id为' . $id . '的课程，删除失败');
        }

        // 删除获取到的对象
        if (false === $Kclass->delete())
        {
            return $this->error('删除失败:' . $Kclass->getError());
        }

        // 进行跳转
        return $this->success('删除成功', url('index'));
    }


public function read()
{
    $kclass  = Kclass::get(1,'students');
    $students = $kclass->students;


    dump($students);
}

}