<?php
//$api = "http://api.52kc.cc/json?t=txffc&limit=1&token=AFDD0204B05723111B0751E240A1ACF8";
//$data = file_get_contents($api);
//$data = json_decode($data,1);
//$qh1 = $data['data'][0]['expect'];
////$qh = str_split($qh);
//$qh = $qh1[4].$qh1[5].$qh1[6].$qh1[7].$qh1[8].$qh1[9].$qh1[10].$qh1[11];
//$hm = $data['data'][0]['opencode'];
//
//$rq = $data['data'][0]['opentime'];
////$opentimestmp = strtotime($rq);
//echo '{"sign":true,"message":"获取成功","data":[{"title":"腾讯分分彩","name":"txssc","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';

require_once 'apikj.php';
$data = apikj('txffc');
$data = $data['result']['data']['0'];

echo '{"sign":true,"message":"获取成功","data":[{"title":"腾讯分分彩","txssc":"txssc","expect":"'.$data['gid'].'","opencode":"'.$data['award'].'","opentime":"'.$data['time'].'","source":"开彩采集","sourcecode":""}]}';
?>