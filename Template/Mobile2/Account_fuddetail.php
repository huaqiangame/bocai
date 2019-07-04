<include file="Public/header" />
    
<body>
    <header class="ui-header">
        <i class="ui-icon rui-l-btn rui-icon-back" onClick="window.history.back()">&nbsp;&nbsp;&nbsp;</i>
        <h1>账户明细</h1>
         <a href="{:GetVar('kefudaima')}" class="rui-r-btn2"><img style="width:28px;height:28px" src="__IMG__/rui-contact-icon2.png" />联系客服</a>  
        <a href="{:U('Mobil/User/index')}" class="ui-icon rui-r-btn rui-icon-user">&nbsp;&nbsp;&nbsp;</a>
    </header>
    <section class="ui-container fuddetai_infosCont">
        <div class="ui-tab u-recordcontainer">
            <ul class="ui-tab-nav ui-border-b">
                <li <if condition="!$type">class="current"</if>><A href="{:U('Account/fuddetail')}">所有类型</A></li>
                <li <if condition="$type eq 3">class="current"</if>><A href="{:U('Account/fuddetail',array('type'=>3))}">奖金派送</A></li>
                <li><A href="{:U('Account/fuddetail2')}">充值</A></li>
                <li><A href="{:U('Account/fuddetail3')}">提现</A></li>
            </ul>
            <input type="hidden" id="pageNum" value="1" />
            <ul class="ui-tab-content">
                <li class="current">
                    <div class="spcing15">&nbsp;</div>
<?php $typearray = AbstractType();?>
<ul class="ui-list ui-list-text ui-border-tb">
<volist name="mxlist" id="vo"><li class="ui-border-t">
<h4><p class="fz14">{$typearray[$vo['type']]}</p><p class="c_8 fz12">{$vo.oddtime|date="Y-m-d H:i:s",###}</p></h4>
<div class="ui-txt-info c_blue">金额：{$vo.amount};可用金额：{$vo.totalamount}</div>
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
