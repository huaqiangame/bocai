<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<style>
	body{
		background-color: #fff;
	}
</style>
<body>
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>

		<h1 class="am-header-title activity_h1">
			银行卡管理
		</h1>

	</header>
	
	<div class="bank_recharge tankMoney_main security6_main">
		<form action="" class="am-form">
			<ul class="bank_form_list">
				<volist name="banklist" id="vo">
				<li class="am-cf">
					<div class="am-fl bank_right_input">
						<svg class="icon" aria-hidden="true">
							<img src="__ROOT__/resources/images/bank/{$vo.banklogo}" style="margin-bottom: 30px;" />
						</svg>
						<div class="bank_info">
							<em class="bank-name">{$vo.bankname}</em>
							<em>**********<span class="bank-sum">{$vo.banknumber|substr=-4}</span></em>
						</div>
					</div>
					<eq name="vo.isdefault" value="1">
						<a href="javascript:void(0);" class="am-fr security6_edit">默认</a>
					 <else />
					<a href="javascript:void(0);" class="am-fr security6_edit "  onclick="setdefault({$vo.id})">设为默认</a>
					</eq>
				</li>
				</volist>
			</ul>
             <lt name="count" value="3">
			 <a href="{:U('Member/addBank')}" class="am-btn am-btn-danger am-radius am-btn-block">添加银行卡</a>
			 </lt>
		</form>	
		<div class="bottom_explain">
			<p>您已绑定{$banklist|count}张银行卡，你还可以可以绑定<?php echo 3-count($banklist)?>张银行卡。为了您的资金安全，成功提现的银行卡会自动锁定，无法删除和修改。</p>
		</div>
	</div>
	<include file="Public/footer" />
	<script>
		//设置默认
		function setdefault(id) {
			$.ajax({
				url : "{:U('Apijiekou/defaultuserbankcard')}",
				type : "POST",
				data : {
					id : id
				},
				success : function (data) {
					if(data.sign==1)
					{
						alert(data.message);
						window.location.reload();

					}else{
						alert(data.message);
					}
				}
			})
		}
	</script>
</body>
</html>