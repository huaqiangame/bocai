{include file="Public/meta" /}
<title>优惠活动</title>
</head>
<?php $type= [1=>'注册活动',2=>'首存活动',3=>'充值活动',4=>'展示活动']; $status = [1=>'待审核',2=>'审核通过',3=>'审核不通过']?>
<body>
<div class="page-container">
    <span class="r">
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</span>

    <p>
    <form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
        活动类型：
        <span class="select-box" style="width:100px">
            <select class="select" name="type">
                <option value="" >全部</option>
                <option value="1" {if condition="$Think.get.type eq '1'"}selected{/if}>注册活动</option>
                <option value="2" {if condition="$Think.get.type eq '2'"}selected{/if}>首存活动</option><?php ?>
                <option value="3" {if condition="$Think.get.type eq '3'"}selected{/if}>充值活动</option>
                <option value="4" {if condition="$Think.get.type eq '4'"}selected{/if}>展示活动</option>
            </select>
        </span>
        活动类型：
        <span class="select-box" style="width:100px">
            <select class="select" name="status">
                <option value="" >全部</option>
                <option value="1" {if condition="$Think.get.status eq '1'"}selected{/if}>待审核</option>
                <option value="2" {if condition="$Think.get.status eq '2'"}selected{/if}>审核通过</option><?php ?>
                <option value="3" {if condition="$Think.get.status eq '3'"}selected{/if}>审核不通过</option>

            </select>
        </span>
        <input class="btn btn-primary-outline radius" type="submit" value="查询">
    </form>
    </p>
   
    <div class="mt-5">
        <form method="post" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="80">ID</th>
                    <th width="80">活动标题</th>
                    <th width="30">活动类型</th>
                    <th width="60">会员用户</th>
                    <th width="60">申请时间</th>
                    <th width="60">审核状态</th>
                    <th width="60">操作</th>
                </tr>
                </thead>
                <tbody>
                {volist name="activitieapply" id="vo"}
                <tr class="text-c">
                    <td width="80">{$vo.id}</td>
                    <td width="80">{$vo.title}</td>
                    <td width="60">{$type[$vo['type']]}</td>
                    <td width="60">{$vo.username}</td>
                    <td width="60">{$vo.created_at}</td>
                    <td width="60">{$status[$vo['status']]}</td>
                    <td width="30">
                        {if condition="$vo['status'] eq 1"}
                        <u style="cursor:pointer" class="text-primary" layer-url="{:U('activitystate',['id'=>$vo['id']])}" title="审核活动">
                            <span style="color:red">待审核</span>
                        </u>
                        {elseif condition="$vo['status'] eq 2"/}
                        <span style="color:green">已审核</span>
                        {elseif condition="$vo['status'] eq 3"/}
                        <span style="color:grey">审核不通过</span>
                        {/if}
                        |
                        <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('delapplyactivity',['id'=>$vo['id']])}" href="javascript:;" title="删除">删除</a>
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