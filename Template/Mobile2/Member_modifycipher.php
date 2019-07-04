<include file="Public/header" />
    
<body> 
    
    <header class="ui-header">
        <i class="ui-icon rui-l-btn rui-icon-back" onClick="window.history.back()">&nbsp;&nbsp;&nbsp;</i>
        <h1>预留验证信息</h1>
        <a href="{:U('Mobil/User/setting')}" class="ui-icon rui-r-btn rui-icon-set">&nbsp;&nbsp;&nbsp;</a>
    </header> 
    <footer class="ui-footer">
        <ul class="ui-tiled">
            <li><a href="{:U('Mobil/Index/index')}" class="c_wite"><i class="rui-footer-ftj">&nbsp;</i><div>购彩大厅</div></a></li>
            <li><a href="{:U('Mobil/User/tz')}" class="c_wite"><i class="rui-footer-buy">&nbsp;</i><div>投注记录</div></a></li>
            <li><a href="{:U('Mobil/Lottery/betting_list')}" class="c_wite"><i class="rui-footer-open">&nbsp;</i><div>开奖信息</div></a></li>
            <li class="current"><a href="{:U('Mobil/User/index')}" class="c_wite"><i class="rui-footer-account">&nbsp;</i><div>我的彩票</div></a></li>
        </ul> 
    </footer>
    <section class="ui-container"> 
          
        <div class="rui-form-container ui-border-t">
            <form method="post" id="form1" onSubmit="return checkform(this)">
                <div class="ui-form-item ui-border-b">
                    <label>预留信息</label>
                    <input type="text" name="modify" value="{$userinfo['modify']}" placeholder="请输入预留信息">
                </div>
                <div class="ui-btn-wrap">
                    <input type="submit" class="ui-btn-lg ui-btn-danger" value="确定修改" />
                </div>
            </form>
        </div> 
          <div class="clr"></div>
    </section> 
<script>
function checkform(obj){
	$.post($(obj).attr('action'),$(obj).serialize(), function(json){
		if(json.status==1){
			alt(json.info,'success');
			window.location.reload();
		}else{
			alt(json.info);
		};
	},'json'); 
	return false;
};
</script>
</body>
</html>