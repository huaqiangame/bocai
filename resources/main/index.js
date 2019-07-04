$(function(){
});
/**function list_tag_curr(obj,index){
	$(obj).addClass('curr').siblings('i').removeClass('curr');
	$(".wapp_top_midle .tag_det .tag_copy").eq(index).show().siblings().hide();
}
function index_list_tag(lotterylist){
	var html1='',$node1 = $(".wapp_top_midle .list_tag");
	var html2='',$node2 = $(".wapp_top_midle .tag_det");
	for(var o in lotterylist){
		var class1='';
		if(o<=5){
			html2 += index_list_tag_info(lotterylist[o],o);
			if(o==5){
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
	if(openinfo.opencode){
		var array = (openinfo.opencode).split(",");
	}else{
		var array = "";
	}
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
	taginfohtml += '<img class="img1" src="'+WebConfigs["ROOT"]+'/resources/images/game/img4.png">';
	taginfohtml += '<span>';
	taginfohtml += '<img src="'+WebConfigs["ROOT"]+'/resources/images/game/k3_'+array[0]+'.jpg">';
	taginfohtml += '<i>+</i>';
	taginfohtml += '<img src="'+WebConfigs["ROOT"]+'/resources/images/game/k3_'+array[1]+'.jpg">';
	taginfohtml += '<i>+</i>';
	taginfohtml += '<img src="'+WebConfigs["ROOT"]+'/resources/images/game/k3_'+array[2]+'.jpg">';
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

  /**
   * 当天投注记录
   * @param shortName
   */
  function getUserBetsListToday(_lotteryname) {
    if(!user || user.islogin!=1){
      return false;
    }
    lotteryname = _lotteryname?_lotteryname:lotteryname;
    var tabs = $("#userBetsListToday");
    tabs.empty();
    var url = apirooturl + 'betslisttoday';
    var pagination = $.pagination({
      render: '.paging',
      pageSize: jqueryGridRows,
      pageLength: 7,
      ajaxType: 'post',
      //hideInfos: false,
      hideGo: true,
      ajaxUrl: url,
      ajaxData: {
        "lotteryname": lotteryname,'jqueryGridPage': jqueryGridPage,'jqueryGridRows': jqueryGridRows
      },
      complete: function() {},
      success: function(data) {
				tabs.empty();
				
        $.each(data, function(index, val) {
					
          var html = '<tr id="'+val.trano+'">';
          html += '<td> <a href="javascript:getBillInfo(\''+val.trano+'\')">' + val.trano + '</a></td>';
          html += '<td>' + val.expect + '</td>';
          html += '<td>' + val.opencode + '</td>';
		  html += '<td>' + val.playtitle + '</td>';
		  html += '<td>' + val.tzcode + '</td>';
          html += '<td>' + val.mode + '</td>';
          html += '<td>' + val.amount + '</td>';
          html += '<td>' + (val.okamount ? val.okamount : 0) + '</td>';
          html += '<td>' + val.oddtime + '</td>';
          html += '<td>';
          //'<td>' + val.betsTimes + '</td>' +
          if(val.isdraw == -1) { // 未中奖绿色
            html += '<span style="color:green">未中奖</span>';
          } else if(val.isdraw == 1) { // 已中奖红色
            html += '<span style="color:red">已中奖</span>';
          }else if(val.isdraw == -2) {
            html += '<del>已撤单</del>';
          }else if(val.isdraw == 0) {
            html += '<span>未开奖</span>';
          }else{
            html += '<span>未知状态</span>';
          }
          html += '</td>';
          html += '</tr>';
          tabs.append(html);
        });
      },
      pageError: function(response) {},
      emptyData: function() {}
    });
    pagination.init();
  }

/**function index_cplist(lotterylist){ 
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
		html += '<img src="'+WebConfigs["ROOT"]+'/resources/images/game/img4.png" width="62" height="62">';
		
		html += '</dt>';
		html += '<dd>';
		html += '<h4>'+lotterylist[o].title+'</h4>';
		html += '<p></p>';
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
}**/

