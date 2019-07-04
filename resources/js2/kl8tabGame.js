$(function () {
  var inputVal = ''; //用户填写的倍数
  var zhushus = []; //注数数组;
  var currNumber = [] //存储每组位数的数组
  var minMoney = 2; //每注金额
  var lastMoney = 0.00;//计算出的金额
  var AllZhushu = 0;//方案注数
  var AllMoney = 0;//方案注数金额
  var danshiNumberL = 0;//单式号码长度
  var yesArr = [];//单式正确的数组
  var orderList= [];//投注数组
  var yindexs = 0;
  var lotteryRate=0;
  var lotteryFandian=0;
  var yrates = k3lotteryrates.rates;
   
  var _thisPlayid = '';
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
    _thisPlayid = 'bjkl8rx1';
    rates = yrates[_thisPlayid];
    gameSwitch($('.bet_filter_box'),kl8_rx_title,kl8_rx);
    $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从01-80中选择1个号码组成一注，当期开奖结果的20个号码中包含所选号码，即可中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
    gameNumber(kl8_bjkl8rx1,80,1);
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
        if($('.g_Number_Section').find('.curr').length > 7 && _thisPlayid != 'bjkl8rx1'){
          alt('对不起，当前玩法最多只能选择8个号码');
          return;
        }
        $(this).addClass('curr')
      }
    }
    currNumber = currList();
    countFun()
    countMoney();
  })

  function countFun(){
    switch(_thisPlayid){
      case 'bjkl8rx1': 
        zhushus.length = $('.g_Number_Section').find('.curr').length;
        break;
      case 'bjkl8rx2':
        zhushus = combine(pArrNumber(),2);
        break;
      case 'bjkl8rx3':
        zhushus = combine(pArrNumber(),3);
        break;
      case 'bjkl8rx4':
        zhushus = combine(pArrNumber(),4);
        break;
      case 'bjkl8rx5':
        zhushus = combine(pArrNumber(),5);
        break;
      case 'bjkl8rx6':
        zhushus = combine(pArrNumber(),6);
        break;
      case 'bjkl8rx7':
        zhushus = combine(pArrNumber(),7);
        break;
      case 'bjkl8sxp': case 'bjkl8dxds': case 'bjkl8jop':
        zhushus.length = $('.g_Number_Section').find('.curr').length;
        break;
    }
    //console.log(_thisPlayid,zhushus.length,currNumber);
  }

  function pArrNumber(){
    var Pnumber = [];
    for( var i = 0; i < currNumber.length; i++){
      Pnumber = Pnumber.concat(currNumber[i]);
    }
    return Pnumber;
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
      case 'bjkl8rx1':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从01-80中选择1个号码组成一注，当期开奖结果的20个号码中包含所选号码，即可中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(kl8_bjkl8rx1,80,1);
        break;
      case 'bjkl8rx2':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从01-80中选择2-8个号码，当期开奖结果的20个号码中包含所选号码中的两个，即可中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(kl8_bjkl8rx1,80,1);
        break;
      case 'bjkl8rx3':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从01-80中选择3-8个号码，当期开奖结果的20个号码中包含所选号码中的三个，即可中奖。 <span class="moneyInfo">奖金详情</span>');
        var caizhong3 = ['3','2'];
        addMoneyInfo(caizhong3,rates.maxjj);
        gameNumber(kl8_bjkl8rx1,80,1);
        break;
      case 'bjkl8rx4':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从01-80中选择4-8个号码，当期开奖结果的20个号码中包含所选号码中的四个，即可中奖。 <span class="moneyInfo">奖金详情</span>');
        var caizhong4 = ['4','3','2'];
        addMoneyInfo(caizhong4,rates.maxjj);
        gameNumber(kl8_bjkl8rx1,80,1);
        break;
      case 'bjkl8rx5':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从01-80中选择5-8个号码，当期开奖结果的20个号码中包含所选号码中的五个，即可中奖。 <span class="moneyInfo">奖金详情</span>');
        var caizhong5 = ['5','4','3'];
        addMoneyInfo(caizhong5,rates.maxjj);
        gameNumber(kl8_bjkl8rx1,80,1);
        break;
      case 'bjkl8rx6':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从01-80中选择6-8个号码，当期开奖结果的20个号码中包含所选号码中的六个，即可中奖。 <span class="moneyInfo">奖金详情</span>');
        var caizhong6 = ['6','5','4','3'];
        addMoneyInfo(caizhong6,rates.maxjj);
        gameNumber(kl8_bjkl8rx1,80,1);
        break;
      case 'bjkl8rx7':
        $('.play_select_prompt').find('span[wgameNumberay-data="tabDoc"]')
            .html('从01-80中选择7-8个号码，当期开奖结果的20个号码中包含所选号码中的七个，即可中奖。 <span class="moneyInfo">奖金详情</span>');
        var caizhong7 = ['7','6','5','4','3'];
        addMoneyInfo(caizhong7,rates.maxjj);
        gameNumber(kl8_bjkl8rx1,80,1);
        break;
      case 'bjkl8sxp':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('选择20个开奖号码中包含“上盘(01-40)”与“下盘(41-80)”号码个数多少关系。 <span class="moneyInfo">奖金详情</span>');
        var caizhongsx = ['中','上下'];
        addMoneyInfo(caizhongsx,rates.maxjj);
        gameNumberQw(kl8_bjkl8sxp);
        break;
      case 'bjkl8jop':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('选择20个开奖号码中包含“奇·偶”号码个数多少关系。  <span class="moneyInfo">奖金详情</span>');
        var caizhongqo = ['和','奇偶'];
        addMoneyInfo(caizhongqo,rates.maxjj);
        gameNumberQw(kl8_bjkl8jop);
        break;
      case 'bjkl8dxds':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('选择20个开奖号码总和值的“大小单双”属性组合(和值<=810为小,>810为大)，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumberQw(kl8_bjkl8dxds);
        break;
    }
  })
  
  function addMoneyInfo(text,money) {

    if($('.moneyInfoHover').length > 0 ){
      $('.moneyInfoHover').remove();
    }
    var html = '<div class="moneyInfoHover" >'+
                  '<table class="moneyInfoTable" >'+
                    '<tr>'+
                      '<th>猜中</th>'+
                      '<th>单注最高奖金</th>'+
                    '</tr>';
                
    var moneyList = money.split('|');
    for(var i in text){
      html += '<tr><th>'+text[i]+'</th><th>'+moneyList[i]+'</th></tr>';
    }
    html += '</table></div>';
    $('.moneyInfo').append(html);

  }
  
  function updateMaxJJ() {

    var beishusss = parseInt($('.selectMultipInput').val());
    var newnewmaxJJs = 0;
    var MaxJJ = '';
    MaxJJ = rates.maxjj;
    MaxJJ = MaxJJ.split('|');
    newmaxJJ = '';
    for(var j = 0; j < MaxJJ.length; j++){
      newnewmaxJJs = parseFloat(MaxJJ[j]).toFixed(2);
      if(j == MaxJJ.length - 1){
        newmaxJJ += newnewmaxJJs;
      }else{
        newmaxJJ += newnewmaxJJs + '|';
      }
    }
  }

  function gameNumberQw(arr){
    var box = $('.g_Number_Section');
    var boxList = $('<div class="kl8_qw selectNumbers"></div>');

    for(var j in arr){
      boxList.append('<a href="javascript:void(0);" class="selectNumber kl8_qw_number" data-number="'+j+'">'+arr[j]+'</a>');
    }
    box.append(boxList);
  }

  function xselectRmb(moneyStr,selectRmb) {
    var moneyListArr = moneyStr.split('|');
    var moneyListStr = '';
    for( var i = 0; i < moneyListArr.length; i++){
      if(i == moneyListArr.length - 1){
        moneyListStr += (moneyListArr[i] * selectRmb).toFixed(2);
      }else{
        moneyListStr += (moneyListArr[i] * selectRmb).toFixed(2) + '|';
      }
    }
    return moneyListStr;
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
        
        if(currNumber[i].length >= 1){
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
      }
      
      yBetting.each(function (i) {
        var gameNumber = $(this).find('.number em').text();
        if(_thisPlayid == 'bjkl8sxp'){
          gameNumber = gameNumber.replace(/上/g,'0');
          gameNumber = gameNumber.replace(/中/g,'1');
          gameNumber = gameNumber.replace(/下/g,'2');
        }else if(_thisPlayid == 'bjkl8jop'){
          gameNumber = gameNumber.replace(/奇/g,'0');
          gameNumber = gameNumber.replace(/和/g,'1');
          gameNumber = gameNumber.replace(/偶/g,'2');
        }else if(_thisPlayid == 'bjkl8dxds'){
          gameNumber = gameNumber.replace(/大单/g,'0');
          gameNumber = gameNumber.replace(/大双/g,'1');
          gameNumber = gameNumber.replace(/小单/g,'2');
          gameNumber = gameNumber.replace(/小双/g,'3');
        }
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
        // if(_thisPlayid == 'bjkl8rx3' || _thisPlayid == 'bjkl8rx4' || _thisPlayid == 'bjkl8rx5' || _thisPlayid == 'bjkl8rx6' || _thisPlayid == 'bjkl8rx7' || _thisPlayid == 'bjkl8sxp' || _thisPlayid == 'bjkl8jop'){
        //   updateMaxJJ()
        //   var arr = {
        //     'trano': trano,
        //     'playtitle': rate.title,
        //     'playid': rate.playid,
        //     'number': Numbersh,
        //     'zhushu': zhushus.length,
        //     'price': lastMoney,
        //     'minxf': rate.minxf,
        //     'totalzs': rate.totalzs,
        //     'maxjj': xselectRmb(newmaxJJ,selectRmb),
        //     'minjj': xselectRmb(rate.minjj,selectRmb),
        //     'maxzs': rate.maxzs,
        //     'rate': xselectRmb(newmaxJJ,selectRmb),
        //     'beishu': parseInt(times)
        //   }
          
        // }else{
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
        // }

        orderList.push(arr);
        if(_thisPlayid == 'bjkl8sxp'){
          Numbers = Numbers.replace(/0/g,'上');
          Numbers = Numbers.replace(/1/g,'中');
          Numbers = Numbers.replace(/2/g,'下');
        }else if(_thisPlayid == 'bjkl8jop'){
          Numbers = Numbers.replace(/0/g,'奇');
          Numbers = Numbers.replace(/1/g,'和');
          Numbers = Numbers.replace(/2/g,'偶');
        }else if(_thisPlayid == 'bjkl8dxds'){
          Numbers = Numbers.replace(/0/g,'大单');
          Numbers = Numbers.replace(/1/g,'大双');
          Numbers = Numbers.replace(/2/g,'小单');
          Numbers = Numbers.replace(/3/g,'小双');
        }
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
        if(_thisPlayid == 'bjkl8sxp'){
          cur_number = cur_number.replace(/0/g,'上');
          cur_number = cur_number.replace(/1/g,'中');
          cur_number = cur_number.replace(/2/g,'下');
        }else if(_thisPlayid == 'bjkl8jop'){
          cur_number = cur_number.replace(/0/g,'奇');
          cur_number = cur_number.replace(/1/g,'和');
          cur_number = cur_number.replace(/2/g,'偶');
        }else if(_thisPlayid == 'bjkl8dxds'){
          cur_number = cur_number.replace(/0/g,'大单');
          cur_number = cur_number.replace(/1/g,'大双');
          cur_number = cur_number.replace(/2/g,'小单');
          cur_number = cur_number.replace(/3/g,'小双');
        }else{
          cur_number = cur_order.number;
        }
        Orderdetailtotalprice += oprice;
        Orderdetaillist +="<p>"+rate.title+':<span class="mark">'+cur_number+'</span>&nbsp;&nbsp;注数:<span class="mark">'+cur_order.zhushu+'</span>&nbsp;&nbsp;金额:<span class="mark">'+oprice.toFixed(2)+"</span></p>";
    }
    $("#Orderdetaillist").html(Orderdetaillist);
    $("#Orderdetailtotalprice").text(Orderdetailtotalprice.toFixed(2));
      //console.log(orderList);
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
      case 'kl8_rx':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),kl8_rx_title,kl8_rx);
        _thisPlayid = 'bjkl8rx1';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从01-80中选择1个号码组成一注，当期开奖结果的20个号码中包含所选号码，即可中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(kl8_bjkl8rx1,80,1);
        break;
      case 'kl8_qw':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),kl8_qw_title,kl8_qw);
        _thisPlayid = 'bjkl8sxp';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('选择20个开奖号码中包含“上盘(01-40)”与“下盘(41-80)”号码个数多少关系。 <span class="moneyInfo">奖金详情</span>');
        var caizhongsx = ['中','上下'];
        addMoneyInfo(caizhongsx,rates.maxjj);
        gameNumberQw(kl8_bjkl8sxp);
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
               if(i % 2 == 0){
                 $(this).removeClass('curr');
               }else{
                 $(this).addClass('curr');
               }
             });
            break;
      case 'js-btn-even':
            $(this).parent().siblings('.selectNumbers').find('a').each(function (i){
               if(i % 2 != 0){
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

    if(_thisPlayid == 'cqsands'){
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

    if(_thisPlayid == 'cqwds'){
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

    if(_thisPlayid == 'cqsds'){
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

    if(_thisPlayid == 'cqeds'){
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
      var boxNumber = $('<div class="selectNumbers" style="max-width: 600px;"></div>');
      boxList.append('<span class="numberTitle">'+arr[i]+'</span>');
      boxList.append(boxNumber);
      // boxList.append(filterHtml);
      
      if(number && start){
        if(yindexs == 0){
          for(var j = start;j<=40;j++){
            if(j < 10){
              boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="0'+j+'">0'+j+'</a>');
            }else{
              boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+j+'">'+j+'</a>');
            }
          }
          yindexs++;
        }else{
          for(var j = start;j<=40;j++){
             boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+(j+40)+'">'+(j+40)+'</a>');
          }
          yindexs = 0;
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
      if(yrates[_thisPlayid].maxjj.indexOf('|')>-1){
        silbers(_thisPlayid);
      }else{
        silber(_thisPlayid);
      }
      

  }
  /*
    --特码赔率拖动
  */
  function silbers(name){
    var fands=yrates[name].fandian*10;
    lotteryRate=0;
    lotteryFandian=0;
    $('#minus').on('click',function(){
      var i=$( "#slider-range-min" ).slider('value');
      if(i<1){
        return;
      }
      i--;
      $( "#slider-range-min" ).slider('value',i);
      setslidedd(i,name);
    })
    $( "#slider-range-min" ).slider({
        range: "min",
        value: 0,
        min: 0,
        max: fands,
        slide: function( event, ui ) {
          setslidedd(ui.value,name);
        }
    });
    $('#plus').on('click',function(){
        var i=$( "#slider-range-min" ).slider('value');
        if(i>=fands){
          return;
        }
        i++;
        $( "#slider-range-min" ).slider('value',i);
          setslidedd(i,name);
    })
    $("#amount").text(yrates[name].maxjj);

  }
   function setslidedd(data,name){

        var arrs=yrates[name].maxjj.split('|');
        var newarrs=[];
        for (var i = 0; i <arrs.length; i++) {
          var dufrate=parseFloat(arrs[i]);
          var fandn=Math.round(dufrate)/100;
          var fans=data/10;
          var fandl=(fans*fandn).toFixed(2);
          var pl=(dufrate-fandl).toFixed(2);
          newarrs.push(pl);
        }
        $('.fans').text((fans).toFixed(1));
        $( "#amount" ).text(newarrs.join('|'));
        lotteryRate=newarrs.join('|');
        lotteryFandian=(fans).toFixed(1);
   }

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
        acArr.push($(this).attr('data-number'));
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