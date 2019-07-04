<?php
namespace Caiji\Controller;
use Think\Controller;
class CaijiController extends Controller {
	public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
	function apicaiji($totalzxnum=0){
		_title();
		//if(!IS_CLI)exit('IS NOT CMD_CLI,ERROR...');
		$caijisets = unserialize(GetVar('caijiset'));
		include(COMMON_PATH.'Lib/apiurls.php');
		$dir = COMMON_PATH. 'Lib/apicaiji'; 
		$filelist = listAllFiles($dir);
		rsort($filelist);
		$apis = array();
		foreach($filelist as $k=>$v){
			$basename = basename($v);
			$name = substr($basename,0,strpos($basename,'.'));
			if(!strstr($name,'k3')){
				if(strpos($basename,'.class.php')!=false && $caijisets[$name]){
					$apis[$name] = "\\Lib\\apicaiji\\{$name}";
				}
			}
		}
		$caijieapiurl = GetVar('caijieapiurl');
		foreach($apis as $k=>$api){
			$return  = '';
			if (!class_exists(basename($k),false) && $url = $apiurls[$k]) {
				$class = "{$api}";
				$_obj  = new $class($caijieapiurl.$url);// 声明一个开奖类
				$return = $_obj->getopencode();
				//$return  = "{$_obj->title}----{$return}\n<br>";
 				$return  = auto_charset("{$return}\n",'utf-8','gbk');
 				_p($_obj->title,$return);
				unset($_obj);
			}
		  }
		$totalzxnum++;
		 sleep(3);
		 ob_clean();
		/* if($totalzxnum<=120) */	self::apicaiji($totalzxnum);

	}
	function apicaijik3($totalzxnum=0){
		_title();
		//if(!IS_CLI)exit('IS NOT CMD_CLI,ERROR...');
		$caijisets = unserialize(GetVar('caijiset'));
		include(COMMON_PATH.'Lib/apiurls.php');
		$dir = COMMON_PATH. 'Lib/apicaiji';
		$filelist = listAllFiles($dir);
		$apis = array();
		foreach($filelist as $k=>$v){
			$basename = basename($v);
			$name = substr($basename,0,strpos($basename,'.'));
			 if(strstr($name,'k3')){
				 if(strpos($basename,'.class.php')!=false && $caijisets[$name]){
					 $apis[$name] = "\\Lib\\apicaiji\\{$name}";
				 }
			 }
		}
		$caijieapiurl = GetVar('caijieapiurl');
		foreach($apis as $k=>$api){
			$return  = '';
			if (!class_exists(basename($k),false) && $url = $apiurls[$k]) {
				$class = "{$api}";
				$_obj  = new $class($caijieapiurl.$url);// 声明一个开奖类
				$return = $_obj->getopencode($ApiParam);

				$return  = auto_charset("{$return}\n",'utf-8','gbk');
				_p($_obj->title,$return);
				unset($_obj);
			}
		}
		$totalzxnum++;
		 sleep(3); 
		/* if($totalzxnum<=120) */	self::apicaijik3($totalzxnum);


	}
	function xitongcaiji($totalzxnum=0){
		_title("系统彩采集开始");
//		if(!IS_CLI)exit('IS NOT CMD_CLI,ERROR...');
		$caijisets = unserialize(GetVar('caijiset'));
		include(COMMON_PATH.'Lib/xitongurls.php');
		$dir = COMMON_PATH. 'Lib/xitongcaiji';
		$filelist = listAllFiles($dir);
		$apis = array();
		foreach($filelist as $k=>$v){
			$basename = basename($v);
			$name = substr($basename,0,strpos($basename,'.'));
			if(strpos($basename,'.class.php')!=false && $caijisets[$name]){
				$apis[$name] = "\\Lib\\xitongcaiji\\{$name}";

			}
		}
		foreach($apis as $k=>$api){
			$return  = '';
			if (!class_exists(basename($k),false) && $url = $xitongurls[$k]) {
				$class = "{$api}";
				$_obj  = new $class(APP_URL.$url);
				$return = $_obj->getopencode();

				$return  = auto_charset("{$return}\n",'utf-8','gbk');
				_p($_obj->title,$return);
				unset($_obj);
			}
//			echo $return;
		}
		echo auto_charset("休眠3S\n",'utf-8','gbk');
		sleep(3);
		$totalzxnum++;
		/*if($totalzxnum<=4)*/self::xitongcaiji($totalzxnum);
	}



	protected function delete3dayskj(){
		$deletetime = strtotime(date('Y-m-d',time()))-86400*3;
		$INT = M('kaijiang')->where(['addtime'=>['elt',$deletetime]])->delete();
		return $INT;
	}
}