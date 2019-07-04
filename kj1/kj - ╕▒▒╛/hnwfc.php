<?php
$api = "http://api.52kc.cc/json?t=hn5fc&limit=1&token=AFDD0204B05723111B0751E240A1ACF8";
$data = file_get_contents($api);
$data = json_decode($data,1);
$qh1 = $data['data'][0]['expect'];
//$qh = str_split($qh);
$qh = $qh1[4].$qh1[5].$qh1[6].$qh1[7].$qh1[8].$qh1[9].$qh1[10];
$hm = $data['data'][0]['opencode'];

$rq = $data['data'][0]['opentime'];
//$opentimestmp = strtotime($rq);
echo '{"sign":true,"message":"获取成功","data":[{"title":"河内5分彩","name":"hnwfc","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';
?>