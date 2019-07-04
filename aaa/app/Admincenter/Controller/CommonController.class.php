<?php
namespace Admincenter\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
		$this->admininfo = islogin();
		if(!is_array($this->admininfo)){
			switch($this->admininfo){
				case'0':
					redirect(url('Public/login'));
					break;
				case'-1':
					redirect(url('Public/login'),5,'您的账号在别的地方登录,如果不是您自己登录请修改密码');
					break;
				case'-2':
					redirect(url('Public/login'),2,'登录超时,请重新登录');
					break;
				default:
					redirect(url('Public/login'));
					break;
			}
			redirect(U('Public/login'));exit;
		}else{
           $real_person = S('real_person');
           if(empty($real_person)){
               $real_person =  M('real_person')->getField('id,name');
               S('real_person',$real_person);
           }
            $this->assign('real_person',$real_person);
        }
	}
	
	protected function _manage(){
		$db         = $this->_db;
		$_Fields    = $db->getDbFields();
		$Fields     = array_flip($_Fields);
		$order      = isset($Fields['listorder'])?"{$_Fields[$Fields['listorder']]} asc,{$this->_pk} desc":"{$this->_pk} desc";
		$map        = [];
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,$this->_pagasize);
		$show       = $Page->show();
		$list       = $db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order($order)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->assign('totalcount',$count);
	}
	protected function _adddosimp(){
		if(!IS_AJAX || !IS_POST)$this->error('非法操作！');
		$db = $this->_db;
		if (!$db->create()){
			$this->error($db->getError());
		}else{
			$_Fields    = $db->getDbFields();
			$Fields     = array_flip($_Fields);
			if($Fields['listorder'])$_POST['listorder'] = $db->max($this->_pk) + 1;
			$int = $db->data($_POST)->add();
		}
		$int?$this->success('操作成功'):$this->error('操作失败');
		exit;
	}
	protected function _editdosimp(){
		if(!IS_AJAX || !IS_POST || !$_POST['id'])$this->error('非法操作！');
		$db = $this->_db;
		if (!$db->create()){
			$this->error($db->getError());
		}else{
			$id = $_POST['id'];
			unset($_POST[$this->_pk]);
			$int = $db->where([$this->_pk=>$id])->data($_POST)->save();
		}
		$int?$this->success('操作成功'):$this->error('操作失败');
		exit;
	}
	protected function _setstatus(){
		$id     = I('id');
		$name   = I('name');
		if(!$_REQUEST['value']){
			$_val = $this->_db->where([$this->_pk=>$id])->getField($name);
			$value  = $_val==1?0:1;
		}else{
			$value  = I('value');
		}
		$int = $this->_db->where([$this->_pk=>$id])->setField([$name=>$value]);
		$int?$this->success('操作成功！'):$this->error('操作失败！');
	}
	 function _rechargedelall(){
		if(!IS_AJAX || !IS_POST)$this->error('非法操作！');
		 $ids = implode(',',$_POST['ids']);
		$int = M('recharge')->where(array('id'=>array('in',$ids)))->delete();
		$int?$this->success('操作成功！'):$this->error('操作失败！');
	}
	function _withdrawdelall(){
		if(!IS_AJAX || !IS_POST)$this->error('非法操作！');
		$ids = implode(',',$_POST['ids']);
		$int = M('withdraw')->where(array('id'=>array('in',$ids)))->delete();
		$int?$this->success('操作成功！'):$this->error('操作失败！');
	}
	protected function _deleteall(){
		if(!IS_AJAX || !IS_POST)$this->error('非法操作！');
		$int = $this->_db->deleteall($_POST['ids']);
		$int?$this->success('操作成功！'):$this->error('操作失败！');
	}
	protected function _deletealldo(){
		if(!IS_AJAX || !IS_POST)$this->error('非法操作！');
		$_pk = $this->_db->getPk();
		$map = [];
		$map[$_pk] = array('in',$_POST['ids']);
		$int = $this->_db->where($map)->delete();
		$int?$this->success('操作成功！'):$this->error('操作失败！');
	}
	protected function _deleteone(){
		$id     = I('id');
		if(!$id)$this->error('非法操作！');
		$info = $this->_db->find($id);
		if(!$info)$this->error('您操作的数据不存在或已删除！');
		$int = $this->_db->deleteone($id);
		$int?$this->success('操作成功！'):$this->error('操作失败！');
	}
	protected function _deletedosimp(){
		$id     = I('id');
		if(!$id)$this->error('非法操作！');
		$info = $this->_db->find($id);
		$_pk = $this->_db->getPk();
		if(!$info)$this->error('您操作的数据不存在或已删除！');
		$int = $this->_db->where([$_pk=>$id])->delete();
		$int?$this->success('操作成功！'):$this->error('操作失败！');
	}
	protected function _listorder(){
		if(!IS_AJAX || !IS_POST)$this->error('非法操作！');
		if(isset($_POST['allsort'])){
			foreach($_POST['ids'] as $k=>$v){
 				$ints[] = $this->_db->where([$this->_pk=>$v])->setField(['allsort'=>intval($_POST['allsort'][$v])]);
			}
		}
		if(isset($_POST['listorder'])){
			foreach($_POST['ids'] as $k=>$v){
				$ints[] = $this->_db->where([$this->_pk=>$v])->setField(['listorder'=>intval($_POST['listorder'][$v])]);
 			}
		}
		count(array_filter($ints))>0?$this->success('操作成功！'):$this->error('操作失败！');
	}
}