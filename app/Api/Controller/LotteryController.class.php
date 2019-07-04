<?php
namespace Api\Controller;
use Lib\kaijiang\ssc;
use Think\Controller;
class LotteryController extends CommonController {
	public $_parent = array();
	protected $allowMethodList = array('getconfigs','lotterylist','lotterycode','getopencodes','lotterytimes','loadopencode','lotteryopencodes','lotteryrates','k3buy');
	//配置获取
	function getconfigs($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$fields = [
			'webtitle','keywords','description','iskillorder','sysBankMaxNum','tikuanMin','tikuanMax','ritikuanxiane','tikuanstart',
			'tikuanend','tikuannum','tikuannumoverbilv','tikuannumovermin','tikuannumovermax','paiduinum','pointchongzhi',
			'pointchongzhiadd','pointtouzhu','pointtouzhuadd','pointhuisun','pointhuisunadd','kefuthree','bindcardamount',
			'newmemberrecharge','newmemberrechargeamount','activity_cz0_money','activity_cz0_zsmoney','activity_cz1_money',
			'activity_cz1_zsmoney','activity_cz2_money','activity_cz2_zsmoney','riCommissionBase0_0','riCommissionBase0_1',
			'riCommissionBase1_2','riCommissionBase2_0','riCommissionBase2_1','riCommissionBase2_2','yueCommissionBase0_0',
			'yueCommissionBase0_1','yueCommissionBase0_2','yueCommissionBase1_0','yueCommissionBase1_1','yueCommissionBase1_2',
			'yueCommissionBase2_0','yueCommissionBase2_1','yueCommissionBase2_2','riKuisunBase0_0','riKuisunBase0_1',
			'riKuisunBase0_2','riKuisunBase1_0','riKuisunBase1_1','riKuisunBase1_2','riKuisunBase2_0','riKuisunBase2_1',
			'riKuisunBase2_2','yueKuisunBase0_0','yueKuisunBase0_1','yueKuisunBase0_2','yueKuisunBase1_0','yueKuisunBase1_1',
			'yueKuisunBase1_2','yueKuisunBase2_0','yueKuisunBase2_1','yueKuisunBase2_2','agentBonusBase0_0','agentBonusBase0_1',
			'agentBonusBase1_0','agentBonusBase1_1','agentBonusBase2_0','agentBonusBase2_1','agentBonusBase3_0','agentBonusBase3_1',
			'loginerrornum_q','loginerrorclosetime_q','ipblackisopen','ipblacklist','ipwhiteisopen','ipwhitelist','pointexchangeamount','kefuqq','defaulttjcode',
            'agent_commission_open','bancountry'
		];
		$_configs = M('setting')->where(['name'=>['in',$fields]])->select();

		foreach($_configs as $k=>$v){
			$configs[$v['name']] = $v['value'];
		}
		$configs['fuddetailtypes'] = C('fuddetailtypes');
		$_cplist = M('caipiao')->where(['isopen'=>1])->order('listorder asc')->cache(300)->select();
		foreach($_cplist as $k=>$v){
			$cplist[$v['typeid']][$v['name']] = $v;
		}
		$_gglist = M('gonggao')->order('id desc')->cache(300)->select();
		foreach($_gglist as $k1=>$v1){
			$gglist[$v1['id']] = $v1;
		}
		//支付接口列表
		$_bankpaylists = M('payset')->where(['state'=>1])->cache(300)->select();
		foreach($_bankpaylists as $k=>$v){
			$v['configs'] = unserialize($v['configs']);
			$bankpaylists[$v['paytype']] = $v;
		}
		//会员组列表
		$_membergrouplists = M('membergroup')->cache(300)->select();
		$_wfobj = new \Lib\wanfa;
		$getplayers1  = $_wfobj->getplayers('k3');
		$getplayers2  = $_wfobj->getplayers('ssc');
		$getplayers3  = $_wfobj->getplayers('pk10');
		$getplayers4  = $_wfobj->getplayers('keno');
		$getplayers5  = $_wfobj->getplayers('x5');
		$getplayers6  = $_wfobj->getplayers('dpc');
		$getplayers   = array_merge($getplayers1,$getplayers2);
		foreach($_membergrouplists as $k=>$v){
			$_xesetconfigs = unserialize($v['configs']);
			foreach($getplayers as $k0=>$v0){
				$v['min_'.$v0['playid']] = $_xesetconfigs['min_'.$v0['playid']]?$_xesetconfigs['min_'.$v0['playid']]:0;
				$v['max_'.$v0['playid']] = $_xesetconfigs['max_'.$v0['playid']]?$_xesetconfigs['max_'.$v0['playid']]:0;
			}
			$membergrouplists[$v['groupid']] = $v;
		}

		$typeid1 = 'k3';
		$rates1  = $getplayers1;
		$db = M('wanfa');
		foreach($rates1 as $k=>$v){
			$_rate1 = $db->where(['typeid'=>$typeid1,'playid'=>$v['playid']])->cache(300)->find();
			if(!isset($v['rate']))unset($_rate1['rate']);
			if($_rate1){
				if(!$_rate1['title'])unset($_rate1['title']);
				$rates1[$k] = array_merge($v,$_rate1);
			}else{
				unset($rates1[$k]);
			}

		}
		$typeid2 = 'ssc';
		$rates2  = $getplayers2;
		$db = M('wanfa');
		foreach($rates2 as $k=>$v){
			$_rate2 = $db->where(['typeid'=>$typeid2,'playid'=>$v['playid']])->cache(300)->find();
			if(!isset($v['rate']))unset($_rate2['rate']);
			if($_rate2){
				if(!$_rate2['title'])unset($_rate2['title']);
				$rates2[$k] = array_merge($v,$_rate2);
			}else{
				unset($rates2[$k]);
			}
		}
		$typeid3 = 'pk10';
		$rates3  = $getplayers3;
		$db = M('wanfa');
		foreach($rates3 as $k=>$v){
			$_rate3 = $db->where(['typeid'=>$typeid3,'playid'=>$v['playid']])->cache(300)->find();
			if(!isset($v['rate']))unset($_rate3['rate']);
			if($_rate3){
				if(!$_rate3['title'])unset($_rate3['title']);
				$rates3[$k] = array_merge($v,$_rate3);
			}else{
				unset($rates3[$k]);
			}
		}
		$typeid4 = 'keno';
		$rates4  = $getplayers4;
		$db = M('wanfa');
		foreach($rates4 as $k=>$v){
			$_rate4 = $db->where(['typeid'=>$typeid4,'playid'=>$v['playid']])->cache(300)->find();
			if(!isset($v['rate']))unset($_rate4['rate']);
			if($_rate4){
				if(!$_rate4['title'])unset($_rate4['title']);
				$rates4[$k] = array_merge($v,$_rate4);
			}else{
				unset($rates4[$k]);
			}
		}
		$typeid5 = 'x5';
		$rates5  = $getplayers5;
		$db = M('wanfa');
		foreach($rates5 as $k=>$v){
			$_rate5 = $db->where(['typeid'=>$typeid5,'playid'=>$v['playid']])->cache(300)->find();
			if(!isset($v['rate']))unset($_rate5['rate']);
			if($_rate5){
				if(!$_rate5['title'])unset($_rate5['title']);
				$rates5[$k] = array_merge($v,$_rate5);
			}else{
				unset($rates5[$k]);
			}
		}
		$typeid6 = 'dpc';
		$rates6  = $getplayers6;
		$db = M('wanfa');
		foreach($rates6 as $k=>$v){
			$_rate6 = $db->where(['typeid'=>$typeid6,'playid'=>$v['playid']])->cache(300)->find();
			if(!isset($v['rate']))unset($_rate6['rate']);
			if($_rate6){
				if(!$_rate6['title'])unset($_rate6['title']);
				$rates6[$k] = array_merge($v,$_rate6);
			}else{
				unset($rates6[$k]);
			}
		}

		if($configs){
			$apiparam['sign']    = true;
			$apiparam['message'] = '获取成功';
			$apiparam['configs'] = $configs;
			$apiparam['configs']['bankpaylists'] = $bankpaylists;
			$apiparam['configs']['cplist'] = $cplist;
			$apiparam['configs']['gglist'] = $gglist;
			$apiparam['configs']['membergroups'] = $membergrouplists;
			$apiparam['configs']['rates_k3'] = $rates1;
			$apiparam['configs']['rates_ssc'] = $rates2;
			$apiparam['configs']['rates_pk10'] = $rates3;
			$apiparam['configs']['rates_keno'] = $rates4;
			$apiparam['configs']['rates_x5'] = $rates5;
			$apiparam['configs']['rates_dpc'] = $rates6;
		}else{
			$apiparam['sign']    = false;
			$apiparam['message'] = '获取失败';
		}
		return $apiparam;
	}

	function lotterylist($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$order = $apiparam['order']?$apiparam['order']:'';
		$where = ($apiparam['where'] && is_array($apiparam['where']))?array_filter($apiparam['where']):[];
		$limit = $apiparam['limit']?$apiparam['limit']:'';
		$list = M('caipiao')->where($apiparam['where'])->order($apiparam['order'])->limit($apiparam['limit'])->select();
		$openinfo = [];
		foreach($list as $k=>$v){
			$openinfo = M('kaijiang')->where(['name'=>$v['name'],])->cache(30)->order('opentime desc')->field('opencode,expect')->find();
			$v['opencode'] = $openinfo['opencode'];
			$v['expect'] = $openinfo['expect'];
			$list[$k] = $v;
		}
		$apiparam['data'] = $list;
		return $apiparam;
	}

    function getoldplay($apiparam=array()){
        $apiparam = self::_cheacktoken($apiparam);
        if(!$apiparam['sign'])return $apiparam;
        $order = $apiparam['order']?$apiparam['order']:'id asc,sort asc';
        $where = $apiparam['where'] ? $apiparam['where']:[];
        $limit = $apiparam['limit']?$apiparam['limit']:'';
        $list = M('wanfa_old')->where($where)->order($order)->limit($limit)->select();
        $open = C('agent_commission_open');
        $data = array();
		foreach($list as $index=> $val) {
            $val['fandian'] = $apiparam['userinfo']['fandian'];
		    if($open){
                $val['rate'] = $val['rate'] - $val['rate']*(GetVar('fanDianMax')-$apiparam['userinfo']['fandian'])/100;
                $val['rate'] = sprintf("%.2f",$val['rate']);
            }
			if(!$val['class2']){
				$data[$val['class1']][0][] = $val;
			}else{
				$data[$val['class1']][$val['class2']][] = $val;
			}
		}
		$rs = array();
		foreach($data as $key=> $val){
			$rs[] = array_merge(array('name'=>$key),$val);
		}
		echo json_encode($rs);
	}

    function getOldWf($apiparam=array()){
        $order = $apiparam['order']?$apiparam['order']:'typeid asc,sort asc';
        $where = $apiparam['where'] ? $apiparam['where']:[];
        $limit = $apiparam['limit']?$apiparam['limit']:'';
        $list = M('wanfa_old')->where($where)->order($order)->limit($limit)->select();

        $data = array();
        foreach($list as $val) {
            $data[$val['id']] = $val;
        }
        return $data;
    }


	function lotterycode($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;

		$where = ($apiparam['where'] && is_array($apiparam['where']))?array_filter($apiparam['where']):[];

		$info = M('kaijiang')->where($where)->order('opentime desc')->field('id,addtime,isdraw,source',true)->find();
		if($info['opentime'])$info['opentime']  = date('Y-m-d H:i:s',$info['opentime']);
		$apiparam['data'] = $info;
		return $apiparam;
	}
	function getopencodes($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;

		$cplist = M('caipiao')->where(['isopen'=>1])->cache(60,true)->field('name')->select();
		$opencodes = [];
		foreach($cplist as $k=>$v){
			$openinfo = [];
			$openinfo = M('kaijiang')->where(['name'=>$v['name']])->order('id desc')->field('expect,opencode,opentime')->find();
			$opencodes[$v['name']] = $openinfo?$openinfo:[];
		}
		$apiparam['opencodes'] = $opencodes;
		return $apiparam;
	}
	//赔率
	function lotteryrates($apiparam=array()){
		//$apiparam = self::_cheacktoken($apiparam);
		//if(!$apiparam['sign'])return $apiparam;
		$typeid = $apiparam['typeid'];
		//$typeid = 'k3';
		$_wfobj = new \Lib\wanfa;
		$rates  = $_wfobj->getplayers($typeid);
		if(!in_array($typeid,['ssc','k3','x5','keno','xy28','kl10f','pk10','dpc','lhc'])){
			$apiparam['sign'] = false;
			$apiparam['message'] = '彩种ID不存在';
			return $apiparam;
		}
        $userinfo=session('userinfo');
		$db = M('wanfa');
		foreach($rates as $k=>$v){
			$_rate1 = $db->where(['typeid'=>$typeid,'playid'=>$v['playid']])->cache(300)->find();
            $_rate1['fandian'] = $userinfo['fandian'];
            $_rate1['back_scale'] = ($_rate1['maxjj']-$_rate1['minjj'])/GetVar('fanDianMax')/10;
			if(!isset($v['rate'])){
			    unset($_rate1['rate']);
            }
			if($_rate1){
				if(!$_rate1['title'])unset($_rate1['title']);
				$rates[$k] = array_merge($v,$_rate1);
			}else{
				unset($rates[$k]);
			}
		}
		$apiparam['data'] = $rates;
		//print_r($apiparam['data']);exit;
		return $apiparam;

	}
	function lotterytimes($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;

		$shortName = $apiparam['lotteryname'];
		//$shortName = I('lotteryname');;
		if(!$shortName){
			$apiparam['sign'] = false;
			$apiparam['message'] = '参数错误1';
			return $apiparam;
		}
		$cpinfo = M('caipiao')->where(["name"=>$shortName])->cache(300)->find();
		if(!$cpinfo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '未知彩票';
			return $apiparam;
		}
		if($cpinfo['isopen']!=1){
			$apiparam['sign'] = false;
			$apiparam['message'] = '彩种已关闭';
			return $apiparam;
		}
		$_classfile = COMMON_PATH . 'Lib/lotterytimes/'.$shortName.'.class.php';
		if(!is_file($_classfile)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '开奖时间错误';
			return $apiparam;
		}
		$_lotterytimesclass = "Lib\\lotterytimes\\{$shortName}";
		$_lotterytimes = new $_lotterytimesclass;
		$_lottetimes = $_lotterytimes->drawtimes();
		//dump($_lotterytimes);
		//dump($_lottetimes);exit;
		if($_lottetimes['lastFullExpect']){
			$return = array_merge($_lottetimes,['shortname'=> $cpinfo['title'],'status' =>$cpinfo['isopen'],'message'=> 'OK',]);
			$apiparam['sign'] = true;
			$apiparam['message'] = '获取成功';
			$apiparam['data'] = $return;
			return $apiparam;
		}else{
			$apiparam['sign'] = false;
			$apiparam['message'] = '获取失败';
		}
		return $apiparam;
	}
	function loadopencode($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;

		//$shortName = I('lotteryname');;
		$lotteryname = $apiparam['lotteryname'];
		$expect      = $apiparam['expect'];
		if(!$lotteryname){
			$apiparam['sign'] = false;
			$apiparam['message'] = '参数错误(缺少lotteryname)';
			return $apiparam;
		}
		$map = [];
		if($lotteryname)$map['name'] = ['eq',$lotteryname];
		if($expect)$map['expect'] = ['eq',$expect];
		$kjinfo = M('kaijiang')->where($map)->field('name,title,opencode,sourcecode,remarks,expect,opentime')->order('expect desc')->find();

		if(!$kjinfo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '未开奖';
			return $apiparam;
		}
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功！';
		$apiparam['data'] = $kjinfo;
		//print_r($apiparam);exit;
		return $apiparam;
	}
	function lotteryopencodes($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;

		//$shortName = I('lotteryname');;
		$lotteryname = $apiparam['lotteryname'];
		$num         = $apiparam['num']?$apiparam['num']:10;
		$num         = $num>50?50:$num;
		if(!$lotteryname){
			$apiparam['sign'] = false;
			$apiparam['message'] = '参数错误(缺少lotteryname)';
			return $apiparam;
		}
		$map = [];
		$map['name'] = ['eq',$lotteryname];
		$list = M('kaijiang')->where($map)->field('name,title,opencode,sourcecode,remarks,expect,opentime')->limit($num)->order('expect desc')->select();

		if(!$list){
			$apiparam['sign'] = false;
			$apiparam['message'] = '开奖获取失败';
			return $apiparam;
		}
		$apiparam['sign'] = true;
		$apiparam['message'] = '开奖获取成功！';
		$apiparam['data'] = $list;
		return $apiparam;
	}

	//orderList=array 投注信息
	function cpbuy($apiparam=array()){
	    //var_dump($apiparam);exit;
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];     //获取会员信息
		unset($apiparam["data"]);         //删除多余数组
		unset($apiparam["sign"]);
		unset($apiparam["message"]);
		if(!in_array(strtolower($apiparam["orderList"]["source"]),['pc','mobile'])){   //判断投注来源
			$apiparam['sign'] = false;
			$apiparam['message'] = '非法来源';
			return $apiparam;
		}
		//彩种判断
		$lotteryname = $apiparam["orderList"]["lotteryname"];        //彩种标识
		$expect = $apiparam["orderList"]["expect"];                  //期号
		$cpinfo = M('caipiao')->where(['name'=>$lotteryname])->find();  //获取彩种信息
		if(!$cpinfo){
			return(['sign'=>false,'message'=>'彩种不存在']);
		}
		if($cpinfo['isopen']==0){
			return(['sign'=>false,'message'=>'当前彩种已关闭投注']);
		}
		if($cpinfo['iswh']==1){
			return(['sign'=>false,'message'=>'当前彩种维护中']);
		}
		//时间判断
		$_lotterytimesclass = "Lib\\lotterytimes\\{$lotteryname}";
		$_lotterytimes = new $_lotterytimesclass;                //获取当前彩种类文件
		$_lottetimes = $_lotterytimes->drawtimes();             //获取彩种剩余时间

		if($_lottetimes['currFullExpect']!=$expect){            //根椐期号判断彩种是否过期
			$apiparam['sign'] = false;
			$apiparam['message'] = '当前彩种已截至投注';
			return $apiparam;
		}
		$lastkjinfo = M('kaijiang')->where(['name'=>$lotteryname,'expect'=>$expect])->find();

		if($lastkjinfo){ //判断当前彩种期号是存在
			$apiparam['sign'] = false;
			$apiparam['message'] = '当前彩种已截至投注';
			return $apiparam;
		}
		//取玩法
		$typeid = $cpinfo['typeid'];
		if(!in_array($typeid,['ssc','k3','x5','keno','xy28','kl10f','pk10','dpc','lhc'])){
			$apiparam['sign'] = false;
			$apiparam['message'] = '彩种ID不存在';
			return $apiparam;
		}
		$db = M('wanfa');
		$_wfobj = new \Lib\wanfa;
		$rates  = $_wfobj->getplayers($typeid);
		foreach($rates as $k=>$v){
			$_rate1 = $db->where(['typeid'=>$typeid,'playid'=>$v['playid']])->cache(60)->find();
			if(!isset($v['rate']))unset($_rate1['rate']);
			if($_rate1){
				if(!$_rate1['title'])unset($_rate1['title']);
				$rates[$k] = array_merge($v,$_rate1);
			}else{
				unset($rates[$k]);
			}
		}
		$membergroup = M('membergroup')->where(['groupid'=>$userinfo['groupid']])->cache(60)->find();//获取会员组信息
		$_rateconfigs = unserialize($membergroup['configs']);  //会员组设置
        $open = C('agent_commission_open');
		foreach($rates as $k0=>$v0){
			$rateinfo = [];
			$rateinfo = M('wanfa')->where(['typeid'=>$typeid,'playid'=>$v0['playid']])->cache(60)->find();
			$v0 = array_merge($v0,$rateinfo);
			$rateinfo['minxf'] = $_rateconfigs['min_'.$rateinfo['playid']]?$_rateconfigs['min_'.$rateinfo['playid']]:$rateinfo['minxf'];
			$rateinfo['maxxf'] = $_rateconfigs['max_'.$rateinfo['playid']]?$_rateconfigs['max_'.$rateinfo['playid']]:$rateinfo['maxxf'];
            if($typeid == 'lhc' || $typeid == 'k3'){
                if($open){
                    $rateinfo['rate'] =$v0['rate'] - $v0['rate']*(GetVar('fanDianMax')-$userinfo['fandian'])/100;
                    $rateinfo['rate'] = sprintf("%.2f",$rateinfo['rate']);
                }
            }
			$rates[$k0] = $rateinfo;
		}
		$_REQUEST = [];
		$_REQUEST = $apiparam["orderList"];
		$totalprice = 0;
		foreach($_REQUEST['orderList'] as $k=>$v){
			if(!$rates[$v['playid']]){
				return(['sign'=>false,'message'=>$v['playtitle'].'玩法不存在']);
			}
            if(!$rates[$v['playid']]['isopen']){
                return(['sign'=>false,'message'=>$v['playtitle'].'玩法维护中']);
            }
			if(!$v['playid']){
				return(['sign'=>false,'message'=>$v['playtitle'].'缺少玩法参数或玩法无法识别']);
			}
			if($v['playid']=='k3ethdx'){
				$tznumbers = explode('#',$v['number']);
				foreach($tznumbers as $ck=>$cv){
					if(count(array_unique(str_split($cv,1)))!=2){
						return(['sign'=>false,'message'=>$v['playtitle']."-不得含有豹子号"]);
					}
				}
			}
			if(intval($rates[$v['playid']]['minxf'])>0 && $v['price']<$rates[$v['playid']]['minxf']){
				return(['sign'=>false,'message'=>$v['playtitle'].'最低投注金额为'.$rates[$v['playid']]['minxf']]);
			}
			if(intval($rates[$v['playid']]['maxxf'])>0){
				$_grouptzmap = [];
				$_grouptzmap['uid']    = ['eq',$userinfo['id']];
				$_grouptzmap['playid'] = ['eq',$v['playid']];
				$_grouptzmap['isdraw'] = ['eq',0];
				$_grouptzmap['cpname'] = ['eq',$cpinfo['name']];
				$_grouptzmap['expect'] = ['eq',$expect];
				$_oktztotal = M('touzhu')->where($_grouptzmap)->sum('amount');
 					  if(strstr($_REQUEST['lotteryname'],'ssc') || strstr($_REQUEST['lotteryname'],'hnwfc')
                          || strstr($_REQUEST['lotteryname'],'xjp2fc'))$zyclass ="ssc"; //
					  if(strstr($_REQUEST['lotteryname'],'pk10') || strstr($_REQUEST['lotteryname'],'xyft')
                          ||strstr($_REQUEST['lotteryname'],'ozpk10') )$zyclass ="pk10";
					  if(strstr($_REQUEST['lotteryname'],'x5'))$zyclass ="x5";
					  if(strstr($_REQUEST['lotteryname'],'keno'))$zyclass ="keno";
					  if(strstr($_REQUEST['lotteryname'],'pl3'))$zyclass ="dpc";
					  if(strstr($_REQUEST['lotteryname'],'fc3d'))$zyclass ="dpc";
					  if(strstr($_REQUEST['lotteryname'],'df3d'))$zyclass ="dpc";
					  if(strstr($_REQUEST['lotteryname'],'lhc'))$zyclass ="lhc";
					  if(strstr($_REQUEST['lotteryname'],'k3'))$zyclass ="k3";
					  $_zhushuyzclass = "Lib\\yzwanfa\\{$zyclass}";
					  $_zhushuyz = new $_zhushuyzclass;
					  //echo $v['playid'].'---'.$v['number'];exit;
					  $countzhushu = $_zhushuyz->checkzhushu($v['playid'],$v['number']);
					  //echo $countzhushu.'---'.$v['zhushu'];exit;
					  if($countzhushu!=$v['zhushu']){ //判断注数是否正确
						  $this->ajaxReturn(['sign'=>false,'message'=>'非法操作11']);exit;
					  }
					if($v['playtitle']!=$rates[$v['playid']]['title']){   //判玩法标题
						$this->ajaxReturn(['sign'=>false,'message'=>"非法操作3"]);exit;
					};
				if(!strstr($_REQUEST['lotteryname'],'k3')){ 
                   if(!strstr($_REQUEST['lotteryname'],'lhc')){
						  if(($v['price']/$v['zhushu']/$v['beishu']/$v['yjf'])!=2){    //断码每注金额是否正确
							  $this->ajaxReturn(['sign'=>false,'message'=>'非法操作2']);exit;
						  }
						  if(strstr($rates[$v['playid']]['maxjj'],'|')){         //判断实际奖金是否正确
							  $v1 = explode('|',$rates[$v['playid']]['maxjj']);  //最大奖金
							  $v2 = explode('|',$rates[$v['playid']]['minjj']);  //最小奖金
								  $maxjj="";
								  foreach($v1 as $j=>$val){
									  $maxstr = ((($v1[$j]-$v2[$j])/GetVar('fanDianMax'))* $userinfo['fandian']+$v2[$j]).'|';
									  $maxjj .= sprintf("%.2f", filter_money($maxstr,2)).'|';
								  }
								  $maxjj = substr($maxjj,0,-1) ;

							  }else{
								  $maxjj = ($rates[$v['playid']]['maxjj']-$rates[$v['playid']]['minjj'])/(GetVar('fanDianMax'))*($userinfo['fandian'])+$rates[$v['playid']]['minjj'];
								  if(substr(explode('.',$maxjj)[1],0,2)=='99'){
									  $maxjj=sprintf("%.2f", ceil($maxjj));
								  }else{
									  $maxjj =sprintf("%.2f", filter_money($maxjj,2));
								  }
						  }
						  $rate = $maxjj;
/*						  if($v['rate']!=$maxjj){   //非六合彩判断实际奖金是否正确
							  $this->ajaxReturn(['sign'=>false,'message'=>"非法操作3"]);exit;
						  };*/
				   }else{
                        $rate = $rates[$v['playid']]['rate'];
/*					   if($v['rate']!=$rates[$v['playid']]['rate']){   //六合彩判断实际赔率是否正确
						   $this->ajaxReturn(['sign'=>false,'message'=>"非法操作4"]);exit;
					   };*/
			      }

					$_tzamonut  = $v['price'];    //全部注数总金额
					if( $_tzamonut > intval($rates[$v['playid']]['maxxf']) ){
						return(['sign'=>false,'message'=>$v['playtitle']."最高投注金额为".$rates[$v['playid']]['maxxf']]);
					}
				}else{
					$_tzamonut  = $v['price'] * $v["zhushu"]; //K3 每注金额
					if( ( $_oktztotal + $_tzamonut ) > intval($rates[$v['playid']]['maxxf']) ){
						return(['sign'=>false,'message'=>$v['playtitle']."最高投注金额为".$rates[$v['playid']]['maxxf']]);
					}
					$rate = $rates[$v['playid']]['rate'];
/*				   if($v['rate']!=$rates[$v['playid']]['rate']){   //判断实际赔率是否正确
					   $this->ajaxReturn(['sign'=>false,'message'=>"非法操作5"]);exit;
				   };*/
				}
				if($userinfo['fandian']<$v['fandian'] || $v['fandian']<0){
                    $this->ajaxReturn(['sign'=>false,'message'=>"非法操作参数！"]);exit;
                }

				if($v['fandian']){
				    $user_rate = ($rates[$v['playid']]['maxjj']-$rates[$v['playid']]['minjj'])/GetVar('fanDianMax');
				    $rate = $rate - $user_rate* $v['fandian'];
				    $a = strval($rate);
				    $b = strval($v['rate']);
				    //$a = intval($rate * 100);
				    //$b = intval($v['rate'] * 100);
                    if($a != $b){
                        $this->ajaxReturn(['sign'=>false,'message'=>"赔率非法"]);exit;
                    }
                }elseif($v['rate'] != $rate ){
                    $this->ajaxReturn(['sign'=>false,'message'=>"赔率非法"]);exit;
                }
			}
			if(intval($v['zhushu'])<=0){
				return(['sign'=>false,'message'=>$v['playtitle'].'投注注数错误']);
			}
			if(intval($v['totalzs'])<=0){
				return(['sign'=>false,'message'=>$v['playtitle']."系统参数[总注数]设置错误"]);
			}
			if(intval($v['zhushu'])>intval($v['totalzs'])){
				return(['sign'=>false,'message'=>$v['playtitle']."最高{$v['totalzs']}注"]);
			}

			if(strstr($_REQUEST['lotteryname'],'k3') ){
				if(count(explode('#',$v['number']))!=intval($v['zhushu']) ){
					$this->ajaxReturn(['sign'=>false,'message'=>$v['playtitle']."-系统检测到您的投注注数异常1"]);exit;
				}
				$totalprice += $v['price'] * $v["zhushu"];
			}else{
				$totalprice += $v['price'];
			}
		}

		if($userinfo['islock']==1){
			return(['sign'=>false,'message'=>"系统参数[总注数]设置错误"]);
		}
		if($userinfo['balance']<$totalprice){
			return(['sign'=>false,'message'=>"账户余额不足"]);
		}

		$_t = time();
		$tzdb = M('touzhu');
		$memdb = M('member');
		foreach($_REQUEST['orderList'] as $k=>$v){
			$data = [];
			$trano          = gettrano(1);
			$data['isdraw'] = 0;
			$data['trano']  = $trano;
			if($v['yjf'])$data['yjf'] = $v['yjf'];
			$data['typeid'] = $cpinfo['typeid'];
			$data['playid'] = $v['playid'];
			$data['playtitle']  = $rates[$v['playid']]['title'];
			$data['cptitle']  = $cpinfo['title'];
			$data['cpname']  = $cpinfo['name'];
			$data['expect']  = $expect;
			$data['uid']  = $userinfo['id'];
			$data['username']  = $userinfo['username'];
			$data['itemcount']  = $v['zhushu'];
			if($typeid!='k3' && $typeid!='lhc')$data['beishu']  = $v['beishu'];
			$data['tzcode']  = $v['number'];

			if(!strstr($_REQUEST['lotteryname'],'k3')){
				$data['amount']  = $v['price'];
				//$data['mode']    = $v['rate'];
			} else{
				$data['amount']  = $v['price'] * $v["zhushu"];
				//$data['mode']  = $rates[$v['playid']]['rate'];
			}
			$data['mode'] = $v['rate'];
            if ($typeid == 'lhc' && $data['playid']== 'tmzx2'){
                $data['repoint']  = 7;
                $data['repointamout']  = $data['amount']*(7/100);
            }else{
                $data['repoint']  = 0;
                $data['repointamout']  = 0;
            }
            if($v['fandian']){
                $data['repoint'] = $v['fandian'];
                $data['repointamout'] = $data['amount'] * $v['fandian'] /100;
            }

			$data['okamount']  = 0;
			$data['okcount']  = 0;
			$data['Chase']  = 0;
			$data['stopChase']  = 0;
			$data['oddtime']  = $_t;
			$data['opencode']  = '';
			$data['source']  = $_REQUEST["source"];

			$oldamount = $memdb->where(['id'=>$userinfo['id']])->getField('balance');//投注前金额
			$data['amountbefor']  = $oldamount;
			$data['amountafter']  = $oldamount - $data['amount'];

			$addints[] = $_int = $tzdb->data($data)->add();
            $agentCommissionOpen = M('setting')->where(['name'=>'agent_commission_open'])->getField('value');
            //给自己返点
            $agent_model = M('dailifandian');
            if ($v['fandian'] > 0 && $v['fandian'] <= $userinfo['fandian']) {
                $member_data = M('Member')->where("id='{$userinfo['id']}'")->getField('balance');
                M('member')->where("id='{$userinfo['id']}'")->setInc('balance', $data['repointamout']);

                $back_amount = [];
                $back_amount['trano'] = $trano;
                $back_amount['uid'] = $userinfo['id'];
                $back_amount['username'] = $userinfo['username'];
                $back_amount['type'] = 'yongjinshenhe';
                $back_amount['typename'] = '返点发放通过';
                $back_amount['remark'] = '返点发放通过';
                $back_amount['oddtime'] = NOW_TIME;
                $back_amount['amount'] = $data['repointamout'];
                $back_amount['amountbefor'] = $member_data;
                $back_amount['amountafter'] = $member_data + $member_data['amount'];
                M('fuddetail')->data($back_amount)->add();
            }

		 if($typeid != 'lhc' && $userinfo['parentid'] !='0' && $agentCommissionOpen){//$typeid != 'k3' &&
			$i = 1;
			$this->dailifandian($userinfo['parentid'],$userinfo['fandian'],$data['amount'],$trano,$userinfo['id'],$userinfo['username'],$userinfo['fandian'],$i);
             foreach($this->_parent as $val){
				$dailidata['uid'] = $val['uid'];
				$dailidata['username'] = $val['username'];
				$dailidata['amount'] = $val['fandianjine'];
				$dailidata['touzhujine'] = $val['touzhujine'];
				$dailidata['trano'] = $val['trano'];
				$dailidata['fandian'] = $val['fandian'];
				$dailidata['shenhe'] = 1;
				$dailidata['xiajiid'] = $val['xiajiid'];
				$dailidata['xiajiuser'] = $val['xiajiuser'];
				$dailidata['xiajifandian'] = $val['xiajifandian'];
				$dailidata['oddtime'] = time();
                 $agent_model->add($dailidata);

				$amountbefor = M('Member')->where("id='{$dailidata['uid']}'")->getField('balance');
				M('member')->where("id='{$dailidata['uid']}'")->setInc('balance',$dailidata['amount']);
				//添加会员账户明细
				$fuddetaildata = [];
				$fuddetaildata['trano']      = $dailidata['trano'];
				$fuddetaildata['uid']      = $dailidata['uid'];
				$fuddetaildata['username'] =  $dailidata['username'];
				$fuddetaildata['type']     = 'yongjinshenhe';
				$fuddetaildata['typename']     = '佣金发放通过';
				$fuddetaildata['remark']       = $remark?$remark:'佣金发放通过';
				$fuddetaildata['oddtime']     = NOW_TIME;
				$fuddetaildata['amount']   = $dailidata['amount'];
				$fuddetaildata['amountbefor']   = $amountbefor;
				$fuddetaildata['amountafter']   = $amountbefor + $dailidata['amount'];
				M('fuddetail')->data($fuddetaildata)->add();

			   }
			}
			if($_int){//操作账户金额、日志等
				//会员账户金额、积分、洗码金额
				$_membercenter = $memdb->where(['id'=>$userinfo['id']])->field('balance,point,xima')->find();
				//投注
				$memdb->where(['id'=>$userinfo['id']])->setDec('balance',$data['amount']);
				$fuddetail_data = array();
				$fuddetail_data['trano'] = $trano;
				$fuddetail_data['uid'] = $userinfo['id'];
				$fuddetail_data['username'] = $userinfo['username'];
				$fuddetail_data['amount'] = abs($data['amount']);
				$fuddetail_data['amountbefor'] = $_membercenter['balance'];
				$fuddetail_data['amountafter'] = $_membercenter['balance']-abs($data['amount']);
				$fuddetail_data['oddtime'] = $_t;
				$fuddetail_data['remark'] = "投注扣费，彩种:{$cpinfo['title']},{$expect}";
				$fuddetail_data['type'] = 'order';
				$fuddetail_data['typename'] = C('fuddetailtypes.order');
				M('fuddetail')->data($fuddetail_data)->add();

            //洗码
                if($_membercenter['xima']>0){
                    $ximaamount = $data['amount'];
                    if($data['amount']>$_membercenter['xima']){
                        $ximaamount = $_membercenter['xima'];
                    }
                    $memdb->where(['id'=>$userinfo['id']])->setDec('xima',$ximaamount);
                    $fuddetail_data = array();
                    $fuddetail_data['trano'] = $trano;
                    $fuddetail_data['uid'] = $userinfo['id'];
                    $fuddetail_data['username'] = $userinfo['username'];
                    $fuddetail_data['amount'] = abs($ximaamount);
                    $fuddetail_data['amountbefor'] = $_membercenter['xima'];
                    $fuddetail_data['amountafter'] = $_membercenter['xima']-abs($ximaamount);
                    $fuddetail_data['oddtime'] = $_t;
                    $fuddetail_data['remark'] = "投注减，彩种:{$cpinfo['title']},{$expect}";
                    $fuddetail_data['type'] = 'xima';
                    $fuddetail_data['typename'] = C('fuddetailtypes.xima');
                    M('fuddetail')->data($fuddetail_data)->add();
                }else{
                    $memdb->where(['id'=>$userinfo['id']])->setField('xima',0);
                }

				//每消费增加积分
				/*	$pointtouzhu    = intval(GetVar('pointtouzhu'));
                    $pointtouzhuadd = intval(GetVar('pointtouzhuadd'));
                                    if($pointtouzhu>0 && $pointtouzhuadd>0){
                                        $_addpoint = number_format(abs($data['amount'])*$pointtouzhuadd/$pointtouzhu,4,".","");
                                        if($_addpoint>0){
                                            $memdb->where(['id'=>$userinfo['id']])->setInc('point',$_addpoint);
                                            $fuddetail_data = array();
                                            $fuddetail_data['trano'] = $trano;
                                            $fuddetail_data['uid'] = $userinfo['id'];
                                            $fuddetail_data['username'] = $userinfo['username'];
                                            $fuddetail_data['amount'] = abs($_addpoint);
                                            $fuddetail_data['amountbefor'] = $_membercenter['point'];
                                            $fuddetail_data['amountafter'] = $_membercenter['point']+abs($_addpoint);
                                            $fuddetail_data['oddtime'] = $_t;
                                            $fuddetail_data['remark'] = "投注送积分，彩种:{$cpinfo['title']},{$expect}";
                                            $fuddetail_data['type'] = 'point';
                                            $fuddetail_data['typename'] = C('fuddetailtypes.point');
                                            M('fuddetail')->data($fuddetail_data)->add();
                                        }
                                    }*/
			}
			//$apiparam['data'][] = $data;
		}
		if(count(array_filter($addints))>0){
			$apiparam['sign'] = true;
			$apiparam['message'] = '投注成功';
		}else{
			$apiparam['sign'] = false;
			$apiparam['message'] = '投注失败1';
		}
		return $apiparam;
	}


    //orderList=array 投注信息
    function oldcpbuy($apiparam=array()){
        $apiparam = self::_cheacktoken($apiparam);
        if(!$apiparam['sign'])return $apiparam;
        $apiparam = checklogin($apiparam);
        if(!$apiparam['sign'])return $apiparam;
        $userinfo = $apiparam["data"];     //获取会员信息
        unset($apiparam["data"]);         //删除多余数组
        unset($apiparam["sign"]);
        unset($apiparam["message"]);
        if(!in_array(strtolower($apiparam["orderList"]["source"]),['pc','mobile'])){   //判断投注来源
            $apiparam['sign'] = false;
            $apiparam['message'] = '非法来源';
            return $apiparam;
        }
        //彩种判断
        $lotteryname = $apiparam["orderList"]["lotteryname"];        //彩种标识
        $expect = $apiparam["orderList"]["expect"];                  //期号
        $cpinfo = M('caipiao')->where(['name'=>$lotteryname,'is_old'=>1])->find();  //获取彩种信息
        if(!$cpinfo){
            return(['sign'=>false,'message'=>'彩种不存在']);
        }
        if($cpinfo['isopen']==0){
            return(['sign'=>false,'message'=>'当前彩种已关闭投注']);
        }
        if($cpinfo['iswh']==1){
            return(['sign'=>false,'message'=>'当前彩种维护中']);
        }
        //时间判断
        $_lotterytimesclass = "Lib\\lotterytimes\\{$lotteryname}";
        $_lotterytimes = new $_lotterytimesclass;                //获取当前彩种类文件
        $_lottetimes = $_lotterytimes->drawtimes();             //获取彩种剩余时间
        //echo ($_lottetimes['currFullExpect'].'----'.$expect);exit;
        if($_lottetimes['currFullExpect']!=$expect){            //根椐期号判断彩种是否过期
            $apiparam['sign'] = false;
            $apiparam['message'] = '当前彩种已截至投注1';
            return $apiparam;
        }
        $lastkjinfo = M('kaijiang')->where(['name'=>$lotteryname,'expect'=>$expect])->find();

        if($lastkjinfo){ //判断当前彩种期号是存在
            $apiparam['sign'] = false;
            $apiparam['message'] = '当前彩种已截至投注2';
            return $apiparam;
        }
        //取玩法
        $typeid = $cpinfo['typeid'];
        if(!in_array($typeid,['ssc','k3','x5','keno','xy28','kl10f','pk10','dpc','lhc'])){
            $apiparam['sign'] = false;
            $apiparam['message'] = '彩种ID不存在';
            return $apiparam;
        }

        //here
        $_REQUEST = [];
        $_REQUEST = $apiparam["orderList"];
        $totalprice = 0;
        foreach($_REQUEST['orderList'] as $k=>$v){
            $amount = intval($v['price']);
            if(!$v['id']){
                return(['sign'=>false,'message'=>$v['id'].'缺少玩法参数或玩法无法识别']);
            }
            $rate = M('wanfa_old')->where(['id'=>$v['id'],'typeid'=>$typeid])->find();

            if(!$rate){
                return(['sign'=>false,'message'=>$v['id'].'玩法不存在']);
            }
            if($rate['class2']){
                $title = $rate['class1'].'-'.$rate['class2'].'-'.$rate['class3'];
            }else{
                $title = $rate['class1'].'-'.$rate['class3'];
            }
            if(!$rate['isopen']){
                return(['sign'=>false,'message'=>$title.'玩法维护中']);
            }
            if(intval($rate['minxf'])>0 && $amount<$rate['minxf']){
                return(['sign'=>false,'message'=>$title.'最低投注金额为'.$rate['minxf']]);
            }
            if(intval($rate['maxxf'])>0){
                $_grouptzmap = [];
                $_grouptzmap['uid']    = ['eq',$userinfo['id']];
                $_grouptzmap['playid'] = ['eq',$v['id']];
                $_grouptzmap['isdraw'] = ['eq',0];
                $_grouptzmap['cpname'] = ['eq',$cpinfo['name']];
                $_grouptzmap['expect'] = ['eq',$expect];
                $_grouptzmap['play_type'] = ['eq',1];
                $_oktztotal = M('touzhu')->where($_grouptzmap)->sum('amount');

                $_tzamonut  = $amount;
                if( ( $_oktztotal + $_tzamonut ) > intval($rate['maxxf']) ){
                    return(['sign'=>false,'message'=>$title."最高投注金额为".$rate['maxxf']]);
                }

                $open = C('agent_commission_open');
                if($open){
                    $rate['rate'] = $rate['rate'] - $rate['rate']*(GetVar('fanDianMax')-$userinfo['fandian'])/100;
                    $rate['rate'] = sprintf("%.2f",$rate['rate']);
                }

                if($v['fandian']){
                    $newRate = $rate['rate'] - sprintf("%.2f",round($rate['rate']) / 100 * $v['fandian']);
                    $a = strval($newRate);
                    $b = strval($v['rate']);
                    //$a = intval($newRate * 100);
                    //$b = intval($v['rate'] * 100);
                    if($a != $b){
                        $this->ajaxReturn(['sign'=>false,'message'=>"赔率非法"]);exit;
                    }
                }elseif($v['rate'] != $rate['rate'] ){
                    $this->ajaxReturn(['sign'=>false,'message'=>"赔率非法"]);exit;
                }
            }

            $totalprice += $amount;
        }

        if($userinfo['islock']==1){
            return(['sign'=>false,'message'=>"账户不允许下注"]);
        }
        if($userinfo['balance']<$totalprice){
            return(['sign'=>false,'message'=>"账户余额不足"]);
        }

        $_t = time();
        $tzdb = M('touzhu');
        $memdb = M('member');
        foreach($_REQUEST['orderList'] as $k=>$v){
            $rate = M('wanfa_old')->where(['id'=>$v['id'],'typeid'=>$typeid])->find();
            if($rate['class2']){
                $title = $rate['class1'].'-'.$rate['class2'];
            }else{
                $title = $rate['class1'];
            }
            $data = [];
            $trano          = gettrano(1);
            $data['isdraw'] = 0;
            $data['trano']  = $trano;
            $data['yjf'] = 1;
            $data['typeid'] = $cpinfo['typeid'];
            $data['playid'] = $rate['id'];
            $data['playtitle']  = $title;
            $data['cptitle']  = $cpinfo['title'];
            $data['cpname']  = $cpinfo['name'];
            $data['expect']  = $expect;
            $data['uid']  = $userinfo['id'];
            $data['username']  = $userinfo['username'];
            $data['itemcount']  = 1;
            $data['beishu'] = intval($v['price']);
            $data['tzcode']  = $rate['class3'];
            $data['amount']  = intval($v['price']);
            $data['mode'] = $v['rate'];
            if($v['fandian']){
                $data['repoint'] = $v['fandian'];
                $data['repointamout'] = $data['amount'] * $v['fandian'] /100;
            }

            $data['okamount']  = 0;
            $data['okcount']  = 0;
            $data['Chase']  = 0;
            $data['stopChase']  = 0;
            $data['oddtime']  = $_t;
            $data['opencode']  = '';
            $data['source']  = $_REQUEST["source"];
            $data['play_type'] = 1;
            $oldamount = $memdb->where(['id'=>$userinfo['id']])->getField('balance');//投注前金额
            $data['amountbefor']  = $oldamount;
            $data['amountafter']  = $oldamount - $data['amount'];

            //给自己返点
            if ($v['fandian'] > 0 && $v['fandian'] <= $userinfo['fandian']) {
                $member_data = M('Member')->where("id='{$userinfo['id']}'")->getField('balance');
                M('member')->where("id='{$userinfo['id']}'")->setInc('balance', $data['repointamout']);

                $back_amount = [];
                $back_amount['trano'] = $trano;
                $back_amount['uid'] = $userinfo['id'];
                $back_amount['username'] = $userinfo['username'];
                $back_amount['type'] = 'yongjinshenhe';
                $back_amount['typename'] = '返点发放通过';
                $back_amount['remark'] = '返点发放通过';
                $back_amount['oddtime'] = NOW_TIME;
                $back_amount['amount'] = $data['repointamout'];
                $back_amount['amountbefor'] = $member_data;
                $back_amount['amountafter'] = $member_data + $member_data['amount'];
                M('fuddetail')->data($back_amount)->add();
            }


            $addints[] = $_int = $tzdb->data($data)->add();
            $agentCommissionOpen = M('setting')->where(['name'=>'agent_commission_open'])->getField('value');
            if($userinfo['parentid'] !='0' && $agentCommissionOpen){
                $i = 1;
                $this->dailifandian($userinfo['parentid'],$userinfo['fandian'],$data['amount'],$trano,$userinfo['id'],$userinfo['username'],$userinfo['fandian'],$i);
                foreach($this->_parent as $val){
                    $dailidata['uid'] = $val['uid'];
                    $dailidata['username'] = $val['username'];
                    $dailidata['amount'] = $val['fandianjine'];
                    $dailidata['touzhujine'] = $val['touzhujine'];
                    $dailidata['trano'] = $val['trano'];
                    $dailidata['fandian'] = $val['fandian'];
                    $dailidata['shenhe'] = 1;
                    $dailidata['xiajiid'] = $val['xiajiid'];
                    $dailidata['xiajiuser'] = $val['xiajiuser'];
                    $dailidata['xiajifandian'] = $val['xiajifandian'];
                    $dailidata['oddtime'] = time();
                    M('dailifandian')->add($dailidata);

                    $amountbefor = M('Member')->where("id='{$dailidata['uid']}'")->getField('balance');
                    M('member')->where("id='{$dailidata['uid']}'")->setInc('balance',$dailidata['amount']);
                    //添加会员账户明细
                    $fuddetaildata = [];
                    $fuddetaildata['trano']      = $dailidata['trano'];
                    $fuddetaildata['uid']      = $dailidata['uid'];
                    $fuddetaildata['username'] =  $dailidata['username'];
                    $fuddetaildata['type']     = 'yongjinshenhe';
                    $fuddetaildata['typename']     = '佣金发放通过';
                    $fuddetaildata['remark']       = '佣金发放通过';
                    $fuddetaildata['oddtime']     = NOW_TIME;
                    $fuddetaildata['amount']   = $dailidata['amount'];
                    $fuddetaildata['amountbefor']   = $amountbefor;
                    $fuddetaildata['amountafter']   = $amountbefor + $dailidata['amount'];
                    M('fuddetail')->data($fuddetaildata)->add();
                }
            }
            if($_int){//操作账户金额、日志等
                //会员账户金额、积分、洗码金额
                $_membercenter = $memdb->where(['id'=>$userinfo['id']])->field('balance,point,xima')->find();
                //投注
                $memdb->where(['id'=>$userinfo['id']])->setDec('balance',$data['amount']);
                $fuddetail_data = array();
                $fuddetail_data['trano'] = $trano;
                $fuddetail_data['uid'] = $userinfo['id'];
                $fuddetail_data['username'] = $userinfo['username'];
                $fuddetail_data['amount'] = abs($data['amount']);
                $fuddetail_data['amountbefor'] = $_membercenter['balance'];
                $fuddetail_data['amountafter'] = $_membercenter['balance']-abs($data['amount']);
                $fuddetail_data['oddtime'] = $_t;
                $fuddetail_data['remark'] = "投注扣费，彩种:{$cpinfo['title']},{$expect}";
                $fuddetail_data['type'] = 'order';
                $fuddetail_data['typename'] = C('fuddetailtypes.order');
                M('fuddetail')->data($fuddetail_data)->add();

                //洗码
                if($_membercenter['xima']>0){
                    $ximaamount = $data['amount'];
                    if($data['amount']>$_membercenter['xima']){
                        $ximaamount = $_membercenter['xima'];
                    }
                    $memdb->where(['id'=>$userinfo['id']])->setDec('xima',$ximaamount);
                    $fuddetail_data = array();
                    $fuddetail_data['trano'] = $trano;
                    $fuddetail_data['uid'] = $userinfo['id'];
                    $fuddetail_data['username'] = $userinfo['username'];
                    $fuddetail_data['amount'] = abs($ximaamount);
                    $fuddetail_data['amountbefor'] = $_membercenter['xima'];
                    $fuddetail_data['amountafter'] = $_membercenter['xima']-abs($ximaamount);
                    $fuddetail_data['oddtime'] = $_t;
                    $fuddetail_data['remark'] = "投注减，彩种:{$cpinfo['title']},{$expect}";
                    $fuddetail_data['type'] = 'xima';
                    $fuddetail_data['typename'] = C('fuddetailtypes.xima');
                    M('fuddetail')->data($fuddetail_data)->add();
                }else{
                    $memdb->where(['id'=>$userinfo['id']])->setField('xima',0);
                }

            }
        }
        if(count(array_filter($addints))>0){
            $apiparam['sign'] = true;
            $apiparam['message'] = '投注成功';
        }else{
            $apiparam['sign'] = false;
            $apiparam['message'] = '投注失败1';
        }
        return $apiparam;
    }


    // 递归处理代理返点
	function dailifandian($parentid,$fandian,$amount,$trano,$xiajiid,$xiajiuser,$xiajifandian,$i){
		//查找上级的返点
		$where['id'] = $parentid;
		$daili = M('member')->field('id,parentid,fandian,username')->where($where)->find();
		$fandianjine = ((($daili['fandian']-$fandian)/100))*$amount;          //第一次反点金额 (代理返点-下级返点)/100*下级投注金额
		$this->_parent[$i]["fandianjine"] = $fandianjine;
		$this->_parent[$i]["uid"] = $daili['id'];
		$this->_parent[$i]["fandian"] = $daili['fandian'];
		$this->_parent[$i]["xiajiid"] = $xiajiid;
		$this->_parent[$i]["xiajiuser"] = $xiajiuser;
		$this->_parent[$i]["xiajifandian"] = $xiajifandian;
		$this->_parent[$i]["username"] = $daili['username'];
		$this->_parent[$i]["touzhujine"]  = $amount;
		$this->_parent[$i]["trano"] = $trano;
		$this->_parent[$i]["oddtime"] = time();
		$i++;
		if($daili['parentid']!='0'){
			$this->dailifandian($daili['parentid'],$daili['fandian'],$amount,$trano,$daili['id'],$daili['username'],$daili['fandian'],$i);
		}
	}
}