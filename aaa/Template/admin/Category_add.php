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
			<label class="form-label col-xs-4 col-sm-3">上级栏目：</label>
			<div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width:150px;">
			<select class="select" name="parentid">
                <option value="0">顶级栏目</option>
                {foreach name="treelist" item="pd"}
                <option value="{$pd['catid']}" {if condition="$info[parentid] eq $pd['catid']"}selected{/if}>{$pd.spacer}{$pd['catname']}</option>
                {/foreach}
			</select>
			</span></div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>栏目名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.catname}" placeholder="栏目名称" name="catname">
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>栏目类型：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="catetype" type="radio" id="catetype-1" value="1" {if condition="$info[catetype] eq 1"}checked{/if} {notpresent name="info"}checked{/notpresent}>
					<label for="catetype-1">正常</label>
				</div>
				<div class="radio-box">
					<input name="catetype" type="radio" id="catetype-2" value="2" {if condition="$info[catetype] eq 2"}checked{/if}>
					<label for="catetype-2">单页</label>
				</div>
				<div class="radio-box">
					<input name="catetype" type="radio" id="catetype-3" value="3" {if condition="$info[catetype] eq 3"}checked{/if}>
					<label for="catetype-3">外部链接</label>
				</div>
			</div>
		</div>
                
        
        <div id="showtypetpl"></div>
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}

<script type="text/html" id="catetype_1">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">绑定模型：</label>
			<div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width:150px;">
			<select class="select" name="model" {present name="info"}disabled readonly{/present}>
                {foreach name="modulelist" item="md" key="mdk"}
                <option value="{$md['name']}" {if condition="$info[model] eq $md['name']"}selected{/if}>{$md['title']}</option>
                {/foreach}
			</select>
			</span></div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">列表模版：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.listtpl}" placeholder="列表模版" name="listtpl">
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">内容页模版：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.showtpl}" placeholder="内容页模版" name="showtpl">
			</div>
		</div>
</script>

<script type="text/html" id="catetype_2">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">单页模版：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.pagetpl}" placeholder="单页模版" name="pagetpl">
			</div>
		</div>
</script>

<script type="text/html" id="catetype_3">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">外部链接：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.url}" placeholder="外部链接" name="url">
			</div>
		</div>
</script>
<script>
$(function(){
	var tplid = $("input[name='catetype']:checked").val();
	changetypetpl(tplid);
});
$("input[name='catetype']").change(function(){
	var tplid = $("input[name='catetype']:checked").val();
	changetypetpl(tplid);
})
function changetypetpl(tplid){
	var html = $("#catetype_"+tplid).html();
	$("#showtypetpl").html(html);
}
</script>
</body>
</html>