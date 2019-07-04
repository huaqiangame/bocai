var parameter;
var parameter2;
var key;
/*var mySwiper = new Swiper('.AppMain-activitytab .swiper-container', {
    freeMode: true,
    freeModeMomentumRatio: 0.5,
    slidesPerView: 'auto',

});*/
var vrcount = 0;
function vipreturn() {
    vrcount++;
    if (vrcount > 2) {
        alert("请勿频繁点击，10秒后再试");
    } else {
        userid = $("#userid").val();
        var companystyle = $("#companystyle").val();
        if (userid == null || userid == "") {
            alert("您尚未登录，请先登录后再进行游戏");
            return false;
        } else {
            if (companystyle == null || companystyle == "") {
                alert("您尚未登录，请先登录后再进行游戏");
                return false;
            } else {
                $.ajax({
                    url: "/Common/VipReturn",
                    data: { CompanyStyle: companystyle, uid: userid },
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        if (data.Code == 1) {
                            alert(data.Msg);
                        }
                        else {
                            alert(data.Msg);
                        }
                        setTimeout(function () {
                            vrcount = 0;
                        }, 10000);
                    }
                });
            }
        }

    }
}
function RefreshBalance() {
    $.getJSON("/Common/RefreshBalance?BalanceType=sys&uid=539466CA3EC14C43A4558228&n=" + Math.random(), function (json) {
        ReSetBalance(json);
    });
}
function ReSetBalance(str) {
    if (str != -2) {
        $(".balance").html("余额：" + str.toFixed(2));
    } else {
        $(".balance").html("刷新失败");
    }
}

$(function () {
    var weburl = location.hash.replace("#", "");
    if (weburl != "") {
        $(".AppList-tab a").removeClass('active');
        $(".AppList-tab a[data-url=" + weburl + "]").addClass('active');
        $(".AppList-container .AppList-item").hide();
        $(".AppList-container .AppList-item[data-url=" + weburl + "]").css("display", "block");
    }
    $(".AppList-tab a").each(function (i) {
        $(this).click(function () {
            $(".AppList-container .AppList-item").hide();
            $(".AppList-container .AppList-item").eq(i).css("display", "block");
            $(".AppList-tab a").removeClass('active');
            $(this).addClass('active');
        });
    });
    $("#tzjl .AppList-list dl").each(function () {
        var flag = 0;
        $(this).find("dt").click(function (e) {
            e.preventDefault();
            if (flag == 0) {
                $(this).find(".up").css("display", "block");
                $(this).find(".down").hide();
                $(this).next().show();
                flag = 1;
            } else {
                $(this).find(".down").css("display", "block");
                $(this).find(".up").hide();
                $(this).next().hide();
                flag = 0;
            }
        });
    });
    $("#jyjl .AppList-list dl").each(function () {
        var flag = 0;
        $(this).find("dt").click(function (e) {
            e.preventDefault();
            if (flag == 0) {
                $(this).find(".up").css("display", "block");
                $(this).find(".down").hide();
                $(this).next().show();
                flag = 1;
            } else {
                $(this).find(".down").css("display", "block");
                $(this).find(".up").hide();
                $(this).next().hide();
                flag = 0;
            }
        });
    });
    parameter = {
        k: key
    };
    parameter2 = {
        k: key
    };

    $(".my-icon").click(function () {
        $(".AppSidebar").css("right", "0");
        $(".AppMask").fadeIn(300);
    });
    $(".AppMask,.close-icon").click(function () {
        $(".AppSidebar").css("right", "-240px");
        $(".AppMask").fadeOut(300);
    });
});
$("#listgame").click(function () {
    var parameter;
    var parameter2;
    parameter = {
        k: key
    };
    parameter2 = {
        k: key
    };
    $('#tzjl .AppList-list').html("");
    LoadAll(parameter);
})

$("#cashlist").click(function () {
    var parameter;
    var parameter2;
    parameter = {
        k: key
    };
    parameter2 = {
        k: key
    };
    $('#tzjl .AppList-list').html("");
    LoadAll2(parameter2);
})
function LoadAll(parameter) {
    var searchgame = $("#searchgame").val();
    var roundnum = $("#roundnum").val();
    var starttime = $("#gamestarttime").val();
    var endtime = $("#gameendtime").val();
    var flag = 0;
    var page = 0;
    var size = 20;
    $('.AppList-warp').dropload({
        scrollArea: window,
        domUp: {                                                            // 上方DOM
            domClass: 'dropload-up',
            domRefresh: '<div class="dropload-refresh">↓下拉刷新</div>',
            domUpdate: '<div class="dropload-update">↑释放更新</div>',
            domLoad: '<div class="dropload-load"><span class="loading"></span>更新中...</div>'
        },
        domDown: {                                                          // 下方DOM
            domClass: 'dropload-down',
            domRefresh: '<div class="dropload-refresh">↑上拉加载更多</div>',
            domLoad: '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
            domNoData: '<div class="dropload-noData">——已经到底了——</div>'
        },
        loadUpFn: function (me) {
            page = 1;
            parameter.pageindex = page;
            parameter.pagecount = size;
            parameter.searchgame = searchgame;
            parameter.roundnum = roundnum;
            parameter.starttime = starttime;
            parameter.endtime = endtime;
            var htmls = "";
            $.ajax({
                url: "/Member.tz.do?LoadFun=game",
                type: "POST",
                data: parameter,
                dataType: 'JSON',
                success: function (data) {
                    if (data.Code == 0) {
                        $(document).dialog({
                            type: 'notice',
                            infoText: data.Msg,
                            autoClose: 1500,
                            position: 'center'  // center: 居中; bottom: 底部
                        });
                        return;
                    }
                    else
                    {
                        var htmls = "";
                        if (data.Code == 1 && data.Msg.ResultList.length > 0) {
                            var Data = data.Msg.ResultList;
                            for (var i = 0; i < Data.length; i++) {
                                htmls += '<dl><dt><div class="listinfo"><div class="listinfo-row"><div class="listinfo-item">';
                                htmls += '<span class="listinfo-title">' + Data[i].gameType +'</span>';
                                htmls += '</div><div class="listinfo-item">';
                                htmls += '<span class="listinfo-date">' + Data[i].betTime + '</span>';
                                htmls += '</div></div><div class="listinfo-row"><div class="listinfo-item">';
                                htmls += '<span class="betmoney">投注额：</span>';
                                htmls += '<span class="money">￥' + Data[i].betAmount + '</span>';
                                htmls += '</div><div class="listinfo-item"><span class="sendmoney">损益：</span>';
                                htmls += '<span class="money">￥' + Data[i].netAmount + '</span>';
                                htmls += '</div>';
                                htmls += '</div></div><div class="listicon">';
                                htmls += '<span class="down" style="display: block;"><svg class="icon" aria-hidden="true">';
                                htmls += '<use xlink:href="#icon-arrow-right-copy-copy-copy"></use></svg></span>';
                                htmls += '<span class="up"><svg class="icon" aria-hidden="true">';
                                htmls += '<use xlink:href="#icon-arrow-right-copy-copy-copy"></use></svg></span>';
                                htmls += '</div></dt>';
                                htmls += '<dd><div class="detailsinfo"><h3>记录详情</h3><ul class="ddnr">';
                                htmls += '<li><span class="grey">注单号</span><span class="grey">' + Data[i].billNo + '</span></li>';
                                htmls += '<li><span class="grey">时间</span><span class="grey">' + Data[i].betTime + '</span></li>';
                                htmls += '<li><span class="grey">游戏名称</span><span class="grey">' + Data[i].gameType + '</span></li>';
                                htmls += '<li><span class="grey">投注金额</span><span class="grey">' + Data[i].betAmount + '</span></li>';
                                htmls += '<li><span class="grey">有效投注</span><span class="grey">' + Data[i].validBetAmount + '</span></li>';
                                htmls += '<li><span class="grey">损益</span><span class="grey">' + Data[i].netAmount + '</span></li>';
                                if (Data[i].remark == null) {
                                    Data[i].remark = "";
                                }
                                htmls += '<li><span class="grey">备注</span><span class="grey">' + Data[i].remark + '</span></li>';
                                htmls += '</ul></div></dd></dl>';
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
                        else
                        {
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
                        $('#tzjl .AppList-list').html(htmls);
                        $("#tzjl .AppList-list dl").each(function () {
                            var flag = 0;
                            $(this).find("dt").click(function (e) {
                                e.preventDefault();
                                if (flag == 0) {
                                    $(this).find(".up").css("display", "block");;
                                    $(this).find(".down").hide();
                                    $(this).next().show();
                                    flag = 1;
                                } else {
                                    $(this).find(".down").css("display", "block");
                                    $(this).find(".up").hide();
                                    $(this).next().hide();
                                    flag = 0;
                                }
                            });
                        });
                        me.resetload();
                        page = 1;
                        me.unlock();
                        me.noData(false);
                        click(me);
                    }, 1000);
                },
                error: function (xhr, type) {
                    me.lock();
                    me.noData();
                    me.resetload();
                }
            });
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
                url: "/Common/Record?uid=539466CA3EC14C43A4558228&LoadFun=game",
                type: "POST",
                data: parameter,
                dataType: 'JSON',
                success: function (data) {
                    if (data.Code == 0) {
                        $(document).dialog({
                            type: 'notice',
                            infoText: data.Msg,
                            autoClose: 1500,
                            position: 'center'  // center: 居中; bottom: 底部
                        });
                        return;
                    }
                    else
                    {
                        var htmls = "";
                        if (data.Code == 1 && data.Msg.ResultList.length > 0) {
                            var Data = data.Msg.ResultList;
                            for (var i = 0; i < Data.length; i++) {
                                htmls += '<dl><dt><div class="listinfo"><div class="listinfo-row"><div class="listinfo-item">';
                                htmls += '<span class="listinfo-title">' + Data[i].gameType +'</span>';
                                htmls += '</div><div class="listinfo-item">';
                                htmls += '<span class="listinfo-date">' + Data[i].betTime + '</span>';
                                htmls += '</div></div><div class="listinfo-row"><div class="listinfo-item">';
                                htmls += '<span class="betmoney">投注额：</span>';
                                htmls += '<span class="money">￥' + Data[i].betAmount + '</span>';
                                htmls += '</div><div class="listinfo-item"><span class="sendmoney">损益：</span>';
                                htmls += '<span class="money">￥' + Data[i].netAmount + '</span>';
                                htmls += '</div>';
                                htmls += '</div></div><div class="listicon">';
                                htmls += '<span class="down" style="display: block;"><svg class="icon" aria-hidden="true">';
                                htmls += '<use xlink:href="#icon-arrow-right-copy-copy-copy"></use></svg></span>';
                                htmls += '<span class="up"><svg class="icon" aria-hidden="true">';
                                htmls += '<use xlink:href="#icon-arrow-right-copy-copy-copy"></use></svg></span>';
                                htmls += '</div></dt>';
                                htmls += '<dd><div class="detailsinfo"><h3>记录详情</h3><ul class="ddnr">';
                                htmls += '<li><span class="grey">注单号</span><span class="grey">' + Data[i].billNo + '</span></li>';
                                htmls += '<li><span class="grey">时间</span><span class="grey">' + Data[i].betTime + '</span></li>';
                                htmls += '<li><span class="grey">游戏名称</span><span class="grey">' + Data[i].gameType + '</span></li>';
                                htmls += '<li><span class="grey">投注金额</span><span class="grey">' + Data[i].betAmount + '</span></li>';
                                htmls += '<li><span class="grey">有效投注</span><span class="grey">' + Data[i].validBetAmount + '</span></li>';
                                htmls += '<li><span class="grey">损益</span><span class="grey">' + Data[i].netAmount + '</span></li>';
                                if (Data[i].remark == null) {
                                    Data[i].remark = "";
                                }
                                htmls += '<li><span class="grey">备注</span><span class="grey">' + Data[i].remark + '</span></li>';
                                htmls += '</ul></div></dd></dl>';
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
                        else
                        {
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
                        $('#tzjl .AppList-list').append(htmls);
                        $("#tzjl .AppList-list dl").each(function () {
                            var flag = 0;
                            $(this).find("dt").click(function (e) {
                                e.preventDefault();
                                if (flag == 0) {
                                    $(this).find(".up").css("display", "block");;
                                    $(this).find(".down").hide();
                                    $(this).next().show();
                                    flag = 1;
                                } else {
                                    $(this).find(".down").css("display", "block");
                                    $(this).find(".up").hide();
                                    $(this).next().hide();
                                    flag = 0;
                                }
                            });
                        });
                        me.resetload();
                        click(me);
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
        $('#tzjl .AppList-list').html("");
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
function click(me) {
    $("#recordlist dl").each(function () {
        var flag = 0;
        $(this).find("dt").click(function (e) {
            e.preventDefault();
            if (flag == 0) {
                $(this).find(".up").css("display", "block");;
                $(this).find(".down").hide();
                $(this).next().show();
                flag = 1;
            } else {
                $(this).find(".down").css("display", "block");
                $(this).find(".up").hide();
                $(this).next().hide();
                flag = 0;
            }
        });
    });
}

function LoadAll2(parameter2) {
    var searchcash = $("#searchcash").val();
    var startime = $("#tradestarttime").val();
    var entime = $("#tradeendtime").val();
    var flag = 0;
    var page = 0;
    var size = 20;
    $('#jyjl .AppList-list').html("");
    $('.AppList-warp').dropload({
        scrollArea: window,
        domUp: {                                                            // 上方DOM
            domClass: 'dropload-up',
            domRefresh: '<div class="dropload-refresh">↓下拉刷新</div>',
            domUpdate: '<div class="dropload-update">↑释放更新</div>',
            domLoad: '<div class="dropload-load"><span class="loading"></span>更新中...</div>'
        },
        domDown: {                                                          // 下方DOM
            domClass: 'dropload-down',
            domRefresh: '<div class="dropload-refresh">↑上拉加载更多</div>',
            domLoad: '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
            domNoData: '<div class="dropload-noData">——已经到底了——</div>'
        },
        loadUpFn: function (me) {
            page = 1;
            parameter2.searchcash = searchcash;
            parameter2.startime = startime;
            parameter2.entime = entime;
            parameter2.pageindex = page;
            parameter2.pagecount = size;
            var htmls = "";
            $.ajax({
                url: "/Common/Record?uid=539466CA3EC14C43A4558228&LoadFun=trade",
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
                        return;
                    }
                    else
                    {
                        var htmls = "";
                        if (data.Code == 1 && data.Msg.Data.length > 0) {
                            var Data = data.Msg.Data;
                            for (var i = 0; i < Data.length; i++) {
                                htmls += '<dl><dt><div class="listinfo"><div class="listinfo-row"><div class="listinfo-item">';
                                htmls += '<span class="listinfo-title">' + Data[i].ActionTypeStr + '</span>';
                                htmls += '</div><div class="listinfo-item">';
                                htmls += '<span class="listinfo-date">' + Data[i].ProcessingTime + '</span>';
                                htmls += '</div></div><div class="listinfo-row"><div class="listinfo-item">';
                                htmls += '<span class="betmoney">交易额度：</span>';
                                if (Data[i].ActionMoney == null) {
                                    Data[i].ActionMoney = 0;
                                }
                                htmls += '<span class="money">￥' + Data[i].ActionMoney + '</span>';
                                htmls += '</div><div class="listinfo-item"><span class="sendmoney">优惠：</span>';
                                if (Data[i].vSpMoney == null) {
                                    Data[i].vSpMoney = 0;
                                }
                                htmls += '<span class="money">￥' + Data[i].vSpMoney + '</span>';
                                htmls += '</div>';
                                htmls += '</div></div><div class="listicon">';
                                htmls += '<span class="down" style="display: block;"><svg class="icon" aria-hidden="true">';
                                htmls += '<use xlink:href="#icon-arrow-right-copy-copy-copy"></use></svg></span>';
                                htmls += '<span class="up"><svg class="icon" aria-hidden="true">';
                                htmls += '<use xlink:href="#icon-arrow-right-copy-copy-copy"></use></svg></span>';
                                htmls += '</div></dt>';
                                htmls += '<dd><div class="detailsinfo"><h3>订单详情</h3><ul class="ddnr">';
                                htmls += '<li><span class="grey">订单号</span><span class="grey">' + Data[i].Oid + '</span></li>';
                                htmls += '<li><span class="grey">交易时间</span><span class="grey">' + Data[i].ProcessingTime + '</span></li>';
                                htmls += '<li><span class="grey">交易类别</span><span class="grey">' + Data[i].ActionTypeStr + '</span></li>';
                                htmls += '<li><span class="grey">交易额度</span><span class="grey">' + Data[i].ActionMoney + '(' + Data[i].vSpMoney +')</span></li>';
                                htmls += '<li><span class="grey">交易后额度</span><span class="grey">' + Data[i].NewBalance + '</span></li>';
                                if (Data[i].remark == null) {
                                    Data[i].remark = "";
                                }
                                htmls += '<li><span class="grey">备注</span><span class="grey">' + Data[i].remark + '</span></li>';
                                htmls += '</ul></div></dd></dl>';
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
                        else
                        {
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
                        $('#jyjl .AppList-list').html(htmls);
                        $("#jyjl .AppList-list dl").each(function () {
                            var flag = 0;
                            $(this).find("dt").click(function (e) {
                                e.preventDefault();
                                if (flag == 0) {
                                    $(this).find(".up").css("display", "block");;
                                    $(this).find(".down").hide();
                                    $(this).next().show();
                                    flag = 1;
                                } else {
                                    $(this).find(".down").css("display", "block");
                                    $(this).find(".up").hide();
                                    $(this).next().hide();
                                    flag = 0;
                                }
                            });
                        });
                        me.resetload();
                        page = 1;
                        me.unlock();
                        me.noData(false);
                    }, 1000);
                },
                error: function (xhr, type) {
                    me.lock();
                    me.noData();
                    me.resetload();
                }
            });
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
                url: "/Common/Record?uid=539466CA3EC14C43A4558228&LoadFun=trade",
                type: "POST",
                data: parameter2,
                dataType: 'JSON',
                success: function(data){
                    if (data.Code == 0) {
                        $(document).dialog({
                            type: 'notice',
                            infoText: data.Msg,
                            autoClose: 1500,
                            position: 'center'  // center: 居中; bottom: 底部
                        });
                        return;
                    }
                    else
                    {
                        var htmls = "";
                        if (data.Code == 1 && data.Msg.Data.length > 0) {
                            var Data = data.Msg.Data;
                            for (var i = 0; i < Data.length; i++) {
                                htmls += '<dl><dt><div class="listinfo"><div class="listinfo-row"><div class="listinfo-item">';
                                htmls += '<span class="listinfo-title">' + Data[i].ActionTypeStr + '</span>';
                                htmls += '</div><div class="listinfo-item">';
                                htmls += '<span class="listinfo-date">' + Data[i].ProcessingTime + '</span>';
                                htmls += '</div></div><div class="listinfo-row"><div class="listinfo-item">';
                                htmls += '<span class="betmoney">交易额度：</span>';
                                if (Data[i].ActionMoney == null) {
                                    Data[i].ActionMoney = 0;
                                }
                                htmls += '<span class="money">￥' + Data[i].ActionMoney + '</span>';
                                htmls += '</div><div class="listinfo-item"><span class="sendmoney">优惠：</span>';
                                if (Data[i].vSpMoney == null) {
                                    Data[i].vSpMoney = 0;
                                }
                                htmls += '<span class="money">￥' + Data[i].vSpMoney + '</span>';
                                htmls += '</div>';
                                htmls += '</div></div><div class="listicon">';
                                htmls += '<span class="down" style="display: block;"><svg class="icon" aria-hidden="true">';
                                htmls += '<use xlink:href="#icon-arrow-right-copy-copy-copy"></use></svg></span>';
                                htmls += '<span class="up"><svg class="icon" aria-hidden="true">';
                                htmls += '<use xlink:href="#icon-arrow-right-copy-copy-copy"></use></svg></span>';
                                htmls += '</div></dt>';
                                htmls += '<dd><div class="detailsinfo"><h3>订单详情</h3><ul class="ddnr">';
                                htmls += '<li><span class="grey">订单号</span><span class="grey">' + Data[i].Oid + '</span></li>';
                                htmls += '<li><span class="grey">交易时间</span><span class="grey">' + Data[i].ProcessingTime + '</span></li>';
                                htmls += '<li><span class="grey">交易类别</span><span class="grey">' + Data[i].ActionTypeStr + '</span></li>';
                                htmls += '<li><span class="grey">交易额度</span><span class="grey">' + Data[i].ActionMoney + '(' + Data[i].vSpMoney + ')</span></li>';
                                htmls += '<li><span class="grey">交易后额度</span><span class="grey">' + Data[i].NewBalance + '</span></li>';
                                if (Data[i].remark == null) {
                                    Data[i].remark = "";
                                }
                                htmls += '<li><span class="grey">备注</span><span class="grey">' + Data[i].remark + '</span></li>';
                                htmls += '</ul></div></dd></dl>';
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
                        else
                        {
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
                        $('#jyjl .AppList-list').append(htmls);
                        $("#jyjl .AppList-list dl").each(function () {
                            var flag = 0;
                            $(this).find("dt").click(function (e) {
                                e.preventDefault();
                                if (flag == 0) {
                                    $(this).find(".up").css("display", "block");;
                                    $(this).find(".down").hide();
                                    $(this).next().show();
                                    flag = 1;
                                } else {
                                    $(this).find(".down").css("display", "block");
                                    $(this).find(".up").hide();
                                    $(this).next().hide();
                                    flag = 0;
                                }
                            });
                        });
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
        $('#jyjl .AppList-list').html("");
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
function click2(me) {
    $("#recordlist dl").each(function () {
        var flag = 0;
        $(this).find("dt").click(function (e) {
            e.preventDefault();
            if (flag == 0) {
                $(this).find(".up").css("display", "block");;
                $(this).find(".down").hide();
                $(this).next().show();
                flag = 1;
            } else {
                $(this).find(".down").css("display", "block");
                $(this).find(".up").hide();
                $(this).next().hide();
                flag = 0;
            }
        });
    });
}
