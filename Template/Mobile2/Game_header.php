<style>
    .theme-red .icon-sanjiaoxing{
        display: inline-block;
        transform: rotate(180deg);
        transition: .6s;
        font-size: 22px;
    }
</style>

<header class="bar bar-nav theme-red" style="background:#000;text-align:center;">
    <if condition="$userinfo and ($userinfo['islogin'] eq 1)">
    <if condition="(strtolower(CONTROLLER_NAME) eq 'index') and (strtolower(ACTION_NAME) eq 'index')">
    <a class="button button-link button-nav pull-left bar-nav-top-left" href="/">
        <span class="icon icon-home"></span>
    </a>
    <else />
    <a class="button button-link button-nav pull-left bar-nav-top-left" href="/">
        <span class="iconfont icon-shouyeshouye1"></span>
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
        <span class="iconfont icon-shouyeshouye1"></span>
    </a>
    <else />
    <a class="button button-link button-nav pull-left bar-nav-top-left" href="/">
        <span class="icon icon-left"></span>
    </a>
    </if>

    <a class="button button-link button-nav pull-right" onclick="lianxikefu('{$WebConfigs.kefuthree}')">
        <span class="icon icon-message"></span>
        联系客服
    </a>
    <if condition="(strtolower(CONTROLLER_NAME) eq 'game') and (strtolower(ACTION_NAME) eq 'k3') and is_array($nowcpinfo)">
    <h1 class="title" onclick="GamePageSwitchToggle();">{$nowcpinfo.title} <span class="icon icon-down" style="font-size:0.8rem;"></span></h1>
    <!-- <div class="pa yyplay_select_container" id="PageSwitch">
        <volist name="k3list" id="k3vo">
        <a href="{:U('Game/k3',['code'=>$k3vo['name']])}">{$k3vo.title}</a>
        </volist>
    </div> -->
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

</header>

