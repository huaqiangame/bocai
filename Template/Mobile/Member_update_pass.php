<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			验证原密码
		</font></h1>
</div>
	
	<div class="bank_recharge">
		<form action="{:U('Member/update_pass')}" class="update_form" method="post">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">原密码</span>
					<div class="am-fr bank_right_input">
						<input type="password"  class="input_txt" name="password">
						<input type="hidden" name="settype" value="1">
					</div>
				</li>
			</ul>
			<button type="submit"class="am-btn am-btn-danger am-radius am-btn-block" >提交</button>
		</form>	
	</div>
	<include file="Public/footer" />
</body>
</html>