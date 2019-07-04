<?php
namespace Home\Controller;
use Home\Model\MemberModel;
use Think\Controller;
class AccountController extends CommonController {
	public function __construct(){
		parent::__construct();
		if(!$this->userinfo){
			redirect(U('Public/login'));exit;
		}
	}
	//反水领取
	function fanshui()
	{
		$db = M('fanshui');
		$_yjlist = explode(';',str_replace('；',';',$this->userinfo['fanshui']));
		foreach($_yjlist as $k=>$v)
		{
			$array = $array1 = array();
			$array = explode('|',$v);
			$array1= explode('-',$array[0]);
			$yjlist[$k]['min']  = $array1[0];
			$yjlist[$k]['max']  = $array1[1];;
			$yjlist[$k]['bilv'] = $array[1];
		}
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		//检测是否已领取
		$lastlqtime = $db->where("uid={$this->userinfo['id']}")->order('id desc')->getField('oddtime');
		$_t = time();

		if($lastlqtime)
		{
			if($_t-$lastlqtime<=86400)
			{//一天领取
				$lqtype = 1;
			}elseif($_t-$lastlqtime>86400 && $_t-$lastlqtime<86400*7)
			{//一周领取
				$lqtype = 2;
				$beginToday = $lastlqtime;
				$endToday   = $lastlqtime+86400*7;
			}else{//一月领取
				$lqtype = 3;
				$beginToday = $lastlqtime;
				$endToday   = $lastlqtime+86400*30;
			}
		}else{//未领取过
			$lqtype = 1;
		}
		$_map = array();
		/*$DB_FIX = C('DB_PREFIX');
		$sql = "select SUM(a.amount) as amount from {$DB_FIX}touzhu a,{$DB_FIX}member b where a.status!='-2' and a.oddtime > {$beginToday} and a.oddtime < {$endToday} and a.uid=b.id and b.tgid={$this->userinfo['id']}";
		$touzhuinfo = M()->query($sql);*/

		$time = strtotime(date("Y-m-d",time()))-86400;
		$StartTime = strtotime(date("Y-m-d H:i:s",$time));  //昨天开始时间
		$EndTime = strtotime(date("Y-m-d ".'23:59:60',$time));//昨天结束时间


		$touzhue = M('touzhu')->where("uid={$this->userinfo['id']} and status!='-2' and status!='0' and oddtime >= {$StartTime} and oddtime < {$EndTime}")->sum('amount');
		/*$touzhue = $touzhuinfo[0]['amount']?$touzhuinfo[0]['amount']:0;*/
		if($yjlist && $touzhue)foreach($yjlist as $k=>$v)
		{
			if($v['min'] && $v['max'])
			{
				if($touzhue>=$v['min'] && $touzhue<$v['max'])$yanyongs[]= $v;
			}elseif($v['min'] && !$v['max'])
			{
				if($touzhue>=$v['min'])$yanyongs[]= $v;
			}
		}
		if($touzhue>0 && count($yanyongs)>=1)
		{
			//当满足多个条件 取第一个
			$yanyongbili = current($yanyongs);
		}

		//奖励金额
		$jljine = ($yanyongbili['bilv']/100)*$touzhue;
		$this->jljine = $jljine;
		$this->assign('yjlist',$yjlist);
		$this->assign('countamount',$touzhue);
		$this->assign('jiajiang',$jljine);

		$lqcount = $db->where("uid={$this->userinfo['id']} and oddtime < {$endToday} and oddtime >= {$beginToday}")->count();

		$this->beginToday = $beginToday;
		$this->endToday   = $endToday;
		$this->lqcount = $lqcount;
		/*领取列表*/
		$_map1 = array();
		$_map1['uid'] = array('eq',$this->userinfo['id']);
		$count      = $db->where($_map1)->count();
		$Page       = new \Think\Page($count,20);
		$this->pageshow       = $Page->show();
		$this->lqlist = $db->where($_map1)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		if(IS_AJAX)
		{
			if($jljine<=0)
			{
				$this->error('暂无加奖可领取！');
			}
			switch($lqtype)
			{
				case 1:
					if($lqcount>=1)$this->error('今日已领取！');
					break;
				case 2:
					if($lqcount>=2)$this->error('非法操作！');
//					if($lqcount>=2)$this->error('下次领取时间：'.date('Y-m-d H时m分',$endToday).'以后领取！');
					break;
				case 3:
					if($lqcount>=3)$this->error('非法操作！');
//					if($lqcount>=3)$this->error('下次领取时间：'.date('Y-m-d H时m分',$endToday).'以后领取！');
					break;
			}
			$data = array();
			$data['uid']       = $this->userinfo['id'];
			$data['username']  = $this->userinfo['username'];
			$data['groupname']  = $this->userinfo['groupname'];
			$data['touzhuedu'] = $touzhue;
			$data['yongjinfw'] = $yanyongbili['min'].'-'.$yanyongbili['max'].'|'.$yanyongbili['bilv'];
			$data['amount']    = $jljine;
			$data['bili']      = $yanyongbili['bilv'].'%';
			$data['oddtime']   = time();
			$data['shenhe']    = 0;
			$int = $db->data($data)->add();
			$int?$this->success('领取成功！'):$this->error('领取失败！');
			return  $int;
		}
	}


	//账户充值
	function recharge()
	{
		//查找工商银行设置相关信息where("paytype='linepay'")->
		$payinfo = M('payset')->order('id desc')->find();
                //dump($payinfo);exit;
		if(IS_POST)
		{
			$paytype = I('paytype');
			$amount  = I('amount',0,'intval');
			$bankusername = I('bankusername');
			if(!$payinfo)
			{
				$this->error('充值方式不存在');
			}
//			$minrecharge = floatval(GetVar('minrecharge'))>0?floatval(GetVar('minrecharge')):50;
			$minrecharge = floor($payinfo['minmoney']);
			if($amount<$minrecharge)
			{
				$this->error('充值金额最低为'.$minrecharge.'元');
			}
			$data = array(); 
			
			$data['paytype']       = $paytype;
			$data['bankusername']  = $bankusername;
			$data['amount']        = $amount;
			$data['oddtime']       = time();
			$data['uid']           = $this->userinfo['id'];
			$data['username']      = $this->userinfo['username'];
			$data['trano']         = rand_string(2,0).date('ymdHis').rand_string(2,1);
			$data['fuyanma']       = rand_string(8,1);
			if($paytype=='pay1000')
			{
				$data['banktype']    = I('banktype',0);
				if(!$data['banktype'])
				{
					$this->error('请选择支付银行');
				}
			}
			$int = M('payaccount')->data($data)->add();
			if($int)
			{
				if($payinfo['isoninlie']==1)
				{
						$this->success('提交成功',U('Payment/onlinepay',array('id'=>$int)));
				}else{
						  $this->success('提交成功',U('recharge2',array('id'=>$int)));
				}
			}else{
				$this->error('充值提交失败');
			}
			exit;
			
		}
		$this->assign('payinfo', $payinfo);
		$this->assign('bankname', unserialize($payinfo['configs'])['bankname']);
		$this->assign('bankcode', unserialize($payinfo['configs'])['bankcode']);
		$this->display();
	}
	function recharge2()
	{
		$id = I('id',0,'intval');
		$payorder = M('payaccount')->where(array('id'=>$id,'uid'=>$this->userinfo['id']))->find();
		if(!$payorder)
		{
			$this->error('充值订单不存在');
		}
		$payinfo  = M('payset')->where(array('type'=>$payorder['paytype']))->find();
 		$erweima  = unserialize($payinfo['erweima']);
		$f_erweima = current($erweima);
		$payinfo['erweima'] = is_array($f_erweima)?$f_erweima['fileurl']:'';
		$this->payinfo = $payinfo;
		$this->payorder = $payorder;
		$_config = array_filter(array_unique(explode(PHP_EOL,$this->payinfo['config'])));
		$configs = array();
		foreach($_config as $k=>$v)
		{
			$array = array();
			$array = explode('###',$v);
			$configs[trim($array[0])] = trim($array[1]);
		}
		$this->configs = $configs;
		if($payinfo['type']=="alipay")
		{
			$this->display('Account/zfbcode');
			exit();
		}elseif($payinfo['type']=="weixin"){
			$this->display('Account/wxcode');
			exit();
		}else{
			$this->display();
		}
	}
	
	//取款
	function withdraw()
	{
		$uinfo = M('member')->where("id=".$this->userinfo['id'])->field('rpassword,key')->find();
		$this->rpassword = $uinfo['rpassword'];
		$_banklist = M('memberbank')->where("uid=".$this->userinfo['id'])->select();
		foreach($_banklist as $k=>$v)
		{
			$banklist[$v['bid']] = $v;
			$banklist[$v['bid']]['banknumber'] = substr($v['banknumber'],0,4).'******'.substr($v['banknumber'],-5);
			$banklist[$v['bid']]['_banknumber'] = $v['banknumber'];
		}
		$this->banklist  = $banklist;
		if(IS_POST)
		{
			$bid = I('bid');
			$amount = I('amount',0,'intval');
			$pass = I('pass');
			if(!$banklist[$bid])$this->error('选择提款银行!');
			$minwithdraw = floatval(GetVar('minwithdraw'))>0?floatval(GetVar('minwithdraw')):100;
			if($amount<$minwithdraw)$this->error('最低提款金额为'.$minwithdraw.'元！');
			if($amount>$this->userinfo['money']){
				$this->error('提款金额错误！');
			}
			if(encrypt($pass,$uinfo['key'])!=$uinfo['rpassword']){
				$this->error('安全密码错误！');
			}
			$data = array();
			$data['uid'] = $this->userinfo['id'];
			$data['username'] = $this->userinfo['username'];
			$data['bankname'] = $banklist[$bid]['bankname'];
			$data['bankusername'] = $banklist[$bid]['accountname'];
			$data['bankcode'] = $banklist[$bid]['_banknumber'];
			$data['amount'] = $amount;
			$data['oddtime']= time();
			$data['trano']  = rand_string(2,0).date('ymdHis').rand_string(2,1);
			$int = M('tikuan')->data($data)->add();
			if($int){
				M('member')->where("id=".$this->userinfo['id'])->setDec('money',$amount);
			}
			$int?$this->success('提款订单提交成功'):$this->error('提款订单提交失败');
			exit;
		}
		$this->display();
	}
	//提现
	function  withdrawals()
	{
		$uinfo = M('member')->where("id=".$this->userinfo['id'])->field('tradepassword')->find();
		$this->rpassword = $uinfo['tradepassword'];
		$_banklist = M('banklist')->where("uid=".$this->userinfo['id'])/*->where("state=1")*/->select();
 		if(empty($_banklist))
		{
			//$this->error('你还没有绑定银行卡,请先绑定银行卡',U("Member/addbank"));
			redirect(U("Member/addbank"));exit;
		}
		foreach($_banklist as $k=>$v)
		{
			$banklist[$v['id']] = $v;
			$banklist[$v['id']]['banknumber'] = '**********'.substr($v['banknumber'],-5);
			$banklist[$v['id']]['_banknumber'] = $v['banknumber'];
			$where['bankname'] =  $v['bankname'];
			$imgbg = M('sysbank')->where($where)->select();
			$banklist[$v['id']]['imgbg'] = $imgbg[0]['imgbg'];
		}
		$StartTime = date('Y-m-d 00:00:00');
		$map['oddtime'] =array('egt',strtotime($StartTime));
		$map['uid']    = $this->userinfo['id'];

		$num = M('withdraw')->where($map)->count();
		$count = GetVar('tikuannum')-$num;
		$count = $count>0?$count:0;
		$this->assign('count',$count);
		$this->assign('banklist',$banklist);
		if(IS_POST)
		{
			$bid = I('bid');
			$amount = I('amount');
			$pass = I('pass');
			if(!$banklist[$bid])$this->error('选择提款银行!');
			$minwithdraw = floatval(GetVar('minwithdraw'))>0?floatval(GetVar('minwithdraw')):100;
			if($amount<$minwithdraw)$this->error('最低提款金额为'.$minwithdraw.'元！');
			if($amount>$this->userinfo['balance'])
			{
				$this->error('提款金额错误！');
			}
			if(sys_md5($pass)!=$uinfo['tradepassword'])
			{
				$this->error('安全密码错误！');
			}
			if($count<=0)
			{
				$this->error('今日提现次达到了最大限次数！');
			}
			$data = array();
			$data['uid'] = $this->userinfo['id'];
			$data['username'] = $this->userinfo['username'];
			$data['bankname'] = $banklist[$bid]['bankname'];
			$data['bankusername'] = $banklist[$bid]['accountname'];
			$data['bankcode'] = $banklist[$bid]['_banknumber'];
			$data['amount'] = $amount;
			$data['oddtime']= time();
			$data['trano']  = rand_string(2,0).date('ymdHis').rand_string(2,1);
			$int = M('tikuan')->data($data)->add();
			if($int)
			{
				$member = M('member');
				$user = $member->field('point')->where('id='.$this->userinfo['id'])->find();
				if($user['point'] <= abs($amount)){
					$point = 0;
				}else{
					$point = ($user['point']-$amount);
				}
				$member->where('id='.$this->userinfo['id'])->setField('point',$point);
				changeusergroup($this->userinfo['id']);
			}
			$int?$this->success('提款订单提交成功'):$this->error('提款订单提交失败');
			exit;
		}
		$this->display();
	}

	//初始化开户中心
	function getuserrebatereg(){
		if($this->userinfo['proxy']!=1){
			$return = ['sign'=>false,'message'=>"您不是代理，无权限操作"];
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		$maxRebate     = $this->userinfo['fandian']/100;
		$LotteryRegs   = explode('.',$this->userinfo['fandian']);
		if($this->userinfo['fandian']>10){
			$LotteryReg = '^(([0-0]?[0-9](\\.[0-9])?)|(1[0-1](\\.[0-9])?)|('.$LotteryRegs[0].'(\\.[0-'.$LotteryRegs[1].'])?))$';
		}else{
			$LotteryReg = '^(([0-0]?[0-9](\\.[0-9])?)|(1[0-1](\\.[0-'.$LotteryRegs[1].'])?))$';
		}
		$maxLotteryReg = $LotteryReg;
		$maxlhcrebate     = $this->userinfo['lhcrebate']/100;
		$lhcrebateRegs   = explode('.',$this->userinfo['lhcrebate']);
		if($this->userinfo['lhcrebate']>10){
			$lhcrebateReg = '^(([0-0]?[0-9](\\.[0-9])?)|(1[0-1](\\.[0-9])?)|('.$lhcrebateRegs[0].'(\\.[0-'.$lhcrebateRegs[1].'])?))$';
		}else{
			$lhcrebateReg = '^(([0-0]?[0-9](\\.[0-9])?)|(1[0-1](\\.[0-'.$lhcrebateRegs[1].'])?))$';
		}
		$maxlhcrebateReg = $lhcrebateReg;
		$recreation = M('recreation_fandian')->where(['member_id'=> $this->userinfo['id']])->find();
		$return = ['sign'=>true,'message'=>'获取成功','maxLottery'=>$maxRebate,'maxLotteryReg'=>$maxLotteryReg,
            'maxlhcrebate'=>$maxlhcrebate,'maxlhcrebateReg'=>$maxlhcrebateReg,'recreation'=>$recreation];
		echo json_encode($return, JSON_UNESCAPED_UNICODE);
	}

	//账户明细()
	function dealRecord()
	{
		$this->type      =  I("get.type");
		$this->atime     = $atime     = I('get.atime');
		if($this->type)$map['type']=array('eq',$this->type);
		switch ($atime){
			case '1' ;
				$StartTime = date('Y-m-d 00:00:00');
				$EndTime   = date('Y-m-d H:i:s') ;
				break;
			case '2' ;
				$time=time ()- ( 1  *  24  *  60  *  60 );
				$day = date("Y-m-d",$time);
				$StartTime = date($day.' 00:00:00');
				$EndTime   = date($day.' 23:59:59');
				break;
			case '3' ;
				$time=time ()- ( 7  *  24  *  60  *  60 );
				$day = date("Y-m-d",$time);
				$StartTime = date($day.' 00:00:00');
				$EndTime   = date('Y-m-d H:i:s') ;
				break;
		}
		if($StartTime && $EndTime)
		{
			$map['oddtime'][]=array('egt',strtotime($StartTime));
			$map['oddtime'][]=array('elt',strtotime($EndTime));
		}elseif(!$StartTime && $EndTime)
		{
	     $map['oddtime'][]=array('elt',strtotime($EndTime));
         }
		$map['uid']=array('eq',$this->userinfo['id']);
		$db = M('fuddetail');
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,10);
		 startPage($Page);
		$mxlist     = $db->where($map)->order("id desc")->limit($Page->firstRow.','.$Page->listRows)->select();
 		foreach ($mxlist as $key => $value) {
			if($value['amountbefor']>$value['amountafter']){
				$mxlist[$key]['amount'] = "-".$value['amount'];
			}else{
				$mxlist[$key]['amount'] = "+".$value['amount'];
			}
		}
		$this->pageshow= $Page->show();
		$this->mxlist = $mxlist;
		$this->display();
	}
	//充值记录
	function dealRecord2()
	{
		$_paylist = M('recharge')->where("state=1")->order('id desc')->select();
/*		foreach($_paylist as $k=>$v)
		{
			$paylist[$v['type']] = $v;
		} */
		$this->paylist = $_paylist;
		$this->type      = I('type');
		$this->state    = $_GET['state'];
		$this->atime     = $atime     = $_GET['atime'];
		if($this->type)$map['type']=array('eq',$this->type);
		switch ($atime)
		{
			case '1' ;
				$StartTime = date('Y-m-d 00:00:00');
				$EndTime   = date('Y-m-d H:i:s') ;
				break;
			case '2' ;
				$time=time ()- ( 1  *  24  *  60  *  60 );
				$day = date("Y-m-d",$time);
				$StartTime = date($day.' 00:00:00');
				$EndTime   = date($day.' 23:59:59');
				break;
			case '3' ;
				$time=time ()- ( 7  *  24  *  60  *  60 );
				$day = date("Y-m-d",$time);
				$StartTime = date($day.' 00:00:00');
				$EndTime   = date('Y-m-d H:i:s') ;
				break;
		}
		if($this->type)$map['paytype']=array('eq',$this->type);
		if($this->state!='' )$map['state']=array('eq',$this->state);
		if($this->state=='undefined') unset($map['state']);
		if($StartTime && $EndTime)
		{
			$map['oddtime'][]=array('egt',strtotime($StartTime));
			$map['oddtime'][]=array('elt',strtotime($EndTime));
		}elseif(!$StartTime && $EndTime)
		{
			$map['oddtime'][]=array('elt',strtotime($EndTime));
		}
		$map['uid']=array('eq',$this->userinfo['id']);
		$db = M('recharge');
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,10);
		startPage($Page);
		$mxlist     = $db->where($map)->order("oddtime desc")->limit($Page->firstRow.','.$Page->listRows)->select();
		if($mxlist){
		$this->pageshow= $Page->show();
		$this->mxlist = $mxlist;
		}
		$this->display();
	}
	//金额刷新
	function  refreshmoney(){
		$money = M('member')->field('balance')->where("id='{$this->userinfo['id']}'")->find();
		echo $money['balance'];
	}
	//提现记录
	function dealRecord3()
	{
		$this->type      = I('type');
		$this->state    = I('state');
		$this->atime     = $atime     = $_GET['atime'];
		switch ($atime)
		{
			case '1' ;
				$StartTime = date('Y-m-d 00:00:00');
				$EndTime   = date('Y-m-d H:i:s') ;
				break;
			case '2' ;
				$time=time ()- ( 1  *  24  *  60  *  60 );
				$day = date("Y-m-d",$time);
				$StartTime = date($day.' 00:00:00');
				$EndTime   = date($day.' 23:59:59');
				break;
			case '3' ;
				$time=time ()- ( 7  *  24  *  60  *  60 );
				$day = date("Y-m-d",$time);
				$StartTime = date($day.' 00:00:00');
				$EndTime   = date('Y-m-d H:i:s') ;
				break;
		}
		if($this->state!='')$map['state']=array('eq',$this->state);
		if($this->state=='undefined') unset($map['state']);
		if($StartTime && $EndTime)
		{
			$map['oddtime'][]=array('egt',strtotime($StartTime));
			$map['oddtime'][]=array('elt',strtotime($EndTime));
		}elseif(!$StartTime && $EndTime)
		{
			$map['oddtime'][]=array('elt',strtotime($EndTime));
		}
		$map['uid']=array('eq',$this->userinfo['id']);
		$db = M('withdraw');
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,10);
		startPage($Page);
		$mxlist     = $db->where($map)->order("oddtime desc")->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->pageshow= $Page->show();
		$this->mxlist = $mxlist;
		$this->display();
	}
	//今日盈亏
    function todayLoss()
	{
        $time=time ();
		$day = date("Y-m-d",$time);
		$StartTime = date($day.' 00:00:00');
		$EndTime   = date($day.' 23:59:59');
		$map['oddtime'][]=array('egt',strtotime($StartTime));
		$map['oddtime'][]=array('elt',strtotime($EndTime));
		$map['uid'][]=array('eq',$_SESSION['userinfo']['id']);
		$db = M('fuddetail');
		$touzhucount     = $db->where($map)->where("type='order'")->sum('amount');    //投注总金额
		$zhongjiangcount = $db->where($map)->where("type='reward'")->sum('amount'); //中奖总金额
		$chuzhicount     = M('recharge')->where($map)->sum('amount'); //充值总金额
		$fandian = $db->where($map)->where("type='yongjinshenhe'")->sum('amount'); //返点金额
        $fanshui = $db->where($map)->where("type='commission'")->sum('amount'); //返点金额
		$tikuancount     = M('withdraw')->where($map)->where('state=1')->sum('amount'); //提款总金额
		$yingli = ($zhongjiangcount - $touzhucount + $fandian + $fanshui);
		if(empty($touzhucount)) $touzhucount="0.00";
		if(empty($zhongjiangcount)) $zhongjiangcount="0.00";
		if(empty($yingli)) $yingli="0.00";
		if(empty($chuzhicount)) $chuzhicount="0.00";
		if(empty($tikuancount)) $tikuancount="0.00";
		if(empty($fandian)) $fandian="0.00";
        if(empty($fanshui)) $fanshui="0.00";
		$this->assign("chuzhicount",$chuzhicount);
		$this->assign("yingli",$yingli);
		$this->assign("touzhucount",$touzhucount);
		$this->assign("fandian",$fandian);
        $this->assign("fanshui",$fanshui);
		$this->assign("zhongjiangcount",$zhongjiangcount);
		$this->assign("tikuancount",$tikuancount);
		$this->display();
	}

	//网银
	function quickRecharge()
	{
		$Allbank = M('payset')->field("paytype ,paytypetitle,configs ,state,isonline,minmoney,maxmoney,remark")->select();
		foreach ($Allbank as $key => $value)
		{
			$Allbank[$key]['merchantid'] = unserialize($value['configs'])['merchantid'];
			$Allbank[$key]['merchantkey1'] = unserialize($value['configs'])['merchantkey1'];
			$Allbank[$key]['merchantkey2'] = unserialize($value['configs'])['merchantkey2'];
			$Allbank[$key]['redirecturl'] = unserialize($value['configs'])['redirecturl'];
			$Allbank[$key]['hrefbackurl'] = unserialize($value['configs'])['hrefbackurl'];
			$Allbank[$key]['returnbackurl'] = unserialize($value['configs'])['returnbackurl'];
			$Allbank[$key]['remark'] = $value['remark'];
			unset($Allbank[$key]['configs']);
		}
		$this->assign('Allbank',$Allbank);
		$this->display();
	}
	//支付宝支付
	function zfbRecharge()
	{
		$Allmsg = M('payset')->field("paytype ,paytypetitle,configs ,minmoney,maxmoney,remark")->where("isonline=-1 AND state=1 AND paytype='alipay'")->select();
 			foreach ($Allmsg as $key => $value)
			{
				$Allmsg['paytype']  =  $value['paytype'];
				$Allmsg['paytypetitle']  =  $value['paytypetitle'];
				$Allmsg['minmoney']  =  $value['minmoney'];
				$Allmsg['maxmoney']  =  $value['maxmoney'];
				$Allmsg['bankname'] = unserialize($value['configs'])['bankname'];
				$Allmsg['bankcode'] = unserialize($value['configs'])['bankcode'];
				$Allmsg['ewmurl'] = unserialize($value['configs'])['ewmurl'];
				$Allmsg['remark']  =  $value['remark'];
			unset($Allmsg[0]);
		}
		$this->assign('Allmsg',$Allmsg);
		$this->display();
	}
	//四合一支付
	function fourRecharge()
	{
		$Allmsg = M('payset')->field("paytype ,paytypetitle,configs ,minmoney,maxmoney,remark")->where("isonline=-1 AND state=1 AND paytype='fourinone'")->select();
		foreach ($Allmsg as $key => $value)
		{
			$Allmsg['paytype']  =  $value['paytype'];
			$Allmsg['paytypetitle']  =  $value['paytypetitle'];
			$Allmsg['minmoney']  =  $value['minmoney'];
			$Allmsg['maxmoney']  =  $value['maxmoney'];
			$Allmsg['bankname'] = unserialize($value['configs'])['bankname'];
			$Allmsg['bankcode'] = unserialize($value['configs'])['bankcode'];
			$Allmsg['ewmurl'] = unserialize($value['configs'])['ewmurl'];
			$Allmsg['remark']  =  $value['remark'];
			unset($Allmsg[0]);
		}
		$this->assign('Allmsg',$Allmsg);
		$this->display();
	}
	//微信支付
	function wxRecharge()
	{
		$Allmsg = M('payset')->field("paytype ,paytypetitle,configs ,minmoney,maxmoney,remark")->where("isonline=-1 AND state=1 AND paytype='weixin'")->select();
		foreach ($Allmsg as $key => $value)
		{
			$Allmsg['paytype']  =  $value['paytype'];
			$Allmsg['paytypetitle']  =  $value['paytypetitle'];
			$Allmsg['minmoney']  =  $value['minmoney'];
			$Allmsg['maxmoney']  =  $value['maxmoney'];
			$Allmsg['bankname'] = unserialize($value['configs'])['bankname'];
			$Allmsg['bankcode'] = unserialize($value['configs'])['bankcode'];
			$Allmsg['ewmurl'] = unserialize($value['configs'])['ewmurl'];
			$Allmsg['remark']  =  $value['remark'];
			unset($Allmsg[0]);
		} 
                //dump($Allmsg);exit;
		$this->assign('Allmsg',$Allmsg);
		$this->display();
	}
	//转账记录
	function fuddetail4(){
	
	}
	//码支付
    public function mzf(){
        error_reporting(E_ALL & ~E_NOTICE);
	    if(C('MZFPAY.mzfid')<1){
            $this->error('您需要修改配置文件！');
        }
        $member_name = session()['userinfo']['username'];
        $this->assign('member_name',$member_name);

        $this->display();
    }
    public function codepay(){

	    if(IS_POST){
	        $data = I('post.');
            if(C('MZFPAY.mzfid')<1){
                $this->error('您需要修改配置文件！');
            }
            $price = (float)$data["price"]; //提交的价格
	        if(!$data['type']){
                $data['type'] =1;
            }
            if($price<10){
                $this->error('金额不能小于10元！');
            }
            $this->assign('user',$data['user']);
            $price = number_format($price, 2, '.', '');// 四舍五入只保留2位小数。
            $this->assign('price',$price);
            $member_id = session()['userinfo']['id'];
            if ($data['type']) {
                $qrcode_url = ''; //支付宝默认不走本地化二维码
            }
            $this->assign('type',$data['type']);
            $param = '';//自定义参数  可以留空 传递什么返回什么 用于区分游戏分区或用户身份
            //构建请求数组
            $order_sn = 'MZF-'.date('YmdHis',time()).rand(1111,9999).$member_id;
            $host = (isHTTPS() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
            $path = $host . dirname($_SERVER['REQUEST_URI']);
            $parameter = array(
                "id" => (int)C('MZFPAY.mzfid'),//平台ID号
                "type" => $data['type'],//支付方式
                "price" => (float)$price,//原价
                "pay_id" => $order_sn, //可以是用户ID,站内商户订单号,用户名
                "param" => $param,//自定义参数
                "act" => (int)C('MZFPAY.mzfact'),//此参数即将弃用
                "outTime" => 360,//二维码超时设置
                "page" => 4,//订单创建返回JS 或者JSON
                "return_url" => $path . '/News.notify.do',//付款后附带加密参数跳转到该页面
                "notify_url" => $path . '/News.notify.do',//付款后通知该页面处理业务
                "style" => 1,//付款页面风格
                "pay_type" => 1,//支付宝使用官方接口
                "user_ip" => clientIP(),//付款人IP
                "qrcode_url" => $qrcode_url,//本地化二维码
                "chart" => trim(strtolower('utf-8'))//字符编码方式
                //其他业务参数根据在线开发文档，添加参数.文档地址:https://codepay.fateqq.com/apiword/
                //如"参数名"=>"参数值"
            );
            $db = M('recharge');
            switch ((int)$data['type']) {
                case 1:
                    $typeName = 'alipay';
                    break;
                case 2:
                    $typeName = 'QQ';
                    break;
                default:
                    $typeName = 'weixin';
            }
            $rest = array(
                'uid' => $member_id,
                'username' => $data['user'],
                'paytype' => $typeName,
                'paytypetitle' => $typeName.'扫码充值',
                'trano' => $order_sn,
                'amount' => (float)$price,
                'isauto'=>1,
                'state'=>1,
                'oddtime'=>time(),
            );
            $re = $db->add($rest);
            if(!$re){
                $this->error('订单创建失败！');
            }
//            switch ((int)$data['type']) {
//                case 1:
//                    $typeName = '支付宝';
//                    break;
//                case 2:
//                    $typeName = 'QQ';
//                    break;
//                default:
//                    $typeName = '微信';
//            }
            $user_data = array("return_url" => $parameter["return_url"],
                "type" => $parameter['type'], "outTime" => $parameter["outTime"], "codePay_id" => $parameter["id"], "logoShowTime" => 2);
            //$user_data["qrcode_url"] = $codepay_config["qrcode_url"]; //本地二维码控制器
            $user_data["logoShowTime"] = 2;
            $user_data["return_url"] = $path . '/News.notify.do';
            /**
             * 高级模式 云端创建订单。(注意不要外泄密钥key)
             * 可自行根据订单返回的参数做一些高级功能。 以下demo只是简单的功能 其他需要自行开发
             * 比如根据money type 参数调用本地的二维码图片。
             * 比如根据云端订单状态创建失败 展示自定义转账的二维码。
             * 比如可自行开发付款后的同步通知实现。
             * 比如可自行开发软件端某个支付方式掉线。 自动停用该付款方式。
             * 如使用云端同步通知  请附带必要的参数 码支付的用户id,pay_id,type,money,order_id,tag,notiry_key
             * 必须将notiry_key参数返回 因为该参数为服务解密参数(会随时变化)。否则影响云端同步通知
             */

            if ($parameter['page'] != 3) { //只要不为3 返回JS 就去服务器加载资源
                $parameter['page'] = "4"; //设置返回JSON
                $back = create_link($parameter, C('MZFPAY.mzfkey'),C('MZFPAY.gateway')); //生成支付URL
                if (function_exists('file_get_contents')) { //如果开启了获取远程HTML函数 file_get_contents
                    $codepay_json = file_get_contents($back['url']); //获取远程HTML
                } else if (function_exists('curl_init')) {
                    $ch = curl_init(); //使用curl请求
                    $timeout = 5;
                    curl_setopt($ch, CURLOPT_URL, $back['url']);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                    $codepay_json = curl_exec($ch);
                    curl_close($ch);
                }
            }
            if (empty($codepay_json)) { //如果没有获取到远程HTML 则走JS创建订单
                $parameter['call'] = "callback";
                $parameter['page'] = "3";
                $back = create_link($parameter, C('MZFPAY.mzfkey'),'https://codepay.fateqq.com/creat_order/?');
                $codepay_html = '<script src="' . $back['url'] . '"></script>'; //JS数据
            } else { //获取到了JSON
                $codepay_data = json_decode($codepay_json);
                $qr = $codepay_data ? $codepay_data->qrcode : '';
                $codepay_html = "<script>callback({$codepay_json})</script>"; //JSON数据
            }
            $this->assign('user_data',$user_data);
            $this->assign('qr',$qr);
            $this->assign('codepay_html',$codepay_html);
            $this->assign('typeName',$typeName);
            $this->assign('codepay_json',json_decode($codepay_json,true));
            $this->display();
        }

    }
   public function ysfRecharge(){
	   if(IS_POST){
		   $data = I();
		   $isusername = M('member')->where(array('username'=>$data['username']))->getField('username');
		   if(!$isusername){
			   echo json_encode(['status'=>-1,'info'=>'你填写的用户不存在']);exit;
		   }
		   if($data['username'] !== $data['rusername']){
			   echo json_encode(['status'=>-1,'info'=>'2次用户输入不一致']);exit;
		   }
		   if($data['order_amount']<100||$data['order_amount']>20000){
			   echo json_encode(['status'=>-1,'info'=>'请输入限制金额之内']);exit;
		   }
		   $add['uid'] = $_SESSION['userinfo']['id'];
		   $add['username'] = $_SESSION['userinfo']['username'];
		   $add['paytype'] = $data['bank_code'];
		   $add['paytypetitle'] = $data['bid'];
		   $trano = time().rand(1000,9999);
		   $add['trano'] = $trano;
		   $add['amount'] = $data['order_amount'];
		   $add['isauto'] = 1;

		   $add['state'] = 0;
		   $add['oddtime'] = time();
		   $rest = M('recharge')->add($add);
		   if($rest){
			  echo json_encode(['status'=>1,'url'=>"Account.send.trano.$trano.do"]);
		   }else{
			   echo json_encode(['status'=>-1,'info'=>'订单创建失败']);
		   }
		   exit;
	   }
	   $this->display();
   }
	public function send(){
		$trano = I('trano');
		if($trano){
			$recharge_info =M('recharge')->where(array('trano'=>$trano))->find();
			if(!$recharge_info){
				$this->error('订单不存在','Account.ysfRecharge');
			}
            $this->assign('recharge_info',$recharge_info);
			$this->display();
		}
	}
	public function send_post(){
	    if(IS_POST){
	        $data = I();
            $save['remark'] = '我以付款商户订单号:'.$data['third_no'];
            $rest = M('recharge')->where(array('trano'=>$data['trano']))->save($save);
            if($rest){
                 echo json_encode(['status'=>1,'info'=>'提交成功请等待审核']);
            }else{
                echo json_encode(['status'=>-1,'info'=>'提交失败']);
            }
        }else{
            echo json_encode(['status'=>-1,'info'=>'请求错误']);
        }
    }
}
?>