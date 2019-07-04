<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员中心 - 快三线上平台</title>
<meta name="renderer" content="webkit" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/reset.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/layout.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/member.css" />
<script>
var WebConfigs = {
	webtitle:"{$webconfigs.webtitle}",
	kefuthree:"{$webconfigs.kefuthree}",
	ROOT : "__ROOT__",
	kefuqq:"{$webconfigs.kefuqq}"
};
</script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
<!--[if lt IE 9]>
<script src="__ROOT__/resources/js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery.history.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/index.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/member.page.js"></script>
<script src="__ROOT__/resources/js/laydate/laydate.js" type="text/javascript" ></script>
<script type="text/javascript" src="__ROOT__/resources/main/orderform.js"></script>

</head>

<body>

<include file="Public/header" />
<section class="container pt-10 pb-10" id="memberpage" >
	<div class="memberhome">
		<include file="Member/top" />
				<div class="memhome-bottom ml-20 mr-20">
					<div class="memsubnav">

 <include file="Member/menu" />
					</div>
					<div class="mem-main">
						<div class="m-m-cen ym-grid">
							<div class="m-m-subnav tab">
								<ul class="level2-nav tabHd">
									<li class="cur" data-tabid="userbets">游戏记录</li>
									<li data-tabid="userfuddetail">账变记录</li>
									<li data-tabid="lotteryreport">彩票报表</li>
									<li data-tabid="rechargelist">充值记录</li>
									<li data-tabid="withdrawlist">提款记录</li>
								</ul>
								<div class="tabBd">
									<div class="tb-imte cur" style="display: block;">
										<table class="mem-biao" id="userBets">
											<thead>
												<tr>
													<th colspan="10">
														<span>时间：</span>
														<input class="layriqi starTime" onclick="laydate({format:'YYYY-MM-DD',isclear:false});" readonly="true" type="text">
														<span class="zhi">至</span>
														<input class="layriqi endTime" onclick="laydate({format:'YYYY-MM-DD',isclear:false});" readonly="true" type="text">
														<span>游戏类别：</span>
														<select class="lotteryname"></select>
														
														<span>订单状态：</span>
														<select class="state">
															<option value="">全部</option>
															<option value="0">未开奖</option>
															<option value="-1">未中奖</option>
															<option value="1">已中奖</option>
															<option value="-2">已撤单</option>
														</select>
														<span>订单编号：</span>
														<input class="in-tx-1 trano" type="text">
														<a href="javascript:;" class="in-but-l h-32" id="userbetsbtn" onclick="userbets()">查询</a>
													</th>
												</tr>
											<tr>
                                            <th colspan="10" style="text-align: center; font-size:16px;">
                                            <p class="mark">有效投注：<b way-data="userbets.touzhutotal">0.00</b>
                                            奖金收入：<b way-data="userbets.fanjiangtotal">0.00</b>
                                            盈亏：<b way-data="userbets.tzyingkuitotal">0.00</b>
                                            </p>
                                            </th>
                                            </tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
									<div class="tb-imte" style="display: none;">
											<table class="mem-biao" id="accountChange">
												<thead>
													<tr>
														<th colspan="7">
															<span>时间：</span>
															<input class="layriqi starTime" onclick="laydate({format:'YYYY-MM-DD',isclear:false});" readonly="true" type="text">
															<span class="zhi">至</span>
															<input class="layriqi endTime" onclick="laydate({format:'YYYY-MM-DD',isclear:false});" readonly="true" type="text">
															<span>帐变类型：</span>
															<select id="sourceModule">
</select>
															<!--<span>账户类型：</span>
															<select id="accModule">
<option value="">全部</option>
<option value="amount">现金账户</option><option value="xima">洗码账户</option><option value="point">积分账户</option>
</select>-->
															<a href="javascript:;" class="in-but-l h-32" id="userfuddetailbtn" onclick="userfuddetail()">查询</a>
														</th>
													</tr>
												</thead>
												<tbody>
											<tr><th>订单号</th><th>彩种</th><th>期号</th><th>玩法</th><th>模式</th><th>金额</th><th>倍数</th><th>奖金</th><th>状态</th></tr>
												</tbody>
											</table>
									</div>
									<div class="tb-imte" style="display: none;">
									<table class="mem-biao" id="lotteryReport">
										<thead>
											<tr>
												<th colspan="8">
													<span>时间：</span>
													<input class="layriqi starTime" onclick="laydate({format:'YYYY-MM-DD',isclear:false});" readonly="true" type="text">
													<span class="zhi">至</span>
													<input class="layriqi endTime" onclick="laydate({format:'YYYY-MM-DD',isclear:false});" readonly="true" type="text">
													
													<a href="javascript:;" class="in-but-l h-32" id="lotteryreportbtn" onclick="lotteryreport()">查询</a>
												</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
									</div>
									<!-- 充值记录  -->
									<div class="tb-imte" style="display: none;">
										<table class="mem-biao" id="saveRecords">
											<thead>
												<tr>
													<th colspan="8">
														<span>充值时间：</span>
														<input class="layriqi starTime" onclick="laydate({format:'YYYY-MM-DD',isclear:false});" readonly="true" type="text">
														<span class="zhi">至</span>
														<input class="layriqi endTime" onclick="laydate({format:'YYYY-MM-DD',isclear:false});" readonly="true" type="text">
														<span>状态：</span>
														<select name="" class="state">
															<option value="">所有</option>
															<option value="0">正在审核</option>
															<option value="1">已完成</option>
															<option value="-1">取消申请</option>
														</select>
														<span>订单编号：</span>
														<input class="in-tx-1 trano" value="" type="text">
														<a href="javascript:;" class="in-but-l h-32" id="rechargelistbtn" onclick="rechargelist()">查询</a>
													</th>
												</tr>
											</thead>
											<tbody>
											
											</tbody>
										</table>
									</div>
									
									<!-- 提款记录  -->
									<div class="tb-imte" style="display: none;">
										<table class="mem-biao" id="drawRecords">
											<thead>
												<tr>
													<th colspan="10">
														<span>提款时间：</span>
														<input class="layriqi starTime" onclick="laydate({format:'YYYY-MM-DD',isclear:false});" readonly="true" type="text">
														<span class="zhi">至</span>
														<input class="layriqi endTime" onclick="laydate({format:'YYYY-MM-DD',isclear:false});" readonly="true" type="text">
														<span>状态：</span>
														<select name="" class="state">
															<option value="">所有</option>
															<option value="0">正在审核</option>
															<option value="1">已完成</option>
															<option value="-1">退回申请</option>
														</select>
														<span>订单编号：</span>
														<input class="in-tx-1" value="" class="trano" type="text">
														<a href="javascript:;" class="in-but-l h-32" id="withdrawlistbtn" onclick="withdrawlist()">查询</a>
													</th>
												</tr>
											</thead>
											<tbody>
											
											</tbody>
										</table>
									</div>
									
									<!-- 转账记录  -->
								</div>
								<div class="member-pag paging"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
</section>

<include file="Public/footer" />
<div id="getBillInfobox" style="display:none">
<div class="submitComfire">
<ul class="ui-form">
<li style="width:50%; float:left"><label for="question1" class="ui-label">彩种：</label><span class="mark" way-data="BillInfo.cptitle">--</span></li>
<li style="width:50%; float:left"><label for="question1" class="ui-label">期号：</label><span class="mark">第 <span way-data="BillInfo.expect" class="mark">--</span> 期</span></li>	
<li style="width:50%; float:left"><label for="question1" class="ui-label">玩法：</label><span class="mark" way-data="BillInfo.playtitle">--</span></li>
<li style="width:50%; float:left"><label for="question1" class="ui-label">赔率：</label><span way-data="BillInfo.mode" class="mark">--</span></li>	
<li><label for="answer1" class="ui-label">投注号码：</label><span class="mark" way-data="BillInfo.tzcode">--</span></li>	
<li style="width:50%; float:left"><label for="question2" class="ui-label">单注金额：</label><span class="mark" way-data="BillInfo.amount">--</span></li><li style="width:50%; float:left"><label for="question2" class="ui-label">投注注数：</label><span class="mark" way-data="BillInfo.itemcount">--</span></li>
<li style="width:50%; float:left"><label for="question2" class="ui-label">中奖金额：</label><span class="mark" way-data="BillInfo.okamount">--</span></li><li style="width:50%; float:left"><label for="question2" class="ui-label">中奖注数：</label><span class="mark" way-data="BillInfo.okcount">--</span></li>


<li style="width:50%; float:left"><label for="question2" class="ui-label">开奖号码：</label><span class="mark" way-data="BillInfo.opencode">--</span></li><li style="width:50%; float:left"><label for="question2" class="ui-label">中奖状态：</label><span id="BillInfo_isdraw" way-data="BillInfo.state">--</span></li>
</ul>
</div>
</div>

</body>
</html>