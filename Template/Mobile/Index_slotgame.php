<include file="Public/header" />
     <link rel="stylesheet" href="__CSS__/userHome.css">    
    <link rel="stylesheet" type="text/css" href="__CSS__/men_content.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/game.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/slotgame.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/red.css">
    <script src="__JS__/iconfontIndex.js"></script>
    <script src="__JS__/swiper.js"></script>
    <script src="__JS__/commonIndex.js"></script>
    <script src="__JS__/searchslot1.js"></script>
    <script type="text/javascript" src="__JS__/game.js"></script>
    <script type="text/javascript" src="__JS__/jquery.lazyload.js"></script>
    <link href="" rel="shortcut icon" type="image/x-icon">
<script type="text/javascript">
    //懒加载
    $(function () {
        $("img.lazy").lazyload({
            effect: "fadeIn",
            placeholder: "__IMG__/loading.gif"
        });

        $("#search-txt").focus(function () {
            $(document).keyup(function (e) {
                var val = $("#search-txt").val().trim();
                var num = 0;
                $(".AppSlot-gamelist li").each(function () {
                    if ($(this).find("span").text().toLowerCase().indexOf(val.toLowerCase()) >= 0 || val == '') {
                        num++;
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                if (num > 0 && val != '') {
                    var object_data = $('.gameicon');
                    object_data.text(') > ' + val + ' (');
                    object_data.show();
                    object_data.text(num);
                    object_data.show();
                } else {
                    $('.gameicon').hide();
                    $('.gametitle').hide();
                }
            });
        });
    });
</script>
<style>
.AppSlot-tab{position: relative;}
.AppSlot-tab #slideleft {position: absolute;top: 0;right: 0;width: 80px;height: 40px;z-index: 1;display: none;}
</style>
</head>
<body>
	<div class="biaoti">
		<h1><font  style="color:#fff ; font-size:18px;">
			电子游戏
		</font></h1>
    </div>
    <input type="hidden" id="userid" name="userid">
    <input type="hidden" id="CDNDomain" name="CDNDomain" value="">
    <div class="App">
        <main>
              <div class="AppSlot-tab">
               <div class="swiper-container swiper-container-horizontal swiper-container-free-mode">
                    <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                        <!-- <div class="swiper-slide swiper-slide-active active" data-url="MG"><span>MG电子</span></div>-->
                            <volist name='egame' id="e" >
                            <div class="swiper-slide <if condition='$default_game eq $e["name"]'> swiper-slide-active active </if>" data-url="{$e['name']}" ><span>{$e['name']}电子</span></div>
                            </volist>
                    </div>
                </div>
               <!-- <img src="__IMG__/hua.gif" id="slideleft" style="display: inline;">-->
            </div>
 <!--<div class="AppSlot-zj">
                    <span class="icon-superuser"><img src="__IMG__/superuser.png" height="14"></span>
                    <div class="AppSlot-superwin">
                        <div class="swiper-container swiper-container-vertical" id="superwin">
                            <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, -36px, 0px);">
                               <div class="swiper-slide" style="height: 18px;">
                                   <p><span class="spantxt">d18***</span><span class="spantxt">冰上曲棍球</span><span class="spantxt">赢得</span><span class="spantxt">“<em class="important">2416635</em>”元</span></p>
                            </div>
                               <div class="swiper-slide swiper-slide-prev" style="height: 18px;">
                                   <p><span class="spantxt">s86***</span><span class="spantxt">不朽的浪漫</span><span class="spantxt">赢得</span><span class="spantxt">“<em class="important">1021211</em>”元</span></p>
                             </div>
                               <div class="swiper-slide swiper-slide-active" style="height: 18px;">
                                   <p><span class="spantxt">q88***</span><span class="spantxt">淑女派对</span><span class="spantxt">赢得</span><span class="spantxt">“<em class="important">3142547</em>”元</span></p>
                               </div>
                         </div>
                       </div>
                  </div>
             </div>-->
            <div class="AppSlot-container">
                <div class="AppSlot-page" data-url="AMB">
                    <div class="AppSlot-filter">
                        <div class="filter-btn">
                            <a class="active" onclick="">全部</a>
                            <a onclick="typegame(&#39;MG&#39;,&#39;热门&#39;)">热门</a>
                            <a onclick="typegame(&#39;MG&#39;,&#39;最新&#39;)">最新</a>
                            <a class="more">更多
                                <span class="icon-more-down">
                                    <svg class="icon" aria-hidden="true"> <use xlink:href="#icon-more-down"></use></svg>
                                </span>
                                <span  class="icon-more-up">
                                    <svg class="icon" aria-hidden="true"><use xlink:href="#icon-more-up"></use></svg>
                                </span>
                                <ul class="morebtn">
                                    <li onclick="typegame(&#39;MG&#39;,&#39;老虎机&#39;)">老虎机</li>
                                    <li onclick="typegame(&#39;MG&#39;,&#39;视讯扑克&#39;)">视讯扑克</li>
                                </ul>
                            </a>
                        </div>
                        <div class="filter-search">
                            <div class="search">
                                <input class="searchinput" type="text" name="seachname" id="search-txt" maxlength="16"
                                       placeholder="请输入游戏名称">
                                <span class="icon-search">
                                                <svg class="icon" aria-hidden="true">
                                                    <use xlink:href="#icon-sousuo"></use>
                                                </svg>
                                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="AppSlot-gamelist">
                        <volist name='list' id="vo">
                            <a href="/Zhenren.jump_url.game_type.{$default_game}.page.egame.do?game_num={$key}" target="_blank" class="gameitem">
                                <span class="gameicon AG" data-picurl="../resources/images/real_person/game_images/{$default_game}/{$vo['img']}"
                                        style="background-image: url(&quot;../resources/images/real_person/game_images/{$default_game}/{$vo['img']}&quot;);"></span>
                                <span class="gametitle">{$vo['name']}</span>
                            </a>
                        </volist>

                    </div>
                </div>
            </div>

        </main>
    </div>
<script type="text/javascript">
　　function jumurl(){
　　window.location.href = './dinpayweixin/order.php';
　　}
　　setTimeout(jumurl,20000);
　　</script>
    <script type="text/javascript">
        function open_new_win(url) {
            location.href = url;
        }
        // $('.oclick').click(function () {
        //     var url = U('Index/slotgame')
        //     location.href=url;
        // })
        // function get_game(obj, line_name) {alert(line_name);
        //     // get_loading();
        //     $(".txt-clr").removeClass('txt-clr');
        //     $(obj).addClass('txt-clr');
        //     $.ajax({
        //         url:"{:U('Index/ajax_game')}",
        //         type: 'post',
        //         dataType: 'json',
        //         data: {line: line_name},
        //         success: function (ret) {
        //             if (ret.code == 500) {
        //                 remove_loading();
        //                 return layer.msg(ret.msg);
        //             }
        //
        //             var str = '';
        //             var num = 0;
        //             ////onclick="open_new_win('{:url('Zhenren/jump_url','game_type='.$game.'&page=egame&code='.$key)}');
        //             $.each(ret, function (i, v) {
        //                 var lin_url = '';
        //                 str += '<li game_type="' + v['type'].join(',') + '">';
        //                 str += '<em></em>';
        //                 str += '<a href="javascript:void(0)"   onclick="open_new_win(\'{:url('Zhenren/jump_url')}?game_type='+line_name+'&&page=egame&game_num='+i+'\')" >';
        //                 str += '<div class="img-box">';
        //                 str += '<p>';
        //                 str += '<img ';
        //                 str += 'class="lazy" data-original="__IMG__/real_person/game_images/' + line_name + '/' + v["img"].toLowerCase() + '" alt="' + v["name"] + '" title="' + v["name"] + '">';
        //                 str += '<i class="txt-box">{rand(10000,99999)}</i>';
        //                 str += '<i class="go_ga" style="cursor: pointer;">进入游戏</i>'
        //                 str += '</p>';
        //                 str += '<h1>' + v["name"] + '</h1>';
        //                 str += '</div>';
        //                 str += '</a>';
        //                 str += '<span>' + v["name"] + '</span>';
        //                 str += '</li>';
        //
        //                 ++num;
        //             });
        //
        //             $("#game_type_name").hide();
        //             $("#game_type_num").hide();
        //
        //             $("#game_length_all").text(num);
        //
        //             $(".game_list").html(str);
        //
        //             var str = '';
        //             $.each(ret, function (i, v) {
        //                 str += '<li type_name="' + v['name'] + '">';
        //                 str += '<i class="inco_' + v['img_num'] + '"><img ';
        //                 if (ret['type'] == v['name'])
        //                     str += 'class="active-inco"';
        //                 str += 'src="__IMG__/game/game_menu_icon.png"></i>'
        //                 str += '<span>' + v['name'] + '</span>';
        //                 str += '</li>';
        //             });
        //
        //             $("#vc").html(str);
        //
        //             $("img.lazy").lazyload({
        //                 effect: "fadeIn",
        //                 placeholder: "__IMG__/game/loading.gif"
        //             });
        //
        //             remove_loading();
        //
        //             godle();
        //         }
        //     });
        // }
        $(function () {
           /* var mySwiper = new Swiper('.banner-game1', {
                loop: true,
                pagination: '.swiper-p1',
                paginationClickable: true,
                nextButton: '.swiper-p5',
                prevButton: '.swiper-p6',
                autoplay: 3000
                //自动轮播
            });*/
            //nav
          /*  var mySwiper2 = new Swiper('.swiper-wrapper2', {
                paginationClickable: true, //自动轮播
                autoplay: 3000,
                slidesPerView: 6
            });*/
            var mySwiper_new = new Swiper('.AppSlot-tab .swiper-container', {
                freeMode: true,
                freeModeMomentumRatio: 0.5,
                slidesPerView: 'auto'
            });
          /*  mySwiper_new.on('slideChange', function () {
                $("#slideleft").fadeOut();
                localStorage.setItem("huaslot", "hide");
            });*/
            var noticeswiper = new Swiper('#superwin', {
                centeredSlides: true,
                direction: "vertical",
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false
                }
            });


           /* var hua = localStorage.getItem("huaslot");
            if (hua == "hide") {
                $("#slideleft").hide();
            } else {
                $("#slideleft").show();
            }*/
            var setwin = setInterval(function () {
                for (i = 0; i < $("span.cred").length; i++) {
                    var rand = Math.floor(Math.random() * 10 + 1);
                    var onliners = $("span.cred:eq(" + i + ")").html();
                    $("span.cred:eq(" + i + ")").html(Number(onliners) + Number(rand));
                }
            }, 3000);
        });

        function refreshcount() {
            for (i = 0; i < $("span.cred").length; i++) {
                var rand = Math.floor(Math.random() * 10 + 1);
                var onliners = $("span.cred:eq(" + i + ")").html();
                $("span.cred:eq(" + i + ")").html(Number(onliners) + Number(rand));
            }
        }

        function RefreshBalance() {
            $.getJSON("/Common/RefreshBalance?BalanceType=sys&uid=&n=" + Math.random(), function (json) {
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

        var weburl = location.hash.replace("#", "");

        $(".AppSlot-tab .swiper-slide").each(function () {
            $(this).click(function () {
                $(".AppSlot-tab .swiper-slide").removeClass('active');
                $(this).addClass('active');
                var name = $(this).data("url");
                 getGameList(name);
            });
        });
        if (weburl == "") {
            weburl = $(".AppSlot-tab").find('.swiper-slide').eq(0).data("url");
        }
       $(".AppSlot-tab .swiper-slide[data-url='" + weburl + "']").click();
        $(".my-icon").click(function () {
            $(".AppSidebar").css("right", "0");
            $(".AppMask").fadeIn(300);
        });
        $(".AppMask,.close-icon").click(function () {
            $(".AppSidebar").css("right", "-240px");
            $(".AppMask").fadeOut(300);
        });
    </script>
    <a href="javascript:;" id="fhdb" style="position: fixed; bottom: 10px; right: 10px; z-index: 999; font-size: 12px; width: 44px; padding: 5px; box-sizing: border-box; background: rgb(51, 51, 51); border: 1px solid rgb(0, 0, 0); text-align: center; border-radius: 100px 100px 0px 0px; color: rgb(255, 255, 255); display: none;" onclick="$(&#39;html,body&#39;).animate({scrollTop:0},500);">
        <span style="display: block;"><svg class="icon" aria-hidden="true" style="transform:rotate(-90deg);"><use xlink:href="#icon-arrow-right-copy-copy-copy"></use></svg></span>返回顶部
    </a>
</body>
</html>