{include file="Public/meta" /}
<title>会员组限额设置</title>
</head>
<body>
<div class="page-container">
	<form action="" method="post" class="form form-horizontal validate-form" id="AjaxPostForm">
  <div class="tabBar cl"><span>会员组[-{$info.groupname}-]限额设置</span><small>&nbsp;&nbsp;最低投注为0则以玩法设置为准&nbsp;&nbsp;&nbsp;&nbsp;最高投注为0则不限制</small></div>
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                <th width="150" bgcolor="#f9f9f9">玩法名称</th>
                <th bgcolor="#f9f9f9">最低投注</th>
                <th bgcolor="#f9f9f9">最高投注</th>
            </tr>
        </thead>
        <tbody>
            {volist name="getplayers" id="vo"}<tr class="text-c">
                <th>{$vo.title}</th>
                <td>
                <input type="text" name="configs[min_{$vo.playid}]" class="input-text" value="<?php echo $configs['min_'.$vo['playid']];?>" >
                </td>
                <td><input type="text" name="configs[max_{$vo.playid}]" class="input-text" value="<?php echo $configs['max_'.$vo['playid']];?>" ></td>
            </tr>{/volist}

            
        </tbody>
    </table>
	<br>
    <input name="id" type="hidden" value="{$info.groupid}">
    <input class="btn btn-success radius size-L btn-block" value="保存设置" type="submit">
    </form>
</div>
{include file="Public/footer" /}
</body>
</html>