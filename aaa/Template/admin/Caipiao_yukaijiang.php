{include file="Public/meta" /}
<style>
	.border-danger-outline{
		border:1px solid #dd514c;
	}
	.border-success-outline{
		border:1px solid #5eb95e;
	}
</style>
<title>系统预开a奖彩管理</title>
</head>
<body>
<nav class="breadcrumb">
	<div class="l">
		<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="l">
<span class="select-box clearfix" style="width:150px; background:#fff; text-align:center; margin:0 auto"><select class="select" onChange="javascipt:window.location.href=this.value">
		{foreach name="cpcategory" item="cptype" key="cpk"}
		<optgroup label="{$cptype}">
			{volist name="cplist" id="cpv"}
			{if condition="$cpk eq $cpv['typeid']"}
			<option value="{:U('yukaijiang',['name'=>$cpv['name']])}" {if condition="$cpv['name'] eq $name"}selected{/if}>{$cpv.title}</option>
			{/if}
			{/volist}
		</optgroup>
		{/foreach}
	</select>
</span>
		</form>
		<a href="{:U('yukaijianghistory')}" class="btn radius l" style="margin-left:10px;line-height:1.6em;margin-top:3px">历史开奖</a>
	</div>
	<div class="r">
		<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷k新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</div>

</nav>
<div class="page-container">
	<div class="mt-5">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
			<tr class="text-c">
				<th width="40">彩种</th>
				<th width="60">期号</th>
				<th width="100">开奖号码</th>
				<th width="80">开奖时间</th>
				<th width="60">管理人</th>
				<th width="60">操作</th>
			</tr>
			</thead>
			<tbody>
			{volist name="openlist" id="vo"}
			{if condition="$vo['isbc'] eq 1"}<tr class="text-c success">{else /}<tr class="text-c ">{/if}
				<td>{$vo.cptitle}</td>
				<td>{$vo.expect}<input id="expect-{$vo.expect}" type="hidden" value="{$vo.expect}"><input id="name-{$vo.expect}" type="hidden" value="{$vo.name}"></td>
				<td>
					<?php
					$opencodes = array();
					$opencodes = explode(',',$vo['opencode']);
					?>
					<!--时时彩-->
					{eq name="typeid" value="ssc"}
					<div style="margin:0 auto;width:26em;">
						{for start="0" end="5" name="i"}
						<select id="opencode{$i+1}-{$vo.expect}" style="padding:2px 1px;width:auto;float:left;margin:1px 2px;">
							<option value="">第{$i+1}球</option>
							{for strat="1" end="10" name="j"}
							<option value="{$j}" {if condition="$opencodes[$i] eq $j"}selected{/if}>{$j}</option>
							{/for}
						</select>
						{/for}
					</div>
					{/eq}
					<!--11选5-->
					{eq name="typeid" value="x5"}
					<div style="margin:0 auto;width:26em;">
						{for start="0" end="5" name="i"}
						<select id="opencode{$i+1}-{$vo.expect}" style="padding:2px 1px;width:auto;float:left;margin:1px 2px;">
							<option value="">第{$i+1}球</option>
							{for strat="1" end="12" name="j"}
							<?php if($j<10)$j='0'.$j?>
								{neq name='j' value='0'}
								<option value="{$j}" {if condition="$opencodes[$i] eq $j"}selected{/if}>{$j}</option>
								{/neq}
							{/for}
						</select>
						{/for}
					</div>
					{/eq}


					<!--PK10-->
					{eq name="typeid" value="pk10"}
					<div style="margin:0 auto;width:40em;">
						{for start="0" end="10" name="i"}
						<select id="opencode{$i+1}-{$vo.expect}" style="padding:2px 1px;width:40px;float:left;margin:1px 2px;">
							<option value="">第{$i+1}球</option>
							{for strat="1" end="11" name="j"}
							<?php if($j<10)$j='0'.$j?>
								{neq name='j' value='0'}
								<option value="{$j}" {if condition="$opencodes[$i] eq $j"}selected{/if}>{$j}</option>
								{/neq}
							{/for}
						</select>
						{/for}
					</div>
					{/eq}


					<!--快乐8-->
					{eq name="typeid" value="keno"}
					<div style="margin:0 auto;width:40em;">
						{for start="0" end="20" name="i"}
						<select id="opencode{$i+1}-{$vo.expect}" style="padding:2px 1px;width:40px;float:left;margin:1px 2px;">
							<option value="">第{$i+1}球</option>
							{for strat="1" end="81" name="j"}
							<?php if($j<10)$j='0'.$j?>
								{neq name='j' value='0'}
								<option value="{$j}" {if condition="$opencodes[$i] eq $j"}selected{/if}>{$j}</option>
								{/neq}
							{/for}
						</select>
						<?php if($i==9) echo'<br />';?>
						{/for}
					</div>
					{/eq}


					<!--快3-->
					{eq name="typeid" value="k3"}
					<div style="margin:0 auto;width:20em;">
						{for start="0" end="3" name="i"}
						<select id="opencode{$i+1}-{$vo.expect}" style="padding:2px 1px;width:auto;float:left;margin:1px 2px;">
							<option value="">第{$i+1}球</option>
							{for strat="1" end="7" name="j"}
							  {neq name='j' value='0'}
							  <option value="{$j}" {if condition="$opencodes[$i] eq $j"}selected{/if}>{$j}</option>
							  {/neq}
							{/for}
						</select>
						{/for}
					</div>
					{/eq}
					<!--低频彩-->
					{eq name="typeid" value="dpc"}
					<div style="margin:0 auto;width:20em;">
						{for start="0" end="3" name="i"}
						<select id="opencode{$i+1}-{$vo.expect}" style="padding:2px 1px;width:auto;float:left;margin:1px 2px;">
							<option value="">第{$i+1}球</option>
							{for strat="1" end="10" name="j"}
								<option value="{$j}" {if condition="$opencodes[$i] eq $j"}selected{/if}>{$j}</option>
							{/for}
						</select>
						{/for}
					</div>
					{/eq}
					<!--lhc-->
					{eq name="typeid" value="lhc"}
					<div style="margin:0 auto;width:40em;">
						{for start="0" end="7" name="i"}
						<select id="opencode{$i+1}-{$vo.expect}" style="padding:2px 1px;width:40px;float:left;margin:1px 2px;">
							<option value="">第{$i+1}球</option>
							{for strat="1" end="50" name="j"}
							<?php if($j<10)$j='0'.$j?>
							{neq name='j' value='0'}
							<option value="{$j}" {if condition="$opencodes[$i] eq $j"}selected{/if}>{$j}</option>
							{/neq}
							{/for}
						</select>
						{/for}
					</div>
					{/eq}
				</td>
				<td>{$vo.opentime}<input id="opentime-{$vo.expect}" type="hidden" value="{$vo.opentime}"></td>
				<td id="stateadmin-{$vo.expect}">{$vo.stateadmin}</td>
				<td class="td-manage">
					<button onClick="baocun({$vo.expect});" class="btn btn-secondary-outline radius size-S">保存</button>
				</td>
			</tr>
			{/volist}
			</tbody>
		</table>
	</div>
	{include file="Public/footer" /}
	<script>
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
			var sysname="{$admininfo['username']}";
			var
				opencode1  = $("#opencode1-"+$id),
				opencode2  = $("#opencode2-"+$id),
				opencode3  = $("#opencode3-"+$id),
				opencode4  = $("#opencode4-"+$id),
				opencode5  = $("#opencode5-"+$id),
				opencode6  = $("#opencode6-"+$id),
				opencode7  = $("#opencode7-"+$id),
				opencode8  = $("#opencode8-"+$id),
				opencode9  = $("#opencode9-"+$id),
				opencode10  = $("#opencode10-"+$id),
				opencode11  = $("#opencode11-"+$id),
				opencode12  = $("#opencode12-"+$id),
				opencode13  = $("#opencode13-"+$id),
				opencode14  = $("#opencode14-"+$id),
				opencode15  = $("#opencode15-"+$id),
				opencode16  = $("#opencode16-"+$id),
				opencode17  = $("#opencode17-"+$id),
				opencode18  = $("#opencode18-"+$id),
				opencode19  = $("#opencode19-"+$id),
				opencode20  = $("#opencode20-"+$id),
				name  = $("#name-"+$id),
				opentime  = $("#opentime-"+$id),
				url       = "{:url('ykjbaocun')}";
			layer.confirm('确定修改吗？',function(index){
				$.post(url,{'expect':$id,
					'opencode1':opencode1.val(),
					'opencode2':opencode2.val(),
					'opencode3':opencode3.val(),
					'opencode4':opencode4.val(),
					'opencode5':opencode5.val(),
					'opencode6':opencode6.val(),
					'opencode7':opencode7.val(),
					'opencode8':opencode8.val(),
					'opencode9':opencode9.val(),
					'opencode10':opencode10.val(),
					'opencode11':opencode11.val(),
					'opencode12':opencode12.val(),
					'opencode13':opencode13.val(),
					'opencode14':opencode14.val(),
					'opencode15':opencode15.val(),
					'opencode16':opencode16.val(),
					'opencode17':opencode17.val(),
					'opencode18':opencode18.val(),
					'opencode19':opencode19.val(),
					'opencode20':opencode20.val(),
					'name':name.val(),'opentime':opentime.val()}, function(json){
					if(json.status==1){
						opencode1.parents("tr").addClass('success');
						$("#stateadmin-"+$id).text(sysname);
						layer.msg(json.info,{icon:1,time:2000});
					}else if(json.status==0){
						layer.msg(json.info,{icon:2,time:3000});
					}

				}, "json");
			});
		};
	</script>
</body>
</html>