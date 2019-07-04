{include file="Public/meta" /}
<title>会员资料</title>
<style>
.ziliao p{padding:5px 10px; border-bottom:1px dashed #ccc;}
.ziliao strong{display:block; float:left; width:20%; text-align:right;}
</style>
</head>
<body>
<article class="page-container">

<table class="table table-border table-bordered table-hover table-bg table-sort">
    <tbody>
        <tr>
            <th class="text-r">会员ID</th>
            <td class="text-l">{$info.id}</td>
      </tr>
        <tr>
            <th class="text-r">用户名：</th>
            <td class="text-l">{$info.username}</td>
      </tr>
        <tr>
            <th class="text-r">真实姓名</th>
            <td class="text-l">{$info.userbankname}</td>
      </tr>
        <tr>
            <th class="text-r">手机</th>
            <td class="text-l">{$info.tel}</td>
      </tr>
        <tr>
            <th class="text-r">QQ</th>
            <td class="text-l">{$info.qq}</td>
      </tr>
        <tr>
            <th class="text-r">邮箱</th>
            <td class="text-l">{$info.email}</td>
      </tr>
        <tr>
            <th class="text-r">登陆IP：</th>
            <td class="text-l">
            {$info.loginip}
            &nbsp;&nbsp;登陆地址：{$info.iparea}
            </td>
      </tr>
        <tr>
            <th class="text-r">注册IP：</th>
            <td class="text-l">
            {$info.regip}&nbsp;&nbsp;注册地址：{$info.regip|IParea}
            
            <br>注册时间：{if condition="$info['regtime'] neq 0"}{$info.regtime|date="Y-m-d H:i",###}{else /}~~~{/if}
            &nbsp;&nbsp;注册来源：{$info.source}
            </td>
      </tr>
        <tr>
            <th class="text-r">最后在线时间：</th>
            <td class="text-l">{$info.onlinetime|date="Y-m-d H:i",###}</td>
      </tr>
        <tr>
            <th class="text-r">会员状态：</th>
            <td class="text-l">{if condition="$info['islock'] eq 1"}<span style="color:red">冻结</span>{else /}<span style="color:green">正常</span>{/if}</td>
      </tr>
    </tbody>
</table>
</article>

{include file="Public/footer" /}

</body>
</html>