(function () {
  var s_hostname = 'http://'+window.location.hostname;
  var tm;
  var betTime = 0;
  var oldWinning_name = '';

  var kaijiang = null;

  function qihao(qihao,sum) {
    var sum_arr = sum.split(',');
    $('#f_lottery_info_lastnumber').text(qihao);
    $('#ssc_winning_sum').children().each(function (i) {
      $(this).removeClass('ssc_winning_sum_gif').addClass('ssc_winning_sum_bg');
      $(this).text(sum_arr[i]);
    })
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
  
  function leftTimes(betTime) {
    var str = formatSeconds(betTime);
    if($('.j_lottery_time').length>0 && betTime > 0){
      $('.j_lottery_time').html(str).css({'font-size':'36px','color':'#fff'});
    }else if(betTime<-600){
      clearTimeout(tm);
      $('.j_lottery_time').html('预售中......').css({'font-size':'24px','color':'#fff'});
    }
  }
  
  function nextBetQihaoTime(cz_name,qihao_v,newxtQihao) {

    var nextTimeUrl = s_hostname + '/k3/index.php?m=Home&c=Lottery&a=GetNextDrawTime';
    $.post(nextTimeUrl,{name: cz_name,qihao: qihao_v},function (data) {
      var betTime = parseInt(data.leftTime);
      psotNextQihao = data.qihao;
      var text = $('#f_lottery_info_number').text();
      $('#f_lottery_info_lastnumber').html(text);
      if(betTime == '0'){
        art.dialog({
            icon: "warning",
            id: 'testID2',
            content: text+'期已截止当前期号<span style="color:red;">'+psotNextQihao+'</span>投注时请注意期号',
            lock: true,
            cancelVal: '关闭',
            cancel: true
        });
      }
      
      $('#f_lottery_info_number').html(psotNextQihao);
      $('#ssc_winning_sum').children().removeClass('ssc_winning_sum_bg').addClass('ssc_winning_sum_gif').text('');
      clearInterval(tm);
      tm = setInterval(function () {
              betTime --;
              leftTimes(betTime)
      },1000);
    },'json')
    
  }
  
  function setTimeoutFun (cz_name,qihao_v,newxtQihao,bool) {
    betTime --;
    leftTimes(betTime)
    if(betTime < 0 && bool){
      nextBetQihaoTime(cz_name,qihao_v,newxtQihao);
      checkLooeryKj(cz_name,newxtQihao);
      bool = false;
    }
    
  }

  function checkLooeryKj(cz_name,nextQihao) {
    var kaijiangUrl = s_hostname+'/k3/index.php?m=Home&c=Lottery&a=CheckLotteryKj';
    kaijiang = setInterval(function () {
      $.post(kaijiangUrl,{name: cz_name,qihao: nextQihao},function (data) {
        if(data.status == 1){
          clearInterval(kaijiang);
          clearInterval(tm);
          console.log('成功获取开奖号码');
          qihao_post();
        }
      },'json');
    },5000);
  }
  // 开奖期号和截止时间
  var qihao_post = function () {
    var qihao_url = s_hostname+'/k3/index.php?m=Home&c=Lottery&a=getLotteryDataForQt';
    var url = window.location.pathname;
    var ajax_cz = url.split('/');
    var length = ajax_cz.length - 1;
    var sajax_cz = ajax_cz[length].replace(".html","");
    
    $.post(qihao_url,{name: sajax_cz},function (data) {
      if(sajax_cz == data.name){
        if(data.leftTime<-600 || data.isok!=1){
          var defaulthtml = $(".gameBet_left").html();
          $(".gameBet_left").html("<center><img src='"+Webconfigs['ROOT']+"/Public/home/images/k3cpcz.png' /></center>");
          $('.j_lottery_time').html('预售中......').css({'font-size':'24px','color':'#fff'});
          clearInterval(tm);
        }else{
          var qihao_v = data.qihao;
          var cz_name = data.name;
          var nextQihao = data.nextqihao;
          if(data.qihao){
            qihao(data.qihao,data.balls);
          }
          $('#f_lottery_info_number').text(data.nextqihao);
          console.log(data);
          $('.system_lottery').find('a').each(function () {
            var this_aurl = $(this).attr('href');
            if(this_aurl == url){
              $(this).parent('li').addClass('curr').siblings().removeClass('curr');
            }
          })
          betTime = data.leftTime;
          var bool = true;
          clearInterval(tm)
          tm = setInterval(function () {
              setTimeoutFun(cz_name,qihao_v,nextQihao,bool);
          },1000);
        }

        $('#lottery_title_h2').text(data.title);
        leftTimes(betTime);
        oldWinning_name = data.name;
        oldWinning();
      }
    },'json')
  }
  qihao_post();
  // 开奖公告
  var oldWinning = function () {
    var old_winning = s_hostname+'/k3/index.php?m=Home&c=Lottery&a=GetLotteryRes';
    $.post(old_winning,{name: oldWinning_name,num: 10},function (data) {
      if(data != 'null'){
        var tbody = $('#fn_getoPenGame').children('.tbody');
        var data = JSON.parse(data);
        var tr = '';
        
        for(var i= 0;i < data.length;i++){
          tr += '<tr>'+
                      '<td>'+data[i].qihao+'</td>'+
                      '<td style="padding:0 5px;color:#ff9600;">'+data[i].balls+'</td>'+
                      '<td>'+data[i].draw+'</td>'+
                  '</tr>';
        }
        tbody.html('');
        tbody.append(tr);
      }
      
    })
  }
  

})(jQuery)