<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>支付详情</title>
    <link href="__MZFCSS__/wechat_pay.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">
    <style>
        .text-success {
            color: #468847;
            font-size: 2.33333333em;
        }

        .text-fail {
            color: #ff0c13;
            font-size: 2.33333333em;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .error {

            display: block;
            padding: 9.5px;
            margin: 0 0 10px;
            font-size: 13px;
            line-height: 1.42857143;
            color: #333;
            word-break: break-all;
            word-wrap: break-word;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;

        }
    </style>
</head>

<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico_log ico-<?php echo (int)$type ?>"></span>
    </h1>

    <div class="mod-ct">
        <div class="order">
        </div>
        <div class="amount" id="money">￥<?php echo $money; ?></div>
        <h1 class="text-center text-<?php echo($result != '支付成功' ? 'fail' : 'success'); ?>"><strong><i
                        class="fa fa-check fa-lg"></i> <?php echo $result; ?></strong></h1>

        <div class="detail detail-open" id="orderDetail" style="display: block;">
            <dl class="detail-ct" id="desc">
                <dt>金额</dt>
                <dd><?php echo $money ?></dd>
                <dt>商户订单：</dt>
                <dd><?php echo htmlentities($codepay_json) ?></dd>
                <dt>流水号：</dt>
                <dd><?php echo htmlentities($pay_no) ?></dd>
                <dt>付款时间：</dt>
                <dd><?php echo date("Y-m-d H:i:s", (int)$pay_time) ?></dd>
                <dt>状态</dt>
                <dd><?php echo $result; ?></dd>
            </dl>


        </div>

        <div class="tip-text">
        </div>


    </div>
    <div class="foot">
        <div class="inner">
            <p>如未到账请联系我们</p>
        </div>
    </div>

</div>
<div class="copyRight">
    <p>支付合作：<a href="http://codepay.fateqq.com/" target="_blank">码支付</a></p>
</div>
<script>
    setTimeout(function () {
        //这里可以写一些后续的业务
        <?php if($go_url){
        ?>

        window.location.href = '<?php echo $go_url?>'; //跳转

        <?php
        }?>

    }, <?php echo((int)3 * 1000)?>);//默认3秒后跳转
</script>
</body>
</html>