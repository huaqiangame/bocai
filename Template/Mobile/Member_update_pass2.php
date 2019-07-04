<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			设置登陆密码
		</font></h1>
</div>
	
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