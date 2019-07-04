<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$webheadertitle}</title>
<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=none">
<link rel="shortcut icon" href="/favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit" />
<link rel="stylesheet" href="__CSS__/amazeui.min.css">
<link rel="stylesheet" href="__CSS__/common2.css"> 
<link rel="stylesheet" href="__CSS__/index.css">
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/reset.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/layout.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/font-awesome.min.css" />

<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/icons.css">
<!--<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/k3.css" />-->
<!--<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/bootstrap.min.css">
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/resets.css">
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/icons.css">
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/style.css">
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/main.css">
<link rel="stylesheet" href="__CSS__/common.css">-->
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/ssc.css">
<script>
var WebConfigs = {
	webtitle:"{$webconfigs.webtitle}",
	kefuthree:"{$webconfigs.kefuthree}",
	kefuqq:"{$webconfigs.kefuqq}",
	ROOT : "__ROOT__"
};
</script>
<script>
<?php echo "var k3lotteryrates = ".json_encode($rates,JSON_UNESCAPED_UNICODE);?>
</script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
<!--[if lt IE 9]>
<script src="__ROOT__/resources/js/html5shiv.js"></script>
<![endif]-->

</head>

<body>
 
<style>	

</style>
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery.history.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/index.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/member.page.js"></script>
<script type="text/javascript" src="__ROOT__/Template/Mobile/js/tabGameData.js"></script>
<script type="text/javascript" src="__ROOT__/Template/Mobile/js/pl3.js"></script>
<script type="text/javascript" src="__ROOT__/Template/Mobile/js/pl3tabGame.js"></script>
<!--<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>-->
<script src="__JS__/require.js" data-main="__JS__/main"></script>
<script>
	var lotteryinfo = <?php echo json_encode($nowcpinfo,JSON_UNESCAPED_UNICODE);?>;
</script>
<section class="" id="gamepage">
  <div class="mobileGameTop">
    <header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed" style="background:#000;">
      <div class="am-header-left am-header-nav">
          <a href="/" class="">
              <i class="iconfont icon-shouyeshouye1"></i>
          </a>
      </div>
      <h1 class="am-header-title userHome_h1" style="margin: 0 auto; width: 100%;">
          <em class="gameInfo">玩<br>法</em>
          <span class="gameType">
            <string>三星直选复式</string> 
            <i class="iconfont icon-sanjiaoxing"></i>
          </span>
      </h1>
      <div class="am-header-right am-header-nav">
			排列3
		</div>
  </header>
    <div class="play_select_insert" id="j_play_select">
			<ul class="play_select_tit" style="overflow:hidden;">
				<li lottery_code="fc3d_3x" class="curr">三星</li>
				<li lottery_code="fc3d_q2">前二</li>
				<li lottery_code="fc3d_h2">后二</li>
				<li lottery_code="fc3d_1x">一星</li>
				<li lottery_code="fc3d_dsds">大小单双</li>
			</ul>
			<!--玩法二级选项开始-->
				<div class="bet_filter_box" style="">
				
				</div>
				<!--玩法二级选项结束-->
		</div>
  </div>
	<div class="open_containers g_Time_Section">
        <!--彩种开奖倒计时-->
        <div class="cz_daojishi">
            <div class="open_issue">
				<span class="c_red" id="f_lottery_info_number" way-data="showExpect.currFullExpect">---</span>期投注截止
			</div>
            <div class="j_lottery_time" servertime="">
				<div class="shij">
                	<span way-data="gametimes.h">00</span>
                    :
                	<span way-data="gametimes.m">00</span>
                    :
                	<span way-data="gametimes.s">00</span>
                </div>
			</div>
        </div>
        <!--彩种开奖倒计时-->

        <!--彩种开奖号码-->
        <div class="cz_openNumb">

            <div class="open_issue" id="showTabel"><span class="c_red" way-data="showExpect.lastFullExpect" id="f_lottery_info_lastnumber" firstissueno="">---</span>期开奖号码<i class="iconfont icon-jiantouxia"></i></div>
            <div class="open_number">
                <input type="hidden" value="1,1,2" id="j_openNum"><!--开奖号码效果赋值-->
                <ol id="ssc_winning_sum">
					        <li class="ssc_winning_sum_gif" way-data="showExpect.openCode1"></li>
                    <li class="ssc_winning_sum_gif" way-data="showExpect.openCode2"></li>
                    <li class="ssc_winning_sum_gif" way-data="showExpect.openCode3"></li>
				        </ol>
            </div>
            <div class="block_container lishi">
              <table id="fn_getoPenGame" border="0px" cellpadding="0" cellspacing="0">
                  <colgroup>
                      <col width="93px" />
                      <col width="50px" />
                      <col width="40px" />
                      <col width="59px" />
                  </colgroup>
                  <thead>
                  <tr>
                      <th>期数</th>
                      <th>奖号</th>
                      <th>开奖时间</th>
                  </tr>
                  </thead>
                  <tbody class="tbody text-c">
                  <!--开奖期号-->
                  <!--开奖号码-->
                  <!--和值-->
                  <!--大小-->
                  <!--单双-->
                  </tbody>
              </table>
          </div>
        </div>
        <!--彩种开奖号码-->
    </div>
    
	<div class="lottery_playContainer">

		
	
  
    <section id="gameBet" class="cl">
		<section class="gameBet_balls">
			<div class="gameBet_left l">
			<if condition="$nowcpinfo['iswh'] eq 0">
				
				<!--玩法详细说明区域-->
				<div class="play_select_prompt">
					<i class="iconfont c_org"></i>
					<span way-data="tabDoc"></span>
				</div>
				<div class="g_Number_Section" >
				</div>
				<div class="selectMultiple">
          <div class="selectMultipleT" id="selectMultipleTId">
            <div class="selectMultipleNumber">
              <i class="reduce">-</i>
              <input type="tel" value="1" class="selectMultipInput" onKeypress="return (/[\d]/.test(String.fromCharCode(event.keyCode)))">
              <i class="add">+</i>
            </div>
            倍
            <select class="selectMultipleCon">
              <option value="1">元</option>
              <option value="0.1">角</option>
              <option value="0.01">分</option>
            </select>
          </div>
          <div class="selectMultipleB addtobetbtn">
						<span class="lanIconNumber" id="lanIconNumberss">
							1
						</span>
						<div class="addIcon" id="addIconId">
							+
						</div>
            <span class="select_zhushu">
              共
              <em class="zhushu">0</em>
              注,
            </span>
            <span class="selectMultipleOld">
              共
              <em class="selectMultipleOldMoney">
                0.00
              </em>
              元
            </span>
						<div class="selectMultipleB_n" id="selectMultipleB_nId">
							
						</div>
          </div>
					<div class="selectMultipleLz" id="selectMultipleLz_show">
						<span class="lanIconNumber" id="lanIconNumbere">
							0
						</span>
						<i class="iconfont icon-lanzi"></i>
						<a href="javascript:void(0);" class="selectMultipleLz_a">号码篮</a>
					</div>
						
				</div>
				<!--玩法详细说明区域-->
				<div class="numberLan" style="display: none;">
					<header data-am-widget="header" class="am-header am-header-default header nav_bg am-header-fixed am-no-layout">
						<div class="am-header-left am-header-nav">
								<a href="javascript:void(0);" class="" style="text-decoration:none;">
										<i class="iconfont icon-arrow-left"></i>
								</a>
						</div>
						<h1 class="am-header-title userHome_h1" style="margin: 0 auto; width: 100%;font-size: 20px;">
								号码篮
						</h1>
					</header>
					<div class="randomBox">
						<div class="random">
							<a class="randomBtn random1">+ 机选1注</a>
							<a class="randomBtn random5">+ 机选5注</a>
							<a class="randomBtn closeNumberlan">+ 继续选号</a>
						</div>
					</div>
						<div class="xiad-left">
							<dl class="yBettingLists">
								
							</dl>
							<div class="mo_empty" id="orderlist_clear">
								清空单号
							</div>
						</div>     
						<!--<div class="g_Chase_Section">
							<div class="chase_Program">
								<p class="p_chase">方案注数
									<i class="c_green fw_600" way-data="ytotal_money_zhushu" id="f_gameOrder_lotterys_num">0</i> 注， 
									金额 <i class="c_org fw_600">¥<em id="f_gameOrder_amount" way-data="ytotal_money">0</em></i> 元  
								</p>
							</div>
						</div>   
						<div class="xiad-righ">
							<ul>
								<li class="li22"><span id="f_submit_order" style="cursor: pointer;">
									<img src="__ROOT__/resources/images/icon/icon_06.png">&nbsp;&nbsp;确认投注</span>
								</li>
								<li class="li22 li23"><span id="orderlist_clear" style="cursor: pointer;">
									<img src="__ROOT__/resources/images/icon/icon_19.png">&nbsp;&nbsp;清空单号</span>
								</li>
							</ul>
						</div>-->


				<div class="selectMultiple">
          <div class="selectMultipleB" style="padding-left: 10px;">
            <span class="selectMultipleOld">
              <div class="g_Chase_Section">
								<div class="chase_Program">
									<p class="p_chase">方案
										<i class="c_green fw_600" way-data="ytotal_money_zhushu" id="f_gameOrder_lotterys_num">0</i>注， 
										<em id="f_gameOrder_amount" way-data="ytotal_money">0</em></i> 元  
									</p>
								</div>
						</div>
            </span>
						<div style="font-size: 14px;color: #a9a9a9;">
							普通投注
						</div>
          </div>
					<div class="selectMultipleLz" style="background:#dc3b40">
						<span id="f_submit_order"  style="font-size: 18px;color: #fff;">
							立即投注
						</span>
					</div>
						
				</div>
				</div>
			<else />
			<img src="__ROOT__/resources/images/k3cpcz.png" />
			</if>
			</div>
		
		</section>
    </section>
</section>
</div>




<include file="public/footer" />
<div id="getBillInfobox" style="display:none">
<div class="submitComfire">
<ul class="ui-form">
<li style="width:50%; float:left"><label for="question1" class="ui-label">彩种：</label><span class="mark" way-data="BillInfo.cptitle">--</span></li>
<li style="width:50%; float:left"><label for="question1" class="ui-label">期号：</label><span class="mark">第 <span way-data="BillInfo.expect" class="mark">--</span> 期</span></li>	
<li style="width:50%; float:left"><label for="question1" class="ui-label">玩法：</label><span class="mark" way-data="BillInfo.playtitle">--</span></li>
<li style="width:50%; float:left"><label for="question1" class="ui-label">赔率：</label><span way-data="BillInfo.mode" class="mark">--</span></li>	
<li><label for="answer1" class="ui-label">投注号码：</label><span class="mark" way-data="BillInfo.tzcode">--</span></li>	
<li style="width:50%; float:left"><label for="question2" class="ui-label">单注金额：</label><span class="mark" way-data="BillInfo.amount">--</span></li><li style="width:50%; float:left"><label for="question2" class="ui-label">投注注数：</label><span class="mark" way-data="BillInfo.itemcount">--</span></li>
<li style="width:50%; float:left"><label for="question2" class="ui-label">中奖金额：</label><span class="mark" way-data="BillInfo.okamount">--</span></li><li style="width:50%; float:left"><label for="question2" class="ui-label">中奖注数：</label><span class="mark" way-data="BillInfo.okcount">--</span></li>


<li style="width:50%; float:left"><label for="question2" class="ui-label">开奖号码：</label><span class="mark" way-data="BillInfo.opencode">--</span></li><li style="width:50%; float:left"><label for="question2" class="ui-label">中奖状态：</label><span id="BillInfo_isdraw" way-data="BillInfo.state">--</span></li>
</ul>
</div>
</div>
<div id="submitComfirebox" style="display:none">
    <div class="submitComfire">
		<ul class="ui-form">
			<li>
				<label for="question1" class="ui-label">彩种：</label>
				<span class="ui-text-info" way-data="showExpect.shortname">--</span>
			</li>
			<li>
				<label for="question1" class="ui-label">期号：</label>
				<span class="ui-text-info">第 <span way-data="showExpect.currFullExpect" class="mark">---</span> 期</span>
			</li>		
			<li>
				<label for="answer1" class="ui-label">详情：</label>
				<div id="Orderdetaillist" class="textarea" style="font-size:12px;"></div>		
			</li>		
			<li>
				<label for="question2" class="ui-label">付款总金额：</label>
				<span class="ui-text-info"><span id="Orderdetailtotalprice" class="mark">0.00</span>元</span>
			</li>		
			<li>
				<label for="question2" class="ui-label">付款帐号：</label>
				<span way-data="user.username" class="ui-text-info mark">---</span>
			</li>	
		</ul>	
		<p class="text-note">	</p>	<p class="text-note">	</p>
	</div>
</div>
<script>
	function openwindow(url,name,iWidth,iHeight) {
		var url; //转向网页的地址;
		var name; //网页名称，可为空;
		var iWidth; //弹出窗口的宽度;
		var iHeight; //弹出窗口的高度;
		//window.screen.height获得屏幕的高，window.screen.width获得屏幕的宽
		var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;
		var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;
		window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
	}
	//玩法说明
	$('.helps').click(function () {
		openwindow("{:U('Game/howtoplay', array('name'=>$nowcpinfo['name'],'cz'=>ACTION_NAME))}",'',1058,870);
	})
  $(document).on('click','.gameType',function (){
    if($('.play_select_insert').is(':hidden')){
      $(this).find('.icon-sanjiaoxing').css('transform','rotate(360deg)');
      $('#j_play_select').show();
      $('.bet_filter_box').show();
			$('.ymask').show();
    }else{
			$(this).find('.icon-sanjiaoxing').css('transform','rotate(180deg)');
      $('#j_play_select').hide();
      $('.bet_filter_box').hide();
			$('.ymask').hide();
    }
  })

	$(document).on('click','.ymask',function (){
		$('#j_play_select').hide();
		$('.bet_filter_box').hide();
		$('.ymask').hide();
	})

  $(document).on('click','#showTabel',function (){
    
    if($('.lishi').is(':hidden')){
      $('.lishi').show();
    }else{
      $('.lishi').hide();
    }
  })

	
	$(document).on('click','#selectMultipleLz_show',function (){
		$(document).scrollTop(0);
		if($('.yBettingLists .yBettingList').length > 0){
			$('#orderlist_clear').show();
		}else{
			$('#orderlist_clear').hide();
		}
		$('.numberLan').show();
	})

	$(document).on('click','.numberLan .am-header-left , .closeNumberlan',function (){
		$('.numberLan').hide();
	})

</script>
<style>
	.looding{
		width:100%;
		height:200%;
		z-index: 999;
		background: rgba(0,0,0,0.7);
		position: absolute;
		color:#333;
		top:0;
		left:0;
		text-align:center
	}
	.looding span{
		z-index: 9999;
		background: #ffffff;
		text-align:center;
		font-size:20px;
		color:#000;
		display: block;
		width:200px;
		height:50px;
		line-height: 50px;
		border-radius: 5px;
		position: fixed;
		top: 50%;
		left: 50%;
		margin-top: -25px;
		margin-left: -100PX;
	}
</style>
<div class="looding"  style="display:none;">
	<span>正在处理数椐... <img src="__IMG__/addloading.gif" width="23" height="23" alt=""></span>

</div>
<div class="am-modal-actions  am-modal-active" id="my-actions" style="display:none;">
		<div class="am-modal-actions-group">
			<ul class="am-list">
				<volist name="ssclist" id="vo">
					<li class="<if condition="$vo['name'] eq $lotteryname">curr</if> am-modal-actions-header" lotteryname="{$vo.name}">
						<a href="__ROOT__/Game.dpc?code={$vo.name}" style="padding: 0;">{$vo.title}</a>
					</li>
				</volist>
				<!--<li class="am-modal-actions-header">重庆时时彩</li>
				<li class="am-modal-actions-header">天津时时彩</li>
				<li class="am-modal-actions-header">大发时时彩</li>
				<li class="am-modal-actions-header">新疆时时彩</li>-->
			</ul>
		</div>
		<div class="am-modal-actions-group">
			<button class="am-btn am-btn-secondary am-btn-block btn_red" data-am-modal-close="">取消</button>
		</div>
	</div>
  <div class="ymask" style="width: 100%;height: 100%;position:fixed;top:0;left:0;background: rgba(0,0,0,0.3);display:none;"></div>
</body>
</html>