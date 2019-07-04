<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
    <h1 class="am-header-title userHome_h1">
        我的账户
    </h1>
    <div class="am-header-right am-header-nav header_down">
        <a href="{:GetVar('kefuthree')}" class="">
            客服
        </a>
    </div>
</header>

<div class="my_header">
    <div class="my_info am-cf">
        <div class="img am-fl">
            <img src="__ROOT__{$userinfo['face']}" class="am-radius" alt="">
        </div>
        <div class="am-fl my_header_content">
            <p>账号：<em>{$userinfo['username']}</em></p>

            <p>余额：{$userinfo['balance']} </p>
        <p><a href="{:U('Member.index.do')}">余额刷新</p>
        </div>

    </div>
    <div class="my_operation_money">
        <ul class="am-avg-sm-4">
            <li>
                <a href="{:U('Account/rechargeList')}">
                    <i class="iconfont icon-chongzhi"></i>
                    <em>我要充值</em>
                </a>
            </li>
            <li>
                <a href="{:U('Account/withdrawals')}">
                    <i class="iconfont icon-tixian"></i>
                    <em>我要提现</em>
                </a>
            </li>
            <li>
                <a href="{:U('Account/dealRecord')}">
                    <i class="iconfont icon-jiaoyijilu"></i>
                    <em>交易记录</em>
                </a>
            </li>
            <li>
                <a href="{:U('Member/betRecord')}">
                    <i class="iconfont icon-touzhujilu"></i>
                    <em>投注记录</em>
                </a>
            </li>
        </ul>
    </div>
</div>

<ul class="my_set_list">
    <li>
        <a href="{:U('Member/personalInfo')}" class="am-cf">
            <i class="iconfont icon-wode square_bg"></i>
            <span>个人信息</span>
            <i class="iconfont icon-arrowright"></i>
        </a>
    </li>
   <eq name="userinfo['proxy']" value="1">
    <li>
        <a href="{:U('Member/agent')}" class="am-cf">
            <i class="iconfont icon-qian square_bg" style="background: #dd514c;"></i>
            <span>代理中心</span>
            <i class="iconfont icon-arrowright"></i>
        </a>
    </li>
   </eq>
    <li>
        <a href="{:U('Member/setting')}" class="am-cf">
            <i class="iconfont icon-safe square_bg"></i>
            <span>安全中心</span>
            <i class="iconfont icon-arrowright"></i>
        </a>
    </li>
	<li>
        <a href="/Activity.index.do" class="am-cf">
            <i class="iconfont icon-giftfill square_bg" style="background:#f37b1d;"></i>
            <span>活动中心</span>
            <i class="iconfont icon-arrowright"></i>
        </a>
    </li>
	 <li>
        <a href="{:U('Member/trans')}" class="am-cf">
            <i class="iconfont icon-shuju square_bg"></i>
            <span>额度转换</span>
            <i class="iconfont icon-arrowright"></i>
        </a>
    </li>	
    <li>
        <a href="{:U('Account/todayLoss')}" class="am-cf">
            <i class="iconfont icon-shuju square_bg"></i>
            <span>今日盈亏</span>
            <i class="iconfont icon-arrowright"></i>
        </a>
    </li>
    <li>
        <a href="{:U('Member/gglist')}" class="am-cf">
            <i class="iconfont icon-tubiao15 square_bg"></i>
            <span>平台公告</span>
            <i class="iconfont icon-arrowright"></i>
        </a>
    </li>
</ul>
<div class="security_close">
    <a href="javascript:if(confirm('是否退出？'))location='{:U('Public/LoginOut')}'" class="am-cf">
        <span>退出登录</span>
        <i class="iconfont icon-arrowright am-fr"></i>
    </a>
</div>

<include file="Public/footer" />
<script>
    // $(document).on('click','.security_close',function () {

    // })
</script>
</body>
</html>