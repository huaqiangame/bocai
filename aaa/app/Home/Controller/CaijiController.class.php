<?php
namespace Home\Controller;
use Think\Controller;
class CaijiController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
		set_time_limit (0);
		C('URL_MODEL',0);
	}
	function caiji(){
		$caijisets = unserialize(GetVar('caijiset'));
		$apis = array();
		$shuatime = 180;
		echo'<body onLoad="window.setInterval(shua,1000);" style="width:100%; margin:0 auto; text-align:center;color:#666; font-size:12px;">';
		foreach($caijisets as $k=>$v){
			$cpname = $k;
			$apis[] = $cpname;
				$url = U('cjframe',array('name'=>$cpname));
				echo"<div style='width:100%; height:90px;'>";
				//echo"<a href='".$url."' target='_blank'>{$cpname}</a><br>";
				echo'<iframe src="'.$url.'" frameborder=0 width="100%" height="90" scrolling="no"></iframe><br>';
				echo"</div>";
		}
		echo"<div style='clear:both;'></div>";
		echo'<center><hr><font id="hints" style="color:blue" >离下次刷新时间还有'.$shuatime.'秒</font></center><br/>';
		echo'<script>var t; t='.$shuatime.'; function shua(){t=t-1;document.getElementById("hints").innerHTML="离下次刷新时间还有 "+t+" 秒";if (t==0){document.location.reload();}}</script>';
		echo'</body>'; 
		//dump($apis);
		//dump($caijieapiurl);
	}
	function cjframe(){
		$name = I('name');
		$shuatime = 10;
		echo'<body onLoad="window.setInterval(shua,1000);" style="margin:0 auto; text-align:center;color:#666; font-size:12px;">';
		echo'<input name="button" value="刷新" onclick="window.location.reload();" type="button">'.$name.'<br>';
		echo self::cjdo($name);
		echo"<div style='clear:both;'></div>";
		echo'<font id="hints" style="color:blue" >离下次刷新时间还有'.$shuatime.'秒</font>';
		echo'<script>var t; t='.$shuatime.'; function shua(){t=t-1;document.getElementById("hints").innerHTML="离下次刷新时间还有 "+t+" 秒";if (t==0){document.location.reload();}}</script>';
		echo'</body>'; 
	}
	static function cjdo($name){
		$cpinfo = M('caipiao')->where(['name'=>$name])->cache(60)->find();
		if(!$cpinfo){
			echo'未知彩种';exit;
		}
		if($cpinfo['issys']==1){//系统彩
			echo self::xtk3($cpinfo);
		}else{
			echo self::apicaiji($cpinfo);
		}
	}
	static function apicaiji($cpinfo){
		$caijieapiurl = GetVar('caijieapiurl');
		$apiurl = $caijieapiurl."/Api.Open.kj.code.".$cpinfo['name'].".do";
		$class = "\\Lib\\apicaiji\\{$cpinfo['name']}";
		//dump($class);exit;
		$_obj  = new $class($apiurl);
		$return = $_obj->getopencode($ApiParam);
		return $return;
	}
	static function xtk3($cpinfo){
		$name = $cpinfo['name'];
		//$from = strtolower(I('from'));
		//$cpinfo   = M('caipiao')->where(['name'=>$name])->cache(180)->find();
		
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
				$data['source']      =  '系统彩';
				$data['sourcecode']  =  '';
				$oplist[$k] = $data;
		}
		$RES = [];
		$RES["data"] = list_sort_by($oplist,'expect','asc');
		foreach($RES["data"] as $k=>$v){
			$data = [];
			$data = $v;
			/*$data['title'] = $title;
			$data['name']  = $name;
			$data['opencode'] = $v['opencode'];
			$data['expect'] = $v['expect'];
			$data['opentime'] = $v['opentime'];
			$data['source'] = $source?$source:'Soft';*/
			$data['addtime'] = time();
			$data['isdraw'] = 0;
			$temp[] = $data;
			foreach($data as $k=>$v){
				if(strpos($v,'-')!==false && strpos($v,':')!==false)$data[$k] = strtotime($v);
			}
			if(!M('kaijiang')->where("name='{$data['name']}' and expect='{$data['expect']}'")->find()){
				$_int = M('kaijiang')->data($data)->add();
				if($_int)$ints[] = $data['expect'];
			}
		}
		//dump($temp);exit;
		if(count(array_filter($ints))>=1){
			return '开奖保存成功：'.implode(',',array_filter($ints));;
		}else{
			return '最后更新期号：'.$data['expect'];
		}
		//echo json_encode(['sign'=>true,'message'=>'获取成功','data'=>$oplist], JSON_UNESCAPED_UNICODE);exit;
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
	
	
	
	protected function delete3dayskj(){
		$deletetime = strtotime(date('Y-m-d',time()))-86400*3;
		$INT = M('kaijiang')->where(['addtime'=>['elt',$deletetime]])->delete();
		return $INT;
	}
}