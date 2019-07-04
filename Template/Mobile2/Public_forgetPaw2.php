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
			验证方式
		</h1>
	</header>
	
	<div class="bank_recharge">
		<form action="{:U('Public/forgetPaw2')}" class="update_form" method="post">
			<input type="hidden" name="settype" value="2">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl yztext2">新密码:</span>
					<div class="am-fr bank_right_input">
						<input type="text"  class="input_txt" placeholder="请输入新密码" name="pa">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl yztext2">确认新密码:</span>
					<div class="am-fr bank_right_input">
						<input type="text"  class="input_txt" placeholder="请再次输入新密码" name="pa1">
					</div>
				</li>
			</ul>
			<button class="am-btn am-btn-danger am-radius am-btn-block" type="submit">确定</button>
		</form>	
	</div>
	<script>
		function Choose(a) {
			$('input[name=yztype]').attr('checked','');
			if(a=='1'){
				$('input[name=yztype]').eq(0).attr('checked','checked');
				$('.yztext2').html('手机:');
				$('.input_txt').attr('placeholder',"请输入绑定的手机");
			}else{
				$('input[name=yztype]').eq(1).attr('checked','checked');
				$('.yztext2').html('邮箱:');
				$('.input_txt').attr('placeholder',"请输入绑定的邮箱");
			}
		}
	</script>
	<include file="Public/footer" />
</body>
</html>







