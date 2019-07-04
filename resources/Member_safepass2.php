<include file="Public/headermember" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/updatePass.css">
	<link rel="stylesheet" href="__CSS2__/securityCenter.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
	<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
			<include file="Member/side" />
	<div class="update_pass" style="margin-left:160px; margin-top:1px;">
	<div class="container-fluid" style="background: #e8e8e8;">
			<ul class="queue">
				<li class="right">
					<span>验证原始资金密码</span>
					<i class="iconfont icon-chenggong"></i>
				</li>
				<li class="now">
					<span>修改密码资金密码</span>
					<i class=" iconfont "></i>
				</li>
				<li class="">
					<span>完成</span>
					<i class="iconfont"></i>
				</li>
			</ul>
		<form action="{:U('Member/update_safepass')}" class="update_form" method="post">
			<input type="hidden" name="settype" value="2">
			<p>
				<span>资金密码：</span>
				<input type="password" name="password">
			</p>
			<p>
				<span>确认密码：</span>
				<input type="password" name="pa1">
				请牢记新修改的资金密码!
			</p>
			<button class="btn common_btn save_pass" type="submit">提交</button>
		</form>
	</div>
	</div>
</div>
<!--
	<div class="modal fade update_pass_success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
	      </div>
	      <div class="modal-body">
	        修改成功
	      </div>
	      <div class="modal-footer">
	        <a href="securityCenter.html" class="btn common_btn">确定</a>
	      </div>
	    </div>
	  </div>
	</div>-->

<include file="Public/footer" />
</body>
</html>