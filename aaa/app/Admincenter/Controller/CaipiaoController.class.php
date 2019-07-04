<?php
namespace Admincenter\Controller;
use Think\Controller;
class CaipiaoController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->_db = D('caipiao');
		$this->_pk = $this->_db->getPk();
	}

	function cpadd(){
		if(IS_POST){
			if($_POST['issys']==1){
				if(!in_array($_POST['expecttime'],['1','1.5','2','2.5','3','5','10'])){
					$this->error('请设置开奖时间');
				}
			}
			parent::_adddosimp();
		}
		$this->cpcategory = self::cpcategory();
		$this->display();
	}
	function cpedit(){
		$this->cpcategory = self::cpcategory();
		$id = I('id');
		$info = $this->_db->where([$this->_pk=>$id])->find();
		if(!$info){
			$this->error('您修改的数据不存在！');
		}else{
			$this->assign('info',$info);
		}
		if(IS_POST){
			if($_POST['issys']==1){
				if(!in_array($_POST['expecttime'],['1','1.5','2','2.5','3','5','10'])){
					$this->error('请设置开奖时间');
				}
			}
			parent::_editdosimp();
		}
		$this->display('cpadd');
	}
	static function cpcategory(){
		$cpcategory = [];
		$cpcategory = [
			'ssc'=>'时时彩',
			'k3'=>'快三',
			'x5'=>'11选5',
			'keno'=>'快乐彩',
			//'xy28'=>'辛运28',
			//'kl10f'=>'快乐10分',
			'pk10'=>'PK10',
			'dpc'=>'低频彩',
			'lhc'=>'六合彩',
			//'other'=>'其他彩',
		];
		return $cpcategory;
	}

	function cptype(){
		$typeid = I('typeid');
		$this->cpcategory = self::cpcategory();
		$map = [];
		if($typeid && $this->cpcategory[$typeid]){
			$map['typeid'] = ['eq',$typeid];
			$this->typeid = $typeid;
		}
		if($typeid){
			$this->olist = $this->_db->where($map)->order('listorder asc,id desc')->select();
		}else{
			$this->olist = $this->_db->where($map)->order('allsort asc,id desc')->select();
		}
		$this->display();
	}
	function setstatus(){
		$name   = I('name');
		if( !in_array($name,['isopen','iswh']) )$this->error('非法操作！');
		parent::_setstatus();
	}
	function delete(){
		//$this->error('为防止误操作，该功能已禁止！');exit;
		parent::_deleteone();
		/*$id     = I('id');
		if(!$id)$this->error('非法操作！');
		$info = $this->_db->find($id);
		if(!$info)$this->error('您操作的数据不存在或已删除！');
		$int = $this->_db->where([$this->_pk=>$id])->delete();
		$int?$this->success('操作成功！'):$this->error('操作失败！');*/
	}
	function deleteall(){
		$this->error('为防止误操作，该功能已禁止！');exit;
		parent::_deleteall();
	}
	function listorder(){
		parent::_listorder();
	}
	function kaijiang(){
		$this->cpcategory = self::cpcategory();
		$name = I('name','jsk3');
		$map = [];
		$map['name'] = ['eq',$name];
		$this->name = $name;
		$expect = I('expect');
		if($expect!='' || $expect!=0 && is_numeric($expect)){
			$map['expect'] = ['eq',$expect];
			$this->expect = $expect;
		}
		$this->cptitle = M('Caipiao')->where(['name'=>$name])->getField('title');
		$db = M('kaijiang');
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,20);
		$show       = $Page->show();
		$this->olist = $db->where($map)->order('opentime desc,expect desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->total = $count;
		$this->pageshow = $show;
		$this->cplist = M('Caipiao')->order('typeid desc')->select();
		$this->display();
	}
	function yukaijiang(){
		$this->cpcategory = self::cpcategory();
		$this->cplist = M('Caipiao')->where(['issys'=>1])->order('typeid desc')->select();
		foreach($this->cplist as $k=>$v){
			$_cplist[$v['name']] = $v;
		}
		$name = I('name');
		if(!$name){
			$cpinfo = current($_cplist);
			$name = $cpinfo['name'];
		}
		if(!$_cplist[$name]){
			echo'彩种不存在';exit;
		}
		$cpinfo = $_cplist[$name];
		$this->name = $cpinfo['name'];
		$typeid = $cpinfo['typeid'] ;
		$expecttime = $cpinfo['expecttime'];
		$_expecttime = $expecttime*60;
		$totalopentimes = 86400-0;
		//$totalcount     = floor($totalopentimes/$_expecttime);
		$totalcount     = floor(abs(strtotime($cpinfo['closetime2'])-strtotime($cpinfo['closetime1']))/$_expecttime);
		$_length        = $totalcount>=1000?4:3;
		$jgtime = $expecttime*60;
		$_t = time();
		$_t1 = strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t));
		if($_t<$_t1){
			$actNo_t = $totalcount;
		}else{
			$actNo_t = ($_t-strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t))+$cjnowtime)/$_expecttime;
		}
		$actNo_t = floor($actNo_t);

		$actNo =  is_numeric($actNo_t)?($actNo_t==$totalcount?1:$actNo_t+1):ceil( $actNo_t );
		$openlist = [];
		if($actNo>$totalcount){
			if($_t>strtotime($cpinfo['closetime2'])){
				$_datetime = strtotime(date("Y-m-d",strtotime("+1 day")));
				for($j=10,$jj=0;$j>=1;$j--,$jj++){
					$rand_keys = $this->returnrankey($cpinfo['typeid']);
					if($cpinfo['typeid']=='k3' or $cpinfo['typeid']=='keno')sort($rand_keys);
					$opentime  = date('Y-m-d H:i:s', strtotime($cpinfo['closetime1']) + $j*$jgtime+86400 );
					$expect    = str_pad($j,$_length,0,STR_PAD_LEFT);
					$openlist[$expect]['expect'] = date('Ymd',$_datetime).$expect;
					$openlist[$expect]['opencode'] = implode(',',$rand_keys);
					$openlist[$expect]['opentime'] = $opentime;
					$openlist[$expect]['cptitle'] = $cpinfo['title'];
					$openlist[$expect]['name'] = $cpinfo['name'];
				}
			}else{
				for($j=10,$jj=0;$j>=1;$j--,$jj++){
					$rand_keys = $this->returnrankey($cpinfo['typeid']);
					if($cpinfo['typeid']=='k3' or $cpinfo['typeid']=='keno')sort($rand_keys);
					$opentime  = date('Y-m-d H:i:s', strtotime($cpinfo['closetime1']) + $j*$jgtime );
					$expect    = str_pad($j,$_length,0,STR_PAD_LEFT);
					$openlist[$expect]['expect'] = date('Ymd').$expect;
					$openlist[$expect]['opencode'] = implode(',',$rand_keys);
					$openlist[$expect]['opentime'] = $opentime;
					$openlist[$expect]['cptitle'] = $cpinfo['title'];
					$openlist[$expect]['name'] = $cpinfo['name'];
				}
			}
		}else{
			if($actNo+9<=$totalcount){
				for($j=$actNo+9,$jj=0;$j>=$actNo;$j--,$jj++){
					$rand_keys = $this->returnrankey($cpinfo['typeid']);
					if($cpinfo['typeid']=='k3' or $cpinfo['typeid']=='keno')sort($rand_keys);
					$opentime  = date('Y-m-d H:i:s', strtotime($cpinfo['closetime2']) - ($totalcount-$j)*$jgtime );
					$expect    = str_pad($j,$_length,0,STR_PAD_LEFT);
					$openlist[$expect]['expect'] = date('Ymd').$expect;
					$openlist[$expect]['opencode'] = implode(',',$rand_keys);
					$openlist[$expect]['opentime'] = $opentime;
					$openlist[$expect]['cptitle'] = $cpinfo['title'];
					$openlist[$expect]['name'] = $cpinfo['name'];
				}
			}else{
				for($j=$totalcount,$jj=0;$j>=$actNo;$j--,$jj++){
					$rand_keys = $this->returnrankey($cpinfo['typeid']);
					if($cpinfo['typeid']=='k3' or $cpinfo['typeid']=='keno')sort($rand_keys);
					$opentime  = date('Y-m-d H:i:s', strtotime($cpinfo['closetime2']) - $jj*$jgtime );
					$expect    = str_pad($j,$_length,0,STR_PAD_LEFT);
					$openlist[$expect]['expect'] = date('Ymd').$expect;
					$openlist[$expect]['opencode'] = implode(',',$rand_keys);
					$openlist[$expect]['opentime'] = $opentime;
					$openlist[$expect]['cptitle'] = $cpinfo['title'];
					$openlist[$expect]['name'] = $cpinfo['name'];
				}
			}
		}
		$db = M('yukaijiang');
		foreach($openlist as $k=>$v){
			$bcinfo = $db->where(['name'=>$v['name'],'expect'=>$v['expect'],'hid'=>0])->find();
			$v['isbc'] = 0;
			$v['stateadmin'] = $bcinfo['stateadmin'];
			if($bcinfo){
				$v['opencode'] = $bcinfo['opencode'];
				$v['isbc'] = 1;
			}
			$openlist[$k] = $v;
		}
		sort($openlist);
		$this->assign('typeid',$typeid);
		$this->assign('cpname',$name);
		$this->assign('openlist',$openlist);
		$this->display();
	}
	function returnrankey($typeid){
		$rand_keys = [];
		switch($typeid){
			case 'k3':
				$rand_keys  = explode(',',self::rand_keys('3','123456'));
				break;
			case 'ssc':
				$rand_keys  = explode(',',self::rand_keys('5','0123456789'));
				break;
			case 'x5':
				$rand_keys  = explode(',',self::rand_keys_x('5','01,02,03,04,05,06,07,08,09,10,11'));
				break;
			case 'pk10':
				$rand_keys  = explode(',',self::rand_keys_x('10','01,02,03,04,05,06,07,08,09,10'));
				break;
			case 'keno':
				$num = '';
				for($i=1;$i<=80;$i++){
					if($i<10)$i='0'.$i;
					$num .= $i.',';
				}
				$num=substr($num,0,-1);
				$rand_keys  = explode(',',self::rand_keys_x('20',$num));
				break;
			case 'dpc':
				$rand_keys  = explode(',',self::rand_keys('3','0123456789'));
				break;
			case 'lhc':
				$rand_keys  = explode(',',self::rand_keys_x('7','01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49'));
				break;
		}
		return $rand_keys;
	}
	function yukaijianghistory(){
		$_lotterylist = M('caipiao')->where(['issys'=>1])->select();
		$lotterylist = [];
		foreach($_lotterylist as $k=>$v){
			$lotterylist[$v['name']] = $v;
		}
		$name = I('name');
		$expect = I('expect');
		if(!$name){
			$curlottery = current($lotterylist);
			$name = $curlottery['name'];
		}
		$this->assign('lotterylist',$lotterylist);

		$map = [];
		$map['name'] = ['eq',$name];
		$this->name = $name;
		if($expect!='' || $expect!=0 && is_numeric($expect)){
			$map['expect'] = ['eq',$expect];
			$this->expect = $expect;
		}
		$db = M('yukaijiang');
		$count      = $db->where($map)->count();
		$Page       = new \Think\Page($count,20);
		$show       = $Page->show();
		$this->olist = $db->where($map)->order('opentime desc,expect desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->total = $count;
		$this->pageshow = $show;
		$this->display();
	}
	function ykjbaocun(){
		$expect     = I('expect');
		$name       = I('name');
		$opentime   = I('opentime');
		$opentime = str_replace('：',':',$opentime);
		$opencode = '';
		for($i=1;$i<=20;$i++){
			if(I('opencode'.$i)=='0'){
				$opencode .= I('opencode'.$i).',';
			}elseif(I('opencode'.$i)!=''){
				$opencode .= I('opencode'.$i).',';
			}else{
				break;
			}
		}
		$opencode = substr($opencode,0,-1);
		/*		if(!isset($opencode1) || !isset($opencode2) || !isset($opencode3)){
                    $this->error('开奖号码不完整');exit;
                }*/
		if(!strstr($opencode,',')){
			$this->error('开奖号码必须以","隔开');exit;
		}
		if(!strstr($opentime,':')){
			$this->error('开奖时间格式错误');exit;
		}
		if(!$expect || !$opencode || !$name || !$opentime){
			$this->error('参数错误');exit;
		}
		$db = M('yukaijiang');
		$info = $db->where(['name'=>$name,'expect'=>$expect])->find();
		if($info){
			$int = $db->where(['name'=>$name,'expect'=>$expect])->setField(['opencode'=>$opencode]);
		}else{
			$data = [];
			$data['expect'] = $expect;
			$data['opencode'] = $opencode;
			$data['name'] = $name;
			$data['opentime'] = strtotime($opentime);
			$data['isdraw'] = 0;
			$data['stateadmin'] = $this->admininfo['username'];
			$int = $db->data($data)->add();
		}

		$int?$this->success('保存成功'):$this->error('保存失败');
	}
	function kaijiangadd(){
		$this->cpcategory = self::cpcategory();
		$this->cplist = M('Caipiao')->order('typeid desc')->select();
		if(IS_POST){
			$admininfo = $this->admininfo;
			if($admininfo['groupid']!=1){
				$this->error('只有超级管理员可以操作！');exit;
			}
			$post = I('post.');
			if(!$post['expect']){
				$this->error('期号必须！');exit;
			}
			if(!$post['opencode']){
				$this->error('开奖号码必须！');exit;
			}
			if(strpos($post['opencode'],',')===false){
				$this->error('开奖号码以英文逗号隔开！');exit;
			}
			foreach($this->cplist as $k=>$v){
				$_cplist[$v['name']] = $v;
			}
			if(!$_cplist[$post['name']]){
				$this->error('请选择彩种！');exit;
			}
			$data = [];
			if($post['opentime'] && preg_match('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}/',$post['opentime'])){
				$data['opentime'] = strtotime($post['opentime']);
			}else{
				$data['opentime'] = time();
			}
			$data['expect'] = $post['expect'];
			$data['opencode'] = $post['opencode'];
			$data['name'] = $post['name'];
			$data['isdraw'] = 0;
			$data['source'] = $admininfo['username'].'添加';
			$data['title'] = $_cplist[$post['name']]['title'];
			$data['addtime'] = time();
			$haskaijiang = M('kaijiang')->where(['name'=>$post['name'],'expect'=>$post['expect']])->find();
			if($haskaijiang){
				$this->error('开奖号码已经存在！');exit;
			}
			$int = M('kaijiang')->data($data)->add();
			$int?$this->success('添加成功！'):$this->error('添加失败！');;
			exit;
		}
		$this->display();
	}
	function kjdeleteall(){
		$admininfo = $this->admininfo;
		if($admininfo['groupid']!=1){
			$this->error('只有超级管理员可以操作！');exit;
		}
		$this->_db = D('kaijiang');
		$this->_pk = $this->_db->getPk();
		parent::_deletealldo();
	}
	function kjbaocun(){
		if(!IS_POST){
			$this->error('非法操作');exit;
		}
		$id         = I('id');
		$opencode   = I('opencode');
		$opentime   = I('opentime');
		if(!$id || !$opencode || !$opentime){
			$this->error('参数错误');exit;
		}
		$opencode = str_replace('，',',',$opencode);
		$opentime = str_replace('：',':',$opentime);
		if(!strstr($opencode,',')){
			$this->error('开奖号码必须以","隔开');exit;
		}
		if(!strstr($opentime,':')){
			$this->error('开奖时间格式错误');exit;
		}
		$int = M('kaijiang')->where(['id'=>$id])->data([
			'opencode' => $opencode,
			'opentime' => strtotime($opentime),
		])->save();
		$int?$this->success('操作成功'):$this->error('操作失败');
	}
	function kjchongzhi(){
		if(!IS_POST){
			$this->error('非法操作');exit;
		}
		$id         = I('id');
		$int = M('kaijiang')->where(['id'=>$id])->setField(['isdraw' => 0]);
		$int?$this->success('重置开奖操作成功'):$this->error('重置开奖操作失败');
	}
    function wanfa(){
        $_olist = M('wanfa')->select();
        foreach($_olist as $k=>$v){
            $key = $v['playid'];
            $olist[$key] = $v;
            $this->$key = $v;
        }
        $this->assign('olist',$olist);
        $_wfobj = new \Lib\wanfa;
        $this->ssc = $_wfobj->ssc();
        $this->x5  = $_wfobj->x5();
        //$this->kl10f  = $_wfobj->kl10f();
        $this->k3  = $_wfobj->k3();
        $this->pk10  = $_wfobj->pk10();
        $this->dp3  = $_wfobj->dpc();
        $this->lhc  = $_wfobj->lhc();
        $this->keno  = $_wfobj->keno();
        //$this->xy28  = $_wfobj->xy28();
        $this->display();
    }
    function oldWanfa(){
        $list = M('wanfa_old')->order("typeid asc,sort asc")->select();
        $data = [];
        foreach($list as $wanfa){
            $data[$wanfa['typeid']][$wanfa['class1']][] = $wanfa;
        }

        $playList = [];
        foreach($data as $typid => $list){
            if($typid == 'ssc'){
                $title = '时时彩';
            }elseif($typid == 'pk10'){
                $title = 'pk10';
            }
            $playList[$typid] = array('title'=>$title,'list'=>$list);
        }

        $this->assign('playList',$playList);
        $this->display();
    }

    function oldWfSave(){
        $id = I('id');
        $typeid  = I('typeid');
        $rate = I('rate');
        $minxf   = I('minxf');
        $maxxf   = I('maxxf');
        $class3   = I('class3');
        $totalzs = I('totalzs');
        $sort = I('sort');
        if(!$typeid || !$id){
            $this->error('参数错误');exit;
        }

        if($maxxf && !is_numeric($maxxf)){
            $this->error('最高消费格式错误');exit;
        }
        if($minxf && !is_numeric($minxf)){
            $this->error('最低消费格式错误');exit;
        }
        if($sort && !is_numeric($sort)){
            $this->error('最低消费格式错误');exit;
        }
        $db = D('wanfa_old');
        $data = [];
        $data['class3'] = $class3;
        $data['typeid'] = $typeid;
        $data['rate'] = $rate;
        $data['minxf'] = $minxf;
        $data['maxxf'] = intval($maxxf);
        $data['totalzs'] = $totalzs;
        $data['sort'] = $sort;
        $getid = $db->where(['typeid'=>$typeid,'id'=>$id])->getField('id');
        if($getid){
            unset($data['playid']);
            $int = $db->where(['id'=>$getid])->setField($data);
        }else{
            $int = $db->data($data)->add();
        }
        $int?$this->success('操作成功'):$this->error('操作失败');
    }
    function setoldwfstatus(){
        $db = D('wanfa_old');
        $typeid   = I('typeid');
        $id   = I('id');
        $name     = I('name');
        if($name!='isopen')$this->error('非法操作！');
        $info = $db->where(['typeid'=>$typeid,'id'=>$id])->find();
        if(!$info){
            $this->error('请先保存！');
        }
        $status = $info[$name]==1?0:1;
        $int = $db->where(['typeid'=>$typeid,'id'=>$id])->setField([$name=>$status]);
        $int?$this->success():$this->error();
    }
    function setwfstatus(){
		$db = D('wanfa');
		$typeid   = I('typeid');
		$playid   = I('playid');
		$name     = I('name');
		if($name!='isopen')$this->error('非法操作！');
		$info = $db->where(['typeid'=>$typeid,'playid'=>$playid])->find();
		if(!$info){
			$this->error('请先保存！');
		}
		$status = $info[$name]==1?0:1;
		$int = $db->where(['typeid'=>$typeid,'playid'=>$playid])->setField([$name=>$status]);
		$int?$this->success():$this->error();
	}
	function wfbaocun(){
		$typeid  = I('typeid');
		$playid  = I('playid');
		$maxjj   = trim(I('maxjj'));
		$minjj   = trim(I('minjj'));
		$maxrate   = I('maxrate');
		$minrate   = I('minrate');
		$rate = I('rate');
		$maxzs   = I('maxzs');
		$minxf   = I('minxf');
		$maxxf   = I('maxxf');
		$title   = I('title');
		$totalzs = I('totalzs');
		$groupid = I('groupid');
		$maxprize = I('maxprize');
		if(!$typeid || !$playid){
			$this->error('参数错误');exit;
		}
		/*		if($maxjj && !is_numeric($maxjj)){
                    $this->error('最高奖金格式错误');exit;
                }
                if($minjj && !is_numeric($minjj)){
                    $this->error('最低奖金格式错误');exit;
                }*/
		if($maxrate && !is_numeric($maxrate)){
			$this->error('最高赔率格式错误');exit;
		}
		if($minrate && !is_numeric($minrate)){
			$this->error('最低赔率格式错误');exit;
		}
		if($maxzs && !is_numeric($maxzs)){
			$this->error('最高注数格式错误');exit;
		}
/*		if($rate && !is_numeric($rate)){
			$this->error('赔率设置错误');exit;
		}*/
		if($minxf && !is_numeric($minxf)){
			$this->error('最低消费格式错误');exit;
		}
		$db = D('wanfa');
		$data = [];
		$data['title'] = $title;
		$data['typeid'] = $typeid;
		$data['playid'] = $playid;
		$data['maxjj'] = $maxjj;
		$data['minjj'] = $minjj;
		$data['maxrate'] = $maxrate;
		$data['minrate'] = $minrate;
		$data['rate'] = $rate;
		$data['maxzs'] = $maxzs;
		$data['minxf'] = $minxf;
		$data['maxxf'] = intval($maxxf);
		$data['totalzs'] = $totalzs;
		$data['maxprize'] = $maxprize;
		$getid = $db->where(['typeid'=>$typeid,'playid'=>$playid])->getField('id');
		if($getid){
			//unset($data['typeid']);
			unset($data['playid']);
			$int = $db->where(['id'=>$getid])->setField($data);
		}else{
			$int = $db->data($data)->add();
		}
		$int?$this->success('操作成功'):$this->error('操作失败');
	}

	function editmodelwfts(){
		if(!IS_POST){
			$this->error('非法操作');
		}
		$typeid   = I('typeid');
		$playid   = I('playid');
		$remark   = I('remark');
		$int = M('wanfa')->where(['typeid'=>$typeid,'playid'=>$playid])->setField(['remark'=>$remark]);
		$int?$this->success('操作成功'):$this->error('操作失败');
	}
	protected function rand_keys_x($len = 5,$str='01,02,03,04,05,06,07,08,09,10') {
		$_strs = [];
		$_strs = explode(',',$str);
		$len   = count($_strs)>=$len?$len:count($_strs);
		$_rands= array_rand($_strs,$len);
		$_nrands = [];
		foreach($_rands as $k=>$v){
			$_nrands[$k] = $_strs[$v];
		}
		shuffle($_nrands);
		return implode(',',$_nrands);
	}
	protected function rand_keys($len = 5,$str='0123456789') {
		$rand = '';
		for ($x=0;$x<$len;$x++) {
			$rand .= ($rand != '' ? ',' : '').substr($str, rand(0, strlen($str) - 1), 1);
		}
		return $rand;
	}
}