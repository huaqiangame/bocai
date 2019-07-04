<include file="Public/headermember"/>
    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS2__/reset.css">
    <link rel="stylesheet" href="__CSS2__/record.css">
    <link rel="stylesheet" href="__CSS2__/userInfo.css">
    <link rel="stylesheet" href="__CSS2__/betRecordGame.css">
    <script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="__JS__/artDialog.js"></script>
    <script type="text/javascript" src="__JS__/iconfont.js"></script><!--后加的-->
    <script type="text/javascript" src="__JS__/usercommon.js"></script><!--后加的-->

    <script>
        var ISLOGIN = "{$userinfo.id}";
    </script>
    <script src="__JS__/index.js"></script>

<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
    <include file="Member/side"/>
    <div class="pull-right vip_info_pan" >
        <div class="vip_info_title">
            游戏记录
        </div>
        <div class="vip_info_content recharge_main">
		<div class="record" data-url="game" style="display: block;">
                <form action="">
                <div class="record-filter">
                    <div class="filter-row has-border">
                        <div class="filter-item">
                            <label>投注日期：</label>
                            <div class="inputtxt">
                            <span class="date-icon">
                               <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-rili1"></use>
                                </svg>
                            </span>
                                <input class="date" type="date" id="gamestarttime" name="gamestarttime"
                                       placeholder="开始时间" value="">
                            </div>
                        </div>
                        <span class="has-space">-</span>
                        <div class="filter-item">
                            <div class="inputtxt">
                            <span class="date-icon">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-rili1"></use>
                                </svg>
                            </span>
                                <input class="date" type="date" id="gameendtime" name="gameendtime" placeholder="结束时间"
                                       value="">
                            </div>

                        </div>
                    </div>
                    <div class="filter-row">
                        <div class="filter-item">
                            <label for="roundnum">游戏类型：</label>
                            <div class="inputtxt">
                                <select class="search-select" id="searchgame" name="searchgame">
                                    <option value="">请选择</option>
                                    <option value="MG">AG投注记录</option>
                                    <option value="AG">BBIN投注记录</option>
                                    <option value="BBIN">PT投注记录</option>
                                    <option value="GB">MG投注记录</option>
                                    <option value="KY">MW投注记录</option>
                                    <option value="VR">LLBET投注记录</option>
                                    <option value="MW">OG投注记录</option>
                                    <option value="PT">CQ投注记录</option>
                                    <option value="ALLBET">KY投注记录</option>
                                    <option value="SUNBET">VR投注记录</option>
                                    <option value="SANS">SANS投注记录</option>
                                    <option value="OG">BB投注记录</option>
                                </select>
                            </div>
                        </div>
                        <span class="has-space"></span>
                        <div class="filter-item">
                            <div class="inputtxt">
                                <input type="text" name="roundnum" id="roundnum" placeholder="局号" maxlength="16">
                            </div>
                            <button -id="listgame" type="submit" class="seachbtn" ripple="" style="overflow: hidden; position: relative;">搜&nbsp;&nbsp;&nbsp;&nbsp;索</button>
                        </div>
                    </div>
                </div>
                    </form>
                <div class="tablelist record-datalist has-top" id="tzlist">

                    <table class="recordtable" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th>订单号</th>
                            <th>局号</th>
                            <th>下注时间</th>
                            <th>游戏类型</th>
                            <th>下注金额</th>
                            <th>有效金额</th>
                            <th>损益</th>
<!--                            <th>备注</th>-->
                        </tr>
                        </thead>
                        <tbody id="tzjl">
                        <volist name="gamelist" id="vo">
                            <tr>
                                <td>{$vo.BillNo}</td>
                                <td>{$vo.GameCode}</td>
                                <td>{$vo.BetTime}</td>
                                <td>{$vo.GameType}</td>
                                <td>{$vo.BetAmount}</td>
                                <td>{$vo.ValidBetAmount}</td>
                                <td>{$vo.NetAmount}</td>
                            </tr>
                        </volist>
<!--                        <tr>-->
<!--                            <td colspan="30">暂无数据</td>-->
<!--                        </tr>-->
                        </tbody>
                    </table>
                </div>
                <div class="record-count">
                    <div class="count-item">
                        <span class="tit">总有效投注额：</span>
                        <span class="val" id="youxiaotouzhu">￥{$ValidBetAmount}</span>
                    </div>
                    <div class="count-item">
                        <span class="tit">总损益：</span>
                        <span class="val negative" id="sunyi">￥{$NetAmount}</span>
                    </div>
                </div>
            </div>

            <div class="page" id="page">{$pageshow}</div>
            <div class="prompt">
                <i class="iconfont">&#xe659;</i>
                温馨提示：投注记录最多只保留7天。
            </div>
        </div>
        <!-- 如果没有查到就显示这个 -->
        <div class="no_result" style="display:none;">
            暂无记录
        </div>
        <!--				<ul class="pagination bet_paging">
                            <li><a href="">上一页</a></li>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href="">下一页</a></li>
                            <li><a href="">共 <em class="color_res">0</em> 页</a></li>
                        </ul>-->

    </div>


</div>
</div>
</div>
<include file="Public/footer"/>

<div class="modal fade ytz_model" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">投注内容</h4>
            </div>
            <div class="modal-body" style="word-wrap:break-word ;">
                ----
            </div>
        </div>
    </div>
</div>

<script>
    function chaxun(t, s) {
        var name = $("#lottery_code").val();
        /*var qihao=$("#qihao_code").val();*/
        if (t) {
            var atime = t;
        } else {
            var atime = $('#time-box span.active').attr('value');
        }
        if (s) {
            var a_item = s;
        } else {
            var a_item = $('#status-box span.active').attr('value');
        }
        var url = '__ROOT__' + "/Member.betRecord.name." + name + ".atime." + atime + ".a_item." + a_item;
        window.location.href = url;
    }

    /*	function chexun() {
            alert();
        }*/
</script>
<script type="text/javascript">
    function getpage() {
        var weburl = location.hash;
        weburl = weburl.replace('#', '');
        $("#myRecord li").removeClass("active");
        $("#myRecord li[data-url='" + weburl + "']").addClass("active");
        $(".tabmenu a").removeClass("active");
        $(".tabmenu a[data-url='" + weburl + "']").addClass("active");
        $(".record").hide();
        $(".record[data-url='" + weburl + "']").show();
    }

    $(window).on("hashchange", function () {//兼容ie8+和手机端
        getpage();
    });
    $(function () {
        getpage();
    })
</script>
<script src="__JS__/dropload.js"></script><!--后加的-->
<script type="text/javascript">

    $("#listgame").click(function () {
        var parameter;
        var parameter2;
        var key;
        parameter = {
            k: key
        };
        parameter2 = {
            k: key
        };
        $('#tzjl').html("");
        LoadAll(parameter);
    })

    $("#cashlist").click(function () {
        var parameter;
        var parameter2;
        var key;
        parameter = {
            k: key
        };
        parameter2 = {
            k: key
        };
        $('#jyjl').html("");
        LoadAll2(parameter2);
    })

    function LoadAll(parameter) {
        $("#youxiaotouzhu").html("￥0.00");
        $("#sunyi").html("￥0.00");
        var searchgame = $("#searchgame").val();
        var roundnum = $("#roundnum").val();
        var starttime = $("#gamestarttime").val();
        var endtime = $("#gameendtime").val();
        var flag = 0;
        var page = 0;
        var size = 20;
        $("#tzlist").dropload({
            scrollArea: window,
            domDown: {                                                          // 下方DOM
                domClass: 'dropload-down',
                domRefresh: '<div class="dropload-refresh">↑上拉加载更多</div>',
                domLoad: '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
                domNoData: '<div class="dropload-noData">——已经到底了——</div>'
            },
            loadDownFn: function (me) {
                page++;
                parameter.pageindex = page;
                parameter.pagecount = size;
                parameter.searchgame = searchgame;
                parameter.roundnum = roundnum;
                parameter.starttime = starttime;
                parameter.endtime = endtime;
                var htmls = "";
                $.ajax({
                    url: "/Common/Record?uid=1407843FCB2B527AA4559385&LoadFun=game",
                    type: "POST",
                    data: parameter,
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.Code == 0) {
                            $(".dropload-load").remove();
                            return;
                        }
                        else {
                            var htmls = "";
                            if (data.Code == 1 && data.Msg.ResultList.length > 0) {
                                var Data = data.Msg.ResultList;
                                for (var i = 0; i < Data.length; i++) {
                                    htmls += '<tr>';
                                    htmls += '<td>' + Data[i].billNo + '</td>';
                                    htmls += '<td>' + Data[i].betTime + '</td>';
                                    htmls += '<td>' + Data[i].gameType + '</td>';
                                    htmls += '<td>' + Data[i].betAmount + '</td>';
                                    htmls += '<td>' + Data[i].validBetAmount + '</td>';
                                    htmls += '<td>' + Data[i].netAmount + '</td>';
                                    htmls += '<td>' + Data[i].remark + '</td>';
                                    htmls += '</tr>';
                                }
                                $("#youxiaotouzhu").html("￥" + data.Msg.GameTotal.ValidBetAmount);
                                var syi = data.Msg.GameTotal.Payout;
                                if (syi >= 0) {
                                    $("#sunyi").removeClass("negative");
                                    $("#sunyi").removeClass("positive");
                                    $("#sunyi").addClass("positive");
                                } else {
                                    $("#sunyi").removeClass("positive");
                                    $("#sunyi").removeClass("negative");
                                    $("#sunyi").addClass("negative");
                                }
                                $("#sunyi").html("￥" + data.Msg.GameTotal.Payout);
                            }
                            else {
                                htmls += '<tr>';
                                htmls += '<td colspan="30">暂无数据</td>';
                                htmls += '</tr>';
                                $("#youxiaotouzhu").html("￥" + data.Msg.GameTotal.ValidBetAmount);
                                var syi = data.Msg.GameTotal.Payout;
                                if (syi >= 0) {
                                    $("#sunyi").removeClass("negative");
                                    $("#sunyi").removeClass("positive");
                                    $("#sunyi").addClass("positive");
                                } else {
                                    $("#sunyi").removeClass("positive");
                                    $("#sunyi").removeClass("negative");
                                    $("#sunyi").addClass("negative");
                                }
                                $("#sunyi").html("￥" + data.Msg.GameTotal.Payout);
                                me.lock();
                                me.noData();
                            }
                        }
                        setTimeout(function () {
                            $("#tzjl").append(htmls);
                            me.resetload();

                        }, 1000);
                    },
                    error: function (xhr, type) {
                        me.lock();
                        me.noData();
                        me.resetload();
                    }
                });
            },
        });
    }

    function SubmitLoad() {
        var jh = $("#roundnum").val();
        var gn = $('.searchgame option:selected').text();
        var start = $("#gamestarttime").val();
        var end = $("#gameendtime").val();
        if (start != "" && end != "") {
            $("#tzjl").html("");
            start += "T00:00:00";
            end += "T23:59:59";
            parameter = {
                k: key,
                jh: jh,
                gn: gn,
                startTime: start,
                endTime: end,
            };
            LoadAll(parameter);
        }
        else {
            if (start == "") {
                _alert("请选择开始时间!")
            }
            if (end == "") {
                _alert("请选择结束时间!")
            }
        }
    }

    function LoadAll2(parameter2) {
        var searchcash = $("#searchcash").val();
        var startime = $("#tradestarttime").val();
        var entime = $("#tradeendtime").val();
        var flag = 0;
        var page = 0;
        var size = 20;
        $("#jyjl").html("");
        $("#jylist").dropload({
            scrollArea: window,

            domDown: {                                                          // 下方DOM
                domClass: 'dropload-down',
                domRefresh: '<div class="dropload-refresh">↑上拉加载更多</div>',
                domLoad: '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
                domNoData: '<div class="dropload-noData">——已经到底了——</div>'
            },

            loadDownFn: function (me) {
                page++;
                parameter2.searchcash = searchcash;
                parameter2.startime = startime;
                parameter2.entime = entime;
                parameter2.pageindex = page;
                parameter2.pagecount = size;
                var htmls = "";
                $.ajax({
                    url: "/Common/Record?uid=1407843FCB2B527AA4559385&LoadFun=trade",
                    type: "POST",
                    data: parameter2,
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.Code == 0) {
                            $(document).dialog({
                                type: 'notice',
                                infoText: data.Msg,
                                autoClose: 1500,
                                position: 'center'  // center: 居中; bottom: 底部
                            });
                            $(".dropload-load").remove();
                            return;
                        }
                        else {
                            var htmls = "";
                            if (data.Code == 1 && data.Msg.Data.length > 0) {
                                var Data = data.Msg.Data;
                                for (var i = 0; i < Data.length; i++) {
                                    htmls += '<tr>';
                                    htmls += '<td>' + Data[i].Oid + '</td>';
                                    htmls += '<td>' + Data[i].ProcessingTime + '</td>';
                                    htmls += '<td>' + Data[i].ActionTypeStr + '</td>';
                                    if (Data[i].ActionMoney == null) {
                                        Data[i].ActionMoney = 0;
                                    }
                                    htmls += '<td>' + Data[i].ActionMoney + '</td>';
                                    if (Data[i].vSpMoney == null) {
                                        Data[i].vSpMoney = 0;
                                    }
                                    htmls += '<td>' + Data[i].vSpMoney + '</td>';
                                    htmls += '<td>' + Data[i].NewBalance + '</td>';
                                    if (Data[i].remark == null) {
                                        Data[i].remark = "";
                                    }
                                    htmls += '<td>' + Data[i].remark + '</td>';
                                }
                                if (data.Msg.Total.ActionMoneyTotal == null) {
                                    $("#jiaoyiedu").html("￥0.00");
                                }
                                else {
                                    $("#jiaoyiedu").html("￥" + data.Msg.Total.ActionMoneyTotal);
                                }
                                if (data.Msg.Total.ActionMoneyTotal == null) {
                                    $("#youhuiedu").html("￥0.00");
                                }
                                else {
                                    $("#youhuiedu").html("￥" + data.Msg.Total.vSpMoneyTotal);
                                }
                            }
                            else {
                                if (data.Msg.Total.ActionMoneyTotal == null) {
                                    $("#jiaoyiedu").html("￥0.00");
                                }
                                else {
                                    $("#jiaoyiedu").html("￥" + data.Msg.Total.ActionMoneyTotal);
                                }
                                if (data.Msg.Total.ActionMoneyTotal == null) {
                                    $("#youhuiedu").html("￥0.00");
                                }
                                else {
                                    $("#youhuiedu").html("￥" + data.Msg.Total.vSpMoneyTotal);
                                }
                                me.lock();
                                me.noData();
                            }
                        }
                        setTimeout(function () {
                            $("#jyjl").append(htmls);
                            me.resetload();
                        }, 1000);
                    },
                    error: function (xhr, type) {
                        me.lock();
                        me.noData();
                        me.resetload();
                    }
                });
            },
        });
    }

    function SubmitLoad2() {
        var gn = $('.searchgame option:selected').text();
        var start = $("#tradestarttime").val();
        var end = $("#tradeendtime").val();
        if (start != "" && end != "") {
            $("#jyjl").html("");
            start += "T00:00:00";
            end += "T23:59:59";
            parameter2 = {
                k: key,
                gn: gn,
                startTime: start,
                endTime: end,
            };
            LoadAll2(parameter2);
        }
        else {
            if (start == "") {
                _alert("请选择开始时间!")
            }
            if (end == "") {
                _alert("请选择结束时间!")
            }
        }
    }
</script>
</body>
</html>