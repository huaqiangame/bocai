<!DOCTYPE html>
<html>
<head><title>
        在线充值
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    <link rel="stylesheet" type="text/css" href="__MZFCSS__/userPay.css">

    <style>
        a:link {
            text-decoration: none;
        }

        　　 a:active {
            text-decoration: blink
        }

        　　 a:hover {
            text-decoration: underline;
        }

        　　 a:visited {
            text-decoration: none;
        }

        *, :after, :before {
            /* -webkit-box-sizing: border-box; */
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        button, html input[type=button], input[type=reset], input[type=submit] {
            -webkit-appearance: button;
            cursor: pointer;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="__MZFJS__/html5shiv.min.js"></script>
    <script src="__MZFJS__/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="loadingPicBlock" style="max-width: 720px;margin:0 auto;" class="pay">
    <header class="g-header">

        <div class="head-r">
            <a href="/" class="z-HReturn" data-dismiss="modal" aria-hidden="true"><s></s><b>首页</b></a>
        </div>
    </header>

    <div class="g-Total gray9">请选择需要充值的金额</div>
    <section class="clearfix g-member">
        <div class="g-Recharge">
            <ul id="ulOption">
                <!--注意修改金额 需要同时修改前面的值 money="10" -->
                <li money="10"><a href="javascript:;">10元<s></s></a></li>
                <li money="20"><a href="javascript:;">20元<s></s></a></li>
                <li money="50"><a href="javascript:;" class="z-sel">50元<s></s></a></li> <!--class="z-sel" 表示默认选中50元-->
                <li money="100"><a href="javascript:;">100元<s></s></a></li>
                <li money="200"><a href="javascript:;">200元<s></s></a></li>
                <li money="500"><a href="javascript:;">500元<s></s></a></li>
            </ul>
        </div>
        <form action="{:U('Account/codepay')}" method="post">
            <article class="clearfix mt10 m-round g-pay-ment g-bank-ct">
                <ul id="ulBankList">
                    <li class="gray6" style="width: 100%;padding: 5px 0px 0px 10px;height: 50px;">您选择充值：<label
                                class="input" style="border: 1px solid #EAEAEA;height: 35px;font-size:30px;">
                            <input type="text" name="price" id="price" placeholder="如：50" value="50"
                                   style="width: 170px;color: red;font-size:20px;">   <!--默认输入金额值50-->
                        </label> 元
                    </li>
                    <li class="gray6" ></li>
                    <li paytype="1" class="gray9" type="codePay" style="width: 33%">
                        <a href="javascript:;" class="z-initsel"><img src="__MZFIMG__/alipay.jpg"><s></s></a>

                    </li>
                    <li paytype="3" class="gray9" type="codePay" style="width: 33%">
                        <a href="javascript:;"><img src="__MZFIMG__/weixin.jpg"><s></s></a>

                    </li>
                    <li paytype="2" class="gray9" type="codePay" style="width: 33%">
                        <a href="javascript:;"><img src="__MZFIMG__/qqpay.jpg"><s></s></a>
                    </li>
                </ul>
            </article>
            <input type="hidden" id="pay_type" value="" name="type"> <!--值1表示支付宝默认-->
            <input type="hidden" name="user" id="user"  value="{$member_name}"
                   style="width: 180px;font-size: 16px;">
            <div class="mt10 f-Recharge-btn">

                <button id="btnSubmit" type="submit" href="javascript:;" class="orgBtn">确认支付</button>
            </div>
        </form>
    </section>

    <input id="hidIsHttps" type="hidden" value="0"/>
    <script src="__MZFJS__/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">

        $(function () {
            var c;
            var g = false;
            var a = null;
            var e = function () {
                $("#ulOption > li").each(function () {
                    var n = $(this);
                    n.click(function () {
                        g = false;
                        c = n.attr("money");
                        n.children("a").addClass("z-sel");
                        n.siblings().children().removeClass("z-sel").removeClass("z-initsel");
                        var needMoney = parseFloat(n.attr("money")).toFixed(2);
                        if (needMoney <= 0) needMoney = 0.01;
                        $("#price").val(needMoney);
                    })
                });
                $("#ulBankList > li").each(function (m) {
                    var n = $(this);
                    n.click(function () {
                        if (m < 2) return;
                        $("#pay_type").val(n.attr("payType"));
                        n.children("a").addClass("z-initsel");
                        n.siblings().children().removeClass("z-initsel");
                    })
                });

            };
            e()
        });

    </script>


</div>
</body>
</html>

