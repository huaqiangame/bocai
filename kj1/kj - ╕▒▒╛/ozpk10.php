<?php
$api = "http://api.52kc.cc/json?t=jisupk10&limit=1&token=AFDD0204B05723111B0751E240A1ACF8";
$data = file_get_contents($api);
$data = json_decode($data,1);
$qh = $data['data'][0]['expect'];
//$qh = str_split($qh);
//var_dump($qh);
//echo $qh1;
$hm = $data['data'][0]['opencode'];

$rq = $data['data'][0]['opentime'];
//$opentimestmp = strtotime($rq);
echo '{"sign":true,"message":"获取成功","data":[{"title":"急速赛车","name":"ozpk10","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';
?>