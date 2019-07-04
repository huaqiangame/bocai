<include file="Public/headermember" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/withdrawals.css">
	<link rel="stylesheet" href="__CSS2__/userInfo.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" href="http://at.alicdn.com/t/font_i3jm0mkwlui8uxr.css">
	<script>
		var ISLOGIN = "{$userinfo.id}";
	</script>
	<script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="__JS__/artDialog.js"></script>
	<script type="text/javascript" src="__JS__/index.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
	<div class="vip_info clearfix container">
		<include file="Member/side" />
		<div class="pull-right vip_info_pan">
			<div class="vip_info_title">
				我要提现
			</div>
			<div class="vip_info_content withdrawals_main">
				<div class="tab_content_right">
					<form class="am-form register_form" method="post" action="{:U('Apijiekou/savetikuanorder')}" checkby_ruivalidate id="register_form" onsubmit="return checkform(this)">
						<div class="withdrawals_list">
							<span>账户金额：</span>
							<em><strong data-balance>{$userinfo.balance}</strong> 元</em>
						</div>
						<div class="withdrawals_list">
							<span>可提现金额：</span>
							<em><strong data-balance>{$userinfo.balance}</strong> 元</em>
						</div>
						<div class="withdrawals_list">
							<span>今天剩余提现次数：</span>
							<em><strong class="count" data-tkcount="{$count}">{$count}</strong> 次</em>
						</div>
						<div class="withdrawals_list">
							<span>选择银行：</span>
							<volist name="banklist" id="vo" key="v">
								<eq name="v" value="1">
								<div class="select_bank {$vo.imgbg} bank_bg">
									<em>尾号：<span class="last_sum">{$vo._banknumber|substr=-5}</span></em>
									<i class="iconfont">&#xe6a1;</i>
								</div>
								</eq>
							</volist>
							<ul class="choice_bank">
								<volist name="banklist" id="vo" key="v">
								<li data-bank="{$vo.imgbg}" data-num="{$vo._banknumber|substr=-5}">
									<eq name="v" value="1">
									<input type="radio" name="bankid" checked="checked" value="{$vo.id}">
										<else />
										<input type="radio" name="bankid"  value="{$vo.id}">
									</eq>
									<span class="{$vo.imgbg} bank_bg"></span>
									<div class="choice_bank_info">
										<em>开户人姓名：{$vo.accountname}</em>
										<em>银行卡号：{$vo.banknumber}</em>
									</div>
								</li>
								</volist>
							</ul>
						</div>
						<div class="withdrawals_list">
							<span>提现金额：</span>
							<input class="input_text"  onafterpaste="formatIntVal(this)" onkeyup="formatIntVal(this)" type="text" name="amount" value="100"placeholder="提款金额至少100元" />
						</div>
						<div class="withdrawals_list">
							<if condition="$rpassword eq ''">
								<span><p style="color: black;">请先设置<a style="padding: 5px 5px; color: red;" href="{:U('Member/safepass')}">资金密码</a></p></span>
								<else />
							    <span>资金密码：</span>
							    <input class="input_text" type="password" isnot="true" name="withdraw_pwd">
							</if>
						</div>

						<if condition="(is_array($banklist)) and ($rpassword neq '')">
						<button class="btn common_btn ty_btn sub_btn ty_submit" type="submit">提现</button>
						</if>
					</form>
				</div>
				<div class="prompt">
					<p>※ 温馨提示：</p>
					<p>提款将会减少去相应的积分和降低相应的会员等级</p>
					<p>可提现金额=有效投注×3(此项需达到充值金额的30%才计入)+奖金+活动礼金</p>
					<p>单笔提现：最低100元，最高2000000元</p>
				</div>
			</div>
		</div>
	</div>
<include file="Public/footer" />

<!--	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
	</div>-->
<script>
	function checkform(obj){
		$.post($(obj).attr('action'),$(obj).serialize(), function(json){
			if(json.sign){
				var tkcount = $("[data-tkcount]").text()/1;
				tkcount = tkcount-1;
				if(tkcount<=0){
					tkcount = 0;
				}
				$("[data-tkcount]").text(tkcount);
				
				alert(json.message,'success');
				window.location.reload();
			}else{
                alert(json.message);
			};
		},'json');
		return false;
	};
</script>
</body>
</html>