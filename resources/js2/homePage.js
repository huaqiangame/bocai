require.config({
	paths : {
		'jquery' : 'jquery-3.1.1.min',
		'bootstrap' : 'bootstrap.min',
		'commonObj' : 'ycommon',
		'layer' : 'layer/layer',
		'birthday' : 'birthday',
		'area' : 'area',
		'icon' : 'icon',
		'zclip' : 'jquery.zclip.min'
	},
	shim : {
		'bootstrap' : ['jquery'],
		'birthday' : ['jquery'],
		'zclip' : ['jquery'],
	}
})
require(['jquery','bootstrap','commonObj','layer','birthday','area','icon','zclip'],function ($,bs,commonObj,layer,birthday,area,icon,zclip){
	$(function () {
		//幻灯片初始化
		$('.carousel').carousel({
		  interval: 8000
		})
		$('.mobile_carousel').carousel({
		  interval: 3000
		})
		//开奖号码标签切换
		$('.tab_menu_box').find('li').click(function (){
			var index = $(this).index();
			$(this).addClass('active').siblings().removeClass('active');
			$('.tab_content_box').find('li').eq(index).show().siblings().hide();
		})
		//中奖信息scroll
		var myar = setInterval("commonObj.winningScroll('.ranking_scroll')",5000);
		$('.ranking_scroll').hover(function (){
			clearInterval(myar);
		},function () {
			myar = setInterval("commonObj.winningScroll('.ranking_scroll')",5000);
		})
		//风云榜榜
		$('.ranking_list_lotter').children('li').mouseenter(function (){
		
		})
		$('.ranking_list_lotter').children('li').mouseleave(function (){
			$('.ceng').remove();
		})
		//loottery遮罩层
		$('.content_list').find('.k3_project').hover(function (){
			$(this).find('.k3_beetting').show();
		},function () {
			$(this).find('.k3_beetting').hide();
		})
		//帮助显示
		$('.help').hover(function (){
			layer.tips('玩法说明', $(this),{
				tips : [4,'#bd2004'],
				time : 0,
				skin : 'layui_tips'
			});
		},function (){
			layer.closeAll("tips");
		})
		//个人信息和昨日奖金榜以及中奖信息的名片显示
		$("[data-toggle='popover']").popover({
        trigger: "hover",
        delay: {hide: 100}
	    }).on('shown.bs.popover', function (event) {
	        var that = this;
	        $('.popover').on('mouseenter', function () {
	            $(that).attr('in', true);
	        }).on('mouseleave', function () {
	            $(that).removeAttr('in');
	            $(that).popover('hide');
	        });
	    }).on('hide.bs.popover', function (event) {
	        if ($(this).attr('in')) {
	            event.preventDefault();
	        }
	    });
		//lottery菜单切换
		$('.content_nav').children('li').click(function () {
			var _index = $(this).index();
			$(this).addClass('active').siblings().removeClass('active');
			$('.content_list_box').children('.content_list').eq(_index).show()
				.siblings('.content_list').hide();
		})
/*		//帮助点击
		$('.help').click(function () {
			commonObj.openwindow('howtoplay.html','',1058,870);
		})*/
		//login
		$('.user_commom_style').find('input').blur(function (){
			if(!$(this).val()){
				$(this).siblings('em').show();
			}
		})
		$('.reset').click(function () {
			$('.user_commom_style').find('input').val('');
		})
		//是否勾选已满18岁
		$('.register').click(function () {
			var age = $('input[name="age"]');

			if(!age.is(':checked')){
				  $('.is_login_model').modal();
			}
		})
		//是否登录弹框
		//$('.magin_left_list').children('li').click(function () {
		//	$('.is_login_model').modal();
		//})
		//我的未读信息
		var timer = null;
		$('.user_info,.info_sum_box').mouseover(function (){
			if(timer){
				clearTimeout(timer);
			}
			$('.info_sum_box').show();
		})
		$('.user_info,.info_sum_box').mouseout(function (){
			timer = setTimeout(function (){
				$('.info_sum_box').hide();
			},300)
		})
		// 我的账户信息
		var timer1 = null;
		$('.my_account,.user_login_info2_list').mouseover(function (){
			if(timer1){
				clearTimeout(timer1);
			}
			$('.user_login_info2_list').show();
		})
		$('.my_account,.user_login_info2_list').mouseout(function (){
			timer1 = setTimeout(function (){
				$('.user_login_info2_list').hide();
			},300)
		})
		// 全部彩票
		var timer2 = null;
		$('.allLottery,.backLeftLottery').mouseover(function (){
			if(timer2){
				clearTimeout(timer2);
			}
			$('.backLeftLottery').show();
		})
		$('.allLottery,.backLeftLottery').mouseout(function (){
			timer2 = setTimeout(function (){
				$('.backLeftLottery').hide();
			},300)
		})
		//余额切换
		$('.hide_money_btn').click(function () {
			$('.show_money').hide();
			$('.hide_money').show();
		})
		$('.show_money_btn').click(function () {
			$('.show_money').show();
			$('.hide_money').hide();
		})
		//余额刷新
		var index  = 0;
		$('.refresh_money').click(function () {
			index++;
			var sum = index*360;
			$(this).css('transform','rotate('+sum+'deg)');
		})
		//个人信息性别选项
		$('.sex_box').find('input[checked="checked"]').parent().addClass('sur');
		$('.sex_box').click(function (){
			$(this).addClass('sur').siblings().removeClass('sur');
			$(this).siblings().find('input[name="sex"]').prop('checked',false);
			$(this).find('input[name="sex"]').prop('checked',true);
		})
		//生日选择器初始化
		$.ms_DatePicker({
	        YearSelector: ".sel_year",
	        MonthSelector: ".sel_month",
	        DaySelector: ".sel_day"
	    });
		$.ms_DatePicker();
		//个人信息内容切换
		$('.tab').children('li').click(function (){
			$(this).addClass('active').siblings().removeClass('active');
			$('.tab_content').children('div').eq($(this).index()).show()
				.siblings().hide();
		})
		//添加银行卡是否设置安全密码弹出
		$('.add_bankCard').click(function (){
			$('.is_set_security').modal();
		})
		//修改密码成功弹层
		$('.save_pass').click(function (){
			$('.update_pass_success').modal();
		})
		//投注时间和状态切换当前状态
		commonObj.tab('.bet_time','span');
		commonObj.tab('.bet_status','span');
		//修改头像
		$('.update_header').click(function (){
			$('.header_img_box').modal();
		})
		$('.head_img_list').find('a').click(function (){
			var title = $(this).attr('title')
			var img_name = $(this).attr('attr-url');
			var img_url = img_name;
 			$('.preview_img').attr('src',img_url);
			$('.header_preview_name').text(title);
		})
		//头像保存修改input——value
		$('.save_header_obj').click(function (){
			var header_url = $('.preview_img').prop('src');
			var upHeaderUrl = header_url.substring(header_url.indexOf('r') - 1);
			$('.up_header_img').attr('src',header_url);
			$('.up_header_img_input').attr('value',upHeaderUrl);
		})
		//我要提现银行卡选择
		$('.choice_bank').children('li').click(function (){
			var str_class = $('.select_bank').attr('class');
			var bank_posi = $(this).attr('data-bank');
			var last_sum = $(this).attr('data-num');

			$(this).find('input[name="bankid"]').prop('checked',true);
			$('.withdrawals_list').find('.last_sum').text(last_sum);

			commonObj.deleteCapital(str_class,'.select_bank');
			$('.select_bank').addClass(bank_posi);
			$('.choice_bank').hide();
		})
		$('.select_bank').click(function (){
			$('.choice_bank').show();
		})
		//城市二级联动初始化
		var pro = document.getElementById('s_province');
		if(pro){
			_init_area();
		}
		//快捷支付选择银行
		$('.collectBank_ra').click(function (){
			$(this).addClass('checked').siblings('.collectBank_ra')
				.removeClass('checked').find('.r_right').hide();
			$(this).find('.r_right').show();
			$(this).find('input[type="radio"]').prop('checked',true);
			$(this).siblings('.collectBank_ra').find('input[type="radio"]').prop('checked',false);
		})
		//充值页面复制
		$('.copy_text').click(function (variable){
			$(this).siblings('.collectBank_info').select().clone();
		})
		//交易记录的今天明天七天切换
		var url_atime = commonObj.getQueryVariable('atime');
		if(url_atime == '1'){
			$('#time-box').find('.bet_common_bor').eq(0).addClass('active').siblings('.bet_common_bor').removeClass('active');
			$('#atime').find('.bet_common_bor').eq(0).addClass('active').siblings('.bet_common_bor').removeClass('active');
		}else if(url_atime == '2'){
			$('#time-box').find('.bet_common_bor').eq(1).addClass('active').siblings('.bet_common_bor').removeClass('active');
			$('#atime').find('.bet_common_bor').eq(1).addClass('active').siblings('.bet_common_bor').removeClass('active');
		}else if(url_atime == '3'){
			$('#time-box').find('.bet_common_bor').eq(2).addClass('active').siblings('.bet_common_bor').removeClass('active');
			$('#atime').find('.bet_common_bor').eq(2).addClass('active').siblings('.bet_common_bor').removeClass('active');
		} 
		//复制
		$(".copy_text").zclip({
			path: "/resources/js2/swf/ZeroClipboard.swf",
			copy: function(){
				return $(this).siblings('.collectBank_info').text();
			},
			afterCopy:function(){/* 复制成功后的操作 */
				var $copysuc = $("<div class='copy-tips'><div class='copy-tips-wrap'>☺ 复制成功</div></div>");
				$("body").find(".copy-tips").remove().end().append($copysuc);
				$(".copy-tips").fadeOut(3000);
	        }
		});

		$('.help_left li').not('.title').on('click',function (){
			$(this).addClass('active').siblings('li').removeClass('active');
			$('.help_right .help_tab_content').eq($(this).index() - 1).show().siblings('.help_tab_content').hide();
		}).eq(0).click();
		//快三彩种拖动
		// var K3LiLength = $('.system_lottery').children('li').length;
		// var K3LiWidth = $('.system_lottery').children('li').outerWidth();
		// var sumRes = (K3LiWidth * K3LiLength) + 'px';
        // var system_lottery_index = 0;
		// $('.system_lottery').width(sumRes);
        // function K3Time() {
        //     setTimeout(function () {
        //         $('.y_is_last').fadeOut(2000);
        //     },500)
        // }

        // $('.system_lottery_box').find('.next').click(function () {
        //     if(K3LiLength - 9 <= system_lottery_index){
		// 		if($('.y_is_last').is(':hidden')){
		// 			$('.y_is_last').fadeIn(500).html('已经是最后一个了');
		// 		}
        //         K3Time();
        //     }else{
        //         system_lottery_index++;
        //         $('.system_lottery').stop(true,false).animate({'left':-K3LiWidth*system_lottery_index},500);
        //     }
        // })

        // $('.system_lottery_box').find('.prev').click(function () {
        //     if(system_lottery_index <= 0){
		// 		if($('.y_is_last').is(':hidden')){
		// 			$('.y_is_last').fadeIn(500).html('已经是最前一个了');
		// 		}
        //         K3Time();
        //     }else{
        //         system_lottery_index--;
        //         $('.system_lottery').stop(true,false).animate({'left':-K3LiWidth*system_lottery_index},500);
        //     }
        // })

		//关于我们
		var about = location.search;
				about = about.replace('?','');
		if(about){
			$('.title').find('h2').text(about);
		}
		

		$('.ytzcode').each(function (i){
			if($(this).text().length > 8){
				$(this).find('.ytzcodes').hide();
				$(this).append('查看').css('cursor','pointer');

				$(this).on('click',function () {
					var text = $(this).find('.ytzcodes').text();
					$('.ytz_model').find('.modal-body').text(text);
					$('.ytz_model').modal('show');
				})
			}
		})




	})
})