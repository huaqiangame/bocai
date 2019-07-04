<?php
namespace Lib\yzwanfa;
class lhc{
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
	 $rx = ['tmzx','tmzx2','zmrx','zm1t','zm2t','zm3t','zm4t','zm5t','zm6t'];
	 $onestr = ['tmlmda','tmlmxiao','tmlmdan','tmlmshuang','zm1lmda','zm1lmxiao','zm1lmdan','zm1lmshuang','zm2lmda','zm2lmxiao','zm2lmdan','zm2lmshuang','zm3lmda','zm3lmxiao','zm3lmdan','zm3lmshuang','zm4lmda',
		 'zm4lmxiao','zm4lmdan','zm4lmshuang','zm5lmda','zm5lmxiao','zm5lmdan','zm5lmshuang','zm6lmda','zm6lmxiao','zm6lmdan','zm6lmshuang','sxtxshu','sxtxniu','sxtxhu','sxtxtu','sxtxlong','sxtxshe','sxtxma','sxtxyang','sxtxhou','sxtxji',
		 'sxtxgou','sxtxzhu','sx1xshu','sx1xniu','sx1xhu','sx1xtu','sx1xlong','sx1xshe','sx1xma','sx1xyang','sx1xhou','sx1xji','sx1xgou','sx1xzhu'
	 ];
	 $twostr =['tmlmdadan','tmlmdashuang','tmlmxiaodan','tmlmxiaoshuang','tmlmheda','tmlmhexiao','tmlmhedan','tmlmheshuang','tmlmweida','tmlmweixiao','tmlmjiaqin','tmlmyeshou','tmlmhongbo','tmlmlvbo','tmlmlanbo',
	 'zm1lmdadan','zm1lmdashuang','zm1lmxiaodan','zm1lmxiaoshuang','zm1lmheda','zm1lmhexiao','zm1lmhedan','zm1lmheshuang','zm1lmweida','zm1lmweixiao','zm1lmjiaqin','zm1lmyeshou','zm1lmhongbo','zm1lmlvbo','zm1lmlanbo',
	 'zm2lmdadan','zm2lmdashuang','zm2lmxiaodan','zm2lmxiaoshuang','zm2lmheda','zm2lmhexiao','zm2lmhedan','zm2lmheshuang','zm2lmweida','zm2lmweixiao','zm2lmjiaqin','zm2lmyeshou','zm2lmhongbo','zm2lmlvbo','zm2lmlanbo',
	 'zm3lmdadan','zm3lmdashuang','zm3lmxiaodan','zm3lmxiaoshuang','zm3lmheda','zm3lmhexiao','zm3lmhedan','zm3lmheshuang','zm3lmweida','zm3lmweixiao','zm3lmjiaqin','zm3lmyeshou','zm3lmhongbo','zm3lmlvbo','zm3lmlanbo',
     'zm4lmdadan','zm4lmdashuang','zm4lmxiaodan','zm4lmxiaoshuang','zm4lmheda','zm4lmhexiao','zm4lmhedan','zm4lmheshuang','zm4lmweida','zm4lmweixiao','zm4lmjiaqin','zm4lmyeshou','zm4lmhongbo','zm4lmlvbo','zm4lmlanbo',
	 'zm5lmdadan','zm5lmdashuang','zm5lmxiaodan','zm5lmxiaoshuang','zm5lmheda','zm5lmhexiao','zm5lmhedan','zm5lmheshuang','zm5lmweida','zm5lmweixiao','zm5lmjiaqin','zm5lmyeshou','zm5lmhongbo','zm5lmlvbo','zm5lmlanbo',
	 'zm6lmdadan','zm6lmdashuang','zm6lmxiaodan','zm6lmxiaoshuang','zm6lmheda','zm6lmhexiao','zm6lmhedan','zm6lmheshuang','zm6lmweida','zm6lmweixiao','zm6lmjiaqin','zm6lmyeshou','zm6lmhongbo','zm6lmlvbo','zm6lmlanbo',
	 'hongda','hongxiao','hongdan','hongshuang','lvda','lvxiao','lvdan','lvshuang','landa','lanxiao','landan','lanshuang',
	 'lingtou','yitou','ertou','santou','sitou','lingwei','yiwei','erwei','sanwei','siwei','wuwei','liuwei','qiwei','bawei','jiuwei'
	 ];
	 $threestr = ['honghedan','hongheshuang','lvhedan','lvheshuang','lanhedan','lanheshuang'];
		//连码一
	    $lm1 = ['lm3qz','lm3z2'];
		//连码二 二肖连 二尾连
	    $lm2 = ['lm2qz','lm2zt','lmtc','sx2xl','ws2wl'];
		//三肖连 三尾连
		$lm3 = ['sx3xl','ws3wl'];
		//四肖连 四尾连
		$lm4 = ['sx4xl','ws4wl'];
      //任选
		if(in_array($playid,$rx)){
			return count($this->one($tzcode));
		}
	  //onestr
		elseif(in_array($playid,$onestr)){
			 if(mb_strlen($tzcode,'UTF-8')!=1)return 0;
			 return 1;
		}
		//twostr
		elseif(in_array($playid,$twostr)){
			if(mb_strlen($tzcode,'UTF-8')!=2)return 0;
			return 1;
		}
		//threestr
		elseif(in_array($playid,$threestr)){
			if(mb_strlen($tzcode,'UTF-8')!=3)return 0;
			return 1;
		}
		//$lm1
		elseif(in_array($playid,$lm1)){
			return count($this->combination($this->one($tzcode),3));
		}
		//$lm2
		elseif(in_array($playid,$lm2)){
			return count($this->combination($this->one($tzcode),2));
		}
		//$lm3
		elseif(in_array($playid,$lm3)){
			return count($this->combination($this->one($tzcode),3));
		}
		//$lm4
		elseif(in_array($playid,$lm4)){
			return count($this->combination($this->one($tzcode),4));
		}
	    return $this->$playid($tzcode);
	 }
   function bz5bz($tzcode){
	   return count($this->combination($this->one($tzcode),5));
   }
	function bz6bz($tzcode){
		return count($this->combination($this->one($tzcode),6));
	}
	function bz7bz($tzcode){
		return count($this->combination($this->one($tzcode),7));
	}
	function bz8bz($tzcode){
		return count($this->combination($this->one($tzcode),8));
	}
	function bz9bz($tzcode){
		return count($this->combination($this->one($tzcode),9));
	}
	function bz10bz($tzcode){
		return count($this->combination($this->one($tzcode),10));
	}
	//号码过滤1
	function one($tzcode){
		$tzcode =  str_replace(array('01','02','03','04','05','06','07','08','09'),array('1','2','3','4','5','6','7','8','9'),$tzcode);
		$tzcode =  str_replace(array('猪','鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗'),array('1','2','3','4','5','6','7','8','9','10','11','12'),$tzcode);
		$tzcode =  str_replace(array('0尾','1尾','2尾','3尾','4尾','5尾','6尾','7尾','8尾','9尾'),array('1','2','3','4','5','6','7','8','9','10'),$tzcode);
		$tzcodes = explode(',',$tzcode);
		foreach($tzcodes as $k=>$v){
			if($v>49 or $v<0 or !is_numeric($v) or strpos($v,"."))unset($tzcodes[$k]);
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


}
?>