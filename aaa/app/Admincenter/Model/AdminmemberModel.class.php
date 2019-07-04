<?php
namespace Admincenter\Model;
use Think\Model;
class AdminmemberModel extends BaseModel {
	function loginout($userid){
		if(!$userid || !is_numeric($userid)){
			return false;
		}
		$int = D('Adminlog')->addlog($userid,'logout');
		return $int;
	}
	function getAdmininfo($userid){
		if(!$userid || !is_numeric($userid)){
			return false;
		}
		$uinfo = $this -> alias('a')
		-> join(C('DB_PREFIX')."admingroup as b on a.groupid = b.groupid")
		-> field('a.*,b.groupname')
		-> find();
		return $uinfo;
	}
}
