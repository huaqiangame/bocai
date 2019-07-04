<?php
namespace Admincenter\Model;
use Think\Model;
class ModuleModel extends BaseModel {
	protected $_validate = [
		['title','require','模型名称必须！'],
		['name','','数据表名称已经存在！',0,'unique',1], 
		['name','/^[0-9a-z]+$/i','数据表名称格式错误！',0,'regex',1],
	];
	function Moduleadd($data=[]){
		$int = $this->data($data)->add();
		if(!$int)return false;
		$_name = C('DB_PREFIX').$data['name'];
		$tb_id = 'id';
		$remark= $data['remark']?:$data['title'];
		$sql = "CREATE TABLE IF NOT EXISTS `{$_name}` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `catid` smallint(6) NOT NULL,
		  `uptime` int(11) NOT NULL,
		  `addtime` int(11) NOT NULL,
		  `status` tinyint(1) NOT NULL DEFAULT '1',
		  PRIMARY KEY (`{$tb_id}`),
		  INDEX ( `catid` )
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='{$remark}' AUTO_INCREMENT=1 ;";
		//创建数据表及默认字段
		$_isok = M()->execute($sql);
		return $int;
	}
	function deleteone($id){
		if(!is_numeric($id) || !intval($id))return false;
		$_pk = $this->getPk();
		$name= $this->where([ $_pk=>$id ])->getField('name');
		$int = $this->where([ $_pk=>$id ])->delete();
		if($int){
			$_name = C('DB_PREFIX').$name;
			M()->execute("DROP TABLE `{$_name}`");
		}
		return $int;
	}
}
