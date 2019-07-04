{include file="Public/meta" /}
<title>添加字段</title>
</head>
<body>
<?php
$tbname = $_REQUEST['tbname'];
?>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
		{present name="info"}
        <input name="id" type="hidden" value="{$info[$_pk]}">
        {/present}
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>数据表：</label>
			<div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width:150px;">
				
			<select class="select" name="tbname" {present name="info"}disabled readonly{/present}>
				{foreach name="tblist" item="tb"}
                <option value="{$tb['name']}" {if condition="($info[tbname] eq $tb['name']) or ($tb['name'] eq $tbname)"}selected{/if}>{$tb['title']}</option>
                {/foreach}
			</select>
			</span></div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>字段标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.title}" placeholder="字段标题" name="title">
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>字段名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.name}" placeholder="字段名称 如标题：title" name="name"  {present name="info"}disabled readonly{/present}>
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>字段类型：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box" style="width:150px;">
				
                    <select class="select" name="fieldtype" onchange="javascript:field_setting(this.value);" {present name="info"}disabled readonly{/present}>
                        {foreach name="fieldtypes" item="ftv" key="ftk"}
                        <option value="{$ftk}" {if condition="$info[fieldtype] eq $ftk"}selected{/if}>{$ftv}</option>
                        {/foreach}
                    </select>
                </span>
                <span>
                长度：<input type="number" class="input-text" value="{$info.length}" placeholder="字段长度" name="length" style="width:100px;"  {present name="info"}disabled readonly{/present}>
                </span>
			</div>
		</div>
        
        <div id="setting"></div>
		
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">字段备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.remark}" placeholder="备注" name="remark">
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">是否标题字段：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="istitle" type="radio" id="istitle-1" value="1" {if condition="$info[istitle] eq 1"}checked{/if}>
					<label for="istitle-1">是</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="istitle-0" name="istitle" value="0" {if condition="$info[istitle] eq 0"}checked{/if}>
					<label for="istitle-0">否</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">列表显示：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="islist" type="radio" id="islist-1" value="1" {if condition="$info[islist] eq 1"}checked{/if}>
					<label for="issys-1">是</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="islist-0" name="islist" value="0" {if condition="$info[islist] eq 0"}checked{/if}>
					<label for="islist-0">否</label>
				</div>
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
<script type="text/html" id="boxtpl">
<table class="table table-border table-bg" cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td width="100">选项列表</td>
      <td><textarea name="setting[options]" class="textarea" id="options" placeholder="选项名称1|选项值1">{$setting['options']}</textarea></td>
    </tr>
</table>
</script>

<script type="text/html" id="downfilebox">
<table class="table table-border table-bg" cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td width="130">允许的文件类型</td>
      <td><input type="text" class="input-text" style="max-width:160px" value="<?=$setting['upload_allowext']?:'gif|jpg|jpeg|png|bmp'?>" name="setting[upload_allowext]"></td>
    </tr>
	<tr> 
      <td>单文件最大(M)</td>
      <td><input type="text" class="input-text" style="max-width:160px" value="{$setting['upload_size']?:2}" name="setting[upload_size]"></td>
    </tr>
	<tr> 
      <td>允许同时上传的个数</td>
      <td><input type="text" class="input-text" style="max-width:160px" value="{$setting['upload_number']?:1}" name="setting[upload_number]"></td>
    </tr>
	<tr> 
      <td>附件下载方式</td>
      <td>
	  <input type="radio" value="0" name="setting[downloadtype]" {if condition="$setting[downloadtype] eq '0'"}checked{/if}> 链接文件地址 
	  <input type="radio" value="1" name="setting[downloadtype]" {if condition="$setting[downloadtype] eq '1'"}checked{/if}> 通过PHP读取
	  </td>
    </tr>
</table>
</script>
<script type="text/javascript">
field_setting($("select[name='fieldtype']").val());
function field_setting(fieldtype) {
	var setting = '';
	if(fieldtype=='select' || fieldtype=='checkbox' || fieldtype=='radio'){
		setting = $("#boxtpl").html();
	}else if(fieldtype=='downfile' || fieldtype=='downfiles'){
		setting = $("#downfilebox").html();
	}else{
		setting = '';
	}
	var html = '<div class="row cl">'
				+'<label class="form-label col-xs-4 col-sm-3">相关参数：</label>'
				+'<div class="formControls col-xs-8 col-sm-9">'
				+setting+'</div></div>';
	if(setting!=''){
		$('#setting').html(html);
	}else{
		$('#setting').html('');
	}
};


</script>

</body>
</html>