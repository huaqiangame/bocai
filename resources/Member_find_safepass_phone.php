<include file="Public/headermember" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/updatePass.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">

	<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
			<include file="Member/side" />
	<div class="pull-right vip_info_pan">
	<div class="container-fluid" style="background: #e8e8e8;">
		<ul class="queue">
			<li class="right">
				<span>选择验证方式</span>
				<i class=" iconfont  icon-chenggong"></i>
			</li>
			<li class="now">
				<span>身份验证</span>
				<i class=" iconfont "></i>
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
		<form action="{:U('Member/find_safepass_phone')}" class="update_form" method="post">
			<p>
				<span>手机号：</span>
				<input type="text" name="tel" placeholder="请输入你绑定的手机号码" value="">
			</p>
<!--			<p>
				<span>验证码：</span>
				<input type="text" class="test_code" />
				<a href="" class="get_code">获取验证码</a>
			</p>-->
			<button class="btn common_btn save_pass" type="submit">提交</button>
		</form>	
	</div>
	</div>
</div>	
<include file="Public/footer" />

<!--	<div class="modal fade update_pass_success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
	      </div>
	      <div class="modal-body">
	        手机绑定成功
	      </div>
	      <div class="modal-footer">
	        <a href="securityCenter.html" class="btn common_btn">确定</a>
	      </div>
	    </div>
	  </div>
	</div>-->
</body>
</html>