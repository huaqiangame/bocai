<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/activity.css">
<body class="bg_fff">
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>

		<h1 class="am-header-title activity_h1">
			代理加盟
		</h1>
	</header>
	
	<div class="promotion_img">
		<img src="__IMG__/activity_bg7.jpg" alt="">
	</div>

	<div class="promotion_main">
		{$houdong}
<!--		<div class="promotion_explain">
			<h2 class="promotion_h2">
				代理简介
			</h2>
			幸运彩投注平台属于多元化的产品，沿用最公平、公正、公开的系统，配备全新最优代理合作模式，支持个人或者团队合作，零风险，零成本，高收益。以投注金额为基础方式计算，不必担心输赢，只要您的下级团队有投注额度，无论投注多少和输赢，您都可以实时获得返点赚取佣金，免流水，随时提现！
			<br />无论您拥有的是网路资源，或者是人脉资源，我们竭诚欢迎您加入幸运彩投注平台合作伙伴的行列，绝对是您最理智的选择！《言出必行，诚信天下》期待您的加入！
			<br />更多代理相关问题，请您登录后查看代理中心-代理说明！
			<br />
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				代理优势
			</h2>
			a.代理门槛低
			<br />b.实时获取返点佣金
			<br />c.零风险，零成本，高收益
			<br />d.不限制投注量和投注人数皆可获得高返点佣金
			<br />e.返点佣金，无须流水，无条件可随时提现

			<br />我们抛弃传统模式，只为合作伙伴创造最优势的盈利回报模式！足不出户，随时随地无条件提现佣金。
			<br />
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				代理申请
			</h2>
			注册申请：请联系在线客服提出申请，注册成功后如实填写您的联系方式，尤其是您的有效电子邮箱。幸运彩平台会评估审核并且为您建立代理档案。
			<br />咨询客服QQ：69236869

			<br />佣金获取与提现
			<br />1.根据团队有效投注量实时返点获取佣金
			<br />2无需流水，绑定银行卡后随时可申请提现

			<br />注：幸运彩保留上述条列之最终更改权
			<br />请谨记任何使用不诚实方法以骗取返点佣金将会永久冻结账户，返点一律不予发送
			<br />
		</div>-->
	</div>
	<include file="Public/footer" />	<script type="text/javascript">
		function qingquyongqu(){
			$.post("{:U('Activity/everydayPlus')}",'', function(json){
				if(json.status==1){
					alert(json.info);
					window.location.reload();
				}else{
					alert(json.info);
				}
			},'json');
			return false;
		}
	</script>
</body>
</html>