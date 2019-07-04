<?php
namespace Home\Controller;
use Think\Controller;
class ApublicController extends CommonController {
	public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
		//C('URL_MODEL',0);
		defined('APP_NAME')    or define('APP_NAME','SKYYUE');
		$this->SQL_CACHE = APP_DEBUG?false:true;

		/**加载模块函数**********************************************************/
		$Func_File = APP_PATH.MODULE_NAME.'/Common/'.strtolower(CONTROLLER_NAME).'.php';
		if(is_file($Func_File)) require $Func_File;


	}
	function reg(){
		if($_SESSION['userinfo']){
			$this->error('你已经登录,请先退出再注册');
			exit();
		}
	}
	function login(){
		if($_SESSION['userinfo']){
			$this->error('你已经登录,请到游戏大厅进行游戏',U('Index/lottery'));
		}else{
			$this->display();
		}
	}
	function mini(){
		$forward = $_REQUEST['forward'];
		$line = '';
		if(checklogin()){

			$line .= '<li><a href="'.U('Member/shoucang').'">收藏中心</a></li>';
			$line .= '<li><a href="'.U('Member/follow').'">我的关注</a></li>';
			$line .= '<li><a href="'.U('Public/logout').'"><i class="icon icon-off"></i> 退出</a></li>';

		}else{
			$line .= '<li><a href="'.U('Public/reg',array('forward'=>$forward)).'">[注册]</a></li>';
			$line .= '<li><a href="'.U('Public/login',array('forward'=>$forward)).'">[登陆]</a></li>';
		}
		echo"document.write('".$line."');";exit;
	}
	function logout(){
		session('userinfo',NULL);
		redirect(U('Agent/index'));
	}

	function logindo(){

		if(!IS_POST){echo json_encode(["sign"=>false,"message"=>"非法操作"]);exit;} //如果不是POST提交就返回FASE
		$param = I('post.');
		if(empty($param['nocode']))
		{
			if(!$param['userName'] | !$param['passWord']/*| !$param['verCode']*/){
				echo jsonreturn(["sign"=>false,"message"=>"登录信息不完整"]);
				exit;
			}
		}
/*		$verify = new \Think\Verify(['reset' => false]);
		if(!$verify->check($param['verCode'])) {
			echo jsonreturn(["sign"=>false,"message"=>"验证码错误"]);
			exit;
		}*/
		//验证用户名
		/*if(!$param['userName'] || !preg_match("/^[a-zA-Z][a-zA-Z\d]{4,12}$/",$param['userName'])){
			$return = [];
			$return['sign']    = false;
			$return['message'] = '请输入4-12位的用户名,必须以字母开通头!';
			echo jsonreturn($return);exit;
		}*/
		if(!$param['userName'] || strlen($param['userName'])<3){  //如果用户名不存在 或 少于3位则返回错误
			$return = [];
			$return['sign']    = false;
			$return['message'] = '请输入正确用户名!';
			echo jsonreturn($return);exit;
		}
		if(!$param['passWord']&& !preg_match("/^[\w\W]{6,16}$/",$param['passWord'])){ //验证密码
			$return = [];
			$return['sign']    = false;
			$return['message'] = '请输入6-16位的登陆密码';
			echo jsonreturn($return);exit;
		}
		$data = [];
		$data['username'] = $param['userName'];
		$data['password'] =  $param['passWord'];
		$data['nocode'] = $param['nocode'];
		$data['loginip']  = get_client_ip();
		$data['source']   = 'pc';
		$apiparam=array();
		$apiparam['data'] = $data;
		$_api = new \Lib\api;
		$Result = [];
		$Result = $_api->sendHttpClient('Api/Member/signin',$apiparam);
		if(is_array($Result) && $Result['sign']==true){
			$return['sign']    = true;
			$return['message'] = '登陆成功';
			//保存登陆信息
			if($Result['auth']['member_auth_id'] && $Result['auth']['member_sessionid']){
				session('member_sessionid',$Result['auth']['member_sessionid']);
				session('member_auth_id',$Result['auth']['member_auth_id']);

				$okamountcount = M('touzhu')->where("isdraw=1 AND uid='{$Result['auth']['member_auth_id']}' ")->SUM('okamount');
				$k3names = M('touzhu')->distinct ( true )->where ("uid='{$Result['auth']['member_auth_id']}' ")->field ( 'cptitle,cpname' )->limit(8)->select();
				session("okamountcount",$okamountcount);
				session("k3names",$k3names);
				$return['data']['islogin'] = '1';
			} 
			$this->ajaxReturn($return);exit;
		}else{
			$Result['sign']    = false;
			$Result['message'] = $Result['message']?$Result['message']:'登陆失败';
			echo jsonreturn($Result);exit;
		}
		exit;

	}
	function regdo(){
		if(!IS_POST)$this->error('非法操作');
		if(!$_POST['userName'] || !$_POST['passWord'] || !$_POST['verCord'] || !$_POST['qpassWord']){
			$this->error('注册信息不完整');
		}
		$verify = new \Think\Verify();
		if(!$verify->check($_POST['verCord'])) {
			$this->error('验证码错误！');
			exit;
		}
		if(!preg_match('/^([a-zA-Z0-9]|[_]){3,16}$/',$_POST['userName'])){
			$this->error('用户名格式：3-16位英文与数字或下划线组合的字符！');
		}
		if(!preg_match('/^[\w\W]{6,16}$/',$_POST['passWord'])){
			$this->error('密码请输入6到16位字符串！');
		}
		$data['username'] = $_POST['userName'];
		$defreggroup = M('membergroup')->where("isagent=1 and isdefautreg=1")->getField('groupid');
		$data['groupid']  = $defreggroup?$defreggroup:0;
		$data['password'] = $_POST['passWord'];

		$data['balance']   = 0;
		$data['point']   = 0;
		$data['regtime'] = NOW_TIME;
		$data['regip']   = get_client_ip();
		if($data['password']!=$_POST['qpassWord']){
			$this->error('两次密码输入不一致');
		}
		$count = M('member')->where(array('regip'=>$regip))->count();
		if($count>3){
			$this->error('相同IP最多只能注册3个账户');
		}
		if(M('member')->where(array('username'=>$data['username']))->count()){
			$this->error('用户名已存在！');
		}
		/*if(GetVar('isregtjm')!=0){
			$tid = $_POST['codes'];
			if(!$tid || !$_tid = M('member')->where("id=".$tid)->getField('id')){
				$this->error('推荐码不存在！');
			}
			$data['tgid']    = $_tid;
		}*/
		$data['logintime'] = 0;
		$data['loginip']   = '';
		$data['password'] = sys_md5($data['password']);
		$data['proxy'] = 1; 
		$int = M('member')->data($data)->add();
		$int?$this->success('注册成功',U('Apublic/login')):$this->error('注册失败');
	}
	static function _before_reg_getkey(){
		$key = '';
		$fields = M('member')->getDbFields();
		if(in_array('key',$fields)){
			$key = rand_string(8);
			$haskey = M('member')->where(array('key'=>$key))->getField('id');
			if($haskey){
				$key = self::_before_reg_getkey();
			}
		}
		return $key;
	}
	function verify(){
		$config =    array(
			'fontSize'    =>    17,    // 验证码字体大小
			'length'      =>    4,     // 验证码位数
			'useNoise'    =>    false, // 关闭验证码杂点
			'imageW'      =>    150,
			'imageH'      =>    35,
			'fontttf'     =>    '5.ttf'
		);
		$Verify = new \Think\Verify($config);
		$Verify->codeSet = '123456789';
		$Verify->entry();
	}
	public function _empty(){
		send_http_status(404);
		$this->display('Public:404');
	}
	function checkusername(){
		$name  = I('name');
		$param = I('param');
		$info = M('member')->where(array('username'=>$param))->find();
		if($info){

			$status = 'n';
			$info = "抱歉！此用户名已存在！";
		}else{
			$status = 'y';
			$info = "验证通过！";
		}
		echo json_encode(array('status'=>$status,'info'=>$info));
	}


}
?>