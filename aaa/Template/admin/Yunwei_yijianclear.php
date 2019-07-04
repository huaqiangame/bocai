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
<title>一键清理数据</title>
</head>
<body>
<nav class="breadcrumb">
<div class="l">
<p class="c-danger">每月1号清理数据为本月1号0点以前的数据</p>
</div>
<div class="r">
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</div>
</nav>
<div class="page-container">
  	<form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
    <div class="cptypes cl" style="margin-bottom:20px;">
        <div class="tabBar cl"><span>一键清理数据</span></div>
        <div class="cplist" style="padding:10px 15px; border:1px solid #ddd; height:1%; overflow:hidden">
            <div class="formControls col-xs-6 col-sm-4 col-md-2 skin-minimal radio-box">
                <input name="cleardb[cz]" type="checkbox" value="1">充值记录
            </div>
            <div class="formControls col-xs-6 col-sm-4 col-md-2 skin-minimal radio-box">
                <input name="cleardb[tk]" type="checkbox" value="1">提款记录
            </div>
            <div class="formControls col-xs-6 col-sm-4 col-md-2 skin-minimal radio-box">
                <input name="cleardb[tz]" type="checkbox" value="1">游戏记录
            </div>
            <div class="formControls col-xs-6 col-sm-4 col-md-2 skin-minimal radio-box">
                <input name="cleardb[zb]" type="checkbox" value="1">账变记录
            </div>
            <div class="formControls col-xs-6 col-sm-4 col-md-2 skin-minimal radio-box">
                <input name="cleardb[hd]" type="checkbox" value="1">活动记录
            </div>
            <div class="formControls col-xs-6 col-sm-4 col-md-2 skin-minimal radio-box">
                <input name="cleardb[kj]" type="checkbox" value="1">开奖记录
            </div>
        </div>
    </div>
    
    <input class="btn btn-success radius size-L btn-block" type="submit" value="一键清理数据">
    </form>
      
  
    


  
  
  
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