<include file="Public/header" />

<!--wapper-->

<div class="wapper ">
	<div class="w1000">
    	<include file="Public/ubanner" />
        <div class="u_two_bann">
                <a href="{:U('Account/recharge')}">我要充值</a>
                <a href="{:U('Account/withdraw')}">我要取款</a>
				<a href="{:U('Account/fuddetail')}">账户明细</a>
				<a href="{:U('Account/fanshui')}" class="curr">反水领取</a>
        </div>
        
        <div class="content bg_wite">
            <!--代理中心内容-->
            
            <!--<div style="font-size:18px;"><span>交易情况 <span style="color:red;">有效投注：0元  奖金收入：0元 
                
                <em style="color:red;"> 赚：0元</em>
                
            </span></span></div>-->
            <div class="helper_cont money_cont agent_cont">
                <div class="w_930" id="invest_fuddetail_cont">
                    <div class="user_search">
						
                        
                        <span>
							<input type="button" class="ty_btn sub_btn" value="点击领取反水"  onclick="qingquyongqu();">
                        </span>
                        <span>
		<if condition="($lqcount elt 0) and ($jljine gt 0)">每天限领取一次,当前可领取佣金为：<b>{$jljine}</b> 元
		<elseif  condition="($lqcount gt 0)"/>
		可领取反水金额：<b>{$jljine}</b> 元
		<else />
		暂无佣金可领取
		</if>
                        </span>
						
                    </div>
                    <div class="agent_table">
                       <table cellpadding="0" cellspacing="0">
                          <tr>
                          
                            <th>领取时间</th>
                            <th>流水金额</th>
                            <th>反水比例</th>
                            <th>领取金额</th>
                            <th>状态</th> 
                           
                          </tr>
                          <tbody  id="fudetail_list">
                          <volist name="lqlist" id="vo">
						  <tr>
						  <td>{$vo.oddtime|date="m-d H:i",###}</td>
						  <td>{$vo.touzhuedu}</td>
						  <td>{$vo.bili}</td>
						  <td>{$vo.amount}</td>
						  <td><if condition="$vo['shenhe'] eq 0"><span style="color:grey">审核中</span><elseif condition="$vo['shenhe'] eq 1"/><span style="color:green">通过</span></if></td>
						  </tr>
						  </volist>    
                          </tbody> 
                            </table>
                            <!--通用翻页-->
                            <div class="ty_page pages" id="lrx_ty_page">{$pageshow}</div>
                            <!--通用翻页-->
                    </div>
                </div>
            </div>
            <!--代理中心内容-->
            <div class="h20"></div>
        </div>
    </div>
</div>
<!--wapper-->
<div class="h35"></div>
<include file="Public/footer" />
<script language="javascript" type="text/javascript" src="/Public/dist/lib/My97DatePicker/WdatePicker.js"></script>
<script>
function qingquyongqu(){
	$.post("{:U('Home/Account/fanshui')}",'', function(json){
		if(json.status==1){
			alt(json.info);
			window.location.reload();
		}else{
			alt(json.info);
		}
	},'json'); 
	return false;
}
</script>

</body>

</html>
