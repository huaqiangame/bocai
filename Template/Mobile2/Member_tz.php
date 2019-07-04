<include file="Public/header" />
    
<body>
    <header class="ui-header">
        <i class="ui-icon rui-l-btn rui-icon-back" onClick="window.history.back()">&nbsp;&nbsp;&nbsp;</i>
        <h1>投注记录</h1>
         <a href="{:GetVar('kefudaima')}" class="rui-r-btn2"><img style="width:28px;height:28px" src="__IMG__/rui-contact-icon2.png" />联系客服</a>  
        <a href="{:U('Mobil/User/index')}" class="ui-icon rui-r-btn rui-icon-user">&nbsp;&nbsp;&nbsp;</a>
    </header>
    <section class="ui-container fuddetai_infosCont">
        <div class="ui-tab u-recordcontainer">
            <ul class="ui-tab-nav ui-border-b">
                <li <if condition="$a_item eq 1">class="current"</if>><A href="{:U('User/tz')}">所有记录</A></li>
                <li <if condition="$a_item eq 2">class="current"</if>><A href="{:U('User/tz',array('a_item'=>2))}">中奖</A></li>
                <li <if condition="$a_item eq 3">class="current"</if>><A href="{:U('User/tz',array('a_item'=>3))}">未中</A></li>
                <li <if condition="$a_item eq 4">class="current"</if>><A href="{:U('User/tz',array('a_item'=>4))}">未开奖</A></li>
            </ul>
            <input type="hidden" id="pageNum" value="1" />
            <ul class="ui-tab-content">
                <li class="current">
                    <div class="spcing15">&nbsp;</div>

<ul class="ui-list ui-list-text ui-border-tb">
<volist name="tzlist" id="vo"><li class="ui-border-t">
<h4><p class="fz14">{$vo.cpname}({$vo.ball})</p><p class="c_8 fz12">{$vo.oddtime|date="Y-m-d H:i:s",###}</p></h4>
<div class="ui-txt-info c_blue">
投注金额：{$vo.amount};
<if condition="$vo[status] eq 0">
		<if condition="$vo[status] eq 0"><a href="javascript:void" class="chedan_btn" style="color:red" onClick="Order_chedan('{$vo[id]}','{$vo[trano]}',this)">撤单</a></if>
	<elseif  condition="$vo[status] eq 1" />
		<span style="color:green">已中奖({$vo.okamount})</span>
	<elseif  condition="$vo[status] eq -1" />
		<span style="color:red">未中奖</span>
	<elseif  condition="$vo[status] eq -2" />
		<span style="color:grey">已撤单</span>
	</if>
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
</body>
</html>
