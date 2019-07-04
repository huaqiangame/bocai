<!--footer start------------->
<section id="footer" class="container">
	<p class="footline"></p>
    <p class="foot_img"></p>
    <p class="text-c f-14">福彩快三线上平台 Copyright 2011 - 2016 {$_SERVER['HTTP_HOST']} All rights reserved.沪ICP备15030378号-42</p>
    <p class="text-c f-14 mt-10">温馨提示：如果电脑浏览不正常，请下载安装Google Chrome、火狐浏览器 。 理性购彩，热心公益。未满18周岁的未成年人禁止购彩及兑奖！ </p>
</section>
<!--footer end------------->
<div class="kefu onk" style="width:140px; height:95px;position:absolute"><img style="cursor:pointer;" onclick="lianxikefu();" src="http://www16.53kf.com/img/upload/10139365/zdypic/icon_off_101393651472576593.png" width="140" height="95" />
<?php $kefuqq = C('kefuqq');?>
{if condition="is_numeric($kefuqq) and ($kefuqq neq '')"}
<p style="margin-top:10px;text-align:center; font-weight:bold;"><a href="http://wpa.qq.com/msgrd?v=3&uin={$kefuqq}&site=qq&menu=yes" target="_blank" style="color:#d62d2d">客服QQ：{$kefuqq}</a></p>
{/if}
</div>
		<script type="text/javascript">
$(function(){
$(".onk").hide();
$(".onk").css({"top":280+$(window).scrollTop(),"right":$(window).width()/2-500-180});
$(window).scroll(function(){var offsetTop=280+$(window).scrollTop();$(".onk").animate({"top":offsetTop,"right":$(window).width()/2-500-180},{duration:500,queue:false})});
$(window).resize(function(){var offsetTop=280+$(window).scrollTop();$(".onk").animate({"top":offsetTop,"right":$(window).width()/2-500-180},{duration:500,queue:false})});
window.setTimeout(showwin,500);//2秒
});
function showwin(){$(".onk").fadeIn('slow');}
</script>