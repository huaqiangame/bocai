{include file="Public/meta" /}
<title>提款记录</title>
</head>
<body>

<div class="page-container">
	<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
        
        用户名：<input class="input-text" type="text" style="width:100px;" value="{$username}" name="username">
        <input class="btn btn-default-outline radius" type="submit" value="查询">
    </form>
    <div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
                <th width="70">ID</th>
				<th width="60">用户名</th>
				<th width="60">注册类型</th>
				<th width="60">总次数</th>
				<th width="60">使用次数</th>
				<th width="60">使用模版</th>
				<th width="60">创建时间</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
                <td>{$vo.id}</td>
                <td>{$vo.username}</td>
                <td>{if condition="$vo['proxy'] eq 0"}普通用户{else /}代理{/if}</td>
                <td>{$vo.usenum}</td>
                <td>{$vo.okusenum}</td>
                <td>{if condition="$vo['tpltype'] eq 0"}默认{else /}模版{$vo['tpltype']}{/if}</td>
                <td>{$vo.oddtime|date="m-d H:i",###}</td>
                <td><u style="cursor:pointer" class="text-primary" layer-del-url="{:U('agentlinkdelete',['id'=>$vo['id']])}" title="删除链接">删除</u></td>
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