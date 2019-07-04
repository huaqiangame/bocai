{include file="Public/meta" /}
<title>修改密码</title>
</head>
<body>
<article class="page-container">
	<form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
		{present name="info"}
        <input name="id" type="hidden" value="{$info[$_pk]}">
        {/present}
        
        <input type="hidden" name="type" value="{$type}">
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">{$passtext}：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text"  value="" placeholder="{$passtext}" name="oldpassword">
			</div>
		</div>
        {if condition="$type eq 'pass'"}
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">新密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"  value="" placeholder="密码" name="password">
			</div>
		</div>
        {elseif condition="$type eq 'safecode'" /}
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">新安全码：<br><small>(4-7位数字)</small></label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text"  value="" placeholder="安全码" name="safecode" style="width:100px;">
			</div>
		</div>
        {/if}
        
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;确定修改&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}

</body>
</html>