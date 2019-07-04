require.config({
	paths : {
		'jquery' : 'jquery-3.1.1.min',
	},
	shim : {
		'zclip' : ['jquery'],
	}
})
require(['jquery'],function ($){
	$(function () {
		//修改头像
		$('.update_header').click(function (){
			$('.header_img_box').modal();
		})
		$('.head_img_list').find('a').click(function (){
			var title = $(this).attr('title')
			var img_name = $(this).attr('attr-url');
			var img_url = Webconfigs['IMG']+'/'+img_name;
 			$('.preview_img').attr('src',img_url);
			$('.header_preview_name').text(title);
		})
		//头像保存修改input——value
		$('.saveface').click(function (){
			var header_url = $('.update_header_img').prop('src');
			$('.faceimg').attr('src',header_url);
			$('.faceinput').attr('value',header_url);
		})

	
	})
})