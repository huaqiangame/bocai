<?php
namespace Caiji\Controller;
use Think\Controller;
class XitongController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
	}
	function kenossc(){
		$name = strtolower(I('name'));
		$from = strtolower(I('from'));
		$cpinfo   = M('caipiao')->where(['name'=>$name])->find();
		$frominfo   = M('caipiao')->where(['name'=>$from])->find();
		if(!$cpinfo || !$frominfo){
			echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
		}
		$kenolist = M('kaijiang')->where(['name'=>$from])->field('opencode,opentime,expect')->order('opentime desc')->limit(5)->select();
		$kenolist = list_sort_by($kenolist,'expect','asc');

		foreach($kenolist as $k0=>$kenoinfo){
				$_codes = $opencodes = [];
				$_codes = array_chunk(explode(',',$kenoinfo['opencode']), 4);
				foreach($_codes as $k=>$v){
					$opencodes[] = array_sum($v)%10;
				}
				$data = array();
				$data['title']       =  $cpinfo['title'];
				$data['name']        =  $cpinfo['name'];
				$data['expect']      =  $kenoinfo['expect'];
				$data['opencode']    =  implode(',',$opencodes);
				$data['opentime']    =  $kenoinfo['opentime'];
				$data['source']      =  $frominfo['title'];
				$data['sourcecode']     =  $kenoinfo['opencode'];
				$oplist[$k0] = $data;
		}
		echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
	}
	function keno3d(){//06,15,22,27,30,34,  35,36,39,42,48,50,  51,52,53,54,60,69,  74,78
		$name = strtolower(I('name'));
		$from = strtolower(I('from'));
		$cpinfo   = M('caipiao')->where(['name'=>$name])->find();
		$frominfo   = M('caipiao')->where(['name'=>$from])->find();
		if(!$cpinfo || !$frominfo){
			echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
		}
		$kenolist = M('kaijiang')->where(['name'=>$from])->field('opencode,opentime,expect')->order('opentime desc')->limit(5)->select();
		$kenolist = list_sort_by($kenolist,'expect','asc');

		foreach($kenolist as $k0=>$kenoinfo){
				$_codes = $opencodes = [];
				$_codes = array_chunk(explode(',',$kenoinfo['opencode']), 6);
				$_code0 = array_sum($_codes[0])%10;
				$_code1 = array_sum($_codes[1])%10;
				$_code2 = array_sum($_codes[2])%10;

				$data = array();
				$data['title']       =  $cpinfo['title'];
				$data['name']        =  $cpinfo['name'];
				$data['expect']      =  $kenoinfo['expect'];
				$data['opencode']    =  $_code0.','.$_code1.','.$_code2;
				$data['opentime']    =  $kenoinfo['opentime'];
				$data['source']      =  $frominfo['title'];
				$data['sourcecode']  =  implode(',', $_codes[0]).','.implode(',', $_codes[1]).','.implode(',', $_codes[2]);
				$oplist[$k0] = $data;
		}
		echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
	}
	function keno28(){//06,15,22,27,30,34,  35,36,39,42,48,50,  51,52,53,54,60,69,  74,78
		$name = strtolower(I('name'));
		$from = strtolower(I('from'));
		$cpinfo   = M('caipiao')->where(['name'=>$name])->find();
		$frominfo   = M('caipiao')->where(['name'=>$from])->find();
		if(!$cpinfo || !$frominfo){
			echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
		}
		$kenolist = M('kaijiang')->where(['name'=>$from])->field('opencode,opentime,expect')->order('opentime desc')->limit(5)->select();
		$kenolist = list_sort_by($kenolist,'expect','asc');

		foreach($kenolist as $k0=>$kenoinfo){
				$_codes = $opencodes = [];
				$_codes = array_chunk(explode(',',$kenoinfo['opencode']), 6);
				$_code0 = array_sum($_codes[0])%10;
				$_code1 = array_sum($_codes[1])%10;
				$_code2 = array_sum($_codes[2])%10;

				$data = array();
				$data['title']       =  $cpinfo['title'];
				$data['name']        =  $cpinfo['name'];
				$data['expect']      =  $kenoinfo['expect'];
				$data['opencode']    =  $_code0+$_code1+$_code2;
				$data['opentime']    =  $kenoinfo['opentime'];
				$data['source']      =  $frominfo['title'];
				$data['sourcecode']  =  $_code0.','.$_code1.','.$_code2;
				$data['remarks']     =  $kenoinfo['opencode'];
				$oplist[$k0] = $data;
		}
		echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
	}

    function xtssc(){
		$name = strtolower(I('name'));
		$from = strtolower(I('from'));
		$cpinfo   = M('caipiao')->where(['name'=>$name])->cache(180)->find();
		if(!$cpinfo){
			echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
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
			$actNo_t = (time()-strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t))+$cjnowtime)/$_expecttime;
		}
		$actNo_t = floor($actNo_t);
		$actNo =  is_numeric($actNo_t)?($actNo_t==$totalcount?1:$actNo_t):floor( $actNo_t );
		//$actNo =  floor( (time()-strtotime($cpinfo['closetime1']))/($cpinfo['expecttime']*60) );
		if($actNo<=20){
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
			for($jj=$actNo-19;$jj<=$actNo;$jj++){
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
		$setkjinfo = M('setting')->where(['name'=>$cpinfo['name']])->find();
		$setkjinfo['config'] = unserialize($setkjinfo['value']);
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
				$rand_keys           =  explode(',',self::rand_keys('5'));
				sort($rand_keys);
				$data['opencode']    =  implode(',',$rand_keys);
			}
			if($setkjinfo && $setkjinfo['config']['expect']==$v['expect']){
				$data['opencode']    =  $setkjinfo['config']['opencode'];
			}
			$ykjinfo = $ydb->where(['name'=>$cpinfo['name'],'expect'=>$v['expect']])->find();
			if($ykjinfo && $ykjinfo['opencode']){
				$data['opencode']    =  $ykjinfo['opencode'];
			}
			$data['opentime']    =  $v['opentime'];
			$data['source']      =  '系统彩';
			$data['sourcecode']  =  '';
			$oplist[$k] = $data;
		}
		echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
	}
	function xtk3(){
		$name = strtolower(I('name'));
		$from = strtolower(I('from'));
		$cpinfo   = M('caipiao')->where(['name'=>$name])->cache(180)->find();
		if(!$cpinfo){
			echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
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
			$actNo_t = (time()-strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t))+$cjnowtime)/$_expecttime;
		}
		$actNo_t = floor($actNo_t);
		$actNo =  is_numeric($actNo_t)?($actNo_t==$totalcount?1:$actNo_t):floor( $actNo_t );
		//$actNo =  floor( (time()-strtotime($cpinfo['closetime1']))/($cpinfo['expecttime']*60) );
		if($actNo<=20){
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
			for($jj=$actNo-19;$jj<=$actNo;$jj++){
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
		$setkjinfo = M('setting')->where(['name'=>$cpinfo['name']])->find();
		$setkjinfo['config'] = unserialize($setkjinfo['value']);
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
				if($setkjinfo && $setkjinfo['config']['expect']==$v['expect']){
					$data['opencode']    =  $setkjinfo['config']['opencode'];
				}
				$ykjinfo = $ydb->where(['name'=>$cpinfo['name'],'expect'=>$v['expect']])->find();
				if($ykjinfo && $ykjinfo['opencode']){
					$data['opencode']    =  $ykjinfo['opencode'];
				}
				$data['opentime']    =  $v['opentime'];
				$data['source']      =  '系统彩';
				$data['sourcecode']  =  '';
				$oplist[$k] = $data;
		}
		echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
	}
	function xt3d(){
		$name = strtolower(I('name'));
		$from = strtolower(I('from'));
		$cpinfo   = M('caipiao')->where(['name'=>$name])->cache(180)->find();
		if(!$cpinfo){
			echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
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
			$actNo_t = (time()-strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t))+$cjnowtime)/$_expecttime;
		}
		$actNo_t = floor($actNo_t);
		$actNo =  is_numeric($actNo_t)?($actNo_t==$totalcount?1:$actNo_t):floor( $actNo_t );
		//$actNo =  floor( (time()-strtotime($cpinfo['closetime1']))/($cpinfo['expecttime']*60) );
		if($actNo<=20){
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
			for($jj=$actNo-19;$jj<=$actNo;$jj++){
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
		$setkjinfo = M('setting')->where(['name'=>$cpinfo['name']])->find();
		$setkjinfo['config'] = unserialize($setkjinfo['value']);
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
				$rand_keys           =  explode(',',self::rand_keys('3','0123456789'));
				sort($rand_keys);
				$data['opencode']    =  implode(',',$rand_keys);
			}
			if($setkjinfo && $setkjinfo['config']['expect']==$v['expect']){
				$data['opencode']    =  $setkjinfo['config']['opencode'];
			}
			$ykjinfo = $ydb->where(['name'=>$cpinfo['name'],'expect'=>$v['expect']])->find();
			if($ykjinfo && $ykjinfo['opencode']){
				$data['opencode']    =  $ykjinfo['opencode'];
			}
			$data['opentime']    =  $v['opentime'];
			$data['source']      =  '系统彩';
			$data['sourcecode']  =  '';
			$oplist[$k] = $data;
		}
		echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
	}
	function xt11x5(){
		$name = strtolower(I('name'));
		$from = strtolower(I('from'));
		$cpinfo   = M('caipiao')->where(['name'=>$name])->cache(180)->find();
		if(!$cpinfo){
			echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
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
			$actNo_t = (time()-strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t))+$cjnowtime)/$_expecttime;
		}
		$actNo_t = floor($actNo_t);
		$actNo =  is_numeric($actNo_t)?($actNo_t==$totalcount?1:$actNo_t):floor( $actNo_t );
		//$actNo =  floor( (time()-strtotime($cpinfo['closetime1']))/($cpinfo['expecttime']*60) );
		if($actNo<=20){
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
			for($jj=$actNo-19;$jj<=$actNo;$jj++){
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
		$setkjinfo = M('setting')->where(['name'=>$cpinfo['name']])->find();
		$setkjinfo['config'] = unserialize($setkjinfo['value']);
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
				$rand_keys           =  explode(',',self::rand_keys_x('5','01,02,03,04,05,06,07,08,09,10,11'));
				sort($rand_keys);
				$data['opencode']    =  implode(',',$rand_keys);
			}
			if($setkjinfo && $setkjinfo['config']['expect']==$v['expect']){
				$data['opencode']    =  $setkjinfo['config']['opencode'];
			}
			$ykjinfo = $ydb->where(['name'=>$cpinfo['name'],'expect'=>$v['expect']])->find();
			if($ykjinfo && $ykjinfo['opencode']){
				$data['opencode']    =  $ykjinfo['opencode'];
			}
			$data['opentime']    =  $v['opentime'];
			$data['source']      =  '系统彩';
			$data['sourcecode']  =  '';
			$oplist[$k] = $data;
		}
		echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
	}
	function xtpk10(){
	$name = strtolower(I('name'));
	$from = strtolower(I('from'));
	$cpinfo   = M('caipiao')->where(['name'=>$name])->cache(180)->find();
	if(!$cpinfo){
		echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
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
		$actNo_t = (time()-strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t))+$cjnowtime)/$_expecttime;
	}
	$actNo_t = floor($actNo_t);
	$actNo =  is_numeric($actNo_t)?($actNo_t==$totalcount?1:$actNo_t):floor( $actNo_t );
	//$actNo =  floor( (time()-strtotime($cpinfo['closetime1']))/($cpinfo['expecttime']*60) );
	if($actNo<=20){
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
		for($jj=$actNo-19;$jj<=$actNo;$jj++){
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
	$setkjinfo = M('setting')->where(['name'=>$cpinfo['name']])->find();
	$setkjinfo['config'] = unserialize($setkjinfo['value']);
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
			$rand_keys           =  explode(',',self::rand_keys_x(10,'01,02,03,04,05,06,07,08,09,10'));
//				sort($rand_keys);
			$data['opencode']    =  implode(',',$rand_keys);
		}
		if($setkjinfo && $setkjinfo['config']['expect']==$v['expect']){
			$data['opencode']    =  $setkjinfo['config']['opencode'];
		}
		$ykjinfo = $ydb->where(['name'=>$cpinfo['name'],'expect'=>$v['expect']])->find();
		if($ykjinfo && $ykjinfo['opencode']){
			$data['opencode']    =  $ykjinfo['opencode'];
		}
		$data['opentime']    =  $v['opentime'];
		$data['source']      =  '系统彩';
		$data['sourcecode']  =  '';
		$oplist[$k] = $data;
	}
	echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
}

















function dflhc(){
	$name = strtolower(I('name'));
	$from = strtolower(I('from'));
	$cpinfo   = M('caipiao')->where(['name'=>$name])->cache(180)->find();
	if(!$cpinfo){
		echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
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
		$actNo_t = (time()-strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t))+$cjnowtime)/$_expecttime;
	}
	$actNo_t = floor($actNo_t);
	$actNo =  is_numeric($actNo_t)?($actNo_t==$totalcount?1:$actNo_t):floor( $actNo_t );
	//$actNo =  floor( (time()-strtotime($cpinfo['closetime1']))/($cpinfo['expecttime']*60) );
	if($actNo<=20){
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
		for($jj=$actNo-19;$jj<=$actNo;$jj++){
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
	$setkjinfo = M('setting')->where(['name'=>$cpinfo['name']])->find();
	$setkjinfo['config'] = unserialize($setkjinfo['value']);
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
			$rand_keys           =  explode(',',self::rand_keys_x(7,'01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49'));
//				sort($rand_keys);
			$data['opencode']    =  implode(',',$rand_keys);
		}
		if($setkjinfo && $setkjinfo['config']['expect']==$v['expect']){
			$data['opencode']    =  $setkjinfo['config']['opencode'];
		}
		$ykjinfo = $ydb->where(['name'=>$cpinfo['name'],'expect'=>$v['expect']])->find();
		if($ykjinfo && $ykjinfo['opencode']){
			$data['opencode']    =  $ykjinfo['opencode'];
		}
		$data['opentime']    =  $v['opentime'];
		$data['source']      =  '系统彩';
		$data['sourcecode']  =  '';
		$oplist[$k] = $data;
	}
	echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
}











	function xtkeno(){
		$name = strtolower(I('name'));
		$from = strtolower(I('from'));
		$cpinfo   = M('caipiao')->where(['name'=>$name])->cache(180)->find();
		if(!$cpinfo){
			echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
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
			$actNo_t = (time()-strtotime(date('Y-m-d '.$cpinfo['closetime1'],$_t))+$cjnowtime)/$_expecttime;
		}
		$actNo_t = floor($actNo_t);
		$actNo =  is_numeric($actNo_t)?($actNo_t==$totalcount?1:$actNo_t):floor( $actNo_t );
		//$actNo =  floor( (time()-strtotime($cpinfo['closetime1']))/($cpinfo['expecttime']*60) );
		if($actNo<=20){
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
			for($jj=$actNo-19;$jj<=$actNo;$jj++){
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
		$setkjinfo = M('setting')->where(['name'=>$cpinfo['name']])->find();
		$setkjinfo['config'] = unserialize($setkjinfo['value']);
		$oplist = [];
		$Runm = "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80";
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
				$rand_keys           =  explode(',',self::rand_keys_x(20,$Runm));
//				sort($rand_keys);
				$data['opencode']    =  implode(',',$rand_keys);
			}
			if($setkjinfo && $setkjinfo['config']['expect']==$v['expect']){
				$data['opencode']    =  $setkjinfo['config']['opencode'];
			}
			$ykjinfo = $ydb->where(['name'=>$cpinfo['name'],'expect'=>$v['expect']])->find();
			if($ykjinfo && $ykjinfo['opencode']){
				$data['opencode']    =  $ykjinfo['opencode'];
			}
			$data['opentime']    =  $v['opentime'];
			$data['source']      =  '系统彩';
			$data['sourcecode']  =  '';
			$oplist[$k] = $data;
		}
		echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
	}
	function xtkl10f(){
		$name = strtolower(I('name'));
		$from = strtolower(I('from'));
		$cpinfo   = M('caipiao')->where(['name'=>$name])->find();
		if(!$cpinfo){
			echo json_encode(['sign'=>false,'message'=>'彩种不存在'], JSON_UNESCAPED_UNICODE);exit;
		}
		$_expecttime = $cpinfo['expecttime']*60;
		$actNo =  floor( (time()-strtotime(date('Y-m-d 00:00:00',time())))/$_expecttime );
		$totalopentimes = 86400-0;
		$totalcount     = floor($totalopentimes/$_expecttime);
		$_length        = $totalcount>=1000?4:3;
		$actNo =  floor( (time()-strtotime($cpinfo['closetime1']))/($cpinfo['expecttime']*60) );
		if($actNo<=20){
			for($jj=1;$jj<=$actNo;$jj++){
				$_openlist[$jj] = [
					'expect'    => date('Ymd') . str_pad($jj,$_length,0,STR_PAD_LEFT),
					'opentime'  => date('Y-m-d H:i:s', strtotime($cpinfo['closetime1']) + $jj*($cpinfo['expecttime']*60) ),
				];
			}
		}else{
			for($jj=$actNo-19;$jj<=$actNo;$jj++){
				$_openlist[$jj] = [
					'expect'    => date('Ymd') . str_pad($jj,$_length,0,STR_PAD_LEFT),
					'opentime'  => date('Y-m-d H:i:s', strtotime($cpinfo['closetime1']) + $jj*($cpinfo['expecttime']*60) ),
				];
			}
		}
		$oplist = [];
		foreach($_openlist as $k=>$v){
			$data = array();
				$data['title']       =  $cpinfo['title'];
				$data['name']        =  $cpinfo['name'];
				$data['expect']      =  $v['expect'];
				$data['opencode']    =  self::rand_keys_x('8','01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20');
				$data['opentime']    =  $v['opentime'];
				$data['source']      =  '系统彩';
				$data['sourcecode']  =  '';
				$oplist[$k] = $data;
		}
		echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
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
	protected function rand_keys_y($len = 10,$str='01,02,03,04,05,06,07,08,09,10') {
		$arr = explode(',',$str);
		shuffle($arr);
		$str='';
		for($i=0;$i<count($arr);$i++){
			$str .= $arr[$i].',';
		}
		return substr($str,0,-1);
	}
	protected function rand_keys($len = 5,$str='0123456789') {
		$rand = '';
		for ($x=0;$x<$len;$x++) {
			$rand .= ($rand != '' ? ',' : '').substr($str, rand(0, strlen($str) - 1), 1);
		}
		return $rand;
	}
}