<?php
namespace Jihua\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		header("Content-type: text/html; charset=utf-8");
		M('kaijiang')->where("name='bjk3' and expect > 74232")->delete();
		/*M('kaijiang')->where("name!='bjk3' and name!='f1k3' and name!='f5k3' and expect > 20170408006")->delete();
		
		$list1 = M('kaijiang')->where("name='f1k3' or name='f5k3'")->limit(200)->order('expect desc')->select();
		foreach($list1 as $k=>$v){
			$touzhuopencode = '';
			$touzhuopencode = M('touzhu')->where(['cpname'=>$v['name'],'expect'=>$v['expect']])->getField('opencode');
			if($touzhuopencode!='' && $touzhuopencode!=$v['opencode']){
				$int = M('kaijiang')->where(['name'=>$v['name'],'expect'=>$v['expect']])->setField(['opencode'=>$touzhuopencode]);
			dump($int.'---'.$v['opencode'].'---'.$touzhuopencode);
			
			}
		}
		//M('kaijiang')->where("name='bjk3' and expect > 74219")->delete();
		*/
		exit;
		$m = date('Y-m-d', mktime(0,0,0,date('m')-1,1,date('Y')));
		$tdays = date('t',strtotime($m));
		$m_statetime = date('Y-m-d H:i:s', mktime(0,0,0,date('m')-1,1,date('Y'))); //上个月的开始日期
		$m_endtime   = date('Y-m-d 23:59:59', mktime(0,0,0,date('m')-1,$tdays,date('Y'))); //上个月第一天的结束日期
		//$m_endtime   = date('Y-m-d 23:59:59', time()); //上个月的结束日期
		$BeginDate   = date('Y-m-01 H:i:s', strtotime(date("Y-m-d")));//本月第一天
		$_t = time();
		$_setdatetime    = $m_statetime;
		$_set_start_time = strtotime($m_statetime);
		$_set_end_time   = strtotime($m_endtime)-1;
		//结算起始截至时间
		$jiesuan_start_time = $_set_start_time;
		$jiesuan_end_time   = $_set_end_time;
		$jihuadailifenhongtime = F('jihuadailifenhongtime');
		$beginToday = strtotime($BeginDate);//本月第一天开始时间戳
		$endToday   = strtotime("$BeginDate +1 month -1 day")+86400-1;//本月结束时间戳
		/*if($jihuadailifenhongtime && $jihuadailifenhongtime>=$beginToday && $jihuadailifenhongtime<=$endToday){
			return "上月代理分红已经赠送";
		}*/
		
		//本月第一天开始结束
		$m_beginToday = strtotime(date('Y-m-d H:i:s', mktime(0,0,0,date('m'),1,date('Y')))); //本月的开始日期
		$m_endToday   = strtotime(date('Y-m-d 23:59:59', $m_beginToday)); //本月第一天的结束日期
		dump($m_beginToday);
		dump($m_endToday);
		exit;
		if($_t > $m_endToday || $_t < $m_beginToday){
			return "上月代理分红时间点".date('Y-m-d H:i:s',$m_beginToday)."~".date('Y-m-d H:i:s',$m_endToday);
		}
//-------------------------------------------
		exit;
		$DB_PREFIX = C('DB_PREFIX');
		$_tables = M()->query($sql = 'show tables');
		$tables = [];
		foreach($_tables as $_tables1){
			foreach($_tables1 as $_tablename){
				$tables[] = $_tablename;
				M()->query("ALTER TABLE `{$_tablename}` ENGINE = MYISAM");
			}
		}
		// 
		//dump(5555);
		dump($tables);
		exit;
		$_fields1 = M('fuddetail')->getDbFields();
		if(!in_array('downuid',$_fields1)){
			M()->query("ALTER TABLE `caipiao_fuddetail` ADD `downuid` INT(11) NOT NULL DEFAULT '0' AFTER `username`;");
		}
		$_fields2 = M('yukaijiang')->getDbFields();
		if(!in_array('stateadmin',$_fields2)){
			M()->query("ALTER TABLE `caipiao_yukaijiang` ADD `stateadmin` char(32) NOT NULL AFTER `opentime`;");
		}
		exit;
		$memberdb = M('member');
		$kjinfo = M('kaijiang')->where(['name'=>'hubk3','expect'=>'20170306026'])->find();
		if($kjinfo['opencode']!='5,5,6'){
			exit('000000000000000000000');
		}
		$tzlist = M('touzhu')->where(['cpname'=>'hubk3','expect'=>'20170306026'])->select();
		if(!$tzlist){
			exit('not find!');
		}		
		M()->startTrans();//事务开始

		$memints = [];
		foreach($tzlist as $k=>$v){
			if($v['isdraw']==1){//扣除已返奖用户金额
				$memints[] = $memberdb->where(['id'=>$v['uid']])->setDec('balance',$v['okamount']);
			}
		}
		//恢复到未开奖
		$tzint = M('touzhu')->where(['cpname'=>'hubk3','expect'=>'20170306026'])->setField(['isdraw'=>0,'okamount'=>0,'okcount'=>0,'opencode'=>'']);
		
		//重置开奖结果
		$kjint = M('kaijiang')->where(['name'=>'hubk3','expect'=>'20170306026'])->setField(['isdraw'=>0,'opencode'=>'1,4,6']);
		
		if($tzint && $kjint){
			M()->commit();
			echo 'OKOKOK';
		}else{
			M()->rollback();
			echo 'ERROR';
		}
    }
}