<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>站内信</title>
	<meta name="keywords" content="关键字">
	<meta name="description" content="网站主要内容">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" > 
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/header.css">
	<link rel="stylesheet" href="__CSS2__/stationMail.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" href="__JS2__/layer/skin/default/layer.css">
	
</head>
<body>
<include file="Public/headermember" />
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
	<div class="vip_info clearfix container">
		<include file="Member/side" />
		<div class="pull-right vip_info_pan">
			<div class="vip_info_title">
				站内信
			</div>
			<div class="vip_info_content stationMail_main">
				<table class="table">
					<thead>
						<tr>
							<th>主题</th>
							<th>发件人</th>
							<th>时间</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>不知道</td>
							<td>对对对</td>
							<td>201231230</td>
						</tr>
					</tbody>
				</table>
				<div class="no_result" style="display:none;">
					暂无记录
				</div>
				<ul class="pagination bet_paging" >
					<li><a href="">上一页</a></li>
					<li class="active"><a href="">1</a></li>
					<li><a href="">2</a></li>
					<li><a href="">3</a></li>
					<li><a href="">4</a></li>
					<li><a href="">下一页</a></li>
					<li><a href="">共 <em class="color_res">0</em> 页</a></li>
				</ul>
				<div class="main_operation">
					<div class="checkbox">
						<label>
							<input type="checkbox"> 全选
						</label>
					</div>
					<a href="" class="sign">标记已读</a>
					<a href="" class="dellete">删除</a>
				</div>
				<div class="prompt">
					<i class="iconfont"></i>
					温馨提示：系统将自动清空5天前的用户消息记录。
				</div>
			</div>
		</div>
	</div>
<include file="Public/footer" />

<!--	<div class="modal fade is_set_security" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
	      </div>
	      <div class="modal-body">
	        您还未设置资金密码，请先设置资金密码?
			<div>（资金密码用于提现等操作，可保障资金安全）</div>
	      </div>
	      <div class="modal-footer">
	        <a href="setSecurity.html" class="btn btn-default login_btn">确认</a>
	        <a href="" class="btn btn-default register_btn">取消</a>
	      </div>
	    </div>
	  </div>
	</div>-->
</body>
</html>