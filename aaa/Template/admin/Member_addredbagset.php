{include file="Public/meta" /}
<title>添加优惠活动</title>
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/admin/css/fileinput.min.css" />
</head>
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm" enctype="multipart/form-data">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">存款范围：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" required class="input-text" value="{$info.min_num}" placeholder="最小充值金额" name="min_num">
                <input type="text" required class="input-text" value="{$info.max_num}" placeholder="最大充值金额" name="max_num">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">红包次数：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="number" required class="input-text" value="{$info.times}" placeholder="抢红包次数" name="times">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">红包范围：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text"  required class="input-text" value="{$info.min_per}" placeholder="最小红包" name="min_per">
                <input type="text" required class="input-text" value="{$info.max_per}" placeholder="最大红包" name="max_per">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">排序：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{$info.sort}" placeholder="排序" name="sort">
            </div>
        </div>

<!--        <div class="row cl">-->
<!--            <label class="form-label col-xs-4 col-sm-3"> 注册时间：</label>-->
<!--            <div class="formControls col-xs-8 col-sm-9">-->
<!--                <input class="input-text" type="text" style="width:150px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" name="start_at" value="{$info.start_at}"> --->
<!--                <input class="input-text" type="text" style="width:150px;" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})" value="{$info.end_at}" name="end_at">-->
<!--            </div>-->
<!--        </div>-->


        <input type="hidden" class="input-text" value="{$info.id}"  name="id">


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