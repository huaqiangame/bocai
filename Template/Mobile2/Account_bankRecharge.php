<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="UTF-8">
  <title>{:GetVar('webtitle')}</title>
  <meta name="keywords" content="{:GetVar('keywords')}" />
  <meta name="description" content="{:GetVar('description')}" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" >

  <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
  <link rel="stylesheet" href="__CSS2__/reset.css">
  <link rel="stylesheet" href="__CSS2__/icon.css">
  <link rel="stylesheet" href="__CSS2__/header.css">
  <link rel="stylesheet" href="__CSS2__/userInfo.css">
  <link rel="stylesheet" href="__CSS2__/recharge.css">
  <link rel="stylesheet" href="__CSS2__/footer.css">
  <link rel="stylesheet" href="//at.alicdn.com/t/font_lo77yrw5tt8adcxr.css">
  <link rel="stylesheet" type="text/css" href="__CSS__/artDialog.css" />

</head>
<body>
<style>
  .me-infor {
    overflow: hidden;
    margin: 10px 0;
  }
  .me-infor .infor-xx {
    padding: 10px 20px;
    margin: 0 0 10px;
    border: 1px solid #e3e3e3;
  }
  .me-infor .infor-xx ul li {
    display: block;
    height: 36px;
    line-height: 36px;
    padding: 3px 0;
  }
  .me-infor .infor-xx h6{
    float:left;
  }
  .mark {
    color: #f33d3d;
  }
</style>
<include file="Public/header" />
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
  <include file="Member/side" />
  <div class="pull-right vip_info_pan">
    <div class="vip_info_title">
      我要充值
    </div>
    <div class="vip_info_content zfb_main">
      <include file="Account/paylist" />
      <form  method="post" action="{:U('Account/recharge')}" onSubmit="return checkform(this)">
        <div class="common_border_box1 choiceBank_box">
          <div class="choiceMoney">
            <span class="choiceMoney_l">充值金额：</span>
            <input type="text" name="amount" id="amount" placeholder="最低充值10" class="common_input">
          </div>
          <div class="choiceMoney" style="display:none">
            <span class="choiceMoney_l">支付账号：</span>
            <input type="text" name="payname" placeholder="请输入你的支付宝账号" value="zhifubao" class="common_input">
          </div>
          <div class="choiceBank clearfix">
            <span class="choiceMoney_l pull-left">充值方式：</span>
            <span class="collectBank_ra checked">
								<i class="iconfont icon-yuanquanxuanzhong"></i>
								<input type="radio"  name="paytype"  value="{$Allmsg['paytype']}" checked="checked"  style="display:none;">
								<svg class="icon" aria-hidden="true">
								</svg>
								<em>银行转账</em>
								<div class="r_right">
									<span class="r_right_con">√</span>
								</div>
							</span>
          </div>
          <button type="button"  class="btn common_btn nextbtn">充值</button>
          <div id="pay_alipay" class="me-infor" style="display:none;">
            <div class="infor-xx">
              <ul class="mar-lr20">
                <li>尊敬的客户您好，您的充值订单已经生成，请您在该页面继续完成充值。</li>
                <li>
                  <h6>充值金额：</h6>
                  <span><em class="mark" way-data="saomabill.amount"></em>元</span>
                </li>
                <li>
                  <h6>订单编号：</h6>
                  <span way-data="saomabill.trano" class="mark"></span>
                </li>
                <li>
                  <h6>附言码：</h6>
                  <span way-data="saomabill.id" class="mark"></span>
                </li>
                <li class='payerweima text-center'><h5>银行账号:{$Allmsg.bankcode}</h5></li>
              </ul>

              <div>
                <input type="hidden" way-data="saomabill.paytype" />
                <a class="btn common_btn" style="width:10em;display:block;margin:1em auto;" href="javascript:;" onclick="alt('充值申请已成功提交'); window.location.href = '{:U('Account/dealRecord2')}'">汇款并完成支付</a>
              </div>
            </div>
          </div>
          <div class="prompt">
            <?=$Allmsg['remark'];?>
            <!--<p>※ 温馨提示：</p>
            <p>1、快捷支付需开通网银才能进行支付。</p>
            <p>2、单笔充值金额最低20元，最高100000元。</p>
            <p>3、充值成功后，点击“返回商户”即可自动到账。</p>-->
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<include file="Public/footer" />
<script type="text/javascript">
  $('.nextbtn').click(function () {
    if($('input[name=amount]').val()=="") {
      alt('请输入充值金额');return false;
    }
    if($('input[name=payname]').val()==""){
      alt('请输入支付账号');return false;
    }
    $.ajax({
      type : 'POST',
      url : "{:U('Home/Apijiekou/addrecharge')}",
      data :{
        amount      : $('#amount').val(),
        paytype     : $("input[name='paytype']:checked").val(),
        userpayname : $("input[name='payname']").val(),
      },
      success : function (data) {
        if(data.sign == true){
          $('.nextbtn').hide();
          $('.choiceBank').hide();
          $('.choiceMoney').hide();
          $("#pay_alipay").show();
          way.set("saomabill.amount",data.data.amount);
          way.set("saomabill.trano",data.data.trano);
          way.set("saomabill.id",data.data.id);
          way.set("saomabill.paytype",data.data.paytype);
          //alt('充值申请成功提交,请稍等');
          setTimeout(function () {checkispay(data.data.trano);}, 5000);
        }else{
          alt(data.message);
        }
      }
    })
  })
  function paysaoma() {
    window.location.href = "{:U('Account/dealRecord2')}";
  }

  //检测是否扫码支付成功

  var checkispayid;
  function checkispay(trano){
    clearTimeout(checkispayid);
    $.ajax({
      url: "{:U('Apijiekou/checkrechargeisok1')}",
      data:{"trano": trano},
      type: "post",
      dataType: "json",
      async:false,
      success: function(result) {
        if (result.sign === true) {
          if(result.state!=0){
            if(result.state==1){
              alt("充值成功");
            }else if(result.state==-1){
              alt("充值失败",-1);
            }
            window.location.href = "{:U('Account/dealRecord2')}";
          }else{
            checkispayid = setTimeout(function () {
              checkispay(trano);
            }, 5000);
          }
        } else {
          checkispayid = setTimeout(function () {
            checkispay(trano);
          }, 5000);
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        checkispayid = setTimeout(function () {
          checkispay(trano);
        }, 5000);
      }
    });
  };
</script>
</body>
</html>