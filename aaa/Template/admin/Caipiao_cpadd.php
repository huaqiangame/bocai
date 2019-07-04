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
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>彩票分类：</label>
			<div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width:150px;">
				
			<select class="select" name="typeid">
				{foreach name="cpcategory" item="cptype" key="cpk"}
                <option value="{$cpk}" {if condition="$info[typeid] eq $cpk"}selected{/if}>{$cptype}</option>
                {/foreach}
			</select>
			</span></div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>彩种名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.title}" placeholder="彩种名称" name="title">
			</div>
		</div>
        {notpresent name="info"}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>彩种标示(唯一值)：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.name}" placeholder="彩种标示 如cqssc" name="name">
			</div>
		</div>
        {/notpresent}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>停止投注间隔：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info['ftime']}" placeholder="停止投注间隔" name="ftime">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>期数：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info['qishu']}" placeholder="期数" name="qishu">
			</div>
		</div>
		<!--		<div class="row cl">
                    <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>开始时间：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="{$info['firsttime']}" placeholder="开始时间" name="firsttime">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>结束时间：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="{$info['endtime']}" placeholder="结束时间" name="endtime">
                    </div>
                </div>-->
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">彩种简介：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.ftitle}" placeholder="彩种简介" name="ftitle">
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>彩票类型：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="issys" type="radio" id="issys-1" value="1" {if condition="$info[issys] eq 1"}checked{/if}>
					<label for="issys-1">系统彩票</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="issys-0" name="issys" value="0" {if condition="$info[issys] eq 0"}checked{/if}>
					<label for="issys-0">第三方平台</label>
				</div>
			</div>
		</div>
        
        <div id="xitongcaisetbox"></div>
        
        
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}
<script type="html/text" id="xitongcaiset">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">时间段设置：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="formControls col-xs-6 col-sm-12">
					<label for="checkbox-5">关盘开始时间</label><input type="text" class="input-text" value="{$info['closetime1']?$info['closetime1']:'00:00:00'}" onFocus="WdatePicker({dateFmt:'HH:mm'})" name="closetime1">
				</div>
				<div class="formControls col-xs-6 col-sm-12">
					<label for="checkbox-5">关盘结束时间</label><input type="text" class="input-text" value="{$info['closetime2']?$info['closetime2']:'00:00:00'}" onFocus="WdatePicker({dateFmt:'HH:mm'})" name="closetime2">
				</div>
				
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">开奖时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box"><select class="select" name="expecttime">
                <option value="0">==选择开奖时间==</option>
                <option value="1" {if condition="$info['expecttime'] eq '1'"}selected{/if}>1分钟一期</option>
                <option value="2" {if condition="$info['expecttime'] eq '2'"}selected{/if}>2分钟一期</option>
                <option value="3" {if condition="$info['expecttime'] eq '3'"}selected{/if}>3分钟一期</option>
                <option value="5" {if condition="$info['expecttime'] eq '5'"}selected{/if}>5分钟一期</option>
                <option value="10" {if condition="$info['expecttime'] eq '10'"}selected{/if}>10分钟一期</option>
                </select></span>
			</div>
		</div>
</script>
<script>
$(function(){
	$("input[name='issys']").change(function(){
		xitongcaiset($("input[name='issys']:checked").val());
	});
	xitongcaiset($("input[name='issys']:checked").val());
})
function xitongcaiset(type){
	if(type==1){
		$("#xitongcaisetbox").html($("#xitongcaiset").html());
	}else{
		$("#xitongcaisetbox").html('');
	}
}
</script>
</body>
</html>