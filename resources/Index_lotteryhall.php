<include file="Public/headerlottery"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/style_new.css" />
<!---mian body-->

<div class="page-bodybox">
       <div class="banner-game">
                            
                     <img src="__IMG__/title_lottery7.png">                
                                   <!-- <div class="swiper-slid">如果需要分页器</div> -->
                    <!-- <div class="swiper-pagination  swiper-p1"></div>
                    <div class="swiper-button-prev  swiper-p2"></div>
                    <div class="swiper-button-next  swiper-p3"></div>-->
                   <div class="news-wrap-c">
                    <div class="news-wrap-box">
                       <div class="news-wrap-ctr">
                         <div class="news-wrap-ky">
                            <marquee scrollamount="3"   onmouseover="this.stop();"
                                     onmouseout="this.start();" style="cursor: pointer;margin-left:120px;" hspace="110"width="87%"> {$gonggao.title}</marquee>
                         </div>
                       </div>
                    </div>
                 </div>
           </div>
   
    <div class="page-body">
	
        <div class="wibox">
            <a href="{:U('Index/lottery')}" style="cursor: pointer" class="nu game_class"></a>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div style="cursor: pointer" class="swiper-slide game_class">
                       <a href="javascript:void(0);" onclick="open_new_win('{:url('Zhenren/jump_url','game_type=VR&page=lottery')}')">
                           <img src="__IMG__/game/lottery_3.png"></a>
                    </div>
                    <div style="cursor: pointer" class="swiper-slide game_class">
                        <img src="__IMG__/game/lottery_2.png">
                    </div>
                    <div style="cursor: pointer" class="swiper-slide" onclick="alert('敬请期待')">
                        <img src="__IMG__/game/lottery_4.png">
                    </div>
                    <div style="cursor: pointer" class="swiper-slide" onclick="alert('敬请期待')">
                        <img src="__IMG__/game/lottery_4.png">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-scrollbar"></div>
        </div>
        <!-- 如果需要滚动条 -->
        <div class="iibox" style="cursor: pointer;overflow: hidden;">
            <ul class="cd-accordion-menu animated">

                <li class="has-children">				
                    <input type="checkbox" name="group-4" id="group-4" >
                    <label for="group-4"> <img src="__IMG__/k3.png" style="max-width:40px;">&nbsp;&nbsp;快3</label>
                    <ul>
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'k3'">
                                <li>
                                    <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                                </li>
                            </if>
                        </volist>
                    </ul>
                </li>
                <li class="has-children">
                    <input type="checkbox" name="group-2" id="group-2" >
                    <label for="group-2"><img src="__IMG__/ssc.png" style="max-width:40px;">&nbsp;&nbsp;时时彩</label>
                    <ul>
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'ssc'">
                                <li>
                                    <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                                </li>
                            </if>
                        </volist>
                    </ul>
                </li>

                <li class="has-children">
                    <input type="checkbox" name="group-3" id="group-3" >
                    <label for="group-3"><img src="__IMG__/kl8.png" style="max-width:40px;">&nbsp;&nbsp;快乐彩</label>
                    <ul>
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'keno' or $cp['typeid'] eq 'pk10'">
                                <li>
                                <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a>
                                </li>
                            </if>
                        </volist>
                    </ul>
                </li>
                <li class="has-children">
                    <input type="checkbox" name="group-5" id="group-5" >
                    <label for="group-5"><img src="__IMG__/115.png" style="max-width:40px;">&nbsp;&nbsp;十一选五</label>
                    <ul>
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'x5'">
                                <li><a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a></li>
                            </if>
                        </volist>
                    </ul>
                </li>
                <li class="has-children">
                    <input type="checkbox" name="group-6" id="group-6" >
                    <label for="group-5"><img src="__IMG__/lhc.png" style="max-width:40px;">&nbsp;&nbsp;六合彩</label>
                    <ul>
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'lhc'">
                               <li> <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a></li>
                            </if>
                        </volist>
                    </ul>
                </li>
				<li class="has-children">
                    <input type="checkbox" name="group-7" id="group-7" >
                    <label for="group-5"><img src="__IMG__/3d.png" style="max-width:40px;">&nbsp;&nbsp;3D</label>
                    <ul>
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq '3d'">
                               <li> <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a></li>
                            </if>
                        </volist>
                    </ul>
                </li>
					<li class="has-children">
                    <input type="checkbox" name="group-8" id="group-8" >
                    <label for="group-5"><img src="__IMG__/p3.png" style="max-width:40px;">&nbsp;&nbsp;排列3</label>
                    <ul>
                        <volist name="Allcp" id="cp" key="key">
                            <if condition="$cp['typeid'] eq 'pl3'">
                               <li> <a href="__ROOT__/Game.{$cp.typeid}?code={$cp.name}">{$cp.title}</a></li>
                            </if>
                        </volist>
                    </ul>
                </li>
            </ul>
        </div>

    </div>

    <script type="text/javascript">
        var lb_index =1;
        $(function () {

            $("label").eq(1).siblings('ul').slideDown(300);
            $('label').on('click',function () {
                var label_size = $("label").index(this);
                $('input[type="checkbox"]').each(function (i) {
                    if(label_size != lb_index){
                        $(this).siblings('ul').slideUp(300);
                    }
                });
                if(label_size != lb_index){
                    $(this).siblings('ul').slideDown(300);
                }
                lb_index = label_size;
            });
        });
        var mySwiper = new Swiper('.swiper-container', {
            slidesPerView: 4,
            spaceBetween: 5
        });

        var accordionsMenu = $('.cd-accordion-menu');
        if( accordionsMenu.length > 0 ) {
            accordionsMenu.each(function(){
                var accordion = $(this);
                accordion.on('change', 'input[type="checkbox"]', function(){
                    var checkbox = $(this);
                   // ( checkbox.prop('checked') ) ? checkbox.siblings('ul').attr('style', 'display:none;').slideDown(300) : checkbox.siblings('ul').attr('style', 'display:block;').slideUp(300);
                });
            });
        }
    </script>

<include file="Public/footer"/>
</body>
</html>