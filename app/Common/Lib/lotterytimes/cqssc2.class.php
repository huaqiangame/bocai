<?php
namespace Lib\lotterytimes;
class cqssc {
	function drawtimes(){
		$name = 'cqssc';
		$cjnowtime = cjnowtime($name);  
		$nowtime = time() + $cjnowtime;
		$total  = 120;
		$openstart  = '00:05:00';
/*		$tentime= strtotime(date("Y-m-d 10:00:00"));
		$time =  time();
		if($time >= $tentime){
			$jgtime = 600;
		}else{
			$jgtime = 300;
		}*/
		$yctime = 0;
		$_yct = ceil($yctime/$total);
		$array = array();
		for($i=1;$i<=$total;$i++){
			if($openstart)
			$start = strtotime($openstart)-$jgtime + ($i-1)*$jgtime + ($i-1)*$_yct;
/*			if(
				strtotime($start)>strtotime(date("Y-m-d 01:55:00"))&& strtotime($start)< strtotime(date("Y-m-d 01:55:00")))*/
			$end = strtotime($openstart)+($i-1)*$jgtime + ($_yct*$i);
			dump(getday($start));
			$draws[$i] = array('start'=>date('H:i:s',$start),'end'=>date('H:i:s',$end));
		}
		$draws[1]['start'] = date('Y-m-d H:i:s',strtotime($draws[$total]['end'])-86400);
		foreach($draws as $k=>$v){
			if($nowtime>strtotime($v['start']) && $nowtime<=strtotime($v['end'])){
				$nowqihao = str_pad($k,3,0,STR_PAD_LEFT);
			}
		}
		exit(dump($draws));
		if(!$nowqihao){
			$nowqihao = str_pad(1,3,0,STR_PAD_LEFT);
			$draws[1]['start']   = date('Y-m-d H:i:s',strtotime($draws[$total]['end']));
			$draws[1]['end']   = date('Y-m-d H:i:s',strtotime($draws[1]['end'])+86400);
			$nowdraws = [
				'expect'  => date('Ymd',strtotime($draws[1]['end'])).$nowqihao,
				'start'   => $draws[1]['start'],
				'end'     => $draws[1]['end']
			];
			$preqihao = str_pad($total,3,0,STR_PAD_LEFT);
			$predraws = [
				'expect' => date('Ymd',strtotime($draws[1]['start'])).$preqihao,
				'start'  => date('Y-m-d H:i:s',strtotime($draws[$total]['start'])),
				'end'    => date('Y-m-d H:i:s',strtotime($draws[$total]['end'])),
			];
		}else{
			$nowqihao = str_pad($nowqihao,3,0,STR_PAD_LEFT);
			$nowdraws = [
				'expect'  => date('Ymd',$nowtime).$nowqihao,
				'start'   => date('Y-m-d',$nowtime).' '.$draws[intval($nowqihao)]['start'],
				'end'     => date('Y-m-d',$nowtime).' '.$draws[intval($nowqihao)]['end']
			];
			if(intval($nowqihao)==1){
				$preqihao = str_pad($total,3,0,STR_PAD_LEFT);
				$nowexpecttime = strtotime($draws[$total]['end'])-86400;
				$predraws = [
					'expect' => date('Ymd',$nowexpecttime).$preqihao,
					'start'  => date('Y-m-d',$nowexpecttime).' '.$draws[intval($preqihao)]['start'],
					'end'    => date('Y-m-d',$nowexpecttime).' '.$draws[intval($preqihao)]['end'],
				];
			}else{
				$preqihao = str_pad($nowqihao-1,3,0,STR_PAD_LEFT);;
				$predraws = [
					'expect' => date('Ymd',$nowtime).$preqihao,
					'start'  => date('Y-m-d',$nowtime).' '.$draws[intval($preqihao)]['start'],
					'end'    => date('Y-m-d',$nowtime).' '.$draws[intval($preqihao)]['end'],
				];
			}
		}
		$return = [
			'lastFullExpect'  => $predraws['expect'],
			'lastExpect'      => substr($predraws['expect'],-3),
			'currFullExpect'  => $nowdraws['expect'],
			'currExpect'      => substr($nowdraws['expect'],-3),
			'remainTime'      => strtotime($nowdraws['end'])-time()-$cjnowtime,
			'openRemainTime'  => $cjnowtime,
		];
		return $return;
	}
}
?>