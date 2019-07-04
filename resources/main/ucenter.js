var userlevel=null;
var userlevelbai = 0;//安全等级
var levelstr     = '您的账户安全级别为低，请完善安全信息';
$(function(){
	getuserlevel();
	bankCardList();
	usergetbankcard();
});
var apirooturl = WebConfigs['ROOT'] + '/Apijiekou.';
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
					//重置修改密保问题
					changeeditquestion();
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

//绑定真实姓名
var userbindrealname = function(){
	var url = apirooturl + 'userbindrealname';
	if(userlevel.userbankname==true){
		alt('银行真实姓名已经绑定',-1);
	}
	var tiphtml = '';
	tiphtml += '<div class="submitComfire tips" style="width:250px;">';
	tiphtml += '<ul class="ui-form">';
	tiphtml += '<li><label for="question1" class="ui-label">提示：</label><span class="mark">真实姓名绑定后不得修改</span></li>';
	tiphtml += '<li><label class="ui-label">真实姓名：</label><input class="input-text inline box-shadow radius size-L" type="text" id="bindrealname_realname" way-data="bindrealname.realname"></li>';
	tiphtml += '<li><label class="ui-label">提款密码：</label><input class="input-text inline box-shadow radius size-L" type="password" id="bindrealname_tradepassword" way-data="bindrealname.tradepassword"></li>';
	tiphtml += '</ul>';
	tiphtml += '</div>';
	//alert(123);return false;
	artDialog({
		title:"绑定设置真实姓名",
		content:tiphtml,
		cancel:function(){},
		ok:function(){
			var realname = $('#bindrealname_realname').val();
			var tradepassword = $('#bindrealname_tradepassword').val();
			var realnamepatten = /^[\u4e00-\u9fa5]{2,4}$/i;
			if(realname.match(realnamepatten)==null){
				alt('请输入真实姓名',-1);
				return false;
			}
			var passwordpatten = /^[\w\W]{4,16}$/;
			if(!passwordpatten.test(tradepassword) || tradepassword.length < 4 || tradepassword.length > 16){
				alt("请输入4-16位的提款密码!",-1);
				return false;
			};
			$.ajax({
				url: url,
				type: "post",
				dataType: "json",
				data:{"realname":realname,'tradepassword':tradepassword},
				async:false,
				success: function(json) {
					if(json.sign){
						$("#isUserbankName").removeClass('wb').addClass('yb');
						$("#isUserbankName").find('.mark').removeAttr('onclick').css({'color':'grey'}).text('已绑定');
						//getuserlevel();
						userlevel.userbankname=true;
						alt('绑定成功',1);
					}else{
						alt(json.message,-1);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alt('服务器链接失败',-1);
				}
			});

		},
		lock:true
	});
};

//修改密码
var usereditpass = function(){
	var url = apirooturl + 'usereditpass';
	var tiphtml = '';
	tiphtml += '<div class="submitComfire tips" style="width:250px;">';
	tiphtml += '<ul class="ui-form">';
	tiphtml += '<li><label for="question1" class="ui-label">提示：</label><span class="mark">密码由6至16个字符组成</span></li>';
	tiphtml += '<li><label class="ui-label">旧密码：</label><input class="input-text inline box-shadow radius size-L" type="password" id="usereditpass_oldpassword" way-data="usereditpass.oldpassword"></li>';
	tiphtml += '<li><label class="ui-label">新密码：</label><input class="input-text inline box-shadow radius size-L" type="password" id="usereditpass_password" way-data="usereditpass.password"></li>';
	tiphtml += '<li><label class="ui-label">确认密码：</label><input class="input-text inline box-shadow radius size-L" type="password" id="usereditpass_rpassword" way-data="usereditpass.rpassword"></li>';
	tiphtml += '</ul>';
	tiphtml += '</div>';
	artDialog({
		title:"修改密码",
		content:tiphtml,
		cancel:function(){},
		ok:function(){
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

		},
		lock:true
	});
}

//修改提款密码
var usereditdrawpass = function(){
	var url = apirooturl + 'usereditdrawpass';
	var tiphtml = '';
	tiphtml += '<div class="submitComfire tips" style="width:250px;">';
	tiphtml += '<ul class="ui-form">';
	tiphtml += '<li><label for="question1" class="ui-label">提示：</label><span class="mark">密码由4至16个字符组成</span></li>';
	tiphtml += '<li><label class="ui-label">旧提款密码：</label><input class="input-text inline box-shadow radius size-L" type="password" id="usereditdrawpass_oldpassword" way-data="usereditdrawpass.oldpassword"></li>';
	tiphtml += '<li><label class="ui-label">新提款密码：</label><input class="input-text inline box-shadow radius size-L" type="password" id="usereditdrawpass_password" way-data="usereditdrawpass.password"></li>';
	tiphtml += '<li><label class="ui-label">确认密码：</label><input class="input-text inline box-shadow radius size-L" type="password" id="usereditdrawpass_rpassword" way-data="usereditdrawpass.rpassword"></li>';
	tiphtml += '</ul>';
	tiphtml += '</div>';
	artDialog({
		title:"修改提款密码",
		content:tiphtml,
		cancel:function(){},
		ok:function(){
			var oldpassword = $('#usereditdrawpass_oldpassword').val();
			var password = $('#usereditdrawpass_password').val();
			var rpassword = $('#usereditdrawpass_rpassword').val();
			var passwordpatten = /^[\w\W]{4,16}$/;
			if(oldpassword.length < 4 || oldpassword.length > 16){
				alt("旧密码格式不正确(由4至16个字符组成)"+oldpassword,-1);
				return false;
			}
			if(!passwordpatten.test(password) || password.length < 4 || password.length > 16){
				alt("新密码格式不正确(由4至16个字符组成)",-1);
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

		},
		lock:true
	});
}


//绑定银行卡
var userbindbankcard = function(){
	if(userlevel.userbankname==false){
		alt('请先绑定银行真实姓名',-1);
	}
	var url = apirooturl + 'userbindbankcard';
	artDialog({
		id: 'testID2',
		title:"添加绑定银行卡",
		content:$("#addyinh").html(),
		cancel:function(){},
		ok:function(){
			var bankCode = $("#sysBankCard").val();
			var bankCardNumber = $("#bankCardNum").val();
			var regbankCardNumber = $("#regBankCardNum").val();
			var province = $("#province").val();
			var city = $("#city").val();
			var bankTradPwd = $("#bankTradPwd").val();

			// 07-11 add 开户行网点
			var bankBranch = $("#bankBranch").val();
			bankBranch = bankBranch?bankBranch:"";

			if (bankCode.length < 1) {
				alert("请选择银行卡");return false;
			} else if (province.length < 1 || city.length < 1) {
				alert("请选择开户行");return false;

			} else if (bankCardNumber.length < 1) {
				alert("请输入银行卡号");return false;

			} else if (regbankCardNumber.length < 1) {
				alert("请输入确认银行卡号");return false;
			} else if (regbankCardNumber != bankCardNumber) {
				alert("两次卡号输入的不一致，请重新输入");return false;
			} else if (bankTradPwd.length < 1) {
				alert("请输入提款密码");return false;
			}
			var bankAddress = province + "-" + city;
			$.post(url,{
				"bankCardNumber": bankCardNumber,
				"bankAddress": bankAddress,
				"bankTradPwd": bankTradPwd,
				"bankCode": bankCode,
				"regbankCardNumber": regbankCardNumber,
				"bankBranch": bankBranch
			}, function(json){
				if(json.sign){
					usergetbankcard();
					alt('银行绑定成功',1);
				}else{
					alt(json.message,-1);
					return false;
				}
				return false;
			},'json'); 

		},
		lock:true
	});
}
//获取系统银行卡列表
var bankCardList = function() {
	var url = apirooturl + 'bankcardList';
	var sysBankCard = $("#sysBankCard");
	sysBankCard.empty();
	var html = '<option value="">请选择</option>';
	$.post(url,{}, function(json){
		if(json.sign){
				$.each(json.banklist, function(idx, val) {
					html += '<option value="' + val.bankcode + '">' + val.bankname + '</option>';
				});
				sysBankCard.html(html);
		}
	},'json'); 
};

//获取已经绑定银行卡
var usergetbankcard = function(){
	var url = apirooturl + 'usergetbankcard';
	// 我的银行卡列表
	var bdyhk = $(".m-bdyhk").find(".mar-lr16");
	// 我的银行卡弹窗里的银行卡列表
	var ckyinh = $("#ckyinh .tishik");
	var html = '';
	$.post(url,{}, function(data){
		if(data.sign){
				bdyhk.empty();
				ckyinh.empty();
				// 是否需要提示“绑定银行卡送5元”
				var haveTitle = true;
				$.each(data.banklist, function(index, val) {
					//var html = '<dd><div class="yhk" onclick="detailUserBank(\'' + val.id + '\');"><div class="img ym-gl">' +
					//	'<img src="/Template/default/resources/images/member/yh/' + val.bankLogo + '" height="35" width="35" alt="">' +
					//	'</div><div class="xx ym-gl"><span>' + val.bankName + '</span>' +
					//	'<span>' + val.bankUserName + '&nbsp;&nbsp&nbsp;&nbsp' + val.bankCardNumber + '</span></div></div>';
					var cur = '';
					if(val.isdefault==1){
						cur = 'cur';
					}
					var html = '<li class="'+cur+'"><div onclick="detailUserBank(\'' + val.id + '\');"><img src="'+WebConfigs["ROOT"]+'/resources/images//bank/' + val.banklogo +
						'" alt="" width="28" height="28"><span>' + val.bankname + '</span><span>' + val.banknumber + '</span><i></i></div>';
					// haveBank = true;
					if(val.state == 1) {
						haveBank = true;
						haveTitle = false;
						html += '<div class="moren">';
						if (val.isDefault!=1) {
							html += '<label for = "'+val.id+'"><span> 默认 </span></label > ' +
							'<input id="'+val.id+'" name="'+val.id+'" type="radio" onchange= "defaultUserBankCard(\'' + val.id + '\');">';
						}else{
							html += '<label for = "'+val.id+'"><span> 默认 </span></label > ' +
							'<input id="'+val.id+'" name="'+val.id+'" type="radio" checked = "checked">';
						}
						html += '</div>';
					} else if(val.state == 2) {
						html += '<div class="moren">驳回</div>';
					} else if(val.state == 0) {
						haveTitle = false;
						html += '<div class="moren">审核中</div>';
					}
					html += '</li>';
					bdyhk.append(html);

					if(!val.bankbranch){
						val.bankbranch = '';
					}
					var detailHtml = '';
					detailHtml += '<dl class="validate-form" id="ck_' + val.id + '" style="display:none;">';
					detailHtml += '<dt>';
					detailHtml += '<span class="tt">状态：</span>';
					if(val.state == 1) {
						detailHtml += '<span>可用</span>';
					} else if(val.state == 2) {
						detailHtml += '<span class="dred">驳回</span>';
					} else if(val.state == 0) {
						detailHtml += '<span class="dred">审核中...</span>';
					}
					detailHtml += '</dt>';
					detailHtml += '<dd>';
					detailHtml += '<span class="tt">持卡人姓名：</span>';
					detailHtml += '<span>' + val.accountname + '</span>';
					detailHtml += '</dd>';
					detailHtml += '<dd>';
					detailHtml += '<span class="tt">所属银行：</span>';
					detailHtml += '<span class="xzyh">' + val.bankname + '</span>';
					detailHtml += '</dd>';
					detailHtml += '<dd>';
					detailHtml += '<span class="tt">银行卡号：</span>';
					detailHtml += '<span>' + val.banknumber + '</span>';
					detailHtml += '</dd>';
					detailHtml += '<dd>';
					detailHtml += '<span class="tt">开户行地址：</span>';
					detailHtml += '<span>' + val.bankaddress + '</span>';
					detailHtml += '</dd>';
					detailHtml += '<dd>';
					detailHtml += '<span class="tt">开户行网点：</span>';
					detailHtml += '<span>' + val.bankbranch + '</span>';
					detailHtml += '</dd>';
					detailHtml += '</dl>';
					ckyinh.append(detailHtml);
				});
				if (data.banklist.length < data.sysBankMaxNum) {
					var addHtml = '<li class="add-back" onclick="userbindbankcard();">';
					addHtml += '<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;添加银行卡</li>';
					bdyhk.append(addHtml);
				}
		}
	},'json'); 
}
// 查看银行卡
var detailUserBank = function(id) {
	$("#delUserBankId").val(id);
	$("#ckyinh .tishik dl").hide();
	$("#ckyinh .tishik dl#ck_" + id).show();

	// 添加修改银行卡信息事件
	$('#updateBankInfoId').attr('onclick','updateBankInfo("'+id+'")');
	$('#updateBankInfoId').html('修改');
	$('#ckyinh_tips').html('查看银行卡');
	$('#ck_' + id).find('dd').eq(3).show();
	$('#ck_' + id).find('dd').eq(4).show();

	artDialog({
		id: 'testID2',
		title:"查看银行卡",
		content:$("#ckyinh").html(),
		cancel:function(){},
		ok:false,
		lock:true
	});
};
//设置默认银行卡
var defaultUserBankCard = function(id) {
	var url = apirooturl + 'defaultuserbankcard';
	jQuery.ajax({
		url: url,
		type: 'POST',
		data:{"id": id},
		dataType: 'json',
		success: function(data) {
			if (data.sign) {
				usergetbankcard();
				return false;
			} else {
				alt(data.message, -1);
			}
		},
		error: function(xhr, textStatus, errorThrown) {
			alt('系统出现错误，请联系管理员',-1);
		}
	});
};

//修改绑定银行卡
var usereditbankcard = function(){
	
}

//设置密保
var usersecurity = function(){

	var url = apirooturl + 'usersecurity';
/*	$("#questionOne").val("");
	$("#questionTwo").val("");
	$("#questionThree").val("");
	$("#answerOne").val("");
	$("#answerTwo").val("");
	$("#answerThree").val("");
	$("#tradePwd").val("");
	$("#questionOne").children('option').css("display", "block");
	$("#questionTwo").children('option').css("display", "block");
	$("#questionThree").children('option').css("display", "block");
	artDialog({
		id: 'testID2',
		title:"设置密保",
		content:$("#szmmbh").html(),
		cancel:function(){},
		ok:function(){*/
			var v = $("#questionOne").val();
			var v2 = $("#questionTwo").val();
			var v3 = $("#questionThree").val();
			var answerOne = $("#answerOne").val();
			var answerTwo = $("#answerTwo").val();
			var answerThree = $("#answerThree").val();
			var tradePwd = $("#tradePwd").val();
			if (v.length < 1) {
				alt('请选择密保问题1！');
				return false;
			}
			if (v2.length < 1) {
				alt('请选择密保问题2！');
				return false;
			}
			if (v3.length < 1) {
				alt('请选择密保问题3！');
				return false;
			}
			if (v == v2 || v == v3 || v2 == v3) {
				alt('密码问题不能重复！');
				return false;
			}
			if (answerOne.length < 1) {
				alt('问题1答案不能为空！');
				return false;
			}
			if (answerTwo.length < 1) {
				alt('问题2答案不能为空！');
				return false;
			}
			if (answerThree.length < 1) {
				alt('问题3答案不能为空！');
				return false;
			}
			if (answerOne == answerTwo || answerOne == answerThree || answerTwo == answerThree) {
				alt('密保答案不能相同！');
				return false;
			}
			if (tradePwd.length < 6) {
				alt('提款密码不能为空！');
				return false;
			}
		$.post(
		url,
		{
			"questionOne": v,
			"answerOne": answerOne,
			"questionTwo": v2,
			"answerTwo": answerTwo,
			"questionThree": v3,
			"answerThree": answerThree,
			"tradePwd": tradePwd,
			"questoken":$("#questoken").val()
		}
		, function(json){
				if(json.sign){
					$("#isQuestion").removeClass('wb').addClass('yb');
					$("#isQuestion").find('.mark').removeAttr('onclick').attr('onclick','userseditecurity()').css({'color':'grey'}).text('修改密保');
					alt('密保设置成功',1);
					window.location.href = MEMBER ;
/*					way.set("editquestion.questionone",v);
					way.set("editquestion.questiontwo",v2);
					way.set("editquestion.questionthree",v3);
					getuserlevel();*/
				}else{
					alt(json.message,-1);
				}
			},'json');

	/*		},
		lock:true
	});*/
}
var changeeditquestion = function(){
	var url = apirooturl + 'changeeditquestion';
	$.getJSON(url, function(json){
		if(json.sign==true){
			way.set("editquestion", json.question);
		}else{
			
		};
	});
}
			//usersecurity();
//修改密保
var userseditecurity = function(){
	var url = apirooturl + 'questionanscheck';
/*	artDialog({
		id: 'testID2',
		title:"修改密保验证",
		content:$("#xgmmbh").html(),
		cancel:function(){},d980914e0009c0b03e7fb3bbc4518b7e
		ok:function(){*/
			var editquestionans1 = $("#editquestionans1").val();
			var editquestionans2 = $("#editquestionans2").val();
			var editquestionans3 = $("#editquestionans3").val();
			if (editquestionans1.length < 1) {
				alt('问题1答案不能为空！');
				return false;
			}
			if (editquestionans2.length < 1) {
				alt('问题2答案不能为空！');
				return false;
			}
			if (editquestionans3.length < 1) {
				alt('问题3答案不能为空！');
				return false;
			}
			$.post(url,{"editquestionans1": editquestionans1,"editquestionans2": editquestionans2,"editquestionans3": editquestionans3}, function(json){
				if(json.sign){ 
					$("#questoken").val(json.questoken);
					// usersecurity();
					// art.dialog.list['testID2'].title('重置密保');
					alt('验证成功');
					  window.location.href = WebConfigs["ROOT"]+"/Member.setProblem.questoken." +json.questoken;
					return false;
				}else{
					alt(json.message,-1);
					return false;
				}
				return false;
			},'json'); 

/*		},
		lock:true
	});*/
}

//绑定邮箱
var userbindemail = function(){
	var url = apirooturl + 'userbindemail';
	artDialog({
		id: 'testID2',
		title:"绑定邮箱",
		content:$("#emailsj").html(),
		cancel:function(){},
		ok:function(){
			var bindemail = $("#bindemail").val();
			var tradePwd = $("#emailtradePwd").val();
			var myreg = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
			if(!myreg.test(bindemail)){
				alert('请输入有效的邮箱账号！');
				return false;
			}
			if (tradePwd.length < 4) {
				alert('请输入正确的提款密码！');
				return false;
			}
			$.post(url,{"email": bindemail,"tradePwd": tradePwd}, function(json){
				if(json.sign){
					//art.dialog.list['testID2'].close();
					$("#isEmail").removeClass('wb').addClass('yb');
					$("#isEmail").find('.mark').removeAttr('onclick').css({'color':'grey'}).text('已绑定');
					getuserlevel();
					alt('绑定成功',1);
				}else{
					alt(json.message,-1);
				}
				return false;
			},'json'); 

		},
		lock:true
	});
}

//绑定手机号码
var userbindphone = function(){
	var url = apirooturl + 'userbindphone';
	artDialog({
		id: 'testID2',
		title:"绑定手机号码",
		content:$("#jihuosj").html(),
		cancel:function(){},
		ok:function(){
			var bindphone = $("#bindphone").val();
			var phonetradePwd = $("#phonetradePwd").val();
			var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
			if(!myreg.test(bindphone)){
				alert('请输入有效的手机号码！');
				return false;
			}
			if (phonetradePwd.length < 4) {
				alert('请输入正确的提款密码！');
				return false;
			}
			$.post(url,{"phone": bindphone,"tradePwd": phonetradePwd}, function(json){
				if(json.sign){
					//art.dialog.list['testID2'].close();
					$("#isPhone").removeClass('wb').addClass('yb');
					$("#isPhone").find('.mark').removeAttr('onclick').css({'color':'grey'}).text('已绑定');
					getuserlevel();
					alt('绑定成功',1);
				}else{
					alt(json.message,-1);
				}
				return false;
			},'json'); 

		},
		lock:true
	});
}

var changeQuestionOne = function() {
	var v = $("#questionOne").val();
	var v2 = $("#questionTwo").val();
	var v3 = $("#questionTwo").val();
	var option2 = $("#questionTwo").find('option');
	var option3 = $("#questionThree").find('option');
	var i;
	for (i = 0; i < option2.length; i++) {
		if (option2.eq(i).val() == v || option2.eq(i).val() == v2) {
			option2.eq(i).css("display", "none");
		} else {
			option2.eq(i).css("display", "block");
		}
	}
	for (i = 0; i < option3.length; i++) {
		if (option3.eq(i).val() == v || option2.eq(i).val() == v3) {
			option3.eq(i).css("display", "none");
		} else {
			option3.eq(i).css("display", "block");
		}
	}
};
var changeQuestionTwo = function() {
	var v = $("#questionOne").val();
	var v2 = $("#questionTwo").val();
	var v3 = $("#questionTwo").val();
	var option1 = $("#questionOne").find('option');
	var option3 = $("#questionThree").find('option');
	var i;
	for (i = 0; i < option1.length; i++) {
		if (option1.eq(i).val() == v2 || option1.eq(i).val() == v3) {
			option1.eq(i).css("display", "none");
		} else {
			option1.eq(i).css("display", "block");
		}
	}
	for (i = 0; i < option3.length; i++) {
		if (option3.eq(i).val() == v2 || option1.eq(i).val() == v) {
			option3.eq(i).css("display", "none");
		} else {
			option3.eq(i).css("display", "block");
		}
	}
};
var changeQuestionThree = function() {
	var v = $("#questionOne").val();
	var v2 = $("#questionTwo").val();
	var v3 = $("#questionThree").val();
	var option1 = $("#questionOne").find('option');
	var option2 = $("#questionTwo").find('option');
	var i;
	for (i = 0; i < option1.length; i++) {
		if (option1.eq(i).val() == v2 || option1.eq(i).val() == v3) {
			option1.eq(i).css("display", "none");
		} else {
			option1.eq(i).css("display", "block");
		}
	}
	for (i = 0; i < option2.length; i++) {
		if (option2.eq(i).val() == v || option1.eq(i).val() == v3) {
			option2.eq(i).css("display", "none");
		} else {
			option2.eq(i).css("display", "block");
		}
	}
};

var sf = [];
sf[0] = new Array("北京市", "东城|西城|崇文|宣武|朝阳|丰台|石景山|海淀|门头沟|房山|通州|顺义|昌平|大兴|平谷|怀柔|密云|延庆");
sf[1] = new Array("上海市", "黄浦|卢湾|徐汇|长宁|静安|普陀|闸北|虹口|杨浦|闵行|宝山|嘉定|浦东|金山|松江|青浦|南汇|奉贤|崇明");
sf[2] = new Array("天津市", "和平|东丽|河东|西青|河西|津南|南开|北辰|河北|武清|红挢|塘沽|汉沽|大港|宁河|静海|宝坻|蓟县");
sf[3] = new Array("重庆市", "万州|涪陵|渝中|大渡口|江北|沙坪坝|九龙坡|南岸|北碚|万盛|双挢|渝北|巴南|黔江|长寿|綦江|潼南|铜梁 |大足|荣昌|壁山|梁平|城口|丰都|垫江|武隆|忠县|开县|云阳|奉节|巫山|巫溪|石柱|秀山|酉阳|彭水|江津|合川|永川|南川");
sf[4] = new Array("河北省", "石家庄|邯郸|邢台|保定|张家口|承德|廊坊|唐山|秦皇岛|沧州|衡水");
sf[5] = new Array("山西省", "太原|大同|阳泉|长治|晋城|朔州|吕梁|忻州|晋中|临汾|运城");
sf[6] = new Array("内蒙古自治区", "呼和浩特|包头|乌海|赤峰|呼伦贝尔盟|阿拉善盟|哲里木盟|兴安盟|乌兰察布盟|锡林郭勒盟|巴彦淖尔盟|伊克昭盟");
sf[7] = new Array("辽宁省", "沈阳|大连|鞍山|抚顺|本溪|丹东|锦州|营口|阜新|辽阳|盘锦|铁岭|朝阳|葫芦岛");
sf[8] = new Array("吉林省", "长春|吉林|四平|辽源|通化|白山|松原|白城|延边");
sf[9] = new Array("黑龙江省", "哈尔滨|齐齐哈尔|牡丹江|佳木斯|大庆|绥化|鹤岗|鸡西|黑河|双鸭山|伊春|七台河|大兴安岭");
sf[10] = new Array("江苏省", "南京|镇江|苏州|南通|扬州|盐城|徐州|连云港|常州|无锡|宿迁|泰州|淮安");
sf[11] = new Array("浙江省", "杭州|宁波|温州|嘉兴|湖州|绍兴|金华|衢州|舟山|台州|丽水");
sf[12] = new Array("安徽省", "合肥|芜湖|蚌埠|马鞍山|淮北|铜陵|安庆|黄山|滁州|宿州|池州|淮南|巢湖|阜阳|六安|宣城|亳州");
sf[13] = new Array("福建省", "福州|厦门|莆田|三明|泉州|漳州|南平|龙岩|宁德");
sf[14] = new Array("江西省", "南昌市|景德镇|九江|鹰潭|萍乡|新馀|赣州|吉安|宜春|抚州|上饶");
sf[15] = new Array("山东省", "济南|青岛|淄博|枣庄|东营|烟台|潍坊|济宁|泰安|威海|日照|莱芜|临沂|德州|聊城|滨州|菏泽");
sf[16] = new Array("河南省", "郑州|开封|洛阳|平顶山|安阳|鹤壁|新乡|焦作|濮阳|许昌|漯河|三门峡|南阳|商丘|信阳|周口|驻马店|济源");
sf[17] = new Array("湖北省", "武汉|宜昌|荆州|襄樊|黄石|荆门|黄冈|十堰|恩施|潜江|天门|仙桃|随州|咸宁|孝感|鄂州");
sf[18] = new Array("湖南省", "长沙|常德|株洲|湘潭|衡阳|岳阳|邵阳|益阳|娄底|怀化|郴州|永州|湘西|张家界");
sf[19] = new Array("广东省", "广州|深圳|珠海|汕头|东莞|中山|佛山|韶关|江门|湛江|茂名|肇庆|惠州|梅州|汕尾|河源|阳江|清远|潮州|揭阳|云浮");
sf[20] = new Array("广西壮族自治区", "南宁|柳州|桂林|梧州|北海|防城港|钦州|贵港|玉林|南宁地区|柳州地区|贺州|百色|河池");
sf[21] = new Array("海南省", "海口|三亚");
sf[22] = new Array("四川省", "成都|绵阳|德阳|自贡|攀枝花|广元|内江|乐山|南充|宜宾|广安|达川|雅安|眉山|甘孜|凉山|泸州");
sf[23] = new Array("贵州省", "贵阳|六盘水|遵义|安顺|铜仁|黔西南|毕节|黔东南|黔南");
sf[24] = new Array("云南省", "昆明|大理|曲靖|玉溪|昭通|楚雄|红河|文山|思茅|西双版纳|保山|德宏|丽江|怒江|迪庆|临沧");
sf[25] = new Array("西藏自治区", "拉萨|日喀则|山南|林芝|昌都|阿里|那曲");
sf[26] = new Array("陕西省", "西安|宝鸡|咸阳|铜川|渭南|延安|榆林|汉中|安康|商洛");
sf[27] = new Array("甘肃省", "兰州|嘉峪关|金昌|白银|天水|酒泉|张掖|武威|定西|陇南|平凉|庆阳|临夏|甘南");
sf[28] = new Array("宁夏回族自治区", "银川|石嘴山|吴忠|固原");
sf[29] = new Array("青海省", "西宁|海东|海南|海北|黄南|玉树|果洛|海西");
sf[30] = new Array("新疆维吾尔族自治区", "乌鲁木齐|石河子|克拉玛依|伊犁|巴音郭勒|昌吉|克孜勒苏柯尔克孜|博尔塔拉|吐鲁番|哈密|喀什|和田|阿克苏");
sf[31] = new Array("香港特别行政区", "香港特别行政区");
sf[32] = new Array("澳门特别行政区", "澳门特别行政区");
sf[33] = new Array("台湾省", "台北|高雄|台中|台南|屏东|南投|云林|新竹|彰化|苗栗|嘉义|花莲|桃园|宜兰|基隆|台东|金门|马祖|澎湖");
sf[34] = new Array("其它", "北美洲|南美洲|亚洲|非洲|欧洲|大洋洲");
var changePre = function() {
	var citySel = $("#city");
	citySel.empty();
	citySel.append('<option value="">请选择</option>');
	var pro = $("#province").val();
	var i, j, tmpcity = [];
	var city = "";
	var b = false;
	for (i = 0; i < sf.length; i++) {
		if (pro == sf[i][0].toString()) {
			b = true;
			tmpcity = sf[i][1].split("|");
			for (j = 0; j < tmpcity.length; j++) {
				if (j === 0) {
					city = tmpcity[j];
				}
				citySel.append("<option >" + tmpcity[j] + "</option>");
			}
		}
	}
};
