$(function(){
	$.init();
	//nologinredict();
	//$('.infinite-scroll-preloader').hide();
	$(".date-input-picker").calendar();
	initIndexLottery();
	getDownUserNum();//团队人数等
});
var jqueryGridPage = 1;
var jqueryGridRows = 10;
/**
 * 初始化代理首页彩票娱乐
 */
function initIndexLottery() {
	var startDate = $("#indexStartDate").val();
	var endDate = $("#indexEndDate").val();

	var url = apirooturl + 'reportstatistics';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		data: {
			"startime": startDate,
			"endtime": endDate
		},
		success: function(data) {
			if (data.sign === true) {
				/*
				var html = '<dd><span>充值量</span><b>' + data.data.transferIn + '</b></dd>';
				html += '<dd><span>提现量</span><b>' + data.data.transferOut + '</b></dd>';
				html += '<dd><span>代购量</span><b>' + data.data.validAmount + '</b></dd>';
				html += '<dd><span>派奖量</span><b>' + data.data.payoutAmount + '</b></dd>';
				//html += '<dd><span>返点</span><b>' + data.data.dayBackPoint + '</b></dd>';
				html += '<dd><span>活动/反水</span><b>' + data.data.activityAmount + '</b></dd>';
				$("#indexAgent .ctsj dl").html(html);
				*/
				way.set("reportstatistics", data.data);
			} else {
				alt(data.message, -1);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {}
	});
}
/**
 * 获取团队人数
 */
function getDownUserNum() {
	var url = apirooturl + 'downuserports';
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'json',
		success: function(msg) {
			if (msg.sign === true) {
				var downUserNum = {};
				downUserNum.totalnum = msg.data.totalnum;
				downUserNum.proxynum = msg.data.proxynum;
				downUserNum.noproxynum = msg.data.noproxynum;
				downUserNum.totalamount = msg.data.totalamount;
				way.set("downUserNum", downUserNum);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {}
	});
}
/**
 * 添加用户
 */
function addUser() {
	if (!user) {
		alt("用户未登录", -1);
		return false;
	}
	var username = $("#addUser_username").val();
	var rebate = $("#addUser_rebateid").val();
	if (username=='') {
		alt("请输入用户名",-1);
		return false;
	}
	var userType = $('#addUserGeneralAgent').val();
	if (!userType) {
		alt("请选择开户类型",-1);
		return false;
	}
	var userType = userType;
	var url = apirooturl + 'adduser';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		data: {
			"username": username,
			"isProxy": userType,
			"rebate" : rebate
		},
		success: function(data) {
			if (data.sign === true) {
				$("#addUser_username").val('');
				alt(data.message,1);
			} else {
				alt(data.message,-1);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alt("添加用户失败",-1);
		}
	});
}
/**
 * 添加开户链接
 */
function addSignuplink() {
	if (!user) {
		alt("用户未登录",-1);
		return false;
	}
	var userType = $('#addSignuplinkAgent').val();
	if (!userType) {
		alt("请选择开户类型",-1);
		return false;
	}

	var rebate = $("#addlink_rebateid").val();
	var addSignuplinkValid = eval($("#addSignuplinkValid").val());
	var times = $("#addSignuplink_times").val();
	var addSignuplinkTpl = parseInt($("#addSignuplinkTpl").val());
	
	if (!times || parseInt(times) < 1 || parseInt(times) > 100) {
		alt("使用次数只能为正整数1~100之间",-1);
		return false;
	} else {
		times = parseInt(times);
	}


	var url = apirooturl + 'addsignup';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		data: {
			"isproxy": userType,
			"times": times,
			'tpltype':0,
			'rebate' : rebate
		},
		success: function(data) {
			if (data.sign === true) {
				$("#addSignuplink_times").val('');
				alt(data.message,1);
			} else {
				alt(data.message,-1);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alt("添加链接失败",-1);
		}
	});
}

/**
 * 链接列表
 */
function signuplinkList() {
	var thisPanel = $("#signuplinkList");
	var htmlTitle = '<tr><th>用户类型</th><th>总次数</th>' +
		'<th>使用次数</th><th>使用模版</th><th>创建时间</th><th>操作</th></tr>';
	thisPanel.empty();
	$("#signuplinkList .paging").empty();
	//thisPanel.append(htmlTitle);

	var jqueryGridPage = 1;
	var jqueryGridRows = 10;
	var url = apirooturl + 'signuplinklist';
	var pagination = $.pagination({
		render: '#signuplinkList_page',
		pageSize: jqueryGridRows,
		pageLength: 7,
		ajaxType: 'post',
		hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			"jqueryGridPage": jqueryGridPage,
			"jqueryGridRows": jqueryGridRows
		},
		complete: function() {},
		success: function(data) {
			thisPanel.empty();
			//thisPanel.append(htmlTitle);
			var registerUrl = host + '/Public.register.linkid.';
			$.each(data, function(idx, val) {
				var html = '';
				html += '<li>';
				html += '<div class="item-inner item-content">';
				html += '<div class="item-title-row">';
				html += '<div class="item-title">' + (val.proxy==1 ? '代理' : '普通用户') + '</div>';
				if ((eval(val.usenum) - eval(val.okusenum)) <= 0) {
					html += '<div class="item-after"><t>已失效</t></div>';
				} else {
					html += '<div class="item-after"><t style="color:red" onclick="viewlink(\'' + registerUrl + val.id + '\')">查看</t></div>';
				}
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '使用次数' + val.usenum + ',已使用:' + val.okusenum + '';
				html += '</div>';
				html += '</div>';
				html += '</li>';
				thisPanel.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {
			$('#signuplinkList .paging').empty();
		}
	});
	pagination.init();
}
function viewlink(linkurl){
      $.modal({
            text:'<textarea style="width:100%;" readonly>'+linkurl+'</textarea>',
            buttons: [ 
				{text: '关闭'}
			]
        });
}
/**
 * 会员管理 - 会员列表
 */
function allUserList(isonline) {
	if(isonline){
		var thisPanel = $("#allOnlineUserList");
	}else{
		var thisPanel = $(".allUserList");
	}
	if(isonline){
		$('#allOnlineUserList_paging').empty();
	}else{
		$('#allUserList_paging').empty();
	}
	thisPanel.empty();
	//thisPanel.append(htmlTitle);
	
	
	

	if(isonline){
		isonline = 1;
		var startTime = $("#userOnlineSearchStartTime").val();
		var endTime = $("#userOnlineSearchEndTime").val();
		var loginname = $("#userOnlineSearchLoginname").val();
		var minMoney = $("#userOnlineSearchMinMoney").val();
		var maxMoney = $("#userOnlineSearchMaxMoney").val();
	}else{
		var startTime = $("#userSearchStartTime").val();
		var endTime = $("#userSearchEndTime").val();
		var loginname = $("#userSearchLoginname").val();
		var minMoney = $("#userSearchMinMoney").val();
		var maxMoney = $("#userSearchMaxMoney").val();
	}

	var jqueryGridPage = 1;
	var jqueryGridRows = 10;

	var url = apirooturl + 'memberList';
	var pagination = $.pagination({
		render: isonline?'#allOnlineUserList_paging':'#allUserList_paging',
		pageSize: jqueryGridRows,
		pageLength: 3,
		ajaxType: 'post',
		hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			"jqueryGridPage": jqueryGridPage,
			"jqueryGridRows": jqueryGridRows,
			"startime": startTime,
			"endtime": endTime,
			"loginname": loginname,
			"minMoney": minMoney,
			"maxMoney": maxMoney,
			"isonline": isonline
		},
		complete: function() {
			
		},
		success: function(data, pid, downRechargeLevel) {

			
			thisPanel.empty();
			
			$.each(data, function(idx, val) {
				var html = '';
				if(val.isonline=='1'){
					val.isonline = '<span style="color:green">在线</span>';
				}else{
					val.isonline = '<span style="color:grey">离线</span>';
				}
				html += '<li>';
				html += '<div class="item-inner item-content">';
				html += '<div class="item-title-row">';
				// + '('+val.userbankname+',qq:' + val.qq + ')
				html += '<div class="item-title">用户名:' + val.username+'</div>';
				html += '<div class="item-after"><t>' + val.isonline + '</t></div>';
				html += '</div>';
				html += '<div class="item-subtitle">';
				// +',洗码:' + (val.xima ? val.xima : '0')
				// + ',积分'+(val.point ? val.point : '0')
				html += '余额:'+val.balance;
				html += '</div>';
				html += '<div class="item-subtitle">';
				if(val.regtime==0){
					regtime = '~~';
				}else{
					regtime = val.regtime;
				}
				html += '注册时间:' + regtime ;
				html += '</div>';
				html += '</div>';
				html += '</li>';

				thisPanel.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
/**
 * 游戏纪录
 */
function allDownUserBetsList() {
	var thisPanel = $("#downUserBetsList");
	var htmlTitle = '<tr><th>订单号</th><th>用户名</th><th>彩票简称</th><th>期号</th><th>玩法名称</th><th>赔率</th><th>下单时间</th>' +
		'<th>金额</th><th>注数</th><th>中金额</th><th>中注数</th><th>状态</th></tr>';
	thisPanel.empty();
	$('#allDownUserBetsList_paging').empty();
	
	var jqueryGridPage = 1;
	var jqueryGridRows = 10;

	var billno = $("#downUserBetsSearchBillno").val();
	var expect = $("#downUserBetsSearchExpect").val();
	var startTime = $("#downUserBetsSearchStartTime").val();
	var endTime = $("#downUserBetsSearchEndTime").val();
    if (dateDiff(startTime, endTime) > 30) {
        alt('查询日期间隔不能超过30天',-1);
        return false;
    } else if (dateDiff(startTime, endTime) < 0) {
        alt('查询结束日期要大于开始日期',-1);
        return false;
    }
	var loginname = $("#downUserBetsSearchLoginname").val();
	var shortName = $("#downUserBetsSearchShortName").val();
	var state = $("#downUserBetsSearchState").val();

	var url = apirooturl + 'downuserbetslist';
	way.set("allDownUserBetsList.k3hzbig",0);
	way.set("allDownUserBetsList.k3hzsmall",0);
	way.set("allDownUserBetsList.k3hzodd",0);
	way.set("allDownUserBetsList.k3hzeven",0);
	var pagination = $.pagination({
		render: '#allDownUserBetsList_paging',
		pageSize: jqueryGridRows,
		pageLength: 3,
		ajaxType: 'post',
		hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			"jqueryGridPage": jqueryGridPage,
			"jqueryGridRows": jqueryGridRows,
			"trano": billno,
			"expect": expect,
			"startime": startTime,
			"endtime": endTime,
			"loginname": loginname,
			"lotteryname": shortName,
			"state": state
		},
		complete: function() {},
		success: function(data,sucdata) {
			thisPanel.empty();
			if(sucdata){
				way.set("allDownUserBetsList.k3hzbig",sucdata.bigamount?sucdata.bigamount:0);
				way.set("allDownUserBetsList.k3hzsmall",sucdata.smallamount?sucdata.smallamount:0);
				way.set("allDownUserBetsList.k3hzodd",sucdata.oddamount?sucdata.oddamount:0);
				way.set("allDownUserBetsList.k3hzeven",sucdata.evenamount?sucdata.evenamount:0);
			}
			$.each(data, function(index, val) {
				var html = '';
				html += '<li id="'+val.trano+'">';
				html += '<div class="item-inner item-content">';
				html += '<div class="item-title-row">';
				html += '<div class="item-title">'+val.username+'</div>';
				html += '</div>';
				html += '<div class="item-title-row">';
				html += '<div class="item-title">'+val.cptitle+'('+val.expect+'期)</div>';
				if(val.isdraw == -1) { // 未中奖绿色
					html += '<div class="item-after"><t style="color:green">未中奖</t></div>';
				} else if(val.isdraw == 1) { // 已中奖红色
					html += '<div class="item-after"><t style="color:red">已中奖</t></div>';
				}else if(val.isdraw == -2) {
					html += '<div class="item-after"><del>已撤单</del></div>';
				}else if(val.isdraw == 0) {
					html += '<div class="item-after"><t class="state" style="color:red;cursor:pointer;">撤单</t></div>';
				}else{
					html += '<div class="item-after"><t>未知状态</t></div>';
				}
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '玩法:' + val.playtitle + '(' + val.mode + ')';
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '单号:'+val.trano;
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '金额:' + val.amount + ',注数:' + val.itemcount + ',中奖金:' + (val.okamount ? val.okamount : 0) + ',中注数:'+ val.okcount;
				html += '</div>';
				html += '</div>';
				html += '</li>';
				thisPanel.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
function accountChange() {
	var thisPanel = $("#downuserchangelist");
	thisPanel.empty();
	
	var jqueryGridPage = 1;
	var jqueryGridRows = 10;
	var loginname = $("#accountChangeSearchLoginname").val();
	var starTime = $("#accountChangeStartTime").val();
	var endTime = $("#accountChangeEndTime").val();
    if (dateDiff(starTime, endTime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    } else if (dateDiff(starTime, endTime) < 0) {
        alt('查询结束日期要大于开始日期', -1);
        return false;
    }
	var sourceModule = $("#sourceModule").val();
	var url = apirooturl + 'downuserchangelist';
	var pagination = $.pagination({
		render: '#groupDeposit_paging',
		pageSize: jqueryGridRows,
		pageLength: 3,
		ajaxType: 'post',
		hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			"jqueryGridPage": jqueryGridPage,
			"jqueryGridRows": jqueryGridRows,
			"startime": starTime,
			"endtime": endTime,
			"type": sourceModule,
			"loginname": loginname
		},
		complete: function() {},
		success: function(data) {
			thisPanel.empty();
			$.each(data, function(index, val) {
				var html = '';
				html += '<li>';
				html += '<div class="item-inner item-content">';
				html += '<div class="item-title-row">';
				html +=  val.username;
				html += '<br/><div class="item-title">' + val.typename + '('+val.amount+')</div>';
				html += '<div class="item-after"><t>' + val.oddtime + '</t></div>';
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '单号:'+val.trano +"<br>";
				html += '('+val.remark+')';
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '账变前:' + val.amountbefor + ',账变后:' + val.amountafter ;
				html += '</div>';
				html += '</div>';
				html += '</li>';
				thisPanel.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
function initGroupDepositList() {
	$("#groupDepositStartTime").val(laydate.now());
	$("#groupDepositEndTime").val(laydate.now(1));
	$("#groupDepositSearchLoginname").val("");
	$("#groupDepositSearchBillNo").val("");
}
function groupDeposit() {
	var thisPanel = $("#groupDeposit");
	thisPanel.empty();
	
	var jqueryGridPage = 1;
	var jqueryGridRows = 10;
	var loginname = $("#groupDepositSearchLoginname").val();
	var billNo = $("#groupDepositSearchBillNo").val();
	var starTime = $("#groupDepositStartTime").val();
	var endTime = $("#groupDepositEndTime").val();
	var type = $("#groupDepositType").val();
	var state = $("#groupDepositState").val();
	var url = apirooturl + 'downuserrechargeandwithdrawlist';
	var pagination = $.pagination({
		render: '#groupDeposit_paging',
		pageSize: jqueryGridRows,
		pageLength: 7,
		ajaxType: 'post',
		hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			"jqueryGridPage": jqueryGridPage,
			"jqueryGridRows": jqueryGridRows,
			"startime": starTime,
			"endtime": endTime,
			"loginname": loginname,
			"trano": billNo,
			"type": type,
			"state": state
		},
		complete: function() {},
		success: function(data) {
			thisPanel.empty();
			
			$.each(data, function(index, val) {
				var state = val.state;
				if (state == 0) {
					state = "正在审核";
				}else if(state == 1){
					state = "审核通过";
				}else if(state == -1){
					state = "取消申请";
				}else{
					state = "---";
				}
				var html = '';
				html += '<li>';
				html += '<div class="item-inner item-content">';
				html += '<div class="item-subtitle">';
				html += val.username;
				html += '</div>';
				html += '<div class="item-title-row">';
				html += '<div class="item-title">充值:' + val.amount + ',实到:' + val.actualamount + '</div>';
				html += '<div class="item-after"><t>' + state + '</t></div>';
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '账变前:' + val.oldaccountmoney + ',账变后:' + val.newaccountmoney ;
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '单号:'+val.trano;
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '时间:'+val.oddtime;
				html += '</div>';
				html += '</div>';
				html += '</li>';
				thisPanel.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
function initGroupReportList() {
	$("#groupReportStartTime").val(laydate.now());
	$("#groupReportEndTime").val(laydate.now(1));
	$("#groupReportSearchLoginname").val("");
	$("#accounttype").val("lottery");
}
function groupReport() {
	var loginname = $("#groupReportSearchLoginname").val();
	var starTime = $("#groupReportStartTime").val();
	var endTime = $("#groupReportEndTime").val();
	var accounttype = $("#accounttype").val();
	
	var canBeOpen = false;
	var tabs = $("#downuseraccountreportlist");
	tabs.empty();
	var jqueryGridPage = 1;
	var jqueryGridRows = 10;
	var url = apirooturl + 'downuseraccountreportlist';

	$.ajax({
		type: "post",
		url: url,
		data: {
			"startime": starTime,
			"endtime": endTime,
			"loginname": loginname,
			"accounttype": accounttype
		},
		dataType:'json',
		success: function(data) {
			if(data.sign){
				tabs.empty();
				$.each(data.root, function(index, val) {
					
					var html = '';
					html += '<li>';
					html += '<div class="item-inner item-content">';
					html += '<div class="item-title-row">';
					html += '<div class="item-title">充值:' + val.dayRechargeMoney + ',提款:'+val.dayDrawRechargeMoney+'</div>';
					html += '<div class="item-after"><t>' + val.statDate + '</t></div>';
					html += '</div>';
					html += '<div class="item-subtitle">';
					html += '投注:'+val.dayConsumptionMoney + ',返奖:'+val.dayIncomeMoney+',盈亏:' + val.dayDividendMoney;
					html += '</div>';
					html += '<div class="item-subtitle">';
					//'返点:' + val.dayCommissionMoney +
					html += '活动:' + val.dayActivitiesMoney ;
					html += '</div>';
					html += '</div>';
					html += '</li>';

					tabs.append(html);
				});
				//tabs.append(shtml);
			}else{
				alt(data.message,-1);
			}
		}
	});
}
