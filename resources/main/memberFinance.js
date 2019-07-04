// 所有账户
var allPlatform = {};
allPlatform.cpzh = "主账户";
// 用户已开通账户
var allOpenPlatform = {};
allOpenPlatform.cpzh = "主账户";

var outPlatformCode = 'cpzh';
var transfersToCode = '';

//提款页面网银充值是否仅有支付宝充值
var onlyAlipay = false;

// 支付方式
var rechangeType = [];

$(function() {
	userSecurityLevel();
	
	//获取用户返水返点信息
	userRebate();
	//用户银行卡列表
	//userBank();
	// 获取账户总额
	getTotalBalance();
	//是否满足提款要求
	isUserWithdrawLimit();
	//用户安全等级
	userSecurityLevelShow();
	
	openPlatformList();
	
	var searchStr = window.location.search;
	outPlatformCode = getQueryString(searchStr.substr(1), "outCode");
	if (!outPlatformCode) {
		outPlatformCode = 'cpzh';
	}

	var financeCode = getQueryString(searchStr.substr(1), "financeCode");
	if (!financeCode) {
		financeCode = 'cunk';
	}
	
	//init(financeCode);

	// 切换子菜单
	var submenuLi = $("div.mem-main div.mem-re-nav .tabHd li");
	submenuLi.on("click", function() {
		init($(this).attr("code"));
	});
	
	// 选中子菜单
	submenuLi.each(function(){
		if ($(this).attr("code") == financeCode) {
			$(this).addClass("cur");
			$(this).click();
			return false;
		}
	});
	
	// 支付方式选择
	$("#cunkPage ul.tabHd").delegate("li", "click", function() {
		$(this).addClass("cur").siblings().removeClass("cur");

		$("#cunkPage div.me-infor").hide();
		$("#cunkPage div.c-bz-c-one").show();

		var code = $(this).attr("code");
		
		var czje = $("#cunkPage div.c-t-czje");
		if(code == "Eypalcard" || code == "Qiancard") {
			czje.eq(1).show();
			czje.eq(2).show();
		} else {
			czje.eq(1).hide();
			czje.eq(2).hide();
		}
		
		$("#cunkPage .c-t-hzyh").html('<h6>支付方式：</h6><ul></ul>');
		var hzyh = $("#cunkPage .c-t-hzyh ul");
		hzyh.empty();
		
		if(code == "jubaoyun") {
			$("#cunkPage .c-t-hzyh").html('<img src="../../resources/txh/images/member/zxcz.jpg">');
		} else if (code == 'onlineBank') {
			$("#cunkPage div.me-deposit li:first").addClass("cur").siblings().removeClass("cur");

			$("#cunkPage div.me-deposit").show();
			
			$.each(rechangeType, function(idx, val) {
				if(val.code == code) {
					if(val.list) {
						var html = '';
						$.each(val.list, function(idxx, vall){
							html += '<li bankid="' + vall.id + '">';
							html += '<img src="../../resources/txh/images/member/hezyh/' + vall.images + '" height="24" width="128" alt="' + vall.shortName + '">';
							html += '<i class="xz"></i></li>';
						});
						hzyh.html(html);
						hzyh.find("li:first").click();
					}
					return false;
				}
			});
		} else {
			changWordForAlipay();
			
			$.each(rechangeType, function(idx, val) {
				if(val.code == code) {
					var html = '';
					if(val.list) {
						$.each(val.list, function(idxx, vall){
							html += '<li bankCode="' + vall.bankCode + '">';
							html += '<img src="../../resources/txh/images/member/hezyh/' + vall.bankLogo + '" height="24" width="128" alt="' + vall.bankName + '">';
							html += '<i class="xz"></i></li>';
						});
					}
					hzyh.html(html);
					hzyh.find("li:first").click();
					$("#depositLimit").text(val.minMoney + "-" + val.maxMoney);
					return false;
				}
			});
			
			$("#cunkPage div.me-deposit").hide();
		}
	});

	// 支付方式选择
	$("#cunkPage div.c-t-hzyh").delegate("ul li", "click", function() {
		$(this).addClass("cur").siblings().removeClass("cur");

		if ($("#cunkPage ul.tabHd li.cur").attr("id") == 'onlineBank') {
			var id = $(this).attr("bankid");
			$.each(rechangeType, function(idx, val) {
				if(val.code == 'onlineBank') {
					$.each(val.list, function(idxx, vall){
						if(vall.id == id) {
							$("#depositLimit").text(vall.minMoney + "-" + vall.maxMoney);
							return false;
						}
					});
					return false;
				}
			});
		}
	});
	
	// 转账切换
	$("#switchbtn").click(function() {
		outPlatformCode = $("#Eslct1 select").val();
		transfersToCode = $("#Eslct0 select").val();
		
		var outHtml = '';
		var inHtml = '';
		$.each(allOpenPlatform, function(k, v) {
			if (k != transfersToCode) {
				if (k == outPlatformCode) {
					outHtml = '<option value="' + k + '">' + v + '</option>' + outHtml;
				} else {
					outHtml += '<option value="' + k + '">' + v + '</option>';
				}
			}
			
			if (k != outPlatformCode) {
				if (k == transfersToCode) {
					inHtml = '<option value="' + k + '">' + v + '</option>' + inHtml;
				} else {
					inHtml += '<option value="' + k + '">' + v + '</option>';
				}
			}
		});
		
		$("#Eslct0 select").html(outHtml);
		$("#Eslct1 select").html(inHtml);
	});
	
	// 提款账户选择
	$("#qukPage div.fenhong ul li").on("click", function(){
		$("#qukPage div.fenhong ul li").removeClass("cur");
		$(this).addClass("cur");
		if($(this).attr("acttype") == "1") {
			if($("#qukPage div.back-choose ul li:last").attr("bankid")=="1"){
				$("#qukPage div.back-choose ul li:last").hide();
			}
			$("#quk_explain_balance").css("display", "block");
			$("#quk_explain_dividend").css("display", "none");
		} else {
			$("#qukPage div.back-choose ul li:last").show();
			$("#quk_explain_balance").css("display", "none");
			$("#quk_explain_dividend").css("display", "block");
		}
	});
	
	// 提款银行卡选择
	$("#qukPage div.back-choose").delegate("ul li", "click", function() {
		$("#qukPage div.back-choose ul li").removeClass("cur");
		$(this).addClass("cur");
	});

	// 密码验证方式
	$("#quk_authType li").on("click", function() {
		$("#quk_authType li").removeClass();
		$(this).addClass("cur");
		
		if ($("#quk_authType li").eq(0).hasClass("cur")) {
			$("#qukGooglePwdDiv").hide();
			$("#qukPasswordDiv").show();
		} else {
			$("#qukPasswordDiv").hide();
			$("#qukGooglePwdDiv").show();
		}
	});
});

/**
 * 提款页面网银充值仅有支付宝时处理
 */
function changWordForAlipay(isAlipay){
	// 不满足网银充值仅有支付宝条件
	if(onlyAlipay !== true) {
		return false;
	}
	
	var cunkPageDiv = $("#cunkPage");
	if(isAlipay === true) {
		cunkPageDiv.find("ul.tabHd li:first").html("<i></i>支付宝充值");
		cunkPageDiv.find(".me-deposit li:first").text("1、填写金额");
		cunkPageDiv.find(".me-deposit li:last").text("3、登录支付宝进行转账");
		cunkPageDiv.find("table tr:first").hide();
		cunkPageDiv.find("table tr:last th:first").text("支付宝账号：");
		cunkPageDiv.find(".zysx p:eq(2)").hide();
		cunkPageDiv.find(".zysx p:last").text("3.平台收款支付宝账号“不定时”更换，请每次转账前在本页面查看支付宝账号。如充值过期账号，损失由客户自行承担。");
		$("#onlineBankUrl").text("登录支付宝");
	} else {
		cunkPageDiv.find("table tr:first").show();
		cunkPageDiv.find("table tr:last th:first").text("银行卡号：");
		cunkPageDiv.find(".zysx p:eq(2)").show();
		cunkPageDiv.find(".zysx p:last").text("4.平台收款卡“不定时”更换，请每次转账前在本页面查看银行账号。如充值过期卡号，损失由客户自行承担。");
		$("#onlineBankUrl").text("登录网银");
	}
}

/**
获取用户银行账户是否绑定
获取密码保护问题是否绑定
获取google认证是否绑定
*/
var isBankUserName = false;
var isTradePassword = false;
var isGoogle = false;
var bindOrder = [];
function userSecurityLevel() {
	$.ajax({
		url: '/ct-data/user/userSecurityLevel',
		type: 'POST',
		dataType: 'json',
		async: false,
		success: function(data, textStatus, xhr) {
			if (data.sign) {
				bindOrder["trapswd"] = {"recharge":data.rechargeTradpswd,"withdraw":data.withdrawTradpswd,"isBind":data.isTradePassword};
				bindOrder["phone"] = {"recharge":data.rechargePhone,"withdraw":data.withdrawPhone,"isBind":data.isPhoneCert};
				bindOrder["ga"] = {"recharge":data.rechargeGa,"withdraw":data.withdrawGa,"isBind":data.isGoogle};
				bindOrder["bank"] = {"recharge":data.rechargeBank,"withdraw":data.withdrawBank};
				bindOrder["email"] = {"recharge":data.rechargeEmail,"withdraw":data.withdrawEmail,"isBind":data.isEmailCert};
				bindOrder["question"] = {"recharge":data.rechargeQuestion,"withdraw":data.withdrawQuestion,"isBind":data.isQuestion};
				
				if (data.isBankUserName) {
					isBankUserName = true;
				}
				if (data.isGoogle) {
					isGoogle = true;
				}
				if (data.isTradePassword) {
					isTradePassword = true;
				}
			} else {
				popTips(data.message, "error");
			}
		},
		error: function(xhr, textStatus, errorThrown) {}
	});
}

//切换操作：充值、提款等
var initIndex;
function init(actionCode) {
	clearTimeout(initIndex);
	if (!user) {
		initIndex = setTimeout(function() {
			init(actionCode);
		}, 100);
		return;
	}
	
	$("div.mem-Recharge div.mem-re-main > div").hide();
	if (actionCode == 'cunk' || actionCode == "quk") {
		if(bindOrder["trapswd"]==undefined || bindOrder["trapswd"]==null) {
			$("#noBankTipsPage").html("获取安全信息失败，请刷新页面再次获取！");
			$("#noBankTipsPage").show();
			return false;
		}
		if(actionCode == "cunk") {
			if(bindOrder["trapswd"].recharge=="true" && bindOrder["trapswd"].isBind!=true){
				$("#noBankTipsPage").html('请先设置提款密码！前往<a href="memberHome.html" class="dred">个人中心</a>设置');
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["phone"].recharge=="true" && bindOrder["phone"].isBind!=true){
				$("#noBankTipsPage").html('请先绑定手机！前往<a href="memberHome.html" class="dred">个人中心</a>绑定');
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["ga"].recharge=="true" && bindOrder["ga"].isBind!=true){
				$("#noBankTipsPage").html('请先绑定谷歌验证！前往<a href="memberHome.html" class="dred">个人中心</a>绑定');
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["bank"].recharge=="true" && !haveUserBank()){
				$("#noBankTipsPage").html('请先添加银行卡！前往<a href="memberHome.html" class="dred">个人中心</a>添加');
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["email"].recharge=="true" && bindOrder["email"].isBind!=true){
				$("#noBankTipsPage").html('请先绑定邮箱！前往<a href="memberHome.html" class="dred">个人中心</a>绑定');
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["question"].recharge=="true" && bindOrder["question"].isBind!=true){
				$("#noBankTipsPage").html('请先绑定密保问题！前往<a href="memberHome.html" class="dred">个人中心</a>绑定');
				$("#noBankTipsPage").show();
				return false;
			}
		}
		if(actionCode == "quk") {
			if(isWithdrawFreeze() == false){
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["trapswd"].withdraw=="true" && bindOrder["trapswd"].isBind!=true){
				$("#noBankTipsPage").html('请先设置提款密码！前往<a href="memberHome.html" class="dred">个人中心</a>设置');
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["phone"].withdraw=="true" && bindOrder["phone"].isBind!=true){
				$("#noBankTipsPage").html('请先绑定手机！前往<a href="memberHome.html" class="dred">个人中心</a>绑定');
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["ga"].withdraw=="true" && bindOrder["ga"].isBind!=true){
				$("#noBankTipsPage").html('请先绑定谷歌验证！前往<a href="memberHome.html" class="dred">个人中心</a>绑定');
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["bank"].withdraw=="true" && !haveUserBank()){
				$("#noBankTipsPage").html('请先添加银行卡！前往<a href="memberHome.html" class="dred">个人中心</a>添加');
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["email"].withdraw=="true" && bindOrder["email"].isBind!=true){
				$("#noBankTipsPage").html('请先绑定邮箱！前往<a href="memberHome.html" class="dred">个人中心</a>绑定');
				$("#noBankTipsPage").show();
				return false;
			}
			if(bindOrder["question"].withdraw=="true" && bindOrder["question"].isBind!=true){
				$("#noBankTipsPage").html('请先绑定密保问题！前往<a href="memberHome.html" class="dred">个人中心</a>绑定');
				$("#noBankTipsPage").show();
				return false;
			}
		}
	}

	if (actionCode == "cunk") {
		copyData("copySpan0");
		copyData("copySpan1");
		copyData("copySpan2");
		copyData("copySpan3");
		
		getRechangeTypeList();
		
		$("div.mem-Recharge div.mem-re-main > div").eq(0).show();
	} else if (actionCode == "quk") {
		// 是否有分红账户
		var canBeOpen = false;
		if (user.dividendState == 1) {
			canBeOpen = true;
		}

		if (!canBeOpen && user.roles && user.roles.length > 0) {
			if ($.inArray("ROLE_U_KLCDIVIDEND", user.roles) >= 0 || $.inArray("ROLE_U_BACCARATDIVIDEND", user.roles) >= 0 || $.inArray("ROLE_U_SPORTDIVIDEND", user.roles) >= 0) {
				canBeOpen = true;
			}
		}
		if(!canBeOpen) {
			$("#qukPage div.fenhong li").each(function(){
				if($(this).attr("acttype") == '3') {
					$(this).remove();
					return false;
				}
			});
		}
		
		if (!isTradePassword) {
			$("#qukPasswordDiv li").eq(0).hide();
			$("#qukPasswordDiv li").eq(1).show();
		}

		if (!isGoogle) {
			$("#qukGooglePwdDiv li").eq(0).hide();
			$("#qukGooglePwdDiv li").eq(1).show();
		}
		
		getUserWithdrawLimit();
		getUserBankCardList();
		$("div.mem-Recharge div.mem-re-main > div").eq(1).show();
	} else if(actionCode == "zhuanz") {
		$("div.mem-Recharge div.mem-re-main > div").eq(2).show();
	}
}

/**
 * 获取支付方式
 */
function getRechangeTypeList() {
	if(rechangeType.length > 0) {
		return;
	}
	rechangeType = [];
	
	getBankCardList();
	thirdPartyPaymentList();
}

function addRechangeTypeHtml() {
	$("#cunkPage div.m-c-hd ul.tabHd").empty();
	
	var html = '';
	$.each(rechangeType, function(idx, val) {
		html += '<li id="'+val.id+'" serviceName="'+val.name
			+'" code="'+val.code+'"><i></i>'+val.name+'</li>';
	});
	$("#cunkPage div.m-c-hd ul.tabHd").append(html);
	
	$("#cunkPage ul.tabHd li:first").click();
}

/**
 * 是否限制提款
 * @returns {Boolean}
 */
function isWithdrawFreeze() {
	var isWithdraw = false;
	$.ajax({
		type: "post",
		url: "/ct-data/userAccount/isWithdrawFreeze",
		datatype: "json",
		async: false,
		success: function(msg) {
			if (msg.sign === false) {
				$("#noBankTipsPage").text(msg.message);
			} else {
				isWithdraw = true;
			}
		},
		error: function() {
			$("#noBankTipsPage").text("获取提款信息失败！");
		}
	});
	return isWithdraw;
}

function haveUserBank() {
	var haveBank = false;
	$.ajax({
		url: '/ct-data/userBank/userBankList',
		type: 'POST',
		dataType: 'json',
		async: false,
		success: function(data, textStatus, xhr) {
			$("#noBankTipsPage").text("");
			if (data.sign) {
				$.each(data.data, function(index, val) {
					if (val.state == 1) {
						haveBank = true;
						return false;
					}
				});

				if (data.data.length < 1) {
					$("#noBankTipsPage").text("请先绑定银行卡！");
				}
				if (!haveBank && data.data.length > 0) {
					$("#noBankTipsPage").text("银行卡不可用！");
				}
			} else {
				$("#noBankTipsPage").text(data.message);
			}
		},
		error: function(xhr, textStatus, errorThrown) {
			$("#noBankTipsPage").text("获取银行卡信息失败！");
		},
		complete : function(XMLHttpRequest,status){
			if(status=='timeout'){//超时,status还有success,error等值的情况
				$("#noBankTipsPage").text("获取银行卡信息超时！");
			}
		}
	});

	return haveBank;
}

/**
 * 获取平台
 */
function openPlatformList() {
	$.ajax({
		url: '/ct-data/baccarat/platformList',
		type: 'POST',
		dataType: 'json',
		data: {"isHaveMoney": true},
		success: function(data, textStatus, xhr) {
			if (data.sign) {
				$.each(data.list, function(index, val) {
					if (val.isOpenSys) {
						if (val.isOpen) {
							// 已开通平台
							allOpenPlatform[val.code] = val.value;
							$("#"+val.value).text("￥"+parseFloat(val.balance).toFixed(2)+"元");
						} else {
							$("#"+val.value).text("未开通");
						}
					} else {
						$("#"+val.value).text("系统未开通");
					}
					allPlatform[val.code] = val.value;
				});
			}
			// 初始化转账账户选择
			initTransfePlatformList();
		},
		error: function(xhr, textStatus, errorThrown) {}
	});
}

function initTransfePlatformList() {
	var outHtml = '';
	$.each(allOpenPlatform, function(k, v) {
		if (k == outPlatformCode) {
			outHtml = '<option value="' + k + '">' + v + '</option>' + outHtml;
		} else {
			outHtml += '<option value="' + k + '">' + v + '</option>';
		}
	});

	$("#Eslct0 select").html(outHtml);
	transfePlatformOutChange();
	transfePlatformInChange();
}
//当前转出账户选项改变时触发
function transfePlatformOutChange() {
	var transfersFromCode = $("#Eslct0 select").val();
	outPlatformCode = transfersFromCode;

	var inHtml = '';
	$.each(allOpenPlatform, function(k, v) {
		if (k != transfersFromCode) {
			if (k == transfersToCode) {
				inHtml = '<option value="' + k + '">' + v + '</option>' + inHtml;
			} else {
				inHtml += '<option value="' + k + '">' + v + '</option>';
			}
		}
	});
	$("#Eslct1 select").html(inHtml);
}
//当前转入账户选项改变时触发
function transfePlatformInChange() {
	transfersToCode = $("#Eslct1 select").val();

	var outHtml = '';
	$.each(allOpenPlatform, function(k, v) {
		if (k != transfersToCode) {
			if (k == outPlatformCode) {
				outHtml = '<option value="' + k + '">' + v + '</option>' + outHtml;
			} else {
				outHtml += '<option value="' + k + '">' + v + '</option>';
			}
		}
	});

	$("#Eslct0 select").html(outHtml);
}

/**
 * 转账
 */
function transfersMoney(e) {
	var transfersFrom = $("#Eslct0 select").val();
	var transfersTo = $("#Eslct1 select").val();

	if(!transfersFrom) {
		popTips("请选择转出账户", "waring");
		return;
	}
	
	if(!transfersTo) {
		popTips("请选择转入账户", "waring");
		return;
	}

	if (transfersFrom == transfersTo) {
		popTips("请选择不同的账户", "waring");
		return;
	}

	var money = $("#transfersMoney").val();
	if (!money) {
		popTips("请输入转账金额", "waring");
		return;
	}
	
	$(e.target).removeAttr('onclick');
	
	$.ajax({
		url: '/ct-data/userAccount/transfer',
		type: 'POST',
		dataType: 'json',
		data: {
			"incomeCode": transfersTo,
			"outCode": transfersFrom,
			"money": money
		},
		success: function(data, textStatus, xhr) {
			if (data.sign) {
				dsFlushBalance();
				isUserWithdrawLimit();
				openPlatformList();
				popTips(data.message, "succeed");
			} else {
				popTips(data.message, "error");
			}
		},
		error: function(xhr, textStatus, errorThrown) {
			popTips("转账失败", "error");
		},
		complete: function() {
			$(e.target).attr('onclick', "transfersMoney(event);");
		}
	});
}

/**
 * 复制
 * @param buttonId
 */
function copyData(buttonId) {
	var clip = new ZeroClipboard(document.getElementById(buttonId));
	clip.on("aftercopy", function(e) {
		popTips("复制成功", "succeed");
	});
	/*clip.on("error", function(e) {
		var message = "复制失败！";
		if(e.name === "flash-disabled") {
			message += "Flash被禁用或未安装！";
		} else if(e.name === "flash-outdated") {
			message += "Flash版本过低！";
		} else if(e.name === "flash-unavailable") {
			message += "无法与JS交互！";
		} else if(e.name === "flash-deactivated") {
			message += "Flash未激活！";
		} else if(e.name === "flash-overdue") {
			message += "加载Flash SWF超时！";
		}
		popTips(message, "error");
	});*/
}

/**
 * 支付方式列表
 */
function thirdPartyPaymentList() {
	$.ajax({
		type: "post",
		url: "/ct-data/thirdPartyPayment/thirdPartyPaymentList",
		datatype: "json",
		success: function(msg) {
			if (msg.sign === true) {
				var i = 1;
				$.each(msg.list, function(idx, val) {
					var third = {}
					third.id = val.id;
					third.code = val.type;
					third.minMoney = val.minMoney;
					third.maxMoney = val.maxMoney;
					
					if(val.titleName) {
						third.name = val.titleName;
					} else if (val.type == 'jubaoyun') {
						third.name = '快捷支付';
					} else {
						third.name = '在线充值' + i;
						i++;
					}
					
					getThirdTypeList(val.type, rechangeType.push(third) - 1);
				});
			}
		}
	});
}

/**
 * 获取系统银行卡列表
 */
function getBankCardList() {
	var onlineBank = {};
	onlineBank.id = "onlineBank";
	onlineBank.code = "onlineBank";
	onlineBank.name = "网银充值";
	onlineBank.list = [];

	$.ajax({
		type: "post",
		url: "/ct-data/bank/getBankCardList",
		datatype: "json",
		success: function(msg) {
			if (msg.sign === true) {
				if (msg.list) {
					$.each(msg.list, function(idx, val) {
						var bank = {};
						bank.id = val.id;
						bank.showName = val.showName;
						bank.shortName = val.shortName;
						bank.images = val.images;
						bank.minMoney = val.minMoney;
						bank.maxMoney = val.maxMoney;
						onlineBank.list.push(bank);
					});
					
					if(msg.list && msg.list.length==1 && msg.list[0].bankCode=="90000") {
						onlyAlipay = true;
						onlineBank.name = "支付宝充值";
					}
				}
			}
		},
		complete : function() {
			rechangeType.push(onlineBank);
			addRechangeTypeHtml();
		}
	});
}

/**
 * 第三方银行卡列表
 */
function getThirdTypeList(thirdPartyCode, index) {
	rechangeType[index].list = [];

	$.ajax({
		type: "post",
		url: "/ct-data/bank/getThirdTypeList",
		datatype: "json",
		data:{"thirdPartyCode":thirdPartyCode},
		success: function(msg) {
			if (msg.sign === true) {
				$.each(msg.list, function(idx, val) {
					var bank = {};
					bank.bankCode = val.bankCode;
					bank.bankLogo = val.bankLogo;
					bank.bankName = val.bankName;
					rechangeType[index].list.push(bank);
				});
				
				/*if(msg.list && msg.list.length==1 && (msg.list[0].bankCode=="90000" || msg.list[0].bankCode=="99999")) {
					rechangeType[index].name = "支付宝";
				}
				if(msg.list && msg.list.length==1 && msg.list[0].bankCode=="90001") {
					rechangeType[index].name = "财付通";
				}
				if(msg.list && msg.list.length==1 && msg.list[0].bankCode=="90002") {
					rechangeType[index].name = "微信支付";
				}*/
				
				addRechangeTypeHtml();
			}
		}
	});
}

/**
 * 充值
 */
function recharge(e) {
	var rechargeListener = $(e.target);
	rechargeListener.attr("onclick", "");
	var chargeTypeId = $("#cunkPage .tabHd li.cur").attr("id");
	var thirdTypeCode = $("#cunkPage .tabHd li.cur").attr("code");
	var vMoney = $("way-data=['recharge.amount']");
	var cardNum = '';
	var cardPass = '';
	
	if (thirdTypeCode == "Eypalcard" || thirdTypeCode == "Qiancard") {
		cardNum = $("way-data=['recharge.cardNum']");
		cardPass = $("way-data=['recharge.cardPass']");
		
		if (!vMoney) {
			popTips("请输入金额", "waring");
			rechargeListener.attr("onclick", "recharge(event);");
			return;
		}
		if(!cardNum) {
			popTips("请输入卡号", "waring");
			rechargeListener.attr("onclick", "recharge(event);");
			return;
		}
		if(!cardPass) {
			popTips("请输入卡密码", "waring");
			rechargeListener.attr("onclick", "recharge(event);");
			return;
		}
	} else {
		var depositLimit = $("#depositLimit").text().split("-");
		var mixMoney = parseInt(depositLimit[0]);
		var maxMoney = parseInt(depositLimit[1]);
		
		if (!vMoney || vMoney<mixMoney || vMoney>maxMoney) {
			popTips("充值金额必须在" + $("#depositLimit").text() + "元之间", "waring");
			rechargeListener.attr("onclick", "recharge(event);");
			return;
		}
	}

	if (chargeTypeId == "onlineBank") {
		var vId = $("#cunkPage .c-t-hzyh ul li.cur").attr("bankid");
		if(!vId) {
			popTips("请选择支付方式", "waring");
			rechargeListener.attr("onclick", "recharge(event);");
			return;
		}
		
		// 网银充值
		$.ajax({
			type: "post",
			url: "/ct-data/userAccount/showDetail",
			data: {
				"id": vId,
				"money": vMoney
			},
			dataType: "json",
			success: function(msg) {
				if (msg.sign === true) {
					way.set("onlineRecharge.shortName", msg.shortName);
					$("#sp_recharge_money").text(msg.d_money);
					$("#sp_bankUserName").text(msg.bankUserName);
					$("#sp_bankCardNumber").text(msg.bankCardNumber);
					$("#sp_postscript").text(msg.postscript);

					$("#cunkPage div.me-infor img").attr("src", "../../resources/txh/images/member/hezyh/" + msg.bankLogo);
					$("#cunkPage div.me-infor img").attr("alt", msg.shortName);

					$("#cunkPage div.me-deposit li").removeClass("cur");
					$("#cunkPage div.me-deposit li").eq(1).addClass("cur");

					$("#onlineBankUrl").attr("href", msg.bankUrl);

					$("#cunkPage div.c-bz-c-one").hide();
					$("#cunkPage div.me-infor").eq(1).show();
					way.set("recharge.amount", "");
				} else {
					popTips(msg.message, 'error');
				}
			},
			error: function() {},
			complete: function() {
				rechargeListener.attr("onclick", "recharge(event);");
			}
		});
	} else {
		// 在线充值
		var vCode = $("#cunkPage div.c-t-hzyh li.cur").attr("bankCode");
		var vName = $("#cunkPage div.c-t-hzyh li.cur img").attr("alt");
		if (!vCode) {
			vCode = '888';
		}
		if (!vName) {
			vName = '888';
		}
		var isWindowOpen = false;
		$.ajax({
			type: "post",
			url: "/ct-data/thirdPartyPayment/pretreatment",
			data: {
				"amount": vMoney,
				"thirdPartyId": chargeTypeId,
				"bankCode": vCode,
				"bankName": vName,
				"cardNum": cardNum,
				"cardPass": cardPass
			},
			dataType: "json",
			async: false,
			success: function(msg) {
				if (msg.sign === true) {
					way.set("bill.amount", msg.amount);
					way.set("bill.billNo", msg.billNo);

					$("#cunkPage div.c-bz-c-one").hide();
					$("#cunkPage div.me-infor").eq(0).show();

					$("#tppInput0").val(msg.promptInfo);
					$("#tppInput1").val(msg.param);
					$("#tppInput2").val(msg.key);
					$("#tppForm0").attr('action', msg.paymdomain);
					$('#tppForm0').submit();
					$("#cunkLoginOnlineBank").attr("onclick", "$('#tppForm0').submit();");

					way.set("recharge.amount", "");
					way.set("recharge.cardNum", "");
					way.set("recharge.cardPass", "");
					isWindowOpen = true;
				} else {
					popTips(msg.message, 'error');
				}
			},
			error: function() {},
			complete: function() {

				if (isWindowOpen === true) {
					$("#tppForm0").submit();
				}
				rechargeListener.attr("onclick", "recharge(event);");
			}
		});

	}
}

/**
 * 锚点跳转到页面
 */
function transferThenReload(financeCode) {
	window.location.href = currentRootDirectory + '/view/game/memberOrderform.html?code=' + financeCode;
}

/**
 * 提款限制信息
 * @returns
 */
function getUserWithdrawLimit() {
	$.ajax({
		type: "post",
		url: "/ct-data/userAccount/isUserWithdrawLimit",
		datatype: "json",
		success: function(msg) {
			var freetimes = parseInt(msg.freetimes) - parseInt(msg.opTimes);
			if (freetimes < 0) {
				freetimes = 0;
			}
			if(msg.sign) {
				way.set('users.account.withdraw', way.get('useraccount.balance'));
				$("#quk_explain_balance").text(way.get('useraccount.balance'));
			} else {
				way.set('users.account.withdraw', '0');
				$("#quk_explain_balance").text("0");
			}
			$("#quk_explain_freetimes").text(freetimes);
			$("#quk_explain_lottery").text(msg.lottery ? msg.lottery.needMoney : 0);
			$("#quk_explain_klc").text(msg.klc ? msg.klc.needMoney : 0);
			$("#quk_explain_bjl").text(msg.bjl ? msg.bjl.needMoney : 0);
			$("#quk_explain_minMoney").text(msg.minMoney ? msg.minMoney : 0);
			$("#quk_explain_maxMoney").text(msg.maxMoney ? msg.maxMoney : 0);
			$("#quk_explain_daymaxMoney").text(msg.daymaxMoney ? msg.daymaxMoney : 0);
			$("#quk_explain_feescale").text(msg.feescale ? msg.feescale : 0);
			$("#quk_explain_minfee").text(msg.minfee ? msg.minfee : 0);
			$("#quk_explain_maxfee").text(msg.maxfee ? msg.maxfee : 0);
			if(msg.starTime && msg.endTime) {
				$("#quk_explain_time").text(msg.starTime + " - " + msg.endTime);
			}
		}
	});
}

/**
 * 得到用户银行卡列表
 */
function getUserBankCardList() {
	var thisPanel = $("#qukPage div.back-choose ul");
	thisPanel.empty();

	$.ajax({
		type: "post",
		url: "/ct-data/userBank/userBankList",
		datatype: "json",
		success: function(msg) {
			if (msg.sign === true) {
				var html = "";
				var innerHtml = '';
				$.each(msg.data, function(idx, val) {
					if (val.state == 1) {
						var bankCardNumber = val.bankCardNumber;
						bankCardNumber = bankCardNumber.replace("******", "***");
						innerHtml = '<li bankid="' + val.id + '">';
						innerHtml += '<img src="../../resources/txh/images/member/yh/' + val.bankLogo + '" alt="' + val.bankName + '" width="28" height="28">';
						innerHtml += '<span>' + val.bankName + '</span>';
						innerHtml += '<span>' + bankCardNumber + '</span><i></i>';
						innerHtml += '</li>';
					}

					if (val.isDefault == 1) {
						html = innerHtml + html;
					} else {
						html += innerHtml;
					}
				});
				html += '<li bankid="1" style="display:none;"><img src="../../resources/txh/images/index/index-logo.gif" alt="" width="58" height="28"><span>&nbsp;&nbsp;&nbsp;</span><span>天下汇主账户</span><i></i></li>';
				thisPanel.html(html);
				thisPanel.children().eq(0).addClass("cur");
			}
		}
	});
}

/**
 * 提款
 * @returns
 */
function  toApplyForWithdraw(e) {
	var actType = $("#qukPage div.fenhong ul li.cur").attr("acttype");
	var card = $("#qukPage div.back-choose ul li.cur").attr("bankid");
	
	if(actType == "1") {
		var qukExplain = parseInt($("#quk_explain_balance").text());
		if(qukExplain == 0) {
			popTips("余额不足，或用户消费量未满足，不可以提款", "error");
			return;
		}
		if(card == "1") {
			card = null;
		}
	} else {
		var qukExplain = parseInt($("#quk_explain_dividend").text());
		if(qukExplain == 0) {
			popTips("余额不足，不可以提款", "error");
			return;
		}
	}
	
	if (!card) {
		popTips("请选择银行卡", "error");
		return;
	}
	var money = parseInt($("#quk_withdraw_money").val());
	if (!money) {
		popTips("请输入提款金额", "error");
		return;
	}
	var minMoney = parseInt($("#quk_explain_minMoney").text());
	var maxMoney = parseInt($("#quk_explain_maxMoney").text());
	if (money < minMoney || money > maxMoney) {
		popTips("提款金额必须在" + minMoney + "-" + maxMoney + "元之间", "error");
		return;
	}

	var pwdType = $("#quk_authType li.cur").index();
	var pwd;
	if (pwdType == 0) {
		pwd = $("#quk_withdraw_pwd").val();
	} else {
		pwd = $("#quk_withdraw_googlepwd").val();
	}

	if (!pwd) {
		popTips("请输入提款密码", "error");
		return;
	}

	$(e.target).removeAttr("onclick");
	$.ajax({
		type: "post",
		url: "/ct-data/userAccount/toApplyForWithdraw",
		datatype: "json",
		data: {
			"actType": actType,
			"card": card,
			"money": money,
			"pwd": pwd,
			"pwdType": pwdType
		},
		success: function(msg) {
			if (msg.sign === true) {
				getUserWithdrawLimit();
				dsFlushBalance();
				isUserWithdrawLimit();
				$("#qukPage div.back-choose ul li").removeClass("cur");
				$("#quk_withdraw_money").val("");
				$("#quk_fee").val("0.0000");
				$("#quk_ramount").val("0.0000");
				$("#qukPage #quk_withdraw_pwd").val("");
				$("#qukPage #quk_withdraw_googlepwd").val("");
				popTips(msg.message, "succeed");
			} else {
				$("#qukPage #quk_withdraw_pwd").val("");
				$("#qukPage #quk_withdraw_googlepwd").val("");
				popTips(msg.message, "error");
			}
		},
		error: function(){
			popTips("服务器连接失败", "error");
		},
		complete: function() {
			$(e.target).attr("onclick", "toApplyForWithdraw(event);");
		}
	});
}

/**
 * 计算手续费
 * @returns
 */
function verificationMoney() {
	var money = $("#quk_withdraw_money").val();
	money = eval(money.replace(/[^\d]/g, ''));
	$("#quk_withdraw_money").val(money);
	if (parseInt($("#quk_explain_freetimes").text()) > 0) {
		$("#quk_fee").val('0.0000');
		if (!money) {
			money = 0;
		}
		$("#quk_ramount").val(money.toFixed(4));
	} else {
		var minfee = eval($("#quk_explain_minfee").text());
		if(!minfee) {
			minfee = 0;
		}
		var fee = parseFloat(money) * parseFloat($("#quk_explain_feescale").text() / 100);
		if (!fee) {
			fee = minfee;
		} else if (fee < minfee) {
			fee = minfee;
		} else if (fee > 25) {
			fee = 25;
		}
		fee = Math.floor(fee).toFixed(4);
		$("#quk_fee").val(fee);
		$("#quk_ramount").val((money - fee).toFixed(4));
	}
}

//获取用户的返水返点
function userRebate() {
	jQuery.ajax({
		url: '/ct-data/user/userRebate',
		type: 'POST',
		dataType: 'json',
		success: function(data, textStatus, xhr) {
			if (data.sign) {
				way.set("user.rabate", (data.rebate * 100).toFixed(1));
				way.set("user.baccaratRebate", (data.baccaratRebate * 100).toFixed(2));
				way.set("user.peopleBackWater", (data.peopleBackWater * 100).toFixed(2));
				way.set("user.slotBackWater", (data.slotBackWater * 100).toFixed(2));
				way.set("user.sportBackWater", (data.sportBackWater * 100).toFixed(2));
				way.set("user.kenoRebate", (data.kenoRebate * 100).toFixed(1));
			} else {
				popTips(data.message, "error");
			}
		},
		error: function(xhr, textStatus, errorThrown) {

		}
	});
}