 <include file="Public/headermember" />
    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS2__/reset.css">
    <link rel="stylesheet" href="__CSS2__/userInfo.css">
	 <link rel="stylesheet" href="__CSS2__/fanshui.css">
<div class="vip_info clearfix container">
    <include file="Member/side" />
    <div class="pull-right vip_info_pan">
        <div class="vip_info_title">
            自助返水
        </div>
        <div class="vip_info_content">
    <div class="tabbox" style="max-height: 585px;background: #E8E8E8;">
        <div class="fswarp">
            <div class="tabbox-item-title">
                <span class="title-l"><?php echo date('Y-m-d',strtotime('-1 day'))?> 00:00:00 ~ 现在</span>
            </div>
            <div class="tabbox-item-content">
                <table cellpadding="0" cellspacing="0" class="datatable">
                    <tbody><tr>
                        <th>返水日期</th>
                        <th>平台类型</th>
                        <th>可返水金额</th>
                    </tr>
                    <?php $total_amount = 0;
                    if(empty($list)){?>
                        <tr>
                            <td colspan="3">暂无平台返水</td>
                        </tr>
                    <?php }else{

                        foreach ($list as $v){
                            $total_amount += $v['back_amount']; ?>
                            <tr>
                                <td><?php echo date('Y-m-d',$v['back_date_start'])?></td>
                                <td><?php echo $v['game_type']."-".$v['back_comment'];?></td>
                                <td><?php echo $v['back_amount']?></td>
                            </tr>
                        <?php }?>
                    <?php }?>
                    <!--<tr>
                        <td colspan="4">暂无数据</td>
                    </tr>-->
                </tbody></table>
            </div>

            <div class="record-count">
                <div class="count-item">
                    <span class="tit">总计：</span>
                    <span class="val negative" id="sunyi">¥<?php echo $total_amount;?></span>
                </div>
            </div>
            <div class="page" id="page">{$pageshow}</div>
            <div class="fsbtnbox">
                <a class="button button-submit" id="receiveBtn" onclick="receive()">即刻领取</a>
                <a class="button button-refresh" id="refreshBtn" onclick="refresh()">刷新</a>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    var receiveacc = 0;
    function receive() {
        receiveacc++;
        if (receiveacc > 2) {
            alert("请勿频繁点击，10秒后再试");
        } else {
            $.ajax({
                url: "{:U('Member/receive')}",
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    if (data != null) {
                        alert(data.msg);
                    }
                    setTimeout(function () { receiveacc = 0; }, 10000);
                    location.reload();
                }
            });

        }
    }

    function refresh() {
        location.reload();
    }
</script>

 <include file="Public/footer" />