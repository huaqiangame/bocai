{include file="Public/meta" /}
<title>栏目管理</title>
</head>
<body>
<nav class="breadcrumb">
<a href="javascript:;" layer-url="{:U('categoryadd')}" title="添加栏目" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a>&nbsp;&nbsp;&nbsp;
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="60">排序</th>
                <th width="30">ID</th>
				<th class="text-l">栏目名称</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
				<td><input type="checkbox" class="checkids" value="{$vo[$_pk]}" name="ids[{$vo[$_pk]}]"></td>
				<td><input type="number" class="input-text radius size-S" value="{$vo.listorder}" name="listorder[{$vo[$_pk]}]" style="width:60px;"></td>
                <td>{$vo.id}</td>
                <td class="text-l">{$vo.spacer}{$vo.catname}</td>
				<td class="td-manage">
                <a style="text-decoration:none" class="ml-5" layer-url="{:U('categoryedit',['id'=>$vo['id']])}" title="修改-{$vo.bankname}"><i class="Hui-iconfont">&#xe6df;</i></a>
                
                <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('categorydelete',['id'=>$vo['id']])}" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
			</tr>
            {/volist}
		</tbody>
	</table>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" listorder-url="{:U('categorylistorder')}" title="排序" class="btn btn-danger-outline radius">排序</a></span> <span class="r">共有数据：<strong>{:count($list)}</strong> 条</span> </div>
    </form>
	</div>
</div>
{include file="Public/footer" /}
</body>
</html>