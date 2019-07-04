<include file="Public/header" />

<!--wapper-->

<div class="wapper ">
	<div class="w1000">
    	<include file="Public/ubanner" />
        <div class="u_two_bann">
                <a href="{:U('Account/recharge')}">我要充值</a>
                <a href="{:U('Account/withdraw')}">我要取款</a>
				<a href="{:U('Account/fuddetail')}" class="curr">账户明细</a>
				<a href="{:U('Account/fanshui')}">反水领取</a>
        </div>
        
        <div class="content bg_wite">
            <!--代理中心内容-->
            
            <!--<div style="font-size:18px;"><span>交易情况 <span style="color:red;">有效投注：0元  奖金收入：0元 
                
                <em style="color:red;"> 赚：0元</em>
                
            </span></span></div>-->
            <div class="helper_cont money_cont agent_cont">
                <div class="w_930" id="invest_fuddetail_cont">
                	<div class="datetady">
                        <ul>
                            <li class="curr"><a href="{:U('Account/fuddetail')}">账户明细</a></li>
                            <li><a href="{:U('Account/fuddetail2')}">充值记录</a></li>
                            <li><a href="{:U('Account/fuddetail3')}">提现记录</a></li>
                            <!--<li><a href="{:U('Account/fuddetail4')}">转账记录</a></li>-->
                            
                        </ul>
                    </div>
					<?php $typearray = AbstractType();?>
                    <div class="user_search">
						<form method="post">
                        <span>摘要：
                            <select class="ui-select ty_select" name="type" id="type">
                                
                                    <option value="0">全部摘要</option>
                                    
                                    <foreach name="typearray" item="t" key="k">
                                        <option value="{$k}" <if condition="$k eq $type">selected</if>>{$t}</option>
                                    </foreach>
                                     
							</select>
                        </span>
                        <span>
                            <i>起始时间：</i>
                            <input  type="text" class="quote_time ty_date" id="Start" name="StartTime" onClick="WdatePicker()" value="{$StartTime}"/>
                            <em>-</em>
                            <input  type="text"  class="quote_time1 ty_date" id="End"  name="EndTime" onClick="WdatePicker()" value="{$EndTime}"/>
                        </span>
                        <span>
							<input type="submit" class="ty_btn sub_btn" value="搜 索">
                        </span>
						</form>
                    </div>
                    <div class="agent_table">
                       <table cellpadding="0" cellspacing="0">
                          <tr>
                          
                            <th>时间</th>
                            <th>摘要</th>
                            <th>发生金额</th>
                            <th>可用余额</th>
                            <th>备注</th> 
                           
                          </tr>
                          <tbody  id="fudetail_list">
                          <volist name="mxlist" id="vo">
						  <tr>
						  <td>{$vo.oddtime|date="m-d H:i:s",###}</td>
						  <td>{$typearray[$vo['type']]}</td>
						  <td>{$vo.amount}</td>
						  <td>{$vo.totalamount}</td>
						  <td>{$vo.remark}</td>
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

</body>

</html>
