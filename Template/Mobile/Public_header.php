<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{:GetVar('webtitle')}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="screen-orientation" content="portrait">
    <meta name="x5-orientation" content="portrait">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="__CSS__/amazeui.min.css">
    <link rel="stylesheet" href="__CSS__/common2.css">
    <link rel="stylesheet" href="__CSS__/index.css?t=<?php echo time();?>">
    <link rel="stylesheet" href="__CSS__/icon.css">
	<link rel="stylesheet" href="__CSS__/artDialog.css">
	<link rel="stylesheet" href="__CSS__/appside.css">
    <script>
        var Webconfigs = {
            "ROOT" : "__ROOT__"
        }
    </script>
<script type="text/javascript" src="__JS__/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/resources/js/artDialog.js"></script>
<script type="text/javascript" src="/resources/js/way.min.js"></script>
<script type="text/javascript" src="/resources/main/common.js"></script>
 <script src="__JS__/js2/iconfont.js"></script>
<script type="text/javascript" src="__JS__/require.js" data-main="__JS__/main"></script>
             <div class="AppHeader">
                <div class="AppHeader-inner">
                  	<a href="javascript:history.back(-1);" class="" style="color:#fff">
				<i class="iconfont icon-arrow-left"></i>
			       </a>
                        <div class="AppHeader-actions">
							  
							<span class="my-icon">
                                <svg class="icon" aria-hidden="true">
                                   <use xlink:href="#icon-weidenglutouxiang"></use>
                                </svg>
                            </span>	                   
                        </div>
                </div>
            </div>
</head>			
<div class="AppMask" style="display: none;"></div>
<div class="AppSidebar">
    <div class="AppSidebar-top">
        <div class="usericon">
            <img src="__ROOT__{$userinfo['face']}" class="am-radius" alt="">
        </div>
        <div class="userinfo">
            <div class="username">
                <span class="name">{$userinfo.username}</span>
                <span class="close-icon">
                    <i class="am-icon-close"></i>
                </span>
            </div>
         <div class="money" id="ye" style="color:#fff;">余额：
                <span class="balance smallmoney">{$userinfo.balance}</span>
                <span class="refresh-icon">
                    <svg class="icon refresh_money" aria-hidden="true">
                        <use xlink:href="#icon-shuaxin"></use>
                    </svg>
                </span>
            </div>
        </div>
    </div>
    <div class="AppSidebar-quickbtn">
        <a class="AppHeader-green" href="{:U('Account/rechargeList')}">充值</a>
        <a class="AppHeader-yellow" href="{:U('Account/withdrawals')}">取款</a>
        <a class="AppHeader-white" href="{:U('Member/quota')}">额度转换</a>
    </div>
    <div class="AppSidebar-userlink">
        <a href="{:U('Member/personalInfo')}">个人资料</a>
        <a href="{:U('Member/index')}">安全中心</a>
        <a href="{:U('Member/orderform')}">投注记录</a>
        <a href="{:U('Member/orderform')}">交易记录</a>
        <a href="{:U('Account/todayloss')}">今日盈亏</a>
       
    </div>
    <div class="AppSidebar-nav">
        <div class="navgroup">
              <a href="{:U('Activity/fszhongxin')}">
                <span class="icons msg-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-zizhufanshui"></use>
                    </svg>
                </span>
                <span class="txt" style="font-size:15px; color:yellow;"><b>自助反水</b></span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
			  <a href="{:U('Member/agent')}">
                <span class="icons msg-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-zizhufanshui"></use>
                    </svg>
                </span>
                <span class="txt" style="font-size:15px; color:yellow;"><b>代理中心</b></span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
        </div>
        <div class="navgroup">
            <a href="{:U('Member/gglist')}">
                <span class="icons msg-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-gonggao"></use>
                    </svg>
                </span>
                <span class="txt">最新消息</span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
            <a href="{:U('Activity/activityList')}">
                <span class="icons activity-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-liwu"></use>
                    </svg>
                </span>
                <span class="txt">优惠活动</span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
        </div>
        <div class="navgroup">

            <a href="{:GetVar('mobile_kefuthree')}" target="_blank">
                <span class="icons service-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-zaixiankefu"></use>
                    </svg>
                </span>
                <span class="txt">在线客服</span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
        </div>
        <div class="navgroup">
                  
           <a href="{:U('index/index')}" target="_blank">
                <span class="icons pc-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-diannaoban"></use>
                    </svg>
                </span>
                <span class="txt">返回首页</span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
        </div>
        <div class="navgroup">
            <a href="{:U('Public/LoginOut')}">
                <span class="icons loginout-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-tuichu"></use>
                    </svg>
                </span>
                <span class="txt">退出登录</span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
        </div>
    </div>
	</div>				
    <script type="text/javascript">
        (function($) {
            $(".user-menu").click(function () {
                $(".AppSidebar").css("right", "0");
                $(".AppMask").fadeIn(300);
            });
            $(".AppMask,.close-icon").click(function () {
                $(".AppSidebar").css("right", "-240px");
                $(".AppMask").fadeOut(300);
            });

        })(jQuery);
    </script>

    
      <script type="text/javascript">
    	$(".my-icon").click(function(){
    		$(".AppSidebar").css("right","0");
    		$(".AppMask").fadeIn(300);
        });
        $(".huiyuan").click(function () {
            $(".AppSidebar").css("right", "0");
            $(".AppMask").fadeIn(300);
        });
    	$(".AppMask,.close-icon").click(function(){
    		$(".AppSidebar").css("right","-240px");
    		$(".AppMask").fadeOut(300);
        });
	    $('.refresh_money').click(function () {
        $.ajax({
            url:"{:U('Account/refreshmoney')}",
            type:'POST',
            success :function (data) {
                $('.smallmoney').html(data);
            }
        })
    })
    </script>


