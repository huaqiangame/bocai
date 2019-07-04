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
<title>盈亏统计</title>
</head>
<body>
<nav class="breadcrumb">
<div class="l">
<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
    	时间:<input class="input-text" type="text" style="width:100px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" name="sDate" value="{$_sDate}"> - <input class="input-text" type="text" style="width:100px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" value="{$_eDate}" name="eDate">
        
        用户名：<input class="input-text" type="text" style="width:100px;" value="{$username}" name="username">
<input class="btn btn-default-outline radius" type="submit" value="查询">
</form>
</div>
<div class="r">
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</div>
</nav>
<div class="page-container">
  
    	<div class="tabBar cl"><span>盈亏统计</span><small>&nbsp;&nbsp;&nbsp;&nbsp;投注盈亏 = (投注金额-返奖金额)&nbsp;&nbsp;&nbsp;&nbsp;充提盈亏 = 自动充值+手动加款-手动减款-提款</small></div>
      
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr class="text-c">
                	<th bgcolor="#f9f9f9">日期</th>
                	<th bgcolor="#f9f9f9">自动充值</th>
                	<th bgcolor="#f9f9f9">手动加款</th>
                	<th bgcolor="#f9f9f9">手动减款</th>
                	<th bgcolor="#f9f9f9">提款</th>
                	<th bgcolor="#f9f9f9">充提盈亏</th>
                	<th bgcolor="#f9f9f9">投注</th>
                	<th bgcolor="#f9f9f9">返奖</th>
                	<th bgcolor="#f9f9f9">活动</th>
                	<th bgcolor="#f9f9f9">投注盈亏</th>
                </tr>
            </thead>
            <tbody>
                {volist name="list" id="vo"}
                <tr class="text-c">
                    <td>{$vo.date}</td>
                    <td>{$vo.zdchongzhiall}</td>
                    <td>{$vo.sdjiachongzhiall}</td>
                    <td>{$vo.sdjianchongzhiall}</td>
                    <td>{$vo.tikuanall}</td>
                    <td>{$vo.ctyingkui}</td>
                    <td>{$vo.touzhuall}</td>
                    <td>{$vo.zhongjiangall}</td>
                    <td>{$vo.huodongall}</td>
                    <td>{$vo.tzyingkui}</td>
                </tr>
                {php}
                $xiaoji['zdchongzhiall'] += $vo['zdchongzhiall'];
                $xiaoji['sdjiachongzhiall']   += $vo['sdjiachongzhiall'];
                $xiaoji['sdjianchongzhiall']   += $vo['sdjianchongzhiall'];
                $xiaoji['tikuanall']  += $vo['tikuanall'];
                $xiaoji['ctyingkui'] += $vo['ctyingkui'];
                $xiaoji['touzhuall']  += $vo['touzhuall'];
                $xiaoji['zhongjiangall']     += $vo['zhongjiangall'];
                $xiaoji['huodongall']     += $vo['huodongall'];
                $xiaoji['tzyingkui']     += $vo['tzyingkui'];
                {/php}
                {/volist}
                <tr class="text-c warning">
                    <td>页面小计</td>
                    <td>{$xiaoji.zdchongzhiall}</td>
                    <td>{$xiaoji.sdjiachongzhiall}</td>
                    <td>{$xiaoji.sdjianchongzhiall}</td>
                    <td>{$xiaoji.tikuanall}</td>
                    <td>{$xiaoji.ctyingkui}</td>
                    <td>{$xiaoji.touzhuall}</td>
                    <td>{$xiaoji.zhongjiangall}</td>
                    <td>{$xiaoji['huodongall']}</td>
                    <td>{$xiaoji['tzyingkui']}</td>
                </tr>
            </tbody>
        </table>
    <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
        <div class="pageNav l" style="padding:0">{$page}</div>
        <div class="r">共有数据：<strong>{$totalcount}</strong> 条 </div>
    </div>
  
    


  
  
  
</div>
{include file="Public/footer" /}
</body>
</html>