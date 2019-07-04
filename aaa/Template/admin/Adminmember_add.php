{include file="Public/meta" /}
<title>会员添加/修改</title>
</head>
<body>
<article class="page-container">
	<form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
		{present name="info"}
        <input name="id" type="hidden" value="{$info[$_pk]}">
        {/present}
        
        
                
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理组：</label>
			<div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width:150px;">
				
			<select class="select" name="groupid">
				{foreach name="grouplist" item="group"}
                <option value="{$group[groupid]}" {if condition="$group[groupid] eq $info['groupid']"}selected{/if}>{$group[groupname]}</option>
                {/foreach}
			</select>
			</span></div>
		</div>
        
        {present name="info"}
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" style="width:120px;" value="" placeholder="密码" name="password">不修改留空
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>安全码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="number" class="input-text" value="{$info.safecode}" placeholder="安全码" name="safecode">
			</div>
		</div>
        {else /}
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.username}" placeholder="用户名" name="username">
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="密码" name="password">
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>安全码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="number" class="input-text" value="" placeholder="安全码" name="safecode">
			</div>
		</div>
        {/present}
        
        
        
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