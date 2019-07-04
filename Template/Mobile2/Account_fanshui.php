<include file="Public/header" />
    
<body>
    <header class="ui-header">
        <i class="ui-icon rui-l-btn rui-icon-back" onClick="window.history.back()">&nbsp;&nbsp;&nbsp;</i>
        <h1>我的反水</h1>
         <a href="{:GetVar('kefudaima')}" class="rui-r-btn2"><img style="width:28px;height:28px" src="__IMG__/rui-contact-icon2.png" />联系客服</a>  
        <a href="{:U('Mobil/User/index')}" class="ui-icon rui-r-btn rui-icon-user">&nbsp;&nbsp;&nbsp;</a>
    </header>
    <section class="ui-container fuddetai_infosCont">
        <div class="ui-tab u-recordcontainer">
                <div class="ui-btn-wrap">
                    <a href="javascript:volid(0)" onClick="qingquyongqu();"><button class="ui-btn-lg ui-btn-danger loginout">
                        点击领取反水
                    </button></a>
<center><if condition="($lqcount elt 0) and ($jljine gt 0)">每天限领取一次,当前可领取佣金为：<b>{$jljine}</b> 元
		<elseif  condition="($lqcount gt 0)"/>
		可领取反水金额：<b>{$jljine}</b> 元
		<else />
		暂无佣金可领取
		</if></center>
		                </div>
            <ul class="ui-tab-content">
                <li class="current">
                    <div class="spcing15">&nbsp;</div>

<ul class="ui-list ui-list-text ui-border-tb">
<volist name="lqlist" id="vo"><li class="ui-border-t">
<h4><p class="fz14">投注额：{$vo.touzhuedu}元，反水比例：{$vo.bili}</p><p class="c_8 fz12">{$vo.oddtime|date="Y-m-d H:i:s",###}</p></h4>
<div class="ui-txt-info c_blue">
反水金额：{$vo.amount};
<if condition="$vo['shenhe'] eq 0"><span style="color:grey">审核中</span><elseif condition="$vo['shenhe'] eq 1"/><span style="color:green">通过</span></if>
</div>
</li></volist> 
</ul>
                    <div class="ui-row-flex ui-whitespace fz12 pages">
                        {$pageshow}
                    </div>
                    <div class="spcing15">&nbsp;</div>
                </li>
            </ul>
        </div>
        <div class="clr"></div>
    </section>

<script>
function qingquyongqu(){
	$.post("{:U('Mobil/Account/fanshui')}",'', function(json){
		if(json.status==1){
			alt(json.info);
			window.location.reload();
		}else{
			alt(json.info);
		}
	},'json'); 
	return false;
}
</script>
</body>
</html>
