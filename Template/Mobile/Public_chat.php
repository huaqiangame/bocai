<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<style>
    html,body,.bank_recharge{height: 100%;}
    html{ overflow:hidden; }
   .bank_recharge{width: 100%; position: absolute; top: 0;}

</style>
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			在线客服
		</font></h1>
</div>

<div class="bank_recharge">
    <iframe src="{:GetVar('mobile_kefuthree')}" id="sangou" style="height: 100%;width: 100%" frameborder="0" scrolling="auto"></iframe>
</div>
<script>
    $(function(){
    	var srcs=$('#sangou').attr('src').split('/');
    	var host=srcs[srcs.length-1];
    	var url='http://c102.pop800.com/web800/c.do?n='+host;
    	$('#sangou').attr('src',url);
    })
    
</script>
</body>
</html>