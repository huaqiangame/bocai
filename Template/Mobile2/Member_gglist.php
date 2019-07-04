<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body class="bg_fff">
<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
	<div class="am-header-left am-header-nav">
		<a href="javascript:history.back(-1);" class="">
			<i class="iconfont icon-arrow-left"></i>
		</a>
	</div>
	<div class="winners_tab am-header-title">
		<em class="active" data-title="0">公告</em><!-- <em data-title="1">私信</em> -->
	</div>
</header>
<div data-am-widget="tabs" class="am-tabs am-tabs-d2 billrecord_main">
	<div class="am-tabs-bd">
		<div class="am-tab-panel am-active">
			<div data-am-widget="list_news" class="am-list-news am-list-news-default" >
				<div class="am-list-news-bd">
					<ul class="am-list">
						<volist name="gglist" id="vo">
							<li class="am-g am-list-item-dated">
								<a href="{:U('Member/ggshow',array('aid'=>$vo['id']))}">
									<p class="am-cf">
										<span class="what_type am-fl">{$vo[title]}</span>
									</p>
									<p class="am-cf billrecord_time">
										<span class="am-fl">{$vo[oddtime]|date='Y-m-d',###}</span>
									</p>
								</a>
							</li>
						</volist>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div  class="am-tabs am-tabs-d2 billrecord_main isplay_no">
	<p style="text-align:center;">暂无私信</p>
</div>
<include file="Public/footer" />
</body>
</html>