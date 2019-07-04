{include file="Public/meta" /}
<title>提款记录</title>
</head>
<body>

<div class="page-container">
    <span class="r">
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</span>
	<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
<?php $fuddetailtypes = C('fuddetailtypes');?>
<span class="select-box" style="width:80px"><select class="select" name="state">
<option value="">全部</option>
<option value="0" {if condition="($state eq 0) and ($state neq '')"}selected{/if}>未审核</option>
<option value="1" {if condition="$state eq 1"}selected{/if}>已完成</option>
<option value="2" {if condition="$state eq 2"}selected{/if}>退回</option>
<option value="3" {if condition="$state eq 3"}selected{/if}>取消</option>

</select></span>
        
        <input type="hidden" name="uid" value="{$info.id}">
    	时间:<input class="input-text" type="text" style="width:100px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" name="sDate" value="{$_sDate}"> - <input class="input-text" type="text" style="width:100px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" value="{$_eDate}" name="eDate">
    	金额:<input class="input-text" type="text" style="width:60px;" name="sAmout" value="{$_sAmout}"> - <input class="input-text" type="text" style="width:60px;" value="{$_eAmout}" name="eAmout">
        
        用户名：<input class="input-text" type="text" style="width:100px;" value="{$username}" name="username">
        单号：<input class="input-text" type="text" style="width:100px;" value="{$trano}" name="trano">
        <input class="btn btn-default-outline radius" type="submit" value="查询">
    </form>
    <div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="70">单号</th>
				<th width="60">用户名</th>
				<th width="60">姓名</th>
				<th width="60">银行</th>
				<th width="60">银行账号</th>
				<th width="60">金额</th>
				<th width="60">实到金额</th>
				<th width="60">手续费</th>
				<th width="70">变更前金额</th>
				<th width="70">变更后金额</th>
<!--				<th width="70">备注</th>
				<th width="70">审核人</th>-->
				<th width="60">时间</th>
				<th width="30">状态</th>
			</tr>
		</thead>
		<tbody>
            {php}$yemiantotal = 0;{/php}
			{volist name="list" id="vo"}
            {php}
            if($vo['state']==1)$yemiantotal += $vo['amount'];
            {/php}
            <tr class="text-c">
                <td><input type="checkbox" class="checkids" value="{$vo.id}" name="ids[{$vo.id}]"></td>
                <td>{$vo.trano}</td>
                <td>{$vo.username}</td>
                <td>{$vo.accountname}</td>
                <td>{$vo.bankname}</td>
                <td>{$vo.banknumber}</td>
                <td><span style="color:grey">{$vo.amount}</span></td>
                <td><span style="color:green">{$vo.actualamount}</span></td>
                <td>{$vo.fee}</td>
                <td>{$vo.oldaccountmoney}</td>
                <td>{$vo.newaccountmoney}</td>
<!--                <td>{$vo.remark}</td>
                <td>{$vo.stateadmin}</td>-->
                <td>{$vo.oddtime|date="m-d H:i",###}</td>
                <td>
				{if condition="$vo['state'] eq 0"}
				<u style="cursor:pointer;color:red" class="text-primary" layer-url="{:U('withdrawstate',['id'=>$vo['id']])}" title="编辑订单-{$vo.trano}状态">未审核</u>
				{elseif condition="$vo['state'] eq 1" /}
				<span style="color:green">已完成</span>
				{elseif condition="$vo['state'] eq -1" /}
				<span style="color:grey">退回</span>
				{else /}
				未知
				{/if}
                |
                <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('withdrawdelete',array('id'=>$vo['id']))}" href="javascript:;" title="删除">删除</a>
				</td>
			</tr>
            {/volist}
		</tbody>
	</table>
    
    <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
        <span class="l"><a href="javascript:;" deleteall-url="{:U('withdrawdelall')}" title="删除" class="btn btn-danger-outline radius">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <div class="l" style="padding:0">总提款：<strong style="color:#f60">{$withdrawtotal}</strong>({$withdrawtotal_count}笔)&nbsp;&nbsp;&nbsp;&nbsp;页面成功：<strong style="color:#f60">{$yemiantotal}</strong>元</div>
        <div class="r">
            <div class="pageNav l" style="padding:0">{$page}</div>
            <div class="r">共有数据：<strong>{$totalcount}</strong> 条 </div>
        </div>
    </div>
    </form>
	</div>
</div>
{include file="Public/footer" /}
</body>
</html>