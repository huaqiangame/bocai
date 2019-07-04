<style>
    .theme-red .icon-sanjiaoxing{
        display: inline-block;
        transform: rotate(180deg);
        transition: .6s;
        font-size: 16px;
    }
</style>

<header class="bar bar-nav theme-red">
    <if condition="$userinfo and ($userinfo['islogin'] eq 1)">
    <if condition="(strtolower(CONTROLLER_NAME) eq 'index') and (strtolower(ACTION_NAME) eq 'index')">
    <a class="button button-link button-nav pull-left bar-nav-top-left" href="{:U('Index/lotteryHall')}" >
        <span class="icon icon-home"></span>
    </a>
    <else />
    <a class="button button-link button-nav pull-left bar-nav-top-left" href="{:U('Index/lotteryHall')}">
        <span class="iconfont icon-goucaidating"></span>
    </a>
    </if>
    <if condition="(strtolower(CONTROLLER_NAME) eq 'game') and (strtolower(ACTION_NAME) eq 'k3') and is_array($nowcpinfo)">
    <h1 class="title" onclick="GamePageSwitchToggle();">{$nowcpinfo.title}<i class="iconfont icon-sanjiaoxing"></i></h1>
    
    <else />
    <h1 class="title">{$webheadertitle}</h1>
    </if>

    <else />
    <if condition="(strtolower(CONTROLLER_NAME) eq 'index') and (strtolower(ACTION_NAME) eq 'index')">
    <a class="button button-link button-nav pull-left bar-nav-top-left" href="/">
        <span class="iconfont icon-goucaidating"></span>
    </a>
    <else />
    <a class="button button-link button-nav pull-left bar-nav-top-left" href="{:U('Index/lotteryHall')}">
        <span class="icon icon-left"></span>
    </a>
    </if>
    <if condition="(strtolower(CONTROLLER_NAME) eq 'game') and (strtolower(ACTION_NAME) eq 'k3') and is_array($nowcpinfo)">
    <h1 class="title" onclick="GamePageSwitchToggle();">{$nowcpinfo.title} <span class="icon icon-down" style="font-size:0.8rem;"></span></h1>
    <!-- <div class="pa yyplay_select_container" id="PageSwitch">
        <volist name="k3list" id="k3vo">
        <a href="{:U('Game/k3',['code'=>$k3vo['name']])}">{$k3vo.title}</a>
        </volist>
    </div> 技术支持QQ:33723247【禁止非法运营赌博，谁充值赌博谁傻逼】-->
    <else />
    <h1 class="title">{$webheadertitle}</h1>
    </if>
    </if>
    <!-- 选择与切换玩法 -->
	        <em class="gameInfo" style="font-size: 12px;display: inline-block;line-height: 13px;text-align: left;margin-top: 13px;">玩<br>法</em>
        <div class="choice_lottery_playdetail_left">
            <a class="choice_playName" href="#">和值</a>
            <i class="iconfont icon-sanjiaoxing" style="color: #f0c930;transform: rotate(180deg);transition: .6s;"></i>
        </div>    
	    <div class="newcode">
            <div style="float: left;margin-left:1.2em;font-size:15px;" id="my_tz">我的投注<div class="activetz"></div></div>
            <div style="float: left;margin-left: 1.2em;font-size:15px;color:#999999;"  id="tz_jl">投注记录<div ></div></div>
            <div style="float: left;margin-left: 25%;font-size:15px;">余额:<span class="smallmoney">{$userinfo['balance']}</span><div ></div></div>
	        <i class="iconfont icon-shuaxin am-fr my_home_refresh refresh_money" style="display: block;"></i>  
            <div style="clear: both;"></div>
        </div>
        <div class="tz_read">
            <table border="0" class="newtable">
                <tr>
                    <th style="color: #fff;text-align: center;">投注单号</th>
                    <th style="color: #fff;text-align: center;width: 30%">投注金额</th>
                    <th style="color: #fff;text-align: center;width: 20%">奖金</th>
                    <th style="color: #fff;text-align: center;width: 20%">操作</th>
                </tr>
            </table>
            <div id="query-result">
                <div id="jiaz" style="text-align: center;">

                </div>
            </div>
        </div>

</header>

