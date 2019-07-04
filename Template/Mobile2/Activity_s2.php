<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/activity.css">

</head>
<body class="bg_fff">
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>

		<h1 class="am-header-title activity_h1">
			晋级奖励
		</h1>
	</header>
	<div class="promotion_main">
	<h2 class="promotion_h2">
				活动说明
			</h2><p style="box-sizing:inherit; font-family:&quot;Microsoft YaHei&quot;; color:rgb(102, 102, 102); background-color:rgb(255, 255, 255); font-size:14px !important; padding:0px !important;"><span style="box-sizing:inherit;">恭祝网赚团队入驻（福利彩<span style="box-sizing:inherit;">）</span>四周年！</span><br><span style="box-sizing:inherit;">为便捷团队成员能及时找到团队大家庭，</span><br><span style="box-sizing:inherit;">在各个成员的强烈要求下，现开启此公告。</span><br><span style="box-sizing:inherit;">祝愿大家紧跟团队脚步，越来越好！</span><br><br><span style="box-sizing:inherit;">团队QQ：<span style="box-sizing:inherit; color:rgb(255, 0, 0);">574289280</span>（福利）</span></p><p style="box-sizing:inherit; font-family:&quot;Microsoft YaHei&quot;; color:rgb(102, 102, 102); background-color:rgb(255, 255, 255); font-size:14px !important; padding:0px !important;"><span style="box-sizing:inherit;"><span style="box-sizing:inherit;">团队微信：</span><span style="box-sizing:inherit; color:rgb(255, 0, 0);">ws19991108</span><span style="box-sizing:inherit;">（福利）</span></span><br><strong><span style="box-sizing:inherit; color:rgb(255, 0, 0);">团队简介：</span></strong><br><span style="box-sizing:inherit;">团队成立于2013年2月，致力于研究网赚项目的一支专业团队。至今，团队拥有群成员约2,323,162人。团队目标是让越来越多的人日进“斗金”！团队本着“授之以渔，互惠互利，诚信友好”的原则，为广大成员提供更多的赚钱机会！&nbsp;</span></p><p style="box-sizing:inherit; font-family:&quot;Microsoft YaHei&quot;; color:rgb(102, 102, 102); background-color:rgb(255, 255, 255); font-size:14px !important; padding:0px !important;"><strong><span style="box-sizing:inherit; color:rgb(255, 0, 0);">福利彩简介：</span></strong></p><p style="box-sizing:inherit; font-family:&quot;Microsoft YaHei&quot;; font-size:14px; word-wrap:break-word; color:rgb(102, 102, 102); background-color:rgb(255, 255, 255); padding:0px !important;">福利彩成立于2014年，长期秉持＂客户第一、用户至上＂的服务宗旨，为广大用户提供最优质的购彩体验。</p><p style="box-sizing:inherit; font-family:&quot;Microsoft YaHei&quot;; font-size:14px; word-wrap:break-word; color:rgb(102, 102, 102); background-color:rgb(255, 255, 255); padding:0px !important;">携手大发云提供最专业的彩票投注系统，为广大用户提供＂安全、可靠、极致＂的服务体验。</p><p style="box-sizing:inherit; font-family:&quot;Microsoft YaHei&quot;; font-size:14px; word-wrap:break-word; color:rgb(102, 102, 102); background-color:rgb(255, 255, 255); padding:0px !important;">提供最合理的赔率，多渠道的收付款方式，多元化的投注玩法让广大用户享受高品质的购彩体验.</p><p style="box-sizing:inherit; font-family:&quot;Microsoft YaHei&quot;; font-size:14px; word-wrap:break-word; color:rgb(102, 102, 102); background-color:rgb(255, 255, 255); padding:0px !important;"><span style="box-sizing:inherit; font-weight:bolder; color:rgb(255, 0, 0);">诚信为本：</span></p><p style="box-sizing:inherit; font-family:&quot;Microsoft YaHei&quot;; font-size:14px; word-wrap:break-word; color:rgb(102, 102, 102); background-color:rgb(255, 255, 255); padding:0px !important;">作为专业的彩票投注平台，我们承诺，为每一位用户提供最安全、最公平的购彩服务。</p><p><br></p>
	</div>

	<include file="Public/footer" />
	<script type="text/javascript">
		function jiangli(){
			$.post("{:U('Activity/jinji')}",'', function(json){
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