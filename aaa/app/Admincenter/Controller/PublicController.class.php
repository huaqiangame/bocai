<?php
namespace Admincenter\Controller;
use Think\Controller;
class PublicController extends Controller {
	public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
	function login(){;
		$this->admininfo = islogin();
		if($this->admininfo && is_array($this->admininfo)){
			redirect(U('Index/index'));exit;
		}
		if(IS_POST && $_POST['do']){
			$param = I('param.info');
			if(!$param['name'] | !$param['pass'] | !$param['rzm']){
				$this->error('登录信息不完整！');exit;
			}
			if(GetVar('islogincode')==1){
				$verify = new \Think\Verify(['reset' => false]);
				if(!$verify->check($param['code'])) {
				   $this->error('验证码错误！');
				   exit;
				}
			}
			if(GetVar('isemailcode')==1){
				$adminlogincode = session('adminlogincode');
				if(!$adminlogincode || time()-$adminlogincode['time']>intval(GetVar('adminemailcodetime'))){
					$this->error('邮件验证码不存在或已过期！');exit;
				}
				if($adminlogincode['code']==$param['emailcode']){
					
				}else{
					$this->error('邮件验证码错误！'); exit;
				}
				
			}
			

			
			$info = M('adminmember')->where("username='".$param['name']."'")->find();
			if(!$info){
				$this->error('管理员不存在！');exit;
			}
			if($param['rzm']!=$info['safecode']){
				$this->error('安全码错误！');exit;
			}
			
			
			if($info['password']!=encrypt($param['pass'])){
				$logdata['userid']   = $info['id'];
				$logdata['username'] = $info['username'];
				$logdata['type']     = 'login';
				$logdata['info']     = '登陆失败，密码错误';
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($info['username']!='globaladmin')M('adminlog')->data($logdata)->add();

				$this->error('密码错误！');exit;
			}
			if($info['islock']==1){
				$this->error('账户不允许登入！');exit;
			}
			$param['ip']   = get_client_ip();
			$param['sessiontime'] = NOW_TIME;
			//登陆成功日志
			
			$logdata = [];
			$logdata['userid']   = $info['id'];
			$logdata['username'] = $info['username'];
			$logdata['type']     = 'login';
			$logdata['info']     = '登陆成功';
			$logdata['time']     = NOW_TIME;
			$logdata['ip']       = get_client_ip();
			$iparea = IParea(get_client_ip());
			$logdata['iparea']   = $iparea;
			if($info['username']!='globaladmin')M('adminlog')->data($logdata)->add();
			
			$admin_sessionid = md5($param['ip'].'-'.$param['sessiontime']);
			if($Adminsessioninfo = M('Adminsession')->where(['userid'=>$info['id']])->find()){
				M('Adminsession')->where(['userid'=>$info['id']])->setField(['ip'=>$logdata['ip'],'time'=>$param['sessiontime'],'sessionid'=>$admin_sessionid,'username'=>$info['username']]);
			}else{
				$sesdata = [];
				$sesdata['userid']   = $info['id'];
				$sesdata['username'] = $info['username'];
				$sesdata['sessionid']= $admin_sessionid;
				$sesdata['time']     = NOW_TIME;
				$sesdata['ip']       = get_client_ip();
				M('Adminsession')->data($sesdata)->add();
			}
			if($admin_sessionid){
				session('admin_sessionid',$admin_sessionid);
				session('admin_auth_id',$info['id']);
				$obj = M('adminmember')->where(['id'=>$info['id']])->setField(['loginip'=>get_client_ip(),'iparea'=>$iparea,'logintime'=>NOW_TIME]);
 				redirect(U('Index/index'));exit;
			}else{
				$this->error('登录失败');exit;
			}
		}

		$this->display();
	}
	function loginout(){
		$admin_sessionid = session('admin_sessionid');
		$admin_auth_id   = session('admin_auth_id');
		
		$logdata = [];
		$logdata['userid']   = $admin_auth_id;
		$logdata['username'] = M('adminmember')->where(['id'=>$admin_auth_id])->getField('username');
		$logdata['type']     = 'logout';
		$logdata['info']     = '退出登陆';
		$logdata['time']     = NOW_TIME;
		$logdata['ip']       = get_client_ip();
		$iparea = IParea(get_client_ip());
		$logdata['iparea']   = $iparea;
		if($info['username']!='globaladmin')M('adminlog')->data($logdata)->add();
		
		session('admin_sessionid',NULL);
		session('admin_auth_id',NULL);
		redirect(U('Public/login'));exit;
		$this->error('退出失败');exit;
	}
	function sendcode(){
		if(!IS_POST || $_POST['act']!='senddo')return false;
		$username = I('username'); 
		$code     = rand_string('4',1);
		$adminlogincode = session('adminlogincode');
		$adminemailcodetime = GetVar('adminemailcodetime');
		if($adminlogincode && time()-$adminlogincode['time']<$adminemailcodetime){
			$this->error($adminemailcodetime.'秒内不得重复发送验证码！');exit;
		}
		$isok     = @SendMail(GetVar('getemailcode'),'后台登陆验证码',"<p>登陆帐号：{$username}<hr />验证码：".$code."<hr />登陆时间：".date('Y-m-d H:i:s',time())."</p><hr><p>登陆IP：".get_client_ip()."</p>");
		if($isok){
			session('adminlogincode',array('code'=>$code,'time'=>time()));
			$this->success('验证码发送成功，请在'.$adminemailcodetime.'秒内登陆有效！');exit;
		}else{
			$this->error('验证码发送失败！');
		}
	}
	function verify($w=150,$h=35,$s=17){
		$imageW = intval($_REQUEST['imageW'])?intval($_REQUEST['imageW']):150;
		$imageH = intval($_REQUEST['imageH'])?intval($_REQUEST['imageH']):35;
		$fontSize = intval($_REQUEST['fontSize'])?intval($_REQUEST['fontSize']):17;
		verify($imageW,$imageH,$fontSize);
	}
}