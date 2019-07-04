
<include file="Public/headeractivity" />
<!-- 头部开始 -->
<link href="__CSS__/vendor.css" rel="stylesheet">
<link href="__CSS__/reset1.css" rel="stylesheet">
<link href="__CSS2__/footer.css" rel="stylesheet">
<link rel="stylesheet" href="__CSS__/activity.css">
<script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__JS__/jquery.backstretch.js"></script>
<script type="text/javascript" src="__JS__/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="__JS__/jquery.carouFredSel-6.1.0.js"></script>
<div class="page-bodybox">
    <div class="page-bodycenter">
	  <div class="swiper-slide"><img src="__IMG__/title_memberexclusiveii.png"></div> 
	        <div class="news-wrap-c">
                <div class="news-wrap-box">
                    <div class="news-wrap-ctr">
                        <div class="news-wrap-ky">
                          <marquee scrollamount="3"  direction="left" onmouseover="this.stop();" color="#fff" onmouseout="this.start();" style="cursor:pointer;padding-top:7px;margin-left:120px;" width="87%"> {$gonggao.title}</marquee>
                        </div>
                    </div>
                </div>
            </div>
	<div class="activity">
		<div class="myhot">
			<ul class="hleft">
				<li><a href="{:U('hall')}"><span <if condition="$type eq 0">class="ok"</if>>全部活动</span></a></li>
				<li><a href="{:U('hall',['type'=>1])}"><span <if condition="$type eq 1">class="ok"</if>>注册活动</span></a></li>
				<li><a href="{:U('hall',['type'=>2])}"><span <if condition="$type eq 2">class="ok"</if>>首存活动</span></a></li>
				<li><a href="{:U('hall',['type'=>3])}"><span <if condition="$type eq 3">class="ok"</if>>充值活动</span></a></li>
				<li><a href="{:U('hall',['type'=>4])}"><span <if condition="$type eq 4">class="ok"</if>>展示活动</span></a></li>
				<li style="float:right">
					<a href="javascript:void(0)" onclick="jindu()"><span>申请进度查询</span></a>
				</li>
			</ul>
			<div class="hright">
				<volist name="data" id="vo">
				<dl data-id="25">
				    <dd><img src="{$vo.title_img}" width="1020" style="opacity: 1;"></dd>
					<dt>
						<span class="title">{$vo.title}</span>
						<!--<span class="actime">活动时间：{$vo.start_at}-{$vo.end_at}</span>-->
						<a class="applybtn" -onclick="return layer.msg('请先登录!',{icon:6})" activity_id="{$vo.id}">申请活动</a>
						<div class="hotcontent">
							{$vo.content}
						</div>
					</dt>
				</dl>
				</volist>
			</div>
		</div>
	</div>
</div>
</div>
<script>
    $(".myhot .hright dl dd img").click(function()
    {
        $(this).parent().parent().children("dt").children(".hotcontent").slideToggle(200)
    })
    function jindu(){
        location.href="{:U('Activity/activeRecord')}";
    }
</script>
<!-- 底部 -->
<script>
    $(function(){
        $('.applybtn').click(function () {
            var activity_id = $(this).attr('activity_id');
           $.ajax({
                 url:"{:U('activity_apply')}",
                 data: {activity_id:activity_id},
                success:function(result){
                    var array=JSON.parse(result);
                    layer.msg(array.msg,{icon:6})
                }
           });
        });
    jQuery.fn.floatadv = function(loaded) {
        var obj = this;
        body_height = parseInt($(window).height());
        block_height = parseInt(obj.height());

        top_position = parseInt((body_height/2) - (block_height/2) + $(window).scrollTop());

        if (body_height<block_height) { top_position = 0 + $(window).scrollTop(); };

        if(!loaded) {
            obj.css({'position': 'absolute'});
            obj.css({ 'top': top_position });
            $(window).bind('resize', function() {
                obj.floatadv(!loaded);
            });
            $(window).bind('scroll', function() {
                obj.floatadv(!loaded);
            });
        } else {
            obj.stop();
            obj.css({'position': 'absolute'});
            obj.animate({ 'top': top_position }, 400, 'linear');
        }
    }
    });
</script>
<script src="__JS2__/layer/layer.js"></script>
<script src="__JS__/ajax-submit-form.js"></script>
<script src="__JS2__/common.js"></script>

<include file="Public/footer" />
</body>
</html>