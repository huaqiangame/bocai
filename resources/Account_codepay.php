<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $codepay_config['chart'] ?>">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{$typeName}扫码支付 - 码支付</title>
    <link href="__MZFCSS__/wechat_pay.css" rel="stylesheet" media="screen">

</head>

<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico_log ico-{$type}"></span>
    </h1>

    <div class="mod-ct">
        <div class="order">
        </div>
        <div class="amount" id="money">￥{$price}</div>
        <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
            <div data-role="qrPayImg" class="qrcode-img-area">
                <div class="ui-loading qrcode-loading" data-role="qrPayImgLoading" style="display: none;">加载中</div>
                <div style="position: relative;display: inline-block;">
                    <img id='show_qrcode' alt="加载中..." src="{$qr}" width="210" height="210" style="display: block;">
                    <img onclick="$('#use').hide()" id="use"
                         src="__MZFIMG__/use_{$type}.png"
                         style="position: absolute;top: 50%;left: 50%;width:32px;height:32px;margin-left: -21px;margin-top: -21px">
                </div>
            </div>


        </div>
        <!-- 这里可以输入你想要的提示!-->
        <div class="time-item" id="msg">
            <h1>二维码过期时间</h1>
            <strong id="hour_show">0时</strong>
            <strong id="minute_show">0分</strong>
            <strong id="second_show">0秒</strong>
        </div>

        <div class="tip">
            <div class="ico-scan"></div>
            <div class="tip-text">
                <p>请使用{$typeName}扫一扫</p>
                <p>扫描二维码完成支付</p>
            </div>
        </div>

        <div class="detail" id="orderDetail">
            <dl class="detail-ct" id="desc" style="display: none;">

                <dt>状态</dt>
                <dd id="createTime">订单创建</dd>

            </dl>
            <a href="javascript:void(0)" class="arrow"><i class="ico-arrow"></i></a>
        </div>

        <div class="tip-text">
        </div>


    </div>
    <div class="foot">
        <div class="inner">
            <p>手机用户可保存上方二维码到手机中</p>
            <p>在{$typeName}扫一扫中选择“相册”即可</p>
        </div>
    </div>

</div>
<div class="copyRight">
    <p>支付合作：<a href="http://codepay.fateqq.com/" target="_blank">码支付</a></p>
</div>

<!--注意下面加载顺序 顺序错乱会影响业务-->
<script src="__MZFJS__/jquery-1.10.2.min.js"></script>
<!--[if lt IE 8]>
<script src="__MZFJS__/json3.min.js"></script><![endif]-->
<script>
    var user_data =<?php echo json_encode($user_data);?>
</script>
<script src="__MZFJS__/notify.js"></script>
<script src="__MZFJS__/codepay_util.js"></script>
{$codepay_html}
<script>
    setTimeout(function () {
        $('#use').hide() //2秒后隐藏中间那LOGO
    }, user_data.logoShowTime || 2000);
</script>
</body>
