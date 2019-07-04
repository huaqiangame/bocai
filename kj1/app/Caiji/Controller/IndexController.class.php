<?php
namespace Caiji\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
    public function index(){
		$m = date('Y-m-d', mktime(0,0,0,date('m')-1,1,date('Y')));
		$tdays = date('t',strtotime($m));
		dump($tdays);exit;
		exit('welcome!!!');
	}
}