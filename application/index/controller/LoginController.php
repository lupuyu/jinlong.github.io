<?php
namespace app\index\controller;
use app\index\model\Teacher;

use think\Controller;


class LoginController extends Controller
{
	// 用户登录表单
	public function index()
	{
	    // 显示登陆表单
    	return $this->fetch();
	}

	// 处理用户提交的登录数据
    public function login()
    {
    	// 直接调用M层方法，进行登录。
        if (Teacher::login(input('post.username'), input('post.password')))
        {
            return $this->success('login success', url('kechengbiao/index'));
        } else {
            return $this->error('username or password incorrent', url('index'));
        }
    }

    // 注销
    public function logOut()
    {
        if (Teacher::logOut())
        {
            return $this->success('logout success', url('index'));
        } else {
            return $this->error('logout error', url('index'));
        }
    }
}