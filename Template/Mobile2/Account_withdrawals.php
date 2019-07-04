<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<style>
	body{
		background-color: #fff;
	}
</style>
<body>
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>

		<h1 class="am-header-title activity_h1">
			提现
		</h1>

	</header>
	
	<div class="bank_recharge tankMoney_main">
		<form class="am-form " method="post" action="{:U('Apijiekou/savetikuanorder')}" url="" checkby_ruivalidate id="register_form"  onsubmit="return checkform(this)" >
 			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">持卡人姓名</span>
					<div class="am-fr bank_right_input">
						{$Think.session.userinfo.userbankname}
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">账户余额</span>
					<div class="am-fr bank_right_input">
						<input type="text" value="{$userinfo.balance}" class="take_balance" disabled="disabled">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">可提现金</span>
					<div class="am-fr bank_right_input">
						<input type="text" value="{$userinfo.balance}" class="take_balance" disabled="disabled">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">提现账户</span>

					<div class="am-fr bank_right_input selected_bank">
						<volist name="banklist" id="vo" key="v">
							<if condition="$vo['state'] eq 1">
								<img src="__ROOT__/resources/images/bank/{$vo.banklogo}" style="float: left;margin-top: 10px;width:30px;"  />
								<div class="bank_info">
									<em class="bank-name">{$vo.bankname}</em>
									<em>**********<span class="bank-sum">{$vo._banknumber|substr=-5}</span></em>
								</div>
								<i class="iconfont icon-jiantouxia"></i>
							</if>
						</volist>
					</div>

					<ul class="bank_list_box bank_right_input">
						<volist name="banklist" id="vo" key="v">
						<li class="bank_list" data-bank-icon="__ROOT__/resources/images/bank/{$vo.banklogo}" data-bank-name="{$vo.bankname}" data-bank-sum="{$vo._banknumber|substr=-5}">
 							<eq name="vo['state']" value="1">
							<input type="radio"  name="bankid" class="isplay_no" value="{$vo.id}" checked="checked">
								<else />
								<input type="radio"  name="bankid" value="{$vo.id}" class="isplay_no" >
							</eq>
							<img src="__ROOT__/resources/images/bank/{$vo.banklogo}" style="float: left;margin-top: 10px;width:30px;"  />
 							<div class="bank_info">
								<em>{$vo.bankname}</em>
								<em>{$vo._banknumber|substr=-5}</em>
							</div>
						</li>
						</volist>

						<li>请选择你要提现的银行卡</li>
					</ul>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">提现金额</span>
					<div class="am-fr bank_right_input">
						<input type="text" name="amount"  class="input_txt" value="10" placeholder="提款金额至少10元" >
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">资金密码</span>
					<div class="am-fr bank_right_input">
						<input type="password"  class="input_txt" name="withdraw_pwd" placeholder="请输入您的资金密码">
					</div>
				</li>
			</ul>

			<button class="am-btn am-btn-danger am-radius am-btn-block" type="submit">确定</button>
		</form>	
		<div class="bottom_explain">
			<p>今天还可以提现<em data-tkcount>{$count}</em>次</p>
			<p>可提现金额=有效投注×3(此项需达到充值金额的30%才计入)+奖金+活动礼金</p>
			<p>单笔提现最低<em>10</em>元，最高<em>2000000</em>元</p>
		</div>
	</div>
	<include file="Public/footer" />
	<script>
		function checkform(obj){
			$.post($(obj).attr('action'),$(obj).serialize(), function(json){
				if(json.sign){
					alert(json.message,'success');
					var tkcount = $("[data-tkcount]").text()/1;
					tkcount = tkcount-1;
					if(tkcount<=0){
						tkcount = 0;
					}
					$("[data-tkcount]").text(tkcount);
					window.location.reload();
				}else{
					alert(json.message);
				};
			},'json');
			return false;
		};
	</script>
</body>
</html>