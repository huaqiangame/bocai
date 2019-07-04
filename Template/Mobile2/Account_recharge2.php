<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<style>
	body{
		background-color: #fff;
	}
	.recharege_name{
		display:inline-block;
		width:1.2rem;
		text-align:right;
		padding-left:0.2rem;
	}
	.am-text-center span{
		text-align:left;
		padding-right:0.2rem;
	}
	.recharege_name_box{
		width:3.2rem;
		margin:0 auto;
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
		工行转账
	</h1>
</header>
<div class="bank_recharge">
	<br>
	<br>
	<div class="recharege_name_box">
		<p class="am-text-center h4 am-cf">
			<em class="recharege_name am-fl">充值方式：</em><span class="am-fl" style='color:red;font-weight: bold;'>{$payinfo.title}</span>
		</p>
		<p class="am-text-center h4 am-cf">
			<em class="recharege_name am-fl">充值金额：</em><span class="am-fl" style='color:red;font-weight: bold;'>{$payorder.amount}</span>
		</p>
		<p class="am-text-center h4 am-cf">
			<em class="recharege_name am-fl">收 款 人：</em><span class="am-fl" style='color:red;font-weight: bold;'>{$payinfo.xingming}</span>
		</p>
		<p class="am-text-center h4 am-cf">
			<em class="recharege_name am-fl">付 款 人：</em><span class="am-fl" style='color:red;font-weight: bold;'>{$payorder.bankusername}</span>
		</p>
		<p class="am-text-center h4 am-cf">
			<em class="recharege_name am-fl">收款账号：</em><span class="am-fl" style='color:red;font-weight: bold;'>{$payinfo.zhanghao}</span>
		</p>
		<p class="am-text-center h4 am-cf">
			<em class="recharege_name am-fl">附 言 码：</em><span class="am-fl" style='color:red;font-weight: bold;'>{$payorder.fuyanma}</span>
		</p>
	</div>
	<p class="am-text-center" style="color:red;font-size: 20px;margin-top: 40px;font-weight: bold;">温馨提示:<div class="content container" style="padding:1em;">{$payinfo.content}</div></p>
	<p class="am-text-center"> <input type="button" value="完 成"  class="am-center-block am-btn am-btn-danger am-btn-lg am-active" style="width: 10em;margin:65px auto; margin-bottom: 65px;" onclick="window.location.href= '{:U(\"Account\/dealRecord2\")}'" ></p>


</div>

<include file="Public/footer" />
</body>
</html>