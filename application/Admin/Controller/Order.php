<?php
namespace app\Admin\controller;
use think\Controller;
use think\Model;
use think\Request;
use think\Paginato;
use think\Db;
class Order extends Controller
{
    // Order订单预览
     public function redact()
    {
        $data = Db::table('bd_order')->select();
        $count = count($data);
        $data = Db::name('order')->where('status',1)->paginate(12,$count);
        $pages = $data->render();
        $this->assign('data', $data);
        $this->assign('pages', $pages);
        $this->assign('count', $count);
       return $this->fetch(''); 
    }

    //Order订单删除
    public function del()
    {
        if(request()->isGet()){
            $res = Db::table('bd_order')->where('order_id',input('order_id'))->delete();
            if($res){
                return $this->success('订单信息删除成功(≧∇≦)/',Url('admin/Order/redact'));
            }else{
                return $this->error('订单信息删除失败ㄟ( ▔, ▔ )ㄏ',Url('admin/Order/redact'));
            }
        }
    }


    // 闲置
    public function forms()
    {
        return $this->fetch('');
    }

    public function _empty(){
      $this->error('开发中');
    }

}
