<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>
账户充值 - 支付宝信用卡 - 网上支付 安全快速！
</title>
<script>
	var host = "{$host}";
	var payhost = "{$payhost}";
</script>
<script type="text/javascript" src="/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/Template/payer/saoma/css/saoma.js"></script>
<link charset="utf-8" rel="stylesheet" href="/Template/payer/saoma/css/api.css" media="all">
</head>
<body>

    <div id="header">
      <div class="header-container fn-clear">
        <div class="header-title">
          <div class="alipay-logo">
          </div>
          <span class="logo-title">
            我的收银台
          </span>
        </div>
      </div>
    </div>
     
<div id="container">
      <div id="content" class="fn-clear">
        <div id="J_order" class="order-area">
          <div id="order" class="order order-bow">
            <div class="orderDetail-base">
              <div class="commodity-message-row">
                <span class="first long-content">
                 当前用户名（{$payinfo.username}）</span>
                <span class="second short-content">
                  收款方：信用卡收银台&nbsp;
                </span>
              </div>
			   <span class="payAmount-area" id="J_basePriceArea">
            <strong class=" amount-font-22 ">{$payinfo.amount}</strong> 元
        </span>

            </div>
          </div>
        </div>
        <!-- 操作区 -->
        <div class="cashier-center-container">
          <div data-module="excashier/login/2015.08.02/loginPwdMemberT" id="J_loginPwdMemberTModule" class="cashiser-switch-wrapper fn-clear">
            <!-- 扫码支付页面 -->
            <div class="cashier-center-view view-qrcode fn-left" id="J_view_qr">
      
              <!-- 扫码区域 -->
              <div data-role="qrPayArea" class="qrcode-integration qrcode-area" id="J_qrPayArea">
                <div class="qrcode-header">
                  <div class="ft-center">
                    扫一扫付款（元）                  </div>
                  <div class="ft-center qrcode-header-money">{$payinfo.amount}</div>
                </div>
                <div class="qrcode-img-wrapper" id="payok">
				 <font>
				 <img class="ft-center" width="168" height="168" src="/Template/payer/saoma/ewm/creditcard.jpg"></font>
				 
                  <div class="qrcode-img-explain fn-clear">
                    <img class="fn-left" src="/Template/payer/saoma/css/T1bdtfXfdiXXXXXXXX.png" alt="扫一扫标识">
                    <div class="fn-left"><font id="zt">打开手机</font><br><font id="zt">扫描二维码完成支付</font></div>
                  </div>
                </div>
				<br>
          　　　　 　　<a href="https://mobile.alipay.com/index.htm" class="qrcode-downloadApp">首次使用请下载手机支付宝</a>
              </div>
            
              <!-- 指引区域 -->
				<div class="qrguide-area">
					<img src="/Template/payer/saoma/css/ali.png" class="qrguide-area-img active">
					<form class="orderform">
						<input type="hidden" name="trano" value="{$payinfo.trano}" >
						<p class="text-l mt-10"><strong>信用卡订单号:</strong></p>
                        <p class="text-l mt-10"><input type="text" name="threetrano" value="{$payinfo.threetrano}"></p>
						{if condition="$payinfo['threetrano'] neq ''"}
                        <p class="text-c mt-10"><a href="/Member.orderform?tabid=rechargelist" class="submitbtn">提交成功,查看订单状态</a></p>
						{else /}
                        <p class="text-c mt-10"><a onclick="checkorder()" class="submitbtn">确认完成</a></p>
						{/if}
                        <p class="text-l mt-10 remark">支付成功后必须将第三方支付订单号提交至平台，否则无法自动到账</p>
					</form>
				</div>
            </div>
       
          </div>
        </div>
      </div>
	  </div>
<div id="partner"><br><p>本站为第三方辅助软件服务商，与官网无任何关系，本支付系统拒绝违法网站使用 <br>扫码支付系统 不提供资金托管和结算，转账后将立即到达指定的账户。</p>
<br><img alt="合作机构" src="/Template/payer/saoma/css/2R3cKfrKqS.png"></div>
<span id="ordertrano" order-trano="{$payinfo.trano}" style="display:none;"></span>
<span id="orderid" order-id="{$payinfo.id}" style="display:none;"></span>
</body>
</html>