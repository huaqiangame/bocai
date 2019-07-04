<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/activity.css">
<body class="bg_fff">
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>

		<h1 class="am-header-title activity_h1">
			玩家信息
		</h1>
	</header>
	
	<div class="userinfo_img">
		<img src="__IMG__/playerHomeBg.jpg" alt="">
	</div>
	
	<div class="userinfo_main">
		<div class="img">
			<img class="am-circle" src="__ROOT__/resources/images/face/{$img}.jpg" alt="头像">
		</div>
		<p class="user_zh">账号:{$user}</p>
		<p class="user_sex">性别:保密</p>
		<p class="user_other">
			<em>头衔：{$touhan}</em>
			<em>累积中奖：￥<b class="am-text-danger">{$jinajin}</b></em>
		</p>
		<div class="user_grade">
			{$groupname}
		</div>
	</div>

	<div class="user_like">
		<h3>Ta喜欢的彩票</h3>
		<ul class="am-avg-sm-4">
			<volist name="k3names" id="value">
				<a href="{:U('Lottery/k3',array('name'=>$value['name']))}" style="float: left;">
			<li style="width:4em;margin:1em"><i class="iconfont icon-fucaikuai3 k3_color"></i><span style="color:#333">{$value['title']}</span></li>
				</a>
			</volist>
		</ul>
	</div>

</body>
</html>