
<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
<link rel="stylesheet" href="__CSS2__/reset.css">
<link rel="stylesheet" href="__CSS2__/icon.css">
<link rel="stylesheet" href="__CSS2__/header.css">
<link rel="stylesheet" href="__CSS2__/main.css">
<link rel="stylesheet" href="__CSS2__/footer.css">
<include file="Public/header" />
<link rel="stylesheet" type="text/css" href="__CSS__/common.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/layout.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/style.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/artDialog.css" />
<script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__JS__/artDialog.js"></script>
<script type="text/javascript" src="__JS__/index.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<style>
	.passwordStrength,.passwordput{
		display:block; width:100%;
		clear:left;
	}
	.passwordStrength b{
		font-weight:normal;
	}
	.passwordStrength b,.passwordStrength span{
		display:inline-block;
		vertical-align:middle;
		line-height:16px;
		line-height:18px\9;
		height:16px;
	}
	.passwordStrength span{
		width:45px;
		text-align:center;
		background-color:#d0d0d0;
		border-right:1px solid #fff;
	}
	.passwordStrength .last{
		border-right:none;
	}
	.passwordStrength .bgStrength{
		color:#fff;
		background-color:#71b83d;
	}
	.register dl dd em{float:none;}
	form .formdl select{font-size:18px;}
	form .formdl select option{margin-right: 5px}
</style>
<!--wapper-->
<body>
<div class="h35"></div>
<div class="wapper ">
	<div class="w1000">
		<div id="cookie_registerForms" class="register login_m_form b1 bg_wite">
			<h2 class="text-danger text-center" style="border-bottom: 2px solid #ccc;padding-bottom: 10px;">会 员 注 册</h2>
			<form method="post" id="form1" class="ruivalidate_form_class" checkby_ruivalidate  onSubmit="return check_form(this)"  action="{:U('Public/register')}">
				<input type="hidden" name="action" value="register_agent" />

				<assign name="defaulttjcode" value="$Think.config.defaulttjcode" />


				<if condition="$defaulttjcode neq 0">
				<dl style="padding:0;">
					<dt>&nbsp;</dt>
					<dd style="font-size: 12pt;color: #333333;">无推荐代码请输入：{$defaulttjcode}</dd>

				</dl>
				</if>
				<dl>
					<dt>推荐码：</dt>
					<dd><!-- verify="isReccode" datatype="/[\w\W]+/" ajaxurl="{:U('Public/checkreccode')}" errormsg="请填推荐码格式错误，推荐码为数字！" nullmsg="请填推荐码！"-->
						<input  type="text"  class="text_accont"  style="border-radius:4px;"  id="reccode" name="reccode" /><em class="Validform_checktip"></em>
					</dd>
				</dl>
				<dl>
					<dt>用户名：</dt>
					<dd>
						<input  type="text"  class="text_accont" style="border-radius:4px;"  id="userName" name="username"  verify="isLoginName" datatype="/[\w\W]+/" ajaxurl="{:U('Public/checkusername')}" errormsg="用户名格式错误，可以中文英文字符数字！" nullmsg="请填写用户名！"/><em class="Validform_checktip"></em>
					</dd>
				</dl>

				<dl>
					<dt>密  码：</dt>
					<dd>
						<div class="passwordput"><input  type="password" style="border-radius:4px;"   class="text_accont" name="password" id="passWord" plugin="passwordStrength" errormsg="密码范围在6~16位之间！" nullmsg="请设置密码！" datatype="s6-16"/><em class="Validform_checktip"></em></div>
						<div class="passwordStrength">密码强度： <span>弱</span><span>中</span><span class="last">强</span></div>
                    </dd>
				</dl>
				<dl>
					<dt>确认密码：</dt>
					<dd>
						<input  type="password" id="qpassWord" class="text_accont" style="border-radius:4px;"  name="cpassword" datatype="*6-16" recheck="password" nullmsg="请再输入一次密码！" errormsg="您两次输入的账号密码不一致！"/><em class="Validform_checktip"></em>
					</dd>
				</dl>
				<dl class="formdl">
					<dt>提款密码：</dt>
					<dd>
						<input  type="text" id="qpassWord" class="text_accont" style="border-radius:4px;"  name="tradepassword" datatype="*6-16" recheck="password" nullmsg="请输入提款密码！"/>
						<!--<select name="rpassword[]" style="border-radius:4px;" >
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<select name="rpassword[]" style="border-radius:4px;" >
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<select name="rpassword[]" style="border-radius:4px;" >
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<select name="rpassword[]" style="border-radius:4px;" >
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<select name="rpassword[]" style="border-radius:4px;" >
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<select name="rpassword[]" style="border-radius:4px;" >
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>-->

					</dd>
				</dl>
				<!--				 <dl>
                                     <dt>手机号：</dt>
                                     <dd>
                                         <input  type="text"  class="text_accont" id="tel" name="tel" datatype="/^(1)[0-9]{10}$/" ajaxurl="{:U('Public/checktel')}" errormsg="手机号码错误！" nullmsg="请填写手机号码！"/>

                                         <em class="Validform_checktip"></em>
                                     </dd>
                                 </dl>
                                <dl>
                                   <dt>图形验证码：</dt>
                                   <dd>
                                       <input  type="text"  class="text_accont" id="verCord" name="verCord" msg="请输入图形验证码"  datatype="/^\d{4}$/" errormsg="请输入4位数字图形验证码！" nullmsg="请输入图形验证码！" style="width:80px;"/>
                                       <img src="{:U('Public/verify',array('imageW'=>100,'imageH'=>25,'fontSize'=>12))}" onclick="this.src=this.src+'?temp='+ 1" style="float:left"><em class="Validform_checktip"></em>
                                   </dd>
                               </dl>
                              <dl>
                                   <dt>短信验证码：</dt>
                                   <dd>
                                       <input  type="text"  class="text_accont" name="telcode" datatype="/\S/" errormsg="验证码错误！" nullmsg="请填写您手机接收到的注册验证码！" size="8" style="width:80px;"/>
                                       <input type="button" id="btn" value="免费获取验证码" onclick="sendtelcode(this);" style="border:1px solid #ddd;height:30px; line-height:30px;" />
                                       <em class="Validform_checktip"></em>
                                   </dd>
                               </dl>-->
				<input type="checkbox" checked="checked" name="age" style="margin-left:100px;" />我已经年满18岁

				<dl style="padding-left: 8em;" >
					<dd>
						<p>　
							<input  type="submit"  class="btn btn-danger btn-small active register" style="width:8em;height: 2.5em;" value="点击注册"/>　
							<input  type="reset"  style="width:8em;height: 2.5em;" class="btn btn-default active  reset"  value="重置"" />　已有账号？<a href="{:U('Public/login')}" class="remmber_pwd">立即登录</a></p>
					</dd>
				</dl>
			</form>
		</div>
	</div>
</div>
<!--wapper-->
<div class="h35"></div>
<include file="Public/footer" />
<script type="text/javascript" src="__JS__/Validform_v5.3.2.js"></script>
<script type="text/javascript" src="__JS__/passwordStrength-min.js"></script>
<script type="text/javascript">
	$(function(){
		$("#form1").Validform({
			tiptype:function(msg,o,cssctl){
				var objtip=o.obj.siblings(".Validform_checktip");
				cssctl(objtip,o.type);
				objtip.text(msg);
			},
			usePlugin:{
				passwordstrength:{
					minLen:6,
					maxLen:18
				}
			},
			callback:check_form

		});
	})
	function rdirect(url){
		window.location.href = url;
	}
	function check_form(obj){
		$.post($(obj).attr('action'),$(obj).serialize(), function(json){
			if(json.sign==1){
				alt('恭喜您注册成功，感谢您的加入!');
				var url = json.url?json.url:"{:U('Home/Index/index')}";
				setTimeout("rdirect('"+url+"')", 1500);

			}else{
				alt(json.message);
			}
		},'json');
		return false;
	}
</script>
<script type="text/javascript">
	function sendtelcode(obj){
		if($("input[name='username']").val().length<3){
			alert('用户名设置错误');
			return false;
		}

		if($("input[name='password']").val().length<6){
			alert('密码设置错误');
			return false;
		}
		if($("input[name='password']").val()!=$("#qpassWord").val()){
			alert('两次密码输入不一致');
			return false;
		}
		var tel = $("#tel").val();
		var exp = new RegExp("^(1)[0-9]{10}$");
		if(!exp.test(tel)){
			alert('手机号码填写错误');
			$("#tel").focus();
			return false;
		}
		if($("input[name='verCord']").val().length<4){
			alert('图形验证码设置错误');
			return false;
		}else{
			$.post("{:U('Public/check_verify')}",{'code':$("input[name='verCord']").val()}, function(json){
				if(json.status=='y'){
					var token = json.token;
					sendmsg(tel,token,obj);
				}else{
					alert('图形验证码错误!');
					return false;
				}
			},'json');
		}


	}
	function sendmsg(tel,token,obj){
		$.post("{:U('Public/sendmsn')}",{'token':token,'mobile':tel}, function(json){
			if(json.status=='y'){
				settime(obj);
			}else{
				alert(json.message);
				return false;
			}
		},'json');
	}
	var countdown=180;
	function settime(obj) {
		if (countdown == 0) {
			obj.removeAttribute("disabled");
			obj.value="免费获取验证码";
			countdown = 180;
			return;
		} else {
			obj.setAttribute("disabled", true);
			obj.value="重新发送(" + countdown + ")";
			countdown--;
		}
		setTimeout(function() {
				settime(obj) }
			,1000)
	}

</script>
</body>

</html>
