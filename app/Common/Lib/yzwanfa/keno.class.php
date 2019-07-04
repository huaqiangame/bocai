<?php
namespace Lib\yzwanfa;
class keno{
	/*
	** 二维数组
	** $params 二维数组
	** 字段列表 必须包含
	** typeid 彩票种类（ssc,k3,Game,kl10f,pk10,keno,xy28）
	** playid 玩法标识
	** tzcode 投注号码
	*/


	function __construct($params = []){
		$this->params = $params;
	}
	function checkzhushu($playid,$tzcode){
	 $rx = ['bjkl8rx1','bjkl8rx2','bjkl8rx3','bjkl8rx4','bjkl8rx5','bjkl8rx6','bjkl8rx7'];
	 $qw = ['bjkl8sxp','bjkl8jop','bjkl8dxds'];
      //任选
		if(in_array($playid,$rx)){
			$num = substr($playid,-1);
			return $this->bjkl8rx($tzcode,$num);
		}
		//趣味
		if(in_array($playid,$qw)){
			return $this->quw($tzcode);
		}
	    return $this->$playid($tzcode);
	 }


  //任选
	function bjkl8rx($tzcode,$num){
		$arr = $this->two($tzcode);
		if(!empty($arr[0]) && !empty($arr[1])){
			$currNumber=array_merge($arr[0],$arr[1]);
		}elseif(!empty($arr[0]) && empty($arr[1])){
			$currNumber=$arr[0];
		}elseif(empty($arr[0]) && !empty($arr[1])){
			$currNumber=$arr[1];
		}
		return count($this->combination($currNumber,$num));
	}
  //趣味
	function quw($tzcode){
		$arr=explode(',',$tzcode);
		foreach($arr as $key => $val){
			if($val<0 or $val>3 or !is_numeric($val) or strpos($val,".")){
				return 0;
			};
		}
		return count($arr);
	}

   //双排号码过滤
	function two($tzcode){
		$tzcodes = explode('|',$tzcode);
		if(count($tzcodes)>2)return 0;
		foreach($tzcodes as $k => $v){
			if(!empty($v)){
			$val =  str_replace(array('01','02','03','04','05','06','07','08','09'),array('1','2','3','4','5','6','7','8','9'),$v);
            $arr=explode(',',$val);
			if(count($arr) != count(array_unique($arr)))return 0;
			foreach($arr as $key => $val){
				if($val<=0 or !is_numeric($val) or strpos($val,".")){
					return 0;
				};
			 }
				$result[] = $arr;
			}
		}
		return $result ;
	}
	// 一维数组组合
	function combination($a, $m) {
		$r = array();

		$n = count($a);
		if ($m <= 0 || $m > $n) {
			return $r;
		}

		for ($i=0; $i<$n; $i++) {
			$t = array($a[$i]);
			if ($m == 1) {
				$r[] = $t;
			} else {
				$b = array_slice($a, $i+1);
				$c = self::combination($b, $m-1);
				foreach ($c as $v) {
					$r[] = array_merge($t, $v);
				}
			}
		}

		return $r;
	}


}
?>