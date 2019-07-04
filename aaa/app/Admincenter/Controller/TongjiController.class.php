<?php
namespace Admincenter\Controller;
use Think\Controller;
class TongjiController extends CommonController {
	public function __construct(){
		parent::__construct();
	}
	function gaikuang(){//['isnb'=>1]
		$okusers = M('member')->where(['isnb'=>0])->field('id,username')->select(); //查找不是内部会员
		$okuis = [];
		foreach($okusers as $k=>$v){
			$okuis[] = $v['id'];                                                   //将会员的ID放入一个数组
		}
		//$int1 = M('recharge')->where(['uid'=>['not in',$okuis],])->delete();
		//$int2 = M('withdraw')->where(['uid'=>['not in',$okuis],])->delete();
		//dump($int1);dump($int2);dump($okuis);exit;
		/*//M('withdraw')->where(['uid'=>['not in',$okuis],])->delete();
		$sDate    = I('sDate');
		$sDate    = $sDate?$sDate:'';
		$eDate    = I('eDate');
		$eDate    = $eDate?$eDate:'';
		if($sDate){
			$map1['oddtime'][]    = ['egt',strtotime($sDate)];
			$this->assign('_sDate',urldecode($sDate));
		}
		if($eDate){
			$map1['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$this->assign('_eDate',urldecode($eDate));
		}
		$map = [];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$map['uid'] = array('in',$okuis);
		$map['isauto'] = array('eq',2);
		$map['sdtype'] = array('eq',-1);
		$jians = M('recharge')->where($map)->field('uid,username,amount')->order('amount desc')->select();
		$jianstotal = M('recharge')->where($map)->field('uid,username,amount')->sum('amount');
		$map = [];
		$map['uid'] = array('in',$okuis);
		$map['isauto'] = array('eq',2);
		$map['sdtype'] = array('eq',1);
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$jias = M('recharge')->where($map)->field('uid,username,amount')->order('amount desc')->select();
		$jiastotal = M('recharge')->where($map)->field('uid,username,amount')->sum('amount');
		echo "手动减统计：<br>";
		foreach($jians as $k=>$v){
			echo $v['username'].'=='.$v['amount']."<br>";
		}
		echo "手动减总金额：{$jianstotal}<br>";
		echo "<hr>";
		echo "手动加统计：<br>";
		foreach($jias as $k=>$v){
			echo $v['username'].'=='.$v['amount']."<br>";
		}
		echo "手动加总金额：{$jiastotal}<br>";
		echo "<hr>";
		dump($jians);
		dump($jianstotal);
		
		dump($jians);
		dump($jiastotal);
		//dump($okuis);
		exit;*/


		$username = I('username');
		$sDate    = I('sDate');
		$sDate    = $sDate?$sDate:'';
		$eDate    = I('eDate');
		$eDate    = $eDate?$eDate:'';
		$map1        = [];
		if($username){                                   //查找的会员条件存在
			$map1['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($sDate){                                      //查找开始日期存在
			$map1['oddtime'][]    = ['egt',strtotime($sDate)];
			$this->assign('_sDate',urldecode($sDate));
		}
		if($eDate){                                      //想找结束期存在
			$map1['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$this->assign('_eDate',urldecode($eDate));
		}
		$testusers = M('member')->where(['isnb'=>1])->field('id')->select();  //查找内部会员
		$testuids = [];
		foreach($testusers as $k=>$v){
			$testuids[] = $v['id'];                      //将内部会员ID放入一个数组
		}
		if($testuids){
			$map1['uid'] = ['not in',$testuids];         //查找条件:会员ID不在内部会员ID里面
		}

		//盈亏统计
		//自动充值
		$map = [];
		$map['state'] = ['eq',1];                       //查找条件:已审核
		$map['isauto'] = ['eq',1];                      //查找条件:自动充值
		//if($testuids)$map['uid'] = ['not in',$testuids];

		$map['uid'] = ['in',$okuis];                   //查找条件:内部会员ID
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$zidchongzhiall = M('recharge')->where($map)->sum('amount');   //自动充值
		//手动充值加
		$map = [];
		$map['state'] = ['eq',1];
		$map['isauto'] = ['eq',2];
		$map['sdtype'] = ['eq',1];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$sdjiachongzhiall = M('recharge')->where($map)->sum('amount');//手动充值
		//手动充值减
		$map = [];
		$map['state'] = ['eq',1];
		$map['isauto'] = ['eq',2];
		$map['sdtype'] = ['eq',-1];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$sdjianchongzhiall = M('recharge')->where($map)->sum('amount');

		//提款
		$map = [];
		$map['state'] = ['eq',1];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$tikuanall = M('withdraw')->where($map)->sum('amount');
		//消费
		$map = [];
		$map['isdraw'] = ['in',[1,-1]];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$touzhuall = 0;
		$touzhuall = M('touzhu')->where($map)->sum('amount');

		/*
		//返点
		$map = [];
		$map['type'] = ['eq','commission'];
		$map = array_merge($map,$map1);
		$fandianall = 0;
		$fandianall = M('fuddetail')->where($map)->sum('amount');
		*/
		//中奖
		$map = [];
		$map['isdraw'] = ['eq',1];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$zhongjiangall = 0;
		$zhongjiangall = M('touzhu')->where($map)->sum('okamount');
		//活动
		$map = [];
		$map['type'] = ['in',['pointexchange','fanshui','yongjinshenhe','jinjishenhe','activity_bindcard','activity_czzs','activity_rxf','activity_rks','activity_yxf','activity_yks']];
		//if($testuids)$map['uid'] = ['not in',$testuids];
 	    $map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$huodongall = 0;
		$huodongall = M('fuddetail')->where($map)->sum('amount');
		$yingkuis = [
			'zidchongzhiall'   => $zidchongzhiall?$zidchongzhiall:0,
			'sdjiachongzhiall'   => $sdjiachongzhiall?$sdjiachongzhiall:0,
			'sdjianchongzhiall'   => $sdjianchongzhiall?$sdjianchongzhiall:0,
			'tikuanall'     => $tikuanall?$tikuanall:0,
			'touzhuall'     => $touzhuall?$touzhuall:0,
			'zhongjiangall' => $zhongjiangall?$zhongjiangall:0,
			'huodongall'    => $huodongall?$huodongall:0,
		];
		$yingkuis['ctyingkui'] = ($yingkuis['zidchongzhiall'] + $yingkuis['sdjiachongzhiall'] - $yingkuis['sdjianchongzhiall']) - $yingkuis['tikuanall'];
		$yingkuis['tzyingkui'] = $yingkuis['touzhuall'] - $yingkuis['zhongjiangall'];
		$this->assign('yingkuis',$yingkuis);

		//用户统计
		//所有用户
		$map = [];
		//if($testuids)$map['id'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		$usercountall = 0;
		$usercountall = M('member')->where($map)->count();
		//代理数
		$map = [];
		//if($testuids)$map['id'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		$map['proxy'] = ['eq',1];
		$userdailiall = 0;
		$userdailiall = M('member')->where($map)->count();
		//普通用户
		$userputongall = $usercountall-$userdailiall;
		//在线数
		$tonline = 30;
		$map = [];
		//if($testuids)$map['id'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		$_t = time();
		$map['onlinetime']    = ['EGT',$_t-$tonline];
		$useronlineall = 0;
		$useronlineall = M('member')->where($map)->count();
		//可用余额
		$map = [];
		if($testuids)$map['id'] = ['not in',$testuids];
		$userbalanceall = 0;
		$userbalanceall = M('member')->where($map)->sum('balance');
		$usertongji = [
			'usercountall'   => $usercountall?$usercountall:0,
			'userdailiall'     => $userdailiall?$userdailiall:0,
			'userputongall'     => $userputongall?$userputongall:0,
			'useronlineall'    => $useronlineall?$useronlineall:0,
			'userbalanceall' => $userbalanceall?$userbalanceall:0,
		];
		$this->assign('usertongji',$usertongji);

		//彩票统计
//		$where['isopen'] = 1;
		if(I('typeid'))$where['typeid'] = I('typeid');
		$cplist = M('caipiao')->where($where)->order('typeid')->select();
		$cpxiaoji = [];
		foreach($cplist as $k=>$v){
			$map = [];
			$map['cpname'] = ['eq',$v['name']];
			$map['isdraw'] = ['in',[1,-1]];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$cplist[$k]['title'] = $v['title'];
			$cplist[$k]['name'] = $v['name'];
			$cplist[$k]['touzhuall'] = M('touzhu')->where($map)->sum('amount');

			//中奖
			$map = [];
			$map['cpname'] = ['eq',$v['name']];
			$map['isdraw'] = ['in',[1]];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$cplist[$k]['zhongjiangall'] = M('touzhu')->where($map)->sum('okamount');

			$cpxiaoji['touzhuall']  += $cplist[$k]['touzhuall'];
			$cpxiaoji['zhongjiangall']  += $cplist[$k]['zhongjiangall'];
		}
		$this->assign('cplist',$cplist);
		$this->assign('cpxiaoji',$cpxiaoji);
		$this->display();
	}
	function Tongjiweb(){//['isnb'=>1]
		$okusers = M('member')->where(['isnb'=>0])->field('id,username')->select();
		$okuis = [];
		foreach($okusers as $k=>$v){
			$okuis[] = $v['id'];
		}
		//$int1 = M('recharge')->where(['uid'=>['not in',$okuis],])->delete();
		//$int2 = M('withdraw')->where(['uid'=>['not in',$okuis],])->delete();
		//dump($int1);dump($int2);dump($okuis);exit;
		/*//M('withdraw')->where(['uid'=>['not in',$okuis],])->delete();
		$sDate    = I('sDate');
		$sDate    = $sDate?$sDate:'';
		$eDate    = I('eDate');
		$eDate    = $eDate?$eDate:'';
		if($sDate){
			$map1['oddtime'][]    = ['egt',strtotime($sDate)];
			$this->assign('_sDate',urldecode($sDate));
		}
		if($eDate){
			$map1['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$this->assign('_eDate',urldecode($eDate));
		}
		$map = [];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$map['uid'] = array('in',$okuis);
		$map['isauto'] = array('eq',2);
		$map['sdtype'] = array('eq',-1);
		$jians = M('recharge')->where($map)->field('uid,username,amount')->order('amount desc')->select();
		$jianstotal = M('recharge')->where($map)->field('uid,username,amount')->sum('amount');
		$map = [];
		$map['uid'] = array('in',$okuis);
		$map['isauto'] = array('eq',2);
		$map['sdtype'] = array('eq',1);
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$jias = M('recharge')->where($map)->field('uid,username,amount')->order('amount desc')->select();
		$jiastotal = M('recharge')->where($map)->field('uid,username,amount')->sum('amount');
		echo "手动减统计：<br>";
		foreach($jians as $k=>$v){
			echo $v['username'].'=='.$v['amount']."<br>";
		}
		echo "手动减总金额：{$jianstotal}<br>";
		echo "<hr>";
		echo "手动加统计：<br>";
		foreach($jias as $k=>$v){
			echo $v['username'].'=='.$v['amount']."<br>";
		}
		echo "手动加总金额：{$jiastotal}<br>";
		echo "<hr>";
		dump($jians);
		dump($jianstotal);

		dump($jians);
		dump($jiastotal);
		//dump($okuis);
		exit;*/


		$username = I('username');
		$sDate    = I('sDate');
		$sDate    = $sDate?$sDate:'';
		$eDate    = I('eDate');
		$eDate    = $eDate?$eDate:'';
		$map1        = [];
		if($username){
			$map1['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($sDate){
			$map1['oddtime'][]    = ['egt',strtotime($sDate)];
			$this->assign('_sDate',urldecode($sDate));
		}
		if($eDate){
			$map1['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$this->assign('_eDate',urldecode($eDate));
		}
		$testusers = M('member')->where(['isnb'=>1])->field('id')->select();
		$testuids = [];
		foreach($testusers as $k=>$v){
			$testuids[] = $v['id'];
		}
		if($testuids){
			$map1['uid'] = ['not in',$testuids];
		}

		//盈亏统计
		//自动充值
		$map = [];
		$map['state'] = ['eq',1];
		$map['isauto'] = ['eq',1];
		//if($testuids)$map['uid'] = ['not in',$testuids];

		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$zidchongzhiall = M('recharge')->where($map)->sum('amount');
		//手动充值加
		$map = [];
		$map['state'] = ['eq',1];
		$map['isauto'] = ['eq',2];
		$map['sdtype'] = ['eq',1];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$sdjiachongzhiall = M('recharge')->where($map)->sum('amount');
		//手动充值减
		$map = [];
		$map['state'] = ['eq',1];
		$map['isauto'] = ['eq',2];
		$map['sdtype'] = ['eq',-1];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$sdjianchongzhiall = M('recharge')->where($map)->sum('amount');

		//提款
		$map = [];
		$map['state'] = ['eq',1];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$tikuanall = M('withdraw')->where($map)->sum('amount');
		//消费
		$map = [];
		$map['isdraw'] = ['in',[1,-1]];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$touzhuall = 0;
		$touzhuall = M('touzhu')->where($map)->sum('amount');

		/*
		//返点
		$map = [];
		$map['type'] = ['eq','commission'];
		$map = array_merge($map,$map1);
		$fandianall = 0;
		$fandianall = M('fuddetail')->where($map)->sum('amount');
		*/
		//中奖
		$map = [];
		$map['isdraw'] = ['eq',1];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$zhongjiangall = 0;
		$zhongjiangall = M('touzhu')->where($map)->sum('okamount');
		//活动
		$map = [];
		$map['type'] = ['in',['pointexchange','fanshui','yongjinshenhe','jinjishenhe','activity_czzs','activity_bindcard','activity_czzs','activity_rxf','activity_rks','activity_yxf','activity_yks']];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$huodongall = 0;
		$huodongall = M('fuddetail')->where($map)->sum('amount');
		$yingkuis = [
			'zidchongzhiall'   => $zidchongzhiall?$zidchongzhiall:0,
			'sdjiachongzhiall'   => $sdjiachongzhiall?$sdjiachongzhiall:0,
			'sdjianchongzhiall'   => $sdjianchongzhiall?$sdjianchongzhiall:0,
			'tikuanall'     => $tikuanall?$tikuanall:0,
			'touzhuall'     => $touzhuall?$touzhuall:0,
			'zhongjiangall' => $zhongjiangall?$zhongjiangall:0,
			'huodongall'    => $huodongall?$huodongall:0,
		];
		$yingkuis['ctyingkui'] = ($yingkuis['zidchongzhiall'] + $yingkuis['sdjiachongzhiall'] - $yingkuis['sdjianchongzhiall']) - $yingkuis['tikuanall'];
		$yingkuis['tzyingkui'] = $yingkuis['touzhuall'] - $yingkuis['zhongjiangall'];
		$this->assign('yingkuis',$yingkuis);

		//用户统计
		//所有用户
		$map = [];
		//if($testuids)$map['id'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		$usercountall = 0;
		$usercountall = M('member')->where($map)->count();
		//代理数
		$map = [];
		//if($testuids)$map['id'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		$map['proxy'] = ['eq',1];
		$userdailiall = 0;
		$userdailiall = M('member')->where($map)->count();
		//普通用户
		$userputongall = $usercountall-$userdailiall;
		//在线数
		$tonline = 30;
		$map = [];
		//if($testuids)$map['id'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		$_t = time();
		$map['onlinetime']    = ['EGT',$_t-$tonline];
		$useronlineall = 0;
		$useronlineall = M('member')->where($map)->count();
		//可用余额
		$map = [];
		if($testuids)$map['id'] = ['not in',$testuids];
		$userbalanceall = 0;
		$userbalanceall = M('member')->where($map)->sum('balance');
		$usertongji = [
			'usercountall'   => $usercountall?$usercountall:0,
			'userdailiall'     => $userdailiall?$userdailiall:0,
			'userputongall'     => $userputongall?$userputongall:0,
			'useronlineall'    => $useronlineall?$useronlineall:0,
			'userbalanceall' => $userbalanceall?$userbalanceall:0,
		];
		$this->assign('usertongji',$usertongji);

		//彩票统计
		$cplist = M('caipiao')->where(['isopen'=>1])->order('typeid')->select();
		$cpxiaoji = [];
		foreach($cplist as $k=>$v){
			$map = [];
			$map['cpname'] = ['eq',$v['name']];
			$map['isdraw'] = ['in',[1,-1]];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$cplist[$k]['title'] = $v['title'];
			$cplist[$k]['name'] = $v['name'];
			$cplist[$k]['touzhuall'] = M('touzhu')->where($map)->sum('amount');

			//中奖
			$map = [];
			$map['cpname'] = ['eq',$v['name']];
			$map['isdraw'] = ['in',[1]];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$cplist[$k]['zhongjiangall'] = M('touzhu')->where($map)->sum('okamount');

			$cpxiaoji['touzhuall']  += $cplist[$k]['touzhuall'];
			$cpxiaoji['zhongjiangall']  += $cplist[$k]['zhongjiangall'];
		}
		$this->assign('cplist',$cplist);
		$this->assign('cpxiaoji',$cpxiaoji);
		$this->display();
	}
	function gaikuang1(){//['isnb'=>1]

		$okusers = M('member')->where(['isnb'=>0])->field('id,username')->select();
		$okuis = [];
		foreach($okusers as $k=>$v){
			$okuis[] = $v['id'];
		}

		$username = I('username');
		$sDate    = I('sDate');
		$sDate    = $sDate?$sDate:'';
		$eDate    = I('eDate');
		$eDate    = $eDate?$eDate:'';
		$map1        = [];
		if($username){
			$map1['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($sDate){
			$map1['oddtime'][]    = ['egt',strtotime($sDate)];
			$this->assign('_sDate',urldecode($sDate));
		}
		if($eDate){
			$map1['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$this->assign('_eDate',urldecode($eDate));
		}
		$testusers = M('member')->where(['isnb'=>1])->field('id')->select();
		$testuids = [];
		foreach($testusers as $k=>$v){
			$testuids[] = $v['id'];
		}
		if($testuids){
			$map1['uid'] = ['not in',$testuids];
		}

		//盈亏统计
		//自动充值
		$map = [];
		$map['state'] = ['eq',1];
		$map['isauto'] = ['eq',1];
		if($testuids)$map['uid'] = ['not in',$testuids];

		//$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$zidchongzhiall = M('recharge')->where($map)->sum('amount');
		//手动充值加
		$map = [];
		$map['state'] = ['eq',1];
		$map['isauto'] = ['eq',2];
		$map['sdtype'] = ['eq',1];
		if($testuids)$map['uid'] = ['not in',$testuids];
		//$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$sdjiachongzhiall = M('recharge')->where($map)->sum('amount');
		//手动充值减
		$map = [];
		$map['state'] = ['eq',1];
		$map['isauto'] = ['eq',2];
		$map['sdtype'] = ['eq',-1];
		if($testuids)$map['uid'] = ['not in',$testuids];
		//$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$sdjianchongzhiall = M('recharge')->where($map)->sum('amount');
		//dump( M('recharge')->where($map)->order("amount desc")->limit(50)->select());exit;

		//提款
		$map = [];
		$map['state'] = ['eq',1];
		//if($testuids)$map['uid'] = ['not in',$testuids];
		$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$tikuanall = M('withdraw')->where($map)->sum('amount');
		//dump($map);
		//select ip,count(*) as num from 表名 where 条件 group by ip order by num desc
		dump(M()->query("select username,loginip,count(*) as num from caipiao_member group by loginip order by num desc"));
		exit;
		//消费
		$map = [];
		$map['isdraw'] = ['in',[1,-1]];
		if($testuids)$map['uid'] = ['not in',$testuids];
		//$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$touzhuall = 0;
		$touzhuall = M('touzhu')->where($map)->sum('amount');

		/*
		//返点
		$map = [];
		$map['type'] = ['eq','commission'];
		$map = array_merge($map,$map1);
		$fandianall = 0;
		$fandianall = M('fuddetail')->where($map)->sum('amount');
		*/
		//中奖
		$map = [];
		$map['isdraw'] = ['eq',1];
		if($testuids)$map['uid'] = ['not in',$testuids];
		//$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$zhongjiangall = 0;
		$zhongjiangall = M('touzhu')->where($map)->sum('okamount');
		//活动
		$map = [];
		$map['type'] = ['in',['pointexchange','fanshui','yongjinshenhe','jinjishenhe','activity_bindcard','activity_czzs','activity_rxf','activity_rks','activity_yxf','activity_yks']];
		if($testuids)$map['uid'] = ['not in',$testuids];
		//$map['uid'] = ['in',$okuis];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$huodongall = 0;
		$huodongall = M('fuddetail')->where($map)->sum('amount');
		$yingkuis = [
			'zidchongzhiall'   => $zidchongzhiall?$zidchongzhiall:0,
			'sdjiachongzhiall'   => $sdjiachongzhiall?$sdjiachongzhiall:0,
			'sdjianchongzhiall'   => $sdjianchongzhiall?$sdjianchongzhiall:0,
			'tikuanall'     => $tikuanall?$tikuanall:0,
			'touzhuall'     => $touzhuall?$touzhuall:0,
			'zhongjiangall' => $zhongjiangall?$zhongjiangall:0,
			'huodongall'    => $huodongall?$huodongall:0,
		];
		$yingkuis['ctyingkui'] = ($yingkuis['zidchongzhiall'] + $yingkuis['sdjiachongzhiall'] - $yingkuis['sdjianchongzhiall']) - $yingkuis['tikuanall'];
		$yingkuis['tzyingkui'] = $yingkuis['touzhuall'] - $yingkuis['zhongjiangall'];
		$this->assign('yingkuis',$yingkuis);

		//用户统计
		//所有用户
		$map = [];
		if($testuids)$map['id'] = ['not in',$testuids];
		//$map['uid'] = ['in',$okuis];
		$usercountall = 0;
		$usercountall = M('member')->where($map)->count();
		//代理数
		$map = [];
		if($testuids)$map['id'] = ['not in',$testuids];
		//$map['uid'] = ['in',$okuis];
		$map['proxy'] = ['eq',1];
		$userdailiall = 0;
		$userdailiall = M('member')->where($map)->count();
		//普通用户
		$userputongall = $usercountall-$userdailiall;
		//在线数
		$tonline = 30;
		$map = [];
		if($testuids)$map['id'] = ['not in',$testuids];
		//$map['uid'] = ['in',$okuis];
		$_t = time();
		$map['onlinetime']    = ['EGT',$_t-$tonline];
		$useronlineall = 0;
		$useronlineall = M('member')->where($map)->count();
		//可用余额
		$map = [];
		if($testuids)$map['id'] = ['not in',$testuids];
		$userbalanceall = 0;
		$userbalanceall = M('member')->where($map)->sum('balance');
		$usertongji = [
			'usercountall'   => $usercountall?$usercountall:0,
			'userdailiall'     => $userdailiall?$userdailiall:0,
			'userputongall'     => $userputongall?$userputongall:0,
			'useronlineall'    => $useronlineall?$useronlineall:0,
			'userbalanceall' => $userbalanceall?$userbalanceall:0,
		];
		$this->assign('usertongji',$usertongji);

		//彩票统计
		$cplist = M('caipiao')->where(['isopen'=>1])->order('typeid')->select();
		$cpxiaoji = [];
		foreach($cplist as $k=>$v){
			$map = [];
			$map['cpname'] = ['eq',$v['name']];
			$map['isdraw'] = ['in',[1,-1]];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$cplist[$k]['title'] = $v['title'];
			$cplist[$k]['name'] = $v['name'];
			$cplist[$k]['touzhuall'] = M('touzhu')->where($map)->sum('amount');

			//中奖
			$map = [];
			$map['cpname'] = ['eq',$v['name']];
			$map['isdraw'] = ['in',[1]];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$cplist[$k]['zhongjiangall'] = M('touzhu')->where($map)->sum('okamount');

			$cpxiaoji['touzhuall']  += $cplist[$k]['touzhuall'];
			$cpxiaoji['zhongjiangall']  += $cplist[$k]['zhongjiangall'];
		}
		$this->assign('cplist',$cplist);
		$this->assign('cpxiaoji',$cpxiaoji);
		$this->display('gaikuang');
	}
	function yingkui(){
		$username = I('username');
		$sDate    = I('sDate');
		$sDate    = $sDate?$sDate:date('Ymd',(strtotime(date('Y-m-d',time()))-86400*6));
		$eDate    = I('eDate');
		$eDate    = $eDate?$eDate:date('Ymd',time());
		$this->assign('_sDate',urldecode($sDate));
		$this->assign('_eDate',urldecode($eDate));
		$map1 = [];
		$testusers = M('member')->where(['isnb'=>1])->field('id')->select();
		$testuids = [];
		foreach($testusers as $k=>$v){
			$testuids[] = $v['id'];
		}
		if($testuids){
			$map1['uid'] = ['not in',$testuids];
		}
		if($username){
			$map1['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		$days     = ceil((strtotime($eDate)-strtotime($sDate))/86400);
		$_t = strtotime($eDate);
		$list = [];$zongji = [];
		for($i=0;$i<=$days;$i++){
			$datetime = date('Y-m-d',$_t-86400*$i);
			//充值
			$map = [];
			$map['isauto'] = ['eq',1];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['egt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$map['state'] = ['eq',1];
			$chongzhiall = 0;
			$zdchongzhiall = M('recharge')->where($map)->sum('amount');
			//手动充值加
			$map = [];
			$map['state'] = ['eq',1];
			$map['isauto'] = ['eq',2];
			$map['sdtype'] = ['eq',1];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['egt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$sdjiachongzhiall = 0;
			$sdjiachongzhiall = M('recharge')->where($map)->sum('amount');
			//手动充值减
			$map = [];
			$map['state'] = ['eq',1];
			$map['isauto'] = ['eq',2];
			$map['sdtype'] = ['eq',-1];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['egt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$sdjianchongzhiall = 0;
			$sdjianchongzhiall = M('recharge')->where($map)->sum('amount');



			//提款
			$map = [];
			$map['state'] = ['eq',1];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['egt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$tikuanall = 0;
			$tikuanall = M('withdraw')->where($map)->sum('amount');
			//消费
			$map = [];
			$map['isdraw'] = ['in',[1,-1]];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['egt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$touzhuall = 0;
			$touzhuall = M('touzhu')->where($map)->sum('amount');
			//中奖
			$map = [];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['egt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$map['isdraw'] = ['eq',1];
			$zhongjiangall = 0;
			$zhongjiangall = M('touzhu')->where($map)->sum('okamount');
			//活动
			$map = [];
			$map['oddtime'][]    = ['egt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$map['type'] = ['in',['pointexchange','fanshui','jinjishenhe','yongjinshenhe','activity_bindcard','activity_czzs','activity_rxf','activity_rks','activity_yxf','activity_yks']];
			$map = array_merge($map,$map1);
			$huodongall = 0;
			$huodongall = M('fuddetail')->where($map)->sum('amount');
			$list[$i] = [
				'date'             => $datetime,
				'zdchongzhiall'      => $zdchongzhiall?$zdchongzhiall:0,
				'sdjiachongzhiall'      => $sdjiachongzhiall?$sdjiachongzhiall:0,
				'sdjianchongzhiall'      => $sdjianchongzhiall?$sdjianchongzhiall:0,
				'tikuanall'        => $tikuanall?$tikuanall:0,
				'touzhuall'        => $touzhuall?$touzhuall:0,
				'zhongjiangall'    => $zhongjiangall?$zhongjiangall:0,
				'huodongall'       => $huodongall?$huodongall:0,
			];
			$list[$i]['ctyingkui'] = $list[$i]['zdchongzhiall'] + $list[$i]['sdjiachongzhiall'] - $list[$i]['sdjianchongzhiall'] - $list[$i]['tikuanall'];
			$list[$i]['tzyingkui'] = $list[$i]['touzhuall'] - $list[$i]['zhongjiangall'];

			/*$zongji['zdchongzhiall'] += $list[$i]['zdchongzhiall'];
			$zongji['sdjiachongzhiall'] += $list[$i]['sdjiachongzhiall'];
			$zongji['sdjianchongzhiall'] += $list[$i]['sdjianchongzhiall'];
			$zongji['tikuanall']   += $list[$i]['tikuanall'];
			$zongji['touzhuall']   += $list[$i]['touzhuall'];
			$zongji['zhongjiangall']+= $list[$i]['zhongjiangall'];
			$zongji['huodongall']  += $list[$i]['huodongall'];
			$zongji['ctyingkui']     += $list[$i]['ctyingkui'];
			$zongji['tzyingkui']     += $list[$i]['tzyingkui'];*/
		}
		$_pagasize  = 10;
		$count      = count($list);
		if(count($list)>$_pagasize){
			$Page       = new \Think\Page($count,$_pagasize);
			$show       = $Page->show();
			$_p = I('p',1,'intval');
			$list       = array_slice($list,($_p-1)*$_pagasize,$_pagasize);
			$this->assign('page',$show);
		}
		$this->assign('zongji',$zongji);
		$this->assign('totalcount',$count);
		$this->assign('list',$list);
		$this->display();
	}
	function user(){
		$username = I('username');
		$sDate    = I('sDate');
		$sDate    = $sDate?$sDate:date('Ymd',(strtotime(date('Y-m-d',time()))-86400*1));
		$eDate    = I('eDate');
		$eDate    = $eDate?$eDate:date('Ymd',time());
		$this->assign('_sDate',urldecode($sDate));
		$this->assign('_eDate',urldecode($eDate));
		$_t = strtotime($eDate);
		$map1 = [];
		//$map['oddtime'][]    = ['gt',strtotime($datetime)];
		//$map['oddtime'][]    = ['elt',strtotime($datetime)+86400];
		$map1['isnb']    = ['eq',0];
		if($username){
			$map1['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		$zongji = [];
		$_pagasize  = 10;
		$count      = M('member')->where($map1)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = M('member')->where($map1)->order('id desc')->field('id,username')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($list as $k=>$v){
			//充值
			$map = [];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['gt',strtotime($sDate)];
			$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$map['isauto'] = ['eq',1];
			$map['uid'] = ['eq',$v['id']];
			$map['state'] = ['eq',1];
			$zdchongzhiall = 0;
			$zdchongzhiall = M('recharge')->where($map)->sum('amount');
			//手动充值加
			$map = [];
			$map['uid'] = ['eq',$v['id']];
			$map['state'] = ['eq',1];
			$map['isauto'] = ['eq',2];
			$map['sdtype'] = ['eq',1];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['gt',strtotime($sDate)];
			$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$sdjiachongzhiall = 0;
			$sdjiachongzhiall = M('recharge')->where($map)->sum('amount');
			//手动充值减
			$map = [];
			$map['uid'] = ['eq',$v['id']];
			$map['state'] = ['eq',1];
			$map['isauto'] = ['eq',2];
			$map['sdtype'] = ['eq',-1];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['gt',strtotime($sDate)];
			$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$sdjianchongzhiall = 0;
			$sdjianchongzhiall = M('recharge')->where($map)->sum('amount');

			//提款
			$map = [];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['gt',strtotime($sDate)];
			$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$map['uid'] = ['eq',$v['id']];
			$map['state'] = ['eq',1];
			$tikuanall = 0;
			$tikuanall = M('withdraw')->where($map)->sum('amount');
			//消费
			$map = [];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['gt',strtotime($sDate)];
			$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$map['uid'] = ['eq',$v['id']];
			$map['isdraw'] = ['in',[1,-1]];
			$touzhuall = 0;
			$touzhuall = M('touzhu')->where($map)->sum('amount');
			//中奖
			$map = [];
			$map['oddtime'][]    = ['gt',strtotime($sDate)];
			$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$map['uid'] = ['eq',$v['id']];
			$map['isdraw'] = ['eq',1];
			$zhongjiangall = 0;
			$zhongjiangall = M('touzhu')->where($map)->sum('okamount');
			//活动
			$map = [];
			if($username)$map['username']    = ['eq',$username];
			$map['oddtime'][]    = ['gt',strtotime($sDate)];
			$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$map['uid'] = ['eq',$v['id']];
			$map['type'] = ['in',['pointexchange','fanshui','yongjinshenhe','jinjishenhe','activity_bindcard','activity_czzs','activity_rxf','activity_rks','activity_yxf','activity_yks']];
			$huodongall = 0;
			$huodongall = M('fuddetail')->where($map)->sum('amount');

			$arr = [];
			$arr = [
				'date'             => $sDate.'~'.$eDate,
				'zdchongzhiall'      => $zdchongzhiall?$zdchongzhiall:0,
				'sdjiachongzhiall'      => $sdjiachongzhiall?$sdjiachongzhiall:0,
				'sdjianchongzhiall'      => $sdjianchongzhiall?$sdjianchongzhiall:0,
				'tikuanall'        => $tikuanall?$tikuanall:0,
				'touzhuall'        => $touzhuall?$touzhuall:0,
				'zhongjiangall'    => $zhongjiangall?$zhongjiangall:0,
				'huodongall'       => $huodongall?$huodongall:0,
			];
			$arr['ctyingkui'] = $arr['zdchongzhiall'] + $arr['sdjiachongzhiall'] - $arr['sdjianchongzhiall'] - $arr['tikuanall'];
			$arr['tzyingkui'] = $arr['touzhuall'] - $arr['zhongjiangall'];
			$list[$k] = array_merge($v,$arr);
			$zongji['zdchongzhiall'] += $arr['zdchongzhiall'];
			$zongji['sdjiachongzhiall'] += $arr['sdjiachongzhiall'];
			$zongji['sdjianchongzhiall'] += $arr['sdjianchongzhiall'];
			$zongji['tikuanall']   += $arr['tikuanall'];
			$zongji['touzhuall']   += $arr['touzhuall'];
			$zongji['zhongjiangall']+= $arr['zhongjiangall'];
			$zongji['huodongall']  += $arr['huodongall'];
			$zongji['ctyingkui']     += $arr['ctyingkui'];
			$zongji['tzyingkui']     += $arr['tzyingkui'];
		}
		$this->assign('page',$show);
		$this->assign('zongji',$zongji);
		$this->assign('totalcount',$count);
		$this->assign('list',$list);

		$this->display();
	}

	function tdgaikuang(){
		$username = I('username');
		$sDate    = I('sDate');
		$eDate    = I('eDate');
		if($sDate)$this->assign('_sDate',urldecode($sDate));
		if($eDate)$this->assign('_eDate',urldecode($eDate));
		$map1 = [];
		$map1['isnb']    = ['eq',0];
		$map1['proxy']    = ['eq',1];
		//$map1['proxy']    = ['eq',1];
		if($username){
			$map1['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		$_pagasize  = 10;
		$count      = M('member')->where($map1)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = M('member')->where($map1)->order('id desc')->field('id,username')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($list as $k=>$v){
			//获取所有下线用户
			$xusers = M('member')->where(['parentid'=>['eq',$v['id']],'isnb'=>['eq',0]])->field('id')->select();
			$XUIDS = [];
			foreach($xusers as $k0=>$v0){
				$XUIDS[] = $v0['id'];
			}
			//团队总数
			$map = [];
			$map['id'] = ['in',$XUIDS];
			$v['totalcount'] = 0;
			$v['totalcount'] = M('member')->where($map)->count();
			//团队代理数
			$map = [];
			$map['id'] = ['in',$XUIDS];
			$map['proxy'] = ['eq',1];
			$v['agentcount'] = 0;
			$v['agentcount'] = M('member')->where($map)->count();
			//普通用户数
			$v['usercount'] = $v['totalcount'] - $v['agentcount'];
			//在线数
			$tonline = 30;
			$map = [];
			$_t = time();
			$map['onlinetime']    = ['EGT',$_t-$tonline];
			$map['id'] = ['in',$XUIDS];
			$v['onlinecount'] = M('member')->where($map)->count();
			//团队自动充值
			$map = [];
			$map['uid'] = ['in',$XUIDS];
			$map['state'] = ['eq',1];
			$map['isauto'] = ['eq',1];
			if($sDate)$map['oddtime'][]    = ['gt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$v['zdrecharge'] = 0;
			$v['zdrecharge'] = M('recharge')->where($map)->sum('amount');
			//团队手动充值增加
			$map = [];
			$map['uid'] = ['in',$XUIDS];
			$map['state'] = ['eq',1];
			$map['isauto'] = ['eq',2];
			$map['sdtype'] = ['eq',1];
			if($sDate)$map['oddtime'][]    = ['gt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$v['sdjiarecharge'] = 0;
			$v['sdjiarecharge'] = M('recharge')->where($map)->sum('amount');
			//团队手动充值减
			$map = [];
			$map['uid'] = ['in',$XUIDS];
			$map['state'] = ['eq',1];
			$map['isauto'] = ['eq',2];
			$map['sdtype'] = ['eq',-1];
			if($sDate)$map['oddtime'][]    = ['gt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$v['sdjianrecharge'] = 0;
			$v['sdjianrecharge'] = M('recharge')->where($map)->sum('amount');
			//团队提款
			$map = [];
			$map['uid'] = ['in',$XUIDS];
			$map['state'] = ['eq',1];
			if($sDate)$map['oddtime'][]    = ['gt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$v['withdraw'] = 0;
			$v['withdraw'] = M('withdraw')->where($map)->sum('amount');
			//团队投注
			$map = [];
			$map['uid'] = ['in',$XUIDS];
			$map['isdraw'] = ['in',[1,-1]];
			if($sDate)$map['oddtime'][]    = ['gt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$v['touzhu'] = 0;
			$v['touzhu'] = M('touzhu')->where($map)->sum('amount');
			//团队中奖
			$map = [];
			$map['uid'] = ['in',$XUIDS];
			$map['isdraw'] = ['in',[1]];
			if($sDate)$map['oddtime'][]    = ['gt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$v['zhongjiang'] = 0;
			$v['zhongjiang'] = M('touzhu')->where($map)->sum('okamount');
			//团队活动
			$map = [];
			$map['uid'] = ['in',$XUIDS];
			$map['type'] = ['in',['pointexchange','fanshui','yongjinshenhe','jinjishenhe','activity_bindcard','activity_czzs','activity_rxf','activity_rks','activity_yxf','activity_yks']];
			if($sDate)$map['oddtime'][]    = ['gt',strtotime($sDate)];
			if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400-1];
			$v['huodong'] = 0;
			$v['huodong'] = M('fuddetail')->where($map)->sum('amount');

			//充提盈亏
			$v['ctyingkui'] = 0;
			$v['ctyingkui'] = $v['zdrecharge']+$v['sdjiarecharge']-$v['sdjianrecharge']-$v['withdraw'];
			//投注盈亏
			$v['tzyingkui'] = 0;
			$v['tzyingkui'] = $v['touzhu']-$v['zhongjiang'];
			$list[$k] = $v;
		}
		$this->assign('page',$show);
		$this->assign('zongji',$zongji);
		$this->assign('totalcount',$count);
		$this->assign('list',$list);

		$this->display();
	}

	function cptouzhu3d(){
		$username = I('username');
		$sDate    = I('sDate');
		$eDate    = I('eDate');
		$map = [];
		$map['isnb']    = ['eq',0];
		//$map1['proxy']    = ['eq',1];
		if($username){
			$map['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($sDate){
			$map['oddtime'][]    = ['gt',strtotime($sDate)];
			$this->assign('_sDate',urldecode($sDate));
		}
		if($eDate){
			$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
			$this->assign('_eDate',urldecode($eDate));
		}
		$touzhutotal = M('touzhu')->where($map)->sum('amount');
		//$cptypes = R('Caipiao/cpcategory');
		$cptypes = M('caipiao')->where(['isopen'=>1])->select();
		$typelist = [];
		foreach($cptypes as $k=>$v){
			$cpamount = 0;
			$cpamount = M('touzhu')->where(['isnb'=>['eq',0],'typeid'=>['eq','k3'],'cpname'=>['eq',$v['name']]])->sum('amount');
			$array = array();
			$array['amount'] = $cpamount?$cpamount:0;
			$array['bili'] = sprintf("%.2f", $array['amount']/$touzhutotal);
			$array['title'] = $v['title'];
			if(intval($array['amount'])>=1)$typelist[$k] = $array;
		}
		$title = "投注总金额:{$touzhutotal}";
		if($sDate){
			$title .= ",起始日期：{$sDate}";
		}
		if($eDate){
			$title .= "~{$eDate}";
		}
		//组合成图标数据
		$piedata = [];
		foreach($typelist as $k=>$v){
			$piedata[] = "['".$v['title'].'('.$v['amount'].'元)'."',".$v['bili']."]";
		}
		$this->assign('piedatastr',implode(',',$piedata));
		$this->assign('title',$title);
		$this->assign('typelist',$typelist);
		$this->display();
	}
	function chongti3d(){
		$username = I('username');
		$sDate    = I('sDate');
		$sDate    = $sDate?$sDate:date('Ymd',(strtotime(date('Y-m-d',time()))-86400*6));
		$eDate    = I('eDate');
		$eDate    = $eDate?$eDate:date('Ymd',time());
		$this->assign('_sDate',urldecode($sDate));
		$this->assign('_eDate',urldecode($eDate));
		$days     = ceil((strtotime($eDate)-strtotime($sDate))/86400);
		$_t = strtotime($eDate);
		$testusers = M('member')->where(['isnb'=>1])->field('id')->select();
		$testuids = [];
		$map1 = [];
		if($username){
			$map1['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		foreach($testusers as $k=>$v){
			$testuids[] = $v['id'];
		}
		if($testuids){
			$map1['uid'] = ['not in',$testuids];
		}
		$_t = strtotime($eDate);
		$chongzhis = [];$tikuans = [];$dates = [];
		for($i=0;$i<=$days;$i++){
			$datetime = date('Y-m-d',$_t-86400*$i);
			//自动充值
			$map = [];
			$map['oddtime'][]    = ['gt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$map['state'] = ['eq',1];
			$map['isauto'] = ['eq',1];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map1['username']    = ['eq',$username];
			$zdchongzhiall = 0;
			$zdchongzhiall = M('recharge')->where($map)->sum('amount');
			//手动加
			$map = [];
			$map['oddtime'][]    = ['gt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$map['state'] = ['eq',1];
			$map['isauto'] = ['eq',2];
			$map['sdtype'] = ['eq',1];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map1['username']    = ['eq',$username];
			$sdjiachongzhiall = 0;
			$sdjiachongzhiall = M('recharge')->where($map)->sum('amount');
			//手动减
			$map = [];
			$map['oddtime'][]    = ['gt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$map['state'] = ['eq',1];
			$map['isauto'] = ['eq',2];
			$map['sdtype'] = ['eq',-1];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map1['username']    = ['eq',$username];
			$sdjianchongzhiall = 0;
			$sdjianchongzhiall = M('recharge')->where($map)->sum('amount');
			//提款
			$map = [];
			$map['oddtime'][]    = ['gt',strtotime($datetime)];
			$map['oddtime'][]    = ['elt',strtotime($datetime)+86400-1];
			$map['state'] = ['eq',1];
			if($testuids)$map['uid'] = ['not in',$testuids];
			if($username)$map1['username']    = ['eq',$username];
			$tikuanall = 0;
			$tikuanall = M('withdraw')->where($map)->sum('amount');

			$dates[] = "'".date('m-d',strtotime($datetime))."'";
			$chongzhis[] = $zdchongzhiall+$sdjiachongzhiall-$sdjianchongzhiall;
			$tikuans[] = $tikuanall?$tikuanall:'0.00';

		}
		$title = "充提款统计,(充值=自动充值+手动加款-手动减款)";
		$subtitle='';
		if($sDate){
			$subtitle = "起始日期：{$sDate}";
		}
		if($eDate){
			$subtitle .= "~{$eDate}";
		}
		$this->assign('title',$title);
		$this->assign('subtitle',$subtitle);
		$this->assign('dates',implode(',',$dates));
		$this->assign('chongzhis',implode(',',$chongzhis));
		$this->assign('tikuans',implode(',',$tikuans));
		$this->display();
	}
}