<include file="Agent/header" />

<div class="h25"></div>
<div class="wapper">
	<div class="w1000 bg_wite">
		<div class="content bg_wite" style="border-top:1px solid #ddd;">
			<div class="cont_box">
				<span>上次登录：{$userinfo['logintime']|date='Y-m-d H:i:s',###} , IP：{$userinfo['loginip']}</span>
				<span>您当前的级别为：{$userinfo.groupname}</span>
                    <span style="width: 93px;margin: 0 auto;"><i class="fl">链接代码：</i>


                        <i class="fl" style="font-size:14px; color:green">{$userinfo.id}</i>

                    </span>
			</div>
			<div class="safe_mang">
				<ul>


				</ul>
			</div>
		</div>
		<div class="wapper_bottom b1 mgt15">
			<ul>
				<li><i>1</i><span><h4>注册会员</h4><p>qq2617674</p></span></li>
				<li><i>2</i><span><h4>账户充值</h4><p>支持多种便捷支付</p></span></li>
				<li><i>3</i><span><h4>投注购彩</h4><p>官方平台支持，正规安全</p></span></li>
				<li><i>4</i><span><h4>中奖派奖</h4><p>中奖第一时间派奖</p></span></li>
				<li><i>5</i><span><h4>奖金提现</h4><p>支持多种方式，快捷到账</p></span></li>
			</ul>
		</div>
		<div class="mgt10"></div>
	</div>
</div>
<!--wapper-->
<include file="Public/footer" />
</body>

</html>

