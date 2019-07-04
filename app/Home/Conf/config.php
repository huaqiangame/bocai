<?php
define('STYLE_PATH','./resources'); 

return array(
    //'URL_CASE_INSENSITIVE' => true,
	'DEFAULT_FILTER'         =>  'trim,strip_tags,stripslashes',
	'VIEW_PATH'              =>  './resources/',
	//'THEME_LIST'             =>  'default,resources',
	//'DEFAULT_THEME'          =>  'resources',
	'THEME_LIST'             =>  '',
	'DEFAULT_THEME'          =>  '',
	'TMPL_DETECT_THEME'      =>  true,
	'SHOW_PAGE_TRACE'  => false,
	'TMPL_FILE_DEPR'         =>  '_',
	'TMPL_TEMPLATE_SUFFIX'   =>  '.php',
	'TMPL_PARSE_STRING'  =>array(
		'__CSS__' => __ROOT__.'/resources/css',
		'__FACE__' => __ROOT__.'/resources/images/face',
		'__IMG__' => __ROOT__.'/resources/images',
		'__JS__' => __ROOT__.'/resources/js',
		'__CSS2__' => __ROOT__.'/resources/css2',
		'__IMG2__' => __ROOT__.'/resources/images2',
		'__JS2__' => __ROOT__.'/resources/js2',
		'__UPLOADS__' => __ROOT__.'/Uploads',
        '__MZFCSS__' => __ROOT__.'/resources/mzf/css',
        '__MZFJS__' => __ROOT__.'/resources/mzf/js',
        '__MZFIMG__' => __ROOT__.'/resources/mzf/img',
	),
//	'TMPL_ACTION_ERROR' => 'resources/jump',
//默认成功跳转对应的模板文件
//	'TMPL_ACTION_SUCCESS' => 'resources/jump',
//码支付配置
    'MZFPAY'=>array(
        'mzfid'=>'149325',
        'mzfkey'=>'UZe6NJ2mqDew99RgKf4XGdnvAn077MAC',
        'mzfact'=>0,//是否启用免挂机模式 1为启用. 未开通请勿更改否则资金无法及时到账
        'go_url'=>'',//设置默认通知页面 3秒后跳转到首页
        'go_time'=>3,//3秒跳转页面 默认为首页
        'gateway'=>'http://api2.fateqq.com:52888/creat_order/?'
    )
);
