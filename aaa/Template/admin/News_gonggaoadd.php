{include file="Public/meta" /}
<title>添加公告</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
		{present name="info"}
        <input name="id" type="hidden" value="{$info[$_pk]}">
        {/present}
        
        
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>公告标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{$info.title}" placeholder="标题" name="title">
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">公告内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
            	            			<script type="text/javascript">
		if (typeof KindEditor=='undefined'){
		document.write('<scr'+'ipt src="../Template/admin/resources/ui/lib/KindEditor/kindeditor-min.js"></sc'+'ript>');
		}
		</script>
		<textarea id="content" style="" name="content" >{$info.content}</textarea>
<?php
$URL_PREFIX =  is_ssl()?'https://':'http://';
$uploadJson = $URL_PREFIX.$_SERVER["HTTP_HOST"].U('Uploads/upload',array('allowpath'=>'1','allowext'=>'gif|jpg|jpeg|png|bmp'));
$fileManagerJson = U('Uploads/file_manager');
?>
		<script>
		var editor;
		KindEditor.ready(function(K) {
		/*var lang = K.lang({
		multiimage: "批量上传"
		});*/
		editor = K.create("#content", {
		allowFileManager : false,
		pagebreakHtml : '[page]',
		imageSizeLimit:"",
		imageUploadLimit:"",
		pluginsPath:"../Template/admin/resources/ui/lib/KindEditor/plugins/",
		width : "100%",
		height : "80px",
		uploadJson: "{$uploadJson}",
		fileManagerJson : "{$fileManagerJson}",
		items : [ 'source','|','undo','redo','|','preview','print','template','code','cut','copy','paste','plainpaste','wordpaste','|','justifyleft','justifycenter','justifyright','justifyfull','insertorderedlist','insertunorderedlist','indent','outdent','subscript','superscript','clearhtml','quickformat','selectall','|','fullscreen','/','formatblock','fontname','fontsize','|','forecolor','hilitecolor','bold','italic','underline','strikethrough','lineheight','removeformat','|','image','multiimage','flash','media','insertfile','table','hr','emoticons','baidumap','pagebreak','anchor','link','unlink' ]
		});
		});
		</script>   
                
                
			</div>
		</div>
        
        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

{include file="Public/footer" /}

</body>
</html>