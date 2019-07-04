var userlevel=null;
var userlevelbai = 0;//安全等级
var levelstr     = '您的账户安全级别为低，请完善安全信息';
$(function() {
	getuserlevel();
	
	// 收信箱
	chatReceList();
	
	// 获取下级用户
	getDownUserList();
	cleanSendMessageInfo();
	
	//如果没有上级则去除
	if(user && user.parentid==0)$("#downUserList dd[receiverid='up']").remove();
	
	// 回复字数变动
	$("#readMessageDiv div.srk textarea").on("keyup", function(event){
		if(event.ctrlKey && event.keyCode == 13) {
			replyMessage();
			return false;
		}
		var parentObj = $(this).parent();
		var content = $(this).val();
		if(content.length > 800) {
			content = content.substr(0, 800);
			$(this).val(content);
		}
		
		parentObj.find("span").text("剩余可输入："+(800-content.length)+"个字");
	});
	
	// 发送新消息字数变动
	$("#sendMessageContent").on("keyup", function(event){
		if(event.ctrlKey && event.keyCode == 13) {
			sendMessage();
			return false;
		}
		var parentObj = $(this).parent();
		var content = $(this).val();
		if(content.length > 800) {
			content = content.substr(0, 800);
			$(this).val(content);
		}
		
		parentObj.find("span").text("剩余可输入："+(800-content.length)+"个字");
	});
	
	// 新消息->下级全选
	$("#allDownUser").on("change", function() {
		var userList = [];
		
		if(this.checked) {
			$("input[name='downUserCheck']").prop("checked", true);
			$("#downUserList dd").each(function(){
				var userId = $(this).attr("receiverId");;
				var userName = $(this).attr("loginname");
				if(userId=="system" || userId=="up") {
					return true;
				}
				userList[userId] = userName;
			});
		} else {
			$("input[name='downUserCheck']").prop("checked", false);
		}
		
		var sendMessageUserId = "";
		var userNames = "";
		var i = 0;
		for(var user in userList) {
			i++;
			sendMessageUserId += ";" + user;
			userNames += "，<em>" + userList[user] + "</em>";
		}
		
		$("#sendMessageUserId").val(sendMessageUserId.substr(1));
		$("#sendMessageUserName").html(userNames.substr(1));
	});
	
	// 鼠标放到收件人上时
	$("#writeNewMessDiv div.fjr").hover(function() {
		$(this).addClass("m-more");
	}, function() {
		$(this).removeClass("m-more");
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

/**
 * 收件箱
 */
function chatReceList() {
	$("#writeNewMessDiv").hide();
	$("#readMessageDiv").show();
	var url = apirooturl + 'chatrecelist';
	var thisPanl = $("#chatReceList dl");
	thisPanl.empty();
	
	$.ajax({
		type: 'post',
		url: url,
		data: {},
		dataType: 'json',
		success: function(data) {
			var html = '';
			$.each(data.root, function(idx, val) {
				var chatCss = 'xj';
				if(val.senttype == 10) {
					chatCss = 'sj';
				}
				var chatname = val.sentname;
				if(!chatname) {
					chatname = '';
				}
				if(chatname == "system") {
					chatname = "客服";
					chatCss = 'gly';
				}
				var lastrecetimeName = $.format.date(val.lastrecetimeName, "MM-dd HH:mm");
				html += '<dd'+(val.rececount==val.readcount?'':' class="m-new"')+' receid="'+val.id+'" srid="'+(val.srid?val.srid:'')+'" senttype="'+val.senttype+'" chatname="'+chatname+'" chatCss="'+chatCss+'">';
				html += '<div class="l m-pic '+chatCss+'"><img src="/resources/images/icon/logo.png" alt=""></div>';
				html += '<div class="l m-nc">';
				html += '<h6>' + val.senttitle + '</h6>';
				html += '<p><em>'+chatname+'</em><span>' + lastrecetimeName + '</span></p>';
				html += '</div>';
				html += '<div class="r m-ic"><a href="javascript:;" onclick="delMessageConfirm(\'' + val.id + '\', \'r\');"><i class="dele"></i></a></div>';
				html += '</dd>';
			});
			thisPanl.append(html);
			way.set("messageReceRecords", data.records);
			
			addListener("chatReceList", 'r');
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {}
	});
}

// 添加事件监听
var currentReadMessage = null;
function addListener(id, messbox) {
	// 阅读信息
	$("#"+id+" dd").unbind("click");
	$("#"+id+" dd").on("click", function(e){
		if(e.target.nodeName.toLowerCase() == 'i') {
			return;
		}
		// 去掉未读样式
		$(this).removeClass("m-new");
		// 刷新未读消息条数
		dsFlushBalance();
		// 阅读消息
		currentReadMessage = $(this);
		readMessageBefore();
		readMessage(messbox);
	});
	
	if($("#"+id+" dd").length > 0) {
		$("#"+id+" dd").eq(0).click();
	}
}

/**
 * 阅读新的一条消息之前执行
 */
function readMessageBefore() {
	var readMessageDiv = $("#readMessageDiv");
	readMessageDiv.find("div.me-in-cen").empty();
	readMessageDiv.find("div.srk").hide();
	readMessageDiv.find("div.fs").hide();
	readMessageDiv.find("div.srk textarea").val("");
	$("#replyMessageId").val("");
	$("#replyMessageBox").val("");
}

/**
 * 读取信息
 * @param messbox 'r'为收件箱，'s'为发件箱
 */
var readMessageIndex;
function readMessage(messbox) {
	clearTimeout(readMessageIndex);
	if(currentReadMessage==null || currentReadMessage.length<1) {
		return;
	}
	var readMessageDiv = $("#readMessageDiv");
	readMessageDiv.find("div.m-s-title h6").html(currentReadMessage.find("div.m-nc h6").html()+" (<em>"+currentReadMessage.attr("chatname")+"</em>)");
	var url = apirooturl + 'chatcontext';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		data : {
			"id" : currentReadMessage.attr("receid"),
			"srid" : currentReadMessage.attr("srid"),
			"messbox" : messbox
		},
		success: function(msg) {
			if(msg.sign === true) {
				//if(currentReadMessage.attr("senttype")=='1') {
					$("#replyMessageId").val(currentReadMessage.attr("receid"));
					$("#replyMessageBox").val(messbox);
					readMessageDiv.find("div.srk").show();
					readMessageDiv.find("div.fs").show();
					var dataLength = msg.root.length;
					var ddlength = readMessageDiv.find("div.me-in-cen div.mes-itme").length;
					if(dataLength > ddlength) {
						var html = '';
						$.each(msg.root, function(idx, val){
							html += '<div class="mes-itme ';
							var position = 'r';
							var chatCss = currentReadMessage.attr("chatCss");
							if(user && user.id==val.sentid) {                                                                                       
								html += 'm-ri';
								chatCss = 'zj';
							} else {
								html += 'm-le';
								position= 'l';
							}
							html += '">';
							html += '<div class="m-pic '+position+' '+chatCss+'"><img src="/resources/images/icon/logo.png" alt=""></div>';
							
							var setcontext = val.sentcontext;
							setcontext = setcontext.replace(new RegExp(/\n/g),'<br/>');
							html += '<div class="'+position+'"><span><em class="sj">'+(val.senttime?val.senttime:'')+'<br/></em>'+setcontext+'</span></div>';
							html += '</div>';
						});
						readMessageDiv.find("div.me-in-cen").html(html);
					
						var scrollTop = readMessageDiv.find("div.me-in-cen")[0].scrollHeight;
						readMessageDiv.find("div.me-in-cen").scrollTop(scrollTop);
					}
					//readMessageIndex = setTimeout(function(){readMessage(messbox);}, 3000);
				/*} else {
					var setcontext = msg.root[0].sentcontext;
					setcontext = setcontext.replace(new RegExp(/\n/g),'<br/>');
					var html = '<div class="m-le mes-itme">';
					html += '<div class="m-pic l '+currentReadMessage.attr("chatCss")+'"><img src="/resources/images/icon/logo.png" alt=""></div>';
					html += '<div class="l"><span><em class="sj">'+(msg.root[0].senttime?msg.root[0].senttime:'')+'<br/></em>'+setcontext+'</span></div>';
					html += '</div>';
					readMessageDiv.find("div.me-in-cen").html(html);
				}*/
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {}
	});
}

/**
 * 回复信息
 */
function replyMessage() {
	var id = $("#replyMessageId").val();
	if(!id || id.length<1) {
		popTips("该消息不能回复", "waring");
		return;
	}
	
	var messbox = $("#replyMessageBox").val();
	if(!messbox || messbox.length<1) {
		popTips("该消息不能回复", "waring");
		return;
	}
	
	var context = $("#readMessageDiv div.srk textarea").val();
	if(!context || context.length<1) {
		popTips("请输入回复内容", "waring");
		return;
	}
	
	$.ajax({
		url: "/ct-data/chatRece/replay",
		type: "post",
		dataType: "json",
		data : {
			"id" : id,
			"context" : context,
			"messbox" : messbox
		},
		success: function(msg) {
			if(msg.sign === true) {
				$("#readMessageDiv div.srk textarea").val("");
				$("#readMessageDiv div.srk span").text('剩余可输入：800个字');
				readMessage(messbox);
			} else {
				popTips(msg.message, "error");
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			popTips('发送失败', "error");
		}
	});
}

/**
 * 删除提示
 * @param ids
 * @param messbox
 */
function delMessageConfirm(ids, messbox){
	closelayer();
	$("#deleteTips h4.pop-text").text("确认删除该邮件吗？");
	$("#deleteIds").val(ids);
	$("#deleteMessbox").val(messbox);
	pop("deleteTips");
}

/**
 * 删除信息
 */
function delMessage() {
	// 点击删除按钮的时候会触发阅读消息事件，所以这里先清除掉定时刷新消息内容事件
	closelayer();
	var ids = $("#deleteIds").val();
	var messbox = $("#deleteMessbox").val();

	if(!messbox) {
		popTips("删除失败", 'error');
		return;
	}
	var url;
	var data;
	if(messbox == 'r') {
		url = "/ct-data/chatRece/del";
		data = {"receid":ids};
	} else {
		url = "/ct-data/chatSent/del";
		data = {"sentid":ids};
	}
	
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		data : data,
		success: function(msg) {
			if(msg.sign === true) {
				if(messbox == 'r') {
					chatReceList();
				} else {
					chatSentList();
				}
				
				popTips(msg.message, 'succeed');
			} else {
				popTips(msg.message, 'error');
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			popTips("删除失败", 'error');
		}
	});
}
function dsFlushBalance(){
	
	
}
/**
 * 发件箱
 */
function chatSentList() {
	$("#writeNewMessDiv").hide();
	$("#readMessageDiv").show();
	var thisPanl = $("#chatSentList dl");
	thisPanl.empty();
	var url = apirooturl + 'chatsentlist';
	$.ajax({
		type: 'post',
		url: url,
		data: {},
		dataType: 'json',
		success: function(data) {
			var html = '';
			$.each(data.root, function(idx, val) {
				var chatCss = 'xj';
				if(val.senttype == 1) {
					chatCss = 'sj';
				}
				var chatname = val.recename;
				if(!chatname) {
					chatname = '';
				} if(chatname == "system") {
					chatname = "客服";
					chatCss = 'gly';
				} else if(chatname == "down") {
					chatname = '所有下级';
					chatCss = 'xj';
				}
				var senttime = $.format.date(val.senttime, "MM-dd HH:mm");
				html += '<dd'+((val.rececount==val.readcount||val.senttype!='1')?'':' class="m-new"')+' receid="'+val.id+'" srid="'+(val.sentid?val.sentid:'')+'" senttype="'+val.senttype+'" chatname="'+chatname+'" chatCss="'+chatCss+'">';
				html += '<div class="l m-pic '+chatCss+'"><img src="/resources/images/icon/logo.png" alt=""></div>';
				html += '<div class="l m-nc">';
				html += '<h6>' + val.senttitle + '</h6>';
				html += '<p><em>'+val.recename+'</em><span>' + senttime + '</span></p>';
				html += '</div>';
				html += '<div class="r m-ic"><a href="javascript:;" onclick="delMessageConfirm(\'' + val.id + '\', \'r\');"><i class="dele"></i></a></div>';
				html += '</dd>';
			});
			thisPanl.append(html);
			way.set("messageSentRecords", data.records);
			
			addListener("chatSentList", 's');
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {}
	});
}

/**
 * 获取下级用户
 */
var downUserCount = 0;
function getDownUserList() {
	if (!user) {
		setTimeout(function() {
			getDownUserList();
		}, 100);
		return;
	}
	
	if(!user || user.proxy!=1) {
		return;
	}
	
	var thisPanl = $("#downUserList dl");
	var url = apirooturl + 'getdownuser';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		success: function(msg) {
			if (msg.sign === true) {
				var users = msg.data;
				var html = '';
				
				downUserCount =  users.length;
				for(var i=0; i<downUserCount; i++){
					
					html += '<dd receiverId="'+users[i].id+'" loginname="'+users[i].username+'">';
					html += '<div class="l m-pic xj"><img src="/resources/images/icon/logo.png" alt=""></div>';
					html += '<div class="l m-nc">';
					html += '<h6>' + users[i].username + '</h6>';
					html += '</div>';
					html += '<div class="r m-ic"><input type="checkbox" name="downUserCheck" value="' + users[i].id + '"></div>';
					html += '</dd>';
				}
				
				thisPanl.append(html);
				if(downUserCount === 0) {
					way.set("downUserCount", "0");
				} else {
					way.set("downUserCount", downUserCount);
				}
			} else {
				downUserCount = 0;
				way.set("downUserCount", "0");
			}
			
			addDownUserListener();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			downUserCount = 0;
			way.set("downUserCount", "0");
		}
	});
}

/**
 * 选中用户监听
 */
function addDownUserListener() {
	$("#downUserList dd").unbind("click");
	$("#downUserList dd").on("click", function(e){
		var userList = [];
		
		var userId = $(this).attr("receiverId");
		var userName = $(this).attr("loginname");
		var sendMessageUserId = $("#sendMessageUserId").val();
		var sendMessageUserIds = sendMessageUserId.split(";");
		var sendMessageUserNames = $("#sendMessageUserName em");
		
		var deleteUser = false;
		if(userId=="system" || userId=="up") {
			cleanSendMessageReceUser(false);
			userList[userId] = userName;
		} else {
			for(var i=0; i<sendMessageUserIds.length; i++) {
				if(!sendMessageUserIds[i] || sendMessageUserIds[i]=="system" || sendMessageUserIds[i]=="up") {
					continue;
				}
				userList[sendMessageUserIds[i]] = sendMessageUserNames.eq(i).text();
			}
			
			if(sendMessageUserId.indexOf(userId) >= 0) {
				// 该用户已经在收件人列表中
				if(e.target.nodeName.toLowerCase() == "input") {
					if($(e.target).attr("name") == "downUserCheck") {
						// 如果是点击下级的checkbox，则从收件人列表中删除当前选中用户，否则不作任何操作
						deleteUser = true;
						$(this).find("div.m-ic input").prop("checked", false);
						$("#allDownUser").prop("checked", false);
					}
				} else if(userId=="system" || userId=="up") {
					deleteUser = true;
				} else {
					return false;
				}
			} else {
				$(this).find("div.m-ic input").prop("checked", true);
				userList[userId] = userName;
			}
		}
		
		sendMessageUserId = "";
		var userNames = "";
		for(var user in userList) {
			if(deleteUser && user==userId) {
				continue;
			}
			sendMessageUserId += ";" + user;
			userNames += "，<em>" + userList[user] + "</em>";
		}
		
		$("#sendMessageUserId").val(sendMessageUserId.substr(1));
		$("#sendMessageUserName").html(userNames.substr(1));
	});
}

/**
 * 打开写信页面
 */
function writeNewMessage() {
	clearTimeout(readMessageIndex);
	$("#readMessageDiv").hide();
	$("#writeNewMessDiv").show();
}

/**
 * 清空收件人信息
 */
function cleanSendMessageReceUser(isCleanMessageInfo) {
	if(isCleanMessageInfo) {
		$("#sendMessageTitle").val('');
		$("#sendMessageContent").val('');
	}
	$("#sendMessageUserId").val("");
	$("#sendMessageUserName").empty();
	$("input[name='downUserCheck']").prop("checked", false);
	$("#allDownUser").prop("checked", false);
}

/**
 * 清空
 */
function cleanSendMessageInfo() {
	cleanSendMessageReceUser(true);
	$("#writeNewMessDiv div.srk textarea").val("");
	$("#writeNewMessDiv div.srk span").text("剩余可输入：800个字");
}

/**
 * 发送消息
 */
function sendMessage() {
	var userids = $("#sendMessageUserId").val();
	if(!userids || userids.length<1) {
		alt("请选择收件人", -1);
		return false;
	}
	
	var title = $("#sendMessageTitle").val();
	if(!title || title.length<1) {
		alt("请输入主题", -1);
		return false;
	}
	
	var context = $("#sendMessageContent").val();
	if(!context || context.length<1) {
		alt("请输入内容", -1);
		return false;
	}
	var url = apirooturl + 'chatsent';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		data : {
			"title" : title,
			"context" : context,
			"userids" : userids
		},
		success: function(msg) {
			if(msg.sign) {
				cleanSendMessageReceUser(true);
				
				alt(msg.message, 1);
			} else {
				alt(msg.message, -1);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alt("发送失败", -1);
		}
	});
}

//收件箱清空
function cleanReceList() {
	closelayer();
	var ids = "";
	$("#chatReceList dd").each(function(){
		ids += $(this).attr("receid")+",";
	});
	if(!ids) {
		alt("收信箱已经清空",-1);
		return false;
	}
	$("#deleteTips h4.pop-text").text("确认清空收信箱吗？");
	$("#deleteIds").val(ids);
	$("#deleteMessbox").val("r");
	pop("deleteTips");
}

//发件箱清空
function cleanSentList() {
	closelayer();
	var ids = "";
	$("#chatSentList dd").each(function(){
		ids += $(this).attr("receid")+",";
	});
	if(!ids) {
		popTips("发信箱已经清空", "error");
		return false;
	}
	$("#deleteTips h4.pop-text").text("确认清空发信箱吗？");
	$("#deleteIds").val(ids);
	$("#deleteMessbox").val("s");
	pop("deleteTips");
}

// 消息或用户搜索
function searchMessage() {
	var word = $("#searchMessageWord").val();
	if(!word) {
		return false;
	}
	var index = $("div.m-mess-nav li.cur").index();
	if(index == 0) {
		var rightLocation = false;
		$("#chatReceList dd").each(function(){
			if($(this).attr("chatname").indexOf(word) >= 0) {
				rightLocation = true;
			}
			if(!rightLocation && $(this).find("div.m-nc h6").text().indexOf(word)>=0) {
				rightLocation = true;
			}
			
			if(rightLocation) {
				$("#chatReceList").scrollTop($(this).index()*$(this).height()); 
				currentReadMessage = $(this);
				readMessageBefore();
				readMessage('r');
				return false;
			}
		});
	} else if(index == 1) {
		var rightLocation = false;
		$("#chatSentList dd").each(function(){
			if($(this).attr("chatname").indexOf(word) >= 0) {
				rightLocation = true;
			}
			if(!rightLocation && $(this).find("div.m-nc h6").text().indexOf(word)>=0) {
				rightLocation = true;
			}
			
			if(rightLocation) {
				$("#chatSentList").scrollTop($(this).index()*$(this).height()); 
				currentReadMessage = $(this);
				readMessageBefore();
				readMessage('s');
				return false;
			}
		});
	} else if(index == 2) {
		$("#downUserList dd").each(function(){
			if($(this).find("div.m-nc h6").text().indexOf(word)>=0) {
				$("#downUserList").scrollTop($(this).index()*$(this).height()); 
				return false;
			}
		});
	}
}