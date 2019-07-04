<?php
namespace Kaijiang\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		dump(M('kaijiang')->limit(10)->select());
        $this->show('<style type="text/css">*{ padding: 0; margin: 0 auto; text-align:center; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <p>欢迎使用 <b>泽华软件彩票系统</b>！</p><br/>版本 V 1.0</div>','utf-8');
    }
}