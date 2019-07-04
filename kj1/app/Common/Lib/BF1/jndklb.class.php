<?php
namespace Lib\threecaiji;
class jndklb{
	function __construct(){
		$this->_time = 210;
		
		$this->source = '加拿大keno官网';
		$this->name   = 'jndkeno' ;
		$this->title  = '加拿大keno' ;
	}
	function GetLotteryRes(){
		$lefttime = self::lefttime();
		if($lefttime){
			return $lefttime;
		}
		
		$url = 'http://lotto.bclc.com/services2/keno/draw/latest/today?_='.date('YmdHis').rand(1000,9999);
		$co  = CURL($url,'','snoopy');
		if(!$co)return '未获取到远程内容！';
		$_olist = self::tolist($co);
		$return = self::addto($_olist);
		return $return;
	}
	function famartdate($datestr=''){
		if(!$datestr)return ;
		$_mouths = array('01'=>'jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
		foreach($_mouths as $k=>$v){
			$_mouths[$k] = strtolower($v);
		};
		$dates = array_filter(explode(' ',str_replace(',',' ',$datestr)));
		foreach($dates as $k=>$v){
			$_dates[] = $v;
		}
		$_m = array_search(strtolower($_dates[0]),$_mouths);
		$date = $_dates[2].'-'.$_m.'-'.str_pad($_dates[1],2,'0',STR_PAD_LEFT);
		return $date;
	}
	function tobjtime($date=''){
		$_time = strtotime($date)+54000;
		return $_time;
	}
	function tolist($co){
		
		$_res = json_decode($co,true);
			
		foreach($_res as $k=>$v){
			$_olist[$v['drawNbr']]['qihao'] = $v['drawNbr'];
			$_olist[$v['drawNbr']]['ball']  = implode(',',$v['drawNbrs']);
			$optime = self::tobjtime(self::famartdate($v['drawDate']).' '.$v['drawTime']);
			$_olist[$v['drawNbr']]['end']   = date('Y-m-d H:i:s',$optime);
		}
		$_olist = list_sort_by($_olist,'qihao','asc');
		$_olist = self::zehelist($_olist);
		return $_olist;
	}
	
	function zehelist($_olist = array()){
		$datas = array();
		foreach($_olist as $k=>$v){
			$qihao    = $v['qihao'];
			$ball     = $v['ball'];
			$end      = $v['end'];
			$start    = date('Y-m-d H:i:s',strtotime($end)-$this->_time);
			
			$datas[$k] = array(
				'expect'     =>$qihao,
				'opencode'   =>$ball,
				'name'       =>$this->name,
				'title'      =>$this->title,
				'source'     =>$this->source,
				'opentime'   =>strtotime($end),
				'addtime'    =>date('Y-m-d H:i:s',time()),
			);
		}
		return $datas;
	}
	function addto($_olist = array()){
		if(!is_array($_olist))return '添加数据为空！';
		$db = M('kaijiang');
		foreach($_olist as $k=>$v){
			$v['name'] = $this->name;
			$qihao     = $v['qihao'];
			$data      = array();
			if(!M('kaijiang')->where("name='{$v['name']}' and expect='{$v['expect']}'")->find()){
				$data = $v;
				foreach($data as $k0=>$v0){
					if(strpos($v0,'-')!==false && strpos($v0,':')!==false)$data[$k0] = strtotime($v0);
				}
				$ints[$k] = $db->data($data)->add();
				if($ints[$k])F($this->name,$data['expect']);
			}
		}
		if(count($ints)>0){
			return '采集成功！';
		}else{
			return '数据未更新！';
		}
	}
	function lefttime(){
		$openqihao = F($this->name);
		$_t = time();
		if(!$openqihao)return false;
		$drawtimes = self::drawtimes();
		if($openqihao!=$drawtimes['currFullExpect']){
			return false;
		}else{
			return "剩余时间：".$drawtimes['remainTime'];
		}
	}
	function drawtimes(){
		$kjinfo = M('kaijiang')->order('id desc')->where(['name'=>'jndkeno'])->find();
		$nowtime = time();
		
		$qishucha = floor(($nowtime-$kjinfo['opentime'])/210);
		$actionNo = $kjinfo['expect'] + $qishucha;
		$predraws = [
			'expect'  => $actionNo,
			'end'     => date('Y-m-d H:i:s',$kjinfo['opentime'] + 210*$qishucha),
		];
		$nowdraws = [
			'expect'  => $actionNo+1,
			'end'     => date('Y-m-d H:i:s',$kjinfo['opentime'] + 210*(1+$qishucha)),
		];
		$jinrikaijiang = floor(($nowtime-strtotime(date('Y-m-d',$nowtime)))/210);
		$return = [
			'lastFullExpect'  => $predraws['expect'],
			'lastExpect'      => $jinrikaijiang-1,
			'currFullExpect'  => $nowdraws['expect'],
			'currExpect'      => $jinrikaijiang,
			'remainTime'      => strtotime($nowdraws['end'])-$nowtime,
			'openRemainTime'  => 0,
		];
		return $return;
	}
}
?>