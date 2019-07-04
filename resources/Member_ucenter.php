<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{:GetVar('webtitle')}</title>
	<meta name="keywords" content="{:GetVar('keywords')}" />
	<meta name="description" content="{:GetVar('description')}" />
<meta name="renderer" content="webkit" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/reset.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/layout.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/member.css" />
<script>
var WebConfigs = {
	webtitle:"{$webconfigs.webtitle}",
	kefuthree:"{$webconfigs.kefuthree}",
	ROOT : "__ROOT__",
	kefuqq:"{$webconfigs.kefuqq}"
};
</script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery.history.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/index.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/member.page.js"></script>
<script src="__ROOT__/resources/js/laydate/laydate.js" type="text/javascript" ></script>
<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/ucenter.js"></script>

<!--[if lt IE 9]>
<script src="__ROOT__/resources/js/html5shiv.js"></script>
<![endif]-->
</head>

<body>

{include file="Public/header" /}
<section class="container pt-10 pb-10" id="memberpage" >
	<div class="memberhome">
		{include file="Member/top" /}
		<div class="memhome-bottom ml-20 mr-20">
			<div class="memsubnav">
				
			{include file="Member/menu" /} 	
			</div>
			<div class="mem-main">
						<h5>添加绑定存提款银行卡</h5>
						<div class="m-bdyhk me-back">
							<div class="back-choose">
								<ul class="mar-lr16">
							</div>
						</div>
						<h5>安全中心</h5>
						<div class="m-sefety">
							<dl>
								<dd class="yb">
									<div class="se-icon l"><img src="__ROOT__/resources/images/member/se-icon-1.png" alt="" width="78" height="78"></div>
									<div class="se-xx l">
										<h6>登录密码</h6>
										<p>建议您使用字母和数字组合、混合大小写、在组合中加入下划线等符号。</p>
										<span class="mark" onclick="usereditpass();">修改密码</span>
									</div>
								</dd>
								<dd id="isTradePassword" class="wb">
									<div class="se-icon l"><img src="__ROOT__/resources/images/member/se-icon-4.png" alt="" width="78" height="78"></div>
									<div class="se-xx l">
										<h6>资金密码</h6>
										<p>在进行银行卡绑定，转账等资金操作时需要进行资金密码确认，以提高您的资金安全性。</p>
										<span class="mark" onclick="usereditdrawpass();">设置资金密码</span>
									</div>
								</dd>
								<dd id="isUserbankName" class="wb">
									<div class="se-icon l"><img src="__ROOT__/resources/images/member/se-icon-2.png" alt="" width="78" height="78"></div>
									<div class="se-xx l">
										<h6>银行账户姓名</h6>
										<p>绑定玩家的开户姓名后，将无法自行修改，可保证资金的绝对安全。</p>
										<span class="mark" onclick="userbindrealname();">绑定姓名</span>
									</div>
								</dd>
								<dd id="isQuestion" class="wb">
									<div class="se-icon l"><img src="__ROOT__/resources/images/member/se-icon-5.png" alt="" width="78" height="78"></div>
									<div class="se-xx l">
										<h6>密码保护</h6>
										<p>绑定安全问题后可以通过安全问题找回账号资料。</p>
										<span class="mark" onclick="usersecurity();">设置密保</span>
									</div>
								</dd>
								<dd id="isPhone" class="wb">
									<div class="se-icon l"><img src="__ROOT__/resources/images/member/sjbd-icon.svg" style="margin:10px 10px;" width="58" height="58"></div>
									<div class="se-xx l">
										<h6>手机绑定</h6>
										<p>绑定手机号码，增加账户安全性。</p>
										
									<span class="mark" onclick="userbindphone();">绑定</span></div>
								</dd>
								<dd id="isEmail" class="wb">
									<div class="se-icon l"><img src="__ROOT__/resources/images/member/se-icon-6.png" alt="" width="78" height="78"></div>
									<div class="se-xx l">
										<h6>绑定邮箱</h6>
										<p>绑定邮箱可增加账号安全级别，也可以确保在邮箱正常的情况下取回登陆密码。</p>
										<span class="mark" onclick="userbindemail();">绑定</span>
									</div>
								</dd>
							</dl>
						</div>
					</div>
			
		</div>
	</div>
</section>

{include file="Public/footer" /}
<!-- 设置密码保护弹框 -->
<div id="szmmbh" class="aar" style="display:none;">
	<div class="aar-center">
			<div class="tishik">
			<input type="hidden" id="questoken" value="0">
			<dl class="validate-form">
				<dt>
					<span class="tt">提示：</span>
					<span class="mark">请选择密保问题填写相应答案！</span>
				</dt>
					<dd>
					<span class="tt">问题1：</span>
					
					<select id="questionOne"  onchange="changeQuestionOne();">
						<option value="">--请选择--</option>
						<option value="您的出生地是?">您的出生地是?</option>
						<option value="您小学班主任的名字是?">您小学班主任的名字是?</option>
						<option value="您中学班主任的名字是?">您中学班主任的名字是?</option>
						<option value="您高中班主任的名字是?">您高中班主任的名字是?</option>
						<option value="您大学班主任的名字是?">您大学班主任的名字是?</option>
						<option value="您的小学校名是?">您的小学校名是?</option>
						<option value="您母亲的姓名是?">您母亲的姓名是?</option>
						<option value="您母亲的生日是?">您母亲的生日是?</option>
						<option value="您父亲的姓名是?">您父亲的姓名是?</option>
						<option value="您父亲的生日是?">您父亲的生日是?</option>
						<option value="您配偶的姓名是?">您配偶的姓名是?</option>
						<option value="您配偶的生日是?">您配偶的生日是?</option>
						<option value="对您影响最大的人名字是?">对您影响最大的人名字是?</option>
						<option value="您最喜欢的运动是?">您最喜欢的运动是?</option>
						<option value="您的学号（或工号）是?">您的学号（或工号）是?</option>
						<option value="您最喜欢的明星名字是?">您最喜欢的明星名字是?</option>
						<option value="您最熟悉的童年好友名字是?">您最熟悉的童年好友名字是?</option>
					</select>
				
				</dd>
				<dd>
					<span class="tt">答案：</span>
					<span><input class="inp-sty-1" type="text" id="answerOne" value=""></span>
				</dd>
				<dd>
					<span class="tt">问题2：</span>
					
					<select id="questionTwo" onchange="changeQuestionTwo();">
						<option value="">--请选择--</option>
						<option value="您的出生地是?">您的出生地是?</option>
						<option value="您小学班主任的名字是?">您小学班主任的名字是?</option>
						<option value="您中学班主任的名字是?">您中学班主任的名字是?</option>
						<option value="您高中班主任的名字是?">您高中班主任的名字是?</option>
						<option value="您大学班主任的名字是?">您大学班主任的名字是?</option>
						<option value="您的小学校名是?">您的小学校名是?</option>
						<option value="您母亲的姓名是?">您母亲的姓名是?</option>
						<option value="您母亲的生日是?">您母亲的生日是?</option>
						<option value="您父亲的姓名是?">您父亲的姓名是?</option>
						<option value="您父亲的生日是?">您父亲的生日是?</option>
						<option value="您配偶的姓名是?">您配偶的姓名是?</option>
						<option value="您配偶的生日是?">您配偶的生日是?</option>
						<option value="对您影响最大的人名字是?">对您影响最大的人名字是?</option>
						<option value="您最喜欢的运动是?">您最喜欢的运动是?</option>
						<option value="您的学号（或工号）是?">您的学号（或工号）是?</option>
						<option value="您最喜欢的明星名字是?">您最喜欢的明星名字是?</option>
						<option value="您最熟悉的童年好友名字是?">您最熟悉的童年好友名字是?</option>
					</select>
				
				</dd>
					<dd>
					<span class="tt">答案：</span>
					<span><input class="inp-sty-1" type="text" id="answerTwo" value=""></span>
				</dd>
				<dd>
					<span class="tt">问题3：</span>
					
						<select id="questionThree" onchange="changeQuestionThree();">
							<option value="">--请选择--</option>
							<option value="您的出生地是?">您的出生地是?</option>
							<option value="您小学班主任的名字是?">您小学班主任的名字是?</option>
							<option value="您中学班主任的名字是?">您中学班主任的名字是?</option>
							<option value="您高中班主任的名字是?">您高中班主任的名字是?</option>
							<option value="您大学班主任的名字是?">您大学班主任的名字是?</option>
							<option value="您的小学校名是?">您的小学校名是?</option>
							<option value="您母亲的姓名是?">您母亲的姓名是?</option>
							<option value="您母亲的生日是?">您母亲的生日是?</option>
							<option value="您父亲的姓名是?">您父亲的姓名是?</option>
							<option value="您父亲的生日是?">您父亲的生日是?</option>
							<option value="您配偶的姓名是?">您配偶的姓名是?</option>
							<option value="您配偶的生日是?">您配偶的生日是?</option>
							<option value="对您影响最大的人名字是?">对您影响最大的人名字是?</option>
							<option value="您最喜欢的运动是?">您最喜欢的运动是?</option>
							<option value="您的学号（或工号）是?">您的学号（或工号）是?</option>
							<option value="您最喜欢的明星名字是?">您最喜欢的明星名字是?</option>
							<option value="您最熟悉的童年好友名字是?">您最熟悉的童年好友名字是?</option>
						</select>
					
				</dd>
				<dd>
					<span class="tt">答案：</span>
					<span><input class="inp-sty-1" type="text" id="answerThree" value=""></span>
				</dd>
				<dd>
					<span class="tt">资金密码：</span>
					<span><input class="inp-sty-1" type="password" id="tradePwd" value=""></span>
				</dd>
			</dl>
			</div>
	</div>
</div>
<!-- 修改密码保护弹框 -->
<div id="xgmmbh" class="aar" style="display:none;">
	<div class="aar-center">
		<div class="tishik">
			<dl class="validate-form">
				<dt>
					<span class="tt">提示：</span>
					<span class="mark">请输入密保答案进行验证，通过后即可修改密保！</span>
				</dt>
				<dd>
					<span class="tt">问题1：</span>
					<span way-data="editquestion.questionone">我妈妈叫什么名字？</span>
				</dd>
				<dd>
					<span class="tt">答案：</span>
					<span><input class="inp-sty-1" id="editquestionans1" type="text" name="" value=""></span>
				</dd>
				<dd>
					<span class="tt">问题2：</span>
					<span way-data="editquestion.questiontwo">我妈妈叫什么名字？</span>
				</dd>
				<dd>
					<span class="tt">答案：</span>
					<span><input class="inp-sty-1" type="text" id="editquestionans2" name="" value=""></span>
				</dd>
				<dd>
					<span class="tt">问题3：</span>
					<span way-data="editquestion.questionthree">我妈妈叫什么名字？</span>
				</dd>
				<dd>
					<span class="tt">答案：</span>
					<span><input class="inp-sty-1" type="text" id="editquestionans3" name="" value=""></span>
				</dd>
			</dl>
		</div>
	</div>
</div>

<!-- 手机绑定 -->
<div id="jihuosj" class="aar" style="display:none;">
	<div class="aar-center">
		<div class="tishik" >
			<dl class="validate-form">
				<dt>
					<span class="tt">提示：</span>
					<span class="mark">请务必输入正确的手机号码！</span>
				</dt>
				<dd>
					<span class="tt">手机号码：</span>
					<span><input class="inp-sty-1" type="text" id="bindphone" value=""></span>
				</dd>
				<dd>
					<span class="tt">资金密码：</span>
					<span><input class="inp-sty-1" type="password" id="phonetradePwd" value=""></span>
				</dd>
			</dl>
		</div>
	</div>
</div>

<!-- 手机绑定 -->
<div id="emailsj" class="aar" style="display:none;">
	<div class="aar-center">
		<div class="tishik" >
			<dl class="validate-form">
				<dt>
					<span class="tt">提示：</span>
					<span class="mark">请务必输入正确的邮箱账号！</span>
				</dt>
				<dd>
					<span class="tt">邮箱账号：</span>
					<span><input class="inp-sty-1" type="text" id="bindemail" value=""></span>
				</dd>
				<dd>
					<span class="tt">资金密码：</span>
					<span><input class="inp-sty-1" type="password" id="emailtradePwd" value=""></span>
				</dd>
			</dl>
		</div>
	</div>
</div>
<!-- 添加银行弹框 -->
<div id="addyinh" class="aar" style="display:none;">
	<div class="aar-center">
		<div class="tishik" >
			<div class="wenxints">
				<p class="mark">温馨提示：为了您的资金安全，您所绑定的所有银行卡都必须在一个持卡人名下。</p>
			</div>
			<dl class="validate-form">
				<dd>
					<span class="tt">持卡人姓名：</span>
					<span way-data="user.userbankname">张*三</span>
				</dd>
				<dd>
					<span class="tt">选择银行：</span>
					
						<select id="sysBankCard">
						</select>
					
				</dd>
				<dd>
					<span class="tt">开户行地址：</span>
					
						<select id="province" onchange="changePre()" style="width:145px">
							<option value="">请选择</option>
							<option>北京市</option>
							<option>上海市</option>
							<option>天津市</option>
							<option>重庆市</option>
							<option>河北省</option>
							<option>山西省</option>
	   						<option>内蒙古自治区</option>
							<option>辽宁省</option>
	   						<option>吉林省</option>
							<option>黑龙江省</option>
							<option>江苏省</option>
							<option>浙江省</option>
							<option>安徽省</option>
	   						<option>福建省</option>
							<option>江西省</option>
							<option>山东省</option>
							<option>河南省</option>
							<option>湖北省</option>
							<option>湖南省</option>
	   	 					<option>广东省</option>
							<option>广西壮族自治区</option>
							<option>海南省</option>
							<option>四川省</option>
	   						<option>贵州省</option>
	   						<option>云南省</option>
							<option>西藏自治区</option>
		   					<option>陕西省</option>
							<option>甘肃省</option>
							<option>宁夏回族自治区</option>
							<option>青海省</option>
							<option>新疆维吾尔族自治区</option>
							<option>香港特别行政区</option>
							<option>澳门特别行政区</option>
							<option>台湾省</option>
							<option>其它</option>
						</select>
					
					
						<select id="city"style="width:145px">
							 <option>-请选择-</option>  
						</select>
					
				</dd>
				<dd>
					<span class="tt">开户行网点：</span>
					<span><input id="bankBranch" class="inp-sty-1" type="text" value=""></span>
				</dd>
				<dd>
					<span class="tt">银行卡号：</span>
					<span><input class="inp-sty-1" type="text" id="bankCardNum" value="" onkeyup="replaceAndSetPos(this,event,/[^\d]/g,'');"></span>
				</dd>
				<dd>
					<span class="tt">确认卡号：</span>
					<span><input class="inp-sty-1" type="text" id="regBankCardNum" value="" onkeyup="replaceAndSetPos(this,event,/[^\d]/g,'');"></span>
				</dd>
				<dd>
					<span class="tt">资金密码：</span>
					<span><input class="inp-sty-1" type="password" id="bankTradPwd" value=""></span>
				</dd>
			</dl>
		</div>
	</div>
</div>
<!-- 查看银行卡信息弹框 -->
<div id="ckyinh" class="aar " style="display:none;width: 600px;">
	<div class="aar-center">
		<div class="tishik" >
			<dl class="validate-form">
				<dt>
					<span class="tt">状态：</span>
					<span class="dred">审核中22...</span>
				</dt>
				<dd>
					<span class="tt">持卡人姓名：</span>
					<span>张*三</span>
				</dd>
				<dd>
					<span class="tt">所属银行：</span>
					<span class="xzyh">中国银行</span>
				</dd>
				<dd>
					<span class="tt">开户行地址：</span>
					<span class="khh">广西 南宁</span>
				</dd>
				<dd>
					<span class="tt">银行卡号：</span>
					<span>446456*****8748</span>
				</dd>
			</dl>
		</div>
	</div>
</div>

</body>
</html>