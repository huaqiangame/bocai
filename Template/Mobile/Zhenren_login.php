<include file="Public/header" />
<style>
	body{
		background-color: #fff;}
</style>
<link rel="stylesheet" href="__CSS__/userHome.css">
<script>
	  $(function(){
		 
		 var fmHeight=$(window).height()-60;
		
		  $("#zhen").height(fmHeight+"px");
	  })
</script>
<body >
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>
		<div class=" am-header-title">
		{$type|strtoupper}真人视讯</eq>
		</div>
	</header>
	<div >
		<iframe style="width:100%;" src="{$url}" id="zhen">
		</iframe>
		
	</div>

	
	<include file="Public/footer" />
	
	
</body>
</html>