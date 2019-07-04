{include file="Public/meta" /}
<title>账变记录</title>
</head>
<body>

<div class="page-container">
	<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
<input type="hidden" name="uid" value="{$uid}">
<?php $fuddetailtypes = C('fuddetailtypes');?>
<span class="select-box" style="width:80px"><select class="select" name="type">
<option value="">全部</option>
{foreach name="fuddetailtypes" item="ft" key="fk"}
<option value="{$fk}" {if condition="$fk eq $type"}selected{/if}>{$ft}</option>
{/foreach}
</select></span>
        
        <input type="hidden" name="uid" value="{$info.id}">
    	时间:<input class="input-text" type="text" style="width:100px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" name="sDate" value="{$_sDate}"> - <input class="input-text" type="text" style="width:100px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" value="{$_eDate}" name="eDate">
        
        用户名：<input class="input-text" type="text" style="width:100px;" value="{$username}" name="username">
        单号：<input class="input-text" type="text" style="width:100px;" value="{$trano}" name="trano">
        <input class="btn btn-default-outline radius" type="submit" value="查询">
    </form>
    <div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
                <th width="80">单号</th>
				<th width="60">用户名</th>
				<th width="60">类型</th>
				<th width="60">账变前金额</th>
				<th width="60">账变金额</th>
				<th width="60">账变后金额</th>
				<th width="100">备注</th>
				<th width="80">时间</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
                <td>{$vo.trano}</td>
                <td>{$vo.username}</td>
                <td>{$vo.typename}</td>
                <td>{$vo.amountbefor}</td>
                <td>{$vo.amount}</td>
                <td>{$vo.amountafter}</td>
                <td>{$vo.remark}</td>
                <td>{$vo.oddtime|date="m-d H:i:s",###}</td>
			</tr>
            {/volist}
		</tbody>
	</table>
    
    <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
        <div class="pageNav l" style="padding:0">{$page}</div>
        <div class="r">共有数据：<strong>{$totalcount}</strong> 条 </div>
    </div>
    </form>
	</div>
</div>
{include file="Public/footer" /}
</body>
</html>