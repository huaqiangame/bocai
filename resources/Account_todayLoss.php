<include file="Public/headermember" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
	<link rel="stylesheet" href="__CSS2__/todayLoss.css">
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
	<include file="Member/side" />
	<div class="pull-right vip_info_pan">
		<div class="vip_info_title">
			今日盈亏
		</div>
		<div class="vip_info_content today_loss">
			<div class="today_loss_top clearfix">
				<div class="today_balance pull-left common_border_box">
					<h3 class="color_res">{$userinfo['balance']}</h3>
					<div class="today_balance_other">
							<span>
								<i class="iconfont">&#xe603;</i>
								余额
							</span>
						<a href="{:U('Account/Recharge')}">充值</a>
						<a href="{:U('Account/withdrawals')}">提现</a>
						<a href="{:U('Account/dealRecord')}">交易记录</a>
					</div>
				</div>
				<div class="today_total pull-left common_border_box">
					<i class="iconfont today_total_left">&#xe642;</i>
					<div class="today_total_right">
						<p>盈亏总额(元)</p>
						<em class="color_res">{$yingli}</em>
					</div>
				</div>
				<div class="today_formula pull-left common_border_box">
					<i class="iconfont today_total_left">&#xe632;</i>
					<div class="today_total_right">
						<p>盈亏总额(元)</p>
						<em class="color_res">中奖-投注+活动+返点</em>
					</div>
				</div>
			</div>
			<div class="today_loss_bottom common_border_box">
				<ul class="clearfix row">
					<li class="col-xs-2">
						<em>{$touzhucount}</em>
						<p>投注金额</p>
					</li>
					<li class="col-xs-2">
						<em>{$zhongjiangcount}</em>
						<p>中奖金额</p>
					</li>
					<li class="col-xs-2">
						<em>0.00</em>
						<p>活动礼金</p>
					</li>
					<li class="col-xs-2">
						<em>{$fandian}</em>
						<p>返点金额</p>
					</li>
					<li class="col-xs-2">
						<em>{$chuzhicount}</em>
						<p>娱乐城返点</p>
					</li>
					<li class="col-xs-2">
						<em>{$tikuancount}</em>
						<p>娱乐城反水</p>
					</li>

				</ul>
			</div>
			<div class="today_loss_bottom common_border_box">
				<ul class="clearfix row">
					<li class="col-xs-2">
						<em>{$chuzhicount}</em>
						<p>充值金额</p>
					</li>
					<li class="col-xs-2">
						<em>{$tikuancount}</em>
						<p>提现金额</p>
					</li>
			   </ul>
			</div>
		</div>
	</div>
</div>
<include file="Public/footer" />

<div class="modal fade is_login_model" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">温馨提示</h4>
			</div>
			<div class="modal-body">
				非常抱歉！您还未登录，请先登录
			</div>
			<div class="modal-footer">
				<a href="login.html" class="btn btn-default login_btn">立即登录</a>
				<a href="register.html" class="btn btn-default register_btn">用户注册</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>