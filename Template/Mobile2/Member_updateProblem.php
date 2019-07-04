<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<style>
	body{
		background-color: #fff;
	}
	.validate-form{
		margin: 0;
	}
	.tts{
		width: 0.6rem;
		display: inline-block;
		text-align: right;
	}
	dd{
		margin-bottom: 0.1rem;
		margin-left: 10%;
	}
	.save_pass{
		border: none;
		width: 100% !important;
	}
</style>
<body>
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>
		<h1 class="am-header-title userHome_h1">
			验证密保问题
		</h1>
	</header>
	
	<div class="bank_recharge" style="padding:15px;">
		<form action="{:U('Member/setproblem')}" method="post" class="update_form">
			<input type="hidden" id="questoken" value="0">
			<dl class="validate-form">
				<dt>
					<span class="tt">提示：</span>
					<span class="mark">请输入密保答案进行验证，通过后即可修改密保！</span>
				</dt>
				<dd>
					<span class="tt tts">问题1：</span>
					<span way-data="editquestion.questionone"></span>
				</dd>
				<dd>
					<span class="tt tts">答案：</span>
					<span><input class="inp-sty-1" id="editquestionans1" type="text" name="" value=""></span>
				</dd>
				<dd>
					<span class="tt tts">问题2：</span>
					<span way-data="editquestion.questiontwo"></span>
				</dd>
				<dd>
					<span class="tt tts">答案：</span>
					<span><input class="inp-sty-1" type="text" id="editquestionans2" name="" value=""></span>
				</dd>
				<dd>
					<span class="tt tts">问题3：</span>
					<span way-data="editquestion.questionthree"></span>
				</dd>
				<dd>
					<span class="tt tts">答案：</span>
					<span><input class="inp-sty-1" type="text" id="editquestionans3" name="" value=""></span>
				</dd>
			</dl>
			<button class="save_pass am-btn am-btn-primary" type="button" onclick="userseditecurity();">提交</button>
		</form>
	</div>
	<include file="Public/footer" />
	<script>
		var userseditecurity = function(){
			var url =    '__ROOT__/Apijiekou.' + 'questionanscheck';
			var editquestionans1 = $("#editquestionans1").val();
			var editquestionans2 = $("#editquestionans2").val();
			var editquestionans3 = $("#editquestionans3").val();
			if (editquestionans1.length < 1) {
				alert('问题1答案不能为空！');
				return false;
			}
			if (editquestionans2.length < 1) {
				alert('问题2答案不能为空！');
				return false;
			}
			if (editquestionans3.length < 1) {
				alert('问题3答案不能为空！');
				return false;
			}
			$.post(url,{"editquestionans1": editquestionans1,"editquestionans2": editquestionans2,"editquestionans3": editquestionans3}, function(json){
				if(json.sign){
					$("#questoken").val(json.questoken);
					// usersecurity();
					// art.dialog.list['testID2'].title('重置密保');
					alert('验证成功');
					window.location.href =  "__ROOT__/Member.setProblem.questoken." +json.questoken;
					return false;
				}else{
					alert(json.message,-1);
					return false;
				}
				return false;
			},'json');

			/*		},
			 lock:true
			 });*/
		}
	</script>
</body>
</html>