	<style>
		.uclose{
			position: fixed;color: red;font-size: 16px;
			width: 30px;
			height: 30px;
			line-height: 30px;
			text-align: center;
			top: 75px;
			right: 10px;
			cursor: pointer;
		}
	</style>
<link rel="stylesheet" type="text/css" href="__CSS__/register.css">
	<!--<script src="__JS__/zhuce.js"></script>-->
	<script src="__JS__/swiper.min.js"></script>
    <div id="J_regModal" class="reg-modal modal">
		<div class="inner container container_500F" style="padding-bottom:100px;padding: 0px 8px;background-color:#fff;">
			<div class="close" data-target="#J_regModal">&times;</div>
			<h1 class="container_500F_h1">————— 注册 —————</h1>
			<p class="container_500F_p">——— REGISTER ———</p>
			<form action="{:U('Public/register')}" id="register_form" class="form-horizontal" method="post" onSubmit="return check_form(this)" >
				<h2 class="register_form_bg_1">
					会员登陆信息
				</h2>
	            <div class="form-group">
					<label for="" class="col-sm-2 control-label">推&nbsp;荐&nbsp;人：&nbsp;&nbsp;</label>
					<div class="control-label-1">
					<input type="text" value="{:cookie('tid')}" name="reccode" id="reccode" maxlength="9" class="form-control">
					</div>
					<div class="control-label-2">
					<strong>*</strong><span>无推荐人请输入：9001</span>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">登录账号：</label>
					<div class="control-label-1">
					<input type="text" name="username" id="reg_username" maxlength="9" class="form-control">
					</div>
					<div class="control-label-2">
					<strong>*</strong><span>您在网站的登录账户，5-9个英文数字</span>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">登录密码：</label>
					<div class="control-label-1">
					<input type="password" name="password" id="reg_password" maxlength="12" onblur="pwStrength(this.value,0);"  class="form-control">
					</div>
					<div class="control-label-2">
					<strong>*</strong><span>由6-12位任意字符组成</span>
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-2 control-label">确认密码：</label>
					<div class="control-label-1">
					<input type="password" name="cpassword" id="reg_cpassword" maxlength="12" class="form-control">
					</div>
					<div class="control-label-2">
					<strong>*</strong><span>由6-12位任意字符组成</span>
					</div>
				</div>
				<h2 class="register_form_bg_2">会员个人信息</h2>
				<!--<div class="form-group">
					<label for="" class="col-sm-2 control-label">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：</label>
					<div class="control-label-1">
					<input type="text" name="zcturename" id="reg_zcturename" class="form-control"></div>
					<div class="control-label-2">
					<strong>*</strong><span>输入您的邮箱</span>
					</div>
				</div>-->

				<div class="form-group">
					<label for="" class="col-sm-2 control-label">提款密码：</label>
					<div class="control-label-1">
					<input type="password" name="tradepassword" id="reg_tradepassword" maxlength="12" onblur="pwStrength(this.value,1);" class="form-control">
					</div>
					<div class="control-label-2">
					<strong>*</strong><span>由6-12位任意字符组成</span>
					</div>
				</div>
				<div class="form-group captcha-row">
					<label for="" class="col-sm-2 control-label">验 证 码 ：</label>
					<div class=" control-label-a">
						<div class="input-group">
						<input type="text" name="zcyzm" id="reg_zcyzm" class="form-control" style="height:36px;" maxlength="4">
						<span class="input-group-addon" style="width:30%;">
						<img  src="{:U('Public/verify',array('imageW'=>130,'imageH'=>40,'fontSize'=>18))}" alt="点击刷新" name="zc_img" id="zc_img" style="cursor:pointer;" onclick="this.src=this.src+'?temp='+ 1" width="80" height="30" />
						</span>
						</div>
					</div>
					<div class="control-label-2">
					<strong>*</strong><span>请填写验证码</span>
					</div>
				</div>
				<!--<div class="form-group">
					<label class="col-sm-4 col-sm-offset-2 mt20">
					<input type="checkbox" name="zccheck" id="zccheck" value="1"> 我已届满合法博彩年龄﹐且同意各项开户条约。<a href="#" id="AGREEMENT123" class="red">"开户协议"</a>
						<script type="text/javascript">

					$(function(){
						$("#AGREEMENT123").click(function(){
							$("#J_regModal").hide();
							$("#xy").show();
						});
					})
					
					</script>
					</label>
				</div>-->

				<div class="form-group form-action">
					<div class="mt20 mb20">
					<button id="register" class="am-btn am-btn-danger am-radius am-btn-block" type="submit">提交开户</button>
					</div>
					<!-- <div class="col-sm-5">
					<input type="reset" value="重填" class="btn btn-danger" id="cancel_register" />
					</div> -->
				</div>
				<div class="h10"></div>
			</form>
		</div>
	</div>
	<!--<div id="xy" class="reg-modal modal" style="display: none;top: 45px;">
		<div class="inner container container_500F" style="padding-bottom:100px;padding: 0px 8px;background-color:#fff;overflow: initial">
			<div class="uclose">×</div>

			<h1 class="container_500F_h1" >立即开通本公司账户，享受最优惠的各项红利!</h1>

			<ul>

				<li>本公司只接受合法博彩年龄的客户申请。同时我们保留要求客户提供其年龄证明的权利。</li>

				<li>在本公司进行注册时所提供的全部信息必须在各个方面都是准确和完整的。在使用借记卡或信用卡时，持卡人的姓名必须与在网站上注册时的一致。</li>

				<li>在开户后进行一次有效存款，恭喜您成为本公司有效会员!</li>

				<li>存款免手续费，开户最低入款金额100人民币，最高单次入款金额50000人民币。</li>

				<li>成为本公司有效会员后，客户有责任以电邮、联系在线客服、在本公司网站上留言等方式，随时向本公司提供最新的个人资料。</li>

				<li>经本公司发现会员有重复申请账号行为时，有权将这些账户视为一个联合账户。我们保留取消、收回会员所有优惠红利，以及优惠红利所产生的盈利之权利。每位玩家、每一住址、每一电子邮箱、每一电话号码、相同支付卡/信用卡号码，以及共享计算机环境 (例如:网吧、其他公共用计算机等)只能够拥有一个会员账号，各项优惠只适用于每位客户在本公司唯一的账户。</li>

				<li>本公司是提供互联网投注服务的机构。请会员在注册前参考当地政府的法律，在博彩不被允许的地区，如有会员在本公司注册、下注，为会员个人行为，本公司不负责、承担任何相关责任。</li>

				<li>无论是个人或是团体，如有任何威胁、滥用本公司优惠的行为，本公司保留杈利取消、收回由优惠产生的红利，并保留权利追讨最高50%手续费。</li>

				<li>所有本公司的优惠是特别为玩家而设，在玩家注册信息有争议时，为确保双方利益、杜绝身份盗用行为，本公司保留权利要求客户向我们提供充足有效的文件， 并以各种方式辨别客户是否符合资格享有我们的任何优惠。</li>

				<li>客户一经注册开户，将被视为接受所有颁布在本公司网站上的规则与条例。 </li>

			</ul>

			<p style="color:#FF0000;">本公司若发现您在同系统的俱樂部上开设多个会员账户，并进行套利下注；本公司有权取消您的会员账号并将所有下注营利取消！ </p>

		</div>
	</div>
							<include file="/Template/Mobile/agreement.php" />-->
<script>
	$('.uclose').click(function(){
		$('#xy').hide();
		$("#J_regModal").show();
	})
	function check_form(obj) {
       $.ajax({
		   url : "{:U('Public/register')}",
		   type : 'POST',
		   data : $(".form-horizontal").serialize(),
		   success : function (data) {
			   if(data.sign==true){
				   alert("恭喜你!注册成功");
				   window.location.href= "{:U('Index/index')}"
			   }else{
				   alert(data.message);
			   }
		   }
	   })
		return false;
	}
</script>