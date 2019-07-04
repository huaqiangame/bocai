<?php
$api = "http://api.52kc.cc/json?t=nmgk3&limit=1&token=11991E1855C0F00982E9CE2AA82E39C4";
$xml=file_get_contents(urldecode($api));
$xml=simplexml_load_string($xml);
$i = 0; 
$qh = $xml ->row[$i]->attributes()->expect;
$hm=$xml ->row[$i]->attributes()->opencode;
$rq=$xml ->row[$i]->attributes()->opentime;

//$opentimestmp = strtotime($rq);
echo '{"sign":true,"message":"获取成功","data":[{"title":"内蒙古快3","name":"nmgk3","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';
?>