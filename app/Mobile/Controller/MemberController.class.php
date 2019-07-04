<?php
namespace Mobile\Controller;
use Think\Controller;
class MemberController extends CommonController {
	public function __construct(){
		parent::__construct();
		if(!$this->userinfo || $this->userinfo['islogin']!=1){
			session('member_sessionid',NULL);
			session('member_auth_id',NULL);
			redirect(U('Public/login'));
			exit;
		}
	}
	function index()
	{
		$this->display();
	}
	function setting(){ 
		$schedule = 30;
		$tradepassword = M('member')->where("id=".$this->userinfo['id'])->getField('tradepassword');
		if($tradepassword)
		{
			$schedule += 20;
			$this->tradepassword = $tradepassword;
		}
		if($this->userinfo['email'])$schedule += 15;
		if($this->userinfo['tel'])$schedule += 15;
//		if($this->userinfo['modify'])$schedule += 15;
		if(!empty($_SESSION["userinfo"]['question']))$schedule += 20;
		if($schedule<50)
		{
			$this->aqjibie = '低';
		}elseif($schedule>=50 && $schedule<75){
			$this->aqjibie = '中';
		}elseif($schedule>=75 && $schedule<100){
			$this->aqjibie = '高';
		}else{
			$this->aqjibie = '极高';
		}

		$this->schedule = $schedule;
		$this->display();
	}
	function ucenter(){
		$userinfo = session('userinfo');
		if($userinfo && $userinfo['question']){
			$this->assign('question',$userinfo['question']);
		}
		$userbanklist = $userinfo['banklist'];
		$this->assign('userbanklist',$userbanklist);
		$this->display();
	}
	function finance(){
		$bankpaylists = C('bankpaylists');
		foreach($bankpaylists as $k=>$v){
			if($v['state']==0)unset($bankpaylists[$k]);
		}
		$this->assign('bankpaylists',$bankpaylists);
		
		//用户银行卡
		$userinfo = session('userinfo');
		$userbanklist = $userinfo['banklist'];
		//dump($userbanklist);exit;
		$this->assign('userbanklist',$userbanklist);
		$this->display();
	}
	//个人信息
	function personalInfo()
	{
		if(IS_POST)
		{
			$info = $_POST['info'];
			if($info['qq'] && !preg_match('/^[0-9]{5,20}$/',$info['qq']))
			{
				$this->error('QQ设置错误');
			}
			$data['qq'] = $info['qq'];
			$data['sex'] = $info['sex'];
			$data['face'] = $info['face'];
			$data['birthday'] = $info['birthday'];
			$int = M('member')->where("id={$this->userinfo['id']}")->setField($data);
			$int?$this->success('资料修改成功'):$this->error('资料修改失败');
			exit;
		}
		$group = M('membergroup')->order('groupid ASC')->select();
		$this->assign("GROUPMSG",$group);
		$this->display();
	}
	//公告列表
	function gglist()
	{
		$gglist = M('Gonggao')->order("id DESC")->select();
		$this->assign('gglist',$gglist);
		$this->display();

	}
	//公告显示
	function ggshow()
	{
		$aid = I('get.aid');
		$ggshow = M('Gonggao')->where("id='{$aid}'")->find();
		$this->assign('ggshow',$ggshow);
		$this->display();

	}
	//修改登录密码
	function update_pass()
	{
		if(IS_POST){
			if(I('post.settype')==1)
			{
				$password = $_POST['password'];
				$uinfo = M('member')->where("id=".$this->userinfo['id'])->field('password')->find();
				if(sys_md5($password)!=$uinfo['password'])
				{
					$this->error('原登录密码错误');
				}else{
					$this->display('Member_update_pass2');
				}
			}

			if(I('post.settype')==2)
			{
				$pa1 = $_POST['pa1'];
				$password = $_POST['password'];
				if(strlen($password)<6 || strlen($password)>16)
				{
					$this->error('密码长度最少为6-16位字符');
				}
				if($pa1!=$password)
				{
					$this->error('两次密码输入不一致');
				}
				$uinfo = M('member')->where("id=".$this->userinfo['id'])->field('password,key')->find();
				$int = M('member')->where("id=".$this->userinfo['id'])->setField(array('password'=>sys_md5($password)));
				$int?$this->success('修改成功',U('Member/index')):$this->error('修改失败');

			}
		}else{
			$this->display('Member_update_pass');
		}
	}
	//通过邮箱找回安全密码
	function find_safepass_email(){
		if(!$this->userinfo['email'])$this->error('你还没有绑定邮箱');
		if(IS_POST){
			$newEmail = I('post.email');
			if(!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/i',$newEmail)){
				$this->error('邮箱格式错误');
			}
			if($newEmail !=$this->userinfo['email']){
				$this->error('邮箱不正确');
			}

			/*			$str = $this->check_verify($_POST['code'],'',1) ;
                        if($str == "验证码通过！"){*/
			$this->redirect("safepass2");
			/*			}else{
                            $this->error($str);
                        }*/
		}
		$this->display();
	}
	//通过手机找回安全密码
	function find_safepass_phone(){
		if(!$_SESSION["userinfo"]['tel'])$this->error('你还没有绑定手机号码',U('Member/safephone'));
		if(IS_POST){
			$tel = $_POST['tel'];
			if(!preg_match('/^(1)[0-9]{10}$/',$tel))
			{
				$this->error('请输入正确的手机格式');
			}
			if($tel !=$this->userinfo['tel']){
				$this->error('手机号码不正确');
			}
			$this->redirect("safepass2");
		}
		$this->display();
	}
	//通过手机找回安全密码
	function find_safepass_qq(){
		if(!$_SESSION["userinfo"]['qq'])$this->error('你还没有设置QQ号码',U('Member/personalInfo'));
		if(IS_POST){ 
			$qq = $_POST['qq'];
			if(!preg_match('/[1-9][0-9]{4,14}$/',$qq))
			{
				$this->error('请输入正确的QQ格式');
			}
			if($qq !=$this->userinfo['qq']){
				$this->error('QQ号码不正确');
			}
			$this->redirect("safepass2");
		}
		$this->display();
	}
	//找回安全密码
	function find_safepass()
	{
		$this->display();
	}
	//通过密保找回安全密码
	function find_safepass_problem(){
		if(!$_SESSION["userinfo"]['question'])$this->error('你还没有设置密保问题答案');
		/*		if(IS_POST){
                    if(empty($_POST['answer_one']) or $_POST['answer_one']!= $user['answer_one'])$this->error('问题一答案错误');
                    if(empty($_POST['answer_two']) or $_POST['answer_two']!= $user['answer_two'])$this->error('问题二答案错误');
                    if(empty($_POST['answer_three']) or $_POST['answer_three']!= $user['answer_three'])$this->error('问题二答案错误');
                    $this->redirect("User/safepass2");
                }*/
		$this->display();
	}
	
//额度转让
	function quota()
	{
		$userInfo=$_SESSION['userinfo'];
		
		$username=$userInfo['username'];
		if($username){
			$member=D("Member")->find($userInfo['id']);
			$balance=$member['balance'];
			$AgService=new \Org\Util\AgService();
			 $ret=$AgService->balance(trim($username));
			 $agBalance=$ret['balance'];
			 $BbinService=new \Org\Util\BbinService();
			 $ret=$BbinService->balance(trim($username));
			 $bbBalance=$ret['balance'];
			$kyService=new \Org\Util\KyService();
			 $ret=$kyService->balance(trim($username));
			 $kyBalance=$ret['balance'];
			$ssService=new \Org\Util\SsService();
			 $ret=$ssService->balance(trim($username));
			 $ssBalance=$ret['balance'];			 
			 
			 $this->assign("balance",$balance);
			 $this->assign("agBalance",$agBalance);
			 $this->assign("bbBalance",$bbBalance);
			 $this->assign("kyBalance",$kyBalance);
			 $this->assign("ssBalance",$ssBalance);			 
		}
		$this->display();
	}
	//投注记录
	function betRecord()
	{
		/*	$this->name      =*/ $name      = I('name');
		/*	$this->atime     =*/ $atime     = $_GET['atime'];
		/*	$this->a_item    =*/ $a_item    = I('a_item',1);
		/*	$this->qihao     =*/ $expect     = I('qihao');
		/*	$this->StartTime =*/ $StartTime = I('StartTime');
		/*	$this->EndTime   =*/ $EndTime   = I('EndTime');


		$map = array();
		$map['uid']=array('eq',$this->userinfo['id']);
		if($name)$map['cpname']=array('eq',$name);
		if($expect)$map['expect']=array('eq',$expect);
		switch ($atime)
		{
			case '1' ;
				$StartTime = date('Y-m-d 00:00:00');
				$EndTime   = date('Y-m-d H:i:s') ;
				break;
			case '2' ;
				$time=time ()- ( 1  *  24  *  60  *  60 );
				$day = date("Y-m-d",$time);
				$StartTime = date($day.' 00:00:00');
				$EndTime   = date($day.' 23:59:59');
				break;
			case '3' ;
				$time=time ()- ( 7  *  24  *  60  *  60 );
				$day = date("Y-m-d",$time);
				$StartTime = date($day.' 00:00:00');
				$EndTime   = date('Y-m-d H:i:s') ;
				break;
		}
		if($StartTime && $EndTime)
		{
			$map['oddtime'][]=array('egt',strtotime($StartTime));
			$map['oddtime'][]=array('elt',strtotime($EndTime));
		}elseif(!$StartTime && $EndTime){
			$map['oddtime'][]=array('elt',strtotime($EndTime)/**/);
		}

		switch($a_item)
		{
			case'2';
				$map['isdraw']=array('eq',1);
				break;
			case'3';
				$map['isdraw']=array('eq',-1);
				break;
			case'4';
				$map['isdraw']=array('eq',0);
				break;
		}

		$count      = M('touzhu')->where($map)->count();
		$Page       = new \Think\Page($count,1);
		startPage($Page);
		$tzlist     = M('touzhu')->where($map)->order("oddtime desc")->limit($Page->firstRow.','.$Page->listRows)->select();

		$sTime   = strtotime(date('Y-m-d 00:00:00'));
		$eime   = strtotime(date('Y-m-d 23:59:59')) ;
		$where['oddtime'][]=array('egt',$sTime);
		$where['oddtime'][]=array('elt',$eime);
		$todyaabout = M('touzhu')->where("uid = '{$this->userinfo['id']}'")->where($where)->select();

		//投注金额 中奖金额 盈利金额
		$touzhujine = $allokamount= $yingli ="";
		foreach ($todyaabout as $key => $value)
		{
			$touzhujine += $value['amount'];
			if($value['isdraw']==1)
			{
				$allokamount  += $value['okamount'];
			}
		}
		//全部彩种
		$ALLCP = M('caipiao')->field("name,title")->where("iswh='0' AND isopen='1'")->select();
		$this->assign('ALLCP',$ALLCP);
		$this->assign('allokamount',$allokamount);
		$this->assign('touzhujine',$touzhujine);
		$this->pageshow= $Page->show(); 
		$this->tzlist = $tzlist;
		$yxmoney = 0;$zjmoney=0;
		foreach($tzlist as $k=>$v)
		{
			if($v['status']!=2)$yxmoney += $v['amount'];
			if($v['status']==1)$zjmoney += $v['okamount'];
		}
		$this->yxmoney = $yxmoney;
		$this->zjmoney = $zjmoney;
		$this->display();
	}
	//修改安全密码
	function update_safepass()
	{
		$uinfo = M('member')->where("id=".$this->userinfo['id'])->field('password,tradepassword')->find();
		if(IS_POST)
		{
			if(I('post.settype')==1)
			{
				$oldpassword = I('post.oldpassword');
				if
				(sys_md5($oldpassword) != $uinfo['tradepassword']){
					$this->error('原安全密码错误');
				} else {
					$this->display('Member_safepass2');
				}
			}
			if(I('post.settype')==2)
			{
				$pa1 = $_POST['pa1'];
				$password = $_POST['password'];

				if(strlen($password)<6 || strlen($password)>16)
				{
					$this->error('安全密码长度最少为6-16位字符');
				}
				if(strlen($password)<6 || strlen($password)>16)
				{
					$this->error('安全密码长度最少为6-16位字符');
				}
				if($pa1!=$password)
				{
					$this->error('两次密码输入不一致');
				}
				$data['tradepassword'] = sys_md5($password);
				$int = M('member')->where("id=".$this->userinfo['id'])->setField($data);
				$int?$this->success('修改成功',U('index')):$this->error('修改失败');
				exit;
			}
		}else{
			$this->display('Member_safepass1');
		}
	}
	//手机绑定
	function safephone()
	{
		if(IS_POST)
		{
			$tel = $_POST['tel'];
			if(!preg_match('/^(1)[0-9]{10}$/',$tel))
			{
				$this->error('请输入正确的手机格式');
			}
			if($this->userinfo['tel'])
			{
				$this->error('无法修改，请联系客服');
			}
			$int = M('member')->where("id=".$this->userinfo['id'])->setField(array('tel'=>$tel));
			$int?$this->success('手机绑定成功',U('index')):$this->error('手机绑定修改失败');
			exit;
		}
		$this->display();
	}
	function check_verify($code, $id = '',$fag=null){
		$name  = I('name');
		$code = I('code','0','floatval');
		$config = array(
			'reset' => false,
		);
		$verify = new \Think\Verify($config);
		if(!$code){
			$status = 'n';
			$info = "验证码不能为空！";
			if($fag){
				return  $info;
			}else{
				echo json_encode(array('status'=>$status,'info'=>$info));//,'token'=>$token
			}
			exit;
		}
		if(!$verify->check($code)) {
			$status = 'n';
			$info = "验证码错误！";
			$token = 0;
		}else{
			$status = 'y';
			$info = "验证码通过！";
			$_t = time();
			session('msgtoken',md5($_t));
			$token = md5($_t);
		}
		if($fag){
			return $info;
		}else{
			echo json_encode(array('status'=>$status,'info'=>$info,'token'=>$token));
		}
		exit;
	}
	//绑定邮箱
	function bindmail(){
		if(IS_POST){
//			$str = $this->check_verify($_POST['code'],'',1) ;
//			if($str == "验证码通过！"){
				$newEmail = I('post.emial');
				if(!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/i',$newEmail)){
					$this->error('邮箱格式错误');
				}
				if($this->userinfo['email']){
					$this->error('无法修改，请联系客服');
				}
				$int = M('member')->where("id=".$this->userinfo['id'])->setField(array('email'=>$newEmail));
				$int?$this->success('邮箱绑定成功'):$this->error('邮箱绑定失败');
				exit;
/*			}else{
				$this->error($str);
			}*/
		}
		$this->display('bindmail');
	}
	//邮箱发送验证码
	function testtomail()
	{
//		SMTP_SSL,SMTP_PORT,SMTP_PORT,FROM_EMAIL,SMTP_USER,FROM_NAME,REPLY_EMAIL,REPLY_NAME,SMTP_PASS


		$smtp = M('setting')->select();
		foreach ($smtp as $key => $value){
			if($value['name']=="SMTP_HOST")$SMTP_HOST = $value['value'];
			if($value['name']=="SMTP_PORT")$SMTP_PORT = $value['value'];
			if($value['name']=="SMTP_USER")$SMTP_USER = $value['value'];
			if($value['name']=="SMTP_SSL") $SMTP_SSL = $value['value'];
			if($value['name']=="SMTP_PASS")$SMTP_PASS = $value['value'];
			if($value['name']=="FROM_NAME")$FROM_NAME = $value['value'];
		}

		$to = I('to');
		if(!IS_POST || !$SMTP_HOST || !$SMTP_PORT || !$SMTP_USER || !$SMTP_PASS || !$to){
			if(!$to)$this->error('邮箱不能为空');
			$this->error('设置不完整');
		}
		$body=$subject = implode('',$this->verify($fag=1));
		date_default_timezone_set('Asia/Shanghai');//设定时区东八区
		import('Common.Class.PHPMailer');
		$mail = new \PHPMailer();
		$body            = eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
		$mail->CharSet ="UTF-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
		$mail->IsSMTP(); // 设定使用SMTP服务
		$mail->SMTPDebug  = 0;                     // 启用SMTP调试功能
		// 1 = errors and messages
		// 2 = messages only
		$mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
		//$mail->SMTPSecure = "ssl";                 // 安全协议，可以注释掉
		$mail->Host       = $SMTP_HOST;      // SMTP 服务器
		$mail->Port       = $SMTP_PORT;                   // SMTP服务器的端口号
		$mail->Username   = $SMTP_USER;  // SMTP服务器用户名
		$mail->Password   = $SMTP_PASS;            // SMTP服务器密码
		$mail->SMTPSecure = $SMTP_SSL;
		$mail->SetFrom($SMTP_USER, '幸运彩');
		$mail->AddReplyTo($SMTP_USER,'幸运彩');
		$mail->Subject    = $subject;
		$mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; // optional, comment out and test
		$mail->MsgHTML($body);
		$address = $to;
		$mail->AddAddress($address, '');
//		$mail->AddAttachment("images/phpmailer.gif");      // attachment
//		$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
		if(!$mail->Send()) {
			$this->error('失败');
		} else {
			$this->success('成功');
		}
	}
	function verify($fag=null)
	{
		$imageW = intval($_REQUEST['imageW'])?intval($_REQUEST['imageW']):150;
		$imageH = intval($_REQUEST['imageH'])?intval($_REQUEST['imageH']):35;
		$fontSize = intval($_REQUEST['fontSize'])?intval($_REQUEST['fontSize']):17;
		$config =    array(
			'fontSize'    =>    $fontSize,    // 验证码字体大小
			'length'      =>    4,     // 验证码位数
			'useNoise'    =>    false, // 关闭验证码杂点
			'imageW'      =>    $imageW,
			'imageH'      =>    $imageH,
			'fontttf'     =>    '5.ttf'
		);
		$Verify = new \Think\Verify($config);
		$Verify->codeSet = '123456789';
		return $Verify->entry('',$fag);
	}
	//银行卡管理
	function bindcard()
	{

		$uinfo = M('member')->where("id=".$this->userinfo['id'])->field('userbankname,tradepassword')->find();
		$this->tradepassword = $uinfo['tradepassword'];
		$bankdb   = M('banklist');
		$banklist = $bankdb->where("uid=".$this->userinfo['id'])->select();

		if($banklist)foreach($banklist as $k=>$v)
		{
			$banklist[$k]['accountname']  = mb_substr($v['accountname'],0,1,'utf-8');
			$banklist[$k]['sartnum']  = mb_strlen($v['accountname'],'utf-8')-1;
			$banklist[$k]['banknumber'] = mb_substr($v['banknumber'],0,6).'***********'.substr($v['banknumber'],-6);
			$banklist[$k]['banklogo']  = M('sysbank')->where("bankcode='{$v['bankcode']}'")->getField('banklogo');
		}
		$this->banklist = $banklist;
		$this->assign('banklist',$banklist);
		$this->assign('userbankname',$uinfo['userbankname']);
		$this->display();
	}
	//添加银行卡
	function addBank()
	{
		$bankdb   = M('banklist');
		$uinfo = M('member')->where("id=".$this->userinfo['id'])->field('id,userbankname,tradepassword')->find();
 		if($uinfo['userbankname']==""){
//			redirect(U("Member/addbank"));exit;
			$this->error('请先绑定银行卡的真实姓名',U('Account/userbankname'));
		}
		$this->userinfo['userbankname'] = $uinfo['userbankname'];
		$ubank = $bankdb->where("uid=".$this->userinfo['id'])->field('banknumber')->select();
		$allbank = M('sysbank')->select();
		$this->tradepassword = $uinfo['tradepassword'];
		$banklist = $bankdb->where("uid=".$this->userinfo['id'])->select();
		if (count($banklist)==3)
		{
			$this->error('最多只能绑定三张银行卡');
			exit();
		}
		if(IS_POST)
		{
			$errmsg = "";
			if(sys_md5($_POST['safepass'])!=$uinfo['tradepassword']) $errmsg[]  = '安全密码错误！';
			if(mb_strlen($_POST['bankname'],'utf-8')< 2) $errmsg[]  = '请选择开户银行';
			if($_POST['province']=="省份") $errmsg[]  = '请选择省份';
			if($_POST['city']=='地级市') $errmsg[]  = '请选择城市';
			
			if($_POST['banknumber'] != $_POST['rebanknumber']) $errmsg[]  = '银行卡号和确认银行卡号不一致';
			if(!preg_match('/^(\d{16}|\d{19})$/',$_POST['banknumber'])) $errmsg[]  = '银行卡格式不正确';
			
			$accountname = trim($_POST['accountname']);
			if(!$uinfo['userbankname']){
				if(!$accountname){
					$this->error('请输入持卡人姓名');exit;
				}
				if(mb_strlen($accountname,'utf-8')< 2) {
					$this->error('请输入正确格式的持卡人姓名');exit;
				}
			}else{
				if($uinfo['userbankname']!=$accountname){
					$this->error('持卡人姓名与之前邦定姓名不一致');exit;
				}
				unset($accountname);
			}
			
			
			
			if(empty($errmsg))
			{
				foreach ($ubank as $key => $value)
				{
					if ($value['banknumber']== $_POST['banknumber'])
					{
						$this->error('该银行卡已被绑定,无须重复绑定!');
						exit();
					}
				}
				
				if($accountname && !$uinfo['userbankname']){
					$int = M('member')->where(['id'=>$uinfo['id']])->setField(['userbankname'=>$accountname]);
				}
				$data['accountname'] = $accountname;
				
				$data['uid'] = $this->userinfo['id'];
				$data['username'] = $this->userinfo['username'];
				if(count($banklist)==0)$data['isdefault']=1;
				$data['bankname'] = $_POST['bankname'];
				$data['province'] = $_POST['province'];
				$data['city'] = $_POST['city'];
				//$data['accountname'] = $_POST['accountname'];
				$data['bankname'] = $_POST['bankname'];
				$data['banknumber'] = $_POST['banknumber'];
				
				$data['addtime'] = date('Y-m-d H:i:s');
				
				if( $bankdb->add($data))
				{
					$this->success('银行卡绑定成功!',U('index'));
				}else{
					$this->error('银行卡绑定失败,请重试');
				};
			} else{
				$this->error($errmsg);
			}
		}else{
			$this->assign("Allbank",$allbank);
			$this->display();
		}
	}


}
