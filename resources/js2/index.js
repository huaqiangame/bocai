$(function(){
	//$(".srcoll_user .checn").click();
});
function list_tag_curr(obj,index){
	$(obj).addClass('curr').siblings('i').removeClass('curr');
	$(".wapp_top_midle .tag_det .tag_copy").eq(index).show().siblings().hide();
}
function index_list_tag(lotterylist){
	var html1='',$node1 = $(".wapp_top_midle .list_tag");
	var html2='',$node2 = $(".wapp_top_midle .tag_det");
	for(var o in lotterylist){
		var class1='';
		if(o<=4){
			html2 += index_list_tag_info(lotterylist[o],o);
			if(o==4){
				html1 += '<i onclick="list_tag_curr(this,'+o+')" class="">'+lotterylist[o].title+'</i>';
			}else{
				if(o==0){
					class1 = 'curr';
				}
				html1 += '<i onclick="list_tag_curr(this,'+o+')" class="'+class1+'">'+lotterylist[o].title+'</i><em>|</em>';
			}
			
		}
	};
	$node1.html(html1);
	$node2.html(html2);
}
function index_list_tag_info(openinfo,index){
	var taginfohtml='',display='none';
	var array = (openinfo.opencode?openinfo.opencode:'0,0,0').split(",");
	var sum = parseInt(array[0])+parseInt(array[1])+parseInt(array[2]);
	var smallbig='',oddeven='';
	if(sum>10)
		smallbig='大';
	else
		smallbig='小';
	if(sum%2!=0)
		oddeven='单';
	else
		oddeven='双';
	if(index==0)display = 'block';
	taginfohtml += '<div class="tag_copy" style="display: '+display+';">';
	taginfohtml += '<div class="tag_top">';
	taginfohtml += '<img class="img1" src="/resources/images/game/img4.png">';
	taginfohtml += '<span>';
	taginfohtml += '<img src="/resources/images/game/k3_'+array[0]+'.jpg">';
	taginfohtml += '<i>+</i>';
	taginfohtml += '<img src="/resources/images/game/k3_'+array[1]+'.jpg">';
	taginfohtml += '<i>+</i>';
	taginfohtml += '<img src="/resources/images/game/k3_'+array[2]+'.jpg">';
	taginfohtml += '<i>+</i>';
	taginfohtml += '<em>'+sum+'</em>';
	taginfohtml += '</span>';
	taginfohtml += '<input class="btn radius bg_red" value="立即投注" type="button" onclick="openMenuUrl(\''+host+'/Game.k3?code='+openinfo.name+'\',true)">';
	taginfohtml += '</div>';
	taginfohtml += '<div class="tag_down">';
	taginfohtml += '<span>当前期：第 <i class="c_red">'+openinfo.expect+'</i>期</span>';
	taginfohtml += '<span>开奖号码：<i class="c_red">'+openinfo.opencode+'</i></span>';
	taginfohtml += '和值：<i class="c_red">'+sum+'</i></span>';
	taginfohtml += '形态：<em class="bg_zyell">'+smallbig+'</em> | <em class="bg_green">'+oddeven+'</em></span>';
	taginfohtml += '</div></div>';
	return taginfohtml;
}

function index_cplist(lotterylist){
	var html='',$node = $(".allcplist .cpitem");
	for(var o in lotterylist){
		var openinfo = lotterylist[o];
		if(!openinfo.opencode)openinfo.opencode='0,0,0';
		var array = (openinfo.opencode).split(",");
		var sum = parseInt(array[0])+parseInt(array[1])+parseInt(array[2]);
		var smallbig='',oddeven='';
		if(sum>10)
			smallbig='大';
		else
			smallbig='小';
		if(sum%2!=0)
			oddeven='单';
		else
			oddeven='双';
		html += '<li>';
		html += '<a href="javascript:void(0);" onclick="openMenuUrl(\''+host+'/Game.k3?code='+lotterylist[o].name+'\',true)">';
		html += '<dl>';
		html += '<dt>';
		html += '<img src="/resources/images/game/img4.png" width="62" height="62">';
		
		html += '</dt>';
		html += '<dd>';
		html += '<h4>'+lotterylist[o].title+'</h4>';
		html += '<p>'+lotterylist[o].ftitle+'</p>';
		html += '</dd>';
		html += '</dl>';
		html += '</a>';
		html += '<div class="det">';
		html += '<p>当前期：第 <i class="c_red">'+lotterylist[o].expect+'</i> 期</p>';
		html += '<p>开奖号码：<i class="c_red">'+lotterylist[o].opencode+'</i></p>';
		html += '<p>';
		html += '<span>和值：'+sum+'</span>';
		html += '<span>形态：<em class="bg_zyell">'+smallbig+'</em> | <em class="bg_green">'+oddeven+'</em></span></p>';
		
		html += '<div><a class="bg_red" onclick="openMenuUrl(\''+host+'/Game.k3?code='+lotterylist[o].name+'\',true)">立即投注</a><a class="bg_org" onclick="openMenuUrl(\''+host+'/Game.trend?code='+lotterylist[o].name+'\',false)">走势详情</a></div>';
		html += '</div>';
		html += '</li>';
	};
	$node.html(html);
	//onclick="javascript:Gameinit('ahk3');"
}
$(document).on("click", ".srcoll_user .checn", function() {
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
		  $(".checn").click(); },5000);
	   

	$(document).on("click", ".srcoll_rangk .checn1", function() {
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

//setInterval("rangusers()", 1000*10*60);
//setInterval("srcollusers()", 1000*10*60);
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
