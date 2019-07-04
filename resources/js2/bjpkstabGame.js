$(function () {
  var inputVal = ''; //用户填写的倍数
  var zhushus = []; //注数数组;
  var currNumber = []; //存储每组位数的数组
  var minMoney = 2; //每注金额
  var lastMoney = 0.00;//计算出的金额
  var AllZhushu = 0;//方案注数
  var AllMoney = 0;//方案注数金额
  var danshiNumberL = 0;//单式号码长度
  var yesArr = [];//单式正确的数组
  var orderList= [];//投注数组
  var yrates = k3lotteryrates.rates;
  var _thisPlayid = '';
  var lotteryRate=0;
  var lotteryFandian=0;
  var wxGetMaxMoney = { //每种玩法的可中金额
    wx_fs: 192000.00,
    wx_zx120: 1600.00,
    wx_zx60: 3200.00,
    wx_zx30: 6400.00,
    wx_zx20: 9600.00,
    wx_zx10: 19200.00,
    wx_zx5: 38400.00,
    wx_1mbdw: 4.68,
    wx_2mbdw: 13.08,
    wx_3mbdw: 44.13,
    wx_yffs: 4.68,
    wx_hscs: 23.56,
    wx_sxbx: 224.29,
    wx_sjfc: 4173.91,
  }

  function tabGameInit(){
    _thisPlayid = 'bjpk10dwd';
    rates = yrates[_thisPlayid];
    gameSwitch($('.bet_filter_box'),bjpks_dwd_title,bjpks_dwd_arr);
    $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从冠、亚、季、四、五、六、七、八、九、十任意位置上任意选择一个或一个以上号码，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
    gameNumber(bjpks_dwd,10,1);
  }
  tabGameInit();
  getUserBetsListToday(lotteryname);

  if($('.selectMultipInput').val() <= 1){
    $('.reduce').addClass('noReduce');
  }

  //倍数减
  $('.reduce').on('click',function (){
    addAndSubtract('-');
    countMoney();
  })
  //倍数加
  $('.selectMultiple .add').on('click',function (){
    addAndSubtract('+');
    countMoney();
  })
  //倍数输入框
  $('.selectMultipInput').on('change keyup',function (){
    addAndSubtract();
    countMoney();
  })

  //人民币单位换算
  $('.selectMultipleCon').on('change',function (){
    countMoney();
  })
  
  //号码点击
  $('.g_Number_Section').on('click','.selectNumbers a',function (){
    if(_thisPlayid == 'q3_zxbd' || _thisPlayid == 'z3_zxbd' || _thisPlayid == 'h3_zxbd' ||  _thisPlayid == 'q2_zsxbd' || _thisPlayid == 'h2_zsxbd'){
      $(this).addClass('curr').siblings().removeClass('curr');
    }else{
      if($(this).hasClass('curr')){
        $(this).removeClass('curr');
      }else{  
        $(this).addClass('curr')
      }
    }
    currNumber = currList();
    countFun()
    countMoney();
  })

  function countFun(){
    switch(_thisPlayid){
      case 'bjpk10dwd': 
        zhushus.length = $('.g_Number_Section').find('.curr').length;
        break;
      case 'bjpk10qian3':
        zhushus.length = cqsanCount();
        break;
      case 'bjpk10qian5':
        zhushus.length = cqwCount();
        break;
      case 'bjpk10qian4':
        zhushus.length = cqsCount();
        break;
      case 'bjpk10qian2':
        zhushus.length = cqeCount();
        break;
      case 'bjpk10qian1':
        zhushus.length = $('.g_Number_Section').find('.curr').length;
        break;
    }
    //console.log(_thisPlayid,zhushus.length,currNumber);
  }

  var ballF = 0;
  var ballS = 0;
  var ballT = 0;
  var ballSi = 0;
  var ballWu = 0;
  var selected_f_ball_array = [];
  var selected_s_ball_array = [];
  var selected_t_ball_array = [];
  var selected_si_ball_array = [];
  var selected_wu_ball_array = [];
  function combineArrUpdata(){
    ballF = 0;
    ballS = 0;
    ballT = 0;
    selected_f_ball_array = [];
    selected_s_ball_array = [];
    selected_t_ball_array = [];
    for(var i = 0; i < currNumber.length; i++){
      for(var j = 0; j < currNumber[i].length; j++){
        if(i == 0){
          selected_f_ball_array[parseInt(currNumber[i][j])] = currNumber[i][j]
        }else if(i == 1){
          selected_s_ball_array[parseInt(currNumber[i][j])] = currNumber[i][j]
        }else{
          selected_t_ball_array[parseInt(currNumber[i][j])] = currNumber[i][j]
        }
      }
      if(i == 0){
        ballF = currNumber[i].length;
      }else if(i == 1){
        ballS = currNumber[i].length;
      }else{
        ballT = currNumber[i].length;
      }
    }
  }

  function combineArrUpdataWu(){
    ballF = 0;
    ballS = 0;
    ballT = 0;
    ballSi = 0;
    ballWu = 0;
    selected_f_ball_array = [];
    selected_s_ball_array = [];
    selected_t_ball_array = [];
    selected_si_ball_array = [];
    selected_wu_ball_array = [];
    for(var i = 0; i < currNumber.length; i++){
      for(var j = 0; j < currNumber[i].length; j++){
        if(i == 0){
          selected_f_ball_array[parseInt(currNumber[i][j])] = currNumber[i][j]
        }else if(i == 1){
          selected_s_ball_array[parseInt(currNumber[i][j])] = currNumber[i][j]
        }else if(i == 2){
          selected_t_ball_array[parseInt(currNumber[i][j])] = currNumber[i][j]
        }else if(i == 3){
          selected_si_ball_array[parseInt(currNumber[i][j])] = currNumber[i][j]
        }else{
          selected_wu_ball_array[parseInt(currNumber[i][j])] = currNumber[i][j]
        }
      }
      if(i == 0){
        ballF = currNumber[i].length;
      }else if(i == 1){
        ballS = currNumber[i].length;
      }else if(i == 2){
        ballT = currNumber[i].length;
      }else if(i == 3){
        ballSi = currNumber[i].length;
      }else{
        ballWu = currNumber[i].length;
      }
    }
  }

  function cqeCount(){
    combineArrUpdata();
    var itemcount = 0;
    if(ballF>=1&&ballS>=1){
						
      var opFlag=false;
      
      for(var i=0;i<selected_f_ball_array.length;i++){
        
        var current_f_ball=selected_f_ball_array[i];
        
        if(current_f_ball!=undefined&&current_f_ball!=""){
          
          for(var s=0;s<selected_s_ball_array.length;s++){
            
            var current_s_ball=selected_s_ball_array[s];
            
            if(current_s_ball!=undefined&&current_s_ball!=""){
              
              if(eval(current_f_ball)!=eval(current_s_ball)){                
                      itemcount=itemcount+1;  
              }
            }
          }
        }
      }
    }

    return itemcount;
  }

  function cqsCount(){
    combineArrUpdataWu();
    var itemcount = 0;
    if(ballF>=1&&ballS>=1&&ballT>=1&&ballSi>=1){
						
      var opFlag=false;
      
      for(var i=0;i<selected_f_ball_array.length;i++){
        
        var current_f_ball=selected_f_ball_array[i];
        
        if(current_f_ball!=undefined&&current_f_ball!=""){
          
          for(var s=0;s<selected_s_ball_array.length;s++){
            
            var current_s_ball=selected_s_ball_array[s];
            
            if(current_s_ball!=undefined&&current_s_ball!=""){
              
              if(eval(current_f_ball)!=eval(current_s_ball)){
                
                for(var t=0;t<selected_t_ball_array.length;t++){
                  
                  var current_t_ball=selected_t_ball_array[t];

                  if(current_t_ball!=undefined&&current_t_ball!=""){
                                              
                    if(eval(current_t_ball)!=eval(current_s_ball)&&eval(current_t_ball)!=eval(current_f_ball)){

                      for(var si = 0; si < selected_si_ball_array.length; si++){

                        var current_si_ball = selected_si_ball_array[si];

                        if(current_si_ball!=undefined&&current_si_ball!=''){

                          if(eval(current_si_ball)!=eval(current_s_ball)&&eval(current_si_ball)!=eval(current_f_ball)&&eval(current_si_ball)!=eval(current_t_ball)){

                                  itemcount=itemcount+1;
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
            
          }
        }
      }
    }
    return itemcount;
  }

  function cqwCount(){
    combineArrUpdataWu();
    var itemcount = 0;
    if(ballF>=1&&ballS>=1&&ballT>=1&&ballSi>=1&&ballWu>=1){
						
      var opFlag=false;
      
      for(var i=0;i<selected_f_ball_array.length;i++){
        
        var current_f_ball=selected_f_ball_array[i];
        
        if(current_f_ball!=undefined&&current_f_ball!=""){
          
          for(var s=0;s<selected_s_ball_array.length;s++){
            
            var current_s_ball=selected_s_ball_array[s];
            
            if(current_s_ball!=undefined&&current_s_ball!=""){
              
              if(eval(current_f_ball)!=eval(current_s_ball)){
                
                for(var t=0;t<selected_t_ball_array.length;t++){
                  
                  var current_t_ball=selected_t_ball_array[t];

                  if(current_t_ball!=undefined&&current_t_ball!=""){
                                              
                    if(eval(current_t_ball)!=eval(current_s_ball)&&eval(current_t_ball)!=eval(current_f_ball)){

                      for(var si = 0; si < selected_si_ball_array.length; si++){

                        var current_si_ball = selected_si_ball_array[si];

                        if(current_si_ball!=undefined&&current_si_ball!=''){

                          if(eval(current_si_ball)!=eval(current_s_ball)&&eval(current_si_ball)!=eval(current_f_ball)&&eval(current_si_ball)!=eval(current_t_ball)){

                            for(var wu = 0; wu < selected_wu_ball_array.length; wu++){

                              var current_wu_ball = selected_wu_ball_array[wu];

                              if(current_wu_ball!=undefined&&current_wu_ball!=''){

                                if(eval(current_wu_ball)!=eval(current_s_ball)&&eval(current_wu_ball)!=eval(current_f_ball)&&eval(current_wu_ball)!=eval(current_t_ball)&&eval(current_wu_ball)!=eval(current_si_ball)){

                                  itemcount=itemcount+1;
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
            
          }
        }
      }
    }
    return itemcount;
  }

  function cqsanCount(){
    combineArrUpdata();
    var itemcount = 0;
    if(ballF>=1&&ballS>=1&&ballT>=1){
						
      var opFlag=false;
      
      for(var i=0;i<selected_f_ball_array.length;i++){
        
        var current_f_ball=selected_f_ball_array[i];
        
        if(current_f_ball!=undefined&&current_f_ball!=""){
          
          for(var s=0;s<selected_s_ball_array.length;s++){
            
            var current_s_ball=selected_s_ball_array[s];
            
            if(current_s_ball!=undefined&&current_s_ball!=""){
              //console.log(eval(current_f_ball),eval(current_s_ball));
              if(eval(current_f_ball)!=eval(current_s_ball)){
                
                for(var t=0;t<selected_t_ball_array.length;t++){
                  
                  var current_t_ball=selected_t_ball_array[t];

                  if(current_t_ball!=undefined&&current_t_ball!=""){
                                              
                    if(eval(current_t_ball)!=eval(current_s_ball)&&eval(current_t_ball)!=eval(current_f_ball)){
                      
                      itemcount=itemcount+1;
                      
                    }
                  }
                }
              }
            }
            
          }
        }
      }
    }

    return itemcount;
  }


  //投注区删除单个
  $('.yBettingLists').on('click','.sc',function (){
    var len = $('.yBettingLists').find('.yBettingList');
    var _id = $(this).parent().attr('id');
    var indexs = 0;
    len.each(function (i){
      if(_id == orderList[i].trano){
        indexs = i;
      }
    });
    orderList.splice(indexs,1);
    $(this).parents('.yBettingList').remove();
    //console.log(orderList);
    countAll();
  })

  //少于一注
  $('.yBettingLists').on('click','.numberInfo',function(){
    var text = $(this).siblings('.number').find('em').text();
    alt(text);
  })

  //清空单号
  $('#orderlist_clear').on('click',function (){
    $('.yBettingLists').html('');
    orderList = [];
    countAll();
  })

  //单式textarea框
  $('.g_Number_Section').on('change keyup','#text',function (){
    chkPrice(this);
    chkLast(this);
    var text = $('#text').val();
    checkNumber(text,danshiNumberL);
    yesArr = unique1(yesArr);
    currNumber = yesArr;
    zhushus = yesArr;
    countMoney();
  })

  //去重数组
  function unique1(args){
    var str1 = [];
    for(var i=0;i<args.length;i++){
      if(str1.indexOf(args[i])<0){
          str1.push(args[i])
      }
    }
    return str1;
  }

  //删除错误项
  $('.g_Number_Section').on('click','.remove_btn',function (){
    var text = $('#text').val();
    checkNumber(text,danshiNumberL,'remove');
  })

  //检查格式是否正确
  $('.g_Number_Section').on('click','.test_istrue',function (){
    var text = $('#text').val();
    checkNumber(text,danshiNumberL,'test');
  })

  //清空文本
  $('.g_Number_Section').on('click','.empty_text',function (){
    $('#text').val('');
    currNumber = [];
    zhushus = []; 
    countMoney();
  })

  //玩法内容切换
  $('.bet_filter_box').on('click','.bet_options',function (){
    var _thisType = $(this).attr('lottery_code_two');
    $('#bet_filter').find('.bet_options').removeClass('curr');
    $(this).addClass('curr');
    $('.g_Number_Section').html('');
    currNumber = [];
    zhushus = []; 
    countMoney();
    _thisPlayid = _thisType;
    rates = yrates[_thisPlayid];

    switch(_thisType){
      case 'bjpk10dwd':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从冠、亚、季、四、五、六、七、八、九、十任意位置上任意选择一个或一个以上号码，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_dwd,10,1);
        break;
      case 'bjpk10qian3ds':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('手动输入号码，输入3个号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        danshiNumberL = 2;
        danshiGame();
        break;
      case 'bjpk10qian3':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从各名次中各选择1个不重复的号码组成一注，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_cqsan,10,1);
        break;
      case 'bjpk10qian5':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从各名次中各选择1个不重复的号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_cqw,10,1);
        break;
      case 'bjpk10qian5ds':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('手动输入号码，输入5个号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        danshiNumberL = 2;
        danshiGame();
        break;
      case 'bjpk10qian4':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从各名次中各选择1个不重复的号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_cqs,10,1);
        break;
      case 'bjpk10qian4ds':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('手动输入号码，输入4个号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        danshiNumberL = 2;
        danshiGame();
        break;
      case 'bjpk10qian2':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从各名次中各选择1个不重复的号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_cqe,10,1);
        break;
      case 'bjpk10qian2ds':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('手动输入号码，输入2个号码组成一注，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        danshiNumberL = 2;
        danshiGame();
        break;
      case 'cqgj':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('选择1个号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_cqgj,10,1);
        break;
    }
  })
  
  function gameNumberZxbd(arr,type){
    var box = $('.g_Number_Section');
    var dxdsObj = {
      '0': '大',
      '1': '小',
      '2': '单',
      '3': '双'
    }
    for(var i = 0;i<arr.length;i++){
      var boxList = $('<div class="selectNmuverBox"></div>');
      if(type == 'dxds'){
        var boxNumber = $('<div class="selectNumbers" style="padding: 0 148px;"></div>');
      }else{
        var boxNumber = $('<div class="selectNumbers"></div>');
      }
      
      boxList.append('<span class="numberTitle">'+arr[i]+'</span>');
      boxList.append(boxNumber);
      if(type == 'dxds'){
        for(var j in dxdsObj){
          boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+j+'">'+dxdsObj[j]+'</a>');
        }
      }else{
        for(var j = 0;j<=9;j++){
          boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+j+'">'+j+'</a>');
        }
      }
      
      box.append(boxList);
    }
  }

  //确认选号，添加到投注区
  $('.addtobetbtn').on('click',function (){
    var yBetting = $('.yBettingList');
    var menu0 = $('.play_select_tit').find('.curr').text();
    var menu1 = $('#bet_filter').find('.curr').parent().siblings('.title').text();
    var menu2 = $('#bet_filter').find('.curr').text();
    var times = $('.selectMultipInput').val();
    var selectRmb = $('.selectMultipleCon').val();
    var selectRmbStr = $('.selectMultipleCon').find('option:selected').text();
    var Numbers = '';
    var winningMoney = $('.play_select_prompt').find('span[way-data="tabDoc"] em').text();
    var winningMoneys = times * winningMoney * selectRmb;
    var bool = true;
    var trano= generateMixed(20);
    //console.log(_thisPlayid)
    var rate = yrates[_thisPlayid];

    if(zhushus.length >= 1){
      for(var i = 0; i < currNumber.length; i++){
        for(var j = 0; j < currNumber[i].length; j++){
            if(typeof currNumber[i] == 'string'){
              currNumber[i] = currNumber[i].split(' ')
            }
            if((currNumber[i].length - 1) != j){
              Numbers += currNumber[i][j] +　' ';
            }else{
              Numbers += currNumber[i][j]
            }
        }
        if((currNumber.length - 1) != i){
          Numbers = Numbers + ',';
        }
      }
      
      yBetting.each(function (i) {
        var gameNumber = $(this).find('.number em').text();
        var gameNumberType = $(this).find('.number .yBettingType').text();
        var _thisType = '['+menu0+','+menu1+','+menu2+']';
        var _thisRmb = $(this).find('.rmb').text();
        //console.log(gameNumberType == _thisType,gameNumberType, _thisType)
        if(gameNumber == Numbers && _thisRmb == selectRmbStr && gameNumberType == _thisType){
          bool = false;
          var _thisTimes =  parseInt($(this).find('.yBettingTimess').text()) + parseInt(times);
          winningMoneys = _thisTimes * winningMoney * selectRmb;
          winningMoneys = winningMoneys.toFixed(2);
          $(this).find('.yBettingTimess').text(_thisTimes);
          $(this).find('.maxMoneyNumber').text(winningMoneys+'元');
          $(this).find('#betting_money').text(zhushus.length * minMoney * _thisTimes *  selectRmb);
          orderList[i].beishu = _thisTimes;
          orderList[i].price = zhushus.length * minMoney * _thisTimes *  selectRmb;
        }
      })

      if(bool){
        var Numbersh = Numbers.replace(/,/g,'|');
            Numbersh = Numbersh.replace(/\s/g,',');
        var arr = {
          'trano': trano,
          'playtitle': rate.title,
          'playid': rate.playid,
          'number': Numbersh,
          'zhushu': zhushus.length,
          'price': lastMoney,
          'minxf': rate.minxf,
          'totalzs': rate.totalzs,
          'maxjj': rate.maxjj,
          'minjj': rate.minjj,
          'maxzs': rate.maxzs,
          'rate': lotteryRate==0?rate.maxjj:lotteryRate,
          'fandian':lotteryFandian,
          'beishu': parseInt(times),
          'yjf' : selectRmb
        }
        orderList.push(arr);
        
        var html = '<dd class="yBettingList" id="'+trano+'">'+
                      '<div class="numberBox yBettingDiv">'+
                        '<span class="number"><div class="yBettingType">['+menu0+','+menu1+','+menu2+']</div> <em>'+Numbers+'</em></span>'+
                        '<a href="javascript:void(0);" class="numberInfo">详细</a> '+
                      '</div>'+
                      '&nbsp;<div class="yBettingZhushu yBettingDiv">'+
                        '<em>'+zhushus.length+'</em>注'+
                      '</div>'+
                      '&nbsp;<div class="yBettingTimes yBettingDiv">'+
                        '<em class="yBettingTimess">'+times+'</em>倍'+
                      '</div>'+
                      '&nbsp;<div class="rmb yBettingDiv">'+
                        ''+selectRmbStr+''+
                      '</div>'+
                      '&nbsp;<div class="maxMoney yBettingDiv">'+
                        '可中金额'+
                        '<em class="maxMoneyNumber">'+winningMoneys.toFixed(2)+'元</em>'+
                      '</div>'+
                      '<div class="sc" style="float: right;padding-right: 5px;">'+
                        '<a href="javascript:void(0);">'+
                          '删除'+
                        '</a>'+
                      '</div>'+
                      '<div id="betting_money" style="display: none;">'+lastMoney+'</div>'+
                  '</dd>';
        $('.yBettingLists').append(html);        
      }
      //console.log(orderList);
      $('.g_Number_Section').find('a').removeClass('curr');
      $('#text').val('');
      currNumber = [];
      zhushus = [];
      countMoney();
      countAll();
     }else{
       alt('最少选择一注')
     }

  })
  
  
  //确认投注
  $(document).on("click", "#f_submit_order", function() {
    if(orderList.length<1){
      alt('请选择投注号码',-1);
      return false;
    }
    var Orderdetaillist = '';
    var Orderdetailtotalprice    = 0;
    for (var i = 0; i < orderList.length; i++) {
        var cur_order = orderList[i];
        var rate = yrates[cur_order.playid];
        var oprice = Number(cur_order.price);
        var cur_number = cur_order.number;
        Orderdetailtotalprice += oprice;
        Orderdetaillist +="<p>"+rate.title+':<span class="mark">'+cur_number+'</span>&nbsp;&nbsp;注数:<span class="mark">'+cur_order.zhushu+'</span>&nbsp;&nbsp;金额:<span class="mark">'+oprice.toFixed(2)+"</span></p>";
    }
    $("#Orderdetaillist").html(Orderdetaillist);
    $("#Orderdetailtotalprice").text(Orderdetailtotalprice.toFixed(2));
      console.log(orderList);
      artDialog({
        title:"投注详情<span style='margin-left:15px;'><img src='"+WebConfigs["ROOT"]+"/resources/images/icon/icon_09.png'>截至时间:<strong class='sty-h gametimes' style='font-weight:normal'>00:00:00</strong></span>",
        content:$("#submitComfirebox").html(),
        cancel:function(){},
        ok:function(){
          if(!user){
            alt('请先登陆',-1);
          }
          $.ajax({
            type : "POST",
            url  : apirooturl + 'cpbuy',
            data : {
              "orderList":orderList,
              'expect':lottery.currFullExpect,
              'lotteryname':lotteryname
            },
            beforeSend :  function () {
              $('.looding').show();
            },
            success : function (json) {
              if(json.sign){
                $("#orderlist_clear").click();
                alt('投注成功',1);
                getUserBetsListToday(lotteryname);
              }else{
                alt(json.message,-1);
              }
              $('.looding').hide();
            }
          })
        },
        lock:true
      });
});

  //玩法切换
  $(document).on('click','#j_play_select li',function () {
    var this_attr = $(this).attr('lottery_code');
    $(this).addClass('curr').siblings('li').removeClass('curr');
    $('.g_Number_Section').html('');
    switch(this_attr){
      case 'dwd':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),bjpks_dwd_title,bjpks_dwd_arr);
        _thisPlayid = 'bjpk10dwd';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从冠、亚、季、四、五、六、七、八、九、十任意位置上任意选择一个或一个以上号码，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_dwd,10,1);
        break;
      case 'cqsan':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),bjpks_cqsan_title,bjpks_cqsan_arr);
        _thisPlayid = 'bjpk10qian3';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从各名次中各选择1个不重复的号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_cqsan,10,1);
        break;
      case 'cqw':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),bjpks_cqw_title,bjpks_cqw_arr);
        _thisPlayid = 'bjpk10qian5';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从各名次中各选择1个不重复的号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_cqw,10,1);
        break;
      case 'cqs':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),bjpks_cqs_title,bjpks_cqs_arr);
        _thisPlayid = 'bjpk10qian4';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从各名次中各选择1个不重复的号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_cqs,10,1);
        break;
      case 'cqe':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),bjpks_cqe_title,bjpks_cqe_arr);
        _thisPlayid = 'bjpk10qian2';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从各名次中各选择1个不重复的号码组成一注，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_cqe,10,1);
        break;
      case 'cqgj':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),bjpks_cqgj_title,bjpks_cqgj_arr);
        _thisPlayid = 'bjpk10qian1';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('选择1个号码组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(bjpks_cqgj,10,1);
        break;
    }
  })

  //全，大，小，奇，偶，清
  $('.g_Number_Section').on('click','.selectNumberFilters a',function(){
    var _thisAttr = $(this).attr('data-param');
    switch(_thisAttr){
      case 'js-btn-all':
            $(this).parent().siblings('.selectNumbers').find('a').addClass('curr');
            break;
      case 'js-btn-big':
            $(this).parent().siblings('.selectNumbers').find('a').each(function (i){
              if(i<5){
                $(this).removeClass('curr');
              }else{
                $(this).addClass('curr');
              }
            })
            break;
      case 'js-btn-small':
            $(this).parent().siblings('.selectNumbers').find('a').each(function (i){
              if(i>=5){
                $(this).removeClass('curr');
              }else{
                $(this).addClass('curr');
              }
            })
            break;
      case 'js-btn-odd':
             $(this).parent().siblings('.selectNumbers').find('a').each(function (i){
               if(parseInt($(this).attr('data-number')) % 2 == 0){
                 $(this).removeClass('curr');
               }else{
                 $(this).addClass('curr');
               }
             });
            break;
      case 'js-btn-even':
            $(this).parent().siblings('.selectNumbers').find('a').each(function (i){
               if(parseInt($(this).attr('data-number')) % 2 != 0){
                 $(this).removeClass('curr');
               }else{
                 $(this).addClass('curr');
               }
             });
            break;
      case 'js-btn-clean':
            $(this).parent().siblings('.selectNumbers').find('a').removeClass('curr');
            break;
    }
    currNumber = currList();
    countFun();
    countMoney();
  });

  function util_unique (v, reg, digit, itemsort, baohao) {
	if(digit==undefined || digit==null) {
		digit = 1;
	}
	//v = v.replace(/ /g, ',');
	var sszz = new Array();
	var titems = {};
	var titem;
	while((titem = reg.exec(v)) != null) {
		var key = titem[0];
		if(itemsort) {
			if(digit == 1) {
				key = key.match(/./g).sort().join('');
			} else if(digit == 2) {
				key = key.match(/.{2}/g).sort().join(' ');
			} else {
				key = key.match(/./g).sort().join('');
			}
		} else {
			if(digit == 2) {
				key = key.match(/.{2}/g).join(' ');
			}
		}
		if(!titems[key]) {
			if(baohao) {
				// 去除豹子号如222，用户前三 中三 后三 任选三混合组选
				if(!(key.charAt(0) == key.charAt(1) && key.charAt(0) == key.charAt(2) && key.charAt(1) == key.charAt(2))) {
					titems[key] = 1;
					sszz.push(key);
				}
			} else {
				titems[key] = 1;
				sszz.push(key);
			}
		}
	}
	return sszz;
};
  function sortNumber(a,b){
    return a - b
  }
  //检测相同的数字
  function checkRepeat(str){
    var arr=str.split("");
    for(var i= 0,length=arr.length;i<length-1;i++){
      if(arr.slice(i+1).indexOf(arr[i])>=0){
        return true;
      }
    }
    return false;
  }

  function checkNumber(string,len,clickObj){
    var NumberArr = string.split(' ');
    var errArr = [];
    yesArr = [];
    var errString = '';
    var yesString = '';
    var itemcount = 0;

    for( var i = 0; i < NumberArr.length; i++){
      if(NumberArr[i].length > len || NumberArr[i].length < len){
        errArr.push(NumberArr[i]);
      }else{
        yesArr.push(NumberArr[i]);
      }
    }
    for(var j = 0; j < errArr.length; j++){
      errString += errArr[j] + ' ';
    }
    for(var k = 0; k < yesArr.length; k++){
      yesString += yesArr[k] + ' ';
    }

    if(_thisPlayid == 'bjpk10qian3ds'){
      var v=string;
      var reg=/(0[1-9]|1[01])(?!\1)(0[1-9]|1[01])(?!\1|\2)(0[1-9]|1[01])/g;
      
      v = v.replace(/[^\d]/g, '');
      var sszz=util_unique(v, reg, 2);
      sszz = sszz.sort();
      if(sszz){
        itemcount=sszz.length;
        yesArr = sszz;
      }
    }

    if(_thisPlayid == 'bjpk10qian5ds'){
      var v=string;
      var reg=/(0[1-9]|1[01])(?!\1)(0[1-9]|1[01])(?!\1|\2)(0[1-9]|1[01])(?!\1\2\3)(0[1-9]|1[01])(?!\1\2\3\4)(0[1-9]|1[01])/g;
      
      v = v.replace(/[^\d]/g, '');
      var sszz=util_unique(v, reg, 2);
      sszz = sszz.sort();
      if(sszz){
        itemcount=sszz.length;
        yesArr = sszz;
      }
    }

    if(_thisPlayid == 'bjpk10qian4ds'){
      var v=string;
      var reg=/(0[1-9]|1[01])(?!\1)(0[1-9]|1[01])(?!\1|\2)(0[1-9]|1[01])(?!\1\2\3)(0[1-9]|1[01])/g;
      
      v = v.replace(/[^\d]/g, '');
      var sszz=util_unique(v, reg, 2);
      sszz = sszz.sort();
      if(sszz){
        itemcount=sszz.length;
        yesArr = sszz;
      }
    }

    if(_thisPlayid == 'bjpk10qian2ds'){
      var v=string;
      var reg=/(0[1-9]|1[01])(?!\1)(0[1-9]|1[01])/g;
      
      v = v.replace(/[^\d]/g, '');
      var sszz=util_unique(v, reg, 2);
      sszz = sszz.sort();
      if(sszz){
        itemcount=sszz.length;
        yesArr = sszz;
      }
    }

    if(clickObj == 'remove'){
      if(string == ''){
        alt('请投注');
        return;
      }
      if(errArr.length < 1){
        alt('全部投注格式正确');
      }else{
        $('#text').val(yesString);
        alt('以下投注格式不正确： <br /> '+errString+'');
      }
    }

    if(clickObj == 'test'){
      if(string == ''){
        alt('请投注');
        return;
      }
      if(errArr.length < 1){
        alt('全部投注格式正确');
      }else{
        alt('以下投注格式不正确： <br /> '+errString+'');
      } 
    }

  }

  function danshiGame(){
    var html = '<div class="g_text">'+
                  '<textarea name="" value="123456" id="text" cols="30" rows="10" placeholder="每注号码以空格进行分割"></textarea>'+
                  '<button type="button" class="remove_btn">删除错误项</button>'+
                  '<button type="button" class="test_istrue">检查格式是否正确	</button>'+
                  '<button type="button" class="empty_text">清空文本框</button>'+
                '</div>';
    $('.g_Number_Section').append(html);
    var htmls='<div class="g_Number_Section_sliderbox sliderbox" style="">'+
            '<span class="buyNumberTitle">投注返点<i ></i></span>'+
            '<div class="progressTime">'+
              '<div class="peilu">'+
                '<p data-v-021cdaa0="" style="display: inline-block; color: rgb(153, 153, 153);">赔率</p>'+ 
                '<p style="display: inline-block;" id="amount">'+
               
                '</p>'+
              '</div>'+
              '<div class="upBottom">'+
                '<a id="minus"></a>'+
              '</div>'+
              '<div class="mains">'+
                '<div id="slider-range-min"></div>'+
              '</div>'+
              '<div class="dowmBottom">'+
                '<a id="plus"></a>'+
              '</div>'+
              '<div class="fandian">'+
                '<p style="display: inline-block; color: rgb(153, 153, 153);">返点</p> '+
                '<p style="display: inline-block;"><span class="fans">0</span>%</p>'+
              '</div>'+
            '</div>'+
          '</div>';
      
      alert(htmls);
      $('.g_Number_Section').prepend(htmls);
      silber(_thisPlayid);
  }
  
  //添加game号码区
  function gameNumber(arr,number,start){
    var box = $('.g_Number_Section');
    for(var i = 0;i<arr.length;i++){
      var filterHtml = '<div class="selectNumberFilters">'+
                          '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-all">全</a>'+
                          '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-big">大</a>'+
                          '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-small">小</a>'+
                          '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-odd">奇</a>'+
                          '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-even">偶</a>'+
                          '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-clean">清</a>'+
                        '</div>';
      var boxList = $('<div class="selectNmuverBox"></div>');
      var boxNumber = $('<div class="selectNumbers"></div>');
      boxList.append('<span class="numberTitle">'+arr[i]+'</span>');
      boxList.append(boxNumber);
      boxList.append(filterHtml);
      if(number && start){
        for(var j = start;j<=number;j++){
          if(j < 10){
            boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+j+'">0'+j+'</a>');
          }else{
            boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+j+'">'+j+'</a>');
          }
        }
      }else if(number){
        for(var j = 0;j<=number;j++){
          if(j < 10){
            boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="0'+j+'">0'+j+'</a>');
          }else{
            boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+j+'">'+j+'</a>');
          } 
        }
      }else{
        for(var j = 0;j<=9;j++){
          if(j < 10){
            boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="0'+j+'">0'+j+'</a>');
          }else{
            boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+j+'">'+j+'</a>');
          }
          
        }
      }
      
      box.append(boxList);
    }
    var htmls='<div class="g_Number_Section_sliderbox sliderbox" style="">'+
            '<span class="buyNumberTitle">投注返点<i ></i></span>'+
            '<div class="progressTime">'+
              '<div class="peilu">'+
                '<p data-v-021cdaa0="" style="display: inline-block; color: rgb(153, 153, 153);">赔率</p>'+ 
                '<p style="display: inline-block;" id="amount">'+
               
                '</p>'+
              '</div>'+
              '<div class="upBottom">'+
                '<a id="minus"></a>'+
              '</div>'+
              '<div class="mains">'+
                '<div id="slider-range-min"></div>'+
              '</div>'+
              '<div class="dowmBottom">'+
                '<a id="plus"></a>'+
              '</div>'+
              '<div class="fandian">'+
                '<p style="display: inline-block; color: rgb(153, 153, 153);">返点</p> '+
                '<p style="display: inline-block;"><span class="fans">0</span>%</p>'+
              '</div>'+
            '</div>'+
          '</div>';
      
      
      box.prepend(htmls);
      silber(_thisPlayid);
  }
  /*
    --特码赔率拖动
  */
  function silber(name){
    var fands=yrates[name].fandian*10;//parseFloat(yrates['tmzx'].fandian)/100;
    var dufrate=parseFloat(yrates[name].maxjj);
    var fandn=Math.round(dufrate)/100;
      var scale_amount = parseFloat(yrates[name].back_scale);
    $('#minus').on('click',function(){
      var i=$( "#slider-range-min" ).slider('value');
      if(i<1){
        return;
      }
      i--;
      $( "#slider-range-min" ).slider('value',i);
      setslide(i,dufrate,fandn,scale_amount);
    })
    $( "#slider-range-min" ).slider({
        range: "min",
        value: 0,
        min: 0,
        max: fands,
        slide: function( event, ui ) {
          setslide(ui.value,dufrate,fandn,scale_amount);
        }
      });
      $('#plus').on('click',function(){
        var i=$( "#slider-range-min" ).slider('value');
        if(i>=fands){
          return;
        }
        i++;
        $( "#slider-range-min" ).slider('value',i);
        setslide(i,dufrate,fandn,scale_amount);
      })
      $("#amount").text(yrates[name].maxjj);

    }

    function setslide(data,dufrate,fandn,scale_amount){
      var fans=data/10;
      var fandl=(data*scale_amount).toFixed(2);
      $('.fans').text((fans).toFixed(1));
      $( "#amount" ).text((dufrate-fandl).toFixed(2));
      $('.play_select_prompt').find('em').text((dufrate-fandl).toFixed(2));
      lotteryFandian=(fans).toFixed(1);
      lotteryRate=(dufrate-fandl).toFixed(2);
    }
  //添加二级玩法切换
  function gameSwitch(obj,title_arr,option_arrs){
    var ul = $('<ul></ul>');
    var span = '';
    var bool = true;
    ul.attr('id','bet_filter');
  
    for( var i = 0;i< title_arr.length;i++) {
      var li = $('<li></li>');
      var betOptionDiv = $('<div class="bet_option"></div>'); 
      li.attr('class','bet_filter_item');
      li.append('<strong class="title">'+title_arr[i]+'</strong>');
      for( j in option_arrs[i]){
        if(bool){
          span = '<span class="bet_options curr" lottery_code_two="'+j+'">'+option_arrs[i][j]+'</span>';
          bool = false;
        }else{
          span = '<span class="bet_options" lottery_code_two="'+j+'">'+option_arrs[i][j]+'</span>';
        }
        betOptionDiv.append(span);
      } 
      li.append(betOptionDiv);
      ul.append(li);
    }
    $('.bet_filter_item').eq(0).find('.bet_options').eq(0).addClass('curr');
    obj.append(ul);
  }
  

  //倍数加减fn
  function addAndSubtract(string){
    inputVal = isNaN(parseInt($('.selectMultipInput').val()))?1:parseInt($('.selectMultipInput').val());
    if(inputVal <= 1){
      $('.selectMultipInput').val(1);
      $('.reduce').addClass('noReduce');
    }
    if(inputVal > 10000){
      $('.selectMultipInput').val(10000);
      $('.reduce').removeClass('noReduce');
      $('.selectMultiple .add').addClass('noReduce');
      return;
    }
    if('+' == string){
      inputVal++;
      if(inputVal >= 10000){
        $('.selectMultipInput').val(10000);
        $('.selectMultiple .add').addClass('noReduce');
        return;
      }
      $('.selectMultiple .add').removeClass('noReduce');
      $('.selectMultipInput').val(inputVal);
    }else if('-' == string){
      inputVal--;
      if(inputVal <= 1){
        $('.selectMultipInput').val(1);
        $('.reduce').addClass('noReduce');
        return;
      }
      $('.reduce').removeClass('noReduce');
      $('.selectMultipInput').val(inputVal);
    }   
    if(inputVal > 1 && inputVal < 10000){
      $('.reduce').removeClass('noReduce');
    }
    if(inputVal < 10000){
      $('.selectMultiple .add').removeClass('noReduce');
    }
  }

  //生成随机订单号
  var chars = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
  function generateMixed(n) {
      var res = "";
      for(var i = 0; i < n ; i ++) {
          var id = Math.ceil(Math.random()*35);
          res += chars[id];
      }
      return res;
  }
  //计算方案注数
  function countAll(){
    var eachZhushus = 0;
    var eachMoneys = 0;

    $('.yBettingList').each(function (i){
      var eachZhushu = parseInt($(this).find('.yBettingZhushu em').text());
      var eachMoney = parseFloat($(this).find('#betting_money').text());
      eachZhushus += eachZhushu;
      eachMoneys += eachMoney;
    })

    AllZhushu = eachZhushus;
    AllMoney = eachMoneys;
    $('#f_gameOrder_lotterys_num').text(AllZhushu);
    $('#f_gameOrder_amount').text(AllMoney.toFixed(2));
  }

  //计算选号金额
  function countMoney() {
    var currZhushu = parseInt(zhushus.length);
    var currTimes = parseInt($('.selectMultipInput').val());
    var currSlect = parseFloat($('.selectMultipleCon').val());
    var toTal = currZhushu * minMoney * currTimes *  currSlect;
    lastMoney = toTal.toFixed(2);
    $('.zhushu').text(currZhushu);
    $('.selectMultipleOldMoney').text(lastMoney);
  }

  //组合排列
  function combination(arr){
    var sarr = [[]];
  
    for(var i = 0; i < arr.length; i++){
      var sta = [];
      for(var j = 0; j < sarr.length; j++){
        for(var k = 0; k < arr[i].length; k++){
          sta.push(sarr[j].concat(arr[i][k]));
        }
      }
      sarr = sta;
    }
    return sarr;
  }

  //组合算法
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

  //获取每个位数选中的数
  function currList() {
    var currArr = [];
    $('.selectNumbers').each(function (i){
      var acArr = [];
      $(this).find('.curr').each(function (i){
        acArr.push($(this).text());
      })
      currArr.push(acArr);
    })
    return currArr;
  }
  //验证数字空格
  function chkPrice(obj){ 
    obj.value = obj.value.replace(/[^\d.\s*]/g,""); 
    //必须保证第一位为数字而不是. 
    obj.value = obj.value.replace(/^\./g,""); 
    //保证只有出现一个.而没有多个. 
    obj.value = obj.value.replace(/\.{2,}/g,"."); 
    //保证.只出现一次，而不能出现两次以上 
    obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$","."); 
  } 
  //非法字符截取
  function chkLast(obj){  
    if(obj.value.substr((obj.value.length - 1), 1) == '.') 
    obj.value = obj.value.substr(0,(obj.value.length - 1)); 
  } 

})