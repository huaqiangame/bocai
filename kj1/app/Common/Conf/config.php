<?php
return [
	
	'TMPL_TEMPLATE_SUFFIX'  =>  '.php',
    'URL_PATHINFO_DEPR'     =>  '.',
	'URL_HTML_SUFFIX'       =>  'do',
    'TAGLIB_BEGIN'          =>  '{',  // 标签库标签开始标记
    'TAGLIB_END'            =>  '}',  // 标签库标签结束标记
	'DEFAULT_FILTER'        =>  'htmlspecialchars,trim',
	'DB_DEBUG'  			=>  false,
	
	'MODULE_DENY_LIST' =>  ['Common','Runtime'],
	'MODULE_ALLOW_LIST' => ['Caiji','Kaijiang','Jihua'],
	'APP_GROUP_LIST'   => 'Caiji,Kaijiang,Jihua',
    'DEFAULT_MODULE'   => 'Jihua',
	'SHOW_ERROR_MSG'   => false, 
	'SHOW_PAGE_TRACE'  => false, 
	'LOAD_EXT_CONFIG'  => 'db',
	'LOAD_EXT_FILE'    => 'extend',
	
	'LANG_SWITCH_ON'   => false,
	'LANG_AUTO_DETECT' => false,
	'LANG_LIST'        => 'zh-cn',
	'VAR_LANGUAGE'     => 'l',
    'URL_MODEL'        =>  2,
	
	'AUTOLOAD_NAMESPACE' => [
		'Lib'     => COMMON_PATH.'Lib',
	],
	'APP_URL'=>'HTTP://127.0.0.5/',
];