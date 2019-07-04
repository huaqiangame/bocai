{include file="Public/meta" /}
<title>彩种管理</title>
</head>
<body>
<article class="page-container">
<p style="background: #eee;border: 1px dashed #f60;padding: 5px;">
此功能针对没有采集到开奖号码时使用
<br>开奖期号请按平台的期号规则添加
<br>如：江苏快3 2016-12-01 第一期 期号：20161201001（除北京快3）
</p>
    
    
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
		{present name="info"}
        <input name="id" type="hidden" value="{$info[$_pk]}">
        {/present}
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>选择彩票：</label>
			<div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width:150px;">
				
			<select class="select" name="name">
{foreach name="cpcategory" item="cptype" key="cpk"}
<optgroup label="{$cptype}">
    {volist name="cplist" id="cpv"}
    {if condition="$cpk eq $cpv['typeid']"}
    <option value="{$cpv['name']}" {if condition="$cpv['name'] eq $name"}selected{/if}>{$cpv.title}</option>
    {/if}
    {/volist}
</optgroup>
{/foreach}
			</select>
			</span></div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>开奖期号：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="如：20161214001" name="expect">
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>开奖号码：<br><small>英文逗号隔开</small></label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="开奖号码 如1,2,3" name="opencode">
			</div>
		</div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">开奖时间：<br><small>留空则已系统当前时间为准无影响</small></label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="如：2016-12-12 10:00:00" name="opentime">
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