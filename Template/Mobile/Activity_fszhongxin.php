<include file="Public/header" />
<link rel="stylesheet" href="__CSS__/activity.css">
<link rel="stylesheet" href="__CSS__/userHome.css">
 <link rel="stylesheet" href="__CSS__/fanshui.css">   

<body class="bg_fff">
<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			返水中心
		</font></h1>
</div>
	<div class="bank_recharge" style="width:100%;position:absolute;top:50px;">
	<main>
            <div class="AppList-container">
                <div class="AppList-item" id="tzjl" style="display: block;">
                    <div class="tabbox-item-content">
                        <table cellpadding="0" cellspacing="0" class="datatable">
                            <tbody><tr>
                                <th>平台类型</th>
                                <th>可返水金额</th>
                            </tr>
                                <tr>
                                    <td>暂无平台返水</td>
                                    <td>0 元</td>
                                </tr>
                        </tbody></table>
                    </div>
                    <div class="record-count">
                        <div class="count-item">
                            <span class="tit">总计：</span>
                            <span class="val negative" id="sunyi">¥0</span>
                        </div>
                    </div>
                    <div class="fsbtnbox">
                        <a class="button button-submit" id="receiveBtn" onclick="receive()">即刻领取</a>
                        <a class="button button-refresh" id="refreshBtn" onclick="refresh()">刷新</a>
                    </div>
                </div>
            </div>
        </main>
		</div>
	    <script type="text/javascript">
    var vrcount = 0;
    function vipreturn() {
        vrcount++;
        if (vrcount > 2) {
            alert("请勿频繁点击，10秒后再试");
        } else {
            userid = $("#userid").val();
            var companystyle = $("#companystyle").val();
            if (userid == null || userid == "") {
                alert("技术支持QQ:33723247");
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
</script>	
		
		<div class="AppMask"></div>
    <script src="__JS__/swiper.min.js"></script>
    <script src="__JS__/common.js"></script>
    <script src="__JS__/dropload.js"></script>
    <script type="text/javascript">
        var receiveacc = 0;
        function receive() {
            receiveacc++;
            if (receiveacc > 2) {
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
                                    receiveacc = 0;
                                }, 10000);
                            }
                        });
                    }
                }

            }
        }

        function refresh() {
            location.reload();
        }
</script>	
		  		  <include file="Public/footer" />
</body>
</html>