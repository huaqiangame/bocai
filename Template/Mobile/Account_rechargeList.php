<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/activity.css">
<link rel="stylesheet" href="__CSS__/userHome.css">
<!--<style>
	body{
		background-color: #fff;
	}
</style>技术支持QQ:247498803-->
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			选择充值方式
		</font></h1>
</div>
	
<div class="bank_recharge" style="width:100%;position:absolute;top:50px;">
	<div class="activity_list">
		<a href="{:U('Account/recharge')}" class="am-cf am-block">
			<div class="am-fl">
				<svg class="icon" aria-hidden="true">
				    <use xlink:href="#icon-yinlianzhifu"></use>
				</svg>
			</div>
			<div class="activity_list2 am-fl">
				<p  style="font-size:0.22rem;margin-top:0.08rem">银行转账</p>
			</div>
			<div class="activity_list3 am-fr">
				<i class="iconfont icon-arrowright"></i>
			</div>
		</a>
	</div>

	<!--<div class="activity_list">
		<a href="{:U('Account/ysfrecharge')}" class="am-cf am-block">
			<div class="am-fl">
				<svg class="icon" aria-hidden="true">
				    <use xlink:href="#icon-kuaijiezhifu"></use>
				</svg>
			</div>
			<div class="activity_list2 am-fl">
				<p  style="font-size:0.22rem;margin-top:0.08rem">云闪付支付</p>
				<em>单笔最低100元，最高100000元。</em>
			</div>
			<div class="activity_list3 am-fr">
				<i class="iconfont icon-arrowright"></i>
			</div>
		</a>
	</div>-->
<!--	<div class="activity_list">
		<a href="{:U('Account/ysfrecharge')}" class="am-cf am-block">
			<div class="am-fl">
            <img src="__IMG__/ysf.png" style="width:0.4rem;margin-top:0.15rem">
			</div>
			<div class="activity_list2 am-fl">
				<p  style="font-size:0.22rem;margin-top:0.08rem">云闪付支付</p>
			</div>
			<div class="activity_list3 am-fr">
				<i class="iconfont icon-arrowright"></i>
			</div>
		</a>
	</div>-->
	<div class="activity_list">
		<a href="{:U('Account/wxRecharge')}" class="am-cf am-block">
			<div class="am-fl">
				<svg class="icon" aria-hidden="true">
				    <use xlink:href="#icon-weixin-copy"></use>
				</svg>
			</div>
			<div class="activity_list2 am-fl">
				<p style="font-size:0.22rem;margin-top:0.08rem">微信扫码充值</p>
				<!--<em>单笔最低20元，最高4999元。</em>-->
			</div>
			<div class="activity_list3 am-fr">
				<i class="iconfont icon-arrowright"></i>
			</div>
		</a>
	</div>
	
	<div class="activity_list">
		<a href="{:U('Account/zfbRecharge')}" class="am-cf am-block">
			<div class="am-fl">
				<svg class="icon" aria-hidden="true">
				    <use xlink:href="#icon-zhifubao"></use>
				</svg>
			</div>
			<div class="activity_list2 am-fl">
				<p style="font-size:0.22rem;margin-top:0.08rem">支付宝扫码充值</p>
				<!--<em>单笔最低20元，最高2999元。</em>-->
			</div>
			<div class="activity_list3 am-fr">
				<i class="iconfont icon-arrowright"></i>
			</div>
		</a>
	</div>
	<!--
	<div class="activity_list">
		<a href="{:U('Account/fourRecharge')}" class="am-cf am-block">
			<div class="am-fl">
				<svg class="icon" aria-hidden="true">
					<use xlink:href="#icon-tian"></use>
				</svg>
			</div>
			<div class="activity_list2 am-fl">
				<p style="font-size:0.22rem;margin-top:0.08rem">四合一在线充值</p>
				<em>单笔最低20元，最高2999元。</em>
			</div>
			<div class="activity_list3 am-fr">
				<i class="iconfont icon-arrowright"></i>
			</div>
		</a>
	</div>-->
</div>
	<include file="Public/footer" />
</body>
</html>