<?php
//$api = "http://www.ck-1001.com/lottery/?name=gsks&format=xml&uid=195&token=ow1tf3gd25hqjmv7iu8alpe4ys6czr0&num=1";
//$xml=file_get_contents(urldecode($api));
//$xml=simplexml_load_string($xml);
//$i = 0; 
//$qh = $xml ->row[$i]->attributes()->expect;
//$hm=$xml ->row[$i]->attributes()->opencode;
//$rq=$xml ->row[$i]->attributes()->opentime;
//
////$opentimestmp = strtotime($rq);
//echo '{"sign":true,"message":"获取成功","data":[{"title":"甘肃快3","name":"gsk3","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';

require_once 'apikj.php';
$data = apikj('gsk3');
$data = $data['result']['data']['0'];

echo '{"sign":true,"message":"获取成功","data":[{"title":"甘肃快3","name":"gsk3","expect":"'.$data['gid'].'","opencode":"'.$data['award'].'","opentime":"'.$data['time'].'","source":"开彩采集","sourcecode":""}]}';
?>