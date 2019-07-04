<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中国快3资讯网</title>
<meta name="keywords" content="中国快3资讯网"/>
<meta name="description" content="中国快3资讯网"/>
<meta name="renderer" content="webkit" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/reset.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/layout.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/font-awesome.min.css" />
<script>
var WebConfigs = {
	webtitle:"{$webconfigs.webtitle}",
	kefuthree:"{$webconfigs.kefuthree}",
	kefuqq:"{$webconfigs.kefuqq}",
    ROOT : "__ROOT__",
};
</script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/index.js"></script>
<!--[if lt IE 9]>
<script src="__ROOT__/resources/js/html5shiv.js"></script>
<![endif]-->

</head>

<body>
<!--header start-->
<section id="header">
	<div id="J_m_nav">
    	<div class="container">
            <div class="l top-m-n">
                <a class="pxxz c-red" href="javascript:;" onclick="isWinOrMacDown()">电脑端下载</a>
                <a class="sjxz c-red" href="javascript:;" target="_blank">
                手机端下载

                </a>
                <a class="lxkf" onclick="lianxikefu();" href="javascript:;">联系客服</a>
            </div>
            <div class="r top-loin">
            	<div class="login-no">
                尊敬的玩家您好！欢迎来到彩票平台，请先<a class="c-green" href="{:U('Public/login')}">登录</a>，或用<a class="c-green sjxz" href="__ROOT__/">手机登录</a>&nbsp;&nbsp;[&nbsp;<a class="c-red" href="{:U('Public/register')}">免费注册</a>&nbsp;]
                </div>
                <div class="login-yes" style="display:none">
                	<div class="wel l">欢迎您,<span way-data="user.username">---</span></div>
                	<div class="zhang l">
                    	<div class="zh">我的账户<i class="yue-refresh"></i></div>
                        <div class="htlj">
                            <ul><li><a href="__ROOT__/Member.ucenter.do">会员中心</a></li><li><a href="__ROOT__/Member.finance.do">资金管理</a></li><li><a href="__ROOT__/Member.orderform.do">个人报表</a></li><li><a href="javascript:;" onclick="openMenuUrl('__ROOT__/Member.agent', true);">代理中心</a></li><li class="tc"><a href="{:U('Public/LoginOut')}">退出</a></li></ul>
                        </div>
                    </div>
                	<!--<div class="msn l">
                        <span class="sz" onclick="openMenuUrl('/Member.message.do',true);">
                            <i class="icon fa fa-envelope-o" style="font-size:1.5em"></i>
                            <i class="count"><way way-data="messageCount">0</way></i>
                        </span>
                    </div>-->
                	<div class="yue l">余额：<span class="c-green" way-data="user.balance">0</span>&nbsp;<i class="yue-refresh" onClick="checkislogin();"></i></div>
                	<div class="xima l">洗码：<span class="c-green" way-data="user.xima">0</span></div>
                	<div class="chongti l"><a href="__ROOT__/Member.finance.do?financeCode=cunk">充值</a><a href="/Member.finance.do?financeCode=quk">提款</a></div>
                </div>
            </div>
        </div>
    </div>

    <div id="top_nav">
    	<div class="banner-img"><a href="/"></a></div>
    </div>

    <div id="top_menu" class="box-shadow">
    	<div class="container">
        	<div class="bann_dowm">
            <span>全部彩票类型</span>
            <ul id="lottery_menu_list" style="height:393px; overflow:hidden;display: block">
            </ul>
        </div>
            <ul class="bann_list">
            	<li><a href="__ROOT__/">首页</a></li>
            	<li><a href="{:U('News/lists',['catid'=>30,'showid'=>3])}">公司简介</a></li>
            	<li><a href="{:U('News/lists',['catid'=>30,'showid'=>4])}">游戏规则</a></li>
            	<li><a href="{:U('News/lists',['catid'=>30,'showid'=>5])}">代理合作</a></li>
            	<li><a href="{:U('Game/trend')}">历史走势</a></li>
            	<li><a href="{:U('News/lists',['catid'=>29])}">帮助中心</a></li>
            	<li><a href="{:U('News/lists',['catid'=>41])}">平台活动</a></li>
            </ul>
        </div>
    </div>
</section>
<!--header end-->

<section id="wrap" class="container wapper">
	<section class="wapp_top">
    	<div class="all_sort l"></div>
        <div class="wapp_top_midle l">
            <div id="kinMaxShow">
			<script type="text/javascript" src="__ROOT__/resources/js/jquery.kinMaxShow-1.1.min.js"></script>
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
                    };
                    $(".bann_list li").mouseover(function () {
                        $(this).children("dl").show();
                    });
                    $(".bann_list li").mouseleave(function () {
                        $(this).children("dl").hide();
                    });
                });
            </script>
                <div><a href="javascript:void(0)"><img src="__ROOT__/resources/images/banner/1.jpg" bgcolor="#f58500" height="225px" /></a></div><div><a href="javascript:void(0)"><img src="__ROOT__/resources/images/banner/2.jpg" bgcolor="#f58500" height="225px" /></a></div><div><a href="javascript:void(0)"><img src="__ROOT__/resources/images/banner/3.jpg" bgcolor="#f58500" height="225px" /></a></div>
            </div>

            <div class="down b1 ">
                        <div class="list_tag bbt"></div>
                        <div class="tag_det"></div>



                    </div>
        </div>

        <div class="wapp_r r b1">

                    <div class="please_login bbt login-no">
                        <p>HI,欢迎来到福彩快三线上平台</p>
                        <p>&nbsp;&nbsp;</p>
                        <p><a class="bg_red" href="{:U('Public/login')}">登  录</a><a class="bg_org register_btn haveurl" href="{:U('Public/register')}">免费注册</a></p>
                    </div>
                    <div class="please_login bbt login-yes" style="display:none;">
                        <p>HI,<span way-data="user.username">欢迎您！</span></p>
                        <p>级别：<span way-data="user.groupname">普通会员</span></p>
                        <p>积分：<span class="c-green" way-data="user.point">0.00</span></p>
                        <p>洗码：<span class="c-green" way-data="user.xima">0.00</span></p>
                        <p>余额：<span class="c-green" way-data="user.balance">0.00</span></p>
                        <p><a href="__ROOT__/Member.finance.do?financeCode=cunk" class="bg_red">充  值</a><a href="__ROOT__/Member.finance.do?financeCode=quk" class="bg_org">提  现</a></p>
                    </div>

                    <div class="notice">
                        <div class="tt bbt"><i class="curr">彩票公告</i></div>
                        <div class="notice_set">
				{php}
                $gglist = C('gglist');
                {/php}
                {volist name="gglist" id="ggitem"}<a href="javascript:void(0);" onClick="ggcontent('{$ggitem.id}')">{$ggitem.title}</a>{/volist}
                        </div>
                    </div>
                </div>
    </section>

    <section>
    	<div class="allcptitle mt-20"><span class="tit">所有彩种</span></div>
        <div class="allcplist">
        	<ul class="cpitem"></ul>
        </div>
    </section>

</section>

{include file="Public/footer" /}



</body>
</html>