<?php
namespace Admincenter\Model;
use Think\Model;
class CaipiaoModel extends BaseModel {
	protected $_validate = [
		['title','require','彩种名称必须！'],
		['name','','彩种标示已经存在！',0,'unique',2],
		['issys',array(0,1),'彩票类型不正确！',1,'in'],
	];
	function deleteone($id){
		if(!is_numeric($id) || !intval($id))return false;
		$_pk = $this->getPk();
		$name= $this->where([ $_pk=>$id ])->getField('name');
		$int = $this->where([ $_pk=>$id ])->delete();
		if($int){
			M('caipiaotimes')->where([ 'name'=>$name ])->delete();
		}
		return $int;
	}
}
