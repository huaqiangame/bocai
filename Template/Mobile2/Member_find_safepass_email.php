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
		邮箱验证
	</h1>
</header>
	<div class="update_pass bank_recharge">
	<div class="container-fluid">
		<form action="{:U('Member/find_safepass_email')}" method="post" class="update_form">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">邮箱：</span>
					<div class="am-fr bank_right_input">
						<input type="text" name="email" id="testtomail" value=""  class="input_txt" />
					</div>
				</li>
<!--				<li class="am-cf" style="position:relative;">
					<span class="bank_form_left am-fl">
						验证码：
					</span>
					<div class="am-fr bank_right_input">
						<input type="text" name="code" class="test_code input_txt"  placeholder="请输入验证码">
					</div>
					<span style="position:absolute;right:0.1rem;font-size:0.18rem;top:0.08rem;" href="javascript:void(0)" class="get_code" onclick="testemail();">获取验证码</span>
				</li>-->
			</ul>
			<button class="am-btn am-btn-danger am-radius am-btn-block btn common_btn save_pass" type="submit">提交</button>
		</form>	
	</div>
	</div>

<include file="Public/footer" />
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

<!--	<div class="modal fade update_pass_success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
	      </div>
	      <div class="modal-body">
	        邮箱绑定成功
	      </div>
	      <div class="modal-footer">
	        <a href="securityCenter.html" class="btn common_btn">确定</a>
	      </div>
	    </div>
	  </div>
	</div>-->
</body>
</html>