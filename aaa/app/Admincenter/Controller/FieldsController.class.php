<?php
namespace Admincenter\Controller;
use Think\Controller;
class FieldsController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->_db = D('Fields');
		$this->_pk = $this->_db->getPk();
		$this->_pagasize = 20;
	}
	
	function manage(){
		$this->tblist = M('module')->select();
		$tbname = I('tbname');
		$map        = [];
		if($tbname){
			$this->tbname=$tbname;
			$map['tbname'] = ['eq',$tbname];
		}
		$count      = $this->_db->where($map)->count();
		$Page       = new \Think\Page($count,$this->_pagasize);
		$show       = $Page->show();
		$list       = $this->_db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('listorder asc')->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->assign('totalcount',$count);
		$this->display();
	}
	function add(){
		if(IS_POST){
			if(!IS_AJAX || !IS_POST)$this->error('非法操作！');
			$_POST['name'] = strtolower($_POST['name']);
			if($_POST['setting'] && is_array($_POST['setting'])){
				$_POST['setting'] = serialize($_POST['setting']);
			}
			$db = $this->_db;
			if (!$db->create()){
				$this->error($db->getError());
			}else{
				$int = $db->fieldsadd($_POST);
			}
			$int?$this->success('操作成功'):$this->error('操作失败');
			exit;
		}
		$this->tblist = M('module')->select();
		$this->fieldtypes = self::Get_filedtype();
		$this->display();
	}
	function edit(){
		$this->tblist = M('module')->select();
		$this->fieldtypes = self::Get_filedtype();
		$id = I('id');
		$info = $this->_db->where([$this->_pk=>$id])->find();
		if(!$info){
			$this->error('您修改的数据不存在！');
		}else{
			if($info[setting]){
				$info[setting] = unserialize($info[setting]);
				$this->assign('setting',$info[setting]);
			}
			$this->assign('info',$info);	
		}
		if(IS_POST){
			unset($_POST['name']);
			if($_POST['setting'] && is_array($_POST['setting'])){
				$_POST['setting'] = serialize($_POST['setting']);
			}
			parent::_editdosimp();
		}
		$this->display('add');
	}
	
	function setstatus(){
		$name   = I('name');
		if($name!='isopen')$this->error('非法操作！');
		parent::_setstatus();
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
	function deleteall(){
		parent::_deleteall();
	}
	function listorder(){
		parent::_listorder();
	}
	protected function Get_filedtype(){
		$filedtypes = array(
			'input'       => '单行文本',
			'password'    => '密码框文本',
			'textarea'    => '多行文本',
			'editor'      => '编辑器',
			'select'      => '下拉选项框',
			'checkbox'    => '复选选框',
			'radio'       => '单选框',
			//'downfile'    => '文件上传',
			'downfiles'   => '多文件上传',
			'number'      => '长数字',
			'datetime'    => '日期和时间',
			'color'       => '颜色选择器',
			'map'         => '地图字段',
		);
		return $filedtypes;
	}
	
}