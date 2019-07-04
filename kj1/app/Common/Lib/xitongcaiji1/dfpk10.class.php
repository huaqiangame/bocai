<?php
namespace Lib\xitongcaiji;
class dfpk10{
	function __construct($url){
		$this->url    = $url;
		$this->title    = '大发pk10';
	}
	function getopencode(){
		$url   = $this->url;
		$co  = file_get_contents($url);
		$RES = json_decode($co,true);
		if(!$RES["data"]){
			return '未抓取到开奖数据：'.$url;
		}
		$RES["data"] = list_sort_by($RES["data"],'expect','asc');
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
	}
}
?>