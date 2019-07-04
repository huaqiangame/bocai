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
  var maxbeishu = 10000;

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
  yrates['tmlm'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['tmlmda'].rate+'|'+yrates['tmlmxiao'].rate+'|'+yrates['tmlmdan'].rate+'|'+yrates['tmlmshuang'].rate+'|'+yrates['tmlmdadan'].rate+'|'+yrates['tmlmdashuang'].rate
      +'|'+yrates['tmlmxiaodan'].rate+'|'+yrates['tmlmxiaoshuang'].rate+'|'+yrates['tmlmheda'].rate+'|'+yrates['tmlmhexiao'].rate+'|'+yrates['tmlmhedan'].rate+'|'+yrates['tmlmheshuang'].rate
      +'|'+yrates['tmlmweida'].rate+'|'+yrates['tmlmweixiao'].rate+'|'+yrates['tmlmjiaqin'].rate+'|'+yrates['tmlmyeshou'].rate+'|'+yrates['tmlmhongbo'].rate+'|'+yrates['tmlmlvbo'].rate
      +'|'+yrates['tmlmlanbo'].rate,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'tmlm',
      remark: '',
      rate: yrates['tmlmda'].rate+'|'+yrates['tmlmxiao'].rate+'|'+yrates['tmlmdan'].rate+'|'+yrates['tmlmshuang'].rate+'|'+yrates['tmlmdadan'].rate+'|'+yrates['tmlmdashuang'].rate
      +'|'+yrates['tmlmxiaodan'].rate+'|'+yrates['tmlmxiaoshuang'].rate+'|'+yrates['tmlmheda'].rate+'|'+yrates['tmlmhexiao'].rate+'|'+yrates['tmlmhedan'].rate+'|'+yrates['tmlmheshuang'].rate
      +'|'+yrates['tmlmweida'].rate+'|'+yrates['tmlmweixiao'].rate+'|'+yrates['tmlmjiaqin'].rate+'|'+yrates['tmlmyeshou'].rate+'|'+yrates['tmlmhongbo'].rate+'|'+yrates['tmlmlvbo'].rate
      +'|'+yrates['tmlmlanbo'].rate,
      title: '特码两面',
      totalzs: '10',
      typeid: 'lhc'
    };

    yrates['zm1lm'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['zm1lmda'].rate+'|'+yrates['zm1lmxiao'].rate+'|'+yrates['zm1lmdan'].rate+'|'+yrates['zm1lmshuang'].rate+'|'+yrates['zm1lmdadan'].rate+'|'+yrates['zm1lmdashuang'].rate
      +'|'+yrates['zm1lmxiaodan'].rate+'|'+yrates['zm1lmxiaoshuang'].rate+'|'+yrates['zm1lmheda'].rate+'|'+yrates['zm1lmhexiao'].rate+'|'+yrates['zm1lmhedan'].rate+'|'+yrates['zm1lmheshuang'].rate
      +'|'+yrates['zm1lmweida'].rate+'|'+yrates['zm1lmweixiao'].rate+'|'+yrates['zm1lmjiaqin'].rate+'|'+yrates['zm1lmyeshou'].rate+'|'+yrates['zm1lmhongbo'].rate+'|'+yrates['zm1lmlvbo'].rate
      +'|'+yrates['zm1lmlanbo'].rate,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'zm1lm',
      remark: '',
      rate:  yrates['zm1lmda'].rate+'|'+yrates['zm1lmxiao'].rate+'|'+yrates['zm1lmdan'].rate+'|'+yrates['zm1lmshuang'].rate+'|'+yrates['zm1lmdadan'].rate+'|'+yrates['zm1lmdashuang'].rate
      +'|'+yrates['zm1lmxiaodan'].rate+'|'+yrates['zm1lmxiaoshuang'].rate+'|'+yrates['zm1lmheda'].rate+'|'+yrates['zm1lmhexiao'].rate+'|'+yrates['zm1lmhedan'].rate+'|'+yrates['zm1lmheshuang'].rate
      +'|'+yrates['zm1lmweida'].rate+'|'+yrates['zm1lmweixiao'].rate+'|'+yrates['zm1lmjiaqin'].rate+'|'+yrates['zm1lmyeshou'].rate+'|'+yrates['zm1lmhongbo'].rate+'|'+yrates['zm1lmlvbo'].rate
      +'|'+yrates['zm1lmlanbo'].rate,
      title: '正1两面',
      totalzs: '10',
      typeid: 'lhc'
    };

    yrates['zm2lm'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['zm2lmda'].rate+'|'+yrates['zm2lmxiao'].rate+'|'+yrates['zm2lmdan'].rate+'|'+yrates['zm2lmshuang'].rate+'|'+yrates['zm2lmdadan'].rate+'|'+yrates['zm2lmdashuang'].rate
      +'|'+yrates['zm2lmxiaodan'].rate+'|'+yrates['zm2lmxiaoshuang'].rate+'|'+yrates['zm2lmheda'].rate+'|'+yrates['zm2lmhexiao'].rate+'|'+yrates['zm2lmhedan'].rate+'|'+yrates['zm2lmheshuang'].rate
      +'|'+yrates['zm2lmweida'].rate+'|'+yrates['zm2lmweixiao'].rate+'|'+yrates['zm2lmjiaqin'].rate+'|'+yrates['zm2lmyeshou'].rate+'|'+yrates['zm2lmhongbo'].rate+'|'+yrates['zm2lmlvbo'].rate
      +'|'+yrates['zm2lmlanbo'].rate,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'zm2lm',
      remark: '',
      rate:  yrates['zm2lmda'].rate+'|'+yrates['zm2lmxiao'].rate+'|'+yrates['zm2lmdan'].rate+'|'+yrates['zm2lmshuang'].rate+'|'+yrates['zm2lmdadan'].rate+'|'+yrates['zm2lmdashuang'].rate
      +'|'+yrates['zm2lmxiaodan'].rate+'|'+yrates['zm2lmxiaoshuang'].rate+'|'+yrates['zm2lmheda'].rate+'|'+yrates['zm2lmhexiao'].rate+'|'+yrates['zm2lmhedan'].rate+'|'+yrates['zm2lmheshuang'].rate
      +'|'+yrates['zm2lmweida'].rate+'|'+yrates['zm2lmweixiao'].rate+'|'+yrates['zm2lmjiaqin'].rate+'|'+yrates['zm2lmyeshou'].rate+'|'+yrates['zm2lmhongbo'].rate+'|'+yrates['zm2lmlvbo'].rate
      +'|'+yrates['zm2lmlanbo'].rate,
      title: '正2两面',
      totalzs: '10',
      typeid: 'lhc'
    };

    yrates['zm3lm'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['zm3lmda'].rate+'|'+yrates['zm3lmxiao'].rate+'|'+yrates['zm3lmdan'].rate+'|'+yrates['zm3lmshuang'].rate+'|'+yrates['zm3lmdadan'].rate+'|'+yrates['zm3lmdashuang'].rate
      +'|'+yrates['zm3lmxiaodan'].rate+'|'+yrates['zm3lmxiaoshuang'].rate+'|'+yrates['zm3lmheda'].rate+'|'+yrates['zm3lmhexiao'].rate+'|'+yrates['zm3lmhedan'].rate+'|'+yrates['zm3lmheshuang'].rate
      +'|'+yrates['zm3lmweida'].rate+'|'+yrates['zm3lmweixiao'].rate+'|'+yrates['zm3lmjiaqin'].rate+'|'+yrates['zm3lmyeshou'].rate+'|'+yrates['zm3lmhongbo'].rate+'|'+yrates['zm3lmlvbo'].rate
      +'|'+yrates['zm3lmlanbo'].rate,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'zm3lm',
      remark: '',
      rate:  yrates['zm3lmda'].rate+'|'+yrates['zm3lmxiao'].rate+'|'+yrates['zm3lmdan'].rate+'|'+yrates['zm3lmshuang'].rate+'|'+yrates['zm3lmdadan'].rate+'|'+yrates['zm3lmdashuang'].rate
      +'|'+yrates['zm3lmxiaodan'].rate+'|'+yrates['zm3lmxiaoshuang'].rate+'|'+yrates['zm3lmheda'].rate+'|'+yrates['zm3lmhexiao'].rate+'|'+yrates['zm3lmhedan'].rate+'|'+yrates['zm3lmheshuang'].rate
      +'|'+yrates['zm3lmweida'].rate+'|'+yrates['zm3lmweixiao'].rate+'|'+yrates['zm3lmjiaqin'].rate+'|'+yrates['zm3lmyeshou'].rate+'|'+yrates['zm3lmhongbo'].rate+'|'+yrates['zm3lmlvbo'].rate
      +'|'+yrates['zm3lmlanbo'].rate,
      title: '正3两面',
      totalzs: '10',
      typeid: 'lhc'
    };

    yrates['zm4lm'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['zm4lmda'].rate+'|'+yrates['zm4lmxiao'].rate+'|'+yrates['zm4lmdan'].rate+'|'+yrates['zm4lmshuang'].rate+'|'+yrates['zm4lmdadan'].rate+'|'+yrates['zm4lmdashuang'].rate
      +'|'+yrates['zm4lmxiaodan'].rate+'|'+yrates['zm4lmxiaoshuang'].rate+'|'+yrates['zm4lmheda'].rate+'|'+yrates['zm4lmhexiao'].rate+'|'+yrates['zm4lmhedan'].rate+'|'+yrates['zm4lmheshuang'].rate
      +'|'+yrates['zm4lmweida'].rate+'|'+yrates['zm4lmweixiao'].rate+'|'+yrates['zm4lmjiaqin'].rate+'|'+yrates['zm4lmyeshou'].rate+'|'+yrates['zm4lmhongbo'].rate+'|'+yrates['zm4lmlvbo'].rate
      +'|'+yrates['zm4lmlanbo'].rate,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'zm4lm',
      remark: '',
      rate:  yrates['zm4lmda'].rate+'|'+yrates['zm4lmxiao'].rate+'|'+yrates['zm4lmdan'].rate+'|'+yrates['zm4lmshuang'].rate+'|'+yrates['zm4lmdadan'].rate+'|'+yrates['zm4lmdashuang'].rate
      +'|'+yrates['zm4lmxiaodan'].rate+'|'+yrates['zm4lmxiaoshuang'].rate+'|'+yrates['zm4lmheda'].rate+'|'+yrates['zm4lmhexiao'].rate+'|'+yrates['zm4lmhedan'].rate+'|'+yrates['zm4lmheshuang'].rate
      +'|'+yrates['zm4lmweida'].rate+'|'+yrates['zm4lmweixiao'].rate+'|'+yrates['zm4lmjiaqin'].rate+'|'+yrates['zm4lmyeshou'].rate+'|'+yrates['zm4lmhongbo'].rate+'|'+yrates['zm4lmlvbo'].rate
      +'|'+yrates['zm4lmlanbo'].rate,
      title: '正4两面',
      totalzs: '10',
      typeid: 'lhc'
    };

    yrates['zm5lm'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['zm5lmda'].rate+'|'+yrates['zm5lmxiao'].rate+'|'+yrates['zm5lmdan'].rate+'|'+yrates['zm5lmshuang'].rate+'|'+yrates['zm5lmdadan'].rate+'|'+yrates['zm5lmdashuang'].rate
      +'|'+yrates['zm5lmxiaodan'].rate+'|'+yrates['zm5lmxiaoshuang'].rate+'|'+yrates['zm5lmheda'].rate+'|'+yrates['zm5lmhexiao'].rate+'|'+yrates['zm5lmhedan'].rate+'|'+yrates['zm5lmheshuang'].rate
      +'|'+yrates['zm5lmweida'].rate+'|'+yrates['zm5lmweixiao'].rate+'|'+yrates['zm5lmjiaqin'].rate+'|'+yrates['zm5lmyeshou'].rate+'|'+yrates['zm5lmhongbo'].rate+'|'+yrates['zm5lmlvbo'].rate
      +'|'+yrates['zm5lmlanbo'].rate,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'zm5lm',
      remark: '',
      rate:  yrates['zm5lmda'].rate+'|'+yrates['zm5lmxiao'].rate+'|'+yrates['zm5lmdan'].rate+'|'+yrates['zm5lmshuang'].rate+'|'+yrates['zm5lmdadan'].rate+'|'+yrates['zm5lmdashuang'].rate
      +'|'+yrates['zm5lmxiaodan'].rate+'|'+yrates['zm5lmxiaoshuang'].rate+'|'+yrates['zm5lmheda'].rate+'|'+yrates['zm5lmhexiao'].rate+'|'+yrates['zm5lmhedan'].rate+'|'+yrates['zm5lmheshuang'].rate
      +'|'+yrates['zm5lmweida'].rate+'|'+yrates['zm5lmweixiao'].rate+'|'+yrates['zm5lmjiaqin'].rate+'|'+yrates['zm5lmyeshou'].rate+'|'+yrates['zm5lmhongbo'].rate+'|'+yrates['zm5lmlvbo'].rate
      +'|'+yrates['zm5lmlanbo'].rate,
      title: '正5两面',
      totalzs: '10',
      typeid: 'lhc'
    };

    yrates['zm6lm'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['zm6lmda'].rate+'|'+yrates['zm6lmxiao'].rate+'|'+yrates['zm6lmdan'].rate+'|'+yrates['zm6lmshuang'].rate+'|'+yrates['zm6lmdadan'].rate+'|'+yrates['zm6lmdashuang'].rate
      +'|'+yrates['zm6lmxiaodan'].rate+'|'+yrates['zm6lmxiaoshuang'].rate+'|'+yrates['zm6lmheda'].rate+'|'+yrates['zm6lmhexiao'].rate+'|'+yrates['zm6lmhedan'].rate+'|'+yrates['zm6lmheshuang'].rate
      +'|'+yrates['zm6lmweida'].rate+'|'+yrates['zm6lmweixiao'].rate+'|'+yrates['zm6lmjiaqin'].rate+'|'+yrates['zm6lmyeshou'].rate+'|'+yrates['zm6lmhongbo'].rate+'|'+yrates['zm6lmlvbo'].rate
      +'|'+yrates['zm6lmlanbo'].rate,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'zm6lm',
      remark: '',
      rate:  yrates['zm6lmda'].rate+'|'+yrates['zm6lmxiao'].rate+'|'+yrates['zm6lmdan'].rate+'|'+yrates['zm6lmshuang'].rate+'|'+yrates['zm6lmdadan'].rate+'|'+yrates['zm6lmdashuang'].rate
      +'|'+yrates['zm6lmxiaodan'].rate+'|'+yrates['zm6lmxiaoshuang'].rate+'|'+yrates['zm6lmheda'].rate+'|'+yrates['zm6lmhexiao'].rate+'|'+yrates['zm6lmhedan'].rate+'|'+yrates['zm6lmheshuang'].rate
      +'|'+yrates['zm6lmweida'].rate+'|'+yrates['zm6lmweixiao'].rate+'|'+yrates['zm6lmjiaqin'].rate+'|'+yrates['zm6lmyeshou'].rate+'|'+yrates['zm6lmhongbo'].rate+'|'+yrates['zm6lmlvbo'].rate
      +'|'+yrates['zm6lmlanbo'].rate,
      title: '正6两面',
      totalzs: '10',
      typeid: 'lhc'
    };

    yrates['tmbb'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['hongda'].rate+'|'+yrates['hongxiao'].rate+'|'+yrates['hongdan'].rate+'|'+yrates['hongshuang'].rate+'|'+yrates['honghedan'].rate+'|'+yrates['hongheshuang'].rate
      +'|'+yrates['lvda'].rate+'|'+yrates['lvxiao'].rate+'|'+yrates['lvdan'].rate+'|'+yrates['lvshuang'].rate+'|'+yrates['lvhedan'].rate+'|'+yrates['lvheshuang'].rate
      +'|'+yrates['landa'].rate+'|'+yrates['lanxiao'].rate+'|'+yrates['landan'].rate+'|'+yrates['lanshuang'].rate+'|'+yrates['lanhedan'].rate+'|'+yrates['lanheshuang'].rate
      ,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'tmbb',
      remark: '',
      rate:  yrates['hongda'].rate+'|'+yrates['hongxiao'].rate+'|'+yrates['hongdan'].rate+'|'+yrates['hongshuang'].rate+'|'+yrates['honghedan'].rate+'|'+yrates['hongheshuang'].rate
      +'|'+yrates['lvda'].rate+'|'+yrates['lvxiao'].rate+'|'+yrates['lvdan'].rate+'|'+yrates['lvshuang'].rate+'|'+yrates['lvhedan'].rate+'|'+yrates['lvheshuang'].rate
      +'|'+yrates['landa'].rate+'|'+yrates['lanxiao'].rate+'|'+yrates['landan'].rate+'|'+yrates['lanshuang'].rate+'|'+yrates['lanhedan'].rate+'|'+yrates['lanheshuang'].rate
      ,
      title: '特码半波',
      totalzs: '10',
      typeid: 'lhc'
    };

    yrates['sxtx'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['sxtxshu'].rate+'|'+yrates['sxtxniu'].rate+'|'+yrates['sxtxhu'].rate+'|'+yrates['sxtxtu'].rate+'|'+yrates['sxtxlong'].rate+'|'+yrates['sxtxshe'].rate
      +'|'+yrates['sxtxma'].rate+'|'+yrates['sxtxyang'].rate+'|'+yrates['sxtxhou'].rate+'|'+yrates['sxtxji'].rate+'|'+yrates['sxtxgou'].rate+'|'+yrates['sxtxzhu'].rate
      ,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'sxtx',
      remark: '',
      rate:  yrates['sxtxshu'].rate+'|'+yrates['sxtxniu'].rate+'|'+yrates['sxtxhu'].rate+'|'+yrates['sxtxtu'].rate+'|'+yrates['sxtxlong'].rate+'|'+yrates['sxtxshe'].rate
      +'|'+yrates['sxtxma'].rate+'|'+yrates['sxtxyang'].rate+'|'+yrates['sxtxhou'].rate+'|'+yrates['sxtxji'].rate+'|'+yrates['sxtxgou'].rate+'|'+yrates['sxtxzhu'].rate
      ,
      title: '特肖',
      totalzs: '10',
      typeid: 'lhc'
    };

    yrates['sx1x'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['sx1xshu'].rate+'|'+yrates['sx1xniu'].rate+'|'+yrates['sx1xhu'].rate+'|'+yrates['sx1xtu'].rate+'|'+yrates['sx1xlong'].rate+'|'+yrates['sx1xshe'].rate
      +'|'+yrates['sx1xma'].rate+'|'+yrates['sx1xyang'].rate+'|'+yrates['sx1xhou'].rate+'|'+yrates['sx1xji'].rate+'|'+yrates['sx1xgou'].rate+'|'+yrates['sx1xzhu'].rate
      ,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'sx1x',
      remark: '',
      rate:  yrates['sx1xshu'].rate+'|'+yrates['sx1xniu'].rate+'|'+yrates['sx1xhu'].rate+'|'+yrates['sx1xtu'].rate+'|'+yrates['sx1xlong'].rate+'|'+yrates['sx1xshe'].rate
      +'|'+yrates['sx1xma'].rate+'|'+yrates['sx1xyang'].rate+'|'+yrates['sx1xhou'].rate+'|'+yrates['sx1xji'].rate+'|'+yrates['sx1xgou'].rate+'|'+yrates['sx1xzhu'].rate
      ,
      title: '一肖',
      totalzs: '10',
      typeid: 'lhc'
    };

    yrates['wstw'] = {
      id: '339',
      isopen: '1',
      maxjj: yrates['lingtou'].rate+'|'+yrates['yitou'].rate+'|'+yrates['ertou'].rate+'|'+yrates['santou'].rate+'|'+yrates['sitou'].rate+'|'+yrates['lingwei'].rate
      +'|'+yrates['yiwei'].rate+'|'+yrates['erwei'].rate+'|'+yrates['sanwei'].rate+'|'+yrates['siwei'].rate+'|'+yrates['wuwei'].rate+'|'+yrates['liuwei'].rate
      +'|'+yrates['qiwei'].rate+'|'+yrates['bawei'].rate+'|'+yrates['jiuwei'].rate
      ,
      maxprize: '300000.00',
      maxrate: '0.000',
      maxxf: '10000.00',
      maxzs: '10',
      minjj: '5.23',
      minrate: '0.000',
      minxf: '1.00',
      playid: 'wstw',
      remark: '',
      rate:  yrates['lingtou'].rate+'|'+yrates['yitou'].rate+'|'+yrates['ertou'].rate+'|'+yrates['santou'].rate+'|'+yrates['sitou'].rate+'|'+yrates['lingwei'].rate
      +'|'+yrates['yiwei'].rate+'|'+yrates['erwei'].rate+'|'+yrates['sanwei'].rate+'|'+yrates['siwei'].rate+'|'+yrates['wuwei'].rate+'|'+yrates['liuwei'].rate
      +'|'+yrates['qiwei'].rate+'|'+yrates['bawei'].rate+'|'+yrates['jiuwei'].rate
      ,
      title: '特码头尾',
      totalzs: '10',
      typeid: 'lhc'
    };
  

  function tabGameInit(){
    _thisPlayid = 'tmzx';
    rates = yrates[_thisPlayid];
    gameSwitch($('.bet_filter_box'),lhc_tmzx_title,lhc_tmzx_arr);
    $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码中包含特码，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
    lhcgameNumber(lhc_tmzx_num);
  }
  tabGameInit();
  

  if($('.selectMultipInput').val() <= 1){
    $('.reduce').addClass('noReduce');
  }

  $(document).on('click','.mobileMoneyInfo',function () {
    $('.mobileMoneyHover').show();
  })

  $(document).on('click','.mobileMoneyHoverClose',function () {
    $('.mobileMoneyHover').hide();
  })

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
    }else if(_thisPlayid == 'sxzhixdsq' || _thisPlayid == 'sxzhixdsz'  || _thisPlayid == 'sxzhixdsh'     
        ){
      var str = '';
      for( var a = 0; a < 3; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        str = randomsumber + str;
      }
    
      $('#text').val(str);
    }else if(_thisPlayid == 'exzhixdsq' ||  _thisPlayid == 'exzhixdsh' ){
      var str = '';
      for( var a = 0; a < 2; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        str = randomsumber + str;
      }

      $('#text').val(str);
    }else if(_thisPlayid == 'wxzhixfs' || _thisPlayid == 'bdw5x1m' || _thisPlayid == 'qwyffs' ||
            _thisPlayid == 'qwhscs' || _thisPlayid == 'qwsxbx' || _thisPlayid == 'qwsjfc' ||
           _thisPlayid == 'sixzhixfsh' || _thisPlayid == 'bdw4x1m' || _thisPlayid == 'sxzhixfsq' ||
          _thisPlayid == 'sxzhixfsz' || _thisPlayid == 'sxzhixfsh' || 
        _thisPlayid == 'exzhixfsq' || _thisPlayid == 'exzhixfsh' ||
      _thisPlayid == 'zhixhzqe' || _thisPlayid == 'zhixhzhe' ||
    _thisPlayid == 'kuaduqe' || _thisPlayid == 'kuaduhe'
    ){
      for( var a = 0; a < ceshi.length; a++){
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        ceshi.eq(a).find('.selectNumbers a').eq(randomsumber).addClass('curr');
      }
    }else if(_thisPlayid == 'dxdsqe' || _thisPlayid == 'dxdshe' || _thisPlayid == 'dxdsqs' || _thisPlayid == 'dxdshs'){
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
            _thisPlayid == 'sxzuxzsq' || _thisPlayid == 'sxzuxzsz' || _thisPlayid == 'sxzuxzsh' ||
           _thisPlayid == 'bdwqs2m' || _thisPlayid == 'bdwzs2m' || _thisPlayid == 'bdwhs2m' ||
          _thisPlayid == 'exzuxfsq' || _thisPlayid == 'exzuxfsh'){
      zuxuan120(2);
    }else if(_thisPlayid == 'sxzuxzlq' || _thisPlayid == 'sxzuxzlz' || _thisPlayid == 'sxzuxzlh'){
      zuxuan120(3);
    }else if(_thisPlayid == 'zhixhzqs' || _thisPlayid == 'zhixhzzs' || 
            _thisPlayid == 'zhixhzhs' || _thisPlayid == 'kuaduqs' ||
             _thisPlayid == 'kuaduzs' || _thisPlayid == 'kuaduhs' ||
             _thisPlayid == 'zuxhzqs' || _thisPlayid == 'zuxhzzs' || _thisPlayid == 'zuxhzhs' ||
              _thisPlayid == 'zuxcsbd' ||  _thisPlayid == 'zuxzsbd' ||  _thisPlayid == 'zuxhsbd' ||
            _thisPlayid == 'bdwqs' ||  _thisPlayid == 'bdwzs' ||  _thisPlayid == 'bdwhs' || 
          _thisPlayid == 'zuxhzqe' ||  _thisPlayid == 'zuxhzhe' ||
          _thisPlayid == 'zuxcebd' ||  _thisPlayid == 'zuxhebd'){
      zuxuan120(1);
    }else if(_thisPlayid == 'qszsds' ||  _thisPlayid == 'zszsds' ||  _thisPlayid == 'hszsds'
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
    }else if(_thisPlayid == 'qszlds' ||  _thisPlayid == 'zszlds' ||  _thisPlayid == 'hszlds' || 
    _thisPlayid == 'sxhhzxq' || _thisPlayid == 'sxhhzxz' || _thisPlayid == 'sxhhzxh'){
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
    }else if(_thisPlayid == 'exzuxdsq' ||  _thisPlayid == 'exzuxdsh'){
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
    }else if(_thisPlayid == 'dweid'){
      
        randomsumber = Math.round(Math.random() * (9 - 1) + 1);
        var randomsumber2 = Math.round(Math.random() * (4 - 1) + 1);
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

  function updataMoneylhc(){
    var times = $('.bet_money_input').val();
    var updatazhuslen = currList();
    var winningMoney = $('.play_select_prompt').find('span[way-data="tabDoc"] em').text();
    if(!winningMoney){
      winningMoney = $('.lhclm').find('.lhclmPeil').eq(0).find('em').text();
      if(!winningMoney){
        winningMoney = $('.lhcaddMoneyInfo').eq($('.lhcaddMoneyInfo').length - 1).text();
      }
      if(!winningMoney){
        winningMoney = $('.lhclm').find('.lmbbNumber').eq(0).find('em').text();
      }
    }
    var winningMoneys = times * winningMoney;
    $('.lhcTSelectNumber').find('.bet_win_money').text(winningMoneys.toFixed(2));
    if(_thisPlayid == 'lm3qz' || _thisPlayid == 'lm3z2' || _thisPlayid == 'lm2qz' || _thisPlayid == 'lm2zt' || _thisPlayid == 'lmtc'
      || _thisPlayid == 'sx2xl' || _thisPlayid == 'sx3xl' || _thisPlayid == 'sx4xl'
      || _thisPlayid == 'ws2wl' || _thisPlayid == 'ws3wl' || _thisPlayid == 'ws4wl'
      || _thisPlayid == 'bz5bz' || _thisPlayid == 'bz6bz' || _thisPlayid == 'bz7bz'
      || _thisPlayid == 'bz8bz' || _thisPlayid == 'bz9bz' || _thisPlayid == 'bz10bz'){
      $('.lhcTSelectNumber').find('.lhcmoneyMobile').text(zhushus.length * times);
    }else{
      $('.lhcTSelectNumber').find('.lhcmoneyMobile').text(updatazhuslen[0].length * times);
    }
    
    for(var i = 0; i < orderList.length; i++){
      if(orderList[i].zhushu > 1){
        orderList[i].price = zhushus.length * times;
      }else{
        orderList[i].price = times;
      }
    }

  }

  function oldMoneyText(){
    $('.lhcTSelectNumber').find('.bet_win_money').text('');
    $('.lhcTSelectNumber').find('.lhcmoneyMobile').text('');
    $('.lhcTSelectNumber').find('.text-ellipsis').text('');
    $('.lhcTSelectNumber').find('.lhczhuMobile').text('');
    $('.bet_money_input').val('');
  }

  $('.bet_money_input').keyup(function(){
    updataMoneylhc();
  })

  $('.bet-info-clear').click(function (){
    betinfoclear();
  })
  function betinfoclear() {
    oldMoneyText();
    $('.selectNumbers').find('.curr').removeClass('curr');
    $('.selectNumbers').find('.lhc_green_bg').removeClass('lhc_green_bg');
    $('.selectNumbers').find('.lhc_red_bg').removeClass('lhc_red_bg');
    $('.selectNumbers').find('.lhc_blue_bg').removeClass('lhc_blue_bg');
    $('.lhcTSelectNumber').find('.bet-money').hide();
    $('.lhcTSelectNumber').find('.bet-info-count').hide();
    orderList = [];
  }
  //号码点击
  $('.g_Number_Section').on('click','.selectNumbers a',function (){
    var thisClass = $(this).attr('data-bg');
    if($(this).hasClass('curr')){
      $(this).removeClass('curr');
      $(this).removeClass(thisClass);
      if(!thisClass){
        for(var w = 0; w < orderList.length; w++){
          if(orderList[w].number == $(this).attr('data-number')){
            orderList.splice(w,1);
          }
        }
        var lhclmarr = currList();
        var lhclmarrHtml = '';
        countFun();
        countMoney();
        updataMoneylhc();
        for(var n = 0; n < lhclmarr.length; n++){
          lhclmarrHtml += lhclmarr[n] + ' ';
        }
        lhclmarrHtml = lhclmarrHtml.replace(/,/g,' ');
        $('.lhcTSelectNumber').find('.text-ellipsis').text(lhclmarrHtml);
        $('.lhcTSelectNumber').find('.lhczhuMobile').text(orderList.length);
     
        if(orderList.length <= 0){
          $('.lhcTSelectNumber').find('.bet-money').hide();
          $('.lhcTSelectNumber').find('.bet-info-count').hide();
          oldMoneyText();
          orderList = [];
        }
        return;
      }
    }else{  
      $(this).addClass(thisClass);
      $(this).addClass('curr');
    }
    var Numbers = '';
    if(thisClass){
      currNumber = currList();
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
      orderList = [];
    }else{
      var acArr = [];
      currNumber = $(this).attr('data-number');
      Numbers = currNumber;
    }
    console.log(Numbers);
    countFun();
    countMoney();
    updataMoneylhc();
    if(zhushus.length > 0){
      $('.lhcTSelectNumber').find('.bet-money').show();
      $('.lhcTSelectNumber').find('.bet-info-count').show();
      
      var yBetting = $('.yBettingList');
      var menu0 = $('.play_select_tit').find('.curr').text();
      var menu1 = $('#bet_filter').find('.curr').parent().siblings('.title').text();
      var menu2 = $('#bet_filter').find('.curr').text();
      var times = $('.bet_money_input').val();
      var selectRmb = $('.selectMultipleCon').val();
      var selectRmbStr = $('.selectMultipleCon').find('option:selected').text();
      var winningMoney = $('.play_select_prompt').find('span[way-data="tabDoc"] em').text();
      var winningMoneys = times * winningMoney * selectRmb;
      var trano= generateMixed(20);
      if(_thisPlayid == 'tmlm'){
          switch(currNumber){
            case '大':
            var rate = yrates['tmlmda'];
            break;
            case '小':
            var rate = yrates['tmlmxiao'];
            break;
            case '单':
            var rate = yrates['tmlmdan'];
            break;
            case '双':
            var rate = yrates['tmlmshuang'];
            break;
            case '大单':
            var rate = yrates['tmlmdadan'];
            break;
            case '大双':
            var rate = yrates['tmlmdashuang'];
            break;
            case '小单':
            var rate = yrates['tmlmxiaodan'];
            break;
            case '小双':
            var rate = yrates['tmlmxiaoshuang'];
            break;
            case '合大':
            var rate = yrates['tmlmheda'];
            break;
            case '合小':
            var rate = yrates['tmlmhexiao'];
            break;
            case '合单':
            var rate = yrates['tmlmhedan'];
            break;
            case '合双':
            var rate = yrates['tmlmheshuang'];
            break;
            case '尾大':
            var rate = yrates['tmlmweida'];
            break;
            case '尾小':
            var rate = yrates['tmlmweixiao'];
            break;
            case '家禽':
            var rate = yrates['tmlmjiaqin'];
            break;
            case '野兽':
            var rate = yrates['tmlmyeshou'];
            break;
            case '红波':
            var rate = yrates['tmlmhongbo'];
            break;
            case '绿波':
            var rate = yrates['tmlmlvbo'];
            break;
            case '蓝波':
            var rate = yrates['tmlmlanbo'];
            break;
          }
        }else if(_thisPlayid == 'zm1lm'){
          switch(currNumber){
            case '大':
            var rate = yrates['zm1lmda'];
            break;
            case '小':
            var rate = yrates['zm1lmxiao'];
            break;
            case '单':
            var rate = yrates['zm1lmdan'];
            break;
            case '双':
            var rate = yrates['zm1lmshuang'];
            break;
            case '大单':
            var rate = yrates['zm1lmdadan'];
            break;
            case '大双':
            var rate = yrates['zm1lmdashuang'];
            break;
            case '小单':
            var rate = yrates['zm1lmxiaodan'];
            break;
            case '小双':
            var rate = yrates['zm1lmxiaoshuang'];
            break;
            case '合大':
            var rate = yrates['zm1lmheda'];
            break;
            case '合小':
            var rate = yrates['zm1lmhexiao'];
            break;
            case '合单':
            var rate = yrates['zm1lmhedan'];
            break;
            case '合双':
            var rate = yrates['zm1lmheshuang'];
            break;
            case '尾大':
            var rate = yrates['zm1lmweida'];
            break;
            case '尾小':
            var rate = yrates['zm1lmweixiao'];
            break;
            case '家禽':
            var rate = yrates['zm1lmjiaqin'];
            break;
            case '野兽':
            var rate = yrates['zm1lmyeshou'];
            break;
            case '红波':
            var rate = yrates['zm1lmhongbo'];
            break;
            case '绿波':
            var rate = yrates['zm1lmlvbo'];
            break;
            case '蓝波':
            var rate = yrates['zm1lmlanbo'];
            break;
          }
        }else if(_thisPlayid == 'zm2lm'){
          switch(currNumber){
            case '大':
            var rate = yrates['zm2lmda'];
            break;
            case '小':
            var rate = yrates['zm2lmxiao'];
            break;
            case '单':
            var rate = yrates['zm2lmdan'];
            break;
            case '双':
            var rate = yrates['zm2lmshuang'];
            break;
            case '大单':
            var rate = yrates['zm2lmdadan'];
            break;
            case '大双':
            var rate = yrates['zm2lmdashuang'];
            break;
            case '小单':
            var rate = yrates['zm2lmxiaodan'];
            break;
            case '小双':
            var rate = yrates['zm2lmxiaoshuang'];
            break;
            case '合大':
            var rate = yrates['zm2lmheda'];
            break;
            case '合小':
            var rate = yrates['zm2lmhexiao'];
            break;
            case '合单':
            var rate = yrates['zm2lmhedan'];
            break;
            case '合双':
            var rate = yrates['zm2lmheshuang'];
            break;
            case '尾大':
            var rate = yrates['zm2lmweida'];
            break;
            case '尾小':
            var rate = yrates['zm2lmweixiao'];
            break;
            case '家禽':
            var rate = yrates['zm2lmjiaqin'];
            break;
            case '野兽':
            var rate = yrates['zm2lmyeshou'];
            break;
            case '红波':
            var rate = yrates['zm2lmhongbo'];
            break;
            case '绿波':
            var rate = yrates['zm2lmlvbo'];
            break;
            case '蓝波':
            var rate = yrates['zm2lmlanbo'];
            break;
          }
        }else if(_thisPlayid == 'zm3lm'){
          switch(currNumber){
            case '大':
            var rate = yrates['zm3lmda'];
            break;
            case '小':
            var rate = yrates['zm3lmxiao'];
            break;
            case '单':
            var rate = yrates['zm3lmdan'];
            break;
            case '双':
            var rate = yrates['zm3lmshuang'];
            break;
            case '大单':
            var rate = yrates['zm3lmdadan'];
            break;
            case '大双':
            var rate = yrates['zm3lmdashuang'];
            break;
            case '小单':
            var rate = yrates['zm3lmxiaodan'];
            break;
            case '小双':
            var rate = yrates['zm3lmxiaoshuang'];
            break;
            case '合大':
            var rate = yrates['zm3lmheda'];
            break;
            case '合小':
            var rate = yrates['zm3lmhexiao'];
            break;
            case '合单':
            var rate = yrates['zm3lmhedan'];
            break;
            case '合双':
            var rate = yrates['zm3lmheshuang'];
            break;
            case '尾大':
            var rate = yrates['zm3lmweida'];
            break;
            case '尾小':
            var rate = yrates['zm3lmweixiao'];
            break;
            case '家禽':
            var rate = yrates['zm3lmjiaqin'];
            break;
            case '野兽':
            var rate = yrates['zm3lmyeshou'];
            break;
            case '红波':
            var rate = yrates['zm3lmhongbo'];
            break;
            case '绿波':
            var rate = yrates['zm3lmlvbo'];
            break;
            case '蓝波':
            var rate = yrates['zm3lmlanbo'];
            break;
          }
        }else if(_thisPlayid == 'zm4lm'){
          switch(currNumber){
            case '大':
            var rate = yrates['zm4lmda'];
            break;
            case '小':
            var rate = yrates['zm4lmxiao'];
            break;
            case '单':
            var rate = yrates['zm4lmdan'];
            break;
            case '双':
            var rate = yrates['zm4lmshuang'];
            break;
            case '大单':
            var rate = yrates['zm4lmdadan'];
            break;
            case '大双':
            var rate = yrates['zm4lmdashuang'];
            break;
            case '小单':
            var rate = yrates['zm4lmxiaodan'];
            break;
            case '小双':
            var rate = yrates['zm4lmxiaoshuang'];
            break;
            case '合大':
            var rate = yrates['zm4lmheda'];
            break;
            case '合小':
            var rate = yrates['zm4lmhexiao'];
            break;
            case '合单':
            var rate = yrates['zm4lmhedan'];
            break;
            case '合双':
            var rate = yrates['zm4lmheshuang'];
            break;
            case '尾大':
            var rate = yrates['zm4lmweida'];
            break;
            case '尾小':
            var rate = yrates['zm4lmweixiao'];
            break;
            case '家禽':
            var rate = yrates['zm4lmjiaqin'];
            break;
            case '野兽':
            var rate = yrates['zm4lmyeshou'];
            break;
            case '红波':
            var rate = yrates['zm4lmhongbo'];
            break;
            case '绿波':
            var rate = yrates['zm4lmlvbo'];
            break;
            case '蓝波':
            var rate = yrates['zm4lmlanbo'];
            break;
          }
        }else if(_thisPlayid == 'zm5lm'){
          switch(currNumber){
            case '大':
            var rate = yrates['zm5lmda'];
            break;
            case '小':
            var rate = yrates['zm5lmxiao'];
            break;
            case '单':
            var rate = yrates['zm5lmdan'];
            break;
            case '双':
            var rate = yrates['zm5lmshuang'];
            break;
            case '大单':
            var rate = yrates['zm5lmdadan'];
            break;
            case '大双':
            var rate = yrates['zm5lmdashuang'];
            break;
            case '小单':
            var rate = yrates['zm5lmxiaodan'];
            break;
            case '小双':
            var rate = yrates['zm5lmxiaoshuang'];
            break;
            case '合大':
            var rate = yrates['zm5lmheda'];
            break;
            case '合小':
            var rate = yrates['zm5lmhexiao'];
            break;
            case '合单':
            var rate = yrates['zm5lmhedan'];
            break;
            case '合双':
            var rate = yrates['zm5lmheshuang'];
            break;
            case '尾大':
            var rate = yrates['zm5lmweida'];
            break;
            case '尾小':
            var rate = yrates['zm5lmweixiao'];
            break;
            case '家禽':
            var rate = yrates['zm5lmjiaqin'];
            break;
            case '野兽':
            var rate = yrates['zm5lmyeshou'];
            break;
            case '红波':
            var rate = yrates['zm5lmhongbo'];
            break;
            case '绿波':
            var rate = yrates['zm5lmlvbo'];
            break;
            case '蓝波':
            var rate = yrates['zm5lmlanbo'];
            break;
          }
        }else if(_thisPlayid == 'zm6lm'){
          switch(currNumber){
            case '大':
            var rate = yrates['zm6lmda'];
            break;
            case '小':
            var rate = yrates['zm6lmxiao'];
            break;
            case '单':
            var rate = yrates['zm6lmdan'];
            break;
            case '双':
            var rate = yrates['zm6lmshuang'];
            break;
            case '大单':
            var rate = yrates['zm6lmdadan'];
            break;
            case '大双':
            var rate = yrates['zm6lmdashuang'];
            break;
            case '小单':
            var rate = yrates['zm6lmxiaodan'];
            break;
            case '小双':
            var rate = yrates['zm6lmxiaoshuang'];
            break;
            case '合大':
            var rate = yrates['zm6lmheda'];
            break;
            case '合小':
            var rate = yrates['zm6lmhexiao'];
            break;
            case '合单':
            var rate = yrates['zm6lmhedan'];
            break;
            case '合双':
            var rate = yrates['zm6lmheshuang'];
            break;
            case '尾大':
            var rate = yrates['zm6lmweida'];
            break;
            case '尾小':
            var rate = yrates['zm6lmweixiao'];
            break;
            case '家禽':
            var rate = yrates['zm6lmjiaqin'];
            break;
            case '野兽':
            var rate = yrates['zm6lmyeshou'];
            break;
            case '红波':
            var rate = yrates['zm6lmhongbo'];
            break;
            case '绿波':
            var rate = yrates['zm6lmlvbo'];
            break;
            case '蓝波':
            var rate = yrates['zm6lmlanbo'];
            break;
          }
        }else if(_thisPlayid == 'tmbb'){
          switch(currNumber){
            case '红大':
            var rate = yrates['hongda'];
            break;
            case '红小':
            var rate = yrates['hongxiao'];
            break;
            case '红单':
            var rate = yrates['hongdan'];
            break;
            case '红双':
            var rate = yrates['hongshuang'];
            break;
            case '红合单':
            var rate = yrates['honghedan'];
            break;
            case '红合双':
            var rate = yrates['hongheshuang'];
            break;
            case '绿大':
            var rate = yrates['lvda'];
            break;
            case '绿小':
            var rate = yrates['lvxiao'];
            break;
            case '绿单':
            var rate = yrates['lvdan'];
            break;
            case '绿双':
            var rate = yrates['lvshuang'];
            break;
            case '绿合单':
            var rate = yrates['lvhedan'];
            break;
            case '绿合双':
            var rate = yrates['lvheshuang'];
            break;
            case '蓝大':
            var rate = yrates['landa'];
            break;
            case '蓝小':
            var rate = yrates['lanxiao'];
            break;
            case '蓝单':
            var rate = yrates['landan'];
            break;
            case '蓝双':
            var rate = yrates['lanshuang'];
            break;
            case '蓝合单':
            var rate = yrates['lanhedan'];
            break;
            case '蓝合双':
            var rate = yrates['lanheshuang'];
            break;
          }
        }else if(_thisPlayid == 'sxtx'){
          switch(currNumber){
            case '鼠':
            var rate = yrates['sxtxshu'];
            break;
            case '牛':
            var rate = yrates['sxtxniu'];
            break;
            case '虎':
            var rate = yrates['sxtxhu'];
            break;
            case '兔':
            var rate = yrates['sxtxtu'];
            break;
            case '龙':
            var rate = yrates['sxtxlong'];
            break;
            case '蛇':
            var rate = yrates['sxtxshe'];
            break;
            case '马':
            var rate = yrates['sxtxma'];
            break;
            case '羊':
            var rate = yrates['sxtxyang'];
            break;
            case '猴':
            var rate = yrates['sxtxhou'];
            break;
            case '鸡':
            var rate = yrates['sxtxji'];
            break;
            case '狗':
            var rate = yrates['sxtxgou'];
            break;
            case '猪':
            var rate = yrates['sxtxzhu'];
            break;
          }
        }else if(_thisPlayid == 'sx1x'){
          switch(currNumber){
            case '鼠':
            var rate = yrates['sx1xshu'];
            break;
            case '牛':
            var rate = yrates['sx1xniu'];
            break;
            case '虎':
            var rate = yrates['sx1xhu'];
            break;
            case '兔':
            var rate = yrates['sx1xtu'];
            break;
            case '龙':
            var rate = yrates['sx1xlong'];
            break;
            case '蛇':
            var rate = yrates['sx1xshe'];
            break;
            case '马':
            var rate = yrates['sx1xma'];
            break;
            case '羊':
            var rate = yrates['sx1xyang'];
            break;
            case '猴':
            var rate = yrates['sx1xhou'];
            break;
            case '鸡':
            var rate = yrates['sx1xji'];
            break;
            case '狗':
            var rate = yrates['sx1xgou'];
            break;
            case '猪':
            var rate = yrates['sx1xzhu'];
            break;
          }
        }else if(_thisPlayid == 'wstw'){
          switch(currNumber){
            case '0头':
            var rate = yrates['lingtou'];
            break;
            case '1头':
            var rate = yrates['yitou'];
            break;
            case '2头':
            var rate = yrates['ertou'];
            break;
            case '3头':
            var rate = yrates['santou'];
            break;
            case '4头':
            var rate = yrates['sitou'];
            break;
            case '0尾':
            var rate = yrates['lingwei'];
            break;
            case '1尾':
            var rate = yrates['yiwei'];
            break;
            case '2尾':
            var rate = yrates['erwei'];
            break;
            case '3尾':
            var rate = yrates['sanwei'];
            break;
            case '4尾':
            var rate = yrates['siwei'];
            break;
            case '5尾':
            var rate = yrates['wuwei'];
            break;
            case '6尾':
            var rate = yrates['luwei'];
            break;
            case '7尾':
            var rate = yrates['qiwei'];
            break;
            case '8尾':
            var rate = yrates['bawei'];
            break;
            case '9尾':
            var rate = yrates['jiuwei'];
            break;
          }
        }else{
          var rate = yrates[_thisPlayid];
        }

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
        'maxjj': rate.rate,
        'minjj': rate.minjj,
        'maxzs': rate.maxzs,
        'rate': rate.rate,
        //'beishu': parseInt(times),
        'yjf' : selectRmb
      }
      orderList.push(arr);
      console.log(orderList);
      if(thisClass){
        $('.lhcTSelectNumber').find('.text-ellipsis').text(Numbers);
        $('.lhcTSelectNumber').find('.lhczhuMobile').text(zhushus.length);
      }else{
        var lhclmarr = currList();
        var lhclmarrHtml = '';
        for(var n = 0; n < lhclmarr.length; n++){
          lhclmarrHtml += lhclmarr[n] + ' ';
        }
        lhclmarrHtml = lhclmarrHtml.replace(/,/g,' ');
        $('.lhcTSelectNumber').find('.text-ellipsis').text(lhclmarrHtml);
        $('.lhcTSelectNumber').find('.lhczhuMobile').text(orderList.length);
      }
      currNumber = [];
      //zhushus = [];
      countMoney();
      countAll();  

    }else{
      $('.lhcTSelectNumber').find('.bet-money').hide();
      $('.lhcTSelectNumber').find('.bet-info-count').hide();
      oldMoneyText();
      orderList = [];
    }
    
  })

  function countFun(){
    switch(_thisPlayid){
      case 'tmzx': 
        zhushus.length = $('.g_Number_Section').find('.curr').length;
        break;
      case 'tmlm': case 'tmbb': case 'sxtx': case 'sx1x': case 'wstw':
        zhushus.length = 1;
        break;
      case 'zmrx': 
        zhushus.length = $('.g_Number_Section').find('.curr').length;
        break;
      case 'zm1t': case 'zm2t': case 'zm3t': case 'zm4t': case 'zm5t': case 'zm6t': 
        zhushus.length = $('.g_Number_Section').find('.curr').length;
        break;
      case 'zm1lm': case 'zm2lm': case 'zm3lm': case 'zm4lm': case 'zm5lm': case 'zm6lm': 
        zhushus.length = 1;
        break;
      case 'lm2qz': case 'lm2zt': case 'lmtc': case 'sx2xl': case 'ws2wl':
        zhushus = combine(currNumber[0],2);
        break;
      case 'lm3qz': case 'lm3z2': case 'sx3xl': case 'ws3wl':
        zhushus = combine(currNumber[0],3);
        break;
      case 'sx4xl': case 'ws4wl':
        zhushus = combine(currNumber[0],4);
        break;
      case 'bz5bz':
        zhushus = combine(currNumber[0],5);
        break;
      case 'bz6bz':
        zhushus = combine(currNumber[0],6);
        break;
      case 'bz7bz':
        zhushus = combine(currNumber[0],7);
        break;
      case 'bz8bz':
        zhushus = combine(currNumber[0],8);
        break;
      case 'bz9bz':
        zhushus = combine(currNumber[0],9);
        break;
      case 'bz10bz':
        zhushus = combine(currNumber[0],10);
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
    betinfoclear();
    switch(_thisType){
      case 'tmzx':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码中包含特码，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'tmlm':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('开奖号码最后一位为特码。大于或等于25为特码大，小于或等于24为特码小；奇数为单，偶数为双；特码两个数相加后得数，奇数为合单，偶数为合双，小于等于6为合小，大于6为合大；尾大尾小即看特码个位数值，小于等于4为小，大于4为大；特码为49时为和，不算任何大小单双，但算波色。');
        lhclmgameNumber(lhc_tmlm_content,rates.rate);
        break;
      case 'zmrx':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码在开奖号码前六位中存在，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'zm1t':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第一位相同，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'zm1lm':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('开奖号码第一位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。');
        lhclmgameNumber(lhc_tmlm_content,rates.rate);
        break;
      case 'zm2t':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第二位相同，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'zm2lm':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('开奖号码第二位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。');
        lhclmgameNumber(lhc_tmlm_content,rates.rate);
        break;
      case 'zm3t':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第三位相同，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'zm3lm':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('开奖号码第三位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。');
        lhclmgameNumber(lhc_tmlm_content,rates.rate);
        break;
      case 'zm4t':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第四位相同，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'zm4lm':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('开奖号码第四位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。');
        lhclmgameNumber(lhc_tmlm_content,rates.rate);
        break;
      case 'zm5t':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第五位相同，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'zm5lm':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('开奖号码第五位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。');
        lhclmgameNumber(lhc_tmlm_content,rates.rate);
        break;
      case 'zm6t':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码与开奖号码第六位相同，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'zm6lm':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('开奖号码第六位，大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；和单和双为两个数相加后得数的单双；尾大尾小即看个位数值，小于等于4为小，大于4为大；为49时为和，不算任何大小单双，但算波色。');
        lhclmgameNumber(lhc_tmlm_content,rates.rate);
        break;
      case 'lm3qz':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择三个号码，每三个号码为一组合，若三个号码都是开奖号码之正码，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'lm3z2':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择三个号码，每三个号码为一组合，若其中至少有两个是开奖号码中的正码，即为中奖。若中两码，叫三中二之中二;若三码全中，叫三中二之中三。 <span class="mobileMoneyInfo">奖金详情</span>');
        var caizhong = ['中二','中三'];
        addMoneyInfo(caizhong,rates.rate);
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'lm2qz':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择两个号码，每二个码号为一组合，二个号码都是开奖码号之正码（不含特码），即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'lm2zt':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择两个号码，每二个号码为一组合，二个号码都是开奖号码（含特码），即为中奖。若两个都是正码，叫二中特之二中。若选号中包含特码，叫二中特之中特。 <span class="mobileMoneyInfo">奖金详情</span>');
        var caizhong = ['二中','中特'];
        addMoneyInfo(caizhong,rates.rate);
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'lmtc':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择两个号码，每二个号码为一组合，其中一个是正码，一个是特别号码，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'tmbb':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('根据特码对应的特性来区分。分为红蓝绿三个波色，以及号码大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；合单合双为开奖号的十位与个位相加后得数的单双。下注内容与号码特性完全吻合即为中奖。');
        lhclmgameNumber(lhc_tmbb_content,rates.rate);
        break;
      case 'sxtx':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从十二生肖中任选1个或多个，每个生肖为一注，所选生肖与特码对应的生肖相同，即为中奖。');
        lhclmgameNumber(lhc_sxtx_content,rates.rate);
        break;
      case 'sx1x':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从十二生肖中任选1个或多个，每个生肖为一注，开奖号码（含特码）中含有投注所属生肖，即为中奖。');
        lhclmgameNumber(lhc_sxtx_content,rates.rate);
        break;
      case 'sx2xl':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择两个生肖，每二个生肖为一组合，开奖号码（含特码）中含有投注所属全部生肖，即为中奖。 <span class="mobileMoneyInfo">奖金详情</span>');
        var caizhong = ['含本命','不含本命'];
        addMoneyInfo(caizhong,rates.rate);
        lhclmgameNumber(lhc_sxtx_content,rates.rate);
        break;
      case 'sx3xl':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择三个生肖，每三个生肖为一组合，开奖号码（含特码）中含有投注所属全部生肖，即为中奖。 <span class="mobileMoneyInfo">奖金详情</span>');
        var caizhong = ['含本命','不含本命'];
        addMoneyInfo(caizhong,rates.rate);
        lhclmgameNumber(lhc_sxtx_content,rates.rate);
        break;
      case 'sx4xl':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择四个生肖，每四个生肖为一组合，开奖号码（含特码）中含有投注所属全部生肖，即为中奖。 <span class="mobileMoneyInfo">奖金详情</span>');
        var caizhong = ['含本命','不含本命'];
        addMoneyInfo(caizhong,rates.rate);
        lhclmgameNumber(lhc_sxtx_content,rates.rate);
        break;
      case 'wstw':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('选择特码头（十位）尾（个位）的数字进行投注，与特码相同，即为中奖');
        lhclmgameNumber(lhc_wstw_content,rates.rate);
        break;
      case 'ws2wl':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择两个尾数，每两个尾数为一组合，开奖号码（含特码）中含有投注对应全部尾数，即为中奖。 <span class="mobileMoneyInfo">奖金详情</span>');
        var caizhong = ['含0尾','不含0尾'];
        addMoneyInfo(caizhong,rates.rate);
        lhclmgameNumber(lhc_wstw_content1,rates.rate);
        break;
      case 'ws3wl':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择三个尾数，每三个尾数为一组合，开奖号码（含特码）中含有投注对应全部尾数，即为中奖。 <span class="mobileMoneyInfo">奖金详情</span>');
        var caizhong = ['含0尾','不含0尾'];
        addMoneyInfo(caizhong,rates.rate);
        lhclmgameNumber(lhc_wstw_content1,rates.rate);
        break;
      case 'ws4wl':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择四个尾数，每四个尾数为一组合，开奖号码（含特码）中含有投注对应全部尾数，即为中奖。 <span class="mobileMoneyInfo">奖金详情</span>');
        var caizhong = ['含0尾','不含0尾'];
        addMoneyInfo(caizhong,rates.rate);
        lhclmgameNumber(lhc_wstw_content1,rates.rate);
        break;
      case 'bz5bz':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择五个号码，每五个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'bz6bz':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择六个号码，每六个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'bz7bz':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择七个号码，每七个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'bz8bz':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择八个号码，每八个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'bz9bz':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择九个号码，每九个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'bz10bz':
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择十个号码，每十个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
    }

    var menu0 = $('.play_select_tit').find('.curr').text();
    var menu2 = $('#bet_filter').find('.curr').text();
    $('.gameType').find('string').text(menu0+menu2);
    $('.bet_filter_box').hide();
    $('.play_select_insert').hide();
    $('.ymask').hide();
  })
  
  function addMoneyInfo(text,money) {

    
    if($('.mobileMoneyHover').length > 0 ){
      $('.mobileMoneyHover').remove();
    }
    var html = '<div class="mobileMoneyHover">'+
        '<table class="moneyInfoTable" >'+
        '<tr>'+
        '<th>猜中</th>'+
        '<th>单注最高奖金</th>'+
        '</tr>';

    var moneyList = money.split('|');
    for(var i in text){
      html += '<tr><th>'+text[i]+'</th><th class="lhcaddMoneyInfo">'+moneyList[i]+'</th></tr>';
    }
    html += '<tr><th colspan="2" class="mobileMoneyHoverClose">确认</th></tr></table></div>';
    console.log(html);
    $('body').append(html);

  }

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
        var boxNumber = $('<div class="selectNumbers" style=""></div>');
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
    
    if(zhushus.length >= 1){

    addNumberLanAn();

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
    
      yBetting.each(function (i) {
        var gameNumber = $(this).find('.number em').text();
        if(_thisPlayid == 'dxdsqe' || _thisPlayid == 'dxdshe' || _thisPlayid == 'dxdsqs' || _thisPlayid == 'dxdshs'){
          gameNumber = gameNumber.replace(/大/g,'0');
          gameNumber = gameNumber.replace(/小/g,'1');
          gameNumber = gameNumber.replace(/单/g,'2');
          gameNumber = gameNumber.replace(/双/g,'3');
        }
        var gameNumberType = $(this).find('.number .yBettingType').text();
        var _thisType = '['+menu0+','+menu1+','+menu2+']';
        var _thisRmb = $(this).find('.rmb').text();
        console.log(gameNumberType == _thisType,gameNumberType, _thisType)
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
          'maxjj': rate.rate,
          'minjj': rate.minjj,
          'maxzs': rate.maxzs,
          'rate': rate.rate,
          'beishu': parseInt(times),
          'yjf' : selectRmb
        }
        orderList.push(arr);
        if(_thisPlayid == 'dxdsqe' || _thisPlayid == 'dxdshe' || _thisPlayid == 'dxdsqs' || _thisPlayid == 'dxdshs'){
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
        if(oprice <= 0){
          alt('请填写您要投注的金额',-1);
          return false;
        }
        var cur_number = cur_order.number;
        Orderdetailtotalprice += oprice;
        if(_thisPlayid == 'dxdsqe' || _thisPlayid == 'dxdshe' || _thisPlayid == 'dxdsqs' || _thisPlayid == 'dxdshs'){
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
    betinfoclear();
    switch(this_attr){
      case 'lhc_tm':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),lhc_tmzx_title,lhc_tmzx_arr);
        _thisPlayid = 'tmzx';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码中包含特码，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'lhc_zm':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),lhc_zmrx_title,lhc_zmrx_arr);
        _thisPlayid = 'zmrx';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从1-49中任选1个或多个号码，每个号码为一注，所选号码在开奖号码前六位中存在，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'lhc_lm':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),lhc_lm3qz_title,lhc_lm3qz_arr);
        _thisPlayid = 'lm3qz';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择三个号码，每三个号码为一组合，若三个号码都是开奖号码之正码，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
      case 'lhc_bb':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),lhc_tmbb_title,lhc_tmbb_arr);
        _thisPlayid = 'tmbb';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('根据特码对应的特性来区分。分为红蓝绿三个波色，以及号码大于或等于25为大，小于或等于24为小；奇数为单，偶数为双；合单合双为开奖号的十位与个位相加后得数的单双。下注内容与号码特性完全吻合即为中奖。');
        lhclmgameNumber(lhc_tmbb_content,rates.rate);
        break;
      case 'lhc_sx':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),lhc_sxtx_title,lhc_sxtx_arr);
        _thisPlayid = 'sxtx';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('从十二生肖中任选1个或多个，每个生肖为一注，所选生肖与特码对应的生肖相同，即为中奖。');
        lhclmgameNumber(lhc_sxtx_content,rates.rate);
        break;
      case 'lhc_ws':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),lhc_wstw_title,lhc_wstw_arr);
        _thisPlayid = 'wstw';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('选择特码头（十位）尾（个位）的数字进行投注，与特码相同，即为中奖');
        lhclmgameNumber(lhc_wstw_content,rates.rate);
        break;
      case 'lhc_bz':
        $('#bet_filter').remove();
        gameSwitch($('.bet_filter_box'),lhc_bz5bz_title,lhc_bz5bz_arr);
        _thisPlayid = 'bz5bz';
        rates = yrates[_thisPlayid];
        $('.play_select_prompt').find('span[way-data="tabDoc"]')
          .html('至少选择五个号码，每五个号码为一注，所有号码均未在开奖号码中出现，即为中奖。 赔率 <em style="color:red;">'+rates.rate+'</em>元');
        lhcgameNumber(lhc_tmzx_num);
        break;
    }
    var menu0 = $('.play_select_tit').find('.curr').text();
    var menu2 = $('#bet_filter').find('.curr').text();
    $('.gameType').find('string').text(menu0+menu2);
    addAndSubtract(string);
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

    if(_thisPlayid == 'sxhhzxq' || _thisPlayid == 'sxhhzxz' || _thisPlayid == 'sxhhzxh'){
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

    if(_thisPlayid == 'qszsds' || _thisPlayid == 'zszsds' || _thisPlayid == 'hszsds'){

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

    if(_thisPlayid == 'qszlds' || _thisPlayid == 'zszlds' || _thisPlayid == 'hszlds'){

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

    if(_thisPlayid == 'exzuxdsq' || _thisPlayid == 'exzuxdsh'){
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
  
  function lhclmgameNumber(arr,beis){
    var box = $('.g_Number_Section');
    var boxList = $('<div class="selectNumbers lhclm" style="padding: 0 25px;overflow: hidden;"></div>');
    var beisArr = beis.split('|');
    if(_thisPlayid == 'tmbb' || _thisPlayid == 'sxtx' ||　_thisPlayid == 'sx1x'){
      for(var j = 0; j < arr.length; j++){
        var tmbbArr = arr[j].split('|');
        boxList.append('<div style="width: 97px;margin: 8px 5px;display: inline-block;float: left;border: 1px solid #dfdfdf;border-radius: 3px;background: #faf9f6;">'+
          '<a href="javascript:void(0);" style="color: #333;border:none;width: 100%;margin: 0;" class="selectNumber lhctmbbselectNumber" data-number="'+tmbbArr[0]+'">'+tmbbArr[0]+
          '<div class="lmbbNumber" style="font-size: 10px;color: #dc3b40;">赔率<em>'+beisArr[j]+'</em></div></a>'+
          '<span class="lhclmPeil" style="font-size: 10px;color: #888;display: block;text-align: center;margin-top: 5px;">'+tmbbArr[1]+'</span>'+
        '</div>');
      }
    }else if(_thisPlayid == 'sx2xl' || _thisPlayid == 'sx3xl' ||　_thisPlayid == 'sx4xl'){
      for(var j = 0; j < arr.length; j++){
        var tmbbArr = arr[j].split('|');
        boxList.append('<div style="width: 97px;margin: 8px 5px;display: inline-block;float: left;border: 1px solid #dfdfdf;border-radius: 3px;background: #faf9f6;">'+
          '<a href="javascript:void(0);" style="color: #333;border:none;width: 100%;margin: 0;"  class="selectNumber lhctmbbselectNumber" data-bg="lhc_sx_bg" data-number="'+tmbbArr[0]+'">'+tmbbArr[0]+
          '<div class="lmbbNumber"  style="font-size: 10px;color: #888;">'+tmbbArr[1]+'</div></a>'+
        '</div>');
      }
    }else if(_thisPlayid == 'ws2wl' || _thisPlayid == 'ws3wl' ||　_thisPlayid == 'ws4wl'){
      for(var j = 0; j < arr.length; j++){
        boxList.append('<div style="width: 60px;margin: 8px 10px;display: inline-block;float: left;text-align: center;">'+
          '<a href="javascript:void(0);" style="width: 58px;" class="selectNumber lhclmselectNumber" data-bg="lhc_ws_bg" data-number="'+arr[j]+'">'+arr[j]+'</a>'+
        '</div>');
      }
    }else{
      for(var j = 0; j < arr.length; j++){
        boxList.append('<div style="width: 60px;margin: 8px 10px;display: inline-block;float: left;text-align: center;">'+
          '<a href="javascript:void(0);" style="width: 58px;" class="selectNumber lhclmselectNumber" data-number="'+arr[j]+'">'+arr[j]+'</a>'+
          '<span class="lhclmPeil" style="font-size: 10px;background: none;color: #333 !important;">赔率<em>'+beisArr[j]+'</em></span>'+
        '</div>');
      }
    }
    box.append(boxList);
  }

  //添加game号码区
  function lhcgameNumber(arr){
    var box = $('.g_Number_Section');
    var lhcstr = '';
    var lhcNumberData = null;
    for(var i = 0;i<arr.length;i++){
      var boxList = $('<div class="selectNmuverBox"></div>');
      var boxNumber = $('<div class="selectNumbers" style="overflow: hidden;text-align: left;"></div>');
      boxList.append('<span class="numberTitle">'+arr[i]+'</span>');
      boxList.append(boxNumber);


      for(var j = 1;j<50;j++){
        if(j < 10){
          lhcstr = '0' + j;
          lhcNumberData = eval('lhc_numData.lhc_'+lhcstr);
          boxNumber.append('<a href="javascript:void(0);" class="selectNumber lhc_'+lhcNumberData.bo+'_color" data-bg="lhc_'+lhcNumberData.bo+'_bg" data-number="'+lhcstr+'">'+lhcstr+'</a>');
        }else{
          lhcstr = j;
          lhcNumberData = eval('lhc_numData.lhc_'+lhcstr);
          boxNumber.append('<a href="javascript:void(0);" class="selectNumber lhc_'+lhcNumberData.bo+'_color" data-bg="lhc_'+lhcNumberData.bo+'_bg" data-number="'+lhcstr+'">'+lhcstr+'</a>');
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
    inputVal = isNaN(parseInt($('.selectMultipInput').val()))?1:parseInt($('.selectMultipInput').val());
    if(_thisPlayid == 'dxdsqe' || _thisPlayid == 'dxdshe' || _thisPlayid == 'dxdsqs' || _thisPlayid == 'dxdshs'){
      maxbeishu = 100000;
    }else{
      maxbeishu = 10000;
    }
    if(inputVal <= 1){
      $('.selectMultipInput').val(1);
      $('.reduce').addClass('noReduce');
    }
    if(inputVal > maxbeishu){
      $('.selectMultipInput').val(maxbeishu);
      $('.reduce').removeClass('noReduce');
      $('.selectMultiple .add').addClass('noReduce');
      return;
    }
    if('+' == string){
      inputVal++;
      if(inputVal >= maxbeishu){
        $('.selectMultipInput').val(maxbeishu);
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
    if(inputVal > 1 && inputVal < maxbeishu){
      $('.reduce').removeClass('noReduce');
    }
    if(inputVal < maxbeishu){
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
    var currTimes = isNaN(parseInt($('.bet_money_input').val()))?0:parseInt($('.bet_money_input').val());
    var toTal = currZhushu * currTimes;
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