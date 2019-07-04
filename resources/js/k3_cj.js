var betTime = 0;
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

function refresh(){
	window.location.reload();
}
function popUpTip(){

	var i=10;
	var tipMsg = "您好,第<span style='color:red'>"+  10 + "</span>期已截止.投注时请确认您选择的期号.<br>" + i + "s后将自动关闭";
	
	var d = dialog({
		 width: 460,
		 height: 80,
		 top : 200,
		 left: 200,
		 title: '提示',
		 ok: function () {
			 if(interval){
				 clearInterval(interval);
			 }
		 },
	     content: tipMsg
	   
	});
	d.showModal();
	setTimeout(function () {
	    d.close().remove();
	}, 10000);
	
	var interval = setInterval(function(){
		i--;
		if( i <= 1){
			clearInterval(interval);
		}
		d.content(i);
	},1000);
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
			$('#countDownTime').css({'font-size':'22px','color':'#fff'}).html("正在开奖......");
		//$('#countDownTime').css({'color':"#ffffff"}).html("00:00:00");
    }else{
        
        // 下一期自动刷新页面
        if( betTime == 0){
			//GetNextDrawTime();
        	//setTimeout("refresh()", 5000);
        }
		if(betTime<cpdata.tzclosetime){
			$('#countDownTime').css({'font-size':'36px','color':'green'});
		}else{
			$('#countDownTime').css({'font-size':'36px','color':'#fff'});
		}
        gameHasEnd = 0;
        var str = formatSeconds(betTime);
        if($('#countDownTime').size()>0) $('#countDownTime').html(str);
    }
	betTime = betTime - 1;
	if(betTime<0 && betTime%5==0){
		if(cpdata.cpstatus==1)CheckLotteryKj();
	}
    tm=setTimeout("setOutTime()", 1000);
}
/*撤单*/
function MyLotteryCheDan(trano){
	if(!trano || trano=='')return false;
	msg = '您确定撤销下注吗';
	$.typebox({
		'title' : '温馨提示',	
		'width': '400',
		'height' : '150',
		'content' : msg,
		'padding' : 10,
		'type' : 'text',
		'call' :function(){
			$('#typeboxSubmit').attr('disabled',true).html('正在撤单...');
			$.ajax({type: "POST",
				url: baseUrl+"/index.php?g=Home&m=User&a=MyLotteryCheDan&rand="+Math.random(),
				data:"trano="+trano+'&type='+lottery_type,
				dataType: "json" ,
				cache : false,
				success: function(json){
					if(json.status==1){
						CP.tip('撤单成功...');
						CP.core.clearAll();
						$("#history_"+trano).html("撤")
					}else{
						CP.tip(json.msg);
						CP.core.clearAll();
					}
				}
			});
		}
	});
   $(".submit_btn").removeAttr("disabled");
   CP.core.clearAll();
}
/*下注历史*/
function GetHistoryJilu(){
	$.post("/index.php?g=Home&m=User&a=GetLotteryHitory&num=15&type="+lottery_type,'', function(data){
		if(!data)return false;
		 html='';
		$.each(data,function(index,a){
			if(a.status==0){
				hs='<span class="che_ico" onclick="MyLotteryCheDan(\''+a.id+'\')">撤</span>';
			}else if(a.status==1){
				hs='<span class="c_green">中</span>';
			}else if(a.status==-1){
				hs='输';
			}else if(a.status==-2){
				hs='撤';
			}
			html += '<tr><td align="center">'+a.trano+'</td><td align="left"><span class="c_red">'+a.catname+'@'+a.ball+'@'+a.amount+'</span></td><td align="center" id="history_'+a.id+'">'+hs+'</td></tr>';
		});/**/
	 $('#GameHistory').html(html); 
	}, "json");
}
function GetLotteryRes(){
	var num=15;
	if(user.isLogin){
		$(".gamelist").show();
		GetHistoryJilu();
		num=10;
	}
	$.post("/index.php?g=Home&m=Cp&a=GetLotteryRes&num="+num+"&lotterytype="+lottery_type,{}, function(data){
		if(!data)return false;
		 html='';
		$.each(data,function(index,item){
			html += '<tr data-period="'+item.qihao+'"><td align="center">'+item.qihao+'</td><td align="center"><span class="c_red">'+item.balls+'</span></td><td align="center">'+item.hezhi+'</td><td align="center"><span class="xiao_ico"> '+item.daxiao+'</span>&nbsp;|&nbsp;<span class="shuang_ico">'+item.danshuang+'</span></td></tr>';
		});
	 $('#awardNumBody').html(html); 
	}, "json");
}
function waitAward(){
	if($('#awerdNum_balls').size()	>0) $('#awerdNum_balls').html('<div class="opening" id="is_opennig">正在开奖，请稍后...</div>');
}
function BallsAward(){
	var data = cpdata;
	  $('#prevWin').html(data.qihao);
	  var args = data.balls.split(',');
	  html='';
	  var hz = 0;
	  for(var w=0;w<args.length;w++){
		  html+= '<span class="hm_'+ args[w] + '"></span>'; 
		  hz = hz + parseInt(args[w],10);
	  }
	  
	  var d = hz > 10 ? '<span class="da_ico"> 大</span>' : '<span class="xiao_ico"> 小</span>';
	  
	  var e = hz%2 == 0 ? '<span class="shuang_ico">双</span>':'<span class="dan_ico">单</span>';

	  
	  if( $('#kjxthz').size() > 0 ){
		var h = '和值：<span id="lottery_hz">' + hz + '</span> 型态：' + d + '&nbsp;&nbsp;' + e;
		$('#kjxthz').html(h);
	  }
	  if($('#awerdNum_balls').size()>0) $('#awerdNum_balls').html(html);
}

function toggleColor(id, arr, s) {
    var self = this;
    self._i = 0;
    self._timer = null;
    
    self.run = function() {
        if(arr[self._i]) {
            $(id).css('color', arr[self._i]);
        }
        self._i == 0 ? self._i++ : self._i = 0;
        self._timer = setTimeout(function() {
            self.run(id, arr, s);
        }, s);
    }
    self.run();
}

function CheckLotteryKj(){
	var url = CheckLotteryKjUrl+"&qihao="+nowqihao;
	$.post(url,{}, function(data){
		if(parseInt(data.qihao)>=parseInt(nowqihao)){
			loadWinInfo();
		}
		/*if(data.qihao!=nowqihao && parseInt(data.qihao)<parseInt(nowqihao)){
			
		}*/
	}, "json");
}
function GetNextDrawTime(){
	clearTimeout(tm);
	$.post("?g=Home&m=Cp&a=GetNextDrawTime&type="+lottery_type,{}, function(data){
		if(data.type==lottery_type){
			$('#theCur').html(data.qihao3);
			$('#proName').val(data.qihao3);
			betTime = data.leftTime3;
			//TmpbetTime = data.leftTime3;
			setOutTime();
		}
	}, "json");
}
function loadWinInfo(){
	$.post(LoadUrl,{}, function(data){
		if(data.name==lottery_type){
			cpdata = data;
			firstEnter = false; 
			$("#prevWin").html(data.qihao);
			awardSeconds = data.tzclosetime;
			BallsAward();
			$('#theCur').html(data.nextqihao);
			$('#proName').val(data.nextqihao);
			betTime = data.leftTime;
			TmpbetTime = data.leftTime;
			nowqihao   = data.nextqihao;
			$('#theCur').html(data.nextqihao);
			$('#proName').val(data.nextqihao);
			betTime = data.leftTime;
			//TmpbetTime = data.leftTime3;
			clearTimeout(tm);
			setOutTime();
			GetLotteryRes();
			//GetNextDrawTime();
			
		}
	}, "json");
}


function loadRecentResult(){
	
	if( typeof(recentNum) == "undefined" ) recentNum = 15;

	var url = baseUrl + "/index.php?m=lottery&c=index&a=loadRecentResult&lottery_type="+lottery_type  + "&recentNum=" + recentNum;

    $.ajax({type: "POST",

        url: url,

        dataType: "json" ,

        data:{},

        cache : false,

        success: function(json){

            if(json){

                	 html='';
                	
                	 for(var w=0;w<json.length && w< recentNum;w++){

                		 var data = json[w];

	                		 html += '<tr data-period="' + data.proName + '"><td align="center">'+data.proName + '</td> <td align="center"> <span class="c_red">'+ data.codes + "</span></td>"; 

                		 var args = data.codes.split(',');

                		 var hz = 0;

                		 for(var i=0;i<args.length;i++){

	 	                	var value = args[i];

	 	                	hz = hz+parseInt(value,10);

	 	                  }
                		 
                		 var d= '';
                		 if( hz <= 10 ){
                			 d = '<span class="xiao_ico"> 小</span>'; 
                		 } else if( hz > 10 ){ d = '<span class="da_ico"> 大</span>'; } ;
                		 
                		 var e = hz%2 == 0 ? '<span class="shuang_ico">双</span>':'<span class="dan_ico">单</span>';
                		 
                		 html += '<td align="center"  >'+ hz + '</td><td align="center">  ' + d + '&nbsp;|&nbsp;' + e + '</td></tr>'
                		 
                		
 	                }

                	 $('#awardNumBody').html(html); 
                   }

            }

    });

}

function loadWinForUser(win,pre ,clear,timer){


    var url = baseUrl+'/index.php?m=lottery&c=index&a=win&lottery_type='+lottery_type;

    if(win){
        url+='&winCode='+encodeURIComponent(win);
    }

    if(pre){
        url+='&winPre='+encodeURIComponent(pre);
    }

    if(user.isLogin == '1'){

        $.ajax({type: "POST",

            url: url,

            dataType: "json" ,

            data:'userId='+user.uid+'&uPoints='+user.points,

            cache : false,

            success: function(json){
                if(json){
                    if(json.tip!='login'){
                        var winIssuse = $.cookie('theIssuse');
                        if(json.tip=='success' && winIssuse == json.issuse){
                            win_tips('恭喜您，您在<stong>'+json.issuse+'</stong>期中已经中奖');
                            if($('.enter_digital').size()>0){
                                $('.enter_digital').text(json.amount);
                            }

                            $.cookie('winIssuse' ,json.issuse);

                        }

                    }

                }

            }

        });
    }

}

