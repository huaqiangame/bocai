{include file="Public/meta" /}
<title>存款记录</title>
</head>
<body>
<?php
$_states = [
	'0'=>'未审核',
	'1'=>'已审核',
	'-1'=>'取消申请',
];

?>
<div class="page-container">
    <span class="r">
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</span>
	<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
<?php $fuddetailtypes = C('fuddetailtypes');?>
<span class="select-box" style="width:80px"><select class="select" name="state">
<option value="">全部</option>
{foreach name="_states" item="ft" key="fk"}
<option value="{$fk}" {if condition="($fk eq $state) and ($state neq '')"}selected{/if}>{$ft}</option>
{/foreach}

</select></span>
        
        <input type="hidden" name="uid" value="{$info.id}">
    	时间:<input class="input-text" type="text" style="width:100px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" name="sDate" value="{$_sDate}"> - <input class="input-text" type="text" style="width:100px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" value="{$_eDate}" name="eDate">
    	金额:<input class="input-text" type="text" style="width:60px;" name="sAmout" value="{$_sAmout}"> - <input class="input-text" type="text" style="width:60px;" value="{$_eAmout}" name="eAmout">
        
        用户名：<input class="input-text" type="text" style="width:100px;" value="{$username}" name="username">
        单号：<input class="input-text" type="text" style="width:100px;" value="{$trano}" name="trano">
        <input class="btn btn-default-outline radius" type="submit" value="查询">
    </form>
    <div class="mt-5">
    <form method="post" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">平台单号</th>
                <!--<th width="80">第三方单号</th>-->
				<th width="60">用户名</th>
				<th width="60">支付账号</th>
				<th width="60">存款方式</th>
				<th width="60">充值前</th>
				<th width="60">金额</th>
				<th width="60">充值后</th>
				<!--<th width="60">实际金额</th>
				<th width="60">手续费</th>
				<th width="60">实际手续费</th>
				<th width="70">变更前金额</th>
				<th width="70">变更后金额</th>-->
				<th width="70">备注</th>
				<!--<th width="70">操作人</th>-->
				<th width="60">类型</th>
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
               <!-- <td>{$vo.threetrano}</td>-->
                <td>{$vo.username}</td>
                <td>{if condition="$vo['paytype'] neq 'linepay'"}{$vo.payname}{else /}<u style="cursor:pointer;" class="text-primary" trano="{$vo.trano}" tip-content="{$vo.payname}">查看信息</u>{/if}</td>
                <td>{$vo.paytypetitle}</td>
                <td>{$vo.oldaccountmoney}</td>
                <td>{$vo.amount}</td>
                <td>{$vo.newaccountmoney}</td>
                <!--<td>{$vo.actualamount}</td>
                <td>{$vo.fee}</td>
                <td>{$vo.actualfee}</td>
                <td>{$vo.oldaccountmoney}</td>
                <td>{$vo.newaccountmoney}</td>-->
                <td>{$vo.remark}</td>
              <!--  <td>{$vo.stateadmin}</td>-->
                <td>{if condition="$vo['isauto'] eq 1"}自动{elseif condition="$vo['state'] eq 2"/}手动{/if}</td>
                <td>{$vo.oddtime|date="m-d H:i",###}</td>
                <td>
                {if condition="$vo['state'] eq 0"}
                <u style="cursor:pointer" class="text-primary" layer-url="{:U('rechargstate',['id'=>$vo['id']])}" title="编辑订单-{$vo.trano}状态">
                	<span style="color:red">未审核</span>
                </u>
                {elseif condition="$vo['state'] eq 1"/}
                	<span style="color:green">已审核</span>
                {elseif condition="$vo['state'] eq -1"/}
               	 <span style="color:grey">取消</span>
                {/if}
                |
                <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('rechargedelete',array('id'=>$vo['id']))}" href="javascript:;" title="删除">删除</a>
                </td>
			</tr>
            {/volist}
		</tbody>
	</table>
    
    <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
        <span class="l"><a href="javascript:;" deleteall-url="{:U('rechargedelall')}" title="删除" class="btn btn-danger-outline radius">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <div class="l" style="padding:0">页面成功：<strong style="color:#f60">{$yemiantotal}</strong>元</div>
        <div class="r">
            <div class="pageNav l" style="padding:0">{$page}</div>
            <div class="r">共有数据：<strong>{$totalcount}</strong> 条 </div>
        </div>
    </div>
    
    <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
        总充值：<strong style="color:#f60">{$rechalltotal}</strong>({$rechalltotal_count}笔)&nbsp;&nbsp;&nbsp;&nbsp;自动充值：<strong style="color:#f60">{$rechtotal_aotu}</strong>({$rechtotal_aotu_count}笔)&nbsp;&nbsp;&nbsp;&nbsp;手动充值：<strong style="color:#f60">{$rechtotal_shou}</strong>({$rechtotal_shou_count}笔)
    </div>
    </form>
	</div>
</div>
{include file="Public/footer" /}
<div id="modalwfts" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <p id="myModalLabel">投注内容查看</p><a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
    </div>
    <div class="modal-body">
        <p id="_wfts_remark">
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    </div>
</div>
<script type="text/javascript" src="__ROOT__/Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="__ROOT__/Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modal.js"></script>
<script>
$(document).on("click", "[tip-content]", function() {
	var obj       = $(this);
	var content = $(obj).attr('tip-content');
	$("#myModalLabel").text("单号:"+$(obj).attr('trano'));
	$("#_wfts_remark").html(content);
	$("#modalwfts").modal("show");
});

</script>
</body>
</html>