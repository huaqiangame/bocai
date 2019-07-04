
	<link rel="stylesheet" href="__CSS2__/footer.css">
       <img src="__IMG__/footer_bg.png" alt="" style="width:100%;margin-top:30px;"/ >
        <div class="pic" align="center" >
         <div class="footer_other">
            <div class="footer_link" >
                <a href="{:U('News/help',['catid'=>30,'showid'=>3])}?About">關於我們</a>
                <a href="{:U('News/help',['catid'=>30,'showid'=>56])}?About">聯絡我們</a>
                <a href="{:U('public/agentIndex')}">合作夥伴</a>
                <a href="{:U('News/help',['catid'=>30,'showid'=>58])}?About">存款幫助</a>
                <a href="{:U('News/help',['catid'=>30,'showid'=>59])}?About">取款幫助</a>
				<a href="{:U('News/help',['catid'=>33,'showid'=>43])}?About">常见问题</a>
				 <span>
                Copyright ©  {:GetVar('webtitle')}线上娱乐城CASINO Reserved
                 </span>
		 </div>
         </div>

			<img src="__IMG__/index_footer3.jpg"   usemap="#mymap" />

                       <map name="mymap" id="map">

                            <area  shape="rectangle" coords="666,348,746,369"   alt="如何存款">

                           <area  shape="rectangle" coords="747,348,827,369"   alt="游戏帮助">

                          <area  shape="rectangle" coords="831,348,910,369"    alt="隐私保护">
						  
						   <area  shape="rectangle" coords="666,371,744,392"   alt="如何提款">

                           <area  shape="rectangle" coords="747,371,829,392"   alt="责任条款">

                          <area  shape="rectangle" coords="833,371,910,392"    alt="合作代理">

                       </map>
        </div>
        
  <!--</div>-->


<!-- 点击到达最顶部-->
<div id="go_top" ></div>
<script type="text/javascript">
    function noticeUp(obj,top,time) {
        $(obj).animate({
            marginTop: top
        }, time, function () {
            $(this).css({marginTop:"0"}).find(":first").appendTo(this);
        })
    }
    var  Handler = {
        init:function(){
            this.init_menue();
            this.init_scrollTop();
            this.init_scropll_toTop();

            // 调用 公告滚动函数
            setInterval("noticeUp('.zx_xx ul','-35px',500)", 2000);
        },
        init_menue:function(){
            $(".topMenu li").hover(function(){
                $(this).addClass("active").siblings().removeClass("active");
                $(this).find(".subnav").show();
            },function(){
                $(this).find(".subnav").hide();
                $(".topMenu li").removeClass("active");
            });

            $(".cont_bot .tab li").click(function(){
                $(this).addClass("active").siblings().removeClass("active");
                $('.cont_bot .left .tab_box .boxs>div:eq(' + $(this).index() + ')').show().siblings().hide();
            });

        },
        init_scrollTop:function(){
            jQuery(window).scroll( function (){
                var  topScroll = $(window).scrollTop();
                var topPin = 200+topScroll;
                $('#floatService1,#floatService2').stop().animate({"top":topPin},topPin*0.8);

            });

        },
	
        init_scropll_toTop:function(){
            $(function(){
                //点击id为go_top的元素时网页回到顶部
                $("#go_top,#floatService3").click(function(){
                    $('html,body').animate({scrollTop:0},10);//回到顶端
                    return false;
                });
            });
        }

    };

    Handler.init();
    function get_loading() {
        var h = $(document).height();
        $('body').append('<style>#div1{background-color: rgba(0, 0, 0, 0.45);position: absolute;left: 0;top:0;width: 100%;height:'+h+'px;display: table-cell;text-align: center;vertical-align: middle;padding-top: 40vh;}</style><div id="div1"><img src="__IMG__/addloading.gif"></div>')
    }

    function remove_loading() {
        $('#div1').remove();
    }
    
    function open_new_win(url) {
        var w = document.documentElement.clientWidth || document.body.clientWidth;
        var h = document.documentElement.clientHeight || document.body.clientHeight;
        window.open(url,'','location=no,width='+w+',height='+h);
    }
/*
    function get_loading() {
        $("body").append('<div id="div11" style="position:fixed;top:0;left:0;width:100%;height:9999;background:#000;opacity:.7;z-index:999"></div>');
        $("#loading").show();
    }

    function remove_loading() {
        $("#loading").hide();
        $("#div11").remove();
    }*/
</script>
