<!DOCTYPE html>
<!-- saved from url=(0102)http://www.1234567pj.com/Account/LoginToGame?LoginToGame=LoginToAg%3FlunchGame%3D1%26gamecategory%3D16 -->
<html id="ng-app" ng-app="portalApp" meidon-time="2018/11/21 22:00:44" moment-lang="zh-CN" ng-init="&#39;澳门新葡京&#39;" class="ng-scope"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide{display:none !important;}ng\:form{display:block;}.ng-animate-block-transitions{transition:0s all!important;-webkit-transition:0s all!important;}</style>
    <title>澳门新葡京</title>
    <link rel="shortcut icon" href="https://cdn.igsttech.com/Web.Portal/PA001-01.Portal/Content/Views/Shared/images/favicon.ico">

    

    <link href="__IMG__/css3/normalize.min.css" rel="stylesheet">

    <link href="__IMG__/css3/custom-modal" rel="stylesheet">

    <link href="__IMG__/css3/site" rel="stylesheet">


    	<script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="__JS__/artDialog.js"></script>
	<script type="text/javascript" src="__JS__/index.js"></script> 
    <link href="__IMG__/css3/LoginToGame" rel="stylesheet">


    
    <script src="__IMG__/css3/jquery.min.js"></script>

    <script src="__IMG__/css3/jquery.marquee.min.js"></script>

    <script src="__IMG__/css3/jquery-ui.min.js"></script>

    <script src="__IMG__/css3/common"></script>

    <script src="__IMG__/css3/angular.min.js"></script>

    <script src="__IMG__/css3/moment-with-locales.min.js"></script>

    <script src="__IMG__/css3/moment-timezone-with-data.min.js"></script>

    <script src="__IMG__/css3/jquery.signalR-2.2.0.min.js"></script>


    
    <!--[if lte IE 9]>
        <script src="https://cdn.igsttech.com/Web.Portal/_Common/Scripts/placeholders.min.js"></script>
        <script src="https://cdn.igsttech.com/Web.Portal/_Common/Scripts/html5shiv.js"></script>
    <![endif]-->

</head>
<body ng-controller="LayoutCtrl" id="logingame-body" class="ng-scope">
    <div id="login-content" ng-controller="LoginToGameCtrl" class="ng-scope">
        <div id="logingame-left">
            <div id="login-info">
                <h3>快速登录</h3>
                
                <p>登录亚洲最佳线上真人娱乐城、体育博彩、彩票游戏、电子游艺</p>
            </div>
            <form  method="post" class="ruivalidate_form_class" onsubmit="return check_login(this)" id="ruivalidate_form_class" checkby_ruivalidate url="" action="{:U('Public/logindo')}">
                <input id="login_account" name="name" type="text" placeholder="帐号" ng-model="loginParams.account" required="" autofocus="" class="text_accont"/>
                <input id="login_password" type="password" name="pass" placeholder="密码" ng-model="loginParams.password" required="" class="text_accont"/>
                <div id="check-code-wrapper">
                    <input data-checkcode-retriever="checkCode" checkcode-type="Login" type="text" placeholder="验证码" ng-model="loginParams.checkCode" required="" class="ng-pristine ng-invalid ng-invalid-required">
                   // <img id="captcha" ng-show="checkCode.image" ng-src="" class="ng-hide">
				   <img  src="{:U('Public/verify',array('imageW'=>130,'imageH'=>40,'fontSize'=>18))}"  onclick="this.src=this.src+'?temp='+ 1" />
                </div>
                //<button  class="sub_btn" type="submit">登入</button>
					<input  type="submit" value="点击登录" class="btn-danger active sub_btn btn-sm" style="width:8em;height:2em;font-size: 1.3em;"/>
                <button type="button" id="forget" ng-click="lineChatClick()">忘记密码</button>
            </form>
        </div>
        <div id="logingame-right">
            <div id="logingame-logo">
                <img src="__IMG__/css3/logo.png" onerror="this.style.display = &#39;none&#39;">
            </div>
            <span>没有加入会员吗？今天就立即加入。</span>
            <button type="button" class="joinus" ng-click="GameRegisterClick()">免费开户</button>
        </div>
    </div>

    
    <script src="__IMG__/css3/angular-animate.min.js"></script>

    <script src="__IMG__/css3/ui-bootstrap-custom-tpls-0.10.0.min.js"></script>

    <script src="__IMG__/css3/_site.js"></script>
    <script src="__IMG__/css3/environment"></script>

    <script src="__IMG__/css3/_config.js"></script>
    <script src="__IMG__/css3/labels_zh-CN.js"></script>
    <script src="__IMG__/css3/angular-services"></script>

    <script src="__IMG__/css3/angular-controllers"></script>

    <script src="__IMG__/css3/angular-directives"></script>

    <script src="__IMG__/css3/angular-filters"></script>

    <script src="__IMG__/css3/portal-shared"></script>


    
    <input name="__RequestVerificationToken" type="hidden" value="BTe20HL0GnmCunI-ly0lN9mmG6sAb77CkTr3CTNjUwSDMRz4vNNiSbs0CXbyWX-Cg_aqdziS2dgNRcacgrRSQKn1nLs1">


<script type="text/javascript" src="__JS__/jquery.form.min.js"></script><!-- Jquery form表单提交 -->
<script type="text/javascript" src="__JS__/jquery.ruiValidate.js"></script><!-- 表单验证的js文件 -->
<script type="text/javascript" src="__JS__/jquery.kinMaxShow-1.1.min.js"></script>
<script type="text/javascript">
	$(function(){
		$("#kinMaxShow").kinMaxShow({
			height:225,
			intervalTime:2,
			button:{
				showIndex:false,
				normal:{marginRight:'8px',border:'0',right:'50%',bottom:'10px',borderRadius:'7px',background:'#fff'},
				focus:{background:'#bd0d0d',border:'0'}
			}
		});

	});
</script>
<!-- 调用插件 -->
<script type="text/javascript">
	$(function(){
		// var _FormValidate = new $.rui_validate();
		// _FormValidate.initload();

		// _FormValidate.initForm({
		// 	FocusTip:true,	//获取焦点则进行提示，显示输入规则（ boolen ）
		// 	BlurChange:true,	//失去焦点再进行提示，显示输入规则（ boolen ）
		// 	ShowTip: "Icon",	//显示提示信息的类型：Bubble（气泡）；IconText( 图标加文字 ) ; Text（仅是文字）; Icon（正确或错误的图标）； Highlights 聚焦高亮 ;
		// 	ShowTipDirection:"right", //提示信息的位置：right：右边，top：上面；bottom：下面；inside：输入框内；
		// 	FormObj:$("#ruivalidate_form_class"),	//验证的表单容器
		// 	FormIdName: 'ruivalidate_form_class',  //form的ID名称
		// 	ShowTipClass:"ts_msg",    //显示提示信息的区域class
		// 	ShowTipStyle:"",    //显示提示信息的class
		// 	SubBtn:'sub_btn',   //提交按钮的class
		// 	CallBack: ruivalidate_form_class //回调函数
		// })
		// function ruivalidate_form_class(obj) {
		// 	var _this = $(".ruivalidate_form_class .sub_btn");
		// 	_sub(_this);
		// }
	
		$('.text_accont[name="name"]').blur(function () {
			var text = $(this).val();
			if(!text || text.trim() == ''){
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('账号不能为空');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-chenggong');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-cross-ivt');
			}else{
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-cross-ivt');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-chenggong');
			}
		})

		$('.text_accont[name="pass"]').blur(function () {
			var text = $(this).val();
			if(!text || text.trim() == ''){
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('请填写6-16位，字母与数字组合的密码');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-chenggong');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-cross-ivt');
			}else if(text.length < 6 || text.length > 16){
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('密码范围在6-16位');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-chenggong');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-cross-ivt');
			}else{
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-cross-ivt');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-chenggong');
			}
		})

	});

	function check_login(obj){
		$.post($(obj).attr('action'),$(obj).serialize(), function(json){
			if(json.sign==1){
				loginCengBoxFn(json.message);
				window.location.href = "{:U('Index.index')}";
			}else{
				if(json.message=="你的帐号已在别处登陆，是否重新登陆"){
					if(confirm('你的帐号已在别处登陆，是否重新登陆')){
						$.ajax({
							url : $(obj).attr('action'),
							type : "POST",
							data : {
								name : $("input[name=name]").val(),
								pass :$("input[name=pass]").val(),
								nocode : true,
							},
							success : function (json) {
								loginCengBoxFn(json.message);
								window.location.href = "{:U('Index.index')}";
							}
						})
					}
				}else{
					// alt(json.message);
					loginCengBoxFn(json.message);
				}
			}
		},'json');
		return false;
	}
</script>
</body>
</html>