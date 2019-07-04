// JavaScript Document 
// +---------------------------------------------------------------------- 
// | Date: 2015年7月28日 10:30:00
// +----------------------------------------------------------------------
// | Name: PageBasic.js ( 页面普通的JS效果和数据交互 )
// +----------------------------------------------------------------------

$(function () {

    /**
     * @content 判断浏览器的版本
     * @author  梁汝翔<liangruxiang>  
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
     * @content 初始化获取投注记录
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#Betting_records").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['lottery_code', 'issuseNo', 'startTime', 'endTime', 'record_code'], "byChildCurr": ['intTime', 'state'], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件


        //回调函数
        function Betting_recordlist(data, initcond, _InitCallback) {
            //console.log("初始化投注记录的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1") {

                var _TrData = data.Data.DataRow == undefined ? {} : data.Data.DataRow;
                if (_TrData.length >= 0) { $(".Records_listCont").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var strVar = "";
                    var theOpenNumb = _TrData[i].open_num;
                    var theOpenNumbs = theOpenNumb;
                    if (theOpenNumb != "") {
                        theOpenNumb = theOpenNumb.toString();
                        var theOpenNumberLength = theOpenNumb.length; //开奖号码的长度
                        if (theOpenNumberLength > 12) {
                            theOpenNumbs = theOpenNumbs.substr(0, 12) + "&nbsp;&nbsp;<a href='javascript:void(0)' value='" + theOpenNumb + "' class='look_more c_3'>详细</a>";
                        }
                    }

                    var betting_num = _TrData[i].betting_num;
                    //betting_num = betting_num.toString();
                    //betting_num = betting_num.substr(1, betting_num.length);

                    var theBetting_num = betting_num;
                    if (theBetting_num != "") {
                        theBetting_num = theBetting_num.toString();
                        var theBetting_numLength = theBetting_num.length; //开奖号码的长度
                        if (theBetting_numLength > 12) {
                            theBetting_num = theBetting_num.substr(0, 12) + "&nbsp;&nbsp;<a href='javascript:void(0)' value='" + theBetting_num + "' class='look_more c_3'>...详细</a>";
                        }
                    }


                    strVar += "<tr>";
                    strVar += " <td colspan='2' class='c_yellow'>" + _TrData[i].lottery_name + "</td>";
                    strVar += " <td>" + theBetting_num + "</td>";
                    strVar += " <td>" + _TrData[i].issueNo + "</td>";
                    strVar += " <td class='c_org'>" + parseFloat(_TrData[i].normal_money).toFixed(2) + "</td>";
                    strVar += " <td>" + theOpenNumbs + "</td>";


                    if (_TrData[i].winning_state == "未中奖") {
                        strVar += " <td style='color:green'>" + _TrData[i].winning_state + "</td>";
                    } else if (_TrData[i].winning_state == "已中奖") {
                        strVar += " <td style='color:red'>" + _TrData[i].winning_state + "</td>";
                    } else {
                        strVar += " <td style='color:orang'>" + _TrData[i].winning_state + "</td>";
                    }
                    if (_TrData[i].bouns_money == null || _TrData[i].bouns_money == undefined) {
                        strVar += " <td class='c_red'> 0.00 </td>";
                    } else {
                        strVar += " <td class='c_red'>" + _TrData[i].bouns_money + "</td>";
                    }
                    strVar += " <td>" + _TrData[i].time + "</td>";
                    strVar += " <td><a class='alink' href='" + _TrData[i].url + "'>查看</a></td>";
                    strVar += "</tr>";

                    var theHtml = $(strVar);
                    $(".Records_listCont").append(theHtml);

                }

                var _pageTotal = data.Data.DataCount;
                var _pageShow = 10;
                var _pageCurr = initcond.PageIndex;
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
                var _new_initcond = Json_To_String(initcond);
                _pagecontaier.attr("initcond", _new_initcond);
                _pagecontaier.attr("cont_id", "Betting_records");
            }

        }

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("Betting_records", condition_array, Betting_recordlist);

        //点击查询事件
        //1、切换彩种触发的查询事件
        $("#lottery_code").change(function () {
            _InitPageData("Betting_records", condition_array, Betting_recordlist);
        });
        //1、点击时间区域的时候触发的查询事件
        $("#intTime .a_item").click(function () {
            $(this).siblings(".a_item").removeClass("curr");
            $(this).addClass("curr");
            _InitPageData("Betting_records", condition_array, Betting_recordlist);
        });
        //1、点击时间区域的时候触发的查询事件
        $("#state[name='Time_Status'] .a_item").click(function () {
            $(this).siblings(".a_item").removeClass("curr");
            $(this).addClass("curr");
            _InitPageData("Betting_records", condition_array, Betting_recordlist);
        });
        //1、点击时间区域的时候触发的查询事件
        $("#Betting_records .sub_btn").click(function () {

            var theStartTime = $("#startTime").val();
            var theendTime = $("#endTime").val();
            var theState = true;
            if (theStartTime != "" && theendTime != "") {
                //比较时间正确性
                var CompareTime = compareTime(theStartTime, theendTime, "-");
                if (!CompareTime) {
                    theState = false;
                } else {
                    $("#intTime .a_item").removeClass("curr");
                    $("#intTime .a_item:last").addClass("curr");
                }
            }
            if (theState) {
                _InitPageData("Betting_records", condition_array, Betting_recordlist);
            } else {
                alert("查询的时间区域有误");
            }
        });
        //1、点击时间区域的时候触发的查询事件
        $("#Betting_records .alink[type='reset']").click(function () {
            $("#startTime").val("");
            $("#endTime").val("");
            $("#issuseNo").val("");
            $("#record_code").val("");
            _InitPageData("Betting_records", condition_array, Betting_recordlist);
        });

        //查看详细
        $("#Betting_records").off().on("click", ".look_more", function () {
            var theValue = $(this).attr("value");
            alert(theValue);
        });
    }

    /**
    * @content 账户明细信息查询和数据初始化
    * @author  梁汝翔<liangruxiang>  
    * @time 2015年7月28日 10:07:09
    */
    if ($("#invest_fuddetail_cont").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['AbstractType', 'SerialNum', 'Start', 'End'], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function invest_fuddetailList(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if ((data.code != undefined && data.code == "1") || (data.Code != undefined && data.Code == "1")) {


                var _TrData = data.Data.Data == undefined ? {} : data.Data.Data;
                if (_TrData.length >= 0 || _TrData == null) { $("#fudetail_list").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var InMoneys = isNaN(parseFloat(_TrData[i].InMoney).toFixed(2)) ? _TrData[i].InMoney : parseFloat(_TrData[i].InMoney);
                    var OutMoney = isNaN(parseFloat(_TrData[i].OutMoney).toFixed(2)) ? _TrData[i].OutMoney : parseFloat(_TrData[i].OutMoney);
                    var Money = isNaN(parseFloat(_TrData[i].Money).toFixed(2)) ? _TrData[i].Money : parseFloat(_TrData[i].Money);
                    var strVar = "";
                    strVar += "<tr>";
                    strVar += " <td><a class='alink' href='" + _TrData[i].url + "'>" + _TrData[i].SerialNum + "</a></td>";
                    strVar += " <td>" + _TrData[i].Time + "</td>";
                    strVar += " <td>" + _TrData[i].Abstract + "</td>";
                    strVar += " <td class='c_yellow'>" + InMoneys + "</td>";
                    strVar += " <td class='c_yellow'>" + OutMoney + "</td>";
                    strVar += " <td class='c_org'>" + Money + "</td>";

                    if (_TrData[i].Abstract == "管理员减") {
                        strVar += " <td>&nbsp;</td>";
                    } else {

                        if (_TrData[i].Commt.length > 15) {
                            strVar += " <td><a href='javascript:void(0)' class='look_xx_infos' title='" + _TrData[i].Commt + "'>查看详情</a></td>";
                        } else {
                            strVar += " <td>" + _TrData[i].Commt + "</td>";
                        }
                    }

                    strVar += "</tr>";
                    var theHtml = $(strVar);
                    $("#fudetail_list").append(theHtml);
                }

                var _pageTotal = data.Data.DataCount;
                var _pageShow = 10;
                var _pageCurr = data.Data.Pageindex;
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

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("invest_fuddetail_cont", condition_array, invest_fuddetailList);

        //点击查询按钮
        $("#invest_fuddetail_cont .sub_btn").click(function () {
            _InitPageData("invest_fuddetail_cont", condition_array, invest_fuddetailList);
        });

        $("#invest_fuddetail_cont #AbstractType").change(function () {
            _InitPageData("invest_fuddetail_cont", condition_array, invest_fuddetailList);
        });

        //查看详细信息
        $("#invest_fuddetail_cont").on("click", ".look_xx_infos", function () {
            var _theTitles = $(this).attr("title") == undefined ? "" : $(this).attr("title");
            if (_theTitles != "") {
                alert(_theTitles);
            }
        });
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
            if (_code == "WX"||_code=="ZFB") {
                if (_wxName == "" || _wxName == null) {
                    alert("请填写付款微信账号！");
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
                    strVar += "			<td class=\"wd-td-bold\" align=\"right\" width=\"130\">充值银行：<\/td>";
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
                        strVar += "<span style=\"display: inherit;float: right;position: absolute;right: 40px;top: 110px;\">	<img src=\"" + verCodeUrl + "\" height=\"105\" width=\"105\"><\/span>";
                    }
                    strVar += "<\/table>";

                    strVar += "		<p class=\"wd-control-panel\">";
                    strVar += "			您还可以 &nbsp;&nbsp;&nbsp;&nbsp;";
                    strVar += "			<input class=\"btn btn-important\" style=\"padding: 5px 5px;background-color: #d21e1e;color: #FFF;\" id=\"WX-button-order-cancel\" user_tenpay_record_ID='" + charge_account_ID + "' value=\"撤销申请\" type=\"button\">";
                    strVar += "			&nbsp;&nbsp;";
                    strVar += "			<input class=\"btn btn-important\" style=\"padding: 5px 5px;background-color: #d21e1e;color: #FFF;\" id=\"WX-button-order-cancel\"  onclick=\"CloseOrder()\" value=\"完成订单\" type=\"button\">";
                    strVar += "			&nbsp;&nbsp;";
                    strVar += "			<a href=\"/user_account_invest_fuddetail2.html\">充值记录<\/a>";
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
                        window.location.href = data.Data;
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
     * @content 点击退出
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#myaccount .loginout").size() > 0) {
        $("#myaccount .loginout").click(function () {
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
     * @content 代理首页
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#Proxy_IndexPage").size() > 0) {

        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['startTime', 'endTime'], "byChildCurr": ['timeType'], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        function Proxy_IndexlList(data, initcond, _InitCallback) {
            if (data.Code == "1") {

                data = data.Data;
                //团队成员：2人（代理2人，玩家0人）
                var _Agent = data.Agent == null ? 0 : data.Agent; //代理人数 
                var _Player = data.Player == null ? 0 : data.Player;  //玩家人数

                var Total_Team = parseInt(_Agent) + parseInt(_Player);

                $(".total_Team").empty().text(Total_Team);
                $(".Team_Agent").empty().text(_Agent);
                $(".Team_Player").empty().text(_Player);

                //今日返点：0.00元
                var _TodayRebate = data.TodayRebate;
                $(".TodayRebate").empty().text(_TodayRebate);

                //团队余额：0.00元（不包含自己）
                var _TeamBalance = data.TeamBalance;
                $(".TeamBalance").empty().text(_TeamBalance);

                //今日统计量
                var _TodayStatistics = data.TodayStatistics;   //为一个JSON对象 

                var Home_Agent = {};
                Home_Agent.X_Time = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '17', '18', '19', '20', '21', '22', '23'];
                Home_Agent.Withdrawals = [1.0, 1.5, 2.5, 1.5, 1.5, 3.2, 2.0, 0.8, 2.4, 1.4, 1.1, 1.8, 1.5, 3.2, 2.0, 2.1, 2.3, 1.6, 1.4, 1.8, 1.7, 1.0, 1.8, 2.0, 3.0];
                Home_Agent.Recharge = [1.0, 1.5, 1.5, 3.2, 2.0, 2.1, 2.3, 2.4, 0.5, 1.4, 1.1, 1.5, 3.2, 2.0, 2.1, 2.3, 3.0, 1.6, 1.4, 1.8, 1.7, 1.0, 1.8, 2.0, 3.0];
                Home_Agent.Bets = [1.0, 1.5, 2.5, 1.5, 3.2, 1.5, 3.2, 2.0, 2.1, 2.3, 1.1, 1.8, 1.7, 1.0, 1.8, 2.0, 3.0, 1.6, 1.4, 1.8, 1.7, 1.0, 1.8, 2.0, 3.0];
                Home_Agent.Rebate = [1.0, 1.5, 2.5, 1.5, 3.2, 1.2, 0.8, 2.4, 0.5, 1.4, 1.1, 2.0, 2.0, 2.1, 2.3, 1.8, 1.7, 1.6, 1.4, 1.8, 1.7, 1.0, 1.8, 2.0, 3.0];
                Home_Agent.NewUsers = [1.0, 1.5, 2.5, 1.5, 3.2, 2.0, 2.1, 2.3, 1.8, 1.7, 1.6, 1.4, 1.8, 1.7, 1.0, 1.8, 2.0, 3.0, 1.2, 0.8, 2.4, 0.5, 1.4, 1.1, 2.0];

                //_TodayStatistics = Home_Agent ; 

                //绘图  基于HighChart插件
                Chart_Home_Agent(_TodayStatistics, 'charts');

                //处理table以及；统计每条线的总和
                var _Today_len = _TodayStatistics.X_Time.length; //获取当前时间段有多少条数据
                if (_Today_len > 0) {
                    var p_buy = 0; //投注量
                    var p_load = 0; //充值量
                    var p_withdraw = 0; //提现量 
                    var p_rebates = 0; //返点
                    var p_newMem = 0; //新增用户数
                    $(".Statistics_List").empty();

                    for (var s = 0 ; s < _Today_len ; s++) {
                        var _this_buy = _TodayStatistics.Bets[s] == null ? 0 : _TodayStatistics.Bets[s]; //投注量
                        var _this_load = _TodayStatistics.Recharge[s] == null ? 0 : _TodayStatistics.Recharge[s]; //充值量
                        var _this_withdraw = _TodayStatistics.Withdrawals[s] == null ? 0 : _TodayStatistics.Withdrawals[s]; //提现量 
                        var _this_rebates = _TodayStatistics.Rebate[s] == null ? 0 : _TodayStatistics.Rebate[s]; //返点 
                        var _this_newMem = parseInt(_TodayStatistics.NewUsers[s]) == null ? 0 : parseInt(_TodayStatistics.NewUsers[s]); //新增用户数

                        p_buy = Number(p_buy) + Number(_this_buy);
                        p_load = Number(p_load) + Number(_this_load);
                        p_withdraw = Number(p_withdraw) + Number(_this_withdraw);
                        p_rebates = Number(p_rebates) + Number(_this_rebates);
                        p_newMem = Number(p_newMem) + parseInt(_this_newMem);

                        if (!(_this_buy == 0 && _this_load == 0 && _this_withdraw == 0 && _this_rebates == 0 && _this_newMem == 0)) {
                            var strVar = "";
                            strVar += "<tr>";
                            strVar += "    <td>" + _TodayStatistics.X_Time[s] + "<\/td>";
                            strVar += "    <td>" + _this_withdraw + "元<\/td>";
                            strVar += "    <td>" + _this_load + "元<\/td>";
                            strVar += "    <td>" + _this_buy + "元<\/td>";
                            strVar += "    <td>" + _this_rebates + "元<\/td>";
                            strVar += "    <td>" + _this_newMem + "个<\/td>";
                            strVar += "<\/tr>";

                            $(".Statistics_List").append($(strVar));
                        }
                    }

                    $("#p_buy").empty().text(parseFloat(p_buy).toFixed(2));
                    $("#p_load").empty().text(parseFloat(p_load).toFixed(2));
                    $("#p_withdraw").empty().text(parseFloat(p_withdraw).toFixed(2));
                    $("#p_rebates").empty().text(parseFloat(p_rebates).toFixed(2));
                    $("#p_newMem").empty().text(parseInt(p_newMem));
                }
            }
            else {
                return false;
            }
        }

        _InitPageData("Proxy_IndexPage", condition_array, Proxy_IndexlList);

        //点击查询按钮
        $("#Proxy_IndexPage .sub_btn").click(function () {

            var theStartTime = $("#startTime").val();
            var theendTime = $("#endTime").val();
            var theState = true;
            if (theStartTime != "" && theendTime != "") {
                //比较时间正确性
                var CompareTime = compareTime(theStartTime, theendTime, "-");
                if (!CompareTime) {
                    theState = false;
                } else {
                    $("#timeType li").removeClass("curr");
                    $("#timeType li:last").addClass("curr");
                }
            }
            if (theState) {
                _InitPageData("Proxy_IndexPage", condition_array, Proxy_IndexlList);
            } else {
                alert("查询的时间区域有误");
            }
        });

        //切换时间查询数据
        $("#Proxy_IndexPage #timeType li").click(function () {
            $(this).siblings("li").removeClass("curr");
            $(this).addClass("curr");
            _InitPageData("Proxy_IndexPage", condition_array, Proxy_IndexlList);
        });
    }

    /**
     * @content 代理用户管理
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#Account_cusmagListPage").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['UserName', 'SMoney', 'EMoney', 'LogInTime', 'user_id'], "byChildCurr": ['Sel_type'], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function Account_cusmagListFn(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1" && data.Data != null) {

                var _TrData = data.Data.data == undefined ? {} : data.Data.data;
                if (_TrData.length >= 0) { $("#Account_cusmagList").empty(); }

                var _Dq_length = data.Data.agentCount;  //当前会员的代理数量
                var _DaiLiLen = data.Data.waijiCount;   //当前会员的玩家数量
                var _Types = $("#Sel_type .curr").attr("value") == undefined ? 1 : $("#Sel_type .curr").attr("value");
                var _dl_Level = "一";
                var _level_theLength = $(".Client_level_cusmag .level_obj").length == undefined ? 1 : $(".Client_level_cusmag .level_obj").length;
                if (_level_theLength > 0) {
                    var _theLevel_Name = ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十一", "十二", "十三", "十四", "十五", "十六"];

                    _dl_Level = _theLevel_Name[_level_theLength - 1] == undefined ? "" : _theLevel_Name[_level_theLength - 1];

                    $("#Sel_type").find("a").eq(0).empty().text(_dl_Level + "级代理 (" + _Dq_length + ")");
                    $("#Sel_type").find("a").eq(1).empty().text("玩家 (" + _DaiLiLen + ")");
                }

                for (var i = 0 ; i < _TrData.length ; i++) {
                    var strVar = "";
                    strVar += "<tr>";
                    if (_TrData[i].xiaJiAgentCount > 0) {
                        strVar += " <td><a href='javascript:void(0)' childUid = '" + _TrData[i].user_id + "' class='alink look_child'>" + _TrData[i].userName + "(" + _TrData[i].xiaJiAgentCount + ")</a></td>";
                    } else {
                        strVar += " <td>" + _TrData[i].userName + "</td>";
                    }

                    if (_TrData[i].userType == "一级代理") {
                        strVar += " <td>" + _dl_Level + "级代理</td>";
                    } else {
                        strVar += " <td>" + _TrData[i].userType + "</td>";
                    }

                    strVar += " <td>" + _TrData[i].userMoney + "</td>";
                    strVar += " <td>" + _TrData[i].userLoginTime + "</td>";
                    strVar += " <td>";
                    strVar += "     <a  class='alink record' title='投注记录' href='" + _TrData[i].bettingURL + "' childUid ='" + _TrData[i].user_id + "' ><i class='iconfont'>记录</i></a>";
                    strVar += "     <a  class='alink Account' title='账户明细' href='" + _TrData[i].accountURL + "' childUid ='" + _TrData[i].user_id + "' ><i class='iconfont'>明细</i></a>";
                    strVar += "     <a  class='alink recharge' title='账户充值' href='" + _TrData[i].rechargeUrl + "' childUid ='" + _TrData[i].user_id + "' ><i class='iconfont'>充值</i></a>";
                    strVar += "     <a  class='alink resetPoint' title='查看返点' href='" + _TrData[i].pointUrl + "'  childUid ='" + _TrData[i].user_id + "' ><i class='iconfont'>返点</i></a>";
                    if (_Types == 1) {
                        strVar += "     <a  class='alink fhqiyue' title='充值配额' href='" + _TrData[i].quotaURL + "' childUid ='" + _TrData[i].user_id + "' ><i class='iconfont'>配额</i></a>";
                        strVar += "     <a  class='alink fhqiyue' title='分红契约' href='" + _TrData[i].qiyueURL + "' childUid ='" + _TrData[i].user_id + "' ><i class='iconfont'>契约</i></a>";
                    }
                    strVar += "</td>";
                    strVar += "</tr>";
                    var theHtml = $(strVar);
                    $("#Account_cusmagList").append(theHtml);
                }

                var _pageTotal = data.Data.dataCount;
                var _pageShow = 10;
                var _pageCurr = initcond.PageIndex;
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
        _InitPageData("Account_cusmagListPage", condition_array, Account_cusmagListFn);

        //点击查询按钮
        $("#Account_cusmagListPage .sub_btn").click(function () {

            var theSMoney = $("#SMoney").val();
            var theEMoney = $("#EMoney").val();
            var theState = true;
            if (theSMoney != "" && theEMoney != "") {
                //比较时间正确性 
                if (isNaN(Number(theSMoney)) || isNaN(Number(theEMoney))) {
                    theState = false;
                }
            }
            if (theState) {
                _InitPageData("Account_cusmagListPage", condition_array, Account_cusmagListFn);
            } else {
                alert("查询的时间区域有误");
            }
        });

        //点击下级用户名
        $("#Account_cusmagListPage").off("click").on("click", '.look_child', function () {
            var _theUserId = $(this).attr("childUid") == undefined ? "" : $(this).attr("childUid");

            if (_theUserId != "") {
                var _theName = $(this).text();
                $(".Client_level_cusmag").show();
                $("#Account_cusmagListPage #user_id").val(_theUserId);
                _InitPageData("Account_cusmagListPage", condition_array, Account_cusmagListFn);

                var _theLevel_index = $(".Client_level_cusmag .level_obj").length == undefined ? 1 : $(".Client_level_cusmag .level_obj").length;
                var theNew_String = "";

                theNew_String += "<span class='fl add_level_btn'><span class='fl'>&nbsp;&gt;&nbsp;</span><a href='javascript:void(0)' class='level_obj c_green' childUid='" + _theUserId + "' >" + _theName + "</a></span>";

                $(".Client_level_cusmag td").append($(theNew_String));

            } else {
                $("#Account_cusmagListPage #user_id").val(_theUserId);
                $(".Client_level_cusmag .add_level_btn").remove();
                $(".Client_level_cusmag").hide();
            }

        });

        //点击层级
        $("#Account_cusmagListPage").on("click", '.level_obj', function () {

            var _theUserId = $(this).attr("childUid") == undefined ? "" : $(this).attr("childUid");
            if (_theUserId != "") {
                var _theName = $(this).text();
                $(".Client_level_cusmag").show();
                $("#Account_cusmagListPage #user_id").val(_theUserId);
                _InitPageData("Account_cusmagListPage", condition_array, Account_cusmagListFn);

                var _theIndexEq = $(".Client_level_cusmag").find(".add_level_btn").eq(0).index();
                $(".Client_level_cusmag .add_level_btn:gt(" + _theIndexEq + ")").remove();

                var _theLevel_index = $(".Client_level_cusmag .level_obj[childUid='" + _theUserId + "']").length == undefined ? 1 : $(".Client_level_cusmag .level_obj[childUid='" + _theUserId + "']").length;
                if (_theLevel_index < 0) {
                    var theNew_String = "";
                    theNew_String += "<span class='fl add_level_btn'><span class='fl'>&nbsp;&gt;&nbsp;</span><a href='javascript:void(0)' class=' level_obj c_green' childUid='" + _theUserId + "' >" + _theName + "</a></span>";

                    $(".Client_level_cusmag td").append($(theNew_String));
                }



            } else {
                $("#Account_cusmagListPage #user_id").val(_theUserId);
                _InitPageData("Account_cusmagListPage", condition_array, Account_cusmagListFn);
                var _theIndexEq = $(".Client_level_cusmag").find(".add_level_btn").eq(0).index();
                $(".Client_level_cusmag .add_level_btn").remove();
                $(".Client_level_cusmag").hide();
            }
        });

        //切换玩家和代理
        $("#Sel_type a").click(function () {

            $(this).siblings().removeClass("curr");
            $(this).addClass("curr");

            _InitPageData("Account_cusmagListPage", condition_array, Account_cusmagListFn);
        });
    }

    /**
     * @content 站内信管理
     * @author  梁汝翔<liangruxiang>  
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

                var _TrData = data.Data.Messages == undefined ? {} : data.Data.Messages;
                if (_TrData.length >= 0) { $(".Account_Msg_LetterList").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var strVar = "";
                    strVar += "<tr>";
                    strVar += " <td class='td1'><input class='ch' type='checkbox'  value='" + _TrData[i].id + "' /></td>";

                    if (_TrData[i].is_read) {
                        TitleRclass = "c_6";
                    } else {
                        TitleRclass = "c_3 fb";
                    }

                    if (_TrData[i].type == "系统消息") {
                        strVar += " <td class='td2'><i class='meg_type'>" + _TrData[i].type + "</i><a class='alink' href='" + _TrData[i].url + "'><i class='" + TitleRclass + "'>" + _TrData[i].title + "</i></td>";
                    } else {
                        strVar += " <td class='td2'><i class='meg_type'>用户邮件</i><a class='alink' href='" + _TrData[i].url + "'><i class='" + TitleRclass + "'>" + _TrData[i].title + "</i></td>";
                    }
                    strVar += " <td class='td3'>" + _TrData[i].post_user_name + "</td>";
                    strVar += " <td class='td4'>" + _TrData[i].post_time + "</td>";
                    strVar += "</tr>";
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
                Lrx_JsPage(_pageTotal, _pageShow, _pageCurr, _pagecontaier, _pageFn, _InitCallback);
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
     * @content 给下级发送站内信
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#check_child_user").size() > 0) {
        /**
         * @content 绑定选定收件人的事件 
         * @name 梁汝翔<liangruxiang>
         * @time 2015年6月16日 16:20:00 
         */
        function SureCheckeSJR(callbackData) {

            if (callbackData == undefined) {
                callbackData = {};
            }

            var theUserStr = "";
            var aksdfjkjss = "";

            if (typeof callbackData == "object") {
                for (var i = 0 ; i < callbackData.length ; i++) {
                    theUserStr += "<em class='fl user_child' value='" + callbackData[i].guid + "'>" + callbackData[i].name + "<i>&times;</i></em>";
                    aksdfjkjss += callbackData[i].guid + "@";
                }
            }
            if (aksdfjkjss != "" && theUserStr != "") {
                aksdfjkjss = aksdfjkjss.substr(0, aksdfjkjss.length - 1);
                $("#childUserList").attr("data", aksdfjkjss);
                $("#childUserList").empty().html(theUserStr);
            }

        }

        /**
         * @content 获取下级的用户 
         * @name 梁汝翔<liangruxiang>
         * @time 2015年6月16日 16:20:00
         * @type 时间字符串截取方式
         */
        function getChildUserInfos(_obj, fn) {
            var data = {}, type = "post", dataType = 'json';
            $.ajax({
                url: "",
                type: type,
                data: {
                    action: "getLastUser"
                },
                dataType: dataType,
                success: function (data) {
                    if (data.Code == "1") {
                        var thedataString = Json_To_String(data);
                        _obj.attr("jsondata", thedataString);
                        ShowChildUserCont(data, fn);
                    }
                }
            });
        }

        /**
         * @content 处理获取的下级数据 
         * @name 梁汝翔<liangruxiang>
         * @time 2015年6月16日 16:20:00 
         */
        function ShowChildUserCont(data, fn) {
            if (typeof data == "string") { data = eval("(" + data + ")"); }
            var theChildList = "";
            if (data != undefined) {
                theChildList += "<div class='send_msg_listUserCont'><div class='search_child_user_cont'>";
                theChildList += "<span class='label_input'><input type='text' value='' class='search_user_input'></span>";
                theChildList += "<span class='label_btn'><a href='javascript:void(0)' class='search_user_btnslrx'>搜&nbsp;&nbsp;索</a></span>";
                theChildList += "</div><ul class='send_msg_li'>";
                for (var i = 0 ; i < data.Data.length ; i++) {
                    theChildList += "<li class='child_user'><a href='javascript:void(0)'  guid='" + data.Data[i] + "'>" + data.Data[i] + "</a></li>";
                }
                theChildList += "</ul></div>";
            }

            if (theChildList != "") {
                art.dialog({
                    'title': '选择下级成员',
                    'width': '410px',
                    'height': '150px',
                    'padding': '10px 20px',
                    'content': theChildList,
                    'cancel': true,
                    'lock': true,
                    'ok': function () {
                        var theBack_obj = [];
                        var _Curr_len = $(".send_msg_li li.curr").size();
                        if (_Curr_len > 0) {
                            for (var i = 0; i < _Curr_len ; i++) {
                                var theobj = {};
                                theobj.name = $(".send_msg_li li.curr:eq(" + i + ")").find("a").eq(0).text();
                                theobj.guid = $(".send_msg_li li.curr:eq(" + i + ")").find("a").eq(0).attr("guid");
                                theBack_obj.push(theobj);
                            }

                        }
                        fn(theBack_obj);
                    }
                });
            }

            BindCheckUserAlertInfo();
        }

        /**
         * @content 绑定点击选中收件人的事件 
         * @name 梁汝翔<liangruxiang>
         * @time 2015年6月16日 16:20:00 
         */
        function BindCheckUserAlertInfo() {
            var ChildUser_arrays = new Array();
            $(".send_msg_li .child_user").each(function () {
                var _theValue = $(this).find("a").attr("guid");
                var _theText = $(this).find("a").eq(0).text();
                ChildUser_arrays.push(_theText);
            });

            $(".search_user_btnslrx").unbind("click").click(function () {
                var theSearch_text = $(".search_user_input").val(); //输入的下级用户
                var mark = false;
                if (theSearch_text != "") {
                    if (ChildUser_arrays.length > 0) {
                        for (var i = 0 ; i < ChildUser_arrays.length ; i++) {
                            var theText = ChildUser_arrays[i];
                            if (theText == theSearch_text) {
                                $(".send_msg_li").find("li").eq(i).find(".child_user").click();
                                $(".send_msg_li").find("li").eq(i).addClass("curr");
                                mark = true;
                            }
                        }
                    }
                }
                if (mark == false) {
                    alert('不存在该下级用户，请重新输入！');
                }
            });

            $(".send_msg_li .child_user").click(function () {
                $(this).addClass("curr");
            });
        }

        $("#check_child_user").click(function () {
            var theData = $(this).attr("jsondata");
            if (theData == undefined) {
                //获取下级成员列表  回调显示弹窗
                getChildUserInfos($(this), SureCheckeSJR);
            } else {
                //显示弹窗
                ShowChildUserCont(theData, SureCheckeSJR);
            }
        });

        $("#form1 .sub_btn").click(function () {
            var theStatue = $(this).attr("state");
            if (theStatue == "true" || theStatue == undefined) {
                $(this).attr("state", "false");
                var theData = "";
                $("#childUserList").find(".user_child").each(function () {
                    var theIValue = $(this).attr("value");
                    theData += theIValue + "@";
                });

                if (theData != "") {
                    theData = theData.substr(0, theData.length - 1);
                    var theTitle = $("#msg_title").val();
                    var theTextarea = $("#msg_textarea").val();
                    if (theTitle != "" && theTextarea != "") {
                        $.ajax({
                            type: "POST",
                            url: "",
                            data: {
                                action: "sendLetter",
                                title: theTitle,
                                content: theTextarea,
                                receiveUser_ID: theData
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
                    } else {
                        alert("请把信息填写完整");
                        $(this).attr("state", "true");
                        return false;
                    }
                } else {
                    alert("请选择信息收件人");
                    $(this).attr("state", "true");
                    return false;
                }
            }
            return false;
        })
    }



    /**
     * @content 初始化和插叙会员中心合买记录数据
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月12日 10:07:09
     */
    if ($("#HMBetting_records").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['lottery_code', 'issuseNo', 'startTime', 'endTime', 'record_code'], "byChildCurr": ['intTime', 'state'], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件


        //回调函数
        function HM_Betting_recordlist(data, initcond, _InitCallback) {
            //console.log("初始化投注记录的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1") {

                var _TrData = data.Data.DataRow == undefined ? {} : data.Data.DataRow;
                if (_TrData.length >= 0) { $(".Records_listCont").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var strVar = "";
                    strVar += "<tr>";
                    strVar += " <td colspan='2' class='c_yellow'>" + _TrData[i].lottery_name + "</td>";
                    strVar += " <td>" + _TrData[i].record_code + "</td>";
                    strVar += " <td>" + _TrData[i].issueNo + "</td>";
                    strVar += " <td class='c_org'>" + _TrData[i].normal_money + "</td>";
                    strVar += " <td>" + _TrData[i].open_num + "</td>";
                    strVar += " <td>" + _TrData[i].scheme_state + "</td>";
                    strVar += " <td>" + _TrData[i].time + "</td>";
                    strVar += " <td colspan='2'><a class='alink' href='" + _TrData[i].url + "'>查看</a></td>";
                    strVar += "</tr>";

                    var theHtml = $(strVar);
                    $(".Records_listCont").append(theHtml);

                }

                var _pageTotal = data.Data.DataCount;
                var _pageShow = 10;
                var _pageCurr = initcond.PageIndex;
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

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("HMBetting_records", condition_array, HM_Betting_recordlist);

        //点击查询事件
        //1、切换彩种触发的查询事件
        $("#lottery_code").change(function () {
            _InitPageData("HMBetting_records", condition_array, HM_Betting_recordlist);
        });
        //1、点击时间区域的时候触发的查询事件
        $("#intTime .a_item").click(function () {
            $(this).siblings(".a_item").removeClass("curr");
            $(this).addClass("curr");
            _InitPageData("HMBetting_records", condition_array, HM_Betting_recordlist);
        });
        //1、点击时间区域的时候触发的查询事件
        $("#state[name='Time_Status'] .a_item").click(function () {
            $(this).siblings(".a_item").removeClass("curr");
            $(this).addClass("curr");
            _InitPageData("HMBetting_records", condition_array, HM_Betting_recordlist);
        });
        //1、点击时间区域的时候触发的查询事件
        $("#HMBetting_records .sub_btn").click(function () {

            var theStartTime = $("#startTime").val();
            var theendTime = $("#endTime").val();
            var theState = true;
            if (theStartTime != "" && theendTime != "") {
                //比较时间正确性
                var CompareTime = compareTime(theStartTime, theendTime, "-");
                if (!CompareTime) {
                    theState = false;
                } else {
                    $("#intTime .a_item").removeClass("curr");
                    $("#intTime .a_item:last").addClass("curr");
                }
            }
            if (theState) {
                _InitPageData("HMBetting_records", condition_array, HM_Betting_recordlist);
            } else {
                alert("查询的时间区域有误");
            }
        });
        //1、点击时间区域的时候触发的查询事件
        $("#HMBetting_records .alink[type='reset']").click(function () {
            $("#startTime").val("");
            $("#endTime").val("");
            $("#issuseNo").val("");
            $("#record_code").val("");
            _InitPageData("HMBetting_records", condition_array, HM_Betting_recordlist);
        });
    }



    /**
     * @content 合买大厅列表
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月12日 10:07:09
     */
    if ($("#HeMai_ContList").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['JiDu', 'LaunchName', 'StartTime', 'EndTime'], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function HeMai_ContListFn(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1" && data.Data != null) {

                var _TrData = data.Data.Data == undefined ? {} : data.Data.Data;
                if (_TrData.length >= 0) { $("#hm_listCont_dlCont").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var strVar = "";

                    strVar += "<li class='header_th'>";
                    strVar += "    <span class='Nober'>" + (i + 1) + "</span>";
                    strVar += "    <span class='Creater'>" + _TrData[i].userName + "</span>";
                    strVar += "    <span class='TypeOf'>" + _TrData[i].lotteryName + "</span>";
                    strVar += "    <span class='Proccess'>" + _TrData[i].fullState + "</span>";
                    strVar += "    <span class='SolutPrice'>" + parseFloat(_TrData[i].schemeMoney).toFixed(2) + "&nbsp;|&nbsp;" + parseFloat(_TrData[i].money).toFixed(2) + "</span> ";
                    strVar += "    <span class='BuyAmount tc'>" + _TrData[i].buyCount + "</span>";
                    strVar += "    <span class='Times tc'>" + _TrData[i].time + "</span>";

                    if (_TrData[i].fullState != "已满员") {
                        if (_TrData[i].schemeStatus == "进行中") {
                            strVar += "    <span class='Action'><a class='fl w_50_pct tc' href='" + _TrData[i].url + "'>购买</a></span>";
                        } else {
                            strVar += "    <span class='Action'><a class='fl w_50_pct tc' style='background: #888;' href='javascript:void(0)'>已结束</a></span>";
                        }
                    } else {
                        strVar += "    <span class='Action'><a class='fl w_50_pct tc' style='background: #888;'  href='javascript:void(0)'>满员</a></span>";
                    }
                    strVar += "</li>";
                    var theHtml = $(strVar);
                    $("#hm_listCont_dlCont").append(theHtml);
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
        _InitPageData("HeMai_ContList", condition_array, HeMai_ContListFn);

        //点击查询按钮
        $("#HeMai_ContList .sub_btn").click(function () {
            var theSTime = $("#StartTime").val();
            var theETime = $("#EndTime").val();
            var theState = true;
            if (theSTime != "" && theETime != "") {
                //比较时间正确性 
                if (!compareTime(theSTime, theETime, "-")) {
                    theState = false;
                }
            }
            if (theState) {
                _InitPageData("HeMai_ContList", condition_array, HeMai_ContListFn);
            } else {
                alert("查询的时间区域有误");
            }
        });

    }

    /**
     * @content 玩家开户
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月12日 10:07:09
     */
    if ($("#ucenter_openPlayer").size() > 0) {
        //提交开户信息
        $("#ucenter_openPlayer .sub_btn").click(function () {

            var _user_type_id = $("#user_type_id").find(".curr").attr("value"); //开户类型
            var _eff_time = $("#eff_time").val(); //链接有效期
            var _remark = $("#remark").val(); //链接备注

            var _pointJson = ""; //返点数据
            var _subState = {
                msg: "",
                state: true
            };

            //遍历返点数据
            $("#ucenter_openPlayer .point_type_obj").each(function () {
                var theIds = $(this).attr("point_id") == undefined ? 0 : $(this).attr("point_id");
                var thePointValue = $(this).next(".ty_text").val() == undefined ? 9.9 : $(this).next(".ty_text").val();
                if (theIds != "" && thePointValue != "") {
                    _pointJson += theIds + "#" + thePointValue + "@";
                } else {
                    _subState.msg = $(this).parents("tr").eq(0).find(".td1").eq(0).find("h2").text() + "返点不能为空";
                    _subState.obj = $(this).next(".ty_text");
                    _subState.state = false;
                }
            });

            if (_subState.state) {
                if (_pointJson != "") { _pointJson = _pointJson.substr(0, _pointJson.length - 1); }
                if (_user_type_id != "" && _eff_time != "" && _remark != "") {
                    $.ajax({
                        type: "post",
                        url: "",
                        data: {
                            action: 'addUrl',
                            eff_time: _eff_time,
                            remark: _remark,
                            user_type_id: _user_type_id,
                            pointJson: _pointJson
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.Code == 1) {
                                alert(data.StrCode);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                alert(data.StrCode);
                            }
                        }
                    });
                } else {
                    $("#remark").focus();
                    return false;
                }
            } else {
                alert(_subState.msg);
                _subState.obj.focus();
                return false;
            }
        });
    }

    /**
     * @content 购买合买信息
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月12日 10:07:09
     */
    if ($("#join_with_buy").size() > 0) {

        //获取购买用户信息
        $("#join_with_buy #look_more_hemai").unbind("click").click(function (event) {
            event.stopPropagation();
            var theStatue = $(this).attr("state");
            var theScheme_id = $("#join_with_buy .sub_btn").attr("scheme_id") == undefined ? 0 : $("#join_with_buy .sub_btn").attr("scheme_id");
            if (theStatue == undefined || theStatue == "true") {
                theStatue = false;
                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        action: "getData",
                        scheme_id: theScheme_id
                    },
                    dataType: "JSON",
                    success: function (data) {
                        if (data != undefined && data.Code == 1) {
                            if (data.Data.length > 0) {
                                $("#join_with_buy .join_userlist").empty();
                            }
                            for (var i in data.Data) {
                                var theNames = data.Data[i].userName == undefined ? "ceshi123" : data.Data[i].userName;
                                //theNames = theNames.substr(0,4) + "***" + theNames.substr(theNames.length - 1, 1);
                                var theStr = "<dd>" + theNames + "，参与了本次合买。认购了&nbsp;<i class='c_org'>" + data.Data[i].buyCount + "</i>&nbsp;份</dd>";
                                $("#join_with_buy .join_userlist").append($(theStr));
                            }

                            $("#join_with_buy .join_userlist").slideDown();
                            theStatue == true;
                        } else {
                            $("#join_with_buy .join_userlist").slideUp();
                        }
                    }
                })
            } else {
                $("#join_with_buy .join_userlist").slideUp();
            }
        });

        //提交购买信息
        $("#join_with_buy .sub_btn").unbind("click").click(function (event) {
            event.stopPropagation();
            var theScheme_id = $("#join_with_buy .sub_btn").attr("scheme_id") == undefined ? 0 : $("#join_with_buy .sub_btn").attr("scheme_id");
            var thebuy_count = $("#join_with_buy #buy_numb").val() == undefined ? 0 : $("#join_with_buy #buy_numb").val();
            if (thebuy_count > 0) {
                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        action: "add",
                        scheme_id: theScheme_id,
                        buy_count: thebuy_count
                    },
                    dataType: "JSON",
                    success: function (data) {
                        if (data != undefined && data.Code == 1) {
                            alert(data.StrCode);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else {
                            alert(data.StrCode);
                        }
                    }
                });
            }
        });

        //绑定输入事件
        $("#join_with_buy #buy_numb").keyup(function (event) {
            var theValue = $(this).val();
            var thekeyCode = event.keyCode;
            if (thekeyCode == 39 || thekeyCode == 40) {

                theValue = isNaN(parseInt(theValue)) ? 0 : parseInt(theValue);
                $(this).val(theValue);

            } else {
                theValue = theValue.replace(/[^\d|]/g, "")
                $(this).val(theValue);
            }

            var theEachMoney = $(this).attr("eachmoney");
            var buyPrice = parseFloat(theEachMoney * theValue).toFixed(2);
            buyPrice = isNaN(buyPrice) ? 0.00 : buyPrice;
            $("#needPay").empty().text("￥" + buyPrice);

        }).blur(function () {

            var theValue = $(this).val();
            var theMaxValue = isNaN(Number($("#canBuyCount").text())) ? 0 : Number($("#canBuyCount").text());

            if (theValue > theMaxValue) {
                $(this).val(theMaxValue);
                theValue = theMaxValue;
            }

            var theEachMoney = $(this).attr("eachmoney");
            var buyPrice = parseFloat(theEachMoney * theValue).toFixed(2);
            buyPrice = isNaN(buyPrice) ? 0.00 : buyPrice;
            $("#needPay").empty().text("￥" + buyPrice);

        });

    }


    /**
     * @content 投注大厅，倍数的change事件限定
     * @author  梁汝翔<liangruxiang>  
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
     * @author  梁汝翔<liangruxiang>  
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
     * @content 初始化获取追号记录
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#Invest_zh_records").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['lottery_code', 'issuseNo', 'startTime', 'endTime', 'record_code'], "byChildCurr": ['intTime', 'state'], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件


        //回调函数
        function Invest_zh_recordslist(data, initcond, _InitCallback) {
            ////console.log("初始化追号记录的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1") {

                var _TrData = data.Data.DataRow == undefined ? {} : data.Data.DataRow;
                if (_TrData.length >= 0) { $(".invest_zh_listCont").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var strVar = "";
                    strVar += "<tr>";
                    strVar += " <td colspan='2' class='c_yellow'>" + _TrData[i].record_code + "</td>"; //记录编号
                    strVar += " <td>" + _TrData[i].lottery_name + "</td>"; //彩种名称
                    strVar += " <td>" + _TrData[i].issueNo + "</td>";  //起始期号
                    strVar += " <td>" + _TrData[i].complete_issueNo + "</td>"; //已追/总期数
                    strVar += " <td class='c_org'>" + _TrData[i].complete_money + "</td>"; // 已投/总金额
                    strVar += " <td>" + _TrData[i].state + "</td>";  //状态
                    strVar += " <td>" + _TrData[i].time + "</td>";  //时间
                    strVar += " <td colspan='2'><a class='alink' href='" + _TrData[i].url + "'>查看</a></td>"; //查看
                    strVar += "</tr>";
                    var theHtml = $(strVar);
                    $(".invest_zh_listCont").append(theHtml);

                }

                var _pageTotal = data.Data.DataCount;
                var _pageShow = 10;
                var _pageCurr = initcond.PageIndex;
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

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("Invest_zh_records", condition_array, Invest_zh_recordslist);

        //点击查询事件
        //1、切换彩种触发的查询事件
        $("#Invest_zh_records #lottery_code").change(function () {
            _InitPageData("Invest_zh_records", condition_array, Invest_zh_recordslist);
        });
        //1、点击时间区域的时候触发的查询事件
        $("#Invest_zh_records #intTime .a_item").click(function () {
            $(this).siblings(".a_item").removeClass("curr");
            $(this).addClass("curr");
            _InitPageData("Invest_zh_records", condition_array, Invest_zh_recordslist);
        });
        //1、点击时间区域的时候触发的查询事件
        $("#Invest_zh_records #state[name='Time_Status'] .a_item").click(function () {
            $(this).siblings(".a_item").removeClass("curr");
            $(this).addClass("curr");
            _InitPageData("Invest_zh_records", condition_array, Invest_zh_recordslist);
        });
        //1、点击时间区域的时候触发的查询事件
        $("#Invest_zh_records .sub_btn").click(function () {

            var theStartTime = $("#startTime").val();
            var theendTime = $("#endTime").val();
            var theState = true;
            if (theStartTime != "" && theendTime != "") {
                //比较时间正确性
                var CompareTime = compareTime(theStartTime, theendTime, "-");
                if (!CompareTime) {
                    theState = false;
                } else {
                    $("#Invest_zh_records #intTime .a_item").removeClass("curr");
                    $("#Invest_zh_records #intTime .a_item:last").addClass("curr");
                }
            }
            if (theState) {
                _InitPageData("Invest_zh_records", condition_array, Invest_zh_recordslist);
            } else {
                alert("查询的时间区域有误");
            }
        });
        //1、点击时间区域的时候触发的查询事件
        $("#Invest_zh_records .alink[type='reset']").click(function () {
            $("#startTime").val("");
            $("#endTime").val("");
            $("#issuseNo").val("");
            $("#record_code").val("");
            _InitPageData("Invest_zh_records", condition_array, Invest_zh_recordslist);
        });
    }

    /**
     * @content 安全问题
     * @author  梁汝翔<liangruxiang>  
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
         * @author  梁汝翔<liangruxiang>  
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
         * @author  梁汝翔<liangruxiang>  
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
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#user_personaInfos").size() > 0) {

        /**
         * @content 个人资料Form表单提交
         * @author  梁汝翔<liangruxiang>  
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
         * @author  梁汝翔<liangruxiang>  
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
         * @author  梁汝翔<liangruxiang>  
         * @time 2015年7月28日 10:07:09
         */
        $("#user_personaInfos").on("click", ".del_qline", function () {
            var theTrObj = $(this).parents("tr").eq(0);
            theTrObj.remove();
        });
    }


    /**
     * @content 整站右侧的浮动JS链接管理
     * @author  梁汝翔<liangruxiang>  
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
     * @author  梁汝翔<liangruxiang>  
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
     * @author  梁汝翔<liangruxiang>  
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
                                    //artDialog({
                                    //    icon: "success",
                                    //    ok: function () { 
                                    //        window.location.reload(); 
                                    //    },
                                    //    content: data.StrCode,
                                    //    close: function () { 
                                    //       window.location.reload(); 
                                    //    }
                                    //});
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

            /*if (confirm("撤单不可恢复,确认撤单?")) {
                var the_CD_Id = $(this).attr("lottery_orders_id");
                if (the_CD_Id != undefined && the_CD_Id != "") {
                    $.ajax({
                        type: "post",
                        url: "",
                        data: {
                            action: "cheDan",
                            lottery_orders_id: the_CD_Id
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data != undefined && data.Code == 1) {
                                alert(data.StrCode);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 3000);
                            } else {
                                alert(data.StrCode);
                            }
                        }
                    })
                }
            } */
        });
    }

    /**
     * @content 投注大厅撤单js
     * @author  梁汝翔<liangruxiang>  
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
     * @author  梁汝翔<liangruxiang>  
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
     * @content 帮助中心列表
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#category_id__channel_id").size() > 0) {




        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": [], "byChildCurr": ['category_id__channel_id'], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        var theFirstCate_Name = $("#category_id__channel_id .curr").text();
        $("#help_containers .help_main .m_tit h2").empty().text(theFirstCate_Name);

        //回调数据
        function help_containers_ListFn(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1" && data.Data != null) {
                var _TrData = data.Data.Data == undefined ? {} : data.Data.Data;
                if (_TrData.length >= 0) { $("#ul_help_s").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var strVar = "";
                    strVar += "<li class='help_li'>";
                    strVar += "     <p class='help_list_name'>";
                    strVar += "         <span class='num'>" + [i + 1] + "</span>";
                    strVar += "         <a href='" + _TrData[i].Url + "'>" + _TrData[i].Title + "</a>";
                    strVar += "     </p>";
                    strVar += "     <p class='help_list_text'>";
                    var ziliao = _TrData[i].ZhaiYao == null ? "" : _TrData[i].ZhaiYao;
                    strVar += ziliao + "<a href='" + _TrData[i].Url + "' class='alink'>[详情]</a>";
                    strVar += "     </p>";
                    strVar += "</li>";

                    var theHtml = $(strVar);
                    $("#ul_help_s").append(theHtml);
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
        if ($("#category_id__channel_ids") <= 0) {

            _InitPageData("help_containers", condition_array, help_containers_ListFn);
        }

        //查询分类数据
        $("#help_containers .getHelpCate").click(function () {
            $("#help_containers .getHelpCate").removeClass("curr");
            $(this).addClass("curr");

            var theFirstCate_Name = $("#category_id__channel_id .curr").text();
            $("#help_containers .help_main .m_tit h2 , #help_containers .help_main .hc_tit h2").empty().text(theFirstCate_Name);

            //初始化容器的数据，并调用回调函数Betting_recordlist
            var condition_array = { "byid": [], "byChildCurr": ['category_id__channel_id'], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件
            _InitPageData("help_containers", condition_array, help_containers_ListFn);
        });


        var _theUrl = window.location.href;

        if (_theUrl.indexOf("category_id__channel_id=") > 0) {
            var _theCanShu = _theUrl.split("category_id__channel_id=")[1]; //获取参数 
            $("#category_id__channel_id").find("a").removeClass("curr");
            $("#category_id__channel_id").find("a[value='" + _theCanShu + "']").eq(0).addClass("curr");
            $("#category_id__channel_id").find("a[value='" + _theCanShu + "']").eq(0).click();
        }
    }

    //查询分类数据
    $("#help_containers #category_id__channel_ids .getHelpCate").click(function (event) {
        event.stopPropagation();
        $("#help_containers .getHelpCate").removeClass("curr");
        var condition_array = { "byid": [], "byChildCurr": ['category_id__channel_id'], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件
        $(this).addClass("curr");

        var theFirstCate_Name = $("#category_id__channel_id .curr").text();
        $("#help_containers .help_main .m_tit h2 , #help_containers .help_main .hc_tit h2").empty().text(theFirstCate_Name);

        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": [], "byChildCurr": ['category_id__channel_id'], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件
        _InitPageData("help_containers", condition_array, help_containers_ListFn);
    });

    /**
     * @content 报表查询
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($("#baobiao_search_cont").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['lottery_code', 'user_Name', 'start_date', 'date', 'user_type', 'user_id'], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件 

        //回调函数
        function table_showBaoBiaolist(data, initcond, _InitCallback) {
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1") {
                var _TrData = data.Data.DataRow == undefined ? {} : data.Data.DataRow;
                if (_TrData.length >= 0) { $("#table_showBaoBiao").empty(); }
                for (var a = 0 ; a < _TrData.length ; a++) {
                    var strVar = "";

                    var userName = _TrData[a].userName;  //用户名称 
                    var userGroup = _TrData[a].userGroup;		//用户组
                    var totalPurchasingMoney = _TrData[a].totalPurchasingMoney;   //总代购费
                    var totalRebate = _TrData[a].totalRebate; //总返点
                    var winningMoney = _TrData[a].winningMoney //中奖金额
                    var activityMoney = _TrData[a].activityMoney //活动礼金
                    var actualPurchasingMoney = _TrData[a].actualPurchasingMoney;  //实际总代购费
                    var totalCalculation = _TrData[a].totalCalculation; //总结算
                    var is_XiaJi = _TrData[a].is_XiaJi; 	//是否有下级
                    var user_id = _TrData[a].user_id //用户ID
                    if (is_XiaJi == true) {
                        var is_XiaJi_show = '<a href="javascript:void(0)" class="alink lookDowner" user_id ="' + user_id + '">查看下级</a>'
                    }
                    else {
                        var is_XiaJi_show = ""
                    };

                    strVar += "<tr>";
                    strVar += " <td>" + userName + "</td>";
                    strVar += " <td>" + userGroup + "</td>";
                    strVar += " <td>" + totalPurchasingMoney + "</td>";
                    strVar += " <td>" + totalRebate + "</td>";
                    strVar += " <td>" + actualPurchasingMoney + "</td>";
                    strVar += " <td>" + activityMoney + "</td>";
                    strVar += " <td>" + winningMoney + "</td>";
                    strVar += " <td>" + totalCalculation + "</td>";
                    strVar += " <td>" + is_XiaJi_show + "</td>";
                    strVar += "</tr>";

                    var theHtml = $(strVar);
                    $("#table_showBaoBiao").append(theHtml);
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

                var _NewInitCond = Json_To_String(initcond);
                _pagecontaier.attr("cont_id", 'baobiao_search_cont');
                _pagecontaier.attr("initcond", _NewInitCond);  
            }
        }

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("baobiao_search_cont", condition_array, table_showBaoBiaolist);

        //点击查询事件
        //1、切换彩种触发的查询事件
        $("#lottery_code").change(function () {
            _InitPageData("baobiao_search_cont", condition_array, table_showBaoBiaolist);
        });

        //1、点击时间区域的时候触发的查询事件
        $("#baobiao_search_cont .sub_btn").click(function () {
            var theUname = $("#user_Name").val();  //用户名
            var theendTime = $("#date").val();  //查询时间
            var theState = true;
            _InitPageData("baobiao_search_cont", condition_array, table_showBaoBiaolist);
        });

        //点击查看下级
        $("#baobiao_search_cont").on("click", ".lookDowner", function () {
            var theValue = $(this).attr("user_id");
            if (theValue != "") {
                $("#user_id").val(theValue);
                $("#user_type").val("2");
            } else {
                $("#user_id").val("");
                $("#user_type").val("1");
            }
            $("#baobiao_search_cont .sub_btn").click();
        });
    }


    /**
     * @content 代理分红
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($("#user_fh_container").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['lottery_code', 'user_Name', 'start_date', 'date', 'user_type', 'user_id'], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件 

        //回调函数
        function Uaccount_showFHlist(data, initcond, _InitCallback) {
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1") {
                var _TrData = data.Data.DataRow == undefined ? {} : data.Data.DataRow;
                if (_TrData.length >= 0) { $("#insertDaili").empty(); }
                for (var a = 0 ; a < _TrData.length ; a++) {
                    var strVar = "";

                    var userName = _TrData[a].userName;		// 用户名称
                    var userGroup = _TrData[a].userGroup;   //用户组
                    var bettingMoney = _TrData[a].bettingMoney; //投注总额
                    var bonus_money = _TrData[a].bonus_money //中奖总额
                    var cancellations_money = _TrData[a].cancellations_money;  //撤单总额
                    var getpoint_money = _TrData[a].getpoint_money; //返点总额
                    var charge_money = _TrData[a].charge_money; 	//充值总额
                    var withdrawl_money = _TrData[a].withdrawl_money //取款总额
                    var profit_loss_money = _TrData[a].profit_loss_money //盈亏总额
                    var activity_money = _TrData[a].activity_money //活动礼金

                    var user_id = _TrData[a].user_id;  //数据行主键 
                    var is_XiaJi = _TrData[a].is_XiaJi //是否有下级
                    if (is_XiaJi == true) {
                        var is_XiaJi_show = '<a href="javascript:void(0)" class="alink lookDowner" user_id ="' + user_id + '" >查看下级</a>';
                    }
                    else {
                        var is_XiaJi_show = "&nbsp;";
                    }

                    strVar += "<tr>";
                    strVar += " <td>" + userName + "</td>";
                    strVar += " <td>" + userGroup + "</td>";
                    strVar += " <td>" + bettingMoney + "</td>";
                    strVar += " <td>" + bonus_money + "</td>";
                    strVar += " <td>" + cancellations_money + "</td>";
                    strVar += " <td>" + getpoint_money + "</td>";
                    strVar += " <td>" + activity_money + "</td>";
                    strVar += " <td>" + charge_money + "</td>";
                    strVar += " <td>" + withdrawl_money + "</td>";
                    strVar += " <td>" + profit_loss_money + "</td>";
                    strVar += " <td>" + is_XiaJi_show + "</td>";
                    strVar += "</tr>";

                    var theHtml = $(strVar);
                    $("#insertDaili").append(theHtml);
                }

                var _pageTotal = data.Data.DataCount;
                var _pageShow = 10;
                var _pageCurr = initcond.PageIndex;
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
                var _NewInitCond = Json_To_String(initcond);
                
                _pagecontaier.attr("cont_id", "user_fh_container");
                _pagecontaier.attr("initcond", _NewInitCond);
            }
        }

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("user_fh_container", condition_array, Uaccount_showFHlist);

        //点击查询事件
        //1、切换彩种触发的查询事件
        $("#lottery_code").change(function () {
            _InitPageData("user_fh_container", condition_array, Uaccount_showFHlist);
        });

        //1、点击时间区域的时候触发的查询事件
        $("#user_fh_container .sub_btn").click(function () {
            var theUname = $("#user_Name").val();  //用户名
            var theendTime = $("#date").val();  //查询时间
            var theState = true;
            _InitPageData("user_fh_container", condition_array, Uaccount_showFHlist);
        });

        //点击查看下级
        $("#user_fh_container").on("click", ".lookDowner", function () {
            var theValue = $(this).attr("user_id");
            if (theValue != "") {
                $("#user_id").val(theValue);
                $("#user_type").val("2");
            } else {
                $("#user_id").val("");
                $("#user_type").val("1");
            }
            $("#user_fh_container .sub_btn").click();
        });
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
            var theMoney = $("#rechargeOrder4 input[name='money']").val(); //充值的金额
            var theMessage = $("#rechargeOrder4 input[name='message']").val(); //付款人姓名
            theMoney = isNaN(Number(theMoney)) ? 0 : Number(theMoney);

            if (theMoney > 0) {
                check_recharge_order($(this));
            } else {
                $("#rechargeOrder4 input[name='money']").focus();
            }

        });
    }



    /**
     * @content 关闭购彩大厅的导航栏
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($("#j_play_select").size() > 0) {
        $("#header .nav").hide();
    } else {
        $("#header .nav").show();
    }

    /**
     * @content 删除银行卡
     * @author  梁汝翔<liangruxiang>  
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
     * @author  梁汝翔<liangruxiang>  
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
     * @content 充值有礼
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($(".get_Reward").size() > 0) {
        $(".get_Reward").click(function () {
            $.ajax({
                type: "POST",
                url: "",
                data: {
                    action: "ReceBonus"
                },
                dataType: "json",
                success: function (data) {
                    if (data && data.Code == 1) {
                        alert(data.StrCode);
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        alert(data.StrCode);
                    }
                }
            })
        })
    }

    /**
     * @content 充值回馈
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($(".active_1_page .lj_btn").size() > 0) {
        $(".active_1_page .lj_btn").click(function () {
            var theId = $(this).attr("donate_id") == undefined ? "" : $(this).attr("donate_id");
            if (theId != "") {
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        action: "ReceBonus",
                        donate_id: theId
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data && data.Code == 1) {
                            alert(data.StrCode);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else {
                            alert(data.StrCode);
                        }
                    }
                })
            }
        })
    }

    /**
     * @content 连欢乐
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($(".active_4_page").size() > 0) {
        //点击领奖
        $(".active_4_page .get_jiangping").click(function () {
            $.ajax({
                type: "POST",
                url: "",
                data: {
                    action: "ReceBonus"
                },
                dataType: "json",
                success: function (data) {
                    if (data && data.Code == 1) {
                        alert(data.StrCode);
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        alert(data.StrCode);
                    }
                }
            })
        })

        /**
         * @content 获取签到数据
         * @author  梁汝翔<liangruxiang>  
         * @time 2015年8月20日 10:07:09
         */
        if ($("#qd_date").size() > 0) {
            $.ajax({
                type: "POST",
                url: "",
                data: {
                    action: "GetData"
                },
                dataType: "json",
                success: function (data) {
                    if (data.Code == 1) {
                        if (data.Data != undefined && data.Data.length > 0) {
                            var Datas = new Array();
                            for (var i = 0 ; i < data.Data.length ; i++) {
                                var theDates = new Date(data.Data[i]);
                                var theDays = theDates.getDate();
                                Datas.push(theDays);
                            }
                            ruiec_SignUpdate(Datas);
                        } else {
                            var datas = [];
                            ruiec_SignUpdate(datas);
                        }
                    } else {
                        var datas = [];
                        ruiec_SignUpdate(datas);
                    }
                }
            });

            /**
             * @content 点击签到今天
             * @author  梁汝翔<liangruxiang>  
             * @time 2015年8月20日 10:07:09
             */
            $("#qd_date").on("click", ".today_qd_btn", function () {
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        action: "QianDao"
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.Code == 1) {
                            alert(data.StrCode);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000)
                        } else {
                            alert(data.StrCode);
                        }
                    }
                });
            });
        }
    }

    /**
     * @content 活动，充值佣金的，用户佣金列表
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#yongjing_lq_infos").size() > 0) {

        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": [], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function yongjing_lq_ListFn(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1" && data.Data != null) {
                var _TrData = data.Data.Data == undefined ? {} : data.Data.Data;
                if (_TrData.length >= 0) { $("#yongjing_lq_infos .yongjin_infos").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var strVar = "";
                    strVar += "<tr class='news_li'>";
                    strVar += "    <td>" + _TrData[i].chargeUser + "</td>";
                    strVar += "    <td>" + _TrData[i].chargeMoney + "</td>";
                    strVar += "    <td>" + _TrData[i].brokerage_type + "</td>";
                    strVar += "    <td><a href='javascript:void(0)' value='" + _TrData[i].account_id + "'>点击领取</a></td>";
                    strVar += "</tr>";
                    var theHtml = $(strVar);
                    $("#yongjing_lq_infos .yongjin_infos").append(theHtml);
                }

                var _pageTotal = data.Data.DataCount;
                var _pageShow = 7;
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
        _InitPageData("yongjing_lq_infos", condition_array, yongjing_lq_ListFn);



        $(".yongjin_infos ").on('click', "a", function () {
            var _theValue = $(this).attr("value") == undefined ? "" : $(this).attr("value");
            if (_theValue != "") {
                var theText = $(this).text();
                var _this = $(this);
                if (theText != "已领取") {
                    $.ajax({
                        type: "post",
                        url: "",
                        data: {
                            action: "ReceBonus",
                            account_id: _theValue
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data == undefined) { data = {}; }
                            if (data.Code != undefined && data.Code == "1" && data.Data != null) {
                                _this.removeAttr("value");
                                alert(data.StrCode);
                                _this.empty().text("已领取");
                            }
                        }
                    })
                }
            }
        });
    }


    /**
     * @content 右侧滑动的显示展开效果
     * @author  梁汝翔<liangruxiang>  
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

    /**
     * @content 活动页面滚动侧边的高度，以及页面索引
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($("#activity_menu").size() > 0) {
        var _menu_len = $("#activity_menu li").length;
        if (_menu_len < 3) {
            var _menu_len_height = _menu_len * 66;
            $("#activity_menu").css("height", _menu_len_height + "px");
        } else {
            $("#activity_menu").css("height", "auto");
        }

        $("#activity .floor").each(function () {
            var _theIndex = $(this).index();
            if (_theIndex < 10) {
                _theIndex = "0" + _theIndex;
            }
            $(this).find(".f_tit dl dt").eq(0).empty().text(_theIndex);
        });
    }

    /**
     * @content 开户中心——快捷代理开户
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($("#openAgent_btn").size() > 0) {

        $(".agent_cont input.ty_text").keyup(function () {
            var _max_value = isNaN(Number($(this).attr("maxval"))) ? 13 : Number($(this).attr("maxval"));
            var _keyCode = event.keyCode == undefined ? 0 : event.keyCode;  //获取按键的keycode（编码）
            if (_keyCode != 37 && _keyCode != 39) { //左右箭头除外
                var _val = $(this).val();  //当前金额
                if (_val != "")	//当前字符串不能空
                {
                    _val = _val.replace(/[^\d|.]/g, ""); //正则处理数字和小数点以外的字符进行过滤
                    _val = _val.toString();
                    var _types = _val.indexOf(".");
                    if (_types == 0)  //第一个字符为.的时候，替换为0.；
                    {
                        _val = "0" + _val;

                        _val = Number(_val);
                    }

                    if (_val < 0) { _val = 0; }
                    if (_val > _max_value) { _val = _max_value; }
                    $(this).val(_val);
                }
            }
        }).blur(function () {
            var _max_value = isNaN(Number($(this).attr("maxval"))) ? 13 : Number($(this).attr("maxval"));
            var _keyCode = event.keyCode == undefined ? 0 : event.keyCode;  //获取按键的keycode（编码）
            if (_keyCode != 37 && _keyCode != 39) { //左右箭头除外
                var _val = $(this).val();  //当前金额
                if (_val != "")	//当前字符串不能空
                {
                    _val = _val.replace(/[^\d|.]/g, ""); //正则处理数字和小数点以外的字符进行过滤
                    _val = _val.toString();
                    var _types = _val.indexOf(".");
                    if (_types == 0)  //第一个字符为.的时候，替换为0.；
                    {
                        _val = "0" + _val;
                        _val = parseFloat(_val).toFixed(1);
                    } else {
                        _val = parseFloat(_val).toFixed(1);
                    }

                    var _lasttypes = _val.lastIndexOf(".");
                    if (_lasttypes != _types) //是否有多个“.”
                    {
                        _val = parseFloat(_val).toFixed(1);
                    }

                    if (_val < 0) { _val = 0; }
                    if (_val > _max_value) { _val = _max_value; }
                    $(this).val(_val);
                }
            }
        });



        //开户中心点击提交
        if ($("#openAgent_btn").size() > 0) {
            $("#openAgent_btn").click(function () {
                var oInput_text = $(".agent_cont .ty_text").val() == undefined ? 0 : $(".agent_cont .ty_text").val();
                var oIsPost = $(this).attr("state");  //是否调取ajax  
                var _this = $(this);
                if (oIsPost == undefined || oIsPost == "true") {
                    $(this).attr("state", "false");
                    var oData = {};
                    if ($("#user_type_id").find(".curr").eq(0).index() == 0)  //判断是代理还是玩家、如果是代理则为1，如果是玩家则为2
                    {
                        oData.user_type_id = 1;
                    }
                    else {
                        oData.user_type_id = 2;
                    };
                    //oData.eff_time = -1; //链接有效期 1为1天 5为5天 10为10天 30为30天 -1为永久有效
                    oData.eff_time = $("#eff_time").val();//链接有效期 1为1天 5为5天 10为10天 30为30天 -1为永久有效
                    oData.point_type = oInput_text; //返点等级
                    oData.action = "addUrl";
                    $.ajax({
                        type: "POST",
                        url: "user_account_proxy_openAgent.html",
                        data: oData,
                        dataType: "json",
                        success: function (data) {
                            var oCode = data.code;
                            var oStrCode = data.StrCode;
                            if (oCode != 1) {
                                alert(oStrCode);
                            }
                            else {
                                alert("提交成功！")
                            };
                            _this.attr("state", "true");
                        }
                    });
                }
                else {
                    return false;
                };

            });
        }

    }

    /**
     * @content 浮动广告关闭按钮
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($(".left_floatAdv .close_btn").size()) {
        $(".left_floatAdv .close_btn").click(function () {
            $(this).parent().hide();
        });
    }

    /**
     * @content 会员管理中心 -- 代理中心  查看会员详情
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    //if ($("#Account_cusmagListPage").size()) {

    //    //查看返点
    //    $("#Account_cusmagListPage").on("click", ".resetPoint", function () {
    //        var _thiePoint = $(this).attr("pointType") == undefined ? "" : $(this).attr("pointType");
    //        if (_thiePoint != "") {
    //            alert("当前下级返点为：" + _thiePoint);
    //        } else {
    //            alert("当前用户暂无返点");
    //        } 
    //    }); 
    //}

    /**
     * @content 会员管理中心 -- 代理中心  创建新的契约规则
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年8月20日 10:07:09
     */
    if ($(".qiyueForms").size()) {

        //提交契约规则
        $(".qiyueForms .sub_qiyue_rules").click(function () {
            var bouns_day = $("#bouns_day").val();
            var theQiyueContent = "<div style='text-align:left;line-height:25px;'><p>1、快三时时彩“契约分红协议”<br>为保障代理的分红利益,平台推出“契约分红协议”，该协议由上下级代理以自愿为原则签署，并接受平台的监督。<br>2. 服务说明<br>（1）“契约分红”就是上级与下级在平台内部建立的一种分红约定，并会由平台监督和监管。尽量保障下级分红利益的方式。<br>（2）本人需要先和上级签订了契约，才可以给下级签订。<br>（3）上级代理有义务按照分红契约中约定的比例发放分红。<br>（4）平台的分红周期为" + bouns_day + "天。如在结束时间后仍未发放分红，平台将认定为拒绝发放,将记入不良纪录。<br>3. 免责声明<br>（1）“契约分红协议”属于上下级代理之间的协议，平台有权监督契约执行情况。<br>（2）契约分红原则上必须经由平台发放。对于上级代理余额不足以发放分红时，平台允许但不鼓励上级代理经由平台外的第三方途径发放分红，但分红结果必须经下级代理平台内确认才算有效！平台外分红属于上下级之间私下协议，出现纠纷平台不承担任何责任和义务。<br>（3）分红尚未发放完成时，上级代理的账号资金暂时冻结，不得买单，兑换礼金，提现，向下代充等，直至分红发放完成！对于拒绝发放分红的上级，平台有权强制发放，情节严重者平台有权永久冻结其帐号并转移其下级！<br>4. 最终解释权<br>关于本平台中所有规则与条款，本平台保留所有最终解释权。</p></div>";
            var theQiyueFormObj = $(".qiyueForms").eq(0);
            var theChildUserId = $(this).attr("userid") == undefined ? 0 : $(this).attr("userid"),
                _qiYue_bonus = theQiyueFormObj.find(".qiyue_rules").eq(0).find(".middle_select").val() == undefined ? 8.0 : Number(theQiyueFormObj.find(".qiyue_rules").eq(0).find(".middle_select").val()), //保底分红
                _qiYue_Rules = new Array(),
                _qiYue_CheckObj;
            _qiYue_Rules_len = theQiyueFormObj.find(".qiyue_rules").length == undefined ? 1 : theQiyueFormObj.find(".qiyue_rules").length; //契约规则

            //遍历规则
            for (var j = 1; j < _qiYue_Rules_len ; j++) {
                var _theRulesObj = {},
                    _theRulesLineObj = theQiyueFormObj.find(".qiyue_rules").eq(j);

                var _month_sales = _theRulesLineObj.find(".sort_input").eq(0).val() == undefined ? "" : _theRulesLineObj.find(".sort_input").eq(0).val();//月销售量
                var _bonus = _theRulesLineObj.find(".fh_select").eq(0).val() == undefined ? _qiYue_bonus : _theRulesLineObj.find(".fh_select").eq(0).val();//月销售量

                _theRulesObj.month_sales = isNaN(Number(_month_sales)) ? 100 : Number(_month_sales);
                _theRulesObj.bonus = isNaN(Number(_bonus)) ? 10.0 : Number(_bonus);

                if (_theRulesObj.month_sales == "") {
                    _qiYue_CheckObj = _theRulesLineObj.find(".sort_input").eq(0);
                } else {
                    _qiYue_Rules.push(_theRulesObj);
                }
            }

            //if (_qiYue_CheckObj != undefined) {
            //    alert("请完善契约规则");
            //    _qiYue_CheckObj.focus();
            //    return false;
            //} else {
            if (theQiyueContent != "") {

                var _ActionType = $(this).attr("actionType") == undefined ? "Add" : $(this).attr("actionType"); //操作类型
                var _thid = $(this);
                art.dialog({
                    'title': '快三时时彩分红契约规则须知',
                    'width': '510px',
                    'height': '360px',
                    'padding': '10px 20px',
                    'content': theQiyueContent,
                    'cancel': true,
                    'lock': true,
                    'ok': function () {
                        var _qiYue_Json = {};
                        _qiYue_Json.x_user_id = isNaN(Number(theChildUserId)) ? 0 : Number(theChildUserId);
                        _qiYue_Json.bonus = isNaN(Number(_qiYue_bonus)) ? 0 : Number(_qiYue_bonus);
                        _qiYue_Json.guize = _qiYue_Rules.length == 0 ? null : _qiYue_Rules;

                        var _qiYue_JsonString = Json_To_String(_qiYue_Json);
                        if (_qiYue_JsonString) {
                            $.ajax({
                                type: "post",
                                url: "",
                                data: {
                                    action: _ActionType,
                                    qiYue_Json: _qiYue_JsonString
                                },
                                dataType: "JSON",
                                success: function (data) {
                                    if (data.Code == 1) {
                                        alert(data.StrCode);
                                        if (_ActionType == "Update") {
                                            _this.addClass("curr");
                                        } else {
                                            var _theUrl = window.location.host;
                                            setTimeout(function () {
                                                window.location.href = "http://" + _theUrl + '/user_account_proxy_cusmag.html';
                                            }, 1500);
                                        }
                                    } else {
                                        alert(data.StrCode);
                                    }
                                }
                            })
                        }
                    }
                });
            }
            //} 

        });

    }


    /**
     * @content 站内信发送
     * @author  王志豪<wangzhihao>  
     * @time 2015年10月15日 19:30:09
     */
    if ($("#childUserList").size() > 0) {
        $("#childUserList").on("click", ".user_child i", function () {
            $(this).parent(".user_child").remove();
        });
    }

    /**
     * @content 我的契约 -- 代理中心  签订或者拒绝契约
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年10月16日 10:07:09
     */
    if ($(".accept_btn").size()) {

        //同意签约
        $(".accept_btn").click(function () {
            var bouns_day = $("#bouns_day").val();
            var theQiyueContent = "<div style='text-align:left;line-height:25px;'><p>1、快三时时彩“契约分红协议”<br>为保障代理的分红利益,平台推出“契约分红协议”，该协议由上下级代理以自愿为原则签署，并接受平台的监督。<br>2. 服务说明<br>（1）“契约分红”就是上级与下级在平台内部建立的一种分红约定，并会由平台监督和监管。尽量保障下级分红利益的方式。<br>（2）本人需要先和上级签订了契约，才可以给下级签订。<br>（3）上级代理有义务按照分红契约中约定的比例发放分红。<br>（4）平台的分红周期为" + bouns_day + "天。如在结束时间后仍未发放分红，平台将认定为拒绝发放,将记入不良纪录。<br>3. 免责声明<br>（1）“契约分红协议”属于上下级代理之间的协议，平台有权监督契约执行情况。<br>（2）契约分红原则上必须经由平台发放。对于上级代理余额不足以发放分红时，平台允许但不鼓励上级代理经由平台外的第三方途径发放分红，但分红结果必须经下级代理平台内确认才算有效！平台外分红属于上下级之间私下协议，出现纠纷平台不承担任何责任和义务。<br>（3）分红尚未发放完成时，上级代理的账号资金暂时冻结，不得买单，兑换礼金，提现，向下代充等，直至分红发放完成！对于拒绝发放分红的上级，平台有权强制发放，情节严重者平台有权永久冻结其帐号并转移其下级！<br>4. 最终解释权<br>关于本平台中所有规则与条款，本平台保留所有最终解释权。</p></div>";
            if (theQiyueContent != "") {
                var _this = $(this);
                art.dialog({
                    'title': '快三时时彩娱乐分红契约规则须知',
                    'width': '510px',
                    'height': '360px',
                    'padding': '10px 20px',
                    'content': theQiyueContent,
                    'cancel': true,
                    'lock': true,
                    'ok': function () {
                        var _ActionType = _this.attr("actionType") == undefined ? "Accept" : _this.attr("actionType");
                        $.ajax({
                            type: "post",
                            url: "",
                            data: {
                                action: _ActionType
                            },
                            dataType: "JSON",
                            success: function (data) {
                                if (data.Code == 1) {
                                    alert(data.StrCode);
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 1500);
                                } else {
                                    alert(data.StrCode);
                                }
                            }
                        });
                    }
                });
            }
        })

        //拒绝签约
        $(".jujue_btn").click(function () {
            var _theStatue = $(this).attr("statue");
            if (_theStatue == undefined || _theStatue == "true") {
                $(this).attr("statue", "false");
                var _this = $(this);
                var _ActionType = _this.attr("actionType") == undefined ? "TurnDown" : _this.attr("actionType");
                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        action: _ActionType
                    },
                    dataType: "JSON",
                    success: function (data) {
                        if (data.Code == 1) {
                            alert(data.StrCode);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        } else {
                            alert(data.StrCode);
                        }
                        _this.attr("statue", "true");

                    }
                })
            } else {
                return false;
            }
        });
    }

    /**
     * @content 我的契约 -- 代理中心  配额设置
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年10月16日 10:07:09
     */
    if ($(".PeiE_BtnLine").size()) {

        //配额输入框设定认证
        $(".PeiE_Inputs .sort_input").keyup(function (event) {
            var _keyCode = event.keyCode == undefined ? 0 : event.keyCode;  //获取按键的keycode（编码）
            if (_keyCode != 37 && _keyCode != 39) { //左右箭头除外
                var _val = $(this).val();  //当前金额
                if (_val != "")	//当前字符串不能空
                {
                    _val = _val.replace(/[^\d|]/g, ""); //正则处理数字和小数点以外的字符进行过滤 
                    $(this).val(_val);
                }
            }
        }).blur(function () {
            var _theValue = $(this).val();
            _theValue = _theValue.replace(/[^\d]/g, "");
            var _theMaxValue = $(this).parent().parent().find(".PeiE_Infos1").eq(0).find("i").eq(0).text();
            _theMaxValue = isNaN(Number(_theMaxValue)) ? -1 : Number(_theMaxValue)
            _theValue = isNaN(Number(_theValue)) ? 0 : Number(_theValue);

            if (_theValue > _theMaxValue && _theMaxValue >= 0) {
                $(this).val(_theMaxValue);
            } else if (_theValue <= _theMaxValue) {
                $(this).val(_theValue);
            } else {
                $(this).val(0);
            }
        });


        //提交内容
        $(".PeiE_BtnLine .sub_btn").click(function () {

            var _btnState = $(this).attr("state");
            if (_btnState == undefined || _btnState == "true") {
                var _PeiE_len = $(".PeiE_List .PeiE_Inputs").size() == undefined ? 0 : $(".PeiE_List .PeiE_Inputs").size(); //一共多少种配额模式
                var _PeiE_CheckObj, _PeiE_SubJSON = {};
                var _PeiE_DataArray = new Array;
                var _PeiE_UserID = $(this).attr("User_id") == undefined ? 0 : Number($(this).attr("User_id"));

                for (var i = 0 ; i < _PeiE_len ; i++) {
                    var _theLineObj = $(".PeiE_List .PeiE_Inputs:eq(" + i + ")").find(".sort_input").eq(0);

                    var _theLineObjValue = _theLineObj.val() == undefined ? "" : _theLineObj.val(); //调整数量
                    var _theLineObjLeave = _theLineObj.attr("level") == undefined ? "" : _theLineObj.attr("level"); //调整数量
                    var _LineData = {};
                    if (_theLineObjValue == "" || _theLineObjLeave == "") {
                        _PeiE_CheckObj = $(".PeiE_List .PeiE_Inputs:eq(" + i + ")").find(".sort_input");
                        i = _PeiE_len;
                    } else {
                        _LineData.point_type = isNaN(Number(_theLineObjLeave)) ? 0 : Number(_theLineObjLeave);
                        _LineData.charge_count = isNaN(Number(_theLineObjValue)) ? 0 : Number(_theLineObjValue);
                        _PeiE_DataArray.push(_LineData);
                    }
                }

                if (_PeiE_CheckObj != undefined) {
                    // alert("请完善配额设置信息");
                    _PeiE_CheckObj.focus();
                    return false;
                } else {
                    _PeiE_CheckObj = {};
                }

                if (_PeiE_DataArray.length < 1) _PeiE_DataArray = null;

                _PeiE_SubJSON.xiaJi = _PeiE_UserID;
                _PeiE_SubJSON.data = _PeiE_DataArray;

                if (_PeiE_UserID > 0) {
                    var _quoat_json = Json_To_String(_PeiE_SubJSON);
                    $.ajax({
                        type: "post",
                        url: "",
                        data: {
                            action: "add",
                            quoat_json: _quoat_json
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.Code == 1) {
                                alert(data.StrCode);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1500);
                            } else {
                                alert(data.StrCode);
                            }
                        }
                    })
                }
            } else {
                return false;
            }
        })
    }

    /**
     * @content 我的契约 -- 代理中心  创建用户
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年10月16日 10:07:09
     */
    if ($("#CreatPlayers").size()) {

        //切换创建用户类型
        $("#user_type li").click(function () {
            if ($(this).hasClass("curr")) {
                return false;
            } else {
                $(this).siblings().removeClass("curr");
                $(this).addClass("curr");
            }
        })
        //提交创建的表单
        $("#CreatPlayers .sub_btn").click(function () {
            var _PeiE_type = $("#point_type").val(); //配额等级
            var _Creatuser_type = $("#user_type").find(".curr").eq(0).attr("value") == undefined ? 1 : $("#user_type").find(".curr").eq(0).attr("value");
            _Creatuser_type = isNaN(Number(_Creatuser_type)) ? 1 : Number(_Creatuser_type);  //创建类型 
            var _user_name = $("#user_name").val(); //用户名称

            if (_user_name == "" || _PeiE_type == "") {
                alert("请完善添加信息");
                $("#user_name").focus();
                return false;
            }

            $.ajax({
                type: "post",
                url: "",
                data: {
                    action: 'Add',
                    point_type: _PeiE_type,
                    user_type: _Creatuser_type,
                    user_name: _user_name
                },
                dataType: "json",
                success: function (data) {
                    if (data.Code == 1) {
                        alert(data.StrCode);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    } else {
                        alert(data.StrCode);
                    }
                }
            })

        });

    }

    /**
     * @content 我的活动中心 -- 周返利
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年10月16日 10:07:09
     */
    if ($(".Zhou_Fanli").size()) {
        //参与周返利
        $(".Zhou_Fanli .join_btn").click(function () {
            $(".active_week_cont").show();
        });

        //限定输入内容
        $(".transfer_value .ty_text").keyup(function (event) {
            var theValue = $(this).val();
            event = event ? event : window.event;
            var thekeyCode = event.keyCode;
            if (thekeyCode == 39 || thekeyCode == 40) {

                theValue = isNaN(parseInt(theValue)) ? 0 : parseInt(theValue);
                $(this).val(theValue);

            } else {
                theValue = theValue.replace(/[^\d|]/g, "")
                $(this).val(theValue);
            }

        }).blur(function () {
            var _theValues = $(this).val();
            _theValues = _theValues.replace(/[^\d]/g, '');
            $(this).val(_theValues);
        });

        //确定参与
        $(".transfer_btns .sure_btn").click(function () {
            var _theValues = $(".transfer_value .ty_text").val();
            _theValues = _theValues.replace(/[^\d]/g, "");
            _theValues = isNaN(parseInt(_theValues)) ? 0 : parseInt(_theValues);

            $.ajax({
                type: "POST",
                url: "",
                data: {
                    action: "Activity_action",
                    prestore_money: _theValues
                },
                dataType: "json",
                success: function (data) {
                    if (data.Code == 1) {
                        alert(data.StrCode);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    } else {
                        alert(data.StrCode);
                        $(".active_week_cont").hide();
                    }
                }
            })
        });

        //取消参与
        $(".transfer_btns .reset_btn").click(function () {
            $(".active_week_cont").hide();
        });
        $(".active_containers .close_btn").click(function () {
            $(".active_week_cont").hide();
        });

        //领取25%奖励
        $(".Zhou_Fanli .linqu_btn").click(function () {
            var _theState = $(this).attr("state");
            if (_theState == undefined || _theState == "true") {
                $(this).attr("state", "false");
                var _this = $(this);
                $.ajax({
                    type: "Post",
                    url: "",
                    data: {
                        action: "Receive_money"
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.Code == 1) {
                            alert(data.StrCode);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        } else {
                            alert(data.StrCode);
                        }
                        _this.attr("state", "false");
                    }
                })
            } else {
                return false;
            }

        });

        //领取每周的奖励
        $(".Zhou_Fanli .linqu_price").click(function () {
            var _theState = $(this).attr("state");
            if (_theState == undefined || _theState == "true") {
                var _theWeek_id = $(this).attr("week_date") == undefined ? 0 : $(this).attr("week_date");
                _theWeek_id = isNaN(Number(_theWeek_id)) ? 0 : Number(_theWeek_id);
                $(this).attr("state", "false");
                var _this = $(this);
                $.ajax({
                    type: "Post",
                    url: "",
                    data: {
                        action: "ReceBonus",
                        week_date: _theWeek_id
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.Code == 1) {
                            alert(data.StrCode);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        } else {
                            alert(data.StrCode);
                        }
                        _this.attr("state", "false");
                    }
                })
            } else {
                return false;
            }
        });
    }


    /**
     * @content 账户明细 ----  充值明细 信息查询和数据初始化
     * @author  梁汝翔<liangruxiang>  
     * @time 2015年7月28日 10:07:09
     */
    if ($("#invest_fuddetail_cont_2").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['charge_state', 'record_code', 'start_time', 'end_time', 'charge_type'], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function invest_fuddetailList2(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1") {

                var _TrData = data.Data.data == undefined ? {} : data.Data.data;
                if (_TrData.length >= 0 || _TrData == null) { $("#fudetail_list2").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var InMoneys = isNaN(parseFloat(_TrData[i].money).toFixed(2)) ? _TrData[i].money : parseFloat(_TrData[i].money).toFixed(2);
                    var OutMoney = isNaN(parseFloat(_TrData[i].dmoney).toFixed(2)) ? _TrData[i].dmoney : parseFloat(_TrData[i].dmoney).toFixed(2);
                    var _theMesg = _TrData[i].message == undefined ? "--" : _TrData[i].message;
                    var payment_account = _TrData[i].payment_account == undefined ? "" : _TrData[i].payment_account;
                    var strVar = "";
                    strVar += "<tr>";
                    strVar += " <td class='c_green'>" + _TrData[i].record_code + "</td>";
                    strVar += " <td>" + _TrData[i].time + "</td>";
                    strVar += " <td class='c_yellow'>" + InMoneys + "</td>";
                    strVar += " <td class='c_yellow'>" + OutMoney + "</td>";
                    strVar += " <td>" + _theMesg + "</td>";
                    strVar += " <td>" + payment_account + "</td>";
                    strVar += " <td>" + _TrData[i].tiType + "</td>";
                    strVar += " <td class='c_org'>" + _TrData[i].state + "</td>";
                    strVar += "</tr>";
                    var theHtml = $(strVar);
                    $("#fudetail_list2").append(theHtml);
                }

                var _pageTotal = data.Data.dataCount;
                var _pageShow = 10;
                var _pageCurr = data.Data.page_index;
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

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("invest_fuddetail_cont_2", condition_array, invest_fuddetailList2);

        //点击查询按钮
        $("#invest_fuddetail_cont_2 .sub_btn").click(function () {
            _InitPageData("invest_fuddetail_cont_2", condition_array, invest_fuddetailList2);
        });

        $("#invest_fuddetail_cont_2 #charge_state").change(function () {
            _InitPageData("invest_fuddetail_cont_2", condition_array, invest_fuddetailList2);
        });
    }

    /**
    * @content 账户明细 ---- 取款明细 信息查询和数据初始化
    * @author  梁汝翔<liangruxiang>  
    * @time 2015年7月28日 10:07:09
    */
    if ($("#invest_fuddetail_cont_3").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['state', 'record_code', 'start_time', 'end_time'], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function invest_fuddetailList3(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1") {

                var _TrData = data.Data.data == undefined ? {} : data.Data.data;
                if (_TrData.length >= 0 || _TrData == null) { $("#fudetail_list2").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var InMoneys = isNaN(parseFloat(_TrData[i].InMoney).toFixed(2)) ? _TrData[i].InMoney : parseFloat(_TrData[i].InMoney).toFixed(2);
                    var OutMoney = isNaN(parseFloat(_TrData[i].OutMoney).toFixed(2)) ? _TrData[i].OutMoney : parseFloat(_TrData[i].OutMoney).toFixed(2);
                    var Money = isNaN(parseFloat(_TrData[i].Money).toFixed(2)) ? _TrData[i].Money : parseFloat(_TrData[i].Money).toFixed(2);
                    var strVar = "";
                    strVar += "<tr>";
                    strVar += " <td class='c_green'>" + _TrData[i].record_code + "</a></td>";
                    strVar += " <td>" + _TrData[i].bankName + "</td>";
                    strVar += " <td>" + _TrData[i].bankNum + "</td>";
                    strVar += " <td>" + _TrData[i].userName + "</td>";
                    strVar += " <td class='c_org'>" + _TrData[i].money + "</td>";
                    strVar += " <td>" + _TrData[i].time + "</td>";
                    strVar += " <td class='c_org'>" + _TrData[i].state + "</td>";


                    if (_TrData[i].state == "处理中" || _TrData[i].state == "提现成功") {
                        strVar += " <td >&nbsp;--&nbsp;</td>";
                    } else if (_TrData[i].state == "提现失败") {
                        strVar += " <td ><a href='javascript:void(0)' class='look_xx_infos' title='" + _TrData[i].commt + "'>原因</a></td>";
                    } else {
                        strVar += " <td >&nbsp;--&nbsp;</td>";
                    }


                    strVar += "</tr>";
                    var theHtml = $(strVar);
                    $("#fudetail_list2").append(theHtml);
                }

                var _pageTotal = data.Data.dataCount;
                var _pageShow = 10;
                var _pageCurr = data.Data.page_index == undefined ? initcond.PageIndex : data.Data.page_index;
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

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("invest_fuddetail_cont_3", condition_array, invest_fuddetailList3);

        //点击查询按钮
        $("#invest_fuddetail_cont_3 .sub_btn").click(function () {
            _InitPageData("invest_fuddetail_cont_3", condition_array, invest_fuddetailList3);
        });

        $("#invest_fuddetail_cont_3 #state").change(function () {
            _InitPageData("invest_fuddetail_cont_3", condition_array, invest_fuddetailList3);
        });

        //查看详细信息
        $("#invest_fuddetail_cont_3").on("click", ".look_xx_infos", function () {
            var _theTitles = $(this).attr("title") == undefined ? "" : $(this).attr("title");
            if (_theTitles != "") {
                alert(_theTitles);
            }
        });
    }

    /**
    * @content 转账查询 ----  充值明细 信息查询和数据初始化
    * @author  梁汝翔<liangruxiang>  
    * @time 2015年7月28日 10:07:09
    */
    if ($("#invest_fuddetail_cont_4").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['state', 'record_code', 'start_time', 'end_time'], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function invest_fuddetailList4(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1") {

                var _TrData = data.Data.data == undefined ? {} : data.Data.data;
                if (_TrData.length >= 0 || _TrData == null) { $("#fudetail_list2").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var InMoneys = isNaN(parseFloat(_TrData[i].InMoney).toFixed(2)) ? _TrData[i].InMoney : parseFloat(_TrData[i].InMoney).toFixed(2);
                    var OutMoney = isNaN(parseFloat(_TrData[i].OutMoney).toFixed(2)) ? _TrData[i].OutMoney : parseFloat(_TrData[i].OutMoney).toFixed(2);
                    var Money = isNaN(parseFloat(_TrData[i].Money).toFixed(2)) ? _TrData[i].Money : parseFloat(_TrData[i].Money).toFixed(2);
                    var strVar = "";
                    strVar += "<tr>";
                    strVar += " <td class='c_green'>" + _TrData[i].record_code + "</a></td>";
                    strVar += " <td>" + _TrData[i].sType + "</td>";
                    strVar += " <td>" + _TrData[i].payee_user + "</td>";
                    strVar += " <td>" + _TrData[i].drawee_user + "</td>";
                    strVar += " <td class='c_yellow'>" + _TrData[i].money + "</td>";
                    strVar += " <td>" + _TrData[i].time + "</td>";
                    strVar += " <td class='c_org'>" + _TrData[i].state + "</td>";
                    strVar += " <td>" + _TrData[i].commt + "</td>";
                    strVar += "</tr>";
                    var theHtml = $(strVar);
                    $("#fudetail_list2").append(theHtml);
                }

                var _pageTotal = data.Data.dataCount;
                var _pageShow = 10;
                var _pageCurr = data.Data.page_index == undefined ? initcond.PageIndex : data.Data.page_index;
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

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("invest_fuddetail_cont_4", condition_array, invest_fuddetailList4);

        //点击查询按钮
        $("#invest_fuddetail_cont_4 .sub_btn").click(function () {
            _InitPageData("invest_fuddetail_cont_4", condition_array, invest_fuddetailList4);
        });

        $("#invest_fuddetail_cont_4 #state").change(function () {
            _InitPageData("invest_fuddetail_cont_4", condition_array, invest_fuddetailList4);
        });
    }



    /**
    * @content 资金互转明细 ----  充值明细 信息查询和数据初始化
    * @author  梁汝翔<liangruxiang>  
    * @time 2015年7月28日 10:07:09
    */
    if ($("#invest_fuddetail_cont_5").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['lock_type', 'record_code', 'start_time', 'end_time'], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function invest_fuddetailList5(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1") {

                var _TrData = data.Data.data == undefined ? {} : data.Data.data;
                if (_TrData.length >= 0 || _TrData == null) { $("#fudetail_list2").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var InMoneys = isNaN(parseFloat(_TrData[i].InMoney).toFixed(2)) ? _TrData[i].InMoney : parseFloat(_TrData[i].InMoney).toFixed(2);
                    var OutMoney = isNaN(parseFloat(_TrData[i].OutMoney).toFixed(2)) ? _TrData[i].OutMoney : parseFloat(_TrData[i].OutMoney).toFixed(2);
                    var Money = isNaN(parseFloat(_TrData[i].Money).toFixed(2)) ? _TrData[i].Money : parseFloat(_TrData[i].Money).toFixed(2);
                    var strVar = "";
                    strVar += "<tr>";
                    strVar += " <td class='c_green'>" + _TrData[i].record_code + "</a></td>";
                    strVar += " <td>" + _TrData[i].sType + "</td>";
                    strVar += " <td>" + _TrData[i].drawee_user + "</td>";
                    strVar += " <td>" + _TrData[i].payee_user + "</td>";
                    strVar += " <td class='c_org'>" + _TrData[i].jmoney + "</td>";
                    strVar += " <td class='c_org'>" + _TrData[i].cmoney + "</td>";
                    strVar += " <td>" + _TrData[i].time + "</td>";
                    strVar += " <td class='c_org'>" + _TrData[i].state + "</td>";
                    strVar += "</tr>";
                    var theHtml = $(strVar);
                    $("#fudetail_list2").append(theHtml);
                }

                var _pageTotal = data.Data.dataCount;
                var _pageShow = 10;
                var _pageCurr = data.Data.page_index == undefined ? initcond.PageIndex : data.Data.page_index;
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

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("invest_fuddetail_cont_5", condition_array, invest_fuddetailList5);

        //点击查询按钮
        $("#invest_fuddetail_cont_5 .sub_btn").click(function () {
            _InitPageData("invest_fuddetail_cont_5", condition_array, invest_fuddetailList5);
        });

        $("#invest_fuddetail_cont_5 #state").change(function () {
            _InitPageData("invest_fuddetail_cont_5", condition_array, invest_fuddetailList5);
        });
    }




    /**
    * @content 代理中心 ----  下级分红查询 
    * @author  梁汝翔<liangruxiang>  
    * @time 2015年7月28日 10:07:09
    */
    if ($("#lower_bonus_records").size() > 0) {
        //初始化容器的数据，并调用回调函数Betting_recordlist
        var condition_array = { "byid": ['state', 'cycle_no', 'start_time', 'user_name', 'end_time'], "byChildCurr": [], 'byAttrValue': [], "PageIndex": "1" }; //获取的初始化条件

        //回调数据
        function lower_bonusRecord(data, initcond, _InitCallback) {
            ////console.log("初始化账户明细的回调函数", data);
            if (data == undefined) { data = {}; }
            if (data.Code != undefined && data.Code == "1") {

                var _TrData = data.Data.data == undefined ? {} : data.Data.data;
                if (_TrData.length >= 0 || _TrData == null) { $("#lower_bonus_listCont").empty(); }
                for (var i = 0 ; i < _TrData.length ; i++) {
                    var InMoneys = isNaN(parseFloat(_TrData[i].InMoney).toFixed(2)) ? _TrData[i].InMoney : parseFloat(_TrData[i].InMoney).toFixed(2);
                    var OutMoney = isNaN(parseFloat(_TrData[i].OutMoney).toFixed(2)) ? _TrData[i].OutMoney : parseFloat(_TrData[i].OutMoney).toFixed(2);
                    var Money = isNaN(parseFloat(_TrData[i].Money).toFixed(2)) ? _TrData[i].Money : parseFloat(_TrData[i].Money).toFixed(2);
                    var strVar = "";
                    strVar += "<tr>";
                    strVar += " <td>" + _TrData[i].user_name + "</a></td>";
                    strVar += " <td>" + _TrData[i].cycle_no + "</td>";
                    strVar += " <td class='c_org'>" + _TrData[i].bonus_money + "</td>";
                    strVar += " <td class='c_green'>" + _TrData[i].month_sales + "</td>";
                    strVar += " <td>" + _TrData[i].bonus_rate + "</td>";
                    strVar += " <td>" + _TrData[i].start_time + "</td>";
                    strVar += " <td>" + _TrData[i].end_time + "</td>";
                    strVar += " <td class='c_red'>" + _TrData[i].profit_loss_money + "</td>";

                    if (_TrData[i].giving_state != undefined && _TrData[i].giving_state == "未发放") {

                        strVar += " <td>" + _TrData[i].giving_state + "</td>";
                        strVar += " <td><a href='javascript:void(0)' class='send_childFh' bonus_id = '" + _TrData[i].id + "'>可发放</a></td>";

                    } else if (_TrData[i].giving_state == "已发放") {

                        strVar += " <td>" + _TrData[i].giving_state + "</td>";
                        strVar += " <td>已领取</td>";

                    } else {

                        var HostUrl = window.location.host;
                        if (_TrData[i].giving_state == "未签订契约") {
                            strVar += " <td>" + _TrData[i].giving_state + "</td>";

                            switch (_TrData[i].deed_state) {
                                case "1":
                                case 1:
                                    strVar += " <td>请下级确认</td>";
                                    break;
                                case "2":
                                case 2:
                                    strVar += " <td>下周期开始</td>";
                                    break;
                                case "3":
                                case 3:
                                    strVar += " <td><a href='http://" + HostUrl + "/qiyue_creat/" + _TrData[i].user_id + ".html'>去修改契约</a></td>";
                                    break;
                                case "4":
                                case 4:
                                    strVar += " <td><a href='http://" + HostUrl + "/qiyue_creat/" + _TrData[i].user_id + ".html'>去签订契约</a></td>";
                                    break;
                                default:
                                    break;
                            }


                        } else {

                            switch (_TrData[i].deed_state) {
                                case "1":
                                case 1:
                                    strVar += " <td>契约未确认</td>";
                                    strVar += " <td>请下级确认</td>";
                                    break;
                                case "2":
                                case 2:
                                    strVar += " <td>契约已确认</td>";
                                    strVar += " <td>下周期开始</td>";

                                    break;
                                case "3":
                                case 3:
                                    strVar += " <td>契约已拒绝</td>";
                                    strVar += " <td><a href='http://" + HostUrl + "/qiyue_creat/" + _TrData[i].user_id + ".html'>去修改契约</a></td>";
                                    break;
                                case "4":
                                case 4:
                                    strVar += " <td>待确认修改</td>";
                                    strVar += " <td>请下级确认</td>";
                                    break;
                                default:
                                    break;
                            }
                        }
                    }
                    strVar += "</tr>";
                    var theHtml = $(strVar);
                    $("#lower_bonus_listCont").append(theHtml);
                }

                var _pageTotal = data.Data.data_count;
                var _pageShow = 10;
                var _pageCurr = data.Data.page_index == undefined ? initcond.PageIndex : data.Data.page_index;
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

        //byid 表示通过 $("#id").val();
        //byChildCurr 表示通过 $("#id").find(".curr").eq(0).attr("value");
        //byAttrValue 表示通过 $("#id").attr("value");
        _InitPageData("lower_bonus_records", condition_array, lower_bonusRecord);

        //点击查询按钮
        $("#lower_bonus_records .sub_btn").click(function () {
            _InitPageData("lower_bonus_records", condition_array, lower_bonusRecord);
        });

        $("#lower_bonus_records #state").change(function () {
            _InitPageData("lower_bonus_records", condition_array, lower_bonusRecord);
        });

        //发放下级分红
        $("#lower_bonus_records").on("click", ".send_childFh", function () {
            $(this).hide();
            var _theChildId = $(this).attr("bonus_id") == undefined ? 0 : $(this).attr("bonus_id");
            _theChildId = isNaN(parseInt(_theChildId)) ? 0 : parseInt(_theChildId);
            if (_theChildId > 0) {
                var _this = $(this);
                $.ajax({
                    type: "post",
                    url: "",
                    data: {
                        action: "add",
                        id: _theChildId
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.Code == 1) {
                            alert(data.StrCode);
                            _this.empty().text("已发放");
                            _this.removeAttr("bonus_id");
                            window.location.reload();
                        } else {
                            alert(data.StrCode);
                            _this.show();
                        }
                    }
                })
            }
        });

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
 * @author  梁汝翔<liangruxiang>  
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
 * @author  梁汝翔<liangruxiang>  
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
 * @name 梁汝翔<liangruxiang>
 * @time 2015年6月16日 16:20:00
 * @pram total 总条数 
 * @pram show 每页显示多少条 
 * @pram curr 当前选中的是第几页
 * @pram contaier 分页字符串容器 
 * @param _InitCallback 初始化回调函数
 * @pram fn 分页后的回调函数  
 */
function Lrx_JsPage(total, show, curr, contaier, fn, _InitCallback) {
    //console.log(total, show, curr, contaier, fn, _InitCallback);
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
 * @name 梁汝翔<liangruxiang>
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
 * @name 梁汝翔<liangruxiang>
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
 * @name 梁汝翔<liangruxiang>
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
 * @name 梁汝翔<liangruxiang>
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
    //console.log(_EndTime);
    var _end_int = parseInt(_EndTime[0] + _EndTime[1] + _EndTime[2]);

    if (_end_int >= _start_int) {
        return true;
    }
    else {
        return false;
    }
}

/**
 * @content 绘制代理首页的统计图表
 * @name 梁汝翔<liangruxiang>
 * @time 2015年6月16日 16:20:00
 * @param Home_Agent 图表的数据
 * @param cont_id 图表绘制区域
 * @type 时间字符串截取方式
 */
function Chart_Home_Agent(Home_Agent, cont_id) {
    if (Home_Agent != null) {
        $('#' + cont_id).highcharts({
            chart: {
                backgroundColor: 'rgba(0,0,0,0)'
            },
            title: {
                text: '',
                x: -20,
                style: {
                    color: '#fff'
                }
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: Home_Agent.X_Time,
                labels: {
                    style: {
                        color: '#fff'
                    }
                }
            },
            yAxis: [{
                title: {
                    text: '金额（元）/人数（个）',
                    style: {
                        color: '#fff'
                    }
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            }, {
                title: {
                    text: ''
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#000'
                }]
            },
            {
                title: {
                    text: ''
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#000'
                }]
            },
            {
                title: {
                    text: ''
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#000'
                }]
            },
            {
                title: {
                    text: ''
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#000'
                }]
            }],
            exporting: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            tooltip: {
                valueSuffix: '',
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0,
                backgroundColor: "none"
            },
            series: [{
                name: '提现量',
                data: Home_Agent.Withdrawals
            },
            {
                name: '充值量',
                data: Home_Agent.Recharge
            },
            {
                name: '投注量',
                data: Home_Agent.Bets
            },
            {
                name: '返点',
                data: Home_Agent.Rebate
            },
            {
                name: '新增用户数',
                data: Home_Agent.NewUsers
            }]
        });
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
                            'padding': '15px 47px',
                            'content': "<p style=\"margin-top: 14%;\">是否充值完成</p>",
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
                if (charge_type == "WX" || charge_type=="ZFB") {
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
                strVar+="<\/td>";

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
                strVar += "			&nbsp;&nbsp;";
                strVar += "			<input class=\"btn btn-important\" style=\"padding: 5px 5px;background-color: #d21e1e;color: #FFF;\" id=\"WX-button-order-cancel\"  onclick=\"CloseOrder()\" value=\"完成订单\" type=\"button\">";
                strVar += "			&nbsp;&nbsp;&nbsp;&nbsp;";
                strVar += "			<a href=\"/user_account_invest_fuddetail2.html\">充值记录<\/a>";
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
    var theMoney = $("#rechargeOrder4 input[name='money']").val(); //充值的金额
    var theMessage = $("#rechargeOrder4 input[name='message']").val(); //充值人姓名
    theMoney = isNaN(Number(theMoney)) ? 0 : Number(theMoney);

    if (theMoney < 50 || theMoney > 50000) {
        alert("充值金额，必须大于20小于200000元。");
        return false;
    }

    if ( theMoney > 0) {
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
                    window.location.href = data.Data;
                } else {
                    alert(data.StrCode);
                    return false;
                }
            }
        });
    }
}

/**
 * @content 签到日期效果
 * @name 梁汝翔<liangruxiang>
 * @time 2015年6月16日 16:20:00  
 * @param currdata 数组，本月的签到记录 
 */
function ruiec_SignUpdate(currdata) {

    if (currdata == undefined) { currdata = [0, 1, 2, 4, 5, 7, 10, 12, 16, 18, 20] }
    var _theDate = new Date();  //获取当前时间  2015 07 25 表示的 是  2015年8月25日
    var _theDay = _theDate.getDate();
    var _ToDays = _theDate.getFullYear() + "-" + (_theDate.getMonth() + 1) + "-" + _theDate.getDate();
    $("#today_js").empty().text(_ToDays);
    //Date(2015,08,0) //获取的是8月份的最后一天的索引[08表示的是9月]
    var _theNextMonthData = new Date(_theDate.getFullYear(), _theDate.getMonth() + 1, 0);
    //console.log(_theNextMonthData.getDate());  //获取本月总共多少天

    //Date(2015,08,1) //获取的是9月份的第一天的 [08表示的是9月]
    var _theMonthData = new Date(_theDate.getFullYear(), _theDate.getMonth(), 1);
    //console.log(_theMonthData.getDay()); //本月第一天是星期几
    var _M_startWeekDay = _theMonthData.getDay();
    var _M_DayLength = _theNextMonthData.getDate();

    //获取上月的日期
    var _thePrevDate = new Date(_theDate.getFullYear(), _theDate.getMonth(), 0);
    var _M_PrevDayLength = _thePrevDate.getDate(); //获取上一月最后的值 

    //填补本月之前的日期
    for (var j = _M_startWeekDay - 1 ; 0 <= j ; j--) {
        var theTdObj = $("#qd_date").find("td").eq(j);
        //判断当前 天数 是否在数组中存在
        var theCurrData = false;
        theTdObj.empty().text(_M_PrevDayLength).css("color", "#ccc");
        _M_PrevDayLength--;
    }

    var _days = 1;
    //开始的索引为第几个td(即本月的第几天)
    for (var i = _M_startWeekDay ; i < (_M_DayLength + _M_startWeekDay) ; i++) {
        var theTdObj = $("#qd_date").find("td").eq(i);
        //判断当前 天数 是否在数组中存在
        var theCurrData = CheckStrInArray2(_days, currdata);

        if (theCurrData) { theTdObj.addClass("curr"); } else { theTdObj.removeClass("curr"); }
        if (_theDay == _days) {
            if (theCurrData) {
                theTdObj.addClass("curr");
                theTdObj.empty().text(_days);
                $(".qd_title .qd_ico ").addClass("curr");
                $(".qd_title .qd_info h4").empty().text("今日签到成功");
            } else {
                theTdObj.empty().html("<a href='javascript:void(0)' class='today_qd_btn'>" + _days + "</a>");
            }
        }
        else {
            theTdObj.empty().text(_days);
        }
        _days++;
    }

    var _nextDay = 1;
    //填补本月之后的日期
    for (var k = (_M_DayLength + _M_startWeekDay) ; k <= 42 ; k++) {
        var theTdObj = $("#qd_date").find("td").eq(k);
        //判断当前 天数 是否在数组中存在 
        theTdObj.empty().text(_M_PrevDayLength).css("color", "#ccc");
        theTdObj.empty().text(_nextDay);
        _nextDay++;
    }
}

/**
 * @content 判断字符串是否在数组当中
 * @name 梁汝翔<liangruxiang>
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




