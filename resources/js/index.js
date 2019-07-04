/*(function() {
  var _53code = document.createElement("script");
  _53code.src = "//tb.53kf.com/code/code/10140411/1";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(_53code, s);
})();*/

function alt(content,icon){
	if(icon==0){
		art.dialog({
			id: 'testID2',
			content: content,
			lock: true,
			cancelVal: '关闭',
			cancel: true
		});
	}else{
		if(icon=='success'){
			icon = 'success';
		}else{
			icon = 'warning';
		}
	   var _fag =	art.dialog({
			icon: icon,
			id: 'testID2',
			content: content,
			lock: true,
			cancelVal: '关闭',
			cancel: true
		}); 
	}
};
function Order_chedan(id,trano,obj){
	artDialog({
		content:'确定撤单吗',
		cancel:function(){},
		ok:function(){
		$.post("/Apijiekou.chedan",{'id':id,'trano':trano}, function(json){
				if(json.sign==1){
					alt('撤单成功','success');
					$(obj).html('<span style="color:grey">已撤单</span>');
				}else{
					alt(json.message);
				}
			},'json'); 

		},
		lock:true
	})
};
function formatIntVal(obj){
    obj.value=obj.value.replace(/\D+/g,'');
	formatPrice(obj,obj.value);
}
function formatPrice(val){
	val = Number(val);
	val = val.toFixed(1);
	return val;
};


/*
if(ISLOGIN!='')window.setInterval("cheklogin();",10000);
function cheklogin(){
	$.getJSON(WebConfigs['ROOT']+"/index.php?m=Home&c=User&a=checklogin", function(json){
		if(json.status==0){
			//window.location.href = "/index.php?m=Home&c=Public&a=logout";
			return false;
		}
		else if(json.status==1){
			$("#show_money").html(json.money);
			$("#show_point").html(json.point);
		}
		
	}); 
}
*/


$(function(){
	var JPlaceHolder = {
    	//检测
		_check : function(){
			return 'placeholder' in document.createElement('input');
		},
		//初始化
		init : function(){
			if(!this._check()){
				this.fix();
			}
		},
		//修复
		fix : function(){
			jQuery(':input[placeholder]').each(function(index, element) {
				var self = $(this), txt = self.attr('placeholder');
				self.wrap($('<div></div>').css({position:'relative', zoom:'1', border:'none', background:'none', padding:'none', margin:'none'}));
				var pos = self.position(), h = self.outerHeight(true), paddingleft = self.css('padding-left');
				var holder = $('<span></span>').text(txt).css({position:'absolute', left:pos.left, top:pos.top, height:h, lienHeight:h, paddingLeft:paddingleft, color:'#aaa'}).appendTo(self.parent());
				self.focusin(function(e) {
					holder.hide();
				}).focusout(function(e) {
					if(!self.val()){
						holder.show();
					}
				});
				holder.click(function(e) {
					holder.hide();
					self.focus();
				});
			});
		}
	};
	//执行
	jQuery(function(){
		JPlaceHolder.init();    
	});
	/**
    * @content 去边框
    * @author  袁妲<yuanda>  
    * @time 2015年11月12日 10:07:09
    */	
	$(".infos_l dl dd:last").css("border","0px")
	 

	/**
    * @content 中奖滚动
    * @author  袁妲<yuanda>  
    * @time 2015年11月12日 10:07:09
    */	
	$(".srcoll_user .checn").click(function(){ 
      var theStatue = $(this).attr("statue"); 
      if(theStatue == undefined || theStatue == "true"){ 
         $(this).attr("statue","false"); 
         var pict_box_width = $(this).parent(".srcoll_user").width();   //可见区域的宽度 
         var ul_width = $(this).prev(".pict_list").width();      //滚动区域的宽度 
         var li_width = parseFloat($(".pict_list li").width());   //每个li的宽度 
         var scroll_num = parseInt($(this).data("name"));   //点击滚动li的个数 
         if(scroll_num > 0 && li_width > 0){ 
            var scroll_width = li_width * scroll_num;   //每次滚动的宽度 
         }else{ 
            var scroll_width = pict_box_width;   //当前的value值不大于0时，默认滚动的宽度为可见区域宽度 
         } 
         var theScroll = $(this).prev("ul").eq(0); 
         var clone_li = theScroll.find("li:lt("+scroll_num+")").clone(); 
         theScroll.append(clone_li); 
         theScroll.stop().animate({ 
            "margin-left":"-"+scroll_width+"px" 
         },1000,function(){ 
            theScroll.find("li:lt("+scroll_num+")").remove(); 
            theScroll.css("margin-left","0px"); 
            $(this).next(".checn").attr("statue","true"); 
         }); 
      }else{ 
         return false; 
      } 
   }); 
	 var auto_scroll = setInterval(function(){ 
		  $(".checn").click(); 
	   },5000);
	   

	$(".srcoll_rangk .checn1").click(function(){ 
      var theStatue = $(this).attr("statue"); 
      if(theStatue == undefined || theStatue == "true"){ 
         $(this).attr("statue","false"); 
         var pict_box_width = $(this).parent(".srcoll_rangk").width();   //可见区域的宽度 
         var pict_box_height = $(this).parent(".srcoll_rangk").height();   //可见区域的高度
         var ul_height = $(this).prev(".rangk").height();      //滚动区域的宽度 
         var li_width = parseFloat($(".rangk li").width());   //每个li的宽度 
         var li_height = parseFloat($(".rangk li").height());   //每个li的高度 
         var scroll_num = parseInt($(this).data("name"));   //点击滚动li的个数 
		 if(scroll_num > 0 && li_height > 0){ 
            var scroll_height = li_height * scroll_num;   //每次滚动的宽度 
         }else{ 
            var scroll_height = pict_box_height;   //当前的value值不大于0时，默认滚动的宽度为可见区域宽度 
         } 
         var theScroll = $(this).prev("ul").eq(0); 
         var clone_li = theScroll.find("li:lt("+scroll_num+")").clone(); 
         theScroll.append(clone_li); 
         theScroll.stop().animate({ 
            "margin-top":"-"+scroll_height+"px" 
         },1000,function(){ 
            theScroll.find("li:lt("+scroll_num+")").remove(); 
            theScroll.css("margin-top","0px"); 
            $(this).next(".checn1").attr("statue","true"); 
         }); 
      }else{ 
         return false; 
      } 
   }); 
	 var auto_scroll = setInterval(function(){ 
		 $(".srcoll_rangk .checn1").click(); 
	   },5000);
	/**
    * @content 排行榜
    * @author  袁妲<yuanda>  
    * @time 2015年11月12日 10:07:09
    */
        $(".rangk li em:lt(3)").css({ "background": "url(/Public/home/images/bg1.png)", "padding": "7px 13px 1px 13px" })
	
	/**
    * @content 首页头部切换
    * @author  袁妲<yuanda>  
    * @time 2015年11月12日 10:07:09
    */	
	$(".list_tag  i").click(function(){
		$(this).addClass("curr");
		$(this).siblings().removeClass("curr")
		var num = $(this).index(".list_tag i");
		$(this).parent(".list_tag").siblings(".tag_det").children(".tag_copy").eq(num).show();
		$(this).parent(".list_tag").siblings(".tag_det").children(".tag_copy").eq(num).siblings(".tag_copy").hide();
	})
	
	/**
    * @content 首页hover
    * @author  袁妲<yuanda>  
    * @time 2015年11月12日 10:07:09
    */
	$(".bann_hover").hover(function(){
		$(this).children("ul").show();
	})
	$(".bann_hover").mouseleave(function(){
		$(this).children("ul").hide();
	})
	
	$(".page_box .page_index a:last").css("border-right","1px solid #eee")
	
	
	/**
    * @content 切换
    * @author  袁妲<yuanda>  
    * @time 2015年11月12日 10:07:09
    */	
	$(".datetady  li a").click(function () {
	    $(this).addClass("curr");
	    $(this).parent("li").siblings().children().removeClass("curr")
	    var num = $(this).index();
	    $(this).parents(".list_tag").siblings(".tag_det").children(".tag_copy").eq(num).show();
	    $(this).parents(".list_tag").siblings(".tag_det").children(".tag_copy").eq(num).siblings(".tag_copy").hide();
	})
	
	/**
    * @content 投注管理-投注记录-展开全部
    * @author  袁妲<yuanda>  
    * @time 2015年9月12日 16:07:09
    */

	$(".launch p.down").click(function(){
		$(".extend_condition").show();
		$(this).hide();
		$(this).next(".up").show();
	});
	$(".launch p.up").click(function(){
		$(".extend_condition").hide();
		$(this).hide();
		$(this).prev(".down").show();
	});
	
	$(".search_condition .take_show span li").click(function(){
		$(this).addClass("curr");
		$(this).siblings("li").removeClass("curr");
	})

    //头部注册
	$(".register_btn").click(function () {
	    var _theUrl = $(this).attr("url");
	    if (_theUrl!="javascript:void(0)") {
	        return true;
	    } else { 
	        alert("请联系客服或代理！");
	    }
	});
    //快捷充值页面效果
	if ($("#charge_type").length > 0) {
	    var oCharge_label = $("#charge_type li label");
	    oCharge_label.click(function () {
	        var oCharge_val = $(this).children(".icon_bank").attr("value");
	        if (oCharge_val) {
	            $("#fastID_val").val(oCharge_val);
	        };
	    });
	};

	$("#acount_title").hover(function () {
	    $(".myaccount_list").show();
	}, function () {
	    $(".myaccount_list").hide();
	});

	$(".today_qd").click(function () { $(".today_qd_btn").click(); });

    //首页模拟点击确认
	if ($("#login2").length > 0) {
	    $(document).keydown(function (event) {
	        var oKeyCode = event.keyCode;
	        if (oKeyCode == 13) {
	            $(".input_sub").trigger("click");
	        };
	    });
	};

    //注册页面区别代理注册
	if ($("#login2").length > 0 && $("#login2").attr("reg") == "true") {
	    var oLink = window.location.href;
	    var oLink_end = oLink.split("?")[1];
	    var oForm_link = $(".login_m_form #form1").attr("action");
	    var oForm_link_pre = oForm_link.split("?")[0];
	    var oFormNew_link = oForm_link_pre + "?action=register_agent&" + oLink_end;
	    if (oLink_end) {
	        $(".login_m_form #form1").attr("action", oFormNew_link);
	    }
	}
     
    //默认页面打开的滚动位置
	if ($(".u_tag_bann").length > 0) { 
	    var offset1 = $(".u_tag_bann").offset();
	    $("html,body").animate({ "scrollTop": offset1.top + "px" },20);
	}

	if ($(".open_containers").length > 0) {
	    var offset1 = $(".open_containers").offset();
	    $("html,body").animate({ "scrollTop": offset1.top + "px" },20);
	}
	 
	Compatible_Prompt();


	if ($(".bdsharebuttonbox").length > 0) {
	    window._bd_share_config = { "common": { "bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "1", "bdSize": "16" }, "share": {} }; with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
	}
})


/**
 * @content 浏览器IE兼容版本
 * @author  梁汝翔<liangruxiang> 
 * @param MinSub 最低兼容版本数 
 * @time 2015年8月10日 10:07:09
 */
function Compatible_Prompt(MinSub) { 
    if (MinSub == undefined) {
        MinSub = 7;
    }

    var agent = navigator.userAgent.toLowerCase();
    var regStr_ie = /msie [\d.]+;/gi;
    var regStr_ff = /firefox\/[\d.]+/gi
    var regStr_chrome = /chrome\/[\d.]+/gi;
    var regStr_saf = /safari\/[\d.]+/gi;
    var _theBrowser = "" ;
    //IE
    if (agent.indexOf("msie") > 0) {
        _theBrowser = agent.match(regStr_ie);
    }
    //firefox
    if (agent.indexOf("firefox") > 0) {
        _theBrowser = agent.match(regStr_ff);
    }
    //Chrome
    if (agent.indexOf("chrome") > 0) {
        _theBrowser = agent.match(regStr_chrome);
    }
    //Safari
    if (agent.indexOf("safari") > 0 && agent.indexOf("chrome") < 0) {
        _theBrowser = agent.match(regStr_saf);
    }

    _theBrowser = _theBrowser.toString();  
    var theIeLengthLength = _theBrowser.indexOf("msie");  //判断是否为IE浏览器 

    if (theIeLengthLength >= 0) {  //是否为IE浏览器
        //获取浏览器的版本 
        var theBanben = _theBrowser.replace(/[^0-9.]/ig, "");
        
        theBanben = isNaN(Number($.trim(theBanben))) ? 7 : Number($.trim(theBanben));
        if (theBanben < MinSub) { 
            //显示兼容信息
            ShowCompatibleLoyout();
        }
    } 
}

/**
 * @content 提示弹窗信息
 * @author  梁汝翔<liangruxiang> 
 * @param MinSub 最低兼容版本数 
 * @time 2015年8月10日 10:07:09
 */
function ShowCompatibleLoyout() { 
    var defaults = { 
        title: "\u4F60\u77E5\u9053\u4F60\u7684Internet Explorer\u662F\u8FC7\u65F6\u4E86\u5417?", // title text
        text: "\u4E3A\u4E86\u5F97\u5230\u6211\u4EEC\u7F51\u7AD9\u6700\u597D\u7684\u4F53\u9A8C\u6548\u679C,\u6211\u4EEC\u5EFA\u8BAE\u60A8\u5347\u7EA7\u5230\u6700\u65B0\u7248\u672C\u7684Internet Explorer\u6216\u9009\u62E9\u53E6\u4E00\u4E2Aweb\u6D4F\u89C8\u5668.\u4E00\u4E2A\u5217\u8868\u6700\u6D41\u884C\u7684web\u6D4F\u89C8\u5668\u5728\u4E0B\u9762\u53EF\u4EE5\u627E\u5230.<br /><br /><h1 id='go_continue' style='font-size:20px;cursor:pointer;'>>>>\u7EE7\u7EED\u8BBF\u95EE</h1>"
    };   

    var Cover_layout = "<div class='layout_cover'></div>"; 
    var Cover_Content = "<span>" + defaults.title + "</span>"
				  + "<p> " + defaults.text + "</p>"
			      + "<div class='browser'>"
			      + "<ul>"
			      + "<li><a class='chrome' href='https://www.google.com/chrome/' target='_blank'></a></li>"
			      + "<li><a class='firefox' href='http://www.mozilla.org/en-US/firefox/new/' target='_blank'></a></li>"
			      + "<li><a class='ie9' href='http://windows.microsoft.com/en-US/internet-explorer/downloads/ie/' target='_blank'></a></li>"
			      + "<li><a class='safari' href='http://www.apple.com/safari/download/' target='_blank'></a></li>"
			      + "<li><a class='opera' href='http://www.opera.com/download/' target='_blank'></a></li>"
			      + "<ul>"
			      + "</div>";
    var Cover_Container = "<div class='layout_Contianer'>" + Cover_Content + "</div>";
    var w_height = $(window).height(); //窗口的高度

    var CompatibleContainer = "<div class='CompatibleContainer'>" + Cover_layout + Cover_Container + "</div>";
    if ($(".CompatibleContainer").length<1) {
        $("body").append($(CompatibleContainer));
    }

    $("#go_continue").click(function () {
        $(".CompatibleContainer").hide();
    });



   
}

setInterval("rangusers()", 1000*10*60);
setInterval("srcollusers()", 1000*10*60);
function rangusers(){
	var lis = '';
	var username;
	var amount;
	for(index=1;index<=20;index++){
		username = randomString(3);
		amount = Math.floor(Math.random()*9999+10)+'.00';
		//lis += '<li><span><em>'+index+'</em></span><a href="javascript:void(0);">'+username+'****** <i class="c_red">'+amount+'</i> 元</a></li>';
		lis += '<li style="padding-left:15px;"><a href="javascript:void(0);">'+username+'****** <i class="c_red">'+amount+'</i> 元</a></li>';
	}
	$("ul.rangk").html(lis);
}
function srcollusers(){
	var lis = '';
	var username;
	var amount;
	for(index=1;index<=20;index++){
		username = randomString(3);
		amount = Math.floor(Math.random()*9999+10)+'.00';
		lis += ' <li><a href="javascript:void(0)">会员 '+username+'*******中奖 <i class="c_red">'+amount+'</i> 元</a></li>';
	}
	$("ul.pict_list").html(lis);
}

function randomString(len) {
    len = len || 32;
    var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz';
    var maxPos = $chars.length;
    var pwd = '';
    for (i = 0; i < len; i++) {
        pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return pwd;
}
function MathRand(len){ 
	var Num=""; 
	for(var i=0;i<len;i++) 
	{ 
	Num+=Math.floor(Math.random()*10); 
	} 
	return Num;
} 


































