<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/userHome.css">
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			公告
		</font></h1>
</div>
	
	<div class="noticeContent">
		<div class="noticeContent_t">
			<h2>{$ggshow.title}</h2>
			<p>{$ggshow.oddtime|date="Y-m-d",###}</p>
		</div>
		<hr />
		<div class="noticeContent_bd">
			{$ggshow.content}
		</div>
	</div>
	<include file="Public/footer" />
</body>
</html>