<?php

function url($url='',$vars='',$suffix=true,$domain=false){
	$domain = $domain?:$_SERVER['HTTP_HOST'];
	return U($url,$vars,$suffix,$domain);
}
function verify($w=150,$h=35,$s=17){
	$config =    array(
		'fontSize'    =>    $s,    // 验证码字体大小
		'length'      =>    4,     // 验证码位数
		'useNoise'    =>    false, // 关闭验证码杂点
		'imageW'      =>    $w,
		'imageH'      =>    $h,
		'fontttf'     =>    '5.ttf'
	);
	$Verify = new \Think\Verify($config);
	$Verify->codeSet = '123456789'; 
	$Verify->entry();
}
function check_verify($code, $id = ''){
	$config = array(
		'reset' => false,
	);
	$verify = new \Think\Verify($config);
	if(!$verify->check($code)) {
		return false;
	}else{
		return true;
	}
}
function IParea($ip=''){
	$ip = $ip?:get_client_ip();
	$_Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
	$area = $_Ip->getlocation($ip);
	return $area['country'];
}
function xCurl($url,$postData=array(),$outtime=5,$return=true,$cookiePath=null,$referer=null,$proxy=array(),$userAgent="Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)") {
        $ch = curl_init();
        $optionArray = array(
			CURLOPT_AUTOREFERER => true,
			CURLOPT_URL => $url,
			CURLOPT_HEADER => 0,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_CONNECTTIMEOUT => 3,//连接超时3s
			CURLOPT_TIMEOUT => $outtime,//执行超时12s
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false, //此处两个SSL相关参数是适应HTTPS网页
		);
        if(count($proxy) > 0){//网页代理设置，代理，大家都懂的，可以做很多事
            $optionArray[CURLOPT_HTTPPROXYTUNNEL] = true; //HTTP代理开关
            if(!empty($proxy['type']) && $proxy['type'] == 'socket'){
                $optionArray[CURLOPT_PROXYTYPE] = CURLPROXY_SOCKS5;//可以使用socket代理（×这里我没有测试socket代理）
            }
            $optionArray[CURLOPT_PROXY] = $proxy['url'];if (!empty($proxy['auth'])) {//代理验证
                $optionArray[CURLOPT_PROXYAUTH] = false;$optionArray[CURLOPT_PROXYUSERPWD] = $proxy['auth'];//格式  username:password
            }
            
        }
        if(!empty($referer)) {//HTTP头部的referer
            $optionArray[CURLOPT_REFERER] = $referer;
        }
        if(!empty($userAgent)) {//HTTP头部的UserAgent
            $optionArray[CURLOPT_USERAGENT] = $userAgent;
        }
        if (!empty($cookiePath)) {//Cookie的保存与传递（cookiePath是一个cookie文件，自定义即可）
            $optionArray[CURLOPT_COOKIEFILE] = $cookiePath;//传递cookie
            $optionArray[CURLOPT_COOKIEJAR]  = $cookiePath;//保存cookie
        }
        if(count($postData) > 0){//post传值
            $optionArray[CURLOPT_POST] = 1;
            $optionArray[CURLOPT_POSTFIELDS] = $postData;   
        }
        curl_setopt_array($ch, $optionArray);
        $content = curl_exec($ch);
        if(!curl_errno($ch)){
            $output = curl_getinfo($ch);
        }
        curl_close($ch);
        if($return) {
            $output['content'] = $content;
            return $content;
        } else {
            echo $content;
        }
    }
