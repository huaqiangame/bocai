<include file="Public/register1" />
<link rel="stylesheet" type="text/css" href="__CSS__/common.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/style.css" />
    <!--wapper-->
    <div class="wapper">

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
    		<div class="f_tit step2">&nbsp;</div>
    		<div class="f_cont">
                 
    			<form action="{:U('Public/forgetPaw1')}" method="post" id="form1">
                    <input name="action" value="retPassword" type="hidden">
	                <table class="table_code" width="100%" cellspacing="0" cellpadding="0" border="0">
	                    <tbody><tr>
	                    <th scope="row">验证方式：
	                    </th>
	                    <td>
                        <label><input name="yztype" type="radio" class="" value="qq" checked="checked"> QQ账号</label>
                        &nbsp;&nbsp;
                        <label><input type="radio" name="yztype" class="" value="email"> 密保邮箱</label>
							&nbsp;&nbsp;
						<label><input type="radio" name="yztype" class="" value="tel">手机</label>
	                    </td>
	                    </tr>
	                    <tr>
                            <th scope="row"><span id="yztypetxt">QQ号码</span>：</th>
                            <td>
                            <input name="yztext" class="ty_text" type="text">
                            </td>
                        </tr>
	                    <tr>
	                    <th scope="row">&nbsp;</th>
	                    <td>
	                    	<input class="ty_btn" value="上一步" type="button" onclick="window.location.href='{:U('Public/forgetPaw')}';">
							<input class="ty_btn" value="下一步" type="submit">
						</td>
	                    </tr>
	                </tbody></table>
				</form>
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
		if(type=='tel')$("#yztypetxt").text('手机号码');
	})
})
</script> 
</body>

</html>
