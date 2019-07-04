{include file="Public/meta" /}
<title>资金变更</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
        <input name="id" type="hidden" value="{$info['id']}">
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">当前余额：</label>
			<div class="formControls col-xs-8 col-sm-9">
				{$info.balance}
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>变动金额：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="变动金额" name="balance">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="账变备注" name="remark">
			</div>
		</div>
        
      
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>变动类型：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="type" type="radio" id="type1" value="1">
					<label for="type-1">手动加</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="type-0" name="type" value="-1">
					<label for="type-0">手动减</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="type-2" name="type" value="-2">
					<label for="type-2">赠送</label>
				</div>
			</div>
		</div>
      
        <div id="zengsongtype"></div>
        
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;确定&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}
<script type="html/text" id="zengsongtypebox">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>赠送类型：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<span class="select-box" style="width:90%"><select class="select" name="zengsongtype">
<?php
$fuddetailtypes = C('fuddetailtypes');
	//or $ft neq 'cancel' or $ft neq 'xima' or $ft neq 'rollback' or $ft neq 'withdraw' or $ft neq 'adminjian'
?>

<option value="">请选择赠送类型</option>
{foreach name="fuddetailtypes" item="ft" key="fk"}
 {if condition="$fk neq 'order' AND $fk neq 'cancel' AND $fk neq 'xima' AND $fk neq 'rollback' AND $fk neq 'withdraw' AND $fk neq 'adminjian' "}
  <option value="{$fk}">{$ft}</option>
 {/if}
{/foreach}
</select></span>
			</div>
		</div>
</script>
<script>
$("input[name='type']").change(function(){
	var val = $(this).val();
	if(val==-2){
		$("#zengsongtype").html($("#zengsongtypebox").html());
	}else{
		$("#zengsongtype").html('');
	}
})
</script>
</body>
</html>