// JavaScript Document 

// | 技术支持：88375133@qq.com
// +----------------------------------------------------------------------
// | 电 话： 0755-33581131
// +----------------------------------------------------------------------
// | Author: 梁汝翔 <liangruxiang>
// +----------------------------------------------------------------------
// | Date: 2015年7月28日 10:30:00
// +----------------------------------------------------------------------
// | Name: RSSC_Play_1100I11.js (安徽快三,三同号通选,三同号,通选)[complete]
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

(function ($, ruiec_GameBet, Lottery_Basic_Fn) {
    //声明一个对象，设定为：GamBet的基础对象
    var _GameBetobj = new ruiec_GameBet();

    var _Lottery_Basic_Fn = new Lottery_Basic_Fn();

    //创建一个基础构造函数
    var Play_Basic_Obj = function () {
        this.param = "";
    }

    Play_Basic_Obj.prototype = {
        /**
		* @content 玩法入口
		* @author  梁汝翔<liangruxiang> 
		* @returns 返回最终的选号结果
		* @time 2015年7月28日 10:07:09
		*/
        Init: function (setOption) {
            //调用函数Creat_ball_area；生成玩法的球形选区；返回选区Html
            ////console.log("玩法入口___安徽快三,三同号通选,三同号,通选");
            var BallAreaHtml = this.Creat_ball_area();

            if (typeof BallAreaHtml == "object" && BallAreaHtml.AreaId != undefined) {
                //绑定删除订单的事件
                _GameBetobj.Del_TzOrder();
                //绑定选球的事件 
                var _Check_Ball = this.Blind_CheckBall(BallAreaHtml);
            }
        },

        /**
		* @content 生成玩法的球形选区,初始化玩法，绑定玩法事件
		* @author  梁汝翔<liangruxiang> 
		* @returns 返回选区Html
		*  @time 2015年7月28日 10:07:09
		*/
        Creat_ball_area: function () {

            var _playBollArea = {};
            var strVar = "";
            var _lottyCode = _GameBetobj.ruiec_returnLottery();
            var _lottyPlayCode = _GameBetobj.ruiec_getLotteryPlayData();
            var _RandomsId = "Play_BallArea_" + _lottyCode + "_" + _lottyPlayCode;
            ////console.log(_RandomsId);
            if ($("#Game_CheckBall #" + _RandomsId).size() > 0) {
                $("#Game_CheckBall .ball_section").hide();
                $("#Game_CheckBall .gn_main_cont").eq(0).find("#" + _RandomsId).eq(0).show();
                var TheHtml = $("#Game_CheckBall .gn_main_cont").eq(0).find("#" + _RandomsId).eq(0).html();
                strVar = "<div class=\"ball_section section_cqssc\" id='" + _RandomsId + "'>" + TheHtml + "</div>";
            } else {
                  
                strVar += "<div class=\"ball_section section_cqssc\" id='" + _RandomsId + "'>";
                strVar += "     <div class=\"gn_main_list\" style='background:none;'>";
                strVar += "     <ul>";
                strVar += "	        <li class=\"li_ball curr\" style='width:100%; text-align:center;'>";
                strVar += "             <ul class=\"ball_cont\" style=\"display:inline-block;width:100%;\">";
                strVar += "                 <li style=\"height:80px;width:96%;padding-top: 20px; float: none; display:block;\">";
                strVar += "	                    <a id='slhtx_btn' style='float:none;width:180px;border:1px solid #ddd; background:#EEE; margin:0px auto; display:block;' class=\"ball_number ethdx_btn\" ball-number=\"111 222 333 444 555 666\" href=\"javascript:void(0);\">";
                strVar += "	                       三同号通选"
                strVar += "                     <\/a>";
                strVar += "                 <\/li>";
                strVar += "             <\/ul>";
                strVar += "	        <\/li>"; 
                strVar += "	    <\/ul>";
                strVar += "     <\/div>";
                strVar += "<\/div>";


                if ($("#Game_CheckBall .gn_main_cont").size() > 0) {
                    $("#Game_CheckBall .ball_section").hide();
                    $("#Game_CheckBall .gn_main_cont").eq(0).append($(strVar));
                    $("#Game_CheckBall #" + _RandomsId).show();
                }
            }
            _playBollArea.html = strVar;
            _playBollArea.AreaId = _RandomsId;

            return _playBollArea;
        },
        /**
       * @content 绑定选球的事件,根据事件返回选择的投注
       * @author  梁汝翔<liangruxiang> 
       * @returns 返回选区Html
       *  @time 2015年7月28日 10:07:09
       */
        Blind_CheckBall: function (BallArea) {
            var _this = this;
            var _CheckBall;
            var _AreaContainer = $("#" + BallArea.AreaId); //追加的选球区域
            var _CheckBall_Array = new Array();
           
            $(".g_Panel_Section").hide();
            //绑定选号[单击选号]
            _AreaContainer.off("click").on("click", " .ball_number", function () {
                var theStatue = $(this).hasClass("curr"); //当前的选中状态 
                if (!theStatue) {
                    $(this).addClass("curr");  
                } else {
                    $(this).removeClass("curr");
                }

                var _GetTz_Ball = _this.GetBlind_CheckBall(_AreaContainer);
                if (typeof _GetTz_Ball == "object" && _GetTz_Ball.length > 0) {
                    var _tzInfos = _this.GetZhuShu(_GetTz_Ball); // { tzLen:n,tzInfos:infos }
                    if (typeof _tzInfos == "object") {
                        var _tzLen = _tzInfos.tzLen;
                        $("#choice_zhu").empty().text(_tzLen);
                    }
                }

                //改变金额
                _GameBetobj.Change_tzPrice();

                //进行投注 
                _CheckBall = _this.GetBlind_CheckBall(_AreaContainer);
                _this.Creat_TZ_Infos(_CheckBall, _AreaContainer);
            });
              
            //点击确认投注，获取投注的号码和单位
            $("#choice_comfire_btn").unbind().click(function () {
                _CheckBall = _this.GetBlind_CheckBall(_AreaContainer);
                 
                _this.Creat_TZ_Infos(_CheckBall, _AreaContainer);

            })
             
            return _CheckBall;
        },

        /**
         * @content 遍历获取所有选球
         * @author  梁汝翔<liangruxiang> 
         * @returns 返回选区Html
         *  @time 2015年7月28日 10:07:09
         */
        GetBlind_CheckBall: function (_AreaContainer) {
            var _CheckBall_Array = new Array();
            //遍历所有位数选中的号码 
            var _Ball_length = _AreaContainer.find(".li_ball").length;
            if (_Ball_length > 0) {
                for (var i = 0 ; i < _Ball_length ; i++) {
                    var _CheckLinObj = {};
                    var _CheckBoll_LineArry = new Array();
                    _AreaContainer.find(".li_ball").eq(i).find(".ball_number.curr").each(function () {
                        var _theValue = $(this).attr("ball-number");
                        _CheckBoll_LineArry.push(_theValue);
                    });
                    var TheName = "[三连号通选]";
                    _CheckLinObj.name = TheName;
                    _CheckLinObj.value = _CheckBoll_LineArry;
                    _CheckBall_Array.push(_CheckLinObj);
                }
            }
            return _CheckBall_Array;
        },

        /**
         * @content 根据选球号码计算投注的注数
         * @author  梁汝翔<liangruxiang> 
         * @param CheckBallData :
         * @returns 返回{ tzLen:n,tzInfos:infos }
         *  @time 2015年7月28日 10:07:09
         */
        GetZhuShu: function (CheckBallData) {
            //////console.log("根据选球号码计算投注的注数");
            var _ZhuShuArray;
            if (CheckBallData != undefined && CheckBallData != "") {
                
              
                if (CheckBallData[0].value != undefined && CheckBallData[0].value.length > 0) {

                    _ZhuShuArray = {};
                    _ZhuShuArray.tzLen = 1;
                    //_ZhuShuArray.tzInfos = "111 222 333 444 555 666";
                    _ZhuShuArray.tzInfos = "三同号通选"; //wzh改
                      
                } 
            }
            if (_ZhuShuArray == undefined) { _ZhuShuArray = ""; }

            return _ZhuShuArray;

        },
       
        /**
         * @content 根据数据创建投注的号码信息
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         *  @time 2015年7月28日 10:07:09
         */
        Creat_TZ_Infos: function (_CheckBall, _AreaContainer) {
            ////console.log(_CheckBall);
            var _this = this;
            var _tz_type = _CheckBall[0].name; //投注的类型

            var _Tz_obj = _this.GetZhuShu(_CheckBall);  //获取投注的注数以及，投注的信息

            var _tz_infos = _Tz_obj.tzInfos; //投注的选号字符串 
			 

            var _tz_ZLen = _Tz_obj.tzLen == undefined ? 0 : _Tz_obj.tzLen; //注数

            if (_tz_ZLen > 0) {
                
                var _getLottyCode = _GameBetobj.ruiec_returnLottery();  //获取彩种 
                var _OrderObj = {};  //订单数据
                _OrderObj._getLottyCode = _getLottyCode;
                _OrderObj._tz_infos = _tz_infos;
                _OrderObj._tz_type = _tz_type;
                _OrderObj._tz_UnitStr = "元";
                _OrderObj._tz_ZLen = _tz_ZLen;
                _OrderObj._tz_beishu = 1;
                _OrderObj._tz_Price = 0;
                 
                //根据选中的数据，创建order订单：并插入到订单Table里面；
                _Lottery_Basic_Fn.CreatTzOrder_FillInTable(_OrderObj, _AreaContainer);
                
            }
            else {
                artDialog({
                    icon: "warning",
                    content: " 号码选择不完整，请重新选择！",
                    cancel: function () {

                    },
                    lock: true
                });
                return false;
            }
        },
        /**
         * @content 获取随机一注的数据
         * @author  梁汝翔<liangruxiang> 
         * @param _CheckBall 选号的组合数据
         *  @time 2015年7月28日 10:07:09
         */
        getOneRandomBetting: function (_AreaContainer) {
            //清除已选号码
            _AreaContainer.find("a[ball-number]").removeClass("curr");
            //清除按钮的修改状态
            $("#choice_comfire_btn").removeAttr("editorid");
            $("#choice_comfire_btn em").empty().text("确认选号");
            _AreaContainer.find(".ball_cont").eq(0).find("a[ball-number]").eq(0).addClass("curr");
            $("#choice_comfire_btn").click();
        }
    }
    //开始，初始化执行
    var _PlayBoll = new Play_Basic_Obj();
    _PlayBoll.Init();

})(jQuery, $.ruiec_GameBet, $.Lottery_Basic_Fn)