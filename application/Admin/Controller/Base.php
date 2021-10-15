<?php
namespace app\Admin\controller;
use think\Controller;
class Base extends Controller
{

  /*删除功能*/
  public function del($id)
  {
   $id = input("get.id");
   $res = model("category")->del($id);
   if($res)
   {
     $this->success("删除成功");
   }else
   {
    $this->error("删除失败");
   }

  }

  
   



}
