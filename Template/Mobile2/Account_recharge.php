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
			银行转账
		</h1>

	</header>
	
	<div class="bank_recharge">
		<form action="" method="post" id="formrecharge" class="am-form">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">收款银行</span>
					<div class="am-fr bank_right_input">
						<input type="hidden"   name="paytype" value="{$payinfo.paytype}"  class="copy_txt" >
						<em style="padding-top:10px;display:block;">{$payinfo.ftitle}</em>
						<span class="am-form-caret"></span>
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">收款户名</span>
					<div class="am-fr bank_right_input">
						<input type="text" value="{$bankname}" class="copy_txt" disabled="disabled">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">收款账号</span>
					<div class="am-fr bank_right_input">
						<input type="text" value="{$bankcode}" class="copy_txt" disabled="disabled">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">开户支行</span>
					<div class="am-fr bank_right_input">
						<input type="text" value="{$payinfo.ftitle}" class="copy_txt" disabled="disabled">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">充值金额</span>
					<div class="am-fr bank_right_input">
						<input type="text" name="amount" value="{$payinfo.minmoney|floor}"  class="input_txt" placeholder="至少{$payinfo.minmoney|floor}" >
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">转账户名</span>
					<div class="am-fr bank_right_input">
						<input type="text"  class="input_txt" name="userpayname" placeholder="请输入付款人的银行卡姓名">
					</div>
				</li>
			</ul>

			<button class="am-btn am-btn-danger am-radius am-btn-block" type="button" onclick="addrecharge()">确定</button>
		</form>	
		<div class="bottom_explain">
			<p>1、请转账到以上收款银行账户。</p>
			<p>2、请正确填写转账银行卡的持卡人姓名和充值金额，以便及时核对。</p>
			<p>3、转账1笔提交1次，请勿重复提交订单。</p>
			<p>4、请务必转账后再提交订单,否则无法及时查到您的款项！</p>
		</div>
	</div>
	<include file="Public/footer" />
	<script>
		function addrecharge() {
			$.ajax({
				type:"post",
				url:"{:U('Apijiekou/addrecharge')}",
				data : $('#formrecharge').serialize(),
				success : function (json) {
					if(json.sign==1){
						alert(json.message);
						window.location.href = "{:U('Account/dealRecord2')}";
					}else{
						if(json.message=="请输入您的支付账号"){
							alert("请输入您的银行卡姓名")
						}else{
							alert(json.message);
						}

					}

				}
			})
		}
	</script>
</body>
</html>