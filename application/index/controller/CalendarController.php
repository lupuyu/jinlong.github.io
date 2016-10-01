<?php
namespace app\index\controller;

use app\index\model\Calendar;
use think\Controller;


class CalendarController  extends IndexController{

	public function index()
	{
		return view();
	}

	// 增删改处理
	public function calendarDo(){
		halt(input(''));
		
	}

	public function json()
	{
		return view();
	}

}