<?php
namespace Lib\lotterytimes;
class lhc {
	function drawtimes(){
        $url="https://1680660.com/smallSix/findSmallSixInfo.do";//获取当月开奖时间
        $co= _curl($url);
        $RES = json_decode($co,true);
		//var_dump($RES);exit;
        $lastFullExpect = $RES['result']['data']['preDrawIssue'];//上期
        $currFullExpect = $RES['result']['data']['drawIssue'];//下期
        $openRemainTime = $RES['result']['data']['drawTime'];//下期时间
        
		$name = 'lhc';
		$cjnowtime = cjnowtime($name);
		$nowtime = time() + $cjnowtime;

		$return = [
			'lastFullExpect'  => $lastFullExpect,
			'lastExpect'      => substr($lastFullExpect,-3),
			'currFullExpect'  => $currFullExpect,
			'currExpect'      => substr($currFullExpect,-3),
			'remainTime'      => strtotime($openRemainTime)-time()-$cjnowtime,
			'openRemainTime'  => $cjnowtime,
		];
		return $return;
	}
}
?>