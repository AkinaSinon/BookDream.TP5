<?php
namespace app\Admin\controller;
use think\Controller;
use think\Request;
use think\Db;
 
class BaseT extends Controller
{   
//检查是否登录
  public function _initialize()
  {
     if(!session('username')){
       $this->error('唔好意思,咔死冇得救啦ㄟ( ▔, ▔ )ㄏ',url('/admin/Auser/login'));
     }
  } 
}

?>
