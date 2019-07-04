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
			每日加奖
		</h1>
	</header>
	
	<div class="promotion_img">
		<img src="__IMG__/banner2.png" alt="">
	</div>
	
	<div class="promotion_grade">
		<p>
			<span>当前等级：</span>
			<em>{$userinfo.groupname}</em>
		</p>

		<if condition="$userinfo.groupid neq '10'">
		<p>
			<span>昨日投注：</span>	
			<em><eq name="countamount" value="">0<else />{$countamount}</eq></em>
		</p>
		<p>
			<span>加奖比例：</span>	
			<em>{$fanshuibili}%</em>
		</p>
		<p>
			<span>可得加奖：</span>	
			<em><eq name="jiajiang" value="">0<else />{$jiajiang}</eq></em></em>
		</p>
	</div>
	</if>
	<div class="promotion_btn">
	<notempty name="Think.session.userinfo">

		<if condition="$userinfo.groupid neq '10'">
		<eq name="jiajiang" value="">
			<strong><a href="javascript:void(0);" class="btn no_login_btn">无加奖</a></strong>
			<else />
			<strong><a href="javascript:void(0);" class="btn btn-danger" onclick="qingquyongqu();" >点击领取加奖</a></strong>
		</eq>
			<else />
			<strong><a href="javascript:void(0);" class="btn no_login_btn">无加奖</a></strong>
			</if>
		<else />
		<strong><a href="{:U('Public/login')}" class="btn no_login_btn">未登录</a></strong>
	</notempty>
	</div>
	<notempty name="Think.session.userinfo">
		<table class="am-table am-table-bordered am-table-sss">
			<tbody>
			<tr><th>领取时等级</th><th>流水金额</th><th>比例</th><th>金额</th><th>时间</th><th>状态</th></tr>
			<volist name="lqlist" id="vo">
				<tr>
					<td>{$vo.groupname}</td>
					<td>{$vo.touzhuedu}</td>
					<td>{$vo.bili}</td>
					<td>{$vo.amount}</td>
					<td>{$vo.oddtime|date="m-d H:i",###}</td>
					<td><if condition="$vo['shenhe'] eq 0"><span style="color:grey">审核中</span><elseif condition="$vo['shenhe'] eq 1"/><span style="color:green">通过</span></if></td></tr>
			</volist>
			</tbody>
		</table>
	</notempty>
	<div class="ty_page pages" id="lrx_ty_page">{$pageshow}</div>
	<div class="promotion_main">
		<div class="promotion_rule">
			<h2 class="promotion_h2">
				加奖比例
			</h2>
			<table class="am-table am-table-bordered">
				<thead>
					<tr>
						<th>等级/投注额</th>
						<volist name="mintozhu" id="value">
							<th>{$value[0]}+</th>
						</volist>
					</tr>
				</thead>
				<tbody>
				<volist name="bilisss"  id="value">
					<tr>
						<td>{$value[0]}</td>
						<td>{$value[1]}%</td>
						<td>{$value[2]}%</td>
						<td>{$value[3]}%</td>
					</tr>
				</volist>
				</tbody>
			</table>
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				活动说明
			</h2>
			<p>1、每日加奖在每日凌晨00:20后开放领取；</p>
			<p>2、加奖比例是根据会员等级以及昨日累计投注金额进行一定比例的加奖；</p>
			<!--<p>3、需Vip3以上且昨日投注额大于或等于100才能获得加奖；</p>-->
			<p>3、撤单和其他无效投注将不计算在内；</p>
			<p>4、提款后相应的降级将会影响加奖的比例。</p>
			<p>5、活动奖金逾期未领取，视为自动放弃活动资格。</p>
			<br />
		</div>
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