<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<script type="text/javascript" src="__JS__/require.js" data-main="__JS__/main"></script>

<style>
	.am-tabs-default .am-tabs-nav .am-active a{
		background-color: transparent;
	}
	.am-tabs-nav i{
		display: block;
    font-size: 28px;
    line-height: 14px;
    margin-top: 17px;
	}
	.am-tabs .am-tabs-nav a{
		color: #5c5f60;
		display: block;
		width: 108px;
	}
	.am-tabs-bd{
		border:none;
		height:100%;
		margin-bottom:51px;

	}
	.am-tabs-bd .am-tab-panel{
		padding: 0;
	}
	.am-tabs-bd .home_main{
		text-align:center;
		border:none;
		
	}
	.am-tabs-bd .home_main .home_main_list{
		
		height:110px;
	    margin:0 auto;
        border-bottom:1px solid #ddd;
        border-right:1px solid #ddd;		
	}

</style>
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			全部彩种
		</font></h1>
    </div>
	
	 <div data-am-widget="tabs" class="am-tabs am-tabs-default" style="margin: 0;width:100%;position:absolute;top:48px;">
      <ul class="am-tabs-nav am-cf" style="background: #000;overflow: auto;overflow-y: hidden;">
          <li class="am-active"><a href="[data-tab-panel-0]">
						<i class="iconfont icon-quanbu"></i>
						全部彩种</a></li>
          <li class=""><a href="[data-tab-panel-1]">
						<i class="iconfont icon-fucaikuai3"></i>
						快3</a></li>
          <li class=""><a href="[data-tab-panel-2]">
						<i class="iconfont icon--shishicai"></i>
						时时彩</a></li>
		  <li class=""><a href="[data-tab-panel-3]">
						<i class="iconfont icon-kuaile8"></i>
						快乐彩</a></li>
		  <li class=""><a href="[data-tab-panel-4]">
				  <i class="iconfont icon-pkshi"></i>
				  PK10</a></li>
          <li class=""><a href="[data-tab-panel-5]">
						<i class="iconfont icon-11xuan5"></i>
						11选5</a></li>
					<!--<li class=""><a href="[data-tab-panel-6]">
						<i class="iconfont icon-pailie3"></i>
						低频彩</a></li>-->
		  <li class=""><a href="[data-tab-panel-6]">
				  <i class="iconfont" style="color:#07b39e">&#xe65a;</i>
				  六合彩</a></li>
      </ul>
      <div class="am-tabs-bd">
          <div data-tab-panel-0 class="am-tab-panel am-active">
            <ul class="home_main am-avg-sm-3">
				<volist name="cplist" id="cp">
					 <li class="home_main_list">
						<switch name="cp.typeid">
							<case value="k3">
						      <a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
							  <i class="iconfont" style="color:#07b39e"><img src="/app/k3.png" style="width:45px; padding-top:10px;"/></i>
							  </a>
							</case>
							<case value="ssc">
								<a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do" >
									<!--<i class="iconfont icon--shishicai" style="color:#fa7e00;"></i>-->
									<i class="iconfont" style="color:#07b39e"><img src="/app/ssc.png" style="width:45px; padding-top:10px;"/></i>
								</a>
							</case>
							<case value="x5">
								<a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
									<!--<i class="iconfont icon-11xuan5" style="color:#218ddd;"></i>-->
									<i class="iconfont" style="color:#07b39e"><img src="/app/11x5.png" style="width:45px; padding-top:10px;"/></i>
								</a>
							</case>
							<case value="keno">
								<a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
									<!--<i class="iconfont icon-kuaile8" style="color:#fc5826;"></i>-->
									<i class="iconfont" style="color:#07b39e"><img src="/app/kl8.png" style="width:45px; padding-top:10px;"/></i>
								</a>
							</case>
							<case value="pk10">
								<a href="__ROOT__/Game.pk10?code={$cp[name]}"">
									<!--<i class="iconfont icon--pk" style="color:#f22751;"></i>-->
									<i class="iconfont" style="color:#07b39e"><img src="/app/pk10.png" style="width:45px; padding-top:10px;"/></i>
								</a>
							</case>
							<!--<case value="dpc">
								<a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
										<i class="iconfont <?php if(strstr($cp['name'],'3d')){}else{}?>"><?php if(strstr($cp['name'],'3d')){ ?><img src="/app/3d.png" style="width:45px; padding-top:10px;"><?php } ?><?php if(strstr($cp['name'],'pl3')){ ?><img src="/app/p3.png" style="width:45px; padding-top:10px;"><?php } ?></i>
								</a>
							</case>-->
							<case value="lhc"> 
								<a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
									<i class="iconfont" style="color:#07b39e"><img src="/app/lhc.png" style="width:45px; padding-top:10px;" /></i>
								</a>
							</case>
						</switch>
							<h3 style="font-family: Georgia;font-size:16px;margin-top:5px;">{$cp.title}</h3>
							<h5 style="font-size:12px; color:#9898b3;padding-bottom:-13px;">{$cp.ftitle}</h5>
					</li>
				</volist>

				</ul>
					</div>
          <div data-tab-panel-1 class="am-tab-panel ">
								<ul class="home_main am-avg-sm-3">
									<volist name="cplist2" id="cp">
										<eq name="cp.typeid" value="k3">
											<li class="home_main_list">
												<a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
												<i class="iconfont" style="color:#07b39e"><img src="/app/k3.png" style="width:45px; padding-top:10px;"/></i>
												</a>
													<h3 style="font-size:16px;margin-top:5px;">{$cp.title}</h3>
							                        <em style="font-size:13px; color:#9898b3">{$cp.ftitle}</em>
											</li>
										</eq>
									</volist>
								</ul>
          </div>
          <div data-tab-panel-2 class="am-tab-panel ">
            <ul class="home_main am-avg-sm-3">
				<volist name="cplist2" id="cp">
					<eq name="cp.typeid" value="ssc">
						<li class="home_main_list">
							<a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
								<i class="iconfont" style="color:#07b39e"><img src="/app/ssc.png" style="width:45px; padding-top:10px;"/></i>
							</a>
									                <h3 style="font-size:16px;margin-top:5px;">{$cp.title}</h3>
							                        <em style="font-size:13px; color:#9898b3">{$cp.ftitle}</em>
						</li>
					</eq>
				</volist>
			 </ul>
          </div>
		 <div data-tab-panel-3 class="am-tab-panel">
            <ul class="home_main am-avg-sm-3">
				<volist name="cplist2" id="cp">
					<eq name="cp.typeid" value="keno">
						<li class="home_main_list">
							<a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
								<i class="iconfont" style="color:#07b39e"><img src="/app/kl8.png" style="width:45px; padding-top:10px;"/></i>
							</a>
									                <h3 style="font-size:16px;margin-top:5px;">{$cp.title}</h3>
							                        <em style="font-size:13px; color:#9898b3">{$cp.ftitle}</em>
						</li>
					</eq>
				</volist>
				 </ul>
			 </div>
		  <div data-tab-panel-4 class="am-tab-panel">
			  <ul class="home_main am-avg-sm-3">
				  <volist name="cplist2" id="cp">
					  <eq name="cp.typeid" value="pk10">
						  <li class="home_main_list">
							  <a href="__ROOT__/Game.pk10?code={$cp[name]}"">
								<i class="iconfont" style="color:#07b39e"><img src="/app/pk10.png" style="width:45px; padding-top:10px;"/></i>
							  </a>
									                <h3 style="font-size:16px;margin-top:5px;">{$cp.title}</h3>
							                        <em style="font-size:13px; color:#9898b3">{$cp.ftitle}</em>
						  </li>
					  </eq>
				  </volist>
			  </ul>
		  </div>
		  <div data-tab-panel-5 class="am-tab-panel">
			  <ul class="home_main am-avg-sm-3">
				  <volist name="cplist2" id="cp">
					  <eq name="cp.typeid" value="x5">
						  <li class="home_main_list">
							  <a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
                              <i class="iconfont" style="color:#07b39e"><img src="/app/11x5.png" style="width:45px; padding-top:10px;"/></i>
							  </a>
									                <h3 style="font-size:16px;margin-top:5px;">{$cp.title}</h3>
							                        <em style="font-size:13px; color:#9898b3">{$cp.ftitle}</em>
						  </li>
					  </eq>
				  </volist>
			  </ul>
		  </div>
<!--		  <div data-tab-panel-6 class="am-tab-panel">
			  <ul class="home_main am-avg-sm-3">
				  <volist name="cplist2" id="cp">
					  <eq name="cp.typeid" value="lhc">
						  <li class="home_main_list">
							  <a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
								  <i class="iconfont <?php if(strstr($cp['name'],'3d')){}else{}?>"><?php if(strstr($cp['name'],'3d')){ ?><img src="/app/3d.png" style="width:45px; padding-top:10px;"><?php } ?><?php if(strstr($cp['name'],'pl3')){ ?><img src="/app/p3.png" style="width:45px; padding-top:10px;"><?php } ?></i>
							  </a>
									                <h3 style="font-size:16px;margin-top:5px;">{$cp.title}</h3>
							                        <em style="font-size:13px; color:#9898b3">{$cp.ftitle}</em>
						  </li>
					  </eq>
				  </volist>
			  </ul>
		  </div>-->
		  <div data-tab-panel-6 class="am-tab-panel">
			  <ul class="home_main am-avg-sm-3">
				  <volist name="cplist2" id="cp">
					  <eq name="cp.typeid" value="lhc">
						  <li class="home_main_list">
							  <a href="__ROOT__/Game.{$cp.typeid}.code.{$cp.name}.do">
								  <i class="iconfont" style="color:#07b39e"><img src="/app/lhc.png" style="width:45px; padding-top:10px;"/></i>
							  </a>
									                <h3 style="font-size:16px;margin-top:5px;">{$cp.title}</h3>
							                        <em style="font-size:13px; color:#9898b3">{$cp.ftitle}</em>
						  </li>
					  </eq>
				  </volist>
			  </ul>
		  </div>
      </div>
  </div>
<include file="Public/footer" />
</body>
</html>