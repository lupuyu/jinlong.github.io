<?php
namespace app\index\model;

use think\Model;

class Teacher extends Model
{
	/**
     * 验证密码是否正确
     * @param  string $password 密码
     * @return bool           
     */
    public function checkPassword($password)
    {
        if ($this->getData('password') === $password)
        {
            return true;
        } else {
            return false;
        }
    }
	/**
     * 用户登录
     * @param  string $username 用户名
     * @param  string $password 密码
     * @return bool    成功返回true，失败返回false。
     */
    static public function login($username, $password)
    {
        // 验证用户是否存在
        $map = array('username'=>$username);
        $Teacher = self::get($map);

        
        if ($Teacher !== null)
        {
            // 验证密码是否正确
            if ($Teacher->checkPassword($password))
            {
                // 登录
                session('teacherId', $Teacher->getData('id'));
                session('teacherName', $Teacher->getData('name'));

                return true;
            }
        }

        return false;
    }

	/**
     * 注销
     * @return bool  成功true，失败false。
     * @author panjie
     */
    static public function logOut()
    {
        // 销毁session中数据
        session('teacherId', null);
        return true;
    }

	/**
     * 判断用户是否已登录
     * @return boolean 已登录true
     * @author  panjie <panjie@yunzhiclub.com>
     */
    static public function isLogin()
    {
        $teacherId = session('teacherId');
        if (isset($teacherId))
        {
            return true;
        } else {
            return false;
        }
    }

    // 定义多对多关联
    public function courses()
    {
        // 用户 BELONGS_TO_MANY 角色
        return $this->belongsToMany('Course', 'boyun_access');
    }
    
}