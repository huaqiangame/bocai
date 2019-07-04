// JavaScript Document 
// +---------------------------------------------------------------------- 
// | Date: 2015年7月20日 21:00:00
// +----------------------------------------------------------------------
// | Name: GameBet.js (投注中心核心功能js )
// +----------------------------------------------------------------------

(function ($) {
    var ruiec_GameBet = function () {
        this.param = "";
    };
    var _GL_Openinits = 0;
    var _GetOpenNumbers, _oAjaxUrl, _lottery_code, _thisIssueTime_No, _GetsetInterval, GetMyfangan_TimeOut, GetTodayOpenTime , ds_ajaxStatue; //获取开奖号码
    var _PlayDetail_Array = []; //玩法对象 

    ruiec_GameBet.prototype = {
        init: function (setOption) {
            //console.log(setOption);
            var me = this;
            //获取当前链接的彩参数
            var oLotteryCode = this.ruiec_returnLottery();
            var oAjaxUrl = setOption.Js_Url+"/../../tools/ssc_ajax.ashx" //ajax接口地址
			
            this.param.oAjaxUrl = oAjaxUrl;


            //页面加载调用一些基本效果
            this.ruiec_docReady(setOption);

            //根据链接参数获取对应的彩种分类数据、加载到页面上去
            if (setOption != undefined) {
                this.ruiec_getLotteryData(oLotteryCode, setOption);
            } else {
                this.ruiec_getLotteryData(oLotteryCode);
            }

            //绑定今日开奖记录加载
            var oTodayOpen = this.ruiec_todayOpen(oLotteryCode,oAjaxUrl);
            //每隔五秒更新今日开奖数据
			
			//更新服务器时间
            me.ruiec_updateServerTime();
            
            //每隔十秒更新服务器时间
            setInterval(function(){
            	me.ruiec_updateServerTime();
            },15000);

			//每秒累加服务器时间
			setInterval(function(){
				me.ruiec_addServerTime();
			},1000);

            //更新玩法投注限定
            me.setBettingAuthority();
			
			//数字input加减箭头(ie不兼容处理)
			me.ruiec_numInput();
			
            return setOption;
        },

        /**
		* @argument 获取页面链接lottery参数，返回当前的彩票玩法
		* @author 王志豪 <wangzhihao>
		* @time 2015年07月30日 22:00:09
		*/
        ruiec_returnLottery: function () {
            var _lotteryCode = $("#j_play_select").attr("lotteryCode");
            if (_lotteryCode != undefined && _lotteryCode != "") {
                return _lotteryCode;
            }
            var oLotteryCode = getQueryString("lottery");
            if (oLotteryCode == undefined || oLotteryCode == "") {
                var theUrl = window.location.href;
                if (theUrl.indexOf("gameBet_cqssc-") >= 0) {
                    oLotteryCode = theUrl.split("gameBet_cqssc-")[1] == undefined ? "1000" : theUrl.split("gameBet_cqssc-")[1];
                    oLotteryCode = oLotteryCode.split(".")[0];
                } else {
                    oLotteryCode = "1000";
                }
            }
            var gameId = "gameId_" + oLotteryCode;
            $(".gameBet").attr("id", gameId)
            $("#j_play_select").attr("lotteryCode", oLotteryCode);
            return oLotteryCode;
        },
        /**
		* @argument 页面加载调用一些基本效果
		* @author 王志豪 <wangzhihao>
		* @time 2015年07月28日 11:17:09
		*/
        ruiec_docReady: function (setOption) {
            var me=this;
            //投注页触碰右侧全、大、小等效果
            $(".ball_control").hover(function () {
                $(this).children(".control_btn").addClass("curr");
                //$(this).children(".control_hidden").show().stop().animate({ "width": "85px", "height": "85px", "margin-left": "-45px", "margin-top": "-45px" }, 200);
                $(this).children(".control_hidden").stop(true,true).show();
            }, function () {
                $(this).children(".control_btn").removeClass("curr");
                $(this).children(".control_hidden").stop(true, true).show();

                //$(this).children(".control_hidden").stop().animate({ "width": "28px", "height": "28px", "margin-left": "-14px", "margin-top": "-14px" }, 100, function () {
                //    $(this).hide();
                //});
            });


            //遗漏冷热tab点击切换
            $("#game_frequency_type li a").click(function () {
                var oIndex = $(this).index();
                $(this).addClass("curr").siblings("a").removeClass("curr");
                $("#game_frequency_item li").removeClass("curr").eq(oIndex).addClass("curr");
            });
            $("#game_frequency_item li a").click(function () {
                $(this).addClass("curr").siblings("a").removeClass("curr");
            });

            //页面加载完毕去除加载条
            //window.onload = function () {
            //    setTimeout(function () {
            //        $("#loading").remove();
            //    }, 1500);
            //};
            
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

                if (oIndex == 0)//我的追号
                {
                    //绑定我的追号
                    me.ruiec_getZhuiHao(setOption);
                }
                else if (oIndex == 1) {
                    me.ruiec_getHeMai(setOption);
                };
            });



            $("body").on("blur","textarea",function () {
                //去除末尾非法字符
                var _theValue = $(this).val();
                var _infos;
                if (_theValue.toString().length > 1) {
                    var _infos = _theValue.substr(_theValue.length - 1, _theValue.length);
                    if (isNaN(Number(_infos))) {
                        _theValue = _theValue.substr(0, _theValue.length - 1);
                    }
                }
                $(this).val(_theValue);
                //去除末尾非法字符
            }) 
        },

        /**
		* @argument 根据链接参数获取对应的彩种分类数据、加载到页面上去
		* @author 王志豪 <wangzhihao>
		* @param setOption 传进去的参数
		* @time 2015年07月28日 11:17:09
		*/
        ruiec_getLotteryData: function (oLotteryCode, setOption) {
            me = this;
            var _oLotteryName;
            if (!oLotteryCode) {
                oLotteryCode = "1000"; //默认是重庆时时彩
                _oLotteryName = "重庆时时彩";
            };
            //获取彩票的名称
            _oLotteryName = me.get_olotteryName(oLotteryCode);
            //$(".g_Time_Section .c_logo img").attr("src", "templates/SSC/images1/cz_" + oLotteryCode + ".png");  //根据彩种代码切换logo
            $(".g_Time_Section .cz_logo h2").empty().text(_oLotteryName);  //替换彩种名称 

            me.ruiec_clickLotteryBtn(setOption); //加载完玩法调用彩种分类点击tab效果

        },

        /**
		* @argument 点击彩种分类tab切换按钮
		* @author 王志豪 <wangzhihao>
		* @param setOption 传进去的参数
		* @time 2015年07月28日 11:17:09
		*/
        ruiec_clickLotteryBtn: function (setOption) {
            var me = this;
            $("#j_play_select .play_select_tit").on("click", "li", function () {
                var lottery_code = $(this).attr("lottery_code");
                $(this).addClass("curr").siblings("li").removeClass("curr");
                $("#j_play_select .play_select_cont li").removeClass("curr");
                $("#j_play_select .play_select_cont li[lottery_code='" + lottery_code + "']").addClass("curr").children("dl").eq(0).children("dd").eq(0).trigger("click");
            });

            $("#j_play_select .play_select_cont").on("click", "li dl dd", function () {
                $(this).parents("li").eq(0).find("dd").removeClass("curr");
                $(this).addClass("curr");

                me.ruiec_clearTzCheckBall();
                var oplay_code = $(this).attr("lottery_code");

                me.getPlayScript(oplay_code, setOption.Js_Url);  //获取玩法说明前加载玩法对应的结构js

                var _theDetail = $(this).attr("loadPlayDetail") == undefined ? false : true;

                if (!_theDetail) {
                    var _this = $(this);
                    $.ajax({
                        type: "POST",
                        url: "../tools/ssc_ajax.ashx",
                        data: { action: "get_play_detail", play_code: oplay_code },
                        dataType: "json",
                        success: function (data) {

                            var _thePlayDetail = {};
                            _thePlayDetail.PlayCode = oplay_code;
                            _thePlayDetail.PlayDetaile = data;
                            _PlayDetail_Array.push(_thePlayDetail);
                            _this.attr("loadPlayDetail", "loaded"); 
                           
                            var oStatus = data.state; //获取返回数据的状态值，为1时有值。
                            if (oStatus) {
                                var g_explain = data.explain; //获取彩种说明文字
                                var g_examples = $.trim(data.examples); //获取彩种示例
                                var _playCode_Value = data.cardinal_money;
                                var _lotteryCode = $("#j_play_select").attr("lotterycode"); 
                                var g_attached_list = data.attached_list; //获取最高奖金列表，如果长度大于零则是多奖金
                                var g_maxText = "";  //最高奖金提示 
                                if (g_attached_list.length > 0) {
                                    var _attached_listObj = data.attached_list; 
                                    for (var i in _attached_listObj) {
                                        var _theTitle = _attached_listObj[i].title;  //名称
                                        var _thePeiLV = _attached_listObj[i].cardinal_money;  //赔率
                                        var _RandCont_Id = "Play_BallArea_" + _lotteryCode + "_" + oplay_code;
                                        if ($("#" + _RandCont_Id).size() > 0) {
                                            $("#" + _RandCont_Id).find(".ball_number[ball-number='" + _theTitle + "']").eq(0).parent().find(".ball_aid").eq(0).empty().text("赔率" + _thePeiLV);
                                            $("#" + _RandCont_Id).find(".ball_number[ball-number='" + _theTitle + "']").eq(0).attr("peilv", _thePeiLV);
                                        } 
                                    } 
                                };
                                var g_palyHtml = '<i class="iconfont c_org"></i><span>' + $.trim(g_explain) + '</span>'; 
                            }
                            else {
                                g_palyHtml = "";
                                var _playCode_Value = 1;
                            };
                            $(".play_select_prompt").empty().html(g_palyHtml); 
                            _this.attr("peilv", _playCode_Value); 
                            $("#choice_comfire_btn").attr("peilv", _playCode_Value);
                            data.Js_url = setOption.Js_Url; //JS根目录


                        }
                    });
                } else {
                    var _this = $(this);
                    var data = me.getPlayDetailByCatch(oplay_code);

                    var oStatus = data.state; //获取返回数据的状态值，为1时有值。
                    if (oStatus) {
                        var g_explain = data.explain; //获取彩种说明文字
                        var g_examples = $.trim(data.examples); //获取彩种示例
                        var _playCode_Value = data.cardinal_money;

                        var g_attached_list = data.attached_list; //获取最高奖金列表，如果长度大于零则是多奖金
                        var g_maxText = "";  //最高奖金提示
                        if (g_attached_list.length > 0) {
                            var cardinal_money_arry = new Array();
                            for (var a = 0 ; a < g_attached_list.length; a++) {
                                var cardinal_money_item = g_attached_list[a].cardinal_money; //多奖金的奖金项
                                cardinal_money_arry.push(cardinal_money_item);
                            };
                            var cardinal_money_arry_max = Math.max.apply(Math, cardinal_money_arry)
                            g_cardinal_money = cardinal_money_arry_max; //将最高奖金赋值给奖金 


                            //快乐8多奖金表格展示
                            me.ruiec_showRewardTable(oplay_code, g_cardinal_money, cardinal_money_arry, me);
                        };
                        var g_palyHtml = '<i class="iconfont c_org"></i><span>' + $.trim(g_explain) + '</span>';
                    } else {
                        g_palyHtml = "";
                        var _playCode_Value = data.cardinal_money;
                    };
                     
                    _this.attr("peilv", _playCode_Value);
                    $("#choice_comfire_btn").attr("peilv", _playCode_Value);
                    $(".play_select_prompt").empty().html(g_palyHtml);  
                    data = undefined;
                }

            });

            //开始点击第一个
            $("#j_play_select .play_select_tit li").eq(0).trigger("click");

            this.ruiec_touchExample();
        },
        /**
		* @argument 根据链接参数获取对应的彩种分类数据、加载到页面上去
		* @author 王志豪 <wangzhihao>
		* @param setOption 传进去的参数
		* @time 2015年07月28日 11:17:09
		*/
        ruiec_getLotteryPlayData: function () {
            var LotteryPlayCode = $("#j_play_select .play_select_cont li.curr .curr").attr("lottery_code");
            return LotteryPlayCode;
        },

        /**
		* 获取玩法详情
		* @name 梁汝翔<liangruxiang> 
		* @param _PlayDetail_Array 玩法JSON对象 
        * @param oPlayCode 玩法编码
        * @param 返回当前玩法详情
		* @time 2015年7月28日 10:20:09
		*/
        getPlayDetailByCatch:function(oPlayCode){
            
            if (oPlayCode == undefined) { oPlayCode = ""; }
            var _data ;

            for (var i = 0 ; i < _PlayDetail_Array.length ; i++) {

                var _theCode = _PlayDetail_Array[i].PlayCode;
                if (oPlayCode == _theCode) {
                    _data = _PlayDetail_Array[i].PlayDetaile;
                    i = _PlayDetail_Array.length;
                } 
            }

            if (_data == undefined) {
                _data = {
                    state:0
                }
            }

            return _data;

        },
        /**
		* 获取页面不同彩种不同玩法的JS处理文件
		* @name 梁汝翔<liangruxiang> 
		* @param data 玩法对象 
		* @time 2015年7月28日 10:20:09
		*/
        getPlayScript: function (oplay_code,js_url) {
            var _this = this;
            var _Parents_Code = me.ruiec_returnLottery();   //彩种编号
            if (_Parents_Code == undefined || _Parents_Code == "") {
                _Parents_Code = 1000;
            } 

            var _Play_Code = oplay_code; //玩法编号
            if (_Play_Code == undefined || _Play_Code == "") {
                _Play_Code = $("#j_play_select .play_select_cont li.curr dd.curr").attr("lottery_code");
            };
            var _PlayCodeCommonId = "PlayCommonJs_" + _Parents_Code;

            if ($("#" + _PlayCodeCommonId).size() != 1) {
                if (_Parents_Code == "1000" || _Parents_Code == "1001" || _Parents_Code == "1002" || _Parents_Code == "1003" || _Parents_Code == "1004") {
                    var _JS_CommonName = "<script id='" + _PlayCodeCommonId + "' type='text/javascript' src='" + js_url + "/js/play_js/" + _Parents_Code + "/basic/RSSC_PlayCommonByCode_" + _Parents_Code + ".min.js'><\/script>";
                } else {
                    var _JS_CommonName = "<script id='" + _PlayCodeCommonId + "' type='text/javascript' src='" + js_url + "/js/play_js/" + _Parents_Code + "/basic/RSSC_PlayCommonByCode_" + _Parents_Code + ".js'><\/script>";
                }
                $("body").append($(_JS_CommonName));
            }

            //获取当前彩种玩法的返点信息
            this.GetLotteryRebate(_Parents_Code, _Play_Code);
            //更具不同的彩种调用不同的开奖号码展示方式
            this.ShowOpenNumber(_Parents_Code, _Play_Code);

            //获取当前彩种玩法的遗漏和冷热[ 延迟4秒钟后获取数据 ]
            clearTimeout(oTimer);
            var oTimer = setTimeout(function () {
                _this.getEachLostHotColl(_Parents_Code, _Play_Code);
            }, 3000);
            
            this.Change_tzUnitBeishu();  //绑定选号对应的，单位和倍数变化产生的change事件 
            var _Ran_date = new Date();
            var _Ran_date_time = _Ran_date.getTime();
             
            if ($("#insertScript").size() > 0) {

                var _PrevPlayCode = $("#insertScript").attr("play_code"); //玩法编码
                var _PrevLotteryCode = _Parents_Code;  //彩种编码
                
                if ($("#Play_BallArea_" + _PrevLotteryCode + "_" + _PrevPlayCode).size() > 0) {
                    $("#Play_BallArea_" + _PrevLotteryCode + "_" + _PrevPlayCode).hide();
                }
                 
                $("#insertScript").remove();
                var _JS_Name = "<script id='insertScript' type='text/javascript' play_code='" + oplay_code + "' src='" + js_url + "/js/play_js/" + _Parents_Code + "/RSSC_Play_" + _Play_Code + ".js?time=" + _Ran_date_time + "'><\/script>";
                $("body").append($(_JS_Name));
            } else {
                var _JS_Name = "<script id='insertScript' type='text/javascript' play_code='" + oplay_code + "' src='" + js_url + "/js/play_js/" + _Parents_Code + "/RSSC_Play_" + _Play_Code + ".js?time=" + _Ran_date_time + "'><\/script>";
                $("body").append($(_JS_Name));
            }  
			
           /**
            * @content 判断浏览器的版本
            * @author  梁汝翔<liangruxiang>  
            * @time 2015年7月28日 10:07:09
            */
            if ($("body #json_jr").size() < 1) {
                var _Agent = navigator.userAgent.toLowerCase();
                //IE浏览器(json 兼容处理 IE7以下)
                if (_Agent.indexOf("msie") > 0) {
                    var _regStr_ie = /msie [\d.]+;/gi;
                    var _theBrowser = _Agent.match(_regStr_ie);
                    var _theBanben = (_theBrowser + "").replace(/[^0-9.]/ig, "");
                    _theBanben = isNaN(parseInt(_theBanben)) ? 9 : parseInt(_theBanben);
                    if (_theBanben < 8) { 
                        var _JS_JSON2 = "<script id='json_jr'  type='text/javascript' src='/templates/SSC/js/JSON2.js?" + parseInt(Math.random() * 100000) + "'><\/script>";
                        $("body").append($(_JS_JSON2)); 
                    }
                }
            }
        }, 
        /**
		* @argument 概率组合计算，相当于数学C(n,m)
		* @author 王志豪 <wangzhihao>
		* @param n, m 对应公式C(n,m)两个参数
		* @time 2015年07月28日 13:30:09
		*/
        ruiec_mathCombin: function (n, m) {
            if (n == "" || m == "" || n == "-" || m == "-" || n == 0 || m == 0 || isNaN(n) || isNaN(m)) {
                oResult = 0;  //返回的结果
            }
            else {
                //m必须大于n,如果小于则返回0;
                oResult = parseInt(this.ruiec_mathfactorial(n) / (this.ruiec_mathfactorial(n - m) * this.ruiec_mathfactorial(m)));
            }
            return oResult;
        },

        /**
		* @argument 数学阶乘运算,相当于数学公式（num！）
		* @author 王志豪 <wangzhihao>
		* @param num 阶乘基数 
		* @time 2015年07月28日 13:30:09
		*/
        ruiec_mathfactorial: function (num) {
            if (num <= 1) {
                return 1;
            } else {
                return num * arguments.callee(num - 1);   //用arguments对象的callee属性来指向外层函数调用自己 
            }
        },

        /**
		* @argument 投注选号示例触碰显示
		* @author 王志豪 <wangzhihao>
		* @time 2015年07月28日 13:30:09
		*/
        ruiec_touchExample: function () {
            //触碰玩法说明的"选号示例"
            $(document).on("mouseover", ".example_btn", function () {
                var oTop = 0;
                var oLeft = 0;
                if($(this).parents(".play_select_prompt").size()>0)
                {
	                oTop = $(this).offset().top;
	                oLeft = $(this).offset().left + 50;
                }
            	else
            	{
            		oTop = 30;
                    oLeft = 265;
            		//oLeft = 20;
            	};
               
                if ($(this).parents(".ds_dr").size() > 0) //单式导入
                {
                    //oLeft = oLeft + 50;
                    oLeft = oLeft ;
                };
                $(this).siblings(".example_tip").show().css({ "left": oLeft, "top": oTop });
            });
            $(document).on("mouseout", ".example_btn", function () {
                var oTop = $(this).offset().top;
                var oLeft = $(this).offset().left + 50;
                if ($(this).parents(".ds_dr").size() > 0) //单式导入
                {
                    //oLeft = oLeft + 50;
                    oLeft = oLeft + 50;
                };
                $(this).siblings(".example_tip").hide().css({ "left": oLeft, "top": oTop });
            });
        },

        /**
		* @argument 把数组转换成String字符串
		* @author 梁汝翔 <liangruxiang>
        * @param arr 数组
        * @param str 数组元素之间的链接字符串 
		* @time 2015年07月28日 13:30:09
		*/
        GetArray_ToString: function (arr, str) {
            if (arr == undefined) { arr = []; }
            if (str == undefined) { arr = ''; }
            var _resultString = "";
            for (var i = 0 ; i < arr.length ; i++) {
                _resultString += arr[i];
                if (i + 1 < arr.length) {  //除了最后一个 都要一字符串链接
                    _resultString += str;
                }
            }
            return _resultString;
        },

        /**
		* @argument 今日开奖记录加载
		* @author 王志豪 <wangzhihao>
		* @param oLotteryCode 彩种参数
		* @time 2015年07月30日 17:50:09
		*/
        ruiec_todayOpen: function (oLotteryCode,oAjaxUrl) {
            var me = this;
            var openData = {};
            openData.action = "get_lottery_open";
            openData.lottery_code = oLotteryCode;  //彩种编码

            var issue_no = $("#f_lottery_info_lastnumber").text();  //最近一期的开奖号码
            var lotteryopen_no = $("#j_openNum").val(); //开奖号码
            var lotteryopen_no1 = lotteryopen_no.split(",");  //拆分开奖号码

            //派奖通知（提示当前用户的最近一期开奖号码的盈亏信息）
            me.ruiec_showOpenNumbers(issue_no, oLotteryCode);       

            //调动开奖效果
            //me.ruiec_openGameNum(lotteryopen_no1, issue_no, oAjaxUrl, oLotteryCode);

            //console.log("最近一期的开奖号码为" + lotteryopen_no);
            //调用开奖效果(改)
            me.ruiec_showOpenAnimateState(lotteryopen_no1, issue_no, oAjaxUrl, oLotteryCode);

            //查看详细开奖号码的效果
            me.ruiec_todayOpenClickDetail(); //调取开奖详细点击效果 
        },
        /**
        * @argument 判断开奖效果的状态
        * @author 梁汝翔 <liangruxiang>
        * @param oLotteryCode 彩种参数
        * @time 2015年07月30日 17:50:09
        */
        ruiec_showOpenAnimateState: function (lotteryopen_no1, issue_no, oAjaxUrl, oLotteryCode) {
            //1、获取当前期的期号
            var _theIssue = $("#f_lottery_info_number").text();
            //1、当前期的期号是否加载出来了，如果没有则轮询等待
            if ($.trim(_theIssue) == "") {
                var _this = this ;
                setTimeout(function () {
                    _this.ruiec_showOpenAnimateState(lotteryopen_no1, issue_no, oAjaxUrl, oLotteryCode);
                }, 500);
                return false;
            } else {
                //当前期的期号已经加载
                //console.log("当前期的期号已经加载" + _theIssue);
                var Least_OpenIssue = issue_no ;
                var This_OpenIssue = _theIssue; 
                this.ruiec_showThisOpenAnimate(Least_OpenIssue, This_OpenIssue,oLotteryCode,lotteryopen_no1,oAjaxUrl);
            } 
        },
        /**
        * @argument 判断开奖号码效果
        * @author 梁汝翔 <liangruxiang>
        * @param Least_OpenIssue 最近开奖的这一期的期号
        * @param This_OpenIssue 当前可投注的这一期的期号
        * @param oLotteryCode 当前的彩种编码
        * @param lotteryopen_no1 最近一期的开奖号码
        * @time 2015年07月30日 17:50:09
        */
        ruiec_showThisOpenAnimate: function (Least_OpenIssue, This_OpenIssue, oLotteryCode, lotteryopen_no1, oAjaxUrl) {
            //1、判断是否为今天的第一期 (是否为时时彩类型，期号差值是否大于1)
            var _This_OpenIssueStr = This_OpenIssue.toString() , ThisIssueIndex = 0 ;
            if (_This_OpenIssueStr.length >= 9) {
                ThisIssueIndex = _This_OpenIssueStr.substr(8, _This_OpenIssueStr.length);
                ThisIssueIndex = isNaN(Number(ThisIssueIndex)) ? 1 : Number(ThisIssueIndex);
                if (ThisIssueIndex == 1 && oLotteryCode != "1008" && oLotteryCode != "1009") {
                    return false;
                } else { 
                    //1、计算差值
                    var _Issue_ChaZhi = This_OpenIssue - Least_OpenIssue; 
                    _Issue_ChaZhi = isNaN(Number(_Issue_ChaZhi)) ? 0 : Number(_Issue_ChaZhi);  //期号之间的差值
                    
                    //2、如果差值大于1
                    if (_Issue_ChaZhi > 1) { 
                        //1、更新当前开奖的开奖期号
                        var _ThisOpenIssue = This_OpenIssue - 1 ;
                        //4、开启快速获取开奖号码的效果   
                        this.ShowThisIssueOpenAnimate(_ThisOpenIssue, lotteryopen_no1, oLotteryCode, oAjaxUrl);
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            } 
        },
        /**
        * @argument 判断开奖号码效果
        * @author 梁汝翔 <liangruxiang>
        * @param _ThisOpenIssue 当前的开奖号码 
        * @time 2015年07月30日 17:50:09
        */
        ShowThisIssueOpenAnimate: function (_ThisOpenIssue, lotteryopen_no1, lottery_code, oAjaxUrl) {

            //console.log("_ThisOpenIssue==更新开奖的期号==" + _ThisOpenIssue);
            //更新开奖的期号
            $("#f_lottery_info_lastnumber").empty().text(_ThisOpenIssue);
             
            //执行开奖的号码
            var oOpenNum_ball_all = "";
            for (var a = 0; a < lotteryopen_no1.length; a++) {

                var oOpenNum_ball = '<li class="open_numb_gif"></li>';
                oOpenNum_ball_all = oOpenNum_ball_all + oOpenNum_ball;
            }; 
            $("#openNum_list").html(oOpenNum_ball_all);

            //快速获取开奖号码
            _GetOpenNumbers = setTimeout(function () {
                me.GetQuick_OpenNumber(oAjaxUrl, lottery_code, _ThisOpenIssue);
            }, 1000);
        }, 
        /**
		* @argument 今日开奖点击开奖详细效果
		* @author 王志豪 <wangzhihao>
		* @time 2015年07月30日 21:20:09
		*/
        ruiec_todayOpenClickDetail: function () {
            $(document).on("click", ".seeMore", function () {
                var oNum = $(this).parent(".o_kai").attr("title");
                alert(oNum);
            });
        }, 
        /**
         * @content 获取当前选号的注数相应的金额变化
         * @author  梁汝翔<liangruxiang>  
         * @time 2015年7月28日 10:07:09
         */
        Change_tzPrice: function () {
            var _tz_len = isNaN(Number($("#choice_zhu").text())) ? 0 : Number($("#choice_zhu").text());  //投注的数量

            var _tz_beishu = $("#choice_Multiple").val(); //投注的倍数

            var _tz_danwei = $("#choice_Unit").val(); //投注的单位（元，角）


            _tz_beishu = isNaN(Number(_tz_beishu)) ? 1 : Number(_tz_beishu);

            if (_tz_beishu > 9999) { _tz_beishu = 9999; }
            $("#choice_Multiple").val(_tz_beishu);

            var _tz_price = isNaN(Number(_tz_len * _tz_beishu * _tz_danwei * 2)) ? 0.00 : parseFloat(Number(_tz_len * _tz_beishu * _tz_danwei * 2)).toFixed(2); //投注的金额

            $("#choice_money").empty().text(_tz_price);
            if(parseFloat(_tz_len)>0 && parseFloat(_tz_price)>0)
            {
            	$("#choice_comfire_btn").addClass("curr");
            }
            else
            {
            	$("#choice_comfire_btn").removeClass("curr");
            };
        }, 
        /**
         * @content 绑定：投注倍数，投注单位变化产生的金额变化
         * @author  梁汝翔<liangruxiang>  
         * @time 2015年7月28日 10:07:09
         */
        Change_tzUnitBeishu: function () {
            var _this = this;
            $("#choice_Multiple").change(function () {
                _this.Change_tzPrice();
            });
            
            _this.ChangeUnitState();

            $("#choice_Unit").change(function () {
                _this.Change_tzPrice(); 
                //change by wangzhihao
                var oVal = $(this).val();  //选择倍数的单位值
                var _theOptionIndex = 0;
                var _getUnitCookie2 = getCookie("ChoiceUnit") == undefined ? "" : getCookie("ChoiceUnit");
                if (!_getUnitCookie2) {
                    //不存在cookie
                    setCookie('ChoiceUnit', oVal, '180000');
                } else {
                    setCookie('ChoiceUnit', oVal, '180000');
                }
                 
                var fdArray = $("#select_fd").attr("fdArray"); //返点数组
                if(fdArray)
                {
                	var fdArray = fdArray.split(",");
	                var itemAll = "";
	                for(var a =0; a<fdArray.length;a++)
	                {
	                	var oPtion_val = fdArray[a];
	                	var oPtion_val_money = parseFloat(oPtion_val.split("-")[0]);
	                	var oPtion_val_fd = oPtion_val.split("-")[1];
	                	switch(oVal)
	                	{
	                		case "1": 		//元
	                			oPtion_val_money = oPtion_val_money;
	                			break;
	                		case "0.1": 	//角
	                			oPtion_val_money = parseFloat(oPtion_val_money/10);
	                			break;
	                		case "0.01": 	//分
	                			oPtion_val_money = parseFloat(oPtion_val_money/100);
	                			break;
	                		default:
	                			oPtion_val_money = oPtion_val_money;
	                			break;
	                	};
	                    //oPtion_val_money = oPtion_val_money.toFixed(2);
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
	                $("#select_fd").html($(itemAll));
                };
                //change by wangzhihao end
                
            });
        },
        /**
        * @content 改变投注圆角分模式
        * @author  梁汝翔<liangruxiang>  
        * @time 2015年7月28日 10:07:09
        */
        ChangeUnitState:function(){
            var _getUnitCookie = getCookie("ChoiceUnit") == undefined ? "" : getCookie("ChoiceUnit");
            if (_getUnitCookie != false && _getUnitCookie != 'false') { 
                $("#choice_Unit").find("option[value='" + _getUnitCookie + "']").prop("selected",true);
               
                var oVal = _getUnitCookie ;
                var fdArray = $("#select_fd").attr("fdArray"); //返点数组
                if (fdArray) {
                    var fdArray = fdArray.split(",");
                    var itemAll = "";
                    for (var a = 0; a < fdArray.length; a++) {
                        var oPtion_val = fdArray[a];
                        var oPtion_val_money = parseFloat(oPtion_val.split("-")[0]);
                        var oPtion_val_fd = oPtion_val.split("-")[1];
                        switch (oVal) {
                            case "1": 		//元
                                oPtion_val_money = oPtion_val_money;
                                break;
                            case "0.1": 	//角
                                oPtion_val_money = parseFloat(oPtion_val_money / 10);
                                break;
                            case "0.01": 	//分
                                oPtion_val_money = parseFloat(oPtion_val_money / 100);
                                break;
                            default:
                                oPtion_val_money = oPtion_val_money;
                                break;
                        };
                        //oPtion_val_money = oPtion_val_money.toFixed(2);
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
                    $("#select_fd").html($(itemAll));
                }; 
            }
 
        },
        /**
         * @content 删除投注订单
         * @author  梁汝翔<liangruxiang>  
         * @time 2015年7月28日 10:07:09
         */
        Del_TzOrder: function () {
            var me = this
            $("#order_table").on("click", ".l_cancel", function (event) {
                event = event ? event : window.event;
                event.stopPropagation();
                $(this).parents("tr").eq(0).remove();
                //清除编辑信息
                $("#choice_comfire_btn").removeAttr("editorid");
                //清除投注信息
                $("#choice_comfire_btn").children("em").text("确认选号"); //去除选号按钮状态
                //方案总注数计算和赋值
                me.ruiec_orderCountMoney();
            });
        },

        /**
         * @content 获取随机数组
         * @author  王志豪<wangzhihao>
		 * @param oNum（获取随机数量）,oMin（随机数最小值）,oMax（随机数最大值）,随机分隔符，例子（ruiec_returnRandom(5,0,10,true)
         * @time 2015年7月28日 10:07:09
         */
        ruiec_returnRandomArry: function (oNum, oMin, oMax, oRepeat) {  
            var oResult = new Array();
            if (oRepeat)  //重复
            {
                for (var i = 0; i < oNum; i++) {
                    var oRandom = parseInt((oMax + 1) * (Math.random()));
                    if (oRandom < oMin) {
                        oRandom = oMin;
                    };
                    oResult.push(oRandom);
                };
                return oResult;
            }
            else	  //不可重复
            {
                var oRandomArray = new Array();  //不可重复的数组
                for (var a = oMin; a <= oMax; a++) {
                    oRandomArray.push(a);
                };
                for (var i = 0; i < oNum; i++) {
                    var oLength = oRandomArray.length;
                    var oRandom_num = parseInt(oLength * (Math.random()));
                    oRandom = oRandomArray[oRandom_num];
                    if (oRandom < oMin) {
                        oRandom = oMin;
                    };
                    oRandomArray.splice(oRandom_num, 1);
                    oResult.push(oRandom);
                };
                return oResult;

            };
        },
        /**
         * @content 创建投注区域的html：遗漏冷热切换按钮
         * @author  梁汝翔<liangruxiang>  
         * @time 2015年7月28日 10:07:09
         */
        CreatCheckBallArea_TabTT: function () {
            var strVar_tit = "";  //遗漏、冷热头部
            strVar_tit += "<div class=\"gn_main_tit\">";
            strVar_tit += "		<ul class=\"game_frequency_type\">";
            strVar_tit += "			<li><a class=\"curr\" value=\"遗漏\">遗漏<\/a><a href=\"javascript:void(0)\" value=\"遗漏\">冷热<\/a><\/li>";
            strVar_tit += "		<\/ul>";
            strVar_tit += "		<ul class=\"game_frequency_item\">";
            strVar_tit += "			<li class=\"curr\"><a href=\"javascript:void(0)\" value=\"当前遗漏\" class=\"curr\">当前遗漏<\/a><a href=\"javascript:void(0)\" value=\"最大遗漏\">最大遗漏<\/a><\/li>";
            strVar_tit += "			<li><a value=\"30\" class=\"curr\">30期<\/a><a value=\"60\">60期<\/a><a value=\"100\">100期<\/a><\/li>";
            strVar_tit += "		<\/ul>";
            strVar_tit += "<\/div>";

            return strVar_tit;
        },
        /**
         * @content 创建投注区域的html：选球
         * @author  梁汝翔<liangruxiang>  
         * @param s 开始的值
         * @param e 结束的值
         * @param Ball_type 单球  或者 双球
         * @param yilou 是否展示遗漏
         * @return  返回球html
         * @time 2015年7月28日 10:07:09
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
                strVar_ball_item += "	        <li class='" + Ball_type + "'>";
                if (Ball_type == "true") {
                    strVar_ball_item += "	            <a class=\"ball_number\" href=\"javascript:void(0)\" ball-number='" + a + "' >" + a + "<\/a>";
                } else {
                    if (a > 9) {
                        strVar_ball_item += "	            <a class=\"ball_number\" href=\"javascript:void(0)\" ball-number='" + a + "' >" + a + "<\/a>";
                    } else {
                        strVar_ball_item += "	            <a class=\"ball_number\" href=\"javascript:void(0)\" ball-number='0" + a + "' >0" + a + "<\/a>";
                    }
                }
                if (yilou == "true") {
                    strVar_ball_item += "	            <span class=\"ball_aid\">0<\/span>";
                }
                else {
                    strVar_ball_item += "";
                };
                strVar_ball_item += "	        <\/li>";
                strVar_ball = strVar_ball + strVar_ball_item;
            };
            return strVar_ball;
        },
        /**
        * @content 创建投注区域快捷选号（全、大、小、奇、偶、清）
        * @author  梁汝翔<liangruxiang>   
        * @return  返回操作html
        * @time 2015年7月28日 10:07:09
        */
        CreatCheckBallArea_QuickCheck: function () {
            var ballControl = "";  //选号操作区（全、大、小、奇、偶、清）
            ballControl += "		<div class=\"ball_control\">";
            ballControl += "	        <a class=\"control_btn\"><\/a>";
            ballControl += "	        <div class=\"control_hidden\">";
            ballControl += "	           <a class=\"set_all\" value='All' href=\"javascript:void(0)\">全<\/a>";
            ballControl += "	           <a class=\"set_big\" value='Big'  href=\"javascript:void(0)\">大<\/a>";
            ballControl += "	           <a class=\"set_small\" value='Small'  href=\"javascript:void(0)\">小<\/a>";
            ballControl += "	           <a class=\"set_odd\" value='Odd'  href=\"javascript:void(0)\">奇<\/a>";
            ballControl += "	           <a class=\"set_even\" value='Even'  href=\"javascript:void(0)\">偶<\/a>";
            ballControl += "	           <a class=\"set_none\" value='Empty'  href=\"javascript:void(0)\">清<\/a>";
            ballControl += "	           <i class='arrow_bottom'></i>";
            ballControl += "	        <\/div>";
            ballControl += "	    <\/div>"; 
            return ballControl;
        },
        /**
         * @content 单式输入框内容
         * @author  梁汝翔<liangruxiang>   
         * @return  返回操作html
         * @time 2015年7月28日 10:07:09
         */
        CreatSingleBox: function (Example_html) {

            if (Example_html == undefined) { Example_html = '<p>12356,1255,22235,12356...<\/p>'; }


            var strVar = "";
            strVar += "<div class=\"ball_section_ds\">";
            strVar += "	    <div class=\"ds_dr\">";
            strVar += "    	   <a class=\"dr drorder\"><i class=\"iconfont\"><\/i>导入注单<\/a>";
            strVar += "        <a class=\"gs example_btn\">查看标准格式样本<\/a>";
            strVar += "        <div class=\"example_tip\" style=\"display: none; left: 533px; top: 379px;\">";
            strVar += Example_html;
            strVar += "        <\/div>";
            strVar += "     <\/div>";
            strVar += "	    <div class=\"ds_input\">";
            strVar += "    	    <textarea class=\"ds_textarea\"><\/textarea>";
            strVar += "         <p class=\"ds_text\">";
            strVar += "             说明：<br>1、请参照\"标准格式样本\"格式录入或上传方案。<br>";
            strVar += "             2、每一注号码之间请使用空格分开，每注之间以回车、逗号或分号进行分隔<br>";
            strVar += "             3、文件格式必须是.txt格式。<br>";
            strVar += "             4、文件较大时会导致上传时间较长，请耐心等待！<br>";
            strVar += "             6、导入文本内容后将覆盖文本框中现有的内容。<\/p>";
            strVar += "    <\/div>";
            strVar += "    <div class=\"ds_btn\">";
            strVar += "    	    <a class=\"ds_btn_item del_error\"><i class=\"iconfont\"><\/i>删除错误项<\/a>";
            strVar += "    	    <a class=\"ds_btn_item del_unique\"><i class=\"iconfont\"><\/i>检查格式是否正确<\/a>";
            strVar += "    	    <a class=\"ds_btn_item del_empty\"><i class=\"iconfont\"><\/i>清空文本框<\/a>";
            strVar += "    <\/div>";
            strVar += "<\/div>";

            return strVar;
        },
        /**
         * @content 验证数组是否有重复元素
         * @author  梁汝翔<liangruxiang>   
         * @return  有重复返回true；否则返回false
         * @time 2015年7月28日 10:07:09
         */
        Verify_Arrat_Repeat: function (arr) {
            var theReturn = false; //默认是没有的
            if (arr == undefined) { arr = []; }
            //arr.sort();  //数组排序
            for (var i = 0 ; i < arr.length ; i++) {
                var theValue = arr[i];
                for (var j = 0 ; j < arr.length ; j++) {  //当前元素与后面的所有元素都不相等；迭代 

                    if (i != j && theValue == arr[j]) {
                        theReturn = true;
                        j = arr.length;
                        i = arr.length;
                    }
                }
            }
            return theReturn;
        },
        /**
         * @content 去除数组中重复的值
         * @author  梁汝翔<liangruxiang>   
         * @return  有重复返回true；否则返回false
         * @time 2015年7月28日 10:07:09
         */
        Del_Arrat_RepeatInfos: function (arr) {
            var theReturn = false; //默认是没有的
            if (arr == undefined) { arr = []; }
            //arr.sort();  //数组排序
            var New_Array = new Array();
            for (var i = 0 ; i < arr.length ; i++) {

                var theReturn = false; //默认是没有的
                var theValue = arr[i];
                if (i == 0) { New_Array.push(theValue); } //第一个不是重复的 
                for (var j = 0 ; j < arr.length ; j++) {  //当前元素与后面的所有元素都不相等；迭代  
                    if (i != j && theValue == arr[j]) {
                        theReturn = true;
                        j = arr.length;
                    }
                }
                if (!theReturn && i != 0) {
                    New_Array.push(theValue);
                }
            }
            return New_Array;
        },
        /**
         * @content 二维数组的排列组合
         * @author  梁汝翔<liangruxiang>   
         * @return  有重复返回true；否则返回false
         * @param arr2 二维数组
         * @time 2015年7月28日 10:07:09
         */
        TwoD_ArrayCombination: function (arr2) {
            if (arr2.length < 1) {
                return [];
            }
            var w = arr2[0].length,
				h = arr2.length,
				i, j,
				m = [],
				n,
				result = [],
				_row = [];

            m[i = h] = 1;

            while (i--) {
                m[i] = m[i + 1] * arr2[i].length;
            }
            n = m[0];
            for (i = 0; i < n; i++) {
                _row = [];
                for (j = 0; j < h; j++) {
                    _row[j] = arr2[j][~~(i % m[j] / m[j + 1])];
                }
                result[i] = _row;
            }
            return result;
        },
        /**
         * @content 去除结果集中的重复项和豹子（递归）
         * @author  梁汝翔<liangruxiang>   
         * @return  有重复返回true；否则返回false
         * @param arr 一维数组
         * @param len 数组的长度
         * @param num 数组的起始值
         * @param saveArray 回调数组
         * @time 2015年7月28日 10:07:09
         */
        RemoveDoubleLeopard: function (arr, len, num, saveArray) {
            var me = this,
                saveArray = saveArray || [],
                num = num || 0,
                len = len || arr.length;

            if (num == len) {
                return saveArray;
            } else {
                if (arr[num][0] != arr[num][1] && arr[num][0] != arr[num][2] && arr[num][1] != arr[num][2]) {
                    saveArray.push(arr[num]);
                }
                num++;
                return this.RemoveDoubleLeopard(arr, len, num, saveArray);
            }
        },
        /**
         * @content 方案总注数计算和赋值
         * @author  王志豪<wangzhihao>   
         * @time 2015年8月5日 16:00:09
         */
        ruiec_orderCountMoney: function () {
            var orderCount_num = 0;
            var orderCount_money = 0.00;
            var order_item = $("#order_table tr");
            for (var a = 0; a < order_item.size() ; a++) {
                var order_item_num = parseInt(order_item.eq(a).find(".order_num").text());  //每行订单的注数
                var order_item_money = parseInt(order_item.eq(a).find(".order_money").text());  //

                orderCount_num = orderCount_num + order_item_num;
                orderCount_money = orderCount_money + order_item_money;
            };
            orderCount_money = orderCount_money.toFixed(2);
            $("#f_gameOrder_lotterys_num").text(orderCount_num);
            $("#f_gameOrder_amount").text(orderCount_money);
            
        },
        /**
        * @content 我要自购 、我要追号、发起合买切换
        * @author  王志豪<wangzhihao>   
        * @time 2015年8月5日 16:22:09
        */
        ruiec_changeSubmitType: function () {
            var c_input = $(".chase_Program label input");
            var SelectLen = $("#order_table").find("tr").length;
            var obj_zuihao = $(".g_Chase_Section .chase_main");
            var obj_hemai = $("#hemai_cont");
            c_input.change(function () {

                SelectLen = $("#order_table").find("tr").length;

                if (c_input.eq(0).prop("checked") == true)  //我要自购
                {
                    obj_zuihao.hide();
                    obj_hemai.hide();
                }
                else if (c_input.eq(1).prop("checked") == true) {
                    if (SelectLen > 0) {
                        obj_zuihao.show();
                        obj_hemai.hide();
                    } else {   
                        alert("请至少选择一注投注号码！");
                        c_input.eq(0).prop("checked", true);
                        return false;
                    }
                }
                else {  //合买的 
                    if (SelectLen > 0) { 
                        //遍历投注区域是否存在低返点
                        var _Containers = $("#order_table") , LowFanDian_len = 0 ;
                        _Containers.find("tr").each(function () {
                            var _theFanDianInfo = $(this).find(".order_fandian").eq(0).text() == undefined ? "" : $(this).find(".order_fandian").eq(0).text();
                            //console.log(_theFanDianInfo);
                            if (_theFanDianInfo != "" && _theFanDianInfo.indexOf("-") > 0) {
                                var _theFanDianValue = _theFanDianInfo.split("-")[1]; 
                                _theFanDianValue = isNaN(Number(_theFanDianValue)) ? 0 : Number(_theFanDianValue);
                                if (_theFanDianValue > 0) {
                                    LowFanDian_len++;
                                }
                            } 
                        });

                        if (LowFanDian_len == 0) { 
                            obj_zuihao.hide();
                            obj_hemai.show();
                        } else {
                            alert("本平台仅支持，最高返点进行合买，请调整您的选号返点。");
                            c_input.eq(0).prop("checked", true);
                            return false;
                        } 
                    } else {
                        alert("请至少选择一注投注号码！");
                        c_input.eq(0).prop("checked", true);
                        return false;
                    }
                };
            });
        },
        /**
        * @content 根据数据创建投注的号码信息
        * @author  梁汝翔<liangruxiang> 
        * @param _CheckBall 选号的组合数据
        * @time 2015年7月28日 10:07:09
        */
        ruiec_clearTzCheckBall: function () {
            $(".li_ball .ball_number").each(function () {
                if ($(this).hasClass("curr")) {
                    $(this).removeClass("curr");
                }
            });
            //清除投注信息
            $("#order_table tr").removeClass("curr");										//去除订单修改选中
            $("#choice_zhu").empty().text("0");
            /*$("#choice_Multiple").find("option").eq(0).prop("selected", true);
            $("#choice_Unit").find("option").eq(0).prop("selected", true);*/
            $("#choice_money").empty().text("0.00");
            $("#choice_comfire_btn").removeClass("curr").children("em").text("确认选号"); //去除选号按钮状态
            
            //清除大小单双
            if($(".ball_dxds").size()>0)
            {
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
        },
        /**
         * 把字符串转成JSON对象 
         * @name 梁汝翔<liangruxiang>
         * @time 2015年6月16日 16:20:00
         * @param StrData 需要转换的字符串 
         */
         GetJsonData:function(StrData) {
           if (StrData != undefined && StrData != "") {
                    var Jsdata;
                    if (JSON != undefined) {
                        Jsdata = JSON.parse(StrData);
                    }
                    else {
                        Jsdata = jQuery.parseJSON(StrData);
                    }

                    return Jsdata;
                }
            else {
               return {};
            }
        }, 
        /**
         * @content JSON对象转换成String类型对象
         * @name 梁汝翔<liangruxiang>
         * @time 2015年6月16日 16:20:00
         * @param JSONObj 
         */
        Json_To_String: function (JSONObj) {
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
        },
        /**
         * @content 获取随机数值
         * @name 梁汝翔<liangruxiang>
         * @param s开始值，e结束值
         * @time 2015年6月16日 16:20:00
         * @param JSONObj 
         */
        GetRandomValue: function (s, e) { 
            return  parseInt(Math.random() * (e - s + 1) + s);
        },
        /**
         * @content 验证字符串是否存在与数组中
         * @name 梁汝翔<liangruxiang>
         * @param str 字符串，arry 匹配数组
         * @time 2015年6月16日 16:20:00
         * @param JSONObj 
         */
        CheckStrInArray: function (str, arry) {
            var theState = false ;
            for (var i = 0 ; i < arry.length; i++) {
                if (arry[i] == str) {
                    i = arry.length;
                    theState = true;
                }
            }
            return theState;
        },
        
        /**
         * 数组去重
         * @name 王志豪<wangzhihao>
         * @time 2015年08月11日 16:58:00
         * @param Array 输入的数组
         */
        ruiec_ArrayNoRepeat : function(Array){
            var hash = {};
            var result={};
            var rightArray = [];  //不重复的数组
            var errorArray = [];  //重复的数组
            var errorIndex = [];  //重复的索引值数组
            if(Array)
            {
                for (var i = 0; i < Array.length; i++){
                    if (!hash[Array[i]]){
                        hash[Array[i]] = true;
                        rightArray.push(Array[i]);
                    }
                    else
                    {
                        errorArray.push(Array[i]);
                        errorIndex.push(i);
                    };
                }
                result.rightArray=rightArray;
                result.errorArray=errorArray;
                result.errorIndex=errorIndex;
                return result;
            };
        },
        
        /**
         * 获取我的方案
         * @name 王志豪<wangzhihao>
         * @time 2015年08月12日 16:58:00
         */
        ruiec_getMyProject: function (oAjaxUrl) {
            return false;

            //if (oAjaxUrl == undefined) { 
            //    oAjaxUrl = "../../tools/ssc_ajax.ashx";
            //}
            //var oLoading = '<tr>' +
		    //                '<td colspan="3" style="padding:15px;text-align:center;">' +
		    //                    '<img src="templates/SSC/images1/loading.gif" class="center" width="25" />' +
		    //                '</td>' +
		    //            '</tr>';
            //$.ajax({
            //    type: "POST",
            //    url: oAjaxUrl,
            //    data: { "action": "GetBetting" },
            //    dataType: "json", 
            //    success: function (data) {
            //        var oData = data.Data;
            //        var oInsert="";
            //        if (oData != undefined && oData.length > 0) {
            //            for (var a in oData) {
            //                var issueNo = oData[a].issueNo; //方案编号
            //                var normal_money = isNaN(parseFloat(oData[a].normal_money).toFixed(2)) ? "0.00" : parseFloat(oData[a].normal_money).toFixed(2); //方案金额
            //                var openState = oData[a].openState; //方案状态
            //                var ourl = oData[a].url; //方案链接
            //                var chedanState = oData[a].chedanState == undefined ? "--" : oData[a].chedanState;
            //                var chedanId = oData[a].order_id == undefined ? "--" : oData[a].order_id;
            //                oInsertTr = '<tr>' +
            //                           '<td><a class="alink" href="' + ourl + '">' + issueNo + '</a></td>' +
            //                           '<td><i class="c_org">￥' + normal_money + '</i></td>';
            //                //if (chedanState == "撤单") {
            //                //    oInsertTr += '<td><a href="javascript:void(0)" class="tz_cedan_btn" lottery_orders_id="' + chedanId + '">' + chedanState + '</a></td>';
            //                //} else {
            //                if (openState == "已中奖") {
            //                    oInsertTr += '<td class="c_red">' + openState + '</td>';
            //                } else if (openState == "未中奖") {
            //                    oInsertTr += '<td class="c_green">' + openState + '</td>';
            //                } else {
            //                    oInsertTr += '<td>' + openState + '</td>';
            //                }
            //                //} 
            //                oInsertTr += '</tr>'; 
            //                oInsert = oInsert + oInsertTr;
            //            };
            //            $("#fn_getMyProjects .tbody").empty().html(oInsert);
            //        } else {
            //            oLoading = '<tr>' +
		    //                            '<td colspan="3" style="padding:15px;text-align:center;">' +
		    //                                '您暂无投注方案。' +
		    //                            '</td>' +
		    //                        '</tr>';
            //            $("#fn_getMyProjects .tbody").empty().html(oLoading);
            //        }
            //    },
            //    error: function () {
            //        oLoading = '<tr>' +
		    //                '<td colspan="3" style="padding:15px;text-align:center;">' +
		    //                    '您暂无投注方案。' +
		    //                '</td>' +
		    //            '</tr>';
            //        $("#fn_getMyProjects .tbody").empty().html(oLoading);
            //    }
            //}); 
        },   
        /**
         * @content 时间戳转日期时间（公用），调用例子[ruiec_DateToTime(1398250549490,1)]
         * @name 王志豪<wangzhihao>
         * @param Date需要转化的时间戳,show=0时所有格式、show=1时转化成日期格式、show=2时转化为时间格式
         * @time 2015年08月13日 16:58:00
         */
        ruiec_DateToTime:function(oDate,show){
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
            else if(show==3)
            {
                var oCallBackTime = Y + M + D + h + m + s
            }
            else if (show == 4) {
                var oCallBackTime = h + m + s
            }else{
                var oCallBackTime =  M + D + h + m + s
            }
            return oCallBackTime;
        },
        /**
         * @content 日期转化成时间戳（公用），调用例子[ruiec_TimeToDate('2014-04-23 18:55:49:123')]
         * @name 王志豪<wangzhihao>
         * @param oTime需要转化的时间格式，如'2014-04-23 18:55:49:123',type为time时
         * @callBack：oDate 返回的时间戳 
         * @time 2015年08月13日 16:58:00
         */
        ruiec_TimeToDate:function(oTime,type) {
        	/*var isChrome = window.navigator.userAgent.indexOf("Chrome") !== -1 
        	console.log(isChrome)*/
            var oDate = 0;
            if(type=="time")
            {
                // 例子：hh:mm:ss 》》549490
                var oTime=oTime.split(":");
                oDate = oDate + Number(oTime[0]) * 3600 + Number(oTime[1]) * 60 + Number(oTime[2]);
            }else
            {
                // 例子：yyyy-MM-dd hh:mm:ss 》》1398250549490
                var t1 = oTime.split(" ")[0];
                var t2 = oTime.split(" ")[1];
                var y = t1.split("-")[0];
                var m = t1.split("-")[1]-1;
                var d = t1.split("-")[2];
                var h = t2.split(":")[0];
                var mm = t2.split(":")[1];
                var s = t2.split(":")[2];
                date = new Date(y,m,d,h,mm,s);
                oDate = date.getTime(); 
            };
            return oDate;
        },
        /**
         * @content 返回n天后的时间戳
         * @name 王志豪<wangzhihao>
         * @callBack：nextNum天(可正负)
         * @time 2015年08月13日 16:58:00
         */
        ruiec_returnNextDayTime:function(nextNum) {
            if(nextNum=="" || nextNum==undefined)
            {
                nextNum=0;
            };
            var today = new Date();
            today.setHours(0);
            today.setMinutes(0);
            today.setSeconds(0);
            today.setMilliseconds(0);
			
            var todayTime = today.getTime();
            var oNextTime = 0;
            var n = 1000 * 60 * 60 * 24;  //一天的时间戳
            oNextTime = todayTime + n * nextNum;
            return oNextTime;
        },
        /**
         * @content 字符串去除分隔符
         * @name 王志豪<wangzhihao>
         * @callBack：string需要处理的字符串（例如：2015-11-12）,cut是分隔符，例如（“-”）
         * @time 2015年08月13日 16:58:00
         */
        ruiec_removeSplit:function(string,cut){
            var oString = string;
            var oString_split=oString.split(cut);
            var newString="";
            for(var a in oString_split)
            {
                newString = newString + oString_split[a];
            };
            return newString;
        },
        /**
         * @content 当前期号及倒计时赋值
         * @name 王志豪<wangzhihao>
         * @callBack：openTimeList重组的开奖期号对应时间,oLastIssue上一期号,oLastOpenTime上一开奖时间,oLastOpenNum上一开奖号码
         * @time 2015年08月13日 17:58:00
         */
        ruiec_showNowIussue:function(openTimeList,oLastIssue,oLastOpenTime,oLastOpenNum,oFendan,oLotteryCode,oAjaxUrl){
            var me = this; 
            var oFendan_time = parseInt(oFendan) * 60; //封单时间（秒）

		    $.ajax({
			    type: "POST",
			    url: "../tools/ssc_ajax.ashx",
			    data: {"action":"server_dateTime"},
		        dataType: "json", 
		        success: function(data){
		            var oDate = data.Data;
		            var oServerTime = me.ruiec_TimeToDate(oDate);	//获取服务器时间
		            var oNowTime = oServerTime;
		            var i_index = 0;
		            for (var a = 0 ; a < openTimeList.length ; a++) {
		                if (a < openTimeList.length - 1) {
		                    var a = parseInt(a);
		                    var newBeginTime = openTimeList[a].newBeginTime; 
		                    var newEndTime = openTimeList[a].newEndTime;
		                    var newIssue = openTimeList[a].newIssue;
		                    var b = a + 1;
		                    var newBeginTime2 = openTimeList[b].newBeginTime;  

		                    //console.log("oNowTime====oNowTime" + oNowTime + "====newBeginTime===" + newBeginTime + "====newBeginTime2" + newBeginTime2);

		                    if (oNowTime >= newBeginTime && oNowTime < newBeginTime2)  //如果在开奖区间内
		                    { 
		                        var nextIssue = openTimeList[b].newIssue;  //下一期的期号
		                        var nextBeginTime = openTimeList[b].newBeginTime;  //下一期的开奖时间
		                        
		                        if (oLotteryCode == "1311" && nextIssue.toString().length < 6) {
		                            nextIssue = "0" + nextIssue;
		                        } 
		                        $("#f_lottery_info_number").text(nextIssue); 
		                        if (oNowTime <= newEndTime) {
		                            $(".j_lottery_time .yshouzhong").hide();

		                            //console.log(nextIssue);
		                            //开启倒计时效果
		                            me.ruiec_countDown(nextBeginTime, openTimeList, b, nextIssue, oFendan, oLotteryCode, oAjaxUrl);
		                        }
		                        else {
		                            var oCha = (newBeginTime2 - oNowTime) / 1000;
		                            if (oCha <= 3600) {
		                                $(".j_lottery_time .yshouzhong").hide();
		                                me.ruiec_countDown(nextBeginTime, openTimeList, b, nextIssue, oFendan, oLotteryCode, oAjaxUrl);
		                            }
		                            else {
		                                /*$(".j_lottery_time .time_m1,#fixedCountDown .ctime").text("预售中");*/
		                                $("#fixedCountDown .ctime").text("预售中");
		                                $(".j_lottery_time .yshouzhong").show();
		                            }
		                        };

		                        a = openTimeList.length;  
		                    } else if (oNowTime < newBeginTime2 && i_index == 0) {
		                        var nextIssue = openTimeList[i_index].newIssue;  //下一期的期号
		                        var nextBeginTime = openTimeList[i_index].newBeginTime;  //下一期的开奖时间

		                        $("#f_lottery_info_number").text(nextIssue);
		                        //console.log(nextIssue);
		                        if (oNowTime <= newEndTime) {
		                            $(".j_lottery_time .yshouzhong").hide();
		                            //开启倒计时效果
		                            me.ruiec_countDown(nextBeginTime, openTimeList, b, nextIssue, oFendan, oLotteryCode, oAjaxUrl);
		                        }
		                        else {
		                            var oCha = (newBeginTime2 - oNowTime) / 1000;
		                            if (oCha <= 3600) {
		                                $(".j_lottery_time .yshouzhong").hide();
		                                me.ruiec_countDown(nextBeginTime, openTimeList, b, nextIssue, oFendan, oLotteryCode, oAjaxUrl);
		                            }
		                            else {
		                                /*$(".j_lottery_time .time_m1,#fixedCountDown .ctime").text("预售中");*/
		                                $("#fixedCountDown .ctime").text("预售中");
		                                $(".j_lottery_time .yshouzhong").show();
		                            }
		                        }; 
		                        a = openTimeList.length; 
		                    }
		                    i_index++;
		                };
		            };
		        }    
		    });   
        },
        /**
         * @content 开启倒计时效果
         * @name 王志豪<wangzhihao>
         * @param：nextBeginTime,openTimeList,oindex,newIssue
         * @time 2015年08月14日 10:58:00
         */
        ruiec_countDown:function(nextBeginTime,openTimeList,oindex,nextIssue,oFendan,oLotteryCode,oAjaxUrl){
            var me = this;
        	var oLotteryCode = me.ruiec_returnLottery();
        	var oServerTime = parseInt($(".j_lottery_time").attr("servertime"));
        	$(".j_lottery_time .yshouzhong").hide();
        	if(!isNaN(oServerTime) && oServerTime!="") //获取服务器时间
            {
            	oNowTime = parseInt($(".j_lottery_time").attr("servertime"));
            }
            else//如果获取不到服务器时间就用本地时间
            {
            	var oDate = new Date();
            	var oNowTime = oDate.getTime();  
            };
            var sum = nextBeginTime - oNowTime;  //下一期和当前期的时间戳之差
            sum = parseInt(sum/1000);
            if(sum>=0) //倒计时的值
            {
                var h = parseInt(sum/3600)>=10? parseInt(sum/3600):"0"+parseInt(sum/3600);
                var m = parseInt(sum%3600/60)>=10? parseInt(sum%3600/60):"0"+parseInt(sum%3600/60);
                var s = parseInt(sum%3600%60)>=10? parseInt(sum%3600%60):"0"+parseInt(sum%3600%60);
                var setTime = m + ":" +s
                if(oLotteryCode==1201 || oLotteryCode==1202) //福彩3D、排列3、5
                {
                    var setTime = h + ":" + m + ":" + s;
                };
                //$(".j_lottery_time .time_m1").text(setTime);

                var _h1 = parseInt($(".j_lottery_time .time_h1").text()),
                    _h2 = parseInt($(".j_lottery_time .time_h2").text()),
                    _m1 = parseInt($(".j_lottery_time .time_m1").text()),
                    _m2 = parseInt($(".j_lottery_time .time_m2").text()),
                    _s1 = parseInt($(".j_lottery_time .time_s1").text()),
                    _s2 = parseInt($(".j_lottery_time .time_s2").text());
				
                if (_h1 != (parseInt(h / 10))) { 
                    $(".j_lottery_time .time_h1").text(parseInt(h / 10))
                }
                if (_h2 != (parseInt(h % 10))) { 
                    $(".j_lottery_time .time_h2").text(parseInt(h % 10))
                }
                if (_m1 != (parseInt(m / 10))) {
                    $(".j_lottery_time .time_m1").text(parseInt(m / 10))
                }

                if (_m2 != (parseInt(m % 10))) {
                    $(".j_lottery_time .time_m2").text(parseInt(m % 10))
                }
                if (_s1 != (parseInt(s / 10))) {
                    $(".j_lottery_time .time_s1").text(parseInt(s / 10))
                }
                if (_s2 != (parseInt(s % 10))) {
                    $(".j_lottery_time .time_s2").text(parseInt(s % 10))
                } 
				$("#fixedCountDown .ctime").text(setTime);
            }
            else
            {
                oindex = oindex + 1;

                //lrxiang
                var _thisIssue_numb = openTimeList[oindex - 1].newIssue; //当前期的期号
                if (_thisIssue_numb != nextIssue) {
                    nextIssue = _thisIssue_numb;
                }
                //lrxiang

                var nextIssue2 = openTimeList[oindex].newIssue;  //下一期的期号
                var nextBeginTime = openTimeList[oindex].newBeginTime;  //下一期的开奖时间
                //调用弹出框效果
                me.show_dialog(openTimeList, nextIssue, nextIssue2, oLotteryCode, oAjaxUrl);

                var _ThisOpenIssue = $("#f_lottery_info_lastnumber").text();   //最新开奖号码
                var lotteryopen_no1 = $("#j_openNum").val().split(",");
                if (_GetOpenNumbers!=undefined) {
                    clearTimeout(_GetOpenNumbers);
                }
                me.ShowThisIssueOpenAnimate(_ThisOpenIssue, lotteryopen_no1, oLotteryCode, oAjaxUrl);
            };
            
            //倒计时
            var oTimer = setTimeout(function(){me.ruiec_countDown(nextBeginTime,openTimeList,oindex,nextIssue,oFendan,oLotteryCode,oAjaxUrl)},1000);
        },
       /**
        * @content 提示弹窗信息 
        * @name 梁汝翔<liangruxiang>
        * @param nextIssue 上一期， nextIssue2 当前期
        * @time 2015年08月14日 10:58:00
        */
        show_dialog: function (openTimeList,nextIssue,nextIssue2,oLotteryCode,oAjaxUrl) {
        	var me = this;
            var aContent = "<p id='dialog_text'>" + nextIssue + "期已截止</br>当前期为<i class='c_org'>" + nextIssue2 + "</i>期</br>投注时请注意期号！</p>"
            art.dialog({
                icon: "warning",
                id: 'testID2',
                content: aContent,
                lock: true,
                cancelVal: '关闭',
                cancel: true
            });
            art.dialog({ id: 'testID2' }).title('5秒后关闭').time(5);
            
	       
            $("#f_lottery_info_number").text(nextIssue2); //更新新的期号

            //console.log(nextIssue);
            //lrxiang  修改数据
            $("#f_lottery_info_lastnumber").empty().text(nextIssue); //替换旧的期号
            
            
            var oSetZhuiHao=$(".chase_list_tit ul li.curr").index(); 
            
            //如果订单数大于零则一段时间更新追号信息
            var order_line = $("#order_table tr");
            if(order_line.size()>0)
            {
            	if(oSetZhuiHao==0)
	            {
	            	//调取更新追号生成记录
	            	/*me.ruiec_showZhuiHao(openTimeList,nextIssue2,$("#f_chase_period_input").val());*/
	            	$(".chase_list_tit ul li").eq(0).trigger("click");
	            }
	            else
	            {
	            	$("#gjzh_sc").trigger("click");
	            };
            }
            else
            {
            	$("#f_chase_table").empty();
            };
             
            
        },
        /**
         * @content 更新开奖号码，和今日开奖数据 等  需要实时刷新获取数据的方法
         * @name 梁汝翔<liangruxiang>
         * @param oLotteryCode 当前彩种编码， oAjaxUrl 请求接口
         * @time 2015年08月14日 10:58:00
         */
        ConstantRefreshData: function () {
            //获取当前链接的彩参数
            var oLotteryCode = this.ruiec_returnLottery();
            var oAjaxUrl = "/../../tools/ssc_ajax.ashx"; //ajax接口地址 
            var theRootHref = $("#_jsurl").val() == undefined ? "" : $("#_jsurl").val();
            oAjaxUrl = theRootHref + "/../../tools/ssc_ajax.ashx"; 
            //1、刷新开奖号码
            this.ruiec_todayOpen(oLotteryCode, oAjaxUrl);
        }, 
        /**
         * @content 获取彩种玩法的返点数据
         * @name 梁汝翔<liangruxiang>
         * @param lotteryCode 彩种code， playCode = 玩法code
         * @time 2015年8月14日 16:20:00 
         */
        GetLotteryRebate: function (lotterycode, playcode) {
            //$(".choice_cound .fandian #select_fd").empty();
            //$(".choice_cound .fandian").show();
            //var theOptions = "<option value='197000-0.0%'>197000-0.0%</option>";
            //$(".choice_cound .fandian #select_fd").append($(theOptions));

            ////不要返点
            //return true;
            var _this = this; 
            if (lotterycode == undefined) { lotterycode = "1000"; }
            if (playcode == undefined) { playcode = "1000H11"; }
          
            $.ajax({
                type: "POST",
                url: "../tools/ssc_ajax.ashx",
                data: {
                    action: "get_lottery_rebate_list",
                    lottery_code: lotterycode,
                    play_code: playcode
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        if (data.Code != undefined && data.Code == 1) {
                            var theFD_data = data.Data == undefined ? [] : data.Data;
                            if (theFD_data.length > 0) {
                                $(".choice_cound .fandian #select_fd").empty();
                                $(".choice_cound .fandian").show();
                            } else { 
                                $(".choice_cound .fandian").hide(); 
                            }

                            var _FanDianInfos = 0;
							
                            var fdArray = new Array(); 
                            for (var i = 0 ; i < theFD_data.length ; i++) {
                                var theOptions = "<option value='" + theFD_data[i] + "'>" + theFD_data[i] + "</option>";
                                fdArray.push(theFD_data[i]);
                                $(".choice_cound .fandian #select_fd").append($(theOptions)).attr("fdArray",fdArray);

                                if (theFD_data[i] == "0-0.0") {
                                    _FanDianInfos++;
                                } 
                            }

                            if (_FanDianInfos > 0) {
                                $(".choice_cound .fandian").hide();
                            }

                            //根据圆角分模式切换返点
                            _this.ChangeUnitState();
                        }
                    }
                }
            }); 
        },
        /**
         * @content 根据不同的玩法，修改开奖号码的样式
         * @name 梁汝翔<liangruxiang>
         * @param lotteryCode 彩种code， playCode = 玩法code
         * @time 2015年8月14日 16:20:00 
         */
        ShowOpenNumber: function (lotterycode, playcode) {
            if (lotterycode == undefined) { lotterycode = "1000"; } //时时彩
            if (playcode == undefined) { playcode = "1000H11"; }  //五星

            switch (lotterycode) {
                case "1302": //北京快乐8
                    $(".c_open").attr("id", "open_kl8");
                    break;
                case "1303": //北京pk10
                    $(".c_open").attr("id", "open_pk10");
                    break;
                case "1304": //幸运农场
                    $(".c_open").attr("id", "open_xync");
                    break;
                case 1000:
                case "1000":
                default:
                    $(".c_open").removeAttr("id");
                    break;
            }

            //归位倍数和  单位类型
            $("#choice_Multiple").val(1);
            $("#choice_Unit option:eq(0)").prop("selected",true); 
 
        },
        /**
        * 获取投注的遗漏冷热数据
        * @name 梁汝翔<liangruxiang> 
        * @param lotterycode 彩种编码
        * @param playcode 玩法编码  
        * @time 2015年7月28日 10:20:09
        */
        getEachLostHotColl: function (lotterycode, playcode) {
            if (lotterycode == undefined) { lotterycode = "1000"; }
            if (playcode == undefined) { playcode = "1000H11"; }
            var _this = this; 

            //绑定冷热遗漏切换事件
            $("body").on("click", "#Play_BallArea_" + lotterycode + "_" + playcode + "  .game_frequency_type a", function () {
                var theContainer = $(this).parents(".gn_main_tit").eq(0);

                $(this).siblings().removeClass("curr");
                $(this).addClass("curr");

                var theIndex = $(this).index();

                theContainer.find(".game_frequency_item").eq(0).find("li").eq(theIndex).siblings().removeClass("curr");
                theContainer.find(".game_frequency_item").eq(0).find("li").eq(theIndex).addClass("curr");
                theContainer.find(".game_frequency_item").eq(0).find("li").eq(theIndex).find("a:eq(0)").siblings().removeClass("curr"); 
                theContainer.find(".game_frequency_item").eq(0).find("li").eq(theIndex).find("a:eq(0)").addClass("curr");

                if (theIndex == 1) {  //冷热
                    //获取冷热的数据
                    _this.getHotCollData(lotterycode, playcode); 
                    $("#Play_BallArea_" + lotterycode + "_" + playcode + "  .ball_tit span").empty().text("当前冷热"); 
                } else { //遗漏
                    $("#Play_BallArea_" + lotterycode + "_" + playcode + "  .ball_tit span").empty().text("当前遗漏");
                    _this.getCaiZhongLostData(lotterycode, playcode);
                } 
            });

            //绑定冷热遗漏切换事件
            $("body").on("click", "#Play_BallArea_" + lotterycode + "_" + playcode + "  .game_frequency_item li.curr a", function () {
                var theContainer = $(this).parents(".game_frequency_item").eq(0);

                $(this).siblings().removeClass("curr");
                $(this).addClass("curr");

                var theIndex = $(this).parent().index();

                var thePeriodCount = $(this).attr("value") == undefined ? '30' : $(this).attr("value"); 
                if (theIndex == 1) {  //冷热
                    //获取冷热的数据
                    _this.getHotCollData(lotterycode, playcode, thePeriodCount);
                } else { //遗漏
                    _this.getCaiZhongLostData(lotterycode, playcode);
                } 
             
            });



            //初始化获取遗漏数据
            _this.getCaiZhongLostData(lotterycode, playcode);
             
             
        },
        /**
        * 获取投注的遗漏冷热数据的接口方法
        * @name 梁汝翔<liangruxiang>  
        * @param lotterycode 彩种编码
        * @param playcode 玩法编码 
        * @return 类型 action名称
        * @time 2015年7月28日 10:20:09
        */
        getLost_ActByCode: function (lotterycode, playcode) {
            var theResult = {
                LostType: "1",
                Messing_act: "getSSCMissing"
            };

            var theMessing_act = "getSSCMissing";
            var theLostType = "1";



            switch (lotterycode) {
                case "1001":  //重庆时时彩
                case "1002":  //重庆时时彩
                case "1003":  //重庆时时彩
                case "1004":  //重庆时时彩
                case "1005":  //重庆时时彩
                case "1006":  //重庆时时彩
                case "1007":  //重庆时时彩
                case "1008":  //重庆时时彩
                case "1000":  //重庆时时彩
                case "1202":  //重庆时时彩
                    theMessing_act = "getSSCMissing";
                    playcode = playcode.substr(4, playcode.length);
                    
                    //前三直选和值
                    if (playcode == "F13") { theMessing_act = "getSSC_Q3_ZhiXuanHeZhi_Missing"; }
                    //中三直选和值
                    if (playcode == "E13") { theMessing_act = "getSSC_Z3_ZhiXuanHeZhi_Missing"; }
                    //后三直选和值
                    if (playcode == "D13") { theMessing_act = "getSSC_H3_ZhiXuanHeZhi_Missing"; }

                    //前二直选和值
                    if (playcode == "C13") { theMessing_act = "getSSC_Q2_ZhiXuanHeZhi_Missing"; }
                    //后二直选和值
                    if (playcode == "B13") { theMessing_act = "getSSC_H2_ZhiXuanHeZhi_Missing"; }

                    //前三跨度
                    if (playcode == "F14") { theMessing_act = "getSSC_Q3_KuDu_Missing"; }
                    //中三跨度
                    if (playcode == "E14") { theMessing_act = "getSSC_Z3_KuDu_Missing"; }
                    //后三跨度
                    if (playcode == "D14") { theMessing_act = "getSSC_H3_KuDu_Missing"; }

                    //前二跨度
                    if (playcode == "C14") { theMessing_act = "getSSC_Q2_KuDu_Missing"; }
                    //后二跨度
                    if (playcode == "B14") { theMessing_act = "getSSC_H2_KuDu_Missing"; }

                    if (lotterycode == "1202") {
                        //前二跨度
                        if (playcode == "A13") { theMessing_act = "getSSC_H3_ZhiXuanHeZhi_Missing"; }
                        //后二跨度
                        if (playcode == "A14") { theMessing_act = "getSSC_H3_KuDu_Missing"; }
                    } 

                    theLostType = "1";
                    break;
                case "1100":  //广东11选5
                case "1101":  //上海11选5
                case "1102":  //山东11选5
                case "1103":  //江西11选5 
                    theMessing_act = "get11X5Missing";
                    theLostType = "1";
                    break;
                case "1201":  //福彩3d 
                    theMessing_act = "getFuCai_SSLMissing";
                    theLostType = "1";
                    switch (playcode) {
                        case "1201D13": //三星直选和值
                            theMessing_act = "getFuCai_SSL_SanXing_ZhiXuanHeZhi_Missing";
                            theLostType = "3";
                            break;
                        case "1201D14": //三星跨度
                            theMessing_act = "getFuCai_SSL_SanXing_KuDu_Missing";
                            theLostType = "3";
                            break;
                        case "1201C13": //二星直选和值
                            theMessing_act = "getFuCai_SSL_Q2_ZhiXuanHeZhi_Missing";
                            theLostType = "3";
                            break;
                        case "1201C14": //二星跨度
                            theMessing_act = "getFuCai_SSL_Q2_KuDu_Missing";
                            theLostType = "3";
                            break;
                        case "1201B13": //二星直选和值
                            theMessing_act = "getFuCai_SSL_H2_ZhiXuanHeZhi_Missing";
                            theLostType = "3";
                            break;
                        case "1201B14": //二星跨度
                            theMessing_act = "getFuCai_SSL_H2_KuDu_Missing";
                            theLostType = "3";
                            break;  
                        default: 
                            break;
                    }   
                    break;
                default:
                    theMessing_act = "getSSCMissing";
                    theLostType = "1";
                    break;
            }

            theResult.LostType = theLostType;
            theResult.Messing_act = theMessing_act;

            return theResult;
        },
        /**
        * 获取投注的遗漏冷热数据
        * @name 梁汝翔<liangruxiang> 
        * @param lotterycode 彩种编码
        * @param playcode 玩法编码  
        * @param types 当前遗漏和最大遗漏  
        * @time 2015年7月28日 10:20:09
        */
        getCaiZhongLostData: function (lotterycode, playcode, types) {
            if (lotterycode == undefined) { lotterycode = "1000"; }
            if (playcode == undefined) { playcode = "1000H11"; }
            if (types == undefined) { types = "normal"; }

            var _ylShowCont = $("#Play_BallArea_" + lotterycode + "_" + playcode);
            if (_ylShowCont.find('.gn_main_tit').length > 0) {

                var _this = this;
                var theAction_Fn = this.getLost_ActByCode(lotterycode, playcode);
                var theLostType = theAction_Fn.LostType;
                var theMessing_act = theAction_Fn.Messing_act;

                //缓存数据
                var _theDataCache = $("#Play_BallArea_" + lotterycode + "_" + playcode).attr("LostData_" + types) == undefined ? "" : $("#Play_BallArea_" + lotterycode + "_" + playcode).attr("LostData_" + types);
                if (_theDataCache == "") {

                    $.ajax({
                        type: "POST",
                        url: "../tools/ssc_ajax.ashx",
                        data: {
                            action: theMessing_act,
                            lottery_code: lotterycode,
                            play_code: playcode
                        },
                        dataType: "json",
                        success: function (data) {

                            var _dataString = _this.Json_To_String(data);
                            $("#Play_BallArea_" + lotterycode + "_" + playcode).attr("LostData_" + types, _dataString);

                          
                            var _theCaiZhongCommenFn = new $.Lottery_Basic_Fn(); 
                            if (_theCaiZhongCommenFn._Init_CaiZhongLost != undefined) {
                                _theCaiZhongCommenFn._Init_CaiZhongLost(data, playcode, theLostType, lotterycode);
                            } else {
                                _this._Init_CaiZhongLost(data, playcode, theLostType, lotterycode);
                            }
                        }
                    });
                } else {
                    var _dataJSONSting = $("#Play_BallArea_" + lotterycode + "_" + playcode).attr("LostData_" + types);
                    var _dataJSON = _this.GetJsonData(_dataJSONSting);

                    var _theCaiZhongCommenFn = new $.Lottery_Basic_Fn();
                    ////console.log("创建当前彩种的公用对象");
                    if (_theCaiZhongCommenFn._Init_CaiZhongHotColl != undefined) {
                        _theCaiZhongCommenFn._Init_CaiZhongHotColl(_dataJSON, playcode, theLostType, lotterycode);
                    }
                }
            }
            return true;
        },
        /**
        * 获取投注的冷热数据的接口方法
        * @name 梁汝翔<liangruxiang>  
        * @param lotterycode 彩种编码
        * @param playcode 玩法编码 
        * @return 类型 action名称
        * @time 2015年7月28日 10:20:09
        */
        getHotColl_ActByCode: function (lotterycode, playcode, PeriodCount) {
            if (PeriodCount == undefined) { PeriodCount = '30'; }
            var theResult = {
                LostType: "1",
                Messing_act: "getSSCHotCold",
                PeriodCount: PeriodCount
            };

            var theMessing_act = "getSSCHotCold";
            var theLostType = "1";
            var PeriodCount = $("#Play_BallArea_" + lotterycode + "_" + playcode).find(".game_frequency_item").eq(0).find("a.curr").eq(0).attr("value");

            switch (lotterycode) { 
                case "1001":  //重庆时时彩
                case "1002":  //重庆时时彩
                case "1003":  //重庆时时彩
                case "1004":  //重庆时时彩
                case "1005":  //重庆时时彩
                case "1006":  //重庆时时彩
                case "1007":  //重庆时时彩  
                case "1008":  //重庆时时彩
                case "1000":  //重庆时时彩
                case "1202":  //重庆时时彩
                    theMessing_act = "getSSCHotCold";
                    playcode = playcode.substr(4, playcode.length);
                    //console.log(playcode);
                    //前三直选和值
                    if (playcode == "F13") { theMessing_act = "getSSC_Q3_ZhiXuanHeZhi_HotCold"; }
                    //中三直选和值
                    if (playcode == "E13") { theMessing_act = "getSSC_Z3_ZhiXuanHeZhi_HotCold"; }
                    //后三直选和值
                    if (playcode == "D13") { theMessing_act = "getSSC_H3_ZhiXuanHeZhi_HotCold"; }

                    //前二直选和值
                    if (playcode == "C13") { theMessing_act = "getSSC_Q2_ZhiXuanHeZhi_HotCold"; }
                    //后二直选和值
                    if (playcode == "B13") { theMessing_act = "getSSC_H2_ZhiXuanHeZhi_HotCold"; }

                    //前三跨度
                    if (playcode == "F14") { theMessing_act = "getSSC_Q3_KuDu_HotCold"; }
                    //中三跨度
                    if (playcode == "E14") { theMessing_act = "getSSC_Z3_KuDu_HotCold"; }
                    //后三跨度
                    if (playcode == "D14") { theMessing_act = "getSSC_H3_KuDu_HotCold"; }

                    //前二跨度
                    if (playcode == "C14") { theMessing_act = "getSSC_Q2_KuDu_HotCold"; }
                    //后二跨度
                    if (playcode == "B14") { theMessing_act = "getSSC_H2_KuDu_HotCold"; }

                    if (lotterycode == "1202") {
                        //前二跨度
                        if (playcode == "A13") { theMessing_act = "getSSC_H3_ZhiXuanHeZhi_HotCold"; }
                        //后二跨度
                        if (playcode == "A14") { theMessing_act = "getSSC_H3_KuDu_HotCold"; }
                    } 

                    theLostType = "1";
                    break;
                case "1100":  //广东11选5
                case "1101":  //上海11选5
                case "1102":  //山东11选5
                case "1103":  //江西11选5 
                    theMessing_act = "get11X5HotCold";
                    theLostType = "1";
                    break;
                case "1201":  //福彩3d 
                    theMessing_act = "getFuCai_SSLHotCold";
                    theLostType = "1";
                    switch (playcode) {
                        case "1201D13": //三星直选和值
                            theMessing_act = "getFuCai_SSL_SanXing_ZhiXuanHeZhi_HotCold";
                            theLostType = "3";
                            break;
                        case "1201D14": //三星跨度
                            theMessing_act = "getFuCai_SSL_SanXing_KuDu_HotCold";
                            theLostType = "3";
                            break;
                        case "1201C13": //二星直选和值
                            theMessing_act = "getFuCai_SSL_Q2_ZhiXuanHeZhi_HotCold";
                            theLostType = "3";
                            break;
                        case "1201C14": //二星跨度
                            theMessing_act = "getFuCai_SSL_Q2_KuDu_HotCold";
                            theLostType = "3";
                            break;
                        case "1201B13": //二星直选和值
                            theMessing_act = "getFuCai_SSL_H2_ZhiXuanHeZhi_HotCold";
                            theLostType = "3";
                            break;
                        case "1201B14": //二星跨度
                            theMessing_act = "getFuCai_SSL_H2_KuDu_HotCold";
                            theLostType = "3";
                            break;  
                        default: 
                            break;
                    }   
                    break;
                default:
                    theMessing_act = "getSSCHotCold";
                    theLostType = "1";
                    break; 
            } 

            theResult.LostType = theLostType;
            theResult.Messing_act = theMessing_act;

            return theResult;
        },
        /**
        * 获取投注的遗漏冷热数据的接口方法
        * @name 梁汝翔<liangruxiang>  
        * @param lotterycode 彩种编码
        * @param playcode 玩法编码  
        * @time 2015年7月28日 10:20:09
        */
        getHotCollData: function (lotterycode, playcode, PeriodCount) {
            if (PeriodCount == undefined) { PeriodCount == "30"; }
            var theAction_Fn = this.getHotColl_ActByCode(lotterycode, playcode, PeriodCount);
            var theLostType = theAction_Fn.LostType;
            var theMessing_act = theAction_Fn.Messing_act;
            var thePeriodCount = theAction_Fn.PeriodCount;

            var _this = this ;

            //缓存数据
            var _theDataCache = $("#Play_BallArea_" + lotterycode + "_" + playcode).attr("HotCollData_" + thePeriodCount) == undefined ? "" : $("#Play_BallArea_" + lotterycode + "_" + playcode).attr("HotCollData_" + thePeriodCount)  ;
            if(_theDataCache==""){
                $.ajax({
                    type: "POST",
                    url: "../tools/ssc_ajax.ashx",
                    data: {
                        action: theMessing_act,
                        lottery_code: lotterycode,
                        play_code: playcode,
                        periodCount: thePeriodCount
                    },
                    dataType: "json",
                    success: function (data) { 
                        var _dataString = _this.Json_To_String(data);
                        $("#Play_BallArea_" + lotterycode + "_" + playcode).attr("HotCollData_" + thePeriodCount, _dataString);

                        var _theCaiZhongCommenFn = new $.Lottery_Basic_Fn();
                        ////console.log("创建当前彩种的公用对象");
                        if (_theCaiZhongCommenFn._Init_CaiZhongHotColl != undefined) {
                            _theCaiZhongCommenFn._Init_CaiZhongHotColl(data, playcode, theLostType, lotterycode); 
                        }
                    }
                }); 
            }else{  
                var _dataJSONSting = $("#Play_BallArea_" + lotterycode + "_" + playcode).attr("HotCollData_" + thePeriodCount); 
                var _dataJSON = _this.GetJsonData(_dataJSONSting);

                var _theCaiZhongCommenFn = new $.Lottery_Basic_Fn();
                ////console.log("创建当前彩种的公用对象");
                if (_theCaiZhongCommenFn._Init_CaiZhongHotColl != undefined) {
                    _theCaiZhongCommenFn._Init_CaiZhongHotColl(_dataJSON, playcode, theLostType, lotterycode);
                }
            } 
        },  
         /**
         * @content 提交后清除选池中的订单、金额
         * @author  王志豪<wangzhihao>  
         * @time 2015年8月17日 11:07:09
         */
        ruiec_clearChoiceOrder:function(){
        	$("#order_table").empty();
        	$("#f_gameOrder_lotterys_num").text("0");
        	$("#f_gameOrder_amount").text("0.00");
        	$("#isZigou input").trigger("click");
        	$("#choice_comfire_btn").removeClass("curr");
        }, 
    	/**
		* @content 更新服务器时间
		* @author  王志豪<wangzhihao> 
		* @time   2015年8月27日 20:50:09
		*/
    	ruiec_updateServerTime : function(){
    		var me = this;
		    $.ajax({
			    type: "POST",
			    url: "../tools/ssc_ajax.ashx",
			    data: {"action":"server_dateTime"},
		        dataType: "json", 
		        success: function(data){
		            var oDate = data.Data; 
		            var oServerTime = me.ruiec_TimeToDate(oDate);
		            $(".j_lottery_time").attr("servertime",oServerTime);		
		        }    
		    });
		   	
    	},
    	/**
		* @content 每秒累加服务器时间
		* @author  王志豪<wangzhihao> 
		* @time   2015年8月30日 20:50:09
		*/
    	ruiec_addServerTime : function(){
    	    var oServerTime = parseInt($(".j_lottery_time").attr("servertime"));
    	    var oNowTime = new Date();
    	    oNowTime = oNowTime.getTime();
    	    oServerTime = isNaN(oServerTime) ? oNowTime : oServerTime; 
    		oServerTime = oServerTime + 1000;
    		$(".j_lottery_time").attr("servertime",oServerTime)
    	},
        /**
        * @content 更新合买的权限和合买是否保底
        * @name 梁汝翔<liangruxiang>  
        * @param lotterycode 彩种编码
        * @param oAjaxUrl 数据请求接口  
        * @time   2015年8月27日 20:50:09
        */
    	ChangeHeMaiInfos: function (lotterycode, oAjaxUrl) { 
    	    return true; 
    	},
       /**
        * @content 计算合买的金额
        * @author  梁汝翔<liangruxiang> 
        * @param OrderPrice 订单总额
        * @param ChaiFenNumb 拆分的份数
        * @param GouMaiFenNumb 保底份数
        * @param BaodiFenNumb 保底份数
        * @time 2015年7月28日 10:07:09
        */
        GetHeMaiAmount: function (OrderPrice,ChaiFenNumb,GouMaiFenNumb,BaodiFenNumb) {
            return true;
        },
       /**
        * @content 绑定立即下单的点击事件
        * @author  梁汝翔<liangruxiang> 
        * @param _CheckBall 选号的组合数据
        * @time 2015年7月28日 10:07:09
        */
        blind_heimai_change: function (OrderPrice) {
            return true;
        },
        /**
        * @content 验证合买金额是否正确
        * @author  梁汝翔<liangruxiang> 
        * @param _CheckBall 选号的组合数据
        * @time 2015年7月28日 10:07:09
        */
        check_hemaiPrice: function (OrderPrice, theValue) {
            var theEachMoney = parseFloat(OrderPrice / theValue).toFixed(2);  //遍历当前份数下的每份的金额 
            if (theEachMoney >= 0.2) {
                var theEachMoneyStr = parseFloat(theEachMoney).toFixed(3).toString();
                if (theEachMoneyStr != "") {
                    theEachMoneyStrArray = theEachMoneyStr.split("."); //以.进行分割
                    if (typeof theEachMoneyStrArray == "object" && theEachMoneyStrArray.length > 1) {
                        var theXiaoshu = theEachMoneyStrArray[1].toString();
                        var theXiaoshuLen = theXiaoshu.length; //小数位的长度
                        if (theXiaoshuLen > 2) {  //小数位的长度大于二
                            var theEndValue = theXiaoshu.substr(theXiaoshu.length - 1, theXiaoshu.length);
                            if (theEndValue > 0) {
                                var theMaxFenshu = OrderPrice / 0.2;
                                $("#hemai_fen").val(theMaxFenshu);
                                $("#EachMoney").empty().text("0.2");
                            } else {
                                $("#hemai_fen").val(theValue);
                                $("#EachMoney").empty().text(parseFloat(theEachMoney).toFixed(2));
                            }
                        } else {
                            $("#hemai_fen").val(theValue);
                            $("#EachMoney").empty().text(theEachMoney);
                        }
                    } else {
                        $("#hemai_fen").val(theValue);
                        $("#EachMoney").empty().text(theEachMoney);
                    }
                }
            }
            $("#hemai_rengou").focus();
        },
        /**
         * @content 统计合买金额
         * @author  梁汝翔<liangruxiang>  
         * @time 2015年7月28日 10:07:09
         */
        Tongji_HmOrder: function (OrderPrice) {
            var HmInfos = {
                CanSub: true
            };
            var theOrderPrice = OrderPrice == undefined ? 0 : OrderPrice;
            if (theOrderPrice <= 0) {
                alert("error");
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

                //if (theHeMaiMoney / OrderPrice > 0.9) { //大于90%
                //    HmInfos.CanSub = true ;
                //} 
            }
            return HmInfos;
        }, 
        /**
        * @content 初始化彩种遗漏数据
        * @name 梁汝翔<liangruxiang>
        * @param data 当前彩种的遗漏冷热数据
        * @param playcode 玩法编码
        * @param type 遗漏、冷热 type 为undefined 为 遗漏，2 为冷热
        * @time 2015年08月13日 16:58:00
        */
        _Init_CaiZhongLost: function (data, playcode, type,lottery_code) {
            //console.log("当前遗漏数据为", data);
            //获取当前玩法是否需要展示遗漏
            var thePlayContainer = $("#Play_BallArea_"+lottery_code+"_" + playcode); 
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
        * @content 初始化彩种冷热数据[ 默认时时彩类型 ]
        * @name 梁汝翔<liangruxiang>
        * @param data 当前彩种的遗漏冷热数据
        * @param playcode 玩法编码
        * @param type 遗漏、冷热 type 为undefined 为 遗漏，2 为冷热
        * @time 2015年08月13日 16:58:00
        */
        _Init_CaiZhongHotColl: function (data, playcode, type, lottery_code) {

            //获取当前玩法是否需要展示遗漏
            var thePlayContainer = $("#Play_BallArea_" + lottery_code + "_" + playcode);
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
        * @content 快乐8多彩种奖金展示图表
        * @name 王志豪<wangzhihao>
        * @param type 遗漏、冷热 type 为undefined 为 遗漏，2 为冷热
        * @time 2015年09月14日 16:58:00
        */
        ruiec_showRewardTable: function (oplay_code, g_cardinal_money, cardinal_money_arry, me) { 
        	if(cardinal_money_arry)
        	{
        		var cardinal_money_arry = cardinal_money_arry.reverse();
        	};
        	
        	var LotteryCode = parseInt(me.ruiec_returnLottery()); //获取当前的彩种代码
        	var oControlId="#Play_BallArea_"+LotteryCode +"_"+ oplay_code;
        	$(oControlId).find(".ball_sm").remove(); 
             
        },
        /**
        * @content 点击“我要自购”、“我要追号”、“发起合买”切换
        * @author  王志豪<wangzhihao> 
        * @param _CheckBall 选号的组合数据
        * @time 2015年9月18日 10:07:09
        */
        ruiec_choiceSubType:function () {
            $(".chase_Program").on("click","label",function(){
            	var oId = $(this).attr("id");
            	if(oId == "isChase" && $(this).children("input").prop("checked") == true && $("#order_table tr").size()>0)
            	{
            		$("#choice_Multiple").attr("disabled","true").val("1");
            	}
            	else
            	{
            		$("#choice_Multiple").removeAttr("disabled");
            	};
            });
        },
        /**
        * @content 获取彩种名称
        * @author  梁汝翔<liangruxiang>
        * @param lottery_code 彩种编码
        * @time 2015年9月18日 10:07:09
        */
        get_olotteryName:function(lottery_code){
            if (lottery_code == undefined) { lottery_code = "1000" }
            var _lottery_name = "";
            switch (lottery_code) { 
                case "1301":
                    _lottery_name = "安徽快三";
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
                    _lottery_name = "安徽快三";
                    break;
            }
            return _lottery_name;
        },
        /**
        * @content 任选注数计算处理
        * @author  王志豪<wangzhihao>
        * @param lottery_code 彩种编码
        * @param num 任选个数
        * @time 2015年9月18日 10:07:09
        */
        ruiec_Manage_renxuan:function(num){
        	//任选单式处理
        	var oLottery_play = $(".play_select_cont>li.curr dd.curr").attr("lottery_code");
			var oLottery = me.ruiec_returnLottery();
			var SectionId = "Play_BallArea_"+oLottery+"_"+oLottery_play;
			var rx_typeChoice_label = $("#"+SectionId).find(".rx_typeChoice label");
			var oNarray = new Array();
			var n=0;
			if(num=="" || num == undefined)
			{
				num = 2;
			};
			for(var a=0;a<rx_typeChoice_label.size();a++)
			{
				if(rx_typeChoice_label.eq(a).children("input").prop("checked")==true)
				{
					oNarray.push(a);
				};
			};
			
			
			if(num==2) //任二直选单式
			{
				if(oNarray.length>0)
				{
					for(var a=0;a<oNarray.length;a++)
					{
						for(var b=a+1;b<oNarray.length;b++)
						{
							n =n+1;
						};
					};
				}
			}
			
			if(num==3) //任三直选单式
			{
				var n=0;
				if(oNarray.length>0)
				{
					for(var a=0;a<oNarray.length;a++)
					{
						for(var b=a+1;b<oNarray.length;b++)
						{
							for(var c=b+1;c<oNarray.length;c++)
							{
								n =n+1;
							};
						};
					};
				}
			}
			
			if(num==4) //任四直选单式
			{
				var n=0;
				if(oNarray.length>0)
				{
					for(var a=0;a<oNarray.length;a++)
					{
						for(var b=a+1;b<oNarray.length;b++)
						{
							for(var c=b+1;c<oNarray.length;c++)
							{
								for(var d=c+1;d<oNarray.length;d++)
								{
									n =n+1;
								};
							};
						};
					};
				}
			}
			return n;
        },
        /**
        * @content input限制输入最大值
        * @author  王志豪<wangzhihao> 
        * @param obj 限制对象、max是限制最大数
        * @time 2015年10月14日 16:07:09
        */
        ruiec_inputMaxLimit:function(obj,max){
        	$(obj).keyup(function(){
        		if(max)
	        	{
	        		oMax = max;
	        	}
	        	else
	        	{
	        		if($(this).attr("max"))
	        		{
	        			oMax = $(this).attr("max")
	        		}
	        		else
	        		{
	        			oMax = 99999;
	        		};
	        	};
	        	var oVal=parseInt($(this).val());
	        	if(oVal>oMax)
	    		{
	    			$(this).val(oMax);
	    		};
        	}); 
        },
        /**
        * @content 派奖通知
        * @author  梁汝翔<liangruxiang>
        * @param IssueNumb 当前期
        * @param Lottery_code 彩种编号
        * @time 2015年9月18日 10:07:09
        */
        ruiec_showOpenNumbers: function (IssueNumb, Lottery_code) { 
            //get_betting_profit_loss();
            if (_GL_Openinits >= 0) {

                $.ajax({
                    type: "post",
                    url: "../tools/ssc_ajax.ashx",
                    data: {
                        action:'get_betting_profit_loss',
                        issueNo:IssueNumb,
                        lottert_code: Lottery_code
                    },
                    dataType: "json",
                    success: function (data) {
                        //console.log(data);
                        if (data.Code == 1) {
                            
                            var _TZ_Values = $.parseJSON(data.Data);
                            var _GuestName = $("#myaccount #userName").text(); //用户名 
                            var _PaiJiang_Infos = "<div class='PaiJian_dialog' style='text-align:left;line-height:24px;'>";
                            _PaiJiang_Infos += "<p>尊敬的&nbsp;" + _GuestName + "&nbsp;你好</p>";
                            _PaiJiang_Infos += "<p>您在&nbsp;[&nbsp;" + IssueNumb + "&nbsp;]&nbsp;期，</p>";
                            _PaiJiang_Infos += "<p>投注￥：[<i>" + _TZ_Values.betting_money + "</i>]元，</p>";
                            _PaiJiang_Infos += "<p>中奖￥：[<i class='c_org'>" + _TZ_Values.bonus_money + "</i>]元,</p>";
                            if (Number(_TZ_Values.profit_loss)>0) {
                                _PaiJiang_Infos += "<p>盈亏￥：[<i class='c_red'>" + _TZ_Values.profit_loss + "</i>]元</p>";
                            } else {
                                _PaiJiang_Infos += "<p>盈亏￥：[<i class='c_green'>" + _TZ_Values.profit_loss + "</i>]元</p>";
                            } 

                            _PaiJiang_Infos += "</div>";

                            //实时监测通知公告
                            art.dialog({
                                id: 'msg',
                                title: '派奖通知',
                                content: _PaiJiang_Infos,
                                width: 200,
                                padding: "10px",
                                left: '100%',
                                top: '100%',
                                fixed: true,
                                drag: true,
                                resize: false,
                                time: 5
                            });
                        } 
                    },
                    error: function () {
                        
                    }
                }) 
            }

            _GL_Openinits++;
           
        },
        /**
        * @content 去除Loading事件
        * @author  王志豪<wangzhihao> 
        * @time 2015年10月18日 16:07:09
        */
        ruiec_removeLoading:function(){
        	$("body").find("#loading").remove(); 
        },
        /**
        * @content 验证二维数组中是否存在相同的数组，如果存在则剔除重复内容，不存在则返回数组
        * @author  梁汝翔<liangruxiang>
        * @param arr2 数组
        * @state state 状态 true  有序判断， fals 为无序判断
        * @time 2015年10月18日 16:07:09
        */
        CheckTowDRepeatArray: function (arr2, state) {
            var _CurrectArray = new Array(), _StringArray = new Array() , _this = this; //正确的数组
            if (arr2 != undefined && arr2.length > 1) { 
                if (state) {  //无序数组去重 
                    //把所有的二维数组全部排序之后，再进行有序去重

                    for (var s = 0 ; s < arr2.length; s++) {
                        var thePaiXuInfos = _this.ArraySort(arr2[s]); 
                        _StringArray.push(thePaiXuInfos);
                    }

                    var hash = {};
                    var result = [];
                    for (var i = 0, len = _StringArray.length; i < len; i++) {
                        if (!hash[_StringArray[i]]) {
                            result.push(_StringArray[i]);
                            hash[_StringArray[i]] = true;
                        }
                    }
                    _CurrectArray = result;
                } else { //有序数组去重

                    var hash = {};
                    var result = [];
                    for (var i = 0, len = arr2.length; i < len; i++) {
                        if (!hash[arr2[i]]) {
                            result.push(arr2[i]);
                            hash[arr2[i]] = true;
                        }
                    }
                    _CurrectArray = result ;
                }

                return _CurrectArray;

            } else {
                return arr2;
            }
        },
       /**
        * @content 一维数组排序
        * @author  梁汝翔<liangruxiang>
        * @param arr1 数组 
        * @time 2015年10月18日 16:07:09
        */
        ArraySort: function (array) {
            return array.sort(function (a, b) {
                return a - b;
            });
        },
        /**
        * @content 单式选号区点击”删除错误项“效果
        * @author  王志豪<wangzhihao>
        * @param BallAreaHtml单式选号区
        * @time 2015年10月29日 14:07:09
        */
       	ruiec_clickErrorBtn:function(){
       		
       		$(".ball_section").on("click",".del_error",function(){
				var oThis = $(this)
				var errorArray = oThis.attr("errorArray");  //错误项
				var rightArray = oThis.attr("rightArray");  //正确值
				if(errorArray!='' && errorArray!=undefined)
				{
					artDialog({
						content:"删除不符合玩法号码：" +errorArray,
						icon:"warning",
						lock:true,
						ok:function(){},
						okMsg:"确定"
					})
					
					if(rightArray!="")
					{
						oThis.parents(".ball_section_ds").eq(0).find(".ds_textarea").val(rightArray).trigger("keyup");
					}
					else
					{
						oThis.parents(".ball_section_ds").eq(0).find(".ds_textarea").val("").trigger("keyup");
					};
					oThis.attr("errorArray","");
				};
			}); 
			
			//检查格式是否正确
       		$(".ball_section_ds").on("click",".del_unique",function(){
       			$(this).siblings(".del_error").trigger("click");
       		});
       			
       	},
       /**
        * @content 设定玩法的投注权限
        * @author  梁汝翔<liangruxiang>
        * @param arr1 数组 
        * @time 2015年10月18日 16:07:09
        */
       	setBettingAuthority: function () {
       	    var _theTypes = $("#UserBettingAuthority").val() == undefined ? "" : $("#UserBettingAuthority").val();
       	    if (_theTypes == "False") {
       	        //$(".g_Chase_Section").empty();
       	        //$(".g_BetBtn_Section").empty();
       	    }  
       	},
       /**
        * @content 获取时时彩的开奖号码
        * @author  梁汝翔<liangruxiang> 
        * @time 2015年11月05日 16:07:09
        */
       	GetQuick_OpenNumber: function (oAjaxUrl, lottery_code, _thisIssueTime_No) {
       	    var me = this;
       	    var _theTimes = new Date();
       	    //console.log("_theTimes======" + _theTimes + "==========_thisIssueTime_No======" + _thisIssueTime_No);
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
       	                        var oOpenNum_ball = '<li class="open_numb_' + oOpenNum_item + '">' + oOpenNum_item + '</li>';
       	                        oOpenNum_ball_all = oOpenNum_ball_all + oOpenNum_ball;
       	                    };
       	                    $("#openNum_list").empty().html(oOpenNum_ball_all); 
       	                    clearTimeout(_GetOpenNumbers); 
       	                    _GetOpenNumbers = undefined;
 
       	                    var _theOpenTime = data.open_time; //开奖时间
       	                    var _theOpenIssue = data.issue_no; //开奖期号
       	                    var _theOpenNob = data.lotteryopen_no; //开奖号码

       	                    _theOpenTime = _theOpenTime.replace(/[^\d]/g, '');
       	                    _theOpenTime = isNaN(parseInt(_theOpenTime)) ? "" : parseInt(_theOpenTime);
       	                    if (_theOpenTime == "") {
       	                        var _openTimeInfos = new Date(_theOpenTime);
       	                    } else {
       	                        var _openTimeInfos = new Date();
       	                    } 
       	                    var _theOpenTimeHours = parseInt(_openTimeInfos.getHours());  //时
       	                    var _theOpenTimeMin = parseInt(_openTimeInfos.getMinutes());  //分
       	                    var _theOpenTimeSec = parseInt(_openTimeInfos.getSeconds());  //秒
                             
       	                    if (_theOpenTimeHours < 10) {
       	                        _theOpenTimeHours = "0" + _theOpenTimeHours;
       	                    }

       	                    if (_theOpenTimeMin < 10) {
       	                        _theOpenTimeMin = "0" + _theOpenTimeMin;
       	                    }

       	                    if (_theOpenTimeSec < 10) {
       	                        _theOpenTimeSec = "0" + _theOpenTimeSec;
       	                    }

       	                    var _theOpenTimeStr = _theOpenTimeHours + ":" + _theOpenTimeMin + ":" + _theOpenTimeSec; 


       	                    var _NumberArray = _theOpenNob.split(",");
       	                    var _NumberHeZhi = Number(_NumberArray[0]) + Number(_NumberArray[1]) + Number(_NumberArray[2]);
       	                    if (!isNaN(Number(_NumberHeZhi))) {
       	                        var da = "小";
       	                        if (Number(_NumberHeZhi)>10) {
       	                            da = "大";
       	                        }

       	                        var danshuan = "单";
       	                        if (Number(_NumberHeZhi)%2 == 0) {
       	                            danshuan = "双";
       	                        }  
       	                        function GetCLass(values) {
       	                            var ClassInfo = "";
       	                            switch (values) {
       	                                case "大": 
       	                                    ClassInfo = "bg_zyell";
       	                                    break;
       	                                case "小":
       	                                    ClassInfo = "bg_purple";
       	                                    break;
       	                                case "单":
       	                                    ClassInfo = "bg_green";
       	                                    break;
       	                                case "双":
       	                                    ClassInfo = "bg_blue";
       	                                    break; 
       	                                case "":
                                        default:
       	                                    break; 
       	                            }
       	                            return ClassInfo;
       	                        } 
       	                        var _theBollClass = GetCLass(da);
       	                        var _theBollClass2 = GetCLass(danshuan);

       	                        if (_theBollClass == "") _theBollClass = "bg_zyell";
       	                        if (_theBollClass2 == "") _theBollClass = "bg_blue";

       	                        var _theNewString = "<tr>";
       	                            _theNewString += "  <td class='fz13'>" + _theOpenIssue + "</td>";
       	                            _theNewString += "  <td class='c_red fb'>" + _theOpenNob + "</td>";
       	                            _theNewString += "  <td class='c_blue fb'>" + _NumberHeZhi + "</td>";
       	                            _theNewString += "  <td>";
       	                            _theNewString += "      <em class='" + _theBollClass + "'>" + da + "</em>";
       	                            _theNewString += "      <i>|</i>";
       	                            _theNewString += "      <em class='" + _theBollClass2 + "'>" + danshuan + "</em>";
       	                            _theNewString += "  </td>";
       	                            _theNewString += "</tr>"; 
       	                        $("#fn_getoPenGame .tbody").prepend($(_theNewString));
       	                        $("#fn_getoPenGame .tbody tr:last").remove();
       	                    }  
       	                } else {
       	                    var oOpenNum = [];
       	                    _GetOpenNumbers = setTimeout(function () {
       	                        //快速获取开奖号码
       	                        me.GetQuick_OpenNumber(oAjaxUrl, lottery_code, _thisIssueTime_No);
       	                    }, 1000);
       	                } 
       	            } else {
       	                _GetOpenNumbers = setTimeout(function () {
       	                    //快速获取开奖号码
       	                    me.GetQuick_OpenNumber(oAjaxUrl, lottery_code, _thisIssueTime_No);
       	                }, 1000);
       	            }
       	        }
       	    });

       	},
       	/**
        * @content 追号提交成功后复原追号的基础参数
        * @author  王志豪<wangzhihao>
        * @param arr1 数组 
        * @time 2015年10月18日 16:07:09
        */
       	ruiec_clearZhuiHao: function () {
       	    $("#f_chase_period_select li").removeClass("curr").eq(1).addClass("curr");
       	    $("#f_chase_period_input").val(10);
       	    $("#f_chase_Multiple").val(1);
       	},
       	/**
        * @content 数字input加减箭头(ie不兼容处理)
        * @author  王志豪<wangzhihao>
        * @time 2015年11月18日 16:07:09
        */
       	ruiec_numInput: function () {
       	   var oUp = $(".fn_numInput .up");   //上箭头
       	   var oDown = $(".fn_numInput .down"); //下箭头
       	   oUp.click(function(){
       	   	 var oInput = $(this).siblings("input");
       	   	 var oMax = parseInt(oInput.attr("max"));
       	   	 var oVal = parseInt(oInput.val());
       	   	 oVal = isNaN(oVal)?1:oVal;
       	   	 if(oVal<oMax)
       	   	 {
       	   	 	oVal = oVal+1;
       	   	 }
       	   	 oInput.val(oVal).trigger("keyup").trigger("change");
       	   });
       	   oDown.click(function(){
       	   	 var oInput = $(this).siblings("input");
       	   	 var oMin = parseInt(oInput.attr("min"));
       	   	 var oVal = parseInt(oInput.val());
       	   	 oVal = isNaN(oVal)?1:oVal;
       	   	 if(oVal>oMin)
       	   	 {
       	   	 	oVal = oVal-1;
       	   	 }
       	   	 oInput.val(oVal).trigger("keyup").trigger("change");
       	   });
       	}
    };

    $.extend({ ruiec_GameBet: ruiec_GameBet });

})(jQuery)



$(document).ready(function () {
    var _jsurl = $("#_jsurl").val(); //获取页面隐藏路径 
    var ruiec_GameBet = new $.ruiec_GameBet();
    ruiec_GameBet.init({
        Js_Url: _jsurl
    });

});





