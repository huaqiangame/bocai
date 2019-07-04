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
			幸运大奖
		</h1>
	</header>
	
	<div class="promotion_img">
		<img src="__IMG__/activity_bg5.jpg" alt="">
	</div>

	<div class="promotion_main">

		{$houdong}
		<!--<div class="promotion_explain">
			<h2 class="promotion_h2">
				活动时间
			</h2>
			2017年6月08日起。
			<br />
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				活动奖金
			</h2>
			不限奖金，上不封顶，系统随机派送
			<br />
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				活动规则
			</h2>
			1.本次活动属于自动抽奖系类，会员无需申请，会员只需充值100元RMB以上记录并且游戏有进行提款的会员即可参与此项活动。 
			<br />2.如果被出款系统抽中，系统将会自动发送奖金到您的个人银行帐号里面，请会员查看您的个人银行帐号。 
			<br />3.幸运彩主办方对本次活动拥有最终修改权及解释权。
			<br />
		</div>-->
	</div>
	<include file="Public/footer" />	<script type="text/javascript">
		function qingquyongqu(){
			$.post("{:U('Activity/everydayPlus')}",'', function(json){
				if(json.status==1){
					alert(json.info);
					window.location.reload();
				}else{
					alert(json.info);
				}
			},'json');
			return false;
		}
	</script>
</body>
</html>