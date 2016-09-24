<?php
namespace app\index\validate;

use think\Validate;

class Teacher extends Validate
{
    // 验证规则
    protected $rule = [
        'name' => ['require', 'min'=>5, 'token'],
        'email'    => ['require', 'email'],
    ];
}