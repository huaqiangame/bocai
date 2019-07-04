<?php
namespace Admincenter\Controller;
use Think\Controller;
class IndexController extends CommonController {
	public function __construct(){
		parent::__construct();
	} 
	function welcome(){
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
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$sdjianchongzhiall = M('recharge')->where($map)->sum('amount');

		//提款
		$map = [];
		$map['state'] = ['eq',1];
		if($testuids)$map['uid'] = ['not in',$testuids];
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$tikuanall = M('withdraw')->where($map)->sum('amount');
		//消费
		$map = [];
		$map['isdraw'] = ['in',[1,-1]];
		if($testuids)$map['uid'] = ['not in',$testuids];
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
		if($username)$map['username']    = ['eq',$username];
		if($sDate)$map['oddtime'][]    = ['egt',strtotime($sDate)];
		if($eDate)$map['oddtime'][]    = ['elt',strtotime($eDate)+86400];
		$zhongjiangall = 0;
		$zhongjiangall = M('touzhu')->where($map)->sum('okamount');
		//活动
		$map = [];
		$map['type'] = ['in',['pointexchange','activity_bindcard','activity_czzs','activity_rxf','activity_rks','activity_yxf','activity_yks']];
		if($testuids)$map['uid'] = ['not in',$testuids];
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
		$usercountall = 0;
		$usercountall = M('member')->where($map)->count();
		//代理数
		$map = [];
		if($testuids)$map['id'] = ['not in',$testuids];
		$map['proxy'] = ['eq',1];
		$userdailiall = 0;
		$userdailiall = M('member')->where($map)->count();
		//普通用户
		$userputongall = $usercountall-$userdailiall;
		//在线数
		$tonline = 30;
		$map = [];
		if($testuids)$map['id'] = ['not in',$testuids];
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
	function checkspeck(){
		$t = time();
		if(GetVar('czaudioplay')==1){
			$czcount = M('recharge')->where(['state'=>['eq',0],'oddtime'=>['egt',$t-(GetVar('czaudioplaytime')*60)]])->count();
		}else{
			$czcount = 0;
		}
		if(GetVar('tkaudioplay')==1){
			$tkcount = M('withdraw')->where(['state'=>['eq',0],'oddtime'=>['egt',$t-(GetVar('tkaudioplaytime')*60)]])->count();
		}else{
			$tkcount = 0;
		}
		if(GetVar('cardaudioplay')==1){
			$bankbindcount = M('banklist')->where(['state'=>['eq',0]])->count();
		}else{
			$bankbindcount = 0;
		}
		if(GetVar('czaudioqxtime')>0)M('recharge')->where(['state'=>['eq',0],'oddtime'=>['elt',$t-(GetVar('czaudioqxtime')*60)]])->setField(['state'=>'-1']);
		echo json_encode(['sign'=>true,'message'=>'获取成功','czcount'=>$czcount?$czcount:0,'tkcount'=>$tkcount?$tkcount:0,'bankbindcount'=>$bankbindcount?$bankbindcount:0]);
	}

}