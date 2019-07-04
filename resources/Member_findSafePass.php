<include file="Public/headermember" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/updatePass.css">
	<link rel="stylesheet" href="__CSS2__/securityCenter.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
			<include file="Member/side" />
	<div class="pull-right vip_info_pan">
	        <div class="vip_info_title">
            找回资金密码
        </div>
	<div class="container-fluid" style="background: #e8e8e8;margin-top:10px;">
		<ul class="queue">
			<li class="now">
				<span>选择验证方式</span>
				<i class=" iconfont"></i>
			</li>
			<li>
				<span>身份验证</span>
				<i class=" iconfont"></i>
			</li>
			<li>
				<span>修改密码</span>
				<i class=" iconfont"></i>
			</li>
			<li class="">
				<span>完成</span>
				<i class="iconfont"></i>
			</li>
		</ul>
		<ul class="set_list bankPass_list">
			<li class="clearfix">
				<span class="iconfont success">&#xe60f;</span>
				<div class="set_list_column">
					<strong>通过资金密码</strong>
					<em>资金密码用于提现、绑定银行卡等操作，可保障资金安全。</em>
				</div>
				<a class="set_btn pull-right" href="{:U('Member/update_safepass')}">立即找回</a>
			</li>
			<li class="clearfix">
				<span class="iconfont <notempty name="userinfo.tel">success</notempty>"></span>
				<div class="set_list_column">
					<strong>通过密保手机</strong>
					<em>密保手机可以增加账户安全性，快速找回帐号密码。</em>
				</div>
				<a class="set_btn pull-right" href="{:U('Member/find_safepass_phone')}">立即找回</a>
			</li>
<!--			<li class="clearfix">
				<span class="iconfont <notempty name="userinfo.question">success</notempty>"></span>
				<div class="set_list_column">
					<strong>通过密保问题</strong>
					<em>密保问题可以增加账户安全性，快速找回帐号密码。</em>
				</div>
				<a class="set_btn pull-right" href="{:U('Member/find_safepass_problem')}">立即找回</a>
			</li>-->
			<li class="clearfix">
				<span class="iconfont <notempty name="userinfo.email">success</notempty>"></span>
				<div class="set_list_column">
					<strong>通过密保邮箱</strong>
					<em>密保邮箱可以增加账户安全性，快速找回帐号密码。</em>
				</div>
				<a class="set_btn pull-right" href="{:U('Member/find_safepass_email')}">立即找回</a>
			</li>
			<!--<li class="clearfix">
				<span class="iconfont <notempty name="userinfo.qq">success</notempty>"></span>
				<div class="set_list_column">
					<strong>通过密保QQ</strong>
					<em>密保QQ可以增加账户安全性，快速找回帐号密码。</em>
				</div>
				<a class="set_btn pull-right" href="{:U('Member/find_safepass_qq')}">立即找回</a>
			</li>-->
		</ul>
	</div>
	</div>
	</div>
<include file="Public/footer" />
<script>
	$(function () {
		$('.set_list a').each(function (i) {
			$(this).hover(function () {
				$(this).css('background-color','#2E4158').css('color','#fff');
			},function () {
				$(this).css('background-color','#fff').css('color','#666');
			});
			$(this).click(function(){
			   if($(this).parent().find('span').hasClass('success')){
				   return true;
			   }else{
				   return false;
			   }
			})
		})
	})
</script>
</body>
</html>