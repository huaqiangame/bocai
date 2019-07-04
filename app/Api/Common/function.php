<?php
function cheacktoken($apiparam=array(),$apitoten=''){
	$weballowips = explode(',',GetVar('weballowips'));
	if(!$apiparam['server_ip']){
		return ['sign'=>false,'message'=>'服务器未授权'];exit;
	}
	if(!is_array($weballowips)){
		return ['sign'=>false,'message'=>'服务器未授权'];exit;
	}
	if(!in_array($apiparam['server_ip'],$weballowips)){
		return ['sign'=>false,'message'=>'服务器未授权'];exit;
	}
	$apiparam['sign'] = true;
	$apiparam['message'] = '请求成功';
	if($apiparam['apitoten'] != $apitoten || strlen($apiparam['apitoten'])!=32){
		$apiparam['sign'] = false;
		$apiparam['message'] = '授权验证失败1';
	}
	unset($apiparam['apitoten']);
	unset($apiparam['server_ip']);
	return $apiparam;
}
//function checklogin($apiparam = array()){
//	$member_auth_id   = $apiparam['auth']['member_auth_id'];
//	$member_sessionid = $apiparam['auth']['member_sessionid'];
//	if(!$member_auth_id || !$member_sessionid){
//		$apiparam['sign']    = false;
//		$apiparam['message'] = '缺少验证参数';
//		return $apiparam;
//	}
//	if(!is_numeric($member_auth_id)){
//		$apiparam['sign'] = false;
//		$apiparam['message'] = 'user_id必须是数字';
//		return $apiparam;
//	}
//	if(strlen($member_sessionid)!=32){
//		$apiparam['sign'] = false;
//		$apiparam['message'] = 'sessionid长度错误';
//		return $apiparam;
//	}
//	$userinfo = M('member')->where(['id'=>$member_auth_id])->find();
//	if(!$userinfo){
//		$apiparam['sign'] = false;
//		$apiparam['message'] = '会员不存在';
//		return $apiparam;
//	}
//	/*if($userinfo['islock']==1){
//		$apiparam['sign'] = false;
//		$apiparam['message'] = '该会员账户已被冻结';
//		return $apiparam;
//	}*/
//	$sessioninfo = M('membersession')->where(['userid'=>$member_auth_id])->find();
//	if(!$sessioninfo){
//		$apiparam['sign'] = false;
//		$apiparam['message'] = '会员未登陆';
//		return $apiparam;
//	}
//	
//	//到此
//	$userinfo['islogin'] = 1;
//	if($member_sessionid!=$sessioninfo['sessionid']){//别的地方登陆
//		$apiparam['sign'] = false;
//		$apiparam['data']['islogin'] = -1;
//		$apiparam['message'] = '您的账号在别的地方登陆,如果不是您本人操作请立即修改密码';
//		return $apiparam;
//	}
//	
//	//设置登陆超时时间
//	$outtime = C('sessiontime');
//	$outtime = $outtime?$outtime:10*60;
//	
//	if($outtime && NOW_TIME-$sessioninfo['time']>$outtime){
//		$apiparam['data']['islogin'] = -2;
//		$apiparam['data']['logintime'] = date('Y-m-d H:i:s',$sessioninfo['time']);
//		$apiparam['data']['loginouttime'] = date('Y-m-d H:i:s',$sessioninfo['time']+$outtime);
//		$apiparam['message'] = '登陆超时';
//		return $apiparam;
//	}
//	//更新session时间
//	$_t = time();
//	$sessionint = M('membersession')->where(['userid'=>$userinfo['id']])->setField(['time'=>$_t]);
//	$onlineint  = M('member')->where(['id'=>$userinfo['id']])->setField(['onlinetime'=>$_t]);
//	
//	if($userinfo['proxy']==1){
//		$userinfo['groupname'] = '代理';
//	}else{
//		if($userinfo['groupid']){
//			$userinfo['groupname'] = M('membergroup')->where(['groupid'=>$userinfo['groupid']])->getField('groupname');
//		}else{
//			$userinfo['groupname'] = '普通会员';
//		}
//	}
//	$apiparam['data'] = $userinfo;
//	
//	//绑定的银行
//	$banklist = M('banklist')->where(['uid'=>$userinfo['id'],'state'=>1])->select();
//	$apiparam['data']['banklist'] = $banklist?$banklist:false;
//	
//	//密保
//	$question = M('question')->where(['uid'=>$userinfo['id']])->find();
//	$apiparam['data']['question'] = $question?$question:false;
//	return $apiparam;
//}
/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
function safe_replace($string) {
	$string = str_replace('%20','',$string);
	$string = str_replace('%27','',$string);
	$string = str_replace('%2527','',$string);
	$string = str_replace('*','',$string);
	$string = str_replace('"','&quot;',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace('"','',$string);
	$string = str_replace(';','',$string);
	$string = str_replace('<','&lt;',$string);
	$string = str_replace('>','&gt;',$string);
	$string = str_replace("{",'',$string);
	$string = str_replace('}','',$string);
	$string = str_replace('\\','',$string);
	return $string;
}

/**
 * xss过滤函数
 *
 * @param $string
 * @return string
 */
function remove_xss($string) { 
    $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

    $parm1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');

    $parm2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

    $parm = array_merge($parm1, $parm2); 

	for ($i = 0; $i < sizeof($parm); $i++) { 
		$pattern = '/'; 
		for ($j = 0; $j < strlen($parm[$i]); $j++) { 
			if ($j > 0) { 
				$pattern .= '('; 
				$pattern .= '(&#[x|X]0([9][a][b]);?)?'; 
				$pattern .= '|(&#0([9][10][13]);?)?'; 
				$pattern .= ')?'; 
			}
			$pattern .= $parm[$i][$j]; 
		}
		$pattern .= '/i';
		$string = preg_replace($pattern, ' ', $string); 
	}
	return $string;
}

/**
   * 加密
   * @param  string $str 待加密的字符串
   * @param  string $key 密码
   * @return string
   */
   function encode($str, $key) {
    $key = substr($key, 0, 8);
    $iv = $key;
    $size = mcrypt_get_block_size ( MCRYPT_DES, MCRYPT_MODE_ECB );
    $str = pkcs5Pad ( $str, $size );
    $s = mcrypt_encrypt(MCRYPT_DES,$key,$str,MCRYPT_MODE_ECB,$iv);
    return base64_encode($s);
  }
   
  /**
   * 解密
   * @param  string $str 待解密的字符串
   * @param  string $key 密码
   * @return string
   */
   function decode($str, $key) {
    $iv = $key;
    $str = base64_decode($str);
    $str = mcrypt_decrypt( MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB, $iv );
    $str = pkcs5Unpad( $str );
    return $str;
  }
   
   function pkcs5Pad($text, $blocksize) {
    $pad = $blocksize - (strlen ( $text ) % $blocksize);
    return $text . str_repeat ( chr ( $pad ), $pad );
  }
   
   function pkcs5Unpad($text) {
    $pad = ord ( $text {strlen ( $text ) - 1} );
    if ($pad > strlen ( $text ))
    return false;
    if (strspn ( $text, chr ( $pad ), strlen ( $text ) - $pad ) != $pad)
    return false;
    return substr ( $text, 0, - 1 * $pad );
  }

