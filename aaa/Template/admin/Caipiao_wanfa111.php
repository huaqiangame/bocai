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
<title>彩种管理</title>
</head>
<body>
<nav class="breadcrumb">
<a href="javascript:;" layer-url="{:U('wanfaadd')}" title="添加玩法" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加玩法</a>&nbsp;&nbsp;&nbsp;
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div id="tab-system" class="HuiTab">
        <div class="tabBar cl"><span>时时彩</span><span>11选5</span><span>快乐10分</span><span>快三</span><span>PK10</span><span>快乐彩</span><span>幸运28</span><span>3P/P3</span><span>六合彩</span></div>
        <div class="tabCon">
        <table class="table table-border table-bordered table-hover">
            {foreach name="ssc" item="vo" key="akey"}
            <thead>
                <tr>
                	<th colspan="10" bgcolor="#f9f9f9"><div class="l">{$vo.title}</div></th>
                </tr>
            </thead>
            <tbody>
                {volist name="vo['list']" id="item"}
                {php}
                $_item = $$item['playid'];
                {/php}
                <tr>
                	<td>{$item.title}：<input id="title-{$item.playid}" defaultValue="{$_item['title']}" class="input-text size-S input-change" type="text" style="width:80px;" name="title" value="{$_item['title']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="typeid-{$item.playid}" type="hidden" name="typeid" value="ssc" defaultValue="{$_item['typeid']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="playid-{$item.playid}" type="hidden" name="playid" value="{$item.playid}" defaultValue="{$item.playid}"></td>
					<?php if(isset($item['rate'])){ ?>
                	<td colspan="2">赔率：<input id="rate-{$item.playid}" defaultValue="{$_item['rate']}" class="input-text size-S input-change" type="text" style="width:60px;" name="rate" value="{$_item['rate']}"></td>
					<?php }else{ ?>
					<td>最高奖金：<input id="maxjj-{$item.playid}" defaultValue="{$_item['maxjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxjj" value="{$_item['maxjj']}"></td>
                	<td>最低奖金：<input id="minjj-{$item.playid}" defaultValue="{$_item['minjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minjj" value="{$_item['minjj']}"></td>
					<?php } ?>
                	<td>中奖最高奖金：<input id="maxprize-{$item.playid}" defaultValue="{$_item['maxprize']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxprize" value="{$_item['maxprize']}"></td>
                	<td>总注数：<input id="totalzs-{$item.playid}" defaultValue="{$_item['totalzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="totalzs" value="{$_item['totalzs']}"></td>
                	<td>最高注数：<input id="maxzs-{$item.playid}" defaultValue="{$_item['maxzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxzs" value="{$_item['maxzs']}"></td>
                	<td>最低消费：<input id="minxf-{$item.playid}" defaultValue="{$_item['minxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minxf" value="{$_item['minxf']}"></td>
                    <td><a id="{$_item['typeid']}_{$item.playid}" typeid="{$_item['typeid']}" playid="{$item.playid}" remark="{$_item['remark']}" title="{$_item['remark']}" class="btn btn-success size-MINI radius modelwfts" onClick="modelwfts(this)">玩法提示</a></td>
                	<td>
                {if condition="$_item['isopen'] eq 1"}
                <span class="label label-success radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">禁用</span>
                {/if}
                    </td>
                    <td><button onClick="baocun('{$item.playid}');" class="btn btn-secondary-outline radius size-S">保存</button></td>
                </tr>
                {/volist}
            </tbody>
            {/foreach}
        </table>
        </div>
        <div class="tabCon">
        <table class="table table-border table-bordered table-hover">
            {volist name="x5" id="vo"}
            <thead>
                <tr>
                	<th colspan="10" bgcolor="#f9f9f9"><div class="l">{$vo.title}</div></th>
                </tr>
            </thead>
            <tbody>
                {volist name="vo['list']" id="item"}
                {php}
                $_item = $$item['playid'];
                {/php}
                <tr>
                	<td>{$item.title}：<input id="title-{$item.playid}" defaultValue="{$_item['title']}" class="input-text size-S input-change" type="text" style="width:80px;" name="title" value="{$_item['title']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="typeid-{$item.playid}" type="hidden" name="typeid" value="x5" defaultValue="{$_item['typeid']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="playid-{$item.playid}" type="hidden" name="playid" value="{$item.playid}" defaultValue="{$item.playid}"></td>
					<?php if(isset($item['rate'])){ ?>
                	<td colspan="2">赔率：<input id="rate-{$item.playid}" defaultValue="{$_item['rate']}" class="input-text size-S input-change" type="text" style="width:60px;" name="rate" value="{$_item['rate']}"></td>
					<?php }else{ ?>
					<td>最高奖金：<input id="maxjj-{$item.playid}" defaultValue="{$_item['maxjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxjj" value="{$_item['maxjj']}"></td>
                	<td>最低奖金：<input id="minjj-{$item.playid}" defaultValue="{$_item['minjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minjj" value="{$_item['minjj']}"></td>
					<?php } ?>
                	<td>中奖最高奖金：<input id="maxprize-{$item.playid}" defaultValue="{$_item['maxprize']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxprize" value="{$_item['maxprize']}"></td>
                	<td>总注数：<input id="totalzs-{$item.playid}" defaultValue="{$_item['totalzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="totalzs" value="{$_item['totalzs']}"></td>
                	<td>最高注数：<input id="maxzs-{$item.playid}" defaultValue="{$_item['maxzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxzs" value="{$_item['maxzs']}"></td>
                	<td>最低消费：<input id="minxf-{$item.playid}" defaultValue="{$_item['minxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minxf" value="{$_item['minxf']}"></td>
                    <td><a id="{$_item['typeid']}_{$item.playid}" typeid="{$_item['typeid']}" playid="{$item.playid}" remark="{$_item['remark']}" title="{$_item['remark']}" class="btn btn-success size-MINI radius modelwfts" onClick="modelwfts(this)">玩法提示</a></td>
                	<td>
                {if condition="$_item['isopen'] eq 1"}
                <span class="label label-success radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">禁用</span>
                {/if}
                    </td>
                    <td><button onClick="baocun('{$item.playid}');" class="btn btn-secondary-outline radius size-S">保存</button></td>
                </tr>
                {/volist}
            </tbody>
            {/volist}
        </table>
        </div>
        <div class="tabCon">
        <table class="table table-border table-bordered table-hover">
            {volist name="kl10f" id="vo"}
            <thead>
                <tr>
                	<th colspan="10" bgcolor="#f9f9f9"><div class="l">{$vo.title}</div></th>
                </tr>
            </thead>
            <tbody>
                {volist name="vo['list']" id="item"}
                {php}
                $_item = $$item['playid'];
                {/php}
                <tr>
                	<td>{$item.title}：<input id="title-{$item.playid}" defaultValue="{$_item['title']}" class="input-text size-S input-change" type="text" style="width:80px;" name="title" value="{$_item['title']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="typeid-{$item.playid}" type="hidden" name="typeid" value="kl10f" defaultValue="{$_item['typeid']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="playid-{$item.playid}" type="hidden" name="playid" value="{$item.playid}" defaultValue="{$item.playid}"></td>
					<?php if(isset($item['rate'])){ ?>
                	<td colspan="2">赔率：<input id="rate-{$item.playid}" defaultValue="{$_item['rate']}" class="input-text size-S input-change" type="text" style="width:60px;" name="rate" value="{$_item['rate']}"></td>
					<?php }else{ ?>
					<td>最高奖金：<input id="maxjj-{$item.playid}" defaultValue="{$_item['maxjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxjj" value="{$_item['maxjj']}"></td>
                	<td>最低奖金：<input id="minjj-{$item.playid}" defaultValue="{$_item['minjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minjj" value="{$_item['minjj']}"></td>
					<?php } ?>
                	<td>中奖最高奖金：<input id="maxprize-{$item.playid}" defaultValue="{$_item['maxprize']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxprize" value="{$_item['maxprize']}"></td>
                	<td>总注数：<input id="totalzs-{$item.playid}" defaultValue="{$_item['totalzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="totalzs" value="{$_item['totalzs']}"></td>
                	<td>最高注数：<input id="maxzs-{$item.playid}" defaultValue="{$_item['maxzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxzs" value="{$_item['maxzs']}"></td>
                	<td>最低消费：<input id="minxf-{$item.playid}" defaultValue="{$_item['minxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minxf" value="{$_item['minxf']}"></td>
                    <td><a id="{$_item['typeid']}_{$item.playid}" typeid="{$_item['typeid']}" playid="{$item.playid}" remark="{$_item['remark']}" title="{$_item['remark']}" class="btn btn-success size-MINI radius modelwfts" onClick="modelwfts(this)">玩法提示</a></td>
                	<td>
                {if condition="$_item['isopen'] eq 1"}
                <span class="label label-success radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">禁用</span>
                {/if}
                    </td>
                    <td><button onClick="baocun('{$item.playid}');" class="btn btn-secondary-outline radius size-S">保存</button></td>
                </tr>
                {/volist}
            </tbody>
            {/volist}
        </table>
        </div>
        <div class="tabCon">
        <table class="table table-border table-bordered table-hover">
            {volist name="k3" id="vo"}
            <thead>
                <tr>
                	<th colspan="10" bgcolor="#f9f9f9"><div class="l">{$vo.title}</div></th>
                </tr>
            </thead>
            <tbody>
                {volist name="vo['list']" id="item"}
                {php}
                $_item = $$item['playid'];
                {/php}
                <tr>
                	<td>{$item.title}：<input id="title-{$item.playid}" defaultValue="{$_item['title']}" class="input-text size-S input-change" type="text" style="width:80px;" name="title" value="{$_item['title']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="typeid-{$item.playid}" type="hidden" name="typeid" value="k3" defaultValue="{$_item['typeid']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="playid-{$item.playid}" type="hidden" name="playid" value="{$item.playid}" defaultValue="{$item.playid}"></td>
					<?php if(isset($item['rate'])){ ?>
                	<td colspan="2">赔率：<input id="rate-{$item.playid}" defaultValue="{$_item['rate']}" class="input-text size-S input-change" type="text" style="width:60px;" name="rate" value="{$_item['rate']}"></td>
					<?php }else{ ?>
					<td>最高奖金：<input id="maxjj-{$item.playid}" defaultValue="{$_item['maxjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxjj" value="{$_item['maxjj']}"></td>
                	<td>最低奖金：<input id="minjj-{$item.playid}" defaultValue="{$_item['minjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minjj" value="{$_item['minjj']}"></td>
					<?php } ?>
                	<td>中奖最高奖金：<input id="maxprize-{$item.playid}" defaultValue="{$_item['maxprize']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxprize" value="{$_item['maxprize']}"></td>
                	<td>总注数：<input id="totalzs-{$item.playid}" defaultValue="{$_item['totalzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="totalzs" value="{$_item['totalzs']}"></td>
                	<td>最高注数：<input id="maxzs-{$item.playid}" defaultValue="{$_item['maxzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxzs" value="{$_item['maxzs']}"></td>
                	<td>最低消费：<input id="minxf-{$item.playid}" defaultValue="{$_item['minxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minxf" value="{$_item['minxf']}"></td>
                    <td><a id="{$_item['typeid']}_{$item.playid}" typeid="{$_item['typeid']}" playid="{$item.playid}" remark="{$_item['remark']}" title="{$_item['remark']}" class="btn btn-success size-MINI radius modelwfts" onClick="modelwfts(this)">玩法提示</a></td>
                	<td>
                {if condition="$_item['isopen'] eq 1"}
                <span class="label label-success radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">禁用</span>
                {/if}
                    </td>
                    <td><button onClick="baocun('{$item.playid}');" class="btn btn-secondary-outline radius size-S">保存</button></td>
                </tr>
                {/volist}
            </tbody>
            {/volist}
        </table>
        </div>
        <div class="tabCon">
        <table class="table table-border table-bordered table-hover">
            {volist name="pk10" id="vo"}
            <thead>
                <tr>
                	<th colspan="10" bgcolor="#f9f9f9"><div class="l">{$vo.title}</div></th>
                </tr>
            </thead>
            <tbody>
                {volist name="vo['list']" id="item"}
                {php}
                $_item = $$item['playid'];
                {/php}
                <tr>
                	<td>{$item.title}：<input id="title-{$item.playid}" defaultValue="{$_item['title']}" class="input-text size-S input-change" type="text" style="width:80px;" name="title" value="{$_item['title']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="typeid-{$item.playid}" type="hidden" name="typeid" value="pk10" defaultValue="{$_item['typeid']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="playid-{$item.playid}" type="hidden" name="playid" value="{$item.playid}" defaultValue="{$item.playid}"></td>
					<?php if(isset($item['rate'])){ ?>
                	<td colspan="2">赔率：<input id="rate-{$item.playid}" defaultValue="{$_item['rate']}" class="input-text size-S input-change" type="text" style="width:60px;" name="rate" value="{$_item['rate']}"></td>
					<?php }else{ ?>
					<td>最高奖金：<input id="maxjj-{$item.playid}" defaultValue="{$_item['maxjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxjj" value="{$_item['maxjj']}"></td>
                	<td>最低奖金：<input id="minjj-{$item.playid}" defaultValue="{$_item['minjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minjj" value="{$_item['minjj']}"></td>
					<?php } ?>
                	<td>中奖最高奖金：<input id="maxprize-{$item.playid}" defaultValue="{$_item['maxprize']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxprize" value="{$_item['maxprize']}"></td>
                	<td>总注数：<input id="totalzs-{$item.playid}" defaultValue="{$_item['totalzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="totalzs" value="{$_item['totalzs']}"></td>
                	<td>最高注数：<input id="maxzs-{$item.playid}" defaultValue="{$_item['maxzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxzs" value="{$_item['maxzs']}"></td>
                	<td>最低消费：<input id="minxf-{$item.playid}" defaultValue="{$_item['minxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minxf" value="{$_item['minxf']}"></td>
                    <td><a id="{$_item['typeid']}_{$item.playid}" typeid="{$_item['typeid']}" playid="{$item.playid}" remark="{$_item['remark']}" title="{$_item['remark']}" class="btn btn-success size-MINI radius modelwfts" onClick="modelwfts(this)">玩法提示</a></td>
                	<td>
                {if condition="$_item['isopen'] eq 1"}
                <span class="label label-success radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">禁用</span>
                {/if}
                    </td>
                    <td><button onClick="baocun('{$item.playid}');" class="btn btn-secondary-outline radius size-S">保存</button></td>
                </tr>
                {/volist}
            </tbody>
            {/volist}
        </table>
        </div>
        <div class="tabCon">
        <table class="table table-border table-bordered table-hover">
            {volist name="keno" id="vo"}
            <thead>
                <tr>
                	<th colspan="10" bgcolor="#f9f9f9"><div class="l">{$vo.title}</div></th>
                </tr>
            </thead>
            <tbody>
                {volist name="vo['list']" id="item"}
                {php}
                $_item = $$item['playid'];
                {/php}
                <tr>
                	<td>{$item.title}：<input id="title-{$item.playid}" defaultValue="{$_item['title']}" class="input-text size-S input-change" type="text" style="width:80px;" name="title" value="{$_item['title']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="typeid-{$item.playid}" type="hidden" name="typeid" value="keno" defaultValue="{$_item['typeid']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="playid-{$item.playid}" type="hidden" name="playid" value="{$item.playid}" defaultValue="{$item.playid}"></td>
					<?php if(isset($item['rate'])){ ?>
                	<td colspan="2">赔率：<input id="rate-{$item.playid}" defaultValue="{$_item['rate']}" class="input-text size-S input-change" type="text" style="width:60px;" name="rate" value="{$_item['rate']}"></td>
					<?php }else{ ?>
					<td>最高奖金：<input id="maxjj-{$item.playid}" defaultValue="{$_item['maxjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxjj" value="{$_item['maxjj']}"></td>
                	<td>最低奖金：<input id="minjj-{$item.playid}" defaultValue="{$_item['minjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minjj" value="{$_item['minjj']}"></td>
					<?php } ?>
                	<td>中奖最高奖金：<input id="maxprize-{$item.playid}" defaultValue="{$_item['maxprize']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxprize" value="{$_item['maxprize']}"></td>
                	<td>总注数：<input id="totalzs-{$item.playid}" defaultValue="{$_item['totalzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="totalzs" value="{$_item['totalzs']}"></td>
                	<td>最高注数：<input id="maxzs-{$item.playid}" defaultValue="{$_item['maxzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxzs" value="{$_item['maxzs']}"></td>
                	<td>最低消费：<input id="minxf-{$item.playid}" defaultValue="{$_item['minxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minxf" value="{$_item['minxf']}"></td>
                    <td><a id="{$_item['typeid']}_{$item.playid}" typeid="{$_item['typeid']}" playid="{$item.playid}" remark="{$_item['remark']}" title="{$_item['remark']}" class="btn btn-success size-MINI radius modelwfts" onClick="modelwfts(this)">玩法提示</a></td>
                	<td>
                {if condition="$_item['isopen'] eq 1"}
                <span class="label label-success radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">禁用</span>
                {/if}
                    </td>
                    <td><button onClick="baocun('{$item.playid}');" class="btn btn-secondary-outline radius size-S">保存</button></td>
                </tr>
                {/volist}
            </tbody>
            {/volist}
        </table>
        </div>
        <div class="tabCon">
        <table class="table table-border table-bordered table-hover">
            {volist name="xy28" id="vo"}
            <thead>
                <tr>
                	<th colspan="10" bgcolor="#f9f9f9"><div class="l">{$vo.title}</div></th>
                </tr>
            </thead>
            <tbody>
                {volist name="vo['list']" id="item"}
                {php}
                $_item = $$item['playid'];
                {/php}
                <tr>
                	<td>{$item.title}：<input id="title-{$item.playid}" defaultValue="{$_item['title']}" class="input-text size-S input-change" type="text" style="width:80px;" name="title" value="{$_item['title']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="typeid-{$item.playid}" type="hidden" name="typeid" value="xy28" defaultValue="{$_item['typeid']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="playid-{$item.playid}" type="hidden" name="playid" value="{$item.playid}" defaultValue="{$item.playid}"></td>
					<?php if(isset($item['rate'])){ ?>
                	<td colspan="2">赔率：<input id="rate-{$item.playid}" defaultValue="{$_item['rate']}" class="input-text size-S input-change" type="text" style="width:60px;" name="rate" value="{$_item['rate']}"></td>
					<?php }else{ ?>
					<td>最高奖金：<input id="maxjj-{$item.playid}" defaultValue="{$_item['maxjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxjj" value="{$_item['maxjj']}"></td>
                	<td>最低奖金：<input id="minjj-{$item.playid}" defaultValue="{$_item['minjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minjj" value="{$_item['minjj']}"></td>
					<?php } ?>
                	<td>中奖最高奖金：<input id="maxprize-{$item.playid}" defaultValue="{$_item['maxprize']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxprize" value="{$_item['maxprize']}"></td>
                	<td>总注数：<input id="totalzs-{$item.playid}" defaultValue="{$_item['totalzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="totalzs" value="{$_item['totalzs']}"></td>
                	<td>最高注数：<input id="maxzs-{$item.playid}" defaultValue="{$_item['maxzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxzs" value="{$_item['maxzs']}"></td>
                	<td>最低消费：<input id="minxf-{$item.playid}" defaultValue="{$_item['minxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minxf" value="{$_item['minxf']}"></td>
                    <td><a id="{$_item['typeid']}_{$item.playid}" typeid="{$_item['typeid']}" playid="{$item.playid}" remark="{$_item['remark']}" title="{$_item['remark']}" class="btn btn-success size-MINI radius modelwfts" onClick="modelwfts(this)">玩法提示</a></td>
                	<td>
                {if condition="$_item['isopen'] eq 1"}
                <span class="label label-success radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">禁用</span>
                {/if}
                    </td>
                    <td><button onClick="baocun('{$item.playid}');" class="btn btn-secondary-outline radius size-S">保存</button></td>
                </tr>
                {/volist}
            </tbody>
            {/volist}
        </table>
        </div>
        <div class="tabCon">
        <table class="table table-border table-bordered table-hover">
            {volist name="dp3" id="vo"}
            <thead>
                <tr>
                	<th colspan="10" bgcolor="#f9f9f9"><div class="l">{$vo.title}</div></th>
                </tr>
            </thead>
            <tbody>
                {volist name="vo['list']" id="item"}
                {php}
                $_item = $$item['playid'];
                {/php}
                <tr>
                	<td>{$item.title}：<input id="title-{$item.playid}" defaultValue="{$_item['title']}" class="input-text size-S input-change" type="text" style="width:80px;" name="title" value="{$_item['title']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="typeid-{$item.playid}" type="hidden" name="typeid" value="dpc" defaultValue="{$_item['typeid']}">
                    <input class="input-text size-S input-change" style="width:80px;" id="playid-{$item.playid}" type="hidden" name="playid" value="{$item.playid}" defaultValue="{$item.playid}"></td>
					<?php if(isset($item['rate'])){ ?>
                	<td colspan="2">赔率：<input id="rate-{$item.playid}" defaultValue="{$_item['rate']}" class="input-text size-S input-change" type="text" style="width:60px;" name="rate" value="{$_item['rate']}"></td>
					<?php }else{ ?>
					<td>最高奖金：<input id="maxjj-{$item.playid}" defaultValue="{$_item['maxjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxjj" value="{$_item['maxjj']}"></td>
                	<td>最低奖金：<input id="minjj-{$item.playid}" defaultValue="{$_item['minjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minjj" value="{$_item['minjj']}"></td>
					<?php } ?>
                	<td>中奖最高奖金：<input id="maxprize-{$item.playid}" defaultValue="{$_item['maxprize']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxprize" value="{$_item['maxprize']}"></td>
                	<td>总注数：<input id="totalzs-{$item.playid}" defaultValue="{$_item['totalzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="totalzs" value="{$_item['totalzs']}"></td>
                	<td>最高注数：<input id="maxzs-{$item.playid}" defaultValue="{$_item['maxzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxzs" value="{$_item['maxzs']}"></td>
                	<td>最低消费：<input id="minxf-{$item.playid}" defaultValue="{$_item['minxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minxf" value="{$_item['minxf']}"></td>
                    <td><a id="{$_item['typeid']}_{$item.playid}" typeid="{$_item['typeid']}" playid="{$item.playid}" remark="{$_item['remark']}" title="{$_item['remark']}" class="btn btn-success size-MINI radius modelwfts" onClick="modelwfts(this)">玩法提示</a></td>
                	<td>
                {if condition="$_item['isopen'] eq 1"}
                <span class="label label-success radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">启用</span>
                {else /}
                <span class="label label-defaunt radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">禁用</span>
                {/if}
                    </td>
                    <td><button onClick="baocun('{$item.playid}');" class="btn btn-secondary-outline radius size-S">保存</button></td>
                </tr>
                {/volist}
            </tbody>
            {/volist}
        </table>
        </div>
        <div class="tabCon">
            <div id="tab-lhc" class="HuiTab1">
            	
                <div class="tabBar1 cl">{volist name="lhc" id="vo"}<span>{$vo.title}</span>{/volist}</div>
                {volist name="lhc" id="vo"}
                <div class="tabCon1">
                    <table class="table table-border table-bordered table-hover">
                        <tbody>
                            {volist name="vo['list']" id="item"}
                            {php}
                            $_item = $$item['playid'];
                            {/php}
                            <tr>
                                <td>{$item.title}：<input id="title-{$item.playid}" defaultValue="{$_item['title']}" class="input-text size-S input-change" type="text" style="width:80px;" name="title" value="{$_item['title']}">
                                <input class="input-text size-S input-change" style="width:80px;" id="typeid-{$item.playid}" type="hidden" name="typeid" value="ssc" defaultValue="{$_item['typeid']}">
                                <input class="input-text size-S input-change" style="width:80px;" id="playid-{$item.playid}" type="hidden" name="playid" value="{$item.playid}" defaultValue="{$item.playid}"></td>
					<?php if(isset($item['rate'])){ ?>
                	<td colspan="2">赔率：<input id="rate-{$item.playid}" defaultValue="{$_item['rate']}" class="input-text size-S input-change" type="text" style="width:60px;" name="rate" value="{$_item['rate']}"></td>
					<?php }else{ ?>
					<td>最高奖金：<input id="maxjj-{$item.playid}" defaultValue="{$_item['maxjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxjj" value="{$_item['maxjj']}"></td>
                	<td>最低奖金：<input id="minjj-{$item.playid}" defaultValue="{$_item['minjj']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minjj" value="{$_item['minjj']}"></td>
					<?php } ?>
                	<td>中奖最高奖金：<input id="maxprize-{$item.playid}" defaultValue="{$_item['maxprize']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxprize" value="{$_item['maxprize']}"></td>
                                <td>总注数：<input id="totalzs-{$item.playid}" defaultValue="{$_item['totalzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="totalzs" value="{$_item['totalzs']}"></td>
                                <td>最高注数：<input id="maxzs-{$item.playid}" defaultValue="{$_item['maxzs']}" class="input-text size-S input-change" type="text" style="width:60px;" name="maxzs" value="{$_item['maxzs']}"></td>
                                <td>最低消费：<input id="minxf-{$item.playid}" defaultValue="{$_item['minxf']}" class="input-text size-S input-change" type="text" style="width:60px;" name="minxf" value="{$_item['minxf']}"></td>
                                <td><a id="{$_item['typeid']}_{$item.playid}" typeid="{$_item['typeid']}" playid="{$item.playid}" remark="{$_item['remark']}" title="{$_item['remark']}" class="btn btn-success size-MINI radius modelwfts" onClick="modelwfts(this)">玩法提示</a></td>
                                <td>
                            {if condition="$_item['isopen'] eq 1"}
                            <span class="label label-success radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">启用</span>
                            {else /}
                            <span class="label label-defaunt radius" status-url="{:url('setwfstatus',['typeid'=>$_item['typeid'],'playid'=>$item['playid'],'name'=>'isopen'])}">禁用</span>
                            {/if}
                                </td>
                                <td><button onClick="baocun('{$item.playid}');" class="btn btn-secondary-outline radius size-S">保存</button></td>
                            </tr>
                            {/volist}
                        </tbody>
                        
                    </table>
                </div>
                {/volist}
            </div>
        </div>
        
    </div>
</div>
{include file="Public/footer" /}
<script type="text/javascript" src="../Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modal.js"></script> 

<div id="modalwfts" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		$.post("{:url('editmodelwfts')}",{'typeid':typeid,'playid':playid,'remark':remark},function(json){
			if(json.status==1){
				$("#_wfts_typeid").val('');$("#_wfts_playid").val('');$("#_wfts_remark").val('');
				$("#"+typeid+"_"+playid).attr({'remark':remark,'title':remark});
				$("#modalwfts").modal("hide");
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
	$("#modalwfts").modal("show");
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
		playid = $("#playid-"+$id),
		maxjj  = $("#maxjj-"+$id),
		minjj  = $("#minjj-"+$id),
		rate   = $("#rate-"+$id),
		maxzs  = $("#maxzs-"+$id),
		minxf  = $("#minxf-"+$id),
		title  = $("#title-"+$id),
		maxprize  = $("#maxprize-"+$id),
		totalzs  = $("#totalzs-"+$id),
		url       = "{:url('wfbaocun')}";
	layer.confirm('确定修改吗？'
	,{btn: ['确定','取消']}
	,function(index){
		
		$.post(
		url,
		{
			'id':$id,
			'typeid':typeid.val(),
			'playid':playid.val(),
			'maxjj':maxjj.val(),
			'minjj':minjj.val(),
			'rate':rate.val(),
			'maxzs':maxzs.val(),
			'minxf':minxf.val(),
			'maxprize':maxprize.val(),
			'totalzs':totalzs.val(),
			'title':title.val()
		},
		function(json){
			if(json.status==1){
				maxjj.attr('defaultValue',maxjj.val()).removeClass('danger').addClass('success');
				minjj.attr('defaultValue',minjj.val()).removeClass('danger').addClass('success');
				rate.attr('defaultValue',rate.val()).removeClass('danger').addClass('success');
				maxzs.attr('defaultValue',maxzs.val()).removeClass('danger').addClass('success');
				minxf.attr('defaultValue',minxf.val()).removeClass('danger').addClass('success');
				title.attr('defaultValue',title.val()).removeClass('danger').addClass('success');
				typeid.attr('defaultValue',typeid.val()).removeClass('danger').addClass('success');
				playid.attr('defaultValue',playid.val()).removeClass('danger').addClass('success');
				totalzs.attr('defaultValue',totalzs.val()).removeClass('danger').addClass('success');
				maxprize.attr('defaultValue',maxprize.val()).removeClass('danger').addClass('success');
				layer.msg(json.info,{icon:1,time:2000});
			}else if(json.status==0){
				layer.msg(json.info,{icon:2,time:3000});
			}
			
		}, "json");
	});
};
$.Huitab("#tab-lhc .tabBar1 span","#tab-lhc .tabCon1","current","click","0");
</script>
</body>
</html>