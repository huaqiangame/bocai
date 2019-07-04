{include file="Public/meta" /}
<style>
.border-danger-outline{
	border:1px solid #dd514c;
}
.border-success-outline{
	border:1px solid #5eb95e;
}
</style>
<title>系统预开奖彩管理</title>
</head>
<body>
<nav class="breadcrumb">
<div class="l">
<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
彩种：<span class="select-box clearfix" style="width:150px; background:#fff; text-align:center; margin:0 auto"><select class="select" onChange="javascipt:window.location.href=this.value">
    {volist name="lotterylist" id="cpv"}
    <option value="{:U('yukaijianghistory',['name'=>$cpv['name']])}" {if condition="$cpv['name'] eq $name"}selected{/if}>{$cpv.title}</option>
    {/volist}
</select>
</span>
<input name="name" type="hidden" value="{$name}">
期号：<input type="text" name="expect" class="input-text" style="width:120px;" value="{$expect}">
<button class="btn radius" type="submit" >查询</button>
</form>
</div>
<div class="r">
<a href="{:U('yukaijiang')}" class="btn radius l" style="margin-left:10px;line-height:1.6em;margin-top:3px">返回预开奖</a>
</div>

</nav>
<div class="page-container">
	<div class="mt-5">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="60">彩种</th>
				<th width="60">期号</th>
				<th width="120">开奖号码</th>
				<th width="120">时间</th>
				<th width="60">管理人</th>
			</tr>
		</thead>
		<tbody>
			{volist name="olist" id="vo"}
            <tr class="text-c ">
				<td>{$lotterylist[$vo['name']]['title']}</td>
				<td>{$vo.expect}</td>
				<td>{$vo.opencode}</td>
				<td>{$vo.opentime|date="m-d H:i:s",###}</td>
				<td id="stateadmin-{$vo.expect}">{$vo.stateadmin}</td>
			</tr>
            {/volist}
		</tbody>
	</table>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <div class="l" style="padding:0"></div>
        <div class="r">
            <div class="pageNav l" style="padding:0">{$pageshow}</div>
            <div class="r">共有数据：<strong>{$total}</strong> 条 </div>
        </div>
	</div>
</div>
{include file="Public/footer" /}
</body>
</html>