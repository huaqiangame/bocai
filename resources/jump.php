<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{$msgTitle}</title>
<style type="text/css">
body {
	background:url(__PUBLIC__/{:MODULE_NAME}/images/weibo_bg.jpg);
}
.info {
	border-radius: 20px;
	width:800px;
	height:180px;
	padding:100px 0 100px 10px;
	background:#fafafa;
	margin:100px auto;
	text-align:center;
}
.text {
	display:inline-block;
	height:38px;
	font-size:32px;
	font-weight:bold;
	color:#666;
	text-indent:45px;
}
.success {
	background:url(__PUBLIC__/{:MODULE_NAME}/images/jump_success.png) no-repeat;
}
.error {
	background:url(__PUBLIC__/{:MODULE_NAME}/images/jump_error.png) no-repeat;
}
.error tt{
	text-indent:0;
	margin:-70px auto 0 50px;
	text-align:left;
	float:left;
}
.jump {
	color:#666;
	padding:55px 15px 0 0;
	text-align:right;
}
a {
	color:#06f;
	text-decoration:none;
}
a:hover {
	color:#f60;
}
</style>
</head>
<body>
<?php
 if($status){
?>
  <div class='info'>
     <span class="text success">{$message}</span>
	 <p class="jump">页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></p>
  </div>
<?php
 }else{
?>
  <div class='info'>
	  <?php if(is_Array($error)){?>
	      <volist name="error" id="value">
           <span class="text error" style="width:60%;text-align:left;height:45px;">{$value}</span><br/>
		  </volist>
	  <?php
	  }else{
	  ?>
	  <span class="text error">{$error}</span>
	  <?php
		 }
		?>
	 <p class="jump">页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo(3); ?></b></p>
  </div>
<?php
 }
?>
<script type="text/javascript">
(function(){
	var wait = document.getElementById('wait'),href = document.getElementById('href').href;
	var interval = setInterval(function(){
		var time = --wait.innerHTML;
		if(time <= 0) {
			location.href = href;
			clearInterval(interval);
		};
	}, 1000);
})();
</script>
</body>
</html>