<?php
namespace Home\Model;
use Think\Model;
class MemberModel extends BaseModel {
	function loginout($userid){
		if(!$userid || !is_numeric($userid)){
			return false;
		}
		$int = D('Memberlog')->addlog($userid,'logout');
		return $int;
	}
	function getMemberinfo($userid){
		if(!$userid || !is_numeric($userid)){
			return false;
		}
		/*$uinfo = $this -> alias('a')
		-> join(C('DB_PREFIX')."membergroup as b on a.groupid = b.groupid")
		-> field('a.*,b.groupname')
		-> find();*/
		M('member')->where(['id'=>$userid])->setField(['onlinetime'=>time()]);
		M('membersession')->where(['userid'=>$userid])->setField(['time'=>time()]);
		$uinfo = M('member')->where(['id'=>$userid])->find();
		/*$loginfo = M('memberlog')->where(['userid'=>$uinfo['id']])->getField('ip,iparea,time')->order('id desc')->find();*/
		/*$uinfo['ip'] = $linfo['ip'];
		$uinfo['iparea'] = $linfo['iparea'];*/
		/*$uinfo['lasttime'] = date('Y-m-d H:i:s',$linfo['logintime']);*/
		return $uinfo;
	}
}
