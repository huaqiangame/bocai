<?php
//公共接口文件
namespace Lib;
use Think\Controller\HproseController;
class api{
    //private $fp;
	//token验证
	
	//发送请求
	// Clienturl 完整请求地址 ( 到方法 不包含http的网关 ) Home/Member/aaa
	// apiparam  传递的参数（数组）
	// apiparam  传递的参数（数组）
	function sendHttpClient($Clienturl='',$apiparam=array()){
		/*if(!is_file('./shouquan.php.lotterysoft')){
			echo'授权文件不存在';exit;
		}

		$qucontent = str_replace(PHP_EOL,'',file_get_contents("./shouquan.php.lotterysoft"));
		$shouquans = explode('###',$qucontent);
		$_host = str_replace('http://','',rtrim($shouquans[1],'/'));
		$_hosto = $_host . 'zezhihahaha';
		$_tokken0 = $shouquans[0];
		$_tokken1 = strtoupper(md5(sha1($_hosto)));
		if($_tokken0!=$_tokken1){
			echo $_host.'授权文件无法识别';exit;
		}
		$apitoten = $_tokken0;
		
		//网关地址
		$apiurl   = 'http://'.$_host.'/';
		*/
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
		if(substr($apiurl,-1)!='/'){
			$apiurl = $apiurl . '/';
		}
		$Clienturl = $apiurl . $_Clienturls[0].'/'.$_Clienturls[1];
		$apiaction = $_Clienturls[2];
		//$apiparam['apitoten']  = $apitoten;
		//$apiparam['server_ip']  = self::get_server_ip();
		//dump(R($_Clienturls[0].'/'.$_Clienturls[1].'/'.$_Clienturls[2],$apiparam));dump($_Clienturls);exit;
		/*vendor('Hprose.HproseHttpClient');
		$client   = new \HproseHttpClient($Clienturl);
		$result = $client->$apiaction($apiparam);
		if(!is_array($result)){
			E('远程接口错误');
		}*/
		/*if(!$result['sign']){
			E($result['message']?$result['message']:implode('<br>',$result));
		}
		if(!$this->debug)foreach($result as $k=>$v){
			if(!in_array($k,['sign','data','message','auth'])){
				unset($result[$k]);
			}
		}*/
		$_OBJ = A($_Clienturls[0].'/'.$_Clienturls[1]);
		$result = $_OBJ->$apiaction($apiparam);
//		exit(dump($_OBJ));
		unset($result['server_ip']);
		return $result;
	}
	protected function get_server_ip() { 
		if (isset($_SERVER)) { 
			if($_SERVER['SERVER_ADDR']) {
				$server_ip = $_SERVER['SERVER_ADDR']; 
			} else { 
				$server_ip = $_SERVER['LOCAL_ADDR']; 
			} 
		} else { 
			$server_ip = getenv('SERVER_ADDR');
		} 
		return $server_ip; 
	}
}