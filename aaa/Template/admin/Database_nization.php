{include file="Public/meta" /}
<title>数据备份同步</title>
</head>
<body id="body-right">
<nav class="breadcrumb">
    <div class="l">
    <a class="btn" layer-alt-url="{:U(CONTROLLER_NAME.'/'.ACTION_NAME,['isgx'=>1])}" href="javascript:;" autocomplete="off">点击重新更新</a>
    </div>
    <div class="r">
		<span class="c-red">自动备份数据库同步成功后在数据库还原里进行还原操作</span>
    </div>

</nav>
<div class="page-container">


    <div class="data-table table-striped">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr>
                    <th width="200">备份名称</th>
                    <th width="80">卷数</th>
                    <th width="80">数据大小</th>
                    <th width="200">备份时间</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
				{volist name="list" id="data"}
                    <tr>
                        <td>{$data.time|date='Ymd-His',###}</td>
                        <td>{$data.part}</td>
                        <td>{$data.size|format_bytes}</td>
                        <td>{$key}</td>
                        <td class="action">
                            <a class="db-nization" linkurl="{:U('nizationgx?time='.$data['time'])}" onclick="nizationdo(this)">同步</a>&nbsp;
                        </td>
                    </tr>
				{/volist}
            </tbody>
        </table>
        <div class="cl pd-5 bg-1 bk-gray mt-20 text-c">
            <div class="pageNav l" style="padding:0">{$page}</div>
            <div class="r">共有数据：<strong>{$totalcount}</strong> 条 </div>
        </div>
    </div>

</div>
{include file="Public/footer" /}
<script type="text/javascript">
function nizationdo(obj){
	$(obj).html("正在发送同步请求...").removeAttr('onclick');;
	//alert($(obj).attr('linkurl'));
	dbimport(obj);
	
}
function dbimport(obj){
	var self = obj, status = ".";
	$.get($(self).attr('linkhref'), success, "json");
		window.onbeforeunload = function(){ return "正在同步备份数据库，请不要关闭！" }
		return false;
	
		function success(data){
			if(data.status){
				if(data.gz){
					data.info += status;
					if(status.length === 5){
						status = ".";
					} else {
						status += ".";
					}
				}
				$(self).parent().prev().text(data.info);
				if(data.part){
					$.get($(self).attr('linkhref'), 
						{"part" : data.part, "start" : data.start}, 
						success, 
						"json"
					);
				}  else {
					window.onbeforeunload = function(){ return null; }
				}
			} else {
				alert(data.info,'alert-error');
			}
		}
}

</script>
</body>
</html>