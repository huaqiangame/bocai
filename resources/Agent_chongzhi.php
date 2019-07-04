<style type="text/css">
<!--
.STYLE1 {color: #FFFFFF}
-->
</style>
<include file="Agent/header" />

<div class="h25"></div>
<div class="wapper">
	<div class="w1000 bg_wite">
    	<div class="u_two_bann" style="border-top:1px solid #ddd;">
		<a href="{:U('Agent/tuandui')}">团队概览</a>
		<a href="{:U('Agent/online')}">在线会员</a>
		<a class="curr" href="{:U('Agent/chongzhi')}">团队充值</a>
		<a href="{:U('Agent/xiazhu')}">团队下注</a>
		</div>
		<div class="content bg_wite">
			<div class="cont_box">
			<table width="100%" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#CCCCCC">
				<tr>
				<th width="160" bgcolor="#FFFFFF"><span class="STYLE1">会员昵称</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">充值金额</span></th>
				<th width="160" bgcolor="#FFFFFF"><span class="STYLE1">充值时间</span></th>
				</tr>
				<volist name="czlist" id="u"><tr>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.username}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.amount}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.oddtime|date='Y-m-d H:i:s',###}</span></td>				</tr></volist>
                
                <present name="czlist">
                <tr>
				<td colspan="3" align="center" bgcolor="#FFFFFF"><span class="STYLE1" style="color:#f60; font-weight:bold;">本页总计：{$yetotal}，旗下会员总充值：{$alltotal}</span></td>
				</tr>
                <else />
                <tr>
				<td colspan="3" align="center" bgcolor="#FFFFFF"><span class="STYLE1">团队无记录</span></td>
				</tr>
                </present>
			</table>
			<div class="ty_page pages" id="lrx_ty_page">{$pageshow}</div>
			</div>
		</div>
        <div class="wapper_bottom b1 mgt15">
        	<ul>
            	<li><i>1</i><span><h4>注册会员</h4><p>简单几步，轻松注册</p></span></li>
                <li><i>2</i><span><h4>账户充值</h4><p>支持多种便捷支付</p></span></li>
                <li><i>3</i><span><h4>投注购彩</h4><p>官方平台支持，正规安全</p></span></li>
                <li><i>4</i><span><h4>中奖派奖</h4><p>中奖第一时间派奖</p></span></li>
                <li><i>5</i><span><h4>奖金提现</h4><p>支持多种方式，快捷到账</p></span></li>
            </ul>
        </div>
        <div class="mgt10"></div>
    </div>
</div>
<!--wapper-->
<include file="Public/footer" />
</body>

</html>

