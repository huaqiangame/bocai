<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			设置提款密码 
		</font></h1>
</div>
	<div class="bank_recharge">
		<form  action="{:U('Member/update_safepass')}" method="post" class="am-form">
			<input type="hidden" name="settype" value="2">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">提款密码</span>
					<div class="am-fr bank_right_input">
						<input type="password" class="input_txt" name="password" placeholder="请输入登录密码">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">确认密码</span>
					<div class="am-fr bank_right_input">
						<input type="password" class="input_txt" name="pa1" placeholder="请再次输入密码">
					</div>
				</li>
			</ul>

			<button class="am-btn am-btn-danger am-radius am-btn-block" type="submit">确定</button>
		</form>	
		<div class="bottom_explain">
			<p>提款密码用于提现、绑定银行卡等操作，可保障资金安全。</p>
		</div>
	</div>
	<include file="Public/footer" />
</body>
</html>