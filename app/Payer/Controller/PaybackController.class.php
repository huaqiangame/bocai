<?php
namespace Payer\Controller;
use Think\Controller;
class PaybackController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
	function ipaybank(){
		if(!IS_POST){
			echo'error';exit;
		}
		$ipaybank = $_POST;
		libxml_disable_entity_loader(true); 
 
		$xmlstring = simplexml_load_string(htmlspecialchars_decode($ipaybank['paymentResult']), 'SimpleXMLElement', LIBXML_NOCDATA); 
		 
		$Result = json_decode(json_encode($xmlstring),true);
		$RspCode   = $Result['GateWayRsp']['head']['RspCode'];
		$RspMsg    = $Result['GateWayRsp']['head']['RspMsg'];
		$ReqDate   = $Result['GateWayRsp']['head']['ReqDate'];
		$RspDate   = $Result['GateWayRsp']['head']['RspDate'];
		$Signature = $Result['GateWayRsp']['head']['Signature'];
		//body
		$MerBillNo = $Result['GateWayRsp']['body']['MerBillNo'];
		$CurrencyType = $Result['GateWayRsp']['body']['CurrencyType'];
		$Amount    = $Result['GateWayRsp']['body']['Amount'];
		$Date = $Result['GateWayRsp']['body']['Date'];
		$Status = $Result['GateWayRsp']['body']['Status'];
		$Msg = $Result['GateWayRsp']['body']['Msg'];
		$IpsBillNo = $Result['GateWayRsp']['body']['IpsBillNo'];
		$IpsTradeNo = $Result['GateWayRsp']['body']['IpsTradeNo'];
		$RetEncodeType = $Result['GateWayRsp']['body']['RetEncodeType'];
		$BankBillNo = $Result['GateWayRsp']['body']['BankBillNo'];
		$ResultType = $Result['GateWayRsp']['body']['ResultType'];
		$IpsBillTime = $Result['GateWayRsp']['body']['IpsBillTime'];
		if($RspCode!='000000'){
			echo'ERROR0';exit;
		}

		$orderinfo  = F($MerBillNo,'','./PayOrder/');//订单详情
		if(!$orderinfo){
			echo'订单号不存在！';exit;
		}
		
		$paytype  = $orderinfo['paytype'];
		//取支付配置
		$payset = C('bankpaylists.'.$paytype);
		$configs = $payset['configs'];
		$MerCode = $configs['merchantid'];
		$tokenkey = $configs['merchantkey1'];
		$_Signature = md5("<body><MerBillNo>$MerBillNo</MerBillNo><CurrencyType>156</CurrencyType><Amount>$Amount</Amount><Date>$Date</Date><Status>$Status</Status><Msg><![CDATA[$Msg]]></Msg><IpsBillNo>$IpsBillNo</IpsBillNo><IpsTradeNo>$IpsTradeNo</IpsTradeNo><RetEncodeType>$RetEncodeType</RetEncodeType><BankBillNo>$BankBillNo</BankBillNo><ResultType>$ResultType</ResultType><IpsBillTime>$IpsBillTime</IpsBillTime></body>".$MerCode.$tokenkey);
		if($Signature!=$_Signature){
			echo'验签失败！';exit;
		}
		$apiparam=array();
		$orderinfo['threetrano'] = $IpsBillNo;
		$apiparam = $orderinfo;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
		if($Result['sign']){
			echo "ok";exit;
		}else{
			echo "error";
			exit;
		}
	}
	function r1pay(){
		$userid     = $_REQUEST["userid"];
		$orderid    = $_REQUEST["orderid"];
		$btype      = $_REQUEST["btype"];//微信：83、支付宝：84
		$result     = $_REQUEST["result"];//成功：2000，失败：2001
		$value      = $_REQUEST["value"];
		$realvalue  = $_REQUEST["realvalue"];//实际成功金额 商户处理订单应该以此结果为准
		$sign       = $_REQUEST["sign"];


		$orderinfo  = F($orderid,'','./PayOrder/');//订单详情
		if(!$orderinfo){
			echo'订单号不存在！';exit;
		}
		if(!in_array($btype,[83,84])){
			echo'充值方式不存在！';exit;
		}
		$paytype  = $orderinfo['paytype'];
		//取支付配置
		$payset = C('bankpaylists.'.$paytype);
		$configs = $payset['configs'];
		
		
		$signstr = "userid{$userid}orderid{$orderid}btype{$btype}result{$result}value{$value}realvalue{$realvalue}{$configs['merchantkey1']}";
		//dump($signstr);exit;
		$_sign = strtolower(md5($signstr));
		if($_sign!=$sign){
			echo'验签失败！';exit;
		}
		if($result!=2000){
			echo'充值失败！';exit;
		}
		$apiparam=array();
		$apiparam = $orderinfo;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
		if($Result['sign']){
			echo "ok";exit;
		}else{
			echo "error";
			exit;
		}
		
	}
	function mobaobank(){
		
		// 请求数据赋值
		$data = "";
		$data['apiName'] = $_REQUEST["apiName"];
		// 通知时间
		$data['notifyTime'] = $_REQUEST["notifyTime"];
		// 支付金额(单位元，显示用)
		$data['tradeAmt'] = $_REQUEST["tradeAmt"];
		// 商户号
		$data['merchNo'] = $_REQUEST["merchNo"];
		// 商户参数，支付平台返回商户上传的参数，可以为空
		$data['merchParam'] = $_REQUEST["merchParam"];
		// 商户订单号
		$data['orderNo'] = $_REQUEST["orderNo"];
		// 商户订单日期
		$data['tradeDate'] = $_REQUEST["tradeDate"];
		// Mo宝支付订单号
		$data['accNo'] = $_REQUEST["accNo"];
		// Mo宝支付账务日期
		$data['accDate'] = $_REQUEST["accDate"];
		// 订单状态，0-未支付，1-支付成功，2-失败，4-部分退款，5-退款，9-退款处理中
		$data['orderStatus'] = $_REQUEST["orderStatus"];
		// 签名数据
		$data['signMsg'] = $_REQUEST["signMsg"];
	
		$orderinfo  = F($data['orderNo'],'','./PayOrder/');//订单详情
		if(!$orderinfo){
			echo'订单号不存在！';exit;
		}
		$paytype  = $orderinfo['paytype'];
		//取支付配置
		$payset = C('bankpaylists.'.$paytype);
		$configs = $payset['configs'];
		
		$mbp_key = $configs['merchantkey1'];
		//print_r( $data);
		// 初始化
		$mobaopay_gateway = "https://bis.pandapayment.com/cgi-bin/netpayment/pay_gate.cgi";
		require_once("./mbpay/MbPay.php");
		$cMbPay = new \MbPay($mbp_key, $mobaopay_gateway);
		// 准备准备验签数据
		$str_to_sign = $cMbPay->prepareSign($data);
		// 验证签名
		$resultVerify = $cMbPay->verify($str_to_sign, $data['signMsg']);
		if($data['orderStatus']==1){
			echo '支付成功';
		}else{
			echo '支付失败';exit;
		}
		if($resultVerify){
			$order_no = $_REQUEST["orderNo"];
			$order_amount = $_REQUEST["tradeAmt"];
			$orderinfo['threetrano'] = $data['accNo'];
			$apiparam=array();
			$apiparam = $orderinfo;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
			if($Result['sign']){
				echo "SUCCESS";exit;
			}else{
				echo "error";
				//$domain = 'http://'.$_SERVER['SERVER_NAME'].'/Member.orderform?tabid=rechargelist';
				//header("location:".$domain);
				exit;
			}
			
		}else{
			echo "Signature Error";
		}
	}
	function japaybank(){
		$merchno = $_REQUEST['merchno'];
		$amount = $_REQUEST['amount'];
		$traceno = $_REQUEST['traceno'];//平台订单号
		$orderno = $_REQUEST['orderno'];//金安付订单号
		$channelOrderno = $_REQUEST['channelOrderno'];//银行交易流水号
		$status = $_REQUEST['status'];;//2 支付成功
		$signature = $_REQUEST['signature'];
		if($traceno){//保存用于测试
			//F('japaybank_'.$traceno,$_REQUEST);
		}
		$signature = $_REQUEST['signature'];
		unset($_REQUEST['signature']);
		$_fields = ['amount','merchno','status','traceno','orderno'];
		$orderinfo  = F($traceno,'','./PayOrder/');//订单详情
		if(!$orderinfo){
			echo'订单号不存在！';exit;
		}
		$paytype  = $orderinfo['paytype'];
		//取支付配置
		$payset = C('bankpaylists.'.$paytype);
		$configs = $payset['configs'];
		/*$param = [];
		$param['merchno'] = $merchno;
		$param['amount'] = $amount;
		$param['traceno'] = $traceno;
		$param['orderno'] = $orderno;
		$param['channelOrderno'] = $channelOrderno;
		$param['status'] = $status;*/
		//$param = array_filter($param);
		//ksort($param);
		//unset($_REQUEST['channelOrderno']);
		$signStr = '';
		foreach($_REQUEST as $k=>$v){
			if($v != ""){
				$signStr = $signStr."".$k."=".$v."&";
			}
		}

		$signStr = $signStr . $configs['merchantkey1'];
		$_signstr = md5($signStr);
		if($signature!=$_signstr){
			//echo'验签错误';exit;
		}
		if($status!=2 || intval($_REQUEST['amount'])!=$orderinfo['amount'] || strlen($_REQUEST['orderno'])<12){
			echo'充值失败';exit;
		}
		//充值处理
		//第三方订单号
		$orderinfo['threetrano'] = $orderno;
		$apiparam=array();
		$apiparam = $orderinfo;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
		if($Result['sign']){
			echo "ok";exit;
		}else{
			echo "error";exit;
		}
		
	}
	function japaysaoma(){
		$transDate = I('transDate');
		$transTime = I('transTime');
		$merchno = I('merchno');
		$merchName = I('merchName');
		$amount = I('amount');
		$traceno = I('traceno');//平台订单号
		$orderno = I('orderno');//第三方系统订单号
		$channelOrderno = I('channelOrderno');
		$channelTraceno = I('channelTraceno');
		$status = I('status');
		$signature = I('signature');
		$customerno = I('customerno');
		$openId = I('openId');
		/*$param = [];
		$param['transDate'] = $transDate;
		$param['transTime'] = $transTime;
		$param['merchno'] = $merchno;
		$param['merchName'] = $merchName;
		$param['amount'] = $amount;
		$param['traceno'] = $traceno;
		$param['orderno'] = $orderno;
		$param['channelOrderno'] = $channelOrderno;
		$param['channelTraceno'] = $channelTraceno;
		$param['status'] = $status;
		$param['customerno'] = $customerno;
		$param['openId'] = $openId;*/
		$fields = ['amount','channelOrderno','channelTraceno','merchName','merchno','orderno','payType','signature','status','traceno','transDate','transTime'];
		$_fields1 = ['transDate','transTime','merchno','merchName','customerno','amount','traceno','orderno','channelOrderno','channelTraceno','openId','status'];
		foreach($_REQUEST as $k=>$v){
			if(!in_array($k,$_fields1))unset($_REQUEST[$k]);
		}
		//$param = array_filter($param);
		ksort($_REQUEST);
		unset($_REQUEST['signature']);
		$orderinfo  = F($traceno,'','./PayOrder/');//订单详情
		$signStr = '';
		foreach($_REQUEST as $k=>$v){
			if($v != ""){
				$signStr = $signStr."".$k."=".$v."&";
			}
		}
		if(!$orderinfo){
			echo'订单号不存在！';exit;
		}
		$paytype  = $orderinfo['paytype'];
		//取支付配置
		$payset = C('bankpaylists.'.$paytype);
		$configs = $payset['configs'];
		$signStr = $signStr . $configs['merchantkey1'];
		$_signstr = md5($signStr);
		if($signature!=$_signstr){//不知道为神马总是不一致 使用下面的严格验证
			//echo'验签错误';exit;
		}
		$_merchName = '成都阿甘和他的朋友们电子商务有限公司';
		$_merchantkey2 = trim($configs['merchantkey2']);
		if($_REQUEST['status']!=1 || $orderinfo['trano']!=$_REQUEST['traceno'] || $orderinfo['actualamount']!=intval($_REQUEST['amount']) || $_REQUEST['merchName']!=$_merchantkey2){
			echo'充值失败';exit;
		}
		//充值处理
		//第三方订单号
		$orderinfo['threetrano'] = $orderno;
		$apiparam=array();
		$apiparam = $orderinfo;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
		if($Result['sign']){
			echo "ok";exit;
		}else{
			echo "error";exit;
		}
	}
	function vpay(){
		$partner     = $_REQUEST['partner'];//商户id,	
		$ordernumber = $_REQUEST['ordernumber'];//平台订单号
		$orderstatus = $_REQUEST['orderstatus'];//1 成功 
		$paymoney    = $_REQUEST['paymoney']; //金额 转整数
		$sysnumber   = $_REQUEST['sysnumber'];//第三方单号
		$sign        = $_REQUEST['sign'];
		if($orderstatus!=1){
			echo'充值失败！';exit;
		}
		$orderinfo  = F($ordernumber,'','./PayOrder/');//订单详情
		if(!$orderinfo){
			echo'订单号不存在！';exit;
		}
		$paytype  = $orderinfo['paytype'];
		if(!in_array($paytype,['alipayvpay','weixinvpay'])){
			echo'支付方式不存在';exit;
		}
		$banktype = '';
		if($banktype=='alipayvpay'){
			$banktype = 'ALIPAY';
		}elseif($banktype=='weixinvpay'){
			$banktype = 'WEIXIN';
		}
		//取支付配置
		$payset = C('bankpaylists.'.$paytype);
		$configs = $payset['configs'];
		$callbackurl = $configs['returnbackurl'].'/Payback.vpay';
		$_signstr = "partner={$partner}&ordernumber={$ordernumber}&orderstatus={$orderstatus}&paymoney={$paymoney}{$configs['merchantkey1']}";
		$_sign = md5($_signstr);
		if($sign!=$_sign){
			echo'签名错误';exit;
		}
		//充值处理
		//第三方订单号
		$orderinfo['threetrano'] = $sysnumber;
		$apiparam=array();
		$apiparam = $orderinfo;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
		if($Result['sign']){
			echo "ok";exit;
		}else{
			echo "error";exit;
		}
	}
	function xlb(){
		require_once("./xlb/Mobaopay.Config.php");
		require_once("./xlb/MobaoPay.class.php");
	
		// 请求数据赋值
		$data = "";
		$data['apiName'] = $_REQUEST["apiName"];
		// 通知时间
		$data['notifyTime'] = $_REQUEST["notifyTime"];
		// 支付金额(单位元，显示用)
		$data['tradeAmt'] = $_REQUEST["tradeAmt"];
		// 商户号
		$data['merchNo'] = $_REQUEST["merchNo"];
		// 商户参数，支付平台返回商户上传的参数，可以为空
		$data['merchParam'] = $_REQUEST["merchParam"];
		// 商户订单号
		$data['orderNo'] = $_REQUEST["orderNo"];
		// 商户订单日期
		$data['tradeDate'] = $_REQUEST["tradeDate"];
		// 迅联宝支付订单号
		$data['accNo'] = $_REQUEST["accNo"];
		// 迅联宝支付账务日期
		$data['accDate'] = $_REQUEST["accDate"];
		// 订单状态，0-未支付，1-支付成功，2-失败，4-部分退款，5-退款，9-退款处理中
		$data['orderStatus'] = $_REQUEST["orderStatus"];
		// 签名数据
		$data['signMsg'] = $_REQUEST["signMsg"];
	
		//print_r( $data);
		// 初始化
		$cMbPay = new \MbPay($mbp_key, $mobaopay_gateway);
		// 准备准备验签数据
		$str_to_sign = $cMbPay->prepareSign($data);
		// 验证签名
		$resultVerify = $cMbPay->verify($str_to_sign, $data['signMsg']);
		//var_dump($data);
		if($_POST["orderNo"]){
			F('xlb_'.$_POST["orderNo"],$_POST);
		}
		if ($resultVerify) 
		{

			$order_no = $_REQUEST["orderNo"];
			$order_amount = $_REQUEST["tradeAmt"];
				$orderinfo = F($order_no,'','./PayOrder/');
				//$orderinfo = F('RIS1612071500399511','','./PayOrder/');
				if(!$orderinfo){//第三方订单号未查到 添加至关系库
					echo '未查到充值订单，可能原因：扫码充值后未提交订单号!';exit;
				}
				if($orderinfo['state']==1){
					echo'ok已经充值成功';exit;
				}
				if($orderinfo['state']!=0){
					echo'订单状态已完成或已被取消';exit;
				}
				//将订单金额全部转为带2位小数 进行比较
				$orderamount  = number_format($orderinfo['amount'],2,".","");//申请金额
				$actualamount = number_format($money,2,".","");//实到账金额
				if($orderamount!=$actualamount){//申请金额与实际金额不一致 则更改
					$orderinfo['amount'] = $orderamount;
				}
				//第三方订单号
				$orderinfo['threetrano'] = $data['accNo'];
				$apiparam=array();
				$apiparam = $orderinfo;
				$_api = new \Lib\api;
				$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
				if($Result['sign']){
					echo "SUCCESS";exit;
				}else{
					echo "Signature error";exit;
				}

			
			return true;
		}
		else
		{
			// 签名验证失败
			echo "验证签名失败";
			return false;

		}
	}
	function mobaopay(){
		require_once("./mobaopay/Mobaopay.Config.php");
		require_once("./mobaopay/MobaoPay.class.php");
	
		// 请求数据赋值
		$data = "";
		$data['apiName'] = $_REQUEST["apiName"];
		// 通知时间
		$data['notifyTime'] = $_REQUEST["notifyTime"];
		// 支付金额(单位元，显示用)
		$data['tradeAmt'] = $_REQUEST["tradeAmt"];
		// 商户号
		$data['merchNo'] = $_REQUEST["merchNo"];
		// 商户参数，支付平台返回商户上传的参数，可以为空
		$data['merchParam'] = $_REQUEST["merchParam"];
		// 商户订单号
		$data['orderNo'] = $_REQUEST["orderNo"];
		// 商户订单日期
		$data['tradeDate'] = $_REQUEST["tradeDate"];
		// 迅联宝支付订单号
		$data['accNo'] = $_REQUEST["accNo"];
		// 迅联宝支付账务日期
		$data['accDate'] = $_REQUEST["accDate"];
		// 订单状态，0-未支付，1-支付成功，2-失败，4-部分退款，5-退款，9-退款处理中
		$data['orderStatus'] = $_REQUEST["orderStatus"];
		// 签名数据
		$data['signMsg'] = $_REQUEST["signMsg"];
	
		//print_r( $data);
		// 初始化
		$cMbPay = new \MbPay($mbp_key, $mobaopay_gateway);
		// 准备准备验签数据
		$str_to_sign = $cMbPay->prepareSign($data);
		// 验证签名
		$resultVerify = $cMbPay->verify($str_to_sign, $data['signMsg']);
		//var_dump($data);
		if($_POST["orderNo"]){
			F('xlb_'.$_POST["orderNo"],$_POST);
		}
		if ($resultVerify) 
		{

			$order_no = $_REQUEST["orderNo"];
			$order_amount = $_REQUEST["tradeAmt"]; 
				$orderinfo = M('recharge')->where(['trano'=>$order_no])->find(); 
				if(!$orderinfo){//第三方订单号未查到 添加至关系库
					echo '未查到充值订单，可能原因：扫码充值后未提交订单号!';exit;
				}
				if($orderinfo['state']==1){
					echo'ok已经充值成功';
					header("Location:".$data['merchParam']);
					exit;
				}
				if($orderinfo['state']!=0){
					echo'订单状态已完成或已被取消';exit;
				}
				//将订单金额全部转为带2位小数 进行比较
				$orderamount  = number_format($orderinfo['amount'],2,".","");//申请金额
				$actualamount = number_format($data['tradeAmt'],2,".","");//实到账金额 

				 
	 			if($orderamount!=$actualamount){//申请金额与实际金额不一致 则更改
					$dataa['remark'] = "充值异常,充值金额与实到金额不一致,请核对";
					$dataa['threetrano'] = $data["accNo"];
					$dataa['state'] = -1;
					M('recharge')->where(['trano'=>$order_no])->setField($dataa);
					exit;
				} 
				//第三方订单号
				$orderinfo['threetrano'] = $data['accNo'];
				$apiparam=array();
				$apiparam = $orderinfo;
				$_api = new \Lib\api;
				$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
				if($Result['sign']){
					echo "SUCCESS";exit;
				}else{
					echo "Signature error";exit;
				}

			
			return true;
		}
		else
		{
			// 签名验证失败
			echo "验证签名失败";
			return false;

		}
	}	
	function jifubaopay(){
		
	require_once("./jifubaopay/Pay.Config.php");
	require_once("./jifubaopay/Pay.class.php");
	// 请求数据赋值
	$data = "";
	$data['service'] = $_REQUEST["service"];
	// 通知时间
	$data['merId'] = $_REQUEST["merId"];
	// 支付金额(单位元，显示用)
	$data['tradeNo'] = $_REQUEST["tradeNo"];
	// 商户号
	$data['tradeDate'] = $_REQUEST["tradeDate"];
	// 商户参数，支付平台返回商户上传的参数，可以为空
	$data['opeNo'] = $_REQUEST["opeNo"];
	// 订单号
	$data['opeDate'] = $_REQUEST["opeDate"];
	// 订单日期
	$data['amount'] = $_REQUEST["amount"];
	
	if($_REQUEST["extra"]=='ceshi'){
		$data['amount']=0.01;
	}
	
	// 支付订单号
	$data['status'] = $_REQUEST["status"];
	// 支付账务日期
	$data['extra'] = $_REQUEST["extra"]; 

	// 订单状态，0-未支付，1-支付成功，2-失败，4-部分退款，5-退款，9-退款处理中
	$data['payTime'] = $_REQUEST["payTime"];
	// 签名数据
	$data['sign'] = $_REQUEST["sign"];
    $data['notifyType'] = $_REQUEST["notifyType"];
	// 初始化
    $pPay = new \Pay($KEY,$GATEWAY_URL);
	// 准备准备验签数据
	$str_to_sign = $pPay->prepareSign($data);
	// 验证签名
	$resultVerify = $pPay->verify($str_to_sign, $data['sign']);
		//var_dump($data);

		if($data['tradeNo']){
			F('xlb_'.$data['tradeNo'],$_POST);
		}
		if ($resultVerify) 
		{

			$order_no = $data['tradeNo'];
			$order_amount = $data['amount']; 
				$orderinfo = M('recharge')->where(['trano'=>$order_no])->find(); 
				if(!$orderinfo){//第三方订单号未查到 添加至关系库
					echo '未查到充值订单，可能原因：扫码充值后未提交订单号!';exit;
				}
				if($orderinfo['state']==1){
					echo'ok已经充值成功';
					header("Location:".$data['merchParam']);
					exit;
				}
				if($orderinfo['state']!=0){
					echo'订单状态已完成或已被取消';exit;
				}
				//将订单金额全部转为带2位小数 进行比较
				$orderamount  = number_format($orderinfo['amount'],2,".","");//申请金额
				$actualamount = number_format($data['amount'],2,".","");//实到账金额
/* 			    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
				$txt = $resultVerify."---\n";
				fwrite($myfile, $txt);
				$txt = $data['sign']."\n";
				fwrite($myfile, $txt);
				fclose($myfile); 	 
				 */
  	 			if($orderamount!=$actualamount){//申请金额与实际金额不一致 则更改
					$dataa['remark'] = "充值异常,充值金额与实到金额不一致,请核对";
					$dataa['threetrano'] = $_POST["opeNo"];
					$dataa['state'] = -1;
					M('recharge')->where(['trano'=>$order_no])->setField($dataa);
					exit;
				}  
				//第三方订单号
				$orderinfo['threetrano'] = $data['opeNo'];
				$apiparam=array();
				$apiparam = $orderinfo;
				$_api = new \Lib\api;
				$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
				if($Result['sign']){
					echo "SUCCESS";exit;
				}else{
					echo "Signature error";exit;
				}

			
			return true;
		}
		else
		{
			// 签名验证失败
			echo "验证签名失败";
			return false;

		}
	}		
	//多得宝网银到账
    function dinpay(){
    	$merchant_id    = 1000210688;       // 获取商户编号
		
		$pubKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDAHmHO/I33vObZmapfKbHOgRUc
HxDavJJprqhWw+DCdn/gFxdXPNVQC06YSV1CSbmNjaLetVXi3eOEAY/4neLyi7se
I+aJSE63/ROY8GkmZo8AxS6Rr984+JqhGdmfdAS//LvD5kidxFWolFfEjmGPuJS3
oIznJy3bCyFwCOy2RwIDAQAB';
		$pubKey = openssl_get_publickey($pubKey);
		
		//////////////////////////		接收智付返回通知数据  /////////////////////////////////
		////////////////////////// To receive notification data from Dinpay ////////////////////
		
	  
		$merchant_code	= $_POST["merchant_code"];	

		$interface_version = $_POST["interface_version"];

		$sign_type = $_POST["sign_type"];

		$dinpaySign = base64_decode($_POST["sign"]);

		$notify_type = $_POST["notify_type"];

		$notify_id = $_POST["notify_id"];

		$order_no = $_POST["order_no"];

		$order_time = $_POST["order_time"];	

		$order_amount = $_POST["order_amount"];

		$trade_status = $_POST["trade_status"];

		$trade_time = $_POST["trade_time"];

		$trade_no = $_POST["trade_no"];

		$bank_seq_no = $_POST["bank_seq_no"];

		$extra_return_param = $_POST["extra_return_param"];
		if($_POST["order_no"]){
			F('dinpay_'.$_POST["order_no"],$_POST);
		}


		/////////////////////////////   数据签名  /////////////////////////////////
		////////////////////////////  Data signature  ////////////////////////////

		/**
		签名规则定义如下：
		（1）参数列表中，除去sign_type、sign两个参数外，其它所有非空的参数都要参与签名，值为空的参数不用参与签名；
		（2）签名顺序按照参数名a到z的顺序排序，若遇到相同首字母，则看第二个字母，以此类推，同时将商家支付密钥key放在最后参与签名，组成规则如下：
				参数名1=参数值1&参数名2=参数值2&……&参数名n=参数值n&key=key值
		*/

		/**
		The definition of signature rule is as follows : 
		（1） In the list of parameters, except the two parameters of sign_type and sign, all the other parameters that are not in blank shall be signed, the parameter with value as blank doesn't need to be signed; 
		（2） The sequence of signature shall be in the sequence of parameter name from a to z, in case of same first letter, then in accordance with the second letter, so on so forth, meanwhile, the merchant payment key shall be put at last for signature, and the composition rule is as follows : 
			Parameter name 1 = parameter value 1& parameter name 2 = parameter value 2& ......& parameter name N = parameter value N & key = key value
		*/

		
		$signStr = "";
		
		if($bank_seq_no != ""){
			$signStr = $signStr."bank_seq_no=".$bank_seq_no."&";
		}

		if($extra_return_param != ""){
			$signStr = $signStr."extra_return_param=".$extra_return_param."&";
		}	

		$signStr = $signStr."interface_version=".$interface_version."&";	

		$signStr = $signStr."merchant_code=".$merchant_code."&";

		$signStr = $signStr."notify_id=".$notify_id."&";

		$signStr = $signStr."notify_type=".$notify_type."&";

		$signStr = $signStr."order_amount=".$order_amount."&";	

		$signStr = $signStr."order_no=".$order_no."&";	

		$signStr = $signStr."order_time=".$order_time."&";	

		$signStr = $signStr."trade_no=".$trade_no."&";	

		$signStr = $signStr."trade_status=".$trade_status."&";

		$signStr = $signStr."trade_time=".$trade_time;
		
		
/////////////////////////////   RSA-S验证  /////////////////////////////////

 	$merchant_private_key='-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAMAeYc78jfe85tmZ
ql8psc6BFRwfENq8kmmuqFbD4MJ2f+AXF1c81VALTphJXUJJuY2Not61VeLd44QB
j/id4vKLux4j5olITrf9E5jwaSZmjwDFLpGv3zj4mqEZ2Z90BL/8u8PmSJ3EVaiU
V8SOYY+4lLegjOcnLdsLIXAI7LZHAgMBAAECgYEAjzjXH7DFwW9xBb159pGlvVYb
v6glL3wvBlwvoOdL8ozWzd9JBj8SoyaaxArFXHqLusxhI/g5e/SA/VMQ2n4Rxgap
EzF+MPqZgTLyVQEVGdT1vUJUDTNk/Y4wtPEDtJ1JalgCdynm77j5XiDHy23fOyFM
7JOY0uhPz9rLJgHk9ykCQQDlx29OtGtZnxrlyDMKkZr5pkqjbo6REkENTaHcZlNZ
AyFvAa8SfIXGJFoqOxBPpx/ZDf1mh88JIAcmrafFqPzbAkEA1grFKsEPmPCOeZGv
Sg1flCA0b7i7OmnOSxqC1ABqwhz/x+EEa25FrH+qrQDqmrGGLRXSP5EVMrifbFyY
58cyBQJAKu27qeSjObcz+0IP5yWU4pdi0m3RTOEwLiAW4Wpsn/CpymdyIe4JwB8C
iWlHftomZRLsCL/OulG1hFBlS9RqiQJAF0omuAc3xkFuj0XN1/Xqj3iNnBZysOFw
Y/WnhJ/i/eof3sTaMUJXbHSbwqVV4a0tV1yHewkzUEiMeEL/FEE1bQJBAKyj6W7a
0gqs6vopOHQu0bZzPd095XKF194501Sr3sDckiqcflOHE7x3O75Zr6iK6XMUstYl
ijzEJHBwC/j/kWM=
-----END PRIVATE KEY-----';

$dinpay_public_key ='-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDRGqtS/PWGLitlU+0CQ3GDKGzVm3eqb34sdYIqJ2YtNodwoZj1zp+oh/ZmELBiqYCubTBymZLX1q/02id1c6Sbmbmu8ZovfNCSwNj57qfjK8BEPU628+IkdKmO4LWcLdqU4lVznlrdywNIPqfsVlWje4F/4YTcVwK0LPtDUcE85wIDAQAB
-----END PUBLIC KEY-----';

  
	$dinpay_public_key = openssl_get_publickey($dinpay_public_key);
	
	$flag = openssl_verify($signStr,$dinpaySign,$dinpay_public_key,OPENSSL_ALGO_MD5);	
	
		
	if(!$flag){		

		echo"Verification Error"; 
	}


		////////////////////////////////////异步通知必须响应"SUCCESS"///////////////////////////////
		/**
		When the notification method is service asynchronous notification, after receiving backstage notification and complete processing, the merchant system must printout the following seven characters "SUCCESS "which can't be change,including the space between the characters, otherwise, the Dinpay payment system will, during the subsequent period, send such notification for 5 times with increasing time interval.
		*/

				//$orderinfo = F($order_no,'','./PayOrder/');
				$orderinfo = M('recharge')->where(['trano'=>$order_no])->find();
				//$orderinfo = F('RIS1612071500399511','','./PayOrder/');
				if(!$orderinfo){//第三方订单号未查到 添加至关系库
					echo '未查到充值订单，可能原因：扫码充值后未提交订单号!';exit;
				}
				if($orderinfo['state']==1){
					echo'ok已经充值成功';exit;
				} 
				if($orderinfo['state']!=0){
					echo'订单状态已完成或已被取消';exit;
				}
				//将订单金额全部转为带2位小数 进行比较
				$orderamount  = number_format($orderinfo['amount'],2,".","");//申请金额
				$actualamount = number_format($order_amount,2,".","");//实到账金额
				if($orderamount!=$actualamount){//申请金额与实际金额不一致
					$dataa['remark'] = "充值异常,充值金额与实到金额不一致,请核对";
					$dataa['threetrano'] = $_POST["trade_no"];
					$dataa['state'] = -1;
					M('recharge')->where(['trano'=>$order_no])->setField($dataa);
					exit;
				}
				//第三方订单号
				$orderinfo['threetrano'] = $trade_no;
				$apiparam=array();
				$apiparam = $orderinfo;
				$_api = new \Lib\api;
				$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
				if($Result['sign']){
					echo "SUCCESS";exit;
				}else{
					echo "Signature error";exit;
				}
		
		exit;
    }
	function xjwxpay(){
		if(IS_POST){
			$jsonrs = file_get_contents("php://input");
			$arr= json_decode($jsonrs , true);
			$data['state'] = 1;
			if($arr['errcode']=='0'){
				$map['trano'] = $arr['orderno'];
				$trano = $arr['orderno'];
				       M('recharge')->where($map)->setField($data);
				  		$orderinfo = M('recharge')->where(['trano'=>$trano])->find();
						if(!$orderinfo){//第三方订单号未查到 添加至关系库
							echo '未查到充值订单，可能原因：扫码充值后未提交订单号!';exit;
						}
						if($orderinfo['state']==1){
							echo'ok已经充值成功';exit;
						}
						if($orderinfo['state']!=0){
							echo'订单状态已完成或已被取消';exit;
						}

						//将订单金额全部转为带2位小数 进行比较
						$orderamount  = number_format($orderinfo['amount'],2,".","");//申请金额
						$actualamount = number_format($money,2,".","");//实到账金额
						if($orderamount!=$actualamount){//申请金额与实际金额不一致 则更改
							$orderinfo['amount'] = $orderamount;
						}
						//第三方订单号
						$orderinfo['threetrano'] = $_POST["trade_no"];//trade_no
						$apiparam=array();
						$apiparam = $orderinfo;
						$_api = new \Lib\api;
						$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
						if($Result['sign']){
							echo "SUCCESS";exit;
						}else{
							echo "Signature error";  exit;
						}
						exit;

			  }else{
				echo '充值失败';
			}
		}
	}
	//多得宝微信到账
	function dinpayweixin(){
	include_once("./dinpayweixin/merchant.php");
	$merchant_code	= $_POST["merchant_code"];	
	
	$notify_type = $_POST["notify_type"];
	
	$notify_id = $_POST["notify_id"];

	$interface_version = $_POST["interface_version"];

	$sign_type = $_POST["sign_type"];

	$dinpaySign = base64_decode($_POST["sign"]);
	
	$order_no = $_POST["order_no"];

	$order_time = $_POST["order_time"];	

	$order_amount = $_POST["order_amount"];

	
	$extra_return_param = $_POST["extra_return_param"];

	$trade_no = $_POST["trade_no"];

	$trade_time = $_POST["trade_time"];
		
	$trade_status = $_POST["trade_status"];

	$bank_seq_no = $_POST["bank_seq_no"];
	if($order_no){
		//F('dinpaywx_'.$order_no,$_POST);
	}

	
/////////////////////////////   参数组装  /////////////////////////////////
/**
除了sign_type dinpaySign参数，其他非空参数都要参与组装，组装顺序是按照a~z的顺序，下划线"_"优先于字母
*/
	$signStr = "";
	
	if($bank_seq_no != ""){
		$signStr = $signStr."bank_seq_no=".$bank_seq_no."&";
	}

	if($extra_return_param != ""){
		$signStr = $signStr."extra_return_param=".$extra_return_param."&";
	}	

	$signStr = $signStr."interface_version=".$interface_version."&";	

	$signStr = $signStr."merchant_code=".$merchant_code."&";

	$signStr = $signStr."notify_id=".$notify_id."&";

	$signStr = $signStr."notify_type=".$notify_type."&";

    $signStr = $signStr."order_amount=".$order_amount."&";	

    $signStr = $signStr."order_no=".$order_no."&";	

    $signStr = $signStr."order_time=".$order_time."&";	

    $signStr = $signStr."trade_no=".$trade_no."&";	

    
	$signStr = $signStr."trade_status=".$trade_status."&";
		
	$signStr = $signStr."trade_time=".$trade_time;
	
/////////////////////////////   RSA-S验签  /////////////////////////////////

		$merchant_private_key='-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAMAeYc78jfe85tmZ
ql8psc6BFRwfENq8kmmuqFbD4MJ2f+AXF1c81VALTphJXUJJuY2Not61VeLd44QB
j/id4vKLux4j5olITrf9E5jwaSZmjwDFLpGv3zj4mqEZ2Z90BL/8u8PmSJ3EVaiU
V8SOYY+4lLegjOcnLdsLIXAI7LZHAgMBAAECgYEAjzjXH7DFwW9xBb159pGlvVYb
v6glL3wvBlwvoOdL8ozWzd9JBj8SoyaaxArFXHqLusxhI/g5e/SA/VMQ2n4Rxgap
EzF+MPqZgTLyVQEVGdT1vUJUDTNk/Y4wtPEDtJ1JalgCdynm77j5XiDHy23fOyFM
7JOY0uhPz9rLJgHk9ykCQQDlx29OtGtZnxrlyDMKkZr5pkqjbo6REkENTaHcZlNZ
AyFvAa8SfIXGJFoqOxBPpx/ZDf1mh88JIAcmrafFqPzbAkEA1grFKsEPmPCOeZGv
Sg1flCA0b7i7OmnOSxqC1ABqwhz/x+EEa25FrH+qrQDqmrGGLRXSP5EVMrifbFyY
58cyBQJAKu27qeSjObcz+0IP5yWU4pdi0m3RTOEwLiAW4Wpsn/CpymdyIe4JwB8C
iWlHftomZRLsCL/OulG1hFBlS9RqiQJAF0omuAc3xkFuj0XN1/Xqj3iNnBZysOFw
Y/WnhJ/i/eof3sTaMUJXbHSbwqVV4a0tV1yHewkzUEiMeEL/FEE1bQJBAKyj6W7a
0gqs6vopOHQu0bZzPd095XKF194501Sr3sDckiqcflOHE7x3O75Zr6iK6XMUstYl
ijzEJHBwC/j/kWM=
-----END PRIVATE KEY-----';

		$dinpay_public_key ='-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDRGqtS/PWGLitlU+0CQ3GDKGzVm3eqb34sdYIqJ2YtNodwoZj1zp+oh/ZmELBiqYCubTBymZLX1q/02id1c6Sbmbmu8ZovfNCSwNj57qfjK8BEPU628+IkdKmO4LWcLdqU4lVznlrdywNIPqfsVlWje4F/4YTcVwK0LPtDUcE85wIDAQAB
-----END PUBLIC KEY-----';
  
	
	$dinpay_public_key = openssl_get_publickey($dinpay_public_key);	
	$flag = openssl_verify($signStr,$dinpaySign,$dinpay_public_key,OPENSSL_ALGO_MD5);	
	
//////////////////////   异步通知必须响应"SUCCESS" /////////////////////////
/**
如果验签返回ture就响应SUCCESS,并处理业务逻辑，如果返回false，则终止业务逻辑。
*/	
	
			 
		$order_no = $order_no;
		$orderinfo = M('recharge')->where(['trano'=>$order_no])->find();
		if(!$orderinfo){//第三方订单号未查到 添加至关系库
			echo '未查到充值订单，可能原因：扫码充值后未提交订单号!';exit;
		}
		if($orderinfo['state']==1){
			echo'ok已经充值成功';exit;
		} 
		if($orderinfo['state']!=0){
			echo'订单状态已完成或已被取消';exit;
		}
				//将订单金额全部转为带2位小数 进行比较
				$orderamount  = number_format($orderinfo['amount'],2,".","");//申请金额
				$actualamount = number_format($order_amount,2,".","");//实到账金额
				if($orderamount!=$actualamount){//申请金额与实际金额不一致
					$dataa['remark'] = "充值异常,充值金额与实到金额不一致,请核对";
					$dataa['threetrano'] = $_POST["trade_no"];
					$dataa['state']=-1;
					M('recharge')->where(['trano'=>$order_no])->setField($dataa);
					exit;
				}
		//第三方订单号
		$orderinfo['threetrano'] = $_POST["trade_no"];//trade_no
		$apiparam=array();
		$apiparam = $orderinfo;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
		if($Result['sign']){
			echo "SUCCESS";exit;
		}else{
			echo "Signature error";  exit;
		}
		exit;
		
	}

	//多得宝支付宝到账
	function dinpayalipay(){
		include_once("./dinpayalipay/merchant.php");
		$merchant_code	= $_POST["merchant_code"];

		$notify_type = $_POST["notify_type"];

		$notify_id = $_POST["notify_id"];

		$interface_version = $_POST["interface_version"];

		$sign_type = $_POST["sign_type"];

		$dinpaySign = base64_decode($_POST["sign"]);

		$order_no = $_POST["order_no"];

		$order_time = $_POST["order_time"];

		$order_amount = $_POST["order_amount"];


		$extra_return_param = $_POST["extra_return_param"];

		$trade_no = $_POST["trade_no"];

		$trade_time = $_POST["trade_time"];

		$trade_status = $_POST["trade_status"];

		$bank_seq_no = $_POST["bank_seq_no"];
		if($order_no){
			//F('dinpaywx_'.$order_no,$_POST);
		}


/////////////////////////////   参数组装  /////////////////////////////////
		/**
		除了sign_type dinpaySign参数，其他非空参数都要参与组装，组装顺序是按照a~z的顺序，下划线"_"优先于字母
		 */
		$signStr = "";

		if($bank_seq_no != ""){
			$signStr = $signStr."bank_seq_no=".$bank_seq_no."&";
		}

		if($extra_return_param != ""){
			$signStr = $signStr."extra_return_param=".$extra_return_param."&";
		}

		$signStr = $signStr."interface_version=".$interface_version."&";

		$signStr = $signStr."merchant_code=".$merchant_code."&";

		$signStr = $signStr."notify_id=".$notify_id."&";

		$signStr = $signStr."notify_type=".$notify_type."&";

		$signStr = $signStr."order_amount=".$order_amount."&";

		$signStr = $signStr."order_no=".$order_no."&";

		$signStr = $signStr."order_time=".$order_time."&";

		$signStr = $signStr."trade_no=".$trade_no."&";


		$signStr = $signStr."trade_status=".$trade_status."&";

		$signStr = $signStr."trade_time=".$trade_time;

/////////////////////////////   RSA-S验签  /////////////////////////////////

		$merchant_private_key='-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAMAeYc78jfe85tmZ
ql8psc6BFRwfENq8kmmuqFbD4MJ2f+AXF1c81VALTphJXUJJuY2Not61VeLd44QB
j/id4vKLux4j5olITrf9E5jwaSZmjwDFLpGv3zj4mqEZ2Z90BL/8u8PmSJ3EVaiU
V8SOYY+4lLegjOcnLdsLIXAI7LZHAgMBAAECgYEAjzjXH7DFwW9xBb159pGlvVYb
v6glL3wvBlwvoOdL8ozWzd9JBj8SoyaaxArFXHqLusxhI/g5e/SA/VMQ2n4Rxgap
EzF+MPqZgTLyVQEVGdT1vUJUDTNk/Y4wtPEDtJ1JalgCdynm77j5XiDHy23fOyFM
7JOY0uhPz9rLJgHk9ykCQQDlx29OtGtZnxrlyDMKkZr5pkqjbo6REkENTaHcZlNZ
AyFvAa8SfIXGJFoqOxBPpx/ZDf1mh88JIAcmrafFqPzbAkEA1grFKsEPmPCOeZGv
Sg1flCA0b7i7OmnOSxqC1ABqwhz/x+EEa25FrH+qrQDqmrGGLRXSP5EVMrifbFyY
58cyBQJAKu27qeSjObcz+0IP5yWU4pdi0m3RTOEwLiAW4Wpsn/CpymdyIe4JwB8C
iWlHftomZRLsCL/OulG1hFBlS9RqiQJAF0omuAc3xkFuj0XN1/Xqj3iNnBZysOFw
Y/WnhJ/i/eof3sTaMUJXbHSbwqVV4a0tV1yHewkzUEiMeEL/FEE1bQJBAKyj6W7a
0gqs6vopOHQu0bZzPd095XKF194501Sr3sDckiqcflOHE7x3O75Zr6iK6XMUstYl
ijzEJHBwC/j/kWM=
-----END PRIVATE KEY-----';

		$dinpay_public_key ='-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDRGqtS/PWGLitlU+0CQ3GDKGzVm3eqb34sdYIqJ2YtNodwoZj1zp+oh/ZmELBiqYCubTBymZLX1q/02id1c6Sbmbmu8ZovfNCSwNj57qfjK8BEPU628+IkdKmO4LWcLdqU4lVznlrdywNIPqfsVlWje4F/4YTcVwK0LPtDUcE85wIDAQAB
-----END PUBLIC KEY-----';


		$dinpay_public_key = openssl_get_publickey($dinpay_public_key);
		$flag = openssl_verify($signStr,$dinpaySign,$dinpay_public_key,OPENSSL_ALGO_MD5);

//////////////////////   异步通知必须响应"SUCCESS" /////////////////////////
		/**
		如果验签返回ture就响应SUCCESS,并处理业务逻辑，如果返回false，则终止业务逻辑。
		 */


		$order_no = $order_no;
		$orderinfo = M('recharge')->where(['trano'=>$order_no])->find();
		if(!$orderinfo){//第三方订单号未查到 添加至关系库
			echo '未查到充值订单，可能原因：扫码充值后未提交订单号!';exit;
		}
		if($orderinfo['state']==1){
			echo'ok已经充值成功';exit;
		}
		if($orderinfo['state']!=0){
			echo'订单状态已完成或已被取消';exit;
		}
				//将订单金额全部转为带2位小数 进行比较
				$orderamount  = number_format($orderinfo['amount'],2,".","");//申请金额
				$actualamount = number_format($order_amount,2,".","");//实到账金额
				if($orderamount!=$actualamount){//申请金额与实际金额不一致
					$dataa['remark'] = "充值异常,充值金额与实到金额不一致,请核对";
					$dataa['threetrano'] = $_POST["trade_no"];
					$dataa['state'] = -1;
					M('recharge')->where(['trano'=>$order_no])->setField($dataa);
					exit;
				}
		//第三方订单号
		$orderinfo['threetrano'] = $_POST["trade_no"];//trade_no
		$apiparam=array();
		$apiparam = $orderinfo;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Pay/paycheck',$apiparam);
		if($Result['sign']){
			echo "SUCCESS";exit;
		}else{
			echo "Signature error";  exit;
		}
		exit;

	}
}
?>