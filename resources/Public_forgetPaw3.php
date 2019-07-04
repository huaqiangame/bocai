<include file="Public/register1" />
<link rel="stylesheet" type="text/css" href="__CSS__/common.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/style.css" />

    <!--wapper-->
    <div class="wapper">
        <div class="w1000">
            <!--上次登陆时间-->
            <!--上次登陆IP地址位置-->
            <!--资金密码设置状态-->
            <!--安全问题设置状态-->
            <!--邮箱设置状态-->
            <!--预留信息设置状态-->
            <!--手机绑定状态-->
            <!--获取安全等级-->
            <!--邮箱信息-->
            <!--预留信息-->
            <!--手机号码-->

            <!--返点级别-->

            <div class="forgetPaw" style="background:#e8e8e8;">
    		<div class="f_tit step4" style="background-position: 0px -126px;">&nbsp;</div>
    		<div class="f_cont"> 
    			<h3 class="text-center">{$setPawIsOkInfo}<br><br><span><a href="{:U('Public/login')}"  class="btn btn-danger active btn-lg" >马上登录</a></span></h3>

    		</div>
    	</div>
        </div>
    </div>
    <!--wapper-->
    <div class="h35"></div>
<include file="Public/footer" /> 
<script>
$(function(){
	$("input[name='yztype']").change(function(){
		var type = $(this).val();
		if(type=='qq')$("#yztypetxt").text('QQ号码');
		if(type=='email')$("#yztypetxt").text('邮箱账号');
		if(type=='modify')$("#yztypetxt").text('预留信息');
	})
})
</script> 
</body>

</html>
