<include file="Public/headermember" />
    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS2__/reset.css">
    <link rel="stylesheet" href="__CSS2__/bankCard.css">
    <link rel="stylesheet" href="__CSS2__/userInfo.css">
<script src="__JS2__/require.js" data-main="__JS2__/homePage"></script>
<div class="vip_info clearfix container">
    <include file="Member/side" />
    <div class="pull-right vip_info_pan">
        <div class="vip_info_title">
            网站公告
        </div>
        <div class="vip_info_content help_right_content ">
            <h4 class="text-center red">{$ggshow.title}</h4>
            <p class="text-center">{$ggshow.oddtime|date="Y-m-d",###}</p>
            <div class="bankcard_item_box clearfix"  style="margin:20px 10px;">
                {$ggshow.content}
            </div>
        </div>
    </div>
</div>
<include file="Public/footer" />
<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">温馨提示</h4>
            </div>
            <div class="modal-body">
                您还未设置提款密码，请先设置提款密码?
                <div>（提款密码用于提现等操作，可保障资金安全）</div>
            </div>
            <div class="modal-footer">
                <a href="setSecurity.html" class="btn btn-default login_btn">确认</a>
                <a href="" class="btn btn-default register_btn">取消</a>
            </div>
        </div>
    </div>
</div>-->
</body>
</html>