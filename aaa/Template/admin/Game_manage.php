{include file="Public/meta" /}
<title>游戏记录</title>
</head>
<body>
	<nav class="cl pt-10">
    <div class="l">
	<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
    <input type="hidden" name="refert" value="{$refert}">
&nbsp;&nbsp;内部：<span class="select-box" style="width:80px"><select class="select" name="isnb">
<option value="999">全部</option>
<option value="1" {if condition="$isnb eq 1"}selected{/if}>是</option>
<option value="0" {if condition="$isnb eq 0"}selected{/if}>否</option>
</select></span>
<?php $cplists = M('caipiao')->order('typeid asc,id desc')->select();?>
彩种：<span class="select-box" style="width:80px"><select class="select" name="cpname">
<option value="">全部</option>
{foreach name="cplists" item="cpv" key="cpk"}
<option value="{$cpv.name}" {if condition="$cpv['name'] eq $cpname"}selected{/if}>{$cpv.title}</option>
{/foreach}
</select></span>
期号：<input class="input-text" type="text" style="width:60px;" value="{$qihao}" name="qihao">
单号：<input class="input-text" type="text" style="width:60px;" value="{$trano}" name="trano">
    	时间:<input class="input-text" type="text" style="width:80px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd HH:mm'})" name="sDate" value="{$_sDate}"> - <input class="input-text" type="text" style="width:80px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd HH:mm'})" value="{$_eDate}" name="eDate">&nbsp;&nbsp;
        
        用户名：<input class="input-text" type="text" style="width:60px;" value="{$username}" name="username">
状态：<span class="select-box" style="width:80px"><select class="select" name="status">
<option value="999">全部</option>
<option value="0" {if condition="isset($status) and ($status eq 0)"}selected{/if}>未开奖</option>
<option value="1" {if condition="$status eq 1"}selected{/if}>中奖</option>
<option value="-1" {if condition="$status eq -1"}selected{/if}>未中奖</option>
<option value="-2" {if condition="$status eq -2"}selected{/if}>撤单</option>
</select></span>
排序：<span class="select-box" style="width:80px"><select class="select" name="listorder">
<option value="">默认</option>
<option value="1" {if condition="$listorder eq 1"}selected{/if}>时间大到小</option>
<option value="2" {if condition="$listorder eq 2"}selected{/if}>时间小到大</option>
<option value="3" {if condition="$listorder eq 3"}selected{/if}>金额大到小</option>
<option value="4" {if condition="$listorder eq 4"}selected{/if}>金额小到大</option>
</select></span>
        <input class="btn btn-default-outline radius" type="submit" value="查询">
        
    </form>
    </div>
  <div class="r">
    自动刷新：
    <span class="select-box" style="width:80px"><select class="select" id="refertime" name="refertime" onChange="javascipt:window.location.href=this.value">
<option value="{:U('',array_merge($_GET,['refert'=>0]))}">不刷新</option>
<option value="{:U('',array_merge($_GET,['refert'=>5]))}" {if condition="$refert eq 5"}selected{/if}>5秒</option>
<option value="{:U('',array_merge($_GET,['refert'=>10]))}" {if condition="$refert eq 10"}selected{/if}>10秒</option>
<option value="{:U('',array_merge($_GET,['refert'=>20]))}" {if condition="$refert eq 20"}selected{/if}>20秒</option>
<option value="{:U('',array_merge($_GET,['refert'=>30]))}" {if condition="$refert eq 30"}selected{/if}>30秒</option>
<option value="{:U('',array_merge($_GET,['refert'=>40]))}" {if condition="$refert eq 40"}selected{/if}>40秒</option>
<option value="{:U('',array_merge($_GET,['refert'=>50]))}" {if condition="$refert eq 50"}selected{/if}>50秒</option>
<option value="{:U('',array_merge($_GET,['refert'=>60]))}" {if condition="$refert eq 60"}selected{/if}>60秒</option>
</select></span>
    </div>
    </nav>
<div class="page-container">
	<div class="mt-5">
<!--		<p>赔率计算方法:赔率x(金额/注数)x中奖注数x中奖倍数x元角分=中奖金额 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;奖金计算方法:奖金x中奖注数x中奖倍数x元角分=中奖金额</p>
-->
 <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
                <th width="90">单号</th>
				<th width="60">用户名</th>
				<th width="80">彩票名称</th>
				<th width="60">期号</th>
				<th width="60">玩法</th>
				<!--<th width="40">模式</th>-->
				<th width="40">注数</th>
				<!--<th width="30">倍数</th>-->
				<th width="70">奖金/赔率</th>
				<th width="50">金额</th>
				<!--<th width="60">投注前金额</th>-->
				<th width="80">投注后金额</th>
				<th width="40">中奖金额</th>
				<th width="40">中奖注数</th>
				<th width="40">中奖倍数</th>
				<th width="50">元/角/分</th>
				<th width="40">号码</th>
				<th width="50">开奖号</th>
				<!--<th width="60">追号</th>-->
				<!--<th width="60">追中停</th>-->
				<!--<th width="60">来源</th>-->
				<th width="50">状态</th>
				<th width="80">投注时间</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
				<td><input type="checkbox" class="checkids" value="{$vo.id}" name="ids[{$vo.id}]"></td>
                <td>{$vo.trano}</td>
                <td>{$vo.username}</td>
                <td>{$vo.cptitle}</td>
                <td>{$vo.expect}</td>
                <td>{$vo.playtitle}</td>
                <!--<td>{if condition="$vo['yjf'] eq '1'"}元{elseif condition="$vo['yjf'] eq '0.1'" /}角{elseif condition="$vo['yjf'] eq '0.01'" /}分{elseif condition="$vo['yjf'] eq '0.001'" /}厘{/if}</td>-->
                <td>{$vo.itemcount}</td>
                <!--<td>{$vo.beishu}</td>-->
                <!--<td>{$vo.mode}/{$vo.repoint}%</td>-->
                <td>{$vo.mode}</td>
                <td>{$vo.amount}</td>
                <!--<td>{$vo.amountbefor}</td>-->
                <td>{$vo.amountafter}</td>
                <td>{$vo.okamount}</td>
                <td>{$vo.okcount}</td>
				<td>{$vo.beishu}</td>
				<td>{$vo.yjf}</td>
                <td style="padding:0">
                {if condition="strlen($vo['tzcode']) elt 20"}<p style="cursor:pointer;width:85px;height:25px; overflow:hidden;padding:0; margin:0;text-overflow: ellipsis;white-space: nowrap;" class="text-primary" trano="{$vo.trano}" tip-content="{$vo.tzcode}">{$vo.tzcode}</p>{else /}<u style="cursor:pointer;" class="text-primary" trano="{$vo.trano}" tip-content="{$vo.tzcode}">查看</u>{/if}</td>
    
                <td>{$vo.opencode}</td>
                <!--<td>{if condition="$vo['Chase'] eq '1'"}追{else /}否{/if}</td>-->
                <!--<td>{if condition="$vo['stopChase'] eq '1'"}是{else /}否{/if}</td>-->
               <!-- <td>{$vo.source}</td>-->
                <td>{if condition="$vo['isdraw'] eq '1'"}<span class="c-green">中</span>{elseif condition="$vo['isdraw'] eq '0'" /}<span class="c-333">未开奖</span>{elseif condition="$vo['isdraw'] eq '-1'" /}<span class="c-red">未中</span>{elseif condition="$vo['isdraw'] eq '-2'" /}<span class="c-666">撤</span>{/if}</td>
                <td>{$vo.oddtime|date="m-d H:i:s",###}</td>
                <td>{if condition="$vo['isdraw'] eq '0'"}<u style="cursor:pointer" class="text-primary" layer-chedan-url="{:U('chedan',['id'=>$vo['id']])}">撤单</u>{else /}---{/if}</td>
			</tr>
            {/volist}
		</tbody>
	</table>
    <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
        <div class="l" style="padding:0"><a href="javascript:;" deleteall-url="{:U('deleteall')}" title="删除" class="btn btn-danger-outline radius">删除</a></div>
        <div class="r">
            <div class="pageNav l" style="padding:0">{$page}</div>
            <div class="r">共有数据：<strong>{$totalcount}</strong> 条 </div>
        </div>
    </div>
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
		<button class="btn" data-dismiss="modal" aria-hidden="true">确定</button>
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

var refert = Number("<?=$refert;?>");
shuaxin(refert);
function shuaxin(refert){
	if(refert>0){
		setInterval("shua()", refert*1000);
	}
};

function shua(){
	var href = document.location.href;
	if(href.indexOf("refert")!=-1){
		window.location.href = href.replace("/refert=\d{2,3}/","refert="+refert);
	}else{
		if(href.indexOf("?")!=-1){
			window.location.href = document.location.href+"&refert="+$("#refertime").val();
		}else{
			window.location.href = document.location.href+"?refert="+$("#refertime").val();
		}
	}
	
}
</script> 

</script>
</body>
</html>
