<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{:GetVar('webtitle')}</title>
    <meta name="keywords" content="{:GetVar('keywords')}" />
    <meta name="description" content="{:GetVar('description')}" />
<meta name="renderer" content="webkit" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/reset.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/layout.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/font-awesome.min.css" />
<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
<!--[if lt IE 9]>
<script src="__ROOT__/resources/js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery.history.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>

</head>

<body>

{include file="Public/header" /}
    <!--wapper-->
    <div class="active1 active2">
        <div class="hight"></div>
        <div class="give_mo">
            <div class="move">
                <div class="open">
                    <!--今日最大充值金额-->
                     <!--今日最大充值金额-->
             <p class="title">新用户首次充值优惠活动</p>       
            <div class="youhuilist">
            <?php
			$newmemberrecharge1 = GetVar('newmemberrecharge1');
			$newmemberrechargeamount1 = GetVar('newmemberrechargeamount1');
			$newmemberrecharge2 = GetVar('newmemberrecharge2');
			$newmemberrechargeamount2 = GetVar('newmemberrechargeamount2');
			$newmemberrecharge3 = GetVar('newmemberrecharge3');
			$newmemberrechargeamount3 = GetVar('newmemberrechargeamount3');
			$newmemberrecharge4 = GetVar('newmemberrecharge4');
			$newmemberrechargeamount4 = GetVar('newmemberrechargeamount4');
			$newmemberrecharge5 = GetVar('newmemberrecharge5');
			$newmemberrechargeamount5 = GetVar('newmemberrechargeamount5');
			?>
            {if condition="$newmemberrecharge1 and $newmemberrechargeamount1"}
            <dl>
                <dt>
                <p>新用户首次充值{:substr($newmemberrecharge1,0,strpos($newmemberrecharge1,'~'))}元或以上领取活动{$newmemberrechargeamount1}元</p>
                </dt>
            </dl>
            {/if}
            {if condition="$newmemberrecharge2 and $newmemberrechargeamount2"}
            <dl>
                <dt>
                <p>新用户首次充值{:substr($newmemberrecharge2,0,strpos($newmemberrecharge2,'~'))}元或以上领取活动{$newmemberrechargeamount2}元</p>
                </dt>
            </dl>
            {/if}
            {if condition="$newmemberrecharge3 and $newmemberrechargeamount3"}
            <dl>
                <dt>
                <p>新用户首次充值{:substr($newmemberrecharge3,0,strpos($newmemberrecharge3,'~'))}元或以上领取活动{$newmemberrechargeamount3}元</p>
                </dt>
            </dl>
            {/if}
            {if condition="$newmemberrecharge4 and $newmemberrechargeamount4"}
            <dl>
                <dt>
                <p>新用户首次充值{:substr($newmemberrecharge4,0,strpos($newmemberrecharge4,'~'))}元或以上领取活动{$newmemberrechargeamount4}元</p>
                </dt>
            </dl>
            {/if}
            {if condition="$newmemberrecharge5 and $newmemberrechargeamount5"}
            <dl>
                <dt>
                <p>新用户首次充值{:substr($newmemberrecharge5,0,strpos($newmemberrecharge5,'~'))}元或以上领取活动{$newmemberrechargeamount5}元</p>
                </dt>
            </dl>
            {/if}
                    
            </div>
            <div class="warm2">
                <span>活动规则：</span>
                
                {if condition="$newmemberrecharge1 and $newmemberrechargeamount1"}
                <p>新用户首次充值{:substr($newmemberrecharge1,0,strpos($newmemberrecharge1,'~'))}元或以上领取活动{$newmemberrechargeamount1}元</p>
                {/if}
                
                {if condition="$newmemberrecharge2 and $newmemberrechargeamount2"}
                <p>新用户首次充值{:substr($newmemberrecharge2,0,strpos($newmemberrecharge2,'~'))}元或以上领取活动{$newmemberrechargeamount2}元</p>
                {/if}
                
                {if condition="$newmemberrecharge3 and $newmemberrechargeamount3"}
                <p>新用户首次充值{:substr($newmemberrecharge3,0,strpos($newmemberrecharge3,'~'))}元或以上领取活动{$newmemberrechargeamount3}元</p>
                {/if}
                
                {if condition="$newmemberrecharge4 and $newmemberrechargeamount4"}
                <p>新用户首次充值{:substr($newmemberrecharge4,0,strpos($newmemberrecharge4,'~'))}元或以上领取活动{$newmemberrechargeamount4}元</p>
                {/if}
                
                {if condition="$newmemberrecharge5 and $newmemberrechargeamount5"}
                <p>新用户首次充值{:substr($newmemberrecharge5,0,strpos($newmemberrecharge5,'~'))}元或以上领取活动{$newmemberrechargeamount5}元</p>
                {/if}
                <p>*以上活动针对新注册用户有效</p>
            </div>
                    
                    
                </div>
            </div>
        </div>
    </div>

{include file="Public/footer" /}
</body>
</html>