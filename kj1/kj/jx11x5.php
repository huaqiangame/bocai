<?php
//$api = "http://api.api68.com/ElevenFive/getElevenFiveInfo.do?issue=&lotCode=10015";
//$data = file_get_contents($api);
//$data = json_decode($data,1);
//$qh = $data['result']['data']['preDrawIssue'];
//$hm = $data['result']['data']['preDrawCode'];
//
//$rq = $data['result']['data']['preDrawTime'];
////$opentimestmp = strtotime($rq);
//echo '{"sign":true,"message":"获取成功","data":[{"title":"江西11选5","name":"jx11x5","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';

require_once 'apikj.php';
$data = apikj('jxsyxw');
$data = $data['result']['data']['0'];

echo '{"sign":true,"message":"获取成功","data":[{"title":"江西11选5","name":"jx11x5","expect":"'.$data['gid'].'","opencode":"'.$data['award'].'","opentime":"'.$data['time'].'","source":"开彩采集","sourcecode":""}]}';

?>
