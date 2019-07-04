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
		<a href="{:U('Agent/chongzhi')}">团队充值</a>
		<a class="curr" href="{:U('Agent/xiazhu')}">团队下注</a>
		</div>
        <div class="search_condition" style="border-left:1px solid #ddd;border-right:1px solid #ddd;">
            <div class="take_show  mag_top">
            <form method="get" action="{:U('Agent/xiazhu')}">
                <span style="width:290px;" name="Time_zone" id="intTime">
                    <i>起始时间：</i>
                    <input class="quote_time ty_text time" id="StartTime" name="StartTime" onclick="WdatePicker()" style="width:90px;" value="{$StartTime}" type="text"><em> - </em><input class="time quote_time1 ty_text" id="EndTime" name="EndTime" style="width:90px;" onclick="WdatePicker()" value="{$EndTime}" type="text">
                </span>
                <span><input type="submit" value="查 询" class="sub_btn ty_btn" style="padding:0 10px !important" /></span>
            </form>
            </div>
        </div>
		<div class="content bg_wite">
			<div class="cont_box">
			<table width="100%" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#CCCCCC">
				<tr>
				<th width="80" bgcolor="#FFFFFF"><span class="STYLE1">会员昵称</span></th>
				<th width="100" bgcolor="#FFFFFF"><span class="STYLE1">单号</span></th>
				<th width="90" bgcolor="#FFFFFF"><span class="STYLE1">彩票类型</span></th>
				<th width="90" bgcolor="#FFFFFF"><span class="STYLE1">期号</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">玩法</span></th>
					<th bgcolor="#FFFFFF"><span class="STYLE1">开奖号码</span></th>
				<th width="90" bgcolor="#FFFFFF"><span class="STYLE1">投注金额</span></th>
				<th width="80" bgcolor="#FFFFFF"><span class="STYLE1">投注时间</span></th>
				<th width="60" bgcolor="#FFFFFF"><span class="STYLE1">状态</span></th>
				</tr>
				<volist name="czlist" id="u"><tr>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.username}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.trano}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.cptitle}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.expect}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.playtitle}</span></td>
						<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.opencode}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.amount}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.oddtime|date='m-d H:i:s',###}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">
	<if condition="$u[isdraw] eq 0">
		未开奖
	<elseif  condition="$u[isdraw] eq 1" />
		<span style="color:green">已中奖</span>
	<elseif  condition="$u[isdraw] eq -1" />
		<span style="color:red">未中奖</span>
	<elseif  condition="$u[isdraw] eq -2" />
		<span style="color:grey">已撤单</span>
	</if>
                </span></td>
                
                </tr></volist>
                
                <present name="czlist">
                <tr>
				<td colspan="8" align="center" bgcolor="#FFFFFF"><span class="STYLE1" style="color:#f60; font-weight:bold;">本页总计：{$yetotal}，旗下会员总投注：{$alltotal}，总盈亏：{$allyingkui}</span></td>
				</tr>
                <else />
                <tr>
				<td colspan="8" align="center" bgcolor="#FFFFFF"><span class="STYLE1">团队无记录</span></td>
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
<script language="javascript" type="text/javascript" src="__ROOT__/resources/js/My97DatePicker/WdatePicker.js"></script>

</body>

</html>

