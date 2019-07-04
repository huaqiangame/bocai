<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>手机下注说明</title>
	//<link rel='icon' href='{{ $upload_path }}logo/{{ $company_info->company_ico }}'/>
<link rel="stylesheet" type="text/css" href="__CSS__/shoujizhuru.css"/>

</head>
<script type="text/javascript">
window.onload=function(){
	var oTop=document.getElementById('topbox');
	var oFter=document.getElementById('footer');
	var oMbx=document.getElementById('mianbox');
	var oMian=document.getElementById('miancenterbox');
	oMbx.style.height=document.body.offsetHeight-oFter.offsetHeight-oTop.offsetHeight+'px';
	oMian.style.height=oMbx.offsetHeight+"px";
}
window.onresize =function () {
    var oTop=document.getElementById('topbox');
    var oFter=document.getElementById('footer');
    var oMbx=document.getElementById('mianbox');
    if(document.body.offsetHeight-oFter.offsetHeight-oTop.offsetHeight<600){
        oMbx.style.height=600+'px';
    }
    else{
        var oTop=document.getElementById('topbox');
        var oFter=document.getElementById('footer');
        var oMbx=document.getElementById('mianbox');
        var oMian=document.getElementById('miancenterbox');
        oMbx.style.height=document.body.offsetHeight-oFter.offsetHeight-oTop.offsetHeight+'px';
        oMian.style.height=oMbx.offsetHeight+"px";
    }
}

</script>
<body>
	<div id="topbox">
		<div class="topcenterbox">
			<div class="topcenter">
				<div class="topleft">
					<div class="ele-lang-title">手机投注</div>
				</div>
			</div>
		</div>	
	</div>
	<div id="mianbox">
		<div class="miancenterbox" id="miancenterbox">
			<div class="mianleft">
				<img class="bbn" src="__IMG__/logo.png"></img>
				<span class="game">创世彩票</span>
				<div class="wh">
					<span>合而</span>
					<span>.</span>
					<span>唯一</span>
				</div>
				<div class="zh">
					<span>整合所有游戏</span>
					<span>随心所欲</span>
					<span>.</span>
					<span>随时随地</span>
					<span>。</span>
				</div>
				<p class="ia">iOS & Android 移动网页立即玩</p>
			</div>	
			<div class="mianright">
				<div class="sm">
					<p style="background: url(__IMG__/app.png) center center no-repeat"></p>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="bottomcenterbox">
			<div class="bottomcenter">
				<p>最佳显示建议iOS 8.0 以上系统使用内建浏览器，Android 4.0以上系统使用 Chrome 浏览器。</p>
				<p>若当您无法顺利利用手机上网投注，请您将您的 IP 以及资讯回报的代码提供给线上客服，我们会尽快帮您处理。</p>
				<p>因为微信二维码扫描会屏蔽该页面，所以请用您的手机浏览器的二维码扫描功能。</p>
			</div>
		</div>
	</div>
</body>
</html>