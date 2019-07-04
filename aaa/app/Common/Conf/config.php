<?php
return [
	
	'TMPL_TEMPLATE_SUFFIX'  =>  '.php',
    'URL_PATHINFO_DEPR'     =>  '/',
	'URL_HTML_SUFFIX'       =>  'do',
    'TAGLIB_BEGIN'          =>  '{',  // 标签库标签开始标记
    'TAGLIB_END'            =>  '}',  // 标签库标签结束标记
	'DEFAULT_FILTER'        =>  'htmlspecialchars,trim',
	'DB_DEBUG'  			=>  false,
	
	'MODULE_DENY_LIST' =>  ['Common','Runtime'],
	'MODULE_ALLOW_LIST' => ['Home','Mobil','Caiji','Api','Kjapi','Admincenter'],
	'APP_GROUP_LIST'   => 'Home,Mobil,Api,Kjapi,Admincenter',
    'DEFAULT_MODULE'   =>  'Home',
	'SHOW_ERROR_MSG'   => false, 
	'SHOW_PAGE_TRACE'  => false,
	'LOAD_EXT_CONFIG'  => 'db',
	'LOAD_EXT_FILE'    => 'extend',
	'TAGLIB_PRE_LOAD'  =>'Common\\TagLib\\soft',
	
	'LANG_SWITCH_ON'   => false,
	'LANG_AUTO_DETECT' => false,
	'LANG_LIST'        => 'zh-cn',
	'VAR_LANGUAGE'     => 'l',
    'URL_MODEL'        =>  2,
	
	'AUTOLOAD_NAMESPACE' => [
		'Lib'     => COMMON_PATH.'Lib',
	],
	'fuddetailtypes'    => [
			'order'=>'代购',
			'cancel'=>'撤单',
			'reward'=>'返奖',
			//	'commission'=>'返点',
			//	'fenhong'=>'代理分红',
			'fanshui'=>'每日加奖',
			'jinjishenhe'=>'晋级奖励',
			'yongjinshenhe'=>'代理返点',
			'xima'=>'洗码',
			'point'=>'积分',
			/*'pointexchange'=>'积分兑换',*/
			'activity_bindcard'  => '绑定银行赠送活动',
			'activity_cz'  => '充值活动',
			'activity_czzs'  => '充值赠送活动',
			'activity_rxf' => '日消费赠送活动',
			'activity_rks' => '日亏损赠送活动',
			'activity_yxf' => '月消费赠送活动',
			'activity_yks' => '月亏损赠送活动',

			/*'transferPlatform'=>'平台转帐',*/
			'rollback'=>'后台撤单',
			/*'editcommission'=>'修正手续费',
            'editrecharge'=>'修正充值',
            'editwithdraw'=>'修正提款',
            'editactivity'=>'修正活动',*/
			/*		'downrecharge'=>'下级充值',
                    'uprecharge'=>'上级充值',*/
			'withdraw'=>'提款',
			'adminadd'=>'管理员加',
			'adminjian'=>'管理员减',
	],





	'COOKIE_EXPIRE'    => '600',
    'AUTH_KEY'    => 'w%!)+bj$&sGX(Lp4Y@v;l#Q:i7c{MWOT-|AP"}gB',
    'ALL_RBAC_U'       => 'administrator',
];