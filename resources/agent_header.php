<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{:GetVar('webtitle')}</title>
    <meta name="keywords" content="{:GetVar('keywords')}" />
    <meta name="description" content="{:GetVar('description')}" />

    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS2__/reset.css">
    <link rel="stylesheet" href="__CSS2__/icon.css">
    <link rel="stylesheet" href="__CSS2__/header.css">
    <link rel="stylesheet" href="__CSS2__/main.css">
    <link rel="stylesheet" href="__CSS2__/footer.css">
    
    <link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/common.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/style.css" />
    <link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />
    <script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
    <script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
    <script>
        var ISLOGIN = "{$userinfo.id}";
    </script>
</head>
<body style="background: linear-gradient( #f3fff4, #fff) no-repeat;">
<!--top-->
<!--top-->
<header class="header">
    <div class="container claerfix">
        <div class="pull-left">
            Hi，欢迎来到幸运彩！
        </div>
        <notempty name="userinfo.username">

            <div class="pull-right user_login_info">
                <ul>
                    <li class="user_login_info1">
                        <a  href="{:U('Member/index')}" class="user_header" data-html="true" class="user_header" data-container="body" data-toggle="popover" data-placement="bottom"data-content='<div class="ceng"><div class="media"><div class="media-left"><a href="{:U('Member/index')}"><img src="__ROOT__{$userinfo.face}" alt="" class="media-boject img-circle"></a><p>{$userinfo.username}</p></div><div class="media-body" style="padding-bottom:10px;">
                <p class="margin_0">性别：<span><eq name="userinfo['sex']" value="1">男</eq><eq name="userinfo['sex']" value="2">女</eq><eq name="userinfo['sex']" value="0">保密</eq></span></p>
                <p class="margin_0">账号：<span>{$userinfo.username}</span></p>
                <p class="margin_0">等级：<span>{$userinfo.groupname}</span></p>
                <p class="margin_0">头衔：<span>{$userinfo.touhan}</span></p>
                <p class="margin_0">累积中奖：<span>{$Think.session.okamountcount}</span></p>
            </div>
            <div class="media-footer">
                <volist name="Think.session.k3names" id="value">
                    <a href="{:U('Lottery/k3',array('name'=>$value['cptype']))}" title="{$value.cpname}" class="color_res" style="font-size:5px;"><span style="color:#333;display: block;margin-top:4px;">{$value.cpname|substr=0,6}</span><i class="iconfont">&#xe607;</i></a>
                </volist>
            </div></div></div>'>
    <img class="img-circle"  src="__ROOT__{$userinfo.face}" alt="">
    {$userinfo['username']}
    </a>
    </li>
    <li class="user_login_info2">
        <a href="{:U('Member/index')}" class="my_account">
            我的账户
            <i class="iconfont">&#xe6a1;</i>
        </a>
        <div class="user_login_info2_list" style="display:none;">
            <i class="user_login_info2_i"></i>
            <if condition="$userinfo.groupid eq '10' or $userinfo.groupid eq '11'">
                <a href="{:U('Member/agent')}">代理中心</a>
            </if>
            <a href="{:U('Member/betRecord')}">投注记录</a>
            <a href="{:U('Account/dealRecord')}">交易记录</a>
            <a href="{:U('Member/ziliao')}">个人信息</a>
            <a href="{:U('Member/index')}">安全中心</a>
        </div>
    </li>
    <li class="user_login_info3">
        余额：
						<span class="show_money">
							<em class="smallmoney" style="color:#F70B0F;">{$userinfo['money']}</em>
							<i class="iconfont refresh_money">&#xe602;</i>
							<em class="hide_money_btn">隐藏</em>
						</span>
						<span class="hide_money" style="display:none;">
							已隐藏
							<em class="show_money_btn">显示</em>
						</span>
    </li>
    <li class="user_login_info4">
        <a href="{:U('Account/recharge')}">充值</a>
    </li>
    <li class="user_login_info5">
        <a href="{:U('Account/withdrawals')}">提现</a>
    </li>
    <li class="user_login_info6">
        <a href="{:U('Public/LoginOut')}">退出</a>
    </li>
    </ul>
    </div>
    <else/>
    <div class="pull-right user_login_info">
        <a style="margin:0;" href="{:U('public/login')}">亲，请登录</a>
        <em style="margin:0 3px;color:#ccc;">|</em> <!--<a href="{:U('Apublic/reg')}">代理注册</a><em style="margin:0 3px;color:#ccc;">|</em>-->
        <a href="{:U('Agent/index')}">代理中心</a>
    </div>
    </notempty>
    </div>
</header>
<script>
</script>
<!--top-->
<!--banner-->
<nav class="home_nav">
    <div class="nav_logo">
        <div class="container claerfix">
            <a href="" class="pull-left" style="margin-top:0;">
                <h1 class="nav_logo_h1">幸运彩</h1>
            </a>
        </div>
    </div>
</nav>
<!--baner-->
<div class="banner">
    <div class="w1000">
        <!--hover效果加bann_hover-->
        <include file="Agent/menu" />
    </div>
</div>
<script type="text/javascript">
    $(function () {
        if ($("#kinMaxShow").size() > 0) {
            $("#kinMaxShow").kinMaxShow({
                height: 225,
                intervalTime: 2,
                button: {
                    showIndex: false,
                    normal: { marginRight: '8px', border: '0', right: '50%', bottom: '10px', borderRadius: '7px', background: '#fff' },
                    focus: { background: '#bd0d0d', border: '0' }
                }
            });
        }
        $(".bann_list li").mouseover(function () {
            $(this).children("dl").show();
        })
        $(".bann_list li").mouseleave(function () {
            $(this).children("dl").hide();
        })
    });
</script>

<!--navlist-->
<!--wapper-->
<!--最高奖金-->
<!--是否具有投注权限,true是可以进行投注-->
<input id="EachMaxLotteryValue" type="hidden" value="500000.00" />
<input id="MemberBettingAuthority" type="hidden" value="False" />
<input id="_jsurl" type="hidden" value="/templates/SSC" />   <!-- js目录 -->
 
<script>
    $(function () {
        $('.refresh_money').click(function () {
            $.ajax({
                url:"{:U('Member/refresh_money')}",
                type:'POST',
                success :function (data) {
                    $('.smallmoney').html(data);
                }
            })
        })

    })
</script>