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
			验证资金密码
		</h1>
	</header>
	
	<div class="bank_recharge">
		<form class="am-form" action="" method="post" id="form1">
			<input type="hidden" name="settype" value="1">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">原资金密码</span>
					<div class="am-fr bank_right_input">
						<input type="password" name="oldpassword" class="input_txt" placeholder="请输入当前所使用的密码">
					</div>
				</li>
			</ul>
			<p class="bank_pass"><a href="{:U('find_safepass')}">找回资金密码?</a></p>
			<input  type="submit" value="确   定"  class="am-btn am-btn-danger am-radius am-btn-block"/>
		</form>	
		<div class="bottom_explain">
			<p>资金密码用于提现、绑定银行卡等操作，可保障资金安全。</p>
		</div>
	</div>
	<include file="Public/footer" />
</body>
</html>