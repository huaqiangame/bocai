<?php
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

error_reporting(7);

define('APP_DEBUG',true);

define('APP_PATH','./app/');
define('RUNTIME_PATH','./Runtime/');

/* 后台超级权限用户 开发时可设置 */
define('ALL_RBAC_U','');
if (ini_get('magic_quotes_gpc')) {
     function stripslashesRecursive(array $array)
     {
          foreach ($array as $k => $v) {
               if (is_string($v)) {
                    $array[$k] = stripslashes(trim($v));
               } else if (is_array($v)) {
                    $array[$k] = stripslashesRecursive($v);
               }
          }
          return $array;
     }
 
     if($_GET)$_GET = stripslashesRecursive($_GET);
     if($_POST)$_POST = stripslashesRecursive($_POST);
}
function array_safe_replace(array $array) {
	foreach ($array as $k => $v) {
	   if (is_string($v)) {
			$string = $v;
			$string = str_replace('%20','',$string);
			$string = str_replace('%27','',$string);
			$string = str_replace('%2527','',$string);
			$string = str_replace('*','',$string);
			$string = str_replace('"','&quot;',$string);
			$string = str_replace("'",'',$string);
			$string = str_replace('"','',$string);
			$string = str_replace(';','',$string);
			$string = str_replace('<','&lt;',$string);
			$string = str_replace('>','&gt;',$string);
			$string = str_replace("{",'',$string);
			$string = str_replace('}','',$string);
			$string = str_replace('\\','',$string);
			$array[$k] = $string;
	   } else if (is_array($v)) {
			$array[$k] = array_safe_replace($v);
	   }
	}
	return $array;
}
if($_GET)$_GET = array_safe_replace($_GET);
if($_POST)$_POST = array_safe_replace($_POST);
require './Core/core.php';

