<?php
/*用于采集开奖时间调节*/
function cjnowtime($yctime){
	if(is_numeric($yctime)){
		return $yctime = abs(intval($yctime));
	}else{
		$ftime = M('caipiao')->cache(300)->where(['name'=>$yctime])->getField('ftime');
		if($ftime){
			$yctime = abs(intval($ftime));
			return $yctime;
		}else{
			return 10;
		}
	}
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
		if($user['point'] >= $membergroup[8]["shengjiedu"])$user['groupid']=9;
		$_data['groupid'] = $user['groupid'];
		$member->where("id='{$user['id']}'")->setField(array('groupid'=>$_data['groupid']));
	}
}
function userrechargepay($_orderinfo=array()){//充值处理
	$orderinfo = M('recharge')->where(['trano'=>$_orderinfo['trano'],'paytype'=>$_orderinfo['paytype']])->find();
	if(!is_array($orderinfo) || !$orderinfo['trano'] || $orderinfo['amount']<1){
		return 0;
	}
	if($orderinfo['state']==1){//已经审核通过
		return 1;
	}elseif($orderinfo['state']==-1){
		return -1;
	}
	if($orderinfo['state']!=0){
		return -999;
	}
	//充值处理
	$_t = time();
	$_trano = $orderinfo['trano'];
	if($_orderinfo['trano'])F($_orderinfo['paytype'].'_'.$_trano,$_orderinfo);
	$threetrano = $_orderinfo['threetrano'];
	$userinfo = M('member')->where(['id'=>$orderinfo['uid']])->find();
	$oldaccountmoney = $userinfo['balance'];//充值前的金额
	$newaccountmoney = $userinfo['balance']+$orderinfo['amount'];//充值后的金额
	
	$oldaccountpoint = $userinfo['balance'];//充值前的积分
	$oldaccountxima  = $userinfo['xima'];//充值前的洗码余额
	$isfirstcz       = M('recharge')->where(['uid'=>['eq',$userinfo['id']],'state'=>['eq',1]])->count();
	
	//更改账户金额、订单状态
	$editint = M('member')->where(['id'=>$orderinfo['uid']])->setInc('balance',$orderinfo['amount']);
	if(!$editint){
		echo'会员账户金额处理失败';exit;
	}
	$updata = [];
	$updata['state'] = 1;
	$updata['oldaccountmoney'] = $oldaccountmoney;
	$updata['newaccountmoney'] = $newaccountmoney;
	
	$rechargeint = M('recharge')->where(['id'=>$orderinfo['id']])->setField(['state'=>1,'oldaccountmoney'=>$oldaccountmoney,'newaccountmoney'=>$newaccountmoney]);
	$oldthreetrano = M('recharge')->where(['id'=>$orderinfo['id']])->getField('threetrano');
	if(!$oldthreetrano && $threetrano){
		M('recharge')->where(['id'=>$orderinfo['id']])->setField(['threetrano'=>$threetrano]);
	}
	if(!$rechargeint){
		M('member')->where(['id'=>$orderinfo['uid']])->setDec('balance',$orderinfo['amount']);//再减掉
		echo'订单处理失败';exit;
	}
	$fuddetaildata = [];
	$fuddetaildata['trano'] = $_trano;
	$fuddetaildata['uid'] = $userinfo['id'];
	$fuddetaildata['username'] = $userinfo['username'];
	$fuddetaildata['type'] = 'activity_cz';
	$fuddetaildata['typename'] = '充值' /*C('fuddetailtypes.activity_cz')*/;
	$fuddetaildata['amount'] = $orderinfo['amount'];
	$fuddetaildata['amountbefor'] = $oldaccountmoney;
	$fuddetaildata['amountafter'] = $newaccountmoney;
	$fuddetaildata['remark'] = '账户充值';
	$fuddetaildata['oddtime'] = $_t;
	M('fuddetail')->data($fuddetaildata)->add();
	
	//洗码账户
	if(abs(GetVar('damaliang'))){
		$xima = ((abs(GetVar('damaliang'))/100) * $orderinfo['amount']);
		$xima = number_format($xima,2,".","");
		M('member')->where(['id'=>$orderinfo['uid']])->setInc('xima',$xima);
		$fuddetaildata = [];
		$fuddetaildata['trano'] = $_trano;
		$fuddetaildata['uid'] = $orderinfo['uid'];
		$fuddetaildata['username'] = $orderinfo['username'];
		$fuddetaildata['type'] = 'xima';
		$fuddetaildata['typename'] = C('fuddetailtypes.xima');
		$fuddetaildata['amount'] = $xima;
		$fuddetaildata['amountbefor'] = $oldaccountxima;
		$fuddetaildata['amountafter'] = $oldaccountxima+$xima;
		$fuddetaildata['remark'] = '账户充值增加洗码额度';
		$fuddetaildata['oddtime'] = $_t;
		M('fuddetail')->data($fuddetaildata)->add();
	}
	//积分账户
	$pointchongzhi    = intval(GetVar('pointchongzhi'));
	$pointchongzhiadd = intval(GetVar('pointchongzhiadd'));
	if($pointchongzhi && $pointchongzhiadd){
		$_addpoint = number_format( abs($orderinfo['amount']) * ($pointchongzhiadd/$pointchongzhi),4,".","");
		M('member')->where(['id'=>$orderinfo['uid']])->setInc('point',$_addpoint);
		
	}

//更改会员等级
	changeusergroup($orderinfo['uid']);

	$fuddetaildata = [];
	$fuddetaildata['trano'] = $_trano;
	$fuddetaildata['uid'] = $orderinfo['uid'];
	$fuddetaildata['username'] = $orderinfo['username'];
	$fuddetaildata['type'] = 'point';
	$fuddetaildata['typename'] = C('fuddetailtypes.point');
	$fuddetaildata['amount'] = $_addpoint;
	$fuddetaildata['amountbefor'] = $oldaccountpoint;
	$fuddetaildata['amountafter'] = $oldaccountpoint+$_addpoint;
	$fuddetaildata['remark'] = '账户充值赠送积分';
	$fuddetaildata['oddtime'] = $_t;
	M('fuddetail')->data($fuddetaildata)->add();
	
	/*if(!$isfirstcz){//首充赠送活动
		$newmemberrecharge = abs(intval(GetVar('newmemberrecharge')));//首充满金额
		$newmemberrechargeamount = abs(floatval(GetVar('newmemberrechargeamount')));//首充满赠送比例
		if($newmemberrecharge>0 && $newmemberrechargeamount>0 && $orderinfo['amount']>$newmemberrecharge){
			$sczsamount = $orderinfo['amount'] * ($newmemberrechargeamount/100);
			$moneyinfo = M('member')->where(['id'=>$orderinfo['uid']])->find();
			$oldaccountmoney = $moneyinfo['balance'];//首充赠送前的金额
			$newaccountmoney = $moneyinfo['balance']+$sczsamount;//首充赠送后的金额
			M('member')->where(['id'=>$orderinfo['uid']])->setInc('balance',$sczsamount);
			$fuddetaildata = [];
			$fuddetaildata['trano'] = $_trano;
			$fuddetaildata['uid'] = $orderinfo['uid'];
			$fuddetaildata['username'] = $orderinfo['username'];
			$fuddetaildata['type'] = 'activity_cz';
			$fuddetaildata['typename'] = C('fuddetailtypes.activity_cz');
			$fuddetaildata['amount'] = $sczsamount;
			$fuddetaildata['amountbefor'] = $oldaccountmoney;
			$fuddetaildata['amountafter'] = $newaccountmoney;
			$fuddetaildata['remark'] = '首充赠送';
			$fuddetaildata['oddtime'] = $_t;
			M('fuddetail')->data($fuddetaildata)->add();
		}
	}*/

	//首次充值赠送活动
	$Commissionlist = [];
	$Commissionlist[] = ['CommissionBase'=>GetVar('newmemberrecharge1'),'zsmoney'=>GetVar('newmemberrechargeamount1')];
	$Commissionlist[] = ['CommissionBase'=>GetVar('newmemberrecharge2'),'zsmoney'=>GetVar('newmemberrechargeamount2')];
	$Commissionlist[] = ['CommissionBase'=>GetVar('newmemberrecharge3'),'zsmoney'=>GetVar('newmemberrechargeamount3')];
	$Commissionlist[] = ['CommissionBase'=>GetVar('newmemberrecharge4'),'zsmoney'=>GetVar('newmemberrechargeamount4')];
	$Commissionlist[] = ['CommissionBase'=>GetVar('newmemberrecharge5'),'zsmoney'=>GetVar('newmemberrechargeamount5')];
	if(!$isfirstcz)foreach($Commissionlist as $kkk=>$Commisvo){
		$Commissions  = [];
		$Commissions  = explode('~',$Commisvo['CommissionBase']);
		$Commissions  = array_map('intval',$Commissions);
		$zsmoney      = abs(floatval($Commisvo['zsmoney']));
			
		if($Commissions[0] && $Commissions[1] && $orderinfo['amount']>=$Commissions[0] && $orderinfo['amount']<=$Commissions[1] && intval($zsmoney)>0){
			//$sczsamount      = $orderinfo['amount'] * ($zsmoney/100);
			$sczsamount      = $zsmoney;
			$moneyinfo = M('member')->where(['id'=>$orderinfo['uid']])->find();
			$oldaccountmoney = $moneyinfo['balance'];//首充赠送前的金额
			$newaccountmoney = $moneyinfo['balance']+$sczsamount;//首充赠送后的金额
			$_int0 = M('member')->where(['id'=>$orderinfo['uid']])->setInc('balance',$sczsamount);
			$fuddetaildata = [];
			$fuddetaildata['trano'] = $_trano;
			$fuddetaildata['uid'] = $orderinfo['uid'];
			$fuddetaildata['username'] = $orderinfo['username'];
			$fuddetaildata['type'] = 'activity_cz';
			$fuddetaildata['typename'] = C('fuddetailtypes.activity_cz');
			$fuddetaildata['amount'] = $sczsamount;
			$fuddetaildata['amountbefor'] = $oldaccountmoney;
			$fuddetaildata['amountafter'] = $newaccountmoney;
			$fuddetaildata['remark'] = '首充赠送';
			$fuddetaildata['oddtime'] = $_t;
			if($_int0){
				M('fuddetail')->data($fuddetaildata)->add();
			}
			
			break;//依次符合条件则退出循环
		}
	}
	
	//单次充值赠送
	$Commissionlist = [];
	$Commissionlist[] = ['CommissionBase'=>GetVar('activity_cz0_money'),'zsmoney'=>GetVar('activity_cz0_zsmoney')];
	$Commissionlist[] = ['CommissionBase'=>GetVar('activity_cz1_money'),'zsmoney'=>GetVar('activity_cz1_zsmoney')];
	$Commissionlist[] = ['CommissionBase'=>GetVar('activity_cz2_money'),'zsmoney'=>GetVar('activity_cz2_zsmoney')];
	$Commissionlist[] = ['CommissionBase'=>GetVar('activity_cz3_money'),'zsmoney'=>GetVar('activity_cz3_zsmoney')];
	$Commissionlist[] = ['CommissionBase'=>GetVar('activity_cz4_money'),'zsmoney'=>GetVar('activity_cz4_zsmoney')];
	foreach($Commissionlist as $kkk=>$Commisvo){
		$Commissions  = [];
		$Commissions  = explode('~',$Commisvo['CommissionBase']);
		$Commissions  = array_map('intval',$Commissions);
		$zsmoney   = floatval($Commisvo['zsmoney']);
			
		if($Commissions[0] && $Commissions[1] && $orderinfo['amount']>=$Commissions[0] && $orderinfo['amount']<=$Commissions[1] && intval($zsmoney)>0){
			$zsmoney   = $orderinfo['amount'] * ($zsmoney/100);//本人
			//本人账户、账变操作
			$amountbefor = 0;
			$amountbefor = M('member')->where(['id'=>$orderinfo['uid']])->getField('balance');
			$amountbefor = $amountbefor>0?$amountbefor:0;
			$_int0 = 0;
			$_int0 = M('member')->where(['id'=>$orderinfo['uid']])->setInc('balance',$zsmoney);
			$fuddetaildata = [];
			$fuddetaildata['trano'] = $_trano;
			$fuddetaildata['uid'] = $orderinfo['uid'];
			$fuddetaildata['username'] = $orderinfo['username'];
			$fuddetaildata['type'] = 'activity_cz';
			$fuddetaildata['typename'] = C('fuddetailtypes.activity_cz');
			$fuddetaildata['amount'] = $zsmoney;
			$fuddetaildata['amountbefor'] = $amountbefor;
			$fuddetaildata['amountafter'] = $amountbefor + $zsmoney;
			$fuddetaildata['oddtime'] = $_t;
			$fuddetaildata['remark'] = '单次充值满赠送';
			if($_int0){
				M('fuddetail')->data($fuddetaildata)->add();
			}
			
			break;//依次符合条件则退出循环
		}
	}
	return 1;
}

/**
 * 通用订单号获取
 * 3大写字符+时间戳+随机数
 */

function gettrano($rand=4){
	$rand = (intval($rand)>0 and intval($rand)<=6)?intval($rand):4;
	$trano = strtoupper(rand_string(3,0)).date('ymdHis').rand_string($rand,1);
	return $trano;
}
function array_filter_null($array = array()){
	if(!is_array($array))return $array;
	foreach($array as $k=>$v){
		if($v=='' || $v==NULL)unset($array[$k]);
	}
	return $array;
}
function array_unique_null($array = array()){
	if(!is_array($array))return $array;
	return array_unique($array);
}
//$Snoopy      = new \Lib\Snoopy;
/**
 * 配置变量调用
 * @param string $varname   变量名称
 */
function GetVar($varname=NULL){
	if(!$varname)return false;
	$map = array();
	$map['name'] = array('eq',$varname);
	$value = M('setting')->where($map)->cache(60)->getField('value');
	$value = htmlspecialchars_decode($value);
	return $value;
}

function file_down($filepath, $filename = '') {
	if(!$filename) $filename = basename($filepath);
	if(is_ie()) $filename = rawurlencode($filename);
	$filetype = fileext($filename);
	$filesize = sprintf("%u", filesize($filepath));
	if(ob_get_length() !== false) @ob_end_clean();
	header('Pragma: public');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: pre-check=0, post-check=0, max-age=0');
	header('Content-Transfer-Encoding: binary');
	header('Content-Encoding: none');
	header('Content-type: '.$filetype);
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header('Content-length: '.$filesize);
	readfile($filepath);
	exit;
}
function fileext($filename) {
	return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
}
function is_ie() {
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if((strpos($useragent, 'opera') !== false) || (strpos($useragent, 'konqueror') !== false)) return false;
	if(strpos($useragent, 'msie ') !== false) return true;
	return false;
}

function is_mobile()
{ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = ['nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'];
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
} 

/**
 * 获取指定月份的第一天开始和最后一天结束的时间戳
 *
 * @param int $y 年份 $m 月份
 * @return array(本月开始时间，本月结束时间)
 */
function mFristAndLast($y = "", $m = ""){
    if ($y == "") $y = date("Y");
    if ($m == "") $m = date("m");
    $m = sprintf("%02d", intval($m));
    $y = str_pad(intval($y), 4, "0", STR_PAD_RIGHT);
 
    $m>12 || $m<1 ? $m=1 : $m=$m;
    $firstday = strtotime($y . $m . "01000000");
    $firstdaystr = date("Y-m-01", $firstday);
    $lastday = strtotime(date('Y-m-d 23:59:59', strtotime("$firstdaystr +1 month -1 day")));
 
    return [
        "firstday" => $firstday,
        "lastday" => $lastday
    ];
}

/**
 * 字符串截取，支持中文和其他编码
 * 产生随机字串，可用来自动生成密码
 * 默认长度6位 字母和数字混合 支持中文
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
 * @return string
 */
function rand_string($len=6,$type=0,$addChars='') {
	$String      = new \Org\Util\String;
	$randString  = $String->randString($len,$type,$addChars);
    return $randString;
}
    /**
     * 字符串截取，支持中文和其他编码
     * @static
     * @access public
     * @param string $str 需要转换的字符串
     * @param string $start 开始位置
     * @param string $length 截取长度
     * @param string $charset 编码格式
     * @param string $suffix 截断显示字符
     * @return string
     */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
	$String   = new \Org\Util\String;
	$msubstr  = $String->msubstr($str, $start, $length, $charset, $suffix);
    return $msubstr;
}
/**
 * 字节格式化 把字节数格式为 B K M G T 描述的大小
 * @return string
 */
function byte_format($size, $dec=2) {
	$a = array("B", "KB", "MB", "GB", "TB", "PB");
	$pos = 0;
	while ($size >= 1024) {
		 $size /= 1024;
		   $pos++;
	}
	return round($size,$dec)." ".$a[$pos];
}

    /**
     * 检查字符串是否是UTF8编码
     * @param string $string 字符串
     * @return Boolean
     */
if (function_exists('is_utf8')) {
	function is_utf8($str) {
		$String   = new \Org\Util\String;
		$str      = $String->isUtf8($str);
		return $str;
	}
}
if (function_exists('autoCharset')) {
function autoCharset($str) {
	$String   = new \Org\Util\String;
	$str      = $String->autoCharset($str);
    return $str;
}
}

/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list,$field, $sortby='asc') {
   if(is_array($list)){
       $refer = $resultSet = array();
       foreach ($list as $i => $data)
           $refer[$i] = &$data[$field];
       switch ($sortby) {
           case 'asc': // 正向排序
                asort($refer);
                break;
           case 'desc':// 逆向排序
                arsort($refer);
                break;
           case 'nat': // 自然排序
                natcasesort($refer);
                break;
       }
       foreach ( $refer as $key=> $val)
           $resultSet[$key] = &$list[$key];
       return $resultSet;
   }
   return false;
}

/**
 * 在数据列表中搜索
 * @access public
 * @param array $list 数据列表
 * @param mixed $condition 查询条件
 * 支持 array('name'=>$value) 或者 name=$value
 * @return array
 */
function list_search($list,$condition) {
    if(is_string($condition))
        parse_str($condition,$condition);
    // 返回的结果集合
    $resultSet = array();
    foreach ($list as $key=>$data){
        $find   =   false;
        foreach ($condition as $field=>$value){
            if(isset($data[$field])) {
                if(0 === strpos($value,'/')) {
                    $find   =   preg_match($value,$data[$field]);
                }elseif($data[$field]==$value){
                    $find = true;
                }
            }
        }
        if($find)
            $resultSet[]     =   &$list[$key];
    }
    return $resultSet;
}

// 自动转换字符集 支持数组转换
function auto_charset($fContents, $from='gbk', $to='utf-8') {
    $from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
    $to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
    if (strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents))) {
        //如果编码相同或者非字符串标量则不转换
        return $fContents;
    }
    if (is_string($fContents)) {
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($fContents, $to, $from);
        } elseif (function_exists('iconv')) {
            return iconv($from, $to, $fContents);
        } else {
            return $fContents;
        }
    } elseif (is_array($fContents)) {
        foreach ($fContents as $key => $val) {
            $_key = auto_charset($key, $from, $to);
            $fContents[$_key] = auto_charset($val, $from, $to);
            if ($key != $_key)
                unset($fContents[$key]);
        }
        return $fContents;
    }
    else {
        return $fContents;
    }
}

function SendMail($to,$subject = '',$body = ''){
    //$to 表示收件人地址 $subject 表示邮件标题 $body表示邮件正文
    //error_reporting(E_ALL);
    error_reporting(E_STRICT);
    date_default_timezone_set('Asia/Shanghai');//设定时区东八区
	import('Common.Lib.PHPMailer');
	$mail = new \PHPMailer();
    $body            = eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
    $mail->CharSet ="UTF-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP(); // 设定使用SMTP服务
    $mail->SMTPDebug  = 0;                     // 启用SMTP调试功能
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
    $mail->SMTPSecure = "ssl";                 // 安全协议，可以注释掉
    $mail->Host       = GetVar('SMTP_HOST');      // SMTP 服务器
    $mail->Port       = GetVar('SMTP_PORT');                   // SMTP服务器的端口号
    $mail->Username   = GetVar('SMTP_USER');  // SMTP服务器用户名
    $mail->Password   = GetVar('SMTP_PASS');            // SMTP服务器密码
    $mail->SetFrom(GetVar('FROM_EMAIL'), GetVar('FROM_NAME'));
    $mail->AddReplyTo(GetVar('REPLY_EMAIL'),GetVar('REPLY_NAME'));
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
/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string
 */
function sys_md5($str){
	return '' === $str ? '' : md5(sha1($str));
}
/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key  加密密钥
 * @param int $expire  过期时间 单位 秒
 * @return string
 */
function encrypt($data, $key = '', $expire = 0) {
    $key  = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
    $data = base64_encode($data);
    $x    = 0;
    $len  = strlen($data);
    $l    = strlen($key);
    $char = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    $str = sprintf('%010d', $expire ? $expire + time():0);

    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256);
    }
    return str_replace(array('+','/','='),array('-','_',''),base64_encode($str));
}

/**
 * 系统解密方法
 * @param  string $data 要解密的字符串 （必须是think_encrypt方法加密的字符串）
 * @param  string $key  加密密钥
 * @return string
 */
function decrypt($data, $key = ''){
    $key    = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
    $data   = str_replace(array('-','_'),array('+','/'),$data);
    $mod4   = strlen($data) % 4;
    if ($mod4) {
       $data .= substr('====', $mod4);
    }
    $data   = base64_decode($data);
    $expire = substr($data,0,10);
    $data   = substr($data,10);

    if($expire > 0 && $expire < time()) {
        return '';
    }
    $x      = 0;
    $len    = strlen($data);
    $l      = strlen($key);
    $char   = $str = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1))<ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }else{
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}
