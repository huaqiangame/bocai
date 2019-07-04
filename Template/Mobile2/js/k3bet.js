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

$("#gn_main_cont").html($("#HZ_wf").html());
$(".play_select_tit li").click(function(){
	var lottery_code = $(this).attr('lottery_code');
	var txt = $(this).find('a').text();
	$(this).addClass('curr').siblings('li').removeClass('curr');
	var co = $("#"+lottery_code+"_wf").html();
	$("#gn_main_cont").html(co);
});

$(document).on("click", ".ball_number", function() {
	var theStatue = $(this).hasClass("curr"); 
	if (!theStatue) {
		$(this).addClass("curr");  
	} else {
		$(this).removeClass("curr");
	}
	var ball_type = $(this).attr('ball-type');
	var ball_number = $(this).attr('ball-number');
	var ball_txt = $(this).find("b").text();
	var typetxt = $(".play_select_tit li[lottery_code='"+ball_type+"'] .lineMore-item").text();
	var pl=0;
	if(ball_type=='3BTH'){
		var i=0;
		var ball_number='';
		$("#3BTH .ball_number").each(function(){
			var node = $(this);
			if($(this).hasClass("curr")){
				i++;
				ball_number += node.attr('ball-number')+'';
			}
		});
		if(i==3){
			showbetting(typetxt,ball_type,ball_txt, ball_number,peilv["3BTH"]);
		}
	}else if(ball_type=='2BTH'){
		var i=0;
		var ball_number='';
		$("#2BTH .ball_number").each(function(){
			var node = $(this);
			if($(this).hasClass("curr")){
				i++;
				ball_number += node.attr('ball-number')+'';
			}
		});
		if(i==2){
			showbetting(typetxt,ball_type,ball_txt, ball_number,peilv["3BTH"]);
		}
		
	}else if(ball_type=='2THDX'){
	  var i=0,j=0,fnumber;
	  var ethdx = new Array(),ethdx1 = new Array(),ETHDX_ARRAY=new Array();
	  var ethdx_btn_len = $("#2THDX .ethdx_btn.curr").length;
	  var ethdx_btn1_len = $("#2THDX .ethdx_btn1.curr").length;
	  if($(this).parents("li.li_ball.curr").index()==0){
		  ethdx_btn();
	  }else if($(this).parents("li.li_ball.curr").index()==1){
		  ethdx_btn1();
	  }
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
	  if(ETHDX_ARRAY.length>0){
		  var ball_number = '';
		  for(i=0;i<ethdx.length;i++){
			  ball_number += ethdx[i]+',';
		  }
		  for(j=0;j<ethdx1.length;j++){
			  ball_number += ethdx1[j]+',';
		  }
			if(ball_number.substr(-1)==','){
				ball_number = ball_number.substring(0,ball_number.length-1);
			}
		  showbetting(typetxt,ball_type,ball_txt, ball_number,peilv[ball_type]);
	  }
	  //$("#choice_zhu").text(ETHDX_ARRAY.length);
	}else if(ball_type=='HZ'){
            switch(ball_txt){
                case '单':
				ball_txt = 'a';
				break;
                case '双':
				ball_txt = 'b';
				break;
                case '小':
				ball_txt = 'c';
				break;
                case '大':
				ball_txt = 'd';
				break;
			}
		  var pl = 'HZ_'+ball_txt;
		  showbetting(typetxt,ball_type,ball_txt, ball_number,peilv[pl]);
	}else{
		  //pl = '3THTX';
		  showbetting(typetxt,ball_type,ball_txt, ball_number,peilv[ball_type]);
	}
});
function showbetting(typetxt,ball_type,ball_txt, number,pl){
	var order_code = ball_type+'_'+number;
	var text_info = '';
	if(typetxt==ball_txt){
		text_info = typetxt;
	}else{
		if(ball_type=='3BTH' || ball_type=='2BTH' || ball_type=='2THDX'){
			text_info = typetxt + ',' + number;
		}else{
			text_info = typetxt + ',' + (ball_txt=='a'?'单':(ball_txt=='b'?'双':(ball_txt=='c'?'小':(ball_txt=='d'?'大':ball_txt))));
		}
	}
	var strVar = "";
	strVar += "<div class=\"submitComfire\" id='XY28_BettingDialog'>";
	strVar += " <ul class=\"ui-form\">";
	strVar += "     <li><label for=\"question1\" class=\"ui-label\">彩种：<\/label><span class=\"ui-text-info\">" + configs.title + "<\/span><\/li>";
	strVar += "     <li><label for=\"question1\" class=\"ui-label\">期号：<\/label><span class=\"ui-text-info\">第<span id='tzqihao' qihao='"+cpdata.nextqihao+"'>" + cpdata.nextqihao + "</span>期<\/li>";
	strVar += "     <li><label for=\"answer1\" class=\"ui-label\">投注内容：<\/label><span class=\"ui-text-info\">" + text_info + "&nbsp;&nbsp;赔率：&nbsp;&nbsp;" + pl + "倍<\/span><\/li>";
	strVar += "     <li><label for=\"question1\" class=\"ui-label\">投注金额：<\/label><input type='number' value='' class='betting_moneys' verify='isNumb' />&nbsp;&nbsp;元<\/li>";
	strVar += " <\/ul>";
	strVar += "<\/div>";
	artDialog({
		title: "投注",
		content: strVar,
		id: "XY28_BettingDialogsss",
		cancel: function () {
			$(".ball_number.curr").removeClass("curr");
			$("#XY28_BettingDialog").remove();
		},
		ok: function () {
			var price = $(".betting_moneys").val();
			/*if(nowqihao!=$("#tzqihao").attr('qihao')){
				tip('投注期号已过期！');return false;
			}*/
			if(Number(price)<1){
				tip('请设置投注金额！');return false;
			}
			$.post(Webconfigs['ROOT']+"/index.php?m=Mobil&c=Lottery&a=addorderk3",{'order':order_code,'price':price,'name':configs.name,'qihao':nowqihao}, function(json){
				if(json.status==1){
					tip('投注成功','success');
				}else{
					tip(json.info);
				}
			},'json'); 
		},
		lock: true
	});

}
function ethdx_btn(){
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
}
function ethdx_btn1(){
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
}


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
loadWinInfo();
function loadWinInfo(){
	var name= configs.name;
	$.post(Webconfigs['ROOT']+"/index.php?m=Mobil&c=Lottery&a=getLotteryDataForQt",{'name':name}, function(data){
		if(data.name==name){
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
			checktm = data.leftTime;
			//TmpbetTime = data.leftTime3;
			if(betTime<=0){
				GetNextDrawTime();
			}
			clearTimeout(tm);
			setOutTime();
			GetLotteryRes();
			//GetNextDrawTime();

		}
	}, "json");
}
function CheckLotteryKj(){
	$.post(Webconfigs['ROOT']+"/index.php?m=Mobil&c=Lottery&a=CheckLotteryKj",{'name':configs.name,'qihao':cpdata.nextqihao}, function(data){
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
	$.post(Webconfigs['ROOT']+"/index.php?m=Mobil&c=Lottery&a=GetLotteryRes",{'name':configs.name,'num':10}, function(data){
		if(!data)return false;
		 html='';
		$.each(data,function(index,item){
			html += '<tr><td class="fz13">'+item.qihao+'</td><td class="c_red fb">'+item.balls+'</td><td class="c_blue fb">'+item.hezhi+'</td><td><em class="'+item.daxiaoclass+'">'+item.daxiao+'</em><i>|</i><em class="'+item.danshuangclass+'">'+item.danshuang+'</em></td></tr>';
		});
	 $('#fn_getoPenGame tbody').html(html);
	}, "json");
}
function BallsAward(){
	var data = cpdata;
	/*
	  var args = data.balls.split(',');
	  html='';
	  var hz = 0;
	  for(var w=0;w<args.length;w++){
		  html+= '<li class="open_numb_'+ args[w] +'">'+args[w]+'</li>';
		  hz = hz + parseInt(args[w],10);
	  }
*/
	 if($('#openNum_list').size()>0) $('#openNum_list').html(data.balls);
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
			$('.j_lottery_time').css({'font-size':'20px','color':'#e43939'}).html("正在开奖......");
		//$('#countDownTime').css({'color':"#ffffff"}).html("00:00:00");
    }else{

        // 下一期自动刷新页面
        if( betTime == 0){
			//GetNextDrawTime();
        	//setTimeout("refresh()", 5000);
        }
		if(betTime<cpdata.tzclosetime){
			//$("#XY28_BettingDialog").remove();
			$('.j_lottery_time').css({'font-size':'20px','color':'green'});
		}else if(betTime==cpdata.tzclosetime){
			alt1('第'+cpdata.qihao+'期，已截至投注','CountDown',3);
		}else{
			$('.j_lottery_time').css({'font-size':'20px','color':'#e43939'});
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
	$.post(Webconfigs['ROOT']+"/index.php?m=Mobil&c=Lottery&a=GetNextDrawTime",{'name':configs.name,'qihao':cpdata.qihao}, function(data){
		if(data.status==1){
			betTime = data.leftTime;
			data.nextqihao = data.qihao;
			nowqihao   = data.qihao;
			$("#f_lottery_info_number").text(data.qihao);
			clearTimeout(tm);
			setOutTime();
		}
	}, "json");
}
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
function formatIntVal(obj){
    obj.value=obj.value.replace(/\D+/g,'');
	showGetPrice(obj,obj.value);
}
function formatPrice(val){
	val = Number(val);
	val = val.toFixed(1);
	return val;
};
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

$(".g_Time_Section .switch").unbind().click(function () {
               var pageSwitch=$("#PageSwitch");
                pageSwitch.toggle(); 
                $(".g_Time_Section span").toggleClass("active1"); 
            });
 $(".Betting_Issue_CountDown dl").eq(0).unbind().click(function () {
 $("#fn_getoPenGame").toggle(); 
});

