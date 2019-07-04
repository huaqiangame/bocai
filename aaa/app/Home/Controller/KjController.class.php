<?php
namespace Home\Controller;
use Think\Controller;
class KjController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
		set_time_limit (0);
		C('URL_MODEL',0);
	}
	function checkkj(){
		$shuatime = 10;
		echo'<script>var t; t='.$shuatime.'; function shua(){t=t-1;document.getElementById("hints").innerHTML="离下次刷新时间还有 "+t+" 秒";if (t==0){document.location.reload();}}</script>';
		echo'<body onLoad="window.setInterval(shua,1000);" style="margin:0 auto; text-align:center;color:#666; font-size:12px;">';
		echo'<input name="button" value="刷新" onclick="window.location.reload();" type="button">开奖检测<br>';
		echo self::checkkjdo();
		echo"<div style='clear:both;'></div>";
		echo'<font id="hints" style="color:blue" >离下次刷新时间还有'.$shuatime.'秒</font>';
		echo'</body>'; 
	}
	function checkkjdo(){
		

		$kaijiangdb = M('kaijiang');
		$touzhudb   = M('touzhu');
		$memberdb   = M('member');
		$fuddetaildb= M('fuddetail');
		$kaijiang = null;
		$kaijiang = $kaijiangdb->where(['isdraw'=>0])->order('id desc')->find();
		//$kaijiang = $kaijiangdb->where(['name'=>'f1k3','expect'=>'201611270293'])->order('id desc')->find();
		
		$return = '';
		if(!$kaijiang){
			$return = "没有开奖信息";
		}else{
			$typeid= null;
			$typeid = M('caipiao')->where(['name'=>$kaijiang['name']])->cache(300)->getField('typeid');
			$tzlist = null;
			$tzlist   = $touzhudb->where(['isdraw'=>0,'typeid'=>$typeid,'cpname'=>$kaijiang['name'],'expect'=>$kaijiang['expect']])->select();
			//dump($tzlist);exit;
			if(!$tzlist){
				//dump(11);
				$int = $kaijiangdb->where(['isdraw'=>0,'id'=>$kaijiang['id']])->setField(['isdraw'=>1]);
				$return = $kaijiang['title'].'-期号:'.$kaijiang['expect'].'无下注信息';
			}else{
				$tzlist_o   = [];
				foreach($tzlist as $k=>$v){
					$v['opencode'] = $kaijiang['opencode'];
					$tzlist_o[$k] = $v;
				}
				$result = $tzlist_o;
				if(is_file(COMMON_PATH."/Lib/kaijiang/{$typeid}.class.php")){
					$_class = "\\Lib\\kaijiang\\{$typeid}";
					$_obj  = new $_class($tzlist_o);
					$result = $_obj->check();
					unset($_obj);
				}
				//dump($result);exit;
				//中奖会员、中奖金额
				$_zjusers = [];
				foreach($result as $k=>$res){
					if(!isset($res['zjcount']))continue;
					$_isdraw = $touzhudb->where(['id'=>$res['id']])->getField('isdraw');
					if($_isdraw!=0){
						continue;
					}
					if($res['zjcount']==0){
						$touzhudb->where(['id'=>$res['id']])->setField(['isdraw'=>-1,'opencode'=>$kaijiang['opencode']]);
					}elseif($res['zjcount']>=1){
						//计算中奖金额
						$_typeid0 = $res['typeid'];
						$balance = self::$_typeid0($res);
						//$balance = $res['okamount'] * $res['beishu'] * $res['zjcount'];
						$_aint = $touzhudb->where(['id'=>$res['id'],'isdraw'=>0])->setField(['isdraw'=>1,'opencode'=>$kaijiang['opencode'],'okamount'=>$balance,'okcount'=>$res['zjcount']]);
						if($_aint){
							$amountbefor = $memberdb->where(['id'=>$res['uid']])->getField('balance');
							$memberdb->where(['id'=>$res['uid']])->setInc('balance',$balance);
							$_zjusers[$res['uid']] = $res['username'] . '-金额:' . $balance;
							
							//写入账变 开始
							$fdata = [];
							$fdata['trano'] = self::gettrano();
							$fdata['uid'] = $res['uid'];
							$fdata['username'] = $res['username'];
							$fdata['type'] = 'reward';
							$fdata['typename'] = '返奖';
							$fdata['amount'] = $balance;
							$fdata['amountbefor'] = $amountbefor;
							$fdata['amountafter'] = $amountbefor + $balance;
							$fdata['oddtime'] = time();
							$fdata['remark'] = $res['cptitle'] .'第'. $res['expect'] . '期-' . $res['playtitle'];
							M('fuddetail')->data($fdata)->add();
							//写入账变 结束
							
							//如果有返点
							if($res['repointamout']>0){
								$amountbefor = $memberdb->where(['id'=>$res['uid']])->getField('balance');
								$memberdb->where(['id'=>$res['uid']])->setInc('balance',$res['repointamout']);
								//返点写入账变 开始
								$fdata = [];
								$fdata['trano'] = self::gettrano();
								$fdata['uid'] = $res['uid'];
								$fdata['username'] = $res['username'];
								$fdata['type'] = 'commission';
								$fdata['typename'] = '返点';
								$fdata['amount'] = $res['repointamout'];
								$fdata['amountbefor'] = $amountbefor;
								$fdata['amountafter'] = $amountbefor + $res['repointamout'];
								$fdata['oddtime'] = time();
								$fdata['remark']  = $res['cptitle'] .'第'. $res['expect'] . '期-' . $res['playtitle'];
								M('fuddetail')->data($fdata)->add();
								//返点写入账变 结束
							}
						}
						
					}
				}

				$int = $kaijiangdb->where(['isdraw'=>0,'id'=>$kaijiang['id']])->setField(['isdraw'=>1]);
				$return = $kaijiang['title'].'-期号:'.$kaijiang['expect']."开奖成功！\n中奖会员概况：".implode(";;",$_zjusers);
			
			}
			
		}
		//dump($return);
		
		if(time()<=strtotime("16:50") && time()>=strtotime("16:45")){
			self::delete2daykj();
		}
		echo $return;
		
		
		//dump($result);
		
		//$_obj  = new $_class($tzlist_o);
		/*
		** 链接远程开奖
		*/
		//dump(get_client_ip());
		
		//vendor('Hprose.HproseHttpClient');
		//$client = new \HproseHttpClient('http://127.0.0.54/Kaijiang.Server.check');
		//$client->useService();
		//$client = new \Yar_client('http://127.0.0.54/Kaijiang.Server.check');
		//$result = $client->check($tzlist_o);
		//dump($result);
	}

	protected function ssc($res){
		$okamount = 0;
		/*$rules = M('wanfa')->where(['typeid'=>$res['typeid'],'playid'=>$res['playid']])->find();
		if($rules){
			$defaultfandian = 0.13;
			$userinfo = [];
			$userinfo = M('member')->where(['id'=>$res['uid']])->find();
			$fandian = $userinfo['fandian'];
			if($rules['rate']>0){
				$amount = $res['mode']*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}else{
				$amount = (($rules['maxjj']/2) - ($defaultfandian-($fandian/100-$res['repoint']/100)) * $rules['totalzs'])*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}
		}else{
			
		}*/
		$okamount = ($res['amount']/$res['itemcount'])*$res['mode']*$res['zjcount'];
		return $okamount;
	}
	protected function k3($res){
		$okamount = 0;
		/*$rules = M('wanfa')->where(['typeid'=>$res['typeid'],'playid'=>$res['playid']])->find();
		if($rules){
			$defaultfandian = 0.13;
			$userinfo = [];
			$userinfo = M('member')->where(['id'=>$res['uid']])->find();
			$fandian = $userinfo['fandian'];
			if($rules['rate']>0){
				$amount = $res['mode']*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}else{
				$amount = (($rules['maxjj']/2) - ($defaultfandian-($fandian/100-$res['repoint']/100)) * $rules['totalzs'])*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}
		}else{
			
		}*/
		$okamount = ($res['amount']/$res['itemcount'])*$res['mode']*$res['zjcount'];
		return $okamount;
	}
	protected function x5($res){
		$okamount = 0;
		$rules = M('wanfa')->where(['typeid'=>$res['typeid'],'playid'=>$res['playid']])->find();
		if($rules){
			$defaultfandian = 0.13;
			$userinfo = [];
			$userinfo = M('member')->where(['id'=>$res['uid']])->find();
			$fandian = $userinfo['fandian'];
			if($rules['rate']>0){
				$amount = $res['mode']*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}else{
				$amount = (($rules['maxjj']/2) - ($defaultfandian-($fandian/100-$res['repoint']/100)) * $rules['totalzs'])*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}
		}else{
			
		}
		return $okamount;
	}
	protected function kl10f($res){
		$okamount = 0;
		$rules = M('wanfa')->where(['typeid'=>$res['typeid'],'playid'=>$res['playid']])->find();
		if($rules){
			$defaultfandian = 0.13;
			$userinfo = [];
			$userinfo = M('member')->where(['id'=>$res['uid']])->find();
			$fandian = $userinfo['fandian'];
			if($rules['rate']>0){
				$amount = $res['mode']*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}else{
				$amount = (($rules['maxjj']/2) - ($defaultfandian-($fandian/100-$res['repoint']/100)) * $rules['totalzs'])*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}
		}else{
			
		}
		return $okamount;
	}
	protected function pk10($res){
		$okamount = 0;
		$rules = M('wanfa')->where(['typeid'=>$res['typeid'],'playid'=>$res['playid']])->find();
		if($rules){
			$defaultfandian = 0.13;
			$userinfo = [];
			$userinfo = M('member')->where(['id'=>$res['uid']])->find();
			$fandian = $userinfo['fandian'];
			if($rules['rate']>0){
				$amount = $res['mode']*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}else{
				$amount = (($rules['maxjj']/2) - ($defaultfandian-($fandian/100-$res['repoint']/100)) * $rules['totalzs'])*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}
		}else{
			
		}
		return $okamount;
	}
	protected function dpc($res){
		$okamount = 0;
		$rules = M('wanfa')->where(['typeid'=>$res['typeid'],'playid'=>$res['playid']])->find();
		if($rules){
			$defaultfandian = 0.13;
			$userinfo = [];
			$userinfo = M('member')->where(['id'=>$res['uid']])->find();
			$fandian = $userinfo['fandian'];
			if($rules['rate']>0){
				$amount = $res['mode']*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}else{
				$amount = (($rules['maxjj']/2) - ($defaultfandian-($fandian/100-$res['repoint']/100)) * $rules['totalzs'])*$res['yjf']*$res['beishu'];
				$okamount = $amount*$res['zjcount'];
			}
		}else{
			
		}
		return $okamount;
	}
	protected function keno($res){
		
	}
	protected function xy28($res){
		
	}
//删除两天前的开奖
protected function delete2daykj(){
	$day = date('Y-m-d',time());
	$odaytime = strtotime($day)-86400*2;
	$map = [];
	$map['opentime'] = ['elt',$odaytime];
	M('kaijiang')->where($map)->delete();
}
protected function gettrano($rand=4){
	$rand = (intval($rand)>0 and intval($rand)<=6)?intval($rand):4;
	$trano = strtoupper(self::rand_string(3,0)).date('ymdHis').self::rand_string($rand,1);
	return $trano;
}
protected function rand_string($len=6,$type=0,$addChars='') {
	$String      = new \Org\Util\String;
	$randString  = $String->randString($len,$type,$addChars);
    return $randString;
}
}