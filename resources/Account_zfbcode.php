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
   
    <link rel="stylesheet" type="text/css" href="__CSS__/artDialog.css" />
    <script>
        var ISLOGIN = "{$userinfo.id}";
    </script>
    <script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="__JS__/artDialog.js"></script>
    <script type="text/javascript" src="__JS__/index.js"></script>

</head>
<body>
<include file="Public/header" />
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<p style="margin-top: 50px;"></p>

<p class="text-center h4">请使用支付宝扫描下面的二维支付码</p>

<p class="text-center"><img src='__ROOT__{$payinfo[erweima]}' width="150"></p>

<p class="text-center h4">充值金额：<span style='color:red;font-weight: bold;'>{$payorder.amount}</span></p>
<p class="text-center h4">附言码:{$payorder.fuyanma}</p>
<p class="text-center" style="color:red;font-size: 20px;margin-top: 40px;font-weight: bold;">温馨提示:必须将“附言码”粘贴或正确输入支付宝“附言”栏中，否则充值将无法到账。</p>
<input type="button" value="完 成"  class="center-block btn btn-danger btn-lg active" style="width: 100px;margin-bottom: 65px;" onclick="window.location.href= '{:U(\"Account\/dealRecord2\")}'" >
<include file="Public/footer" />
</body>
</html>