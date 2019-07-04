<?php
namespace Lib\kaijiang;
class xy28{
	/*
	** 二维数组
	** $params 二维数组
	** 字段列表 必须包含
	** typeid 彩票种类（ssc,k3,Game,kl10f,pk10,keno,xy28）
	** playid 玩法标识
	** opencode 开奖号码
	** tzcode 投注号码
	*/
	function __construct($params = []){
		$this->params = $params;
	}
	function check(){
		$params = $this->params;
		foreach($params as $pk=>$param){
			$playid = '';
			$playid = $param['playid'];
			$zjcount = 0;
			if(method_exists($this,$playid)){
				$zjcount = self::$playid($param['opencode'],$param['tzcode']);
			}
			$param['zjcount'] = $zjcount;
			$params[$pk] = $param;
		}
		return $params;
	}
	/*
	** xy28_tm_00
	*/
	protected function xy28_tm_00($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==0 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_01($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==1 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_02($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==2 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_03($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==3 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_04($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==4 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_05($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==5 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_06($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==6 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_07($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==7 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_08($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==8 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_09($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==9 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_10($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==10 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_11($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==11 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_12($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==12 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_13($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==13 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_14($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==14 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_15($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==15 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_16($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==16 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_17($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==17 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_18($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==18 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_19($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==19 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_20($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==20 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_21($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==21 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_22($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==22 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_23($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==23 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_24($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==24 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_25($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==25 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_26($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==26 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	protected function xy28_tm_27($opencode,$tzcode){
		$opencodes = explode(',',$opencode);$zjcount   = 0;if(intval($tzcode)==27 && intval($tzcode)==intval($opencode)){$zjcount++;};return $zjcount;
	}
	
	//大
	protected function xy28_hunhe_big($opencode,$tzcode){
		$hezhi = intval($opencode);
		$zjcount   = 0;
		if($hezhi>=14 && $tzcode=='大'){
			$zjcount=1;
		}
		return $zjcount;
	}
	//小
	protected function xy28_hunhe_small($opencode,$tzcode){
		$hezhi = intval($opencode);
		$zjcount   = 0;
		if($hezhi<=13 && $tzcode=='小'){
			$zjcount=1;
		}
		return $zjcount;
	}
	//单
	protected function xy28_hunhe_odd($opencode,$tzcode){
		$hezhi = intval($opencode);
		$zjcount   = 0;
		if($hezhi%2!=0 && $tzcode=='单'){
			$zjcount=1;
		}
		return $zjcount;
	}
	//双
	protected function xy28_hunhe_even($opencode,$tzcode){
		$hezhi = intval($opencode);
		$zjcount   = 0;
		if($hezhi%2==0 && $tzcode=='双'){
			$zjcount=1;
		}
		return $zjcount;
	}
	//大单
	protected function xy28_hunhe_big_odd($opencode,$tzcode){
		$hezhi = intval($opencode);
		$zjcount   = 0;
		if($hezhi>=14 && $hezhi%2!=0 && $tzcode=='大单'){
			$zjcount=1;
		}
		return $zjcount;
	}
	//小单
	protected function xy28_hunhe_small_odd($opencode,$tzcode){
		$hezhi = intval($opencode);
		$zjcount   = 0;
		if($hezhi<=13 && $hezhi%2!=0 && $tzcode=='小单'){
			$zjcount=1;
		}
		return $zjcount;
	}
	//大双
	protected function xy28_hunhe_big_even($opencode,$tzcode){
		$hezhi = intval($opencode);
		$zjcount   = 0;
		if($hezhi>=14 && $hezhi%2==0 && $tzcode=='大双'){
			$zjcount=1;
		}
		return $zjcount;
	}
	//小双
	protected function xy28_hunhe_small_even($opencode,$tzcode){
		$hezhi = intval($opencode);
		$zjcount   = 0;
		if($hezhi<=13 && $hezhi%2==0 && $tzcode=='小双'){
			$zjcount=1;
		}
		return $zjcount;
	}
	//极大
	protected function xy28_hunhe_ji_big($opencode,$tzcode){
		$hezhi = intval($opencode);
		$zjcount   = 0;
		if($hezhi>=22 && $tzcode=='极大'){
			$zjcount=1;
		}
		return $zjcount;
	}
	//极小
	protected function xy28_hunhe_ji_small($opencode,$tzcode){
		$hezhi = intval($opencode);
		$zjcount   = 0;
		if($hezhi<=5 && $tzcode=='极小'){
			$zjcount=1;
		}
		return $zjcount;
	}
	
	
	
	

	
	// 阶乘  
	protected function factorial($n) {  
		return array_product(range(1, $n));  
	}  
	  
	// 排列数  
	protected function A($n, $m) {  
		return self::factorial($n)/self::factorial($n-$m);  
	}  
	  
	// 组合数  
	protected function C($n, $m) {  
		return self::A($n, $m)/self::factorial($m);  
	}  	
	// 排列  
	protected function arrangement($a, $m) {  
		$r = array();  
	  
		$n = count($a);  
		if ($m <= 0 || $m > $n) {  
			return $r;  
		}  
	  
		for ($i=0; $i<$n; $i++) {  
			$b = $a;  
			$t = array_splice($b, $i, 1);  
			if ($m == 1) {  
				$r[] = $t;  
			} else {  
				$c = self::arrangement($b, $m-1);  
				foreach ($c as $v) {  
					$r[] = array_merge($t, $v);  
				}  
			}  
		}  
	  
		return $r;  
	}  	
	// 组合  
	protected function combination($a, $m) {  
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