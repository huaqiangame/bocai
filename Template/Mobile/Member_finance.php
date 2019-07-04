{php}$webheadertitle = '资金管理';{/php}
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="MSUI: Build mobile apps with simple HTML, CSS, and JS components.">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="/favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>{$webheadertitle}</title>
<script>
var payhost = "{:C('payhost')}";
</script>

<link rel="stylesheet" href="./Template/Mobile/css/sm.css">
<link rel="stylesheet" href="./Template/Mobile/css/sm-extend.min.css">
<link rel="stylesheet" href="./Template/Mobile/css/reset.css">
<link rel="stylesheet" href="./Template/Mobile/css/theme-red.css">
<script type='text/javascript' src='./Template/Mobile/js/zepto.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/config.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/sm-extend.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/way.min.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/common.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/finance.js' charset='utf-8'></script>
</head>
<body>
<div class="page-group">
      <!-- 你的html代码 -->
      <div class="page">
          {include file="Public/header" /}
          <div class="content" id="page-modal" style="background: #fff;">
  <div class="buttons-tab">
    <a href="#tab1" class="tab-link active button">充值</a>
    <a href="#tab2" class="tab-link button" onclick="isUserWithdrawLimit();">提款</a>
    <a href="#tab3" class="tab-link button" onclick="pointexchangeamountLimit();">积分兑换</a>
  </div>
  <div class="content-block">
    <div class="tabs">
      <div id="tab1" class="tab active">
			<input type="hidden" id="recharge_minmoney" value="10">
			<input type="hidden" id="recharge_maxmoney" value="50000">
            <div class="list-block" id="pay_alipay">
				<ul class="mar-lr20">
				  <!-- Text inputs -->
				  <li>
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">充值方式</div>
						<div class="item-input">
						  <select name="paytype" id="paytype" onchange="setpaytype();">
							<option value="0" minmoney="10" maxmoney="50000">请选择支付方式</option>
							{volist name="bankpaylists" id="vo"}<option ewmurl="{$vo['configs']['ewmurl']}" value="{$vo['paytype']}" minmoney="{$vo['minmoney']|intval}" maxmoney="{$vo['maxmoney']|intval}">{$vo['paytypetitle']}</option>{/volist}
						  </select>
						</div>
					  </div>
					</div>
				  </li>
				  <li>
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">充值金额</div>
						<div class="item-input">
						  <input type="number" id="recharge_amount" placeholder="输入充值金额" min="1" onkeyup="replaceAndSetPos(this,event,/[^\d]/g,'');" class="">
						</div>
					  </div>
					</div>
				  </li>
				  <li class="nuonlinepayname" style="display:none;">
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">支付账号</div>
						<div class="item-input">
						  <input type="text" id="recharge_payname" placeholder="输入您的支付账号" min="1" class="">
						</div>
					  </div>
					</div>
				  </li>
				  <span id="paylinebankbox"></span>
				</ul>
				<botton class="button button-big button-fill button-danger nextrechargebtn"  onclick="recharge(event);">下一步</botton>
			  </div>
      </div>
      <div id="tab2" class="tab">
            <div class="list-block">
				<ul>
				  <li>
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">选择银行卡</div>
						<div class="item-input">
						{if condition="$userbanklist"}
						<select name="bankid" id="tikuanorder_bankid">
							<option value="0">选择提款银行卡</option>
							{volist name="userbanklist" id="vo"}<option value="{$vo['id']}" {if condition="$vo['isdefault'] eq 1"}selected{/if}>{$vo['bankname']}({$vo['banknumber']})</option>{/volist}
						  </select>
						  {else /}
						  请先绑定银行卡
						  {/if}
						</div>
					  </div>
					</div>
				  </li>
				  <li>
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">提款金额</div>
						<div class="item-input">
						  <input type="number" id="quk_withdraw_money" placeholder="请输入提款金额" min="1" onkeyup="replaceAndSetPosWithdraw(this,event,/[^\d]/g,'');" class="">
						</div>
					  </div>
					</div>
				  </li>
				  <li>
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">手续费</div>
						<div class="item-input">
						  <input type="text" id="quk_fee" value="0.00" class="">
						</div>
					  </div>
					</div>
				  </li>
				  <li>
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">实际到账</div>
						<div class="item-input">
						  <input type="text" id="quk_ramount" value="0.00"  class="">
						</div>
					  </div>
					</div>
				  </li>
				  <li>
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">提款密码</div>
						<div class="item-input">
						  <input type="password" id="quk_withdraw_pwd" placeholder="请输入提款密码" min="1" class="">
						</div>
					  </div>
					</div>
				  </li>
				 
				</ul>
				<botton class="button button-big button-fill button-danger toApplyForWithdrawbtn"  onclick="toApplyForWithdraw(event);">确认提款</botton>
				<p>温馨提示：您今天还有<t id="quk_explain_freetimes">{:C('tikuannum')}</t>次提款免手续费特权</p>
			  </div>
      </div>
      <div id="tab3" class="tab">
            <div class="list-block">
				<ul>
				  <li>
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">兑换积分</div>
						<div class="item-input">
						  <input type="number" id="jfdh_point" placeholder="请输入兑换积分量" min="1" onkeyup="replacepointexchangeamount(this,event,/[^\d]/g,'');" class="">
						</div>
					  </div>
					</div>
				  </li>
				  <li>
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">可兑换金额</div>
						<div class="item-input">
						  <input type="text" id="jfdh_money" value="0.00" class="">
						</div>
					  </div>
					</div>
				  </li>
				  <li>
					<div class="item-content">
					  <div class="item-inner">
						<div class="item-title label">提款密码</div>
						<div class="item-input">
						  <input type="password" id="jfdh_withdraw_pwd" placeholder="请输入提款密码" min="1" class="">
						</div>
					  </div>
					</div>
				  </li>
				 
				</ul>
				<botton class="button button-big button-fill button-danger"  onclick="PointtoMoney(event);">确认兑换</botton>
				<p id="PointtoMoneymsg">温馨提示：<t id="quk_explain_freetimes">{:C('pointexchangeamount')}</t>兑换1元</p>
			  </div>
      </div>
    </div>
  </div>
	
          </div>
      </div>
  </div>
{include file="Public/footer" /}

  </body>
</html>