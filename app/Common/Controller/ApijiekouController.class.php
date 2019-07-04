<?php
//公共接口方法
namespace Common\Controller;
use Think\Controller;
class ApijiekouController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
	protected function checkislogin(){
		$userinfo = self::islogin();
		
	}
    
	static function islogin(){
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id'); 
		if(!$sessionid || !$auth_id){
			return ['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]];
		}
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/checkislogin');
		return $Result['data'];
	}
	
	protected function getLottery($apiparam=array()){
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Lottery/lotterylist',$apiparam);
		return $Result;
	}
	protected function getLotterycode($apiparam=array()){
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Lottery/lotterycode',$apiparam);
		return $Result;
	}
}