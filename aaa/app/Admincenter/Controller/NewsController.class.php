<?php
namespace Admincenter\Controller;
use Think\Controller;
class NewsController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->_db = D('news');
		$this->_pk = $this->_db->getPk();
	}
	function category(){
		$this->_db = D('category');
		$this->_pk = $this->_db->getPk();
		$count      = $this->_db->where($map)->count();
		$Page       = new \Think\Page($count,60);
		$show       = $Page->show();
		$list       = $this->_db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('listorder asc')->select();
		$_Tree      = new \Lib\Tree($list,['id'=>'id','parentid'=>'parentid']);
		$list   = $_Tree->get_tree($list);
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->assign('totalcount',$count);
		$this->display();
	}
	function categoryadd(){
		$catelist = M('category')->order('listorder asc')->select();
		$_Tree      = new \Lib\Tree($catelist,['id'=>'id','parentid'=>'parentid']);
		$catelist   = $_Tree->get_tree($catelist);
		$this->assign('catelist',$catelist);
		$this->_db = D('category');
		$this->_pk = $this->_db->getPk();
		if(IS_POST){
			parent::_adddosimp();
		}
		$this->display();
	}
	function categoryedit(){
		$catelist = M('category')->order('listorder asc')->select();
		$_Tree      = new \Lib\Tree($catelist,['id'=>'id','parentid'=>'parentid']);
		$catelist   = $_Tree->get_tree($catelist);
		$this->assign('catelist',$catelist);
		$this->_db = D('category');
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
		$this->display('categoryadd');
	}
	function categorylistorder(){
		$this->_db = D('category');
		$this->_pk = $this->_db->getPk();
		parent::_listorder();
	}
	function categorydelete(){
		$this->_db = D('category');
		$this->_pk = $this->_db->getPk();
		parent::_deletedosimp();
	}
	function manage(){
		$catelist = M('category')->order('listorder asc')->select();
		$_Tree      = new \Lib\Tree($catelist,['id'=>'id','parentid'=>'parentid']);
		$catelist   = $_Tree->get_tree($catelist);
		$this->assign('catelist',$catelist);
		$catid = I('catid');
		$map        = [];
		if($catid){
			$map['catid'] = ['eq',$catid];
			$this->assign('catid',$catid);
		}
		$count      = $this->_db->where($map)->count();
		$Page       = new \Think\Page($count,20);
		$show       = $Page->show();
		$list       = $this->_db->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->assign('totalcount',$count);
		$this->display();
	}
	function add(){
		$catelist = M('category')->order('listorder asc')->select();
		$_Tree      = new \Lib\Tree($catelist,['id'=>'id','parentid'=>'parentid']);
		$catelist   = $_Tree->get_tree($catelist);
		$this->assign('catelist',$catelist);
		if(IS_POST){
		   $up =   new UploadsController();
            $up->upload();
			foreach($catelist as $_k=>$_v){
				$_catelist[$_v['id']] = $_v;
			}
			if(!$_POST['catid'] || !$_catelist[$_POST['catid']]){
				$this->error('请选择栏目');
			}
			$_POST['catname'] = $_catelist[$_POST['catid']]['catname'];
			$_POST['oddtime'] = time();
			parent::_adddosimp();
		}
		$this->display();
	}
	function edit(){
		$catelist = M('category')->order('listorder asc')->select();
		$_Tree      = new \Lib\Tree($catelist,['id'=>'id','parentid'=>'parentid']);
		$catelist   = $_Tree->get_tree($catelist);
		$this->assign('catelist',$catelist);
		$id = I('id');
		$info = $this->_db->where([$this->_pk=>$id])->find();
		if(!$info){
			$this->error('您修改的数据不存在！');
		}else{
			$this->assign('info',$info);	
		}
		if(IS_POST){
			foreach($catelist as $_k=>$_v){
				$_catelist[$_v['id']] = $_v;
			}
			if(!$_POST['catid'] || !$_catelist[$_POST['catid']]){
				$this->error('请选择栏目');
			}
			$_POST['catname'] = $_catelist[$_POST['catid']]['catname'];
			parent::_editdosimp();
		}
		$this->display('add');
	}
	
	function delete(){
		parent::_deletedosimp();
	}
	
	function gonggao(){
		$this->_db = D('gonggao');
		$this->_pk = $this->_db->getPk();
		parent::_manage();
		$this->display();
	}
	function gonggaoadd(){
		$this->_db = D('gonggao');
		$this->_pk = $this->_db->getPk();
		if(IS_POST){
			$_POST['oddtime'] = time();
			parent::_adddosimp();
		}
		$this->display();
	}
	function gonggaoedit(){
		$this->_db = D('gonggao');
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
		$this->display('gonggaoadd');
	}
	function gonggaodelete(){
		$this->_db = D('gonggao');
		$this->_pk = $this->_db->getPk();
		parent::_deletedosimp();
	}

}