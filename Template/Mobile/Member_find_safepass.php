<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			找回提款密码
		</font></h1>
</div>
	
	<ul class="my_set_list">
		<li>
			<a href="{:U('Member/find_safepass_phone')}" class="am-cf">
				<span>通过密保手机</span>
				<i class="iconfont icon-arrowright"></i>
			</a>
		</li>
		<li>
			<a href="{:U('Member/find_safepass_email')}" class="am-cf">
				<span>通过密保邮箱</span>
				<i class="iconfont icon-arrowright"></i>
			</a>
		</li>
		<!--<li>
			<a href="{:U('Member/find_safepass_qq')}" class="am-cf">
				<span>通过QQ号码</span>
				<i class="iconfont icon-arrowright"></i>
			</a>
		</li>-->
		<li>
			<a href="{:GetVar('mobile_kefuthree')}" class="am-cf">
				<span>通过在线客服</span>
				<i class="iconfont icon-arrowright"></i>
			</a>
		</li>
	</ul>
</body>
</html>