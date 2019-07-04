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
			验证密保邮箱
		</h1>
	</header>
	
	<div class="bank_recharge">
		<!--onSubmit="return checkform(this)"-->
		<form action="" method="post"  class="am-form">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">绑定邮箱</span>
					<div class="am-fr bank_right_input">
						<input type="text" name="emial"  id="testtomail" value="{$userinfo['email']}" class="input_txt" placeholder="请输入你需要绑定的邮箱" />
					</div>
				</li>
<!--				<li class="am-cf" style="position:relative;">
					<span class="bank_form_left am-fl">输入验证码</span>
					<div class="am-fr bank_right_input">
						<input type="text" name="code" class="input_txt" placeholder="请输入验证码">
					</div>
					<span style="position:absolute;right:0.1rem;font-size:0.18rem;top:0.08rem;" onclick="testemail();">发送验证码</span>
				</li>-->
			</ul>
			<button class="am-btn am-btn-danger am-radius am-btn-block" type="submit">确定</button>
		</form>	
	</div>
	<script>
		function testemail(){
			$("#testmailbtn").val('正在发送！请稍后...');
			$.post("{:U('Member/testtomail')}",{'to':$("#testtomail").val(),'SMTP_HOST':$("#SMTP_HOST").val(),'SMTP_PORT':$("#SMTP_PORT").val(),'SMTP_USER':$("#SMTP_USER").val(),'SMTP_PASS':$("#SMTP_PASS").val()}, function(json){
				if(json.status==1){
					alert('发送成功,验证码已经发送到你绑定的邮箱');
				}else if(json.status==0){
					alert(json.info);
				}
			}, "json");
		}
	</script>
</body>
</html>