<?php
namespace Lib\kaijiang;
class ssc{
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
			$zjinfo = self::$playid($param['opencode'],$param['tzcode']);
			if(is_array($zjinfo)){
				$param['zjcount'] = $zjinfo['zjcount'];
				$param['zjstr'] = $zjinfo['zjstr'];
			}elseif(is_numeric($zjinfo)){
				$param['zjcount'] = $zjinfo;
			}else{
				$param['zjcount'] = $zjcount;
			}
			unset($zjinfo);
			//$zjcount = self::$playid($param['opencode'],$param['tzcode']);
			$params[$pk] = $param;
		}
		return $params;
	}
	/*  五星复式 */
	protected function wxzhixfs($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2])) && in_array($opencodes[3],explode(',',$tzcodes[3])) && in_array($opencodes[4],explode(',',$tzcodes[4]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*五星单式*/
	protected function wxzhixds($opencode,$tzcode){
		$opencode = implode(',',explode(',',$opencode));
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/* 五星组选120*/
	protected function wxzxyel($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$tzcodes = $this->Combination($tzcodes,5);
		$zjcount   = 0;
		foreach ($tzcodes as $v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/* 五星组选60*/
	protected function wxzxls($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//重号
		$dhs       = explode(',',$tzcodes[1]);//单号
		$zjcount   = 0;
		if(count($acs)==5){//次数均为1次 则是5单号 不中奖
			return $zjcount;
		}
		if(count($acs)<=2){//4、5重号 不中奖
			return $zjcount;
		}
		foreach($echs as $k=>$v){
			$_temparr = $opencodes;
			if($acs[$v]==2){//二重号至少出现2次
				$_temparr = array_unique($_temparr);
				unset($_temparr[array_search($v,$_temparr)]);
				sort($_temparr);
				if(count($_temparr)==3 && in_array($_temparr[0],$dhs) && in_array($_temparr[1],$dhs) && in_array($_temparr[2],$dhs)){
					$zjcount++;
				}
			}
		}
		
		return $zjcount;
		
	}
	/*五星组选30*/
	protected function wxzxsl($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//重号
		$dhs       = explode(',',$tzcodes[1]);//单号
		$zjcount   = 0;
		if(count($acs)!=3 || count($echs)<2){//次数均为1次 则是5单号 不中奖
			return $zjcount;
		}
		if(count(array_unique($acs))!=2)return $zjcount;
		$_acs1 = $acs;
		foreach($_acs1 as $k=>$v){
			if($v==2)unset($_acs1[$k]);
		}
		$_acs1_1 = array_flip($_acs1);
		sort($_acs1_1);
		if(count($_acs1_1)==1){
			$current = current($_acs1_1);
			if(in_array($current,$dhs)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*组选20*/
	protected function wxzxel($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//重号
		$dhs       = explode(',',$tzcodes[1]);//单号
		$zjcount   = 0;
		if(count($acs)!=3 || count($dhs)<2){//次数均为1次 则是5单号 不中奖  判断是否三重号码和2个单号
			return $zjcount;   //如果不是返回
		}
		$a=$reno=0;
		//查找开奖的重号和获取开奖号码的单号
		foreach ($acs as $k=>$v){
			$v=="3"?$reno = $k: $arr[] =$k;
		}
		//判断开奖号单号与投注的单号是否相同
		foreach($dhs as $k=>$v){
			if(in_array($v,$arr)) $a++;
		}
		if($a!=2)return $zjcount;
		//循环投注重号
		foreach($echs as $k => $v){
			if($v == $reno) $zjcount++;
		}
		return $zjcount;
	}
	/*组选10*/
	protected function wxzxyl($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs    = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//3重号
		$dhs       = explode(',',$tzcodes[1]);//2重号
		$zjcount   = 0;
		if(count($acs)!=2){
			return $zjcount;
		}
		$ball3 = array_search(3,$acs);//3重号的号码
		$ball2 = array_search(2,$acs);//2重号的号码
		if($ball3 or $ball2){  //防止开奖号带0,只要判断其中一个条件成立
			if(in_array($ball3,$echs) && in_array($ball2,$dhs)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*组选5*/
	protected function wxzxw($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//4重号
		$dhs       = explode(',',$tzcodes[1]);//单号
		$zjcount   = 0;
		if(count($acs)!=2){
			return $zjcount;
		}
		//3重号的号码
		//2重号的号码
		$ball4 = array_search(4,$acs);
		$ball1 = array_search(1,$acs);
		if($ball1 or $ball4){
			if(in_array($ball4,$echs) && in_array($ball1,$dhs)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*前四复式*/
	protected function sixzhixfsq($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2])) && in_array($opencodes[3],explode(',',$tzcodes[3]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*前四单式*/
	protected function sixzhixdsq($opencode,$tzcode){
		$opencode = implode(',',array_slice(explode(',',$opencode),0,4));
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/* 前四组选24*/
	protected function qsizxes($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,4);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count(array_diff($opencodes,$tzcodes))==0){
			$zjcount++;
		}
		return $zjcount;
	}
	/*前四组选12*/
	protected function qsizxye($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,4);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//重号
		$dhs       = explode(',',$tzcodes[1]);//单号
		$zjcount   = 0;
		if(count($acs)!=3){
			return $zjcount;
		}
		//2重号的号码
		$ball2 = array_search(2,$acs);
		$_acs1 = $acs;
		foreach($_acs1 as $k=>$v){
			if($v==2)unset($_acs1[$k]);
		}
		if(count($_acs1)!=2)return $zjcount;
		foreach($dhs as $k=>$v){
			unset($_acs1[$v]);
		}
		if(count($_acs1)==0)$zjcount++;
		return $zjcount;
	}
	/* 前四组选6*/
	protected function qsizxl($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,4);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//重号
		$zjcount   = 0;
		if(count($acs)!=2){
			return $zjcount;
		}
		$_acs1 = $acs;
		foreach($_acs1 as $k=>$v){
			if($v==2)unset($_acs1[$k]);
		}
		if(count($_acs1)==0)$zjcount++;
		return $zjcount;
	}
	/*前四组选4*/
	protected function qsizxs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,4);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//重号
		$dhs       = explode(',',$tzcodes[1]);//单号
		$zjcount   = 0;
		if(count($acs)!=2){
			return $zjcount;
		}
		//3重号的号码
		$ball3 = array_search(3,$acs);
		//1单号的号码
		$ball1 = array_search(1,$acs);
		if($ball3 && $ball1 && in_array($ball1,$dhs)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后四复式*/
	protected function sixzhixfsh($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[1],explode(',',$tzcodes[0])) && in_array($opencodes[2],explode(',',$tzcodes[1])) && in_array($opencodes[3],explode(',',$tzcodes[2])) && in_array($opencodes[4],explode(',',$tzcodes[3]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后四单式*/
	protected function sixzhixdsh($opencode,$tzcode){
		$opencode = implode('',array_slice(explode(',',$opencode),-4));
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/*后四组选24*/
	protected function hsizxes($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-4);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count(array_count_values($opencodes))!=4){
			return $zjcount;
		}
		if(count(array_diff($opencodes,$tzcodes))==0){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后四组选12*/
	protected function hsizxye($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-4);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//重号
		$dhs       = explode(',',$tzcodes[1]);//单号
		$zjcount   = 0;
		if(count($acs)!=3){
			return $zjcount;
		}
		//2重号的号码
		$ball2 = array_search(2,$acs);
		$_acs1 = $acs;
		foreach($_acs1 as $k=>$v){
			if($v==2)unset($_acs1[$k]);
		}
		if(count($_acs1)!=2)return $zjcount;
		foreach($dhs as $k=>$v){
			unset($_acs1[$v]);
		}
		if(count($_acs1)==0)$zjcount++;
		return $zjcount;
	}
	/*后四组选6*/
	protected function hsizxl($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-4);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//重号
		$zjcount   = 0;
		if(count($acs)!=2){
			return $zjcount;
		}
		$_acs1 = $acs;
		foreach($_acs1 as $k=>$v){
			if($v==2)unset($_acs1[$k]);
		}
		if(count($_acs1)==0)$zjcount++;
		return $zjcount;
	}
	/*后四组选4*/
	protected function hsizxs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-4);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$echs      = explode(',',$tzcodes[0]);//重号
		$dhs       = explode(',',$tzcodes[1]);//单号
		$zjcount   = 0;
		if(count($acs)!=2){
			return $zjcount;
		}
		//3重号的号码
		$ball3 = array_search(3,$acs);
		//1单号的号码
		$ball1 = array_search(1,$acs);
		if($ball3 && $ball1 && in_array($ball1,$dhs)){
			$zjcount++;
		}
		return $zjcount;
	}

	/* 前三复式 */
	protected function sxzhixfsq($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*前三单式 */
	protected function sxzhixdsq($opencode,$tzcode){
		$opencode = implode(',',array_slice(explode(',',$opencode),0,3));
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/*前三组三*/
	protected function sxzuxzsq($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($acs)!=2 )return $zjcount;
		//2重号的号码
		$ball2 = array_search(2,$acs);
		$ball1 = array_search(1,$acs);
		$str = $ball2.','.$ball2;
		if($ball2 or $ball1){
			foreach($tzcodes as $v){
				if(substr($v,0,3)==$str  && $ball1 == substr($v,-1)){
					$zjcount++;
				}elseif(substr($v,-3)==$str  && $ball1 == substr($v,0,1)){
					$zjcount++;
				}
			}
		}
		return $zjcount;
	}
	/*前三组三单式*/
	protected function qszsds($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(count($acs)!=2 )return $zjcount;
		$ball2 = array_search(2,$acs);
		$ball1 = array_search(1,$acs);
		$str = $ball2.','.$ball2;
		if($ball2 or $ball1){
			foreach($tzcodes as $v){
				if(substr($v,0,3)==$str  && $ball1 == substr($v,-1)){
					$zjcount++;
				}elseif(substr($v,-3)==$str  && $ball1 == substr($v,0,1)){
					$zjcount++;
				}
			}
		}
		return $zjcount;
	}
	/*前三组三胆拖*/
	protected function sxzuxzsdtq($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);//胆码
		$tuos       = explode(',',$tzcodes[1]);//拖码
		$zjcount   = 0;
		if(count($dans)!=1){
			return $zjcount;
		}
		
		$ball2 = array_search(2,$acs);//胆码(2个)
		$ball1 = array_search(1,$acs);//拖码
		if(in_array($ball2,$dans) && in_array($ball1,$tuos) && count($acs)==2){
			$zjcount++;
		}
		return $zjcount;
	}
	/*前三组六*/
	protected function sxzuxzlq($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))!=3){
			return $zjcount;
		}
		if(count(array_diff($opencodes,$tzcodes))==0){
			$zjcount++;
		}
		return $zjcount;
	}
	/* 前三组六单式*/
	protected function qszlds($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))!=3){
			return $zjcount;
		}
		$opencodes = implode(',',$opencodes);
		foreach($tzcodes as $k=>$v){
			if(strstr($opencodes,$v)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*前三组六胆拖*/
	protected function sxzuxzldtq($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);//胆码
		$tuos       = explode(',',$tzcodes[1]);//拖码
		$zjcount   = 0;
		if(count($dans)>2 || count($dans)<1){
			return $zjcount;
		}
		if(count(array_unique($opencodes))!=3){
			return $zjcount;
		}
		foreach($dans as $k=>$v){
			$_opencodes_1 = [];
			$_opencodes_1 = $opencodes;
			if(in_array($v,$_opencodes_1)){
				unset($_opencodes_1[array_search($v,$_opencodes_1)]);
			}
			if(count(array_diff($_opencodes_1,$tuos))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*前三混合组选*/
	protected function sxhhzxq($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))==1)return 0;//豹子号不中
		foreach($tzcodes as $k=>$v){
			$arr = explode(',',$v);
			if($opencodes[0]==$arr[0] && $opencodes[1]==$arr[1] && $opencodes[2]==$arr[2]){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*前三组选包胆*/
	protected function zuxcsbd($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$acs       = array_count_values($opencodes);//重号次数
		$zjcount   = 0;
		if(count($acs)==1){
			return $zjcount;
		}
		$str = implode(',',array_unique($opencodes));
		$zjcount=substr_count($str,$tzcode);
		return $zjcount;
	}
	/*中三复式*/
	protected function sxzhixfsz($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*中三单式*/
	protected function sxzhixdsz($opencode,$tzcode){
		$opencode = implode(',',array_slice(explode(',',$opencode),1,3));
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/*中三组三*/
	protected function sxzuxzsz($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($acs)!=2 )return $zjcount;
		//2重号的号码
		$ball2 = array_search(2,$acs);
		$ball1 = array_search(1,$acs);
		if($ball2 or $ball1){
			if(in_array($ball2,$tzcodes) && in_array($ball1,$tzcodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*中三组三胆拖*/
	protected function sxzuxzsdtz($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);//胆码
		$tuos       = explode(',',$tzcodes[1]);//拖码
		$zjcount   = 0;
		if(count($dans)!=1){
			return $zjcount;
		}
		
		$ball2 = array_search(2,$acs);//胆码(2个)
		$ball1 = array_search(1,$acs);//拖码
		if(in_array($ball2,$dans) && in_array($ball1,$tuos) && count($acs)==2){
			$zjcount++;
		}
		return $zjcount;
	}
	/*中三组六*/
	protected function sxzuxzlz($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))!=3){
			return $zjcount;
		}
		if(count(array_diff($opencodes,$tzcodes))==0){
			$zjcount++;
		}
		return $zjcount;
	}
	/*中三组六胆拖*/
	protected function sxzuxzldtz($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);//胆码
		$tuos       = explode(',',$tzcodes[1]);//拖码
		$zjcount   = 0;
		if(count($dans)>2 || count($dans)<1){
			return $zjcount;
		}
		if(count(array_unique($opencodes))!=3){
			return $zjcount;
		}
		foreach($dans as $k=>$v){
			$_opencodes_1 = [];
			$_opencodes_1 = $opencodes;
			if(in_array($v,$_opencodes_1)){
				unset($_opencodes_1[array_search($v,$_opencodes_1)]);
			}
			if(count(array_diff($_opencodes_1,$tuos))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*中三混合组选 */
	protected function sxhhzxz($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))==1)return 0;//豹子号不中
		foreach($tzcodes as $k=>$v){
			$arr = explode(',',$v);
			if($opencodes[0]==$arr[0] && $opencodes[1]==$arr[1] && $opencodes[2]==$arr[2]){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*中三组选包胆*/
	protected function zuxzsbd($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$acs       = array_count_values($opencodes);//重号次数
		$zjcount   = 0;
		if(count($acs)==1)return $zjcount;
		$str = implode(',',array_unique($opencodes));
		$zjcount=substr_count($str,$tzcode);
		return $zjcount;
	}
	/*中三组三单式*/
	protected function zszsds($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(count($acs)!=2 )return $zjcount;
		//2重号的号码
		$ball2 = array_search(2,$acs);
		$ball1 = array_search(1,$acs);
		$str = $ball2.','.$ball2;
		if($ball2 or $ball1){
			foreach($tzcodes as $k=>$v){
				if(substr($v,0,3)== $str && substr($v,-1)== $ball1 ){
					$zjcount++;
				}elseif(substr($v,-3)== $str && substr($v,0,1)== $ball1 ){
					$zjcount++;
				}
			}
		}
		return $zjcount;
	}
	/*中三组六单式*/
	protected function zszlds($opencode,$tzcode){

		$opencodes = array_slice(explode(',',$opencode),1,-3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))!=3){
			return $zjcount;
		}
		if(count(array_diff($opencodes,$tzcodes))==0){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后三复式*/
	protected function sxzhixfsh($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后三单式 */
	protected function sxzhixdsh($opencode,$tzcode){
		$opencode = substr($opencode,-5);
		dump($opencode);
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/*后三组三*/
	protected function sxzuxzsh($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($acs)!=2 )return $zjcount;
		//2重号的号码
		$ball2 = array_search(2,$acs);
		$ball1 = array_search(1,$acs);
		if($ball2 or $ball1){
			if(in_array($ball2,$tzcodes) && in_array($ball1,$tzcodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*后三组三单式*/
	protected function hszsds($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(count($acs)!=2 )return $zjcount;
		//2重号的号码
		$ball2 = array_search(2,$acs);
		$ball1 = array_search(1,$acs);
		$str = $ball2.','.$ball2;
		if($ball2 or $ball1){
			foreach($tzcodes as $k=>$v){
				if(substr($v,0,3)== $str && substr($v,-1)== $ball1 ){
					$zjcount++;
				}elseif(substr($v,-3)== $str && substr($v,0,1)== $ball1 ){
					$zjcount++;
				}
			}
		}
		return $zjcount;
	}
	/*后三组三胆拖*/
	protected function sxzuxzsdth($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);//胆码
		$tuos       = explode(',',$tzcodes[1]);//拖码
		$zjcount   = 0;
		if(count($dans)!=1){
			return $zjcount;
		}
		
		$ball2 = array_search(2,$acs);//胆码(2个)
		$ball1 = array_search(1,$acs);//拖码
		if(in_array($ball2,$dans) && in_array($ball1,$tuos) && count($acs)==2){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后三组六*/
	protected function sxzuxzlh($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))!=3){
			return $zjcount;
		}
		if(count(array_diff($opencodes,$tzcodes))==0){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后三组六单式*/
	protected function hszlds($opencode,$tzcode){

		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))!=3){
			return $zjcount;
		}
		if(count(array_diff($opencodes,$tzcodes))==0){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后三组六胆拖*/
	protected function sxzuxzldth($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);//胆码
		$tuos       = explode(',',$tzcodes[1]);//拖码
		$zjcount   = 0;
		if(count($dans)>2 || count($dans)<1){
			return $zjcount;
		}
		if(count(array_unique($opencodes))!=3){
			return $zjcount;
		}
		foreach($dans as $k=>$v){
			$_opencodes_1 = [];
			$_opencodes_1 = $opencodes;
			if(in_array($v,$_opencodes_1)){
				unset($_opencodes_1[array_search($v,$_opencodes_1)]);
			}
			if(count(array_diff($_opencodes_1,$tuos))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*后三混合组选*/
	protected function sxhhzxh($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))==1)return 0;//豹子号不中
		foreach($tzcodes as $k=>$v){
			$arr = explode(',',$v);
			if($opencodes[0]==$arr[0] && $opencodes[1]==$arr[1] && $opencodes[2]==$arr[2]){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*后三组选包胆*/
	protected function zuxhsbd($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$acs       = array_count_values($opencodes);//重号次数
		$zjcount   = 0;
		if(count($acs)==1){
			return $zjcount;
		}
		$str = implode(',',array_unique($opencodes));
		$zjcount=substr_count($str,$tzcode);
		return $zjcount;
	}
	/*前二直选复式*/
	protected function exzhixfsq($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*前二直选单式*/
	protected function exzhixdsq($opencode,$tzcode){
		$opencodes = substr($opencode,0,3);
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencodes);
		return $zjcount;
	}
	/*后二直选复式*/
	protected function exzhixfsh($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后二直选单式*/
	protected function exzhixdsh($opencode,$tzcode){
		$opencodes = substr($opencode,-3);
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencodes);
		return $zjcount;
	}
	/*前二组选复式*/
	protected function exzuxfsq($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$zjcount   = 0;
		if(count(array_count_values($opencodes))==1)return $zjcount;
		$tzcodes = explode(',',$tzcode);
		if(in_array($opencodes[0],$tzcodes) && in_array($opencodes[1],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*前二组选单式*/
	protected function exzuxdsq($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = explode(',',$v);
			if(count($arr)==2 && count(array_diff($opencodes,$arr))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*前二组选包胆*/
	protected function zuxcebd($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$acs       = array_count_values($opencodes);//重号次数
		$zjcount   = 0;
		if(count($acs)==1){
			return $zjcount;
		}
		$str = implode(',',$opencodes);
		$zjcount=substr_count($str,$tzcode);
		return $zjcount;
	}
	/*后二组选复式*/
	protected function exzuxfsh($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$zjcount   = 0;
		if(count(array_count_values($opencodes))==1)return $zjcount;
		$tzcodes = explode(',',$tzcode);
		if(in_array($opencodes[0],$tzcodes) && in_array($opencodes[1],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后二组选包胆*/
	protected function zuxhebd($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$acs       = array_count_values($opencodes);//重号次数
		$zjcount   = 0;
		if(count($acs)==1){
			return $zjcount;
		}
		$str = implode(',',$opencodes);
		$zjcount=substr_count($str,$tzcode);
		return $zjcount;
	}
	/*后二组选单式 */
	protected function exzuxdsh($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = explode(',',$v);
			if(count($arr)==2 && count(array_diff($opencodes,$arr))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*前三不定位*/
	protected function bdwqs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*前三二码不定位*/
	protected function  bdwqs2m($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,2);
		foreach($combinations as $k=>$varr){
			if(count(array_diff($varr,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*中三不定位*/
	protected function bdwzs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
    ** 中三二码不定位*/
	protected function  bdwzs2m($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,2);
		foreach($combinations as $k=>$varr){
			if(count(array_diff($varr,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/* 后三二码不定位*/
	protected function  bdwhs2m($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),2,3);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,2);
		foreach($combinations as $k=>$varr){
			if(count(array_diff($varr,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*后三不定位*/
	protected function bdwhs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*五星一码不定位*/
	protected function bdw5x1m($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		dump($tzcodes);
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*五星二码不定位 */
	protected function bdw5x2m($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,2);
		foreach($combinations as $k=>$varr){
			if(count(array_diff($varr,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*五星三码不定位*/
	protected function bdw5x3m($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,3);
		foreach($combinations as $k=>$varr){
			if(count(array_diff($varr,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*五星二码计重*/
	protected function bdw2mjc($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,2);
		$acs       = array_count_values($opencodes);//重号次数
		foreach($combinations as $k=>$varr){
			if(($acs[$varr[0]] + $acs[$varr[1]])>=2){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*五星三码计重*/
	protected function bdw3mjc($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,3);
		$acs       = array_count_values($opencodes);//重号次数
		foreach($combinations as $k=>$varr){
			if(($acs[$varr[0]] + $acs[$varr[1]] + $acs[$varr[2]])>=3){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/* 四星一码不定位*/
	protected function bdw4x1m($opencode,$tzcode){
		$opencodes = explode(',',$opencode); unset($opencodes[0]);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*四星二码不定位*/
	protected function bdw4x2m($opencode,$tzcode){
		$opencodes = explode(',',$opencode);unset($opencodes['0']);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		$combinations = self::combination($tzcodes,2);
		foreach($combinations as $k=>$varr){
			if(count(array_diff($varr,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*前三跨度*/
	protected function kuaduqs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$kuadu = abs(max($opencodes)-min($opencodes));
		$zjcount   = 0;
		if(in_array($kuadu,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*中三跨度*/
	protected function kuaduzs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$kuadu = abs(max($opencodes)-min($opencodes));
		$zjcount   = 0;
		if(in_array($kuadu,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后三跨度*/
	protected function kuaduhs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$kuadu = abs(max($opencodes)-min($opencodes));
		$zjcount   = 0;
		if(in_array($kuadu,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*前二跨度*/
	protected function kuaduqe($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$kuadu = abs(max($opencodes)-min($opencodes));
		$zjcount   = 0;
		if(in_array($kuadu,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后二跨度*/
	protected function kuaduhe($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$kuadu = abs(max($opencodes)-min($opencodes));
		$zjcount   = 0;
		if(in_array($kuadu,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*任四复式*/
	protected function rx4fs($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		$cdw = $opencodes[0];
		$cdq = $opencodes[1];
		$cdb = $opencodes[2];
		$cds = $opencodes[3];
		$cdg = $opencodes[4];
		$w = explode(',',$tzcodes[0]);
		$q = explode(',',$tzcodes[1]);
		$b = explode(',',$tzcodes[2]);
		$s = explode(',',$tzcodes[3]);
		$g = explode(',',$tzcodes[4]);
		//万千百十个
		//万千百十，万千百个，万百十个，千百十个
		if( 
		(count(array_unique($w))>=1 && in_array($cdw,$w)) && 
		(count(array_unique($q))>=1 && in_array($cdq,$q)) && 
		(count(array_unique($b))>=1 && in_array($cdb,$b)) && 
		(count(array_unique($s))>=1 && in_array($cds,$s))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($w))>=1 && in_array($cdw,$w)) && 
		(count(array_unique($q))>=1 && in_array($cdq,$q)) && 
		(count(array_unique($b))>=1 && in_array($cdb,$b)) && 
		(count(array_unique($g))>=1 && in_array($cdg,$g))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($w))>=1 && in_array($cdw,$w)) && 
		(count(array_unique($b))>=1 && in_array($cdb,$b)) && 
		(count(array_unique($s))>=1 && in_array($cds,$s)) && 
		(count(array_unique($g))>=1 && in_array($cdg,$g))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($q))>=1 && in_array($cdq,$q)) && 
		(count(array_unique($b))>=1 && in_array($cdb,$b)) && 
		(count(array_unique($s))>=1 && in_array($cds,$s)) && 
		(count(array_unique($g))>=1 && in_array($cdg,$g))
		){
			$zjcount++;
		}
		
		return $zjcount;
	}
	/* 任四单式*/
	protected function rx4ds($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		switch($tzcodes[1]){//万位,千位,百位,十位,个位
			case'万位,千位,百位,十位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[1].$opencodes[2].$opencodes[3]);
				break;
			case'万位,千位,百位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[1].$opencodes[3].$opencodes[4]);
				break;
			case'万位,百位,十位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[2].$opencodes[3].$opencodes[4]);
				break;
			case'千位,百位,十位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[1].$opencodes[2].$opencodes[3].$opencodes[4]);
				break;
		}
		
		return $zjcount;
	}
	/*任三复式*/
	protected function rx3fs($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		$cdw = $opencodes[0];
		$cdq = $opencodes[1];
		$cdb = $opencodes[2];
		$cds = $opencodes[3];
		$cdg = $opencodes[4];
		$w = explode(',',$tzcodes[0]);
		$q = explode(',',$tzcodes[1]);
		$b = explode(',',$tzcodes[2]);
		$s = explode(',',$tzcodes[3]);
		$g = explode(',',$tzcodes[4]);
		//万千百十个
		//万千百，万千十，万千个，万百十，万百个，万十个,千百十，千百个，千十个，百十个
		if( 
		(count(array_unique($w))>=1 && in_array($cdw,$w)) && 
		(count(array_unique($q))>=1 && in_array($cdq,$q)) && 
		(count(array_unique($b))>=1 && in_array($cdb,$b))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($w))>=1 && in_array($cdw,$w)) && 
		(count(array_unique($q))>=1 && in_array($cdq,$q)) && 
		(count(array_unique($b))>=1 && in_array($cdb,$b))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($w))>=1 && in_array($cdw,$w)) && 
		(count(array_unique($q))>=1 && in_array($cdq,$q)) && 
		(count(array_unique($g))>=1 && in_array($cdg,$g))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($w))>=1 && in_array($cdw,$w)) && 
		(count(array_unique($b))>=1 && in_array($cdb,$b)) && 
		(count(array_unique($s))>=1 && in_array($cds,$s))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($w))>=1 && in_array($cdw,$w)) && 
		(count(array_unique($b))>=1 && in_array($cdb,$b)) && 
		(count(array_unique($g))>=1 && in_array($cdg,$g))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($w))>=1 && in_array($cdw,$w)) && 
		(count(array_unique($s))>=1 && in_array($cds,$s)) && 
		(count(array_unique($g))>=1 && in_array($cdg,$g))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($q))>=1 && in_array($cdq,$q)) && 
		(count(array_unique($b))>=1 && in_array($cdb,$b)) && 
		(count(array_unique($s))>=1 && in_array($cds,$s))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($q))>=1 && in_array($cdq,$q)) && 
		(count(array_unique($b))>=1 && in_array($cdb,$b)) && 
		(count(array_unique($g))>=1 && in_array($cdg,$g))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($q))>=1 && in_array($cdq,$q)) && 
		(count(array_unique($s))>=1 && in_array($cds,$s)) && 
		(count(array_unique($g))>=1 && in_array($cdg,$g))
		){
			$zjcount++;
		}
		if( 
		(count(array_unique($b))>=1 && in_array($cdb,$b)) && 
		(count(array_unique($s))>=1 && in_array($cds,$s)) && 
		(count(array_unique($g))>=1 && in_array($cdg,$g))
		){
			$zjcount++;
		}
		
		return $zjcount;
	}
	/*任三单式*/
	protected function rx3ds($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		switch($tzcodes[1]){//万位,千位,百位,十位,个位
			case'万位,千位,百位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[1].$opencodes[2]);
				break;
			case'万位,千位,十位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[1].$opencodes[3]);
				break;
			case'万位,千位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[1].$opencodes[4]);
				break;
			case'万位,百位,十位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[2].$opencodes[3]);
				break;
			case'万位,百位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[2].$opencodes[4]);
				break;
			case'万位,十位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[3].$opencodes[4]);
				break;
			case'千位,百位,十位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[1].$opencodes[2].$opencodes[3]);
				break;
			case'千位,百位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[1].$opencodes[2].$opencodes[4]);
				break;
			case'千位,十位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[1].$opencodes[3].$opencodes[4]);
				break;
			case'百位,十位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[2].$opencodes[3].$opencodes[4]);
				break;
		}
		
		return $zjcount;
	}
	/*
	** 任三组三
	*/
	/*
	protected function rx3z3($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		switch($tzcodes[1]){//万位,千位,百位,十位,个位
			case'万位,千位,百位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[1].$opencodes[2]);
				break;
			case'万位,千位,十位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[1].$opencodes[3]);
				break;
			case'万位,千位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[1].$opencodes[4]);
				break;
			case'万位,百位,十位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[2].$opencodes[3]);
				break;
			case'万位,百位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[2].$opencodes[4]);
				break;
			case'万位,十位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[0].$opencodes[3].$opencodes[4]);
				break;
			case'千位,百位,十位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[1].$opencodes[2].$opencodes[3]);
				break;
			case'千位,百位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[1].$opencodes[2].$opencodes[4]);
				break;
			case'千位,十位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[1].$opencodes[3].$opencodes[4]);
				break;
			case'百位,十位,个位':
				$zjcount   = substr_count($tzcodes[0],$opencodes[2].$opencodes[3].$opencodes[4]);
				break;
		}
		
		return $zjcount;
	}
	*/

	//前二大小单双
	protected function dxdsqe($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode('|',$tzcode);
		//大(0)小(1)单(2)双(3)
		$bigsamll1 = $opencodes['0']>=5?0:1;
		$signodd1  = $opencodes['0']%2==0?3:2;
		$bigsamll2 = $opencodes['1']>=5?0:1;
		$signodd2  = $opencodes['1']%2==0?3:2;
		$zjcount   = 0;
		if(in_array($bigsamll1,explode(',',$tzcodes[0]))){
			if(in_array($bigsamll2,explode(',',$tzcodes[1]))){
				$zjcount++;
			}
			if(in_array($signodd2,explode(',',$tzcodes[1]))){
				$zjcount++;
			}
		}
		if(in_array($signodd1,explode(',',$tzcodes[0]))){
			if(in_array($bigsamll2,explode(',',$tzcodes[1]))){
				$zjcount++;
			}
			if(in_array($signodd2,explode(',',$tzcodes[1]))){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//后二大小单双
	protected function dxdshe($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = explode('|',$tzcode);
		$bigsamll1 = $opencodes['0']>=5?0:1;
		$signodd1  = $opencodes['0']%2==0?3:2;
		$bigsamll2 = $opencodes['1']>=5?0:1;
		$signodd2  = $opencodes['1']%2==0?3:2;
		$zjcount   = 0;
		if(in_array($bigsamll1,explode(',',$tzcodes[0]))){
			if(in_array($bigsamll2,explode(',',$tzcodes[1]))){
				$zjcount++;
			}
			if(in_array($signodd2,explode(',',$tzcodes[1]))){
				$zjcount++;
			}
		}
		if(in_array($signodd1,explode(',',$tzcodes[0]))){
			if(in_array($bigsamll2,explode(',',$tzcodes[1]))){
				$zjcount++;
			}
			if(in_array($signodd2,explode(',',$tzcodes[1]))){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//前三大小单双
	protected function dxdsqs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode('|',$tzcode);
		//大(0)小(1)单(2)双(3)
		$bigsamll1 = $opencodes['0']>=5?0:1;       //大(0)小(1)
		$signodd1  = $opencodes['0']%2==0?3:2;     //单(2)双(3)
		$bigsamll2 = $opencodes['1']>=5?0:1;       //大(0)小(1)
		$signodd2  = $opencodes['1']%2==0?3:2;     //单(2)双(3)
		$bigsamll3 = $opencodes['2']>=5?0:1;       //大(0)小(1)
		$signodd3  = $opencodes['2']%2==0?3:2;     //单(2)双(3)
		$zjcount   = 0;

		//两种情况  1,先判断大小再决断单双 2,先判断单双再判断大小
		if(in_array($bigsamll1,explode(',',$tzcodes[0]))){      //如果第一个号码大小在数组里面
			if(in_array($bigsamll2,explode(',',$tzcodes[1]))){  //判断第二个号码大小是否在数组里面
				if(in_array($bigsamll3,explode(',',$tzcodes[2]))){  //判断第三个号码大小是否在数组里面
					$zjcount++;        //如果在就+1
				}
			}
			if(in_array($signodd2,explode(',',$tzcodes[1]))){   //判断第二个号码单双是否在数组里面
				$zjcount++;  //如果在就+1
			}
			if(in_array($signodd3,explode(',',$tzcodes[2]))){   //判断第三个号码单双是否在数组里面
				$zjcount++;  //如果在就+1
			}
		}
		if(in_array($signodd1,explode(',',$tzcodes[0]))){       //如果第一个号码单双在数组里面
			if(in_array($bigsamll2,explode(',',$tzcodes[1]))){  //判断第二个号码大小是否在数组里面
				if(in_array($bigsamll3,explode(',',$tzcodes[2]))){  //判断第三个号码大小是否在数组里面
					$zjcount++;  //如果在就+1
				}
			}
			if(in_array($signodd2,explode(',',$tzcodes[1]))){   //判断第二个号码单双是否在数组里面
				$zjcount++;
			}
			if(in_array($signodd3,explode(',',$tzcodes[2]))){   //判断第三个号码单双是否在数组里面
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//后三大小单双
	protected function dxdshs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode('|',$tzcode);
		//大(0)小(1)单(2)双(3)
		$bigsamll1 = $opencodes['0']>=5?0:1;       //大(0)小(1)
		$signodd1  = $opencodes['0']%2==0?3:2;     //单(2)双(3)
		$bigsamll2 = $opencodes['1']>=5?0:1;       //大(0)小(1)
		$signodd2  = $opencodes['1']%2==0?3:2;     //单(2)双(3)
		$bigsamll3 = $opencodes['2']>=5?0:1;       //大(0)小(1)
		$signodd3  = $opencodes['2']%2==0?3:2;     //单(2)双(3)
		$zjcount   = 0;

		//两种情况  1,先判断大小再决断单双 2,先判断单双再判断大小
		if(in_array($bigsamll1,explode(',',$tzcodes[0]))){      //如果第一个号码大小在数组里面
			if(in_array($bigsamll2,explode(',',$tzcodes[1]))){  //判断第二个号码大小是否在数组里面
				if(in_array($bigsamll3,explode(',',$tzcodes[2]))){  //判断第三个号码大小是否在数组里面
					$zjcount++;        //如果在就+1
				}
			}
			if(in_array($signodd2,explode(',',$tzcodes[1]))){   //判断第二个号码单双是否在数组里面
				$zjcount++;  //如果在就+1
			}
			if(in_array($signodd3,explode(',',$tzcodes[2]))){   //判断第三个号码单双是否在数组里面
				$zjcount++;  //如果在就+1
			}
		}
		if(in_array($signodd1,explode(',',$tzcodes[0]))){       //如果第一个号码单双在数组里面
			if(in_array($bigsamll2,explode(',',$tzcodes[1]))){  //判断第二个号码大小是否在数组里面
				if(in_array($bigsamll3,explode(',',$tzcodes[2]))){  //判断第三个号码大小是否在数组里面
					$zjcount++;  //如果在就+1
				}
			}
			if(in_array($signodd2,explode(',',$tzcodes[1]))){   //判断第二个号码单双是否在数组里面
				$zjcount++;
			}
			if(in_array($signodd3,explode(',',$tzcodes[2]))){   //判断第三个号码单双是否在数组里面
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*前直选和值 */
	protected function zhixhzqs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>28)return $zjcount;
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*中三直选和值*/
	protected function zhixhzzs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>28)return $zjcount;
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后三直选和值*/
	protected function zhixhzhs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>28)return $zjcount;
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}

	/*前二直选和值*/
	protected function zhixhzqe($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>19)return $zjcount;
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/* 后二直选和值*/
	protected function zhixhzhe($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>19)return $zjcount;
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*前三组选和值*/
	protected function zuxhzqs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>27)return $zjcount;
		$count = count(array_unique($opencodes));
		if(in_array($hezhi,$tzcodes) && $count>=2){
			$zjcount++;
		}
		return $zjcount;
	}
	/*中三组选和值 */
	protected function zuxhzzs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>27)return $zjcount;
		$count = count(array_unique($opencodes));
		if(in_array($hezhi,$tzcodes) && $count>=2){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后三组选和值*/
	protected function zuxhzhs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>27)return $zjcount;
		$count = count(array_unique($opencodes));
		if(in_array($hezhi,$tzcodes) && $count>=2){
			$zjcount++;
		}
		return $zjcount;
	}
	//前三和尾
	protected function hzwsqs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes)%10;
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		$count = count(array_unique($opencodes));
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//中三和尾
	protected function hzwszs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes)%10;
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		$count = count(array_unique($opencodes));
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//后三和尾
	protected function hzwshs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes)%10;
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		$count = count(array_unique($opencodes));
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/* 前二组选和值*/
	protected function zuxhzqe($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>17)return $zjcount;
		$count = count(array_unique($opencodes));
		if(in_array($hezhi,$tzcodes) && $count==2){
			$zjcount++;
		}
		return $zjcount;
	}
	/*后二组选和值*/
	protected function zuxhzhe($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>17)return $zjcount;
		$count = count(array_unique($opencodes));
		if(in_array($hezhi,$tzcodes) && $count==2){
			$zjcount++;
		}
		return $zjcount;
	}
	//前二和尾
	protected function hzwsqe($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes)%10;
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		$count = count(array_unique($opencodes));
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	//后二和尾
	protected function hzwshe($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes)%10;
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		$count = count(array_unique($opencodes));
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*一帆风顺*/
	protected function qwyffs($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		$count = count(array_unique($opencodes));
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*好事成双*/
	protected function qwhscs($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		foreach($tzcodes as $k=>$v){
			if($acs[$v]==2){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/* 三星报喜*/
	protected function qwsxbx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		$count = count(array_unique($opencodes));
		foreach($tzcodes as $k=>$v){
			if($acs[$v]==3){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//四季发财
	protected function qwsjfc($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		$count = count(array_unique($opencodes));
		foreach($tzcodes as $k=>$v){
			if($acs[$v]==4){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//龙虎万千
	protected function lhwq($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>3)return $zjcount;
		$lh = '';
		if($opencodes[0]>$opencodes[1]){
			$lh = '龙';
		}elseif($opencodes[0]<$opencodes[1]){
			$lh = '虎';
		}elseif($opencodes[0]==$opencodes[1]){
			$lh = '和';
		}
		if(in_array($lh,$tzcodes)){
			$zjcount++;
		}
		$return = ['zjstr'=>$lh,'zjcount'=>$zjcount];
		return $return;
	}
	//龙虎万百
	protected function lhwb($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>3)return $zjcount;
		$lh = '';
		if($opencodes[0]>$opencodes[2]){
			$lh = '龙';
		}elseif($opencodes[0]<$opencodes[2]){
			$lh = '虎';
		}elseif($opencodes[0]==$opencodes[2]){
			$lh = '和';
		}
		if(in_array($lh,$tzcodes)){
			$zjcount++;
		}
		$return = ['zjstr'=>$lh,'zjcount'=>$zjcount];
		return $return;
	}
	//龙虎万十
	protected function lhws($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>3)return $zjcount;
		$lh = '';
		if($opencodes[0]>$opencodes[3]){
			$lh = '龙';
		}elseif($opencodes[0]<$opencodes[3]){
			$lh = '虎';
		}elseif($opencodes[0]==$opencodes[3]){
			$lh = '和';
		}
		if(in_array($lh,$tzcodes)){
			$zjcount++;
		}
		$return = ['zjstr'=>$lh,'zjcount'=>$zjcount];
		return $return;
	}
	//龙虎万个
	protected function lhwg($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>3)return $zjcount;
		$lh = '';
		if($opencodes[0]>$opencodes[4]){
			$lh = '龙';
		}elseif($opencodes[0]<$opencodes[4]){
			$lh = '虎';
		}elseif($opencodes[0]==$opencodes[4]){
			$lh = '和';
		}
		if(in_array($lh,$tzcodes)){
			$zjcount++;
		}
		$return = ['zjstr'=>$lh,'zjcount'=>$zjcount];
		return $return;
	}
	//龙虎千百
	protected function lhqb($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>3)return $zjcount;
		$lh = '';
		if($opencodes[1]>$opencodes[2]){
			$lh = '龙';
		}elseif($opencodes[1]<$opencodes[2]){
			$lh = '虎';
		}elseif($opencodes[1]==$opencodes[2]){
			$lh = '和';
		}
		if(in_array($lh,$tzcodes)){
			$zjcount++;
		}
		$return = ['zjstr'=>$lh,'zjcount'=>$zjcount];
		return $return;
	}
	//龙虎千十
	protected function lhqs($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>3)return $zjcount;
		$lh = '';
		if($opencodes[1]>$opencodes[3]){
			$lh = '龙';
		}elseif($opencodes[1]<$opencodes[3]){
			$lh = '虎';
		}elseif($opencodes[1]==$opencodes[3]){
			$lh = '和';
		}
		if(in_array($lh,$tzcodes)){
			$zjcount++;
		}
		$return = ['zjstr'=>$lh,'zjcount'=>$zjcount];
		return $return;
	}
	//龙虎千个
	protected function lhqg($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>3)return $zjcount;
		$lh = '';
		if($opencodes[1]>$opencodes[4]){
			$lh = '龙';
		}elseif($opencodes[1]<$opencodes[4]){
			$lh = '虎';
		}elseif($opencodes[1]==$opencodes[4]){
			$lh = '和';
		}
		if(in_array($lh,$tzcodes)){
			$zjcount++;
		}
		$return = ['zjstr'=>$lh,'zjcount'=>$zjcount];
		return $return;
	}
	//龙虎百十
	protected function lhbs($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>3)return $zjcount;
		$lh = '';
		if($opencodes[2]>$opencodes[3]){
			$lh = '龙';
		}elseif($opencodes[2]<$opencodes[3]){
			$lh = '虎';
		}elseif($opencodes[2]==$opencodes[3]){
			$lh = '和';
		}
		if(in_array($lh,$tzcodes)){
			$zjcount++;
		}
		$return = ['zjstr'=>$lh,'zjcount'=>$zjcount];
		return $return;
	}
	//龙虎百个
	protected function lhbg($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>3)return $zjcount;
		$lh = '';
		if($opencodes[2]>$opencodes[4]){
			$lh = '龙';
		}elseif($opencodes[2]<$opencodes[4]){
			$lh = '虎';
		}elseif($opencodes[2]==$opencodes[4]){
			$lh = '和';
		}
		if(in_array($lh,$tzcodes)){
			$zjcount++;
		}
		$return = ['zjstr'=>$lh,'zjcount'=>$zjcount];
		return $return;
	}
	//龙虎十个
	protected function lhsg($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>3)return $zjcount;
		$lh = '';
		if($opencodes[3]>$opencodes[4]){
			$lh = '龙';
		}elseif($opencodes[3]<$opencodes[4]){
			$lh = '虎';
		}elseif($opencodes[3]==$opencodes[4]){
			$lh = '和';
		}
		if(in_array($lh,$tzcodes)){
			$zjcount++;
		}
		$return = ['zjstr'=>$lh,'zjcount'=>$zjcount];
		return $return;
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
	/*
	** 定位胆
	** opencode 0,1,2,3,4
	** tzcode 5,6,7,8,9|...
	*/
	protected function dweid($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0]))){
			$zjcount++;
		}
		if(in_array($opencodes[1],explode(',',$tzcodes[1]))){
			$zjcount++;
		}
		if(in_array($opencodes[2],explode(',',$tzcodes[2]))){
			$zjcount++;
		}
		if(in_array($opencodes[3],explode(',',$tzcodes[3]))){
			$zjcount++;
		}
		if(in_array($opencodes[4],explode(',',$tzcodes[4]))){
			$zjcount++;
		}
		return $zjcount;
	}
}
?>