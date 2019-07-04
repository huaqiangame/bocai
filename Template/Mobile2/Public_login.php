<include file="Public/header"/>
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
<header data-am-widget="header" class="am-header am-header-default header nav_bg am-header-fixed">
  <div class="am-header-left am-header-nav">
    <a href="javascript:history.back(-1);" class="">
      <i class="iconfont icon-arrow-left"></i>
    </a>
  </div>
  <h1 class="am-header-title userHome_h1" style="margin: 0 auto; width: 100%;">
    用户登录
    <span><a href="{:GetVar('kefuthree')}" target="_blank" style="float: right;">客服</a></span>
  </h1>
</header>

<div class="bank_recharge">
  <form method="post" class="ruivalidate_form_class" id="form1" checkby_ruivalidate
        url="" action="{:U('Public/logindo')}">
    <ul class="bank_form_list">
      <li class="am-cf">
        <span class="bank_form_left am-fl">账　号</span>
        <div class="am-fr bank_right_input">
          <input type="text" class="input_txt" name="name" placeholder="请输入账号">
        </div>
      </li>
      <li class="am-cf">
        <span class="bank_form_left am-fl">密　码</span>
        <div class="am-fr bank_right_input">
          <input type="password" name="pass" class="input_txt" placeholder="请输入密码">
        </div>
      </li>
      <!--            <li class="am-cf" style="position:relative;">
                      <span class="bank_form_left am-fl">验证码</span>
                      <div class="am-fr bank_right_input">
                          <input type="text" name="code" class="input_txt"　style="width:20%;" placeholder="请输入验证码">
                      </div>
                      <span style="position:absolute;right:0;font-size:0.18rem;top:0;"><img style="height:0.45rem;width:1.2rem;" src="{:U('Public/verify',array('imageW'=>110,'imageH'=>30))}"  onclick="this.src=this.src+'?temp='+ 1" /></span>
                  </li>-->
    </ul>
    <p class="bank_pass"><a href="{:U('Public/forgetPaw')}">忘记密码?</a></p>
    <button id="btn_login" style="margin-top:0.1rem;margin-bottom: 0px;"
            class="am-btn am-btn-danger am-radius am-btn-block" type="button">立即登录
    </button>
    <p class="bank_pass " style="text-align: center;"><a href="{:U('Public/register')}">没有账号? 立即注册</a></p>
  </form>
</div>
<script>
  function check_login(obj) {
    $.ajax({
      url: "{:U('Public/LoginDo')}",
      type: 'POST',
      data: $("#form1").serialize(),
      success: function (data) {
        if (data.sign == true) {
          alert(data.message);
          window.location.href = "{:U('Member/index')}"
        } else {
          if (data.message == "你的帐号已在别处登陆，是否重新登陆") {
            if (confirm('你的帐号已在别处登陆，是否重新登陆')) {
              $.ajax({
                url: "{:U('Public/LoginDo')}",
                type: "POST",
                data: {
                  name: $("input[name=name]").val(),
                  pass: $("input[name=pass]").val(),
                  nocode: true,
                },
                success: function (json) {
                  alert(json.message);
                  window.location.href = "{:U('Member.index')}";
                }
              })
            }
          } else {
            alert(data.message);
          }
        }
      }
    })
    return false;
  }

  $(function () {
    $('#btn_login').on('click', function () {
      check_login(this);
    })
  });
</script>
</body>
</html>