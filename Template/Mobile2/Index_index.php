<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<style>
.home_main .new_home_main_list{
	text-align:center;
	padding:0.2rem 0 0.1rem;
}
.home_main .new_home_main_list a{
	display:block;
}
.home_main .new_home_main_list i{
	font-size:0.4rem;
	line-height:0.42rem;
}
.home_main .new_home_main_list.icon-fucaikuai3{
	color:#e01506;
}
.home_main .new_home_main_list .icon-zhongqingshishicailogo{
	color:#fa7e00;
}
.home_main .new_home_main_list h3{
	margin:0;
	color:#333;
	font-weight:normal;
	line-height:0.1rem;
	margin-top:0.1rem;
}
.home_main .new_home_main_list em{
	color:#989898;
	font-size:0.12rem;

}
</style>
<body>
<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
    <h1 class="am-header-title header_logo">
        <img src="__IMG__/mobile_logo.png" alt="">
    </h1>
    <div class="am-header-right am-header-nav header_down">
        <a href="/public.download.do" class="showCodeC">
            APP
            <i class="iconfont icon-wechaticon16"></i> 
        </a>
    </div>
</header>

<div data-am-widget="slider" class="am-slider am-slider-a5" data-am-slider='{&quot;directionNav&quot;:false}'>
    <ul class="am-slides">
        <li>
            <img src="__IMG__/bannerqi1.jpg" alt="">
        </li>
        <li>
            <img src="__IMG__/bannerqi2.jpg" alt="">
        </li>
        <li>
            <img src="__IMG__/bannerqi3.jpg" alt="">
        </li>
    </ul>
</div>

<div class="my_operation_money">
<ul class="home_main am-avg-sm-3">

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

		 	<!--<li class="new_home_main_list"><a href="{:U('Zhenren/login',array('type'=>'ag'))}">
                        <i style="width: 60px;height: 60px;border-radius: 50%;font-size: 25px;display: block;margin: 0 auto;">
                <img src="/Template/Mobile/images/AG.png" style="margin-top: -10px;" width="100%" height="100%">
            </i>
                        <h3>AG视讯</h3>
						</a>
		</li>		
       <li class="new_home_main_list"><a href="{:U('Zhenren/login',array('type'=>'bbin'))}">
                       <i style="width: 60px;height: 60px;border-radius: 50%;font-size: 25px;display: block;margin: 0 auto;">
                <img src="/Template/Mobile/images/BB.png" style="margin-top: -10px;" width="100%" height="100%">
            </i>
                        <h3>BB视讯</h3>
						</a>
		</li>
    <li class="new_home_main_list"><a href="{:U('Zhenren/login',array('type'=>'ky'))}">
            <i style="width: 60px;height: 60px;border-radius: 50%;font-size: 25px;display: block;margin: 0 auto;">
                <img src="/Template/Mobile/images/ky.png" style="margin-top: -10px;" width="100%" height="100%">
            </i>
            <h3>开元棋牌</h3>
        </a>
    </li>
    <li class="new_home_main_list"><a href="{:U('Zhenren/login',array('type'=>'ss'))}">
            <i style="width: 60px;height: 60px;border-radius: 50%;font-size: 25px;display: block;margin: 0 auto;">
                <img src="/Template/Mobile/images/zr.png" style="margin-top: -10px;" width="100%" height="100%">
            </i>
            <h3>皇冠体育</h3>
        </a>
    </li>	
</ul>
    </div>--> 

<div class="home_notice">
        <a href="{:U('Member/ggshow',array('aid'=>$gglist['id']))}" class="am-cf">
            <div class="am-fl">
                <i class="iconfont icon-icon100"></i>
                <em> {$gglist[title]}</em>
            </div>
            <div class="am-fr">
                <i class="iconfont icon-arrowright"></i>
            </div>
        </a>
</div>

<ul class="home_main am-avg-sm-3">
        <volist name="cplist" id="cp">
        <li class="home_main_list">
            <switch name="cp[typeid]">
                <case value="k3">
                    <a href="{:U('Mobile/Game/k3',array('code'=>$cp[name]))}">
                        <i class="iconfont icon-fucaikuai3"></i>
                        <h3>{$cp[title]}</h3>
                        <em>{$cp[ftitle]|msubstr='0','6','utf-8',''}</em>
                </case>
                <case value="lhc">
                    <a href="{:U('Mobile/Game/lhc',array('code'=>$cp[name]))}">
                        <i class="iconfont" style="color:#07b39e">&#xe65a;</i>
                        <h3>{$cp[title]}</h3>
                        <em>{$cp[ftitle]|msubstr='0','6','utf-8',''}</em>
                </case>
                <case value="ssc">
                    <a href="{:U('Mobile/Game/ssc',array('code'=>$cp[name]))}">
                        <!--<i class="iconfont icon--shishicai" style="color:#fa7e00;"></i>-->
                        <i class="iconfont icon--shishicai" style="color:#fa7e00;"></i>
                        <h3>{$cp[title]}</h3>
                        <em>{$cp[ftitle]|msubstr='0','6','utf-8',''}</em>
                </case>
                <case value="pk10">
                    <a href="/Game.pk10?code={$cp[name]}">
                        <!--<i class="iconfont icon--pk" style="color:#f22751;"></i>-->
                        <i class="iconfont icon--pk" style="color:#f22751;"></i>
                        <h3>{$cp[title]}</h3>
                        <em>{$cp[ftitle]|msubstr='0','6','utf-8',''}</em>
                </case>
                <case value="keno">
                    <a href="{:U('Mobile/Game/keno',array('code'=>$cp[name]))}">
                        <!--<i class="iconfont icon-kuaile8" style="color:#fc5826;"></i>-->
                        <i class="iconfont icon-kuaile8" style="color:#fc5826;"></i>
                        <h3>{$cp[title]}</h3>
                        <em>{$cp[ftitle]|msubstr='0','6','utf-8',''}</em>
                </case>
                <case value="x5">
                    <a href="{:U('Mobile/Game/x5',array('code'=>$cp[name]))}">
                        <!--<i class="iconfont icon-11xuan5" style="color:#218ddd;"></i>-->
                        <i class="iconfont icon-11xuan5" style="color:#218ddd;"></i>
                        <h3>{$cp[title]}</h3>
                        <em>{$cp[ftitle]|msubstr='0','6','utf-8',''}</em>
                </case>
                <case value="dpc">
                    <a href="{:U('Mobile/Game/dpc',array('code'=>$cp[name]))}">
                        <i class="iconfont <?php if(strstr($cp['name'],'3d')){echo 'icon-fucai3d fc3d_c';}else{echo ' icon-pailie3 pl3_c';}?>"></i>
                        <h3>{$cp[title]}</h3>
                        <em>{$cp[ftitle]|msubstr='0','6','utf-8',''}</em>
                </case>
            </switch>
            </a>
        </li>
        </volist>
    <li class="home_main_list">
            <a href="{:U('Index/lotteryHall')}" style="color: #333;">
                <i style="background: #fa7e00;width: 40px;height: 40px;border-radius: 50%;font-size: 25px;display: block;margin: 0 auto;color: #fff;line-height: 35px;">+</i>
                
                <h3>更多彩种</h3>
                <em>&nbsp&nbsp&nbsp</em>
            </a>
        </li>
</ul>
<include file="Public/footer" />

 </if> 
<script>
    $('.closeNotice').on('click',function(){
    $('.ggpop').hide();
    $('.showzhou').hide();
    $.ajax({
        url : "{:U('Common/closegg')}",
        type:"POST",
    })
})
    $(document).on('click','.hideCodec',function (){
        $('.showCodePage').hide();
    })
    $('li.home_main_list a').click(function(event){
		
        event.preventDefault()
        var url = $(this).attr('href');
		
        $.ajax({
            url:url,
            type: 'POST',
            success : function(json){
			 
             if(json.sign == 'fase'){
                 window.location.href="{:U('Public/login')}";
             }else{
				
                 window.location.href=url;
             }
            }
        })
    })
</script>
</body>
</html>