<?php
namespace Home\Controller;
use Think\Controller\HproseController;
class CommonController extends HproseController{
	protected $apitoten = '96C6852611F0244E988B8AA20F61071C';
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
    }
	//token验证
	protected function _cheacktoken($apiparam=array()){
		$apiparam['sign'] = true;
		$apiparam['message'] = '请求成功';
		if($apiparam['apitoten'] != $this->apitoten || strlen($apiparam['apitoten'])!=32){
			$apiparam['sign'] = false;
			$apiparam['message'] = 'token验证错误';
		}
		unset($apiparam['apitoten']);
		return $apiparam;
	}
	//登陆验证
	//userid 会员ID
	//sessionid sessinid
	protected function _cheackislogin($apiparam=array()){
		$userid    = intval($apiparam['userid']);
		$sessionid = $apiparam['sessionid'];
		$apiparam['sign'] = true;
		$apiparam['message'] = '请求成功';
		if(!$userid || !$sessionid){
			$apiparam['sign'] = false;
			$apiparam['message'] = 'userid 和 sessionid不完整';
			return $apiparam;
		}
		if(!is_numeric($userid)){
			$apiparam['sign'] = false;
			$apiparam['message'] = '会员ID必须是数字';
			return $apiparam;
		}
		if(strlen($sessionid)!=32){
			$apiparam['sign'] = false;
			$apiparam['message'] = 'sessionid长度错误';
			return $apiparam;
		}
		$userinfo = M('member')->where(['id'=>$userid])->find();
		if(!$userinfo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '会员不存在';
			return $apiparam;
		}
		/*if($userinfo['islock']==1){
			$apiparam['sign'] = false;
			$apiparam['message'] = '该会员账户已被冻结';
			return $apiparam;
		}*/
		$sessioninfo = M('membersession')->where(['userid'=>$userid])->find();
		if(!$sessioninfo){
			$apiparam['sign'] = false;
			$apiparam['message'] = '会员未登陆';
			return $apiparam;
		}
		
		//到此
		$userinfo['islogin'] = 0;
		if($sessionid!=$sessioninfo['sessionid']){//别的地方登陆
			$userinfo['islogin'] = -1;
			$apiparam['message'] = '您的账号在别的地方登陆,如果不是您本人操作请立即修改密码';
		}
		
		//设置登陆超时时间
		$outtime = C('sessiontime');
		$outtime = $outtime?$outtime:10*60;
		if($outtime && NOW_TIME-$sessioninfo['time']>$outtime){
			$userinfo['islogin'] = -2;
			$apiparam['message'] = '登陆超时';
		}
		$apiparam['data'] = $userinfo;
		return $apiparam;
	}
	
}