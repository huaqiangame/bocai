<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="../Template/admin/resources/ui/lib/html5.js"></script>
    <script type="text/javascript" src="../Template/admin/resources/ui/lib/respond.min.js"></script>
    <script type="text/javascript" src="../Template/admin/resources/ui/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="../Template/admin/resources/ui/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../Template/admin/resources/ui/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="../Template/admin/resources/ui/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../Template/admin/resources/ui/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="../Template/admin/resources/ui/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>{:GetVar('webtitle')}后台管理</title>
</head>
<body>

<div class="loginWraper">
    <div id="loginform" class="loginBox">
        
        <form class="form form-horizontal" action="" method="post">
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="name" name="info[name]" type="text" placeholder="账户" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="pass" name="info[pass]" type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="rzm" name="info[rzm]" type="password" placeholder="安全码" class="input-text size-L">
                </div>
            </div>

            {if condition="GetVar('islogincode') eq 1"}
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe63f;</i></label>
                <div class="formControls col-xs-8">
                    <input id="code" name="info[code]" class="input-text size-L" type="text" placeholder="图像验证码" style="width:150px;">
                    <img id="verifycode" src="{:url('Public/verify',['imageW'=>100,'imageH'=>39,fontSize=>14])}" onclick="this.src=this.src+'?temp='+ 1" title="看不清，换一张"></div>
            </div>
            {/if}

            {if condition="GetVar('isemailcode') eq 1"}
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe70b;</i></label>
                <div class="formControls col-xs-8">
                    <input id="emailcode" name="info[emailcode]" class="input-text size-L" type="text" placeholder="邮箱验证码" style="width:150px;">
                    <input class="btn btn-success radius size-L" id="sencode" onClick="sendcode(this);" type="button" style="margin:0;" value="发送验证码" />
                </div>
            </div>
            {/if}

            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="do" type="submit" class="btn btn-success radius size-L ylogin" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L yres" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>
<!--<div class="footer">Copyright zehuasoft.com </div>-->
<script type="text/javascript" src="../Template/admin/resources/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="../Template/admin/resources/ui/static/h-ui/js/H-ui.js"></script>
<script>
    function sendcode(obj){
        if($("#name").val().length<3){
            alert('用户名/邮箱错误！');$("#name").focus();
            return false;
        }
        if($("#pass").val().length<6){
            alert('密码格式错误！');$("#pass").focus();
            return false;
        }
        $.post("{:U('Public/sendcode')}",{'act':'senddo','username':$("#name").val()}, function(json){
            if(json.status==1){
                alert(json.info);
                settime(obj);
            }else if(json.status==0){
                alert(json.info);
                return false;
            }
        },'json');
    }
    var countdown = countdown1 = parseInt("{:GetVar('adminemailcodetime')}");
    function settime(obj) {
        if (countdown == 0) {
            //obj.removeAttribute("disabled");
            obj.value="发送验证码";
            countdown = countdown1;
            return;
        } else {
            //obj.setAttribute("disabled", true);
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