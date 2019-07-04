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
        支付宝支付
    </h1>

</header>
<div class="bank_recharge">
    <br>
    <br>
    <p class="am-text-center h4">请使用支付宝扫描下面的二维支付码</p>
    <p class="am-text-center"><img src='__ROOT__{$payinfo[erweima]}' width="150"></p>
    <p class="am-text-center h4">充值金额：<span style='color:red;font-weight: bold;'>{$payorder.amount}</span></p>
    <p class="am-text-center h4">附言码:{$payorder.fuyanma}</p>
    <p class="am-text-center" style="color:red;font-size: 20px;margin-top: 40px;font-weight: bold;">温馨提示:必须将“附言码”粘贴或正确输入支付宝“附言”栏中，否则充值将无法到账。</p>
   <p class="am-text-center"> <input type="button" value="完 成"  class="am-center-block am-btn am-btn-danger am-btn-lg am-active" style="width: 10em;margin:65px auto; margin-bottom: 65px;" onclick="window.location.href= '{:U(\"User\/index\")}'" ></p>

</div>
<include file="Public/footer" />
</body>
</html>