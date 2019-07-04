{include file="Public/meta" /}
<title>栏目管理</title>
</head>
<body>
<nav class="breadcrumb">
<span class="l"><a href="javascript:;" layer-url="{:U('add')}" title="添加栏目" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a>&nbsp;&nbsp;&nbsp;</span>
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
				<th width="80">栏目名称</th>
				<th width="80">栏目类型</th>
				<th width="80">栏目模型表</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="treelist" id="vo"}
            <tr class="text-c">
				<td><input type="checkbox" class="checkids" value="{$vo[$_pk]}" name="ids[{$vo[$_pk]}]"></td>
				<td><input type="number" class="input-text radius size-S" value="{$vo.listorder}" name="listorder[{$vo[$_pk]}]" style="width:60px;"></td>
                <td>{$vo[$_pk]}</td>
				<td class="text-l">{$vo.spacer}{$vo.catname}</td>
				<td>
                {if condition="$vo['catetype'] eq 1"}
                正常
                {elseif condition="$vo['catetype'] eq 2" /}
                单页
                {elseif condition="$vo['catetype'] eq 3" /}
                外链
                {/if}
                </td>
				<td>{$vo.model}</td>
				<td class="td-manage">
                {if condition="$vo['catetype'] eq 1"}
                <a style="text-decoration:none" class="ml-5" layer-url="{:U('Content/add',['catid'=>$vo[$_pk]])}" title="添加'{$vo.catname}'栏目信息">添加信息</a>
                {elseif condition="$vo['catetype'] eq 2" /}
                <a style="text-decoration:none" class="ml-5" layer-url="{:U('Content/page',['catid'=>$vo[$_pk]])}" title="'{$vo.catname}'单页管理">单页管理</a>
                {/if}
                <a style="text-decoration:none" class="ml-5" layer-url="{:U('edit',['id'=>$vo[$_pk]])}" title="修改-{$vo.catname}">修改</a>
                
                <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('delete',['id'=>$vo[$_pk]])}" href="javascript:;" title="删除">删除</a>
                </td>
			</tr>
            {/volist}
		</tbody>
	</table>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" listorder-url="{:U('listorder')}" title="排序" class="btn btn-danger-outline radius">排序</a></span> <span class="r">共有数据：<strong>{$totalcount}</strong> 条</span> </div>
    </form>
	</div>
</div>
{include file="Public/footer" /}
</body>
</html>