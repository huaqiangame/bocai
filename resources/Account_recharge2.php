
<link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
<link rel="stylesheet" href="__CSS2__/reset.css">
<link rel="stylesheet" href="__CSS2__/icon.css">
<link rel="stylesheet" href="__CSS2__/header.css">
<link rel="stylesheet" href="__CSS2__/userInfo.css">
<link rel="stylesheet" href="__CSS2__/recharge.css">
<link rel="stylesheet" href="__CSS2__/footer.css">
<include file="Public/header" />
<link rel="stylesheet" type="text/css" href="__CSS__/common.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/layout.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/style.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/artDialog.css" />
<script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__JS__/artDialog.js"></script>
<style>
input.bu{border:1px solid #ddd; display:inline; background:#fff}
input.txt{width:100px;}
</style>
<script src="__ROOT__/Public/dist/lib/ZeroClipboard/ZeroClipboard.js"></script>
<script language="JavaScript">
    /*function ClipId(id) { return document.getElementById(id); }
    function toClipboard(copy_id,input_id) {
        var clip = new ZeroClipboard.Client();
        clip.setHandCursor(true);
        clip.setText(ClipId(input_id).value);
        clip.addEventListener('complete', function (client) {
            alert("复制成功！");
        });
        clip.glue(copy_id);
    }*/
</script>
<script type="text/javascript">
$(document).ready(function(){
  var clip = new ZeroClipboard($('.copy_button'));

  clip.on('ready', function(){
    this.on('aftercopy', function(event){
    alert('已经复制剪贴板：' + event.data['text/plain']);
    });
  });
});
</script>
    <div class="wapper ">
        <div class="w1000">
            <div class="content bg_wite">
                <div class="h30"></div>
                <!--代理中心内容-->
                <div class="helper_cont money_cont agent_cont">
                    <div class="w_930">
                        <div class="datetady">
                            <ul>
                                <li class="curr"><a href="{:U('Account/recharge')}">账户充值</a></li>
                            </ul>
                        </div>
                        <div class="bank_nextComfire show" id="WXRechargeOrders">
                            <div style="color:red;padding: 10px 10px;font-weight: bold;">
                             <div class="bank_check mgt20" style="position: relative;">
                                <h2 style="font-size: 2em;">充值确认</h2>
                                <ul class="ui_form">

                                    <li>
                                        <input type="hidden" value="{$payinfo.type}" id="paytype" />
                                        <label class="ui_label">充值方式：</label>
                                        <span class="icon_bank bank_{$payinfo.type}" style="margin-left:33px;"></span>
                                    </li>
                                    <!--充值金额-->
                                    <li>
                                        <label class="ui_label">充值金额：</label>
                                        <span class="ui_cont">
                                            <!--<i class="c_red" id="bank_money">{$payorder.amount}</i> 元-->
<input id="payAmount" value="{$payorder.amount}"  class="txt ty_                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          text yz_empty  text_monry" />
&nbsp;&nbsp;<input class="bu copy_button" data-clipboard-target="payAmount" type="button"  value=" 点击复制 " />

                                        </span>
                                    </li>


                                    <if condition="$payinfo[xingming] neq ''"><li>
                                        <label class="ui_label">收款人：</label>
                                        <span class="ui_cont">
                                            <!--<i class="c_red" id="I1" style="color: red;">{$payinfo.xingming}</i>-->
<input id="xingming" value="{$payinfo.xingming}"  class="txt ty_text yz_empty  text_monry" />
&nbsp;&nbsp;<input class="bu copy_button" data-clipboard-target="xingming" type="button"  value=" 点击复制 " />
                                        </span>
                                    </li></if>


                                    <if condition="$payorder[bankusername] neq ''"><li>
                                        <label class="ui_label">付款人：</label>
                                        <span class="ui_cont">
                                            <!--<i class="c_red" id="I1" style="color: red;">{$payinfo.xingming}</i>-->
<input id="bankusername" value="{$payorder.bankusername}"  class="txt ty_text yz_empty  text_monry" />
&nbsp;&nbsp;<input class="bu copy_button" data-clipboard-target="bankusername" type="button"  value=" 点击复制 " />
                                        </span>
                                    </li></if>

                                    <if condition="$payinfo[zhanghao] neq ''"><li>
                                        <label class="ui_label">收款账号：</label>
                                        <span class="ui_cont">
                                            <!--<i class="c_red" id="I2" style="color: red;">{$payinfo.zhanghao}</i>-->
<input id="zhanghao" value="{$payinfo.zhanghao}"  class="txt ty_text yz_empty  text_monry" />
&nbsp;&nbsp;<input class="bu copy_button" data-clipboard-target="zhanghao" type="button"  value=" 点击复制 " />
                                        </span>
                                    </li></if>

                                     <if condition="$payinfo[isoninlie] eq 0"><li>
                                         <label class="ui_label">附言码：</label>
                                         <span class="ui_cont">
                                             <!--<i class="c_red" id="I3" style="color: red;">{$payorder.fuyanma}</i>-->
<input id="fuyanma" value="{$payorder.fuyanma}"  class="txt ty_text yz_empty  text_monry" />
&nbsp;&nbsp;<input class="bu copy_button" data-clipboard-target="fuyanma" type="button"  value=" 点击复制 " />
                                         </span>
                                     </li></if>
                                    <if condition="trim($configs['jumpurl']) neq ''">
									<li>
									<label class="ui_label"></label><!--href="{$configs['jumpurl']|str_replace='[payid]',$payorder['id'],###}"-->
                                        <span class="ui_cont"><a class="ty_btn sub_btn ty_submit mo_btn " href="{:U('Account/dealRecord2')}" />完成</a></span>
                                    </li>
									<else />
                                    <li>
                                        <span class="ui_cont" style="padding-top:10px;">
                                            <input type="button" value="确认充值" class="ty_btn" id="addOrders" onClick="paysubmit()" />
                                        </span>
                                    </li>
									</if>
                                    <li>

                                    </li>
                                </ul>
                                <if condition="$payinfo[erweima]">
								<div style="position: absolute; top: 25px; left: 540px;">
                                    <img src="__ROOT__{$payinfo[erweima]}" width="250" height="250" style="width:250px; height:250px;" /></div>
									</if>
                            </div>
								<div class="content">{$payinfo.content}</div>
                        </div>
                    </div>
                </div>
                <!--代理中心内容-->
                <div class="h20"></div>
            </div>
        </div>
    </div>
    <!--wapper-->
    <div class="h35"></div>
<include file="Public/footer" />
<script type="text/javascript">
	function CloseOrder() {
		alt("提交成功",'success');
		setTimeout(window.location.href="{:U('Account/fuddetail2')}", 3000);

	}
function paysubmit(){
	$(".step_mark span").eq(1).removeClass('curr').end().eq(2).addClass('curr');
	var jiluurl = "{:U('Account/fuddetail2')}";
	var id = "{$payorder['id']}";
	var co = '';
	co += '<div style="padding:15px 60px; text-align:center; "><p style="line-height:30px; font-size:16px;">支付完成前请勿关闭此窗口</p><p style="line-height:30px; margin-top:15px;"><a style="line-height:30px; display:inline-block; height:30px; text-align:center; color:#fff; border-radius:3px; background:#f60; margin:0px 10px; padding:0px 15px;" href="'+jiluurl+'" >完成充值</a><a style="line-height:30px; height:30px; text-align:center; color:#fff; border-radius:3px; background:#f60; margin:0px 10px; display:inline-block; padding:0px 15px;" onclick="Window.location.reload();" href="'+jiluurl+'">充值记录</a></p></div>';
	art.dialog({
		id: 'testID2',
		content: co,
		lock: true,
		cancelVal: '确定',
		cancel: true
	});
	$("#paysubmitform").submit();
	//alert($("#paysubmitform").length);
}
</script>

</body>
</html>

