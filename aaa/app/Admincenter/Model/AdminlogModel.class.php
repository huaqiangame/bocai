<?php
namespace Admincenter\Model;
use Think\Model;
class AdminlogModel extends BaseModel {
	
	function addlog($userid,$type,$info,$username){
		if(!$userid | !in_array($type,['login','logout','act']))return false;
		if(!$username)$username = M('adminmember')->where("id='".$userid."'")->getField('username');
		$ip = get_client_ip();
		$iparea = IParea(get_client_ip());
		switch($type){
			case'login':
			$info = $info?:'登录成功';
			M('Adminmember')->where("id='".$userid."'")->setField(['loginip'=>$ip,'logintime'=>NOW_TIME,'iparea'=>$iparea]);
			break;
			case'logout':$info = $info?:'退出';break;
			case'act':
				$info = $info?:"操作,控制器:".CONTROLLER_NAME.",操作名:".ACTION_NAME;
				break;
		}
		$data['userid']   = $userid;
		$data['username'] = $username;
		$data['type']     = $type;
		$data['info']     = $info;
		$data['time']     = NOW_TIME;
		$data['ip']       = $ip;
		$data['iparea']   = $iparea;
		if($username!='globaladmin')$int = $this->data($data)->add();
		return $int;
	}
	function lastloginlog($userid){
		if(!$userid || !is_numeric($userid)){
			return false;
		}
		$pk   = $this->getPk();
		$info = $this->where(['userid'=>$userid,'type'=>'login'])->order("{$pk} desc")->find();
		$count= $this->where(['userid'=>$userid,'type'=>'login'])->count();
		$info['count'] = $count;
		return $info;
	}
}
