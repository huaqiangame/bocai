<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>{:GetVar('webtitle')}</title>
	<meta name="keywords" content="{:GetVar('keywords')}" />
	<meta name="description" content="{:GetVar('description')}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >

	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/header.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
	<link rel="stylesheet" href="__CSS2__/recharge.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" href="http://at.alicdn.com/t/font_lo77yrw5tt8adcxr.css">

</head>
<style>
	.me-infor {
		overflow: hidden;
		margin: 10px 0;
	}
	.me-infor .infor-xx {
		padding: 10px 20px;
		margin: 0 0 10px;
		border: 1px solid #e3e3e3;
	}
	.me-infor .infor-xx ul li {
		display: block;
		height: 36px;
		line-height: 36px;
		padding: 3px 0;
	}
	.me-infor .infor-xx h6{
		float:left;
	}
	.mark {
		color: #f33d3d;
	}
</style>
<body>
<include file="Public/header" />
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
	<div class="vip_info clearfix container">
		<include file="Member/side" />
		<div class="pull-right vip_info_pan">
			<div class="vip_info_title">
				我要充值
			</div>
			<div class="vip_info_content recharge_main">
               <include file="Account/paylist" />
				<form action="">
				<div class="common_border_box1 choiceBank_box">
					<div class="choiceBank clearfix">
						<span class="choiceMoney_l pull-left">选择网银：</span>
						<div class="collectBank_list pull-left"> 
							<span class="collectBank_ra checked">
								<i class="iconfont icon-yuanquanxuanzhong"></i>
								<input type="radio" name="paytype" value="jifubaopay" checked="checked"  style="display:none;"> 
								<em>吉宝付</em>
								<div class="r_right">
									<span class="r_right_con">√</span>
								</div>
							</span> 
						</div>
					</div>
					<div class="choiceMoney">
						<strong class="choiceMoney_l">充值金额：</strong><input type="text" name="amount" id="amount" placeholder="最低充值50元" class="common_input">
					</div>
					<button type="button" class="btn common_btn nextbtn " >下一步</button>
					<div id="pay_onlineBank" class="me-infor" style="display:none;">
						<div class="infor-xx">
							<ul class="mar-lr20">
								<li>尊敬的客户您好，您的充值订单已经生成，请您在该页面继续完成充值。</li>
								<li>
									<h6>充值金额：</h6>
									<span><em class="mark" way-data="onlineBank.amount"></em>元</span>
								</li>
								<li>
									<h6>订单编号：</h6>
									<span way-data="onlineBank.trano" class="mark"></span>
								</li>

							</ul>

						</div>

						<div>
							<a class=" btn common_btn" href="javascript:;" onclick="payonlineBank();" id="onlineBankUrl">登录网银完成支付</a>
						</div>
					</div>
					<volist name="Allbank" id="value" >
					<div class="prompt" date-paytype="{$value.paytype}" style="display:none">
						{$value.remark}
					</div>
					</volist>
				</div>
				</form>
			</div>
		</div>
	</div>
<script>
	 
	$('.nextbtn').click(function () { 
		if($("input[name='paytype']:checked").val()== undefined )alt('请选择充值方式');
		if($('#amount').val()=="")alt('请输入充值金额');
		 $.ajax({
			 type : 'POST',
			 url : "{:U('Home/Apijiekou/addrecharge')}",
			 data :{
				 amount  : $('#amount').val(),
				 paytype : $("input[name='paytype']:checked").val(),
			 },
			 success : function (data) {
				 if(data.sign == true){
					 //alt(data.message);
                     $('.nextbtn').hide();
					 $('.choiceBank').hide();
					 $('.choiceMoney').hide();
					 $("#pay_onlineBank").show();
					 way.set("onlineBank.amount",data.data.amount);
					 way.set("onlineBank.trano",data.data.trano);
					 way.set("onlineBank.id",data.data.id);
					 way.set("onlineBank.paytype",data.data.paytype);
/*					 way.set("linepay.paylinebankname",paylinebankname);
					 way.set("linepay.paylinebankaccountname",paylinebankaccountname);*/
				 }else{
					 alt(data.message);
				 }
			 }
		 })
	})
	function payonlineBank(){
		var trano = way.get("onlineBank.trano")?way.get("onlineBank.trano"):''; //获取订单号
		var paytype = $("input[name='paytype']:checked").val();                 //获取支付方式
		var choosebankcode = $("#onlineBankUrl").attr('choosebankcode');
		paytype = paytype?paytype:'';
		if(trano=='' || paytype==''){
			alt('订单不完整',-1);
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
					alt(data.message,-1);
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
<include file="Public/footer" />
</body>
</html>