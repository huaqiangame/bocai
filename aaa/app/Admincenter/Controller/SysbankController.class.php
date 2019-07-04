<?php
namespace Admincenter\Controller;
use Think\Controller;
class SysbankController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->_db = D('Sysbank');
		$this->_pk = $this->_db->getPk();
	}
	function manage(){
		parent::_manage();
		$this->display();
	}
	function bankadd(){
		if(IS_POST){
			parent::_adddosimp();
		}
		$this->display();
	}
	function bankedit(){
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
	
	function setstatus(){
		$name   = I('name');
		if($name!='state')$this->error('非法操作！');
		parent::_setstatus();
	}
	function delete(){
		parent::_deletedosimp();
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
	function listorder(){
		parent::_listorder();
	}


	function linebank(){
		$this->_db = D('linebanklist');
		$this->_pk = $this->_db->getPk();
		parent::_manage();
		$this->display();
	}
	function linebankadd(){
		$this->_db = D('linebanklist');
		$this->_pk = $this->_db->getPk();
		if(IS_POST){
			parent::_adddosimp();
		}
		$this->display();
	}
	function linebankedit(){
		$this->_db = D('linebanklist');
		$this->_pk = $this->_db->getPk();
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
		$this->display('linebankadd');
	}
	
	function linesetstatus(){
		$this->_db = D('linebanklist');
		$this->_pk = $this->_db->getPk();
		$name   = I('name');
		if($name!='state')$this->error('非法操作！');
		parent::_setstatus();
	}
	function linebankdelete(){
		$this->_db = D('linebanklist');
		$this->_pk = $this->_db->getPk();
		parent::_deletedosimp();
		/*$id     = I('id');
		if(!$id)$this->error('非法操作！');
		$info = $this->_db->find($id);
		if(!$info)$this->error('您操作的数据不存在或已删除！');
		$int = $this->_db->where([$this->_pk=>$id])->delete();
		$int?$this->success('操作成功！'):$this->error('操作失败！');*/
	}
	function linebankdeleteall(){
		$this->_db = D('linebanklist');
		$this->_pk = $this->_db->getPk();
		parent::_deletealldo();
	}
	function linebanklistorder(){
		$this->_db = D('linebanklist');
		$this->_pk = $this->_db->getPk();
		parent::_listorder();
	}

}