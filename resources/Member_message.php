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
<script src="__ROOT__/resources/js/jquery-dateFormat.min.js" type="text/javascript"></script>
<script type="text/javascript" src="__ROOT__/resources/main/message.js"></script>

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
						<div class="me-message tab">
							<div class="m-mess-l l">
								<div>
									<div class="m-mess-nav">
										<ul class="tabHd">
											<li class="" onclick="chatReceList();"><i class="fa fa-envelope-open-o fa-2x"></i>收信箱 <em><way way-data="messageReceCount">0</way></em></li>
											<li onclick="chatSentList();" class="cur"><i class="fa fa-envelope-o fa-2x"></i>发信箱<em><way way-data="messageSentCount">0</way></em></li>
											<li onclick="writeNewMessage();" class=""><i class="fa fa-pencil-square-o fa-2x"></i>写信</li>
										</ul>
									</div>
									<div class="massage-search"><span><input id="searchMessageWord" onkeyup="searchMessage();" value="" placeholder="搜索" maxlength="15" type="text"></span><a href="javascript:" onclick="searchMessage();">&nbsp;</a></div>
									<div class="tabBd">
										<div class="tb-imte cur" style="display: none;">
											<div class="m-l-center" id="chatReceList">
												<dl></dl>
											</div>
											<div class="m-record">
												<p class="l">记录条数：<strong><way way-data="messageReceRecords"></way></strong></p>
												<p class="r"><a href="javascript:;" onclick="cleanReceList();">清空</a></p>
											</div>
										</div>
										<div class="tb-imte" style="display: block;">
											<div class="m-l-center" id="chatSentList">
												<dl></dl>
											</div>
											<div class="m-record">
												<p class="l">记录条数：<strong><way way-data="messageSentRecords"></way></strong></p>
												<p class="r"><a href="javascript:;" onclick="cleanSentList();">清空</a></p>
											</div>
										</div>
										<div class="tb-imte" style="display: none;">
											<div class="m-l-center" id="downUserList">
												<dl>
													<dd receiverid="system" loginname="客服">
														<div class="l m-pic gly"><img src="__ROOT__/resources/images/icon/logo.png" alt=""></div>
														<div class="l m-nc">
															<h6>客服</h6>
														</div>
													</dd>
													<dd receiverid="up" loginname="上级">
														<div class="l m-pic sj"><img src="__ROOT__/resources/images/icon/logo.png" alt=""></div>
														<div class="l m-nc">
															<h6>上级</h6>
														</div>
													</dd>
												</dl>
											</div>
											<div class="m-record">
												<p class="l">下级人数：<strong><way way-data="downUserCount">0</way></strong></p>
												<p class="r">
													<input value="" id="allDownUser" type="checkbox">
													<label for="allDownUser">&nbsp;全选下级</label>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="r m-mess-r tabBd">
								<div class="me-inbox tb-imte ym-box cur" id="readMessageDiv" style="display: block;">
									<div class="m-s-title"><h6></h6></div>
									<div class="me-in-cen"></div>
									<div class="srk"><textarea></textarea><span>剩余可输入：800个字</span></div>
									<div class="fs" style="text-align: center;"><a class="w-16 in-but-l" href="javascript:;" onclick="replyMessage();">发送</a></div>
									<input id="replyMessageId" value="" type="hidden">
									<input id="replyMessageBox" value="" type="hidden">
								</div>
								<!-- 写信 -->
								<div class="me-write tb-imte ym-box" id="writeNewMessDiv">
									<div class="sjr">
										<div class="l"><span>收件人</span></div>
										<div class="l fjr">
											<input id="sendMessageUserId" type="hidden">
											<div id="sendMessageUserName"><em>aaaaa</em>，<em>aaaaa</em>，<em>aaaaa</em>，<em>aaaaa</em>，<em>aaaaa</em>，<em>aaaaa</em>，<em>aaaaa</em>，<em>aaaaa</em>，<em>aaaaa</em></div>
											<a class="m-del" href="javascript:;" onclick="cleanSendMessageReceUser();"></a>
										</div>
									</div>
									<div><input class="xxzhuti" id="sendMessageTitle" value="" placeholder="请输入主题" type="text"></div>
									<div class="srk"><textarea id="sendMessageContent"></textarea><span>剩余可输入：800个字</span></div>
									<div class="fs" style="text-align: center;"><a class="w-16 in-but-l" href="javascript:;" onclick="sendMessage();">发送</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
</section>

{include file="Public/footer" /}

</body>
</html>