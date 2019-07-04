<?php
$api = "http://api.api68.com/CQShiCai/getBaseCQShiCai.do?issue=&lotCode=10004";
$data = file_get_contents($api);
$data = json_decode($data,1);
$qh = $data['result']['data']['preDrawIssue'];
$qh = str_split($qh);
$qh1 = $qh[0].$qh[1].$qh[2].$qh[3].$qh[4].$qh[5].$qh[6].$qh[7].'0'.$qh[8].$qh[9];
//var_dump($qh);
//echo $qh1;
$hm = $data['result']['data']['preDrawCode'];

$rq = $data['result']['data']['preDrawTime'];
//$opentimestmp = strtotime($rq);
echo '{"sign":true,"message":"获取成功","data":[{"title":"新疆时时彩","name":"xjssc","expect":"'.$qh1.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';
?>