<?php
namespace Admincenter\Model;
use Think\Model;
class FieldsModel extends BaseModel {
	protected $_validate = [
		['title','require','模型名称必须！'],
		['name','/^[0-9a-z]+$/i','字段名称格式错误！',0,'regex',1],
	];
	function fieldsadd($data=[]){
		$int = $this->data($data)->add();
		if(!$int)return false;
		$_name = C('DB_PREFIX').$data['tbname'];
		$tb_id = 'id';
		$remark= $data['remark']?:$data['title'];
		$fieldtype = $data['fieldtype'];
		$length = $data['length']>255?255:$data['length'];
		$CHAR = '';
		switch($fieldtype){
			case'editor':
				$CHAR = "TEXT NOT NULL";
				break;
			case'map':
				$CHAR = "TEXT NOT NULL";
				break;
			case'number':
				$length2 = $length?:11;
				$CHAR = "INT( {$length2} ) NOT NULL";
				break;
			case'datetime':
				$CHAR = "INT( 10 ) NOT NULL";
				break;
			default:
				$length3 = $length?:255;
				$CHAR = "VARCHAR( {$length3} ) NOT NULL";	
				break;
		}
		$sql = "ALTER TABLE `{$_name}` ADD `{$data['name']}` {$CHAR} COMMENT '{$remark}'";
		//创建数据表及默认字段
		$_isok = M()->execute($sql);
		//dump($sql);exit;
		return $int;
	}
	function deleteone($id){
		if(!is_numeric($id) || !intval($id))return false;
		$_pk = $this->getPk();
		$fields= $this->where([ $_pk=>$id ])->field('tbname,name')->find();
		$int = $this->where([ $_pk=>$id ])->delete();
		if($int){
			$_name = C('DB_PREFIX').$fields['tbname'];
			$_fname = $fields['name'];
			M()->execute("ALTER TABLE `{$_name}` DROP `{$_fname}` ");
		}
		return $int;
	}
}
