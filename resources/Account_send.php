<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>云闪付</title>
      
  <script type="text/javascript" src="__JS__/jquerysm.js"></script>
    <style type="text/css">
        @charset "UTF-8";
  html {font-size:62.5%;font-family:'helvetica neue',tahoma,arial,'hiragino sans gb','microsoft yahei','Simsun',sans-serif}
  body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,button,textarea,p,blockquote,th,td,hr {margin:0;padding:0}
  body{line-height:1.333;font-size:12px}
  h1,h2,h3,h4,h5,h6{font-size:100%;font-family:arial,'hiragino sans gb','microsoft yahei','Simsun',sans-serif}
  input,textarea,select,button{font-size:12px;font-weight:normal}
  input[type="button"],input[type="submit"],select,button{cursor:pointer}
  table {border-collapse:collapse;border-spacing:0}
  address,caption,cite,code,dfn,em,th,var {font-style:normal;font-weight:normal}
  li {list-style:none}
  caption,th {text-align:left}
  q:before,q:after {content:''}
  abbr,acronym {border:0;font-variant:normal}
  sup {vertical-align:text-top}
  sub {vertical-align:text-bottom}
  fieldset,img,a img,iframe {border-width:0;border-style:none}
  img{ 
    -ms-interpolation-mode:bicubic;
    
  }
  textarea{overflow-y:auto}
  legend {color:#000}
  a:link,a:visited {text-decoration:none}
  hr{height:0}
  label{cursor:pointer}
  .clearfix:after {content:"\200B";display:block;height:0;clear:both}
  .clearfix {*zoom:1}
  a{color:#328CE5}
  a:hover{color:#2b8ae8;text-decoration:none}
  a.hit{color:#C06C6C}
  a:focus {outline:none}
  .hit{color:#8DC27E}
  .txt_auxiliary{color:#A2A2A2}
  .clear {*zoom:1}
  .clear:before,.clear:after {content:"";display:table}
  .clear:after {clear:both}
  body,.body
  {background:#f7f7f7;height:100%}
  .mod-title
  {height:60px;line-height:60px;text-align:center;border-bottom:1px solid #ddd;background:#fff}
  .mod-title .ico-wechat
  {display:inline-block;width:41px;height:36px;vertical-align:middle;margin-right:7px}
  .mod-title .text
  {font-size:20px;color:#333;font-weight:normal;vertical-align:middle}
  .mod-ct
  {width:610px;padding:0 135px;margin:0 auto;margin-top:15px;background:#fff url("/Public/Home/images/wave.png") top center repeat-x;text-align:center;color:#333;border:1px solid #e5e5e5;border-top:none}
  .mod-ct .order
  {font-size:20px;padding-top:30px}
  .mod-ct .amount
  {font-size:48px;margin-top:20px}
  .mod-ct .qr-image
  {margin-top:10px;font-size: 18px;}
  .mod-ct .qr-image img
  {width:230px;height:230px;}
  .mod-ct .detail
  {margin-top:20px;padding-top:25px}
  .mod-ct .detail .arrow .ico-arrow
  {display:inline-block;width:20px;height:11px;background:url("../images/wechat-pay.png") -25px -100px no-repeat}
  .mod-ct .detail .detail-ct
  {display:none;font-size:14px;text-align:right;line-height:28px}
  .mod-ct .detail .detail-ct dt
  {float:left}
  .mod-ct .detail-open
  {border-top:1px solid #e5e5e5}
  .mod-ct .detail .arrow
  {padding:6px 34px;border:1px solid #e5e5e5}
  .mod-ct .detail .arrow .ico-arrow
  {display:inline-block;width:20px;height:11px;background:url("../images/wechat-pay.png") -25px -100px no-repeat}
  .mod-ct .detail-open .arrow .ico-arrow
  {display:inline-block;width:20px;height:11px;background:url("../images/wechat-pay.png") 0 -100px no-repeat}
  .mod-ct .detail-open .detail-ct
  {display:block}
  .mod-ct .tip
  {margin-top:40px;border-top:1px dashed #e5e5e5;padding:30px 0;position:relative}
  .mod-ct .tip .ico-scan
  {display:inline-block;width:56px;height:55px;background:url("../images/wechat-pay.png") 0 0 no-repeat;vertical-align:middle;*display:inline;*zoom:1}
  .mod-ct .tip .tip-text
  {display:inline-block;vertical-align:middle;text-align:left;margin-left:23px;font-size:16px;line-height:28px;*display:inline;*zoom:1}
  .mod-ct .tip .dec
  {display:inline-block;width:22px;height:45px;background:url("../images/wechat-pay.png") 0 -55px no-repeat;position:absolute;top:-23px}
  .mod-ct .tip .dec-left
  {background-position:0 -55px;left:-136px}
  .mod-ct .tip .dec-right
  {background-position:-25px -55px;right:-136px}
  .foot
  {text-align:center;margin:30px auto;color:#888888;font-size:12px;line-height:20px;font-family:"simsun"}
  .foot .link
  {color:#0071ce}
      </style>
  </head>
  <body>
  <div class="body">
    <h1 class="mod-title">
      <span class="ico-wechat"><img src="__CSS__/yunshanfu/ysf.png" width="41"></span><span class="text">云闪付扫码支付</span>      </h1>
    <div class="mod-ct">
      <div class="order">
      </div>
      <div class="amount">
        <span>￥</span>{$recharge_info.amount}</div>
        <h2 style="color: red;font-size: 2rem;">
          充值完成后请点击下方【确认支付】,否则不会到账哦！
        </h2>
      <div class="qr-image clearfix">
        <div id="billImage">
          <img style="width:230px;height:230px;margin-top:20px;" src="/Uploads/2019-03-06/5c7fecebe5ce1.png">
          <p style="margin-top: 20px;">
          </p><form action="{:U('Account/send_post')}" method="get" id="formget">
            <input type="hidden" name="trano" value="{$recharge_info.trano}">
            商户订单号：<input type="text" name="third_no" id="third_no" placeholder="请输入商户订单号后六位数" style="width: 200px;
                    padding: 5px 10px;
                    line-height: 30px;
                    font-size: 14px;
                    color: #000;
                    border: 1px solid #ccc;">
                    <input type="submit" style="display: inline-block; padding: 13px 15px; background: #d68702; border-radius: 4px; color: #fff;font-size: 12px;border: none;" value="确认支付，返回首页">

          </form>
          <script>
            $("#formget").submit( function()
            {
              var valdata = $(this).serialize();
              var v = $("#third_no").val();
              if( v == '' ){
                alert('请输入商户订单号后六位数，否则财务不能到账');
                return false;
              }
              $.post("{:U('Account/send_post')}",valdata,function(res)
              {
                  res = JSON.parse(res);
                  if( res.status == 1 ){
                    window.location = '/Account.ysfRecharge.do';
                  }
              });
              return false;

            });
          </script>
          <p></p>
        </div>
        <div class="yinchang" style="display: none;">
          <div style="padding:20px 0;color:red;">
             充值成功
           </div>
           您可以 <a href="" target="_blank">联系客服</a>、<a href="https://2443a.com/">进行游戏</a>、<a href="https://ck2894.com/index.php/Index/index.html">返回充值首页</a>
        </div>
      </div>
      <!--detail-open 加上这个类是展示订单信息，不加不展示-->
      <div class="detail detail-open" id="orderDetail" style="">
        <dl class="detail-ct" style="display: block;">        
          <dt>交易单号</dt>
          <dd id="billId">{$recharge_info.trano}</dd>
          <dt>创建时间</dt>
          <dd id="createTime">{$data.time|default=$recharge_info['oddtime']|date='Y-m-d H:i:s',###}</dd>
        </dl>     
      </div>
      <div>
        <a href="" id="buzhou" style="display: inline-block; padding: 15px 20px; background: #d60202; border-radius: 4px; color: #fff;font-size: 14px;">订单号查询步骤</a>
          <div id="buzhou_box" style="display:none;float: left;margin-top: 100px;clear: both;height: auto;width: 100%;">
            <p>步骤1:支付完成-点击账单-详情</p><p><br></p><p>步骤2:获取商户订单号后六位</p><p><br></p><p>步骤3:填入商户订单号-点击确认支付</p>        </div>
      </div>
      <div class="tip">
        <span class="dec dec-left"></span>
        <span class="dec dec-right"></span>
        <div class="ico-scan">
        </div>
        <div class="tip-text">
          <p>
            请使用云闪付扫一扫
          </p>
          <p>
            扫描二维码完成支付
          </p>
          <p>
            请等待后台人员处理
          </p>
          <p>
            有问题联系<a href="{:GetVar('kefuthree')}" target="_blank">联系客服</a>
          </p>
        </div>
      </div>
    </div>
    <div class="foot">
      <div class="inner">
        <p>
          
        </p>
      </div>
    </div>
  </div>
  <script>
    $("#buzhou").click( function()
    {
      $("#buzhou_box").toggle();
      return false
    });
  </script>
  
  
  <div id="tong" style="display:none;">
   <p>公告</p></div>
</body></html>