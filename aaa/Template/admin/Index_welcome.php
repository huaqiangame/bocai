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
<title>统计概况</title>
</head>
<body>
<nav class="breadcrumb">
<div class="l">
<form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
        <input type="hidden" name="uid" value="{$info.id}">
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
  
    	<div class="tabBar cl"><span>盈亏统计</span><small>&nbsp;&nbsp;(排除内部会员数据)&nbsp;&nbsp;投注盈亏 = (投注消费金额-返奖金额)&nbsp;&nbsp;&nbsp;&nbsp;充提盈亏 = 自动充值+手动加款金额-手动减款金额-提款金额</small></div>
      
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr class="text-c">
                	<th bgcolor="#f9f9f9">自动充值</th>
                	<th bgcolor="#f9f9f9">手动加</th>
                	<th bgcolor="#f9f9f9">手动减</th>
                	<th bgcolor="#f9f9f9">提款</th>
                	<th bgcolor="#f9f9f9">消费</th>
                	<th bgcolor="#f9f9f9">中奖</th>
                	<th bgcolor="#f9f9f9">活动</th>
                	<th bgcolor="#f9f9f9">充提盈亏</th>
                	<th bgcolor="#f9f9f9">投注盈亏</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-c">
                    <td>{$yingkuis.zidchongzhiall}</td>
                    <td>{$yingkuis.sdjiachongzhiall}</td>
                    <td>{$yingkuis.sdjianchongzhiall}</td>
                    <td>{$yingkuis.tikuanall}</td>
                    <td>{$yingkuis.touzhuall}</td>
                    <td>{$yingkuis.zhongjiangall}</td>
                    <td>{$yingkuis.huodongall}</td>
                    <td>{$yingkuis.ctyingkui}</td>
                    <td>{$yingkuis['tzyingkui']}</td>
                </tr>
            </tbody>
        </table>
    
  
    <div class="tabBar cl mt-20"><span>用户统计</span><small>&nbsp;&nbsp;&nbsp;&nbsp;此处为总计，不受查询时间影响（排除内部会员）</small></div>
      
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr class="text-c">
                	<th bgcolor="#f9f9f9">用户总数</th>
                	<th bgcolor="#f9f9f9">代理人数</th>
                	<th bgcolor="#f9f9f9">会员人数</th>
                	<th bgcolor="#f9f9f9">当前在线</th>
                	<th bgcolor="#f9f9f9">账户可用</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-c">
                    <td>{$usertongji.usercountall}</td>
                    <td>{$usertongji.userdailiall}</td>
                    <td>{$usertongji.userputongall}</td>
                    <td>{$usertongji.useronlineall}</td>
                    <td>{$usertongji.userbalanceall}</td>
                </tr>
            </tbody>
        </table>
  
  
    <div class="tabBar cl mt-20"><span>彩票统计</span><small>&nbsp;&nbsp;&nbsp;&nbsp;已排除内部会员、未开奖和已撤单数据</small></div>
      
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr class="text-c">
                	<th bgcolor="#f9f9f9">彩票名称</th>
                	<th bgcolor="#f9f9f9">投注金额</th>
                	<th bgcolor="#f9f9f9">中奖金额</th>
                	<th bgcolor="#f9f9f9">下注盈亏</th>
                </tr>
            </thead>
            <tbody>
                {volist name="cplist" id="vo"}
                <tr class="text-c">
                    <td>{$vo.title}</td>
                    <td>{$vo['touzhuall']?$vo['touzhuall']:0}</td>
                    <td>{$vo['zhongjiangall']?$vo['zhongjiangall']:0}</td>
                    <td>{$vo['touzhuall'] - $vo['zhongjiangall']}</td>
                </tr>
                {/volist}
                <tr class="text-c">
                    <td>总计</td>
                    <td>{$cpxiaoji['touzhuall']?$cpxiaoji['touzhuall']:0}</td>
                    <td>{$cpxiaoji['zhongjiangall']?$cpxiaoji['zhongjiangall']:0}</td>
                    <td>{$cpxiaoji['touzhuall'] - $cpxiaoji['zhongjiangall']}</td>
                </tr>
            </tbody>
        </table>
    


  
  
  
</div>
{include file="Public/footer" /}
</body>
</html>