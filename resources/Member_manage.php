<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0059)https://www.julialt.com/user/list?number=0.6840735175189505 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=9">
<title>杏耀娱乐 </title>
<link rel="stylesheet" href="__CSS2__/listmanage.css">
<link rel="stylesheet" href="__CSS2__/resetmanage.css">
<link rel="stylesheet" href="__CSS2__/activitymanage.css">
<link href="__CSS2__/dialogUImanage.css" media="all" type="text/css" rel="stylesheet">
<script type="text/javascript" src="./jquery-1.7.min.js.下载"></script>
<script type="text/javascript" src="./main.js.下载"></script>
<script type="text/javascript" src="./jquery.dialogUI.js.下载"></script>

<!--//日历-->
<script type="text/javascript" src="./jquery.dynDateTime_setClass.js.下载"></script>
<script type="text/javascript" src="./calendar-utf8.js.下载"></script>
<script type="text/javascript" src="./common.js.下载"></script>
<link rel="stylesheet" type="text/css" media="all" href="./calendar-blue.css">

<script>

function searchWait(){
    $(".mask_list").show();
}
$(function(){

  var isAir = !!getCookie("isclient") && getCookie("kernel") == 2;
     $("input.formCheck").click(function(){
            searchWait();
    });

     if(isAir){
      var a_blank = document.getElementsByTagName("a");
      for(var i=0,b=a_blank.length;i<b;i++){
        var aList =a_blank[i];
        if(aList.target == "_blank"){
           //aList.target="";
           aList.removeAttribute("target");
        }
      }
    }
        //直接点击团队span
$(".search_br span").unbind("click").click(function(){
var data = $(this).attr("data");
$(".search_br span").removeClass("hover");
$(this).addClass("hover");
if(data=="person")
    $("input[name='type'],input[name='ptype'],input[name='ischild']").eq(0).prop("checked", true);
else
    $("input[name='type'],input[name='ptype'],input[name='ischild']").eq(1).prop("checked", true);
});
})
</script>

</head>
<body>

<div class="mask_list">
<div>加载中，请稍后...</div>
</div>
<div id="subContent_bet_re">
 <include file="Member/side" />
 <script type="text/javascript">
    function checkForm(obj)
    {
        if( obj.username.value != "" && obj.usergroup.value == 0 )
        {
            $.alert("请选择用户组");
            return false;
        }
       searchWait();
    }
</script>
<form action="" method="get" name="search" id="search-form" onsubmit="return checkForm(this)" autocomplete="off">
    <input type="hidden" name="frame" value="show">
    <input type="hidden" name="flag" value="search">
    <input type="hidden" name="orderby" value="userpoint">
    <input type="hidden" name="sort" value="desc">
    <input type="hidden" name="userid" value="228342">
    <div id="searchBox" class="re" style="padding-top: 0;">
        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="formTable">
        <tbody><tr>
            <td>
                <div class="search-container">

                    <div class="gy_search">
                        <div class="inlineBlock">
                            <label>用户名：</label>
                            <input type="text" name="username" class="input_user_name inputNospace" id="username" value="">
                        </div>
                        <input name="" type="submit" value="查询" class="formCheck">
                    </div>
                    <div class="link-box">
                        <a href="javascript:;" onclick="postMessage(&#39;user/adduser/?width=1040&#39;,&#39;注册开户&#39;,650,400)" class="registration"></a>
                        <a href="javascript:;" onclick="postMessage(&#39;user/marketing/?width=1040&#39;,&#39;推广链接&#39;,700,510)" class="promotion"></a>
                    </div>
                </div>      
            </td>
        </tr>
    </tbody></table>
    </div>
</form>
<div class="line10px"></div>
<div class="form-div">
        <!--当前位置：<a href="/user/list" class="orange">用户列表</a> >
                -->
</div>
<form action="https://www.julialt.com/user/list?number=0.6840735175189505" method="get">
    <div class="tableTips clearfix">
        <div class="fl tableLevel">
            本级：
                        <a href="https://www.julialt.com/user/list?userid=228342&amp;orderby=children_num&amp;sort=desc" style="font-weight:bold;">chy597823</a>                     </div>
        <h3 style="color:#ff6b71;font-size:12px;margin-bottom:10px;font-weight:normal;float:right;">注：可点击标题修改排序</h3>
    </div>
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="grayTable" id="userlistDL">
        <tbody><tr>
            <th><span class="sortBtn1  sort" orderby="username">用户名</span></th>
            <th><span class=" sort" orderby="userpoint">返点</span></th>
            <th><span class="jt_down sort" orderby="children_num">人数</span></th>
            <th><span class=" sort" orderby="availablebalance">个人余额</span></th>
            <th><span class=" sort" orderby="team_balance">团队余额</span></th>
            <th><span class=" sort" orderby="registertime">注册日期</span></th>
            <th><span class=" sort" orderby="lasttime">最后登录</span></th>
            <th width="">操作</th>
        </tr>

                <tr>
            <td><a href="https://www.julialt.com/user/list?frame=show&amp;userid=228342&amp;orderby=children_num&amp;sort=desc">chy597823</a></td>
            <td>7.8%</td>
            <td>1</td>
            <td>0.0000</td>
            <td>0.0000</td>
            <td>2018-11-06</td>
            <td>2018-12-11</td>
            <td class="handle">
                                                <a href="javascript:;" onclick="postMessage(&#39;gameinfo/newgamelist?username=chy597823&#39;,&#39;投注记录&#39;)" class="postMessage"><strong>投注记录</strong></a>
                <a href="javascript:;" onclick="postMessage(&#39;report/selfbankreport?userid=228342&#39;,&#39;账变记录&#39;)" class="postMessage"><strong>账变记录</strong></a>
            </td>
        </tr>
                <tr>
            <td><a href="https://www.julialt.com/user/list?frame=show&amp;userid=282660&amp;orderby=children_num&amp;sort=desc">toiler</a></td>
            <td>0%</td>
            <td>0</td>
            <td>0.0000</td>
            <td>0.0000</td>
            <td>2018-12-11</td>
            <td>2018-12-11</td>
            <td class="handle">
                                <a href="javascript:;" onclick="postMessage(&#39;user/upedituser?uid=282660&#39;,&#39;返点设定&#39;,600,380)"><strong>返点设定</strong></a>
                                                <a href="javascript:;" onclick="postMessage(&#39;gameinfo/newgamelist?username=toiler&#39;,&#39;投注记录&#39;)" class="postMessage"><strong>投注记录</strong></a>
                <a href="javascript:;" onclick="postMessage(&#39;report/selfbankreport?userid=282660&#39;,&#39;账变记录&#39;)" class="postMessage"><strong>账变记录</strong></a>
            </td>
        </tr>
            </tbody></table>
    <div class="list_page">
        <div class="pageinfo">总计 2 个记录,  分为 1 页, 当前第 1 页<span id="tPages">   <strong>1</strong>
 </span>
转至 <script language="javascript">function keepKeyNum(obj,evt){var  k=window.event?evt.keyCode:evt.which; if( k==13 ){ goPage(obj.value);return false; }} function goPage(iPage){if(parseInt(iPage) != iPage){alert("输入整数的页码");return false;} if(parseInt(iPage) < 0){alert("输入正整数的页码");return false;} if( !isNaN(parseInt(iPage)) ) { if(!0){ if( iPage > 1 ){alert("输入页码超出尾页页码");return false; }} window.location.href="/user/list/?number=0.6840735175189505&pn=20&p="+iPage;}}</script><input onkeypress="return keepKeyNum(this,event);" type="text" id="iGotoPage" name="iGotoPage" size="6">页 <input type="button" onclick="javascript:goPage( document.getElementById(&#39;iGotoPage&#39;).value );return false;" class="button" value="GO"></div>
    </div>
</form>
<script type="text/javascript">
    $("#userlistDL a").click(function(){
        var userstring = "用户列表 > "+$(this).text();
        $("#addressDetail").text(userstring);
    });
	
	$(document).ready(function(){
		var timer;
		var count = 0;
		var isTimer = false;
		function showTipHide(){
			if(isTimer == true){
				++count;
			}
			console.log(count);
			if(count == 15){
				count = 0;
				isTimer = false;
				$(".memberList").hide();
			}
		}
		
		$(".memberEevnt").click(function(){
			var pos = $(this).parent("td").position();
			var top = pos.top;
			var _left = $("#userlistDL tr th").eq(0).width();
			var height = $(this).parent("td").height();
			var index = $(".memberEevnt").index($(this));
			var width = $(window).width() / 4;
			var _leftTd2 = $("#userlistDL tr th").eq(1).width();
			$(".memberList").hide();	
			$(".memberList").eq(index).css({"top" : top + height, "left" : _left + 12, "width" : width}).show();
			$(".memberTip").eq(index).css({"left" : _leftTd2/2});
			count = 0;
			isTimer = true;
			window.clearInterval(timer);
			timer = window.setInterval(showTipHide,1000);
		});
		
		$(".memberClose").click(function(){
			$(".memberList").hide();
			count = 0;	
			isTimer = false;
		});
        $(".sort").on('click', function(){
            if($(this).hasClass("jt_up")){
                $("#search-form input[name=sort]").val('desc');
                $(this).removeClass("jt_up").addClass("jt_down")
            }else{
                $("#search-form input[name=sort]").val('asc');
                $(this).removeClass("jt_down").addClass("jt_up")
            }
            var orderby = $(this).attr('orderby');
            $("#search-form input[name=orderby]").val(orderby);
            $("#search-form").submit();
        });
	});
	
	
</script>

</div>
<div style="clear: both"></div>
<script type="text/javascript">
if(window.top.location.href.indexOf("report")>0){
    $(".tab-first").remove();
  }
</script>
<script type="text/javascript" src="./base.js.下载"></script>
<script>
   window.onload=function(){
        // if(window.top.IFRAME_MODAL_OPENING){ 
        //     return;
        // }

        var bodyHeight = $("body").height();
        //设置父级ifarme高度
        jQuery("#mainFrame").setHeight({height:bodyHeight});
        //获取Url标题base.js中
        jQuery(".topContent ul li a").html(jQuery.getUrlParam("tit"));
        //如果有图片

        if(window.top.VERSION != 'X'){ 
            //document.write("WHAT ARE U DOING!")
        }
    }

    $(function(){
        //页码处理
        /*var len = $('.pageinfo > *').length;
        $('.pageinfo > *').each(function(i,v){
          var txt = $(v).text();
          if(i >= len - 2 && isNaN(txt))$(v).addClass('last-two');
        });*/

        //报表所有页面 搜索时 输入用户名 去掉前后空格
        $('.inputNospace').blur(function(){ 
            $(this).val($(this).val().replace(/\s*/g,''))
        })
        //声音开关
        $("#soundCtl").click(function(){
            _sound._soundCtl();
            changeClass();
        });

        //根据cookie设置class
        function changeClass(){
            if(_sound._checkCookie()){
                $("#soundCtl").removeClass().addClass('soundon');
            }else{
                $("#soundCtl").removeClass().addClass('soundoff');
            }
        }

    });

    function postMessage(url,title,width,height,modal){ 
      var width = width || 1040;
      var height = height || 580;
      if(typeof(url) == "object"){return}
      var modal = modal || 'show_modal';
        window.top.postMessage({
            action: modal,
            title: title,
            url: url,
            width: width,
            height: height
        }, '*')
    }

</script>
 
 </body></html>