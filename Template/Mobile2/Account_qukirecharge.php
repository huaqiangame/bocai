<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<link rel="stylesheet" href="__CSS__/recharge.css">
<style>
	.choiceBankss{
		width: 248px;
		margin: 0 auto;
		padding-top: 5px;
	}
	.collectBank_ra{
		margin-bottom: 5px;
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
			银行转账
		</h1>

	</header>
	<div id="pay_alipay" class="me-infor" style="display:none;padding: 15px;background: #fff;margin-bottom:10px;">
			<div class="infor-xx">
					<ul class="mar-lr20">
						<li>尊敬的客户您好，您的充值订单已经生成，请您在该页面继续完成充值。</li>
						<li>
							<strong>充值金额：</strong>
							<span><em class="mark" id="saomabill_amount" way-data="onlineBank.amount"></em>元</span>
						</li>
						<li>
							<strong>订单编号：</strong>
							<span way-data="onlineBank.trano" id="saomabill_trano" class="mark"></span>
						</li>	
					</ul>
				</div>
				<input type="hidden" way-data="saomabill_paytype" id="saomabill.paytype" />
				<a class=" btn common_btn" onclick="payonlineBank()" style=" width: 9em;display: block;margin: 1em auto;background: #dd514c;text-align: center;border-radius: 4px;color: #fff;" href="javascript:;" id="onlineBankUrl">登录网银完成支付</a>
	</div>

	<div class="bank_recharge">
		<form action="" method="post" id="formrecharge" class="am-form">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">选择网银：</span>
				</li>
				<li class="am-cf">
				<div class="choiceBankss clearfix">
					<volist name="Allbank" id="value" >
					<span class="collectBank_ra">
						<i class="iconfont icon-yuanquanxuanzhong"></i>
						<input type="radio" name="paytype" value="{$value.paytype}"  style="display:none;" />
						<em style="font-size:12px;">{$value.paytypetitle|msubstr=0,4,'utf-8',0}</em>
						<div class="r_right" style="display: none;">
							<span class="r_right_con">√</span>
						</div>
					</span>
					</volist>
				</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">充值金额</span>
					<div class="am-fr bank_right_input">
						<input type="text" name="amount" value=""  placeholder="最低充值10元" class="input_txt" />
					</div>
				</li>
			</ul>

			<button class="am-btn am-btn-danger am-radius am-btn-block" type="button" onclick="addrecharge()">确定</button>
		</form>	
		<volist name="Allbank" id="value" >
		<div class="bottom_explain" date-paytype="{$value.paytype}" style="display:none">
			{$value.remark}
		</div>
		</volist>
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
						$("#pay_alipay").show();
						$('#formrecharge').hide();
						$('#saomabill_trano').text(json.data.trano);
						$('#saomabill_amount').text(json.data.amount);
						// window.location.href = "{:U('Account/dealRecord2')}";
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
		var host = '//' + window.location.host;
		var apirooturl = host + '/Apijiekou.';
			function payonlineBank(){
		var trano = $('#saomabill_trano').text(); //获取订单号
		var paytype = $("input[name='paytype']:checked").val();                 //获取支付方式
		var choosebankcode = $("#onlineBankUrl").attr('choosebankcode');
		paytype = paytype?paytype:'';
		if(trano=='' || paytype==''){
			alert('订单不完整',-1);
			return false;
		}

		var redirecturl = null;
		// alert(apirooturl + 'getpayhost?paytype='+paytype);
		$.ajax({
			url: apirooturl + 'getpayhost?paytype='+paytype,
			type: "post",
			dataType: "json",
			data: {'paytype':paytype},
			async:false,
			success: function(data) {
				if (data.sign === true) {
					redirecturl = data.redirecturl;
					//alt(data.message,1);
				}else{
					alert(data.message,-1);
					return false;
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				//alt('服务器链接失败',-1);return false;
			}
		});
		var host = "{$Think.server.http_host}";
		if(redirecturl==null || redirecturl=='#' || redirecturl=='/' || redirecturl==''){
			var url = payhost+'/Pay.onlinebank?trano='+trano+'&host='+encodeURIComponent(host)+'&bankcode='+choosebankcode;
		}else{
			var url = redirecturl+'/Pay.onlinebank?trano='+trano+'&host='+encodeURIComponent(host)+'&bankcode='+choosebankcode;
		}
		window.open(url);
		$(".me-deposit .d-one,.me-deposit .d-tow").removeClass('cur');
		$(".me-deposit .d-three").addClass('cur');
	}
	$(".collectBank_ra").click(function(){
		var paytype = $(this).find("input[name='paytype']").val(); 
		$("[date-paytype='"+paytype+"']").show().siblings("[date-paytype]").hide();
	})
	</script>
</body>
</html>