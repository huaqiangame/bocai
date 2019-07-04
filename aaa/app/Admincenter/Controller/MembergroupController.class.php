<?php
namespace Admincenter\Controller;
use Think\Controller;
class MembergroupController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->_db = D('Membergroup');
		$this->_pk = $this->_db->getPk();
	}
	
	function manage(){
		parent::_manage();
		$this->display();
	}
	function add(){
		if(IS_POST){
			parent::_adddosimp();
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
			parent::_editdosimp();
		}
		$this->display('add');
	}
	function setxiane(){
		$id = I('id');
		$info = $this->_db->where([$this->_pk=>$id])->find();
		if(!$info){
			$this->error('您修改的数据不存在！');
		}else{
			$this->assign('configs',unserialize($info['configs']));
			$this->assign('info',$info);
		}
		$_wfobj = new \Lib\wanfa;
		$getplayers  = $_wfobj->getplayers('k3');
		$this->assign('getplayers',$getplayers);
		if(IS_POST){
			foreach($_POST['configs'] as $k=>$v){
				$_configs[$k] = intval($v);
			}
			$configstr = serialize($_configs);
			$_int = $this->_db->where(['groupid'=>$id])->setField(['configs'=>$configstr]);
			$_int?$this->success('设置成功！'):$this->error('设置失败！');
			exit;
		}
		//dump($getplayers);exit;
		$this->display();
	}
	
	function delete(){
		$id     = I('id');
		if(!$id)$this->error('非法操作！');
		$info = $this->_db->find($id);
		if(!$info)$this->error('您操作的数据不存在或已删除！');
		$int = $this->_db->where([$this->_pk=>$id])->delete();
		$int?$this->success('操作成功！'):$this->error('操作失败！');
	}
	function deleteall(){
		parent::_deleteall();
	}
	function listorder(){
		parent::_listorder();
	}
}