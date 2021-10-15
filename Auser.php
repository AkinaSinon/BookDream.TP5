<?php
namespace app\Admin\Controller;
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
        //$request = Request::instance();
        //dump($request);
        // echo "当前域名是:".$request->domain().'<br />';
        // echo "当前入口文件是:".$request->baseFile().'<br />';
        // echo "当前后缀是:".$request->ext().'<br />';
        // echo "当前操作是:".$request->action().'<br />';
        // echo "当前请求方法是:".$request->method().'<br />';
    	return $this->fetch('');
        //$result = Db::execute('insert into bd_admin (username,password) value("Tester","123456")');
        //$result = Db::execute('insert into bd_admin (username,password) value("Tester","123456")');
        //dump($result);
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
            //$auser = new Auser();
            //$result = $username->getUser(username,md5($password));
            $res = Db::table('bd_admin')->where('username',input('post.username'))->select();
            if (!$res) 
            {
                 $this->error("该用户名不存在");
            }else{
                 $res = Db::table('bd_admin')->where('password',input('post.password'))->select();
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

     //登录注销功能
    public function logout(){
        session('username',null);
        $this->success('退出成功！',Url('admin/Auser/login'));
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
        //判断是否post提交数据
        if (request()->isPost()) {
            //实例化User
            $admin = model("Admin");
            //接受表单提交的数据
            $admin = input('post.');
            //写入数据库
            $res = Db::table('bd_admin')->insert($admin);
            // $this->assign('res',$res);
            // dump($res);
            // die;
            if ($res) {
                return $this->success('管理账号注册成功(≧∇≦)/',Url('admin/Index/addAdn'));
            }else{
                return $this->error('管理账号注册失败ㄟ( ▔, ▔ )ㄏ',Url('admin/Index/addAdn'));
            }
        }
    }

}

