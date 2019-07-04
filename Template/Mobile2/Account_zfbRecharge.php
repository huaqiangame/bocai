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
			支付宝
		</h1>

	</header>
	<div id="pay_alipay" class="me-infor" style="display:none;padding: 15px;background: #fff;margin-bottom:10px;">
			<div class="infor-xx">
					<ul class="mar-lr20">
						<li>尊敬的客户您好，您的充值订单已经生成，请您在该页面继续完成充值。</li>
						<li>
							<strong>充值金额：</strong>
							<span><em class="mark" id="saomabill_amount" way-data="saomabill.amount"></em>元</span>
						</li>
						<li>
							<strong>订单编号：</strong>
							<span way-data="saomabill.trano" id="saomabill_trano" class="mark"></span>
						</li>
						<li>
							<strong>附言码：</strong>
							<span way-data="saomabill.id" id="saomabill_id" class="mark"></span>
						</li>
						<li class='payerweima text-center'><h5>支宝付款二维码</h5></li>
						<li class='payerweima' style='height:auto'><span><img src="{$Allmsg['ewmurl']}" style='width:150px;border:none;display:block; margin:0 auto;'></span></li>
					</ul>
				</div>
				<input type="hidden" way-data="saomabill_paytype" id="saomabill.paytype" />
				<a class="btn common_btn" style=" width: 7em;display: block;margin: 1em auto;background: #dd514c;text-align: center;border-radius: 4px;color: #fff;" href="javascript:;"  onclick="alt('充值成功申请已提交')">扫码完成支付</a>
	</div>

	<div class="bank_recharge">
		<form method="post" id="bank_recharge_from" action="{:U('Account/recharge')}" >
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">充值金额</span>
					<div class="am-fr bank_right_input">
						<input type="text" name="amount" id="amount" placeholder="最低充值{$Allmsg.minmoney|floor}" class="input_txt">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">支付账号</span> 
					<div class="am-fr bank_right_input">
						<input type="text" name="payname" id="payname" placeholder="请输入你的支付账号" class="input_txt">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">充值方式</span>
					<div class="am-fr bank_right_input">
						<input type="radio"  name="paytype"  value="{$Allmsg['paytype']}" checked="checked" class="input_txt" style="display:none;">
						<svg class="icon" aria-hidden="true" style="width: 2em;height: 2em;margin-top: 7px;">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-zhifubao"></use>
						</svg>
					</div>
				</li>
			</ul>

			<button class="am-btn am-btn-danger am-radius am-btn-block nextbtn" type="button"  >确定</button>
		</form>	
		<div class="bottom_explain">
			{$Allmsg['remark']}
		</div>
	</div>

	<include file="Public/footer" />

	<script>
			$('.nextbtn').click(function () {
			if($('input[name=amount]').val()=="") {
				alert('请输入充值金额');return false;
			}
			if($('input[name=payname]').val()==""){
				alert('请输入支付账号');return false;
			}
			$.ajax({
				type : 'POST',
				url : "{:U('Apijiekou/addrecharge')}",
				data :{
					amount      : $('#amount').val(),
					paytype     : $("input[name='paytype']:checked").val(),
					userpayname : $("input[name='payname']").val(),
				},
				success : function (data) {
					if(data.sign == true){
						$('.nextbtn').hide();
						$('.choiceBank').hide();
						$('.choiceMoney').hide();
						$("#pay_alipay").show();
						$('#bank_recharge_from').hide();
						// way.set("saomabill.amount",data.data.amount);
						// way.set("saomabill.trano",data.data.trano);
						// way.set("saomabill.id",data.data.id);
						// way.set("saomabill.paytype",data.data.paytype);
						$('#saomabill_paytype').val(data.data.paytype);
						$('#saomabill_amount').text(data.data.amount);
						$('#saomabill_trano').text(data.data.trano);
						$('#saomabill_id').text(data.data.id);
						setTimeout(function () {checkispay(data.data.trano);}, 5000);	
					}else{
						alert(data.message);
					}
				}
			})
		})
var checkispayid;
function checkispay(trano){
	clearTimeout(checkispayid);
	$.ajax({
		url: "{:U('Apijiekou/checkrechargeisok1')}",
		data:{"trano": trano},  
		type: "post",
		dataType: "json",
		async:false,
		success: function(result) {
			if (result.sign === true) {
				if(result.state!=0){
					if(result.state==1){
						alt("充值成功");
					}else if(result.state==-1){
						alt("充值失败",-1);
					}
					//window.location.href = "{:U('Account/dealRecord2')}";
				}else{
					checkispayid = setTimeout(function () {
					checkispay(trano);
					}, 5000);	
				}
			} else {
					checkispayid = setTimeout(function () {
					checkispay(trano);
					}, 5000);	
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
					checkispayid = setTimeout(function () {
					checkispay(trano);
					}, 5000);	
		}
	});
}; 
$('.common_btn').click(function () {
	setTimeout(function (){
		window.location.href = '/Account.dealRecord2.do';
	},1500)
})
	</script>
</body>
</html>