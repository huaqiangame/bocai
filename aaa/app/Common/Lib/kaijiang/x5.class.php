<?php
namespace Lib\kaijiang;
class x5{
	/*
	 * 11选5
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
    ** 前三直选复式
     * $opencode="01,02,05,09,08";
     * $tzcode="01,02,03|01,02,03,04,05,06|02,03,05";
    */
	protected function x5qsfs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
    ** 前三直选单式
     * $opencode="01,02,05,09,08";
     * $tzcode="01,02,05|03,06,02|06,07,08|07,09,10";
    */
	protected function x5qsds($opencode,$tzcode){
		$opencode = implode(',',array_slice(explode(',',$opencode),0,3));
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/*
	** 中三直选复式
	*/
	protected function x5zsfs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 中三直选单式
	*/
	protected function x5zsds($opencode,$tzcode){
		$opencode = implode('',array_slice(explode(',',$opencode),1,3));
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/*
	** 后三直选复式
	*/
	protected function x5hsfs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		if(in_array($opencodes[0],explode(',',$tzcodes[0])) && in_array($opencodes[1],explode(',',$tzcodes[1])) && in_array($opencodes[2],explode(',',$tzcodes[2]))){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 后三直选单式
	*/
	protected function x5hsds($opencode,$tzcode){
		$opencode = implode('',array_slice(explode(',',$opencode),-3));
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/*
    ** 前三组选复式
     * $opencode="01,02,05,09,08";
     * $tzcode="01,02,04,05,07,09,10,11";
    */
	protected function x5qszx($opencode,$tzcode){
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
    ** 前三组选单式
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03|04,05,06|07,08,09";
    */
	protected function x5qszxds($opencode,$tzcode){
		$opencode = implode(',',array_slice(explode(',',$opencode),0,3));
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}

	/*
    ** 前三组选胆拖
     * $opencode="01,04,03,09,08";
     * $tzcode="01,02|03,04,05,06,07,08,09,10,11"
    */
	protected function x5qsdt($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,3);
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$combinations = self::combination($tuos,2);
		$zjcount   = 0;
		if(count($dans)>2 || count($dans)<1)return $zjcount;
		foreach($dans as $k=>$v){
			if(in_array($v,$opencodes)){
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
	** 中三组选复式
	*/
	protected function x5zszx($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
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
	** 中三组选胆拖
	*/
	protected function x5zsdt($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),1,3);
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$combinations = self::combination($tuos,2);
		$zjcount   = 0;
		if(count($dans)>2 || count($dans)<1)return $zjcount;
		foreach($dans as $k=>$v){
			if(in_array($v,$opencodes)){
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
	** 后三组选复式
	*/
	protected function x5hszx($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
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
	** 后三组选胆拖
	*/
	protected function x5hsdt($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-3);
		$tzcodes   = explode('|',$tzcode);
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$combinations = self::combination($tuos,2);
		$zjcount   = 0;
		if(count($dans)>2 || count($dans)<1)return $zjcount;
		foreach($dans as $k=>$v){
			if(in_array($v,$opencodes)){
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
    ** 前二直选复式
     * $opencode="01,04,03,09,08";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11|01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5qefs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode('|',$tzcode);
		$as        = explode(',',$tzcodes[0]);
		$bs        = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(in_array($opencodes[0],$as) && in_array($opencodes[1],$bs)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
    ** 前二直选单式
     * $opencode="01,02,05,09,08";
     * $tzcode="01,02|03,04";
    */
	protected function x5qeds($opencode,$tzcode){
		$opencode = implode(',',array_slice(explode(',',$opencode),0,2));
		$tzcodes   = explode('|',$tzcode);
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}

	/*
	** 后二直选复式
	*/
	protected function x5hefs($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = explode('|',$tzcode);
		$as        = explode(',',$tzcodes[0]);
		$bs        = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(in_array($opencodes[0],$as) && in_array($opencodes[1],$bs)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
	** 后二直选单式
	*/
	protected function x5heds($opencode,$tzcode){
		$opencode = implode(' ',array_slice(explode(',',$opencode),-2));
		$tzcodes   = explode(',',$tzcode);
		$zjcount   = 0;
		$zjcount   = substr_count($tzcode,$opencode);
		return $zjcount;
	}
	/*
	** 前二组选复式
	*/
	protected function x5qezx($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$combinations = self::combination($tzcodes,2);
		$zjcount   = 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
    ** 前二组选单式
     * $opencode="01,04,03,09,08";
     * $tzcode="01,04|03,04|05,06|07,08|09,10";
    */
	protected function x5qezxds($opencode,$tzcode){
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
	/*
    ** 前二组选胆拖
     * $opencode="01,04,03,09,08";
     * $tzcode="04|01,03,05,06,07,08,09,10,11";
    */
	protected function x5qedt($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),0,2);
		$tzcodes   = explode('|',$tzcode);
		$as        = explode(',',$tzcodes[0]);
		$bs        = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(count($as)!=1)return $zjcount;
		foreach($as as $k=>$v){
			if(in_array($v,$opencodes)){
				foreach($bs as $k1=>$v1){
					if($v!=$v1 && in_array($v1,$opencodes)){
						$zjcount++;
					}
				}
			}
		}
		return $zjcount;
	}
	/*
	** 后二组选复式
	*/
	protected function x5hezx($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$combinations = self::combination($tzcodes,2);
		$zjcount   = 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 后二组选胆拖
	*/
	protected function x5hedt($opencode,$tzcode){
		$opencodes = array_slice(explode(',',$opencode),-2);
		$tzcodes   = explode('|',$tzcode);
		$as        = explode(',',$tzcodes[0]);
		$bs        = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(count($as)!=1)return $zjcount;
		foreach($as as $k=>$v){
			if(in_array($v,$opencodes)){
				foreach($bs as $k1=>$v1){
					if($v!=$v1 && in_array($v1,$opencodes)){
						$zjcount++;
					}
				}
			}
		}
		return $zjcount;
	}
	/*
    ** 前三不定位
     * $opencode="06,05,08,06,03";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5bdwqs($opencode,$tzcode){
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
	/*
    ** 中三不定位
     * $opencode="06,05,08,06,03";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5bdwzs($opencode,$tzcode){
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
	** 后三不定位
	 * $opencode="06,05,08,06,03";
	 * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
	*/
	protected function x5bdwhs($opencode,$tzcode){
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
	/*
    ** 定位胆
     * $opencode="01,04,03,09,08";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11|01,02,03,04,05,06,07,08,09,10,11|01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5dwd($opencode,$tzcode){
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
    ** 任选复式一中一
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5rx1z1($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)<1)return 0;
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
    ** 任选复式二中二
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5rx2z2($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$combinations = self::combination($tzcodes,2);
		$zjcount   = 0;
		if(count($tzcodes)<2 || count($tzcodes)>11)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
    ** 任选复式三中三
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5rx3z3($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$combinations = self::combination($tzcodes,3);
		$zjcount   = 0;
		if(count($tzcodes)<3 || count($tzcodes)>11)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 任选复式四中四
     *  $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5rx4z4($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$combinations = self::combination($tzcodes,4);
		$zjcount   = 0;
		if(count($tzcodes)<4 || count($tzcodes)>11)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 任选复式五中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5rx5z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$combinations = self::combination($tzcodes,5);
		$zjcount   = 0;
		if(count($tzcodes)<5 || count($tzcodes)>11)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 任选复式六中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5rx6z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$combinations = self::combination($tzcodes,5);
		$zjcount   = 0;
		if(count($tzcodes)<5 || count($tzcodes)>11)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 任选复式七中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5rx7z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$combinations = self::combination($tzcodes,5);
		$zjcount   = 0;
		if(count($tzcodes)<5 || count($tzcodes)>11)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
    ** 任选复式八中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5rx8z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$combinations = self::combination($tzcodes,5);
		$zjcount   = 0;
		if(count($tzcodes)<5 || count($tzcodes)>11)return 0;
		foreach($combinations as $k=>$v){
			if(count(array_diff($v,$opencodes))==0){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 任选单式一中一
     * $opencode="01,02,03,09,08";
     * $tzcode="01|02|03|04|05|06|07|08|09|10|11";
    */
	protected function x5rxds1z1($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)<1)return 0;
		foreach($tzcodes as $k=>$v){
			if(in_array($v,$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
    ** 任选单式二中二
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02|03,04|05,06|07,08|09,10";
    */
	protected function x5rxds2z2($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)<1)return 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = explode(',',$v);
			if(count(array_diff($arr,$opencodes))==0 && count($arr)==2){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 任选单式三中三
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03|01,02,10|01,03,05|01,05,06|02,03,04|02,03,07|04,05,06|07,08,09";
    */
	protected function x5rxds3z3($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)<1)return 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = explode(',',$v);
			if(count(array_diff($arr,$opencodes))==0 && count($arr)==3){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 任选单式四中四
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,09|01,02,05,06|02,03,04,07|02,03,05,06|03,04,08,09|04,05,06,07";
    */
	protected function x5rxds4z4($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)<1)return 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = explode(',',$v);
			if(count(array_diff($arr,$opencodes))==0 && count($arr)==4){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 任选单式五中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,08,09|02,03,04,05,06|02,03,04,06,07";
    */
	protected function x5rxds5z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)<1)return 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = explode(',',$v);
			if(count(array_diff($opencodes,$arr))==0 && count($arr)==5){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
    ** 任选单式六中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,09,08,10|01,02,07,08,10,11|02,03,04,05,07,08|02,03,04,05,08,09";
    */
	protected function x5rxds6z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)<1)return 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = explode(',',$v);
			if(count(array_diff($opencodes,$arr))==0 && count($arr)==6){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 任选单式七中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,04,05,06,10|01,02,03,06,07,08,09|02,03,04,05,06,07,11|02,03,04,07,08,10,11";
    */
	protected function x5rxds7z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)<1)return 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = explode(',',$v);
			if(count(array_diff($opencodes,$arr))==0 && count($arr)==7){
				$zjcount++;
			}
		}
		return $zjcount;
	}

	/*
    ** 任选单式八中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01,02,03,08,09,06,10,11|05,02,03,06,07,08,09,10|02,03,04,05,06,07,08,09";
    */
	protected function x5rxds8z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$zjcount   = 0;
		if(count($tzcodes)<1)return 0;
		foreach($tzcodes as $k=>$v){
			$arr = [];
			$arr = explode(',',$v);
			if(count(array_diff($opencodes,$arr))==0 && count($arr)==8){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
       ** 胆拖二中二
        * $opencode="01,01,03,09,08";
        * $tzcode="01|02,03,04,05,06,07,08,09,10,11";
       */
	protected function x5dt2z2($opencode,$tzcode){
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
//		$zjcount>=1?$zjcount=1:$zjcount=0;  //全选只能一注中;
		return $zjcount;
	}
	/*
        ** 胆拖三中三
         * $opencode="01,01,03,09,08";
         * $tzcode="01|02,03,04,05,06,07,08,09,10,11";
        */
	protected function x5dt3z3($opencode,$tzcode){
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
			if(count(array_diff($opencodes,$v))==2 && count($v)==3 && in_array($v[0],$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*	protected function x5dt3z3($opencode,$tzcode)
        {
            $opencodes = explode(',', $opencode);
            $tzcodes = array_unique(explode('|', $tzcode));
            $dans = explode(',', $tzcodes[0]);
            $tuos = explode(',', $tzcodes[1]);
            $zjcount = 0;
            $combinations = self::combination($tuos, 2); //拖胆组合
            $jiao = array_intersect($opencodes, $tuos); //获取开奖号码拖胆
            $opencodejj = self::combination($jiao, 2);     //开奖号码组合
            foreach ($opencodejj as $o) {
                if ($o[0] != null) {
                    foreach ($combinations as $v) {
                        if (count(array_diff($o, $v)) == 0 && count($v) == 2) {
                            $zjcount++;
                        }
                    }
                }
            }
            return $zjcount;
        }*/
	/*
       ** 胆拖四中四
        * $opencode="01,02,03,09,08";
        * $tzcode="01|02,03,04,05,06,07,08,09,10,11";
       */
	protected function x5dt4z4($opencode,$tzcode){
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
			if(count(array_diff($v,$opencodes))==0 && count($v)==4 && in_array($v[0],$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;

	}

	/*
    ** 胆拖五中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01|02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5dt5z5($opencode,$tzcode){
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
			if(count(array_diff($opencodes,$v))==0 && count($v)==5 && in_array($v[0],$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
    ** 胆拖六中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01|02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5dt6z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(count($dans)<1 || count($dans)>5)return 0;
		$len = 6-count($dans);
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
			if(count(array_diff($opencodes,$v))==0 && count($v)==6 && in_array($v[0],$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
    ** 胆拖七中五
     * $opencode="01,02,03,09,08";
     * $tzcode="01|02,03,04,05,06,07,08,09,10,11";
    */
	protected function x5dt7z5($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(count($dans)<1 || count($dans)>6)return 0;
		$len = 7-count($dans);
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
			if(count(array_diff($opencodes,$v))==0 && count($v)==7 && in_array($v[0],$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
	** 胆拖八中五
	*/
	protected function x5dt8z5($opencode,$tzcode){
		$opencode = '01,02,05,08,09';
		$tzcode = '01,02,03|04,05,06,07,08,09,10,11';
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode('|',$tzcode));
		$dans      = explode(',',$tzcodes[0]);
		$tuos      = explode(',',$tzcodes[1]);
		$zjcount   = 0;
		if(count($dans)<1 || count($dans)>7)return 0;
		$len = 8-count($dans);
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
			if(count(array_diff($opencodes,$v))==0 && count($v)==8 && in_array($v[0],$opencodes)){
				$zjcount++;
			}
		}
		return $zjcount;
	}
	/*
    ** 趣味定单双
    */
	protected function x5dds($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		$zjcount = 0;
		$evens =[];
		$odds  =[];
		foreach($opencodes as $k=>$v){
			if($v%2==0){
				$evens[] = $v;
			}else{
				$odds[] = $v;
			}
		}
		$resstr = '';
		switch(count($evens)){
			case"0":
				$resstr = '5单0双';
				break;
			case"1":
				$resstr = '4单1双';
				break;
			case"2":
				$resstr = '3单2双';
				break;
			case"3":
				$resstr = '2单3双';
				break;
			case"4":
				$resstr = '1单4双';
				break;
			case"5":
				$resstr = '0单5双';
				break;
		}
		if(in_array(count($evens),$tzcodes)){
			$zjcount++;
		}
		return $zjcount;
	}
	/*
    ** 趣味猜中位
     * $opencode="01,02,03,09,08";
     * $tzcode="03,04,05,06,07,08,09";
    */
	protected function x5czw($opencode,$tzcode){
		$opencodes = explode(',',$opencode);
		$tzcodes   = array_unique(explode(',',$tzcode));
		sort($opencodes);
		$zhongwei = $opencodes[2];
		dump($zhongwei);
		$zjcount = 0;
		if(in_array($zhongwei,$tzcodes)){
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