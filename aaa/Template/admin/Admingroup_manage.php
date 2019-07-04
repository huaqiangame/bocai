{include file="Public/meta" /}
<title>提款银行管理</title>
</head>
<body>
<nav class="breadcrumb">
<a href="javascript:;" layer-url="{:U('add')}" title="添加管理组" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理组</a>&nbsp;&nbsp;&nbsp;
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<!--<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" layer-url="{:U('cpadd')}" title="添加彩票" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加彩票</a></span> <span class="r">共有数据：<strong>{:count($olist)}</strong> 条</span> </div>-->
	<div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
                <th width="30">ID</th>
				<th width="60">组名称</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
				<td><input type="checkbox" class="checkids" value="{$vo.groupid}" name="ids[{$vo.groupid}]"></td>
                <td>{$vo.groupid}</td>
				<td><u style="cursor:pointer" class="text-primary" layer-url="{:U('edit',['id'=>$vo['groupid']])}" title="修改-{$vo.groupname}">{$vo.groupname}</u></td>
				<td class="td-manage">
                <a style="text-decoration:none" class="ml-5" layer-url="{:U('edit',['id'=>$vo['groupid']])}" title="修改-{$vo.groupname}"><i class="Hui-iconfont">&#xe6df;</i></a>
                
                <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('delete',['id'=>$vo['groupid']])}" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
			</tr>
            {/volist}
		</tbody>
	</table>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" deleteall-url="{:U('deleteall')}" title="删除" class="btn btn-danger-outline radius">删除</a>&nbsp;&nbsp;</span> <span class="r">共有数据：<strong>{:count($olist)}</strong> 条</span> </div>
    </form>
	</div>
</div>
{include file="Public/footer" /}
</body>
</html>