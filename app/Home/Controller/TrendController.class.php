<?php
namespace Home\Controller;
use Think\Controller;
class TrendController extends CommonController {
	public function __construct(){
		parent::__construct();
		if(!$this->userinfo){
			redirect(U("Public/login"));
		};
	}

function trend_k3(){
		$lotteryname = I('code','jsk3');
		$this->assign('lotteryname',$lotteryname);
		$num = I('num',30,'intval');
		$_api = new \Lib\api;
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['num'] = $num;
		$Result = $_api->sendHttpClient('Api/Lottery/lotteryopencodes',$apiparam);
		$this->assign('cptitle',$Result['data'][0]['title']);
		$html = '';$allballs = [1,2,3,4,5,6];
		if($Result['sign'] && count($Result['data'])>=1){
			foreach($Result['data'] as $k=>$v){
				$balls = explode(',',$v['opencode']);
				$countarray = array_count_values($balls);
				$sum   = 0;$sum = array_sum($balls);
				$bigsmall = $sum>10?'大':'小';
				$oddeven  = $sum%2==0?'双':'单';
				$html .= '<tr class="text-c">';
				$html .= '<td height="40">'.$v['expect'].'</td>';
				$html .= '<td class="c_ba2636"><b>'.$balls[0].'</b></td>';
				$html .= '<td class="c_ba2636"><b>'.$balls[1].'</b></td>';
				$html .= '<td class="c_ba2636"><b>'.$balls[2].'</b></td>';
				for($i=1;$i<=6;$i++){
					if(in_array($i,$balls)){
						if($countarray[$i]==2)
							$html .= '<td class="ball_red"><div class="s_ball">2</div><i>'.$i.'</i></td>';
						else
							$html .= '<td class="ball_red">'.$i.'</td>';
					}else{
						$html .= '<td class="f_green">'.$i.'</td>';
					}
				}

				/*$html .= '<td class="f_green">1</td>';
				$html .= '<td class="ball_red"><div class="s_ball">2</div><i>5</i></td>';
				$html .= '<td class="bg_green js-fold">3</td>';
				$html .= '<td class="f_green">4</td>';
				$html .= '<td class="f_green">5</td>';
				$html .= '<td class="f_green">6</td>';*/
				if($bigsmall=='大'){
					$html .= '<td class="bg_orange js-fold">大</td>';
					$html .= '<td class="f_brown">小</td>';
				}else{
					$html .= '<td class="f_brown">大</td>';
					$html .= '<td class="bg_orange js-fold">小</td>';
				}
				if($oddeven=='双'){
					$html .= '<td class="bg_orange js-fold">双</td>';
					$html .= '<td class="f_brown">单</td>';
				}else{
					$html .= '<td class="f_brown">双</td>';
					$html .= '<td class="bg_orange js-fold">单</td>';
				}
				$class = 'f_green js-omit-m';
				$class = 'f_green js-omit-m';
				if($sum==3){$class3 = 'bg_green js-fold';}else{$class3 = $class;}
				if($sum==4){$class4 = 'bg_green js-fold';}else{$class4 = $class;}
				if($sum==5){$class5 = 'bg_green js-fold';}else{$class5 = $class;}
				if($sum==6){$class6 = 'bg_green js-fold';}else{$class6 = $class;}
				if($sum==7){$class7 = 'bg_green js-fold';}else{$class7 = $class;}
				if($sum==8){$class8 = 'bg_green js-fold';}else{$class8 = $class;}
				if($sum==9){$class9 = 'bg_green js-fold';}else{$class9 = $class;}
				if($sum==10){$class10 = 'bg_green js-fold';}else{$class10 = $class;}
				if($sum==11){$class11 = 'bg_green js-fold';}else{$class11 = $class;}
				if($sum==12){$class12 = 'bg_green js-fold';}else{$class12 = $class;}
				if($sum==13){$class13 = 'bg_green js-fold';}else{$class13 = $class;}
				if($sum==14){$class14 = 'bg_green js-fold';}else{$class14 = $class;}
				if($sum==15){$class15 = 'bg_green js-fold';}else{$class15 = $class;}
				if($sum==16){$class16 = 'bg_green js-fold';}else{$class16 = $class;}
				if($sum==17){$class17 = 'bg_green js-fold';}else{$class17 = $class;}
				if($sum==18){$class18 = 'bg_green js-fold';}else{$class18 = $class;}
					
				$html .= '<td class="'.$class3.'">3</td>';
				$html .= '<td class="'.$class4.'">4</td>';
				$html .= '<td class="'.$class5.'">5</td>';
				$html .= '<td class="'.$class6.'">6</td>';
				$html .= '<td class="'.$class7.'">7</td>';
				$html .= '<td class="'.$class8.'">8</td>';
				$html .= '<td class="'.$class9.'">9</td>';
				$html .= '<td class="'.$class10.'">10</td>';
				$html .= '<td class="'.$class11.'">11</td>';
				$html .= '<td class="'.$class12.'">12</td>';
				$html .= '<td class="'.$class13.'">13</td>';
				$html .= '<td class="'.$class14.'">14</td>';
				$html .= '<td class="'.$class15.'">15</td>';
				$html .= '<td class="'.$class16.'">16</td>';
				$html .= '<td class="'.$class17.'">17</td>';
				$html .= '<td class="'.$class18.'">18</td>';
				$html .= '</tr>';
			}
		}
		$this->assign('trendhtml',$html);
		$this->display('Game_trend_k3');
	}
function trend_ssc(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$num = I('num',30,'intval');
		$_api = new \Lib\api;
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['num'] = $num;
		$Result = $_api->sendHttpClient('Api/Lottery/lotteryopencodes',$apiparam);
		$this->assign('cptitle',$Result['data'][0]['title']);
		$html = '';$allballs = [0,1,2,3,4,5,6,7,8,9];
		if($Result['sign'] && count($Result['data'])>=1){
			foreach($Result['data'] as $k=>$v){
				$balls = explode(',',$v['opencode']);
				$countarray = array_count_values($balls);
				$sum   = 0;$sum = array_sum($balls);
				$bigsmall = $sum>10?'大':'小';
				$oddeven  = $sum%2==0?'双':'单';
				$html .= '<tr class="text-c">';
				$html .= '<td height="40">'.$v['expect'].'</td>';
				$html .= '<td width="20" class="c_ba2636"><b>'.$balls[0].'</b></td>';
				$html .= '<td width="20" class="c_ba2636"><b>'.$balls[1].'</b></td>';
				$html .= '<td width="20" class="c_ba2636"><b>'.$balls[2].'</b></td>';
				$html .= '<td width="20" class="c_ba2636"><b>'.$balls[3].'</b></td>';
				$html .= '<td width="20" class="c_ba2636"><b>'.$balls[4].'</b></td>';
           for($i=0;$i<=4;$i++){
			   if($balls[$i]=="0"){
			   $html .= '<td><span class="ball_red">0</span></td>';
			   $html .= '<td class="f_green">1</td>';
			   $html .= '<td class="f_green">2</td>';
			   $html .= '<td class="f_green">3</td>';
			   $html .= '<td class="f_green">4</td>';
			   $html .= '<td class="f_green">5</td>';
			   $html .= '<td class="f_green">6</td>';
			   $html .= '<td class="f_green">7</td>';
			   $html .= '<td class="f_green">8</td>';
			   $html .= '<td class="f_green">9</td>';
		   } elseif($balls[$i]=="1"){
			   $html .= '<td class="f_green">0</td>';
			   $html .= '<td><span class="ball_red">1</span></td>';
			   $html .= '<td class="f_green">2</td>';
			   $html .= '<td class="f_green">3</td>';
			   $html .= '<td class="f_green">4</td>';
			   $html .= '<td class="f_green">5</td>';
			   $html .= '<td class="f_green">6</td>';
			   $html .= '<td class="f_green">7</td>';
			   $html .= '<td class="f_green">8</td>';
			   $html .= '<td class="f_green">9</td>';
		   }elseif($balls[$i]=="2"){
			   $html .= '<td class="f_green">0</td>';
			   $html .= '<td class="f_green">1</td>';
			   $html .= '<td><span class="ball_red">2</span></td>';
			   $html .= '<td class="f_green">3</td>';
			   $html .= '<td class="f_green">4</td>';
			   $html .= '<td class="f_green">5</td>';
			   $html .= '<td class="f_green">6</td>';
			   $html .= '<td class="f_green">7</td>';
			   $html .= '<td class="f_green">8</td>';
			   $html .= '<td class="f_green">9</td>';
		   }elseif($balls[$i]=="3"){
			   $html .= '<td class="f_green">0</td>';
			   $html .= '<td class="f_green">1</td>';
			   $html .= '<td class="f_green">2</td>';
			   $html .= '<td><span class="ball_red">3</span></td>';
			   $html .= '<td class="f_green">4</td>';
			   $html .= '<td class="f_green">5</td>';
			   $html .= '<td class="f_green">6</td>';
			   $html .= '<td class="f_green">7</td>';
			   $html .= '<td class="f_green">8</td>';
			   $html .= '<td class="f_green">9</td>';
		   }elseif($balls[$i]=="4"){
			   $html .= '<td class="f_green">0</td>';
			   $html .= '<td class="f_green">1</td>';
			   $html .= '<td class="f_green">2</td>';
			   $html .= '<td class="f_green">3</td>';
			   $html .= '<td><span class="ball_red">4</span></td>';
			   $html .= '<td class="f_green">5</td>';
			   $html .= '<td class="f_green">6</td>';
			   $html .= '<td class="f_green">7</td>';
			   $html .= '<td class="f_green">8</td>';
			   $html .= '<td class="f_green">9</td>';
		   }elseif($balls[$i]=="5"){
			   $html .= '<td class="f_green">0</td>';
			   $html .= '<td class="f_green">1</td>';
			   $html .= '<td class="f_green">2</td>';
			   $html .= '<td class="f_green">3</td>';
			   $html .= '<td class="f_green">4</td>';
			   $html .= '<td><span class="ball_red">5</span></td>';
			   $html .= '<td class="f_green">6</td>';
			   $html .= '<td class="f_green">7</td>';
			   $html .= '<td class="f_green">8</td>';
			   $html .= '<td class="f_green">9</td>';
		   }elseif($balls[$i]=="6"){
			   $html .= '<td class="f_green">0</td>';
			   $html .= '<td class="f_green">1</td>';
			   $html .= '<td class="f_green">2</td>';
			   $html .= '<td class="f_green">3</td>';
			   $html .= '<td class="f_green">4</td>';
			   $html .= '<td class="f_green">5</td>';
			   $html .= '<td><span class="ball_red">6</span></td>';
			   $html .= '<td class="f_green">7</td>';
			   $html .= '<td class="f_green">8</td>';
			   $html .= '<td class="f_green">9</td>';
		   }elseif($balls[$i]=="7"){
			   $html .= '<td class="f_green">0</td>';
			   $html .= '<td class="f_green">1</td>';
			   $html .= '<td class="f_green">2</td>';
			   $html .= '<td class="f_green">3</td>';
			   $html .= '<td class="f_green">4</td>';
			   $html .= '<td class="f_green">5</td>';
			   $html .= '<td class="f_green">6</td>';
			   $html .= '<td><span class="ball_red">7</span></td>';
			   $html .= '<td class="f_green">8</td>';
			   $html .= '<td class="f_green">9</td>';
		   }elseif($balls[$i]=="8"){
			   $html .= '<td class="f_green">0</td>';
			   $html .= '<td class="f_green">1</td>';
			   $html .= '<td class="f_green">2</td>';
			   $html .= '<td class="f_green">3</td>';
			   $html .= '<td class="f_green">4</td>';
			   $html .= '<td class="f_green">5</td>';
			   $html .= '<td class="f_green">6</td>';
			   $html .= '<td class="f_green">7</td>';
			   $html .= '<td><span class="ball_red">8</span></td>';
			   $html .= '<td class="f_green">9</td>';
		   }elseif($balls[$i]=="9"){
			   $html .= '<td class="f_green">0</td>';
			   $html .= '<td class="f_green">1</td>';
			   $html .= '<td class="f_green">2</td>';
			   $html .= '<td class="f_green">3</td>';
			   $html .= '<td class="f_green">4</td>';
			   $html .= '<td class="f_green">5</td>';
			   $html .= '<td class="f_green">6</td>';
			   $html .= '<td class="f_green">7</td>';
			   $html .= '<td class="f_green">8</td>';
			   $html .= '<td><span class="ball_red">9</span></td>';
		   }
		   }

				for($i=0;$i<=9;$i++){
					if(in_array($i,$balls)){
						if($countarray[$i]==2){
							$html .= '<td><div class="s_ball">2</div><i><span class="ball_violet">'.$i.'</span></i></td>';
						}elseif($countarray[$i]==3) {
							$html .= '<td><div class="s_ball">3</div><i><span class="ball_violet">'.$i.'</span></i></td>';
						}elseif($countarray[$i]==4){
							$html .= '<td><div class="s_ball">4</div><i><span class="ball_violet">'.$i.'</span></i></td>';
						}elseif($countarray[$i]==5){
							$html .= '<td><div class="s_ball">5</div><i><span class="ball_violet">'.$i.'</span></i></td>';
						}else{
							$html .= '<td><span class="ball_violet">'.$i.'</span></td>';
						}
					}else{
						$html .= '<td class="f_green">'.$i.'</td>';
					}
				}

				$html .= '</tr>';
			}
		}
		$this->assign('trendhtml',$html);
		$this->display('Game_trend_ssc');
	}
function trend_x5(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$num = I('num',30,'intval');
		$_api = new \Lib\api;
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['num'] = $num;
		$Result = $_api->sendHttpClient('Api/Lottery/lotteryopencodes',$apiparam);
		$this->assign('cptitle',$Result['data'][0]['title']);
		$html = '';$allballs = [1,2,3,4,5,6,7,8,9,10,11];
		if($Result['sign'] && count($Result['data'])>=1){
			foreach($Result['data'] as $k=>$v){
				$balls = explode(',',$v['opencode']);
				$countarray = array_count_values($balls);
				$sum   = 0;$sum = array_sum($balls);
				$bigsmall = $sum>10?'大':'小';
				$oddeven  = $sum%2==0?'双':'单';
				$html .= '<tr class="text-c">';
				$html .= '<td height="40">'.$v['expect'].'</td>';
				$html .= '<td width="20" class="c_ba2636"><b>'.$balls[0].'</b></td>';
				$html .= '<td width="20" class="c_ba2636"><b>'.$balls[1].'</b></td>';
				$html .= '<td width="20" class="c_ba2636"><b>'.$balls[2].'</b></td>';
				$html .= '<td width="20" class="c_ba2636"><b>'.$balls[3].'</b></td>';
				$html .= '<td width="20" class="c_ba2636"><b>'.$balls[4].'</b></td>';
				for($i=0;$i<=4;$i++){
					if($balls[$i]=="1"){
						$html .= '<td><span class="ball_red">1</span></td>';
						$html .= '<td class="f_green">2</td>';
						$html .= '<td class="f_green">3</td>';
						$html .= '<td class="f_green">4</td>';
						$html .= '<td class="f_green">5</td>';
						$html .= '<td class="f_green">6</td>';
						$html .= '<td class="f_green">7</td>';
						$html .= '<td class="f_green">8</td>';
						$html .= '<td class="f_green">9</td>';
					    $html .= '<td class="f_green">10</td>';
					    $html .= '<td class="f_green">11</td>';
					}elseif($balls[$i]=="2"){
						$html .= '<td class="f_green">1</td>';
						$html .= '<td><span class="ball_red">2</span></td>';
						$html .= '<td class="f_green">3</td>';
						$html .= '<td class="f_green">4</td>';
						$html .= '<td class="f_green">5</td>';
						$html .= '<td class="f_green">6</td>';
						$html .= '<td class="f_green">7</td>';
						$html .= '<td class="f_green">8</td>';
						$html .= '<td class="f_green">9</td>';
						$html .= '<td class="f_green">10</td>';
						$html .= '<td class="f_green">11</td>';
					}elseif($balls[$i]=="3"){
						$html .= '<td class="f_green">1</td>';
						$html .= '<td class="f_green">2</td>';
						$html .= '<td><span class="ball_red">3</span></td>';
						$html .= '<td class="f_green">4</td>';
						$html .= '<td class="f_green">5</td>';
						$html .= '<td class="f_green">6</td>';
						$html .= '<td class="f_green">7</td>';
						$html .= '<td class="f_green">8</td>';
						$html .= '<td class="f_green">9</td>';
						$html .= '<td class="f_green">10</td>';
						$html .= '<td class="f_green">11</td>';
					}elseif($balls[$i]=="4"){
						$html .= '<td class="f_green">1</td>';
						$html .= '<td class="f_green">2</td>';
						$html .= '<td class="f_green">3</td>';
						$html .= '<td><span class="ball_red">4</span></td>';
						$html .= '<td class="f_green">5</td>';
						$html .= '<td class="f_green">6</td>';
						$html .= '<td class="f_green">7</td>';
						$html .= '<td class="f_green">8</td>';
						$html .= '<td class="f_green">9</td>';
						$html .= '<td class="f_green">10</td>';
						$html .= '<td class="f_green">11</td>';
					}elseif($balls[$i]=="5"){
						$html .= '<td class="f_green">1</td>';
						$html .= '<td class="f_green">2</td>';
						$html .= '<td class="f_green">3</td>';
						$html .= '<td class="f_green">4</td>';
						$html .= '<td><span class="ball_red">5</span></td>';
						$html .= '<td class="f_green">6</td>';
						$html .= '<td class="f_green">7</td>';
						$html .= '<td class="f_green">8</td>';
						$html .= '<td class="f_green">9</td>';
						$html .= '<td class="f_green">10</td>';
						$html .= '<td class="f_green">11</td>';
					}elseif($balls[$i]=="6"){
						$html .= '<td class="f_green">1</td>';
						$html .= '<td class="f_green">2</td>';
						$html .= '<td class="f_green">3</td>';
						$html .= '<td class="f_green">4</td>';
						$html .= '<td class="f_green">5</td>';
						$html .= '<td><span class="ball_red">6</span></td>';
						$html .= '<td class="f_green">7</td>';
						$html .= '<td class="f_green">8</td>';
						$html .= '<td class="f_green">9</td>';
						$html .= '<td class="f_green">10</td>';
						$html .= '<td class="f_green">11</td>';
					}elseif($balls[$i]=="7"){
						$html .= '<td class="f_green">1</td>';
						$html .= '<td class="f_green">2</td>';
						$html .= '<td class="f_green">3</td>';
						$html .= '<td class="f_green">4</td>';
						$html .= '<td class="f_green">5</td>';
						$html .= '<td class="f_green">6</td>';
						$html .= '<td><span class="ball_red">7</span></td>';
						$html .= '<td class="f_green">8</td>';
						$html .= '<td class="f_green">9</td>';
						$html .= '<td class="f_green">10</td>';
						$html .= '<td class="f_green">11</td>';
					}elseif($balls[$i]=="8"){;
						$html .= '<td class="f_green">1</td>';
						$html .= '<td class="f_green">2</td>';
						$html .= '<td class="f_green">3</td>';
						$html .= '<td class="f_green">4</td>';
						$html .= '<td class="f_green">5</td>';
						$html .= '<td class="f_green">6</td>';
						$html .= '<td class="f_green">7</td>';
						$html .= '<td><span class="ball_red">8</span></td>';
						$html .= '<td class="f_green">9</td>';
						$html .= '<td class="f_green">10</td>';
						$html .= '<td class="f_green">11</td>';
					}elseif($balls[$i]=="9"){
						$html .= '<td class="f_green">1</td>';
						$html .= '<td class="f_green">2</td>';
						$html .= '<td class="f_green">3</td>';
						$html .= '<td class="f_green">4</td>';
						$html .= '<td class="f_green">5</td>';
						$html .= '<td class="f_green">6</td>';
						$html .= '<td class="f_green">7</td>';
						$html .= '<td class="f_green">8</td>';
						$html .= '<td><span class="ball_red">9</span></td>';
						$html .= '<td class="f_green">10</td>';
						$html .= '<td class="f_green">11</td>';
					}elseif($balls[$i]=="10"){
						$html .= '<td class="f_green">1</td>';
						$html .= '<td class="f_green">2</td>';
						$html .= '<td class="f_green">3</td>';
						$html .= '<td class="f_green">4</td>';
						$html .= '<td class="f_green">5</td>';
						$html .= '<td class="f_green">6</td>';
						$html .= '<td class="f_green">7</td>';
						$html .= '<td class="f_green">8</td>';
						$html .= '<td class="f_green">9</td>';
						$html .= '<td><span class="ball_red">10</span></td>';
						$html .= '<td class="f_green">11</td>';
					}elseif($balls[$i]=="11"){
						$html .= '<td class="f_green">1</td>';
						$html .= '<td class="f_green">2</td>';
						$html .= '<td class="f_green">3</td>';
						$html .= '<td class="f_green">4</td>';
						$html .= '<td class="f_green">5</td>';
						$html .= '<td class="f_green">6</td>';
						$html .= '<td class="f_green">7</td>';
						$html .= '<td class="f_green">8</td>';
						$html .= '<td class="f_green">9</td>';
						$html .= '<td class="f_green">10</td>';
						$html .= '<td><span class="ball_red">11</span></td>';
					}
				}

				for($i=1;$i<=11;$i++){
					if(in_array($i,$balls)){
						if($countarray[$i]==2){
							$html .= '<td><div class="s_ball">2</div><i><span class="ball_violet">'.$i.'</span></i></td>';
						}elseif($countarray[$i]==3) {
							$html .= '<td><div class="s_ball">3</div><i><span class="ball_violet">'.$i.'</span></i></td>';
						}elseif($countarray[$i]==4){
							$html .= '<td><div class="s_ball">4</div><i><span class="ball_violet">'.$i.'</span></i></td>';
						}elseif($countarray[$i]==5){
							$html .= '<td><div class="s_ball">5</div><i><span class="ball_violet">'.$i.'</span></i></td>';
						}else{
							$html .= '<td><span class="ball_violet">'.$i.'</span></td>';
						}
					}else{
						$html .= '<td class="f_green">'.$i.'</td>';
					}
				}

				$html .= '</tr>';
			}
		}
		$this->assign('trendhtml',$html);
		$this->display('Game_trend_x5');
	}
function trend_dpc(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$num = I('num',30,'intval');
		$_api = new \Lib\api;
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['num'] = $num;
		$Result = $_api->sendHttpClient('Api/Lottery/lotteryopencodes',$apiparam);
		$this->assign('cptitle',$Result['data'][0]['title']);
		$html = '';$allballs = [0,1,2,3,4,5,6,7,8,9];
		if($Result['sign'] && count($Result['data'])>=1){
			foreach($Result['data'] as $k=>$v){
				$balls = explode(',',$v['opencode']);
				$countarray = array_count_values($balls);
				$sum   = 0;$sum = array_sum($balls);
				$count = count($countarray);
				$kd = max($balls)-min($balls);
				$bigsmall1 = $balls[0]>4?'大':'小';
				$bigsmall2 = $balls[1]>4?'大':'小';
				$bigsmall3 = $balls[2]>4?'大':'小';
				$oddeven1  = $balls[0]%2==0?'双':'单';
				$oddeven2  = $balls[1]%2==0?'双':'单';
				$oddeven3  = $balls[2]%2==0?'双':'单';
				$html .= '<tr class="text-c">';
				$html .= '<td height="40">'.$v['expect'].'</td>';
				$html .= '<td class="c_ba2636"><b>'.$balls[0].'</b></td>';
				$html .= '<td class="c_ba2636"><b>'.$balls[1].'</b></td>';
				$html .= '<td class="c_ba2636"><b>'.$balls[2].'</b></td>';

				for($i=0;$i<=9;$i++){
					if(in_array($i,$balls)){
						if($countarray[$i]==2)
							$html .= '<td class="ball_red"><div class="s_ball">2</div><i>'.$i.'</i></td>';
						else
							$html .= '<td class="ball_red">'.$i.'</td>';
					}else{
						$html .= '<td class="f_green">'.$i.'</td>';
					}
				}
			 if($bigsmall1=='大'){
						$html .= '<td class="bg_orange js-fold dx">大</td>';
					}else{
						$html .= '<td class="bg_orange js-fold dx">小</td>';
					}
				if($bigsmall2=='大'){
					$html .= '<td class="bg_orange js-fold dx">大</td>';
				}else{
					$html .= '<td class="bg_orange js-fold dx">小</td>';
				}
				if($bigsmall3=='大'){
					$html .= '<td class="bg_orange js-fold dx">大</td>';
				}else{
					$html .= '<td class="bg_orange js-fold dx">小</td>';
				}


			   if($oddeven1=='双'){
					 $html .= '<td class="bg_orange js-fold ds">双</td>';
					}else{
					 $html .= '<td class="bg_orange js-fold ds">单</td>';
					}
				if($oddeven2=='双'){
					$html .= '<td class="bg_orange js-fold ds">双</td>';
				}else{
					$html .= '<td class="bg_orange js-fold ds">单</td>';
				}
				if($oddeven3=='双'){
					$html .= '<td class="bg_orange js-fold ds">双</td>';
				}else{
					$html .= '<td class="bg_orange js-fold ds">单</td>';
				}
				/*<img width="20" src='.__ROOT__.'/resources/images/jump_success.png />*/
				if($count==2){
					$html .= '<td style="font-weight: bolder;color:red;background:#cdb624;">√</td>';
					$html .= '<td style="background:#cdb624;"></td>';
					$html .= '<td style="background:#cdb624;"></td>';
				}elseif($count==3){
					$html .= '<td style="background:#cdb624;"></td>';
					$html .= '<td style="font-weight: bolder;color:red;background:#cdb624;">√</td>';
					$html .= '<td style="background:#cdb624;"></td>';
				}elseif($count==1){
					$html .= '<td style="background:#cdb624;"></td>';
					$html .= '<td style="background:#cdb624;"></td>';
					$html .= '<td style="font-weight: bolder;color:red;background:#cdb624;">√</td>';
				}
				$html .= '<td style="background:#54b2cd;color:#fff;">' .$kd.'</td>';
				$html .= '<td style="background:#cd9d94;color:#fff;">' .$sum.'</td>';

				$html .= '</tr>';
			}
		}
		$this->assign('trendhtml',$html);
		$this->display('Game_trend_dpc');
	}
function trend_pk10(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$num = I('num',30,'intval');
		$_api = new \Lib\api;
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['num'] = $num;
		$Result = $_api->sendHttpClient('Api/Lottery/lotteryopencodes',$apiparam);
		$this->assign('cptitle',$Result['data'][0]['title']);
		$html = '';
		$allballs = ['01,02,03,04,05,06,07,08,09,10'];
		if($Result['sign'] && count($Result['data'])>=1){
			foreach($Result['data'] as $k=>$v){
				$balls = explode(',',$v['opencode']);
				$countarray = array_count_values($balls);
				$sum   = 0;$sum = array_sum($balls);
				$count = count($countarray);
				$kd = max($balls)-min($balls);
				$oddeven1  = $balls[0]%2==0?'偶':'奇';
				$bigsmall1 = $balls[0]>4?'大':'小';
				$html .= '<tr class="text-c">';
				$html .= '<td height="40">'.$v['expect'].'</td>';
				$a="";
				for($i=0;$i<10;$i++){
					$balls[$i]==10?$a=$balls[$i]:$a='0'.$balls[$i];
					$html .= '<td class="c_ba2636"><b>'.$a.'</b></td>';
				}


				for($i=1;$i<=10;$i++){
				  if($i==10){
					  if( $i==$balls[0]){
						  $html .= '<td><span class="span_red">'.'0'.$i.'</span></td>';
					  }else{
						   $html .= '<td class="f_green">'.$i.'</td>';
					  }
				  }	else{
					  if( $i==$balls[0]){
							  $html .= '<td ><span  class="span_red">'.'0'.$i.'</span></td>';
					  }else{
						  $html .= '<td class="f_green">'.'0'.$i.'</td>';
					  }
				  }
				}
				if($oddeven1=='偶'){
					$html .= '<td style="background:#cdb624;"></td>';
					$html .= '<td style="font-weight: bolder;color:red;background:#cdb624;">√</td>';
				}else{
					$html .= '<td style="font-weight: bolder;color:red;background:#cdb624;">√</td>';
					$html .= '<td style="background:#cdb624;"></td>';
				}
				if($bigsmall1=='大'){
					$html .= '<td style="font-weight: bolder;color:red;background:#cdb624;">√</td>';
					$html .= '<td style="background:#cdb624;"></td>';
				}else{
					$html .= '<td style="background:#cdb624;"></td>';
					$html .= '<td style="font-weight: bolder;color:red;background:#cdb624;">√</td>';
				}


				$html .= '</tr>';
			}
		}
		$this->assign('trendhtml',$html);
		$this->display('Game_trend_pk10');
	}
function trend_keno(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$num = I('num',30,'intval');
		$_api = new \Lib\api;
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['num'] = $num;
		$Result = $_api->sendHttpClient('Api/Lottery/lotteryopencodes',$apiparam);
		$this->assign('cptitle',$Result['data'][0]['title']);
		$html = '';
		$allballs = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60','61','62','63','64','65','66','67','68','69','70','71','72','73','74','75','76','77','78','79','80'];
		if($Result['sign'] && count($Result['data'])>=1){
			foreach($Result['data'] as $k=>$v){
				$balls = explode(',',$v['opencode']);
				$html .= '<tr class="text-c"  style="height:30px;line-height:30px">';
				$html .= '<td height="40" ><div class="one">'.$v['expect'] .'</div></td>';
				for($i=0;$i<20;$i++){
					$html .= '<td class="c_ba2636"><b>'.$balls[$i].',</b></td>';
				}
				for($i=1;$i<=80;$i++){
					if($balls[0]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[1]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[2]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[3]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[4]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[5]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[6]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[7]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[8]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[9]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[10]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[11]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[12]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[13]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[14]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[15]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[16]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[17]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[18]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[19]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}elseif($balls[20]==$i){
						$html .= '<td ><span  class="span_red">'.$i.'</span></td>';
					}else{
						$html .= '<td class="f_green">'.$i.'</td>';
					}

				}

				$html .= '</tr>';
			}
		}
		$this->assign('trendhtml',$html);
		$this->display('Game_trend_keno');
	}
function trend_lhc(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$num = I('num',30,'intval');
		$_api = new \Lib\api;
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['num'] = $num;
		$Result = $_api->sendHttpClient('Api/Lottery/lotteryopencodes',$apiparam);
		$this->assign('cptitle',$Result['data'][0]['title']);
	$hongbo = ['01','02','07','08','12','13','18','19','23','24','29','30','34','35','40','45','46'];  //红波
	$lvbo =   ['05','06','11','16','17','21','22','27','28','32','33','38','39','43','44','49'];       //绿波
	$lanbo =  ['03','04','09','10','14','15','20','25','26','31','36','37','41','42','47','48'];       //蓝波
//	特码大小
    $tmda = ['25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49'];  //大
	$tmxiao = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];   //小
	$tmdan = ['01','03','05','07','09','11','13','15','17','19','21','23','25','27','29','31','33','35','37','39','41','43','45','47','49']; //单
	$tmshuang = ['2','04','06','08','10','12','14','16','18','20','22','24','26','28','30','32','34','36','38','40','42','44','46','48'];  //双
 	$tmheda = ['07','08','09','16','17','18','19','25','26','27','28','29','34','35','36','37','38','39','43','44','45','46','47','48','49'];//合大
	$tmhexiao = ['01','02','03','04','05','06','10','11','12','13','14','15','20','21','22','23','24','30','31','32','33','40','41','42']; //合小
	$tmhedan = ['01','03','05','07','09','10','12','14','16','18','21','23','25','27','29','30','32','34','36','38','41','43','45','47','49'];//合单
	$tmheshuang = ['02','04','06','08','11','13','15','17','19','20','22','24','26','28','31','33','35','37','39','40','42','44','46','48'];//合双
	$tmweida = ['05','06','07','08','09','15','16','17','18','19','25','26','27','28','29','35','36','37','38','39','45','46','47','48','49'];//尾大
	$tmweixiao = ['01','02','03','04','10','11','12','13','14','20','21','22','23','24','30','31','32','33','34','40','41','42','43','44']; //尾小
	$tmdadan = ['25','27','29','31','33','35','37','39','41','43','45','47','49'];
	$tmxiaodan = ['01','03','05','07','09','11','13','15','17','19','21','23'];
	$tmdashuang = ['26','28','30','32','34','36','38','40','42','44','46','48'];
	$tmxiaoshuang = ['02','04','06','08','10','12','14','16','18','20','22','24'];
	//家禽
	$tmjiaqin = ['01','03','04','09','11','12','13','15','16','21','23','24','25','27','28','33','35','36','37','39','40','45','47','48','49'];
	//野兽
	$tmyeshou = ['02','05','06','07','08','10','14','17','18','19','20','22','26','29','30','31','32','34','38','41','42','43','44','46'];
	//特码半波
	$hongda = ['29','30','34','35','40','45','46'];                  //红大
	$hongxiao = ['01','02','07','08','12','13','18','19','23','24']; //红小
	$hongdan = ['01','07','13','19','23','29','35','45'];            //红单
	$hongshuang = ['02','08','12','18','24','30','34','40','46'];    //红双
	$honghedan = ['07','12','18','23','29','30','34','45'];          //红合单
	$hongheshuang = ['02','08','13','19','24','35','40','46'];       //红合双
	$lvda = ['27','28','32','33','38','39','43','44','49'];          //绿大
	$lvxiao = ['05','06','11','16','17','21','22'];                  //绿小
	$lvdan = ['05','11','17','21','27','33','39','43','49'];         //绿单
	$lvshuang = ['06','16','22','28','32','38','44'];                //绿双
	$lvhedan = ['05','16','21','27','32','38','43','49'];            //绿合单
	$lvheshuang = ['06','11','17','22','28','33','39','44'];         //绿合双
	$landa = ['25','26','31','36','37','41','42','47','48'];         //蓝大
	$lanxiao = ['03','04','09','10','14','15','20'];                 //蓝小
	$landan = ['03','09','15','25','31','37','41','47'];             //蓝单
	$lanshuang = ['04','10','14','20','26','36','42','48'];          //蓝双
	$lanhedan = ['03','09','10','14','25','36','41','47'];           //蓝合单
	$lanheshuang =['04','15','20','26','31','37','42','48'];         //蓝合双
   //生肖
	$sxs = [                                                         //生肖
		"鼠" => ['12','24','36','48'],
		'牛' => ['11','23','35','47'],
		"虎" => ['10','22','34','46'],
		"兔" => ['09','21','33','45'],
		"龙" => ['08','20','32','44'],
		"蛇" => ['07','19','31','43'],
		"马" => ['06','18','30','42'],
		"羊" => ['05','17','29','41'],
		"猴" => ['04','16','28','40'],
		"鸡" => ['03','15','27','39'],
		"狗" => ['02','14','26','38'],
		"猪" => ['01','13','25','37','49']
	];
	$year = 2019;
	$nowYear = Date('Y');
	$yearDiff = $nowYear - $year;
	if($yearDiff){
        foreach($sxs as $k => $years){
            $tmp = array();
            $first = array_shift($years);
            $first += $yearDiff;
            if($first > 12){
                $first = $first%12;
            }
            for($i=1;$i<=5;$i++){
                $tmp[] = $first;
                $first +=12;
                if($first > 49){
                    break;
                }
            }
            $sxs[$k] = $tmp;
        }
    }
   for($i=1;$i<=49;$i++){
	   if($i<10)$i='0'.$i;
	   //波色
	   if(in_array($i,$hongbo))$bose[$i]='#f8223c';
	   if(in_array($i,$lvbo))$bose[$i]='#1fc26b';
	   if(in_array($i,$lanbo))$bose[$i]='#0093e8';
	   //生肖
	   if(in_array($i,$sxs['鼠']))$sx[$i]='鼠';
	   if(in_array($i,$sxs['牛']))$sx[$i]='牛';
	   if(in_array($i,$sxs['虎']))$sx[$i]='虎';
	   if(in_array($i,$sxs['兔']))$sx[$i]='兔';
	   if(in_array($i,$sxs['龙']))$sx[$i]='龙';
	   if(in_array($i,$sxs['蛇']))$sx[$i]='蛇';
	   if(in_array($i,$sxs['马']))$sx[$i]='马';
	   if(in_array($i,$sxs['羊']))$sx[$i]='羊';
	   if(in_array($i,$sxs['猴']))$sx[$i]='猴';
	   if(in_array($i,$sxs['鸡']))$sx[$i]='鸡';
	   if(in_array($i,$sxs['狗']))$sx[$i]='狗';
	   if(in_array($i,$sxs['猪']))$sx[$i]='猪';
   }
		$html = '';
 		if($Result['sign'] && count($Result['data'])>=1){
			foreach($Result['data'] as $k=>$v){
				$balls = explode(',',$v['opencode']);
				foreach($balls as $k=>$ball){
				    $balls[$k] = str_pad($ball,2,0,STR_PAD_LEFT);
                }
				if($balls[6] !='49'){
					if(in_array($balls[6],$tmda))$tmdaxiao='大';
					if(in_array($balls[6],$tmxiao))$tmdaxiao='小';
					if(in_array($balls[6],$tmdan))$tmdanshuang='单';
					if(in_array($balls[6],$tmshuang))$tmdanshuang='双';
					if(in_array($balls[6],$tmheda))$tmhedaxiao='合大';
					if(in_array($balls[6],$tmhexiao))$tmhedaxiao='合小';
					if(in_array($balls[6],$tmhedan))$tmhedanshuang='合单';
					if(in_array($balls[6],$tmheshuang))$tmhedanshuang='合双';
					if(in_array($balls[6],$tmdadan))$tmdxds='大单';
					if(in_array($balls[6],$tmxiaodan))$tmdxds='小单';
					if(in_array($balls[6],$tmdashuang))$tmdxds='大双';
					if(in_array($balls[6],$tmxiaoshuang))$tmdxds='小双';
					if(in_array($balls[6],$tmweida))$tmweidaxiao='尾大';
					if(in_array($balls[6],$tmweixiao))$tmweidaxiao='尾小';
				}else{
					$tmdaxiao=$tmdanshuang=$tmhedaxiao=$tmhedanshuang=$tmdxds=$tmweidaxiao='和';
				}
				if(in_array($balls[6],$tmjiaqin))$tmjqys='家禽';
				if(in_array($balls[6],$tmyeshou))$tmjqys='野兽';
				if(in_array($balls[6],$hongda))$daxiao='红大';
				if(in_array($balls[6],$hongxiao))$daxiao='红小';
				if(in_array($balls[6],$lvda))$daxiao='绿大';
				if(in_array($balls[6],$lvxiao))$daxiao='绿小';
				if(in_array($balls[6],$landa))$daxiao='蓝大';
				if(in_array($balls[6],$lanxiao))$daxiao='蓝小';
				if(in_array($balls[6],$hongdan))$danshuang='红单';
				if(in_array($balls[6],$hongshuang))$danshuang='红双';
				if(in_array($balls[6],$lvdan))$danshuang='绿单';
				if(in_array($balls[6],$lvshuang))$danshuang='绿双';
				if(in_array($balls[6],$landan))$danshuang='蓝单';
				if(in_array($balls[6],$lanshuang))$danshuang='蓝双';
				if(in_array($balls[6],$honghedan))$hedanshuang='红合单';
				if(in_array($balls[6],$hongheshuang))$hedanshuang='红合双';
				if(in_array($balls[6],$lvhedan))$hedanshuang='绿合单';
				if(in_array($balls[6],$lvheshuang))$hedanshuang='绿合双';
				if(in_array($balls[6],$lanhedan))$hedanshuang='蓝合单';
				if(in_array($balls[6],$lanheshuang))$hedanshuang='蓝合双';
				$html .= '<tr class="text-c hovercolor">';
				$html .= '<td height="50">'.$v['expect'].'</td>';
				$html .= '<td width="60"  height="60" class="c_ba2636"><b class="lhc_b" style="background:'.$bose[$balls[0]].'">'.$balls[0].'</b><span style="color:#000">'.$sx[$balls[0]].'</span> </td>';
				$html .= '<td width="50"  height="60" class="c_ba2636"><b class="lhc_b" style="background:'.$bose[$balls[1]].'">'.$balls[1].'</b><span style="color:#000">'.$sx[$balls[1]].'</span></td>';
				$html .= '<td width="50"  height="60" class="c_ba2636"><b class="lhc_b" style="background:'.$bose[$balls[2]].'">'.$balls[2].'</b><span style="color:#000">'.$sx[$balls[2]].'</span></td>';
				$html .= '<td width="50"  height="60" class="c_ba2636"><b class="lhc_b" style="background:'.$bose[$balls[3]].'">'.$balls[3].'</b><span style="color:#000">'.$sx[$balls[3]].'</span></td>';
				$html .= '<td width="50"  height="60" class="c_ba2636"><b class="lhc_b" style="background:'.$bose[$balls[4]].'">'.$balls[4].'</b><span style="color:#000">'.$sx[$balls[4]].'</span></td>';
				$html .= '<td width="50"  height="60" class="c_ba2636"><b class="lhc_b" style="background:'.$bose[$balls[5]].'">'.$balls[5].'</b><span style="color:#000">'.$sx[$balls[5]].'</span></td>';
				$html .= '<td width="50"  height="60" class="c_ba2636"><b class="lhc_b" style="background:'.$bose[$balls[6]].'">'.$balls[6].'</b><span style="color:#000">'.$sx[$balls[6]].'</span></td>';
				$html .= '<td  colspan="1" height="60" class="c_ba2636"><span style="color:#000">'.$tmdaxiao.'</span></td>';
				$html .= '<td  colspan="1" height="60" class="c_ba2636"><span style="color:#000">'.$tmdanshuang.'</span></td>';
				$html .= '<td  colspan="1" height="60" class="c_ba2636"><span style="color:#000">'.$tmhedaxiao.'</span></td>';
				$html .= '<td  colspan="1" height="60" class="c_ba2636"><span style="color:#000">'.$tmhedanshuang.'</span></td>';
				$html .= '<td  colspan="1" height="60" class="c_ba2636"><span style="color:#000">'.$tmdxds.'</span></td>';
				$html .= '<td  colspan="1" height="60" class="c_ba2636"><span style="color:#000">'.$tmweidaxiao.'</span></td>';
				$html .= '<td  colspan="1" height="60" class="c_ba2636"><span style="color:#000">'.$tmjqys.'</span></td>';
				$html .= '<td  colspan="1" height="60" class="c_ba2636"><span style="color:#000">'.$daxiao.'</span></td>';
				$html .= '<td  colspan="1" height="60" class="c_ba2636"><span style="color:#000">'.$danshuang.'</span></td>';
				$html .= '<td  colspan="1" height="60" class="c_ba2636"><span style="color:#000">'.$hedanshuang.'</span></td>';
                $html .= '</tr>';
			}
		}
		$this->assign('trendhtml',$html);
		$this->display('Game_trend_lhc');
	}
      public function zoushi(){
          $this->display('trend.zoushi');
      }
}
?>