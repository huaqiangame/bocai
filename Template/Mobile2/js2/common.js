var host = '//' + window.location.host;
// var host = WebConfigs['ROOT'] ;
var apirooturl = host + '/Apijiekou.';
var kefuurl = '//tb.53kf.com/kfimg.php?arg=10144747&style=1',
	qqkefu  = '//wpa.qq.com/msgrd?v=3&uin=123456789&site=qq&menu=yes';
var user=null,inituser=false,lotterylist=null;
var getUserInfoTimeOutId;
var jqueryGridPage = 1;
var jqueryGridRows = 10;
var webheadertitle = '';
$(function(){
	$.init();
	//getLottery();
	checkislogin();
	//tab切换
	function tabs(tabTit,on,tabCon){
      $(tabCon).each(function(){
        $(this).children().eq(0).addClass(on).show();
    });
       $(tabTit).children().click(function(){
          $(this).addClass(on).siblings().removeClass(on);
           var index = $(tabTit).children().index(this);
           $(tabCon).children().eq(index).show().siblings().hide();
      });
       }
    tabs(".tabHd","cur",".tabBd");
	
});
var WebConfigs
/*
function getConfig(){//kefuthree
	var url = apirooturl + 'webconfigs';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		async:false,
		success: function(data) {
			if (data.sign === true) {
				WebConfigs = data.webconfigs;
			} else {
				WebConfigs = null;
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
		}
	});
}*/
function lianxikefu(kefulink){
	//alert(WebConfigs.kefuthree);
	window.open(kefulink); 
	
}
function ggcontent(id){
	$.post(host+"/Home.Index.gonggao", {'id':id}, function(data) {
		if(data.sign==true){
			art.dialog({
				id: 'testID2',
				title: '平台公告',
				content: '<div style="border-bottom:1px solid #ddd;height:40px; line-height:40px;"><p style="float:left; font-size:16px;">'+data.data.title+'</p><p style="float:right">'+data.data.oddtime+'</p></div><div style="padding:10px;">'+data.data.content+'</div>',
				lock: true,
				cancelVal: '关闭',
				cancel: true
			});
		}
	},'json');
}
var getBillInfo = function(trano){
	var url = apirooturl + 'gettouzhuinfo';
	$.post(url, {'trano':trano}, function(data) {
		if(data.sign==true){
			if(data.BillInfo.isdraw==1){
				data.BillInfo.state='<t style="color:green">已中奖</t>';
			}else if(data.BillInfo.isdraw==-1){
				data.BillInfo.state='<t style="color:red">未中奖</t>';
			}else if(data.BillInfo.isdraw==0){
				data.BillInfo.state='<t style="color:grey">未开奖</t>';
			}else if(data.BillInfo.isdraw==-2){
				data.BillInfo.state='<del style="color:grey">已撤单</del>';
			}
			  var html = '';
			  html += '<div class="clearfix"><div class="pull-left" style="width:100px;">彩种:</div><div class="pull-left">'+data.BillInfo.cptitle+'</div></div>';
			  html += '<div class="clearfix"><div class="pull-left" style="width:100px;">期号:</div><div class="pull-left" way-data="showExpect.currFullExpect">'+data.BillInfo.expect+'</div></div>';
			  html += '<div class="clearfix"><div class="pull-left" style="width:100px;">玩法:</div><div style="margin-left:100px; text-align: left;white-space:normal;word-break:break-all;">'+data.BillInfo.playtitle+'(赔率:'+data.BillInfo.mode+')</div></div>';
			  html += '<div class="clearfix"><div class="pull-left" style="width:100px;">内容:</div><div style="margin-left:0; text-align: left;white-space:normal;word-break:break-all;word-wrap:break-word:;">'+data.BillInfo.tzcode+'</div></div>';
			  html += '<div class="clearfix"><div class="pull-left" style="width:100px;">金额:</div><div style="margin-left:100px; text-align: left;white-space:normal;word-break:break-all;">'+data.BillInfo.amount+'(注数:'+data.BillInfo.itemcount+')</div></div>';
			  html += '<div class="clearfix"><div class="pull-left" style="width:100px;">开奖:</div><div style="margin-left:100px; text-align: left;white-space:normal;word-break:break-all;">'+data.BillInfo.opencode+'</div></div>';
			  html += '<div class="clearfix"><div class="pull-left" style="width:100px;">状态:</div><div style="margin-left:100px; text-align: left;white-space:normal;word-break:break-all;">'+data.BillInfo.state+'</div></div>';
			if(data.BillInfo.isdraw!=0){
			  $.modal({
					text: html,
					buttons: [ 
						{text: '关闭'}
					]
				});
			}else{
			  $.modal({
					text: html,
					buttons: [ 
						{text: '关闭'},
						{text: '撤单',bold: true, onClick: function(){
							$.post(apirooturl + 'chedan',{"trano":trano}, function(json){
								if(json.sign){
									//$("#"+trano+" td:first a").attr('href','javascript:void(0)');
									$("#"+trano+" .state").html('<del>已撤单</del>');
									alt('撤单成功',1);
								}else{
									alt(json.message,-1);
								}
							},'json'); 
						}}
					]
				});
			}
		}else if(data.sign==false){
			alt(data.message,-1);
		}
	},'json');
};
//检测是否登陆
var checkislogin = function(){
	var url = apirooturl + 'checkislogin';
	clearTimeout(getUserInfoTimeOutId);
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		async:false,
		success: function(data) {
			if (data.sign === true) {
				inituser = true;
				/*if(!data.UserUser.username) {
					data.UserUser.username = data.UserUser.username;
				}*/
				if(data.data.nickname){
					data.data.username = data.data.nickname;
				}
				user = data.data;
				way.set("user", user);
				//logindiv();
				getUserInfoTimeOutId = setTimeout(function() {
					checkislogin();
				}, 20000);
			} else {
				user = null;
				//logindiv();
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			inituser = true;

			getUserInfoTimeOutId = setTimeout(function() {
				checkislogin();
			}, 20000);
		}
	});
}
var nologinredict = function(){
	if(user){
		if(user.islogin==1){
			//$.toast('操作成功，正在跳转...', 2000000, 'success top');
		}else if(user.islogin==-1){//别的地方登陆
			$.alert("您的账号在别的地方登陆", function () {
				window.location.href = '/';
			});
		}else if(user.islogin==-2){//登陆超时
			$.alert("登陆超时", function () {
				window.location.href = '/';
			});
		}else{//其他做未登陆处理
			$.alert("请先登陆", function () {
				window.location.href = '/';
			});
		}
	}else{
			/*$.alert("您还未登陆",  function () {
				window.location.href = '/';
			});*/
	}
}
//刷新验证码
function refreshValicode(obj) {
	$(obj).attr("src", $(obj).attr('src')+"?" + (new Date()).getTime());
}
//获取彩票
var getLottery = function(){
	var url = apirooturl + 'getLottery';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		async:false,
		success: function(data) {
			if (data.sign === true) {
				lotterylist = data.data;
				/*var menuhtml = '',panner = $("#lottery_menu_list");
				for(var o in lotterylist){
					menuhtml += '<li>';
					menuhtml += '<a href="'+host+'/Game.k3?code='+lotterylist[o].name+'">';
					menuhtml += '<img src="/resources/images/game/img1.png" width="26" height="26">';
					
					menuhtml += '<i>'+lotterylist[o].title+'</i><em>'+lotterylist[o].ftitle+'</em>';
					menuhtml += '</a></li>';
				};
				panner.html(menuhtml);
				if( typeof index_list_tag === 'function' )index_list_tag(lotterylist);
				if( typeof index_cplist === 'function' )index_cplist(lotterylist);
				//if( typeof lotter_list_nav === 'function' )lotter_list_nav(lotterylist);
				if( typeof getlotterylist === 'function' )getlotterylist(lotterylist);//会员中心
				*/
			} else {
				alt(data.message,-1);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			InfoTimeOutId = setTimeout(function() {
				getLottery();
			}, 3000);
		}
	});
}
//获取玩法
var getLotterywf = function(){
	var url = apirooturl + '.ApiInterface.checkislogin';
}
//获取彩种当前期号、时间
var getLotterytimes = function(){
	
}

//获取彩种标识，期号获取开奖号码
var getLotterycode = function(lotname,expect){
	var url = apirooturl + 'getLotterycode';
	$.post(url, {'lotname':lotname,'expect':expect}, function(data) {
		if(data.sign==true){
			info = data.data;
			return info;
		}else if(data.sign==false){
			alt(data.message,-1);
		}
	},'json');
}



function alt(content,icon){
	if(icon==1){
		$.toast(content, 2000, 'success');
	}else if(icon==-1){
		$.toast(content);
	}else{
		$.toast(content);
	}
};
function formatIntVal(obj){
    obj.value=obj.value.replace(/\D+/g,'');
}
function formatPrice(val){
	val = Number(val);
	val = val.toFixed(1);
	return val;
};
function openMenuUrl(menuUrl, isCheck, newWin) {
	if (isCheck === true && !inituser) {
		alt('请登陆',-1);
		return;
	}
	if (isCheck === true && !user) {
		alt('请登陆',-1);
		setTimeout(function() {
			window.location.href = '/';
		}, 2000);
		return;
	}
	
	if (newWin === true) {
		window.open(menuUrl);
	} else {
		window.location.href = menuUrl;
	}
};
function getCursorPos(obj) {
	var caretPos = 0;
	if (document.selection) {
		// IE Support
		obj.focus();
		var sel = document.selection.createRange();
		sel.moveStart('character', -obj.value.length);
		caretPos = sel.text.length;
	} else if (obj.selectionStart || obj.selectionStart == '0') {
		// Firefox support
		caretPos = obj.selectionStart;
	}
	return caretPos;
}
/*
 * 定位光标
 */
function setCursorPos(obj, pos) {
	if (obj.setSelectionRange) {
		obj.focus();
		obj.setSelectionRange(pos, pos);
	} else if (obj.createTextRange) {
		var range = obj.createTextRange();
		range.collapse(true);
		// range.moveEnd('character', pos);
		range.moveStart('character', pos);
		range.select();
	}
}

/*
 * 替换后定位光标在原处,可以这样调用onkeyup=replaceAndSetPos(this,event,/[^\d]/g,'');
 */
function replaceAndSetPos(obj, event, pattern, text) {
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
}
// 日期计算
function dateDiff(date1, date2) {
	if(!date1 || !date2)return ;
    var type1 = typeof date1, type2 = typeof date2;
    if (type1 == 'string')
        date1 = stringToTime(date1);
    else if (date1.getTime)
        date1 = date1.getTime();
    if (type2 == 'string')
        date2 = stringToTime(date2);
    else if (date2.getTime)
        date2 = date2.getTime();
    //alert((date1 - date2) / (1000*60*60));
    var diff = (date2 - date1) / (1000 * 60 * 60 * 24); //结果是小时


    return eval(diff);
}

//字符串转成Time(dateDiff)所需方法
function stringToTime(string) {
    var f = string.split(' ', 2);
    var d = (f[0] ? f[0] : '').split('-', 3);
    var t = (f[1] ? f[1] : '').split(':', 3);
    return (new Date(
        parseInt(d[0], 10) || null,
        (parseInt(d[1], 10) || 1) - 1,
        parseInt(d[2], 10) || null,
        parseInt(t[0], 10) || null,
        parseInt(t[1], 10) || null,
        parseInt(t[2], 10) || null
    )).getTime();
}
function getQueryString(name) {
    var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
    var r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return unescape(r[2]);
    }
    return null;
}
