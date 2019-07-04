<?php
namespace Lib\kaijiang;
class dpc{
	/*
	 * //福彩3D 排列3
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
	** 三星直选复式
	 * $opencode="2,4,6" ;
	 * $tzcode="0,1,2,3,4,5,6,7,8,9|0,1,2,3,4,5,6,7,8,9|0,1,2,3,4,5,6,7,8,9";
	*/
	protected function pl3zxfs($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
    ** 三星直选单式
     *  $opencode="2,4,6" ;
     * $tzcode="246|345|645";
    */
	protected function pl3zxds($opencode,$tzcode){
		$opencode = implode('',explode(',',$opencode));
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/*
    ** 三星组三
     * $opencode="2,2,5"
     * $tzcode="0,1,2,3,4,5,6,7,8,9"
    */
	protected function pl3zux3($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		//2重号的号码
		$ball2 = array_search(2,$acs);
		$ball1 = array_search(1,$acs);
		if($ball1 or $ball2){
			if(count($acs)==2 && in_array($ball2,$tzcodes) && in_array($ball1,$tzcodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 三星组三单式
     *  $opencode="2,4,6" ;
     * $tzcode="246|345|645";
    */
	protected function pl3zsds($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$arc = array_count_values($opencodes);
		$zjcount   = 0;
		if(count($arc)==1)return $zjcount;
		for($i=0;$i<count($tzcodes);$i++){
			$str=preg_replace('/(.)\1+/u','$1',$tzcodes[$i]); //去掉重复字符
			if(count($arc) == strlen($str)){
				if(strstr($tzcodes[$i],$opencodes[0])>1 && strstr($tzcodes[$i],$opencodes[1])>1 && strstr($tzcodes[$i],$opencodes[2])>1){
					$zjcount++;
				};
			}
		}

		return $zjcount;
	}
	/*
    ** 三星组六
     * $opencode="2,3,6" ;
     * $tzcode="0,1,2,3,4,5,6,7,8,9";
    */
	protected function pl3zux6($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
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
	/*
    ** 三星组六单式
     * $opencode="3,4,5" ;
     * $tzcode="123|234|345|456|567|678";
    */
	protected function pl3zlds($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(count(array_count_values($opencodes))!=3)return$zjcount;
		for($i=0;$i<count($tzcodes);$i++){
			if(strstr($tzcodes[$i],$opencodes[0])>1 && strstr($tzcodes[$i],$opencodes[1])>1 && strstr($tzcodes[$i],$opencodes[2])>1){
				$zjcount++;
			};
		}
		return $zjcount;
	}
	/*
    ** 三星混合
     * $opencode="1,1,2";
     * $tzcode="112|123|234|345|456";
    */
	protected function pl3zuxhh($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(count(array_unique($opencodes))==1)return 0;//豹子号不中
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = str_split($v,1);
			if(in_array($opencodes[0],$arr) && in_array($opencodes[1],$arr) && in_array($opencodes[2],$arr)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 三星组三拖胆
	*/
	protected function pl3zux3dt($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
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
	/*
	** 三星组六拖胆
	*/
	protected function pl3zux6dt($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
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

	/*
    ** 三星组选包胆
     * $opencode="2,1,1"
     * $tzcode="1";
    */
	protected function pl3zuxbd($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$arc = array_count_values($opencodes);
		$zjcount   = 0;
		if(count($arc)==1)return $zjcount;
		$tzcodes   = array_unique(explode(',',$tzcode));
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 前二直选复式
     * $opencode="2,2,5";
     * $tzcode="2|5";
    */
	protected function pl3qx2fs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
    ** 前二直选单式
     *  $opencode="1,2,2";
     * $tzcode="12|13|34|45|56|67";
    */
	protected function pl3qx2ds($opencode,$tzcode){
		$opencodes = substr(str_replace(',','',$opencode),0,2);
		$zjcount   = substr_count($tzcode,$opencodes);
		return $zjcount;
	}
	/*
     * 前二组选复式
     * $opencode="1,3,3" ;
     * $tzcode="0,1,2,3,4,5,6,7,8,9";
    */
	protected function pl3q2zxfs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
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
	/*
    ** 前二组选单式
     * $opencode="1,3,4"
     * $tzcode="12|31|23|43|65|"
    */
	protected function pl3q2zxds($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = str_split($v,1);
			if(count($arr)==2 && count(array_diff($opencodes,$arr))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
   ** 前二组选包胆
    * $opencode="2,1,2" ;
    * $tzcode="0,1,2,3,4,5,6,7,8,9";
   */
	protected function pl3q2zxbd($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$arc = array_count_values($opencodes);
		$zjcount   = 0;
		if(count($arc)==1)return $zjcount;
		$tzcodes   = array_unique(explode(',',$tzcode));
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 后二直选复式
	*/
	protected function pl3hx2fs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 后二直选单式
	*/
	protected function pl3hx2ds($opencode,$tzcode){
		$opencodes = substr(str_replace(',','',$opencode),-2);
		$zjcount   = substr_count($tzcode,$opencodes);
		return $zjcount;
	}
	/*
	** 后二组选复式
	*/
	protected function pl3h2zxfs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
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
	/*
    ** 后二组选单式
     * $opencode="1,3,4"
     * $tzcode="12|31|23|43|65|"
    */
	protected function pl3h2zxds($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = str_split($v,1);
			if(count($arr)==2 && count(array_diff($opencodes,$arr))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
   ** 后二直选和值
     * $opencode="2,4,6" ;
     * $tzcode="0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18";
   */
	protected function pl3h2zxhz($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>19)return $zjcount;
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
    ** 后二组选和值
     * $opencode="1,3,4"
     * $tzcode="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17"
    */
	protected function pl3h2zuxhz($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($acs)==1)return$zjcount;
		if(count($tzcodes)<1 || count($tzcodes)>17)return $zjcount;
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
   ** 后二组选包胆
    * $opencode="2,1,2" ;
    * $tzcode="0,1,2,3,4,5,6,7,8,9";
   */
	protected function pl3h2zxbd($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$arc = array_count_values($opencodes);
		$zjcount   = 0;
		if(count($arc)==1)return $zjcount;
		$tzcodes   = array_unique(explode(',',$tzcode));
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
       ** 三星一码不定位
        * $opencode="1,2,3" ;
        * $tzcode="0,1,2,3,4,5,6,7,8,9";
       */
	protected function pl3ymbdw($opencode,$tzcode){
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
	/*
    ** 三星二码不定位
     * $opencode="1,3,3" ;
     * $tzcode="0,1,2,3,4,5,6,7,8,9";
    */
	protected function pl3rmbdw($opencode,$tzcode){
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
	/*
    ** 定位胆复式
    ** opencode 2,3,4
    ** tzcode 0,1,2,3,5,6,7,8,9|...
    */
	protected function pl3dwdfs($opencode,$tzcode){
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
		return $zjcount;
	}
	/*
	** 定位胆前一
	*/
	protected function pl3dwd1q($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		if(in_array($opencodes[0],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 定位胆中一
	*/
	protected function pl3dwd1z($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		if(in_array($opencodes[1],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 定位胆后一
	*/
	protected function pl3dwd1h($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		if(in_array($opencodes[2],$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
   ** 三星直选和值
     * $opencode="2,4,6" ;
     * $tzcode="0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27";
   */
	protected function pl3hzzx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>28)return $zjcount;
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
   ** 前二直选和值
     * $opencode="2,4,6" ;
     * $tzcode="0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18";
   */
	protected function pl3q2zxhz($opencode,$tzcode){
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
	/*
   ** 三星跨度
    * $opencode="2,4,6" ;
    *  $tzcode="2,4,8,9,0,1";
   */
	protected function pl3kd($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$max=max($opencodes);$min=min($opencodes);
		$num = $max-$min;
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		if(in_array($num,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
   ** 前二跨度
     * $opencode="2,4,6" ;
     * $tzcode="0,1,2,3,4,5,6,7,8,9";
   */
	protected function pl3q2kd($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$num = abs($opencodes[0]-$opencodes[1]);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		if(in_array($num,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
   ** 后二跨度
     * $opencode="2,4,6" ;
     * $tzcode="0,1,2,3,4,5,6,7,8,9";
   */
	protected function pl3h2kd($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$num = abs($opencodes[0]-$opencodes[1]);
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>10)return $zjcount;
		if(in_array($num,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
   ** 三星组选和值
     * $opencode="2,4,6" ;
     * $tzcode="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26";
   */
	protected function pl3zuxhz($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($acs)==1)return$zjcount;
		if(count($tzcodes)<1 || count($tzcodes)>26)return $zjcount;
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
    ** 前二组选和值
     * $opencode="1,3,4"
     * $tzcode="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17"
    */
	protected function pl3q2zuxhz($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($acs)==1)return$zjcount;
		if(count($tzcodes)<1 || count($tzcodes)>17)return $zjcount;
		if(in_array($hezhi,$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 和值组三
	*/
	protected function pl3hzzux3($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>26)return $zjcount;
		if(in_array($hezhi,$tzcodes) && count(array_unique($opencodes))==2){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 和值组六
	*/
	protected function pl3hzzux6($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$acs       = array_count_values($opencodes);//重号次数
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$zjcount   = 0;
		if(count($tzcodes)<1 || count($tzcodes)>22)return $zjcount;
		if(in_array($hezhi,$tzcodes) && count(array_unique($opencodes))==3){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 和值大小
	*/
	protected function pl3hzdx($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$hezhi = array_sum($opencodes);
		$bigsamll1 = $hezhi>=19?'大':'小';
		$zjcount   = 0;
		if(count($tzcodes)<1)return $zjcount;
		foreach($tzcodes as $k=>$v){
			if($v==$bigsamll1){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	//前二大小单双
	protected function dxdsq2($opencode,$tzcode){
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
	protected	function dxdsh2($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,2);
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
	/*
	** 趣味奇偶
	*/
	protected function pl3qwjo($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$jo = '';
		if($opencodes[0]%2==0 && $opencodes[1]%2==0 && $opencodes[2]%2==0){
			$jo = '偶';
		}elseif($opencodes[0]%2!=0 && $opencodes[1]%2!=0 && $opencodes[2]%2!=0){
			$jo = '奇';
		}
		$zjcount   = 0;
		if(count($tzcodes)<1)return $zjcount;
		foreach($tzcodes as $k=>$v){
			if($jo && $v==$jo){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 趣味拖拉机
	*/
	protected function pl3qwtlj($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = explode(',',$tzcode);
		$tlj = '';
		$zjcount   = 0;
		if(count($tzcodes)<1)return $zjcount;
		if(count(array_unique($opencodes))==3 && abs($opencodes[1]-$opencodes[0])==1 && abs($opencodes[1]-$opencodes[2])==1 && $tzcode=='全'){
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