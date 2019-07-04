<include file="Public/header" />

<style type="text/css">
.table_code_border th,.table_code_border td{border-bottom:1px solid #ddd; padding:10px 5px;}
</style>
<!--wapper-->

<div class="wapper ">
	<div class="w1000">
    	<include file="Public:ubanner" />
        <div class="u_two_bann">
                <a href="{:U('Account/recharge')}">我要充值</a>
                <a href="{:U('Account/withdraw')}" class="curr">我要取款</a>
				<a href="{:U('Account/fuddetail')}">账户明细</a>
				<a href="{:U('Account/fanshui')}">反水领取</a>
        </div>
        <div class="content bg_wite">
            <div class="datetady">
                <ul>
                    <li class="curr">账户取款</li>
                </ul>
            </div>
            <div class="h30"></div>
            <div class="u_q_cont">

				<form class="am-form register_form" method="post" url="" checkby_ruivalidate id="register_form" onsubmit="return checkform(this)">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_code">
                            <tbody>
                                <tr>
                                    <th scope="row">开户银行：</th>
                                    <td>
                                    <if condition="is_array($banklist)">
									<select class="ty_select yz_empty" name="bid" style="width:210px;">
                                        <option value="0">请选择银行</option>

                                        <volist name="banklist" id="vo"><option value="{$vo.bid}">{$vo.bankname}({$vo.banknumber})</option></volist>


                                    </select>
									<else />
									<span><p style="color: black;">请先<a style="padding: 5px 5px; color: red;" href="{:U('User/bindcard')}">绑定银行账户</a></p></span>
									</if>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">提款金额：</th>
                                    <td>
                                        <input type="text" class="ty_text " name="amount" value="100"  onafterpaste="formatIntVal(this)" onkeyup="formatIntVal(this)" placeholder="提款金额"><span style="color:grey">可用金额：{$userinfo.money}元</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">资金密码：</th>
                                    <td>
                                    <if condition="$rpassword eq ''">
                                        <span><p style="color: black;">请先设置<a style="padding: 5px 5px; color: red;" href="{:U('User/safepass')}">资金密码</a></p></span>
									<else />
										<input type="password" class="ty_text fl" name="pass" isnot="true" msg="请填写资金密码">
									</if>


                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;</th>
                                    <td>
                                        <if condition="(is_array($banklist)) and ($rpassword neq '')">
										<input class="ty_btn sub_btn ty_submit" type="submit" value="确认提款">
										</if>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </form>

            </div>
            <div class="h20"></div>
        </div>
    </div>
</div>
<!--wapper-->
<div class="h35"></div>

<include file="Public/footer" />

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
