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
                </li>
                <li class="am-cf">
                    <div class="choiceBankss clearfix">
						<!--input type="text" name="amount" value=""  placeholder="最低充值50元" class="input_txt" /-->
                        <input type="radio" name="amount" id="amount" value="1.00" />1元</br>
                        <input type="radio" name="amount" id="amount" value="100.00" checked="checked"/>100元</br>
                        <input type="radio" name="amount" id="amount" value="200.00"/>200元</br>
                        <input type="radio" name="amount" id="amount" value="500.00"/>500元</br>
                        <input type="radio" name="amount" id="amount" value="1000.00"/>1000元</br>
                        <input type="radio" name="amount" id="amount" value="1500.00"/>1500元</br>
                        <input type="radio" name="amount" id="amount" value="2000.00"/>2000元</br>
                        <input type="radio" name="amount" id="amount" value="2500.00"/>2500元</br>
                        <input type="radio" name="amount" id="amount" value="3000.00"/>3000元</br>
                        <input type="radio" name="amount" id="amount" value="4001.00"/>4001元

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
    <div id="zypay_post"></div>
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
                        $('#zypay_post').html(json.data);
                        $("#zypay_post form").submit();

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

	$(".collectBank_ra").click(function(){
		var paytype = $(this).find("input[name='paytype']").val(); 
		$("[date-paytype='"+paytype+"']").show().siblings("[date-paytype]").hide();
	})
    $(function(){
            $('.choiceBankss').find('.collectBank_ra').eq(0).addClass('checked');
            $('.choiceBankss').find('.collectBank_ra').eq(0).find('.r_right').show();
            $('.choiceBankss').find('.collectBank_ra').eq(0).find('input').prop('checked',true);
            var paytype = $('.choiceBankss').find('.collectBank_ra').eq(0).find("input[name='paytype']").val();
            $("[date-paytype='"+paytype+"']").show().siblings("[date-paytype]").hide();
        })
	</script>
</body>
</html>