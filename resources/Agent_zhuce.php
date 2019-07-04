<include file="Agent/header" />
<!--wapper-->
<div class="h35"></div>
<div class="wapper ">
	<div class="w1000">
    	<div id="cookie_registerForms" class="register login_m_form b1 bg_wite">
        	<h4>代理注册会员</h4>
            <form method="post" id="form1" class="ruivalidate_form_class">
                <input type="hidden" name="action" value="register_agent" /> 
                <dl>
                	<dt>用户名：</dt>
                    <dd>
                    	<input  type="text"  class="text_accont" name="userName" datatype="/^([a-zA-Z0-9]|[_]){3,16}$/" ajaxurl="{:U('Public/checkusername')}" errormsg="用户名格式为3-16位英文字母、数字获下划线组成！" nullmsg="请填写用户名！" placeholder="请填写用户名"/><em class="Validform_checktip"></em>
                    </dd>
                </dl>
                <dl>
                	<dt>密  码：</dt>
                    <dd>
                    	<input  type="password"  class="text_accont" name="passWord" placeholder="请填写6-16位，字母与数字组合的密码" value="123456" errormsg="密码范围在6~16位之间！" nullmsg="请设置密码！" datatype="s6-16"/><em class="Validform_checktip">默认为123456</em>
                    </dd>
                </dl>
                
                <dl>
                	<dt>&nbsp;</dt>
                    <dd>
                    	<p><input  type="submit"  class="sub_btn submit"  value="点击注册"/></p>
                    </dd>
                </dl>
            </form>
        </div>
    </div>
</div>
<!--wapper-->
<div class="h35"></div>
<include file="Public/footer" />
<script type="text/javascript" src="__ROOT__/resources/js/Validform_v5.3.2.js"></script>
<script type="text/javascript">
$(function(){
		$("#form1").Validform({
		tiptype:function(msg,o,cssctl){
			var objtip=o.obj.siblings(".Validform_checktip");
			cssctl(objtip,o.type);
			objtip.text(msg);
	 	},
		callback:check_form

	});
})

function check_form(obj){
	$.post($(obj).attr('action'),$(obj).serialize(), function(json){
		if(json.status==1){
			alert('会员注册成功！');
			window.location.href = json.url?json.url:"/{:MODULE_NAME}";
		}else{
			alt(json.info);
		}
	},'json'); 
	return false;
}
</script>
</body>

</html>
