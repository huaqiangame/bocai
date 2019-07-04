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
<title>数据清理</title>
</head>
<body>
<div class="page-container">
  <div class="tabBar cl"><span>数据清理</span></div>
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                <th bgcolor="#f9f9f9" width="100">数据项目</th>
                <th bgcolor="#f9f9f9">清理条件</th>
                <th bgcolor="#f9f9f9" width="60">操作</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-c">
                <th rowspan="3">会员账号清理</th>
                <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form AjaxPostForm">
                <td>账户金额低于<input type="number" name="user[clearamountmin]" class="input-text" value="1" style="width:60px;" min="0" max="1">元&nbsp;，&nbsp;
并且<input type="number" name="user[clearday]" class="input-text" value="60" style="width:60px;" min="30">天未登录</td>
                <td><button class="btn btn-danger-outline radius size-S" type="submit"><i class="Hui-iconfont">&#xe609;</i> 清理</button></td>
                </form>
            </tr>
            <tr class="text-c">
                <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form AjaxPostForm">
                <td>注册<input type="number" name="user1[clearday]" class="input-text" value="15" style="width:60px;" min="7">天内未登录</td>
                <td><button class="btn btn-danger-outline radius size-S" type="submit"><i class="Hui-iconfont">&#xe609;</i> 清理</button></td>
                </form>
            </tr>
            <tr class="text-c">
                <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form AjaxPostForm">
                <td>内部账号 <input name="isnbuser" type="checkbox" value="1">全部</td>
                <td><button class="btn btn-danger-outline radius size-S" type="submit"><i class="Hui-iconfont">&#xe609;</i> 清理</button></td>
                </form>
            </tr>
            <tr class="text-c">
                <th>开奖数据清理</th>
                <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form AjaxPostForm">
                <td>清理<input type="number" name="kaijiang[clearday]" class="input-text" value="2" style="width:60px;" min="1">天前的开奖</td>
                <td><button class="btn btn-danger-outline radius size-S" type="submit"><i class="Hui-iconfont">&#xe609;</i> 清理</button></td>
                </form>
            </tr>
            <tr class="text-c">
                <th>投注数据清理</th>
                <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form AjaxPostForm">
                <td>清理<input type="number" name="touzhu[clearday]" class="input-text" value="60" style="width:60px;" min="45">天前,类型:<span class="select-box" style="width:80px"><select class="select" name="touzhu[state]"><option value="999">全部</option><option value="0">未开奖</option><option value="-2">撤单</option></select></span>投注记录</td>
                <td><button class="btn btn-danger-outline radius size-S" type="submit"><i class="Hui-iconfont">&#xe609;</i> 清理</button></td>
                </form>
            </tr>
            <tr class="text-c">
                <th>充值数据清理</th>
                <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form AjaxPostForm">
                <td>清理清理<input type="number" name="recharge[clearday]" class="input-text" value="45" style="width:60px;" min="1">天前,类型:<span class="select-box" style="width:80px"><select class="select" name="recharge[state]"><option value="999">全部</option><option value="0">未审核</option><option value="-1">取消</option></select></span>的充值记录</td>
                <td><button class="btn btn-danger-outline radius size-S" type="submit"><i class="Hui-iconfont">&#xe609;</i> 清理</button></td>
                </form>
            </tr>
            <tr class="text-c">
                <th>提款数据清理</th>
                <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form AjaxPostForm">
                <td>清理<input type="number" name="withdraw[clearday]" class="input-text" value="45" style="width:60px;" min="1">天前,类型:<span class="select-box" style="width:80px"><select class="select" name="withdraw[state]"><option value="999">全部</option><option value="0">未审核</option><option value="-1">退回取消</option></select></span>的充值记录</td>
                <td><button class="btn btn-danger-outline radius size-S" type="submit"><i class="Hui-iconfont">&#xe609;</i> 清理</button></td>
                </form>
            </tr>
            <tr class="text-c">
                <th>账变记录数据清理</th>
                <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form AjaxPostForm">
                <td>清理<input type="number" name="fuddetail[clearday]" class="input-text" value="45" style="width:60px;" min="45">天前的账变记录</td>
                <td><button class="btn btn-danger-outline radius size-S" type="submit"><i class="Hui-iconfont">&#xe609;</i> 清理</button></td>
                </form>
            </tr>
            <tr class="text-c">
                <th>会员日志清理</th>
                <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form AjaxPostForm">
                <td>清理<input type="number" name="memlog[clearday]" class="input-text" value="7" style="width:60px;" min="7">天前的记录</td>
                <td><button class="btn btn-danger-outline radius size-S" type="submit"><i class="Hui-iconfont">&#xe609;</i> 清理</button></td>
                </form>
            </tr>
            <tr class="text-c">
                <th>管理员日志清理</th>
                <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form AjaxPostForm">
                <td>清理<input type="number" name="adminlog[clearday]" class="input-text" value="7" style="width:60px;" min="7">天前的记录</td>
                <td><button class="btn btn-danger-outline radius size-S" type="submit"><i class="Hui-iconfont">&#xe609;</i> 清理</button></td>
                </form>
            </tr>
        </tbody>
    </table> 
</div>
{include file="Public/footer" /}
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-green',
		radioClass: 'iradio-green',
		increaseArea: '20%'
	});
	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
});
</script>
</body>
</html>