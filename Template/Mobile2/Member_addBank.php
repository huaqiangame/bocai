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
			绑定银行卡
		</h1>

	</header>
	
	<div class="bank_recharge">
		<form action="{:U('Member/addBank')}" method="post" class="am-form">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">持卡人姓名:</span>

					<div class="am-form-group bank_right_select am-fr">
						<span class="am-form-caret userbankname">{$userinfo.userbankname}</span>
					</div>

					<!--<div class="am-fr bank_right_input">
						<input type="text"  id="accountname" name="accountname"  class="input_txt" placeholder="请输入您的真实姓名" >
					</div>-->
					
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">选择银行</span>
					<div class="am-form-group bank_right_select am-fr">
						<select name="bankname" id="sysBankCard" class="select_common">
							<option value="">请选择银行</option>
							<volist name="Allbank" id="value">
								<option value="{$value['bankcode']}">{$value['bankname']}</option>
							</volist>
						</select>
						<span class="am-form-caret"></span>
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">开户省</span>
					<div class="am-form-group bank_right_select am-fr">
						<select id="s_province" name="province" class="select_common"   data-shen="请选择开户省份">
						</select>
						<span class="am-form-caret"></span>
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">开户市</span>
					<div class="am-form-group bank_right_select am-fr">
						<select  name="city" id="s_city" class="select_common"   data-shi="请选择开户城市">
						</select>
						<span class="am-form-caret"></span>
					</div>
				</li>
<!--				<li class="am-cf">
					<span class="bank_form_left am-fl" >开户人姓名</span>
					<div class="am-fr bank_right_input">
						<input name="accountname" type="text" class="input_txt" placeholder="请输入银行卡的姓名" >
					</div>
				</li>-->
				<li class="am-cf">
					<span class="bank_form_left am-fl">开户网点</span>
					<div class="am-fr bank_right_input">
						<input type="text"  id="bankBranch" name="accountname"  class="input_txt" placeholder="开户网点" >
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">银行卡号</span>
					<div class="am-fr bank_right_input">
						<input type="text"  id="bankCardNum" name="banknumber"  class="input_txt" placeholder="请输入银行卡的卡号" >
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">确认卡号</span>
					<div class="am-fr bank_right_input">
						<input type="text" id="regBankCardNum" name="rebanknumber"  class="input_txt" placeholder="请再次输入银行卡号">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">资金密码</span>
					<div class="am-fr bank_right_input">
						<input type="password" id="bankTradPwd" name="safepass"  class="input_txt" placeholder="请输入您的资金密码">
					</div>
				</li>
			</ul>

			<button class="am-btn am-btn-danger am-radius am-btn-block"  onclick="userbindbankcard();" type="button">确定</button>
		</form>	
	</div>
	<include file="Public/footer" />
	<script>
		var userbindbankcard = function(){

			var url = '__ROOT__/Apijiekou.' + 'userbindbankcard';
			var bankCode = $("#sysBankCard").val();
            var _username = $(".userbankname").html();
			var bankCardNumber = $("#bankCardNum").val();
			var regbankCardNumber = $("#regBankCardNum").val();
			var province = $("#s_province").val();
			var city = $("#s_city").val();

			var bankTradPwd = $("#bankTradPwd").val();
			// 07-11 add 开户行网点
			var bankBranch = $("#bankBranch").val();
			bankBranch = bankBranch?bankBranch:"";
			/*if(!_username || _username !=""){
				alert("请输入你的真实姓名");
				return false;
			}*/

			if(_username.length<2){
				window.location.href="{:U('Account/userbankname')}"
			}
			if (bankCode.length < 1) {
				alert("请选择银行卡");return false;
			} else if (province=="省份" || city=="地级市") {
				alert("请选择开户省市");return false;

			} else if (bankCardNumber.length < 1) {
				alert("请输入银行卡号");return false;

			} else if (regbankCardNumber.length < 1) {
				alert("请输入确认银行卡号");return false;
			} else if (regbankCardNumber != bankCardNumber) {
				alert("两次卡号输入的不一致，请重新输入");return false;
			} else if (bankTradPwd.length < 1) {
				alert("请输入资金密码");return false;
			}
			var bankAddress = province + "-" + city;
			$.post(url,{
				"bankCardNumber": bankCardNumber,
				"bankAddress": bankAddress,
				"bankTradPwd": bankTradPwd,
				"bankCode": bankCode,
				"regbankCardNumber": regbankCardNumber,
				"bankBranch": bankBranch,
				"accountname": _username
			}, function(json){
				if(json.sign){
					alert('银行绑定成功',1);
					window.location.href="{:U('Member/bindcard')}";
				}else{
					alert(json.message,-1);
					return false;
				}
				return false;
			},'json');

			/*			 },
			 lock:true
			 });*/
		}
	</script>
</body>
</html>