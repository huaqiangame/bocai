<?php
namespace Lib\lotterytimes;
class cqssc {
	function drawtimes(){
		$name = 'cqssc';
		$cjnowtime = 0;
		$nowtime = time() + $cjnowtime;
		$total  = 59;
		$openstart  = '0:30:00';
		$jgtime = 1200;
		$yctime = 0;
		$_yct = ceil($yctime/$total);
		/*		$array = array();
                for($i=1;$i<=$total;$i++){
                    $start = strtotime($openstart)-$jgtime + ($i-1)*$jgtime + ($i-1)*$_yct;
                    $end = strtotime($openstart)+($i-1)*$jgtime + ($_yct*$i);
                    $draws[$i] = array('start'=>date('H:i:s',$start),'end'=>date('H:i:s',$end));
                }
                $draws[1]['start'] = date('Y-m-d H:i:s',strtotime($draws[$total]['end'])-86400);*/
		$draws = array(
			'1'=>array('start'=>'00:10:00','end'=>'00:30:00'),
			'2'=>array('start'=>'00:30:00','end'=>'00:50:00'),
			'3'=>array('start'=>'00:50:00','end'=>'01:10:00'),
			'4'=>array('start'=>'01:10:00','end'=>'01:30:00'),
			'5'=>array('start'=>'01:30:00','end'=>'01:50:00'),
			'6'=>array('start'=>'01:50:00','end'=>'02:10:00'),
			'7'=>array('start'=>'02:10:00','end'=>'02:30:00'),
			'8'=>array('start'=>'02:30:00','end'=>'02:50:00'),
			'9'=>array('start'=>'02:50:00','end'=>'03:10:00'),
			'10'=>array('start'=>'03:10:00','end'=>'07:30:00'),
			'11'=>array('start'=>'07:30:00','end'=>'07:50:00'),
			'12'=>array('start'=>'07:50:00','end'=>'08:10:00'),
			'13'=>array('start'=>'08:10:00','end'=>'08:30:00'),
			'14'=>array('start'=>'08:30:00','end'=>'08:50:00'),
			'15'=>array('start'=>'08:50:00','end'=>'09:10:00'),
			'16'=>array('start'=>'09:10:00','end'=>'09:30:00'),
			'17'=>array('start'=>'09:30:00','end'=>'09:50:00'),
			'18'=>array('start'=>'09:50:00','end'=>'10:10:00'),
			'19'=>array('start'=>'10:10:00','end'=>'10:30:00'),
			'20'=>array('start'=>'10:30:00','end'=>'10:50:00'),
			'21'=>array('start'=>'10:50:00','end'=>'11:10:00'),
			'22'=>array('start'=>'11:10:00','end'=>'11:30:00'),
			'23'=>array('start'=>'11:30:00','end'=>'11:50:00'),
			'24'=>array('start'=>'11:50:00','end'=>'12:10:00'),
			'25'=>array('start'=>'12:10:00','end'=>'12:30:00'),
			'26'=>array('start'=>'12:30:00','end'=>'12:50:00'),
			'27'=>array('start'=>'12:50:00','end'=>'13:10:00'),
			'28'=>array('start'=>'13:10:00','end'=>'13:30:00'),
			'29'=>array('start'=>'13:30:00','end'=>'13:50:00'),
			'30'=>array('start'=>'13:50:00','end'=>'14:10:00'),
			'31'=>array('start'=>'14:10:00','end'=>'14:30:00'),
			'32'=>array('start'=>'14:30:00','end'=>'14:50:00'),
			'33'=>array('start'=>'14:50:00','end'=>'15:10:00'),
			'34'=>array('start'=>'15:10:00','end'=>'15:30:00'),
			'35'=>array('start'=>'15:30:00','end'=>'15:50:00'),
			'36'=>array('start'=>'15:50:00','end'=>'16:10:00'),
			'37'=>array('start'=>'16:10:00','end'=>'16:30:00'),
			'38'=>array('start'=>'16:30:00','end'=>'16:50:00'),
			'39'=>array('start'=>'16:50:00','end'=>'17:10:00'),
			'40'=>array('start'=>'17:10:00','end'=>'17:30:00'),
			'41'=>array('start'=>'17:30:00','end'=>'17:50:00'),
			'42'=>array('start'=>'17:50:00','end'=>'18:10:00'),
			'43'=>array('start'=>'18:10:00','end'=>'18:30:00'),
			'44'=>array('start'=>'18:30:00','end'=>'18:50:00'),
			'45'=>array('start'=>'18:50:00','end'=>'19:10:00'),
			'46'=>array('start'=>'19:10:00','end'=>'19:30:00'),
			'47'=>array('start'=>'19:30:00','end'=>'19:50:00'),
			'48'=>array('start'=>'19:50:00','end'=>'20:10:00'),
			'49'=>array('start'=>'20:10:00','end'=>'20:30:00'),
			'50'=>array('start'=>'20:30:00','end'=>'20:50:00'),
			'51'=>array('start'=>'20:50:00','end'=>'21:10:00'),
			'52'=>array('start'=>'21:10:00','end'=>'21:30:00'),
			'53'=>array('start'=>'21:30:00','end'=>'21:50:00'),
			'54'=>array('start'=>'21:50:00','end'=>'22:10:00'),
			'55'=>array('start'=>'22:10:00','end'=>'22:30:00'),
			'56'=>array('start'=>'22:30:00','end'=>'22:50:00'),
			'57'=>array('start'=>'22:50:00','end'=>'23:10:00'),
			'58'=>array('start'=>'23:10:00','end'=>'23:30:00'),
			'59'=>array('start'=>'23:30:00','end'=>'23:50:00'),
			//'60'=>array('start'=>'23:50:00','end'=>'00:10:00'),
		
		);
		ksort($draws);
		foreach($draws as $k=>$v){
			if($nowtime>strtotime($v['start']) && $nowtime<=strtotime($v['end'])){
				$nowqihao = str_pad($k,3,0,STR_PAD_LEFT);
				break;
			}
		}

		if(!$nowqihao){
			$nowqihao = str_pad(1,3,0,STR_PAD_LEFT);
			$draws[1]['start']   = date('Y-m-d H:i:s',strtotime($draws[$total]['end']));
			$draws[1]['end']   = date('Y-m-d H:i:s',strtotime($draws[1]['end'])+86400);
			$nowdraws = [
				'expect'  => date('md',strtotime($draws[1]['end'])).$nowqihao,
				'start'   => $draws[1]['start'],
				'end'     => $draws[1]['end']
			];
			$preqihao = str_pad($total,3,0,STR_PAD_LEFT);
			$predraws = [
				'expect' => date('md',strtotime($draws[1]['start'])).$preqihao,
				'start'  => date('Y-m-d H:i:s',strtotime($draws[$total]['start'])),
				'end'    => date('Y-m-d H:i:s',strtotime($draws[$total]['end'])),
			];
		}else{
			$nowqihao = str_pad($nowqihao,3,0,STR_PAD_LEFT);
			$nowdraws = [
				'expect'  => date('md',$nowtime).$nowqihao,
				'start'   => date('Y-m-d',$nowtime).' '.$draws[intval($nowqihao)]['start'],
				'end'     => date('Y-m-d',$nowtime).' '.$draws[intval($nowqihao)]['end']
			];
			if(intval($nowqihao)==1){
				$preqihao = str_pad($total,3,0,STR_PAD_LEFT);
				$nowexpecttime = strtotime($draws[$total]['end'])-86400;
				$predraws = [
					'expect' => date('md',$nowexpecttime).$preqihao,
					'start'  => date('Y-m-d',$nowexpecttime).' '.$draws[intval($preqihao)]['start'],
					'end'    => date('Y-m-d',$nowexpecttime).' '.$draws[intval($preqihao)]['end'],
				];
			}else{
				$preqihao = str_pad($nowqihao-1,3,0,STR_PAD_LEFT);;
				$predraws = [
					'expect' => date('md',$nowtime).$preqihao,
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