{include file="Public/meta" /}
<title>优惠活动</title>
</head>
<body>
<div class="page-container">
    <span class="r">
<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</span>
    <p>
    <div class="mt-5">
        <form method="post" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="80">ID</th>
                    <th width="80">领取用户</th>
                    <th width="30">红包金额</th>
                    <th width="60">领取时间</th>
                    <th width="60">操作</th>
                </tr>
                </thead>
                <tbody>
                {volist name="get_hongbao" id="vo"}
                <tr class="text-c">
                    <td width="80">{$vo.id}</td>
                    <td width="80">{$vo.name}</td>
                    <td width="60">{$vo.money}</td>
                    <td width="60">{$vo.created_at}</td>
                    <td width="30">
                        <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('delhongbao',['id'=>$vo['id']])}" href="javascript:;" title="删除">删除</a>
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

</body>
</html>