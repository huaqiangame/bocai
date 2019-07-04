<!--header start-->
<script>
    var WebConfigs = {
        "ROOT" : "__ROOT__",
        'IMG' : "__IMG__"
    }
</script>
<link rel="stylesheet" type="text/css" href="__CSS__/artDialog.css" />
<script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__JS__/artDialog.js"></script>
<script type="text/javascript" src="/resources/js/way.min.js"></script>
<script type="text/javascript" src="/resources/main/common.js"></script>
<header class="header" style="background:#000;height:40px;line-height:40px;">
    <div class="container claerfix">
        <div class="allLottery2" style="position:absolute;left: -40px;bottom: -366px;">
            <img src="/resources/images/allgamelink2.png" />
        </div>
        <div class="pull-left backLeft" style="color:#fff;">
            <a href="{:U('Index/lottery')}" class="backHomeBtn" style="color:#fff;">购彩大厅</a>
            |
            <a href="javascript:void(0);" class="allLottery" style="color:#fff;">全部彩票</a>
            <div class="backLeftLottery" style="display: none;">
                <i class="user_login_info2_i"></i>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle" >快三</dt>
                    <dd class="aLotteryListK3">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'k3'">
                            <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle">时时彩</dt>
                    <dd class="aLotteryListSSC">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'ssc'">
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle">快乐彩</dt>
                    <dd class="aLotteryListKLC">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'keno' or $cp['typeid'] eq 'pk10'">
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle">十一选五</dt>
                    <dd class="aLotteryListSYSW">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'x5'">
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle">六合彩</dt>
                    <dd class="aLotteryListDPC">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'lhc'">
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle">低频彩</dt>
                    <dd class="aLotteryListDPC">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'dpc'">
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
            </div>
            <div class="backLeftLottery2" style="display: none;">
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle" >快三</dt>
                    <dd class="aLotteryListK3">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'k3'">
                            <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle">时时彩</dt>
                    <dd class="aLotteryListSSC">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'ssc'">
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle">快乐彩</dt>
                    <dd class="aLotteryListKLC">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'keno' or $cp['typeid'] eq 'pk10'">
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle">十一选五</dt>
                    <dd class="aLotteryListSYSW">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'x5'">
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle">六合彩</dt>
                    <dd class="aLotteryListDPC">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'lhc'">
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
                <dl class="aLotteryList">
                    <dt class="aLotteryListTitle">低频彩</dt>
                    <dd class="aLotteryListDPC">
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'dpc'">
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                            </if>
                        </volist>
                    </dd>
                </dl>
            </div>
        </div>
        <script>
            // 全部彩票2
            var timerall2 = null;
            $('.allLottery2,.backLeftLottery2').mouseover(function (){
                if(timerall2){
                    clearTimeout(timerall2);
                }
                $('.backLeftLottery2').show();
            })
            $('.allLottery2,.backLeftLottery2').mouseout(function (){
                timerall2 = setTimeout(function (){
                    $('.backLeftLottery2').hide();
                },300)
            })
            $(document).on('mouseover','.moneyInfo',function (){
                $(this).find('.moneyInfoHover').show();
            })
            $(document).on('mouseout','.moneyInfo',function (){
                $(this).find('.moneyInfoHover').hide();
            })
        </script>
        <notempty name="userinfo.username">
            <div class="pull-right user_login_info">
                <ul>
                    <li class="user_login_info1">
                        <a  href="{:U('Index/index')}" style="color:#fff;" class="user_header" data-html="true" class="user_header" data-container="body" data-toggle="popover" data-placement="bottom"data-content='<div class="ceng"><div class="media"><div class="media-left"><a href="{:U('Member/index')}"><img src="__ROOT__{$userinfo.face}" alt="" class="media-boject img-circle"></a><p>{$userinfo.username}</p></div><div class="media-body" style="padding-bottom:10px;">
                 
                <p class="margin_0">账号：<span>{$userinfo.username}</span></p>
                <p class="margin_0">等级：<span>{$userinfo.groupname}</span></p>
                <p class="margin_0">头衔：<span><eq name="userinfo['groupname']" value='代理'>总代理 <else />{$userinfo.touhan} </eq></span></p>
              <!--  <p class="margin_0">累积中奖：<span>{$Think.session.okamountcount}</span></p>-->
            </div>
            <div class="media-footer">
                <volist name="Think.session.k3names" id="value">
                    <a href="{:U('Game/k3')}?code={$value['cpname']}" title="{$value.cptitle}" class="color_res" style="font-size:5px;"><span style="color:#333;display: block;margin-top:4px;">{$value.cptitle|substr=0,6}</span><i class="iconfont">&#xe607;</i></a>
                </volist>
            </div></div></div>'>
       <img class="img-circle"  src="__ROOT__{$userinfo.face}" alt="">
    {$userinfo['username']}
    </a>
    <a class="user_info" style="display:none">
        0
    </a>
<div class="info_sum_box" style="display: none;">
        <div class="info_sum clearfix">
            <a href="" class="pull-left">
                我的未读消息
                (<em>0</em>)
            </a>
            <a href="" class="pull-right">
                更多
            </a>
        </div>
    </div>
    </li>
    <li class="user_login_info2">
        <a href="{:U('Member/index')}" class="my_account" style="color:#fff;"onclick="window.open(this.href,'_blank','scrollbars=0,resizable=0,width=1000,height=726');return false">
            我的账户
            <i class="iconfont">&#xe6a1;</i>
        </a>
        <div class="user_login_info2_list" style="display:none;">
            <!--<i class="user_login_info2_i"></i>
            <if condition="$userinfo.proxy eq '1'">
                <a href="{:U('Member/Agent')}">代理中心</a>
            </if>-->
            <a href="{:U('Member/betRecord')}" onclick="window.open(this.href,'_blank','scrollbars=0,resizable=0,width=1000,height=726');return false">投注记录</a>
            <a href="{:U('Account/dealRecord')}" onclick="window.open(this.href,'_blank','scrollbars=0,resizable=0,width=1000,height=726');return false">交易记录</a>
            <a href="{:U('Member/ziliao')}" onclick="window.open(this.href,'_blank','scrollbars=0,resizable=0,width=1000,height=726');return false">个人信息</a>
            <a href="{:U('Member/index')}" onclick="window.open(this.href,'_blank','scrollbars=0,resizable=0,width=1000,height=726');return false">安全中心</a>
        </div>
    </li>
    <li class="user_login_info3" style="color:#fff;">
        余额：
						<span class="show_money">
							<em class="smallmoney" style="color:#F70B0F;">{$userinfo['balance']}</em>
							<i class="iconfont refresh_money">&#xe602;</i>
							<em class="hide_money_btn" style="color:#fff;">隐藏</em>
						</span>
						<span class="hide_money" style="display:none;color:#fff;">
							已隐藏
							<em class="show_money_btn" style="color:#fff;">显示</em>
						</span>
    </li>
    <li class="xima l" style="color:#fff;">洗码：<span class="c-green" style="color:green;" way-data="user.xima">0</span></li>
    <li class="user_login_info4">
        <a href="{:U('Account/Recharge')}" style="color:#fff;">充值</a>
    </li>
    <li class="user_login_info5">
        <a href="{:U('Account/withdrawals')}" style="color:#fff;">提现</a>
    </li>
    <li class="user_login_info6">
        <a href="{:U('Public/LoginOut')}" style="color:#fff;">退出</a>
    </li>
    <li>
        <a href="{:GetVar('kefuthree')}" target="_blank" class="keufBox" style="margin-left: 0px;margin-top:8px;"></a>
    </li>
    <li style="padding:0;line-height: 59px;">
        <a href="{:GetVar('kefuqq')}"    target="_blank">
            <img src="/resources/images/qq.gif" width="20" height="20" style="vertical-align: super;" />
        </a>
    </li>
    </ul>
    </div>
    <else/>
    <div class="pull-right user_login_info ">
        <a style="margin:0;color:#fff;" href="{:U('Public/login')}">亲，请登录</a>
        <em style="margin:0 3px;color:#fff;">|</em> <a href="{:U('Public/register')}" style="color:#fff;">用户注册</a><em style="margin:0 3px;color:#fff;">|</em>
        <a href="{:U('Member/Agent')}" style="color:#fff;">代理中心</a>
    </div>
    </notempty>
    </div>
</header>

<script>
    var ISLOGIN = "{$userinfo.id}";
</script>

<script>
    $(function () {
        $('.refresh_money').click(function () {
            $.ajax({
                url:"{:U('Account/refreshmoney')}",
                type:'POST',
                success :function (data) {
                    $('.smallmoney').html(data);
                }
            })
        })

    })
</script>