<?php
//$api = "http://api.52kc.cc/json?t=jlk3&limit=1&token=AFDD0204B05723111B0751E240A1ACF8";
////$xml=file_get_contents(urldecode($api));
////$xml=simplexml_load_string($xml);
////$i = 0; 
////$qh = $xml ->row[$i]->attributes()->expect;
////$hm=$xml ->row[$i]->attributes()->opencode;
////$rq=$xml ->row[$i]->attributes()->opentime;
//$data = file_get_contents($api);
//$data = json_decode($data,1);
////var_dump($data);
//$qh = '2'.'0'.$data["data"][0]["expect"];
//$hm = $data["data"][0]["opencode"];
//$rq = $data["data"][0]["opentime"];
////$opentimestmp = strtotime($rq);
//echo '{"sign":true,"message":"获取成功","data":[{"title":"吉林快3","name":"jlk3","expect":"'.$qh.'","opencode":"'.$hm.'","opentime":"'.$rq.'","source":"开彩采集","sourcecode":""}]}';

require_once 'apikj.php';
$data = apikj('jlk3');
$data = $data['result']['data']['0'];

echo '{"sign":true,"message":"获取成功","data":[{"title":"吉林快3","name":"jlk3","expect":"'.$data['gid'].'","opencode":"'.$data['award'].'","opentime":"'.$data['time'].'","source":"开彩采集","sourcecode":""}]}';
?>