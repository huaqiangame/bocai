<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>创世彩票</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="__CSS__/pc.css">
    <script type="text/javascript" src="__JS__/jqueryysf.js"></script>
    <script type="text/javascript" src="__JS__/layer.js"></script>
    <link rel="stylesheet" href="__JS__/skin/layer.css" id="layui_layer_skinlayercss" style="">
    <script>
        var zuida = 20000, zuidi = 100, cur_user = "zh"
//            , getBankViewUrl = "/index.php/Index/getBankgroupView.html";
    </script>
</head>
<body>
<noscript>
    &lt;h1 style="font-size: 50px;color: red;"&gt;
    访问本网站请开启Javascript
    &lt;/h1&gt;
</noscript>
<!--[if lt IE 7]>
<h1 style="font-size: 50px;color: red;">
    浏览器版本过低，请使用高版本的浏览器带来更好的体验
</h1>
<![endif]-->
<form method="post" id="pay" action="{:U('Account/ysfRecharge')}">
    <input type="hidden" name="other" id="other">
    <input type="hidden" name="bank_code" id="bank_code">

    <div class="header">
        <div class="logo">
            <img src="__IMG__/logo.png" align=""></div>
        <div class="online-service">
            <a href="" target="_blank">
                <img src="__CSS__/yunshanfu/header_04.png" align=""></a>
        </div>
    </div>
    <div class="content">
        <p><span style="font-size: 18px;">&nbsp;<span style="background-color: rgb(251, 213, 181); font-size: 20px;">支持：【手机端、电脑端】【银联云闪付】</span>
        </p>

        <p><span style="font-size: 24px;">&nbsp;&nbsp;</span><br></p>
        <p><span style="font-size: 16px;">支付流程：输入并确认正确的会员账号→输入存款额度→点击确认支付→付款成功后<span style="color: rgb(255, 0, 0);">1~10秒</span>自动到账；</span>
        </p>

        <p><span style="font-size: 16px;">推荐使用：【银联云闪付】<span style="text-align: center;">支持</span><span
                    style="text-align: center;">1元~5000元，</span>扫码支付成功率100%，大额无忧！</span></p>
        <table class="content-table">
            <tbody>
            <tr>
                <td class="title">会员账号：</td>
                <td class="inputtd">
                    <input placeholder="请填写创世彩票游戏账户（*）" name="username" value="" id="username" type="text"
                           class="table-input" onpaste="return false"
                           onkeyup="value=value.replace(/[^A-Z\a-\z0-9\_]/g,&#39;&#39;)"></td>
                <td align="center" style="color: #e60012;">*必填</td>
            </tr>
            <tr>
                <td class="title">确认账号：</td>
                <td>
                    <input placeholder="请认真填写创世彩票游戏账户，否则无法正常充值（*）" name="rusername" value="" id="rusername" type="text"
                           class="table-input" onpaste="return false"
                           onkeyup="value=value.replace(/[^A-Z\a-\z0-9\_]/g,&#39;&#39;)"></td>
                <td align="center" style="color: #e60012;">*必填</td>
            </tr>
            <tr>
                <td class="title">支付类型：</td>

                <td id="getNewBackgroup" style="padding: 0px 15px;">      <!-- 微信开始 -->
                    <!-- 微信结束 -->

                    <!-- 支付宝开始 -->
                    <!-- 支付宝结束 -->

                    <!-- QQ钱包开始 -->
                    <!-- QQ钱包结束 -->

                    <!-- 百度钱包 -->
                    <!-- 百度钱包结束 -->

                    <!-- 京东钱包开始 -->
                    <!-- 京东钱包结束 -->


                    <!-- 银联钱包开始 -->
                    <!-- 银联钱包结束 -->


                    <!-- 云闪付开始 -->
                    <label class="pay-label">
                        <input type="radio" name="bid" xiane="100-20000" id="bankco" btype="ysf" class="regular-radio"
                               ctrname="Gerenysf" value="yzf">
                        <label></label>
                        <img src="__CSS__/yunshanfu/ysf.png" alt=""
                             style="height: 40px; width: auto; display: inline-block; position: relative;">
                        <span
                            style="font-size: 20px; height: 36px; display: inline-block; position: relative;">云闪付</span><span
                            class="xianetips">(100-20000)</span>
                    </label>      <!-- 云闪付结束 -->


                    <!-- 网银开始 -->
                    <!-- 网银结束 -->


                    <!-- 快捷开始 -->
                    <!-- 快捷结束 -->

                    <style>
                        #getNewBackgroup {
                            zoom: 0.9;
                            *zoom: 0.9;
                        }
                    </style>

                </td>
                <td align="center" style="color: #e60012;">*必选</td>
            </tr>
            <tr id="zhifubaozhanghao" style="display: none;">
                <td class="title">支付宝昵称：</td>
                <td>
                    <!-- <input placeholder="请认真填写支付宝昵称，否则财务无法第一时间入款" value='' type="text" class="table-input oclass" onpaste="return false"></td> <td align="center" style="color: #e60012;">*必填</td></tr> -->
                </td>
            </tr>
            <tr id="weixinzhanghao" style="display: none;">
                <td class="title">微信昵称：</td>
                <td>
                    <input placeholder="请认真填写微信昵称，否则财务无法第一时间入款" value="" type="text" class="table-input oclass"
                           onpaste="return false"></td>
                <td align="center" style="color: #e60012;">*必填</td>
            </tr>
            <tr>
            </tr>
            <tr id="qqzhanghao" style="display: none;">
                <td class="title">QQ帐号：</td>
                <td>
                    <input placeholder="请认真填写QQ帐号，否则财务无法第一时间入款" value="" type="text" class="table-input oclass"
                           onpaste="return false"></td>
                <td align="center" style="color: #e60012;">*必填</td>
            </tr>
            <tr>
                <td class="title">确认额度：</td>
                <td>
                    <input placeholder="最低存款100元，最高单笔20000元" name="order_amount" type="text" class="table-input"
                           id="coin" onkeyup="value=this.value.replace(/[^\d]+/g,&#39;&#39;)">

                    <p>
                        <font color="red">温馨提醒:</font>入款时请不要充值整数，例如：501、699等不为整数的金额可提高充值成功率！</p></td>
                <td align="center" style="color: #e60012;">*必填</td>
            </tr>
            <tr>
            </tr>
            <tr>
                <td class="title">快捷额度：</td>
                <td>
                    <a class="kuaijie" href="https://ck2894.com/" val="10">10元</a><a class="kuaijie"
                                                                                     href="https://ck2894.com/"
                                                                                     val="20">20元</a><a class="kuaijie"
                                                                                                        href="https://ck2894.com/"
                                                                                                        val="30">30元</a><a
                        class="kuaijie" href="https://ck2894.com/" val="50">50元</a><a class="kuaijie"
                                                                                      href="https://ck2894.com/"
                                                                                      val="100">100元</a><a
                        class="kuaijie" href="https://ck2894.com/" val="200">200元</a><a class="kuaijie"
                                                                                        href="https://ck2894.com/"
                                                                                        val="300">300元</a><a
                        class="kuaijie" href="https://ck2894.com/" val="500">500元</a><a class="kuaijie"
                                                                                        href="https://ck2894.com/"
                                                                                        val="1000">1000元</a><a
                        class="kuaijie" href="https://ck2894.com/" val="1200">1200元</a><a class="kuaijie"
                                                                                          href="https://ck2894.com/"
                                                                                          val="1500">1500元</a><a
                        class="kuaijie" href="https://ck2894.com/" val="2000">2000元</a><a class="kuaijie"
                                                                                          href="https://ck2894.com/"
                                                                                          val="2500">2500元</a><a
                        class="kuaijie" href="https://ck2894.com/" val="3000">3000元</a></td>
                <td align="center" style="color: #e60012;"></td>
            </tr>
            <tr>
                <td class="title">存款时间：</td>
                <td>
                    <input name="P_Time" id="P_Time" type="text" value="{$data.time|default=time()|date='Y-m-d H:i',###}" class="table-input"
                           disabled=""></td>
                <td align="center">无需填写</td>
            </tr>
            </tbody>
        </table>
        <div class="form-btn">
            <a href="#" id="querenzhifu" style="background-color: #c59503;">确认支付</a>
            <a href="" target="_blank">联系客服</a>
            <a href="#" target="_blank">进入游戏</a></div>
        <div style="height: 1px;clear: both;"></div>
        <p class="tips"><span style="color:#f00;">温馨提示：</span>为了避免掉单情况的发生，请您在支付完成后，需等"支付成功"页面跳转出来, 再关闭页面，以免掉单！感谢配合！！！
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br>支付成功后，若3分钟内未能及时到达您的会员账号请联系<a href="javascript:void(0);"
                                                                                      style="color:#f00">【在线客服】</a>咨询；
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br>祝您游戏愉快，盈利多多！O(∩_∩)O　　</p></div>
    <div class="copyright">COPYRIGHT @ 创世彩票 RESERVED</div>
</form>


<script type="text/javascript">
    var old_zuidi = zuidi, old_zuida = zuida;

    $("input:radio").live('change', function () {

        var xiane = $(this).attr('xiane');

        var array_xiane = xiane.split('-');

        if (xiane != '' && array_xiane != undefined) {
            zuidi = array_xiane[0];
            zuida = array_xiane[1];
        } else {
            zuidi = old_zuidi;
            zuida = old_zuida;
        }

        zuidi = parseFloat(zuidi);
        zuida = parseFloat(zuida);

        $('#coin').attr('placeholder', '最低存款' + zuidi + '元，最高单笔' + zuida + '元');
    });

</script>

<script type="text/javascript" src="__JS__/app.js"></script>

<div id="tong" style="display:none;">
    <p style="line-height: 2em;"><span style="background-color: rgb(255, 255, 0); font-size: 20px;">推荐使用：<span
                style="background-color: rgb(255, 255, 0); color: rgb(255, 0, 0);">【银联云闪付扫码】【银联快捷支付</span></span><span
            style="font-size: 20px; line-height: 2em; color: rgb(255, 0, 0); background-color: rgb(255, 255, 0);">】</span><span
            style="font-size: 20px; line-height: 2em; background-color: rgb(255, 255, 0);">支付成功率100%，存款秒到账，当您限额或者无法支付时，请点击</span><span
            style="font-size: 20px; line-height: 2em; color: rgb(255, 0, 0); background-color: rgb(255, 255, 0);">【线上存款】-【银行汇款】</span><span
            style="font-size: 20px; line-height: 2em; background-color: rgb(255, 255, 0);">转账至指定银行卡！</span></p></div>
<script src="__CSS__/yunshanfu/layer.min.js"></script>
<script type="text/javascript">
    $(function () {
        layer.open({
            title: false,
            closeBtn: 0, //不显示关闭按钮
            btnAlign: 'c',
            btn: ["知道了"],
            shadeClose: false, //开启遮罩关闭
            area: '600px',
            content: $('#tong').html()
        });
    });
</script>


</body>
</html>