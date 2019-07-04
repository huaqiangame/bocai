<footer class="footer" style="clear:both">
    <div class="footer_main">
        <div class="container">
            <div class="row">
                <div class="col-xs-3 footer_left padding_0">
                    <div class="footer_common_title">
                        <h2>技术支持 <span>Technical support</span></h2>
                    </div>
                    <div class="clearfix footer_l_content">
                        <a href="">
                            <div class="pull-left">
                                <img src="__IMG__/dafayun.png" alt="">
                            </div>
                            <p class="pull-left">
                                <span>{:GetVar('webtitle')}系统</span>
                                <span>专业彩票系统平台</span>
                            </p>
                        </a>
                    </div>
                    <i></i>
                </div>
                <div class="col-xs-4 footer_middle">
                    <div class="footer_common_title">
                        <h2>服务体验 <span>Service experience</span></h2>
                        <div class="footer_m_content">
                            <div class="clearfix enter">
                                <span class="pull-left">昨日充值到账平均时间</span>
                                <p class="bar pull-left margin_0">
                                    <span class="bar_red"></span>
                                </p>
                                <span class="miao pull-left"><em>53</em> 秒</span>
                            </div>
                            <div class="clearfix enter">
                                <span class="pull-left">昨日提现到账平均时间</span>
                                <p class="bar pull-left margin_0">
                                    <span class="bar_blue"></span>
                                </p>
                                <span class="miao pull-left"><em>17'40</em> 秒</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3 footer_right">
                    <div class="footer_common_title">
                        <h2>充值展示 <span>Recharge method</span></h2>
                    </div>
                    <div class="chongzhi_img_box">
                        <span class="chongzhi_img1"></span>
                        <span class="chongzhi_img2"></span>
                        <span class="chongzhi_img3"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_other">
        <div class="container">
            <p class="footer_link">
                <a href="{:U('News/lists',['catid'=>30,'showid'=>3])}?About ">关于我们</a>
                <a href="{:U('News/lists',['catid'=>30,'showid'=>56])}?About">联系我们</a>
                <a href="{:U('News/lists',['catid'=>30,'showid'=>57])}?About">商务合作</a>
                <a href="{:U('News/lists',['catid'=>30,'showid'=>58])}?About">法律声明</a>
                <a href="{:U('News/lists',['catid'=>30,'showid'=>59])}?About">隐私声明</a>
            </p>
            <p class="footer_copyright">
                Copyright ©  {:GetVar('webtitle')}  Reserved | 18+
            </p>
        </div>
    </div>
</footer>
<if condition="$Think.cookie.showgg eq '1' && $Think.session.userinfo neq ''">
<div class="notice">
    <div class="noticCon">
        <h3>网站最新公告 <a class="iconfont icon-guanbi-copy closeNotice"></a></h3>
     <ul>
         <volist name="gglist" id="vo" key="k" offset="0" length='1'>
          <li><a href={:U('Member/ggshow',array('aid'=>$vo['id']))}>{$vo.title}<br>[{$vo.oddtime|date="Y-m-d H:i:s",###}]</a></li>
         </volist>
    </ul>
    </div>
</div>
 </if> 
<script>
    $('.notice').find('.closeNotice').click(function (){
     
        $('.notice').hide();
        $.ajax({
            url : "{:U('Common/closegg')}",
            type:"POST",
        })
    })
</script>
<div class="loginCengBox">
	<div class="loginCeng">
		<div class="loginCengH">
			<h3>温馨提示</h3>
			<span class="loginCengClose">
				<i class="iconfont icon-guanbi-copy"></i>
			</span>
		</div>
		<div class="loginCengB">
		
		</div>
		<div class="loginCengF">
			<button type="submit" >确定</button>
		</div>
	</div>
</div>
