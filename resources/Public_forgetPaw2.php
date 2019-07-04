<include file="Public/register1" />
<link rel="stylesheet" type="text/css" href="__CSS__/common.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/style.css" />

    <!--wapper-->
    <div class="wapper ">
        <div class="w1000">
            <div class="forgetPaw" style="background:#e8e8e8;">
    		<div class="f_tit step3">&nbsp;</div>
    		<div class="f_cont">
    			<form action="{:U('Public/forgetPaw2')}" method="post" id="form1">
                    <input name="action" value="retPassword" type="hidden">
	                <table class="table_code" width="100%" cellspacing="0" cellpadding="0" border="0">
	                    <tbody>
<!--					     <if  condition="$Think.cookie.nottel eq '1'">
							<tr>
								<th scope="row">您收到的验证码：</th>
								<td>
								<input name="yztext" class="ty_text" type="text">
								</td>
							</tr>
						 </if>-->
	                    <tr>
                            <th scope="row">新密码：</th>
                            <td>
                            <input name="pa" class="ty_text" type="password">
                            </td>
                        </tr>
	                    <tr>
                            <th scope="row">确认新密码：</th>
                            <td>
                            <input name="pa1" class="ty_text" type="password">
                            </td>
                        </tr>
	                    <tr>
	                    <th scope="row">&nbsp;</th>
	                    <td>          	
	                    	<input class="ty_btn" value="上一步" type="button" onclick="window.location.href='{:U('Public/forgetPaw1')}';">
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
	})
})
</script> 
</body>

</html>
