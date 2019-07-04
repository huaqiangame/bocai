<?php
//放配置
namespace Common\Controller;
use Think\Controller;
class ConfigController extends Controller {
	//token验证
	protected $apitoten = '96C6852611F0244E988B8AA20F61071C';
	
	//网关地址
	protected $apiurl   = 'http://127.0.0.56/';
}