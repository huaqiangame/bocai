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
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/reset.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/layout.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Template/Mobile/css/jquery.range.css" />
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/icon.css">
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
<script type="text/javascript" src="__ROOT__/Template/Mobile/js/jquery.range.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
</head>
<body>
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery.history.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/member.page.js"></script>
<script type="text/javascript" src="__ROOT__/Template/Mobile/js/tabGameData.js"></script>
<script type="text/javascript" src="__ROOT__/Template/Mobile/js/lhc.js"></script>
<script type="text/javascript" src="__ROOT__/Template/Mobile/js/lhctabGame.js"></script>
<!--<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<script src="__JS__/require.js" data-main="__JS__/main"></script>技术支持QQ:33723247【禁止非法运营赌博，谁充值赌博谁傻逼】-->
<script>
	var lotteryinfo = <?php echo json_encode($nowcpinfo,JSON_UNESCAPED_UNICODE);?>;

	//var lotteryinfo = {"id":"100","typeid":"lhc","title":"六合彩","ftitle":"全天120期","firsttime":"00:05:00","endtime":"00:00:00","qishu":"120","name":"lhc","ftime":"120","isopen":"1","issys":"0","closetime1":"00:00:00","closetime2":"00:00:00","expecttime":"1","iswh":"0","allsort":"6","listorder":"1"};

</script>
<section class="" id="gamepage">
  <div class="mobileGameTop">
<header data-am-widget="header" class="am-header am-header-default header am-header-fixed" >
      <div class="am-header-left am-header-nav">
          <a href="{:U('Index/lotteryHall')}" class="">
              <i class="iconfont icon-goucaidating"></i>
          </a>
      </div>
      <h1 class="am-header-title userHome_h1" style="margin: 0 auto; width: 100%;">
          <em class="gameInfo">玩<br>法</em>
          <span class="gameType">
            <string>特码</string> 
            <i class="iconfont icon-sanjiaoxing"></i>
          </span>
      </h1>
      <div class="am-header-right am-header-nav" style="top: 14px;">
			<a href="javascript:void(0);" id="showGameList" style="text-decoration:none;">
				<em class="bill_day">{$cptitle}</em>
				<i class="iconfont icon-jiantouxia"></i>
			</a>
		</div>
		<ul class="yGame_list">
			<volist name="ssclist" id="vo">
				<li class="<if condition="$vo['name'] eq $lotteryname">curr</if> am-modal-actions-header" lotteryname="{$vo.name}">
					<a href="__ROOT__/Game.lhc.code.{$vo.name}.do" style="padding: 0;">{$vo.title}</a>
				</li>
			</volist>
		</ul>
		 <div class="newcode">
            <div id="my_tz" class="mytz">我的投注<div class="activetz"></div></div>
            <div id="tz_jl" class="tzjl">投注记录<div ></div></div>
             <div id="ye" class="yue ">余额:<span class="smallmoney">{$userinfo['balance']}</span><div ></div></div>
	        <i class="iconfont icon-shuaxin am-fr my_home_refresh refresh_money" style="display: block;margin-top:1px;margin-right:5px;"></i>
            <div style="clear: both;"></div>
        </div>
        <div class="tz_read">
            <table border="0" class="newtable">
                <tr>
                    <th class="newtableth"style="width: 30%">投注单号</th>
                    <th class="newtableth"style="width: 30%">投注金额</th>
                    <th class="newtableth"style="width: 20%">奖金</th>
                    <th class="newtableth"style="width: 20%">操作</th>
                </tr>
            </table>
            <div id="query-result">
                <div id="jiaz" style="text-align: center;">

                </div>
            </div>
        </div>
  </header>
    <div class="play_select_insert" id="j_play_select">
			<ul class="play_select_tit" style="overflow:hidden;margin-top:75px;">
				<li lottery_code="lhc_tm" class="curr">特码</li>
				<li lottery_code="lhc_zm">正码</li>
				<li lottery_code="lhc_lm">连码</li>
				<li lottery_code="lhc_bb">半波</li>
				<li lottery_code="lhc_sx">生肖</li> 
				<li lottery_code="lhc_ws">尾数</li> 
				<li lottery_code="lhc_bz">不中</li> 
			</ul>
			<!--玩法二级选项开始-->
				<div class="bet_filter_box" style="">
				
				</div>
				<!--玩法二级选项结束-->
		</div>
  </div>
    <div class="page-group" style="bottom:48px;">
	<div class="open_containers g_Time_Section" style="height: 90px;">
        <!--彩种开奖倒计时-->
        <div class="cz_daojishi" style="width: 34%;height: 90px;">
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
                <ol id="lhc_winning_sum" style="height:48px">
					<li class="lhc_winning_sum_gif"><span way-data="showExpect.openCode1">0</span><span></span></li>
                    <li class="lhc_winning_sum_gif"><span way-data="showExpect.openCode2">0</span><span></span></li>
                    <li class="lhc_winning_sum_gif"><span way-data="showExpect.openCode3">0</span><span></span></li>
                    <li class="lhc_winning_sum_gif"><span way-data="showExpect.openCode4">0</span><span></span></li>
                    <li class="lhc_winning_sum_gif"><span way-data="showExpect.openCode5">0</span><span></span></li>
                    <li class="lhc_winning_sum_gif"><span way-data="showExpect.openCode6">0</span><span></span></li>
                    <li class="jiahao">+</li>
                    <li class="lhc_winning_sum_gif"><span way-data="showExpect.openCode7">0</span><span></span></li>
				</ol>
            </div>


            <div class="block_container lishi" style="top:90px;height:500%;">
              <table id="fn_getoPenGame" border="0px" cellpadding="0" cellspacing="0">
                  <colgroup>
                      <col width="93px" />
                      <col width="50px" />
                      <col width="40px" />
                      <col width="59px" />
                  </colgroup>
                  <thead style="box-shadow:0 1px 1px rgba(41,41,41,.08);width:100%;">
                  <tr>
                      <th style="width:30%;">期数</th>
                      <th>奖号</th>
                      <th style="width:20%;">开奖时间</th>
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
			  	<div class="recentBet" style="text-align:center;	background:#ccc39c;	height:45px;	line-height:42px;
	font-size:14px;">显示最近50期开奖记录</div>
          </div>
        </div>
        <!--彩种开奖号码-->
    </div>
    
	<div class="lottery_playContainer">

		
	
  
    <section id="gameBet" class="cl">
		<section class="gameBet_balls">
			<div class="gameBet_left l" style="margin-top:92px;">
			<if condition="$nowcpinfo['iswh'] eq 0">				
				<!--玩法详细说明区域-->
				<div class="play_select_prompt">
					<i class="iconfont c_org"></i>
					<span way-data="tabDoc"></span>
				</div>
				<div class="sliderConter">
					<table  style="height: 100%; border: 0px;">
						<tr>
							<td>
								<div class="peilu">
									<var style="color: rgb(202, 202, 202);">赔率</var><span id="amount">47.628</span>

								</div>
							</td> 
							<td style="padding-top: 8px;">
								<a  id="minus"></a>
							</td> 
							<td style="width: 100%;">
								<input type="hidden" class="single-slider" value="0" />	
							</td> 
							<td style="padding-top: 8px; ">
								<a  id="plus"></a>
							</td> 
							<td >
								<div class="fandian"><p style="display: inline-block; color: rgb(202, 202, 202);">返点</p> <p  style="display: inline-block;" class="fans">0.0</p>
								</div>	
						</tr>
					</table>
				</div>
				<div class="g_Number_Section" style="margin-bottom: 140px;">
				</div>
			<else />
			<img src="__ROOT__/resources/images/k3cpcz.png" />
			</if>
			</div>
		
		</section>
    </section>
</section>
				<div class="sscFooter lhcTSelectNumber">
					<div class="bet-money">
						<em >当前选号</em> 
						<span  class="text-ellipsis"></span>
					</div> 
					<div  class="bet-money">每注金额<input class="bet_money_input"  type="tel" maxlength="7" onKeypress="return (/[\d]/.test(String.fromCharCode(event.keyCode)))"> 
      			最高可中<span class="bet_win_money"></span>元
					</div> 
					<div  class="bet-info fix">
						<div  class="bet-info-left">
							<span  class="bet-info-clear">
								<i  class="iconfont"></i>清空
							</span> 
							<span  class="bet-info-count">共<em class="lhczhuMobile"></em>注,<em class="lhcmoneyMobile"></em>元</span>
						</div> 
					<div  class="bet-info-right">
						<button  class="bet-info-confirm" id="f_submit_order">马上投注</button>
					</div>
				</div>
				</div>
</div>
</div>




<div id="getBillInfobox" style="display:none">
<div class="submitComfire">
<ul class="ui-form">
<li style="width:50%; float:left"><label for="question1" class="ui-label">彩种：</label><span class="mark" way-data="BillInfo.cptitle">--</span></li>
<li style="width:50%; float:left"><label for="question1" class="ui-label">期号：</label><span class="mark">第 <span way-data="BillInfo.expect" class="mark">--</span> 期</span></li>	
<li style="width:50%; float:left"><label for="question1" class="ui-label">玩法：</label><span class="mark" way-data="BillInfo.playtitle">--</span></li>
<li style="width:50%; float:left"><label for="question1" class="ui-label">赔率：</label><span way-data="BillInfo.mode" class="mark">--</span></li>	
<li><label for="answer1" class="ui-label">投注号码：</label><span class="textarea" way-data="BillInfo.tzcode">--</span></li>	
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
				<div id="Orderdetaillist" class="textarea" style="font-size:12px;overflow: auto;"></div>		
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
    function Order_chedan(id,trano,obj){
        artDialog({
            content:'确定撤单吗',
            cancel:function(){},
            ok:function(){
                $.post('/Apijiekou.chedan',{'id':id,'trano':trano}, function(json){
                    if(json.sign==true){
                        //alt('撤单成功','success');
                        art.dialog({
                            time: 2,
                            content:'撤单成功',
                            lock:true
                        });
                        $(obj).html('<th style="color:grey;text-align: center;width: 20%">已撤单</th>');
                    }else{
                        alt(json.message);
                    }
                },'json');

            },
            lock:true
        })

    };
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
			$('.tz_read').hide();			
    }else{
			$(this).find('.icon-sanjiaoxing').css('transform','rotate(180deg)');
      $('#j_play_select').hide();
      $('.bet_filter_box').hide();
			$('.ymask').hide();
			if($('.page-group').is(':hidden')){
                $('.tz_read').show();
            }			
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
$("#tz_jl").click(function () {
        $(".page-group").hide();
		$(".bet-info").hide();
        $(".tz_read").show();
        $("#tz_jl div").addClass('activetz')
		$("#my_tz").css('color','#999999')
        $("#tz_jl").css('color','#fff')		
        $("#my_tz div").removeClass('activetz')
        var code = '{$code}';
        $.ajax({
            url: 'Game.tzlist.do',
            dataType: 'html',
            data: {code:code},
            cache: false,
            type: 'GET',
            beforeSend : function(){
                $('#jiaz').html('加载中....');
            },
            success: function (html) {
                $('#query-result').html(html);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('系统忙，请稍后再试！');
            }
        }) ;
    })

    $("#my_tz").click(function () {
        $(".page-group").show();
		$(".bet-info").show();
        $(".tz_read").hide();
        $("#my_tz div").addClass('activetz')
		$("#my_tz").css('color','#fff')
        $("#tz_jl div").removeClass('activetz')
		$("#tz_jl").css('color','#999999')
    })
	/**$(document).on('click','#selectMultipleLz_show',function (){
		$(document).scrollTop(0);
		if($('.yBettingLists .yBettingList').length > 0){
			$('#orderlist_clear').show();
		}else{
			$('#orderlist_clear').hide();
		}
	    $('.page-group').hide();
		$('.numberLan').show();
		$('.mobileGameTop').css('display','none');
	})

	$(document).on('click','.numberLan .am-header-left , .closeNumberlan',function (){
		$('.numberLan').hide();
			$('.mobileGameTop').css('display','block');	
		$('.page-group').show();			
	})**/

	$(document).on('click','#showGameList',function () {
		if($('.yGame_list').is(':hidden')){
      $(this).find('.icon-jiantouxia').css('transform','rotate(180deg)');
			$('.yGame_list').show();
    }else{
			$(this).find('.icon-jiantouxia').css('transform','rotate(360deg)');
			$('.yGame_list').hide();
    }
	})
	var ytext = $('.bill_day').text().substring(0,2);
	$('.bill_day').text(ytext);
	
    $('.refresh_money').click(function () {
        $.ajax({
            url:"{:U('Account/refreshmoney')}",
            type:'POST',
            success :function (data) {
                $('.smallmoney').html(data);
            }
        })
    })
	
	

</script>

<div class="looding"  style="display:none;">
	<span>正在处理数椐... <img src="__IMG__/addloading.gif" width="23" height="23" alt=""></span>

</div>
<!--<div class="am-modal-actions  am-modal-active" id="my-actions" style="display:none;">
		<div class="am-modal-actions-group">
			<ul class="am-list">
				<volist name="ssclist" id="vo">
					<li class="<if condition="$vo['name'] eq $lotteryname">curr</if> am-modal-actions-header" lotteryname="{$vo.name}">
						<a href="__ROOT__/Game.ssc?code={$vo.name}" style="padding: 0;">{$vo.title}</a>
					</li>
				</volist>
			</ul>
		</div>
		<div class="am-modal-actions-group">
			<button class="am-btn am-btn-secondary am-btn-block btn_red" data-am-modal-close="">取消</button>
		</div>
	</div>-->
  <div class="ymask" style="width: 100%;height: 100%;position:fixed;top:0;left:0;background: rgba(0,0,0,0.3);display:none;"></div>
</body>
</html>