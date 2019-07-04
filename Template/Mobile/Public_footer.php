<style>
.bottom_navbar{position:fixed;bottom: 0;z-index: 1001;width: 100%;height:51px;}
.bottom_navbar ul{list-style: none;overflow: hidden;padding: 0;margin: 0;background: #22292c;padding-top: 3px;}
.bottom_navbar ul li{ float: left;width: 19%;text-align: center;}
.bottom_navbar .am-navbar-nav a { color: #999999;display: inline-block;width: 100%;height: 40px;line-height: 20px;}
.bottom_navbar .bottom_navbar_list i{font-size: 25px;line-height: 23px;}
.am-navbar-nav .bottom_navbar_list .am-navbar-label {line-height:1;font-size: 13px;display: block;word-wrap: normal;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;}
.bottom_navbar .active {border:none;color: #fff;}

</style>
<div  class="bottom_navbar">
  <ul class="am-navbar-nav">
    <li>
      <a href="{:U('Index/index')}" class="bottom_navbar_list">
        <i class="iconfont icon-shouyeshouye"></i>
        <span class="am-navbar-label">首页</span> 
      </a>
    </li>
	 <li>
      <a href="{:U('Index/lotteryHall')}" class="bottom_navbar_list">
        <i class="iconfont icon-goucaidating"></i>
        <span class="am-navbar-label">购彩大厅</span> 
      </a>
    </li>
    <li>
      <a href="{:U('Account/rechargeList')}" class="bottom_navbar_list">
        <i class="iconfont icon-chongzhi"></i>
        <span class="am-navbar-label">快速充值</span>
      </a>
    </li>
    <li>
      <a href="{:U('Account/withdrawals')}" class="bottom_navbar_list">
        <i class="iconfont icon-tixian"></i>
        <span class="am-navbar-label">提现</span>
      </a>
    </li>
    <li>
      <a href="{:GetVar('mobile_kefuthree')}" class="bottom_navbar_list">
        <i class="iconfont icon-kefu"></i>
        <span class="am-navbar-label">在线客服</span>
      </a>
    </li>
  </ul>
</div>