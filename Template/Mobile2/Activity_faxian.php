<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/activity.css">
<body>
	<header data-am-widget="header"class="am-header am-header-default header nav_bg am-header-fixed">
		<h1 class="am-header-title activity_h1">
			发现
		</h1>
	</header>
	
	<div class="activity_list">

	</div>
<script>
$(function(){
	var 蛤蛤看到这里不要骂人 = 'QQ408214421';
	var cp = ["河南快3", "山东快3", "腾讯60秒彩", "腾讯分分彩", "重庆时时彩", "江苏快3", "大富快3", "幸运快3", "北京PK10", "幸运PK10", "大富快乐8", "北京快乐8", "江西11选5", "大富11选5", "福彩3D", "幸运3D", "香港六合彩", "澳门六合彩", "广西快3", "湖北快3", "排列三", "江西快3", "吉林快3", "河北快3", "天津时时彩", "新疆时时彩", "上海快3", "安徽快3", "广东11选5", "上海11选5", "北京快3"]
	var abc = ['q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m'];

	caonimabi = function(){
		var fuck = cp[RandomNum(0,cp.length)];
		var shit = abc[RandomNum(0,24)] + abc[RandomNum(0,24)];
		var motherfucker = RandomNum(0,9) + '' +RandomNum(0,9);
		var fuckmoney = RandomNum(1,99)+ '.' +RandomNum(0,9)+ '' +RandomNum(0,9);
		var head = RandomNum(0,9) + '' +RandomNum(0,9)+ '' +RandomNum(0,9)+ '' +RandomNum(0,9)+ '' +RandomNum(0,9)+ '' +RandomNum(0,9)+ '' +RandomNum(0,9)+ '' +RandomNum(0,9)+ '' +RandomNum(0,9);
		
		html = '<a href="#" class="am-cf am-block">'+
				'<img class="activity_list1 am-fl bg_green" src="//q1.qlogo.cn/g?b=qq&amp;nk='+head+'&amp;s=100">'+
				'<div class="activity_list2 am-fl">'+
				'	<p><font color="blue">'+shit+'*****'+motherfucker+'</font> 在 <font color="red">'+fuck+'</font></p>'+
				'	<em>喜中 <font color="red">￥'+fuckmoney+'</font></em>'+
				'</div>'+
				'<div class="activity_list3 am-fr">'+
				'	<i class="iconfont icon-arrowright"></i>'+
				'</div>'+
			'</a>';
		
		$('.activity_list').prepend(html)
		
	}
	

	setInterval(caonimabi,2000);

	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();
	caonimabi();

	function RandomNum(Min, Max) {
		  var Range = Max - Min;
		  var Rand = Math.random();
		  if(Math.round(Rand * Range)==0){
			return Min + 1;
		  }else if(Math.round(Rand * Max)==Max)
		  {
			return Max - 1;
		  }else{
			var num = Min + Math.round(Rand * Range) - 1;
			return num;
		  }
	}
});
</script>


	<include file="Public/footer" />
</body>
</html>