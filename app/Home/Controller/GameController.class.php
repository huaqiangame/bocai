<?php
namespace Home\Controller;
use Think\Controller;
class GameController extends CommonController {
	public function __construct(){
		parent::__construct();
		if(!$this->userinfo){
			redirect(U("Public/login"));
		};
	}
//公用
  public function gameHeader(){
	  $gamecplist = S('gamecplist');
	  if(!$gamecplist){
		  $_allcp = M('Caipiao')->cache('gamecplist',300)->field('id,title,typeid,name')->where("isopen='1' AND iswh='0'")->order('listorder ASC')->select();
	  }else{
		  $_allcp = $gamecplist;
	  }
	  $this->assign('Allcp',$_allcp);
  }
//K3
	function k3(){
		$this->gameHeader();
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$_k3list = C('cplist.k3');
		foreach($_k3list as $k=>$v){
			if($v['isopen']==0)unset($_k3list[$k]);
		}
		//print_r($_k3list[$k]);//exit;
		$this->assign('k3list',$_k3list);
		$this->assign('nowcpinfo',$_k3list[$lotteryname]);

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
		
		$this->assign('rates',$Result);
		$this->assign('info',$info);
		$this->assign('cptypes',$cptypes);
		 $this->userkjmsg();
		$this->display();
	}
//SSC
	function ssc(){
		$this->gameHeader();
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
		$this->assign('rates',$Result);
		$this->assign('info',$info);
		$this->assign('cptypes',$cptypes);
		$this->userkjmsg();
		$this->display();
	}
	//pk10
	function pk10(){
		$this->gameHeader();
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$_ssclist = C('cplist.pk10');
		foreach($_ssclist as $k=>$v){
			if($v['isopen']==0){
			    unset($_ssclist[$k]);
            }
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
		$this->assign('rates',$Result);
		$this->assign('info',$info);
		$this->assign('cptypes',$cptypes);
		$this->userkjmsg();
		$this->display();
	}
	//快乐8
	function keno(){
		$this->gameHeader();
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
		$this->assign('rates',$Result);
		$this->assign('info',$info);
		$this->assign('cptypes',$cptypes);
		$this->userkjmsg();
		$this->display();
	}
	function x5(){
		$this->gameHeader();
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
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
		$this->assign('rates',$Result);
		$this->assign('info',$info);
		$this->assign('cptypes',$cptypes);
	   $this->userkjmsg();
		$this->display();
	}
	function dpc(){
		$this->gameHeader();
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
		$Result =  $this->userjj($Result);
		$this->assign('rates',$Result);
		$this->assign('info',$info);
		$this->assign('cptypes',$cptypes);
		 $this->userkjmsg();
		if($lotteryname=='fc3d'){
			$this->display("Game_fc3d");
		}
		if($lotteryname=='pl3'){
			$this->display("Game_pl3");
		}
		if($lotteryname=='df3d'){
			$this->display("Game_df3d");
		}
	}
	//六合彩
	function lhc(){
		$this->gameHeader();
		$lotteryname = I('code');
		$this->assign('lotteryname',$lotteryname);
		$_ssclist = C('cplist.lhc');
		foreach($_ssclist as $k=>$v){
			if($v['isopen']==0)unset($_ssclist[$k]);
		}
		$this->assign('ssclist',$_ssclist);
		$this->assign('nowcpinfo',$_ssclist[$lotteryname]);
		$typeid = 'lhc';
		$Result = S('lotteryrates_'.$typeid);
		if(!$Result){
			$apiparam=array();
			$apiparam['typeid'] = $typeid;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Lottery/lotteryrates',$apiparam);
			$sid = S('lotteryrates_'.$typeid,$Result,1);
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
		$this->userkjmsg();
		$this->display();
	}
	function userkjmsg(){
		$_usergrouplist = M('membergroup')->cache(60)->select();
		foreach($_usergrouplist as $k=>$v){
			$usergrouplist[$v['groupid']] = $v;
		}
		$testuids = [];
		$testusers = M('member')->where(['isnb'=>1])->field('id')->select();
		foreach($testusers as $k=>$v){
			$testuids[] = $v['id'];
		}
		$map = [];
		$map['oddtime'][]=array('egt',strtotime($StartTime));
		$map['oddtime'][]=array('elt',strtotime($EndTime));
		$map['isdraw']=array('eq',1);
		//$map['uid']=array('not in',$testuids);
		$list = M('touzhu')->field("cpname as k3name,uid,username,sum(okamount) as okamount")->where($map)->group("uid")->limit(30)->order("okamount desc")->select();
		foreach($list as $k=>$v){
			$userinfo  = [];
			$userinfo  = M('member')->where(['id'=>$v['uid']])->field('groupid,sex,face')->cache(300)->find();
			$v['sex']  = $userinfo['sex'];
			$v['face'] = is_file($userinfo['face'])?$userinfo['face']:'/resources/images/face/'.rand(1,25).'.jpg';
			$v['groupname'] = $usergrouplist[$userinfo['groupid']]['groupname'];
			$v['touhan'] = $usergrouplist[$userinfo['groupid']]['touhan'];
			$v['amountcount'] = $v['okamount'];
			$v['okamountcount'] = M('touzhu')->where("isdraw=1 AND uid='{$v['uid']}'")->SUM('okamount');
			$v["k3names"] = M('touzhu')->distinct ( true )->where ("uid='{$v['uid']}'")->field ( 'cpname as name,cptitle as title' )->cache(300)->limit(8)->select();
			$list[$k]    = $v;
		}
		$group = M('Membergroup')->field('groupid,groupname,touhan')->where('isagent <> 1')->order('groupid ASC')->select();
		if(count($list)<3){
			$list = $this->randking(1,$group);
		}
		$list=list_sort_by($list,'amountcount','desc');
		$this->assign('list',$list);
		$this->assign('list2',$list);
	}
	//随机资金榜
	public function randking($nocookie=null,$group){
		$nocookie?$no = 50 : $no =10;
		$allk3 = M('caipiao')->field("name,title")->where("status=1")->select();
		for ($i=0;$i<$no;$i++) {
			$count = rand(1,6); $num = rand(4,6); $num2  = rand(2,3);$num3  = rand(1,2);
			$user[$i]['username']     =  rand_strings($num,$count);
			$user[$i]['okamount'] =  rand_strings(1,7).rand_strings($num3,0);
			$user[$i]['face'] = '/resources/images/face/'.rand(1,25).'.jpg';
			$user[$i]['sex'] =  rand(0,2);
			$user[$i]['groupname'] =  $group[rand(0,8)]["groupname"];
			$user[$i]['k3name'] =  $allk3[rand(0,14)]['title'];

			$user[$i]["amountcount"]     =    rand_strings(1,7).rand_strings($num2,0);
			$user[$i]["okamountcount"]     =  ceil($user[$i]['amountcount'] * (rand(6,9).'.'.rand(1,9)));
		}
		$sedcon = strtotime(date("Y-m-d ")."23:59:59")-time();
		$user = list_sort_by($user,'amountcount','desc');
		$list =json_encode($user);
		if($nocookie){
			foreach ($user as $key=> $value){
				$user[$key]['k3names']= M('caipiao')->field("name,title")->limit(rand(0,3),6)->select();
				switch ($user[$key]['groupname']){
					case $group[0]['groupname']:
						$user[$key]['touhan'] = $group[0]['touhan'];
						break;
					case $group[1]['groupname']:
						$user[$key]['touhan'] = $group[1]['touhan'];
						break;
					case $group[2]['groupname']:
						$user[$key]['touhan'] = $group[2]['touhan'];
						break;
					case $group[3]['groupname']:
						$user[$key]['touhan'] = $group[3]['touhan'];
						break;
					case $group[4]['groupname']:
						$user[$key]['touhan'] = $group[4]['touhan'];
						break;
					case $group[5]['groupname']:
						$user[$key]['touhan'] = $group[5]['touhan'];
						break;
					case $group[6]['groupname']:
						$user[$key]['touhan'] = $group[6]['touhan'];
						break;
					case $group[7]['groupname']:
						$user[$key]['touhan'] = $group[7]['touhan'];
						break;
					case $group[8]['groupname']:
						$user[$key]['touhan'] = $group[8]['touhan'];
						break;
					case $group[9]['groupname']:
						$user[$key]['touhan'] = $group[9]['touhan'];
						break;
				}
			}
			return $user;
			exit();
		}else{
			cookie('list',$list,$sedcon);
		}
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
	//玩法说明
	function howtoplay(){ 
		$caipiao = M('caipiao')->field('typeid,title,firsttime,endtime,qishu,ftitle')->where("typeid='{$_GET['cz']}' AND name='{$_GET['name']}'")->find();
		 $this->assign('caipiao' ,$caipiao);

		switch ($_GET['cz'])
		{
			case "k3" :
				$tpl = 'howtoplayk3';
				break;
			case "ssc" :
				$tpl = 'howtoplayssc';
				break;
			case "keno" :
				$tpl = 'howtoplaykeno';
				break;
			case "pk10" :
				$tpl = 'howtoplaypk10';
				break;
			case "x5" :
				$tpl = 'howtoplayx5';
				break;
			case "dpc" :
				$tpl = 'howtoplaydpc';
				break;
			case "lhc" :
				$tpl = 'howtoplaylhc';
				break;

		} 
		$this->display($tpl);
	}
}
?>