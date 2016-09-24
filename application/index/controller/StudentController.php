<?php
namespace app\index\controller;

use app\index\model\Student;
use think\Controller;



class StudentController extends Controller
{
    // 获取学生数据列表
    public function index()
    {
        $list = Student::all();
        $list = Student::paginate(10);
        $this->assign('list', $list);
        $this->assign('count', count($list));
        return $this->fetch();

    }
    // 新增学生数据
    public function add()
    {
        $Student           = new Student;
        $Student->name = '路濮羽';
        $Student->email    = '13503783168@qq.com';
        $Student->username    = 'lupuyu';

        if ($Student->save()) {
            return '用户[ ' . $Student->name . ':' . $Student->id . ' ]新增成功';
        } else {
            return $Student->getError();
        }
    }
    // 读取学生数据
    public function read($id='')
    {
        $Student = Student::get($id);
        echo $Student->name . '<br/>';
        echo $Student->email . '<br/>';
        echo $Student->stuex->birth .'<br/>';
        echo $Student->stuex->father_name .'<br/>';
        echo $Student->stuex->mother_name .'<br/>';
    }

    // 更新学生数据
    
    public function update($id)
    {
        $Student           = Student::get($id);
        $Student->birth = '1995-09-26';
        if (false !== $Student->save()) {
            return '更新学生成功';
        } else {
            return $Student->getError();
        }
    }

    // 删除学生数据
    public function delete($id)
    {
        $Student = Student::get($id);
        if ($Student) {
            $Student->delete();
            return '删除学生成功';
        } else {
            return '删除的学生不存在';
        }
    }
}