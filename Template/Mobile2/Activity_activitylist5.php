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
			幸运额度
		</h1>
	</header>
	
	<div class="promotion_img">
		<img src="__IMG__/activity_bg6.jpg" alt="">
	</div>

	<div class="promotion_main">
		{$houdong}
	<!--	<div class="promotion_explain">
			<h2 class="promotion_h2">
				活动详情
			</h2>
			活动规则：2017年06月09日-长期有效 
			<br />活动详情：幸运彩全体会员
			<br />
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				活动赠送说明
			</h2>
			凡在幸运彩投注平台娱乐，按照北京时间计算当日亏损达到10000元或以上，次日即可申请借信用额度，最高可达88888元，助你翻本。 
			<br />当日亏损金额达：10000元 次日可申请信用额度：289元 
			<br />当日亏损金额达：30000元 次日可申请信用额度：389元 
			<br />当日亏损金额达：50000元 次日可申请信用额度：589元 
			<br />当日亏损金额达：100000元 次日可申请信用额度：1888元 
			<br />当日亏损金额达：300000元 次日可申请信用额度：3888元 
			<br />当日亏损金额达：1000000元 次日可申请信用额度：88888元
			<br />
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				范例
			</h2>
			1.当日在幸运彩投注娱乐亏损达10000元，次日即可申请289元信用额度彩金，完成一倍流水提款，翻本成功。 
			<br />2.当日在幸运彩投注娱乐亏损达50000元，次日即可申请589元信用额度彩金，信用额度也输完了。（不用还了，这都是命，相信明天会更好！）
			<br />
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				申请方式
			</h2>
			请添加幸运彩客服中心-QQ：69236869进行申请，格式如下 
			<br />主题：【信用额度】 
			<br />内容：【会员账号】【真实姓名】【昨日亏损金额】
			<br />
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				活动细则
			</h2>
			1.会员必须先绑定银行账号否则系统将判断不符合申请条件拒绝赠予彩金。 
			2.每位玩家当日负盈利累计达到，需在次日领取彩金；请在次日24点前来申请，逾期视为放弃活动。 
			<br />3.每位玩家每天仅限申请一次，天数按照北京时间计算。 
			<br />4.所获得彩金只需一倍流水即可申请提款。 
			<br />5.参与该优惠，即表示您同意【幸运彩优惠规则于条例】
			<br />
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				优惠条款
			</h2>
			1：幸运彩平台所有彩金均以人民币（CNY）为结算金额； 
			<br />2：幸运彩平台所有优惠为玩家而设，如果发现任何会员，以不诚实的方式套取红利，我平台有权取消会员账户结余的权利； 
			<br />3：幸运彩平台保留活动最终解释权，以及在无通知的情况下修改，终止活动的权利，适用于所有优惠。
			<br />
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				注意事项
			</h2>
			每个银行卡户名，每位会员，每一相同IP，每一电子邮箱，每一电话号码，相同支付方式（借记卡/信用卡/银行账户）及共享计算机环境（例如网吧，其他公用计算机等）只能享受一次优惠；若会员有重复申请账号行为，公司保留取消或收回会员优惠彩金的权利。 幸运彩平台的所有优惠为玩家而设，如发现任何团体或个人，以不诚实方式套取红利或任何威胁，滥用公司优惠等行为。公司保留冻结，取消该团体或个人账户结余的权利。 
			<br />若会员对活动有争议时，为确保双方利益，杜绝身份盗用行为，幸运彩平台有权要求会员向我们提供充足有效文件，用以确认是否享有该优惠的资质。 此活动可与其他优惠同时进行享用。
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