<?php
namespace app\index\controller;

use app\index\model\Profile;
use app\index\model\User;
use app\index\model\Role;
use app\index\model\Book;
use think\Controller;


class UserController  extends IndexController
{
   // 获取用户数据列表并输出
    public function index()
    {
        $list = User::query('select * from boyun_user where id = 1');
        $this->assign('list', $list);
        $this->assign('count', count($list));
        return $this->fetch();
    }

    // 关联新增数据
    public function add()
    {
        $user           = new User;
        $user->name     = 'thinkphp';
        $user->password = '123456';
        $user->nickname = '流年';
        if ($user->save()) {
            // 写入关联数据
            $profile['truename'] = '刘晨';
            $profile['birthday'] = '1977-03-05';
            $profile['address']  = '中国上海';
            $profile['email']    = 'thinkphp@qq.com';
            $user->profile()->save($profile);
            return '用户[ ' . $user->name . ' ]新增成功';
        } else {
            return $user->getError();
        }
    }

    // http://127.0.0.1/login-demo/public/index.php/index/user/read?id=1
    // public function read($id)
    // {
    //     $user = User::get($id);
    //     echo $user->name . '<br/>';
    //     echo $user->nickname . '<br/>';
    //     echo $user->profile->truename . '<br/>';
    //     echo $user->profile->email . '<br/>';
    // }
    public function read($id)
    {
        // $user = User::get($id,'profile');
        // echo $user->name . '<br/>';
        // echo $user->nickname . '<br/>';
        // echo $user->profile->truename . '<br/>';
        // echo $user->profile->email . '<br/>';
        $user = User::get($id);
    	dump($user->toArray());
    }

    // 一对一的关联更新如下：
// http://127.0.0.1/login-demo/public/index.php/index/user/update?id=1
    public function update($id)
    {
        $user       = User::get($id);
        $user->name = 'framework';
        if ($user->save()) {
            // 更新关联数据
            $user->profile->email = 'liu21st@gmail.com';
            $user->profile->save();
            return '用户[ ' . $user->name . ' ]更新成功';
        } else {
            return $user->getError();
        }
    }

    // 关联删除代码如下：

    public function delete($id)
    {
        $user = User::get($id);
        if ($user->delete()) {
            // 删除关联数据
            $user->profile->delete();
            return '用户[ ' . $user->name . ' ]删除成功';
        } else {
            return $user->getError();
        }
    }


    /*以下为一对多操作*/

    // 添加addBook方法用于新增关联数据：
    public function addBook()
    {
        $user  = User::get(1);
        // dump($user);
        $books = [
            ['title' => 'ThinkPHP5快速入门', 'publish_time' => '2016-05-06'],
            ['title' => 'ThinkPHP5开发手册', 'publish_time' => '2016-03-06'],
        ];
        $user->books()->saveAll($books);
        return '添加Book成功';
    }


    public function reads()
    {
        // $user  = User::get(1);
        // // 获取状态为1的关联数据
        // $books = $user->books()->where('status',1)->select();
        // dump($books);
        // // 获取作者写的某本书
        // $book  = $user->books()->getByTitle('ThinkPHP5快速入门');
        // dump($book);
        // 查询有写过书的作者列表
        $user = User::has('books')->select();
        // 查询写过三本书以上的作者
        $user = User::has('books', '>=', 3)->select();
        // 查询写过ThinkPHP5快速入门的作者
        $user = User::hasWhere('books', ['title' => 'ThinkPHP5快速入门'])->select();
        dump($user);
    }

    public function updates($id)
    {
        $user        = User::get($id);
        $book        = $user->books()->getByTitle('ThinkPHP5快速入门2');
        dump($book);
        $book->title = 'ThinkPHP5快速开发';
        $book->save();
    }

    public function deletes($id){
        $user = User::get($id);
        // 删除部分关联数据
        $book = $user->books()->getByTitle('ThinkPHP5快速开发');
        dump($book);
        $book->delete();
    }


    // 删除所有的关联数据：

    public function deletess($id){
        $user = User::get($id);
        if($user->delete()){
            // 删除所有的关联数据
            $user->books()->delete();
        }
    }

    public function adds()
    {
        $user = User::getByNickname('流年');
        // 新增用户角色 并自动写入枢纽表
        $user->roles()->save(['name' => 'editor', 'title' => '编辑']);
        return '用户角色新增成功';
    }

    // 也可以批量新增用户的角色如下：

    // 关联新增数据
    public function addss()
    {
        $user = User::getByNickname('流年');
        // 给当前用户新增多个用户角色
        $user->roles()->saveAll([
            ['name' => 'leader', 'title' => '领导'],
            ['name' => 'admin', 'title' => '管理员'],
        ]);
        return '用户角色新增成功';
    }

    // 关联新增数据
    public function addsss()
    {
        $user = User::getByNickname('流年');
        $user->roles()->attach(1);
        return '用户角色添加成功';
    }

    // 关联查询
    public function readssss()
    {
        $user = User::getByNickname('流年');
        dump($user->roles);
    }

    // 关联查询
    public function readd()
    {
        // 预载入查询
        $user = User::get(2,'roles');
        dump($user->roles);
    }

    // 关联删除数据
    public function deletesasa()
    {
        $user = User::getByNickname('流年');
        $role = Role::getByName('editor');
        // 删除关联数据 并同时删除关联模型数据
        $user->roles()->detach($role,true);
        return '用户角色删除成功';
    }
}