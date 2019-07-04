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
<title>团队统计</title>
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
  
    	<div class="tabBar cl"><span>团队概况</span></div>
      
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr class="text-c">
                	<th bgcolor="#f9f9f9">用户名</th>
                	<th bgcolor="#f9f9f9">总数</th>
                	<th bgcolor="#f9f9f9">代理数</th>
                	<th bgcolor="#f9f9f9">会员数</th>
                	<th bgcolor="#f9f9f9">在线数</th>
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
                    <td>{$vo.username}</td>
                    <td>{$vo['totalcount']?$vo['totalcount']:0}</td>
                    <td>{$vo['agentcount']?$vo['agentcount']:0}</td>
                    <td>{$vo['usercount']?$vo['usercount']:0}</td>
                    <td>{$vo['onlinecount']?$vo['onlinecount']:0}</td>
                    <td>{$vo['zdrecharge']?$vo['zdrecharge']:0}</td>
                    <td>{$vo['sdjiarecharge']?$vo['sdjiarecharge']:0}</td>
                    <td>{$vo['sdjianrecharge']?$vo['sdjianrecharge']:0}</td>
                    <td>{$vo['withdraw']?$vo['withdraw']:0}</td>
                    <td>{$vo['ctyingkui']?$vo['ctyingkui']:0}</td>
                    <td>{$vo['touzhu']?$vo['touzhu']:0}</td>
                    <td>{$vo['zhongjiang']?$vo['zhongjiang']:0}</td>
                    <td>{$vo['huodong']?$vo['huodong']:0}</td>
                    <td>{$vo['tzyingkui']?$vo['tzyingkui']:0}</td>
                </tr>
                {/volist}
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