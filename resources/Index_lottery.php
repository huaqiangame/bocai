<!DOCTYPE html>
<html lang="zh">

	<meta charset="UTF-8">
	<title>购彩大厅</title>
	<meta name="keywords" content="关键字">
	<meta name="description" content="网站主要内容">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <link rel="stylesheet" type="text/css" href="__CSS__/base_new.css" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/lottery.css">


<include file="Public/headerlottery" />
<script type="text/javascript" src="/resources/js/way.min.js"></script>
<script type="text/javascript" src="/resources/main/common.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="lotter_main">
	<div class="container padding_0 padding_t_15">
		<div class="clearfix main_scroll">
			<div class="scroll_left pull-left">
				<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="10000">
					<ol class="carousel-indicators">
						<li class="" data-target="#myCarousel" data-slide-to="0"></li>
						<li data-target="#myCarousel" data-slide-to="1" class="active"></li>
						//<li class="" data-target="#myCarousel" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="item">
							<a href=""><img src="__IMG__/banner3.png" alt=""></a>
						</div>
						<div class="item active">
							<a href=""><img src="__IMG__/banner2 (1).png" alt=""></a>
						</div>
					</div>
				</div>
			</div>
			<div class="scroll_right pull-right">
				<h2 class="margin_0">风云榜</h2>
				<div class="ranking main_common_bor winning">
					<div class="ranking_scrooll_box">
						<ul class="ranking_list_lotter ranking_scroll" style="margin-top: 0px;">
							<volist name="list" id="value">
								<li>
									<div class="media">
										<div class="media-left">
											<img src="__ROOT__{$value['face']}" alt="" class="media-boject img-circle">
										</div>
										<div class="media-body">
											<p class="margin_0">{$value['username']}<span> 在 {$value['k3name']}</span></p>
											<p class="margin_0">喜中 <em>￥{$value['okamount']}</em></p>
										</div>
									</div>
								</li>
							</volist>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="gradient clearfix">
			<i class="pull-left"></i>
			<em class="pull-right"></em>
		</div>
		<div class="lottery_content">
			<ul class="content_nav clearfix">
				<li class="active">
					<a href="javascript:void(0)">热门</a>
				</li>
				<li>
					<a href="javascript:void(0)">全部</a>
				</li>
				<li>
					<a href="javascript:void(0)">快三</a>
				</li>
				<li>
					<a href="javascript:void(0)">时时彩</a>
				</li>
				<li>
					<a href="javascript:void(0)">快乐彩</a>
				</li>
				<li>
					<a href="javascript:void(0)">PK10</a>
				</li>
				<li>
					<a href="javascript:void(0)">11选5</a>
				</li>
				<li>
					<a href="javascript:void(0)">六合彩</a>
				</li>
				<li>
					<a href="javascript:void(0)">低频彩</a>
				</li>
			</ul>
			<div class="content_list_box">
				<!--热门-->
				<ul class="content_list clearfix" style="display:block;">
					<volist name="hotcaipiao" id="cp" offset="0" length="12">
						<li class="k3_project">
							<div class="media">
								<div class="media-left">
									<eq name="cp.typeid" value="k3">
										<i class="iconfont">&#xe607;</i>
									</eq>
									<eq name="cp.typeid" value="lhc">
										<i class="iconfont" style="color:#07b39e">&#xe65a;</i>
									</eq>
									<eq name="cp.typeid" value="ssc">
										<i class="iconfont special " >&#xe657;</i>
									</eq>
									<eq name="cp.typeid" value="pk10">
										<i class="icon--pk iconfont " style="color:#f22751" ></i>
									</eq>
									<eq name="cp.typeid" value="keno">
										<i class="icon-kuaile8 iconfont " style="color:#fc5826" ></i>
									</eq>
									<eq name="cp.typeid" value="x5">
										<i class="icon-11xuan5 iconfont " style="color:#218ddd" ></i>
									</eq>
									<eq name="cp.typeid" value="dpc">
										<i class="<?php if(strstr($cp['name'],'3d')){echo 'icon-fucai3d fc3d_c';}else{echo ' icon-pailie3 pl3_c';}?>  iconfont " style="color:<?php if(strstr($cp['name'],'3d')){echo '#00b7ee';}else{echo '#38b366';}?>" ></i>
									</eq>
								</div>
								<div class="media-body">
									<p>{$cp[title]}</p>
									<span>{$cp[ftitle]|msubstr='0','6','utf-8',''}</span>
								</div>
							</div>
							<div class="k3_beetting">
								<if condition="$cp['typeid'] eq 'k3'">
									<a href="__ROOT__/Game.k3?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','k3')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'lhc'">
									<a href="__ROOT__/Game.lhc?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','lhc')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'ssc'">
									<a href="__ROOT__/Game.ssc?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','ssc')">
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'pk10'">
									<a href="__ROOT__/Game.pk10?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','pk10')">
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'keno'">
									<a href="__ROOT__/Game.keno?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','keno')">
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'x5'">
									<a href="__ROOT__/Game.x5?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','x5')">
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'dpc'">
									<a href="__ROOT__/Game.dpc?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','dpc')">
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
							</div>
						</li>
					</volist>
				</ul>
				<!--全部-->
				<ul class="content_list clearfix" style="display:none;">
					<volist name="Allcp" id="cp">
						<li class="k3_project">
							<div class="media">
								<div class="media-left">
									<if condition="$cp['typeid'] eq 'k3'">
										<i class="iconfont">&#xe607;</i>
									</if>
									<if condition="$cp['typeid'] eq 'lhc'">
										<i class="iconfont" style="color:#07b39e">&#xe65a;</i>
									</if>
									<if condition="$cp['typeid'] eq 'ssc'">
										<i class="iconfont special " >&#xe657;</i>
									</if>
									<if condition="$cp['typeid'] eq 'pk10'">
										<i class="icon--pk iconfont " style="color:#f22751" ></i>
									</if>
									<if condition="$cp['typeid'] eq 'keno'">
										<i class="icon-kuaile8 iconfont " style="color:#fc5826" ></i>
									</if>
									<if condition="$cp['typeid'] eq 'x5'">
										<i class="icon-11xuan5 iconfont " style="color:#218ddd" ></i>
									</if>
									<if condition="$cp['typeid'] eq 'dpc'">
										<i class="<?php if(strstr($cp['name'],'3d')){echo 'icon-fucai3d fc3d_c';}else{echo ' icon-pailie3 pl3_c';}?>  iconfont " style="color:<?php if(strstr($cp['name'],'3d')){echo '#00b7ee';}else{echo '#38b366';}?>" ></i>
									</if>
								</div>
								<div class="media-body">
									<p>{$cp[title]}</p>
									<span>{$cp[ftitle]|msubstr='0','6','utf-8',''}</span>
								</div>
							</div>
							<div class="k3_beetting">
								<if condition="$cp['typeid'] eq 'k3'">
									<a href="__ROOT__/Game.k3?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','k3')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'lhc'">
									<a href="__ROOT__/Game.lhc?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','lhc')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'ssc'">
									<a href="__ROOT__/Game.ssc?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','ssc')">
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'pk10'">
									<a href="__ROOT__/Game.pk10?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','pk10')">
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'keno'">
									<a href="__ROOT__/Game.keno?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','keno')">
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'x5'">
									<a href="__ROOT__/Game.x5?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','x5')">
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
								<if condition="$cp['typeid'] eq 'dpc'">
									<a href="__ROOT__/Game.dpc?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','dpc')">
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</if>
							</div>
						</li>
					</volist>
				</ul>
				<!--快3-->
				<ul class="content_list  clearfix" style="display:none">
					<volist name="other" id="cp">
						<if condition="$cp['typeid'] eq 'k3'">
							<li class="k3_project">
								<div class="media">
									<div class="media-left">
										<i class="iconfont">&#xe607;</i>
									</div>
									<div class="media-body">
										<p>{$cp[title]}</p>
										<span>{$cp[ftitle]|msubstr='0','6','utf-8',''}</span>
									</div>
								</div>
								<div class="k3_beetting">
									<a href="__ROOT__/Game.k3?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','k3')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</div>
							</li>
						</if>
					</volist>
				</ul>
				<!--时时彩-->
				<ul class="content_list clearfix" style="display:none">
					<volist name="other" id="cp">
						<if condition="$cp['typeid'] eq 'ssc'">
							<li class="k3_project">
								<div class="media">
									<div class="media-left">
										<i class="iconfont special " >&#xe657;</i>
									</div>
									<div class="media-body">
										<p>{$cp[title]}</p>
										<span>{$cp[ftitle]|msubstr='0','6','utf-8',''}</span>
									</div>
								</div>
								<div class="k3_beetting">
									<a href="__ROOT__/Game.ssc?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','ssc')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</div>
							</li>
						</if>
					</volist>
				</ul>
				<!--快乐彩-->
				<ul class="content_list clearfix" style="display:none">
					<volist name="other" id="cp">
						<if condition="$cp['typeid'] eq 'keno'">
							<li class="k3_project">
								<div class="media">
									<div class="media-left">
										<i class="icon-kuaile8 iconfont " style="color:#fc5826" ></i>
									</div>
									<div class="media-body">
										<p>{$cp[title]}</p>
										<span>{$cp[ftitle]|msubstr='0','6','utf-8',''}</span>
									</div>
								</div>
								<div class="k3_beetting">
									<a href="__ROOT__/Game.keno?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','keno')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</div>
							</li>
						</if>
					</volist>
				</ul>
				<!--PK10-->
				<ul class="content_list clearfix" style="display:none">
					<volist name="other" id="cp">
						<if condition=" $cp['typeid'] eq 'pk10'">
							<li class="k3_project">
								<div class="media">
									<div class="media-left">
										<i class="icon--pk iconfont " style="color:#f22751" ></i>
									</div>
									<div class="media-body">
										<p>{$cp[title]}</p>
										<span>{$cp[ftitle]|msubstr='0','6','utf-8',''}</span>
									</div>
								</div>
								<div class="k3_beetting">
									<a href="__ROOT__/Game.pk10?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','keno')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</div>
							</li>
						</if>
					</volist>
				</ul>
				<!--11选5-->
				<ul class="content_list clearfix" style="display:none">
					<volist name="other" id="cp">
						<if condition="$cp['typeid'] eq 'x5'">
							<li class="k3_project">
								<div class="media">
									<div class="media-left">
										<i class="icon-11xuan5 iconfont " style="color:#218ddd" ></i>
									</div>
									<div class="media-body">
										<p>{$cp[title]}</p>
										<span>{$cp[ftitle]|msubstr='0','6','utf-8',''}</span>
									</div>
								</div>
								<div class="k3_beetting">
									<a href="__ROOT__/Game.x5?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','x5')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</div>
							</li>
						</if>
					</volist>
				</ul>
				<!--六合彩-->
				<ul class="content_list clearfix" style="display:none">
					<volist name="other" id="cp">
						<if condition="$cp['typeid'] eq 'lhc'">
							<li class="k3_project">
								<div class="media">
									<div class="media-left">
										<i class="iconfont" style="color:#07b39e">&#xe65a;</i>
									</div>
									<div class="media-body">
										<p>{$cp[title]}</p>
										<span>{$cp[ftitle]|msubstr='0','6','utf-8',''}</span>
									</div>
								</div>
								<div class="k3_beetting">
									<a href="__ROOT__/Game.lhc?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','lhc')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</div>
							</li>
						</if>
					</volist>
				</ul>
				<!--低频彩-->
				<ul class="content_list clearfix" style="display:none">
					<volist name="other" id="cp">
						<if condition="$cp['typeid'] eq 'dpc'">
							<li class="k3_project">
								<div class="media">
									<div class="media-left">
										<i class="<?php if(strstr($cp['name'],'3d')){echo 'icon-fucai3d fc3d_c';}else{echo ' icon-pailie3 pl3_c';}?>  iconfont " style="color:<?php if(strstr($cp['name'],'3d')){echo '#00b7ee';}else{echo '#38b366';}?>" ></i>
									</div>
									<div class="media-body">
										<p>{$cp[title]}</p>
										<span>{$cp[ftitle]|msubstr='0','6','utf-8',''}</span>
									</div>
								</div>
								<div class="k3_beetting">
									<a href="__ROOT__/Game.dpc?code={$cp.name}" class="btn_beetting">立即投注</a>
									<a href="javascript:void(0);" class="help " onclick="helps('{$cp.name}','dpc')" >
										<i class="iconfont">&#xe6a8;</i>
									</a>
								</div>
							</li>
						</if>
					</volist>
				</ul>
			</div>
		</div>
	</div>
</div>
<include file="Public/footer" />
<script>
	function openwindow(url,name,iWidth,iHeight) {
		var url; //转向网页的地址;
		var name; //网页名称，可为空;
		var iWidth; //弹出窗口的宽度;
		var iHeight; //弹出窗口的高度;
		//window.screen.height获得屏幕的高，window.screen.width获得屏幕的宽
		var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;
		var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;
		window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
	}
	//玩法说明
	function helps(name,cz) {
		var url = "__ROOT__/Game.howtoplay.name."+name+".cz."+cz;
		openwindow(url,'',1058,870);

	}
</script>
</body>
</html>