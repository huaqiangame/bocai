<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="__CSS__/men_content.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/game.css">
	<link rel="stylesheet" type="text/css" href="__CSS__/index.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/red.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/indexCP.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/amazeui.min.css">
	<link rel="stylesheet" type="text/css" href="__CSS__/icon.css">
    <script src="__JS__/js2/iconfont.js"></script>
	<script src="__JS__/jquery-1.11.3.js"></script>
    <script src="__JS__/commonIndex.js"></script>
    <script src="__JS__/js2/jquery.cookie.js"></script>
    <script src="__JS__/amazeui.min.js"></script>

    <style type="text/css">
        .swiper-container {width: 100%;height: 100%;}
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
    </style>

</head>
<body style="background:#e9e9e9;">
    <div class="App">
        <header>
            <div class="AppHeader is-fixed">
                <div class="AppHeader-inner">
                    <a class="AppHeader-logo" href="javascript:void(0)">
                        <img src="__IMG__/logo.png" width="145" height="40">
                    </a>
                        <div class="AppHeader-actions">
							  <if condition="is_array($userinfo)">
							<span class="my-icon">
                                <svg class="icon" aria-hidden="true">
                                   <use xlink:href="#icon-weidenglutouxiang"></use>
                                </svg>
                            </span>
							<else/>
                              <a href="javascript:;" class="AppHeader-white" data-modal="#J_loginModal" id="J_loginModal_new" >登录</a>
                              <a class="AppHeader-yellow" href="javascript:;" data-modal="#J_regModal" id="J_regModal_new">注册</a>
							</if>
                        </div>
                </div>
            </div>
        </header>
   <main>
    <div class="AppMain">
        <div class="AppMain-banner">
            <div class="swiper-container" id="banner">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img width="100%" src="__IMG__/dy/banner0.jpg" alt=""></div>
                    <div class="swiper-slide"><img width="100%" src="__IMG__/dy/banner2.jpg" alt=""></div>
                    <div class="swiper-slide"><img width="100%" src="__IMG__/dy/banner5.jpg" alt=""></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="AppMain-notice">
            <span class="AppMain-notice-icon">
                <svg class="icon" aria-hidden="true">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-notice"></use>
                </svg>
            </span>
            <div class="AppMain-notice-list">
                <marquee id="msgNews" scrollamount="4" scrolldelay="100" direction="left"
                         style="font-size:8px;">{$gonggao.title}
                </marquee>

            </div>
        </div>
        <div class="AppMain-webmaster gamelist-h">
            <div class="gameitem">
                <div class="gameicon"><i class="icon-games icon-games-LOTTERY icon-zoom80"></i></div>
                <div class="gametxtbox">
                    <div class="gametxtbox-info">
                        <div class="gametitle"><i class="icon-webmaster"></i>购彩大厅</div>
                        <div class="gameinfo">
                            <i class="gamestar star-6"></i>
                            <div class="gameonline"><span class="cred">1023</span>人在玩</div>
                        </div>
                        <div class="gamebtns">
                            <!--<a class="gamebtn-try" href="https://m.dg79web.com/wap/?token=2a05d3b01fe749bb8f8e1be44da78b52" target="_blank">试玩</a>-->
                            <a class="gamebtn-go" target="_blank" href="{:U('Index/lotteryHall')}">进入</a>
                        </div>
                    </div>
                    <div class="gametxtbox-activity"><i class="iconact"></i>品牌彩票投注平台</div>
                </div>
            </div>
        </div>
        <div class="AppMain-webmaster gamelist-h">
            <div class="gameitem">
                <div class="gameicon"><i class="icon-games icon-games-MGE icon-zoom80"></i></div>
                <div class="gametxtbox">
                    <div class="gametxtbox-info">
                        <div class="gametitle"><i class="icon-webmaster"></i>全球热门</div>
                        <div class="gameinfo">
                            <i class="gamestar star-6"></i>
                            <div class="gameonline"><span class="cred">116589</span>人在玩</div>
                        </div>
                        <div class="gamebtns">
                            <!--<a class="gamebtn-try" href="http://gci.mx2000.com:81/magingame/NewPlaza31/?pid=G22&stamp=1504860721549" target="_blank">试玩</a>-->
                            <a class="gamebtn-go" target="_blank" href="{:U('Zhenren/login',array('type'=>'ag'))}" >进入</a>
                        </div>
                    </div>
                    <div class="gametxtbox-activity"><i class="iconact"></i>全球经典电子游戏</div>
                </div>
            </div>
        </div>
    </div>
    <div class="AppMain-game" style="padding-top:-5px;">
        <div class="gametab">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide active"><span>热门</span></div>
                    <div class="swiper-slide"><span>电子</span></div>
                    <div class="swiper-slide"><span>视讯</span></div>
                    <div class="swiper-slide"><span>彩票</span></div>
                    <div class="swiper-slide"><span>捕鱼</span></div>
                    <div class="swiper-slide"><span>棋牌</span></div>
                    <div class="swiper-slide"><span>体育</span></div>
                </div>
            </div>
        </div>
        <div class="gamelist-container">
            <div class="swiper-container gameslist" id="gameslist">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="gamelist gamelist-v">
                            <!--<div class="gameitem burst" <if condition="is_array($userinfo)"> onclick="window.location.href=''" <else/>  onclick="javascript: alerthd();"</if> data-game="">
                                <div class="gameicon">
                                    <i class="icon-games icon-games-AMB icon-zoom80"></i>
                                </div>
                                <div class="gametitle">PT 电子</div>
                                <i class="gamestar star-5"></i>
                                <div class="gameonline"><span class="cred">6655</span>人在玩</div>
                            </div>-->
						<div class="gameitem burst" <if condition="is_array($userinfo)"> onclick="window.location.href=''" 
						<else/>  onclick="javascript: alerthd('{:U('Index/slotgame')}');"</if> data-game="">
                                <div class="gameicon">
							<a href="{:U('Zhenren/login',array('type'=>'bbin'))}"><img src="__ROOT__/Template/Mobile/images/real_person/bbin.png" style="width:60%;height:51px;"></a>
                                </div>
                                <div class="gametitle">BBIN真人</div>
                                <i class="gamestar star-5"></i>
                                <div class="gameonline"><span class="cred">6655</span>人在玩</div>
                         </div>
 						<div class="gameitem hot" 
                    <div class="gameitem hot" <if condition="is_array($userinfo)"> onclick="window.location.href=''"
                    <else/> onclick="javascript: alerthd('{:U('Index/index')}');" </if> data-game="">
                            <div class="gameicon">
							<a href="{:U('Zhenren/login',array('type'=>'ag'))}"><img src="__ROOT__/Template/Mobile/images/real_person/ag.png" style="width:60%;height:51px;"></a>
                            </div>
                            <div class="gametitle">AG女优厅</div>
                            <i class="gamestar star-4"></i>
                            <div class="gameonline"><span class="cred">36713</span>人在玩</div>
                        </div>
						<div class="gameitem hot"
						<if condition="is_array($userinfo)">
                         onclick="window.location.href='__ROOT__/Game.ssc?code=cqssc'"
                        <else/>
                         onclick="javascript: alerthd('__ROOT__/Game.ssc?code=cqssc');"
                         </if>
                         data-game="">
                           <div class="gameicon">
                           <img src="__ROOT__/Template/Mobile/images/real_person/ssc.png" style="height:51px;">
                           </div>
                           <div class="gametitle">重庆时时彩</div>
                           <i class="gamestar star-5"></i>
                           <div class="gameonline"><span class="cred">36712</span>人在玩</div>
                       </div>
                       <div class="gameitem hot" <if condition="is_array($userinfo)">
                         onclick="window.location.href='__ROOT__/Game.lhc?code=dflhc'"
                        <else/>
                         onclick="javascript: alerthd('__ROOT__/Game.lhc?code=dflhc');"
                         </if>
                         data-game="">
                           <div class="gameicon">
								<img src="__ROOT__/Template/Mobile/images/real_person/lhc300.png" style="height:51px;">
                           </div>
                           <div class="gametitle">六合彩</div>
                           <i class="gamestar star-4"></i>
                           <div class="gameonline"><span class="cred">66823</span>人在玩</div>
                       </div>
                       <div class="gameitem"
                       <if condition="is_array($userinfo)"> onclick="window.location.href=''"
                        <else/>
                           onclick="javascript: alerthd('{:U('Index/index')}');" </if>
					   data-game="">
                           <div class="gameicon">
							<a href="{:U('Zhenren/login',array('type'=>'ky'))}"><img src="__ROOT__/Template/Mobile/images/real_person/ky.png" style="height:51px;"></a>
                           </div>
                           <div class="gametitle">开元棋牌</div>
                           <i class="gamestar star-5"></i>
                           <div class="gameonline"><span class="cred">72341</span>人在玩</div>
                       </div>
                       <div class="gameitem burst"
					   <if condition="is_array($userinfo)">
					   onclick="window.location.href=''"
					   <else/>onclick="javascript: alerthd('{:U('Index/index')}');" </if>
					   data-game="">
                           <div class="gameicon">
							<a href="{:U('Zhenren/login',array('type'=>'ag'))}"><img src="__ROOT__/Template/Mobile/images/real_person/mwfish.png" style="height:51px;"></a>
                           </div>
                           <div class="gametitle">AG捕鱼王</div>
                           <i class="gamestar star-4"></i>
                           <div class="gameonline"><span class="cred">31234</span>人在玩</div>
                       </div>
						  <div class="gameitem hot"
						  <if condition="is_array($userinfo)">  onclick="window.location.href='__ROOT__/Game.pk10?code=bjpk10'"
                         <else/>
                                   onclick="javascript: alerthd('__ROOT__/Game.pk10?code=bjpk10');"
						 </if>
					     data-game="">
                           <div class="gameicon">
                         <img src="__ROOT__/Template/Mobile/images/real_person/pk10.png" style="height:51px;">
                           </div>
                           <div class="gametitle">北京pk10</div>
                           <i class="gamestar star-5"></i>
                           <div class="gameonline"><span class="cred">36712</span>人在玩</div>
                       </div>
					     <div class="gameitem"
						 <if condition="is_array($userinfo)">
                         onclick="window.location.href='__ROOT__/Game.x5?code=gd11x5'"
                        <else/>
                         onclick="javascript: alerthd('__ROOT__/Game.x5?code=gd11x5');"
                         </if>
                         data-game="">
                           <div class="gameicon">
                           <img src="__ROOT__/Template/Mobile/images/real_person/115.png" style="height:51px;">
                           </div>
                           <div class="gametitle">广东11选5</div>
                              <i class="gamestar star-5"></i>
                           <div class="gameonline"><span class="cred">36712</span>人在玩</div>
                       </div>

                    </div>
               </div>
   <div class="swiper-slide">
       <div class="gamelist gamelist-h">
           <div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><i class="icon-games icon-games-AG icon-zoom80"></i></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">AG 电子</div>
                           <div class="gameinfo">
                               <i class="gamestar star-4"></i>
                               <div class="gameonline"><span class="cred">6655</span>人在玩</div>
                           </div>
                           <div class="gamebtns">
                               <a class="gamebtn-try" href="http://gci.sibo8888.com:81/forwardGame.do?params=AdNvyewondHSo0exZFScVuHiXidI1sU2VChfdsJDtsuyqJ+M+eq5kM26vhkQdT/Y9sNI+w80aEoC1/23PW0Lk/ZmFaWePmd3ngX+l/O0hH9ooB/RI5J6lCBcE5V0lfuL5l+Z/8MOlbyQMwBAi8Vojn2nvzMtF8Ih0LqOzrpf5yWUU/uOP1HneF1T6FJtaqnA4GFH8DsOwfe+4tp5cFhouRH77Y+hvK6IUmDlQa/wcajX4FaPrjKj5/M0T9WQ4qyN&key=bc7bae3292f308114eff28e88786ee82"
                                  target="_blank">试玩</a>
                               <a class="gamebtn-go" href="{:U('Index/slotgame','game_type=AG')}">进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">新电子游戏</div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="swiper-slide">
       <div class="gamelist gamelist-h">
           <div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><i class="icon-games icon-games-AG icon-zoom80"></i></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">AG 视讯</div>
                           <div class="gameinfo">
                               <i class="gamestar star-4"></i>
                               <div class="gameonline"><span class="cred">36713</span>人在玩</div>
                           </div>
                           <div class="gamebtns">
                               <a class="gamebtn-go" target="_blank" href="{:U('Zhenren/login',array('type'=>'ag'))}" >进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">站长推荐</div>
                   </div>
               </div>
           </div>
           <div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><i class="icon-games icon-games-BBIN icon-zoom80"></i></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">BB 视讯厅</div>
                           <div class="gameinfo">
                               <i class="gamestar star-5"></i>
                               <div class="gameonline"><span class="cred">23612</span>人在玩</div>
                           </div>
                           <div class="gamebtns">
                           <a class="gamebtn-go" target="_blank" href="{:U('Zhenren/login',array('type'=>'bbin'))}" >进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">BBIN热门品牌</div>
                   </div>
               </div>

           </div>
       </div>
   </div>
   <div class="swiper-slide">
       <div class="gamelist gamelist-h">
           <ul class="home_main am-avg-sm-3">
               <volist name="cplist" id="cp">
                   <li class="home_main_list">
                       <switch name="cp[typeid]">
                           <case value="k3">
                               <a
                               <if condition="is_array($userinfo)">
                                   onclick="window.location.href='{:U('Mobile/Game/k3',array('code'=>$cp[name]))}'"
                                   <else/>
                                   onclick="javascript: alerthd('{:U('Mobile/Game/k3',array('code'=>$cp[name]))}');"
                               </if>
                               data-game="">
                               <i class="iconfont" style="color:#07b39e"><img src="/app/k3.png"
                                                                              style="width:45px; padding-top:10px;"/></i>
                               <h3>{$cp[title]}</h3>
                               <p style="margin-top:-8px;font-size:11px;">{$cp[ftitle]|msubstr='0','6','utf-8',''}</p>
                           </case>
                           <case value="lhc">
                               <a
                               <if condition="is_array($userinfo)">
                                   onclick="window.location.href='{:U('Mobile/Game/lhc',array('code'=>$cp[name]))}'"
                                   <else/>
                                   onclick="javascript: alerthd('{:U('Mobile/Game/lhc',array('code'=>$cp[name]))}');"
                               </if>
                               data-game="">
                               <i class="iconfont" style="color:#07b39e"><img src="/app/lhc.png"
                                                                              style="width:45px; padding-top:10px;"/></i>
                               <h3>{$cp[title]}</h3>
                               <p style="margin-top:-8px;font-size:11px;">{$cp[ftitle]|msubstr='0','6','utf-8',''}</p>
                           </case>
                           <case value="ssc">
                               <a
                               <if condition="is_array($userinfo)">
                                   onclick="window.location.href='{:U('Mobile/Game/ssc',array('code'=>$cp[name]))}'"
                                   <else/>
                                   onclick="javascript: alerthd('{:U('Mobile/Game/ssc',array('code'=>$cp[name]))}');"
                               </if>
                               data-game="">
                               <i class="iconfont" style="color:#07b39e"><img src="/app/ssc.png"
                                                                              style="width:45px; padding-top:10px;"/></i>
                               <h3>{$cp[title]}</h3>
                               <p style="margin-top:-8px;font-size:11px;">{$cp[ftitle]|msubstr='0','6','utf-8',''}</p>
                           </case>
                           <case value="pk10">
                               <a
                               <if condition="is_array($userinfo)">
                                   onclick="window.location.href='/Game.pk10?code={$cp[name]}'"
                                   <else/>
                                   onclick="javascript: alerthd('/Game.pk10?code={$cp[name]}');"
                               </if>
                               data-game="">
                               <i class="iconfont" style="color:#07b39e"><img src="/app/pk10.png"
                                                                              style="width:45px; padding-top:10px;"/></i>
                               <h3>{$cp[title]}</h3>
                               <p style="margin-top:-8px;font-size:11px;">{$cp[ftitle]|msubstr='0','6','utf-8',''}</p>
                           </case>
                           <case value="keno">
                               <a
                               <if condition="is_array($userinfo)">
                                   onclick="window.location.href='{:U('Mobile/Game/keno',array('code'=>$cp[name]))}'"
                                   <else/>
                                   onclick="javascript: alerthd('{:U('Mobile/Game/keno',array('code'=>$cp[name]))}');"
                               </if>
                               data-game="">
                               <i class="iconfont" style="color:#07b39e"><img src="/app/kl8.png"
                                                                              style="width:45px; padding-top:10px;"/></i>
                               <h3>{$cp[title]}</h3>
                               <p style="margin-top:-8px;font-size:11px;">{$cp[ftitle]|msubstr='0','6','utf-8',''}</p>
                           </case>
                           <case value="x5">
                               <a
                               <if condition="is_array($userinfo)">
                                   onclick="window.location.href='{:U('Mobile/Game/x5',array('code'=>$cp[name]))}'"
                                   <else/>
                                   onclick="javascript: alerthd('{:U('Mobile/Game/x5',array('code'=>$cp[name]))}');"
                               </if>
                               data-game="">
                               <i class="iconfont" style="color:#07b39e"><img src="/app/11x5.png"
                                                                              style="width:45px; padding-top:10px;"/></i>
                               <h3>{$cp[title]}</h3>
                               <p style="margin-top:-8px;font-size:11px;">{$cp[ftitle]|msubstr='0','6','utf-8',''}</p>
                           </case>
                           <case value="dpc">
                               <a
                               <if condition="is_array($userinfo)">
                                   onclick="window.location.href='{:U('Mobile/Game/dpc',array('code'=>$cp[name]))}'"
                                   <else/>
                                   onclick="javascript: alerthd('{:U('Mobile/Game/dpc',array('code'=>$cp[name]))}');"
                               </if>
                               data-game="">
                               <i class="iconfont <?php if (strstr($cp['name'], '3d')) {
                               } else {
                               } ?>"><?php if (strstr($cp['name'], '3d')) { ?><img src="/app/3d.png"
                                                                                   style="width:45px; padding-top:10px;"><?php } ?><?php if (strstr($cp['name'], 'pl3')) { ?>
                                       <img src="/app/p3.png" style="width:45px; padding-top:10px;"><?php } ?></i>
                               <h3>{$cp[title]}</h3>
                               <p style="margin-top:-8px;font-size:11px;">{$cp[ftitle]|msubstr='0','6','utf-8',''}</p>
                           </case>
                       </switch>
                       </a>
                   </li>
               </volist>

               <li class="home_main_list">
                   <a href="{:U('Index/lotteryHall')}" style="color: #333;margin-top:13px;height:110px">
                       <i style="background: #fa7e00;width: 40px;height: 40px;border-radius: 50%;font-size: 25px;display: block;margin: 0 auto;color: #fff;line-height: 35px;">+</i>

                       <h3 style="margin-top:20px;">更多彩种</h3>
                       <p style="margin-top:-8px;font-size:11px;"></p>
                   </a>
               </li>
           </ul>
       </div>
   </div>
   <div class="swiper-slide">
       <div class="gamelist gamelist-h">
           <div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><img src="__ROOT__/Template/Mobile/images/real_person/MWfish.png" style="height:50px;"></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">AG 捕鱼王</div>
                           <div class="gameinfo">
                               <i class="gamestar star-5"></i>
                               <div class="gameonline"><span class="cred">72341</span>人在玩</div>
                           </div>
                           <div class="gamebtns">
                           <a class="gamebtn-go" target="_blank" href="{:U('Zhenren/login',array('type'=>'ag'))}" >进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">经典热门捕鱼</div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="swiper-slide">
       <div class="gamelist gamelist-h">
           <!--<div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><img src="__ROOT__/Template/Mobile/images/real_person/ky.png""></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">开元棋牌</div>
                           <div class="gameinfo">
                               <i class="gamestar star-5"></i>
                               <div class="gameonline"><span class="cred">36712</span>人在玩</div>
                           </div>
                           <div class="gamebtns">


                               <a class="gamebtn-go" target="_blank"
                               <if condition="is_array($userinfo)">
                                   onclick="window.location.href='{:url('Zhenren/jump_url','game_type=KY&page=egame')}'"
                                   <else/>
                                   onclick="javascript: alerthd();"
                               </if>
                               data-game="">进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">稳定棋牌游戏</div>
                   </div>
               </div>
           </div>-->
           <div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><img src="__ROOT__/Template/Mobile/images/real_person/game_images/ky/zjh.png" style="height:50px;"></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">扎金花</div>
                           <div class="gameinfo">
                               <i class="gamestar star-5"></i>
                               <div class="gameonline"><span class="cred">36712</span>人在玩</div>
                           </div>
                           <div class="gamebtns">
                           <a class="gamebtn-go" target="_blank" href="{:U('Zhenren/login',array('type'=>'ky'))}" >进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">开元棋牌-扎金花</div>
                   </div>
               </div>
           </div>
           <div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><img src="__ROOT__/Template/Mobile/images/real_person/game_images/ky/brnn.png"  style="height:50px;"></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">百人牛牛</div>
                           <div class="gameinfo">
                               <i class="gamestar star-5"></i>
                               <div class="gameonline"><span class="cred">25231</span>人在玩</div>
                           </div>
                           <div class="gamebtns">
                           <a class="gamebtn-go" target="_blank" href="{:U('Zhenren/login',array('type'=>'ky'))}" >进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">开元棋牌-百人牛牛</div>
                   </div>
               </div>
           </div>
           <div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><img src="__ROOT__/Template/Mobile/images/real_person/game_images/ky/ddz.png"  style="height:50px;"></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">斗地主</div>
                           <div class="gameinfo">
                               <i class="gamestar star-5"></i>
                               <div class="gameonline"><span class="cred">28691</span>人在玩</div>
                           </div>
                           <div class="gamebtns">
                           <a class="gamebtn-go" target="_blank" href="{:U('Zhenren/login',array('type'=>'ky'))}" >进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">开元棋牌-斗地主点</div>
                   </div>
               </div>
           </div>
           <div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><img src="__ROOT__/Template/Mobile/images/real_person/game_images/ky/sss.png" style="height:50px;"></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">十三水</div>
                           <div class="gameinfo">
                               <i class="gamestar star-5"></i>
                               <div class="gameonline"><span class="cred">123512</span>人在玩</div>
                           </div>
                           <div class="gamebtns">
                           <a class="gamebtn-go" target="_blank" href="{:U('Zhenren/login',array('type'=>'ky'))}" >进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">开元棋牌-十三水</div>
                   </div>
               </div>
           </div>
           <div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><img src="__ROOT__/Template/Mobile/images/real_person/game_images/ky/qzpj.png" style="height:50px;"></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">抢庄牌九</div>
                           <div class="gameinfo">
                               <i class="gamestar star-5"></i>
                               <div class="gameonline"><span class="cred">123512</span>人在玩</div>
                           </div>
                           <div class="gamebtns">
                           <a class="gamebtn-go" target="_blank" href="{:U('Zhenren/login',array('type'=>'ky'))}" >进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">开元棋牌-抢庄牌九</div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="swiper-slide">
       <div class="gamelist gamelist-h">
           <div class="gameitem">
               <div class="gametop">
                   <div class="gameicon"><i class="icon-games icon-games-IM icon-zoom80"></i></div>
                   <div class="gametxtbox">
                       <div class="gametxtbox-info">
                           <div class="gametitle">皇冠体育</div>
                           <div class="gameinfo">
                               <i class="gamestar star-5"></i>
                               <div class="gameonline"><span class="cred">28231</span>人在玩</div>
                           </div>
                           <div class="gamebtns">
                           <a class="gamebtn-go" target="_blank" href="{:U('Zhenren/login',array('type'=>'ss'))}" >进入</a>
                           </div>
                       </div>
                       <div class="gametxtbox-activity">皇冠体育</div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   </div>
   </div>
   </div>
   </div>
   </main>


   <footer>
       <div class="AppFooter is-fixed">
           <if condition="is_array($userinfo)">
               <a class="nav-item" href="{:U('Account/rechargeList')}">
                   <svg class="icon" aria-hidden="true">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-qian"></use>
                   </svg>
                   <span style="color:#e2ff00;"><b>快速充值</b></span>
               </a>
               <a class="nav-item" href="{:U('Account/withdrawals')}">
                   <svg class="icon" aria-hidden="true">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-tixian1"></use>
                   </svg>
                   <span>线上取款</span>
               </a>
               <a class="nav-item" href="{:U('Member/quota')}">
                   <svg class="icon" aria-hidden="true">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-huhuan"></use>
                   </svg>
                   <span>额度转换</span>
               </a>
               <!--<a class="nav-item " href="">
                   <svg class="icon" aria-hidden="true">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink"
                            xlink:href="#icon-yonghuguanlixiugaibeizhu"></use>
                   </svg>
                   <span>优惠办理</span>
               </a>-->
               <a class="nav-item " href="{:U('Activity/activityList')}">
                   <svg class="icon" aria-hidden="true">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink"
                            xlink:href="#icon-yonghuguanlixiugaibeizhu"></use>
                   </svg>
                   <span>优惠活动</span>
               </a>

               <a class="nav-item" href="{:GetVar('mobile_kefuthree')}" target="_blank">
                   <svg class="icon" aria-hidden="true">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-zaixiankefu"></use>
                   </svg>
                   <span>在线客服</span>
               </a>
               <else/>
               <a class="nav-item" href="/">
                   <svg class="icon" aria-hidden="true">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-liwu"></use>
                   </svg>
                   <span class="am-navbar-label">首页</span>
               </a>
               
               <a class="nav-item" href="javascript:;" id="memberregister">
                   <svg class="icon" aria-hidden="true">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-zhuce"></use>
                   </svg>
                   <span>立即注册</span>
               </a>
               <a class="nav-item" href="javascript:;" id="memberstatus">
                   <svg class="icon" aria-hidden="true">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-denglu"></use>
                   </svg>
                   <span>立即登录</span>
               </a>
               
               <a class="nav-item" href="{:GetVar('mobile_kefuthree')}" target="_blank">
                   <svg class="icon" aria-hidden="true">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-zaixiankefu"></use>
                   </svg>
                   <span>在线客服</span>
               </a>
           </if>

       </div>
   </footer>
</div>
<div class="AppMask" style="display: none;"></div>
<if condition="is_array($userinfo)">
<div class="AppSidebar" style="right: -240px;">
    <div class="AppSidebar-top">
        <div class="usericon">
            <img src="__ROOT__{$userinfo['face']}" class="am-radius" alt="">
        </div>
        <div class="userinfo">
            <div class="username">
                <span class="name">{$userinfo.username}</span>
                <span class="close-icon">
                    <i class="am-icon-close"></i>
                </span>
            </div>
            <div class="money" id="ye">余额：
                <span class="balance smallmoney">{$userinfo.balance}</span>
                <span class="refresh-icon">
                    <svg class="icon refresh_money" aria-hidden="true">
                        <use xlink:href="#icon-shuaxin"></use>
                    </svg>
                </span>
            </div>
        </div>
    </div>
    <div class="AppSidebar-quickbtn">
        <a class="AppHeader-green" href="{:U('Account/rechargeList')}">充值</a>
        <a class="AppHeader-yellow" href="{:U('Account/withdrawals')}">取款</a>
        <a class="AppHeader-white" href="{:U('Member/quota')}">额度转换</a>
    </div>
    <div class="AppSidebar-userlink">
        <a href="{:U('Member/personalInfo')}">个人资料</a>
        <a href="{:U('Member/index')}">安全中心</a>
        <a href="{:U('Member/orderform')}">投注记录</a>
        <a href="{:U('Member/orderform')}">交易记录</a>
        <a href="{:U('Account/todayloss')}">今日盈亏</a>

    </div>
    <div class="AppSidebar-nav">
        <div class="navgroup">
<!--            <a href="{:U('Activity/fszhongxin')}">
                <span class="icons msg-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-zizhufanshui"></use>
                    </svg>
                </span>
                <span class="txt" style="font-size:15px; color:yellow;"><b>自助返水</b></span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>-->
            <if condition="$userinfo['proxy'] eq 1">
			    <a href="{:U('Member/agent')}">
                <span class="icons msg-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-zizhufanshui"></use>
                    </svg>
                </span>
                <span class="txt" style="font-size:15px; color:yellow;"><b>代理中心</b></span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
             </if>

        </div>
        <div class="navgroup">
            <a href="{:U('Member/gglist')}">
                <span class="icons msg-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-gonggao"></use>
                    </svg>
                </span>
                <span class="txt">最新消息</span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
            <a href="{:U('Activity/activityList')}">
                <span class="icons activity-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-liwu"></use>
                    </svg>
                </span>
                <span class="txt">优惠活动</span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
        </div>
        <div class="navgroup">

            <a href="{:GetVar('mobile_kefuthree')}" target="_blank">
                <span class="icons service-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-zaixiankefu"></use>
                    </svg>
                </span>
                <span class="txt">在线客服</span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
        </div>
       <div class="navgroup">

           <a href="http://www.17rtx.cn/KQ0WK3" target="_blank">
                <span class="icons appdownload-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-shouji"></use>
                    </svg>
                </span>
                <span class="txt">app下载</span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
        </div>
        <div class="navgroup">
            <a href="{:U('Public/LoginOut')}">
                <span class="icons loginout-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-tuichu"></use>
                    </svg>
                </span>
                <span class="txt">退出登录</span>
                <span class="go-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-arrow-right-copy-copy-copy"></use>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</div>
</if>

    <script src="__JS__/swiper.min.js"></script>

    <include file="Public/login1" />
   <include file="Public/register1" />
    <script type="text/javascript">

    $(function () {
        $('.gametab .swiper-slide:first-child').click();
        var content_height = $(".gamelist").eq(0).height();
        var slide_height = $("#gameslist>.swiper-slide").eq(0).height(content_height);
        $("#gameslist>.swiper-wrapper").css("height", content_height);
        $("#gameslist>.swiper-container").css("height", content_height);
        $(".user-menu").click(function () {
            $(".AppSidebar").css("right", "0");
            $(".AppMask").fadeIn(300);
        });
        $(".AppMask,.close-icon").click(function () {
            $(".AppSidebar").css("right", "-240px");
            $(".AppMask").fadeOut(300);
        });
    })


        function alerthd($url) {
            $.cookie('addr_url',$url);
                $(document).dialog({
                type: 'confirm',
                    closeBtnShow: true,
                    titleText: '温馨提示',
                    content: '请登录后, 再进行游戏!',
                    buttonTextConfirm: '登录',
                    buttonTextCancel: '注册',
                    onClickConfirmBtn: function () {
                   $('.login-form-mask').fadeIn(100);
                   $('#J_loginModal').slideDown(200);
                },
                    onClickCancelBtn: function () {
                   $('.login-form-mask').fadeIn(100);
                   $('#J_regModal').slideDown(200);
                },
                    onClickCloseBtn: function () {
                }
            });
        }
		        function alert(message) {
            $(document).dialog({
                titleText: '温馨提示',
                content: message,
            });
        }
        var mySwiper = new Swiper('#banner', {
       loop: true,
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {

          delay: 2500,
          disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
      },
    });
    var noticeswiper = new Swiper('#notice', {
      centeredSlides: true,
      direction:"vertical",
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      }
    });
    var noticeswiper = new Swiper('.bigwinlist .swiper-container', {
      centeredSlides: true,
      direction:"vertical",
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      }
    });
	var mySwiper = new Swiper('.gametab .swiper-container', {

        freeMode: true,
        freeModeMomentumRatio: 0.5,
        slidesPerView: 'auto',

	});
        var mySwiper = new Swiper('.poppage-menu .swiper-container', {
            freeMode: true,
            freeModeMomentumRatio: 0.5,
            slidesPerView: 'auto'
        });
        $(window).load(function () {
            $("#loadingbg").fadeOut(200);
        });

        $(function () {
            var winh = $(window).height();
        var plisth = winh - 94;
            $(".poppage-list").css("height", plisth + "px");
            $(".btn-more").click(function () {
                $(".poppage").fadeIn(300);
        });
            $(".poppage-head .icon-close").click(function () {
                $(".poppage").fadeOut(300);
        });
            $(".botpop-top .icon-close").click(function () {
                $(".botpop").css("bottom", "-204px");
        });
            //setInterval(function () {  //弹提示框
            //    $(".botpop").css("bottom", "56px");
            //}, 5000);
	    var status ='';
        if (status == "1") {
            $(document).dialog({
            titleText: '1231',
                content: '123123',
            });
        } else if (status == "2") {
            $(document).dialog({
            type: 'image',
                closeBtnShow: true,
                titleShow: true,
                titleText: '123',
                content: '<img src="Public/Home/picture/banner.png" />',
            });
        } else {
        }
    	$(".my-icon").click(function(){
    		$(".AppSidebar").css("right","0");
    		$(".AppMask").fadeIn(300);
        });
        $(".huiyuan").click(function () {
            $(".AppSidebar").css("right", "0");
            $(".AppMask").fadeIn(300);
        });
    	$(".AppMask,.close-icon").click(function(){
    		$(".AppSidebar").css("right","-240px");
    		$(".AppMask").fadeOut(300);
        });
	    var gamesSwiper = new Swiper('#gameslist');
        gamesSwiper.on('slideChange', function () {
            var j = gamesSwiper.activeIndex;
            $('.gametab .swiper-slide').removeClass('active').eq(j).addClass('active');

            var content_height = $(".gamelist").eq(j).height();
            var slide_height = $("#gameslist>.swiper-slide").eq(j).height(content_height);
            $("#gameslist>.swiper-wrapper").css("height", content_height);
            $("#gameslist>.swiper-container").css("height", content_height);
        });
	    /*列表切换*/
	    $('.gametab .swiper-slide').on('click', function (e) {
            e.preventDefault();
            //得到当前索引
            var i = $(this).index();
	        $('.gametab .swiper-slide').removeClass('active').eq(i).addClass('active');

            var content_height = $(".gamelist").eq(i).height()+20;
            var slide_height = $("#gameslist>.swiper-slide").eq(i).height(content_height);
	        $("#gameslist>.swiper-wrapper").css("height", content_height);
	        $("#gameslist>.swiper-container").css("height", content_height);
            gamesSwiper.slideTo(i, 1000, false);

        });
            $(".gamelist-v .gameitem[data-game='LOTTERY']").click(function () {
            gamesSwiper.slideTo(3, 1000, false);
        });
        })


    jQuery(document).ready(function ($) {
        $('#J_loginModal_new').click(function () {
            $('.login-form-mask').fadeIn(100);
            $('#J_loginModal').slideDown(300);
        });
        $('.close').click(function () {
            $('.login-form-mask').fadeOut(100);
            $('#J_loginModal').slideUp(200);
        });
        $('#memberstatus').click(function () {
            $('.login-form-mask').fadeIn(100);
            $('#J_loginModal').slideDown(200);
        });

        $('#J_regModal_new').click(function () {
            $('.login-form-mask').fadeIn(100);
            $('#J_regModal').slideDown(200);
        });

        $('#memberregister').click(function () {
            $('.login-form-mask').fadeIn(100);
            $('#J_regModal').slideDown(200);
        });
    })
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

</body>
</html>