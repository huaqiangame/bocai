<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>{:GetVar('webtitle')}</title>
    <meta name="keywords" content="{:GetVar('keywords')}"/>
    <meta name="description" content="{:GetVar('description')}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS2__/reset.css">
    <link rel="stylesheet" href="__CSS2__/icon.css">
    <link rel="stylesheet" href="__CSS2__/header.css">
    <link rel="stylesheet" href="__CSS2__/record.css">
    <link rel="stylesheet" href="__CSS2__/userInfo.css">
    <link rel="stylesheet" href="__CSS2__/footer.css">
    <link rel="stylesheet" href="__CSS2__/betRecordGame.css">
    <link rel="stylesheet" href="__JS2__/layer/skin/default/layer.css">
    <script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="__JS__/artDialog.js"></script>
    <script type="text/javascript" src="__JS__/iconfont.js"></script><!--后加的-->
    <script type="text/javascript" src="__JS__/usercommon.js"></script><!--后加的-->

    <script>
        var ISLOGIN = "{$userinfo.id}";
    </script>
    <script src="__JS__/index.js"></script>
</head>
<body>
<include file="Public/headermember"/>
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
    <include file="Member/side"/>
    <div class="pull-right vip_info_pan" >
        <div class="vip_info_title">
            参与活动记录
        </div>
        <?php $status = [1=>'待审核',2=>'审核通过',3=>'审核不通过']?>
        <div class="vip_info_content recharge_main">
            <div class="record" data-url="game" style="display: block;">
                <div class="tablelist record-datalist has-top" id="tzlist">

                    <table class="recordtable" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th>活动名称</th>
                            <th>审核状态</th>
                            <th>备注</th>
                            <th>参与时间</th>
                        </tr>
                        </thead>
                        <tbody id="tzjl">
                        <volist name="data" id="vo">
                            <tr>
                                <td>{$vo.title}</td>
                                <td>{$status[$vo['status']]}</td>
                                <td>{$vo.fail_reason}</td>
                                <td>{$vo.created_at}</td>
                            </tr>
                        </volist>
                        <!--                        <tr>-->
                        <!--                            <td colspan="30">暂无数据</td>-->
                        <!--                        </tr>-->
                        </tbody>
                    </table>
                </div>
<!--                <div class="record-count">-->
<!--                    <div class="count-item">-->
<!--                        <span class="tit">总有效投注额：</span>-->
<!--                        <span class="val" id="youxiaotouzhu">￥{$ValidBetAmount}</span>-->
<!--                    </div>-->
<!--                    <div class="count-item">-->
<!--                        <span class="tit">总损益：</span>-->
<!--                        <span class="val negative" id="sunyi">￥{$NetAmount}</span>-->
<!--                    </div>-->
<!--                </div>-->
            </div>

            <div class="page" id="page">{$pageshow}</div>

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


</script>
</body>
</html>