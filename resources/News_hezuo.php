<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{:GetVar('webtitle')}</title>
	<meta name="keywords" content="{:GetVar('keywords')}" />
	<meta name="description" content="{:GetVar('description')}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/header.css">
	<link rel="stylesheet" href="__CSS2__/help.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" href="__JS2__/layer/skin/default/layer.css">
	

</head>
<body>
<include file="Public/header" />
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="help_main clearfix">
	<div class="container padding_0">
			<volist name="arclists" id="arc">
			<div class="center-block">
				<div class="center-block" style="width: 100%;background: #fff;padding: 10px;border-radius: 5px;font-size: 14px;line-height: 44px;">
					{$arc.content}
				</div>
			</div>
			</volist>
		</div>
</div>
<include file="Public/footer" />
</body>
</html>