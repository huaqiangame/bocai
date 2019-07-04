{php}$webheadertitle = '会员中心';{/php}
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

<link rel="stylesheet" href="./Template/Mobile/css/sm.css">
<link rel="stylesheet" href="./Template/Mobile/css/sm-extend.min.css">
<link rel="stylesheet" href="./Template/Mobile/css/reset.css">
<link rel="stylesheet" href="./Template/Mobile/css/theme-red.css">
<script type='text/javascript' src='./Template/Mobile/js/zepto.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/config.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/sm-extend.js' charset='utf-8'></script>
<script src="./Template/Mobile/js/sm-city-picker.js"></script>
<script type='text/javascript' src='./Template/Mobile/js/way.min.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/common.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/ucenter.js' charset='utf-8'></script>
</head>
<body>
<div class="page-group">
      <!-- 你的html代码 -->
      <div class="page">
          {include file="Public/header" /}
          <div class="content" id="page-modal">
  <div class="list-block media-list" style="margin-top:0;">
      <ul>
        <li>
            <div class="item-content">
				<div class="item-media"><img src="./Template/Mobile/images/rui-face.png" width="80"></div>
				<div class="item-inner">
				  <div class="item-title-row">
					<div class="item-title">{$userinfo.username}</div>
				  </div>
				  <div class="item-subtitle">余额账户：{$userinfo.balance}</div>
				  <div class="item-subtitle">洗码账户：{$userinfo.xima}</div>
				  <div class="item-subtitle">积分账户：{$userinfo.point}</div>
				</div>
			</div>
        </li>

      </ul>
    </div>
	<a class="button prompt-bindcard" onclick="bankCardList();bindcard();">+ 添加绑定银行卡</a>
	<div class="list-block media-list inset">
        <ul id="userbanklist">
		{volist name="userbanklist" id="card"}
		  <li>
            <div class="item-inner item-content">
              <div class="item-title-row">
                <div class="item-title">{$card.bankname}</div>
                <div class="item-after">
				{if condition="$card['state'] eq 1"}
					{if condition="$card['isDefault'] eq 1"}
					默认
					{else /}
					<a href="#" onchange= "defaultUserBankCard('{$card.id}');">设置默认</a>
					{/if}
				{elseif condition="$card['state'] eq 2" /}
				驳回
				{elseif condition="$card['state'] eq 0" /}
				审核中
				{/if}
				</div>
              </div>
			  <div class="item-subtitle">{$card.banknumber}</div>
            </div>
          </li>
		  {/volist}
        </ul>
    </div>
	<div class="content-block-title">安全中心</div>
	<div class="list-block media-list inset">
      <ul>
        <li>
          <a href="#" class="item-link item-content prompt-usereditpass">
            <div class="item-inner">
              <div class="item-title-row">
                <div class="item-title">登录密码</div>
              </div>
              <div class="item-subtitle" style="color:grey">建议您使用字母和数字组合、混合大小写、在组合中加入下划线等符号。</div>
            </div>
          </a>
        </li>
        <li>
          <a href="#" class="item-link item-content prompt-usereditdrawpass">
            <div class="item-inner">
              <div class="item-title-row">
                <div class="item-title">资金密码</div>
              </div>
              <div class="item-subtitle" style="color:grey">在进行银行卡绑定，转账等资金操作时需要进行资金密码确认，以提高您的资金安全性。</div>
            </div>
          </a>
        </li>
        <li>
          <a href="#" class="item-link item-content prompt-bindrealname">
            <div class="item-inner">
              <div class="item-title-row">
                <div class="item-title">银行账户姓名</div>
              </div>
              <div class="item-subtitle" style="color:grey">绑定玩家的开户姓名后，将无法自行修改，可保证资金的绝对安全。</div>
            </div>
          </a>
        </li>
		{present name="question"}
        <li>
          <a href="#" id="isQuestion" class="item-link item-content prompt-editquestion">
            <div class="item-inner">
              <div class="item-title-row">
                <div class="item-title">修改密码保护</div>
				<input type="hidden" id="editquestion_q1" value="{$question.questionone}">
				<input type="hidden" id="editquestion_q2" value="{$question.questiontwo}">
				<input type="hidden" id="editquestion_q3" value="{$question.questionthree}">
              </div>
              <div class="item-subtitle" style="color:grey">绑定安全问题后可以通过安全问题找回账号资料。</div>
            </div>
          </a>
        </li>
		{else /}
        <li>
          <a href="#" id="isQuestion" class="item-link item-content prompt-usersecurity">
            <div class="item-inner">
              <div class="item-title-row">
                <div class="item-title">密码保护</div>
              </div>
              <div class="item-subtitle" style="color:grey">绑定安全问题后可以通过安全问题找回账号资料。</div>
            </div>
          </a>
        </li>
		{/present}
        <li>
          <a href="#" class="item-link item-content prompt-bindphone">
            <div class="item-inner">
              <div class="item-title-row">
                <div class="item-title">手机绑定</div>
              </div>
              <div class="item-subtitle" style="color:grey">绑定手机号码，增加账户安全性。</div>
            </div>
          </a>
        </li>
        <li>
          <a href="#" class="item-link item-content prompt-bindemail">
            <div class="item-inner">
              <div class="item-title-row">
                <div class="item-title">绑定邮箱</div>
              </div>
              <div class="item-subtitle" style="color:grey">绑定邮箱可增加账号安全级别，也可以确保在邮箱正常的情况下取回登陆密码。</div>
            </div>
          </a>
        </li>
      </ul>
    </div>
	
          </div>
      </div>
  </div>
{include file="Public/footer" /}

  </body>
</html>