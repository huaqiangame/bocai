<?php
namespace Lib\yzwanfa;
class x5{
	/*
	** 二维数组
	** $params 二维数组
	** 字段列表 必须包含
	** typeid 彩票种类（ssc,k3,Game,kl10f,pk10,keno,xy28）
	** playid 玩法标识
	** tzcode 投注号码
	*/

	public $balld=[];
	public $ballt=[];
	public $d_count;
	public $t_count;
	public $itemcount;
	public $b;
	function __construct($params = []){
		$this->params = $params;
	}
	function checkzhushu($playid,$tzcode){
	 $ds = ['x5qsds','x5qszxds','x5qeds','x5qezxds','x5rxds1z1','x5rxds2z2','x5rxds3z3','x5rxds4z4','x5rxds5z5','x5rxds6z5','x5rxds7z5','x5rxds8z5'];
	 $num2=['x5qezx'];
	 $num3=['x5qszx'];
	 $x5rx=['x5rx1z1','x5rx2z2','x5rx3z3','x5rx4z4','x5rx5z5','x5rx6z5','x5rx7z5','x5rx8z5'];
      //单式
		if(in_array($playid,$ds))return $this->ds($tzcode);
      //其它
		if(in_array($playid,$num2))return count($this->combination(array_unique($this->one($tzcode)),2));
		if(in_array($playid,$num3))return count($this->combination(array_unique($this->one($tzcode)),3));
		//任选复式
		if(in_array($playid,$x5rx)){
			$num = substr($playid,4,1);
			return count($this->combination($this->one($tzcode),$num));
		}
	    return $this->$playid($tzcode);
	}

	//前三直选复式
	function x5qsfs($tzcode){
		$ballw = [];
		$ballq = [];
		$ballb = [];
		$currNumber = $this->two($tzcode);
		for($ss = 0; $ss< count($currNumber); $ss++){
			for($sss = 0; $sss < count($currNumber[$ss]); $sss++){
				if($ss == 0){
					$ballw[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 1){
					$ballq[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 2){
					$ballb[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}
			}
    }
    $itemcount = 0;
    for ($i = 0; $i < end($ballw)+1; $i++) {
			for ($j = 0; $j < end($ballq)+1; $j++) {
				for ($k = 0; $k < end($ballb)+1; $k++) {
					if($ballw[$i]!=""&&$ballq[$j]!=""&&$ballb[$k]!=""){
						if ($ballw[$i] != $ballq[$j] && $ballw[$i] != $ballb[$k] && $ballq[$j] != $ballb[$k]) {
							$itemcount++;
						}
					}
				}
        }
    }
    return $itemcount;
  }
	//前二直选复式
	function x5qefs($tzcode){
		$ballw = [];
		$ballq = [];
		$currNumber = $this->two($tzcode);
		for($ss = 0; $ss< count($currNumber); $ss++){
			for($sss = 0; $sss < count($currNumber[$ss]); $sss++){
				if($ss == 0){
					$ballw[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 1){
					$ballq[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}
			}
    }
    $itemcount = 0;
    for ($i = 0; $i < end($ballw)+1; $i++) {
			for ($j = 0; $j < end($ballq)+1; $j++) {
				if($ballw[$i]!=""&&$ballq[$j]!=""){
					if ($ballw[$i] != $ballq[$j]) {
						$itemcount++;
					}
				}
			}
    }
    return $itemcount;
  }
    //前三组选胆拖
	function x5qsdt($tzcode){
		$balld = [];
		$ballt = [];
		$currNumber = $this->two($tzcode);
		for($ss = 0; $ss< count($currNumber); $ss++){
			for($sss = 0; $sss < count($currNumber[$ss]); $sss++){
				if($ss == 0){
					$balld[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 1){
					$ballt[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}
			}
    }
    $d_count=count($currNumber[0]);
    $t_count=count($currNumber[1]);
    $itemcount=0;
    $b=true;
    for ($i = 0; $i < count($ballt); $i++) {
			if($ballt[$i]!=""){
				for($j=0;$j<count($balld);$j++)
              if($ballt[$i]==$balld[$j]&&$balld[$j]!=null){
				  $b=false;
				  break;
			  }
      }
		}
    if($b){
		if($d_count==1&&$t_count>1){
			$itemcount=$t_count*($t_count-1)/2;
		}
		if($d_count==2&&$t_count>=1){
			$itemcount=$t_count;
		}
	}
    return $itemcount;
  }
    //前二组选胆拖
	function x5qedt($tzcode){
		$balld = [];
		$ballt = [];
		$currNumber = $this->two($tzcode);
		for($ss = 0; $ss< count($currNumber); $ss++){
			for($sss = 0; $sss < count($currNumber[$ss]); $sss++){
				if($ss == 0){
					$balld[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 1){
					$ballt[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}
			}
    }

    $d_count=count($currNumber[0]);
    $t_count=count($currNumber[1]);

    $itemcount=0;
    $b=true;
    for ($i = 0; $i < end($ballt)+1; $i++) {
			if($ballt[$i]!=""){
				for($j=0;$j<end($balld)+1;$j++)
              if($ballt[$i]==$balld[$j]&&$balld[$j]!=null){
				  $b=false;
				  break;
			  }
      }
		}
    if($b){
		if($d_count==1&&$t_count>=1){
			$itemcount= $t_count ;
		}
	}

    return $itemcount;
  }
	//不定位
	function x5bdwqs($tzcode){
		return count($this->one($tzcode));
	}
	//定位胆复式
	function x5dwd($tzcode){
		$tzcodes = explode('|',$tzcode);
		$tzcount=0;
		foreach($tzcodes as $v){
			if(!empty($v)){
				$tzcount += count(explode(',',$v));
			}
		}
		return $tzcount ;
	}
	//定单双
	function x5dds($tzcode){
		$tzcodes = explode(',',$tzcode);
		foreach($tzcodes as $k=>$v){
			if($v>5 or $v<0 or !is_numeric($v) or strpos($v,"."))unset($tzcodes[$k]);
		}
		return count($tzcodes);
	}
	//猜中位
	function x5czw($tzcode){
		return count($this->one($tzcode));
	}
	//胆拖二中二
	function x5dt2z2($tzcode){
		$this->dt($tzcode);
		if($this->b){
			if($this->d_count==1&&$this->t_count>=1){
				$this->itemcount=$this->t_count;
			}
		}
		return $this->itemcount;
	}
	//胆拖三中三
	function x5dt3z3($tzcode){
		$this->dt($tzcode);
		if($this->b){
			if($this->d_count==1&&$this->t_count>1){
				$this->itemcount=$this->t_count*($this->t_count-1)/2;
			}
			if($this->d_count==2&&$this->t_count>=1){
				$this->itemcount=$this->t_count;
			}
		}
		return $this->itemcount;
	}
	//胆拖四中四
	function x5dt4z4($tzcode){
		$selected_d_ball_array = [];
		$selected_t_ball_array = [];
		$currNumber = $this->two($tzcode);
		for($ss = 0; $ss<count( $currNumber); $ss++){
			for($sss = 0; $sss < count($currNumber[$ss]); $sss++){
				if($ss == 0){
					$selected_d_ball_array[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 1){
					$selected_t_ball_array[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}
			}
    }

    $d_count=count($currNumber[0]);
    $t_count=count($currNumber[1]);

    $itemcount=0;

    if($d_count<=3&&$d_count>0){

		$op_flag=false;

		for($oo=0;$oo<count($selected_d_ball_array);$oo++){

			$temp_o_d_ball_number=$selected_d_ball_array[$oo];

			if($temp_o_d_ball_number!=""){

				for($mm=0;$mm<count($selected_t_ball_array);$mm++){

					$temp_o_t_ball_number=$selected_t_ball_array[$mm];

					if($temp_o_t_ball_number!=""){
						 if($temp_o_d_ball_number==$temp_o_t_ball_number){
							$op_flag=true;
							break;
						 }
					}
				}
        }

			if($op_flag==true){
				break;
			}
		}

      if($op_flag==false){
		  if($d_count==1){
			  if($t_count>=3){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)/(3*2);
			  }
		  } else if($d_count==2){
			  if($t_count>=2){
				  $itemcount=$t_count*($t_count-1)/2;
			  }
		  } else if($d_count==3){
			  if($t_count>=1){
				  $itemcount=$t_count;
			  }
		  }
	  }
    }
    return $itemcount;
  }
	//胆拖五中五
	function x5dt5z5($tzcode) {
		$selected_d_ball_array = [];
		$selected_t_ball_array = [];
		$currNumber = $this->two($tzcode);
		for($ss = 0; $ss< count($currNumber); $ss++){
			for($sss = 0; $sss < count($currNumber[$ss]); $sss++){
				if($ss == 0){
					$selected_d_ball_array[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 1){
					$selected_t_ball_array[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}
			}
    }

    $d_count=count($currNumber[0]);
    $t_count=count($currNumber[1]);

    $itemcount=0;

    if($d_count<=4&&$d_count>0){

		$op_flag=false;

		for($oo=0;$oo<count($selected_d_ball_array);$oo++){

			$temp_o_d_ball_number=$selected_d_ball_array[$oo];

			if($temp_o_d_ball_number!=""){

				for($mm=0;$mm<count($selected_t_ball_array);$mm++){

					$temp_o_t_ball_number=$selected_t_ball_array[$mm];

					if($temp_o_t_ball_number!=""){
						if($temp_o_d_ball_number==$temp_o_t_ball_number){

							$op_flag=true;
							break;
						}
					}
				}
        }

			if($op_flag==true){
				break;
			}
		}

      if($op_flag==false){
		  if($d_count==1){
			  if($t_count>=4){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)*($t_count-3)/(4*3*2);
			  }
		  } else if($d_count==2){
			  if($t_count>=3){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)/(3*2);
			  }
		  } else if($d_count==3){
			  if($t_count>=2){
				  $itemcount=$t_count*($t_count-1)/2;
			  }
		  } else if($d_count==4){
			  if($t_count>=1){
				  $itemcount=$t_count;
			  }
		  }
	  }
    }

    return $itemcount;
  }
	//胆拖六中五
	function x5dt6z5($tzcode) {
		$selected_d_ball_array = [];
		$selected_t_ball_array = [];
		$currNumber = $this->two($tzcode);
		for($ss = 0; $ss< count($currNumber); $ss++){
			for($sss = 0; $sss < count($currNumber[$ss]); $sss++){
				if($ss == 0){
					$selected_d_ball_array[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 1){
					$selected_t_ball_array[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}
			}
    }
    $d_count=count($currNumber[0]);
    $t_count=count($currNumber[1]);
    $itemcount=0;
    if($d_count<=5&&$d_count>0){
		$op_flag=false;
		for($oo=0;$oo<count($selected_d_ball_array);$oo++){
			$temp_o_d_ball_number=$selected_d_ball_array[$oo];
			if($temp_o_d_ball_number!=""){
				for($mm=0;$mm<count($selected_t_ball_array);$mm++){
					$temp_o_t_ball_number=$selected_t_ball_array[$mm];
					if($temp_o_t_ball_number!=""){
						if($temp_o_d_ball_number==$temp_o_t_ball_number){
							$op_flag=true;
							break;
						}
					}
				}
        }
			if($op_flag==true){
				break;
			}
		}

      if($op_flag==false){
		  if($d_count==1){
			  if($t_count>=5){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)*($t_count-3)*($t_count-4)/(5*4*3*2);
			  }
		  } else if($d_count==2){
			  if($t_count>=4){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)*($t_count-3)/(4*3*2);
			  }
		  } else if($d_count==3){
			  if($t_count>=3){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)/(3*2);
			  }
		  } else if($d_count==4){
			  if($t_count>=2){
				  $itemcount=$t_count*($t_count-1)/2;
			  }
		  } else if($d_count==5){
			  if($t_count>=1){
				  $itemcount=$t_count;
			  }
		  }
	  }
    }

    return $itemcount;
  }
	//胆拖七中五
	function x5dt7z5($tzcode){
		$selected_d_ball_array = [];
		$selected_t_ball_array = [];
		$currNumber = $this->two($tzcode);
		for($ss = 0; $ss< count($currNumber); $ss++){
			for($sss = 0; $sss < count($currNumber[$ss]); $sss++){
				if($ss == 0){
					$selected_d_ball_array[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 1){
					$selected_t_ball_array[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}
			}
    }

    $d_count=count($currNumber[0]);
    $t_count=count($currNumber[1]);

    $itemcount=0;

    if($d_count<=6&&$d_count>0){
		$op_flag=false;
		for($oo=0;$oo<count($selected_d_ball_array);$oo++){
			$temp_o_d_ball_number=$selected_d_ball_array[$oo];
			if($temp_o_d_ball_number!=""){
				for($mm=0;$mm<count($selected_t_ball_array);$mm++){
					$temp_o_t_ball_number=$selected_t_ball_array[$mm];
					if($temp_o_t_ball_number!=""){
						if($temp_o_d_ball_number==$temp_o_t_ball_number){
							$op_flag=true;
							break;
						}
					}
				}
        }

			if($op_flag==true){
				break;
			}
		}

      if($op_flag==false){
		  if($d_count==1){
			  if($t_count>=6){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)*($t_count-3)*($t_count-4)*($t_count-5)/(6*5*4*3*2);
			  }
		  } else if($d_count==2){
			  if($t_count>=5){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)*($t_count-3)*($t_count-4)/(5*4*3*2);
			  }
		  } else if($d_count==3){
			  if($t_count>=4){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)*($t_count-3)/(4*3*2);
			  }
		  } else if($d_count==4){
			  if($t_count>=3){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)/(3*2);
			  }
		  } else if($d_count==5){
			  if($t_count>=2){
				  $itemcount=$t_count*($t_count-1)/2;
			  }
		  } else if($d_count==6){
			  if($t_count>=1){
				  $itemcount=$t_count;
			  }
		  }
	  }
    }

    return $itemcount;
  }
	//胆拖八中五
	function x5dt8z5($tzcode) {
		$selected_d_ball_array = [];
		$selected_t_ball_array = [];
		$currNumber = $this->two($tzcode);
		for($ss = 0; $ss< count($currNumber); $ss++){
			for($sss = 0; $sss < count($currNumber[$ss]); $sss++){
				if($ss == 0){
					$selected_d_ball_array[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 1){
					$selected_t_ball_array[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}
			}
    }
    $d_count=count($currNumber[0]);
    $t_count=count($currNumber[1]);
    $itemcount=0;

    if($d_count<=7&&$d_count>0){
		$op_flag=false;
		for($oo=0;$oo<count($selected_d_ball_array);$oo++){
			$temp_o_d_ball_number=$selected_d_ball_array[$oo];
			if($temp_o_d_ball_number!=""){
				for($mm=0;$mm<count($selected_t_ball_array);$mm++){
					$temp_o_t_ball_number=$selected_t_ball_array[$mm];
					if($temp_o_t_ball_number!=""){
						if($temp_o_d_ball_number==$temp_o_t_ball_number){
							$op_flag=true;
							break;
						}
					}
				}
        }
			if($op_flag==true){
				break;
			}
		}

      if($op_flag==false){
		  if($d_count==1){
			  if($t_count>=7){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)*($t_count-3)*($t_count-4)*($t_count-5)*($t_count-6)/(7*6*5*4*3*2);
			  }
		  } else if($d_count==2){
			  if($t_count>=6){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)*($t_count-3)*($t_count-4)*($t_count-5)/(6*5*4*3*2);
			  }
		  } else if($d_count==3){
			  if($t_count>=5){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)*($t_count-3)*($t_count-4)/(5*4*3*2);
			  }
		  } else if($d_count==4){
			  if($t_count>=4){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)*($t_count-3)/(4*3*2);
			  }
		  } else if($d_count==5){
			  if($t_count>=3){
				  $itemcount=$t_count*($t_count-1)*($t_count-2)/(3*2);
			  }
		  } else if($d_count==6){
			  if($t_count>=2){
				  $itemcount=$t_count*($t_count-1)/2;
			  }
		  } else if($d_count==7){
			  if($t_count>=1){
				  $itemcount=$t_count;
			  }
		  }
	  }
    }
    return $itemcount;
  }
   //单排号码过滤
	function one($tzcode){
		$tzcode =  str_replace(array('01','02','03','04','05','06','07','08','09'),array('1','2','3','4','5','6','7','8','9'),$tzcode);
	    $tzcodes = explode(',',$tzcode);
		foreach($tzcodes as $k=>$v){
			if($v>11 or $v<1 or !is_numeric($v) or strpos($v,"."))unset($tzcodes[$k]);
		}
		return $tzcodes;
	}
   //多排号码过滤
	function two($tzcode){
		$tzcodes = explode('|',$tzcode);
		foreach($tzcodes as $k => $v){
			if(empty($v))return 0;
			$val =  str_replace(array('01','02','03','04','05','06','07','08','09'),array('1','2','3','4','5','6','7','8','9'),$v);
            $arr=explode(',',$val);
			if(count($arr) != count(array_unique($arr)))return 0;
			foreach($arr as $key => $val){
				if($val>11 or $val<=0 or !is_numeric($val) or strpos($val,".")){
					return 0;
				};
			}
			$result[] = $arr;
		}
		return $result ;
	}
	//单式
	function ds($tzcode){
		return count(explode('|',$tzcode));
	}
	function dt($tzcode){
		$currNumber = $this->two($tzcode);
		for($ss = 0; $ss< count($currNumber); $ss++){
			for($sss = 0; $sss < count($currNumber[$ss]); $sss++){
				if($ss == 0){
					$this->balld[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}else if($ss == 1){
					$this->ballt[$currNumber[$ss][$sss]] = $currNumber[$ss][$sss];
				}
			}
		}
		$this->d_count=count($currNumber[0]);
		$this->t_count=count($currNumber[1]);
		$this->itemcount=0;
		$this->b=true;
		for ($i = 0; $i < end($this->ballt)+1; $i++) {
			if($this->ballt[$i]!=""){
				for($j=0;$j< end($this->balld)+1;$j++)
					if($this->ballt[$i]==$this->balld[$j]&&$this->balld[$j]!=null){
						$this->b=false;
						break;
					}
			}
		}
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