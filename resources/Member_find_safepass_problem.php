<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>幸运彩</title>
	<meta name="keywords" content="关键字">
	<meta name="description" content="网站主要内容">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >

	<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
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
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="update_pass">
	<div class="container-fluid">
		<ul class="queue">
			<li class="now">
				<span>找回资金密码</span>
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
					<span class="mark">请输入密保答案进行验证，通过后即可重置资金密码！</span>
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
			<button class="btn common_btn save_pass" type="button" onclick="findsafepassproblem();">提交</button>
		</form>
	</div>
</div>
<include file="Public/footer" />
<script>
	var findsafepassproblem = function(){
		var url = apirooturl + 'questionanscheck';
		var editquestionans1 = $("#editquestionans1").val();
		var editquestionans2 = $("#editquestionans2").val();
		var editquestionans3 = $("#editquestionans3").val();
		if (editquestionans1.length < 1) {
			alt('问题1答案不能为空！');
			return false;
		}
		if (editquestionans2.length < 1) {
			alt('问题2答案不能为空！');
			return false;
		}
		if (editquestionans3.length < 1) {
			alt('问题3答案不能为空！');
			return false;
		}
		$.post(url,{"editquestionans1": editquestionans1,"editquestionans2": editquestionans2,"editquestionans3": editquestionans3}, function(json){
			if(json.sign){
				$("#questoken").val(json.questoken);
				// usersecurity();
				// art.dialog.list['testID2'].title('重置密保');
				alt('验证成功');
				window.location.href = "{:U('Member/safepass2')}";
				return false;
			}else{
				alt(json.message,-1);
				return false;
			}
			return false;
		},'json');
	}
	var changeeditquestion = function(){
		var url = apirooturl + 'changeeditquestion';
		$.getJSON(url, function(json){
			if(json.sign==true){
				way.set("editquestion", json.question);
			}else{

			};
		});
	}
	changeeditquestion();
</script>

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