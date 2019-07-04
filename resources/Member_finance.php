<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{:GetVar('webtitle')}</title>
	<meta name="keywords" content="{:GetVar('keywords')}" />
	<meta name="description" content="{:GetVar('description')}" />
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
var payhost = "{:C('payhost')}";
</script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
<!--[if lt IE 9]>
<script src="__ROOT__/resources/js/html5shiv.js"></script>
<![endif]-->
<script>
var payhost = "{:C('payhost')}";
</script>
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery.history.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/index.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/member.page.js"></script>
<script src="__ROOT__/resources/js/laydate/laydate.js" type="text/javascript" ></script>
<script type="text/javascript" src="__ROOT__/resources/main/finance.js"></script>

</head>

<body>

{include file="Public/header" /}
<section class="container pt-10 pb-10" id="memberpage" >
	<div class="memberhome">
		{include file="Member/top" /}
		<div class="memhome-bottom ml-20 mr-20">
			<div class="memsubnav">
				
			{include file="Member/menu" /} 	
			</div>
<div class="mem-main">
						 <div class="mem-Recharge tab">
							 <div class="mem-re-nav">
								 <ul class="tabHd">
									 <li class="cur" code="cunk">充值</li>
									 <li code="quk">提款</li>
									 <li code="jfdh">积分兑换</li>
								 </ul>
							 </div>
							 <div class="mem-re-main tabBd">
								<div class="tabBd-item cur" style="display: block;">
									<div class="m-f-cuk">
										<div class="m-cun-tab c-tab-one tab">
														<div class="me-deposit">
															<ul>
																<li class="cur d-one">1、选择银行并填写金额</li>
																<li class="d-tow">2、确定充值信息</li>
																<li class="d-three">3、登录银行进行转账</li>
															</ul>
														</div>
											<div class="m-c-hd">
												<h6>支付方式：</h6>
												<ul class=""></ul>
											</div>
											<div class="m-c-bd tabBd">
												<!-- 网银充值 -->
												<div class="tb-imte cur" style="display: block;">
													<div class="c-buzou tab">
														<!-- 第一步 -->
														<div class="c-bz-c-one">
															<div class="c-t-czje">
																<h6>充值金额：</h6>
																<div>
																	<input way-data="recharge.amount" placeholder="请输入充值金额" onkeyup="replaceAndSetPos(this,event,/[^\d]/g,'');" type="text">
																	<input type="hidden" way-data="recharge.minmoney" value="10"><input type="hidden" way-data="recharge.maxmoney" value="50000">
																	<span>元&nbsp;&nbsp;（充值金额必须在<span id="depositLimit">1~50000</span>元之间）</span>
																</div>
																<div class="userpayname"></div>
															</div>
															<a class="xyb in-but-l w-2" href="javascript:;" onclick="recharge(event);">下一步</a>
															<div class="paycontent"></div>
														</div>
														<!-- 第二步 -->
														<div id="pay_alipay" class="me-infor" style="display:none;">
															<div class="infor-xx">
																<ul class="mar-lr20">
																	<li>尊敬的客户您好，您的充值订单已经生成，请您在该页面继续完成充值。</li>
																	<li>
																		<h6>充值金额：</h6>
																		<span><em class="mark" way-data="saomabill.amount"></em>元</span>
																	</li>
																	<li>
																		<h6>订单编号：</h6>
																		<span way-data="saomabill.trano" class="mark"></span>
																	</li>
																	<li>
																		<h6>附言码：</h6>
																		<span way-data="saomabill.id" class="mark"></span>
																	</li>
																</ul>
																	
																<div>
																	<input type="hidden" way-data="saomabill.paytype" />
																	<!--<a class="in-but-l w-2" href="javascript:;" onclick="paysaoma();">进入扫码完成支付</a>-->
																	<a class="in-but-l w-2 paysaomabtn" href="javascript:;" onclick="paysaoma();">进入扫码完成支付</a>
																</div>
															</div>
														</div>
														<div id="pay_linebank" class="me-infor" style="display:none;">
															<div class="infor-xx">
																<p>尊敬的客户您好，请根据以下信息进一步完成您的充值（如：以充值成功，请点击下方确认完成充值）</p>
                                                                
<p>选择转账银行：(<small style="color:#e64743; font-size:12px;">转账成功后选择</small>)</p>
<table>
<tbody>
<tr>
<td><label><input name="linebankid" value="2" type="radio">工商银行</label></td>
<td>开户姓名:陈成</td>
<td>银行账号:1234567891234567</td>
</tr><tr>
<td><label><input name="linebankid" value="3" type="radio">建设银行</label></td>
<td>开户姓名:陈成</td>
<td>银行账号:1234567891234567</td>
</tr></tbody>
</table>
																<ul class="mar-lr20">
																	<li>
																		<h6>充值金额：</h6>
																		<span><em class="dred" way-data="bill.linebankamount"></em>元</span>
																	</li>
																	<li>
																		<h6>订单编号：</h6>
																		<span way-data="bill.linebankbillNo" class="dred"></span>
																	</li>
																	<li>
																		<h6>附言码：</h6>
																		<span way-data="bill.linebankfuyanma" class="dred"></span>
																	</li>
                                                                    <li>
																		<h6>转出银行账号：</h6>
																		<input name="linebankpayname" style="border: 1px solid #e64743;font-size: 12px;height: 30px;line-height: 30px;margin: 0 5px;padding: 0 5px;" type="text">
                                                                    </li>
																</ul>
																	
																
															</div>
															<div>
																
																<a href="javascript:;" class="in-but-l w-2" onclick="pay_success_ok()">确认完成充值</a>
                                                                <a class="in-but-l w-2" href="javascript:;" onclick="transferThenReload('ckjl');">查看充值记录</a>
															</div>
                                                            <div class="zysx"><p>
	尊敬的客户您好，网银在线充值维护中，请选择其他支付方式
</p>
<br>
<div class="zysx">
	<br>
	<p>
		1.您的"附言"是您唯一入账的凭证，不能泄露给任何人，包括您的上级代理。防止用您的"附言"为自己充值，切勿泄露，否则损失客户自行承担。
	</p>
<br>
	<p>
		2.转账成功后，切记把"附言"复制到充值页面进行提交，否则充值无法自动到账。
	</p>
<br>
	<p>
		3.充值平台只支持"网银同行汇款"，不支持任何"跨行转账""ATM机转账""手机银行"等，此类充值一律不给到账处理。
	</p>
<br>
	<p>
		4.平台收款卡"不定时"更换，请每次转账前在本页面查看银行账号。如充值过期卡号，损失由客户自行承担。
	</p>
</div></div>
														</div>
                                                        
                                                        <div id="pay_onlineBank" class="me-infor" style="display:none;">
															<div class="infor-xx">
																<ul class="mar-lr20">
																	<li>尊敬的客户您好，您的充值订单已经生成，请您在该页面继续完成充值。</li>
																	<li>
																		<h6>充值金额：</h6>
																		<span><em class="mark" way-data="onlineBank.amount"></em>元</span>
																	</li>
																	<li>
																		<h6>订单编号：</h6>
																		<span way-data="onlineBank.trano" class="mark"></span>
																	</li>
																	
																</ul>
																	
															</div>
                                                                
															<div>
																<a class="in-but-l w-2" href="javascript:;" onclick="payonlineBank();" id="onlineBankUrl">登录网银完成支付</a>
															</div>
                                                        
                                                        </div>
                                                        
                                                        
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
<div class="tabBd-item" id="qukPage" style="display: none;">
									<div class="tab">
										<h5>选择已绑定银行或提款账户：</h5>
									</div>
									<div class="me-back">
										<div class="tabBd">
											<div class="cur">
												<div class="back-choose">
<ul></ul>
												</div>
											</div>
										</div>
										<div class="me-ba-shur">
											<div class="l tab qkjemm">
												<ul>
													<li><span class="ba-tt">提款金额：</span><input id="quk_withdraw_money" placeholder="请输入提款金额" onkeyup="replaceAndSetPosWithdraw(this,event,/[^\d]/g,'');" maxlength="7" type="text"> <em>元</em></li>
													<li><span class="ba-tt">手续费：</span><input id="quk_fee" value="0.0000" readonly="true" type="text"></li>
													<li><span class="ba-tt">实际到账：</span><input id="quk_ramount" value="0.0000" readonly="true" type="text"></li>
													<li><p>温馨提示：您今天还有<label way-data="quk_explain_freetimes">0</label>次提款免手续费特权</p></li>
												</ul>
												<div class="m-c-hd">
													<h6>请输入提款密码：</h6>
													<div class="tabBd">
														<div class="tb-imte cur" id="qukPasswordDiv" style="display: block;">
															<input id="bindbankid" type="hidden">
															<ul class="srqkmm">
																<li class="zijinmimaput" style="display:none"><span class="ba-tt">资金密码：</span><input value="" id="quk_withdraw_pwd" type="password"></li>
																<li class="tikuanmsg" style="color: rgb(255, 0, 0); font-size: 16px;">洗码余额为0时可以提款</li>
																															</ul>
														</div>
													</div>
												</div>
												<a class="xyb in-but-l w-2" href="javascript:;" onclick="toApplyForWithdraw(event);">下一步</a>
											</div>
											<div class="ba-shur-je r">
												<table>
													<tbody>
														<tr>
															<th>可提金额：</th>
															<td><span  way-data="user.balance">0.00</span>元</td>
														</tr>
														<tr>
															<th>洗码余额：</th>
															<td><span way-data="user.xima">0.00</span>元</td>
														</tr>
														<tr>
															<th>单笔限额（元）：</th>
															<td><span way-data="quk_explain_xiane">{:C('tikuanMin')}~{:C('tikuanMax')}</span>元</td>
														</tr>
														<tr>
															<th>提款时间：</th>
															<td><span way-data="quk_explain_time">{:C('tikuanstart')} ~ {:C('tikuanend')}</span></td>
														</tr>
														<tr>
															<th>每日限额：</th>
															<td>日提款总额：<span way-data="quk_explain_daymaxMoney">{:C('ritikuanxiane')}</span>元</td>
														</tr>
														<tr>
															<th>提款手续费计算公式：</th>
															<td>提款金额x<span way-data="quk_explain_feescale">{:C('tikuannumoverbilv')}</span>%，最小手续费 <span way-data="quk_explain_minfee">{:C('tikuannumovermin')}</span>，最高手续费<span way-data="quk_explain_maxfee">{:C('tikuannumovermax')}</span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="me-ba-wxts">
											<strong>温馨提示：</strong>
                                            <p>1.为防止恶意洗钱，打码金额必须为0时才可以提现</p>
											<p>2.提款限额为{:C('tikuanMin')}至{:C('tikuanMax')}元，平台承担每天前{:C('tikuannum')}笔提款手续费，后续提款手续费将从提款金额中扣除</p>
											<p>3.如果会员绑定的资料错误，提款金额将会在一个小时内返回到平台可用金额中。</p>
											<p>4.工商银行一般1-10分钟即可到账，跨行提款由于银行之间转账关系，跨行提款一般在1-30分钟内到账，如长时间未到账请及时联系客服查询，谢谢！</p>
										</div>
									</div> 
								</div>
								
								
<div class="tabBd-item" id="jfdhPage" style="display: none;">
									
										
										<div class="me-ba-shur">
											<div class="l tab jfdhjemm">
												<ul>
													<li><span class="ba-tt">兑换积分：</span><input id="jfdh_point" placeholder="请输入兑换积分量" onkeyup="replacepointexchangeamount(this,event,/[^\d]/g,'');" maxlength="7" type="text"> <em>积分</em></li>
													<li><span class="ba-tt">可兑换金额：</span><input id="jfdh_money" value="0.0000" readonly="true" type="text"></li>
												</ul>
												<div class="m-c-hd">
													<h6>请输入提款密码：</h6>
													<div class="tabBd">
														<div class="tb-imte cur" id="zijiPasswordDiv" style="display: block;">
															<ul class="srqkmm">
																<li class="jfdhzijinmimaput" style="display:none"><span class="ba-tt">资金密码：</span><input value="" id="jfdh_withdraw_pwd" type="password"></li>
																<li class="jfdhmsg" style="color: rgb(255, 0, 0); font-size: 16px;">积分兑换已关闭</li>
																															</ul>
														</div>
													</div>
												</div>
												<a class="xyb in-but-l w-2" href="javascript:;" onclick="PointtoMoney(event);">确认兑换</a>
											</div>
											<div class="ba-shur-je r">
												<table>
													<tbody>
														<tr>
															<th>可兑换积分：</th>
															<td align="left"><span  way-data="user.point">0.00</span></td>
														</tr>
														<tr>
															<th>积分兑换规则：</th>
															<td align="left"><span way-data="pointexchangeamount.changerule"></span></td>
														</tr>
														<tr>
															<th>积分获取：</th>
															<td id="getpointrules" align="left"></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										
								</div>
								
								
								
								
							 </div>
						 </div>
					</div>			
		</div>
	</div>
</section>

{include file="Public/footer" /}
<div id="tikuanquery" class="aar" style="display:none;">
	<div class="aar-center">
		<div class="tishik">
			<dl class="validate-form">
				<dd>
					<span class="tt">提款银行：</span>
					<span id="bankorder_bankname"></span>
					</dd>
				<dd>
					<span class="tt">银行账号：</span>
					<span id="bankorder_bankcode"></span>
				</dd>
				<dd>
					<span class="tt">提款金额：</span>
					<span id="bankorder_amount"></span>
				</dd>
				<dd>
					<span class="tt">手续费：</span>
					<span id="bankorder_free"></span>
				</dd>
				<dd>
					<span class="tt">实到账：</span>
					<span id="bankorder_ramount"></span>
				</dd>
			</dl>
		</div>
	</div>
</div>
<form id="tikuanorderform" style="display:none;">
<input type="hidden" id="tikuanorder_bankid">
<input type="hidden" id="tikuanorder_amount">
<input type="hidden" id="tikuanorder_withdraw_pwd">
</form>

</body>
</html>