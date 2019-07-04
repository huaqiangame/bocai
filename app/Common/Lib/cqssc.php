<?php
$api = "http://api.api68.com/CQShiCai/getBaseCQShiCai.do?issue=&lotCode=10002";
$data = file_get_contents($api);
$data = json_decode($data,1);
$qh = $data['result']['data']['preDrawIssue'];
//$qh = str_split($qh);
//$qh1 = $qh[0].$qh[1].$qh[2].$qh[3].$qh[4].$qh[5].$qh[6].$qh[7].'0'.$qh[8].$qh[9];
//var_dump($qh);
//echo $qh1;
$hm = $data['result']['data']['preDrawCode'];

$rq = $data['result']['data']['preDrawTime'];
//$opentimestmp = strtotime($rq);
//echo '{"sign":true,"message":"获取成功","data":[{"title":"北京PK10","name":"bjpk10","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';

echo '{"sign":true,"message":"获取成功","data":[{"title":"重庆时时彩","name":"cqssc","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';
//echo '{"rows":10,"code":"cqssc","data":[{"id":"310055","type":"3","opentimestamp":"'.$opentimestmp.'","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'"}]}';
//echo '{"rows":10,"code":"cqssc","data":[{"id":"310055","type":"3","opentimestamp":"1520598055","expect":"20180309086","opencode":"5,5,9,7,1","opentime":"2018-03-09 20:20:55"},';
?>