<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<style>
	body{
		background-color: #fff;
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
	
	<div class="bank_recharge">
		<form action="{:U('Member/setproblem')}" method="post" class="am-form">
			<input type="hidden" id="questoken" value="{$Think.get.questoken}">
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">问题一</span>
					<div class="am-form-group bank_right_select am-fr">
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
						<span class="am-form-caret"></span>
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">答案</span>
					<div class="am-fr bank_right_input">
						<input type="text"  name="answer_one" id="answerOne"  class="input_txt" placeholder="请输入答案">
					</div>
				</li>
			</ul>

			<ul class="bank_form_list margin_t0">
				<li class="am-cf">
					<span class="bank_form_left am-fl">问题二</span>
					<div class="am-form-group bank_right_select am-fr">
						<select id="questionTwo" onchange="changeQuestionTwo();" id="doc-select-1" class="form-control">
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
						<span class="am-form-caret"></span>
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">答案</span>
					<div class="am-fr bank_right_input">
						<input type="text"   name="answer_two" id="answerTwo" class="input_txt" placeholder="请输入答案">
					</div>
				</li>
			</ul>

			<ul class="bank_form_list margin_t0">
				<li class="am-cf">
					<span class="bank_form_left am-fl">问题三</span>
					<div class="am-form-group bank_right_select am-fr">
						<select id="questionThree" onchange="changeQuestionThree();" id="doc-select-1"  class="form-control">
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
						<span class="am-form-caret"></span>
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">答案</span>
					<div class="am-fr bank_right_input">
						<input type="text" name="answer_three" id="answerThree" class="input_txt" placeholder="请输入答案">
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">资金密码：</span>
					<div class="am-fr bank_right_input">
						<input   type="password" id="tradePwd" class="input_txt" placeholder="请输入资金密码">
					</div>
				</li>
			</ul>
			<button class="am-btn am-btn-danger am-radius am-btn-block"  type="button" onclick="usersecurity();">确定</button>
		</form>	
	</div>
	<include file="Public/footer" />
	<script>
		//设置密保
		var usersecurity = function(){
			var url =    '__ROOT__/Apijiekou.' + 'usersecurity';

			var v = $("#questionOne").val();
			var v2 = $("#questionTwo").val();
			var v3 = $("#questionThree").val();
			var answerOne = $("#answerOne").val();
			var answerTwo = $("#answerTwo").val();
			var answerThree = $("#answerThree").val();
			var tradePwd = $("#tradePwd").val();
			if (v.length < 1) {
				alert('请选择密保问题1！');
				return false;
			}
			if (v2.length < 1) {
				alert('请选择密保问题2！');
				return false;
			}
			if (v3.length < 1) {
				alert('请选择密保问题3！');
				return false;
			}
			if (v == v2 || v == v3 || v2 == v3) {
				alert('密码问题不能重复！');
				return false;
			}
			if (answerOne.length < 1) {
				alert('问题1答案不能为空！');
				return false;
			}
			if (answerTwo.length < 1) {
				alert('问题2答案不能为空！');
				return false;
			}
			if (answerThree.length < 1) {
				alert('问题3答案不能为空！');
				return false;
			}
			if (answerOne == answerTwo || answerOne == answerThree || answerTwo == answerThree) {
				alert('密保答案不能相同！');
				return false;
			}
			if (tradePwd.length < 6) {
				alert('密码格式不正确！');
				return false;
			}
			$.post(
				url,
				{
					"questionOne": v,
					"answerOne": answerOne,
					"questionTwo": v2,
					"answerTwo": answerTwo,
					"questionThree": v3,
					"answerThree": answerThree,
					"tradePwd": tradePwd,
					"questoken":$("#questoken").val()
				}
				, function(json){
					if(json.sign){
						$("#isQuestion").removeClass('wb').addClass('yb');
						$("#isQuestion").find('.mark').removeAttr('onclick').attr('onclick','userseditecurity()').css({'color':'grey'}).text('修改密保');
						alert('密保设置成功',1);
						window.location.href = "{:U('Member/index')}" ;
						/*					way.set("editquestion.questionone",v);
						 way.set("editquestion.questiontwo",v2);
						 way.set("editquestion.questionthree",v3);
						 getuserlevel();*/
					}else{
						alert(json.message,-1);
					}
				},'json');

			/*		},
			 lock:true
			 });*/
		}
		var changeQuestionOne = function() {
			var v = $("#questionOne").val();
			var v2 = $("#questionTwo").val();
			var v3 = $("#questionTwo").val();
			var option2 = $("#questionTwo").find('option');
			var option3 = $("#questionThree").find('option');
			var i;
			for (i = 0; i < option2.length; i++) {
				if (option2.eq(i).val() == v || option2.eq(i).val() == v2) {
					option2.eq(i).css("display", "none");
				} else {
					option2.eq(i).css("display", "block");
				}
			}
			for (i = 0; i < option3.length; i++) {
				if (option3.eq(i).val() == v || option2.eq(i).val() == v3) {
					option3.eq(i).css("display", "none");
				} else {
					option3.eq(i).css("display", "block");
				}
			}
		};
		var changeQuestionTwo = function() {
			var v = $("#questionOne").val();
			var v2 = $("#questionTwo").val();
			var v3 = $("#questionTwo").val();
			var option1 = $("#questionOne").find('option');
			var option3 = $("#questionThree").find('option');
			var i;
			for (i = 0; i < option1.length; i++) {
				if (option1.eq(i).val() == v2 || option1.eq(i).val() == v3) {
					option1.eq(i).css("display", "none");
				} else {
					option1.eq(i).css("display", "block");
				}
			}
			for (i = 0; i < option3.length; i++) {
				if (option3.eq(i).val() == v2 || option1.eq(i).val() == v) {
					option3.eq(i).css("display", "none");
				} else {
					option3.eq(i).css("display", "block");
				}
			}
		};
		var changeQuestionThree = function() {
			var v = $("#questionOne").val();
			var v2 = $("#questionTwo").val();
			var v3 = $("#questionThree").val();
			var option1 = $("#questionOne").find('option');
			var option2 = $("#questionTwo").find('option');
			var i;
			for (i = 0; i < option1.length; i++) {
				if (option1.eq(i).val() == v2 || option1.eq(i).val() == v3) {
					option1.eq(i).css("display", "none");
				} else {
					option1.eq(i).css("display", "block");
				}
			}
			for (i = 0; i < option2.length; i++) {
				if (option2.eq(i).val() == v || option1.eq(i).val() == v3) {
					option2.eq(i).css("display", "none");
				} else {
					option2.eq(i).css("display", "block");
				}
			}
		};

	</script>
</body>
</html>