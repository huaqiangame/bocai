/*
// | 快3
// | 技术支持：3158123688@qq.com
*/
$(".gn_main_cont").html($("#HZ_wf").html());
var ETHDX_ARRAY = new Array();//定义二同号单选组合数组 用于计算
var ORDER_LIST  = new Array();//注数数组
var cpdata;

var betTime = 0;
var jskj = 0;
var checktm = 0;
var awardIssuse = null;
var awardSeconds = 0;
var canOrder = true;
var timeData = null;
var firstEnter = true;
var cpdata = null;
var TmpbetTime = 0;
var tm;
var nowqihao = null;

var _ALL_TIMER_;

/*
//玩法切换
*/
$(".play_select_tit > li").click(function(){
	var lottery_code = $(this).attr('lottery_code');
	$(this).addClass("curr").siblings("li").removeClass("curr");
	$(".gn_main_cont").html($("#"+lottery_code+'_wf').html());
	$("#choice_zhu").text(0);
	switch(lottery_code){
	case 'HZ'://和值
	  $(".choice_cound").css({'display':'none'});
	  $(".play_select_prompt span").text('投注说明：至少选择1个和值投注，选号与开奖的三个号码相加的数值一致即中奖。奖金1.88-149倍');
	  break;
	case '3THTX'://三同号通选
	  $(".choice_cound").css({'display':'none'});
	  $(".play_select_prompt span").text('10元购买6个三同号(111,222,333,444,555,666)投注，选号与开奖号码一致即中奖31倍。');
	  break;
	case '3THDX'://三同号单选
	  $(".choice_cound").css({'display':'block'});
	  $(".play_select_prompt span").text('至少选择1个三同号投注，选号与开奖号码一致即中奖149倍。');
	  break;
	case '3BTH'://三不同号
	  $(".choice_cound").css({'display':'block'});
	  $(".play_select_prompt span").text('至少选择3个号码投注，选号与开奖号码一致即中奖28倍。');
	  break;
	case '3LHTX'://三连号通选
	  $(".choice_cound").css({'display':'none'});
	  $(".play_select_prompt span").text('10元购买4个三连号（123、234、345、456）投注，选号与开奖号码一致即中奖8倍。');
	  break;
	case '2THFX'://二同号复选
	  $(".choice_cound").css({'display':'block'});
	  $(".play_select_prompt span").text('10元购买1个二同号(11*,22*,33*,44*,55*,66*)投注，选号与开奖号码一致即中奖11倍。');
	  break;
	case '2THDX'://二同号单选
	  $(".choice_cound").css({'display':'block'});
	  $(".play_select_prompt span").text('选择1个相同号码和1个不同号码投注，选号与开奖号码一致即中奖51倍。');
	  break;
	case '2BTH'://二不同号
	  $(".choice_cound").css({'display':'block'});
	  $(".play_select_prompt span").text('至少选择2个号码投注，选号与开奖号码一致即中奖6倍。');
	  break;
	}
})


/* 
//|组合tr订单
//绑定选号[单击选号]
*/
$(document).on("click", ".ball_number", function() {
	var theStatue = $(this).hasClass("curr"); 
	/*if($(this).hasClass("ethdx_btn") || $(this).hasClass("ethdx_btn1")){
		return false;
	}*/
	if (!theStatue) {
		$(this).addClass("curr");  
	} else {
		$(this).removeClass("curr");
	}
	
	var ball_type = $(this).attr('ball-type');
	var ball_number = $(this).attr('ball-number');
	var ball_txt = $(this).text();
	var typetxt = $(".play_select_tit li[lottery_code='"+ball_type+"']").text();
	var tr='';
	var pl='';
	switch(ball_type){
	case 'HZ'://和值
	  pl = ball_type+'_'+ball_number;
	  tr = zuhetr(typetxt,ball_type,ball_number,ball_txt,peilv[pl],1);
	  $("#order_table").prepend(tr);
	  break;
	case '3THTX'://三同号通选
	  tr = zuhetr(typetxt,ball_type,ball_number,ball_txt,peilv[ball_type],1);
	  $("#order_table").prepend(tr);
	  break;
	case '3THDX'://三同号单选
	  var i=0;
	  ball_number = '';ball_txt='';
	  $("#3THDX .ball_number").each(function(){
	  	if($(this).hasClass("curr")){
			i++;
			ball_number += $(this).attr('ball-number')+',';
			ball_txt += $(this).text()+',';
		}
	  })
	  $("#choice_zhu").text(i);
	  break;
	case '3BTH'://三不同号
	  var i=0,j=0;
	  $("#3BTH .ball_number").each(function(){
	  	if($(this).hasClass("curr")){
			i++;
		}
	  });
		switch(i){
			case 3:j=1;break;
			case 4:j=4;break;
			case 5:j=10;break;
			case 6:j=20;break;
		}
	  $("#choice_zhu").text(j);
	  break;
	case '3LHTX'://三连号通选
	  tr = zuhetr(typetxt,ball_type,ball_number,ball_txt,peilv[ball_type],1);
	  $("#order_table").prepend(tr);
	  break;
	case '2THFX'://二同号复选
	  var i=0;
	  ball_number = '';ball_txt='';
	  $("#2THFX .ball_number").each(function(){
	  	if($(this).hasClass("curr")){
			i++;
		}
	  })
	  $("#choice_zhu").text(i);
	  break;
	case '2THDX'://二同号单选
	  var i=0,j=0,fnumber;
	  var ethdx = new Array(),ethdx1 = new Array();
	  $("#2THDX .ethdx_btn").each(function(){
	  	if($(this).hasClass("curr")){
			ethdx[i] = $(this).attr('ball-number');
			fnumber = ethdx[i].substr(0, 1);
			/*if($("#2THDX .ethdx_btn1[ball-number='"+fnumber+"']").hasClass("curr")){
				$("#2THDX .ethdx_btn1[ball-number='"+fnumber+"']").removeClass("curr");
			};*/
			i++;
		}
	  });
	  $("#2THDX .ethdx_btn1").each(function(){
	  	if($(this).hasClass("curr")){
			ethdx1[j] = $(this).attr('ball-number');
			fnumber = ethdx1[j]+''+ethdx1[j];
			/*if($("#2THDX .ethdx_btn[ball-number='"+fnumber+"']").hasClass("curr")){
				$("#2THDX .ethdx_btn[ball-number='"+fnumber+"']").removeClass("curr");
			};*/
			j++;
		}
	  });
	  ETHDX_ARRAY = objPL(ethdx,ethdx1);
	  $("#choice_zhu").text(ETHDX_ARRAY.length);
	  break;
	case '2BTH'://二不同号
	  var i=0,j=0;
	  $("#2BTH .ball_number").each(function(){
	  	if($(this).hasClass("curr")){
			i++;
		}
	  });
		switch(i){
			case 2:j=1;break;
			case 3:j=3;break;
			case 4:j=6;break;
			case 5:j=10;break;
			case 6:j=15;break;
		}
	  $("#choice_zhu").text(j);
	  break;
	}
});
$(document).on("click", ".ethdx_btn", function() {
	  var i=0,j=0,fnumber;
	  var ethdx = new Array(),ethdx1 = new Array();
	  $("#2THDX .ethdx_btn").each(function(){
	  	if($(this).hasClass("curr")){
			ethdx[i] = $(this).attr('ball-number');
			fnumber = ethdx[i].substr(0, 1);
			if($("#2THDX .ethdx_btn1[ball-number='"+fnumber+"']").hasClass("curr")){
				$("#2THDX .ethdx_btn1[ball-number='"+fnumber+"']").removeClass("curr");
			};
			i++;
		}
	  });
})
$(document).on("click", ".ethdx_btn1", function() {
	  var i=0,j=0,fnumber;
	  var ethdx = new Array(),ethdx1 = new Array();
	  $("#2THDX .ethdx_btn1").each(function(){
	  	if($(this).hasClass("curr")){
			ethdx1[j] = $(this).attr('ball-number');
			fnumber = ethdx1[j]+''+ethdx1[j];
			if($("#2THDX .ethdx_btn[ball-number='"+fnumber+"']").hasClass("curr")){
				$("#2THDX .ethdx_btn[ball-number='"+fnumber+"']").removeClass("curr");
			};
			j++;
		}
	  });
})

/*
** 数组计算组合
** 用于二同号单选
*/
function objPL(a,b) {
	var array = new Array();
	var n = 0;
	var str='';
	//a和b的排列组合个数就是两者相乘（双层循环）
	for (var i = 0; i < a.length; i++) {
		for (var j = 0; j < b.length; j++) {
			str = a[i] + b[j];
			if(str.substr(0, 1)!=str.substr(-1)){
				array[n] = a[i] + b[j];
				n++;
			}
		}
	}
	return array;
}
$("#choice_comfire_btn").click(function(){
	if($(".gn_main_cont #3THDX").length==1){//三同号单选
		  get_choice_comfire('3THDX',1);
	}else if($(".gn_main_cont #3BTH").length==1){//三不同号
		get_choice_comfire('3BTH',3);
	}else if($(".gn_main_cont #2THFX").length==1){//二同号复选
		get_choice_comfire('2THFX',1);
	}else if($(".gn_main_cont #2BTH").length==1){//二不同号
		get_choice_comfire('2BTH',2);
	}else if($(".gn_main_cont #2THDX").length==1){//二不同号
		var ball_type="2THDX",typetxt,ball_number = '',ball_txt='';
		typetxt ='';
		  var ethdx = new Array(),ethdx1 = new Array();
		  $("#2THDX .ethdx_btn").each(function(){
			if($(this).hasClass("curr")){
				ball_number  += $(this).text()+',';
			}
		  });
		  $("#2THDX .ethdx_btn1").each(function(){
			if($(this).hasClass("curr")){
				ball_number  += $(this).text()+',';
			}
		  });
			typetxt = $(".play_select_tit li[lottery_code='"+ball_type+"']").text();
			var tr = zuhetr(typetxt,ball_type,ball_number,ball_number,peilv[ball_type],$("#choice_zhu").text());
			//zuhetr(typetxt,ball_type,ball_number,ball_txt,peilv[ball_type]);
			$("#order_table").prepend(tr);
			$("#2THDX .ball_number").removeClass("curr");
	}
});
function get_choice_comfire(id,mincount){
	  var ball_type,typetxt,ball_number = '',ball_txt='';
	  var i=0;
	  $("#"+id+" .ball_number").each(function(){
		if($(this).hasClass("curr")){
			ball_number += $(this).attr('ball-number')+',';
			ball_txt += $(this).text()+',';
			ball_type = $(this).attr('ball-type');
			typetxt   = $(".play_select_tit li[lottery_code='"+ball_type+"']").text();
			i++;
		}
	  });
	  if(i<mincount){
		  tip('号码选择不完整，请重新选择！');return false;
	  }
	  var tr = zuhetr(typetxt,ball_type,ball_number,ball_txt,peilv[ball_type],$("#choice_zhu").text());
	  $("#order_table").prepend(tr);
		$("#"+id+" .ball_number").removeClass("curr");
}


function tip(content,icon){
	if(!icon)icon = 'warning';
	art.dialog({
		icon: icon,
		id: 'testID2',
		content: content,
		lock: true,
		cancelVal: '关闭',
		cancel: true
	});
}

function zuhetr(typetxt,type,number,txt,peilv,zhushu){
	//更新方案注数
	var lotterys_num = Number($("#f_gameOrder_lotterys_num").text())+Number(zhushu);
	$("#f_gameOrder_lotterys_num").text(lotterys_num);
	if(number.substr(-1)==','){
		number = number.substring(0,number.length-1);
	}
	if(txt.substr(-1)==','){
		txt = txt.substring(0,txt.length-1);
	}
	//ORDER_LIST[order_code] = order_code;
	var order_code = type+'_'+number;
	ORDER_LIST.push(order_code);
	var node = $("tr[order_code='"+order_code+"']");
	if(node.length>=1){
		tip('投注列表内含有重复选号，系统暂不支持，请重新选号');
		return false;
	}
	var tr = '';
	tr += '<tr order_code="'+order_code+'" type_code="'+type+'" peilv="'+peilv+'">';
	tr += '<td>';
	tr += '<i class="order_type">['+typetxt+']  '+txt+'</i>';
	tr += '</td>';
	tr += '<td>';
	tr += '<span class="order_zhushu">总共<i class="order_num c_red">'+zhushu+'</i>注</span>';
	tr += '</td>';
	tr += '<td>';
	tr += '<i class="order_price">每注<input type="text" value="" class="each_price" onafterpaste="formatIntVal(this)" onkeyup="formatIntVal(this)" onblur="changetotalprice();">元</i>';
	tr += '</td>';
	tr += '<td>';
	tr += '<i class="c_3">&nbsp;<span class="hide_this">每注可赢金额：<i class="order_money c_red">0.00</i>元</span></i>';
	tr += '</td>';
	tr += '<td>';
	tr += '<i class="c_org l_cancel" onclick="removetr(this)">删除</i>';
	tr += '</td>';
	tr += '</tr>';
	return tr;
};
function removetr(obj){
	//更新方案注数
	var lotterys_num = Number($("#f_gameOrder_lotterys_num").text())-Number($(obj).parents('tr').find('.order_num').text());
	$("#f_gameOrder_lotterys_num").text(lotterys_num);
	var order_code = $(obj).parents('tr').attr('order_code');
	ORDER_LIST.remove(order_code);
	$(obj).parents('tr').remove();
	//更新方案总价格
	changetotalprice();
}

function formatIntVal(obj){
    obj.value=obj.value.replace(/\D+/g,'');
	showGetPrice(obj,obj.value);
}
function formatPrice(val){
	val = Number(val);
	val = val.toFixed(1);
	return val;
};
function showGetPrice(obj,val){
	 var odds = $(obj).parents('tr').attr('peilv');
	 var bingoPrice = accMul(val,odds);
	 //alert(accMul(val,odds));
	 $(obj).parents('tr').find(".order_money").text(bingoPrice);
	 $(obj).parents('tr').find(".hide_this").css({'display':'inline'});
	 return false;
//	 bingoPrice = CP.core.formatPrice(bingoPrice);
//	 that.parent().parent().find('.winMoney').html(bingoPrice);
};
$("input").blur(function(){
  $("input").css("background-color","#D6D6FF");
});
function accMul(arg1,arg2)
{
var m=0,s1=arg1.toString(),s2=arg2.toString();
try{m+=s1.split(".")[1].length}catch(e){}
try{m+=s2.split(".")[1].length}catch(e){}
return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m)
}
function changetotalprice(){
	var totalprice = 0;
	$("#order_table tr").each(function(){
		totalprice += Number($(this).find('.each_price').val());
	})
	$("#f_gameOrder_amount").text(totalprice);
}
function checkSingleBuy(obj){
	
};

$("#f_submit_order").click(function(){
	var type_code,order_code,peilv;
	if(ORDER_LIST.length<=0){
		tip('请选择投注号码');return false;	
	}
	var price,order_str='',price_str='';
	var pricenum=0;//有金额的注单数量
	for(i=0;i<ORDER_LIST.length;i++){
		price = $("#order_table tr[order_code='"+ORDER_LIST[i]+"']").find("input.each_price").val();
		if(Number(price)>=1){
			order_str += ORDER_LIST[i]+';'
			price_str += Number(price)+';'
			pricenum++;
		}
	}
	if(pricenum<=0){
		tip('请至少选择一注投注号码！');return false;
	}
	sendorder(order_str,price_str);
	//alert($("#order_table tr").length);
	$("#order_table tr").each(function(){
		//alert($(this).attr('order_code'));
	})
});

/*投注订单提交*/
function sendorder(order,price){
	var comfire_order='';
	for(i=0;i<ORDER_LIST.length;i++){
		var nprice = $("#order_table tr[order_code='"+ORDER_LIST[i]+"']").find("input.each_price").val();
		if(Number(nprice)>=1){
			comfire_order +="<p>"+$("#order_table tr[order_code='"+ORDER_LIST[i]+"']").find(".order_type").text()+"</p>";
		}
	}
	var strVar = "";
	strVar += "<div class=\"submitComfire\">";
	strVar += "	<ul class=\"ui-form\">";
	strVar += "		<li><label for=\"question1\" class=\"ui-label\">彩种：<\/label><span class=\"ui-text-info\">"+configs.title+"<\/span><\/li>";
	strVar += "		<li><label for=\"question1\" class=\"ui-label\">期号：<\/label><span class=\"ui-text-info\">第"+nowqihao+" 期<\/li>";
	strVar += "		<li><label for=\"answer1\" class=\"ui-label\">详情：<\/label>";
	strVar += "		<div class=\"textarea\" style=\"font-size:12px;\">";
	strVar += comfire_order;
	strVar += "		<\/div>";
	strVar += "		<\/li>";
	strVar += "		<li><label for=\"question2\" class=\"ui-label\">付款总金额：<\/label><span class=\"ui-text-info\"><span class=\"c_red\">"+$("#f_gameOrder_amount").text()+"<\/span>元<\/span><\/li>";
	strVar += "		<li><label for=\"question2\" class=\"ui-label\">付款帐号：<\/label><span class=\"ui-text-info\"><span class=\"c_red\">"+configs.username+"<\/span><\/span><\/li>";
	/*strVar += "		<li><label for=\"question2\" class=\"ui-label\">温馨提示：本平台每单最高奖金限额<i class='c_red'>" + Max_Values + "</i>元，请会员谨慎投注！<\/li>";*/
	strVar += "	<\/ul>";
	strVar += "	<p class=\"text-note\">";
	strVar += "	<\/p>";
	strVar += "	<p class=\"text-note\">";
	strVar += "	<\/p>";
	strVar += "<\/div>";
	        	artDialog({
	        		content:strVar,
	        		cancel:function(){},
	        		ok:function(){
					$.post("/index.php?m=Home&c=Lottery&a=addorderk3",{'order':order,'price':price,'name':configs.name,'qihao':nowqihao}, function(json){
							if(json.status==1){
								ORDER_LIST=[];
								$("#order_table tr").remove();
								$("#f_gameOrder_lotterys_num").text(0);
								$("#f_gameOrder_amount").text(0);
								$(".gn_main_list").find('.ball_number').removeClass('curr');
								tip('投注成功','success');
							}else{
								tip(json.info);
							}
						},'json'); 

	        		},
	        		lock:true
	        	})


};
loadWinInfo();
function loadWinInfo(){
	var name= configs.name;
	$.post("/index.php?m=Home&c=Lottery&a=getLotteryDataForQt",{'name':name}, function(data){
			
		if(data.name==name){
			if(data.leftTime<-1200 || data.isok!=1){
				var defaulthtml = $(".gameBet_left").html();
				$(".gameBet_left").html("<center><img src='/Public/home/images/k3cpcz.png' /></center>");
			}
			cpdata = data;
			firstEnter = false; 
			$("#f_lottery_info_lastnumber").html(data.qihao);
			awardSeconds = data.tzclosetime;
			BallsAward();
			betTime = data.leftTime;
			TmpbetTime = data.leftTime;
			nowqihao   = data.nextqihao;
			$('.cz_logo h2').html(configs.title);
			$('#f_lottery_info_number').text(nowqihao);
			betTime = data.leftTime;
			//nextbetTime = data.nextleftTime;
			//TmpbetTime = data.leftTime3;
				
			if(betTime<=0){
				checktm = 0;
				OpenNum_ball();
				GetNextDrawTime();
			}else{
				checktm = data.leftTime;
			}
			clearTimeout(tm);
			setOutTime();
			setTimeout(GetLotteryRes(), 1000);;
			setTimeout(GetLotteryUser(), 1000);
			//GetNextDrawTime();
			
		}
	}, "json");
}
function CheckLotteryKj(){
	$.post("/index.php?m=Home&c=Lottery&a=CheckLotteryKj",{'name':configs.name,'qihao':cpdata.nextqihao}, function(data){
		if(data.status==1){
			loadWinInfo();
		}else if(parseInt(data.qihao)>=parseInt(nowqihao)){
			loadWinInfo();
		}
		/*if(data.qihao!=nowqihao && parseInt(data.qihao)<parseInt(nowqihao)){
			
		}*/
	}, "json");
}
function GetLotteryRes(){
	$.post("/index.php?m=Home&c=Lottery&a=GetLotteryRes",{'name':configs.name,'num':10}, function(data){
		if(!data)return false;
		 html='';
		$.each(data,function(index,item){
			html += '<tr><td class="fz13">'+item.qihao+'</td><td class="c_red fb">'+item.balls+'</td><td class="c_blue fb">'+item.hezhi+'</td><td><em class="'+item.daxiaoclass+'">'+item.daxiao+'</em><i>|</i><em class="'+item.danshuangclass+'">'+item.danshuang+'</em></td></tr>';
		});
	 $('#fn_getoPenGame tbody').html(html); 
	}, "json");
}

/*
** 中奖会员展示
*/
function GetLotteryUser(){
	$.post("/index.php?m=Home&c=Lottery&a=GetLotteryUsers",{'num':6}, function(data){
		if(!data)return false;
		 html='';
		$.each(data,function(index,item){
			html += '<li>会员&nbsp;&nbsp;'+item.username+'中奖&nbsp;&nbsp;<i class="c_red">'+item.amount+'</i>&nbsp;&nbsp;元</li>';
		});
	 $('.luck_list ul').html(html); 
	}, "json");
}

function BallsAward(){
	var data = cpdata;
	if(cpdata.balls==undefined){
		return false;
	}
		var args = data.balls.split(',');
		html='';
		var hz = 0;
		for(var w=0;w<args.length;w++){
		  html+= '<li class="open_numb_'+ args[w] +'">'+args[w]+'</li>'; 
		  hz = hz + parseInt(args[w],10);
		}
	//alert(html);
		if($('#openNum_list').size()>0) $('#openNum_list').html(html);
	
}
function pad(num, n) {  
    var len = num.toString().length;  
    while(len < n) {  
        num = "0" + num;  
        len++;  
    }  
    return num;  
}  

function formatSeconds(value) {
    var theTime = parseInt(value);// 秒
    var theTime1 = 0;// 分
    var theTime2 = 0;// 小时
        theTime1 = pad(parseInt(theTime/60),2);
        theTime = pad(parseInt(theTime%60),2);

            theTime2 = pad(parseInt(theTime1/60),2);
            theTime1 = pad(parseInt(theTime1%60),2);
	var result = ""+pad(parseInt(theTime),2);
		result = ""+pad(parseInt(theTime1),2)+":"+result;
		result = ""+pad(parseInt(theTime2),2)+":"+result;
    return result;
}
function setOutTime(){
    if(betTime < 1){
        //waitAward();
			$('.j_lottery_time').css({'font-size':'22px','color':'#fff'}).html("正在开奖......");
		//$('#countDownTime').css({'color':"#ffffff"}).html("00:00:00");
    }else{
        
		if(betTime<cpdata.tzclosetime){
			$('.j_lottery_time').css({'font-size':'36px','color':'green'});
		}else if(betTime==cpdata.tzclosetime){
			alt1('第'+cpdata.qihao+'期，已截至投注','CountDown',3);
		}else{
			$('.j_lottery_time').css({'font-size':'36px','color':'#fff'});
		}
        gameHasEnd = 0;
        var str = formatSeconds(betTime);
        if($('.j_lottery_time').size()>0) $('.j_lottery_time').html(str);
    }
	betTime = betTime - 1;
	checktm = checktm-1;
	if( betTime == 0 && configs.issys!=1){
		GetNextDrawTime();
	}
	if(checktm<0 && checktm%10==0){
		CheckLotteryKj();
	}
    tm=setTimeout("setOutTime()", 1000);
}
function GetNextDrawTime(){
	OpenNum_ball();
	$.post("/index.php?m=Home&c=Lottery&a=GetNextDrawTime",{'name':configs.name,'qihao':cpdata.qihao}, function(data){
		if(data.status==1){
			betTime = data.leftTime;
			data.nextqihao = data.qihao;
			nowqihao   = data.qihao;
			checktm = 0;
			$("#f_lottery_info_number").text(data.qihao);
			clearTimeout(tm);
			setOutTime();
		}
	}, "json");
}
function OpenNum_ball(){
	//执行开奖的号码
	$("#f_lottery_info_lastnumber").text(cpdata.nextqihao);
	var oOpenNum_ball_all = "";
	for (var a = 0; a < 3; a++) {

		var oOpenNum_ball = '<li class="open_numb_gif"></li>';
		oOpenNum_ball_all = oOpenNum_ball_all + oOpenNum_ball;
	}; 
	$('#openNum_list').html(oOpenNum_ball_all);
}

Array.prototype.indexOf = function(val) {
for (var i = 0; i < this.length; i++) {
if (this[i] == val) return i;
}
return -1;
};
Array.prototype.remove = function(val) {
var index = this.indexOf(val);
if (index > -1) {
this.splice(index, 1);
}
};
function alt1(str, type, success, error){

            type = type || "";
            switch(type){
                case 'comfirm':
                    artDialog({
                        icon: "warning",
                        content: str,
                        ok: function () {
                            if (success != undefined && success) {
                                success();
                            }
                        },
                        cancel: function () {
                            if (error != undefined && error) {
                                error();
                            } 
                        },
                        lock: true
                    })
                    break;
                case "SureInfo":
                    artDialog({
                        content: str,
                        ok: function () {
                            if (success != undefined && success) {
                                success();
                            }
                        },
                        lock: true
                    })
                    break;
                case 'CountDown':
                    art.dialog({
                        icon: "warning",
                        id: 'testID2',
                        content: str,
                        lock: true,
                        cancelVal: '关闭',
                        cancel: true
                    }); 
                    if (typeof success == "number") {
                        art.dialog({ id: 'testID2' }).title('3秒后关闭').time(success);
                    } else {
                        art.dialog({ id: 'testID2' }).title('3秒后关闭').time(3);
                    }
                    
                    break;
                case 'error':
                    art.dialog({
                        icon: "warning",
                        id: 'testID3',
                        content: str,
                        lock: true,
                        cancelVal: '关闭',
                        cancel: true
                    }); 
                    if (typeof success == "number") {
                        art.dialog({ id: 'testID3' }).title('3秒后关闭').time(success);
                    } else {
                        art.dialog({ id: 'testID3' }).title('3秒后关闭').time(3);
                    }

                    break;
                case "":
                default:
                    alert(str);
                    break;
            } 
}
