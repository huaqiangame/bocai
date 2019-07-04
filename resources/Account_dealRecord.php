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
						<em class="tle">摘要：</em>
						<div class="form-group">
							<select name="type" class="form-control ty_select" id="type">
								<option value="0">全部摘要</option>
								<foreach name="typearray" item="t" key="k">
									<option value="{$k}" <if condition="$k eq $type">selected</if>>{$t}</option>
								</foreach>
							</select>
						</div>
					</div>
					<div class="bet_time pull-left" id="atime">
						<em class="tle">时间：</em>
						<span class="bet_common_bor" value="1" onclick="chaxun(1)">今天</span>
						<span class="bet_common_bor" value="2" onclick="chaxun(2)">昨天</span>
						<span class="bet_common_bor active" value="3" onclick="chaxun(3)">七天</span>
					</div>
					<div class="bet_status pull-left" id="dealRecord">
						<em class="tle">类型：</em>
						<span class="bet_common_bor active"><a href="{:U('Account/dealRecord')}">账户明细</a></span>
						<span class="bet_common_bor"><a href="{:U('Account/dealRecord2')}">充值记录</a></span>
						<span class="bet_common_bor"><a href="{:U('Account/dealRecord3')}">提现记录</a></span>
					</div>
				</div>
				<div class="bet_info col-sm-12">
					<table class="table">
						<thead>
							<tr>
								<th>时间</th>
								<th>摘要</th>
								<th>收入/支出金额</th>
								<th>可用余额</th>
								<th>备注</th>
							</tr>
						</thead>
						<tbody>
						<volist name="mxlist" id="vo">
							<tr>
								<td>{$vo.oddtime|date="m-d H:i:s",###}</td>
								<td>{$vo.typename}</td>
								<td>{$vo.amount}</td>
								<td>{$vo.amountafter}</td>
								<td>{$vo.remark}</td>
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
	$('select[name=type]').change(function () {
		var atime = $('#atime span.active').attr('value');
		var type =  $('#type').val();
		var url = "__ROOT__/?m=Home&c=Account&a=dealRecord&atime="+atime+"&type="+type;
       window.location.href= url;
	})
	function chaxun(t){
		    var type = $('#type').val();
			var atime = t;
		var url = "__ROOT__/?m=Home&c=Account&a=dealRecord&atime="+atime+"&type="+type;
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