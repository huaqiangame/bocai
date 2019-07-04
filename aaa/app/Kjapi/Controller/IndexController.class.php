<?php
namespace Kjapi\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        //$url = M('caipiao')->select();
        $url = U('Kjapi/Caiji/getlotterylist');;
		dump($url);
    }
}