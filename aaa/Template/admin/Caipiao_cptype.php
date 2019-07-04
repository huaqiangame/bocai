{include file="Public/meta" /}
<title>彩种管理</title>
</head>
<body>
<nav class="breadcrumb">
<a href="javascript:;" layer-url="{:U('cpadd')}" title="添加彩票" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加彩票</a>&nbsp;&nbsp;&nbsp;
<a href="{:U('Caipiao/cptype')}" >全部</a>&nbsp;&nbsp;
 {foreach name="cpcategory" item="cptype" key="cpk"}
    <a href="{:url('cptype',['typeid'=>$cpk])}" {if condition="$typeid eq $cpk"}style="color:red"{/if}>{$cptype}</a>&nbsp;&nbsp;
{/foreach}
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
				<th width="60">彩票分类</th>
				<th width="100">彩种名称</th>
				<th width="60">彩种标示</th>
				<th width="60">停止投注间隔</th>
				<th width="120">彩种简介</th>
				<th width="70">彩票类型</th>
				<th width="30">期数</th>
				<th width="30">维护</th>
				<th width="30">状态</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="olist" id="vo"}
            <tr class="text-c">
				<td><input type="checkbox" class="checkids" value="{$vo.id}" name="ids[{$vo.id}]"></td>
				{neq name="typeid" value=""}
				<td><input type="number" class="input-text radius size-S" value="{$vo.listorder}" name="listorder[{$vo.id}]" style="width:60px;"></td>
				{else/}
				<td><input type="number" class="input-text radius size-S" value="{$vo.allsort}" name="allsort[{$vo.id}]" style="width:60px;"></td>
				{/neq}
				<td>{$vo.id}</td>
                <td>{$cpcategory[$vo['typeid']]}</td>
				<td><u style="cursor:pointer" class="text-primary" layer-url="{:U('cpedit',['id'=>$vo['id']])}" title="修改-{$vo.title}">{$vo.title}</u></td>
				<td>{$vo.name}</td>
				<td>{$vo.ftime}</td>
				<td>{$vo.ftitle}</td>
				<td>
                {if condition="$vo['issys'] eq 1"}
                系统彩
                {else /}
                第三方彩
                {/if}
                </td>
                <td>
                <?php
				$qishu = M('caipiaotimes')->where(['name'=>$vo['name']])->count();
				echo $qishu?:0;
				?>
                </td>
				<td class="td-status">
                {if condition="$vo['iswh'] eq 1"}
                <span class="label label-defaunt radius" iswh-url="{:url('setstatus',['id'=>$vo['id'],'name'=>'iswh'])}">维护中</span>
                {else /}
                <span class="label label-success radius" iswh-url="{:url('setstatus',['id'=>$vo['id'],'name'=>'iswh'])}">正常</span>
                {/if}
                
                </td>
				<td class="td-status">
                {if condition="$vo['isopen'] eq 1"}
                <span class="label label-success radius" status-url="{:url('setstatus',['id'=>$vo['id'],'name'=>'isopen'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('setstatus',['id'=>$vo['id'],'name'=>'isopen'])}">禁用</span>
                {/if}
                
                </td>
				<td class="td-manage">
                <a style="text-decoration:none" class="ml-5" layer-url="{:U('cpedit',['id'=>$vo['id']])}" title="修改-{$vo.title}"><i class="Hui-iconfont">&#xe6df;</i></a>
                
                <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('delete',['id'=>$vo['id']])}" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
			</tr>
            {/volist}
		</tbody>
	</table>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l"><a href="javascript:;"  deleteall-url="{:U('deleteall')}" title="删除" class="btn btn-danger-outline radius">删除</a>&nbsp;&nbsp;
                <a href="javascript:;" listorder-url="{:U('listorder')}" title="排序" class="btn btn-danger-outline radius">排序</a>
            </span>
            <span class="r">共有数据：<strong>{:count($olist)}</strong> 条</span>
        </div>
    </form>
	</div>
</div>
{include file="Public/footer" /}
<script>
$(document).on("click", "[iswh-url]", function() {
	var obj       = $(this);
	var url       = $(this).attr('iswh-url');
	var title     = obj.attr('title')?$(this).attr('title'):'您确认操作吗？';
	var issuccess = obj.hasClass('label-success');
	layer.confirm(title,function(index){
		$.getJSON(url, function(json){
			if(json.status==1){
				if(issuccess){
					obj.removeClass('label-success').addClass('label-defaunt').text('维护中');
				}else{
					obj.removeClass('label-defaunt').addClass('label-success').text('正常');
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