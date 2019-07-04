<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			验证提款密码
		</font></h1>
</div>
	
	<div class="bank_recharge">
		<form class="am-form" action="" method="post" id="form1">
			<input type="hidden" name="settype" value="1">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">原提款密码</span>
					<div class="am-fr bank_right_input">
						<input type="password" name="oldpassword" class="input_txt" placeholder="请输入当前所使用的密码">
					</div>
				</li>
			</ul>
			<input  type="submit" value="确   定"  class="am-btn am-btn-danger am-radius am-btn-block" style="width:90%;"/>
			        <button class="am-btn am-btn-danger am-radius am-btn-block " style="margin-top:10px;margin-bottom: 25px;background-color:#fffff1"><a href="{:U('find_safepass')}">找回提款密码</a></button>
		</form>	
		<div class="bottom_explain">
			<p>提款密码用于提现、绑定银行卡等操作，可保障资金安全。</p>
		</div>
	</div>
	<include file="Public/footer" />
</body>
</html>