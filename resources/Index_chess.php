<include file="Public/headerChess" />
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
            <div class="banner-game">
                            
                     <img src="__IMG__/title_card.png">                

             
            </div>
            <div class="news-wrap-c">
                <div class="news-wrap-box">
                    <div class="news-wrap-ctr">
                        <div class="news-wrap-ky">
                            <marquee scrollamount="3"   onmouseover="this.stop();"
                                     onmouseout="this.start();" style="cursor: pointer;" hspace="120" width="85%"> {$gonggao.title}</marquee>
                        </div>
                    </div>
                </div>
            </div>

             <div class="banner-game">
                <div class="swiper-container hidden-xs swiper-container2">
                </div>
            </div>

            <div class="games-box">
                <div class="games-ctr-box">
			<div class="banner-game" style="position: relative;">
                 <div class="swiper-container hidden-xs swiper-container3">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="__IMG__/ky_card_a.jpg"></div>
                        <div class="swiper-slide"><img src="__IMG__/ky_card_b.jpg"></div>
                       
                    </div>
                   
                    <div class="swiper-pagination  swiper-p1"></div>
                    <div class="swiper-button-prev  swiper-p2"></div>
                    <div class="swiper-button-next  swiper-p3"></div>
                </div>
            </div>
                    <ul class="game_list">
                        <volist name='list' id="vo" >
                            <li game_type="{$vo['type']|implode=',',###}">
                                <em></em>
                                <a <if condition="is_array($userinfo)">
								href="javascript:void(0)" onclick="open_new_win('{:url('Zhenren/jump_url','game_type='.$game.'&page=egame&game_num='.$key)}');"
							   <else/>
							    href="{:url('Zhenren/jump_url','game_type='.$game.'&page=egame&game_num='.$key)}');"
							   </if>
							   >
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
</div>
<script type="text/javascript" src="__JS__/game.js"></script>
<script type="text/javascript">
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

    function get_game(obj, line_name) {
        get_loading();
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
                $.each(ret, function (i, v) {
                    str += '<li game_type="' + v['type'].join(',') + '">';
                    str += '<em></em>';
                    str += '<a href="javascript:void(0)" >';
                    str += '<div class="img-box">';
                    str += '<p>';
                    str += '<img ';
                    str += 'class="lazy" data-original="__IMG__/real_person/game_images/' + line_name + '/' + v["img"].toLowerCase() + '" alt="' + v["name"] + '" title="' + v["name"] + '">';
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


</script>

<include file="Public/footer" />
</body>
</html>