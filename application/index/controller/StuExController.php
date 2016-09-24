<?php
namespace app\index\controller;

use app\index\model\StuEx;


class StuExController
{
    // 获取学生数据列表
    public function index()
    {
        $list = StuEx::all();
        foreach ($list as $StuEx) {
            echo $StuEx->id . '<br/>';
            echo $StuEx->student_id . '<br/>';
            echo $StuEx->father_name . '<br/>';
            echo $StuEx->birth . '<br/>';
            echo '----------------------------------<br/>';
        }
    }
    // 读取学生数据
    public function read($id='')
    {
        $StuEx = StuEx::get($id);
        echo $StuEx->father_name . '<br/>';
        echo $StuEx->birth . '<br/>';
        echo $StuEx->update_time . '<br/>';
    }
    // 更新学生数据
    
    public function update($id)
    {
        $Student           = StuEx::get($id);
        $Student->birth = '1995-09-26';
        if (false !== $Student->save()) {
            return '更新学生成功';
        } else {
            return $Student->getError();
        }
    }   
}
