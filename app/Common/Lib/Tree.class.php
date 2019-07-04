<?php
namespace Lib;
/**
* 通用的树型类，可以生成任何树型结构
*/

class Tree {
	/**
	* 生成树型结构所需要的2维数组
	* @var array
	*/
	public $arr = array();

	/**
	* 生成树型结构所需修饰符号，可以换成图片
	* @var array
	*/
	public $icon = array('│','├','└');
	public $nbsp = "&nbsp;&nbsp;&nbsp;";
	public $parentid = 'parentid';
	public $id = 'id';
	/**
	* @access private
	*/
	public $ret = '';

	/**
	* 构造函数，初始化类
	* @param array 2维数组，例如：
	* array(
	*      1 => array('id'=>'1','parentid'=>0,'name'=>'一级栏目一'),
	*      2 => array('id'=>'2','parentid'=>0,'name'=>'一级栏目二'),
	*      3 => array('id'=>'3','parentid'=>1,'name'=>'二级栏目一'),
	*      4 => array('id'=>'4','parentid'=>1,'name'=>'二级栏目二'),
	*      5 => array('id'=>'5','parentid'=>2,'name'=>'二级栏目三'),
	*      6 => array('id'=>'6','parentid'=>3,'name'=>'三级栏目一'),
	*      7 => array('id'=>'7','parentid'=>3,'name'=>'三级栏目二')
	*      )
	*/
	public function __construct($arr=array(),$field=array()){
       $this->arr = $arr;
	   $this->ret = '';
	   $this->parentid = $field['parentid'];
	   $this->id = $field['id'];
	   return is_array($arr);
	}

    /**
	* 得到父级数组
	* @param data
	* @return parentid=0
	*/
	public function get_parent($data=array(),$default=0){
		$newarr = array();
		foreach($data as $k=>$v){
			if($v[$this->parentid]==$default)$newarr[$v[$this->id]]=$v;
		}
		return $newarr;
	}

    /**
	* 得到子级数组
	* @param int
	* @return array
	*/
	public function get_child($data=array(),$id=0){
		$newarr = array();
		foreach($data as $k => $v){
			if($v[$this->parentid] == $id){
				$newarr[$v[$this->id]]=$v;
			}
		}
		return $newarr;
	}
	/*
	* 返回所有子集
	* $true=0 不包含本身 1包含
	*/
	public function getchilds($data=array(),$id=0,$true=0,$level=0){
		$newarr = array();
		$true=$true?$true:0;
		foreach($data as $k => $v){
			if($true && $level==0 && $v[$this->id] == $id){
				$arr[$v[$this->id]]=$v;
			}
			if($v[$this->parentid] == $id){
				$newarr[$v[$this->id]]=$v;
				$newarr=$newarr+self::getchilds($data,$v[$this->id],$true,$level+1);
			}
		}
		$_list = !empty($arr)?($arr+$newarr):$newarr;
		return $_list;
	}
	
    /**
	* 树形
	*/
	public function get_tree($data=array(),$pid=0,$level=0,$html='',$leval='leval'){
		$arr=array();
		$number=1;
		if(!$data)return ;
		foreach($data as $key=>$v){
			if($v[$this->parentid]==$pid){
				$v[$leval]=$level+1;
				$j=$k='';
				if($level>=3){
					$j .= $this->icon[2];
				}else{
					$j .= $this->icon[1];
					$k = $html ? $this->icon[0] : '';
				}
				$spacer = $html ? $html.$j : '';
				$v['spacer']=$spacer;
				$arr[$v[$this->id]]=$v;
				$arr=$arr+self::get_tree($data,$v[$this->id],$level+1,$html.$k.$this->nbsp,$leval);
			}
		}
		return $arr;
	}
    /**
	* 树形数组
	*/
	public function get_tree_arr($data=array(),$pid=0,$name='subcat'){
		$arr=array();
		foreach($data as $k=>$v){
			if($v[$this->parentid]==$pid){
				$v[$name]=$this->get_tree_arr($data,$v[$this->id],$name);
				$arr[$v[$this->id]]=$v;
			}
		}
		return $arr;
	}

    /**
	* 传递子分类id 返回所有的父级分类
	*/
	public  function get_pos($data=array(),$id=0){
		$arr=array();
		foreach($data as $k=>$v){
			if($v[$this->id]==$id){
				$arr[$v[$this->id]]=$v;
				$arr=$this->get_pos($data,$v[$this->parentid])+$arr;
			}
		}
		return $arr;
	}
    /**
	* 获取同级分类
	*/
	public  function getleval($data=array(),$id=0,$leval=1){
		$arr=array();
		if($leval==1){
			$id=$id;
		}elseif($leval==0){
			foreach($data as $p){
				if($p[$this->id] == $id)$id=$p[$this->parentid];
			}
		}
		foreach($data as $k=>$v){
			if($v[$this->parentid]==$id){
				$arr[$v[$this->id]]=$v;
			}
		}
		return $arr;
	}
}
?>