<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<style>
    html,body,.bank_recharge{height: 100%;}
    html{ overflow:hidden; }
   .bank_recharge{width: 100%; position: absolute; top: 0;}

</style>
<body>
<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
    <div class="am-header-left am-header-nav">
        <a href="javascript:history.back(-1);" class="">
            <i class="iconfont icon-arrow-left"></i>
        </a>
    </div>
    <h1 class="am-header-title userHome_h1" style="margin: 0 auto; width: 100%;">
        在线客服
    </h1>
</header>

<div class="bank_recharge">
    <iframe src="{:GetVar('kefuthree')}" id="sangou" style="height: 100%;width: 100%" frameborder="0" scrolling="auto"></iframe>
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