<?php
namespace app\Admin\model;
use think\Model;
use think\Request;
use think\Db;
class Auser extends Model
{

	public function getUser($username,$password)
	{
		protected $table = 'bd_admin';
		$where = [
			'username' => $username,
			'password' => $password
		];
		$auser = Auser::get($where);
		if($username) {
			return $username;
		}
		else {
			return false;
		}
	}
	
	
}



?>