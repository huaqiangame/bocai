<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="__CSS2__/base_new_member.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/style_new.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/artDialog.css" />
    <script type="text/javascript" src="__JS__/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="__JS2__/layer/layer.js"></script>
    <script type="text/javascript" src="__JS__/swiper.jquery.min.js"></script>
    <script type="text/javascript" src="__JS__/jquery.ruiValidate.js"></script>
    <script type="text/javascript" src="__JS2__/way.min.js"></script>
    <script type="text/javascript" src="/resources/main/common.js"></script>
	<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
    <meta name="keywords" content="{:GetVar('keywords')}" />
    <meta name="description" content="{:GetVar('description')}" />
    <title>{:GetVar('webtitle')} </title>
    <script type="text/javascript">

        function check_login(obj){
            var account = $("#account").val();
            var pass = $("#pass").val();
            if($.trim(account) == ''){
                layer.alert('请输入用户名！');
                return false;
            }
            if(pass == ''){
                layer.alert('请输入密码！');
                return false;
            }

            $.post($(obj).attr('action'),$(obj).serialize(), function(json){
                if(json.sign==1){
                    //loginCengBoxFn(json.message);
                    layer.alert(json.message);
                    window.location.href = "{:U('Member.index')}";
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
                                    layer.alert(json.message);
                                    window.location.href = "{:U('Member.index')}";
                                }
                            })
                        }
                    }else{
                        // alt(json.message);
                        layer.alert(json.message);
                    }
                }
            },'json');
            return false;
        }
		//首页悬浮窗hover效果
		function jiaohuan(){
			document.getElementById('mm').src="__IMG__/btn_getPW2.png";
		}
		function huanyuan(){
			document.getElementById('mm').src="__IMG__/btn_getPW1.png";
		}
		function jiaohuandl(){
			document.getElementById('im').src="__IMG__/btn_login2.png";
		}
		function huanyuandl(){
			document.getElementById('im').src="__IMG__/btn_login1.png";
		}
		function jiaohuankc(){
			document.getElementById('kc').src="__IMG__/float/floatleft21.png";
		}
		function huanyuankc(){
			document.getElementById('kc').src="__IMG__/float/floatleft2.png";
		}
		function jiaohuanyh(){
			document.getElementById('yh').src="__IMG__/float/floatleft31.png";
		}
		function huanyuanyh(){
			document.getElementById('yh').src="__IMG__/float/floatleft3.gif";
		}
		function jiaohuancloseleft(){
			document.getElementById('closeleft').src="__IMG__/float/close1.png";
		}
		function huanyuancloseleft(){
			document.getElementById('closeleft').src="__IMG__/float/close.png";
		}
		function jiaohuancloseright(){
			document.getElementById('closeright').src="__IMG__/float/close1.png";
		}
		function huanyuancloseright(){
			document.getElementById('closeright').src="__IMG__/float/close.png";
		}
		function jiaohuanphone(){
			document.getElementById('phone').src="__IMG__/float/floatright12.png";
		}
		function huanyuanphone(){
			document.getElementById('phone').src="__IMG__/float/floatright1.png";
		}
		function jiaohuankf(){
			document.getElementById('kf').src="__IMG__/float/floatright21.png";
		}
		function huanyuankf(){
			document.getElementById('kf').src="__IMG__/float/floatright2.png";
		}
    </script>
	</head>
	<body class="bg_fff">
<div class="com_header">
    <div class="top">
        <div class="w12">
            <div class="right">
                <ul>
                    <li><a href="{:U('activity/hall')}">优惠办理大厅 </a></li>
                    <li>|</li>
                    <li><a href="{:U('public/hongbao')}" target="_blank">亿万红包</a></li>
                    <li>|</li>
                    <li>
					<a href="{:U('public/agentIndex')}" target="_blank">日结代理</a>
					</li>
                    <li>|</li>
                    <li><a href="{:U('Public/phonebet')}" onclick="window.open(this.href,'_blank','scrollbars=0,resizable=0,width=200');return false">手机app安装</a></li>
                    <li>|</li>
                    <li> <a href="{:U('Account/recharge')}"  target="_blank" style="width:130px">快速充值</a></li>
                    <li>|</li>
                   
                </ul>
            </div>
        </div>
    </div>
    <!--logo+Login-->
    <div class="cen">
        <div class="w12">
            <div class="left">
			<embed  src="__IMG__/logo.png" width="380" height="98 "alt="{:GetVar('webtitle')}"  type=application/x-shockwave-flash wmode="transparent" quality="high" ;>  </embed>
               <div class="left1"><img src="__IMG__/header_slogan.png"></div>
            </div>
            <if condition="is_array($userinfo)">
                <div class="right_b">
                    <div class="line1" style="margin-top: 55px;width: 310px;">
                        <p><img src="__IMG__/yh_icon.png" alt=""/><b>帐号:</b><span>{$userinfo.username}</span></p>
                        <p><img src="__IMG__/qian_icon.png" alt=""/><b>帐号余额:</b><span>{$userinfo.balance}</span></p>
                    </div>
                    <div class="line2">
                        <div class="left" style="margin-top: 0;margin-left: 0;">
                            <ul>
                                <li><a href="{:U('Member/index')}">会员中心</a></li>
                                <li><a href="{:U('Account/recharge')}">线上存款</a></li>
                                <li><a href="{:U('Account/withdrawals')}">线上取钱</a></li>
                                <li class="dd"><a href="{:U('Member/quota')}">额度转换</a></li>
                                <li><a href="{:U('Account/dealRecord')}">往来记录</a></li>
                                <li><a href="{:U('Member/gglist')}">最新消息</a></li>
                                <li><a href="{:U('member/agent')}">代理中心</a></li>
                                <li class="dd"><a href="{:U('Member/fanshui')}">自助返水</a></li>
                            </ul>
                        </div>
                        <div class="tuc"><a href="{:U('Public/LoginOut')}"><img src="__IMG__/tuc_icon.png" alt="退出"/></a></div>
                    </div>
                </div>
            <else/>
                <div class="right_a ">
                    <div class="zc_btn"><a href="{:U('Public/register')}"><img src="__IMG__/login5.png" alt="注册"/></a></div>
					<div class="box1"><img src="__IMG__/login_bg.png" alt="注册"/>	</div>
                    <div class="box">
                        <form method="post" class="ruivalidate_form_class" onsubmit="return check_login(this)" id="ruivalidate_form_class"
                              checkby_ruivalidate  action="{:U('Public/logindo')}" >
											
                            <div class="line1">
                                <div class="code">
                                    	<p>			
                                       <input type="text" placeholder="账号" class="text_accont" name="name" id="account"  verify="isLoginName" isNot="true" msg="账号不能为空" size="8px">                           
									   	</p>
                                </div>
                                <div class="pass">
                                    <p><input  placeholder="密码"  type="password" class="text_accont" name="pass" id="pass" verify="isALL" isNot="true" msg="请填写6-16位，字母与数字组合的密码">
                                        <!--<img class="icn" src="__IMG__/yh_icon.png" alt=""/>-->
									</p>
                                </div>
                            </div>
                            <div class="line1 line2">
                                <div class="code">                                 
									   <p>
                                            <input  type="text" placeholder="验证码"  class="text_accont" name="code" maxlength="4" isNot="true"  verify="isAll" msg="请输入验证码" />                            
						                    <img  src="{:U('Public/verify',array('imageW'=>130,'imageH'=>40,'fontSize'=>19))}" style="top: 7px;right:2px;width: 64px;height: 25px;" onclick="this.src=this.src+'?temp='+ 1" />											 
                                       </p>  										 
                                </div>
                                <div class="an_niu">
                                    <!--<input  type="submit" value="登录" class="a1" />-->
									<div class="zc_btn1" onmouseout="huanyuandl();" onmouseover="jiaohuandl();">
                                      <button  type="submit"  class="a1" style="margin-left:1px;border:none;margin-top:0px;" ><img id="im" src="__IMG__/btn_login1.png" alt="登录"/></button>
										</div>
                                    <div class="zc_btn2" onmouseout="huanyuan();"onmouseover="jiaohuan();">										
									<a class="wj" href="{:U('Public/forgetPaw')}"><img id="mm" src="__IMG__/btn_getPW1.png" alt="忘记密码"/></a>
									</div>
									<!--<div class="zc_btn2">
									<a href="{:U('Public/forgetPaw')}"><img src="__IMG__/btn_getPW1.png" alt="注册"/></a>
									</div>
									<input type="submit" value="登录" style="width:50px;height:30px;background:green;color:#f3b610" tabindex="4" name="Submit" onclick="Login()">
                                    <input type="submit" value="忘记密码" href="{:U('Public/forgetPaw')}" class="a2" style="width:50px;height:30px;background:green;color:#f3b610" tabindex="4" >-->
                                </div>
                            </div>
						
                        </form>
						</div>
                      </div>
            </if>
        </div>
    </div>
    <div class="topMenu">
        <div class="w12">
            <ul>
                <li <if condition="$active eq 'index'"> class="active" </if> > <a href="/">首页</a></li>
                <li <if condition="$active eq 'egame'"> class="active" </if>>
                    <a href="{:U('Zhenren/login',array('type'=>'ag'))}"  target="_blank" >电子游艺<img src="__IMG__/hot/hot.gif" style="margin-top:-30px;margin-left:-23px;"></a>
                  <div class="subnav" >
                        <span class="jt"></span>
                    </div>
                </li>
                <li <if condition="$active eq 'chess'"> class="active" </if> > 
				    <a href="{:U('Zhenren/login',array('type'=>'ky'))}"  target="_blank" >棋牌大厅<img src="__IMG__/hot/hot.gif" style="margin-top:-30px;margin-left:-23px;"></a>
					<div class="subnav" >
                        <span class="jt"></span>
                    </div>
				</li>
                <li>
                <a href="{:U('Zhenren/login',array('type'=>'ag'))}"  target="_blank" >捕鱼天堂<img src="__IMG__/hot/hot.gif" style="margin-top:-30px;margin-left:-23px;"></a>
                <div class="subnav" >
                    <span class="jt"></span>
                </div>
                </li>
                <li <if condition="$active eq 'real_man'"> class="active" </if>>
                  <a href="{:U('Index/zrvideo')}">真人娱乐</a>
                   <div class="subnav">
                        <span class="jt"></span>
                    </div>
                </li>
                <li>
                <a href="{:U('Zhenren/login',array('type'=>'ss'))}" target="_blank"  >体育游戏<img src="__IMG__/hot/hot.gif" style="margin-top:-30px;margin-left:-23px;"></a>
                <div class="subnav" >
                    <span class="jt"></span>
                </div>
                </li>
                <li>
                    <a href="{:U('Index/lotteryhall')}">彩票游戏<img src="__IMG__/hot/hot.gif" style="margin-top:-30px;margin-left:-23px;"></a>
                    <div class="subnav">
                        <span class="jt"></span>
                        <div class="con">
						<!-- <a href="javascript:void(0)" onclick="toGame('VR', 'VR');"><img src="__IMG__/hot/vr007.png" style=" margin-left: -18px;">VR彩票<img src="__IMG__/hot/207.gif" style="margin-top:-20px;"></a>-->
                            <a target="_blank"<if condition="is_array($userinfo)">   
							href="__ROOT__/Game.lhc?code=lhc"
							<else/>
							onclick="window.location.href='__ROOT__/Game.lhc?code=lhc;'"
							</if>
							>
							<img src="__IMG__/hot/001.png" style=" margin-left: -25px;">六合彩</a>
                            <a target="_blank"<if condition="is_array($userinfo)"> 
							href="__ROOT__/Game.ssc?code=hnwfc">
						    <else/>
							onclick="window.location.href='__ROOT__/Game.ssc?code=hnwfc;'"
							</if>
							>
							<img src="__IMG__/hot/002.png" style=" margin-left: -25px;">河内五分
							<img src="__IMG__/hot/207.gif" style="margin-top:-92px;margin-left:80px;"></a>
                           <!-- <a href="javascript:void(0)" onclick="toGame('Lottery', '2');"><img src="__IMG__/hot/003.png" style=" margin-left: -25px;">快乐十分</a>-->
                           <a target="_blank"<if condition="is_array($userinfo)"> 
							href="__ROOT__/Game.pk10?code=xyft">
							<else/>
							onclick="window.location.href='__ROOT__/Game.pk10?code=xyft;'"
							</if>
							>
							<img src="__IMG__/hot/004.png" style=" margin-left: -21px;">幸运飞艇</a>
                            <a target="_blank"<if condition="is_array($userinfo)"> 
							href="__ROOT__/Game.k3?code=gxk3">
						    <else/>
							onclick="window.location.href='__ROOT__/Game.k3?code=gxk3;'"
							</if>
							>
							<img src="__IMG__/hot/005.png" style=" margin-left: -25px;">广西快3</a>
                            <a target="_blank"<if condition="is_array($userinfo)"> 
							href="__ROOT__/Game.x5?code=gd11x5">
							<else/>
							onclick="window.location.href='__ROOT__/Game.x5?code=gd11x5;'"
							</if>
							>
							<img src="__IMG__/hot/006.png" style=" margin-left: -18px;">广东11选5</a>   
                           
                        </div>
                    </div>
                </li>
                <li><a href="{:U('activity/hall')}">优惠活动<img src="__IMG__/hot/new.gif" style="margin-top:-30px;margin-left:-23px;"></a></li>

                </li>
                <li><a href="{:GetVar('kefuthree')}" target="_blank">在线客服</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 左侧浮动
<div id="floatService1">
    <a href="" target="_blank" onmouseout="huanyuankc();" onmouseover="jiaohuankc();">
        <img id="kc" src="__IMG__/float/floatleft2.png" >
    </a>
    <a href="" target="_blank" onmouseout="huanyuanyh();" onmouseover="jiaohuanyh(); ">
        <img id="yh" src="__IMG__/float/floatleft3.gif" >
    </a>
	 <a href="" target="_blank">
        <img src="__IMG__/float/floatleft.png" >
    </a>
    <a href="javascript:void(0)" onclick="$(this).parent().hide()" id="closefloat" onmouseout="huanyuancloseleft();" onmouseover="jiaohuancloseleft(); ">
        <img id="closeleft" src="__IMG__/float/close.png" >
    </a>
</div>-->
<!-- 右侧浮动
<div id="floatService2">

    <a  href="" target="_blank" onmouseout="huanyuanphone();" onmouseover="jiaohuanphone();">
        <img id="phone" src="__IMG__/float/floatright1.png">
		
    </a>

    <a href="" target="_blank" onmouseout="huanyuankf();" onmouseover="jiaohuankf();">
        <img id="kf" src="__IMG__/float/floatright2.png">
    </a>
    <a href="javascript:void(0)" onclick="$(this).parent().hide()" id="closefloat2" onmouseout="huanyuancloseright();" onmouseover="jiaohuancloseright(); ">
        <img id="closeright" src="__IMG__/float/close.png"></a>
</div>-->
<div id="floatService3">
<a href="javascript:" onClick="window.open('{:U('public/hongbao')}')">
        <img src="__IMG__/float/qianghongbao.gif">
    </a>
    
</div>
<!--<div class="loginCengBox">
    <div class="loginCeng">
        <div class="loginCengH">
            <h3>温馨提示</h3>
            <span class="loginCengClose">
				<i class="iconfont icon-guanbi-copy"></i>
			</span>
        </div>
        <div class="loginCengB">

        </div>
        <div class="loginCengF">
            <button type="submit" >确定</button>
        </div>
    </div>
</div>-->


