define(['jquery'],function (require){
	return commonObj = {
		winningScroll : function (obj) {
			var height = $(obj).find('li:first').outerHeight();
			var str = -height + 'px';
			var index = 0;

			$(obj).animate({'marginTop' : str},3000,function (){
				$(this).css('marginTop','0px').find('li:first').appendTo($(this));
			})
		},
		openwindow : function (url,name,iWidth,iHeight) {
			var url; //转向网页的地址;
			var name; //网页名称，可为空;
			var iWidth; //弹出窗口的宽度;
			var iHeight; //弹出窗口的高度;
			//window.screen.height获得屏幕的高，window.screen.width获得屏幕的宽
			var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;
			var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;
			window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
		},
		tab : function (father,son){
			$(father).find(son).click(function () {
				$(this).addClass('active').siblings().removeClass('active');
			})
		},
		deleteCapital : function (classString,obj) {
			var str_arr  = new Array();
			var patt1 = new RegExp('[A-Z]');
			str_arr = classString.split(' ');

			for(var i=0;i<str_arr.length;i++){
				if(patt1.test(str_arr[i])){
					$(obj).removeClass(str_arr[i])
				}
			}
		},
		getQueryVariable : function(variable){
	       var query = window.location.search.substring(1);
	       var vars = query.split("&");
	       for (var i=0;i<vars.length;i++) {
	               var pair = vars[i].split("=");
	               if(pair[0] == variable){return pair[1];}
	       }
	       return(false);
		}
	}
})