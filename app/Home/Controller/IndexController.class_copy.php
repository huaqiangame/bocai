<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
	public function __construct(){
		parent::__construct();
	}
	function index(){
//        dump($_SESSION);
		$_t = time();
		//dump(intval(0.8));exit; 
		/*首页banner下彩票展示*/
			$cplist = M('caipiao')->where("isopen=1")->cache('index_cplist',300)->order('allsort asc,id desc')->select();

		foreach($cplist as $k=>$v){
			$balls = array();
			$hz = 0;$daxiao = $danshuang = '';
			$cpinfo = Array();
			if($v['issys']=='0'){
				$kjinfo = S('kjinfo'.$k);
				if(!$kjinfo){
					$kjinfo  = M('kaijiang')->where(array('name'=>array('eq',$v['name'])))->cache('kjinfo'.$k ,300)->limit(1)->order('id desc')->find();
                  }
				}/*else if($v['issys']=='1'){
				$kjinfo = S('kjinfo2');
				if(!$kjinfo){
				$kjinfo = M('kaijiang')->where(array('name'=>array('eq',$v['name']),'opentime'=>array('elt',$_t)))->cache('kjinfo2',300)->order('id desc')->limit(1)->find();
				  }
			}*/
			$balls = explode(',',$kjinfo['opencode']);
			$hz    = array_sum($balls);
			if($hz>10){
				$daxiao = '大';
			}else{
				$daxiao = '小';
			}
			if($hz%2==0){
				$danshuang = '双';
			}else{
				$danshuang = '单';
			}
			$cplist[$k]['opencode'] = $balls;
			$cplist[$k]['daxiao'] = $daxiao;
			$cplist[$k]['danshuang'] = $danshuang;
			$cplist[$k]['expect'] = $kjinfo['expect'];
		}
		$this->assign('bncaipiao',$cplist);
		//昨日资金榜和中奖信息
		$time=time ()- ( 1  *  24  *  60  *  60 ); //昨天时间截
		$day = date("Y-m-d",$time);
		$StartTime = date($day.' 00:00:00');      //昨天开始时间
		$EndTime   = date($day.' 23:59:59') ;     //昨天开始结束
		$map['oddtime'][]=array('egt',strtotime($StartTime));
		$map['oddtime'][]=array('elt',strtotime($EndTime));
		//查找昨日投注
		$list  = M('')->table('__TOUZHU__ t,__MEMBER__ m,__MEMBERGROUP__ p')->field('t.cpname as k3name,t.uid,t.okamount,t.cpname,m.username,m.sex,m.face,p.groupname,p.touhan')->distinct(true)->where('t.isdraw=1 AND m.id=t.uid AND m.groupid=p.groupid')->cache('indexlist',300)->select();
		$list2 = M('')->table('__TOUZHU__ t,__MEMBER__ m,__MEMBERGROUP__ p')->field('t.cpname as k3name,t.uid,t.okamount,t.cpname,m.username,m.sex,m.face,p.groupname,p.touhan')->distinct(true)->where('t.isdraw=1 AND m.id=t.uid AND m.groupid=p.groupid')->cache('indexlist2',300)->order('t.okamount DESC')->select();


		foreach ($list as $key=>$value){
			$list[$key]["okamountcount"] = M('touzhu')->distinct(true)->where("isdraw=1 AND uid='{$value['uid']}' AND username='{$value['username']}'")->cache('indexokamount',300)->SUM('okamount');
			$list[$key]["amountcount"] = M('touzhu')->distinct(true)->where("isdraw=1 AND uid='{$value['uid']}' AND username='{$value['username']}'")->where($map)->cache('okamount2',300)->SUM('okamount');
			$list[$key]["k3names"] = M('touzhu')->distinct ( true )->where ("uid='{$value['uid']}' AND username='{$value['username']}'")->cache(300)->field ( 'cpname as name,cptitle as title' )->limit(8)->select();
 		}
		foreach ($list2 as $key=>$value){
			$list2[$key]["okamountcount"] = M('touzhu')->distinct(true)->cache('indexokamount3',300)->where("isdraw=1 AND uid='{$value['uid']}' AND username='{$value['username']}'")->SUM('okamount');
			$list2[$key]["k3names"] = M('touzhu')->distinct ( true )->cache('indexokamount4',300)->where ("uid='{$value['uid']}' AND username='{$value['username']}'")->field ('cpname as name,cptitle as title')->limit(8)->select();
		} 
		$list=list_sort_by($list,'amountcount','desc');

		$member = M('member')->field('id,username,face')->cache('indexmember',300)->select();
		$list = list_sort_by($list,'amountcount','desc');
		foreach ($list as $key => $value) {
			foreach ($member as $k => $v){
				if($value['uid'] == $v['id']){
					$arr[$value['uid']][] = $value;
				}
			}
		}
		foreach ($arr as $k => $v){
			$_list[] = $arr[$k][0];
		}

		$group = M('Membergroup')->field('groupid,groupname,touhan')->where('isagent <> 1')->cache('indexmembergroup',300)->order('groupid ASC')->select();

		if(C('ranking')==1 or empty($_list[3]['amountcount']))
		{  //如果昨天没有奖金榜或开始了随机奖金榜
			if(!$_COOKIE['list']){              //如果cookie 不存在
				$this->assign('list' , $this->randking(null,$group));
				header( "Location: ".U('Index/index')."" );
			}else{                              //如果cookie存在
				$obj = object_to_array(json_decode($_COOKIE['list']));
				foreach ($obj as $key=>$value) {
					$obj[$key]['k3names']= M('caipiao')->field("name,title")->limit(rand(0,3),6)->select();

					switch ($obj[$key]['groupname']){
						case $group[0]['groupname']:
							$obj[$key]['touhan'] = $group[0]['touhan'];
							break;
						case $group[1]['groupname']:
							$obj[$key]['touhan'] = $group[1]['touhan'];
							break;
						case $group[2]['groupname']:
							$obj[$key]['touhan'] = $group[2]['touhan'];
							break;
						case $group[3]['groupname']:
							$obj[$key]['touhan'] = $group[3]['touhan'];
							break;
						case $group[4]['groupname']:
							$obj[$key]['touhan'] = $group[4]['touhan'];
							break;
						case $group[5]['groupname']:
							$obj[$key]['touhan'] = $group[5]['touhan'];
							break;
						case $group[6]['groupname']:
							$obj[$key]['touhan'] = $group[6]['touhan'];
							break;
						case $group[7]['groupname']:
							$obj[$key]['touhan'] = $group[7]['touhan'];
							break;
						case $group[8]['groupname']:
							$obj[$key]['touhan'] = $group[8]['touhan'];
							break;
						case $group[9]['groupname']:
							$obj[$key]['touhan'] = $group[9]['touhan'];
							break;
					}
				}
				$this->assign('list', $obj);
				$this->assign('list2',$this->randking(1,$group)) ;
			}
			$this->display();
		}else{
			$this->assign('list',$_list);
			$this->assign('list2',$list2);
			$this->display();
		}
	}
	//随机资金榜
	public function randking($nocookie=null,$group){
		$nocookie?$no = 50 : $no =10;
		$allk3 = M('caipiao')->field("name,title")->where("isopen=1")->select();
		for ($i=0;$i<$no;$i++) {
			$count = rand(1,6); $num = rand(4,10); $num2  = rand(2,3);$num3  = rand(1,2);
			$user[$i]['username']  =  rand_strings($num,$count);
			$user[$i]['okamount']  =  rand_strings(1,7).rand_strings($num3,0).'.'.rand(1,99);
			$user[$i]['face']      = '/resources/images/face/'.rand(1,25).'.jpg';
			$user[$i]['sex']       =  rand(0,2);
			$user[$i]['groupname'] =  $group[rand(0,8)]['groupname'];
			$user[$i]['k3name']    =  $allk3[rand(0,14)]['title'];
			$user[$i]["amountcount"]     =    rand_strings(1,7).rand_strings($num2,0).'.'.rand(1,99);
			$user[$i]["okamountcount"]     =  $user[$i]['amountcount'] * (rand(6,9));
		}
		$sedcon = strtotime(date("Y-m-d ")."23:59:59")-time();
		$user = list_sort_by($user,'amountcount','desc');
		$list =json_encode($user);
		if($nocookie){
			foreach ($user as $key=> $value){
				$user[$key]['k3names']= M('caipiao')->field("name,title")->limit(rand(0,3),6)->select();
				switch ($user[$key]['groupname']){
					case $group[0]['groupname']:
						$user[$key]['touhan'] = $group[0]['touhan'];
						break;
					case $group[1]['groupname']:
						$user[$key]['touhan'] = $group[1]['touhan'];
						break;
					case $group[2]['groupname']:
						$user[$key]['touhan'] = $group[2]['touhan'];
						break;
					case $group[3]['groupname']:
						$user[$key]['touhan'] = $group[3]['touhan'];
						break;
					case $group[4]['groupname']:
						$user[$key]['touhan'] = $group[4]['touhan'];
						break;
					case $group[5]['groupname']:
						$user[$key]['touhan'] = $group[5]['touhan'];
						break;
					case $group[6]['groupname']:
						$user[$key]['touhan'] = $group[6]['touhan'];
						break;
					case $group[7]['groupname']:
						$user[$key]['touhan'] = $group[7]['touhan'];
						break;
					case $group[8]['groupname']:
						$user[$key]['touhan'] = $group[8]['touhan'];
						break;
					case $group[9]['groupname']:
						$user[$key]['touhan'] = $group[9]['touhan'];
						break;
				}
			}
			return $user;
			exit();
		}else{
			cookie('list',$list,$sedcon);
		}
	}
	//手机购彩
	public function Mobile(){
		$this->display();
	}
	public function winners(){
		$time=time ()- ( 1  *  24  *  60  *  60 );
		$day = date("Y-m-d",$time);
		$StartTime = date($day.' 00:00:00');
		$EndTime   = date('Y-m-d H:i:s') ;
		$map['oddtime'][]=array('egt',strtotime($StartTime));
		$map['oddtime'][]=array('elt',strtotime($EndTime)+86400-10);
		$list  = M('')->table('__TOUZHU__ t,__MEMBER__ m')->field('t.cpname,t.uid,t.okamount,m.username,m.face')->where('t.status=1 AND m.id=t.uid')->select();
		$list2 = M('')->table('__TOUZHU__ t,__MEMBER__ m')->field('t.cpname,t.uid,t.okamount,m.username,m.face')->where($map)->where('t.status=1 AND m.id=t.uid')->order('okamount DESC')->select();

		if(C('ranking')==1){
			$this->assign('randking',$this->randking()) ;
			$this->display();
		}else{
			$this->assign('list',$list);
			$this->assign('list2',$list2);
			$this->display();
		}
	}
	//热门彩票
	function lottery(){
		$group = M('Membergroup')->field('groupid,groupname,touhan')->where('isagent <> 1')->order('groupid ASC')->select();
		$Allcp = $Akkcp = $hotcaipiao = M("caipiao")->where("isopen = 1")->order("listorder ASC")->select();

		foreach ($hotcaipiao as $key => $value){
			$where['cpname'] = $value['name'];
			$count = M('touzhu')->where($where)->count();
			$hotcaipiao[$key]['count']= $count;
		}
		$sort = array(
			'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
			'field'     => 'count',       //排序字段
		);
		$arrSort = array();
		foreach($hotcaipiao AS $key => $value){
			foreach($value AS $k=>$v){
				$arrSort[$k][$key] = $v;
			}
		}
		if($sort['direction']){
			array_multisort($arrSort[$sort['field']], constant($sort['direction']), $hotcaipiao);
		}


//全部排序
		$sort2 = array(
			'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
			'field'     => 'allsort',       //排序字段
		);
		$arrSort2 = array();
		foreach($Allcp AS $key => $value){
			foreach($value AS $k=>$v){
				$arrSort2[$k][$key] = $v;
			}
		}
		if($sort2['direction']){
			array_multisort($arrSort2[$sort2['field']], constant($sort2['direction']), $Allcp);
		}
		$this->assign('Allcp',$Allcp);
		$this->assign('hotcaipiao',$hotcaipiao);
		$this->assign('Akkcp',$Akkcp);
		$this->assign('list',$this->randking(1,$group));
		$this->display();
	}
	function gonggao(){
		$id = I('id');
		$gglist = C('gglist');
		$info = $gglist[$id];
		if($info){
			$info['oddtime'] = date('Y-m-d H:i',$info['oddtime']);
			$return['sign'] = true;
			$return['message'] = '获取成功';
			$return['data'] = $info;
			echo jsonreturn($return);exit;
		}else{
			$return['sign'] = false;
			$return['message'] = '获取失败';
			echo jsonreturn($return);exit;
		}
	}
}
?>