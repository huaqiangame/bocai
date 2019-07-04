<?php
namespace Lib\yzwanfa;
class dpc{
	/*
	** 二维数组
	** $params 二维数组
	** 字段列表 必须包含
	** typeid 彩票种类（ssc,k3,Game,kl10f,pk10,keno,xy28）
	** playid 玩法标识
	** tzcode 投注号码
	*/

	//直选
	public $arrzxhzex = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
	//二星跨度
	public $arrkuaduex = [10, 18, 16, 14, 12, 10, 8, 6, 4, 2];
	//二星组选和值
	public $arrexzuxhz = [0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 4, 4, 3, 3, 2, 2, 1, 1];
	function __construct($params = []){
		$this->params = $params;
	}
	function checkzhushu($playid,$tzcode){
		$fs = ['pl3zxfs','pl3qx2fs','pl3hx2fs'];
		$ds = ['pl3zxds','pl3zsds','pl3zlds','pl3q2zxds','pl3h2zxds','pl3qx2ds','pl3hx2ds','pl3zuxhh'];
		$zhixhz2=['pl3q2zxhz','pl3h2zxhz'];
		$kuadu2 = ['pl3q2kd','pl3h2kd'];
		$zuxhz2=['pl3q2zuxhz','pl3h2zuxhz'];
		//复式
		if(in_array($playid,$fs)){
			return $this->fs($tzcode,count(explode('|',$tzcode)));
		}
		//单式
		if(in_array($playid,$ds))return $this->ds($tzcode);
		//二星直选和值
		if(in_array($playid,$zhixhz2)){
			$itemcount=0;
			$tzcodes = explode(',',$tzcode);
			foreach ($tzcodes as $v){
				$itemcount += $this->arrzxhzex[$v];
			}
			return $itemcount;
		}
		//二星跨度
		if(in_array($playid,$kuadu2)){
			$itemcount=0;
			$tzcodes = explode(',',$tzcode);
			foreach ($tzcodes as $v){
				$itemcount += $this->arrkuaduex[$v];
			}
			return $itemcount;
		}
		//二星组选和值
		if(in_array($playid,$zuxhz2)){
			$itemcount=0;
			$tzcodes = explode(',',$tzcode);
			foreach ($tzcodes as $v){
				$itemcount += $this->arrexzuxhz[$v];
			}
			return $itemcount;
		}
	    return $this->$playid($tzcode);
	 }
	//三星直选和值
  function pl3hzzx($tzcode){
	  $arrzxhz = [1, 3, 6, 10, 15, 21, 28, 36, 45, 55, 63, 69, 73, 75, 75, 73, 69, 63, 55, 45, 36, 28, 21, 15, 10, 6, 3, 1];
	  $itemcount=0;
	  $tzcodes = explode(',',$tzcode);
	  foreach ($tzcodes as $v){
		  $itemcount += $arrzxhz[$v];
	  }
	  return $itemcount;
  }

	//三星跨度
	function pl3kd($tzcode){
		$arrkuadusx = [10, 54, 96, 126, 144, 150, 144, 126, 96, 54];
		$itemcount=0;
		$tzcodes = explode(',',$tzcode);
		foreach ($tzcodes as $v){
			$itemcount += $arrkuadusx[$v];
		}
		return $itemcount;
	}
	//三星组选和值
	function pl3zuxhz($tzcode){
		$arrzuxhz = [1, 2, 2, 4, 5, 6, 8, 10, 11, 13, 14, 14, 15, 15, 14, 14, 13, 11, 10, 8, 6, 5, 4, 2, 2, 1];
		$itemcount=0;
		$tzcodes = explode(',',$tzcode);
		foreach ($tzcodes as $v){
			$itemcount += $arrzuxhz[$v-1];
		}
		return $itemcount;
	}
	//三星组选包胆
	function pl3zuxbd($tzcode){
		if(count($this->one($tzcode))!=1)return 0;
		return 54;
	}
	//前二组选包胆
	function pl3q2zxbd($tzcode){
		if(count($this->one($tzcode))!=1)return 0;
		return 9;
	}
	//后二组选包胆
	function pl3h2zxbd($tzcode){
		if(count($this->one($tzcode))!=1)return 0;
		return 9;
	}
	//组三
	function pl3zux3($tzcode){
		 $curNumber = $this->one($tzcode);
		return count($curNumber)*(count($curNumber)-1);
	}
	//组六
	function pl3zux6($tzcode){
		return count($this->combination(array_unique($this->one($tzcode)),3));
	}
	//三星一码不定位
	function pl3ymbdw($tzcode){
		return count($this->combination(array_unique($this->one($tzcode)),1));
	}
	//三星二码不定位
	function pl3rmbdw($tzcode){
		return count($this->combination(array_unique($this->one($tzcode)),2));
	}
	//定位胆复式
	function pl3dwdfs($tzcode){
		$tzcodes = explode('|',$tzcode);
		$tzcount=0;
		foreach($tzcodes as $v){
			if(!empty($v)){
				$tzcount += count(explode(',',$v));
			}
		}
		return $tzcount ;
	}
	//前二大小单双
	function dxdsq2($tzcode){
		return $this->fs($tzcode,count(explode('|',$tzcode)));
	}
	//后二大小单双
	function dxdsh2($tzcode){
		return $this->fs($tzcode,count(explode('|',$tzcode)));
	}
	//复式
	function fs($tzcode,$num){
		if(count(explode('|',$tzcode))!=$num)return 0;
		return count($this->getArrSet($this->two($tzcode)));
	}
	//单式
	function ds($tzcode){
		return count(explode('|',$tzcode));
	}
	function getArrSet($arrs,$_current_index=-1)
	{
		static $_total_arr;
		static $_total_arr_index;
		static $_total_count;
		static $_temp_arr;
		if($_current_index<0)
		{
			$_total_arr=array();
			$_total_arr_index=0;
			$_temp_arr=array();
			$_total_count=count($arrs)-1;
			$this->getArrSet($arrs,0);
		}
		else
		{
			foreach($arrs[$_current_index] as $v)
			{
				if($_current_index<$_total_count)
				{
					$_temp_arr[$_current_index]=$v;
					$this->getArrSet($arrs,$_current_index+1);
				}
				else if($_current_index==$_total_count)
				{
					$_temp_arr[$_current_index]=$v;
					$_total_arr[$_total_arr_index]=$_temp_arr;
					$_total_arr_index++;
				}

			}
		}
		return $_total_arr;
	}

	//号码过滤1
	function one($tzcode){
		$tzcodes = explode(',',$tzcode);
		foreach($tzcodes as $k=>$v){
			if($v>9 or $v<0 or !is_numeric($v) or strpos($v,"."))unset($tzcodes[$k]);
		}
		return $tzcodes;
	}
	//号码过滤2
	function two($tzcode){
		$tzcodes = explode('|',$tzcode);
		foreach($tzcodes as $k => $v){
			if(empty($v))return 0;
			$arr=explode(',',$v);
			if(count($arr) != count(array_unique($arr)))return 0;
			foreach($arr as $key => $val){
				if($val>9 or $val<0 or !is_numeric($val) or strpos($val,".")){
					return 0;
				};
			}
			$result[] = $arr;
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

	//多维数组组合
	function combination2($arr){
		$sarr = [[]];
		for($i = 0; $i < count($arr); $i++){
			$sta = [];
			for($j = 0; $j < count($sarr); $j++){
				for($k = 0; $k < count($arr[$i]); $k++){
					$sta[]=array_merge($sarr[$j],$arr[$i][$k]);
				}
			}
			$sarr = $sta;
		}
		return $sarr;
	}
}
?>