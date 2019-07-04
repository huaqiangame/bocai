var userlevel=null;
var userlevelbai = 0;//安全等级
var levelstr     = '您的账户安全级别为低，请完善安全信息';
$(function(){
	getuserlevel();
	var searchStr = window.location.search;

	var financeCode = getQueryString("financeCode");
	
	if (financeCode && $("div.mem-main div.mem-re-nav .tabHd li[code='"+financeCode+"']").length>0) {
		$("div.mem-main div.mem-re-nav .tabHd li[code='"+financeCode+"']").click();
	}else{
		financeCode = 'cunk';
	}
	//alert(financeCode);
	init(financeCode);
	// 切换子菜单
	var submenuLi = $("div.mem-main div.mem-re-nav .tabHd li");
	submenuLi.on("click", function() {
		init($(this).attr("code"));
	});
	//$(".back-choose li").on('click',function(){
		//var bankid = $(this).attr('bankid');
		//$(this).addClass('cur').siblings("li").removeClass("cur");
	//})
});
$(document).on("click", ".back-choose li", function() {
	$(this).addClass('cur').siblings("li").removeClass("cur");
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
//切换操作：充值、提款等
var initIndex;
function init(actionCode) {
	clearTimeout(initIndex);
	if (!user) {
		initIndex = setTimeout(function() {
			init(actionCode);
		}, 1000);
		return false;
	}
	

	if (actionCode == "cunk") {//存款
		getrechargetypelist();
		
	} else if (actionCode == "quk") {//取款
		getuserbanklist();isUserWithdrawLimit();
	} else if(actionCode == "jfdh") {
		pointexchangeamountLimit();
	}
}

//积分兑换规则
var pointexchangeamountrules;
function pointexchangeamountLimit(){
	var url = apirooturl + 'pointexchangeamountLimit';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		async:false,
		success: function(data) {
			if (data.sign === true) {
				//alert(data.data.feescale);
				pointexchangeamountrules = data.data;
				if(data.data.pointexchangeamount>0){
					$(".jfdhzijinmimaput").show();$(".jfdhmsg").hide();
					
					way.set('pointexchangeamount.changerule',data.data.pointexchangeamount+'积分兑换1元');
				}
				var getpointrules = '';
				if(data.data.pointchongzhi>0 && data.data.pointchongzhiadd>0){
					getpointrules += '充值'+data.data.pointchongzhi+'元获取'+data.data.pointchongzhiadd+'积分';
				}
				if(data.data.pointtouzhu>0 && data.data.pointtouzhuadd>0){
					getpointrules += '<br>游戏投注'+data.data.pointtouzhu+'元获取'+data.data.pointtouzhuadd+'积分';
				}
				if(data.data.pointhuisun>0 && data.data.pointhuisunadd>0){
					getpointrules += '<br>每次游戏亏损'+data.data.pointhuisun+'元获取'+data.data.pointhuisunadd+'积分';
				}
				$("#getpointrules").html(getpointrules);
				
				//UserWithdraw = data.data;
				//$(".srqkmm .zijinmimaput").show(),$(".srqkmm .tikuanmsg").hide().text('');
			} else {
				//$(".srqkmm .zijinmimaput").hide(),$(".srqkmm .tikuanmsg").show().text(data.message);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			
		}
	});
}
var PointtoMoney = function(e){
	if(!pointexchangeamountrules || pointexchangeamountrules.pointexchangeamount<=0){
		alt("积分兑换已经关闭", -1);
		return false;
	}
	var userpoint = user.point;
	var jfdh_point = $("#jfdh_point").val();
	var jfdh_money = $("#jfdh_money").val();
	var jfdhzijinmimaput = $("#jfdh_withdraw_pwd").val();
	if(jfdh_point=='' || parseInt(jfdh_point)<=0 || parseInt(jfdh_point)>parseInt(userpoint) || parseInt(jfdh_point)<parseInt(pointexchangeamountrules.pointexchangeamount)){
		alt("兑换积分额度错误", -1);
		return false;
	};
	
	if(jfdhzijinmimaput=='' || jfdhzijinmimaput==undefined){
		alt("请填写提款密码", -1);
		return false;
	};
	artDialog({
		 id: 'testID',
		title:"积分兑换确认",
		content:'您确认要兑换'+jfdh_point+'积分吗',
		okVal:'确认兑换',
		cancel:function(){},
		ok:function(){
			var url = apirooturl + 'savepointchangemoney';
			$.ajax({
				url: url,
				type: "post",
				dataType: "json",
				async:false,
				data:{'point':jfdh_point,'jfdh_withdraw_pwd':jfdhzijinmimaput},
				success: function(data) {
					if (data.sign === true) {
						$("#quk_withdraw_money").val('');
						way.set('user.point',(userpoint - parseInt(jfdh_point)).toFixed(2));
						way.set('user.balance',(Number(user.balance) + Number(jfdh_money)).toFixed(2));
						$("#jfdh_point").val('');
						$("#jfdh_money").val('0.0000');
						$("#jfdh_withdraw_pwd").val('');
						alt(data.message, 1);
						isUserWithdrawLimit();
					} else {
						alt(data.message, -1);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					//alt('服务器链接失败',-1);
				}
			});
		},
		lock:true
	});
}
function replacepointexchangeamount(obj, event, pattern, text){
	var e = event ? event : (window.event ? window.event : null);
	var currKey = 0;
	currKey = e.keyCode || e.which || e.charCode;
	if (event.altKey || event.ctrlKey || currKey == 16 || currKey == 17 || currKey == 18 || (event.shiftKey && currKey == 36)) {
		return;
	}

	var pos = getCursorPos(obj); // 保存原始光标位置
	var temp = obj.value; // 保存原始值
	obj.value = temp.replace(pattern, text); // 替换掉非法值
	pos = pos - (temp.length - obj.value.length); //当前光标位置
	setCursorPos(obj, pos); //设置光标
	
	if(pointexchangeamountrules.pointexchangeamount>0){
		var changeamount = parseInt(obj.value) / parseInt(pointexchangeamountrules.pointexchangeamount);
		changeamount     = changeamount.toFixed(2);
		$("#jfdh_money").val(changeamount);
		//alert(shouxufei);
	}
}
var UserWithdraw;
//检测是否可以提款
function isUserWithdrawLimit(){
	var url = apirooturl + 'isUserWithdrawLimit';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		async:false,
		success: function(data) {
			if (data.sign === true) {
				//alert(data.data.feescale);
				
				UserWithdraw = data.data;
				$(".srqkmm .zijinmimaput").show(),$(".srqkmm .tikuanmsg").hide().text('');
			} else {
				$(".srqkmm .zijinmimaput").hide(),$(".srqkmm .tikuanmsg").show().text(data.message);
			}
			way.set('quk_explain_time',data.data.starTime+'~'+data.data.endTime);
			way.set('quk_explain_xiane',data.data.minMoney+'~'+data.data.maxMoney);
			way.set('quk_explain_freetimes',data.data.freetimes);
			way.set('quk_explain_minfee',data.data.minfee);
			way.set('quk_explain_maxfee',data.data.maxfee);
			way.set('quk_explain_daymaxMoney',data.data.daymaxMoney);
			way.set('quk_explain_feescale',data.data.feescale);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			
		}
	});

}
function replaceAndSetPosWithdraw(obj, event, pattern, text) {
	var e = event ? event : (window.event ? window.event : null);
	var currKey = 0;
	currKey = e.keyCode || e.which || e.charCode;
	if (event.altKey || event.ctrlKey || currKey == 16 || currKey == 17 || currKey == 18 || (event.shiftKey && currKey == 36)) {
		return;
	}

	var pos = getCursorPos(obj); // 保存原始光标位置
	var temp = obj.value; // 保存原始值
	obj.value = temp.replace(pattern, text); // 替换掉非法值
	pos = pos - (temp.length - obj.value.length); //当前光标位置
	setCursorPos(obj, pos); //设置光标
	
	if(UserWithdraw.freetimes==0){
		var shouxufei = obj.value * ( UserWithdraw.feescale/100 );
		if(shouxufei>UserWithdraw.maxfee && parseInt(UserWithdraw.maxfee)>0){
			shouxufei = UserWithdraw.maxfee;
		}
		if(shouxufei<UserWithdraw.minfee && parseInt(UserWithdraw.maxfee)>0){
			shouxufei = UserWithdraw.minfee;
		}
		var ramount   = obj.value - shouxufei;
		$("#quk_fee").val(shouxufei);
		$("#quk_ramount").val(ramount);
		//alert(shouxufei);
	}
}
var toApplyForWithdraw = function(e){
	/*if(!UserWithdraw){
		alt("验证不通过", -1);
		return false;
	}*/
	var banknode = $(".back-choose li[class='cur']");
	var quk_withdraw_money = $("#quk_withdraw_money").val();
	var quk_withdraw_pwd = $("#quk_withdraw_pwd").val();
	if(quk_withdraw_money=='' || parseInt(quk_withdraw_money)<=0 || parseInt(quk_withdraw_money)>UserWithdraw.balance){
		alt("提款金额错误", -1);
		return false;
	};
	
	if(quk_withdraw_pwd=='' || quk_withdraw_pwd==undefined){
		alt("请填写提款密码", -1);
		return false;
	};
	if( parseInt(quk_withdraw_money)<parseInt(UserWithdraw.minMoney) || parseInt(quk_withdraw_money)>parseInt(UserWithdraw.maxMoney) ){
		alt("单次提款金额"+UserWithdraw.minMoney+"~"+UserWithdraw.maxMoney, -1);
		return false;
	}
	
	if( (parseInt(quk_withdraw_money)+parseInt(UserWithdraw.totaltkamout)) > UserWithdraw.daymaxMoney ){
		alt("您的本次提款累计超出日提款限额"+UserWithdraw.daymaxMoney+"元", -1);
		return false;
	};
	$("#tikuanorder_bankid").val(banknode.attr('bankid'));
	$("#tikuanorder_amount").val(quk_withdraw_money);
	$("#tikuanorder_withdraw_pwd").val(quk_withdraw_pwd);
	
	$("#bankorder_bankname").text(banknode.find("span").eq(0).text());
	$("#bankorder_bankcode").text(banknode.find("span").eq(1).text());
	$("#bankorder_amount").text(quk_withdraw_money);
	$("#bankorder_free").text($("#quk_fee").val());
	$("#bankorder_ramount").text($("#quk_ramount").val());
	artDialog({
		title:"提款信息确认",
		content:$("#tikuanquery").html(),
		okVal:'确认提款',
		cancel:function(){},
		ok:function(){
			var url = apirooturl + 'savetikuanorder';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		async:false,
		data:{'bankid':$("#tikuanorder_bankid").val(),'amount':$("#tikuanorder_amount").val(),'withdraw_pwd':$("#tikuanorder_withdraw_pwd").val()},
		success: function(data) {
			if (data.sign === true) {
				$("#quk_withdraw_money").val('');
				$("#quk_fee").val('0.0000');
				$("#quk_ramount").val('0.0000');
				$("#quk_withdraw_pwd").val('');
				alt(data.message, 1);
				isUserWithdrawLimit();
			} else {
				alt(data.message, -1);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			//alt('服务器链接失败',-1);
		}
	});

		},
		lock:true
	});
}

//获取已经绑定银行卡
var getuserbanklist = function(){
	var url = apirooturl + 'usergetbankcard';
	// 我的银行卡列表
	var bankchoose = $(".back-choose ul");
	var html = '';
	$.post(url,{}, function(data){
		if(data.sign){
			bankchoose.empty();
			var haveTitle = true;
			$.each(data.banklist, function(index, val) {
				var cur = '';
				if(val.isdefault==1){
					cur = 'cur';
				}
				if(val.state == 1) {
					var html = '<li bankid="'+val.id+'" class="'+cur+'"><img src="/resources/images/bank/'+val.banklogo+'" alt="'+val.bankname+'" width="28" height="28"><span>'+val.bankname+'</span><span>'+val.banknumber+'</span><i></i></li>';
					bankchoose.append(html);
				}

			});
		}
	},'json'); 
}

//获取支付方式列表
var chargetypeIndex;
var paytypelist=null;
function getrechargetypelist(){
	clearTimeout(chargetypeIndex);
	var url = apirooturl + 'getrechargetypelist';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		async:false,
		success: function(data) {
			if (data.sign === true) {
				var liopts = '',panner = $(".m-f-cuk .m-c-hd ul");
				paytypelist = data.data;
				for(var o in paytypelist){
					var ewmurl='';
					if(paytypelist[o].ewmurl!='' && paytypelist[o].ewmurl!=undefined){
						ewmurl = paytypelist[o].ewmurl;
					}
					liopts += '<li id="'+paytypelist[o].paytype+'"><label><input paytype-min="'+paytypelist[o].minmoney+'" paytype-max="'+paytypelist[o].maxmoney+'" onchange="setpaytype(\''+paytypelist[o].paytype+'\')" name="paytype" ewmurl="'+ewmurl+'" value="'+paytypelist[o].paytype+'" type="radio">'+paytypelist[o].paytypetitle+'</label></li>';
				};
				panner.html(liopts);
			} else {
				alt(data.message,-1);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			//alt('服务器链接失败',-1);
		}
	});
	
}
function setpaytype(paytype){
	clearTimeout(chargetypeIndex);
	$(".me-deposit .d-three,.me-deposit .d-tow").removeClass('cur');
	$(".me-deposit .d-one").addClass('cur');
	var index = $("#"+paytype).index();
	$(".c-bz-c-one").show().siblings('div').hide();
	$("#pay_alipay li.payerweima").hide();
	$(".c-bz-c-one .xyb").text('下一步').attr('onclick','recharge(event);');
	//$(".c-buzou").
	if(!paytypelist){
		chargetypeIndex = setTimeout(function() {
			getrechargetypelist();
		}, 1000);
		return false;
	}
	for(var o in paytypelist){
		if(paytypelist[o].paytype==paytype){
			var payinfo = paytypelist[o];
			var minmoney = paytypelist[o].minmoney;
			var maxmoney = paytypelist[o].maxmoney;
			$("#depositLimit").text(minmoney+"~"+maxmoney);
			way.set('recharge.minmoney',minmoney);
			way.set('recharge.maxmoney',maxmoney);
			$(".c-bz-c-one .paycontent").html(payinfo.remark);
		}
	};
	if(paytype=='alipay' || paytype=='alipay2' || paytype=='weixin' || paytype=='weixin2' || paytype=='tenpay' || paytype=='creditcard'){//扫码支付
		var html = '<h6>支付账号：</h6><div><input way-data="recharge.payname" placeholder="请输入您的支付账号" type="text"><span>(为保障您的充值资金及时到账，请输入支付宝或微信账号)</span></div>';
		$(".c-bz-c-one .userpayname").css({'margin-top':'15px'}).html(html);
	}else if(paytype=='helibaobank'){
		var html = '<h6>选择银行：</h6><div><select id="choosebankcode"><option value="0">=请选择付款银行=</option><option value="ICBC">中国工商银行</option><option value="ABC">中国农业银行</option><option value="CMBCHINA">招商银行</option><option value="CCB">中国建设银行</option><option value="BOCO">交通银行</option><option value="BOC">中国银行</option><option value="CMBC">中国民生银行</option><option value="CGB">广发银行</option><option value="HXB">华夏银行</option><option value="POST">中国邮政储蓄银行</option><option value="ECITIC">中信银行</option><option value="CEB">中国光大银行</option><option value="PINGAN">平安银行</option><option value="CIB">兴业银行</option><option value="SPDB">浦发银行</option><option value="BCCB">北京银行</option><option value="BON">南京银行</option><option value="NBCB">宁波银行</option><option value="BEA">东亚银行</option><option value="SRCB">上海农商银行</option><option value="SHB">上海银行</option></select></div>';
		$(".c-bz-c-one .userpayname").css({'margin-top':'15px'}).html(html);
	}else if(paytype=='huixingbank'){
		var html = '<h6>选择银行：</h6><div><select id="choosebankcode"><option value="0">=请选择付款银行=</option><option value="1000021">工商银行</option><option value="1000022">农业银行</option><option value="1000023">中国银行</option><option value="1000024">建设银行</option><option value="1000025">邮储银行</option><option value="1000026">招商银行</option><option value="1000027">民生银行</option><option value="1000028">浦发银行</option><option value="1000029">广发银行</option><option value="1000030">中信银行</option><option value="1000031">光大银行</option><option value="1000036">北京银行</option><option value="1000037">交通银行</option><option value="1000038">兴业银行</option><option value="1000284">平安银行</option></select></div>';
		$(".c-bz-c-one .userpayname").css({'margin-top':'15px'}).html(html);
	}else if(paytype=='linepay'){//线下支付
		//获取收款银行账号
		var html1 = '';
		$.ajax({
			url: apirooturl + 'getlinepaylist',
			type: "post",
			dataType: "json",
			data: {},
			async:false,
			success: function(data) {
				if (data.sign === true) {
					var linepaylist = data.linepaylist;
					html1 += '<table>';
					html1 += '<tbody>';
					for(var o in linepaylist){
						
						html1 += '<tr>';
						html1 += '<td><label><input name="paylinebankid" accountname="'+linepaylist[o].accountname+'" bankname="'+linepaylist[o].bankname+'" banknumber="'+linepaylist[o].banknumber+'" value="'+linepaylist[o].id+'" type="radio">'+linepaylist[o].bankname+'</label></td>';
						html1 += '<td>开户姓名:'+linepaylist[o].accountname+'</td>';
						html1 += '<td>银行账号:'+linepaylist[o].banknumber+'</td>';
						html1 += '</tr>';
					}
					html1 += '</tbody>';
					html1 += '</table>';
				}else{
					alt('线下支付银行获取失败',-1);
					return false;
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {}
		});
		var html = '';
		html += '<h6>您的银行卡姓名：</h6><div><input way-data="recharge.paybankname" placeholder="请输入您的银行卡姓名" type="text"><span>(为保障您的充值资金及时到账，请输入您的银行卡姓名)</span></div>';
		html += '<div style="margin-top:15px;"><h6>您的银行账号：</h6><input way-data="recharge.paybanknumber" placeholder="请输入您的银行卡账号" type="text"><span>(为保障您的充值资金及时到账，请输入您的转账银行卡号码)</span></div>';
		html += '<div style="margin-top:15px;"><h6>选择付款银行：</h6>'+html1+'</div>';
		$(".c-bz-c-one .userpayname").css({'margin-top':'15px'}).html(html);
	}else{
		$(".c-bz-c-one .userpayname").css({'margin-top':'0'}).html('');
	}
}
function recharge(){
	
	var paytype = $("input[name='paytype']:checked").val();
	if(!paytype || paytype=='undefined'){
		alt('请选择充值方式',-1);return false;
	}
	var amount = way.get("recharge.amount")?parseInt(way.get("recharge.amount")):0,
		minmoney = way.get("recharge.minmoney")?parseInt(way.get("recharge.minmoney")):10,
		maxmoney = way.get("recharge.maxmoney")?parseInt(way.get("recharge.maxmoney")):50000;
	if(amount<=0){
		alt('请填写充值金额',-1);return false;
	}
	if(amount<minmoney){
		alt('最低充值金额：'+minmoney+'元',-1);return false;
	}
	if(amount>maxmoney){
		alt('最高充值金额：'+maxmoney+'元',-1);return false;
	}
	if(paytype=='alipay' || paytype=='alipay2' || paytype=='weixin' || paytype=='weixin2' || paytype=='tenpay' || paytype=='creditcard'){//扫码支付
		var userpayname = way.get("recharge.payname")?way.get("recharge.payname"):'';
		if(userpayname.length<1){
			alt('请输入您的支付账号',-1);return false;
		}
	}else if(paytype=='helibaobank'){
		var choosebankcode = $("#choosebankcode").val();
		if(choosebankcode==0 || choosebankcode==''){
			alt('请选择付款银行',-1);return false;
		}
	}else if(paytype=='huixingbank'){
		var choosebankcode = $("#choosebankcode").val();
		if(choosebankcode==0 || choosebankcode==''){
			alt('请选择付款银行',-1);return false;
		}
	}else if(paytype=='linepay'){
		var paybankname   = way.get("recharge.paybankname")?way.get("recharge.paybankname"):'';
		var paybanknumber = way.get("recharge.paybanknumber")?way.get("recharge.paybanknumber"):'';
		var paylinebankid = $("input[name='paylinebankid']:checked").val();
		var paylinebankname = $("input[name='paylinebankid']:checked").attr('bankname'); 
		var paylinebankaccountname     = $("input[name='paylinebankid']:checked").attr('accountname'); 
		var banknumber     = $("input[name='paylinebankid']:checked").attr('banknumber'); 
		if(paybankname.length<1){
			alt('请输入您的您的银行卡姓名',-1);return false;
		}
		if(paybanknumber.length<10){
			alt('请输入您的转账银行卡号码',-1);return false;
		}
		if(paylinebankid=='' || paylinebankid==undefined){
			alt('请选择付款银行',-1);return false;
		}
	}else{
		var userpayname = '';
	}
	$(".c-bz-c-one .xyb").text('正在提交订单...').removeAttr('onclick');
	var url = apirooturl + 'addrecharge';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		data: {'amount':amount,'paytype':paytype,'userpayname':userpayname,'paylinebankid':paylinebankid,'paybankname':paybankname,'paybanknumber':paybanknumber},
		async:false,
		success: function(data) {
			if (data.sign === true) {
				$(".me-deposit .d-one").removeClass('cur');
				$(".me-deposit .d-tow").addClass('cur');
				if(paytype=='alipay' || paytype=='alipay2' || paytype=='weixin' || paytype=='weixin2' || paytype=='tenpay' || paytype=='creditcard'){//扫码支付
					$(".c-bz-c-one").hide(),$("#pay_alipay").show();
					way.set("saomabill.amount",data.data.amount);
					way.set("saomabill.trano",data.data.trano);
					way.set("saomabill.id",data.data.id);
					way.set("saomabill.paytype",data.data.paytype);
					$(".paysaomabtn").text('请使用手机完成扫码付款').removeAttr('onclick');
					$("#pay_alipay .in-but-l").text('请使用手机完成扫码付款').removeAttr('onclick');
					var ewmurl = $("input[name='paytype']:checked").attr('ewmurl');
					if(paytype=='alipay'){
						$("#pay_alipay ul.mar-lr20").append("<li class='payerweima'><h6>付款二微码：</h6></li><li class='payerweima' style='height:auto'><span><img src='"+ewmurl+"' style='max-width:250px;'></span></li>");
																	
					}else if(paytype=='alipay2'){
						$("#pay_alipay ul.mar-lr20").append("<li class='payerweima'><h6>付款二微码：</h6></li><li class='payerweima' style='height:auto'><span><img src='"+ewmurl+"' style='max-width:250px;'></span></li>");
					}else if(paytype=='weixin'){
						$("#pay_alipay ul.mar-lr20").append("<li class='payerweima'><h6>付款二微码：</h6></li><li class='payerweima' style='height:auto'><span><img src='"+ewmurl+"' style='max-width:250px;'></span></li>");
					}else if(paytype=='weixin2'){
						$("#pay_alipay ul.mar-lr20").append("<li class='payerweima'><h6>付款二微码：</h6></li><li class='payerweima' style='height:auto'><span><img src='"+ewmurl+"' style='max-width:250px;'></span></li>");
					}else if(paytype=='creditcard'){
						$("#pay_alipay ul.mar-lr20").append("<li class='payerweima'><h6>付款二微码：</h6></li><li class='payerweima' style='height:auto'><span><img src='"+ewmurl+"' style='max-width:250px;'></span></li>");
					}
				}else if(paytype=='linepay'){
					$(".c-bz-c-one").hide(),$("#pay_linebank").show();
					way.set("linepay.amount",data.data.amount);
					way.set("linepay.trano",data.data.trano);
					way.set("linepay.paylinebankname",paylinebankname);
					way.set("linepay.paylinebankaccountname",paylinebankaccountname);
					
					way.set("linepay.paybanknumber",banknumber);
				}else if(paytype=='helibaobank'){
					$(".c-bz-c-one").hide(),$("#pay_onlineBank").show();
					way.set("onlineBank.amount",data.data.amount);
					way.set("onlineBank.trano",data.data.trano);
					way.set("onlineBank.id",data.data.id);
					way.set("onlineBank.paytype",data.data.paytype);
					$("#onlineBankUrl").attr('choosebankcode',choosebankcode);
				}else if(paytype=='huixingbank'){
					$(".c-bz-c-one").hide(),$("#pay_onlineBank").show();
					way.set("onlineBank.amount",data.data.amount);
					way.set("onlineBank.trano",data.data.trano);
					way.set("onlineBank.id",data.data.id);
					way.set("onlineBank.paytype",data.data.paytype);
					$("#onlineBankUrl").attr('choosebankcode',choosebankcode);
				}else{
					$(".c-bz-c-one").hide(),$("#pay_onlineBank").show();
					way.set("onlineBank.amount",data.data.amount);
					way.set("onlineBank.trano",data.data.trano);
					way.set("onlineBank.id",data.data.id);
					way.set("onlineBank.paytype",data.data.paytype);
				}
				//alt(data.message,1);
			} else {
				alt(data.message,-1);
			    $(".c-bz-c-one .xyb").text('下一步').attr('onclick','recharge(event);');
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			//alt('服务器链接失败',-1);
			$(".c-bz-c-one .xyb").text('下一步').attr('onclick','recharge(event);');
		}
	});
}
function paysaoma(){
	var trano = way.get("saomabill.trano")?way.get("saomabill.trano"):'';
	if(trano==''){
		alt('订单不完整',-1);
		return false;
	}
	var url = payhost + '/Pay.saoma?trano='+trano+'&host='+encodeURIComponent(host);;
	window.open(url);
	$(".me-deposit .d-one,.me-deposit .d-tow").removeClass('cur');
	$(".me-deposit .d-three").addClass('cur');
}

function payonlineBank(){
	var trano = way.get("onlineBank.trano")?way.get("onlineBank.trano"):''; //获取订单号
	var paytype = $("input[name='paytype']:checked").val();                 //获取支付方式
	var choosebankcode = $("#onlineBankUrl").attr('choosebankcode');
 	paytype = paytype?paytype:'';
	if(trano=='' || paytype==''){
		alt('订单不完整',-1);
		return false;
	}
	
	var redirecturl = null;
	// alert(apirooturl + 'getpayhost?paytype='+paytype);
	$.ajax({
		url: apirooturl + 'getpayhost?paytype='+paytype,
		type: "post",
		dataType: "json",
		data: {'paytype':paytype},
		async:false,
		success: function(data) {
			if (data.sign === true) {
				redirecturl = data.redirecturl;
				//alt(data.message,1);
			}else{
				alt(data.message,-1);
				return false;
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			//alt('服务器链接失败',-1);return false;
		}
	});
	if(redirecturl==null || redirecturl=='#' || redirecturl=='/' || redirecturl==''){
		var url = payhost+'/Pay.onlinebank?trano='+trano+'&host='+encodeURIComponent(host)+'&bankcode='+choosebankcode;
	}else{ 
		var url = redirecturl+'/Pay.onlinebank?trano='+trano+'&host='+encodeURIComponent(host)+'&bankcode='+choosebankcode;
	}
	window.open(url);
	$(".me-deposit .d-one,.me-deposit .d-tow").removeClass('cur');
	$(".me-deposit .d-three").addClass('cur');
}