<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/html5.js"></script>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/respond.min.js"></script>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/static/h-ui.admin/skin/green/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="../Template/admin/resources/ui/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台管理</title>
</head>
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">{:GetVar('webtitle')}管理系统</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml"></a> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav class="nav navbar-nav navbar-menu">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 快捷菜单 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="{:U('Tongji/gaikuang')}" data-title="统计概况">统计概况</a></li>
							<li><a href="{:U('Tongji/yingkui')}" data-title="盈亏统计">盈亏统计</a></li>
							<li><a href="{:U('Member/recharge')}" data-title="充值管理">充值管理</a></li>
							<li><a href="{:U('Member/withdraw')}" data-title="提现记录">提款管理</a></li>
							<li><a href="{:U('Member/manage')}" data-title="会员列表">会员列表</a></li>
							<li><a href="{:U('Member/banklist')}" data-title="会员银行卡">会员银行卡</a></li>
							<li><a href="{:U('Member/fuddetail')}" data-title="账变记录">账变记录</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li>{$admininfo['groupname']}</li>
					<li class="dropDown dropDown_hover"> <a href="javascript:void(0);" class="dropDown_A">{$admininfo['username']} <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:void(0);" onclick="article_add('修改密码','{:U('Adminmember/editpass',['type'=>'pass'])}')">修改密码</a></li>
							<li><a href="javascript:void(0);" onclick="article_add('修改安全码','{:U('Adminmember/editpass',['type'=>'safecode'])}')">修改安全码</a></li>
							<li><a href="{:U('Public/loginout')}">退出</a></li>
						</ul>
					</li>
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="default" title="黑色">黑色</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色(默认)</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	<div class="menu_dropdown bk_2">
    {include file="Index/group1" /}
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="统计概况" data-href="{:U('Tongji/Tongjiweb')}">我的桌面</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="{:U('Tongji/gaikuang')}"></iframe>
		</div>
	</div> 
</section>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="../Template/admin/resources/ui/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="../Template/admin/resources/ui/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="../Template/admin/resources/ui/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
function article_add(title,url){
	layer_show(title,url);
}
loadAudioSource();
function loadAudioSource(num) {
	var audioHtml = '';
	audioHtml += '<audio controls id="audiotikuan" style="display:none;"><source src="../Template/admin/resources/audio/tikuan.mp3" type="audio/mpeg"></audio>';
	audioHtml += '<audio controls id="audiochongzhi" style="display:none;"><source src="../Template/admin/resources/audio/chongzhi.mp3" type="audio/mpeg"></audio>';
	audioHtml += '<audio controls id="audiobankbind" style="display:none;"><source src="../Template/admin/resources/audio/bankbind.mp3" type="audio/mpeg"></audio>';
	$("body").append(audioHtml);

}

// 播放提示声音
function audioPlay(name) {
	var audio = document.getElementById("audio" + name);
	if(!audio) {
		setTimeout(function(){
			audioPlay(name);
		}, 50);
		return false;
	}
	audio.play('tikuan');
}
function checkspeck(){
	$.getJSON("{:U('Index/checkspeck')}", function(data){
	   if(data.sign){
		   if(data.tkcount>0){
			   audioPlay('tikuan');
		   }else if(data.czcount>0){
			   audioPlay('chongzhi');
		   }else if(data.bankbindcount>0){
			   audioPlay('bankbind');
		   }
	   }
	});
}
window.setInterval("checkspeck();",10000);
</script> 
</body>
</html>