{include file="Public/meta" /}
<title>一键返水</title>
<style>
    .input-text{width: 150px;}
    .search-top,.search-top-info{text-align: left;}
    .time-btn{width: 45%}
    .total-btn{width: 48%;}
    .search-top div{float: left;position: relative;}
    .total-btn span{display: inline-block;width: 100px;}
    .auto-back{width: 300px;float: right;margin-left: 20px;}
    .breadcrumb{height: 60px;}
</style>
</head>
<body>
<nav class="breadcrumb">
    <a href="javascript:;"  title=""  class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> </a>&nbsp;&nbsp;&nbsp;
    <a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <p style="margin-bottom: 10px;">
    <form method="get" action="{:U(CONTROLLER_NAME.'/'.ACTION_NAME)}" class="text-c">
        <div class="search-top-info">
            从：<input type="date" name="start" class="input-text" > 到：<input type="date" name="end" class="input-text" >
            用户名：<input class="input-text" type="text"  value="{$Think.get.username}" name="username">
            <input class="btn btn-primary-outline radius" type="submit" value="查询">
            <div class="auto-back">自动返水：</div>
            <input class="btn btn-primary-outline radius" type="button" value="一键返水" style="float: right;margin-left: 10px;">
        </div>
        <div class="search-top" style="margin-top: 10px;margin-bottom: 10px;height: 35px;">
            <div class="time-btn">
                <a class="btn btn-primary-outline radius" href="javascript:void(0);" onclick="search_back_water('today');">今日</a>
                <a class="btn btn-primary-outline radius" href="javascript:void(0);" onclick="search_back_water('yesterday');">昨日</a>
                <a class="btn btn-primary-outline radius" href="javascript:void(0);" onclick="search_back_water('week');">本周</a>
                <a class="btn btn-primary-outline radius" href="javascript:void(0);" onclick="search_back_water('pre_week');">上周</a>
                <a class="btn btn-primary-outline radius" href="javascript:void(0);" onclick="search_back_water('month');">本月</a>
                <a class="btn btn-primary-outline radius" href="javascript:void(0);" onclick="search_back_water('pre_month');" >上月</a>
                <select  class="input-text" name="month">
                    <option>请选择月份</option>
                    {for start="1" end="12"}
                        <option value="{$i}">{$i}月 </option>
                    {/for}
                </select>
            </div>
            <div class="total-btn">
                <label class="btn btn-primary radius">总有效投注</label>:<span class="total_valid_bet">0</span>
                <label class="btn btn-secondary radius">总笔数</label>:<span class="total_bet">0</span>
                <label class="btn  btn-warning radius">总返水金额</label>:<span class="total_amount_bet">0</span>
            </div>
        </div>
    </form>
    </p>
    <div class="mt-5">
        <form method="post" action="">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th>类型</th>
                    <th>游戏平台</th>
                    <th>会员名</th>
                    <th>笔数</th>
                    <th>有效投注金额</th>
                    <th>返水等级</th>
                    <th>返水比例</th>
                    <th>返水金额</th>
                    <th>生成时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                {volist name="list" id="vo"}
                <tr class="text-c">
                    <td>{$vo.back_comment}</td>
                    <td>{$vo.game_type}</td>
                    <td>{$vo.username}</td>
                    <td></td>
                    <td>{$vo.amount}</td>
                    <td>{$vo.level_id}</td>
                    <td>{$vo.back_scale}</td>
                    <td>{$vo.back_amount}</td>
                    <td>{$vo.create_time|date="Y-m-d",###}</td>
                    <td class="td-manage">
                        <a style="text-decoration:none" class="ml-5" layer-url="{:U('rule_edit',['id'=>$vo['id']])}" layer-width="400" layer-height="500"
                           title="修改"><i class="Hui-iconfont">&#xe6df;</i></a>

                        <a style="text-decoration:none" class="ml-5" layer-del-url="{:U('rule_delete',['id'=>$vo['id']])}" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                    </td>
                </tr>
                {/volist}
                </tbody>
            </table>
            <div class="cl pd-5 bg-1 bk-gray mt-20">
                <span class="r">共有数据：<strong>{:count($list)}</strong> 条</span> </div>
        </form>
    </div>
</div>
{include file="Public/footer" /}
</body>
</html>