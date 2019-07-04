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
function CURL($url, $params, $method = 'GET',$outtime=1, $header = array(), $multi = false){
	/* 根据请求类型设置特定参数 */
	switch(strtoupper($method)){
		case 'GET':
			$url = $url . '?' . http_build_query($params);
			$opts = array(   
			  'http'=>array(   
				'method'=>"GET",   
				'timeout'=>$outtime?$outtime:3,//单位秒  
			   )   
			); 
			$bb=file_get_contents($url, false, stream_context_create($opts)); 
			return $bb;  
			break;
		case 'SNOOPY':
			//import('Common.Lib.Snoopy');
			$snoopy=new \Lib\Snoopy();
			$snoopy->agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)"; //伪装浏览器
			if(is_array($params))$url = $url . '?' . http_build_query($params);
			$parse_url = parse_url($url);
			$host = $parse_url['scheme'].'://'.$parse_url['host'].'/';
			$snoopy->referer = $host;
			$snoopy->timed_out = $outtime?$outtime:3;
			$snoopy->rawheaders["COOKIE"]='hiurvetiurviu585tervetuhiyrt'; //伪装sessionid 
			$snoopy->rawheaders["Pragma"] = "no-cache"; //cache 的http头信息   
			$snoopy->rawheaders["X_FORWARDED_FOR"] = "211.156.193.130"; //伪装ip//打印查看
			$snoopy->fetch($url);  
			$results = $snoopy->results;//获得响应结果
			return $results;
			break;
		case 'POST':
			$data = xCurl($url,$params,$outtime?$outtime:3);
			return $data;
			break;
	}
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
            $optionArray[CURLOPT_COOKIEJAR] = $cookiePath;//保存cookie
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
//随机IP
function Rand_IP(){

    $ip1id= round(rand(100000, 2550000) / 10000); //第一种方法，直接生成
    $ip2id= round(rand(600000, 2550000) / 10000); //第一种方法，直接生成
    $ip3id= round(rand(600000, 2550000) / 10000);
    $ip4id= round(rand(600000, 2550000) / 10000);
    //下面是第二种方法，在以下数据中随机抽取
    $arr_1 = array("218","218","66","66","218","218","60","60","202","204","66","66","66","59","61","60","222","221","66","59","60","60","66","218","218","62","63","64","66","66","122","211");
    $randarr= mt_rand(0,count($arr_1)-1);
    //$ip1id = $arr_1[$randarr];
    return $ip1id.".".$ip2id.".".$ip3id.".".$ip4id;
}

//抓取页面内容
function Curl1($url){
        $ch2 = curl_init();
        $user_agent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36";//模拟windows用户正常访问
        curl_setopt($ch2, CURLOPT_URL, $url);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:'.Rand_IP(), 'CLIENT-IP:'.Rand_IP()));
//追踪返回302状态码，继续抓取
        curl_setopt($ch2, CURLOPT_HEADER, true); 
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch2, CURLOPT_NOBODY, false);
        curl_setopt($ch2, CURLOPT_REFERER, 'http://www.baidu.com/');//模拟来路
        curl_setopt($ch2, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);    //SSL 报错时使用
    curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);    //SSL 报错时使用
        $temp = curl_exec($ch2);
        curl_close($ch2);
        return $temp;
}