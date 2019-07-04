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
	<link type="text/css" rel="stylesheet" href="__CSS__/icon.css">
    <link rel="stylesheet" href="__JS__/mb4js/activity.css">
    <script type="text/javascript" src="__JS__/mb4js/jquery.js"></script>
</head>
<body class="m_bac">
      <div class="am-header am-header-default header nav_bg am-header-fixed">
         <div class="am-header-left am-header-nav">
			<a href="javascript:history.back(-1);" class="">
				<i class="iconfont icon-arrow-left"></i>
			</a>
      	</div>
		<h1 class="am-header-title activity_h1">
         优惠活动
		</h1>
     </div>
<div class="m_container">
    <div class="m_body">
        <div class="m_activity">
            <ul>
                <volist name="data" id="vo">
                <dl data-id="{$vo.id}">
                    <dd>
                        <a href="{:U('/Activity/activityDetail',['id'=>$vo['id']])}">
                            <img src="{$vo.title_img}" alt="">
                        </a>
                    </dd>
                    <dt>
                        <div class="title">标题:{$vo.title}</div><br>
                        <div class="actime">活动时间：{$vo.time}</div>

                        <form action="http://www.sp.com/member/apply_activity" method="post">
                            <input type="hidden" name="activity_id" value="{$vo.id}">
                            <if condition="$vo['is_apply'] eq 0">
                            <button class="applybtn ajax-submit-without-confirm-btn" activity_id="{$vo.id}">申请活动</button>
                            </if>
                        </form>

                    </dt>
                </dl>
                </volist>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript" src="__JS__/mb4js/touchslide.js"></script>
<script type="text/javascript" src="__JS__/mb4js/marquee.js"></script>
<script type="text/javascript" src="__JS__/mb4js/layer.js"></script>
<script type="text/javascript" src="__JS__/mb4js/base.js"></script>
<script type="text/javascript" src="__JS__/mb4js/wap_ajax-submit-form.js"></script>
<script type="text/javascript">
    $('.applybtn').click(function () {
        var activity_id = $(this).attr('activity_id');
        $.ajax({
            url:"{:U('activity_apply')}",
            data: {activity_id:activity_id},
            success:function(result){
                var array=JSON.parse(result);
                alert(array.msg);
            }
        });
    });
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
	<include file="Public/footer" />
</body>
</html>