{include file="Public/meta" /}
<link rel="stylesheet" type="text/css" href="../Template/admin/resources/ui/lib/bootstrap-Switch/bootstrapSwitch.css" />
<style>
    .border-danger-outline{
        border:1px solid #dd514c;
    }
    .border-success-outline{
        border:1px solid #5eb95e;
    }
    .tabBar1 {border-bottom: 2px solid #19a97b}
    .tabBar1 span {background-color: #e8e8e8;cursor: pointer;display: inline-block;float: left;
        font-weight: bold;height: 30px;line-height: 30px;padding: 0 15px}
    .tabBar1 span.current{background-color: #19a97b;color: #fff}
</style>
<title>计划任务</title>
</head>
<body>
<div class="page-container">
    <p class="c-danger">计划任务由采集开奖服务器执行</p>
    <p class="c-danger">数据库自动备份保留近7天的备份,如需使用自动备份的数据进行还原请联系平台技术人员操作</p>
    <p class="c-danger">为避免同时执行过多计划任务影响数据库效率，同一个小时的计划应该隔开5分钟</p>
    <p class="c-danger">设置更改正常5分钟内生效</p>
    <form action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
        <div class="tabBar cl"><span>常规计划任务</span></div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th bgcolor="#f9f9f9" width="150">项目名称</th>
                <th bgcolor="#f9f9f9">计划开始时间</th>
                <th bgcolor="#f9f9f9">备注</th>
            </tr>
            </thead>
            <tbody>
            <tr class="text-c">
                <th>每日消费赠送活动</th>
                <td>
                    每天：
                <span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_rixiaofei_shi]">
                    {for start="0" end="24"}
                    <option value="{$i}" {if condition="$setlist['jihua_rixiaofei_shi'] eq $i"}selected{/if}>{$i}点</option>
                    {/for}
                </select>
                </span>
                <span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_rixiaofei_fen]">
                    {for start="1" end="60"}
                    <option value="{$i}" {if condition="$setlist['jihua_rixiaofei_fen'] eq $i"}selected{/if}>{$i}分</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>赠送前一天(系统设置->赠送活动)</td>
            </tr>

            <tr class="text-c">
                <th>日亏损赠送活动</th>
                <td>
                    每天：
                <span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_rikuisun_shi]">
                    {for start="0" end="24"}
                    <option value="{$i}" {if condition="$setlist['jihua_rikuisun_shi'] eq $i"}selected{/if}>{$i}点</option>
                    {/for}
                </select>
                </span>
                <span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_rikuisun_fen]">
                    {for start="1" end="60"}
                    <option value="{$i}" {if condition="$setlist['jihua_rikuisun_fen'] eq $i"}selected{/if}>{$i}分</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>赠送前一天(系统设置->赠送活动)</td>
            </tr>

            <tr class="text-c">
                <th>每月消费赠送活动</th>
                <td>
                    每月1号：
                <span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_yuexiaofei_shi]">
                    {for start="0" end="24"}
                    <option value="{$i}" {if condition="$setlist['jihua_yuexiaofei_shi'] eq $i"}selected{/if}>{$i}点</option>
                    {/for}
                </select>
                </span>
                <span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_yuexiaofei_fen]">
                    {for start="1" end="60"}
                    <option value="{$i}" {if condition="$setlist['jihua_yuexiaofei_fen'] eq $i"}selected{/if}>{$i}分</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>赠送上一个月(系统设置->赠送活动)</td>
            </tr>

            <tr class="text-c">
                <th>月亏损赠送活动</th>
                <td>
                    每月1号：
                <span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_yuekuisun_shi]">
                    {for start="0" end="24"}
                    <option value="{$i}" {if condition="$setlist['jihua_yuekuisun_shi'] eq $i"}selected{/if}>{$i}点</option>
                    {/for}
                </select>
                </span>
                <span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_yuekuisun_fen]">
                    {for start="1" end="60"}
                    <option value="{$i}" {if condition="$setlist['jihua_yuekuisun_fen'] eq $i"}selected{/if}>{$i}分</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>赠送上一个月(系统设置->赠送活动)</td>

            </tr>

            <tr class="text-c">
                <th>代理下线会员投注返点发放</th>
                <td>
                    每天：
                <span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_dailifandian_shi]">
                    {for start="0" end="24"}
                    <option value="{$i}" {if condition="$setlist['jihua_dailifandian_shi'] eq $i"}selected{/if}>{$i}点</option>
                    {/for}
                </select>
                </span>
                <span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_dailifandian_fen]">
                    {for start="1" end="60"}
                    <option value="{$i}" {if condition="$setlist['jihua_dailifandian_fen'] eq $i"}selected{/if}>{$i}分</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>发放前一天(系统设置->赠送活动)</td>

            </tr>

            <tr class="text-c">
                <th>数据库库自动备份</th>
                <td>

                    <!--<span class="select-box" style="width:80px">
                    <select class="select" name="jihua[jihua_dbautoback_shi]">
                        {for start="0" end="8"}
                        <option value="{$i}" {if condition="$setlist['jihua_dbautoback_shi'] eq $i"}selected{/if}>{$i}点</option>
                        {/for}
                    </select>
                    </span>-->
                    <span class="c-danger">影响服务器性能已取消</span>
                    <!--每：<span class="select-box" style="width:80px">
                    <select class="select" name="jihua[jihua_dbautoback_fen]">
                        {for start="10" end="121"  step="5"}
                        <option value="{$i}" {if condition="$setlist['jihua_dbautoback_fen'] eq $i"}selected{/if}>{$i}分钟</option>
                        {/for}
                    </select>
                    </span>-->

                </td>
                <td>7天以前的备份数据自动删除</td>

            </tr>

            </tbody>
        </table>

        <div class="tabBar cl"><span>自动清理计划任务</span></div>
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th bgcolor="#f9f9f9" width="150">项目名称</th>
                <th bgcolor="#f9f9f9">保留时间</th>
                <th bgcolor="#f9f9f9">备注</th>
            </tr>
            </thead>
            <tbody>
            <tr class="text-c">
                <th>开奖数据清理</th>
                <td>
                    保留<span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_kaijiang_days]">
                    {for start="1" end="61"}
                    <option value="{$i}" {if condition="$setlist['jihua_kaijiang_days'] eq $i"}selected{/if}>{$i}天</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>最少保留1天的开奖</td>
            </tr>
            <tr class="text-c">
                <th>投注数据清理</th>
                <td>
                    保留<span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_touzhu_days]">
                    {for start="45" end="91"}
                    <option value="{$i}" {if condition="$setlist['jihua_touzhu_days'] eq $i"}selected{/if}>{$i}天</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>最少保留45天</td>
            </tr>
            <tr class="text-c">
                <th>代理佣金数据清理</th>
                <td>
                    保留<span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_fandian_days]">
                    {for start="1" end="61"}
                    <option value="{$i}" {if condition="$setlist['jihua_fandian_days'] eq $i"}selected{/if}>{$i}天</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>最少保留1天</td>
            </tr>
  <!--          <tr class="text-c">
                <th>晋级奖励数据清理</th>
                <td>
                    保留<span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_jinjijiangli_days]">
                    {for start="1" end="61"}
                    <option value="{$i}" {if condition="$setlist['jihua_jinjijiangli_days'] eq $i"}selected{/if}>{$i}天</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>最少保留1天</td>
            </tr>-->
            <tr class="text-c">
                <th>每日加奖数据清理</th>
                <td>
                    保留<span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_fanshui_days]">
                    {for start="1" end="61"}
                    <option value="{$i}" {if condition="$setlist['jihua_fanshui_days'] eq $i"}selected{/if}>{$i}天</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>最少保留1天</td>
            </tr>
            <tr class="text-c">
                <th>账变记录数据清理</th>
                <td>
                    保留<span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_fuddetail_days]">
                    {for start="45" end="91"}
                    <option value="{$i}" {if condition="$setlist['jihua_fuddetail_days'] eq $i"}selected{/if}>{$i}天</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>最少保留45天</td>
            </tr>
            <tr class="text-c">
                <th>会员日志清理</th>
                <td>
                    保留<span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_memlog_days]">
                    {for start="7" end="31"}
                    <option value="{$i}" {if condition="$setlist['jihua_memlog_days'] eq $i"}selected{/if}>{$i}天</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>最少保留7天</td>
            </tr>
            <tr class="text-c">
                <th>管理员日志清理</th>
                <td>
                    保留<span class="select-box" style="width:80px">
                <select class="select" name="jihua[jihua_adminlog_days]">
                    {for start="7" end="31"}
                    <option value="{$i}" {if condition="$setlist['jihua_adminlog_days'] eq $i"}selected{/if}>{$i}天</option>
                    {/for}
                </select>
                </span>
                </td>
                <td>最少保留7天</td>
            </tr>
            </tbody>
        </table>
        <input class="btn btn-success radius size-L btn-block" type="submit" value="保存计划设置">
    </form>







</div>
{include file="Public/footer" /}
<script type="text/javascript">
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-green',
            radioClass: 'iradio-green',
            increaseArea: '20%'
        });
        $.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
    });
</script>
</body>
</html>