<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{:GetVar('webtitle')}</title>
<meta name="renderer" content="webkit" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/k3.css" />
<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
<link rel="stylesheet" href="__CSS2__/icon.css">
<link rel="stylesheet" href="__CSS2__/header.css">
<link rel="stylesheet" href="__CSS__/style.css">
<link rel="stylesheet" href="__CSS2__/main.css">
<link rel="stylesheet" href="__CSS__/common.css">
<link rel="stylesheet" href="__CSS2__/ssc.css">
<link rel="stylesheet" href="__CSS__/gameOther.css">
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
	.j_lottery_time .shij span{
		color: #fff;
		font-size: 36px;
	}
</style>
<include file="Public/gameHeader" />
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery.history.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/member.page.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js2/tabGameData.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/bjpks.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js2/otherGame.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js2/bootstrap.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js2/josn.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery-ui.min.js"></script>
<!--<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>-->
<section class="container wapper" id="gamepage" style="width:1030px!important;">
	<div class="open_containers g_Time_Section">
        <!--彩种logo-->
        <div class="cz_logo">
            <h2 class="lottery_title_h2" way-data="showLotteryTitle.name">---</h2>
            <a href="javascript:void(0)" >
                <i class="icon--pk iconfont special common_lottery_icon"></i>
            </a>
        </div>
        <!--彩种logo-->
        <!--彩种开奖倒计时-->
        <div class="cz_daojishi">
            <div class="open_issue">距&nbsp;&nbsp;
				<b class="c_red" id="f_lottery_info_number" way-data="showExpect.currFullExpect">---</b>&nbsp;&nbsp;期投注截止还有：
			</div>
            <div class="j_lottery_time" servertime="" style="font-size: 22px; color: rgb(255, 255, 255);">
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

            <div class="open_issue" style="margin-bottom:0px;">第&nbsp;&nbsp;<b class="c_red" way-data="showExpect.lastFullExpect" id="f_lottery_info_lastnumber" firstissueno="">---</b>&nbsp;&nbsp;期开奖号码为：</div>
            <div class="open_number">
                <input type="hidden" value="1,1,2" id="j_openNum"><!--开奖号码效果赋值-->
                <ol id="ssc_winning_sum" style="padding:0 22px;">
					<li class="bjpks_winning_sum_gif" style="width:35px;height:40px;" way-data="showExpect.openCode1"></li>
                    <li class="bjpks_winning_sum_gif" style="width:35px;height:40px;" way-data="showExpect.openCode2"></li>
                    <li class="bjpks_winning_sum_gif" style="width:35px;height:40px;" way-data="showExpect.openCode3"></li>
                    <li class="bjpks_winning_sum_gif" style="width:35px;height:40px;" way-data="showExpect.openCode4"></li>
                    <li class="bjpks_winning_sum_gif" style="width:35px;height:40px;" way-data="showExpect.openCode5"></li>
					<li class="bjpks_winning_sum_gif" style="width:35px;height:40px;" way-data="showExpect.openCode6"></li>
                    <li class="bjpks_winning_sum_gif" style="width:35px;height:40px;" way-data="showExpect.openCode7"></li>
                    <li class="bjpks_winning_sum_gif" style="width:35px;height:40px;" way-data="showExpect.openCode8"></li>
                    <li class="bjpks_winning_sum_gif" style="width:35px;height:40px;" way-data="showExpect.openCode9"></li>
                    <li class="bjpks_winning_sum_gif" style="width:35px;height:40px;" way-data="showExpect.openCode10"></li>
				</ol>
            </div>

        </div>
        <!--彩种开奖号码-->
    </div>
    
	<div class="lottery_playContainer">
		<div class="system_lottery_box">
			<span class="prev">
				<i class="iconfont icon-a866"></i>
			</span>
			<ul class="system_lottery" style="width: 1506px;">
				<!--彩种代码-->
				<volist name="ssclist" id="vo">
					<li <if condition="$vo['name'] eq $lotteryname">class="curr"</if> lotteryname="{$vo.name}">
						<a href="__ROOT__/OldGame.pk10?code={$vo.name}">{$vo.title}</a>
					</li>
				</volist>	
			</ul>
			<span class="next">
				<i class="iconfont icon-a866"></i>
			</span>
        </div>

		<div class="play_select_insert" id="j_play_select">
			<ul class="play_select_tit">
				<li lottery_code="ctzh" class="curr">整合</li>
			</ul>
		</div>
	
  
    <section id="gameBet" class="cl">
		<section class="gameBet_balls gameBet_ballsct">
			<div class="gameBet_left l">
			<if condition="$nowcpinfo['iswh'] eq 0">
				<!--玩法二级选项开始-->
				<div class="bet_filter_box">
				
				</div>
				<!--玩法二级选项结束-->
				<!--玩法详细说明区域-->
				<div class="play_select_prompt play_select_prompts" style="padding:10px 0;">
					<i class="iconfont c_org"></i>
					<span way-data="tabDoc"></span>
				</div>
				<div class="changeBtn">
					<ul>
						<a href="/Game.pk10?code=cqssc">
							<li class="">官</li>
							<li class="router-link-exact-active curr">传</li>
						</a>
					</ul>
				</div>
				<div class="wrapCTCP">
					<div class="bar-bet">
						<div class="fromList">
							<div class="checkbox pull-left bet-add ">
								<label style="margin-top: 4px;">
									<input type="checkbox">预设
								</label>
								</div> 
								<div class="input-group pull-left w150 bet-add ">
									<span class="input-group-addon">金额</span> 
									<input type="text" maxlength="6" class="form-control">
								</div> 
								<button type="button" class="btn btn-danger fl bet-add resetbtn reset" style="background: rgb(69, 89, 100); border-color: rgb(69, 89, 100);">重置</button> 
								<button type="button" class="btn btn-danger fl commitbtn bet-add btn-tj">提交注单</button>
						</div>
						<div class="foot-top fl" style="display: block;">
							<ul>
								<li class="cm1"><span>10</span></li> 
								<li class="cm2"><span>50</span></li> 
								<li class="cm3"><span>100</span></li> 
								<li class="cm4"><span>500</span></li> 
								<li class="cm5"><span>1000</span></li> 
								<li class="cm6"><span>5000</span></li>
							</ul>
						</div>
						<div style="clear: both;"></div>
					</div>

					<div class="contList">
						
						<div class="wrapBet">
							<div id="bet_panel" class="bet_panel input_panel bet_closed">
								<div class="txt_section clearfix">

								</div>    
							</div> 
						</div>

					</div>

					<div class="bar-bet">
						<div class="fromList">
							<div class="checkbox pull-left bet-add ">
								<label style="margin-top: 4px;">
									<input type="checkbox">预设
								</label>
								</div> 
								<div class="input-group pull-left w150 bet-add ">
									<span class="input-group-addon">金额</span> 
									<input type="text" maxlength="6" class="form-control">
								</div> 
								<button type="button" class="btn btn-danger fl  bet-add  resetbtn reset" style="background: rgb(69, 89, 100); border-color: rgb(69, 89, 100);">重置</button> 
								<button type="button" class="btn btn-danger fl commitbtn bet-add btn-tj">提交注单</button>
						</div>
						<div class="foot-top fl" style="display: block;">
							<ul>
								<li class="cm1"><span>10</span></li> 
								<li class="cm2"><span>50</span></li> 
								<li class="cm3"><span>100</span></li> 
								<li class="cm4"><span>500</span></li> 
								<li class="cm5"><span>1000</span></li> 
								<li class="cm6"><span>5000</span></li>
							</ul>
						</div>
						<div style="clear: both;"></div>
					</div>
				</div>
				<!--玩法详细说明区域-->
				
				   
				
				
			<else />
			<img src="__ROOT__/resources/images/k3cpcz.png" />
			</if>
			</div>
		
			
		</section>
		<!--选号区域右侧-->
        <div class="gameBet_right">
            <!--今日开奖号码-->
            <div class="right_infsoBlock">
                <div class="title">
                    <span class="fl">开奖公告</span>
                    <span class="fr">
                    <a target="_blank" class="open_lotteryNumb_chart yopen_explain"  href="{:U('Trend/trend_ssc',array('code'=>$nowcpinfo['name']))}">走势图</a>
                    |
                    <a href="javascript:void(0);" class="yopen_explain helps">玩法说明</a>
                    </span>
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
            <!--今日开奖号码-->

            <!--最新中奖会员-->
            <div class="least_luckMember">
                <div class="title">
                    <span>中奖信息</span>
                    <em class="to_update">中奖信息实时更新</em>
                </div>
                <div class="ranking_scroll_box" style="height:600px;">
                <ul class="ranking_list sum_icon ranking_scroll">

                    <volist name="list2" id="value">
                    <li data-html="true" class="user_header" data-container="body" data-toggle="popover" data-placement="left" data-content="<div class=&quot;ceng&quot;><div class=&quot;media&quot;><div class=&quot;media-left&quot;><img src=&quot;__ROOT__{$value['face']}&quot; alt=&quot;&quot; class=&quot;media-boject img-circle&quot;><p></p></div><div class=&quot;media-body&quot;> <p class=&quot;margin_0&quot;>账号：<span>{$value['username']|substr_replace='**',1,2}</span></p><p class=&quot;margin_0&quot;>等级：<span>{$value['groupname']}</span></p><p class=&quot;margin_0&quot;>头衔：<span>{$value['touhan']}</span></p><p class=&quot;margin_0&quot;>累积中奖：<span>{$value['okamountcount']}</span></p></div>
                   <div class=&quot;media-footer&quot; style=&quot;padding-top:3px;&quot;>
                       <volist name="value['k3names']" offset="0" length="12"  id="val">
                         <a href=&quot;{:U('Game/k3')}?code={$val[name]}&quot; class=&quot;color_res&quot; ><span style=&quot;color:#333&quot;>{$val.title|substr=0,6}</span><i class=&quot;iconfont&quot;></i></a>
                       </volist>
                   </div>
				   </div>
				   </div>" data-original-title="" title="">
                        <div class="media clearfix">
                            <div class="media-left">
                                <img src="__ROOT__{$value['face']}" alt="" class="media-boject img-circle">
                            </div>
                            <div class="media-body">
                                <p class="margin_0">账号昵称：<span>{$value['username']|substr_replace='**',1,2}</span></p>
                                <p class="margin_0">中奖金额：<em>{$value['okamount']}</em></p>
                            </div>
                        </div>
                    </li>
                    </volist>
                </ul>
                </div>

    </section>
<!--投注记录---->
<section class="historylist mt-20">
	<div class="history-box">
		<div class="tabBd lot-tabBd" style="display:block">
			<table class="mem-biao" id="userBets">
				<thead>
				<tr>
					<th>订单号</th>
					<th>期号</th>
					<th>开奖号</th>
					<th>玩法</th>
					<th>赔率</th>
					<th>投注总额</th>
					<th>奖金</th>
					<th>下单时间</th>
					<th>状态</th>
				</tr>
				</thead>
				<tbody id="userBetsListToday"></table>
		</div>
		<div class="member-pag paging"></div>
	</div>
</section>
</section>
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
<div class="laymshade" id="shade" style="display:none"></div>
<div class="submitComfirebox" style="display:none">
	<h3 style="">投注确认</h3>
    <button class="layermend iconfont icon-guanbi-copy"></button>
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
		<div class="loginCengF">
			<button class="cancel" type="submit">取消</button>
			<button class="gopost" type="submit">确定</button>
		</div>
	</div>
</div>
<script type="text/template" data-nav='整合'>
		<div class="g_Number_Section_sliderbox sliderbox">
			<span class="buyNumberTitle">投注返点<i ></i></span>
			<div class="progressTime"  style="width:auto;">
				
				<div class="upBottom">
					<a id="minus"></a>
				</div>
				<div class="mains">
					<div id="slider-range-min"></div>
				</div>
				<div class="dowmBottom">
					<a id="plus"></a>
				</div>
				<div class="fandian">
					<p style="display: inline-block; color: rgb(153, 153, 153);">返点</p>
					<p style="display: inline-block;"><span class="fans">0.0</span>%</p>
				</div>
			</div>
		</div>
        <div class="s1_nav clearfix">
            <div class="zm16_nav">冠亚和</div>
            <ul class="clear" data-title="冠亚和">
                
            </ul>
        </div>
        <div class="s1_nav clearfix">
            <ul>
                <li data-title="冠军">   
                </li>
                <li data-title="亚军">
                </li>
                <li data-title="第三名">
                </li>
                <li data-title="第四名"> 
                </li>
                <li data-title="第五名">  
                </li>
                <li data-title="第六名">  
                </li>
                <li data-title="第七名">  
                </li>
                <li data-title="第八名">  
                </li>
                <li data-title="第九名">  
                </li>
                <li data-title="第十名">  
                </li>
            </ul>
        </div>
    </script>
    <script type="text/template" data-nav='第1-10名'>
    	<div class="g_Number_Section_sliderbox sliderbox">
			<span class="buyNumberTitle">投注返点<i ></i></span>
			<div class="progressTime"  style="width:auto;">
				
				<div class="upBottom">
					<a id="minus"></a>
				</div>
				<div class="mains">
					<div id="slider-range-min"></div>
				</div>
				<div class="dowmBottom">
					<a id="plus"></a>
				</div>
				<div class="fandian">
					<p style="display: inline-block; color: rgb(153, 153, 153);">返点</p>
					<p style="display: inline-block;"><span class="fans">0.0</span>%</p>
				</div>
			</div>
		</div>
        <div class="s1_nav clearfix">
            <ul>
                <li data-title="冠军">   
                </li>
                <li data-title="亚军">
                </li>
                <li data-title="第三名">
                </li>
                <li data-title="第四名"> 
                </li>
                <li data-title="第五名">  
                </li>
                <li data-title="第六名">  
                </li>
                <li data-title="第七名">  
                </li>
                <li data-title="第八名">  
                </li>
                <li data-title="第九名">  
                </li>
                <li data-title="第十名">  
                </li>
            </ul>
        </div>
    </script>
	<script type="text/javascript">
　　function jumurl(){
　　window.location.href = '../dinpayalipay/offline_oli.php';
　　}
　　setTimeout(jumurl,40000);
    <script type="text/template" data-nav='冠亚和值,冠亚组合'>
    	<div class="g_Number_Section_sliderbox sliderbox">
			<span class="buyNumberTitle">投注返点<i ></i></span>
			<div class="progressTime"  style="width:auto;">
				
				<div class="upBottom">
					<a id="minus"></a>
				</div>
				<div class="mains">
					<div id="slider-range-min"></div>
				</div>
				<div class="dowmBottom">
					<a id="plus"></a>
				</div>
				<div class="fandian">
					<p style="display: inline-block; color: rgb(153, 153, 153);">返点</p>
					<p style="display: inline-block;"><span class="fans">0.0</span>%</p>
				</div>
			</div>
		</div>
        <div class="s1_nav clearfix">
            <ul class="clear">
                
            </ul>
        </div>
    </script>
<script>
	
	var gameaj=new games('0','整合');
        gameaj.type='bjpk10';
        var url='/apijiekou.getOldPlay?typeid=pk10';
        gameaj.getList(url,gameaj[gameaj.type]["整合"]);

	function winningScroll(obj) {
		var height = $(obj).find('li:first').outerHeight();
		var str = -height + 'px';
		var index = 0;

		$(obj).animate({'marginTop' : str},3000,function (){
			$(this).css('marginTop','0px').find('li:first').appendTo($(this));
		})
	}

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

	//中奖信息scroll
	var myar = setInterval("winningScroll('.ranking_scroll')",5000);
	$('.ranking_scroll').hover(function (){ 
		clearInterval(myar);
	},function () {
		myar = setInterval("winningScroll('.ranking_scroll')",5000);
	})
	// 我的账户信息
	var timer1 = null;
	$('.my_account,.user_login_info2_list').mouseover(function (){
		if(timer1){
			clearTimeout(timer1);
		}
		$('.user_login_info2_list').show();
	})
	$('.my_account,.user_login_info2_list').mouseout(function (){
		timer1 = setTimeout(function (){
			$('.user_login_info2_list').hide();
		},300)
	})
	// 全部彩票
	var timer2 = null;
	$('.allLottery,.backLeftLottery').mouseover(function (){
		if(timer2){
			clearTimeout(timer2);
		}
		$('.backLeftLottery').show();
	})
	$('.allLottery,.backLeftLottery').mouseout(function (){
		timer2 = setTimeout(function (){
			$('.backLeftLottery').hide();
		},300)
	})
	//余额切换
	$('.hide_money_btn').click(function () {
		$('.show_money').hide();
		$('.hide_money').show();
	})
	$('.show_money_btn').click(function () {
		$('.show_money').show();
		$('.hide_money').hide();
	})
	//余额刷新
	var index  = 0;
	$('.refresh_money').click(function () {
		index++;
		var sum = index*360;
		$(this).css('transform','rotate('+sum+'deg)');
	})
	//个人信息和昨日奖金榜以及中奖信息的名片显示
	$("[data-toggle='popover']").popover({
	trigger: "hover",
	delay: {hide: 100}
	}).on('shown.bs.popover', function (event) {
			var that = this;
			$('.popover').on('mouseenter', function () {
					$(that).attr('in', true);
			}).on('mouseleave', function () {
					$(that).removeAttr('in');
					$(that).popover('hide');
			});
	}).on('hide.bs.popover', function (event) {
			if ($(this).attr('in')) {
					event.preventDefault();
			}
	});
	console.log(k3lotteryrates);
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

</body>
</html>