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
			设置登录密码
		</h1>
	</header>
	
	<div class="bank_recharge">
		<form action="{:U('Member/update_pass')}" class="update_form" method="post">
			<input type="hidden" name="settype" value="2">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">登录密码</span>
					<div class="am-fr bank_right_input">
						<input type="password" name="pa1" class="input_txt" placeholder="请输入登录密码">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">确认密码</span>
					<div class="am-fr bank_right_input">
						<input type="password" class="input_txt" name="password" placeholder="请再次输入密码">
					</div>
				</li>
			</ul>
			<button class="am-btn am-btn-danger am-radius am-btn-block" type="submit">确定</button>
		</form>	
	</div>
	<include file="Public/footer" />
</body>
</html>