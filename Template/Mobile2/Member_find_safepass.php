<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>
		<h1 class="am-header-title userHome_h1">
			找回资金密码
		</h1>
	</header>
	
	<ul class="my_set_list security_list">
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
		<li>
			<a href="{:U('Member/find_safepass_qq')}" class="am-cf">
				<span>通过QQ号码</span>
				<i class="iconfont icon-arrowright"></i>
			</a>
		</li>
		<li>
			<a href="{:GetVar('kefuthree')}" class="am-cf">
				<span>通过在线客服</span>
				<i class="iconfont icon-arrowright"></i>
			</a>
		</li>
	</ul>
	<include file="Public/footer" />
</body>
</html>