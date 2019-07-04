<?php
namespace Admincenter\Controller;
use Think\Controller;
use Think\Exception;

class MemberController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->_db = D('Member');
		$this->_pk = $this->_db->getPk();
	}

	function memlog(){
		$username = I('username');
		$loginip = I('loginip');

		$map        = [];
		if($username){
			$map['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($loginip){
			$map['ip']    = ['eq',$loginip];
			$this->assign('loginip',$loginip);
		}
		if($_REQUEST['sDate']){
			$map['time'][]    = ['egt',strtotime($_REQUEST['sDate'])];
			$this->assign('_sDate',urldecode($_REQUEST['sDate']));
		}
		if($_REQUEST['eDate']){
			$map['time'][]    = ['elt',strtotime($_REQUEST['eDate'])+86400];
			$this->assign('_eDate',urldecode($_REQUEST['eDate']));
		}
		$this->_db  = M('memberlog');
		$_pagasize  = 10;
		$count      = $this->_db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = $this->_db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->assign('totalcount',$count);
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	function memlogdelete(){
		$this->_db = M('memberlog');
		parent::_deletealldo();
	}

	function manage(){
		$groupid = I('groupid');
		$proxy = I('proxy',999);
		$isnb = I('isnb',999);
		$username = I('username');
		$nickname = I('nickname');
		$userbankname = I('userbankname');
		$loginip = I('loginip');
		$qq = I('qq');
		$parentid = I('parentid');
		$isonline = I('isonline');
		$tonline = 30;

		$map        = [];
		$_t = time();
		if($isonline){
			$map['onlinetime']    = ['EGT',$_t-$tonline];
			$this->assign('isonline',$isonline);
		}
		if($userbankname){
			$map['userbankname']    = ['eq',$userbankname];
			$this->assign('userbankname',$userbankname);
		}
		if($proxy!=999){
			$map['proxy']    = ['eq',$proxy];
		}
		$this->assign('proxy',$proxy);
		if($isnb!=999){
			$map['isnb']    = ['eq',$isnb];
		}
		$this->assign('isnb',$isnb);
		if($qq){
			$map['qq']    = ['eq',$qq];
			$this->assign('qq',$qq);
		}
		if($parentid){
			$map['parentid']    = ['eq',$parentid];
			$this->assign('parentid',$parentid);
		}
		if($groupid){
			$map['groupid']    = ['eq',$groupid];
			$this->assign('groupid',$groupid);
		}
		if($username){
			$map['username']    = ['like',"%".$username."%"];
			$this->assign('username',urldecode($username));
		}
		if($nickname){
			$map['nickname']    = ['eq',$nickname];
			$this->assign('nickname',$nickname);
		}
		if($loginip){
			$map['loginip']    = ['eq',$loginip];
			$this->assign('loginip',$loginip);
		}
		if($_REQUEST['sDate']){
			$map['regtime'][]    = ['egt',strtotime($_REQUEST['sDate'])];
			$this->assign('_sDate',urldecode($_REQUEST['sDate']));
		}
		if($_REQUEST['eDate']){
			$map['regtime'][]    = ['elt',strtotime($_REQUEST['eDate'])+86400];
			$this->assign('_eDate',urldecode($_REQUEST['eDate']));
		}
		if($_REQUEST['sAmount']){
			$map['balance'][]    = ['egt',$_REQUEST['sAmount']];
			$this->assign('_sAmount',$_REQUEST['sAmount']);
		}
		if($_REQUEST['eAmount']){
			$map['balance'][]    = ['elt',$_REQUEST['eAmount']];
			$this->assign('_eAmount',$_REQUEST['eAmount']);
		}
		//排序
		$ordertype = I('ordertype');
		switch($ordertype){
			case"1":
				$order = "regtime asc";break;
			case"2":
				$order = "fandian desc";break;
			case"3":
				$order = "fandian asc";break;
			case"4":
				$order = "balance desc";break;
			case"5":
				$order = "balance asc";break;
			case"6":
				$order = "point desc";break;
			case"7":
				$order = "point asc";break;
			case"8":
				$order = "xima desc";break;
			case"9":
				$order = "xima asc";break;
			case"16":
				$order = "logintime desc";break;
			case"17":
				$order = "logintime asc";break;
			case"18":
				$order = "onlinetime desc";break;
			case"19":
				$order = "onlinetime asc";break;
			default:
				$order = "id desc";
		}
		$this->ordertype = $ordertype;
		$_pagasize  = 10;
		$count      = $this->_db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = $this->_db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order($order)->select();
		foreach($list as $k=>$v){
			$v['shangji'] = $this->_db->where(['id'=>$v['parentid']])->getField('username');
			if($_t-$v['onlinetime']<$tonline){
				$v['isonline'] = 1;
			}else{
				$v['isonline'] = 0;
			}
			$list[$k] = $v;
		}
		$_grouplist = M('membergroup')->select();
		foreach($_grouplist as $gk=>$gv){
			$grouplist[$gv['groupid']] = $gv;
		}
		$this->assign('grouplist',$grouplist);
		$this->assign('totalcount',$count);
		$this->assign('list',$list);
		$this->assign('page',$show);

		$this->display();
	}
	function rechargedelall(){
		parent::_rechargedelall();

	}
	function withdrawdelall(){
		parent::_withdrawdelall();

	}
	function useradd(){
		$_grouplist = M('membergroup')->select();
		foreach($_grouplist as $gk=>$gv){
			$grouplist[$gv['groupid']] = $gv;
		}
		$this->assign('grouplist',$grouplist);
		if(IS_POST){
			if($_POST['groupid']==0 && $_POST['proxy'] ==1)$_POST['groupid']=10;
			if($_POST['groupid']==0 && $_POST['proxy'] ==0)$_POST['groupid']=1;
			$username = I('username');
			$proxy = I('proxy');
			$isnb = I('isnb');
			$password = I('password');
			$tradepassword = I('tradepassword');
			//$fandian = I('fandian');
			if(!in_array($isnb,[0,1])){
				$this->error('会员类型必须！');
			}
			if(!$username){
				$this->error('用户名必须！');
			}
			$_paten = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
			if(!$username || preg_match($_paten,$username)){
				$this->error('用户名为4-12字母与数字组或中文的字符!');
			}
			/*if($fandian>13.5){
				$this->error('彩票最高返点不超过13%！');
			}*/
			if(strlen($password)<6 || strlen($password)>16){
				$this->error('密码6~16位字符！');
			}else{
				$_POST['password'] = sys_md5($password);
			}
			if(strlen($tradepassword)<6 || strlen($tradepassword)>16){
				$this->error('资金密码6~16位字符！');
			}else{
				$_POST['tradepassword'] = sys_md5($tradepassword);
			}
			if(!in_array($isnb,[0,1])){
				$this->error('是否内部帐号必须！');
			}
			if($username && $payinfo = $this->_db->where(['username'=>$username])->find()){
				$this->error('用户名已经存在！');
			}
            $_POST['nickname'] ='';
			$_POST['regtime'] = time();
			$_POST['face'] = "/resources/images/face/".rand(1,25).".jpg";
            $username = 'usr_name_'.$username;
            $md5_user_name = strtolower(substr(md5($username),0,9));
            $_POST['live_game_name'] = $md5_user_name;

			parent::_adddosimp();
		}
		$this->display();
	}
	function useredit(){
		$_grouplist = M('membergroup')->select();
		foreach($_grouplist as $gk=>$gv){
			$grouplist[$gv['groupid']] = $gv;
		}
		$this->assign('grouplist',$grouplist);
		$id = I('id');
		$info = $this->_db->where([$this->_pk=>$id])->find();
		if(!$info){
			$this->error('您修改的数据不存在！');
		}else{
			$this->assign('info',$info);
		}
		if(IS_POST){
			if($_POST['groupid']==0){
				$this->error('请选择会员组');
			}
			if($_POST['proxy']==1 && $_POST['groupid']!=10){
				$this->error('会员类型不是代理');
			}
			if( $_POST['groupid']==10 && $_POST['proxy']<>1){
				$this->error('会员类型不是会员');
			}
			$username = I('username');
			$proxy = I('proxy');
			$isnb  = I('isnb');
			$password = I('password');
			$tradepassword = I('tradepassword');
			$userbankname  = I('userbankname');
			//$fandian = I('fandian');
			if(!in_array($proxy,[0,1])){
				$this->error('会员类型必须！');
			}
			if(!$username){
				$this->error('用户名必须！');
			}
			/*if($fandian>13.5){
				$this->error('彩票最高返点不超过13%！');
			}*/

			if($password && (strlen($password)<6 || strlen($password)>16)){
				$this->error('密码6~16位字符！');
			}
			if($tradepassword && (strlen($tradepassword)<6 || strlen($tradepassword)>16)){
				$this->error('资金密码6~16位字符！');
			}
			if($password==''){
				unset($_POST['password']);
			}else{
				$_POST['password'] = sys_md5($password);
			}
			if($tradepassword==''){
				unset($_POST['tradepassword']);
			}else{
				$_POST['tradepassword'] = sys_md5($tradepassword);
			}
			if(!in_array($isnb,[0,1])){
				$this->error('是否内部帐号必须！');
			}
			if($username && $payinfo = $this->_db->where("username='{$username}' and id!={$id}")->find()){
				$this->error('用户名已经存在！');
			}
			parent::_editdosimp();
		}
		$this->display('useredit');
	}
	function userdelete(){
		$admininfo = $this->admininfo;
		if($admininfo['groupid']!=1){
			//echo'只有超级管理员可以添加';exit;
		}
		//$this->error('为防止恶意操作，该功能已禁止！');exit;
		$id     = I('id');
		if(!$id)$this->error('非法操作！');
		$info = $this->_db->find($id);
		$_pk = $this->_db->getPk();
		if(!$info)$this->error('您操作的数据不存在或已删除！');
		$int = $this->_db->where([$_pk=>$id])->delete();
		//$int?$this->success('操作成功！'):$this->error('操作失败！');
		if($int){
			//管理操作日志
			$logdata = [];
			$logdata['userid']   = $this->admininfo['id'];
			$logdata['username'] = $this->admininfo['username'];
			$logdata['type']     = 'clear';
			$logdata['info']     = "删除会员ID：".$id;
			$logdata['time']     = NOW_TIME;
			$logdata['ip']       = get_client_ip();
			$iparea = IParea(get_client_ip());
			$logdata['iparea']   = $iparea;
			M('adminlog')->data($logdata)->add();
			$this->success('操作成功！');
		}else{
			$this->error('操作失败！');
		}
		parent::_deletedosimp();
	}
	function deleteall(){
		$admininfo = $this->admininfo;
		if($admininfo['groupid']!=1){
			//echo'只有超级管理员可以操作';exit;
		}
		//$this->error('为防止恶意操作，该功能已禁止！');exit;
		self::_deletealldo();
	}
	function unline(){
		$id  = I('id');
		$int = M('membersession')->where(['userid'=>$id])->delete();
		$int?$this->success():$this->error();
	}
	function lock(){
		$id  = I('id');
		$info = M('member')->where(['id'=>$id])->find();
		if(!$id || !$info){
			$this->error('操作账号不存在');
		}
		if($info['islock']==1){
			$islock = 0;
		}else{
			$islock = 1;
		}
		$int = M('member')->where(['id'=>$id])->setField(['islock'=>$islock]);
		$int?$this->success():$this->error();
	}
	function rebate(){
		$id = I('id');
		if(!$id){
			$this->error('非法参数');
		}
		$info = $this->_db->where(['id'=>$id])->find();
		if(!$info){
			$this->error('未找到该会员');
		}
		$this->assign('info',$info);
		if(IS_POST){
			$fandian = I('fandian');
			if(!is_numeric($fandian)){
				$this->error('返点必须是数字');
			}
			if($fandian>13.5 || $fandian<6.5){
				$this->error('彩票返点6.5~13.5%之间');
			}
			$_int = M('member')->where(['id'=>$id])->setField(['fandian'=>$fandian]);
			//管理操作日志
			$logdata = [];
			$logdata['userid']   = $this->admininfo['id'];
			$logdata['username'] = $this->admininfo['username'];
			$logdata['type']     = 'rebate';
			$logdata['info']     = "调整返点,彩票{$info['fandian']}->{$fandian},会员：".$info['username'];
			$logdata['time']     = NOW_TIME;
			$logdata['ip']       = get_client_ip();
			$iparea = IParea(get_client_ip());
			$logdata['iparea']   = $iparea;
			M('adminlog')->data($logdata)->add();
			$_int?$this->success("返点修改成功"):$this->error('返点修改失败');
			exit;
		}
		$this->display();
	}
	function balance(){
		$id = I('id');
		if(!$id){
			$this->error('非法参数');
		}
		$info = $this->_db->where(['id'=>$id])->find();
		if(!$info){
			$this->error('未找到该会员');
		}
		$this->assign('info',$info);
		if(IS_POST){
			$balance = I('balance',0,'floatval');
			$type    = I('type');
			$remark    = I('remark');
			if($type!=1 && $type!=-1 && $type!=-2){
				$this->error('金额类型错误');
			}
			if($type==1){
				if(floatval($balance)<=0){
					$this->error('金额应大于0');
				}
				$oldbalance = $this->_db->where(['id'=>$id])->getField('balance');
				$_int = $this->_db->where(['id'=>$id])->setInc('balance',abs($balance));
				$this->_db->where(['id'=>$id])->setInc('point',abs($balance));
				//$this->_db->where(['id'=>$id])->setInc('xima',abs($balance));
				$newbalance = $oldbalance+abs($balance);
				$pointchongzhi    = abs(GetVar('pointchongzhi'));
				$pointchongzhiadd = abs(GetVar('pointchongzhiadd'));
				$_addpoint = number_format(abs($balance)*($pointchongzhiadd/$pointchongzhi),2,".","");
				//更改会员组
				changeusergroup($id);
				//创建充值订单记录
				$trano= gettrano(4);
				$rechargedata = [];
				$rechargedata['trano']      = $trano;
				$rechargedata['uid'] = $info['id'];
				$rechargedata['username'] = $info['username'];
				$rechargedata['amount'] = abs($balance);
				$rechargedata['oddtime']    = time();
				$rechargedata['isauto']    = 2;
				$rechargedata['state']    = 1;
				$rechargedata['stateadmin']    = $this->admininfo['username'];
				$rechargedata['remark']    = $remark?:'手动充值增加';
				$rechargedata['sdtype']    = 1;
				$rechargedata['oldaccountmoney']    = $oldbalance;
				$rechargedata['newaccountmoney']    = $newbalance;
				$intid = M('recharge')->data($rechargedata)->add();
				$rechargedata['id'] = $intid;

				//洗码账户
				if(abs(GetVar('damaliang'))){
					$xima = ((abs(GetVar('damaliang'))/100) * abs($balance));
					$xima = number_format($xima,2,".","");
					M('member')->where(['id'=>$info['id']])->setInc('xima',$xima);
					$fuddetaildata = [];
					$fuddetaildata['trano'] = $trano;
					$fuddetaildata['uid'] = $info['id'];
					$fuddetaildata['username'] = $info['username'];
					$fuddetaildata['type'] = 'xima';
					$fuddetaildata['typename'] = C('fuddetailtypes.xima');
					$fuddetaildata['amount'] = $xima;
					$fuddetaildata['amountbefor'] = $info['xima'];
					$fuddetaildata['amountafter'] = $info['xima']+$xima;
					$fuddetaildata['remark'] = '账户充值增加洗码额度';
					$fuddetaildata['oddtime'] = time();
					M('fuddetail')->data($fuddetaildata)->add();
				}
				//创建账变日志
				$fuddetaildata = [];
				$fuddetaildata['trano'] = $trano;
				$fuddetaildata['uid'] = $info['id'];
				$fuddetaildata['username'] = $info['username'];
				$fuddetaildata['type'] = 'activity_cz';
				$fuddetaildata['typename'] = C('fuddetailtypes.activity_cz');
				$fuddetaildata['amount'] = abs($balance);
				$fuddetaildata['amountbefor'] = $oldbalance;
				$fuddetaildata['amountafter'] = $oldbalance + abs($balance);
				$fuddetaildata['remark'] = '手动充值增加';
				$fuddetaildata['oddtime'] = time();
				M('fuddetail')->data($fuddetaildata)->add();

				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'rechargstate';
				$logdata['info']     = "手动充值增加金额，订单号".$info['trano'].",会员：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				M('adminlog')->data($logdata)->add();
				$this->success('ok充值成功ok');exit;

			}elseif($type==-1){
				if(floatval($balance)<=0){
					$this->error('金额应大于0');
				}

				$oldbalance = $this->_db->where(['id'=>$info['id']])->getField('balance');
				$_int = $this->_db->where(['id'=>$info['id']])->setDec('balance',abs($balance));
				//$this->_db->where(['id'=>$info['id']])->setDec('xima',abs($balance));
				$newbalance = $oldbalance-abs($balance);

				$pointchongzhi    = abs(GetVar('pointchongzhi'));
				$pointchongzhiadd = abs(GetVar('pointchongzhiadd'));
				$_addpoint = number_format(abs($balance)*$pointchongzhiadd/$pointchongzhi,4,".","");
				//$this->_db->where(['id'=>$info['id']])->setDec('point',$_addpoint);\
				//更改会员组
				if($_int){
					$user = $this->_db->field('point')->where(['id'=>$id])->find();
					if($user['point'] <= abs($balance)){
						$point = 0;
					}else{
						$point = ($user['point']-$balance);
					}
					$this->_db->where(['id'=>$id])->setField('point',$point);
					changeusergroup($id);
				}
				//创建充值订单记录
				$trano= gettrano(4);
				$rechargedata = [];
				$rechargedata['trano']      = $trano;
				$rechargedata['uid'] = $info['id'];
				$rechargedata['username'] = $info['username'];
				$rechargedata['amount'] = abs($balance);
				$rechargedata['oddtime']    = time();
				$rechargedata['isauto']    = 2;
				$rechargedata['state']    = 1;
				$rechargedata['stateadmin']    = $this->admininfo['username'];
				$rechargedata['remark']    = $remark?:'手动充值减少';
				$rechargedata['sdtype']    = -1;
				$rechargedata['oldaccountmoney']    = $oldbalance;
				$rechargedata['newaccountmoney']    = $newbalance;
				$intid = M('recharge')->data($rechargedata)->add();


				//创建账变日志
				$fuddetaildata = [];
				$fuddetaildata['trano'] = $trano;
				$fuddetaildata['uid'] = $info['id'];
				$fuddetaildata['username'] = $info['username'];
				$fuddetaildata['type'] = 'activity_cz';
				$fuddetaildata['typename'] = C('fuddetailtypes.activity_cz');
				$fuddetaildata['amount'] = abs($balance);
				$fuddetaildata['amountbefor'] = $oldbalance;
				$fuddetaildata['amountafter'] = $oldbalance - abs($balance);
				$fuddetaildata['remark'] = '手动充值减少';
				$fuddetaildata['oddtime'] = time();
				M('fuddetail')->data($fuddetaildata)->add();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'rechargstate';
				$logdata['info']     = "手动充值减少金额，订单号".$info['trano'].",会员：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				M('adminlog')->data($logdata)->add();


			}elseif($type==-2){
				$balance = floatval($balance);
				if($balance==0){
					$this->error('赠送金额不能为0');
				}
				$fuddetailtypes = C('fuddetailtypes');
				$zengsongtype = I('zengsongtype');
				if(!$fuddetailtypes[$zengsongtype]){
					$this->error('赠送类型错误');
				}
				if($balance>0){
					$oldbalance = $this->_db->where(['id'=>$id])->getField('balance');
					$_int = 0;
					$_int = $this->_db->where(['id'=>$id])->setInc('balance',abs($balance));
					//$this->_db->where(['id'=>$id])->setInc('xima',abs($balance));
					$newbalance = $oldbalance+abs($balance);

					$trano= gettrano(4);

					//创建账变日志
					$fuddetaildata = [];
					$fuddetaildata['trano'] = gettrano(4);
					$fuddetaildata['uid'] = $info['id'];
					$fuddetaildata['username'] = $info['username'];
					$fuddetaildata['type'] = $zengsongtype;
					$fuddetaildata['typename'] = $fuddetailtypes[$zengsongtype];
					$fuddetaildata['amount'] = abs($balance);
					$fuddetaildata['amountbefor'] = $oldbalance;
					$fuddetaildata['amountafter'] = $oldbalance + abs($balance);
					$fuddetaildata['remark'] = $remark?:'后台操作';
					$fuddetaildata['oddtime'] = time();
					if($_int)M('fuddetail')->data($fuddetaildata)->add();

					//管理操作日志
					$logdata = [];
					$logdata['userid']   = $this->admininfo['id'];
					$logdata['username'] = $this->admininfo['username'];
					$logdata['type']     = $zengsongtype;
					$logdata['info']     = "后台赠送，订单号".$trano.",会员：".$info['username'];
					$logdata['time']     = NOW_TIME;
					$logdata['ip']       = get_client_ip();
					$iparea = IParea(get_client_ip());
					$logdata['iparea']   = $iparea;
					if($_int)M('adminlog')->data($logdata)->add();
					$this->success('赠送成功');exit;
				}elseif($balance<0){
					$oldbalance = $this->_db->where(['id'=>$id])->getField('balance');
					$_int = 0;
					$_int = $this->_db->where(['id'=>$id])->setDec('balance',abs($balance));
					//$this->_db->where(['id'=>$id])->setInc('xima',abs($balance));
					$newbalance = $oldbalance - abs($balance);

					$trano= gettrano(4);

					//创建账变日志
					$fuddetaildata = [];
					$fuddetaildata['trano'] = gettrano(4);
					$fuddetaildata['uid'] = $info['id'];
					$fuddetaildata['username'] = $info['username'];
					$fuddetaildata['type'] = $zengsongtype;
					$fuddetaildata['typename'] = $fuddetailtypes[$zengsongtype];
					$fuddetaildata['amount'] = -abs($balance);
					$fuddetaildata['amountbefor'] = $oldbalance;
					$fuddetaildata['amountafter'] = $oldbalance - abs($balance);
					$fuddetaildata['remark'] = $remark?:'后台操作';
					$fuddetaildata['oddtime'] = time();
					if($_int)M('fuddetail')->data($fuddetaildata)->add();

					//管理操作日志
					$logdata = [];
					$logdata['userid']   = $this->admininfo['id'];
					$logdata['username'] = $this->admininfo['username'];
					$logdata['type']     = $zengsongtype;
					$logdata['info']     = "后台赠送，订单号".$trano.",会员：".$info['username'];
					$logdata['time']     = NOW_TIME;
					$logdata['ip']       = get_client_ip();
					$iparea = IParea(get_client_ip());
					$logdata['iparea']   = $iparea;
					if($_int)M('adminlog')->data($logdata)->add();
					$this->success('赠送成功');exit;
				}

			}
			$_int?$this->success("金额修改成功"):$this->error('金额修改失败');
			exit;
		}
		$this->display();
	}
	function point(){
		$id = I('id');
		if(!$id){
			$this->error('非法参数');
		}
		$info = $this->_db->where(['id'=>$id])->find();
		if(!$info){
			$this->error('未找到该会员');
		}
		$this->assign('info',$info);
		if(IS_POST){
			$point = I('point',0,'intval');
			$type    = I('type');
			if(!preg_match("/^[1-9][0-9]*$/",$point) || $point<=0){
				$this->error('积分错误');
			}
			if($type!=1 && $type!=-1){
				$this->error('积分类型错误');
			}
			if($type==1){
				$_int = $this->_db->where(['id'=>$id])->setInc('point',abs($point));
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'dividend';
				$logdata['info']     = "手动增加积分：".abs($point).",会员：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				M('adminlog')->data($logdata)->add();
			}elseif($type==-1){
				$_int = $this->_db->where(['id'=>$id])->setDec('point',abs($point));
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'dividend';
				$logdata['info']     = "手动减少积分：".-abs($point).",会员：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				M('adminlog')->data($logdata)->add();
			}
 		    changeusergroup($id);
			$_int?$this->success("积分修改成功"):$this->error('积分修改失败');
			exit;
		}
		$this->display();
	}
	function xima(){
		$id = I('id');
		if(!$id){
			$this->error('非法参数');
		}
		$info = $this->_db->where(['id'=>$id])->find();
		if(!$info){
			$this->error('未找到该会员');
		}
		$this->assign('info',$info);
		if(IS_POST){
			$xima = I('xima',0,'intval');
			$type    = I('type');
			if(!preg_match("/^[1-9][0-9]*$/",$xima) || $xima<=0){
				$this->error('洗码余额错误');
			}
			if($type!=1 && $type!=-1){
				$this->error('洗码余额类型错误');
			}
			if($type==1){
				$_int = $this->_db->where(['id'=>$id])->setInc('xima',abs($xima));
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'damayue';
				$logdata['info']     = "手动增加洗码余额：".abs($xima).",会员：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				M('adminlog')->data($logdata)->add();
			}elseif($type==-1){
				$_int = $this->_db->where(['id'=>$id])->setDec('xima',abs($xima));
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'damayue';
				$logdata['info']     = "手动减少洗码余额：".abs($xima).",会员：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				M('adminlog')->data($logdata)->add();
			}
			$_int?$this->success("洗码余额修改成功"):$this->error('洗码余额修改失败');
			exit;
		}
		$this->display();
	}
	function ziliao(){
		$id = I('id');
		if(!$id){
			$this->error('非法参数');
		}
		$info = $this->_db->where(['id'=>$id])->find();
		if(!$info){
			$this->error('未找到该会员');
		}
		$this->assign('info',$info);

		$this->display();
	}
	function fuddetail(){
		$type = I('type');
		$uid = I('uid');
		$trano = I('trano');
		$username = I('username');

		$db = M('fuddetail');
		$_pagasize  = 10;
		$map        = [];
		if($type){
			$map['type']    = ['eq',$type];
			$this->assign('type',$type);
		}
		if($trano){
			$map['trano']    = ['eq',$trano];
			$this->assign('trano',$trano);
		}
		if($uid){
			$map['uid']    = ['eq',$uid];
			$this->assign('uid',$uid);
		}
		if($username){
			$map['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($_REQUEST['sDate']){
			$map['oddtime'][]    = ['egt',strtotime($_REQUEST['sDate'])];
			$this->assign('_sDate',urldecode($_REQUEST['sDate']));
		}
		if($_REQUEST['eDate']){
			$map['oddtime'][]    = ['elt',strtotime($_REQUEST['eDate'])+86400];
			$this->assign('_eDate',urldecode($_REQUEST['eDate']));
		}
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();

		$this->assign('totalcount',$count);
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	function banklist(){
		$username = I('username');
		$accountname = I('accountname');
		$state    = I('state');
		$db = M('banklist');
		$_pagasize  = 10;
		$map        = [];
		if($username){
			$map['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($accountname){
			$map['accountname']    = ['eq',$accountname];
			$this->assign('accountname',$accountname);
		}
		if($state!=''){
			$map['state']    = ['eq',$state];
			$this->assign('state',$state);
		}
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();

		$this->assign('totalcount',$count);
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	function bankedit(){
		$id = I('id');
		$info = M('banklist')->where(['id'=>$id])->find();
		if(!$id || !$info){
			$this->error('银行信息不存在');
		}
		$_bankaddress = explode('-',$info['bankaddress']);
		$info['sheng'] = $_bankaddress[0];
		$info['city'] = $_bankaddress[1];
		$this->assign('info',$info);
		if(IS_POST){
			$data['bankname'] = I('bankname');
			$data['bankbranch'] = I('bankbranch');
			$data['banknumber'] = I('banknumber');
			$data['isdefault'] = I('isdefault');
			$data['state'] = I('state');
			$sheng = I('sheng');
			$city = I('city');
			if(!$data['bankname'] || !$data['bankbranch'] || !$data['banknumber'] || !$sheng || !$city){
				$this->error('银行信息请填写完整');
			}
			$bindcardamount = abs(trim(GetVar('bindcardamount')));
			if($data['state']==1 && $bindcardamount>0){
				$cardcount = M('banklist')->where(['uid'=>$info['uid'],'state'=>1])->count();
				if(!$cardcount){
					$balance = $bindcardamount;
					$amountbefor = M('member')->where(['id'=>$info['uid']])->getField('balance');
					M('member')->where(['id'=>$info['uid']])->setInc('balance',$balance);
					$fuddetaildata = [];
					$fuddetaildata['trano'] = gettrano(4);
					$fuddetaildata['uid'] = $info['uid'];
					$fuddetaildata['username'] = $info['username'];
					$fuddetaildata['type'] = 'activity_bindcard';
					$fuddetaildata['typename'] = C('fuddetailtypes.activity_bindcard');
					$fuddetaildata['amount'] = abs($balance);
					$fuddetaildata['amountbefor'] = $amountbefor;
					$fuddetaildata['amountafter'] = $amountbefor + abs($balance);
					$fuddetaildata['remark'] = '绑定银行赠送';
					$fuddetaildata['oddtime'] = time();
					M('fuddetail')->data($fuddetaildata)->add();
				}
			}
			$data['bankaddress'] = $sheng.'-'.$city;
			$_int = M('banklist')->where(['id'=>$id])->setField($data);
			$_int?$this->success("银行信息修改成功"):$this->error('银行信息修改失败');
			exit;
		}
		$this->display();
	}
	function bankdelete(){
		$id = I('id');
		$info = M('banklist')->where(['id'=>$id])->find();
		if(!$id || !$info){
			$this->error('银行信息不存在');
		}
		$_int = M('banklist')->where(['id'=>$id])->delete();
		$_int?$this->success("银行信息删除成功"):$this->error('银行信息删除失败');
		exit;
	}
	function payset(){
		$this->_db = D('Payset');
		$this->_pk = $this->_db->getPk();
		parent::_manage();
		$this->display();
	}
	function paysetadd(){
		$this->_db = D('Payset');
		$this->_pk = $this->_db->getPk();
		if(IS_POST){
			$paytype = I('paytype');
			if($paytype && $payinfo = $this->_db->where(['paytype'=>$paytype])->find()){
				$this->error('支付标识已经存在！');
			}
			$configs_o = $_POST['configs'];
			unset($_POST['configs']);
			$_POST['configs'] = serialize($configs_o);
			parent::_adddosimp();
		}
		$this->display();
	}
	function paysetedit(){
		$this->_db = D('Payset');
		$id = I('id');
		$info = $this->_db->where([$this->_pk=>$id])->find();
		$configs = unserialize($info['configs']);
		$this->assign('configs',$configs);
		if(!$info){
			$this->error('您修改的数据不存在！');
		}else{
			$this->assign('info',$info);
		}
		if(IS_POST){
			$paytype = I('paytype');
			if($paytype!=$info['paytype']){
				$this->error('支付标识不可修改否则无法支付到账！');exit;
			}
			if($paytype && $payinfo = $this->_db->where("paytype='{$paytype}' and id!={$id}")->find()){
				$this->error('支付标识已经存在！');
			}
			$configs_o = $_POST['configs'];
			unset($_POST['configs']);
			$_POST['configs'] = serialize($configs_o);
			parent::_editdosimp();
		}
		$this->display('paysetadd');
	}

	function paysetstatus(){
		$this->_db = D('Payset');
		$this->_pk = $this->_db->getPk();
		$name   = I('name');
		if($name!='state')$this->error('非法操作！');
		parent::_setstatus();
	}
	function paysetdelete(){
		$this->_db = D('Payset');
		$this->_pk = $this->_db->getPk();
		parent::_deletedosimp();
	}
	function paysetlistorder(){
		$this->_db = D('Payset');
		$this->_pk = $this->_db->getPk();
		parent::_listorder();
	}
//会员反水
	function fanshui()
	{
		$db = M('fanshui');
		$_pagasize  = 10;
		$map        = [];
		if(I('username')) $map['username'] = I('username');
		if(I('shenhe')!='') $map['shenhe'] = I('shenhe');
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$fanshui      = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
		$this->assign('fanshui',$fanshui);
		$this->assign('totalcount',$count);
		$this->assign('page',$show);
		$this->display();
	}
	function fanshuidelete()
	{
		$this->_db = D('fanshui');
		$this->_pk = $this->_db->getPk();
		parent::_deletedosimp();
	}

//反水审核
	function fanshuishenhe()
	{
		$this->_db = M('fanshui');
		$id = I('id');
		if(!$id){
			$this->error('非法参数');
		}
		$info = $this->_db->where(['id'=>$id])->find();
		if(!$info){
			$this->error('未找到该反水订单');
		}
		$this->assign('info',$info);
		if(IS_POST){
			$shenhe     = I('shenhe');
			$remark    = I('remark');
			if(!in_array($shenhe,[0,1,-1])){
				$this->error('非法操作');
			}
			if($info['shenhe']!=0){
				$this->error('状态不允许修改');
			}
			//dump($info);exit;
			$_int = $this->_db->where(['id'=>$id])->setField(['shenhe'=>$shenhe]);

			if($_int){
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'fanshui';
				$logdata['info']     = "反水审核,会员：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				switch($shenhe){
					case"1":
						$logdata['info']     = "反水审核-通过,会员：".$info['username'];
						$amountbefor = M('Member')->where("id='{$info['uid']}'")->getField('balance');
						M('member')->where("id='{$info['uid']}'")->setInc('balance',$info['amount']);
						//添加会员账户明细
						$fuddetaildata = [];
						$fuddetaildata['trano']      = $info['trano'];
						$fuddetaildata['uid']      = $info['uid'];
						$fuddetaildata['username'] = $info['username'];
						$fuddetaildata['type']     = 'fanshui';
						$fuddetaildata['typename']     = '反水审核通过';
						$fuddetaildata['remark']       = $remark?$remark:'反水审核通过';
						$fuddetaildata['oddtime']     = NOW_TIME;
						$fuddetaildata['amount']   = $info['amount'];
						$fuddetaildata['amountbefor']   = $amountbefor;
						$fuddetaildata['amountafter']   = $amountbefor + $info['amount'];
						M('fuddetail')->data($fuddetaildata)->add();
						break;
					case"-1":
						$logdata['info']     = "反水审核未通过,会员：".$info['username'];
						$amountbefor = M('member')->where("id='{$info['uid']}'")->getField('balance');
						//添加会员账户明细
						$fuddetaildata = [];
						$fuddetaildata['trano']    = $info['trano'];
						$fuddetaildata['uid']      = $info['uid'];
						$fuddetaildata['username'] = $info['username'];
						$fuddetaildata['type']     = 'fanshui';
						$fuddetaildata['typename']     = '反水审核未通过';
						$fuddetaildata['remark']       = $remark?$remark:'反水审核未通过';
						$fuddetaildata['oddtime']     = NOW_TIME;
						$fuddetaildata['amount']   = "0";
						$fuddetaildata['amountbefor']   = $amountbefor;
						$fuddetaildata['amountafter']   = $amountbefor;
						M('fuddetail')->data($fuddetaildata)->add();
						break;
				}
				M('adminlog')->data($logdata)->add();

			}
			$_int?$this->success("审核操作成功"):$this->error('审核操作失败');
			exit;
		}
		$this->display();
	}


//晋级奖励
	function jinjijiangli()
	{
		$db = M('jinjijiangli');
		$_pagasize  = 10;
		$map        = [];
		if(I('username')) $map['username'] = I('username');
		if(I('shenhe')!='') $map['shenhe'] = I('shenhe');
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$jiangli       = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
		$this->assign('jiangli',$jiangli);
		$this->assign('totalcount',$count);
		$this->assign('page',$show);
		$this->display();
	}
	function jinjijianglidelete()
	{
		$this->_db = D('jinjijiangli');
		$this->_pk = $this->_db->getPk();
		parent::_deletedosimp();
	}
//晋级审核
	function jinjishenhe()
	{
		$this->_db = M('jinjijiangli');
		$id = I('id');
		if(!$id){
			$this->error('非法参数');
		}
		$info = $this->_db->where(['id'=>$id])->find();
		if(!$info){
			$this->error('未找到该晋级订单');
		}
		$this->assign('info',$info);
		if(IS_POST){
			$shenhe     = I('shenhe');
			$remark    = I('remark');
			if(!in_array($shenhe,[0,1,-1])){
				$this->error('非法操作');
			}
			if($info['shenhe']!=0){
				$this->error('状态不允许修改');
			}
			//dump($info);exit;
			$_int = $this->_db->where(['id'=>$id])->setField(['shenhe'=>$shenhe]);

			if($_int){
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'jinjishenhe';
				$logdata['info']     = "晋级审核,会员：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				switch($shenhe){
					case"1":
						$logdata['info']     = "晋级审核-通过,会员：".$info['username'];
						$amountbefor = M('Member')->where("id='{$info['uid']}'")->getField('balance');
						M('member')->where("id='{$info['uid']}'")->setInc('balance',$info['jlje']);
						//添加会员账户明细
						$fuddetaildata = [];
						$fuddetaildata['trano']      = $info['trano'];
						$fuddetaildata['uid']      = $info['uid'];
						$fuddetaildata['username'] = $info['username'];
						$fuddetaildata['type']     = 'jinjishenhe';
						$fuddetaildata['typename']     = '晋级审核通过';
						$fuddetaildata['remark']       = $remark?$remark:'晋级审核通过';
						$fuddetaildata['oddtime']     = NOW_TIME;
						$fuddetaildata['amount']   = $info['jlje'];
						$fuddetaildata['amountbefor']   = $amountbefor;
						$fuddetaildata['amountafter']   = $amountbefor + $info['jlje'];
						$jinjijilu = M('Member')->where("id='{$info['uid']}'")->getField('jinjijilu');
						$userdata['jinjijilu'] = $jinjijilu >= $info['groupid']?$jinjijilu:$info['groupid'];
						M('Member')->where("id='{$info['uid']}'")->setField($userdata);
						M('fuddetail')->data($fuddetaildata)->add();
						break;
					case"-1":
						$logdata['info']     = "晋级审核未通过,会员：".$info['username'];
						$amountbefor = M('member')->where("id='{$info['uid']}'")->getField('balance');
						//添加会员账户明细
						$fuddetaildata = [];
						$fuddetaildata['trano']    = $info['trano'];
						$fuddetaildata['uid']      = $info['uid'];
						$fuddetaildata['username'] = $info['username'];
						$fuddetaildata['type']     = 'jinjishenhe';
						$fuddetaildata['typename']     = '晋级审核未通过';
						$fuddetaildata['remark']       = $remark?$remark:'晋级审核未通过';
						$fuddetaildata['oddtime']     = NOW_TIME;
						$fuddetaildata['amount']   = "0";
						$fuddetaildata['amountbefor']   = $amountbefor;
						$fuddetaildata['amountafter']   = $amountbefor;
						M('fuddetail')->data($fuddetaildata)->add();
						break;
				}
				M('adminlog')->data($logdata)->add();

			}
			$_int?$this->success("审核操作成功"):$this->error('审核操作失败');
			exit;
		}
		$this->display();
	}
//代理佣金
	function dailiyongjin()
	{
		$get = I('get.');

		$db = M('dailifandian');
		$_pagasize  = 10;
		$map        = [];
		if(!empty($get['shenhe']) or $get['shenhe']=='0')$map['shenhe'] = $get['shenhe'];
		if($get['trano'])$map['trano'] = $get['trano'];
		if($get['username'])$map['username'] = $get['username'];
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$dailiinfo       = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
		$this->assign('dailiinfo',$dailiinfo);
		$this->assign('totalcount',$count);
		$this->assign('page',$show);
		$this->display();
	}
//佣金审核
	function yongjinshehe()
	{
		$this->_db = M('dailifandian');
		$id = I('id');
		if(!$id){
			$this->error('非法参数');
		}
		$info = $this->_db->where(['id'=>$id])->find();
		if(!$info){
			$this->error('非法操作');
		}
		$this->assign('info',$info);
		if(IS_POST){
			$shenhe     = I('shenhe');
			$remark    = I('remark');
			if(!in_array($shenhe,[0,1,-1])){
				$this->error('非法操作');
			}
			if($info['shenhe']!=0){
				$this->error('状态不允许修改');
			}
			//dump($info);exit;
			$_int = $this->_db->where(['id'=>$id])->setField(['shenhe'=>$shenhe]);

			if($_int){
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'jinjishenhe';
				$logdata['info']     = "佣金发放,代理：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				switch($shenhe){
					case"1":
						$logdata['info']     = "佣金发放-通过,代理：".$info['username'];
						$amountbefor = M('Member')->where("id='{$info['uid']}'")->getField('balance');
						M('member')->where("id='{$info['uid']}'")->setInc('balance',$info['amount']);
						//添加会员账户明细
						$fuddetaildata = [];
						$fuddetaildata['trano']      = $info['trano'];
						$fuddetaildata['uid']      = $info['uid'];
						$fuddetaildata['username'] = $info['username'];
						$fuddetaildata['type']     = 'yongjinshenhe';
						$fuddetaildata['typename']     = '佣金发放通过';
						$fuddetaildata['remark']       = $remark?$remark:'佣金发放通过';
						$fuddetaildata['oddtime']     = NOW_TIME;
						$fuddetaildata['amount']   = $info['amount'];
						$fuddetaildata['amountbefor']   = $amountbefor;
						$fuddetaildata['amountafter']   = $amountbefor + $info['amount'];
						M('fuddetail')->data($fuddetaildata)->add();
						break;
					case"-1":
						$logdata['info']     = "佣金发放未通过,代理：".$info['username'];
						$amountbefor = M('member')->where("id='{$info['uid']}'")->getField('balance');
						//添加会员账户明细
						$fuddetaildata = [];
						$fuddetaildata['trano']    = $info['trano'];
						$fuddetaildata['uid']      = $info['uid'];
						$fuddetaildata['username'] = $info['username'];
						$fuddetaildata['type']     = 'yongjinshenhe';
						$fuddetaildata['typename']     = '佣金发放未通过';
						$fuddetaildata['remark']       = $remark?$remark:'佣金发放未通过';
						$fuddetaildata['oddtime']     = NOW_TIME;
						$fuddetaildata['amount']   = "0";
						$fuddetaildata['amountbefor']   = $amountbefor;
						$fuddetaildata['amountafter']   = $amountbefor;
						M('fuddetail')->data($fuddetaildata)->add();
						break;
				}
				M('adminlog')->data($logdata)->add();

			}
			$_int?$this->success("佣金发放操作成功"):$this->error('佣金发放操作失败');
			exit;
		}
		$this->display();
	}
//佣金删除
	function yongjindelete()
	{
		$this->_db = D('dailifandian');
		$this->_pk = $this->_db->getPk();
		parent::_deletedosimp();
	}
//佣金批量审核
	function yongjinshehes()
	{
		$this->_db = M('dailifandian');
		$ids = I('ids');
		if(!$ids){
			$this->error('非法参数');
		}
		$map['id'] = array('in',$_POST['ids']);
		$map['shenhe'] = '0';
		$info = $this->_db->where($map)->select();
		if(!$info){
			$this->error('非法操作');
		}
		$this->assign('info',$info);
		if(IS_POST){
			$shenhe     = 1;
			if(!in_array($shenhe,[0,1,-1])){
				$this->error('非法操作');
			}
			if($info['shenhe']!=0){
				$this->error('状态不允许修改');
			}
			//dump($info);exit;
			foreach($info as $k=>$v){
				$_int = $this->_db->where(['id'=>$v['id']])->setField(['shenhe'=>$shenhe]);
				if($_int){
					//管理操作日志
					$logdata = [];
					$logdata['userid']   = $this->admininfo['id'];
					$logdata['username'] = $this->admininfo['username'];
					$logdata['type']     = 'jinjishenhe';
					$logdata['info']     = "佣金发放,代理：".$v['username'];
					$logdata['time']     = NOW_TIME;
					$logdata['ip']       = get_client_ip();
					$iparea = IParea(get_client_ip());
					$logdata['iparea']   = $iparea;
					$logdata['info']     = "佣金发放-通过,代理：".$v['username'];
					$amountbefor = M('Member')->where("id='{$v['uid']}'")->getField('balance');
					M('member')->where("id='{$v['uid']}'")->setInc('balance',$v['amount']);
					//添加会员账户明细
					$fuddetaildata = [];
					$fuddetaildata['trano']      = $v['trano'];
					$fuddetaildata['uid']      = $v['uid'];
					$fuddetaildata['username'] = $v['username'];
					$fuddetaildata['type']     = 'yongjinshenhe';
					$fuddetaildata['typename']     = '佣金发放通过';
					$fuddetaildata['remark']       = $remark?$remark:'佣金发放通过';
					$fuddetaildata['oddtime']     = NOW_TIME;
					$fuddetaildata['amount']   = $v['amount'];
					$fuddetaildata['amountbefor']   = $amountbefor;
					$fuddetaildata['amountafter']   = $amountbefor + $v['amount'];
					M('fuddetail')->data($fuddetaildata)->add();
					M('adminlog')->data($logdata)->add();

				}
			}
			$_int?$this->success("佣金批量发放操作成功"):$this->error('佣金批量发放操作失败');
		}
		$this->display();
	}
//批量删除佣金数椐
	function yongjindeleteall(){
		$admininfo = $this->admininfo;
		if($admininfo['groupid']!=1){
			echo'只有超级管理员可以操作';exit;
		}
		$this->_db = M('dailifandian');
		self::_deletealldo();
	}
	function recharge(){
		$state = I('state');
		$uid = I('uid');
		$trano = I('trano');
		$username = I('username');

		$db = M('recharge');
		$_pagasize  = 10;
		$map        = [];
		if($state!=''){
			$map['state']    = ['eq',$state];
			$this->assign('state',$state);
		}
		if($trano){
			$map['trano']    = ['eq',$trano];
			$this->assign('trano',$trano);
		}
		if($uid){
			$map['uid']    = ['eq',$uid];
			$this->assign('uid',$uid);
		}
		if($username){
			$map['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($_REQUEST['sDate']){
			$map['oddtime'][]    = ['egt',strtotime($_REQUEST['sDate'])];
			$this->assign('_sDate',urldecode($_REQUEST['sDate']));
		}
		if($_REQUEST['eDate']){
			$map['oddtime'][]    = ['elt',strtotime($_REQUEST['eDate'])+86400];
			$this->assign('_eDate',urldecode($_REQUEST['eDate']));
		}
		if($_REQUEST['sAmout']){
			$map['amount'][]    = ['egt',strtotime($_REQUEST['sAmout'])];
			$this->assign('_sAmout',urldecode($_REQUEST['sAmout']));
		}
		if($_REQUEST['eAmout']){
			$map['amount'][]    = ['elt',strtotime($_REQUEST['eAmout'])];
			$this->assign('_eAmout',urldecode($_REQUEST['eAmout']));
		}
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();

		$this->assign('totalcount',$count);
		$this->assign('list',$list);
		$this->assign('page',$show);

		//充值统计
		$rechalltotal   = $db->where(['state'=>1])->sum('amount');
		$rechalltotal_count   = $db->where(['state'=>1])->count();
		$rechtotal_aotu = $db->where(['state'=>1,'isauto'=>1])->sum('amount');
		$rechtotal_aotu_count   = $db->where(['state'=>1,'isauto'=>1])->count();
		$rechtotal_shou = $db->where(['state'=>1,'isauto'=>2])->sum('amount');
		$rechtotal_shou_count   = $db->where(['state'=>1,'isauto'=>2])->count();
		$this->assign('rechalltotal',$rechalltotal);
		$this->assign('rechtotal_aotu',$rechtotal_aotu);
		$this->assign('rechtotal_shou',$rechtotal_shou);
		$this->assign('rechalltotal_count',$rechalltotal_count);
		$this->assign('rechtotal_aotu_count',$rechtotal_aotu_count);
		$this->assign('rechtotal_shou_count',$rechtotal_shou_count);
		$this->display();
	}
	function rechargstate(){
		$this->_db = M('recharge');
		$id = I('id');
		if(!$id){
			$this->error('非法参数');
		}
		$info = $this->_db->where(['id'=>$id])->find();
		if(!$info){
			$this->error('未找到该订单');
		}
		$this->assign('info',$info);
		if(IS_POST){
			$state     = I('state');
			$remark    = I('remark');
			if(!in_array($state,[0,1,-1])){
				$this->error('非法操作');
			}
			if($info['state']!=0){
				$this->error('订单状态不允许修改');
			}
			if($state==1){
				$returnint = userrechargepay($info);
				if($returnint==0){
					$this->error('充值参数非法');exit;
				}elseif($returnint==1){
					$this->_db->where(['id'=>$id])->setField(['remark'=>$remark?$remark:$info['remark'],'stateadmin'=>$this->admininfo['username']]);
					//管理操作日志
					$logdata = [];
					$logdata['userid']   = $this->admininfo['id'];
					$logdata['username'] = $this->admininfo['username'];
					$logdata['type']     = 'rechargstate';
					$logdata['info']     = "充值订单审核通过，订单号".$info['trano'].",会员：".$info['username'];
					$logdata['time']     = NOW_TIME;
					$logdata['ip']       = get_client_ip();
					$iparea = IParea(get_client_ip());
					$logdata['iparea']   = $iparea;
					M('adminlog')->data($logdata)->add();
					$_int = 1;
					$this->success('ok充值成功ok');exit;
				}elseif($returnint==-1){
					$this->error('充值订单已经取消');exit;
				}else{
					$this->error('充值失败2');exit;
				}
			}elseif($state==-1){
				$_int = $this->_db->where(['id'=>$id])->setField(['state'=>-1,'remark'=>$remark,'stateadmin'=>$this->admininfo['username']]);
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'rechargstate';
				$logdata['info']     = "充值订单取消，订单号".$info['trano'].",会员：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				M('adminlog')->data($logdata)->add();
			}
			$_int?$this->success("审核操作成功"):$this->error('审核操作失败');
			exit;
		}
		$this->display();
	}
	function rechargedelete(){
		$this->_db = M('recharge');
		parent::_deletedosimp();
	}
	function withdrawdelete(){
		$this->_db = M('withdraw');
		parent::_deletedosimp();
	}
	function withdraw(){
		$state = I('state');
		$uid = I('uid');
		$trano = I('trano');
		$username = I('username');

		$db = M('withdraw');
		$_pagasize  = 10;
		$map        = [];
		if($state!=''){
			$map['state']    = ['eq',$state];
			$this->assign('state',$state);
		}
		if($trano){
			$map['trano']    = ['eq',$trano];
			$this->assign('trano',$trano);
		}
		if($uid){
			$map['uid']    = ['eq',$uid];
			$this->assign('uid',$uid);
		}
		if($username){
			$map['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($_REQUEST['sDate']){
			$map['oddtime'][]    = ['egt',strtotime($_REQUEST['sDate'])];
			$this->assign('_sDate',urldecode($_REQUEST['sDate']));
		}
		if($_REQUEST['eDate']){
			$map['oddtime'][]    = ['elt',strtotime($_REQUEST['eDate'])+86400];
			$this->assign('_eDate',urldecode($_REQUEST['eDate']));
		}
		if($_REQUEST['sAmout']){
			$map['amount'][]    = ['egt',strtotime($_REQUEST['sAmout'])];
			$this->assign('_sAmout',urldecode($_REQUEST['sAmout']));
		}
		if($_REQUEST['eAmout']){
			$map['amount'][]    = ['elt',strtotime($_REQUEST['eAmout'])];
			$this->assign('_eAmout',urldecode($_REQUEST['eAmout']));
		}
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();

		$this->assign('totalcount',$count);
		$this->assign('list',$list);
		$this->assign('page',$show);

		//提款统计
		$withdrawtotal   = $db->where(['state'=>1])->sum('amount');
		$this->assign('withdrawtotal',$withdrawtotal);
		$withdrawtotal_count   = $db->where(['state'=>1])->count();
		$this->assign('withdrawtotal_count',$withdrawtotal_count);
		$this->display();
	}
	function withdrawstate(){
		$this->_db = M('withdraw');
		$id = I('id');
		if(!$id){
			$this->error('非法参数');
		}
		$info = $this->_db->where(['id'=>$id])->find();

		if(!$info){
			$this->error('未找到该订单');
		}
		$this->assign('info',$info);
		if(IS_POST){
			$state     = I('state');
			$remark    = I('remark');
			if(!in_array($state,[0,1,-1])){
				$this->error('非法操作');
			}
			if($info['state']!=0){
				$this->error('订单状态不允许修改');
			}
			//dump($info);exit;
			$_int = $this->_db->where(['id'=>$id])->setField(['state'=>$state,'remark'=>$remark,'stateadmin'=>$this->admininfo['username']]);
			if($_int){
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'withdrawstate';
				$logdata['info']     = "提款订单审核，订单号".$info['trano'].",会员：".$info['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				switch($state){
					case"1":
						$logdata['info']     = "提款订单审核-通过，订单号".$info['trano'].",会员：".$info['username'];
						//$amountbefor = M('member')->where(['uid'=>$info['uid']])->getField('balance');
						//M('member')->where(['id'=>$info['uid']])->setDec('balance',$info['amount']);
						//添加会员账户明细
						$fuddetaildata = [];
						$fuddetaildata['trano']      = $info['trano'];
						$fuddetaildata['uid']      = $info['uid'];
						$fuddetaildata['username'] = $info['username'];
						$fuddetaildata['type']     = 'withdraw';
						$fuddetaildata['typename']     = '提款审核通过';
						$fuddetaildata['remark']       = $remark?$remark:'提款审核通过';
						$fuddetaildata['oddtime']     = NOW_TIME;
						$fuddetaildata['amount']   = $info['amount'];
						$fuddetaildata['amountbefor']   = $info['oldaccountmoney'];
						$fuddetaildata['amountafter']   = $info['newaccountmoney'];
						M('fuddetail')->data($fuddetaildata)->add();
						break;
					case"-1":
						$logdata['info']     = "提款订单审核-退回，订单号".$info['trano'].",会员：".$info['username'];

						$amountbefor = M('member')->where(['id'=>$info['uid']])->getField('balance');
						M('member')->where(['id'=>$info['uid']])->setInc('balance',$info['amount']);
					//	M('member')->where(['id'=>$info['uid']])->setInc('point',$info['amount']);
						//添加会员账户明细
						$fuddetaildata = [];
						$fuddetaildata['trano']      = $info['trano'];
						$fuddetaildata['uid']      = $info['uid'];
						$fuddetaildata['username'] = $info['username'];
						$fuddetaildata['type']     = 'withdraw';
						$fuddetaildata['typename']     = '提款退回';
						$fuddetaildata['remark']       = $remark?$remark:'提款退回';
						$fuddetaildata['oddtime']     = NOW_TIME;
						$fuddetaildata['amount']   = $info['amount'];
						$fuddetaildata['amountbefor']   = $amountbefor;
						$fuddetaildata['amountafter']   = $amountbefor + $info['amount'];
						M('fuddetail')->data($fuddetaildata)->add();
						break;
				}
				M('adminlog')->data($logdata)->add();

			}
			$_int?$this->success("审核操作成功"):$this->error('审核操作失败');
			exit;
		}
		$this->display();
	}
	function agentlink(){
		$username = I('username');

		$db = M('agentlink');
		$_pagasize  = 10;
		$map        = [];
		if($username){
			$map['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();

		$this->assign('totalcount',$count);
		$this->assign('list',$list);
		$this->assign('page',$show);

		$this->display();
	}
	function agentlinkdelete(){
		$this->_db = M('agentlink');
		$this->_pk = $this->_db->getPk();
		parent::_deletedosimp();
	}
	function sameipuser(){
		$DB_PREFIX = C('DB_PREFIX');
		$sql = "select username,logintime,loginip,count(*) as count from {$DB_PREFIX}member where loginip!='' group by loginip order by count desc";

		$list       = M()->query($sql);
		foreach($list as $k=>$v){
			//if($v['count']>1)unset($list[$k]);loginip=106.226.222.96
			//<u style="cursor:pointer" class="text-primary" layer-url="/Admincenter/Member.balance.id.50627.do" title="修改-q008金额">1016337.5000</u>
			if($v['count']>1){
				echo "<p>IP：<a target='_blank' href='".U('Member/manage')."?loginip={$v['loginip']}'>{$v['loginip']}</a>,会员：{$v['username']}(等),相同IP会员数量:{$v['count']}</p><hr>";
			}
		};
	}
	public function activity(){
        $db = M('activitie');
        $_pagasize  = 10;
        $map        = [];
        if(I('type')) $map['type'] = I('type');
        $count      = $db->where($map)->count();
        $Page       = new \Think\Page($count,$_pagasize);
        $show       = $Page->show();
        $activitie      = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("sort asc")->select();
        $this->assign('activitie',$activitie);
        $this->assign('totalcount',$count);
        $this->assign('page',$show);
        $this->display();
    }
    public function addactivity($id = null){
	    if(IS_POST) {
//            $up =   new UploadsController();
//            $up->upload();
            if (!IS_AJAX || !IS_POST) $this->error('非法操作！');
            $db = M('activitie');
            if ($_POST['id']) {
                $_POST['updated_at'] = date('Y-m-d H:i:s', time());
                $id = $_POST['id'];
                $int = $db->where(['id'=>$id])->data($_POST)->save();
                $int?$this->success('操作成功'):$this->error('操作失败');
                exit();
            } else {
                $_POST['created_at'] = date('Y-m-d H:i:s', time());
                $int = $db->data($_POST)->add();
                $int ? $this->success('操作成功') : $this->error('操作失败'.M()->_sql());
                exit();
            }
        }
        $info = M('activitie')->where(['id'=>$id])->find();
        $this->assign('info',$info);
        $this->display();
    }
    public function delactivity($id = null){

        $int = M('activitie')->where(['id'=>$id])->delete();
        $int?$this->success('操作成功'):$this->error('操作失败');
        exit;
    }
    public function activityapply(){
        $db = M('activitieapply');
        $_pagasize  = 10;
        $map        = [];
        if(I('type')) $map['type'] = I('type');
        if(I('status')) $map['caipiao_activitieapply.status'] = I('status');
        $count      = $db->where($map)->join('caipiao_activitie ON caipiao_activitieapply.activity_id = caipiao_activitie.id')
            ->join('caipiao_member ON caipiao_activitieapply.member_id = caipiao_member.id')->count();
        $Page       = new \Think\Page($count,$_pagasize);
        $show       = $Page->show();
        $activitieapply = $db->where($map)
            ->join('caipiao_activitie ON caipiao_activitieapply.activity_id = caipiao_activitie.id')
            ->join('caipiao_member ON caipiao_activitieapply.member_id = caipiao_member.id')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->field('caipiao_activitieapply.id,caipiao_activitieapply.created_at,caipiao_activitie.title,type,username,caipiao_activitieapply.status')
            ->order("sort asc")->select();
        $this->assign('activitieapply',$activitieapply);
        $this->assign('totalcount',$count);
        $this->assign('page',$show);
        $this->display();
    }
    //审核活动
    public function activitystate(){
	    $id = I('id');
        $db = M('activitieapply');
        $info = $db
            ->join('caipiao_activitie ON caipiao_activitieapply.activity_id = caipiao_activitie.id')
            ->join('caipiao_member ON caipiao_activitieapply.member_id = caipiao_member.id')
            ->field('caipiao_activitieapply.id,username,rate,direct_money,member_id,activity_id')
            ->where(['caipiao_activitieapply.id'=>$id])
            ->find();
        $this->assign('info',$info);
        if(IS_POST){
            $data = I();

            if(empty($data['states'])){
                $this->error('请选择审核状态');exit;
            }
            if($data['states'] ==2){
                M()->startTrans();
				$member_info = M('member')->where(['id'=>$data['member_id']])->find();
                $activitie = M('activitie')->where(['id'=>$data['activity_id']])->find();
                $where['member_id'] = $data['member_id'];
                $where['activity_id'] = $activitie['id'];
                $where['status'] = 2;
                $total_money = $db->where($where)->sum('money');
                $money = $data['direct_money']*$data['rate']/100;
                if($total_money+$money >$activitie['gift_limit_money']){
                    $this->error('此用户赠送金额已上线');exit;
                }
				$save['uid'] = $member_info['id'];
				$save['username'] = $member_info['username'];
				$save['type'] = 'activity_red';
				$save['typename'] = '活动申请';
				$save['remark'] = '活动申请发放奖励';
				$save['amount'] = $money;
				$save['amountbefor'] = $member_info['balance'];
				$save['amountafter'] = $member_info['balance']+$money;
				$save['oddtime'] = time();
				$res = M('fuddetail')->add($save);
                $ss = M('member')->where(['id'=>$member_info['id']])->setInc('balance',$money);
                $rest =$db->where(['id'=>$data['id']])->save(['status'=>2,'money'=>$money,'fail_reason'=>$data['fail_reason']]);
                if ($member_info && $ss && $rest && $activitie && $res){
                    // 提交事务
                    M()->commit();
                    $this->success('操作成功');
                }else{
                    // 事务回滚
                    M()->rollback();
                    $this->success('操作失败');
                }
            }else{
                $db->where(['id'=>$data['id']])->save(['status'=>3,'fail_reason'=>$data['fail_reason']]);
                $this->success('操作成功');
            }

        }
        $this->display();
    }
    public function delapplyactivity($id = null){

        $int = M('activitieapply')->where(['id'=>$id])->delete();
        $int?$this->success('操作成功'):$this->error('操作失败');
        exit;
    }
    public function redbagset(){
        $db = M('hongbaosettings');
        $_pagasize  = 10;
        $map        = [];
        if(I('type')) $map['type'] = I('type');
        $count      = $db->where($map)->count();
        $Page       = new \Think\Page($count,$_pagasize);
        $show       = $Page->show();
        $hongbaosettings      = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("sort asc")->select();
        $this->assign('hongbaosettings',$hongbaosettings);
        $this->assign('totalcount',$count);
        $this->assign('page',$show);
        $this->display();
    }
    public function addredbagset($id = null){
        if(IS_POST){
            $this->_db = M('hongbaosettings');
            $_POST['updated_at'] = date('Y-m-d H:i:s',time());
            if($_POST['id']){
                parent::_editdosimp();
            }else{
                $_POST['created_at'] = date('Y-m-d H:i:s',time());
                parent::_adddosimp();
            }
        }
        $info = M('hongbaosettings')->where(['id'=>$id])->find();
        $this->assign('info',$info);
        $this->display();
    }
    public function delredbagset($id=null){
        $int = M('hongbaosettings')->where(['id'=>$id])->delete();
        $int?$this->success('操作成功'):$this->error('操作失败');
        exit;
    }
    public function getredbag(){
        $db = M('hongbao');
        $_pagasize  = 10;
        $map        = [];
        $count      = $db->where($map)->count();
        $Page       = new \Think\Page($count,$_pagasize);
        $show       = $Page->show();
        $get_hongbao = $db->where($map)->select();
        $this->assign('get_hongbao',$get_hongbao);
        $this->assign('totalcount',$count);
        $this->assign('page',$show);
        $this->display();
    }
    public function delhongbao($id=null){
        $int = M('hongbao')->where(['id'=>$id])->delete();
        $int?$this->success('操作成功'):$this->error('操作失败');
        exit;
    }
    public function live_fandian(){
        $id = I('id');
        $info = $this->_db->where([$this->_pk=>$id])->find();
        $fandian = M('recreation_fandian')->where(['member_id'=>$id])->find();
        if(!$info){
            $this->error('用户名不存在！--'.$id);
        }else{
            $this->assign('user',$info);
            $this->assign('info',$fandian);
        }
        if(IS_POST){
            $fandian_id = I('fandian_id');
            if(!IS_AJAX || !IS_POST)$this->error('非法操作！');
            $post_data = $_POST;
            $post_data['upd_date'] = time();
            unset($post_data['fandian_id']);
            unset($post_data['id']);
            unset($post_data['user_name']);
            if($post_data){
               foreach ($post_data as $index=>$v){
                   if($v==''){
                       $post_data[$index]=0;
                   }
               }
            }
            try{
                if (empty($fandian_id)){
                    $fandian = M("recreation_fandian");
                    $fandian->create();
                    $post_data['create_date'] = time();
                    $int=$fandian->add($post_data);
                }else{
                    $int = M('recreation_fandian')->where(['fandian_id'=>$fandian_id])->data($post_data)->save();
                }
                $int?$this->success('操作成功'):$this->error($int.'操作失败');
            }catch (Exception $e){
            }

        }
        $this->display();
    }
}