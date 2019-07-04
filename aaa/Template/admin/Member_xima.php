{include file="Public/meta" /}
<title>洗码余额变更</title>
</head>
<body>
<article class="page-container">
	<form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
        <input name="id" type="hidden" value="{$info['id']}">
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">当前洗码余额：</label>
			<div class="formControls col-xs-8 col-sm-9">
				{$info.xima}
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>洗码余额：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="洗码余额" name="xima">
			</div>
		</div>
        
      
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>变动类型：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="type" type="radio" id="type-1" value="1">
					<label for="type-1">加</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="type-0" name="type" value="-1">
					<label for="type-0">减</label>
				</div>
			</div>
		</div>
        
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;确定&nbsp;&nbsp;">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-2 col-sm-offset-2">
				<blockquote><small>洗码余额是会员是否可提现依据，打码余额账户=等额=会员充值金额，每投注1元洗码余额减少1元，当洗码余额为0时可以提现</small></blockquote>
			</div>
		</div>
	</form>
    
</article>

{include file="Public/footer" /}

</body>
</html>