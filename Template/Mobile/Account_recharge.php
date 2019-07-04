<script src="__JS__/clipboard.min.js"></script>
<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
 
<body>
<div class="biaoti" style="top:10;">
		<h1><font  style="color:#fff ; font-size:18px;">
			银行转帐
		</font></h1>
</div>

<div class="bank_recharge" style="width:100%;position:absolute;top:50px;">
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
						<input type="hidden" value="{$bankname}"    disabled="disabled">
                        <span  class="copy_txt target2">{$bankname}
                        </span>
                        <span  data-clipboard-target=".target2" id="copy_btn" >复制</span>
					</div>
				</li>
                <li class="am-cf">
                    <span class="bank_form_left am-fl">收款账号</span>
                    <div class="am-fr bank_right_input">
                        <input type="hidden" value="{$bankcode}"  disabled="disabled">
                        <span  class="copy_txt target3">{$bankcode}
                        </span>
                        <span -class="copu_btn" data-clipboard-target=".target3" id="copy_btn1">复制</span>
                    </div>
                </li>
                <li class="am-cf">
                    <span class="bank_form_left am-fl">开户支行</span>
                    <div class="am-fr bank_right_input">
                        <input type="hidden" value="{$payinfo.ftitle}"  disabled="disabled">
                        <span  class="copy_txt target4">{$payinfo.ftitle}
                        </span>
                        <span -class="copu_btn" data-clipboard-target=".target4" id="copy_btn2">复制</span>
                    </div>
                </li>

<script>
    $(document).ready(function(){
        var clipboard = new Clipboard('#copy_btn');
        clipboard.on('success', function(e) {
            var $copysuc = $("<div class='copy-tips'><div class='copy-tips-wrap'>☺ 复制成功</div></div>");
            $("body").find(".copy-tips").remove().end().append($copysuc);
            $(".copy-tips").fadeOut(3000);
            e.clearSelection();
        });
        var clipboard1 = new Clipboard('#copy_btn1');
        clipboard1.on('success', function(e) {
            var $copysuc = $("<div class='copy-tips'><div class='copy-tips-wrap'>☺ 复制成功</div></div>");
            $("body").find(".copy-tips").remove().end().append($copysuc);
            $(".copy-tips").fadeOut(3000);
            e.clearSelection();
        });
        var clipboard2 = new Clipboard('#copy_btn2');
        clipboard2.on('success', function(e) {
            var $copysuc = $("<div class='copy-tips'><div class='copy-tips-wrap'>☺ 复制成功</div></div>");
            $("body").find(".copy-tips").remove().end().append($copysuc);
            $(".copy-tips").fadeOut(3000);
            e.clearSelection();
        });
    });
</script>
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
            <p>1、支持微信与支付宝转账到银行卡！</p>
			<p>2、请转账到以上收款银行账户。</p>
			<p>3、请正确填写转账银行卡的持卡人姓名和充值金额，以便及时核对。</p>
			<p>4、转账1笔提交1次，请勿重复提交订单。</p>
			<p>5、请务必转账后再提交订单,否则无法及时查到您的款项！</p>
		</div>
	</div>
	<script>
		function addrecharge() {
			$.ajax({
				type:"post",
				url:"{:U('Apijiekou/addrecharge')}",
				data : $('#formrecharge').serialize(),
				success : function (json) {
					if(json.sign==1){
						alert(json.message);
						window.location.href = "{:U('Member/orderform')}";
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