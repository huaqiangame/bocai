<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
    <div class="am-header-left am-header-nav">
        <a href="javascript:history.back(-1);" class="">
            <i class="iconfont icon-arrow-left"></i>
        </a>
    </div>
    <h1 class="am-header-title userHome_h1">
        绑定密保手机
    </h1>
</header>

<div class="bank_recharge">
    <form action="{:U('Member/safephone')}" class="update_form" method="post">
        <ul class="bank_form_list">
            <li class="am-cf">
                <span class="bank_form_left am-fl">手机号</span>
                <div class="am-fr bank_right_input">
                    <input type="text" class="input_txt" name="tel" value="{$userinfo.tel}"  placeholder="请输入您要绑定的手机号码">
                </div>
            </li>
<!--             <li class="am-cf" style="position:relative;">
    <span class="bank_form_left am-fl">验证码</span>
    <div class="am-fr bank_right_input">
        <input type="text" class="input_txt" placeholder="请输入验证码">
    </div>
    <span style="position:absolute;right:0.1rem;font-size:0.18rem;top:0.08rem;">发送验证码</span>
</li> -->
        </ul>
        <button class="am-btn am-btn-danger am-radius am-btn-block" type="submit">确定</button>
    </form>
</div>
<include file="Public/footer" />
</body>
</body>
</html>