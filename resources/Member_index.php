 <include file="Public/headermember" />
    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS2__/reset.css">
    <link rel="stylesheet" href="__CSS2__/securityCenter.css">
    <link rel="stylesheet" href="__CSS2__/userInfo.css">
 <script type="text/javascript" src="/resources/js/way.min.js"></script>
 <script type="text/javascript" src="/resources/main/common.js"></script>
 <script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
 <div class="vip">
 <div class="vip_info clearfix container">
    <include file="Member/side" />
    <div class="pull-right vip_info_pan">
        <div class="vip_info_title">
            安全中心
        </div>
        <div class="vip_info_content security_main">
            <div class="star">
                <?php
                    $num = abs($schedule/100)*10/2;
                  for($i=1;$i<6;$i++){
                     if($num-$i >= 0){
                       echo "<i class=\"iconfont special\">&#xe610;</i>";
                     }else{
                        echo "<i class=\"iconfont \">&#xe610;</i>";
                    }
                  }
                ?>
            </div>
            <div class="text">
                <h3>您的账号安全级别为{$aqjibie}，可以通过完善安全信息提高级别。</h3>
                <p>上次登录： {$Think.session.lastlogin.lasttime} , IP：{$Think.session.lastlogin.lastip}，{$Think.session.lastlogin.login_address} | 不是我登录？<a href="{:U('Member/update_pass')}" class="">修改密码</a></p>
            </div>
            <ul class="set_list">
                <li class="clearfix">
                    <span class="iconfont success">&#xe765;</span>
                    <div class="set_list_column">
                        <strong>登录密码</strong>
                        <em>建议您使用字母和数字的组合、混合大小写、在组合中加入下划线等符号。</em>
                    </div>
                    <a class="set_btn pull-right" href="{:U('Member/update_pass')}">修改密码</a>
                  </li>
                 <li class="clearfix">

                    <span class="iconfont <notempty name="userinfo.tradepassword">success</notempty>">&#xe60f;</span>
                    <div class="set_list_column">
                        <strong>已设置资金密码</strong>
                        <em>资金密码用于提现、绑定银行卡等操作，可保障资金安全。</em>
                    </div>
                        <a class="set_btn pull-right"  href="{:U('Member/update_safepass')}">修改资金密码</a>
                        <a class="set_btn pull-right" href="{:U('Member/find_safepass')}">找回资金密码</a>

                </li>
                <li class="clearfix">
                    <span class="iconfont <notempty name="userinfo.tel">success</notempty>">&#xe600;</span>
                    <div class="set_list_column ">
                        <strong><notempty name="userinfo.tel">已绑定密保手机<else />未绑定密保手机</notempty></strong>
                        <em>密保手机可以增加账户安全性，快速找回帐号密码。</em>
                    </div>
                    <notempty name="userinfo.tel">
                        <a class="set_btn pull-right" href="">已绑定保手机</a>
                        <else />
                        <a class="set_btn pull-right" href="{:U('Member/safephone')}">绑定密保手机</a>
                    </notempty>

                </li>
<!--                <li class="clearfix">
                    <span class="iconfont <notempty name="userinfo.question">success</notempty> ">&#xe605;</span>
                    <div class="set_list_column">
                        <strong><notempty name="userinfo.question">已设置密保问题<else />未设置密保问题</notempty></strong>
                        <em>密保问题可以增加账户安全性，快速找回帐号密码。</em>
                    </div>
                    <notempty name="userinfo.question"><a class="set_btn pull-right" href="{:U('Member/updateProblem')}">修改密保问题</a>
                        <else /><a class="set_btn pull-right" href="{:U('Member/setProblem')}">设置密保问题</a></notempty>
                </li>-->
                <li class="clearfix">
                    <span class="iconfont <notempty name="userinfo.email">success</notempty>">&#xe61d;</span>
                    <div class="set_list_column">
                        <strong><notempty name="userinfo.email">已绑定密保邮箱<else />未绑定密保邮箱</notempty></strong>
                        <em>绑定邮箱可以增加账户安全性，快速找回帐号密码。</em>
                    </div>
                    <notempty name="userinfo.email">
                        <a class="set_btn pull-right" href="">修改密保邮箱</a>
                        <else />
                        <a class="set_btn pull-right" href="{:U('Member/bindmail')}">绑定密保邮箱</a>
                    </notempty>

                </li>
            </ul>
        </div>
    </div>
</div>
</div>
 <script>
     $(function () {
         $('.set_list a').each(function (i) {
             $(this).hover(function () {
                 $(this).css('background-color','#2E4158').css('color','#fff');
             },function () {
                 $(this).css('background-color','#fff').css('color','#666');
             })
         })
     })
 </script>
 <include file="Public/footer" />
</body>
</html>