var Timerr;
function isIE() { //ie?
	if (!!window.ActiveXObject || "ActiveXObject" in window)
		return true;
	else if (/iphone|ipad|ipod|safari/.test(navigator.userAgent.toLowerCase())) {
		return true;		
	} 
	return false;
}

function ajaxLottery(){alert(111);
	$.ajax({
		url: './ajax.php?act=lottery',
		dataType: 'json',
		cache: false,
		type: 'GET',
		success: function (obj) {  
			switch(obj.stat){
				case '-404':
					$('.banner').snowfall('clear');
					clearInterval(Timerr);
					setEnd();
				
					break;
				case '-1':
					//下一波倒计时
					$('.banner').snowfall('clear');
					clearInterval(Timerr);
					if (isIE()) {
						var c_time = obj.c_time.replace(/-/g,'/');
						var start_time = obj.start_time.replace(/-/g,'/');
					} else {
						var c_time = obj.c_time;
						var start_time = obj.start_time;
					}
					
					NowTimeOld = new Date(c_time);
					startDateTime =  new Date(start_time);
					one = setInterval(getRTimeOne,1000);
					
					break;
				case '0':
					//抽奖动画
					if (isIE()) {
						var c_time = obj.c_time.replace(/-/g,'/');
						var end_time = obj.end_time.replace(/-/g,'/');
					} else {
						var c_time = obj.c_time;
						var end_time = obj.end_time;
					}
					
					NowTimeOld = new Date(c_time);
					waveTime =  new Date(end_time);
					two = setInterval(getRTimeTwo,1000);
					
					$('.banner').snowfall('clear');
					$('.banner').snowfall({
							image: "./images/hongbao.png",
							flakeCount:25,
							minSize: 50,
							maxSize: 100
					});
					$('.snowfall-flakes').on('click',function(){
						showGetWin();
					});
					
					break;
				default:
					break;
				
			}
      
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			var x = 1;
    
		}
	}) ;
};
// 显示查询窗口
function showQueryWin() {
	$('#querywin').fadeIn();
}
// 关闭查询窗口
function closeQueryWin() {
	$('#querywin').fadeOut();
}
// 显示领取窗口
function showGetWin() {
	if ($.trim($('#username').val()) !== '') {
		getPacket();
	} else {
		$('#getWin').fadeIn();
	}
}
// 关闭领取窗口
function closeGetWin() {
	$('#getWin').fadeOut();
}
function closeGetWin02(){
	var username = $.trim($('#username').val());
	if (username == '') {
		alert('请输入会员名！');
		return false;
	}else{
		$.ajax({
			url: './ajax.php?act=getpacket',
			dataType: 'json',
			data: {username:username},
			cache: false,
			type: 'GET',
			beforeSend: function () {
				// 禁用按钮防止重复提交
				$('#QueDing').css("opacity","0");
			},
			success: function (obj) {
				if (obj.stat == '1' || obj.stat == '0') {
					alert(obj.msg);
					closeGetWin();
				} else {
					alert('系统忙，请稍后再试！');
				}
			},
			complete: function () {
				$('#QueDing').css("opacity","1");
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert('系统忙，请稍后再试！');
			}
		});
	}
}
	
// 获取红包
function getPacket() {
	
	var username = $.trim($('#username').val());
	if (username == '') {
		alert('请输入会员名！');
		return false;
	}
	$.ajax({
		url: './ajax.php?act=getpacket',
		dataType: 'json',
		data: {username:username},
		cache: false,
		type: 'GET',
		success: function (obj) {
			console.log(obj);
			if (obj.stat == '1' || obj.stat == '0') {
				alert(obj.msg);
				closeGetWin();
			} else {
				alert('系统忙，请稍后再试！');
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert('系统忙，请稍后再试！');
		}
	});
}
// 查询
function query() {
	var username = $.trim($('#username-query').val());
	if (username == '') {
		alert('请输入会员名！');
		return false;
	}
	$.ajax({
		url: './ajax.php?act=query',
		dataType: 'html',
		data: {username:username},
		cache: false,
		type: 'GET',
		success: function (html) {  
			$('#query-result').html(html);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert('系统忙，请稍后再试！');
		}
	}) ;
}

// 加载公告
function loadAnnounce(callback) {
	$('#announce').load('./ajax.php?act=announce', '', function () {
		callback();
	});
}