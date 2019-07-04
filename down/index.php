<?php
$type = trim(htmlspecialchars($_REQUEST['type']));
$filename = trim(htmlspecialchars($_REQUEST['filename']));
if(in_array($type,['apk','ipa'])){
	if($type=='apk'){
		$filename = $filename?$filename:'k3app';
		file_down('k3app.apk',$filename.'.apk');
	}elseif($type=='ipa'){
		$filename = $filename?$filename:'k3app';
		file_down('k3app.ipa',$filename.'.ipa');
	}
}
function file_down($filepath, $filename = '') {
	if(!$filename) $filename = basename($filepath);
	if(is_ie()) $filename = rawurlencode($filename);
	$filetype = fileext($filename);
	$filesize = sprintf("%u", filesize($filepath));
	if(ob_get_length() !== false) @ob_end_clean();
	header('Pragma: public');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: pre-check=0, post-check=0, max-age=0');
	header('Content-Transfer-Encoding: binary');
	header('Content-Encoding: none');
	header('Content-type: '.$filetype);
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header('Content-length: '.$filesize);
	readfile($filepath);
	exit;
}
function fileext($filename) {
	return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
}
function is_ie() {
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if((strpos($useragent, 'opera') !== false) || (strpos($useragent, 'konqueror') !== false)) return false;
	if(strpos($useragent, 'msie ') !== false) return true;
	return false;
}

?>
<html><head>
<meta charset="utf-8">
<title>快三APP下载</title>
<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<link rel="stylesheet" href="mobile.css">
<script type="text/javascript" src="/resources/js/jquery-1.9.1.min.js"></script>
</head>
<body class="page-down">
    <div class="cont-wrap">
        <div class="row">

        <a href="?type=apk" class="app android"><i></i><span>安卓下载</span></a>
        <a href="?type=ipa" class="app ios"><i></i><span>苹果下载</span></a>

        </div>
        <div class="row alink"><a href="/" class="quest">返回首页</a><br><br>
        <a href="javascript:;" class="quest" id="quest">下载遇到了问题？</a></div>

    </div>

    <div id="tips" class="wrap">
        <ul>
            <li>请查看您的设备是否启用了移动网络或WiFi连接</li>
            <li>如下载中断导致安装失败，请删除旧的APP后重新扫码下载</li>
            <li>iPhone系统版本低于8.0或进行过越狱操作，可能导致安装失败</li>
            <li>如始终无法正常下载安装，请联系客服并提供您的手机型号和系统版本，我们将第一时间为您解决问题</li>
        </ul>
        <div class="i-know" id="hideTips">我知道了</div>
    </div>

    

<script>
$(function(){
    var $tips = $('#tips');
    $('#quest').data('action','showTips');
    $('#hideTips').data('action','hideTips');
    $('#quest,#hideTips').on('click', function(){
        var action = $(this).data('action');
        if( action && action === 'showTips' && !$tips.hasClass('active') ){
            $tips.addClass('active');
        }else if( action && action === 'hideTips' && $tips.hasClass('active') ){
            $tips.removeClass('active');
        }
        return false;
    });

    window.onload = function(){
        if(isWechat()){
            $('#webChatHelps').show();
        }
    }

    function isWechat(){
        var ua = window.navigator.userAgent.toLowerCase();
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            return true;
        }else{
            return false;
        }
    }
});
</script>

</body></html>