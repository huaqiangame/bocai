<include file="Public/header" />
<link rel="stylesheet" type="text/css" href="__CSS__/dianziyouxi1.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/font-awesome_icon.min.css" />
<script type="text/javascript" src="__JS__/jquery.lazyload.js"></script>
<script type="text/javascript">
    //懒加载
    $(function () {
        $("img.lazy").lazyload({
            effect: "fadeIn",
            placeholder: "__IMG__/game/loading.gif"
        });

        $("#search-txt").focus(function () {
            $(document).keyup(function (e) {
                var val = $("#search-txt").val().trim();
                var num = 0;
                $(".game_list li").each(function () {
                    if ($(this).find("span").text().toLowerCase().indexOf(val.toLowerCase()) >= 0 || val == '') {
                        num++;
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                if (num > 0 && val != '') {
                    $('#game_type_name').text(') > ' + val + ' (');
                    $('#game_type_name').show();
                    $('#game_type_num').text(num);
                    $('#game_type_num').show();
                } else {
                    $('#game_type_name').hide();
                    $('#game_type_num').hide();
                }
            });
        });
    });
</script>
<div class="game-box">
    <div class="game-ctr-box">
        <div class="main-box">
            <div class="banner-game" style="position: relative;">
                <div class="swiper-container hidden-xs swiper-container3">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="__IMG__/game/banner_games_1.jpg"></div>
                        <div class="swiper-slide"><img src="__IMG__/game/banner_games_2.jpg"></div>
                        <div class="swiper-slide"><img src="__IMG__/game/banner_games_3.jpg"></div>
                        <div class="swiper-slide"><img src="__IMG__/game/banner_games_4.jpg"></div>
                    </div>
                    <!-- 如果需要分页器 -->
                    <div class="swiper-pagination  swiper-p1"></div>
                    <div class="swiper-button-prev  swiper-p2"></div>
                    <div class="swiper-button-next  swiper-p3"></div>
                </div>
            </div>
            <!--<div class="news-wrap-c">
                <div class="news-wrap-box">
                    <div class="news-wrap-ctr">
                        <div class="news-wrap-g">
                            <marquee scrollamount="3" scrolldelay="150" direction="left" onmouseover="this.stop();"
                                     onmouseout="this.start();" style="cursor: pointer;"> asdfasdfasd</marquee>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="banner-game1">
                <div class="swiper-container hidden-xs swiper-container2">
                    <div class="swiper-wrapper">
                        <volist name='egame' id="e" >
                            <div class="swiper-slide" style="width: 15% !important;">
                                <a href="javascript:void(0)" <if condition="$e['name'] eq $game"> class="txt-clr" </if>    onclick="get_game(this,'{$e['name']}')"  >
                                {$e['name']}电子</a>
                            </div>
                        </volist>
                    </div>
                    <!-- 如果需要分页器 -->
                    <!--<div class="swiper-button-prev  swiper-p5"></div>-->
                    <!--<div class="swiper-button-next  swiper-p6"></div>-->
                </div>
            </div>
            <div class="game-nav-wrap">
                <div class="left-box">
                    <i id="menu-btn"></i>
                    <p>电子游艺</p>
                    <span class="sp">>>全部 (</span>
                    <em id="game_length_all"></em>
                    <span  class="sp" id="game_type_name" style="display: none;">) 老虎机 (</span>
                    <em id="game_type_num" style="display: none;">78</em>
                    <span class="sp">)</span>
                </div>
                <div class="rgt-box">
                    <div id="btn-c"><i class="icon-align-justify"></i></div>
                    <div id="btn-y" class="active-txt"><i class="icon-th"></i></div>
                    <div id="search-btn"><i class="icon-search"></i></div>
                    <div><input id="search-txt" type="text" placeholder="请输入游戏名称"></div>
                </div>
                <ul id="vc">
                    <volist name='list' id="v" >
                    <li type_name="{$v['name']}">
                        <i class="inco_{$v['img_num']}">
                            <img <if condition="$game eq $v['name']">  class="active-inco"</if> src="__IMG__/game/game_menu_icon.png">
                        </i>
                        <span>{$v['name']}</span>
                    </li>
                    </volist>
                </ul>
            </div>
            <div class="games-box">
                <div class="games-ctr-box">
                    <ul class="game_list">
                        <volist name='list' id="vo" >
                        <li game_type="{$vo['type']|implode=',',###}">
                            <em></em>
                            <a href="javascript:void(0)" onclick="open_new_win('{:url('Zhenren/jump_url','game_type='.$game.'&page=egame&game_num='.$key)}');">
                                <div class="img-box">
                                    <p>
                                        <img class="lazy"  data-original="__IMG__/real_person/game_images/{$game}/{$vo['img']}">
                                        <i class="txt-box">{{rand(10000,99999)}}</i>
                                        <i class="go_ga" style="cursor: pointer;">进入游戏</i>
                                    </p>
                                    <h1>{$vo['name']}</h1>
                                </div>
                            </a>
                            <span>{$vo['name']}</span>
                        </li>
                        </volist>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="__JS__/game.js"></script>
<script type="text/javascript">
        function open_new_win(url) {
            location.href = url;
        }
    var mySwiper = new Swiper('.swiper-container3', {
        loop: true,
        pagination: '.swiper-p1',
        paginationClickable: true,
        nextButton: '.swiper-p2',
        prevButton: '.swiper-p3',
        //自动轮播
        autoplay: 3000,
    });
    //nav
    var mySwiper = new Swiper('.swiper-container2', {
        paginationClickable: true,
        //自动轮播
        autoplay: 3000,
        slidesPerView:6
    });
   // get_game(this,'AG');
    function get_game(obj, line_name) {

        $(".txt-clr").removeClass('txt-clr');
        $(obj).addClass('txt-clr');
        $.ajax({
            url:"{:U('Index/ajax_game')}",
            type: 'post',
            dataType: 'json',
            data: {line: line_name},
            success: function (ret) {
                if (ret.code == 500) {
                    remove_loading();
                    return layer.msg(ret.msg);
                }

                var str = '';
                var num = 0;
                ////onclick="open_new_win('{:url('Zhenren/jump_url','game_type='.$game.'&page=egame&code='.$key)}');
                $.each(ret, function (i, v) {
                    var lin_url = '';
                    str += '<li game_type="' + v['type'].join(',') + '">';
                    str += '<em></em>';
                    str += '<a href="javascript:void(0)"   onclick="open_new_win(\'{:url('Zhenren/jump_url')}?game_type='+line_name+'&&page=egame&game_num='+i+'\')" >';
                    str += '<div class="img-box">';
                    str += '<p>';
                    str += '<img ';
                    str += 'class="lazy" data-original="__IMG__/real_person/game_images/' + line_name + '/' + v["img"]+ '">';
                    str += '<i class="txt-box">{{rand(10000,99999)}}</i>';
                    str += '<i class="go_ga" style="cursor: pointer;">进入游戏</i>'
                    str += '</p>';
                    str += '<h1>' + v["name"] + '</h1>';
                    str += '</div>';
                    str += '</a>';
                    str += '<span>' + v["name"] + '</span>';
                    str += '</li>';

                    ++num;
                });

                $("#game_type_name").hide();
                $("#game_type_num").hide();

                $("#game_length_all").text(num);

                $(".game_list").html(str);

                var str = '';
                $.each(ret, function (i, v) {
                    str += '<li type_name="' + v['name'] + '">';
                    str += '<i class="inco_' + v['img_num'] + '"><img ';
                    if (ret['type'] == v['name'])
                        str += 'class="active-inco"';
                    str += 'src="__IMG__/game/game_menu_icon.png"></i>'
                    str += '<span>' + v['name'] + '</span>';
                    str += '</li>';
                });

                $("#vc").html(str);

                $("img.lazy").lazyload({
                    effect: "fadeIn",
                    placeholder: "__IMG__/game/loading.gif"
                });

                remove_loading();

                godle();
            }
        });
    }

 function get_loading() {
            $("body").append('<div id="div11" style="position:fixed;top:0;left:0;width:100%;height:9999;background:#000;opacity:.7;z-index:999"></div>');
            $("#loading").show();


        }

        function remove_loading() {
            $("#loading").hide();
            $("#div11").remove();
        }
</script>
<include file="Public/footer" />
</body>
</html>