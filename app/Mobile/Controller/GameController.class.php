<?php
namespace Mobile\Controller;
use Think\Controller;
class GameController extends CommonController {
	public function __construct(){
		parent::__construct();
		if(!$this->userinfo){
/*			if(IS_AJAX){
				$apiparam['sign'] = 'fase';
				$apiparam['message'] = '请登录';
				$this->ajaxReturn($apiparam);
			}else{*/
				redirect(U("Public/login"));
//			}
		};
	}
//k3
	function k3(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$_k3list = C('cplist.k3');
		foreach($_k3list as $k=>$v){
			if($v['isopen']==0)unset($_k3list[$k]);
		}
		$this->assign('k3list',$_k3list);
		if($lotteryname && $_k3list[$lotteryname]){
			$nowcpinfo = $_k3list[$lotteryname];
		}else{
			$nowcpinfo = current($_k3list);
		}
		$this->assign('nowcpinfo',$nowcpinfo);
		//赔率
		$rates = C('rates_k3');

		$peilv = [];
		foreach($rates as $k=>$v){
			$peilv[$v['playid']] = $v['rate'];
		}
		 $max = array_search(max($peilv),$peilv);
		 $mix = array_search(min($peilv),$peilv);

		$this->assign('maxPeilv',$peilv[$max]);
		$this->assign('minPeilv',$peilv[$mix]);
		$this->assign('peilv',$peilv);


		$typeid = 'k3';
		$Result = S('lotteryrates_'.$typeid);
		if(!$Result){
			$apiparam=array();
			$apiparam['typeid'] = $typeid;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Lottery/lotteryrates',$apiparam);
			$sid = S('lotteryrates_'.$typeid,$Result,300);
		}
        $open = C('agent_commission_open');
		if($Result['data']){
			$sessionid     = session('member_sessionid');
			$auth_id       = session('member_auth_id');
			$userinfo=session('userinfo');
			if($sessionid && $auth_id && $userinfo && $userinfo['groupid']){//未登陆以玩法设置
				$membergroups = C('membergroups');
				$groupinfo = $membergroups[$userinfo['groupid']];
				if($groupinfo)foreach($Result['data'] as $k0=>$v0){
					$Result['data'][$v0['playid']]['minxf'] = $groupinfo['min_'.$v0['playid']]?$groupinfo['min_'.$v0['playid']]:($Result['data'][$v0['playid']]['minxf']?$Result['data'][$v0['playid']]['minxf']:0);
					$Result['data'][$v0['playid']]['maxxf'] = $groupinfo['max_'.$v0['playid']]?$groupinfo['max_'.$v0['playid']]:($Result['data'][$v0['playid']]['maxxf']?$Result['data'][$v0['playid']]['maxxf']:0);
                    if($open){
                        $rate =$v0['rate'] - $v0['rate']*(GetVar('fanDianMax')-$userinfo['fandian'])/100;
                        $Result['data'][$v0['playid']]['rate'] = sprintf("%.2f",$rate);
                    }
				}
			}
			$Result['rates'] = $Result['data'];
			unset($Result['data']);
		}
		$this->assign('cptitle',$_k3list[$lotteryname]['title']);
		$this->assign('rates',$Result);
		$this->display();
	}
//SSC
	function ssc(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$_ssclist = C('cplist.ssc');
		foreach($_ssclist as $k=>$v){
			if($v['isopen']==0)unset($_ssclist[$k]);
		}
		$this->assign('ssclist',$_ssclist);
		$this->assign('nowcpinfo',$_ssclist[$lotteryname]);

		$typeid = 'ssc';
		$Result = S('lotteryrates_'.$typeid);
		if(!$Result){
			$apiparam=array();
			$apiparam['typeid'] = $typeid;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Lottery/lotteryrates',$apiparam);
			$sid = S('lotteryrates_'.$typeid,$Result,300);
		}
		$Result = $this->userjj($Result);
		$this->assign('cptitle',$_ssclist[$lotteryname]['title']);
		$this->assign('rates',$Result);
	    $this->display("Game_ssc");
        //投注记录
        $map = array();
        $code = I('code');
        $this->assign('code',$code);
        if($code){
            $map['cpname']=$code;
        }
        $map['uid']=$_SESSION['userinfo']['id'];
        $count      = M('touzhu')->where($map)->count();
        $Page       = new \Think\Page($count,10);
        startPage($Page);
        $this->pageshow= $Page->show();
        $tzlist     = M('touzhu')->where($map)->order("oddtime desc")->select();
        $this->assign('tzlist',$tzlist);

	}
	public function tzlist(){
        $map = array();
        $code = I('code');
        if($code){
            $map['cpname']=$code;
        }
        $map['uid']=$_SESSION['userinfo']['id'];
        //今日时间戳
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $map['oddtime'] = array('between',array($beginToday,$endToday));
        $count      = M('touzhu')->where($map)->count();
        $Page       = new \Think\Page($count,100);
        startPage($Page);
        $pageshow = $Page->show();
        $tzlist     = M('touzhu')->where($map)->order("oddtime desc")->limit(100)->select();//->limit($Page->firstRow.','.$Page->listRows)
        $html = '';
        foreach ($tzlist as $key=>$value){
           // $expect = $value['expect'];
            $amount = $value['amount'];
            $mode = $value['okamount'];
            $isdraw = $value['isdraw'];
            $id = $value['id'];
            $trano = $value['trano'];
            if($isdraw ==0){
                $mode = 0;
                $ss = "<th style=\"text-align: center;width: 20%\" onClick=\"Order_chedan('$id','$trano',this)\">撤单</th>";
            }elseif ($isdraw ==1){
                $ss = "<th style='text-align: center;width: 20%;color:red' >已中奖</th>";
            }elseif ($isdraw ==-1){
                $mode = 0;
                $ss = "<th style=\"text-align: center;width: 20%;color:green\" >未中奖</th>";
            }else{
                $mode = 0;
                $ss = "<th style=\"text-align: center;width: 20%;color:#4B0082\" >已撤单</th>";
            }
            $html .= "            <table border='0'>
                    <tr style=\"border-bottom:1px dotted #cccccc;\">
                        <th style=\"text-align: center;width: 30%;font-size:0.8em;\"><a href=\"javascript:getBillInfo('$trano')\">".$trano."</th>
                        <th style=\"text-align: center;width: 30%;font-size:0.95em;\">".$amount."</th>
                        <th style=\"text-align: center;width: 20%;font-size:0.95em;\">".$mode."</th>
                        ".$ss."
                    </tr>
            </table>
            ";
        }
    //    $html .= "<div class=\"page text-center green-black\" style=\"font-size: 0.7em;text-align:center\">".$pageshow."</div>";
        echo $html;exit;
    }
	public function ajaxk3(){
		$map = array();
		$code = I('code');
		if($code){
			$map['cpname']=$code;
		}
		$map['uid']=$_SESSION['userinfo']['id'];
		//今日时间戳
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$map['oddtime'] = array('between',array($beginToday,$endToday));
		$count      = M('touzhu')->where($map)->count();
		$Page       = new \Think\Page($count,100);
		startPage($Page);
		$pageshow = $Page->show();
		$tzlist     = M('touzhu')->where($map)->order("oddtime desc")->limit(100)->select();//limit($Page->firstRow.','.$Page->listRows)->
		$html = '';
		foreach ($tzlist as $key=>$value){
          //  $expect = $value['expect'];
			 $amount = $value['amount'];
            $mode = $value['okamount'];
			$isdraw = $value['isdraw'];
			$id = $value['id'];
			$trano = $value['trano'];
			if($isdraw ==0){
				$mode = 0;
				$ss = "<th style=\"color:rgb(153, 153, 153);text-align: center;width: 20%\" onClick=\"Order_chedan('$id','$trano',this)\">撤单</th>";
			}elseif ($isdraw ==1){
				$ss = "<th style='text-align: center;width: 20%;color:red' >已中奖</th>";
			}elseif ($isdraw ==-1){
				$mode = 0;
				$ss = "<th style=\"text-align: center;width: 20%;color:green\" >未中奖</th>";
			}else{
				$mode = 0;
				$ss = "<th style=\"text-align: center;width: 20%;color:#4B0082\" >已撤单</th>";
			}
			$html .= "            <table border='0' style=\"width:100%\">
                    <tr style=\"border-bottom:1px dotted #383838;font-size:13px;\">
                        <th style=\"text-align: center;width: 30%;font-size:0.8em;\"><a href=\"javascript:getBillInfo('$trano')\">".$trano."</th>
                        <th style=\"color:rgb(153, 153, 153);text-align: center;width: 30%;font-size:0.95em;\">".$amount."</th>
                        <th style=\"color:rgb(153, 153, 153);text-align: center;width: 20%;font-size:0.95em;\">".$mode."</th>
                        ".$ss."
                    </tr>
            </table>
            ";
		}
//		$html .= "<div class=\"page text-center green-black\" style=\"font-size: 0.7em;text-align:center\">".$pageshow."</div>";
		echo $html;exit;
	}
	//pk10
	function pk10(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$_ssclist = C('cplist.pk10');
		foreach($_ssclist as $k=>$v){
			if($v['isopen']==0)unset($_ssclist[$k]);
		}
		$this->assign('ssclist',$_ssclist);
		$this->assign('nowcpinfo',$_ssclist[$lotteryname]);

		$typeid = 'pk10';
		$Result = S('lotteryrates_'.$typeid);
		if(!$Result){
			$apiparam=array();
			$apiparam['typeid'] = $typeid;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Lottery/lotteryrates',$apiparam);
			$sid = S('lotteryrates_'.$typeid,$Result,300);
		}
		$Result = $this->userjj($Result);
		$this->assign('cptitle',$_ssclist[$lotteryname]['title']);
		$this->assign('rates',$Result);
		$this->display("Game_pk10");
	}
	//kl8
	function keno(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$_ssclist = C('cplist.keno');
		foreach($_ssclist as $k=>$v){
			if($v['isopen']==0)unset($_ssclist[$k]);
		}
		$this->assign('ssclist',$_ssclist);
		$this->assign('nowcpinfo',$_ssclist[$lotteryname]);
		$typeid = 'keno';
		$Result = S('lotteryrates_'.$typeid);
		if(!$Result){
			$apiparam=array();
			$apiparam['typeid'] = $typeid;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Lottery/lotteryrates',$apiparam);
			$sid = S('lotteryrates_'.$typeid,$Result,300);
		}
		$Result = $this->userjj($Result);
		$this->assign('cptitle',$_ssclist[$lotteryname]['title']);
		$this->assign('rates',$Result);
		$this->display("Game_keno");
	}
	//x5
	function x5(){
		$lotteryname = I('code');
		$this->assign('lotteryname');
		$_ssclist = C('cplist.x5');
		foreach($_ssclist as $k=>$v){
			if($v['isopen']==0)unset($_ssclist[$k]);
		}
		$this->assign('ssclist',$_ssclist);
		$this->assign('nowcpinfo',$_ssclist[$lotteryname]);

		$typeid = 'x5';
		$Result = S('lotteryrates_'.$typeid);
		if(!$Result){
			$apiparam=array();
			$apiparam['typeid'] = $typeid;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Lottery/lotteryrates',$apiparam);
			$sid = S('lotteryrates_'.$typeid,$Result,300);
		}
		$Result = $this->userjj($Result);
		$this->assign('cptitle',$_ssclist[$lotteryname]['title']);
		$this->assign('rates',$Result);
		$this->display("Game_x5");
	}
	//fc3d/pl3
	function dpc(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$_ssclist = C('cplist.dpc');
		foreach($_ssclist as $k=>$v){
			if($v['isopen']==0)unset($_ssclist[$k]);
		}
		$this->assign('ssclist',$_ssclist);
		$this->assign('nowcpinfo',$_ssclist[$lotteryname]);

		$typeid = 'dpc';
		$Result = S('lotteryrates_'.$typeid);
		if(!$Result){
			$apiparam=array();
			$apiparam['typeid'] = $typeid;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Lottery/lotteryrates',$apiparam);
			$sid = S('lotteryrates_'.$typeid,$Result,300);
		}
		$Result = $this->userjj($Result);
		$this->assign('rates',$Result);
		$this->assign('cptitle',$_ssclist[$lotteryname]['title']);
		$this->display("Game_fc3d");
	}


	//六合彩
	function lhc(){
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$_lhclist = C('cplist.lhc');
		foreach($_lhclist as $k=>$v){
			if($v['isopen']==0)unset($_lhclist[$k]);
		}
		$this->assign('ssclist',$_lhclist);
		if($lotteryname && $_lhclist[$lotteryname]){
			$nowcpinfo = $_lhclist[$lotteryname];
		}else{
			$nowcpinfo = current($_lhclist);
		}
		$this->assign('nowcpinfo',$nowcpinfo);
		//赔率
		$rates = C('rates_lhc');

		$peilv = [];
		foreach($rates as $k=>$v){
			$peilv[$v['playid']] = $v['rate'];
		}
		$max = array_search(max($peilv),$peilv);
		$mix = array_search(min($peilv),$peilv);

		$this->assign('maxPeilv',$peilv[$max]);
		$this->assign('minPeilv',$peilv[$mix]);
		$this->assign('peilv',$peilv);


		$typeid = 'lhc';
		$Result = S('lotteryrates_'.$typeid);
		if(!$Result){
			$apiparam=array();
			$apiparam['typeid'] = $typeid;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Lottery/lotteryrates',$apiparam);
			$sid = S('lotteryrates_'.$typeid,$Result,300);
		}
        $open = C('agent_commission_open');
		if($Result['data']){
			$sessionid     = session('member_sessionid');
			$auth_id       = session('member_auth_id');
			$userinfo=session('userinfo');
			if($sessionid && $auth_id && $userinfo && $userinfo['groupid']){//未登陆以玩法设置
				$membergroups = C('membergroups');
				$groupinfo = $membergroups[$userinfo['groupid']];
				if($groupinfo)foreach($Result['data'] as $k0=>$v0){
					$Result['data'][$v0['playid']]['minxf'] = $groupinfo['min_'.$v0['playid']]?$groupinfo['min_'.$v0['playid']]:($Result['data'][$v0['playid']]['minxf']?$Result['data'][$v0['playid']]['minxf']:0);
					$Result['data'][$v0['playid']]['maxxf'] = $groupinfo['max_'.$v0['playid']]?$groupinfo['max_'.$v0['playid']]:($Result['data'][$v0['playid']]['maxxf']?$Result['data'][$v0['playid']]['maxxf']:0);
                    if($open){
                        $bet_rate = sprintf("%.2f",$v0['rate']/100);
                        $rate =$v0['rate'] - $bet_rate*(GetVar('fanDianMax')-$userinfo['fandian']);
                        $Result['data'][$v0['playid']]['rate'] = sprintf("%.2f",$rate);
                        $Result['data'][$v0['playid']]['scale'] = $bet_rate;
                    }
				}
			}
			$Result['rates'] = $Result['data'];
			unset($Result['data']);
		}
		$this->assign('rates',$Result);
		$this->assign('cptitle',$_lhclist[$lotteryname]['title']);
		$this->display();
	}
	// 计算用户奖金
	function userjj($Result){
		if($Result){
			$sessionid     = session('member_sessionid');
			$auth_id       = session('member_auth_id');
			$userinfo=session('userinfo');
			if($sessionid && $auth_id && $userinfo && $userinfo['groupid']){//未登陆以玩法设置
				$membergroups = C('membergroups');
				$groupinfo = $membergroups[$userinfo['groupid']];
				if($groupinfo)
					foreach($Result['data'] as $k0=>$v0){
						//	(最高奖金-最低奖金)/(最高返点)  X  (会员返点)+最低奖金
						if($userinfo['fandian']){
							if(strstr($v0['maxjj'],'|')){
								$v01 = explode('|',$v0['maxjj']);
								$v02 = explode('|',$v0['minjj']);
								$maxjjstr="";
								foreach($v01 as $j=>$v){
									$maxstr = ((($v01[$j]-$v02[$j])/GetVar('fanDianMax'))* $userinfo['fandian']+$v02[$j]).'|';
									$maxjjstr .= sprintf("%.2f", filter_money($maxstr,2)).'|';
								}
								$Result['data'][$v0['playid']]['maxjj'] = substr($maxjjstr,0,-1) ;
							}else{
								$maxjj = ($Result['data'][$v0['playid']]['maxjj']-$Result['data'][$v0['playid']]['minjj'])/(GetVar('fanDianMax'))*($userinfo['fandian'])+$Result['data'][$v0['playid']]['minjj'];
								if(substr(explode('.',$maxjj)[1],0,2)=='99'){
									$Result['data'][$v0['playid']]['maxjj']=sprintf("%.2f", ceil($maxjj));
								}else{
									$Result['data'][$v0['playid']]['maxjj'] =sprintf("%.2f", filter_money($maxjj,2));
								}
							}
						}
						$Result['data'][$v0['playid']]['minxf'] = $groupinfo['min_'.$v0['playid']]?$groupinfo['min_'.$v0['playid']]:($Result['data'][$v0['playid']]['minxf']?$Result['data'][$v0['playid']]['minxf']:0);
						$Result['data'][$v0['playid']]['maxxf'] = $groupinfo['max_'.$v0['playid']]?$groupinfo['max_'.$v0['playid']]:($Result['data'][$v0['playid']]['maxxf']?$Result['data'][$v0['playid']]['maxxf']:0);
					}
			}
			$Result['rates'] = $Result['data'];

			unset($Result['data']);
			return $Result;
		}
	}

	function trend(){
		$lotteryname = I('code','jsk3');
		$this->assign('lotteryname',$lotteryname);
		$num = I('num',30,'intval');
		$_api = new \Lib\api;
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['num'] = $num;
		$Result = $_api->sendHttpClient('Api/Lottery/lotteryopencodes',$apiparam);
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
				if(in_array(1,$balls)){
					if($countarray[1]==2)
						$html .= '<td class="ball_red"><div class="s_ball">2</div><i>1</i></td>';
					else
						$html .= '<td class="ball_red">1</td>';
				}else{
					$html .= '<td class="f_green">1</td>';
				}
				if(in_array(2,$balls)){
					if($countarray[1]==2)
						$html .= '<td class="ball_red"><div class="s_ball">2</div><i>2</i></td>';
					else
						$html .= '<td class="ball_red">2</td>';
				}else{
					$html .= '<td class="f_green">2</td>';
				}
				if(in_array(3,$balls)){
					if($countarray[1]==2)
						$html .= '<td class="ball_red"><div class="s_ball">2</div><i>3</i></td>';
					else
						$html .= '<td class="ball_red">3</td>';
				}else{
					$html .= '<td class="f_green">3</td>';
				}
				if(in_array(4,$balls)){
					if($countarray[1]==2)
						$html .= '<td class="ball_red"><div class="s_ball">2</div><i>4</i></td>';
					else
						$html .= '<td class="ball_red">4</td>';
				}else{
					$html .= '<td class="f_green">4</td>';
				}
				if(in_array(5,$balls)){
					if($countarray[1]==2)
						$html .= '<td class="ball_red"><div class="s_ball">2</div><i>5</i></td>';
					else
						$html .= '<td class="ball_red">5</td>';
				}else{
					$html .= '<td class="f_green">5</td>';
				}
				if(in_array(6,$balls)){
					if($countarray[1]==2)
						$html .= '<td class="ball_red"><div class="s_ball">2</div><i>6</i></td>';
					else
						$html .= '<td class="ball_red">6</td>';
				}else{
					$html .= '<td class="f_green">6</td>';
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
		$this->display();
	}

	public function oldssc(){

        $lotteryname = I('code');
        $this->assign('lotteryname',$lotteryname);
        $_ssclist = C('cplist.ssc');
        foreach($_ssclist as $k=>$v){
            if($v['isopen']==0)unset($_ssclist[$k]);
        }
        $this->assign('ssclist',$_ssclist);
        $this->assign('nowcpinfo',$_ssclist[$lotteryname]);

        $this->assign('cptitle',$_ssclist[$lotteryname]['title']);
        $this->display();
    }


    //pk10
    public function oldpk10(){
        $lotteryname = I('code');
        $this->assign('lotteryname',$lotteryname);
        $_ssclist = C('cplist.pk10');
        foreach($_ssclist as $k=>$v){
            if($v['isopen']==0)unset($_ssclist[$k]);
        }
        $this->assign('ssclist',$_ssclist);
        $this->assign('nowcpinfo',$_ssclist[$lotteryname]);

        $this->assign('cptitle',$_ssclist[$lotteryname]['title']);
        $this->display();
    }
    //kl8
}
?>