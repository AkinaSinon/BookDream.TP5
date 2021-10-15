<?php
namespace app\admin\controller;
use think\Controller;
class TestImage extends Controller
{
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