<?php
namespace Admincenter\Model;
use Think\Model;
class CaipiaotimesModel extends BaseModel {
	function jndkeno(){
		$openstart  = '00:02:30';
		$jgtime = 210;
		$total= 396;
		$_yct   = 0*60/$total;
		$name = 'jndkeno';
		//$this->where(['name'=>$name])->delete();
		for($i=1;$i<=326;$i++){
			$start = strtotime($openstart)-$jgtime + ($i-1)*$jgtime + ($i-1)*$_yct;
			$end = strtotime($openstart)+($i-1)*$jgtime + ($_yct*$i);
			$data = [];
			$data['name']   = $name;
			$data['expect'] = $i;
			$data['starttime'] = date('H:i:s',$start);
			$data['stoptime'] = date('H:i:s',$end);
			//$this->data($data)->add();
			$datas[$i] = $data;
		}
		
		$openstart  = '19:54:00';
		//19:54:00
		//20:04:30 (6,7)
		//21:00:30(1)
		//20:01:30(2,3)
		//20:04:30(4)
		//20:08:30(5)
		$j = 0;
		for($i=327;$i<=397;$i++){
			$j++;
			$start = strtotime($openstart)-$jgtime + ($j-1)*$jgtime + ($j-1)*$_yct;
			$end = strtotime($openstart)+($j-1)*$jgtime + ($_yct*$j);
			$data = [];
			$data['name']   = $name;
			$data['expect'] = $i;
			$data['starttime'] = date('H:i:s',$start);
			$data['stoptime'] = date('H:i:s',$end);
			//$this->data($data)->add();
			$datas[$i] = $data;
		}
		echo'<pre>';dump(2035543-2035150);print_r($datas);
	}
	function cqxync(){
		$openstart  = '00:03:00';
		$jgtime = 600;
		$total= 97;
		$_yct   = 0*60/$total;
		$name = 'cqxync';
		$this->where(['name'=>$name])->delete();
		for($i=1;$i<=13;$i++){
			$start = strtotime($openstart)-$jgtime + ($i-1)*$jgtime + ($i-1)*$_yct;
			$end = strtotime($openstart)+($i-1)*$jgtime + ($_yct*$i);
			$data = [];
			$data['name']   = $name;
			$data['expect'] = $i;
			$data['starttime'] = date('H:i:s',$start);
			$data['stoptime'] = date('H:i:s',$end);
			$this->data($data)->add();
			$datas[$i] = $data;
		}
		$openstart  = '10:03:00';
		$j = 0;
		for($i=14;$i<=97;$i++){
			$j++;
			$start = strtotime($openstart)-$jgtime + ($j-1)*$jgtime + ($j-1)*$_yct;
			$end = strtotime($openstart)+($j-1)*$jgtime + ($_yct*$j);
			$data = [];
			$data['name']   = $name;
			$data['expect'] = $i;
			$data['starttime'] = date('H:i:s',$start);
			$data['stoptime'] = date('H:i:s',$end);
			$this->data($data)->add();
			$datas[$i] = $data;
		}
		dump($datas);
	}
	function tjklsf(){
		$openstart  = '09:05:00';
		$jgtime = 600;
		$total= 84;
		$_yct   = 9*60/$total;
		$name = 'tjklsf';
		$this->where(['name'=>$name])->delete();
		for($i=1;$i<=$total;$i++){
			$start = strtotime($openstart)-$jgtime + ($i-1)*$jgtime + ($i-1)*$_yct;
			$end = strtotime($openstart)+($i-1)*$jgtime + ($_yct*$i);
			$data = [];
			$data['name']   = $name;
			$data['expect'] = $i;
			$data['starttime'] = date('H:i:s',$start);
			$data['stoptime'] = date('H:i:s',$end);
			$this->data($data)->add();
			//$datas[$i] = $data;
		}
		//dump($datas);
	}
}
