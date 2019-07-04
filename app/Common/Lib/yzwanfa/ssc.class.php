<?php
namespace Lib\yzwanfa;
class ssc{
	/*
	** 二维数组
	** $params 二维数组
	** 字段列表 必须包含
	** typeid 彩票种类（ssc,k3,Game,kl10f,pk10,keno,xy28）
	** playid 玩法标识
	** tzcode 投注号码
	*/
	public $d_balls = array();
	public $t_balls = array();
	public $d_count = 0;
	public $t_count = 0;
	//三星直选和值
	public $arrzxhz = [1, 3, 6, 10, 15, 21, 28, 36, 45, 55, 63, 69, 73, 75, 75, 73, 69, 63, 55, 45, 36, 28, 21, 15, 10, 6, 3, 1];
	//三星跨度
	public $arrkuadusx = [10, 54, 96, 126, 144, 150, 144, 126, 96, 54];
	//三星组选和值
	public $arrzuxhz = [1, 2, 2, 4, 5, 6, 8, 10, 11, 13, 14, 14, 15, 15, 14, 14, 13, 11, 10, 8, 6, 5, 4, 2, 2, 1];
	//二星直选和值
	public $arrzxhzex = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
	//二星组选和值
	public $arrexzuxhz = [0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 4, 4, 3, 3, 2, 2, 1, 1];
	//二星跨度
	public $arrkuaduex = [10, 18, 16, 14, 12, 10, 8, 6, 4, 2];
	function __construct($params = []){
		$this->params = $params;
	}
	function checkzhushu($playid,$tzcode){
	 $fs = ['wxzhixfs','sixzhixfsh','sxzhixfsq','sxzhixfsz','sxzhixfsh','exzhixfsq','exzhixfsh'];
	 $ds = ['wxzhixds','sixzhixdsh','sxzhixdsq','sxhhzxq','qszsds','qszlds','sxzhixdsz',
		'sxhhzxz','zszsds','zszlds','sxzhixdsh','sxhhzxh','hszsds','hszlds','exzhixdsq',
		'exzhixdsh','exzuxdsq','exzuxdsh'];
	 $num1=['bdw5x1m','qwyffs','qwhscs','qwsxbx','qwsjfc','bdw4x1m','bdwqs'];
	 $num2=['bdw5x2m','hsizxl','bdw4x2m','bdwqs2m','exzuxfsq','exzuxfsh'];
	 $zhixhz=['zhixhzqs','zhixhzzs','zhixhzhs'];
	 $zuxhz=['zuxhzqs','zuxhzzs','zuxhzhs'];
	 $kuadu = ['kuaduqs','kuaduzs','kuaduhs'];
	 $sxbd3 = ['zuxcsbd','zuxzsbd','zuxhsbd'];
	 $sxzux = ['sxzuxzsq','sxzuxzsz','sxzuxzsh'];
	 $zhixhz2=['zhixhzqe','zhixhzhe'];
	 $zuxhz2=['zuxhzqe','zuxhzhe'];
	 $kuadu2 = ['kuaduqe','kuaduhe'];
	 $sxbd2 = ['zuxcebd','zuxhebd'];
	 $dxds = ['dxdsqe','dxdshe','dxdsqs','dxdshs'];
	  //复式
	   if(in_array($playid,$fs)){
		     return $this->fs($tzcode,count(explode('|',$tzcode)));
	   }
      //单式
		if(in_array($playid,$ds))return $this->ds($tzcode);
      //其它
		if(in_array($playid,$num1))return $this->one($tzcode,1);
		if(in_array($playid,$num2))return $this->one($tzcode,2);

		if($playid =="wxzxyel")return $this->one($tzcode,5);
		if($playid =="bdw5x3m")return $this->one($tzcode,3);
		if($playid =="hsizxes")return $this->one($tzcode,4);
		if($playid =="sxzuxzlq" or $playid=='sxzuxzlz' or $playid=='sxzuxzlh')return $this->one($tzcode,3);//组六
       //三星直选和值
		if(in_array($playid,$zhixhz)){
			$itemcount=0;
			$tzcodes = explode(',',$tzcode);
			foreach ($tzcodes as $v){
				$itemcount += $this->arrzxhz[$v];
			}
			return $itemcount;
		}
		//三星组选和值
		if(in_array($playid,$zuxhz)){
			$itemcount=0;
			$tzcodes = explode(',',$tzcode);
			foreach ($tzcodes as $v){
				$itemcount += $this->arrzuxhz[$v-1];
			}
			return $itemcount;
		}
       //三星跨度
		if(in_array($playid,$kuadu)){
				$itemcount=0;
				$tzcodes = explode(',',$tzcode);
				foreach ($tzcodes as $v){
					$itemcount += $this->arrkuadusx[$v];
				}
				return $itemcount;
		}
		//三星包胆
		if(in_array($playid,$sxbd3)){
			if($this->one($tzcode,1)!=1)return 0;
			return 54;
		}
		//三星组三
		if(in_array($playid,$sxzux)){
			$tzcodes = explode(',',$tzcode);
			return count($tzcodes)*(count($tzcodes)-1);
		}
		//二星直选和值
		if(in_array($playid,$zhixhz2)){
			$itemcount=0;
			$tzcodes = explode(',',$tzcode);
			foreach ($tzcodes as $v){
				$itemcount += $this->arrzxhzex[$v];
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
		//二星跨度
		if(in_array($playid,$kuadu2)){
			$itemcount=0;
			$tzcodes = explode(',',$tzcode);
			foreach ($tzcodes as $v){
				$itemcount += $this->arrkuaduex[$v];
			}
			return $itemcount;
		}
		//二星包胆
		if(in_array($playid,$sxbd2)){
			if($this->one($tzcode,1)!=1)return 0;
			return 9;
		}
		//大小单双
		if(in_array($playid,$dxds)){
		/*	$tzcodes = explode('|',$tzcode);
			foreach($tzcodes as $v){
				$curNumber[] = explode(',',$v);
			}
			return count($this->combination2($curNumber));*/
			return $this->fs($tzcode,count(explode('|',$tzcode)));
		}
	   return $this->$playid($tzcode);
	}
   //号码过滤1
	function one($tzcode,$num){
		$tzcodes = explode(',',$tzcode);
		foreach($tzcodes as $k=>$v){
			if($v>9 or $v<0 or !is_numeric($v) or strpos($v,"."))unset($tzcodes[$k]);
		}
		return count($this->combination(array_unique($tzcodes),$num));
	}
   //号码过滤2
	function two($tzcode){
		$tzcodes = explode('|',$tzcode);
		foreach($tzcodes as $k => $v){
			//echo $v;exit;
			//if(empty($v))return 0;
			if(strlen($v)<=0)return 0;
			$arr=explode(',',$v);
			//echo 11;exit;
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
    function combineArrUpdata($currNumber){
		$currNumber = $currNumber;
		for( $i = 0; $i < count($currNumber); $i++){
			for($j = 0; $j < count($currNumber[$i]); $j++){
				if($i == 0){
					$this->d_balls[$currNumber[$i][$j]] = $currNumber[$i][$j];
				}else{
					$this->t_balls[$currNumber[$i][$j]] = $currNumber[$i][$j];
				}
			}
			if($i == 0){
				$this->d_count = count($currNumber[$i]);
			}else{
				$this->t_count = count($currNumber[$i]);
			}
		}
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
	//复式
	function fs($tzcode,$num){
		
		if(count(explode('|',$tzcode))!=$num)return 0;
		//echo $this->two($tzcode);exit;
		return count($this->getArrSet($this->two($tzcode)));
	}
	//单式
	function ds($tzcode){
		return count(explode('|',$tzcode));
	}

	//五星组选60
	 function wxzxls($tzcode){
        if(count(explode('|',$tzcode))!=2)return 0;
		 $currNumber = $this->two($tzcode);
		 if(count($currNumber[0])==10 && count($currNumber[1])==10)return 840;
		 $this->combineArrUpdata($currNumber);
		 $recount = 0;
		 sort($this->d_balls);
		 sort($this->t_balls);
		 if ($this->d_balls && count($this->d_balls) > 0 && $this->t_balls && count($this->t_balls) > 0) {
			 for ($i = 0; $i < count($this->d_balls); $i++) {
				 for ($j = 0; $j < count($this->t_balls); $j++){
					 if ($this->t_balls[$j] && $this->t_balls[$j] == $this->d_balls[$i]) {
						 $recount++;
					 }
				 }
			 }
		 }
		 $itemcount = 0;
		 if( $this->t_count>=3 && $this->d_count>=1) {
			 for($this->d_count; $this->d_count>0; $this->d_count--) {
				 if($recount>0) {
					 $diffcount = $this->t_count-4;
					 $topcount = $this->t_count-1;
					 $subcount =  $this->t_count-4;
					 if($diffcount > 0) {
						 $temp = $this->t_count-1;
						 while( $diffcount>1 ) {
							 $diffcount--;
							 $temp--;
							 $topcount =  $topcount * $temp;
							 $subcount = $subcount * $diffcount;
						 }
						 $itemcount += ($topcount/$subcount);
					 }else if($diffcount < 0) {

					 }else {
						 $itemcount += 1;
					 }
					 $recount--;
				 }else {
					 $diffcount = $this->t_count-3;
					 $topcount =  $this->t_count;
					 $subcount =  $this->t_count-3;
					 if($diffcount > 0) {
						 $temp = $this->t_count;
						 while( $diffcount>1 ) {
							 $diffcount--;
							 $temp--;
							 $topcount =  $topcount * $temp;
							 $subcount = $subcount * $diffcount;
						 }
						 $itemcount += ($topcount/$subcount);
					 }else {
						 $itemcount += 1;
					 }
				 }
			 }
		 }
		 return $itemcount;
		
	}
	//五星组选30
	 function wxzxsl($tzcode){
		 if(count( explode('|',$tzcode))!=2)return 0;
		 $currNumber = $this->two($tzcode);
		 $this->combineArrUpdata($currNumber);
		 $itemcount = 0;
		 if($this->d_count > 1 && $this->t_count > 0 ) {
			 for($i = 0; $i < end($this->t_balls)+1 ; $i++) {
				 if($this->t_balls[$i] != undefined && $this->t_balls[$i] != "") {
					 if($this->d_balls[$i] != undefined && $this->d_balls[$i] != "") {
						 if($this->d_count > 2) {
							 $itemcount += ($this->d_count-1)*($this->d_count-2)/2;
						 }
					 } else {
						 $itemcount += $this->d_count*($this->d_count-1)/2;
					 }
				 }
			 }
		 }
		 return $itemcount;
	}
	 //组选20
	 function wxzxel($tzcode){
		 if(count( explode('|',$tzcode))!=2)return 0;
		 $currNumber = $this->two($tzcode);
		 $this->combineArrUpdata($currNumber);
		 $itemcount = 0 ;
		 if($this->d_count > 0 && $this->t_count > 1) {
			 for($i = 0; $i < end($this->d_balls)+1; $i++) {
				 if($this->d_balls[$i] != undefined && $this->d_balls[$i] != "") {
					 if($this->t_balls[$i] != undefined && $this->t_balls[$i] != "") {
						 if($this->t_count > 2) {
							 $itemcount += ($this->t_count-1)*($this->t_count-2)/2;

						 }
					 } else {
						 $itemcount += $this->t_count*($this->t_count-1)/2;
					 }
				 }
			 }
		 }
		 return $itemcount;
	}
	//组选10
	 function wxzxyl($tzcode){
		 if(count( explode('|',$tzcode))!=2)return 0;
		 $currNumber = $this->two($tzcode);
		 $this->combineArrUpdata($currNumber);
		 $itemcount = 0;
		 if($this->d_count > 0 && $this->t_count > 0) {
			 for($i = 0; $i < end($this->d_balls)+1; $i++) {
				 if($this->d_balls[$i] != undefined && $this->d_balls[$i] != "") {
					 if($this->t_balls[$i] != undefined && $this->t_balls[$i] != "") {
						 if($this->t_count > 1) {
							 $itemcount += $this->t_count-1;
						 }
					 } else {
						 $itemcount += $this->t_count;
					 }
				 }
			 }
		 }
		 return $itemcount;
	}
	//组选5
	 function wxzxw($tzcode){
		 if(count( explode('|',$tzcode))!=2)return 0;
		 $currNumber = $this->two($tzcode);
		 $this->combineArrUpdata($currNumber);
		 $itemcount = 0;
		 if($this->d_count > 0 && $this->t_count > 0) {
			 for($i = 0; $i < end($this->d_balls)+1; $i++) {
				 if($this->d_balls[$i] != undefined && $this->d_balls[$i] != "") {
					 if($this->t_balls[$i] != undefined && $this->t_balls[$i] != "") {
						 if($this->t_count > 1) {
							 $itemcount += $this->t_count-1;
						 }
					 } else {
						 $itemcount += $this->t_count;
					 }
				 }
			 }
		 }
		 return $itemcount;
	}
	//后四组选12
	 function hsizxye($tzcode){
	 if(count( explode('|',$tzcode))!=2)return 0;
	 $currNumber = $this->two($tzcode);
	 $this->combineArrUpdata($currNumber);
	 $itemcount = 0;
	 if($this->d_count > 0 && $this->t_count > 1) {
		 for($i = 0; $i < end($this->d_balls)+1; $i++) {
			 if($this->d_balls[$i] != undefined && $this->d_balls[$i] != "") {
				 if($this->t_balls[$i] != undefined && $this->t_balls[$i] != "") {
					 if($this->t_count > 2) {
						 $itemcount += ($this->t_count-1)*($this->t_count-2)/2;
					 }
				 } else {
					 $itemcount += $this->t_count*($this->t_count-1)/2;
				 }
			 }
		 }
	 }
	 return $itemcount;
	}
	//后四组选4
     function hsizxs($tzcode){
		 if(count( explode('|',$tzcode))!=2)return 0;
		 $currNumber = $this->two($tzcode);
		 $this->combineArrUpdata($currNumber);
		 $itemcount = 0;
		 if( $this->d_count > 0 &&  $this->t_count > 0) {
			 for($i = 0; $i < end( $this->d_balls)+1; $i++) {
				 if($this->d_balls[$i] != undefined && $this->d_balls[$i] != "") {
					 if($this->t_balls[$i] != undefined && $this->t_balls[$i] != "") {
						 if($this->t_count > 1) {
							 $itemcount += $this->t_count-1;
						 }
					 } else {
						 $itemcount += $this->t_count;
					 }
				 }
			 }
		 }
		 return $itemcount;
	}
	//定位胆复式
	function dweid($tzcode){
		$tzcodes = explode('|',$tzcode);
		$tzcount=0;
		foreach($tzcodes as $v){
			if(strlen($v)>0){
				$tzcount += count(explode(',',$v));
			}
		}
		return $tzcount ;
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