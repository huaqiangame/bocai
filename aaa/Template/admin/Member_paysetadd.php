{include file="Public/meta" /}
<title>存款方式添加/修改</title>
</head>
<body>
<article class="page-container">
	<form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
		{present name="info"}
        <input name="id" type="hidden" value="{$info[$_pk]}">
        {/present}
        
                
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否线上支付：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="isonline" type="radio" id="isonline-1" value="1" {if condition="$info['isonline'] eq 1"}checked{/if}>
					<label for="state-1">是</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="isonline-0" name="isonline" value="-1" {if condition="$info['isonline'] eq -1"}checked{/if}>
					<label for="state-0">否</label>
				</div>
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>标识：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.paytype}" placeholder="标识" name="paytype">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.paytypetitle}" placeholder="支付方式名称" name="paytypetitle">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">副名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.ftitle}" placeholder="副名称" name="ftitle">
			</div>
		</div>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">充值金额设置：</label>
			<div class="formControls col-xs-8 col-sm-9">
最低充值:
<input class="input-text" name="minmoney" value="{$info.minmoney}" style="width:90px;" type="text">元
&nbsp;&nbsp;
最高充值:<input class="input-text" name="maxmoney" value="{$info.maxmoney}" style="width:90px;" type="text">元
 
			</div>
		</div>
        <div id="payconfigs"></div>
		<link rel="stylesheet" href="../Template/admin/resources/ui/lib/KindEditor/themes/default/default.css" />
		<script charset="utf-8" src="../Template/admin/resources/ui/lib/KindEditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="../Template/admin/resources/ui/lib/KindEditor/lang/zh-CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="remark"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'source','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});
			});
		</script>
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">支付说明：</label>
			<div class="formControls col-xs-8 col-sm-9">
                <textarea name="remark" style="width:100%;height:200px;visibility:hidden;">{$info.remark}</textarea>
			</div>
		</div>
                
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="state" type="radio" id="state-1" value="1" {if condition="$info['state'] eq 1"}checked{/if}>
					<label for="state-1">启用</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="state-0" name="state" value="-1" {if condition="$info['state'] eq -1"}checked{/if}>
					<label for="state-0">禁用</label>
				</div>
			</div>
		</div>
        
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;确定&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}
<script id="payisonline0" type="text/html">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">收款人姓名：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{$configs.bankname}" placeholder="收款人姓名" name="configs[bankname]">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">收款人账号：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{$configs.bankcode}" placeholder="收款人账号" name="configs[bankcode]">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否二维码支付：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="configs[isewm]" type="radio" id="isewm-1" value="1" {if condition="$configs['isewm'] eq 1"}checked{/if}>
				<label for="state-1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="isewm-0" name="configs[isewm]" value="-1" {if condition="$configs['isewm'] eq -1"}checked{/if}>
				<label for="state-0">否</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">二维码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{$configs.ewmurl}" placeholder="二维码" name="configs[ewmurl]" id="ewmurl">
			<input id="btn_ewmurl"  class="btn btn-default uk-button" type="button" value="选择文件">
		</div>
	</div>
</script>
<script id="payisonline1" type="text/html">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">商户标识：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{$configs.merchantid}" placeholder="商户标识" name="configs[merchantid]">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">商家密钥1：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{$configs.merchantkey1}" placeholder="商家密钥1" name="configs[merchantkey1]">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">商家密钥2：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{$configs.merchantkey2}" placeholder="商家密钥2" name="configs[merchantkey2]">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">前台跳转地址：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{$configs.redirecturl}" placeholder="前台跳转地址" name="configs[redirecturl]">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">前台通知地址：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{$configs.hrefbackurl}" placeholder="前台通知地址" name="configs[hrefbackurl]">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">异步通知地址：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{$configs.returnbackurl}" placeholder="异步通知地址" name="configs[returnbackurl]">
		</div>
	</div>
</script>
<script>
$(function(){
	var isonline = $("input[name='isonline']:checked").val();
	chengeonlinepay(isonline);
});
$("input[name='isonline']").change(function(){
	chengeonlinepay($("input[name='isonline']:checked").val());
})
function chengeonlinepay(value){
	if(value==1){
		var html = $("#payisonline1").html();
		$("#payconfigs").html(html);
	}else if(value==-1){
		var html = $("#payisonline0").html();
		$("#payconfigs").html(html);
	}else{
		$("#payconfigs").html('');
	}
}
</script>
<script>
	KindEditor.ready(function(K) {
		var editor = K.editor({
			uploadJson: "<?=(is_ssl()?'https://':'http://').$_SERVER["HTTP_HOST"].U('Uploads/upload',array('allowext'=>'gif|jpg|jpeg|png|bmp','size'=>2));?>",
			allowFileManager : false
		});

		var btn_ewmurlReadyTime = null;

		btn_ewmurlReadyTime = setInterval(function () {
				if($('#btn_ewmurl').length <= 0){
					return;
				}else{
					K("#btn_ewmurl").click(function() {
						editor.loadPlugin('image', function() {
							editor.plugin.imageDialog({
								imageUrl : K("#ewmurl").val(),
								clickFn : function(url, title, width, height, border, align) {
									K("#ewmurl").val(url);
									editor.hideDialog();
								}
							});
						});
					});
					clearInterval(btn_ewmurlReadyTime);
				}
			}
			, 1000);
	});
</script>
</body>
</html>