{include file="Public/meta" /}
<title>添加优惠活动</title>
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/admin/css/fileinput.min.css" />
</head>
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm" enctype="multipart/form-data">


        <div class="row cl">
            <label class="form-label col-xs-2 col-sm-3"><span class="c-red">*</span>活动类型：</label>
            <div class="formControls col-xs-3 col-sm-3">
                <select class="select" name="type" required="">
                    <option value="" >请选择</option>
                    <option value="1" {if condition="$info['type'] eq '1'"}selected{/if}>注册活动</option>
                    <option value="2" {if condition="$info['type'] eq '2'"}selected{/if}>首存活动</option>
                    <option value="3" {if condition="$info['type'] eq '3'"}selected{/if}>充值活动</option>
                    <option value="4" {if condition="$info['type'] eq '4'"}selected{/if}>展示活动</option>
                </select>
            </div>

            <label class="form-label col-xs-2 col-sm-3"><span class="c-red">*</span>申请模式：</label>
            <div class="formControls col-xs-4 col-sm-3">
                <select class="select" name="is_apply">
                    <option value="0" {if condition="$info['is_apply'] eq '0'"}selected{/if}>需要申请</option>
                    <option value="1" {if condition="$info['is_apply'] eq '1'"}selected{/if}>无需申请</option>
                </select>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>活动标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" required="" value="{$info.title}" placeholder="活动标题" name="title">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">排序：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{$info.sort}" placeholder="排序" name="sort">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">活动图片：</label>
            <div class="formControls col-xs-8 col-sm-6">
                <input type="text" class="input-text" value="{$info.title_img}" placeholder="活动图片" name="title_img" id="upload_file">
                <input id="btn_ewmurl"  class="btn btn-default uk-button" type="button" value="选择文件">
            </div>
        </div>
        <!--<div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">活动图片：</label>
            <div class="formControls col-xs-5 col-sm-6">
                <input type="file" name="title_img" class="projectfile" id="upload_file"  />
                <p class="help-block">支持jpg、jpeg、png、gif格式，大小不超过2.0M</p>
            </div>
        </div>-->
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"> 活动时间：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input class="input-text" type="text" style="width:150px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" name="start_at" value="{$info.start_at}"> -
                <input class="input-text" type="text" style="width:150px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" value="{$info.end_at}" name="end_at">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">活动时间文字描述：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{$info.date_desc}" placeholder="活动时间文字描述" name="date_desc">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">活动所需达到的金额：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="number" class="input-text" value="{$info.money}" placeholder="活动所需达到的金额" name="money">
            </div>

            <label class="form-label col-xs-4 col-sm-3">赠送比例：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="number" class="input-text" value="{$info.rate}" placeholder="赠送比例" name="rate">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">赠送金额上限：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="number" class="input-text" value="{$info.gift_limit_money}" placeholder="赠送金额上限" name="gift_limit_money">
            </div>

        <input type="hidden" class="input-text" value="{$info.id}"  name="id">

            <label class="form-label col-xs-4 col-sm-3">赠送基础金额：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="number" class="input-text" value="{$info.direct_money}" placeholder="赠送金额上限" name="direct_money">
            </div>
        </div>
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
            $uploadJson = $URL_PREFIX . $_SERVER["HTTP_HOST"] . U('Uploads/upload', array('uploadtype'=>'true', 'allowpath' => '1', 'allowext' => 'gif|jpg|jpeg|png|bmp'));
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
<script charset="utf-8" src="../Template/admin/resources/ui/lib/KindEditor/lang/zh-CN.js"></script>
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