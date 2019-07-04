<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/html5.js"></script>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/respond.min.js"></script>
<script type="text/javascript" src="../Template/admin/resources/ui/lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="../Template/admin/resources/ui/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>资讯列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 信息管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
    	<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}">
<!--<span class="select-box inline">
            <select name="moduleid" class="select">
                <option value="0">==选择模型==</option>
                {volist name="modulelist" id="md"}
                <option value="{$md.name}" {if condition="$md['name'] eq $moduleid"}selected{/if}>{$md.title}</option>
                {/volist}
            </select>
		</span>-->
    	<span class="select-box inline">
            <select name="catid" class="select">
                <option value="0">==选择栏目==</option>
                {volist name="catelist" id="cat"}
                <option value="{$cat.id}" {if condition="$cat['id'] eq $catid"}selected{/if} >{$cat.spacer}{$cat.catname}</option>
                {/volist}
            </select>
		</span>
        <button name="" id="" class="btn btn-success" type="submit">搜索</button>
	</form>
</div>
	<form method="post" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}">
    <input type="hidden" name="moduleid" value="{$moduleid}">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a class="btn btn-primary radius" href="javascript:;" layer-url="{:U('add',['catid'=>$catid])}" title="添加信息"><i class="Hui-iconfont">&#xe600;</i> 添加信息</a></span> <span class="r"><div class="l pages">{$pageshow}</div>共有数据：<strong>{$totalcount}</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
                    <th width="80">栏目名称</th>
                    <th class="text-l">标题</th>
					<th width="90">发布时间</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
            	<?php $empty = "<tr class='text-c'><td colspan='20'>暂时没有数据</td></tr>";?>
				{volist name="list" id="vo" empty="$empty"}
                <tr class="text-c">
					<td><input type="checkbox" class="checkids" value="{$vo.id}" name="ids[{$vo.id}]"></td>
					<td>{$vo.id}</td>
                    <td>{$vo.catname}</td>
                    <td class="text-l">{$vo.title}</td>
					<td>{$vo.oddtime|date='y-m-d H:i',###}</td>
                    <td class="td-manage">
                    <a style="text-decoration:none" class="ml-5" layer-url="{:U('edit',['id'=>$vo['id']])}" title="修改信息">修改</a>
                    
                    <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('delete',['id'=>$vo['id']])}" href="javascript:;" title="删除">删除</a>
                    </td>
				</tr>
                {/volist}
                
					
				
			</tbody>
		</table>
	</div>
    <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
        <div class="l" style="padding:0"><a href="javascript:;" deleteall-url="{:U('deleteall')}" title="删除" class="btn btn-danger-outline radius">删除</a></div>
        <div class="r">
            <div class="pageNav l" style="padding:0">{$page}</div>
            <div class="r">共有数据：<strong>{$totalcount}</strong> 条 </div>
        </div>
    </div>	
    </form>
</div>
{include file="Public/footer" /}
</body>
</html>