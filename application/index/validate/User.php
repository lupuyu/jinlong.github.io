<?php
namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    // 验证规则
    protected $rule = [
        'username' => 'require|min:5|token',
        'email'    => 'require|email',
        'birthday' => 'dateFormat:Y-m-d',
        'repassword'=>'require|confirm:password'
    ];
}