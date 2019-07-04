$(function(){
	$.init();
	//nologinredict();
	//$('.infinite-scroll-preloader').hide();
	$(".date-input-picker").calendar();
	userbets();
});
var jqueryGridPage = 1;
var jqueryGridRows = 10;
var userbets=function(){
	$(".paging").html('');
	var tabs = $("#userbetshistorylist");
	var url = apirooturl + 'userbets';
	var trano = $(".userBetssearchbar").find("input.trano").val();
	var startime = $(".userBetssearchbar").find("input.starTime").val();
	var endtime = $(".userBetssearchbar").find("input.endTime").val();
	var lotteryname = $(".userBetssearchbar").find(".lotteryname").val();
	var state = $("#userBets").find(".state").val();
    if (dateDiff(startime, endtime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    }
	tabs.html('');
	$("#userbets_touzhutotal").text('0.00');
	$("#userbets_fanjiangtotal").text('0.00');
	$("#userbets_tzyingkuitotal").text('0.00');
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 4,
		ajaxType: 'post',
		//hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			'jqueryGridPage': jqueryGridPage,
			'jqueryGridRows': jqueryGridRows,
			"lotteryname": lotteryname,
			"trano": trano,
			"startime": startime,
			"endtime": endtime,
			"state": state
		},
		complete: function() {},
		success: function(data,sucdata) {
			tabs.empty();
			if(sucdata){
				$("#userbets_touzhutotal").text(sucdata.touzhutotal?sucdata.touzhutotal:0);
				$("#userbets_fanjiangtotal").text(sucdata.fanjiangtotal?sucdata.fanjiangtotal:0);
				$("#userbets_tzyingkuitotal").text(sucdata.tzyingkuitotal?sucdata.tzyingkuitotal:0);
			}
			$.each(data, function(index, val) {
				var html = '';
				html += '<li id="'+val.trano+'">';
				html += '<div class="item-inner item-content">';
				html += '<div class="item-title-row">';
				html += '<div class="item-title">'+val.cptitle+'('+val.expect+'期)</div>';
				if(val.isdraw == -1) { // 未中奖绿色
					html += '<div class="item-after"><t style="color:green">未中奖</t></div>';
				} else if(val.isdraw == 1) { // 已中奖红色
					html += '<div class="item-after"><t style="color:red">已中奖</t></div>';
				}else if(val.isdraw == -2) {
					html += '<div class="item-after"><del>已撤单</del></div>';
				}else if(val.isdraw == 0) {
					html += '<div class="item-after"><t class="state" onclick="javascript:getBillInfo(\''+val.trano+'\')" style="color:red;cursor:pointer;">撤单</t></div>';
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

				
				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
function userfuddetail(){
	$(".paging").html('');
	var tabs = $("#accountChange");
	var url = apirooturl + 'userfuddetail';
	var trano = $(".userfuddetailsearchbar").find("input.trano").val();
	var startime = $(".userfuddetailsearchbar").find("input.starTime").val();
	var endtime = $(".userfuddetailsearchbar").find("input.endTime").val();
	var type = $("#sourceModule").val();
	var acctype = $("#accModule").val();
    if (dateDiff(startime, endtime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    }
	tabs.empty();
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 4,
		ajaxType: 'post',
		//hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			'jqueryGridPage': jqueryGridPage,
			'jqueryGridRows': jqueryGridRows,
			"trano": trano,
			"startime": startime,
			"endtime": endtime,
			"type": type,
			"acctype": acctype
		},
		complete: function() {},
		success: function(data) {
			tabs.empty();
			$.each(data, function(index, val) {
				var html = '';
				html += '<li>';
				html += '<div class="item-inner item-content">';
				html += '<div class="item-title-row">';
				html += '<div class="item-title">' + val.typename + '('+val.amount+')</div>';
				html += '<div class="item-after"><t>' + val.oddtime + '</t></div>';
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '单号:'+val.trano + '('+val.remark+')';
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '账变前:' + val.amountbefor + ',账变后:' + val.amountafter ;
				html += '</div>';
				html += '</div>';
				html += '</li>';
				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
var rechargelist=function(){
	$(".paging").html('');
	var tabs = $("#saveRecords");
	var htmlTitle = "<tr><th>订单号</th><th>申请金额</th><th>手续费</th><th>实到金额</th><th>变更前金额</th><th>变更后金额</th><th>时间</th><th>状态</th></tr>";
	var url = apirooturl + 'rechargelist';
	var trano = $(".saveRecordssearchbar").find("input.trano").val();
	var startime = $(".saveRecordssearchbar").find("input.starTime").val();
	var endtime = $(".saveRecordssearchbar").find("input.endTime").val();
	var state = $(".saveRecordssearchbar").find(".state").val();
    if (dateDiff(startime, endtime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    }
	tabs.empty();
	//tabs.append(htmlTitle);
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 4,
		ajaxType: 'post',
		//hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			'jqueryGridPage': jqueryGridPage,
			'jqueryGridRows': jqueryGridRows,
			"trano": trano,
			"startime": startime,
			"endtime": endtime,
			"state": state
		},
		complete: function() {},
		success: function(data) {
			tabs.empty();
			$.each(data, function(index, val) {
				var html = '';
				html += '<li>';
				html += '<div class="item-inner item-content">';
				html += '<div class="item-title-row">';
				html += '<div class="item-title">申请金额:' + val.amount + ',手续费:'+val.fee+',实到金额:' + val.actualamount + '</div>';
				html += '<div class="item-after"><t>' + val.state + '</t></div>';
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
				
				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
var withdrawlist=function(){
	$(".paging").html('');
	var tabs = $("#drawRecords");
	var htmlTitle = "<tr><th>订单号</th><th>申请金额</th><th>手续费</th><th>实到金额</th><th>变更前金额</th><th>变更后金额</th><th>时间</th><th>状态</th></tr>";
	var url = apirooturl + 'withdrawlist';
	var trano = $(".withdrawlistsearchbar").find("input.trano").val();
	var startime = $(".withdrawlistsearchbar").find("input.starTime").val();
	var endtime = $(".withdrawlistsearchbar").find("input.endTime").val();
	var state = $(".withdrawlistsearchbar").find(".state").val();
    if (dateDiff(startime, endtime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    }
	tabs.empty();
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 4,
		ajaxType: 'post',
		//hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			'jqueryGridPage': jqueryGridPage,
			'jqueryGridRows': jqueryGridRows,
			"trano": trano,
			"startime": startime,
			"endtime": endtime,
			"state": state
		},
		complete: function() {},
		success: function(data) {
			tabs.empty();
			$.each(data, function(index, val) {
				var html = '';
				html += '<li>';
				html += '<div class="item-inner item-content">';
				html += '<div class="item-title-row">';
				html += '<div class="item-title">提款金额:' + val.amount + ',手续费:'+val.fee+',实到金额:' + val.actualamount + '</div>';
				html += '<div class="item-after"><t>' + val.state + '</t></div>';
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
				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
var lotteryreport=function(){
	$(".paging").html('');
	var tabs = $("#lotteryReport");
	var htmlTitle = "<tr><th>日期</th><th>充值</th><th>提款</th><th>消费</th><th>返点</th><th>中奖</th><th>活动</th><th>盈利</th></tr>";
	var url = apirooturl + 'lotteryreport';
	var startime = $(".lotteryReportsearchbar").find("input.starTime").val();
	var endtime = $(".lotteryReportsearchbar").find("input.endTime").val();
    if (dateDiff(startime, endtime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    }
	tabs.empty();
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 4,
		ajaxType: 'post',
		//hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			'jqueryGridPage': jqueryGridPage,
			'jqueryGridRows': jqueryGridRows,
			"startime": startime,
			"endtime": endtime
		},
		complete: function() {},
		success: function(data) {
			tabs.empty();
			$.each(data, function(index, val) {
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
				html += '返点:' + val.dayCommissionMoney + ',活动:' + val.dayActivitiesMoney ;
				html += '</div>';
				html += '</div>';
				html += '</li>';
				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}

