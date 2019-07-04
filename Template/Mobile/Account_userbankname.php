<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			绑定真实姓名 
		</font></h1>
</div>
	
<div class="bank_recharge" style="width:100%;position:absolute;top:50px;">
		<form action="{:U(Account/userbankname)}" class="update_form" method="post">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">姓名：</span>
					<div class="am-fr bank_right_input">
						<input type="text"  class="input_txt" id="username"  name="userbankname">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">资金密码：</span> 
					<div class="am-fr bank_right_input">
						<input type="password"  class="input_txt" name="tradepassword" >
					</div>
				</li>
			</ul>
			<button type="submit"class="am-btn am-btn-danger am-radius am-btn-block" onclick="return IsChinese();">提交</button>
		</form>	
	</div>
	<include file="Public/footer" />
	<script>
		function IsChinese()
		{
			var str = document.getElementById('username').value.trim();
			if(str.length!=0){
				reg=/^[\u0391-\uFFE5]+$/;
				if(!reg.test(str)){
					alert("请输入真实中文姓名");//请将“字符串类型”要换成你要验证的那个属性名称！
					return false;
				}
			}
			if(str.length<1){
					alert("请输入真实中文姓名");
				  return false;
			}
		}
	</script>
</body>
</html>