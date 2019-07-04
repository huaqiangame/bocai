<?php
namespace Home\Model;
use Think\Model;
class MembersessionModel extends BaseModel {
	function sessionadd($userid,$sid){
		if(!$userid || !is_numeric($userid)){
			return false;
		}
		$sessioninfo = $this->where(['userid'=>$userid])->find();
		$ip          = get_client_ip();
		$sessiontime = NOW_TIME;
		if($sessioninfo){
			$int = $this->where(['userid'=>$userid])->setField(['sessionid'=>$sid,'ip'=>$ip,'time'=>$sessiontime]);
		}else{
			$memberinfo = D('Member')->getMemberinfo($userid);
			$data = [
				'userid'    => $userid,
				'username'  => $memberinfo['username'],
				'sessionid' => $sid,
				'ip'        => $ip,
				'time'      => NOW_TIME,
			];
			$int = $this->data($data)->add();
		}
		return $int;
	}
	function getsessioninfo($userid){
		if(!$userid || !is_numeric($userid)){
			return false;
		}
		$sessioninfo = $this->where(['userid'=>$userid])->find();
		return $sessioninfo;
	}
}
