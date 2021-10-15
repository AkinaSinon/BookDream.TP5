<?php
namespace app\Home\model;
use think\Model;
use think\Request;
use traits\model\SoftDelete;
class User extends Model
{
	use SoftDelete;
	// protected static $deteteTime = 'delete_time';
	protected $table = 'bd_user';

	protected $auto = ['ip','password','repasssword'];
	protected function setIPAttr()
	{
		return request()->ip();
	}
	protected function setPasswordAttr($value)
	{
		return md5($value);
	}
	protected function setRepasswordAtte($value)
	{
		return md5($value);
	}


}

?>