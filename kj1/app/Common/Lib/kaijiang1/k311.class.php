<?php
namespace Lib\kaijiang;
class k3{
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
	** 二同号复选
	*/
	protected function k3ethfx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		sort($opencodes);
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			if(substr_count(implode('',$opencodes),$v) && strlen($v)==2 && substr($v,0,1)==substr($v,-1)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 二同号单选
	*/
	protected function k3ethdx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$acs       = array_count_values($opencodes);
		$zjcount   = 0;
		foreach(explode(',',$tzcodes[0]) as $k=>$v){
			if($acs[substr($v,0,1)]==2 && strlen($v)==2 && substr($v,0,1)==substr($v,-1)){
				foreach(explode(',',$tzcodes[1]) as $k1=>$v1){
					if($acs[intval($v1)]==1){
						$zjcount++;
					}
				}
			}
		}
		return $zjcount;
	}
	/*
	** 二不同号标准
	*/
	protected function k3ebthbz($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$combinations = self::combination($tzcodes,2);
		$zjcount   = 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
			/*if(in_array($v[0],$opencodes) && in_array($v[1],$opencodes) && $v[0]!=$v[1]){
				$tzcodes++;
			}*/
		}
		return $zjcount;
	}
	/*
	** 二不同号胆拖
	*/
	protected function k3ebthdt($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		foreach($dans as $k=>$v){
			if(in_array($v,$opencodes)){
				foreach($tuos as $k1=>$v1){
					if($v!=$v1 && in_array($v1,$opencodes)){
						$zjcount++;
					}
				}
			}
			
		}
		return $zjcount;
	}
	/*
	** 三同号单选
	*/
	protected function k3sthdx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			if($v==implode('',$opencodes) && count(array_unique($opencodes))==1){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 三同号通选
	*/
	protected function k3sthtx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))==1){
			$zjcount = 1;
		}
		return $zjcount;
	}
	/*
	** 三不同号标准
	*/
	protected function k3sbthbz($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$combinations = self::combination($tzcodes,3);
		$zjcount   = 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
			/*if(in_array($v[0],$opencodes) && in_array($v[1],$opencodes) && $v[0]!=$v[1]){
				$tzcodes++;
			}*/
		}
		return $zjcount;
	}
	/*
	** 三不同号胆拖
	*/
	protected function k3sbthdt($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$combinations = self::combination($tuos,2);
		$zjcount   = 0;
		foreach($dans as $k=>$v){
			if(in_array($v,$opencodes) && count(array_unique($opencodes))==3){
				foreach($combinations as $k1=>$v1){
					if($v!=$v1[0] && $v!=$v1[1] && count(array_diff($v1,$opencodes))==0){
						$zjcount++;
					}
				}
			}
		}
		
		return $zjcount;
	}
	/*
	** 三连号通选
	*/
	protected function k3slhtx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		sort($opencodes);
		$zjcount   = 0;
		if(abs($opencodes[1]-$opencodes[0])==1 && abs($opencodes[1]-$opencodes[2])==1 && count(array_unique($opencodes))==3){
			$zjcount   = 1;
		}
		return $zjcount;
	}
	/*
	** 三连号单选
	*/
	protected function k3slhdx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		sort($opencodes);
		$opcodestr = implode('',$opencodes);
		$zjcount   = 0;
		if(in_array($opcodestr,$tzcodes)){
			$zjcount   = 1;
		}
		return $zjcount;
	}
	/*
	** 和值
	*/
	protected function k3hzzx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$sum = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)>16 || count($tzcodes)<1)return $zjcount;
		foreach($tzcodes as $k=>$v){
			if(intval($v)==$sum){
				$zjcount++;
			}
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