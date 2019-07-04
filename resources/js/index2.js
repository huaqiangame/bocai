// JavaScript Document 



var _SiteNotice , _TopMsgTimeOut; //网站消息

$(document).ready(function () {
 

    //触碰玩法说明的"选号示例"
    $("body").on("mouseover", ".example_btn", function () {
        var oTop = 0;
        var oLeft = 0;
        if ($(this).parents(".play_select_prompt").size() > 0) {
            oTop = $(this).offset().top;
            oLeft = $(this).offset().left + 50;
        }
        else {
            oTop = 30;
            oLeft = 265;
            //oLeft = 20;
        };

        if ($(this).parents(".ds_dr").size() > 0) //单式导入
        {
            //oLeft = oLeft + 50;
            oLeft = oLeft;
        };
        $(this).siblings(".example_tip").show().css({ "left": oLeft, "top": oTop });
    });
    $("body").on("mouseout", ".example_btn", function () {
        var oTop = $(this).offset().top;
        var oLeft = $(this).offset().left + 50;
        if ($(this).parents(".ds_dr").size() > 0) //单式导入
        {
            //oLeft = oLeft + 50;
            oLeft = oLeft + 50;
        };
        $(this).siblings(".example_tip").hide().css({ "left": oLeft, "top": oTop });
    });

    //右侧跟随菜单定位
    if ($("#fixedMenu").size() > 0) {
        var fHeight = $("#fixedMenu").height();
        $("#fixedMenu").css({ "margin-top": -parseInt(fHeight / 2) });
    }

    //顶部全部游戏菜单
    if ($("#header .snav").size() > 0) { 
        $("#header .snav .snav_all").hover(function () {
            $(this).children(".snav_all_menu").show();
        }, function () {
            $(this).children(".snav_all_menu").hide();
        });

        //顶部我的账户触碰菜单
        //$("#myaccount").hover(function () {
        //    $(this).children(".myaccount_list").show();
        //}, function () {
        //    $(this).children(".myaccount_list").hide();
        //});
    }

     
    //首页低频彩滚动
    if ($(".ibox_gp").size() > 0) {
        var oDp_li = $(".ibox_gp ul li");
        var oCont1 = oDp_li.eq(0).find(".list_cont_wrap");
        var oCont2 = oDp_li.eq(1).find(".list_cont_wrap");
        var oCont3 = oDp_li.eq(2).find(".list_cont_wrap"); 

    }

    //平台公告轮播
    if ($(".box_ann").size() > 0) {
        var oUl = $(".box_ann").find("ul");
        var oLi = oUl.children("li");
        var oLi_height = oLi.height() + 5; 
    }



    //登录页面提示 
    if ($(".input_text").size() > 0) {
        var oInput = $(".input_text");
        var oInput_size = oInput.size();
        for (var a = 0; a < oInput_size; a++) {
            var oInput_ts = oInput.eq(a).attr("fn_ts");
            var oTs_width = oInput.eq(a).width();
            var oInput_insert = '<i class="ts">' + oInput_ts + '</i>';
            oInput_insert = $(oInput_insert);         //先把插入的元素转化成对象，然后再设置宽度
            oInput_insert.width(oTs_width);
            oInput.eq(a).after(oInput_insert);
        };
        $(".ts").click(function () {
            $(this).hide().siblings(".input_text").focus();;
        });
        oInput.blur(function () {
            if ($(this).val() == '') {
                $(this).siblings(".ts").show();
            };
        });
        setTimeout(function () {
            for (var a = 0; a < oInput_size; a++) {
                if (oInput.eq(a).val() == '') {
                    oInput.eq(a).siblings(".ts").show();
                }
                else {
                    oInput.eq(a).siblings(".ts").hide();
                };
            };
        }, 1000);
        oInput.keydown(function () {
            $(this).siblings(".ts").hide();
        });
    }; 

    //点击选择银行
    if ($(".choiceBank").size() > 0) {
        $(".choiceBank").click(function () {
            var oList = $(this).children(".c_list");
            var oList_item = oList.children(".icon_bank").size();
            if (oList_item > 0) {
                oList.toggle();
            }
            else {
                return false;
            };
        });

        $(".choiceBank .icon_bank").click(function () {
            var oVal = $(this).attr("val");
            var oName = $(this).attr("name");
            var oClass = $(this).attr("class");
            var oSelect = "<span class='" + oClass + "'></span>" //插入到选中的银行项目
            $(this).siblings(".cband").val(oName);
            $(this).siblings(".cband").attr("choiceName", oName)
            $(this).parents('.choiceBank').find(".selectBank").empty().append(oSelect);
            $(this).parents(".choiceBank").find(".iconfont").css({ "margin-top": "6px", "font-size": "14px" });
            $(this).parents(".choiceBank").find(".icon_bank").css('width', '125px');
            var oWeb = $(this).attr("website");
            $("#jump").attr("website", oWeb);
        });
    }
     
     
    //点击选择银行
    if ($(".choiceBank_tx").size() > 0) {
        $(".choiceBank_tx").click(function () {
            var oList = $(this).children(".c_list");
            var oList_item = oList.find("li").size();
            if (oList_item > 0) {
                oList.toggle();
            }
            else {
                return false;
            };
        });

        $(".choiceBank_tx ul li").click(function () {
        	$(this).children("input").prop("checked",true);
            var oVal = $(this).children(".icon_bank").attr("val");
            var oName = $(this).children(".icon_bank").attr("name");
            var oValue = $(this).children(".icon_bank").attr("value");
            var oClass = $(this).children(".icon_bank").attr("class");
            var oSelect = "<span class='" + oClass + "'></span>" //插入到选中的银行项目
            $(this).parents(".c_list").find(".cband").val(oValue);
            $(this).parents(".c_list").find(".cband").attr("choiceName", oName)
            $(this).parents('.choiceBank_tx').find(".selectBank").empty().append(oSelect);
            $(this).parents(".choiceBank_tx").find(".iconfont").css({ "margin-top": "6px", "font-size": "14px" });
            $(this).parents(".choiceBank_tx").find(".icon_bank").css('width', '125px');
            var oWeb = $(this).attr("website");
            $("#jump").attr("website", oWeb);
        });
    } 

    //转账限额
    $("#transfer_num").keyup(function () {
        var oMaxmoney = $(this).attr("tMax");  //最大限额
        var oVal = $(this).val();
        oVal = parseInt(oVal);
        if (oVal > oMaxmoney) {
            $(this).val(oMaxmoney);
        };
    });

    /*******************
     *  Date:2015-03-05
     *	Author:ruiec lrx ( 修改 )
     *  Fn: 会员中心——展开收起  
     **********************/
    $(".invest .btn_zk").click(function () {
        var theStatue = $(this).attr("statue");
        var oText = $(this).html();
        if (theStatue == undefined || theStatue == "true") {
            $(this).empty().html("收起&and;");
            $(this).attr("statue", "false");
        }
        else {
            $(this).empty().html("展开&or;");
            $(this).attr("statue", "true");
        };
        $(this).parents(".invest").find(".toggle").toggle();
    });

    //开户中心条件btn切换
    $(".ty_item").click(function () {
        $(this).addClass("curr").siblings(".ty_item").removeClass("curr");
    });

    //开户中心彩种切换
    $(".table_setDetail th a").click(function () {
        $(this).addClass("curr").siblings("a").removeClass("curr");
        var oIndex = $(this).index();  //获取索引
        $(this).parents(".table_setDetail").find(".tab_item").removeClass("curr").eq(oIndex).addClass("curr");
    });

    //开户中心返点设置
    $(".ty_item").click(function () {
        var oHiddenFd = $(this).siblings("#setFD"); //隐藏返点值
        if (oHiddenFd.size() > 0) {
            var oVal = $(this).attr("oVal");
            oHiddenFd.val(oVal);
        };
    });
    $("#QuickSetup").click(function () {
        $(".tr_quick").show();
        $(".tr_detail").hide();
    });
    $("#DetailedSettings").click(function () {
        $(".tr_quick").hide();
        $(".tr_detail").show();
    });
    //开户中心点击”返点全满“,”零佣金“按钮对表单操作
    $(".table_setDetail .fd_btn").click(function () {
        var oCheck = $(this).parents(".table_setDetail").find(".check_detail");
        var oInputText = $(this).parents(".table_setDetail").find(".ty_text");
        for (var a = 0; a < oCheck.size() ; a++) {
            oCheck.eq(a)[0].checked = true;
        };

        var oId = $(this).attr("id");
        if (oId == 'fd_all') //返点全满
        {
            for (var b = 0; b < oInputText.size() ; b++) {
                var oMax = parseFloat(oInputText.eq(b).attr("maxval"));  //获取每个Input最大值	
                if(oMax>0)
                {
                	oMax = oMax.toFixed(1);
                }
                else
                {
                	oMax = 0.0;
                };
                oInputText.eq(b).val(oMax);
            };
        }
        else //零佣金
        {
            for (var b = 0; b < oInputText.size() ; b++) {
                oInputText.eq(b).val("0.0");
            };
        };

    });

    //会员中心站内信点击全选
    $("#check_letter").click(function () {
        var oCheck = $(".table_letter .ch");
        if ($(this)[0].checked == true) {
            for (var a = 0; a < oCheck.size() ; a++) {
                oCheck.eq(a)[0].checked = true;
            };
        }
        else {
            for (var a = 0; a < oCheck.size() ; a++) {
                oCheck.eq(a)[0].checked = false;
            };

        };
    });

    //通用只能输入数字
    $(".onlyNum").onlyNum();

    ruiec_changeAlert();

    //首页模拟点击确认
    if ($("#login2").size() > 0) {
        $(document).keydown(function (event) {
            var oKeyCode = event.keyCode;
            if (oKeyCode == 13) {
                $(".input_sub").trigger("click");
            };
        });
    };

    //查看参与的合买用户的下拉效果  creat-time 2015 05 27 ； author ：ruiec_lrx
    if ($("#look_more_hemai").size() > 0) {
        $("#look_more_hemai").click(function () {
            $(".join_userlist").slideToggle();
        });
    }

    //点击未开放提示
    $(".unOpen").click(function () {
        artDialog({
            icon: "warning",
            content: "暂未开放此功能！",
            ok: function () {

            },
            lock: true

        });
    });


    //页面导航聚焦效果
    var this_Url = $(".nav_item").attr("value");
    if (this_Url == undefined) { this_Url == "index.aspx"; }
    var the_curr_obj = $(".nav_item a[href$='" + this_Url + "']").eq(0);
    //console.log(the_curr_obj);
    if (the_curr_obj != undefined) {
        the_curr_obj.parent().siblings().find("a").removeClass("curr");
        the_curr_obj.addClass("curr");
    }


    //下级转账
    $(".table_code .fn_zzObj").click(function () {
        $(this).children(".transfer").removeAttr("disabled");
        $(this).siblings(".fn_zzObj").children(".transfer").attr("disabled", "disabled");
        var oVal = $(this).children(".transfer").attr("value");
        if (oVal == 2) {
            $("#child_user_infos").show();
        }
        else {
            $("#child_user_infos").hide();
        };

    });

    //转账添加下级用户
    $("#btn_addLow").click(function () {
        var oAddUser = $(this).attr("addUser");
        var oAddUser_arry = oAddUser.split(",");
        var oAddLabel = "";
        var oAddlabel_div = "";
        for (var a = 0; a < oAddUser_arry.length; a++) {
            if (a == 0) {
                oAddLabel = "<label lab='" + a + "'><i><input type='radio' name='dial_child_input' checked='checked' /></i><a>" + oAddUser_arry[a] + "</a></label>";
            } else {
                oAddLabel = "<label lab='" + a + "'><i><input type='radio' name='dial_child_input' /></i><a>" + oAddUser_arry[a] + "</a></label>";
            } 
            oAddlabel_div = oAddlabel_div + oAddLabel;
        };
        var oDiv = "<div id='transfer_choiceUser' class='transfer_choiceUser'>" +
					"<dl>" +
						"<dt><label>搜索用户：</label><input class='ty_text' type='text' id='serch_text'/><input class='ty_btn' type='button' value='搜索' id='serch_btn' /></dt>" +
						"<dd class='u_list'>" + oAddlabel_div + "</dd>" +
						"<dd class='u_ch'>" +
							"<span class='fl' style='display:none;'><label><input name='ch' type='radio' id='choice_all'/>全选</label><label><input id='choice_none'  name='ch' type='radio'/>反选</label></span>" +
							"<span class='fr'><input class='ty_btn' id='choice_sub' type='button' value='添加'/></span>" +
						"</dd>" +
                        "<dd style='height:30px;'>&nbsp;</dd>" +
					"</dl>" +
				 "</div>";

        artDialog({
            title: "添加转账用户",
            content: oDiv, 
            lock: true 
        });
    });
     
    //添加转账用户效果
    $("body").on("click", "#serch_btn", function () {
        oTextval = $(this).siblings("#serch_text").val();
        var u_label = $(this).parents("#transfer_choiceUser").find(".u_list").children("label");
        var oP = "<p class='ts_text'><i class='iconfont'>&#xe63c;</i>找不到此玩家，请确认输入</p>"
        var oFind = 0; //是否找到该玩家
        if (oTextval !== '') {

            for (var a = 0; a < u_label.size() ; a++) {

                if (oTextval == u_label.eq(a).children("a").text()) {
                    u_label.hide().eq(a).show();

                    oFind = 1;
                }
            };
            if (oFind == 0) {
                u_label.hide();
                $(".ts_text").remove();
                $(this).parents("#transfer_choiceUser").find(".u_list").append(oP);
            }
            else {
                $(".ts_text").remove();
            };
        }
        else {
            $(".ts_text").remove();
            u_label.show();
        };
    });

    //转账用户全选功能
    $("body").on("click", "#choice_all", function () {
        $("#transfer_choiceUser .u_list label input").prop("checked", true);
    });

    //反选
    $("body").on("click", "#choice_none", function () {
        $("#transfer_choiceUser .u_list label input").prop("checked", false);
    });

    //提交添加账户用户
    $("body").on("click", "#choice_sub", function () {
        var oChoice = $("#transfer_choiceUser .u_list label");
        var oCarry = new Array();
        var oCarry_str = "";
        var oChoiceItem_a = "";
        for (a = 0; a < oChoice.length; a++) {
            if (oChoice.eq(a).find("input").is(":checked")) {
                var oChoiceItem = oChoice.eq(a).find("a").text();
                oChoiceItem_a += "<a class='a_item'><i class='i_val'>" + oChoiceItem + "</i><i class='iconfont'>&times;</i></a>"; 
                oCarry.push(oChoiceItem);
                if ((a + 1) < oChoice.length) {
                    oCarry_str += oChoiceItem + ",";
                } 
            };
        }; 
        $("#insertWrap").empty().html(oChoiceItem_a);
        $("#hid").val(oCarry);

        if (oCarry.length != 0 && $("#transfer_choiceUser").size() > 0) {
            $("body div").last().parent().hide(); 
            $("#transfer_choiceUser").parents(".aui_state_focus").hide();
        };
		
		$("body").find(".transfer_choiceUser").each(function(){
			$(this).parents(".aui_state_focus").hide();
		})
		
    });

    $("body").on("click", "#child_user_infos .a_item .iconfont", function () {
        $(this).parent(".a_item").remove(); 
        var _theInfos = new Array();
        $("#child_user_infos .a_item").each(function () {
            var oChoiceItem = $(this).children(".i_val").text();
            _theInfos.push(oChoiceItem);
        });
        $("#hid").val(_theInfos);
    });

    //登陆页效果
    if ($("#login2 .login_t .l_question").size() > 0) {
        $("#login2 .login_t .l_question").animate({ "top": "60px" }, function () {
            $(this).animate({ "top": "30px" }, 200, function () {
                $(this).animate({ "top": "45px" }, 100, function () {
                    $(this).animate({ "width": "210px" });
                });
            });
        });
    }

    //头部金额处理
    if ($("#get_money").size() > 0) {
        //头部显示我的余额
        $("#show_money a").click(function () {
            var theValue = $("#get_money").find("em").text() == undefined ? 0.00 : $("#get_money").find("em").text();
            theValue = isNaN(parseFloat(theValue).toFixed(2)) ? 0.00 : parseFloat(theValue).toFixed(2);
            $("#get_money").find("em").empty().text(theValue);
            $(this).parents("#show_money").hide().siblings("#get_money").show();
        });

        //头部显示我的余额
        $("#get_money").click(function () {
            $(this).stop(true).hide();
            $("#show_money").stop(true).show();
        });

        //更新我的金额
        $("#get_money .iconfont").click(function (event) {
            event.stopPropagation();
            ruiec_ajaxUpdateMoney();  //更新我的余额
        });
    } 


    //注册页面区别代理注册
    if ($("#login2").size()>0&&$("#login2").attr("reg") == "true") {
        var oLink = window.location.href;
        var oLink_end = oLink.split("?")[1];
        var oForm_link = $(".login_m_form #form1").attr("action");
        var oForm_link_pre = oForm_link.split("?")[0];
        var oFormNew_link = oForm_link_pre + "?action=register_agent&" + oLink_end;
        if (oLink_end) {
            $(".login_m_form #form1").attr("action", oFormNew_link);
        } 
    }
     
    if ($("#header .nav").size() > 0) { 
        //内页头部隐藏
        var oHref = window.location.href;
        var oHref_split = oHref.split("/")
        var oHref_split_end = oHref_split[oHref_split.length - 1];
        var oHref_split_end2 = oHref_split_end.split("?");
        var theLocalURl = window.location.host;
        var oIndex_link = "<a id='indexLink' href='http://" + theLocalURl + "/index.html' class='fl'>返回首页</a>";
        if (oHref_split_end2.length > 0) {
            var oHref_split_end3 = oHref_split_end2[0];
        }
        else {
            var oHref_split_end3 = oHref_split_end2
        };
        if (oHref_split_end3 == "index.html" ) {
            $("#header .nav").show();
            $("#indexLink").remove();
        }
        else {
            $("#header .nav").hide();
            $("#header .snav .w1000 .snav_all").after(oIndex_link);
        };
        
        //导航选中状态
        var oNav_item = $(".nav_item ul li");
        if(oNav_item.size()>0)
        {
        	for(var a =0; a<oNav_item.size();a++)
        	{
        		var oNav_item_link = oNav_item.eq(a).children("a").attr("href"); //导航对应每个项的链接
        		var oNav_item_link_split = oNav_item_link.split("/");
        		var oNav_item_link_last = oNav_item_link_split[oNav_item_link_split.length-1];
        		if(oHref_split_end == oNav_item_link_last || oHref_split_end == oNav_item_link_last + "#")
        		{
        			oNav_item.children("a").removeClass("curr");
        			oNav_item.eq(a).children("a").addClass("curr");
        		};
        	};
        };
    }


    //点击“恢复默认项”
    $("#btn_hf").click(function () {
        $(this).parents(".ty_table2").find("#intTime").find("a").eq(0).trigger("click");
        $(this).parents(".ty_table2").find("#state").find("a").eq(0).trigger("click");
        $(this).parents(".ty_table2").find("#lottery_code").val("-1");
    });

    /*活动左侧菜单效果*/
    var oActivityMenu = $("#activity_menu");
    var oActivityMenuItem = oActivityMenu.find("a");
    var oActivityFloor = $("#activity .floor");
    if (oActivityMenu.size() > 0) {
        oActivityMenu.animate({ "marginTop": "-200px" }, 700, function () {
            oActivityMenu.animate({ "marginTop": "-226px" }, 400);
        });
        oActivityMenuItem.click(function () {
            var oMove = $(this).attr("moveTo");
            var oMoveClass = "." + oMove;
            var oMoveTarget = $("#activity").find(oMoveClass);
            var oMoveTarget_top = oMoveTarget.offset().top;
            $("html,body").animate({ "scrollTop": oMoveTarget_top });
        });
        oActivityFloor.hover(function () {
            $(this).find(".img img").stop().animate({ "margin-top": "-15px" })
        }, function () {
            $(this).find(".img img").stop().animate({ "margin-top": "0px" })
        });
    };


    //活动先到先得效果
    if ($("#activity3").size() > 0) {
    	//点击宝箱
        $("#activity3 .box_mi ul li").click(function () {
            var dateType = $("#activity3 .dte_time span.curr").size();
            var dateType_index = $("#activity3 .dte_time span.curr").index() +1;
            if (dateType > 0) {
                $.ajax({
                    type: "POST",
                    url: "active6_box.html",
                    data: { "action": "ReceBonus", "dateType": dateType_index },
                    dataType: "json",
                    success: function (data) {
						var Code = data.Code; //状态值
                        var StrCode = data.StrCode;
                        alert(StrCode);
                        if(Code ==1)
                        {
                        	$(this).addClass("curr");
                        };
                    }
                });
            }
            else {
                alert("还没到领奖时间，敬请期待");
            };

        });
        //点击标题
        $("#activity3 .dte_time span").click(function () {
            var oCurr = $(this).hasClass("curr");
            var oText = $(this).text();
            if (oCurr == false) {
                alert(oText + "还没到领奖时间，敬请期待！")
            };
        });
        //时间改变标题状态
        setInterval(function () {
            var oDate = new Date();
            var oHours = oDate.getHours();
            var oMinutes = oDate.getMinutes();
            var oAllMinutes = oHours * 60 + oMinutes; //总分钟数
            var getTime1 = $.trim($(".dte_time span").eq(0).children("p").text());   //上半场时间
            var getTime2 = $.trim($(".dte_time span").eq(1).children("p").text());   //下半场时间
            
            var getTime1_begin = getTime1.split("-")[0]
            var getTime1_end = getTime1.split("-")[1]
            var getTime1_begin_hours = parseInt(getTime1_begin.split(":")[0]);
            var getTime1_begin_minutes = parseInt(getTime1_begin.split(":")[1]);
            var getTime1_end_hours = parseInt(getTime1_end.split(":")[0]);
            var getTime1_end_minutes = parseInt(getTime1_end.split(":")[1]);
            
            var getTime2_begin = getTime2.split("-")[0]
            var getTime2_end = getTime2.split("-")[1]
            var getTime2_begin_hours = parseInt(getTime2_begin.split(":")[0]);
            var getTime2_begin_minutes = parseInt(getTime2_begin.split(":")[1]);
            var getTime2_end_hours = parseInt(getTime2_end.split(":")[0]);
            var getTime2_end_minutes = parseInt(getTime2_end.split(":")[1]);
            
            var b1 = getTime1_begin_hours * 60 + getTime1_begin_minutes;  /*上半场开始时间（分钟）*/
            var e1 = getTime1_end_hours*60 + getTime1_end_minutes;   /*上半场结束时间*/
            var b2 = getTime2_begin_hours * 60 + getTime2_begin_minutes;  /*上半场开始时间（分钟）*/
            var e2 = getTime2_end_hours*60 + getTime2_end_minutes;   /*上半场结束时间*/
            
            if (oAllMinutes >= b1 && oAllMinutes < e1) {
                $("#activity3 .dte_time span").removeClass("curr").eq(0).addClass("curr");
            }
            else if (oAllMinutes >= b2 && oAllMinutes < e2) {
                $("#activity3 .dte_time span").removeClass("curr").eq(1).addClass("curr");
            }
            else {
                $("#activity3 .dte_time span").removeClass("curr");
            };
        }, 1000)
        
        //换一批按钮点击
        $("#activity3 .change").click(function(){
        	var change_li = $(this).siblings("ul").children("li");
        	change_li.removeClass("curr").stop().fadeOut(300).fadeIn(600);
        });
    };

    //活动“每天快乐送”接口
    $("#activity2 .a_cont table td.td3 .btn").click(function () {
        var happyday_id = $(this).attr('happyday_id');
        $.ajax({
            type: "POST",
            url: "activity_joyful.html",
            data: { "action": "ReceBonus", "happyday_id": happyday_id },
            dataType: "json",
            success: function (data) {
                if (data) {
                    var StrCode = data.StrCode;
                    artDialog({
                        icon: "warning",
                        content: StrCode,
                        ok: function () {

                        },
                        lock: true
                    });
                };
            }
        });
    });

    if ($("#activity1").size() > 0) {
        var oDH = parseInt($("#activity1 #dh_money").text());
        if (oDH > 0) {
            $("#activity1 #dh_btn").addClass('curr')
        }
        else {
            $("#activity1 #dh_btn").removeClass('curr');
        };
        //活动“积分兑换”接口
        $("#activity1 #dh_btn.curr").click(function () {
            var me = this;
            $.ajax({
                type: "POST",
                url: "activity_score.html",
                data: { "action": "ReceBonus" },
                dataType: "json",
                success: function (data) {
                    var oCode = data.Code; //如果等于1则兑换成功，按钮变灰色
                    var oMessage = data.StrCode //提示信息
                    if (oCode == 1) {
                        me.removeClass("curr");
                    }
                    artDialog({
                        icon: "warning",
                        content: oMessage,
                        ok: function () {

                        },
                        lock: true
                    });
                }
            });
        });
    };
 
	//会员中心的标题
	if($(".userBox .uc_tit h3").size()>0)
	{
		var oTitle = $(".userBox .uc_tit h3").text();
		$("title").text(oTitle);
	};

	//合买详情页面号码多时处理
	if($(".zhDetail").size()>0)
	{
		var zhDetail_line= $(".zhDetail .zh_list");
		for(var a = 0;a<zhDetail_line.size(); a++)
		{
			var betting_number = zhDetail_line.eq(a).find(".betting_number");
			var betting_number_val = betting_number.attr("title");
			if(betting_number_val!=""&&betting_number_val!=undefined)
			{
				var betting_number_val_length = betting_number_val.length;
				if(betting_number_val_length>20)
				{
					betting_number.text(betting_number_val.substring(0,20));
					betting_number.after("<a class='alink'>详情</a>")
				};
			};
		};
	};
	
	$(".zhDetail").on("click",".alink",function(){
		var show_betting_number = $(this).siblings(".betting_number").attr("title");
		var oTop = $(this).offset().top-15;
		var oLeft = $(this).offset().left; 
		art.dialog({
		    left: oLeft,
		    top: oTop,
		    content: show_betting_number,
		    width:"200px"
		});
	});

	$(".hm_floor").on("click", ".alink", function (event) {
	    event = event || window.event;

	    event.stopPropagation();

	    var _theValues = $(this).prev().attr("title") == undefined ? "" : $(this).prev().attr("title");
	    if (_theValues != "") { 
	        alert(_theValues);
	    }
	    return false; 
	});
	
	//重置密码提交
	$("#foget_btn").click(function(){
		var foget_type = $("#foget_type").val();/*验证类型*/
		var foget_name = $("#foget_name").val();/*用户名*/
		var foget_par1 = $("#foget_par1").val();/*密文参数1*/
		var foget_par2 = $("#foget_par2").val();/*密文参数2*/
		var foget_paw1 = $("#foget_paw1").val(); /*密码*/
		var foget_paw2 = $("#foget_paw2").val(); /*密码2*/
		var oData ={};
		oData.pas1 = foget_paw1;
		oData.pas2 = foget_paw2;
		oData.type = foget_type;

		var _Reqx = /^(?![^a-zA-Z]+$)(?!\D+$).{6,15}$/;
		var _theForms = $(this).parents("form").eq(0); 
		if (!_Reqx.test(foget_paw1)) {  
		    alert("密码格式有误，请填写6~15位数字与字母组合的密码。");
		    $("#foget_paw1").focus();
		    return false;
		}

		oData.action = "updatePassword";
		if(foget_type==1)
		{
			oData.par1 = foget_par1;
			oData.par2 = foget_par2;
			oData.user_name = foget_name;
		}
		var oLink = window.location.href;
		$.ajax({
		    type: "POST",
		    url: "../../../../tools/ssc_ajax.ashx",
		    data:oData,
	        dataType: "json",
	        success: function(data){
	        	var aData=data;
	        	var aCode = aData.Code;
	        	var aStrCode = aData.StrCode;
	        	if (aCode == 1) {
	        	    alert(aStrCode);
	        	    var _localtionName = window.location.host == undefined ? '/index.html' : window.location.host;
	        	    setTimeout(function () {
	        	        window.location.href = "http://" + _localtionName + "/login.html";
	        	    },2000)
	        	    //window.open("forgetPaw7.html", "_self");
	        	} else {
	        	    alert(aStrCode);
	        	} 
	        }    
	    });
	});
	
	//银行卡管理增加绑定
	$("#btn_zjbd").click(function(){
		var oCurr = $(this).hasClass("curr");
		if(oCurr == true)
		{
			return false;
		}
		else
		{
			var oHref = $(this).attr("href");
			window.open(oHref,"_self");
		};
	});
	
	
	
	//站内信效果
	if($("#myInfo").size()>0)
	{
	    $("#myInfo").hover(function () {


	        var _theLength = $(this).find("#message_num").text();
	        if (_theLength != "0") {
	            var oLeft = $(this).offset().left - 100;
	            var oTop = $(this).offset().top + 30;
	            $(this).children(".messageShow").css({ "left": oLeft, "top": oTop });
	            $(this).children(".messageShow").show();
	        } else {
	            $(this).find(".messageShow").hide();
	        }
		},function(){
			$(this).children(".messageShow").hide();
		});
		
		//更新头部站内信信息
		ruiec_InsideLetter();
		_TopMsgTimeOut = setInterval(function(){
			//更新头部站内信信息
			ruiec_InsideLetter();
		},10000);
	};
	
	 //获取站内信的效果
	_SiteNotice = setInterval(function () {
	    ruiec_showNotice();
	}, 6000);
    
	
	//活动——消费佣金领取
	if($("#btn_yjlq").size()>0)
	{
		$("#btn_yjlq").click(function(){
			$.ajax({
				type:"POST",
				url:"user_account_activity_brokerage.html",
				data:{"action":"ReceBonus"},
				dataType:"json",
				success:function(data){
					if(data)
					{
						var oCode = data.Code; //返回值的状态值
						var StrCode = data.StrCode //返回值的提示
						if(oCode ==1)
						{
							artDialog({
								lock:true,
								icon:"success",
								content:StrCode,
								ok:function(){}
							})
						}
						else
						{
							artDialog({
								lock:true,
								icon:"warning",
								content:StrCode,
								ok:function(){}
							})
						};
					};
				}
			})
		});
	};
	
	
	//安全中心等级判断
	if($(".u_safe .star").size()>0)
	{
		var safe_item = $(".u_safe .safe_list li.curr");
		var safe_item_size = 5-safe_item.size();
		var star =$(".u_safe .star .iconfont");
		for(var a =0; a<star.size(); a++)
		{
			if(a<safe_item_size)
			{
				star.eq(a).addClass("curr")
			}
			else
			{
				star.eq(a).removeClass("curr")
			};
			if(a<2)
			{
				$("#safe_text").text("低");
			}
			else if(a>=2 && a<4)
			{
				$("#safe_text").text("中");
			}
			else
			{
				$("#safe_text").text("高");
			};
		};
	};
	
	//代理红包领取
	if($("#agent_btn").size()>0)
	{
		$("#agent_btn").click(function(){
			var oThis = $(this);
			$.ajax({
				type:"POST",
				url:"activity_agent.html",
				data:{"action":"ReceBonus"},
				dataType:"json",
				success:function(data){
					if(data)
					{
						var oCode = data.Code; //获取返回的状态值
						var StrCode = data.StrCode //获取返回的提示
						if(oCode==1)
						{
							artDialog({
								icon:"success",
								lock:"true",
								content:StrCode,
								ok:function(){
									oThis.removeClass("curr")
								},
								close:function(){
									oThis.removeClass("curr");
								}
							});
						}
						else
						{
							artDialog({
								icon:"warning",
								lock:"true",
								content:StrCode,
								ok:function(){}
							});
						};
						
						//console.log(data);	
					};
					
				}
			});
		});
	};
	//投注页面右侧浮动倒计时操作
	if($("#fixedCountDown").size()>0)
	{
		var oWindow_width = parseInt($(window).width());
		var oRight = parseInt((oWindow_width-1000)/2)-10;
		$("#fixedCountDown").css({"right":oRight});
		$("#fixedCountDown .c_right").click(function(){
			$(this).siblings(".c_left").toggle();
		});
		var oShowTop = $("#j_play_select").offset().top;
		$(window).scroll(function(){
			var sTop = parseInt($(window).scrollTop());
			if(sTop>oShowTop)
			{
				$("#fixedCountDown").show();
			}
			else
			{
				$("#fixedCountDown").hide();
			};
		});
	};
     
	
	//快捷充值页面效果
	if($("#charge_type").size()>0)
	{
		var oCharge_label = $("#charge_type li label");
		oCharge_label.click(function(){
			var oCharge_val = $(this).children(".icon_bank").attr("value");
			if(oCharge_val)
			{
				$("#fastID_val").val(oCharge_val);
			};
		});
	};
	
	
   /**
    * @content 我的账户-hover效果
    * @author  梁汝翔<liangruxiang>  
    * @time 2015年10月17日 10:48:09
    */
	var _GetInfosContainers;
	$(".top_show .show_my").mouseover(function () { 
	    $(".hover_list").show(); 
	    _GetInfosContainers = setTimeout(ruiec_ajaxUpdateMoney,500); 
	})
 
   /**
    * @content 更新账户余额
    * @author  梁汝翔<liangruxiang>  
    * @time 2015年10月17日 10:48:09
    */
	setInterval(ruiec_ajaxUpdateMoney, 10000); 
	 
    /**
     * @content 滑动更新账户余额
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年10月17日 10:48:09
     */
	$(".top_show .show_my").mouseleave(function () {
	    $(".hover_list").hide();
	    if (_GetInfosContainers != undefined) {
	        clearTimeout(_GetInfosContainers);
	    }
	})
 

    /**
     * @content 6-15位  非纯数字 与非纯字母的组合密码
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年10月17日 10:48:09
     */
	if ($(".lrxcheck_sub_btn")) {
	    $(".lrxcheck_sub_btn").click(function () {
	        var _Reqx = /^(?![^a-zA-Z]+$)(?!\D+$).{6,15}$/;
	        var _theForms = $(this).parents("form").eq(0);
	        var _State = true, k = 0;
	        _theForms.find(".check_pwd").each(function () {
	            var _theValue = $(this).val();
	           
	            if (!_Reqx.test(_theValue) && k <= 0) {
                     k++;
	                _State = false; 
	                alert("密码格式有误，请填写6~15位数字与字母组合的密码。");
	                $(this).focus();
	            }
	        }); 
	        return _State; 
	    })
	}
      
    /**
     * @content 导航三级联动
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年9月17日 10:48:09
     */
	$(".nav_box .nav_item").mouseover(function () {
	    if ($(this).find(".child_list").length > 0) { 
	        $(".nav_box .nav_item>a.curr").addClass("Init_Curr"); 
	        $(this).siblings().children("a").removeClass("curr");
	        $(this).children("a").addClass("curr");
	        $(this).find(".child_list").slideDown(200);
	    }
         
	});

	$(".nav_box .nav_item li").mouseenter(function () {
	    $(this).siblings().removeClass("curr");
	    $(this).addClass("curr");
	    var _this = $(this);
	    $(".child_list dl").stop(true, true).hide(1, function () {
	        _this.find("dl").eq(0).stop(true, true).fadeIn(200);
	    });
	});

	$(".nav_box .nav_item").mouseleave(function () { 
	    if ($(this).find(".child_list").length > 0) { 
	        $(this).find("dl").stop(true, true).fadeOut(200);
	        $(this).find("li").removeClass("curr");
	        $(this).children("a").removeClass("curr").removeClass("Init_Curr");
	        $(".child_list").stop(true, true).slideUp(); 
	        $(".nav_box .nav_item>a").removeClass("curr");
	        $(".nav_box .Init_Curr").addClass("curr").removeClass("Init_Curr");
	    } 
	});

    //页面加载成功后隔一段时间把loading效果去掉
	$(".qiyue_mzInfos").click(function () {
	    var bouns_day = $("#bouns_day").val();
	    var theQiyueContent = "<div style='text-align:left;line-height:25px;'><p>1、快三彩票“契约分红协议”<br>为保障代理的分红利益,平台推出“契约分红协议”，该协议由上下级代理以自愿为原则签署，并接受平台的监督。<br>2. 服务说明<br>（1）“契约分红”就是上级与下级在平台内部建立的一种分红约定，并会由平台监督和监管。尽量保障下级分红利益的方式。<br>（2）本人需要先和上级签订了契约，才可以给下级签订。<br>（3）上级代理有义务按照分红契约中约定的比例发放分红。<br>（4）平台的分红周期为" + bouns_day + "天。如在结束时间后仍未发放分红，平台将认定为拒绝发放,将记入不良纪录。<br>3. 免责声明<br>（1）“契约分红协议”属于上下级代理之间的协议，平台有权监督契约执行情况。<br>（2）契约分红原则上必须经由平台发放。对于上级代理余额不足以发放分红时，平台允许但不鼓励上级代理经由平台外的第三方途径发放分红，但分红结果必须经下级代理平台内确认才算有效！平台外分红属于上下级之间私下协议，出现纠纷平台不承担任何责任和义务。<br>（3）分红尚未发放完成时，上级代理的账号资金暂时冻结，不得买单，兑换礼金，提现，向下代充等，直至分红发放完成！对于拒绝发放分红的上级，平台有权强制发放，情节严重者平台有权永久冻结其帐号并转移其下级！<br>4. 最终解释权<br>关于本平台中所有规则与条款，本平台保留所有最终解释权。</p></div>";
	    art.dialog({
	        'title': '快三彩票分红契约免责声明',
	        'width': '510px',
	        'height': '360px',
	        'padding': '10px 20px',
	        'content': theQiyueContent,
            'time':60
	    });
	});

    //导航提示信息
	$(".nav_item>a").click(function () {
	    var _theHref = $(this).attr("href");
	    if (_theHref == "javascript:void(0);") {
	        alert("正在紧张建设中，请您稍后!");
	    }
	})
	$(".sort_list>a").click(function () {
	    var _theHref = $(this).attr("href");
	    if (_theHref == "javascript:void(0);") {
	        alert("正在紧张建设中，请您稍后!");
	    }
	})
	
 
    /*********************** 
    * function：网站首页，中奖信息滚动
    * Author  : ruiec_lrx  
    *************************/
	if ($(".this_new").size() > 0) {
	    var _SetInterVal = setInterval(function () {
	        $(".this_new").each(function () {
	            Scroll_Containers($(this));
	        })
	    }, 5000);
	} 

    /*********************** 
    * function：注册页面的Cookie 存储更新
    * Author  : ruiec_lrx  
    *************************/
	if ($("#cookie_registerForms").size() > 0) {
         
	    var _Daili_OpenCode = getQueryString("text");
	    var _Daili_OpenCodeId = getQueryString("id");
	    if (_Daili_OpenCode != "" && _Daili_OpenCodeId != "") {
	        setCookie("OpenMemberCode", _Daili_OpenCode, 3000);
	        setCookie("OpenMemberCodeId", _Daili_OpenCodeId, 3000);
	    }  
	}

    /*********************** 
    * function：注册页面的页面按钮
    * Author  : ruiec_lrx  
    *************************/
	if ($(".register_btn").size() > 0) {
	    var _GetOpenMemberCode = getCookie("OpenMemberCode");
	    var _GetOpenMemberCodeId = getCookie("OpenMemberCodeId");

	    //console.log(_GetOpenMemberCode);
	    if (_GetOpenMemberCode && _GetOpenMemberCodeId) {
	        if (_GetOpenMemberCode != "null") {
	            var _thrUrl = "http://" + window.location.host + "/rigest.html?id=" + _GetOpenMemberCodeId + "&text=" + _GetOpenMemberCode;
	            $(".register_btn").attr("href", _thrUrl);
	            $(".register_btn").addClass("haveurl");
	        }
	        else {
	            var _thrUrl = "http://" + window.location.host + "/rigest1.html";
	            $(".register_btn").attr("href", _thrUrl);
	            $(".register_btn").addClass("haveurl");
	        }
	    } else {
	        //$(".register_btn").hide();
	        var _thrUrl = "http://" + window.location.host + "/rigest1.html" ;
	        $(".register_btn").attr("href", _thrUrl);
	        $(".register_btn").addClass("haveurl");
	    }
	}



	if ($("select[name='question1']").size() > 0) {
	    var _theArrays = [];
	    $("select[name='question1']").find("option").each(function () {
	        var _theOptionObj = {};
	        _theOptionObj.value = $(this).attr("value");
	        _theOptionObj.text = $(this).text();
	        _theOptionObj.state = false ; 
	        _theOptionObj.useObj = ""; 
	        _theArrays.push(_theOptionObj);
	    });

	    $("select[name='question1']").change(function () {
	        var _theValue = $(this).val(); 
	        for (var i = 0; i < _theArrays.length ; i++) {
	            if (_theArrays[i].value == _theValue) { 
	                _theArrays[i].state = true;
	                _theArrays[i].useObj = $(this);
	            } else {
	                if (typeof _theArrays[i].useObj == "object") {
	                    var _theObj = _theArrays[i].useObj;
	                    if (_theObj.attr("name") == $(this).attr("name")) {
	                        _theArrays[i].useObj = "";
	                        _theArrays[i].state = false;
	                    }
	                }
	            }
	        } 
	        setSelectInfos(_theArrays); 
	    });

	    $("select[name='question2']").change(function () {
	        var _theValue = $(this).val();
	        for (var i = 0; i < _theArrays.length ; i++) {
	            if (_theArrays[i].value == _theValue) {
	                _theArrays[i].state = true;
	                _theArrays[i].useObj = $(this);
	            } else {
	                if (typeof _theArrays[i].useObj == "object") {
	                    var _theObj = _theArrays[i].useObj;
	                    if (_theObj.attr("name") == $(this).attr("name")) {
	                        _theArrays[i].useObj = "";
	                        _theArrays[i].state = false;
	                    }
	                }
	            }
	        }
	        setSelectInfos(_theArrays);
	    });

	    $("select[name='question3']").change(function () {
	        var _theValue = $(this).val();
	        for (var i = 0; i < _theArrays.length ; i++) {
	            if (_theArrays[i].value == _theValue) {
	                _theArrays[i].state = true;
	                _theArrays[i].useObj = $(this);
	            } else {
	                if (typeof _theArrays[i].useObj == "object") {
	                    var _theObj = _theArrays[i].useObj;
	                    if (_theObj.attr("name") == $(this).attr("name")) {
	                        _theArrays[i].useObj = "";
	                        _theArrays[i].state = false;
	                    }
	                } else {
	                    _theArrays[i].useObj = "";
	                    _theArrays[i].state = false;
	                }
	            }
	        }
	        setSelectInfos(_theArrays);
	    });
        

	    function setSelectInfos(_theArrays, init) {
	        if (init == undefined) { init = 1; } 
	        if (init==0) { 
	            for (var i = 0 ; i < _theArrays.length ; i++) {
	                if (i == 0) {
	                    _theArrays[i].state = true;
	                    _theArrays[i].useObj = $("select[name='question1']");
	                }

	                if (i == 1) {
	                    _theArrays[i].state = true;
	                    _theArrays[i].useObj = $("select[name='question2']");
	                }

	                if (i == 2) {
	                    _theArrays[i].state = true;
	                    _theArrays[i].useObj = $("select[name='question3']"); 
	                    setSelectInfos(_theArrays);
	                }  
	            }
	        } else {
	            var _theSelectOption = "";
	            var _FristSelectionOptions = "";
	            var _SecondSelectionOptions = "";
	            var _ThirdSelectionOptions = "";
	            for (var i = 0 ; i < _theArrays.length ; i++) {
	                if (typeof _theArrays[i].useObj == "string") { 
	                    var _theValue = _theArrays[i].value;
	                    var _theText = _theArrays[i].text;
	                    _theSelectOption += "<option value = '" + _theValue + "'>" + _theText + "</option>";
	                } else {
	                    if (_theArrays[i].useObj.attr("name") == "question1") {
	                        _FristSelectionOptions += "<option selected value='" + _theArrays[i].value + "'>" + _theArrays[i].text + "</option>";
	                    }

	                    if (_theArrays[i].useObj.attr("name") == "question2") {
	                        _SecondSelectionOptions += "<option selected value='" + _theArrays[i].value + "'>" + _theArrays[i].text + "</option>";
	                    }

	                    if (_theArrays[i].useObj.attr("name") == "question3") {
	                        _ThirdSelectionOptions += "<option selected value='" + _theArrays[i].value + "'>" + _theArrays[i].text + "</option>";
	                    } 
	                }
	            }

	            _FristSelectionOptions += _theSelectOption;
	            _SecondSelectionOptions += _theSelectOption;
	            _ThirdSelectionOptions += _theSelectOption;

	            $("select[name='question1']").empty().html(_FristSelectionOptions);
	            $("select[name='question2']").empty().html(_SecondSelectionOptions);
	            $("select[name='question3']").empty().html(_ThirdSelectionOptions);
	        } 
	    }

	    setSelectInfos(_theArrays, 0);
         
	}





});

//页面加载成功后隔一段时间把loading效果去掉
window.onload=function(){
	setTimeout(function(){
		$("#loading").remove();
	},1500);
	
};


/*********************** 
* function：更新头部站内信信息
* Author  : ruiec_wzh（王志豪） 
* Parameters:  
* callBack：
*************************/
function ruiec_InsideLetter() {
   var oUrl = "http://" + window.location.host + "/user_account_msg_letter.html";  
   $.ajax({
	    type: "POST",
	    url: oUrl,
	    data: {"action":"getUserMess"},
        dataType: "json",
        success: function(data){
            var oCode = data.Code; //返回状态，1时为成功
            //console.log(oCode);
            if(oCode == 1)
            {
            	var NoReadCount = parseInt(data.Data.NoReadCount); //获取未读的站内信
            	var messageList = data.Data.Data == undefined ? [] : data.Data.Data; //获取站内信消息列表
            	if (messageList != null && messageList.length > 0) {
            	    var oInsertList = "";
            	    //生成站内信列表
            	    for (var a = 0; a < messageList.length; a++) {
            	        var messageList_title = messageList[a].title; //列表标题
            	        var messageList_url = messageList[a].url; //列表链接
            	        var oInsertList_item = '<p class="mList"><a href="' + messageList_url + '">【用户邮件】 ' + messageList_title + '</a></p>'
            	        oInsertList = oInsertList + oInsertList_item;
            	    };

            	    $("#myInfo .messageShow dd").empty().html(oInsertList);

            	} else {
            	    $(".messageShow").hide();
            	}
            	//给头部站内信数值赋值
            	if(NoReadCount>0)
            	{
            		$("#myInfo #message_num").text(NoReadCount);
            		$("#myInfo .messageShow dt small").text(NoReadCount);
            	}
            	else
            	{
            		$("#myInfo #message_num").text(0);
            		$("#myInfo .messageShow dt small").text(0);
            	};
            };
        }    
    });
}


/*********************** 
* function：获取我的余额进行更新
* Author  : ruiec_wzh 
* Parameters:  
* callBack：
*************************/
function ruiec_ajaxUpdateMoney() {
    $.ajax({
        type: "POST",
        url: "../../../tools/ssc_ajax.ashx",
        data: { "action": "get_user_money" },
        dataType: "json",
        success: function (data) {
            if (data.Code == 1 && data.Data!=null) { 
                var oMoney = data.Data[0]; //获取余额
                var oFHMoney = data.Data[1]; //获取余额
                oMoney = Number(oMoney);
                oFHMoney = Number(oFHMoney);
                if (isNaN(oMoney)) { oMoney = 0.00; }
                if (isNaN(oFHMoney)) { oFHMoney = 0.00; }

                oMoney = Math.floor(oMoney * 100) / 100;
                oFHMoney = Math.floor(oFHMoney * 100) / 100;

                $("#ky_money").empty().text(oMoney);
                $(".index_login_user .money_dj em").empty().text(oFHMoney);
                $("#get_money em").empty().text(oMoney);
                oMoney = isNaN(parseFloat(oMoney)) ? 0 : parseFloat(oMoney);
                $("#top_yuer").empty().text(oMoney);
            } 
        },
        error: function () {
            return false;
        }
    });
}


/*********************** 
* function：开户中心设置备注
* Author  : ruiec_wzh  
* Parameters: obj点击当前元素
* callBack：
*************************/
function ruiec_setLink(obj) {
    
    var oInsertDiv = '<input type="text" class="ty_text" />'
    art.dialog({
        title: '添加备注',
        content: oInsertDiv,
        lock: true,
        ok: function () {
            //alert("12");
            var text_obj = $(".aui_content .ty_text").val();
            var attr_obj = $(obj).attr("invite_id");
            $.post("user_account_proxy_managerurl.html", { action: "addCommt", commt: text_obj, invite_id:attr_obj }, function (data) {
                if (data.Code == 1) {
                    alert("提交成功");
                    $(obj).html('<i class="iconfont">&#xe64e;</i>' + text_obj);
                }
                else {
                    alert("提交失败")
                }
            })
        },
        cancel: function () { }
    });
}

/*********************** 
* function：开户中心删除链接列表
* Author  : ruiec_wzh  
* Parameters: obj点击当前元素
* callBack：
*************************/
function ruiec_deleteLink(obj) {
    var oInsertDiv = '你确定删除该条注册链接？'
    art.dialog({
        title: '温馨提示',
        content: oInsertDiv,
        lock: true,
        ok: function () {
            var attr_obj = $(obj).attr("invite_id");
            $.post("user_account_proxy_managerurl.html", { action: "delUrl", invite_id: attr_obj }, function (data) {
                if (data.Code == 1) {
                    alert("删除成功");
                    $(obj).parent().parent().empty();
                }
                else {
                    alert("删除失败")
                }
            })

        },
        cancel: function () { }
    });
}


/*********************** 
* function：会员管理发点击发送信息
* Author  : ruiec_wzh  
* Parameters: obj点击当前元素
* callBack：
*************************/
function ruiec_sendMsg(obj) {
    var oInsertDiv = '<div class="d_sendM">' +
						'<div class="d_sendM_tit"><label>主题：</label><input type="text" class="ty_text" maxlength="30"></div>' +
						'<div class="d_sendM_cont"><label>正文：</label><textarea  maxlength="300"></textarea></div>' +
					'</div>'
    art.dialog({
        title: '发送站内信息',
        content: oInsertDiv,
        lock: true,
        okVal: "发送",
        ok: function () { },
        cancel: function () { }
    });
}


/*********************** 
* function：input输入框只能输入数字（公用）,调用例子[$(".onlyNum").onlyNum()]
* Author  : ruiec_wzh  
* Parameters: 
* callBack：
*************************/
$.fn.onlyNum = function () {
    $(this).keypress(function (event) {
        var eventObj = event || e;
        var keyCode = eventObj.keyCode || eventObj.which;
        if ((keyCode >= 48 && keyCode <= 57))
            return true;
        else
            return false;
    }).focus(function () {
        //禁用输入法
        this.style.imeMode = 'disabled';
    }).bind("paste", function () {
        //获取剪切板的内容
        var clipboard = window.clipboardData.getData("Text");
        if (/^\d+$/.test(clipboard))
            return true;
        else
            return false;
    });
};


/*********************** 
* function：时间戳转日期时间（公用），调用例子[ruiec_DateToTime(1398250549490,true)]
* Author  : ruiec_wzh
* Parameters: oDate需要转化的时间戳,show=0时所有格式、show=1时转化成日期格式、show=2时转化为时间格式
* callBack：oCallBackTime 返回的时间 yyyy-MM-dd hh:mm:ss
*************************/
function ruiec_DateToTime(oDate,show) {
    // 例子，比如需要这样的格式：yyyy-MM-dd hh:mm:ss
    oDate=parseInt(oDate);
    var date = new Date(oDate);
    Y = date.getFullYear() + '-';
    M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
    D = (date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate())  + ' ';
    h = (date.getHours()<10 ? '0'+date.getHours():date.getHours()) + ':';
    m = (date.getMinutes()<10 ? '0'+date.getMinutes():date.getMinutes()) + ':';
    s = (date.getSeconds()<10 ? '0'+date.getSeconds():date.getSeconds());
    if(show==1)
    {
    	var oCallBackTime = Y + M + D;
   	}else if(show==2)
    {
    	var oCallBackTime = h + m + s;
   	}
    else
    {
   		var oCallBackTime = Y + M + D + h + m + s
    }
    return oCallBackTime;
}


/*********************** 
* function：日期转化成时间戳（公用），调用例子[ruiec_TimeToDate('2014-04-23 18:55:49:123')]
* Author  : ruiec_wzh
* Parameters: oTime需要转化的时间格式，如'2014-04-23 18:55:49:123'
* callBack：oDate 返回的时间戳 
*************************/
function ruiec_TimeToDate(oTime) {
    // 例子：yyyy-MM-dd hh:mm:ss 》》1398250549490
    date = new Date(oTime);
    oDate = date.getTime();
    return oDate;
}


/*********************** 
* function：hoverDelay,Hover延迟事件
* Author  : 王志豪<liangruxiang>  
* Parameters: 
* callBack：
*************************/
(function ($) {
    $.fn.hoverDelay = function (options) {
        var defaults = {
            hoverDuring: 200,          //hover延迟时间
            outDuring: 200,
            hoverEvent: function () {
                $.noop();
            },
            outEvent: function () {
                $.noop();
            }
        };
        var sets = $.extend(defaults, options || {});
        var hoverTimer, outTimer, that = this;
        return $(this).each(function () {
            $(this).hover(function () {
                clearTimeout(outTimer);
                hoverTimer = setTimeout(function () { sets.hoverEvent.apply(that) }, sets.hoverDuring);
            }, function () {
                clearTimeout(hoverTimer);
                outTimer = setTimeout(function () { sets.outEvent.apply(that) }, sets.outDuring);
            });
        });
    }
	

})(jQuery);

/******************** 
* function：重置alert事件
* Author  : ruiec_wzh  
* Parameters: ''
* callBack：调用了ruiec_wzh_alert()
*************************/
function ruiec_changeAlert() {
    var _alert = window.alert;
    MyAlert = function (text) {
        ruiec_NewAlert(text)
    };
    MyAlert.noConflict = function () {
        window.alert = _alert;
    };
    // expose API 
    window.alert = window.MyAlert = MyAlert;
}

/*********************** 
* function：重新定义alert弹出框
* Author  : ruiec_wzh  
* Parameters: text弹出内容，callback成功后返回
* callBack： 
*************************/
function ruiec_NewAlert(text, callback) {
	//先将之前的弹窗删除
	var list = art.dialog.list;
	for (var i in list) {
		list[i].close();
	};
    if (!callback) {
        callback = function () { };
    }
    art.dialog({
        content: text,
        ok: callback,
        lock: true
    });
};
 
/*********************** 
* function：获取url参数值
* Author  : ruiec_wzh  
* Parameters: name为参数名字
* callBack： 
*************************/
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}
 
/*********************** 
* function：公告弹出消息框
* Author  : ruiec_wzh  
* Parameters: msg,link,add_time提示消息，提示链接,添加时间
* callBack： 
*************************/
function ruiec_showNotice() {

    //公告通知
    var _theUrls = "http://" + window.location.host + "/user_account_msg_letter.html";
    $.ajax({
        type: "POST",
        url: _theUrls,
        data: { "action": "getAnnouncement" },
        dataType: "json",
        success: function (data) {
            if (data.Code == "1") {
                var _title = data.Data.title;
                var _content = data.Data.content;
                var _link = "";
                var _add_time = data.Data.post_time;

                showNoticMsg(_title, _content, _add_time);
            }
            
        }
    }); 
}; 

/*********************** 
* function：显示弹出框的信息
* Author  : ruiec_lrx   
*************************/
var _OldTitle, _OldContent;
function showNoticMsg(_title, _content, _add_time) {

    if (_add_time == undefined) { add_time = ""; } 
     
    if (_title == undefined || _title == "") { _title = "系统通知"; }
      
    var oNotice_insert = "<div id='notice2'>" + _content + "</a></div>";
 
    if (_OldTitle == undefined || _OldTitle != _title || _OldContent == undefined || _OldContent != _content) {
        _OldTitle = _title;
        _OldContent = _content; 
        //实时监测通知公告
        art.dialog({
            id: 'Notice',
            title: _title,
            content: oNotice_insert,
            width: 300,
            padding: "10px",
            left: '100%',
            top: '100%',
            fixed: true,
            drag: true,
            resize: false,
            time: 15
        }); 
    } 
} 

//取得cookie    
function getCookie(name) {    
 var nameEQ = name + "=";    
 var ca = document.cookie.split(';');    //把cookie分割成组    
 for(var i=0;i < ca.length;i++) {    
 var c = ca[i];                      //取得字符串    
 while (c.charAt(0)==' ') {          //判断一下字符串有没有前导空格    
 c = c.substring(1,c.length);      //有的话，从第二位开始取    
 }    
 if (c.indexOf(nameEQ) == 0) {       //如果含有我们要的name    
 return unescape(c.substring(nameEQ.length,c.length));    //解码并截取我们要值    
 }    
 }    
 return false;    
}    
    
//清除cookie    
function clearCookie(name) {    
 setCookie(name, "", -1);    
}    
    
//设置cookie    
function setCookie(name, value, seconds) {    
 seconds = seconds || 0;   //seconds有值就直接赋值，没有为0，这个根php不一样。    
 var expires = "";    
 if (seconds != 0 ) {      //设置cookie生存时间    
 var date = new Date();    
 date.setTime(date.getTime()+(seconds*1000));    
 expires = "; expires="+date.toGMTString();    
 }    
 document.cookie = name+"="+escape(value)+expires+"; path=/";   //转码并赋值    
}

/*********************** 
* function：网站首页滚动信息
* Author  : ruiec_lrx   
*************************/
function Scroll_Containers(container) {
    container.children("div").eq(0).animate({
        "height": "0px"
    }, 1000, function () {
        var theObj = container.children("div").eq(0);
        container.append(theObj);
        theObj.removeAttr("style");
    }); 
}
