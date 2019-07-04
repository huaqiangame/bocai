{include file="Public/meta" /}

</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
        <input name="id" type="hidden" value="{$info['id']}">
        <input name="activity_id" type="hidden" value="{$info['activity_id']}">
        <input name="member_id" type="hidden" value="{$info['member_id']}">
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">用户会员：</label>
			<div class="formControls col-xs-8 col-sm-9">
				{$info.username}
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">赠送比例：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{$info.rate}"  name="rate">
            </div>
        </div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">赠送基础余额：</label>
			<div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{$info.direct_money}"  name="direct_money">
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
				  <input type="radio" id="state-1" name="states" value="2" >
				  <label for="type-1">审核通过</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="state-2" name="states" value="3"  >
					<label for="type-2">审核不通过</label>
			  </div>
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="备注" name="fail_reason">
			</div>
		</div>
        
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;确定&nbsp;&nbsp;">
			</div>
		</div>
      
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-2 col-sm-offset-2">
				<blockquote><small>审核通过则将充值金额存入会员账户,审核之后的状态不可修改</small></blockquote>
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}

</body>
</html>