<?php
namespace app\Admin\controller;
use think\Controller;
use think\Db;
class Product extends Controller
{
    // Product商品管理功能模块
    public function redact()
    {
        $data = Db::table('bd_product')->select();
        $count = count($data);
        $data = Db::name('product')->where('status>=1')->paginate(7,$count);
        $pages = $data->render();
        $this->assign('data', $data);
        $this->assign('pages', $pages);
        $this->assign('count', $count);
       return $this->fetch('');
    }

    public function table()
    {
        return $this->fetch('');
    }

    //添加功能
    public function addProduct()
    {
        return $this->fetch('');
    }

    public function add()
    {
        if (request()->isPost()) {
            $product = model("Product");
            $product = input('post.');
            $res = Db::table('bd_product')->insert($product);
            if ($res) {
                return $this->success('图书信息录入成功(≧∇≦)/',Url('admin/Product/redact'));
            }else{
                return $this->error('图书信息录入失败ㄟ( ▔, ▔ )ㄏ',Url('admin/Product/addProduct'));
            }
        }
    }

    //编辑功能
    public function updata()
    {
            $data = Db::table('bd_product')->where('book_id',input('get.book_id'))->find();
            $this->assign('data', $data);
            return $this->fetch();
    }

    public function saved()
    {
        if(request()->isPost())
        {
            $product = model("Product");
            $product = input('post.');
            $res = Db::table('bd_product')->where('book_id',input('post.book_id'))->update(['book_name' => input('post.book_name')]);
            if($res){
                return $this->success('图书信息更新成功(≧∇≦)/',Url('admin/Product/redact'));
            }else{
                return $this->error('图书信息更新失败ㄟ( ▔, ▔ )ㄏ',Url('admin/Product/updata'));
            }

        }
    }

    //删除功能
    public function del()
    {
        if(request()->isGet()){
            $res = Db::table('bd_product')->where('book_id',input('book_id'))->delete();
            if($res){
                return $this->success('商品信息删除成功(≧∇≦)/',Url('admin/Product/redact'));
            }else{
                return $this->error('商品信息删除失败ㄟ( ▔, ▔ )ㄏ',Url('admin/Product/redact'));
            }
        }
    }


    public function upload_img(){
        if(request()->isPost()){
            $data=input('post.');
            if($_FILES['image']['tmp_name']){
                $data['image']=$this->upload();
            }
            $add=db('test_images')->insert($data);
            if($add){
                $this->success('添加图片成功！');
            }else{
                $this->error('添加图片失败！');
            }
            return;
        }
        return view();
    }
 
 
    //上传图片函数
    public function upload(){
        $file = request()->file('image');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS .'uploads');
            if($info){
                return $info->getSaveName();
            }else{
                echo $file->getError();die;
            }
        }
    }
}
