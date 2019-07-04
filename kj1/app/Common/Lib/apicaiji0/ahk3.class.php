<?php
namespace Lib\apicaiji0;
class ahk3{
	function __construct(){
		$config = array(
			  "id" => "147",
			  "apiname" => "caipiaokongpc",
			  "apiurl" => "https://www.caipiaokong.com/lottery/ahks.html",
			  "title" => "安徽快3",
			  "name" => "ahk3",
			  "class" => "./app/Common/Lib/api/caipiaokongpc/caipiaokong.class.php",
			  "expectpat" =>"(\d{6,12})",
			  "expectlen" =>"2",
			  "expectolen" =>"3",
			  "expectrule" =>"1",
			  "ballpat" =>"",
			  "balllength" =>"5",
			  "ballduinum" =>"3",
			  "opentimepat" =>"",
			  "status" => "1",
			  "listorder" => "147",
		);
		$this->config = $config;
	}
	function GetLotteryRes($istest=0){
		$name  = $this->config['name'];
		$title = $this->config['title'];
		$class = $this->config['class'];
		$expectpat = $this->config['expectpat'];
		$expectlen = $this->config['expectlen'];
		$expectolen = $this->config['expectolen'];
		$expectrule = $this->config['expectrule'];
		$ballpat = $this->config['ballpat'];
		$balllength = $this->config['balllength'];
		$ballduinum = $this->config['ballduinum'];
		$opentimepat = $this->config['opentimepat'];
		$apiurl = $this->config['apiurl'];
		$apiname = $this->config['apiname'];
		if($istest){dump($this->config);};
		$co  = Curl1($apiurl);
		if($istest){dump($co);};
		if(!$co)return '远程数据抓取错误！';
		preg_match_all('#<td><span(.*)</span></td></tr>#iUS',$co,$_TRS);
		//dump($_TRS);exit;
		foreach($_TRS[1] as $k=>$v){
			$_TR = '';
			$_TR = str_replace('</strong>',',',preg_replace(['/<span(.[^>]*)>/i','/<strong(.[^>]*)>/i','/<div(.[^>]*)>/i'],['','',''],$v));
			$_TRS[1][$k] = $_TR;
			preg_match('#title=["|\'](.[^>]*\d{2}:\d{2}:\d{2})["|\']>#i',$v,$_times);
			preg_match('#第'.$expectpat.'期(.[^<]*)#i',strip_tags($_TR),$_alls);
			if($expectrule==1){
				$qihao = $_alls[1];
				if($expectlen && $expectolen){
					$qihao = self::getqihao($_alls[1],$expectlen,$expectolen);
				}
				if($qihao){
					$datas[$k]['opentime'] = $_times[1];
					$datas[$k]['balls'] = substr($_alls[2],0,$balllength);
					$datas[$k]['qihao'] = $qihao;
				}
			}else{
				$datas[$k]['opentime'] = $_times[1];
				$datas[$k]['balls'] = substr($_alls[2],0,$balllength);
				$datas[$k]['qihao'] = $_alls[1];
			}
		}
		if($istest){dump($datas);exit;};
		$datas = list_sort_by($datas,'qihao','asc');
		$datas = array_slice($datas,-20);
		foreach($datas as $k=>$v){
			$data = array();
			$data['title'] = $title;
			$data['name']  = $name;
			$data['opencode'] = $v['balls'];
			$data['expect'] = $v['qihao'];
			$data['opentime'] = $v['opentime'];
			$data['source'] = $source?$source:'Soft';
			$data['addtime'] = time();
			$data['isdraw'] = 0;


			$temps[$k] = $data;
			foreach($data as $k1=>$v1){
				if(strpos($v1,'-')!==false && strpos($v1,':')!==false)$data[$k1] = strtotime($v1);
			}
			if(count(explode(',',$data['opencode']))==$ballduinum && $ballduinum>0)if(!$kjinfo = M('kaijiang')->where("name='{$name}' and expect='{$data['expect']}'")->find()){
				$ints[] = $_int = M('kaijiang')->data($data)->add();
				if($_int)$updatalist[] = $data['expect'].':'.$data['opencode'];
			}


		}
		//dump($temps);exit;
		if(is_array($ints) && count(array_filter($ints))>=1){
			return '采集成功-'.implode(';',$updatalist);
		}else{
			return '最后更新-'.$kjinfo['expect'].':'.$kjinfo['opencode'];
		}
	}
	function getqihao($qihao,$len=3,$olen=3){
		if(!$qihao)return false;
		$qihao = str_replace('-','',$qihao);
		if(!is_numeric($qihao))return false;
		$ext = substr($qihao,-$len);
		$Y = date('Y');
		$DAYS = array();
		if(strlen($qihao)==6 || strlen($qihao)==7){
			$DAYS = str_split(substr($qihao,0,4),2);
			$qihao = $Y.$DAYS[0].$DAYS[1].str_pad($ext,$olen,"0",STR_PAD_LEFT);
		}elseif(strlen($qihao)==8 || strlen($qihao)==9){
			$DAYS = str_split(substr($qihao,0,6),2);
			$qihao = $Y.$DAYS[1].$DAYS[2].str_pad($ext,$olen,"0",STR_PAD_LEFT);
		}elseif(strlen($qihao)==10 || strlen($qihao)==11){
			$qihao = date('Ymd',strtotime(substr($qihao,0,8))).str_pad($ext,$olen,"0",STR_PAD_LEFT);
		}else{
			$qihao = false;
		}
		return $qihao;
	}
}
?>