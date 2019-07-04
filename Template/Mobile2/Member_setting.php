<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
    <div class="am-header-left am-header-nav">
        <a href="javascript:history.back(-1);" class="">
            <i class="iconfont icon-arrow-left"></i>
        </a>
    </div>
    <h1 class="am-header-title userHome_h1">
        安全中心
    </h1>
</header>

<div class="security_h">
    <h4>—— 您的账号安全级别为{$aqjibie} ——</h4>
    <p class="security_h_stars">
        <?php
            $num = abs($schedule/100)*10/2;
          for($i=1;$i<6;$i++){
               if($num-$i >= 0){
                    echo "<i class=\"iconfont icon-favorfill current\"></i>";
                    }else{
                    echo "<i class=\"iconfont icon-favorfill\"></i>";
                }
        }
        ?>
    </p>

    <p class="security_h_time">
        上次登录：{$Think.session.lastlogin.lasttime}</p>
    <p class="security_h_ress"> IP：{$Think.session.lastlogin.lastip}，{$Think.session.lastlogin.login_address}  | <a href="{:U('Member/update_pass')}">不是我登录?</a></p>
</div>

<ul class="my_set_list security_list">
    <li>
        <a href="{:U('Member/update_pass')}" class="am-cf">
            <span>修改登录密码</span>
            <i class="iconfont icon-arrowright"></i>
            <em class="am-fr security_edit">修改</em>
        </a>
    </li>
    <li>
        <?php  if(empty($userinfo['tradepassword'])){?><a href="<?php echo U('Member/safepass');?>" class="am-cf"><?php }else{?><a href="<?php echo U('Member/update_safepass') ?>" class="am-cf"><?php }?>
            <span><?php  if(empty($userinfo['tradepassword'])){?>未设置资金密码 <?php }else{?>已设置资金密码<?php }?></span>
            <i class="iconfont icon-arrowright"></i>
            <em class="am-fr security_edit"><?php  if(empty($userinfo['tradepassword'])){?>设置<?php }else{?>修改<?php }?></em>
        </a>
    </li>
    <li>
        <a href="{:U('Member/safephone')}" class="am-cf">
            <span><eq name="userinfo['tel']" value="">设置密保手机<else />修改密保手机</eq></span>
            <i class="iconfont icon-arrowright"></i>
            <em class="am-fr security_edit"><eq name="userinfo['tel']" value="">设置<else />修改</eq></em>
        </a>
    </li>
<!--    <li>
        <a href="<eq name="userinfo['question']" value="">{:U('Member/setProblem')}<else />{:U('Member/updateProblem')}</eq>" class="am-cf">
            <span><eq name="userinfo['question']" value="">未设置密保问题<else />已设置密保问题</eq></span>
            <i class="iconfont icon-arrowright"></i>
            <em class="am-fr security_edit"><eq name="userinfo['question']" value="">设置<else />修改</eq></em>
        </a>
    </li>-->
    <li>
        <a href="{:U('Member/bindmail')}" class="am-cf">
            <span><eq name="userinfo['email']" value="">未设置密保邮箱<else />已设置密保邮箱</eq></span>
            <i class="iconfont icon-arrowright"></i>
            <em class="am-fr security_edit"><eq name="userinfo['email']" value="">设置<else />修改</eq></em>
        </a>
    </li>
    <li>
        <a href="{:U('Member/bindcard')}" class="am-cf">
            <span>银行卡管理</span>
            <i class="iconfont icon-arrowright"></i>
            <em class="am-fr security_edit"><eq name="bankcard" value="">查看<else />添加</eq></em>
        </a>
    </li>
</ul>

<include file="Public/footer" />
</body>
</html>