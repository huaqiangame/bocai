$(function(){
	$.init();
	//nologinredict();
	usergetbankcard();
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
	
	$(document).on('click','.prompt-usereditdrawpass', function () {
      $.modal({
            title: '修改资金密码',
            text: '<input class="modal-text-input" type="password" placeholder="旧资金密码" id="usereditdrawpass_oldpassword"><input class="modal-text-input" type="password" placeholder="新资金密码" id="usereditdrawpass_password"><input class="modal-text-input" type="password" placeholder="确认密码" id="usereditdrawpass_rpassword">',
            buttons: [ 
				{text: '取消'},
				{text: '确定',bold: true, onClick: function(){
					var url = apirooturl + 'usereditdrawpass';
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
				}}
			]
        });
    });
	
	$(document).on('click','.prompt-bindrealname', function () {
      $.modal({
            title: '绑定真实姓名',
            text: '<input class="modal-text-input" type="text" placeholder="真实姓名" id="bindrealname_realname"><input class="modal-text-input" type="password" placeholder="资金密码" id="bindrealname_tradepassword">',
            buttons: [ 
				{text: '取消'},
				{text: '确定',bold: true, onClick: function(){
					
					var url = apirooturl + 'userbindrealname';
					var realname = $('#bindrealname_realname').val();
					var tradepassword = $('#bindrealname_tradepassword').val();
					var realnamepatten = /^[\u4e00-\u9fa5]{2,4}$/i;
					if(realname.match(realnamepatten)==null){
						alt('请输入真实姓名',-1);
						return false;
					}
					var passwordpatten = /^[\w\W]{4,16}$/;
					if(!passwordpatten.test(tradepassword) || tradepassword.length < 4 || tradepassword.length > 16){
						alt("请输入4-16位的资金密码!",-1);
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
								//$("#isUserbankName").removeClass('wb').addClass('yb');
								//$("#isUserbankName").find('.mark').removeAttr('onclick').css({'color':'grey'}).text('已绑定');
								//getuserlevel();
								//userlevel.userbankname=true;
								alt('绑定成功',1);
							}else{
								alt(json.message,-1);
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							alt('服务器链接失败',-1);
						}
					});
				}}
			]
        });
    });
	
	$(document).on('click','.prompt-bindphone', function () {
      $.modal({
            title: '绑定手机号码',
            text: '<input class="modal-text-input" type="text" placeholder="手机号码" id="bindphone"><input class="modal-text-input" type="password" placeholder="资金密码" id="phonetradePwd">',
            buttons: [ 
				{text: '取消'},
				{text: '确定',bold: true, onClick: function(){
					
					var url = apirooturl + 'userbindphone';
					var bindphone = $("#bindphone").val();
					var phonetradePwd = $("#phonetradePwd").val();
					var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
					if(!myreg.test(bindphone)){
						alt('请输入有效的手机号码！',-1);
						return false;
					}
					if (phonetradePwd.length < 4) {
						alt('请输入正确的资金密码！',-1);
						return false;
					}
					$.post(url,{"phone": bindphone,"tradePwd": phonetradePwd}, function(json){
						if(json.sign){
							alt('绑定成功',1);
						}else{
							alt(json.message,-1);
						}
						return false;
					},'json'); 
				}}
			]
        });
    });
	
	$(document).on('click','.prompt-bindemail', function () {
      $.modal({
            title: '绑定邮箱',
            text: '<input class="modal-text-input" type="text" placeholder="邮箱账号" id="bindemail"><input class="modal-text-input" type="password" placeholder="资金密码" id="emailtradePwd">',
            buttons: [ 
				{text: '取消'},
				{text: '确定',bold: true, onClick: function(){
					
					var url = apirooturl + 'userbindemail';
					var bindemail = $("#bindemail").val();
					var tradePwd = $("#emailtradePwd").val();
					var myreg = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
					if(!myreg.test(bindemail)){
						alt('请输入有效的邮箱账号！',-1);
						return false;
					}
					if (tradePwd.length < 4) {
						alt('请输入正确的资金密码！',-1);
						return false;
					}
					$.post(url,{"email": bindemail,"tradePwd": tradePwd}, function(json){
						if(json.sign){
							//art.dialog.list['testID2'].close();
							//$("#isEmail").removeClass('wb').addClass('yb');
							//$("#isEmail").find('.mark').removeAttr('onclick').css({'color':'grey'}).text('已绑定');
							//getuserlevel();
							alt('绑定成功',1);
						}else{
							alt(json.message,-1);
						}
						return false;
					},'json'); 
				}}
			]
        });
    });
	
//密保
	var questoken                = 0;
	var editquestion_questionone = $("#editquestion_q1").val()?$("#editquestion_q1").val():'';
	var editquestion_questiontwo = $("#editquestion_q2").val()?$("#editquestion_q2").val():'';
	var editquestion_questionthree = $("#editquestion_q3").val()?$("#editquestion_q3").val():'';

	$(document).on('click','.prompt-usersecurity', function () {
		setmibao();
    });
	function setmibao(){
		var texth = '',opts='';
		opts += '<option value="您的出生地是?">您的出生地是?</option>';
		opts += '<option value="您小学班主任的名字是?">您小学班主任的名字是?</option>';
		opts += '<option value="您中学班主任的名字是?">您中学班主任的名字是?</option>';
		opts += '<option value="您高中班主任的名字是?">您高中班主任的名字是?</option>';
		opts += '<option value="您大学班主任的名字是?">您大学班主任的名字是?</option>';
		opts += '<option value="您的小学校名是?">您的小学校名是?</option>';
		opts += '<option value="您母亲的姓名是?">您母亲的姓名是?</option>';
		opts += '<option value="您母亲的生日是?">您母亲的生日是?</option>';
		opts += '<option value="您父亲的姓名是?">您父亲的姓名是?</option>';
		opts += '<option value="您父亲的生日是?">您父亲的生日是?</option>';
		opts += '<option value="您配偶的姓名是?">您配偶的姓名是?</option>';
		opts += '<option value="您配偶的生日是?">您配偶的生日是?</option>';
		opts += '<option value="对您影响最大的人名字是?">对您影响最大的人名字是?</option>';
		opts += '<option value="您最喜欢的运动是?">您最喜欢的运动是?</option>';
		opts += '<option value="您的学号（或工号）是?">您的学号（或工号）是?</option>';
		opts += '<option value="您最喜欢的明星名字是?">您最喜欢的明星名字是?</option>';
		opts += '<option value="您最熟悉的童年好友名字是?">您最熟悉的童年好友名字是?</option>';
		
		texth += '<select class="modal-text-input" id="questionOne"  onchange="changeQuestionOne();">';
		texth += '<option value="">--请选择问题1--</option>';
		texth += opts;
		texth += '</select>';
		texth += '<input class="modal-text-input" type="text" id="answerOne" value="" placeholder="问题1答案">';
		texth += '<select class="modal-text-input" id="questionTwo" onchange="changeQuestionTwo();">';
		texth += '<option value="">--请选择问题2--</option>';
		texth += opts;
		texth += '</select>';
		texth += '<input class="modal-text-input" type="text" id="answerTwo" value="" placeholder="问题2答案">';
		texth += '<select class="modal-text-input" id="questionThree" onchange="changeQuestionThree();">';
		texth += '<option value="">--请选择问题3--</option>';
		texth += opts;
		texth += '</select>';
		texth += '<input class="modal-text-input" type="text" id="answerThree" value="" placeholder="问题3答案">';
		texth += '<input id="tradePwd" class="modal-text-input" value="" type="password" placeholder="资金密码">';
		
		texth += '<input type="hidden" id="questoken" value="'+questoken+'">';

      $.modal({
            title: '设置密保',
            text: texth,
            buttons: [ 
				{text: '取消'},
				{text: '确定',bold: true, onClick: function(){
					
					var url = apirooturl + 'usersecurity';
					var v = $("#questionOne").val();
					var v2 = $("#questionTwo").val();
					var v3 = $("#questionThree").val();
					var answerOne = $("#answerOne").val();
					var answerTwo = $("#answerTwo").val();
					var answerThree = $("#answerThree").val();
					var tradePwd = $("#tradePwd").val();
					if (v.length < 1) {
						alt('请选择密保问题1！',-1);
						return false;
					}
					if (v2.length < 1) {
						alt('请选择密保问题2！',-1);
						return false;
					}
					if (v3.length < 1) {
						alt('请选择密保问题3！',-1);
						return false;
					}
					if (v == v2 || v == v3 || v2 == v3) {
						alt('密码问题不能重复！',-1);
						return false;
					}
					if (answerOne.length < 1) {
						alt('问题1答案不能为空！',-1);
						return false;
					}
					if (answerTwo.length < 1) {
						alt('问题2答案不能为空！',-1);
						return false;
					}
					if (answerThree.length < 1) {
						alt('问题3答案不能为空！',-1);
						return false;
					}
					if (answerOne == answerTwo || answerOne == answerThree || answerTwo == answerThree) {
						alt('密保答案不能相同！',-1);
						return false;
					}
					if (tradePwd.length < 6) {
						alt('资金密码不能为空！',-1);
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
								$("#isQuestion").removeClass('prompt-usersecurity').addClass('prompt-editquestion').find(".item-title").text('修改密保');;
								editquestion_questionone = v;
								editquestion_questiontwo = v2;
								editquestion_questionthree = v3;
								//$("#editquestion_q1").val(v);$("#editquestion_q2").val(v2);$("#editquestion_q3").val(v3);
								alt('密保设置成功',1);
							}else{
								alt(json.message,-1);
							}
						},'json'); 
				}}
			]
        });
	}
	
	$(document).on('click','.prompt-editquestion', function () {
		var html = '';
		html += '<p>问题1：'+editquestion_questionone+'</p>';
		html += '<input class="modal-text-input" id="editquestionans1" type="text" value="" placeholder="答案1">';
		html += '<p>问题2：'+editquestion_questiontwo+'</p>';
		html += '<input class="modal-text-input" id="editquestionans2" type="text" value="" placeholder="答案2">';
		html += '<p>问题3：'+editquestion_questionthree+'</p>';
		html += '<input class="modal-text-input" id="editquestionans3" type="text" value="" placeholder="答案3">';
      $.modal({
            title: '修改密保',
            text: html,
            buttons: [ 
				{text: '取消'},
				{text: '确定',bold: true, onClick: function(){
					
					var url = apirooturl + 'questionanscheck';
					var editquestionans1 = $("#editquestionans1").val();
					var editquestionans2 = $("#editquestionans2").val();
					var editquestionans3 = $("#editquestionans3").val();
					if (editquestionans1.length < 1) {
						alt('问题1答案不能为空！',-1);
						return false;
					}
					if (editquestionans2.length < 1) {
						alt('问题2答案不能为空！',-1);
						return false;
					}
					if (editquestionans3.length < 1) {
						alt('问题3答案不能为空！',-1);
						return false;
					}
					$.post(url,{"editquestionans1": editquestionans1,"editquestionans2": editquestionans2,"editquestionans3": editquestionans3}, function(json){
						if(json.sign){
							//art.dialog.list['testID2'].close();
							questoken = json.questoken;
							setmibao();
							//usersecurity();
							//art.dialog.list['testID2'].title('重置密保');
							return false;
						}else{
							alt(json.message,-1);
							return false;
						}
						return false;
					},'json'); 
				}}
			]
        });
    });
	
	
});
//获取系统银行卡列表
var sysCardList=null;
var bankCardList = function() {
	var url = apirooturl + 'bankcardList';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		data:{},
		async:false,
		success: function(json) {
			if(json.sign){
				sysCardList = json.banklist;
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			
		}
	});
};
$(document).on('click','#city-picker', function () {
 $("#city-picker").cityPicker({
    toolbarTemplate: '<header class="bar bar-nav">\
    <button class="button button-link pull-right close-picker">确定</button>\
    <h1 class="title">选择开户地址</h1>\
    </header>'
  });
});

function bindcard(){
	if(!user || user.userbankname==''){
		alt('请先绑定真实姓名',-1);return false;
	}
	var html = '';
	html += '<input class="modal-text-input" type="text" readonly value="持卡人姓名:'+user.userbankname+'"/>';
	html += '<select class="modal-text-input" id="sysBankCard">';
	html += '<option value="">--请选择银行--</option>';
	if(sysCardList){
		$.each(sysCardList, function(idx, val) {
			html += '<option value="' + val.bankcode + '">' + val.bankname + '</option>';
		});
	}
	html += '</select>';
	html += '<input class="modal-text-input city-picker" type="text" placeholder="开户行地址" id="city-picker"/>';
	html += '<input class="modal-text-input" type="text" placeholder="开户行网点" id="bankBranch"/>';
	html += '<input class="modal-text-input" type="text" placeholder="银行卡号" id="bankCardNum" onkeyup="replaceAndSetPos(this,event,/[^\\d]/g,\'\');"/>';
	html += '<input class="modal-text-input" type="text" placeholder="确认卡号" id="regBankCardNum" onkeyup="replaceAndSetPos(this,event,/[^\\d]/g,\'\');"/>';
	html += '<input class="modal-text-input" type="password" placeholder="资金密码" id="bankTradPwd">';
	
  $.modal({
		title: '绑定银行卡',
		text: html,
		buttons: [ 
			{text: '取消'},
			{text: '绑定',bold: true, onClick: function(){
				var url = apirooturl + 'userbindbankcard';
			var bankCode = $("#sysBankCard").val();
			var bankCardNumber = $("#bankCardNum").val();
			var regbankCardNumber = $("#regBankCardNum").val();
			var city = $("#city-picker").val();
			var bankTradPwd = $("#bankTradPwd").val();

			// 07-11 add 开户行网点
			var bankBranch = $("#bankBranch").val();

			if (bankCode.length < 1) {
				alt("请选择银行卡",-1);return false;
			} else if (city.length < 1) {
				alt("请选择开户行",-1);return false;

			} else if (bankCardNumber.length < 1) {
				alt("请输入银行卡号",-1);return false;

			} else if (regbankCardNumber.length < 1) {
				alt("请输入确认银行卡号");return false;
			} else if (regbankCardNumber != bankCardNumber) {
				alt("两次卡号输入的不一致，请重新输入",-1);return false;
			} else if (bankTradPwd.length < 1) {
				alt("请输入资金密码",-1);return false;
			}
			var citystrs= new Array(); 
			citystrs=city.split(" ");
			var bankAddress = citystrs[0]+'-'+citystrs[1];
			$.post(url,{
				"bankCardNumber": bankCardNumber,
				"bankAddress": bankAddress,
				"bankTradPwd": bankTradPwd,
				"bankCode": bankCode,
				"regbankCardNumber": regbankCardNumber,
				"bankBranch": bankBranch
			}, function(json){
				if(json.sign){
					var bankoption = '';
					$.each(sysCardList, function(idx, val) {
						if(val.bankcode==bankCode)bankoption = val.bankname;
					});
					usergetbankcard();
					alt('银行绑定成功',1);
				}else{
					alt(json.message,-1);
					return false;
				}
				return false;
			},'json'); 
			}}
		]
	});
}
//获取已经绑定银行卡
var usergetbankcard = function(){
	var url = apirooturl + 'usergetbankcard';
	// 我的银行卡列表
	var banklistnode = $("#userbanklist");
	var html = '';
	$.post(url,{}, function(data){
		if(data.sign){
				banklistnode.empty();
				// 是否需要提示"绑定银行卡送5元"
				var haveTitle = true;
				$.each(data.banklist, function(index, val) {
					var cur = '';
					if(val.isdefault==1){
						cur = 'cur';
					}
					var mrhtml='';
					// haveBank = true;
					if(val.state == 1) {
						haveBank = true;
						haveTitle = false;
						html += '<div class="moren">';
						if (val.isdefault!=1) {
							mrhtml = '<a href="#" onclick= "defaultUserBankCard(\''+val.id+'\');">设置默认</a>';
						}else{
							mrhtml = '默认提款银行';
						}
					} else if(val.state == 2) {
						mrhtml = '驳回';
					} else if(val.state == 0) {
						mrhtml = '审核中';
					}
					html = '<li><div class="item-inner item-content"><div class="item-title-row"><div class="item-title">'+val.bankname+'</div><div class="item-after">'+mrhtml+'</div></div><div class="item-subtitle">'+val.banknumber+'</div></div></li>';
					banklistnode.append(html);

				});
		}
	},'json'); 
}
//设置默认银行卡
function defaultUserBankCard(id){
	var url = apirooturl + 'defaultuserbankcard';
      $.modal({
            title: '确定设置为默认银行卡？',
            buttons: [ 
				{text: '取消'},
				{text: '确定',bold: true, onClick: function(){
					$.post(url,{"id": id}, function(json){
							if(json.sign){
								usergetbankcard();
								alt('默认提款银行设置成功',1);
							}else{
								alt(json.message,-1);
							}
					},'json'); 
				}}
			]
        });
};

function changeQuestionOne() {
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
function changeQuestionTwo() {
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
function changeQuestionThree() {
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
