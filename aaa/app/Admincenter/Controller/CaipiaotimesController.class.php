<?php
namespace Admincenter\Controller;
use Think\Controller;
class CaipiaotimesController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->_db = D('Caipiaotimes');
		$this->_pk = $this->_db->getPk();
	}
	function addtime(){
		$name = I('name');
		$this->_db->$name();
	}
	protected function cplist(){
		$cplist = M('Caipiao')->order('typeid asc')->getField('title');
		return $cplist;
	}
	function add(){
		$this->cplist = self::cplist();
		if(IS_POST){
			parent::_adddosimp();
		}
		$this->display();
	}
	function edit(){
		$this->cplist = self::cplist();
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
	
	function manage(){
		$name = I('name','cqssc');
		$map = [];
		$map['name'] = ['eq',$name];
		$this->name = $name;
		$this->cptitle = M('Caipiao')->where(['name'=>$name])->getField('title');
		$count      = $this->_db->where($map)->count();
		$Page       = new \Think\Page($count,20);
		$show       = $Page->show();
		$this->olist = $this->_db->where($map)->order('expect desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->total = $count;
		$this->pageshow = $show;
		$this->cplist = M('Caipiao')->order('typeid desc')->select();
		$this->display();
	}
	
	function baocun(){
		$id         = I('id');
		$expect     = I('expect');
		$starttime  = I('starttime');
		$stoptime   = I('stoptime');
		if(!$id || !$expect || !$starttime || !$stoptime){
			$this->error('参数错误');exit;
		}
		$int = $this->_db->where(['id'=>$id])->data([
			'expect'=>$expect,
			'starttime'=>date('H:i:s',strtotime($starttime)),
			'stoptime'=>date('H:i:s',strtotime($stoptime)),
		])->save();
		$int?$this->success('操作成功'):$this->error('操作失败');
	}
	
}