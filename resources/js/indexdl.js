$(document).ready(function() {
	$(".inner").slide({
		mainCell: ".bd ul",
		autoPage: true,
		effect: "topMarquee",
		autoPlay: true,
		trigger: "click",
		interTime: 70,
		vis: 8
	});
	$(window).scroll(function() {
		$(".sInner").stop();
		var winH = $(window).height();
		var s = $(document).scrollTop();
		var h = $(".sInner").height();
		var x = (winH - h) / 2;
		x = (x > 0) ? x : 0;
		var tt = x + s;
		$(".sInner").animate({
			top: tt
		}, 500);
	}).trigger('scroll');
	$('.wei').click(function() {
		$(this).children('.img').toggle();
	});
	$('.sInner .close a').click(function() {
		$(this).parents('.sInner').hide();
		return false;
	})

	//
	function parseFormatNum(number, n) {
		if(n != 0) {
			n = (n > 0 && n <= 20) ? n : 2;
		}
		number = parseFloat((number + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
		var sub_val = number.split(".")[0].split("").reverse();
		var sub_xs = number.split(".")[1];

		var show_html = "";
		for(i = 0; i < sub_val.length; i++) {
			show_html += sub_val[i] + ((i + 1) % 3 == 0 && (i + 1) != sub_val.length ? "," : "");
		}

		if(n == 0) {
			return show_html.split("").reverse().join("");
		} else {
			return show_html.split("").reverse().join("") + "." + sub_xs;
		}
	}

	var num = 80860 + Math.random() * 11;

	function ranNum() {
		var addNum = Math.random() * 10 ;
		num = num + addNum;
		$('#i1').text(parseFormatNum(num, 0));
	}

	//
	$('#i1').text(parseFormatNum(num, 0));
	setInterval(ranNum, 1000);
	
	
	//wap跳转
	uaredirect("wap/index.html");
});

//---------------代理结算模式切换   日  周  月
$(function(){
	$('#tit div').click(function() {
		var i = $(this).index(); //下标第一种写法
		//var i = $('tit').index(this);//下标第二种写法
		$(this).addClass('select').siblings().removeClass('select');
		$('#con li').eq(i).show().siblings().hide();
	});
})