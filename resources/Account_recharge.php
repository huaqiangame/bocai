<include file="Public/headermember" />
    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS2__/reset.css">
    <link rel="stylesheet" href="__CSS2__/userInfo.css">
    <link rel="stylesheet" href="__CSS2__/recharge.css">
    <link rel="stylesheet" href="http://at.alicdn.com/t/font_lo77yrw5tt8adcxr.css">
    
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<script type="text/javascript" src="__JS__/index.js"></script>
<div class="vip_info clearfix container">
    <include file="Member/side" />
    <div class="pull-right vip_info_pan">
        <div class="vip_info_title">
            我要充值
        </div>
        <div class="vip_info_content recharge_main">
		               <include file="Account/paylist" />
            <form action="{:U('Apijiekou/recharge')}" id="formrecharge" method="post">
                <div class="quick_recharge_top common_border_box1">
                    <div class="qrecharge_title">
                        <i class="sum">1</i>
                        <strong>请转账到以下银行账户：</strong>
                        <span>单笔最低<em>{$payinfo.minmoney|floor}</em>元，最高<em>{$payinfo.maxmoney|floor}</em>元</span>
                    </div>
                    <div class="collectBank collectBank_spe">
                        <span class="collectBank_l">收款银行：</span>
						<span class="collectBank_ra checked">
							<i class="iconfont icon-yuanquanxuanzhong"></i>
							<input type="radio" name="paytype" value="{$payinfo.paytype}"  style="display:none;" checked="checked">
<!--							<svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-jiansheyinhang"></use>
                            </svg>-->
							<em>{$payinfo.paytypetitle}</em>
							<div class="r_right">
                                <span class="r_right_con">√</span>
                            </div>
						</span>
                    </div>
                    <div class="collectBank">
                        <span class="collectBank_l">银行户名：</span>
                        <span class="collectBank_info">{$bankname}</span>
                        <a href="#none" class="copy_text">复制</a>
                    </div>
                    <div class="collectBank">
                        <span class="collectBank_l">银行账号：</span>
                        <span class="collectBank_info">{$bankcode}</span>
                        <a href="#none" class="copy_text">复制</a>
                    </div>
                    <div class="collectBank">
                        <span class="collectBank_l">开户支行：</span>
                        <span class="collectBank_info">{$payinfo.ftitle}</span>
                        <a href="#none" class="copy_text">复制</a>
                    </div>
                </div>
                <div class="quick_recharge_bottom common_border_box1">
                    <div class="qrecharge_title">
                        <i class="sum">2</i>
                        <strong>请认真填写您的转账信息：</strong>
                        <span>请务必转账后再提交订单,否则无法及时查到您的款项！</span>
                    </div>
                    <div class="quick_rechargeb_input">
						<span class="money"> 
							<strong>充值金额：</strong>
							<input type="text" name="amount" value="{$payinfo.minmoney|floor}" placeholder="最低充值{$payinfo.minmoney|floor}" />
						</span>
						<span class="bankName">
							<strong>您的银行卡姓名：</strong>
							<input type="text" name="userpayname" placeholder="请输入付款人的银行卡预留姓名">
						</span>
                    </div>
                    <button type="button" onclick="addrecharge()" class="common_btn btn">提交充值订单</button>
                    <div class="prompt">
					    {$payinfo.remark}
                        <p>※ 温馨提示：</p>
                        <p>1、请转账完成后再提交充值订单。</p>
                        <p>2、请正确填写您的户名和充值金额。</p>
                        <p>3、转账1笔提交1次，请勿重复提交订单。</p>
                        <p>4、转帐完成后请保留单据作为核对证明。</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
 function addrecharge() {
     $.ajax({
         type:"post",
         url:"{:U('Home/Apijiekou/addrecharge')}",
         data : $('#formrecharge').serialize(),
         success : function (json) {
             if(json.sign==1){
                 alert(json.message);
                window.location.href = "{:U('Account/dealRecord2')}";
             }else{
                 alert(json.message);
             }

         }
     })
 }
</script>
<include file="Public/footer" />
</body>
</html>