<?php
namespace app\Admin\model;
use think\Model;
use think\Request;
use traits\model\SoftDelete;
class Index extends Model
{

	protected $table = 'bd_admin';


}

class Auser extends Model
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



?>