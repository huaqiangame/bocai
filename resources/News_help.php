<include file="Public/headermember"/>
<link rel="stylesheet" type="text/css" href="__CSS2__/dailihezuo2.css"/>
<link rel="stylesheet" type="text/css" href="__CSS2__/footer.css"/>
<script type="text/javascript">
    $(function () {
        var choose_id = 2;
        if (location.href.indexOf('id=') > 0) {
            choose_id = location.href.split('id=')[1];
        }
        $('.wibox #ng li').click(function () {
            $(this).addClass('active').siblings().removeClass('active');
            $('.wibox aside:eq(' + ($(this).index() - 1) + ')').addClass('rightbox').siblings('aside').removeClass('rightbox');
        });
        $('#vg li').click(function () {
            $(this).addClass('active_c').siblings().removeClass('active_c');
            $('#rightbox div:eq(' + $(this).index() + ')').show().siblings('div').hide();
        });
       // $('.wibox #ng li:eq(' + choose_id + ')').click();
    });
</script>

<div class="page-body">
  <div class="banner-game">
                
                     <img src="__IMG__/register/title_welcome.png">                
          <div class="news-wrap-c">
                    <div class="news-wrap-box">
                       <div class="news-wrap-ctr">
                         <div class="news-wrap-ky">
                            <marquee scrollamount="3"   onmouseover="this.stop();"
                                     onmouseout="this.start();" style="cursor: pointer;" hspace="110"width="90%"> {$gonggao.title}</marquee>
                         </div>
                       </div>
                    </div>
                 </div>			 
             
  </div>
    <div class="wibox_v">
        <div class="wibox" id="wibox">
            <div class="leftbox">
                <ul id="ng">
                    <p>欢迎光临</p>
                    <volist name="about_us" id="v">
                        <li <if condition="$v['id'] eq $showid">class="active"</if>>
                            <a href="javascript:void(0)">
                                <span></span>{$v['title']}
                            </a>
                        </li>
                    </volist>
                </ul>
            </div>
            <volist name="about_us" id="v">
                <aside <if condition="$v['id'] eq $showid">class="rightbox"</if> >
                    {$v['content']}
                </aside>
            </volist>
        </div>
    </div>
</div>

<include file="Public/footer"/>