<?php
define('STYLE_PATH','/Template/default/');
return array(
	'DEFAULT_FILTER'         =>  'trim,strip_tags,stripslashes',
	'TAGLIB_PRE_LOAD'        =>  'Common\\TagLib\\soft',
	'VIEW_PATH'              =>  './Template/',
	'THEME_LIST'             =>  'default,phone',
	'DEFAULT_THEME'          =>  'default',
	'TMPL_DETECT_THEME'      =>  true,
	'TMPL_FILE_DEPR'         =>  '_',
	'TMPL_TEMPLATE_SUFFIX'   =>  '.php',
);