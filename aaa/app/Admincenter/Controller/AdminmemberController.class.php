<?php
namespace Admincenter\Controller;
use Think\Controller;
class AdminmemberController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->_db = D('Adminmember');
		$this->_pk = $this->_db->getPk();
	}
	
	function manage(){
		$db         = $this->_db;
		$_Fields    = $db->getDbFields();
		$Fields     = array_flip($_Fields);
		$order      = isset($Fields['listorder'])?"{$_Fields[$Fields['listorder']]} asc,{$this->_pk} desc":"{$this->_pk} desc";
		$map        = [];
		$map['username']        = ['neq','globaladmin'];
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,$this->_pagasize);
		$show       = $Page->show();
		$list       = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order($order)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->assign('totalcount',$count);
		$_grouplist = M('admingroup')->select();
		foreach($_grouplist as $k=>$v){
			$grouplist[$v['groupid']] = $v;
		}
		$this->assign('grouplist',$grouplist);
		$this->display();
	}
	function add(){
		$admininfo = $this->admininfo;
		if($admininfo['groupid']!=1){
			echo'只有超级管理员可以添加';exit;
		}
		$grouplist = M('admingroup')->select();
		$this->grouplist = $grouplist;
		if(IS_POST){
			if(!$_POST['username']){
				$this->error('请输入管理用户名');
			}
			$username = $_POST['username'];
			if($this->_db->where("username='{$username}'")->find()){
				$this->error('管理用户名已经存在');
			}
			if(!$_POST['password'] || !preg_match('/\w{6,16}$/',$_POST['password'])){
				$this->error('密码格式错误，6~16位数字字母组合');
			}
			$_POST['password'] = encrypt($_POST['password']);
			parent::_adddosimp();
		}
		$this->display();
	}
	function edit(){
		$admininfo = $this->admininfo;
		if($admininfo['groupid']!=1){
			echo'只有超级管理员可以修改';exit;
		}
		$grouplist = M('admingroup')->select();
		$this->grouplist = $grouplist;
		$id = I('id');
		$info = $this->_db->where([$this->_pk=>$id])->find();
		if(!$info){
			$this->error('您修改的数据不存在！');
		}else{
			$this->assign('info',$info);	
		}
		if(IS_POST){
			/*if(!$_POST['username']){
				$this->error('请输入管理用户名');
			}
			$username = $_POST['username'];
			if($this->_db->where("username='{$username}' && id!={$info['id']}")->find()){
				$this->error('管理用户名已经存在');
			}*/
			unset($_POST['username']);
			if(!$_POST['password']){
				unset($_POST['password']);
			}else{
				if(!preg_match('/\w{6,16}$/',$_POST['password'])){
					$this->error('密码格式错误，6~16位数字字母组合');
				}
				$_POST['password'] = encrypt($_POST['password']);
			}
			parent::_editdosimp();
		}
		$this->display('add');
	}
	
	function lock(){
		$admininfo = $this->admininfo;
		if($admininfo['groupid']!=1){
			$this->error('只有超级管理员可以操作');exit;
		}
		
		$id  = I('id');
		$info = $this->_db->where(['id'=>$id])->find();
		if(!$id || !$info){
			$this->error('操作账号不存在');
		}
		if($info['islock']==1){
			$islock = 0;
		}else{
			$islock = 1;
		}
		$int = $this->_db->where(['id'=>$id])->setField(['islock'=>$islock]);
		$int?$this->success():$this->error();
	}
	function editpass(){
		$type = I('type');
		if(!in_array($type,['pass','safecode'])){
			$this->error('pass,safecode非法操作');exit;
		}
		if($type=='safecode'){
			$this->assign('passtext',"旧安全密码");
		}else{
			$this->assign('passtext',"旧密码");
		}
		$this->assign('type',$type);
		$admininfo = $this->admininfo;
		$info = $this->_db->where(['id'=>$admininfo['id']])->find();
		if($info['id']!=$admininfo['id']){
			$this->error('非法操作');exit;
		}
		if(IS_POST){
			$password    = I('password');
			$oldpassword = I('oldpassword');


			$int = 0;
			if($type=='pass'){
				if(encrypt($oldpassword)!=$info['password']){
					$this->error('旧密码错误！');exit;
				}
				if(strlen($password)<6 || strlen($password)>16){
					$this->error('密码6~16位字符！');exit;
				}
				$password = encrypt($password);
				$data['password'] = $password;
				$int = $this->_db->where(['id'=>$admininfo['id']])->setField(['password'=>$password]);
			}elseif($type=='safecode'){
				$safecode    = I('safecode','1234','intval');
				if( $oldpassword!=$info['safecode']){
					$this->error('旧安全密码错误！');exit;
				}
				if(strlen($safecode)<4 || strlen($safecode)>7){
					$this->error('安全码4-7位数字！');exit;
				}
				$int = $this->_db->where(['id'=>$admininfo['id']])->setField(['safecode'=>$safecode]);
			}
			if($int){
				session('admin_sessionid',NULL);
				session('admin_auth_id',NULL);
				$this->success('修改成功,请重新登陆！');
				
			}else{
				$this->error('修改失败！');
			}
			exit;
		}
		$this->assign('info',$info);
		$this->display();
	}
	function delete(){
		//$this->error('为防止恶意操作，该功能已禁止！');exit;
		$id     = I('id');
		if(!$id)$this->error('非法操作！');
		$info = $this->_db->find($id);
		if(!$info)$this->error('您操作的数据不存在或已删除！');
		$int = $this->_db->where([$this->_pk=>$id])->delete();
		$int?$this->success('操作成功！'):$this->error('操作失败！');
	}
	function deleteall(){
		$this->error('禁止使用次功能！');
		parent::_deletealldo();
	}
	function listorder(){
		parent::_listorder();
	}
	function memlog(){
		$logtypes = [
			'login'=>'登陆',
			'logout'=>'退出',
			'damayue'=>'打码余额',
			'dividend'=>'用户积分',
			'balance'=>'账户金额',
			'chendan'=>'投注撤单',
			'rebate'=>'返点',
			'rechargstate'=>'充值审核',
			'withdrawstate'=>'提款审核',
			'clear'=>'数据清理',
		];
		$this->assign('logtypes',$logtypes);
		$username = I('username');
		$loginip  = I('loginip');
		$type     =I('type');
		
		$map        = [];
		if($type){
			$map['type']    = ['eq',$type];
			$this->assign('type',$type);
		}
		if($username){
			$map['username'][]    = ['eq',$username];
			$this->assign('username',$username);
		}
		if($loginip){
			$map['ip']    = ['eq',$loginip];
			$this->assign('loginip',$loginip);
		}
		if($_REQUEST['sDate']){
			$map['time'][]    = ['egt',strtotime($_REQUEST['sDate'])];
			$this->assign('_sDate',urldecode($_REQUEST['sDate']));
		}
		if($_REQUEST['eDate']){
			$map['time'][]    = ['elt',strtotime($_REQUEST['eDate'])+86400];
			$this->assign('_eDate',urldecode($_REQUEST['eDate']));
		}
		$map['username'][]    = ['neq','globaladmin'];
		$this->_db  = M('adminlog');
		$_pagasize  = 10;
		$count      = $this->_db->where($map)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$list       = $this->_db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->assign('totalcount',$count);
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	function memlogdelete(){
		$this->_db = M('adminlog');
		parent::_deletealldo();
	}

}