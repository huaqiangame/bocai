<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>{:GetVar('webtitle')}</title>
	<meta name="keywords" content="{:GetVar('keywords')}" />
	<meta name="description" content="{:GetVar('description')}" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/header.css">
	<link rel="stylesheet" href="__CSS2__/mobile.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" href="__JS2__/layer/skin/default/layer.css">
	
</head>
<body>
<include file="Public/header" />
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
	<div class="moblie_main">
		<div class="container padding_0">
			<div class="qr_code clearfix" style="top: 269px;left: 15px;">
				<div class="ios pull-left">
					<img src="__IMG__/qr_code.gif" alt="安卓二维码" style="width:120px;height:120px;">
				</div>
			</div>
			<h1 class="mobile_hi">移动版</h1>
			<p class="website">m.541395.com</p>
			<div class="hand">
				<img src="__IMG__/finger.png" alt="">
			</div>
			<div id="myCarousel" class="mobile_carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="item active">
						<img src="__IMG__/1-home.png" alt="">
					</div>
					<div class="item">
						<img src="__IMG__/2-activity.png" alt="">
					</div>
					<div class="item">
						<img src="__IMG__/3-find.png" alt="">
					</div>
					<div class="item">
						<img src="__IMG__/4-myaccount.png" alt="">
					</div>
					<div class="item">
						<img src="__IMG__/5-grade.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
<include file="Public/footer" />
</body>
</html>