{include file="Public/meta" /}
<title>资金变更</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
        <input name="id" type="hidden" value="{$info['id']}">
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">提款会员：</label>
			<div class="formControls col-xs-8 col-sm-9">
				{$info.username}
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">提款余额：</label>
			<div class="formControls col-xs-8 col-sm-9">
				{$info.amount}
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>订单状态：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
				  <input type="radio" id="state-0" name="state" value="0" {if condition="$info['state'] eq 0"}checked{/if}>
				  <label for="type-0">未审核</label>
				</div>
				<div class="radio-box">
				  <input type="radio" id="state-1" name="state" value="1" {if condition="$info['state'] eq 1"}checked{/if}>
				  <label for="type-1">审核通过</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="state-2" name="state" value="-1"  {if condition="$info['state'] eq -1"}checked{/if}>
					<label for="type-2">退回取消</label>
				</div>
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.remark}" placeholder="订单备注" name="remark">
			</div>
		</div>
        
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;确定&nbsp;&nbsp;">
			</div>
		</div>
      
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-2 col-sm-offset-2">
				<blockquote>
					<small>提款状态未<span style="color:red">未审核</span>时，才可以操作</small>
					<small>状态设置<span style="color:red">退回/取消</span>时，提款金额将同时退回会员账户</small>
				</blockquote>
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}

</body>
</html>