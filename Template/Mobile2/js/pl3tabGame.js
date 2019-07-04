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
  var yrates = k3lotteryrates.rates;

  function tabGameInit(){
    _thisPlayid = 'pl3zxfs';
    rates = yrates[_thisPlayid];
    gameSwitch($('.bet_filter_box'),fc3d_3x_title,fc3d_3x_arr);
    $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('每位至少选择一个号码，竞猜开奖号码的全部五位，号码和位置都对应即中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
    gameNumber(fc3d_3x_sxzhixfsq);
  }
  tabGameInit();
  

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
  

  $(document).on('click','.random5',function () {
    for( var aa = 0; aa < 5; aa++){
      randomTouzhu();
    }	
  })
  
  $(document).on('click','.random1',function () {
    for( var aa = 0; aa < 1; aa++){
      randomTouzhu();
    }	
	})

  function getRandom(arand) {
    var bool = true;
    var rand = Math.round(Math.random() * (9 - 1) + 1);
    if(arand instanceof Array){
      for(var i = 0; i < arand.length; i++){
        if(rand == parseInt(arand[i])) {
            bool = false;
          
            return getRandom(arand);
        }
      }
    }else{
      if (rand == parseInt(arand)) {
          bool = false;
          return getRandom(arand);
      }
    }
    
    
    if(bool){
      return rand;
    }
    
  }

  function zuxuan120(number) {
    var ceshi = $('.g_Number_Section').find('.selectNmuverBox');
    var randomsumber = 0;
    var arr = [];
    for( var a = 0; a < ceshi.length; a++){
      for( var aa = 0; aa < number; aa++){

        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        ceshi.eq(a).find('.selectNumbers .curr').each(function () {
          arr.push($(this).text());
        })

        randomsumber = getRandom(arr);
        ceshi.eq(a).find('.selectNumbers a').eq(randomsumber).addClass('curr');

      }
    }
  }

  function zuxuanDS(d){
    var ceshi = $('.g_Number_Section').find('.selectNmuverBox');
    var randomsumber = 0;
    var arr = [];
    randomsumber = Math.round(Math.random() * (9 - 1) + 1);
    ceshi.eq(0).find('.selectNumbers a').eq(randomsumber).addClass('curr');
    arr.push(randomsumber);
    for(var a = 0; a < d; a++){
      
      ceshi.eq(1).find('.selectNumbers .curr').each(function () {
        arr.push($(this).text());
      })
    
      randomsumber = getRandom(arr);
      ceshi.eq(1).find('.selectNumbers a').eq(randomsumber).addClass('curr');
    }
  }

  function zuxuanDSs(d){
    var ceshi = $('.g_Number_Section').find('.selectNmuverBox');
    var randomsumber = 0;
    var arr = [];
    randomsumber = Math.round(Math.random() * (9 - 1) + 1);
    ceshi.eq(1).find('.selectNumbers a').eq(randomsumber).addClass('curr');
    arr.push(randomsumber);
    for(var a = 0; a < d; a++){
      
      ceshi.eq(0).find('.selectNumbers .curr').each(function () {
        arr.push($(this).text());
      })
    
      randomsumber = getRandom(arr);
      ceshi.eq(0).find('.selectNumbers a').eq(randomsumber).addClass('curr');
    }
  }

   function unique(arr){
      var result = [];
      for(var i=0;i<arr.length;i++){
          if(result.indexOf(arr[i])==-1){
              result.push(arr[i])
          }
      }
      return result;
  }

  function randomTouzhu() {
    var ceshi = $('.g_Number_Section').find('.selectNmuverBox');
    var randomsumber = 0;
    ceshi.find('.selectNumber').removeClass('curr');
    $('#text').val('');

		if(_thisPlayid == 'wxzhixds'){
      var str = '';
      for( var a = 0; a < 5; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        str = randomsumber + str;
      }
      $('#text').val(str);
    }else if(_thisPlayid == 'sixzhixdsh'){
      var str = '';
      for( var a = 0; a < 4; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        str = randomsumber + str;
      }
      $('#text').val(str);
    }else if(_thisPlayid == 'pl3zxds' || _thisPlayid == 'sxzhixdsz'  || _thisPlayid == 'sxzhixdsh'     
        ){
      var str = '';
      for( var a = 0; a < 3; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        str = randomsumber + str;
      }
    
      $('#text').val(str);
    }else if(_thisPlayid == 'pl3qx2ds' ||  _thisPlayid == 'pl3hx2ds' ){
      var str = '';
      for( var a = 0; a < 2; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        str = randomsumber + str;
      }

      $('#text').val(str);
    }else if(_thisPlayid == 'wxzhixfs' || _thisPlayid == 'bdw5x1m' || _thisPlayid == 'qwyffs' ||
            _thisPlayid == 'qwhscs' || _thisPlayid == 'qwsxbx' || _thisPlayid == 'qwsjfc' ||
           _thisPlayid == 'sixzhixfsh' || _thisPlayid == 'bdw4x1m' || _thisPlayid == 'pl3zxfs' ||
          _thisPlayid == 'sxzhixfsz' || _thisPlayid == 'sxzhixfsh' || 
        _thisPlayid == 'pl3qx2fs' || _thisPlayid == 'pl3hx2fs' ||
      _thisPlayid == 'pl3q2zxhz' || _thisPlayid == 'pl3h2zxhz' ||
    _thisPlayid == 'pl3q2kd' || _thisPlayid == 'pl3h2kd'
    ){
      for( var a = 0; a < ceshi.length; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        ceshi.eq(a).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      }
    }else if(_thisPlayid == 'dxdsq2' || _thisPlayid == 'dxdsh2' || _thisPlayid == 'dxdsqs' || _thisPlayid == 'dxdshs'){
      for( var a = 0; a < ceshi.length; a++){
        randomsumber = Math.round(Math.random() * (3 - 1) + 1);
        ceshi.eq(a).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      }
    }else if(_thisPlayid == 'wxzxyel'){
      var arr = [];
      for( var a = 0; a < ceshi.length; a++){
        for( var aa = 0; aa < 5; aa++){

          randomsumber = Math.round(Math.random() * (9 - 1) + 1);
          ceshi.eq(a).find('.selectNumbers .curr').each(function () {
            arr.push($(this).text());
          })

          randomsumber = getRandom(arr);
          ceshi.eq(a).find('.selectNumbers a').eq(randomsumber).addClass('curr');

        }
      }
    }else if(_thisPlayid == 'wxzxls'){
      var arr = [];
      randomsumber = Math.round(Math.random() * (9 - 1) + 1);
      ceshi.eq(0).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      arr.push(randomsumber);
      for(var a = 0; a < 3; a++){
        
        ceshi.eq(1).find('.selectNumbers .curr').each(function () {
          arr.push($(this).text());
        })
     
        randomsumber = getRandom(arr);
        ceshi.eq(1).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      }
    }else if(_thisPlayid == 'wxzxsl'){
      var arr = [];
      randomsumber = Math.round(Math.random() * (9 - 1) + 1);
      ceshi.eq(1).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      arr.push(randomsumber);
      for(var a = 0; a < 2; a++){
        
        ceshi.eq(0).find('.selectNumbers .curr').each(function () {
          arr.push($(this).text());
        })
     
        randomsumber = getRandom(arr);
        ceshi.eq(0).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      }
    }else if(_thisPlayid == 'wxzxel'){
      var arr = [];
      randomsumber = Math.round(Math.random() * (9 - 1) + 1);
      ceshi.eq(0).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      arr.push(randomsumber);
      for(var a = 0; a < 2; a++){
        
        ceshi.eq(1).find('.selectNumbers .curr').each(function () {
          arr.push($(this).text());
        })
     
        randomsumber = getRandom(arr);
        ceshi.eq(1).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      }
    }else if(_thisPlayid == 'wxzxyl' || _thisPlayid == 'wxzxw'){
      var arr = [];
      randomsumber = Math.round(Math.random() * (9 - 1) + 1);
      ceshi.eq(0).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      arr.push(randomsumber);
      for(var a = 0; a < 1; a++){
        
        ceshi.eq(1).find('.selectNumbers .curr').each(function () {
          arr.push($(this).text());
        })
     
        randomsumber = getRandom(arr);
        ceshi.eq(1).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      }
    }else if(_thisPlayid == 'bdw5x2m'){
      var arr = [];
      for( var a = 0; a < ceshi.length; a++){
        for( var aa = 0; aa < 2; aa++){

          randomsumber = Math.round(Math.random() * (9 - 1) + 1);
          ceshi.eq(a).find('.selectNumbers .curr').each(function () {
            arr.push($(this).text());
          })

          randomsumber = getRandom(arr);
          ceshi.eq(a).find('.selectNumbers a').eq(randomsumber).addClass('curr');

        }
      }
    }else if(_thisPlayid == 'bdw5x3m'){
      var arr = [];
      for( var a = 0; a < ceshi.length; a++){
        for( var aa = 0; aa < 3; aa++){

          randomsumber = Math.round(Math.random() * (9 - 1) + 1);
          ceshi.eq(a).find('.selectNumbers .curr').each(function () {
            arr.push($(this).text());
          })

          randomsumber = getRandom(arr);
          ceshi.eq(a).find('.selectNumbers a').eq(randomsumber).addClass('curr');

        }
      }
    }else if(_thisPlayid == 'hsizxes') {
      zuxuan120(4);
    }else if(_thisPlayid == 'hsizxye'){
      zuxuanDS(2);
    }else if(_thisPlayid == 'hsizxl'){
      zuxuan120(2);
    }else if(_thisPlayid == 'hsizxs'){
      zuxuanDS(1);
    }else if(_thisPlayid == 'bdw4x2m' || 
            _thisPlayid == 'pl3zux3' || _thisPlayid == 'sxzuxzsz' || _thisPlayid == 'sxzuxzsh' ||
           _thisPlayid == 'pl3rmbdw' || _thisPlayid == 'bdwzs2m' || _thisPlayid == 'bdwhs2m' ||
          _thisPlayid == 'pl3q2zxfs' || _thisPlayid == 'pl3h2zxfs'){
      zuxuan120(2);
    }else if(_thisPlayid == 'pl3zux6' || _thisPlayid == 'sxzuxzlz' || _thisPlayid == 'sxzuxzlh'){
      zuxuan120(3);
    }else if(_thisPlayid == 'pl3hzzx' || _thisPlayid == 'zhixhzzs' || 
            _thisPlayid == 'zhixhzhs' || _thisPlayid == 'pl3kd' ||
             _thisPlayid == 'kuaduzs' || _thisPlayid == 'kuaduhs' ||
             _thisPlayid == 'pl3zuxhz' || _thisPlayid == 'zuxhzzs' || _thisPlayid == 'zuxhzhs' ||
              _thisPlayid == 'pl3zuxbd' ||  _thisPlayid == 'zuxzsbd' ||  _thisPlayid == 'zuxhsbd' ||
            _thisPlayid == 'pl3ymbdw' ||  _thisPlayid == 'bdwzs' ||  _thisPlayid == 'bdwhs' || 
          _thisPlayid == 'pl3q2zuxhz' ||  _thisPlayid == 'pl3h2zuxhz' ||
          _thisPlayid == 'pl3q2zxbd' ||  _thisPlayid == 'pl3h2zxbd'){
      zuxuan120(1);
    }else if(_thisPlayid == 'pl3zsds' ||  _thisPlayid == 'zszsds' ||  _thisPlayid == 'hszsds'
            ){
      var str = '';
      for( var a = 0; a < 2; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        if(randomsumber == parseInt(str)){
          var randomstr = getRandom(randomsumber);
          str = randomstr + str;
        }else{
          str = randomsumber + str;
        }
        
      }
      str = randomsumber + str;
     
      $('#text').val(str);
    }else if(_thisPlayid == 'pl3zlds' ||  _thisPlayid == 'zszlds' ||  _thisPlayid == 'hszlds' || 
    _thisPlayid == 'pl3zuxhh' || _thisPlayid == 'sxhhzxz' || _thisPlayid == 'sxhhzxh'){
      var str = '';
      var arr = [];
      for( var a = 0; a < 3; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        str = randomsumber + str;
      }
      arr = str.split('');
      arr = unique(arr);
      
      if(arr.length == 2){
        randomsumber = getRandom(arr);
        arr.push(randomsumber);
        str = arr.join('');
      }else if(arr.length == 1){
        randomsumber = getRandom(arr);
        arr.push(randomsumber);
        randomsumber = getRandom(arr);
        arr.push(randomsumber);
        str = arr.join('');
      }

      $('#text').val(str);
    }else if(_thisPlayid == 'pl3q2zxds' ||  _thisPlayid == 'pl3h2zxds'){
      var str = '';
      for( var a = 0; a < 2; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        if(randomsumber == parseInt(str)){
          var randomstr = getRandom(randomsumber);
          str = randomstr + str;
        }else{
          str = randomsumber + str;
        }
      }
     
      $('#text').val(str);
    }else if(_thisPlayid == 'pl3dwdfs'){
      
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        var randomsumber2 = Math.round(Math.random() * (2 - 1) + 1);
        ceshi.eq(randomsumber2).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      
    }
    
    $('#orderlist_clear').show();
    if($('#text').length > 0){
      var textobj = document.getElementById('text');
      chkPrice(textobj);
      chkLast(textobj);
      var text = $('#text').val();
      checkNumber(text,danshiNumberL);
      yesArr = unique1(yesArr);
      currNumber = yesArr;
      zhushus = yesArr;
      countMoney();
      if(zhushus.length > 0){
        $('#selectMultipleTId').show();
        $('#addIconId').show();
        $('#selectMultipleB_nId').show();
        $('.addtobetbtn').css('background','#dc3b40');
        $('#selectMultipleLz_show').addClass('selectMultipleLzAdd');
        var Numbers = '';
        for(var i = 0; i < currNumber.length; i++){
          for(var j = 0; j < currNumber[i].length; j++){
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
        $('#selectMultipleB_nId').text(Numbers);
      }else{
        $('.zhushu').text(0);
        $('.selectMultipleOldMoney').text(0.00);
        $('#selectMultipleTId').hide();
        $('#addIconId').hide();
        $('#selectMultipleB_nId').hide();
        $('.addtobetbtn').css('background','#252625');
        $('#selectMultipleLz_show').removeClass('selectMultipleLzAdd');
      }
    }else{
      
      currNumber = currList();
      countFun()
      countMoney();
      if(zhushus.length > 0){
        $('#selectMultipleTId').show();
        $('#addIconId').show();
        $('#selectMultipleB_nId').show();
        $('.addtobetbtn').css('background','#dc3b40');
        $('#selectMultipleLz_show').addClass('selectMultipleLzAdd');
        var Numbers = '';
        for(var i = 0; i < currNumber.length; i++){
          for(var j = 0; j < currNumber[i].length; j++){
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
        $('#selectMultipleB_nId').text(Numbers);
      }else{
        $('#selectMultipleTId').hide();
        $('#addIconId').hide();
        $('#selectMultipleB_nId').hide();
        $('.addtobetbtn').css('background','#252625');
        $('#selectMultipleLz_show').removeClass('selectMultipleLzAdd');
      }
    }
    $('.addtobetbtn').click();
  }

  //号码点击
  $('.g_Number_Section').on('click','.selectNumbers a',function (){
    if(_thisPlayid == 'fc3d_3x_zuxcsbd' || _thisPlayid == 'zuxzsbd' || _thisPlayid == 'pl3zuxbd' ||  _thisPlayid == 'pl3q2zxbd' || _thisPlayid == 'pl3h2zxbd'){
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
    console.log(zhushus,currNumber)
    if(zhushus.length > 0){
      $('#selectMultipleTId').show();
      $('#addIconId').show();
      $('#selectMultipleB_nId').show();
      $('.addtobetbtn').css('background','#dc3b40');
      $('#selectMultipleLz_show').addClass('selectMultipleLzAdd');
      var Numbers = '';
      for(var i = 0; i < currNumber.length; i++){
        for(var j = 0; j < currNumber[i].length; j++){
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
      $('#selectMultipleB_nId').text(Numbers);
    }else{
      $('#selectMultipleTId').hide();
      $('#addIconId').hide();
      $('#selectMultipleB_nId').hide();
      $('.addtobetbtn').css('background','#252625');
      $('#selectMultipleLz_show').removeClass('selectMultipleLzAdd');
    }
  })

  function countFun(){
    switch(_thisPlayid){
      case 'pl3zxfs':
        zhushus = combination(currNumber);
        break;
      case 'pl3hzzx':
        zhushus.length = qszxhzCombine();
        break;
      case 'pl3kd':
        zhushus.length = qskdCombine();
        break;
      case 'pl3zuxhz':
        zhushus.length = qszuxhzCombine();
        break;
      case 'pl3zux3':
        zhushus.length = currNumber[0].length * (currNumber[0].length - 1);
        break;
      case 'pl3zux6':
        zhushus = combine(currNumber[0],3);
        break;
      case 'pl3zuxbd':
        zhushus.length = 54;
        break;
      case 'pl3ymbdw':
        zhushus.length = currNumber[0].length;
        break;
      case 'pl3rmbdw':
        zhushus = combine(currNumber[0],2);
        break;
      case 'pl3qx2fs': case 'pl3hx2fs':
        zhushus = combination(currNumber);
        break;
      case 'pl3q2zxhz': case 'pl3h2zxhz':
        zhushus.length = hezxhz();
        break;
      case 'pl3q2kd': case 'pl3h2kd':
        zhushus.length = exkuadu();
        break;
      case 'pl3q2zxfs': case 'pl3h2zxfs':
        zhushus = combine(currNumber[0],2);
        break;
      case 'pl3q2zuxhz': case 'pl3h2zuxhz':
        zhushus.length = exzuxhz();
        break;
      case 'pl3q2zxbd': case 'pl3h2zxbd':
        zhushus.length = 9;
        break;
      case 'pl3dwdfs':
        zhushus.length = $('.g_Number_Section').find('.curr').length;
        break;
      case 'dxdsh2': case 'dxdsq2': case 'dxdsqs': case 'dxdshs':
        zhushus = combination(currNumber);
        break;
    }
    //console.log(_thisPlayid,zhushus.length,currNumber);
  }

  var d_balls = [];
  var t_balls = [];
  var d_count = 0;
  var t_count = 0;
  function combineArrUpdata(){
    d_balls = [];
    t_balls = [];
    d_count = 0;
    t_count = 0;
    for(var i = 0; i < currNumber.length; i++){
      for(var j = 0; j < currNumber[i].length; j++){
        if(i == 0){
          d_balls[currNumber[i][j]] = currNumber[i][j]
        }else{
          t_balls[currNumber[i][j]] = currNumber[i][j]
        }
      }
      if(i == 0){
        d_count = currNumber[i].length;
      }else{
        t_count = currNumber[i].length;
      }
    }
  }

  var arrexzuxhz = [0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 4, 4, 3, 3, 2, 2, 1, 1];
  function exzuxhz() {
    var itemcount = 0;
    var vballs = [];
    for(var i = 0; i < currNumber.length; i++){
      for(var k = 0; k < currNumber[i].length; k++){
          vballs[currNumber[i][k]] = currNumber[i][k]
      }
    }
    for (j = 0; j < vballs.length; j++) {
      if (vballs[j] != "" && !isNaN(vballs[j])) {
        itemcount += arrexzuxhz[parseInt(vballs[j])];
      }
    }
    return itemcount;
  }

  var arrkuaduex = [10, 18, 16, 14, 12, 10, 8, 6, 4, 2];
  function exkuadu() {
    var itemcount = 0;
    var vballs = [];
    for(var i = 0; i < currNumber.length; i++){
      for(var k = 0; k < currNumber[i].length; k++){
          vballs[currNumber[i][k]] = currNumber[i][k]
      }
    }
    for (j = 0; j < vballs.length; j++) {
      if (vballs[j] != "" && !isNaN(vballs[j])) {
        itemcount += arrkuaduex[parseInt(vballs[j])];
      }
    }
    return itemcount;
  }

  var arrzxhzex = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
  function hezxhz(){
    var itemcount = 0;
    var vballs = [];
    for(var i = 0; i < currNumber.length; i++){
      for(var k = 0; k < currNumber[i].length; k++){
          vballs[currNumber[i][k]] = currNumber[i][k]
      }
    }
    for (j = 0; j < vballs.length; j++) {
      if (vballs[j] != "" && !isNaN(vballs[j])) {
        itemcount += arrzxhzex[parseInt(vballs[j])];
      }
    }

    return itemcount;
  }  

  var arrzuxhz = [1, 2, 2, 4, 5, 6, 8, 10, 11, 13, 14, 14, 15, 15, 14, 14, 13, 11, 10, 8, 6, 5, 4, 2, 2, 1];
  function qszuxhzCombine(){
    var itemcount = 0;
    var vballs = [];
    var string = [];
    for(var i = 0; i < currNumber.length; i++){
      for(var k = 0; k < currNumber[i].length; k++){
          vballs[currNumber[i][k]] = currNumber[i][k];
      }
    }
    for (j = 0; j < vballs.length; j++) {
      if (vballs[j] != "" && !isNaN(vballs[j])) {
        
        itemcount += parseInt(arrzuxhz[parseInt(vballs[j]) - 1]);
      }
    }
    return itemcount;
  }

  var arrkuadusx = [10, 54, 96, 126, 144, 150, 144, 126, 96, 54];
  function qskdCombine(){
    var itemcount = 0;
    var vballs = [];
    for(var i = 0; i < currNumber.length; i++){
      for(var k = 0; k < currNumber[i].length; k++){
          vballs[currNumber[i][k]] = currNumber[i][k]
      }
    }
    for (j = 0; j < vballs.length; j++) {
      if (vballs[j] != "" && !isNaN(vballs[j])) {
        itemcount += arrkuadusx[parseInt(vballs[j])];
      }
    }

    return itemcount;
  }

  var arrzxhz = [1, 3, 6, 10, 15, 21, 28, 36, 45, 55, 63, 69, 73, 75, 75, 73, 69, 63, 55, 45, 36, 28, 21, 15, 10, 6, 3, 1];
  function qszxhzCombine(){
    var itemcount = 0;
    var vballs = [];
    for(var i = 0; i < currNumber.length; i++){
      for(var k = 0; k < currNumber[i].length; k++){
          vballs[currNumber[i][k]] = currNumber[i][k]
      }
    }
    for (var j = 0; j < vballs.length; j++) {
      if (vballs[j] != "" && !isNaN(vballs[j])) {
        itemcount += arrzxhz[parseInt(vballs[j])];
      }
    }

    return itemcount;
  }

  function sxCombine4(){
    combineArrUpdata();
    var itemcount = 0;
    if(d_count > 0 && t_count > 0) {
      for(var i = 0; i < d_balls.length; i++) {
        if(d_balls[i] != undefined && d_balls[i] != "") {
          if(t_balls[i] != undefined && t_balls[i] != "") {
            if(t_count > 1) {
              itemcount += t_count-1;
            }
          } else {
            itemcount += t_count;
          }
        }
      }
    }
    return itemcount;
  }

  function sxCombine12(){
    combineArrUpdata();
    var itemcount = 0;	
    if(d_count > 0 && t_count > 1) {
      for(var i = 0; i < d_balls.length; i++) {
        if(d_balls[i] != undefined && d_balls[i] != "") {
          if(t_balls[i] != undefined && t_balls[i] != "") {
            if(t_count > 2) {
              itemcount += (t_count-1)*(t_count-2)/2;
            }
          } else {
            itemcount += t_count*(t_count-1)/2;
          }
        }
      }
    }
    return itemcount;
  }

  function combine5(){
    combineArrUpdata();
    var itemcount = 0;
    if(d_count > 0 && t_count > 0) {
      for(var i = 0; i < d_balls.length; i++) {
        if(d_balls[i] != undefined && d_balls[i] != "") {
          if(t_balls[i] != undefined && t_balls[i] != "") {
            if(t_count > 1) {
              itemcount += t_count-1;
            }
          } else {
            itemcount += t_count;
          }
        }
      }
    }
    return itemcount;
  }

  function combine10(){
    combineArrUpdata();
    var itemcount = 0;	
    if(d_count > 0 && t_count > 0) {
      for(var i = 0; i < d_balls.length; i++) {
        if(d_balls[i] != undefined && d_balls[i] != "") {
          if(t_balls[i] != undefined && t_balls[i] != "") {
            if(t_count > 1) {
              itemcount += t_count-1;
            }
          } else {
            itemcount += t_count;
          }
        }
      }
    }
    return itemcount;
  }

  function combine20(){
    combineArrUpdata();
    var itemcount = 0;
    if(d_count > 0 && t_count > 1) {
      for(var i = 0; i < d_balls.length; i++) {
        if(d_balls[i] != undefined && d_balls[i] != "") {
          if(t_balls[i] != undefined && t_balls[i] != "") {
            if(t_count > 2) {
              itemcount += (t_count-1)*(t_count-2)/2;
            }
          } else {
            itemcount += t_count*(t_count-1)/2;
          }
        }
      }
    }
    return itemcount;
  }

  function combine30(){
    combineArrUpdata();
    var itemcount = 0;
    if(d_count > 1 && t_count > 0 ) {
      for(var i = 0; i < t_balls.length; i++) {
        if(t_balls[i] != undefined && t_balls[i] != "") {
          if(d_balls[i] != undefined && d_balls[i] != "") {
            if(d_count > 2) {
              itemcount += (d_count-1)*(d_count-2)/2;
            }
          } else {
            itemcount += d_count*(d_count-1)/2;
          }
        }
      }
    }
    return itemcount;
  }

  function combine60(){
    combineArrUpdata();
    var recount = 0; //重复数
    if (d_balls && d_balls.length > 0 && t_balls && t_balls.length > 0) {
      for (i = 0; i < d_balls.length; i++) {
        for (j = 0; j < t_balls.length; j++){
          if (t_balls[j] && t_balls[j] == d_balls[i]) {
            recount++;
          }
        }
      }
    } 

    var itemcount = 0;
    if( t_count>=3 && d_count>=1) {
      for(d_count; d_count>0; d_count--) {
        if(recount>0) {
          var diffcount = t_count-4;
          var topcount = t_count-1;
          var subcount =  t_count-4;
          if(diffcount > 0) {
            var temp = t_count-1;
            while( diffcount>1 ) {
              diffcount--;
              temp--;
              topcount =  topcount * temp;
              subcount = subcount * diffcount;
            }
            itemcount += (topcount/subcount);
          }else if(diffcount < 0) {
            
          }else {
            itemcount += 1;
          }
          recount--;
        }else {
          var diffcount = t_count-3;
          var topcount = t_count;
          var subcount =  t_count-3;
          if(diffcount > 0) {
            var temp = t_count;
            while( diffcount>1 ) {
              diffcount--;
              temp--;
              topcount =  topcount * temp;
              subcount = subcount * diffcount;
            }
            itemcount += (topcount/subcount);
          }else {
            itemcount += 1;
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
    $('#lanIconNumbere').text($('.yBettingLists').find('.yBettingList').length)
    if($('.yBettingLists').find('.yBettingList').length <= 0){
      $('#orderlist_clear').hide();
      $('#lanIconNumbere').css('display','none');
    }
    console.log(orderList);
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
    $('#lanIconNumbere').text('0').css('display','none');
    $('#orderlist_clear').hide();
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
    if(zhushus.length > 0){
      $('#selectMultipleTId').show();
      $('#addIconId').show();
      $('#selectMultipleB_nId').show();
      $('.addtobetbtn').css('background','#dc3b40');
      $('#selectMultipleLz_show').addClass('selectMultipleLzAdd');
      var Numbers = '';
      for(var i = 0; i < currNumber.length; i++){
        for(var j = 0; j < currNumber[i].length; j++){
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
      $('#selectMultipleB_nId').text(Numbers);
    }else{
      $('.zhushu').text(0);
      $('.selectMultipleOldMoney').text(0.00);
      $('#selectMultipleTId').hide();
      $('#addIconId').hide();
      $('#selectMultipleB_nId').hide();
      $('.addtobetbtn').css('background','#252625');
      $('#selectMultipleLz_show').removeClass('selectMultipleLzAdd');
    }
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
    $('.zhushu').text(0);
    $('.selectMultipleOldMoney').text(0.00);
    $('#selectMultipleTId').hide();
    $('#addIconId').hide();
    $('#selectMultipleB_nId').hide();
    $('.addtobetbtn').css('background','#252625');
    $('#selectMultipleLz_show').removeClass('selectMultipleLzAdd');
  })

  //玩法内容切换
  $('.bet_filter_box').on('click','.bet_options',function (){
    $('.zhushu').text(0);
    $('.selectMultipleOldMoney').text(0.00);
    $('#selectMultipleTId').hide();
    $('#addIconId').hide();
    $('#selectMultipleB_nId').hide();
    $('.addtobetbtn').css('background','#252625');
    $('#selectMultipleLz_show').removeClass('selectMultipleLzAdd');
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
      case 'pl3zxfs':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('每位至少选择一个号码，竞猜开奖号码，号码和位置都对应即中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
          gameNumber(fc3d_3x_sxzhixfsq);
        break;
      case 'pl3zxds':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('每位至少选择一个号码，竞猜开奖号码，号码和位置都对应即中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        danshiNumberL = 3;
        danshiGame();
        break;
      case 'pl3hzzx':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('至少选择一个和值，竞猜开奖号码数字之和，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(fc3d_3x_zhixhzqs,27);
        break;
      case 'pl3kd':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('所选数值等于开奖号码的最大与最小数字相减之差，即为中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(q3_kuaduqs);
        break;
      case 'pl3zuxhz':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('至少选择一个和值，竞猜开奖号码后三位数字之和(不含豹子号)，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(fc3d_3x_zhixhzqs,26,1);
        break;
      case 'pl3zux3':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中选择2个数字组成两注，所选号码与开奖号码相同，且顺序不限，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(fc3d_3x_sxzuxzsq);
        break;
      case 'pl3zux6':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中任意选择3个号码组成一注，所选号码与开奖号码相同，顺序不限，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(fc3d_3x_sxzuxzlq);
        break;
      case 'pl3zuxhh':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('手动输入号码，3个数字为一注，所选号码与开奖号码相同，顺序不限，即为中奖，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        danshiNumberL = 3;
        danshiGame();
        break;
      case 'pl3zuxbd':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中任意选择1个包胆号码，开奖号码的后三位中任意1位与所选包胆号码相同(不含豹子号)，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumberZxbd(fc3d_3x_zuxcsbd);
        break;
      case 'pl3zsds':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('手动输入号码，3个数字为一注，所选号码与开奖号码相同，顺序不限，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        danshiNumberL = 3;
        danshiGame();
        break;
      case 'pl3zlds':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('手动输入号码，3个数字为一注，所选号码与开奖号码相同，顺序不限，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        danshiNumberL = 3;
        danshiGame();
        break;
      case 'pl3ymbdw':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中至少选择1个号码投注，竞猜开奖号码中包含这个号码，包含即中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(q3_bdw);
        break;
      case 'pl3rmbdw':
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中至少选择2个号码投注，竞猜开奖号码中包含这2个号码，包含即中奖，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(q3_bdw);
        break;
      case 'pl3qx2fs': case 'pl3hx2fs':
        if(_thisType == 'pl3qx2fs'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('每位至少选择一个号码，竞猜开奖号码的前二位，号码和位置都对应即中奖，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
          gameNumber(q2_exzhixfs);
        }else if(_thisType == 'pl3hx2fs'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('每位至少选择一个号码，竞猜开奖号码的后二位，号码和位置都对应即中奖，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
          gameNumber(h2_exzhixfs);
        }
        break;
      case 'pl3qx2ds': case 'pl3hx2ds':
        if(_thisType == 'pl3qx2ds'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('每位至少选择一个号码，竞猜开奖号码的前二位，号码和位置都对应即中奖，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        }else if(_thisType == 'pl3hx2ds'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('每位至少选择一个号码，竞猜开奖号码的后二位，号码和位置都对应即中奖，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        }
        danshiNumberL = 2;
        danshiGame();
        break;
      case 'pl3q2zxhz': case 'pl3h2zxhz':
        if(_thisType == 'pl3q2zxhz'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('至少选择一个和值，竞猜开奖号码前二位数字之和，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        }else if(_thisType == 'pl3h2zxhz'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('至少选择一个和值，竞猜开奖号码后二位数字之和，奖金  <em style="color:red;">'+rates.maxjj+'</em>元'); 
        }
        gameNumber(ex_exzhixdsh,18);
        break;
      case 'pl3q2kd': case 'pl3h2kd':
        if(_thisType == 'pl3q2kd'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('所选数值等于开奖号码的前二位最大与最小数字相减之差，即为中奖，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        }else if(_thisType == 'pl3h2kd'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('所选数值等于开奖号码的后二位最大与最小数字相减之差，即为中奖，奖金  <em style="color:red;">'+rates.maxjj+'</em>元'); 
        }
        gameNumber(ex_kuaduhe);
        break;
      case 'pl3q2zxfs': case 'pl3h2zxfs':
        if(_thisType == 'pl3q2zxfs'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中选择2个数字组成一注，所选号码与开奖号码的前二位相同，顺序不限（不含对子），奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        }else if(_thisType == 'pl3h2zxfs'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中选择2个数字组成一注，所选号码与开奖号码的后二位相同，顺序不限（不含对子），奖金  <em style="color:red;">'+rates.maxjj+'</em>元'); 
        }
        gameNumber(ex_exzuxfsh);
        break;
      case 'pl3q2zxds': case 'pl3h2zxds':
        if(_thisType == 'pl3q2zxds'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中选择2个数字组成一注，所选号码与开奖号码的前二位相同，顺序不限（不含对子），奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        }else if(_thisType == 'pl3h2zxds'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中选择2个数字组成一注，所选号码与开奖号码的后二位相同，顺序不限（不含对子），奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        }
        danshiNumberL = 2;
        danshiGame();
        break;
      case 'pl3q2zuxhz': case 'pl3h2zuxhz':
        if(_thisType == 'pl3q2zuxhz'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('所选数值等于开奖号码的前二位数字相加之和（不含对子），奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        }else if(_thisType == 'pl3h2zuxhz'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('所选数值等于开奖号码的后二位数字相加之和（不含对子），奖金  <em style="color:red;">'+rates.maxjj+'</em>元'); 
        }
        gameNumber(ex_zsxhz,17,1);
        break;
      case 'pl3q2zxbd': case 'pl3h2zxbd':
        if(_thisType == 'pl3q2zxbd'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中任意选择1个号码，开奖号码的前二位中任意1位包含所选的包胆号码相同，奖金   <em style="color:red;">'+rates.maxjj+'</em>元');
        }else if(_thisType == 'pl3h2zxbd'){
          $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从0-9中任意选择1个号码，开奖号码的后二位中任意1位包含所选的包胆号码相同，奖金   <em style="color:red;">'+rates.maxjj+'</em>元'); 
        }
        gameNumberZxbd(ex_zsxbd);
        break;
      case 'pl3dwdfs':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从百位、十位、个位任意位置上至少选择1个号码，选号与相同位置上的开奖号码一致，奖金   <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(fc3d_1x_fs);
        break;
      case 'dxdsq2':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从百位、十位中的“大、小、单、双”中至少各选一个组成一注，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumberZxbd(fc3d_dxds_qe,'dxds');
        break;
      case 'dxdsh2':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
            .html('从十位、个位中的“大、小、单、双”中至少各选一个组成一注，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumberZxbd(fc3d_dxds_he,'dxds');
        break;
    }
    var menu0 = $('.play_select_tit').find('.curr').text();
    var menu2 = $('#bet_filter').find('.curr').text();
    $('.gameType').find('string').text(menu0+menu2);
    $('.bet_filter_box').hide();
    $('.play_select_insert').hide();
    $('.ymask').hide();
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
        var boxNumber = $('<div class="selectNumbers"></div>');
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

  function addNumberLanAn(){
    $('.lanIconNumber').show();
    $('#lanIconNumberss').animate({'left':'303','top': '-50px'},500,function (){
      $(this).animate({'top': '10px','opacity': '0'},500,function (){
        $(this).css('display','none');
        $('#selectMultipleTId').hide();
        $('#addIconId').hide();
        $('#selectMultipleB_nId').hide();
        $('.addtobetbtn').css('background','#252625');
        $('#selectMultipleLz_show').removeClass('selectMultipleLzAdd');
        $(this).css({'left':'28px','top': '10px','opacity': '100'})
      })
    })
    $('#lanIconNumbere').text(parseInt($('#lanIconNumbere').text()) + 1);
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
    var rate = yrates[_thisPlayid];
    if(times<=0)
    {
      art.dialog({
        time: 2,
        content:'请输入投注金额'              
      });
      return;
    }
    if(zhushus.length >= 1){
      addNumberLanAn();
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
        if(_thisPlayid == 'dxdsh2' || _thisPlayid == 'fc3d_dxdsh2' || _thisPlayid == 'dxdsqs' || _thisPlayid == 'dxdshs'){
          gameNumber = gameNumber.replace(/大/g,'0');
          gameNumber = gameNumber.replace(/小/g,'1');
          gameNumber = gameNumber.replace(/单/g,'2');
          gameNumber = gameNumber.replace(/双/g,'3');
        }
        var gameNumberType = $(this).find('.number .yBettingType').text();
        var _thisType = '['+menu0+','+menu1+','+menu2+']';
        var _thisRmb = $(this).find('.rmb').text();
        console.log(gameNumberType == _thisType,gameNumberType, _thisType)
        console.log(gameNumber,Numbers+'|'+_thisRmb,selectRmbStr+'|'+gameNumberType,_thisType,gameNumber == Numbers , _thisRmb == selectRmbStr , gameNumberType == _thisType)
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
          'rate': rate.maxjj,
          'beishu': parseInt(times),
          'yjf' : selectRmb
        }
        orderList.push(arr);
        
        if(_thisPlayid == 'dxdsh2' || _thisPlayid == 'fc3d_dxdsh2' || _thisPlayid == 'dxdsqs' || _thisPlayid == 'dxdshs'){
          Numbers = Numbers.replace(/0/g,'大');
          Numbers = Numbers.replace(/1/g,'小');
          Numbers = Numbers.replace(/2/g,'单');
          Numbers = Numbers.replace(/3/g,'双');
        }
        
        var html = '<dd class="yBettingList" id="'+trano+'">'+
                      '<div class="numberBox yBettingDiv">'+
                        '<span class="number"> <em>'+Numbers+'</em></span>'+
                      '</div>'+
                      '<div class="yBettingType">['+menu0+','+menu1+','+menu2+']</div>'+
                      '<div class="yBettingZhushu yBettingDiv">'+
                        '<em>'+zhushus.length+'</em>注×'+
                      '</div>'+
                      '<div class="yBettingTimes yBettingDiv">'+
                        '<em class="yBettingTimess">'+times+'</em>倍×'+
                      '</div>'+
                      '<div class="rmb yBettingDiv">'+
                        ''+minMoney+selectRmbStr+''+
                      '</div>'+
                      '<div class="yzongRmb" style="float: left;padding-left: 5px;">'+
                        ' = '+(parseInt(zhushus.length) * parseInt(times) * parseInt(minMoney))+selectRmbStr+
                      '</div>'+
                      '<div class="sc" style="float: right;padding-right: 5px;">'+
                        '<a href="javascript:void(0);">'+
                          '<i class="fa fa-times" style="color: red;"></i>'+
                        '</a>'+
                      '</div>'+
                      '<div id="betting_money" style="display: none;">'+lastMoney+'</div>'+
                  '</dd>';
        $('.yBettingLists').append(html);        
      }
      console.log(orderList);
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
        if(_thisPlayid == 'dxdsh2' || _thisPlayid == 'fc3d_dxdsh2' || _thisPlayid == 'dxdsqs' || _thisPlayid == 'dxdshs'){
          cur_number = cur_number.replace(/0/g,'大');
          cur_number = cur_number.replace(/1/g,'小');
          cur_number = cur_number.replace(/2/g,'单');
          cur_number = cur_number.replace(/3/g,'双');
        }else{
          cur_number = cur_order.number;
        }
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
  $(document).on('click','#j_play_select .play_select_tit li',function () {
    $('.zhushu').text('0');
    $('.selectMultipleOldMoney').text('0.00');
    $('#selectMultipleTId').hide();
    $('#addIconId').hide();
    $('#selectMultipleB_nId').hide();
    $('.addtobetbtn').css('background','#252625');
    $('#selectMultipleLz_show').removeClass('selectMultipleLzAdd');
    var this_attr = $(this).attr('lottery_code');
    $(this).addClass('curr').siblings('li').removeClass('curr');
    $('.g_Number_Section').html('');
    switch(this_attr){
      case 'fc3d_3x':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),fc3d_3x_title,fc3d_3x_arr);
        _thisPlayid = 'pl3zxfs';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('每位至少选择一个号码，竞猜开奖号码的后三位，号码和位置都对应即中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(fc3d_3x_sxzhixfsq);
        break;
      case 'fc3d_q2':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),fc3d_q2_title,fc3d_qe_arr);
        _thisPlayid = 'pl3qx2fs';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('每位至少选择一个号码，竞猜开奖号码的前二位，号码和位置都对应即中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(q2_exzhixfs);
        break;
      case 'fc3d_h2':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),fc3d_q2_title,fc3d_he_arr);
        _thisPlayid = 'pl3hx2fs';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('每位至少选择一个号码，竞猜开奖号码的后二位，号码和位置都对应即中奖，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(h2_exzhixfs);
        break;
      case 'fc3d_1x':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),fc3d_1x_title,fc3d_1x_arr);
        _thisPlayid = 'pl3dwdfs';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从百位、十位、个位任意位置上至少选择1个号码，选号与相同位置上的开奖号码一致，奖金  <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumber(fc3d_1x_fs);
        break;
      case 'fc3d_dsds':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),ssc_dsds_title,fc3d_dsds_arr);
        _thisPlayid = 'dxdsh2';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从百位、十位中的“大、小、单、双”中至少各选一个组成一注，奖金 <em style="color:red;">'+rates.maxjj+'</em>元');
        gameNumberZxbd(fc3d_dxds_qe,'dxds');
        break;
    }
    var menu0 = $('.play_select_tit').find('.curr').text();
    var menu2 = $('#bet_filter').find('.curr').text();
    $('.gameType').find('string').text(menu0+menu2);
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

    if(_thisPlayid == 'sxhhzxq' || _thisPlayid == 'sxhhzxz' || _thisPlayid == 'pl3zuxhh'){
      var v = string;
      var reg = /\b[0-9]{3}\b/g;
      // 去重复
      var sszz = util_unique(v, reg, 1, true, true);
      sszz = sszz.sort();
      if (sszz) {
        itemcount = sszz.length;
        yesArr = sszz;
      }
    }

    if(_thisPlayid == 'qszsds' || _thisPlayid == 'zszsds' || _thisPlayid == 'pl3zsds'){

      var stringArr = [];
      var lens = yesArr.length;
      for(var x = 0; x < lens; x++){
        var yesArrbox = [];
        stringArr = yesArr[x].split('');
        stringArr.sort(sortNumber);
        yesArr[x] = stringArr.join('');
      }
  
      for(var xx = 0; xx < lens; xx++){
        if(yesArr[xx]){
          if(!checkRepeat(yesArr[xx]) || /^(\d)\1+$/.test(yesArr[xx])){
            yesArr.splice(xx--,1);
          }
        }   
      }

    }

    if(_thisPlayid == 'qszlds' || _thisPlayid == 'zszlds' || _thisPlayid == 'pl3zlds'){

      var stringArr = [];
      var lens = yesArr.length;
      for(var x = 0; x < lens; x++){
        var yesArrbox = [];
        stringArr = yesArr[x].split('');
        stringArr.sort(sortNumber);
        yesArr[x] = stringArr.join('');
      }
  
      for(var xx = 0; xx < lens; xx++){
        if(yesArr[xx]){
          if(checkRepeat(yesArr[xx]) || /^(\d)\1+$/.test(yesArr[xx])){
            yesArr.splice(xx--,1);
          }
        }   
      }

    }

    if(_thisPlayid == 'pl3q2zxds' || _thisPlayid == 'pl3h2zxds'){
      var v = string;
      var reg = /\b([0-9])(?!\1)([0-9])\b/g;
      // 去重复
      var sszz = util_unique(v, reg, 1, true);
      sszz = sszz.sort();
      if (sszz) {
        itemcount = sszz.length;
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
      // var filterHtml = '<div class="selectNumberFilters">'+
      //                     '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-all">全</a>'+
      //                     '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-big">大</a>'+
      //                     '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-small">小</a>'+
      //                     '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-odd">奇</a>'+
      //                     '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-even">偶</a>'+
      //                     '<a href="javascript:void(0);" class="selectNumberFilter" data-param="js-btn-clean">清</a>'+
      //                  '</div>';
      var boxList = $('<div class="selectNmuverBox"></div>');
      var boxNumber = $('<div class="selectNumbers"></div>');
      boxList.append('<span class="numberTitle">'+arr[i]+'</span>');
      boxList.append(boxNumber);
      // boxList.append(filterHtml);
      if(number && start){
        for(var j = start;j<=number;j++){
          boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+j+'">'+j+'</a>');
        }
      }else if(number){
        for(var j = 0;j<=number;j++){
          boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+j+'">'+j+'</a>');
        }
      }else{
        for(var j = 0;j<=9;j++){
          boxNumber.append('<a href="javascript:void(0);" class="selectNumber" data-number="'+j+'">'+j+'</a>');
        }
      }
      
      box.append(boxList);
    }
    
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
    inputVal = isNaN(parseInt($('.selectMultipInput').val()))?'':parseInt($('.selectMultipInput').val());
    if(inputVal < 1){
      $('.selectMultipInput').val('');
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
      if(inputVal < 1){
        $('.selectMultipInput').val('');
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
    var currTimes = isNaN(parseInt($('.selectMultipInput').val()))?0:parseInt($('.selectMultipInput').val());
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