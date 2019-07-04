var userlevel=null;
var userlevelbai = 0;//安全等级
var levelstr     = '您的账户安全级别为低，请完善安全信息';
$(function(){
	getuserlevel();
	var tabid = getQueryString("tabid");
	if (tabid && $("div.mem-main div.m-m-subnav .tabHd li[data-tabid='"+tabid+"']").length>0) {
		eval(tabid+"()");
		$("div.mem-main div.m-m-subnav .tabHd li[data-tabid='"+tabid+"']").click();
	}else{
		userbets();
	}
	
	$('.tabHd').children().click(function() {
		$(".paging").html('');
		var index = $('.tabHd').children().index(this);
		if (index === 0) {
			userbets();
		} else if (index == 1) {
			getfuddetailtypes();userfuddetail();
		} else if (index == 2) {
			lotteryreport();
		} else if (index == 3) {
			rechargelist();
		} else if (index == 4) {
			withdrawlist();
		}
	});
});

//会员安全级别
var getuserlevel = function(){
	var url = apirooturl + 'userlevel';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		success: function(data) {
			if (data.sign === true) {
				userlevel = data.data;
				userlevelbai = 0;
				if(userlevel.tradepassword==true){
					userlevelbai += 14;
					$("#isTradePassword").removeClass('wb').addClass('yb');
				}
				if(userlevel.userbankname==true){
					userlevelbai += 14;
					$("#isUserbankName").removeClass('wb').addClass('yb');
					$("#isUserbankName").find('.mark').removeAttr('onclick').css({'color':'grey'}).text('已绑定');
				}
				if(userlevel.email==true){
					userlevelbai += 14;
					$("#isEmail").removeClass('wb').addClass('yb');
					$("#isEmail").find('.mark').removeAttr('onclick').css({'color':'grey'}).text('已绑定');
				}
				if(userlevel.phone==true){
					userlevelbai += 14;
					$("#isPhone").removeClass('wb').addClass('yb');
					$("#isPhone").find('.mark').removeAttr('onclick').css({'color':'grey'}).text('已绑定');
				}
				if(userlevel.qq==true){
					userlevelbai += 14;
					$("#isQq").removeClass('wb').addClass('yb');
				}
				if(userlevel.bindbank==true){
					userlevelbai += 14;
				}
				if(userlevel.question==true){
					userlevelbai += 14;
					$("#isQuestion").removeClass('wb').addClass('yb');
					$("#isQuestion").find('.mark').removeAttr('onclick').attr('onclick','userseditecurity()').css({'color':'grey'}).text('修改密保');
				}
				$("#userInfoDiv .anqdj em").css({'width':userlevelbai+'%'});
				if(userlevelbai<30){
					var levelstr = '您的账户安全级别为低，请完善安全信息';
				}
				if(userlevelbai>=30 && userlevelbai<60){
					var levelstr = '您的账户安全级别为中，请完善安全信息';
				}
				if(userlevelbai>=60){
					var levelstr = '您的账户安全级别为高';
				}
				$("#anqxis").text(levelstr);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {}
		
	});
}
var getlotterylist=function(lotterylist){
	if(lotterylist.length>0){
		var opts = '<option value="">全部</option>';
		for(var o in lotterylist){
			opts += '<option value="'+lotterylist[o].name+'">'+lotterylist[o].title+'</option>';
		};
		$("#userBets").find(".lotteryname").html(opts);
	}
}
var userbets=function(){
	var tabs = $("#userBets").find("tbody");
	var htmlTitle = "<tr><th>订单号</th><th>彩种</th><th>期号</th><th>玩法</th><th>赔率</th><th>金额</th><th>注数</th><th>中奖金</th><th>中注数</th><th>状态</th></tr>";
	var url = apirooturl + 'userbets';
	var trano = $("#userBets").find("input.trano").val();
	var startime = $("#userBets").find("input.starTime").val();
	var endtime = $("#userBets").find("input.endTime").val();
	var lotteryname = $("#userBets").find(".lotteryname").val();
	var state = $("#userBets").find(".state").val();
    if (dateDiff(startime, endtime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    }
	tabs.html('');
	tabs.append(htmlTitle);
			way.set("userbets.touzhutotal",'0.00');
			way.set("userbets.fanjiangtotal",'0.00');
			way.set("userbets.tzyingkuitotal",'0.00');
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 7,
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
			tabs.append(htmlTitle);
			if(sucdata){
				way.set("userbets.touzhutotal",sucdata.touzhutotal?sucdata.touzhutotal:0);
				way.set("userbets.fanjiangtotal",sucdata.fanjiangtotal?sucdata.fanjiangtotal:0);
				way.set("userbets.tzyingkuitotal",sucdata.tzyingkuitotal?sucdata.tzyingkuitotal:0);
			}
			$.each(data, function(index, val) {
				var html = '<tr id="'+val.trano+'">';
				html += '<td> <a href="javascript:getBillInfo(\''+val.trano+'\')">' + val.trano + '</a></td>';
				html += '<td>' + val.cptitle + '</td>';
				html += '<td>' + val.expect + '</td>';
				html += '<td>' + val.playtitle + '</td>';
				html += '<td>' + val.mode + '</td>';
				html += '<td>' + val.amount + '</td>';
				html += '<td>' + val.itemcount + '</td>';
				html += '<td>' + (val.okamount ? val.okamount : 0) + '</td>';
				html += '<td>' + val.okcount + '</td>';
				html += '<td>';
					//'<td>' + val.betsTimes + '</td>' +
				if(val.isdraw == -1) { // 未中奖绿色
					html += '<span style="color:green">未中奖</span>';
				} else if(val.isdraw == 1) { // 已中奖红色
					html += '<span style="color:red">已中奖</span>';
				}else if(val.isdraw == -2) {
					html += '<del>已撤单</del>';
				}else if(val.isdraw == 0) {
					html += '<span>未开奖</span>';
				}else{
					html += '<span>未知状态</span>';
				}
				html += '</td>';
				html += '</tr>';
				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
var getfuddetailtypes = function(){
	var url = apirooturl + 'getfuddetailtypes';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		async:false,
		data:{},
		success: function(data) {
			if (data.sign === true) {
				var html = '<option value="">全部</option>';
				$.each(data.fuddetailtypes, function(idx, val) {
					html += '<option value="' + idx + '">' + val + '</option>';
				});
				$("#sourceModule").html(html);
			} else {
				alt('账变类型获取失败', -1);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alt('服务器链接失败',-1);
		}
	});
}
var userfuddetail=function(){
	var tabs = $("#accountChange").find("tbody");
	var htmlTitle = "<tr><th>订单号</th><th>帐变类型</th><th>操作前金额</th><th>操作金额</th><th>操作后金额</th><th>操作日期</th><th>备注</th></tr>";
	var url = apirooturl + 'userfuddetail';
	var trano = $("#accountChange").find("input.trano").val();
	var startime = $("#accountChange").find("input.starTime").val();
	var endtime = $("#accountChange").find("input.endTime").val();
	var type = $("#sourceModule").val();
	var acctype = $("#accModule").val();
    if (dateDiff(startime, endtime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    }
	tabs.empty();
	tabs.append(htmlTitle);
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 7,
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
			tabs.append(htmlTitle);
			$.each(data, function(index, val) {
				var html = '<tr><td>' + val.trano + '</td>' +
					'<td>' + val.typename + '</td>' +
					'<td>' + val.amountbefor + '</td>' +
					'<td>' + val.amount + '</td>' +
					'<td>' + val.amountafter + '</td>' +
					'<td>' + val.oddtime + '</td>' +
					'<td>' + val.remark + '</td>';
					html += '</tr>';
				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
var rechargelist=function(){
	var tabs = $("#saveRecords").find("tbody");
	var htmlTitle = "<tr><th>订单号</th><th>申请金额</th><th>手续费</th><th>实到金额</th><th>变更前金额</th><th>变更后金额</th><th>时间</th><th>状态</th></tr>";
	var url = apirooturl + 'rechargelist';
	var trano = $("#saveRecords").find("input.trano").val();
	var startime = $("#saveRecords").find("input.starTime").val();
	var endtime = $("#saveRecords").find("input.endTime").val();
	var state = $("#saveRecords").find(".state").val();
    if (dateDiff(startime, endtime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    }
	tabs.empty();
	tabs.append(htmlTitle);
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 7,
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
			tabs.append(htmlTitle);
			$.each(data, function(index, val) {
				var html = '<tr><td>' + val.trano + '</td>' +
					'<td>' + val.amount + '</td>' +
					'<td>' + val.fee + '</td>' +
					'<td>' + val.actualamount + '</td>' +
					'<td>' + val.oldaccountmoney + '</td>' +
					'<td>' + val.newaccountmoney + '</td>' +
					'<td>' + val.oddtime + '</td>' +
					'<td>' + val.state + '</td>';
					html += '</tr>';
				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
var withdrawlist=function(){
	var tabs = $("#drawRecords").find("tbody");
	var htmlTitle = "<tr><th>订单号</th><th>申请金额</th><th>手续费</th><th>实到金额</th><th>变更前金额</th><th>变更后金额</th><th>时间</th><th>状态</th></tr>";
	var url = apirooturl + 'withdrawlist';
	var trano = $("#drawRecords").find("input.trano").val();
	var startime = $("#drawRecords").find("input.starTime").val();
	var endtime = $("#drawRecords").find("input.endTime").val();
	var state = $("#drawRecords").find(".state").val();
    if (dateDiff(startime, endtime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    }
	tabs.empty();
	tabs.append(htmlTitle);
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 7,
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
			tabs.append(htmlTitle);
			$.each(data, function(index, val) {
				var html = '<tr><td>' + val.trano + '</td>' +
					'<td>' + val.amount + '</td>' +
					'<td>' + val.fee + '</td>' +
					'<td>' + val.actualamount + '</td>' +
					'<td>' + val.oldaccountmoney + '</td>' +
					'<td>' + val.newaccountmoney + '</td>' +
					'<td>' + val.oddtime + '</td>' +
					'<td>' + val.state + '</td>';
					html += '</tr>';
				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}
var lotteryreport=function(){
	var tabs = $("#lotteryReport").find("tbody");
	var htmlTitle = "<tr><th>日期</th><th>充值</th><th>提款</th><th>消费</th><th>返点</th><th>中奖</th><th>活动</th><th>盈利</th></tr>";
	var url = apirooturl + 'lotteryreport';
	var startime = $("#lotteryReport").find("input.starTime").val();
	var endtime = $("#lotteryReport").find("input.endTime").val();
    if (dateDiff(startime, endtime) > 30) {
        alt('查询日期间隔不能超过30天', -1);
        return false;
    }
	tabs.empty();
	tabs.append(htmlTitle);
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 7,
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
			tabs.append(htmlTitle);
			$.each(data, function(index, val) {
				var html = '<tr><td>' + val.statDate + '</td>' +
					'<td>' + val.dayRechargeMoney + '</td>' +
					'<td>' + val.dayDrawRechargeMoney + '</td>' +
					'<td>' + val.dayConsumptionMoney + '</td>' +
					'<td>' + val.dayCommissionMoney + '</td>' +
					'<td>' + val.dayIncomeMoney + '</td>' +
					'<td>' + val.dayActivitiesMoney + '</td>'+
					'<td>' + val.dayDividendMoney + '</td>';
					html += '</tr>';
				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
}


