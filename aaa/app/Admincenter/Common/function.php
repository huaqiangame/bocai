<?PHP
function islogin(){
	$admin_sessionid = session('admin_sessionid');
	$admin_auth_id   = session('admin_auth_id');
	if(!$admin_sessionid || !$admin_auth_id){
		return 0;
	}
	if(session('backup_list')){//如果是还原数据库则暂时不验证
		
	}else{
		$sessioninfo = M('Adminsession')->where(['userid'=>$admin_auth_id])->find();
		if(!$sessioninfo){
			return 0;
		}else{
			if($admin_sessionid!=$sessioninfo['sessionid']){
				return -1;//别的地方登录
			}
			if(C('sessiontime') && NOW_TIME-$sessioninfo['time']>C('sessiontime')){
				return -2;//登录超时
			}
		}
	}
	$userinfo = M('Adminmember')->where(['id'=>$admin_auth_id])->find();
	$userinfo['groupname'] = M('admingroup')->where(['groupid'=>$userinfo['groupid']])->getField('groupname');
	return $userinfo;
}
/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function format_bytes($size, $delimiter = '') {
	$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
	for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
	return round($size, 2) . $delimiter . $units[$i];
}
