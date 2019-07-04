<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{:GetVar('webtitle')}</title>
	<meta name="keywords" content="{:GetVar('keywords')}" />
	<meta name="description" content="{:GetVar('description')}" />
	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/header.css">
	<link rel="stylesheet" href="__CSS2__/main.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/common.css" />
	<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/layout.css" />
	<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/style.css" />
	<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />
	<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
	<script>
		var ISLOGIN = "{$userinfo.id}";
		var WebConfigs = {
			'ROOT' : '__ROOT__'
		};

	</script>
</head>
<body style="background: linear-gradient( #f3fff4, #fff) no-repeat;">
<!--top-->
<!--top-->
<header class="header">
	<div class="container claerfix">
		<div class="pull-left">
			Hi，欢迎来到幸运彩！
		</div>
		<notempty name="userinfo.username">

			<div class="pull-right user_login_info">
				<ul>
					<li class="user_login_info1">
						<a  href="{:U('Member/index')}" class="user_header" data-html="true" class="user_header" data-container="body" data-toggle="popover" data-placement="bottom"data-content='<div class="ceng"><div class="media"><div class="media-left"><a href="{:U('user/index')}"><img src="{$userinfo.face}" alt="" class="media-boject img-circle"></a><p>{$userinfo.username}</p></div><div class="media-body" style="padding-bottom:10px;">
				<p class="margin_0">性别：<span><eq name="userinfo['sex']" value="1">男</eq><eq name="userinfo['sex']" value="2">女</eq><eq name="userinfo['sex']" value="0">保密</eq></span></p>
				<p class="margin_0">账号：<span>{$userinfo.username}</span></p>
				<p class="margin_0">等级：<span>{$userinfo.groupname}</span></p>
				<p class="margin_0">头衔：<span>{$userinfo.touhan}</span></p>
				<p class="margin_0">累积中奖：<span>{$Think.session.okamountcount}</span></p>
			</div>
			<div class="media-footer">
				<volist name="Think.session.k3names" id="value">
					<a href="{:U('Lottery/k3',array('name'=>$value['cptype']))}" title="{$value.cpname}" class="color_res" style="font-size:5px;"><span style="color:#333;display: block;margin-top:4px;">{$value.cpname|substr=0,6}</span><i class="iconfont">&#xe607;</i></a>
				</volist>
			</div></div></div>'>
	<img class="img-circle"  src="{$userinfo.face}" alt="">
	{$userinfo['username']}
	</a>
	<a class="user_info">
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
		<a href="{:U('Member/index')}" class="my_account">
			我的账户
			<i class="iconfont">&#xe6a1;</i>
		</a>
		<div class="user_login_info2_list" style="display:none;">
			<i class="user_login_info2_i"></i>
			<if condition="$userinfo.groupid eq '10' or $userinfo.groupid eq '11'">
				<a href="{:U('Agent/index')}">代理中心</a>
			</if>
			<a href="{:U('Member/betRecord')}">投注记录</a>
			<a href="{:U('Account/dealRecord')}">交易记录</a>
			<a href="{:U('Member/ziliao')}">个人信息</a>
			<a href="{:U('Member/index')}">安全中心</a>
		</div>
	</li>
	<li class="user_login_info3">
		余额：
						<span class="show_money">
							<em class="smallmoney" style="color:#F70B0F;">{$userinfo['money']}</em>
							<i class="iconfont refresh_money">&#xe602;</i>
							<em class="hide_money_btn">隐藏</em>
						</span>
						<span class="hide_money" style="display:none;">
							已隐藏
							<em class="show_money_btn">显示</em>
						</span>
	</li>
	<li class="user_login_info4">
		<a href="{:U('Account/recharge')}">充值</a>
	</li>
	<li class="user_login_info5">
		<a href="{:U('Account/withdrawals')}">提现</a>
	</li>
	<li class="user_login_info6">
		<a href="{:U('Public/LoginOut')}">退出</a>
	</li>
	</ul>
	</div>
	<else/>
	<div class="pull-right user_login_info">
		<a style="margin:0;" href="{:U('Apublic/login')}">亲，请登录</a>
		<em style="margin:0 3px;color:#ccc;">|</em> <a href="{:U('Apublic/reg')}">代理注册</a><em style="margin:0 3px;color:#ccc;">|</em>
		<a href="{:U('Agent/index')}">代理中心</a>
	</div>
	</notempty>
	</div>
</header>
<script>
</script>
<!--top-->
<!--banner-->
<nav class="home_nav">
	<div class="nav_logo">
		<div class="container claerfix">
			<a href="" class="pull-left" style="margin-top:17px;">
				<h1 class="nav_logo_h1">幸运彩</h1>
			</a>
			<div class="nav_img">
				<img src="__ROOT__/resources/images/xyc-img.png" alt="幸运彩快3彩票">
			</div>
			<div class="nav_kefu pull-right">
				<a  href="{:GetVar('kefuthree')}"    target="_blank" >
					<i class="iconfont"></i>
					在线客服
				</a>
			</div>
		</div>
	</div>
</nav>
<!--baner-->
<div class="banner">
	<div class="w1000">
		<!--hover效果加bann_hover-->
		<include file="Agent/menu" />
	</div>
</div>
<script type="text/javascript">
	$(function () {
		if ($("#kinMaxShow").size() > 0) {
			$("#kinMaxShow").kinMaxShow({
				height: 225,
				intervalTime: 2,
				button: {
					showIndex: false,
					normal: { marginRight: '8px', border: '0', right: '50%', bottom: '10px', borderRadius: '7px', background: '#fff' },
					focus: { background: '#bd0d0d', border: '0' }
				}
			});
		}
		$(".bann_list li").mouseover(function () {
			$(this).children("dl").show();
		})
		$(".bann_list li").mouseleave(function () {
			$(this).children("dl").hide();
		})
	});
</script>

<!--navlist-->
<!--wapper-->
<!--最高奖金-->
<!--是否具有投注权限,true是可以进行投注-->
<input id="EachMaxLotteryValue" type="hidden" value="500000.00" />
<input id="MemberBettingAuthority" type="hidden" value="False" />
<input id="_jsurl" type="hidden" value="/templates/SSC" />   <!-- js目录 -->

<script>
	$(function () {
		$('.refresh_money').click(function () {
			$.ajax({
				url:"{:U('Member/refresh_money')}",
				type:'POST',
				success :function (data) {
					$('.smallmoney').html(data);
				}
			})
		})

	})
</script>
 
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<style>
.passwordStrength,.passwordput{
display:block; width:100%;
float:left;
}
.passwordStrength b{
	font-weight:normal;
}
.passwordStrength b,.passwordStrength span{
	display:inline-block; 
	vertical-align:middle;
	line-height:16px;
	line-height:18px\9;
	height:16px;
}
.passwordStrength span{
	width:45px; 
	text-align:center; 
	background-color:#d0d0d0; 
	border-right:1px solid #fff;
}
.passwordStrength .last{
	border-right:none;
}
.passwordStrength .bgStrength{
	color:#fff;
	background-color:#71b83d;
}
</style>
<!--wapper-->
<div class="h35"></div>
<div class="wapper ">
	<div class="w1000">
    	<div id="cookie_registerForms" class="register login_m_form b1 bg_wite">
        	<h4>代理注册</h4>
            <form method="post" id="form1" class="ruivalidate_form_class" checkby_ruivalidate  action="__ROOT__/Apublic.regdo">
                <input type="hidden" name="action" value="register_agent" />
                <!--<if condition="GetVar('isregtjm') neq 0">
				<dl>
                	<dt>推荐码：</dt>
                    <dd>
                    	<input  type="text"  class="text_accont" name="codes" nullmsg="请输入推荐码" autocomplete="off" datatype="/^([0-9]){1,11}$/" errormsg="推荐码必须为数字！" value="{:cookie('tid')}"/><em class="Validform_checktip"></em>
                    </dd>
                </dl>
				</if>-->
                <dl>
                	<dt>用户名：</dt>
                    <dd>
                    	<input  type="text"  class="text_accont" name="userName"  verify="isLoginName" datatype="/^([a-zA-Z0-9]|[_]){3,16}$/" ajaxurl="__ROOT__/Apublic.checkusername" errormsg="用户名格式为3-16位英文字母、数字获下划线组成！" nullmsg="请填写用户名！"/><em class="Validform_checktip"></em>
                    </dd>
                </dl>
                <dl>
                	<dt>密  码：</dt>
                    <dd>
                    	<div class="passwordput"><input  type="password"  class="text_accont" name="passWord"  plugin="passwordStrength" errormsg="密码范围在6~16位之间！" nullmsg="请设置密码！" datatype="s6-16"/><em class="Validform_checktip"></em></div>
						<div class="passwordStrength">密码强度： <span>弱</span><span>中</span><span class="last">强</span></div>


                    </dd>
                </dl>
                <dl>
                	<dt>确认密码：</dt>
                    <dd>
                    	<input  type="password"  class="text_accont" name="qpassWord" datatype="*6-16" recheck="passWord" nullmsg="请再输入一次密码！" errormsg="您两次输入的账号密码不一致！"/><em class="Validform_checktip"></em>
                    </dd>
                </dl>
                <dl>
                	<dt>验证码：</dt>
                    <dd>
                    	<input  type="text"  class="text_accont" name="verCord"  msg="请输入验证码"  datatype="/^\d{4}$/" errormsg="请输入4位数字验证码！" nullmsg="请输入验证码！"/>
                        <img src="{:U('Public/verify',array('imageW'=>120,'imageH'=>35))}" onclick="this.src=this.src+'?temp='+ 1" style="float:left"><em class="Validform_checktip"></em>
                    </dd>
                </dl>
                <dl>
                	<dt>&nbsp;</dt>
                    <dd>
                    	<p><input  type="submit"  class="sub_btn submit"  value="点击注册"/>已有账号？<a href="{:U('Public/login')}" class="remmber_pwd">立即登录</a></p>
                    </dd>
                </dl>
            </form>
        </div>
    </div>
</div>
<!--wapper-->
<div class="h35"></div>
<include file="Public/footer" />
<script type="text/javascript" src="__ROOT__/resources/js/Validform_v5.3.2.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/passwordStrength-min.js"></script>
<script type="text/javascript">
$(function(){
		$("#form1").Validform({
		tiptype:function(msg,o,cssctl){
			var objtip=o.obj.siblings(".Validform_checktip");
			cssctl(objtip,o.type);
			objtip.text(msg);
	 	},
		usePlugin:{
			passwordstrength:{
				minLen:6,
				maxLen:18
			}
		},
		callback:check_form

	});
})
 function rdirect(url){
 	window.location.href = url;
 }
 function check_form(obj){
 	$.post($(obj).attr('action'),$(obj).serialize(), function(json){
 		if(json.status==1){
 			alt('恭喜您注册成功，感谢您的加入!');
 			var url = json.url?json.url:"/{:MODULE_NAME}";
 			setTimeout("rdirect('"+url+"')", 1500);
 		}else{
 			alt(json.info);
 		}
 	},'json');
 	return false;
 }
</script>
</body>

</html>
