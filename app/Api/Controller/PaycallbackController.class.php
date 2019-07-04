<?php
namespace Api\Controller;
use Think\Controller;
class PaycallbackController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
	function alitenwx(){
		$ddh    = trim(htmlspecialchars($_POST['ddh'])); //支付宝交易号
		$money  = trim(htmlspecialchars($_POST['money'])); //付款金额
		$name   = trim(htmlspecialchars($_POST['name']));   //付款说明,可以是用户名或用户ID或订单号，该参数由index.html付款时由用户输入
		$key    = trim(htmlspecialchars($_POST['key'])); //密钥
		$name   = str_replace('uid','',$name);//去掉付款说明的空格
		$pay    = intval($_POST['pay']);
		if(!in_array($pay,[1,2,3])){
			echo '非法操作!';exit;
		}
		$keykey = '168szb262589546';

		//集成方法模拟name的值区分是那个用户充值的更新数据库即可
		//post.php为接收软件提交的参数 如：http://127.0.0.1/post.php  密钥 168szb262589546


		if($key == $key){
			$map = [];
			$map['fuyanma'] = $name;
			if($_POST && $_POST['ddh']){
				$threetdata = [];
				$threetdata['threetrano'] = $ddh;
				$threetdata['amount']     = $money;
				$threetdata['oddtime']    = time();
				switch($pay){
					case 1:
						$threetdata['paytype']    = 'alipay';
						break;
					case 2:
						$threetdata['paytype']    = 'tenpay';
						break;
					case 3:
						$threetdata['paytype']    = 'weixin';
						break;
					default:
						$threetdata['paytype']    = 'undefined';
				}
				$paytype = $threetdata['paytype'];
				$orderinfo = M('recharge')->where(['threetrano'=>$ddh,'paytype'=>$paytype])->find();
				if(!$orderinfo){//第三方订单号未查到 添加至关系库
					/*if(!M('czddh')->where(['threetrano'=>$ddh])->find()){
						M('czddh')->data($threetdata)->add();
					}*/
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
					$orderinfo['amount'] = $actualamount;
					M('recharge')->where(['id'=>$orderinfo['id']])->setField(['amount'=>$actualamount]);
				}
				
				$return = userrechargepay($orderinfo);
				if($return==0){
					echo'充值参数非法';exit;
				}elseif($return==1){
					echo'ok充值成功ok';exit;
				}elseif($return==-1){
					echo'充值订单已经取消';exit;
				}else{
					echo'充值失败2';exit;
				}
			}else{
				echo'非法操作';exit;
			}
			//$payinfo = M('recharge')->where(['fuyanma'=>])->find();
		}else{
			echo '密钥错误no!';
		}
	}
}