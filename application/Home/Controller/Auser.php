<?php
namespace app\Home\Controller;
use think\app\Admin\model\Auser as AuserModel;
use think\Model;
use think\Controller ;
use think\Request;
use think\Db;
use think\facade\App;

class Auser extends Controller
{
    // Admin登录管理功能模块
    public function index()
    {
    	return $this->fetch('');
    }
    
    public function showyzm()
    {
      return captcha('',array('length'=>4));
    }

    public function login(){
        return $this->fetch('');
    }

    // 用户登陆操作
    public function dologin()
    {
        if(Request::instance()->isPost())
        {
            $info = Request::instance()->post();
            $username = $info['username'];
            $password = $info['password'];
            $res = Db::table('bd_user')->where('username',input('post.username'))->select();
            if (!$res) 
            {
                 $this->error("该用户名不存在");
            }else{
                 $res = Db::table('bd_user')->where('password',input('post.password'))->select();
                 if ($res){
                     $this->success('账号登录成功(≧∇≦)/',Url('home/Index/Index'));
                 }else{
                     return $this->error('账号密码错误ㄟ( ▔, ▔ )ㄏ');
                        }
                 }
        }else{
            return $this->error('非法操作...( ＿ ＿)ノ｜',Url('home/Auser/login'));
        }
    }

     // 登录注销功能
    public function logout(){
        session('username',null);
        $this->success('退出成功！',Url('home/Auser/login'));
    }

    public function test()
    {
        return $this->fetch('');
    }

     public function add()
    {
        return $this->fetch('');
    }

    // 用户注册
    public function addUser()
    {
        if (request()->isPost()) {
            $user = model("User");
            $user = input('post.');
            $res = Db::table('bd_user')->insert($user);
            if ($res) {
                return $this->success('账号注册成功(≧∇≦)/,正在为你跳转...',Url('home/Auser/login'));
            }else{
                return $this->error('管理账号注册失败ㄟ( ▔, ▔ )ㄏ');
            }
        }
    }

}
