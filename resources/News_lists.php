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
		<div class="help_left pull-left">
			<ul>
				<li class="title"><h2>Help</h2></li> 

				<volist name="arclists" id="arc">
					<li <if condition="$arc['id'] eq $showid">cur</if>><a href="javascript:void(0)">{$arc.title}</a></li>
                </volist>
			</ul>
		</div>
		<div class="help_right pull-right"> 
			<volist name="arclists" id="arc">
			<div class="help_tab_content">
				<h2>{$arc.title}</h2>
				<div class="help_right_content">
					{$arc.content}
				</div>
			</div>
			</volist>
		</div>
	</div>
</div>
<include file="Public/footer" />
</body>
</html>