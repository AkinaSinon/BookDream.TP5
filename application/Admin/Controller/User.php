<?php
namespace app\Admin\controller;
use think\Controller;
use app\Admin\model\User as UserModel;
use think\Model;
use think\Request;
use think\Paginato;
use think\Db;

class User extends Controller
{
    // User用户信息功能模块
     public function redact()
    {
        $data = Db::table('bd_user')->select();
        $count = count($data);
        $data = Db::name('user')->where('status',1)->paginate(12,$count);
        $pages = $data->render();
        $this->assign('data', $data);
        $this->assign('pages', $pages);
        $this->assign('count', $count);
       return $this->fetch(''); 
    }


    //编辑功能
    public function updata()
    {
            $data = Db::table('bd_user')->where('id',input('get.id'))->find();
            $this->assign('data', $data);
            return $this->fetch();
    }

    public function saved()
    {
        if(request()->isPost())
        {
            $user = model("User");
            $user = input('post.');
            $res = Db::table('bd_user')->where('id',input('post.id'))->update(['username' => input('post.username')]);
            if($res){
                return $this->success('用户信息更新成功(≧∇≦)/',Url('admin/User/redact'));
            }else{
                return $this->error('用户信息更新失败ㄟ( ▔, ▔ )ㄏ',Url('admin/User/updata'));
            }

        }
    }

    //删除功能
    public function del()
    {
        if(request()->isGet()){
            $res = Db::table('bd_user')->where('id',input('id'))->delete();
            if($res){
                return $this->success('用户信息删除成功(≧∇≦)/',Url('admin/User/redact'));
            }else{
                return $this->error('用户信息删除失败ㄟ( ▔, ▔ )ㄏ',Url('admin/User/redact'));
            }
        }
    }
         
    public function addo()
    {
        return $this->fetch();
    }

    //添加功能
    public function add()
    {
        if (request()->isPost()) {
            $user = model("User");
            $user = input('post.');
            $res = Db::table('bd_user')->insert($user);
            if ($res) {
                return $this->success('用户信息添加成功(≧∇≦)/',Url('admin/User/redact'));
            }else{
                return $this->error('用户信息添加失败ㄟ( ▔, ▔ )ㄏ',Url('admin/User/addo'));
            }
        }
    }

}

