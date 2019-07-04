<include file="Public/header" />
<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">

<link rel="stylesheet" href="__CSS2__/updatePass.css">
<link rel="stylesheet" href="__CSS2__/securityCenter.css">
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />

<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<style>
    #form1 .text_in{
        width: 233px;
        margin: 10px 0;
        border: 1px solid #cecece;
        height: 30px;
        font-size: 12px;
    }
    #form1 .Validform_checktip{
        margin-left:10px;
        color:red;
    }
    #form1 .sub_btn{
        display: inline-block;
        line-height: 30px;
        color: #fff;
        padding: 0 15px !important;
        border-radius: 3px;
        font-size: 14px;
        min-width: 55px;
        background: #2e4158;
        border:none;
    }
</style>
<!--wapper-->
<div class="wapper ">
	<div class="w1000">
    	
        <div class="content bg_wite update_pass" >
            <div class="h30"></div>
            <div class="table_box">
            	<form class="ruivalidate_form_class update_form " action="{:U('safepass')}" method="post" id="form1" style="padding:30px 292px;">
                    <dl>
                        <dt>原资金密码：</dt>
                        <dd><input  type="password" class="text_in" name="oldpassword" errormsg="资金密码范围在6~16位之间！" nullmsg="请设置原资金密码！" datatype="s6-16"/>
                            <em class="Validform_checktip">未设置过资金密码则是登陆密码</em>
                        </dd>
                    </dl>
                    <dl>
                        <dt>填写资金密码：</dt>
                        <dd><input  type="password" class="text_in" name="pa1" errormsg="资金密码范围在6~16位之间！" nullmsg="请设置新资金密码！" datatype="s6-16"/>
                            <em class="Validform_checktip"></em>
                        </dd>
                    </dl>
                    <dl>
                        <dt>确认资金密码：</dt>
                        <dd>
                            <input  type="password" class="text_in" name="password" datatype="*6-16" recheck="pa1" nullmsg="请再输入一次资金密码！" errormsg="您两次输入的资金密码不一致！"/>
                            <em class="Validform_checktip"></em>
                        </dd>
                    </dl>
                    <if condition="$userinfo['qq'] eq ''">
					<dl>
                        <dt>QQ号码：</dt>
                        <dd>
                            <input  type="text" class="text_in" name="qq"/>
                            <em class="Validform_checktip"></em>
                        </dd>
                    </dl>
					</if>
                    <dl>
                        <dt>&nbsp;</dt>
                        <dd>
                            <input  type="submit" value="确   定" class="sub_btn bg_red"/>
                        </dd>
                    </dl>
                </form>
            </div>
            <div class="h30"></div>
        </div>
    </div>
</div>
<!--wapper-->
<div class="h35"></div>

<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
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
function rdirect(url){
	window.location.href = url;
}
function check_form(obj){
	$.post($(obj).attr('action'),$(obj).serialize(), function(json){
		if(json.status==1){
			alt(json.info,'success');
			window.location.href="__ROOT__/Member.index";
		}else{
			alt(json.info);
		};
	},'json'); 
	return false;
}
</script>
<include file="Public/footer" />
</body>

</html>
