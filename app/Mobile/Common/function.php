<?php
//更改会员等级
function changeusergroup($uid){
	$member = M('member');
	$user = $member->where("id='{$uid}' AND groupid <> '10' AND groupid <> '11'")->field('id,point')->find();
	if($user){
		$membergroup = M('membergroup')->where('isagent<>1')->cache(600)->field('groupid,shengjiedu')->order('groupid ASC')->select();//查找会员组
		if($user['point'] <= $membergroup[0]["shengjiedu"])$user['groupid']=1;  //比较会员积分确认会员组别
		for($i=1;$i<count($membergroup);$i++){
			if($membergroup[$i]["shengjiedu"]<=$user['point'] && $user['point'] < $membergroup[$i+1]["shengjiedu"]){
				$user['groupid']=$i+1;
			}
		}
		if($user['point'] >= $membergroup[8]["shengjiedu"])$user['groupid']=9;
		$_data['groupid'] = $user['groupid'];
		$member->where("id='{$user['id']}'")->setField(array('groupid'=>$_data['groupid']));
	}
}
function filter_money($money,$accuracy=2)
{
	$str_ret = 0;
	if (empty($money) === false) {
		$str_ret = sprintf("%.".$accuracy."f", substr(sprintf("%.".($accuracy+1)."f", floatval($money)), 0, -1));
	}

	return floatval($str_ret);
}
function getIpAddress($ip){
	// $ipContent  = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=".$ip);
	// $jsonData = explode("=",$ipContent);
	// $jsonAddress = substr($jsonData[1], 0, -1);
	// return $jsonAddress;
	$url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
    $ip=json_decode(file_get_contents($url));   
        if((string)$ip->code=='1'){
           return false;
        }
        $data = (array)$ip->data;
	return json_encode($data);
}
//分页初始化
function startPage($page){
	//设置分页参数
	$page->setConfig('first','首　页');
	$page->setConfig('prev','上一页');
	$page->setConfig('next','下一页');
	$page->setConfig('last','末　页');
	$page->setConfig('theme', '<span class="pagerows">%HEADER%</span>  <span  class="pagecount">%TOTAL_PAGE%页</span>
%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
}
function clientIP(){   
	$cIP = getenv('REMOTE_ADDR');   
	$cIP1 = getenv('HTTP_X_FORWARDED_FOR');   
	$cIP2 = getenv('HTTP_CLIENT_IP');   
	$cIP1 ? $cIP = $cIP1 : null;   
	$cIP2 ? $cIP = $cIP2 : null;   
	return $cIP;   
}
function object_to_array($obj){
	$_arr = is_object($obj)? get_object_vars($obj) :$obj;
	foreach ($_arr as $key => $val){
		$val=(is_array($val)) || is_object($val) ? object_to_array($val) :$val;
		$arr[$key] = $val;
	}
	return $arr;
}
function serverIP(){   
	return gethostbyname($_SERVER["SERVER_NAME"]);   
}
function rand_strings($len=6,$type=0,$addChars='') {
	$String      = new \Org\Util\String();
	$randString  = $String->randStrings($len,$type,$addChars);
	return $randString;
}
    
function islogin(){
	$sessionid = session('member_sessionid');
	$auth_id   = session('member_auth_id');
	if(!$sessionid || !$auth_id){
		return ['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]];
	}
	$apiparam['auth'] = array(
		'member_auth_id'   => $auth_id,
		'member_sessionid' => $sessionid,
	);
	$_api = new \Lib\api;
	$Result = $_api->sendHttpClient('Api/Member/checkislogin',$apiparam);
	if($Result['sign']==true && $Result['data']['islogin']==1 && $Result['data']['islock']!=1){
		session('userinfo',$Result['data']);
	}else{
		session('userinfo',NULL);
	}
	unset($Result['data']['banklist']);unset($Result['data']['question']);
	return $Result;
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