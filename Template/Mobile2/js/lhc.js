var lotteryname = null;
var lottery;
var openLotteryList = 0;
var openCodeTimeOut = null;
var ckTimer;
var ClockEnv = {
	num:7,
	numRange:'01-49'
};
var openexpect = 0;
$(function () {

  lotteryname = null;
	var lotteryurl = window.location.search;
	lotteryname = lotteryinfo.name;
	if(lotteryname!='undefined'){
		Gameinit(lotteryname);
	}else{
		lotteryname = 'lhc';
		Gameinit(lotteryname);
	};

})

var Gameinit = function (_lotteryname){
  lotteryopencodes(_lotteryname);
  lotterytimes(_lotteryname);
}


//获取开奖时间
var yIndex = 1;
var lotterytimesId;
var lotterytimes = function(lotteryname){
	clearTimeout(lotterytimesId);
	var ret = null;var retopen = null;
	var url = apirooturl + 'lotterytimes';
	$.post(url, {'lotteryname':lotteryname,'cptype':'lhc'}, function(data) {
		// var data =  {"sign":true,"message":"获取成功","data":{"lastFullExpect":"20171010023","lastExpect":"023","currFullExpect":"20171010024","currExpect":"024","remainTime":2082,"openRemainTime":120,"shortname":"六合彩","status":"1","message":"OK"}}
		if(data.sign==true){
			lottery = data.data;
			way.set("showLotteryTitle.name", lottery.shortname);
			way.set("showExpect", lottery);
			openLotteryList = $('#lhc_winning_sum').find('li');
			openLotteryList.each(function (i) {
				//setLotterNumber(i,'gif')
			})
			if(yIndex > 1){
				loginCengBoxFn(lottery.lastFullExpect+'期已截止<br />当前期号<span style="color:red;">'+lottery.currFullExpect+'</span><br />投注时请注意期号');
			}
			yIndex++;
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


//开奖公告
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
											  
        var yopentimes = format(openinfo.opentime * 1000);
        var yopentimes_arr = yopentimes.split(' ');
        var yopentime = yopentimes_arr[1];
				html += '<tr><td width="130" style="border-right: 1px solid #a7a182;">'+openinfo.expect+'</td><td width="46" class="c_red fb" style="padding:5px;color:red;">'+openinfo.opencode+'</td><td width="40" class="c_blue fb" style="padding:5px;">'+yopentime+'</td></tr>';
				
			}
			$node.html(html);
		}else if(data.sign==false){
			lotteryopencodesid = setTimeout(function () {
				lotteryopencodes();
			}, 5000);
		}
	  },'json');
}
function lhcMobileKaiHtml(Numarr){
	var html = '';
	var lhcNumberData = '';
	for(var i = 0; i < Numarr.length; i++){
		lhcNumberData = eval('lhc_numData.lhc_'+Numarr[i]);
		if(i == Numarr.length - 1){
			html += '<div class="lhcKaiGG">+</div>';
		}	
		html += '<div class="lhcKaiGG"><span class="lhc_'+lhcNumberData.bo+'_color">'+Numarr[i]+'</span><em>'+lhcNumberData.sx+'</em></div>';	
	}
	return html;
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
                        var yopentimes = format(msg.data.opentime * 1000);
                        var yopentimes_arr = yopentimes.split(' ');
                        var yopentime = yopentimes_arr[1];
                        var html = '<tr><td class="lsqh" style="border-right: 1px solid #a7a182;">' + openexpect + '</td><td style="padding:5px;color:red;" class="c_red fb';
                        html += '">';
                        for (var j = 0; j < openCodes.length; j++) {
                          if(j == openCodes.length - 1){
                            html += openCodes[j];
                          } else {
                            html += openCodes[j] + ',';
                          }
                        }
                        html += '</td><td class="c_blue fb" style="padding:5px;">'+yopentime+'</td></tr>';
                        if (openCodeListVal.indexOf(openexpect) < 0) {
																		
                            $(".lishi").find('table').find('tbody').prepend(html);          
                        }
                        stopLottery(openCode);
                    }
                } else {
                    ret = true;
                }
				var lastExpect = way.get("showExpect.expect");
				if (lastExpect == openexpect && msg.data.opencode.length<=0) {
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


function add0(m){return m<10?'0'+m:m }

/**
 * 
 * 
 * @param {shijianchuo} 是整数，否则要parseInt转换
 * @returns 时间格式
 */
function format(shijianchuo){
  var time = new Date(shijianchuo);
  var y = time.getFullYear();
  var m = time.getMonth()+1;
  var d = time.getDate();
  var h = time.getHours();
  var mm = time.getMinutes();
  var s = time.getSeconds();
  return y+'-'+add0(m)+'-'+add0(d)+' '+add0(h)+':'+add0(mm)+':'+add0(s);
}


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
                h = Math.floor(t / 1000 / 60 / 60);
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
var s_sum1 = 0;
var s_sum2 = 0;
var s_sum3 = 0;
var s_sum4 = 0;
var s_sum5 = 0;
var s_sum6 = 0;
var s_sum7 = 0;
var openLotteryListC = '';

function openLottery1(maxnum) {
	s_sum1 = Math.round(Math.random() * (maxnum - 1) + 1);
	way.set("showExpect.openCode1", s_sum1);
}

function openLottery2(maxnum) {
	s_sum2 = Math.round(Math.random() * (maxnum - 1) + 1);
	way.set("showExpect.openCode2", s_sum2);
}

function openLottery3(maxnum) {
	s_sum3 = Math.round(Math.random() * (maxnum - 1) + 1);
	way.set("showExpect.openCode3", s_sum3);
}

function openLottery4(maxnum) {
	s_sum4 = Math.round(Math.random() * (maxnum - 1) + 1);
	way.set("showExpect.openCode4", s_sum4);
	// way.set("showExpect.openCode4", Math
		  
	// 		.round(Math.random() * (maxnum - 1) + 1));
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
									 
	way.set("showExpect.openCode9", Math.round(Math.random() * (maxnum - 1) + 1));
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
			f_codec(nums[7], 7);
//			if(nums.length==8){
//				showLottery();
//			}
		}, 4000);
	}
	if (nums.length >= 7) {
		setTimeout(function() {
			clearInterval(T7);
							  
			way.set("showExpect.openCode7", nums[6] + "");
			f_codec(nums[6], 6);
//			if(nums.length==7){
//				showLottery();
//			}
		}, 3500);
	}
	if (nums.length >= 6) {
		setTimeout(function() {
			clearInterval(T6);
							  
			way.set("showExpect.openCode6", nums[5] + "");
			f_codec(nums[5], 5);
//			if(nums.length==6){
//				showLottery();
//			}
		}, 3000);
	}
	if (nums.length >= 5) {
		setTimeout(function() {
			clearInterval(T5);
   
			way.set("showExpect.openCode5", nums[4] + "");
			f_codec(nums[4], 4);
			// if(nums.length==5){
			// 	showLottery();
			// }
		}, 2500);
	}
	if (nums.length >= 4) {
		setTimeout(function() {
			clearInterval(T4);
   
			way.set("showExpect.openCode4", nums[3] + "");
			f_codec(nums[3], 3);
//			if(nums.length==4){
//				showLottery();
//			}
		}, 2000);
	}
	if (nums.length >= 3) {
		setTimeout(function() {
			var openLotteryList = $('#lhc_winning_sum').find('li');
			clearInterval(T3);
     
			way.set("showExpect.openCode3", nums[2] + "");
			f_codec(nums[2], 2);
//			if(nums.length==3){
//				showLottery();
//			}
		}, 1500);
	}
	if (nums.length >= 2) {
		setTimeout(function() {
			var openLotteryList = $('#lhc_winning_sum').find('li');
			clearInterval(T2);
      
			way.set("showExpect.openCode2", nums[1] + "");
			f_codec(nums[1], 1);
//			if(nums.length==2){
//				showLottery();
//			}
		}, 1000);
	}
	if (nums.length >= 1) {
		setTimeout(function() {
			clearInterval(T1);
   
			way.set("showExpect.openCode1", nums[0] + "");
			f_codec(nums[0], 0);
//			if(nums.length==1){
//				showLottery();
//			}
		}, 200);
	}
}
	function shengxiao_codes(){
		var
		ll = ['狗','猪','鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡'],
		kk = ((new Date).getFullYear() - 2019) % 12,
		qq = ll.splice(0, kk + 1), ss=[], oo = {};
		ll.push.apply(ll, qq);
		ll.reverse();
		for(var i=0;i<12;++i)
		{
			if(i===0)
			{
				oo[ll[i]] = ss[i] = [01,13,25,37,49];
				continue;
			}
			oo[ll[i]] = ss[i] = [
				ss[i-1][0] + 1,
				ss[i-1][1] + 1,
				ss[i-1][2] + 1,
				ss[i-1][3] + 1
			];
		}
		return oo;
	}




	window.f_shengxiao_codes = shengxiao_codes();

function f_color(num)
{
	switch(num)
	{
		case 1:case 2:case 7:case 8:case 12:case 13:case 18:case 19:
		case 23:case 24:case 29:case 30:case 34:case 35:case 40:case 45:case 46:
			return 1;
		case 3:case 4:case 9:case 10:case 14:case 15:case 20:case 25:case 26:
		case 31:case 36:case 37:case 41:case 42:case 47:case 48:
			return 2;
		case 5:case 6:case 11:case 16:case 17:case 21:case 22:case 27:case 28:
		case 32:case 33:case 38:case 39:case 43:case 44:case 49:
			return 3;
		default:
			return 0;
	}
}
function f_shenxiao(num)
{
	var codes = {};
	for(var i in f_shengxiao_codes)
	{
		for(var n in f_shengxiao_codes[i])
		{
			codes[f_shengxiao_codes[i][n]] = i;
		}
	}
	return codes[num] ? codes[num] : '??';
}
function f_codec(num, e)
{
	var ll = document.getElementById('lhc_winning_sum').getElementsByClassName('lhc_winning_sum_gif'), em, sp;
	if(ll[e])
	{
		em = ll[e];
		sp = em.firstElementChild.nextElementSibling;
		//em.className = em.className + [' blue',' red',' blue',' green'][f_color(num|0)];
		em.style.cssText =['background-image: -webkit-linear-gradient(top,#6ebefa,#218ddd 75%);',
		'background-image: -webkit-linear-gradient(top,#f87b7e,#dc3b40 75%);',
		'background-image: -webkit-linear-gradient(top,#6ebefa,#218ddd 75%);',
		'background-image: -webkit-linear-gradient(top,#69d893,#38b366 75%);'][f_color(num|0)];
		sp.innerHTML = f_shenxiao(num|0);
	}
}


function setLotterNumber(_index,_nums) {
	if(openLotteryList == 0){
		openLotteryList = $('#lhc_winning_sum').find('li');
	}
	var lhcsxList = $('.lhc_sxTextUl').find('li');
	// openLotteryListC = openLotteryList.eq(_index).attr('class');
	// openLotteryListC = openLotteryListC.substring(0,openLotteryListC.lastIndexOf('_')+1);
  if(_nums == 'gif'){
		openLotteryList.eq(_index).attr('class','lhc_winning_sum_gif');
		lhcsxList.eq(_index).text('');
    $('#lhc_winning_sum').find('li').css('text-indent','-9999px');
  }else{
		var lhcNumberData = eval('lhc_numData.lhc_'+_nums);
		openLotteryList.eq(_index).attr('class','lhc_'+lhcNumberData.bo+'_bg');
		lhcsxList.eq(_index).text(lhcNumberData.sx);
    $('#lhc_winning_sum').find('li').css('text-indent','0');
  }

}