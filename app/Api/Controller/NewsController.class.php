<?php
namespace Api\Controller;
use Think\Controller;
class NewsController extends CommonController {
	protected $allowMethodList =    array(
	'lists','arclists','shows',
	);
	function lists($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$catelist = M('category')->order('listorder asc')->select();
		$_Tree      = new \Lib\Tree($catelist,['id'=>'id','parentid'=>'parentid']);
		$catelist   = $_Tree->get_tree($catelist);
		$apiparam['sign']=true;
		$apiparam['message']='获取成功';
		$apiparam['catelist']=$catelist;
		return $apiparam;exit;
	}
	function arclists($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$catid = $apiparam['catid'];
		if(!$catid){
			$apiparam['sign']=false;
			$apiparam['message']='获取失败';
			return $apiparam;exit;
		}
		$arclists = M('News')->where(['catid'=>$catid])->order('id ASC')->select();
		if(!$arclists){
			$apiparam['sign']=false;
			$apiparam['message']='没有数据';
			return $apiparam;exit;
		}
		$apiparam['sign']=true;
		$apiparam['message']='获取成功';
		$apiparam['arclists']=$arclists;
		return $apiparam;exit;
	}
}