{include file="Public/meta" /}
<title>真人商户信息管理</title>
</head>
<body>
<nav class="breadcrumb">

<a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	
	<div class="mt-5">
    <form method="post" action="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		
		<tbody>
			
            <tr class="text-c">
			
                <td>AG余额</td>
				<td>{$agBalancet}</td>
				
			</tr>
			 <tr class="text-c">
			
                <td>BBIN余额</td>
				<td>{$bbBalance}</td>
				
			</tr>
           
		</tbody>
	</table>

    </form>
	</div>
</div>
{include file="Public/footer" /}
</body>
</html>