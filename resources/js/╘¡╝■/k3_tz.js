	/**
 * @namespace 彩票
 * @name CP
 * @author aries
 */
var CP = {};
var $dom={
    box_ball_HZ : $('#box_ball_HZ_num li'),//和值选号区
    box_ball_HZ_SINGLE : $('#box_ball_HZ_single li'),//和值选号区
    has_add_ball : $('#has_add_ball li'), //已经添加到选区中的号码
    has_add_box : $('#has_add_ball'),
    box_ball_3THTX : $('#box_ball_3THTX_num li'),
    box_ball_3THDX : $('#box_ball_3THDX_num li'),
    box_ball_3BTH : $('#box_ball_3BTH_num li'),
    box_ball_3LHTX : $('#box_ball_3LHTX_num li'),
    box_ball_2THFX : $('#box_ball_2THFX_num li'),
    box_ball_2THDX_single : $('#box_ball_2THDX_single li'),
    box_ball_2THDX : $('#box_ball_2THDX_num li'),
    box_ball_2BTH : $('#box_ball_2BTH_num li'),
    zhuiHao : $('#buyTypeZh'),
    playType : $('#playType'),
    gameName : $('#gameName'),
    countDownTime : $('#countDownTime')
//    tmpCodes : $('.tmpCodes')
};
var $data = {
    codes:[],
    price : 2
}

var $order = {};


var tou = [];

// 增加购买逻辑

var orders = new Object();

CP.init = function(){
    var t;
    $('#myTab3 li').click(function(){
        var id = $("#myTab3 li.active").attr("url");     
        var cotentAreaId = "box_ball_"+ id + "_num";
        var li = $('#'+ cotentAreaId + ' ul li');
        li.each(function(){
        	if( $(this).find(".num").hasClass('OneNum_active')){
        		$(this).find(".num").removeClass('OneNum_active');
        	}
        	if( $(this).hasClass('OneNum_active')){
        		$(this).removeClass('OneNum_active');
        	}
        });
        
        
        $('#myTab3 li').removeClass('active').addClass('normal');
        $(this).removeClass('normal').addClass('active');
        t = $(this).attr('val');
        $('.all_box').hide();
        $('#box_ball_'+t).show();
        CP.core.clearAll();
        
        var name = $(this).text();
        $dom.gameName.val(name);
      
        $dom.playType.val(t);
    });
    
    CP.core.SAN_THTX();
    CP.core.SAN_THDX();
    CP.core.SAN_BTH();
    CP.core.SAN_LHTX();
    CP.core.ER_THFX();
    CP.core.ER_THDX();
    CP.core.ER_BTH();
    CP.core.HZ();
    CP.core.TX();
    
    CP.zhui.registerZhuiHao();
    
}

/**
 * 追号
 */

CP.zhui = {
	// 注册追号事件	
	registerZhuiHao : function(){
		$dom.zhuiHao.bind('click',function(){
			
			// 自动生成
			var tmpCodes = $('.tmpCodes');
			
			if(tmpCodes.size()<=0){
			        CP.tip('请先选择要进行追号的号码');
			        $("input:radio[name='buyType']").eq(0).attr("checked",'checked');
			        return;
			 } else if( tmpCodes.size() >= 3 ){
				 CP.tip('目前只支持同时追号两个以下,请重新选择');
				 $("input:radio[name='buyType']").eq(0).attr("checked",'checked');
				 return ;
			 }else {
				 
				 // 如果没有输入金额
				 var totalVal = $('.totalsVal');
				 var xx = false;
				 totalVal.each(function(i){
					 var dd = $(this).val();
					 if( dd == ''){
						 CP.tip('必须填写金额,请重新填写'); 
						 $("input:radio[name='buyType']").eq(0).attr("checked",'checked');
						 xx = true;
					 }
				 });
				 
				 if(xx) return;		 
				 $(".expand").toggle();
				 CP.zhui.render();
			 }
		});
		
		
		$('#chaseCountSelect').change(function(){
			CP.zhui.render();
		});
		
		$('#allSelect').bind('click',function(){
		
			var isCheck = $(this).is(":checked");

			$(".checkNum").each(function(){
				$(this).attr('checked', isCheck);
			})
		});
		
		$("#daigou").bind('click',function(){
			if( $(this).is(':checked')){
				$(".expand").hide();
			}
		});
				
		
		$(".checkNum").bind('click',function(){	
			CP.zhui.setCurrentTotals();
			CP.zhui.setCurrentWin();
		});
	},
	
	render : function(){
		var tmpCodes = $('.tmpCodes');
		var touType = $('.txt-num'); 
		var html = '';
		    var totalVal = $('.totalsVal') ,eachPrice = 0 ,bingoMoney=$('.bingoMoney'); 
		    tmpCodes.each(function(i){
		        eachPrice = $.trim(totalVal.eq(i).val());
		        var addTotal = 0;
		        var odds = $.trim(totalVal.eq(i).attr('data-odd'));
		        type = touType.eq(i).text();
		        proName = $('#proName').val();
		        
		        var count =  $("#chaseCountSelect").val();
		        
		        var currentPeriod = proName.split('-')[1];
		        

		        for(var j=0;j<count ;j++){
		        	
		        	var currentPeriod = CP.zhui.getCurrentPeriod(proName);
		        	if( currentPeriod + j > num){
		        		break;
		        	}
		        	
		        	var val = $(this).val() ;
		        	 addTotal = addTotal + parseInt(eachPrice , 10); // 累计投注金额
		        	var tr = '';
		        	if( j%2 == 0){ 
		        		tr = '<tr >';
		        	} else {
		        		tr = '<tr class="greny">';
		        	}
		        	
					html += tr + '<td>'+ (j+1)	+'</td>'
					+'<td> <input checked="checked" class="checkNum checktime_' + i + '" name="checktime" type="checkbox" /> '
					+ '<span class="proNumber">'+ CP.zhui.getProNumber(proName,j) + '</span></td><td>' + type + '</td>'
					+ ' <td> <input style="ime-mode: disabled;" class="zhuiEachPrice zhuihaoInput_' + i + '" value="'+eachPrice +'" name="zhuihaoNumLeader" autocomplete="off" type="text" data-odd = '+ odds + ' /> '
					+ ' </td> <td><span class="addTotal_' + i + '"> ' + addTotal 
					+ ' </span></td> <td> <span class="winMoney_' + i + '">' + 0 + '</span></td>'
					+ '<input type="hidden" name="singleCodes[]" class="singleCodes" value="'+val+'" />'
					'</tr>';
				}
		 });
		 $('#zhuihaoBody').html(html);
		 
         CP.zhui.setCurrentWin();
        
         $(".checkNum").bind('click',function(){
 			CP.zhui.setCurrentTotals();
 			CP.zhui.setCurrentWin();
 		});
        
         tmpCodes.each(function(k){	
     		$('.zhuihaoInput_'+k).each(function(){
     	        $(this).keyup(function(){
     	            // 计算投注总额
     	        	CP.zhui.setCurrentTotals();
     	            CP.zhui.setCurrentWin();
     	            // 计算盈利
     	        });
     	    });
         });
        
		
		
	},
	
	getCurrentPeriod : function(proName){
		var proNumber = proName.split('-');
		
		return parseInt(proNumber[1] ,10);
	},
	
	/**
	 * 获取下一期的格式
	 */
	getProNumber : function(proName, i) {
		
		if(i == 0){
			return proName;
		}
		
		var proNumber = proName.split('-');
		if( proNumber[1].length == 2){
			var j = parseInt(proNumber[1] ,10) + i;
			if( j < 10){
				return proNumber[0]+'-0'+j;
			}
			return proNumber[0]+'-'+j;
		} else if ( proNumber[1].length == 3) {
			var j = parseInt(proNumber[1] ,10) + i;
			if( j < 10){
				return proNumber[0]+'-00'+j;
			}
			return proNumber[0]+'-0'+ j; 
		}
	},
	// 计算盈利金额
	getWinPoint : function(that ,odds, total){
		
		var odds = that.attr('data-odd');
        //if(!odds) odds = $('#getOdds').val();
		var val = that.val();
		
		//var win =  (1+odds) * eachPrice - total;
		// return win;
	},
	// 设置当前投注总额
	
	setCurrentTotals : function(){

		var eachPrice = $(".zhuihaoInput");
		
	    
	    var tmpCodes = $('.tmpCodes');
	    
	    tmpCodes.each(function(k){
	    	
	    	var addTotal = $(".addTotal_" + k);
	    	var checktime = $('.checktime_'+k);
	    	addTotal.each(function(i){
		    	var total = 0;
		    	if( ! checktime.eq(i).is(":checked") ){
		    		$(this).html(total);
		    		return;
		    	}

		    	$('.zhuihaoInput_' + k ).each(function(j){
		    		if( j > i  ){ return;}
		    		
		    		if( $(this).val() == '' || !(checktime.eq(j).is(":checked")) ){
			    			add = 0;
			    	} else {
			    		add = parseFloat($(this).val(),10);
			    	}
			    	total = total + add;
			    	});
		    	
		    	$(this).html(total);
		    });
	    	
	    });
	    
	    
	    
	},
	
	setCurrentWin : function(){
		
		var addTotal = $(".addTotal");    
	    var tmpCodes = $('.tmpCodes');
	    
	    tmpCodes.each(function(k){
	    	var bingoMoney = $('.winMoney_' + k);
	    	var checktime = $('.checktime_' + k);
	    	var eachPrice = $(".zhuihaoInput_" + k);
		    bingoMoney.each(function(i){
		    	var total = 0;
		    	var win = 0;
		    	
		    	if( ! checktime.eq(i).is(":checked") ){
		    		$(this).html(total);
		    		return;
		    	}
		    	
		    	eachPrice.each(function(j){
		    		if( j > i){ return;}
		    		if( $(this).val() == '' || !(checktime.eq(j).is(":checked"))){
			    		add = 0;
			    	} else {
			    		add = parseFloat($(this).val(),10);
			    	}
		    		
			    	total = total + add;
			    	if( j == i){
			    		var odds = parseFloat($(this).attr('data-odd'),10);
			    		var val = $(this).val() == '' ? 0 : parseFloat($(this).val(),10);
			    		win = val * ( odds);
			    		win = win - total;
			    	}
		    	 
		    	});

		    	$(this).html(CP.core.formatPrice(win));
		    });
	    });

	},
	
	
	showGetPrice : function(that){
		 var odds = that.attr('data-odd');
	        //if(!odds) odds = $('#getOdds').val();
	     var val = that.val();
	     var bingoPrice = val * odds;
	     bingoPrice = CP.core.formatPrice(bingoPrice);
	     that.parent().parent().find('.winMoney').html(bingoPrice);
	     
	},
	getTotals:function(){
	        var totals = 0 ,v = 0 ,_error = 0;
	        var checknum = $('.checkNum');
	        $('.zhuiEachPrice').each(function(i){
	            v = $.trim($(this).val());
            	if( checknum.eq(i).is(":checked")){
            	   totals = parseInt(totals,10)+parseInt(v,10);
            	}

	        });
	        return totals;
	  },
	  clearAll:function(){
	        $('#zhuihaoBody').empty();
	   }
	
}



CP.core = {
    getCodes : function(){
        var has_len = $data.codes.length;
        var code = [];
        if(has_len>0){
            $.each($data.codes,function(i){
                var arr = $data.codes[i].split('|');
                code.push(arr[1]);
            });
        }
        return code;
    },
    clearAll:function(){
        $data.codes.length = 0;
        $dom.box_ball_HZ.find(".num").removeClass('OneNum_active');
        $dom.box_ball_HZ_SINGLE.removeClass('OneNum_active');
        $(".select_num li").removeClass('OneNum_active');
        $dom.has_add_box.empty();
    },
    clearAllBall : function(){
    	$(".buyHm").attr("value","");
    	orders = new Object();
    },
    addBall:function(code,v,t){
        $data.codes.push(t+'|'+v);
        code.push(v);
        return code;
    },
    removeBall:function(code,v,t){
        if(code) code.splice($.inArray(v,code),1);
        $data.codes.splice($.inArray(t+'|'+v,$data.codes),1);
        return code;
    },
    initCount:function(){
        CP.core.bindDelete();
    },
    TX : function(){
    	var code=[];
        var _name = '通选';
        var _type = 'TX';
        var _get_odds;
        $('#box_ball_TX_num li').each(function(){
            $(this).click(function(){
                var val = $(this).find(".num").text().trim();
                var _id = $(this).find(".num").attr("id");
                if(CP.checkRepeatCodes(val ,_type)){
                   
                    if($(this).find(".num").hasClass('OneNum_active')){
                    	$(this).find(".num").removeClass('OneNum_active');
                    } else {

                      _get_odds = $('#TX_getodds_'+	val).text();

                	   $(this).find(".num").addClass('OneNum_active');
                	   CP.core.addBall(code,val,_type);
                       CP.core.render({type:_type,zhushu:1,code:val,odd:_get_odds} ,_name,_id);
                       CP.core.initCount();
                       $('#getOdds').val(_get_odds);
                    }
                }
            });
        });
        
    },
    HZ : function(){
        var code=[];
        var _name = '和值';
        var _type = 'HZ';
        var _get_odds;
        $dom.box_ball_HZ.each(function(){
            $(this).click(function(){
                var val = $(this).find(".num").text();
                var _id = $(this).find(".num").attr("id");
                if(CP.checkRepeatCodes(val ,_type)){
                   
                    if($(this).find(".num").hasClass('OneNum_active')){
                    	$(this).find(".num").removeClass('OneNum_active');
                    } else {
                    	_get_odds = $('#HZ_getodds_'+val).text();
                	   $(this).find(".num").addClass('OneNum_active');
                	   CP.core.addBall(code,val,_type);
                       CP.core.render({type:_type,zhushu:1,code:val,odd:_get_odds} ,_name,_id);
                       CP.core.initCount();
                       $('#getOdds').val(_get_odds);
                    }
                }
            });
        });
        //单号
        var _codes={
            a : [3,5,7,9,11,13,15,17],
            b : [4,6,8,10,12,14,16,18],
            c : [3,4,5,6,7,8,9,10],
            d : [11,12,13,14,15,16,17,18]
        };
        $('#box_ball_HZ_a').click(function(){
            code.length = 0;
            //CP.core.clearAll();
            var val = '单';
            if(CP.checkRepeatCodes(val ,_type)){
                
                if($(this).hasClass('OneNum_active')){
                	$(this).removeClass('OneNum_active');
                } else {
                	_get_odds = $('#HZ_getodds_19').text();
            	   $(this).addClass('OneNum_active');
            	   CP.core.addBall(code,val,_type);
                   CP.core.render({type:_type,zhushu:1,code:val,odd:_get_odds} ,_name,'box_ball_HZ_a');
                   CP.core.initCount();
                   $('#getOdds').val(_get_odds);
                }
            }
        });
        $('#box_ball_HZ_b').click(function(){
            code.length = 0;
            //CP.core.clearAll();
            var val = '双';
            if(CP.checkRepeatCodes(val ,_type)){
                
                if($(this).hasClass('OneNum_active')){
                	$(this).removeClass('OneNum_active');
                } else {
                	_get_odds=$('#HZ_getodds_20').text();
            	   $(this).addClass('OneNum_active');
            	   CP.core.addBall(code,val,_type);
                   CP.core.render({type:_type,zhushu:1,code:val,odd:_get_odds} ,_name,'box_ball_HZ_b');
                   CP.core.initCount();
                   $('#getOdds').val(_get_odds);
                }
            }
        });
        $('#box_ball_HZ_c').click(function(){
            code.length = 0;
            //CP.core.clearAll();
            var val = '小';
            if(CP.checkRepeatCodes(val ,_type)){
                
                if($(this).hasClass('OneNum_active')){
                	$(this).removeClass('OneNum_active');
                } else {
                	_get_odds=$('#HZ_getodds_21').text();
            	   $(this).addClass('OneNum_active');
            	   CP.core.addBall(code,val,_type);
                   CP.core.render({type:_type,zhushu:1,code:val,odd:_get_odds} ,_name,'box_ball_HZ_c');
                   CP.core.initCount();
                   $('#getOdds').val(_get_odds);
                }
            }
        });
        $('#box_ball_HZ_d').click(function(){
            code.length = 0;
            //CP.core.clearAll();
            var val = '大';
            if(CP.checkRepeatCodes(val ,_type)){
//                CP.core.addBall(code,val,_type);
                
                if($(this).hasClass('OneNum_active')){
                	$(this).removeClass('OneNum_active');
                } else {
                	_get_odds=$('#HZ_getodds_22').text();
            	   $(this).addClass('OneNum_active');
            	   CP.core.addBall(code,val,_type);
                   CP.core.render({type:_type,zhushu:1,code:val,odd:_get_odds} ,_name, 'box_ball_HZ_d');
                   CP.core.initCount();
                   $('#getOdds').val(_get_odds);
                }
            }
        });
    },
    
    
    
    SAN_THTX:function(){  //3同号通选 3THTX
        var _name = '3同号通选';
        var _type = '3THTX';
        var _get_odds;
        $dom.box_ball_3THTX.each(function(){
            $(this).click(function(){
                var has_len = $data.codes.length;
                if(has_len == 1){
                    CP.tip('三同号通选 单次购买注数不得超过 1 注');
                }else{
                    _get_odds=$('#3THTX_getodds').text();
                    CP.core.render({type:_type,zhushu:1,code:_type,odd:_get_odds} ,_name);
                    CP.core.initCount();
                    var code = CP.core.getCodes();
                    CP.core.addBall(code,_type,_type);
                    $('#getOdds').val(_get_odds);
                }
            });
        });

    },
    SAN_THDX:function(){
        var _name = '3同号单选';
        var _type = '3THDX';
        var code=[];
        var _get_odds;
        $dom.box_ball_3THDX.each(function(){
            $(this).click(function(){
                var has_len = $data.codes.length;
                if(has_len == 1){
                    CP.tip('三同号单选 单次购买注数不得超过 1 注');
                }else{
                    var val = $(this).text();
                    var _id = $(this).attr("id")
                    _get_odds=$('#3THDX_getodds').text();
                    CP.core.removeBall(code,val,_type);
                    $(this).addClass('OneNum_active');
                    CP.core.addBall(code,val,_type);
                    CP.core.render({type:_type,zhushu:1,code:val,odd:_get_odds} ,_name,_id);
                    CP.core.initCount();
                    $('#getOdds').val(_get_odds);
                }
            });
        });
    },
    SAN_BTH:function(){
        var _name = '3不同号';
        var _type = '3BTH';
        var code=[];
        var _get_odds;
        $dom.box_ball_3BTH.each(function(){
	            $(this).click(function(){
	                var val = $(this).text();
	                if($(this).hasClass('OneNum_active')){
	                    $(this).removeClass('OneNum_active');
	                    CP.core.removeBall(code,val,_type);
	                }else{
	                    $(this).addClass('OneNum_active');
	                    CP.core.addBall(code,val,_type);
	                }
	                CP.core.initCount();
	                
	            });
        });
        $('#ball_add_btn').unbind('click');
        $('#ball_add_btn').bind('click',function(){
            var has_len = code.length;
            var c=CP.math.Cs(code,3);
            $('#getOdds').val($('#3BTH_getodds').text());
            _get_odds = $('#getOdds').val();
            if(has_len >=3 && CP.checkRepeatCodes(c,_type)){
                for(var i=0,_max=c.length;i<_max;i++){
                    CP.core.render({type:_type,zhushu:1,code:c[i],odd:_get_odds} ,_name);
                }
                $dom.box_ball_3BTH.removeClass('OneNum_active');
                code.length=0;
                CP.core.bindDelete();
            }else{
                CP.tip('至少选择3个号码');
            }
        });
    },
    SAN_LHTX:function(){
        var _name = '3连号通选';
        var _type = '3LHTX';
        var _get_odds;
        $dom.box_ball_3LHTX.each(function(){
            $(this).click(function(){
                CP.core.clearAll();
                var val = _type;
                _get_odds = $('#3LHTX_getodds').text();
                CP.core.render({type:_type,zhushu:1,code:val,odd:_get_odds} ,_name);
                $data.codes.push(_type+'|'+val);
                CP.core.initCount();
                $('#getOdds').val(_get_odds);
            });
        });
    },
    ER_THFX:function(){
        var _name = '2同号复选';
        var _type = '2THFX';
        var code=[];
        var _get_odds;
        $dom.box_ball_2THFX.each(function(){
            $(this).click(function(){
                var val = $(this).text();
                var has_len = $data.codes.length;
                if(has_len >= 6){
                    CP.tip('二同号复选 单次购买注数不得超过 6 注');
                }else if(CP.checkRepeatCodes(code ,_type ,val)){
                    CP.core.addBall(code,val,_type);
                    _get_odds = $('#2THFX_getodds').text();
                    var _id = $(this).attr("id");
                    $(this).addClass('OneNum_active');
                    CP.core.render({type:_type,zhushu:1,code:val,odd:_get_odds} ,_name,_id);
                    CP.core.initCount();
                    $('#getOdds').val($('#2THFX_getodds').text());
                }
            });
        });
    },
    ER_THDX:function(){
        var _name = '2同号单选';
        var _type = '2THDX';
        var code = [];
        var single = [];
        var sli,li,sv,v;
        var _get_odds;
        $dom.box_ball_2THDX.each(function(i){
            sli = $dom.box_ball_2THDX_single.eq(i);
            $(this).bind('click' ,function(){
                v = $(this).text();
                sv = $(this).text();
                if($(this).hasClass('OneNum_active')){
                    $(this).removeClass('OneNum_active');
                    code.splice($.inArray(v,code),1);
                }else{
                    $(this).addClass('OneNum_active');
                    code.push(v);
                }
                if(sli.hasClass('OneNum_active')){
                    sli.removeClass('OneNum_active');
                    single.splice($.inArray(sv,single),1);
                }
            });
            sli.bind('click',function(){
                li = $dom.box_ball_2THDX.eq($(this).index());
                v = li.text();
                sv = $(this).text();
                if(li.hasClass('OneNum_active')){
                    li.removeClass('OneNum_active');
                    code.splice($.inArray(v,code),1);
                }
                if($(this).hasClass('OneNum_active')){
                    $(this).removeClass('OneNum_active');
                    single.splice($.inArray(sv,single),1);
                }else{
                    $(this).addClass('OneNum_active');
                    single.push(sv);
                }
            });
           

        });
        var tmp ,zhushu=0;
        $('#ball_add_btn_2THDX').bind('click',function(){
            var len = code.length;
            var slen = single.length;
            if(len<=0 || slen<=0){
                CP.tip('您选的方案不足1注，请参考玩法说明选满1注后进行投注。');
                return false;
            }else{
            	 $('#getOdds').val($('#2THDX_getodds').text());
                _get_odds=$('#getOdds').val();
                for(var i=0;i<len;i++){
                    for(var s=0;s<slen;s++){
						if(code[i]!=(single[s]+single[s])){
                        tmp = code[i]+'#'+single[s];
                        CP.core.render({type:_type,zhushu:1,code:tmp,odd:_get_odds} ,_name);
                        zhushu+=1;
						}
                    }
                }
                code.length=0;
                single.length = 0;
                $dom.box_ball_2THDX.removeClass('OneNum_active');
                $dom.box_ball_2THDX_single.removeClass('OneNum_active');
                CP.core.bindDelete();
            }
        });
    },
    ER_BTH:function(){
        var _name = '2不同号';
        var _type = '2BTH';
        var code = [];
        var _get_odds;
        $dom.box_ball_2BTH.each(function(){
            $(this).click(function(){
                var val = $(this).text();
                if($(this).hasClass('OneNum_active')){
                    $(this).removeClass('OneNum_active');
                    CP.core.removeBall(code,val,_type);
                }else{
                    $(this).addClass('OneNum_active');
                    CP.core.addBall(code,val,_type);
                  
                }
            });
        });
        $('#ball_add_btn_2BTH').bind('click',function(){
            var c=CP.math.Cs(code,2);
            var getcodes = CP.core.getCodes();
            if(getcodes.length<=1){
                CP.tip('您选的方案不足1注，请参考玩法说明选满1注后进行投注。');
                return false;
            }
            if(c.length>=15){
                CP.tip('二不同号 单次购买注数不得超过 15注');
            }else{
            	  $('#getOdds').val($('#2BTH_getodds').text());
                _get_odds=$('#getOdds').val();
                for(var i=0,_max=c.length;i<_max;i++){
                    CP.core.render({type:_type,zhushu:1,code:c[i],odd:_get_odds} ,_name);
                }
                $dom.box_ball_2BTH.removeClass('OneNum_active');
                CP.core.bindDelete();
            }
            code.length=0;
        });
    },
    render:function(obj,name,_id){
        var _out=[];
        _out.push('<li id="li_'+obj.type+'_'+obj.code+'" data-type="'+obj.type+'" data-zhushu="'+obj.zhushu+'" data-code="'+obj.code+ '" data-id="'+_id + '">');
        _out.push('<span class="txt-betsName">['+name+']</span>');
        _out.push('<span title="'+obj.code+'" class="txt-num js-code">'+obj.code+'</span>');
        _out.push('<span class="txt-amount js-money" style="width:230px;float:none">下注金额<input type="number" onkeyup="CP.formatIntVal(this)" data-odd="'+obj.odd+'" onafterpaste="CP.formatIntVal(this)" name="totals[]" class="totalsVal" size="6" />元&nbsp;&nbsp;<em></em></span>');
        _out.push('<a href="javascript:void(0);" class="txt-delNum js-del">删除</a>');
        var val = obj.code+'|'+obj.type+'|'+name;
        _out.push('<input type="hidden" name="tmpCodes[]" class="tmpCodes" value="'+val+'" />');
        _out.push('</li>');
        $dom.has_add_box.prepend(_out.join(''));
        $('.totalsVal').each(function(){
            $(this).keyup(function(){
                CP.core.showGetPrice($(this),obj);
            }).keydown(function(){
                CP.core.showGetPrice($(this),obj);
            }).blur(function(){
                CP.core.checkSingleBuy($(this));
            });
        })
    },
    
    checkSingleBuyNew : function(that){
    	var that = $(that);
    	
    	p = that.attr('data-play-type');
    	var pt = p.split("_")[1];
    	var hm = p.split("_")[2];
    	var arr = ['单','双','小', '大'];
    	if($.inArray(hm,arr) >= 0){
    		var _limit_lowest = pt+'_dsdx_chipin_l';
            var _limit_highest = pt+'_dsdx_chipin_h';
            var _chipin_l = $('#'+_limit_lowest).val();
            var _chipin_h = $('#'+_limit_highest).val();
    	} else {
    		var _limit_lowest = pt+'_chipin_l';
            var _limit_highest = pt+'_chipin_h';
            var _chipin_l = $('#'+_limit_lowest).val();
            var _chipin_h = $('#'+_limit_highest).val();
    	}
		
        if(!_chipin_l) _chipin_l = 0;
        if(!_chipin_h) _chipin_h = 0;
    	
    	var val = parseInt(that.val(),10),l = parseInt(_chipin_l,10),h=parseInt(_chipin_h,10);
        if(l>0 && val<l){
            CP.core.checkSingleTip('您的单注最低投注额为 '+_chipin_l+' 元，但您目前的投注金额为 '+val+' 元，请修改！',that);
            return false;
        }
        if(h>0 && val > h){
            CP.core.checkSingleTip('您的单注最高投注额为 '+_chipin_h+' 元，但您目前的投注金额为 '+val+' 元，请修改！',that);
            return false;
        }
    },
    
    
    checkSingleBuy:function(that){
        var val = parseInt(that.val(),10),l = parseInt(user.lowest),h=parseInt(user.highest);
        if(l>0 && val<l){
            CP.core.checkSingleTip('您的单注最低投注额为 '+user.lowest+' 元，但您目前的投注金额为 '+val+' 元，请修改！',that);
            return false;
        }
        if(h>0 && val > h){
            CP.core.checkSingleTip('您的单注最高投注额为 '+user.highest+' 元，但您目前的投注金额为 '+val+' 元，请修改！',that);
            return false;
        }
    },
    checkSingleTip:function(msg,that){
        $.typebox({
            'title' : '温馨提示',
            'width': '360',
            'height' : '150',
            'content' : msg,
            'padding' : 10,
            'type' : 'text',
            'call' :function(){
                that.val('');
                $.typebox.close();
                that.parent().find('em').html('');
            },
            'closeAfter':function(){
                that.val('');
                that.parent().find('em').html('');
            }
        });
        $.typebox.display('cancel',0);
        $('#typeboxContent').css({
            'text-align':'center'
        });
    },
    showGetPrice:function(that ,json){
        //var odds = $('#getOdds').val();
        //odds  = odds / 100;
        var odds = that.attr('data-odd');
        //if(!odds) odds = $('#getOdds').val();
        var val = that.val();
        switch (json.type){
            case 'HZ': //和值的赔率好麻烦。。。
                var _key;
                if(json.code == '单'){
                    _key = 19;
                }else if(json.code == '双'){
                    _key = 20;
                }else if(json.code == '小'){
                    _key = 21;
                }else if(json.code == '大'){
                    _key = 22;
                }else{
                    _key = json.code;
                }
                //odds = $('#HZ_getodds_'+_key).text();
                //odds = odds / 100;
                val = val * odds;
                val = CP.core.formatPrice(val);
                that.parent().find('em').html('可赢金额：<span class="bingoMoney">'+val+'</span> 元');
                break;
            default:
                val = val * odds;
                val = CP.core.formatPrice(val);
                that.parent().find('em').html('可赢金额：<span class="bingoMoney">'+val+'</span> 元');
        }
        
        
    },
    formatPrice:function(val){
        val = Number(val);
        val = val.toFixed(1);
        return val;
    },
    bindDelete:function(){
        var c = t = id = '';

        $dom.has_add_box.find('a').each(function(){
            $(this).click(function(){
                c = $(this).attr('data-code');
                t = $(this).attr('data-type');
                id= $(this).parent().attr('data-id');
                CP.core.removeBall([],c,t);
                $(this).parent().remove();
                
                if( $('#'+id).hasClass('OneNum_active')){
                	 $('#'+id).removeClass('OneNum_active');
                }
            });
        });
    },
    getTotals :function(){
        var totals = 0 ,v = 0 ,_error = 0;
        $('.totalsVal').each(function(){
            v = $.trim($(this).val());
            if(v=='' || v <= 0){
                _error+=1;
            }else{
                totals = parseInt(totals,10)+parseInt(v,10);
            }
        });
        if(_error > 0){
            return false;
        }
        return totals;
    }
}
CP.formatIntVal = function(obj){
    obj.value=obj.value.replace(/\D+/g,'');
}
CP.submit = function(){
	
    if(user.isLogin != '1'){
        CP.tip('您还没有登录，请登录以后再进行投注！');
        return false;
    }
    var tmpCodes = $('.tmpCodes');
    if(tmpCodes.size()<=0){
        CP.tip('您还没有选择任何号码呀~~~');
    }else{
        if(user.agency == '3' || user.agency=='1'){
            CP.tip('代理不可以投注！');
            return false;
        }
        var countDownTime = $dom.countDownTime.text();
        /*if(gameHasEnd == 1 || countDownTime == '00:00:00'){
            CP.tip('您好，'+$.cookie('theIssuse')+' 期已截止，请等待下一期投注开始。');
            return false;
        }*/
        
        var buyType = $('input:radio[name=buyType]:checked').val();
//        var buyType = $('input:radio[name=buyType]:checked').val();
//        var buyType = 'daigou';
        if( buyType == 'zhuihao'){
        	// 先计算每一注是否有问题, 二确定总额是否够.三:最低和最大投注限额. 四:计算整体
        	
        	var zhuiEachPrice = $('.zhuiEachPrice') ,eachPrice = 0 , proNum = '', bingoMoney=$('.bingoMoney'); 
        	var singleCodes = $('.singleCodes');
        	var checktime = $('.checkNum');
        	var proNumber = $('.proNumber');
        	var codes = '';
        	var proName = $('#proName').val();
            var pt = $dom.playType.val();
        	
        	var total = CP.zhui.getTotals();
        	 if(total > user.points ){
 	            CP.tip('您的余额不足，请充值！');
 	            return false;
 	        }
       
        	singleCodes.each(function(i){	
        		var isChecked = checktime.eq(i).is(":checked");
        		if( isChecked ){
        			eachPrice = $.trim(zhuiEachPrice.eq(i).val());
        			proNum = $.trim(proNumber.eq(i).html());
      	            codes = $(this).val()+'|'+eachPrice+ '|'  + proNum + '###' + codes;
        		}
  	        });
        	 var msg = '您下注了<strong>'+gameProvince+' 共<strong>'+ total +'</strong>元，是否下注？';
        	 
        	 var ting = 0;
        	 
        	 if($('#chaseStopCondition').is(":checked")){
        		 ting = $("#bingoPrize").val();
        	 }
        	 
        	 $.typebox({
 	            'title' : '温馨提示',	
 	            'width': '400',
 	            'height' : '150',
 	            'content' : msg,
 	            'padding' : 10,
 	            'type' : 'text',
 	            'call' :function(){
 	                $('#typeboxSubmit').attr('disabled',true).html('数据提交中...');
 	                $.ajax({type: "POST",
 	                    url: baseUrl+"index.php?g=Home&m=User&a=sendCode&rand="+Math.random()+"&lottery_type="+lottery_type+"&ting="+ting,
 	                    data:"playType="+pt+'&proName='+proName+'&totals='+total+'&codes='+encodeURIComponent(codes),
 	                    dataType: "json" ,
 	                    async:false,
 	                    cache : false,
 	                    success: function(json){
 	                    	
 	                        $.typebox.close();
 	                        switch(json.tip){
 	                            case 'login':
 	                            	alert(json.msg);
 	                                window.location.href=loginUrl;
 	                                break;
								case 'timeout':
									alert(json.msg);
									window.location.href=baseUrl + "/index.php/user/home/init?lottery_type="+lottery_type;
									break;
 	                            case 'success':
 	                                CP.tip('您的投注信息已经成功提交，请等待开奖！【<a href="'+myLotteryUrl+'">查看我的购买信息</a>】');
 	                                CP.core.clearAll();
 	                                CP.zhui.clearAll();
 	                                if($('.enter_digital').size()>0){
 	                                    $('.enter_digital').text(json.points);
 	                                }
// 	                               window.location.href=baseUrl + "/index.php/user/home/init?lottery_type="+lottery_type;
// 	                               $(".expand").toggle();
 	                                break;
 	                            case 'error' :
 	                            	alert(json.msg);
 	                            	window.location.href=baseUrl + "/index.php/user/home/init?lottery_type="+lottery_type;
 	                            	break;
 	                            case 'money' :
 	                            	CP.tip('您的余额不足，请等待开奖！【<a href="'+myLotteryUrl+'">查看我的购买信息</a>】');
 	                            	break;
 	                           case 'token':
 	                        	    window.location.reload();
	                            	break;
 	                            default:
 	                                alert(json.msg);
 	                        }
 	                    }
 	                });
 	            }
 	        });
        	 $(".expand").toggle();
        	 $("input:radio[name='buyType']").eq(0).attr("checked",'checked');
        	$(".submit_btn").attr("disabled","true");	
        } else if( buyType == 'daigou' ){

	        var pt = $dom.playType.val(),
	            proName = $('#proName').val();
	        var codes = '';
	        var totals = CP.core.getTotals();
	        if(!totals){
	            CP.tip('每一注都需要您输入投注金额！');
	            return false;
	        }
	        if(totals > user.points ){
	            CP.tip('您的余额不足，请充值！');
	            return false;
	        }
	        var _limit_lowest = pt+'_chipin_l';
	        var _limit_highest = pt+'_chipin_h';
	        var _chipin_l = $('#'+_limit_lowest).val();
	        var _chipin_h = $('#'+_limit_highest).val();
	        if(!_chipin_l) _chipin_l = 0;
	        if(!_chipin_h) _chipin_h = 0;
	        if(_chipin_l>0 && totals < _chipin_l){
	            CP.tip('您的投注最低限额为“'+_chipin_l+'”元，但您目前的投注金额为“'+totals+'”元，请修改！');
	            return false;
	        }
	        if(_chipin_h>0 && totals > _chipin_h){
	            CP.tip('您的投注最高限额为“'+_chipin_h+'”元，但您目前的投注金额为“'+totals+'”元，请修改！');
	            return false;
	        }
	        
	        $(".submit_btn").attr("disabled","true");	
	        
	        var totalVal = $('.totalsVal') ,eachPrice = 0 ,bingoMoney=$('.bingoMoney');
	        tmpCodes.each(function(i){
	            eachPrice = $.trim(totalVal.eq(i).val());
	            codes+=$(this).val()+'|'+eachPrice+'|'+bingoMoney.eq(i).text()+'###';
	        });
	        var gameName = $dom.gameName.val();
	        var zhushu = $('.tmpCodes').size();
	        var msg = '您下注了<strong>'+gameProvince+'</strong>的'+gameName+'号，共<strong>'+totals+'</strong>元，是否下注？';
	        
	        $.typebox({
	            'title' : '温馨提示',	
	            'width': '400',
	            'height' : '150',
	            'content' : msg,
	            'padding' : 10,
	            'type' : 'text',
	            'call' :function(){
	                $('#typeboxSubmit').attr('disabled',true).html('数据提交中...');
	                $.ajax({type: "POST",
	                    url: baseUrl+"/index.php?g=Home&m=User&a=sendCode&rand="+Math.random()+"&lottery_type="+lottery_type,
	                    data:"playType="+pt+'&zhushu='+zhushu+'&proName='+proName+'&totals='+totals+'&codes='+encodeURIComponent(codes),
	                    dataType: "json" ,
	                    cache : false,
	                    success: function(json){
	                    	
	                        $.typebox.close();
	                        switch(json.tip){
	                            case 'login':
	                            	alert(json.msg);
	                                window.location.href=loginUrl;
	                                break;
								case 'timeout':
									alert(json.msg);
									window.location.href=baseUrl + "index.php?g=Home&m=Cp&a=lottery&type="+lottery_type;
									break;
	                            case 'success':
	                                CP.tip('您的投注信息已经成功提交，祝君中奖！');
	                              
	                                CP.core.clearAll();
									GetHistoryJilu();
	                                if($('.enter_digital').size()>0){
	                                    $('.enter_digital').text(json.points);
	                                }
	                                break;
	                            case 'error' :
	                            	alert(json.msg);
	                            	window.location.href=baseUrl + "index.php?g=Home&m=Cp&a=lottery&type="+lottery_type;
	                            	break;
	                            case 'money' :
	                                CP.tip('您的账户余额不足，请充值！【<a style="red" href="'+myLotteryUrl+'">点我充值</a>】');
	                                CP.core.clearAll();
	                            	break;
	                            case 'token':
	                            	window.location.reload();
	                            	break;
	                           
	                            default:
	                                CP.tip(json.msg);
	                                CP.core.clearAll();
	                        }
	                       
	                       /* setTimeout(function(){
	                        	 location.reload();
	                        },2000);*/
	                       
	                    }
	                });
	            }
	        });
	       $(".submit_btn").removeAttr("disabled");
	       CP.core.clearAll();
       }
    }
}

CP.buy = function(){
	
    if(user.isLogin != '1'){
        CP.tip('您还没有登录，请登录以后再进行投注！');
        return false;
    }

    if(orders.length <= 0){
        CP.tip('您还没有选择任何号码呀~~~');
    }else{
        if(user.agency == '10'){
            CP.tip('代理不可以投注！');
            return false;
        }
        
        var countDownTime = $dom.countDownTime.text();
        
        /*if(gameHasEnd == 1 || countDownTime == '00:00:00'){
            CP.tip('您好，'+$.cookie('theIssuse')+' 期已截止，请等待下一期投注开始。');
            return false;
        }*/
        
//        var buyType = $('input:radio[name=buyType]:checked').val();
//        var buyType = $('input:radio[name=buyType]:checked').val();
        var buyType = 'daigou';
        if( buyType == 'daigou' ){
        	var proName = $('#proName').val();
        	
        	// key 
        	var totals = 0;
        	for(var p in orders){
        		if( orders.hasOwnProperty(p)) {
        			totals += orders[p];
        		}        		
        	}
        	
        	
	        if(!totals){
	            CP.tip('每一注都需要您输入投注金额！');
	            return false;
	        }
	        if(totals > user.points ){
	            CP.tip('您的余额不足，请充值！');
	            return false;
	        }
	        
	        $(".submit_btn").attr("disabled","true");	
	        var codes = '';
	        for(var p in orders){
        		if( orders.hasOwnProperty(p)) {
        			var arry = p.split("_");
        			codes += arry[2] + "|" + arry[1] + "|" + arry[2] + "|" + orders[p] + "|0###"; 
        		}        		
        	}
	        var gameName = $dom.gameName.val();
	        var msg = '您下注了<strong>'+gameProvince+'</strong>的'+gameName+'号，共<strong>'+totals+'</strong>元，是否下注？';
	        
	       $.typebox({
	            'title' : '温馨提示',	
	            'width': '400',
	            'height' : '150',
	            'content' : msg,
	            'padding' : 10,
	            'type' : 'text',
	            'call' :function(){
	                $('#typeboxSubmit').attr('disabled',true).html('数据提交中...');
	                $.ajax({type: "POST",
	                    url: baseUrl+"/index.php?g=Home&m=User&a=sendCode2&rand="+Math.random()+"&lottery_type="+lottery_type,
	                    data:'proName='+proName+'&totals='+totals+'&codes='+encodeURIComponent(codes),
	                    dataType: "json" ,
	                    cache : false,
	                    success: function(json){
	                    	
	                        $.typebox.close();
	                        switch(json.tip){
	                            case 'login':
	                            	alert(json.msg);
	                                window.location.href=loginUrl;
	                                break;
	                            case 'timeout':
	                                    	alert(json.msg);
	                                    	window.location.href=baseUrl + "/index.php/user/home/init?lottery_type="+lottery_type;
	                                    	break;
	                            case 'success':
	                                CP.tip('您的投注信息已经成功提交，请等待开奖！【<a href="'+myLotteryUrl+'">查看我的购买信息</a>】');
	                                CP.core.clearAll();
	                                if($('.enter_digital').size()>0){
	                                    $('.enter_digital').text(json.points);
	                                }
	                                break;
	                            case 'error' :
	                            	alert(json.msg);
	                            	window.location.href=baseUrl + "/index.php/user/home/init?lottery_type="+lottery_type;
	                            	break;
	                            case 'token':
	                            	window.location.reload();
	                            	break;
	                            default:
	                                alert(json.msg);
	                        }
	                        
	                        $(".buyHm").attr("value","");
	             	       orders = new Object();
	                    }
	                });
	            }
	        });
	       
	       $(".submit_btn").removeAttr("disabled");
//	       CP.core.clearAll();
       }
    }
}


/*
 * 检查重复投注号码
 * return true:无重复投注号码 false:有重复投注号码
 * 和值，二不同号，二同号复选，三同号通选，三连号通选5个玩法有重号限制
 * 三同号单选、二同号单选、三不同号没有重号限制
 */
CP.checkRepeatCodes = function(_code ,t ,val){
    if($data.codes.length<=0) return true;
    var codes_ary=CP.core.getCodes();
    switch(t){
        case '3THDX':
        case '3BTH':
        case '2THDX':
            return true;
            break;
        default:
        	
            var _t=[];
            for(var s in codes_ary){
                for(var x in _code){
                    if(codes_ary[s]==_code[x] && typeof codes_ary[s] == 'string'){
                        _t.push(codes_ary[s]);
                    }
                }
            }

            if(val){
                if($.inArray(val ,_t) > -1){
                    CP.tip('投注列表内含有重复选号，系统暂不支持，请重新选号');
                    return false;
                }
            }else{
                if($.inArray(_code ,codes_ary) > -1){
					if($("[data-code='"+_code+"']").length>1){
					//alert(codes_ary);
                    CP.tip('投注列表内含有重复选号，系统暂不支持，请重新选号');
                    return false;
					}
                }
            }
            return true;
            break;
    }
}

CP.timeoutTip = function(content){
	 $.typebox({
	        'title' : '温馨提示',
	        'width': '400',
	        'height' : '150',
	        'content' : content,
	        'padding' : 10,
	        'type' : 'text',
	        'call' :function(){
	            $.typebox.close();
	        }
	    });
	    $.typebox.display('cancel',0);
	    $('#typeboxContent').css({
	        'text-align':'center'
	    });
}

CP.tip = function(content){
    $.typebox({
        'title' : '温馨提示',
        'width': '360',
        'height' : '150',
        'content' : content,
        'padding' : 10,
        'type' : 'text',
        'call' :function(){
            $.typebox.close();
        }
    });
    $.typebox.display('cancel',0);
    $('#typeboxContent').css({
        'text-align':'center'
    });
}
CP.math = {
    /**
     * @description 排列总数
     * @param {Int} n 总数
     * @param {Int} m 组合位数
     * @author classyuan
     * @return {Int}
     * @example CP.math.C(6,5);
     * @memberOf CP.math
     */
    C : function(n, m) {
        var n1 = 1, n2 = 1;
        for (var i = n, j = 1; j <= m; n1 *= i--, n2 *= j++) {}
        return n1 / n2;
    },
    /**
     * @description 组合总数
     * @param {Int} n 总数
     * @param {Int} m 组合位数
     * @author classyuan
     * @return {Int}
     * @example CP.math.P(5,3); 60
     * @memberOf CP.math
     */
    P : function(n, m) {
        var n1 = 1, n2 = 1;
        for (var i = n, j = 1; j <= m; n1 *= i--, n2 *= j++) {}
        return n1;
    },
    /**
     * @description 枚举数组算法
     * @param {Int} n 数组长度
     * @param {Int|Array} m 枚举位数
     * @author classyuan
     * @return {Int}
     * @example CP.math.Cs(4,3);  [[1,2,3],[1,2,4],[1,3,4],[2,3,4]]
     * @memberOf CP.math
     */
    Cs : function (len, num){
        var arr=[];
        if(typeof(len)=='number'){
            for(var i=0;i<len;i++){
                arr.push(i+1);
            }
        }else{
            arr=len;
        }
        var r=[];
        (function f(t,a,n){
            if (n==0) return r.push(t);
            for (var i=0,l=a.length; i<=l-n; i++){
                f(t.concat(a[i]), a.slice(i+1), n-1);
            }
        })([],arr,num);
        return r;
    },
    /**
     * @description 获取竞彩N串1注数
     * @param {Array} spArr [2,2,1] 每一场选中的个数
     * @param {Int} n n串1
     * @author classyuan
     * @return {Int}
     * @example CP.math.N1([2,2,1],3);
     * @memberOf CP.math
     */
    N1:function(spArr,n){
        var zhushu=0;
        var m=spArr.length;//场次
        var arr=CP.math.Cs(m,n);
        for(var i=0;i<arr.length;i++){
            var iTotal=1;//每场注数
            for(var j=0;j<arr[i].length;j++){
                iTotal*=spArr[arr[i][j]-1]
            }
            zhushu+=iTotal
        }
        return zhushu;
    },
    /**
     * @description 获取竞彩N串1胆拖注数
     * @param {Array} spArrd [[3,3,3,1,2],[1,1,1,1,0]] 选中5场，4场胆拖
     * @param {Int} n n串1
     * @author classyuan
     * @return {Int}
     * @example CP.math.N1d([[3,3,3,1,2],[1,1,1,1,0]],5); 选中5场，4场胆拖，5串1玩法  return 54
     * @example CP.math.N1d([[3,3,3,1,2],[1,0,0,0,0]],3); 选中5场，1场胆拖，3串1玩法  return 87
     * @memberOf CP.math
     */
    N1d:function(spArrd,n){
        var nArr=[],dArr=[];
        try{
            for(var i=0;i<spArrd[1].length;i++){
                if(spArrd[1][i]==1){
                    dArr.push(spArrd[0][i]);
                }else{
                    nArr.push(spArrd[0][i]);
                }
            }
        }catch(e){
            return 0;
        }
        if(dArr.length<=n){
            return CP.math.N1(nArr,n-dArr.length)*CP.math.N1(dArr,dArr.length);
        }else{
            return 0;
        }
    },
    /**
     * 枚举二维数组元素组合
     * @param {Array<Array>} oriArr 二维数组
     * @param {Number} comQty 组合数
     * @param {Array<Array>=} fixedArr 固定二维数组
     * @return {Array<Array>}
     * @example 二维数组
     *           [
     *              [a1,b1],
     *              [a2]
     *           ],
     *           组合数2，
     *           可得到：
     *           [
     *              [a1,a2],
     *              [b1,a2]
     *           ]
     */
    enumCom:function(oriArr, comQty, fixedArr){
        var comArr = [];

        //存储二维数组第一个元素的数组
        var firstArr = [];
        for (var i = 0, l = oriArr.length; i < l; i++) {
            firstArr.push(oriArr[i][0]);
        }

        comArr = CP.math.Cs(firstArr, comQty);

        var oriItem;
        for (var i = 0, l = oriArr.length; i < l; i++) {
            oriItem =oriArr[i];
            if (oriItem.length>1) {
                //组合数组
                var comItem;
                for (var j = 0; j < comArr.length; j++) {
                    var addedArr =[];
                    comItem = comArr[j];
                    var index = CP.Util.indexOf(comItem,oriItem[0]);
                    if (index!==-1) {
                        for(var k = 1;k<oriItem.length;k++){
                            var cloneComItem = comItem.slice();
                            cloneComItem.splice(index, 1, oriItem[k]);
                            addedArr.push(cloneComItem);
                        }
                    }
                    comArr = comArr.concat(addedArr);
                }
            }
        }

        if (fixedArr && fixedArr.length>0) {
            var fixedComArr = CP.math.enumCom(fixedArr, fixedArr.length);
            var comComArr = [];
            var comItem;
            for (var i = 0, l = comArr.length; i < l; i++) {
                comItem = comArr[i];
                var fixedItem;
                for (var j = 0, k = fixedComArr.length; j < k; j++) {
                    fixedItem = fixedComArr[j];
                    comComArr.push(comItem.concat(fixedItem));
                }
            }
            comArr = comComArr;
        }

        return comArr;
    },
    /**
     * @description N串M算法 注意最多支持15场多余的会被截断，不符合规定的串法一律返回0
     * @author classyuan
     * @param {Array} arr 选中场次
     * @param {String} str N串M
     * @return {Number}
     * @example
     CP.math.NM([1,1,2,2,1,1,1,2,1],'4_5')
     CP.math.NM([1,1,2,2,1,1,1,2,1],'8_1')
     * @memberOf CP.math
     */
    NM:function(arr,str,isDan){
        if(!/^\d{1,2}_\d{1,2}$/.test(str)){return false;}
        if(arr.length>15){arr.length=15;}//超过15场则截断

        var len=arr.length,//数组长度 场次数
            result=[],//保存各种
            n1Arr=[],//计算各种串法注数
            cacheArr=[],//临时数组
            y=Number(str.split('_')[0])||0,//N值
            x=len-(y-1);//曲线公式变量

        switch(str){//不同串法前面补0
            case '6_7':
                cacheArr=[0,0,0,0];break;
            case '6_22':case '5_6':
            cacheArr=[0,0,0];break;
            case '6_42':case '5_16':case '4_5':
            cacheArr=[0,0];break;
            case '6_57':case '5_26':case '4_11':case '3_4':
            cacheArr=[0];break;
        }
        switch(str){
            case '6_63':
                result.push(x*(x+1)*(x+2)*(x+3)*(x+4)/120);
            case '5_31':case '6_57':
            result.push(x*(x+1)*(x+2)*(x+3)/24);
            case '4_15':case '5_26':case '6_42':
            result.push(x*(x+1)*(x+2)/6);
            case '3_7':case '4_11':case '5_16':case '6_22':
            result.push(x*(x+1)/2);
            case '2_3':	case '3_4':	case '4_5':	case '5_6':	case '6_7':
            result.push(x);
            result.push(1);
            for(var i = 0; i < y && i < 6; i++){//计算N串1保存到数组
                n1Arr[i]=CP.math.N1(arr,i+1);
            }
            cacheArr=cacheArr.concat(result);
            result=0;
            for(var i=0, _l = n1Arr.length; i < 6 && i < _l;i++){
                result+=n1Arr[i]*cacheArr[i];
            }
            break;
            default :
                if(/\d+\_1/.test(str)){
                    result=CP.math.N1(arr,y);
                }else{
                    result=0;//非规定串法一律返回0
                }
        }
        return result;
    },
    /**
     * @description 机选号码
     * @param {Int} startNum   起始值
     * @param {Int} totalNum   总数长度
     * @param {Int} len        机选个数或者数组
     * @param {Int} a          是否重复，缺省不重复
     * @param {Array} rep      删除不需要的元素，定胆机选用
     * @author classyuan
     * @return {Array}
     * @example CP.math.random(1,35,5); 机选1-35之间5不重复个数字 return [4,12,16,8,34,9]
     * @example CP.math.random(1,12,2,true); 机选 return [4,4]
     * @memberOf CP.math   1 10 5
     */
    random:function(startNum, totalNum, len, a ,rep) {
        var absNum = Math.abs(startNum - totalNum) + 1;
        var repL=0
        if(typeof(rep)=='object'){
            repL=rep.length;
        }
        if (typeof len == "undefined" || len > absNum||len < 1|| len > absNum-repL) {
            return [];
        }
        var o = {}, _r = new Array(len), i = 0, s;
        while (i < len) {
            s=parseInt(Math.random() * absNum + startNum);
            if(!a){
                s=function(a,s){
                    for(var i=0;i<a.length;){
                        if(a[i++]==s)return null;
                        if(typeof(rep)=='object'){
                            for(var j=0;j<repL;j++){
                                if(s==rep[j])return null;
                            }
                        }
                    }
                    return s
                }(_r,s);
                s!==null&&(_r[i++]=s);
            }else{
                _r[i++] =s;
            }
        }
        return _r;
    }
};
// CP.init();

$(function(){
	CP.init();
});