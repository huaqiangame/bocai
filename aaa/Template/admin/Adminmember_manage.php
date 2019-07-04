{include file="Public/meta" /}
<title>会员管理</title>
</head>
<body>
<nav class="breadcrumb">
<a href="javascript:;" layer-url="{:U('add')}" title="添加管理员" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加q管理员</a>&nbsp;&nbsp;&nbsp;

<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="60">管理组</th>
				<th width="60">管理用户名</th>
				<th width="120">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
                <td>{$grouplist[$vo['groupid']]['groupname']}</td>
                <td><u style="cursor:pointer" class="text-primary" layer-url="{:U('edit',['id'=>$vo['id']])}" title="编辑-{$vo.username}">{$vo.username}</u></td>
				<td class="td-manage">
                <u style="cursor:pointer" class="text-primary" layer-url="{:U('edit',['id'=>$vo['id']])}" title="编辑-{$vo.username}">修改</u> | <u style="cursor:pointer" class="text-primary {if condition='$vo[islock] eq 0'}c-999{elseif condition='$vo[islock] eq 1' /}c-green{/if}" lock-url="{:U('lock',['id'=>$vo['id']])}" title="锁定/解锁-{$vo.username}">{if condition="$vo['islock'] eq 0"}锁定{elseif condition="$vo['islock'] eq 1" /}解锁{/if}</u>
                |
                <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('delete',array('id'=>$vo['id']))}" href="javascript:;" title="删除">删除</a>
                </td>
			</tr>
            {/volist}
		</tbody>
	</table>
    <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
        <div class="l" style="padding:0"></div>
        <div class="r">
            <div class="pageNav l" style="padding:0">{$page}</div>
            <div class="r">共有数据：<strong>{$totalcount}</strong> 条 </div>
        </div>
    </div>
    </form>
	</div>
</div>
{include file="Public/footer" /}
<script>
$(document).on("click", "[lock-url]", function() {
	var obj       = $(this);
	var url       = $(this).attr('lock-url');
	var title     = obj.attr('title')?$(this).attr('title'):'您确认操作吗？';
	var issuccess = obj.hasClass('label-success');
	layer.confirm(title,function(index){
		$.getJSON(url, function(json){
			if(json.status==1){
				if(obj.text()=='锁定'){
					obj.removeClass('c-999').addClass('c-green').text('解锁');
				}else{
					obj.removeClass('c-green').addClass('c-999').text('锁定');
				}
				
				layer.msg('操作成功',{icon: 1,time:1000});
			}else{
				layer.msg(json.info,{icon: 2,time:2000});
			};
		});
	});
});

</script>
</body>
</html>