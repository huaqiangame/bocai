// JavaScript Document 
//+----------------------------------------------------------------------
// | 版权所有：88375133@qq.com
//+----------------------------------------------------------------------
// | 网 址： 技术支持：88375133@qq.com
//+----------------------------------------------------------------------
// | Author: 梁汝翔 <liangruxiang >
//+----------------------------------------------------------------------
// | Date: 2015年7月28日 10:30:00
//+----------------------------------------------------------------------
// | Name: PageBasic.js ( 页面普通的JS效果和数据交互 )
//+----------------------------------------------------------------------

$(function () {

    /**
     * @content 判断浏览器的版本
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年7月28日 10:07:09
     */
    var _Agent = navigator.userAgent.toLowerCase();
    //IE浏览器
    if (_Agent.indexOf("msie") > 0) {
        var _regStr_ie = /msie [\d.]+;/gi;
        var _theBrowser = _Agent.match(_regStr_ie);
        var _theBanben = (_theBrowser + "").replace(/[^0-9.]/ig, "");
        _theBanben = isNaN(parseInt(_theBanben)) ? 9 : parseInt(_theBanben);
        if (_theBanben < 8) {
            if ($("body #json_jr").size() < 1) {
                var _JS_JSON2 = "<script id='json_jr'  type='text/javascript' src='/templates/SSC/js/JSON2.js?" + parseInt(Math.random() * 100000) + "'><\/script>";
                $("body").append($(_JS_JSON2));
            }
        }
    }

    /**
     * @content 点击退出
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年7月28日 10:07:09
     */
    if ($(".loginout").size() > 0) {
        $(".loginout").click(function () {
            var Ajax_api = "../tools/ssc_ajax.ashx";
            $.ajax({
                type: "POST",
                url: Ajax_api,
                data: {
                    action: "LogOut"
                },
                dataType: "json",
                success: function (data) {
                    if (data && data.Code == "1") {
                        window.location.href = "http://" + window.location.host + "/login.html";
                    } else {
                        alert(data.StrCode);
                    }
                }
            })


        })
    }

    /**
    * @content 微信充值
    * @author  梁汝翔<liangruxiang>  
    * @time 2015年8月20日 10:07:09
    */
    if ($("#WX_recharge_container").size() > 0) {
        //判断点击事件
        $("#WX_recharge_container .sub_btn").click(function () {
            var _theValues = $("#WX_recharge_container input[name='chargeMoney']").val();
            if (_theValues < 50 || _theValues > 50000) {
                alert("本平台最低充值为50元，单笔最高充值5万元，请调整您的充值金额。");
                return false;
            } 
            var theBankNumb = $("#WX_recharge_container #fastID_val").val();  //选择的银行
            if (theBankNumb == undefined) { theBankNumb = 1; }
            theBankNumb = isNaN(Number(theBankNumb)) ? 0 : Number(theBankNumb);
            if (theBankNumb > 0 && _theValues > 0) {
                if(theBankNumb==1){
                   window.location.href = "u_recharge.html?money="+_theValues;
                   return false;
                }

                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        action: 'add',
                        chargeMoney: _theValues,
                        fastID: theBankNumb
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.Code == 1) {
                            window.location.href = data.Data;
                        } else {
                            alert(data.StrCode);
                        }
                    }
                });
            } else {
                $("#WX_recharge_container input[name='chargeMoney']").focus();
            }
        });
    }


    if ($("#WXRechargeOrders").size() > 0) {
        $("#WXRechargeOrders #addOrders").click(function () {

            var _code = $("#WXRechargeOrders #fastCode").val();
            var _wxName = $("#WXRechargeOrders #wxName").val(); 
            if (_code == "WX" || _code == "ZFB") {
                if (_wxName == "" || _wxName == null) {
                    if(_code=="WX"){
                       alert("请填写付款微信账号！");
                    }else{
                       alert("请填写支付宝账号！");
                    }
                }
                else {
                    check_WXrecharge_order($(this));
                }
            }
            else {
                art.dialog({
                    'title': '充值确认',
                    'width': '170px',
                    'height': '75px',
                    'padding': '10px 20px',
                    'content': "<p style=\"margin-top: 14%; font-size: 15px;\">是否充值完成</p>",
                    cancel: true,
                    ok: function () {
                        $.ajax({
                            type: "POST",
                            url: "{config.webpath}aspx/SSC/user_account_fund_recharge10.aspx",
                            data: {
                                "action": "add",
                            },
                            dataType: "json",
                            success: function (data) {
                                if (data.Code == 1) {
                                    if (data.Code == 1) {
                                        alert(data.StrCode);
                                        var _localtionName = window.location.host == undefined ? '/index.html' : window.location.host;
                                        window.location.href = "http://" + _localtionName + "/index.html";
                                    } else {
                                        alert(data.StrCode);
                                    }
                                } else {
                                    alert(data.StrCode);
                                }
                            }
                        });
                    }
                });
            }
        });
    }

    /**
    * @content 判断是否存在未完成的微信充值订单
    * @name 梁汝翔<liangruxiang>
    * @time 2015年6月16日 16:20:00  
    * @param _obj 事件的触发对象
    */
    function check_WXrecharge_order(_obj) {
        if (_obj != undefined) {
            $.ajax({
                type: "POST",
                url: "",
                data: {
                    action: 'isOredr'
                },
                dataType: "json",
                success: function (data) {
                    if (data.Code == 1) {
                        if (data.Data != undefined && data.Data == true) {  //判断是否有订单存在
                            //显示未完成的充值订单信息
                            show_WXrecharge_Order(_obj);
                        } else {
                            art.dialog({
                                'title': '充值确认',
                                'width': '170px',
                                'height': '75px',
                                'padding': '10px 20px',
                                'content': "<p style=\"margin-top: 14%; font-size: 15px;\">是否充值完成</p>",
                                cancel: true,
                                ok: function () {
                                    //提交新的订单
                                    Add_WXrecharge_Order(_obj);
                                }
                            });
                        }
                    } else {
                        alert(data.StrCode);
                    }
                }
            })
        }
    }


    /**
     * @content 显示未完成的微信订单信息
     * @name 梁汝翔<liangruxiang>
     * @time 2015年6月16日 16:20:00  
     * @param _obj 事件的触发对象
     */
    function show_WXrecharge_Order(_obj) {
        $.ajax({
            type: "POST",
            url: "",
            data: {
                action: 'getnewOrder'
            },
            dataType: "json",
            success: function (data) {
                if (data.Code == 1) {

                    var theShowContainer = "";
                    var strVar = "";
                    var charge_account_ID = data.Data.bankpay_record_ID == undefined ? 0 : data.Data.bankpay_record_ID;//ID
                    var chargeMoney = data.Data.chargeMoney == undefined ? 0 : data.Data.chargeMoney;//充值金额
                    var charge_type = data.Data.charge_type == undefined ? "ZFB" : data.Data.charge_type;//进账类型
                    var recvUserName = data.Data.recvUserName == undefined ? "" : data.Data.recvUserName;//收款人
                    var mess = data.Data.mess == undefined ? "" : data.Data.mess;//附言码
                    var recvCode = data.Data.recvEmail == undefined ? "" : data.Data.recvEmail;//收款邮箱
                    var recvAccount = data.Data.recvAccount == undefined ? "" : data.Data.recvAccount;//收款账号
                    var verCodeUrl = data.Data.verCodeUrl == undefined ? "" : data.Data.verCodeUrl;//二维码
                    var theType = 44;

                    strVar += "<div class='recharge_order_infos'>";
                    strVar += "	<p class=\"wd-title\">对不起，您尚有一笔充值申请未完成，请完成后再发起<\/p>";
                    strVar += "	<div>";
                    strVar += "		<table border=\"0\" cellpadding=\"0\" cellspacing=\"10\" width=\"100%\">";
                    strVar += "		  <tbody>";
                    strVar += "		  <tr>";
                    strVar += "			<td class=\"wd-td-bold\" align=\"right\" width=\"60\">充值银行：<\/td>";
                    strVar += "			<td><span class=\"selectBank icon_bank bank_" + charge_type + "\" name=\"" + charge_type + "\" val=\"44\"><\/span><\/td>";
                    strVar += "		  <\/tr>";
                    strVar += "		  <tr>";
                    strVar += "			<td class=\"wd-td-bold\" align=\"right\">充值金额：<\/td>";
                    strVar += "			<td style=\"color:red\">" + chargeMoney + "元<\/td>";
                    strVar += "		  <\/tr>"
                    strVar += "		  <tr>";
                    strVar += "			<td class=\"wd-td-bold\" align=\"right\">收款人：<\/td>";
                    strVar += "			<td style=\"color:red\">" + recvUserName + "<\/td>";
                    strVar += "		  <\/tr>"
                    strVar += "		  <tr>";
                    strVar += "			<td class=\"wd-td-bold\" align=\"right\">收款账号：<\/td>";
                    strVar += "			<td style=\"color:red\">" + recvAccount + "<\/td>";
                    strVar += "		  <\/tr>"
                    strVar += "		  <tr>";
                    strVar += "			<td class=\"wd-td-bold\" align=\"right\">附言码：<\/td>";
                    strVar += "			<td style=\"color:red\">" + mess + "<\/td>";
                    strVar += "		  <\/tr>"
                    strVar += "	  <\/tbody>";

                    if (verCodeUrl != "") {
                        strVar += "<span style=\"display: inherit;float: right;position: absolute;right: 11px;top: 78px;\">	<img src=\"" + verCodeUrl + "\" height=\"105\" width=\"105\"><\/span>";
                    }
                    strVar += "<\/table>";

                    strVar += "		<p class=\"wd-control-panel\">";
                    strVar += "			您还可以 &nbsp;&nbsp;&nbsp;&nbsp;";
                    strVar += "			<input class=\"btn btn-important\" style=\"padding: 5px 5px;background-color: #d21e1e;color: #FFF;\" id=\"WX-button-order-cancel\" user_tenpay_record_ID='" + charge_account_ID + "' value=\"撤销申请\" type=\"button\">";
                    strVar += "			&nbsp;&nbsp;";
                    strVar += "			<input class=\"btn btn-important\" style=\"padding: 5px 5px;background-color: #d21e1e;color: #FFF;\" id=\"WX-button-order-cancel\"  onclick=\"CloseOrder()\" value=\"完成订单\" type=\"button\">";
                    strVar += "			&nbsp;&nbsp;";
                  
                    strVar += "		<\/p>";


                    strVar += "		<p class=\"wd-tip\">";
                    strVar += "			* 如您已完成付款，请勿撤销，我们将尽快为您处理。";
                    strVar += "		<\/p>";
                    strVar += "	<\/div>";
                    strVar += "<\/div>";

                    //显示已有订单弹窗
                    WXshow_order_layout(_obj, strVar, theType);
                } else {
                    alert(data.StrCode);
                }
            }
        });
    }

    function WXshow_order_layout(_obj, contHtml, theType) {
        art.dialog({
            'title': '温馨提示',
            'width': '450px',
            'height': '250px',
            'padding': '20px',
            'content': contHtml
        });

        //点击撤销申请
        $("#WX-button-order-cancel").click(function () {
            if (theType == "44" || theType == "44") {
                var theValue = $(this).attr("user_tenpay_record_ID") == undefined ? "" : $(this).attr("user_tenpay_record_ID");
                if (theValue != "") {
                    $.ajax({
                        type: "post",
                        url: "",
                        data: {
                            action: 'cheDan',
                            bankpay_record_ID: theValue
                        },
                        dataType: "JSON",
                        success: function (data) {
                            if (data && data.Code == 1) {
                                alert(data.StrCode);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);
                            }
                        }
                    })
                }
            }

        });

    }

    /**
    * @content 添加新的微信订单信息
    * @name 梁汝翔<liangruxiang>
    * @time 2015年6月16日 16:20:00  
    * @param _obj 事件的触发对象
    */
    function Add_WXrecharge_Order(_obj) {
        var theMessage = $("#WXRechargeOrders #wxName").val(); //充值的金额
        if (theMessage != "") {
            $.ajax({
                type: "post",
                url: "",
                data: {
                    action: 'add',
                    message: theMessage
                },
                dataType: "json",
                success: function (data) {
                    if (data.Code == 1) {
                        window.location.href = window.location.origin + "/u_center.html";
                    } else {
                        alert(data.StrCode);
                    }
                }
            });
        }
        else {
            alert("请输入付款账号！");
        }
    }


    /**
     * @content 站内信管理
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#Account_Msg_Letter").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": [], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function Account_Msg_LetterFn(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1" && data.Data != null) {

               // var _TrData = data.Data.Messages == undefined ? {} : data.Data.Messages;
                 var _TrData = data.Data.Messages||data.Data.Data||{};
                if (_TrData.length >= 0) { $(".Account_Msg_LetterList").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
               console.log(_TrData);
                  var strVar = "";
                     if (data.Data.Messages) {
                            strVar += "<li class='ui-border-t'>";
                            strVar += " <a href='" + _TrData[i].url + "'>";
                            strVar +=" <div class='ui-row-flex ui-whitespace'>"+ 
                                      "<div class='ui-col ui-col-4' style='width:50%;'>"+
                                       "<p class='fz14'>【"+_TrData[i].title+"】</p></div></div>";  
                            strVar +="<div class='ui-row-flex ui-whitespace' >"+
                                       "<div class='ui-col ui-col-4'>"+
                                       " <p class='c_8 fz12 c_blue'>"+"内容"+"</p></div></div>";
                            strVar +=" <div class='ui-row-flex ui-whitespace'>"+
                                     "       <div class='ui-col ui-col-4'>"+
                                     "           <p class='c_8 fz12'>"+_TrData[i].post_time+"</p>"+
                                     "       </div></div>"; 
                            strVar += " </a>";
                            strVar += "</li>";
                     }
                     if (data.Data.Data) {
                               strVar += "<li class='ui-border-t'>";
                            strVar += " <a href='" + _TrData[i].url + "'>";
                            strVar +=" <div class='ui-row-flex ui-whitespace'>"+ 
                                      "<div class='ui-col ui-col-4' style='width:50%;'>"+
                                       "<p class='fz14'>"+_TrData[i].title+"</p></div></div>";  
                           
                            strVar +=" <div class='ui-row-flex ui-whitespace'>"+
                                     "       <div class='ui-col ui-col-4'>"+
                                     "           <p class='c_8 fz12'>"+_TrData[i].add_time+"</p>"+
                                     "       </div></div>"; 
                            strVar += " </a>";
                            strVar += "</li>";
                     }

                    var theHtml = $(strVar);
                    $(".Account_Msg_LetterList").append(theHtml);
                }

                var _pageTotal = data.Data.DataCount;
                var _pageShow = 10;
                var _pageCurr = data.Data.PageIndex;
                var _pageFn = doPageCallBack; //点击分页事件的回调函数
                var _pagecontaier = $("#lrx_ty_page");
                /**
                * @param total 总条数 
                * @param show 每页显示多少条 
                * @param curr 当前选中的是第几页
                * @param contaier 分页字符串容器 
                * @param fn 分页后的回调函数  
                */
              //  Lrx_JsPage(_pageTotal, _pageShow, _pageCurr, _pagecontaier, _pageFn, _InitCallback);
                //_pagecontaier.attr("PageSearchConditionArray", initcond); 
            }
        }
        
        _InitPageData("Account_Msg_Letter", condition_array, Account_Msg_LetterFn);
         
        //全选
        $("#Account_Msg_Letter #check_letter").click(function () { 
            if ($(this).is(":checked")) {
                $("#Account_Msg_Letter").find("input.ch").prop("checked", true);
            } else {
                $("#Account_Msg_Letter").find("input.ch").prop("checked", false);
            }
        });

        //标记已读
        $("#Account_Msg_Letter .is_readBtn").click(function () {
            var CheckMsgId = "";
            $("#Account_Msg_Letter").find("input.ch").each(function () {
                if ($(this).is(":checked")) {
                    var theValue = $(this).val();
                    CheckMsgId += theValue + "@";
                }
            });

            if (CheckMsgId != "") {
                CheckMsgId = CheckMsgId.substr(0, CheckMsgId.length - 1);
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        action: "update",
                        letterid: CheckMsgId
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.Code == "1") {
                            //alert("标记成功");
                            window.location.reload();
                        } else {
                            alert(data.StrCode);
                        }
                    }
                });
            }

        })

        //删除选中的内容
        $("#Account_Msg_Letter .is_delet").click(function () {
            var CheckMsgId = "";
            $("#Account_Msg_Letter").find("input.ch").each(function () {
                if ($(this).is(":checked")) {
                    var theValue = $(this).val();
                    CheckMsgId += theValue + "@";
                }
            });

            if (CheckMsgId != "") {
                CheckMsgId = CheckMsgId.substr(0, CheckMsgId.length - 1);
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        action: "del",
                        letterid: CheckMsgId
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.Code == "1") {
                            // alert("删除成功");
                            window.location.reload();
                        } else {
                            alert(data.StrCode);
                        }
                    }
                });
            }
        })
    }

    /**
     * @content 投注大厅，倍数的change事件限定
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年8月12日 10:07:09
     */
    $("#choice_Multiple").change(function () {
        var theValue = $(this).val();
        if (isNaN(parseInt(theValue))) {
            theValue = 1;
        } else {
            if (parseInt(theValue) < 1) {
                theValue = 1;
            }

            if (parseInt(theValue) > 9999) {
                theValue = theValue.toString();
                theValue = theValue.replace(/[^\d]/g, "");
                theValue = isNaN(parseInt(theValue)) ? 9999 : parseInt(theValue);
            }
        }
        $(this).val(theValue);
    });

    /**
     * @content 投注大厅，开奖号码
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年8月12日 10:07:09
     */
    if ($(".open_lotteryNumb_chart").size() > 0) {
        /*var I_get_lotteryCode = $("#container .gameBet").attr("id") == undefined ? "gameId_1000" : $("#container .gameBet").attr("id");
        var I_theCode = I_get_lotteryCode.split("_") == undefined ? "1000" : I_get_lotteryCode.split("_")[1];*/
        var I_get_lotteryCode = getQueryString("lottery"); //获取链接当前的玩法代码
        var I_theCode = I_get_lotteryCode == undefined ? "1000" : I_get_lotteryCode;
        $(".open_lotteryNumb_chart").each(function () {
            var theJumpUrl = "/tender_chart/" + I_theCode + ".html";
            $(this).attr("href", theJumpUrl);
        });
    }


    /**
     * @content 安全问题
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年7月28日 10:07:09
     */
    if ($(".u_questionedit").size() > 0) {

        $(".u_questionedit #form1 .ty_btn[type='submit']").unbind("click").click(function (event) {
            event.stopPropagation();

            var theFirstValue = $(".u_questionedit #form1 select[name='question1']").val();
            var theSecondValue = $(".u_questionedit #form1 select[name='question2']").val();
            if (theFirstValue != undefined && theSecondValue != undefined && theFirstValue == theSecondValue) {
                alert("两个问题不能相同");
                return false;
            } else {
                var theAnswer_1 = $(".u_questionedit #form1 input[name='answer1']").val();
                var theAnswer_2 = $(".u_questionedit #form1 input[name='answer2']").val();
                if (theAnswer_1 == "" || theAnswer_2 == "") {
                    alert("安全问题填写不完整，请完善");
                    $(".u_questionedit #form1 input[name='answer1']").focus();
                    return false;
                }
            }
        });


        /**
         * @content 银行卡号验证
         * @author  梁汝翔<liangruxiang >  
         * @time 2015年7月28日 10:07:09
         */
        $(".yz_card").blur(function () {
            var theValue = $(this).val() == undefined ? "16245" : $(this).val().toString();
            var theVal_len = theValue.length;
            if (theVal_len < 14) {
                $(this).addClass("Validform_error");
                $(this).next(".Validform_checktip").addClass("Validform_wrong").empty().text("银行卡格式有误");
                //$(this).focus();
                return false;
            }
        });

        /**
         * @content 提现银行卡认证
         * @author  梁汝翔<liangruxiang >  
         * @time 2015年7月28日 10:07:09
         */
        $(".yz_num[name='withdrawMoney']").blur(function () {
            var theValue = isNaN(parseInt($(this).val())) == undefined ? 100 : parseInt($(this).val());

            if (theValue < 100) {
                $(this).addClass("Validform_error");
                $(this).next(".Validform_checktip").addClass("Validform_wrong").empty().text("最低提现金额为100元");
                $(this).focus();
                return false;
            }
        })

    }

    /**
     * @content 会员中心个人资料修改
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#user_personaInfos").size() > 0) {

        /**
         * @content 个人资料Form表单提交
         * @author  梁汝翔<liangruxiang >  
         * @time 2015年7月28日 10:07:09
         */
        $("#user_personaInfos .sub_btn").click(function () {

            var theSex = $("#user_personaInfos input[type='radio'][name='m']:checked").val();  //性别
            var thePhone = $("#user_personaInfos input.yz_phone").val(); //手机号码
            var theWdate = $("#user_personaInfos input.Wdate").val();  //生日
            //var theyz_passwrod = $("#user_personaInfos input.yz_passwrod").val();  //安全码
            var thisCode = $("#user_personaInfos input.yz_code").val();
            var theQQ_Array = new Array();

            var thelength = $("#user_personaInfos .qq_lentr").size();
            if (thelength > 0) {
                $("#user_personaInfos .qq_lentr").each(function () {
                    var theTRQQ_Obj = {};
                    var theQQ_Name = $(this).find(".yz_user").eq(0).val();
                    var theQQ_Num = $(this).find(".yz_qq").eq(0).val();
                    if (theQQ_Name != "" && theQQ_Num != "") {
                        theTRQQ_Obj.qqName = theQQ_Name;
                        theTRQQ_Obj.qqNum = theQQ_Num;
                        theQQ_Array.push(theTRQQ_Obj);
                    }
                });
            }

            var theQQArry_Json = Json_To_String(theQQ_Array);

            if (thisCode != "") {
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        sex: theSex,
                        phone: thePhone,
                        birthday: theWdate,
                        //saftyPwd: theyz_passwrod,
                        QQData: theQQArry_Json,
                        code: thisCode
                    },
                    dataType: "JSON",
                    success: function (data) {
                        if (data) {
                            if (data.Code == 1) {
                                alert(data.StrCode);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 200);
                            } else {
                                alert(data.StrCode);
                            }
                        }
                    }
                });
            } else {
                alert("请填写验证码");
                $("#user_personaInfos input.yz_passwrod").focus();
                return false;
            }

        });

        /**
         * @content 个人资料 QQ信息添加
         * @author  梁汝翔<liangruxiang >  
         * @time 2015年7月28日 10:07:09
         */
        $("#user_personaInfos .add_qline").click(function () {
            var strVar = "";
            strVar += "<tr class=\"qq_lentr\">";
            strVar += "    <th scope=\"row\">QQ设置：<\/th>";
            strVar += "    <td>";
            strVar += "        <input type=\"text\" class=\"ty_text w100 yz_user \" value=\"\" datatype=\"s6-20\" nullmsg=\"请填写QQ名称！\" \/>";
            strVar += "        <input type=\"text\" class=\"ty_text w100 yz_qq \" value=\"\" datatype=\"n5-10\" nullmsg=\"请填写QQ号码！\" \/> ";
            strVar += "    	    <a class=\"alink fw_600 del_qline\" href=\"javascript:void(0)\"><i class=\"iconfont\">-<\/i>删除<\/a>";
            strVar += "    <span class=\"Validform_checktip \"><\/span><\/td>";
            strVar += "<\/tr>";
            var theSub_TR = $("#user_personaInfos").find(".sub_btn").eq(0).parents("tr");
            theSub_TR.before($(strVar));
        });

        /**
         * @content 个人资料 QQ信息删除
         * @author  梁汝翔<liangruxiang >  
         * @time 2015年7月28日 10:07:09
         */
        $("#user_personaInfos").on("click", ".del_qline", function () {
            var theTrObj = $(this).parents("tr").eq(0);
            theTrObj.remove();
        });
    }


    /**
     * @content 整站右侧的浮动JS链接管理
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#TendChart_Float").size() > 0) {
        var TheLotteryCode = '1000';
        if ($("#j_play_select").size() > 0) {
            var TheLotteryCodeString = $(".gameBet").attr("id") == undefined ? "gameId_1000" : $(".gameBet").attr("id");
            TheLotteryCode = TheLotteryCodeString.split("_")[1] == undefined ? "1000" : TheLotteryCodeString.split("_")[1];
        }
        var theUrl = $("#TendChart_Float").attr("root_value") + "tender_chart/" + TheLotteryCode + ".html";
        $("#TendChart_Float").attr("href", theUrl);
    }


    /**
     * @content 右侧浮动联系上级的js效果
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#contact_up").size() > 0) {
        $("#contact_up").click(function () {
            //tencent://message/?uin=429838872 
            var theContact = $(this).attr("value") == undefined ? "" : $(this).attr("value");
            if (theContact != "") {
                var theSplitArray = theContact.split("@");
                if (theSplitArray.length > 2) {
                    var theChildList = "";
                    if (theSplitArray != undefined) {
                        theChildList += "<div class='send_msg_listUserCont' style='overflow:hidden;'>";
                        theChildList += "<ul class='send_msg_li'>";
                        for (var i = 0 ; i < theSplitArray.length ; i++) {
                            theChildList += "<li class='child_user' style='width:auto;'><a href='tencent://message/?uin=" + theSplitArray[i] + "'><i class='iconfont'></i>" + theSplitArray[i] + "</a></li>";
                        }
                        theChildList += "</ul></div>";
                    }

                    if (theChildList != "") {
                        art.dialog({
                            'title': '选择上级QQ',
                            'width': '210px',
                            'height': '150px',
                            'padding': '10px 20px',
                            'content': theChildList
                        });
                    }
                } else {
                    var theNewUrl = "tencent://message/?uin=" + theSplitArray[0];
                    $(this).attr("href", theNewUrl);
                    return true;
                }
            } else {
                return false;
            }
        });
    }

    /**
     * @content 撤单js效果
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年7月28日 10:07:09
     */
    if ($(".rui_cedan_btn").size() > 0) {
        $("body").on("click", ".rui_cedan_btn", function () {
            var the_CD_Id = $(this).attr("lottery_orders_id");
            var the_CD_type = $(this).attr("cheType");
            artDialog({
                icon: "warning",
                ok: function () {
                    if (the_CD_Id != undefined && the_CD_Id != "") {
                        $.ajax({
                            type: "post",
                            url: "",
                            data: {
                                action: "cheDan",
                                orders_id: the_CD_Id,
                                cheType: the_CD_type
                            },
                            dataType: "json",
                            success: function (data) {
                                if (data != undefined && data.Code == 1) {
                                    $(".rui_cedan_btn").remove();
                                    window.location.reload();
                                } else {
                                    alert(data.StrCode);

                                }
                            }
                        })
                    }
                },
                cancel: function () { },
                lock: true,
                content: "撤单不可恢复,确认撤单?"
            })
        });
    }
     $("#Game_CheckBall").unbind().click(function () { 
         $(".play_select_container").css("display","none");
         $("#fn_getoPenGame").css("display","none");
         $("#PageSwitch").css("display","none");
});
    /**
     * @content 投注大厅撤单js
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年7月28日 10:07:09
     */
    $("body").on("click", ".tz_cedan_btn", function () {
       
        var the_CD_Id = $(this).attr("lottery_orders_id");
        artDialog({
            icon: "warning",
            ok: function () {
                if (the_CD_Id != undefined && the_CD_Id != "") {
                    var theUrl = "http://" + window.location.host + "/user_account_invest_tzDetail/" + the_CD_Id + ".html";

                    $.ajax({
                        type: "post",
                        url: theUrl,
                        data: {
                            action: "cheDan",
                            lottery_orders_id: the_CD_Id
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data != undefined && data.Code == 1) {
                                artDialog({
                                    icon: "success",
                                    ok: function () {
                                        if ($("#fn_getMyProjects").size() < 1) {
                                            window.location.reload();
                                        }
                                    },
                                    content: data.StrCode,
                                    close: function () {
                                        if ($("#fn_getMyProjects").size() < 1) {
                                            window.location.reload();
                                        }
                                    }
                                });
                            } else {
                                alert(data.StrCode);

                            }
                        }
                    })
                }
            },
            cancel: function () { },
            lock: true,
            content: "撤单不可恢复,确认撤单?"
        })
    });

    /**
     * @content 网站公告列表
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#news_contents").size() > 0) {

        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": [], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function news_contents_ListFn(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1" && data.Data != null) {
                var _TrData = data.Data.Data == undefined ? {} : data.Data.Data;
                if (_TrData.length >= 0) { $("#news_contents").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var strVar = "";
                    strVar += "<li class='news_li'>";
                    strVar += "    <a href='" + _TrData[i].url + "'>" + _TrData[i].title + "</a>";
                    strVar += "    <span class='CreatTime'>" + _TrData[i].add_time + "</span>";
                    strVar += "</li>";
                    var theHtml = $(strVar);
                    $("#news_contents").append(theHtml);
                }

                var _pageTotal = data.Data.DataCount;
                var _pageShow = 10;
                var _pageCurr = initcond.PageIndex == undefined ? 1 : initcond.PageIndex;
                var _pageFn = doPageCallBack; //点击分页事件的回调函数
                var _pagecontaier = $("#lrx_ty_page");
                /**
                * @param total 总条数 
                * @param show 每页显示多少条 
                * @param curr 当前选中的是第几页
                * @param contaier 分页字符串容器 
                * @param fn 分页后的回调函数  
                */
                Lrx_JsPage(_pageTotal, _pageShow, _pageCurr, _pagecontaier, _pageFn, _InitCallback);
                //_pagecontaier.attr("PageSearchConditionArray", initcond); 
            }
        }
        _InitPageData("news_contents", condition_array, news_contents_ListFn);

    }
    /**
        * @content 我要充值
        * @author  梁汝翔<liangruxiang>  
        * @time 2015年8月20日 10:07:09
        */
    if ($("#recharge_container").size() > 0) {

        //判断点击事件
        $("#recharge_container .sub_btn").click(function () {
            var theBankNumb = $("#recharge_container #fastID_val").val();  //选择的银行
            if (theBankNumb == undefined) { theBankNumb = 1; }
            theBankNumb = isNaN(Number(theBankNumb)) ? 0 : Number(theBankNumb);
            var theMoney = $("#recharge_container input[name='money']").val(); //充值的金额
            theMoney = isNaN(Number(theMoney)) ? 0 : Number(theMoney);

            if (theBankNumb > 0 && theMoney > 0) {
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        action: 'add',
                        money: theMoney,
                        ChannelNo: theBankNumb
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.Code == 1) {
                            window.location.href = data.Data;
                        } else {
                            alert(data.StrCode);
                            return false;
                        }
                    }
                });
            } else {
                $("#recharge_container input[name='money']").focus();
            }
        });
    }

    /**
     * @content 充值确认
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($("#rechargeOrder4").size() > 0) {
        $("#rechargeOrder4 .rechargeOk").click(function () {
//            var theMoney = $("#rechargeOrder4 input[name='money']").val(); //充值的金额
//            var theMessage = $("#rechargeOrder4 input[name='message']").val(); //付款人姓名
//            theMoney = isNaN(Number(theMoney)) ? 0 : Number(theMoney);

//            if (theMoney > 0) {
//                check_recharge_order($(this));
//            } else {
//                $("#rechargeOrder4 input[name='money']").focus();
//            } 

        });
    }

    /**
     * @content 关闭购彩大厅的导航栏
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年8月20日 10:07:09
     */
    if ($("#j_play_select").size() > 0) {
        $("#header .nav").hide();
    } else {
        $("#header .nav").show();
    }

    /**
     * @content 删除银行卡
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年8月20日 10:07:09
     */
    if ($("#bank_cardManage").size() > 0) {
        $("#bank_cardManage .del_bank").click(function () {
            var theBankCard = $(this).attr("bank_id") == undefined ? 0 : Number($(this).attr("bank_id"));
            if (theBankCard > 0) {
                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        action: "delBankCard",
                        bank_id: theBankCard
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.Code != undefined && data.Code == 1) {
                            alert(data.StrCode);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000)
                        } else {
                            alert(data.StrCode);
                        }
                    }
                })
            }
        });
    }


    /**
     * @content 处理开奖号码过长把页面挤开的情况
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年8月20日 10:07:09
     */
    if ($(".invest .open_numbers").size() > 0) {
        $(".invest .open_numbers").each(function () {
            var theText = $(this).text();
            if (theText.toString().length > 16) {
                var theNewText = theText.substr(0, 16);
                var theNewString = theNewText + "...<a href='javascript:void(0)' class='look_open_number' value='" + theText + "'>详细</a>";
                $(this).empty().html(theNewString);
            }
        });

        $(".invest .open_numbers").on("click", ".look_open_number", function () {
            var theValue = $(this).attr("value") == undefined ? "" : $(this).attr("value");
            if (theValue != "") {
                artDialog({
                    content: "<div style='max-height:300px; max-width:500px; overflow-y:auto;word-break:break-all;'>" + theValue + "</div>"
                })
            }
        });
    }

    /**
     * @content 右侧滑动的显示展开效果
     * @author  梁汝翔<liangruxiang >  
     * @time 2015年8月20日 10:07:09
     */
    if ($("#fixedMenu").size() > 0) {
        $("#fixedMenu .arrow_infos").click(function () {
            $("#fixedMenu").find("ul").stop(true, true).animate({
                width: "70px"
            }, 380, function () {
                $("#fixedMenu").find("ul").css("border", "1px solid #009700");
                $("#fixedMenu .arrow_infos").hide().css("border", "0px");
            })
        });
        $("#fixedMenu").mouseleave(function () {
            $("#fixedMenu").find("ul").stop(true, true).animate({
                width: "0px"
            }, 380, function () {
                $("#fixedMenu").find("ul").css("border", "0px");
                $("#fixedMenu .arrow_infos").show().removeAttr("style");
            })
        })
    }

    if ($("#QuickRecharge_container").size() > 0) {
        $("#QuickRecharge_container .sub_btn").click(function () {
            var _theValues = $("#QuickRecharge_container input[name='chargeMoney']").val();
            if (_theValues < 50 || _theValues > 50000) {
                alert("本平台最低充值为50元，单笔最高充值5万元，请调整您的充值金额。");
                return false;
            }
        });
    }


});
/**
 * @content 初始化容器的数据
 * @author  梁汝翔<liangruxiang >  
 * @param cont_id:容器
 * @param initcond 获取的初始化条件
 * @explame : { "byid": ['lotteryId', 'qh', 'StartTime', 'EndTime', 'NumberingScheme'], "byChildCurr": ['Time_zone', 'Time_Status'], 'byAttrValue': [] };
              //byid 表示通过 $("#id").val();
              //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
              //byAttrValue 表示通过 $("#id").attr("value");
 * @param callback：回调函数
 * @time 2015年8月2日 10:07:09
 */
function _InitPageData2(_theGetDataApi,cont_id, initcond, callback) {
    var _theContainerObj = $("#" + cont_id);

    //var _theGetDataApi = $(this).attr("url") == undefined ? "" : $(this).attr("url");  //获取容器内部数据的url 

    var ThePageObj = $("#lrx_ty_page").size() > 0 ? $(".ty_page") : $("#lrx_ty_page");
    var InitCallback = callback;
    if (typeof initcond == 'object') {

        var _StrInitCond = Json_To_String(initcond);
        ThePageObj.attr("initcond", _StrInitCond);
        ThePageObj.attr("cont_id", cont_id);
    }

    //获取容器中的初始查询条件
    var _InitCondition = _GetContainer_InitCondition(cont_id, initcond);

    if (_InitCondition != "" && typeof _InitCondition == 'object') {
        _InitCondition.action = "getData";
        $.ajax({
            type: "post",
            url: _theGetDataApi,
            data: _InitCondition,
            dataType: "json",
            success: function (data) {
                var theState = data.Code == undefined ? data.code : data.Code;
                if (data && theState == "1") {
                    callback(data, initcond, InitCallback);
                } else {
                    alert(data.StrCode);
                }
            }
        });
    }

}
/**
 * @content 初始化容器的数据
 * @author  梁汝翔<liangruxiang >  
 * @param cont_id:容器
 * @param initcond 获取的初始化条件
 * @explame : { "byid": ['lotteryId', 'qh', 'StartTime', 'EndTime', 'NumberingScheme'], "byChildCurr": ['Time_zone', 'Time_Status'], 'byAttrValue': [] };
              //byid 表示通过 $("#id").val();
              //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
              //byAttrValue 表示通过 $("#id").attr("value");
 * @param callback：回调函数
 * @time 2015年8月2日 10:07:09
 */
function _InitPageData(cont_id, initcond, callback) {
    var _theContainerObj = $("#" + cont_id);

    var _theGetDataApi = $(this).attr("url") == undefined ? "" : $(this).attr("url");  //获取容器内部数据的url 

    var ThePageObj = $("#lrx_ty_page").size() > 0 ? $(".ty_page") : $("#lrx_ty_page");
    var InitCallback = callback;
    if (typeof initcond == 'object') {

        var _StrInitCond = Json_To_String(initcond);
        ThePageObj.attr("initcond", _StrInitCond);
        ThePageObj.attr("cont_id", cont_id);
    }

    //获取容器中的初始查询条件
    var _InitCondition = _GetContainer_InitCondition(cont_id, initcond);

    if (_InitCondition != "" && typeof _InitCondition == 'object') {
        _InitCondition.action = "getData";
        $.ajax({
            type: "post",
            url: _theGetDataApi,
            data: _InitCondition,
            dataType: "json",
            success: function (data) {
                var theState = data.Code == undefined ? data.code : data.Code;
                if (data && theState == "1") {
                    callback(data, initcond, InitCallback);
                } else {
                    alert(data.StrCode);
                }
            }
        });
    }

}

/**
 * @content 初始化容器的数据
 * @author  梁汝翔<liangruxiang >  
 * @param cont_id:容器
 * @param callback：回调函数
 * @time 2015年8月2日 10:07:09
 */
function _GetContainer_InitCondition(cont_id, initcond) {
    var _Getresult_infos;
    var _theContainerObj = $("#" + cont_id);

    var _result_infos = "{";
    //获取byid的内容  
    var _theById_len = initcond.byid.length;
    for (var i = 0 ; i < _theById_len ; i++) {
        var theId = _theContainerObj.find("#" + initcond.byid[i]).eq(0).val() == undefined ? "" : _theContainerObj.find("#" + initcond.byid[i]).eq(0).val();
        _result_infos += '"' + initcond.byid[i] + '":"' + theId + '"';
        if (i + 1 < _theById_len) {
            _result_infos += ",";
        }
    }
    if (_theById_len > 0) { _result_infos += ","; }

    //获取byChildCurr .attr("value");
    var _theByChildCurr_len = initcond.byChildCurr.length;
    for (var i = 0 ; i < _theByChildCurr_len ; i++) {
        var theValue = _theContainerObj.find("#" + initcond.byChildCurr[i]).eq(0).find(".curr").eq(0).attr("value");
        if (theValue == undefined) { theValue = ""; }
        _result_infos += '"' + initcond.byChildCurr[i] + '":"' + theValue + '"';
        if (i + 1 < _theByChildCurr_len) {
            _result_infos += ",";
        }
    }
    if (_theByChildCurr_len > 0) { _result_infos += ","; }

    //获取byAttrValue .attr("value");
    var _theByAttrValue_len = initcond.byAttrValue.length;
    for (var i = 0 ; i < _theByAttrValue_len ; i++) {
        var theValue2 = _theContainerObj.find("#" + initcond.byAttrValue[i]).eq(0).attr("value");
        if (theValue2 == undefined) { theValue2 = ""; }
        _result_infos += '"' + initcond.byAttrValue[i] + '":"' + theValue2 + '"';
        if (i + 1 < _theByAttrValue_len) {
            _result_infos += ",";
        }
    }

    var _thePageIndex = initcond.PageIndex;
    _result_infos += '"Index":"' + _thePageIndex + '"';  //分页的参数

    _result_infos += "}";
    if (_result_infos == undefined) {
        _Getresult_infos = {};
    } else {
        _Getresult_infos = eval("(" + _result_infos + ")");
    }

    //console.log("查询条件", _Getresult_infos);
    return _Getresult_infos;
}

/**
 * @content 通用JS分页
 * @name 梁汝翔<liangruxiang >
 * @time 2015年6月16日 16:20:00
 * @pram total 总条数 
 * @pram show 每页显示多少条 
 * @pram curr 当前选中的是第几页
 * @pram contaier 分页字符串容器 
 * @param _InitCallback 初始化回调函数
 * @pram fn 分页后的回调函数  
 */
function Lrx_JsPage(total, show, curr, contaier, fn, _InitCallback) {

    //计算分页的总长度
    var page_str = '<div class="page_jl fl">共<i class="c_org">' + total + '</i>条记录</div>';
    //当前分页总多少页
    var page_num = Math.ceil(total / show); //上取整

    //当前是第几页
    var thePage = curr == undefined ? 1 : curr;

    //通过参数获取当前分页的html
    var page_Numbs_Str = getJSPage_Html(page_num, thePage);

    if (contaier == undefined) {
        contaier = $(".ty_page");
    }

    var _New_PageHtml = page_str + page_Numbs_Str;

    contaier.empty().html(_New_PageHtml);

    //绑定点击事件
    if (page_Numbs_Str != "") {
        contaier.find(".lrxpage_list a").unbind("click").click(function () {
            var theValue = $(this).attr("value") == undefined ? 1 : $(this).attr("value");
            fn(contaier, theValue, _InitCallback);
        });
    }
}

/**
 * @content 获取分页的Html结构
 * @name 梁汝翔<liangruxiang >
 * @time 2015年6月16日 16:20:00
 * @pram Total_page 总共有多少页 
 * @pram the_page 当前是多少页  
 */
function getJSPage_Html(total_page, the_page) {

    var Page_html = "";
    the_page = parseInt(the_page);
    if (isNaN(the_page)) {
        the_page = 1;
    }
    if (total_page > 1) {

        var _prev_page = ""; //上一页
        if ((the_page - 1) > 0) {
            var theNextPage = parseInt(the_page - 1);
            _prev_page = "<span class='next_page'><a href='javascript:void(0)' value='" + theNextPage + "' ><i class='pdr5'>&lt;</i>上一页</a></span> ";
        }
        else {
            _prev_page = "<span class='next_page'><a href='javascript:void(0)' value='" + the_page + "' ><i class='pdr5'>&lt;</i>上一页</a></span> ";
        }

        //前翻
        var _theNext_Numb = "", k = 0;

        if (the_page - 2 > 0) {
            _theNext_Numb += "<a href='javascript:void(0)' value='" + (the_page - 2) + "' >" + (the_page - 2) + "</a>";
            _theNext_Numb += "<a href='javascript:void(0)' value='" + (the_page - 1) + "' >" + (the_page - 1) + "</a>";
        }
        else {
            for (var i = (the_page - 1) ; i > 0 ; i--) {
                if (i > 0 && k < 2) {
                    k++;
                    _theNext_Numb += "<a href='javascript:void(0)' value='" + i + "' >" + i + "</a>";
                }
            }
        }

        //后翻
        var _thePrev_Numb = "", j = 0;
        for (var s = (the_page + 1) ; s <= total_page ; s++) {
            if (s <= total_page && j < 2) {
                j++;
                _thePrev_Numb += "<a href='javascript:void(0)' value='" + s + "' >" + s + "</a>";
            }
        }

        var this_number = "<a href='javascript:void(0)' class='curr'>" + the_page + "</a>";


        var theCountPage = "<span class='page_numb'>" + _theNext_Numb + this_number + _thePrev_Numb + "</span>";

        var _theEndPage = ""; //最后一页
        if (the_page + 1 <= total_page) {
            var thePrevPage = parseInt(the_page + 1);
            _theEndPage = "<span class='next_page'><a href='javascript:void(0)' value='" + thePrevPage + "' >下一页<i class='pdl5 '>&gt;</i></a></span>";
        }
        else {
            _theEndPage = "<span class='next_page'><a href='javascript:void(0)' value='" + the_page + "' >下一页<i class='pdl5 '>&gt;</i></a></span>";
        }
        Page_html = _theEndPage + theCountPage + _prev_page;

        Page_html = "<div class='lrxpage_list'>" + Page_html + "</div>";
    }
    else {
        Page_html = "";
    }

    return Page_html;
}

/**
 * @content 点击分页的回调函数
 * @name 梁汝翔<liangruxiang >
 * @time 2015年6月16日 16:20:00
 * @param contaier 数据分页的容器 
 * @param the_page 当前是多少页  
 */
function doPageCallBack(contaier, NewPageIndex, _InitCallback) {

    var thePageContId = contaier.attr("cont_id") == undefined ? 'body' : contaier.attr("cont_id");
    var thePageInitcond = contaier.attr("initcond") == undefined ? '{ "byid": [], "byChildCurr": [], "byAttrValue": [] ,"PageIndex":"1"}' : contaier.attr("initcond");
    //var thePageCallback = contaier.attr("callback") ? '': contaier.attr("callback");

    var NewContsObj = eval("(" + thePageInitcond + ")");
    if (typeof NewContsObj == "object") {
        NewContsObj.PageIndex = NewPageIndex;
        _InitPageData(thePageContId, NewContsObj, _InitCallback);
    }
}

/**
 * @content JSON对象转换成String类型对象
 * @name 梁汝翔<liangruxiang >
 * @time 2015年6月16日 16:20:00
 * @param JSONObj Json对象
 */
function Json_To_String(JSONObj) {
    var Result = "";
    if (JSONObj != undefined) {
        if (JSON != undefined) {
            Result = JSON.stringify(JSONObj);
        }
        else {
            Result = JSONObj.toString();
        }
    }
    return Result;
}

/**
 * 比较时间的大小 
 * @name 梁汝翔<liangruxiang >
 * @time 2015年6月16日 16:20:00
 * @param start 开始时间
 * @param end 结束时间
 * @type 时间字符串截取方式
 */
function compareTime(start, end, type) {
    if (type == undefined) {
        type = "-";
    }

    var _StartTime = start.split(type);
    var _start_int = parseInt(_StartTime[0] + _StartTime[1] + _StartTime[2]);

    var _EndTime = end.split(type);
    console.log(_EndTime);
    var _end_int = parseInt(_EndTime[0] + _EndTime[1] + _EndTime[2]);

    if (_end_int >= _start_int) {
        return true;
    }
    else {
        return false;
    }
}

    /**
   * @content 判断是否存在未完成的充值订单
   * @name 梁汝翔<liangruxiang>
   * @time 2015年6月16日 16:20:00  
   * @param _obj 事件的触发对象
   */
function check_recharge_order(_obj) {
    if (_obj != undefined) {
        $.ajax({
            type: "POST",
            url: "",
            data: {
                action: 'isOredr'
            },
            dataType: "json",
            success: function (data) {
                if (data.Code == 1) {
                    if (data.Data != undefined && data.Data == true) {  //判断是否有订单存在
                        //显示未完成的充值订单信息
                        show_recharge_Order(_obj);
                    } else {
                        art.dialog({
                          'title': '充值确认',
                'width': '170px',
                'height': '75px',
                'padding': '10px 20px',
                'content': "<p style=\"margin-top: 14%;margin-left: 28%; font-size: 15px;\">是否充值完成</p>",
                            cancel: true,
                            ok: function () {
                                //提交新的订单
                                Add_recharge_Order(_obj);
                            }
                        });
                    }
                } else {
                    alert(data.StrCode);
                }
            }
        })
    }
}


/**
    * @content 显示未完成的订单信息
    * @name 梁汝翔<liangruxiang>
    * @time 2015年6月16日 16:20:00  
    * @param _obj 事件的触发对象
    */
function show_recharge_Order(_obj) {
    $.ajax({
        type: "POST",
        url: "",
        data: {
            action: 'getnewOrder'
        },
        dataType: "json",
        success: function (data) {
            if (data.Code == 1) {

                var theShowContainer = "";
                var strVar = "";
                var chargeBankName = data.Data.chargeBankName == undefined ? "财付通" : data.Data.chargeBankName;
                var chargeMoney = data.Data.chargeMoney == undefined ? 0 : data.Data.chargeMoney;
                var recvBankName = data.Data.recvBankName == undefined ? "" : data.Data.recvBankName;
                var recvUserName = data.Data.recvUserName == undefined ? "" : data.Data.recvUserName;
                var recvEmail = data.Data.recvEmail == undefined ? "" : data.Data.recvEmail;
                var userBankName = data.Data.userBankName == undefined ? "" : data.Data.userBankName;
                var charge_type = data.Data.charge_type == undefined ? "" : data.Data.charge_type;
                var verCodeUrl = data.Data.verCodeUrl == undefined ? "" : data.Data.verCodeUrl;
                var theType = 1;
                if (charge_type == "WX" || charge_type == "ZFB") {
                    theType = 2;
                }

                strVar += "<div class='recharge_order_infos'>";
                strVar += "	<p class=\"wd-title\">对不起，您尚有一笔充值申请未完成，请完成后再发起<\/p>";
                strVar += "	<div>";
                strVar += "		<table border=\"0\" cellpadding=\"0\" cellspacing=\"10\" width=\"100%\">";
                strVar += "		  <tbody>";
                strVar += "		  <tr>";
                strVar += "			<td class=\"wd-td-bold\" align=\"right\" width=\"130\">充值银行：<\/td>";
                strVar += "			<td>" + chargeBankName + "<span style=\"margin-left:80px;\">";
                if (theType == 1) {
                    strVar += " <a target=\"_blank\" href='" + data.Data.ulr + "'>登录网银<\/a><\/span>";
                }
                strVar += "<\/td>";

                strVar += "		  <\/tr>";
                strVar += "		  <tr>";
                strVar += "			<td class=\"wd-td-bold\" align=\"right\">充值金额：<\/td>";
                strVar += "			<td style=\"color:red\">" + chargeMoney + "元<\/td>";
                strVar += "		  <\/tr>";
                if (recvBankName != "") {
                    strVar += "		  <tr>";
                    strVar += "			<td class=\"wd-td-bold\" align=\"right\">收款银行：<\/td>";
                    strVar += "			<td style=\"color:red\">" + recvBankName + "<\/td>";
                    strVar += "		  <\/tr>";
                }

                strVar += "		  <tr>";
                strVar += "			<td class=\"wd-td-bold\" align=\"right\">收款账户名：<\/td>";
                strVar += "			<td style=\"color:red\">" + recvUserName + "<\/td>";
                strVar += "		  <\/tr>";

                if (recvEmail != "") {
                    strVar += "		  <tr>";
                    strVar += "			<td class=\"wd-td-bold\" align=\"right\">收款Email地址：<\/td>";
                    strVar += "			<td style=\"color:red\">" + recvEmail + "<\/td>";
                    strVar += "		  <\/tr>";
                }

                strVar += "		  <tr>";
                strVar += "			<td class=\"wd-td-bold\" align=\"right\">附言：<\/td>";
                strVar += "			<td style=\"color:red\">" + data.Data.mess + "<\/td>";
                strVar += "		  <\/tr>";

                if (userBankName != "") {
                    strVar += "		  <tr>";
                    strVar += "			<td class=\"wd-td-bold\" align=\"right\">开户行名称：<\/td>";
                    strVar += "			<td style=\"color:red\">" + userBankName + "<\/td>";
                    strVar += "		  <\/tr>";
                }

                strVar += "	  <\/tbody>";
                if (theType == 2) {
                    strVar += "<span style=\"display: inherit;float: right;position: absolute;right: 40px;top: 110px;\">	<img src=\"" + verCodeUrl + "\" height=\"105\" width=\"105\"><\/span>";
                }
                strVar += "<\/table>";


                strVar += "		<p class=\"wd-control-panel\">";
                strVar += "			您还可以 &nbsp;&nbsp;&nbsp;&nbsp;";
                if (userBankName == "") {
                    strVar += "			<input class=\"btn btn-important\" style=\"padding: 5px 5px;background-color: #d21e1e;color: #FFF;\"  id=\"J-button-order-cancel\" user_tenpay_record_ID='" + data.Data.user_tenpay_record_ID + "' value=\"撤销申请\" type=\"button\">";
                } else {
                    strVar += "			<input class=\"btn btn-important\" style=\"padding: 5px 5px;background-color: #d21e1e;color: #FFF;\"  id=\"J-button-order-cancel\" bankpay_record_ID='" + data.Data.bankpay_record_ID + "' value=\"撤销申请\" type=\"button\">";
                }
                strVar += "			&nbsp;&nbsp;&nbsp;&nbsp;";
                strVar += "			<a href=\"/u_account_infos.html\">账户明细<\/a>";
                strVar += "		<\/p>";


                strVar += "		<p class=\"wd-tip\">";
                strVar += "			* 如您已完成付款，请勿撤销，我们将尽快为您处理。";
                strVar += "		<\/p>";
                strVar += "	<\/div>";
                strVar += "<\/div>";

                //显示已有订单弹窗
                show_order_layout(_obj, strVar, theType);
            } else {
                alert(data.StrCode);
            }
        }
    });
}

/**
 * @content 添加新的订单信息
 * @name 梁汝翔<liangruxiang>
 * @time 2015年6月16日 16:20:00  
 * @param _obj 事件的触发对象
 * @param theType =1 银行卡充值； =2 财付通充值
 */
function show_order_layout(_obj, contHtml, theType) {
    art.dialog({
        'title': '温馨提示',
        'width': '450px',
        'height': '250px',
        'padding': '20px',
        'content': contHtml
    });

    //点击撤销申请
    $("#J-button-order-cancel").click(function () {
        if (theType == "1") {
            var theValue = $(this).attr("bankpay_record_id") == undefined ? "" : $(this).attr("bankpay_record_id");
            if (theValue != "") {
                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        action: 'cheDan',
                        bankpay_record_ID: theValue
                    },
                    dataType: "JSON",
                    success: function (data) {
                        if (data && data.Code == 1) {
                            alert(data.StrCode);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        }
                    }
                })
            }
        } else {
            var theValue = $(this).attr("bankpay_record_ID") == undefined ? "" : $(this).attr("bankpay_record_ID");
            if (theValue != "") {
                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        action: 'cheDan',
                        bankpay_record_ID: theValue
                    },
                    dataType: "JSON",
                    success: function (data) {
                        if (data && data.Code == 1) {
                            alert(data.StrCode);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        }
                    }
                })
            }
        }

    });

}


/**
    * @content 添加新的订单信息
    * @name 梁汝翔<liangruxiang>
    * @time 2015年6月16日 16:20:00  
    * @param _obj 事件的触发对象
    */
function Add_recharge_Order(_obj) {
   var theMoney = $("#money").text(); //充值的金额
            var theMessage = $("#wxName").val(); //充值人姓名
    theMoney = isNaN(Number(theMoney)) ? 0 : Number(theMoney);

    if (theMoney < 50 || theMoney > 50000) {
        alert("充值金额，必须大于20小于50000元。");
        return false;
    }

    if (theMoney > 0) {
        $.ajax({
            type: "POST",
            url: "",
            data: {
                action: 'add',
                money: theMoney,
                message: theMessage
            },
            dataType: "json",
            success: function (data) {
                if (data.Code == 1) {
                   alert("提交成功！");
                    window.location.href = window.location.origin + "/u_center.html";
                } else {
                    alert(data.StrCode);
                    return false;
                }
            }
        });
    }
}

/**
 * @content 判断字符串是否在数组当中
 * @name 梁汝翔<liangruxiang >
 * @time 2015年6月16日 16:20:00  
 * @param str 字符串
 * @param currdata 数组
 */
function CheckStrInArray2(str, arry) {
    var theState = false;
    for (var i = 0 ; i < arry.length; i++) {
        if (arry[i] == str) {
            i = arry.length;
            theState = true;
        }
    }
    return theState;
}

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




