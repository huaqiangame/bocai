<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends CommonController {
	public function __construct(){
		parent::__construct();
	}
	function register(){
		if(IS_POST){
			$post = I('post.');
			if(isset($post['reccode']) && is_numeric($post['reccode'])){
				$apiparam=array();
				$apiparam['where'] = ['uid'=>$post['reccode']];
				$_api = new \Lib\api;
				$Result = $_api->sendHttpClient('Api/Member/getuserinfo',$apiparam);
				if($Result['sign']==false){
					unset($Result['data']);
					$Result['sign']    = false;
					$Result['message'] = '推荐码验证失败';
					echo jsonreturn($Result);exit;
				}
				if($Result['sign']==false){
					unset($Result['data']);
					$Result['sign']    = false;
					$Result['message'] = '推荐码验证失败';
					echo jsonreturn($Result);exit;
				}
				if($Result['data']['proxy']!=1){
					unset($Result['data']);
					$Result['sign']    = false;
					$Result['message'] = '推荐码无效';
					echo jsonreturn($Result);exit;
				}
			}
			
			//验证密码
			if(!$post['password'] || !preg_match("/^[\w\W]{6,16}$/",$post['password'])){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '请输入6-16位的密码';
				echo jsonreturn($Result);exit;
			}
			if(!$post['cpassword'] && !preg_match("/^[\w\W]{6,16}$/",$post['cpassword'])){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '请输入6-16位的重复密码';
				echo jsonreturn($Result);exit;
			}
			if($post['cpassword']!=$post['password']){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '两次密码输入不一致';
				echo jsonreturn($Result);exit;
			}
			if(!$post['tradepassword'] || !preg_match("/^[\w\W]{6,16}$/",$post['tradepassword'])){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '请输入6-16位的资金密码';
				echo jsonreturn($Result);exit;
			}
			
			// qq、tel验证
			if(isset($post['qq'])){
				if(!preg_match("/^[1-9][0-9]{4,9}$/",$post['qq'])){
					$Result = [];
					$Result['sign']    = false;
					$Result['message'] = '请输入5-10位的QQ号码';
					echo jsonreturn($Result);exit;
				}
			}
			if(isset($post['tel'])){
				if(!preg_match("/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/",$post['qq'])){
					$Result = [];
					$Result['sign']    = false;
					$Result['message'] = '请输入正确的手机号码!';
					echo jsonreturn($Result);exit;
				}
			}
			//验证用户名
			if(!$post['username'] || !preg_match("/^[a-zA-Z][a-zA-Z\d]{4,12}$/",$post['username'])){
					$Result = [];
					$Result['sign']    = false;
					$Result['message'] = '请输入4-12位的用户名,必须以字母开通头!';
					echo jsonreturn($Result);exit;
			}
			$apiparam=array();$Result=array();
			$apiparam['username'] = $post['username'];
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Member/checkuername',$apiparam);
			if(!$Result || $Result['sign']==false){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = $Result['message']?$Result['message']:'注册用户名验证失败';
				echo jsonreturn($Result);exit;
			}
			if($Result['data']['ishas']==1){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '用户名已被注册';
				echo jsonreturn($Result);exit;
			}
			
			$data = [];
			$ip = get_client_ip();
			$data['username'] = $post['username'];
			$data['parentid'] = $post['reccode'];
			$data['password'] = $post['password'];
			$data['tradepassword'] = $post['tradepassword'];
			$data['qq'] = $post['qq'];
			$data['tel'] = $post['tel']?$post['tel']:'';
			$data['proxy'] = (isset($post['proxy']) && in_array($post['proxy'],[1,0]))?intval($post['proxy']):0;
			$data['isnb'] = 0;
			$data['regip'] = $ip;
			$data['source'] = 'PC版注册';
			$data['regtime'] = time();
			
			$apiparam=array();
			$apiparam['data'] = $data;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Member/register',$apiparam);
			if(is_array($Result) && $Result['sign']==true && $Result['data']['regisok']==1){
				$return['sign']    = true;
				$return['message'] = '注册成功';
				//保存登陆信息
				if($Result['auth']['member_auth_id'] && $Result['auth']['member_sessionid']){
					session('member_sessionid',$Result['auth']['member_sessionid']);
					session('member_auth_id',$Result['auth']['member_auth_id']);
					$return['islogin'] = '1';
				}
				echo jsonreturn($return);exit;
			}else{
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = $Result['message']?$Result['message']:'注册失败';
				echo jsonreturn($Result);exit;
			}
			exit;
		}
		$this->display();
	}
	function LoginDo(){
		if(!IS_POST){echo json_encode(["sign"=>false,"message"=>"非法操作"]);exit;}
		$param = I('post.');
		if(!$param['name'] | !$param['pass'] | !$param['code']){
		   echo jsonreturn(["sign"=>false,"message"=>"登录信息不完整"]);
		   exit;
		}
		$verify = new \Think\Verify(['reset' => false]);
		if(!$verify->check($param['code'])) {
		   echo jsonreturn(["sign"=>false,"message"=>"验证码错误"]);
		   exit;
		}
		//验证用户名
		if(!$param['name'] || !preg_match("/^[a-zA-Z][a-zA-Z\d]{4,12}$/",$param['name'])){
			$return = [];
			$return['sign']    = false;
			$return['message'] = '请输入4-12位的用户名,必须以字母开通头!';
			echo jsonreturn($return);exit;
		}
		if(!$param['pass'] && !preg_match("/^[\w\W]{6,16}$/",$param['pass'])){
			$return = [];
			$return['sign']    = false;
			$return['message'] = '请输入6-16位的登陆密码';
			echo jsonreturn($Result);exit;
		}
		$data = [];
		$data['username'] = $param['name'];
		$data['password'] = $param['pass'];
		$data['loginip']  = get_client_ip();
		$apiparam=array();
		$apiparam['data'] = $data;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/signin',$apiparam);
		//dump($Result);
		if(is_array($Result) && $Result['sign']==true){
			$return['sign']    = true;
			$return['message'] = '登陆成功';
			//保存登陆信息
			if($Result['auth']['member_auth_id'] && $Result['auth']['member_sessionid']){
				session('member_sessionid',$Result['auth']['member_sessionid']);
				session('member_auth_id',$Result['auth']['member_auth_id']);
				$return['data']['islogin'] = '1';
			}
			echo jsonreturn($return);exit;
		}else{
			$Result = [];
			$Result['sign']    = false;
			$Result['message'] = $Result['message']?$Result['message']:'登陆失败';
			echo jsonreturn($Result);exit;
		}
		exit;
		
	}
	function LoginOut(){
		session(null);
		redirect('/');
	}
	function verify(){
		$imageW = intval($_REQUEST['imageW'])?intval($_REQUEST['imageW']):150;
		$imageH = intval($_REQUEST['imageH'])?intval($_REQUEST['imageH']):35;
		$fontSize = intval($_REQUEST['fontSize'])?intval($_REQUEST['fontSize']):17;
		verify($imageW,$imageH,$fontSize);
	}

}
?>