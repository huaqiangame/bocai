<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/activity.css">
<!--<style>
	body{
		background-color: #fff;
	}
</style>-->
<body>
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
    </div>

		<h1 class="am-header-title activity_h1">
			选择充值方式
		</h1>
	</header>

  <!--

  <div class="activity_list">
			<?php
  include($_SERVER["DOCUMENT_ROOT"].'/mcbpay/mcbconfig.php');
  ?>
    <a href="//<?php echo MCB_PAYDOMAIN;?>/pay/?appid=<?php echo MCB_APPID;?>&payno={$userinfo.username}&pt=wap&back_url=<?php echo urlencode('//'.$_SERVER['HTTP_HOST'].'/#');?>" class="am-cf am-block">
      <div class="am-fl">
        <svg class="icon" aria-hidden="true">
          <use xlink:href="#icon-kuaijiezhifu"></use>
        </svg>
      </div>
      <div class="activity_list2 am-fl">
        <p  style="font-size:0.22rem;margin-top:0.08rem">支付宝/微信/手Q扫码</p>
        <em>单笔最低100元，最高100000元。</em>
      </div>
      <div class="activity_list3 am-fr">
        <i class="iconfont icon-arrowright"></i>
      </div>
    </a>
  </div>
-->

  <div class="activity_list">
    <a href="{:U('Account/recharge')}" class="am-cf am-block">
      <div class="am-fl">
        <svg class="icon" aria-hidden="true">
          <use xlink:href="#icon-yinlianzhifu"></use>
        </svg>
      </div>
      <div class="activity_list2 am-fl">
        <p>银行转账</p>
        <em>单笔最低10元，最高500000元。</em>
      </div>
      <div class="activity_list3 am-fr">
        <i class="iconfont icon-arrowright"></i>
      </div>
    </a>
  </div>

  <div class="activity_list">
    <a href="{:U('Account/wxRecharge')}" class="am-cf am-block">
      <div class="am-fl">
        <svg class="icon" aria-hidden="true">
          <use xlink:href="#icon-weixin-copy"></use>
        </svg>
      </div>
      <div class="activity_list2 am-fl">
        <p style="font-size:0.22rem;margin-top:0.08rem">微信在线充值</p>
      </div>
      <div class="activity_list3 am-fr">
        <i class="iconfont icon-arrowright"></i>
      </div>
    </a>
  </div>

  <div class="activity_list">
    <a href="{:U('Account/zfbRecharge')}" class="am-cf am-block">
      <div class="am-fl">
        <svg class="icon" aria-hidden="true">
          <use xlink:href="#icon-zhifubao"></use>
        </svg>
      </div>
      <div class="activity_list2 am-fl">
        <p style="font-size:0.22rem;margin-top:0.08rem">支付宝在线充值</p>
      </div>
      <div class="activity_list3 am-fr">
        <i class="iconfont icon-arrowright"></i>
      </div>
    </a>
  </div>

	<!--

		<div class="activity_list">
		<a href="{:U('Account/qukirecharge')}" class="am-cf am-block">
			<div class="am-fl">
				<svg class="icon" aria-hidden="true">
				    <use xlink:href="#icon-kuaijiezhifu"></use>
				</svg>
			</div>
			<div class="activity_list2 am-fl">
				<p  style="font-size:0.22rem;margin-top:0.08rem">快捷支付</p>
				<em>单笔最低100元，最高100000元。</em>
  </div>
  <div class="activity_list3 am-fr">
    <i class="iconfont icon-arrowright"></i>
  </div>
  </a>
  </div>-->

	<!--div class="activity_list">
		<a href="{:U('Account/hxpay')}" class="am-cf am-block">
			<div class="am-fl">
				<svg class="icon" aria-hidden="true">
					<use xlink:href="#icon-tian"></use>
				</svg>
			</div>
			<div class="activity_list2 am-fl">
				<p style="font-size:0.22rem;margin-top:0.08rem">在线充值</p>
			</div>
			<div class="activity_list3 am-fr">
				<i class="iconfont icon-arrowright"></i>
			</div-->
		</a>
	</div>

</body>
</html>