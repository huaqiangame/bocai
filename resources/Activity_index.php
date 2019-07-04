<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>{:GetVar('webtitle')}</title>
	<meta name="keywords" content="{:GetVar('keywords')}" />
	<meta name="description" content="{:GetVar('description')}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >

	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/header.css">
	<link rel="stylesheet" href="__CSS2__/activity.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" href="__JS2__/layer/skin/default/layer.css">
	
</head>
<body>
<include file="Public/header" />
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
	<div class="activity_main">
		<div class="container padding_0">
			<div class="panel-group" id="accordion">

			    <div class="panel panel-default" id="activity_panel" >
			        <div class="panel-heading">
			            <h4 class="panel-title">
			                <div data-toggle="collapse"   href="#collapseOne" class="clearfix">
				                <div class="activity_img pull-left">
				                	<img src="__IMG__/20160924082726681336.png" alt="">
				                </div>
				                <div class="activity_title pull-right">
				                	<h2>每日加奖</h2>
				                	<p>qq2617674。</p>
				                	<a href="" class="btn btn-danger">
				                		查看详情
				                		<i class="iconfont">&#xe604;</i>
				                	</a>
				                </div>
			                </div>
			            </h4>
			        </div>
			        <div id="collapseOne" class="panel-collapse  collapse">
			            <div class="panel-body">
			                <div class="activity_content">
			                	<div class="activity_info1">
			                		<h3 class="activity_common_h3">
			                			每日加奖
			                		</h3>
									<if condition="$userinfo.groupid neq '10'">
			                		<p>
			                			<span>昨日投注：<em><eq name="countamount" value="">0<else />{$countamount}</eq></em></span>
										<span>当前等级：<em>{$userinfo.groupname}</em></span>
										<span>加奖比例：<em>{$fanshuibili}%</em></span>
			                			<span>可得加奖：<em><eq name="jiajiang" value="">0<else />{$jiajiang}</eq></em></span>
                                       <notempty name="Think.session.userinfo">
										    <eq name="jiajiang" value="">
												<a href="javascript:void(0);" class="btn no_login_btn">无加奖</a>
												<else />
												 <a href="javascript:void(0);" class="btn btn-danger" onclick="qingquyongqu();" >点击领取加奖</a>
											</eq>
										   <else />
										   <a href="{:U('Public/login')}" class="btn no_login_btn">未登录</a>
									   </notempty>
			                		</p>
										</if>
									<notempty name="Think.session.userinfo">
									<table class="table table-bordered ">
										<tbody>
										<tr><th>领取时会员等级</th><th>流水金额</th><th>反水比例</th><th>领取金额</th><th>领取时间</th><th>状态</th></tr>
									<if condition="$userinfo.groupid neq '10'">
										<volist name="lqlist" id="vo">
										<tr>
											<td>{$vo.groupname}</td>
											<td>{$vo.touzhuedu}</td>
											<td>{$vo.bili}</td> 
											<td>{$vo.amount}</td>
											<td>{$vo.oddtime|date="Y-m-d H:i:s",###}</td>
											<td><if condition="$vo['shenhe'] eq 0"><span style="color:grey">审核中</span><elseif condition="$vo['shenhe'] eq 1"/><span style="color:green">通过</span></if></td></tr>
										</volist>
										</if>
										</tbody>
									</table>
									</notempty>
									<div class="ty_page pages" id="lrx_ty_page">{$pageshow}</div>
			                	</div>
			                	<div class="activity_info2">
			                		<h3 class="activity_common_h3">
			                			加奖比例
			                		</h3>
			                		<table class="table table-bordered">
			                			<thead>
			                				<tr>
			                					<th class="ths">
			                						<i>等级</i>
			                						<ins></ins>
			                						<em>昨日投注</em>
			                					</th>
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
			                	<div class="activity_info3">
			                		<h3 class="activity_common_h3">
			                			活动说明
			                		</h3>
			                		<p>1、每日加奖在每日凌晨00:20后开放领取；</p>
			                		<p>2、加奖比例是根据会员等级以及昨日累计投注金额进行一定比例的加奖；</p>
			                		<!--<p>3、需Vip3以上且昨日投注额大于或等于100才能获得加奖；</p>-->
			                		<p>3、撤单和其他无效投注将不计算在内；</p>
													<p>4、提款后相应的降级将会影响加奖的比例。</p>
			                		<p>5、活动奖金逾期未领取，视为自动放弃活动资格。</p>
			                	</div>
			                </div>
			            </div>
				    </div>
				</div>
			    <div class="panel panel-default" id="activity_panel">
			        <div class="panel-heading">
			            <h4 class="panel-title">
			                <div data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="clearfix collapsed" aria-expanded="false">
				                <div class="activity_img pull-left">
				                	<img src="__IMG__/20160924084334202069.png" alt="">
				                </div>
				                <div class="activity_title pull-right">
				                	<h2>晋级奖励</h2>
				                	<p>会员每晋升一个等级，都能获得奖励，最高可达{$maxjlje}元。</p>
				                	<a href="" class="btn btn-danger">
				                		查看详情
				                		<i class="iconfont"></i>
				                	</a>
				                </div>
			                </div>
			            </h4>
			        </div>
					<div id="collapseTwo" class="panel-collapse collapse" style="" aria-expanded="false">
			            <div class="panel-body">
			                <div class="activity_content">
			                	<div class="activity_info1">
			                		<h3 class="activity_common_h3">
			                			晋级奖励
			                		</h3>
									
									<if condition="$userinfo.groupid neq '10'">
			                		<p>
			                			<span>当前等级：<em>{$userinfo.groupname}</em></span>
										<span>上次晋级等级：<em><empty name="jjlist[0]['groupid']">VIP1<else/>VIP{$jjlist[0].groupid}</empty></em></span>
			                			<span>晋级奖励：<em>{$jlje}元</em></span>
										<notempty name="Think.session.userinfo">
											<eq name="jlje" value="0">
												<a href="javascript:void(0);" class="btn no_login_btn">无奖励</a>
												<else />
												<a href="javascript:void(0);" class="btn btn-danger" onclick="jiangli();" >点击领取奖励</a>
											</eq>
											<else />
											<a href="{:U('Public/login')}" class="btn no_login_btn">未登录</a>
										</notempty>
			                		</p>
                                 </if>
									<notempty name="Think.session.userinfo">
									<table class="table table-bordered ">
										<tbody>
										<tr><th>领取时间</th><th>晋级名称</th><th>晋级积分</th><th>领取奖励</th><th>状态</th></tr>
										
									<if condition="$userinfo.groupid neq '10'">
										<volist name="jjlist" id="vo">
											<if condition="$vo.groupname neq ''">
											<tr><td>{$vo.oddtime|date="m-d H:i",###}</td>
												<td>{$vo.groupname}</td>
												<td>{$vo.point}</td>
												<td>{$vo.jlje}</td>
												<td><if condition="$vo['shenhe'] eq 0"><span style="color:grey">审核中</span><elseif condition="$vo['shenhe'] eq 1"/><span style="color:green">通过</span><elseif condition="$vo['shenhe'] eq -1"/><span style="color:red">未通过</span></if></td></tr>
											</if>
											</volist>
									</if>		
										</tbody>
									</table>
								</notempty>
			                	</div>
			                	<div class="activity_info2">
			                		<h3 class="activity_common_h3">
			                			晋级机制
			                		</h3>
			                		<table class="table table-bordered">
			                			<thead>
			                				<tr>
			                					<th>
			                						<i>等级</i>
			                					</th>
			                					<th>头衔</th>
			                					<th>成长积分</th>
			                					<th>晋级奖励(元)</th>
			                					<th>跳级奖励(元)</th>
			                				</tr>
			                			</thead>
			                			<tbody>
										<volist name="allbili"  id="value">
			                				<tr>
			                					<td>{$value.groupname}</td>
			                					<td>{$value.touhan}</td>
			                					<td>{$value.shengjiedu}</td>
			                					<td>{$value.jjje}</td>
			                					<td>{$value.tiaoji}</td>
			                				</tr>
										</volist>
			                			</tbody>
			                		</table>
			                	</div>
			                	<div class="activity_info3">
			                		<h3 class="activity_common_h3">
			                			活动说明
			                		</h3>
			                		<p>1、会员每晋升一个等级，都能获得奖励，最高可达{$maxjlje}元。 </p>
			                		<p>2、充值1元可获得1成长积分。 </p>
									<p>3、会员每晋升一个等级，都记录在数椐库,下次晋级会以上一次晋级等级来计算,提款后减积分和降级后充值再升级未超过数椐库记录的等级则不在计算内。 </p>
			                		<br />
			                		<p>例1：奥巴马从VIP1直接晋升到VIP4，他将能获得1+5+10=16元奖励。</p>
			                		<p>例2：本拉登从VIP2直接晋升到VIP4，他将能获得5+10=15元奖励。</p>
			                	</div>
			                </div>
			            </div>
				    </div>
				</div>
				 <div class="panel panel-default" id="activity_panel" >
			        <div class="panel-heading">
			            <h4 class="panel-title">
			                <div data-toggle="collapse"   href="#collapse3" class="clearfix">
				                <div class="activity_img pull-left">
				                	<img src="__IMG__/activity_bg5.jpg" alt="">
				                </div>
				                <div class="activity_title pull-right ">
				                	<h2>幸运大奖</h2>
				                	<p>系统随机抽取派送奖金，不限奖金，上不封顶。</p>
				                	<a href="" class="btn btn-danger">
				                		查看详情
				                		<i class="iconfont">&#xe604;</i>
				                	</a>
				                </div>
			                </div>
			            </h4>
			        </div>
			        <div id="collapse3" class="panel-collapse  collapse">
						{$houdong1}
				    </div>
			
			</div>
				<div class="panel panel-default" id="activity_panel" >
			        <div class="panel-heading">
			            <h4 class="panel-title">
			                <div data-toggle="collapse"   href="#collapse4" class="clearfix">
				                <div class="activity_img pull-left">
				                	<img src="__IMG__/activity_bg4.jpg" alt="">
				                </div>
				                <div class="activity_title pull-right ">
				                	<h2>好友推荐</h2>
				                	<p>快互动您的好友一起购彩</p>
				                	<a href="" class="btn btn-danger">
				                		查看详情
				                		<i class="iconfont">&#xe604;</i>
				                	</a>
				                </div>
			                </div>
			            </h4>
			        </div>
			        <div id="collapse4" class="panel-collapse  collapse">
						{$houdong2}
					</div>
		</div>
		<div class="panel panel-default" id="activity_panel" >
			        <div class="panel-heading">
			            <h4 class="panel-title">
			                <div data-toggle="collapse"   href="#collapse5" class="clearfix">
				                <div class="activity_img pull-left">
				                	<img src="__IMG__/activity_bg7.jpg" alt="">
				                </div>
				                <div class="activity_title pull-right ">
				                	<h2>代理加盟</h2>
				                	<p style="margin: 13px 0;">全新最优代理合作模式，零风险，零成本，实时获得返点赚取佣金，免流水，随时提现</p>
				                	<a href="" class="btn btn-danger">
				                		查看详情
				                		<i class="iconfont">&#xe604;</i>
				                	</a>
				                </div>
			                </div>
			            </h4>
			        </div>
			        <div id="collapse5" class="panel-collapse  collapse">
						{$houdong3}
					</div>
	</div>
	<div class="panel panel-default" id="activity_panel" >
			        <div class="panel-heading">
			            <h4 class="panel-title">
			                <div data-toggle="collapse"   href="#collapse6" class="clearfix">
				                <div class="activity_img pull-left">
				                	<img src="__IMG__/activity_bg3.jpg" alt="">
				                </div>
				                <div class="activity_title pull-right ">
				                	<h2>幸运首充</h2>
				                	<p style="margin: 13px 0;">首次充值送现金【幸运彩】百发钜惠第一惠隆重推出【秒冲，秒送】存款送现金专题活动！福利专属8888元</p>
				                	<a href="" class="btn btn-danger">
				                		查看详情
				                		<i class="iconfont">&#xe604;</i>
				                	</a>
				                </div>
			                </div>
			            </h4>
			        </div>
			        <div id="collapse6" class="panel-collapse  collapse">
						{$houdong4}
					</div>
	</div>
	<div class="panel panel-default" id="activity_panel" >
			        <div class="panel-heading">
			            <h4 class="panel-title">
			                <div data-toggle="collapse"   href="#collapse7" class="clearfix">
				                <div class="activity_img pull-left">
				                	<img src="__IMG__/activity_bg6.jpg" alt="">
				                </div>
				                <div class="activity_title pull-right ">
				                	<h2>幸运额度</h2>
				                	<p style="margin: 13px 0;">幸运彩信用额度88888元，助您翻本！</p>
				                	<a href="" class="btn btn-danger">
				                		查看详情
				                		<i class="iconfont">&#xe604;</i>
				                	</a>
				                </div>
			                </div>
			            </h4>
			        </div>
			        <div id="collapse7" class="panel-collapse  collapse">
						{$houdong5}
				</div>
	</div>
	</div>
	</div>
<script type="text/javascript">
		function qingquyongqu(){
			$.post("{:U('Home/Activity/fanshui')}",'', function(json){
				if(json.status==1){
					alert(json.info);
					window.location.reload();
				}else{
					alert(json.info);
				}
			},'json');
			return false;
	}
	function jiangli(){
		$.post("{:U('Home/Activity/jinji')}",'', function(json){
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
<include file="Public/footer" />
</body>
</html>