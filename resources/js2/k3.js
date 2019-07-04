var lottery;
var ckTimer; // 摇奖计时器
var ClockEnv = {
	num:3,
	numRange:'1-6'
};
var openCodeTimeOut = null;
var openexpect      = 0;//当前需要检测的开奖期号
var rates = null;      //赔率

var lotteryname = null;
$(function(){
	lotteryname = null;
	var lotteryurl = window.location.search;
	lotteryname = lotteryurl.substring(lotteryurl.lastIndexOf('=')+1, lotteryurl.length);
	if(lotteryname!='undefined'){
		// Gameinit(lotteryname);
	}else{
		lotteryname = 'f1k3';
		Gameinit(lotteryname);
	};
	lotteryrates();
	$(document).on("click", ".play_select_tit li", function() {
		$(this).addClass('curr').siblings('li').removeClass('curr');
		lottery_code = $(this).attr('lottery_code');
		$(".bet-num-box > div."+lottery_code).show().siblings('div').hide();
		
	});
	//开奖历史展开收缩
	$(".kjopenclose").click(function(){
		if($(this).text()=='展'){
			$(this).text('收');
			$(".lishi").stop().animate({height:'467px'});
		}else if($(this).text()=='收'){
			$(this).text('展');
			$(".lishi").stop().animate({height:'98px'});
		}
	});
	
	$(document).on("click", ".play_select_tit li", function() {
		$(".ball_number").removeClass('curr');
	});
});
//和值
$(document).on("click", ".k3hzzx .ball_number,.k3sthtx .ball_number,.k3slhtx .ball_number", function() {
	k3hzzx($(this));
});
var k3hzzx=function(obj){
	if(rates==null){
		return false;
	}
	var text = obj.text(),number = obj.attr('ball-number'),playid = obj.attr('playid');
	if(!obj.hasClass("curr")){
		obj.addClass('curr');
	}
	addtotouzhu(playid,number);
};
/*
//三同号通选
$(document).on("click", ".k3sthtx .ball_number", function() {
	k3sthtx($(this));
});
var k3sthtx=function(obj){
	if(rates==null){
		return false;
	}
	var text = obj.text(),number = obj.attr('ball-number'),playid = obj.attr('playid');
	if(!obj.hasClass("curr")){
		obj.addClass('curr');
	}
	addtotouzhu(playid,number,1);
};
//三连号通选

$(document).on("click", ".k3slhtx .ball_number", function() {
	k3slhtx($(this));
});
var k3slhtx=function(obj){
	if(rates==null){
		return false;
	}
	var text = obj.text(),number = obj.attr('ball-number'),playid = obj.attr('playid');
	if(!obj.hasClass("curr")){
		obj.addClass('curr');
	}
	addtotouzhu(playid,number,1);
};*/


//三同号单选/三连号单选/二同号复选
$(document).on("click", ".k3sthdx .ball_number,.k3slhdx .ball_number,.k3ethfx .ball_number", function() {
	k3sthdx_1_2_3($(this));
});
var k3sthdx_1_2_3=function(obj){
	if(rates==null){
		return false;
	}
	var text = obj.text(),number = obj.attr('ball-number'),playid = obj.attr('playid');
	//number = '';
	obj.toggleClass("curr");
	$(".addtobetbtn").attr("onclick", "k3sthdx_1_2_3_addbtn('"+playid+"')");
	//addtotouzhu(playid,number);
};
var k3sthdx_1_2_3_addbtn=function(playid){
	var numberarray = [];
	$("div."+playid+ " .ball_number").each(function(){
		var $node = $(this);
		if($node.hasClass("curr")){
			var number = $node.attr('ball-number');
			numberarray.push(number);
		}
	});
	if(numberarray.length>0){
		addtotouzhu(playid,numberarray.join("#"),numberarray.length,1);
	}else{
		alt('请选择要投注的号码',-1);
	};
	$("div."+playid+ " .ball_number").removeClass("curr");
};

//二不同号
$(document).on("click", ".k3ebthbz .ball_number", function() {
	k3ebthbz($(this));
});
var k3ebthbz=function(obj){
	if(rates==null){
		return false;
	}
	var text = obj.text(),number = obj.attr('ball-number'),playid = obj.attr('playid');
	//number = '';
	obj.toggleClass("curr");
	$(".addtobetbtn").attr("onclick", "k3ebthbz_addbtn('"+playid+"')");
	//addtotouzhu(playid,number);
};
var k3ebthbz_addbtn=function(playid){
	var numberarray = [];
	$("div."+playid+ " .ball_number").each(function(){
		var $node = $(this);
		if($node.hasClass("curr")){
			var number = $node.attr('ball-number');
			numberarray.push(number);
		}
	});
	if(numberarray.length>=2){
		var combinearr= combine(numberarray,2);
		if(combinearr.length==1){
			addtotouzhu(playid,combinearr.join("#"),combinearr.length,1);
		}else{
			addtotouzhu(playid,combinearr.join("#"),combinearr.length,1);
		}
	}else{
		alt('选择的投注号码不完整',-1);
	};
	$("div."+playid+ " .ball_number").removeClass("curr");
};

//三不同号
$(document).on("click", ".k3sbthbz .ball_number", function() {
	k3sbthbz($(this));
});
var k3sbthbz=function(obj){
	if(rates==null){
		return false;
	}
	var text = obj.text(),number = obj.attr('ball-number'),playid = obj.attr('playid');
	//number = '';
	obj.toggleClass("curr");
	$(".addtobetbtn").attr("onclick", "k3sbthbz_addbtn('"+playid+"')");
	//addtotouzhu(playid,number);
};
var k3sbthbz_addbtn=function(playid){
	var numberarray = [];
	$("div."+playid+ " .ball_number").each(function(){
		var $node = $(this);
		if($node.hasClass("curr")){
			var number = $node.attr('ball-number');
			numberarray.push(number);
		}
	});
	if(numberarray.length>=3){
		var combinearr= combine(numberarray,3);
		if(combinearr.length==1){
			addtotouzhu(playid,combinearr.join("#"),combinearr.length,1);
		}else{
			addtotouzhu(playid,combinearr.join("#"),combinearr.length,1);
		}
	}else{
		alt('选择的投注号码不完整',-1);
	};
	$("div."+playid+ " .ball_number").removeClass("curr");
};


//二同号单选
$(document).on("click", ".k3ethdx .ball_number", function() {
	var ball  = $(this).attr('ball-number');
	var index = $(this).parents("ul").index();
	if(index==0){
		$(".k3ethdx ul:eq(1) a").each(function(index){
			var number = $(this).attr('ball-number');
			if($(this).hasClass("curr") && parseInt(number+''+number)==parseInt(ball)){
				$(this).removeClass('curr');
			}
		});
	}else if(index==1){
		$(".k3ethdx ul:eq(0) a").each(function(index){
			var number = $(this).attr('ball-number');
			if($(this).hasClass("curr") && parseInt(number)==parseInt(ball+''+ball)){
				$(this).removeClass('curr');
			}
		});
	}
	k3ethdx($(this));
});
var k3ethdx=function(obj){
	if(rates==null){
		return false;
	}
	var text = obj.text(),number = obj.attr('ball-number'),playid = obj.attr('playid');
	//number = '';
	obj.toggleClass("curr");
	$(".addtobetbtn").attr("onclick", "k3ethdx_addbtn('"+playid+"')");
	//addtotouzhu(playid,number);
};
var k3ethdx_addbtn = function(playid){
	var numberarray1 = [];
	$("div."+playid+ "  ul:eq(0) .ball_number").each(function(){
		var $node = $(this);
		if($node.hasClass("curr")){
			var number = $node.attr('ball-number');
			numberarray1.push(number);
		}
	});
	var numberarray2 = [];
	$("div."+playid+ "  ul:eq(1) .ball_number").each(function(){
		var $node = $(this);
		if($node.hasClass("curr")){
			var number = $node.attr('ball-number');
			numberarray2.push(number);
		}
	});
	if(numberarray1.length<1 || numberarray2.length<1){
		alt('选择的投注号码不完整',-1);
	}
	var allarr = DescartesAlgorithm(numberarray1, numberarray2);
	console.log(allarr.length);
	var array  = [];
	for(var i=0;i<allarr.length;i++){
		var tonghao = allarr[i][0];
		var danhao = allarr[i][1];
		if(tonghao.indexOf(danhao)>=0){
			
		}else{
			array[i] = allarr[i][0]+''+allarr[i][1];
		}
	}
	array = filterArray(array);
	//console.log(array);
	if(array.length>=1){
		addtotouzhu(playid,array.join("#"),array.length,1);
	}else{
		alt('选择的投注号码不完整',-1);
	};
	$("div."+playid+ " .ball_number").removeClass("curr");
}

//追加至投注列表
var orderList=new Array();
var addtotouzhu = function(_playid,number,zhushu,isshow){
	if(rates==null){
		return false;
	}
	var rate = rates[_playid];
	if(parseInt(rate.minjj)<1)rate.minjj = 1;
	if(parseInt(rate.maxprize)<1)rate.maxprize = 30000;
	var trano= generateMixed(20);
	var tab  = $('.xiad-left dl');
	var orderDetail = rate.playid +'###'+ number;
	var $Detailnode = $(".xiad-left dl dd[orderDetail='"+orderDetail+"']");
	var numberremark='';
	/*if(number.indexOf('#') > 0){
		numberremark = '['+number+']';
	}*/
	if(isshow==1 || isshow==true){
		numberremark = '['+number+']';
	}
	if($Detailnode.length>0){
		var price = parseInt($Detailnode.find('input.orderprice').val())+1;
		var okmoney = accMul(price,rate.rate);
		$Detailnode.find('input.orderprice').val(price).focus();
		$Detailnode.find('.order_money').text(okmoney.toFixed(2));
		//alt('存在相同投注号码，已经为您翻倍',1);
		trano= $Detailnode.attr('id');
		if(orderList.length>=1)for(var o in orderList) {
			if(orderList[o]['trano']==trano){
				orderList[o]['price'] = price;
			}
		}
		return false;
	}else{
		var array = { 
			'trano':trano,
			'playtitle':rate.title,
			'playid':rate.playid,
			'number':number,
			'zhushu':zhushu?parseInt(zhushu):1,
			'price':rate.minxf,
			'minxf':rate.minxf,
			'totalzs':rate.totalzs,
			'maxjj':rate.maxjj,
			'minjj':rate.minjj,
			'maxzs':rate.maxzs,
			'rate':rate.rate
		}; 
		orderList.unshift(array);//push (unshift)ie兼容待测试
	}
	//console.log(orderList);
	var $okamount = accMul(rate.minxf,rate.rate);
	//console.log($okamount);
	var html = '';
	html += '<dd id="'+trano+'" playid="'+rate.playid+'" orderDetail="' + rate.playid +'###'+ number + '">';
	html += '<span class="xq" title="投注号码:'+number+'">'+rate.title+numberremark+'</span>';
	html += '<ul>';
		html += '<li>每注<input class="orderprice" value="'+parseInt(rate.minxf)+'" size="5" style="color:black;" onblur="changeorderprice(this.value,\''+trano+'\');" onafterpaste="formatIntVal(this);changebetokmoney(this.value,\''+rate.rate+'\',\''+trano+'\');" onkeyup="formatIntVal(this);changebetokmoney(this.value,\''+rate.rate+'\',\''+trano+'\');" maxlength="5">元</li>';
		html += '<li style="margin-left:20px;"> 每注可赢金额：<t class="order_money mark">'+$okamount.toFixed(2)+'</t>元</li>';
		html += '<li class="sc"><a href="javascript:delOrder(\''+trano+'\')"><i class="glyphicon glyphicon-remove"></i></a></li>';
	html += '</ul>';
	html += '<input class="min-xf" value="'+rate.minjj+'" type="hidden">';
	html += '<input class="max-maxprize" value="'+rate.maxprize+'" type="hidden">';
	html += '</dd>';
	tab.prepend(html);
}
function changebetokmoney(price,rate,id){
	var $Detailnode = $(".xiad-left dl dd#"+id);
	var okmoney = accMul(price,rate);
	//alert(okmoney);return false;
	$Detailnode.find('.order_money').text(okmoney.toFixed(2));
}
function accMul(arg1,arg2)
{
	var m=0,s1=arg1.toString(),s2=arg2.toString();
	try{m+=s1.split(".")[1].length}catch(e){}
	try{m+=s2.split(".")[1].length}catch(e){}
	return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m)
}

var changeorderprice=function(price,id){
	if(orderList.length>=1)for (var i = 0; i < orderList.length; i++) {
		var cur_order = orderList[i];
		if (cur_order.trano == id) {
			orderList[i]['price'] = price;
		}
	}
	//console.log(orderList);
};


var delOrder=function(id){
	var playid = $("dd#"+id).attr('playid');
	if(orderList.length>=1)for (var i = 0; i < orderList.length; i++) {
            var cur_order = orderList[i];
            if (cur_order.trano == id) {
                orderList.splice(i, 1);
            }
	}
	$("dd#"+id).remove();
	if(playid.substring(0,4)=='k3hz')$(".bet-num-box .ball_number[playid='"+playid+"']").removeClass('curr');
}
var chars = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
function generateMixed(n) {
     var res = "";
     for(var i = 0; i < n ; i ++) {
         var id = Math.ceil(Math.random()*35);
         res += chars[id];
     }
     return res;
}
$(document).on("click", "#orderlist_clear", function() {
	orderList=[];
	$(".xiad-left dl").html('');
	$(".ball_number").removeClass('curr');
});

/*投注订单提交*/
$(document).on("click", "#f_submit_order", function() {
	$('.caizhong').html($('.cur a').html());
	$('.taozuqihao').html($('.nextqihao').html())
	if(orderList.length<1){
		alt('请选择投注号码',-1);
		return false;
	}
	var Orderdetaillist = '';
	var Orderdetailtotalprice    = 0;
	for (var i = 0; i < orderList.length; i++) {
            var cur_order = orderList[i];
			var rate = rates[cur_order.playid];
			var oprice = Number(cur_order.zhushu) * Number(cur_order.price);
			if(Number(cur_order.zhushu)<1 || Number(cur_order.price)<1){
				alt("投注列表金额设置不完整！",-1);
				return false;
			}
			Orderdetailtotalprice += oprice;
			Orderdetaillist +="<p>"+rate.title+':<span class="mark">'+cur_order.number+'</span>&nbsp;&nbsp;注数:<span class="mark">'+cur_order.zhushu+'</span>&nbsp;&nbsp;金额:<span class="mark">'+oprice.toFixed(2)+"</span></p>";
	}
	$("#Orderdetaillist").html(Orderdetaillist);
	$("#Orderdetailtotalprice").text(Orderdetailtotalprice.toFixed(2));
	            // alert($("#submitComfirebox").html());
	        	artDialog({
	        		title:"投注详情<span style='margin-left:15px;'><img src='"+WebConfigs['k3picdir']+"/icon_09.png'>截至时间:<strong class='sty-h gametimes' style='font-weight:normal'></strong></span>",
	        		content:$("#submitComfirebox").html(),
	        		cancel:function(){},
	        		ok:function(){
						if(!WebConfigs['user']){
							alt('请先登陆',-1);
						}else{
							$.ajax({
							url : WebConfigs[''],
							type : 'POST',
							data : {
								"orderList":orderList,
								'k3name':lotteryname,
							},
							beforSend : function(){

							},
							success : function(){
							}
						})

						}




/*					$.post(apirooturl + 'k3buy',{"orderList":orderList,'expect':lottery.currFullExpect,'lotteryname':lotteryname}, function(json){
							if(json.sign){
								$("#orderlist_clear").click();
								getUserBetsListToday(lotteryname);
								alt('投注成功',1);
							}else{
								alt(json.message,-1);
							}
						},'json'); */

	        		},
	        		lock:true
	        	});
});


function lotter_list_nav(lotterylist){
	var html='',$node = $(".lotter-list dl.lot-item");
	for(var o in lotterylist){
		var openinfo = lotterylist[o];
		html += '<dd lotteryname="'+lotterylist[o].name+'" onclick="javascript:Gameinit(\''+lotterylist[o].name+'\');">'+lotterylist[o].title+'</dd>';
	};
	$node.html(html);
};
$(document).on("click", ".lotter-list dl.lot-item dd", function() {
	//$(this).addClass('cur').siblings('dd').removeClass('cur');
});

//获取开奖时间
var lotterytimesId;
var lotterytimes = function(lotteryname){
	clearTimeout(lotterytimesId);
	var ret = null;var retopen = null;
	var url = apirooturl + 'lotterytimes';
	$.post(url, {'lotteryname':lotteryname}, function(data) {
		if(data.sign==true){
			lottery = data.data;
			way.set("showExpect", lottery);
			if (lottery.remainTime && eval(lottery.remainTime) > 1) {
				//alert(111);
				countdownTime(lottery.remainTime, lotterytimes, lotteryname);
				ret = lottery.lastFullExpect;
				retopen = lottery.openRemainTime;
				if (ret) {
					clearTimeout(openCodeTimeOut);
					openexpect = lottery.lastFullExpect;
						ckTimer = true;
						start();
						openCodeTimeOut = setTimeout(function () {
							loadopencode(lotteryname);
						},5000);
						//loadOpenCode(shortName, ret);
				}
			} else {
				if (lottery.currFullExpect == "000000") {
					ret = lottery.lastFullExpect;
				} else {
					lotterytimesId = setTimeout(function () {
						lotterytimes(lotteryname);
					}, 5000);
				}
			}
		}else if(data.sign==false){
			//alt(data.message,-1);
			lotterytimesId = setTimeout(function () {
				lotterytimes(lotteryname);
			}, 5000);
		}
	},'json');
}
//获取开奖
var lotteryopencodesid;
var lotteryopencodes = function(lotteryname){
	clearTimeout(lotteryopencodesid);
	var url = apirooturl + 'lotteryopencodes';
	var html='',$node = $(".lishi").find('table').find('tbody');
	$node.html('');
	$.post(url, {'lotteryname':lotteryname}, function(data) {
		if(data.sign==true){
			var lotlist = data.data;
			for(var o in lotlist){
				var openinfo = lotlist[o];
				if(!openinfo.opencode)openinfo.opencode='0,0,0';
				var array = (openinfo.opencode).split(",");
				var sum = parseInt(array[0])+parseInt(array[1])+parseInt(array[2]);
				var smallbig='',oddeven='';
				if(sum>10)
					smallbig='<em class="bg_zyell">大</em>';
				else
					smallbig='<em class="bg_purple">小</em>';
				if(sum%2!=0)
					oddeven='<em class="bg_green">单</em>';
				else
					oddeven='<em class="bg_blue">双</em>';
					
				html += '<tr><td width="130">'+openinfo.expect+'</td><td width="46">'+openinfo.opencode+'</td><td width="40">'+sum+'</td><td>'+smallbig+'&nbsp;|&nbsp;'+oddeven+'</td></tr>';
				
			}
			$node.html(html);
		}else if(data.sign==false){
			lotteryopencodesid = setTimeout(function () {
				lotteryopencodes();
			}, 5000);
		}
	},'json');
}
//赔率
var lotteryratesId;
var lotteryrates = function(){
	clearTimeout(lotteryratesId);
	rates = k3lotteryrates.rates;
	$.each(rates,function(n,value){
		var _playid = value.playid;
		//if(_playid.indexOf('k3hz')==0){
			$(".ball_aid[rate_"+_playid+"]").text('赔率'+value.rate);
		//}
	});
	/*
	var url = apirooturl + 'lotteryrates';
	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		async:false,
		success: function(data) {
			if (data.sign === true) {
				rates = data.rates;
				$.each(rates,function(n,value){
					var _playid = value.playid;
					//if(_playid.indexOf('k3hz')==0){
						$(".ball_aid[rate_"+_playid+"]").text('赔率'+value.rate);
					//}
				});
			} else {
				lotteryratesId = setTimeout(function () {
					lotteryrates();
				}, 5000);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			lotteryratesId = setTimeout(function () {
				lotteryrates();
			}, 5000);
		}
	});
	*/
}

//获取最后开奖期号
var loadopencodecount = 0;//防止无限循环导致卡死
var loadopencode = function(lotteryname){
	var url = apirooturl + 'loadopencode';
    var ret = false;
	clearTimeout(openCodeTimeOut);
	 $.ajax({  
         type:'post',      
         url:url,  
         data:{'lotteryname':lotteryname,'expect':openexpect},  
         cache:false,  
         dataType:'json',  
         success:function(msg){ 
            if (msg.sign == true) {
                if (msg.data.opencode.length > 0) {
					loadopencodecount = 0;
                    if (openCodeTimeOut) {
                        clearTimeout(openCodeTimeOut);
                    }
                    var lastExpect = way.get("showExpect.lastFullExpect");


                    if (lastExpect == openexpect) {
                        // 页面开奖号列表赋值
                        var openCodeListVal = $(".lishi").find('table').find('tbody').html();
                        if (lotteryname == "azjn") {
                            openexpect = openexpect.substr(12, openexpect.length);
                        }



                        ckTimer = true;
						var openCode = msg.data.opencode;
						var openCodes = openCode.split(',');
						var sum = parseInt(openCodes[0])+parseInt(openCodes[1])+parseInt(openCodes[2]);
						var smallbig='',oddeven='';
						if(sum>10)
							smallbig='<em class="bg_zyell">大</em>';
						else
							smallbig='<em class="bg_purple">小</em>';
						if(sum%2!=0)
							oddeven='<em class="bg_green">单</em>';
						else
							oddeven='<em class="bg_blue">双</em>';
						var html = '<tr><td class="lsqh">' + openexpect + '</td><td class="';
						if (msg.data.name.indexOf("bjpk10") >= 0) {
							html += 'kjqiu-sty3';
						} else if (msg.data.name.indexOf("kl10f") >= 0) {
							html += 'kjqiu-sty2';
						} else {
							html += 'kjqiu-sty1';
						}
						html += '"><p>';
						for (var j = 0; j < openCodes.length; j++) {
							if(j == openCodes.length - 1){
								html += openCodes[j];
							} else {
								html += openCodes[j] + ',';
							}
						}
						//html += '</p></td><td>'+sum+'</td><td>'+smallbig+'&nbsp;|&nbsp;'+oddeven+'</td></tr>' + openCodeListVal;
						html += '</p></td><td>'+sum+'</td><td>'+smallbig+'&nbsp;|&nbsp;'+oddeven+'</td></tr>';
                        if (openCodeListVal.indexOf(openexpect) < 0) {
                                $(".lishi").find('table').find('tbody').prepend(html);
                                    
                                //$(".lishi").find('table').find('tbody').find('tr').eq(20).remove();
                                    
                        }
						stopLottery(openCode);
                        //openResult();
						getUserBetsListToday();
                    }


                } else {
                    ret = true;
                }
				var lastExpect = way.get("showExpect.expect");
				//alert(lastExpect);
				//alert(expect);
				if (lastExpect == openexpect && msg.data.opencode.length<=0) {
				//alert(openCodeTimeOut);
				//alert(msg.lastOpenCode.length);
					if (openCodeTimeOut) {
						clearTimeout(openCodeTimeOut);
					}
					openCodeTimeOut = setInterval(function () {
						loadopencode(lotteryname, openexpect);
					}, 5 * 1000);
				}
            }else{
				loadopencodecount++;
				if(loadopencodecount<=80){
						openCodeTimeOut = setInterval(function () {
							loadopencode(lotteryname, openexpect);
						}, 5 * 1000);
				}else{
					window.location.reload();
				}

			}
        },
        error: function() {
            // 请求出错后5秒钟请求一次直到请求成功
            openCodeTimeOut = setTimeout(function() {
                loadopencode(lotteryname, openexpect);
            }, 1000 * 5);
        }
    });
    /*if (ret) {
        var lastExpect = way.get("showExpect.expect");
        if (lastExpect == expect) {
            if (openCodeTimeOut) {
                clearInterval(openCodeTimeOut);
            }
            openCodeTimeOut = setInterval(function () {
                loadopencode(lotteryname, expect);
            }, 5 * 1000);
        }
    }
	$.post(url, {'lotteryname':lotteryname,'expect':expect}, function(data) {
		if(data.sign==true){
			info = data.data;
			return info;
		}else if(data.sign==false){
			alt(data.message,-1);
		}
	},'json');*/
}
//异步去取上一次的开奖结果和中奖情况
function openResult() {
    var expect = way.get("showExpect.lastExpect");
   /* var shortName = Env.lottery;
	 $.ajax({  
         type:'post',      
         url:"/Game.openResult",  
         data:{"shortName": shortName,"expect": expect},  
         cache:false,  
         dataType:'json',  
         success:function(msg){ 
            if (msg.sign) {
                if (msg.isOpen) {
                  if (msg.prizeMoney > 0) {
                       $(".touzhuzj ul").empty();
                        var insertHtml = "<li>投注彩种：<span>" + msg.showName + "</span></li>";
                        insertHtml += "<li>投注期号：<span>" + msg.expect + "</span></li>";
                        insertHtml += "<li>投注金额：<span>" + msg.totalMoney + "元</span></li>";
                        insertHtml += "<li>中奖金额：<span>" + msg.prizeMoney + "元</span></li>";
                        insertHtml += "<li>本次盈亏：<span>" + (eval(msg.prizeMoney) - eval(msg.totalMoney)).toFixed(4) + "元</span></li>";
                        $(".touzhuzj ul").html(insertHtml);
                        // pop('kjts','320px','250px');
                        $(".touzhuzj").html($(".touzhuzj").html()).show(300).delay(30000).hide(300);
                        audioPlay(1);
                        // $("#kjts").html().show(300).delay(3000).hide(300);
                    }
                    getUserBetsListToday();
                } else {
                    setTimeout(function () {
                        openResult();
                    }, 5 * 1000);
                }
            } else {
                popTips(msg.message, "error");
            }
        }
    });*/
}

//获取开奖列表
var lotterycodes = function(lotteryname){
	
}

var Gameinit = function (_lotteryname) {
	clearInterval(openCodeTimeOut);
	//alert(window.location.pathname);
	//history.replaceState('', '', (host + window.location.pathname +'?code='+ lotteryname));
	History.pushState( '', '', "?code="+_lotteryname);
	// $('.lot-logo img').attr('src', WebConfigs['k3picdir']+_lotteryname+'.png');
	lotteryname = _lotteryname;
	lotterytimes(_lotteryname);
	lotteryopencodes(_lotteryname);
	getUserBetsListToday(_lotteryname);
}
/**
 * 当天投注记录
 * @param shortName
 */
function getUserBetsListToday(_lotteryname) {
	if(!user || user.islogin!=1){
		return false;
	}
	lotteryname = _lotteryname?_lotteryname:lotteryname;
	var tabs = $("#userBetsListToday");
    tabs.empty();
	var url = apirooturl + 'betslisttoday';
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 7,
		ajaxType: 'post',
		//hideInfos: false,
		hideGo: true,
		ajaxUrl: url,
		ajaxData: {
			"lotteryname": lotteryname,'jqueryGridPage': jqueryGridPage,'jqueryGridRows': jqueryGridRows
		},
		complete: function() {},
		success: function(data) {
			tabs.empty();
			$.each(data, function(index, val) {
				var html = '<tr id="'+val.trano+'">';
				html += '<td> <a href="javascript:getBillInfo(\''+val.trano+'\')">' + val.trano + '</a></td>';
				html += '<td>' + val.expect + '</td>';
				html += '<td>' + val.opencode + '</td>';
				html += '<td>' + val.playtitle + '</td>';
				html += '<td>' + val.mode + '</td>';
				html += '<td>' + val.amount + '</td>';
				html += '<td>' + (val.okamount ? val.okamount : 0) + '</td>';
				html += '<td>' + val.oddtime + '</td>';
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

/**
 * 摇奖计时器
 */
function start() {

    var n_numRangeArray = ClockEnv.numRange.split("-");
    if (ckTimer) {
        openLottery(ClockEnv.num, n_numRangeArray[1]);
    }
}
// 开奖过程
var T10;
var T9;
var T8;
var T7;
var T6;
var T5;
var T4;
var T3;
var T2;
var T1;
function openLottery(ball, maxnum) {
	if (T10) {
		clearInterval(T10);
		way.set("showExpect.openCode10", " ");
	}
	if (T9) {
		clearInterval(T9);
		way.set("showExpect.openCode9", " ");
	}
	if (T8) {
		clearInterval(T8);
		way.set("showExpect.openCode8", " ");
	}
	if (T7) {
		clearInterval(T7);
		way.set("showExpect.openCode7", " ");
	}
	if (T6) {
		clearInterval(T6);
		way.set("showExpect.openCode6", " ");
	}
	if (T5) {
		clearInterval(T5);
		way.set("showExpect.openCode5", " ");
	}
	if (T4) {
		clearInterval(T4);
		way.set("showExpect.openCode4", " ");
	}
	if (T3) {
		clearInterval(T3);
		way.set("showExpect.openCode3", " ");
	}
	if (T2) {
		clearInterval(T2);
		way.set("showExpect.openCode2", " ");
	}
	if (T1) {
		clearInterval(T1);
		way.set("showExpect.openCode1", " ");
	}
	var qiuanimation3Div = $("#qiuanimation3");
	if(qiuanimation3Div.length > 0) {
		qiuanimation3Div.hide();
		qiuanimation3Div.find("div.bigone").empty();
		qiuanimation3Div.find("div.bigone").hide();
	}
	var qiuanimation5Div = $("#qiuanimation5");
	if(qiuanimation5Div.length > 0) {
		qiuanimation5Div.hide();
		qiuanimation5Div.find("div.bigone").empty();
		qiuanimation5Div.find("div.bigone").hide();
	}
	$(".kaijq").find('ul').hide();
	if (ball == 3) {
		$(".lotter-bigqiu3").show();
	} else if (ball == 5) {
		$(".lotter-bigqiu5").show();
	} else if (ball == 8) {
		$(".lotter-bigsmll8").show();
	} else if (ball == 10) {
		$(".lotter-bigsmll10").show();
	}
	Lottery(ball, maxnum);

}
function Lottery(num, maxnum) {
	if (num >= 10) {
		T10 = window.setInterval(function() {
			openLottery10(maxnum);
		}, 50);
	}
	if (num >= 9) {
		T9 = window.setInterval(function() {
			openLottery9(maxnum);
		}, 50);
	}
	if (num >= 8) {
		T8 = window.setInterval(function() {
			openLottery8(maxnum);
		}, 50);
	}
	if (num >= 7) {
		T7 = window.setInterval(function() {
			openLottery7(maxnum);
		}, 50);
	}
	if (num >= 6) {
		T6 = window.setInterval(function() {
			openLottery6(maxnum);
		}, 50);
	}
	if (num >= 5) {
		T5 = window.setInterval(function() {
			openLottery5(maxnum);
		}, 50);
	}
	if (num >= 4) {
		T4 = window.setInterval(function() {
			openLottery4(maxnum);
		}, 50);
	}
	if (num >= 3) {
		T3 = window.setInterval(function() {
			openLottery3(maxnum);
		}, 50);
	}
	if (num >= 2) {
		T2 = window.setInterval(function() {
			openLottery2(maxnum);
		}, 50);
	}
	if (num >= 1) {
		T1 = window.setInterval(function() {
			openLottery1(maxnum);
		}, 50);
	}
}
function openLottery1(maxnum) {
	way.set("showExpect.openCode1", Math
			.round(Math.random() * (maxnum - 1) + 1));
}

function openLottery2(maxnum) {
	way.set("showExpect.openCode2", Math
			.round(Math.random() * (maxnum - 1) + 1));
}

function openLottery3(maxnum) {
	way.set("showExpect.openCode3", Math
			.round(Math.random() * (maxnum - 1) + 1));
}

function openLottery4(maxnum) {
	way.set("showExpect.openCode4", Math
			.round(Math.random() * (maxnum - 1) + 1));
}

function openLottery5(maxnum) {
	way.set("showExpect.openCode5", Math
			.round(Math.random() * (maxnum - 1) + 1));
}
function openLottery6(maxnum) {
	way.set("showExpect.openCode6", Math
			.round(Math.random() * (maxnum - 1) + 1));
}

function openLottery7(maxnum) {
	way.set("showExpect.openCode7", Math
			.round(Math.random() * (maxnum - 1) + 1));
}

function openLottery8(maxnum) {
	way.set("showExpect.openCode8", Math
			.round(Math.random() * (maxnum - 1) + 1));
}
function openLottery9(maxnum) {
	way.set("showExpect.openCode9", Math
			.round(Math.random() * (maxnum - 1) + 1));
}
function openLottery10(maxnum) {
	way.set("showExpect.openCode10", Math.round(Math.random() * (maxnum - 1) + 1));
}
// 停止开奖
function stopLottery(codes) {
	var nums = codes.split(',');
	if (nums.length >= 10) {
		setTimeout(function() {
			clearInterval(T10);
			way.set("showExpect.openCode10", nums[9] + "");
//			if(nums.length==10){
//				showLottery();
//			}
		}, 4000);
	}
	if (nums.length >= 9) {
		setTimeout(function() {
			clearInterval(T9);
			way.set("showExpect.openCode9", nums[8] + "");
//			if(nums.length==9){
//				showLottery();
//			}
		}, 4000);
	}
	if (nums.length >= 8) {
		setTimeout(function() {
			clearInterval(T8);
			way.set("showExpect.openCode8", nums[7] + "");
//			if(nums.length==8){
//				showLottery();
//			}
		}, 4000);
	}
	if (nums.length >= 7) {
		setTimeout(function() {
			clearInterval(T7);
			way.set("showExpect.openCode7", nums[6] + "");
//			if(nums.length==7){
//				showLottery();
//			}
		}, 3500);
	}
	if (nums.length >= 6) {
		setTimeout(function() {
			clearInterval(T6);
			way.set("showExpect.openCode6", nums[5] + "");
//			if(nums.length==6){
//				showLottery();
//			}
		}, 3000);
	}
	if (nums.length >= 5) {
		setTimeout(function() {
			clearInterval(T5);
			way.set("showExpect.openCode5", nums[4] + "");
			// if(nums.length==5){
			// 	showLottery();
			// }
		}, 2500);
	}
	if (nums.length >= 4) {
		setTimeout(function() {
			clearInterval(T4);
			way.set("showExpect.openCode4", nums[3] + "");
//			if(nums.length==4){
//				showLottery();
//			}
		}, 2000);
	}
	if (nums.length >= 3) {
		setTimeout(function() {
			clearInterval(T3);
			way.set("showExpect.openCode3", nums[2] + "");
//			if(nums.length==3){
//				showLottery();
//			}
		}, 1500);
	}
	if (nums.length >= 2) {
		setTimeout(function() {
			clearInterval(T2);
			way.set("showExpect.openCode2", nums[1] + "");
//			if(nums.length==2){
//				showLottery();
//			}
		}, 1000);
	}
	if (nums.length >= 1) {
		setTimeout(function() {
			clearInterval(T1);
			way.set("showExpect.openCode1", nums[0] + "");
//			if(nums.length==1){
//				showLottery();
//			}
		}, 200);
	}
}
var ab=0;
function calljustkjno(kname,qihao,kjno,ktime,b){
	$.ajax({
		 type : "POST",
		 url : "http://localhost/gdheyi/findNewK3",
		 data : {
			 kname :  kname,
			 qihao  :  qihao,
			 kjno   :  kjno,
		 },
		beforeSend : function () {
			//如果开奖时间到了,还没开奖,重新刷新下一期时间怎么算呢,不能为10分了,而是最新一期的时间+10分钟
			//php判断 如果当前时间大于 最新一期+10分,说明下一期还没开奖,返回剩余时间则是 10-(当前时间-最新一期时间+10分)
		},
		success :function (data) {
			 if(data ==  false ){
				 // var int = self.setInterval("calljustkjno($('#kname').val(),$('#qihao').val(),$('#kjno').val())",2000);
                 setTimeout(function () {
						calljustkjno($('#kname').val(),$('#qihao').val(),$('#kjno').val());
					},2000) ;
				 if(ab==0){
					 $('.toqihao').html(parseInt($('.toqihao').html())+1);
					 $('.nextqihao').html(parseInt($('.nextqihao').html())+1);
					 ab++;
					 if(ktime !=""){
							 countdownTime(obj['ktime']);
					 }
                     if(b==1){
						 alert('1');
						 countdownTime(600);
					 }
					 openLottery(3,6);
					 stopLottery(0);
				 };
			 }else{
				 $('#kname').val(data[0]['name']);
				 $('#qihao').val(data[0]['qihao']);
				 $('#kjno').val(data[0]['kjno']);
				 openLottery(3,6);
				 stopLottery(data[0]['kjno']);
				 ab=0;   //获取开奖号   之前作跳转现不跳转
			 };
	    }
	})
	// 1579	170228045	4,2,4	二不同	10	小	双	hnk3	2017-03-01 11:30:00
}


/** **************************************************************************** */
// 倒计时定时器
var CDTime = null;

function countdownTime(leftSec, callback, shortName) {
    var h, m, s, t;
    var h1, m1, s1;
    var h2, m2, s2;
    if (CDTime) {
        clearInterval(CDTime);
    }
    var localCurrentTime = new Date();
    t = leftSec * 1000;
    var endTime = localCurrentTime.getTime() + t;

    if (t > 0) {  //如果传递过来的秒数大于0执行下面代码
        h = Math.floor(t / 1000 / 60 / 60 % 24);
        if (h < 10) {
            h1 = "0";
            h2 = ""+ h;
        } else {
            h1 =  ""+ Math.floor(h/10);
            h2 =  ""+ h%10;
        }
        m = Math.floor(t / 1000 / 60 % 60);
        if (m < 10) {
            m1 = "0";
            m2 = ""+ m;
        } else {
            m1 =  ""+ Math.floor(m/10);
            m2 =  ""+ m%10;
        }
        s = Math.floor(t / 1000 % 60);
        if (s < 10) {
            s1 = "0";
            s2 = ""+ s;
        } else {
            s1 =  ""+ Math.floor(s/10);
            s2 =  ""+ s%10;
        }
        way.set("gametimes", h1+h2 + ':' + m1+m2 + ':' + s1+s2);
		$(".gametimes").text(h1+h2 + ':' + m1+m2 + ':' + s1+s2);
        // way.set("gametimes.h1", h1);
        // way.set("gametimes.h2", h2);
        // way.set("gametimes.m1", m1);
        // way.set("gametimes.m2", m2);
        // way.set("gametimes.s1", s1);
        // way.set("gametimes.s2", s2);
        way.set("gametimes.h", h1+h2);
        way.set("gametimes.m", m1+m2);
        way.set("gametimes.s", s1+s2);
        CDTime = setInterval(function() {//倒计时 计算剩余时间
            t = endTime - (new Date()).getTime();
            if (t >= 0) {
                h = Math.floor(t / 1000 / 60 / 60 % 24);
                if (h < 10) {
                    h1 = "0";
                    h2 = "" + h;
                } else {
                    h1 = "" + Math.floor(h/10);
                    h2 = "" + h%10;
                }
                m = Math.floor(t / 1000 / 60 % 60);
                if (m < 10) {
                    m1 = "0";
                    m2 = "" + m;
                } else {
                    m1 = "" + Math.floor(m/10);
                    m2 = "" + m%10;
                }
                s = Math.floor(t / 1000 % 60);
                if (s < 10) {
                    s1 = "0";
                    s2 = "" + s;
                } else {
                    s1 = "" + Math.floor(s/10);
                    s2 = "" + s%10;
                }
                way.set("gametimes", h1+h2 + ':' + m1+m2 + ':' + s1+s2);  //输出时间
				$(".gametimes").text(h1+h2 + ':' + m1+m2 + ':' + s1+s2);
                // way.set("gametimes.h1", h1);
                // way.set("gametimes.h2", h2);
                // way.set("gametimes.m1", m1);
                // way.set("gametimes.m2", m2);
                // way.set("gametimes.s1", s1);
                // way.set("gametimes.s2", s2);
                way.set("gametimes.h", h1+h2);
                way.set("gametimes.m", m1+m2);
                way.set("gametimes.s", s1+s2);
            }else {//倒计时=0的时间执行下面代码
                //audioPlay(2);
				   window.location.reload(); //倒计时到0跳转,尽量不要跳转,明天任务;
                   clearInterval(CDTime);
                   (eval(calljustkjno($('#kname').val(),$('#qihao').val(),$('#kjno').val(),'0',1)));
            }
        }, 500);//每500毫秒执行一次

    } else {  //如果传递过来的秒数小于0,就执行下面的代码
		(eval(calljustkjno($('#kname').val(),$('#qihao').val(),$('#kjno').val())));
    }
}
/**
 * 笛卡尔乘积算法
 *
 * @params 一个可变参数，原则上每个都是数组，但如果数组只有一个值是直接用这个值
 *
 * useage:
 * console.log(DescartesAlgorithm(2, [4,5], [6,0],[7,8,9]));
 */
function DescartesAlgorithm(){
	var i,j,a=[],b=[],c=[];
	if(arguments.length==1){
		if(!Array.isArray(arguments[0])){
			return [arguments[0]];
		}else{
			return arguments[0];
		}
	}
	
	if(arguments.length>2){
		for(i=0;i<arguments.length-1;i++) a[i]=arguments[i];
		b=arguments[i];
		
		return arguments.callee(arguments.callee.apply(null, a), b);
	}

	if(Array.isArray(arguments[0])){
		a=arguments[0];
	}else{
		a=[arguments[0]];
	}
	if(Array.isArray(arguments[1])){
		b=arguments[1];
	}else{
		b=[arguments[1]];
	}

	for(i=0; i<a.length; i++){
		for(j=0; j<b.length; j++){
			if(Array.isArray(a[i])){
				c.push(a[i].concat(b[j]));
			}else{
				c.push([a[i],b[j]]);
			}
		}
	}
	
	return c;
}

/**
 * 组合算法
 *
 * @params Array arr		备选数组
 * @params Int num
 *
 * @return Array			组合
 *
 * useage:  combine([1,2,3,4,5,6,7,8,9], 3);
 */
function combine(arr, num) {
	var r = [];
	(function f(t, a, n) {
		if (n == 0) return r.push(t);
		for (var i = 0, l = a.length; i <= l - n; i++) {
			f(t.concat(a[i]), a.slice(i + 1), n - 1);
		}
	})([], arr, num);
	return r;
}

/**
 * 排列算法
 */
function permutation(arr, num){
	var r=[];
	(function f(t,a,n){
		if (n==0) return r.push(t);
		for (var i=0,l=a.length; i<l; i++){
			f(t.concat(a[i]), a.slice(0,i).concat(a.slice(i+1)), n-1);
		}
	})([],arr,num);
	return r;
}
//}}}

/**
 * 分割字符串
 *
 * @params str		字符串
 * @params len      长度
 */
function strCut(str, len){
	var strlen = str.length;
	if(strlen == 0) return false;
	var j = Math.ceil(strlen / len);
	var arr = Array();
	for(var i=0; i<j; i++)
		arr[i] = str.substr(i*len, len)
	return arr;
}

//两个数组，返回包含相同数字的个数
function Sames(a,b){
	var num=0;
	for (i=0;i<a.length;i++)
	{   var zt=0;
		for (j=0;j<b.length;j++)
		{
			if(a[i]-b[j]==0){
				zt=1;
			}
		}
		if(zt==1){
			num+=1; 
		}
	}
	return num;
}

function Combination(c, b) {
    b = parseInt(b);
    c = parseInt(c);
    if (b < 0 || c < 0) {
        return false
    }
    if (b == 0 || c == 0) {
        return 1
    }
    if (b > c) {
        return 0
    }
    if (b > c / 2) {
        b = c - b
    }
    var a = 0;
    for (i = c; i >= (c - b + 1) ; i--) {
        a += Math.log(i)
    }
    for (i = b; i >= 1; i--) {
        a -= Math.log(i)
    }
    a = Math.exp(a);
    return Math.round(a)
}


//过滤重复的数组
function filterArray(arrs){
    var k=0,n=arrs.length; 
	var arr = new Array(); 
    for(var i=0;i<n;i++)
    {
        for(var j=i+1;j<n;j++)
        {
            if(arrs[i]==arrs[j])
            {
                arrs[i]=null;
                break;
            }
        }
    }    
    for(var i=0;i<n;i++)
    {
        if(arrs[i])
        {
            arr[k++]=arrs[i]; // arr.push(this[i]);
        }
    } 
    return arr;
}

//是否有重复值
  function isRepeat(arr){  
      
         var hash = {};  
      
         for(var i in arr) {  
      
             if(hash[arr[i]])  
      
                  return true;  
      
             hash[arr[i]] = true;  
      
         }  
      
         return false;  
      
    }
