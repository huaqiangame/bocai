{include file="Public/meta" /}
<title>提款银行管理</title>
</head>
<body>
<nav class="breadcrumb">
<a href="javascript:;" layer-url="{:U('paysetadd')}" title="添加存款方式" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加存款方式</a>&nbsp;&nbsp;&nbsp;
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="60">排序</th>
				<th width="60">标识</th>
				<th width="100">支付名称</th>
				<th width="60">副名称</th>
				<th width="30">线上支付</th>
				<th width="30">状态</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
				<td><input type="checkbox" class="checkids" value="{$vo.id}" name="ids[{$vo.id}]"></td>
				<td><input type="number" class="input-text radius size-S" value="{$vo.listorder}" name="listorder[{$vo.id}]" style="width:60px;"></td>
                <td>{$vo.paytype}</td>
				<td><u style="cursor:pointer" class="text-primary" layer-url="{:U('paysetedit',['id'=>$vo['id']])}" title="修改-{$vo.paytypetitle}">{$vo.paytypetitle}</u></td>
                <td>{$vo.ftitle}</td>
				<td>
                {if condition="$vo['isonline'] eq 1"}
                <span class="label label-success radius">是</span>
                {else /}
                <span class="label label-defaunt radius">否</span>
                {/if}
                
                </td>
				<td class="td-status">
                {if condition="$vo['state'] eq 1"}
                <span class="label label-success radius" status-url="{:url('paysetstatus',['id'=>$vo['id'],'name'=>'state'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('paysetstatus',['id'=>$vo['id'],'name'=>'state'])}">禁用</span>
                {/if}
                
                </td>
				<td class="td-manage">
                <u style="cursor:pointer" class="text-primary" layer-url="{:U('paysetedit',['id'=>$vo['id']])}" title="修改-{$vo.paytypetitle}">修改</u>&nbsp;|&nbsp;<u style="cursor:pointer" class="text-primary" layer-del-url="{:U('paysetdelete',['id'=>$vo['id']])}" title="删除-{$vo.paytypetitle}">删除</u>
                </td>
			</tr>
            {/volist}
		</tbody>
	</table>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" listorder-url="{:U('paysetlistorder')}" title="排序" class="btn btn-danger-outline radius">排序</a></span> <span class="r">共有数据：<strong>{:count($olist)}</strong> 条</span>

    </div>
    </form>
	</div>
</div>
{include file="Public/footer" /}
</body>
</html>