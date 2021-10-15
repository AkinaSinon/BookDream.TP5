<?php
namespace app\Home\controller;
use think\Controller;
use app\Home\model\Shopping as ShoppingModel;
use think\Model;
use think\Request;
use think\Paginato;
use think\Db;

class Shopping extends Controller
{

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
            $cart = model("User");
            $cart = input('post.');
            $res = Db::table('bd_user')->where('id',input('post.id'))->update(['username' => input('post.username')]);
            if($res){
                return $this->success('用户信息更新成功(≧∇≦)/',Url('Home/User/redact'));
            }else{
                return $this->error('用户信息更新失败ㄟ( ▔, ▔ )ㄏ',Url('Home/User/updata'));
            }

        }
    }

    //Shopping 购物车删除功能
    public function delelctCart()
    {
        if(request()->isGet()){
            $res = Db::table('bd_shopping')->where('cart_id',input('cart_id'))->delete();
            if($res){
                return $this->success('商品删除成功(≧∇≦)/',Url('Home/Index/Index'));
            }else{
                return $this->error('商品删除失败ㄟ( ▔, ▔ )ㄏ');
            }
        }
    }
         
    public function addo()
    {
        //$user=model("user")->usersel();
        //$this->assign("user",$user);
        return $this->fetch();
    }

    //Shopping 加入购物车功能
    public function addCart()
    {
        if (request()->isPost()) {
            $cart = model("Shopping");
            $cart = input('Post.');
            $res = Db::table('bd_shopping')->insert($cart);
            if ($res) {
                return $this->success('加入购物车成功(≧∇≦)/',Url('Home/Index/Index'));
            }else{
                return $this->error('加入购物车失败ㄟ( ▔, ▔ )ㄏ');
            }
        }
    }
}

