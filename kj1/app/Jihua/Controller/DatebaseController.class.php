<?php
namespace Jihua\Controller;
use Think\Controller;
class DatebaseController extends Controller {
    public function _initialize(){
		header("Content-type: text/html; charset=utf-8");
		/*if(!IS_POST){
			echo json_encode(['sign'=>false,'message'=>'非法操作'],JSON_UNESCAPED_UNICODE);exit;
		}
		$userid = I('userid');
		$token  = I('token');
		$aaa    = I('a');
		if(!$userid || !$token){
			echo json_encode(['sign'=>false,'message'=>'操作账号不完整','userid'=>$userid,'token'=>$token],JSON_UNESCAPED_UNICODE);exit;
		}
		$admininfo = M('adminsession')->where(['uid'=>$userid,'sessionid'=>$token])->find();
		if(!$admininfo){
			$ip          = get_client_ip();
			$log['ip']   = $ip;
			$iparea      = IParea($ip);
			$log['iparea']   = $iparea;
			$log['time']   = time();
			F('database_'.$ip,$log);
			echo json_encode(['sign'=>false,'message'=>'操作账号错误，已记录您的IP地址'],JSON_UNESCAPED_UNICODE);exit;
		}*/
	}
	function nizationdo(){
		$time = floatval('time');
		//$dir = DATA_PATH.'db/';
		$dir = './JIHUADATA/db/';
		$isok = false;$files = [];
		if ( $handle = opendir($dir) ) {
			while ( ($file = readdir($handle)) !== false ) 
			{
				if ( $file != ".." && $file != "." ) 
				{
					if ( is_dir($dir . "/" . $file) ) {}
					
					else{
						$_file = $dir . "/" . $file;
						if($filectime<=$_deletetime){
							
						}
						$files[] = $_file;
					}
				}
			}
			closedir($handle);
		}
		echo json_encode(['sign'=>true,'message'=>'获取成功','files'=>$files],JSON_UNESCAPED_UNICODE);exit;
	}
	function datebaseup(){
		//列出备份文件列表
		$path = realpath('./JIHUADATA/db/');
		$flag = \FilesystemIterator::KEY_AS_FILENAME;
		$glob = new \FilesystemIterator($path,  $flag);

		$list = array();
		foreach ($glob as $name => $file) {
			if(preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)){
				$name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');

				$date = "{$name[0]}-{$name[1]}-{$name[2]}";
				$time = "{$name[3]}:{$name[4]}:{$name[5]}";
				$part = $name[6];

				if(isset($list["{$date} {$time}"])){
					$info = $list["{$date} {$time}"];
					$info['part'] = max($info['part'], $part);
					$info['size'] = $info['size'] + $file->getSize();
				} else {
					$info['part'] = $part;
					$info['size'] = $file->getSize();
				}
				$extension        = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
				$info['compress'] = ($extension === 'SQL') ? '-' : $extension;
				$info['time']     = strtotime("{$date} {$time}");

				$list["{$date} {$time}"] = $info;
			}
		}
		$list = list_sort_by($list,'time','desc');
		echo json_encode(['sign'=>true,'message'=>'获取成功','list'=>$list],JSON_UNESCAPED_UNICODE);exit;
	}

}