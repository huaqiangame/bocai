// JavaScript Document 
// +----------------------------------------------------------------------  
// | Date: 2015年7月28日 10:30:00
// +----------------------------------------------------------------------
// | Name: RSSC_PlayCommonByCode_1301.js (安徽快三 基本玩法 )
// +----------------------------------------------------------------------
// | Logic: 对象传递 --> 创建构造函数 --> 扩展函数方法 --> 
// |        初始化调用函数方法 --> 执行函数初始化方法（Init） --> 
// |        创建选球区域html（Creat_ball_area） --> 绑定选球的事件（Blind_CheckBall） --> 
// |        触发投注算法的JS（Blind_CheckBall） --> 获取选球的内容（GetBlind_CheckBall）--> 
// |        获取投注的结果（GetZhuShu） --> 更新页面上的值（GetBlind_CheckBall、_GameBetobj.Change_tzPrice） --> 
// |        更新之后确定投注（Blind_CheckBall） --> 再次验证投注信息 （GetBlind_CheckBall、GetZhuShu） --> 
// |        计算订单信息，生成订单对象（Creat_TZ_Infos） --> 
// |        根据订单对象，创建订单html（可能进行合并）：处理追加信息（CreatTzOrder_FillInTable） -->
// |        追加处理信息以后,清除已选的球，和投注数据（clearTzCheckBall） --> 
// +----------------------------------------------------------------------

(function ($, ruiec_GameBet) {
    //声明一个对象，设定为：GamBet的基础对象
    var _GameBetobj = new $.ruiec_GameBet();

    //创建一个基础构造函数
    var Lottery_Basic_Fn = function () {
        this.param = "";
    }

    Lottery_Basic_Fn.prototype = {
    	init:function(){
    		var me = this
            //获取当前链接的彩参数
            var oLotteryCode = _GameBetobj.ruiec_returnLottery();
            var oAjaxUrl = $("#_jsurl").val()+"/../../tools/ssc_ajax.ashx" //ajax接口地址
    		var openTimeList = me.ruiec_getOpenTimeList(oLotteryCode,oAjaxUrl);
    	},
        /**
         * @content 获取彩种的基本参数信息
         * @author  梁汝翔<liangruxiang> 
         * @param 玩法的编号
         * @returns 返回最终的选号结果
         * @time 2015年7月28日 10:07:09
         */
        GetBasicLotteryData: function (play_code) {

            if (play_code == undefined) {
                if ($("#insertScript").size() > 0) {
                    play_code = $("#insertScript").attr("play_code") == undefined ? '1100E11' : $("#insertScript").attr("play_code");
                }
            }

            var Basic_LotteryData = {};
            Basic_LotteryData.LotteryName = "安徽快三";  //彩种名称
            Basic_LotteryData.LotteryCode = "1301";    //彩种编号
            Basic_LotteryData.LotteryType = "EasyFrame.Model.dt_lottery_play_detail";  //彩种模型
            Basic_LotteryData.PlayCode = play_code;    //玩法编号 

            return Basic_LotteryData;
        },
        /**
         * @content 绑定容器内的快捷处理事件
         * @author  梁汝翔<liangruxiang>  
         * @param _TheBall 点击事件
         * @returns 返回最终的选号结果
         * @time 2015年7月28日 10:07:09
         */
        Quick_console: function (_TheBall, _theValue) {
            _TheBall.removeClass("curr");  //先清除单行所有选中的球
            var _TheBall_bigVal = _TheBall.eq(_TheBall.length - 1).attr("ball-number"); //单行最大球的值
            var _TheBall_smallVal = _TheBall.eq(0).attr("ball-number");  //单行最小的值 
            var _hezhi = Number(_TheBall_bigVal) + Number(_TheBall_smallVal - 1); //和值 3、4、5、6、7、8、9； （小值为3、4、5）
            var _TheBall_halfVal = parseInt(_hezhi) / 2;  			//取中间值作为大小参考量 
            switch (_theValue) {
                case "All": //全选  
                    _TheBall.each(function () {
                        if ($(this).hasClass("curr")) {
                            return false;
                        } else {
                            $(this).addClass("curr");
                        }
                    })
                    break;
                case "Empty": //清  
                    _TheBall.each(function () {
                        $(this).removeClass("curr");
                    })
                    break;
                case "Big": //大  
                    _TheBall.each(function () {
                        if ($(this).attr("ball-number") > _TheBall_halfVal) {
                            $(this).addClass("curr");
                        }
                        else {
                            $(this).removeClass("currr");
                        };
                    })
                    break;
                case "Small": //小  
                    _TheBall.each(function () {
                        if ($(this).attr("ball-number") <= _TheBall_halfVal) {
                            $(this).addClass("curr");
                        }
                        else {
                            $(this).removeClass("currr");
                        };
                    })
                    break;
                case "Odd": //奇  
                    _TheBall.each(function () {
                        if (parseInt($(this).attr("ball-number")) % 2 != 0) {
                            $(this).addClass("curr");
                        }
                    })
                    break;
                case "Even": //偶  
                    _TheBall.each(function () {
                        if (parseInt($(this).attr("ball-number")) % 2 == 0) {
                            $(this).addClass("curr");
                        }
                    })
                    break;
            }
        },
        /**
         * @content 获取彩种的基本参数信息
         * @author  梁汝翔<liangruxiang> 
         * @param CheckBallData 选号数据；
         * @param type "算法类型":1、复式；2、单式、3、胆拖、4、组合复式
         * @returns 返回投注的信息{tzLen:1，tzInfos:""} //投注的长度，和投注的信息 
         * @time 2015年7月28日 10:07:09
         */
        getTouZhuInfo: function (CheckBallData, type) {
            //console.log(CheckBallData);
            var _ZhuShuArray;
            var _this = this;
            if (CheckBallData != undefined && CheckBallData != "") {
                if (type == undefined) { type = '1'; }
                switch (type) {
                    case 1:
                    case "1":
                        //选一 复式
                        var TzResult = _this.GetFuShi_Fn(CheckBallData, 1, 1);

                        _ZhuShuArray = {};
                        _ZhuShuArray = TzResult;
                        break;
                    case 2:
                    case "2":
                        var TzResult = _this.GetFuShi_Fn(CheckBallData);
                        _ZhuShuArray = {};
                        _ZhuShuArray = TzResult;
                        break;
                    case 3:
                    case "3":
                        var TzResult = _this.GetFuShi_Fn(CheckBallData);
                        _ZhuShuArray = {};
                        _ZhuShuArray = TzResult;
                        break;
                    default:
                        break;
                }
            }
            if (_ZhuShuArray == undefined) { _ZhuShuArray = ""; }
            return _ZhuShuArray;
        },
        /**
         * @content 获取彩种的基本参数信息
         * @author  梁汝翔<liangruxiang> 
         * @param CheckBallData 选号数据；
         * @param type "算法类型":1、复式；2、单式、3、胆拖
         * @param start 开始计算投注的时候
         * @returns 返回投注的信息{tzLen:1，tzInfos:""} //投注的长度，和投注的信息 
         * @time 2015年7月28日 10:07:09
         */
        GetFuShi_Fn: function (CheckBallData, start, checklen) {
            var _ZhuShuArray;
            var _theLine = CheckBallData[0].value;  //投注号码数组
            if (_theLine != undefined && _theLine.length > 0) {  //存在选号
                var _theTz_len = _theLine.length;   //获取有多少注

                if (_theTz_len >= start) {  //大于等于4的时候表示开始计算投注

                    _theTz_len = _GameBetobj.ruiec_mathCombin(_theTz_len, checklen);

                } else {
                    _theTz_len = 0;
                }

                //调用_GameBetobj对象的方法“GetArray_ToString”：把数组转换成String类型，以","链接; 
                var _theTz_infos = _GameBetobj.GetArray_ToString(_theLine, " ");
            } else {  //不存在选号
                var _theTz_len = 0;
                var _theTz_infos = "";
            }

            _ZhuShuArray = {};
            _ZhuShuArray.tzLen = _theTz_len;
            _ZhuShuArray.tzInfos = _theTz_infos;

            return _ZhuShuArray;
        },
        /**
         * @content 根据选中的数据，创建order订单：并插入到订单Table里面；
         * @author  梁汝翔<liangruxiang> 
         * @param OrderData 订单的数据对象 {_getLottyCode：_getLottyCode,_tz_infos:_tz_infos,_tz_type:_tz_type,_tz_ZLen:_tz_ZLen,_tz_beishu:_tz_beishu,_tz_Price:_tz_Price}
         * @time 2015年7月28日 10:07:09
         */
        CreatTzOrder_FillInTable: function (OrderData, _AreaContainer) {
            //console.log(OrderData);
            var _this = this;  
            var _Sub_Obj = $("#choice_comfire_btn"); 
            var _theOrderRebate = $("#select_fd").val() == undefined ? "0-0.0" : $("#select_fd").val(); //当前玩法的返点 

            var _theBasicLotteryCode = _this.GetBasicLotteryData(); 

            //查找是否有相同的订单
            var _theCommonOrder = $("#order_table").find("tr[order_code='" + OrderData._tz_infos + "'][order_play_code='" + _theBasicLotteryCode.PlayCode + "']").length; //查找是否有类似的订单 【名称相同】
            var _thePeiLv = $("#choice_comfire_btn").attr("peilv"); //当前赔率
            if (_theCommonOrder > 0) {  //有类似的订单 
                //获取当前tr  这行的对象
                var theLikeTr = $("#order_table").find("tr[order_code='" + OrderData._tz_infos + "'][order_play_code='" + _theBasicLotteryCode.PlayCode + "']");
                
                //获取焦点
                theLikeTr.find(".each_price").eq(0).focus(); 
            } else {

                var strVar = "";
                var theInfos_suolue = OrderData._tz_infos;
                if (theInfos_suolue.length > 15) {
                    theInfos_suolue = theInfos_suolue.substr(0, 10) + "<a href='javascript:void(0)' class='look_mores c_8' value='" + OrderData._tz_infos + "'>详细</a>";
                }

                strVar += "<tr order_play_code='" + _theBasicLotteryCode.PlayCode + "' peilv='" + _thePeiLv + "'  order_type_code='" + OrderData._getLottyCode + "' order_code='" + OrderData._tz_infos + "'>";
                strVar += "	<td><i class=\"order_type\">" + OrderData._tz_type + "  " + theInfos_suolue + "<\/i><\/td>";
                strVar += "	<td><span class='order_zhushu'>总共<i class=\"order_num c_red\">" + OrderData._tz_ZLen + "<\/i>注<\/span><\/td>";
                strVar += "	<td><i class=\"order_price\">每注<input type='text' class='each_price' value='' />元<\/i><\/td>";
                strVar += "	<td><i class=\"c_3\">&nbsp;<span class='hide_this'>每注可赢金额：<i class=\"order_money c_red\"><\/i>元</span><\/td>";
                strVar += "	<td><i class=\"c_org l_cancel\">删除<\/i><\/td>";
                strVar += "<\/tr>";
                 
                //追加order
                $("#order_table").prepend($(strVar));
            }

            

            //清除生成当前的
            _this.clearTzCheckBall(_AreaContainer);

            //统计投注的方案信息
            _this.Tongji_TzOrder();

            //绑定投注的点击事件
            _this.BlindSub_Tz();

            //绑定清空投注的事件
            _this.BlindClearOrder();  

            //绑定删除事件
            _this.deletTrLine();

            //绑定期号选择
            _this.BlindTrChangePrice();

        },
        /**
         * @content 绑定金额变动的JS数据
         * @author  梁汝翔<liangruxiang> 
         * @param Checked_BallInfos 选号的组合数据
         * @return 返回值为数组
         * @time 2015年8月10日 10:07:09
         */
        BlindTrChangePrice: function () {
            var _this = this;
            $("#order_table").on("keyup", ".each_price", function () {
                var _theValue = $(this).val(); 
                _theValue = _theValue.replace(/[^\d]/g, "");
                _theValue = Number(_theValue);
                $(this).val(_theValue); 
                _theValue = isNaN(parseInt(_theValue)) ? "" : parseInt(_theValue); 
                if (_theValue > 0 && _theValue!="") {
                    var _theTrObj = $(this).parents("tr").eq(0);
                    var _thePeiLv = _theTrObj.attr("peilv");  //赔率
                    var _theZhuShu = _theTrObj.find(".order_num").text();  //注数
                    _theZhuShu = isNaN(Number(_theZhuShu)) ? 1 : Number(_theZhuShu);
                    _thePeiLv = isNaN(Number(_thePeiLv)) ? 1 : Number(_thePeiLv);

                    var _theEarmMoney = _thePeiLv * _theValue ;

                    _theEarmMoney = parseFloat(_theEarmMoney).toFixed(2); 
                    _theTrObj.find(".order_money").eq(0).empty().text(_theEarmMoney); //金额
                    _theTrObj.find(".hide_this").eq(0).show();

                    //统计订单
                    _this.Tongji_TzOrder();
                } else {

                    _theValue = 0;
                    var _theTrObj = $(this).parents("tr").eq(0);
                    var _thePeiLv = _theTrObj.attr("peilv");  //赔率
                    var _theZhuShu = _theTrObj.find(".order_num").text();  //注数
                    _theZhuShu = isNaN(Number(_theZhuShu)) ? 1 : Number(_theZhuShu);
                    _thePeiLv = isNaN(Number(_thePeiLv)) ? 1 : Number(_thePeiLv);
                    var _theEarmMoney = _thePeiLv * _theValue;
                    _theEarmMoney = parseFloat(_theEarmMoney).toFixed(2);
                    _theTrObj.find(".order_money").eq(0).empty().text(_theEarmMoney); //金额
                    _theTrObj.find(".hide_this").eq(0).hide();

                    //统计订单
                    _this.Tongji_TzOrder();
                }
            }); 
        },
        /**
         * @content 查看订单容器内的详细信息
         * @author  梁汝翔<liangruxiang> 
         * @param Checked_BallInfos 选号的组合数据
         * @return 返回值为数组
         * @time 2015年8月10日 10:07:09
         */
        BlindLookMore: function () {

       	    $("#order_table").off("click").on("click", ".lottery-details-area .close", function (event) {
       	        event.stopPropagation();
       	        $(this).parents(".lottery-details-area").hide();
       	    });

			$("#order_table").on("click",".order_type a.look_mores",function(event){
				event.stopPropagation();
       	        var theValue = $(this).attr("value");
       	        var _theZhuShu  = $(this).parents("tr").eq(0).find(".order_num").text();
       	        var theLookMore_detail = '<div class="lottery-details-area"><div class="num"><span class="multiple">共 ' + _theZhuShu + ' 注</span><em data-param="action=detailhide" class="close">×</em></div><div class="list">' + theValue + '</div></div>';
       	        
       	        var this_X = event.pageX;
       	        var this_Y = event.pageY;

       	        if ($(this).find(".lottery-details-area").length > 0) {  //查看详细
       	            $(this).find(".lottery-details-area").eq(0).show();
       	        } else { 
       	            $(this).append($(theLookMore_detail));
       	            $(this).find(".lottery-details-area").eq(0).css({
       	                "left": this_X + "px",
       	                "top": this_Y + "px",
       	                "display": 'block',
       	                "position": "absolute"
       	            });
       	        }
                 
       	        return true;
			});
       	   

       	    $(".g_Order_list").mouseleave(function () {
       	        $(".g_Order_list #order_table .lottery-details-area").hide();
       	    });
  
       	},
        /**
         * @content 根据组合数据，拆分成不同的组合对象
         * @author  梁汝翔<liangruxiang> 
         * @param Checked_BallInfos 选号的组合数据
         * @return 返回值为数组
         * @time 2015年8月10日 10:07:09
         */
        getOrderArray: function (Checked_BallInfos,playcode) {
            var theResultS = "";
            if (Checked_BallInfos != "") { 
                Checked_BallInfos = Checked_BallInfos.replace(/\]/g, ",");
                Checked_BallInfos = Checked_BallInfos.replace(/\*/g, "");
                var theIndexOf_S = Checked_BallInfos.indexOf('[');
                if (theIndexOf_S > 0) {
                    Checked_BallInfos = Checked_BallInfos.split("[")[1];
                }
            }  
            theResultS = Checked_BallInfos.split(","); 
            return theResultS;
        },
        /**
         * @content 清除投注记录的方法
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         *  @time 2015年7月28日 10:07:09
         */
        ReverseSelectionBall: function () {

            var _this = this;

            $("#order_table tbody tr").unbind("click").click(function () {
                var theTr = $(this);
                var _the_order_type_code = theTr.attr("order_type_code");  //彩种编码 
                var _the_order_play_code = theTr.attr("order_play_code");  //玩法编码

                var _the_OrderValue = theTr.attr("order_code");    //选球

                var _theTz_len = theTr.find(".order_num").eq(0).text();  //投注的数量
                var _theTz_multiple = theTr.find(".order_multiple").eq(0).text();  //投注的倍数
                var _theTz_unit = theTr.find(".order_unit").eq(0).attr("unit_num");  //投注的单位

                if (_the_OrderValue != "") {

                    var _thePlay_Codes = $("#j_play_select .play_select_cont dd[lottery_code='" + _the_order_play_code + "']").eq(0);
                    var _thePlayParent_Codes = _thePlay_Codes.parents("li").eq(0).attr("lottery_code");
                    var _thePlayParent_Obj = $("#j_play_select .play_select_tit li[lottery_code='" + _thePlayParent_Codes + "']").eq(0);

                    var theCurrText = _thePlay_Codes.text();
                    if (theCurrText != "通选") {
                        _thePlayParent_Obj.click();
                        _thePlay_Codes.click();

                        var _theOrder_randId = "Edit_CheckBall_" + _the_order_type_code + "_" + _the_order_play_code + "_" + parseInt(Math.random() * 10000);
                        theTr.attr("editorid", _theOrder_randId);
                        var _theContainer_Id = "Play_BallArea_" + _the_order_type_code + "_" + _the_order_play_code;


                        //清除生成当前的
                        _this.clearTzCheckBall($("#Play_BallArea_" + _the_order_type_code + "_" + _the_order_play_code));

                        /**
                         * @content 根据组合数据，拆分成不同的组合对象
                         * @author  梁汝翔<liangruxiang> 
                         * @param _CheckBall 选号的组合数据
                         * @time 2015年8月10日 10:07:09
                         */
                        var _theOrder_Array = _this.getOrderArray(_the_OrderValue, _thePlay_Codes);
                        if (_theOrder_Array.length > 0) {

                            var _Ball_ListContObj = $("#" + _theContainer_Id + " .gn_main_list");
                            for (var i = 0 ; i < _theOrder_Array.length ; i++) {

                                var LineCheckBall = _theOrder_Array[i].split(" ");
                                var CheckBallLine = _Ball_ListContObj.find("li.li_ball").eq(i);
                                if (LineCheckBall != undefined && LineCheckBall.length > 0) {
                                    for (var j = 0 ; j < LineCheckBall.length ; j++) {

                                        var _thisValue = LineCheckBall[j];
                                        var _thisBall = CheckBallLine.find("*[ball-number='" + _thisValue + "']");

                                        if (_thisBall.hasClass("curr")) {
                                            $("#choice_zhu").empty().text(_theTz_len);
                                            $("#choice_zhu").empty().text(_theTz_len);
                                        } else {
                                            CheckBallLine.find("*[ball-number='" + _thisValue + "']").click();
                                        }
                                    }
                                }
                            }
                        }

                        var theMoneys = isNaN(Number(_theTz_multiple * _theTz_len * _theTz_unit * 2)) ? 0.00 : Number(_theTz_multiple * _theTz_len * _theTz_unit * 2);

                        $("#choice_Multiple").val(_theTz_multiple);
                        $("#choice_money").val(theMoneys);
                        $("#choice_Unit").find("option[value='" + _theTz_unit + "']").prop("selected", true);
                        //修改提交按钮的信息
                        $("#choice_comfire_btn").attr("editorId", _theOrder_randId);
                        $("#choice_comfire_btn em").empty().text("修改好了");
                    } else {
                         
                        _thePlayParent_Obj.click();
                        _thePlay_Codes.click();

                        var _theOrder_randId = "Edit_CheckBall_" + _the_order_type_code + "_" + _the_order_play_code + "_" + parseInt(Math.random() * 10000);
                        theTr.attr("editorid", _theOrder_randId);
                        var _theContainer_Id = "Play_BallArea_" + _the_order_type_code + "_" + _the_order_play_code;


                        //清除生成当前的
                        _this.clearTzCheckBall($("#Play_BallArea_" + _the_order_type_code + "_" + _the_order_play_code));

                        /**
                         * @content 根据组合数据，拆分成不同的组合对象
                         * @author  梁汝翔<liangruxiang> 
                         * @param _CheckBall 选号的组合数据
                         * @time 2015年8月10日 10:07:09
                         */
                        var _theOrder_Array = _this.getOrderArray(_the_OrderValue);

                        //console.log(_theOrder_Array);
                        if (_theOrder_Array.length > 0) {

                            var _Ball_ListContObj = $("#" + _theContainer_Id + " .gn_main_list");

                            var LineCheckBall = _theOrder_Array[0];
                            var CheckBallLine = _Ball_ListContObj.find("li.li_ball").eq(0);

                            var _thisBall = CheckBallLine.find("*[ball-number='" + LineCheckBall + "']");
                            if (_thisBall.hasClass("curr")) {
                                $("#choice_zhu").empty().text(_theTz_len);
                                $("#choice_zhu").empty().text(_theTz_len);
                            } else {
                                CheckBallLine.find("*[ball-number='" + LineCheckBall + "']").click();
                            }
                        }

                        var theMoneys = isNaN(Number(_theTz_multiple * _theTz_len * _theTz_unit * 2)) ? 0.00 : Number(_theTz_multiple * _theTz_len * _theTz_unit * 2);

                        $("#choice_Multiple").val(_theTz_multiple);
                        $("#choice_money").val(theMoneys);
                        $("#choice_Unit").find("option[value='" + _theTz_unit + "']").prop("selected", true);
                        //修改提交按钮的信息
                        $("#choice_comfire_btn").attr("editorId", _theOrder_randId);
                        $("#choice_comfire_btn em").empty().text("修改好了");
                    }
                }

            });

        },
        /**
         * @content 清除投注记录的方法
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         *  @time 2015年7月28日 10:07:09
         */
        clearTzCheckBall: function (_AreaContainer) {
            _AreaContainer.find(".li_ball .ball_number").each(function () {
                if ($(this).hasClass("curr")) {
                    $(this).removeClass("curr");
                }
            }); 

            if (_AreaContainer.find(".ball_String").length > 0) {
                _AreaContainer.find(".ball_String").each(function () {
                    if ($(this).hasClass("curr")) {
                        $(this).removeClass("curr");
                    }
                });
            }

            if (_AreaContainer.find(".ds_textarea").length > 0) {
                _AreaContainer.find(".ds_textarea").eq(0).val("");
                _AreaContainer.find(".ds_textarea").eq(0).next(".ds_text").show();
            }

            //清除投注信息
            $("#choice_zhu").empty().text("0");
            /*$("#choice_Multiple").find("option").eq(0).prop("selected", true);
            $("#choice_Unit").find("option").eq(0).prop("selected", true);*/
            $("#choice_money").empty().text("0.00");
        },
        /**
         * @content 获取投注方案的信息
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         * @time 2015年7月28日 10:07:09
         */
        Tongji_TzOrder: function () {

            var _OrderContainer = $("#order_table");

            //获取投注的数量
            var _Order_TzLen = 0;
            var _Order_Price = 0;

            //遍历每一行
            _OrderContainer.find("tr").each(function () {
                var _theTrObj = $(this); //当前行
                var _Line_Tz = _theTrObj.find(".order_num").eq(0).text(); //获取每一行的投注
                var _Line_Price = _theTrObj.find(".each_price").val(); //获取每一行的投注  

                _Line_Tz = isNaN(parseInt(_Line_Tz)) ? 0 : parseInt(_Line_Tz);
                _Line_Price = isNaN(parseFloat(_Line_Price)) ? 0 : parseFloat(_Line_Price);

                _Line_Price = _Line_Price * _Line_Tz ;  
          
                _Order_TzLen += _Line_Tz;
                _Order_Price += _Line_Price; 
            });

            _Order_TzLen = parseFloat(_Order_TzLen);
            _Order_Price = parseFloat(_Order_Price).toFixed(2);

            $("#f_gameOrder_lotterys_num").empty().text(_Order_TzLen);
            $("#f_gameOrder_amount").empty().text(_Order_Price);

            var TzOrderInfos = {};
            TzOrderInfos.TzLen = _Order_TzLen;
            TzOrderInfos.TzPrice = _Order_Price;  
        },
        /**
         * @content 绑定立即下单的点击事件
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         * @time 2015年7月28日 10:07:09
         */
        BlindClearOrder: function () {
            var _this = this;
            $("#order_empty").unbind("click").click(function () {
                $("#order_table tbody").empty();
                $("#choice_comfire_btn").removeAttr("editorid");
                $("#choice_comfire_btn em").empty().text("确定选号");
                _this.Tongji_TzOrder();
                $("#isZigou").trigger("click");
            });
        }, 
        /**
         * @content 绑定立即下单的点击事件
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         * @time 2015年7月28日 10:07:09
         */
        BlindSub_Tz: function () {
            var _this = this;
            //绑定确定投注信息
            $("#f_submit_order").unbind("click").click(function (event) {
                event.stopPropagation();

                var this_state_btn = $(this).attr("state");
                if (this_state_btn == undefined || this_state_btn == "true") {
                    //投注方案的模式 
                    var _TZ_model = $(".chase_Program").find("input[name='rad']:checked").val() == undefined ? 0 : $(".chase_Program").find("input[name='rad']:checked").val();
                    var _theResult = _this._check_MaxBettingNumber();
                    if (_theResult.length > 0) {
                        var PlayCodes = "";
                        for (var j = 0 ; j < _theResult.length ; j++) { 
                            PlayCodes += _theResult[j].playCodeName + "、";
                        }
                        if (PlayCodes.length > 0) {
                            PlayCodes = PlayCodes.substr(0, PlayCodes.length - 1);
                        }
                        alert("当前彩种的：" + PlayCodes + "的玩法，投注注数超出了相应的单方案最大投注量。");
                        return false;
                    } 
              
                    _this.Normal_SubTzOrder($(this));  //提交
                     
                }
            });
            return true;
        },
        /**
         * @content 获取投注方案的信息
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         * @time 2015年7月28日 10:07:09
         */
        Normal_SubTzOrder: function (_btnObj) {

        	if(parseFloat($("#f_gameOrder_amount").text())>0 && $("#order_table tr").size()>0)
        	{
	        	var _this = this ; 
	            var theAction = "AddBetting" , statesub = true ;
	            var comfire_tit = $(".g_Time_Section .cz_logo h2").text();  
	        	var comfire_first_item=$("#f_lottery_info_number").text();
	        	var comfire_last_item=$("#f_chase_table_insert tr").last().find(".chase_row_number").attr("issuecode");
	        	var comfire_qi=$("#f_trace_statistics_times").text();
	        	var comfire_order="";
	        	var comfire_amount = $("#f_gameOrder_amount").text();
	        	var comfire_user = $("#top_userName").text(), Max_Values = $("#EachMaxLotteryValue").val() == undefined ? 200000 : $("#EachMaxLotteryValue").val();
	        	for(a=0;a<$("#order_table tr").size();a++)
	        	{
	        		var comfire_order_item ="<p>"+$("#order_table tr").eq(a).find(".order_type").text()+"</p>"
	        		comfire_order = comfire_order + comfire_order_item
	        	};
	        	var strVar = "";
				    strVar += "<div class=\"submitComfire\">";
				    strVar += "	<ul class=\"ui-form\">";
				    strVar += "		<li><label for=\"question1\" class=\"ui-label\">彩种：<\/label><span class=\"ui-text-info\">"+comfire_tit+"<\/span><\/li>";
				    strVar += "		<li><label for=\"question1\" class=\"ui-label\">期号：<\/label><span class=\"ui-text-info\">第"+comfire_first_item+" 期<\/li>";
				    strVar += "		<li><label for=\"answer1\" class=\"ui-label\">详情：<\/label>";
				    strVar += "		<div class=\"textarea\" style=\"font-size:12px;\">";
				    strVar += comfire_order;
				    strVar += "		<\/div>";
				    strVar += "		<\/li>";
				    strVar += "		<li><label for=\"question2\" class=\"ui-label\">付款总金额：<\/label><span class=\"ui-text-info\"><span class=\"c_red\">"+comfire_amount+"<\/span>元<\/span><\/li>";
				    strVar += "		<li><label for=\"question2\" class=\"ui-label\">付款帐号：<\/label><span class=\"ui-text-info\"><span class=\"c_red\">"+comfire_user+"<\/span><\/span><\/li>";
				    strVar += "		<li><label for=\"question2\" class=\"ui-label\">温馨提示：本平台每单最高奖金限额<i class='c_red'>" + Max_Values + "</i>元，请会员谨慎投注！<\/li>";
				    strVar += "	<\/ul>";
				    strVar += "	<p class=\"text-note\">";
				    strVar += "	<\/p>";
				    strVar += "	<p class=\"text-note\">";
				    strVar += "	<\/p>";
				    strVar += "<\/div>";


	        	artDialog({
	        		content:strVar,
	        		cancel:function(){},
	        		ok:function(){
	        			var _OrderContainer = $("#order_table");
			            //获取投注列表的统计数据
	        			var theDatas = _this.GetTzOrderInfos(_OrderContainer, statesub);

	        			if (!theDatas.statesub) {
	        			    alert("请正确填写，选号区域内每注的金额，金额不能为空且只能是整数"); 
	        			    return false;
	        			} else {
	        			    var theData = theDatas.Bettings;
	        			    if (typeof theData == "object" && theData.length > 0 && theAction != "") { 
	        			        var NewTzObj = {};
	        			        NewTzObj.BettingData = theData;

	        			        var theStringData = _GameBetobj.Json_To_String(NewTzObj);

	        			        _btnObj.attr("state", "false");

	        			        $.ajax({
	        			            type: "POST",
	        			            url: "../tools/ssc_ajax.ashx",
	        			            data: {
	        			                action: theAction,
	        			                data: theStringData
	        			            },
	        			            dataType: "json",
	        			            success: function (data) {
	        			                if (data && data.Code == "1") {
	        			                    artDialog({
	        			                        content: data.StrCode,
	        			                        icon: "success",
	        			                        lock: true,
	        			                        ok: function () {
	        			                            $("html,body").animate({ "scrollTop": "0px" });
	        			                        },
	        			                        close: function () {
	        			                            $("html,body").animate({ "scrollTop": "0px" });
	        			                        }
	        			                    })
	        			                    _btnObj.attr("state", "true");

	        			                    //清除投注信息
	        			                    _this.clear_sub_form();
	        			                    //更新投注方案
	        			                    _GameBetobj.ruiec_getMyProject();

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
	        			                        }
	        			                    })

	        			                    _btnObj.attr("state", "true");
	        			                }
	        			            }
	        			        });
	        			    }
	        			} 
	        		},
	        		lock:true
	        	})
        	}
        	else
        	{
        		artDialog({
        			icon:"warning",
        			content:"请至少选择一注投注号码！",
        			close:function(){},
        			closeMsg:"关闭",
        			lock:true
        		})
        	};
            
        

            //{"BettingData":[{"lottery_code":null,"play_detail_code":null,"betting_issuseNo":null,"betting_number":null,"betting_money":0.0,"betting_count":0,"graduation_count":0,"betting_point":null,"betting_model":0.0},{"lottery_code":null,"play_detail_code":null,"betting_issuseNo":null,"betting_number":null,"betting_money":0.0,"betting_count":0,"graduation_count":0,"betting_point":null,"betting_model":0.0}]}
            
            
        },
       /**
        * @content 获取投注列表的统计数据
        * @author  梁汝翔<liangruxiang> 
        * @param _CheckBall 选号的组合数据
        * @time 2015年7月28日 10:07:09
        */
        GetTzOrderInfos: function (_OrderContainer, statesub) {
            var _this = this;
            var theObjs = {};
            var theData = new Array;
            var _ThisLotteryCode = $("#f_lottery_info_number").text() == undefined ? "20150808" : $("#f_lottery_info_number").text();  //期号
            var _ThisLottery_Point = "13";  //返点
            //遍历每一行
            _OrderContainer.find("tr").each(function () {
                if (statesub) {
                    var _TrObj = {};
                    var _theTrObj = $(this); //当前行 
                    var _Line_Lottery_code = _theTrObj.attr("order_type_code");  //彩种
                    var _Line_play_detail_code = _theTrObj.attr("order_play_code");  //玩法编码
                    var _Line_betting_issuseNo = _ThisLotteryCode; //期号
                    var _Line_betting_number = _theTrObj.attr("order_code"); //投注号码
                    var _Line_betting_count = Number(_theTrObj.find(".order_num").eq(0).text()); //投注的注数 
                    var _Line_graduation_count = 1;  //投注的倍数 
                    var _Line_betting_money = Number(_theTrObj.find(".each_price").eq(0).val());  //投注的金额 

                    _Line_betting_money = isNaN(parseInt(_Line_betting_money)) ? 0 : parseInt(_Line_betting_money);

                    _Line_betting_money = _Line_betting_count * _Line_betting_money; 

                    var _Line_betting_point = "0-0.0";  //返点
                    var _Line_betting_model = 1; //单位

                    _TrObj.lottery_code = _Line_Lottery_code;
                    _TrObj.play_detail_code = _Line_play_detail_code;
                    _TrObj.betting_issuseNo = _Line_betting_issuseNo;
                    _TrObj.betting_number = _Line_betting_number;
                    _TrObj.betting_count = _Line_betting_count;
                    _TrObj.graduation_count = _Line_graduation_count;
                    _TrObj.betting_money = _Line_betting_money;
                    _TrObj.betting_point = _Line_betting_point;
                    _TrObj.betting_model = _Line_betting_model;

                    if (_Line_betting_money == 0 || _Line_betting_count <= 0) {
                        statesub = false;
                    } 
                    theData.push(_TrObj);
                }   
            }); 
            theObjs.statesub = statesub;
            theObjs.Bettings = theData;
            return theObjs;
        }, 
        /**
         * @content 清除已经提交的投注信息
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         * @time 2015年7月28日 10:07:09
         */
        clear_sub_form: function () {
            $("#order_table tbody").empty();
            $(".ball_number").removeClass("Checked");
            this.Tongji_TzOrder();
        },
        /**
         * @content 验证每一行的格式
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         * @time 2015年7月28日 10:07:09
         */
        checkOrderInfo: function (VerifyData) { 
            var _this = this;
            var theResult = true;
            if (typeof VerifyData == "object") {
                var _theObj = VerifyData;

                var _checkNumb = _this.CheckOrderNumber(_theObj.betting_number);
                if (!_checkNumb) { theResult = false; }

                if (isNaN(Number(_theObj.betting_count))) { theResult = false; }
                if (isNaN(Number(_theObj.graduation_count))) { theResult = false; }
                //if (isNaN(Number(_theObj.betting_point))) { theResult = false; }
                if (isNaN(Number(_theObj.betting_model))) { theResult = false; }
                if (isNaN(Number(_theObj.betting_money))) {
                    theResult = false;
                } else {
                    var theValue = Number(_theObj.betting_count) * Number(_theObj.graduation_count) * Number(_theObj.betting_model) * 2;
                    if (theValue != Number(_theObj.betting_money)) {
                        theResult = false;
                    }
                }
            }
            return theResult;
        },
        /**
         * @content 验证每一行的号码格式是否正确
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         * @time 2015年7月28日 10:07:09
         */
        CheckOrderNumber: function (NumberString) {
            var _this = this;
            var VerifyNumber = true;

            /**
             * @content 根据组合数据，拆分成不同的组合对象
             * @author  梁汝翔<liangruxiang> 
             * @param _CheckBall 选号的组合数据
             * @time 2015年8月10日 10:07:09
             */
            var _theOrder_Array = _this.getOrderArray(NumberString);
            if (_theOrder_Array.length > 0) {
                for (var i = 0 ; i < _theOrder_Array.length ; i++) {
                    var LineCheckBall = _theOrder_Array[i].split(" ");
                    if (LineCheckBall != undefined && LineCheckBall.length > 0) {
                        for (var j = 0 ; j < LineCheckBall.length ; j++) {

                            var _thisValue = $.trim(LineCheckBall[j]);
                            if (_thisValue != "") {
                                if (isNaN(Number(_thisValue))) { VerifyNumber = false; }
                            }
                        }
                    }
                }
            }
            return VerifyNumber;
        },
        /**
         * @content 过滤数据，生成程序需要的数据
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         * @time 2015年7月28日 10:07:09
         */
        Filtering_data: function (NumberString,play_code) {
            var _this = this; 
            var _newNumberString = NumberString;
            /**
            * @content 根据组合数据，拆分成不同的组合对象
            * @author  梁汝翔<liangruxiang> 
            * @param _CheckBall 选号的组合数据
            * @time 2015年8月10日 10:07:09
            */
            var _theOrder_Array = _this.getOrderArray(NumberString, play_code);
            if ( play_code != "1301F10") {
                _newNumberString = _GameBetobj.GetArray_ToString(_theOrder_Array, ",");
            } else {
                _newNumberString = _GameBetobj.GetArray_ToString(_theOrder_Array, " ");
            } 
            return _newNumberString;
        },
        /**
         * @content 验证每一行的格式
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         * @time 2015年7月28日 10:07:09
         */
        checkOrderInfoByArray: function (verifyString) {
            var ResultString = true;
            verifyString = $.trim(verifyString); 
            var verifyStringArray = ['11*', '22*', '33*', '44*', '55*', '66*', '三连号通选','三同号通选']; 
            if (verifyString != "") {
                var theVerifyString = verifyString.split(",");
                if (theVerifyString.length > 0) {
                    for (var i = 0 ; i < theVerifyString.length ; i++) {
                        var theVaues = theVerifyString[i];
                        var _InArray = _GameBetobj.CheckStrInArray(theVaues, verifyStringArray);  //验证字符串是否在数组内 
                        if (!_InArray) { ResultString = false; }
                    }
                }
            } else {
                ResultString = false;
            }  
            return ResultString;
        },
        /**
         * @content 删除投注订单
         * @author  梁汝翔<liangruxiang>  
         * @time 2015年7月28日 10:07:09
         */
        deletTrLine: function () {
            var me = this
            $("#order_table").on("click", ".l_cancel", function (event) {

                var _thePlayCode = $(this).parents("tr").attr("order_play_code"); //玩法编码
                if (_thePlayCode && _thePlayCode.length > 5) {
                    var _thePlayCodeVal = _thePlayCode.substr(4, _thePlayCode.length);
                    if (_thePlayCodeVal == "A10") { 
                        var _theValues = $(this).parents("tr").attr("order_code"); //玩法编码
                        var _theLotteryCode = $(this).parents("tr").attr("order_type_code");
                        $("#Play_BallArea_" + _theLotteryCode + "_" + _thePlayCode).find(".ball_number[ball-number='" + _theValues + "']").removeClass("Checked"); 
                    }
                }

                $(this).parents("tr").eq(0).remove();

                //清除编辑信息
                $("#choice_comfire_btn").removeAttr("editorid");
                //清除投注信息
                me.Tongji_TzOrder();
            });
        },
        /**
        * @content 初始化彩种遗漏数据
        * @name 梁汝翔<liangruxiang>
        * @param data 当前彩种的遗漏冷热数据
        * @param playcode 玩法编码
        * @param type 遗漏、冷热 type 为undefined 为 遗漏，2 为冷热
        * @time 2015年08月13日 16:58:00
        */
        _Init_CaiZhongLost: function (data, playcode, type) {
            ////console.log("当前遗漏数据为", data);
            //获取当前玩法是否需要展示遗漏
            var thePlayContainer = $("#Play_BallArea_1301_" + playcode);
            if (thePlayContainer.find(".gn_main_tit").length > 0 && data != undefined) {
                if (data.State != undefined && data.State == 1) {  //存在遗漏数据
                    //遍历投注选球行
                    thePlayContainer.find(".li_ball").each(function () {
                        //获取当前行的名称
                        var The_Line_Name = $(this).find(".ball_tit strong").text() == undefined ? "" : $(this).find(".ball_tit strong").text();

                        //每一行的数据
                        var The_Line_Data;
                        switch (The_Line_Name) {
                            case "个位":
                                The_Line_Data = data.Body.Ge == undefined ? [] : data.Body.Ge;  //当前行数据 
                                break;
                            case "十位":
                                The_Line_Data = data.Body.Shi == undefined ? [] : data.Body.Shi;  //当前行数据 
                                break;
                            case "百位":
                                The_Line_Data = data.Body.Bai == undefined ? [] : data.Body.Bai;  //当前行数据 
                                break;
                            case "千位":
                                The_Line_Data = data.Body.Qian == undefined ? [] : data.Body.Qian;  //当前行数据 
                                break;
                            case "万位":
                                The_Line_Data = data.Body.Wan == undefined ? [] : data.Body.Wan;  //当前行数据 
                                break;
                            case "":  //直选或者跨度
                                The_Line_Data = data.Body == undefined ? [] : data.Body;  //当前行数据  
                                break;
                            default:
                                The_Line_Data = [];
                                break;
                        }

                        var The_LineBall_len = $(this).find(".ball_aid").length;  //共多少个选球的遗漏 
                        if (The_LineBall_len <= The_Line_Data.length) { //只有当遗漏的数据，大于或者等于 选球号时才肯能正确
                            for (var i = 0 ; i < The_LineBall_len ; i++) {
                                var theLostValue = The_Line_Data[i] < 0 ? 0 : The_Line_Data[i];
                                $(this).find(".ball_aid").eq(i).empty().html(theLostValue);
                            }
                        }
                    });
                }
            }
        },
        /**
         * @content 初始化彩种冷热数据
         * @name 梁汝翔<liangruxiang>
         * @param data 当前彩种的遗漏冷热数据
         * @param playcode 玩法编码
         * @param type 遗漏、冷热 type 为undefined 为 遗漏，2 为冷热
         * @time 2015年08月13日 16:58:00
         */
        _Init_CaiZhongHotColl: function (data, playcode, type) {
            ////console.log("当前冷热数据为", data);
            //获取当前玩法是否需要展示遗漏
            var thePlayContainer = $("#Play_BallArea_1301_" + playcode);
            if (thePlayContainer.find(".gn_main_tit").length > 0 && data != undefined) {
                if (data.State != undefined && data.State == 1) {  //存在遗漏数据
                    //遍历投注选球行
                    thePlayContainer.find(".li_ball").each(function () {
                        //获取当前行的名称
                        var The_Line_Name = $(this).find(".ball_tit strong").text() == undefined ? "" : $(this).find(".ball_tit strong").text();

                        //每一行的数据
                        var The_Line_Data;
                        switch (The_Line_Name) {
                            case "个位":
                                The_Line_Data = data.Body.Ge == undefined ? [] : data.Body.Ge;  //当前行数据 
                                break;
                            case "十位":
                                The_Line_Data = data.Body.Shi == undefined ? [] : data.Body.Shi;  //当前行数据 
                                break;
                            case "百位":
                                The_Line_Data = data.Body.Bai == undefined ? [] : data.Body.Bai;  //当前行数据 
                                break;
                            case "千位":
                                The_Line_Data = data.Body.Qian == undefined ? [] : data.Body.Qian;  //当前行数据 
                                break;
                            case "万位":
                                The_Line_Data = data.Body.Wan == undefined ? [] : data.Body.Wan;  //当前行数据 
                                break;
                            case "":  //直选或者跨度
                                The_Line_Data = data.Body == undefined ? [] : data.Body;  //当前行数据  
                                break;
                            default:
                                The_Line_Data = [];
                                break;
                        }

                        var The_LineBall_len = $(this).find(".ball_aid").length;  //共多少个选球的遗漏 
                        if (The_LineBall_len <= The_Line_Data.length) { //只有当遗漏的数据，大于或者等于 选球号时才肯能正确
                            for (var i = 0 ; i < The_LineBall_len ; i++) {
                                var theLostValue = The_Line_Data[i] < 0 ? 0 : The_Line_Data[i];
                                $(this).find(".ball_aid").eq(i).empty().html(theLostValue);
                            }
                        }
                    });
                }
            }
        },
        /**
         * @content 获取开奖时间列表
         * @name 王志豪<wangzhihao>
         * @param oLotteryCode是当前彩种编码，oAjaxUrl获取到的ajax提交路径
         * @time 2015年08月13日 16:58:00
         */
        ruiec_getOpenTimeList:function(oLotteryCode,oAjaxUrl){
            var me = _GameBetobj;
            $.ajax({
                type: "POST",
                url: oAjaxUrl,
                data: { "action": "get_lottery_open_Issuse_list","lottery_code":oLotteryCode},
                dataType: "json",
                success: function (data) {
                	////console.log(data);
                    if(data)
                    {
	                    var openTimeList=[];  //重组的开奖期号对应的时间
                    	var oLastIssue = data.issuse_no; //最后一期的期号
	                    var oLastOpenTime = data.open_time; //最后一期的开奖时间
	                    var oLastOpenTimeS =  me.ruiec_TimeToDate(oLastOpenTime);  //最后一期的开奖时间戳
	                    var oLastOpenNum = data.open_num; //最后一期的开奖号码
	                    var oFendan = data.open_issuse_time_list  //封单时间
	                    var oLastOpenTime_split = oLastOpenTime.split(" ")[1]; //获取追后一期的开奖时间区间如:17:32:49
                       	oFendan = oFendan[0].single_letter;  //封单时间(秒)
                       	oLastOpenTime_split=me.ruiec_TimeToDate(oLastOpenTime_split,"time")*1000;
                        var oList = data.open_issuse_time_list;
                        for(var a in oList)  //找出上一期开奖的索引值
                        {
                        	 var a = parseInt(a);
                        	 var begin_time1 = oList[a].begin_time1; //开始时间
                             var end_time1 = oList[a].end_time1; //结束时间
                             begin_time1 = me.ruiec_TimeToDate(begin_time1,"time")*1000;
                             end_time1 = me.ruiec_TimeToDate(end_time1,"time")*1000;
                             if(a<oList.length-1)
                             {
                             	 var begin_time2 =oList[a+1].begin_time1;  //下期的开奖时间
                             	 begin_time2 = me.ruiec_TimeToDate(begin_time2,"time")*1000;
	                         	 if(oLastOpenTime_split>=begin_time1 && oLastOpenTime_split<begin_time2)
	                             {
	                             	var oIndex = a;  //找到上一期所处时间区间的索引
	                             }
                             }
                             else
                             {
                             	 if(oLastOpenTime_split>=begin_time1 && oLastOpenTime_split<end_time1)
	                             {
	                             	var oIndex = a;  //找到上一期所处时间区间的索引
	                             }
                             };
                        };
                        if(oIndex!=0)
                        {
                        	if(oIndex=='' || oIndex==undefined )
	                       	{
	                       		oIndex = oList.length-1;
	                       	};
                        };
                        
                        oLastIssue_last = Number(oLastIssue.substring(8,oLastIssue.length)) //023转23
                        var oTodayTime=me.ruiec_returnNextDayTime(0);  //今日凌晨的时间
                        var oFirstOpenDate=oList[0].begin_time1;  //第一期的开奖时间
                        oFirstOpenDate = oTodayTime + parseInt(me.ruiec_TimeToDate(oFirstOpenDate,"time")*1000);
            			for(var i=0;i<5;i++)
                        {
                        	if(oLastOpenTimeS>=oFirstOpenDate)
                        	{
                        		var oNextTime = me.ruiec_returnNextDayTime(i); //获取下i-1天零点的时间戳
                        	}
                        	else
                        	{
                        		var oNextTime = me.ruiec_returnNextDayTime(i-1); //获取下i-1天零点的时间戳
                        	}
                        	
                            var newBeginTime = 0;
                            var newEndTime = 0;
                            var newIssue = "";
                        	for(var a in oList)
                        	{
                        		var openTimeList_item = {};
                        		var begin_time1 = oList[a].begin_time1; //开始时间
                        		var end_time1 = oList[a].end_time1; //结束时间
                        		 

                                newBeginTime = oNextTime + me.ruiec_TimeToDate(begin_time1,"time")*1000;
                                newEndTime = oNextTime + me.ruiec_TimeToDate(end_time1,"time")*1000;
                                
                                newIssue = $.trim(me.ruiec_DateToTime(newEndTime,1));  //获取日期
                        		var oCha = a - oIndex;  //当前的与索引的差
                        		var issue_No = oLastIssue_last + oCha;
                        		if(issue_No<=0)
                        		{
                        			issue_No = issue_No + oList.length;
                        		}
                        		if(issue_No>oList.length)
                        		{
                        			issue_No = issue_No - oList.length;
                        		};
                    			if(issue_No<10)
                        		{
                        			issue_No = "00" + issue_No;
                        		}
                        		else if(issue_No>=10 && issue_No<100)
                        		{
                        			issue_No = "0" + issue_No;
                        		}
                        		
                                newIssue = me.ruiec_removeSplit(newIssue,"-") + issue_No;   //日期转字符串+期号
                                openTimeList_item.newBeginTime = newBeginTime;
                                openTimeList_item.newEndTime = newEndTime;
                                openTimeList_item.newIssue = newIssue;
                                openTimeList_item.newBeginDate = me.ruiec_DateToTime(newBeginTime,3)
                                openTimeList_item.newEndDate = me.ruiec_DateToTime(newEndTime,3)
                                openTimeList.push(openTimeList_item);
                        	};
                        };
                        
                    };
		        	
                    ////console.log(openTimeList);
                    //当前期号及倒计时赋值
                    me.ruiec_showNowIussue(openTimeList,oLastIssue,oLastOpenTime,oLastOpenNum,oFendan,oLotteryCode,oAjaxUrl);
		        	
		        	
                   //追号模式选择
                    $("#isChase").click(function(){
                    	var oNowIssue = parseInt($("#f_lottery_info_number").text());
                        var oCheck = $(this).children("input").prop("checked");
                        if(oCheck == true)
                        {
                            //生成追号记录
                            me.ruiec_showZhuiHao(openTimeList,oNowIssue,10,0);
                            //追号操作
                            me.ruiec_controlZhuiHao(openTimeList,oNowIssue,10);
				        	
                            //生成高级追号起始期号
                            me.ruiec_showHighZhuiHao(openTimeList,oNowIssue);
				        	
                            //点击“生成追号计划”生成高级追号记录
                            me.ruiec_showHighZhuiHaoPlan(openTimeList,oNowIssue);
                            
                            //追号注数结算
                            me.ruiec_AccountZhuiHao();
                        };
                    });
		        	
		        	
                    return openTimeList;
                }
            });
        },
        /**
         * @content 单挑模式，限制每个方案中，每个玩法的最大投注数量
         * @name 梁汝翔<liangruxiang>  
         * @return 返回限制是否通过，不通过的是那个玩法
         * @time 2015年08月13日 16:58:00
         */
        _check_MaxBettingNumber: function () {

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
                var _The_BettingNumb = 0, TheLineOjb = {}, TheBettingName = "";

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
        }
    }

    //开始，初始化执行
    $.extend({ Lottery_Basic_Fn: Lottery_Basic_Fn });
	var Lottery_Basic_Fn = new Lottery_Basic_Fn();
	Lottery_Basic_Fn.init();


})(jQuery, $.ruiec_GameBet)