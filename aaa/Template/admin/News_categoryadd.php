{include file="Public/meta" /}
<title>添加栏目</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
		{present name="info"}
        <input name="id" type="hidden" value="{$info[$_pk]}">
        {/present}
        
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级栏目：</label>
			<div class="formControls col-xs-8 col-sm-9">
    	<span class="select-box inline">
            <select name="parentid" class="select">
                <option value="0">==选择栏目==</option>
                {volist name="catelist" id="cat"}
                <option value="{$cat.id}" {if condition="$cat['id'] eq $info['parentid']"}selected{/if} >{$cat.spacer}{$cat.catname}</option>
                {/volist}
            </select>
		</span>
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>栏目名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.catname}" placeholder="栏目名称" name="catname">
			</div>
		</div>
        
        
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}

</body>
</html>