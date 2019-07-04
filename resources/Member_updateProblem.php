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
	<link rel="stylesheet" href="__CSS2__/updatePass.css">
	<link rel="stylesheet" href="__CSS2__/footer.css">
	<link rel="stylesheet" href="__JS2__/layer/skin/default/layer.css">
	<link rel="stylesheet" href="http://at.alicdn.com/t/font_bnvu6xzx1198uxr.css">
</head>
<body>
<style>
	.validate-form dd,.validate-form dt{
		padding-bottom: 15px;
	}
	.validate-form .tt{
		width: 100px;
		font-size: 12px;
		padding-right: 20px;
		text-align: right;
		display: inline-block;
	}
	.validate-form .mark{
		
	}
	.validate-form .inp-sty-1{
		height: 30px;
		border: 1px solid #ccc;
		width: 234px;
		padding: 6px 15px;
		display: inline-block;
	}
</style>
<include file="Public/header" />
<script>
	var  UPDATEPROBLEM = "{:U('Member/setProblem')}";
</script>
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/ucenter.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
	<div class="update_pass">
	<div class="container-fluid">
		<ul class="queue">
			<li class="now">
				<span>修改密保问题</span>
				<i class=" iconfont"></i>
			</li>
			<li class="">
				<span>完成</span>
				<i class="iconfont"></i>
			</li>
		</ul>
		<form action="{:U('Member/setproblem')}" method="post" class="update_form">
			<input type="hidden" id="questoken" value="0">
			<dl class="validate-form">
				<dt>
					<span class="tt">提示：</span>
					<span class="mark">请输入密保答案进行验证，通过后即可修改密保！</span>
				</dt>
				<dd>
					<span class="tt">问题1：</span>
					<span way-data="editquestion.questionone"></span>
				</dd>
				<dd>
					<span class="tt">答案：</span>
					<span><input class="inp-sty-1" id="editquestionans1" type="text" name="" value=""></span>
				</dd>
				<dd>
					<span class="tt">问题2：</span>
					<span way-data="editquestion.questiontwo"></span>
				</dd>
				<dd>
					<span class="tt">答案：</span>
					<span><input class="inp-sty-1" type="text" id="editquestionans2" name="" value=""></span>
				</dd>
				<dd>
					<span class="tt">问题3：</span>
					<span way-data="editquestion.questionthree"></span>
				</dd>
				<dd>
					<span class="tt">答案：</span>
					<span><input class="inp-sty-1" type="text" id="editquestionans3" name="" value=""></span>
				</dd>
			</dl>
			<button class="btn common_btn save_pass" type="button" onclick="userseditecurity();">提交</button>
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