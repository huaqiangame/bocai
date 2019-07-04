$(function(){

    
   $('.play_select_tit').on('click','li',function(){
   		$(this).addClass('curr').siblings('li').removeClass('curr');
   		var url=$(this).attr('data-url');
   		var name=$(this).attr('title');
   		gameaj.name=name;
   		if(typeof gameaj[gameaj.type][name] == 'function')
   		{
   			gameaj.getList(url,gameaj[gameaj.type][name]);
   		}else{
   			gameaj.getList(url,gameaj[gameaj.type]['pubList']);
   		}
        $('#j_play_select,.ymask').toggle();	
        $('.gameType').children('string').text(name);
   })
   $('body').on('click','.betTitle',function(){
        $(this).children('i').toggleClass('plus');
        $(this).next('.hmxzq,.thangou').toggle();
   })
    $('.bett-head').on('click',function(){
        $('.beet-rig').toggle();
    })
    $('body').on('click','.btn-none',function(){
        $('.code_value').removeClass('ball-active');
        $('.betMoney').val('');
        $('#bet_list').children('li').remove();
        $('.go-back').hide().find('#bet_time_count').text(0);
        $('#chipUl').find('li').removeClass('chip_click');
        $('#bet_sel_count,#bet_sel_money,#bet_count,#bet_money').text(0);
    })
    $('.chips').on('click',function(){
        $('#chipUl').children('li').removeClass('chip_click');
        $('#chipDiv').toggle();
    })

    $('#chipUl').find('li').on('click',function(){
        var value=$(this).attr('data-value');
        var mone=$('.betMoney').val()!=''?parseInt($('.betMoney').val()):0;
        $(this).addClass('chip_click').siblings('li').removeClass('chip_click');
        mone+=parseFloat(value);
        $('.betMoney').val(mone);
    })
    $('.selectMultipleLz').on('click',function(){
            var sizes=0,contmone=0,html='';
            var datas={orderList:[],
                    expect:lottery.currFullExpect,
                    lotteryname:lotteryname
                };
            $('.yBettingLists').children('.yBettingList').each(function(){
                var values=$(this).attr('data-mone');
                var id=$(this).attr('data-id');
                var name=$(this).attr('data-class2');
                var code=$(this).attr('data-hm');
                var pl=$(this).attr('data-pl');
                var dupl=$(this).attr('data-durate');
                if(values!='')
                {
                    var data={price:values,id:id,rate:pl,fandian:lotteryFandian};
                    datas.orderList.push(data);
                    sizes++;
                    contmone+=parseInt(values);
                }
                
            })
            if(sizes<=0) return;
            html='<p><span>你共选择 </span><strong style="color:#bb0102">'+sizes+'</strong> 注，<span>共 </span><strong style="color:#bb0102">'+contmone+'</strong> 元</p>';
            layer.open({
                content: html
                ,btn: ['确定投注', '取消投注']
                ,yes: function(index){
                  gameaj.setList(datas,'/apijiekou.oldcpbuy',0);
                  layer.close(index);
                }
            });
                
               

    })

   $('body').on('click','.commitbtn',function(){
   		var sizes=$('.GTMselected').length,html='',contmone=0,zmone=0;
   		var datas={code:[],para:{
                actionNo:actionNo_a,
                type:gameaj.id,
                kjTime:kjTime_k
            }};
   		if(sizes>0)
        {
   			html+='<div class="codesList"><div class="tabct"><table class="table">'+
                    '<thead>'+
                    '<tr>'+
                    '<th>号码</th>'+
                    '<th>赔率</th>'+
                    '<th>金额</th>'+
                    '</tr>'+
                    '</thead>'+
                    '<tbody id="six_betList">';     
            $('.GTMselected input').each(function(i){
                var values=$(this).val();
                if(values==""||values<=0){ 
                    sizes--;
                    return;
                }
                contmone+=parseInt(values);
                var id=$(this).attr('data-id');
                var name=$(this).attr('data-class2');
                var code=$(this).attr('data-hm');
                var pl=$(this).attr('data-rate');
                zmone+=values;
                var data={amount:values,id:id}
                datas.code.push(data);
                
                html+='<tr>'+
                        '<td class="contents">'+name+'：'+code+'</td>'+
                        '<td class="six_odds">'+pl+'</td>'+
                        '<td class="amount">'+
                            '<input value="'+values+'" disabled>'+
                        '</td>'+
                      '</tr>';
            })
            html+='</tbody></table></div>';
            html+='<div class="tip_b"><p><span>组数：<var>'+sizes+'</var></span><span>总金额：<var>'+contmone+'</var>元</span></p></div></div>';
            

        }else{
             html='<div class="codesList"><p class="tsxx">你还未选择号码</p></div>';
        }  
        if(zmone==0)
        {
            html='<div class="codesList"><p class="tsxx">您输入的金额类型不正确或还没输入金额</p></div>';
        } 
   		layer.open({
            title:'投注列表',   
            content: html,
            scrollbar: true,
            btn: ['确定', '取消'],
            yes: function(index){
                gameaj.setList(datas,'/game/addOrder',index);
            }
        });
   })
})

var lotteryRate=0;
  var lotteryFandian=0;
  var oDiv;
  var fands=100;//parseFloat(yrates['tmzx'].fandian)/100;
  var dufrate=90;
  var fandn=Math.round(dufrate)/100;
var games =function(id,name){
	this.id=id;
	this.name=name;
}

games.prototype={
	getList:function(url,calcFun){
		var contHtml=$('[data-nav*='+this.name+']').html();
        var isnav=$('.play_select_tit').children('li').length;
		$('#lot_num').html(contHtml);
		var _this=this;
		$.ajax({
            type: "get",
            url:url,
            async: false,
            success: function(result,textStatus,xhr) {
            	var data=eval('('+ result +')');
            	data=data.length!=0?data:josn1;
            	  if(data){
            	  	if(typeof calcFun =='function'){
	                  	calcFun(data);
	                }
	                if(data.length>1||isnav<=0){
	                	_this.addNav(data);
	                }
	                
            	  }
                _this.eventstar();    
            },error:function(err){
                lock=true;
            }
        })  
	},
	setList:function(data,url,index,calcFun){
		 $.ajax({
            type: "post",
            url:url,
            data:data,
            async: false,
            dataType:'json',
            success: function(result,textStatus,xhr) {
                 var result = result;
                if(result.message=="投注成功")
                {    
                    //console.log();
                    $('#orderlist_clear').click();
                    $('.g_Number_Section').find('.ball-active').removeClass('ball-active');
                    $('.numberLan,#chipDiv').toggle();
                    $('.betFooterInput').find('input').val('');
                    layer.open({
                        content: result.message,
                        time:2
                    });

                }else{
                    layer.open({
                        content: result.message,
                        time:2
                    });
                    
                }    
            },error:function(err){
                console.log(err);
            }
        })  
	},
	sscList:{
		整合:function(data){
			var namearr=['前三','中三','后三'];
			var data=data[0];
			var length=0,names='';
			for(var key in data){
                names=key!='0'?(data["name"]+'-'+key):data["name"];
				var html='';
                var html1='';
                length=data[key].length>=length?data[key].length:length;
                var issan=$.inArray(key,namearr);
                fands=data[key][0].fandian*10;
				if(typeof data[key] !='string'){

					if(issan>-1){
						for(var i=0;i<data[key].length;i++){
							
                            html1+='<li class="specific-cell-o code_value chan" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-durate="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                            '<span valplace="0">'+data[key][i].class3+'</span>'+
                            '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                            '</li>';         
						}
						$('[data-title='+key+']').html(html1);	

					}else{
						for(var i=0;i<data[key].length;i++){
	                        if(data[key][i]==undefined){
	                        	html+='<div class="bd item_i clear"></div>';
	                        }else{
	                        	var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"":'chan';
	                        	
                                 html+='<li class="specific-cell-o code_value '+codeClass+'" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-durate="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+data[key][i].class3+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>'; 
	                        }
								
						}
						html+='</div>';
						$('[data-title='+key+']').html(html);
					}
					
				}
				
			}
		},
		龙虎斗:function(data){
			var data=data[0];
            
			var html='',names='';
			for(var key in data){
                  names=key!='0'?(data["name"]+'-'+key):data["name"];
                  fands=data[key][0].fandian*10;
				if(typeof data[key] !='string'){
                html+=  '<dl>'+
                            '<dt class="betTitle"> <i class="minus"></i><var>'+key+'</var></dt>'+
                            '<dd class="thangou">'+
                                '<ul class="hmp hmxzq xmcode">';
                            for(var i=0;i<data[key].length;i++)
                            {
                                html+=  '<li class="specific-cell-o code_value w_'+data[key].length+'" data-hm="'+data[key][i].class3+'" data-pl="'+data[key][i].rate+'" data-durate="'+data[key][i].rate+'" data-name="'+names+'" data-id="'+data[key][i].id+'">'+
                                            '<span valplace="0">'+data[key][i].class3+'</span><div class="lot-odds">'+data[key][i].rate+'</div>'+
                                        '</li>';
                            }   
                         html+= '</ul>'+
                            '</dd>'+
                        '</dl>';
                }        
			}
             $('.lhdList').html(html);
		},
		全5中1:function(data){
			var data=data[0],names='';
			for(var key in data){
				var html='';
                fands=data[key][0].fandian*10;
                   names=key!='0'?(data["name"]+'-'+key):data["name"];
				if(typeof data[key] !='string'){
					for(var i=0;i<data[key].length;i++)
					{
                        html+='<li class="specific-cell-o code_value " data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-durate="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+data[key][i].class3+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>'; 
				
					}
					$('.hmxzq').html(html);	
				}
				
			}
		}
	},
    bjpk10:{
    	整合:function(data){
    		
			var data=data[0],names='',html='';
			var length=0;
			for(var key in data){
                names=key!='0'?(data["name"]+'-'+key):data["name"];
				fands=data[key][0].fandian*10;
                length=data[key].length>=length?data[key].length:length;
               
               
				if(typeof data[key] !='string'){
					html+=   '<div class="lot-number-tip betTitle red"><i class="minus"></i><var>'+key+'</var>'+
                                '<div class="gray" style="display: inline;">赔率</div>'+
                            '</div>'+
                            '<ul class="hmp hmxzq xmcode">';
                    for(var i=0;i<data[key].length;i++){
                        var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"chan_"+data[key][i].class3:'chan';
                         html+='<li class="specific-cell-o code_value '+codeClass+'" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-durate="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+data[key][i].class3+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>';
                    }
                    html+='</ul><div style="clear: both; padding:20px 0 0; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>';
                    $('#lot_num').html(html);	
                }
				
			}
    	},
    	"第1-10名":function(data){
			var data=data[0],names='',html='';
            var length=0;
            for(var key in data){
                names=key!='0'?(data["name"]+'-'+key):data["name"];
                
                length=data[key].length>=length?data[key].length:length;
                fands=data[key][0].fandian*10;
               
                if(typeof data[key] !='string'){
                    html+=   '<div class="lot-number-tip betTitle red"><i class="minus"></i><var>'+key+'</var>'+
                                '<div class="gray" style="display: inline;">赔率</div>'+
                            '</div>'+
                            '<ul class="hmp hmxzq xmcode">';
                    for(var i=0;i<data[key].length;i++){
                        var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"chan_"+data[key][i].class3:'chan';
                         html+='<li class="specific-cell-o code_value '+codeClass+'" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-durate="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+data[key][i].class3+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>';
                    }
                    html+='</ul><div style="clear: both; padding:20px 0 0; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>';
                    $('#lot_num').html(html);   
                }
                
            }
    	},
    	冠亚和值:function(data){
    		var data=data[0],names='',html='';
            var length=0;
            for(var key in data){
                names=key!='0'?(data["name"]+'-'+key):data["name"];
                fands=data[key][0].fandian*10;
                length=data[key].length>=length?data[key].length:length;
               
               
                if(typeof data[key] !='string'){
                    html+= '<div class="lot-number-tip betTitle red"><i class="minus"></i><var>冠亚和值</var>'+
                                '<div class="gray" style="display: inline;">赔率</div>'+
                            '</div>'+
                            '<ul class="hmp hmxzq xmcode">';
                    for(var i=0;i<data[key].length;i++){
                        var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"chan_"+data[key][i].class3:'chan';
                         html+='<li class="specific-cell-o code_value '+codeClass+'" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-durate="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+data[key][i].class3+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>';
                    }
                    html+='</ul>';
                    $('#lot_num').html(html);   
                }
                
            }
		},
    	冠亚组合:function(data){
    		var data=data[0],names='',html='';
            var length=0;
            for(var key in data){
                names=key!='0'?(data["name"]+'-'+key):data["name"];
                fands=data[key][0].fandian*10;
                length=data[key].length>=length?data[key].length:length;
                if(typeof data[key] !='string'){
                    html+= '<div class="lot-number-tip betTitle red"><i class="minus"></i><var>冠亚组合</var>'+
                                '<div class="gray" style="display: inline;">赔率</div>'+
                            '</div>'+
                            '<ul class="hmp hmxzq xmcode">';
                    for(var i=0;i<data[key].length;i++){
                        var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"chan_"+data[key][i].class3:'chan';
                         html+='<li class="specific-cell-o code_value '+codeClass+'" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-durate="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+data[key][i].class3+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>';
                    }
                    html+='</ul><div style="clear: both; padding:20px 0 0; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>';
                    $('#lot_num').html(html);   
                }
                
            }
        }    
    },
    jsk3:{
    	大小骰宝:function(data){
            var data=data[0],names='',html='';
            var length=0;
            for(var key in data){
                names=key!='0'?(data["name"]+'-'+key):data["name"];
                
                length=data[key].length>=length?data[key].length:length;
               
               
                if(typeof data[key] !='string'){
                    html+=   '<div class="lot-number-tip red"><var>'+key+'</var>'+
                                '<div class="gray" style="display: inline;">赔率</div>'+
                            '</div>'+
                            '<ul class="hmp hmxzq xmcode">';
                    for(var i=0;i<data[key].length;i++){
                         var htmlimg=gameaj.filters.isPInt(data[key][i].class3)?'<img height="60%" src="/images/lhc/'+data[key][i].class3+'.png">':data[key][i].class3;
                         html+='<li class="specific-cell-o code_value chan" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+htmlimg+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>';
                    }
                    html+='</ul><div style="clear: both; padding:20px 0 0; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>';
                    $('#lot_num').html(html);   
                }
                
            }
    	}
    },
    xync:{
    	两面盘:function(data){
            var data=data[0],names='',html='';
            var length=0;
            for(var key in data){
                names=key!='0'?(data["name"]+'-'+key):data["name"];
                
                length=data[key].length>=length?data[key].length:length;
               
               
                if(typeof data[key] !='string'){
                    html+=   '<div class="lot-number-tip red"><var>'+key+'</var>'+
                                '<div class="gray" style="display: inline;">赔率</div>'+
                            '</div>'+
                            '<ul class="hmp hmxzq xmcode">';
                    for(var i=0;i<data[key].length;i++){
                        var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"":'chan';
                         html+='<li class="specific-cell-o code_value '+codeClass+'" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+data[key][i].class3+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>';
                    }
                    html+='</ul><div style="clear: both; padding:20px 0 0; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>';
                    $('#lot_num').html(html);   
                }
                
            }
    	},
        龙虎斗:function(data){
            var data=data[0];
            
            var html='',names='';
            for(var key in data){
                  names=key!='0'?(data["name"]+'-'+key):data["name"];
                if(typeof data[key] !='string'){
                html+=  '<dl>'+
                            '<dt>'+key+'</dt>'+
                            '<dd>'+
                                '<ul class="hmp hmxzq xmcode">';
                            for(var i=0;i<data[key].length;i++)
                            {
                                html+=  '<li class="specific-cell-o code_value w_'+data[key].length+'" data-hm="'+data[key][i].class3+'" data-pl="'+data[key][i].rate+'" data-name="'+names+'" data-id="'+data[key][i].id+'">'+
                                            '<span valplace="0">'+data[key][i].class3+'</span><div class="lot-odds">'+data[key][i].rate+'</div>'+
                                        '</li>';
                            }   
                         html+= '</ul>'+
                            '</dd>'+
                        '</dl>';
                }        
            }
             $('.lhdList').html(html);
        },
    	pubList:function(data){
            var data=data[0],names='',html='';
            var length=0;
            for(var key in data){
                names=key!='0'?(data["name"]+'-'+key):data["name"];
                
                length=data[key].length>=length?data[key].length:length;
               
               
                if(typeof data[key] !='string'){
                    html+='<ul class="hmp hmxzq xmcode">';
                    for(var i=0;i<data[key].length;i++){
                        var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"":'chan';
                        html+='<li class="specific-cell-o code_value '+codeClass+'" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+data[key][i].class3+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>';
                    }
                    html+='</ul>';
                    $('#lot_num').html(html);   
                }
                
            }
        }
    },
    shix5:{
        两面盘:function(data){
            var data=data[0],names='',html='';
            var length=0;
            for(var key in data){
                names=key!='0'?(data["name"]+'-'+key):data["name"];
                
                length=data[key].length>=length?data[key].length:length;
               
               
                if(typeof data[key] !='string'){
                    html+=   '<div class="lot-number-tip red"><var>'+key+'</var>'+
                                '<div class="gray" style="display: inline;">赔率</div>'+
                            '</div>'+
                            '<ul class="hmp hmxzq xmcode">';
                    for(var i=0;i<data[key].length;i++){
                        var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"":'chan';
                         html+='<li class="specific-cell-o code_value '+codeClass+'" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+data[key][i].class3+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>';
                    }
                    html+='</ul><div style="clear: both; padding:20px 0 0; margin-bottom: 10px; border-bottom: 1px solid #ddd;"></div>';
                    $('#lot_num').html(html);   
                }
                
            }
        },
        龙虎斗:function(data){
            var data=data[0];
            
            var html='',names='';
            for(var key in data){
                  names=key!='0'?(data["name"]+'-'+key):data["name"];
                if(typeof data[key] !='string'){
                html+=  '<dl>'+
                            '<dt>'+key+'</dt>'+
                            '<dd>'+
                                '<ul class="hmp hmxzq xmcode">';
                            for(var i=0;i<data[key].length;i++)
                            {
                                html+=  '<li class="specific-cell-o code_value w_'+data[key].length+'" data-hm="'+data[key][i].class3+'" data-pl="'+data[key][i].rate+'" data-name="'+names+'" data-id="'+data[key][i].id+'">'+
                                            '<span valplace="0">'+data[key][i].class3+'</span><div class="lot-odds">'+data[key][i].rate+'</div>'+
                                        '</li>';
                            }   
                         html+= '</ul>'+
                            '</dd>'+
                        '</dl>';
                }        
            }
             $('.lhdList').html(html);
        },
        pubList:function(data){
            var data=data[0],names='',html='';
            var length=0;
             data["0"].insert(11, 'three');
            for(var key in data){
                names=key!='0'?(data["name"]+'-'+key):data["name"];
                
                length=data[key].length>=length?data[key].length:length;
               
               
                if(typeof data[key] !='string'){
                    html+='<ul class="hmp hmxzq xmcode">';
                    for(var i=0;i<data[key].length;i++){
                        if(data[key][i].class3==undefined){
                          html+='<li class="clear" style="width:100%;height:1px; margin-top:0px"></li>';  
                        }else{
                            var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"":'chan';
                            html+='<li class="specific-cell-o code_value '+codeClass+'" data-hm="'+data[key][i].class3+'" data-name="'+names+'" data-pl="'+data[key][i].rate+'" data-id="'+data[key][i].id+'">'+
                                '<span valplace="0">'+data[key][i].class3+'</span>'+
                                '<div class="lot-odds">'+data[key][i].rate+'</div>'+
                                '</li>';
                        }
                        
                    }
                    html+='</ul>';
                    $('#lot_num').html(html);   
                }
                
            }
        }
    },
	addNav:function(data){
		var html='',classname='',titlename;
		for (var i=0;i<data.length;i++) {
			classname=i==0?'curr':'';
			titlename=data[0].name;
            html+='<li class="'+classname+'" data-url="'+url+'&class1='+data[i].name+'" title="'+data[i].name+'">'+data[i].name+'</li>';
		}
        $('.gameType').children('string').html(titlename);
		$('.play_select_tit').html(html);
	},
	Calculation:function(){
		if($('.GTMselected').length>0){
			var size=0,cunamount=0,arr=[];
			$('.GTMselected').each(function(){
				var value=$(this).find('input').val();
				if(value=='') return;
				size++;
				cunamount=size*parseInt(value);
			})
			arr[0]=size;
			arr[1]=cunamount;
			return arr;
		}
		
	},
	popList:function(){},
	cuntCont:function(){},
	filters:{
		Email:function(value){
			var reg=/^\w+([-+.]\w+)*@\w+([-.]\\w+)*\.\w+([-.]\w+)*$/;
			return reg.test(value);
		},
		Phone:function(value){
			var reg=/^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/;
			return reg.test(value);
		},
		Mobile:function(value){
			var reg=/^((\(\d{3}\))|(\d{3}\-))?13\d{9}$/;
			return reg.test(value);
		},
		Url:function(value){
			var reg=/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/;
			return reg.test(value);
		},
		IdCard:function(value){//身份证
			var reg=/^\d{15}(\d{2}[A-Za-z0-9])?$/;
			return reg.test(value);	
		},
		QQ:function(value){
			var reg=/^[1-9]\d{4,8}$/;
			return reg.test(value);
		},
		Double:function(value){//双
			var reg=/^[-\+]?\d+(\.\d+)?$/;
			return reg.test(value);
		},
		English:function(value){
			var reg=/^[A-Za-z]+$/;
			return reg.test(value);
		},
		Chinese:function(value){//中
			var reg=/^[\u0391-\uFFE5]+$/;
			return reg.test(value);
		},
		isPInt:function(value){//正整数
			var reg= /^[0-9]\d*$/;
			return reg.test(value);
		},
		isInt:function(value){//整数
			var reg= /^-?\d+$/;
			return reg.test(value);
		},
		amount:function(value,len){//金额
			var reg=len==0?new RegExp("[1-9][0-9]*$"):new RegExp("^(([1-9][0-9]*)|([0]\\.\\d{0,"+len+"}|[1-9][0-9]*\\.\\d{0,"+len+"}))$");
			console.log(reg)
			return reg.test(value);
		}
	},
    eventstar:function(){

        $('.wanfas').change(function(){
            var name=$(this).val();
            $('.qhouz').children('[data-title='+name+']').show().siblings('ul').hide();
        })
        $('.bett-tit').off('click');
        $('.bett-tit').on('click',function(){
            $('.beet-tips').toggle();
        })
        $('.hmxzq').children('li').off('click');
        $('.hmxzq li').on('click',function(e){
            var len=$(this).parent('ul').attr('data-len')!=undefined?$(this).parent('ul').attr('data-len').split(','):undefined;
            getcode($(this),len);
        })
        
        $('#orderlist_clear').off('click');
        $('body').on('click','#orderlist_clear',function(){
            
            $('.yBettingLists').children('.yBettingList').remove();
            $('#f_gameOrder_lotterys_num').text(0);
            $('#f_gameOrder_amount').text(0);
        })
        
        
        $('.betMoney').on('keyup',function(){
            var mone=$(this).val();
            mone=isNaN(parseInt(mone))?'':parseInt(mone);
            $(this).val(mone);
        })

        $('body').on('click','.btnadd',function(e){
            var pare=$('.ball-active').eq(0).parents('ul').attr('data-dan')?true:false;
            var length= $('.ball-active').length;
            if(length<=0) return;
            setList(pare);
        })
        $('.btnxytj').on('click',function(e){
            var datas=datacode();
            var count=datas.code.length,monecount=0;
            if(count<=0) return;
            for(var i=0;i<count;i++)
            {
                var mone=datas.code[i].amount;
                monecount+=parseInt(mone);
            }    
            html='<p><span>你共选择 </span><strong style="color:#bb0102">'+count+'</strong> 注，<span>共 </span><strong style="color:#bb0102">'+monecount+'</strong> 元</p>';
            layer.open({
                content: html
                ,btn: ['确定投注', '取消投注']
                ,yes: function(index){
                  tjdata(datas,'/index.php/game/luck28/',0);
                  layer.close(index);
                }
            });
        })
        $('#step_2').find('#reveal-left,.btn-add1').on('click',function(){
            $('#step_1').show().siblings('#step_2').hide();
            $('.btnadd,.btnlmadd,.btnhxadd').attr('data-type','tj');
            var length=$('#bet_list').children('li').size();
            
            if(length>0)
            {
                $('.go-back').show().children('#bet_time_count').text(length);
            }    
            
        })
        $('.fhgwc').on('click',function(){
            $('#step_2').show().siblings('#step_1').hide();
        })
        $('.inp-add3').children('.all').on('keyup',function(){
            allsetmone($(this));
        })
        $('body').on('keyup','.bet-t .money',function(){
            setmone($(this));
        })
         $('body').on('click','.bet-close',function(){
            $(this).parent('dd').remove();
            getzs();
         })
    }
}

function getcode(obj,start){
        obj.toggleClass('ball-active');
        var cont=0,dj=2;
        if(start){

            if(start[1]!=undefined)
            {
               cont=$('.ball-active').size();    
               if(cont>start[1])
                {
                    var keyi=Math.ceil(Math.random()*parseInt(start[1]));
                    var index=$('.ball-active')[0]==$('.ball-active').eq(keyi)[0];
                    if(index){
                        if( $('.ball-active').eq(keyi+1).length>0)
                        {
                            sizes=parseInt(start[1]);
                            $('.ball-active').eq(keyi+1).removeClass('ball-active');
                        }else{
                             sizes=parseInt(start[1]);
                            $('.ball-active').eq(keyi-1).removeClass('ball-active');
                        }
                        return;    
                    }
                    cont=parseInt(start[1]);
                    $('.ball-active').eq(keyi).removeClass('ball-active');

                }
                var zzs=cont;
                var czzs=start[0],ind=1;
                if(cont<start[0])
                {
                    $('#bet_sel_count,#bet_count').text(0);
                    $('#bet_sel_money,#bet_money').text(0);
                }else {
                    for(var i=0;i<start[0]-1;i++)
                    {
                        
                        zzs*=cont-ind;
                        czzs*=start[0]-ind;
                        ind++;
                    }
                    zzs=zzs/czzs;
                    $('#bet_sel_count,#bet_count').text(zzs);
                    $('#bet_sel_money,#bet_money').text(zzs*dj);  
                }
                return;     
            }
            $('#bet_sel_count,#bet_count').text(cont);
            $('#bet_sel_money,#bet_money').text(cont*dj);
        }else{
             cont=$('.ball-active').length;
            $('#bet_sel_count,#bet_count').text(cont);
            $('#bet_sel_money,#bet_money').text(cont*dj);
        }
        
    }

function setList(isdan){
         var length=0,html='',dj=2,wflx=$('.luhtype').val(),mone=$('.betMoney').val();
        if(isdan){
            var pl=$('.ball-active').eq(0).parents('ul').attr('data-rate');
            var codes=[],ids=[],dsize=parseInt($('#bet_sel_count').text());
            $('.ball-active').each(function(i){
               var code=$(this).parent('li').attr('data-hm');
               var id=$(this).parent('li').attr('data-id');
               codes.push(code);
               ids.push(id); 
            })
            var idn=$('.ball-active').eq(0).parents('ul').attr('data-id')?$('.ball-active').eq(0).parents('ul').attr('data-id'):ids.join(',');
            html+='<li class="bet-t" data-hm="'+codes.join(',')+'"  data-id="'+idn+'" data-pl="'+pl+'" data-count="'+dsize+'" data-mone="'+mone+'" >'+
               '<a href="javascript:void(0)" class="bet-close"></a>'+
               '<div class="bet-info-li">'+
               '<div class="bet-number">'+codes.join(',')+'</div>'+
               '<p>赔率:'+pl+'</p>'+
               '<p>'+wflx+'</p>'+
               '</div>'+
               '<div class="bet-inp inp-add2"><span>输入金额:</span><input class="money" maxlength="8" value="'+mone+'"><span>元 </span></div>'+
               '</li>';
             
        }else{
            $('.ball-active').each(function(i){
               var code=$(this).attr('data-hm');
               var pl=$(this).attr('data-pl');
               var id=$(this).attr('data-id');
               var name=$(this).attr('data-name');
               html+='<dd class="yBettingList" class="bet-t" data-hm="'+code+'"  data-id="'+id+'" data-pl="'+pl+'" data-mone="'+mone+'" data-count="1">'+
                        '<div class="numberBox yBettingDiv">'+
                            '<span class="number">'+ 
                                '<em>'+code+'</em>'+
                            '</span>'+
                            '<span class="number" style="margin-left:15px;">'+ 
                                '<em>赔率：'+pl+'</em>'+
                            '</span>'+
                        '</div>'+
                        '<div class="yBettingType">'+name+'</div>'+
                        '<div class="yBettingZhushu yBettingDiv">'+
                            '<em>1</em>注×'+
                        '</div>'+
                        '<div class="rmb yBettingDiv">'+mone+'元</div>'+
                        '<div class="yzongRmb" style="float: left;padding-left: 5px;"> = '+mone+'元</div>'+
                        '<div class="sc bet-close" style="float: right;padding-right: 5px;">'+
                            '<a href="javascript:void(0);">'+
                                '<i class="fa fa-times" style="color: red;"></i>'+
                            '</a>'+
                        '</div>'+
                        '<div id="betting_money" style="display: none;">16.00</div>'+
                    '</dd>';
            })
                 
        }
        $('.yBettingLists').html(html);
        $('#orderlist_clear').show();
        getzs();
        $('.hmxzq').find('span').removeClass('ball-active');
    }
    function datacode(){
        var datas={code:[],para:{
                actionNo:actionNo_a,
                kjTime:kjTime_k,
                type:game.type
        }};
        $('#bet_list').children('li').each(function(i){
            var mone=$(this).find('.money').val();
            if(mone!=''&&mone!=undefined)
            {
            var id=$(this).attr('data-id');
            var code=$(this).attr('data-hm');
            var data={amount:mone,id:id,actionData:code};
            datas.code.push(data);
            }
        })
        return datas;
    } 
    function getzs(){
        var count=0,monecount=0;
        $('.yBettingLists').children('.yBettingList').each(function(i){

            var mone=$(this).attr('data-mone');
            if(mone!=''&&mone!=undefined)
            {
                var cum=$(this).attr('data-count');         
                count+=parseInt(cum);
                monecount+=parseInt(cum)*parseInt(mone);
            }    
            
        })
        $('#f_gameOrder_amount').text(monecount);
        $('#f_gameOrder_lotterys_num').text(count);
    }
    function allsetmone(obj){

        if(!/^[1-9][0-9]*$/g.test(obj.val())) {
            obj.val('');
        }
        var value=obj.val();
        $("#bet_list").find('.money').val(value);
        getzs();
 
    }
    function setmone(obj){
        if(!/^[1-9][0-9]*$/g.test(obj.val())) {
            obj.val('');
        }
        getzs();
    }
    /*
    --特码赔率拖动
  */
  
  $(function(){

  $('.single-slider').jRange({
    from: 0,
    to: 100,
    step: 1,
    format: '%s',
    width: '87%',
    showLabels: false,
    showScale: false,
    onstatechange:function(value,a){
        setslidedd(value);
    },
    callback:function(a){
        oDiv=this;
        this.interval=fands;
        }
  });
  
     $(document).on('click','#minus',function(){
      var i=$( '.single-slider' ).val();;
      if(i<1){
        return;
      }
      i--;
      oDiv.setValue(i);
      setslidedd(i);
    })
     
      $(document).on('click','#plus',function(){
        var i=$( '.single-slider' ).val();
        if(i>=fands){
          return;
        }
        i++;
       
        oDiv.setValue(i);
        setslidedd(i);
      })
  })
  
  function silber(name){
    fands=yrates[name].fandian*10;//parseFloat(yrates['tmzx'].fandian)/100;
    dufrate=parseFloat(yrates[name].maxjj);
    fandn=Math.round(dufrate)/100;
    console.log(fands);
    
    if(typeof oDiv!='undefined'){
      oDiv.setValue(0);
      oDiv.interval=fands;
    }
    lotteryRate=0;
    lotteryFandian=0;
    $("#amount").text(yrates[name].maxjj);

    }
  
    function setslide(data,dufrate,fandn,name){
      var fans=data/10;
      var fandl=(fans*fandn).toFixed(2);
      $('.fans').text((fans).toFixed(1));
      $( "#amount" ).text((dufrate-fandl).toFixed(2));
      $('.play_select_prompt').find('em').text((dufrate-fandl).toFixed(2));
      lotteryFandian=(fans).toFixed(1);
      lotteryRate=(dufrate-fandl).toFixed(2);
    } 

    function setslidedd(data){
        $('.code_value').each(function(i){
          var dufrate=parseFloat($(this).attr('data-durate'));
          var fandn=Math.round(dufrate)/100;
          var fans=data/10;
          var fandl=(fans*fandn).toFixed(2);
          $('.fans').text((fans).toFixed(1));
            //$( "#amount" ).text((dufrate-fandl).toFixed(2));
            $(this).find('.lot-odds').text((dufrate-fandl).toFixed(2));
            $(this).attr('data-pl',(dufrate-fandl).toFixed(2));
            lotteryRate=404;
            lotteryFandian=(fans).toFixed(1);
        })
    }  