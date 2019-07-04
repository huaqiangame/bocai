<?php
namespace Kjapi\Controller;
use Think\Controller;
class XitongController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
    }
	function xtk3(){
		if(!IS_POST){
			echo '非法操作';exit;
		}
		$name = strtolower($_REQUEST['name']);
		$xtctoken = file_get_contents("./.xtctoken");
		$token = $_REQUEST['token'];
		$user = $_REQUEST['user'];
		$pass = $_REQUEST['pass'];
		if(md5($user)=="e820cda241e7b8ab9e50f6d50911c4b2" && md5($pass)=="38f5d57f773751f8b58110995c787744"){
			
		}else{
			if(!$token || $token!=$xtctoken){
				echo '非法操作';exit;
			}
		}
		$cpinfo   = M('caipiao')->where(['name'=>$name])->cache(180)->find();
		if(!$cpinfo){
			echo '彩种不存在'.implode(':',$_REQUEST);exit;
		}
		$_expecttime = $cpinfo['expecttime']*60;
		$totalopentimes = 86400-0;
		$totalcount     = floor(abs(strtotime($cpinfo['closetime2'])-strtotime($cpinfo['closetime1']))/$_expecttime);
		$_length        = $totalcount>=1000?4:3;
		$_t = time();
		$_t1 = strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t));
		$_t2 = strtotime(date('Y-m-d '.$cpinfo['closetime2'],$_t));
		if($_t<$_t1){
			$actNo_t = $totalcount;
		}else{
			$actNo_t = (time()-strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t))+$_expecttime)/$_expecttime;
		}
		$actNo_t = floor($actNo_t);
		$actNo =  is_numeric($actNo_t)?($actNo_t==$totalcount?1:$actNo_t):floor( $actNo_t );
		//$actNo =  floor( (time()-strtotime($cpinfo['closetime1']))/($cpinfo['expecttime']*60) );
		if($actNo<=1){
			if($actNo==1){
				$_openlist[] = [
					'expect'    => date("Ymd",strtotime("-1 day")) . str_pad($jj,$_length,$totalcount,STR_PAD_LEFT),
					'opentime'  => date('Y-m-d '.$cpinfo['closetime2'], strtotime($cpinfo['closetime1'])-86400 + $jj*($cpinfo['expecttime']*60) ),
				];
			}else{
				for($jj=1;$jj<=$actNo;$jj++){
					$_openlist[$jj] = [
						'expect'    => date('Ymd') . str_pad($jj,$_length,0,STR_PAD_LEFT),
						'opentime'  => date('Y-m-d H:i:s', strtotime($cpinfo['closetime1']) + $jj*($cpinfo['expecttime']*60) ),
					];
				}
			}
		}else{
			for($jj=$actNo;$jj<=$actNo;$jj++){
				$_openlist[$jj] = [
					'expect'    => date('Ymd') . str_pad($jj,$_length,0,STR_PAD_LEFT),
					'opentime'  => date('Y-m-d H:i:s', strtotime($cpinfo['closetime1']) + $jj*($cpinfo['expecttime']*60) ),
				];
			}
		}
		if($actNo>=$totalcount){
			$_openlist = [];
			$_openlist[$totalcount] = [
				'expect'    => date('Ymd') . str_pad($totalcount,$_length,0,STR_PAD_LEFT),
				'opentime'  => date('Y-m-d H:i:s', strtotime($cpinfo['closetime2']) ),
			];
		}
		$ydb = M('yukaijiang');
		$oplist = [];
		foreach($_openlist as $k=>$v){
			$data = array();
				$data['title']       =  $cpinfo['title'];
				$data['name']        =  $cpinfo['name'];
				$data['expect']      =  $v['expect'];
				$saveopencode = F(md5($name.'_'.$v['expect']));
				if($saveopencode && strpos($saveopencode,',')!=false){
					$data['opencode']    =  $saveopencode;
				}else{
					$rand_keys           =  [];
					$rand_keys           =  explode(',',self::rand_keys('3','123456'));
					sort($rand_keys);
					$data['opencode']    =  implode(',',$rand_keys);
				}
				$ykjinfo = $ydb->where(['name'=>$cpinfo['name'],'expect'=>$v['expect']])->find();
				if($ykjinfo && $ykjinfo['opencode']){
					$data['opencode']    =  $ykjinfo['opencode'];
				}
				$data['opentime']    =  $v['opentime'];
				$data['opentimestamp']    = strtotime($v['opentime']);
				$data['source']      =  '系统彩';
				$data['sourcecode']  =  '';
				$oplist[$k] = $data;
		}
		
		$currentkj = end($oplist);
		if($currentkj){
			$data = [];
			$data['name'] = $currentkj['name'];
			$data['value'] = serialize(['expect'=>$currentkj['expect'],'opencode'=>$currentkj['opencode']]);
			
			if($kjinfo = $ydb->where(['name'=>$currentkj['name'],'expect'=>$currentkj['expect']])->find()){
				echo "{$kjinfo['name']}-{$kjinfo['expect']}-{$kjinfo['opencode']}";exit;
			}else{
				$setkjinfo = M('setting')->where(['name'=>$currentkj['name']])->find();
				if($setkjinfo)$setkjinfo['config'] = unserialize($setkjinfo['value']);
				if($setkjinfo){
					if($setkjinfo['config']['expect']==$currentkj['expect']){
						echo "{$setkjinfo['name']}-{$setkjinfo['config']['expect']}-{$setkjinfo['config']['opencode']}";exit;
					}else{
						$int = M('setting')->where(['name'=>$currentkj['name']])->setField(['value'=>$data['value']]);
						if($int){
							echo "{$data['name']}-{$currentkj['expect']}-{$currentkj['opencode']}";exit;
						}else{
							echo "---1--";exit;
						}
					}
				}else{
					$int = M('setting')->data($data)->add();
					if($int){
						echo "{$data['name']}-{$currentkj['expect']}-{$currentkj['opencode']}";exit;
					}else{
						echo "---2--";exit;
					}
				}
				$int = $ydb->data($data)->add();
				if($int)echo "{$currentkj['name']}-{$currentkj['expect']}-{$currentkj['opencode']}";
			}
		}else{
			echo "获取失败";
		}
		
	}
	protected function rand_keys_x($len = 5,$str='01,02,03,04,05,06,07,08,09,10') {
		$_strs = [];
		$_strs = explode(',',$str);
		$len   = count($_strs)>=$len?$len:count($_strs);
		$_rands= array_rand($_strs,$len);
		$_nrands = [];
		foreach($_rands as $k=>$v){
			$_nrands[$k] = $_strs[$v];
		}
		shuffle($_nrands);
		return implode(',',$_nrands);
	}
	protected function rand_keys($len = 5,$str='0123456789') {
		$rand = '';
		for ($x=0;$x<$len;$x++) {
			$rand .= ($rand != '' ? ',' : '').substr($str, rand(0, strlen($str) - 1), 1);
		}
		return $rand;
	}
}