{include file="Public/meta" /}
<title>数据备份</title>
</head>
<body id="body-right">
<nav class="breadcrumb">
    <div class="l">
       数据库还原
    </div>
    <div class="r">
        <span class="c-red">数据出现严重错误或被误删除重要数据时使用</span>
    </div>

</nav>
<div class="page-container">

    <!-- 应用列表 -->
    <div class="data-table table-striped">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr>
                    <th width="200">备份名称</th>
                    <th width="80">卷数</th>
                    <th width="80">压缩</th>
                    <th width="80">数据大小</th>
                    <th width="200">备份时间</th>
                    <th>状态</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
				{volist name="list" id="data"}
                    <tr>
                        <td>{$data.time|date='Ymd-His',###}</td>
                        <td>{$data.part}</td>
                        <td>{$data.compress}</td>
                        <td>{$data.size|format_bytes}</td>
                        <td>{$key}</td>
                        <td>-</td>
                        <td class="action">
                            <a class="db-import" linkhref="{:U('import?time='.$data['time'])}" onclick="confirmhy('您确认还原数据库吗？',this);">还原</a>&nbsp;
                            <a class="ajax-get confirm" layer-del-url="{:U('del?time='.$data['time'])}">删除</a>
                        </td>
                    </tr>
				{/volist}
            </tbody>
        </table>
    </div>

</div>
    <!-- /应用列表 -->
{include file="Public/footer" /}
<script type="text/javascript">
function confirmhy(msg,obj){
	if(confirm(msg)){
		dbimport(obj);
	}else{
		return false;
	}
	return false;
}
function dbimport(obj){
	var self = obj, status = ".";
	$.get($(self).attr('linkhref'), success, "json");
		window.onbeforeunload = function(){ return "正在还原数据库，请不要关闭！" }
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