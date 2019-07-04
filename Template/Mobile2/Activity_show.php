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
			{$title}
		</h1>
	</header>
	<div class="promotion_main">
	<h2 class="promotion_h2">
				活动说明
			</h2>
			{$huodong}
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