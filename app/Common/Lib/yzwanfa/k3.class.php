<?php
namespace Lib\yzwanfa;
class k3{
	/*
	** 二维数组
	** $params 二维数组
	** 字段列表 必须包含
	** typeid 彩票种类（ssc,k3,Game,kl10f,pk10,keno,xy28）
	** playid 玩法标识
	** tzcode 投注号码
	*/

function checkzhushu($playid,$tzcode){
	return $this->$playid($tzcode);
 }
function k3hz3($tzcode){
 if($tzcode!=3)return 0;
	return 1;
}
function k3hz4($tzcode){
	if($tzcode!=4)return 0;
	return 1;
}
function k3hz5($tzcode){
	if($tzcode!=5)return 0;
	return 1;
}
function k3hz6($tzcode){
	if($tzcode!=6)return 0;
	return 1;
}
function k3hz7($tzcode){
	if($tzcode!=7)return 0;
	return 1;
}
function k3hz8($tzcode){
	if($tzcode!=8)return 0;
	return 1;
}
function k3hz9($tzcode){
	if($tzcode!=9)return 0;
	return 1;
}
function k3hz10($tzcode){
	if($tzcode!=10)return 0;
	return 1;
}
function k3hz11($tzcode){
	if($tzcode!=11)return 0;
	return 1;
}
function k3hz12($tzcode){
	if($tzcode!=12)return 0;
	return 1;
}
function k3hz13($tzcode){
	if($tzcode!=13)return 0;
	return 1;
}
function k3hz14($tzcode){
	if($tzcode!=14)return 0;
	return 1;
}
function k3hz15($tzcode){
	if($tzcode!=15)return 0;
	return 1;
}
function k3hz16($tzcode){
	if($tzcode!=16)return 0;
	return 1;
}
function k3hz17($tzcode){
	if($tzcode!=17)return 0;
	return 1;
}
function k3hz18($tzcode){
	if($tzcode!=18)return 0;
	return 1;
}
function k3hzbig($tzcode){
	if($tzcode!='大')return 0;
	return 1;
}
function k3hzsmall($tzcode){
	if($tzcode!='小')return 0;
	return 1;
}
function k3hzodd($tzcode){
	if($tzcode!='单')return 0;
	return 1;
}
function k3hzeven($tzcode){
	if($tzcode!='双')return 0;
	return 1;
}
//二同号复选
function k3ethfx($tzcode){
	$tzcodes = explode('#',$tzcode);
	foreach($tzcodes as $v){
		if(strlen($v)!=2) return 0;
		$arr[0]=substr($v,0,1);$arr[1]=substr($v,1,1);
		$arr = $this->one($arr);
		if($arr == 0)return 0;
		if($arr[0]!=$arr[1]){
			return 0;
		}
	}
	return count($tzcodes);
}
//二同号单选
function k3ethdx($tzcode){
	$tzcodes = explode('#',$tzcode);
	foreach($tzcodes as $v){
		if(strlen($v)!=3) return 0;
		$arr[0]=substr($v,0,1);$arr[1]=substr($v,1,1);$arr[2]=substr($v,2,1);
		 if(count(array_unique($arr))!=2)return 0;
		$arr = $this->one($arr);
		if($arr == 0)return 0; 
	}
	return count($tzcodes);
}
//二不同号
function k3ebthbz($tzcode){
	$tzcodes = explode('#',$tzcode);
	foreach($tzcodes as $v){
		$arr = explode(',',$v);
		$arr = $this->one($arr);
		if(count(array_unique($arr))!=2){
			return 0;
		}
	}
	return count($tzcodes);

}
//三同号单选
function k3sthdx($tzcode){
	$tzcodes = explode('#',$tzcode);
   return count($tzcodes);
}
//三同号通选
function k3sthtx($tzcode){
	if($tzcode!='三同号通选')return 0;
	return 1;
}
//三不同号
function k3sbthbz($tzcode){
	$tzcodes = explode('#',$tzcode);
	foreach($tzcodes as $v){
		$arr = explode(',',$v);
		$arr = $this->one($arr);
		if(count(array_unique($arr))!=3){
			return 0;
		}
	}
  return count($tzcodes);
}
//三连号通选
function k3slhtx($tzcode){
	if($tzcode!='三连号通选')return 0;
	return 1;

}
//三连号单选
function k3slhdx($tzcode){
	$tzcodes = explode('#',$tzcode);
	foreach($tzcodes as $v){
		 if(strlen($v)!=3) return 0;
		$arr[0]=substr($v,0,1);$arr[1]=substr($v,1,1);$arr[2]=substr($v,2,1);
		$arr = $this->one($arr);
		if(abs($arr[1]-$arr[1])!=1 && abs($arr[1]-$arr[2])!=1){
			return 0;
		}
	}
	return count($tzcodes);
}
//号码过滤1
function one($tzcode){
	foreach($tzcode as $k=>$v){
		if($v>6 or $v<0 or !is_numeric($v) or strpos($v,"."))return 0;
	}
	return $tzcode;
}
}
?>