$(function(){
    $('body').on('click', '.txt_section .item_i', function (e) {
        if ($(this).hasClass('noselet')) {
            return false;
        }
        if ($(this).find('input').length <= 0) return;
        var value = $('.form-control').val();
        value = isNaN(parseInt(value)) ? '' : parseInt(value);
        var isIput = e.target.tagName == 'INPUT' ? true : false;
        if ($(this).hasClass('GTMselected')) {
            if (isIput) return;
            $(this).removeClass('GTMselected').find('input').val('');
        } else {
            $(this).addClass('GTMselected').find('input').val(value);
        }
    }).on('focusout', '.amount', function () {
        var vel = $(this).val();
        $(this).val(vel.replace(/\D/g, ''));
    }).on('keyup', '.amount', function () {
        var vel = $(this).val();
        $(this).val(vel.replace(/\D/g, ''));
    });
    $('body').on('click', '.nav_wanfa .nav-tab', function () {
        var index = $(this).index();
        $(this).addClass('active').siblings('.nav-tab').removeClass('active');
        $('#qzhList').find('ul').eq(index).show().siblings('ul').hide();
    })
    $('.foot-top').find('li').on('click',function(){
        var value= parseInt($(this).find('span').text());
        var mone=parseInt($('.form-control').val());
            mone= isNaN(mone)?mone=0:mone;
        $('.form-control').val(value+mone);
        $('.form-control').change();
      })
    $('body').on('keyup','.form-control',function(){
    	var value=$(this).val();
        value=isNaN(parseInt(value))?'':parseInt(value);
    	$('.form-control').val(value);
    	$('.GTMselected').find('input').val(value);
    })
    $('.form-control').on('change',function(){
        var mone=$(this).val();
        $('.form-control').val(mone);
        $('.GTMselected').find('input').val(mone);
      }) 
    $('.resetbtn').click('click',function(){
       
        $('.GTMselected').each(function(){
            $(this).removeClass('GTMselected');
            $(this).find('input').val('');
        });
        $('.quickmoney').val('');
    })
   $('#j_play_select').children('.play_select_tit').on('click','li',function(){
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
        
   })

    $('body').on('click','.commitbtn',function(){
        var sizes=$('.GTMselected').length,html='',contmone=0,zmone=0;
        var lotteryname=$('.system_lottery').children('li.curr').attr('lotteryname');
        var datas={
                    orderList:[],
                    expect:lottery.currFullExpect,
                    lotteryname:lotteryname
                };
   
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
                var dupl=$(this).attr('data-durate');
                zmone+=values;
                console.log(0);
                var data={price:values,id:id,rate:pl,fandian:fandiantdz}
                datas.orderList.push(data);
                
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
     //    var zhuangt=true;
     //    layer.open({
     //        title:'投注列表',   
     //        content: html,
     //        scrollbar: true,
     //        btn: ['确定', '取消'],
     //        yes: function(index){
            
     //            if(zmone==0){
     //                layer.close(index);
     //                return false;
     //            };
     //            if(zhuangt)
     //            {
     //                gameaj.setList(datas,'/game/addOrder',index);
     //                zhuangt=false;
     //            }
     //        }
     //    });
        artDialog({
        title:"投注列表",
        content:html,
        cancel:function(){},
        ok:function(){
          if(!user){
            alt('请先登陆',-1);
            return;
          }
          gameaj.setList(datas,'/apijiekou.oldcpbuy');
        },
        lock:true
      });
   })
    console.log(lotteryname);
    var aryoul=$('.changeBtn').find('a').attr('href');
    if(aryoul.indexOf('pk10')>-1){
        $('.changeBtn').find('a').attr('href','/Game.pk10?code='+lotteryname);
    }else{
        $('.changeBtn').find('a').attr('href','/Game.ssc?code='+lotteryname);
    }
    

})
var fandiandfu=0,fandiantdz=0;
 /*
    --特码赔率拖动
  */
function silbers(){
    var fands=fandiandfu*10;
    lotteryRate=0;
    fandiandfu=0;
    $('#minus').on('click',function(){
      var i=$( "#slider-range-min" ).slider('value');
      if(i<1){
        return;
      }
      i--;
      $( "#slider-range-min" ).slider('value',i);
      setslidedd(i);
    })
    $( "#slider-range-min" ).slider({
        range: "min",
        value: 0,
        min: 0,
        max: fands,
        slide: function( event, ui ) {
          setslidedd(ui.value);
        }
    });
    $('#plus').on('click',function(){
        var i=$( "#slider-range-min" ).slider('value');
        if(i>=fands){
          return;
        }
        i++;
        $( "#slider-range-min" ).slider('value',i);
          setslidedd(i);
    })

  }
  function setslidedd(data){
    $('.item_i').each(function(i){
      var dufrate=parseFloat($(this).find('.amount').attr('data-durate'));
      var fandn=Math.round(dufrate)/100;
      var fans=data/10;
      var fandl=(fans*fandn).toFixed(2);
      $('.fans').text((fans).toFixed(1));
        //$( "#amount" ).text((dufrate-fandl).toFixed(2));
        $(this).find('.odds,.t-odds').text((dufrate-fandl).toFixed(2));
        $(this).find('.amount').attr('data-rate',(dufrate-fandl).toFixed(2));
        lotteryRate=404;
        console.log(fandiantdz);
        fandiantdz=(fans).toFixed(1);
    })
  }

  function silber(name){
    var fands=yrates[name].fandian*10;//parseFloat(yrates['tmzx'].fandian)/100;
    var dufrate=parseFloat(yrates[name].rate);
    var fandn=Math.round(dufrate)/100;
    lotteryRate=0;
    lotteryFandian=0;
    $('#minus').on('click',function(){
      var i=$( "#slider-range-min" ).slider('value');
      if(i<1){
        return;
      }
      i--;
      $( "#slider-range-min" ).slider('value',i);
      setslide(i,dufrate,fandn,name);
    })
    $( "#slider-range-min" ).slider({
        range: "min",
        value: 0,
        min: 0,
        max: fands,
        slide: function( event, ui ) {
          setslide(ui.value,dufrate,fandn,name);
        }
      });
      $('#plus').on('click',function(){
        var i=$( "#slider-range-min" ).slider('value');
        if(i>=fands){
          return;
        }
        i++;
        $( "#slider-range-min" ).slider('value',i);
        setslide(i,dufrate,fandn,name);
      })
      $("#amount").text(yrates[name].rate);
    }

    function setslide(data,dufrate,fandn,name){
      var fans=data/10;
      var fandl=(fans*fandn).toFixed(2);
      $('.fans').text((fans).toFixed(1));
      $( "#amount" ).text((dufrate-fandl).toFixed(2));
      $('.play_select_prompt').find('em').text((dufrate-fandl).toFixed(2));
      //lotteryRate=(dufrate-fandl).toFixed(2);
      //fandiantdz=(fans).toFixed(1);
    }

var games =function(id,name){
	this.id=id;
	this.name=name;
}

games.prototype={
	getList:function(url,calcFun){
		var contHtml=$('[data-nav*='+this.name+']').html();
        console.log(url);
		$('.txt_section').html(contHtml);
		var _this=this;
		$.ajax({
            type: "get",
            url:url,
            async: false,
            success: function(result,textStatus,xhr) {
            	var data=eval('('+ result +')');
            	   //_this.getLianm();//两面长龙
            	    if(data){
                	  	if(typeof calcFun =='function'){
                            if(data.length>0){
                                calcFun(data);
                            }else{
                                calcFun(josn1);
                            }
    	                  	
    	                }
    	                if(data.length>1){
    	                	_this.addNav(data);
    	                }
	                
            	  }
                    
            },error:function(err){
                console.log(err);
                lock=true;
            }
        })  
	},
    getLianm:function(cunt){
        var cunt=cunt?cunt:'';
        var url="/lhc/xy_lmcl/"+game.type+"/"+cunt;
        $.ajax({
            type: "get",
            url:url,
            async: false,
            success: function(result,textStatus,xhr) {
                var hmlist=  result;
                var html='';
                for(var i=0;i<hmlist.length;i++)
                {
                    html+='<tr>'+
                    '<th width="120">'+
                    '<a href="javascript:void(0)">'+hmlist[i].class1+'-'+hmlist[i].class2+'-'+hmlist[i].class3+'</a>'+
                    '</th>'+
                    '<td>'+hmlist[i].count+' 期</td>'+
                    '</tr>';

                }
                $(".smList").html(html);
                    
            },error:function(err){
                console.log(err);
                
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
            beforeSend :  function () {
              $('.looding').show();
            },
            success: function(json,textStatus,xhr) {
                if(json.sign){
                    $('.resetbtn').click();
                    getUserBetsListToday(lotteryname);
                    alt('投注成功',1);
                }else{
                    alt(json.message,-1);
                }
                $('.looding').hide();     
            },error:function(err){
                console.log(err);
            }
        })  
	},
	sscList:{
		整合:function(data){
			var namearr=['前三','中三','后三'];
			var data=data[0];
			var length=0;

			for(var key in data){
				var html='<div class="zm16_nav">'+key+'</div>';
                var html1='';
                length=data[key].length>=length?data[key].length:length;
                var issan=$.inArray(key,namearr);
               
				if(typeof data[key] !='string'){

					if(issan>-1){
                        console.log(key);
						for(var i=0;i<data[key].length;i++){
							html1+='<li>'+
                                        '<div class="clear ui-ball-span-box">'+
                                            '<div class="clear">'+
                                                '<span class="border_001">号码</span>'+
                                                '<span class="border_002">赔率</span>'+
                                                '<span class="border_003">金额</span><i></i>'+
                                            '</div>'    +
                                       ' </div>'+
                                        '<div>'+
                                            '<div class="bd item_i clear">'+
                                                '<span class="ball">'+data[key][i].class3+'</span>'+
                                                '<span class="odds" >'+data[key][i].rate+'</span>'+
                                                '<span class="amount_pane">'+
                                                    '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][i].id+'" data-hm="'+data[key][i].class3+'" data-durate="'+data[key][i].rate+'" data-rate="'+data[key][i].rate+'">'+
                                                '</span>'+
                                            '</div>'+
                                        '</div> '  + 
                                    '</li>';
						}
						html1+='</div>';
						$('[data-title='+key+']').html(html1);	

					}else{
						for(var i=0;i<data[key].length;i++){
	                        if(data[key][i]==undefined){
	                        	html+='<div class="bd item_i clear"></div>';
	                        }else{
                                fandiandfu=data[key][i].fandian;
	                        	var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"ball_com":'';
	                        	html+='<div class="bd item_i clear ssc_ball">'+
									'<span class="ball '+codeClass+' '+codeClass+''+data[key][i].class3+'">'+data[key][i].class3+'</span>'+
									'<span class="odds" >'+data[key][i].rate+'</span>'+
									'<span class="amount_pane">'+
									 '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][i].id+'" data-hm="'+data[key][i].class3+'" data-durate="'+data[key][i].rate+'" data-rate="'+data[key][i].rate+'">'+
									'</span>'+
								'</div>';
	                        }
								
						}
						html+='</div>';
						$('[data-title='+key+']').html(html);
					}
					
				}
				
			}
            silbers();
		},
		龙虎斗:function(data){
			var data=data[0];
			var html='';
			for(var key in data){
                fandiandfu=data[key][0].fandian;
				html=  '<div class="t-item item_i w30">'+
                            '<div class="t-name" >'+
                                '<span class="txt-red" style="" oid="3">'+data[key][0].class3+'</span>'+
                                '<span class="t-odds">'+data[key][0].rate+'</span>'+
                            '</div>'+
                            '<div class="t-input tc" >'+
                                '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][0].id+'" data-hm="'+data[key][0].class3+'" data-durate="'+data[key][0].rate+'" data-rate="'+data[key][0].rate+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="t-item item_i w30">'+
                            '<div class="t-name" >'+
                                '<span class="txt-white" style="" oid="3">'+data[key][1].class3+'</span>'+
                               ' <span class="t-odds">'+data[key][1].rate+'</span>'+
                            '</div>'+
                            '<div class="t-input tc" >'+
                                '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][1].id+'" data-hm="'+data[key][1].class3+'" data-durate="'+data[key][1].rate+'" data-rate="'+data[key][1].rate+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="t-item item_i w30">'+
                            '<div class="t-name" >'+
                                '<span class="txt-blue" style="" oid="3">'+data[key][2].class3+'</span>'+
                                '<span class="t-odds">'+data[key][2].rate+'</span>'+
                            '</div>'+
                            '<div class="t-input tc" >'+
                                '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][2].id+'" data-hm="'+data[key][2].class3+'" data-durate="'+data[key][2].rate+'" data-rate="'+data[key][2].rate+'">'+
                            '</div>'+
                        '</div>';
                $('[data-title='+key+']').html(html);       

			}
            silbers();	
		},
		全5中1:function(data){
			var data=data[0];
			for(var key in data){
				var html='';
				if(typeof data[key] !='string'){
                    fandiandfu=data[key][0].fandian;
					for(var i=0;i<data[key].length/2;i++)
					{
						var s=i*2;
						html+='<li>'+
									'<div class="clear ui-ball-span-box">'+
										'<div class="clear">'+
										'<span class="border_001">号码</span>'+
										'<span class="border_002">赔率</span>'+
										'<span class="border_003">金额</span><i></i>'+
										'</div>'    +
									'</div>'+
									'<div>'+
										'<div class="bd item_i clear">'+
											'<span class="ball">'+data[key][s].class3+'</span>'+
											'<span class="odds" >'+data[key][s].rate+'</span>'+
											'<span class="amount_pane">'+
											'<input type="text" class="amount" maxlength="6" data-class2="'+data[key][s].class1+'" data-id="'+data[key][s].id+'" data-hm="'+data[key][s].class3+'" data-durate="'+data[key][s].rate+'"  data-rate="'+data[key][s].rate+'">'+
											'</span>'+
										'</div>'+
									'</div> '  +
									'<div>'+
										'<div class="bd item_i clear">'+
											'<span class="ball">'+data[key][s+1].class3+'</span>'+
											'<span class="odds" >'+data[key][s+1].rate+'</span>'+
											'<span class="amount_pane">'+
											'<input type="text" class="amount" maxlength="6" data-class2="'+data[key][s].class1+'" data-id="'+data[key][s+1].id+'" data-hm="'+data[key][s+1].class3+'" data-durate="'+data[key][s+1].rate+'"  data-rate="'+data[key][s+1].rate+'">'+
											'</span>'+
										'</div>'+
									'</div> '  +  
								'</li>';
					}
					$('.s1_nav').children('ul').html(html);	
				}
				
			}
            silbers();
		}
	},
    bjpk10:{
    	整合:function(data){
    		var namearr=['冠亚和'];
			var data=data[0];
			var length=0;
			for(var key in data){
				var html='<div class="zm16_nav">'+key+'</div>'+
							'<div class="clear ui-ball-span-box">'+
							'<div class="clear">'+
							'<span class="border_001">号码</span>'+
							'<span class="border_002">赔率</span>'+
							'<span class="border_003">金额</span><i></i>'+
							'</div>'+
						'</div><div>';
                var html1='';
                length=data[key].length>=length?data[key].length:length;
                var issan=$.inArray(key,namearr);
                
				if(typeof data[key] !='string'){
					if(issan>-1){
						for(var i=0;i<data[key].length;i++){
							html1+='<li class="w225px">'+
                                        '<div class="clear ui-ball-span-box">'+
                                            '<div class="clear">'+
                                                '<span class="border_001">号码</span>'+
                                                '<span class="border_002">赔率</span>'+
                                                '<span class="border_003">金额</span><i></i>'+
                                            '</div>'    +
                                       ' </div>'+
                                        '<div>'+
                                            '<div class="bd item_i clear">'+
                                                '<span class="ball '+codeClass+'">'+data[key][i].class3+'</span>'+
                                                '<span class="odds" >'+data[key][i].rate+'</span>'+
                                                '<span class="amount_pane">'+
                                                    '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][i].id+'" data-hm="'+data[key][i].class3+'" data-durate="'+data[key][i].rate+'" data-rate="'+data[key][i].rate+'">'+
                                                '</span>'+
                                            '</div>'+
                                        '</div> '  + 
                                    '</li>';
						}
						html1+='</div>';
						$('[data-title='+key+']').html(html1);	

					}else{
						for(var i=0;i<data[key].length;i++){
                            fandiandfu=data[key][i].fandian;
	                        if(data[key][i]==undefined){
	                        	html+='<div class="bd item_i clear"></div>';
	                        }else{
	                        	var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"ball_com":'';
	                        	html+='<div class="bd item_i clear">'+
									'<span class="ball '+codeClass+'">'+data[key][i].class3+'</span>'+
									'<span class="odds" >'+data[key][i].rate+'</span>'+
									'<span class="amount_pane">'+
									 '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][i].id+'" data-hm="'+data[key][i].class3+'" data-durate="'+data[key][i].rate+'" data-rate="'+data[key][i].rate+'">'+
									'</span>'+
								'</div>';
	                        }
								
						}
						html+='</div>';
						$('[data-title='+key+']').html(html);
					}
					
				}
				
			}
            silbers();
    	},
    	"第1-10名":function(data){
			var data=data[0];
			var length=0;
			for(var key in data){
				var html='<div class="zm16_nav">'+key+'</div>'+
							'<div class="clear ui-ball-span-box">'+
							'<div class="clear">'+
							'<span class="border_001">号码</span>'+
							'<span class="border_002">赔率</span>'+
							'<span class="border_003">金额</span><i></i>'+
							'</div>'+
						'</div><div>';
                
                length=data[key].length>=length?data[key].length:length;
				if(typeof data[key] !='string'){
					
					for(var i=0;i<data[key].length;i++){
						if(data[key][i]==undefined){
							html+='<div class="bd item_i clear"></div>';
						}else{
                            fandiandfu=data[key][i].fandian;
							var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"ball_com":'';
							html+='<div class="bd item_i clear pk_ball">'+
							'<span class="ball '+codeClass+'  '+codeClass+''+data[key][i].class3+'"></span>'+
							'<span class="odds" >'+data[key][i].rate+'</span>'+
							'<span class="amount_pane">'+
							'<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][i].id+'" data-hm="'+data[key][i].class3+'" data-durate="'+data[key][i].rate+'" data-rate="'+data[key][i].rate+'">'+
							'</span>'+
							'</div>';
						}
					}
					html+='</div>';
					$('[data-title='+key+']').html(html);
				}
			}
            silbers();
    	},
    	冠亚和值:function(data){
    		var data=data[0];
            var lei=5;
			for(var key in data){
				var html='';
				if(typeof data[key] !='string'){
                    var han=Math.ceil(data[key].length/lei);
					for(var i=0;i<lei;i++){
                        html+='<li>'+
                                    '<div class="clear ui-ball-span-box">'+
                                        '<div class="clear">'+
                                        '<span class="border_001">号码</span>'+
                                        '<span class="border_002">赔率</span>'+
                                        '<span class="border_003">金额</span><i></i>'+
                                        '</div>'    +
                                    '</div>';
                        for(var j=0;j<han;j++){
                            var s=j+(han*i);

                            if(s<data[key].length)
                            {
                                fandiandfu=data[key][s].fandian;
                                var codeClass=gameaj.filters.isPInt(data[key][s].class3)?"ball_com":'';
                                html+='<div>'+
                                    '<div class="bd item_i clear">'+
                                        '<span class="ball '+codeClass+'">'+data[key][s].class3+'</span>'+
                                        '<span class="odds" >'+data[key][s].rate+'</span>'+
                                        '<span class="amount_pane">'+
                                        '<input type="text" class="amount" maxlength="6" data-class2="'+data[key][s].class1+'" data-id="'+data[key][s].id+'" data-hm="'+data[key][s].class3+'" data-durate="'+data[key][s].rate+'" data-rate="'+data[key][s].rate+'">'+
                                        '</span>'+
                                    '</div>'+
                                '</div> ' ; 
                            }else{
                                html+='<div><div class="bd item_i clear"></div></div>';
                            }    
                            
                        }			
						html+='</li>';
					}
					$('.s1_nav').children('ul').html(html);	
				}
				
			}
            silbers();
		},
    	冠亚组合:function(data){
    		var data=data[0];
            var lei=5;

            for(var key in data){
                var html='';
                if(typeof data[key] !='string'){
                    var han=Math.ceil(data[key].length/lei)
                    fandiandfu=data[key][0].fandian;
                    for(var i=0;i<lei;i++)
                    {
                        
                        html+='<li>'+
                                    '<div class="clear ui-ball-span-box">'+
                                        '<div class="clear">'+
                                        '<span class="border_001">号码</span>'+
                                        '<span class="border_002">赔率</span>'+
                                        '<span class="border_003">金额</span><i></i>'+
                                        '</div>'+
                                    '</div>';
                        for(var j=0;j<han;j++){
                            var s=j+(han*i);
                            html+='<div>'+
                                    '<div class="bd item_i clear">'+
                                        '<span class="ball">'+data[key][s].class3+'</span>'+
                                        '<span class="odds" >'+data[key][s].rate+'</span>'+
                                        '<span class="amount_pane">'+
                                        '<input type="text" class="amount" maxlength="6" data-class2="'+data[key][s].class1+'" data-id="'+data[key][s].id+'" data-hm="'+data[key][s].class3+'" data-durate="'+data[key][s].rate+'" data-rate="'+data[key][s].rate+'">'+
                                        '</span>'+
                                    '</div>'+
                                '</div> ' ; 
                        }           
                        html+='</li>';
                    }
                    $('.s1_nav').children('ul').html(html);
                }
                
            }
            silbers();
        }    
    },
    jsk3:{
    	大小骰宝:function(data){
            var data=data[0];
            var length=0;
            var html='';
            var lie=5;
            for(var key in data){
                if(typeof data[key] !='string'){
                    html+='<li><div class="ui-tit-tr-box">'+key+'</div><div class="fl w100" >';
                    conts=Math.ceil(data[key].length/lie)*lie;
                    for(var i=0;i<conts;i++){
                        if(i<data[key].length){
                            var code=gameaj.filters.isPInt(data[key][i].class3)?data[key][i].class3.split(''):'';
                            var url1=code[0]?'/test/images/sezi/'+code[0]+'.png':'';
                            var url2=code[1]?'/test/images/sezi/'+code[1]+'.png':'';
                            var classd=code[1]?'':'dn';
                            var classc=gameaj.filters.isPInt(data[key][i].class3)?'dn':'';
                            var classs=gameaj.filters.isPInt(data[key][i].class3)?'':'dn';
                            html+='<div class="ui-ttr-box item_i">'+
                                    '<div class="bd clear fl">'+
                                        '<span class="ball tc" >'+
                                            '<span class="w100 tb-style '+classc+'">'+data[key][i].class3+'</span>'+
                                            '<label class="db w100" >'+
                                                '<img width="19" height="19" class="'+classs+'" src="'+url1+'">'+
                                                '<img width="19" height="19" class="'+classd+'" src="'+url2+'">'+
                                            '</label>'+
                                        '</span>'+
                                        '<span class="odds" >'+data[key][i].rate+'</span>'+
                                        '<span class="amount_pane">'+
                                            '<input type="text" class="amount" autocomplete="off" data-class2="'+data[key][i].class2+'" data-id="'+data[key][i].id+'" data-hm="'+data[key][i].class3+'" data-rate="'+data[key][i].rate+'" maxlength="9" >'+
                                        '</span>'+
                                    '</div>'+
                                '</div>';
                        }else{
                            html+='<div class="ui-ttr-box"><div class="bd clear fl"></div></div>';
                        }   
                    }
                    html+='</div></li>';
                    $('.ui-tb-con-box').children('ul').html(html);    
                } 
            }
    	}
    },
    xync:{
    	两面盘:function(data){
            var data=data[0];
            var length=0;
            for(var key in data){
                var html='<div class="zm16_nav">'+key+'</div>'+
                            '<div class="clear ui-ball-span-box">'+
                            '<div class="clear">'+
                            '<span class="border_001">号码</span>'+
                            '<span class="border_002">赔率</span>'+
                            '<span class="border_003">金额</span><i></i>'+
                            '</div>'+
                        '</div><div>';
                
                length=data[key].length>=length?data[key].length:length;
                if(typeof data[key] !='string'){
                    
                    for(var i=0;i<data["特码"].length;i++){
                        if(data[key][i]==undefined){
                            html+='<div class="bd item_i clear"></div>';
                        }else{
                            var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"ball_com":'';
                            html+='<div class="bd item_i clear">'+
                            '<span class="ball '+codeClass+'">'+data[key][i].class3+'</span>'+
                            '<span class="odds" >'+data[key][i].rate+'</span>'+
                            '<span class="amount_pane">'+
                            '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][i].id+'" data-hm="'+data[key][i].class3+'" data-rate="'+data[key][i].rate+'">'+
                            '</span>'+
                            '</div>';
                        }
                    }
                    html+='</div>';
                    $('[data-title='+key+']').html(html);
                }
            }
    	},
        龙虎斗:function(data){
            var data=data[0];
            var html='';
            for(var key in data){
                if(typeof data[key] !='string'){
                    html=  '<div class="t-item item_i w50">'+
                                '<div class="t-name" >'+
                                    '<span class="txt-red" style="" oid="3">'+data[key][0].class3+'</span>'+
                                    '<span class="t-odds">'+data[key][0].rate+'</span>'+
                                '</div>'+
                                '<div class="t-input tc" >'+
                                    '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][0].id+'" data-hm="'+data[key][0].class3+'" data-rate="'+data[key][0].rate+'">'+
                                '</div>'+
                            '</div>'+
                            
                            '<div class="t-item item_i w50">'+
                                '<div class="t-name" >'+
                                    '<span class="txt-blue" style="" oid="3">'+data[key][1].class3+'</span>'+
                                    '<span class="t-odds">'+data[key][1].rate+'</span>'+
                                '</div>'+
                                '<div class="t-input tc" >'+
                                    '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][1].id+'" data-hm="'+data[key][1].class3+'" data-rate="'+data[key][1].rate+'">'+
                                '</div>'+
                            '</div>';        
                    $('[data-title='+key+']').html(html);
                }       

            }   
        },
        '全8中1':function(data){
            var data=data[0];
            var lei=5;

            for(var key in data){
                var html='';
                if(typeof data[key] !='string'){
                    var han=Math.ceil(data[key].length/lei)
                    for(var i=0;i<lei;i++)
                    {
                        
                        html+='<li>'+
                                    '<div class="clear ui-ball-span-box">'+
                                        '<div class="clear">'+
                                        '<span class="border_001">号码</span>'+
                                        '<span class="border_002">赔率</span>'+
                                        '<span class="border_003">金额</span><i></i>'+
                                        '</div>'+
                                    '</div>';
                        for(var j=0;j<han;j++){
                            var s=j+(han*i);
                            var codeClass=gameaj.filters.isPInt(data[key][s].class3)?"ball_com":'';
                            html+='<div>'+
                                    '<div class="bd item_i clear">'+
                                        '<span class="ball '+codeClass+'">'+data[key][s].class3+'</span>'+
                                        '<span class="odds" >'+data[key][s].rate+'</span>'+
                                        '<span class="amount_pane">'+
                                        '<input type="text" class="amount" maxlength="6" data-class2="'+data[key][s].class1+'" data-id="'+data[key][s].id+'" data-hm="'+data[key][s].class3+'" data-rate="'+data[key][s].rate+'">'+
                                        '</span>'+
                                    '</div>'+
                                '</div> ' ; 
                        }           
                        html+='</li>';
                    }
                    $('.s1_nav').children('ul').html(html);
                }
                
                
            }
        },
    	pubList:function(data){
            var data=data[0];
            var lei=5;

            for(var key in data){
                var html='';
                if(typeof data[key] !='string'){
                    var han=Math.ceil(data[key].length/lei)
                    for(var i=0;i<lei;i++)
                    {
                        
                        html+='<li>'+
                                    '<div class="clear ui-ball-span-box">'+
                                        '<div class="clear">'+
                                        '<span class="border_001">号码</span>'+
                                        '<span class="border_002">赔率</span>'+
                                        '<span class="border_003">金额</span><i></i>'+
                                        '</div>'+
                                    '</div>';
                        for(var j=0;j<han;j++){
                            var s=i+(lei*j);
                            if(s>data[key].length) return;
                            var codeClass=gameaj.filters.isPInt(data[key][s].class3)?"ball_com":'';
                            html+='<div>'+
                                    '<div class="bd item_i clear">'+
                                        '<span class="ball '+codeClass+'">'+data[key][s].class3+'</span>'+
                                        '<span class="odds" >'+data[key][s].rate+'</span>'+
                                        '<span class="amount_pane">'+
                                        '<input type="text" class="amount" maxlength="6" data-class2="'+data[key][s].class1+'" data-id="'+data[key][s].id+'" data-hm="'+data[key][s].class3+'" data-rate="'+data[key][s].rate+'">'+
                                        '</span>'+
                                    '</div>'+
                                '</div> ' ; 
                        }           
                        html+='</li>';
                    }
                    $('.s1_nav').children('ul').html(html);
                }
                
            }
        }
    },
    shix5:{
        两面盘:function(data){
            var data=data[0];
            var length=0;
            for(var key in data){
                var html='<div class="zm16_nav">'+key+'</div>'+
                            '<div class="clear ui-ball-span-box">'+
                            '<div class="clear">'+
                            '<span class="border_001">号码</span>'+
                            '<span class="border_002">赔率</span>'+
                            '<span class="border_003">金额</span><i></i>'+
                            '</div>'+
                        '</div><div>';
                
                length=data[key].length>=length?data[key].length:length;
                if(typeof data[key] !='string'){
                    
                    for(var i=0;i<data["总和"].length;i++){
                        if(data[key][i]==undefined){
                            html+='<div class="bd item_i clear"></div>';
                        }else{
                            var codeClass=gameaj.filters.isPInt(data[key][i].class3)?"ball_com":'';
                            html+='<div class="bd item_i clear">'+
                            '<span class="ball '+codeClass+'">'+data[key][i].class3+'</span>'+
                            '<span class="odds" >'+data[key][i].rate+'</span>'+
                            '<span class="amount_pane">'+
                            '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][i].id+'" data-hm="'+data[key][i].class3+'" data-rate="'+data[key][i].rate+'">'+
                            '</span>'+
                            '</div>';
                        }
                    }
                    html+='</div>';
                    $('[data-title='+key+']').html(html);
                }
            }
        },
        龙虎斗:function(data){
            var data=data[0];
            var html='';
            for(var key in data){
                if(typeof data[key] !='string'){
                    html=  '<div class="t-item item_i w50">'+
                                '<div class="t-name" >'+
                                    '<span class="txt-red" style="" oid="3">'+data[key][0].class3+'</span>'+
                                    '<span class="t-odds">'+data[key][0].rate+'</span>'+
                                '</div>'+
                                '<div class="t-input tc" >'+
                                    '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][0].id+'" data-hm="'+data[key][0].class3+'" data-rate="'+data[key][0].rate+'">'+
                                '</div>'+
                            '</div>'+
                            
                            '<div class="t-item item_i w50">'+
                                '<div class="t-name" >'+
                                    '<span class="txt-blue" style="" oid="3">'+data[key][1].class3+'</span>'+
                                    '<span class="t-odds">'+data[key][1].rate+'</span>'+
                                '</div>'+
                                '<div class="t-input tc" >'+
                                    '<input type="text" class="amount" maxlength="6" data-class2="'+key+'" data-id="'+data[key][1].id+'" data-hm="'+data[key][1].class3+'" data-rate="'+data[key][1].rate+'">'+
                                '</div>'+
                            '</div>';        
                    $('[data-title='+key+']').html(html);
                }       

            }   
        },
        '全8中1':function(data){
            var data=data[0];
            var lei=5;

            for(var key in data){
                var html='';
                if(typeof data[key] !='string'){
                    var han=Math.ceil(data[key].length/lei)
                    for(var i=0;i<lei;i++)
                    {
                        
                        html+='<li>'+
                                    '<div class="clear ui-ball-span-box">'+
                                        '<div class="clear">'+
                                        '<span class="border_001">号码</span>'+
                                        '<span class="border_002">赔率</span>'+
                                        '<span class="border_003">金额</span><i></i>'+
                                        '</div>'+
                                    '</div>';
                        for(var j=0;j<han;j++){
                            var s=j+(han*i);
                            var codeClass=gameaj.filters.isPInt(data[key][s].class3)?"ball_com":'';
                            html+='<div>'+
                                    '<div class="bd item_i clear">'+
                                        '<span class="ball '+codeClass+'">'+data[key][s].class3+'</span>'+
                                        '<span class="odds" >'+data[key][s].rate+'</span>'+
                                        '<span class="amount_pane">'+
                                        '<input type="text" class="amount" maxlength="6" data-class2="'+data[key][s].class1+'" data-id="'+data[key][s].id+'" data-hm="'+data[key][s].class3+'" data-rate="'+data[key][s].rate+'">'+
                                        '</span>'+
                                    '</div>'+
                                '</div> ' ; 
                        }           
                        html+='</li>';
                    }
                    $('.s1_nav').children('ul').html(html);
                }
                
            }
        },
        pubList:function(data){
            var data=data[0];
            var lei=4;
            //data=data["0"].splice(10, 0, "1");
            data["0"].insert(11, 'three');
            for(var key in data){
                var html='';
                if(typeof data[key] !='string'){
                    var han=Math.ceil(data[key].length/lei)
                    for(var i=0;i<lei;i++)
                    {
                        
                        html+='<li class="w225px">'+
                                    '<div class="clear ui-ball-span-box">'+
                                        '<div class="clear">'+
                                        '<span class="border_001">号码</span>'+
                                        '<span class="border_002">赔率</span>'+
                                        '<span class="border_003">金额</span><i></i>'+
                                        '</div>'+
                                    '</div>';
                        for(var j=0;j<han;j++){
                            var s=i+(lei*j);
                           
                            if(s<data[key].length){
                                if(data[key][s].class3==undefined){
                                   
                                    html+='<div>'+
                                    '<div class="bd item_i clear">'+
                                        
                                    '</div>'+
                                '</div> ' ; 
                                }else{
                                   var codeClass=gameaj.filters.isPInt(data[key][s].class3)?"ball_com":'';
                                html+='<div>'+
                                    '<div class="bd item_i clear">'+
                                        '<span class="ball '+codeClass+'">'+data[key][s].class3+'</span>'+
                                        '<span class="odds" >'+data[key][s].rate+'</span>'+
                                        '<span class="amount_pane">'+
                                        '<input type="text" class="amount" maxlength="6" data-class2="'+data[key][s].class1+'" data-id="'+data[key][s].id+'" data-hm="'+data[key][s].class3+'" data-rate="'+data[key][s].rate+'">'+
                                        '</span>'+
                                    '</div>'+
                                '</div> ' ;  
                                }
                                
                            }
                            
                        }           
                        html+='</li>';

                    }
                    $('.s1_nav').children('ul').html(html);
                    
                }
                
            }
        }
    },
	addNav:function(data){
		var html='',classname='';
		for (var i=0;i<data.length;i++) {
			classname=i==0?'curr':'';
			
		    html+='<li lottery_code="ctzh" data-url="'+url+'&class1='+data[i].name+'" title="'+data[i].name+'" class="'+classname+'">'+data[i].name+'</li>'
        }
		$('#j_play_select').children('.play_select_tit').html(html);
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

			return reg.test(value);
		}
	}
}


