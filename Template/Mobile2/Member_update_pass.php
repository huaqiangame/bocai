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
			验证原密码
		</h1>
	</header>
	
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