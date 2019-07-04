<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>
		<h1 class="am-header-title activity_h1">
			今日盈亏
		</h1>
	</header>

	<div class="winloss_top">
		<p class="winloss_money_text">盈利金额</p>
		<p class="winloss_money">{$yingli}元</p>
		<p class="winloss_activity"><i class="iconfont icon-gantanhao1"></i>盈亏计算公式：中奖-投注+活动+返点</p>
	</div>
	<div class="winloss_bottom">
		<ul class="am-avg-sm-3">
			<li>
				<span class="money am-block">{$touzhucount}</span>
				<em class="money_text am-block">投注金额</em>
			</li>
			<li>
				<span class="money am-block">{$zhongjiangcount}</span>
				<em class="money_text am-block">中奖金额</em>
			</li>
			<li>
				<span class="money am-block">{$fanshui}</span>
				<em class="money_text am-block">活动礼金</em>
			</li>
			<li>
				<span class="money am-block">{$fandian}</span>
				<em class="money_text am-block">返点金额</em>
			</li>
			<li>
				<span class="money am-block">{$chuzhicount}</span>
				<em class="money_text am-block">充值金额</em>
			</li>
			<li>
				<span class="money am-block">{$tikuancount}</span>
				<em class="money_text am-block">提现金额</em>
			</li>
		</ul>
	</div>
</body>
<include file="Public/footer" />
</html>