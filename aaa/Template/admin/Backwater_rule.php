{include file="Public/meta" /}
<title>返水管理</title>
<style>
    .breadcrumb{height: 65px;}
</style>
</head>
<body>
<nav class="breadcrumb">
    <a href="javascript:;" layer-url="{:U('rule_add')}" title="添加返水" layer-width="400" layer-height="500"
       class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加返水</a>&nbsp;&nbsp;&nbsp;
    <a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="mt-5">
        <form method="post" action="">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th rowspan="2">返水级别</th>
                    <th rowspan="2">最低金额</th>
                    <th rowspan="2">最搞金额</th>
                    <th colspan="3">比例</th>
                    <th rowspan="2" >创建时间</th>
                    <th width="60" rowspan="2">操作</th>
                </tr>
                <tr class="text-c">
                    <th>视讯</th>
                    <th>体育</th>
                    <th>电子</th>
                </tr>
                </thead>
                <tbody>
                {volist name="list" id="vo"}
                <tr class="text-c">
                    <td>{$vo.level}</td>
                    <td>{$vo.low_amount}</td>
                    <td>{$vo.height_amount}</td>
                    <td>{$vo.live_scale}</td>
                    <td>{$vo.cp_scale}</td>
                    <td>{$vo.electron_scale}</td>
                    <td>{$vo.create_time|date="Y-m-d",###}</td>
                    <td class="td-manage">
                        <a style="text-decoration:none" class="ml-5" layer-url="{:U('rule_edit',['id'=>$vo['id']])}" layer-width="400" layer-height="500"
                           title="修改"><i class="Hui-iconfont">&#xe6df;</i></a>

                        <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('rule_delete',['id'=>$vo['id']])}" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                    </td>
                </tr>
                {/volist}
                </tbody>
            </table>
            <div class="cl pd-5 bg-1 bk-gray mt-20">
                <span class="r">共有数据：<strong>{:count($list)}</strong> 条</span> </div>
        </form>
    </div>
</div>
{include file="Public/footer" /}
</body>
</html>