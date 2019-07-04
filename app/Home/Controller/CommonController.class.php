<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public  $userinfo;

    public function _initialize(){
        /*  $banCountry = C('bancountry');
         $banCountry = empty($banCountry) ? array() : json_decode($banCountry);
        $ipInfo = json_decode(getIpAddress(get_client_ip()));
         if(!empty($banCountry) && !empty($ipInfo) && in_array($ipInfo->country_id,$banCountry)){
             header("http/1.1 403 Forbidden");
             exit;
         }*/
       if($_SESSION['userinfo']){
		   if($_SESSION['userinfo']){
			   changeusergroup($_SESSION['userinfo']['id']);
		   }
	   }
		header("Content-type: text/html; charset=utf-8");
		//适配跳转
		$_DOMAIN_DEPLOY = C('APP_SUB_DOMAIN_DEPLOY');  //返回1
		$_IS_MOBILE = is_mobile();  //判断是否是移动设备

		$_BaseDomain = getBaseDomain($_SERVER['SERVER_NAME']);  //获取当前域名
		foreach(C('APP_SUB_DOMAIN_RULES') as $k=>$v){
			$_SUBDOMAINS[strtolower($v)][strtolower($k)] = strtolower($k);
		}
		if($_DOMAIN_DEPLOY && $_IS_MOBILE && count($_SUBDOMAINS['mobile'])>=1){
			$_H5_DOMAIN = 'h5.'.$_BaseDomain;
			$_M_DOMAIN = 'm.'.$_BaseDomain;
			$_M2_DOMAIN = 'm2.'.$_BaseDomain;
			$_WAP_DOMAIN = 'wap.'.$_BaseDomain;
			if($_SUBDOMAINS['mobile'][$_H5_DOMAIN]){
				redirect('http://'.$_H5_DOMAIN);
				exit;
			}
			if($_SUBDOMAINS['mobile'][$_M_DOMAIN]){
				redirect('http://'.$_M_DOMAIN);
				exit;
			}
			if($_SUBDOMAINS['mobile'][$_M2_DOMAIN]){
				redirect('http://'.$_M2_DOMAIN);
				exit;
			}
			if($_SUBDOMAINS['mobile'][$_M_DOMAIN]){
				redirect('http://'.$_WAP_DOMAIN);
				exit;
			}
			$_MOBILE_DOMAIN = $_SUBDOMAINS['mobile'];
			sort($_SUBDOMAINS['mobile']);
			if($_SUBDOMAINS['mobile'][0]){
				redirect('http://'.$_SUBDOMAINS['mobile'][0]);
				exit;
			}
		}
		
		$configfile = CONF_PATH . 'webconfig.php';
		$_t = time();
		if(!is_file($configfile) || $_t-filemtime($configfile)>300){
			$apiparam=array();
			$_api = new \Lib\api;
			$configs = $_api->sendHttpClient('Api/Lottery/getconfigs',$apiparam);
			if($configs['sign']==true){
				$int = file_put_contents($configfile,"<?php\n return ".var_export($configs['configs'],TRUE).";");
			}
		}
		self::getopencode();
		//黑名单/白名单
		$CustomerIp = get_client_ip();
		$ipblackisopen = C('ipblackisopen');
		$ipblacklist   = array_filter(explode(',',C('ipblacklist')));
		if($ipblackisopen==1 && $ipblacklist){
			if(in_array($CustomerIp,$ipblacklist)){
				send_http_status(403);
				$this->display('./403.html');
				exit;
			}
		}
		$ipwhiteisopen = C('ipwhiteisopen');
		$ipwhitelist   = array_filter(explode(',',C('ipwhitelist')));
		if($ipwhiteisopen==1 && $ipwhitelist){
			if(!in_array($CustomerIp,$ipwhitelist)){
				header("Location: ./weihu.html");
				exit;
			}
		}
		$webconfigs['webtitle'] = C('webtitle');
		$webconfigs['kefuthree'] = C('kefuthree');
		$webconfigs['kefuqq'] = C('kefuqq');
		$this->assign('webconfigs',$webconfigs);
		$gglist = M('Gonggao')->order("id DESC")->select();
		//公告列表
		if(empty($_COOKIE['showgg'])){
			cookie("showgg",1);
		}
		$this->assign('gglist',$gglist);
		if($userinfo = islogin()){
			$this->userinfo;
            $this->assign('user_proxy',$_SESSION['userinfo']['user_proxy']);
		}
	}
     function closegg(){
         cookie("showgg",2,array('expire'=>0));
	 }
	protected function getopencode(){
		$opencodefile = DATA_PATH . 'opencodes.php';
		$_t = time();
		if(!is_file($opencodefile) || $_t-filemtime($opencodefile)>300){
			$apiparam=array();
			$_api = new \Lib\api;
			$returns = $_api->sendHttpClient('Api/Lottery/getopencodes',$apiparam);
			if($returns['sign']==true && $returns['opencodes']){
				F('opencodes',$returns['opencodes']);
			}
		}
	}
}