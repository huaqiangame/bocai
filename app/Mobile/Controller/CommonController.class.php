<?php
namespace Mobile\Controller;
use Think\Controller;
class CommonController extends Controller {
    public $userinfo;
    public function _initialize(){
        $banCountry = C('bancountry');
        /*$banCountry = empty($banCountry) ? array() : json_decode($banCountry);
        $ipInfo = json_decode(getIpAddress(get_client_ip()));
        if(!empty($banCountry) && !empty($ipInfo) && in_array($ipInfo->country_id,$banCountry)){
            header("http/1.1 403 Forbidden");
            exit;
        }*/
        
       if($_SESSION['userinfo']){
		   if(empty($_SESSION['userinfo']['groupid'])){
			   changeusergroup($_SESSION['userinfo']['id']);
		   }
	   }
		header("Content-type: text/html; charset=utf-8");
        //公告列表
        if(empty($_COOKIE['showgg'])){
            cookie("showgg",1);
        }
		//适配跳转
	$_DOMAIN_DEPLOY = C('APP_SUB_DOMAIN_DEPLOY');
		$_IS_MOBILE = is_mobile();
		$_BaseDomain = getBaseDomain($_SERVER['SERVER_NAME']);
		foreach(C('APP_SUB_DOMAIN_RULES') as $k=>$v){
			$_SUBDOMAINS[strtolower($v)][strtolower($k)] = strtolower($k);
		}
		if($_DOMAIN_DEPLOY && !$_IS_MOBILE && count($_SUBDOMAINS['home'])>=1){
			$_ROOT_DOMAIN = $_BaseDomain;
			$_WWW_DOMAIN = 'www.'.$_BaseDomain;
			if($_SUBDOMAINS['home'][$_ROOT_DOMAIN]){
				redirect('http://'.$_ROOT_DOMAIN);
				exit;
			}
			if($_SUBDOMAINS['home'][$_WWW_DOMAIN]){
				redirect('http://'.$_WWW_DOMAIN);
				exit;
			}
			$_DEFAULT_DOMAIN = $_SUBDOMAINS['home'];
			sort($_SUBDOMAINS['home']);
			if($_SUBDOMAINS['home'][0]){
				redirect('http://'.$_SUBDOMAINS['home'][0]);
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
		//
		if($userinfo = islogin()){
			$this->userinfo = $userinfo['data'];
		}
		//全局使用
		$_k3list = C('cplist.k3');
		$opencodes = F('opencodes');
		$k3list = [];
		foreach($_k3list as $k=>$v){
			if($v['isopen']==0)unset($_k3list[$k]);
			$v['expect'] = $opencodes[$k]['expect'];
			$v['opencode'] = $opencodes[$k]['opencode'];
			$k3list[] = $v;
		}
		$this->globalk3list = $k3list;
		
		$WebConfigs['webtitle'] = C('webtitle');
		$WebConfigs['kefuthree'] = C('kefuthree');
		$WebConfigs['kefuqq'] = C('kefuqq');
		$this->WebConfigs = $WebConfigs;

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