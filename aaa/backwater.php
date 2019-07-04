<?php
// 绑定Home模块到当前入口文件
define('APP_DEBUG',true);
define('BIND_MODULE','Admincenter');
define('BIND_CONTROLLER','Autobackwater'); // 绑定Index控制器到当前入口文件
define('BIND_ACTION','auto_back_water');
define('APP_PATH','./app/');//
require './Core/core.php';