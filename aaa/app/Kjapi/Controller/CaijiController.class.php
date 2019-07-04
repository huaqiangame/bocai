<?php

//decode by http://www.yunlu99.com/
namespace Kjapi\Controller;

error_reporting(E_ALL ^ E_NOTICE);
use Think\Controller;
class CaijiController extends CommonController
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getapiurl()
	{
		$_var_0 = GetVar('caijieapiurl');
		echo $_var_0;
	}
	function caiji()
	{
		if (!IS_POST) {
			echo 'IS NOT CMD_CLI,ERROR...';
			exit;
		}
		$_var_1 = M('caipiao')->cache(true, 10)->field('name,title')->select();
		foreach ($_var_1 as $_var_2 => $_var_3) {
			$_var_4[$_var_3['name']] = $_var_3;
		}
		if (IS_POST && $_POST['oplist']) {
			$_var_5 = $_POST['oplist'];
			$_var_6 = [];
			foreach ($_var_5 as $_var_2 => $_var_7) {
				if ($_var_7['name'] && $_var_4[$_var_7['name']] && $_var_7['expect'] && $_var_7['opencode']) {
					$_var_8 = $_var_7['name'];
					$_var_9 = 0;
					$_var_10 = [];
					$_var_10['name'] = $_var_7['name'];
					$_var_10['title'] = $_var_4[$_var_7['name']]['title'];
					$_var_10['expect'] = $_var_7['expect'];
					$_var_10['opencode'] = $_var_7['opencode'];
					$_var_10['addtime'] = time();
					$_var_10['opentime'] = $_var_7['opentimestamp'];
					$_var_10['isdraw'] = 0;
					if (!M('kaijiang')->where(['name' => $_var_8, 'expect' => $_var_7['expect']])->find()) {
						$_var_9 = M('kaijiang')->data($_var_10)->add();
						if ($_var_9) {
							$_var_6[] = $_var_7['expect'] . '-' . $_var_7['opencode'];
						}
					}
				}
			}
		}
		if (count($_var_6) >= 1) {
			$_var_11 = current($_var_6);
			F('last_' . $_var_8, $_var_11);
			echo '更新成功：' . implode(';', $_var_6);
			exit;
		} else {
			$_var_12 = F('last_' . $_var_8);
			echo '最后更新：' . $_var_12;
			exit;
		}
	}
	function checkkj()
	{
		if (!IS_POST) {
		}
		$_var_13 = M('kaijiang');
		$_var_14 = M('touzhu');
		$_var_15 = M('member');
		$_var_16 = M('fuddetail');
		$_var_17 = null;
		$_var_17 = $_var_13->where(['isdraw' => 0])->order('id desc')->find();
		$_var_18 = '';
		if (!$_var_17) {
			$_var_18 = '没有开奖信息';
		} else {
			$_var_19 = null;
			$_var_19 = M('caipiao')->where(['name' => $_var_17['name']])->getField('typeid');
			$_var_20 = null;
			$_var_20 = $_var_14->where(['isdraw' => 0, 'typeid' => $_var_19, 'cpname' => $_var_17['name'], 'expect' => $_var_17['expect']])->select();
			if (!$_var_20) {
				$_var_21 = $_var_13->where(['isdraw' => 0, 'id' => $_var_17['id']])->setField(['isdraw' => 1]);
				$_var_18 = $_var_17['title'] . '-期号:' . $_var_17['expect'] . '无下注信息';
				echo $_var_18;
				exit;
			} else {
				$_var_22 = [];
				foreach ($_var_20 as $_var_23 => $_var_24) {
					$_var_24['opencode'] = $_var_17['opencode'];
					$_var_22[$_var_23] = $_var_24;
				}
				$_var_25 = $_var_22;
				if (is_file(COMMON_PATH . "/Lib/kaijiang/{$_var_19}.class.php")) {
					$_var_26 = "\\Lib\\kaijiang\\{$_var_19}";
					$_var_27 = new $_var_26($_var_22);
					$_var_25 = $_var_27->check();
					unset($_var_27);
				}
				$_var_28 = [];
				foreach ($_var_25 as $_var_23 => $_var_29) {
					if (!isset($_var_29['zjcount'])) {
						continue;
					}
					if ($_var_29['zjcount'] == 0) {
						$_var_14->where(['id' => $_var_29['id']])->setField(['isdraw' => -1, 'opencode' => $_var_17['opencode']]);
					} elseif ($_var_29['zjcount'] >= 1) {
						$_var_30 = $_var_29['typeid'];
						$_var_31 = self::$_typeid0($_var_29);
						$_var_14->where(['id' => $_var_29['id']])->setField(['isdraw' => 1, 'opencode' => $_var_17['opencode'], 'okamount' => $_var_31, 'okcount' => $_var_29['zjcount']]);
						$_var_32 = $_var_15->where(['id' => $_var_29['uid']])->getField('balance');
						$_var_15->where(['id' => $_var_29['uid']])->setInc('balance', $_var_31);
						$_var_28[$_var_29['uid']] = $_var_29['username'] . '-金额:' . $_var_31;
						$_var_33 = [];
						$_var_33['trano'] = self::gettrano();
						$_var_33['uid'] = $_var_29['uid'];
						$_var_33['username'] = $_var_29['username'];
						$_var_33['type'] = 'reward';
						$_var_33['typename'] = '返奖';
						$_var_33['amount'] = $_var_31;
						$_var_33['amountbefor'] = $_var_32;
						$_var_33['amountafter'] = $_var_32 + $_var_31;
						$_var_33['oddtime'] = time();
						$_var_33['remark'] = $_var_29['cptitle'] . '第' . $_var_29['expect'] . '期-' . $_var_29['playtitle'];
						M('fuddetail')->data($_var_33)->add();
						if ($_var_29['repointamout'] > 0) {
							$_var_32 = $_var_15->where(['id' => $_var_29['uid']])->getField('balance');
							$_var_15->where(['id' => $_var_29['uid']])->setInc('balance', $_var_29['repointamout']);
							$_var_33 = [];
							$_var_33['trano'] = self::gettrano();
							$_var_33['uid'] = $_var_29['uid'];
							$_var_33['username'] = $_var_29['username'];
							$_var_33['type'] = 'commission';
							$_var_33['typename'] = '返点';
							$_var_33['amount'] = $_var_29['repointamout'];
							$_var_33['amountbefor'] = $_var_32;
							$_var_33['amountafter'] = $_var_32 + $_var_29['repointamout'];
							$_var_33['oddtime'] = time();
							$_var_33['remark'] = $_var_29['cptitle'] . '第' . $_var_29['expect'] . '期-' . $_var_29['playtitle'];
							M('fuddetail')->data($_var_33)->add();
						}
					}
				}
				$_var_21 = $_var_13->where(['isdraw' => 0, 'id' => $_var_17['id']])->setField(['isdraw' => 1]);
				$_var_18 = $_var_17['title'] . '-期号:' . $_var_17['expect'] . '开奖成功！
中奖会员概况：' . implode(';;', $_var_28);
			}
		}
		if (time() <= strtotime('16:50') && time() >= strtotime('16:45')) {
			self::delete2daykj();
		}
		echo $_var_18;
		exit;
	}
	protected function ssc($_var_34)
	{
		$_var_35 = 0;
		$_var_35 = $_var_34['amount'] / $_var_34['itemcount'] * $_var_34['mode'] * $_var_34['zjcount'];
		return $_var_35;
	}
	protected function k3($_var_36)
	{
		$_var_37 = 0;
		$_var_37 = $_var_36['amount'] / $_var_36['itemcount'] * $_var_36['mode'] * $_var_36['zjcount'];
		return $_var_37;
	}
	protected function delete2daykj()
	{
		$_var_38 = date('Y-m-d', time());
		$_var_39 = strtotime($_var_38) - 86400 * 2;
		$_var_40 = [];
		$_var_40['opentime'] = ['elt', $_var_39];
		M('kaijiang')->where($_var_40)->delete();
	}
	protected function gettrano($_var_41 = 4)
	{
		$_var_41 = intval($_var_41) > 0 && intval($_var_41) <= 6 ? intval($_var_41) : 4;
		$_var_42 = strtoupper(self::rand_string(3, 0)) . date('ymdHis') . self::rand_string($_var_41, 1);
		return $_var_42;
	}
	protected function rand_string($_var_43 = 6, $_var_44 = 0, $_var_45 = '')
	{
		$_var_46 = new \Org\Util\String();
		$_var_47 = $_var_46->randString($_var_43, $_var_44, $_var_45);
		return $_var_47;
	}
}