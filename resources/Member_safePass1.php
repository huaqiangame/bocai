<include file="Public/headermember" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/updatePass.css">
	<link rel="stylesheet" href="__CSS2__/securityCenter.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
	<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
			<include file="Member/side" />
	<div class="update_pass" style="margin-left:160px; margin-top:1px;">
	<div class="container-fluid" style="background: #e8e8e8;">
		<ul class="queue">
			<li class="now">
				<span>验证原始资金密码</span>
				<i class="iconfont"></i>
			</li>
			<li>
				<span>修改密码资金密码</span>
				<i class=" iconfont "></i>
			</li>
			<li class="">
				<span>完成</span>
				<i class="iconfont"></i>
			</li>
		</ul>
		<form action="{:U('Member/update_safepass')}" class="update_form" method="post">
			<input type="hidden" name="settype" value="1">
			<p>
				<span>原始密码：</span>
				<input type="password" name="oldpassword">
			</p>
			<button type="submit" class="btn common_btn" >提交</button>
		</form>
	</div>
	</div>
	</div>

<include file="Public/footer" />
</body>
</html>