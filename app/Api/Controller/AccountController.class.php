<?php
namespace Api\Controller;
use Think\Controller;
class AccountController extends CommonController {
	protected $allowMethodList =    array(
	'checkislogin','betslisttoday','userbindrealname','usereditpass','gettouzhuinfo','chedan',
	'usereditdrawpass','usersecurity','userbindphone','userbindemail','questionanscheck',
	'bankcardList','userbindbankcard','usergetbankcard','defaultuserbankcard','userbets','userfuddetail',
	'rechargelist','withdrawlist','lotteryreport',
	'getrechargetypelist','addrecharge','sendtrano','isUserWithdrawLimit','savetikuanorder',
	'checkrechargeisok','savepointchangemoney',
	);
	function checkislogin($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		return $apiparam;
	}
	//兑换积分
	function savepointchangemoney($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo      = $apiparam['data'];
		$point = $apiparam['point'];
		$tradepassword = $apiparam['tradepassword'];
		if(md5(sha1($tradepassword))!=$userinfo['tradepassword']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '提款密码错误';
			return $apiparam;exit;
		}
		$pointexchangeamount = intval(GetVar('pointexchangeamount'));
		if($pointexchangeamount<=0){
			$apiparam['sign'] = false;
			$apiparam['message'] = '积分兑换已关闭！';
			return $apiparam;exit;
		}
		if($point<=0 || $point>$userinfo['point'] || $point<$pointexchangeamount){
			$apiparam['sign'] = false;
			$apiparam['message'] = '兑换积分额度错误！';
			return $apiparam;exit;
		}
		$addmoney = number_format(($point/$pointexchangeamount),2,".","");
		$_int1 = M('member')->where(['id'=>$userinfo['id']])->setDec('point',$point);
		if($_int1)$_int2 = M('member')->where(['id'=>$userinfo['id']])->setInc('balance',$addmoney);
		if(!$_int2)M('member')->where(['id'=>$userinfo['id']])->setInc('point',$point);
		if(!$_int1 || !$_int2){
			$apiparam['sign'] = false;
			$apiparam['message'] = '兑换失败！';
			return $apiparam;exit;
		}
		$_t = time();
		$trano          = gettrano(4);
		$fuddetail_data = array();
		$fuddetail_data['trano'] = $trano;
		$fuddetail_data['uid'] = $userinfo['id'];
		$fuddetail_data['username'] = $userinfo['username'];
		$fuddetail_data['amount'] = $point;
		$fuddetail_data['amountbefor'] = $userinfo['point'];
		$fuddetail_data['amountafter'] = $userinfo['point']-$point;
		$fuddetail_data['oddtime'] = $_t;
		$fuddetail_data['remark'] = "{$point}积分兑换{$addmoney}元";
		$fuddetail_data['type'] = 'point';
		$fuddetail_data['typename'] = C('fuddetailtypes.point');
		M('fuddetail')->data($fuddetail_data)->add();
		
		$fuddetail_data = array();
		$fuddetail_data['trano'] = $trano;
		$fuddetail_data['uid'] = $userinfo['id'];
		$fuddetail_data['username'] = $userinfo['username'];
		$fuddetail_data['amount'] = $addmoney;
		$fuddetail_data['amountbefor'] = $userinfo['balance'];
		$fuddetail_data['amountafter'] = $userinfo['balance']+$addmoney;
		$fuddetail_data['oddtime'] = $_t;
		$fuddetail_data['remark'] = "{$point}积分兑换{$addmoney}元";
		$fuddetail_data['type'] = 'pointexchange';
		$fuddetail_data['typename'] = C('fuddetailtypes.pointexchange');
		M('fuddetail')->data($fuddetail_data)->add();
		$apiparam['sign'] = true;
		$apiparam['message'] = '兑换成功！';
		return $apiparam;exit;
	}
	function checkrechargeisok($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$trano = $apiparam['trano'];
		$payorder = M('recharge')->where(['trano'=>$trano])->find();
		if(!$payorder){
			$return['sign'] = false;
			$return['message'] = '获取失败';
			return $return;exit;
		}
		$return['sign'] = true;
		$return['state'] = $payorder['state'];
		$return['message'] = '获取成功';
		return $return;exit;
	}
	function gettouzhuinfo($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$trano = $apiparam['trano'];
		$userinfo      = $apiparam['data'];
		unset($apiparam['data']);
		$info = M('touzhu')->where(['uid'=>$userinfo['id'],'trano'=>$trano])->find();
		if(!$info){
			$apiparam['sign']=false;
			$apiparam['message']='投注订单不存在';
			return $apiparam;exit;
		}
		$apiparam['sign']=true;
		$apiparam['message']='获取成功';
		$apiparam['BillInfo']=$info;
		return $apiparam;exit;
	}
	function chedan($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$trano = $apiparam['trano'];
		$userinfo      = $apiparam['data'];
		unset($apiparam['data']);
		$iskillorder = GetVar('iskillorder');
		if($iskillorder!=1){
			$apiparam['sign']=false;
			$apiparam['message']='平台不允许撤单';
			return $apiparam;exit;
		}
		$info = M('touzhu')->where(['uid'=>$userinfo['id'],'trano'=>$trano])->find();
		if(!$info){
			$apiparam['sign']=false;
			$apiparam['message']='投注订单不存在';
			return $apiparam;exit;
		}
		if($info['isdraw']!=0){
			$apiparam['sign']=false;
			$apiparam['message']='订单状态不允许操作，已记录您的非法操作IP';
			return $apiparam;exit;
		}
		//获取时间
		$cpname = $info['cpname'];
		$_classfile = COMMON_PATH . 'Lib/lotterytimes/'.$cpname.'.class.php';
		if(!is_file($_classfile)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '开奖时间错误';
			return $apiparam;
		}
		$_lotterytimesclass = "Lib\\lotterytimes\\{$cpname}";
		$_lotterytimes = new $_lotterytimesclass;
		$_lottetimes = $_lotterytimes->drawtimes();
		//dump($_lotterytimes);
		//dump($_lottetimes);exit;
		if($_lottetimes['currFullExpect']!=$info['expect']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '已过撤单时间';
			return $apiparam;exit;
		}else{
			$_t = time();
			M('touzhu')->where(['uid'=>$userinfo['id'],'trano'=>$trano])->setField('isdraw',-2);
			$_int = M('member')->where(['id'=>$info['uid']])->setInc('balance',$info['amount']);
			if($_int){
				//撤单账变
				$fuddetail_data = array();
				$fuddetail_data['trano'] = $trano;
				$fuddetail_data['uid'] = $userinfo['id'];
				$fuddetail_data['username'] = $userinfo['username'];
				$fuddetail_data['amount'] = abs($info['amount']);
				$fuddetail_data['amountbefor'] = $userinfo['balance'];
				$fuddetail_data['amountafter'] = $userinfo['balance']+abs($info['amount']);
				$fuddetail_data['oddtime'] = $_t;
				$fuddetail_data['remark'] = "撤单退回";
				$fuddetail_data['type'] = 'cancel';
				$fuddetail_data['typename'] = C('fuddetailtypes.cancel');
				M('fuddetail')->data($fuddetail_data)->add();
				//撤单洗码
/*				M('member')->where(['id'=>$info['uid']])->setInc('xima',$info['amount']);
				$fuddetail_data = array();
				$fuddetail_data['trano'] = $trano;
				$fuddetail_data['uid'] = $userinfo['id'];
				$fuddetail_data['username'] = $userinfo['username'];
				$fuddetail_data['amount'] = abs($info['amount']);
				$fuddetail_data['amountbefor'] = $userinfo['xima'];
				$fuddetail_data['amountafter'] = $userinfo['xima']+abs($info['amount']);
				$fuddetail_data['oddtime'] = $_t;
				$fuddetail_data['remark'] = "撤单退回洗码账户";
				$fuddetail_data['type'] = 'xima';
				$fuddetail_data['typename'] = C('fuddetailtypes.xima');
				M('fuddetail')->data($fuddetail_data)->add();*/
				//撤单积分
				$pointtouzhu    = abs(intval(GetVar('pointtouzhu')));
				$pointtouzhuadd = abs(intval(GetVar('pointtouzhuadd')));
				if($pointtouzhu && $pointtouzhuadd){
					$_addpoint = number_format(abs($info['amount'])*$pointtouzhuadd/$pointtouzhu,4,".","");
					if($_addpoint>0){
						M('member')->where(['id'=>$info['uid']])->setDec('point',$_addpoint);
						$fuddetail_data = array();
						$fuddetail_data['trano'] = $trano;
						$fuddetail_data['uid'] = $userinfo['id'];
						$fuddetail_data['username'] = $userinfo['username'];
						$fuddetail_data['amount'] = abs($_addpoint);
						$fuddetail_data['amountbefor'] = $userinfo['point'];
						$fuddetail_data['amountafter'] = $userinfo['point']-abs($_addpoint);
						$fuddetail_data['oddtime'] = $_t;
						$fuddetail_data['remark'] = "撤单扣回赠送积分";
						$fuddetail_data['type'] = 'point';
						$fuddetail_data['typename'] = C('fuddetailtypes.point');
						M('fuddetail')->data($fuddetail_data)->add();
					}
				}
				$apiparam['sign']=true;
				$apiparam['message']='撤单成功';
				return $apiparam;exit;
			}else{
				$apiparam['sign']=false;
				$apiparam['message']='撤单失败';
				return $apiparam;exit;
			}
		}
		
		/*$apiparam['sign']=true;
		$apiparam['message']='获取成功';
		$apiparam['BillInfo']=$info;*/
		return $apiparam;exit;
	}
	function defaultuserbankcard($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo      = $apiparam['data'];
		$id = $apiparam['id'];
		$info = M('banklist')->where(['id'=>$id,'uid'=>$userinfo['id']])->find();
		if(!$id || !$info){
			$apiparam['sign'] = true;
			$apiparam['message'] = '绑定的银行不存在';
//			return $apiparam;exit;
			$this->ajaxReturn($apiparam);exit;
		}
		if($info['isdefault']==1){
			$apiparam['sign'] = true;
			$apiparam['message'] = '设置默认提款银行卡成功';
			$this->ajaxReturn($apiparam);exit;
		}
		if($info['state']!=1){
			$apiparam['sign'] = false;
			$apiparam['message'] = '该银行卡未审核';
			$this->ajaxReturn($apiparam);exit;
		}
		M('banklist')->where(['id'=>['neq',$id],'uid'=>$userinfo['id']])->setField(['isdefault'=>0]);
		$int = M('banklist')->where(['id'=>$id,'uid'=>$userinfo['id']])->setField(['isdefault'=>1]);
		if($int){
			$apiparam['sign'] = true;
			$apiparam['message'] = '设置默认提款银行卡成功';
			$this->ajaxReturn($apiparam);exit;
		}else{
			$apiparam['sign'] = false;
			$apiparam['message'] = '设置默认提款银行卡失败';
			$this->ajaxReturn($apiparam);exit;
		}
		$this->ajaxReturn($apiparam);exit;
	}
	function usergetbankcard($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo      = $apiparam['data'];
		$banklist = M('banklist')->where(['uid'=>$userinfo['id']])->order('id desc,state desc')->select();
		foreach($banklist as $k=>$v){
			$v['banklogo'] = M('sysbank')->where(['bankcode'=>$v['bankcode']])->getField('banklogo');
			$banklist[$k] = $v;
		}
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['banklist'] = $banklist;
		$sysBankMaxNum = abs(intval(GetVar('sysBankMaxNum')));
		$apiparam['sysBankMaxNum'] = $sysBankMaxNum;
		return $apiparam;exit;
	}
	function userbindbankcard($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo      = $apiparam['data'];
		$bankaddress   = $apiparam['bankaddress'];
		$bankbranch      = $apiparam['bankbranch']?$apiparam['bankbranch']:"";
		$bankcode      = $apiparam['bankcode'];
		$banknumber    = $apiparam['banknumber'];
		$tradepassword = $apiparam['tradepassword'];
		$accountname = $apiparam['accountname'];
		
		if(!$userinfo['userbankname']){
			if(!$accountname){
				$apiparam['sign'] = false;
				$apiparam['message'] = '请输入你的真实姓名';
				return $apiparam;exit;
			}
		}else{
			if(!$accountname){
				$accountname = $apiparam['accountname'];
			}else{
				if($userinfo['userbankname']!=$accountname){
					$apiparam['sign'] = false;
					$apiparam['message'] = '系统检测到您绑定的真实姓名与之前的邦定不一致';
					return $apiparam;exit;
				}
			}
		}
		$pat = '/^\d{16,19}$/';
		if(!preg_match($pat,$banknumber)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请输入16~19位银行卡账号';
			return $apiparam;exit;
		}
		if(strlen($bankcode)<1){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请选择银行';
			return $apiparam;exit;
		}
		/*if(strlen($bankbranch)<1){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请输入正确的开户行网点';
			return $apiparam;exit;
		}*/
		if(strlen($bankaddress)<3){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请选择开户行地址';
			return $apiparam;exit;
		}
		if(md5(sha1($tradepassword))!=$userinfo['tradepassword']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '提款密码错误';
			return $apiparam;exit;
		}
		$bankinfo = M('sysbank')->where(['bankcode'=>$bankcode])->find();
		if(!$bankinfo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '您选择的银行暂不支持';
			return $apiparam;exit;
		}
		$sysBankMaxNum = abs(intval(GetVar('sysBankMaxNum')));
		$totalcount    = M('banklist')->where(['uid'=>$userinfo['id']])->count();
		if($totalcount && $totalcount>=$sysBankMaxNum){
			$apiparam['sign'] = false;
			$apiparam['message'] = "平台允许绑定{$sysBankMaxNum}张银行卡";
			return $apiparam;exit;
		}
		$data = [];
		if(!$userinfo['userbankname']){
			$int = M('member')->where(['id'=>$userinfo['id']])->setField(['userbankname'=>$accountname]);
			if(!$int){
				$apiparam['sign'] = false;
				$apiparam['message'] = '首次邦定银行卡真实姓名邦定失败';
				return $apiparam;exit;
			}
		}

		$banklist = M('banklist')->where("uid=".$userinfo['id'])->select();
		$data['uid'] = $userinfo['id'];
		$data['username'] = $userinfo['username'];
		if(empty($banklist)){
			$data['isdefault']=1;
		}else{
			$data['isdefault']=0;
		}
		$data['bankaddress'] = $bankaddress;
		$data['bankbranch'] = $bankbranch;
		$data['bankcode'] = $bankinfo['bankcode'];
		$data['bankname'] = $bankinfo['bankname'];
		$data['accountname'] = $userinfo['userbankname'];
		$data['banknumber'] = $banknumber;
		$data['date'] = date("Y-m-d H:i:s",time());
		$data['accountname'] = $accountname;
		/*$data['isdefault'] = 0;*/
		$data['state'] = 1;
		$bindcardamount = abs(trim(GetVar('bindcardamount')));
		$cardcount = M('banklist')->where(['uid'=>$data['uid'],'state'=>1])->count();
		$_int = M('banklist')->data($data)->add();
		if($_int){
			$apiparam['sign'] = true;
			if(!$cardcount) {
				$balance = $bindcardamount;
				$amountbefor = M('member')->where(['id' => $data['uid']])->getField('balance');
				M('member')->where(['id' => $data['uid']])->setInc('balance', $balance);
				$fuddetaildata = [];
				$fuddetaildata['trano'] = gettrano(4);
				$fuddetaildata['uid'] = $data['uid'];
				$fuddetaildata['username'] = $data['username'];
				$fuddetaildata['type'] = 'activity_bindcard';
				$fuddetaildata['typename'] = C('fuddetailtypes.activity_bindcard');
				$fuddetaildata['amount'] = abs($balance);
				$fuddetaildata['amountbefor'] = $amountbefor;
				$fuddetaildata['amountafter'] = $amountbefor + abs($balance);
				$fuddetaildata['remark'] = '绑定银行赠送';
				$fuddetaildata['oddtime'] = time();
				M('fuddetail')->data($fuddetaildata)->add();
			}
			$apiparam['message'] = '银行绑定成功';
		}else{
			$apiparam['sign'] = false;
			$apiparam['message'] = '银行绑定失败';
		}
		return $apiparam;exit;
	}
	function bankcardList($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo      = $apiparam['data'];
		$banklist = M('sysbank')->where(['state'=>1])->order('listorder asc')->select();
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['banklist'] = $banklist;
		return $apiparam;exit;
	}
	function userbindemail($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo      = $apiparam['data'];
		$email         = $apiparam['email'];
		$tradepassword = $apiparam['tradepassword'];
		if($userinfo['email']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '邮箱无需重复绑定';
			return $apiparam;exit;
		}
		$myreg = '/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/';
		if(!preg_match($myreg,$email)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '邮箱格式错误';
			return $apiparam;exit;
		}
		if(md5(sha1($tradepassword))!=$userinfo['tradepassword']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '提款密码错误';
			return $apiparam;exit;
		}
		if(M('member')->where(['email'=>$email])->find()){
			$apiparam['sign'] = false;
			$apiparam['message'] = '该邮箱账号已经存在';
			return $apiparam;exit;
		}
		$int = M('member')->where(['id'=>$userinfo['id']])->setField(['email'=>$email]);
		if($int){
			$apiparam['sign'] = true;
			$apiparam['message'] = '邮箱绑定成功';
		}else{
			$apiparam['sign'] = false;
			$apiparam['message'] = '邮箱绑定失败';
		}
		return $apiparam;exit;
	}
	function userbindphone($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo      = $apiparam['data'];
		unset($apiparam["data"]);
		$phone         = $apiparam['phone'];
		$tradepassword = $apiparam['tradepassword'];
		if($userinfo['tel']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '手机号无需重复绑定';
			return $apiparam;exit;
		}
		$myreg = '/^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/';
		if(!preg_match($myreg,$phone)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '手机号码格式错误';
			return $apiparam;exit;
		}
		if(md5(sha1($tradepassword))!=$userinfo['tradepassword']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '提款密码错误';
			return $apiparam;exit;
		}
		$int = M('member')->where(['id'=>$userinfo['id']])->setField(['tel'=>$phone]);
		if($int){
			$apiparam['sign'] = true;
			$apiparam['message'] = '手机号码绑定成功';
		}else{
			$apiparam['sign'] = false;
			$apiparam['message'] = '手机号码绑定失败';
		}
		return $apiparam;exit;
	}
	//密保重置验证
	function questionanscheck($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo    = $apiparam['data'];
		unset($apiparam["data"]);
		$answerOne     = $apiparam['answerOne'];
		$answerTwo     = $apiparam['answerTwo'];
		$answerThree   = $apiparam['answerThree'];
		if(md5(sha1($answerOne))==$userinfo['question']['answerone'] && md5(sha1($answerTwo))==$userinfo['question']['answertwo'] && md5(sha1($answerThree))==$userinfo['question']['answerthree']){
			$_t = time();
			$questionanscheck['quetoken'] = md5($_t);
			$questionanscheck['quetime']  = $_t;
			F(md5('questionanscheck').'_'.$userinfo['id'],$questionanscheck);
			$apiparam['sign']=true;
			$apiparam['message']='密保重置验证成功';
			$apiparam['questionanscheck']=$questionanscheck;
			return $apiparam;exit;
		}else{
			$apiparam['sign']=false;
			$apiparam['message']='密保重置验证失败';
			return $apiparam;exit;
		}
	}
	//密保绑定
	function usersecurity($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo    = $apiparam['data'];
		unset($apiparam["data"]);
		$answerOne     = $apiparam['answerOne'];
		$answerTwo     = $apiparam['answerTwo'];
		$answerThree   = $apiparam['answerThree'];
		$questionOne   = $apiparam['questionOne'];
		$questionTwo   = $apiparam['questionTwo'];
		$questionThree = $apiparam['questionThree'];
		$tradepassword = $apiparam['tradepassword'];
		$questoken     = $apiparam['questoken'];
		$questionanscheck     = $apiparam['questionanscheck'];
		if(!$questionOne){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请选择密保问题1！';
			return $apiparam;exit;
		}
		if(!$questionTwo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请选择密保问题2！';
			return $apiparam;exit;
		}
		if(!$questionThree){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请选择密保问题3！';
			return $apiparam;exit;
		}
		if(!$answerOne){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请填写密保答案1！';
			return $apiparam;exit;
		}
		if(!$answerTwo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请填写密保答案2！';
			return $apiparam;exit;
		}
		if(!$answerThree){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请填写密保答案3！';
			return $apiparam;exit;
		}
		if($questionOne==$questionTwo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '密保问题1和密保问题2不能相同！';
			return $apiparam;exit;
		}
		if($questionOne==$questionThree){
			$apiparam['sign'] = false;
			$apiparam['message'] = '密保问题1和密保问题3不能相同！';
			return $apiparam;exit;
		}
		if($questionTwo==$questionThree){
			$apiparam['sign'] = false;
			$apiparam['message'] = '密保问题2和密保问题3不能相同！';
			return $apiparam;exit;
		}
		if($answerOne==$answerTwo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '密保答案1和密保答案2不能相同！';
			return $apiparam;exit;
		}
		if($answerOne==$answerThree){
			$apiparam['sign'] = false;
			$apiparam['message'] = '密保答案1和密保答案3不能相同！';
			return $apiparam;exit;
		}
		if($answerTwo==$answerThree){
			$apiparam['sign'] = false;
			$apiparam['message'] = '密保答案2和密保答案3不能相同！';
			return $apiparam;exit;
		}
		$passwordpatten = '/^[\w\W]{4,16}$/';
		if(!preg_match($passwordpatten,$tradepassword)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '提款密码应为4-16位字符';
			return $apiparam;exit;
		}
		if(md5(sha1($tradepassword))!=$userinfo['tradepassword']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '提款密码错误';
			return $apiparam;exit;
		}
		if($questoken){
			$questionanscheck=F(md5('questionanscheck').'_'.$userinfo['id']);
			if(!$questionanscheck){
				$apiparam['sign'] = true;
				$apiparam['message'] = '密保重置验证失败';
				return $apiparam;exit;
			}
			if($questoken!=$questionanscheck['quetoken']){
				$apiparam['sign'] = true;
				$apiparam['message'] = '密保重置token验证失败';
				return $apiparam;exit;
			}
			$_t = time();
			if($_t-$questionanscheck['quetime']>300){
				$apiparam['sign'] = true;
				$apiparam['message'] = '密保重置token验证超时';
				return $apiparam;exit;
			}
			if(!$userinfo['question'] || !is_array($userinfo['question'])){
				$apiparam['sign'] = false;
				$apiparam['message'] = '未设置密保，重置失败';
				return $apiparam;exit;
			}
			$data = [];
			//$data['uid']           = $userinfo['id'];
			$data['questionone']   = $questionOne;
			$data['questiontwo']   = $questionTwo;
			$data['questionthree'] = $questionThree;
			$data['answerone']     = md5(sha1($answerOne));
			$data['answertwo']     = md5(sha1($answerTwo));
			$data['answerthree']   = md5(sha1($answerThree));
			$int = M('question')->where(['uid'=>$userinfo['id'],'id'=>$userinfo['question']['id']])->setField($data);
			if($int){
				$apiparam['sign'] = true;
				$apiparam['message'] = '密保重置成功2';
			}else{
				$apiparam['sign'] = false;
				$apiparam['message'] = '密保重置失败';
			}
			return $apiparam;exit;
		}else{
/*			if($userinfo['question'] && is_array($userinfo['question'])){
				$apiparam['sign'] = false;
				$apiparam['message'] = '您的密保已经设置无需重复设置';
				return $apiparam;exit;
			}*/
			$data = [];
			$data['uid']           = $userinfo['id'];
			$data['username']      = $userinfo['username'];
			$data['questionone']   = $questionOne;
			$data['questiontwo']   = $questionTwo;
			$data['questionthree'] = $questionThree;
			$data['answerone']     = md5(sha1($answerOne));
			$data['answertwo']     = md5(sha1($answerTwo));
			$data['answerthree']   = md5(sha1($answerThree));
			$int = M('question')->data($data)->add();
			if($int){
				$apiparam['sign'] = true;
				$apiparam['message'] = '密保设置成功1';
			}else{
				$apiparam['sign'] = false;
				$apiparam['message'] = '密保设置失败';
			}
			return $apiparam;exit;
		}
	}
	function usereditdrawpass($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$oldpassword = $apiparam['oldpassword'];
		$password    = $apiparam['password'];
		$rpassword   = $apiparam['rpassword'];
		$userinfo    = $apiparam['data'];
		$passwordpatten = '/^[\w\W]{4,16}$/';
		if(!preg_match($passwordpatten,$oldpassword)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '旧提款密码应为4-16位字符';
			return $apiparam;exit;
		}
		if(!preg_match($passwordpatten,$password)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '新提款密码应为4-16位字符';
			return $apiparam;exit;
		}
		if($password!=$rpassword){
			$apiparam['sign'] = false;
			$apiparam['message'] = '新提款密码两次输入不一致';
			return $apiparam;exit;
		}
		if(!$userinfo['tradepassword']){
			$userinfo['tradepassword'] = $userinfo['password'];
		}
		if(md5(sha1($oldpassword))!=$userinfo['tradepassword']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '旧提款密码错误';
			return $apiparam;exit;
		}
		$int = M('member')->where(['id'=>$userinfo['id']])->setField(['tradepassword'=>md5(sha1($password))]);
		if($int){
			$apiparam['sign'] = true;
			$apiparam['message'] = '修改成功';
		}else{
			$apiparam['sign'] = false;
			$apiparam['message'] = '修改失败';
		}
		return $apiparam;exit;
	}
	function usereditpass($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$oldpassword = $apiparam['oldpassword'];
		$password    = $apiparam['password'];
		$rpassword   = $apiparam['rpassword'];
		$userinfo    = $apiparam['data'];
		$passwordpatten = '/^[\w\W]{6,16}$/';
		if(!preg_match($passwordpatten,$oldpassword)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '旧密码应为6-16位字符';
			return $apiparam;exit;
		}
		if(!preg_match($passwordpatten,$password)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '新密码应为6-16位字符';
			return $apiparam;exit;
		}
		if($password!=$rpassword){
			$apiparam['sign'] = false;
			$apiparam['message'] = '新密码两次输入不一致';
			return $apiparam;exit;
		}
		if(md5(sha1($oldpassword))!=$userinfo['password']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '旧密码错误';
			return $apiparam;exit;
		}
		$int = M('member')->where(['id'=>$userinfo['id']])->setField(['password'=>md5(sha1($password))]);
		if($int){
			$apiparam['sign'] = true;
			$apiparam['message'] = '修改成功';
		}else{
			$apiparam['sign'] = false;
			$apiparam['message'] = '修改失败';
		}
		return $apiparam;exit;
	}
	function userbindrealname($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		
		$userinfo = $apiparam['data'];
		$realname        = $apiparam['realname'];
		$tradepassword   = $apiparam['tradepassword'];
		$realnamepatten = '/^[\x80-\xff]{6,12}$/';
		$passwordpatten = '/^[\w\W]{4,16}$/';
		if($userinfo['tradepassword']==''){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请先绑定提款密码';
			return $apiparam;exit;
		}
		if(!preg_match($realnamepatten,$realname)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '真实姓名格式错误';
			return $apiparam;exit;
		}
		if(!preg_match($passwordpatten,$tradepassword)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '提款密码应为4-16位字符';
			return $apiparam;exit;
		}
		if(md5(sha1($tradepassword))!=$userinfo['tradepassword']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '提款密码错误';
			return $apiparam;exit;
		}
		$int = M('member')->where(['id'=>$userinfo['id']])->setField(['userbankname'=>$realname]);
		if($int){
			$apiparam['sign'] = true;
			$apiparam['message'] = '绑定成功';
		}else{
			$apiparam['sign'] = false;
			$apiparam['message'] = '绑定失败';
		}
		return $apiparam;exit;
	}
	function betslisttoday($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$lotteryname = $apiparam['lotteryname'];
		$page = intval($apiparam['page'])>0?intval($apiparam['page']):1;
		$pagesize = (intval($apiparam['pagesize'])>0 && intval($apiparam['pagesize'])<=30)?intval($apiparam['pagesize']):10;
		$lotteryinfo = M('caipiao')->where(['name'=>$lotteryname])->field('id,issys,listorder',true)->find();
		if(!$lotteryinfo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '彩种不存在！';
			return $apiparam;exit;
		}
		$map = [];
		$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday   = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$map['oddtime'][] = ['egt',$beginToday];
		$map['oddtime'][] = ['elt',$endToday];
		$map['uid'] = ['eq',$userinfo['id']];
		$map['cpname'] = ['eq',$lotteryname];
		$db = M('touzhu');
		$records = $db->where($map)->count();
		$GridPage = ($page -1)*$pagesize;
		$touzhulist = $db->where($map)->order('id desc')->limit($GridPage.','.$pagesize)->select();
		foreach($touzhulist as $k=>$v){
			if($v['isdraw']==1){
				$v['state'] = '已中奖';
			}elseif($v['isdraw']==-1){
				$v['state'] = '未中奖';
			}elseif($v['isdraw']==-2){
				$v['state'] = '已撤单';
			}elseif($v['isdraw']==0){
				$v['state'] = '未开奖';
			}
			$v['oddtime'] = date('Y-m-d H:i:s',$v['oddtime']);
			$touzhulist[$k] = $v;
		}
		$totalsize = ceil($records/$pagesize);
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['page'] = $page;
		$apiparam['pagestr'] = $GridPage.','.$pagesize;
		$apiparam['total'] = $totalsize;
		$apiparam['records'] = $records;
		$apiparam['root'] = $touzhulist;
		return $apiparam;
		
	}
	function userbets($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$lotteryname = $apiparam['lotteryname'];
		$trano       = $apiparam['trano'];
		$startime    = $apiparam['startime'];
		$endtime     = $apiparam['endtime'];
		$state       = $apiparam['state'];
		$page        = intval($apiparam['page'])>0?intval($apiparam['page']):1;
		$pagesize    = (intval($apiparam['pagesize'])>0 && intval($apiparam['pagesize'])<=30)?intval($apiparam['pagesize']):10;
		
		$map = [];
		if($startime){
			$map['oddtime'][] = ['egt',strtotime($startime)];
		}
		if($endtime){
			$map['oddtime'][] = ['elt',strtotime($endtime)+86400-1];
		}
		if($lotteryname){
			$map['cpname'] = ['eq',$lotteryname];
		}
		if($state!='' && in_array($state,[0,1,-1,-2])){
			$map['isdraw'] = ['eq',$state];
		}
		if($trano){
			$map['trano'] = ['eq',$trano];
		}
		$map['uid'] = ['eq',$userinfo['id']];
		$db = M('touzhu');
		$records = $db->where($map)->count();
		$GridPage = ($page -1)*$pagesize;
		$touzhulist = $db->where($map)->order('id desc')->limit($GridPage.','.$pagesize)->select();
		//有效投注
		$_map = [];
		if($startime)$_map['oddtime'][] = ['egt',strtotime($startime)];
		if($endtime)$_map['oddtime'][] = ['elt',strtotime($endtime)+86400-1];
		if($lotteryname)$_map['cpname'] = ['eq',$lotteryname];
		$_map['isdraw'] = ['in',[1,-1]];
		if($trano)$_map['trano'] = ['eq',$trano];
		$_map['uid'] = ['eq',$userinfo['id']];
		$touzhutotal = $db->where($_map)->sum('amount');
		//返奖金额
		$_map = [];
		if($startime)$_map['oddtime'][] = ['egt',strtotime($startime)];
		if($endtime)$_map['oddtime'][] = ['elt',strtotime($endtime)+86400-1];
		if($lotteryname)$_map['cpname'] = ['eq',$lotteryname];
		$_map['isdraw'] = ['in',[1]];
		if($trano)$_map['trano'] = ['eq',$trano];
		$_map['uid'] = ['eq',$userinfo['id']];
		$fanjiangtotal = $db->where($_map)->sum('okamount');
		//投注盈亏金额
		$tzyingkuitotal = number_format($fanjiangtotal - $touzhutotal, 2, '.', '');
		
		foreach($touzhulist as $k=>$v){
			if($v['isdraw']==1){
				$v['state'] = '已中奖';
			}elseif($v['isdraw']==-1){
				$v['state'] = '未中奖';
			}elseif($v['isdraw']==-2){
				$v['state'] = '已撤单';
			}elseif($v['isdraw']==0){
				$v['state'] = '未开奖';
			}
			$v['oddtime'] = date('Y-m-d H:i:s',$v['oddtime']);
			$touzhulist[$k] = $v;
		}
		$totalsize = ceil($records/$pagesize);
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['page'] = $page;
		$apiparam['pagestr'] = $GridPage.','.$pagesize;
		$apiparam['total'] = $totalsize;
		$apiparam['records'] = $records;
		$apiparam['root'] = $touzhulist;
		$apiparam['touzhutotal'] = $touzhutotal?$touzhutotal:'0.00';
		$apiparam['fanjiangtotal'] = $fanjiangtotal?$fanjiangtotal:'0.00';
		$apiparam['tzyingkuitotal'] = $tzyingkuitotal?$tzyingkuitotal:'0.00';
		return $apiparam;
		
	}
	function userfuddetail($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$trano       = $apiparam['trano'];
		$startime    = $apiparam['startime'];
		$endtime     = $apiparam['endtime'];
		$type        = $apiparam['type'];
		$acctype     = $apiparam['acctype'];
		$page        = intval($apiparam['page'])>0?intval($apiparam['page']):1;
		$pagesize    = (intval($apiparam['pagesize'])>0 && intval($apiparam['pagesize'])<=30)?intval($apiparam['pagesize']):10;
		
		$map = [];
		if($startime){
			$map['oddtime'][] = ['egt',strtotime($startime)];
		}
		if($endtime){
			$map['oddtime'][] = ['elt',strtotime($endtime)+86400-1];
		}
		if($type){
			$map['type'][] = ['eq',$type];
		}
		/*if($acctype && in_array($acctype,['amount','xima','point'])){
			if($acctype=='xima'){
				$map['type'] = ['neq','xima'];
			}else if($acctype=='point'){
				$map['type'] = ['neq','point'];
				
			}
			
		}*/
		if($trano){
			$map['trano'] = ['eq',$trano];
		}
		$map['uid'] = ['eq',$userinfo['id']];
		$db = M('fuddetail');
		$records = $db->where($map)->count();
		$GridPage = ($page -1)*$pagesize;
		$list = $db->where($map)->order('id desc')->limit($GridPage.','.$pagesize)->select();
		foreach($list as $k=>$v){
			$v['oddtime'] = date('Y-m-d H:i:s',$v['oddtime']);
			$list[$k] = $v;
		}
		$totalsize = ceil($records/$pagesize);
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['page'] = $page;
		$apiparam['pagestr'] = $GridPage.','.$pagesize;
		$apiparam['total'] = $totalsize;
		$apiparam['records'] = $records;
		$apiparam['root'] = $list;
		return $apiparam;
		
	}
	function rechargelist($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$trano       = $apiparam['trano'];
		$startime    = $apiparam['startime'];
		$endtime     = $apiparam['endtime'];
		$state       = $apiparam['state'];
		$page        = intval($apiparam['page'])>0?intval($apiparam['page']):1;
		$pagesize    = (intval($apiparam['pagesize'])>0 && intval($apiparam['pagesize'])<=30)?intval($apiparam['pagesize']):10;
		
		$map = [];
		if($startime){
			$map['oddtime'][] = ['egt',strtotime($startime)];
		}
		if($endtime){
			$map['oddtime'][] = ['elt',strtotime($endtime)+86400-1];
		}
		if($state!='' && in_array($state,[0,1,-1])){
			$map['state'] = ['eq',$state];
		}
		if($trano){
			$map['trano'] = ['eq',$trano];
		}
		$map['uid'] = ['eq',$userinfo['id']];
		$db = M('recharge');
		$records = $db->where($map)->count();
		$GridPage = ($page -1)*$pagesize;
		$list = $db->where($map)->order('id desc')->limit($GridPage.','.$pagesize)->select();
		foreach($list as $k=>$v){
			if($v['state']==1){
				$v['state'] = '已完成';
			}elseif($v['state']==-1){
				$v['state'] = '取消申请';
			}elseif($v['state']==0){
				$v['state'] = '正在审核';
			}
			$v['oddtime'] = date('Y-m-d H:i:s',$v['oddtime']);
			$list[$k] = $v;
		}
		$totalsize = ceil($records/$pagesize);
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['page'] = $page;
		$apiparam['pagestr'] = $GridPage.','.$pagesize;
		$apiparam['total'] = $totalsize;
		$apiparam['records'] = $records;
		$apiparam['root'] = $list;
		return $apiparam;
		
	}
	function withdrawlist($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$trano       = $apiparam['trano'];
		$startime    = $apiparam['startime'];
		$endtime     = $apiparam['endtime'];
		$state       = $apiparam['state'];
		$page        = intval($apiparam['page'])>0?intval($apiparam['page']):1;
		$pagesize    = (intval($apiparam['pagesize'])>0 && intval($apiparam['pagesize'])<=30)?intval($apiparam['pagesize']):10;
		
		$map = [];
		if($startime){
			$map['oddtime'][] = ['egt',strtotime($startime)];
		}
		if($endtime){
			$map['oddtime'][] = ['elt',strtotime($endtime)+86400-1];
		}
		if($state!='' && in_array($state,[0,1,-1])){
			$map['state'] = ['eq',$state];
		}
		if($trano){
			$map['trano'] = ['eq',$trano];
		}
		$map['uid'] = ['eq',$userinfo['id']];
		$db = M('withdraw');
		$records = $db->where($map)->count();
		$GridPage = ($page -1)*$pagesize;
		$list = $db->where($map)->order('id desc')->limit($GridPage.','.$pagesize)->select();
		foreach($list as $k=>$v){
			if($v['state']==1){
				$v['state'] = '已完成';
			}elseif($v['state']==-1){
				$v['state'] = '取消申请';
			}elseif($v['state']==0){
				$v['state'] = '正在审核';
			}
			$v['oddtime'] = date('Y-m-d H:i:s',$v['oddtime']);
			$list[$k] = $v;
		}
		$totalsize = ceil($records/$pagesize);
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['page'] = $page;
		$apiparam['pagestr'] = $GridPage.','.$pagesize;
		$apiparam['total'] = $totalsize;
		$apiparam['records'] = $records;
		$apiparam['root'] = $list;
		return $apiparam;
		
	}
	//彩票报表
	function lotteryreport($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$type        = $apiparam['type'];
		$type        = $type?$type:'days';
		$startime    = $apiparam['startime']?$apiparam['startime']:date('Y-m-d',time()-86400*7);
		$endtime     = $apiparam['endtime']?$apiparam['endtime']:date('Y-m-d',time());
		$page        = intval($apiparam['page'])>0?intval($apiparam['page']):1;
		$pagesize    = (intval($apiparam['pagesize'])>0 && intval($apiparam['pagesize'])<=30)?intval($apiparam['pagesize']):10;

		
		$map = [];
		$map['uid'] = ['eq',$userinfo['id']];
		if($startime){
			$map['oddtime'][] = ['egt',strtotime($startime)];
		}
		if($endtime){
			$map['oddtime'][] = ['elt',strtotime($endtime)];
		}
		$_endDate= date("Y-m-d",strtotime($endtime));
		if($type=='days'){
			$days = ceil((strtotime($endtime)-strtotime($startime))/86400);
			$days = $days>30?30:$days;
			for($i=0;$i<=$days;$i++){
				$date[] = $_tt = date("Y-m-d", strtotime($_endDate)-86400*$i);
				//充值
				$map = [];
				$map['uid'] = ['eq',$userinfo['id']];
				$map['state'] = ['eq',1];
				$map['oddtime'][] = ['elt',strtotime($_tt)+86400-1];
				$map['oddtime'][] = ['egt',strtotime($_tt)];
				$map['isauto'] = ['eq',1];
				$zdchongzhiall = 0;
				$zdchongzhiall = M('recharge')->where($map)->sum('amount');
		//手动充值加
				$map = [];
				$map['uid'] = ['eq',$userinfo['id']];
				$map['state'] = ['eq',1];
				$map['oddtime'][] = ['elt',strtotime($_tt)+86400-1];
				$map['oddtime'][] = ['egt',strtotime($_tt)];
				$map['isauto'] = ['eq',2];
				$map['sdtype'] = ['eq',1];
				$sdjiachongzhiall = 0;
				$sdjiachongzhiall = M('recharge')->where($map)->sum('amount');
		//手动充值减
				$map = [];
				$map['uid'] = ['eq',$userinfo['id']];
				$map['state'] = ['eq',1];
				$map['oddtime'][] = ['elt',strtotime($_tt)+86400-1];
				$map['oddtime'][] = ['egt',strtotime($_tt)];
				$map['isauto'] = ['eq',2];
				$map['sdtype'] = ['eq',-1];
				$sdjianchongzhiall = 0;
				$sdjianchongzhiall = M('recharge')->where($map)->sum('amount');
				$dayRechargeMoney = 0;
				$dayRechargeMoney = $zdchongzhiall+$sdjiachongzhiall-$sdjianchongzhiall;
				//提款
				$map = [];
				$map['uid'] = ['eq',$userinfo['id']];
				$map['state'] = ['eq',1];
				$map['oddtime'][] = ['elt',strtotime($_tt)+86400-1];
				$map['oddtime'][] = ['egt',strtotime($_tt)];
				$dayDrawRechargeMoney = 0;
				$dayDrawRechargeMoney = M('withdraw')->where($map)->sum('amount');
				//消费（投注）
				$map = [];
				$map['uid'] = ['eq',$userinfo['id']];
				$map['isdraw'] = ['in',[1,-1]];
				$map['oddtime'][] = ['elt',strtotime($_tt)+86400-1];
				$map['oddtime'][] = ['egt',strtotime($_tt)];
				$dayConsumptionMoney = 0;
				$dayConsumptionMoney = M('touzhu')->where($map)->sum('amount');
				//返点
				$map = [];
				$map['uid'] = ['eq',$userinfo['id']];
				$map['type'] = ['eq','commission'];
				$map['oddtime'][] = ['elt',strtotime($_tt)+86400-1];
				$map['oddtime'][] = ['egt',strtotime($_tt)];
				$dayCommissionMoney = 0;
				$dayCommissionMoney = M('fuddetail')->where($map)->sum('amount');
				//中奖
				$map = [];
				$map['uid'] = ['eq',$userinfo['id']];
				$map['isdraw'] = ['eq',1];
				$map['oddtime'][] = ['elt',strtotime($_tt)+86400-1];
				$map['oddtime'][] = ['egt',strtotime($_tt)];
				$dayIncomeMoney = 0;
				$dayIncomeMoney = M('touzhu')->where($map)->sum('amount');
				//活动
				$map = [];
				$map['uid'] = ['eq',$userinfo['id']];
				$map['type'] = ['in',['activity_bindcard','activity_rxf','activity_rks','activity_yxf','activity_yks']];
				$map['oddtime'][] = ['elt',strtotime($_tt)+86400-1];
				$map['oddtime'][] = ['egt',strtotime($_tt)];
				$dayActivitiesMoney = 0;
				$dayActivitiesMoney = M('fuddetail')->where($map)->sum('amount');
				//盈利
				$dayDividendMoney = 0;
				$dayDividendMoney = $dayIncomeMoney - $dayConsumptionMoney + $dayActivitiesMoney;
				$list[$i]['statDate'] = $_tt;
				$list[$i]['dayRechargeMoney'] = $dayRechargeMoney?$dayRechargeMoney:0;
				$list[$i]['dayDrawRechargeMoney'] = $dayDrawRechargeMoney?$dayDrawRechargeMoney:0;
				$list[$i]['dayConsumptionMoney'] = $dayConsumptionMoney?$dayConsumptionMoney:0;
				$list[$i]['dayCommissionMoney'] = $dayCommissionMoney?$dayCommissionMoney:0;
				$list[$i]['dayIncomeMoney'] = $dayIncomeMoney?$dayIncomeMoney:0;
				$list[$i]['dayActivitiesMoney'] = $dayActivitiesMoney?$dayActivitiesMoney:0;
				$list[$i]['dayDividendMoney'] = $dayDividendMoney?$dayDividendMoney:0;
			}
			$records = $days;
		}elseif($type=='months'){
			
		}
		$GridPage = ($page -1)*$pagesize;
		$totalsize = ceil($records/$pagesize);
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['page'] = $page;
		$apiparam['total'] = $totalsize;
		$apiparam['records'] = $records;
		$list = array_slice($list,$GridPage,$pagesize);
		$apiparam['root'] = $list;
		return $apiparam;
	}
	/*充值 提款************************************************/
	//获取充值方式列表
	function getrechargetypelist($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$list = M('payset')->where(['state'=>1])->order('listorder asc')->select();
		$_list = [];
		foreach($list as $k=>$v){
			$configs = [];
			$configs = unserialize($v['configs']);
			unset($v['configs']);
			if($v['isonline']!=1 && is_array($configs)){
				$v = array_merge($v,$configs);
			}
			$_list[$k] = $v;
		}
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['data'] = $_list;
		return $apiparam;
	}
	//添加充值订单
	function addrecharge($apiparam=array()){
	    //echo 111;exit;
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$amount  = intval($apiparam['amount']);
		$paytype = $apiparam['paytype'];
		$userpayname = $apiparam['userpayname'];
		if(!$paytype){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请选择充值方式';
			$this->ajaxReturn($apiparam); exit;
		}
		if($amount<=0){
			$apiparam['sign'] = false;
			$apiparam['message'] = '充值金额不得低于0元';
			return $apiparam;exit;
		}
		if(in_array($paytype,['alipay','tenpay','weixin','linepay','cloud']) && !$userpayname){
			$apiparam['sign'] = false;
			$apiparam['message'] = '请输入您的支付账号';
			$this->ajaxReturn($apiparam); exit;
		}

		$paytypeinfo = M('payset')->where(['paytype'=>$paytype])->find();
		if(!$paytypeinfo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '充值方式不存在';
			$this->ajaxReturn($apiparam); exit;
		}
		if($paytypeinfo['state']!=1){
			$apiparam['sign'] = false;
			$apiparam['message'] = '充值方式维护中，请选择其他方式充值';
			$this->ajaxReturn($apiparam); exit;
		}
		$configs = unserialize($paytypeinfo['configs']);
		unset($paytypeinfo['configs']);
		$paytypeinfo = array_merge($paytypeinfo,$configs);
		$minmoney = $paytypeinfo['minmoney']?$paytypeinfo['minmoney']:10;
		$maxmoney = $paytypeinfo['maxmoney']?$paytypeinfo['maxmoney']:50000;
		if($amount<$minmoney){
			$apiparam['sign'] = false;
			$apiparam['message'] = '最低充值金额为：'.$minmoney.'元';
			$this->ajaxReturn($apiparam); exit;
		}
		if($amount>$maxmoney){
			$apiparam['sign'] = false;
			$apiparam['message'] = '最高充值金额为：'.$maxmoney.'元';
			$this->ajaxReturn($apiparam); exit;
		}
		//创建订单
		$data = [];
		$data['uid']      = $userinfo['id'];
		$data['username'] = $userinfo['username'];
		$data['paytype']  = $paytypeinfo['paytype'];
		$data['paytypetitle']      = $paytypeinfo['paytypetitle'];
		$data['trano'] = gettrano();
		$data['amount'] = $amount;
		$data['fee'] = 0;
		$data['actualamount'] = $amount;
		$data['actualfee'] = 0;
		$data['oldaccountmoney'] = 0;
		$data['newaccountmoney'] = 0;
		$data['isauto'] = 1;
		$data['state'] = 0;
		$data['oddtime'] = time();
		$data['payname'] = $userpayname;
		$intid = M('recharge')->data($data)->add();
		if(!$intid){
			$apiparam['sign'] = false;
			$apiparam['message'] = '充值订单提交失败';
			 $this->ajaxReturn($apiparam) ;exit;
		}
		$data['id'] = $intid;
		
		$apiparam['sign'] = true;
		$apiparam['message'] = '充值订单提交成功';
		$apiparam['data'] = $data;
		//$apiparam['paytypeinfo'] = $paytypeinfo;

        ////
        //支付类型
        $Pay = new PayController();
        if(in_array($data['paytype'],['jftpayysf','jftpaywx','jftpayzfb'])){
           // echo 111;exit;
            $res = $Pay->jftpay($apiparam['data']);
            $apiparam['sign'] = true;
            $apiparam['data'] = $res;

            $this->ajaxReturn($apiparam) ;exit;
        }
        ////////////
		$this->ajaxReturn($apiparam) ;exit;
	}
	
	//第三方订单号更新
	function sendtrano($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$orderid   = intval($apiparam['orderid']);
		$trano     = $apiparam['trano'];
		$threetrano= $apiparam['threetrano'];
		if(!is_numeric($orderid)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '非法订单号';
			return $apiparam;exit;
		}
		$orderinfo = M('recharge')->where(['id'=>$orderid])->find();
		if($orderinfo['trano']!=$trano || $orderinfo['uid']!=$userinfo['id']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '非法操作订单';
			return $apiparam;exit;
		}
		if($orderinfo['threetrano']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '第三方充值订单号无需重复提交';
			return $apiparam;exit;
		}
		

		$intid = M('recharge')->where(['id'=>$orderid])->setField(['threetrano'=>$threetrano]);
		if(!$intid){
			$apiparam['sign'] = false;
			$apiparam['message'] = '第三方充值订单号更新失败';
			return $apiparam;exit;
		}
		$apiparam['sign'] = true;
		$apiparam['message'] = '第三方充值订单号更新成功';
		$orderinfo['threetrano'] = $threetrano;
		$apiparam['data'] = $orderinfo;
		//$apiparam['paytypeinfo'] = $paytypeinfo;
		return $apiparam;
	}
	function isUserWithdrawLimit($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$t = time();
		$starttime = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$endtime = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
		$freetimes = intval(GetVar('tikuannum'));//免费次数
		$opmap = [];
		$opmap['uid'] = ['eq',$userinfo['id']];
		$opmap['state'] = ['in',[1,0]];
		$opmap['oddtime'][] = ['egt',$starttime];
		$opmap['oddtime'][] = ['elt',$endtime];
		$opTimes   = M('withdraw')->where($opmap)->count();
		$opTimes   = $opTimes?$opTimes:0;
		$minfee = GetVar('tikuannumovermin');
		$maxfee = GetVar('tikuannumovermax');
		$minMoney = GetVar('tikuanMin');
		$maxMoney = GetVar('tikuanMax');
		$daymaxMoney = GetVar('ritikuanxiane');
		$starTime = GetVar('tikuanstart');
		$endTime = GetVar('tikuanend');
		$feescale = GetVar('tikuannumoverbilv');
		$xima = $userinfo['xima'];
		$opmap = [];
		$opmap['uid'] = ['eq',$userinfo['id']];
		$opmap['oddtime'][] = ['egt',$starttime];
		$opmap['oddtime'][] = ['elt',$endtime];
		$opmap['state'] = ['in',[0,1]];
		$totaltkamout = M('withdraw')->where($opmap)->sum('amount');
		//$freetimes = $opTimes-$freetimes;
		if($opTimes>=$freetimes){
			$freetimes = 0;
		}else{
			$freetimes = abs($opTimes-$freetimes);
		}
		$return = [
			'balance'    => $userinfo['balance'],
			'opTimes'    => $opTimes,
			'freetimes'  => $freetimes,
			'feescale'   => $feescale,
			'minfee'     => $minfee,
			'maxfee'     => $maxfee,
			'minMoney'   => $minMoney,
			'maxMoney'   => $maxMoney,
			'daymaxMoney'=> $daymaxMoney,
			'starTime'   => $starTime,
			'endTime'    => $endTime,
			'xima'    => $xima,
			'totaltkamout'=> $totaltkamout,
		];
		if($userinfo['userbankname']==''){
			$return['data'] = $return;
			$return['sign'] = false;
			$return['message'] = '为保障您的资金安全请先绑定银行真实姓名';
			return $return;exit;
		}
		//是否有绑定银行卡
		$cardcount = M('banklist')->where(['uid'=>$userinfo['id'],'state'=>1])->count();
		if(!$cardcount || $cardcount<=0){
			$return['data'] = $return;
			$return['sign'] = false;
			$return['message'] = '请先绑定银行卡';
			return $return;exit;
		}
		if(strtotime($starTime)>strtotime($endTime)){
			if(($t > strtotime($starTime) && $t<strtotime(date('Y-m-d 23:23:59',strtotime($starTime)))) || ($t > strtotime(date('Y-m-d 23:23:59',strtotime($starTime)-86400)) && $t<strtotime($endTime))){
				
			}else{
				$return['data'] = $return;
				$return['sign'] = false;
				$return['message'] = "提款时间在{$starTime}~{$endTime}";
				return $apiparam;exit;
			}
		}
/*		if($userinfo['xima']>0){
			$return['data'] = $return;
			$return['sign'] = false;
			$return['message'] = '打码不足，洗码余额为0时可以提款';
			return $return;exit;
		}*/

		$apiparam['sign'] = true;
		$apiparam['message'] = '验证成功';
		$apiparam['data'] = $return;
		return $apiparam;exit;
	}
	function savetikuanorder($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$userinfo = $apiparam["data"];
		unset($apiparam["data"]);
		$bankid        = $apiparam['bankid'];
		$amount        = $apiparam['amount'];
		$tradepassword = $apiparam['tradepassword'];
		if($amount>$userinfo['balance']){
			$apiparam['sign'] = false;
			$apiparam['message'] = '可提款金额错误';
			$this->ajaxReturn($apiparam);exit;
		}
		if(!$bankid || $amount<=0 || !$tradepassword){
			$return =['sign'=>false,'message'=>'提款订单参数不完整'];
			$this->ajaxReturn($return);exit;
		}
		$bankinfo = M('banklist')->where(['id'=>$bankid,'uid'=>$userinfo['id']])->find();
		if(!$bankinfo){
			$return =['sign'=>false,'message'=>'您的提款银行错误'];
			$this->ajaxReturn($return);exit;
		}
		if($bankinfo['state']!=1){
			$return =['sign'=>false,'message'=>'提款银行未审核，请重新选择'];
			$this->ajaxReturn($return);exit;
		}
		if($userinfo['userbankname']==''){
			$return['sign'] = false;
			$return['message'] = '为保障您的资金安全请先绑定银行真实姓名';
			$this->ajaxReturn($return);exit;
		}
		if($userinfo['userbankname']!=$bankinfo['accountname']){
			$return['sign'] = false;
			$return['message'] = '提款银行账户与真实姓名不符';
			$this->ajaxReturn($return);exit;
		}

		$t = time();
		$starttime = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$endtime = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
		$freetimes = intval(GetVar('tikuannum'));//免费次数
		$opmap = [];
		$opmap['uid'] = ['eq',$userinfo['id']];
		$opmap['state'] = ['in',[1,0]];
		$opmap['oddtime'][] = ['egt',$starttime];
		$opmap['oddtime'][] = ['elt',$endtime];
		$opTimes   = M('withdraw')->where($opmap)->count();
		$opTimes   = $opTimes?$opTimes:0;
		$minfee = intval(GetVar('tikuannumovermin'));
		$maxfee = intval(GetVar('tikuannumovermax'));
		$minMoney = GetVar('tikuanMin');
		$maxMoney = GetVar('tikuanMax');
		$daymaxMoney = GetVar('ritikuanxiane');
		$starTime = GetVar('tikuanstart');
		$endTime = GetVar('tikuanend');
		$feescale = GetVar('tikuannumoverbilv');
		$xima = $userinfo['xima'];
		$opmap = [];
		$opmap['uid'] = ['eq',$userinfo['id']];
		$opmap['oddtime'][] = ['egt',$starttime];
		$opmap['oddtime'][] = ['elt',$endtime];
		$opmap['state'] = ['in',[0,1]];
		$totaltkamout = M('withdraw')->where($opmap)->sum('amount');
		//$freetimes = $opTimes-$freetimes;
		$shouxufei = 0;
		if($opTimes>=$freetimes){//收费提款
			$freetimes = 0;
			$shouxufei = $amount * ( $feescale/100 );
			if($shouxufei>$maxfee && $maxfee>0){
				$shouxufei = $maxfee;
			}
			if($shouxufei<$minfee && $minfee>0){
				$shouxufei = $minfee;
			}
		}else{
			$freetimes = abs($opTimes-$freetimes);
		}
		if( $amount<$minMoney || $amount>$maxMoney ){
			$return['sign'] = false;
			$return['message'] = "单次提款金额{$minMoney}~{$maxMoney}";
			$this->ajaxReturn($return);exit;
		}
		$return = [
			'balance'    => $userinfo['balance'],
			'opTimes'    => $opTimes,
			'freetimes'  => $freetimes,
			'feescale'   => $feescale,
			'minfee'     => $minfee,
			'maxfee'     => $maxfee,
			'minMoney'   => $minMoney,
			'maxMoney'   => $maxMoney,
			'daymaxMoney'=> $daymaxMoney,
			'starTime'   => $starTime,
			'endTime'    => $endTime,
			'xima'    => $xima,
			'totaltkamout'=> $totaltkamout,
			'sign'       => true,
			'message'    => '用户消费量已经满足，可以取款',
		];
		if($userinfo['userbankname']==''){
			$apiparam['sign'] = false;
			$apiparam['message'] = '为保障您的资金安全请先绑定银行真实姓名';
			$this->ajaxReturn($apiparam);exit;
		}
		if(strtotime($starTime)>strtotime($endTime)){
			if(($t > strtotime($starTime) && $t<strtotime(date('Y-m-d 23:23:59',strtotime($starTime)))) || ($t > strtotime(date('Y-m-d 23:23:59',strtotime($starTime)-86400)) && $t<strtotime($endTime))){
				
			}else{
				$apiparam['sign'] = false;
				$apiparam['message'] = "提款时间在{$starTime}~{$endTime}";
				$this->ajaxReturn($apiparam);exit;
			}
		}
		if($xima>0){
			$apiparam['sign'] = false;
			$apiparam['message'] = '打码不足，洗码余额为0时可以提款';
			return $apiparam;exit;
		}
		$data = [];
		$trano    = gettrano();
		$data['trano']      = $trano;
		$data['uid']        = $userinfo['id'];
		$data['username']   = $userinfo['username'];
		$data['amount']     = $amount;
		$data['fee']        = $shouxufei;
		$data['actualamount']= $amount-$shouxufei;
		$data['oddtime']    = $t;
		$data['state']      = 0;
		$oldaccountmoney = $userinfo['balance'];
		$newaccountmoney = $oldaccountmoney - $amount;
		$data['oldaccountmoney']      = $oldaccountmoney;
		$data['newaccountmoney']      = $newaccountmoney;
		$data['accountname']          = $bankinfo['accountname'];
		$data['bankname']             = $bankinfo['bankname'];
		$data['bankbranch']           = $bankinfo['bankbranch'];
		$data['banknumber']           = $bankinfo['banknumber'];
		
		
		$_int = M('withdraw')->data($data)->add();

		if($_int){
			$amountbefor = $userinfo['balance'];
			$member = M('member');
			$member->where(['id'=>$userinfo['id']])->setDec('balance',$amount);
//			M('member')->where("id=".$this->userinfo['id'])->setDec('point',$amount);
/* 			$user = $member->field('point')->where('id='.$this->userinfo['id'])->find();
			if($user['point'] <= abs($amount)){
				$point = 0;
			}else{
				$point = ($user['point']-$amount);
			}
			$member->where('id='.$this->userinfo['id'])->setField('point',$point);
			changeusergroup($this->userinfo['id']); */
			//添加会员账户明细
			$fuddetaildata = [];
			$fuddetaildata['trano']      = $trano;
			$fuddetaildata['uid']      = $userinfo['id'];
			$fuddetaildata['username'] = $userinfo['username'];
			$fuddetaildata['type']     = 'withdraw';
			$fuddetaildata['typename']     = '提款';
			$fuddetaildata['remark']        = 'PC端 提款';
			$fuddetaildata['oddtime']       = NOW_TIME;
			$fuddetaildata['amount']        = $amount;
			$fuddetaildata['amountbefor']   = $amountbefor;
			$fuddetaildata['amountafter']   = $amountbefor - $amount;
			M('fuddetail')->data($fuddetaildata)->add();

			//添加到會員日誌
			$logdata = [];
			$logdata['uid']      = $this->userinfo['id'];
			$logdata['username'] = $this->userinfo['username'];
			$logdata['type']     = 'withdraw';
			$logdata['info']     = 'PC端 提款操作，金额:'.$amount.',提款单号:'.$trano;
			$logdata['ip']       = get_client_ip();
			$logdata['iparea']   = IParea(get_client_ip());
			$logdata['time']     = $t;
			M('memberlog')->data($logdata)->add();

			$message = "提款成功";
			
			//显示排队人数
			$paiduinum = intval(GetVar('paiduinum')) + M('withdraw')->where(['state'=>0])->count();
			if($paiduinum>0){
				$message = $apiparam['message'] . ',当前排队人数：'.$paiduinum;
			}
			$apiparam['sign'] = true;
			$apiparam['message'] = $message;
			$apiparam['data'] = $fuddetaildata;
			$this->ajaxReturn($apiparam);exit;
		}else{
			$apiparam = [];
			$apiparam['sign'] = false;
			$apiparam['message'] = '提款失败';
			$this->ajaxReturn($apiparam);exit;
		}

	}
}