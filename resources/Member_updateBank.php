<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>{:GetVar('webtitle')}</title>
	<meta name="keywords" content="{:GetVar('keywords')}" />
	<meta name="description" content="{:GetVar('description')}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >

	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/header.css">
	<link rel="stylesheet" href="__CSS2__/updatePass.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" href="__JS2__/layer/skin/default/layer.css">
	<link rel="stylesheet" href="http://at.alicdn.com/t/font_bnvu6xzx1198uxr.css">


</head>
<body>
<include file="Public/header" />
	<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
	<div class="update_pass">
	<div class="container-fluid">
		<form action="" class="update_form" style="margin-top:50px;">
			<div class="clearfix drop_menu" style="margin-bottom:22px;">
				<div>
				<span class="">开户银行：</span>
				<div class="form-group">
					<select name="bankname" id="" class="form-control">
						<option  value="0">请选择银行</option>
						 {$UserBank[0]['bankstr']}
					</select>
				</div>
				</div>
			</div>
			<div class="clearfix drop_menu" style="margin-bottom:12px;">
				<div>
				<span class="">开户城市：</span>
				<div class="form-group s_group clearfix">
					<select id="s_province" class="pull-left" name="s_province" data-shen="{$UserBank[0]['province']}"></select>  
					<select id="s_city" class="pull-right" name="s_city" data-shi="{$UserBank[0]['city']}"></select>  
				</div>
				</div>
			</div>
			<div class="clearfix drop_menu">
			<div class="clearfix drop_menu">				
				<div class="answer">
					<span>开户人姓名：</span>
					<input type="text" name="" value="{$UserBank[0]['accountname']}">
				</div>
			</div>
			</div>
			<div class="clearfix drop_menu">
			<div class="answer">
					<span>银行卡号：</span>
					<input type="text" name="banknumber" value="{$UserBank[0]['banknumber']}">
			</div>
			</div>
			<div class="clearfix drop_menu">
			<div class="answer">
				<span>确认卡号：</span>
				<input type="text" name="banknumber" value="{$UserBank[0]['banknumber']}">
			</div>
			</div>
			<div class="clearfix drop_menu">
			<div class="answer">
					<span>资金密码：</span>
					<input type="text" name="safepass">
			</div>
			</div>
			<button class="btn common_btn save_pass" type="button">提交</button>
		</form>	
	</div>
	</div>
<include file="Public/footer" />
<!--
	<div class="modal fade update_pass_success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
	      </div>
	      <div class="modal-body">
	        绑定成功
	      </div>
	      <div class="modal-footer">
	        <a href="bankCard.html" class="btn common_btn">确定</a>
	      </div>
	    </div>
	  </div>
	</div>
-->

</body>
</html>