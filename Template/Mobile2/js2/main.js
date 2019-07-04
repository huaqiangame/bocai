require.config({
	paths : {
		'jquery' : 'jquery-3.1.1.min',
		'amazeui' : 'amazeui.min',
		'thouch' : 'thouch',
		'ycommon' : 'ycommon',
		'icon' : 'icon',
		'zclip' : 'jquery.zclip.min',
		'area' : 'area',
		'way' : 'way.min'
	},
	shim : {
		'zclip' : ['jquery']
	}
})
require(['jquery','amazeui','thouch','ycommon','icon','zclip','area','way'],function (jquery,amazeui,thouch,commonObj,icon,zclip,area,way){
	$(function (){
		//中奖滚动
		var winners_time = setInterval("commonObj.winningScroll($('.winners_newest'))",3000);
		$('.winners_tab').children('em').click(function (){

			commonObj.tabSwitch($(this),'em','.winners_info');
			commonObj.tabSwitch($(this),'em','.am-tabs');
			commonObj.tabSwitch($(this),'em','.personalInfo');

			if($(this).attr('data-title') == true){
				clearInterval(winners_time);
			}else{
				winners_time = setInterval("commonObj.winningScroll($('.winners_newest'))",3000);
			}
		})
		//刷新余额
		var refresh_index = 0;
		$('.my_home_refresh').click(function (){
			refresh_index++;
			var sum = refresh_index * 360 ;
			$(this).css('transform','rotate('+sum+'deg)');
		});
		//显示余额
		$('.show_money_btn').click(function (){
			$('.hide_text').hide();
			$(this).hide();
			$('.show_money , .my_home_refresh').show();
			$('.show_money').show();
		})
		//隐藏余额
		$('.hide_money').click(function () {
			$('.show_money').hide();
			$('.show_money_btn').show();
			$('.hide_text').show();
			$('.show_money , .my_home_refresh').hide();
		})
		//复制
		$(".copu_btn").zclip({
			path: "/xk3/resources/js2/swf/ZeroClipboard.swf",
			copy: function(){
				return $(this).siblings('.copy_txt').val();
			},
			afterCopy:function(){/* 复制成功后的操作 */
				var $copysuc = $("<div class='copy-tips'><div class='copy-tips-wrap'>☺ 复制成功</div></div>");
				$("body").find(".copy-tips").remove().end().append($copysuc);
				$(".copy-tips").fadeOut(3000);
	        }
		});
		//选择提现的银行卡
		$('.selected_bank').click(function (){
			$('.bank_list_box').show();
		})
		$('.bank_list_box').children('.bank_list').click(function (){
			var icon = $(this).attr('data-bank-icon');
			var bank_name = $(this).attr('data-bank-name');
			var bank_sum = $(this).attr('data-bank-sum');

			$(this).parent().hide();
			$(this).find('input[name="bid"]').prop('checked',true);
			$(this).siblings('.bank_list').find('input[name="bid"]').prop('checked',false);

			$('.selected_bank').find('img').attr('src',icon);
			$('.selected_bank').find('.bank-name').text(bank_name);
			$('.selected_bank').find('.bank-sum').text(bank_sum);
		})
		$('.selected_bank').find('use').attr('xlink:href')
		//交易记录天数切换
		$('.billrecord_day').find('.am-modal-actions-header').click(function (){
			$('.billrecord_day').modal('close');
			var index = $(this).index();
			if(index == 0){
				$('.bill_day').text('今天');
			}else if(index == 1){
				$('.bill_day').text('昨天');
			}else if(index == 2){
				$('.bill_day').text('七天');
			}
		})
		//初始化时间组件
		$('.am-datepicker-add-on').datepicker();

		// var imgs_index = 0;
		// $('.update_header').find('.next').click(function (){
			
		// 	var widths = $('.update_header_imgs').find('img').outerWidth(true);
		// 	var slength = $('.update_header_imgs').find('img').length - 4;

		// 	if(slength <= imgs_index){
		// 		alert('最后一个了');
		// 	}else{
		// 		imgs_index++;
		// 		$('.update_header_imgs').stop(true,false).animate({'left':-widths*imgs_index},500);
		// 	}
		// })
		// $('.update_header').find('.prev').click(function (){

		// 	var widths = $('.update_header_imgs').find('img').outerWidth(true);
		// 	var slength = $('.update_header_imgs').find('img').length - 4;

		// 	if(imgs_index <= 0){
		// 		alert('最前一个了');
		// 	}else{
		// 		imgs_index--;
		// 		$('.update_header_imgs').stop(true,false).animate({'left':-widths*imgs_index},500);
		// 		console.log(imgs_index)
		// 	}
		// })

		//修改头像
		$('#update_header_imgs').find('img').click(function (){
			var url = $(this).attr('src');
			var name = $(this).attr('alt');
			$('.update_header').find('.update_header_img').attr('src',url);
			$('.update_header').find('.update_header_name').text(name);
		}) 
		$('.update_header').find('.save').click(function (){
			var url = $('.update_header').find('.update_header_img').attr('src');
			urls = url.replace('/XK3','');
			$('.personalInfo_header').attr('src',url);
			$('.faceinput').val(urls);
		})
		//城市联动
		var pro = document.getElementById('s_province');
		if(pro){
			_init_area();
		}

		commonObj.isMenuActive();
		
		//快捷支付
		$('.collectBank_ra').click(function (){
			$(this).addClass('checked').siblings('.collectBank_ra')
				.removeClass('checked').find('.r_right').hide();
			$(this).find('.r_right').show();
			$(this).find('input[type="radio"]').prop('checked',true);
			$(this).siblings('.collectBank_ra').find('input[type="radio"]').prop('checked',false);
		})

		//快捷支付
		// $('#onlineBankUrl').click(function () {
		// 	payonlineBank();
		// })
	

	
	})
})
/* 嘻嘻 */
console.log(
	"%cBy.Remilia %cQQ:911344487 \n\n%c你好，我叫Remilia，一名全栈开发工程师。\n你也在做菠菜维护吗？欢迎加我的QQ互相交流~\n//remilia.cc/\n\n%c写于 2018-08-13",
	'font-family: "微软雅黑", sans-serif;font-size:50px;color: #ff75a4;-webkit-text-fill-color: #ff75a4;-webkit-text-stroke: #ff75a4;text-shadow: 0px 0px 7px rgba(0, 0, 0, 0.3)',
	"font-family: '微软雅黑';color: #9C27B0;font-size:  20px;",
	"font-family: '微软雅黑';color: #9568ff;font-size: 17px;",
	"color: red;font-size: 14px;"
);
// Remilia 是最萌哒！ //remilia.cc
// Remilia 是最萌哒！ //remilia.cc
// Remilia 是最萌哒！ //remilia.cc
/* ----------------------------------------------------------------------- */