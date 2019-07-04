<include file="Public/headermember" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/updatePass.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
			<include file="Member/side" />
	<div class="update_pass" style="margin-left:160px; margin-top:1px;">
	<div class="container-fluid" style="background: #e8e8e8;">
		<ul class="queue">
			<li class="now">
				<span>绑定新手机</span>
				<i class=" iconfont"></i>
			</li>
			<li class="">
				<span>完成</span>
				<i class="iconfont"></i>
			</li>
		</ul>
		<form action="{:U('Member/safephone')}" class="update_form" method="post">
			<p>
				<span>手机号：</span>
				<input type="text" name="tel" value="{$userinfo.tel}"> 绑定后修改需联系客服!
			</p>
			<!--<p>
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