<?php
namespace Lib\kaijiang;
class keno{
	/*
	 * 北京快乐8
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

	//任选一
	protected function bjkl8rx1($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',str_replace('|',',',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)>80 || count($tzcodes)<1)return 0;
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//任选二
	protected function bjkl8rx2($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',str_replace('|',',',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)>8 || count($tzcodes)<1)return 0;
		$combinations = self::combination($tzcodes,2);
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//任选三
	protected function bjkl8rx3($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',str_replace('|',',',$tzcode));
		$zjcount = array();
		$zjcount1   = 0;
		$zjcount2   = 0;
		if(count($tzcodes)>8 || count($tzcodes)<1)return 0;
		$combinations = self::combination($tzcodes,3);
		$combinationss = self::combination($tzcodes,2);
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount1++; //中三
			}
		}
		foreach($combinationss as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount2++; //中二
			}
		}
		$zjcount[1] = $zjcount1;
		$zjcount[2] = $zjcount2;
		if (($zjcount1+ $zjcount2)==0) $zjcount=0;
		return $zjcount;
	}
	//任选四
	protected function bjkl8rx4($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',str_replace('|',',',$tzcode));
		$zjcount   = array();
		$zjcount1 = $zjcount2 = $zjcount3 = 0;
		if(count($tzcodes)>8 || count($tzcodes)<1)return 0;
		$combinations4 = self::combination($tzcodes,4);
		$combinations3 = self::combination($tzcodes,3);
		$combinations2 = self::combination($tzcodes,2);
		foreach($combinations4 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount1++;
			}
		}
		foreach($combinations3 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount2++;
			}
		}
		foreach($combinations2 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount3++;
			}
		}
		$zjcount[1] = $zjcount1;
		$zjcount[2] = $zjcount2;
		$zjcount[3] = $zjcount3;
		if (($zjcount1+ $zjcount2 + $zjcount3)==0) $zjcount=0;
		return $zjcount;
	}
	//任选五
	protected function bjkl8rx5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',str_replace('|',',',$tzcode));
		$zjcount   = array();
		$zjcount1 = $zjcount2 = $zjcount3 = 0;
		if(count($tzcodes)>8 || count($tzcodes)<1)return 0;
		$combinations5 = self::combination($tzcodes,5);
		$combinations4 = self::combination($tzcodes,4);
		$combinations3 = self::combination($tzcodes,3);
		foreach($combinations5 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount1++;
			}
		}
		foreach($combinations4 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount2++;
			}
		}
		foreach($combinations3 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount3++;
			}
		}
		$zjcount[1] = $zjcount1;
		$zjcount[2] = $zjcount2;
		$zjcount[3] = $zjcount3;
		if (($zjcount1+ $zjcount2 + $zjcount3)==0) $zjcount=0;
		return $zjcount;
	}
	//任选六
	protected function bjkl8rx6($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',str_replace('|',',',$tzcode));
		$zjcount   = array();
		$zjcount1 = $zjcount2 = $zjcount3 = $zjcount4 = 0;
		if(count($tzcodes)>8 || count($tzcodes)<1)return 0;
		$combinations6 = self::combination($tzcodes,6);
		$combinations5 = self::combination($tzcodes,5);
		$combinations4 = self::combination($tzcodes,4);
		$combinations3 = self::combination($tzcodes,3);
		foreach($combinations6 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount1++;
			}
		}
		foreach($combinations5 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount2++;
			}
		}
		foreach($combinations4 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount3++;
			}
		}
		foreach($combinations3 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount4++;
			}
		}
		$zjcount[1] = $zjcount1;
		$zjcount[2] = $zjcount2;
		$zjcount[3] = $zjcount3;
		$zjcount[3] = $zjcount4;
		if (($zjcount1+ $zjcount2 + $zjcount3 + $zjcount4)==0) $zjcount=0;
		return $zjcount;
	}

	//任选七
	protected function bjkl8rx7($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',str_replace('|',',',$tzcode));
		$zjcount   = array();
		$zjcount1 = $zjcount2 = $zjcount3 = $zjcount4 = $zjcount5 = 0;
		if(count($tzcodes)>8 || count($tzcodes)<1)return 0;
		$combinations6 = self::combination($tzcodes,7);
		$combinations5 = self::combination($tzcodes,6);
		$combinations4 = self::combination($tzcodes,5);
		$combinations3 = self::combination($tzcodes,4);
		$combinations2 = self::combination($tzcodes,3);
		foreach($combinations6 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount1++;
			}
		}
		foreach($combinations5 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount2++;
			}
		}
		foreach($combinations4 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount3++;
			}
		}
		foreach($combinations3 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount4++;
			}
		}
		foreach($combinations2 as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount5++;
			}
		}
		$zjcount[0] = $zjcount1;
		$zjcount[1] = $zjcount2;
		$zjcount[2] = $zjcount3;
		$zjcount[3] = $zjcount4;
		$zjcount[4] = $zjcount5;
		if (($zjcount1+ $zjcount2 + $zjcount3 + $zjcount4 + $zjcount5)==0) $zjcount=0;
		return $zjcount;
	}
	//上下盘
	protected function bjkl8sxp($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes = explode(',',$tzcode);
		$upcount = 0;
		$downcount = 0;
		foreach($opencodes as $k=>$v){
			if($v<=40){
				$upcount++;
			}elseif($v>=41){
				$downcount++;
			}
		}
		$zjcount='';
		if(in_array(0,$tzcodes)){
			if($upcount>10)$zjcount[1]=1;
		}
		if(in_array(1,$tzcodes)){
			if($upcount == $downcount)$zjcount[0]=1;
		}
		if(in_array(2,$tzcodes)){
			if($downcount>10)$zjcount[1]=1;
		}
		return $zjcount;
	}
	//奇偶盘
	protected function bjkl8jop($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes = explode(',',$tzcode);
		$oucount = 0;
		$jicount = 0;
		foreach($opencodes as $k=>$v){
			if($v%2==0){
				$oucount++;
			}else{
				$jicount++;
			}
		}
		$zjcount='';
		if(in_array(0,$tzcodes)){
			if($oucount>10)$zjcount[1]=1;
		}
		if(in_array(1,$tzcodes)){
			if($oucount == $jicount)$zjcount[0]=1;
		}
		if(in_array(2,$tzcodes)){
			if($jicount>10)$zjcount[1]=1;
		}
		return $zjcount;
	}
//	大小单双
	protected function bjkl8dxds($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes = explode(',',$tzcode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if(in_array(0,$tzcodes)){
			if($he>810 && $he%2!=0){
				$zjcount++;
			}
		}
		if(in_array(1,$tzcodes)){
			if($he>810 && $he%2==0){
				$zjcount++;
			}
		}
		if(in_array(2,$tzcodes)){
			if($he<810 && $he%2!=0){
				$zjcount++;
			}
		}
		if(in_array(3,$tzcodes)){
			if($he<810 && $he%2==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}


	/*
	** 大
	*/
	protected function big($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if($hezhi>=811){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 和
	*/
	protected function bigsmahe($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if($hezhi==810){
			$zjcount++;
		}
		return $zjcount;
	}
	//小
	protected function sma($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if($hezhi<=809){
			$zjcount++;
		}
		return $zjcount;
	}
	//上
	protected function up($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$upcount = 0;
		$downcount = 0;
		foreach($opencodes as $k=>$v){
			if($v<=40){
				$upcount++;
			}elseif($v>=41){
				$downcount++;
			}
		}
		$zjcount   = 0;
		if($upcount>40){
			$zjcount++;
		}
		return $zjcount;
	}
	//中
	protected function mid($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$upcount = 0;
		$downcount = 0;
		foreach($opencodes as $k=>$v){
			if($v<=40){
				$upcount++;
			}elseif($v>=41){
				$downcount++;
			}
		}
		$zjcount   = 0;
		if($downcount==$upcount){
			$zjcount++;
		}
		return $zjcount;
	}
	//下
	protected function down($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$upcount = 0;
		$downcount = 0;
		foreach($opencodes as $k=>$v){
			if($v<=40){
				$upcount++;
			}elseif($v>=41){
				$downcount++;
			}
		}
		$zjcount   = 0;
		if($downcount>40){
			$zjcount++;
		}
		return $zjcount;
	}
	//奇
	protected function ji($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$oucount = 0;
		$jicount = 0;
		foreach($opencodes as $k=>$v){
			if($v%2==0){
				$oucount++;
			}else{
				$jicount++;
			}
		}
		$zjcount   = 0;
		if($jicount>10){
			$zjcount++;
		}
		return $zjcount;
	}
	//和
	protected function jiouhe($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$oucount = 0;
		$jicount = 0;
		foreach($opencodes as $k=>$v){
			if($v%2==0){
				$oucount++;
			}else{
				$jicount++;
			}
		}
		$zjcount   = 0;
		if($oucount==$jicount){
			$zjcount++;
		}
		return $zjcount;
	}
	//偶
	protected function ou($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$oucount = 0;
		$jicount = 0;
		foreach($opencodes as $k=>$v){
			if($v%2==0){
				$oucount++;
			}else{
				$jicount++;
			}
		}
		$zjcount   = 0;
		if($oucount>10){
			$zjcount++;
		}
		return $zjcount;
	}
	//单
	protected function sin($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he%2!=0){
			$zjcount++;
		}
		return $zjcount;
	}
	//双
	protected function cou($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he%2==0){
			$zjcount++;
		}
		return $zjcount;
	}
	//大单
	protected function bigsin($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he>810 && $he%2!=0){
			$zjcount++;
		}
		return $zjcount;
	}
	//小单
	protected function smasin($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he<810 && $he%2!=0){
			$zjcount++;
		}
		return $zjcount;
	}
	//大双
	protected function bigcou($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he>810 && $he%2==0){
			$zjcount++;
		}
		return $zjcount;
	}
	//小双
	protected function smacou($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he<810 && $he%2==0){
			$zjcount++;
		}
		return $zjcount;
	}
	//金
	protected function jin($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he<=695 && $he>=210){
			$zjcount++;
		}
		return $zjcount;
	}
	//木
	protected function mu($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he<=763 && $he>=696){
			$zjcount++;
		}
		return $zjcount;
	}
	//水
	protected function shui($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he<=855 && $he>=764){
			$zjcount++;
		}
		return $zjcount;
	}
	//火
	protected function huo($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he<=923 && $he>=856){
			$zjcount++;
		}
		return $zjcount;
	}
	//土
	protected function tu($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$he = array_sum($opencodes);
		$zjcount   = 0;
		if($he<=1410 && $he>=924){
			$zjcount++;
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