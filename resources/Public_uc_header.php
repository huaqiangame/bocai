<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{:GetVar('webtitle')}</title>
    <meta name="keywords" content="{:GetVar('keywords')}" />
    <meta name="description" content="{:GetVar('description')}" />
    <link rel="stylesheet" type="text/css" href="__CSS2__/jibenxinxi.css">
    <link rel="stylesheet" type="text/css" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/uc/standard.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/uc/style.css">
    <link rel="stylesheet" type="text/css" href="__CSS2__/userInfo.css">
    <script type="text/javascript" src="__JS__/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="__JS2__/bootstrap.min.js"></script>
    <script type="text/javascript" src="__JS2__/layer/layer.js"></script>
    <title>{:GetVar('webtitle')}</title>
	
</head>
<body >
<div id="banner" style="margin-top:5px;"></div>
<div class="container user_con"  style="width:1100px;height:800px;">
    <div id="layout-top-area">
        <div class="sider-area"><span>会员中心</span></div>
        <ul class="nav-area">
            <li <if condition="in_array($active,['center','safe','bank'])"> class="active"</if>><a href="{:U('Member/user_center')}" data-menu="member"><span>会员资料</span></a></li>
            <li <if condition="$active eq 'quota'">  class="active"</if> ><a href="{:U('Member/quota')}" data-menu="money"><span>额度管理</span></a></li>
            <li <if condition="$active eq 'betrecored'">  class="active"</if> ><a href="{:U('Member/betRecord')}" data-menu="draw"><span> 投注管理</span></a></li>
            <li <if condition="in_array($active,['dealRecord','todayLoss','recharge'])">  class="active"</if> ><a href="{:U('Account/dealRecord')}" data-menu="exchange"><span>资金流水</span></a></li>
            <li <if condition="$active eq 'gglist'">  class="active"</if> ><a href="{:U('Home/Member/gglist')}" data-menu="message"><span>消息管理</span></a></li>
            <li ><a href="{:U('Account/quickRecharge')}" data-menu="recharge"><span>线上存款</span></a></li>
            <li ><a href="{:U('Account/withdrawals')}" data-menu="bet"><span>线上取款</span></a></li>
        </ul>
    </div>

    <div id="layout-main-area">
        <if condition="in_array($active,['center','safe','bank'])">
        <div id="main-menu">
            <div class="menu-area">
                <ul class="list-group">
                    <li class="list-group-item system-message <?php if($active == 'center'){echo 'active';} ?>"><a href="{:U('Member/user_center')}">基本信息</a></li>
                    <li class="list-group-item system-message <?php if($active == 'safe'){echo 'active';} ?>"><a href="{:U('Member/safe')}">安全中心</a></li>
                    <li class="list-group-item system-message activity<?php if($active == 'bank'){echo 'active';} ?>"><a href="{:U('Member/bankcard')}">银行卡管理</a></li>
                </ul>
            </div>
        </div>
        <elseif condition="$active eq 'quota'" />
            <div id="main-menu">
                <div class="menu-area">
                    <ul class="list-group">
                        <li class="list-group-item system-message activity <?php if($active == 'quota'){echo 'active';} ?> "><a href="{:U('Member/quota')}">额度转让</a></li>
                    </ul>
                </div>
            </div>
        <elseif condition="$active eq 'betrecored'" />
            <div id="main-menu">
                <div class="menu-area">
                    <ul class="list-group">
                        <li class="list-group-item system-message activity <?php if($active == 'betrecored'){echo 'active';} ?> "><a href="{:U('Member/Betrecord')}">投注记录</a></li>
						
                    </ul>
                </div>
            </div>
        <elseif condition="in_array($active,['dealRecord','todayLoss','recharge'])" />
            <div id="main-menu">
                <div class="menu-area">
                    <ul class="list-group">
                        <li class="list-group-item system-message <?php if($active == 'dealRecord'){echo 'active';} ?> "><a href="{:U('Account/dealRecord')}">交易记录</a></li>
                        <li class="list-group-item system-message complaint <?php if($active == 'todayLoss'){echo 'active';} ?> "><a href="{:U('Account/todayLoss')}">盈亏报表</a></li>
                        <li class="list-group-item system-message complaint <?php if($active == 'recharge'){echo 'active';} ?> "><a href="{:U('Account/quickRecharge')}">充值</a></li>
                    </ul>
                </div>
            </div>
        <elseif condition="$active eq 'gglist'" />
        <div id="main-menu">
            <div class="menu-area">
                <ul class="list-group">
                    <li class="list-group-item system-message activity <?php if($active == 'gglist'){echo 'active';} ?> "><a href="{:U('Member/gglist')}">网站公告</a></li>
				<!--<li class="list-group-item system-message activity <?php if($active == 'message_list'){echo 'active';} ?> "><a href="{:U('Member/message_list')}">消息管理</a></li>-->
                </ul>
            </div>
        </div>
        </if>
        <div id="main-container">
            <div class="module-main" style="height: 630px; overflow: auto;margin-top:10px;">

