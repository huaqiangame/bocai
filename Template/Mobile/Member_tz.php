<include file="Public/header" />
<script src="__JS__/swiper.min.js"></script> 
<link rel="stylesheet" href="__CSS__/userHome.css">
<link rel="stylesheet" href="__CSS__/list.css">
<style type="text/css">
.page .num{width: 20px;display: inline-block;}
</style>
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			游戏记录
		</font></h1>
		</div>
    <div class="app">
        <main>
            <div class="AppList-container">
                <div class="AppList-item" id="tzjl" data-url="game">
                    <div class="AppList-search">
                        <div class="AppList-searchrow">
                            <div class="searchitem">
                                <label>局号：</label>
                                <div class="inputtxt">
                                    <input type="text" name="roundnum" id="roundnum" placeholder="局号" maxlength="16">
                                </div>
                            </div>
                            <span class="has-space">&nbsp;</span>
                            <div class="searchitem">
                                <div class="inputtxt">
                                    <select class="search-select" id="searchgame">
                                        <option value="AG" selected>AG平台</option>
                                        <option value="MG">MG平台</option>
                                        <option value="BBIN">BBIN平台</option>
                                        <option value="GB">CQ9电子</option>
                                        <option value="KY">开元棋牌</option>
                                        <option value="VR">VR彩票</option>
                                        <option value="MW">MW电子</option>
                                        <option value="PT">PT电子</option>
                                        <option value="ALLBET">ALLBET（欧博）</option>
                                        <option value="SUNBET">SUNBET（申博）</option>
                                        <option value="SANS">SANS（三昇）</option>
                                        <option value="OG">OG视频</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="AppList-searchrow has-top">
                            <div class="searchitem">
                                <label>投注日期：</label>
                                <div class="inputtxt">
                                    <span class="date-icon">
                                        <svg class="icon" aria-hidden="true">
                                            <use xlink:href="#icon-rili1"></use>
                                        </svg>
                                    </span>
                                    <input class="date" type="date" id="gamestarttime" name="gamestarttime"
                                           placeholder="开始时间" value="<?php echo date("Y-m-d",strtotime('-1 day'))?>">
                                </div>
                            </div>
                            <span class="has-space">-</span>
                            <div class="searchitem">
                                <div class="inputtxt">
                                    <span class="date-icon">
                                        <svg class="icon" aria-hidden="true">
                                            <use xlink:href="#icon-rili1"></use>
                                        </svg>
                                    </span>
                                    <input class="date" type="date" id="gameendtime" name="gameendtime"
                                           placeholder="结束时间" value="<?php echo date("Y-m-d")?>">
                                </div>
                                <a id="listgame" class="seachbtn">搜索</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
        <div class="AppList-warp" style="max-height: 480px;">
            <table class="recordtable" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <th>订单号</th>
                    <th>下注时间</th>
                    <th>游戏类型</th>
                    <th>下注金额</th>
                    <th>有效金额</th>
                    <th>损益</th>
                    <!--<th>备注</th>-->
                </tr>
                </thead>
                <tbody id="tzjl">
                <?php if($data){
                    $game_kind = array('live'=>'真人','egame'=>'电子');
                    foreach ($data as $v){?>
                    <tr>
                        <td><?php echo $v['BillNo']?></td>
                        <td><?php echo substr($v['BetTime'],2)?></td>
                        <td><?php echo $game_kind[$v['GameKind']]?></td>
                        <td><?php echo $v['BetAmount']?></td>
                        <td><?php echo $v['ValidBetAmount']?></td>
                        <td><?php echo $v['NetAmount']?></td>
                        <td><?php echo $v['NetAmount']?></td>
                    </tr>
                <?php }?>
                    <tr><td colspan="7" class="page">{$page}</td></tr>
                <?php }else{?>
                    <tr>
                        <td colspan="30">暂无数据</td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        <div class="AppList-allinfo">
            <div class="allinfo-item">
                <span class="tit">有效投注额：</span>
                <span class="val" id="youxiaotouzhu">￥0.00</span>
            </div>
            <div class="allinfo-item">
                <span class="tit">损益：</span>
                <span class="val" id="sunyi">￥0.00</span>
            </div>
        </div>
        <!--<div class="AppList-warp">
            <div class="AppList-list" id="gamerecordlist">

            </div>
        </div>-->
    </div>


    <script src="__JS__/dropload.js"></script>
    <script src="__JS__/tz.js"></script>

   <include file="Public/footer" />
</body>
</html>