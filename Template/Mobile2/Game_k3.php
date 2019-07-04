<php>$webheadertitle = $nowcpinfo['title'];</php>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{$webheadertitle}</title>
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="/favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/sm.css">
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/sm-extend.min.css">

<link rel="stylesheet" type="text/css" href="__ROOT__/Template/Mobile/css/jquery.range.css" />


<script>
    var WebConfigs = {
        'ROOT' : "__ROOT__"
    } 
<?php echo "var k3lotteryrates = ".json_encode($rates,JSON_UNESCAPED_UNICODE);?>
</script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/Template/Mobile/js/layer/layer.js"></script>
<script type="text/javascript">
var jq=$.noConflict();
</script>
<script type='text/javascript' src='__ROOT__/Template/Mobile/js/zepto.js' charset='utf-8'></script>

<script type="text/javascript" src="__ROOT__/Template/Mobile/js/jquery.range.js"></script>
<script type='text/javascript' src='__ROOT__/Template/Mobile/js/config.js' charset='utf-8'></script>
<script type='text/javascript' src='__ROOT__/Template/Mobile/js/fx.js' charset='utf-8'></script>
<script type='text/javascript' src='__ROOT__/Template/Mobile/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='__ROOT__/Template/Mobile/js/slideupdown.js' charset='utf-8'></script>
<script type='text/javascript' src='__ROOT__/Template/Mobile/js/sm-extend.min.js' charset='utf-8'></script>
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/sm-extend.min.css">
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/reset.css">
<link rel="stylesheet" href="__ROOT__/Template/Mobile/css/theme-red.css">  

<link rel="stylesheet" href="__CSS__/icon.css">
<script>
      

var lotteryinfo = <?php echo json_encode($nowcpinfo,JSON_UNESCAPED_UNICODE);?>;
</script>
<script type='text/javascript' src='__ROOT__/Template/Mobile/js/way.min.js' charset='utf-8'></script>
<script type="text/javascript" src="__ROOT__/Template/Mobile/js/member.page.js"></script>
<script type='text/javascript' src='__ROOT__/Template/Mobile/js/common.js' charset='utf-8'></script>

<script type='text/javascript' src='__ROOT__/Template/Mobile/js/k3.js' charset='utf-8'></script>
<style>
.bottom_navbar{position: absolute;bottom: 0;z-index: 9999;width: 100%;}
.bottom_navbar ul{list-style: none;overflow: hidden;padding: 0;margin: 0;background: #22292c;color: #fff;padding-top: 5px;}
.bottom_navbar ul li{ float: left;width: 25%;text-align: center;}
.am-navbar-default a {color: #fff;}
.am-navbar-nav a { display: inline-block;width: 100%;height: 49px;line-height: 20px;}
.bottom_navbar .bottom_navbar_list i{font-size: 25px;line-height: 30px;}
.am-navbar-nav a .am-navbar-label {padding-top: 2px;line-height: 1;font-size: 12px;display: block;word-wrap: normal;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;font-size: 14px;}
.bottom_navbar .active {color: #e54042;}
.choice_lottery_playdetail {
    position: absolute;
    z-index: 100;
    top: -50px;
    left: 50%;
}
</style>
</head>
<body>
<div class="page-group">
      <!-- 你的html代码 -->
      <div class="pa yyplay_select_container" id="PageSwitch">
        <volist name="k3list" id="k3vo">
            <a  data-k3url="{:U('Game/k3',['code'=>$k3vo['name']])}">{$k3vo.title}</a>
            </volist>
        </div>
      <div class="page">
        <include file="Game/header" />
          <div class="content">
			
            <div class="play_select_container yyplay_select_container">
                <!-- 玩法切换 -->
                <div class="play_select_insert" id="j_play_select">
                    
                    <ul class="play_select_tit"> 
                
                            
                            <li lottery_code="k3hzzx" parent_code="{$nowcpinfo.name}" class="curr lottery_1">
                                <a href="javascript:void(0)" class="lineMore-item">和值</a>
                                <p class="ypeil">{$minPeilv}-{$maxPeilv}倍</p>
                                <p class="ysaizi">
                                    <span class="dice dice1"></span>+
                                    <span class="dice dice2"></span>+
                                    <span class="dice dice3"></span>
                                </p>
                            </li>
                        
                            <li lottery_code="k3sthtx" parent_code="{$nowcpinfo.name}" class=" lottery_3">
                                <a href="javascript:void(0)" class="lineMore-item">三同号通选</a> 
                                <p class="ypeil">赔率{$peilv.k3sthtx}倍</p>
                                <p class="ysaizi">
                                    <span class="dice dice1"></span> 
                                    <span class="dice dice1"></span> 
                                    <span class="dice dice1"></span>
                                </p>
                            </li>
                        
                            <li lottery_code="k3sthdx" parent_code="{$nowcpinfo.name}" class=" lottery_5">
                                <a href="javascript:void(0)" class="lineMore-item">三同号单选</a>
                                <p class="ypeil">赔率{$peilv.k3sthdx}倍</p>
                                <p class="ysaizi">
                                    <span class="dice dice1"></span> 
                                    <span class="dice dice1"></span> 
                                    <span class="dice dice1"></span>
                                </p>
                            </li>
                        
                            <li lottery_code="k3sbthbz" parent_code="{$nowcpinfo.name}" class=" lottery_7">
                                <a href="javascript:void(0)" class="lineMore-item">三不同号</a>
                                <p class="ypeil">赔率{$peilv.k3sbthbz}倍</p>
                                <p class="ysaizi">
                                    <span class="dice dice2"></span> 
                                    <span class="dice dice3"></span> 
                                    <span class="dice dice5"></span>
                                </p>
                            </li>
                        
                            <li lottery_code="k3slhtx" parent_code="{$nowcpinfo.name}" class=" lottery_9">
                                <a href="javascript:void(0)" class="lineMore-item">三连号通选</a>
                                <p class="ypeil">赔率{$peilv.k3slhtx}倍</p>
                                <p class="ysaizi">
                                    <span class="dice dice1"></span> 
                                    <span class="dice dice2"></span> 
                                    <span class="dice dice3"></span>
                                </p>
                            </li>
                        
                            <li lottery_code="k3ethfx" parent_code="{$nowcpinfo.name}" class=" lottery_11">
                                <a href="javascript:void(0)" class="lineMore-item">二同号复选</a>
                                <p class="ypeil">赔率{$peilv.k3ethfx}倍</p>
                                <p class="ysaizi">
                                    <span class="dice dice1"></span> 
                                    <span class="dice dice1"></span> 
                                    <span class="dice dice3"></span>
                                </p>
                            </li>
                        
                            <li lottery_code="k3ethdx" parent_code="{$nowcpinfo.name}" class=" lottery_13">
                                <a href="javascript:void(0)" class="lineMore-item">二同号单选</a>
                                <p class="ypeil">赔率{$peilv.k3ethdx}倍</p>
                                <p class="ysaizi">
                                    <span class="dice dice1"></span> 
                                    <span class="dice dice1"></span> 
                                    <span class="dice dice3"></span>
                                </p>
                            </li>
                        
                            <li lottery_code="k3ebthbz" parent_code="{$nowcpinfo.name}" class=" lottery_15">
                                <a href="javascript:void(0)" class="lineMore-item">二不同号</a>
                                <p class="ypeil">赔率{$peilv.k3ebthbz}倍</p>
                                <p class="ysaizi">
                                    <span class="dice dice1"></span> 
                                    <span class="dice dice4"></span> 
                                    <span class="dice dice4"></span>
                                </p>
                            </li>
                        
                    </ul> 
                </div>
                <!-- 玩法切换 -->
            </div>
			<div class="row no-gutter text-center Betting_Issue_CountDown" style="padding-top:5px;background: #22563f;">
                       <dl class="col-50 cz_openNumb">
                              <dt style="font-size:14px;"><i class="f_lottery_info_lastnumber red"  id="f_lottery_info_lastnumber" way-data="showExpect.lastFullExpect">--</i><span id="issueText">期</span></dt>
                               <dd style="font-size:20px; padding:0; margin:0;">
							   <!--i class="openNum_list red" id="openNum_list">
								<t way-data="showExpect.openCode1">-</t>
								<t way-data="showExpect.openCode2">-</t>
								<t way-data="showExpect.openCode3">-</t>
							   </i-->
							   <ul id="openNum_list">
								<li class="open_numb_gif"></li>
								<li class="open_numb_gif"></li>
								<li class="open_numb_gif"></li>
								<span class="icon icon-caret" style="color:#999"></span>
				               </ul>
							   </dd>
                        </dl>
                       <dl class="col-50" style="color:#caebda">
                        <dt style="font-size:14px;">距<i class="f_lottery_info_number red" id="f_lottery_info_number" way-data="showExpect.currFullExpect">--</i>期截止</dt>
                         <dd style="font-size:20px; padding:0; margin:0;"><i class="j_lottery_time red" id="j_lottery_time">
							<t class="hh bj"><span way-data="gametimes.h">00</span></t>
							<em>:</em>
							<t class="mm bj"><span way-data="gametimes.m">00</span></t>
							<em>:</em>
							<t class="ss bj"><span way-data="gametimes.s">00</span></t>
						 </i></dd>
                        </dl> 
			</div>
						<div style="background-color: #fff; margin-top: -4px;">
                           <table id="fn_getoPenGame" border="0px" cellpadding="0" cellspacing="0" style="display:none;width:100%;text-align:center">
                            <colgroup>
                                <col width="30%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <thead 
    style="background-color: #DADADA; border-bottom: 1px solid #BBBBBB;border-top: 1px solid hsla(0,0%,100%,.3);background-color: #22563f;width: 16rem;font-size: .7em;color: #caebda;text-align: center;clear: both;border-bottom: 1px solid #BBBBBB;height: 64px;">
                                <tr style="    border-bottom: 1px solid #212121;">
                                    <th>期数</th>
                                    <th>奖号</th>
                                    <th>和值</th>
                                    <th>形态</th>
                                </tr>
                            </thead>
                            <tbody class="tbody" style="background: #22563f;"></tbody>
                        </table>
                         </div>


<section class="ui-container">   
			<!-- 选择与切换玩法 -->
			<!-- 投注期号与倒计时 -->
			<!-- 投注期号与倒计时 --> 
			<!-- 选号区域 -->
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
                            <div class="fandian">
                                <p style="display: inline-block; color: rgb(202, 202, 202);">返点</p> 
                                <p style="display: inline-block;" class="fans">0.0</p>
                            </div>  
                        </tr>
                    </table>
                </div>
			<div class="Choice_Ball_Container ui-whitespace" id="Game_CheckBall">
				<if condition="$nowcpinfo['iswh'] eq 0">
				<div class="gn_main_cont k3_ball_conatiner" id="gn_main_cont">

				</div>
				<else />
					<p style="font-size:30px; color:#f60; text-align:center; padding:15px 0;">彩种维护中...</p>
				</if>
            </div>
		</section>  
          </div>
      </div>
  </div>

<div class="lottey_footer" style="bottom: 58px;">
    <div class="lottery_footer_sum" style="display:none;">
        <span class="lottery_sum_text">当前号码</span>
        <div id="lottery_sum_old_b">

        </div>
    </div>
    <div class="lottery_inputBox" style="display:none;">
        每注金额
        <input type="number" class="lottery_input">
        <span class="lottery_input_text">请输入要投注的金额</span>
    </div>
    <div class="kuaijie_money">
        <ul class="kuaijie_money_ul">
            <li class="kuaijie_item">5</li>
            <li class="kuaijie_item">10</li>
            <li class="kuaijie_item">50</li>
            <li class="kuaijie_item">100</li>
            <li class="kuaijie_item">1000</li>
        </ul>
    </div>  
    <div class="betting_box" style="background: #22563f;border-top: 1px solid #1a4230;">
        <div class="betting_left">
            <span class="betting_empty">清空</span>
            <em class="betting_sum_box" style="display:none;">
                共<span class="betting_sum">0</span>注,
                <span class="betting_sum_moery">0</span>元
            </em>
        </div>
        <div class="betting_right">
            <button class="betting_right_btn">
                马上投注
            </button>
        </div>
    </div>
</div>
<include file="public/footer" />
<include file="Game/wf" />
<div class="popup" id="userbetshistory">
		<div class="list-block media-list" style="padding-top: 0; margin-top: 0">
			<div class="card-header "><botton id="formaubmitdo" class="button button-fill button-danger close-popup" style="width:100%;">关闭</botton></div>
			<ul id="userbetshistorylist"></ul>
			<div class="member-pag paging"></div>
		</div>
</div>
<script>

</script>
</body>
</html>