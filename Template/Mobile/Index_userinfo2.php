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
			<img class="am-circle" src="__IMG__/C6021F3486D2B2DB.jpg" alt="头像">
		</div>
		<p class="user_zh">账号:{$user}</p>
		<p class="user_sex">性别: <eq name="sex" value="1">男</eq><eq name="sex" value="0">女</eq><eq name="sex" value="2">保密</eq></p>
		<p class="user_other">
			<em>头衔：{$touhan}</em>
			<em>累积中奖：￥<b class="am-text-danger">{$okamountcount}</b></em>
		</p>
		<div class="user_grade">
			{$groupname}
		</div>
	</div>

	<div class="user_like">
		<h3>Ta喜欢的彩票</h3>
		<ul class="am-avg-sm-4">
			<volist name="k3names" id="value">
			<li style="position: relative;margin:10px auto;"><a href="{:U('Lottery/k3',array('name'=>$value['name']))}" style="color:#333;"><i class="iconfont icon-fucaikuai3 k3_color"></i><span style="margin: 70px 0 0 -58px;position: fixed;">{$value.title}</span></a></li>
			</volist>
		</ul>
	</div>
<include file="Public/footer" />
</body>
</html>