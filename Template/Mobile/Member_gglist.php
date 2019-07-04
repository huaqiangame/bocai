<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			公告 
		</font></h1>
</div>
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