var lottery;
var ckTimer; // 摇奖计时器
	var betting_sum = 0;
var ClockEnv = {
	num:3,
	numRange:'1-6'
};
var openCodeTimeOut = null;
var openexpect      = 0;//当前需要检测的开奖期号
var rates = null;      //赔率
var ratesArr = [];
var maxRates = 0;
var lotteryname = lotteryinfo.name;
var yzhushu;
var ethdxZhushu;
$(function(){
	$.init();
	Gameinit(lotteryname);
	lotteryrates();
	$(".date-input-picker").calendar();
    if ($(".choice_lottery_playdetail").size() > 0) {
        $(".choice_lottery_playdetail_right").click(function () {
            $(".play_select_container").toggle();
        })

        $(".play_select_container .lineMore-item").click(function () {
            if ($("#j_play_select").hasClass("show_child_PlayCont")) {
                return true;
            } else { 
                var _theTitle = $(this).text();
                $(".choice_lottery_playdetail").find(".choice_playName").eq(0).empty().text(_theTitle);
               $(".play_select_container").hide();
            }

			lottery_empty()
        }); 
       
        $(".look_detail_btn").click(function () {
            $(".betting-record-container").stop(true, true).animate({
                "left":"0px"
            }, 300)
        });
        $("#continue_choice").click(function () {
            $(".betting-record-container").stop(true, true).animate({
                "left": "100%"
            },300)
        });

        
    }
	$(".Betting_Issue_CountDown dl").eq(0).unbind().click(function () {
		$("#fn_getoPenGame").toggle(); 
	});
	
	$("#gn_main_cont").html($("#k3hzzx_wf").html());
	$(".play_select_tit li").click(function(){
		var lottery_code = $(this).attr('lottery_code');
		var txt = $(this).find('a').text();
		$(this).addClass('curr').siblings('li').removeClass('curr');
		var co = $("#"+lottery_code+"_wf").html();
		$("#gn_main_cont").html(co);
		orderList=[];
	});
	$(document).on('click','a.ball_number', function () {
		//$(this).toggleClass('curr');
		if($(this).hasClass('curr')){
			$(this).removeClass('curr');
		}else{
			$(this).addClass('curr');
		}
		
		if($('.lottery_footer_sum').css('display') == 'none'){
			$('.lottery_footer_sum').show();
			$('.lottery_inputBox').show();
			$('.betting_sum_box').show();
			$('.kuaijie_money').show();
		}

		var len = $('#Game_CheckBall').find('a.curr').length;
		if(len <= 0){
			$('.lottery_footer_sum').hide();
			$('.lottery_inputBox').hide();
			$('.betting_sum_box').hide();
			$('.kuaijie_money').hide();
		}
	});
	
	//和值投注 三同号通选 三练好通选
	$(document).on('click','#k3hzzx .ball_number,#k3sthtx .ball_number,#k3slhtx .ball_number', function () {
		var obj = $(this);
		var text = obj.text(),number = obj.attr('ball-number'),playid = obj.attr('playid');
		var rate = rates[playid];

		if(playid == 'k3slhtx'){
			var numberarray = [];
			$("#k3slhtx .ball_number.curr").each(function(index){
				var numbers = $(this).attr('ball-number');
				numberarray.push(numbers);
			});
			submit_order(playid,numberarray.join('#'),number,numberarray.length,$("#"+obj.attr('ball-type')));
		}else if(playid == 'k3sthtx'){
			var numberarray = [];
			$("#k3sthtx .ball_number.curr").each(function(index){
				var numbers = $(this).attr('ball-number');
				numberarray.push(numbers);
			});
			submit_order(playid,numberarray.join('#'),number,numberarray.length,$("#"+obj.attr('ball-type')));
		}else{
			var numberarray = [];orderList = [];
			$("#k3hzzx .ball_number.curr").each(function(index){
				var numbers = $(this).attr('ball-number');
				numberarray.push(numbers);
				
				
				/*************/
				var _playid = $(this).attr('playid');
				var ratea = rates[_playid];
				if(parseInt(ratea.minjj)<1)ratea.minjj = 1;
				if(parseInt(ratea.maxprize)<1)ratea.maxprize = 30000;
				var trano = generateMixed(20);
				var array = { 
					'trano':trano,
					'playtitle':ratea.title,
					'playid':ratea.playid,
					'number':number,
					'zhushu':1,
					'price':0,
					'minxf':ratea.minxf,
					'totalzs':ratea.totalzs,
					'maxjj':ratea.maxjj,
					'minjj':ratea.minjj,
					'maxzs':ratea.maxzs,
					'rate':ratea.rate
				}; 
				orderList.unshift(array);
			});
			/*console.log($("#k3hzzx .ball_number.curr").length);
			console.log(maxRates);
			console.log(orderList);*/
			submit_order(playid,numberarray.join('#'),number,numberarray.length,$("#"+obj.attr('ball-type')),true);
			
			/*var numbers = $(this).attr('ball-number');
			var ratea = rates[playid];
			if(parseInt(ratea.minjj)<1)ratea.minjj = 1;
			if(parseInt(ratea.maxprize)<1)ratea.maxprize = 30000;
			var trano = generateMixed(20);
			var array = { 
				'trano':trano,
				'playtitle':ratea.title,
				'playid':ratea.playid,
				'number':number,
				'zhushu':1,
				'price':0,
				'minxf':ratea.minxf,
				'totalzs':ratea.totalzs,
				'maxjj':ratea.maxjj,
				'minjj':ratea.minjj,
				'maxzs':ratea.maxzs,
				'rate':ratea.rate
			}; */
			/*var orderplayidarray = [];
			if(orderList.length>0)for(var i=0;i<orderList.length;i++){
				orderplayidarray.push(orderList[i].playid);
			}
			var _objplayid = $(this).attr('playid');
			if(!contains(orderplayidarray,_objplayid)){
				orderList.unshift(array);
			}*/
			//submit_order(playid,numberarray.join('#'),number,numberarray.length,$("#"+obj.attr('ball-type')),true);
		}
		

	});
	function contains(arr, obj) {  
		var i = arr.length;  
		while (i--) {  
			if (arr[i] === obj) {  
				return true;  
			}  
		}  
		return false;  
	} 
	/*
	** 删除玩法订单
	*/
	function deletecomorderList(_playid){
		if(orderList.length <= 0)return false;
		for(var i=0;i<orderList.length;i++){
			if(orderList[i].playid == _playid){
				orderList.splice(i, 1);
			}
		}
		return orderList;
	}
	//三同号单选
	$(document).on('click','#k3sthdx .ball_item', function () {
		var obj = $(this);
		var text = obj.text(),number = obj.find('a').attr('ball-number'),playid = 'k3sthdx';
		var rate = rates[playid];
		var bools = true;
		// if($("#k3sthdx .ball_number.curr").length<1){
		// 	alt('请至少选择一注号码',-1);return false;
		// }
		var numberarray = [];
		$('#k3sthdx').find('.ball_number').each(function (){
			if($(this).hasClass('curr')){
				bools = false;
			}
		})
		if(bools){
			$('.lottery_input').val('');
		}
		var numberarray = [];
		$("#k3sthdx .ball_number.curr").each(function(index){
			var number = $(this).attr('ball-number');
			numberarray.push(number);
		});
		submit_order(playid,numberarray.join("#"),number,numberarray.length,$("#"+playid));
	});
	//二同号复选
	$(document).on('click','#k3ethfx .ball_item', function () {
		var obj = $(this);
		var text = obj.text(),number = obj.find('a').attr('ball-number'),playid = 'k3ethfx';
		var rate = rates[playid];
		var bools = true;
		// if($("#k3ethfx .ball_number.curr").length<1){
		// 	alt('请至少选择一注号码',-1);return false;
		// }
		$('#k3ethfx').find('.ball_number').each(function (){
			if($(this).hasClass('curr')){
				bools = false;
			}
		})
		if(bools){
			$('.lottery_input').val('');
		}
		var numberarray = [];
		$("#k3ethfx .ball_number.curr").each(function(index){
			var numbers = $(this).attr('ball-number');
			numberarray.push(numbers);
		});
		
		submit_order(playid,numberarray.join("#"),number,numberarray.length,$("#"+playid));
	});
	//三不同号
	$(document).on('click','#k3sbthbz .ball_item', function () {
		var obj = $(this);
		var text = obj.text(),number = obj.find('a').attr('ball-number'),playid = 'k3sbthbz';
		var rate = rates[playid];
		var bools = true;
		// if($("#k3sbthbz .ball_number.curr").length<3){
		// 	alt('请至少选择3组号码组成一注',-1);return false;
		// }
		$('#k3sbthbz').find('.ball_number').each(function (){
			if($(this).hasClass('curr')){
				bools = false;
			}
		})
		if(bools){
			$('.lottery_input').val('');
		}

		var numberarray = [];
		$("#k3sbthbz .ball_number.curr").each(function(index){
			var number = $(this).attr('ball-number');
			numberarray.push(number);
		});
		var combinearr= combine(numberarray,3);

		submit_order(playid,combinearr.join("#"),number,combinearr.length,$("#"+playid));
	});
	//二不同号
	$(document).on('click','#k3ebthbz .ball_item', function () {
		var obj = $(this);
		var number = obj.find('a').attr('ball-number');
		var playid = 'k3ebthbz';
		var rate = rates[playid];
		// if($("#k3ebthbz .ball_number.curr").length<2){
		// 	alt('请至少选择2组号码组成一注',-1);return false;
		// }
		var numberarray = [];
		$("#k3ebthbz .ball_number.curr").each(function(index){
			var number = $(this).attr('ball-number');
			numberarray.push(number);
		});
		var combinearr= combine(numberarray,2);
		// orderList[0].number = combinearr.join("#");
		// console.log(combinearr.join("#"));
		submit_order(playid,combinearr.join("#"),number,combinearr.length,$("#"+playid));
	});
	//二同号单选
	$(document).on('click','#k3ethdx .ball_item', function () {
		var obj = $(this);
		var number = obj.find('a').attr('ball-number');
		var playid = 'k3ethdx';
		var rate = rates[playid];
		var removeNumber = 0;

		if(number.length > 1){
			removeNumber = number.substring(0,1);
		}else{
			removeNumber = number + number;
		}
		$('#k3ethdx .ball_item').find('a[ball-number="'+removeNumber+'"]').removeClass('curr');
		$('#lottery_sum_old_b').find('em[lottery_sum="'+removeNumber+'"]').remove();

		console.log($("#k3ethdx li ul").eq(0).find(".ball_number.curr").length);
		console.log($("#k3ethdx li ul").eq(1).find(".ball_number.curr").length);
		var numberarray = [];
		$("#k3ethdx li ul").eq(0).find(".ball_number.curr").each(function(index){
			var number = $(this).attr('ball-number');
			numberarray.push(number);
		});
		var numberarray1 = [];
		$("#k3ethdx li ul").eq(1).find(".ball_number.curr").each(function(index){
			var number = $(this).attr('ball-number');
			numberarray1.push(number);
		});

		var allarr = DescartesAlgorithm(numberarray, numberarray1);
			var array  = [];
			for(var i=0;i<allarr.length;i++){
				var tonghao = allarr[i][0];
				var danhao = allarr[i][1];
				if(tonghao.indexOf(danhao)>=0){
					
				}else{
					array[i] = allarr[i][0]+''+allarr[i][1];
				}
				//array[i] = allarr[i][0]+''+allarr[i][1];
			}
			array = filterArray(array);

		ethdxZhushu = array.length;
		betting_sum = ethdxZhushu;

		submit_order(playid,array.join("#"),number,array.length,$("#"+playid));

	});
	$(document).on('click','.popup-userbetshistory', function () {
	  $.popup('#userbetshistory');
	});
	
	$(document).on('click','#PageSwitch a[data-k3url]', function () {
		var url = $(this).attr('data-k3url');
		$('#PageSwitch').hide();
		window.location.href = url;
	});
});


var orderList=new Array();
function submit_order(_playid,_number,number,zhushu,obj,ishz){
	if(!ishz){
	var rate = rates[_playid];
	if(parseInt(rate.minjj)<1)rate.minjj = 1;
	if(parseInt(rate.maxprize)<1)rate.maxprize = 30000;
	zhushu = zhushu?parseInt(zhushu):0;
	var trano = generateMixed(20);
	var array = { 
		'trano':trano,
		'playtitle':rate.title,
		'playid':rate.playid,
		'number':_number,
		'zhushu':zhushu?parseInt(zhushu):0,
		'price':0,
		'minxf':rate.minxf,
		'totalzs':rate.totalzs,
		'maxjj':rate.maxjj,
		'minjj':rate.minjj,
		'maxzs':rate.maxzs,
		'rate':rate.rate
	}; 
	orderList=new Array();
	orderList.unshift(array);//push (unshift)ie兼容待测试
	}
	var node = $(obj);

	// console.log(orderList);
	// console.log(_playid,_number,number,zhushu,obj)
	//增加的开始
	yzhushu = zhushu;
	lottery_touzhufn(number,zhushu);

	lottery_yuji_money(maxRates?maxRates:rate.rate)
	//lottery_yuji_money(rate)
	//增加的结束
}

$(document).on('click','.betting_right_btn',function () {

	// console.log(orderList,lottery.currFullExpect,lotteryname);

	if($('.lottery_input').val()=='' || parseInt($('.lottery_input').val())<1){
			alt('请设置投注金额',-1);return false;
	}

	if(parseInt($('.betting_sum').text())<1 || parseInt($('.betting_sum').val())<1){
			alt('最少选择一注',-1);return false;
	}
	var lottery_number = '';
	var lottery_moneyOld = parseInt($('.betting_sum_moery').text());
	if(orderList.length > 1){
		for(var i=0;i<orderList.length;i++){
			orderList[i].price = parseInt($('.lottery_input').val());
		}
	}else{
		orderList[0].price = parseInt($('.lottery_input').val());
	}
	$('#lottery_sum_old_b').find('.lottery_sum_old').each(function () {
		lottery_number = lottery_number + $(this).attr('lottery_sum') + '/' ;
	})
	var html = '';
	html += '<div class="clearfix"><div class="pull-left" style="width:100px;">'+lottery.shortname+':</div><div class="pull-left" way-data="showExpect.shortname">'+lottery.currFullExpect+'期</div></div>';
	html += '<div class="clearfix"><div class="pull-left" style="width:100px;">投注金额:</div><div style="margin-left:0; text-align: left;white-space:normal;word-break:break-all;word-wrap:break-word:;"><span style="color:red;">'+lottery_moneyOld+'</span>元</div></div>';
	html += '<div class="clearfix"><div class="pull-left" style="width:100px;">投注内容:</div><div style="margin-left:100px; text-align: left;white-space:normal;word-break:break-all;" id="ordertotalprice">'+lottery_number+'</div></div>';

	$.modal({
            text: html,
            buttons: [ 
				{text: '取消', onClick: function(){
					
				}},
				{text: '投注',bold: true, onClick: function(){
					$.showPreloader('正在投注')
					$.post(apirooturl + 'k3buy',{"orderList":orderList,'expect':lottery.currFullExpect,'lotteryname':lotteryname}, function(json){
						if(json.sign){
							lottery_empty();
							getUserBetsListToday(lotteryname);
							alt('投注成功',1);
						}else{
							alt(json.message,-1);
						}
						$.hidePreloader();
					},'json'); 
				}}
			]
   });

})

var yrate = 0;
$(document).on('change keyup','.lottery_input',function () {
	lottery_yuji_money(maxRates);
})

$(document).on('click','.betting_empty',function () {
	lottery_empty()
})

$(document).on('click','.kuaijie_money_ul .kuaijie_item',function () {
	var sum = parseInt($(this).text());
	$('.lottery_input').val(sum);
	lottery_yuji_money(maxRates);
})

function lottery_empty() {
	$('#lottery_sum_old_b').html('');
	$('.lottery_input').val('');
	$('.max_money').text(0);
	$('.betting_sum').text(0);
	$('.betting_sum_moery').text(0);
	$('.ball_list_ul').find('.ball_number').removeClass('curr');
	maxRates = 0;
	ratesArr = [];
	$('.lottery_footer_sum').hide();
	$('.lottery_inputBox').hide();
	$('.betting_sum_box').hide();
	$('.kuaijie_money').hide();
}

function max_number(arr){
	var max = arr[0];
	var len = arr.length;
	for (var i = 1; i < len; i++){ 
	if (arr[i] >= max) { 
		max = arr[i]; 
	}
	}
	return max;
}

function lottery_multiple(rate,removeRate){
	var bool = true;
	rate = parseFloat(rate);
	if(removeRate){
		for(var i = 0;i < ratesArr.length;i++){
			if(ratesArr[i] == removeRate){
				ratesArr.splice(i,1);
			}
		}
		maxRates = max_number(ratesArr);
		if(orderList[0].playid == "k3sbthbz"){
			maxRates = rate;
		}
		if(orderList[0].playid == "k3sthdx"){
			maxRates = rate;
		}
		if(orderList[0].playid == "k3ethfx"){
			maxRates = rate;
		}
		if(orderList[0].playid == "k3ebthbz"){
			maxRates = rate;
		}
		if(orderList[0].playid == "k3ethdx"){
			maxRates = rate;
		}
		return;
	}

	if(ratesArr.length > 0){
		for(var i = 0;i < ratesArr.length;i++){
			if(ratesArr[i] == rate){
				bool = false;
			}
		}
		if(bool){
			ratesArr.push(rate);
		}
	}else{
		ratesArr.push(rate);
	}
	
	
	maxRates = max_number(ratesArr);
}

function lottery_yuji_money(rate) {
	var inputVal = $('.lottery_input').val();
	var sum = isNaN(parseInt(inputVal))?0:parseInt(inputVal);
	betting_sum_moery = isNaN(parseInt($('.lottery_input').val()))?0:parseInt($('.lottery_input').val());
	$('.betting_sum_moery').text(betting_sum_moery * betting_sum);
	if(sum != inputVal || !rate){
		$('.lottery_input').val("");
		$('.lottery_input_text').html('最高可中<em style="color:#f4c829;" class="max_money">0</em>元');
		return;
	}
	
	//sum.toFixed(2);
	var _thisMoney = isNaN(sum)?0:sum;
		//_thisMoney = _thisMoney.toFixed(2);
	//var rates = parseFloat(rate);
		//rates = rates.toFixed(2);
	if(_thisMoney < 0 ){
		_thisMoney = '';
	}

	if(yzhushu > 0){
		_thisMoney = _thisMoney * rate;
		_thisMoney = _thisMoney.toFixed(2);
		$('.lottery_input_text').html('最高可中<em style="color:#f4c829;" class="max_money">'+_thisMoney+'</em>元');
	}else{
		$('.lottery_input_text').html('最高可中<em style="color:#f4c829;" class="max_money">0</em>元');
	}
	
}
var betting_sum_moery = 0;
function lottery_touzhufn(number,zhushu){
	var lottery_sum_old_list = $('#lottery_sum_old_b').find('.lottery_sum_old');
	var _this_sum;
	if(lottery_sum_old_list.length > 0){
		lottery_sum_old_list.each(function (i) {
			if($(this).attr('lottery_sum') == number){
				_this_sum = $(this).attr('lottery_sum');
			}
		})
		if(_this_sum == number){
			$('#lottery_sum_old_b').find('.lottery_sum_old[lottery_sum="'+_this_sum+'"]').remove();
			if(orderList[0].playid == 'k3sbthbz' || orderList[0].playid == 'k3ebthbz'){
				$('.betting_sum').text(zhushu);
				betting_sum = zhushu;
			}else if(orderList[0].playid == 'k3ethdx'){
				$('.betting_sum').text(ethdxZhushu);

			}else{
				betting_sum = parseInt(zhushu);
				//orderList[0].zhushu = betting_sum;
				$('.betting_sum').text(betting_sum);
			}
			
			betting_sum_moery = isNaN(parseInt($('.lottery_input').val()))?0:parseInt($('.lottery_input').val());
			$('.betting_sum_moery').text(betting_sum_moery * betting_sum);
			lottery_multiple(orderList[0].rate,orderList[0].rate);
		}else{
			if(orderList[0].playid == 'k3sbthbz' || orderList[0].playid == 'k3ebthbz'){
				$('.betting_sum').text(zhushu);
				betting_sum = zhushu;
			}else if(orderList[0].playid == 'k3ethdx'){
				$('.betting_sum').text(ethdxZhushu);
			}else{
				betting_sum = parseInt(zhushu);
				//orderList[0].zhushu = betting_sum;
				$('.betting_sum').text(betting_sum);
			}
			
			$('#lottery_sum_old_b').append('<em class="lottery_sum_old" lottery_sum="'+number+'"  >'+number+'</em>');
			betting_sum_moery = isNaN(parseInt($('.lottery_input').val()))?0:parseInt($('.lottery_input').val());
			$('.betting_sum_moery').text(betting_sum_moery * betting_sum);
			lottery_multiple(orderList[0].rate);
		}

	}else{
		if(orderList[0].playid == 'k3sbthbz' || orderList[0].playid == 'k3ebthbz'){
			$('.betting_sum').text(zhushu);
			betting_sum = zhushu;
		}else if(orderList[0].playid == 'k3ethdx'){
			$('.betting_sum').text(ethdxZhushu);
		}else{
			betting_sum = parseInt(zhushu);
			//orderList[0].zhushu = betting_sum;
			$('.betting_sum').text(betting_sum);
		}
		$('#lottery_sum_old_b').append('<em class="lottery_sum_old" lottery_sum="'+number+'"  >'+number+'</em>');
		betting_sum_moery = isNaN(parseInt($('.lottery_input').val()))?0:parseInt($('.lottery_input').val());
		$('.betting_sum_moery').text(betting_sum_moery * betting_sum);
		lottery_multiple(orderList[0].rate);
	}
}
//快速设置金额
$(document).on('click','[data-setbetmoney]', function () {
	var setbetmoney = $(this).attr('data-setbetmoney');
	var trano       = $(this).attr('data-trano');
	var zhushu       = $(this).attr('data-zhushu');
	var node = $('#usebetting_moneys');
	var money = 0;
	if(node.val()=='' || parseInt(node.val())<1){
		money = setbetmoney;
	}else{
		money = parseInt(node.val()) + parseInt(setbetmoney);
	}
	node.val(money);
	changebetokmoney(money,zhushu);
	changeorderprice(money,trano);
});
function accMul(arg1,arg2)
{
	var m=0,s1=arg1.toString(),s2=arg2.toString();
	try{m+=s1.split(".")[1].length}catch(e){}
	try{m+=s2.split(".")[1].length}catch(e){}
	return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m)
}

function changebetokmoney(price,zhushu){
	var $totalprice = accMul(price,zhushu);
	$("#ordertotalprice").text($totalprice.toFixed(2));
	//console.log($totalprice);
};
var changeorderprice=function(price,id){
	if(orderList.length>=1)for (var i = 0; i < orderList.length; i++) {
		var cur_order = orderList[i];
		if (cur_order.trano == id) {
			orderList[i]['price'] = price;
		}
	}
	//console.log(orderList);
	//console.log(orderList);
};

function GamePageSwitchToggle(){
	$("#PageSwitch").toggle();
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
var Gameinit = function (_lotteryname) {
	clearInterval(openCodeTimeOut);
	lotteryname = _lotteryname;
	lotterytimes(_lotteryname);
	lotteryopencodes(_lotteryname);
	getUserBetsListToday(_lotteryname);
}

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
					//way.set("showExpect.currFullExpect",lottery.currFullExpect);
					$("[way-data='showExpect.currFullExpect']").text(lottery.currFullExpect);
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
	var html='',$node = $("#fn_getoPenGame").find('tbody');
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
					
				html += '<tr><td class="fz13">'+openinfo.expect+'</td><td class="c_red fb">'+openinfo.opencode+'</td><td class="c_blue fb">'+sum+'</td><td>'+smallbig+'&nbsp;|&nbsp;'+oddeven+'</td></tr>';
				
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
	/*var url = apirooturl + 'lotteryrates';
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
	});*/
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
						var openCode = msg.data.opencode;
						var openCodes = openCode.split(',');
						stopLottery(openCode);
                        lotteryopencodes(lotteryname);
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
}
//异步去取上一次的开奖结果和中奖情况
function openResult() {
   // var expect = way.get("showExpect.lastExpect");
}

/**
 * 当天投注记录
 * @param shortName
 */
var jqueryGridPage = 1;
var jqueryGridRows = 10;
function getUserBetsListToday(_lotteryname) {
	if(!user || user.islogin!=1){
		return false;
	}
	lotteryname = _lotteryname?_lotteryname:lotteryname;
	var tabs = $("#userbetshistorylist");
    tabs.empty();
	var url = apirooturl + 'betslisttoday';
	var pagination = $.pagination({
		render: '.paging',
		pageSize: jqueryGridRows,
		pageLength: 3,
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
				var html = '';
				html += '<li id="'+val.trano+'">';
				html += '<div class="item-inner item-content">';
				html += '<div class="item-title-row">';
				html += '<div class="item-title">'+val.cptitle+'('+val.expect+'期)</div>';
				if(val.isdraw == -1) { // 未中奖绿色
					html += '<div class="item-after"><t style="color:green">未中奖</t></div>';
				} else if(val.isdraw == 1) { // 已中奖红色
					html += '<div class="item-after"><t style="color:red">已中奖</t></div>';
				}else if(val.isdraw == -2) {
					html += '<div class="item-after"><del>已撤单</del></div>';
				}else if(val.isdraw == 0) {
					html += '<div class="item-after"><t class="state" onclick="javascript:getBillInfo(\''+val.trano+'\')" style="color:red;cursor:pointer;">撤单</t></div>';
				}else{
					html += '<div class="item-after"><t>未知状态</t></div>';
				}
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '玩法:' + val.playtitle + '(' + val.mode + ')';
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '单号:'+val.trano;
				html += '</div>';
				html += '<div class="item-subtitle">';
				html += '金额:' + val.amount + ',注数:' + val.itemcount + ',中奖金:' + (val.okamount ? val.okamount : 0) + ',中注数:'+ val.okcount;
				html += '</div>';
				html += '</div>';
				html += '</li>';

				tabs.append(html);
			});
		},
		pageError: function(response) {},
		emptyData: function() {}
	});
	pagination.init();
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

    if (t > 0) {
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
        CDTime = setInterval(function() {
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
            } else {
                //audioPlay(2);
                clearInterval(CDTime);
                (eval(callback))(shortName);

            }
        }, 500);

    } else {
        (eval(callback))(shortName);
    }
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
