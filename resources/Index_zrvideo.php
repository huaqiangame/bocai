<include file="Public/headerzrvideo"/>
<div class="page-bodybox">
    <div class="page-bodycenter">
	  <div class="swiper-slide"><img src="__IMG__/title_live.png"></div> 
	        <div class="news-wrap-c">
                <div class="news-wrap-box">
                    <div class="news-wrap-ctr">
                        <div class="news-wrap-ky">
                          <marquee scrollamount="3"  direction="left" onmouseover="this.stop();"
                          color="#fff" onmouseout="this.start();" style="cursor: pointer;margin-top:5px;margin-left:120px;">{$gonggao.title}</marquee>
                        </div>
                    </div>
                </div>
            </div>
        <div class="page-body">
           

            <div class="ele-live-main-wrap game_class" style="cursor:pointer">
                <div class="ele-live-bbin-wrap">
                    <a href="{:U('Zhenren/login',array('type'=>'bbin'))}"  target="_blank" ><img id="bbin" src="__IMG__/game/bbin_n.png">
					</a>
                    <a href="{:U('Zhenren/login',array('type'=>'bbin'))}"  target="_blank" ><img id="play" src="__IMG__/game/live_bbin_play.png"></a>
                </div>
				
                <div class="swiper-container">				  
                    <div class="swiper-wrapper">
                        <div class="swiper-slider">
						<a href="{:U('Zhenren/login',array('type'=>'ag'))}"  target="_blank" ><img src="__IMG__/game/ad02_l.png"></a>
						</div>                          
                        
                    </div>
                    <!-- 如果需要分页器 <div class="swiper-slider"><img src="__IMG__/game/ad_bull_l.jpg"></div>
                    <div class="swiper-pagination"></div>
                    <!-- 如果需要导航按钮
                   <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div> -->
                    <!-- 如果需要滚动条 
                    <div class="swiper-scrollbar"></div>-->
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('.game_class').click(function () {
            //如果存在id 则打开页面 ，此方法用于区分游戏线路是否开启专用
            if ( $(this).attr('id') )
                open_new_win($(this).attr('id'),'','location=no,width=1200,height=760');

        });
    })
</script>

<include file="Public/footer"/>
</body>
</html>