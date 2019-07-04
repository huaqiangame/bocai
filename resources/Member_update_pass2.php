<include file="Public/headermember" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/updatePass.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container" >
			<include file="Member/side" />
	<div class="update_pass" style="margin-left:160px; margin-top:1px;">
	<div class="container-fluid">
		<ul class="queue">
			<li class="right">
				<span>验证原密码</span>
				<i class="icon-chenggong iconfont"></i>
			</li>
			<li class="now">
				<span>设置新密码</span>
				<i class="iconfont"></i>
			</li>
			<li>
				<span>完成</span>
				<i class="iconfont"></i>
			</li>
		</ul>
		<form action="{:U('Member/update_pass')}" class="update_form" method="post">
			<input type="hidden" name="settype" value="2" id="settype">
			<p>
				<span>登录密码：</span>
				<input type="password" name="pa1" id="password">
			</p>
			<p>
				<span>重复密码：</span>
				<input type="password" name="password" id="pa1">
			    请牢记新修改的密码!
			</p>
			<button class="btn common_btn save_pass" type="button">提交</button>
		</form>	
	</div>
	</div>
</div>
<script>
    $(function(){
        $('.btn').click(function () {
            $.ajax({
                url : "{:U('member/update_pass')}",
                type : 'POST',
                data : {
                    password:$('#password').val(),
                    pa1:$('#pa1').val(),
                    settype:$('#settype').val(),
                },
                beforeSend : function(){
                    $('#submit').attr('disabled','disabled');
                },
                success : function(json){
                    if(json.code==1){
                        alt(json.msg,1);
                        window.location.href= "{:U('Member/index')}";
                    }else{
                        alt(json.msg,-1);
                    }
                }
            })

        })
    })
</script>
<include file="Public/footer" />
</body>
</html>