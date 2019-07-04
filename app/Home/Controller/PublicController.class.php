<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends CommonController {
	public $linkinfo = null;
	public function __construct(){
		parent::__construct();
	}

	function login(){ 
		if($_SESSION['userinfo']){
			$this->error('你已经登录,请到游戏大厅进行游戏',U('Index/lottery'));
		}else{
			$this->display();
		}

	}
	function register(){
		if($_SESSION['userinfo']){
			$this->error('你已经登录,请先退出再注册',U(CONTROLLER_NAME/ACTION_NAME));
			exit();
		}
		$linkid = I('linkid',0,'intval');
		$tgid   = I('tgid',0,'intval');
		if($linkid){
			$agentlinkpath = RUNTIME_PATH .'/agentlink/';
			$file = $agentlinkpath . $linkid .'.php';
			$_t = time();
			if(!is_file($file) || $_t-filemtime($file)>3600){
				$apiparam=array();
				$apiparam['linkid'] = $linkid;
				$_api = new \Lib\api;
				$returnlink = $_api->sendHttpClient('Api/Member/getagentlink',$apiparam);
				if($returnlink['sign']==true && $returnlink['linkinfo']){
					$linkinfo = $returnlink['linkinfo'];
					$this->linkinfo  = $linkinfo;
					F($linkinfo['id'],$linkinfo,$agentlinkpath );
					cookie('tgid',$linkinfo['uid']);
					$this->assign('linkinfo',$linkinfo);
				}
			}else{;
				$linkinfo = F($linkid,'',$agentlinkpath );
				$this->linkinfo  = $linkinfo;
				if($linkinfo){
					cookie('tgid',$linkinfo['uid']);
					$this->assign('linkinfo',$linkinfo);
				}
			}
		}
		if($tgid){
			cookie('tgid',$tgid);
		}
		if(cookie('tgid')){
			$this->assign('tgid',cookie('tgid'));
		}
		if(IS_POST){
			$post = I('post.');
                                       if (!$post['reccode']) {
                    $Result['sign'] = false;
                    $Result['message'] = '推荐码不能空';
                    $this->ajaxReturn($Result);
                    exit;
                }
			if(isset($post['reccode']) && is_numeric($post['reccode'])){
				$apiparam=array();
				$apiparam['where'] = ['uid'=>$post['reccode']];
				$_api = new \Lib\api;
				$Result = $_api->sendHttpClient('Api/Member/getuserinfo',$apiparam);
				if($Result['sign']==false){
					unset($Result['data']);
					$Result['sign']    = false;
					$Result['message'] = '推荐码验证失败';
					cookie('tgid',NULL);
					$this->ajaxReturn($Result);exit;
				}
				if($Result['sign']==false){
					unset($Result['data']);
					$Result['sign']    = false;
					$Result['message'] = '推荐码验证失败';
					cookie('tgid',NULL);
					$this->ajaxReturn($Result);exit;
				}
				if($Result['data']['proxy']!=1){
					unset($Result['data']);
					$Result['sign']    = false;
					$Result['message'] = '推荐码无效';
					cookie('tgid',NULL);
					$this->ajaxReturn($Result);exit;
				}
			}

			//验证密码
			if(!$post['password'] || !preg_match("/^[\w\W]{6,16}$/",$post['password'])){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '请输入6-16位的密码';
				$this->ajaxReturn($Result);exit;
			}
			if(!$post['cpassword'] && !preg_match("/^[\w\W]{6,16}$/",$post['cpassword'])){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '请输入6-16位的重复密码';
				$this->ajaxReturn($Result);exit;
			}
			if($post['cpassword']!=$post['password']){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '两次密码输入不一致';
				$this->ajaxReturn($Result);exit;
			}
			/*if($_POST['rpassword'][0]==$_POST['rpassword'][1] && $_POST['rpassword'][0]==$_POST['rpassword'][2] && $_POST['rpassword'][1]==$_POST['rpassword'][2]){
 				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '提款密码不能全部都相同';
				echo jsonreturn($Result);exit;
			}*/
			/*if(count(array_unique($_POST['rpassword']))==1){
 				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '提款密码不能全部都相同';
				echo jsonreturn($Result);exit;
			}
			$post['tradepassword']=implode('',$_POST['rpassword']);*/
			$post['tradepassword']=trim($_POST['tradepassword']);
			if(!$post['tradepassword'] || !preg_match("/^[\w\W]{4,16}$/",$post['tradepassword'])){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '请输入4-16位的提款密码';
				$this->ajaxReturn($Result);exit;
			}
			
			// qq、tel验证
			if(!empty($post['qq'])){
				if(!preg_match("/^[1-9][0-9]{4,9}$/",$post['qq'])){
					$Result = [];
					$Result['sign']    = false;
					$Result['message'] = '请输入5-10位的QQ号码';
					$this->ajaxReturn($Result);exit;
				}
			}
			if(!empty($post['phone'])){
				if(!preg_match("/^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/",$post['phone'])){
					$Result = [];
					$Result['sign']    = false;
					$Result['message'] = '请输入正确的手机号码!';
					$this->ajaxReturn($Result);exit;
				}
			}
			//验证用户名
			$_paten = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
			if(!$post['username'] || preg_match($_paten,$post['username']) || mb_strlen($post['username'],'utf-8')<2 || mb_strlen($post['username'],'utf-8')>12){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '用户名为2-12字母与数字组或中文的字符!';
				$this->ajaxReturn($Result);exit;
			}
			$apiparam=array();$Result=array();
			$apiparam['username'] = $post['username'];
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Member/checkuername',$apiparam);
			if(!$Result || $Result['sign']==false){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = $Result['message']?$Result['message']:'注册用户名验证失败';
				$this->ajaxReturn($Result);exit;
			}
			if($Result['data']['ishas']==1){
				$Result = [];
				$Result['sign']    = false;
				$Result['message'] = '用户名已被注册';
				$this->ajaxReturn($Result);exit;
			}
			$verify = new \Think\Verify(['reset' => false]);
			if(!$verify->check($post['code'])) {
				$this->ajaxReturn(["sign"=>false,"message"=>"验证码错误"]);exit;
				exit;
			}

			$data = [];
			$ip = get_client_ip();
			$data['username'] = $post['username'];
			$data['parentid'] = $post['reccode'];
			$data['password'] = $post['password'];
			$data['tradepassword'] = $post['tradepassword'];
			$data['face'] = "/resources/images/face/".rand(1,25).".jpg";
			$data['qq'] = $post['qq'];
			$data['phone'] = $data['phone'] = $post['phone']?$post['phone']:'';
			$data['proxy'] = (isset($post['proxy']) && in_array($post['proxy'],[1,0]))?intval($post['proxy']):0;
			$data['isnb'] = 0;
			$data['regip'] = $ip;
			$data['source'] = 'PC版注册';
			$data['loginsource'] = 'PC';
			if($linkinfo && $_POST['linkid']){
				$data['source'] = '推广链接注册';
				$data['linkid'] = $_POST['linkid'];
			}
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
				$this->ajaxReturn($Result);exit;
			}else{ 
				$Result['message'] = $Result['message']?$Result['message']:'注册失败';
				$this->ajaxReturn($Result);exit;
			}
			exit;
		}
		$_moren = array('金正恩','苍井空','小男孩','奥巴马');
		$num =  rand(0,3);
		$this->assign('mingren',$_moren[$num]);
		$gonggao = M('gonggao')->field('id,title,content')->order('id desc')->find();
		$this->assign('gonggao',$gonggao);
		$this->display();
	}
	function forgetPaw(){
		if(IS_POST){
			$userName = I('userName');
			$verCode  = I('verCode');
			$verify = new \Think\Verify(array('reset' => true));
			if(!$userName) {
				echo'<script>alert("请填写用户名！");window.location.href="'.url('Public/forgetPaw').'";</script>';
				exit;
			}
/*			if(empty($verCode) && !$verify->check($verCode)) {
				echo'<script>alert("验证码错误！");window.location.href="'.url('Public/forgetPaw').'";</script>';
				exit;
			}*/
			$hasuser = M('member')->where(['username'=>$userName])->find();
			if(!$hasuser) {
				echo'<script>alert("用户未找到！");window.location.href="'.url('Public/forgetPaw').'";</script>';
				exit;
			}
			cookie('GetUserName',$userName);
			redirect(url('Public/forgetPaw1',['userName'=>$userName]));
			exit;
		}
		$this->display();
	}
	function forgetPaw1(){
		$GetUserName =cookie('GetUserName');
		if(!$GetUserName){
			redirect(url('Public/forgetPaw'));exit;
		}
		$hasuser = M('member')->where(['username'=>$GetUserName])->find();
		if(!$hasuser){
			redirect(url('Public/forgetPaw'));exit;
		}
		if(IS_POST){
			$yztype = I('yztype');
			$yztext = I('yztext');
			if($yztype=='qq'){
				if(!$hasuser['qq']){
					echo'<script>alert("您未设置QQ！");window.location.href="'.url('Public/forgetPaw1').'";</script>';
					exit;
				}elseif($yztext!=$hasuser['qq']){
					echo'<script>alert("QQ验证错误！");window.location.href="'.url('Public/forgetPaw1').'";</script>';
					exit;
				}else{
					$email = $hasuser['qq'].'@qq.com';
				}
			}elseif($yztype=='email'){
				if(!$hasuser['email']){
					echo'<script>alert("您未绑定邮箱！");window.location.href="'.url('Public/forgetPaw1').'";</script>';
					exit;
				}elseif($yztext!=$hasuser['email']){
					echo'<script>alert("绑定邮箱验证错误！");window.location.href="'.url('Public/forgetPaw1').'";</script>';
					exit;
				}else{
					$email = $hasuser['email'];
				}
			}elseif($yztype=='tel'){
				if(!$hasuser['tel']){
					echo'<script>alert("您未绑定手机号码！");window.location.href="'.url('Public/forgetPaw1').'";</script>';
					exit;
				}elseif($yztext!=$hasuser['tel']){
					echo'<script>alert("手机号码验证错误！");window.location.href="'.url('Public/forgetPaw1').'";</script>';
					exit;
				}else{
					 $this->redirect(U('Public/forgetPaw2'));
				}
			}

			$this->redirect(U('Public/forgetPaw2'));
			exit;
		}
		$this->display();
	}
	function forgetPaw2(){
		$GetUserName =cookie('GetUserName');
		$forgetPawcode = session('forgetPawcode');
		/*if(!$GetUserName || !$forgetPawcode){
			redirect(url('Public/forgetPaw'));exit;
		}*/
		$hasuser = M('member')->where(['username'=>$GetUserName])->find();
		if(!$hasuser){
			redirect(url('Public/forgetPaw'));exit;
		}
		if(IS_POST){
			$yztext = I('yztext');
			$pa     = I('pa');
			$pa1    = I('pa1');
/*			if($_COOKIE['nottel']=='1'){
				if($yztext!=$forgetPawcode){
					echo'<script>alert("邮件验证码错误！");window.location.href="'.url('Public/forgetPaw2').'";</script>';
					exit;
				}
			}*/
			if(strlen($pa)<6){
				echo'<script>alert("密码至少设置6位字符！");window.location.href="'.url('Public/forgetPaw2').'";</script>';
				exit;
			}
			if($pa!=$pa1){
				echo'<script>alert("两次密码输入不一致！");window.location.href="'.url('Public/forgetPaw2').'";</script>';
				exit;
			}
			$newpas = sys_md5($pa,$hasuser['key']);
			$editint = M('member')->where(['id'=>$hasuser['id']])->setField(['password'=>$newpas]);
			if($editint){
				cookie('setPawIsOk',1);
				setcookie('nottel',null);
				redirect(url('Public/forgetPaw3'));
				exit;
			}else{
				echo'<script>alert("密码重置失败！");window.location.href="'.url('Public/forgetPaw2').'";</script>';
				exit;
			}
			exit;
		}
		$this->display();
	}
	function forgetPaw3(){
		$forgetPawcode = session('forgetPawcode');
		$setPawIsOk = cookie('setPawIsOk');
		$code = I('code');
		if($setPawIsOk==1){
			$this->setPawIsOkInfo = '密码重置成功！';
		}else{
			$this->setPawIsOkInfo = '密码重置失败！';
		}
		$this->display();
	}
	public function checkusername(){
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
	function LoginDo(){
		if(!IS_POST){echo json_encode(["sign"=>false,"message"=>"非法操作"]);exit;} //如果不是POST提交就返回FASE
		$param = I('post.');
		if(empty($param['nocode']))
		{
				if(!$param['name'] | !$param['pass'] /*| !$param['code']*/){
					echo jsonreturn(["sign"=>false,"message"=>"登录信息不完整"]);
					exit;
				}
				$verify = new \Think\Verify(['reset' => false]);
				if(!$verify->check($param['code'])) {
					echo jsonreturn(["sign"=>false,"message"=>"验证码错误"]);
					exit;
				}
		}
		//验证用户名
		/*if(!$param['name'] || !preg_match("/^[a-zA-Z][a-zA-Z\d]{4,12}$/",$param['name'])){
			$return = [];
			$return['sign']    = false;
			$return['message'] = '请输入4-12位的用户名,必须以字母开通头!';
			echo jsonreturn($return);exit;
		}*/
		if(!$param['name'] || strlen($param['name'])<3){  //如果用户名不存在 或 少于3位则返回错误
			$return = [];
			$return['sign']    = false;
			$return['message'] = '请输入正确用户名!';
			echo jsonreturn($return);exit;
		}
		if(!$param['pass'] && !preg_match("/^[\w\W]{6,16}$/",$param['pass'])){ //验证密码
			$return = [];
			$return['sign']    = false;
			$return['message'] = '请输入6-16位的登陆密码';
			echo jsonreturn($return);exit;
		}
		$data = [];
		$ip = get_client_ip();
		$data['username'] = $param['name'];
		$data['nocode'] = $param['nocode'];
		$data['password'] = $param['pass'];
		$data['loginip']  = $ip;
		$data['source']   = 'pc';
		$userinfo = M('Member')->field('id,loginip,logintime')->cache(300)->where("username='{$param['name']}'")->find();
		$apiparam=array();
		$apiparam['data'] = $data;
		$_api = new \Lib\api;
		$Result = [];
		$Result = $_api->sendHttpClient('Api/Member/signin',$apiparam);
		if(is_array($Result) && $Result['sign']==true){
			$return['sign']    = true;
			$return['message'] = '登陆成功';
            $return['url']    = cookie('addr_url')?cookie('addr_url'):'/Index.index.do';
			//保存登陆信息
			
			if($Result['auth']['member_auth_id'] && $Result['auth']['member_sessionid']){
				
				session('member_sessionid',$Result['auth']['member_sessionid']);
				session('member_auth_id',$Result['auth']['member_auth_id']);
				$lastlogin['lastip'] = $userinfo['loginip'] ;
				$lastlogin['lasttime'] = date("Y-m-d H:i:s",$userinfo['logintime']) ;
				
				//echo (json_decode(getIpAddress($lastlogin['lastip']))->region);exit;
				$lastlogin['login_address'] = json_decode(getIpAddress($lastlogin['lastip']))->district.",".json_decode(getIpAddress($lastlogin['lastip']))->city;
				session('lastlogin',$lastlogin);
          
/*				$okamountcount = M('touzhu')->cache(300)->where("isdraw=1 AND uid='{$Result['auth']['member_auth_id']}' ")->SUM('okamount');
 				$k3names = M('touzhu')->cache(300)->distinct ( true )->where ("uid='{$Result['auth']['member_auth_id']}' ")->field ( 'cptitle,cpname' )->limit(8)->select();
				session("okamountcount",$okamountcount);
				session("k3names",$k3names);*/
				$return['data']['islogin'] = '1';
			}
			
			$this->ajaxReturn($return);exit;
		}else{
			$Result['sign']    = false;
			$Result['message'] = $Result['message']?$Result['message']:'登陆失败';
			$this->ajaxReturn($Result);exit;
		}
		exit;
		
	}
	function LoginOut(){
	    M('membersession')->where("userid='{$_SESSION['userinfo']['id']}'")->delete();
		session('userinfo',null);
		redirect(U('Index/index'));
	}
	function verify(){
		ob_end_clean();
		$imageW = intval($_REQUEST['imageW'])?intval($_REQUEST['imageW']):150;
		$imageH = intval($_REQUEST['imageH'])?intval($_REQUEST['imageH']):35;
		$fontSize = intval($_REQUEST['fontSize'])?intval($_REQUEST['fontSize']):17;
		Verify($imageW,$imageH,$fontSize);
	}
	public function hongbao(){
	    $time = date('Y/m/d H:i:s',time());
        $tow = mktime(14,0,0,date('m'),date('d'),date('Y'));
	    $startDateTime = date('Y/m/d H:i:s',$tow);
        $end = mktime(23,0,0,date('m'),date('d'),date('Y'));
	    $endDateTime = date('Y/m/d H:i:s',$end);
        $this->assign('endDateTime',$endDateTime);
        $this->assign('startDateTime',$startDateTime);
        $this->assign('time',$time);
        $username = $_SESSION['userinfo']['username'];
        $this->assign('username',$username);
        $this->display();
    }
    public function ajax_red(){
        $time = date('Y/m/d H:i:s',time());
        $tow = mktime(14,0,0,date('m'),date('d'),date('Y'));
        $startDateTime = date('Y/m/d H:i:s',$tow);
        $end = mktime(23,0,0,date('m'),date('d'),date('Y'));
        $endDateTime = date('Y/m/d H:i:s',$end);
        if(time()>$tow && time()<=$end){
            $Result = ['stat'=>'0','c_time'=>$time,'start_time'=>$startDateTime,'end_time'=>$endDateTime];
        }elseif (time()<$tow){
            $Result = ['stat'=>'-1','c_time'=>$time,'start_time'=>$startDateTime];
        }else{
            $Result = ['stat'=>'-404'];
        }
        return $this->ajaxReturn($Result);
    }
    public function get_red(){
        //昨天12
        $yesterday12 = mktime(12,0,0,date('m'),date('d')-1,date('Y'));
        //今天12
        $today12 = mktime(12,0,0,date('m'),date('d'),date('Y'));
        //活动开始时间
        $tow = mktime(0,0,0,date('m'),date('d'),date('Y'));
        //活动结束时间
        $end = mktime(23,59,59,date('m'),date('d'),date('Y'));

        $astart = mktime(14,0,0,date('m'),date('d'),date('Y'));
        $aend = mktime(23,0,0,date('m'),date('d'),date('Y'));
        $user_id = $_SESSION['userinfo']['id'];
		$member_info = M('member')->where(['id'=>$user_id])->find();
        if(!$user_id){
            return $this->ajaxReturn(['stat'=>'0','msg'=>'请登录']);exit;
        }
        if(time()<$astart || time()>$aend){
            return $this->ajaxReturn(['stat'=>'0','msg'=>'活动不在时间内']);exit;
        }
        $map['state']  =1;
        $map['uid']  =$user_id;
        $map['oddtime']  = array('between',array($yesterday12,$today12));
        $money = M('recharge')->where($map)->sum('amount');
        $where['min_num'] = array('ELT',$money);
        $where['max_num'] = array('EGT',$money);
        $hbsz = M('hongbaosettings')->where($where)->order('sort asc')->find();
        if(!$hbsz){
            return $this->ajaxReturn(['stat'=>'0','msg'=>'不好意思你还没满足充值条件']);exit;
        }
        $wh['created_at']  = array('between',array($tow,$end));
        $count = M('hongbao')->where($wh)->count();
        if($count>=$hbsz['times']){
            return $this->ajaxReturn(['stat'=>'0','msg'=>'你抢红包次数已达到次数']);exit;
        }
        $suiji = rand($hbsz['min_per'],$hbsz['max_per']);
        $data['member_id'] = $user_id;
        $data['name'] = $_SESSION['userinfo']['username'];
        $data['money'] = $suiji;
        $data['created_at'] = time();
        M()->startTrans();
		$save['uid'] = $user_id;
		$save['username'] = $member_info['username'];
		$save['type'] = 'activity_red';
		$save['typename'] = '随机红包奖励';
		$save['remark'] = '充值条件满足的抢得的红包';
		$save['amount'] = $suiji;
		$save['amountbefor'] = $member_info['balance'];
		$save['amountafter'] = $member_info['balance']+$suiji;
		$save['oddtime'] = time();
		$res = M('fuddetail')->add($save);
        $ss = M('member')->where(['id'=>$user_id])->setInc('balance',$suiji);
        $rest = M('hongbao')->add($data);
        if ($ss && $rest && $res){
            // 提交事务
            M()->commit();
            return $this->ajaxReturn(['stat'=>'1','msg'=>'红包抢购成功']);exit;
        }else{
            // 事务回滚
            M()->rollback();
            return $this->ajaxReturn(['stat'=>'0','msg'=>'红包抢购失败']);exit;
        }
    }
    public function query_redbag(){
        $username = I('username');
        $list = M('hongbao')->where(['name'=>$username])->order('created_at desc')->select();
        $html = '';
        foreach ($list as $key=>$value){
            $money = $value['money'];
            $created_at = $value['created_at'];
            $html .= '<table class="chtable">
                <tbody>
                <tr class="toum">
                    <td>'.$money.'</td>
                    <td>'.$created_at.'</td>
                </tr>
                
                </tbody>
         </table>';
        }

        echo $html;exit;
    }
}
?>