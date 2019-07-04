<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body class="bg_fff">
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>
		<h1 class="am-header-title activity_h1">
			交易记录
		</h1>
		<div class="am-header-right am-header-nav">
			<a href="javascript:void(0);" data-am-modal="{target: '#my-actions'}">
				<em class="bill_day">全部</em>
				<i class="iconfont icon-jiantouxia"></i>
			</a>
		</div>
	</header>
	
	<div data-am-widget="" class="am-tabs am-tabs-d2 billrecord_main">
		<ul class="am-tabs-nav am-cf am-avg-sm-3" style="text-align:center;">
			<li class=""><a href="{:U('Mobile/Account/dealRecord')}">所有类型</a></li>
			<li class=""><a href="{:U('Mobile/Account/dealRecord2')}">充值记录</a></li>
			<li class="am-active"><a href="{:U('Mobile/Account/dealRecord3')}">提现记录</a></li>
		</ul>

		<?php $typearray = AbstractType();?>
			<div data-tab-panel-1 class="am-tab-panel ">
				<div data-am-widget="list_news" class="am-list-news am-list-news-default" >
					<div class="am-list-news-bd">
						<ul class="am-list">
							<volist name="mxlist" id="vo">
							<li class="am-g am-list-item-dated">
								<p class="am-cf">
									<span class="what_type am-fl">{$vo['bankname']}</span>
									<em class="money am-fr">{$vo.amount}</em>
								</p>
								<p class="am-cf billrecord_time">
									<span class="am-fl">{$vo.oddtime|date="Y-m-d H:i:s",###}</span>
									<if condition="$vo['state'] eq 1">
										<em class="am-fr" style="color:green">提款成功</em>
										<elseif condition="$vo['state'] eq 0" />
										<em class="am-fr" style="state:green">处理中</em>
										<elseif condition="$vo['state'] eq -1" />
										<em class="am-fr" style="color:grey">提款退回</em>
									</if>
								</p>
							</li>
							</volist>
						</ul>
						<div class="page">{$pageshow}</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="am-modal-actions billrecord_day" id="my-actions">
		<div class="am-modal-actions-group">
			<ul class="am-list">
				<li class="am-modal-actions-header" onclick="chaxun(0)">全部</li>
				<li class="am-modal-actions-header" onclick="chaxun(1)">今天</li>
				<li class="am-modal-actions-header" onclick="chaxun(2)">昨天</li>
				<li class="am-modal-actions-header" onclick="chaxun(3)">七天</li>
			</ul>
		</div>
		<div class="am-modal-actions-group">
			<button class="am-btn am-btn-secondary am-btn-block btn_red" data-am-modal-close>取消</button>
		</div>
	</div>
	<include file="Public/footer" />
	<script>
		setTimeout(function () {
			var test = window.location.href;
			var str = test.substr(test.length-7);
			switch (str){
				case 'atime=1':
					$('.bill_day').html('今天');
					break;
				case 'atime=2':
					$('.bill_day').html('昨天');
					break;
				case 'atime=3':
					$('.bill_day').html('七天');
					break;

			}
		})
		function chaxun(t){
//			var type = $('#type').val();
			var atime = t;
			var url = "__ROOT__/?m=Mobile&c=Account&a=dealRecord3&atime="+atime/*+"&type="+type*/;
			window.location.href = url;
		}
	</script>
</body>
</html>