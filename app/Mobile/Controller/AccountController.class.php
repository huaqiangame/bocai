<?php
namespace Mobile\Controller;
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
		//查找工商银行设置相关信息
		$payinfo = M('payset')->where("paytype='linepay'")->find();
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
		$uinfo = M('member')->where("id=".$this->userinfo['id'])->field('tradepassword,key')->find();
		$this->rpassword = $uinfo['tradepassword'];
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
			if(sys_md5($pass)!=$uinfo['tradepassword']){
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
	//设置
	function userbankname(){
		if(IS_POST){
	 		if(empty($this->userinfo['tradepassword'])){
				redirect(U('Member/update_safepass'));
			}
			if(sys_md5($_POST['tradepassword']) != $this->userinfo['tradepassword']){
				$this->error('安全密码不正确');
			}
			if(!empty($_POST['userbankname']))
			{
				$data['userbankname']=$_POST['userbankname'];
				$data2['accountname']=$_POST['userbankname'];
			    $int = M("member")->where("id=".$this->userinfo['id'])->setField($data);
				if($int){
					$this->success('银行卡真实姓名绑定成功',U('Member/index'));
//					echo '<script type="text/javascript">alert("银行卡真实姓名绑定成功！");window.location.href="member.index"</script>';
					exit;
				}else{
					$this->error('银行卡真实姓名绑定失败,请重试');
					exit;
				}
			}else{
				$this->error('请输入你的银行卡真实姓名');
				exit;
		  }
		}
		$this->display();
	}
	//提现
	function  withdrawals()
	{
		$uinfo = M('member')->where("id=".$this->userinfo['id'])->find();
		$this->rpassword = $uinfo['tradepassword'];
		$_banklist = M('banklist')->where("uid=".$this->userinfo['id'])/*->where("state=1")*/->select();
 		if(empty($_banklist))
		{
			redirect(U("Member/addbank"));exit;
			//$this->error('你还没有绑定银行卡,请先绑定银行卡',U("Member/addbank"));
		}
		if(empty($uinfo['userbankname']))
		{
			redirect(U("Account/userbankname"));exit;
		}
		$i = 0;
		$j = 0;
		foreach($_banklist as $k=>$v)
		{
			$banklist[$v['id']] = $v;
			$banklist[$v['id']]['banknumber'] = '**********'.substr($v['banknumber'],-5);
			$banklist[$v['id']]['_banknumber'] = $v['banknumber'];
			$where['bankname'] =  $v['bankname'];
			$imgbg = M('sysbank')->where($where)->select();
			$banklist[$v['id']]['imgbg'] = $imgbg[0]['imgbg'];
			$banklist[$v['id']]['banklogo'] = $imgbg[0]['banklogo'];
			if($v['isdefault']=='1') $i++;
			if($v['state']=='1') $j++;
		} 
		//if($i==0)$this->error('你还没设置默认提款银行卡');
		if($j==0)$this->error('你的银行卡还在审核中');
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
			exit(dump($_POST));
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
				M('member')->where("id=".$this->userinfo['id'])->setDec('balance',$amount);
				M('member')->where("id=".$this->userinfo['id'])->setDec('point',$amount);
			}
			$int?$this->success('提款订单提交成功'):$this->error('提款订单提交失败');
			exit;
		}
		$this->display();
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
		$mxlist     = $db->where($map)->order("oddtime desc")->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach ($mxlist as $key => $value) {
			if($value['type']=='order' or $value['type']=='xima' or $value['type']=='withdraw')
			{
				$mxlist[$key]['amount'] = "-".$value['amount'];
				if($value['typename']=="提款退回")
				{
					$mxlist[$key]['amount'] = "+".$value['amount'];
				}
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
		$this->status    = $_GET['status'];
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
		if($this->status!='')$map['status']=array('eq',$this->status);
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
		$this->pageshow= $Page->show();
		$this->mxlist = $mxlist;
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
		$this->status    = I('status');
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
		if($this->status!='')$map['status']=array('eq',$this->status);
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
		foreach ($mxlist as $key => $value) {
				if($value['state']=="-1")
				{
					$mxlist[$key]['amount'] = "+".$value['amount'];
				} else {

					$mxlist[$key]['amount'] = "-".$value['amount'];
				}
		}
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
		$tikuancount     = M('withdraw')->where($map)->where('state=1')->sum('amount'); //提款总金额
		$yingli = ($zhongjiangcount - $touzhucount +  $fandian);
		if(empty($touzhucount)) $touzhucount="0.00";
		if(empty($zhongjiangcount)) $zhongjiangcount="0.00";
		if(empty($yingli)) $yingli="0.00";
		if(empty($chuzhicount)) $chuzhicount="0.00";
		if(empty($tikuancount)) $tikuancount="0.00";
		if(empty($fandian)) $fandian="0.00";
		$this->assign("chuzhicount",$chuzhicount);
		$this->assign("yingli",$yingli);
		$this->assign("touzhucount",$touzhucount);
		$this->assign("fandian",$fandian);
		$this->assign("zhongjiangcount",$zhongjiangcount);
		$this->assign("tikuancount",$tikuancount);
		$this->display();
	}
   //快捷支付
	function qukirecharge()
	{
		$Allbank = M('payset')->field("paytype ,paytypetitle,configs ,minmoney,maxmoney,remark")->where("isonline=1 AND state=1")->select();
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
   //快捷支付
	function quickRecharge()
	{
		$Allbank = M('payset')->field("paytype ,paytypetitle,configs ,minmoney,maxmoney,remark")->where("isonline=1 AND state=1")->select();
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
				$Allmsg['remark']  =  $value['remark'];
				$Allmsg['bankname'] = unserialize($value['configs'])['bankname'];
				$Allmsg['bankcode'] = unserialize($value['configs'])['bankcode'];
				$Allmsg['ewmurl'] = unserialize($value['configs'])['ewmurl'];
			unset($Allmsg[0]);
		}
		$this->assign('Allmsg',$Allmsg);
		$this->display();
	}
    //云闪付
    function ysfrecharge()
    {
        $Allmsg = M('payset')->field("paytype ,paytypetitle,configs ,minmoney,maxmoney,remark")->where("isonline=-1 AND state=1 AND paytype='cloud'")->select();
        foreach ($Allmsg as $key => $value)
        {
            $Allmsg['paytype']  =  $value['paytype'];
            $Allmsg['paytypetitle']  =  $value['paytypetitle'];
            $Allmsg['minmoney']  =  $value['minmoney'];
            $Allmsg['maxmoney']  =  $value['maxmoney'];
            $Allmsg['remark']  =  $value['remark'];
            $Allmsg['bankname'] = unserialize($value['configs'])['bankname'];
            $Allmsg['bankcode'] = unserialize($value['configs'])['bankcode'];
            $Allmsg['ewmurl'] = unserialize($value['configs'])['ewmurl'];
            unset($Allmsg[0]);
        }
        $this->assign('Allmsg',$Allmsg);
        $this->display();
    }
	//四合一扫码支付
	function fourRecharge()
	{
		$Allmsg = M('payset')->field("paytype ,paytypetitle,configs ,minmoney,maxmoney,remark")->where("isonline=-1 AND state=1 AND paytype='fourinone'")->select();
		foreach ($Allmsg as $key => $value)
		{
			$Allmsg['paytype']  =  $value['paytype'];
			$Allmsg['paytypetitle']  =  $value['paytypetitle'];
			$Allmsg['minmoney']  =  $value['minmoney'];
			$Allmsg['maxmoney']  =  $value['maxmoney'];
			$Allmsg['remark']  =  $value['remark'];
			$Allmsg['bankname'] = unserialize($value['configs'])['bankname'];
			$Allmsg['bankcode'] = unserialize($value['configs'])['bankcode'];
			$Allmsg['ewmurl'] = unserialize($value['configs'])['ewmurl'];
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
				$Allmsg['remark']  =  $value['remark'];
			$Allmsg['bankname'] = unserialize($value['configs'])['bankname'];
			$Allmsg['bankcode'] = unserialize($value['configs'])['bankcode'];
			$Allmsg['ewmurl'] = unserialize($value['configs'])['ewmurl'];
			unset($Allmsg[0]);
		} 
		$this->assign('Allmsg',$Allmsg);
		$this->display();
	}
	//转账记录
	function fuddetail4(){
	
	}
}
?>