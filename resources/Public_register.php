<include file="Public/register1" />
    <link rel="stylesheet" href="__CSS2__/register.css">
<link rel="stylesheet" type="text/css" href="__CSS__/artDialog.css" />
<script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__JS__/artDialog.js"></script>
<script type="text/javascript" src="__JS__/index.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
 <style>
        .msgs {
            display: inline-block;
            width: 104px;
            color: #fff;
            font-size: 12px;
            border: 1px solid #0697DA;
            text-align: center;
            height: 40px;
            line-height: 40px;
            background: #0697DA;
            cursor: pointer;
            border-radius: 5px;
        }

        form .msgs1 {
            background: #E6E6E6;
            color: #818080;
            border: 1px solid #CCCCCC;
        }
    </style>


   
    <script type="text/javascript">
        var validate_code;

        function get_validate_code_fun() {
            $.post('/welcome/get_validate_code_num', function (data) {
                validate_code = data;
            });
        }

        $(function () {

            //获取短信验证码
            var validCode = true;
            $(".msgs").click(function () {
                var time = 30;
                var code = $(this);
                if (validCode) {
                    alert("暂未开放！");
                    validCode = false;
                    code.addClass("msgs1");
                    var t = setInterval(function () {
                        time--;
                        code.html(time + "秒");
                        if (time == 0) {
                            clearInterval(t);
                            code.html("重新获取");
                            validCode = true;
                            code.removeClass("msgs1");
                        }
                    }, 1000)
                }
            })


            $('#tuijian_id').focus(function () {
                $('.active_f').removeClass('active_f');
                $(this).addClass('active_f').keyup();
                $('#cer').html('推荐人');
                $('#txte').html('无推荐人请输入9001');
            }).keyup(function () {
                $(this).val().length > 3 ?
                    $('#zhangh').css('background', 'url(../images/check_green.png)')
                    :
                    $('#zhangh').css('background', 'url(../images/check_gray-1.png)');
            });
            $('#user_name').focus(function () {
                $('.active_f').removeClass('active_f');
                $(this).addClass('active_f').keyup();
                $('#cer').html('账号');
                $('#txte').html('请输入4-12码英文或数字且符合0~9及a~z字元');
            }).keyup(function () {
                var reg = /^[A-Za-z0-9]+$/;
                !reg.test($('#user_name').val()) || $('#user_name').val().length < 4 || $('#user_name').val().length > 12 ?
                    $('#zhangh').css('background', 'url(../images/check_gray-1.png)')
                    :
                    $('#zhangh').css('background', 'url(../images/check_green.png)');
            });

            $('#user_pass').focus(function () {
                $('.active_f').removeClass('active_f');
                $(this).addClass('active_f').keyup();
                $('#cer').html('密码');
                $('#txte').html('请输入6-12码英文或数字且符合0~9及a~z字元');
            }).keyup(function () {
                $('#user_pass').val().length < 6 || $('#user_pass').val().length > 12 ?
                    $('#zhangh').css('background', 'url(../images/check_gray-1.png)')
                    :
                    $('#zhangh').css('background', 'url(../images/check_green.png)');
            });

            $('#user_confirm_pass').focus(function () {
                $('.active_f').removeClass('active_f');
                $(this).addClass('active_f').keyup();
                $('#cer').html('确认密码');
                $('#txte').html('请保持与密码相同');
            }).keyup(function () {
                $('#user_pass').val() == $('#user_confirm_pass').val() ?
                    $('#zhangh').css('background', 'url(../images/check_green.png)')
                    :
                    $('#zhangh').css('background', 'url(../images/check_gray-1.png)');
            });
            // $('#code_input_reg').focus(function () {
            //     $('.active_f').removeClass('active_f');
            //     $(this).addClass('active_f').keyup();
            //     $('#cer').html('验证码');
            //     $('#txte').html('请输入四位验证码');
            // }).keyup(function () {
            //     $('#code_input_reg').val().toUpperwCase() == validate_code.toUpperCase() ?
            //         $('#zhangh').css('background', 'url(../images/check_green.png)')
            //         :
            //         $('#zhangh').css('background', 'url(../images/check_gray-1.png)');
            // });

            // $('#phone').focus(function () {
            //     $('.active_f').removeClass('active_f');
            //     $(this).addClass('active_f').keyup();
            //     $('#cer1').html('手机号码');
            //     $('#txte1').html('请输入您的手机号码');
            // }).keyup(function () {
            //     $('#phone').val().length ==11?
            //         $('#zhangh1').css('background', 'url(../images/check_green.png)')
            //         :
            //         $('#zhangh1').css('background', 'url(../images/check_gray-1.png)');
            // });
			$('#qq').focus(function () {
                $('.active_f').removeClass('active_f');
                $(this).addClass('active_f').keyup();
                $('#cer1').html('QQ号码');
                $('#txte1').html('请输入您的QQ号码');
            }).keyup(function () {
                $('#qq').val().length > 5 ?
                    $('#zhangh1').css('background', 'url(../images/check_green.png)')
                    :
                    $('#zhangh1').css('background', 'url(../images/check_gray-1.png)');
            });
		    $('#wechat').focus(function () {
                $('.active_f').removeClass('active_f');
                $(this).addClass('active_f').keyup();
                $('#cer1').html('微信号码');
                $('#txte1').html('请输入您的微信号码');
            }).keyup(function () {
                $('#wechat').val().length > 1?
                    $('#zhangh1').css('background', 'url(../images/check_green.png)')
                    :
                    $('#zhangh1').css('background', 'url(../images/check_gray-1.png)');
            });
            $('#passwordss').focus(function () {
                $('.active_f').removeClass('active_f');
                $(this).addClass('active_f').keyup();
                $('#cer1').html('取款密码');
                $('#txte1').html('提款认证必须，请务必记住！');
                $(this).val('');
                //$('#passbox').show().find('span').html('');
            });
            $('#email').focus(function () {
                $('.active_f').removeClass('active_f');
                $(this).addClass('active_f').keyup();
                $('#cer1').html('邮箱号码');
                $('#txte1').html('请输入您的邮箱号码');
			
            }).keyup(function () {
                $('#email').val().length > 4 ?
                    $('#zhangh1').css('background', 'url(../images/check_green.png)')
                    :
                    $('#zhangh1').css('background', 'url(../images/check_gray-1.png)');
            });
            $('#passboxbom div').click(function () {
                if ($('#passwordss').val() == '') {
                    $('#passwordss').val($(this).html());
                    $('#passboxn span:eq(0)').html($(this).html());
                } else if ($('#passwordss').val().length <= 4) {
                    $('#passboxn span:eq(' + $('#passwordss').val().length + ')').html($(this).html());
                    $('#passwordss').val($('#passwordss').val() + '' + $(this).html());
                }
                if ($('#passwordss').val().length > 3) {
                    $('#passbox').hide();
                    $('#zhangh1').css('background', 'url(../images/check_green.png)')
                }
            });

            // var show_arr = '@php echo $company_info->set_user_reg;@endphp';
            var show_arr = '<?php echo $company_info->set_user_reg; ?>';
            if (show_arr == '') {
                show_arr = {"parent": "1", "phone": "1", "email": "1", "wechat": "1", "qq": "1"};
            } else {
                show_arr = eval('(' + show_arr + ')');
            }

            if (show_arr.parent == 2) {
                $('#tuijian_li i').css('color', 'transparent');
            }
            if (show_arr.parent == 3) {
                $('#tuijian_li').hide();
            }
            if (show_arr.phone == 2) {
                $('#phone_li i').css('color', 'transparent');
            }
            if (show_arr.phone == 3) {
                $('#phone_li').hide();
            }
            if (show_arr.email == 2) {
                $('#email_li i').css('color', 'transparent');
            }
            if (show_arr.email == 3) {
                $('#email_li').hide();
            }
            if (show_arr.wechat == 2) {
                $('#wechat_li i').css('color', 'transparent')
            }
            if (show_arr.wechat == 3) {
                $('#wechat_li').hide();
            }
            if (show_arr.qq == 2) {
                $('#qq_li i').css('color', 'transparent')
            }
            if (show_arr.qq == 3) {
                $('#qq_li').hide();
            }

            $('.eye').click(function () {
                var type = $(this).prev().attr('type');
                if (type == 'text') {
                    var pass_change = 'password';
                    $(this).find("div").first().removeClass('eyes');
                    $(this).find("div").first().addClass('eyeh');
                } else {
                    var pass_change = 'text';
                    $(this).find("div").first().removeClass('eyeh');
                    $(this).find("div").first().addClass('eyes');
                }

                $(this).prev().attr('type', pass_change);
            });
            $('#reg_btn').click(function () {
                var reg = /^[A-Za-z0-9]+$/;
                if (!reg.test($('#user_name').val()) || $('#user_name').val().length < 4 || $('#user_name').val().length > 12) {
                    alert('用户名必须为3-15位的数字和字母的组合');
                    return;
                }

                if ($('#user_pass').val().length < 6 || $('#user_pass').val().length > 12) {
                    alert('密码应在6位到12位之间！');
                    return;
                }
                if ($('#user_pass').val() != $('#user_confirm_pass').val()) {
                    alert('密码与确认密码不符');
                    return;
                }
                // if ($('#code_input_reg').val().toUpperCase() != validate_code.toUpperCase()) {
                //     alert('验证码不正确');
                //     return;
                // }
                if ($('#real_name').val() == '') {
                    alert('请填写真实姓名');
                    return;
                }
                // if (show_arr.phone == 1 && $('#phone').val().length != 11) {
                //     alert('请填写手机');
                //     return;
                // }

                // if (show_arr.email == 1 && $('#email').val() == '') {
                //     alert('请填写邮箱');
                //     return;
                // }

                if ($('#passwordss').val().length < 4) {
                    alert('请填写取款密码');
                    return;
                }
                var options = {
                    success: function (data) {
                        data = eval('(' + data + ')');
                        if (data['code'] == 200) {
                            alert(data['msg']);
                            window.location.href = '/';
                        } else {
                            alert(data['msg']);
                        }
                    }
                };
                check_form();
                // $('#reg_form').ajaxSubmit(options);
            });
        });
    </script>
 <div class="page-body">
  <div class="banner-game">
                    
                     <img src="__IMG__/register/title_welcome.png">    
             <div class="news-wrap-c">
                    <div class="news-wrap-box">
                       <div class="news-wrap-ctr">
                         <div class="news-wrap-ky">
                            <marquee scrollamount="3"   onmouseover="this.stop();"
                                     onmouseout="this.start();" style="cursor: pointer;margin-left:120px;" hspace="110"width="87%"> {$gonggao.title}</marquee>
                         </div>
                       </div>
                    </div>
                 </div>			 
           
			
             
  </div>
        <div class="wibox_v">
            <div class="wibox" id="wibox">
                <div class="leftbox">
                    <ul id="ng">
                        <p>欢迎光临</p>
                        <li>
                            <a href="{:U('News/help',['catid'=>30,'showid'=>3])}?About">
                                <span></span>關於我們<br>
                                <b>ABOUTUS</b>
                            </a>
                        </li>
                        <li>
                            <a href="{:U('News/help',['catid'=>30,'showid'=>56])}?About">
                                <span></span>聯絡我們<br>
                                <b>CONTACTUS</b>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{:U('public/agentIndex')}">
                                <span></span>合作夥伴<br>
                                <b>PARTNER</b>
                            </a>
                        </li>
                        <li>
                            <a href="{:U('News/help',['catid'=>30,'showid'=>58])}?About">
                                <span></span>存款幫助<br>
                                <b>DEPOSIT</b>
                            </a>
                        </li>
                        <li>
                            <a href="{:U('News/help',['catid'=>30,'showid'=>59])}?About">
                                <span></span>取款幫助<br>
                                <b>WITHDRAW</b>
                            </a>
                        </li>
                        <li>
                            <a href="{:U('News/help',['catid'=>33,'showid'=>43])}?About">
                                <span></span>常见问题<br>
                                <b>QUESTIONS</b>
                            </a>
                        </li>
                    </ul>
                </div>
                <aside class="rightbox" id="rightbox">
                    <div class="wcmbox">
                        <div class="wcm">
                            <p>【创世彩票】欢迎您 的加入！</p>
                        </div>
                        <p>*最低存款10元！</p>
                        <p>*天天返水无上限，尊享贵宾礼遇！</p>
                    </div>
                    <form method="post" id="reg_form">
                        <div class="bodytext_a">
                            <div class="innu">
                                <ul class="step_1" id="step_1">
                                    <if condition="$linkinfo != null">
                                        <li class="step" id="tuijian_li">
                                            <span>推荐号码</span>
                                            <i>*</i>
                                            <input type="text" name="tuijian_id" readonly  value="{$linkinfo.uid}">
                                        </li>

                                        <else />
                                        <li class="step" id="tuijian_li">
                                            <span>推荐号码</span>
                                            <i>*</i>
                                            <input type="text" name="tuijian_id" id="tuijian_id">
                                        </li>
                                    </if>
                                    <li class="step">
                                        <span>帐号</span>
                                        <i>*</i>
                                        <input type="text" name="user_name" id="user_name" maxlength="12">
                                    </li>                         
                                    <li>
                                        <span>密码</span>
                                        <i>*</i>
                                        <input type="password" name="password" id="user_pass" maxlength="12">
                                        <div class="eye">
                                            <div class="eyeh"></div>
                                            <div class="eyer"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <span>确认密码</span>
                                        <i>*</i>
                                        <input type="password" name="user_confirm_pass" id="user_confirm_pass"
                                               maxlength="12">
                                        <div class="eye">
                                            <div class="eyeh"></div>
                                            <div class="eyer"></div>
                                        </div>
                                    </li>
<!--                                    <li>-->
<!--                                        <span>货币</span>-->
<!--                                        <i>*</i>-->
<!--                                        <select name="">-->
<!--                                            <option>RMB</option>-->
<!--                                        </select>-->
<!--                                    </li>-->
                                    <li class="yzm">
                                        <span>验证码</span>
                                        <i>*</i>
                                        <div style="width:262px;height:62px;">
                                            <input type="text" name="code_input_reg" id="code_input_reg" maxlength="4">
                                           <!-- <img src="/welcome/get_validate_code"
                                                 onclick="this.src='/welcome/get_validate_code?'+Math.random();"
                                                 onload="get_validate_code_fun()">-->
												 <a href="javascript:void(0)" class="two_code" >
						<img  src="{:U('Public/verify',array('imageW'=>130,'imageH'=>40,'fontSize'=>18))}"  onclick="this.src=this.src+'?temp='+ 1" /></a>
                                        </div>
                                    </li>
                                    <li class="stepright">
                                        <p>Step1.注册帐号</p>
                                        <div class="zhangh" id="zhangh">
                                            <p id="cer">帐号</p>
                                            <p id="txte">请输入4-12位用户名</p>
                                        </div>

                                    </li>
                                </ul>
                                <ul class="step_1" id="step_2">

                                  <!--     <li class="step" id="phone_li">
                                        <span>手机</span>
                                        <i>&nbsp;&nbsp;</i>
                                        <input type="number" name="phone" id="phone">
                                    </li>
                                
                                    @php
                                        $reg_validata = json_decode($company_info->set_user_reg_validata,true);

                                        $sms_code = isset($reg_validata['sms_code']) ? $reg_validata['sms_code'] : 2;

                                    @endphp
                                    @if($sms_code == 1)
                                        <li>
                                            <span>验证码</span>
                                            <i>*</i>
                                            <input type="text" name="sms_code" id="sms_code" style="width: 135px">
                                            <span class="msgs">获取短信验证码</span>
                                        </li>
                                    @endif-->
                                    <li>
                                        <span>取款密码</span>
                                        <i>*</i>
                                        <input type="password" name="pay_pass" id="passwordss" >
                                        <div class="suo"></div>
                                        <div class="passbox" id="passbox">
                                            <div class="passboxn" id="passboxn">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <div class="passboxbom" id="passboxbom">
                                                <div>7</div>
                                                <div>8</div>
                                                <div>9</div>
                                                <div>4</div>
                                                <div>5</div>
                                                <div>6</div>
                                                <div>1</div>
                                                <div>2</div>
                                                <div>3</div>
                                                <div>0</div>
                                                <div>AC</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li id="email_li">
                                        <span>邮箱</span>
                                        <i>&nbsp;&nbsp;</i>
                                        <input type="text" name="email" id="email">
                                    </li>
<!--                                    <li id="wechat_li">-->
<!--                                        <span>微信号</span>-->
<!--                                        <i>&nbsp;&nbsp;</i>-->
<!--                                        <input type="text" name="wechat" id="wechat">-->
<!--                                    </li>
                                    <li id="qq_li">
                                        <span>QQ号</span>
                                        <i>&nbsp;&nbsp;</i>
                                        <input type="number" name="qq" id="qq">
                                    </li>-->
                                     <li class="stepright">
                                        <p>Step2.注册帐号</p>
                                        <div class="zhangh" id="zhangh1">
                                            <p id="cer1">取款密码</p>
                                            <p id="txte1">请输入取款密码！</p>
                                        </div>
                                        <!--<div class="kong">
                                            <i class="ion-alert-circled" data-reactid=".0.0.1:$category0.1.1.3.0"></i>
                                            该栏位不得为空
                                        </div>-->
                                    </li>
                                    <div class="xiey">
                                        <input class="xiey" type="checkbox" checked/>
                                        <span>我已届满合法博彩年龄，且同意各项开户条约。</span>
                                        <a id="kh" href="javascript:void(0)" style="color: #00f"
                                           onclick="$('#hidey').show()">开户协议</a>
                                    </div>
                                </ul>
                                <div class="sure">
                                    <input type="button" value="确认注册" id="reg_btn"/ style="width:354px;height:59px;">
                                    <ul>
                                        <li>1. 标记有 * 者为必填项目。</li>
                                        <li>2. 手机与取款密码为取款金额时的凭证，请会员务必填写详细资料。</li>
                                        <li>3. 若公司有其它活动会 E-MAIL 通知，请客户填写清楚。</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="hides" id="hides">
                        <a class="offset" href="javascript:void(0)">X</a>
                        <div class="hidebox">
                            <div class="topbox">
                                <p>靠谱登入码</p>
                                <P>当您输入自订的帐号，系统会在您的帐号后方，自动加上</P>
                                <P>@bme</P>
                                <P>例如：您自订帐号是kwa2，登入码即为：kwa2@bme</P>
                                <P>这是加强保护会员资料的安全机制！</P>
                                <P>登入网站时，在「帐号」栏位，输入您自订的帐号；</P>
                                <P>登入App时，在「username」栏位，输入包含@的登入码就可以了。</P>
                            </div>
                            <div class="bottombox">
                                <a href="javascript:void(0)">我知道了</a>
                            </div>
                        </div>
                    </div>
                    <div class="hidey" id="hidey">
                        <a class="jjj" id="jjj" href="javascript:void(0)" onclick="$('#hidey').hide()">X</a>
                        <div class="hidbox">
                            <p>開戶協議</p>
                            <ul>
                                <li>立即开通创世彩票线上娱乐城CASINO账户，享受最优惠的各项红利!</li>
                                <li>创世彩票线上娱乐城CASINO只接受合法博彩年龄的客户申请。同时我们保留要求客户提供其年龄证明的权利。在创世彩票线上娱乐城CASINO进行注册时所提供的全部信息必须在各个方面都是准确和完整的。在使用借记卡或信用卡时，持卡人的姓名必须与在网站上注册时的一致。
                                </li>
                                <li>在开户后进行一次有效存款，恭喜您成为创世彩票线上娱乐城有效会员!</li>
                                <li>存款免手续费，开户最低入款金额100人民币，最高单次入款金额50000人民币。</li>
                                <li>成为创世彩票线上娱乐城
                                    有效会员后，客户有责任以电邮、联系在线客服、在创世彩票线上娱乐城网站上留言等方式，随时向本公司提供最新的个人资料。
                                </li>
                                <li>                                          经创世彩票线上娱乐城CASINO发现会员有重复申请账号行为时，有权将这些账户视为一个联合账户。我们保留取消、收回会员所有优惠红利，以及优惠红利所产生的盈利之权利。每位玩家、每一住址、每一电子邮箱、每一电话号码、相同支付卡/信用卡号码，以及共享计算机环境 (例如:网吧、其他公共用计算机等)只能够拥有一个会员账号，各项优惠只适用于每位客户在创世彩票线上娱乐城CASINO唯一的账户。
                                </li>
                                <li>经创世彩票线上娱乐城CASINO
                                    是提供互联网投注服务的机构。请会员在注册前参考当地政府的法律，在博彩不被允许的地区，如有会员在经创世彩票线上娱乐城CASINO
                                    注册、下注，为会员个人行为，经创世彩票线上娱乐城CASINO}}不负责、承担任何相关责任。
                                </li>
                                <li>无论是个人或是团体，如有任何威胁、滥用经创世彩票线上娱乐城CASINO
                                    优惠的行为，经创世彩票线上娱乐城CASINO保留杈利取消、收回由优惠产生的红利，并保留权利追讨最高50%手续费。
                                </li>
                                <li>所有经创世彩票线上娱乐城CASINO
                                    的优惠是特别为玩家而设，在玩家注册信息有争议时，为确保双方利益、杜绝身份盗用行为，{经创世彩票线上娱乐城CASINO
                                    保留权利要求客户向我们提供充足有效的文件，
                                    并以各种方式辨别客户是否符合资格享有我们的任何优惠。
                                </li>
                                <li>客户一经注册开户，将被视为接受所有颁布在经创世彩票线上娱乐城CASINO网站上的规则与条例。</li>
                                <p class="iii">
                                    本公司是使用RED-BET所提供的在线娱乐软件，若发现您在同系统的娱乐城上开设多个会员账户，并进行套利下注；本公司有权取消您的会员账号并将所有下注营利取消！</p>
                            </ul>
                            <div class="buh">
                                <div class="dialog-footer" id="dialog-footer"
                                     style="text-align: center;cursor: pointer;" onclick="$('#hidey').hide()">
                                    <span class="dialog" style="float: none">我已满合法年龄，且同意开户条约。</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

<script type="text/javascript" src="__JS__/Validform_v5.3.2.js"></script>
<script type="text/javascript" src="__JS__/passwordStrength-min.js"></script>
<script type="text/javascript">
	$(function(){
		// $("#form1").Validform({
		// 	tiptype:function(msg,o,cssctl){
		// 		var objtip=o.obj.siblings(".Validform_checktip");
		// 		cssctl(objtip,o.type);
		// 		objtip.text(msg);
		// 	},
		// 	usePlugin:{
		// 		passwordstrength:{
		// 			minLen:6,
		// 			maxLen:18
		// 		}
		// 	},
		// 	callback:check_form
		// });

		$('input[name="reccode"]').blur(function () {
			var text = $(this).val();
			if(!text || text.trim() == ''){
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('邀请码不能为空');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-chenggong');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-cross-ivt');
			}else{
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-cross-ivt');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-chenggong');
			}
		})

		$('.text_accont[name="username"]').blur(function () {
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

		$('.text_accont[name="password"]').blur(function () {
			var text = $(this).val();
			if(!text || text.trim() == ''){
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('密码不能为空');
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

		$('.text_accont[name="cpassword"]').blur(function () {
			var text = $(this).val();
			if(!text || text.trim() == ''){
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('确认密码不能为空');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-chenggong');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-cross-ivt');
			}else if(text.length < 6 || text.length > 16){
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('确认密码范围在6-16位');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-chenggong');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-cross-ivt');
			}else if(text != $('.text_accont[name="password"]').val()){
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('两次密码不相同');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-chenggong');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-cross-ivt');
			}else{
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-cross-ivt');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-chenggong');
			}
		})

		$('.text_accont[name="tradepassword"]').blur(function () {
			var text = $(this).val();
			if(!text || text.trim() == ''){
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('资金密码不能为空');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-chenggong');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-cross-ivt');
			}else{
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-cross-ivt');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-chenggong');
			}
		})

		$('input[name="code"]').blur(function () {
			var text = $(this).val();
			if(!text || text.trim() == ''){
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('验证码不能为空');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-chenggong');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-cross-ivt');
			}else{
				$(this).siblings('.checkInput').show();
				$(this).siblings('.checkInput').find('span').text('');
				$(this).siblings('.checkInput').find('.iconfont').removeClass('icon-cross-ivt');
				$(this).siblings('.checkInput').find('.iconfont').addClass('icon-chenggong');
			}
		})

	})
	function rdirect(url){
		window.location.href = url;
	}

	function check_form(obj){

		// if(!$('input[name=age]').is(':checked')){
		// 	alt('禁止未成年人注册');
		// 	return false;
		// }
 		$.ajax({
			url : "{:U('public/register')}",
			type : 'POST',
			data : {
                reccode          :   $('input[name=tuijian_id]').val(),
                username          :   $('input[name=user_name]').val(),
				code       :   $('input[name=code_input_reg]').val(),
                cpassword      :   $('input[name=user_confirm_pass]').val(),
				password       :   $('input[name=password]').val(),
                phone        :   $('input[name=phone]').val(),
                tradepassword  :   $('input[name=pay_pass]').val(),
                email       :   $('input[name=email]').val(),
                qq       :   $('input[name=qq]').val(),
			},
			beforeSend : function(){
				$('#submit').attr('disabled','disabled');
			},
			success : function(json){
				if(json.sign==1){
					alt('恭喜您注册成功，感谢您的加入!');
					var url = json.url?json.url:"{:U('Home/Index/index')}";
					// window.location.href= url;
					setTimeout("rdirect('"+url+"')", 1500);
					   $('#submit').attr('disabled',false);
				}else{
					   $('#submit').attr('disabled',false);
					  alt(json.message);
				}
			}
		})

//		$.post($(obj).attr('action'),$(obj).serialize(), function(json){
//			if(json.sign==1){
//				alt('恭喜您注册成功，感谢您的加入!');
//				var url = json.url?json.url:"{:U('Home/Index/index')}";
// 				setTimeout("rdirect('"+url+"')", 1500);
//			}else{
//				alt(json.message);
//			}
//		},'json');
		return false;
	}

	function sendtelcode(obj){
		if($("input[name='username']").val().length<3){
			alert('用户名设置错误');
			return false;
		}

		if($("input[name='password']").val().length<6){
			alert('密码设置错误');
			return false;
		}
		if($("input[name='password']").val()!=$("#qpassWord").val()){
			alert('两次密码输入不一致');
			return false;
		}
		var tel = $("#tel").val();
		var exp = new RegExp("^(1)[0-9]{10}$");
		if(!exp.test(tel)){
			alert('手机号码填写错误');
			$("#tel").focus();
			return false;
		}
		if($("input[name='verCord']").val().length<4){
			alert('图形验证码设置错误');
			return false;
		}else{
			$.post("{:U('Public/check_verify')}",{'code':$("input[name='verCord']").val()}, function(json){
				if(json.status=='y'){
					var token = json.token;
					sendmsg(tel,token,obj);
				}else{
					alert('图形验证码错误!');
					return false;
				}
			},'json');
		}
	}
	function sendmsg(tel,token,obj){
		$.post("{:U('Public/sendmsn')}",{'token':token,'mobile':tel}, function(json){
			if(json.status=='y'){
				settime(obj);
			}else{
				alert(json.message);
				return false;
			}
		},'json');
	}
	var countdown=180;
	function settime(obj) {
		if (countdown == 0) {
			obj.removeAttribute("disabled");
			obj.value="免费获取验证码";
			countdown = 180;
			return;
		} else {
			obj.setAttribute("disabled", true);
			obj.value="重新发送(" + countdown + ")";
			countdown--;
		}
		setTimeout(function() {
				settime(obj) }
			,1000)
	}
</script>
<!--<style>
	.loading{
		width:100%;
		height:100%;
		background:#000;
		display: block;
		z-index: 9999;
	}
</style>
<div class="loading">

</div>-->
<include file="Public/footer" />
</body>
</html>