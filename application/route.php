<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // 全局变量规则定义
    '__pattern__'         => [
        'id'    => '\d+',
    ],
    'teacher/index'      => 'index/teacher/index',
    'teacher/create'     => 'index/teacher/create',
    'teacher/add'        => 'index/teacher/add',
    'teacher/add_list'   => 'index/teacher/addList',    
    'teacher/update/:id' => 'index/teacher/update',
    'teacher/delete/:id' => 'index/teacher/delete',
    'teacher/:id'        => 'index/teacher/read',
    'user/index'      => 'index/user/index',
    'user/create'     => 'index/user/create',
    'user/add'        => 'index/user/add',
    'user/adds'        => 'index/user/adds',
    'user/add_list'   => 'index/user/addList',    
    'user/update/:id' => 'index/user/update',
    'user/delete/:id' => 'index/user/delete',
    'user/:id'        => 'index/user/read',
    'Student/index'      => 'index/Student/index',
    'Student/create'     => 'index/Student/create',
    'Student/add'        => 'index/Student/add',
    'Student/add_list'   => 'index/Student/addList',    
    'Student/update/:id' => 'index/Student/update',
    'Student/delete/:id' => 'index/Student/delete',
    'Student/:id'        => 'index/Student/read',




];
