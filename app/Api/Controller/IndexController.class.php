<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
    }
	protected $allowMethodList =    array('index','test2');
	function index($param=array()){
            echo 'ds';
		/*dump(U('Api/Lottery/getconfigs'));
		exit;
		$info = "控制器初始化";
		$array = array();
		if($param['token']=='wxczsl'){
			$array = ['sign'=>false,'message'=>'未知来源','url'=>U('Api/Index/index')];
		}
		return $array;
		return $param;*/
	}
}