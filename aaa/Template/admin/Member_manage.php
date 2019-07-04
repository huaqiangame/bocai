{include file="Public/meta" /}
<title>会员管理</title>
</head>
<body>
<nav class="breadcrumb">
<span class="l">
<a href="javascript:;" layer-url="{:U('useradd')}" title="添加会员" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加会员</a>&nbsp;&nbsp;&nbsp;
排序：<span class="select-box" style="width:100px"><select class="select" name="ordertype" onChange="window.location.href = this.value">
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>0]))}">默认排序</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>1]))}" {if condition="$ordertype eq 1"}selected{/if}>注册时间低到高</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>2]))}" {if condition="$ordertype eq 2"}selected{/if}>彩票返点高到低</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>3]))}" {if condition="$ordertype eq 3"}selected{/if}>彩票返点低到高</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>4]))}" {if condition="$ordertype eq 4"}selected{/if}>账户金额高到低</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>5]))}" {if condition="$ordertype eq 5"}selected{/if}>账户金额低到高</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>6]))}" {if condition="$ordertype eq 6"}selected{/if}>账户积分高到低</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>7]))}" {if condition="$ordertype eq 7"}selected{/if}>账户积分低到高</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>8]))}" {if condition="$ordertype eq 8"}selected{/if}>洗码余额高到低</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>9]))}" {if condition="$ordertype eq 9"}selected{/if}>洗码余额低到高</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>16]))}" {if condition="$ordertype eq 16"}selected{/if}>登陆时间高到低</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>17]))}" {if condition="$ordertype eq 17"}selected{/if}>登陆时间低到高</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>18]))}" {if condition="$ordertype eq 18"}selected{/if}>在线时间高到低</option>
<option value="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,array_merge($_GET,['ordertype'=>19]))}" {if condition="$ordertype eq 19"}selected{/if}>在线时间低到高</option>
</select></span>
</span>

<span class="r">
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</span>
</nav>
<div class="page-container">
	<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
<input type="hidden" name="ordertype" value="{$ordertype}">
会员组：<span class="select-box" style="width:80px"><select class="select" name="groupid">
<option value="0">全部</option>
{volist name="grouplist" id="gvo"}
<option value="{$gvo.groupid}" {if condition="$gvo['groupid'] eq $groupid"}selected{/if}>{$gvo.groupname}</option>
{/volist}
</select></span>
类型：<span class="select-box" style="width:80px"><select class="select" name="proxy">
<option value="999">全部</option>
<option value="1" {if condition="$proxy eq 1"}selected{/if}>代理</option>
<option value="0" {if condition="$proxy eq 0"}selected{/if}>会员</option>
</select></span>
&nbsp;&nbsp;内部：<span class="select-box" style="width:80px"><select class="select" name="isnb">
<option value="999">全部</option>
<option value="1" {if condition="$isnb eq 1"}selected{/if}>是</option>
<option value="0" {if condition="$isnb eq 0"}selected{/if}>否</option>
</select></span>
在线：<input type="checkbox" value="1" name="isonline" {if condition="$isonline eq 1"}checked{/if}>&nbsp;&nbsp;

        

    	注册时间:<input class="input-text" type="text" style="width:80px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" name="sDate" value="{$_sDate}"> - <input class="input-text" type="text" style="width:80px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" value="{$_eDate}" name="eDate">&nbsp;&nbsp;
    	金额:<input class="input-text" type="text" style="width:60px;" name="sAmount" value="{$_sAmount}"> - <input class="input-text" type="text" style="width:60px;" value="{$_eAmount}" name="eAmount">
        
<br><br>
        用户名：<input class="input-text" type="text" style="width:60px;" value="{$username}" name="username">
        姓名：<input class="input-text" type="text" style="width:60px;" value="{$userbankname}" name="userbankname">
        &nbsp;&nbsp;QQ：<input class="input-text" type="text" style="width:60px;" value="{$qq}" name="qq">
		{present name="parentid"}
        <input name="parentid" type="hidden" value="{$parentid}">
        <a class="btn btn-default-outline radius" href="{:U('manage',['parentid'=>$parentid])}">重置</a>
        {else /}
        &nbsp;&nbsp;昵称：<input class="input-text" type="text" style="width:60px;" value="{$nickname}" name="nickname">
        &nbsp;&nbsp;登陆IP：<input class="input-text" type="text" style="width:60px;" value="{$loginip}" name="loginip">
        {/present}
        <input class="btn btn-primary-outline radius" type="submit" value="查询">
        
    </form>
	<div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
                <th width="40">ID</th>
				<th width="60">会员组</th>
				<th width="60">用户名</th>
				<th width="60">姓名</th>
				<th width="60">上线</th>
				<th width="60">类型</th>
				<th width="60">晋级记录</th>
				<th width="60">金额</th>
				<th width="60">积分</th>
				<th width="60">返点</th>
				
				<th width="75">洗码余额</th>
				<th width="70">总充值</th>
				<th width="70">总提款</th>
				<th width="70">总输赢</th>
				<th width="40">登陆时间</th>
				<th width="40">登陆来源</th>
				<th width="30">状态</th>
				<th width="30">资料</th>
				<th width="125">操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="list" id="vo"}
            <tr class="text-c">
				<td><input type="checkbox" class="checkids" value="{$vo.id}" name="ids[{$vo.id}]"></td>
                <td>{$vo.id}</td>
                <td>{$grouplist[$vo['groupid']]['groupname']}</td>
                <td><u style="cursor:pointer" class="text-primary" layer-url="{:U('useredit',['id'=>$vo['id']])}" title="编辑-{$vo.username}">{$vo.username}</u></td>
                <td>{$vo.userbankname}</td>
                <td>{$vo.shangji}</td>
                <td>{if condition="$vo['proxy'] eq 1"}代理{elseif condition="$vo['proxy'] eq 0" /}会员{/if}</td>
               <!-- <td>{$grouplist[$vo['groupid']]['groupname']}</td>-->
				<td>VIP{$vo.jinjijilu}</td>
                <td><u style="cursor:pointer" class="text-primary" layer-url="{:U('balance',['id'=>$vo['id']])}" title="修改-{$vo.username}金额">{$vo.balance}</u></td>
                <td><u style="cursor:pointer" class="text-primary" layer-url="{:U('point',['id'=>$vo['id']])}" title="修改-{$vo.username}积分">{$vo.point}</u></td>
				<td>{$vo.fandian}%</td>

                <td><u style="cursor:pointer" class="text-primary" layer-url="{:U('xima',['id'=>$vo['id']])}" title="修改-{$vo.username}洗码余额">{$vo.xima}</u></td>
                <td><u style="cursor:pointer" class="text-primary" layer-url="{:U('recharge',['uid'=>$vo['id']])}" title="{$vo.username}的充值记录">总充值</u></td>
                <td><u style="cursor:pointer" class="text-primary" layer-url="{:U('withdraw',['uid'=>$vo['id']])}" title="{$vo.username}的充值记录">总提款</u></td>
                <td><u style="cursor:pointer" class="text-primary" layer-url="{:U('Tongji/user',['username'=>$vo['username']])}" title="{$vo.username}的游戏统计">总输赢</u></td>
                <td>{$vo.logintime|date="m-d H:i",###}</td>
                <td>{$vo.loginsource}</td>
                <td>{if condition="$vo['isonline'] eq 1"}<span class="c-green">在线</span>{else /}<span class="c-999">离线</span>{/if}</td>
				<td><u style="cursor:pointer" class="text-primary" layer-url="{:U('ziliao',['id'=>$vo['id']])}" title="查看-{$vo.username}资料">资料</u></td>

				<td class="td-manage">
                <u style="cursor:pointer" class="text-primary" layer-url="{:U('fuddetail',['uid'=>$vo['id']])}" title="帐变-{$vo.username}">帐变</u> | <u style="cursor:pointer" class="text-primary" layer-url="{:U('useredit',['id'=>$vo['id']])}" title="编辑-{$vo.username}">编辑</u> | <u style="cursor:pointer" class="text-primary" layer-url="{:U('manage',['parentid'=>$vo['id']])}" layer-width="100%" layer-height="100%" title="查看下级-{$vo.username}">下级</u>
                <br>
                <u style="cursor:pointer" class="text-primary" layer-del-url="{:U('userdelete',['id'=>$vo['id']])}" title="删-{$vo.username}">删</u> | <u style="cursor:pointer" class="text-primary" layer-alt-url="{:U('unline',['id'=>$vo['id']])}" title="踢-{$vo.username}">踢</u> | <u style="cursor:pointer" class="text-primary {if condition='$vo[islock] eq 0'}c-999{elseif condition='$vo[islock] eq 1' /}c-green{/if}" lock-url="{:U('lock',['id'=>$vo['id']])}" title="锁定/解锁-{$vo.username}">{if condition="$vo['islock'] eq 0"}锁定{elseif condition="$vo['islock'] eq 1" /}解锁{/if}</u>
                    |<u style="cursor:pointer" class="text-primary" layer-url="{:U('live_fandian',['id'=>$vo['id']])}" title="返点-{$vo.username}">返点</u>
                </td>
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