<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			绑定真实姓名
		</font></h1>
</div>
	<div class="bank_recharge">
		<form action="" class="update_form" method="post">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">姓名：</span>
					<div class="am-fr bank_right_input">
						<input type="password"  class="input_txt" name="username">
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