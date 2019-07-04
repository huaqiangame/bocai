<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/activity.css">
<body>
<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
	<div class="winners_tab am-header-title">
		<em class="active" data-title="0">中奖信息</em><em data-title="1">昨日奖金榜</em>
	</div>
</header>

<ul class="winners_info winners_newest">
	<volist name="list2"  id="value" key="k">
	<li>
		<a href="###" id="users{$k}" onclick="userinfo(this.id);"  class="am-cf am-block">
			<img class="am-circle am-fl" src="__ROOT__{$value['face']}" alt="">
			<div class="am-fl winners_info_main">
				<p><em class="user">{$value['username']}</em> {$value['k3name']}</p>
				<p>喜中<strong> ￥<b class="jiangjin">{$value['okamount']}</b></strong></p>
			</div>
			<i class="iconfont am-fr icon-arrowright"></i>
		</a>
	</li>
	</volist>
</ul>

<ul class="winners_info" style="display:none;">
	<volist name="list"  id="value" key="k">
	<li>
		<a href="###" id="userst{$k}" onclick="userinfo(this.id);"  class="am-cf am-block">
			<img class="am-circle am-fl" src="__ROOT__{$value['face']}" alt="">
			<div class="am-fl winners_info_main">
				<p>账号昵称：<em class="user">{$value['username']}</em></p>
				<p>昨日奖金：<strong>￥<b class="jiangjin">{$value['amountcount']}</b></strong></p>
			</div>
			<switch name="k">
				<case value="1">
					<i class="am-fr winners_num winners_one">1</i>
				</case>
				<case value="2">
					<i class="am-fr winners_num winners_two">2</i>
				</case>
				<case value="3">
					<i class="am-fr winners_num winners_three">3</i>
				</case>
				<default />
				<i class="am-fr winners_num">{$key}</i>
			</switch>
		</a>
	</li>
	</volist>
</ul>
<script>
	function userinfo(obj) {
		var  user = $("#"+obj).find('.user').html();
		var  jiangjin = $("#"+obj).find('.jiangjin').html();
		var  img = $("#"+obj).find('.am-circle').attr('src').substr(-6).replace("/", "");
		var  userurl = Webconfigs['ROOT']+'/Mobile.Index.userinfo.user.'+user+'.img.'+img+'.jinajin.'+jiangjin+'.html' ;
		window.location.href = userurl;
	}
</script>
<include file="Public/footer" />
</body>
</html>