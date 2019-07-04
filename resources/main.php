<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $_system_config->site_title  or 'motoo' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/web/css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('/web/fonts/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('/web/css/rendezvous.css') }}">
    <link rel="stylesheet" href="{{ asset('/web/css/index1.css') }}">
   <link rel="stylesheet" href="{{ asset('/web/css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('/web/fonts/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('/web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/web/css/common.css') }}">
    <script src="{{ asset('/web/js/jquery-2.1.3.min.js') }}"></script>
	<style>
	@font-face {
  font-family: 'FontAwesome';
  src: url("{{ asset('/web/fonts/fonts/fontawesome-webfont.eot?v=4.2.0') }}");
  src: url("{{ asset('/web/fonts/fonts/fontawesome-webfont.eot?#iefix&v=4.2.0') }}") format('embedded-opentype'),
  url("{{ asset('/web/fonts/fonts/fontawesome-webfont.woff?v=4.2.0') }}") format('woff'),
  url("{{ asset('/web/fonts/fonts/fontawesome-webfont.ttf?v=4.2.0') }}") format('truetype'),
  url("{{ asset('/web/fonts/fonts/fontawesome-webfont.svg?v=4.2.0#fontawesomeregular') }}") format('svg');
  font-weight: normal;
  font-style: normal;
}
.icon-external-link {
  font-family:FontAwesome;
  font-weight: normal;
  font-style: normal;
}
	#banner {
    width: 100%;
    position: relative;
   
    background-position: center;
    background-repeat: no-repeat;
    background-color: #000;
}


#layout-top-area {
    background-color: #228767;
    background-image: -webkit-linear-gradient(90deg, #228767 170px ,#d2e7e0 270px,#fff 910px,#4e9f85);
    background-image: linear-gradient(90deg, #228767 170px ,#d2e7e0 270px,#fff 910px,#4e9f85);
    position: relative;
    display: table;
    width: 100%;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    height: 70px;
}
#layout-top-area .sider-area {
    color: #90c3b3;
    border-right-color: #90c3b3;
    position: absolute;
    width: 200px;
    font-size: 20px;
    text-align: center;
    padding-top: 11px;
    font-family: 黑体;
    margin-top: 12px;
    padding-top: 0;
    width: 180px;
    z-index: 10;
}
#layout-top-area .nav-area {
    background-color: #fff;
    padding-left: 30px;
    height: 70px;
    border-top-right-radius: 5px;
    border-top-left-radius: 70px;
    border-bottom-right-radius: 70px;
    left: 180px;
    box-shadow: 0 0 10px #666 inset;
    position: absolute;
    right: 0;
    color: #fff;
    font-size: 20px;
    list-style: none;
}
#layout-top-area .nav-area li {
    display: inline-block;
    width: 12.5%;
    text-align: center;
    font-size: 16px;
    position: relative;
}
#layout-top-area .nav-area li {
    display: inline-block;
    width: 12.5%;
    text-align: center;
    font-size: 16px;
    position: relative;
}
#layout-top-area .nav-area li a {
    display: inline-block;
}
.nav-area li a {
    color: #555;
    font-size: 12px;
    font-weight: bold;
}
.nav-area li:before {
    content: "";
    display: block;
    height: 20px;
    width: 1px;
    background-color: #ccc;
    position: absolute;
    top: 16px;
}
.nav-area [data-menu="recharge"] span:before {
    content: "\f07a";
    background-color: #F16346;
}
.nav-area [data-menu="member"] span:before {
    content: "\f022";
    background-color: #F59A2F;
}
.nav-area [data-menu="draw"] span:before {
    content: "\f157";
    background-color: #F59A2F;
}
.nav-area [data-menu="exchange"] span:before {
    content: "\f0ec";
    background-color: #A95BEF;
}
.nav-area [data-menu="bet"] span:before {
    content: "\f073";
    background-color: #2C7FE3;
}
.nav-area [data-menu="money"] span:before {
    content: "\f1da";
    background-color: #F16346;
}
.nav-area [data-menu="message"] span:before {
    content: "\f0e0";
    background-color: #24C987;
}
.nav-area [data-menu] span:before {
    font-size: 15px;
    font-family: "FontAwesome";
    display: block;
    width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    color: #fff;
    border-radius: 50%;
    margin: 4px auto;
    font-weight: normal;
}
.nav-area li.active a {
    color: #F37F6B;
}
.nav-area li.active a:after {
    content: "";
    display: block;
    width: 24px;
    height: 2px;
    background-color: #F25949;
    margin: 4px auto;
}
#layout-main-area {
    display: table;
    height: 650px;
    width: 100%;
    position: relative;
	    line-height: 1.42857143;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
#layout-main-area {
    padding: 10px;
}
#main-menu {
    width: 180px;
    background-color: #ECE8E9;
    padding-right: 10px;
    border-bottom-left-radius: 5px;
    display: table-cell;
    vertical-align: top;
}
#layout-main-area #main-menu {
    border-bottom-left-radius: 5px;
}
.list-group {
    padding-left: 0;
    margin-bottom: 20px;
}
#main-menu .list-group {
    margin: 0;
}
.list-group-item:first-child {
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}
#main-menu .list-group-item {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    padding-bottom: 6px !important;
    font-size: 16px;
    border: none;
    background-color: rgba(0, 0, 0, 0);
    text-align: center;
    margin: 0;
    padding: 0;
    cursor: pointer;
}
#main-menu .list-group .list-group-item {
    margin: 10px 0 5px 0;
    color: #fff;
	height:55px;
	width:170px;
	line-height:1.42857143
}
#main-menu .list-group-item:first-child {
    border-radius: 0;
}
#main-menu .list-group .list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
    z-index: 2;
    color: #fff;
    background-color: none;
    border-color: #337ab7;
	
	
	
}

#main-menu .list-group-item a {
    padding-left: 50px;
    text-align: left;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    padding-top: 7px;
    background-color: #fff;
    padding-bottom: 7px;
    border-radius: 5px;
}
#main-menu .list-group .list-group-item a {
    background-color: #fff;
    padding-bottom: 7px;
    border-radius: 5px;
}
#main-menu .list-group .list-group-item.active a {
  box-shadow: 4px 6px 8px #888;
    margin-right: -18px;
    color: #fff;
    background-color: #4e9f85;
    position: absolute;
    width: 170px;
    left: 18px;
    z-index: 100
}
#main-menu .list-group-item a:before {
    font-size: 25px;
    font-family: "FontAwesome";
    margin-left: -30px;
    margin-right: 10px;
    width: 30px;
    display: inline-block;
    text-align: center;
}
.list-group .system-message a:before {
    content: "\f0b1";
}
#main-menu .list-group .list-group-item.active a:after {
    font-size: 25px;
    font-family: "FontAwesome";
    content: "\f054";
    float: right;
    margin-right: -13px;
    color: #4e9f85;
}#layout-main-area #main-container {
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}
#main-container {
    padding: 10px;
    background-color: #fff;
    border-radius: 10px;
    margin: 10px;
    display: table-cell;
    vertical-align: top;
    position: relative;
}
element.style {
    height: 630px;
    overflow: auto;
    margin-top: 10px;
}
.module-main {
    height: auto !important;
    min-height: 500px;
    position: relative;
    overflow: visible !important;
    padding: 0 20px;
}
#layout-top-area .sider-area span:before {
    content: "\f007";
    font-size: 30px;
    margin-right: 5px;
    font-family: "FontAwesome";
}
#main-menu .list-group .list-group-item a{
	
	color:#333
}
.userbasic_head a{
	color:#333
}
	</style>
</head>
<body>

@include('web.layouts.header')
<div id="banner" style="margin-top:35px"></div>
<div class="container user_con" style="margin-top: 0px;max-width:1000px；    visibility: visible;
    border-radius: 5px;
    background-color: #ECE8E9;
    max-width: 1100px;
    margin: 0 auto;border:0;margin-top:0px">
    <div id="layout-top-area">
			<div class="sider-area"><span>会员中心</span></div>
			<ul class="nav-area">
				<li @if(in_array($web_route, ['member.userCenter','member.bank_load','member.login_psw','member.safe_psw','member.message_list'])) class="active" @endif><a href="{{ route('member.userCenter') }}" data-menu="member"><span>会员资料</span></a></li>
				<li @if(in_array($web_route, ['member.finance_center']))class="active"@endif><a href="{{ route('member.finance_center') }}" data-menu="recharge"><span>在线存款</span></a></li>
				<li @if(in_array($web_route, ['member.member_drawing']))class="active"@endif><a href="{{ route('member.member_drawing') }}" data-menu="draw"><span>在线取款</span></a></li>
				<li @if(in_array($web_route, ['member.indoor_transfer']))class="active"@endif><a href="{{ route('member.indoor_transfer') }}" data-menu="exchange"><span>额度转换</span></a></li>
				<li @if(in_array($web_route, ['member.sendfs']))class="active"@endif><a href="{{ route('member.sendfs') }}" data-menu="bet"><span>返水中心</span></a></li>
				<li @if(in_array($web_route, ['member.customer_report']))class="active"@endif><a href="{{ route('member.customer_report') }}" data-menu="money"><span>资金流水</span></a></li>
				<li @if(in_array($web_route, ['member.service_center','member.complaint_proposal']))class="active"@endif><a href="{{ route('member.service_center') }}" data-menu="message"><span>服务中心</span></a></li>
			</ul>
	</div>
<div id="layout-main-area">

  
	    @if(in_array($web_route, ['member.userCenter','member.bank_load','member.login_psw','member.safe_psw','member.message_list']))
		 <div id="main-menu">
	<div class="menu-area">
		  <ul class="list-group">
			<li class="list-group-item system-message  @if(in_array($web_route, ['member.userCenter'])) active @endif"><a href="{{ route('member.userCenter') }}">基本信息</a></li>
			<li class="list-group-item system-message complaint @if(in_array($web_route, ['member.bank_load'])) active @endif"><a href="{{ route('member.bank_load') }}">银行资料</a></li>
			<li class="list-group-item system-message activity @if(in_array($web_route, ['member.login_psw'])) active @endif"><a href="{{ route('member.login_psw') }}">登录密码</a></li>
			<li class="list-group-item system-message activity @if(in_array($web_route, ['member.safe_psw'])) active @endif"><a href="{{ route('member.safe_psw') }}">取款密码</a></li>
			
			<li class="list-group-item system-message activity @if(in_array($web_route, ['member.message_list'])) active @endif"><a href="{{ route('member.message_list') }}">站内消息</a></li>
			
         </ul>
	</div>
</div>
		 @elseif(in_array($web_route, ['member.finance_center','member.update_bank_info']))
		  <div id="main-menu">
	<div class="menu-area">
		 <ul class="list-group">
			<li class="list-group-item system-message  @if(in_array($web_route, ['member.finance_center'])) active @endif"><a href="{{ route('member.finance_center') }}">在线存款</a></li>
			<li class="list-group-item system-message complaint @if(in_array($web_route, ['member.update_bank_info'])) active @endif"><a href="{{ route('member.update_bank_info') }}">在线取款</a></li>
			<li class="list-group-item system-message activity @if(in_array($web_route, ['member.indoor_transfer'])) active @endif"><a href="{{ route('member.indoor_transfer') }}">额度转换</a></li>
			
			
         </ul>
	</div>
</div>
	 @elseif(in_array($web_route, ['member.service_center','member.complaint_proposal']))
		  <div id="main-menu">
	<div class="menu-area">
		 <ul class="list-group">
			<li class="list-group-item system-message  @if(in_array($web_route, ['member.service_center'])) active @endif"><a href="{{ route('member.service_center') }}">公告信息</a></li>
			<li class="list-group-item system-message complaint @if(in_array($web_route, ['member.complaint_proposal'])) active @endif"><a href="{{ route('member.complaint_proposal') }}">投诉建议</a></li>
			
			
			
         </ul>
	</div>
</div>
		@endif
	

<div id="main-container">
	<div class="module-main" style="height: 630px; overflow: auto;margin-top:10px;">
		  @yield('content')
	</div>
</div>
		</div>
		
        <!--  <div class="user_left fl">
  <ul>
            <li @if(in_array($web_route, ['member.userCenter', 'member.account_load', 'member.bank_load', 'member.update_bank_info','member.message_list'])) class="active" @endif>
                <a href="{{ route('member.userCenter') }}">个人资料</a>
            </li>
            <li @if(in_array($web_route, ['member.safe_psw', 'member.login_psw'])) class="active" @endif>
                <a href="{{ route('member.safe_psw') }}">安全管理</a>
            </li>
            <li @if(in_array($web_route, ['member.finance_center', 'member.member_drawing', 'member.indoor_transfer', 'member.weixin_pay', 'member.ali_pay', 'member.bank_pay'])) class="active" @endif>
                <a href="{{ route('member.finance_center') }}">财务中心</a>
            </li>
            <li @if(in_array($web_route, ['member.customer_report'])) class="active" @endif>
                <a href="{{ route('member.customer_report') }}">客户报表</a>
            </li>
            <li @if(in_array($web_route, ['member.service_center', 'member.complaint_proposal'])) class="active" @endif>
                <a href="{{ route('member.service_center') }}">服务中心</a>
            </li>
			 <li @if(in_array($web_route, ['member.sendfs'])) class="active" @endif>
                <a href="{{ route('member.sendfs') }}">返水中心</a>
            </li>
             <li @if(in_array($web_route, ['member.selfhelp_discount'])) class="active" @endif>
                <a href="{{ route('member.selfhelp_discount') }}">自助优惠</a>
				    </li>
        </ul>
		
    </div>
    <div class="user_right " style="padding: 10px;
    background-color: #fff;
    border-radius: 10px;
    margin: 10px;
    display: table-cell;
    vertical-align: top;
    position: relative;display:none">
       
    </div>-->
</div>
</div>
@include('web.layouts.aside')
@include('web.layouts.footer')

<script src="{{ asset('/web/js/jquery.flexslider.js') }}"></script>
<script src="{{ asset('/web/js/index1.js') }}"></script>
<script src="{{ asset('/web/js/common.js') }}"></script>
<script src="{{ asset('/web/js/jquery.SuperSlide.2.1.1.js') }}"></script>
<script src="{{ asset('/web/layer/layer.js') }}"></script>
<script src="{{ asset('/web/js/ajax-submit-form.js') }}"></script>
<script src="{{ asset('/web/js/rendezvous.js') }}"></script><!--日历-->
<script src="{{ asset('/web/js/jquery.page.js') }}"></script><!--翻页-->
<script src="{{ asset('/web/My97DatePicker/WdatePicker.js') }}"></script><!--起止时间日历 My97DatePicker-->
@yield('after.js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
</script>
</body>
</html>