{include file="Public/meta" /}

<title>单页管理</title>
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" method="post" id="AjaxPostForm">
        <input name="catid" type="hidden" value="{$catid}">
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
            	<?php
                $_tags = [];
                $_tags = [
					'name'   => 'title',
					'id'     => 'title',
					'class'  => 'input-text',
				];
				echo $_Form->input($_tags,$info['title']);
				?>
                
                
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
            	<?php
                $_tags = [];
                $_tags = [
					'name'   => 'content',
					'id'     => 'content',
					'class'  => 'input-text',
				];
				echo $_Form->editor($_tags,$info['content']);
				?>
                
                
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				<button class="btn btn-default radius" type="reset">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>


</article>

{include file="Public/footer" /}
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>