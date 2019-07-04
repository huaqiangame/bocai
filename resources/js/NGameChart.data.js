// JavaScript Document
$(function () {
     
    /**
     * @content 初始化彩种走势图分类
     * @name 梁汝翔<liangruxiang>
     * @time 2015年6月16日 16:20:00 
     */
    if ($("#select_lottery").size() > 0) {
        var letterycode = $("#select_lottery").attr("value"); //获取彩种
        if (letterycode == "" || letterycode == undefined) {
            letterycode = "1000";
        }

        var TendChart_title = "重庆时时彩";
        TendChart_title = $(".snav_all_menu a[lottery_code='" + letterycode + "']").text() == undefined ? "重庆时时彩" : $(".snav_all_menu a[lottery_code='" + letterycode + "']").text();

        var TendChart_html = "";
        //switch (letterycode) { 
        //    case "1301": //快三
        //    case "1305": //快三
        //    case "1306": //快三
        //    case "1307": //快三
        //    case "1308": //快三
        //    case "1309": //快三
        //    case "1310": //快三
        //    case "1311": //快三
        //        TendChart_html = "";  
        //        var _theSelectStrings = "<select class='change_lotteryCode'>";
        //        if (letterycode == "1301") {
        //            _theSelectStrings += "<option value='1301' selected>安徽快三</option>";
        //        } else {
        //            _theSelectStrings += "<option value='1301'>安徽快三</option>";
        //        }
        //        if (letterycode == "1305") {
        //            _theSelectStrings += "<option value='1305' selected>江苏快三</option>";
        //        } else {
        //            _theSelectStrings += "<option value='1305'>江苏快三</option>";
        //        }
        //        if (letterycode == "1306") {
        //            _theSelectStrings += "<option value='1306' selected>广西快三</option>";
        //        } else {
        //            _theSelectStrings += "<option value='1306'>广西快三</option>";
        //        }
        //        if (letterycode == "1307") {
        //            _theSelectStrings += "<option value='1307' selected>吉林快三</option>";
        //        } else {
        //            _theSelectStrings += "<option value='1307'>吉林快三</option>";
        //        }
        //        if (letterycode == "1308") {
        //            _theSelectStrings += "<option value='1308' selected>湖北快三</option>";
        //        } else {
        //            _theSelectStrings += "<option value='1308'>湖北快三</option>";
        //        }
        //        if (letterycode == "1309") {
        //            _theSelectStrings += "<option value='1309' selected>内蒙古快三</option>";
        //        } else {
        //            _theSelectStrings += "<option value='1309'>内蒙古快三</option>";
        //        }
        //        if (letterycode == "1310") {
        //            _theSelectStrings += "<option value='1310' selected>福建快三</option>";
        //        } else {
        //            _theSelectStrings += "<option value='1310'>福建快三</option>";
        //        }
        //        if (letterycode == "1310") {
        //            _theSelectStrings += "<option value='1311' selected>北京快三</option>";
        //        } else {
        //            _theSelectStrings += "<option value='1311'>北京快三</option>";
        //        } 
        //            _theSelectStrings += "</select>";

        //        TendChart_html += "<h3 class=\"select-title\">彩种：" + _theSelectStrings + "<\/h3>";
        //        TendChart_html += "<ul class=\"select-list\">";
        //        TendChart_html += "     <li  class=\"current\"><a href=\"javascript:void(0)\" value=\"AHK3\">基本走势<\/a><\/li>";
        //        TendChart_html += "<\/ul>";
        //        break; 
        //}

        $(".change_lotteryCode").find("option[value='" + letterycode + "']").siblings().removeAttr("selected");
        $(".change_lotteryCode").find("option[value='" + letterycode + "']").prop("selected", true); 
        //$("#select_lottery").empty().html($(TendChart_html));
        $(document).find("title").eq(0).empty().text(TendChart_title + "-走势图表");

        $("body").on("change", ".change_lotteryCode", function () {
            var _theValue = $(this).val();
            var _theHost = window.location.host;
            window.location.href = "http://" + _theHost + "/tender_chart/" + _theValue + ".html";  
        });
        //$(".change_lotteryCode").change();
        /**
         * @content 初始化走势图数据
         * @name 梁汝翔<liangruxiang>
         * @time 2015年6月16日 16:20:00 
         */
        _Init_Lottery_TenderChart(letterycode);
   
       /**
        * @content 获取不同星的走势图
        * @name 梁汝翔<liangruxiang>
        * @time 2015年6月16日 16:20:00 
        */
        $(".select-list li a").click(function () {
            if ($("#showcontrol_btn").hasClass("curr")) {
                $("#showcontrol_btn").click();
            }
            var _this = $(this);
            var _thisTypeVal = _this.attr("value");
            
            if ($(this).parent().hasClass("current")) {
                return false;
            } else {
                var lottery_code = $("#select_lottery").attr("value") == undefined ? "1000" : $("#select_lottery").attr("value");
                var TheCount = $("#periods-data .fb").attr("value") == undefined ? "30" : $("#periods-data .fb").attr("value");

                $(this).parent().siblings().removeClass("current");
                $(this).parent().addClass("current");

                _Init_Lottery_TenderChart(lottery_code, TheCount);

              
            } 
        });
     
       /**
        * @content 不同期数的走势图
        * @name 梁汝翔<liangruxiang>
        * @time 2015年6月16日 16:20:00 
        */ 
        $("#periods-data a").click(function () {

            var _counts = $(".select-list .current a").attr("value");
            var _qishu = $(this).attr("value");

            $(this).addClass("fb");  //加粗
            $(this).siblings().removeClass("fb"); //加粗
             
            var lottery_code = $("#select_lottery").attr("value") == undefined ? "1000" : $("#select_lottery").attr("value");
            var TheCount = $("#periods-data .fb").attr("value") == undefined ? "30" : $("#periods-data .fb").attr("value");
            _Init_Lottery_TenderChart(lottery_code, TheCount); 
        });
     
       /**
        * @content 收缩展开功能区
        * @name 梁汝翔<liangruxiang>
        * @time 2015年6月16日 16:20:00 
        */ 
        $("#showcontrol_btn").click(function () {
            if ($(this).hasClass("curr")) {
                $(this).removeClass("curr");
                $(this).find("b").empty().text("展开功能区");
                $(".chart_control_cont").show();
                $("#J-chart-canvas").css("top", "0px");
            } else {
                $(this).addClass("curr");
                $(this).find("b").empty().text("收起功能区");
                $(".chart_control_cont").hide();
                $("#J-chart-canvas").css("top", "-48px");
            }
        });

       /**
        * @content 隐藏遗漏、去除提示线，显示走势图
        * @name 梁汝翔<liangruxiang>
        * @time 2015年6月16日 16:20:00 
        */ 
        $(".chart_control_cont .function input").click(function () {
            if ($(this).is(":checked")) {
                var theType = $(this).attr("data-action");
                if (theType == "guides") {
                    $("#J-chart-area .table-guides .border-bottom").css("border-bottom", "1px solid #ccc");
                } else if (theType == "lost") {
                    $("#J-chart-area .table-guides .miss_data").show();
                } else if (theType == "trend") {
                    $("#J-chart-area .J-chart-canvas").show();
                }
            }
            else {
                var theType = $(this).attr("data-action");
                if (theType == "guides") {
                    $("#J-chart-area .table-guides .border-bottom").css("border-bottom", "0px");
                } else if (theType == "lost") {
                    $("#J-chart-area .table-guides .miss_data").hide();
                } else if (theType == "trend") {
                    $("#J-chart-area .J-chart-canvas").hide();
                }
            }
        });

        /**
         * @content 报表下载
         * @name 梁汝翔<liangruxiang>
         * @time 2015年6月16日 16:20:00 
         */
        $("#J-button-export").click(function () {
            var letterycode = $("#select_lottery").attr("value"); //获取彩种
            if (letterycode == "" || letterycode == undefined) {
                letterycode = "1000";
            }
            var TheCount = $("#periods-data .fb").attr("value") == undefined ? "30" : $("#periods-data .fb").attr("value");
            
            var theUrl = "/downExcel/" + letterycode + "/" + TheCount + ".html";
            window.open(theUrl, true); 
        });
    }

});

/**
 * @content 通过正则获取数据
 * @name 梁汝翔<liangruxiang>
 * @time 2015年6月16日 16:20:00 
 */
function  GetQueryStringByZZ(name) {
    var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
    var r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return unescape(r[2]);
    }
    return null;
}

/**
 * @content 初始化走势图数据
 * @name 梁汝翔<liangruxiang>
 * @time 2015年6月16日 16:20:00 
 * @param letterycode  彩种类型
 */
function _Init_Lottery_TenderChart(letterycode,count) {

    if (letterycode == undefined) { letterycode = "1000"; }
    if (count == undefined) { count = "30"; }

      
    //获取初始化不同彩种的走势图的类型
    var _initsTypeVal = $(".select-list .current a").attr("value") == undefined ? "SSC5" : $(".select-list .current a").attr("value");
   
    var _Action = "";

    switch (_initsTypeVal) {  
        case "SSC5": //时时彩五星
            _Action = "get_ssc_5x";
            break;
        case "SSC5XZH": //时时彩五星综合
            _Action = "get_ssc_5xzh";
            break;
        case "SSC4": //时时彩4星
            _Action = "get_ssc_4x";
            break;
        case "SSCQ3": //时时彩前三
            _Action = "get_ssc_q3";
            break;
        case "SSCZ3": //时时彩中三
            _Action = "get_ssc_z3";
            break;
        case "SSCH3": //时时彩后三
            _Action = "get_ssc_h3";
            break;
        case "SSCQ2": //时时彩前二
            _Action = "get_ssc_q2";
            break;
        case "SSCH2": //时时彩后二
            _Action = "get_ssc_h2";
            break;
        case "11X5": //11选5 
            _Action = "get_11x5";
            break;
        case "FC3D": //福彩3D 时时乐
            _Action = "get_fucai3d_ssl"; 
            break;
        case "BJKL8": //北京快乐8 
            _Action = "get_bjkl8";
            break;
        case "AHK3": //安徽快三 
            _Action = "get_ahk3"; 
            break;
        case "XYLC": //幸运农场 
            _Action = "get_cqklsf";
            break;
        case "BJPK10": //北京PK10 
            _Action = "get_bjpk10";
            break;
        default:
            break;
    }

    if (_Action == "") { Action = "get_ssc_5x"; }
    $.ajax({
        type: "POST",
        url: "",
        data: {
            letterycode: letterycode, //彩种编码
            numPeriods: count,  // 30\50\120\240\600    
            action: _Action //获取时时彩五星综合
        },
        dataType: "JSON",
        success: function (data) {
            if (data.State != undefined && data.State == 1) {
               /**
                * @content 通过数据，调用创建彩种玩法的走势图
                * @name 梁汝翔<liangruxiang>
                * @time 2015年6月16日 16:20:00  
                * @param data 走势图数据
                * @param letterycode  彩种类型
                * @param _initsTypeVal 玩法类型
                * @param count 获取的期数
                */
                InitTenderCharts(data, _initsTypeVal, letterycode, count);
            } 
        }
    }); 
}


/**
 * @content 通过数据，调用创建彩种玩法的走势图
 * @name 梁汝翔<liangruxiang>
 * @time 2015年6月16日 16:20:00  
 * @param data 走势图数据
 * @param letterycode  彩种类型
 * @param _initsTypeVal 玩法类型
 * @param count 获取的期数
 */
function InitTenderCharts(data, initsTypeVal, letterycode, count) {

    if (letterycode == undefined) { letterycode = "1000"; }
    if (count == undefined) { count = "30"; }

    var SpeciesVal = ""; //彩种类型
    var TypeVal = "";  //玩法类型
    switch (initsTypeVal) {
        case "SSC5": //时时彩五星
            SpeciesVal = "ssc";
            TypeVal = "wuxin";
            break;
        case "SSC5XZH": //时时彩五星综合
            SpeciesVal = "ssc";
            TypeVal = "wuxinzonghe";
            break;
        case "SSC4": //时时彩4星
            SpeciesVal = "ssc";
            TypeVal = "sixing";
            break;
        case "SSCQ3": //时时彩前三
            SpeciesVal = "ssc"; 
            TypeVal = "qiansan"; 
            break;
        case "SSCZ3": //时时彩中三
            SpeciesVal = "ssc";
            TypeVal = "zhongsan";
            break;
        case "SSCH3": //时时彩后三
            SpeciesVal = "ssc";
            TypeVal = "housan";
            break;
        case "SSCQ2": //时时彩前二
            SpeciesVal = "ssc";
            TypeVal = "qianer";
            break;
        case "SSCH2": //时时彩后二
            SpeciesVal = "ssc";
            TypeVal = "houer";
            break;
        case "11X5": //11选5 
            SpeciesVal = "11x5";
            TypeVal = "11X5";
            break;
        case "FC3D": //福彩3D 时时乐
            SpeciesVal = "3D";
            TypeVal = "jiben";
            break;
        case "BJKL8": //北京快乐8 
            SpeciesVal = "kl8";
            TypeVal = "jiben";
            break;
        case "AHK3": //安徽快三 
            SpeciesVal = "k3";
            TypeVal = "jiben";
            break;
        case "XYLC": //幸运农场 
            SpeciesVal = "xync";
            TypeVal = "jiben";
            break;
        case "BJPK10": //北京PK10 
            SpeciesVal = "pk10";
            TypeVal = "jiben";
            break;
        default:
            break;
    }


    //时时彩类型的数据
    var SSC_DataOptio = {
        species: SpeciesVal,	//图标类型，时时彩（ 名称 ssc , 11x5 , .... ）
        speciesVal: letterycode, //彩票种类，重庆时时彩 
        data: {},
        Chart_Container: "J-chart-area", //图表容器在哪   
        Times: count, //页面期数，是多少期
        TypeVal: TypeVal  //彩票种类，重庆时时彩  ["五星|wuxing"，"五星综合|zonghe"，“四星\sixing”，“前三/qiansan”，“中三/zhongsan”，“后三/housan”，“前二|qianer”，“后二/houer” ]
    };

    SSC_DataOptio.data = data;  
    var _Tender_obj = new $.RGarmChart();
    _Tender_obj.prams = SSC_DataOptio;
    _Tender_obj.Init();
}



























