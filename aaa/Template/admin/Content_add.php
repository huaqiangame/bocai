{include file="Public/meta" /}

<title>信息管理</title>
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" method="post" id="AjaxPostForm">
        <input name="catid" type="hidden" value="{$catid}">
		{present name="info"}
        <input name="id" type="hidden" value="{$info[id]}">
        {/present}
        {notpresent name="info"}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">选择栏目：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px; background:#fff; text-align:center; margin:0 auto">
				<select class="select" onChange="javascipt:if(this.value){window.location.href=this.value}">
					<option value="0">==选择栏目==</option>
					{volist name="catelist" id="cat"}
                    <option value="{:url('add',['catid'=>$cat['catid']])}" {if condition="$cat['catid'] eq $catid"}selected{/if} {if condition="$cat['catetype'] neq 1"}disabled{/if}>{$cat['catname']}</option>
                    {/volist}
				</select>
				</span> </div>
		</div>
        {/notpresent}
        {volist name="showfields" id="vo"}
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">{$vo.title}：</label>
			<div class="formControls col-xs-8 col-sm-9">
            	<?php
				$_fun = '';
				$_fun = $vo['fieldtype'];
                $_tags = [];
                $_tags = [
					'name'   => $vo['name'],
					'id'     => $vo['name'],
					'class'  => $vo['fieldtype']=='textarea'?'textarea':'input-text',
					'setting'=> unserialize($vo['setting']),
				];
				echo method_exists($_Form,$_fun)?$_Form->$_fun($_tags,$info[$vo['name']]):$_fun.'表单方法未定义';
				?>
                
                
			</div>
		</div>
        {/volist}
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