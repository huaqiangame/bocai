<?php
namespace Lib\lotterytimes;
class pl3 {
	function drawtimes(){
		$name = 'pl3';
		$cjnowtime = cjnowtime($name);
		$nowtime = time() + $cjnowtime;
		$total  = 1;
		$openstart  = '20:30:00';
		$jgtime = 86400;
		$yctime = 0;
		$_yct = ceil($yctime/$total);

		$_start_t = strtotime(date('Y-m-d', time()));
		$_day = (($_start_t - strtotime('2017-6-10')) / 3600 / 24);
		$draws = array();
		for($i=1;$i<=$total;$i++){
			$start = strtotime($openstart)-$jgtime + ($i-1)*$jgtime;
			$end = strtotime($openstart)+($i-1)*$jgtime;
			$draws[$i] = array('start'=>date('H:i:s',$start),'end'=>date('H:i:s',$end));
		}
		$draws[1]['start'] = date('Y-m-d H:i:s',strtotime($draws[$total]['end'])-86400);
		foreach($draws as $k=>$v){
			if($nowtime>strtotime($v['start']) && $nowtime<=strtotime($v['end'])){
				$nowqihao = str_pad($k,3,0,STR_PAD_LEFT);
			}
		}
		if(!$nowqihao){
			$nowqihao = str_pad(1,3,0,STR_PAD_LEFT);
			$actionNo = $_day + intval($nowqihao) +  2017788;
			$draws[1]['start']   = date('Y-m-d H:i:s',strtotime($draws[$total]['end']));
			$draws[1]['end']   = date('Y-m-d H:i:s',strtotime($draws[1]['end'])+86400);
			$nowdraws = [
				'expect'  => $actionNo,
				'start'   => $draws[1]['start'],
				'end'     => $draws[1]['end']
			];
			$preqihao = str_pad($total,3,0,STR_PAD_LEFT);
			$predraws = [
				'expect' => $actionNo-1,
				'start'  => date('Y-m-d H:i:s',strtotime($draws[$total]['start'])),
				'end'    => date('Y-m-d H:i:s',strtotime($draws[$total]['end'])),
			];
		}else{
			$nowqihao = str_pad($nowqihao,3,0,STR_PAD_LEFT);
			$actionNo = $total * $_day + intval($nowqihao) + 2017788;
			$nowdraws = [
				'expect'  => $actionNo,
				'start'   => date('Y-m-d',$nowtime).' '.$draws[intval($nowqihao)]['start'],
				'end'     => date('Y-m-d',$nowtime).' '.$draws[intval($nowqihao)]['end']
			];
			if(intval($nowqihao)==1){
				$preqihao = $actionNo-1;
				$nowexpecttime = strtotime($draws[$total]['end'])-86400;
				$predraws = [
					'expect' => $preqihao,
					'start'  => date('Y-m-d',$nowexpecttime).' '.$draws[intval($preqihao)]['start'],
					'end'    => date('Y-m-d',$nowexpecttime).' '.$draws[intval($preqihao)]['end'],
				];
			}else{
				$preqihao = $actionNo-1;
				$predraws = [
					'expect' => $preqihao,
					'start'  => date('Y-m-d',$nowtime).' '.$draws[intval($preqihao)]['start'],
					'end'    => date('Y-m-d',$nowtime).' '.$draws[intval($preqihao)]['end'],
				];
			}
		}
		$return = [
			'lastFullExpect'  => $predraws['expect'],
			'lastExpect'      => str_pad($nowqihao-1,3,0,STR_PAD_LEFT),
			'currFullExpect'  => $nowdraws['expect'],
			'currExpect'      => str_pad($nowqihao,3,0,STR_PAD_LEFT),
			'remainTime'      => abs(strtotime($nowdraws['end']))-time()-$cjnowtime,
			'openRemainTime'  => $cjnowtime,
		];
		return $return;
	}
}
?>