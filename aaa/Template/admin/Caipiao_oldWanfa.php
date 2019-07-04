{include file="Public/meta" /}
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/lib/bootstrap-Switch/bootstrapSwitch.css" />
<style>
	.border-danger-outline{
		border:1px solid #dd514c;
	}
	.border-success-outline{
		border:1px solid #5eb95e;
	}
	.tabBar1 {border-bottom: 2px solid #19a97b}
	.tabBar1 span {background-color: #e8e8e8;cursor: pointer;display: inline-block;float: left;
		font-weight: bold;height: 30px;line-height: 30px;padding: 0 15px}
	.tabBar1 span.current{background-color: #19a97b;color: #fff}
</style>
<title>玩法管理</title>
</head>
<body>

<nav class="breadcrumb">
	<!--<a href="javascript:;" layer-url="{:U('wanfaadd')}" title="添加玩法" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加玩法</a>&nbsp;&nbsp;&nbsp;-->
	<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div id="tab-oldPlay" class="HuiTab">
		<div class="tabBar cl">
            {volist name="playList" id="play"}
            <span>{$play['title']}</span>
            {/volist}
            <a class="allshow" style="text-decoration: none;float: right">全部展开</a></div>


		<!--六合彩-->
        {volist name="playList" id="play"}
        {php}
        $typeid = $key;
        {/php}
		<div class="tabCon">
			<table class="table table-border table-bordered table-hover">
				{volist name="play['list']" id="list"}
				<thead>
				<tr>
					<th colspan="10" bgcolor="#f9f9f9"><div class="l">{$key}</div><a class="tabbtn" style="float:right;font-weight:bolder;text-decoration: none;font-size:13px;">+</a></th>
				</tr>
				</thead>
				<tbody class="tbaodyshow" style="display:none;">
				{volist name="list" id="item"}

				<tr>
					<td>{$item['class2'] ? $item['class2']: $item['class3']}：<input id="class3-{$item.id}" defaultValue="{$item['class3']}" class="input-text size-S input-change" type="text" style="width:80px;" name="class3" value="{$item['class3']}">
						<input class="input-text size-S input-change" style="width:80px;" id="typeid-{$item.id}" type="hidden" name="typeid" value="{$typeid}" defaultValue="{$typeid}">
                    </td>
                    <td colspan="2" style="display:block">赔率：<input id="rate-{$item.id}" defaultValue="{$item['rate']}" class="input-text size-S input-change" type="text" style="width:60px;" name="rate" value="{$item['rate']}"></td>
					<td>最高注数：<input id="totalzs-{$item.id}" defaultValue="{$item['totalzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="totalzs" value="{$item['totalzs']}"></td>
					<td>最低消费：<input id="minxf-{$item.id}" defaultValue="{$item['minxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minxf" value="{$item['minxf']}"></td>
					<td>最高消费消费：<input id="maxxf-{$item.id}" defaultValue="{$item['maxxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxxf" value="{$item['maxxf']}"></td>
                    <td>排序：<input id="sort-{$item.id}" defaultValue="{$item['sort']}" class="input-text size-S input-change" type="text" style="width:60px;" name="sort" value="{$item['sort']}"></td>
					<td><a id="{$item['typeid']}_{$item.id}" typeid="{$item['typeid']}" playid="{$item.id}" remark="{$item['remark']}" title="{$item['remark']}" class="btn btn-success size-MINI radius modelwfts" onClick="modelwfts(this)">玩法提示</a></td>
					<td>
						{if condition="$item['isopen'] eq 1"}
						<span class="label label-success radius" status-url="{:url('setoldwfstatus',['typeid'=>$item['typeid'],'id'=>$item['id'],'name'=>'isopen'])}">启用</span>
						{else /}
						<span class="label label-defaunt radius" status-url="{:url('setoldwfstatus',['typeid'=>$item['typeid'],'id'=>$item['id'],'name'=>'isopen'])}">禁用</span>
						{/if}
					</td>
					<td><button onClick="baocun('{$item.id}');" class="btn btn-secondary-outline radius size-S">保存</button></td>
				</tr>
				{/volist}
				</tbody>
				{/volist}
			</table>
		</div>
        {/volist}
	</div>
</div>
{include file="Public/footer" /}
<script>
	$(function(){
		 $('.tabbtn').each(function(i){
			 $('.tabbtn').eq(i).click(function(){
				 $('.tbaodyshow').eq(i).toggle();
				 if($(this).html() == "-"){
					 $(this).html('+');
				 }else{
					 $(this).html('-');
				 }

			 })
		 })
		$('.allshow').click(function(){
			if($('.allshow').html()=="全部展开"){
				$('.tbaodyshow').show();
				$('.allshow').html("全部收起");
				$('.tabbtn').html('-');
			}else{
				$('.tbaodyshow').hide();
				$('.allshow').html("全部展开");
				$('.tabbtn').html('+');
			}

		})
	})
</script>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modal.js"></script>

<div id="modalwfts_old" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<p id="myModalLabel">玩法提示修改</p><a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
	</div>
	<div class="modal-body">
		<p>
			<input id="_wfts_typeid" class="input-text size-S" type="hidden">
			<input id="_wfts_playid" class="input-text size-S" type="hidden">
			<textarea id="_wfts_remark" class="textarea radius" placeholder="玩法提示内容..."></textarea>
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" onClick="editmodelwfts()">确定</button> <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
	</div>
</div>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/bootstrap-Switch/bootstrapSwitch.js"></script>
<script>
	function editmodelwfts(){
		var playid = $("#_wfts_playid").val();
		var typeid = $("#_wfts_typeid").val();
		var remark = $("#_wfts_remark").val();
		layer.confirm('确定修改吗？',function(index){
			$.post("{:url('editoldWfts')}",{'typeid':typeid,'id':playid,'remark':remark},function(json){
				if(json.status==1){
					$("#_wfts_typeid").val('');$("#_wfts_playid").val('');$("#_wfts_remark").val('');
					$("#"+typeid+"_"+playid).attr({'remark':remark,'title':remark});
					$("#modalwfts_old").modal("hide");
					layer.msg(json.info,{icon:1,time:2000});
				}else if(json.status==0){
					layer.msg(json.info,{icon:2,time:3000});
				}

			}, "json");
		});
	}
	function modelwfts(obj){
		$("#_wfts_typeid").val($(obj).attr('typeid'));
		$("#_wfts_playid").val($(obj).attr('playid'));
		$("#_wfts_remark").val($(obj).attr('remark'));
		$("#modalwfts_old").modal("show");
	}
	$("input.input-change").blur(function(){
		var defaultvalue = $(this).attr('defaultValue'),
			value        = $(this).val();
		if(defaultvalue!=value){
			$(this).addClass('danger');
		}else{
			$(this).removeClass('danger');
		}
	});
	function baocun($id){
		var typeid = $("#typeid-"+$id),
			rate   = $("#rate-"+$id),
			minxf  = $("#minxf-"+$id),
			maxxf  = $("#maxxf-"+$id),
			class3  = $("#class3-"+$id),
			totalzs  = $("#totalzs-"+$id),
            sort  = $("#sort-"+$id),
			url       = "{:url('oldWfSave')}";
		layer.confirm('确定修改吗？'
			,{btn: ['确定','取消']}
			,function(index){
				$.post(
					url,
					{
						'id':$id,
						'typeid':typeid.val(),
						'rate':rate.val(),
						'minxf':minxf.val(),
						'maxxf':maxxf.val(),
						'totalzs':totalzs.val(),
						'class3':class3.val(),
                        'sort':sort.val()
					},
					function(json){
						if(json.status==1){
							rate.attr('defaultValue',rate.val()).removeClass('danger').addClass('success');
							minxf.attr('defaultValue',minxf.val()).removeClass('danger').addClass('success');
							maxxf.attr('defaultValue',maxxf.val()).removeClass('danger').addClass('success');
							class3.attr('defaultValue',class3.val()).removeClass('danger').addClass('success');
							typeid.attr('defaultValue',typeid.val()).removeClass('danger').addClass('success');
							totalzs.attr('defaultValue',totalzs.val()).removeClass('danger').addClass('success');
                            sort.attr('defaultValue',sort.val()).removeClass('danger').addClass('success');
							layer.msg(json.info,{icon:1,time:2000});
						}else if(json.status==0){
							layer.msg(json.info,{icon:2,time:3000});
						}

					}, "json");
			});
	};
    $.Huitab("#tab-oldPlay .tabBar span","#tab-oldPlay .tabCon","current","click","0");
	//$.Huitab("#tab-lhc .tabBar1 span","#tab-lhc .tabCon1","current","click","0");
</script>
</body>
</html>