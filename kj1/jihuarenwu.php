<?php
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');



define('APP_DEBUG',false);

define('APP_PATH','./app/');
define('RUNTIME_PATH','./Runtime/');
define('DATA_PATH','./JIHUADATA/');

define('BIND_MODULE','Jihua');
define('BIND_CONTROLLER','Jihuabase');
define('BIND_ACTION','checkjihua');

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
 
     $_GET = stripslashesRecursive($_GET);
     $_POST = stripslashesRecursive($_POST);
}
require './Core/Core.php';

