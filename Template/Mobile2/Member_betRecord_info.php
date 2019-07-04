<include file="Public/header" />
<style>
	body{
		background-color: #fff;}
</style>
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>
		<div class=" am-header-title">
			注单详情
		</div>
	</header>
	<div class="personalInfo1 personalInfo">
		<form class="am-form register_form" method="post" url="" checkby_ruivalidate id="register_form" onsubmit="return checkform(this)">
			<!-- remilia.cc -->
			<style>
			.remilia_moe_2 .am-cf span{
				float: left;
				padding-right:20px
			}
			.remilia_moe_2 .am-cf em{
				float: left;
			}
.section-detail {
    margin-top: 1em;
}
.section-detail header {
    height: 30px;
    line-height: 30px;
    padding: 0 1em;
    padding-left: 28px;
    font-size: 0.18rem;
}
.section-detail li:first-of-type {
    background-position: 0 0;
    height: 2em;
    background-size: 100% auto;
}
.section-detail li {
    padding: 0 1.5em;
    color: #bbb;
    background-image: url(//images.app2jsknas.com/system/mobile/lottery/paper.png);
    background-repeat: no-repeat;
    background-size: 100% 300%;
    background-position: 0 80%;
    height: auto;
    font-size: .8em;
}
.section-detail li:last-of-type {
    background-position: 0 130%;
    height: 2.5em;
    background-size: 100% 150%;
}
.remilia_moe .left {
    width: auto;
}
			</style>
			<ul class="my_set_list personalInfo_top margin_0 remilia_moe_2">
				<li class="am-g am-list-item-dated remilia_moe">
					<span class="left" style="height: 10px;position: relative;top: -10px;">
						<if condition="$tz.typeid eq 'k3'">
							<i class="iconfont icon-fucaikuai3" style="color: #e01506;font-size: 2.8em;"></i>
						</if>
						<if condition="$tz.typeid eq 'ssc'">
							<i class="iconfont" style="color:#07b39e" style="color:#07b39e"><img src="/app/ssc.png" style="padding-top: 10px;width:50px"></i>
						</if>
						<if condition="$tz.typeid eq 'pk10'">
							<i class="iconfont" style="color:#07b39e"><img src="/app/pk10.png" style="padding-top: 10px;width:50px"></i>
						</if>
						<if condition="$tz.typeid eq 'keno'">
							<i class="iconfont" style="color:#07b39e"><img src="/app/kl8.png" style="padding-top: 10px;width:50px"></i>
						</if>
						<if condition="$tz.typeid eq 'x5'">
							<i class="iconfont" style="color:#07b39e"><img src="/app/115.png" style="padding-top: 10px;width:50px"></i>
						</if>
						<if condition="$tz.typeid eq 'dpc'">
							<i class="iconfont "><img src="/app/3d.png" style="padding-top: 10px;width:50px"></i>
						</if>
						<if condition="$tz.typeid eq 'lhc'">
							<i class="iconfont" style="color:#07b39e"><img src="/app/lhc.png" style="padding-top: 10px;width:50px"></i>
						</if>
					</span>
					<span class="left">
						<p>{$tz['cptitle']} </p>
						<p class="time">{$tz['expect']}期</p>
					</span>
					<span class="right">
						<if condition="$tz.isdraw eq '0'">
							<p style="color:#666;margin-top: 13px;" >未开奖</p>
						</if>
						<if condition="$tz.isdraw eq '1'">
							<p style="color:red;margin-top: 13px;" >已中奖</p>
						</if>
						<if condition="$tz.isdraw eq '-1'">
							<p style="color:green;margin-top: 13px;" >未中奖</p>
						</if>
						<if condition="$tz.isdraw eq '-2'">
							<p style="color:#666;margin-top: 13px;" >已撤单</p>
						</if>
					</span>
				</li>
				<li class="am-cf" style="border-bottom:1px solid #ccc">
					<span>投注时间</span>
					<em class="personalInfo_text am-fr padding_lr_10">{$tz['oddtime']}</em>
				</li>
				<li class="am-cf" style="border-bottom:1px solid #ccc">
					<span>投注单号</span>
					<em class="personalInfo_text am-fr padding_lr_10">{$tz['trano']}</em>
				</li>
				<li class="am-cf" style="border-bottom:1px solid #ccc">
					<span>投注金额</span>
					<em class="personalInfo_text am-fr padding_lr_10">￥{$tz['amount']}元</em>
				</li>
				<li class="am-cf" style="border-bottom:1px solid #ccc">
					<span>派送奖金</span>
					<em class="personalInfo_text am-fr padding_lr_10">￥{$tz['okamount']}元</em>
				</li>
				<li class="am-cf" style="border-bottom:1px solid #ccc">
					<span>开奖号码</span>
					<em class="personalInfo_text am-fr padding_lr_10" style="padding-right: 10px;">{$tz['opencode'] ?: '未开奖'}</em>
					<if condition="$tz.isdraw eq 0"> <a href="javascript:void" class="chedan_btn" style="color:red" onClick="Order_chedan('{$tz.trano}',this)">撤单</a></if>
				</li>
				
				<script>
				function Order_chedan(trano){
					$.ajax('/Apijiekou.chedan',{
						data:{
							trano:trano
						},
						method:'post',
						dataType:'json',
						success:function(data){
							alert(data.message);
							location.href=location.href;
						}
					});
				}
				</script>
				
			</ul>
			
			<section class="section-detail">
				<header>我的投注</header>
					<ul>
					<li></li>
					<li>
						<div style="padding: 10px;">{$tz['tzcode']}</div>
						<span style="padding: 10px;">{$tz['playtitle']}</span>
					</li>
					<li></li>
				</ul>
			</section>
			

		</form>
	</div>
	
	<include file="User/face" />
	<include file="Public/footer" />
</body>
</html>