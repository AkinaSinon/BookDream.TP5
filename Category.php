<?php
namespace app\Admin\controller;
use think\Controller;
use think\Db;
class Category extends Controller
{
    // Category分类检索功能模块
    public function tables()
    {
        return $this->fetch('');
    }

     public function redact()
    {
        $data = Db::table('bd_category')->select();
        $count = count($data);
        $data = Db::name('category')->where('status',1)->paginate(8,$count);
        $pages = $data->render();
        $this->assign('data', $data);
        $this->assign('pages', $pages);
        $this->assign('count', $count);
       return $this->fetch('');
    }

     //编辑功能
    public function addCategory()
    {
        $data = Db::table('bd_category')->select();
        $count = count($data);
        $data = Db::name('category')->where('status',1)->paginate(8,$count);
        $pages = $data->render();
        $this->assign('data', $data);
        $this->assign('pages', $pages);
        $this->assign('count', $count);
        return $this->fetch('');
    }

    public function add()
    {
        if (request()->isPost()) {
            $category = model("Category");
            $category = input('post.');
            $res = Db::table('bd_category')->insert($category);
            if ($res) {
                return $this->success('类别信息录入成功(≧∇≦)/',Url('admin/Category/redact'));
            }else{
                return $this->error('类别信息录入失败ㄟ( ▔, ▔ )ㄏ',Url('admin/Category/addcategory'));
            }
        }
    }

    //编辑功能
    public function updata()
    {
            $data = Db::table('bd_category')->where('type_id',input('get.type_id'))->find();
            $this->assign('data', $data);
            return $this->fetch();
    }

    public function saved()
    {
        if(request()->isPost())
        {
            $category = model("Category");
            $category = input('post.');
            $res = Db::table('bd_category')->where('type_id',input('post.type_id'))->update(['type_one' => input('post.type_one')]);
            if($res){
                return $this->success('类别信息更新成功(≧∇≦)/',Url('admin/Category/redact'));
            }else{
                return $this->error('类别信息更新失败ㄟ( ▔, ▔ )ㄏ',Url('admin/Category/updata'));
            }

        }
    }

    //删除功能
    public function del()
    {
        if(request()->isGet()){
            $res = Db::table('bd_category')->where('type_id',input('type_id'))->delete();
            if($res){
                return $this->success('商品信息删除成功(≧∇≦)/',Url('admin/Category/redact'));
            }else{
                return $this->error('商品信息删除失败ㄟ( ▔, ▔ )ㄏ',Url('admin/Category/redact'));
            }
        }
    }
}
?>
