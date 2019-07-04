<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>幸运彩</title>
	<meta name="keywords" content="关键字">
	<meta name="description" content="网站主要内容">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >

	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
	<link rel="stylesheet" href="__CSS2__/reset.css">
	<link rel="stylesheet" href="__CSS2__/icon.css">
	<link rel="stylesheet" href="__CSS2__/header.css">
	<link rel="stylesheet" href="__CSS2__/updatePass.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" href="__JS2__/layer/skin/default/layer.css">
	<link rel="stylesheet" href="http://at.alicdn.com/t/font_bnvu6xzx1198uxr.css">
</head>
<body>
<include file="Public/header" />
<script>
	var  MEMBER = "{:U('Member/index')}";

</script>
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/ucenter.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
	<div class="update_pass">
	<div class="container-fluid">
		<ul class="queue">
			<li class="now">
				<span>设置新密保问题</span>
				<i class=" iconfont"></i>
			</li>
			<li class="">
				<span>完成</span>
				<i class="iconfont"></i>
			</li>
		</ul>
		<form action="{:U('Member/setproblem')}" method="post" class="update_form">
			<input type="hidden" id="questoken" value="{$Think.get.questoken}">
			<div class="clearfix drop_menu">
				<div>
				<span class="">问题一：</span>
				<div class="form-group">
					<select id="questionOne"  onchange="changeQuestionOne(); "class="form-control">
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
				</div>
				</div>
				<div class="answer">
				<span>答案：</span>
				<input type="text" name="answer_one" id="answerOne" value="{$userinfo.answer_one}">
				</div>
			</div>
			<div class="clearfix drop_menu">
				<div>
				<span class="">问题二：</span>
				<div class="form-group">
					<select id="questionTwo" onchange="changeQuestionTwo();" class="form-control">
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
				</div>
				</div>
				<div class="answer">
				<span>答案：</span>
				<input type="text" name="answer_two" id="answerTwo" value="{$userinfo.answer_two}">
				</div>
			</div>
			<div class="clearfix drop_menu">
				<div>
				<span class="">问题三：</span>
				<div class="form-group">
					<select id="questionThree" onchange="changeQuestionThree();"  class="form-control">
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
				</div>
				</div>
				<div class="answer">
				<span>答案：</span>
				<input type="text" name="answer_three" id="answerThree" value="{$userinfo.answer_three}">
				</div>
				<div class="answer">
					<span class="tt">资金密码：</span>
					<span><input class="inp-sty-1" type="password" id="tradePwd" value=""></span>
				</div>
			</div>
			<button class="btn common_btn save_pass" type="button" onclick="usersecurity();">提交</button>
		</form>	
	</div>
	</div>
<include file="Public/footer" />
<!--
	<div class="modal fade update_pass_success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
	      </div>
	      <div class="modal-body">
	        密保设置成功
	      </div>
	      <div class="modal-footer">
	        <a href="securityCenter.html" class="btn common_btn">确定</a>
	      </div>
	    </div>
	  </div>
	</div>-->
</body>
</html>