<include file="Public/headersport" />
<div class="page-bodybox">           
    <div class="page-bodycenter">
	            <div class="swiper-slide">
                            
                     <img src="__IMG__/title_sport.png">                
                   
             
            </div>
            <div class="news-wrap-c">
                <div class="news-wrap-box">
                    <div class="news-wrap-ctr">
                        <div class="news-wrap-ky">
                            <marquee scrollamount="3"   onmouseover="this.stop();"
                                     onmouseout="this.start();" style="cursor: pointer;" hspace="110"width="90%"> 你好</marquee>
                        </div>
                    </div>
                </div>
            </div>
<div class="page-bodybox">
      <div class="page-bodycenter">
	    <div class="page-body">
            <ul>
                <volist name='sprot_data' id="vo" >
                    <if condition="$vo['name'] eq 'BBIN'">
                        <li style="width: 15%">
                            <a class="game_class" style="cursor:pointer"
                               data-src="{:url('Zhenren/jump_url','game_type='.$vo['name'].'&code=ball&page=sport')}">
                                {$vo['name']}体育
                            </a>
                        </li>
                    <else/>
                        <li style="width: 15%">
                            <a class="game_class" style="cursor:pointer"
                               data-src="{:url('Zhenren/jump_url','game_type='.$vo['name'].'&page=sport')}">
                                {$vo['name']}体育
                            </a>
                        </li>
                    </if>
                </volist>

            </ul>
            <div style="text-align: center">
                <iframe src="" frameborder="0" style="width: 100%; height: 1000px" id="game_page"></iframe>
            </div>
        </div>
		</div>
		</div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('.game_class').eq(0).click();
    });

    $('.game_class').click(function () {
        get_loading();
        var src = $(this).attr('data-src');
        $('#game_page').attr('src',src).load(src,{},function () {
            remove_loading();
        })
    });


</script>
<include file="Public/footer" />
