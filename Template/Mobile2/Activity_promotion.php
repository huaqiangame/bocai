<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/activity.css">

</head>
<body class="bg_fff">
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>

		<h1 class="am-header-title activity_h1">
			晋级奖励
		</h1>
	</header>
	
	<div class="promotion_img">
		<img src="__IMG__/banner1.png" alt="">
	</div>
 	<div class="promotion_grade">
		<p>
			<span>当前等级：</span>	
			<em>{$userinfo.groupname}</em>
		</p>
		<p>
			<span>上次晋级等级：</span>
			<neq name="Think.session.userinfo" value="">
			<em><empty name="jjlist[0]['groupid']">VIP1<else/>VIP{$jjlist[0]['groupid']}</empty></em>
			</neq>
		</p>
		<p>
			<span>晋级奖励：</span>
			<neq name="Think.session.userinfo" value="">
			<em><empty name="jlje">0.00 <else />{$jlje}</empty>元</em>
			</neq>
		</p>
	</div>
	
	<div class="promotion_btn">
		<notempty name="Think.session.userinfo">
			<eq name="jlje" value="0">
				<strong><a href="javascript:void(0);" class="btn no_login_btn">无奖励</a></strong>
				<else />
				<strong><a href="javascript:void(0);" class="btn btn-danger" onclick="jiangli();" >点击领取奖励</a></strong>
			</eq>
			<else />
			<strong><a href="{:U('Public/login')}" class="btn no_login_btn">未登录</a></strong>
		</notempty>
	</div>
	<notempty name="Think.session.userinfo">
		<table class="am-table am-table-bordered am-table-sss">
			<tbody>
			<tr><th>领取时间</th><th>晋级名称</th><th>晋级积分</th><th>领取奖励</th><th>状态</th></tr>
			<volist name="jjlist" id="vo">
				<if condition="$vo.groupname neq '' ">
				<tr><td>{$vo.oddtime|date="m-d H:i",###}</td>
					<td>{$vo.groupname}</td>
					<td>{$vo.point}</td>
					<td>{$vo.jlje}</td>
					<td><if condition="$vo['shenhe'] eq 0"><span style="color:grey">审核中</span><elseif condition="$vo['shenhe'] eq -1"/><span style="color:red">未通过</span><elseif condition="$vo['shenhe'] eq 1"/><span style="color:green">通过</span></if></td></tr>
				</if>
			</volist>
			</tbody>
		</table>
	</notempty>
	<div class="promotion_main">
		<div class="promotion_rule">
			<h2 class="promotion_h2">
				普级机制
			</h2>
			<table class="am-table am-table-bordered">
				<thead>
					<tr>
						<th>等级</th>
						<th>成长积分</th>
						<th>晋级奖励</th>
						<th>跳级奖励</th>
					</tr>
				</thead>
				<tbody>
				<volist name="allbili"  id="value">
					<tr>
						<td>{$value.groupname}</td>
						<td>{$value.shengjiedu}</td>
						<td>{$value.jjje}</td>
						<td>{$value.tiaoji}</td>
					</tr>
				</volist>
				</tbody>
			</table>
		</div>
		<div class="promotion_explain">
			<h2 class="promotion_h2">
				活动说明
			</h2>
			<p>1、会员每晋升一个等级，都能获得奖励，最高可达{$maxjlje}元。</p>
			<p>2、充值1元可获得1成长积分。</p>
			<br />
			<p>例1：奥巴马从VIP1直接晋升到VIP4，他将能获得1+5+10=16元奖励。</p>
			<p>例2：本拉登从VIP2直接晋升到VIP4，他将能获得5+10=15元奖励。</p>
			<br />
		</div>
	</div>

	<include file="Public/footer" />
	<script type="text/javascript">
		function jiangli(){
			$.post("{:U('Activity/jinji')}",'', function(json){
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