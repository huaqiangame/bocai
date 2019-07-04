<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<!--<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>-->
<body> 
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			今日盈亏
		</font></h1>
</div>
	
	<div class="winloss_top">
		<p class="winloss_money_text">盈利金额</p>
		<p class="winloss_money">{$yingli}元</p>
		<p class="winloss_activity"><i class="iconfont icon-gantanhao1"></i>盈亏公式：中奖-投注+活动+返点+反水</p>
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
				<span class="money am-block">0.00</span>
				<em class="money_text am-block">活动礼金</em>
			</li>
			<li>
				<span class="money am-block">{$fandian}</span>
				<em class="money_text am-block">返点金额</em>
			</li>
			<li>
				<span class="money am-block">{$tikuancount}</span>
				<em class="money_text am-block">娱乐城返点</em>
			</li>
			<li>
				<span class="money am-block">{$tikuancount}</span>
				<em class="money_text am-block">娱乐城反水</em>
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
</html>