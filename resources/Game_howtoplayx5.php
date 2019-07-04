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
				<p>{$caipiao['title']}：由中国福利彩票发行管理中心组织销售、{$caipiao['title']|mb_substr=###,0,6}<eq name="caipiao['title']" value="上海11选5">市<else />省</eq>福利彩票发行中心承销；</p>
				<p>开奖时间：每天早上{$caipiao['firsttime']}分至晚上{$caipiao['endtime']}； 全天{$caipiao['qishu']}期、每{$caipiao['ftitle']}；</p>
				<p>开奖号码：从01-11共11个号码中任选1-8个号码进行投注，每期开出5个号码为中奖号码，竞猜5位开奖号码的全部或部分号码。投注方式灵活，开奖频次高，全面满足不同彩民的投注需要；</p>
			</div>
		</div>
		<div class="play">
			<div class="play_title">
				<img src="__IMG__/howtoplay_howtoplay.png" alt="玩法">
			</div>
			<div class="play_content">
				<img src="__IMG__/howtoplay_x5.png" alt="">
			</div>
		</div>
	</div>
</div>
</body>
</html>