{include file="Public/meta" /}
<title>会员返点</title>
</head>
<body>
<article class="page-container">
    <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">

        <input name="fandian_id" type="hidden" value="{$info.fandian_id}">
        <input name="member_id" type="hidden" value="{$user.id}">
        <input name="id" type="hidden" value="{$user.id}">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                {$user.username}
                <input type="hidden" readonly="true" class="input-text" value="{$user.username}" placeholder="用户名" name="user_name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">直播返点：</label>
            <div class="formControls col-xs-6 col-sm-7">
                <input type="text" class="input-text" value="{$info.live}" placeholder="直播返点" name="live">%
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">电子返点：</label>
            <div class="formControls col-xs-6 col-sm-7">
                <input type="text" class="input-text" value="{$info.egame}" placeholder="电子返点" name="egame">%
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">体育返点：</label>
            <div class="formControls col-xs-6 col-sm-7">
                <input type="text" class="input-text" value="{$info.sport}" placeholder="体育返点" name="sport">%
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">彩票返点：</label>
            <div class="formControls col-xs-6 col-sm-7">
                <input type="text" class="input-text" value="{$info.lottery}" placeholder="彩票返点" name="lottery">%
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">棋牌返点：</label>
            <div class="formControls col-xs-6 col-sm-7">
                <input type="text" class="input-text" value="{$info.chess}" placeholder="棋牌返点" name="chess">%
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

</body>
</html>