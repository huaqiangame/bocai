<?php
function str_replace_cn($str, $start, $length ){
	if(preg_match("/[\x7f-\xff]/", $str)){
		if(is_utf8($str)){

			return substr_replace($str,'**',$start*3, $length*3);
		}else{
			return substr_replace($str,'**',$start*2, $length*2);
		}
	}else{
		return substr_replace($str,'**',$start, $length);
	}
}
function is_utf8($word){
	if(preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$word) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$word) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$word) == true) {
		return true;
	}else {
		return false;
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
		if($user['point'] >= $membergroup[8]["shengjiedu"]){
		    $user['groupid']=9;
        }
		$_data['groupid'] = $user['groupid'];
		$member->where("id='{$user['id']}'")->setField(array('groupid'=>$_data['groupid']));
	}
}
function getIpAddress($ip){
	
	//$ipContent  = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=".$ip);
	//$jsonData = explode("=",$ipContent);
	//$jsonAddress = substr($jsonData[1], 0, -1);

    $url ='http://api.map.baidu.com/location/ip?ip='.$ip.'&ak=upEh4qoSFKGAVQ7hTEhQx8nu&coor=bd09ll';
	//$url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
	$ip = json_decode(xCurl($url,array(),1));
    //$ip=json_decode(file_get_contents($url));
        if((string)$ip->status=='1'){
           return false;
        }
        $data = (array)$ip->content;
	return json_encode($data);
}
function clientIP(){   
	$cIP = getenv('REMOTE_ADDR');   
	$cIP1 = getenv('HTTP_X_FORWARDED_FOR');   
	$cIP2 = getenv('HTTP_CLIENT_IP');   
	$cIP1 ? $cIP = $cIP1 : null;   
	$cIP2 ? $cIP = $cIP2 : null;   
	return $cIP;   
}   
function serverIP(){   
	return gethostbyname($_SERVER["SERVER_NAME"]);   
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
function object_to_array($obj){
	$_arr = is_object($obj)? get_object_vars($obj) :$obj;
	foreach ($_arr as $key => $val){
		$val=(is_array($val)) || is_object($val) ? object_to_array($val) :$val;
		$arr[$key] = $val;
	}
	return $arr;
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
/*function rand_string($len=6,$type=0,$addChars='') {
	$String      = new \Org\Util\String;
	$randString  = $String->randString($len,$type,$addChars);
	return $randString;
}*/
function rand_strings($len=6,$type=0,$addChars='') {
	$String      = new \Org\Util\String();
	$randString  = $String->randStrings($len,$type,$addChars);
	return $randString;
}
//码支付加密函数
function create_link($params, $codepay_key, $host = "")
{
    ksort($params); //重新排序$data数组
    reset($params); //内部指针指向数组中的第一个元素
    $sign = '';
    $urls = '';
    foreach ($params AS $key => $val) {
        if ($val == '') continue;
        if ($key != 'sign') {
            if ($sign != '') {
                $sign .= "&";
                $urls .= "&";
            }
            $sign .= "$key=$val"; //拼接为url参数形式
            $urls .= "$key=" . urlencode($val); //拼接为url参数形式
        }
    }

    $key = md5($sign . $codepay_key);//开始加密
    $query = $urls . '&sign=' . $key; //创建订单所需的参数
    $apiHost = ($host ? $host : "http://api2.fateqq.com:52888/creat_order/?"); //网关
    $url = $apiHost . $query; //生成的地址
    return array("url" => $url, "query" => $query, "sign" => $sign, "param" => $urls);
}
function logs($data){
    $log_file = './'.date('Ymd',time()).'_all.log';
    $content =var_export($data,TRUE);
    $content .= "\r\n\n";
    file_put_contents($log_file,$content, FILE_APPEND);
}
//主动判断是否HTTPS
function isHTTPS()
{
    if (defined('HTTPS') && HTTPS) return true;
    if (!isset($_SERVER)) return FALSE;
    if (!isset($_SERVER['HTTPS'])) return FALSE;
    if ($_SERVER['HTTPS'] === 1) {  //Apache
        return TRUE;
    } elseif ($_SERVER['HTTPS'] === 'on') { //IIS
        return TRUE;
    } elseif ($_SERVER['SERVER_PORT'] == 443) { //其他
        return TRUE;
    }
    return FALSE;
}