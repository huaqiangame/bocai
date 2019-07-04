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
		<form action="{:U('Public/forgetPaw1')}" class="update_form" method="post">
			<input type="hidden" name="settype" value="2">
			<ul class="bank_form_list">
				<li class="am-cf">
					<div class="am-fr bank_right_input">
						<input type="radio" checked="checked" onclick="Choose(1)" name="yztype" value="tel">手机
						<input type="radio" name="yztype" onclick="Choose(2)" value="email">邮箱
						<input type="radio" name="yztype" onclick="Choose(3)" value="qq">QQ
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl yztext2">手机:</span>
					<div class="am-fr bank_right_input">
						<input type="text"  class="input_txt" placeholder="请输入绑定的手机" name="yztext">
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
			}else if(a=='2'){
				$('input[name=yztype]').eq(1).attr('checked','checked');
				$('.yztext2').html('邮箱:');
				$('.input_txt').attr('placeholder',"请输入绑定的邮箱");
			}else if(a=='3'){
				$('input[name=yztype]').eq(2).attr('checked','checked');
				$('.yztext2').html('QQ:');
				$('.input_txt').attr('placeholder',"请输入你设置的QQ");
			}
		}
	</script>
	<include file="Public/footer" />
</body>
</html>