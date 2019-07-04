{include file="Public/meta" /}
<title>资金变更</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
        <input name="id" type="hidden" value="{$info['id']}">
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">会员昵称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				{$info.username}
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">反水金额：</label>
			<div class="formControls col-xs-8 col-sm-9">
				{$info.amount} 元
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>反水状态：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
				  <input type="radio" id="shenhe-0" name="shenhe" value="0" {if condition="$info['shenhe'] eq 0"}checked{/if}>
				  <label for="type-0">未审核</label>
				</div>
				<div class="radio-box">
				  <input type="radio" id="shenhe-1" name="shenhe" value="1" {if condition="$info['shenhe'] eq 1"}checked{/if}>
				  <label for="type-1">审核通过</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="shenhe-2" name="shenhe" value="-1"  {if condition="$info['shenhe'] eq -1"}checked{/if}>
					<label for="type-2">审核未通过</label>
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
					<small>反水状态未<span style="color:red">未审核</span>时，才可以操作</small>
					<small>状态设置<span style="color:red">审核未通过</span>时，将不作任何操作</small>
				</blockquote>
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}

</body>
</html>