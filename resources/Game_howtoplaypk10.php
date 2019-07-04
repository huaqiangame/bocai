<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>{:GetVar('webtitle')}</title>
	<meta name="keywords" content="{:GetVar('keywords')}" />
	<meta name="description" content="{:GetVar('description')}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" ><meta name="keywords" content="关键字">

	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/howtoplay.css">
</head>
<body>
<div class="container padding_0">
	<div class="header">
		<i class="iconfont pull-right">&#xe657;</i>
		<p class="pull-right margin_0">{$caipiao['title']}</p>
	</div>
	<div class="main">
		<div class="how">
			<div class="img"><img src="__IMG__/howtoplay_brief.png" alt="简介"></div>
			<div class="how_content">
				<p>{$caipiao['title']}：简称“PK拾”，由中国福利彩票发行管理中心统一发行， 由北京市福利彩票发行中心承销。</p>
				<p>开奖时间：每天{$caipiao['qishu']}期、每{$caipiao['ftitle']}；每天早上{$caipiao['firsttime']}分至晚上{$caipiao['endtime']}；</p>
				<p>开奖结果为10个号码；</p>
			</div>
		</div>
		<div class="play">
			<div class="play_title">
				<img src="__IMG__/howtoplay_howtoplay.png" alt="玩法">
			</div>
			<div class="play_content">
				<img src="__IMG__/howtoplay_pk10.png" alt="">
			</div>
		</div>
	</div>
</div>
</body>
</html>