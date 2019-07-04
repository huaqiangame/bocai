<?php
namespace Api\Controller;
use Think\Controller\HproseController;
class PayController extends CommonController {
	protected $allowMethodList =    array(
	'paycheck',
	);
	function checkislogin($apiparam=array()){
		$apiparam = _cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$apiparam = checklogin($apiparam);
		return $apiparam;
	}
	function paycheck($apiparam=array()){
		$apiparam = self::_cheacktoken($apiparam);
		if(!$apiparam['sign'])return $apiparam;
		$uid      = $apiparam['uid'];
		$username = $apiparam['username'];
		$paytype  = $apiparam['paytype'];
		$trano    = $apiparam['trano'];
		$amount   = $apiparam['amount'];
		$id = $apiparam['id'];
		$payinfo = M('recharge')->where(['trano'=>$trano,'paytype'=>$paytype])->find();
		if($payinfo['uid']!=$uid){
			$apiparam['sign']=false;
			$apiparam['message']='充值用户ID校验错误';
			return $apiparam;exit;
		}
		if($payinfo['state']!=0){
			$apiparam['sign']=false;
			$apiparam['message']='充值状态已经修改';
			return $apiparam;exit;
		}
		if($apiparam['threetrano'])$payinfo['threetrano'] = $apiparam['threetrano'];
		$return = userrechargepay($payinfo);
		if($return==0){
			$apiparam['sign']=false;
			$apiparam['message']='充值参数非法';
			return $apiparam;exit;
		}elseif($return==1){
			$apiparam['sign']=true;
			$apiparam['message']='ok充值成功ok';
			return $apiparam;exit;
		}elseif($return==-1){
			$apiparam['sign']=false;
			$apiparam['message']='充值订单已经取消';
			return $apiparam;exit;
		}else{
			$apiparam['sign']=false;
			$apiparam['message']='充值失败2';
			return $apiparam;exit;
		}
		$apiparam['sign']=false;
		return $apiparam;exit;
	}

    /*********************************************聚瑞支付********************************************/
    public function jrpay($data){

        $notify_url = "http://".$_SERVER['HTTP_HOST']."/index/pay/notify_jrpay";   //服务端返回地址
        $return_url = "http://".$_SERVER['HTTP_HOST']."/index/user/index";  //页面跳转返回地址
        $signData['MerchantCode'] = 'SH-CODE2018072716524510016';
        $signData['OrderCode'] = $data['trano']; // 商户订单号
        $signData['PayType'] = 2; // 商户订单号
        $signData['OrderMoney'] = $data['amount']; // 单位（元），确保两位小数
        $signData['CallbackUrl'] = $notify_url;
        $signData['OrderTime'] = date('YmdHis'); // 请求时间
        $signData['OrderName'] = "充值" . $data['amount'] . "元";


        $keys = array_keys($signData);
        $t = array_map(function($key, $value){
            return $key . '=' . $value;
        }, $keys, $signData);
        $signStr=join('&', $t);

        $signStr = $signStr . '&Key=23236c95-746c-4610-9e9f-68d80f75ed16';
        $signData['SignMsg'] = md5($signStr);
        $signData['ReturnUrl'] = $return_url;
        $url = "http://www.wtczjg.com/PayApi/Gateway";

        $re_data['postData'] = $signData;



        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') === false||$data['pay_type']=='jrpay2') {
            // 非微信浏览器
            $form = '<form class="form-inline" method="post" action="'.$url.'">';
            foreach ($signData as $key => $val) {
                $form.='<input type="hidden" name="' . $key . '" value="' . $val . '">';
            }
            $form.='</form>';
        } else {
            // 微信浏览器
            $form = '<form id="payform" class="form-inline" method="post" action="'.$url.'">';
            foreach ($signData as $key => $val) {
                $form.='<input type="hidden" name="' . $key . '" value="' . $val . '">';
            }
            $form.='</form>';
            $html = time().rand(1000,9999);
            file_put_contents('./public/qdpay/'.$html.'.txt',$form);
            //header('location:/index/user/browseropen?html='.$form);
            $form1 = '<form class="form-inline" method="post" action=\'/browseropen.php?html='.$html.'\'>';

            //$form1.='<input type="hidden" name="html" value="' . $form . '">';
            $form1.='</form>';
            $form = $form1;
        }
        return $form;exit;


    }
    //回调
    public function notify_jrpay(){

        $return_data = $_REQUEST;
        $orderNo = $return_data['orderNo'];
        $traceNo = $return_data['reqId'];
        $ret = $return_data['payResult'];
        $signMsg=$return_data['signMsg'];
        if (empty($orderNo) or empty($traceNo) or !isset($ret)) {
            //异步请求数据格式不正确;
            exit;
        }
        unset($return_data['signMsg']);


        $keys = array_keys($return_data);
        $t = array_map(function($key, $value){
            return $key . '=' . $value;
        }, $keys, $return_data);
        $signStr=join('&', $t);

        $signStr = $signStr . '&Key=23236c95-746c-4610-9e9f-68d80f75ed16';
        $signData = md5($signStr);


        if ($signMsg != md5($signData)) {
            exit;
        }

        $this->notify_ok_dopay($orderNo,$return_data['amount']);
        exit("ok");

    }
    /*********************************************骏付通支付********************************************/
    public function jftpay($data){
        $paytypeinfo = M('payset')->where(['paytype'=>$data['paytype']])->find();
        $configs = unserialize($paytypeinfo['configs']);
        unset($paytypeinfo['configs']);
        $paytypeinfo = array_merge($paytypeinfo,$configs);

        $merchantid=$paytypeinfo['merchantid'];//商户ID
        $merchantkey=$paytypeinfo['merchantkey1'];//商户密钥
        $url=$paytypeinfo['redirecturl'];//网关地址
        // 1. 请求下单以后，当平台数据验证通过会返回交易流水号
        $compkey = $merchantkey;        //商户密钥
        $signData['p1_yingyongnum'] = $merchantid;//商户在竣付通平台的应用 ID。
        $signData['p2_ordernumber'] = $data['trano'];//用户订单号
        $signData['p3_money'] = $data['amount'];//订单金额。
        $signData['p6_ordertime'] = date('YmdHis');//商户订单创建时间。格式 yyyymmddhhmmss。 如 20170919105912。

        switch($data['paytype']){
            case 'jftpayysf':
                $productcode    = 'YSF';
                break;
            case 'jftpaywx':
                $productcode    = 'WX';
                break;
            case 'jftpayzfb':
                $productcode    = 'ZFB';
                break;
        }

        $signData['p7_productcode'] = $productcode;//终端支付方式，固定值“YSF”。
        $presign = $signData['p1_yingyongnum'] . "&" . $signData['p2_ordernumber'] . "&" . $signData['p3_money'] . "&" . $signData['p6_ordertime'] . "&" . $signData['p7_productcode'] . "&" . $compkey;
        $signData['p8_sign'] = md5($presign);    //参数签名。目前只支持 MD5 方式，大小写均可
        $signData['p14_customname'] = $data['username'];//付款人在商户系统中的帐号。
        $signData['p16_customip'] = str_replace('.', '_', $this->get_client_ip());//付款人 ip 地址，规定以 192_168_0_253 格式

        $signData['p25_terminal'] = $this->get_device_type();//终端设备类型，可选值 1、2、3 1 代表 pc 2 代表 ios 3 代表 android。

        if ($productcode == 'WX' || $productcode == 'ZFB') {
            $signData['paytype'] = 'ZZ';
        }
        $signData['p26_ext1'] = "1.1";//商户标识:1.1

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') === false) {
            // 非微信浏览器
            $form = '<form class="form-inline" method="post" action="'.$url.'">';
            foreach ($signData as $key => $val) {
                $form.='<input type="hidden" name="' . $key . '" value="' . $val . '">';
            }
            $form.='</form>';
        } else {
            // 微信浏览器
            $form = '<form id="payform" class="form-inline" method="post" action="'.$url.'">';
            foreach ($signData as $key => $val) {
                $form.='<input type="hidden" name="' . $key . '" value="' . $val . '">';
            }
            $form.='</form>';
            $html = time().rand(1000,9999);
            file_put_contents('./public/qdpay/'.$html.'.txt',$form);
            //header('location:/index/user/browseropen?html='.$form);
            $form1 = '<form class="form-inline" method="post" action=\'/browseropen.php?html='.$html.'\'>';

            //$form1.='<input type="hidden" name="html" value="' . $form . '">';
            $form1.='</form>';
            $form = $form1;
        }
        return $form;exit;


    }
    //回调
    public function notify_jftpay(){
        $return_data = $_REQUEST;
        $orderinfo = M('recharge')->where(['trano'=>$return_data['p2_ordernumber']])->find();

        if(!$orderinfo){
            echo '未查到充值订单，可能原因：扫码充值后未提交订单号!';exit;
        }

        $paytypeinfo = M('payset')->where(['paytype'=>$orderinfo['paytype']])->find();
        $configs = unserialize($paytypeinfo['configs']);
        unset($paytypeinfo['configs']);
        $paytypeinfo = array_merge($paytypeinfo,$configs);
        $merchantkey=$paytypeinfo['merchantkey1'];//商户密钥

        file_put_contents('msg.txt', var_export($return_data, true) . PHP_EOL, FILE_APPEND);

        $compkey = $merchantkey;

        $p1_yingyongnum = $return_data['p1_yingyongnum'];//商户在竣付通平台的应用 ID。
        $p2_ordernumber = $return_data['p2_ordernumber'];//商户提交的订单号。
        $p3_money = $return_data['p3_money'];//交易金额
        $p4_zfstate = $return_data['p4_zfstate'];//(必须)支付返回结果 1 代表成功，其他 为失败。
        $p5_orderid = $return_data['p5_orderid'];//返回竣付通的订单号
        $p6_productcode = $return_data['p6_productcode'];//订单的支付方式
        $p7_bank_card_code = $return_data['p7_bank_card_code'];
        $p8_charset = $return_data['p8_charset'];//商户提交订单时候传递的编码格
        $p9_signtype = $return_data['p9_signtype'];//签名验证方式
        $p10_sign = $return_data['p10_sign'];//格式为 32 位大写字符串
        $p11_pdesc = $return_data['p11_pdesc'];//备注，原样返回用户提交的 p20_pdesc 信息
        $p12_remark = $return_data['p12_remark'];//备注，原样返回用户提交的 p24_remark 信息
        $p13_zfmoney = $return_data['p13_zfmoney'];//实际支付金额，保留两位小数

        $presign = $p1_yingyongnum . "&" . $p2_ordernumber . "&" . $p3_money . "&" . $p4_zfstate . "&" . $p5_orderid . "&" . $p6_productcode . "&" . $p7_bank_card_code . "&" . $p8_charset . "&" . $p9_signtype . "&" . $p11_pdesc . "&" . $p13_zfmoney . "&" . $compkey;
        $sign = strtoupper(md5($presign));
        if (empty($p2_ordernumber) ) {
            //异步请求数据格式不正确;
            exit;
        }
        if ($sign == $p10_sign && $p4_zfstate == "1") {
            $this->notify_ok_dopay($p2_ordernumber,$p3_money);
            exit("success");
        }

    }
    function notify_ok_dopay($order_no,$order_amount)
    {
        $orderinfo = M('recharge')->where(['trano'=>$order_no])->find();
        if(!$orderinfo){
            echo '未查到充值订单，可能原因：扫码充值后未提交订单号!';exit;
        }
        if($orderinfo['state']==1){
            echo'success';exit;
        }
        if($orderinfo['state']!=0){
            echo'订单状态已完成或已被取消';exit;
        }
        //将订单金额全部转为带2位小数 进行比较
        $orderamount  = number_format($orderinfo['amount'],2,".","");//申请金额
        $actualamount = number_format($order_amount,2,".","");//实到账金额


        if($orderamount!=$actualamount){//申请金额与实际金额不一致 则更改
            $orderinfo['amount'] = $actualamount;
            M('recharge')->where(['id'=>$orderinfo['id']])->setField(['amount'=>$actualamount]);
        }
        $return = userrechargepay($orderinfo);
        if($return==0){
            echo'充值参数非法';exit;
        }elseif($return==1){
            echo'success';exit;
        }elseif($return==-1){
            echo'充值订单已经取消';exit;
        }else{
            echo'充值失败2';exit;
        }


    }
    function get_client_ip($type = 0, $adv = false)
    {
        $type = $type ? 1 : 0;
        static $ip = NULL;
        if ($ip !== NULL) return $ip[$type];
        if ($adv) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos = array_search('unknown', $arr);
                if (false !== $pos) unset($arr[$pos]);
                $ip = trim($arr[0]);
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u", ip2long($ip));
        $ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }

    function get_device_type()
    {

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
            return 2;
        } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Android')) {
            return 3;
        } else {
            return 1;
        }
    }
}