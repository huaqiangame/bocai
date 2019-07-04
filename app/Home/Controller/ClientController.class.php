<?php
namespace Home\Controller;
use Think\Controller;
class ClientController extends CommonController {

    public function __construct(){
		parent::__construct();
	}

	function index(){
		//dump(intval(0.8));exit;
		$this->display('Client');
	}
}
?>