<?php
namespace Kjapi\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
    }
}