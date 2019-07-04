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
<title>采集设置</title>
</head>
<body>
<nav class="breadcrumb">
<div class="l">
<p class="c-danger">更改采集设置1小时后生效</p>
</div>
<div class="r">
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</div>
</nav>
<div class="page-container">
  	<form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
    {volist name="cptypes" id="tp"}
    <div class="cptypes cl" style="margin-bottom:20px;">
        <div class="tabBar cl"><span>{$tp.cptype}</span></div>
        <div class="cplist" style="padding:10px 15px; border:1px solid #ddd; height:1%; overflow:hidden">
            {volist name="tp['cplist']" id="vo"}
            <div class="formControls col-xs-6 col-sm-4 col-md-2 skin-minimal radio-box">
                <input name="caijiset[{$vo.name}]" type="checkbox" value="1" {if condition="$caijisets[$vo['name']] eq 1"}checked{/if}>{$vo.title}
            </div>
            {/volist}
        </div>
    </div>
    {/volist}
    <input class="btn btn-success radius size-L btn-block" type="submit" value="保存设置">
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