<?php
$api = "http://api.52kc.cc/json?t=hk6&limit=1&token=AFDD0204B05723111B0751E240A1ACF8";
$data = file_get_contents($api);
$data = json_decode($data,1);
$qh = $data['data'][0]['expect'];
//$qh = str_split($qh);
//$qh1 = $qh[0].$qh[1].$qh[2].$qh[3].$qh[4].$qh[5].$qh[6].$qh[7].'0'.$qh[8].$qh[9];
//var_dump($qh);
//echo $qh1;
$hm = $data['data'][0]['opencode'];

$rq = $data['data'][0]['opentime'];
//$opentimestmp = strtotime($rq);
echo '{"sign":true,"message":"获取成功","data":[{"title":"香港六合彩","name":"tjssc","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';
?>