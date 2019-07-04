{include file="Public/meta" /}
<title>修改银行信息</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
        <input name="id" type="hidden" value="{$info['id']}">
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属银行：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.bankname}" placeholder="所属银行" name="bankname">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>开户网点：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.bankbranch}" placeholder="开户网点" name="bankbranch">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>省份：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.sheng}" placeholder="开户省份" name="sheng">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>城市：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.city}" placeholder="开户城市" name="city">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>银行卡号：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.banknumber}" placeholder="banknumber" name="banknumber">
			</div>
		</div>
        
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否默认：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="isdefault" type="radio" id="isdefault-1" value="1" {if condition="$info['isdefault'] eq 1"}checked{/if}>
					<label for="isdefault-1">默认</label>
			  </div>
				<div class="radio-box">
					<input type="radio" id="isdefault-0" name="isdefault" value="0" {if condition="$info['isdefault'] eq 0"}checked{/if}>
					<label for="isdefault-0">否</label>
				</div>
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input {if condition="$info['state'] eq 0"}checked{/if} name="state" type="radio" id="state-0" value="0">
					<label for="state-0">审核中</label>
				</div>
				<div class="radio-box">
					<input {if condition="$info['state'] eq 1"}checked{/if} name="state" type="radio" id="state-1" value="1">
					<label for="state-1">已审</label>
				</div>
				<div class="radio-box">
				  <input type="radio" id="state-2" name="state" value="2" {if condition="$info['state'] eq 2"}checked{/if}>
				  <label for="state-2">驳回</label>
				</div>
			</div>
		</div>
        
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;确定&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}

</body>
</html>