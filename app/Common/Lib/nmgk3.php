<?php
$api = "http://www.ck-1001.com/lottery/?name=nmgks&format=xml&uid=195&token=8rngi0y7fscajwx524lz319hodme6vp&num=1";
$xml=file_get_contents(urldecode($api));
$xml=simplexml_load_string($xml);
$i = 0; 
$qh = $xml ->row[$i]->attributes()->expect;
$hm=$xml ->row[$i]->attributes()->opencode;
$rq=$xml ->row[$i]->attributes()->opentime;

//$opentimestmp = strtotime($rq);
echo '{"sign":true,"message":"获取成功","data":[{"title":"内蒙古快3","name":"nmgk3","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';
?>