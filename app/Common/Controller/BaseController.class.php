<?php
//放公共接口方法
namespace Common\Controller;
use Think\Controller;
class BaseController extends ConfigController {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
	//发送请求
	// Clienturl 完整请求地址 ( 到方法 不包含http的网关 ) Home/Member/aaa
	// apiparam  传递的参数（数组）
	// apiparam  传递的参数（数组）
	protected function sendHttpClient($Clienturl='',$apiparam=array()){
		$result = array();
		if(strpos($Clienturl,'/')===false){
			E('请求地址错误');
		}
		$_Clienturls = array_filter(explode('/',$Clienturl));
		$_Clienturls = array_filter(explode('/',$Clienturl));
		if(count($_Clienturls)!=3){
			E('请求地址格式为：模块/控制器/方法');
		}
		$_Clienturls_old = $_Clienturls;
		unset($_Clienturls);
		foreach($_Clienturls_old as $v){
			$_Clienturls[] = $v;
		}
		$apiaction = $_Clienturls[2];
		if(substr($this->apiurl,-1)!='/'){
			$this->apiurl = $this->apiurl . '/';
		}
		$Clienturl = $this->apiurl . $_Clienturls[0].'/'.$_Clienturls[1];
		$apiaction = $_Clienturls[2];
		$apiparam['apitoten']  = $this->apitoten;
		vendor('Hprose.HproseHttpClient');
		$client   = new \HproseHttpClient($Clienturl);
		$result = $client->$apiaction($apiparam);
		if(!is_array($result)){
			E('远程接口错误');
		}
		/*if(!$result['sign']){
			E($result['message']?$result['message']:implode('<br>',$result));
		}*/
		return $result;
	}
}