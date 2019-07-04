<script>
	var WebConfigs = {
		"ROOT" : "__ROOT__",
		'IMG' : "__IMG__"
	}
</script>
<script src="__JS__/zepto.js"></script>
<script type="text/javascript" src="__JS__/sm.js"></script>
<!--<script type="text/javascript" src="__JS__/common.js"></script>-->
<script type="text/javascript" src="__JS__/way.min.js"></script>

<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
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
		<form action="" class="am-form" action="{:U('Member/setproblem')}">
			<p style="padding: 10px;">
				<span class="tt">提示：</span>
				<span class="mark">请输入密保答案验证，通过后重置资金密码！</span>
			</p>
			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">问题一</span>
					<div class="am-form-group bank_right_select am-fr">
						<span way-data="editquestion.questionone"></span>
						<span class="am-form-caret"></span>
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">答案</span>
					<div class="am-fr bank_right_input">
						<input type="text" id="editquestionans1" class="input_txt" placeholder="请输入答案">
					</div>
				</li>
			</ul>

			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">问题二</span>
					<div class="am-form-group bank_right_select am-fr">
						<span way-data="editquestion.questiontwo"></span>
						<span class="am-form-caret"></span>
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">答案</span>
					<div class="am-fr bank_right_input">
						<input type="text" id="editquestionans2" class="input_txt" placeholder="请输入答案">
					</div>
				</li>
			</ul>

			<ul class="bank_form_list">
				<li class="am-cf">
					<span class="bank_form_left am-fl">问题三</span>
					<div class="am-form-group bank_right_select am-fr">
						<span way-data="editquestion.questionthree"></span>
						<span class="am-form-caret"></span>
					</div>
				</li>
				<li class="am-cf">
					<span class="bank_form_left am-fl">答案</span>
					<div class="am-fr bank_right_input">
						<input type="text" id="editquestionans3" class="input_txt" placeholder="请输入答案">
					</div>
				</li>
			</ul>

			<button class="am-btn am-btn-danger am-radius am-btn-block" onclick="findsafepassproblem();" type="button">确定</button>
		</form>
	</div>
	<include file="Public/footer" />
	<script>
		var host = WebConfigs['ROOT'] ;
		var apirooturl = host + '/Apijiekou.';
		var findsafepassproblem = function(){
			var url = apirooturl + 'questionanscheck';
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
					window.location.href = "{:U('Member/safepass2')}";
					return false;
				}else{
					alert(json.message,-1);
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
</body>
</html>