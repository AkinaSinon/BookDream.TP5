<?php
namespace app\Home\controller;
use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\facade\App;
class Showlist extends Controller
{
    public function Showlist()
    {
    	$data = $this->redact();
    	$new = $this->newredact();
    	$cart = $this->redactCart();
    	return $this->fetch('Showlist/Showlist');
    }

    // Product图书全预览
    public function redact()
    {
        $data = Db::table('bd_product')->select();
        $count = count($data);
        $this->assign('data', $data);
        $this->assign('count', $count);
    }

    // Product新图书预览
    public function newredact()
    {
        $new = Db::table('bd_product')->where('status=2')->select();
        $count = count($new);
        $this->assign('new', $new);
        $this->assign('count', $count);
    }

    // Shopping 购物车预览
     public function redactCart()
    {
        $cart = Db::table('bd_shopping')->select();
        $sum = Db::table('bd_shopping')->sum('book_money');
        $count = count($cart);
        $cart = Db::name('shopping')->where('status',1)->paginate(6,$count);
        $pages = $cart->render();
        $this->assign('cart', $cart);
        $this->assign('pages', $pages);
        $this->assign('count', $count);
        $this->assign('sum', $sum);
        // dump($sum);
        // die;
        return $this->fetch(''); 
    }
}

