<include file="Public/header2" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
<header data-am-widget="header"class="am-haomalan am-header-default header nav_bg am-header-fixed">
    <div class="am-header-left am-header-nav" style="top:0.7em;">
        <a href="{:U('Index/index')}" class="" style="text-decoration:none;">
            <i class="iconfont icon-arrow-left"></i>
        </a>
    </div>
    <div class="loginlogo" style="text-align:right; padding-top:5px;">
        <img src="__IMG__/logo.png" width="145" height="40">
    </div>
</header>

<div class="bank_recharge" style="z-index:9999;margin: 0;width:100%;position:absolute;top:48px;"> 
    <form method="post" class="ruivalidate_form_class" onSubmit="return check_login(this)" id="form1" checkby_ruivalidate url="" action="{:U('Public/logindo')}">
        <ul class="bank_form_list">
            <li class="am-cf">
                <span class="bank_form_left am-fl">账　号</span>
                <div class="am-fr bank_right_input">
                    <input type="text" class="input_txt" name="name" placeholder="请输入账号">
                </div>
            </li>
            <li class="am-cf">
                <span class="bank_form_left am-fl">密　码</span>
                <div class="am-fr bank_right_input">
                    <input type="password" name="pass" class="input_txt" placeholder="请输入密码">
                </div>
            </li>
        </ul>
		<p class="bank_left"><a  href="{:GetVar('mobile_kefuthree')}">在线客服</a></p>
        <p class="bank_pass"><a  href="{:U('Public/forgetPaw')}">忘记密码</a></p>
        <button style="margin-top:0.1rem;margin-bottom: 0px;" class="am-btn am-btn-danger am-radius am-btn-block" type="submit">立即登录</button>
       <a  href="{:U('Public/register')}" class="am-btn am-btn-danger am-radius am-btn-block " style="margin-top:20px;margin-bottom: 0px;">立即注册</a>
    </form>
</div>
<script>
    function check_login(obj) {
        $.ajax({
            url : "{:U('Public/LoginDo')}",
            type : 'POST',
            data : $("#form1").serialize(),
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
                                    nocode : true,
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
</body>
</html>