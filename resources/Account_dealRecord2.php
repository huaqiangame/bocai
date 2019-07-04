<include file="Public/headermember" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/record.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
	<link rel="stylesheet" type="text/css" href="__CSS2__/reset.css">
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
	<div class="vip_info clearfix container">
		<include file="Member/side" />
		<div class="pull-right vip_info_pan">
			<div class="vip_info_title">
				交易记录
			</div>
			<?php $typearray = AbstractType();?>
			<div class="vip_info_content betRecord_main">	
				<div class="betRecord_tab clearfix">
					<div class="category pull-left">
						<em class="tle">支付状态：</em>
						<div class="form-group" >
							<select name="state" class="form-control" id="state">
								<option value="undefined" <eq name="Think.get.state" value="undefined">selected='selected'</eq> >所有状态</option>
								<option value="1" <eq name="Think.get.state" value="1">selected='selected'</eq>>支付成功</option>
								<option value="0" <eq name="Think.get.state" value="0">selected='selected'</eq>>支付中</option>
								<option value="-1" <eq name="Think.get.state" value="-1">selected='selected'</eq>>订单关闭</option>
							</select>
						</div>
					</div>
					<div class="bet_time pull-left" id="atime">
						<em class="tle">时间：</em>
						<span class="bet_common_bor <if condition='$Think.get.atime eq "1" or $Think.get.atime eq ""'>active</if>" value="1" onclick="chaxun(1)">今天</span>
						<span class="bet_common_bor <eq name='Think.get.atime' value='2'>active</eq>" value="2" onclick="chaxun(2)">昨天</span>
						<span class="bet_common_bor <eq name='Think.get.atime' value='3'>active</eq>" value="3" onclick="chaxun(3)">七天</span>
					</div>
					<div class="bet_status pull-left">
						<em class="tle">类型：</em>
						<span class="bet_common_bor "> <a href="{:U('Account/dealRecord')}">账户明细</a></span>
						<span class="bet_common_bor active"><a href="{:U('Account/dealRecord2')}">充值记录</a></span>
						<span class="bet_common_bor"><a href="{:U('Account/dealRecord3')}">提现记录</a></span>
					</div>
				</div>
				<div class="bet_info col-sm-12">
					<table class="table">
						<thead>
							<tr>
								<th>流水号</th>
								<th>发起时间</th>
								<th>充值金额</th>
								<th>充值方式</th>
								<th>状态</th>
							</tr>
						</thead>
						<tbody>
						<volist name="mxlist" id="vo">
							<tr>
								<td>{$vo.trano}</td>
								<td>{$vo.oddtime|date="m-d H:i:s",###}</td>
								<td>{$vo.amount}</td>
								<td>{$vo['paytypetitle']}</td>
								<td>
									<if condition="$vo['state'] eq 1"><span style="color:green">成功</span><elseif condition="$vo['state'] eq 0" /><span style="color:grey">支付中</span><elseif condition="$vo['state'] eq -1" /><del style="color:grey">订单关闭</del></if>
                               </td>
							</tr>
						</volist>
						</tbody>
					</table>
						<div class="page">{$pageshow}</div>
				<div class="prompt">
					<i class="iconfont">&#xe659;</i>
					温馨提示：交易记录最多只保留7天。
				</div>
				</div>
				<!-- 如果没有查到就显示这个 -->
				<div class="no_result" style="display:none;">
					暂无记录
				</div>
<!--				<ul class="pagination bet_paging">
					<li><a href="">上一页</a></li>
					<li class="active"><a href="">1</a></li>
					<li><a href="">2</a></li>
					<li><a href="">3</a></li>
					<li><a href="">4</a></li>
					<li><a href="">下一页</a></li>
					<li><a href="">共 <em class="color_res">0</em> 页</a></li>
				</ul>-->
			
			</div>
		</div>
	</div>

<include file="Public/footer" />
<script>
	$('select[name=state]').change(function () {
		var atime = $('#atime span.active').attr('value');
		var state =  $('#state').val();
		var url = "Account.dealRecord2.atime."+atime+".state."+state;
		window.location.href= url;
	})
	function chaxun(t){
		var type = $('#type').val();
		var state =  $('#state').val();
		var url = "Account.dealRecord2.atime."+t+".state."+state;
		window.location.href = url;
	}
</script>
	<div class="modal fade is_set_security" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
	      </div>
	      <div class="modal-body">
	        您还未设置资金密码，请先设置资金密码?
			<div>（资金密码用于提现等操作，可保障资金安全）</div>
	      </div>
	      <div class="modal-footer">
	        <a href="setSecurity.html" class="btn btn-default login_btn">确认</a>
	        <a href="" class="btn btn-default register_btn">取消</a>
	      </div>
	    </div>
	  </div>
	</div>
</body>
</html>