{include file="Public/meta" /}
<title>晋级奖励</title>
</head>
<body>
<?php
$_states = [
    '0'=>'未审核',
    '1'=>'已审核',
    '-1'=>'取消申请',
];

?>
<div class="page-container">
    <span class="r">
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</span>

    <p>
    <form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
        状态：<span class="select-box" style="width:100px"><select class="select" name="shenhe">
                <option value="" >全部</option>
                <option value="1" {if condition="$Think.get.shenhe eq '1'"}selected{/if}>已发放</option>
                <option value="0" {if condition="$Think.get.shenhe eq '0'"}selected{/if}>未发放</option>
                <option value="-1" {if condition="$Think.get.shenhe eq '-1'"}selected{/if}>未通过</option>
            </select></span>
        用户名：<input class="input-text" type="text" style="width:150px;" value="{$Think.get.username}" name="username">
        <input class="btn btn-primary-outline radius" type="submit" value="查询">
    </form>
    </p>
    <div class="mt-5">
        <form method="post" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="80">会员ID</th>
                    <th width="80">会员名称</th>
                    <th width="60">晋级前等级</th>
                    <th width="60">晋级后等级</th>
                    <th width="60">晋级积分</th>
                    <th width="60">奖励金额</th>
                    <th width="60">时间</th>
                    <th width="30">状态</th>
                </tr>
                </thead>
                <tbody>
                {volist name="jiangli" id="vo"}
                <tr class="text-c">
                    <td width="80">{$vo.uid}</td>
                    <td width="80">{$vo.username}</td>
                    <td width="60">{$vo.beforegroupname}</td>
                    <td width="60">{$vo.groupname}</td>
                    <td width="60">{$vo.point}</td>
                    <td width="60">{$vo.jlje}元</td>
                    <td width="60">{$vo.oddtime|date='Y-m-d',###}</td>
                    <td width="30">
                        {if condition="$vo['shenhe'] eq 0"}
                        <u style="cursor:pointer;color:red" class="text-primary" layer-url="{:U('jinjishenhe',['id'=>$vo['id']])}" title="会员晋级审核">未审核</u>
                        {elseif condition="$vo['shenhe'] eq 1" /}
                        <span style="color:green">审核通过</span>
                        {elseif condition="$vo['shenhe'] eq -1" /}
                        <span style="color:grey">退回</span>
                        {else /}
                        未知
                        {/if}
                        |
                      <!--  <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('jinjijianglidelete',array('id'=>$vo['id']))}" href="javascript:;" title="删除">删除</a>-->
                    </td>
                </tr>
                {/volist}
                </tbody>
            </table>

            <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
                <div class="r">
                    <div class="pageNav l" style="padding:0">{$page}</div>
                    <div class="r">共有数据：<strong>{$totalcount}</strong> 条 </div>
                </div>
            </div>


        </form>
    </div>
</div>
{include file="Public/footer" /}
<div id="modalwfts" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <p id="myModalLabel">投注内容查看</p><a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
    </div>
    <div class="modal-body">
        <p id="_wfts_remark">
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    </div>
</div>
<script type="text/javascript" src="__ROOT__/Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="__ROOT__/Template/admin/resources/ui/lib/bootstrap-modal/2.2.4/bootstrap-modal.js"></script>
<script>
    $(document).on("click", "[tip-content]", function() {
        var obj       = $(this);
        var content = $(obj).attr('tip-content');
        $("#myModalLabel").text("单号:"+$(obj).attr('trano'));
        $("#_wfts_remark").html(content);
        $("#modalwfts").modal("show");
    });

</script>
</body>
</html>