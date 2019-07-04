<include file="Public/register1" />
<link rel="stylesheet" type="text/css" href="__CSS__/common.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/style.css" />
    <!--wapper-->
    <div class="wapper ">
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
            <div class="forgetPaw" style="background:#e8e8e8;margin-top:10px;">
    		<div class="f_tit step1">&nbsp;</div>
    		<div class="f_cont">
    			<form action="{:U('Public/forgetPaw')}" method="post" id="form1">
                    <input name="action" value="retPassword" type="hidden">
	                <table class="table_code" width="100%" cellspacing="0" cellpadding="0" border="0">
	                    <tbody><tr>
	                    <th scope="row">用户名：
	                    </th>
	                    <td>
	                    	<input name="userName" class="ty_text" datatype="*5-16" placeholder="请输入用户名" type="text">
	                    <span class="Validform_checktip"></span></td>
	                    </tr>
	             <!--       <tr>
	                    <th scope="row">验证码：
	                    </th>-->
	  <!--                  <td>
	                    	<input name="verCode" class="ty_text fl yz_empty" style="width:160px;" placeholder="请输入验证码" datatype="*" type="text">
	                    	<img  src="{:U('Public/verify',array('imageW'=>110,'imageH'=>40,'fontSize'=>15))}"  onclick="this.src=this.src+'?temp='+ 1" />
	                    <span class="Validform_checktip"></span></td>-->
	                    </tr>
	                    <tr>
	                    <th scope="row">&nbsp;</th>
	                    <td>
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
</body>

</html>
