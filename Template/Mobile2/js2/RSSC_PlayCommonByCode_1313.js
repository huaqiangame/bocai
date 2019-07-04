// JavaScript Document  
//+----------------------------------------------------------------------
// | 技术支持：88375133@qq.com
//+----------------------------------------------------------------------
// | Author: 梁汝翔 <liangruxiang >
//+----------------------------------------------------------------------
// | Date: 2015年7月28日 10:30:00
//+----------------------------------------------------------------------
// | Name: RSSC_PlayCommonByCode_1100.js (广东11选5 基本玩法 )
//+----------------------------------------------------------------------
// | Logic: 对象传递 --> 创建构造函数 --> 扩展函数方法 --> 
// |        初始化调用函数方法 --> 执行函数初始化方法（Init） --> 
// |        创建选球区域html（Creat_ball_area） --> 绑定选球的事件（Blind_CheckBall） --> 
// |        触发投注算法的JS（Blind_CheckBall） --> 获取选球的内容（GetBlind_CheckBall）--> 
// |        获取投注的结果（GetZhuShu） --> 更新页面上的值（GetBlind_CheckBall、_GameBetobj.Change_tzPrice） --> 
// |        更新之后确定投注（Blind_CheckBall） --> 再次验证投注信息 （GetBlind_CheckBall、GetZhuShu） --> 
// |        计算订单信息，生成订单对象（Creat_TZ_Infos） --> 
// |        根据订单对象，创建订单html（可能进行合并）：处理追加信息（CreatTzOrder_FillInTable） -->
// |        追加处理信息以后,清除已选的球，和投注数据（clearTzCheckBall） --> 
//+----------------------------------------------------------------------

(function ($, ruiec_GameBet, W) {
    //声明一个对象，设定为：GamBet的基础对象
    var _GameBetobj = new $.ruiec_GameBet();
    var Ruiec_Fn = window.RCP;  //全局算法对象
    var _This, _GameBetOption;  //全局变量
    var _Lottery_OpenTimeList; //全局变量，存储当前彩种的开奖时间表
    var Play_Basic_Obj; //全局变量
    //创建一个基础构造函数
    var Lottery_Basic_Fn = function () {
        this.param = "";
    }

    Lottery_Basic_Fn.prototype = {
        init: function () {
            _This = this;
            var oLotteryCode = _GameBetobj.ruiec_returnLottery();
            //获取当前链接的彩参数 
            _GameBetOption = _GameBetobj.GetGameBet_Options();
            _This.ruiec_getOpenTimeList(oLotteryCode);
        },
        /**
        * @description 更新玩法JS对象 
        * @param {String} oLotteryCode 彩种编码 
        */
        update_PlayBasicObj: function () {
            Play_Basic_Obj = new $.Play_Basic_Obj();

            //根据不同的玩法判断是否需要显示确认选号按钮
            var _thePlayCode = _GameBetobj.ruiec_getLotteryPlayData();
            _thePlayCode = _thePlayCode.substring(4, _thePlayCode.length);
            switch (_thePlayCode) {
                case "H10":
                    //二不同号
                    $("#" + _GameBetOption.SureChoice_El_Id).show();
                    $("#" + _GameBetOption.SureChoice_El_Id).attr("actived", "Manual");
                    break;
                case "G10":
                    //二同号单选
                    $("#" + _GameBetOption.SureChoice_El_Id).show();
                    $("#" + _GameBetOption.SureChoice_El_Id).attr("actived", "Manual");
                    break;
                case "F10":
                    //二同号复选
                    $("#" + _GameBetOption.SureChoice_El_Id).show();
                    $("#" + _GameBetOption.SureChoice_El_Id).attr("actived", "Manual");
                    break;
                case "E10":
                    //三连号通选
                    //$("#" + _GameBetOption.SureChoice_El_Id).hide();
                    //$("#" + _GameBetOption.ChoiceNote_El_Id).parent().hide();
                    $("#" + _GameBetOption.SureChoice_El_Id).attr("actived", "Manual");
                    break;
                case "D10":
                    //二同号复选
                    $("#" + _GameBetOption.SureChoice_El_Id).show();
                    $("#" + _GameBetOption.SureChoice_El_Id).attr("actived", "Manual");
                    break;
                case "C10":
                    //三同号单选
                    $("#" + _GameBetOption.SureChoice_El_Id).show();
                    $("#" + _GameBetOption.SureChoice_El_Id).attr("actived", "Manual");
                    break;
                case "B10":
                    //三同号通选
                    //$("#" + _GameBetOption.SureChoice_El_Id).hide();
                    //$("#" + _GameBetOption.ChoiceNote_El_Id).parent().hide();
                    $("#" + _GameBetOption.SureChoice_El_Id).attr("actived", "Manual");
                    break;
                case "A10":
                    //三连号通选
                    //$("#" + _GameBetOption.SureChoice_El_Id).hide();
                    //$("#" + _GameBetOption.ChoiceNote_El_Id).parent().hide();
                    $("." + _GameBetOption.KsChoice_Peilv_Input).val("");
                    $("#" + _GameBetOption.SureChoice_El_Id).attr("actived", "Manual");
                    break;
                case "":
                default:
                    $("#" + _GameBetOption.SureChoice_El_Id).hide();
                    $("#" + _GameBetOption.SureChoice_El_Id).attr("actived", "Manual");
                    break;
            }
            return Play_Basic_Obj;
        },
        /**
        * @description 生成开奖时间表 
        * @param {String} oLotteryCode 彩种编码 
        */
        ruiec_getOpenTimeList: function (oLotteryCode) {

            if (oLotteryCode != undefined && oLotteryCode != "") {
                var _GetIssueList_Api = _GameBetOption.Common_Ajax_Api + "?action=get_lottery_open_Issuse_list";
                var _PostData = { "action": "get_lottery_open_Issuse_list", "lottery_code": oLotteryCode };
                //获取数据请求
                Ruiec_Fn.RAjax("POST", _GetIssueList_Api, _PostData, "json", _This.CreatOpenTimeList);
            } else {
                return false;
            }
        },
        /**
        * @description 生成开奖时间表 
        * @param {JsonData} 回调函数 彩种编码 
        */
        CreatOpenTimeList: function (data) {
            if (data == undefined) return false;
            var Result = {};
            var openTimeList = [];  //重组的开奖期号对应的时间
            var oLotteryCode = _GameBetOption.lotteryCode == undefined ? 1000 : _GameBetOption.lotteryCode;
            var oLastIssue = data.issuse_no; //最后一期的期号
            var oLastOpenTime = data.open_time; //最后一期的开奖时间
            var oLastOpenTimeS = Ruiec_Fn.ruiec_TimeToDate(oLastOpenTime);  //最后一期的开奖时间戳
            var oLastOpenNum = data.open_num; //最后一期的开奖号码
            var oFendan = data.open_issuse_time_list  //封单时间
            var oLastOpenTime_split = oLastOpenTime.split(" ")[1]; //获取追后一期的开奖时间区间如:17:32:49
            oFendan = oFendan[0].single_letter;  //封单时间(秒)
            oLastOpenTime_split = Ruiec_Fn.ruiec_TimeToDate(oLastOpenTime_split, "time") * 1000;
            var oList = data.open_issuse_time_list;
            //找出上一期开奖的索引值
            for (var a in oList) {
                var a = parseInt(a);
                var begin_time1 = oList[a].begin_time1; //开始时间
                var end_time1 = oList[a].end_time1; //结束时间
                begin_time1 = Ruiec_Fn.ruiec_TimeToDate(begin_time1, "time") * 1000;
                end_time1 = Ruiec_Fn.ruiec_TimeToDate(end_time1, "time") * 1000;
                if (a < oList.length - 1) {
                    var begin_time2 = oList[a + 1].begin_time1;  //下期的开奖时间
                    begin_time2 = Ruiec_Fn.ruiec_TimeToDate(begin_time2, "time") * 1000;
                    if (oLastOpenTime_split >= begin_time1 && oLastOpenTime_split < begin_time2) {
                        var oIndex = a;  //找到上一期所处时间区间的索引
                    }
                } else {
                    if (oLastOpenTime_split >= begin_time1 && oLastOpenTime_split < end_time1) {
                        var oIndex = a;  //找到上一期所处时间区间的索引
                    }
                };
            };
            if (oIndex != 0) {
                if (oIndex == '' || oIndex == undefined) {
                    oIndex = oList.length - 1;
                };
            };

            //oIndex = oIndex + 1;

            oLastIssue_last = Number(oLastIssue.substring(8, oLastIssue.length)) //023转23


            var oTodayTime = Ruiec_Fn.ruiec_returnNextDayTime(0);  //今日凌晨的时间
            var oFirstOpenDate = oList[0].begin_time1;  //第一期的开奖时间
            oFirstOpenDate = oTodayTime + parseInt(Ruiec_Fn.ruiec_TimeToDate(oFirstOpenDate, "time") * 1000);
            for (var i = 0; i < 5; i++) {
                if (oLastOpenTimeS >= oFirstOpenDate) {
                    var oNextTime = Ruiec_Fn.ruiec_returnNextDayTime(i); //获取下i-1天零点的时间戳
                }
                else {
                    var oNextTime = Ruiec_Fn.ruiec_returnNextDayTime(i - 1); //获取下i-1天零点的时间戳
                }
                var newBeginTime = 0;
                var newEndTime = 0;
                var newIssue = "";
                for (var a in oList) {
                    var openTimeList_item = {};
                    var begin_time1 = oList[a].begin_time1; //开始时间
                    var end_time1 = oList[a].end_time1; //结束时间
                    newBeginTime = oNextTime + Ruiec_Fn.ruiec_TimeToDate(begin_time1, "time") * 1000;
                    newEndTime = oNextTime + Ruiec_Fn.ruiec_TimeToDate(end_time1, "time") * 1000;
                    newIssue = $.trim(Ruiec_Fn.ruiec_DateToTime(newEndTime, 1));  //获取日期
                    //var oCha = a - oIndex;  //当前的与索引的差

                    //console.log("oCha===" + oCha);
                    //console.log("oLastIssue_last===" + oLastIssue_last);

                    //var issue_No = oLastIssue_last + oCha;
                    ////console.log("issue_No==oLastIssue_last+ oCha===" + issue_No);
                    //if (issue_No <= 0) {
                    //    issue_No = issue_No + oList.length;
                    //}
                    //if (issue_No > oList.length) {
                    //    issue_No = issue_No - oList.length;
                    //};

                    //if (issue_No < 10) {
                    //    issue_No = "00" + issue_No;
                    //}
                    //else if (issue_No >= 10 && issue_No < 100) {
                    //    issue_No = "0" + issue_No;
                    //}
                    ////console.log(issue_No);
                    //newIssue = Ruiec_Fn.ruiec_removeSplit(newIssue, "-") + issue_No;   //日期转字符串+期号

                    var oCha = Number(a - oIndex) + Number(i * oList.length);  //当前的与索引的差
                    newIssue = Number(oLastIssue) + Number(oCha);
                    if (newIssue.toString().length < 6) {
                        newIssue = "0" + newIssue;
                    }

                    openTimeList_item.newBeginTime = newBeginTime;
                    openTimeList_item.newEndTime = newEndTime;
                    openTimeList_item.newIssue = newIssue;
                    openTimeList_item.newBeginDate = Ruiec_Fn.ruiec_DateToTime(newBeginTime, 3)
                    openTimeList_item.newEndDate = Ruiec_Fn.ruiec_DateToTime(newEndTime, 3)
                    openTimeList.push(openTimeList_item);
                }
            }
            //console.log(openTimeList);
            //当前期号及倒计时赋值
            _GameBetobj.ruiec_showNowIussue(openTimeList, oLastIssue, oLastOpenTime, oLastOpenNum, oFendan, oLotteryCode);
            return openTimeList;
        },
        /**
        * @description  绑定每个彩票玩法选号的点击事件
        * @param {JsonData} 回调函数 彩种编码 
        */
        Bind_EachPlayChoiceBall: function (AreaId, CallBack) {

            if (Play_Basic_Obj == undefined) {
                Play_Basic_Obj = new $.Play_Basic_Obj();
            }

            var _AreaContainer = $("#" + AreaId);
            //绑定区域的选球事件
            $("#" + AreaId).on("click", ".ball_number", function () {

                var _theSureInfos = $("#" + _GameBetOption.SureChoice_El_Id).attr("actived");
                if (_theSureInfos == "automatic" && $("#" + AreaId).find(".ball_number.curr").length > 0) {
                    $("#" + AreaId).find(".ball_number.curr").removeClass("curr");
                }
                //调用子结果集的内容进行选号处理（比如说存在胆拖号码，指定位置不能相同时的JS处理）
                var Play_Active = Play_Basic_Obj.ShowClickActive_FN($(this), 'single');
                if (Play_Active && _theSureInfos != "automatic") {
                    var _theValue = $(this).attr("ball-number");
                    var _thePeilv = $(this).attr("peilv");

                    $("." + _GameBetOption.KsChoice_NumberInfos_Input).val(_theValue);
                    $("." + _GameBetOption.KsChoice_Peilv_Input).val(_thePeilv);
                    //统计选号信息，并调用回调函数
                    _This.GetBlind_CheckBall(AreaId, CallBack);
                }

                if (_theSureInfos == "automatic") { 
                    var _theValue = $(this).attr("ball-number");
                    var _thePeilv = $(this).attr("peilv");

                    $("." + _GameBetOption.KsChoice_NumberInfos_Input).val(_theValue);
                    $("." + _GameBetOption.KsChoice_Peilv_Input).val(_thePeilv);
                    $("#" + _GameBetOption.KsChoice_EachPrice_Input).focus();
                }
            });

            //点击“随机一注”按钮
            $("#" + _GameBetOption.RandChoice_One_El_Id).unbind("click").bind("click", function () {
                Ruiec_Fn.alert("自选金额，不允许机选");
                return false;
                _GameBetobj.ruiec_clearTzCheckBall();

                //获取随机算法，依赖于Play_Basic_Obj
                var randomData = Play_Basic_Obj.getOneRandomBetting(_AreaContainer);

                //同步当前的选号注数与当前的金额
                _This.GetBlind_CheckBall(AreaId);

                //me.ruiec_SetZhuShu(me, _AreaContainer);
                $("#" + _GameBetOption.SureChoice_El_Id).trigger("click");
            });

            //点击“随机五注”按钮
            $("#" + _GameBetOption.RandChoice_Five_El_Id).unbind("click").bind("click", function () {
                for (var a = 0; a < 5; a++) {
                    $("#" + _GameBetOption.RandChoice_One_El_Id).trigger("click");
                };
            });

            //点击“清空号码”按钮
            $("#" + _GameBetOption.EmptyChoiceInfo_El_Id).off("click").click(function () {
                if ($("#order_table tr").size() > 0) {

                    function SureAlert() {
                        _GameBetobj.ruiec_clearBettingInfos();
                        return true;
                    }

                    var TheCallBack = Ruiec_Fn.alert("确认删除号码篮内全部内容吗?", "comfirm", SureAlert);

                } else {
                    return false;
                };
            });

            //确认选号
            $("#" + _GameBetOption.SureChoice_El_Id).unbind("click").click(function () {
                var _TheInfos = _This.GetBlind_CheckBall(AreaId);
                var _AreaContainer = $("#" + AreaId);
                //创建临时订单，并填充到制定的临时投注区域中去
                _This.Creat_TZ_Infos(_TheInfos, _AreaContainer);
            });

            //输入投注金额
            $("#" + _GameBetOption.KsChoice_EachPrice_Input).keyup(function () {
                var _theSureInfos = $("#" + _GameBetOption.SureChoice_El_Id).attr("actived");
                var _theValue = $(this).val();
                _theValue = _theValue.replace(/[^\d]/g, "");
                var _theLength = $("#" + _GameBetOption.ChoiceNote_El_Id).text(); //当前注数
                _theLength = isNaN(parseInt(_theLength)) ? 0 : parseInt(_theLength);
                var _thePrice = _theLength * _theValue;
                _thePrice = parseInt(_thePrice);
                $("#" + _GameBetOption.ChoiceNotePrice_El_Id).empty().text(_thePrice);

                if ("automatic" == _theSureInfos) {
                    _theLength = 1;
                    _thePrice = parseInt(_theValue) * _theLength;
                    $("#" + _GameBetOption.ChoiceNote_El_Id).empty().text(_theLength);
                    $("#" + _GameBetOption.ChoiceNotePrice_El_Id).empty().text(_thePrice);
                }

            });


        },
        /**
        * @description 遍历获取所有选球   
        * @param {String} AreaId 选号区域的id
        * @param {Function} Callback 玩法详情的回调函数
        */
        GetBlind_CheckBall: function (AreaId, CallBack, Type) {
            var _CheckBall_Array = new Array();

            var _AreaContainer = $("#" + AreaId);
            //遍历所有位数选中的号码 
            var _Ball_length = $("#" + AreaId).find(".li_ball").length;
            if (_Ball_length > 0) {
                for (var i = 0; i < _Ball_length; i++) {
                    var _CheckLinObj = {};
                    var _CheckBoll_LineArry = new Array();
                    $("#" + AreaId).find(".li_ball").eq(i).find(".ball_number.curr").each(function () {
                        var _theValue = $(this).attr("ball-number");
                        _CheckBoll_LineArry.push(_theValue);
                    });
                    var TheName = $("#" + AreaId).find(".ball_tit").eq(i) == undefined ? AreaId : $("#" + AreaId).find(".ball_tit").eq(i).find("strong").text();
                    _CheckLinObj.name = TheName;
                    _CheckLinObj.value = _CheckBoll_LineArry;
                    _CheckBall_Array.push(_CheckLinObj);
                }
            }

            if (CallBack != undefined && CallBack != "") {
                CallBack(_CheckBall_Array);
            } else if (Type != undefined) {
                //统计投注的注数信息
                return _CheckBall_Array;
            } else {
                return _This.AccountBettingInfos(_CheckBall_Array, _AreaContainer);
            }
        },
        /**
        * @description 统计时时彩的注数详细信息    
        * @param {Json} CheckBallData 选球信息
        */
        AccountBettingInfos: function (CheckBallData, _AreaContainer) {

            if (Play_Basic_Obj == undefined) {
                Play_Basic_Obj = new $.Play_Basic_Obj();
            }

            var _ZhuShuArray = {};
            var tzLen = 0;  //投注数
            //var tzInfos = this.ruiec_getChoiceBall(CheckBallData);  //输出选球

            _ZhuShuArray = Play_Basic_Obj.GetZhuShu(CheckBallData);

            //根据不同的玩法调用不同的算法，依赖于Play_Basic_Obj 

            if (_ZhuShuArray == undefined && _ZhuShuArray.tzLen == undefined && _ZhuShuArray.tzLen < 1) {
                _ZhuShuArray = "";
            }

            //console.log(_ZhuShuArray);

            //同步当前的选号注数与当前的金额
            _This.Sync_BettingInfos(_ZhuShuArray);

            return _ZhuShuArray;
        },
        /**
        * @description 输出选球，格式如（2 3 4,3 4 5 6 7）行内用" "分割，行与行用","分割    
        * @param {Json} CheckBallData 选球信息
        */
        ruiec_getChoiceBall: function (CheckBallData) {

            if (CheckBallData != undefined && CheckBallData != "") {

                var allArray = new Array();  //选球所有数组
                for (var i = 0; i < CheckBallData.length; i++) {
                    var CheckBallData_val = CheckBallData[i].value;
                    var lineArry = new Array(); //选球单行数组
                    for (var m = 0; m < CheckBallData_val.length; m++) {
                        lineArry.push(CheckBallData_val[m]);
                    };
                    lineArry = Ruiec_Fn.GetArray_ToString(lineArry, " ");
                    allArray.push(lineArry);
                };
                allArray = Ruiec_Fn.GetArray_ToString(allArray, ",");
                return allArray;
            }

        },
        /**
        * @description 更新当前玩法的选号与金额  
        * @param {Json} CheckBallData 选球信息
        */
        Sync_BettingInfos: function (ZhuShuArray) {
            if (ZhuShuArray != "") {

                var _ChoiceMultiple = 1; //倍数 
                var _ChoiceUnit = 1; //单位  
                //_ChoiceMultiple = 1;
                var _ChoiceNote = ZhuShuArray.tzLen == undefined ? 0 : ZhuShuArray.tzLen;
                //var _ChoicePrice = _ChoiceNote * 2 * _ChoiceMultiple * _ChoiceUnit;
                //_ChoicePrice = isNaN(Number(_ChoicePrice)) ? 0 : Number(_ChoicePrice);
                //var _ChoicePriceStr = _ChoicePrice.toString();
                //if (_ChoicePriceStr.indexOf(".") >= 0) {
                //    _ChoicePrice = parseFloat(_ChoicePrice).toFixed(3);
                //} 

                //注数
                $("#" + _GameBetOption.ChoiceNote_El_Id).empty().text(_ChoiceNote);
                if ($("." + _GameBetOption.KsChoice_NumberInfos_Input).size() > 0) {
                    //选择的号码
                    $("." + _GameBetOption.KsChoice_NumberInfos_Input).val(ZhuShuArray.tzInfos);
                }
                //金额
                //$("#" + _GameBetOption.ChoiceNotePrice_El_Id).empty().text(_ChoicePrice);

                //$("#" + _GameBetOption.KsChoice_EachPrice_Input).focus();

                if (_ChoiceNote > 0) {

                    //当前彩种编码
                    var _theLotteryCode = _GameBetOption.lotteryCode;
                    //当前玩法编码
                    var _theLotteryPlayCode = _GameBetobj.ruiec_getLotteryPlayData();
                    //当前号码
                    var _theBetting_number = ZhuShuArray.tzInfos; //选择的投注内容
                    //当前注数
                    var _theBetting_count = _ChoiceNote;
                    //当前倍数
                    var _theGraduation_count = 1;
                    //当前返点 
                    var _theBetting_point = "0-0.0";
                    //当前投注类型 
                    var _theBetting_model = 1;
                    //投注的赔率
                    var _theBetting_Peilv = $(".Choice_NumberPeilv").val();


                    var _BettingData = {};
                    _BettingData.Issue = $("#" + _GameBetOption.CurrentBettingIssue_El_Id).text(); //当前期号
                    _BettingData.LotteryCode = _GameBetOption.lotteryCode; //当前彩种编号
                    _BettingData.PlayName = $(".choice_playName").text(); //当前彩种的玩法
                    _BettingData.PlayCode = _GameBetobj.ruiec_getLotteryPlayData(); //当前玩法的编码 
                    _BettingData.Betting_number = _theBetting_number; //投注的编号
                    _BettingData.Betting_count = _theBetting_count;
                    _BettingData.Graduation_count = _theGraduation_count;
                    _BettingData.Betting_point = _theBetting_point;
                    _BettingData.Betting_model = _theBetting_model;
                    _BettingData.Betting_Peilv = _theBetting_Peilv;

                    _This.ShowBetting_dialog(_BettingData);
                }


            } else {
                //注数
                $("#" + _GameBetOption.ChoiceNote_El_Id).empty().text("0");
                //金额
                //$("#" + _GameBetOption.ChoiceNotePrice_El_Id).empty().text("0.00");
                if ($("." + _GameBetOption.KsChoice_NumberInfos_Input).size() > 0) {
                    //选择的号码
                    $("." + _GameBetOption.KsChoice_NumberInfos_Input).val("");
                }
            }

            return true;
        },
        /**
        * @description 根据数据创建投注的号码信息 
        * @param {Json} _CheckBettingInfos 选号的组合数据 
        * @param {ElementObject} _AreaContainer 选号的区域对象 
        */
        Creat_TZ_Infos: function (_CheckBettingInfos, _AreaContainer) {

            var _OrderObj = {};  //订单数据

            var _tz_type1 = $("#" + _GameBetOption.Choice_PlayCode_El_Id + " .play_select_tit li.curr").text();
            var _tz_type2 = $("#" + _GameBetOption.Choice_PlayCode_El_Id + " .play_select_cont li.curr dd.curr").text();
            var _tz_type3 = $("#" + _GameBetOption.Choice_PlayCode_El_Id + " .play_select_cont li.curr dd.curr").siblings("dt").text();

            var _tz_type = "[" + _tz_type1 + "_" + _tz_type2 + "_" + _tz_type3 + "]";  //类型
            var _getLottyCode = _AreaContainer.attr("id");
            var _tz_infos = _CheckBettingInfos.tzInfos;
            //var _tz_beishu = $("#" + _GameBetOption.ChoiceMultiple_El_Id).val(); //倍数
            //var _tz_UnitStr = $("#" + _GameBetOption.ChoiceUnit_Select_Id).find(":checked").text(); //单位
            //var _tz_Unit = $("#" + _GameBetOption.ChoiceUnit_Select_Id).val(); //单位
            var _tz_ZLen = _CheckBettingInfos.tzLen;  //注数
            var _tz_Price = $("#" + _GameBetOption.KsChoice_EachPrice_Input).val(); ; //每注的金额

            //var _tz_Rebate = $("#" + _GameBetOption.LotteryPlayRebate_Select_Id).val() == undefined ? "0-0.0" : $("#" + _GameBetOption.LotteryPlayRebate_Select_Id).val(); //当前玩法的返点

            //_tz_beishu = isNaN(Number(_tz_beishu)) ? 1 : parseInt(_tz_beishu); //倍数
            _tz_Price = isNaN(Number(_tz_Price)) ? 0 : Number(_tz_Price); //当前选号的投注金额
            //if (_tz_Price.toString().indexOf(".") > 0) _tz_Price = parseFloat(_tz_Price).toFixed(3);

            _tz_type = _tz_type.replace(/[:]/g, "");

            _OrderObj._getLottyCode = _getLottyCode; //当前注数的选号区域的id
            _OrderObj._tz_infos = _tz_infos; //当前选号的投注内容
            _OrderObj._tz_type = _tz_type; //当前玩法说明
            _OrderObj._tz_UnitStr = "元"; //单位
            _OrderObj._tz_ZLen = _tz_ZLen; //投注长度 
            _OrderObj._tz_peilv = $("#" + _GameBetOption.SureChoice_El_Id).attr("peilv"); //投注长度
            _OrderObj._tz_beishu = 1; //投注倍数
            _OrderObj._tz_Price = _tz_Price; //投注金额
            _OrderObj._tz_Rebate = "0-0.0"; //投注的返点

            if (_OrderObj && _OrderObj._tz_ZLen > 0) {

                //创建临时订单
                _GameBetobj.CreatTzOrder_FillInTable(_OrderObj, _AreaContainer);

            } else {
                Ruiec_Fn.alert("选号不完整，请重新选择", "tishi");
            }
        },
        /**
        * @description 显示投注的弹窗内容
        * @param {JsonData} _BettingData 基本的投注信息
        * @param {Object} obj 投注对象  
        */
        ShowBetting_dialog: function (_BettingData, obj) {

            var _theDialog_Html = _This.CreatBettingDialogHtml(_BettingData);
            artDialog({
                title: "投注",
                content: _theDialog_Html,
                id: "XY28_BettingDialogsss",
                cancel: function () {
                    $(".ball_number.curr").removeClass("curr");
                    $("#XY28_BettingDialog").remove();
                },
                ok: function () {
                    var _theMoney = $("#XY28_BettingDialog").find(".betting_moneys").val();
                    if (_theMoney == "") {
                        $("#XY28_BettingDialog").find(".betting_moneys").eq(0).focus();
                        return false;
                    } else {
                        var _TheIssue = $("#" + _GameBetOption.CurrentBettingIssue_El_Id).text(); //投注的期号
                        var _theMoneyS = isNaN(Number(_theMoney)) ? 0 : Number(_theMoney);
                        if (_theMoney > 0) {
                            _BettingData.betting_money = Number(_theMoney); //投注金额
                            var _PostArray = [];
                            var _PostData = {};
                            _PostData.lottery_code = _BettingData.LotteryCode;
                            _PostData.play_detail_code = _BettingData.PlayCode;
                            _PostData.betting_issuseNo = _TheIssue || _BettingData.Issue;
                            _PostData.betting_number = _BettingData.Betting_number;
                            _PostData.betting_count = _BettingData.Betting_count;
                            _PostData.graduation_count = _BettingData.Graduation_count;
                            _PostData.betting_money = _BettingData.betting_money;
                            _PostData.betting_point = _BettingData.Betting_point;
                            _PostData.betting_model = _BettingData.Betting_model;
                            _PostArray.push(_PostData);
                            var _BettingDatass = {};
                            _BettingDatass.BettingData = _PostArray;
                            var _PostData_Str = Ruiec_Fn.Json_To_String(_BettingDatass);

                            $.ajax({
                                type: "POST",
                                url: "../tools/ssc_ajax.ashx?action=AddBetting",
                                data: {
                                    action: "AddBetting",
                                    data: _PostData_Str
                                },
                                dataType: "json",
                                success: function (data) {
                                    if (data && data.Code == "1") {
                                        art.dialog({
                                            title: "投注成功",
                                            icon: "success",
                                            lock: true,
                                            content: "恭喜您已经投注成功！",
                                            button: [{ name: "查看注单", callback: function () { window.location.href = "/u_betting_record.html" } }, { name: "继续投注", callback: function () { }, focus: true}]

                                        });
                                    } else {
                                        if (data.StrCode.indexOf("日期位") > -1) {
                                            data.StrCode = "预售中";
                                        }
                                        artDialog({
                                            content: "投注失败,原因：" + data.StrCode,
                                            icon: "waring",
                                            lock: true,
                                            ok: function () {
                                                $("html,body").animate({ "scrollTop": "0px" });
                                            },
                                            close: function () {
                                                $("html,body").animate({ "scrollTop": "0px" });
                                            }
                                        })
                                    }
                                }
                            });

                        } else {
                            return false;
                        }
                        //obj.removeClass("curr");

                        $(".ball_number.curr").removeClass("curr");

                        return true;
                    }
                },
                lock: true
            })
            $("#XY28_BettingDialog .betting_moneys").unbind().keyup(function () {
                $(this).val(parseInt($(this).val()))
            });
        },
        /**
        * @description 创建投注弹窗的html结构
        * @param {JsonData} _BettingData 基本的投注信息 
        */
        CreatBettingDialogHtml: function (_BettingData) {

            var strVar = "";
            strVar += "<div class=\"submitComfire\" id='XY28_BettingDialog'>";
            strVar += " <ul class=\"ui-form\">";
            strVar += "     <li><label for=\"question1\" class=\"ui-label\">彩种：<\/label><span class=\"ui-text-info\">" + _BettingData.PlayName + "<\/span><\/li>";
            strVar += "     <li><label for=\"question1\" class=\"ui-label\">期号：<\/label><span class=\"ui-text-info\">第" + _BettingData.Issue + " 期<\/li>";
            strVar += "     <li><label for=\"answer1\" class=\"ui-label\">投注内容：<\/label><span class=\"ui-text-info\">" + _BettingData.Betting_number + "&nbsp;&nbsp;赔率：&nbsp;&nbsp;" + _BettingData.Betting_Peilv + "倍<\/span><\/li>";
            strVar += "     <li><label for=\"question1\" class=\"ui-label\">投注金额：<\/label><input type='number' value='' class='betting_moneys' verify='isNumb' />&nbsp;&nbsp;元<\/li>";
            strVar += " <\/ul>";
            strVar += "<\/div>";

            return strVar;
        }
    }

    //开始，初始化执行
    $.extend({ Lottery_Basic_Fn: Lottery_Basic_Fn });

})(jQuery, $.ruiec_GameBet, window)