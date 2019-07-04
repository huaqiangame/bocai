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
		<a class="curr" href="javascript:void(0)" onclick="qingquyongqu();">点击领取日反利</a>
		
		<if condition="($lqcount elt 0) and ($jljine gt 0)">每天限领取一次,当前可领取反利为：<b>{$jljine}</b> 元
		<elseif  condition="($lqcount gt 0)"/>
		今日已领取，金额：<b>{$jljine}</b> 元
		<else />
		暂无佣金可领取 
		</if>
		</div>
		<div class="content bg_wite">
			<div class="cont_box">
			<table width="100%" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#CCCCCC">
				<tr>
				<th height="30" bgcolor="#FFFFFF"><span class="STYLE1">领取会员</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">下线投注额度</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">领取金额</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">领取时间</span></th>
				<th bgcolor="#FFFFFF"><span class="STYLE1">状态</span></th>
				</tr>
				<volist name="lqlist" id="u"><tr>
				<td height="30" align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.username}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.touzhuedu}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.amount}</span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">{$u.oddtime|date='Y-m-d H:i',###}</span></td>
				<td align="center" bgcolor="#FFFFFF">
				<if condition="$u['shenhe'] eq 0">
				<span style="color:grey">审核中</span>
				<elseif condition="$u['shenhe'] eq 1" />
				<span style="color:green">成功</span>
				</if>
				</td>
				</tr></volist>
			</table>
			<div class="ty_page pages" id="lrx_ty_page">{$page}</div>
			</div>
		</div>
		<div class="wapper_bottom b1 mgt15" style="padding-left: 10px;">
			<h3 class="activity_common_h3">
				佣金比例
			</h3>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th class="ths">
						<i>等级</i>
						<ins></ins>
						<em>昨日投注</em>
					</th>
					<volist name="mintozhu" id="value">
						<th>{$value[0]}+</th>
					</volist>
				</tr>
				</thead>
				<tbody>
				<volist name="bilisss"  id="value">
					<tr>
						<td>{$value[0]}</td>
						<td>{$value[1]}%</td>
						<td>{$value[2]}%</td>
						<td>{$value[3]}%</td>
					</tr>
				</volist>
				</tbody>
			</table>
		</div>
		<div class="wapper_bottom b1 mgt15" style="padding-left: 10px;">
			<h3 class="h3">日佣金说明</h3>
			<p style="padding-left: 10px;">1、代理领取佣金在当日凌晨23:59:00之前领取；逾期未领取则视为放弃领取</p>
			<p style="padding-left: 10px;">2、每日佣金只能领取一次</p>
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
<script>
function qingquyongqu(){
	$.post("{:U('Agent/rifanyong')}",'', function(json){
		if(json.status==1){
//			alt(json.info);
			alert(json.info);
			window.location.reload();
		}else{
			alert(json.info);
//			alt(json.info);
		}
	},'json'); 
	return false;
}
</script>
</body>

</html>

