<?php
$api = "http://118.89.40.191/api?p=json&t=xjp2fc&limit=5&token=8671d6d32dfb217d";
$data = file_get_contents($api);
$data = json_decode($data,1);
$qh = $data['data'][0]['expect'];
//$qh = str_split($qh);
//var_dump($qh);
//echo $qh1;
$hm = $data['data'][0]['opencode'];

$rq = $data['data'][0]['opentime'];
//$opentimestmp = strtotime($rq);
echo '{"sign":true,"message":"获取成功","data":[{"title":"新加坡2分彩","name":"xjp2fc","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';
?>