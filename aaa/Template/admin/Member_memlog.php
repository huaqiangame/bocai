{include file="Public/meta" /}
<title>会员日志</title>
</head>
<body>
<div class="page-container">
	<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">


    	登陆时间:<input class="input-text" type="text" style="width:80px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" name="sDate" value="{$_sDate}"> - <input class="input-text" type="text" style="width:80px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" value="{$_eDate}" name="eDate">&nbsp;&nbsp;
        
        用户名：<input class="input-text" type="text" style="width:60px;" value="{$username}" name="username">
        &nbsp;&nbsp;登陆IP：<input class="input-text" type="text" style="width:60px;" value="{$loginip}" name="loginip">
        <input class="btn btn-default-outline radius" type="submit" value="查询">
        
    </form>
	<div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c"> 
                <th width="30">ID</th>
				<th width="60">用户名</th>
				<th width="60">类型</th>
				<th width="60">备注</th>
				<th width="60">IP</th>
				<th width="60">IP所属地</th>
				<th width="60">时间</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c"> 
                <td>{$vo.id}</td>
                <td>{$vo.username}</td>
                <td>{if condition="$vo['type'] eq 'login'"}登陆{elseif condition="$vo['type'] eq 'logout'" /}退出{else /}---{/if}</td>
                <td>{$vo.info}</td>
                <td>{$vo.ip}</td>
                <td>{$vo.iparea}</td>
                <td>{$vo.time|date="m-d H:i",###}</td>
			</tr>
            {/volist}
		</tbody>
	</table>
    <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
       <!-- <div class="l" style="padding:0"><a href="javascript:;" deleteall-url="{:U('memlogdelete')}" title="删除" class="btn btn-danger-outline radius">删除</a></div>-->
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