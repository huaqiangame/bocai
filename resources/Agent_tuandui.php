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
		<a class="curr" href="{:U('Agent/tuandui')}">团队概览</a>
		<a href="{:U('Agent/online')}">在线会员</a>
		<a href="{:U('Agent/chongzhi')}">团队充值</a>
		<a href="{:U('Agent/xiazhu')}">团队下注</a>
		</div>
		<div class="content bg_wite">
			<div class="cont_box">
			<table width="100%" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#CCCCCC">
				<tr>
				<th height="30" bgcolor="#FFFFFF"><span class="STYLE1">会员昵称</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">账户金额</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">本月流水</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">上月流水</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">总投注</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">总盈利</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">注册时间</span></th>
				</tr>
				<volist name="xusers" id="u"><tr>
				<td height="30" align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.username}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.balance}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.m0touzhu}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.m1touzhu}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.totaltouzhu}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u[totalyili]-$u[totaltouzhu]}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.regtime|date='Y-m-d',###}</span></td>				</tr></volist>
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

