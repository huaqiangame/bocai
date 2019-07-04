<?php

function islogin(){
	$admin_sessionid = session('member_sessionid');
	$admin_auth_id   = session('member_auth_id');
	if(!$admin_sessionid || !$admin_auth_id){
		return 0;
	}
	$sessioninfo = M('Membersession')->where(['userid'=>$admin_auth_id])->find();
	if(!$sessioninfo){
		return 0;
	}else{
		if($admin_sessionid!=$sessioninfo['sessionid']){
			return -1;//别的地方登录
		}
		if(C('sessiontime') && NOW_TIME-$sessioninfo['time']>C('sessiontime')){
			return -2;//登录超时
		}
	}
	$userinfo = D('Member')->getMemberinfo($sessioninfo['userid']);
	return $userinfo;
}