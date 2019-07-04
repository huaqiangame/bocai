<?php
namespace Api\Controller;
use Think\Controller;
class ContentController extends CommonController {
	protected $allowMethodList =    array('category','shows');
	function category($apiparam=array()){
		//$apiparam = self::_cheacktoken($apiparam);
		//if(!$apiparam['sign'])return $apiparam;
		$catid = $apiparam['catid'];
		//$catid = I('catid');
		if(!$catid){
			$apiparam['sign'] = false;
			$apiparam['message'] = '缺少栏目参数';
			return $apiparam;exit;
		}
		$catinfo = M('category')->where(['catid'=>$catid])->find();
		if(!$catinfo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '栏目不存在';
			return $apiparam;exit;
		}
		if($catinfo['catetype']==2){
			$info = M('page')->where(['catid'=>$catinfo['catid']])->find();
			$catinfo = $info?array_merge($catinfo,$info):$catinfo;
		}else{
			$_subcats = M('category')->where(['parentid'=>$catid])->order('listorder asc,catid desc')->select();
			foreach($_subcats as $k=>$v){
				$subcats[$v['catid']] = $v;
			}
			$catinfo['subcats'] = $subcats;
		}
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['catinfo'] = $catinfo;
		return $apiparam;
	}
}