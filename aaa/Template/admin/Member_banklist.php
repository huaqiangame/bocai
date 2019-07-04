{include file="Public/meta" /}
<title>银行信息</title>
</head>
<body>

<div class="page-container">
	<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
        
状态：<span class="select-box" style="width:80px"><select class="select" name="state">
<option value="">全部</option>
<option value="0" {if condition="($state eq 0) and (isset($state))"}selected{/if}>审核中</option>
<option value="1" {if condition="$state eq 1"}selected{/if}>已审</option>
<option value="2" {if condition="$state eq 2"}selected{/if}>驳回</option>
</select></span>
        用户名：<input class="input-text" type="text" style="width:100px;" value="{$username}" name="username">
        绑定姓名：<input class="input-text" type="text" style="width:100px;" value="{$accountname}" name="accountname">
        <input class="btn btn-default-outline radius" type="submit" value="查询">
    </form>
    <div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="60">用户名</th>
				<th width="60">开户姓名</th>
				<th width="60">开户银行</th>
				<th width="60">开户网点</th>
				<th width="60">开户地址</th>
				<th width="100">银行卡号</th>
				<th width="80">状态</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
                <td>{$vo.username}</td>
                <td>{$vo.accountname}</td>
                <td>{$vo.bankname}</td>
                <td>{$vo.bankbranch}</td>
                <td>{$vo.bankaddress}</td>
                <td>{$vo.banknumber}{if condition="$vo[isdefault] eq 1"} (默认){/if}</td>
                <td>
                {if condition="$vo[state] eq 0"}
                审核中
                {elseif condition="$vo[state] eq 1" /}
                已审
                {elseif condition="$vo[state] eq 2" /}
                驳回
                {/if}
                </td>
                <td><u style="cursor:pointer" class="text-primary" layer-url="{:U('bankedit',['id'=>$vo['id']])}" title="修改银行信息">修改</u>&nbsp;|&nbsp;<u style="cursor:pointer" class="text-primary" layer-del-url="{:U('bankdelete',['id'=>$vo['id']])}" title="删除银行信息">删除</u></td>
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