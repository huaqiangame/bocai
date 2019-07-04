{include file="Public/meta" /}
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/admin/css/fileinput.min.css" />
<title>添加资讯</title>
</head>
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm" enctype="multipart/form-data">
        {present name="info"}
        <input name="id" type="hidden" value="{$info[$_pk]}">
        {/present}


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>选择栏目：</label>
            <div class="formControls col-xs-8 col-sm-9">
    	<span class="select-box inline">
            <select name="catid" class="select">
                <option value="0">==选择栏目==</option>
                {volist name="catelist" id="cat"}
                <option value="{$cat.id}" {if condition="$cat['id'] eq $info['catid']" }selected{/if} >{$cat.spacer}{$cat.catname}</option>
                {/volist}
            </select>
		</span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{$info.title}" placeholder="标题" name="title">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">封面图片上传：</label>
            <div class="formControls col-xs-5 col-sm-6">
                    <input type="file" name="imgFile" class="projectfile" id="upload_file"  />
                    <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过2.0M</p>
            </div>
        </div>
        <input type="hidden" name="img_url" id="img_url">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script type="text/javascript">
                    if (typeof KindEditor == 'undefined') {
                        document.write('<scr' + 'ipt src="../Template/admin/resources/ui/lib/KindEditor/kindeditor-min.js"></sc' + 'ript>');
                    }
                </script>
                <textarea id="content" style="" name="content">{$info.content}</textarea>
                <?php
                $URL_PREFIX = is_ssl() ? 'https://' : 'http://';
                $uploadJson = $URL_PREFIX . $_SERVER["HTTP_HOST"] . U('Uploads/upload', array('allowpath' => '1', 'allowext' => 'gif|jpg|jpeg|png|bmp'));
                $fileManagerJson = U('Uploads/file_manager');
                ?>
                <script>
                    var editor;
                    KindEditor.ready(function (K) {
                        /*var lang = K.lang({
                        multiimage: "批量上传"
                        });*/
                        editor = K.create("#content", {
                            allowFileManager: false,
                            pagebreakHtml: '[page]',
                            imageSizeLimit: "",
                            imageUploadLimit: "",
                            pluginsPath: "../Template/admin/resources/ui/lib/KindEditor/plugins/",
                            width: "100%",
                            height: "80px",
                            uploadJson: "{$uploadJson}",
                            fileManagerJson: "{$fileManagerJson}",
                            items: ['source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage', 'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak', 'anchor', 'link', 'unlink']
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
<script type="text/javascript" src="../Template/admin/resources/admin/js/fileinput.min.js?t=<?php echo time();?>"></script>
<script type="text/javascript" src="../Template/admin/resources/admin/js/zh.js?t=<?php echo time();?>"></script>
<script type="text/javascript">

    $(function () {
        //0.初始化fileinput
        initFileInput('upload_file',"{:U('Uploads/upload')}");
    });
    //初始化fileinput控件（第一次初始化）
    function initFileInput(ctrlName, uploadUrl) { //接收的文件后缀
        var control = $('#' + ctrlName);
        control.fileinput({
            language: 'zh'
            , uploadUrl: uploadUrl,
            allowedFileExtensions: ['jpg', 'png', 'gif']
            , showUpload: false
            , showCaption: false
            ,dropZoneEnabled:false
            ,deleteUrl:"{:U('Uploads/delete_file')}"
            ,uploadExtraData:function (previewId, index) {
                var param_data = {
                    allowpath : "{$uploadJson}",
                    uploadtype:'bootstrap'
                };
                return param_data;
            }
            ,deleteExtraData:function () {
                return {
                    url : $("#img_url").val()
                };
            }
            , browseClass: "btn btn-primary"
            , previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
        }).on('fileuploaded', function(event, file) {
            $('#kv-success-box').append(file.response.url);
            $("#img_url").val(file.response.url);

        });
    }
</script>
</body>
</html>