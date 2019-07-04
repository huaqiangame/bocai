<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			设置提款密码
		</font></h1>
</div>
	<div class="bank_recharge">
		<form action="{:U('member/update_safepass')}" class="update_form" method="post">
			<input type="hidden" name="settype" value="1">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">输入提款密码</span>
					<div class="am-fr bank_right_input">
						<input type="password"  class="input_txt" name="password"style="padding-top:6px">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">确认提款密码</span>
					<div class="am-fr bank_right_input">
						<input type="password"  class="input_txt" name="repassword"style="padding-top:6px">
					</div>
				</li>
			</ul>
			<button type="submit"class="am-btn am-btn-danger am-radius am-btn-block" >提交</button>
		</form>	
	</div>
	<include file="Public/footer" />
</body>
</html>