{include file="Public/meta" /}
<title>字段管理</title>
</head>
<body>
<nav class="breadcrumb">
<span class="l"><a href="javascript:;" layer-url="{:U('add',['tbname'=>$tbname])}" title="添加字段" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加字段</a>&nbsp;&nbsp;&nbsp;</span>
<span class="select-box clearfix" style="width:150px; background:#fff; text-align:center; margin:0 auto"><select class="select" name="name" onChange="javascipt:window.location.href=this.value">
<option value="{:url('manage')}">==选择模型表==</option>
{volist name="tblist" id="tb"}
<option value="{:url('manage',['tbname'=>$tb['name']])}" {if condition="$tb['name'] eq $tbname"}selected{/if}>{$tb.title}</option>
{/volist}
</select></span>
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
				<th width="80">模型名称</th>
				<th width="80">数据表名称</th>
				<th width="100">备注</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
				<td><input type="checkbox" class="checkids" value="{$vo[$_pk]}" name="ids[{$vo[$_pk]}]"></td>
				<td><input type="number" class="input-text radius size-S" value="{$vo.listorder}" name="listorder[{$vo[$_pk]}]" style="width:60px;"></td>
                <td>{$vo[$_pk]}</td>
				<td><u style="cursor:pointer" class="text-primary" layer-url="{:U('edit',['id'=>$vo[$_pk]])}" title="修改-{$vo.title}">{$vo.title}</u></td>
				<td>{$vo.name}</td>
				<td>{$vo.remark}</td>
				<td class="td-manage">
                <a style="text-decoration:none" class="ml-5" layer-url="{:U('edit',['id'=>$vo[$_pk]])}" title="修改-{$vo.title}"><i class="Hui-iconfont">&#xe6df;</i></a>
                
                <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('delete',['id'=>$vo[$_pk]])}" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
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