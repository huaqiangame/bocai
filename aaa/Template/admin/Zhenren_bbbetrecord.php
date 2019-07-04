{include file="Public/meta" /}
<meta http-equiv="refresh" content="180">
</head>
<body>
获取<span class="nums">0</span>条BBIN投注记录,每3分钟自动获取一次 <button onclick="getData()" style="padding:5px 10px">刷新</button>
{include file="Public/footer" /}
<script>
function getData(){
	$.post("{:U('getBbrecord')}",'',function(data){
			if(data.code==1){
				var nums=data.nums;
				$(".nums").html(nums);
			}
	});
}
$(function(){
	getData();
	//setTimeout("getData()",'180000');
});

</script>
</body>
</html>