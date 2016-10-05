<?php
namespace app\index\controller;
use app\index\model\Teacher; // 引入教师模型
use think\Controller;


class IndexController extends Controller
{

	public function __construct()
    {
        parent::__construct();

        // 验证用户是否登录
        if (!Teacher::isLogin())
        {
            return $this->error('plz login first', url('Login/index'));
        }
    }
    


    public function index()
    {
        // return '123';
        $this->redirect("index/login/index"); //直接跳转，不带计时后跳转
    }
}
