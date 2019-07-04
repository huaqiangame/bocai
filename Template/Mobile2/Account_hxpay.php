<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>

		<h1 class="am-header-title activity_h1">
			收银台
		</h1>

	</header>

	<div class="bank_recharge">
		<form method="post" id="bank_recharge_from" action="/hxpay/pay.php" >
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">充值金额</span>
					<div class="am-fr bank_right_input">
						<input type="text" name="amount" id="amount" placeholder="最低充值{$payinfo.minmoney}" class="input_txt">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">充值方式</span>
					<div class="am-fr bank_right_input">
							<select name="type" id='pay_type'>
							  <option value ="0">请选择支付方式</option>
							  <option value ="2">支付宝</option>
							   <option value ="1">微信</option>
							</select>
					</div>
				</li>
			</ul>
				<input type="hidden"  name="user" value="{$_SESSION['userinfo']['username']}" checked="checked"  style="display:none;">
			<button class="am-btn am-btn-danger am-radius am-btn-block nextbtn"   >确定</button>
		</form>	
		<div class="bottom_explain">
		{$payinfo.remark}
		</div>
	</div>

	<include file="Public/footer" />

	<script>
			$('.nextbtn').click(function () {
			if($('input[name=amount]').val()=="") {
				alert('请输入充值金额');return false;
			}
			if($('#pay_type').val()=="0") {
				alert('请选择支付方式');return false;
			}
			
		 }
		)
		

	</script>
</body>
</html>