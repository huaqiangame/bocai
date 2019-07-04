<?php
namespace Lib\threecaiji;
class ynffc{
	function __construct(){
		$this->source = '彩票控';
		$this->name   = 'ynffc' ;
		$this->title  = '印尼分分彩' ;
		$this->total  = 1440;
		//第一期开奖时间/每期间隔时间（秒）
		$this->start  = '00:01:00';
		$this->jgtime  = 60;
	}
	function getopencode(){
		$name  = $this->name;
		$title = $this->title;
		$total = $this->total;
		if($lefttime = self::lefttime()){
			return $lefttime;
		}
		$url = 'http://m.caipiaokong.com/lottery.php?mod=ynffc';
		$co  = xCurl($url);
		if(!$co)return '远程数据抓取错误！';
		preg_match_all('#<tr><th>(.*)</div></td></tr>#iUS',$co,$_TRS);
		foreach($_TRS[1] as $k=>$v){
			$_TR = '';
			$_TR = str_replace('</strong>',',',preg_replace(['/<span(.[^>]*)>/i','/<strong(.[^>]*)>/i','/<div(.[^>]*)>/i'],['','',''],$v));
			$_TRS[1][$k] = $_TR;
			preg_match('#</span>(.[^<]*)</span></th></tr><tr><td>(.[^<]*)#i',$_TR,$_alls);
			if($qihao = self::getopenqihao($_alls[1])){
				$datas[$k]['opentime'] = $_alls[1];
				$datas[$k]['balls'] = substr($_alls[2],0,9);
				$datas[$k]['qihao'] = $qihao;
			}
		}
		$datas = list_sort_by($datas,'qihao','asc');
		$datas = array_slice($datas,-20);
		foreach($datas as $k=>$v){
			$data = array();
			$data['title']       =  $title;
			$data['name']        =  $name;
			$data['expect']      =  $v['qihao'];
			$data['opencode']    =  $v['balls'];
			$data['opentime']    =  $v['opentime'];
			$data['source']     = $this->source;
			$temps[$k] = $data;
			foreach($data as $k1=>$v1){
				if(strpos($v1,'-')!==false && strpos($v1,':')!==false)$data[$k1] = strtotime($v1);
			}
			$_int = '';
			if(!M('kaijiang')->where("name='{$name}' and expect='{$data['expect']}'")->find()){
				$_int = M('kaijiang')->data($data)->add();
				if($_int)$ints[] = $data['expect'];
			}
			
			
		}
		//dump($temps);exit;
		if(is_array($ints) && count(array_filter($ints))>=1){
			return '采集成功';
		}else{
			return '未更新';
		}
	}
	
	function getopenqihao($optime){
		$optime = strtotime(date('Y-m-d H:i:00',strtotime($optime)));
		$total  = $this->total;
		$openstart  = $this->start;
		$jgtime = $this->jgtime;
		$array = array();
		for($i=1;$i<=$total;$i++){
			$start = strtotime($openstart)-$jgtime + ($i-1)*$jgtime;
			$end = strtotime($openstart)+($i-1)*$jgtime;
			//$array[$i] = array('start'=>date('Y-m-d H:i:s',$start),'end'=>date('Y-m-d H:i:s',$end));
			if($optime<=$end && $optime>$start){
				$current = array('qihao'=>date('Ymd').str_pad($i,4,0,STR_PAD_LEFT),'start'=>date('Y-m-d H:i:s',$start),'end'=>date('Y-m-d H:i:s',$end));
			}
		}
		return $current?$current['qihao']:FALSE;
	}
	
	function getopentime($ext=''){
		$total  = $this->total;
		$openstart  = $this->start;
		$jgtime = $this->jgtime;
		$array = array();
		for($i=1;$i<=$total;$i++){
			$start = strtotime($openstart)-$jgtime + ($i-1)*$jgtime;
			$end = strtotime($openstart)+($i-1)*$jgtime;
			$array[$i] = array('start'=>date('Y-m-d H:i:s',$start),'end'=>date('Y-m-d H:i:s',$end));
		}
		$ext = intval($ext);
		return $array[$ext]?$array[$ext]:$array;
	}
	function lefttime(){
		$name  = $this->name;
		$title = $this->title;
		$total  = $this->total;
		$openstart  = $this->start;
		$jgtime = $this->jgtime;

		$info = M('kaijiang')->where("name='{$name}'")->order('opentime desc,id desc')->find();
		if(!$info)return false;
		$ext = substr($info['expect'],-2);
		$_datetime = strtotime(substr($info['expect'],0,8));
		if($ext==$total){
			$_times   = self::getopentime('001');
			$opentime = strtotime(date('Y-m-d',$_datetime+86400).' '.date('H:i:s',strtotime($_times['end'])));
		}else{
			$opentime = $info['opentime']+$jgtime;
		}
		$t = time();
		$lt = $opentime-$t;
		if($lt>0){
			return '采集剩余时间：'.$lt.'秒';
		}else{
			return false;
		}
	}
	
}
?>
