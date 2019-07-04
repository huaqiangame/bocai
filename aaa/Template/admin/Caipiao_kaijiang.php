{include file="Public/meta" /}
<style>
.border-danger-outline{
	border:1px solid #dd514c;
}
.border-success-outline{
	border:1px solid #5eb95e;
}
</style>
<title>彩种a管理</title>
</head>
<body>
<nav class="breadcrumb">
<span class="l">
<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
<span class="select-box clearfix" style="width:150px; background:#fff; text-align:center; margin:0 auto"><select class="select" onChange="javascipt:window.location.href=this.value">
{foreach name="cpcategory" item="cptype" key="cpk"}
<optgroup label="{$cptype}">
    {volist name="cplist" id="cpv"}
    {if condition="$cpk eq $cpv['typeid']"}
    <option value="{:url('kaijiang',['name'=>$cpv['name']])}" {if condition="$cpv['name'] eq $name"}selected{/if}>{$cpv.title}</option>
    {/if}
    {/volist}
</optgroup>
{/foreach}
</select></span>
期号：<input class="input-text" type="text" style="width:100px;" value="{$expect}" name="expect">
<input type="hidden" name="name" value="{$name}">
<input class="btn btn-default-outline radius" type="submit" value="查询">
</form>
&nbsp;&nbsp;&nbsp;</span>
&nbsp;&nbsp;&nbsp;<a href="javascript:;" layer-url="{:U('kaijiangadd')}" title="添加开奖" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加开奖</a>
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="60">彩种</th>
				<th width="60">期号</th>
				<th width="120">开奖号码</th>
				<th width="120">开奖时间</th>
				<th width="60">来源</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="olist" id="vo"}
            <tr class="text-c">
				<td><input type="checkbox" class="checkids" value="{$vo.id}" name="ids[{$vo.id}]"></td>
				<td>{$cptitle}</td>
				<td>{$vo.expect}<input id="expect-{$vo.id}" defaultValue="{$vo.expect}" class="input-text" readonly type="hidden" style="width:160px" name="" value="{$vo.expect}"></td>
				<td><input id="opencode-{$vo.id}" defaultValue="{$vo.opencode}" class="input-text input-change" type="text" style="width:160px" name="" value="{$vo.opencode}"></td>
				<td><input id="opentime-{$vo.id}" defaultValue="{$vo.opentime|date='Y-m-d H:i:s',###}" class="input-text input-change" type="text" style="width:160px" name="" value="{$vo.opentime|date='Y-m-d H:i:s',###}"></td>
				<td>{$vo.source}</td>
				<td class="td-manage">
                <button onClick="baocun({$vo.id});" class="btn btn-secondary-outline radius size-S" type="button">保存</button>
                <button onClick="chongzhi({$vo.id});" class="btn btn-secondary-outline radius size-S" type="button">重置开奖</button>
                </td>
			</tr>
            {/volist}
		</tbody>
	</table>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <div class="l" style="padding:0"><a href="javascript:;" deleteall-url="{:U('kjdeleteall')}" title="删除" class="btn btn-danger-outline radius">删除</a></div>
        <div class="r">
            <div class="pageNav l" style="padding:0">{$pageshow}</div>
            <div class="r">共有数据：<strong>{$total}</strong> 条 </div>
        </div>
	</div>
    </form>
</div>
{include file="Public/footer" /}
<script>
$("input.input-change").blur(function(){
	var defaultvalue = $(this).attr('defaultValue'),
		value        = $(this).val();
	if(defaultvalue!=value){
		$(this).addClass('danger');
	}else{
		$(this).removeClass('danger');
	}
});
function baocun($id){
	var opencode  = $("#opencode-"+$id),
		opentime  = $("#opentime-"+$id),
		url       = "{:url('kjbaocun')}";
	layer.confirm('确定修改吗？',function(index){
		$.post(url,{'id':$id,'opencode':opencode.val(),'opentime':opentime.val()}, function(json){
			if(json.status==1){
				opencode.attr('defaultValue',opencode.val()).removeClass('danger').addClass('success');
				opentime.attr('defaultValue',opentime.val()).removeClass('danger').addClass('success');
				layer.msg(json.info,{icon:1,time:2000});
			}else if(json.status==0){
				layer.msg(json.info,{icon:2,time:3000});
			}
			
		}, "json");
	});
};
function chongzhi($id){
	var url       = "{:url('kjchongzhi')}";
	layer.confirm('重置开奖针对部分投注未开奖的将会重新开奖，已经开奖的开奖结果不变？',function(index){
		$.post(url,{'id':$id}, function(json){
			if(json.status==1){
				layer.msg(json.info,{icon:1,time:2000});
			}else if(json.status==0){
				layer.msg(json.info,{icon:2,time:3000});
			}
			
		}, "json");
	});
};
</script>
</body>
</html>