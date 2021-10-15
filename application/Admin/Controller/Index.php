<?php
namespace app\Admin\Controller;
use think\app\Admin\model\Auser as AuserModel;
use think\Model;
use think\Controller ;
use think\Request;
use think\Db;
use think\facade\App;

class Index extends Controller
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

    // 管理员登陆操作
    public function dologin()
    {
        if(Request::instance()->isPost())
        {
            $info = Request::instance()->post();
            $username = $info['username'];
            $password = $info['password'];
            $res = Db::table('bd_admin')->where('username',input('post.username'))->select();
            if (!$res) 
            {
                 $this->error("该用户名不存在");
            }else{
                 $res = Db::table('bd_admin')->where('password',input('post.username'))->select();
                 if ($res){
                     $this->success('账号登录成功(≧∇≦)/',Url('admin/Index/Index'));
                 }else{
                     return $this->error('账号密码错误ㄟ( ▔, ▔ )ㄏ');
                        }
                 }
        }else{
            return $this->error('非法操作...( ＿ ＿)ノ｜',Url('admin/Index/login'));
        }
    }


    public function test()
    {
        return $this->fetch('');
    }

     public function addAdn()
    {
        return $this->fetch('');
    }

        //管理员注册
    public function addAdmin()
    {
        if (request()->isPost()) {
            $admin = model("Admin");
            $admin = input('post.');
            $res = Db::table('bd_admin')->insert($admin);
            if ($res) {
                return $this->success('管理账号注册成功(≧∇≦)/',Url('admin/Index/addAdn'));
            }else{
                return $this->error('管理账号注册失败ㄟ( ▔, ▔ )ㄏ',Url('admin/Index/addAdn'));
            }
        }
    }

}
