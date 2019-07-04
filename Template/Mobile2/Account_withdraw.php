
    
<include file="Public/header" /><body> 
    <header class="ui-header">
        <i class="ui-icon rui-l-btn rui-icon-back" onClick="window.history.back();">&nbsp;&nbsp;&nbsp;</i>
        <h1>提款</h1>
         <a href="{:GetVar('kefudaima')}" class="rui-r-btn2"><img style="width:28px;height:28px" src="__IMG__/rui-contact-icon2.png" />联系客服</a>  
        <a href="{:U('Mobil/User/index')}" class="ui-icon rui-r-btn rui-icon-user">&nbsp;&nbsp;&nbsp;</a>
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
        <div class="rui-form-container ui-border-t mgt0" id="WX_recharge_container">
<form class="am-form register_form" method="post" url="" checkby_ruivalidate id="register_form" onSubmit="return checkform(this)">
                <div class="ui-form-item ui-border-b">
                    <label>银行</label>
                    <div class="ui-select">
						<if condition="is_array($banklist)">
						<select name="bid">
							<option value="0">请选择银行</option>
							  
							<volist name="banklist" id="vo"><option value="{$vo.bid}">{$vo.bankname}({$vo.banknumber})</option></volist>
							  
							
						</select>
						<else />
						<span><p style="color: black; display:inline">请先<a style="padding: 5px 5px; color: red;" href="{:U('User/bindcard')}">绑定银行账户</a></p></span>
						</if>
                    </div> 
                </div>
                <div class="ui-form-item ui-border-b">
                    <label>提款金额</label>  
                    <input type="text" name="amount" value="100"  onafterpaste="formatIntVal(this)" onKeyUp="formatIntVal(this)" placeholder="提款金额">
                </div> 
                <div class="ui-form-item ui-border-b">
                    <label>账户可用金额</label>  
                    <input type="text" disabled="disabled" value="{$userinfo.money}"  onafterpaste="formatIntVal(this)" onKeyUp="formatIntVal(this)">
                </div> 
                <div class="ui-form-item ui-border-b">
                    <label>资金密码</label>  
					<if condition="$rpassword eq ''">
						<span><p style="color: black; display:inline">请先设置<a style="padding: 5px 5px; color: red;" href="{:U('User/safepass')}">资金密码</a></p></span>
					<else />
						<input type="password" name="pass" isnot="true" msg="请填写资金密码">
					</if>
                </div> 
            <div class="ui-btn-wrap">
                <if condition="(is_array($banklist)) and ($rpassword neq '')">
				<input id="confirm" type="submit" class="ui-btn-lg ui-btn-danger sub_btn ty_btn" value="确认提款" />
				</if>
            </div>
			</form>
        </div> 
        <div class="clr"></div>

    </section> 
<script>
function checkform(obj){
	var amount  = $(obj).find("input[name='amount']");
	var minwithdraw = Number("{:GetVar('minwithdraw')}")>0?Number("{:GetVar('minwithdraw')}"):100;
	if(Number(amount.val())<minwithdraw){
		alt('最低提款金额为'+minwithdraw+'元',0);return false;
	};
	$.post($(obj).attr('action'),$(obj).serialize(), function(json){
		if(json.status==1){
			alt(json.info,'success');
			//window.location.reload();
		}else{
			alt(json.info,'warning');
		};
	},'json'); 
	return false;
};
</script>
</body>
</html>
