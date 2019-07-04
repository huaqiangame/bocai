<?php
namespace Home\Model;
use Think\Model;
class MemberloginerrorModel extends BaseModel {
	/*增加登录失败次数记录*/
	function addloginerror($username){
		$loginerrornum = GetVar('loginerrornum_q');
		$loginerrorclosetime = GetVar('loginerrorclosetime_q');
		if(!$loginerrorclosetime || !$loginerrornum)return false;
		if($info = $this->where(['username'=>$username])->find()){
			if($info['errornum']<$loginerrornum){
				$int = $this->where(['id'=>$info['id']])->data(['errornum'=>$info['errornum']+1,'time'=>NOW_TIME])->save();
			$return = "<br>您已经输错".($info['errornum']+1)."次密码"
						. "<br>错误" .$loginerrornum. "次将被冻结账户" . $loginerrorclosetime.'小时';
			}else{
				$int = $this->where(['id'=>$info['id']])->data(['time'=>NOW_TIME,'locktime'=>NOW_TIME])->save();
				$return = '您的账号密码错误达到'.$loginerrornum.'次，已限制登录，请与'.date('Y-m-d H:i',$info['locktime']+$loginerrorclosetime*3600).'解除限制后再登录';
			}
		}else{
			$data = [];
			$data['username'] = $username;
			$data['ip']       = get_client_ip();
			$data['time']     = NOW_TIME;
			$data['locktime'] = NOW_TIME;
			$data['errornum'] = 1;
			$int = $this->data($data)->add();
			$return = "<br>您已经输错1次密码"
						. "<br>错误" .$loginerrornum. "次将被冻结账户" . $loginerrorclosetime.'小时';
		}
		return $return;
	}
	function loginlockreset($userid){
		if(!$userid || !is_numeric($userid)){
			return false;
		}
		$int = $this->where(['userid'=>$userid])->setField(['errornum'=>0,'locktime'=>0]);
		return $int;
	}
	function isloginlock($username){
		$info = $this->where(['username'=>$username])->find();
		if(!$info)return false;
		$loginerrornum       = GetVar('loginerrornum_q');
		$loginerrorclosetime = GetVar('loginerrorclosetime_q');
		if(!$loginerrorclosetime || !$loginerrornum)return false;
		if($info['errornum']>=$loginerrornum){
			if($loginerrorclosetime && NOW_TIME-$info['locktime']<$loginerrorclosetime*3600){
				$return = '您的账号密码错误达到'.$loginerrornum.'次，已限制登录，请与'.date('Y-m-d H:i',$info['locktime']+$loginerrorclosetime*3600).'解除限制后再登录';
				return $return;
			}else{
				$this->where(['id'=>$info['id']])->setField('errornum',0);
				return false;
			}
		}else{
			//$return = "<br>您已经输错".($info['errornum']+1)."次密码"
						//. "<br>错误" .$loginerrornum. "次将被冻结账户" . $loginerrorclosetime.'小时';
			return false;
		}
	}
}
