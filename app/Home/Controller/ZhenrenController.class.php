<?php
namespace Home\Controller;

use Think\Exception;
use Think\Model;
class ZhenrenController extends CommonController {
	public function __construct(){
		parent::__construct();
		$logininfo = islogin();
		if($logininfo['sign']==false){
			session('member_sessionid',NULL);
			session('member_auth_id',NULL);
			redirect(U("Public/login"));
			exit;
		}else{
			if($logininfo['data']['islogin']!=1 || $logininfo['data']['islock']==1){
				session('member_sessionid',NULL);
				session('member_auth_id',NULL);
				redirect(U("Public/login"));
				exit;
			}
			$this->userinfo = $logininfo['data'];
		}

		if(ACTION_NAME !="safepass")
		{
			if(empty($_SESSION['userinfo']['tradepassword']))
			{
				$this->error('为了你的资金安全,请先设置安全密码',U('Member/safepass'));
			}
		}
	}



    //获取余额
	function balance()
	{
		$userInfo=$_SESSION['userinfo'];
		$username=$userInfo['username'];
		if($username){
			$type=I('type');
			switch($type){
				case 'ag':
				$AgService=new \Org\Util\AgService();
			    $ret=$AgService->balance(trim($username));
				
				break;
				case 'bbin':
				  $BbinService=new \Org\Util\BbinService();
			      $ret=$BbinService->balance(trim($username));
				   
				break;
				case 'ky':
				  $KyService=new \Org\Util\KyService();
			      $ret=$KyService->balance(trim($username));
				   
				break;			
				case 'ss':
				  $SsService=new \Org\Util\SsService();
			      $ret=$SsService->balance(trim($username));
				   
				break;						
			}
		}else{
			$ret=array('code'=>2,'msg'=>'请先登录');
		}
		
		$this->ajaxReturn($ret);
	}
	
	function deposit(){
		
		$userInfo=$_SESSION['userinfo'];
		$username=$userInfo['username'];
		if($username){
			
			$type=I('type');
			$amount=I('amount');
		   	if(empty($type)||empty($amount)){
					$ret=array('code'=>-1,'msg'=>'参数缺失');
				$this->ajaxReturn($ret);exit;
			}
			$member=D("Member")->find($userInfo['id']);
			$balance=$member['balance'];
			if($balance<$amount){
				$ret=array('code'=>-1,'msg'=>'余额不足，请先充值');
				$this->ajaxReturn($ret);exit;
			}
			D("Transrecord")->startTrans();
			try{
				$data=array();
				$mt=time();
				$mtd=mt_rand(1000,9999);
				$billno=$mt.$mtd;
				if($type=='ag'){
					$data['transType']='ag';
				   $data['transDes']='AG转入';
				}else if($type=='bbin'){
				   $data['transType']='bb';
				   $data['transDes']='BB转入';
				}
				else if($type=='ky'){
				   $data['transType']='ky';
				   $data['transDes']='KY转入';
				}
				else if($type=='ss'){
				   $data['transType']='ss';
				   $data['transDes']='SS转入';
				}				
				$data['uid']=$userInfo['id'];
				$data['transBillno']=$billno;
				$data['tansAmount']=$amount;
				$data['state']=1;
				$data['transTime']=date("Y-m-d H:i:s");
				D("Transrecord")->add($data);
				D("Member")->where(array("id"=>$userInfo['id']))->setDec('balance',$amount);
				if($type=='ag'){
					$AgService=new \Org\Util\AgService();
					$ret=$AgService->trans_in(trim($username),$amount,$billno);
				}else if($type=='bbin'){
				  $BbinService=new \Org\Util\BbinService();
			      $ret=$BbinService->deposit(trim($username),$amount,$billno);
				}
				else if($type=='ky'){
				  $KyService=new \Org\Util\KyService();
			      $ret=$KyService->trans_in(trim($username),$amount,$billno);
				}
				else if($type=='ss'){
				  $SsService=new \Org\Util\SsService();
			      $ret=$SsService->trans_in(trim($username),$amount,$billno);
				}				
					
				if($ret['code']!=1){
					D("Transrecord")->rollback();
				
				}else{
					D("Transrecord")->commit();
				}
			}catch(Exception $e){
					D("Transrecord")->rollback();
			}
		}else{
			$ret=array('code'=>2,'msg'=>'请先登录');
		}
		$this->ajaxReturn($ret);
	}
	
	public	function withdrawal(){
		$userInfo=$_SESSION['userinfo'];
		$username=$userInfo['username'];
		
		if($username){
			$type=I('type');
			$amount=I('amount');
			if(empty($type)||empty($amount)){
					$ret=array('code'=>-1,'msg'=>'参数缺失');
				$this->ajaxReturn($ret);exit;
			}
			
			D("Transrecord")->startTrans();
			try{
				$data=array();
				$mt=time();
				$mtd=mt_rand(1000,9999);
				$billno=$mt.$mtd;
				if($type=='ag'){
					$data['transType']='ag';
				   $data['transDes']='AG转出';
				}else if($type=='bbin'){
				   $data['transType']='bb';
				   $data['transDes']='BB转出';
				}else if($type=='ky'){
				   $data['transType']='ky';
				   $data['transDes']='KY转出';
				}else if($type=='ss'){
				   $data['transType']='ss';
				   $data['transDes']='SS转出';
				}				
				$data['uid']=$userInfo['id'];
				$data['transBillno']=$billno;
				$data['tansAmount']=$amount;
				$data['state']=1;
				$data['transTime']=date("Y-m-d H:i:s");
				D("Transrecord")->add($data);
				D("Member")->where(array("id"=>$userInfo['id']))->setInc('balance',$amount);
				if($type=='ag'){
					$AgService=new \Org\Util\AgService();
					$ret=$AgService->trans_out(trim($username),$amount,$billno);
				}else if($type=='bbin'){
				  $BbinService=new \Org\Util\BbinService();
			      $ret=$BbinService->withdrawal(trim($username),$amount,$billno);
				}else if($type=='ky'){
				  $KyService=new \Org\Util\KyService();
			      $ret=$KyService->trans_out(trim($username),$amount,$billno);
				}else if($type=='ss'){
				  $SsService=new \Org\Util\SsService();
			      $ret=$SsService->trans_out(trim($username),$amount,$billno);
				}
				
				if($ret['code']!=1){
					D("Transrecord")->rollback();
				}else{
					D("Transrecord")->commit();
				}
			}catch(Exception $e){
					D("Transrecord")->rollback();
			}
		
		}else{
			$ret=array('code'=>2,'msg'=>'请先登录');
		}
		
		$this->ajaxReturn($ret);
	}
	
    function login(){
		$userInfo=$_SESSION['userinfo'];
		$username=$userInfo['username'];
		if($username){
			$type=I('type','bbin');
			$code=I('code',null);
			switch($type){
				case 'ag':
			$AgService=new \Org\Util\AgService();
			  $ret=$AgService->login(trim($username),$code);
				break;
				case 'bbin':
				
				  $BbinService=new \Org\Util\BbinService();
			      $ret=$BbinService->login(trim($username));
				break;
				case 'ky':
				
				  $KyService=new \Org\Util\KyService();
			      $ret=$KyService->login(trim($username));
				break;
				case 'ss':
				
				  $SsService=new \Org\Util\SsService();
			      $ret=$SsService->login(trim($username));
				break;				
			}
			
			if($ret['code']==1){
				$url=$ret['msg'];
				header("location:$url");
				exit;
			}else{
				$this->error($ret['msg']);
			}
		}else{
			$this->error("请先登录");
			
		}
		
		
	}		
	
}

