<?php
namespace Lib\kaijiang;
class kl10f{
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
	//定位胆第一位
	function kl10dwd1($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//定位胆第二位
	function kl10dwd2($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[1],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//定位胆第三位
	function kl10dwd3($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[2],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//定位胆第四位
	function kl10dwd4($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[3],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//定位胆第五位
	function kl10dwd5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[4],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//定位胆第六位
	function kl10dwd6($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[5],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//定位胆第七位
	function kl10dwd7($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[6],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//定位胆第八位
	function kl10dwd8($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[7],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//任选一中一
	function kl10rx1z1($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//任选二中二
	function kl10rx2z2($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,2);
		if(count($tzcodes)<2)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//任选三中三
	function kl10rx3z3($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,3);
		if(count($tzcodes)<3)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//任选四中四
	function kl10rx4z4($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,4);
		if(count($tzcodes)<4)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//任选五中五
	function kl10rx5z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,5);
		if(count($tzcodes)<5)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 胆拖二中二
	*/
	protected function kl10dt2z2($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(count($dans)!=1)return 0;
		if(count($tuos)<1)return 0;
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
	** 胆拖三中三
	*/
	protected function kl10dt3z3($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(count($dans)<1 || count($dans)>2)return 0;
		$len = 3-count($dans);
		if($len<=0)return 0;
		$combinationds = self::combination($dans,count($dans));
		$combinations = self::combination($tuos,$len);
		$nballs = [];
		foreach($combinationds as $k0=>$v0){
			foreach($combinations as $k=>$v){
				if(count(array_intersect($v0, $v))==0){
					$nballs[] = array_merge($v0,$v);
				}
			}
		}
		foreach($nballs as $k=>$v){
			if(count(array_diff($opencodes,$v))==0 && count($v)==3){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 胆拖四中四
	*/
	protected function kl10dt4z4($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(count($dans)<1 || count($dans)>3)return 0;
		$len = 4-count($dans);
		if($len<=0)return 0;
		$combinationds = self::combination($dans,count($dans));
		$combinations = self::combination($tuos,$len);
		$nballs = [];
		foreach($combinationds as $k0=>$v0){
			foreach($combinations as $k=>$v){
				if(count(array_intersect($v0, $v))==0){
					$nballs[] = array_merge($v0,$v);
				}
			}
		}
		foreach($nballs as $k=>$v){
			if(count(array_diff($v,$opencodes))==0 && count($v)==4){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 胆拖五中五
	*/
	protected function kl10dt5z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(count($dans)<1 || count($dans)>4)return 0;
		$len = 5-count($dans);
		if($len<=0)return 0;
		$combinationds = self::combination($dans,count($dans));
		$combinations = self::combination($tuos,$len);
		$nballs = [];
		foreach($combinationds as $k0=>$v0){
			foreach($combinations as $k=>$v){
				if(count(array_intersect($v0, $v))==0){
					$nballs[] = array_merge($v0,$v);
				}
			}
		}
		foreach($nballs as $k=>$v){
			if(count(array_diff($opencodes,$v))==0 && count($v)==5){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	
	/*
	** 前三直选复式
	*/
	protected function kl10qszxfs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 后三直选复式
	*/
	protected function kl10hszxfs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 前三组选复式
	*/
	protected function kl10qszux($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode(',',$tzcode);
		$combinations = self::combination($tzcodes,3);
		$zjcount   = 0;
		foreach($combinations as $k=>$varr){
			if(count(array_diff($varr,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 前三组选复式
	*/
	protected function kl10hszux($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode(',',$tzcode);
		$combinations = self::combination($tzcodes,3);
		$zjcount   = 0;
		foreach($combinations as $k=>$varr){
			if(count(array_diff($varr,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 二连直选
	*/
	protected function kl10elzx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$tzcodes1  = explode(',',$tzcodes[0]);
		$tzcodes2  = explode(',',$tzcodes[1]);
		$combinations = [];
		foreach($tzcodes1 as $k1=>$v1){
			foreach($tzcodes2 as $k2=>$v2){
				$combinations[] = [$v1,$v2];
			}
		}
		$zjcount   = 0;
		foreach($combinations as $k=>$v){
			$str = '';
			$str = implode(',',$v);
			if(substr_count($opencode,$str)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 二连组选
	*/
	protected function kl10elzux($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$opencodesall = [];
		$opencodesall[] = array_slice($opencodes,0,2);
		$opencodesall[] = array_slice($opencodes,1,2);
		$opencodesall[] = array_slice($opencodes,2,2);
		$opencodesall[] = array_slice($opencodes,3,2);
		$opencodesall[] = array_slice($opencodes,4,2);
		$opencodesall[] = array_slice($opencodes,5,2);
		$opencodesall[] = array_slice($opencodes,6,2);
		foreach($opencodesall as $k=>$v){
			sort($v);
			$opencodesall[$k] = implode(',',$v);
		}
		$tzcodes   = explode(',',$tzcode);
		$combinations = self::combination($tzcodes,2);
		$zjcount   = 0;
		foreach($combinations as $k=>$varr){
			if(in_array(implode(',',$varr),$opencodesall)){
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