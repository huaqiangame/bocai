<?php
namespace Admincenter\Controller;
use Think\Controller;
class GameController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->_db = D('touzhu');
		$this->_pk = $this->_db->getPk();
	}
	function manage(){
		$refert = I('refert',0,'intval');
		$this->assign('refert',$refert);
		$cpname = I('cpname');
		$username = I('username');
		$trano = I('trano');
		$qihao = I('qihao');
		$listorder = I('listorder');
		$status = I('status');
		$isnb   = I('isnb',999);
		$map        = [];
		$_t = time();  //当前时间
		if(in_array($isnb,[1,0,999])){ //判断是否全部
			if($isnb==1){
				$users = M('member')->where(['isnb'=>1])->field("id")->select();
				if($users){
					foreach($users as $k=>$v){
						$uids[] = $v['id'];
					}
					$map['uid']    = ['in',$uids];
				}
			}elseif($isnb==0){
				$users = M('member')->where(['isnb'=>0])->field("id")->select();
				if($users){
					foreach($users as $k=>$v){
						$uids[] = $v['id'];
					}
					$map['uid']    = ['in',$uids];
				}
			}
			
			$this->assign('isnb',$isnb);
		}
		if($status!=999 && $status!=''){
			$map['isdraw']    = ['eq',$status];
			$this->assign('status',$status);
		}
		if($cpname){
			$map['cpname']    = ['eq',$cpname];
			$this->assign('cpname',$cpname);
		}
		if($trano){
			$map['trano']    = ['eq',$trano];
			$this->assign('trano',$trano);
		}
		if($qihao){
			$map['expect']    = ['eq',$qihao];
			$this->assign('qihao',$qihao);
		}
		if($username){
			$map['username']    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($_REQUEST['sDate']){
			$map['oddtime'][]    = ['egt',strtotime($_REQUEST['sDate'])];
			$this->assign('_sDate',urldecode($_REQUEST['sDate']));
		}
		if($_REQUEST['eDate']){
			$map['oddtime'][]    = ['elt',strtotime($_REQUEST['eDate'])];
			$this->assign('_eDate',urldecode($_REQUEST['eDate']));
		}
		switch($listorder){
			case'1':
				$order = 'id desc';
				break;
			case'2':
				$order = 'id asc';
				break;
			case'3':
				$order = 'amount desc';
				break;
			case'4':
				$order = 'amount asc';
				break;
			default:
				$order = 'id desc';
		}
		$_pagasize  = 10;
		$count      = $this->_db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = $this->_db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order($order)->select();
		$this->assign('totalcount',$count);
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	function chedan(){
		$id = I('id',0,'intval');
		$info = $this->_db->where([$this->_pk=>$id])->find();
		if(!$info){
			$this->error('您修改的数据不存在！');
		}
		if($info['isdraw']!=0){
			$this->error('状态不允许操作！');
		}
		$_int1 = $this->_db->where(['id'=>$id])->setField(['isdraw'=>'-2']);
		$userinfo = M('member')->where(['id'=>$info['uid']])->find();
		if($_int1){
			$_t = time();
			$trano = $info['trano'];
			//撤单账变
			M('member')->where(['id'=>$info['uid']])->setInc('balance',$info['amount']);
			$fuddetail_data = array();
			$fuddetail_data['trano'] = $trano;
			$fuddetail_data['uid'] = $userinfo['id'];
			$fuddetail_data['username'] = $userinfo['username'];
			$fuddetail_data['amount'] = abs($info['amount']);
			$fuddetail_data['amountbefor'] = $userinfo['balance'];
			$fuddetail_data['amountafter'] = $userinfo['balance']+abs($info['amount']);
			$fuddetail_data['oddtime'] = $_t;
			$fuddetail_data['remark'] = "撤单退回";
			$fuddetail_data['type'] = 'cancel';
			$fuddetail_data['typename'] = C('fuddetailtypes.cancel');
			M('fuddetail')->data($fuddetail_data)->add();
 			//撤单洗码
			M('member')->where(['id'=>$info['uid']])->setInc('xima',$info['amount']);
			$fuddetail_data = array();
			$fuddetail_data['trano'] = $trano;
			$fuddetail_data['uid'] = $userinfo['id'];
			$fuddetail_data['username'] = $userinfo['username'];
			$fuddetail_data['amount'] = abs($info['amount']);
			$fuddetail_data['amountbefor'] = $userinfo['xima'];
			$fuddetail_data['amountafter'] = $userinfo['xima']+abs($info['amount']);
			$fuddetail_data['oddtime'] = $_t;
			$fuddetail_data['remark'] = "撤单退回洗码账户";
			$fuddetail_data['type'] = 'xima';
			$fuddetail_data['typename'] = C('fuddetailtypes.xima');
			M('fuddetail')->data($fuddetail_data)->add(); 
			//撤单积分
			$pointtouzhu    = abs(intval(GetVar('pointtouzhu')));
			$pointtouzhuadd = abs(intval(GetVar('pointtouzhuadd')));
			if($pointtouzhu && $pointtouzhuadd){
				$_addpoint = number_format(abs($info['amount'])*$pointtouzhuadd/$pointtouzhu,4,".","");
				if($_addpoint>0){
					M('member')->where(['id'=>$info['uid']])->setDec('point',$_addpoint);
					$fuddetail_data = array();
					$fuddetail_data['trano'] = $trano;
					$fuddetail_data['uid'] = $userinfo['id'];
					$fuddetail_data['username'] = $userinfo['username'];
					$fuddetail_data['amount'] = abs($_addpoint);
					$fuddetail_data['amountbefor'] = $userinfo['point'];
					$fuddetail_data['amountafter'] = $userinfo['point']-abs($_addpoint);
					$fuddetail_data['oddtime'] = $_t;
					$fuddetail_data['remark'] = "撤单扣回赠送积分";
					$fuddetail_data['type'] = 'point';
					$fuddetail_data['typename'] = C('fuddetailtypes.point');
					M('fuddetail')->data($fuddetail_data)->add();
				}
			}
			//撤单代理佣金
			$dlyj = M("dailifandian")->where("trano='{$trano}' AND uid <> '{$info['uid']}'")->select();
			foreach($dlyj as $k=>$v){
				$user  = M('member')->where("id='{$v['uid']}'")->find();
				if($user){
					M('member')->where("id='{$v['uid']}'")->setDec('balance',$v['amount']);
					$fuddetail_data = array();
					$fuddetail_data['trano'] = $trano;
					$fuddetail_data['uid'] = $user['id'];
					$fuddetail_data['username'] = $user['username'];
					$fuddetail_data['amount'] = abs($v['amount']);
					$fuddetail_data['amountbefor'] = $user['balance'];
					$fuddetail_data['amountafter'] = $user['balance']-abs($v['amount']);
					$fuddetail_data['oddtime'] = $_t;
					$fuddetail_data['remark'] = "撤单扣回代理佣金";
					$fuddetail_data['type'] = 'yongjinshenhe';
					$fuddetail_data['typename'] = C('fuddetailtypes.yongjinshenhe');
					M('fuddetail')->data($fuddetail_data)->add();
				}
			}			
			//增加管理日志
			$logdata = [];
			$logdata['userid']   = $this->admininfo['id'];
			$logdata['username'] = $this->admininfo['username'];
			$logdata['type']     = 'chendan';
			$logdata['info']     = "投注撤单，单号：".$trano;
			$logdata['time']     = NOW_TIME;
			$logdata['ip']       = get_client_ip();
			$iparea = IParea(get_client_ip());
			$logdata['iparea']   = $iparea;
			M('adminlog')->data($logdata)->add();
			$this->success('撤单成功');
		}else{
			$this->error('撤单失败');
		}
		exit;
		//账变记录
		
	}
	function touzhuedit(){
		$id = I('id');
		$info = $this->_db->where([$this->_pk=>$id])->find();
		if(!$info){
			$this->error('您修改的数据不存在！');
		}else{
			$this->assign('info',$info);	
		}
		if(IS_POST){
			parent::_editdosimp();
		}
		$this->display('bankadd');
	}
	
	function delete(){
		$this->error('删除功能已关闭');
		exit;
		parent::_deleteone();
		/*$id     = I('id');
		if(!$id)$this->error('非法操作！');
		$info = $this->_db->find($id);
		if(!$info)$this->error('您操作的数据不存在或已删除！');
		$int = $this->_db->where([$this->_pk=>$id])->delete();
		$int?$this->success('操作成功！'):$this->error('操作失败！');*/
	}
	function deleteall(){
		parent::_deletealldo();
	}
	//异常注单检测
	function checkerrorder(){
		$cpname = I('cpname');
		$username = I('username');
		$shijiancha = I('shijiancha',130,'intval');
		
		$where = '';
		$_t = time();
		if($cpname){
			$where .= " and a.cpname='{$cpname}' ";
			$this->assign('cpname',$cpname);
		}
		if($username){
			$where .= " and a.username='{$username}' ";
			$this->assign('username',$username);
		}
		if($shijiancha){
			$where .= " and b.opentime-a.oddtime<={$shijiancha} ";
			$this->assign('shijiancha',$shijiancha);
		}
		$_pagasize  = $shownum;
		$DB_PREFIX = C('DB_PREFIX');
		
		$sql = "select a.*,b.name as bname,b.opentime,b.expect as bexpect,c.ftime,c.issys,c.name as cname from {$DB_PREFIX}touzhu as a left join {$DB_PREFIX}kaijiang as b on a.cpname = b.name and a.expect = b.expect left join {$DB_PREFIX}caipiao as c on a.cpname = c.name where b.name!='' {$where} order by a.id desc";
		$list = M()->query($sql);
		$this->assign('list',$list);
		$this->display();
	}
}