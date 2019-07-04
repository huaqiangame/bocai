$( document ).ready(function() {
    drawLine();

    //視窗變動重新計算畫線
    $(window).resize(function() {
        drawLine();
    });


    function drawLine(){
        var _Chart_Table = $("#J-chart-area");
        if (_Chart_Table.find("table").size() > 0) {
            var _get_table_No = getOpenNo_Arry(_Chart_Table);		//遍历所有的中奖号码，并返回每个中奖号码的位置  位置相对body整体

            if (_get_table_No != null && _get_table_No.length > 0) {
                //绘制曲线
                CreatCanvasLine(_get_table_No);
            }
        }


    }




    //遍历所有的中奖号码，并返回每个中奖号码的位置
    function getOpenNo_Arry(_Chart_Table) {

        // 声明返回的JSON对象
        var _OpenNob = new Array();

        //获取Tbody对象
        var _chartTbody = _Chart_Table.find(".table-guides").eq(0);

        //var Tender_Start = 5;
        var Tender_Start = 10;

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
    }

    //根据坐标创建线
    function CreatCanvasLine  (OpenNoPos) {

        //遍历有多少个星，也就是需要画多少列值
        var _ContainerObj = $("#J-chart-area");

        if (_ContainerObj.find(".J-chart-canvas").length > 0) {
            //_ContainerObj.empty(); //判斷曲線已經存在就清除資料
        }
        //else {
        //统一创建一个绘制区域以便于管理
        $("#J-chart-canvas").remove();
        var _Draw_infos = "<div class='J-chart-canvas' id='J-chart-canvas'></div>";
        _ContainerObj.append($(_Draw_infos));

        //}

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
                    getCanvasByPoint(_this_StartPoint, _this_NextPoint, _ChartCanvas_Obj)
                }
            }
        }
    }



    //根据坐标创建Point
    function getCanvasByPoint  (start_pos, end_pos, Canvas_cont) {

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
                saveNum = mathNum(_cavans_w, 0, 0, _cavans_h, 7.5);
            } else {
                saveNum = mathNum(0, 0, _cavans_w, _cavans_h, 7.5);
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
                saveNum = mathNum(_cavans_w, 0, 0, _cavans_h, 7.5);
            } else {
                saveNum = mathNum(0, 0, _cavans_w, _cavans_h, 7.5);
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
    }

    //计算圆心半径坐标
    function mathNum (x1, y1, x2, y2, r) {
        var a = x1 - x2,
            b = y1 - y2,
            c = Math.round(Math.sqrt(Math.pow(a, 2) + Math.pow(b, 2))),
            _a = Math.round((a * r) / c),
            _b = Math.round((b * r) / c);
        return [x2 + _a, y2 + _b, x1 - _a, y1 - _b];
    }

    //辅助线
    //遍历每一个Tr
    var _Trlength =  $("#J-chart-content").find("tr").length;
    //有統計資料的行數
    var summaryLint =  $("#J-chart-content").find("tr.border-bottom").length;
    _Trlength = _Trlength - summaryLint;
    for (var i = 0 ; i < _Trlength ; i++ ){

        if((i % 5) == 0){
            $("#J-chart-content tr:nth-child("+i+") td").addClass('border-bottom');
        }
    }
    //最底下的資料也補上底線
    $("#J-chart-content tr:nth-child("+(_Trlength)+") td").addClass('border-bottom');




});