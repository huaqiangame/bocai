<?php
namespace Home\Controller;
use Think\Controller;
class JihuabaseController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
		set_time_limit (0);
		C('URL_MODEL',0);
	}
	function checkjihua($totalzxnum=0){
		$_t = time();
		//echo self::GBK("\n当前时间:".date('Y-m-d H:i:s',time()));
		$jihuaacts = [
			['act'=>'jihuarixiaofei','title'=>'每日消费赠送'],
			['act'=>'jihuarikuisun','title'=>'每日亏损赠送'],
			['act'=>'jihuayuexiaofei','title'=>'每月消费赠送'],
			['act'=>'jihuayuekuisun','title'=>'每月亏损赠送'],
			['act'=>'jihuaclearkaijiang','title'=>'开奖数据清理'],
			['act'=>'jihuacleartouzhu','title'=>'投注数据清理'],
			['act'=>'jihuaclearfuddetail','title'=>'账变记录清理'],
			['act'=>'jihuaclearmemlog','title'=>'会员日志清理'],
			['act'=>'jihuaclearadminlog','title'=>'管理员日志清理'],
			['act'=>'jihuadailifenhong','title'=>'代理分红'],
		];
		
		echo'<body style="width:100%; margin:0 auto; text-align:center;color:#666; font-size:12px;">';
		foreach($jihuaacts as $v){
			$actname  = $v['act'];
			$acttitle = $v['title'];
			$url = U('checkjihuado',array('actname'=>$actname,'acttitle'=>$acttitle));
			echo"<div style='width:100%; height:90px;'>";
			echo'<iframe src="'.$url.'" frameborder=0 width="100%" height="90" scrolling="no"></iframe><br>';
			echo"</div>";
		}
		echo'</body>'; 
	}
	function checkjihuado(){
		$jihuasettings = self::getsetting();
		$shuatime = 1800;
		$actname  = I('actname');
		$acttitle = I('acttitle');
		echo'<body onLoad="window.setInterval(shua,1000);" style="margin:0 auto; text-align:center;color:#666; font-size:12px;">';
		echo'<input name="button" value="刷新" onclick="window.location.reload();" type="button">'.$acttitle.'<br>';
		echo self::$actname($jihuasettings);
		echo"<div style='clear:both;'></div>";
		echo'<font id="hints" style="color:blue" >离下次刷新时间还有'.$shuatime.'秒</font>';
		echo'<script>var t; t='.$shuatime.'; function shua(){t=t-1;document.getElementById("hints").innerHTML="离下次刷新时间还有 "+t+" 秒";if (t==0){document.location.reload();}}</script>';
		echo'</body>'; 
	}
	//代理下线会员投注分红发放
	protected function jihuadailifenhong($jihuasettings,$page=0){
		$tdays = date('t',strtotime($m)); //上个月共多少天
		$m_statetime = date('Y-m-d H:i:s', mktime(0,0,0,date('m')-1,1,date('Y'))); //上个月的开始日期
		$m_endtime   = date('Y-m-d 23:59:59', mktime(0,0,0,date('m')-1,$tdays-1,date('Y'))); //上个月第一天的结束日期
		//$m_endtime   = date('Y-m-d 23:59:59', time()); //上个月的结束日期
		$BeginDate   = date('Y-m-01 H:i:s', strtotime(date("Y-m-d")));//本月第一天
		$_t = time();
		$_setdatetime    = $m_statetime;
		$_set_start_time = strtotime($BeginDate);
		$_set_end_time   = strtotime($BeginDate)+86400*30-1;
		//结算起始截至时间
		$jiesuan_start_time = $m_statetime;
		$jiesuan_end_time   = $m_endtime;
		$jihuadailifenhongtime = F('jihuadailifenhongtime');
		$beginToday = strtotime($BeginDate);//本月第一天开始时间戳
		$endToday   = strtotime("$BeginDate +1 month -1 day")+86400-1;//本月结束时间戳
		if($jihuadailifenhongtime && $jihuadailifenhongtime>=$beginToday && $jihuadailifenhongtime<=$endToday){
			return "上月代理分红已经赠送";
		}
		if($_t > $_set_end_time || $_t < $_set_start_time){
			return "上月代理分红时间点".date('Y-m-d H:i:s',$_set_start_time)."~".date('Y-m-d H:i:s',$_set_end_time);
		}
		//获取配置设置
		$Commissionlist = [];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('agentBonusBase0_0'),'benrenbili'=>self::getsetting('agentBonusBase0_1')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('agentBonusBase1_0'),'benrenbili'=>self::getsetting('agentBonusBase1_1')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('agentBonusBase2_0'),'benrenbili'=>self::getsetting('agentBonusBase2_1')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('agentBonusBase3_0'),'benrenbili'=>self::getsetting('agentBonusBase3_1')];
		/*dump($Commissionlist);
		dump($jiesuan_start_time);
		dump($jiesuan_end_time);
		exit;*/
		//获取所有的代理会员
		$totalcount = M('member')->where(['proxy'=>1,'isnb'=>0])->count();
		$pagesize = 1;
		$page = $page?$page:1;
		$totalpage = ceil($totalcount/$pagesize);
		$pagestart = ($page-1)*$pagesize;
		if($page>$totalpage){
			F('jihuadailifenhongtime',time());
			$return  = '代理分红已经全部赠送成功';
			return $return;
		}
		$agentuserlist = [];
		$agentuserlist = M('member')->where(['proxy'=>1,'isnb'=>0])->field('id,username')->limit($pagestart,$pagesize)->select();
		foreach($agentuserlist as $k=>$v){
			$agentinfo = [];
			$agentinfo = $v;
			//如果记录存在则跳出
			$uid = $agentinfo['id'];
			$isok = M('dailifenhong')->where("uid='{$uid}' and oddtime<=".strtotime($jiesuan_end_time)." and oddtime>=".strtotime($jiesuan_start_time))->find();
			if($isok)continue;
			
			//取所有的下线会员投注
			$downuserlist = [];$downuids = [];
			$downuserlist = M('member')->where(['parentid'=>$v['id'],'isnb'=>0])->field('id,username')->select();
			foreach($downuserlist as $k1=>$v1){
				$downuids[] = $v1['id'];
			}
			//获取总投注
			$tzsumamount=0;$fjsumamount=0;$yingkui=0;
			if($downuids){//存在时操作
				$map = [];
				$map['uid'] = ['in',$downuids];
				$map['isdraw'] = ['in',[1,-1]];
				$map['oddtime'][] = ['egt',strtotime($jiesuan_start_time)];
				$map['oddtime'][] = ['elt',strtotime($jiesuan_end_time)];
				$tzsumamount = M('touzhu')->where($map)->sum('amount');//投注金额
				$tzsumamount = $tzsumamount?$tzsumamount:0;
				$map = [];
				$map['uid'] = ['in',$downuids];
				$map['isdraw'] = ['eq',1];
				$map['oddtime'][] = ['egt',strtotime($jiesuan_start_time)];
				$map['oddtime'][] = ['elt',strtotime($jiesuan_end_time)];
				$fjsumamount = M('touzhu')->where($map)->sum('okamount');
				$fjsumamount = $fjsumamount?$fjsumamount:0;
				$yingkui = $tzsumamount - $fjsumamount;
				if($yingkui>0){
					foreach($Commissionlist as $kkk=>$Commisvo){
						$Commissions  = [];
						$Commissions  = explode('~',$Commisvo['CommissionBase']);
						$Commissions  = array_map('intval',$Commissions);
						$benrenbili   = floatval($Commisvo['benrenbili']);
						//如果记录存在则跳出
						//$todayisok = $fuddetaildb->where("type='activity_yks' and oddtime<=".strtotime($jiesuan_end_time)." and oddtime>=".strtotime($jiesuan_start_time))->find();
						//if($todayisok)break;
							
						if($Commissions[0] && $Commissions[1] && $yingkui>=$Commissions[0] && $yingkui<=$Commissions[1]){
							$amount_benren   = $yingkui * ($benrenbili/100);//本人
							//本人账户、账变操作
							if($amount_benren>0){
								$amountbefor = 0;
								$amountbefor = $memberdb->where(['id'=>$agentinfo['uid']])->getField('balance');
								$amountbefor = $amountbefor>0?$amountbefor:0;
								$_int0 = 0;
								if(!$isok)$_int0 = $memberdb->where(['id'=>$agentinfo['uid']])->setInc('balance',$amount_benren);
								$trano = 0;
								$trano = self::gettrano();
								$fuddetaildata = [];
								$fuddetaildata['trano'] = $trano;
								$fuddetaildata['uid'] = $agentinfo['uid'];
								$fuddetaildata['username'] = $agentinfo['username'];
								$fuddetaildata['type'] = 'fenhong';
								$fuddetaildata['typename'] = '代理分红';
								$fuddetaildata['amount'] = $amount_benren;
								$fuddetaildata['amountbefor'] = $amountbefor;
								$fuddetaildata['amountafter'] = $amountbefor + $amount_benren;
								$fuddetaildata['oddtime'] = strtotime($jiesuan_end_time);
								$fuddetaildata['remark'] = "下线会员总投注:{$tzsumamount},总返奖:{$tzsumamount},总亏:{$yingkui},分红规则:{$Commissions[0]}~{$Commissions[1]}={$benrenbili}%";
								if($_int0){
									if(!$isok)M('fuddetail')->data($fuddetaildata)->add();
									$_addints[] = $v['uid'];
								}
								$fenhongdata = [];
								$fenhongdata['trano'] = $trano?$trano:self::gettrano();
								$fenhongdata['uid'] = $agentinfo['uid'];
								$fenhongdata['username'] = $agentinfo['username'];
								$fenhongdata['tzsumamount'] = $tzsumamount;
								$fenhongdata['fjsumamount'] = $fjsumamount;
								$fenhongdata['yingkui'] = $yingkui;
								$fenhongdata['fanwei'] = $Commissions[0].'~'.$Commissions[1];
								$fenhongdata['bili'] = $benrenbili;
								$fenhongdata['amount'] = $amount_benren;
								$fenhongdata['oddtime'] = strtotime($jiesuan_end_time);
								if(!$isok)M('dailifenhong')->data($fuddetaildata)->add();
							}
							//break;//依次符合条件则退出循环
						}
					}
				}
			}
			
			
		}
		echo self::GBK("分红成功第".$page."/".$totalpage."页");
		//生成记录文件防止重复操作
		sleep(3);
		self::jihuadailifenhong($jihuasettings,$page+1);
	}

	//数据库备份
	protected function dbautoback($jihuasettings,$tabs = array(),$isbk=0){
		$id = $tabs['id'];
		$start = $tabs['start'];
		$_t = time();
		$jiange_time = $jihuasettings['jihua_dbautoback_fen'] * 60;
		$dbautobacktime = F('dbautobacktime');
		if($dbautobacktime && $_t < ($dbautobacktime + $jiange_time)){
			return "数据库下次备份时间：".date('Y-m-d H:i:s',$dbautobacktime + $jiange_time);
		}
		//读取备份配置
		$config = array(
			'path'     => DATA_PATH.'db/',  //路径
			'part'     => C('DB_PART'),  //分卷大小 20M
			'compress' => C('DB_COMPRESS'),  //0:不压缩 1:启用压缩
			'level'    => C('DB_LEVEL'),  //压缩级别, 1:普通 4:一般  9:最高
		);
		$lock = "{$config['path']}backup.lock";
        if($isbk==0){ //初始化
			$Db    = \Think\Db::getInstance();
			$list  = $Db->query('SHOW TABLE STATUS');
			foreach($list as $k0=>$v0){
				if($v0['Name'] == C('DB_PREFIX').'adminsession' || $v0['Name'] == C('DB_PREFIX').'membersession')unset($list[$k0]);
			}
			$list  = array_map('array_change_key_case', $list);
			$tables = [];
			foreach($list as $k=>$v){
				$tables[] = $v['name'];
			}
            //检查是否有正在执行的任务
            if(is_file($lock)){
                return '检测到有一个备份任务正在执行，请稍后再试！';
            } else {
                //创建锁文件
                file_put_contents($lock, time());
            }
            //检查备份目录是否可写 创建备份目录
            is_writeable($config['path']) || mkdir($config['path'],0777,true);
            session('backup_config', $config);

            //生成备份文件信息
            $file = array(
                'name' => date('Ymd-His', time()),
                'part' => 1,
            );
            session('backup_file', $file);

            //缓存要备份的表
            session('backup_tables', $tables);

            //创建备份文件
            $Database = new \Lib\Database($file, $config);
            if(false !== $Database->create()){
                $tab = array('id' => 0, 'start' => 0);
                echo self::GBK('数据库备份初始化成功！');
				self::dbautoback($jihuasettings,$tab,1);
            } else {
              return '初始化失败，备份文件创建失败！';
            }
        } elseif (is_numeric($id) && is_numeric($start)) { //备份数据
            $tables = session('backup_tables');
            //备份指定表
            $Database = new \Lib\Database(session('backup_file'), session('backup_config'));
            $start  = $Database->backup($tables[$id], $start);
            if(false === $start){ //出错
                return '备份出错！';
            } elseif (0 === $start) { //下一表
                if(isset($tables[++$id])){
                    $tab = array('id' => $id, 'start' => 0);
					echo self::GBK('备份完成-'.$tables[$id]);
                    self::dbautoback($jihuasettings,$tab,1);
                } else { //备份完成，清空缓存
                    unlink(session('backup_config.path') . 'backup.lock');
                    session('backup_tables', null);
                    session('backup_file', null);
                    session('backup_config', null);
					if($id == count($tables) && !is_file($lock)){
						//$return = '本轮备份全部完成';
						//dump($return.'-'.$id);
						//return $return;
					}
                    return '备份完成！';
                }
            } else {
                $tab  = array('id' => $id, 'start' => $start[0]);
                $rate = floor(100 * ($start[0] / $start[1]));
				echo self::GBK("正在备份...({$rate}%)");
				self::dbautoback($jihuasettings,$tab,1);
            }
				
        } else { //出错
            return '参数错误！';
        }
		F('dbautobacktime',time());
		return '本轮备份全部完成';
	}
	//清理N天前的数据库备份
	protected function cleardbback($days = 7){
		$days = intval($days);
		$_t = time();
		$cleardbbacktime = F('cleardbbacktime');
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		if($cleardbbacktime && $cleardbbacktime>=$beginToday && $cleardbbacktime<=$endToday){
			return "自动备份的数据库今日已清理";
		}
		//计算删除时间
		$_deletetime = $beginToday - 86400*$days - 1;
		$dir = DATA_PATH.'db/';
		//$dir = './JIHUADATA/db/';
		$isok = false;$files = [];
		if ( $handle = opendir($dir) ) {
			while ( ($file = readdir($handle)) !== false ) 
			{
				if ( $file != ".." && $file != "." ) 
				{
					if ( is_dir($dir . "/" . $file) ) {}
					
					else{
						$_file = $dir . "/" . $file;
						$filectime = filectime($_file);
						if($filectime<=$_deletetime){
							$_delint = unlink($_file);
							if($_delint){
								$isok = true;
							}
						}
						$files[] = $_file;
					}
				}
			}
			closedir($handle);
		}
		if($isok){
			F('cleardbbacktime',time());
			$return  = '自动备份的数据库清理成功';
		}else{
			$return  = '暂无备份数据需清理';
		}
		return $return;
	}
	//开奖数据清理
	protected function jihuaclearkaijiang($jihuasettings){
		$_t = time();
		$jihua_kaijiang_days = $jihuasettings['jihua_kaijiang_days'];
		$jihuaclearkaijiangtime = F('jihuaclearkaijiangtime');
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		if($jihuaclearkaijiangtime && $jihuaclearkaijiangtime>=$beginToday && $jihuaclearkaijiangtime<=$endToday){
			return "开奖数据今天已经清理";
		}
		//计算删除时间
		$_deletetime = $beginToday - 86400*$jihua_kaijiang_days - 1;
		$map = [];
		$map['addtime'] = ['elt',$_deletetime];
		$_int = M('kaijiang')->where($map)->delete();
		//生成记录文件防止重复操作
		if($_int){
			F('jihuaclearkaijiangtime',time());
			$return  = '开奖数据清理成功';
		}else{
			$return  = '开奖数据已经清理';
		}
		return $return;
	}
	//投注数据清理
	protected function jihuacleartouzhu($jihuasettings){
		$_t = time();
		$jihua_touzhu_days = $jihuasettings['jihua_touzhu_days'];
		$jihuacleartouzhutime = F('jihuacleartouzhutime');
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		if($jihuacleartouzhutime && $jihuacleartouzhutime>=$beginToday && $jihuacleartouzhutime<=$endToday){
			return "投注数据今天已经清理";
		}
		//计算删除时间
		$_deletetime = $beginToday - 86400*$jihua_touzhu_days - 1;
		$map = [];
		$map['oddtime'] = ['elt',$_deletetime];
		$_int = M('touzhu')->where($map)->delete();
		//生成记录文件防止重复操作
		if($_int){
			F('jihuacleartouzhutime',time());
			$return  = '投注数据清理成功';
		}else{
			$return  = '投注数据已经清理';
		}
		return $return;
	}
	//账变记录数据清理
	protected function jihuaclearfuddetail($jihuasettings){
		$_t = time();
		$jihua_fuddetail_days = $jihuasettings['jihua_fuddetail_days'];
		$jihuaclearfuddetailtime = F('jihuaclearfuddetailtime');
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		if($jihuaclearfuddetailtime && $jihuaclearfuddetailtime>=$beginToday && $jihuaclearfuddetailtime<=$endToday){
			return "账变记录今天已经清理";
		}
		//计算删除时间
		$_deletetime = $beginToday - 86400*$jihua_fuddetail_days - 1;
		$map = [];
		$map['oddtime'] = ['elt',$_deletetime];
		$_int = M('fuddetail')->where($map)->delete();
		//生成记录文件防止重复操作
		if($_int){
			F('jihuaclearfuddetailtime',time());
			$return  = '账变记录清理成功';
		}else{
			$return  = '账变记录已经清理';
		}
		return $return;
	}
	//会员日志清理
	protected function jihuaclearmemlog($jihuasettings){
		$_t = time();
		$jihua_memlog_days = $jihuasettings['jihua_memlog_days'];
		$jihuaclearmemlogtime = F('jihuaclearmemlogtime');
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		if($jihuaclearmemlogtime && $jihuaclearmemlogtime>=$beginToday && $jihuaclearmemlogtime<=$endToday){
			return "会员日志今天已经清理";
		}
		//计算删除时间
		$_deletetime = $beginToday - 86400*$jihua_memlog_days - 1;
		$map = [];
		$map['time'] = ['elt',$_deletetime];
		$_int = M('memberlog')->where($map)->delete();
		//生成记录文件防止重复操作
		if($_int){
			F('jihuaclearmemlogtime',time());
			$return  = '会员日志清理成功';
		}else{
			$return  = '会员日志已经清理';
		}
		return $return;
	}
	//管理员日志清理
	protected function jihuaclearadminlog($jihuasettings){
		$_t = time();
		$jihua_adminlog_days = $jihuasettings['jihua_adminlog_days'];
		$jihuaclearadminlogtime = F('jihuaclearadminlogtime');
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		if($jihuaclearadminlogtime && $jihuaclearadminlogtime>=$beginToday && $jihuaclearadminlogtime<=$endToday){
			return "会员日志今天已经清理";
		}
		//计算删除时间
		$_deletetime = $beginToday - 86400*$jihua_adminlog_days - 1;
		$map = [];
		$map['time'] = ['elt',$_deletetime];
		$_int = M('adminlog')->where($map)->delete();
		//生成记录文件防止重复操作
		if($_int){
			F('jihuaclearadminlogtime',time());
			$return  = '管理员日志清理成功';
		}else{
			$return  = '管理员日志已经清理';
		}
		return $return;
	}
	//每日消费赠送活动
	protected function jihuarixiaofei($jihuasettings){
		$_t = time();
		$_setdatetime    = date('Y-m-d H:i:s',strtotime($jihuasettings['jihua_rixiaofei_shi'].':'.$jihuasettings['jihua_rixiaofei_fen']));
		$_set_start_time = strtotime($_setdatetime);
		$_set_end_time   = strtotime($_setdatetime)+5*60;
		//结算起始截至时间
		$jiesuan_start_time = date('Y-m-d 00:00:00',$_t-86400);
		$jiesuan_end_time   = date('Y-m-d 23:59:59',$_t-86400);
		//$jiesuan_end_time   = date('Y-m-d 23:59:59',$_t);
		$jihuarixiaofeitime = F('jihuarixiaofeitime');
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		if($jihuarixiaofeitime && $jihuarixiaofeitime>=$beginToday && $jihuarixiaofeitime<=$endToday){
			return "日消费赠送活动已经赠送";
		}
		if($_t > $_set_end_time || $_t < $_set_start_time){
			return "日消费赠送活动时间点".date('Y-m-d H:i:s',$_set_start_time)."~".date('Y-m-d H:i:s',$_set_end_time);
		}
		//获取所有的昨日有投注会员(排除内部会员)
		$memberdb = M('member');
		
		$nbuserlist = [];$nbuserids = [];
		$nbuserlist = $memberdb->where(['isnb'=>1])->field('id,username')->select();//内部会员
		foreach($nbuserlist as $k=>$v){
			$nbuserids[] = $v['id'];
		}
		$map = [];
		if($nbuserids)$map['uid'] = ['not in',$nbuserids];
		$map['oddtime'][] = ['egt',strtotime($jiesuan_start_time)];
		$map['oddtime'][] = ['elt',strtotime($jiesuan_end_time)];
		$map['isdraw'] = ['in',[1,-1]];
		$DB_FIX = C('DB_PREFIX');
		$tzulist = [];
		$tzulist = M('touzhu')
		-> where($map)
		-> alias('a')
        -> join(" {$DB_FIX}member as b on a.uid = b.id ")
		-> field("a.uid, a.username, b.parentid, sum(a.amount) as amount")
		-> group("uid")
		-> select();
		/*$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$udb = M('member');
		$this->totalpayaccount = M('payaccount') -> alias('a')
        -> join("{$DB_FIX}member as b on a.uid = b.id and a.status=1 and b.istest=0")
        -> sum('amount');*/
		//获取配置设置
		$Commissionlist = [];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('riCommissionBase0_0'),'benrenbili'=>self::getsetting('riCommissionBase0_1'),'shangjiabili'=>self::getsetting('riCommissionBase0_2')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('riCommissionBase1_0'),'benrenbili'=>self::getsetting('riCommissionBase1_1'),'shangjiabili'=>self::getsetting('riCommissionBase1_2')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('riCommissionBase2_0'),'benrenbili'=>self::getsetting('riCommissionBase2_1'),'shangjiabili'=>self::getsetting('riCommissionBase2_2')];
		$fuddetaildb = M('fuddetail');
		$_addints = [];
		foreach($tzulist as $k=>$v){
			foreach($Commissionlist as $kkk=>$Commisvo){
				$Commissions  = [];
				$Commissions  = explode('~',$Commisvo['CommissionBase']);
				$Commissions  = array_map('intval',$Commissions);
				$benrenbili   = floatval($Commisvo['benrenbili']);
				$shangjiabili = floatval($Commisvo['shangjiabili']);
				//如果记录存在则跳出
				$uid = 0;
				$uid = $v['uid'];
				$todayisok = $fuddetaildb->where("type='activity_rxf' and uid='{$uid}' and oddtime<=".strtotime($jiesuan_end_time)." and oddtime>=".strtotime($jiesuan_start_time))->find();
					
				if(!$todayisok && $Commissions[0] && $Commissions[1] && $v['amount']>=$Commissions[0] && $v['amount']<=$Commissions[1]){
					$amount_benren   = $v['amount'] * ($benrenbili/100);//本人
					$amount_shangjia = $v['amount'] * ($shangjiabili/100);//上家
					//本人账户、账变操作
					if($amount_benren>0){
						$amountbefor = 0;
						$amountbefor = $memberdb->where(['id'=>$v['uid']])->getField('balance');
						$amountbefor = $amountbefor>0?$amountbefor:0;
						$_int0 = 0;
						$_int0 = $memberdb->where(['id'=>$v['uid']])->setInc('balance',$amount_benren);
						$trano = 0;
						$trano = self::gettrano();
						$fuddetaildata = [];
						$fuddetaildata['trano'] = $trano;
						$fuddetaildata['uid'] = $v['uid'];
						$fuddetaildata['username'] = $v['username'];
						$fuddetaildata['type'] = 'activity_rxf';
						$fuddetaildata['typename'] = '日消费赠送';
						$fuddetaildata['amount'] = $amount_benren;
						$fuddetaildata['amountbefor'] = $amountbefor;
						$fuddetaildata['amountafter'] = $amountbefor + $amount_benren;
						$fuddetaildata['oddtime'] = strtotime($jiesuan_end_time);
						$fuddetaildata['remark'] = '本人日消费赠送活动';
						if($_int0){
							$fuddetaildb->data($fuddetaildata)->add();
							$_addints[] = $v['uid'];
						}
					}
					//上家账户、账变操作
					if($amount_shangjia>0 && $v['parentid']){
						$amountbefor = 0;
						$parentuser = $memberdb->where(['id'=>$v['parentid']])->field('balance,id,username')->find();
						$amountbefor = $parentuser['balance']>0?$parentuser['balance']:0;
						$_int0 = 0;
						$_int0 = $memberdb->where(['id'=>$parentuser['id']])->setInc('balance',$amount_shangjia);
						$trano = $trano?$trano:self::gettrano();
						$fuddetaildata = [];
						$trano = $trano?$trano:self::gettrano();
						$fuddetaildata['uid'] = $parentuser['id'];
						$fuddetaildata['username'] = $parentuser['username'];
						$fuddetaildata['type'] = 'activity_rxf';
						$fuddetaildata['typename'] = '日消费赠送';
						$fuddetaildata['amount'] = $amount_shangjia;
						$fuddetaildata['amountbefor'] = $amountbefor;
						$fuddetaildata['amountafter'] = $amountbefor + $amount_shangjia;
						$fuddetaildata['oddtime'] = strtotime($jiesuan_end_time);
						$fuddetaildata['remark'] = "下线日消费赠送活动({$v['username']})";
						if($_int0)$fuddetaildb->data($fuddetaildata)->add();
					}
					break;//依次符合条件则退出循环
				}
			}
		}
		//生成记录文件防止重复操作
		if(count(array_unique($_addints))>=1){
			F('jihuarixiaofeitime',time());
			$return  = '日消费赠送活动赠送成功';
		}else{
			$return  = '日消费赠送活动无记录或已经赠送过';
		}
		return $return;
		
	}
	//日亏损赠送活动
	protected function jihuarikuisun($jihuasettings){
		$_t = time();
		$_setdatetime    = date('Y-m-d H:i:s',strtotime($jihuasettings['jihua_rikuisun_shi'].':'.$jihuasettings['jihua_rikuisun_fen']));
		$_set_start_time = strtotime($_setdatetime);
		$_set_end_time   = strtotime($_setdatetime)+5*60;
		//结算起始截至时间
		$jiesuan_start_time = date('Y-m-d 00:00:00',$_t-86400);
		$jiesuan_end_time   = date('Y-m-d 23:59:59',$_t-86400);
		//$jiesuan_end_time   = date('Y-m-d 23:59:59',$_t);
		$jihuarikuisuntime = F('jihuarikuisuntime');
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		if($jihuarikuisuntime && $jihuarikuisuntime>=$beginToday && $jihuarikuisuntime<=$endToday){
			return "日亏损赠送活动已经赠送";
		}
		if($_t > $_set_end_time || $_t < $_set_start_time){
			return "日亏损赠送活动时间点".date('Y-m-d H:i:s',$_set_start_time)."~".date('Y-m-d H:i:s',$_set_end_time);
		}
		//获取所有的昨日有投注会员(排除内部会员)
		$memberdb = M('member');
		
		$nbuserlist = [];$nbuserids = [];
		$nbuserlist = $memberdb->where(['isnb'=>1])->field('id,username')->select();//内部会员
		foreach($nbuserlist as $k=>$v){
			$nbuserids[] = $v['id'];
		}
		$map = [];
		if($nbuserids)$map['uid'] = ['not in',$nbuserids];
		$map['oddtime'][] = ['egt',strtotime($jiesuan_start_time)];
		$map['oddtime'][] = ['elt',strtotime($jiesuan_end_time)];
		$map['isdraw'] = ['in',[1,-1]];
		$DB_FIX = C('DB_PREFIX');
		$tzulist = [];
		$tzulist = M('touzhu')
		-> where($map)
		-> alias('a')
        -> join(" {$DB_FIX}member as b on a.uid = b.id ")
		-> field("a.uid, a.username, b.parentid, sum(a.amount) as tzamount, sum(a.okamount) as okamount")
		-> group("uid")
		-> select();
		if($tzulist)foreach($tzulist as $k=>$v){
			$kuisunamount = 0;
			$kuisunamount = $v['okamount']-$v['tzamount'];
			if($kuisunamount<0){
				$kuisunamount = abs($kuisunamount);
			}else{
				$kuisunamount = 0;
			}
			$v['amount'] = $kuisunamount;
			$tzulist[$k] = $v;
		}
		//获取配置设置
		$Commissionlist = [];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('riKuisunBase0_0'),'benrenbili'=>self::getsetting('riKuisunBase0_1'),'shangjiabili'=>self::getsetting('riKuisunBase0_2')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('riKuisunBase1_0'),'benrenbili'=>self::getsetting('riKuisunBase1_1'),'shangjiabili'=>self::getsetting('riKuisunBase1_2')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('riKuisunBase2_0'),'benrenbili'=>self::getsetting('riKuisunBase2_1'),'shangjiabili'=>self::getsetting('riKuisunBase2_2')];
		$fuddetaildb = M('fuddetail');
		$_addints = [];
		foreach($tzulist as $k=>$v){
			foreach($Commissionlist as $kkk=>$Commisvo){
				$Commissions  = [];
				$Commissions  = explode('~',$Commisvo['CommissionBase']);
				$Commissions  = array_map('intval',$Commissions);
				$benrenbili   = floatval($Commisvo['benrenbili']);
				$shangjiabili = floatval($Commisvo['shangjiabili']);
				//如果记录存在则跳出
				$uid = 0;
				$uid = $v['uid'];
				$todayisok = $fuddetaildb->where("type='activity_rks' and uid='{$uid}' and oddtime<=".strtotime($jiesuan_end_time)." and oddtime>=".strtotime($jiesuan_start_time))->find();
				//if($todayisok)break;
					
				if($todayisok && $Commissions[0] && $Commissions[1] && $v['amount']>=$Commissions[0] && $v['amount']<=$Commissions[1]){
					$amount_benren   = $v['amount'] * ($benrenbili/100);//本人
					$amount_shangjia = $v['amount'] * ($shangjiabili/100);//上家
					//本人账户、账变操作
					if($amount_benren>0){
						$amountbefor = 0;
						$amountbefor = $memberdb->where(['id'=>$v['uid']])->getField('balance');
						$amountbefor = $amountbefor>0?$amountbefor:0;
						$_int0 = 0;
						$_int0 = $memberdb->where(['id'=>$v['uid']])->setInc('balance',$amount_benren);
						$trano = 0;
						$trano = self::gettrano();
						$fuddetaildata = [];
						$fuddetaildata['trano'] = $trano;
						$fuddetaildata['uid'] = $v['uid'];
						$fuddetaildata['username'] = $v['username'];
						$fuddetaildata['type'] = 'activity_rks';
						$fuddetaildata['typename'] = '日亏损赠送';
						$fuddetaildata['amount'] = $amount_benren;
						$fuddetaildata['amountbefor'] = $amountbefor;
						$fuddetaildata['amountafter'] = $amountbefor + $amount_benren;
						$fuddetaildata['oddtime'] = strtotime($jiesuan_end_time);
						$fuddetaildata['remark'] = '本人日亏损赠送活动';
						if($_int0){
							$fuddetaildb->data($fuddetaildata)->add();
							$_addints[] = $v['uid'];
						}
					}
					//上家账户、账变操作
					if($amount_shangjia>0 && $v['parentid']){
						$amountbefor = 0;
						$parentuser = $memberdb->where(['id'=>$v['parentid']])->field('balance,id,username')->find();
						$amountbefor = $parentuser['balance']>0?$parentuser['balance']:0;
						$_int0 = 0;
						$_int0 = $memberdb->where(['id'=>$parentuser['id']])->setInc('balance',$amount_shangjia);
						$trano = $trano?$trano:self::gettrano();
						$fuddetaildata = [];
						$fuddetaildata['trano'] = $trano;
						$fuddetaildata['uid'] = $parentuser['id'];
						$fuddetaildata['username'] = $parentuser['username'];
						$fuddetaildata['type'] = 'activity_rks';
						$fuddetaildata['typename'] = '日亏损赠送';
						$fuddetaildata['amount'] = $amount_shangjia;
						$fuddetaildata['amountbefor'] = $amountbefor;
						$fuddetaildata['amountafter'] = $amountbefor + $amount_shangjia;
						$fuddetaildata['oddtime'] = strtotime($jiesuan_end_time);
						$fuddetaildata['remark'] = "下线日亏损赠送活动({$v['username']})";
						if($_int0)$fuddetaildb->data($fuddetaildata)->add();
					}
					break;//依次符合条件则退出循环
				}
			}
		}
		//生成记录文件防止重复操作
		if(count(array_unique($_addints))>=1){
			F('jihuarikuisuntime',time());
			$return  = '日亏损赠送活动赠送成功';
		}else{
			$return  = '日亏损赠送活动无记录或已经赠送过';
		}
		return $return;
	}
	//每月消费赠送活动
	protected function jihuayuexiaofei($jihuasettings){
		$tdays = date('t',strtotime($m)); //上个月共多少天
		$m_statetime = date('Y-m-d H:i:s', mktime(0,0,0,date('m')-1,1,date('Y'))); //上个月的开始日期
		$m_endtime   = date('Y-m-d 23:59:59', mktime(0,0,0,date('m')-1,$tdays-1,date('Y'))); //上个月的结束日期
		//$m_endtime   = date('Y-m-d 23:59:59', time()); //上个月的结束日期
		$BeginDate   = date('Y-m-01 H:i:s', strtotime(date("Y-m-d")));//本月第一天
		$_t = time();
		$_setdatetime    = date( 'Y-m-d H:i:s', strtotime(date('Y-m-01 H:i:s',strtotime($jihuasettings['jihua_yuexiaofei_shi'].':'.$jihuasettings['jihua_yuexiaofei_fen']))) );
		$_set_start_time = strtotime($_setdatetime);
		$_set_end_time   = strtotime($_setdatetime)+5*60;
		//结算起始截至时间
		$jiesuan_start_time = $m_statetime;
		$jiesuan_end_time   = $m_endtime;
		$jihuayuexiaofeitime = F('jihuayuexiaofeitime');
		$beginToday = strtotime($BeginDate);//本月第一天开始时间戳
		$endToday   = strtotime("$BeginDate +1 month -1 day")+86400-1;//本月结束时间戳
		if($jihuayuexiaofeitime && $jihuayuexiaofeitime>=$beginToday && $jihuayuexiaofeitime<=$endToday){
			return "月消费赠送已经赠送过";
		}
		if($_t > $_set_end_time || $_t < $_set_start_time){
			return "月消费赠送活动时间点".date('Y-m-d H:i:s',$_set_start_time)."~".date('Y-m-d H:i:s',$_set_end_time);
		}
		//获取所有的昨日有投注会员(排除内部会员)
		$memberdb = M('member');
		
		$nbuserlist = [];$nbuserids = [];
		$nbuserlist = $memberdb->where(['isnb'=>1])->field('id,username')->select();//内部会员
		foreach($nbuserlist as $k=>$v){
			$nbuserids[] = $v['id'];
		}
		$map = [];
		if($nbuserids)$map['uid'] = ['not in',$nbuserids];
		$map['oddtime'][] = ['egt',strtotime($jiesuan_start_time)];
		$map['oddtime'][] = ['elt',strtotime($jiesuan_end_time)];
		$map['isdraw'] = ['in',[1,-1]];
		$DB_FIX = C('DB_PREFIX');
		$tzulist = [];
		$tzulist = M('touzhu')
		-> where($map)
		-> alias('a')
        -> join(" {$DB_FIX}member as b on a.uid = b.id ")
		-> field("a.uid, a.username, b.parentid, sum(a.amount) as amount")
		-> group("uid")
		-> select();
		/*$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$udb = M('member');
		$this->totalpayaccount = M('payaccount') -> alias('a')
        -> join("{$DB_FIX}member as b on a.uid = b.id and a.status=1 and b.istest=0")
        -> sum('amount');*/
		//获取配置设置
		$Commissionlist = [];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('yueCommissionBase0_0'),'benrenbili'=>self::getsetting('yueCommissionBase0_1'),'shangjiabili'=>self::getsetting('yueCommissionBase0_2')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('yueCommissionBase1_0'),'benrenbili'=>self::getsetting('yueCommissionBase1_1'),'shangjiabili'=>self::getsetting('yueCommissionBase1_2')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('yueCommissionBase2_0'),'benrenbili'=>self::getsetting('yueCommissionBase2_1'),'shangjiabili'=>self::getsetting('yueCommissionBase2_2')];
		$fuddetaildb = M('fuddetail');
		$_addints = [];
		if($tzulist)foreach($tzulist as $k=>$v){
			foreach($Commissionlist as $kkk=>$Commisvo){
				$Commissions  = [];
				$Commissions  = explode('~',$Commisvo['CommissionBase']);
				$Commissions  = array_map('intval',$Commissions);
				$benrenbili   = floatval($Commisvo['benrenbili']);
				$shangjiabili = floatval($Commisvo['shangjiabili']);
				//如果记录存在则跳出
				$uid = 0;
				$uid = $v['uid'];
				$todayisok = $fuddetaildb->where("type='activity_yxf' and uid='{$uid}' and oddtime<=".strtotime($jiesuan_end_time)." and oddtime>=".strtotime($jiesuan_start_time))->find();
				//if($todayisok)break;
					
				if(!$todayisok && $Commissions[0] && $Commissions[1] && $v['amount']>=$Commissions[0] && $v['amount']<=$Commissions[1]){
					$amount_benren   = $v['amount'] * ($benrenbili/100);//本人
					$amount_shangjia = $v['amount'] * ($shangjiabili/100);//上家
					//本人账户、账变操作
					if($amount_benren>0){
						$amountbefor = 0;
						$amountbefor = $memberdb->where(['id'=>$v['uid']])->getField('balance');
						$amountbefor = $amountbefor>0?$amountbefor:0;
						$_int0 = 0;
						$_int0 = $memberdb->where(['id'=>$v['uid']])->setInc('balance',$amount_benren);
						$trano = 0;
						$trano = self::gettrano();
						$fuddetaildata = [];
						$fuddetaildata['trano'] = $trano;
						$fuddetaildata['uid'] = $v['uid'];
						$fuddetaildata['username'] = $v['username'];
						$fuddetaildata['type'] = 'activity_yxf';
						$fuddetaildata['typename'] = '月消费赠送';
						$fuddetaildata['amount'] = $amount_benren;
						$fuddetaildata['amountbefor'] = $amountbefor;
						$fuddetaildata['amountafter'] = $amountbefor + $amount_benren;
						$fuddetaildata['oddtime'] = strtotime($jiesuan_end_time);
						$fuddetaildata['remark'] = '本人月消费赠送赠送活动';
						if($_int0){
							$fuddetaildb->data($fuddetaildata)->add();
							$_addints[] = $v['uid'];
						}
					}
					//上家账户、账变操作
					if($amount_shangjia>0 && $v['parentid']){
						$amountbefor = 0;
						$parentuser = $memberdb->where(['id'=>$v['parentid']])->field('balance,id,username')->find();
						$amountbefor = $parentuser['balance']>0?$parentuser['balance']:0;
						$_int0 = 0;
						$_int0 = $memberdb->where(['id'=>$parentuser['id']])->setInc('balance',$amount_shangjia);
						$fuddetaildata = [];
						$trano = $trano?$trano:self::gettrano();
						$fuddetaildata['trano'] = $trano;
						$fuddetaildata['uid'] = $parentuser['id'];
						$fuddetaildata['username'] = $parentuser['username'];
						$fuddetaildata['type'] = 'activity_yxf';
						$fuddetaildata['typename'] = '月消费赠送';
						$fuddetaildata['amount'] = $amount_shangjia;
						$fuddetaildata['amountbefor'] = $amountbefor;
						$fuddetaildata['amountafter'] = $amountbefor + $amount_shangjia;
						$fuddetaildata['oddtime'] = strtotime($jiesuan_end_time);
						$fuddetaildata['remark'] = "月消费赠送赠送活动({$v['username']})";
						if($_int0)$fuddetaildb->data($fuddetaildata)->add();
					}
					break;//依次符合条件则退出循环
				}
			}
		}
		//生成记录文件防止重复操作
		if(count(array_unique($_addints))>=1){
			F('jihuayuexiaofeitime',time());
			$return  = '每月消费赠送活动赠送成功';
		}else{
			$return  = '每月消费赠送活动无记录或已经赠送过';
		}
		return $return;
	}
	//月亏损赠送活动
	protected function jihuayuekuisun($jihuasettings){
		$tdays = date('t',strtotime($m)); //上个月共多少天
		$m_statetime = date('Y-m-d H:i:s', mktime(0,0,0,date('m')-1,1,date('Y'))); //上个月的开始日期
		$m_endtime   = date('Y-m-d 23:59:59', mktime(0,0,0,date('m')-1,$tdays,date('Y'))); //上个月的结束日期
		//$m_endtime   = date('Y-m-d 23:59:59', time()); //上个月的结束日期
		$BeginDate   = date('Y-m-01 H:i:s', strtotime(date("Y-m-d")));//本月第一天
		$_t = time();
		$_setdatetime    = date( 'Y-m-d H:i:s', strtotime(date('Y-m-01 H:i:s',strtotime($jihuasettings['jihua_yuekuisun_shi'].':'.$jihuasettings['jihua_yuekuisun_fen']))) );
		$_set_start_time = strtotime($_setdatetime);
		$_set_end_time   = strtotime($_setdatetime)+5*60;
		//结算起始截至时间
		$jiesuan_start_time = $m_statetime;
		$jiesuan_end_time   = $m_endtime;
		$jihuayuekuisuntime = F('jihuayuekuisuntime');
		$beginToday = strtotime($BeginDate);//本月第一天开始时间戳
		$endToday   = strtotime("$BeginDate +1 month -1 day")+86400-1;//本月结束时间戳
		if($jihuayuekuisuntime && $jihuayuekuisuntime>=$beginToday && $jihuayuekuisuntime<=$endToday){
			return "上月亏损赠送活动已经赠送";
		}
		if($_t > $_set_end_time || $_t < $_set_start_time){
			return "月亏损赠送活动时间点".date('Y-m-d H:i:s',$_set_start_time)."~".date('Y-m-d H:i:s',$_set_end_time);
		}
		//获取所有的昨日有投注会员(排除内部会员)
		$memberdb = M('member');
		
		$nbuserlist = [];$nbuserids = [];
		$nbuserlist = $memberdb->where(['isnb'=>1])->field('id,username')->select();//内部会员
		foreach($nbuserlist as $k=>$v){
			$nbuserids[] = $v['id'];
		}
		$map = [];
		if($nbuserids)$map['uid'] = ['not in',$nbuserids];
		$map['oddtime'][] = ['egt',strtotime($jiesuan_start_time)];
		$map['oddtime'][] = ['elt',strtotime($jiesuan_end_time)];
		$map['isdraw'] = ['in',[1,-1]];
		$DB_FIX = C('DB_PREFIX');
		$tzulist = [];
		$tzulist = M('touzhu')
		-> where($map)
		-> alias('a')
        -> join(" {$DB_FIX}member as b on a.uid = b.id ")
		-> field("a.uid, a.username, b.parentid, sum(a.amount) as tzamount, sum(a.okamount) as okamount")
		-> group("uid")
		-> select();
		if($tzulist)foreach($tzulist as $k=>$v){
			$kuisunamount = 0;
			$kuisunamount = $v['okamount']-$v['tzamount'];
			if($kuisunamount<0){
				$kuisunamount = abs($kuisunamount);
			}else{
				$kuisunamount = 0;
			}
			$v['amount'] = $kuisunamount;
			$tzulist[$k] = $v;
		}
		//获取配置设置
		$Commissionlist = [];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('yueKuisunBase0_0'),'benrenbili'=>self::getsetting('yueKuisunBase0_1'),'shangjiabili'=>self::getsetting('yueKuisunBase0_2')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('yueKuisunBase1_0'),'benrenbili'=>self::getsetting('yueKuisunBase1_1'),'shangjiabili'=>self::getsetting('yueKuisunBase1_2')];
		$Commissionlist[] = ['CommissionBase'=>self::getsetting('yueKuisunBase2_0'),'benrenbili'=>self::getsetting('yueKuisunBase2_1'),'shangjiabili'=>self::getsetting('yueKuisunBase2_2')];
		$fuddetaildb = M('fuddetail');
		$_addints = [];
		foreach($tzulist as $k=>$v){
			foreach($Commissionlist as $kkk=>$Commisvo){
				$Commissions  = [];
				$Commissions  = explode('~',$Commisvo['CommissionBase']);
				$Commissions  = array_map('intval',$Commissions);
				$benrenbili   = floatval($Commisvo['benrenbili']);
				$shangjiabili = floatval($Commisvo['shangjiabili']);
				//如果记录存在则跳出
				$uid = 0;
				$uid = $v['uid'];
				$todayisok = $fuddetaildb->where("type='activity_yks' and uid='{$uid}' and oddtime<=".strtotime($jiesuan_end_time)." and oddtime>=".strtotime($jiesuan_start_time))->find();
				//if($todayisok)break;
					
				if(!$todayisok && $Commissions[0] && $Commissions[1] && $v['amount']>=$Commissions[0] && $v['amount']<=$Commissions[1]){
					$amount_benren   = $v['amount'] * ($benrenbili/100);//本人
					$amount_shangjia = $v['amount'] * ($shangjiabili/100);//上家
					//本人账户、账变操作
					if($amount_benren>0){
						$amountbefor = 0;
						$amountbefor = $memberdb->where(['id'=>$v['uid']])->getField('balance');
						$amountbefor = $amountbefor>0?$amountbefor:0;
						$_int0 = 0;
						$_int0 = $memberdb->where(['id'=>$v['uid']])->setInc('balance',$amount_benren);
						$trano = 0;
						$trano = self::gettrano();
						$fuddetaildata = [];
						$fuddetaildata['trano'] = $trano;
						$fuddetaildata['uid'] = $v['uid'];
						$fuddetaildata['username'] = $v['username'];
						$fuddetaildata['type'] = 'activity_yks';
						$fuddetaildata['typename'] = '月亏损赠送';
						$fuddetaildata['amount'] = $amount_benren;
						$fuddetaildata['amountbefor'] = $amountbefor;
						$fuddetaildata['amountafter'] = $amountbefor + $amount_benren;
						$fuddetaildata['oddtime'] = strtotime($jiesuan_end_time);
						$fuddetaildata['remark'] = '本人月亏损赠送活动';
						if($_int0){
							$fuddetaildb->data($fuddetaildata)->add();
							$_addints[] = $v['uid'];
						}
					}
					//上家账户、账变操作
					if($amount_shangjia>0 && $v['parentid']){
						$amountbefor = 0;
						$parentuser = $memberdb->where(['id'=>$v['parentid']])->field('balance,id,username')->find();
						$amountbefor = $parentuser['balance']>0?$parentuser['balance']:0;
						$_int0 = 0;
						$_int0 = $memberdb->where(['id'=>$parentuser['id']])->setInc('balance',$amount_shangjia);
						$trano = $trano?$trano:self::gettrano();
						$fuddetaildata = [];
						$fuddetaildata['trano'] = $trano;
						$fuddetaildata['uid'] = $parentuser['id'];
						$fuddetaildata['username'] = $parentuser['username'];
						$fuddetaildata['type'] = 'activity_yks';
						$fuddetaildata['typename'] = '月亏损赠送';
						$fuddetaildata['amount'] = $amount_shangjia;
						$fuddetaildata['amountbefor'] = $amountbefor;
						$fuddetaildata['amountafter'] = $amountbefor + $amount_shangjia;
						$fuddetaildata['oddtime'] = strtotime($jiesuan_end_time);
						$fuddetaildata['remark'] = "下线月亏损赠送活动({$v['username']})";
						if($_int0)$fuddetaildb->data($fuddetaildata)->add();
					}
					break;//依次符合条件则退出循环
				}
			}
		}
		//生成记录文件防止重复操作
		if(count(array_unique($_addints))>=1){
			F('jihuayuekuisuntime',time());
			$return  = '月亏损赠送活动赠送成功';
		}else{
			$return  = '月亏损赠送活动无记录或已经赠送';
		}
		return $return;
	}
	protected function getsetting($name=''){
		//$_setlist = M('setting')->cache(true,3600)->select();
		$_setlist = M('setting')->cache(300)->select();
		$setlist = [];
		foreach($_setlist as $k=>$v){
			$setlist[$v['name']] = $v['value'];
		}
		if($name){
			return $setlist[$name];
		}
		$jihuasettings = [];
		$jihuasettings = [
			'jihua_rixiaofei_shi'     => intval($setlist['jihua_rixiaofei_shi']),
			'jihua_rixiaofei_fen'     => intval($setlist['jihua_rixiaofei_fen']),
			'jihua_rikuisun_shi'      => intval($setlist['jihua_rikuisun_shi']),
			'jihua_rikuisun_fen'      => intval($setlist['jihua_rikuisun_fen']),
			'jihua_yuexiaofei_shi'    => intval($setlist['jihua_yuexiaofei_shi']),
			'jihua_yuexiaofei_fen'    => intval($setlist['jihua_yuexiaofei_fen']),
			'jihua_yuekuisun_shi'     => intval($setlist['jihua_yuekuisun_shi']),
			'jihua_yuekuisun_fen'     => intval($setlist['jihua_yuekuisun_fen']),
			'jihua_dailifandian_shi'  => intval($setlist['jihua_dailifandian_shi']),
			'jihua_dailifandian_fen'  => intval($setlist['jihua_dailifandian_fen']),
			'jihua_dbautoback_shi'    => intval($setlist['jihua_dbautoback_shi']),
			'jihua_dbautoback_fen'    => intval($setlist['jihua_dbautoback_fen'])<5?5:intval($setlist['jihua_dbautoback_fen']),
			//'jihua_dbautoback_fen'    => 2,
			
			//清理
			'jihua_kaijiang_days'    => intval($setlist['jihua_kaijiang_days'])<1?1:intval($setlist['jihua_kaijiang_days']),
			'jihua_touzhu_days'      => intval($setlist['jihua_touzhu_days'])<45?45:intval($setlist['jihua_touzhu_days']),
			'jihua_fuddetail_days'   => intval($setlist['jihua_fuddetail_days'])<45?45:intval($setlist['jihua_fuddetail_days']),
			'jihua_memlog_days'      => intval($setlist['jihua_memlog_days'])<7?7:intval($setlist['jihua_memlog_days']),
			'jihua_adminlog_days'    => intval($setlist['jihua_adminlog_days'])<7?7:intval($setlist['jihua_adminlog_days']),
		];
		return $jihuasettings;
	}
	protected function gettrano($rand=4){
		$rand = (intval($rand)>0 and intval($rand)<=6)?intval($rand):4;
		$trano = strtoupper(self::rand_string(3,0)).date('ymdHis').self::rand_string($rand,1);
		return $trano;
	}
	protected function GBK($str) {
		$str      = self::auto_charset($str,'utf-8','gbk');
		//$str      = $str."<br>";
		return $str."\n";
	}
	protected function rand_string($len=6,$type=0,$addChars='') {
		$String      = new \Org\Util\String;
		$randString  = $String->randString($len,$type,$addChars);
		return $randString;
	}
	// 自动转换字符集 支持数组转换
	protected function auto_charset($fContents, $from='gbk', $to='utf-8') {
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
				$_key = self::auto_charset($key, $from, $to);
				$fContents[$_key] = self::auto_charset($val, $from, $to);
				if ($key != $_key)
					unset($fContents[$key]);
			}
			return $fContents;
		}
		else {
			return $fContents;
		}
	}

}