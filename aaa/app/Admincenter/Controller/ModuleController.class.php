<?php
namespace Admincenter\Controller;
use Think\Controller;
class ModuleController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->_db = D('Module');
		$this->_pk = $this->_db->getPk();
		$this->_pagasize = 20;
	}
	
	function manage(){
		parent::_manage();
		$this->display();
	}
	function add(){
		if(IS_POST){
			if(!IS_AJAX || !IS_POST)$this->error('非法操作！');
			$_POST['name'] = strtolower($_POST['name']);
			$db = $this->_db;
			if (!$db->create()){
				$this->error($db->getError());
			}else{
				//$int = $db->data($_POST)->add();
				$int = $db->Moduleadd($_POST);
			}
			$int?$this->success('操作成功'):$this->error('操作失败');
			exit;
		}
		$this->display();
	}
	function edit(){
		$id = I('id');
		$info = $this->_db->where([$this->_pk=>$id])->find();
		if(!$info){
			$this->error('您修改的数据不存在！');
		}else{
			$this->assign('info',$info);	
		}
		if(IS_POST){
			unset($_POST['name']);
			parent::_editdosimp();
		}
		$this->display('add');
	}
	
	function delete(){
		parent::_deleteone();
		/*$id     = I('id');
		if(!$id)$this->error('非法操作！');
		$info = $this->_db->find($id);
		if(!$info)$this->error('您操作的数据不存在或已删除！');
		$int = $this->_db->where([$this->_pk=>$id])->delete();
		$int?$this->success('操作成功！'):$this->error('操作失败！');*/
	}
	function listorder(){
		parent::_listorder();
	}
}