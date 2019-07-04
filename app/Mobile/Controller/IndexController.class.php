<?php
namespace Mobile\Controller;
use Think\Controller;
class IndexController extends CommonController {
	public function __construct(){
		parent::__construct();
	}
	function index(){
		$_t = time();
		$cplist = M('caipiao')->where(array('isopen'=>1))->cache(300)->order('allsort asc')->limit(11)->select();
		$gglist = M('Gonggao')->field('id,title,oddtime,content')->cache(300)->order("id DESC")->find();
		$this->assign('gglist',$gglist);
		$this->cplist  = $cplist;
		//公告
		$gonggao = M('gonggao')->field('id,title,content')->order('id desc')->find();
		$this->assign('gonggao',$gonggao);
		$this->display();
	}

	function lotteryHall()
	{
		$cplist = M('caipiao')->where(array('isopen'=>1))->order('allsort asc')->cache(300)->select();
		$cplist2 = M('caipiao')->where(array('isopen'=>1))->order('listorder asc')->cache(300)->select();
		$this->assign('cplist',$cplist);
		$this->assign('cplist2',$cplist2);
		$this->display();
	}
	public function slotgame(){
        $list =   C('game_list');
        $game_list = array();
        $egame = M('real_person')->where(['game_tye'=>['like','%egame%']])->order('id asc')->select();
        foreach ($egame as $value){
            $game_list[$value['name']] = $list[$value['name']];
        }
        $default_game =empty(I('game_tye'))?'AG':I('game_tye');
        $this->assign('egame',$egame);
        $this->assign('default_game',$default_game);
        $this->assign('list',$game_list[$default_game]);
        $this->display();
    }
    public function game_list(){
        $game_name =I('line');
        $list =   C('game_list');
        $this->ajaxReturn(['data'=>$list]);
    }

}