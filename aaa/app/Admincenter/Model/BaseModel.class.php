<?php
namespace Admincenter\Model;
use Think\Model;
class BaseModel extends Model {
	function deleteone($id){
		if(!is_numeric($id) || !intval($id))return false;
		$_pk = $this->getPk();
		$int = $this->where([ $_pk=>$id ])->delete();
		return $int;
	}
	function deleteall($ids=[]){
		if(!is_array($ids))return false;
		$ids = array_filter(array_unique($ids));
		if(!$ids)return false;
		$_pk = $this->getPk();
		$map = [];
		$map[$_pk] = array('in',$ids);
		$int = $this->where($map)->delete();
		return $int;
	}
}
