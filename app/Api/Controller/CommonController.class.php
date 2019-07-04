<?php
namespace Api\Controller;
use Think\Controller;
class CommonController extends Controller{
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
    }
	//token验证
	protected function _cheacktoken($apiparam=array()){
		$apiparam['sign'] = true;
		$apiparam['message'] = '请求成功'; 
		return $apiparam;
	}
	//登陆验证
	//userid 会员ID
	//sessionid sessinid
	protected function _cheackislogin($apiparam=array()){
	$member_auth_id   = $apiparam['auth']['member_auth_id'];
	$member_sessionid = $apiparam['auth']['member_sessionid'];
	if(!$member_auth_id || !$member_sessionid){
		$apiparam['sign']    = false;
		$apiparam['message'] = '缺少验证参数';
		return $apiparam;
	}
	if(!is_numeric($member_auth_id)){
		$apiparam['sign'] = false;
		$apiparam['message'] = 'user_id必须是数字';
		return $apiparam;
	}
	if(strlen($member_sessionid)!=32){
		$apiparam['sign'] = false;
		$apiparam['message'] = 'sessionid长度错误';
		return $apiparam;
	}
	$userinfo = M('member')->where(['id'=>$member_auth_id])->find();
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
	$sessioninfo = M('membersession')->where(['userid'=>$member_auth_id])->find();
	if(!$sessioninfo){
		$apiparam['sign'] = false;
		$apiparam['message'] = '会员未登陆';
		return $apiparam;
	}
	
	//到此
	$userinfo['islogin'] = 1;
	if($member_sessionid!=$sessioninfo['sessionid']){//别的地方登陆
		$apiparam['sign'] = false;
		$apiparam['data']['islogin'] = -1;
		$apiparam['message'] = '您的账号在别的地方登陆,如果不是您本人操作请立即修改密码';
		return $apiparam;
	}
	
	//设置登陆超时时间
	$outtime = C('sessiontime');
	$outtime = $outtime?$outtime:10*60;
	
	if($outtime && NOW_TIME-$sessioninfo['time']>$outtime){
		$apiparam['data']['islogin'] = -2;
		$apiparam['data']['logintime'] = date('Y-m-d H:i:s',$sessioninfo['time']);
		$apiparam['data']['loginouttime'] = date('Y-m-d H:i:s',$sessioninfo['time']+$outtime);
		$apiparam['message'] = '登陆超时';
		return $apiparam;
	}
	//更新session时间
	$_t = time();
	$sessionint = M('membersession')->where(['userid'=>$userinfo['id']])->setField(['time'=>$_t]);
	$onlineint  = M('member')->where(['id'=>$userinfo['id']])->setField(['onlinetime'=>$_t]);
	
	if($userinfo['proxy']==1){
		$userinfo['groupname'] = '代理';
	}else{
		if($userinfo['groupid']){
			$userinfo['groupname'] = M('membergroup')->where(['groupid'=>$userinfo['groupid']])->getField('membergroup');
		}else{
			$userinfo['groupname'] = '普通会员';
		}
	}
	$apiparam['data'] = $userinfo;
	
	//绑定的银行
	$banklist = M('banklist')->where(['uid'=>$userinfo['id'],'state'=>1])->select();
	$apiparam['data']['banklist'] = $banklist?$banklist:false;
	
	//密保
	$question = M('question')->where(['uid'=>$userinfo['id']])->find();
	$apiparam['data']['question'] = $question?$question:false;
		return $apiparam;
	}
	
}