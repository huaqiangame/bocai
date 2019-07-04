<?php
namespace Payer\Controller;
use Think\Controller;
class PayController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
	function saoma(){
		/*$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo'请先登陆';exit;
		}*/
		$host = urldecode(I('host'));
		$host = $host?$host:"http://".$_SERVER['SERVER_NAME'];
		$trano   = I('trano');
		$payinfo = F($trano,'','./PayOrder/');
		if(!$payinfo){
			echo'充值订单已失效';exit;
		}
		/*if($payinfo['uid']!=$auth_id){
			echo'非法操作订单';exit;
		}*/
		if(!in_array($payinfo['paytype'],['alipay','tenpay','weixin'])){
			echo'ERROR';exit;
		}
		$_tpl = T($payinfo['paytype']);
		if(!is_file($_tpl)){
			echo'扫码模版错误';exit;
		}
		$this->assign('host',$host);
		$this->assign('payhost',C('payhost'));
		$this->assign('payinfo',$payinfo);
		$this->display($_tpl);
	}
	function japay(){
		$type  = I('type');
		$trano = I('trano');
		$payinfo = F($trano,'','./PayOrder/');
		if(!$payinfo){
			echo'充值订单已失效';exit;
		}
		if(!in_array($type,['alipay','weixin'])){
			echo'ERROR';exit;
		}
		$_tpl = './japay/tpl/'.$type.'.html';
		if(!is_file($_tpl)){
			echo'扫码模版错误';exit;
		}
		$codepic = RUNTIME_PATH .'/qrcode/'.$payinfo['trano'].'.png';
		if(!is_file($codepic)){
			echo'二维码不存在';exit;
		}
		$this->assign('payinfo',$payinfo);
		$this->assign('codepic',$codepic);
		
		$this->display($_tpl);
	}
	function onlinebank(){
		/*$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo'请先登陆';exit;
		}*/
		
		//来路域名
		//$inurl       = $_SERVER["HTTP_REFERER"];
		//$instr   = str_replace("http://","",$inurl);
		//$strdomain = explode("/",$instr);
		//$indomain    = 'http://'.$strdomain[0];
		    // $fag = is_mobile();
      //     if($fag){
		    //  $tiaohost = 'http://jkkf999.com';	
      //     }else{
		    //  $tiaohost = 'http://h5.jkkf999.com';
      //     }

		$host = urldecode(I('host'));
		$host = $host?"http://".$host:"http://".$_SERVER['SERVER_NAME']; 
		$trano   = strip_tags($_REQUEST['trano']);
		$payinfo = M('recharge')->where(['trano'=>$trano])->find();

		if(!$payinfo){
			echo'充值订单已失效';exit;
		}
		//dump($payinfo);exit;
		//dump($payinfo);
		/*if($payinfo['uid']!=$auth_id){
			echo'非法操作订单';exit;
		}*/
		$paytype = $payinfo['paytype'];
		$bankpaylists = C('bankpaylists');
		$configs = $bankpaylists[$paytype]["configs"];
			switch($payinfo['paytype']){
			case 'jifubaopay':
				require("./jifubaopay/jifubaopay.php");
				$_payobj = new \jifubaopay();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				echo $returnjump;
				break;
			case 'mobaopay':
				require("./mobaopay/mobaopay.php");
				$_payobj = new \mobaopay();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				echo $returnjump;
				break;
			case 'dinpay':
				require("./dinpay/dinpay.php");
				$_payobj = new \dinpay();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				echo $returnjump;
				break;
			case 'dinpayweixin':
				require("./dinpayweixin/dinpayweixin.php");
				$_payobj = new \dinpayweixin();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				$html  = '';
				$html .= '<script type="text/javascript" src="/resources/js/jquery-1.9.1.min.js"></script>'."\n";
				$html .= '<script> '."\n";
				$html .= 'checkispay()'."\n";
				$html .= 'var checkispayid;'."\n";
				$html .= 'function checkispay(){'."\n";
				$html .= 'clearTimeout(checkispayid);'."\n";
				$html .= '$.ajax({ '."\n";
				$html .= 'url:"'.$host.'/Apijiekou.checkrechargeisok", '."\n";
				$html .= 'type:"post", '."\n";
				$html .= 'data:{ trano: "'.$trano.'", t: Math.random() }, '."\n";
				$html .= 'dataType:"jsonp",'."\n";
				$html .= 'jsonpCallback:"flightHandler",'."\n";
				$html .= 'success: function(result){ '."\n";
				$html .= 'if (result.sign == true) {'."\n";
				$html .= 'if(result.state!=0){'."\n";
				$html .= 'if(result.state==1){'."\n";
				$html .= 'alert("充值成功");'."\n";
				$html .= '}else if(result.state==-1){'."\n";
				$html .= 'alert("充值失败");'."\n";
				$html .= '}'."\n";
				$html .= 'window.location.href = "'.$host.'/Account.dealRecord.do";'."\n";
				$html .= '}else{'."\n";
				$html .= 'checkispayid = setTimeout(function () {'."\n";
				$html .= 'checkispay();'."\n";
				$html .= '}, 5000);	'."\n";			
				$html .= '}'."\n";
				$html .= '}'."\n";
				$html .= '} '."\n";
				$html .= '}); '."\n";
				$html .= '}; '."\n";
				$html .= '</script>'."\n";
				echo $returnjump.$html;
				break;
			case 'dinpayalipay':
				require("./dinpayalipay/dinpayalipay.php");
				$_payobj = new \dinpayalipay();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				$html  = '';
				$html .= '<script type="text/javascript" src="/resources/js/jquery-1.9.1.min.js"></script>'."\n";
				$html .= '<script> '."\n";
				$html .= 'checkispay()'."\n";
				$html .= 'var checkispayid;'."\n";
				$html .= 'function checkispay(){'."\n";
				$html .= 'clearTimeout(checkispayid);'."\n";
				$html .= '$.ajax({ '."\n";
				$html .= 'url:"'.$host.'/Apijiekou.checkrechargeisok", '."\n";
				$html .= 'type:"post", '."\n";
				$html .= 'data:{ trano: "'.$trano.'", t: Math.random() }, '."\n";
				$html .= 'dataType:"jsonp",'."\n";
				$html .= 'jsonpCallback:"flightHandler",'."\n";
				$html .= 'success: function(result){ '."\n";
				$html .= 'if (result.sign == true) {'."\n";
				$html .= 'if(result.state!=0){'."\n";
				$html .= 'if(result.state==1){'."\n";
				$html .= 'alert("充值成功");'."\n";
				$html .= '}else if(result.state==-1){'."\n";
				$html .= 'alert("充值失败");'."\n";
				$html .= '}'."\n";
				$html .= 'window.location.href = "'.$host.'/Account.dealRecord.do";'."\n";
				$html .= '}else{'."\n";
				$html .= 'checkispayid = setTimeout(function () {'."\n";
				$html .= 'checkispay();'."\n";
				$html .= '}, 5000);	'."\n";			
				$html .= '}'."\n";
				$html .= '}'."\n";
				$html .= '} '."\n";
				$html .= '}); '."\n";
				$html .= '}; '."\n";
				$html .= '</script>'."\n";
				echo $returnjump.$html;
				break;
          case 'xlb':
				require("./xlb/xlb.php");
				$_payobj = new \xlb();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				echo $returnjump;
				break;
			case 'weixinvpay':
				require("./vpay/weixinvpay.php");
				$_payobj = new \weixinvpay();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				echo $returnjump;
				break;
			case 'alipayvpay':
				require("./vpay/alipayvpay.php");
				$_payobj = new \alipayvpay();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				echo $returnjump;
				break;
			case 'japayalipay':
				require("./japay/japayalipay.php");
				$_payobj = new \japayalipay();
				$returnarray = $_payobj->get_code($payinfo,$configs,$host);
				if($returnarray && $returnarray['respCode']=='00'){
					if(!is_dir(RUNTIME_PATH .'/qrcode/')) {
						mkdir(RUNTIME_PATH .'/qrcode/', 0777, true);
					}
					qrcode($returnarray['barCode'],RUNTIME_PATH .'/qrcode/'.$payinfo['trano'].'.png');
					redirect(U('Pay/japay',['type'=>'alipay','trano'=>$payinfo['trano']]));
				}
				//echo $returnjump;
				break;
			case 'japayweixin':
				require("./japay/japayweixin.php");
				$_payobj = new \japayweixin();
				$returnarray = $_payobj->get_code($payinfo,$configs,$host);
				if($returnarray && $returnarray['respCode']=='00'){
					if(!is_dir(RUNTIME_PATH .'/qrcode/')) {
						mkdir(RUNTIME_PATH .'/qrcode/', 0777, true);
					}
					qrcode($returnarray['barCode'],RUNTIME_PATH .'/qrcode/'.$payinfo['trano'].'.png');
					redirect(U('Pay/japay',['type'=>'weixin','trano'=>$payinfo['trano']]));
				}
				//echo $returnjump;
				break;
			case 'japaybank':
				require("./japay/japaybank.php");
				$_payobj = new \japaybank();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				echo $returnjump;
				break;
			case 'mobaobank':
				require("./MbPay/mobaobank.php");
				$_payobj = new \mobaobank();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host,1);
				echo $returnjump;
				break;
			case 'mobaoalipay':
				require("./MbPay/mobaobank.php");
				$_payobj = new \mobaobank();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host,4);
				echo $returnjump;
				break;
			case 'mobaoweixin':
				require("./MbPay/mobaobank.php");
				$_payobj = new \mobaobank();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host,5);
				echo $returnjump;
				break;
			case 'epay':
				require("./epay/epay.php");
				$_payobj = new \epay();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host,5);
				echo $returnjump;
				break;
			case 'r1payalipay':
				require("./r1pay/r1payalipay.php");
				$_payobj = new \r1payalipay();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				echo $returnjump;
				break;
			case 'r1payweixin':
				require("./r1pay/r1payweixin.php");
				$_payobj = new \r1payweixin();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				echo $returnjump;
				break;
			case 'ipaybank':
				require("./ipay/ipaybank.php");
				$_payobj = new \ipaybank();
				$returnjump = $_payobj->get_code($payinfo,$configs,$host);
				echo $returnjump;
				break;
		}
	}
	
	
}
?>