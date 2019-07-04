<?php
namespace Lib\lotterytimes;
class xjssc {
	function drawtimes(){
		$name = 'xjssc';
		$cjnowtime = cjnowtime($name);
		$nowtime = time()+$cjnowtime;
		$total  = 48;
		$openstart  = '10:20:00';
		$jgtime = 1200;
		$yctime = 0;
		$_yct = ceil($yctime/$total);
		$array = array();
		for($i=1;$i<=$total;$i++){
			$start = strtotime($openstart)-$jgtime + ($i-1)*$jgtime + ($i-1)*$_yct;
			$end = strtotime($openstart)+($i-1)*$jgtime + ($_yct*$i);
			$draws[$i] = array('start'=>date('H:i:s',$start),'end'=>date('H:i:s',$end));
		}
		$draws[1]['start'] = date('Y-m-d H:i:s',strtotime($draws[$total]['end']));
		foreach($draws as $k=>$v){
            $startTime = strtotime($v['start']);
            $endTime = strtotime($v['end']);
		    if($k == 85 ){
		        if(time()>= strtotime('23:58:00')){
                    $endTime = strtotime($v['end'])+3600*24;
                }else{
		            $startTime = strtotime($v['start']) - 3600* 24;
                }
            }
			if($nowtime>$startTime && $nowtime<=$endTime){
				$nowqihao = str_pad($k,3,0,STR_PAD_LEFT);
			}
		}
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
		if(substr($nowdraws['expect'],-2)>=85){
			$nowdraws['expect']= (substr($nowdraws['expect'],0,strlen($nowdraws['expect'])-3)-1).'0'.substr($nowdraws['expect'],-2);
			$predraws['expect']= (substr($predraws['expect'],0,strlen($predraws['expect'])-3)-1).'0'.substr($predraws['expect'],-2);
		}
		$return = [
			'lastFullExpect'  => $predraws['expect'],
			'lastExpect'      => substr($predraws['expect'],-3),
			'currFullExpect'  => $nowdraws['expect'],
			'currExpect'      => substr($nowdraws['expect'],-3),
			'remainTime'      => strtotime($nowdraws['end'])-time()-$cjnowtime,
			'openRemainTime'  => "",
		];
		return $return;
	}
}
?>