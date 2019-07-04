<?php
namespace Admincenter\Controller;
use Think\Controller;
class SystemController extends CommonController {
	public function __construct(){
		parent::__construct();
	}
	function theme(){
		$path = './Template/';
		$current_dir = opendir($path);
		while(($file = readdir($current_dir)) !== false) {
			$sub_dir = $path . DIRECTORY_SEPARATOR . $file;
			if($file == '.' || $file == '..') {
				continue;
			} else if(is_dir($sub_dir)) {
				$themes[] = $file;
			}
		}
		$themelist = [];
		foreach($themes as $k=>$v){
			$config = [];
			if(!is_file($path.$v.'/theme.php'))continue;
			$config = require $path.$v.'/theme.php';
			$themelist[] = [
				'title' => $config['title'],
				'name' => $v,
				'author' => $config['author'],
				'home' => $config['home'],
				'email' => $config['email'],
				'qq' => $config['qq'],
				'img' => is_file($path.$v.'/theme.png')?ltrim($path.$v.'/theme.png','.'):'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTEwYmJhZjQzYSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1MTBiYmFmNDNhIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA1NDY4NzUiIHk9Ijc0LjUiPjE0MHgxNDA8L3RleHQ+PC9nPjwvZz48L3N2Zz4=',
			];
		}
		$this->themelist = $themelist;
		$this->display();
	}
	function setting(){
		$setlist  = M('setting')->select();
		$newarray = [];
		foreach($setlist as $k=>$v){
			$newarray[$v['name']] = $v['value'];
		}
		$this->setlist = $newarray;
		$this->display();
	}
	function zengsong(){
		$setlist  = M('setting')->select();
		$newarray = [];
		foreach($setlist as $k=>$v){
			$newarray[$v['name']] = $v['value'];
		}
		$this->setlist = $newarray;
		$this->display();
	}
	
	function settingdo(){
		if(!IS_POST)$this->error('非法操作！');
		$param = $_POST['info'];
		/*需要验证数字的项*/
		$ValidNums = [
			'xtclirun'    =>'系统彩利润格式错误',
			'fanDianMax'  =>'返点最大值格式错误',
			'yuanfanDianMax'  =>'最大返点限制（元模式）格式错误',
			'jiaofanDianMax'  =>'最大返点限制（角模式）格式错误',
			'fenfanDianMax'  =>'最大返点限制（分模式）格式错误',
			'lifanDianMax'  =>'最大返点限制（厘模式）格式错误',
			'touzhuMax'  =>'最大投注格式错误',
			'zhongjiangMax'  =>'最大中奖格式错误',
			'chongzhiMin'  =>'充值限制（最低金额）格式错误',
			'chongzhiMax'  =>'充值限制（最高金额）格式错误',
			'damaliang'  =>'提款限制（打码量）格式错误',
			'tikuanMin'  =>'提款限制（最低提款）格式错误',
			'tikuanMax'  =>'提款限制（最高提款）格式错误',
			'tikuannum'  =>'每日提款次数格式错误',
			'paiduinum'  =>'提款排队人数格式错误',
			'clearamountmin'  =>'账号清理规则（账户金额低于）格式错误',
			'clearamountday'  =>'账号清理规则（账户金额低于 -> N天未登录）格式错误',
			'clearamountday0'  =>'账号清理规则（从未充值 -> N天未登录）格式错误',
			'clearopen'  =>'清理开奖数据（清理N天前的开奖）格式错误',
			'cleartouzhu'  =>'清理投注数据（清理N天前的投注）格式错误',
			'pointchongzhi'  =>'积分规则（每充值N元）格式错误',
			'pointchongzhiadd'  =>'积分规则（每充值N元 -> 增加N积分）格式错误',
			'pointtouzhu'  =>'积分规则（每投注N元）格式错误',
			'pointtouzhuadd'  =>'积分规则（每投注N元 -> 增加N积分）格式错误',
			'pointhuisun'  =>'积分规则（每亏损N元）格式错误',
			'pointhuisunadd'  =>'积分规则（每亏损N元 -> 增加N积分）格式错误',
			'newregamount'  =>'新注册用户赠送本人N元格式错误',
			'bindcardamount'  =>'新注册绑定银行账户赠送N元格式错误',
			'newmemberrecharge'  =>'新注册用户首次充值满N元赠送格式错误',
			'newmemberrechargeamount'  =>'新注册用户首次充值满N元 -> 赠送N元格式错误',
			'riCommissionBase0_1'  =>'每日消费赠送（1）本人赠送 格式错误',
			'riCommissionBase0_2'  =>'每日消费赠送（1）上家赠送 格式错误',
			'riCommissionBase1_1'  =>'每日消费赠送（2）本人赠送 格式错误',
			'riCommissionBase1_2'  =>'每日消费赠送（2）上家赠送 格式错误',
			'riCommissionBase2_1'  =>'每日消费赠送（3）本人赠送 格式错误',
			'riCommissionBase2_2'  =>'每日消费赠送（3）上家赠送 格式错误',
			'riCommissionBase3_1'  =>'每日消费赠送（4）本人赠送 格式错误',
			'riCommissionBase3_2'  =>'每日消费赠送（4）上家赠送 格式错误',
			'riCommissionBase4_1'  =>'每日消费赠送（5）本人赠送 格式错误',
			'riCommissionBase4_2'  =>'每日消费赠送（5）上家赠送 格式错误',
			'riCommissionBase5_1'  =>'每日消费赠送（6）本人赠送 格式错误',
			'riCommissionBase5_2'  =>'每日消费赠送（6）上家赠送 格式错误',
			
			'yueCommissionBase0_1'  =>'每月消费赠送（1）本人赠送 格式错误',
			'yueCommissionBase0_2'  =>'每月消费赠送（1）上家赠送 格式错误',
			'yueCommissionBase1_1'  =>'每月消费赠送（2）本人赠送 格式错误',
			'yueCommissionBase1_2'  =>'每月消费赠送（2）上家赠送 格式错误',
			'yueCommissionBase2_1'  =>'每月消费赠送（3）本人赠送 格式错误',
			'yueCommissionBase2_2'  =>'每月消费赠送（3）上家赠送 格式错误',
			'yueCommissionBase3_1'  =>'每月消费赠送（4）本人赠送 格式错误',
			'yueCommissionBase3_2'  =>'每月消费赠送（4）上家赠送 格式错误',
			'yueCommissionBase4_1'  =>'每月消费赠送（5）本人赠送 格式错误',
			'yueCommissionBase4_2'  =>'每月消费赠送（5）上家赠送 格式错误',
			'yueCommissionBase5_1'  =>'每月消费赠送（6）本人赠送 格式错误',
			'yueCommissionBase5_2'  =>'每月消费赠送（6）上家赠送 格式错误',
			
			'riKuisunBase0_1'  =>'日亏损赠送活动（1）本人赠送 格式错误',
			'riKuisunBase0_2'  =>'日亏损赠送活动（1）上家赠送 格式错误',
			'riKuisunBase1_1'  =>'日亏损赠送活动（2）本人赠送 格式错误',
			'riKuisunBase1_2'  =>'日亏损赠送活动（2）上家赠送 格式错误',
			'riKuisunBase2_1'  =>'日亏损赠送活动（3）本人赠送 格式错误',
			'riKuisunBase2_2'  =>'日亏损赠送活动（3）上家赠送 格式错误',
			'riKuisunBase3_1'  =>'日亏损赠送活动（4）本人赠送 格式错误',
			'riKuisunBase3_2'  =>'日亏损赠送活动（4）上家赠送 格式错误',
			'riKuisunBase4_1'  =>'日亏损赠送活动（5）本人赠送 格式错误',
			'riKuisunBase4_2'  =>'日亏损赠送活动（5）上家赠送 格式错误',
			'riKuisunBase5_1'  =>'日亏损赠送活动（6）本人赠送 格式错误',
			'riKuisunBase5_2'  =>'日亏损赠送活动（6）上家赠送 格式错误',
			
			'yueKuisunBase0_1'  =>'月亏损赠送活动（1）本人赠送 格式错误',
			'yueKuisunBase0_2'  =>'月亏损赠送活动（1）上家赠送 格式错误',
			'yueKuisunBase1_1'  =>'月亏损赠送活动（2）本人赠送 格式错误',
			'yueKuisunBase1_2'  =>'月亏损赠送活动（2）上家赠送 格式错误',
			'yueKuisunBase2_1'  =>'月亏损赠送活动（3）本人赠送 格式错误',
			'yueKuisunBase2_2'  =>'月亏损赠送活动（3）上家赠送 格式错误',
			'yueKuisunBase3_1'  =>'月亏损赠送活动（4）本人赠送 格式错误',
			'yueKuisunBase3_2'  =>'月亏损赠送活动（4）上家赠送 格式错误',
			'yueKuisunBase4_1'  =>'月亏损赠送活动（5）本人赠送 格式错误',
			'yueKuisunBase4_2'  =>'月亏损赠送活动（5）上家赠送 格式错误',
			'yueKuisunBase5_1'  =>'月亏损赠送活动（6）本人赠送 格式错误',
			'yueKuisunBase5_2'  =>'月亏损赠送活动（6）上家赠送 格式错误',
			
			'loginerrornum'  =>'后台登录最大失败次数格式错误',
			'loginerrorclosetime'  =>'后台登录最大失败次数 -> 禁止登陆N小时 格式错误',
			'adminemailcodetime' =>'后台邮件验证码过期时间必须为数字格式',
		];
		foreach($param as $k=>$v){
			$k = trim($k);
			
			if($ValidNums[$k]){
				if(!is_numeric($v) && $v){
					$this->error($ValidNums[$k]);exit;
				}
				$param[$k] = floatval($v);
			}
			$data = [];
			$data['name']  = $k;
			$data['value'] = $param[$k];
			//dump($data);
			if(!M('setting')->where(['name'=>$data['name']])->find()){
				$ints[] = M('setting')->data($data)->add();
			}else{
				$ints[] = M('setting')->where(['name'=>$data['name']])->setField(['value'=>$data['value']]);
			}
		}
		count(array_filter($ints))>=1?$this->success('配置保存成功！'):$this->error('配置保存失败！');
	}




	
}