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
<title>公告管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 公告管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form method="post" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}">
    <input type="hidden" name="moduleid" value="{$moduleid}">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a class="btn btn-primary radius" href="javascript:;" layer-url="{:U('gonggaoadd')}" title="添加信息"><i class="Hui-iconfont">&#xe600;</i> 添加公告</a></span> <span class="r"><div class="l pages">{$pageshow}</div>共有数据：<strong>{$totalcount}</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
                    <th>公告标题</th>
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
                    <td>{$vo.title}</td>
					<td>{$vo.oddtime|date='y-m-d H:i',###}</td>
                    <td class="td-manage">
                    <a style="text-decoration:none" class="ml-5" layer-url="{:U('gonggaoedit',['id'=>$vo['id']])}" title="修改信息">修改</a>
                    
                    <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('gonggaodelete',['id'=>$vo['id']])}" href="javascript:;" title="删除">删除</a>
                    </td>
				</tr>
                {/volist}
                
					
				
			</tbody>
		</table>
	</div>
    </form>
</div>
{include file="Public/footer" /}
</body>
</html>