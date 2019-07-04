<?php


function getday($time){
	$time = $time?$time:time();
	 return date("Y-m-d H:i:s",$time);
}

function SendMailUser($to,$subject = '',$body = '',$FROM_NAME=''){

	$FROM_NAME = $FROM_NAME?$FROM_NAME:'幸运彩';
	error_reporting(E_STRICT);
	date_default_timezone_set('Asia/Shanghai');     //设定时区东八区
	import('Common.Class.PHPMailer');

	$mail = new \PHPMailer();
	$body = eregi_replace("[\]",'',$body);          //对邮件内容进行必要的过滤
	$mail->CharSet = "UTF-8";                       //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
	$mail->IsSMTP();                                // 设定使用SMTP服务
	$mail->SMTPDebug  = 0;                           // 启用SMTP调试功能
	// 1 = errors and messages
	// 2 = messages only
	$mail->SMTPAuth   = true;                        // 启用 SMTP 验证功能
//    $mail->SMTPSecure = "ssl";                     // 安全协议，可以注释掉
	$mail->Host       = GetVar('SMTP_HOST');         // SMTP 服务器
	$mail->Port       = GetVar('SMTP_PORT');         // SMTP服务器的端口号
	$mail->Username   = GetVar('SMTP_USER');         // SMTP服务器用户名
	$mail->Password   = GetVar('SMTP_PASS');         // SMTP服务器密码
	$mail->SetFrom(GetVar('FROM_EMAIL'), $FROM_NAME);

	$mail->AddReplyTo(GetVar('REPLY_EMAIL'),$FROM_NAME);
	$mail->Subject    = $subject;
	$mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; // optional, comment out and test
	$mail->MsgHTML($body);
	$address = $to;
	$mail->AddAddress($address, '');
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	if(!$mail->Send()) {
		return false;
	} else {
		return true;
	}
}
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
		'fontttf'     =>    '4.ttf'
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
function qrcode($url='',$pic=false,$level=3,$size=4){
	Vendor('phpqrcode.phpqrcode');
	$errorCorrectionLevel =intval($level) ;//容错级别 
	$matrixPointSize = intval($size);//生成图片大小 
	//生成二维码图片 
	//echo $_SERVER['REQUEST_URI'];
	$object = new \QRcode();
	$object->png($url, $pic, $errorCorrectionLevel, $matrixPointSize, 2);   
}
function AbstractType(){ 
	$array = array(
			'order'=>'代购',
			'cancel'=>'撤单',
			'reward'=>'返奖',
			//	'commission'=>'返点',
			//	'fenhong'=>'代理分红',
			'fanshui'=>'每日加奖',
			//'jinjishenhe'=>'晋级奖励',
			'yongjinshenhe'=>'代理返点',
			'xima'=>'洗码',
			'point'=>'积分',
			'activity_red'=>'活动奖励',
			/*'pointexchange'=>'积分兑换',*/
			'activity_bindcard'  => '绑定银行赠送活动',
			'activity_cz'  => '充值活动',
			'activity_czzs'  => '充值赠送活动',
			'activity_rxf' => '日消费赠送活动',
			'activity_rks' => '日亏损赠送活动',
			//'activity_yxf' => '月消费赠送活动',
			//'activity_yks' => '月亏损赠送活动',

			/*'transferPlatform'=>'平台转帐',*/
			'rollback'=>'后台撤单',
			/*'editcommission'=>'修正手续费',
            'editrecharge'=>'修正充值',
            'editwithdraw'=>'修正提款',
            'editactivity'=>'修正活动',*/
			/*		'downrecharge'=>'下级充值',
                    'uprecharge'=>'上级充值',*/
			'withdraw'=>'提款',
			'adminadd'=>'管理员加',
			'adminjian'=>'管理员减',
	);
	return $array;
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
