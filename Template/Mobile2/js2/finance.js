$(function(){
	//$.init();
	//nologinredict();
	var $content = $(document.body).find('.content');
	$(document).on('click','.prompt-usereditpass', function () {
      $.modal({
            title: '修改密码',
            text: '<input class="modal-text-input" type="password" placeholder="旧密码" id="usereditpass_oldpassword"><input class="modal-text-input" type="password" placeholder="新密码" id="usereditpass_password"><input class="modal-text-input" type="password" placeholder="确认密码" id="usereditpass_rpassword">',
            buttons: [ 
				{text: '取消'},
				{text: '确定',bold: true, onClick: function(){
					var url = apirooturl + 'usereditpass';
					var oldpassword = $('#usereditpass_oldpassword').val();
					var password = $('#usereditpass_password').val();
					var rpassword = $('#usereditpass_rpassword').val();
					var passwordpatten = /^[\w\W]{6,16}$/;
					if(!passwordpatten.test(oldpassword) || oldpassword.length < 6 || oldpassword.length > 16){
						alt("旧密码格式不正确(由6至16个字符组成)",-1);
						return false;
					}
					if(!passwordpatten.test(password) || password.length < 6 || password.length > 16){
						alt("新密码格式不正确(由6至16个字符组成)",-1);
						return false;
					}
					if(password!=rpassword){
						alt("新密码两次输入不一致",-1);
						return false;
					}
					$.post(url,{"oldpassword":oldpassword,'password':password,'rpassword':rpassword}, function(json){
							if(json.sign){
								alt('修改成功',1);
							}else{
								alt(json.message,-1);
							}
					},'json'); 
				}}
			]
        });
    });
	
	
});
function setpaytype(){
	var index = $("#paytype").prop('selectedIndex');
	var minmoney = $("#paytype").find('option').eq(index).attr('minmoney');
	var maxmoney = $("#paytype").find('option').eq(index).attr('maxmoney');
	$("#recharge_minmoney").val(minmoney);
	$("#recharge_maxmoney").val(maxmoney);
	$("#pay_alipay li.payerweima").hide();
	$("#paylinebankbox").html('');
	$(".nuonlinepayname").hide();
	$(".nextrechargebtn").text('下一步').attr('onclick','recharge(event);');
	var paytype = $("#paytype").val();
	if(paytype=='alipay' || paytype=='alipay2' || paytype=='tenpay' || paytype=='weixin' || paytype=='weixin2' || paytype=='creditcard'){//扫码支付
		$(".nuonlinepayname").show();
	}else if(paytype=='helibaobank'){
		var html = '<li><div class="item-content"><div class="item-inner"><div class="item-title label">选择银行</div><div class="item-input"><select id="choosebankcode"><option value="0">=请选择付款银行=</option><option value="ICBC">中国工商银行</option><option value="ABC">中国农业银行</option><option value="CMBCHINA">招商银行</option><option value="CCB">中国建设银行</option><option value="BOCO">交通银行</option><option value="BOC">中国银行</option><option value="CMBC">中国民生银行</option><option value="CGB">广发银行</option><option value="HXB">华夏银行</option><option value="POST">中国邮政储蓄银行</option><option value="ECITIC">中信银行</option><option value="CEB">中国光大银行</option><option value="PINGAN">平安银行</option><option value="CIB">兴业银行</option><option value="SPDB">浦发银行</option><option value="BCCB">北京银行</option><option value="BON">南京银行</option><option value="NBCB">宁波银行</option><option value="BEA">东亚银行</option><option value="SRCB">上海农商银行</option><option value="SHB">上海银行</option></select></div></div></div></li>';
		$("#paylinebankbox").html(html);
	}else if(paytype=='linepay'){
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
					html1 += '<li><div class="item-content"><div class="item-inner"><div class="item-title label">选择付款银行</div><div class="item-input"><select id="paylinebankid">';
					html1 += '<option value="">选择付款银行</option>';
					for(var o in linepaylist){
						html1 += '<option name="paylinebankid" accountname="'+linepaylist[o].accountname+'" banknumber="'+linepaylist[o].banknumber+'" bankname="'+linepaylist[o].bankname+'" value="'+linepaylist[o].id+'">'+linepaylist[o].bankname+'</option>';
					}
					html1 += '</select></div></div></div></li>';
				}else{
					alt('线下支付银行获取失败',-1);
					return false;
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {}
		});
		var html = '';
		html += '<li><div class="item-content"><div class="item-inner"><div class="item-title label">您的银行卡姓名</div><div class="item-input"><input id="paybankname" placeholder="请输入您的银行卡姓名" type="text"></div></div></div></li>';
		html += '<li><div class="item-content"><div class="item-inner"><div class="item-title label">您的银行账号</div><div class="item-input"><input id="paybanknumber" placeholder="请输入您的银行卡账号" type="text"></div></div></div></li>';
		
		html += html1;
		$("#paylinebankbox").html(html);
	}else{
		$(".nuonlinepayname").hide();
	}
}
function recharge(){
	/*if (!user) {
		alt('请登陆',-1);return false;
	}*/
	var paytype = $("#paytype").val();
	if(!paytype || paytype==0 || paytype=='undefined'){
		alt('请选择充值方式',-1);return false;
	}
	var amount = $("#recharge_amount").val();
	var index = $("#paytype").prop('selectedIndex');
	var minmoney = $("#paytype").find('option').eq(index).attr('minmoney');
	var maxmoney = $("#paytype").find('option').eq(index).attr('maxmoney');
	if(parseInt(amount)<=0){
		alt('请填写充值金额',-1);return false;
	}
	if(parseInt(amount)<parseInt(minmoney)){
		alt('最低充值金额：'+minmoney+'元',-1);return false;
	}
	if(parseInt(amount)>parseInt(maxmoney)){
		alt('最高充值金额：'+maxmoney+'元',-1);return false;
	}
	if(paytype=='alipay' || paytype=='alipay2' || paytype=='tenpay' || paytype=='weixin' || paytype=='weixin2' || paytype=='creditcard'){//扫码支付
		var userpayname = $("#recharge_payname").val();
		if(userpayname.length<1){
			alt('请输入您的支付账号',-1);return false;
		}
	}else if(paytype=='helibaobank'){
		var choosebankcode = $("#choosebankcode").val();
		if(choosebankcode==0 || choosebankcode==''){
			alt('请选择付款银行',-1);return false;
		}
	}else if(paytype=='linepay'){
		var paybankname   = $("#paybankname").val();
		var paybanknumber = $("#paybanknumber").val();
		var paylinebankid = $("#paylinebankid").val();
		var paylinebankname = $("#paylinebankid option").not(function(){ return !this.selected }).attr('bankname'); 
		var paylinebankaccountname     = $("#paylinebankid option").not(function(){ return !this.selected }).attr('accountname'); 
		var banknumber     = $("#paylinebankid option").not(function(){ return !this.selected }).attr('banknumber'); 
		if(paybankname.length<1){
			alt('请输入您的银行卡姓名',-1);return false;
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
	$(".nextrechargebtn").text('正在提交订单...').removeAttr('onclick');
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
				var index = $("#paytype").prop('selectedIndex');
				var ewmurl = $("#paytype").find('option').eq(index).attr('ewmurl');
				if(paytype=='alipay' || paytype=='alipay2' || paytype=='tenpay' || paytype=='weixin' || paytype=='weixin2' || paytype=='creditcard'){//扫码支付
					if(paytype=='alipay'){
						$("#pay_alipay ul.mar-lr20").append("<li class='payerweima'><div class='item-content'><div class='item-inner'><div class='item-title label'>付款二微码</div><div class='item-input'><img src='"+ewmurl+"' style='max-width:250px;'><br>请长按二维码保存，然后打开支付宝扫描二维码并支付</div></div></div></li>");
						$(".nextrechargebtn").text('完成支付').attr('onclick',"window.location.href='./'");
																	
					}else if(paytype=='alipay2'){
						$("#pay_alipay ul.mar-lr20").append("<li class='payerweima'><div class='item-content'><div class='item-inner'><div class='item-title label'>付款二微码</div><div class='item-input'><img src='"+ewmurl+"' style='max-width:250px;'><br>请长按二维码保存，然后打开支付宝扫描二维码并支付</div></div></div></li>");
						$(".nextrechargebtn").text('完成支付').attr('onclick',"window.location.href='./'");
					}else if(paytype=='weixin'){
						$("#pay_alipay ul.mar-lr20").append("<li class='payerweima'><div class='item-content'><div class='item-inner'><div class='item-title label'>付款二微码</div><div class='item-input'><img src='"+ewmurl+"' style='max-width:250px;'><br>请长按二维码保存，然后打开微信扫描二维码并支付</div></div></div></li>");
						$(".nextrechargebtn").text('完成支付').attr('onclick',"window.location.href='./'");
					}else if(paytype=='weixin2'){
						$("#pay_alipay ul.mar-lr20").append("<li class='payerweima'><div class='item-content'><div class='item-inner'><div class='item-title label'>付款二微码</div><div class='item-input'><img src='"+ewmurl+"' style='max-width:250px;'><br>请长按二维码保存，然后打开微信扫描二维码并支付</div></div></div></li>");
						$(".nextrechargebtn").text('完成支付').attr('onclick',"window.location.href='./'");
					}else{
						$(".nextrechargebtn").text('进入扫码完成支付').attr('onclick',"paysaoma(\'"+data.data.trano+"\');");
					}
				}
				else if(paytype=='linepay'){
					var html = '';
					html += '<li><div class="item-content"><div class="item-inner"><div class="item-title label">您的银行卡姓名</div><div class="item-input">'+paybankname+'</div></div></div></li>';
					html += '<li><div class="item-content"><div class="item-inner"><div class="item-title label">您的银行账号</div><div class="item-input">'+paybanknumber+'</div></div></div></li>';
					html += '<li><div class="item-content"><div class="item-inner"><div class="item-title label">ATM转入银行</div><div class="item-input">'+paylinebankname+'</div></div></div></li>';
					html += '<li><div class="item-content"><div class="item-inner"><div class="item-title label">银行账号开户名</div><div class="item-input">'+paylinebankaccountname+'</div></div></div></li>';
					html += '<li><div class="item-content"><div class="item-inner"><div class="item-title label">转入银行账号</div><div class="item-input">'+banknumber+'</div></div></div></li>';
					
					$("#paylinebankbox").html(html);
					$(".nextrechargebtn").text('请线下存款转账完成充值').removeAttr('onclick');
				}
				else if(paytype=='helibaobank'){
					$(".nextrechargebtn").attr('choosebankcode',choosebankcode).text('登录网银完成支付').attr('onclick',"payonlineBank(\'"+data.data.trano+"\',\'"+paytype+"\');");
				}
				else{
					$(".nextrechargebtn").text('登录网银完成支付').attr('onclick',"payonlineBank(\'"+data.data.trano+"\',\'"+paytype+"\');");
				}/**/
				//alt(data.message,1);
			} else {
				alt(data.message,-1);
			    $(".nextrechargebtn").text('下一步').attr('onclick','recharge(event);');
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alt('服务器链接失败',-1);
			 $(".nextrechargebtn").text('下一步').attr('onclick','recharge(event);');
		}
	});
}
function paysaoma(trano){
	if(trano==''){
		alt('订单不完整',-1);
		return false;
	}
	var url = payhost + '/Pay.saoma?trano='+trano+'&host='+encodeURIComponent(host);;
	window.open(url);
}
function payonlineBank(trano,paytype){
	if(trano=='' || paytype==''){
		alt('订单不完整',-1);
		return false;
	}
	
	var choosebankcode = $(".nextrechargebtn").attr('choosebankcode');
	var redirecturl = null;
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
			alt('服务器链接失败',-1);return false;
		}
	});
	if(redirecturl==null || redirecturl=='#' || redirecturl=='/' || redirecturl==''){
		var url = payhost+'/Pay.onlinebank?trano='+trano+'&host='+encodeURIComponent(host)+'&bankcode='+choosebankcode;
	}else{
		var url = redirecturl+'/Pay.onlinebank?trano='+trano+'&host='+encodeURIComponent(host)+'&bankcode='+choosebankcode;
	}
	window.open(url);
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
			
			if(data.data)UserWithdraw = data;
			$('#quk_explain_freetimes').text(data.data.freetimes);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			
		}
	});
}
var toApplyForWithdraw = function(e){
	/*if(!UserWithdraw){
		alt("验证不通过", -1);
		return false;
	}*/
	if(UserWithdraw.sign==false){
		alt(UserWithdraw.message, -1);
		return false;
	}
	var tikuanorder_bankid = $("#tikuanorder_bankid").val();
	var quk_withdraw_money = $("#quk_withdraw_money").val();
	var quk_withdraw_pwd = $("#quk_withdraw_pwd").val();
	if(quk_withdraw_money=='' || parseInt(quk_withdraw_money)<=0 || parseInt(quk_withdraw_money)>UserWithdraw.balance){
		alt("提款金额错误", -1);
		return false;
	};
	
	if(quk_withdraw_pwd=='' || quk_withdraw_pwd==undefined){
		alt("请填写资金密码", -1);
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
	/*$("#tikuanorder_bankid").val(banknode.attr('bankid'));
	$("#tikuanorder_amount").val(quk_withdraw_money);
	$("#tikuanorder_withdraw_pwd").val(quk_withdraw_pwd);
	
	$("#bankorder_bankname").text(banknode.find("span").eq(0).text());
	$("#bankorder_bankcode").text(banknode.find("span").eq(1).text());
	$("#bankorder_amount").text(quk_withdraw_money);
	$("#bankorder_free").text($("#quk_fee").val());
	$("#bankorder_ramount").text($("#quk_ramount").val());*/
	$.alert('您确认提款吗？', function () {
		var url = apirooturl + 'savetikuanorder';
		$.ajax({
			url: url,
			type: "post",
			dataType: "json",
			async:false,
			data:{'bankid':$("#tikuanorder_bankid").val(),'amount':$("#quk_withdraw_money").val(),'withdraw_pwd':$("#quk_withdraw_pwd").val()},
			success: function(data) {
				if (data.sign === true) {
					$("#quk_withdraw_money").val('');
					$("#quk_fee").val('0.0000');
					$("#quk_ramount").val('0.0000');
					$("#quk_withdraw_pwd").val('');
					isUserWithdrawLimit();
					alt(data.message, 1);
				} else {
					alt(data.message, -1);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alt('服务器链接失败',-1);
			}
		});
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
	if(UserWithdraw.data.freetimes==0){
		var shouxufei = obj.value * ( UserWithdraw.data.feescale/100 );
		if(shouxufei>UserWithdraw.data.maxfee && parseInt(UserWithdraw.data.maxfee)>0){
			shouxufei = UserWithdraw.data.maxfee;
		}
		if(shouxufei<UserWithdraw.data.minfee && parseInt(UserWithdraw.data.maxfee)>0){
			shouxufei = UserWithdraw.data.minfee;
		}
		var ramount   = obj.value - shouxufei;
		$("#quk_fee").val(shouxufei);
		$("#quk_ramount").val(ramount);
		//alert(shouxufei);
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
					$("#PointtoMoneymsg").html('温馨提示：<t id="quk_explain_freetimes">'+data.data.pointexchangeamount+'</t>兑换1元');
					
				}else{
					$("#PointtoMoneymsg").html('积分兑换已关闭');
				}
			} else {
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
		alt("请填写资金密码", -1);
		return false;
	};
      $.modal({
            title: '您确认兑换积分吗？',
            buttons: [ 
				{text: '取消'},
				{text: '确定',bold: true, onClick: function(){
					var url = apirooturl + 'savepointchangemoney';
					$.post(url,{'point':jfdh_point,'jfdh_withdraw_pwd':jfdhzijinmimaput}, function(json){
							if(json.sign){
								alt('兑换积分成功',1);
							}else{
								alt(json.message,-1);
							}
					},'json'); 
				}}
			]
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
