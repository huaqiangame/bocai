{include file="Public/meta" /}
<title>添加返水</title>
<style>
    .input-text{width: 50%;}
</style>
</head>
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
        {present name="info"}
            <input name="id" type="hidden" value="{$info[$_pk]}">
        {/present}

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">等级：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="number" class="input-text" value="{$info.level}" placeholder="等级" name="level">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>最低投注：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="number" class="input-text" value="{$info.low_amount}" placeholder="最高投注" name="low_amount">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>最高投注：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="number" class="input-text" value="{$info.height_amount}" placeholder="最高投注" name="height_amount">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>视讯比例：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{$info.live_scale}" placeholder="视讯比例" name="live_scale">%
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>彩票比例：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{$info.cp_scale}" placeholder="彩票比例" name="cp_scale">%
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>体育比例：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{$info.sports_scale}" placeholder="体育比例" name="sports_scale">%
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>电子比例：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{$info.electron_scale}" placeholder="电子比例" name="electron_scale">%
            </div>
        </div>
       <!-- <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>本地彩票：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{$info.local_cp_scale}" placeholder="电子比例" name="local_cp_scale">%
            </div>
        </div>-->

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