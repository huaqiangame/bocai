
<link rel="stylesheet" type="text/css" href="__CSS__/login.css">

<div id="J_loginModal" class="login-modal modal">
		<div class="inner">
			<div class="close"><i class="iconfont icon-guanbi-copy"></i></div>
			<div class="wap_login_bg mb20">
				<img src="__IMG__/logo.png">
			</div>
			<form class="form-vertical" action="{:U('Public/logindo')}" method="post" id="login_form"  checkby_ruivalidate url="" onSubmit="return check_login(this)">
			<input type="hidden" name="action" value="login">
			<div class="form-group field-loginuser-username required">
			<!--<label class="control-label" for="loginuser-username">用户名</label>-->
			<div class="input-group">
				<span class="wap_login_1">
					<i><img src="__IMG__/500f_login_2.png"></i>
				</span>
				<input type="text" id="login_user_name" class="form-control" name="name" placeholder="请输入会员账号">
			</div>
			<div class="help-block"></div>
			</div>

			<div class="form-group field-loginuser-password required">
			<!--<label class="control-label" for="loginuser-password">密码</label>-->
			<div class="input-group">
				<span class="wap_login_1">
					<i><img src="__IMG__/500f_login_3.png"></i>
				</span>
				<input type="password" id="login_password" class="form-control" name="pass" placeholder="******">
			</div>
			<div class="help-block"></div>
			</div>

			<!--<div class="form-group field-loginuser-username required">

				<div class="input-group">
					<span class="wap_login_2">
						<i><img src="__IMG__/500f_login_4.png"></i>
					</span>
					<div class="row">
						<div class="col-xs-9">
							<input type="text" id="vlcodes" class="form-control" name="vlcodes" placeholder="验证码" >
						</div>
						<div class="col-xs-3">
							<img style="height:30px;width:64px;margin-top:2px;" src="{:U('Public/verify',array('imageW'=>130,'imageH'=>40,'fontSize'=>18))}" alt="(点选此处产生新验证码 )" title="( 点选此处产生新验证码 )"  onclick="this.src=this.src+'?temp='+ 1" />
						</div>
					</div>
				</div>

				<div class="help-block"></div>
			</div>-->

			<div class="wap_500_login_now">
            <button type="submit" class="btn btn-green btn-lg btn-block" name="login-button">立即登录</button>
            </div>
            <div class="wap_500_forget_psw">
				<a href="javascript:void(0)" class="mr30" id="reg_user_show">注册用户</a>
				<a href="{:U('Public/forgetPaw')}">忘记密码</a>
				<!--<input type="checkbox"> 下次自动登录-->
			</div>
			</form>
		</div>
	</div>
	<div class="login-form-mask"></div>
	<script>
    function check_login(obj) {
        var html_obj = $(obj).parent();
         if(html_obj.find('#login_user_name').val() == ''){
             alert("请填写用户名");
             return false;
         }
        if(html_obj.find('#login_password').val() == ''){
            alert("请填写用户名");
            return false;
        }

        $.ajax({
            url : "{:U('Public/LoginDo')}",
            type : 'POST',
            data : $("#login_form").serialize(),
            success : function (data) {
                if(data.sign==true){
                    alert(data.message);
                    window.location.href = data.url;
                }else{
                    if(data.message=="你的帐号已在别处登陆，是否重新登陆"){
                        if(confirm('你的帐号已在别处登陆，是否重新登陆')){
                            $.ajax({
                                url : "{:U('Public/LoginDo')}",
                                type : "POST",
                                data : {
                                    name : $("input[name=name]").val(),
                                    pass :$("input[name=pass]").val(),
                                    nocode : true
                                },
                                success : function (json) {
                                    alert(json.message);
                                    if(json.sign){
                                        window.location.href = json.url;
                                    }else {
                                        window.location.href = "{:U('Index/index')}";
                                    }
                                }
                            })
                        }
                }else{
                    alert(data.message);
                }
                }
            }
        })
        return false;
    }
</script>

<!--<div class="hide_gif">
	<img src="__IMG__/load-index.gif" />
</div>-->
<script type="text/javascript">

    jQuery(document).ready(function ($) {
        $('#reg_user_show').click(function () {
            $('.login-form-mask').fadeIn(100);
            $('#J_regModal').slideDown(200);
        })
        $('.close').click(function () {
            $('.login-form-mask').fadeOut(100);
            $('#J_regModal').slideUp(200);
        })
        $('#memberregister').click(function () {
            $('.login-form-mask').fadeIn(100);
            $('#J_regModal').slideDown(200);
        })
        $('.close').click(function () {
            $('.login-form-mask').fadeOut(100);
            $('#J_loginModal').slideUp(200);
        })
    })
</script>