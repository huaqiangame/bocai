{include file="Public/meta" /}
<title>资金变更</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
        <input name="id" type="hidden" value="{$info['id']}">
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>彩票返点：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" style="width:100px;" value="{$info.fandian}" placeholder="彩票返点" name="fandian">%
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