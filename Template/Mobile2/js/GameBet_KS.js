// JavaScript Document 
// +----------------------------------------------------------------------
// | 技术支持：88375133@qq.com
// +---------------------------------------------------------------------- 
// | Author: RuiecLrx
// +----------------------------------------------------------------------
// | Date: 2015年7月20日 21:00:00
// +----------------------------------------------------------------------
// | Name: GameBet_SSC.js (时时彩)
// +----------------------------------------------------------------------

var JS_LoadingTime = 0;
(function ($, W) {
    var Ruiec_Fn = W.RCP;  //全局算法对象
    var _This, _Option, _PlayDetail, _GetOpenNumbers, K = 0; //全局变量 _PlayDetail:全局玩法详情
    var Ruiec_GameBet = function () {
        this.param = "";
    }

    Ruiec_GameBet.prototype = {
        Init: function (SendOption) {
            _This = this;
            _Option = _This.ExtendOption(SendOption);
            W.GameBetOption = _Option;

            //初始化游戏界面
            _This.InitPageLayout();

            //定时同步服务器时间
            _This.Synchronous_ServerTime("start");

            //绑定页面的一些公用效果
            _This.BlindPageCommonAnimate();

            //绑定选择玩法，以及玩法切换
            _This.BlindChoicePlayCode();

            //每半小时清理一次本地JS数据缓存
            setInterval(function () {
                _PlayDetail = undefined;
            }, 180000);

        },
        /**
        * @description 默认参数与默认属性的扩展与继承
        * @extends {Ruiec_GameBet}
        * @param {object} SendOption 对象 
        */
        ExtendOption: function (SendOption) {
            var Default_Option = {
                CurrentOpenIssue_El_Id: "f_lottery_info_lastnumber", //当前正在开奖的期号，最近一期正在开奖的期号 DOM对象ID
                CurrentBettingIssue_El_Id: "f_lottery_info_number",//当前正在投注的期号，最近一期正在投注的期号 DOM对象ID
                LatestOpenNumber_El_Id: "openNum_list", //最近一期的开奖号码 DOM对象ID
                BettingCountdown_El_Id: "j_lottery_time",//投注的倒计时 DOM对象ID
                LotteryPlayRegion_El_Id: "LotteryPlayRegio_Info",//玩法说明区域 DOM对象ID
                ChoiceNote_El_Id: "choice_zhu",//选中注数 DOM对象ID
                ChoiceMultiple_El_Id: "choice_Multiple",//选中倍数 DOM对象ID
                ChoiceUnit_Select_Id: "choice_Unit",//选中投注单位 下拉菜单ID
                ChoiceUnit_Init_Value: [{ "value": "1", "text": "元" }, { "value": "0.1", "text": "角" }, { "value": "0.01", "text": "分" }],//选中投注的单位列表[元、角、分、厘] 
                ChoiceNotePrice_El_Id: "choice_money",//选中注数的金额 DOM对象ID
                LotteryPlayRebate_Select_Id: "select_fd",//玩法的返点 下拉菜单ID
                SureChoice_El_Id: "choice_comfire_btn",//确认选号按钮id
                ChoiceInfoListCont_TB_Id: "order_table",//选号列表 区域ID 表格对象
                RandChoice_One_El_Id: "order_random1",//机选1注的按钮
                RandChoice_Five_El_Id: "order_random5",//机选5注的按钮
                EmptyChoiceInfo_El_Id: "order_empty",//清空当前选号
                ToTal_ChoiceNote_El_Id: "f_gameOrder_lotterys_num",//当前彩种所有选号总共的注数
                ToTal_ChoiceNotePrice_El_Id: "f_gameOrder_amount",//当前彩种所有选号总共的金额
                ChoiceBettingType_El_Id: "Check_Betting_Type",//投注模式的选择区域的Id
                ChoiceBettingType_Init_Value: [{ "value": "0", "text": "我要自购", "Relation_Cont_ID": "" }, { "value": "1", "text": "我要追号", "Relation_Cont_ID": "Chase_Program_Cont" }],//投注模式的值 [我要自购、我要追号、发起合买、高级追号] 
                BettingType_Container_Id: "Betting_type_Container", //追号合买区域的父级区域id
                ChaseProgram_Tb_Id: "f_chase_table", //追号列表的表格id
                Betting_Sub_BtnId: "f_submit_order",//确认投注
                HistoryOpenNumber_TB_Id: "fn_getoPenGame",//开奖历史记录  表格对象
                Account_BettingRecord_TB_Id: "fn_getMyProjects",//用户的投注记录  表格对象
                Account_ChaseRecord_TB_Id: "fn_getMyZhuihao",//用户的追号记录  表格对象
                Account_WithBuyRecord_TB_Id: "fn_getMyHemai",//用户的合买记录  表格对象
                Choice_BallArea_El_Id: "gn_main_cont",//选号区域的 区域ID DOM对象ID 
                Choice_PlayCode_El_Id: "j_play_select",//选择彩种玩法
                Common_Ajax_Api: "../tools/ssc_ajax.ashx",//获取数据的接口
                Js_Root: "",//玩法JS结构目录
                CallBack: ""//回调函数 
            } 
            return $.extend(true, {}, Default_Option, SendOption); 
        },
        /**
        * @description 初始化游戏界面,绑定追号合买的事件切换
        * @extends {Ruiec_GameBet} 
        */
        InitPageLayout: function () {

            var _getUnitCookie = Ruiec_Fn.getCookie("ChoiceUnit") == undefined ? "" : Ruiec_Fn.getCookie("ChoiceUnit"); //获取当前cookie是否存在可选择投注单位
            //设定可选择投注单位
            if (_Option.ChoiceUnit_Select_Id != "" && _Option.ChoiceUnit_Init_Value.length > 0) {
                $("#" + _Option.ChoiceUnit_Select_Id).empty();
                for (var i = 0 ; i < _Option.ChoiceUnit_Init_Value.length ; i++) {
                    if (_Option.ChoiceUnit_Init_Value[i].value == _getUnitCookie) {
                        var _theOption = "<option value='" + _Option.ChoiceUnit_Init_Value[i].value + "' selected >" + _Option.ChoiceUnit_Init_Value[i].text + "</option>";
                    } else {
                        var _theOption = "<option value='" + _Option.ChoiceUnit_Init_Value[i].value + "' >" + _Option.ChoiceUnit_Init_Value[i].text + "</option>";
                    }  
                    $("#" + _Option.ChoiceUnit_Select_Id).append($(_theOption));
                } 
            }

            //绑定圆角分切换事件
            $("#" + _Option.ChoiceUnit_Select_Id).bind("change", function () {
                var _theValue = $(this).val();
                Ruiec_Fn.setCookie("ChoiceUnit", _theValue, 3600); //设定cookie的存活时间（一小时）

                var _Relation_ReBateObj = $("#" + _Option.LotteryPlayRebate_Select_Id);

                var fdArray = _Relation_ReBateObj.attr("fdarray") == undefined ? "" : _Relation_ReBateObj.attr("fdarray"); //返点值
                if (fdArray != "") {
                    fdArray = fdArray.split(",");
                    var itemAll = "";
                    for (var a = 0; a < fdArray.length; a++) {

                        var oPtion_val = fdArray[a];
                        var oPtion_val_money = parseFloat(oPtion_val.split("-")[0]); //金额
                        var oPtion_val_fd = oPtion_val.split("-")[1];  //返点
                        if (_theValue > 1) _theValue = 1;
                        if (_theValue < 0) _theValue = 0;

                        oPtion_val_money = oPtion_val_money * _theValue; //单位 所对应的返点 
                        oPtion_val_money = isNaN(parseFloat(oPtion_val_money)) ? oPtion_val_money : parseFloat(oPtion_val_money);

                        var _theStrings = oPtion_val_money.toString();
                        var _TheFloatLen = _theStrings.split(".").length;
                        if (_TheFloatLen > 1) {
                            var _TheFloatLens = _theStrings.split(".")[1].length;
                            if (_TheFloatLens > 5) {
                                oPtion_val_money = parseFloat(oPtion_val_money).toFixed(5);
                            }
                        } 
                        var item_val = oPtion_val_money + "-" + oPtion_val_fd;
                        itemAll = itemAll + "<option value='" + item_val + "'>" + item_val + "</option>";
                    };
                    _Relation_ReBateObj.empty().html($(itemAll));

                }

                //当发生圆角分、倍数更改时触发的  对应注数的金额修改
                _This.BindChageBettingType();
            });

            //绑定切换倍数的问题
            $("#" + _Option.ChoiceMultiple_El_Id).bind("change", function () {
                _This.BindChageBettingType();
            }); 

            //设定合买、追号、高级追号的功能模块是否展示
            if (_Option.ChoiceBettingType_El_Id != "" && _Option.ChoiceBettingType_Init_Value.length > 0) {
                $("#" + _Option.ChoiceBettingType_El_Id).empty();

                for (var i = 0 ; i < _Option.ChoiceBettingType_Init_Value.length ; i++) {
                    if (i == 0) {
                        var _theOption = "<label><input type='radio' relation_cont_id = '" + _Option.ChoiceBettingType_Init_Value[i].Relation_Cont_ID + "' checked name='rad' value='" + _Option.ChoiceBettingType_Init_Value[i].value + "' />" + _Option.ChoiceBettingType_Init_Value[i].text + "</label>";
                    } else {
                        var _theOption = "<label><input type='radio' relation_cont_id = '" + _Option.ChoiceBettingType_Init_Value[i].Relation_Cont_ID + "' name='rad' value='" + _Option.ChoiceBettingType_Init_Value[i].value + "' />" + _Option.ChoiceBettingType_Init_Value[i].text + "</label>";
                    }
                    $("#" + _Option.ChoiceBettingType_El_Id).append($(_theOption));
                }  
            }

            //绑定追号合买的事件切换
            $("#" + _Option.ChoiceBettingType_El_Id).on("click", "input", function () {
                var _theValue = $(this).val(); //当前选中的值
                var _theRelation_Cont = $(this).attr("relation_cont_id");
                if (_theRelation_Cont != "" && $("#" + _theRelation_Cont).size() > 0) {

                    //beittingInfos
                    if($("#"+_Option.ChoiceInfoListCont_TB_Id).find("tr").length<1){
                        //验证是否可选号
                        Ruiec_Fn.alert("请先选择投注方案，再进行追号或合买操作","tips");
                        return false;
                    } 

                    if (_theValue == "1" || _theValue == 1) {

                        //1、更改列表里的注数
                        var orderCount_num = 0; //方案数量
                        var orderCount_money = 0.00; //金额
                        $("#" + _Option.ChoiceInfoListCont_TB_Id + " tr").each(function () {

                            var _theMultiple = 1; //倍数
                            var _theValue = $(this).find(".each_price").val(); //金额

                            _theMultiple = parseInt(_theMultiple);
                            _theValue = Number(_theValue);

                            var _NewPrice = _theValue / _theMultiple;
                            //$(this).find(".order_multiple").empty().text("1");
                            //$(this).find(".each_price").empty().text(_NewPrice);
                            orderCount_money = orderCount_money + Number(_NewPrice); 
                        }) 
                        
                        if (orderCount_money.toString().indexOf(".") > 0) {
                            orderCount_money = parseFloat(orderCount_money).toFixed(3);
                        }
                        $("#" + _Option.ToTal_ChoiceNotePrice_El_Id).empty().text(orderCount_money); 
                        
                        $("#" + _Option.BettingType_Container_Id + " .type_Container_obj").hide();
                        $("#" + _theRelation_Cont).show();
                        $("#" + _Option.BettingType_Container_Id).show();
                        _This.Bind_Chase_ProgramFn(); //绑定选号事件

                    } else {

                        var _BettingMoney = $("#" + _Option.ToTal_ChoiceNotePrice_El_Id).text(); //方案总金额
                        _BettingMoney = Number(_BettingMoney);

                        if (_BettingMoney < 8) {
                            //验证是否可选号
                            Ruiec_Fn.alert("创建合买方案，投注方案金额至少大于8元，请在选择一下吧", "tips");
                            return false;
                        }


                        $("#" + _Option.BettingType_Container_Id + " .type_Container_obj").hide();
                        $("#" + _theRelation_Cont).show();
                        $("#" + _Option.BettingType_Container_Id).show();
                        _This.Bind_With_BuyFn(); //绑定合买事件
                    } 
                } else {
                    $("#" + _Option.BettingType_Container_Id).hide();//隐藏合买追号的信息
                    $("#" + _Option.BettingType_Container_Id).find("#f_chase_table").empty(); //清空追号信息
                }
            });

            _This.Blind_Betting_Fn();
        },
        /**
        * @description 绑定更改投注类型的事件 
        * @param {string} type 类型 
        * @param {Number} value 值
        */
        BindChageBettingType: function () {

            var _ChoiceNote = $("#" + _Option.ChoiceNote_El_Id).text() == undefined ? 0 : Number($("#" + _Option.ChoiceNote_El_Id).text());
            if (!isNaN(_ChoiceNote) && _ChoiceNote != 0) {

                _ChoiceNote = parseInt(_ChoiceNote);
                var _ChoiceMultiple = $("#" + _Option.ChoiceMultiple_El_Id).val() == undefined ? $("#" + _Option.ChoiceMultiple_El_Id).text() : $("#" + _Option.ChoiceMultiple_El_Id).val(); //倍数 
                var _ChoiceUnit = $("#" + _Option.ChoiceUnit_Select_Id).val() == undefined ? 1 : $("#" + _Option.ChoiceUnit_Select_Id).val(); //单位  
                _ChoiceMultiple = isNaN(Number(_ChoiceMultiple)) ? 1 : parseInt(Number(_ChoiceMultiple));

                var _ChoicePrice = _ChoiceNote * _ChoiceMultiple * _ChoiceUnit * 2; //计算金额
                _ChoicePrice = isNaN(Number(_ChoicePrice)) ? 0 : Number(_ChoicePrice);
                var _ChoicePriceStr = _ChoicePrice.toString();
                if (_ChoicePriceStr.indexOf(".") >= 0) {
                    _ChoicePrice = parseFloat(_ChoicePrice).toFixed(3);
                }
                //金额
                $("#" + _Option.ChoiceNotePrice_El_Id).empty().text(_ChoicePrice);

            } else {
                //注数
                $("#" + _Option.ChoiceNote_El_Id).empty().text("0");
                //金额
                $("#" + _Option.ChoiceNotePrice_El_Id).empty().text("0.00");
            }
            
        },
        /**
        * @description 同步服务器时间
        * @extends {Ruiec_GameBet}
        * @param {string} type 类型 
        * @param {Number} value 值
        */
        Synchronous_ServerTime: function (type,value) {
            
            if (type != undefined && type == "start") {
                //成功获取数据时
                function SetServerTime(data) {
                  
                    var _theTime = data.Data;
                    var _theTime_Str = Ruiec_Fn.ruiec_TimeToDate(_theTime); 
                    $("#" + _Option.BettingCountdown_El_Id).attr('serverTime', _theTime_Str);

                    setTimeout(function () {
                        //每隔1秒钟获取一次服务器
                        _This.Synchronous_ServerTime("end",1);
                    }, 1000);
                }

                //获取数据失败
                function ErrorGetServerTime() {
                    var _theTime = new Date().getTime();
                    console.log(_theTime);
                    $("#" + _Option.BettingCountdown_El_Id).attr('serverTime', _theTime);
                    setTimeout(function () {
                        //每隔1秒钟获取一次服务器
                        _This.Synchronous_ServerTime("start");
                    }, 1000);
                }

                var _TheGetDetail_Api = _Option.Common_Ajax_Api + "?action=server_dateTime";  //获取彩种详情的接口
                var _PostData = { "action": "server_dateTime" }; //需要提交的数据

                //获取数据请求
                Ruiec_Fn.RAjax("POST", _TheGetDetail_Api, _PostData, "json", SetServerTime, ErrorGetServerTime);

            } else {
                setTimeout(function () {
                    var _theTime = $("#" + _Option.BettingCountdown_El_Id).attr('serverTime') == undefined ? new Date().getTime() : $("#" + _Option.BettingCountdown_El_Id).attr('serverTime');
                    _theTime = parseInt(Number(_theTime));
                    _theTime += 1000; 
                    $("#" + _Option.BettingCountdown_El_Id).attr('serverTime', _theTime);

                    value = value || 0;
                    value++;
                    if (value < 60) { 
                        _This.Synchronous_ServerTime("end", value);
                    } else {
                        //每分钟重新更新一次服务器时间
                        _This.Synchronous_ServerTime("start");
                    } 
                }, 1000);
            } 
        },
        /**
        * @description 返回当前页面的彩种编码
        * @extends {Ruiec_GameBet}
        * @param {string} name 为参数名字 
        */
        ruiec_returnLottery: function (name) {
            name = name || "lottery";
            if (_Option == undefined || _Option.lotteryCode == undefined) {

                var oLotteryCode = Ruiec_Fn.getQueryString(name);
                if (oLotteryCode == undefined || oLotteryCode == "") {
                    oLotteryCode = "1000"; 
                } 
                if (_Option != undefined) {
                    _Option.lotteryCode = oLotteryCode;
                } 
                return oLotteryCode;
            } else {
                return _Option.lotteryCode;
            } 
        },
        /**
        * @description 获取我的方案 
        */
        ruiec_getMyProject: function () {
            
            var oLoading = '<tr>' +
                            '<td colspan="3" style="padding:15px;text-align:center;">' +
                                '<img src="templates/SSC/images/loading.gif" class="center" width="25" />' +
                            '</td>' +
                        '</tr>'; 

            var _TheUrl = _Option.Common_Ajax_Api + "?action=GetBetting"; //获取方案
            var _PostData = { "action": "GetBetting" };

            //更新我的投注方案列表
            function Do_GetBettingListCallBack(data) {
                var oData = data.Data;
                var oInsert = "";
                if (oData != undefined && oData.length > 0) {
                    for (var a in oData) {
                        var issueNo = oData[a].issueNo; //方案编号
                        var normal_money = isNaN(parseFloat(oData[a].normal_money).toFixed(2)) ? "0.00" : parseFloat(oData[a].normal_money).toFixed(2); //方案金额
                        var openState = oData[a].openState; //方案状态
                        var ourl = oData[a].url; //方案链接
                        var chedanState = oData[a].chedanState == undefined ? "--" : oData[a].chedanState;
                        var chedanId = oData[a].order_id == undefined ? "--" : oData[a].order_id;
                        oInsertTr = '<tr>' +
                                   '<td  class="openIssue"><a class="alink" href="' + ourl + '">' + issueNo + '</a></td>' +
                                   '<td  class="openIssue"><i>￥' + normal_money + '</i></td>';
                        oInsertTr += '<td  class="openTime">' + openState + '</td>';
                        oInsertTr += '</tr>';
                        oInsert = oInsert + oInsertTr;
                    };
                    $("#" + _Option.Account_BettingRecord_TB_Id + " .tbody").empty().html(oInsert);
                } else {
                    oLoading = '<tr>' +
                                    '<td colspan="3" style="padding:15px;text-align:center;">' +
                                        '您暂无投注方案。' +
                                    '</td>' +
                                '</tr>';
                    $("#" + _Option.Account_BettingRecord_TB_Id + " .tbody").empty().html(oLoading);
                }
            }

            Ruiec_Fn.RAjax("POST", _TheUrl, _PostData, "json", Do_GetBettingListCallBack); 
        },
        /**
        * @description 获取我的追号 
        */
        ruiec_getZhuiHao: function () { 

            var _TheUrl = _Option.Common_Ajax_Api + "?action=GetChaseBetting"; //获取方案
            var _PostData = { "action": "GetChaseBetting" };

            
            function Do_GetChaseBettingList_Callback(data) {
                var oData = data.Data;
                var oInsert = "";
                if (oData != undefined && oData.length > 0) {
                    for (var a in oData) {
                        var issueNo = oData[a].issueNo; //方案编号
                        var complete_count = oData[a].complete_count; //已追、总共多少期 
                        var TotalMoney = oData[a].chase_money; //总共的金额  
                        var Zhuihaostate = oData[a].state; //合买状态 
                        var ourl = oData[a].url; //方案链接

                        TotalMoney = isNaN(Number(TotalMoney)) ? 0 : Number(TotalMoney);
                        if (TotalMoney > 1000000) {
                            TotalMoney = parseFloat(TotalMoney / 10000).toFixed(2) + "万";
                        }

                        oInsertTr = '<tr>' +
                                   '<td class="openIssue"><a class="alink" href="' + ourl + '">' + issueNo + '</a></td>' +
                                   '<td class="openNumb"><i>' + complete_count + '</i></td>' +
                                   '<td class="openTime"><i>￥' + TotalMoney + '</i></td>' +
                                   '<td class="openStatue"><i>' + Zhuihaostate + '</i></td>' +
                                 '</tr>';

                        oInsert = oInsert + oInsertTr;
                    };
                    $("#" + _Option.Account_ChaseRecord_TB_Id + " .tbody").empty().html(oInsert);
                } else {
                    oLoading = '<tr>' +
                                     '<td colspan="4" style="padding:15px;text-align:center;">' +
                                         '您暂无追号方案。' +
                                     '</td>' +
                                '</tr>';
                    $("#" + _Option.Account_ChaseRecord_TB_Id + " .tbody").empty().html(oLoading);
                }
            }

            //ajax
            Ruiec_Fn.RAjax("POST", _TheUrl, _PostData, "json", Do_GetChaseBettingList_Callback);
            
        },
        /**
        * @description 获取我的合买 
        */
        ruiec_getHeMai: function (setOption) {
             
            var oLoading = '<tr>' +
                            '<td colspan="4" align="center" style="padding:15px; text-align:center;">' +
                                '<img src="templates/SSC/images/loading.gif" class="center" width="25" />' +
                            '</td>' +
                        '</tr>';

            var _TheUrl = _Option.Common_Ajax_Api + "?action=GetBuyBetting"; //获取方案
            var _PostData = { "action": "GetBuyBetting" };

            function Do_GetWidthBuyBettingList_Callback(){
                var oData = data.Data;
                var oInsert = "";
                if (oData.length > 0) {
                    for (var a in oData) {
                        var issueNo = oData[a].issueNo; //方案编号
                        var schemeMoney = oData[a].schemeMoney; //方案金额
                        var schemeTitle = oData[a].schemeTitle; //方案标题
                        var buyMoney = oData[a].buyMoney; //自己购买的金额  
                        var Hemaistate = oData[a].state; //合买状态 
                        var ourl = oData[a].url; //方案链接
                        oInsertTr = '<tr>' +
                                   '<td class="openIssue"><a class="alink" href="' + ourl + '">' + issueNo + '</a></td>' +
                                   '<td class="openNumb"><i>￥' + schemeMoney + '</i></td>' +
                                   '<td class="openTime"><i>￥' + buyMoney + '</i></td>' +
                                   '<td class="openStatue"><i>' + Hemaistate + '</i></td>' +
                                 '</tr>';

                        oInsert = oInsert + oInsertTr;
                    }; 

                    $("#"+_Option.Account_WithBuyRecord_TB_Id+" .tbody").empty().html(oInsert);
                } else {
                    oLoading = '<tr>' +
                                     '<td colspan="4" style="padding:15px;text-align:center;">' +
                                         '您暂无合买方案。' +
                                     '</td>' +
                                '</tr>';
                    $("#"+_Option.Account_WithBuyRecord_TB_Id+" .tbody").empty().html(oLoading);

                }
            }
             
            //ajax
            Ruiec_Fn.RAjax("POST", _TheUrl, _PostData, "json", Do_GetChaseBettingList_Callback); 
        },
        /**
        * @description 获取编码所对应的彩种名称【可改】
        * @extends {Ruiec_GameBet}
        * @param {string} lottery_code 彩种编码值 
        */
        get_olotteryName: function (lottery_code) {
            if (lottery_code == undefined) { lottery_code = "1000" }
            var _lottery_name = "";
            switch (lottery_code) {
                case "1000":
                    _lottery_name = "重庆时时彩";
                    break;
                case "1001":
                    _lottery_name = "新疆时时彩";
                    break;
                case "1002":
                    _lottery_name = "云南时时彩";
                    break;
                case "1003":
                    _lottery_name = "天津时时彩";
                    break;
                case "1004":
                    _lottery_name = "江西时时彩";
                    break;
                case "1005":
                    _lottery_name = "时时乐";
                    break;
                case "1006":
                    _lottery_name = "五分彩";
                    break;
                case "1007":
                    _lottery_name = "十分彩";
                    break;
                case "1008":
                    _lottery_name = "分分彩";
                    break;
                case "1009":
                    _lottery_name = "二分彩";
                    break;
                case "1100":
                    _lottery_name = "广东11选五";
                    break;
                case "1101":
                    _lottery_name = "上海11选五";
                    break;
                case "1102":
                    _lottery_name = "山东11选五";
                    break;
                case "1103":
                    _lottery_name = "江西11选五";
                    break;
                case "1201":
                    _lottery_name = "福彩3D";
                    break;
                case "1202":
                    _lottery_name = "排列3/5";
                    break;
                case "1301":
                    _lottery_name = "安徽快三";
                    break;
                case "1302":
                    _lottery_name = "北京快乐8";
                    break;
                case "1303":
                    _lottery_name = "北京PK10";
                    break;
                case "1304":
                    _lottery_name = "幸运农场";
                    break;
                case "1305":
                    _lottery_name = "江苏快三";
                    break;
                case "1306":
                    _lottery_name = "广西快三";
                    break;
                case "1307":
                    _lottery_name = "吉林快三";
                    break;
                case "1308":
                    _lottery_name = "湖北快三";
                    break;
                case "1309":
                    _lottery_name = "内蒙古快三";
                    break;
                case "1310":
                    _lottery_name = "福建快三";
                    break;
                case "1311":
                    _lottery_name = "北京快三";
                    break;
                case "1312":
                    _lottery_name = "河北快三";
                    break;
                        case "1313":
                    _lottery_name = "幸运快三";
                    break;
                default:
                    _lottery_name = "重庆时时彩";
                    break;
            }
            return _lottery_name;
        },
        /**
        * @description 绑定页面的一些通用的JS效果;比如：tab的切换，滑动效果，方案切换等等效果，与页面结构相关的一些效果
        * @extends {Ruiec_GameBet} 
        */
        BlindPageCommonAnimate: function () {
             
            //绑定控制区域的mouser事件
            $("#" + _Option.Choice_BallArea_El_Id).on("mouseover", ".ball_control", function () {
                $(this).children(".control_btn").addClass("curr");
                $(this).children(".control_hidden").stop(true, true).show();
            });

            //绑定控制区域的mouser事件
            $("#" + _Option.Choice_BallArea_El_Id).on("mouseleave", ".ball_control", function () {
                $(this).children(".control_btn").removeClass("curr");
                $(this).children(".control_hidden").stop(true, true).hide();
            });
             
            //遗漏冷热tab点击切换
            $("#" + _Option.Choice_BallArea_El_Id).on("mouseleave", "#game_frequency_type li a", function () {
                var oIndex = $(this).index();
                $(this).addClass("curr").siblings("a").removeClass("curr");
                $("#game_frequency_item li").removeClass("curr").eq(oIndex).addClass("curr");
            });

            //冷热遗漏切换
            $("#" + _Option.Choice_BallArea_El_Id).on("mouseleave", "#game_frequency_item li a", function () {
                $(this).addClass("curr").siblings("a").removeClass("curr");
            }); 
            
            //我的方案、我的追号、我的合买tab切换
            $(".gn_list .ty_item2").click(function(){
                var oIndex=$(this).index();
                $(this).addClass("curr").siblings(".ty_item2").removeClass("curr");
                $(this).parents(".gn_list").eq(0).children(".ty_cont").children("table").removeClass("curr").eq(oIndex).addClass("curr");
                
                if(oIndex==1)//我的追号
                {
                    //绑定我的追号
                    me.ruiec_getZhuiHao(setOption);
                }
                else if(oIndex==2)
                {
                    me.ruiec_getHeMai(setOption);
                };
            });
             
            //我的方案、我的追号、我的合买tab切换
            $(".right_infsoBlock2 .tab_obj").click(function () {
                var oIndex = $(this).index();
                $(this).addClass("curr").siblings(".tab_obj").removeClass("curr");
                $(this).parents(".right_infsoBlock2").eq(0).find(".tab_box").hide();
                $(this).parents(".right_infsoBlock2").eq(0).find(".tab_box").eq(oIndex).show();

                if (oIndex == 0) { 
                    //绑定我的追号
                    _This.ruiec_getZhuiHao();
                } else if (oIndex == 1) {
                    //我的合买
                    _This.ruiec_getHeMai();
                };
            });

            //获取彩票的名称
            var _oLotteryCode = _This.ruiec_returnLottery();
            var _oLotteryName = _This.get_olotteryName(_oLotteryCode);

            //修改当前页面的彩种图标
            $(".g_Time_Section .c_logo img").attr("src", _Option.Js_Root + "/images/ssc/cz_" + _oLotteryCode + ".png");  //根据彩种代码切换logo
            $(".g_Time_Section .c_logo b").empty().text(_oLotteryName);  //替换彩种名称 
            
            $(".g_Time_Section .switch").unbind().click(function () {
               var pageSwitch=$("#PageSwitch");
                pageSwitch.toggle(); 
                $(".g_Time_Section span").toggleClass("active1"); 
            });
            $(".Betting_Issue_CountDown dl").eq(0).unbind().click(function () {
                 $("#fn_getoPenGame").toggle(); 
              });

            //选号列表中金额变动
            $("#" + _Option.ChoiceInfoListCont_TB_Id).on("keyup",".each_price",function () {
                var _theValues = $(this).val();
                _theValues = _theValues.replace(/[^\d]/g, "");
                var _TheTrObj = $(this).parents("tr").eq(0);
                if (_theValues != "") {
                    $(this).val(_theValues);
                    _theValues = parseInt(_theValues);  
                    var _thePeiLv = _TheTrObj.attr("order_peilv");
                    _thePeiLv = Number(_thePeiLv);
                    if (isNaN(_thePeiLv)) _thePeiLv = 1;
                    var _thePrice = _theValues * _thePeiLv;
                    _thePrice = parseFloat(_thePrice).toFixed(2);
                    _TheTrObj.find(".hide_this").show().find(".order_money").empty().text(_thePrice);
                } else { 
                    _TheTrObj.find(".hide_this").hide();
                    $(this).val("");
                }

                _This.ruiec_orderCountMoney();
            });  
        },
        /**
        * @description 绑定彩种区域的玩法切换 
        * @extends {Ruiec_GameBet} 
        */
        BlindChoicePlayCode: function () {

            //玩法切换事件
            $("#" + _Option.Choice_PlayCode_El_Id + " .play_select_tit").on("click", "li", function () {
                var lottery_code = $(this).attr("lottery_code");
                $(this).addClass("curr").siblings("li").removeClass("curr");
                $("#" + _Option.Choice_PlayCode_El_Id + " .play_select_cont li").removeClass("curr");
                var _theName = $(this).text();
                $(".choice_playName").empty().text(_theName);
                $("#" + _Option.Choice_PlayCode_El_Id + " .play_select_cont li[lottery_code='" + lottery_code + "']").addClass("curr").children("dl").eq(0).children("dd").eq(0).trigger("click");
            });

            //玩法切换事件
            $("#" + _Option.Choice_PlayCode_El_Id + " .play_select_cont").on("click", "li dl dd", function () {
                $(this).parents("li").eq(0).find("dd").removeClass("curr");
                $(this).addClass("curr");
                
                var _thePlayCode = $(this).attr("lottery_code"); //获取当前玩法的code

                //清除上一次临时选中的帐号
                _This.ClearCheckBallInfo("All");

                //获取彩种玩法所对应的JS文件
                _This.getPlayScript(_thePlayCode);

                //获取彩种玩法的详情
                _This.GetGameDetail_ByCode(_thePlayCode);

            }); 
            //关联点击事件(默认点击页面第一个玩法)
            $("#" + _Option.Choice_PlayCode_El_Id + " .play_select_tit li").eq(0).trigger("click");  
        },
        /**
        * @description 清除上一个玩法的所有选号信息以及，注数以及金额 
        * @extends {Ruiec_GameBet} 
        * @param {string} type 当存在type时，值得是清除整个选号区域以及整个选号信息
        */
        ClearCheckBallInfo: function (type) {

            //选中的注数清零
            $("#" + _Option.ChoiceNote_El_Id).empty().text("0");

            //选中的金额清零
            $("#" + _Option.ChoiceNotePrice_El_Id).empty().text("0");

            if (type!=undefined) {
                //清空选号区域
                $("#" + _Option.Choice_BallArea_El_Id).empty(); 
            } 
        },
        /**
        * @description 获取彩种玩法所对应的
        * @extends {Ruiec_GameBet} 
        * @param {string} play_code 当前彩种的玩法编码（唯一编码）
        */
        getPlayScript: function (play_code) {
            
            var _LotteryCode = _This.ruiec_returnLottery(); //彩种编号 
            if (_LotteryCode == undefined || _LotteryCode == "") {
                _LotteryCode = 1000;
            }

            //加载彩种公用玩法
            var _PlayCodeCommonId = "PlayCommonJs_" + _LotteryCode;
            if ($("#" + _PlayCodeCommonId).size() != 1) {
                var _JS_CommonName = "<script id='" + _PlayCodeCommonId + "' type='text/javascript' src='" + _Option.Js_Root + "/js/play_js/" + _LotteryCode + "/basic/RSSC_PlayCommonByCode_" + _LotteryCode + ".js?" + parseInt(Math.random() * 10000) + "'><\/script>";
                $("body").append($(_JS_CommonName));
            }

            var Lottery_Basic_Fn = new $.Lottery_Basic_Fn();
            Lottery_Basic_Fn.init();
              
            //加载彩种对应的 唯一玩法js效果
            $("#insertScript").remove();
            var _JS_Name = "<script id='insertScript' type='text/javascript' play_code='" + play_code + "' src='" + _Option.Js_Root + "/js/play_js/" + _LotteryCode + "/RSSC_Play_" + play_code + ".js?" + parseInt(Math.random() * 10000) + "'><\/script>";
            $("body").append($(_JS_Name));
             
            //获取当前彩种玩法的返点信息
            _This.GetLotteryRebate(_LotteryCode, play_code); 
             
        },
        /**
        * @description 清除上一个玩法的所有选号信息以及，注数以及金额 
        * @extends {Ruiec_GameBet} 
        * @param {string} oplay_code 获取当前彩种玩法编号所代表彩种详细玩法的详情
        */
        GetGameDetail_ByCode: function (oplay_code) {

            //获取缓存中的玩法详情
            var _PlayDetail = _This.GetPlayDetail_ByJSCatch(oplay_code); 
            if (_PlayDetail) {  
                _This.Show_LotteryPlayDetail(_PlayDetail,"ByCatch");
            } else {
                var _TheGetDetail_Api = _Option.Common_Ajax_Api + "?action=get_play_detail";  //获取彩种详情的接口
                var _PostData = { "action": "get_play_detail", "play_code": oplay_code }; //需要提交的数据
                //获取数据请求
                Ruiec_Fn.RAjax("POST", _TheGetDetail_Api, _PostData, "json", _This.Show_LotteryPlayDetail);
            } 
        },
        /**
        * @description 获取当前彩种对应玩法的详情（从自定义JS缓存变量中读取）
        * @extends {Ruiec_GameBet} 
        * @param {string} oplay_code 获取当前彩种玩法编号(唯一编号)
        */
        GetPlayDetail_ByJSCatch: function (oplay_code) {
            var Result = null;
            if (oplay_code != undefined && _PlayDetail != undefined) { 
                for (var i = 0; i < _PlayDetail.length ; i++) {
                    var _thePlayDetailCode = _PlayDetail[i].PlayCode;
                    if (oplay_code == _thePlayDetailCode) {
                        Result = _PlayDetail[i].PlayDetail;
                        i = _PlayDetail.length ;
                    }
                } 
                return Result;
            } else {
                return Result;
            }
        },
        /**
        * @description 展示彩种的详情，包括玩法说明，玩法案例等
        * @extends {Ruiec_GameBet} 
        * @param {string} oplay_code 获取当前彩种玩法编号(唯一编号)
        */ 
        Show_LotteryPlayDetail: function (data, cateName) {

            //添加JS变量缓存
            if (cateName == undefined) {
                _PlayDetail = _PlayDetail || [];
                var _PlayDetail_Catch_Obj = {};
                _PlayDetail_Catch_Obj.PlayCode = data.play_code;
                _PlayDetail_Catch_Obj.PlayDetail = data;
                _PlayDetail.push(_PlayDetail_Catch_Obj);
            }

            //处理结果
            var oStatus = data.state; //获取返回数据的状态值，为1时有值。
            if (oStatus) { 
                var g_explain = data.explain; //获取彩种说明文字
                var g_examples = $.trim(data.examples); //获取彩种示例
                g_examples = g_examples.split("@");
                var g_cardinal_money = data.cardinal_money //获取彩种奖金 
                var g_attached_list = data.attached_list; //获取最高奖金列表，如果长度大于零则是多奖金      
                //var g_palyHtml = '<i class="iconfont c_org">&#xe60a;</i>' +
                //                '<span>' + $.trim(g_explain) + '</span>' +
                //                '<a class="example_btn">选号示例</a>' +
                //                '<div class="example_tip">' +
                //                    '<i class="arrow_top"></i>' +
                //                    '<p>投注：' + $.trim(g_examples[0]) + '<br />开奖：' + $.trim(g_examples[1]) + '</p>' +
                //                '</div>'; 

                var g_palyHtml = '<i class="iconfont c_org">&#xe60a;</i><span>' + $.trim(g_explain) + '</span>';
                if (data.attached_list.length > 0) {
                    var _DataString = Ruiec_Fn.Json_To_String(data.attached_list);
                    $("#" + _Option.Choice_PlayCode_El_Id).find("dd[lottery_code='" + data.play_code + "']").eq(0).attr("peilv", _DataString);
                    $("#" + _Option.SureChoice_El_Id).attr("peilv", _DataString);
                    var _PeiLv_List = data.attached_list;
                    for (i in _PeiLv_List) {
                        var _theTitle = _PeiLv_List[i].title;
                        var _thePeilv = _PeiLv_List[i].cardinal_money;
                        var _theRelationObj = $("#" + _Option.Choice_BallArea_El_Id).find(".ball_number[ball-number='" + _theTitle + "']");
                        if (_theRelationObj && _theRelationObj.length > 0) _theRelationObj.attr("peilv", _thePeilv);
                        //_theRelationObj.next().empty().text(_thePeilv);
                        var _ChildPeiLv = _theRelationObj.find("p");
                        if (_ChildPeiLv.length > 0) {
                            _ChildPeiLv.empty().text("赔率" + _thePeilv);
                        }
                    }

                } else { 
                    var _thePeilv = data.cardinal_money; //赔率
                    $("#" + _Option.Choice_BallArea_El_Id).find(".ball_number").each(function () {
                        $(this).attr("peilv", _thePeilv);
                    }); 
                    $("#" + _Option.Choice_PlayCode_El_Id).find("dd[lottery_code='" + data.play_code + "']").eq(0).attr("peilv", _thePeilv);
                    $("#" + _Option.SureChoice_El_Id).attr("peilv", _thePeilv);

                    var _PlayCode = data.play_code;
                    _PlayCode = _PlayCode.substring(4, _PlayCode.length-1);
                    if (_PlayCode != "A0") {
                        //非和值
                        $("." + _Option.KsChoice_Peilv_Input).val(_thePeilv);
                    } 
                }

            } else { 
                g_palyHtml = "";
            };

            //替换玩法内容
            $("#" + _Option.LotteryPlayRegion_El_Id).empty().html(g_palyHtml);
        },
        /**
        * @description 获取彩种玩法的返点金额
        * @extends {Ruiec_GameBet} 
        * @param {string} lotteryCode 当前彩种编号
        * @param {string} oplay_code 当前彩种玩法编号(唯一编号)
        */ 
        GetLotteryRebate: function (lotterycode, playcode) {  
            //不要返点
            //return true; 
            var _this = this;
            if (lotterycode == undefined) { lotterycode = "1000"; }
            if (playcode == undefined) { playcode = "1000H11"; }

            function ShowRebateCallBack(data) {  
                if (data&&data.Code != undefined && data.Code == 1) {
                    var theFD_data = data.Data == undefined ? [] : data.Data;
                    if (theFD_data.length > 0) {

                        $("#" + _Option.LotteryPlayRebate_Select_Id).empty().show();
                        $("#" + _Option.LotteryPlayRebate_Select_Id).attr("fdArray", data.Data.join(","));

                    } else { 
                        $("#" + _Option.LotteryPlayRebate_Select_Id).hide();
                    }

                    var _FanDianInfos = 0;  
                    var fdArray = new Array();
                    var theUnitValue = $("#" + _Option.ChoiceUnit_Select_Id).val() == undefined ? 1 : $("#" + _Option.ChoiceUnit_Select_Id).val();

                    for (var i = 0 ; i < theFD_data.length ; i++) {
                        
                        var oPtion_val = theFD_data[i];
                        var oPtion_val_money = parseFloat(oPtion_val.split("-")[0]); //金额
                        var oPtion_val_fd = oPtion_val.split("-")[1];  //返点
                        if (theUnitValue > 1) theUnitValue = 1;
                        if (theUnitValue < 0) theUnitValue = 0;

                        oPtion_val_money = oPtion_val_money * theUnitValue; //单位 所对应的返点 
                        oPtion_val_money = isNaN(parseFloat(oPtion_val_money)) ? oPtion_val_money : parseFloat(oPtion_val_money);

                        var _theStrings = oPtion_val_money.toString();
                        var _TheFloatLen = _theStrings.split(".").length;
                        if (_TheFloatLen > 1) {
                            var _TheFloatLens = _theStrings.split(".")[1].length;
                            if (_TheFloatLens > 5) {
                                oPtion_val_money = parseFloat(oPtion_val_money).toFixed(5);
                            }
                        }

                        var item_val = oPtion_val_money + "-" + oPtion_val_fd;
                        var itemAll = "<option value='" + item_val + "'>" + item_val + "</option>"; 
                        $("#" + _Option.LotteryPlayRebate_Select_Id).append($(itemAll));

                        if (theFD_data[i] == "0-0.0") {
                            _FanDianInfos++;
                        }
                    }

                    if (_FanDianInfos > 0) {
                        $(".choice_cound .fandian").hide();
                    } 
                } 
            }

            var _TheGetDetail_Api = _Option.Common_Ajax_Api + "?action=get_lottery_rebate_list";  //获取彩种详情的接口
            var _PostData = { "action": "get_lottery_rebate_list", "lottery_code": lotterycode, "play_code": playcode }; //需要提交的数据
            //获取数据请求
            Ruiec_Fn.RAjax("POST", _TheGetDetail_Api, _PostData, "json", ShowRebateCallBack); 
        },
        /**
        * @description 获取当前彩种初始化变量
        * @extends {Ruiec_GameBet} 
        * @param {string} lotteryCode 当前彩种编号
        * @param {string} oplay_code 当前彩种玩法编号(唯一编号)
        */
        GetGameBet_Options:function(){
            return W.GameBetOption;
        }, 
        /**
        * @description 创建投注区域的html：遗漏冷热切换按钮 
        */
        CreatCheckBallArea_TabTT: function () {
            var strVar_tit = "";  //遗漏、冷热头部
            strVar_tit += "<div class=\"gn_main_tit\">";
            strVar_tit += "     <ul class=\"game_frequency_type\">";
            strVar_tit += "         <li><a class=\"curr\" value=\"遗漏\">遗漏<\/a><a href=\"javascript:void(0)\" value=\"遗漏\">冷热<\/a><\/li>";
            strVar_tit += "     <\/ul>";
            strVar_tit += "     <ul class=\"game_frequency_item\">";
            strVar_tit += "         <li class=\"curr\"><a href=\"javascript:void(0)\" value=\"当前遗漏\" class=\"curr\">当前遗漏<\/a><a href=\"javascript:void(0)\" value=\"最大遗漏\">最大遗漏<\/a><\/li>";
            strVar_tit += "         <li><a value=\"30\" class=\"curr\">30期<\/a><a value=\"60\">60期<\/a><a value=\"100\">100期<\/a><\/li>";
            strVar_tit += "     <\/ul>";
            strVar_tit += "<\/div>";

            return strVar_tit;
        },
        /**
        * @description 创建投注区域的html：选球
        * @author  梁汝翔<liangruxiang>  
        * @param s 开始的值
        * @param e 结束的值
        * @param Ball_type 单球  或者 双球
        * @param yilou 是否展示遗漏
        * @return  返回球html 
        */
        CreatCheckBallArea_BallObj: function (s, e, Ball_type, yilou) {
            if (yilou == undefined) { yilou = "true"; };
            if (s == undefined) { s = 0; }
            if (e == undefined) { e = 10; }
            if (Ball_type == undefined || Ball_type != "even") {
                Ball_type = "true";
            } else {
                Ball_type = "even";
            }  //单球  或者 双球
            var strVar_ball = "" //选球区当行 
            for (var a = s; a < e; a++) {
                var strVar_ball_item = "" //选球区当行单个球
                strVar_ball_item += "           <li class='" + Ball_type + "'>";
                if (Ball_type == "true") {
                    strVar_ball_item += "               <a class=\"ball_number\" href=\"javascript:void(0)\" ball-number='" + a + "' >" + a + "<\/a>";
                } else {
                    if (a > 9) {
                        strVar_ball_item += "               <a class=\"ball_number\" href=\"javascript:void(0)\" ball-number='" + a + "' >" + a + "<\/a>";
                    } else {
                        strVar_ball_item += "               <a class=\"ball_number\" href=\"javascript:void(0)\" ball-number='0" + a + "' >0" + a + "<\/a>";
                    }
                }
                if (yilou == "true") {
                    strVar_ball_item += "               <span class=\"ball_aid\">0<\/span>";
                }
                else {
                    strVar_ball_item += "";
                };
                strVar_ball_item += "           <\/li>";
                strVar_ball = strVar_ball + strVar_ball_item;
            };
            return strVar_ball;
        },
        /**
        * @description 创建投注区域快捷选号（全、大、小、奇、偶、清） 
        * @return  返回操作html 
        */
        CreatCheckBallArea_QuickCheck: function () {
            var ballControl = "";  //选号操作区（全、大、小、奇、偶、清）
            ballControl += "        <div class=\"ball_control\">";
            ballControl += "            <a class=\"control_btn\"><\/a>";
            ballControl += "            <div class=\"control_hidden\">";
            ballControl += "               <a class=\"set_all\" value='All' href=\"javascript:void(0)\">全<\/a>";
            ballControl += "               <a class=\"set_big\" value='Big'  href=\"javascript:void(0)\">大<\/a>";
            ballControl += "               <a class=\"set_small\" value='Small'  href=\"javascript:void(0)\">小<\/a>";
            ballControl += "               <a class=\"set_odd\" value='Odd'  href=\"javascript:void(0)\">奇<\/a>";
            ballControl += "               <a class=\"set_even\" value='Even'  href=\"javascript:void(0)\">偶<\/a>";
            ballControl += "               <a class=\"set_none\" value='Empty'  href=\"javascript:void(0)\">清<\/a>";
            ballControl += "               <i class='arrow_bottom'></i>";
            ballControl += "            <\/div>";
            ballControl += "        <\/div>";
            return ballControl;
        },
        /**
        * @description 单式输入框内容  
        */
        CreatSingleBox: function (Example_html) {

            if (Example_html == undefined) { Example_html = '<p>12356,1255,22235,12356...<\/p>'; }


            var strVar = "";
            strVar += "<div class=\"ball_section_ds\">";
            strVar += "     <div class=\"ds_dr\">";
            strVar += "        <a class=\"dr drorder\"><i class=\"iconfont\"><\/i>导入注单<\/a>";
            strVar += "        <a class=\"gs example_btn\">查看标准格式样本<\/a>";
            strVar += "        <div class=\"example_tip\" style=\"display: none;\">";
            strVar += Example_html;
            strVar += "        <\/div>";
            strVar += "     <\/div>";
            strVar += "     <div class=\"ds_input\">";
            strVar += "         <textarea class=\"ds_textarea\"><\/textarea>";
            strVar += "         <p class=\"ds_text\">";
            strVar += "             说明：<br>1、请参照\"标准格式样本\"格式录入或上传方案。<br>";
            strVar += "             2、每一注号码之间请使用空格分开，每注之间以回车、逗号或分号进行分隔<br>";
            strVar += "             3、文件格式必须是.txt格式。<br>";
            strVar += "             4、文件较大时会导致上传时间较长，请耐心等待！<br>";
            strVar += "             6、导入文本内容后将覆盖文本框中现有的内容。<\/p>";
            strVar += "    <\/div>";
            strVar += "    <div class=\"ds_btn\">";
            strVar += "         <a class=\"ds_btn_item del_error\"><i class=\"iconfont\"><\/i>删除错误项<\/a>";
            strVar += "         <a class=\"ds_btn_item del_unique\"><i class=\"iconfont\"><\/i>检查格式是否正确<\/a>";
            strVar += "         <a class=\"ds_btn_item del_empty\"><i class=\"iconfont\"><\/i>清空文本框<\/a>";
            strVar += "    <\/div>";
            strVar += "<\/div>";

            return strVar;
        },
        /**
        * @description 返回当前的彩种玩法 编码
        */
        ruiec_getLotteryPlayData: function () {
            if (_Option.Choice_PlayCode_El_Id == undefined || _Option.Choice_PlayCode_El_Id  == "") {
                _Option.Choice_PlayCode_El_Id = W.GameBetOption.Choice_PlayCode_El_Id;
            }
            var LotteryPlayCode = $("#" + _Option.Choice_PlayCode_El_Id + " .play_select_cont li.curr .curr").attr("lottery_code");
            return LotteryPlayCode;
        },
        /**
        * @description 返回当前的彩种玩法 
        * @param openTimeList 期号的时间列表
        * @param oLastIssue 最近一期的开奖期号
        * @param oLastOpenTime 最近一期的开奖时间 
        * @param oLastOpenNum 最近一起的开奖号码
        * @param oFendan 当前彩种的封单时间
        * @param oLotteryCode 当前彩票的彩种
        */
        ruiec_showNowIussue: function (openTimeList, oLastIssue, oLastOpenTime, oLastOpenNum, oFendan, oLotteryCode) { 
            //console.log(openTimeList, oLastIssue, oLastOpenTime, oLastOpenNum, oFendan, oLotteryCode); 

            //扩展全局变量
            _Option.Lottery_OpenTimeList = openTimeList;
            _Option.oLastIssue = oLastIssue;
            _Option.oLastOpenTime = oLastOpenTime;
            _Option.oLastOpenNum = oLastOpenNum;

            W.GameBetOption = _Option;

            //创建当前开奖时间是哪一期，并执行当前期开奖号码
            _This.Calculation_lottery_CountdownFn(openTimeList, oLastIssue, oLastOpenTime, oLastOpenNum);

        },
        refreshHistoryOpenNum:function(openIssue, openNum){
                            var _NumberArray = openNum.split(",");
       	                    var _NumberHeZhi = Number(_NumberArray[0]) + Number(_NumberArray[1]) + Number(_NumberArray[2]);
       	                    if(isNaN(Number(_NumberHeZhi)))
                            {
                                return undefined;
                            }
                            var da=Number(_NumberHeZhi)>10?"大":"小"; 
                            var daColor=da=="大"?"#686ff6":"#c6ba01";
                            var danshuan=Number(_NumberHeZhi)%2 == 0?"双":"单"
                            var danshuanColor=danshuan=="双"?"#87c95d":"#d0517e";
       	                    var _theNewString = "<tr>";
       	                        _theNewString += "  <td class='fz13'>" + openIssue + "</td>";
       	                        _theNewString += "  <td class='c_red fb'>" + openNum + "</td>";
       	                        _theNewString += "  <td class='c_blue fb'>" + _NumberHeZhi + "</td>";
       	                        _theNewString += "  <td>";
       	                        _theNewString += "      <em class='da' style='background-color:"+daColor+"' >" + da + "</em>";
       	                        _theNewString += "      <i>|</i>";
       	                        _theNewString += "      <em class='dan' style='background-color:"+danshuanColor+"' >" + danshuan + "</em>";
       	                        _theNewString += "  </td>";
       	                        _theNewString += "</tr>"; 
       	                    $("#fn_getoPenGame .tbody").prepend($(_theNewString));
       	                    $("#fn_getoPenGame .tbody tr:last").remove();
       	                 
        
        },
        /**
        * @description 返回当前的彩种玩法 
        * @param openTimeList 期号的时间列表
        * @param oLastIssue 最近一期的开奖期号
        * @param oLastOpenTime 最近一期的开奖时间 
        * @param oLastOpenNum 最近一起的开奖号码 
        */
        Calculation_lottery_CountdownFn: function (openTimeList, oLastIssue, oLastOpenTime, oLastOpenNum) {


            var openTimeList = _Option.Lottery_OpenTimeList || openTimeList;
            var oLastIssue = _Option.oLastIssue || oLastIssue ; //最近一起的开奖期号
            var oLastOpenTime = _Option.oLastOpenTime || oLastOpenTime; //最近一期的开奖时间
            var oLastOpenNum = _Option.oLastOpenNum || oLastOpenNum; //最近一期的开奖号码
            var Lottery_Code = "";

            var _theServerTime = _This.GetServerTime();  //获取服务器时间

            var _theBettingIssue = ""; //当前期的期号
            var _theBettingIssue_EndTime = ""; //当前期的开奖时间（封单时间）
            var _theBetting_PrevIssue = ""; //当前期上一期的期号  
            var _theBetting_NextIssue = "";

             
            //遍历每一行 判断当前期是哪一期。
            for (var i = 0 ; i < openTimeList.length ; i++) {
                //console.log(openTimeList[i]);
                if (i < openTimeList.length - 1) { 
                    var _theStartTime = openTimeList[i].newBeginTime; //当前期的开奖时间
                    var _theEndTime = openTimeList[i + 1].newBeginTime; //下一期的开奖时间

                    if (_theServerTime > _theStartTime && _theServerTime <= _theEndTime) {

                        _theBettingIssue = openTimeList[i + 1].newIssue; //当前可投注的期号
                        _theBetting_PrevIssue = openTimeList[i].newIssue; //当前正在开奖的期号
                           $("#" + _Option.CurrentOpenIssue_El_Id).empty().text(_theBetting_PrevIssue);
                              $("#" + _Option.LatestOpenNumber_El_Id).empty().text(oLastOpenNum);
                                $("#issueText").empty().html("期开奖号");
                        _theBetting_NextIssue = openTimeList[i + 2] == undefined ? "" : openTimeList[i + 2].newIssue; // 下一期的期号
                        _theBettingIssue_EndTime = _theEndTime; //当前可投注期号的截至投注时间 
                        i = openTimeList.length;
                    }  
                } else {
                    console.log("时间表长度不够..");
                }
            }

            //console.log("当前可投注的期号" + _theBettingIssue,"当前可投注期号的截至投注时间"+_theBettingIssue_EndTime+"日期："+new Date(_theBettingIssue_EndTime), "当前正在开奖的期号" + _theBetting_PrevIssue);
            if (_theBettingIssue != "" && _theBettingIssue_EndTime != "" && _theBetting_PrevIssue != "") { 

                //执行倒计时
                _This.ShowBetting_CountDown_Fn(_theBettingIssue, _theBettingIssue_EndTime, _theBetting_NextIssue);

                if (_theBetting_PrevIssue != oLastIssue) {
                    if (_GetOpenNumbers != undefined) {
                        clearTimeout(_GetOpenNumbers);
                    }
                    //console.log("执行开奖动画");
                    var oAjaxUrl = _Option.Common_Ajax_Api; //接口地址
                    var Lottery_Code = _Option.lotteryCode;//当前彩种
                    
                    //console.log(_Option);
                    var oOpenNumString = _Option.oLastOpenNum; //开奖号码

                    var oOpenNum = oOpenNumString.split(",");
                    var oOpenNum_ball_all = "";

                    for (var a = 0; a < oOpenNum.length; a++) {
                        var oOpenNum_item = oOpenNum[a];
                        var oOpenNum_ball = '<li class="gif">' +
                                                '<div class="li_wrap">' +
                                                    '<span></span>' +
                                                '</div>' +
                                            '</li>';
                        oOpenNum_ball_all = oOpenNum_ball_all + oOpenNum_ball;
                    };

                    if (oOpenNum_ball_all != "") {
                        $("#" + _Option.CurrentOpenIssue_El_Id).empty().text(_theBetting_PrevIssue); 
                        $("#" + _Option.LatestOpenNumber_El_Id).empty().html("等待开奖");
                        $("#issueText").empty().html("期");
                    }


                    //执行获取当前正在开奖的开奖号码
                    _This.GetLottery_LeastOpenNumb(oAjaxUrl , Lottery_Code, _theBetting_PrevIssue);
                }
            } else {
                console.log("找不到开奖信息");
            }
        },
        /**
        * @description 获取服务器的时间  
        */
        GetServerTime: function () { 
            var _theTime = $("#" + _Option.BettingCountdown_El_Id).attr("serverTime") == undefined ? "" : $("#" + _Option.BettingCountdown_El_Id).attr("serverTime"); 
            if (isNaN(_theTime)||_theTime == "") {
                _theTime = new Date().getTime();
            }
            return _theTime;
        },
        /**
        * @description 执行倒计时的动画 
        */
        ShowBetting_CountDown_Fn: function (BettingIssue, BettingEndTime, Betting_NextIssue) {

            JS_LoadingTime = new Date().getTime() - JS_LoadingTime;
            //console.log("conmplete==" + new Date().getTime());
            //console.log("needTime==" + JS_LoadingTime);

            _Option.BettingIssue = BettingIssue;  
            //更新期号
            $("#" + _Option.CurrentBettingIssue_El_Id).empty().text(BettingIssue);
            if ($("." + _Option.CurrentBettingIssue_El_Id).size() > 0) $("." + _Option.CurrentBettingIssue_El_Id).empty().text(BettingIssue);

              
            var _theTime = $("#" + _Option.BettingCountdown_El_Id).attr("serverTime"); //获取当前服务器时间
            _theTime = isNaN(parseInt(_theTime)) ? new Date().getTime() : parseInt(_theTime);
            if (_theTime == undefined) _theTime = new Date().getTime(); 
            var _theChaZhi = BettingEndTime - _theTime; //相差多少毫秒  

            var _TheLocalTime = new Date().getTime();
            var _Local_TO_ServerTime = _theTime - _TheLocalTime; //本地与服务器之间的时间差
            _Local_TO_ServerTime = Math.abs(_Local_TO_ServerTime);
            if (isNaN(_Local_TO_ServerTime)) _Local_TO_ServerTime = 10000;
               
            //执行倒计时的效果 
            _This.ShowCountDown_SetTimeOut(_Local_TO_ServerTime, BettingEndTime, BettingIssue, Betting_NextIssue);
             
        },
        /**
        * @description 执行倒计时定时器
        * @param {Number} _Local_TO_ServerTime 本地与服务器的时间差（毫秒）
        * @param {Number} BettingEndTime 当前期结束时间（毫秒时间戳）
        */
        ShowCountDown_SetTimeOut: function (_Local_TO_ServerTime, BettingEndTime, BettingIssue, Betting_NextIssue) {
         
            setTimeout(function () { 
                 this.modi=this.modi||0;
                 this.modi=this.modi+1;
                if (_Local_TO_ServerTime < 10000) {
                    var _theTime = $("#" + _Option.BettingCountdown_El_Id).attr("serverTime"); //获取当前服务器时间
                    _theTime = isNaN(parseInt(_theTime)) ? new Date().getTime() : parseInt(_theTime);  
                } else {
                    var _theTime = $("#" + _Option.BettingCountdown_El_Id).attr("serverTime"); //获取当前服务器时间
                }
             
                var _theChaZhi = BettingEndTime - _theTime; //相差多少毫秒 
                  if (this.modi<2) {
//                    _theChaZhi=_theChaZhi+2*1000;
//                    _theChaZhi=_theChaZhi-modi*1000; 
                    } 
                   
                     
                if (_theChaZhi > 0) {  
                    
                    //最后一秒钟，弹窗切换回调逻辑
                    _This.ShowCountDown_Animate(_theChaZhi);

                    _This.ShowCountDown_SetTimeOut(_Local_TO_ServerTime, BettingEndTime, BettingIssue, Betting_NextIssue); 
                } else { 
                    //提示当前期结束
                    _This.ShowNextIssue_Infos(BettingIssue, Betting_NextIssue); //当前期号与下一期的期号  
                }

            }, 1000); 
        },
        /**
        * @description 执行倒计时动画
        * @param {Number} _theChaZhi 相差多少毫秒
        */
        ShowCountDown_Animate: function (_theChaZhi) {
            if (_theChaZhi <= 0) _theChaZhi = 0 ;  
            var _theSecond = Number(_theChaZhi / 1000);
            _theSecond = parseInt(_theSecond); //距离结束有多少秒

            var h = parseInt(_theSecond / 3600) >= 10 ? parseInt(_theSecond / 3600) : "0" + parseInt(_theSecond / 3600);
            var m = parseInt(_theSecond % 3600 / 60) >= 10 ? parseInt(_theSecond % 3600 / 60) : "0" + parseInt(_theSecond % 3600 / 60);
            var s = parseInt(_theSecond % 3600 % 60) >= 10 ? parseInt(_theSecond % 3600 % 60) : "0" + parseInt(_theSecond % 3600 % 60);

//            var _h1 = parseInt($(".j_lottery_time .time_h1").text()),
//                _h2 = parseInt($(".j_lottery_time .time_h2").text()),
//                _m1 = parseInt($(".j_lottery_time .time_m1").text()),
//                _m2 = parseInt($(".j_lottery_time .time_m2").text()),
//                _s1 = parseInt($(".j_lottery_time .time_s1").text()),
//                _s2 = parseInt($(".j_lottery_time .time_s2").text()); 


            var _theString = "";
            if (h > 0) {
                _theString = h + "时" + m + "分" + s + "秒";
            } else {
                _theString = m + "分" + s + "秒";
            }
           // console.log(1);
            $("#" + _Option.BettingCountdown_El_Id).empty().text(_theString);
            if ($("." + _Option.BettingCountdown_El_Id).size() > 0) $("." + _Option.BettingCountdown_El_Id).empty().text(_theString);

            
        },
        /**
        * @description 提示当前期已截至，执行下一期  
        */
        ShowNextIssue_Infos: function (BettingIssue, Betting_NextIssue) {

            $("#" + _Option.ChoiceBettingType_El_Id).find("input[value='0']").trigger("click");//切换至我要自购

            if (Betting_NextIssue == "") {
                var aContent = "<p id='dialog_text'>" + BettingIssue + "期已截止</br>投注时请注意期号！</p>";
            } else {
                var aContent = "<p id='dialog_text'>" + BettingIssue + "期已截止</br>当前期为<i class='c_org'>" + Betting_NextIssue + "</i>期</br>投注时请注意期号！</p>";
                _Option.BettingIssue = Betting_NextIssue;
            } 
            
            Ruiec_Fn.alert(aContent, "CountDown", 5);

            setTimeout(function () {
                //执行下一期的期号更新，倒计时更新
                _This.Calculation_lottery_CountdownFn();
            }, 1000);
        },
        /**
        * @description 执行获取当前正在开奖的开奖号码  
        */
        GetLottery_LeastOpenNumb: function (oAjaxUrl, lottery_code, _thisIssueTime_No) { 

            var _theTimes = new Date(); 
            $.ajax({
                type: "POST",
                url: oAjaxUrl + "?times=" + _theTimes.getTime(),
                cache: false,
                data: {
                    action: 'get_lottery_open_new',
                    lottery_code: lottery_code
                },
                dataType: "json",
                success: function (data) {
                    var _theData = data == undefined ? "" : data;
                    if (_theData != "" && _theData.issue_no == _thisIssueTime_No) {
                        var _theTimes2 = new Date(); 
                        _GetsetInterval = "false";

                        var oOpenNumString = _theData.lotteryopen_no == undefined ? "" : _theData.lotteryopen_no; 
                        if (oOpenNumString.indexOf(",") > 0) {
                            var oOpenNum = oOpenNumString.split(",");
                            var oOpenNum_ball_all = "";
                            for (var a = 0; a < oOpenNum.length; a++) {
                                var oOpenNum_item = oOpenNum[a];
                                var oOpenNum_ball = '<li>' +
                                                        '<div class="li_wrap">' +
                                                            '<span>' + oOpenNum_item + '</span>' +
                                                        '</div>' +
                                                    '</li>';
                                oOpenNum_ball_all = oOpenNum_ball_all + oOpenNum_ball;
                            };
                            $("#" + _Option.LatestOpenNumber_El_Id).empty().html(oOpenNumString);
                            $("#issueText").empty().html("期开奖号");
                            _This.refreshHistoryOpenNum(_thisIssueTime_No,oOpenNumString);
                            clearTimeout(_GetOpenNumbers);
                        } else {
                            var oOpenNum = [];
                            _GetOpenNumbers = setTimeout(function () {
                                //快速获取开奖号码
                                _This.GetLottery_LeastOpenNumb(oAjaxUrl, lottery_code, _thisIssueTime_No);
                            }, 1000);
                        }
                    } else {
                        _GetOpenNumbers = setTimeout(function () {
                            //快速获取开奖号码
                            _This.GetLottery_LeastOpenNumb(oAjaxUrl, lottery_code, _thisIssueTime_No);
                        }, 1000);
                    }
                }
            });
        },
        /**
        * @description 创建临时订单,并追加到投注区域当中去
        * @param {JSON} _OrderObj 订单的投注信息
        * @param {ElementObject} _AreaContainer 当前的选号容器
        */
        CreatTzOrder_FillInTable: function (_OrderObj, _AreaContainer) {
            
            if ($("#" + _Option.SureChoice_El_Id).size() > 0 && $("#" + _Option.SureChoice_El_Id).hasClass("curr")) {
                //已有正在处理的操作，请不要点击的太快
                console.log("已有正在处理的操作，请不要点击的太快");
                return false;
            }

            var _theBettingValue = $("#" + _Option.ChoiceNotePrice_El_Id).text();
            if (Number(_theBettingValue) <= 0) {

                $("#" + _Option.KsChoice_EachPrice_Input).focus();
                return false;
            }

            var _ThePlayCode = _This.ruiec_getLotteryPlayData();//玩法编码
            _OrderObj.tz_PlayCode = _ThePlayCode;
            //1、获取投注区域是否有临时订单
            var InterimOrder_Cont = $("#" + _Option.ChoiceInfoListCont_TB_Id); //表格对象
            if (InterimOrder_Cont.find("tr").length > 0) {
                 
                var _order_tz_infos = _OrderObj._tz_infos;    
                var _TheAddCode = InterimOrder_Cont.find("tr[order_code='" + _order_tz_infos + "'][order_play_code='" + _ThePlayCode + "']").length;
                if (_TheAddCode > 0) {
                    var _theEditorTrObj = InterimOrder_Cont.find("tr[order_code='" + _order_tz_infos + "'][order_play_code='" + _ThePlayCode + "']");


                    //是编辑状态还是合并状态
                    _This.EditorOrder_InInterimOrderCont(_OrderObj, _theEditorTrObj, "hebing");
                } else {
                    //直接追加内容到选号区域
                    _This.AddOrder_InInterimOrderCont(_OrderObj);
                }

            } else {

                //直接追加内容到选号区域
                _This.AddOrder_InInterimOrderCont(_OrderObj);
            }

            //绑定临时订单的删除事件
            _This.Del_InInterimOrder(); 

            //清除生成当前的
            _This.ruiec_clearTzCheckBall();

            //方案总注数计算和赋值
            _This.ruiec_orderCountMoney();
        },
        /**
        * @description 创建临时订单,编辑临时方案列表中的方案
        * @param {JSON} OrderData 订单的投注信息
        * @param {ElementObject} _theEditorTrObj 临时方案列表中的那个对象
        * @param {ElementObject} _AreaContainer 当前的选号容器
        */
        EditorOrder_InInterimOrderCont: function (OrderData, _theEditorTrObj, _AreaContainer) {

            var _theCommon_Tr = -1;
            var _theCommon_TrObj = null;

            _theEditorTrObj.find(".each_price").focus();

            /*
            //遍历内容[可能存在内容相同，单位不同的情况]
            _theEditorTrObj.each(function () {
                var theLikeTr_Unit = $(this).find(".order_unit").attr("order_unit_num") == undefined ? "元" : $(this).find(".order_unit").attr("order_unit_num"); //单位 
                if (theLikeTr_Unit == OrderData._tz_UnitStr) { //查看是否可以合并
                    _theCommon_Tr++;
                    _theCommon_TrObj = $(this);
                }
            }); 
            
            if (_theCommon_Tr < 0) {
                //不存在完全相同（单位相同，内容相同）的 新增
                _This.AddOrder_InInterimOrderCont(OrderData, _AreaContainer);
            } else {
                //存在完全相同（单位相同，内容相同）的进行合并  
                var _thisTz_Len = parseInt(_theCommon_TrObj.find(".order_num").eq(0).text()); //投注的注数
                var _thisTz_Beishu = parseInt(_theCommon_TrObj.find(".order_multiple").eq(0).text());  //投注的倍数
                var _thisTz_Price = Number(_theCommon_TrObj.find(".order_money").eq(0).text()); //投注的价格

                if ((_thisTz_Beishu + Number(OrderData._tz_beishu)) > 9999) {
                    //最大倍数9999倍

                    var TheAddBeishu = 9999 - _thisTz_Beishu; //最大倍数-已有倍数 = 【新增倍数】

                    // 注数的百分比
                    var _thePecent = TheAddBeishu / OrderData._tz_beishu;  //新增倍数占现有倍数的多少百分比

                    OrderData._tz_beishu = TheAddBeishu;         //更改当前订单的现有倍数值
                    OrderData._tz_Price = _thePecent * OrderData._tz_Price; //更改当前订单的投注金额
                      
                }

                var _New_Tz_Len = _thisTz_Len; //合并后的注数
                var _New_Tz_Beishu = _thisTz_Beishu + Number(OrderData._tz_beishu); //合并后的倍数
                var _New_Tz_Price = _thisTz_Price + Number(OrderData._tz_Price); //合并后的金额 
                _New_Tz_Price = isNaN(Number(_New_Tz_Price)) ? 0 : Number(_New_Tz_Price);

                if (_New_Tz_Price > 0) {

                    if (_New_Tz_Price.toString().indexOf(".")>0) {
                        _New_Tz_Price = parseFloat(_New_Tz_Price).toFixed(3);   //获取三位小数点
                    }

                    Ruiec_Fn.alert("您选择的号码在号码篮已存在，将直接进行倍数累加", "tips");

                    _theCommon_TrObj.find(".order_num").eq(0).empty().text(_New_Tz_Len);
                    _theCommon_TrObj.find(".order_multiple").eq(0).empty().text(_New_Tz_Beishu);
                    _theCommon_TrObj.find(".order_money").eq(0).empty().text(_New_Tz_Price);
                } 
                //存在完全相同（单位相同，内容相同）的进行合并  
            }
            */
        },
        /**
        * @description 创建临时订单,新增一条方案信息到临时方案列表中去
        * @param {JSON} OrderData 订单的投注信息
        * @param {ElementObject} _AreaContainer 当前的选号容器
        */
        AddOrder_InInterimOrderCont: function (OrderData, _AreaContainer) {

            var order_tz_infos = OrderData._tz_infos;
            var order_play_renxuan = "";
            //如果是任选则将位数赋值到order去
            if (OrderData.rx_typeArray != undefined) { 
                //如果任选位数存在
                order_play_renxuan = OrderData.rx_typeArray;
                var orderCode = OrderData._tz_infos + "&" + order_play_renxuan;
            }else {
                order_play_renxuan = "";
                var orderCode = OrderData._tz_infos
            } 

            //处理投注内容过长导致页面变形，因此进行字符截取
            if (order_tz_infos.length > 35) {
                var _tz_infos_text = order_tz_infos.substring(0, 20) + "..." + "<i class='more alink'>详情</i>";
            } else {
                var _tz_infos_text = order_tz_infos;
            };
            //处理投注内容过长导致页面变形，因此进行字符截取
            var _tz_Unit = 1;
            for (var i = 0 ; i < _Option.ChoiceUnit_Init_Value.length; i++) {
                if (_Option.ChoiceUnit_Init_Value[i].text == OrderData._tz_UnitStr) {
                    _tz_Unit = _Option.ChoiceUnit_Init_Value[i].value;
                    i = _Option.ChoiceUnit_Init_Value.length;
                }
            } 
            
            //var strVar = "";
            //strVar += "<tr order_play_code='" + OrderData.tz_PlayCode + "' order_type_code='" + OrderData._getLottyCode + "' order_code='" + orderCode + "' order_peilv='" + OrderData._tz_peilv + "'>";
            //strVar += "   <td><i class=\"order_type\"> " + OrderData._tz_type + " " + _tz_infos_text + "<\/i><\/td>"; //投注内容
            ////strVar += " <td><i class=\"order_unit\" unit_num='" + _tz_Unit + "' order_unit_num=\"" + OrderData._tz_UnitStr + "\">" + OrderData._tz_UnitStr + "<\/i><\/td>"; //投注单位
            //strVar += "   <td><i class=\"order_num\">" + OrderData._tz_ZLen + "<\/i>注<\/td>";
            ////strVar += " <td><i class=\"order_multiple\">" + OrderData._tz_beishu + "<\/i>倍<\/td>";
            //strVar += "   <td class=\"c_org\"><i class='order_price'>每注<input type='text' class='each_price' value=''>元</i><\/td>";
            //strVar += "   <td><span class='hide_this'>每注可赢：<i class='order_money c_red'></i>元</span><\/td>";
            //strVar += "   <td><i class=\"iconfont c_org l_cancel\"><\/i><\/td>";
            //strVar += "<\/tr>";

            var strVar = "";
            strVar += "<tr order_play_code='" + OrderData.tz_PlayCode + "' order_type_code='" + OrderData._getLottyCode + "' order_code='" + orderCode + "' order_peilv='" + OrderData._tz_peilv + "'>";
            strVar += "<td><span class=\"order_type\">" + OrderData._tz_type + " <i class=\"c_red\">" + _tz_infos_text + "<\/i><\/span><\/td>";
            strVar += "<td style='display:none;'><i class=\"order_unit\" unit_num=\"1\" order_unit_num=\"元\">元<\/i><\/td>";
            strVar += "<td><i class=\"order_num\">" + OrderData._tz_ZLen + "<\/i>注<\/td>    ";
            strVar += "<td style='display:none;'><i class=\"order_multiple\">1<\/i>倍<\/td>";
            strVar += "<td><span class=\"c_org\">每注¥<i class=\"order_money\">" + OrderData._tz_Price + "<\/i>元<\/span><\/td>";
            strVar += "<td><i class=\"order_fandian fl\" style='display:none;'>0-0.0<\/i><i class=\"order_fandian fl\">赔率：&nbsp;" + OrderData._tz_peilv + "<\/i><i class=\"fr l_cancel iconfont \"><\/i><\/td> ";
            strVar += "<\/tr>";


            //追加order
            $("#" + _Option.ChoiceInfoListCont_TB_Id).prepend($(strVar)); 
        },
        /**
        * @description 删除临时投注方案（订单）
        */
        Del_InInterimOrder: function () {

            $("#" + _Option.ChoiceInfoListCont_TB_Id).off("click").on("click", ".l_cancel", function (event) {
                console.log("绑定删除事件");
                event = event || window.event;
                event.stopPropagation();
                $(this).parents("tr").eq(0).remove();

                _This.ruiec_orderCountMoney();
            });

        },
        /**
        * @description 清理当前玩法中，所选中内容的信息 
        * @param {ElementObject} _AreaContainer 玩法的选择区域
        */
        ruiec_clearTzCheckBall: function (_AreaContainer) {

            //清除选号
            if (_AreaContainer != undefined) {
                _AreaContainer.find(".li_ball .ball_number").each(function () {
                    if ($(this).hasClass("curr")) {
                        $(this).removeClass("curr");
                    }
                });
            } else {
                $(".li_ball .ball_number").each(function () {
                    if ($(this).hasClass("curr")) {
                        $(this).removeClass("curr");
                    }
                });
            }
             
            //清除投注信息
            $("#" + _Option.ChoiceInfoListCont_TB_Id + " tr").removeClass("curr");  //去除订单修改选中
            $("#" + _Option.ChoiceNote_El_Id).empty().text("0");  //注数设为0 
            $("#" + _Option.ChoiceNotePrice_El_Id).empty().text("0.00"); //金额设为0 
            $("#" + _Option.SureChoice_El_Id).removeClass("curr"); //去除选号按钮状态(表示可进行下一个数据操作)

            $("#" + _Option.KsChoice_EachPrice_Input).val("");
            $("#" + _Option.KsChoice_NumberInfos_Input).val("");
             
            var _PlayCode = _This.ruiec_getLotteryPlayData();
            _PlayCode = _PlayCode.substring(4, _PlayCode.length - 1);
            if (_PlayCode == "A0") {
                //非和值
                $("." + _Option.KsChoice_Peilv_Input).val("");
            } 
            
             
            //清除大小单双
            if ($(".ball_dxds").size() > 0) {

                var oCheck1 = $(".ball_dxds .ck1");
                var oCheck2 = $(".ball_dxds .ck2");
                for(var a =0; a<oCheck1.size();a++)
                {
                    oCheck1.eq(a).prop("checked",false);
                }
                for(var b =0; b<oCheck2.size();b++)
                {
                    oCheck2.eq(b).prop("checked",false);
                }
            };

            $("#" + _Option.Waplook_detail_btn).trigger("click");

        },
        /**
        * @description 清理已投注的信息
        * @param {ElementObject} _AreaContainer 玩法的选择区域
        */
        ruiec_clearBettingInfos:function(){
            _This.ruiec_clearTzCheckBall();

            $("#" + _Option.ChoiceInfoListCont_TB_Id).empty();
            $("#" + _Option.ToTal_ChoiceNote_El_Id).empty().text("0");
            $("#" + _Option.ToTal_ChoiceNotePrice_El_Id).empty().text("0");
            $("#" + _Option.ChoiceBettingType_El_Id).find("input[value='0']").trigger("click");
        },
        /**
        * @description 统计当前方案的金额信息 
        */
        ruiec_orderCountMoney: function () {
     
            var orderCount_num = 0; //方案数量
            var orderCount_money = 0.00; //金额
            var order_item = $("#" + _Option.ChoiceInfoListCont_TB_Id + " tr");

            order_item.each(function () {
                var order_item_num = $(this).find(".order_num").text();  //每行订单的注数 
                order_item_num = isNaN(Number(order_item_num)) ? 0 : Number(order_item_num);

                var order_item_money = $(this).find(".order_money").text();  //每行订单的金额
                order_item_money = isNaN(Number(order_item_money)) ? 0 : Number(order_item_money);  //每行订单的金额
                
                order_item_money = order_item_money * order_item_num;
                
                orderCount_num = orderCount_num + order_item_num;
                orderCount_money = orderCount_money + order_item_money;
            })
            
            if (orderCount_money.toString().indexOf(".") > 0) {
                orderCount_money = parseFloat(orderCount_money).toFixed(3);
            }

            orderCount_num = parseInt(orderCount_num);

            $("#" + _Option.ToTal_ChoiceNote_El_Id).empty().text(orderCount_num);
            $("#" + _Option.ToTal_ChoiceNotePrice_El_Id).empty().text(orderCount_money);

            //清理追号合买的信息
            $("#" + _Option.ChoiceBettingType_El_Id + " input:eq(0)").trigger("click");
        },
        /**
        * @description 绑定当前彩种的追号事件
        * @extends {Ruiec_GameBet}  
        */
        Bind_Chase_ProgramFn: function () {
             
            var Chase_ProgramCont = $("#" + _Option.ChoiceBettingType_El_Id).find("input:checked").attr("relation_cont_id");  //追号显示区域的id
            _Option.Chase_ProgramContId = Chase_ProgramCont;
            $("#" + Chase_ProgramCont + " .chase_list_tit li:eq(0)").addClass("curr").siblings().removeClass("curr");
            $("#" + Chase_ProgramCont + " .chase_condition").show();
            $("#" + Chase_ProgramCont + " .gjzh").hide();

            //1、生成追号信息
            _This.Creat_Chase_ProgramList(10);
            
            //2、显示追号区域  
            $("#" + Chase_ProgramCont).show();

            //3、绑定普通追号区域的事件

            //3a、版定期号切换事件
            $("#" + Chase_ProgramCont).off("click").on("click",".chase_condition_qi li",function () {
                $(this).siblings().removeClass("curr");
                $(this).addClass("curr");
                var _theValue = $(this).children("i").text();
                _theValue = isNaN(parseInt(_theValue)) ? 10 : parseInt(_theValue);
                $("#" + Chase_ProgramCont + " #f_chase_period_input").val(_theValue);
                $("#" + Chase_ProgramCont + " #f_chase_period_input").trigger("change");
            }); 

            //3b、切换追期号长度
            $("#" + Chase_ProgramCont + " #f_chase_period_input").change(function () { 
                var _theValue = $(this).val(); //追多少期
                _This.Creat_Chase_ProgramList(_theValue);
            });

            //3c、切换倍数
            $("#" + Chase_ProgramCont + " #f_chase_Multiple").change(function () {
                var _theValue = $("#" + Chase_ProgramCont + " #f_chase_period_input").val(); //追多少期
                _This.Creat_Chase_ProgramList(_theValue);
            });
             
            //切换普通追号与高级追号、切换的事件处理
            $("#" + Chase_ProgramCont + " .chase_list_tit li").click(function () {
                $(this).siblings().removeClass("curr");
                $(this).addClass("curr");
                var _theIndex = $(this).index();
                if (_theIndex == 1) {
                    //高级追号
                    $("#" + Chase_ProgramCont + " .chase_condition").hide();  
                    $("#" + _Option.ChaseProgram_Tb_Id).empty();
                    $("#" + Chase_ProgramCont + " .gjzh").show();
                    //处理高级追号
                    _This.Advanced_Chase_ProgramFn();
                } else {
                    //普通追号 
                    $("#" + Chase_ProgramCont + " .chase_condition").show();
                    $("#" + Chase_ProgramCont + " .gjzh").hide();
                    //1、生成追号信息
                    _This.Creat_Chase_ProgramList(10);
                }  
            }); 
        },
        /**
        * @description 根据时间表生成追号列表的数据
        * @extends {Ruiec_GameBet}
        * @param {Number} Chase_len 长度
        */
        Creat_Chase_ProgramList: function (Chase_len) {
          
            Chase_len = Chase_len || 10;
            var Chase_key = 0, Chase_Tr_Str = "", start = false, current_Chase = "", Count_ChaseProgramMoney = {};
            var Lottery_OpenTimeList = _Option.Lottery_OpenTimeList, BettingIssue = _Option.BettingIssue;

            var oMultiple = parseInt($("#f_chase_Multiple").val()) == undefined ? 1 : parseInt($("#f_chase_Multiple").val());   //普通追号倍数
            var oAmount = $("#" + _Option.ToTal_ChoiceNotePrice_El_Id).text(); //合计金额
            var oBettingLen = $("#" + _Option.ToTal_ChoiceNote_El_Id).text(); //合计注数

            oBettingLen = isNaN(Number(oBettingLen)) ? 0 : parseInt(oBettingLen);
            oAmount = isNaN(Number(oAmount)) ? 0 : Number(oAmount);
            for (var i = 0 ; i < Lottery_OpenTimeList.length ; i++) {
                
                if(Lottery_OpenTimeList[i].newIssue == BettingIssue) start = true;
                
                if (Chase_key < Chase_len && start) {

                    Chase_key++; 
                     
                    var oNextIssue = Lottery_OpenTimeList[i].newIssue;
                    var oNextBeginTime = Lottery_OpenTimeList[i].newBeginDate; 
                    if (Chase_key == 1) {
                        current_Chase = "<i class='c_red'>(当前期)</i>"
                        oNowClass = "zhuihao_now"
                    } else {
                        current_Chase = "";
                        oNowClass = "";
                    };

                    var oAmountS = oAmount * oMultiple; //倍数下的金额

                    var ChaseMoney = Count_ChaseProgramMoney.ChaseTotalMoney || 0;
                    var Chase_betting_len = Count_ChaseProgramMoney.ChaseBettingLength || 0;
                    ChaseMoney += oAmountS;
                    Chase_betting_len += oBettingLen;

                    Count_ChaseProgramMoney.ChaseLength = Chase_key;
                    Count_ChaseProgramMoney.ChaseBettingLength = Chase_betting_len;
                    Count_ChaseProgramMoney.ChaseTotalMoney = ChaseMoney;

                    var strVar = "";
                    strVar += "<tr>";
                    strVar += "     <td class='key " + oNowClass + "'>" + Chase_key + "<\/td>"; 
                    strVar += "     <td class='issue'>";
                    strVar += "         <input data-action=\"checkedRow\" class=\"chase_row_checked\" type=\"checkbox\" checked=\"checked\">";
                    strVar += "         <span class=\"chase_row_number\" issuecode=" + oNextIssue + ">" + oNextIssue + current_Chase + "<\/span>";
                    strVar += "     <\/td>";
                    strVar += "     <td class='multiple'>";
                    strVar += "         <input class=\"ty_text onlyNum chase_row_multiple\" readonly='true' value=\"" + oMultiple + "\" type=\"text\" />倍";
                    strVar += "     <\/td>";
                    strVar += "     <td class='money'>";
                    strVar += "         <span class=\"price\"><em>¥<\/em><span class=\"chase_row_money\">" + oAmountS + "<\/span> 元<\/span>";
                    strVar += "     <\/td>";
                    strVar += "     <td class='time'>";
                    strVar += "         <span class=\"chase_row_time\">" + oNextBeginTime + "<\/span>";
                    strVar += "     <\/td>";
                    strVar += "<\/tr>"; 
                    Chase_Tr_Str = Chase_Tr_Str + strVar; 

                } else if (start) { 
                    i = Lottery_OpenTimeList.length; 
                }

            }

            if (Chase_Tr_Str != "") {
                $("#" + _Option.ChaseProgram_Tb_Id).empty().append($(Chase_Tr_Str)); 
                //合计追号的金额金额
                _This.Total_Chasr_ProgramMoney(Count_ChaseProgramMoney);
            }
        }, 
        /**
        * @description 合计追号的金额金额
        * @extends {Ruiec_GameBet}  
        * @param {JSON} Count_ChaseProgramMoney 统计金额
        */
        Total_Chasr_ProgramMoney: function (Count_ChaseProgramMoney) {
            if (Count_ChaseProgramMoney != undefined) {
                //存在统计数据  则不再进行统计
                $("#" + _Option.BettingType_Container_Id).find("#f_trace_statistics_times").empty().text(Count_ChaseProgramMoney.ChaseLength);
                $("#" + _Option.BettingType_Container_Id).find("#f_trace_statistics_lotterys_num").empty().text(Count_ChaseProgramMoney.ChaseBettingLength);
                $("#" + _Option.BettingType_Container_Id).find("#f_trace_statistics_amount").empty().text(Count_ChaseProgramMoney.ChaseTotalMoney);

            } else {
                //console.log(_Option);

                var ChaseLength = 0, ChaseBetting_Length = 0 , ChaseTotalMoney = 0;
                var oBettingLen = $("#" + _Option.ToTal_ChoiceNote_El_Id).text(); //合计注数; 
                var _TheIndex = $("#" + _Option.BettingType_Container_Id).find(".chase_list_tit li.curr").index();
                oBettingLen = isNaN(Number(oBettingLen)) ? 0 : parseInt(oBettingLen);
                //遍历所有行
                $("#" + _Option.ChaseProgram_Tb_Id).find("tr").each(function () { 
                    if ($(this).find(".chase_row_checked").eq(0).is(":checked") || _TheIndex!=0) {
                        var _theValue = $(this).find(".chase_row_money").eq(0).text();  //金额 
                        _theValue = isNaN(Number(_theValue)) ? 0 : Number(_theValue);
                        ChaseLength++;
                        ChaseTotalMoney += _theValue;
                        ChaseBetting_Length += oBettingLen;
                    } 
                });
                
                $("#" + _Option.BettingType_Container_Id).find("#f_trace_statistics_times").empty().text(ChaseLength);
                $("#" + _Option.BettingType_Container_Id).find("#f_trace_statistics_lotterys_num").empty().text(ChaseBetting_Length);
                $("#" + _Option.BettingType_Container_Id).find("#f_trace_statistics_amount").empty().text(ChaseTotalMoney);
            }
        },
        /**
        * @description 处理高级追号的相关事件
        * @extends {Ruiec_GameBet}
        * @param {Number} Chase_len 长度
        */
        Advanced_Chase_ProgramFn: function () {

            //1、高级追号的选择框事件处理
            $("#" + _Option.Chase_ProgramContId + " .high-parameter .tab_tit h3").unbind('click').click(function () {
                var _theIndex = $(this).index();
                $(this).addClass("curr").siblings().removeClass('curr');
                $("#" + _Option.Chase_ProgramContId + " .high-parameter .item").eq(_theIndex).addClass("curr").siblings().removeClass('curr');
            })

            //2、分段倍数与，分隔递增的倍数
            $("#" + _Option.Chase_ProgramContId + " .high-parameter .item input.inp").click(function () {
                
                $(this).parent().siblings().children("input[type!='radio']").attr("disabled", true);
                $(this).parent().children("input[type!='radio']").removeAttr("disabled"); 
            });
            
            //3、遍历生成临时最大的 追号信息
            var Max_Chase_Program_List = {}, start = false, start_key = 0, max_chase = 0 , Chase_Program_list_Arry = []; //期号时间表对象
            var Lottery_OpenTimeList = _Option.Lottery_OpenTimeList, BettingIssue = _Option.BettingIssue; //期号时间表，最新一期的投注期号
            var oAmount = $("#" + _Option.ToTal_ChoiceNotePrice_El_Id).text(); //合计金额
            var oBettingLen = $("#" + _Option.ToTal_ChoiceNote_El_Id).text(); //合计注数
            $("#" + _Option.Chase_ProgramContId + " .base-parameter #gjzh_begin").empty();
            //4、遍历追号时间表，创建新的时间表对象
            for (var i = 0 ; i < Lottery_OpenTimeList.length; i++) {
                if (Lottery_OpenTimeList[i].newIssue == BettingIssue) {
                    start = true;
                    start_key = i;
                };
                if (start && max_chase < 300) {
                    //最多追号300期
                    max_chase++;

                    var TheObj_Str = {};
                    TheObj_Str.oAmountS = oAmount;  //金额
                    TheObj_BettingLen = oBettingLen; //注数
                    TheObj_Str.oMultiple = 1;  //倍数
                    TheObj_Str.oIssues = Lottery_OpenTimeList[i].newIssue ;  //期号
                    TheObj_Str.oBeginTime = Lottery_OpenTimeList[i].newBeginDate;//开奖时间

                    Chase_Program_list_Arry.push(TheObj_Str);
                    if (max_chase==1) {
                        var OptionStr = "<option value='" + Lottery_OpenTimeList[i].newIssue + "'>" + Lottery_OpenTimeList[i].newIssue + "(<i class='c_red'>当前期</i>)</option>";
                    } else {
                        var OptionStr = "<option value='" + Lottery_OpenTimeList[i].newIssue + "'>" + Lottery_OpenTimeList[i].newIssue + "</option>";
                    } 
                    $("#" + _Option.Chase_ProgramContId + " .base-parameter #gjzh_begin").append($(OptionStr));
                } 
            }

            //5、更新追号列表
            Max_Chase_Program_List.InitAmount = oAmount;
            Max_Chase_Program_List.InitBettingLen = oBettingLen;
            Max_Chase_Program_List.Chase_ListDate = Chase_Program_list_Arry;
            Max_Chase_Program_List.Max_Len = Chase_Program_list_Arry.length;
            if (Max_Chase_Program_List.Max_Len > 300) { Max_Chase_Program_List.Max_Len = 300 } 
            $("#" + _Option.Chase_ProgramContId + " .base-parameter .h_qi_text").empty().text(Chase_Program_list_Arry.length);

            //6、处理追号的起始期号发生变化所触发的事件
            $("#" + _Option.Chase_ProgramContId + " .base-parameter #gjzh_begin").change(function () {
                var _theIndex = $(this).find("option:checked").index();
                var _Max_ProgramValue = Max_Chase_Program_List.Max_Len - _theIndex;
                $("#" + _Option.Chase_ProgramContId + " .base-parameter .h_qi_text").empty().text(_Max_ProgramValue); 
            });

            //7、设定最大追期数
            $("#" + _Option.Chase_ProgramContId + " .base-parameter .h_qi").change(function () {
                var _theMax_Value = $("#" + _Option.Chase_ProgramContId + " .base-parameter .h_qi_text").text();
                _theMax_Value = isNaN(Number(_theMax_Value)) ? 10 : parseInt(Number(_theMax_Value)); 
                var _theValue = $(this).val();
                if (_theValue > _theMax_Value) {
                    $(this).val(_theMax_Value);
                } 
            });

            var Advanced_Chase_Data = {}; //高级追号的基本内容

            //8、点击生成高级追号列表
            $("#" + _Option.Chase_ProgramContId + "  #gjzh_sc").unbind("click").click(function () {
                //统计高级追号的详细信息
                var Advanced_Chase_Data = _This.GetAdvanced_Chase_DetailData(Max_Chase_Program_List);
                //根据高级追号的规则，生成追号计划
                _This.CreatAdvanced_Chase_Html(Advanced_Chase_Data); 
            }); 
        },
        /**
        * @description 获取追号列表的详情数据
        * @extends {Ruiec_GameBet}  
        */
        GetAdvanced_Chase_DetailData: function (Max_Chase_Program_List) {
            var Advanced_Chase_Data = {};
            var _Start_Chase_Issue = $("#" + _Option.Chase_ProgramContId + " .base-parameter #gjzh_begin").val(); //起始追号的期号
            var _Start_Chase_Issue_Index = $("#" + _Option.Chase_ProgramContId + " .base-parameter #gjzh_begin").find("option:checked").index(); //起始追号的索引 【距离当前期】
            var _Chase_Issue_Len = $("#" + _Option.Chase_ProgramContId + " .base-parameter .h_qi").val(); //追多少期 
            var _Chase_Start_Multiple = $("#" + _Option.Chase_ProgramContId + " #gjzh_bei").val(); //起始倍数
            var _Advanced_Infos = $("#" + _Option.Chase_ProgramContId + " .high-parameter .tab_tit h3.curr").index();
            var _Double_track = {}; //是否为翻倍追号
            var _Profit_amount_track = {}; //是否为盈利金额追号
            var _Profit_rate_track = {}; //是否为盈利率追号
            var _Advanced_Obj = [];
            switch (_Advanced_Infos) {
                case 2:
                    _Double_track.state = false;
                    _Profit_amount_track.state = false;
                    _Profit_rate_track.state = true;

                    _Profit_rate_track.plan = $("#" + _Option.Chase_ProgramContId + " .high-parameter .item:eq(2) input.inp:checked").parent().index();
                    _Profit_rate_track.minRate = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan5_tj1").val(); //预期盈利率≥多少时 

                    _Profit_rate_track.PrevQiShu = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan6_tj1").val(); //前多少期数
                    _Profit_rate_track.OwnRate = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan6_tj2").val(); //前多少期数，盈利金额
                    _Profit_rate_track.AfterOwnRate = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan6_tj3").val(); //之后预期盈利金额

                    break;
                case 1:
                    _Double_track.state = false;
                    _Profit_amount_track.state = true;
                    _Profit_rate_track.state = false;

                    _Profit_amount_track.plan = $("#" + _Option.Chase_ProgramContId + " .high-parameter .item:eq(1) input.inp:checked").parent().index();
                    _Profit_amount_track.minPrice = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan3_tj1").val(); //预期盈利金额≥多少时 

                    _Profit_amount_track.PrevQiShu = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan4_tj1").val(); //前多少期数
                    _Profit_amount_track.OwnMoney = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan4_tj2").val(); //前多少期数，盈利金额
                    _Profit_amount_track.AfterOwnMoney = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan4_tj3").val(); //之后预期盈利金额

                    break;
                case 0:
                default:
                    _Double_track.state = true;
                    _Profit_amount_track.state = false;
                    _Profit_rate_track.state = false;

                    _Double_track.plan = $("#" + _Option.Chase_ProgramContId + " .high-parameter .item:eq(0) input.inp:checked").parent().index();
                    _Double_track.eachJiange = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan1_ge").val(); //每个间隔
                    _Double_track.eachBeishu = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan1_bei").val(); //每个间隔

                    _Double_track.PrevBeishu = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan2_ge").val(); //前多少期按起始倍数
                    _Double_track.AfterBeishu = $("#" + _Option.Chase_ProgramContId + " #gjzh_plan2_bei").val(); //后的多少倍数

                    break;
            }
            _Advanced_Obj.push(_Double_track);
            _Advanced_Obj.push(_Profit_amount_track);
            _Advanced_Obj.push(_Profit_rate_track);


            Advanced_Chase_Data.Start_Chase_Issue = _Start_Chase_Issue;
            Advanced_Chase_Data.Start_Chase_Issue_Index = _Start_Chase_Issue_Index;
            Advanced_Chase_Data.Chase_Issue_Len = _Chase_Issue_Len;
            Advanced_Chase_Data.Chase_Start_Multiple = _Chase_Start_Multiple;
            Advanced_Chase_Data._Advanced_Infos = _Advanced_Obj;
            Advanced_Chase_Data.Max_Chase_Program_List = Max_Chase_Program_List;
            return Advanced_Chase_Data;
        },
        /**
        * @description 生成追号计划
        * @extends {Ruiec_GameBet}  
        */
        CreatAdvanced_Chase_Html: function (Advanced_Chase_Data) {
            //var Advanced_Chase_Infos = {}; 
            var _Chase_len = Advanced_Chase_Data.Chase_Issue_Len; //追多少期
            var _Chase_Start_Beishu = Advanced_Chase_Data.Chase_Start_Multiple; //追号的起始倍数 
            var _Chase_Start_Index = Advanced_Chase_Data.Start_Chase_Issue_Index; //开始追号的索引
            var _Chase_key = 0;

            var _Advanced_Index = $("#" + _Option.Chase_ProgramContId + " .high-parameter .tab_tit h3.curr").index() == undefined ? 0 : $("#" + _Option.Chase_ProgramContId + " .high-parameter .tab_tit h3.curr").index();
             
            
            var Chase_Tr_Str = "";
            for (var i = 0 , key = 0 ; i < _Chase_len ; i++) {

                _Chase_key++;

                var _StartIndex = Number(_Chase_Start_Index) + i;
                _StartIndex = isNaN(parseInt(_StartIndex)) ? 0 : parseInt(_StartIndex);
                var oNextIssue = Advanced_Chase_Data.Max_Chase_Program_List.Chase_ListDate[_StartIndex].oIssues; //期号

                var Each_oAmountS = Advanced_Chase_Data.Max_Chase_Program_List.InitAmount; //每个方案的初始金额
                var Each_oBettingLen = Advanced_Chase_Data.Max_Chase_Program_List.InitBettingLen; //投注长度


                if (_Advanced_Index == 0) {

                    if (Advanced_Chase_Data._Advanced_Infos[0].plan) {
                        //按期追号
                        if (i < Advanced_Chase_Data._Advanced_Infos[0].PrevBeishu) {
                            var oMultiple = Advanced_Chase_Data.Chase_Start_Multiple; //起始倍数 
                        } else {
                            var oMultiple = Advanced_Chase_Data._Advanced_Infos[0].AfterBeishu; //之后的倍数
                            oMultiple = isNaN(parseInt(oMultiple)) ? Advanced_Chase_Data.Chase_Start_Multiple : parseInt(oMultiple); //按规则改变倍数
                        } 

                        if (oMultiple > 9999) {
                            oMultiple = 9999;
                        }

                    } else {
                        //按倍追号
                        var _EachJianGe = Advanced_Chase_Data._Advanced_Infos[0].eachJiange; //每间隔多少次
                        var _EachBeishu = Advanced_Chase_Data._Advanced_Infos[0].eachBeishu; //倍数
                        _EachBeishu = parseInt(_EachBeishu);
                        var _JianGe_len = parseInt(i / _EachJianGe); 

                        var _Double_Value = Math.pow(_EachBeishu, _JianGe_len);


                        var oMultiple = Advanced_Chase_Data.Chase_Start_Multiple; //起始倍数 

                        oMultiple = oMultiple * _Double_Value;
                        if (oMultiple > 9999) {
                            oMultiple = 9999;
                        } 
                    } 
                } else {
                    var oMultiple = Advanced_Chase_Data.Chase_Start_Multiple; //起始倍数 
                } 
                 
                var oAmountS = oMultiple * Each_oAmountS;
                var oBeginTime = Advanced_Chase_Data.Max_Chase_Program_List.Chase_ListDate[_StartIndex].oBeginTime; //时间  
                var strVar = "";
                strVar += "<tr class='advanced'>";
                strVar += "     <td class='key'>" + _Chase_key + "<\/td>"; //序号
                strVar += "     <td class='issue'>"; 
                strVar += "         <span class=\"chase_row_number\" issuecode=" + oNextIssue + ">" + oNextIssue + "<\/span>";
                strVar += "     <\/td>";
                strVar += "     <td class='multiple'>";
                strVar += "         <input class=\"ty_text onlyNum chase_row_multiple\" disabled='disabled' value=\"" + oMultiple + "\" type=\"text\" />倍";
                strVar += "     <\/td>";
                strVar += "     <td class='money'>";
                strVar += "         <span class=\"price\"><em>¥<\/em><span class=\"chase_row_money\">" + oAmountS + "<\/span> 元<\/span>";
                strVar += "     <\/td>";
                strVar += "     <td class='time'>";
                strVar += "         <span class=\"chase_row_time\">" + oBeginTime + "<\/span>";
                strVar += "     <\/td>";
                strVar += "<\/tr>";
                Chase_Tr_Str = Chase_Tr_Str + strVar; 

            }

            if (Chase_Tr_Str != "") {
                $("#" + _Option.ChaseProgram_Tb_Id).empty().append($(Chase_Tr_Str));
                //合计追号的金额金额
                _This.Total_Chasr_ProgramMoney();
            } 

            return true;
        },
        /**
        * @description 绑定当前彩种的合买事件
        * @extends {Ruiec_GameBet}  
        */
        Bind_With_BuyFn: function () {
            console.log("绑定当前玩法的合买效果");

            var Bind_With_BuyContId = $("#" + _Option.ChoiceBettingType_El_Id).find("input:checked").attr("relation_cont_id");  //追号显示区域的id
            _Option.Bind_With_BuyContId = Bind_With_BuyContId;

            var _BettingMoney = $("#" + _Option.ToTal_ChoiceNotePrice_El_Id).text(); //方案总金额
            _BettingMoney = Number(_BettingMoney);
             
            var _Each_Len = _BettingMoney / 0.2;
            $("#" + Bind_With_BuyContId + " #hemai_fen").val(_Each_Len);

            $("#" + Bind_With_BuyContId + " #EachMoney").empty().text("0.2");

            //1、绑定分成多少份的事件
            $("#" + Bind_With_BuyContId + " #hemai_fen").keyup(function () {
                var _theValue = $(this).val();
                _theValue = _theValue.replace(/[^\d]/g, "");
                //$(this).val(_theValue);

            }).blur(function () {

                var _theValue = $(this).val();
                var _theEachPrice = _BettingMoney / _theValue;
                if (_theEachPrice < 0.2) {
                    $(this).val(_Each_Len);
                    $("#" + Bind_With_BuyContId + " #EachMoney").empty().text("0.2");
                } else {
                    var _theString = _theEachPrice.toString();
                    if (_theString.indexOf(".") > 0) {
                        var _theXiaoShu = _theString.split(".")[1];
                        if (_theXiaoShu > 3) {
                            $(this).val(_theValue);
                            $("#" + Bind_With_BuyContId + " #EachMoney").empty().text("0.2");
                        } else { 
                            $("#" + Bind_With_BuyContId + " #EachMoney").empty().text(_theEachPrice);
                        }
                    } else {   
                        $("#" + Bind_With_BuyContId + " #EachMoney").empty().text(_theEachPrice);
                    }
                }  
            })

            //2、个人认购金额
            $("#" + Bind_With_BuyContId + " #hemai_rengou").keyup(function () {

                var _theValue = $(this).val();
                _theValue = _theValue.replace(/[^\d]/g, "");
                var _Max_Value = $("#" + Bind_With_BuyContId + " #hemai_fen").val();
                if (_theValue < _Max_Value) {
                    $(this).val(_theValue);
                } else {
                    $(this).val(_Max_Value);
                }

                var _EachValue = $("#" + Bind_With_BuyContId + " #EachMoney").text();
                _EachValue = isNaN(Number(_EachValue)) ? 0.2 : Number(_EachValue); 
                var _theNeedPay = _theValue * _EachValue;

                _theNeedPay = parseFloat(_theNeedPay).toFixed(3);

                $("#" + Bind_With_BuyContId + " #createrBuyMoney").empty().text(_theNeedPay);

            }).blur(function () {

                var _theValue = $(this).val();
                var _EachValue = $("#" + Bind_With_BuyContId + " #EachMoney").text();
                _EachValue = isNaN(Number(_EachValue)) ? 0.2 : Number(_EachValue);

                var _theNeedPay = _theValue * _EachValue;
                _theNeedPay = parseFloat(_theNeedPay).toFixed(3);
                $("#" + Bind_With_BuyContId + " #createrBuyMoney").empty().text(_theNeedPay); 
                $("#" + Bind_With_BuyContId + " #hemai_count").empty().text(_theNeedPay);
            });

             

        },
        /**
        * @description 单挑模式，限制每个方案中，每个玩法的最大投注数量 
        */
        Check_MaxBettingNumber: function () {

            var _CheckContainer = $("#order_table"); //方案区域
            var _Project_Array = new Array();  //方案中的玩法数组
            var _Result = [];

            //遍历方案区域有多少中玩法
            _CheckContainer.find("tr").each(function () { 
                var _Each_PlayCode = $(this).attr("order_play_code");  //获取每一行的玩法
                if (_Project_Array.length > 0) { 
                    var _theStr_InArray = _GameBetobj.CheckStrInArray(_Each_PlayCode, _Project_Array);
                    if (!_theStr_InArray) {
                        _Project_Array.push(_Each_PlayCode);
                    } 
                } else {
                    _Project_Array.push(_Each_PlayCode);
                } 
            });

            //统计每一个玩法的投注总量
            for (var i = 0 ; i < _Project_Array.length ; i++) {
                
                var _Max_BettingNumb = $("#j_play_select dd[lottery_code='" + _Project_Array[i] + "']").attr("maxbetting_number");
                var _The_BettingNumb = 0, TheLineOjb = {} , TheBettingName = "";

                _Max_BettingNumb = isNaN(Number(_Max_BettingNumb)) ? 1000000 : Number(_Max_BettingNumb); //最大投注数量 
                _CheckContainer.find("tr[order_play_code='" + _Project_Array[i] + "']").each(function () {
                    var _ThisBetting_Numb = isNaN(parseInt($(this).find(".order_num").text())) ? 0 : Number($(this).find(".order_num").text());
                    _The_BettingNumb += _ThisBetting_Numb;
                    TheBettingName = $(this).find(".order_type").text().split("]")[0].replace(/[\[]/g,"");
                    //console.log(TheBettingName);
                });

                if (_The_BettingNumb > _Max_BettingNumb) {
                    TheLineOjb.playCode = _Project_Array[i];
                    TheLineOjb.playCodeName = TheBettingName;
                    TheLineOjb.playCodeNumb = _The_BettingNumb;
                    TheLineOjb.MaxPlayNumb = _Max_BettingNumb; 
                    _Result.push(TheLineOjb);
                } 
            }

            return _Result;
        },
        /**
        * @description 普通投注、追号投注、合买投注  
        */
        Blind_Betting_Fn:function(){
            
            $("#" + _Option.Betting_Sub_BtnId).click(function () { 
                if (parseFloat($("#" + _Option.ToTal_ChoiceNotePrice_El_Id).text()) > 0 && $("#" + _Option.ChoiceInfoListCont_TB_Id + " tr").size() > 0) {
                     
                    var _TZ_model = $("#" + _Option.ChoiceBettingType_El_Id).find("input:checked").val(); //自购、追号、合买

                    _TZ_model = _TZ_model || 0;

                    //点击投注：生成投注订单
                    switch (_TZ_model) {
                        case 0:
                        case "0": //普通投注 
                            //普通投注
                            _This.Confrim_BettingInfos(_TZ_model);  //提交
                            break;
                        case 1:
                        case "1":
                            //追号 
                            _This.Confrim_ChaseBettingInfos(_TZ_model); //提交
                            break;
                        case 2:
                        case "2": 
                            //合买
                            _This.Confrim_WithBuyBettingInfos(_TZ_model);  //提交
                            break;
                        case 3:
                        case "3":
                            //其他
                            _This.Confrim_BettingInfos(_TZ_model);  //提交
                            break;
                        default: 
                            break;
                    }
                } else {
                    Ruiec_Fn.alert("请至少选择一注投注号码","CountDown", 3);
                } 
            });  
        },
        /**
        * @description 普通投注的投注信息
        */
        Confrim_BettingInfos:function(){
            var _this = this;
            var theAction = "AddBetting", statesub = true;
            var _btnObj = $("#" + _Option.Betting_Sub_BtnId);
            var _Confirm_Html = _This.Confrim_Betting_Infos_Str();
            
            //确认投注信息后的操作
            function Sub_Betting_Dialog(){
                var _OrderContainer = $("#" + _Option.ChoiceInfoListCont_TB_Id); //临时方案列表区域

                //获取投注列表的统计数据
                var theDatas = _This.GetTzOrderInfos(_OrderContainer, statesub); //获取投注列表的数据

                var theData = theDatas.Bettings;
                statesub = theDatas.statesub;

                if (typeof theData == "object" && theData.length > 0 && theAction != "") {
                    var NewTzObj = {};
                    NewTzObj.BettingData = theData;

                    var theStringData = Ruiec_Fn.Json_To_String(NewTzObj);

                    _btnObj.attr("state", "false");


                    var _TheUrl = _Option.Common_Ajax_Api + "?action=" + theAction;
                    var _BettingData = { action: theAction, data: theStringData };
                    
                    //投注信息提交后，程序给予的返回值处理
                    function BettingSuccess(data){
                        if (data && data.Code == "1") { 
                           console.log($("#j_lottery_time").text());
                            artDialog({
                                content: "投注成功!",
                                icon: "success",
                                lock: true,
                                ok: function () {
                                    $("html,body").animate({ "scrollTop": "0px" });
                                },
                                close: function () {
                                    $("html,body").animate({ "scrollTop": "0px" });
                                },
                            })
                            _btnObj.attr("state", "true");

                            $("#" + _Option.ChoiceInfoListCont_TB_Id).empty();

                            //清除投注信息
                            _This.ruiec_clearBettingInfos();
                            //更新投注方案
                            _This.ruiec_getMyProject();

                            $("#continue_choice").trigger("click");
                            //更新金额
                            $("#get_money .iconfont").trigger("click");

                        } else {
                            artDialog({
                                content: "投注失败,原因：" + data.StrCode,
                                icon: "waring",
                                lock: true,
                                ok: function () {
                                    $("html,body").animate({ "scrollTop": "0px" });
                                },
                                close: function () {
                                    $("html,body").animate({ "scrollTop": "0px" });
                                },
                            })

                            _btnObj.attr("state", "true");
                        }
                    }

                    //投注信息提交
                    Ruiec_Fn.RAjax("POST", _TheUrl, _BettingData, "json", BettingSuccess); 
                }
            }

            //投注信息确认
            //Ruiec_Fn.alert(_Confirm_Html, "SureInfo", Sub_Betting_Dialog);

            Sub_Betting_Dialog();
        },
        /**
        * @description 生成确认投注信息的内容html结构 
        */ 
        Confrim_Betting_Infos_Str: function () {
          
            var Lottery_Code = _Option.lotteryCode;
            var comfire_tit = _This.get_olotteryName(Lottery_Code); //获取彩种名称 
            var comfire_first_item = $("#" + _Option.CurrentBettingIssue_El_Id).text(); //获取投注的期号 
            var TheSubModel = $("#"+_Option.ChoiceBettingType_El_Id).find("input:checked").val(); //自购、追号、合买

            var comfire_amount = $("#" + _Option.ToTal_ChoiceNotePrice_El_Id).text(); //投注总额

            //判断是追号投注还是普通投注还是合买投注
            if (TheSubModel==1) {
                var comfire_last_item = $("#" + _Option.ChaseProgram_Tb_Id + " tr").last().find(".chase_row_number").attr("issuecode"); //追号最后一期的期号 
                var comfire_qi = $("#" + _Option.BettingType_Container_Id).find("#f_trace_statistics_times").text(); //共追号多少期
                var comfire_amount = $("#" + _Option.BettingType_Container_Id).find("#f_trace_statistics_amount").text(); //追号投注总额 
            }
              
             
            var comfire_order = "";
            var comfire_user = $("#userName").text() == undefined ? "" : $("#userName").text(); //用户名
            var Max_Values = $("#EachMaxLotteryValue").val() == undefined ? 200000 : $("#EachMaxLotteryValue").val(); //最高奖金

            for (a = 0; a < $("#" + _Option.ChoiceInfoListCont_TB_Id + " tr").size() ; a++) {
                var comfire_order_item = "<p>" + $("#" + _Option.ChoiceInfoListCont_TB_Id + " tr").eq(a).find(".order_type").text() + "</p>";
                comfire_order = comfire_order + comfire_order_item;
            };

            var strVar = "";
            strVar += "<div class=\"submitComfire\">";
            strVar += " <ul class=\"ui-form\">";
            strVar += "     <li><label for=\"question1\" class=\"ui-label\">彩种：<\/label><span class=\"ui-text-info\">" + comfire_tit + "<\/span><\/li>";
            if (TheSubModel == 1) { 
                strVar += "     <li><label for=\"question1\" class=\"ui-label\">期号：<\/label><span class=\"ui-text-info\">第" + comfire_first_item + " 期到" + comfire_last_item + "之间，共" + comfire_qi + "期<\/li>";
            } else { 
                strVar += "     <li><label for=\"question1\" class=\"ui-label\">期号：<\/label><span class=\"ui-text-info\">第" + comfire_first_item + " 期<\/li>";
            } 
            strVar += "     <li><label for=\"answer1\" class=\"ui-label\">详情：<\/label>";
            strVar += "     <div class=\"textarea\" style=\"font-size:12px;\">";
            strVar +=           comfire_order;
            strVar += "     <\/div>";
            strVar += "     <\/li>";
            strVar += "     <li><label for=\"question2\" class=\"ui-label\">付款总金额：<\/label><span class=\"ui-text-info\"><span class=\"c_red\">" + comfire_amount + "<\/span>元<\/span><\/li>";
            if (comfire_user != "") { 
                strVar += "     <li><label for=\"question2\" class=\"ui-label\">付款帐号：<\/label><span class=\"ui-text-info\"><span class=\"c_red\">" + comfire_user + "<\/span><\/span><\/li>";
            } 
            strVar += "     <li><label for=\"question2\" class=\"ui-label\">温馨提示：本平台每单最高奖金限额<i class='c_red'>" + Max_Values + "</i>元，请会员谨慎投注！<\/li>";
            strVar += " <\/ul>";
            strVar += " <p class=\"text-note\">";
            strVar += " <\/p>";
            strVar += " <p class=\"text-note\">";
            strVar += " <\/p>";
            strVar += "<\/div>";

            return strVar;
        },
        /**
        * @description 统计投注列表的数据 
        */
        GetTzOrderInfos: function (_OrderContainer, statesub) {

            statesub = statesub || true; //扩展预留

            var _this = this;
            var theObjs = {};
            var theData = new Array;
            var _ThisLotteryCode = $("#" + _Option.CurrentBettingIssue_El_Id).text() == undefined ? "20150808" : $("#" + _Option.CurrentBettingIssue_El_Id).text();  //期号   

            //var _Line_Lottery_code = _Line_Lottery_code.split("_")[2] == undefined ? 1000 : _Line_Lottery_code.split("_")[2]; //彩种玩法编码
            var _Line_Lottery_code = _This.ruiec_returnLottery(); //彩种玩法编码

            //遍历每一行
            _OrderContainer.find("tr").each(function () {
                var _TrObj = {};
                var _theTrObj = $(this); //当前行 
                //var _Line_Lottery_code = _theTrObj.attr("order_type_code");  //彩种编码+彩种玩法编码 

                var _Line_play_detail_code = _theTrObj.attr("order_play_code");  //玩法编码
                var _Line_betting_issuseNo = _ThisLotteryCode; //期号
                var _Line_betting_number = _theTrObj.attr("order_code"); //投注号码
                var _Line_betting_count = Number(_theTrObj.find(".order_num").eq(0).text()); //投注的注数
                var _Line_graduation_count = Number(_theTrObj.find(".order_multiple").eq(0).text());  //投注的倍数
                var _Line_betting_money = Number(_theTrObj.find(".order_money").eq(0).text());  //投注的金额
                var _Line_betting_point = _theTrObj.find(".order_fandian").eq(0).text(); //返点 
                var _Line_betting_model = isNaN(Number(_theTrObj.find(".order_unit").eq(0).attr("unit_num"))) ? 1 : Number(_theTrObj.find(".order_unit").eq(0).attr("unit_num")); //单位

                _TrObj.lottery_code = _Line_Lottery_code;
                _TrObj.play_detail_code = _Line_play_detail_code;
                _TrObj.betting_issuseNo = _Line_betting_issuseNo;
                _TrObj.betting_number = _Line_betting_number;
                _TrObj.betting_count = _Line_betting_count;
                _TrObj.graduation_count = 1;
                _TrObj.betting_money = _Line_betting_money;
                _TrObj.betting_point = "0-0.0";
                _TrObj.betting_model = 1;

                _TrObj.betting_number = _TrObj.betting_number;
                theData.push(_TrObj);
            });
            theObjs.statesub = statesub;
            theObjs.Bettings = theData;
            return theObjs;
        },
        /**
        * @description 追号投注
        */
        Confrim_ChaseBettingInfos: function () {
            var _this = this;
            var theAction = "AddBetting", statesub = true;
            var _btnObj = $("#" + _Option.Betting_Sub_BtnId);
            var _Confirm_Html = _This.Confrim_Betting_Infos_Str();
              
            //投注信息确认
            Ruiec_Fn.alert(_Confirm_Html, "SureInfo", _This.Sub_ChaseBetting_Dialog);
 
        },
        /**
        * @description 追号投注,AJAX提交
        */
        Sub_ChaseBetting_Dialog: function () {

            var oData = {};
            var oAjaxData = {};
            var betting = []; //订单数据
            var shceme = []; //追号方案
            var zCheckIndex = $("#" + _Option.BettingType_Container_Id + " .chase_list_tit ul li.curr").index();  //0为普通追号，1为高级追号
            var orderList = $("#"+_Option.ChoiceInfoListCont_TB_Id+" tr");  //订单列表
            var zhuihaoList = $("#" + _Option.BettingType_Container_Id + " #f_chase_table tr"); //追号列表 

            var lotteryCode = _This.ruiec_returnLottery();
            oData.before_eamings_cash = -1;  //前多少期盈利金额 
            oData.before_issueNo = -1;  //前多少期
            oData.after_eamings_cash = -1;  //后多少期盈利金额
            oData.before_earnings_rate = -1;  //前多少期盈利率 
            oData.after_earnings_rate = -1;  //后多少期盈利率  

            //高级追号
            if (zCheckIndex != 0) {

                //盈利金额追号第二个选中
                if ($("#" + _Option.BettingType_Container_Id + " #gjzh_plan2_ge").siblings(".inp").prop("checked") == true) {
                    oData.before_issueNo = parseInt($("#" + _Option.BettingType_Container_Id + " #gjzh_plan2_ge").val());
                };
                //盈利金额追号第二个选中
                if ($("#" + _Option.BettingType_Container_Id + " #gjzh_plan4_tj1").siblings(".inp").prop("checked") == true) {
                    oData.before_issueNo = parseInt($("#" + _Option.BettingType_Container_Id + " #gjzh_plan4_tj1").val());
                    oData.before_eamings_cash = parseFloat($("#" + _Option.BettingType_Container_Id + " #gjzh_plan4_tj2").val());
                    oData.after_eamings_cash = parseFloat($("#" + _Option.BettingType_Container_Id + " #gjzh_plan4_tj3").val());
                };
                //盈利率追号第二个选中
                if ($("#" + _Option.BettingType_Container_Id + " #gjzh_plan6_tj1").siblings(".inp").prop("checked") == true) {
                    oData.before_issueNo = parseInt($("#" + _Option.BettingType_Container_Id + " #gjzh_plan6_tj1").val());
                    oData.before_earnings_rate = parseFloat($("#" + _Option.BettingType_Container_Id + " #gjzh_plan6_tj2").val());
                    oData.after_earnings_rate = parseFloat($("#" + _Option.BettingType_Container_Id + " #gjzh_plan6_tj3").val());
                };
            }; 
           
            for (var a = 0; a < orderList.size() ; a++) {

                var chase_betting_item = {};  //订单数据单个

                chase_betting_item.lottery_code = lotteryCode;  //彩票代码

                chase_betting_item.play_detail_code = orderList.eq(a).attr("order_play_code");   //详细玩法代码
                chase_betting_item.betting_number = orderList.eq(a).attr("order_code");   //投注号码
                chase_betting_item.betting_money = parseFloat(orderList.eq(a).find(".each_price").val());   //投注金额

                chase_betting_item.betting_money = isNaN(chase_betting_item.betting_money) ? 0 : chase_betting_item.betting_money;

                chase_betting_item.betting_count = parseInt(orderList.eq(a).find(".order_num").text());   //投注的注数
                chase_betting_item.betting_point = "0-0.0";   //投注的返点
                chase_betting_item.betting_model = 1 ;   //投注模式
                betting[a] = (chase_betting_item);

            };

            oData.start_issueNo = 0 ;  //追号起始期号 
            for (var b = 0; b < zhuihaoList.size() ; b++) {
                var chase_shceme_item = {}; //追号方案单个
                if (zhuihaoList.eq(b).find(".chase_row_checked").prop("checked") == true) {
                    
                    chase_shceme_item.issueNo = zhuihaoList.eq(b).find(".chase_row_number").attr("issuecode");  //期号

                    if (oData.start_issueNo == 0) {
                        //第一期追号的期号
                        oData.start_issueNo = chase_shceme_item.issueNo;
                    }

                    chase_shceme_item.graduation_count = 1;  //倍数
                    chase_shceme_item.money = parseFloat(zhuihaoList.eq(b).find(".chase_row_money").text());   //期号金额
                    shceme[b] = (chase_shceme_item);
                };
            };

            if ($("#f_trace_iswintimesstop").prop("checked") == true) {
                oData.isstop_afterwinning = 1;  //是否停止追号
            } else {
                oData.isstop_afterwinning = 0;  //是否停止追号
            };

            

            oData.lottery_code = lotteryCode;  //彩票代码
            oData.chase_money = $("#" + _Option.BettingType_Container_Id).find("#f_trace_statistics_amount").text(); //追号金额
            oData.buy_count = $("#" + _Option.BettingType_Container_Id).find("#f_trace_statistics_times").text();   //购买的总期数

            oData.chase_money = isNaN(Number(oData.chase_money)) ? 0 :  Number(oData.chase_money);
            oData.buy_count = isNaN(Number(oData.buy_count)) ? 0 : parseInt(Number(oData.buy_count));

            oData.betting = betting;  //订单数据
            oData.shceme = shceme;  //追号方案  

            if(oData.chase_money==0||oData.buy_count==0){
                Ruiec_Fn.alert("追号信息有误", "CountDown", 3);
                return false; 
            }else{ 
                oData = Ruiec_Fn.Json_To_String(oData);
                
                var _PostUrl = _Option.Common_Ajax_Api + "?action=AddChaseBetting";
                var _PostData = { "action": "AddChaseBetting", "data": oData };
                //console.log(_PostData);
                Ruiec_Fn.RAjax("POST", _PostUrl, _PostData, "JSON", _This.Chase_BettingSuccess);
            }
        },
        /**
        * @description 追号投注,AJAX提交--------回调函数
        */
        Chase_BettingSuccess: function (data) { 

            $("#" + _Option.ChoiceInfoListCont_TB_Id).empty();

            artDialog({
                icon: "success",
                content: data.StrCode,
                lock: "true",
                ok: function () {
                    $("html,body").animate({ "scrollTop": "0px" });

                    //选择我要自购
                    $("#" + _Option.ChoiceBettingType_El_Id + " input[name='rad'][value='0']").trigger("click");

                    //清除投注信息
                    _This.ruiec_clearBettingInfos();

                    //更新投注方案
                    _This.ruiec_getMyProject();

                    $("#continue_choice").trigger("click");
                    //更新金额
                    $("#get_money .iconfont").trigger("click");
                },
                close: function () {
                    $("html,body").animate({ "scrollTop": "0px" });

                    //选择我要自购
                    $("#" + _Option.ChoiceBettingType_El_Id + " input[name='rad'][value='0']").trigger("click");

                    //清除投注信息
                    _This.ruiec_clearBettingInfos();

                    //更新投注方案
                    _This.ruiec_getMyProject();

                    $("#continue_choice").trigger("click");
                    //更新金额
                    $("#get_money .iconfont").trigger("click");
                }
            }); 
        },
        /**
        * @description 合买投注
        */
        Confrim_WithBuyBettingInfos: function () { 
            var _this = this;
            var theAction = "AddBuyBetting", statesub = true; 
            var _btnObj = $("#" + _Option.Betting_Sub_BtnId);
            var _OrderContainer = $("#"+_Option.ChoiceInfoListCont_TB_Id); 
            //获取投注列表的统计数据
            var theDatas = _This.GetTzOrderInfos(_OrderContainer, statesub);

            var theData = theDatas.Bettings;
            statesub = theDatas.statesub; 
            
            var _TongJiMoney = Number($("#"+_Option.ToTal_ChoiceNotePrice_El_Id).text());


            if (typeof theData == "object" && theData.length > 0 && theAction != "") { 
                var _LottyCode = theData[0].lottery_code; //彩种编码

                var _theHeMaiInfos = _This.Account_WithBuyOrder(_TongJiMoney);

                if (_theHeMaiInfos.HeMaiTitle == "") { alert("请填写合买方案的标题"); $("#hemai_tit").focus(); return false; }

                var NewTzObj = {};
                NewTzObj.scheme_title = _theHeMaiInfos.HeMaiTitle; //合买标题
                NewTzObj.scheme_describe = _theHeMaiInfos.HeMaiMx; //合买描述信息
                NewTzObj.profit_money = Number(_theHeMaiInfos.HeMaiYj); //盈利佣金百分比 1,2,3
                NewTzObj.buy_count = isNaN(parseInt(_theHeMaiInfos.HuaFenNum)) ? 0 : parseInt(_theHeMaiInfos.HuaFenNum);     //合买份数
                NewTzObj.lottery_code = _LottyCode; //彩种编码
                NewTzObj.scheme_money = _TongJiMoney; //方案金额 而"不是"保底+合买金额
                NewTzObj.my_buy_count = isNaN(parseInt(_theHeMaiInfos.UserBuyNum)) ? 0 : parseInt(_theHeMaiInfos.UserBuyNum); //购买份数
                NewTzObj.but_min_count = isNaN(parseInt(_theHeMaiInfos.BaoDiNum)) ? 0 : parseInt(_theHeMaiInfos.BaoDiNum); //保底份数 
                NewTzObj.betting = theData; //投注信息 
                 
                if (NewTzObj.buy_count < 1) {
                    return false;
                    alert("合买份数不得小于1份");
                }
                if (NewTzObj.my_buy_count < 1) {
                    alert("合买最低购买份数不得小于1");
                    return false;
                }


                var theStringData = Ruiec_Fn.Json_To_String(NewTzObj);
                 
                _btnObj.attr("state", "false");

                var _PostUrl = _Option.Common_Ajax_Api + "?action=" + theAction;
                var _PostData = { "action": theAction, "data": theStringData };
                 
                Ruiec_Fn.RAjax("POST", _PostUrl, _PostData, "json", _This.Success_WidthBuy); 
            }
        },
        /**
        * @content 统计合买金额 
        */
        Account_WithBuyOrder: function (OrderPrice) {
            var HmInfos = {
                CanSub: true
            };
            var theOrderPrice = OrderPrice == undefined ? 0 : OrderPrice;
            if (theOrderPrice <= 0) {
                console.log("error");
            } else {
                //划分份数
                var theHuaFenNum = isNaN(parseInt($("#hemai_fen").val())) ? 1 : parseInt($("#hemai_fen").val());
                //每份的金额
                var theEachMoney = isNaN(parseFloat(OrderPrice / theHuaFenNum)) ? OrderPrice : parseFloat(OrderPrice / theHuaFenNum);
                //自己购买的份数
                var theUserBuyNum = isNaN(parseInt($("#hemai_rengou").val())) ? 1 : parseInt($("#hemai_rengou").val());
                //自己购买需要支付的金额
                var theUserBuyMoney = parseFloat(theUserBuyNum * theEachMoney).toFixed(2);
                //合买保底的份数
                var theBaoDiNum = isNaN(parseInt($("#hemai_baodi").val())) ? 1 : parseInt($("#hemai_baodi").val());
                //合卖保底的金额 
                var theBaodiMoney = parseFloat(theBaoDiNum * theEachMoney).toFixed(2);
                //合买的总金额
                //var theHeMaiMoney = Number(theUserBuyMoney) + Number(theBaodiMoney);
                var theHeMaiMoney = Number(theUserBuyMoney);

                //合买方案标题
                var theHeMaiTitle = $("#hemai_tit").val();
                //合买方案描述
                var theHeMaiMx = $("#hemai_mx").val();
                //合买佣金
                var theHeMaiYj = $("#hemai_yj").val();

                theHeMaiMoney = parseFloat(theHeMaiMoney).toFixed(2);
                $("#hemai_money_rengou").empty().text(theUserBuyMoney);
                $("#hemai_money_baodi").empty().text(theBaodiMoney);
                $("#hemai_count").empty().text(theHeMaiMoney);

                HmInfos.HuaFenNum = theHuaFenNum;
                HmInfos.EachMoney = theEachMoney;
                HmInfos.UserBuyNum = theUserBuyNum;
                HmInfos.UserBuyMoney = theUserBuyMoney;
                HmInfos.BaoDiNum = theBaoDiNum
                HmInfos.BaodiMoney = theBaodiMoney;
                HmInfos.HeMaiMoney = theHeMaiMoney;
                HmInfos.HeMaiTitle = theHeMaiTitle;
                HmInfos.HeMaiMx = theHeMaiMx;
                HmInfos.HeMaiYj = theHeMaiYj; 
            }
            return HmInfos;
        },
        /**
        * @description 合买投注----回调函数
        */
        Success_WidthBuy: function (data) {
            if (data && data.Code == "1") {
                //成功提示
                artDialog({
                    content: data.StrCode,
                    icon: "success",
                    lock: true,
                    ok: function () {

                        //选择我要自购
                        $("#" + _Option.ChoiceBettingType_El_Id + " input[name='rad'][value='0']").trigger("click");

                        //清除投注信息
                        _This.ruiec_clearBettingInfos();

                        //更新投注方案
                        _This.ruiec_getMyProject();

                        $("html,body").animate({ "scrollTop": "0px" });

                        //清除合买的表单信息，和金额信息
                        $("#isZigou").click();
                        $(".creat_hemai form input").val("");
                        $("#hemai_count").empty().text("0.0");
                        $("#hemai_money_rengou").empty().text("0.0");
                        $("#hemai_money_baodi").empty().text("0.0");
                        //清除合买的表单信息，和金额信息 

                        $("#continue_choice").trigger("click");
                        //更新金额
                        $("#get_money .iconfont").trigger("click");
                    },
                    close: function () {
                        //选择我要自购
                        $("#" + _Option.ChoiceBettingType_El_Id + " input[name='rad'][value='0']").trigger("click");

                        //清除投注信息
                        _This.ruiec_clearBettingInfos();

                        //更新投注方案
                        _This.ruiec_getMyProject();

                        $("html,body").animate({ "scrollTop": "0px" });

                        //清除合买的表单信息，和金额信息
                        $("#isZigou").click();
                        $(".creat_hemai form input").val("");
                        $("#hemai_count").empty().text("0.0");
                        $("#hemai_money_rengou").empty().text("0.0");
                        $("#hemai_money_baodi").empty().text("0.0");
                        //清除合买的表单信息，和金额信息 


                        $("#continue_choice").trigger("click");
                        //更新金额
                        $("#get_money .iconfont").trigger("click");
                    }
                })  
             
            } else {
                //失败提示
                Ruiec_Fn.alert("投注失败,原因：" + data.StrCode, "CountDown", 3);
            }

            $("#" + _Option.Betting_Sub_BtnId).attr("state", "true");
        }
    }

    $.extend({ ruiec_GameBet: Ruiec_GameBet });

})(jQuery,window);


//PageReady
$(function () { 

    var Js_Root = $("#_jsurl").val();
    //页面结构情况
    var PageStruct_Option = {
        CurrentOpenIssue_El_Id: "f_lottery_info_lastnumber", //当前正在开奖的期号，最近一期正在开奖的期号 DOM对象ID
        CurrentBettingIssue_El_Id: "f_lottery_info_number",//当前正在投注的期号，最近一期正在投注的期号 DOM对象ID
        LatestOpenNumber_El_Id: "openNum_list", //最近一期的开奖号码 DOM对象ID
        BettingCountdown_El_Id: "j_lottery_time",//投注的倒计时 DOM对象ID
        LotteryPlayRegion_El_Id: "LotteryPlayRegio_Info",//玩法说明区域 DOM对象ID
        ChoiceNote_El_Id: "choice_zhu",//选中注数 DOM对象ID
        ChoiceMultiple_El_Id: "choice_Multiple",//选中倍数 DOM对象ID
        ChoiceUnit_Select_Id: "choice_Unit",//选中投注单位 下拉菜单ID
        ChoiceUnit_Init_Value: [{ "value": "1", "text": "元" }, { "value": "0.1", "text": "角" }, { "value": "0.01", "text": "分" }],//选中投注的单位列表[元、角、分、厘] 
        ChoiceNotePrice_El_Id: "choice_money",//选中注数的金额 DOM对象ID
        LotteryPlayRebate_Select_Id: "select_fd",//玩法的返点 下拉菜单ID
        KsChoice_Peilv_Input: "Choice_NumberPeilv",//赔率输入区域
        KsChoice_NumberInfos_Input: "Choice_NumberInfos",//选号显示区域
        KsChoice_EachPrice_Input: "Choice_Each_Price", //每注投资的金额
        Waplook_detail_btn: "look_detail_btn",//查看我的选号
        SureChoice_El_Id: "choice_comfire_btn",//确认选号按钮id
        ChoiceInfoListCont_TB_Id: "order_table",//选号列表 区域ID 表格对象
        RandChoice_One_El_Id: "order_random1",//机选1注的按钮
        RandChoice_Five_El_Id: "order_random5",//机选5注的按钮
        EmptyChoiceInfo_El_Id: "order_empty",//清空当前选号
        ToTal_ChoiceNote_El_Id: "f_gameOrder_lotterys_num",//当前彩种所有选号总共的注数
        ToTal_ChoiceNotePrice_El_Id: "f_gameOrder_amount",//当前彩种所有选号总共的金额
        ChoiceBettingType_El_Id: "Check_Betting_Type",//投注模式的选择区域的Id
        ChoiceBettingType_Init_Value: [{ "value": "0", "text": "我要自购", "Relation_Cont_ID": "" }, { "value": "1", "text": "我要追号", "Relation_Cont_ID": "Chase_Program_Cont" }],//投注模式的值 [我要自购、我要追号、发起合买、高级追号] 
        BettingType_Container_Id: "Betting_type_Container", //追号合买区域的父级区域id
        ChaseProgram_Tb_Id: "f_chase_table", //追号列表的表格id
        Betting_Sub_BtnId:"f_submit_order",//确认投注
        HistoryOpenNumber_TB_Id: "fn_getoPenGame",//开奖历史记录  表格对象
        Account_BettingRecord_TB_Id: "fn_getMyProjects",//用户的投注记录  表格对象
        Account_ChaseRecord_TB_Id: "fn_getMyZhuihao",//用户的追号记录  表格对象
        Account_WithBuyRecord_TB_Id: "fn_getMyHemai",//用户的合买记录  表格对象
        Choice_BallArea_El_Id: "gn_main_cont",//选号区域的 区域ID DOM对象ID 
        Choice_PlayCode_El_Id: "j_play_select",//选择彩种玩法
        Common_Ajax_Api: "../tools/ssc_ajax.ashx",//获取数据的接口
        Js_Root: Js_Root,//玩法JS结构目录
        CallBack: ""//回调函数 
    }
   
    JS_LoadingTime = new Date().getTime();
    //console.log("readyTime==" + JS_LoadingTime);

    var ruiec_GameBet = new $.ruiec_GameBet();
    ruiec_GameBet.Init(PageStruct_Option);

});



