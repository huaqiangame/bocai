// JavaScript Document 
// +---------------------------------------------------------------------- 
// | Date: 2015年5月19日 15:00:00
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// | Name: Jquery.ruiValidate.js ( 基于jQuery的表单验证 )
// +----------------------------------------------------------------------
// JavaScript Document

(function ($) {
    //声明邮箱图表对象
    var RGarmChart = function () {
        this.prams = "";
    }
    RGarmChart.prototype = {
        Init: function () {
            var _config_options = this.extend_options(this.prams);
            var _CreatTHead = this.Creat_THead(_config_options); //获取表格头
            if (_CreatTHead != "") {
                _CreatTBody = this.Creat_TBody(_config_options);	//获取表格内容
                var _ChartFooter = this.Creat_TFooter(_config_options);  //获取表格尾
                var _Chart_Table = $("#" + _config_options.Chart_Container);
                if (_Chart_Table.find("table").size() > 0) {
                    var _get_table_No = this.getOpenNo_Arry(_Chart_Table, _config_options);		//遍历所有的中奖号码，并返回每个中奖号码的位置  位置相对body整体   
                    if (_get_table_No != null && _get_table_No.length > 0) {
                        //绘制曲线
                        this.CreatCanvasLine(_get_table_No, _config_options);
                    }
                }
            }
        },
        extend_options: function (user_data) {
            var default_options = {
                species: "ssc",	//图标类型，时时彩
                speciesVal: "cqssc", //彩票种类，重庆时时彩 
                data: {},
                Chart_Container: "J-chart-area", //图表容器在哪   
                Times: "30", //页面期数，是多少期
                TypeVal: "wuxin"  //彩票种类，重庆时时彩  ["五星|wuxing"，"五星综合|zonghe"，“四星\sixing”，“前三/qiansan”，“中三/zhongsan”，“后三/housan”，“前二|qianer”，“后二/houer” ]
            }
            var _new_options = $.extend(true, {}, default_options, user_data);
            return _new_options;
        },
        //创建表格头
        Creat_THead: function (_config_options) {
            //console.log(_config_options.data);
            var _Thead_html = "";
            //更具不同的类型创建不同的表格头
            switch (_config_options.species) {
                case "ssc":		//时时彩的表格
                    _Thead_html = this.get_ssc_thead(_config_options);
                    break;
                case "11x5":		//11选5的表格
                    _Thead_html = this.get_11x5_thead(_config_options);
                    break;
                case "kl8":		//北京快乐8
                    _Thead_html = this.get_kl8_thead(_config_options);
                    break;
                case "k3":		//kuai3的表格
                    _Thead_html = this.get_k3_thead(_config_options);
                    break;
                case "ssl":		//上海时时乐
                case "3D":		//福彩3D
                    _Thead_html = this.get_3D_thead(_config_options);
                    break;
                case "pl5":		//排列3/5
                    _Thead_html = this.get_pl5_thead(_config_options);
                    break;
                case "xync":		//幸运农场的表格
                    _Thead_html = this.get_xync_thead(_config_options);
                    break;
                case "pk10":	//北京pk10
                    _Thead_html = this.get_bjpk10_thead(_config_options);
                    break;
                default:
                    break;
            }

            var _chartContainer = $("#" + _config_options.Chart_Container);
            var _chart_table_cont = "<table width='100%' class='chart-table' cellpadding='0' cellspacing='0' id='" + _config_options.Chart_Container + "-table'></table>";
            _chartContainer.empty().html(_chart_table_cont);
            if (_Thead_html != "") {
                $("#" + _config_options.Chart_Container + "-table").append(_Thead_html);
            }
            return _Thead_html;
        },
        //创建ssc的表格头
        get_ssc_thead: function (_config_options) {
            var _thead_html = '';
            switch (_config_options.TypeVal) {
                case "wuxin":	//时时彩五星
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">万位<\/th><th colspan=\"12\" class=\"border-right\">千位<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">个位<\/th><th colspan=\"12\">号码分布<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 6 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "wuxinzonghe":	//时时彩，五星综合
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th colspan=\"12\" class=\"border-right\">号码跨度<\/th><th colspan=\"14\" class=\"border-right\">大小比<\/th><th colspan=\"14\" class=\"border-right\">单双比<\/th><th colspan=\"14\" class=\"border-right\">质合比<\/th><th colspan=\"3\" class=\"border-bottom\" rowspan='2'>和值<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 2 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header "></th>';
                        }
                    }

                    for (var i = 0 ; i < 3 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">5:0</i></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">4:1</i></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">3:2</i></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">2:3</i></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">1:4</i></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">0:5</i></th>';
                        _second_tr_td += '<th class="ball-none border-bottom-header  border-right"></th>';
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "sixing":	//时时彩五星
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">千位<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">个位<\/th><th colspan=\"12\">号码分布<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 5 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "qiansan":	//前三
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">万位<\/th><th colspan=\"12\" class=\"border-right\">千位<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >大小形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >单双形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">质合形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >012形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组三<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组六<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">豹子<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">跨度<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">直选和值<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值尾数<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 4 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "zhongsan"://中三
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">千位<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >大小形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >单双形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">质合形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >012形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组三<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组六<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">豹子<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">跨度<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">直选和值<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值尾数<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 4 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "housan":	//后三
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">个位<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >大小形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >单双形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">质合形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >012形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组三<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组六<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">豹子<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">跨度<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">直选和值<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值尾数<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 4 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "qianer":	//前二
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">万位<\/th><th colspan=\"12\" class=\"border-right\">千位<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">对子<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th colspan=\"12\" class=\"border-right\">跨度走势<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 4 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "houer":	//后二
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">个位<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">对子<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th colspan=\"12\" class=\"border-right\">跨度走势<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 4 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                default:
                    break;
            }
            return _thead_html;
        },
        //创建11选5的表格头
        get_11x5_thead: function (_config_options) {
            var _thead_html = '';
            _thead_html += '<thead class="thead">';
            var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"13\" class=\"border-right\">第一位<\/th><th colspan=\"13\" class=\"border-right\">第二位<\/th><th colspan=\"13\" class=\"border-right\">第三位<\/th><th colspan=\"13\" class=\"border-right\">第四位<\/th><th colspan=\"13\" class=\"border-right\">第五位<\/th><th class=\"border-right\" colspan=\"13\">号码分布<\/th><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">单双比<\/th><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom\">中位数<\/th><\/tr>";
            _thead_html += _FirstTr;

            var _second_tr = "<tr class=\"title-number\">";
            var _second_tr_td = "";
            for (var i = 0 ; i < 6 ; i++) {
                _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                for (var j = 1 ; j < 12 ; j++) {
                    _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                }
                if (i + 1 < 6) {
                    _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                }
                else {
                    _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                }
            }
            _second_tr += _second_tr_td;
            _thead_html += _second_tr;
            _thead_html += '</thead>';
            return _thead_html;
        },
        //北京快乐8 
        get_kl8_thead: function (_config_options) {
            var _thead_html = '';
            _thead_html += '<thead class="thead">';
            var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"82\" class=\"border-right\">开奖号码<\/th><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">大小<\/th><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">单双<\/th><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">上下<\/th><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">奇偶<\/th><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">和值<\/th><\/tr>";
            _thead_html += _FirstTr;
            var _second_tr = "<tr class=\"title-number\">";
            var _second_tr_td = "";
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            for (var i = 0 ; i < 80 ; i++) {
                _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + (i + 1) + '</i></th>';
            }
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr += _second_tr_td;
            _thead_html += _second_tr;
            _thead_html += '</thead>';
            $("#" + _config_options.Chart_Container).addClass("kuaile8")
            return _thead_html;
        },
        //创建快三
        get_k3_thead: function (_config_options) {
            var _thead_html = '';
            _thead_html += '<thead class="thead">';
            var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"8\" class=\"border-right \">号码走势<\/th><th colspan=\"18\" class=\"border-right \">和值<\/th><th colspan=\"12\" class=\"border-right border-bottom \">和值组合形态<\/th><th colspan=\"6\" class=\"border-right border-bottom \">号码形态<\/th><\/tr>";
            _thead_html += _FirstTr;

            var _second_tr = "<tr class=\"title-number title_zuhexigntai\">";
            var _second_tr_td = "";
            for (var i = 0 ; i < 1 ; i++) {
                _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                for (var j = 0 ; j < 6 ; j++) {
                    _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + (j + 1) + '</i></th>';
                }
                _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            }

            //和值 
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            for (var j = 3 ; j < 19 ; j++) {
                _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
            }
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';


            //和值形态 
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">小奇</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">小偶</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">大奇</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">大偶</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';

            //号码形态  
            _second_tr_td += '<th class="border-bottom-header  border-right"><i class="ball-noraml haomaxingtai">三同号</i></th>';
            _second_tr_td += '<th class="border-bottom-header  border-right"><i class="ball-noraml haomaxingtai">三不同号</i></th>';
            _second_tr_td += '<th class="border-bottom-header  border-right"><i class="ball-noraml haomaxingtai">三连号</i></th>';
            _second_tr_td += '<th class="border-bottom-header  border-right"><i class="ball-noraml haomaxingtai">二同号（复）</i></th>';
            _second_tr_td += '<th class="border-bottom-header  border-right"><i class="ball-noraml haomaxingtai">二同号（单）</i></th>';
            _second_tr_td += '<th class="border-bottom-header  border-right"><i class="ball-noraml haomaxingtai">二不同号</i></th>';

            _second_tr += _second_tr_td;
            _thead_html += _second_tr;
            _thead_html += '</thead>';
            return _thead_html;
        },
        //福彩3D
        get_3D_thead: function (_config_options) {
            var _thead_html = '';
            _thead_html += '<thead class="thead">';
            var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">个位<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >大小形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >单双形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">质合形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >012形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组三<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组六<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">豹子<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">跨度<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">直选和值<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值尾数<\/th><\/tr>";
            _thead_html += _FirstTr;

            var _second_tr = "<tr class=\"title-number\">";
            var _second_tr_td = "";
            for (var i = 0 ; i < 4 ; i++) {
                _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                for (var j = 0 ; j < 10 ; j++) {
                    _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                }
                if (i + 1 < 6) {
                    _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                }
                else {
                    _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                }
            }
            _second_tr += _second_tr_td;
            _thead_html += _second_tr;
            _thead_html += '</thead>';
            return _thead_html;
        },
        //排列3-5
        get_pl5_thead: function (_config_options) {
            var _thead_html = '';
            switch (_config_options.TypeVal) {
                case "wuxin":	//时时彩五星
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">万位<\/th><th colspan=\"12\" class=\"border-right\">千位<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">个位<\/th><th colspan=\"12\">号码分布<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 6 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "wuxinzonghe":	//时时彩，五星综合
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th colspan=\"12\" class=\"border-right\">号码跨度<\/th><th colspan=\"14\" class=\"border-right\">大小比<\/th><th colspan=\"14\" class=\"border-right\">单双比<\/th><th colspan=\"14\" class=\"border-right\">质合比<\/th><th colspan=\"3\" class=\"border-bottom\" rowspan='2'>和值<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 2 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header "></th>';
                        }
                    }

                    for (var i = 0 ; i < 3 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">5:0</i></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">4:1</i></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">3:2</i></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">2:3</i></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">1:4</i></th>';
                        _second_tr_td += '<th class="border-bottom-header" colspan=\"2\"><i class="ball-noraml">0:5</i></th>';
                        _second_tr_td += '<th class="ball-none border-bottom-header  border-right"></th>';
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "sixing":	//时时彩五星
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">千位<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">个位<\/th><th colspan=\"12\">号码分布<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 5 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "qiansan":	//前三
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">万位<\/th><th colspan=\"12\" class=\"border-right\">千位<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >大小形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >单双形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">质合形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >012形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组三<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组六<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">豹子<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">跨度<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">直选和值<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值尾数<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 4 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "zhongsan"://中三
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">千位<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >大小形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >单双形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">质合形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >012形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组三<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组六<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">豹子<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">跨度<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">直选和值<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值尾数<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 4 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "housan":	//后三
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">百位<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">个位<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >大小形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >单双形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">质合形态<\/th><th class=\"border-bottom border-right\" rowspan=\"2\"  colspan=\"3\" >012形态<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组三<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">组六<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">豹子<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">跨度<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">直选和值<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值尾数<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 4 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "qianer":	//前二
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">万位<\/th><th colspan=\"12\" class=\"border-right\">千位<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">对子<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th colspan=\"12\" class=\"border-right\">跨度走势<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 4 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                case "houer":	//后二
                    _thead_html += '<thead class="thead">';
                    var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right\">十位<\/th><th colspan=\"12\" class=\"border-right\">个位<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">对子<\/th><th colspan=\"12\" class=\"border-right\">号码分布<\/th><th colspan=\"12\" class=\"border-right\">跨度走势<\/th><th class=\"border-bottom border-right\"  colspan=\"3\"  rowspan=\"2\">和值<\/th><\/tr>";
                    _thead_html += _FirstTr;

                    var _second_tr = "<tr class=\"title-number\">";
                    var _second_tr_td = "";
                    for (var i = 0 ; i < 4 ; i++) {
                        _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                        for (var j = 0 ; j < 10 ; j++) {
                            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
                        }
                        if (i + 1 < 6) {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                        else {
                            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
                        }
                    }
                    _second_tr += _second_tr_td;
                    _thead_html += _second_tr;
                    _thead_html += '</thead>';
                    break;
                default:
                    break;
            }
            return _thead_html;
        },
        //创建快乐农场
        get_xync_thead: function (_config_options) {
            var _thead_html = '';
            _thead_html += '<thead class="thead">';
            var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right \">小区<\/th><th colspan=\"12\" class=\"border-right \">大区<\/th><th colspan=\"9\" class=\"border-right border-bottom \">012路<\/th><th rowspan=\"2\" colspan=\"2\" class=\"border-bottom border-right\">跨度<\/th><\/tr>";
            _thead_html += _FirstTr;

            var _second_tr = "<tr class=\"title-number title_zuhexigntai\">";
            var _second_tr_td = "";
            for (var i = 0 ; i < 1 ; i++) {
                _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
                for (var j = 0 ; j < 10 ; j++) {
                    _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + (j + 1) + '</i></th>';
                }
                _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            }

            //和值 
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            for (var j = 11 ; j < 21 ; j++) {
                _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + j + '</i></th>';
            }
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';


            //和值形态 
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">0路</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">1路</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">2路</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';


            _second_tr += _second_tr_td;
            _thead_html += _second_tr;
            _thead_html += '</thead>';
            return _thead_html;
        },
        //北京pk10
        get_bjpk10_thead: function (_config_options) {
            var _thead_html = '';
            _thead_html += '<thead class="thead">';
            var _FirstTr = "<tr class=\"title-text\"><th rowspan=\"2\" colspan=\"3\" class=\"border-bottom border-right\">期号<\/th><th colspan=\"3\" rowspan=\"2\" class=\"border-right border-bottom\">开奖号码<\/th><th colspan=\"12\" class=\"border-right border-bottom\">冠军分布<\/th><th colspan=\"6\" class=\"border-right border-bottom  \">冠军<\/th><th colspan=\"6\" class=\"border-right border-bottom \">冠军<\/th><th colspan=\"6\" class=\"border-right border-bottom \">冠军<\/th><th colspan=\"9\" class=\"border-right border-bottom \">冠军<\/th><th colspan=\"9\" class=\"border-right border-bottom \">冠军<\/th><\/tr>";
            _thead_html += _FirstTr;

            var _second_tr = "<tr class=\"title-number title_zuhexigntai\">";
            var _second_tr_td = "";
            _second_tr_td += '<th class="ball-none border-bottom"></th>';
            for (var i = 0 ; i < 10 ; i++) { 
                _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml">' + (i + 1) + '</i></th>';
            } 
            _second_tr_td += '<th class="ball-none border-bottom  border-right"></th>';
            //奇偶 
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">奇</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">偶</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
             
            //大小 
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">大</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">小</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';

            //质合 
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">质</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">合</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';

            //012 
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">0</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">1</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">2</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';

            //升 平 降
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">升</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">平</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header"></th>';
            _second_tr_td += '<th class="border-bottom-header"><i class="ball-noraml hezhixingtai">降</i></th>';
            _second_tr_td += '<th class="ball-none border-bottom-header border-right"></th>';

            _second_tr += _second_tr_td;
            _thead_html += _second_tr;
            _thead_html += '</thead>';
            return _thead_html;
        },
        //创建表格容器
        Creat_TBody: function (_config_options) {
            var _TBody_html = "";
            //更具不同的类型创建不同的表格头
            switch (_config_options.species) {
                case "ssc":		//时时彩的表格
                    _TBody_html = this.get_ssc_tBody(_config_options);
                    break;
                case "11x5":	//11选5的表格
                    _TBody_html = this.get_11x5_tBody(_config_options);
                    break;
                case "kl8":		//北京快乐8的表格
                    _TBody_html = this.get_kl8_tBody(_config_options);
                    break;
                case "k3":		//kuai3的表格
                    _TBody_html = this.get_k3_tBody(_config_options);
                    break;
                case "ssl":		//上海时时乐
                case "3D":		//福彩3D
                    _TBody_html = this.get_3D_tBody(_config_options);
                    break;
                case "pl5":		//时时彩的表格
                    _TBody_html = this.get_pl5_tBody(_config_options);
                    break;
                case "xync":	//幸运农场的表格
                    _TBody_html = this.get_xync_tBody(_config_options);
                    break;
                case "pk10":	//北京pk10
                    _TBody_html = this.get_bjpk10_tBody(_config_options);
                    break;
                default:
                    break;
            }
            return _TBody_html;
        },
        //获取时时彩tBody
        get_ssc_tBody: function (_config_options) {
            //1、遍历每一行
            if (_config_options.data != null && _config_options.data.Body.Body.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Body;  //需要遍历的数据 
                var _tbody = '<tbody  id="J-chart-content" class="chart table-guides"></tbody>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                var num = 0;
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].No; //期号 
                    //1、创建开奖号码对象；
                    var _open_Numb = this.get_OpenOptions(_each_Data[i].LotteryOpenNo, "string");
                    //console.log(_open_Numb);
                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = '';
                    num++;
                    if (num > 0 && num % 5 == 0) {
                        _border_botton = 'border-bottom'
                    }
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _each_tr_data.No + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + _each_tr_data.LotteryOpenNo + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';
                    switch (_config_options.TypeVal) {
                        case "wuxin":
                            var other_infos = ["wanwei", "qianwei", "baiwei", "shiwei", "gewei", "hmfb"];		//五星基本
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton);
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "wuxinzonghe":					//五星综合
                            var other_infos = ["hmfb", "haomakuadu", "daxiaobi", "danshuangbili", "zhihebi", "hezhi"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 6, _open_Numb, other_infos, 1, _border_botton);
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "sixing":						//四星
                            var other_infos = ["qianwei", "baiwei", "shiwei", "gewei", "hmfb"];		//号码分布

                            _open_Numb.numb_arry[0] = "-1";

                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 7, _open_Numb, other_infos, 1, _border_botton, "sixing");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "qiansan":						//前三
                            var other_infos = ["wanwei", "qianwei", "baiwei", "hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "qiansan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "zhongsan":						//中三
                            var other_infos = ["qianwei", "baiwei", "shiwei","hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "zhongsan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "housan":						//后三
                            var other_infos = ["baiwei", "shiwei", "gewei", "hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "housan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "qianer":						//后二
                            var other_infos = ["wanwei", "qianwei", "duizhi", "hmfb", "kuaduzs", "hezhi"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton, "qianer");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "houer":						 
                            var other_infos = ["shiwei", "gewei", "duizhi", "hmfb", "kuaduzs", "hezhi"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton, "houer");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        default:
                            break;
                    }
                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
        },
        //获取11选5
        get_11x5_tBody: function (_config_options) {
            //1、遍历每一行
            if (_config_options.data != null && _config_options.data.Body.Body.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Body;  //需要遍历的数据 
                var _tbody = '<tbody  id="J-chart-content" class="chart table-guides"></tbody>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                var num = 0;
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].No; //期号 
                    //1、创建开奖号码对象；
                    var _open_Numb = this.get_OpenOptions(_each_Data[i].LotteryOpenNo, "string");
                    //console.log(_open_Numb);
                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = '';
                    num++;
                    if (num > 0 && num % 5 == 0) {
                        _border_botton = 'border-bottom'
                    }
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _each_tr_data.No + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + _each_tr_data.LotteryOpenNo + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';
                    switch (_config_options.TypeVal) {
                        case "11X5":
                            var other_infos = ["One", "Two", "Three", "Four", "Five", "hmfb", "danshuangbi", "ZhongWeiShu"];		//号码分布，单双比，中间值
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton);
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        default:
                            break;
                    }

                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
        },
        //获取北京快乐8的号码
        get_kl8_tBody: function (_config_options) {
            if (_config_options.data != null && _config_options.data.Body.Body.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Body;  //需要遍历的数据 
               // console.log(_each_Data);
                var _tbody = '<tbody  id="J-chart-content" class="chart table-guides"></tbody>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                var num = 0;
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].No; //期号 
                    //1、创建开奖号码对象；
                    if (_each_Data[i].LotteryOpenNo.indexOf("+") != -1) {
                        var _open_Numb = this.get_OpenOptions(_each_Data[i].LotteryOpenNo.split("+")[0], 'string');
                    } else {
                        var _open_Numb = this.get_OpenOptions(_each_Data[i].LotteryOpenNo, 'string');
                    }
                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = '';
                    num++;
                    if (num > 0 && num % 5 == 0) {
                        _border_botton = 'border-bottom'
                    }
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _each_tr_data.No + '</td><td class="ball-none border-right ' + _border_botton + '"></td>';
                    switch (_config_options.TypeVal) {
                        case "jiben":
                            var other_infos = ["kul8", "DaXiao", "DanShuang", "ShangXia", "JiOu", "HeZhi"];		//大小，单双，上下，奇偶，和值
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton, "wuxing"); //追加单元格( 当前行遗漏数据，追加几列，开奖号码对象，额外统计数据,类型 )
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        default:
                            break;
                    }

                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
        }, 
        //获取kuai3的表格
        get_k3_tBody: function (_config_options) {
            if (_config_options.data != null && _config_options.data.Body.Body.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Body;  //需要遍历的数据 
                var _tbody = '<tbody  id="J-chart-content" class="chart table-guides"></tbody>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                var num = 0;
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].No; //期号 
                    //1、创建开奖号码对象；
                    var _open_Numb = this.get_OpenOptions(_each_Data[i].LotteryOpenNo.replace(/,/g, ''));

                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = '';
                    num++;
                    if (num > 0 && num % 5 == 0) {
                        _border_botton = 'border-bottom'
                    }
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _each_tr_data.No + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + _each_tr_data.LotteryOpenNo.replace(/,/g, '') + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';

                    var other_infos = ["haomazoushi", "k3hezhi", "hezhizuhetype", "haomaxingtai"];		//号码分布，和值，和值组合形态，号码形态
                    var _theTr_infos = this.getAppendChildTd(_each_tr_data, 4, _open_Numb, other_infos, 1, _border_botton, "wuxing");
                    _tr_Init_html += _theTr_infos + "</tr>";

                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
        },
        //福彩3d
        get_3D_tBody: function (_config_options) {
            //1、遍历每一行
            if (_config_options.data != null && _config_options.data.Body.Body.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Body;  //需要遍历的数据 
                var _tbody = '<tbody  id="J-chart-content" class="chart table-guides"></tbody>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                var num = 0;
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].No; //期号 
                    //1、创建开奖号码对象；
                    var _open_Numb = this.get_OpenOptions(_each_Data[i].LotteryOpenNo, "string");

                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = '';
                    num++;
                    if (num > 0 && num % 5 == 0) {
                        _border_botton = 'border-bottom'
                    }
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _each_tr_data.No + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + _each_tr_data.LotteryOpenNo + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';

                    var other_infos = ["baiwei", "shiwei", "gewei", "hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                    var _theTr_infos = this.getAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "3D");
                    _tr_Init_html += _theTr_infos + "</tr>";

                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
        },
        //获取排列3-5的走势图
        get_pl5_tBody: function (_config_options) {
            //1、遍历每一行
            if (_config_options.data != null && _config_options.data.Body.Body.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Body;  //需要遍历的数据 
                var _tbody = '<tbody  id="J-chart-content" class="chart table-guides"></tbody>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                var num = 0;
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].No; //期号 
                    //1、创建开奖号码对象；
                    var _open_Numb = this.get_OpenOptions(_each_Data[i].LotteryOpenNo, "string");
                    //console.log(_open_Numb);
                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = '';
                    num++;
                    if (num > 0 && num % 5 == 0) {
                        _border_botton = 'border-bottom'
                    }
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _each_tr_data.No + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + _each_tr_data.LotteryOpenNo + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';
                    switch (_config_options.TypeVal) {
                        case "wuxin":
                            var other_infos = ["wanwei", "qianwei", "baiwei", "shiwei", "gewei", "hmfb"];		//五星基本
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton);
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "wuxinzonghe":					//五星综合
                            var other_infos = ["hmfb", "haomakuadu", "daxiaobi", "danshuangbi", "zhihebi", "hezhi"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 6, _open_Numb, other_infos, 1, _border_botton);
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "sixing":						//四星
                            var other_infos = ["qianwei", "baiwei", "shiwei", "gewei", "hmfb"];		//号码分布

                            _open_Numb.numb_arry[0] = "-1";

                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 7, _open_Numb, other_infos, 1, _border_botton, "sixing");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "qiansan":						//前三
                            var other_infos = ["hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "qiansan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "zhongsan":						//中三
                            var other_infos = ["hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "zhongsan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "housan":						//后三
                            var other_infos = ["hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "housan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "qianer":						//后三
                            var other_infos = ["zusan", "hmfb", "kuaduzs", "And_value_infos"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton, "qianer");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "houer":						//后三
                            var other_infos = ["zusan", "hmfb", "kuaduzs", "And_value_infos"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton, "houer");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        default:
                            break;
                    }
                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
        },
        //获取幸运农场的表格
        get_xync_tBody: function (_config_options) {
            if (_config_options.data != null && _config_options.data.Body.Body.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Body;  //需要遍历的数据 
                var _tbody = '<tbody  id="J-chart-content" class="chart table-guides"></tbody>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                var num = 0;
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].No; //期号 
                    //1、创建开奖号码对象；
                    var _open_Numb = this.get_OpenOptions(_each_Data[i].LotteryOpenNo, 'string');

                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = '';
                    num++;
                    if (num > 0 && num % 5 == 0) {
                        _border_botton = 'border-bottom'
                    }
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _each_tr_data.No + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + _each_tr_data.LotteryOpenNo + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';

                    var other_infos = ["XiaoQu", "DaQu", "_012", "KuDu"];		//小区，大区，012路，跨度
                    var _theTr_infos = this.getAppendChildTd(_each_tr_data, 4, _open_Numb, other_infos, 1, _border_botton, "wuxing");
                    _tr_Init_html += _theTr_infos + "</tr>";

                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
        },
        //获取北京pk10的表格
        get_bjpk10_tBody: function (_config_options) {
            if (_config_options.data != null && _config_options.data.Body.Body.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Body;  //需要遍历的数据 
                var _tbody = '<tbody  id="J-chart-content" class="chart table-guides"></tbody>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                var num = 0;
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].No; //期号 
                    //1、创建开奖号码对象；
                    var _open_Numb = this.get_OpenOptions(_each_Data[i].LotteryOpenNo.replace(/,/g, ''));

                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = '';
                    num++;
                    if (num > 1 && num % 5 == 0) {
                        _border_botton = 'border-bottom';
                    }
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _each_tr_data.No + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + _each_tr_data.LotteryOpenNo + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';

                    var other_infos = ["guanjun", "pkjiou", "pkdaxiao", "pkzhihe", "pk012", "pkspj"];		//号码分布，和值，和值组合形态，号码形态
                    var _theTr_infos = this.getAppendChildTd(_each_tr_data, 4, _open_Numb, other_infos, 1, _border_botton, "wuxing");
                    _tr_Init_html += _theTr_infos + "</tr>";

                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
        },
        //获取表格尾部
        Creat_TFooter: function (_config_options) {
            var _TBody_html = "";
            //更具不同的类型创建不同的表格头
            switch (_config_options.species) {
                case "ssc":		//时时彩的表格
                    _TBody_html = this.get_ssc_tfooter(_config_options);
                    break;
                case "gd11x5":
                case "11x5":	//11选5的表格
                    _TBody_html = this.get_11x5_tfooter(_config_options);
                    break;
                case "kl8":		//北京快乐8的表格
                    _TBody_html = this.get_kl8_tfooter(_config_options);
                    break;
                case "k3":		//kuai3的表格
                    //_TBody_html = this.get_k3_tfooter(_config_options);
					_TBody_html = "";
                    break;
                case "xync":		//kuai3的表格
                    _TBody_html = this.get_xync_tfooter(_config_options);
                    break;
                case "ssl":		//上海时时乐
                case "3D":		//福彩3D
                    _TBody_html = this.get_3D_tfooter(_config_options);
                    break;
                case "pl5":		//时时彩的表格
                    _TBody_html = this.get_pl5_tfooter(_config_options);
                    break;
                default:
                    break;
            }
            return _TBody_html;
        },

        //追加单元格( 当前行遗漏数据，追加几列，开奖号码对象，额外统计数据,类型 )
        getFooterAppendChildTd: function (_each_tr_data, numb, open_obj, other_infos, type, _border_botton, xingshu) {
            var _Child_tdInfos = "";
            var _other_infos_len = other_infos.length == undefined ? 10 : other_infos.length;
            var _keys = "0";
            if (_other_infos_len > 0)	// 获取遍历的关键词
            {
                for (var k = 0 ; k < _other_infos_len ; k++) {
                    switch (other_infos[k]) {
                        case "haomazoushi": //号码走势
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            for (var j = 1 ; j < 7 ; j++) {
                                var _Boll_in_arry = this.check_Number_inArry(j, open_obj.numb_arry);
                                if (_Boll_in_arry.state) {
                                    if (_Boll_in_arry.number > 1) {
                                        _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " KuaiSan_OpenNo '><i data-info='" + _each_tr_data.HaoMaZouShi[j] + "' class='ball-noraml openNo-0'>" + j + "<em class='chonghao'>" + _Boll_in_arry.number + "</em></i></td>";
                                    }
                                    else {
                                        _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " KuaiSan_OpenNo '><i data-info='" + _each_tr_data.HaoMaZouShi[j] + "' class='ball-noraml openNo-0'>" + j + "</i></td>";
                                    }
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.HaoMaZouShi[s] + "' class='ball-noraml '><i></i>" + _each_tr_data.HaoMaZouShi[s] + "</i></td>";
                                }
                                s++;
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "k3hezhi": //和值
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            for (var j = 3 ; j < 19 ; j++) {
                                if (j == open_obj.And_value) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " KuaiSan '><i data-info='" + _each_tr_data.HeZhi[j] + "' class='ball-noraml hezhizoushi'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.HeZhi[s] + "' class='ball-noraml '><i></i>" + _each_tr_data.HeZhi[s] + "</i></td>";
                                }
                                s++;
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "hezhizuhetype": //号码走势 
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data.HeZhiZuHeXingTai.XiaoQi + '</i></td>';
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data.HeZhiZuHeXingTai.XiaoOu + '</i></td>';
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data.HeZhiZuHeXingTai.DaQi + '</i></td>';
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data.HeZhiZuHeXingTai.DaOu + '</i></td>';
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "haomaxingtai": //号码形态 
                            //和值形态 
                            _Child_tdInfos += '<td class="border-right ' + _border_botton + ' "><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.SanTongHao + '</i></td>';
                            _Child_tdInfos += '<td class="border-right ' + _border_botton + '"><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.SanBuTongHao + '</i></td>';
                            _Child_tdInfos += '<td class="border-right ' + _border_botton + '"><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.SanLianHao + '</i></td>';
                            _Child_tdInfos += '<td class="border-right ' + _border_botton + '"><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.ErTongHaoFu + '</i></td>';
                            _Child_tdInfos += '<td class="border-right ' + _border_botton + '"><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.ErTongHaoDan + '</i></td>';
                            _Child_tdInfos += '<td class="border-right ' + _border_botton + '"><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.ErBuTongHao + '</i></td>';
                            
                            _keys++;
                            break;
                        case "kul8":
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 80 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Num[j] + "' class='ball-noraml '><i></i>" + _each_tr_data.Num[j] + "</i></td>";
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "DaXiao":
                            var _is_chonghao = 0;
                            if (_each_tr_data.DaXiao) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right '  colspan='3' ><i data-info='" + _each_tr_data.DaXiao + "' class='ball-noraml'>" + _each_tr_data.DaXiao; +"</i></td>";
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right '  colspan='3' ><i data-info='" + "" + "' class='ball-noraml'>" + "" +"</i></td>";
                            }                            
                            _keys++;
                            break;
                        case "DanShuang":
                            var _is_chonghao = 0;
                            if (_each_tr_data.DaXiao) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right '  colspan='3' ><i data-info='" + _each_tr_data.DanShuang + "' class='ball-noraml'>" + _each_tr_data.DanShuang; +"</i></td>";
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right '  colspan='3' ><i data-info='" + "" + "' class='ball-noraml'>" + "" + "</i></td>";
                            }
                            _keys++;
                            break;
                        case "ShangXia":
                            var _is_chonghao = 0;
                            if (_each_tr_data.DaXiao) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right '  colspan='3' ><i data-info='" + _each_tr_data.ShangXia + "' class='ball-noraml'>" + _each_tr_data.ShangXia; +"</i></td>";
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right '  colspan='3' ><i data-info='" + "" + "' class='ball-noraml'>" + "" + "</i></td>";
                            }
                            _keys++;
                            break;
                        case "JiOu":
                            var _is_chonghao = 0;
                            if (_each_tr_data.DaXiao) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right '  colspan='3' ><i data-info='" + _each_tr_data.JiOu + "' class='ball-noraml'>" + _each_tr_data.JiOu; +"</i></td>";
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right '  colspan='3' ><i data-info='" + "" + "' class='ball-noraml'>" + "" + "</i></td>";
                            }
                            _keys++;
                            break;
                        case "HeZhi":
                            var _is_chonghao = 0;
                            //console.log(_each_tr_data);
                            if (_each_tr_data.HeZhi != undefined && _each_tr_data.HeZhi != null) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right '  colspan='3' ><i data-info='" + _each_tr_data.HeZhi + "' class='ball-noraml'>" + _each_tr_data.HeZhi; +"</i></td>";
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right '  colspan='3' ><i data-info='" + "" + "' class='ball-noraml'>" + "" + "</i></td>";
                            }
                            _keys++;
                            break;
                        case "wanwei": //万位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Wan[j] + "' class='ball-noraml '>" + _each_tr_data.Wan[j] + "</i></td>";
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "qianwei"://千位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Qian[j] + "' class='ball-noraml '>" + _each_tr_data.Qian[j] + "</i></td>";
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "baiwei": //百位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Bai[j] + "' class='ball-noraml '>" + _each_tr_data.Bai[j] + "</i></td>";
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "shiwei": //十位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Shi[j] + "' class='ball-noraml '>" + _each_tr_data.Shi[j] + "</i></td>";
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "gewei": //个位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {
                                _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Ge[j] + "' class='ball-noraml '>" + _each_tr_data.Ge[j] + "</i></td>";
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "One": //万位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 1 ; j <= 11 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.One[j - 1] + "' class='ball-noraml '>" + _each_tr_data.One[j - 1] + "</i></td>";
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "Two"://千位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 1 ; j <= 11 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Two[j - 1] + "' class='ball-noraml '>" + _each_tr_data.Two[j - 1] + "</i></td>";
                                
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "Three": //百位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 1 ; j <= 11 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Three[j - 1] + "' class='ball-noraml '>" + _each_tr_data.Three[j - 1] + "</i></td>";
                                
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "Four": //十位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 1 ; j <= 11 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Four[j - 1] + "' class='ball-noraml '>" + _each_tr_data.Four[j - 1] + "</i></td>";
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "Five": //个位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 1 ; j <= 11 ; j++) {
                                _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Five[j - 1] + "' class='ball-noraml '>" + _each_tr_data.Five[j - 1] + "</i></td>";
                                
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "hmfb": //号码分布
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            var _length = _each_tr_data.Fen.length == undefined ? 10 : _each_tr_data.Fen.length;
                            for (var j = 0 ; j < _length ; j++) {
                                _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Fen[j] + "' class='ball-noraml '>" + _each_tr_data.Fen[j] + "</i></td>";
                                
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "haomakuadu": //号码跨度
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            if (_each_tr_data.KuaDu && _each_tr_data.KuaDu != null) {
                                var _length = _each_tr_data.KuaDu.length == undefined ? 10 : _each_tr_data.KuaDu.length;
                                for (var j = 0 ; j < _length ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.KuaDu[j] + "' class='ball-noraml '>" + _each_tr_data.KuaDu[j] + "</i></td>";

                                }
                            } else {
                                for (var j = 0 ; j < 10 ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.KuaDu + "' class='ball-noraml '>" + _each_tr_data.KuaDu + "</i></td>";

                                }
                            }
                           
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "daxiaobi": //大小比"","danshuangbi","zhihebi","hezhi"
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.DaXiaoBi && _each_tr_data.DaXiaoBi != null) {
                                var _length = _each_tr_data.DaXiaoBi.length == undefined ? 10 : _each_tr_data.DaXiaoBi.length;
                                for (var j = 0 ; j < _length ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DaXiaoBi[j] + '" class="ball-noraml">' + _each_tr_data.DaXiaoBi[j] + '</i></td>';

                                }
                            } else {
                                for (var j = 0 ; j < 5 ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DaXiaoBi + '" class="ball-noraml">' + _each_tr_data.DaXiaoBi + '</i></td>';

                                }
                            }

                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "danshuangbili": //大小比"","danshuangbi","zhihebi","hezhi"
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (open_obj.dashuan_bili == "5:0") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '" class="ball-noraml" style="background-color:#7999F3; color:#fff;">5:0</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '" class="ball-noraml">' + _each_tr_data.DanShuangBi[0] + '</i></td>';
                            }
                            if (open_obj.dashuan_bili == "4:1") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">4:1</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml">' + _each_tr_data.DanShuangBi[1] + '</i></td>';
                            }

                            if (open_obj.dashuan_bili == "3:2") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">3:2</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml">' + _each_tr_data.DanShuangBi[2] + '</i></td>';
                            }

                            if (open_obj.dashuan_bili == "2:3") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">2:3</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml">' + _each_tr_data.DanShuangBi[3] + '</i></td>';
                            }
                            if (open_obj.dashuan_bili == "1:4") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">1:4</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml">' + _each_tr_data.DanShuangBi[4] + '</i></td>';
                            }

                            if (open_obj.dashuan_bili == "0:5") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">0:5</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml">' + _each_tr_data.DanShuangBi[5] + '</i></td>';
                            }

                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "danshuangbi": //单双比"","danshuangbi","zhihebi","hezhi"  
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.DanShuangBi) {
                                if (open_obj.zhihe_bili == "5:0") {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '" class="ball-noraml" style="background-color:#7999F3; color:#fff;">5:0</i></td>';
                                }
                                else {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '" class="ball-noraml">' + _each_tr_data.DanShuangBi[0] + '</i></td>';
                                }
                                if (open_obj.zhihe_bili == "4:1") {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">4:1</i></td>';
                                }
                                else {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml">' + _each_tr_data.DanShuangBi[1] + '</i></td>';
                                }

                                if (open_obj.zhihe_bili == "3:2") {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">3:2</i></td>';
                                }
                                else {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml">' + _each_tr_data.DanShuangBi[2] + '</i></td>';
                                }

                                if (open_obj.zhihe_bili == "2:3") {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">2:3</i></td>';
                                }
                                else {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml">' + _each_tr_data.DanShuangBi[3] + '</i></td>';
                                }
                                if (open_obj.zhihe_bili == "1:4") {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">1:4</i></td>';
                                }
                                else {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml">' + _each_tr_data.DanShuangBi[4] + '</i></td>';
                                }

                                if (open_obj.zhihe_bili == "0:5") {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">0:5</i></td>';
                                }
                                else {
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml">' + _each_tr_data.DanShuangBi[5] + '</i></td>';
                                }
                            } else {
                                _Child_tdInfos += '<td colspan=\"1\" class="ball-none  ' + _border_botton + '"><i data-info="' + "" + '"  class="ball-noraml">' + "" + '</i></td>';
                            }
                            
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "ZhongWeiShu": //中位数  
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.ZhongWeiShu) {
                                _Child_tdInfos += '<td class="td-4-1 ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhongWeiShu + '"  class="ball-noraml">' + _each_tr_data.ZhongWeiShu + '</i></td>';
                            } else {
                                _Child_tdInfos += '<td class="td-4-1 ball-none  ' + _border_botton + '"><i data-info="' + "" + '"  class="ball-noraml">' + "" + '</i></td>';
                            }
                            
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "zhihebi": //大小比"","danshuangbi","zhihebi","hezhi"
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (open_obj.zhihe_bili == "5:0") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '" class="ball-noraml" style="background-color:#7999F3; color:#fff;">5:0</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '" class="ball-noraml">' + _each_tr_data.ZhiHeBi[0] + '</i></td>';
                            }
                            if (open_obj.zhihe_bili == "4:1") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">4:1</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml">' + _each_tr_data.ZhiHeBi[1] + '</i></td>';
                            }

                            if (open_obj.zhihe_bili == "3:2") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">3:2</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml">' + _each_tr_data.ZhiHeBi[2] + '</i></td>';
                            }

                            if (open_obj.zhihe_bili == "2:3") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">2:3</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml">' + _each_tr_data.ZhiHeBi[3] + '</i></td>';
                            }
                            if (open_obj.zhihe_bili == "1:4") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">1:4</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml">' + _each_tr_data.ZhiHeBi[4] + '</i></td>';
                            }

                            if (open_obj.zhihe_bili == "0:5") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">0:5</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml">' + _each_tr_data.ZhiHeBi[5] + '</i></td>';
                            }

                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "hezhi": //"danshuangbi","zhihebi","hezhi"
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.HeZhi != undefined) {
                                var _is_chonghao = 0;
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.HeZhi + "' class='ball-noraml '>" + _each_tr_data.HeZhi + "</i></td>";
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                                _keys++;
                            } else {
                                var _is_chonghao = 0;
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='' class='ball-noraml '></i></td>";
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                                _keys++;
                            }
                            break;
                            //["hmfb","Size_form","Single_double","Quality_He","012xingtai","zusan","zuliu","baozi","kuadu","And_value","And_value_Ws"]
                        case "Size_form": // 大小形态 
                            var _is_chonghao = 0;
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.Size_form && _each_tr_data.Size_form != null) {
                                var _length = _each_tr_data.Size_form.length == undefined ? 10 : _each_tr_data.Size_form.length;
                                for (var j = 0 ; j < _length ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.Size_form[j] + '" class="ball-noraml">' + _each_tr_data.Size_form[j] + '</i></td>';

                                }
                            } else if (_each_tr_data.Size_form && _each_tr_data.Size_form == null) {
                                for (var j = 0 ; j < 5 ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.Size_form + '" class="ball-noraml">' + _each_tr_data.Size_form + '</i></td>';
                                }
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  '  colspan='1' ><i data-info='" + "" + "' class='ball-noraml'>" + "" +"</i></td>";
                            }
                            //_Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.Size_form.substr(_open_key, 3); +"</i></td>";
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "Single_double": // 单双形态 
                            var _is_chonghao = 0;
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.Single_double && _each_tr_data.Single_double != null) {
                                var _length = _each_tr_data.Single_double.length == undefined ? 10 : _each_tr_data.Single_double.length;
                                for (var j = 0 ; j < _length ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.Single_double[j] + '" class="ball-noraml">' + _each_tr_data.Single_double[j] + '</i></td>';

                                }
                            } else if (_each_tr_data.Single_double && _each_tr_data.Single_double == null) {
                                //获取球是否在开奖号码
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data.Single_double + "' class='ball-noraml'>" + _each_tr_data.Single_double; + "</i></td>";
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + "" + "' class='ball-noraml'>" + "" +"</i></td>";
                            }
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            //_Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_green  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + open_obj.Single_double.substr(_open_key, 3); +"</i></td>";
                            _keys++;
                            break;
                        case "Quality_He": // 质合形态 
                            var _is_chonghao = 0;
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.Quality_He && _each_tr_data.Quality_He != null) {
                                var _length = _each_tr_data.Quality_He.length == undefined ? 10 : _each_tr_data.Quality_He.length;
                                for (var j = 0 ; j < _length ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.Quality_He[j] + '" class="ball-noraml">' + _each_tr_data.Quality_He[j] + '</i></td>';

                                }
                            } else if (_each_tr_data.Quality_He && _each_tr_data.Quality_He == null) {
                                for (var j = 0 ; j < 5 ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.Quality_He + '" class="ball-noraml">' + _each_tr_data.Quality_He + '</i></td>';

                                }
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + "" + "' class='ball-noraml'>" + "" +"</i></td>";
                            }
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            //_Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + open_obj.Quality_He.substr(_open_key, 3); +"</i></td>";
                            _keys++;
                            break;
                        case "012xingtai": // 012形态 
                            var _is_chonghao = 0;
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data._012XingTai && _each_tr_data._012XingTai != null) {
                                var _length = _each_tr_data._012XingTai.length == undefined ? 10 : _each_tr_data._012XingTai.length;
                                for (var j = 0 ; j < _length ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data._012XingTai[j] + "' class='ball-noraml'>" + _each_tr_data._012XingTai[j] + "</i></td>";
                                }
                            } else if (_each_tr_data._012XingTai && _each_tr_data._012XingTai == null) {
                                for (var j = 0 ; j < 5 ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data._012XingTai + "' class='ball-noraml'>" + _each_tr_data._012XingTai + "</i></td>";
                                }
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + "" + "' class='ball-noraml'>" + "" + "</i></td>";
                            }
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            //_Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_green  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data._012XingTai; +"</i></td>";
                            _keys++;
                            break;
                        case "zusan": // 组三
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " zusan  border-right '  colspan='3'><i data-info='" + _each_tr_data.ZuSan + "' class='ball-noraml'>" + _each_tr_data.ZuSan + "</i></td>";
                            _keys++;
                            break;
                        case "zuliu": // 组六 
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " zusan border-right '  colspan='3'><i data-info='" + _each_tr_data.ZuLiu + "' class='ball-noraml'>" + _each_tr_data.ZuLiu + "</i></td>";
                            _keys++;
                            break;
                        case "baozi": // 豹子 
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " baozi border-right ' colspan='3'><i data-info='" + _each_tr_data.BaoZi + "' class='ball-noraml'>" + _each_tr_data.BaoZi + "</i></td>";
                            _keys++;
                            break;
                        case "kuadu": // 跨度 
                            var _is_chonghao = 0;
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.KuaDu && _each_tr_data.KuaDu != null) {
                                var _length = _each_tr_data.KuaDu.length == undefined ? 10 : _each_tr_data.KuaDu.length;
                                for (var j = 0 ; j < _length ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data.KuaDu[j] + "' class='ball-noraml'>" + _each_tr_data.KuaDu[j] + "</i></td>";
                                }
                            } else if (_each_tr_data.KuaDu && _each_tr_data.KuaDu == null) {
                                for (var j = 0 ; j < 5 ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data.KuaDu + "' class='ball-noraml'>" + _each_tr_data.KuaDu + "</i></td>";
                                }
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + "" + "' class='ball-noraml'>" + "" + "</i></td>";
                            }
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            //_Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue border-right ' colspan='3'><i data-info='" + _each_tr_data.KuaDu + "' class='ball-noraml'>" + _each_tr_data.KuaDu + "</i></td>";
                            _keys++;
                            break;
                        case "kuaduzs": //跨度走势
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {
                                _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.KuaDuZouShi[j] + "' class='ball-noraml '>" + _each_tr_data.KuaDuZouShi[j] + "</i></td>";
                                
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "And_value": // 直选和值 
                            var _is_chonghao = 0;
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.ZhiXuanHeZhi && _each_tr_data.ZhiXuanHeZhi != null) {
                                var _length = _each_tr_data.ZhiXuanHeZhi.length == undefined ? 10 : _each_tr_data.ZhiXuanHeZhi.length;
                                for (var j = 0 ; j < _length ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data.ZhiXuanHeZhi[j] + "' class='ball-noraml'>" + _each_tr_data.ZhiXuanHeZhi[j] + "</i></td>";
                                }
                            } else if (_each_tr_data.ZhiXuanHeZhi && _each_tr_data.ZhiXuanHeZhi == null) {
                                for (var j = 0 ; j < 5 ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data.ZhiXuanHeZhi + "' class='ball-noraml'>" + _each_tr_data.ZhiXuanHeZhi + "</i></td>";
                                }
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + "" + "' class='ball-noraml'>" + "" + "</i></td>";
                            }
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            //_Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_red border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.ZhiXuanHeZhi + "</i></td>";
                            
                            _keys++;
                            break;
                        case "And_value_infos": // 直选和值 
                            var _is_chonghao = 0;
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.ZhiXuanHeZhi && _each_tr_data.ZhiXuanHeZhi != null) {
                                var _length = _each_tr_data.ZhiXuanHeZhi.length == undefined ? 10 : _each_tr_data.ZhiXuanHeZhi.length;
                                for (var j = 0 ; j < _length ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data.ZhiXuanHeZhi[j] + "' class='ball-noraml'>" + _each_tr_data.ZhiXuanHeZhi[j] + "</i></td>";
                                }
                            } else if (_each_tr_data.ZhiXuanHeZhi && _each_tr_data.ZhiXuanHeZhi == null) {
                                for (var j = 0 ; j < 5 ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data.ZhiXuanHeZhi + "' class='ball-noraml'>" + _each_tr_data.ZhiXuanHeZhi + "</i></td>";
                                }
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + "" + "' class='ball-noraml'>" + "" + "</i></td>";
                            }
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            //_Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right ' colspan='3'><i data-info='" + _each_tr_data.ZhiXuanHeZhi + "' class='ball-noraml'>" + _each_tr_data.ZhiXuanHeZhi + "</i></td>";
                            _keys++;
                            break;
                        case "And_value_Ws": // 直选和值尾数
                            var _is_chonghao = 0;
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data.HeZhiWeiShu && _each_tr_data.HeZhiWeiShu != null) {
                                var _length = _each_tr_data.HeZhiWeiShu.length == undefined ? 10 : _each_tr_data.HeZhiWeiShu.length;
                                for (var j = 0 ; j < _length ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data.HeZhiWeiShu[j] + "' class='ball-noraml'>" + _each_tr_data.HeZhiWeiShu[j] + "</i></td>";
                                }
                            } else if (_each_tr_data.HeZhiWeiShu && _each_tr_data.HeZhiWeiShu == null) {
                                for (var j = 0 ; j < 5 ; j++) {
                                    //获取球是否在开奖号码
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + _each_tr_data.HeZhiWeiShu + "' class='ball-noraml'>" + _each_tr_data.HeZhiWeiShu + "</i></td>";
                                }
                            } else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai '  colspan='1' ><i data-info='" + "" + "' class='ball-noraml'>" + "" + "</i></td>";
                            }
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            //_Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.HeZhiWeiShu + "</i></td>";
                            
                            _keys++;
                            break;
                        case "hezhi": //"danshuangbi","zhihebi","hezhi"
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data[i][j] + "' class='ball-noraml '>" + open_obj.And_value + "</i></td>";
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "duizhi": //"danshuangbi","zhihebi","hezhi" 
                            var _is_chonghao = 0; _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " baozi border-right ' colspan='3'><i data-info='" + _each_tr_data.DuiZi + "' class='ball-noraml'>" + _each_tr_data.DuiZi + "</i></td>";
                            
                            _keys++;
                            break;
                        case "_012":	//012路
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (_each_tr_data._012) {
                                var s = 0;
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data._012._0 + '</i></td>';
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                                _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                                var s = 0;
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data._012._1 + '</i></td>';
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                                _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                                var s = 0;
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data._012._2 + '</i></td>';
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            } else {
                                var s = 0;
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + "" + '</i></td>';
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                                _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                                var s = 0;
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + "" + '</i></td>';
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                                _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                                var s = 0;
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + "" + '</i></td>';
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            }
                            
                            break;
                        case "KuDu":	//跨度	
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            if (_each_tr_data.KuDu) {
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data.KuDu + '</i></td>';
                            } else {
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + "" + '</i></td>';
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            break;
                        case "XiaoQu":	//小区
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            for (var j = 1 ; j < 11 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.XiaoQu[s] + "' class='ball-noraml '><i></i>" + _each_tr_data.XiaoQu[s] + "</i></td>";
                                s++;
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "DaQu":	//大区
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            for (var j = 11 ; j < 21 ; j++) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.DaQu[s] + "' class='ball-noraml '><i></i>" + _each_tr_data.DaQu[s] + "</i></td>";
                                s++;
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "guanjun":	//冠军
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {
                                if (_each_tr_data.Fen[j] < 0) {
                                    _Child_tdInfos += "<td class='td-" + 0 + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + (j + 1) + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + 0 + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml '>" + _each_tr_data.Fen[j] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "pkjiou":	//pk奇偶   
                            if (_each_tr_data.Ji == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Ji + '><i class="ball-noraml duizi"></i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Ou + '><i class="ball-noraml">' + _each_tr_data.Ou + '</i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Ji + '><i class="ball-noraml ">' + _each_tr_data.Ji + '</i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Ou + '><i class="ball-noraml duizi"></i></td>';
                            }
                            _keys++;
                            break;
                        case "pkdaxiao":	//pk大小
                            if (_each_tr_data.Da == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Da + '><i class="ball-noraml duizi"></i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Xiao + '><i class="ball-noraml">' + _each_tr_data.Xiao + '</i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Da + '><i class="ball-noraml ">' + _each_tr_data.Da + '</i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Xiao + '><i class="ball-noraml duizi"></i></td>';
                            }
                            _keys++;
                            break;
                        case "pkzhihe":	//pk质合
                            if (_each_tr_data.Zhi == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Zhi + '><i class="ball-noraml duizi"></i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.He + '><i class="ball-noraml">' + _each_tr_data.He + '</i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Zhi + '><i class="ball-noraml ">' + _each_tr_data.Zhi + '</i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.He + '><i class="ball-noraml duizi"></i></td>';
                            }
                            _keys++;
                            break;
                        case "pk012":	//pk012 
                            if (_each_tr_data._0 == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data._0 + '</i></td>';
                            }

                            if (_each_tr_data._1 == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data._1 + '</i></td>';
                            }

                            if (_each_tr_data._2 == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data._2 + '</i></td>';
                            }
                            _keys++;
                            break;
                        case "pkspj":	//pk升平降
                            if (_each_tr_data.Sheng == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data.Sheng + '</i></td>';
                            }

                            if (_each_tr_data.Ping == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data.Ping + '</i></td>';
                            }

                            if (_each_tr_data.Jiang == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data.Jiang + '</i></td>';
                            }
                            _keys++;
                            break;
                        default:
                            break;
                    }
                }
            }
            return _Child_tdInfos;
        },
        //获取时时彩的底部信息
        get_ssc_tfooter: function (_config_options) { //获取时时彩的底部
            var _TFooter = "";

            if (_config_options.data != null && _config_options.data.Body.Foot.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Foot;  //需要遍历的数据 
                var _tbody = '<tfoot  class="chart table-tfoot"></tfoot>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].StatisticsName; //期号 
                    //1、创建开奖号码对象；
                    var _open_Numb = "";
                    //console.log(_open_Numb);
                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = 'border-bottom';
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _open_predio + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + "" + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';

                    var _keys = "0";
                    switch (_config_options.TypeVal) {
                        case "wuxin":   //五星基本
                            var other_infos = ["wanwei","qianwei","baiwei","shiwei","gewei","hmfb"];		
							var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data,8,_open_Numb,other_infos,1,_border_botton);
							_tr_Init_html += _theTr_infos +"</tr>"; 
							break;
                        case "wuxinzonghe":					//五星综合
                            var other_infos = ["hmfb", "haomakuadu", "daxiaobi", "danshuangbi", "zhihebi", "hezhi"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 6, _open_Numb, other_infos, 1, _border_botton);
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "sixing":						//四星
                            var other_infos = ["qianwei","baiwei","shiwei","gewei","hmfb"];		//号码分布							
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 7, _open_Numb, other_infos, 1, _border_botton, "sixing");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "qiansan":						//前三
                            var other_infos = ["wanwei", "qianwei", "baiwei", "hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "qiansan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "zhongsan":						//中三
                            var other_infos = ["qianwei", "baiwei", "shiwei", "hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "zhongsan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "housan":						//后三
                            var other_infos = ["baiwei", "shiwei", "gewei", "hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "housan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "qianer":						//前二
                            var other_infos = ["wanwei", "qianwei", "duizhi", "hmfb", "kuaduzs", "And_value_infos"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton, "qianer");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "houer":						//后二
                            var other_infos = ["shiwei", "gewei", "duizhi", "hmfb", "kuaduzs", "And_value_infos"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton, "houer");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        default:
                            break;
                    }
                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
            return _TFooter;
        },
        //获取福彩3d的底部
        get_3D_tfooter: function (_config_options) {
            var _TFooter = "";
            if (_config_options.data != null && _config_options.data.Body.Foot.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Foot;  //需要遍历的数据 
                var _tbody = '<tfoot  class="chart table-tfoot"></tfoot>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].StatisticsName; //期号 
                    //1、创建开奖号码对象；
                    var _open_Numb = "";
                    //console.log(_open_Numb);
                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = 'border-bottom';
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _open_predio + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + "" + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';

                    var other_infos = ["baiwei", "shiwei", "gewei", "hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                    var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "3D");
                    _tr_Init_html += _theTr_infos + "</tr>";

                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
            return _TFooter;
        },
        //获取排列3、5的底部
        get_pl5_tfooter: function (_config_options) { //获取时时彩的底部
            var _TFooter = "";
            if (_config_options.data != null && _config_options.data.Body.Foot.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Foot;  //需要遍历的数据 
                var _tbody = '<tfoot  class="chart table-tfoot"></tfoot>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].StatisticsName; //期号 
                    //1、创建开奖号码对象；
                    var _open_Numb = "";
                    //console.log(_open_Numb);
                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = 'border-bottom';
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _open_predio + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + "" + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';
                    switch (_config_options.TypeVal) {
                        case "wuxin":
                            var other_infos = ["wanwei", "qianwei", "baiwei", "shiwei", "gewei", "hmfb"];		//五星基本
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton);
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "wuxinzonghe":					//五星综合
                            var other_infos = ["hmfb", "haomakuadu", "daxiaobi", "danshuangbi", "zhihebi", "hezhi"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 6, _open_Numb, other_infos, 1, _border_botton);
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "sixing":						//四星
                            var other_infos = ["qianwei", "baiwei", "shiwei", "gewei", "hmfb"];		//号码分布
                            _open_Numb.numb_arry[0] = "-1";

                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 7, _open_Numb, other_infos, 1, _border_botton, "sixing");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "qiansan":						//前三
                            var other_infos = ["hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "qiansan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "zhongsan":						//中三
                            var other_infos = ["hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "zhongsan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "housan":						//后三
                            var other_infos = ["hmfb", "Size_form", "Single_double", "Quality_He", "012xingtai", "zusan", "zuliu", "baozi", "kuadu", "And_value", "And_value_Ws"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 16, _open_Numb, other_infos, 1, _border_botton, "housan");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "qianer":						//后三
                            var other_infos = ["zusan", "hmfb", "kuaduzs", "And_value_infos"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton, "qianer");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        case "houer":						//后三
                            var other_infos = ["zusan", "hmfb", "kuaduzs", "And_value_infos"];		//号码分布
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton, "houer");
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        default:
                            break;
                    }
                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
            return _TFooter;
        },
        //获取11选5底部信息
        get_11x5_tfooter: function (_config_options) { //获取11选5底部信息		

            var _TFooter = "";
            var _keys = "0";
            if (_config_options.data != null && _config_options.data.Body.Foot.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Foot;  //需要遍历的数据 
                var _tbody = '<tfoot  class="chart table-tfoot"></tfoot>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].StatisticsName;
                    //1、创建开奖号码对象；
                    var _open_Numb = "";

                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = 'border-bottom';
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _open_predio + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + "" + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';
                    switch (_config_options.TypeVal) {
                        case "11X5":
                            var other_infos = ["One", "Two", "Three", "Four", "Five", "hmfb", "danshuangbi", "ZhongWeiShu"];		//号码分布，单双比，中间值
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton);
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        default:
                            break;
                    }
                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
            return _TFooter;
        },
        //获取北京快乐8的号码底部信息
        get_kl8_tfooter: function (_config_options) { //获取快乐8底部
            var _TFooter = "";

            if (_config_options.data != null && _config_options.data.Body.Foot.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _Child_tdInfos = "";
                var _open_Numb = "";
                var _keys = "0";
                var _each_Data = _config_options.data.Body.Foot;  //需要遍历的数据 
                var _tbody = '<tfoot  class="chart table-tfoot"></tfoot>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                for (i in _each_Data) {
                    //var _tr_Init_html = ""; 
                    //console.log(i);
                    var _open_predio = _each_Data[i].StatisticsName;
                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = '';
                    _border_botton = 'border-bottom'
                    //tr的初始两个值
                    _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _each_Data[i].StatisticsName + '</td><td class="ball-none border-right ' + _border_botton + '"></td>';
                    switch (_config_options.TypeVal) {
                        case "jiben":
                            var other_infos = ["kul8", "DaXiao", "DanShuang", "ShangXia", "JiOu", "HeZhi"];		//大小，单双，上下，奇偶，和值
                            var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 8, _open_Numb, other_infos, 1, _border_botton, "wuxing"); //追加单元格( 当前行遗漏数据，追加几列，开奖号码对象，额外统计数据,类型 )
                            _tr_Init_html += _theTr_infos + "</tr>";
                            break;
                        default:
                            break;
                    }

                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
            return _TFooter;
        },
        //快乐农场底部信息
        get_xync_tfooter: function (_config_options) { //获取幸运农场底部		

            var _TFooter = "";

            if (_config_options.data != null && _config_options.data.Body.Foot.length > 0) {
                //遍历每一行的数据
                var _each_tr_html = "";
                var _each_Data = _config_options.data.Body.Foot;  //需要遍历的数据 
                var _tbody = '<tfoot  class="chart table-tfoot"></tfoot>';
                $("#" + _config_options.Chart_Container + "-table").append($(_tbody));
                for (i in _each_Data) {
                    var _open_predio = _each_Data[i].StatisticsName;
                    //1、创建开奖号码对象；
                    var _open_Numb = "";

                    //遍历当前行
                    var _each_tr_data = _each_Data[i];
                    var _border_botton = 'border-bottom';
                    //tr的初始两个值
                    var _tr_Init_html = '<tr class="' + i + '-td ' + _border_botton + '"><td class="ball-none ' + _border_botton + '"></td><td class="issue-numbers ' + _border_botton + '">' + _open_predio + '</td><td class="ball-none border-right ' + _border_botton + '"></td><td class="ball-none  ' + _border_botton + '"></td><td class=" ' + _border_botton + '"><span class="lottery-numbers">' + "" + '</span></td><td class="ball-none border-right ' + _border_botton + '"></td>';
                    var other_infos = ["XiaoQu", "DaQu", "_012", "KuDu"];		//小区，大区，012路，跨度
                    var _theTr_infos = this.getFooterAppendChildTd(_each_tr_data, 4, _open_Numb, other_infos, 1, _border_botton, "wuxing");
                    _tr_Init_html += _theTr_infos + "</tr>";
                    $("#" + _config_options.Chart_Container + "-table .table-guides").append($(_tr_Init_html));
                }
            }
            return _TFooter;
        },
        //根据开奖号码，计算号码形态
        get_OpenOptions: function (openNumb, type) {
            var OpenisArry = false;
            if (type != undefined) {
                if (type != "string") {
                    OpenisArry = "kuaile8";
                }
                else {
                    openNumb = openNumb.split(",");
                    OpenisArry = true;
                }
            }
            var Open_opions = {};
            //			1、数组
            Open_opions.numb_arry = new Array();
            //			2、奇偶性
            Open_opions.Parity = "";
            //			3、和值

            Open_opions.And_value = 0;
            //			5、大小形态
            Open_opions.Size_form = "";
            //			6、单双形态
            Open_opions.Single_double = "";
            //			7、质合形态
            Open_opions.Quality_He = "";

            var _daNumb = 0;
            var _jiouNumb = 0;
            var _zhizheNumb = 0;
            var theLength = openNumb.length;
            var j = 0;
            for (var i = 0 ; i < theLength ; i++) {

                if (OpenisArry && OpenisArry != "kuaile8") {
                    var theNumb = openNumb[i];
                }
                else {
                    if (OpenisArry != "kuaile8") {
                        var theNumb = openNumb.substr(i, 1);
                    }
                    else {
                        var theNumb = openNumb.substr(j, 2);
                    }
                }


                Open_opions.numb_arry.push(Number(theNumb));
                //计算奇偶值
                if (Number(theNumb) % 2) {
                    _jiouNumb++;
                    Open_opions.Parity += "奇";
                    Open_opions.Single_double += "单";
                }
                else {
                    Open_opions.Parity += "偶";
                    Open_opions.Single_double += "双";
                }
                //计算和值 
                Open_opions.And_value += Number(theNumb);
                //大小形态
                if (Number(theNumb) >= 5) {
                    _daNumb++;
                    Open_opions.Size_form += "大";
                }
                else {
                    Open_opions.Size_form += "小";
                }
                //质合形态
                if (theNumb == "1" || theNumb == "2" || theNumb == "3" || theNumb == "5" || theNumb == "7") {
                    _zhizheNumb++;
                    Open_opions.Quality_He += "质";
                }
                else {
                    Open_opions.Quality_He += "合";
                }

                j += 2;
            }

            //			9、组三
            //			13、对子
            //			11、豹子
            Open_opions.zusan = false;
            Open_opions.duizi = false;
            Open_opions.baozi = false;
            if (Open_opions.numb_arry.length == 3) {
                if (Open_opions.numb_arry[0] == Open_opions.numb_arry[1] && Open_opions.numb_arry[1] == Open_opions.numb_arry[2]) {
                    Open_opions.baozi = true;
                }

                if (Open_opions.numb_arry[0] == Open_opions.numb_arry[1] || Open_opions.numb_arry[0] == Open_opions.numb_arry[2]) {
                    Open_opions.zusan = true;
                    Open_opions.duizi = true;
                }

                if (Open_opions.numb_arry[1] == Open_opions.numb_arry[2]) {
                    Open_opions.zusan = true;
                    Open_opions.duizi = true;
                }
            }

            //			12、跨度
            Open_opions.kuadu = 0;
            if (theLength > 1) {
                var _Arry_max = Math.max.apply(Math, Open_opions.numb_arry);
                var _Arry_min = Math.min.apply(Math, Open_opions.numb_arry);
                Open_opions.kuadu = _Arry_max - _Arry_min;
            }
            //			10、组六 

            //			14、大小比例
            Open_opions.Proportion_size = "";
            Open_opions.zhihe_bili = "";
            Open_opions.dashuan_bili = "";

            Open_opions.Proportion_size = _daNumb + ":" + (theLength - _daNumb);
            Open_opions.zhihe_bili = _zhizheNumb + ":" + (theLength - _zhizheNumb);
            Open_opions.dashuan_bili = _jiouNumb + ":" + (theLength - _jiouNumb);


            Open_opions.up_down = "上";
            Open_opions.zuliu = false;
            Open_opions.hezhixingtai = "小奇";
            //Open_opions.hezhixingtai = "小偶" ; 
            //Open_opions.hezhixingtai = "大奇" ; 
            //Open_opions.hezhixingtai = "大偶" ; 

            return Open_opions;
        },
        //追加单元格( 当前行遗漏数据，追加几列，开奖号码对象，额外统计数据,类型 )
        getAppendChildTd: function (_each_tr_data, numb, open_obj, other_infos, type, _border_botton, xingshu) {
            var _Child_tdInfos = "";
            var _other_infos_len = other_infos.length == undefined ? 0 : other_infos.length;
            var _keys = "0";
            var _open_key = 0;
            if (xingshu == "qiansan") {
                _open_key = 0;
            }
            if (xingshu == "zhongsan") {
                _open_key = 1;
            }
            if (xingshu == "housan") {
                _open_key = 2;
            }

            if (_other_infos_len > 0)	// 获取遍历的关键词
            {
                for (var k = 0 ; k < _other_infos_len ; k++) {
                    switch (other_infos[k]) {
                        case "haomazoushi": //号码走势
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            for (var j = 1 ; j < 7 ; j++) {
                                var _Boll_in_arry = this.check_Number_inArry(j, open_obj.numb_arry);
                                if (_Boll_in_arry.state) {
                                    if (_Boll_in_arry.number > 1) {
                                        _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " KuaiSan_OpenNo '><i data-info='" + _each_tr_data.HaoMaZouShi[j] + "' class='ball-noraml openNo-0'>" + j + "<em class='chonghao'>" + _Boll_in_arry.number + "</em></i></td>";
                                    }
                                    else {
                                        _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " KuaiSan_OpenNo '><i data-info='" + _each_tr_data.HaoMaZouShi[j] + "' class='ball-noraml openNo-0'>" + j + "</i></td>";
                                    }
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.HaoMaZouShi[s] + "' class='ball-noraml miss_data '><i></i>" + _each_tr_data.HaoMaZouShi[s] + "</i></td>";
                                }
                                s++;
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "k3hezhi": //和值
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            for (var j = 3 ; j < 19 ; j++) {
                                if (j == open_obj.And_value) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " KuaiSan '><i data-info='" + _each_tr_data.HeZhi[j] + "' class='ball-noraml hezhizoushi'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.HeZhi[s] + "' class='ball-noraml miss_data '><i></i>" + _each_tr_data.HeZhi[s] + "</i></td>";
                                }
                                s++;
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "hezhizuhetype": //和值组合类型
                            if (isNaN(parseInt(_each_tr_data.HeZhiZuHeXingTai.XiaoQi)) || Number(_each_tr_data.HeZhiZuHeXingTai.XiaoQi) == -2) {
                                _Child_tdInfos += '<td colspan="3" class="' + _border_botton + ' border-right isSHow"><i class="ball-noraml hezhixingtai">小奇</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data.HeZhiZuHeXingTai.XiaoQi + '</i></td>';
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            }
                            if (isNaN(_each_tr_data.HeZhiZuHeXingTai.XiaoOu) || Number(_each_tr_data.HeZhiZuHeXingTai.XiaoOu) == -2) {
                                _Child_tdInfos += '<td colspan="3" class="' + _border_botton + ' border-right isSHow"><i class="ball-noraml hezhixingtai">小偶</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data.HeZhiZuHeXingTai.XiaoOu + '</i></td>';
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            }
                            if (isNaN(_each_tr_data.HeZhiZuHeXingTai.DaQi) || Number(_each_tr_data.HeZhiZuHeXingTai.DaQi) == -2) {
                                _Child_tdInfos += '<td colspan="3" class="' + _border_botton + ' border-right isSHow"><i class="ball-noraml hezhixingtai">大奇</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data.HeZhiZuHeXingTai.DaQi + '</i></td>';
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            }
                            if (isNaN(_each_tr_data.HeZhiZuHeXingTai.DaOu) || Number(_each_tr_data.HeZhiZuHeXingTai.DaOu) == -2) {
                                _Child_tdInfos += '<td colspan="3" class="' + _border_botton + ' border-right isSHow"><i class="ball-noraml hezhixingtai">大偶</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                                _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data.HeZhiZuHeXingTai.DaOu + '</i></td>';
                                _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            }
                            _keys++;
                            break;
                        case "haomaxingtai": //号码形态 
                            //和值形态   
                            if (isNaN(_each_tr_data.HaoMaXingTai.SanTongHao) || Number(_each_tr_data.HaoMaXingTai.SanTongHao) == -2) {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + ' isSHow"><i class="ball-noraml haomaxingtai">三同号</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + ' "><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.SanTongHao + '</i></td>';
                            }

                            if (isNaN(_each_tr_data.HaoMaXingTai.SanBuTongHao) || Number(_each_tr_data.HaoMaXingTai.SanBuTongHao) == -2) {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + ' isSHow"><i class="ball-noraml haomaxingtai">三不同号</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + '"><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.SanBuTongHao + '</i></td>';
                            }

                            if (isNaN(_each_tr_data.HaoMaXingTai.SanLianHao) || Number(_each_tr_data.HaoMaXingTai.SanLianHao) == -2) {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + ' isBaozi"><i class="ball-noraml haomaxingtai">三连号</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + '"><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.SanLianHao + '</i></td>';
                            }

                            if (isNaN(_each_tr_data.HaoMaXingTai.ErTongHaoFu) || Number(_each_tr_data.HaoMaXingTai.ErTongHaoFu) == -2) {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + ' isHmxt"><i class="ball-noraml haomaxingtai">二同号（复）</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + '"><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.ErTongHaoFu + '</i></td>';
                            }
                            if (isNaN(_each_tr_data.HaoMaXingTai.ErTongHaoDan) || Number(_each_tr_data.HaoMaXingTai.ErTongHaoDan) == -2) {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + ' isHmxt"><i class="ball-noraml haomaxingtai">二同号（单）</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + '"><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.ErTongHaoDan + '</i></td>';
                            }
                            if (isNaN(_each_tr_data.HaoMaXingTai.ErBuTongHao) || Number(_each_tr_data.HaoMaXingTai.ErBuTongHao) == -2) {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + ' isHmxt"><i class="ball-noraml haomaxingtai">二不同号</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td class="border-right ' + _border_botton + '"><i class="ball-noraml haomaxingtai">' + _each_tr_data.HaoMaXingTai.ErBuTongHao + '</i></td>';
                            }
                            _keys++;
                            break;
                        case "kul8":
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 80 ; j++) {
                                var _Boll_in_arry = this.check_Number_inArry(j + 1, open_obj.numb_arry);
                                if (_Boll_in_arry.state) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + parseInt(j + 1) + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.Num[j] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "DaXiao":
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.DaXiao; +"</i></td>";
                            _keys++;
                            break;
                        case "DanShuang":
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.DanShuang; +"</i></td>";
                            _keys++;
                            break;
                        case "ShangXia":
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.ShangXia; +"</i></td>";
                            _keys++;
                            break;
                        case "JiOu":
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.JiOu; +"</i></td>";
                            _keys++;
                            break;
                        case "HeZhi":
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.HeZhi; +"</i></td>";
                            _keys++;
                            break;
                        case "wanwei": //万位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {

                                if (j == open_obj.numb_arry[0]) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.Wan[j] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "qianwei"://千位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {

                                if (j == open_obj.numb_arry[1]) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.Qian[j] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "baiwei": //百位
                            var Suoying = 2;
                            if (open_obj.numb_arry.length < 4 ) {
                                Suoying = 0;
                            }
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) { 
                                if (j == open_obj.numb_arry[Suoying]) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.Bai[j] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "shiwei": //十位
                            var Suoying = 3;
                            if (open_obj.numb_arry.length < 4) {
                                Suoying = 1;
                            }
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {

                                if (j == open_obj.numb_arry[Suoying]) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.Shi[j] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "gewei": //个位
                            var Suoying = 4;
                            if (open_obj.numb_arry.length < 4) {
                                Suoying = 2;
                            }
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {
                                if (j == open_obj.numb_arry[Suoying]) {
                                    _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.Ge[j] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "One": //万位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 1 ; j <= 11 ; j++) {

                                if (j == open_obj.numb_arry[0]) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.One[j - 1] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "Two"://千位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 1 ; j <= 11 ; j++) {

                                if (j == open_obj.numb_arry[1]) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.Two[j - 1] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "Three": //百位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 1 ; j <= 11 ; j++) {

                                if (j == open_obj.numb_arry[2]) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.Three[j - 1] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "Four": //十位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 1 ; j <= 11 ; j++) {

                                if (j == open_obj.numb_arry[3]) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.Four[j - 1] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "Five": //个位
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 1 ; j <= 11 ; j++) {
                                if (j == open_obj.numb_arry[4]) {
                                    _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data'>" + _each_tr_data.Five[j - 1] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "hmfb": //号码分布
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            var _length = _each_tr_data.Fen.length == undefined ? 10 : _each_tr_data.Fen.length;
                            for (var j = 0 ; j < _length ; j++) {
                                if (_length == 11) {
                                    var _Boll_in_arry = this.check_Number_inArry(j + 1, open_obj.numb_arry);
                                    if (_Boll_in_arry.state) {
                                        _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Fen[j] + "' class='ball-noraml openNo-" + _Boll_in_arry.number + "'>" + (Number(j) + 1) + "</i></td>";
                                    }
                                    else {
                                        _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Fen[j] + "' class='ball-noraml  miss_data'>" + _each_tr_data.Fen[j] + "</i></td>";
                                    }
                                }
                                else {
                                    var _Boll_in_arry = this.check_Number_inArry(j, open_obj.numb_arry);
                                    if (_Boll_in_arry.state) {
                                        _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Fen[j] + "' class='ball-noraml openNo-" + _Boll_in_arry.number + "'>" + j + "</i></td>";
                                    }
                                    else {
                                        _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.Fen[j] + "' class='ball-noraml miss_data'>" + _each_tr_data.Fen[j] + "</i></td>";
                                    }
                                }

                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "haomakuadu": //号码跨度
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) {
                                //获取球是否在开奖号码
                                if (j == open_obj.kuadu) {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.KuaDu[j] + "' class='ball-noraml openNo-2'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.KuaDu[j] + "' class='ball-noraml miss_data'>" + _each_tr_data.KuaDu[j] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "daxiaobi": //大小比"","danshuangbi","zhihebi","hezhi"
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (open_obj.Proportion_size == "5:0") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DaXiaoBi + '" class="ball-noraml" style="background-color:#7999F3; color:#fff;">5:0</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DaXiaoBi + '" class="ball-noraml miss_data">' + _each_tr_data.DaXiaoBi[0] + '</i></td>';
                            }
                            if (open_obj.Proportion_size == "4:1") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DaXiaoBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">4:1</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DaXiaoBi + '"  class="ball-noraml miss_data">' + _each_tr_data.DaXiaoBi[1] + '</i></td>';
                            }

                            if (open_obj.Proportion_size == "3:2") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DaXiaoBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">3:2</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DaXiaoBi + '"  class="ball-noraml miss_data">' + _each_tr_data.DaXiaoBi[2] + '</i></td>';
                            }

                            if (open_obj.Proportion_size == "2:3") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DaXiaoBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">2:3</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DaXiaoBi + '"  class="ball-noraml miss_data">' + _each_tr_data.DaXiaoBi[3] + '</i></td>';
                            }
                            if (open_obj.Proportion_size == "1:4") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DaXiaoBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">1:4</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DaXiaoBi + '"  class="ball-noraml miss_data">' + _each_tr_data.DaXiaoBi[4] + '</i></td>';
                            }

                            if (open_obj.Proportion_size == "0:5") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DaXiaoBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">0:5</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DaXiaoBi + '"  class="ball-noraml miss_data">' + _each_tr_data.DaXiaoBi[5] + '</i></td>';
                            }

                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "danshuangbili": //大小比"","danshuangbi","zhihebi","hezhi"
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';

                            if (open_obj.dashuan_bili == "5:0") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '" class="ball-noraml" style="background-color:#7999F3; color:#fff;">5:0</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '" class="ball-noraml miss_data">' + _each_tr_data.DanShuangBi[0] + '</i></td>';
                            }
                            if (open_obj.dashuan_bili == "4:1") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">4:1</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml miss_data">' + _each_tr_data.DanShuangBi[1] + '</i></td>';
                            }

                            if (open_obj.dashuan_bili == "3:2") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">3:2</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml miss_data">' + _each_tr_data.DanShuangBi[2] + '</i></td>';
                            }

                            if (open_obj.dashuan_bili == "2:3") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">2:3</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml miss_data">' + _each_tr_data.DanShuangBi[3] + '</i></td>';
                            }
                            if (open_obj.dashuan_bili == "1:4") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">1:4</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml miss_data">' + _each_tr_data.DanShuangBi[4] + '</i></td>';
                            }

                            if (open_obj.dashuan_bili == "0:5") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">0:5</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.DanShuangBi + '"  class="ball-noraml miss_data">' + _each_tr_data.DanShuangBi[5] + '</i></td>';
                            }

                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "danshuangbi": //单双比"","danshuangbi","zhihebi","hezhi"  
                            _Child_tdInfos += '<td colspan=\"3\" class="ball-none border-right ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.DanShuang + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">' + open_obj.dashuan_bili + '</i></td>';

                            _keys++;
                            break;
                        case "ZhongWeiShu": //中位数  
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            _Child_tdInfos += '<td class="td-4-1 ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhongWeiShu + '"  class="ball-noraml">' + _each_tr_data.ZhongWeiShu + '</i></td>';
                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "zhihebi": //大小比"","danshuangbi","zhihebi","hezhi"
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            if (open_obj.zhihe_bili == "5:0") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '" class="ball-noraml" style="background-color:#7999F3; color:#fff;">5:0</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '" class="ball-noraml miss_data">' + _each_tr_data.ZhiHeBi[0] + '</i></td>';
                            }
                            if (open_obj.zhihe_bili == "4:1") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">4:1</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml miss_data">' + _each_tr_data.ZhiHeBi[1] + '</i></td>';
                            }

                            if (open_obj.zhihe_bili == "3:2") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">3:2</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml miss_data">' + _each_tr_data.ZhiHeBi[2] + '</i></td>';
                            }

                            if (open_obj.zhihe_bili == "2:3") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">2:3</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml miss_data">' + _each_tr_data.ZhiHeBi[3] + '</i></td>';
                            }
                            if (open_obj.zhihe_bili == "1:4") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">1:4</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml miss_data">' + _each_tr_data.ZhiHeBi[4] + '</i></td>';
                            }

                            if (open_obj.zhihe_bili == "0:5") {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + ' _bili"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml" style="background-color:#7999F3; color:#fff;">0:5</i></td>';
                            }
                            else {
                                _Child_tdInfos += '<td colspan=\"2\" class="ball-none  ' + _border_botton + '"><i data-info="' + _each_tr_data.ZhiHeBi + '"  class="ball-noraml miss_data">' + _each_tr_data.ZhiHeBi[5] + '</i></td>';
                            }

                            _Child_tdInfos += '<td  class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "hezhi": //"danshuangbi","zhihebi","hezhi"
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.HeZhi + "' class='ball-noraml '>" + open_obj.And_value + "</i></td>";
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                            //["hmfb","Size_form","Single_double","Quality_He","012xingtai","zusan","zuliu","baozi","kuadu","And_value","And_value_Ws"]
                        case "Size_form": // 大小形态 
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + open_obj.Size_form.substr(_open_key, 3); +"</i></td>";
                            _keys++;
                            break;
                        case "Single_double": // 单双形态 
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_green  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + open_obj.Single_double.substr(_open_key, 3); +"</i></td>";
                            _keys++;
                            break;
                        case "Quality_He": // 质合形态 
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + open_obj.Quality_He.substr(_open_key, 3); +"</i></td>";
                            _keys++;
                            break;
                        case "012xingtai": // 012形态 
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_green  border-right '  colspan='3' ><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data._012XingTai; +"</i></td>";
                            _keys++;
                            break;
                        case "zusan": // 组三
                            var _is_chonghao = 0;
                            if (_each_tr_data.ZuSan < 0) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " zusan  border-right '  colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml duizi'>&nbsp;</i></td>";
                            }
                            else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " zusan  border-right '  colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.ZuSan + "</i></td>";
                            }
                            _keys++;
                            break;
                        case "zuliu": // 组六 
                            var _is_chonghao = 0;
                            if (_each_tr_data.ZuLiu < 0) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " zusan border-right '  colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml duizi'>&nbsp;</i></td>";
                            }
                            else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " zusan border-right '  colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.ZuLiu + "</i></td>";
                            }
                            _keys++;
                            break;
                        case "baozi": // 012形态 
                            var _is_chonghao = 0;
                            if (_each_tr_data.BaoZi < 0) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " baozi border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml duizi'>&nbsp;</i></td>";
                            }
                            else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " baozi border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.BaoZi + "</i></td>";
                            }
                            _keys++;
                            break;
                        case "kuadu": // 跨度 
                            var _is_chonghao = 0;
                            if (_each_tr_data.KuaDu < 0) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml duizi'>&nbsp;</i></td>";
                            }
                            else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_blue border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.KuaDu + "</i></td>";
                            }
                            _keys++;
                            break;
                        case "kuaduzs": //跨度走势
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                           
                            if (xingshu == "houer") {
                                _open_key = 3;
                            } 
                            if (xingshu == "qianer") {
                                var _Boll_kuadu = Math.abs(open_obj.numb_arry[0] - open_obj.numb_arry[1]);
                            }
                            else {
                                var _Boll_kuadu = Math.abs(open_obj.numb_arry[_open_key] - open_obj.numb_arry[(_open_key + 1)]);
                            }
                            
                            for (var j = 0 ; j < 10 ; j++) {
                                //获取球是否在开奖号码 
                                if (j == _Boll_kuadu) {
                                    _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " openNo-kuadu-td " + _border_botton + "'><i data-info='" + _each_tr_data.KuaDuZouShi[j] + "' class='ball-noraml openNo-kuadu'>" + j + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + _keys + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.KuaDuZouShi[j] + "' class='ball-noraml miss_data'>" + _each_tr_data.KuaDuZouShi[j] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "And_value": // 直选和值 
                            var _is_chonghao = 0;
                            if (_each_tr_data.HeZhi < 0) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_red border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml duizi'>&nbsp;</i></td>";
                            }
                            else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai bgc_red border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.ZhiXuanHeZhi + "</i></td>";
                            }
                            _keys++;
                            break;
                        case "And_value_infos": // 直选和值 
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.ZhiXuanHeZhi + "</i></td>";
                            _keys++;
                            break;
                        case "And_value_Ws": // 直选和值尾数
                            var _is_chonghao = 0;
                            if (_each_tr_data.HeZhi < 0) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml duizi'>&nbsp;</i></td>";
                            }
                            else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " dxxintai  border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.HeZhiWeiShu + "</i></td>";
                            }
                            _keys++;
                            break;
                        /*case "hezhi": //"danshuangbi","zhihebi","hezhi"
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data[i][j] + "' class='ball-noraml '>" + open_obj.And_value + "</i></td>";
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;*/
                        case "duizhi": //"danshuangbi","zhihebi","hezhi" 
                            var _is_chonghao = 0;
                            if (_each_tr_data.DuiZi == -2) {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " baozi border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml duizi'>&nbsp;</i></td>";
                            }
                            else {
                                _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " baozi border-right ' colspan='3'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml'>" + _each_tr_data.DuiZi + "</i></td>";
                            } 
                            _keys++;
                            break;
                        case "_012":	//012路
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data._012._0 + '</i></td>';
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data._012._1 + '</i></td>';
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data._012._2 + '</i></td>';
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            break;
                        case "KuDu":	//跨度	
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            _Child_tdInfos += '<td class="' + _border_botton + '"><i class="ball-noraml hezhixingtai">' + _each_tr_data.KuDu + '</i></td>';
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            break;
                        case "XiaoQu":	//小区
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            for (var j = 1 ; j < 11 ; j++) {
                                var _Boll_in_arry = this.check_Number_inArry(j, open_obj.numb_arry);
                                if (_Boll_in_arry.state) {
                                    if (_Boll_in_arry.number > 1) {
                                        _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " KuaiSan_OpenNo '><i data-info='" + _each_tr_data.XiaoQu[j] + "' class='ball-noraml openNo-0'>" + j + "<em class='chonghao'>" + _Boll_in_arry.number + "</em></i></td>";
                                    }
                                    else {
                                        _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " KuaiSan '><i data-info='" + _each_tr_data.XiaoQu[j] + "' class='ball-noraml hezhizoushi'>" + j + "</i></td>";
                                    }
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.XiaoQu[s] + "' class='ball-noraml miss_data '><i></i>" + _each_tr_data.XiaoQu[s] + "</i></td>";
                                }
                                s++;
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "DaQu":	//大区
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var s = 0;
                            for (var j = 11 ; j < 21 ; j++) {
                                var _Boll_in_arry = this.check_Number_inArry(j, open_obj.numb_arry);
                                if (_Boll_in_arry.state) {
                                    if (_Boll_in_arry.number > 1) {
                                        _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " KuaiSan_OpenNo '><i data-info='" + _each_tr_data.DaQu[j] + "' class='ball-noraml openNo-0'>" + j + "<em class='chonghao'>" + _Boll_in_arry.number + "</em></i></td>";
                                    }
                                    else {
                                        _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + " KuaiSan '><i data-info='" + _each_tr_data.DaQu[j] + "' class='ball-noraml hezhizoushi'>" + j + "</i></td>";
                                    }
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + i + "-" + j + " " + _border_botton + "'><i data-info='" + _each_tr_data.DaQu[s] + "' class='ball-noraml miss_data '><i></i>" + _each_tr_data.DaQu[s] + "</i></td>";
                                }
                                s++;
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "guanjun":	//冠军
                            _Child_tdInfos += '<td class="ball-none ' + _border_botton + '"></td>';
                            var _is_chonghao = 0;
                            for (var j = 0 ; j < 10 ; j++) { 
                                if (_each_tr_data.Fen[j] < 0) {
                                    _Child_tdInfos += "<td class='td-" + 0 + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml openNo'>" + (j + 1) + "</i></td>";
                                }
                                else {
                                    _Child_tdInfos += "<td class='td-" + 0 + "-" + j + " " + _border_botton + "'><i data-info='" + open_obj.numb_arry + "' class='ball-noraml miss_data '>" + _each_tr_data.Fen[j] + "</i></td>";
                                }
                            }
                            _Child_tdInfos += '<td class="ball-none border-right ' + _border_botton + '"></td>';
                            _keys++;
                            break;
                        case "pkjiou":	//pk奇偶   
                            if (_each_tr_data.Ji == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Ji + '><i class="ball-noraml duizi"></i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Ou + '><i class="ball-noraml">' + _each_tr_data.Ou + '</i></td>';
                            }else{
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Ji + '><i class="ball-noraml ">' + _each_tr_data.Ji + '</i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Ou + '><i class="ball-noraml duizi"></i></td>';
                            } 
                            _keys++;
                            break;
                        case "pkdaxiao":	//pk大小
                            if (_each_tr_data.Da == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Da + '><i class="ball-noraml duizi"></i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Xiao + '><i class="ball-noraml">' + _each_tr_data.Xiao + '</i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Da + '><i class="ball-noraml ">' + _each_tr_data.Da + '</i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Xiao + '><i class="ball-noraml duizi"></i></td>';
                            }
                            _keys++;
                            break;
                        case "pkzhihe":	//pk质合
                            if (_each_tr_data.Zhi == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Zhi + '><i class="ball-noraml duizi"></i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.He + '><i class="ball-noraml">' + _each_tr_data.He + '</i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.Zhi + '><i class="ball-noraml ">' + _each_tr_data.Zhi + '</i></td>';
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '" value = ' + _each_tr_data.He + '><i class="ball-noraml duizi"></i></td>';
                            }
                            _keys++;
                            break;
                        case "pk012":	//pk012 
                            if (_each_tr_data._0 == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else { 
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data._0 + '</i></td>';
                            }

                            if (_each_tr_data._1 == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data._1 + '</i></td>';
                            }

                            if (_each_tr_data._2 == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data._2 + '</i></td>';
                            } 
                            _keys++;
                            break;
                        case "pkspj":	//pk升平降
                            if (_each_tr_data.Sheng == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data.Sheng + '</i></td>';
                            }

                            if (_each_tr_data.Ping == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data.Ping + '</i></td>';
                            }

                            if (_each_tr_data.Jiang == -2) {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml duizi"></i></td>';
                            } else {
                                _Child_tdInfos += '<td colspan="3" class="border-right pk10 ' + _border_botton + '"><i class="ball-noraml">' + _each_tr_data.Jiang + '</i></td>';
                            }
                            _keys++;
                            break; 
                        default:
                            break;
                    }
                }
            }
            return _Child_tdInfos;
        },
        //球是否在数组当中,存在的次数
        check_Number_inArry: function (str, arry) {
            var is_inArry = {
                state: false,
                number: 0
            };
            if (arry != undefined && arry.length > 0) {
                for (var i = 0 ; i < arry.length ; i++) {
                    var theValue = parseInt(arry[i]);
                    if (!isNaN(theValue) && str == theValue) {
                        is_inArry.state = true;
                        is_inArry.number = is_inArry.number + 1;
                    }
                }
            }
            return is_inArry;
        },
        //遍历所有的中奖号码，并返回每个中奖号码的位置
        getOpenNo_Arry: function (_Chart_Table, _config_options) {
            // 声明返回的JSON对象
            var _OpenNob = new Array();

            //获取Tbody对象
            var _chartTbody = _Chart_Table.find(".table-guides").eq(0);

            var Tender_Start = 5; 

            for (var i = 0 ; i < Tender_Start ; i++) {
                var _empty_array = [];
                _OpenNob[i] = _empty_array;
            }

            //遍历每一个Tr
            var _Trlength = _chartTbody.find("tr").length;
            if (_Trlength > 0)  //存在Tr
            {
                for (var i = 0 ; i < _Trlength ; i++) {
                    var _Tr_obj = _chartTbody.find("tr").eq(i);
                    var _Tr_obj_childeOpenNob = _Tr_obj.find(".openNo").length; 

                    for (var j = 0 ; j < _Tr_obj_childeOpenNob ; j++) {
                        //当前位数的开奖号码
                        var _FirstOpen_Numb = _Tr_obj.find(".openNo").eq(j);
                        var _Open_Number_obj = {};
                        _Open_Number_obj.value = _FirstOpen_Numb.text();
                        //_Open_Number_obj.Obj = _FirstOpen_Numb;
                        _Open_Number_obj.OffsetX = _FirstOpen_Numb.offset().left;
                        _Open_Number_obj.OffsetY = _FirstOpen_Numb.offset().top;
                        _Open_Number_obj.width = _FirstOpen_Numb.width();
                        
                        if (_Tr_obj_childeOpenNob <= Tender_Start) {
                            _OpenNob[j].push(_Open_Number_obj);
                            //显示走势选项
                            $(".chart_control_cont input[data-action='trend']").parent().show();
                        } else { 
                            //隐藏走势选项
                            $(".chart_control_cont input[data-action='trend']").parent().hide();
                        }
                    }
                }
            }
            return _OpenNob;
        },
        //根据坐标创建线
        CreatCanvasLine: function (OpenNoPos, _config_options) {
            //遍历有多少个星，也就是需要画多少列值 
            var _ContainerObj = $("#" + _config_options.Chart_Container);

            if (_ContainerObj.find(".J-chart-canvas").length > 0) {
                _ContainerObj.empty();
            }
            else {
                //统一创建一个绘制区域以便于管理  
                var _Draw_infos = "<div class='J-chart-canvas' id='J-chart-canvas'></div>";
                _ContainerObj.append($(_Draw_infos));
            }

            var _ChartCanvas_Obj = _ContainerObj.find(".J-chart-canvas").eq(0);

            //获取一共多少列
            var OpenNo_columns = OpenNoPos.length;
            for (var i = 0 ; i < OpenNo_columns ; i++)  //遍历每一列
            {
                var _line_cont = OpenNoPos[i].length == undefined ? 0 : OpenNoPos[i].length;
                //遍历每一列。绘制每一列的画布
                for (var j = 0 ; j < _line_cont ; j++) {

                    if ((j + 1) < _line_cont) {
                        //获取当前的这个点
                        var _this_StartPoint = OpenNoPos[i][j];
                        var _this_NextPoint = OpenNoPos[i][j + 1];
                        this.getCanvasByPoint(_this_StartPoint, _this_NextPoint, _ChartCanvas_Obj, _config_options)
                    }
                }
            }
        },
        //根据坐标创建Point
        getCanvasByPoint: function (start_pos, end_pos, Canvas_cont, _config_options) {
            //获取画布的大小
            var _cavans_w = Math.abs(start_pos.OffsetX - end_pos.OffsetX);
            if (_cavans_w == 0) {
                _cavans_w = 2;
            }
            var _cavans_h = Math.abs(start_pos.OffsetY - end_pos.OffsetY);

            var isIE = /msie/.test(navigator.userAgent.toLowerCase());
            var isCanuserCanvas = true;
            if (isIE) {
                var ua = navigator.userAgent;
                var s = "MSIE";
                var i = ua.indexOf(s)
                var ver = parseFloat(ua.substr(i + s.length));
                if (ver < 9) {
                    isCanuserCanvas = false;
                }
            }

            if (isCanuserCanvas) {
                var _cavans_id = "canvas_" + parseInt(Math.random() * 1000) + "_" + parseInt(Math.random() * 1500);
                var _canvasObj = "<canvas id='" + _cavans_id + "' width='" + _cavans_w + "px' height='" + _cavans_h + "px'></canvas>";
                Canvas_cont.append($(_canvasObj));
                //计算位置
                var theLeft = start_pos.OffsetX < end_pos.OffsetX ? start_pos.OffsetX : end_pos.OffsetX;
                var theTop = start_pos.OffsetY < end_pos.OffsetY ? start_pos.OffsetY : end_pos.OffsetY;

                var _thePointW = end_pos.width / 2;

                $("#" + _cavans_id).css({
                    "left": (theLeft + _thePointW - 1) + "px",
                    "top": (theTop + _thePointW - 2) + "px",
                    "position": "absolute"
                });
                //return CanvasByPoint_Html	 ; 
                var drawline_canvas = document.getElementById(_cavans_id);
                var drawline_obj = drawline_canvas.getContext("2d");

                if (start_pos.OffsetX > end_pos.OffsetX) {
                    saveNum = this.mathNum(_cavans_w, 0, 0, _cavans_h, 7.5);
                } else {
                    saveNum = this.mathNum(0, 0, _cavans_w, _cavans_h, 7.5);
                }

                drawline_obj.beginPath();
                //定义直线的起点坐标为(10,10) 
                drawline_obj.moveTo(saveNum[0], saveNum[1]);
                //定义直线的终点坐标为(50,10)
                drawline_obj.lineTo(saveNum[2], saveNum[3]);
                //线的
                drawline_obj.lineWidth = 2;
                //线条颜色
                drawline_obj.strokeStyle = "red";
                drawline_obj.fill();
                //沿着坐标点顺序的路径绘制直线
                drawline_obj.stroke();
                //关闭当前的绘制路径
                drawline_obj.closePath();
            }
            else  //IE9以下使用SVG
            {
                var _cavans_id = "canvas_" + parseInt(Math.random() * 1000) + "_" + parseInt(Math.random() * 1500);
                if (start_pos.OffsetX > end_pos.OffsetX) {
                    saveNum = this.mathNum(_cavans_w, 0, 0, _cavans_h, 7.5);
                } else {
                    saveNum = this.mathNum(0, 0, _cavans_w, _cavans_h, 7.5);
                }

                var LineStr = "<line x1='" + saveNum[0] + "' y1='" + saveNum[1] + "' x2='" + saveNum[2] + "' y2='" + saveNum[3] + "' style='stroke-width:2;stroke:#333;' />";
                var _canvasObj = "<svg id='" + _cavans_id + "' width='" + _cavans_w + "px' height='" + _cavans_h + "px' version='1.1' xmlns='http://www.w3.org/2000/svg'>" + LineStr + "</svg>";
                Canvas_cont.append($(_canvasObj));
                //计算位置 
                var theLeft = start_pos.OffsetX < end_pos.OffsetX ? start_pos.OffsetX : end_pos.OffsetX;
                var theTop = start_pos.OffsetY < end_pos.OffsetY ? start_pos.OffsetY : end_pos.OffsetY;

                var _thePointW = end_pos.width / 2;
                $("#" + _cavans_id).css({
                    "left": (theLeft + _thePointW - 1) + "px",
                    "top": (theTop + _thePointW - 2) + "px",
                    "position": "absolute"
                });
                //return CanvasByPoint_Html	 ; 
                //var drawline_canvas = document.getElementById(_cavans_id);    
            }
        },
        //计算圆心半径坐标
        mathNum: function (x1, y1, x2, y2, r) {
            var a = x1 - x2,
				b = y1 - y2,
				c = Math.round(Math.sqrt(Math.pow(a, 2) + Math.pow(b, 2))),
				_a = Math.round((a * r) / c),
				_b = Math.round((b * r) / c);
            return [x2 + _a, y2 + _b, x1 - _a, y1 - _b];
        }
    }
    $.extend({ RGarmChart: RGarmChart });
})(jQuery);

