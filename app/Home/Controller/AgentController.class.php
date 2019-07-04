<?php
namespace Home\Controller;
use Think\Controller;
class AgentController extends CommonController {
	public function __construct(){
		parent::__construct();
		if(!$_SESSION["userinfo"]){
			redirect(U('Apublic/login'));exit;
		}
		if($_SESSION["userinfo"]['proxy']!=1){
			$this->error('您不是代理');
		}
	}
/*	function index(){
		//dump(intval(0.8));exit;
		$this->display();
	}*/
	public function index(){
//		dump($_SESSION['userinfo']);
		$DOMAINS = array_flip(C('APP_SUB_DOMAIN_RULES'));
		if(C('APP_SUB_DOMAIN_DEPLOY') && $DOMAINS['Home']){
			$tgurl = 'http://'.$DOMAINS['Home'].'/?tid='.$this->userinfo['id'];
		}else{
			$tgurl = 'http://'.$_SERVER['HTTP_HOST'].'/?tid='.$this->userinfo['id'];
		}
		$this->tgurl = $tgurl;
		$this->display();
	}
	function chongzhi(){
		$member = M('member');
		$map = array();
		$map['parentid'] = array('eq',$this->userinfo['id']);
		$xusers = $member->where($map)->field('id,username,regtime,balance')->select();
		foreach($xusers as $k=>$v){
			$xuids[] = $v['id'];
		}
		if($xuids){
			//下线会员数据统计
			$czdb = M('recharge');
			$czmap = array();
			$czmap['state'] = array('eq',1);
			if($xuids)$czmap['uid'] = array('in',$xuids);
			$count      = $czdb->where($czmap)->count();
			$Page       = new \Think\Page($count,30);
			$this->pageshow       = $Page->show();
			$czlist = $czdb->where($czmap)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			foreach($czlist as $k=>$v){
				$yetotal += $v['amount'];
			}
			$alltotal = $czdb->where($czmap)->sum('amount');
			$this->czlist = $czlist;
			$this->yetotal = number_format($yetotal,2,".",",");;
			$this->alltotal = number_format($alltotal,2,".",",");
		}
		$this->display();
	}
	function xiazhu(){
		$member = M('member');
		$map = array();
		$map['parentid'] = array('eq',$this->userinfo['id']);
		if($_REQUEST['StartTime']){
			$this->StartTime = $_REQUEST['StartTime'];
			$map['oddtime'][] = array('egt',strtotime($_REQUEST['StartTime']));
		}
		if($_REQUEST['EndTime']){
			$this->EndTime = $_REQUEST['EndTime'];
			$map['oddtime'][] = array('egt',strtotime($_REQUEST['EndTime'])+86400);
		}
		$xusers = $member->where($map)->field('id,username,regtime,balance')->select();
		foreach($xusers as $k=>$v){
			$xuids[] = $v['id'];
		}
		if($xuids){
			//下线会员数据统计
			$czdb = M('touzhu');
			$czmap = array();
			$czmap['isdraw'] = array('neq',-2);
			$czmap['uid'] = array('in',$xuids);
			if($_REQUEST['StartTime']){
				$czmap['oddtime'][] = array('egt',strtotime($_REQUEST['StartTime']));
			}
			if($_REQUEST['EndTime']){
				$czmap['oddtime'][] = array('elt',strtotime($_REQUEST['EndTime'])+86400);
			}
			$count      = $czdb->where($czmap)->count();
			$Page       = new \Think\Page($count,30);
			$this->pageshow       = $Page->show();
			$czlist = $czdb->where($czmap)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			foreach($czlist as $k=>$v){
				$yetotal += $v['amount'];
			}
			$alltotal = $czdb->where($czmap)->sum('amount');

			$czmap['isdraw	'] = array('eq',1);
			$alloktotal = $czdb->where($czmap)->sum('okamount');
			$this->czlist = $czlist;
			$this->yetotal = number_format($yetotal,2,".",",");;
			$this->alltotal = number_format($alltotal,2,".",",");;
			$this->allyingkui = number_format($alloktotal-$alltotal,2,".",",");;
		}
		$this->display();
	}


	function tuandui(){
		$member = M('member');
		$map = array();
		$map['parentid'] = array('eq',$this->userinfo['id']);
		$count      = $member->where($map)->count();
		$Page       = new \Think\Page($count,30);
		$this->pageshow       = $Page->show();
		$xusers = $member->where($map)->field('id,username,regtime,balance')->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		//下线会员数据统计
		$tzdb = M('touzhu');
		//本月/上月开始和结束时间
		$months0 = mFristAndLast(date('Y'),date('m'));
		$months1 = mFristAndLast(date('Y',strtotime("-1 month")),date('m',strtotime("-1 month")));//上月
		foreach($xusers as $k=>$v){
			$totaltouzhu = $tzdb->where("uid = {$v['id']} and isdraw!='-2'")->sum('amount');//总投注额
			$totalyili   = $tzdb->where("uid = {$v['id']} and isdraw=1")->sum('okamount');//总盈利

			//本月统计
			$m0touzhu = $tzdb->where("uid = {$v['id']} and isdraw!='-2' and oddtime<={$months0['lastday']} and oddtime>={$months0['firstday']}")->sum('amount');
			$m0yili   = $tzdb->where("uid = {$v['id']} and isdraw=1 and oddtime<={$months0['lastday']} and oddtime>={$months0['firstday']}")->sum('okamount');

			//上月统计
			$m1touzhu = $tzdb->where("uid = {$v['id']} and isdraw!='-2' and oddtime<={$months1['lastday']} and oddtime>={$months1['firstday']}")->sum('amount');
			$m1yili   = $tzdb->where("uid = {$v['id']} and isdraw=1 and oddtime<={$months1['lastday']} and oddtime>={$months1['firstday']}")->sum('okamount');

			$xusers[$k]['totaltouzhu'] = $totaltouzhu;
			$xusers[$k]['totalyili'] = $totalyili;
			$xusers[$k]['m0touzhu'] = $m0touzhu;
			$xusers[$k]['m0yili'] = $m0yili;
			$xusers[$k]['m1touzhu'] = $m1touzhu;
			$xusers[$k]['m1yili'] = $m1yili;
		}
		$this->xusers = $xusers;
		$this->display();
	}
	function online(){
		$db = M('member');
		$map = array();
		$t = time();
		$tonline = 30;
		$map['onlinetime'] = array('EGT',$t-$tonline);
		$map['tgid'] = array('eq',$this->userinfo['id']);
		$count      = $db->where($map)->count();
		import('Common.Class.Page');
		$Page       = new \Page($count,20);
		$this->page       = $Page->show();
		$list = $db->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->total       = $count;
		$this->display();
	}
	function rifanyong(){
		$map['groupid'] = $this->userinfo['groupid'];
 		$rifanyonglv = M('membergroup')->where($map)->getField('rifanyonglv');
		$_yjlist = explode(';',str_replace('；',';',$rifanyonglv));
		foreach($_yjlist as $k=>$v){
			$array = $array1 = array();
			$array = explode('|',$v);
			$array1= explode('-',$array[0]);
			$yjlist[$k]['min']  = $array1[0];
			$yjlist[$k]['max']  = $array1[1];;
			$yjlist[$k]['bilv'] = $array[1];
		}
		$time = strtotime(date("Y-m-d",time()));
		$StartTime = strtotime(date("Y-m-d H:i:s",$time));  //今天开始时间
		$EndTime = strtotime(date("Y-m-d ".'23:59:00',$time));//今天结束时间
		$_map = array();
		$DB_FIX = C('DB_PREFIX');
		$sql = "select SUM(a.amount) as amount from {$DB_FIX}touzhu a,{$DB_FIX}member b where a.isdraw!='-2' and a.isdraw!='0' and a.oddtime >= {$StartTime} and a.oddtime <= {$EndTime} and a.uid=b.id and b.parentid={$this->userinfo['id']}";
		$touzhuinfo = M()->query($sql);
		$touzhue = $touzhuinfo[0]['amount']?$touzhuinfo[0]['amount']:0;
		if($yjlist && $touzhue)foreach($yjlist as $k=>$v){
			if($v['min'] && $v['max']){
				if($touzhue>=$v['min'] && $touzhue<$v['max'])$yanyongs[]= $v;
			}elseif($v['min'] && !$v['max']){
				if($touzhue>=$v['min'])$yanyongs[]= $v;
			}
		}
		if($touzhue>0 && count($yanyongs)>=1){
			//当满足多个条件 取第一个
			$yanyongbili = current($yanyongs);
		}

		//奖励金额
		$jljine = ($yanyongbili['bilv']/100)*$touzhue;
		$this->jljine = $jljine;

		$db = M('dailiyongjin');
		//检测今日是否已领取
		$lqcount = $db->where("uid={$this->userinfo['id']} and yjtype='ri' and oddtime <= {$EndTime} and oddtime > {$StartTime}")->count();
		$this->lqcount = $lqcount;

		/*领取列表*/
		$_map1 = array();
		$_map1['uid'] = array('eq',$this->userinfo['id']);
		$_map1['yjtype'] = array('eq','ri');
		$count      = $db->where($_map1)->count();
		$Page       = new \Think\Page($count,20);
		$this->page       = $Page->show();
		$this->lqlist = $db->where($_map1)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		if(IS_POST){
			if($jljine<=0){
				$this->error('暂无佣金领取！');
			}
			if($lqcount>=1)$this->error('今日已领取！');
			$data = array();
			$data['uid']       = $this->userinfo['id'];
			$data['username']  = $this->userinfo['username'];
			$data['touzhuedu'] = $touzhue;
			$data['yongjinfw'] = $yanyongbili['min'].'-'.$yanyongbili['max'].'|'.$yanyongbili['bilv'];
			$data['amount']    = $jljine;
			$data['yjtype']    = 'ri';
			$data['oddtime']   = time();
			$data['shenhe']    = 0;
			$int = $db->data($data)->add();
			$int?$this->success('领取成功！'):$this->error('领取失败！');
			exit;
		}
		$_membergroup =	 M('membergroup');
		$allbili=$_membergroup->field('groupname,rifanyonglv')->where('isagent=1')->order('groupid ASC')->select();
		foreach ($allbili as $k => $v) {
			$_bilis[$k] = explode(';', str_replace('；', ';', $v['rifanyonglv']));
			$_biliss[$k][0] = explode('|', $_bilis[$k][0]);
			$_biliss[$k][1] = explode('|', $_bilis[$k][1]);
			$_biliss[$k][2] = explode('|', $_bilis[$k][2]);
			$mintozhu[0] = explode('-', $_biliss[$k][0][0]);
			$mintozhu[1] = explode('-', $_biliss[$k][1][0]);
			$mintozhu[2] = explode('-', $_biliss[$k][2][0]);
			$_bilisss[$k][] = $v['groupname'];
			$_bilisss[$k][] = $_biliss[$k][0][1];
			$_bilisss[$k][] = $_biliss[$k][1][1];
			$_bilisss[$k][] = $_biliss[$k][2][1];
			$this->assign('mintozhu', $mintozhu);
			$this->assign('bilisss', $_bilisss);
			$this->assign('allbili', $allbili);
			$this->assign('maxjlje', $allbili[count($allbili)-1]['jjje']);
		}
		$this->display();
	}
	function yuefanyong(){
		$map['groupid'] = $this->userinfo['groupid'];
		$yuefanyonglv = M('membergroup')->where($map)->getField('yuefanyonglv');
		$_yjlist = explode(';',str_replace('；',';',$yuefanyonglv));
		foreach($_yjlist as $k=>$v){
			$array = $array1 = array();
			$array = explode('|',$v);
			$array1= explode('-',$array[0]);
			$yjlist[$k]['min']  = $array1[0];
			$yjlist[$k]['max']  = $array1[1];;
			$yjlist[$k]['bilv'] = $array[1];
		}
		$months0 = mFristAndLast(date('Y'),date('m'));
		$beginToday = $months0['firstday'];
		$endToday   = $months0['lastday'];
		$_map = array();
		$DB_FIX = C('DB_PREFIX');
		$sql = "select SUM(a.amount) as amount from {$DB_FIX}touzhu a,{$DB_FIX}member b where a.isdraw!='-2' and a.isdraw!='0' and a.oddtime > {$beginToday} and a.oddtime < {$endToday} and a.uid=b.id and b.parentid={$this->userinfo['id']}";
		$touzhuinfo = M()->query($sql);
		$touzhue = $touzhuinfo[0]['amount']?$touzhuinfo[0]['amount']:0;
	 
		if($yjlist && $touzhue)foreach($yjlist as $k=>$v){
			if($v['min'] && $v['max']){
				if($touzhue>=$v['min'] && $touzhue<$v['max'])$yanyongs[]= $v;
			}elseif($v['min'] && !$v['max']){
				if($touzhue>=$v['min'])$yanyongs[]= $v;
			}
		}
		if($touzhue>0 && count($yanyongs)>=1){
			//当满足多个条件 取第一个
			$yanyongbili = current($yanyongs);
		}

		//奖励金额
		$jljine = ($yanyongbili['bilv']/100)*$touzhue;
		$this->jljine = $jljine;

		$db = M('dailiyongjin');
		//检测今日是否已领取
		$lqcount = $db->where("uid={$this->userinfo['id']} and yjtype='yue' and oddtime <= {$endToday} and oddtime > {$beginToday}")->count();
		$this->lqcount = $lqcount;

		/*领取列表*/
		$_map1 = array();
		$_map1['uid'] = array('eq',$this->userinfo['id']);
		$_map1['yjtype'] = array('eq','yue');
		$count      = $db->where($_map1)->count();
		$Page       = new \Think\Page($count,20);
		$this->page       = $Page->show();
		$this->lqlist = $db->where($_map1)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		if(IS_POST){
			if($jljine<=0){
				$this->error('暂无佣金领取！');
			}
			if($lqcount>=1)$this->error('本月已领取！');
			$data = array();
			$data['uid']       = $this->userinfo['id'];
			$data['username']  = $this->userinfo['username'];
			$data['touzhuedu'] = $touzhue;
			$data['yongjinfw'] = $yanyongbili['min'].'-'.$yanyongbili['max'].'|'.$yanyongbili['bilv'];
			$data['amount']    = $jljine;
			$data['yjtype']    = 'yue';
			$data['oddtime']   = time();
			$data['shenhe']    = 0;
			$int = $db->data($data)->add();
			$int?$this->success('领取成功！'):$this->error('领取失败！');
			exit;
		}
		$_membergroup =	 M('membergroup');
		$allbili=$_membergroup->field('groupname,rifanyonglv')->where('isagent=1')->order('groupid ASC')->select();
		foreach ($allbili as $k => $v) {
			$_bilis[$k] = explode(';', str_replace('；', ';', $v['rifanyonglv']));
			$_biliss[$k][0] = explode('|', $_bilis[$k][0]);
			$_biliss[$k][1] = explode('|', $_bilis[$k][1]);
			$_biliss[$k][2] = explode('|', $_bilis[$k][2]);
			$mintozhu[0] = explode('-', $_biliss[$k][0][0]);
			$mintozhu[1] = explode('-', $_biliss[$k][1][0]);
			$mintozhu[2] = explode('-', $_biliss[$k][2][0]);
			$_bilisss[$k][] = $v['groupname'];
			$_bilisss[$k][] = $_biliss[$k][0][1];
			$_bilisss[$k][] = $_biliss[$k][1][1];
			$_bilisss[$k][] = $_biliss[$k][2][1];
			$this->assign('mintozhu', $mintozhu);
			$this->assign('bilisss', $_bilisss);
			$this->assign('allbili', $allbili);
			$this->assign('maxjlje', $allbili[count($allbili)-1]['jjje']);
		}
		$this->display();
	}
	function zhuce(){
		$defautgroupid = M('membergroup')->where("isagent=0 and groupid=1 and isdefautreg=1")->getField('groupid');
		if(IS_POST){
			$username = $_POST['userName'];
			$password = $_POST['passWord'];
			if(!preg_match('/^([a-zA-Z0-9]|[_]){3,16}$/',$username)){
				$this->error('用户名格式：3-16位英文与数字或下划线组合的字符！');
			}
			if(!preg_match('/^[\w\W]{6,16}$/',$password)){
				$this->error('密码请输入6到16位字符串！');
			}
			if($info = M('member')->where(array('username'=>$param))->find()){
				$this->error('该用户名已被注册！');
			}
			$key = self::_before_reg_getkey();
			$data['username'] = $username;
			$data['groupid']  = $defautgroupid?$defautgroupid:0;
			$data['password'] = $password;

			$data['money']   = 0;
			$data['point']   = 0;
			$data['face']   = "/resources/images/face/".rand(1,25).".jpg";
			$data['regtime'] = NOW_TIME;
			$data['regip']   = get_client_ip();
			$data['logintime'] = 0;
			$data['loginip']   = '';
			$data['key']     = $key;
			$data['password'] = sys_md5($password,$key);
			$data['parentid'] = $this->userinfo['id'];
			$int = M('member')->data($data)->add();
			$int?$this->success('注册成功',U('Agent/Index/tuandui')):$this->error('注册失败');
			exit;
		}
		$this->display();
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
}
?>