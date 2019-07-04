<?php

//decode by http://www.yunlu99.com/
namespace Kjapi\Controller;

error_reporting(E_ALL ^ E_NOTICE);
use Think\Controller;
class JihuabaseController extends CommonController
{
	public function __construct()
	{
		parent::__construct();
	}
	function checkjihua($_var_0 = 0)
	{
		$_var_1 = self::getsetting();
		$_var_2 = time();
		echo self::GBK('
当前时间:' . date('Y-m-d H:i:s', time()));
		$_var_3 = 0;
		$_var_4 = 0;
		$_var_5 = 0;
		$_var_3 = date('Y-m-d H:i:s', strtotime($_var_1['jihua_rixiaofei_shi'] . ':' . $_var_1['jihua_rixiaofei_fen']));
		$_var_4 = strtotime($_var_3);
		$_var_5 = strtotime($_var_3) + 5 * 60;
		if ($_var_2 >= $_var_4 && $_var_2 <= $_var_5) {
			$_var_6 = self::jihuarixiaofei($_var_1);
			echo self::GBK($_var_6);
		} else {
			echo self::GBK('每日消费赠送活动时间未到');
		}
		$_var_3 = 0;
		$_var_4 = 0;
		$_var_5 = 0;
		$_var_3 = date('Y-m-d H:i:s', strtotime($_var_1['jihua_rikuisun_shi'] . ':' . $_var_1['jihua_rikuisun_fen']));
		$_var_4 = strtotime($_var_3);
		$_var_5 = strtotime($_var_3) + 5 * 60;
		if ($_var_2 >= $_var_4 && $_var_2 <= $_var_5) {
			$_var_7 = self::jihuarikuisun($_var_1);
			echo self::GBK($_var_7);
		} else {
			echo self::GBK('每日亏损赠送活动时间未到');
		}
		$_var_3 = 0;
		$_var_4 = 0;
		$_var_5 = 0;
		$_var_3 = date('Y-m-d H:i:s', strtotime(date('Y-m-01 H:i:s', strtotime($_var_1['jihua_yuexiaofei_shi'] . ':' . $_var_1['jihua_yuexiaofei_fen']))));
		$_var_4 = strtotime($_var_3);
		$_var_5 = strtotime($_var_3) + 5 * 60;
		if ($_var_2 >= $_var_4 && $_var_2 <= $_var_5) {
			$_var_8 = self::jihuayuexiaofei($_var_1);
			echo self::GBK($_var_9);
		} else {
			echo self::GBK('每月消费赠送活动时间未到');
		}
		$_var_3 = 0;
		$_var_4 = 0;
		$_var_5 = 0;
		$_var_3 = date('Y-m-d H:i:s', strtotime(date('Y-m-01 H:i:s', strtotime($_var_1['jihua_yuexiaofei_shi'] . ':' . $_var_1['jihua_yuexiaofei_fen']))));
		$_var_4 = strtotime($_var_3);
		$_var_5 = strtotime($_var_3) + 5 * 60;
		if ($_var_2 >= $_var_4 && $_var_2 <= $_var_5) {
			$_var_10 = self::jihuayuekuisun($_var_1);
			echo self::GBK($_var_10);
		} else {
			echo self::GBK('每月日亏赠送活动时间未到');
		}
		$_var_11 = 0;
		$_var_12 = 0;
		$_var_11 = date('Y-m-d 00:00:01', $_var_2);
		$_var_12 = date('Y-m-d 00:59:59', $_var_2);
		if ($_var_2 >= strtotime($_var_11) && $_var_2 <= strtotime($_var_12)) {
			$_var_13 = self::jihuaclearkaijiang($_var_1);
			echo self::GBK($_var_13);
		} else {
			echo self::GBK('今日开奖数据清理已完成');
		}
		$_var_11 = 0;
		$_var_12 = 0;
		$_var_11 = date('Y-m-d 00:00:01', $_var_2);
		$_var_12 = date('Y-m-d 00:59:59', $_var_2);
		if ($_var_2 >= strtotime($_var_11) && $_var_2 <= strtotime($_var_12)) {
			$_var_14 = self::jihuacleartouzhu($_var_1);
			echo self::GBK($_var_14);
		} else {
			echo self::GBK('今日投注数据清理时间已完成');
		}
		$_var_11 = 0;
		$_var_12 = 0;
		$_var_11 = date('Y-m-d 00:00:01', $_var_2);
		$_var_12 = date('Y-m-d 00:59:59', $_var_2);
		if ($_var_2 >= strtotime($_var_11) && $_var_2 <= strtotime($_var_12)) {
			$_var_15 = self::jihuaclearfuddetail($_var_1);
			echo self::GBK($_var_15);
		} else {
			echo self::GBK('今日账变记录清理时间已完成');
		}
		$_var_11 = 0;
		$_var_12 = 0;
		$_var_11 = date('Y-m-d 00:00:01', $_var_2);
		$_var_12 = date('Y-m-d 00:59:59', $_var_2);
		if ($_var_2 >= strtotime($_var_11) && $_var_2 <= strtotime($_var_12)) {
			$_var_16 = self::jihuaclearmemlog($_var_1);
			echo self::GBK($_var_16);
		} else {
			echo self::GBK('今日会员日志清理时间已完成');
		}
		$_var_11 = 0;
		$_var_12 = 0;
		$_var_11 = date('Y-m-d 00:00:01', $_var_2);
		$_var_12 = date('Y-m-d 00:59:59', $_var_2);
		if ($_var_2 >= strtotime($_var_11) && $_var_2 <= strtotime($_var_12)) {
			$_var_17 = self::jihuaclearadminlog($_var_1);
			echo self::GBK($_var_17);
		} else {
			echo self::GBK('今日管理员日志清理时间已完成');
		}
		$_var_18 = date('t', strtotime($_var_19));
		$_var_20 = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m') - 1, 1, date('Y')));
		$_var_21 = date('Y-m-d 23:59:59', strtotime($_var_20));
		if ($_var_2 >= strtotime($_var_20) && $_var_2 <= strtotime($_var_21)) {
			$_var_22 = self::jihuadailifenhong($_var_1);
			echo self::GBK($_var_22);
		}
		exit;
	}
	protected function jihuadailifenhong($_var_23, $_var_24 = 0)
	{
		$_var_25 = date('t', strtotime($_var_26));
		$_var_27 = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m') - 1, 1, date('Y')));
		$_var_28 = date('Y-m-d 23:59:59', mktime(0, 0, 0, date('m') - 1, $_var_25 - 1, date('Y')));
		$_var_29 = date('Y-m-01 H:i:s', strtotime(date('Y-m-d')));
		$_var_30 = time();
		$_var_31 = $_var_27;
		$_var_32 = strtotime($_var_29);
		$_var_33 = strtotime($_var_29) + 86400 * 30 - 1;
		$_var_34 = $_var_27;
		$_var_35 = $_var_28;
		$_var_36 = F('jihuadailifenhongtime');
		$_var_37 = strtotime($_var_29);
		$_var_38 = strtotime("{$_var_29} +1 month -1 day") + 86400 - 1;
		if ($_var_36 && $_var_36 >= $_var_37 && $_var_36 <= $_var_38) {
			return '上月代理分红已经赠送';
		}
		if ($_var_30 > $_var_33 || $_var_30 < $_var_32) {
			return '上月代理分红时间点' . date('Y-m-d H:i:s', $_var_32) . '~' . date('Y-m-d H:i:s', $_var_33);
		}
		$_var_39 = [];
		$_var_39[] = ['CommissionBase' => self::getsetting('agentBonusBase0_0'), 'benrenbili' => self::getsetting('agentBonusBase0_1')];
		$_var_39[] = ['CommissionBase' => self::getsetting('agentBonusBase1_0'), 'benrenbili' => self::getsetting('agentBonusBase1_1')];
		$_var_39[] = ['CommissionBase' => self::getsetting('agentBonusBase2_0'), 'benrenbili' => self::getsetting('agentBonusBase2_1')];
		$_var_39[] = ['CommissionBase' => self::getsetting('agentBonusBase3_0'), 'benrenbili' => self::getsetting('agentBonusBase3_1')];
		$_var_40 = M('member')->where(['proxy' => 1, 'isnb' => 0])->count();
		$_var_41 = 1;
		$_var_24 = $_var_24 ? $_var_24 : 1;
		$_var_42 = ceil($_var_40 / $_var_41);
		$_var_43 = ($_var_24 - 1) * $_var_41;
		if ($_var_24 > $_var_42) {
			F('jihuadailifenhongtime', time());
			$_var_44 = '代理分红已经全部赠送成功';
			return $_var_44;
		}
		$_var_45 = [];
		$_var_45 = M('member')->where(['proxy' => 1, 'isnb' => 0])->field('id,username')->limit($_var_43, $_var_41)->select();
		foreach ($_var_45 as $_var_46 => $_var_47) {
			$_var_48 = [];
			$_var_48 = $_var_47;
			$_var_49 = $_var_48['id'];
			$_var_50 = M('dailifenhong')->where("uid='{$_var_49}' and oddtime<=" . strtotime($_var_35) . ' and oddtime>=' . strtotime($_var_34))->find();
			if ($_var_50) {
				continue;
			}
			$_var_51 = [];
			$_var_52 = [];
			$_var_51 = M('member')->where(['parentid' => $_var_47['id'], 'isnb' => 0])->field('id,username')->select();
			foreach ($_var_51 as $_var_53 => $_var_54) {
				$_var_52[] = $_var_54['id'];
			}
			$_var_55 = 0;
			$_var_56 = 0;
			$_var_57 = 0;
			if ($_var_52) {
				$_var_58 = [];
				$_var_58['uid'] = ['in', $_var_52];
				$_var_58['isdraw'] = ['in', [1, -1]];
				$_var_58['oddtime'][] = ['egt', strtotime($_var_34)];
				$_var_58['oddtime'][] = ['elt', strtotime($_var_35)];
				$_var_55 = M('touzhu')->where($_var_58)->sum('amount');
				$_var_55 = $_var_55 ? $_var_55 : 0;
				$_var_58 = [];
				$_var_58['uid'] = ['in', $_var_52];
				$_var_58['isdraw'] = ['eq', 1];
				$_var_58['oddtime'][] = ['egt', strtotime($_var_34)];
				$_var_58['oddtime'][] = ['elt', strtotime($_var_35)];
				$_var_56 = M('touzhu')->where($_var_58)->sum('okamount');
				$_var_56 = $_var_56 ? $_var_56 : 0;
				$_var_57 = $_var_55 - $_var_56;
				if ($_var_57 > 0) {
					foreach ($_var_39 as $_var_59 => $_var_60) {
						$_var_61 = [];
						$_var_61 = explode('~', $_var_60['CommissionBase']);
						$_var_61 = array_map('intval', $_var_61);
						$_var_62 = floatval($_var_60['benrenbili']);
						if ($_var_61[0] && $_var_61[1] && $_var_57 >= $_var_61[0] && $_var_57 <= $_var_61[1]) {
							$_var_63 = $_var_57 * ($_var_62 / 100);
							if ($_var_63 > 0) {
								$_var_64 = 0;
								$_var_64 = $_var_65->where(['id' => $_var_48['uid']])->getField('balance');
								$_var_64 = $_var_64 > 0 ? $_var_64 : 0;
								$_var_66 = 0;
								if (!$_var_50) {
									$_var_66 = $_var_65->where(['id' => $_var_48['uid']])->setInc('balance', $_var_63);
								}
								$_var_67 = 0;
								$_var_67 = self::gettrano();
								$_var_68 = [];
								$_var_68['trano'] = $_var_67;
								$_var_68['uid'] = $_var_48['uid'];
								$_var_68['username'] = $_var_48['username'];
								$_var_68['type'] = 'fenhong';
								$_var_68['typename'] = '代理分红';
								$_var_68['amount'] = $_var_63;
								$_var_68['amountbefor'] = $_var_64;
								$_var_68['amountafter'] = $_var_64 + $_var_63;
								$_var_68['oddtime'] = strtotime($_var_35);
								$_var_68['remark'] = "下线会员总投注:{$_var_55},总返奖:{$_var_55},总亏:{$_var_57},分红规则:{$_var_61[0]}~{$_var_61[1]}={$_var_62}%";
								if ($_var_66) {
									if (!$_var_50) {
										M('fuddetail')->data($_var_68)->add();
									}
									$_var_69[] = $_var_47['uid'];
								}
								$_var_70 = [];
								$_var_70['trano'] = $_var_67 ? $_var_67 : self::gettrano();
								$_var_70['uid'] = $_var_48['uid'];
								$_var_70['username'] = $_var_48['username'];
								$_var_70['tzsumamount'] = $_var_55;
								$_var_70['fjsumamount'] = $_var_56;
								$_var_70['yingkui'] = $_var_57;
								$_var_70['fanwei'] = $_var_61[0] . '~' . $_var_61[1];
								$_var_70['bili'] = $_var_62;
								$_var_70['amount'] = $_var_63;
								$_var_70['oddtime'] = strtotime($_var_35);
								if (!$_var_50) {
									M('dailifenhong')->data($_var_68)->add();
								}
							}
						}
					}
				}
			}
		}
		echo self::GBK('分红成功第' . $_var_24 . '/' . $_var_42 . '页');
		sleep(3);
		self::jihuadailifenhong($_var_23, $_var_24 + 1);
	}
	protected function dbautoback($_var_71, $_var_72 = array(), $_var_73 = 0)
	{
		$_var_74 = $_var_72['id'];
		$_var_75 = $_var_72['start'];
		$_var_76 = time();
		$_var_77 = $_var_71['jihua_dbautoback_fen'] * 60;
		$_var_78 = F('dbautobacktime');
		if ($_var_78 && $_var_76 < $_var_78 + $_var_77) {
			return '数据库下次备份时间：' . date('Y-m-d H:i:s', $_var_78 + $_var_77);
		}
		$_var_79 = array('path' => DATA_PATH . 'db/', 'part' => C('DB_PART'), 'compress' => C('DB_COMPRESS'), 'level' => C('DB_LEVEL'));
		$_var_80 = "{$_var_79['path']}backup.lock";
		if ($_var_73 == 0) {
			$_var_81 = \Think\Db::getInstance();
			$_var_82 = $_var_81->query('SHOW TABLE STATUS');
			foreach ($_var_82 as $_var_83 => $_var_84) {
				if ($_var_84['Name'] == C('DB_PREFIX') . 'adminsession' || $_var_84['Name'] == C('DB_PREFIX') . 'membersession') {
					unset($_var_82[$_var_83]);
				}
			}
			$_var_82 = array_map('array_change_key_case', $_var_82);
			$_var_85 = [];
			foreach ($_var_82 as $_var_86 => $_var_87) {
				$_var_85[] = $_var_87['name'];
			}
			if (is_file($_var_80)) {
				return '检测到有一个备份任务正在执行，请稍后再试！';
			} else {
				file_put_contents($_var_80, time());
			}
			is_writeable($_var_79['path']) || mkdir($_var_79['path'], 0777, true);
			session('backup_config', $_var_79);
			$_var_88 = array('name' => date('Ymd-His', time()), 'part' => 1);
			session('backup_file', $_var_88);
			session('backup_tables', $_var_85);
			$_var_89 = new \Lib\Database($_var_88, $_var_79);
			if (false !== $_var_89->create()) {
				$_var_90 = array('id' => 0, 'start' => 0);
				echo self::GBK('数据库备份初始化成功！');
				self::dbautoback($_var_71, $_var_90, 1);
			} else {
				return '初始化失败，备份文件创建失败！';
			}
		} elseif (is_numeric($_var_74) && is_numeric($_var_75)) {
			$_var_85 = session('backup_tables');
			$_var_89 = new \Lib\Database(session('backup_file'), session('backup_config'));
			$_var_75 = $_var_89->backup($_var_85[$_var_74], $_var_75);
			if (false === $_var_75) {
				return '备份出错！';
			} elseif (0 === $_var_75) {
				if (isset($_var_85[++$_var_74])) {
					$_var_90 = array('id' => $_var_74, 'start' => 0);
					echo self::GBK('备份完成-' . $_var_85[$_var_74]);
					self::dbautoback($_var_71, $_var_90, 1);
				} else {
					unlink(session('backup_config.path') . 'backup.lock');
					session('backup_tables', null);
					session('backup_file', null);
					session('backup_config', null);
					if ($_var_74 == count($_var_85) && !is_file($_var_80)) {
					}
					return '备份完成！';
				}
			} else {
				$_var_90 = array('id' => $_var_74, 'start' => $_var_75[0]);
				$_var_91 = floor(100 * ($_var_75[0] / $_var_75[1]));
				echo self::GBK("正在备份...({$_var_91}%)");
				self::dbautoback($_var_71, $_var_90, 1);
			}
		} else {
			return '参数错误！';
		}
		F('dbautobacktime', time());
		return '本轮备份全部完成';
	}
	protected function cleardbback($_var_92 = 7)
	{
		$_var_92 = intval($_var_92);
		$_var_93 = time();
		$_var_94 = F('cleardbbacktime');
		$_var_95 = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$_var_96 = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
		if ($_var_94 && $_var_94 >= $_var_95 && $_var_94 <= $_var_96) {
			return '自动备份的数据库今日已清理';
		}
		$_var_97 = $_var_95 - 86400 * $_var_92 - 1;
		$_var_98 = DATA_PATH . 'db/';
		$_var_99 = false;
		$_var_100 = [];
		if ($_var_101 = opendir($_var_98)) {
			while (($_var_102 = readdir($_var_101)) !== false) {
				if ($_var_102 != '..' && $_var_102 != '.') {
					if (is_dir($_var_98 . '/' . $_var_102)) {
					} else {
						$_var_103 = $_var_98 . '/' . $_var_102;
						$_var_104 = filectime($_var_103);
						if ($_var_104 <= $_var_97) {
							$_var_105 = unlink($_var_103);
							if ($_var_105) {
								$_var_99 = true;
							}
						}
						$_var_100[] = $_var_103;
					}
				}
			}
			closedir($_var_101);
		}
		if ($_var_99) {
			F('cleardbbacktime', time());
			$_var_106 = '自动备份的数据库清理成功';
		} else {
			$_var_106 = '暂无备份数据需清理';
		}
		return $_var_106;
	}
	protected function jihuaclearkaijiang($_var_107)
	{
		$_var_108 = time();
		$_var_109 = $_var_107['jihua_kaijiang_days'];
		$_var_110 = F('jihuaclearkaijiangtime');
		$_var_111 = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$_var_112 = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
		if ($_var_110 && $_var_110 >= $_var_111 && $_var_110 <= $_var_112) {
			return '开奖数据今天已经清理';
		}
		$_var_113 = $_var_111 - 86400 * $_var_109 - 1;
		$_var_114 = [];
		$_var_114['addtime'] = ['elt', $_var_113];
		$_var_115 = M('kaijiang')->where($_var_114)->delete();
		if ($_var_115) {
			F('jihuaclearkaijiangtime', time());
			$_var_116 = '开奖数据清理成功';
		} else {
			$_var_116 = '开奖数据已经清理';
		}
		return $_var_116;
	}
	protected function jihuacleartouzhu($_var_117)
	{
		$_var_118 = time();
		$_var_119 = $_var_117['jihua_touzhu_days'];
		$_var_120 = F('jihuacleartouzhutime');
		$_var_121 = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$_var_122 = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
		if ($_var_120 && $_var_120 >= $_var_121 && $_var_120 <= $_var_122) {
			return '投注数据今天已经清理';
		}
		$_var_123 = $_var_121 - 86400 * $_var_119 - 1;
		$_var_124 = [];
		$_var_124['oddtime'] = ['elt', $_var_123];
		$_var_125 = M('touzhu')->where($_var_124)->delete();
		if ($_var_125) {
			F('jihuacleartouzhutime', time());
			$_var_126 = '投注数据清理成功';
		} else {
			$_var_126 = '投注数据已经清理';
		}
		return $_var_126;
	}
	protected function jihuaclearfuddetail($_var_127)
	{
		$_var_128 = time();
		$_var_129 = $_var_127['jihua_fuddetail_days'];
		$_var_130 = F('jihuaclearfuddetailtime');
		$_var_131 = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$_var_132 = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
		if ($_var_130 && $_var_130 >= $_var_131 && $_var_130 <= $_var_132) {
			return '账变记录今天已经清理';
		}
		$_var_133 = $_var_131 - 86400 * $_var_129 - 1;
		$_var_134 = [];
		$_var_134['oddtime'] = ['elt', $_var_133];
		$_var_135 = M('fuddetail')->where($_var_134)->delete();
		if ($_var_135) {
			F('jihuaclearfuddetailtime', time());
			$_var_136 = '账变记录清理成功';
		} else {
			$_var_136 = '账变记录已经清理';
		}
		return $_var_136;
	}
	protected function jihuaclearmemlog()
	{
		$_var_137 = time();
		$_var_138 = $_var_139['jihua_memlog_days'];
		$_var_140 = F('jihuaclearmemlogtime');
		$_var_141 = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$_var_142 = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
		if ($_var_140 && $_var_140 >= $_var_141 && $_var_140 <= $_var_142) {
			return '会员日志今天已经清理';
		}
		$_var_143 = $_var_141 - 86400 * $_var_138 - 1;
		$_var_144 = [];
		$_var_144['time'] = ['elt', $_var_143];
		$_var_145 = M('memberlog')->where($_var_144)->delete();
		if ($_var_145) {
			F('jihuaclearmemlogtime', time());
			$_var_146 = '会员日志清理成功';
		} else {
			$_var_146 = '会员日志已经清理';
		}
		return $_var_146;
	}
	protected function jihuaclearadminlog()
	{
		$_var_147 = time();
		$_var_148 = $_var_149['jihua_adminlog_days'];
		$_var_150 = F('jihuaclearadminlogtime');
		$_var_151 = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$_var_152 = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
		if ($_var_150 && $_var_150 >= $_var_151 && $_var_150 <= $_var_152) {
			return '会员日志今天已经清理';
		}
		$_var_153 = $_var_151 - 86400 * $_var_148 - 1;
		$_var_154 = [];
		$_var_154['time'] = ['elt', $_var_153];
		$_var_155 = M('adminlog')->where($_var_154)->delete();
		if ($_var_155) {
			F('jihuaclearadminlogtime', time());
			$_var_156 = '管理员日志清理成功';
		} else {
			$_var_156 = '管理员日志已经清理';
		}
		return $_var_156;
	}
	protected function jihuarixiaofei($_var_157)
	{
		$_var_158 = time();
		$_var_159 = date('Y-m-d H:i:s', strtotime($_var_157['jihua_rixiaofei_shi'] . ':' . $_var_157['jihua_rixiaofei_fen']));
		$_var_160 = strtotime($_var_159);
		$_var_161 = strtotime($_var_159) + 5 * 60;
		$_var_162 = date('Y-m-d 00:00:00', $_var_158 - 86400);
		$_var_163 = date('Y-m-d 23:59:59', $_var_158 - 86400);
		$_var_164 = F('jihuarixiaofeitime');
		$_var_165 = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$_var_166 = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
		if ($_var_164 && $_var_164 >= $_var_165 && $_var_164 <= $_var_166) {
			return '日消费赠送活动已经赠送';
		}
		if ($_var_158 > $_var_161 || $_var_158 < $_var_160) {
			return '日消费赠送活动时间点' . date('Y-m-d H:i:s', $_var_160) . '~' . date('Y-m-d H:i:s', $_var_161);
		}
		$_var_167 = M('member');
		$_var_168 = [];
		$_var_169 = [];
		$_var_168 = $_var_167->where(['isnb' => 1])->field('id,username')->select();
		foreach ($_var_168 as $_var_170 => $_var_171) {
			$_var_169[] = $_var_171['id'];
		}
		$_var_172 = [];
		if ($_var_169) {
			$_var_172['uid'] = ['not in', $_var_169];
		}
		$_var_172['oddtime'][] = ['egt', strtotime($_var_162)];
		$_var_172['oddtime'][] = ['elt', strtotime($_var_163)];
		$_var_172['isdraw'] = ['in', [1, -1]];
		$_var_173 = C('DB_PREFIX');
		$_var_174 = [];
		$_var_174 = M('touzhu')->where($_var_172)->alias('a')->join(" {$_var_173}member as b on a.uid = b.id ")->field('a.uid, a.username, b.parentid, sum(a.amount) as amount')->group('uid')->select();
		$_var_175 = [];
		$_var_175[] = ['CommissionBase' => self::getsetting('riCommissionBase0_0'), 'benrenbili' => self::getsetting('riCommissionBase0_1'), 'shangjiabili' => self::getsetting('riCommissionBase0_2')];
		$_var_175[] = ['CommissionBase' => self::getsetting('riCommissionBase1_0'), 'benrenbili' => self::getsetting('riCommissionBase1_1'), 'shangjiabili' => self::getsetting('riCommissionBase1_2')];
		$_var_175[] = ['CommissionBase' => self::getsetting('riCommissionBase2_0'), 'benrenbili' => self::getsetting('riCommissionBase2_1'), 'shangjiabili' => self::getsetting('riCommissionBase2_2')];
		$_var_176 = M('fuddetail');
		$_var_177 = [];
		foreach ($_var_174 as $_var_170 => $_var_171) {
			foreach ($_var_175 as $_var_178 => $_var_179) {
				$_var_180 = [];
				$_var_180 = explode('~', $_var_179['CommissionBase']);
				$_var_180 = array_map('intval', $_var_180);
				$_var_181 = floatval($_var_179['benrenbili']);
				$_var_182 = floatval($_var_179['shangjiabili']);
				$_var_183 = 0;
				$_var_183 = $_var_171['uid'];
				$_var_184 = $_var_176->where("type='activity_rxf' and uid='{$_var_183}' and oddtime<=" . strtotime($_var_163) . ' and oddtime>=' . strtotime($_var_162))->find();
				if (!$_var_184 && $_var_180[0] && $_var_180[1] && $_var_171['amount'] >= $_var_180[0] && $_var_171['amount'] <= $_var_180[1]) {
					$_var_185 = $_var_171['amount'] * ($_var_181 / 100);
					$_var_186 = $_var_171['amount'] * ($_var_182 / 100);
					if ($_var_185 > 0) {
						$_var_187 = 0;
						$_var_187 = $_var_167->where(['id' => $_var_171['uid']])->getField('balance');
						$_var_187 = $_var_187 > 0 ? $_var_187 : 0;
						$_var_188 = 0;
						$_var_188 = $_var_167->where(['id' => $_var_171['uid']])->setInc('balance', $_var_185);
						$_var_189 = 0;
						$_var_189 = self::gettrano();
						$_var_190 = [];
						$_var_190['trano'] = $_var_189;
						$_var_190['uid'] = $_var_171['uid'];
						$_var_190['username'] = $_var_171['username'];
						$_var_190['type'] = 'activity_rxf';
						$_var_190['typename'] = '日消费赠送';
						$_var_190['amount'] = $_var_185;
						$_var_190['amountbefor'] = $_var_187;
						$_var_190['amountafter'] = $_var_187 + $_var_185;
						$_var_190['oddtime'] = strtotime($_var_163);
						$_var_190['remark'] = '本人日消费赠送活动';
						if ($_var_188) {
							$_var_176->data($_var_190)->add();
							$_var_177[] = $_var_171['uid'];
						}
					}
					if ($_var_186 > 0 && $_var_171['parentid']) {
						$_var_187 = 0;
						$_var_191 = $_var_167->where(['id' => $_var_171['parentid']])->field('balance,id,username')->find();
						$_var_187 = $_var_191['balance'] > 0 ? $_var_191['balance'] : 0;
						$_var_188 = 0;
						$_var_188 = $_var_167->where(['id' => $_var_191['id']])->setInc('balance', $_var_186);
						$_var_189 = $_var_189 ? $_var_189 : self::gettrano();
						$_var_190 = [];
						$_var_189 = $_var_189 ? $_var_189 : self::gettrano();
						$_var_190['uid'] = $_var_191['id'];
						$_var_190['username'] = $_var_191['username'];
						$_var_190['type'] = 'activity_rxf';
						$_var_190['typename'] = '日消费赠送';
						$_var_190['amount'] = $_var_186;
						$_var_190['amountbefor'] = $_var_187;
						$_var_190['amountafter'] = $_var_187 + $_var_186;
						$_var_190['oddtime'] = strtotime($_var_163);
						$_var_190['remark'] = "下线日消费赠送活动({$_var_171['username']})";
						if ($_var_188) {
							$_var_176->data($_var_190)->add();
						}
					}
					break;
				}
			}
		}
		if (count(array_unique($_var_177)) >= 1) {
			F('jihuarixiaofeitime', time());
			$_var_192 = '日消费赠送活动赠送成功';
		} else {
			$_var_192 = '日消费赠送活动无记录或已经赠送过';
		}
		return $_var_192;
	}
	protected function jihuarikuisun($_var_193)
	{
		$_var_194 = time();
		$_var_195 = date('Y-m-d H:i:s', strtotime($_var_193['jihua_rikuisun_shi'] . ':' . $_var_193['jihua_rikuisun_fen']));
		$_var_196 = strtotime($_var_195);
		$_var_197 = strtotime($_var_195) + 5 * 60;
		$_var_198 = date('Y-m-d 00:00:00', $_var_194 - 86400);
		$_var_199 = date('Y-m-d 23:59:59', $_var_194 - 86400);
		$_var_200 = F('jihuarikuisuntime');
		$_var_201 = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$_var_202 = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
		if ($_var_200 && $_var_200 >= $_var_201 && $_var_200 <= $_var_202) {
			return '日亏损赠送活动已经赠送';
		}
		if ($_var_194 > $_var_197 || $_var_194 < $_var_196) {
			return '日亏损赠送活动时间点' . date('Y-m-d H:i:s', $_var_196) . '~' . date('Y-m-d H:i:s', $_var_197);
		}
		$_var_203 = M('member');
		$_var_204 = [];
		$_var_205 = [];
		$_var_204 = $_var_203->where(['isnb' => 1])->field('id,username')->select();
		foreach ($_var_204 as $_var_206 => $_var_207) {
			$_var_205[] = $_var_207['id'];
		}
		$_var_208 = [];
		if ($_var_205) {
			$_var_208['uid'] = ['not in', $_var_205];
		}
		$_var_208['oddtime'][] = ['egt', strtotime($_var_198)];
		$_var_208['oddtime'][] = ['elt', strtotime($_var_199)];
		$_var_208['isdraw'] = ['in', [1, -1]];
		$_var_209 = C('DB_PREFIX');
		$_var_210 = [];
		$_var_210 = M('touzhu')->where($_var_208)->alias('a')->join(" {$_var_209}member as b on a.uid = b.id ")->field('a.uid, a.username, b.parentid, sum(a.amount) as tzamount, sum(a.okamount) as okamount')->group('uid')->select();
		if ($_var_210) {
			foreach ($_var_210 as $_var_206 => $_var_207) {
				$_var_211 = 0;
				$_var_211 = $_var_207['okamount'] - $_var_207['tzamount'];
				if ($_var_211 < 0) {
					$_var_211 = abs($_var_211);
				} else {
					$_var_211 = 0;
				}
				$_var_207['amount'] = $_var_211;
				$_var_210[$_var_206] = $_var_207;
			}
		}
		$_var_212 = [];
		$_var_212[] = ['CommissionBase' => self::getsetting('riKuisunBase0_0'), 'benrenbili' => self::getsetting('riKuisunBase0_1'), 'shangjiabili' => self::getsetting('riKuisunBase0_2')];
		$_var_212[] = ['CommissionBase' => self::getsetting('riKuisunBase1_0'), 'benrenbili' => self::getsetting('riKuisunBase1_1'), 'shangjiabili' => self::getsetting('riKuisunBase1_2')];
		$_var_212[] = ['CommissionBase' => self::getsetting('riKuisunBase2_0'), 'benrenbili' => self::getsetting('riKuisunBase2_1'), 'shangjiabili' => self::getsetting('riKuisunBase2_2')];
		$_var_213 = M('fuddetail');
		$_var_214 = [];
		foreach ($_var_210 as $_var_206 => $_var_207) {
			foreach ($_var_212 as $_var_215 => $_var_216) {
				$_var_217 = [];
				$_var_217 = explode('~', $_var_216['CommissionBase']);
				$_var_217 = array_map('intval', $_var_217);
				$_var_218 = floatval($_var_216['benrenbili']);
				$_var_219 = floatval($_var_216['shangjiabili']);
				$_var_220 = 0;
				$_var_220 = $_var_207['uid'];
				$_var_221 = $_var_213->where("type='activity_rks' and uid='{$_var_220}' and oddtime<=" . strtotime($_var_199) . ' and oddtime>=' . strtotime($_var_198))->find();
				if ($_var_221 && $_var_217[0] && $_var_217[1] && $_var_207['amount'] >= $_var_217[0] && $_var_207['amount'] <= $_var_217[1]) {
					$_var_222 = $_var_207['amount'] * ($_var_218 / 100);
					$_var_223 = $_var_207['amount'] * ($_var_219 / 100);
					if ($_var_222 > 0) {
						$_var_224 = 0;
						$_var_224 = $_var_203->where(['id' => $_var_207['uid']])->getField('balance');
						$_var_224 = $_var_224 > 0 ? $_var_224 : 0;
						$_var_225 = 0;
						$_var_225 = $_var_203->where(['id' => $_var_207['uid']])->setInc('balance', $_var_222);
						$_var_226 = 0;
						$_var_226 = self::gettrano();
						$_var_227 = [];
						$_var_227['trano'] = $_var_226;
						$_var_227['uid'] = $_var_207['uid'];
						$_var_227['username'] = $_var_207['username'];
						$_var_227['type'] = 'activity_rks';
						$_var_227['typename'] = '日亏损赠送';
						$_var_227['amount'] = $_var_222;
						$_var_227['amountbefor'] = $_var_224;
						$_var_227['amountafter'] = $_var_224 + $_var_222;
						$_var_227['oddtime'] = strtotime($_var_199);
						$_var_227['remark'] = '本人日亏损赠送活动';
						if ($_var_225) {
							$_var_213->data($_var_227)->add();
							$_var_214[] = $_var_207['uid'];
						}
					}
					if ($_var_223 > 0 && $_var_207['parentid']) {
						$_var_224 = 0;
						$_var_228 = $_var_203->where(['id' => $_var_207['parentid']])->field('balance,id,username')->find();
						$_var_224 = $_var_228['balance'] > 0 ? $_var_228['balance'] : 0;
						$_var_225 = 0;
						$_var_225 = $_var_203->where(['id' => $_var_228['id']])->setInc('balance', $_var_223);
						$_var_226 = $_var_226 ? $_var_226 : self::gettrano();
						$_var_227 = [];
						$_var_227['trano'] = $_var_226;
						$_var_227['uid'] = $_var_228['id'];
						$_var_227['username'] = $_var_228['username'];
						$_var_227['type'] = 'activity_rks';
						$_var_227['typename'] = '日亏损赠送';
						$_var_227['amount'] = $_var_223;
						$_var_227['amountbefor'] = $_var_224;
						$_var_227['amountafter'] = $_var_224 + $_var_223;
						$_var_227['oddtime'] = strtotime($_var_199);
						$_var_227['remark'] = "下线日亏损赠送活动({$_var_207['username']})";
						if ($_var_225) {
							$_var_213->data($_var_227)->add();
						}
					}
					break;
				}
			}
		}
		if (count(array_unique($_var_214)) >= 1) {
			F('jihuarikuisuntime', time());
			$_var_229 = '日亏损赠送活动赠送成功';
		} else {
			$_var_229 = '日亏损赠送活动无记录或已经赠送过';
		}
		return $_var_229;
	}
	protected function jihuayuexiaofei($_var_230)
	{
		$_var_231 = date('t', strtotime($_var_232));
		$_var_233 = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m') - 1, 1, date('Y')));
		$_var_234 = date('Y-m-d 23:59:59', mktime(0, 0, 0, date('m') - 1, $_var_231 - 1, date('Y')));
		$_var_235 = date('Y-m-01 H:i:s', strtotime(date('Y-m-d')));
		$_var_236 = time();
		$_var_237 = date('Y-m-d H:i:s', strtotime(date('Y-m-01 H:i:s', strtotime($_var_230['jihua_yuexiaofei_shi'] . ':' . $_var_230['jihua_yuexiaofei_fen']))));
		$_var_238 = strtotime($_var_237);
		$_var_239 = strtotime($_var_237) + 5 * 60;
		$_var_240 = $_var_233;
		$_var_241 = $_var_234;
		$_var_242 = F('jihuayuexiaofeitime');
		$_var_243 = strtotime($_var_235);
		$_var_244 = strtotime("{$_var_235} +1 month -1 day") + 86400 - 1;
		if ($_var_242 && $_var_242 >= $_var_243 && $_var_242 <= $_var_244) {
			return '月消费赠送已经赠送过';
		}
		if ($_var_236 > $_var_239 || $_var_236 < $_var_238) {
			return '月消费赠送活动时间点' . date('Y-m-d H:i:s', $_var_238) . '~' . date('Y-m-d H:i:s', $_var_239);
		}
		$_var_245 = M('member');
		$_var_246 = [];
		$_var_247 = [];
		$_var_246 = $_var_245->where(['isnb' => 1])->field('id,username')->select();
		foreach ($_var_246 as $_var_248 => $_var_249) {
			$_var_247[] = $_var_249['id'];
		}
		$_var_250 = [];
		if ($_var_247) {
			$_var_250['uid'] = ['not in', $_var_247];
		}
		$_var_250['oddtime'][] = ['egt', strtotime($_var_240)];
		$_var_250['oddtime'][] = ['elt', strtotime($_var_241)];
		$_var_250['isdraw'] = ['in', [1, -1]];
		$_var_251 = C('DB_PREFIX');
		$_var_252 = [];
		$_var_252 = M('touzhu')->where($_var_250)->alias('a')->join(" {$_var_251}member as b on a.uid = b.id ")->field('a.uid, a.username, b.parentid, sum(a.amount) as amount')->group('uid')->select();
		$_var_253 = [];
		$_var_253[] = ['CommissionBase' => self::getsetting('yueCommissionBase0_0'), 'benrenbili' => self::getsetting('yueCommissionBase0_1'), 'shangjiabili' => self::getsetting('yueCommissionBase0_2')];
		$_var_253[] = ['CommissionBase' => self::getsetting('yueCommissionBase1_0'), 'benrenbili' => self::getsetting('yueCommissionBase1_1'), 'shangjiabili' => self::getsetting('yueCommissionBase1_2')];
		$_var_253[] = ['CommissionBase' => self::getsetting('yueCommissionBase2_0'), 'benrenbili' => self::getsetting('yueCommissionBase2_1'), 'shangjiabili' => self::getsetting('yueCommissionBase2_2')];
		$_var_254 = M('fuddetail');
		$_var_255 = [];
		if ($_var_252) {
			foreach ($_var_252 as $_var_248 => $_var_249) {
				foreach ($_var_253 as $_var_256 => $_var_257) {
					$_var_258 = [];
					$_var_258 = explode('~', $_var_257['CommissionBase']);
					$_var_258 = array_map('intval', $_var_258);
					$_var_259 = floatval($_var_257['benrenbili']);
					$_var_260 = floatval($_var_257['shangjiabili']);
					$_var_261 = 0;
					$_var_261 = $_var_249['uid'];
					$_var_262 = $_var_254->where("type='activity_yxf' and uid='{$_var_261}' and oddtime<=" . strtotime($_var_241) . ' and oddtime>=' . strtotime($_var_240))->find();
					if (!$_var_262 && $_var_258[0] && $_var_258[1] && $_var_249['amount'] >= $_var_258[0] && $_var_249['amount'] <= $_var_258[1]) {
						$_var_263 = $_var_249['amount'] * ($_var_259 / 100);
						$_var_264 = $_var_249['amount'] * ($_var_260 / 100);
						if ($_var_263 > 0) {
							$_var_265 = 0;
							$_var_265 = $_var_245->where(['id' => $_var_249['uid']])->getField('balance');
							$_var_265 = $_var_265 > 0 ? $_var_265 : 0;
							$_var_266 = 0;
							$_var_266 = $_var_245->where(['id' => $_var_249['uid']])->setInc('balance', $_var_263);
							$_var_267 = 0;
							$_var_267 = self::gettrano();
							$_var_268 = [];
							$_var_268['trano'] = $_var_267;
							$_var_268['uid'] = $_var_249['uid'];
							$_var_268['username'] = $_var_249['username'];
							$_var_268['type'] = 'activity_yxf';
							$_var_268['typename'] = '月消费赠送';
							$_var_268['amount'] = $_var_263;
							$_var_268['amountbefor'] = $_var_265;
							$_var_268['amountafter'] = $_var_265 + $_var_263;
							$_var_268['oddtime'] = strtotime($_var_241);
							$_var_268['remark'] = '本人月消费赠送赠送活动';
							if ($_var_266) {
								$_var_254->data($_var_268)->add();
								$_var_255[] = $_var_249['uid'];
							}
						}
						if ($_var_264 > 0 && $_var_249['parentid']) {
							$_var_265 = 0;
							$_var_269 = $_var_245->where(['id' => $_var_249['parentid']])->field('balance,id,username')->find();
							$_var_265 = $_var_269['balance'] > 0 ? $_var_269['balance'] : 0;
							$_var_266 = 0;
							$_var_266 = $_var_245->where(['id' => $_var_269['id']])->setInc('balance', $_var_264);
							$_var_268 = [];
							$_var_267 = $_var_267 ? $_var_267 : self::gettrano();
							$_var_268['trano'] = $_var_267;
							$_var_268['uid'] = $_var_269['id'];
							$_var_268['username'] = $_var_269['username'];
							$_var_268['type'] = 'activity_yxf';
							$_var_268['typename'] = '月消费赠送';
							$_var_268['amount'] = $_var_264;
							$_var_268['amountbefor'] = $_var_265;
							$_var_268['amountafter'] = $_var_265 + $_var_264;
							$_var_268['oddtime'] = strtotime($_var_241);
							$_var_268['remark'] = "月消费赠送赠送活动({$_var_249['username']})";
							if ($_var_266) {
								$_var_254->data($_var_268)->add();
							}
						}
						break;
					}
				}
			}
		}
		if (count(array_unique($_var_255)) >= 1) {
			F('jihuayuexiaofeitime', time());
			$_var_270 = '每月消费赠送活动赠送成功';
		} else {
			$_var_270 = '每月消费赠送活动无记录或已经赠送过';
		}
		return $_var_270;
	}
	protected function jihuayuekuisun($_var_271)
	{
		$_var_272 = date('t', strtotime($_var_273));
		$_var_274 = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m') - 1, 1, date('Y')));
		$_var_275 = date('Y-m-d 23:59:59', mktime(0, 0, 0, date('m') - 1, $_var_272, date('Y')));
		$_var_276 = date('Y-m-01 H:i:s', strtotime(date('Y-m-d')));
		$_var_277 = time();
		$_var_278 = date('Y-m-d H:i:s', strtotime(date('Y-m-01 H:i:s', strtotime($_var_271['jihua_yuekuisun_shi'] . ':' . $_var_271['jihua_yuekuisun_fen']))));
		$_var_279 = strtotime($_var_278);
		$_var_280 = strtotime($_var_278) + 5 * 60;
		$_var_281 = $_var_274;
		$_var_282 = $_var_275;
		$_var_283 = F('jihuayuekuisuntime');
		$_var_284 = strtotime($_var_276);
		$_var_285 = strtotime("{$_var_276} +1 month -1 day") + 86400 - 1;
		if ($_var_283 && $_var_283 >= $_var_284 && $_var_283 <= $_var_285) {
			return '上月亏损赠送活动已经赠送';
		}
		if ($_var_277 > $_var_280 || $_var_277 < $_var_279) {
			return '月亏损赠送活动时间点' . date('Y-m-d H:i:s', $_var_279) . '~' . date('Y-m-d H:i:s', $_var_280);
		}
		$_var_286 = M('member');
		$_var_287 = [];
		$_var_288 = [];
		$_var_287 = $_var_286->where(['isnb' => 1])->field('id,username')->select();
		foreach ($_var_287 as $_var_289 => $_var_290) {
			$_var_288[] = $_var_290['id'];
		}
		$_var_291 = [];
		if ($_var_288) {
			$_var_291['uid'] = ['not in', $_var_288];
		}
		$_var_291['oddtime'][] = ['egt', strtotime($_var_281)];
		$_var_291['oddtime'][] = ['elt', strtotime($_var_282)];
		$_var_291['isdraw'] = ['in', [1, -1]];
		$_var_292 = C('DB_PREFIX');
		$_var_293 = [];
		$_var_293 = M('touzhu')->where($_var_291)->alias('a')->join(" {$_var_292}member as b on a.uid = b.id ")->field('a.uid, a.username, b.parentid, sum(a.amount) as tzamount, sum(a.okamount) as okamount')->group('uid')->select();
		if ($_var_293) {
			foreach ($_var_293 as $_var_289 => $_var_290) {
				$_var_294 = 0;
				$_var_294 = $_var_290['okamount'] - $_var_290['tzamount'];
				if ($_var_294 < 0) {
					$_var_294 = abs($_var_294);
				} else {
					$_var_294 = 0;
				}
				$_var_290['amount'] = $_var_294;
				$_var_293[$_var_289] = $_var_290;
			}
		}
		$_var_295 = [];
		$_var_295[] = ['CommissionBase' => self::getsetting('yueKuisunBase0_0'), 'benrenbili' => self::getsetting('yueKuisunBase0_1'), 'shangjiabili' => self::getsetting('yueKuisunBase0_2')];
		$_var_295[] = ['CommissionBase' => self::getsetting('yueKuisunBase1_0'), 'benrenbili' => self::getsetting('yueKuisunBase1_1'), 'shangjiabili' => self::getsetting('yueKuisunBase1_2')];
		$_var_295[] = ['CommissionBase' => self::getsetting('yueKuisunBase2_0'), 'benrenbili' => self::getsetting('yueKuisunBase2_1'), 'shangjiabili' => self::getsetting('yueKuisunBase2_2')];
		$_var_296 = M('fuddetail');
		$_var_297 = [];
		foreach ($_var_293 as $_var_289 => $_var_290) {
			foreach ($_var_295 as $_var_298 => $_var_299) {
				$_var_300 = [];
				$_var_300 = explode('~', $_var_299['CommissionBase']);
				$_var_300 = array_map('intval', $_var_300);
				$_var_301 = floatval($_var_299['benrenbili']);
				$_var_302 = floatval($_var_299['shangjiabili']);
				$_var_303 = 0;
				$_var_303 = $_var_290['uid'];
				$_var_304 = $_var_296->where("type='activity_yks' and uid='{$_var_303}' and oddtime<=" . strtotime($_var_282) . ' and oddtime>=' . strtotime($_var_281))->find();
				if (!$_var_304 && $_var_300[0] && $_var_300[1] && $_var_290['amount'] >= $_var_300[0] && $_var_290['amount'] <= $_var_300[1]) {
					$_var_305 = $_var_290['amount'] * ($_var_301 / 100);
					$_var_306 = $_var_290['amount'] * ($_var_302 / 100);
					if ($_var_305 > 0) {
						$_var_307 = 0;
						$_var_307 = $_var_286->where(['id' => $_var_290['uid']])->getField('balance');
						$_var_307 = $_var_307 > 0 ? $_var_307 : 0;
						$_var_308 = 0;
						$_var_308 = $_var_286->where(['id' => $_var_290['uid']])->setInc('balance', $_var_305);
						$_var_309 = 0;
						$_var_309 = self::gettrano();
						$_var_310 = [];
						$_var_310['trano'] = $_var_309;
						$_var_310['uid'] = $_var_290['uid'];
						$_var_310['username'] = $_var_290['username'];
						$_var_310['type'] = 'activity_yks';
						$_var_310['typename'] = '月亏损赠送';
						$_var_310['amount'] = $_var_305;
						$_var_310['amountbefor'] = $_var_307;
						$_var_310['amountafter'] = $_var_307 + $_var_305;
						$_var_310['oddtime'] = strtotime($_var_282);
						$_var_310['remark'] = '本人月亏损赠送活动';
						if ($_var_308) {
							$_var_296->data($_var_310)->add();
							$_var_297[] = $_var_290['uid'];
						}
					}
					if ($_var_306 > 0 && $_var_290['parentid']) {
						$_var_307 = 0;
						$_var_311 = $_var_286->where(['id' => $_var_290['parentid']])->field('balance,id,username')->find();
						$_var_307 = $_var_311['balance'] > 0 ? $_var_311['balance'] : 0;
						$_var_308 = 0;
						$_var_308 = $_var_286->where(['id' => $_var_311['id']])->setInc('balance', $_var_306);
						$_var_309 = $_var_309 ? $_var_309 : self::gettrano();
						$_var_310 = [];
						$_var_310['trano'] = $_var_309;
						$_var_310['uid'] = $_var_311['id'];
						$_var_310['username'] = $_var_311['username'];
						$_var_310['type'] = 'activity_yks';
						$_var_310['typename'] = '月亏损赠送';
						$_var_310['amount'] = $_var_306;
						$_var_310['amountbefor'] = $_var_307;
						$_var_310['amountafter'] = $_var_307 + $_var_306;
						$_var_310['oddtime'] = strtotime($_var_282);
						$_var_310['remark'] = "下线月亏损赠送活动({$_var_290['username']})";
						if ($_var_308) {
							$_var_296->data($_var_310)->add();
						}
					}
					break;
				}
			}
		}
		if (count(array_unique($_var_297)) >= 1) {
			F('jihuayuekuisuntime', time());
			$_var_312 = '月亏损赠送活动赠送成功';
		} else {
			$_var_312 = '月亏损赠送活动无记录或已经赠送';
		}
		return $_var_312;
	}
	protected function getsetting($_var_313 = '')
	{
		$_var_314 = M('setting')->select();
		$_var_315 = [];
		foreach ($_var_314 as $_var_316 => $_var_317) {
			$_var_315[$_var_317['name']] = $_var_317['value'];
		}
		if ($_var_313) {
			return $_var_315[$_var_313];
		}
		$_var_318 = [];
		$_var_318 = ['jihua_rixiaofei_shi' => intval($_var_315['jihua_rixiaofei_shi']), 'jihua_rixiaofei_fen' => intval($_var_315['jihua_rixiaofei_fen']), 'jihua_rikuisun_shi' => intval($_var_315['jihua_rikuisun_shi']), 'jihua_rikuisun_fen' => intval($_var_315['jihua_rikuisun_fen']), 'jihua_yuexiaofei_shi' => intval($_var_315['jihua_yuexiaofei_shi']), 'jihua_yuexiaofei_fen' => intval($_var_315['jihua_yuexiaofei_fen']), 'jihua_yuekuisun_shi' => intval($_var_315['jihua_yuekuisun_shi']), 'jihua_yuekuisun_fen' => intval($_var_315['jihua_yuekuisun_fen']), 'jihua_dailifandian_shi' => intval($_var_315['jihua_dailifandian_shi']), 'jihua_dailifandian_fen' => intval($_var_315['jihua_dailifandian_fen']), 'jihua_dbautoback_shi' => intval($_var_315['jihua_dbautoback_shi']), 'jihua_dbautoback_fen' => intval($_var_315['jihua_dbautoback_fen']) < 5 ? 5 : intval($_var_315['jihua_dbautoback_fen']), 'jihua_kaijiang_days' => intval($_var_315['jihua_kaijiang_days']) < 1 ? 1 : intval($_var_315['jihua_kaijiang_days']), 'jihua_touzhu_days' => intval($_var_315['jihua_touzhu_days']) < 45 ? 45 : intval($_var_315['jihua_touzhu_days']), 'jihua_fuddetail_days' => intval($_var_315['jihua_fuddetail_days']) < 45 ? 45 : intval($_var_315['jihua_fuddetail_days']), 'jihua_memlog_days' => intval($_var_315['jihua_memlog_days']) < 7 ? 7 : intval($_var_315['jihua_memlog_days']), 'jihua_adminlog_days' => intval($_var_315['jihua_adminlog_days']) < 7 ? 7 : intval($_var_315['jihua_adminlog_days'])];
		return $_var_318;
	}
	protected function gettrano($_var_319 = 4)
	{
		$_var_319 = intval($_var_319) > 0 && intval($_var_319) <= 6 ? intval($_var_319) : 4;
		$_var_320 = strtoupper(self::rand_string(3, 0)) . date('ymdHis') . self::rand_string($_var_319, 1);
		return $_var_320;
	}
	protected function GBK($_var_321)
	{
		return $_var_321 . '
	------';
	}
	protected function rand_string($_var_322 = 6, $_var_323 = 0, $_var_324 = '')
	{
		$_var_325 = new \Org\Util\String();
		$_var_326 = $_var_325->randString($_var_322, $_var_323, $_var_324);
		return $_var_326;
	}
	protected function auto_charset($_var_327, $_var_328 = 'gbk', $_var_329 = 'utf-8')
	{
		$_var_328 = strtoupper($_var_328) == 'UTF8' ? 'utf-8' : $_var_328;
		$_var_329 = strtoupper($_var_329) == 'UTF8' ? 'utf-8' : $_var_329;
		if (strtoupper($_var_328) === strtoupper($_var_329) || empty($_var_327) || is_scalar($_var_327) && !is_string($_var_327)) {
			return $_var_327;
		}
		if (is_string($_var_327)) {
			if (function_exists('mb_convert_encoding')) {
				return mb_convert_encoding($_var_327, $_var_329, $_var_328);
			} elseif (function_exists('iconv')) {
				return iconv($_var_328, $_var_329, $_var_327);
			} else {
				return $_var_327;
			}
		} elseif (is_array($_var_327)) {
			foreach ($_var_327 as $_var_330 => $_var_331) {
				$_var_332 = self::auto_charset($_var_330, $_var_328, $_var_329);
				$_var_327[$_var_332] = self::auto_charset($_var_331, $_var_328, $_var_329);
				if ($_var_330 != $_var_332) {
					unset($_var_327[$_var_330]);
				}
			}
			return $_var_327;
		} else {
			return $_var_327;
		}
	}
}