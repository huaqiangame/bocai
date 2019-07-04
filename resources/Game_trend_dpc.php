<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{$cptitle}开奖走势图 - {:GetVar('webtitle')}线上平台</title>
<meta name="renderer" content="webkit" />
    <link rel="stylesheet" href="__CSS2__/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/reset.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/trend.css" />
    <link rel="stylesheet" href="__CSS2__/icon.css">
    <link rel="stylesheet" href="__CSS2__/header.css">
    <link rel="stylesheet" href="__CSS2__/main.css">
    <link rel="stylesheet" href="__CSS2__/footer.css">
<script>
var WebConfigs = {
	webtitle:"{$webconfigs.webtitle}",
	kefuthree:"{$webconfigs.kefuthree}",
    ROOT : "__ROOT__",
	kefuqq:"{$webconfigs.kefuqq}"
};
</script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
<!--[if lt IE 9]>
<script src="__ROOT__/resources/js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery.history.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/index.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/member.page.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/trend.js"></script>
<include file="Trend/select" />
</head>
<body>
<include file="Public/header" />
<section class="container pt-10 pb-10" id="gamepage" >
<div id="tableAndCanvas">
<div id="dataWrap">

    <div class="selectWay">
        <h2><strong class="l">基本走势图</strong> </h2>
        <div class="l ml-20">
        <span>选择彩种：<select name="selectDate" id="selectlettery" class="text-muted" onChange="MM_jumpMenu('window',this,0)"></select>&nbsp;&nbsp;</span>
        </div>
    </div>

<table class="dataTable" id="chartsTable">
    <thead>
        <tr class="text-c">
            <th height="40" rowspan="2">期号</th>
            <th colspan="3" rowspan="2">开奖号码</th>
            <th colspan="10">开奖号码分布</th>
            <th colspan="3" rowspan="2">大小</th>
            <th colspan="3" rowspan="2">单双</th>
            <th colspan="1" rowspan="2" >组三</th>
            <th colspan="1" rowspan="2">组六</th>
            <th colspan="1" rowspan="2">豹子</th>
            <th colspan="1" rowspan="2">跨度</th>
            <th colspan="1" rowspan="2">直选和值</th>
        </tr>
        <tr>
          <th width="28">0</th>
          <th width="28">1</th>
          <th width="28">2</th>
          <th width="28">3</th>
          <th width="28">4</th>
          <th width="28">5</th>
          <th width="28">6</th>
          <th width="28">7</th>
          <th width="28">8</th>
          <th width="28">9</th>
        </tr>
    </thead>
    <tbody id="cpdata"> 
        {$trendhtml}
    </tbody>

</table>
</div>
</div>
</section>
<include file="Public/footer" />
</body>
</html>