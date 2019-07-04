<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{$webheadertitle}</title>
    <meta name="csrf-token" content="snEwZAhkC0qdaveJjHli5n5440HmQplNdQcHhdwl">
    <link type="text/css" rel="stylesheet" href="__JS__/mb4js/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="__JS__/mb4js/main.css">
    <link type="text/css" rel="stylesheet" href="__JS__/mb4js/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="__JS__/mb4js/member.css">
    <link type="text/css" rel="stylesheet" href="__JS__/mb4js/ssc.css">
    <link type="text/css" rel="stylesheet" href="__JS__/mb4js/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="__JS__/mb4js/commonCss.css">
    <script type="text/javascript" src="__JS__/mb4js/jquery.js"></script>
</head>
<body class="m_bac">

<div class="m_container">
    <div class="m_body">
        <div class="m_member-title clear textCenter">
            <a class="pull-left" href="javascript:history.go(-1);">&nbsp;返回</a>
            {$activitie_info.title}
        </div>
        <div class="m_userCenter-line"></div>
        <div class="m_activityDetail">
            {$activitie_info.content}
        </div>
    </div>
</div>

<script type="text/javascript" src="__JS__/mb4js/touchslide.js"></script>
<script type="text/javascript" src="__JS__/mb4js/marquee.js"></script>
<script type="text/javascript" src="__JS__/mb4js/layer.js"></script>
<script type="text/javascript" src="__JS__/mb4js/base.js"></script>
<script type="text/javascript" src="__JS__/mb4js/wap_ajax-submit-form.js"></script>

<script type="text/javascript">
    TouchSlide({
        slideCell: "#slide",
        mainCell: ".bd",
        titCell: ".hd",
        effect: "leftLoop",
        autoPage: true,
        autoPlay: true
    });
    $("#news").marquee({duration: 10000});
    var info = function () {
        lay_msg('请登录后操作！', null);
    };
    var g_login = function () {
        var e = function () {
            location.replace("/guest.php");
        };
        lay_msg('试玩账号，登录成功！', e);
    };
    var onUrl = function (t) {
        t = Number(t) > 0 ? Number(t) : 1;
        location.replace('/route.php?t=' + t);
    };
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>