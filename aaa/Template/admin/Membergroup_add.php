{include file="Public/meta" /}
<title>彩种管理</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
		{present name="info"}
        <input name="id" type="hidden" value="{$info[$_pk]}">
        {/present}
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>会员组名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.groupname}" placeholder="会员组名称" name="groupname">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>头衔：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.touhan}" placeholder="touhan" name="touhan">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>反水设置：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.fanshui}" placeholder="fanshui" name="fanshui">
				<small>0.1 ==返水0.1%</small>
			</div>
		</div>
        <!--
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">大最高投注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.bigmaxtouzhu}" placeholder="大最高投注" name="bigmaxtouzhu"><small>同一期大的最高投注，0不限制<br>如：设置1000元，江苏快3 20161220001期大累计投注金额不得超过1000</small>
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">小最高投注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.smallmaxtouzhu}" placeholder="小最高投注" name="smallmaxtouzhu">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">单最高投注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.oddmaxtouzhu}" placeholder="单最高投注" name="oddmaxtouzhu">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">双最高投注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.evenmaxtouzhu}" placeholder="单最高投注" name="evenmaxtouzhu">
			</div>
		</div>
        -->
        
        
        
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