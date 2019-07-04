{include file="Public/meta" /}
<title>添加线下银行</title>
</head>
<body>
<nav class="breadcrumb">
<a href="javascript:;" layer-url="{:U('linebankadd')}" title="添加线下银行" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加线下银行</a>&nbsp;&nbsp;&nbsp;
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<!--<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" layer-url="{:U('cpadd')}" title="添加彩票" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加彩票</a></span> <span class="r">共有数据：<strong>{:count($olist)}</strong> 条</span> </div>-->
	<div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="60">排序</th>
                <th width="30">ID</th>
				<th width="100">银行名称</th>
				<th width="100">开户姓名</th>
				<th width="100">银行卡号</th>
				<th width="30">状态</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
				<td><input type="checkbox" class="checkids" value="{$vo.id}" name="ids[{$vo.id}]"></td>
				<td><input type="number" class="input-text radius size-S" value="{$vo.listorder}" name="listorder[{$vo.id}]" style="width:60px;"></td>
                <td>{$vo.id}</td>
				<td><u style="cursor:pointer" class="text-primary" layer-url="{:U('linebankedit',['id'=>$vo['id']])}" title="修改-{$vo.bankname}">{$vo.bankname}</u></td>
				<td>{$vo.accountname}</td>
				<td>{$vo.banknumber}</td>
				<td class="td-status">
                {if condition="$vo['state'] eq 1"}
                <span class="label label-success radius" status-url="{:url('linesetstatus',['id'=>$vo['id'],'name'=>'state'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('linesetstatus',['id'=>$vo['id'],'name'=>'state'])}">禁用</span>
                {/if}
                
                </td>
				<td class="td-manage">
                <a style="text-decoration:none" class="ml-5" layer-url="{:U('linebankedit',['id'=>$vo['id']])}" title="修改-{$vo.bankname}"><i class="Hui-iconfont">&#xe6df;</i></a>
                
                <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('linebankdelete',['id'=>$vo['id']])}" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
			</tr>
            {/volist}
		</tbody>
	</table>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" deleteall-url="{:U('linebankdeleteall')}" title="删除" class="btn btn-danger-outline radius">删除</a>&nbsp;&nbsp;<a href="javascript:;" listorder-url="{:U('linebanklistorder')}" title="排序" class="btn btn-danger-outline radius">排序</a></span> <span class="r">共有数据：<strong>{:count($olist)}</strong> 条</span> </div>
    </form>
	</div>
</div>
{include file="Public/footer" /}
</body>
</html>