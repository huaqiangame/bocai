<?php
namespace Admincenter\Controller;
use Think\Controller;
class YunweiController extends CommonController {
	public function __construct(){
		parent::__construct();
	}
	function caiji(){
		$db = M('setting');
		$_caijiset = $db->where(['name'=>'caijiset'])->order('id desc')->getField('value');
		$caijisets = $_caijiset?unserialize($_caijiset):[];
		$this->assign('caijisets',$caijisets);
		//彩种统计
		$cptypes = R('Caipiao/cpcategory');
		foreach($cptypes as $k=>$v){
			$array = [];
			$array['cptype'] = $v;
			$array['cplist'] = M('caipiao')->where(['typeid'=>$k])->field('title,name')->order('listorder asc')->select();
			$cptypes[$k] = $array;
		}
		$this->assign('cptypes',$cptypes);
		if(IS_POST){
			$_postsets = I('caijiset');
			$postsets = $_postsets?serialize($_postsets):'';
			if($caijisets){
				$_int = $db->where(['name'=>'caijiset'])->setField(['value'=>$postsets]);
			}else{
				$data = [];
				$data['name'] = 'caijiset';
				$data['value'] = $postsets;
				$_int = $db->data($data)->add();
			}
			$_int?$this->success():$this->error();
			exit;
		}
		$this->display();
	}
	function dbclear(){
		if(IS_POST){
			$_cleartypes = ['user','user1','isnbuser','kaijiang','touzhu','recharge','withdraw','fuddetail','memlog','adminlog'];
			$_int = 0;
			if($_POST['user']){
				$clearamountmin = $_POST['user']['clearamountmin'];
				$clearday = intval($_POST['user']['clearday']);
				if($clearamountmin>1 || $clearamountmin<0){
					$this->error('账户金额不得大于1元并且不能小于0');
				}
				if($clearday<60){
					$this->error('未登录天数不得低于60天');
				}
				$map = [];
				$map['balance'] = ['elt',$clearamountmin];
				$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//今天
				$_deletetime = $beginToday - 86400*$clearday - 1;
				$map['logintime'] = ['elt',NOW_TIME - $_deletetime];
				$_int = M('member')->where($map)->delete();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'clear';
				$logdata['info']     = "清理会员";
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($_int)M('adminlog')->data($logdata)->add();
			}elseif($_POST['user1'])
			{
				$clearday = intval($_POST['user1']['clearday']);
				if($clearday<7){
					$this->error('未登录天数不得低于7天');
				}
				$map = [];
				$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//今天
				$_deletetime = $beginToday - 86400*$clearday - 1;
				$map['regtime'] = ['elt',$_deletetime];
				$map['logintime'] = ['eq',0];
				$_int = M('member')->where($map)->delete();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'clear';
				$logdata['info']     = "清理会员";
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($_int)M('adminlog')->data($logdata)->add();
			}elseif($_POST['isnbuser']==1)
			{
				$map = [];
				$map['isnb'] = ['eq',1];
				$_int = M('member')->where($map)->delete();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'clear';
				$logdata['info']     = "清理内部会员";
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($_int)M('adminlog')->data($logdata)->add();
			}elseif($_POST['kaijiang']){
				$clearday = intval($_POST['kaijiang']['clearday']);
				if($clearday<1){
					$this->error('开奖数据至少保留1天内');
				}
				$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//今天
				$_deletetime = $beginToday - 86400*$clearday - 1;
				$map = [];
				$map['addtime'] = ['elt',$_deletetime];
				$_int = M('kaijiang')->where($map)->delete();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'clear';
				$logdata['info']     = "清理开奖";
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($_int)M('adminlog')->data($logdata)->add();
			}elseif($_POST['touzhu']){
				$clearday = intval($_POST['touzhu']['clearday']);
				$state    = intval($_POST['touzhu']['state']);
				if($clearday<45){
					$this->error('投注数据至少保留45天内');
				}
				$map = [];
				if($state!=999 && in_array($state,[0,-2])){
					$map['isdraw'] = ['eq',$state];
				}
				$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//今天
				$_deletetime = $beginToday - 86400*$clearday - 1;
				$map['oddtime'] = ['elt',$_deletetime];
				$_int = M('touzhu')->where($map)->delete();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'clear';
				$logdata['info']     = "清理投注";
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($_int)M('adminlog')->data($logdata)->add();
			}elseif($_POST['recharge']){
				$clearday = intval($_POST['recharge']['clearday']);
				$state    = intval($_POST['recharge']['state']);
				$map = [];
				if($state==999){
					if($clearday<60){
						$this->error('清理全部充值记录需保留在60天内');
					}
				}else{
					if($clearday<1){
						$this->error('清理全部充值记录需保留在1天内');
					}
					if(in_array($state,[0,-1])){
						$map['state'] = ['eq',$state];
					}else{
						$this->error('只能清理未审核和取消的充值');
					}
					
				}
				$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//今天
				$_deletetime = $beginToday - 86400*$clearday - 1;
				$map['oddtime'] = ['elt',$_deletetime];
				$_int = M('recharge')->where($map)->delete();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'clear';
				$logdata['info']     = "清理充值";
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($_int)M('adminlog')->data($logdata)->add();
			}elseif($_POST['withdraw']){
				$clearday = intval($_POST['withdraw']['clearday']);
				$state    = intval($_POST['withdraw']['state']);
				$map = [];
				if($state==999){
					if($clearday<60){
						$this->error('清理全部提款记录需保留在45天内');
					}
				}else{
					if($clearday<1){
						$this->error('清理全部提款记录需保留在1天内');
					}
					if(in_array($state,[0,-1])){
						$map['state'] = ['eq',$state];
					}else{
						$this->error('只能清理未审核和取消的提款');
					}
					
				}
				$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//今天
				$_deletetime = $beginToday - 86400*$clearday - 1;
				$map['oddtime'] = ['elt',$_deletetime];
				$_int = M('withdraw')->where($map)->delete();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'clear';
				$logdata['info']     = "清理提款";
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($_int)M('adminlog')->data($logdata)->add();
			}elseif($_POST['fuddetail']){
				$clearday = intval($_POST['fuddetail']['clearday']);
				if($clearday<45){
					$this->error('账变记录至少保留45天内');
				}
				$map = [];
				$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//今天
				$_deletetime = $beginToday - 86400*$clearday - 1;
				$map['oddtime'] = ['elt',$_deletetime];
				$_int = M('fuddetail')->where($map)->delete();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'clear';
				$logdata['info']     = "清理账变";
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($_int)M('adminlog')->data($logdata)->add();
			}elseif($_POST['memlog']){
				$clearday = intval($_POST['memlog']['clearday']);
				if($clearday<7){
					$this->error('会员日志至少保留7天内');
				}
				$map = [];
				$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//今天
				$_deletetime = $beginToday - 86400*$clearday - 1;
				$map['time'] = ['elt',$_deletetime];
				$_int = M('memberlog')->where($map)->delete();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'clear';
				$logdata['info']     = "清理会员日志";
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($_int)M('adminlog')->data($logdata)->add();
			}elseif($_POST['adminlog']){
				$clearday = intval($_POST['adminlog']['clearday']);
				if($clearday<7){
					$this->error('管理员日志至少保留7天内');
				}
				$map = [];
				$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));//今天
				$_deletetime = $beginToday - 86400*$clearday - 1;
				$map['time'] = ['elt',$_deletetime];
				$_int = M('adminlog')->where($map)->delete();
				//管理操作日志
				$logdata = [];
				$logdata['userid']   = $this->admininfo['id'];
				$logdata['username'] = $this->admininfo['username'];
				$logdata['type']     = 'clear';
				$logdata['info']     = "清理管理员日志";
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				if($_int)M('adminlog')->data($logdata)->add();
			}
			$_int?$this->success('清理成功'):$this->error('数据不存在');
			exit;
		}
		$this->display();
	}
	function jihua(){
		$setlist  = M('setting')->select();
		$newarray = [];
		foreach($setlist as $k=>$v){
			$newarray[$v['name']] = $v['value'];
		}
		$this->setlist = $newarray;
		if(IS_POST){
			$param = $_POST['jihua'];
			foreach($param as $k=>$v){
				$k = trim($k);
				$data = [];
				$data['name']  = $k;
				$data['value'] = $param[$k];
				if(!M('setting')->where(['name'=>$data['name']])->find()){
					$ints[] = M('setting')->data($data)->add();
				}else{
					$ints[] = M('setting')->where(['name'=>$data['name']])->setField(['value'=>$data['value']]);
				}
			}
			count(array_filter($ints))>=1?$this->success('配置保存成功！'):$this->error('配置保存失败！');
		}
		$this->display();
	}
	function yijianclear(){
		if(IS_POST){
			$dbs = $_POST['cleardb'];
			if(!$dbs){
				$this->error('请选择清理的数据库');
			}
			$_t = time();
			$starttime = strtotime(date('Y-m-01 00:01:00'));
			if($_t<$starttime){
				$this->error('请于每个月1号后清理');
			} 
			$clear_time = strtotime(date('Y-m-01 00:00:00'));
			if($dbs['cz']){
				$cz_int = M('recharge')->where(['oddtime'=>['elt',$clear_time]])->delete();
			}
			if($dbs['tk']){
				$tk_int = M('withdraw')->where(['oddtime'=>['elt',$clear_time]])->delete();
			}
			if($dbs['tz']){
				$tz_int = M('touzhu')->where(['oddtime'=>['elt',$clear_time]])->delete();
			}
			if($dbs['zb']){
				$zb_int = M('fuddetail')->where(['oddtime'=>['elt',$clear_time]])->delete();
			}
			if($dbs['hd']){
				$jj_int = M('fanshui')->where(['oddtime'=>['elt',$clear_time]])->delete();
			}
			if($dbs['kj']){
				$kj_int = M('kaijiang')->where(['addtime'=>['elt',$clear_time]])->delete();
				M('yukaijiang')->where(['opentime'=>['elt',$clear_time]])->delete();
			}
			$this->success("清理成功");
		}
		$this->display();
	}
}