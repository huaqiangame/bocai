<?php
//$api = "http://api.52kc.cc/json?t=cqssc&limit=1&token=AFDD0204B05723111B0751E240A1ACF8";
//$data = file_get_contents($api);
//$data = json_decode($data,1);
//$qh1 = $data['data'][0]['expect'];
////$qh = str_split($qh);
//$qh = $qh1[4].$qh1[5].$qh1[6].$qh1[7].$qh1[8].$qh1[9].$qh1[10];
////var_dump($qh);
////echo $qh1;
//$hm = $data['data'][0]['opencode'];
//
//$rq = $data['data'][0]['opentime'];
////$opentimestmp = strtotime($rq);
////echo '{"sign":true,"message":"获取成功","data":[{"title":"北京PK10","name":"bjpk10","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';
//
//echo '{"sign":true,"message":"获取成功","data":[{"title":"重庆时时彩","name":"cqssc","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';
//echo '{"rows":10,"code":"cqssc","data":[{"id":"310055","type":"3","opentimestamp":"'.$opentimestmp.'","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'"}]}';
//echo '{"rows":10,"code":"cqssc","data":[{"id":"310055","type":"3","opentimestamp":"1520598055","expect":"20180309086","opencode":"5,5,9,7,1","opentime":"2018-03-09 20:20:55"},';
require_once 'apikj.php';
$data = apikj('ssc');
$data = $data['result']['data']['0'];
$data['gid'] = substr($data['gid'],'4','8'); 
echo '{"sign":true,"message":"获取成功","data":[{"title":"重庆时时彩","name":"cqssc","expect":"'.$data['gid'].'","opencode":"'.$data['award'].'","opentime":"'.$data['time'].'","source":"开彩采集","sourcecode":""}]}';

?>