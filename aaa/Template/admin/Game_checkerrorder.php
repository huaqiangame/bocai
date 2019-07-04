{include file="Public/meta" /}
<title>注单异常检测</title>
</head>
<body>
<div class="page-container">
	<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">

<?php $cplists = M('caipiao')->order('typeid asc,id desc')->select();?>
彩种：<span class="select-box" style="width:80px"><select class="select" name="cpname">
<option value="">全部</option>
{foreach name="cplists" item="cpv" key="cpk"}
<option value="{$cpv.name}" {if condition="$cpv['name'] eq $cpname"}selected{/if}>{$cpv.title}</option>
{/foreach}
</select></span>
        
        用户名：<input class="input-text" type="text" style="width:80px;" value="{$username}" name="username">
        时间差距：<input class="input-text" type="number" style="width:80px;" value="{$shijiancha}" name="shijiancha">
        <input class="btn btn-default-outline radius" type="submit" value="查询">
        
    </form>
	<div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
                <th width="130">单号</th>
				<th width="80">用户名</th>
				<th width="60">彩票</th>
				<th width="80">期号</th>
				<th width="60">玩法</th>
				<th width="60">投注金额</th>
				<th width="60">中奖金额</th>
				<th width="60">状态</th>
				<th width="110">投注时间</th>
				<th width="110">出奖时间</th>
				<th width="50">时间差</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
                <td>{$vo.trano}</td>
                <td>{$vo.username}</td>
                <td>{$vo.cptitle}</td>
                <td>{$vo.expect}</td>
                <td>{$vo.playtitle}</td>
                <td>{$vo.amount}</td>
                <td>{$vo.okamount}</td>
                <td>{if condition="$vo['isdraw'] eq '1'"}<span class="c-green">中</span>{elseif condition="$vo['isdraw'] eq '0'" /}<span class="c-333">未开奖</span>{elseif condition="$vo['isdraw'] eq '-1'" /}<span class="c-red">未中</span>{elseif condition="$vo['isdraw'] eq '-2'" /}<span class="c-666">撤</span>{/if}</td>
                <td>{$vo.oddtime|date="m-d H:i:s",###}</td>
                <td>{$vo.opentime|date="m-d H:i:s",###}</td>
                <td>{$vo['opentime'] - $vo['oddtime']}</td>
			</tr>
            {/volist}
		</tbody>
	</table>
    </form>
	</div>
</div>
{include file="Public/footer" /}
<script type="text/javascript" src="../Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modal.js"></script> 

<div id="modalwfts" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <p id="myModalLabel">投注内容查看</p><a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
    </div>
    <div class="modal-body">
        <p>
        <textarea id="_wfts_remark" class="textarea radius" placeholder="投注内容..."></textarea>
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    </div>
</div>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modal.js"></script> 
<script>
$.Huitab("#tab-lhc .tabBar1 span","#tab-lhc .tabCon1","current","click","0");

$(document).on("click", "[tip-content]", function() {
	var obj       = $(this);
	var content = $(obj).attr('tip-content');
	$("#myModalLabel").text("单号:"+$(obj).attr('trano'));
	$("#_wfts_remark").val(content);
	$("#modalwfts").modal("show");
});
$(document).on("click", "[layer-chedan-url]", function() {
	var obj       = $(this);
	var url       = obj.attr('layer-chedan-url');
	var title     = '您确认撤单吗？';
	var issuccess = obj.hasClass('label-success');
	layer.confirm(title,function(index){
		$.getJSON(url, function(json){
			if(json.status==1){
				obj.parents("td").html('<del>已撤单</del>');
				layer.msg('撤单成功!',{icon:1,time:1000});
			}else{
				layer.msg(json.info,{icon: 2,time:2000});
			};
		});
	});
});

</script>
</body>
</html>
