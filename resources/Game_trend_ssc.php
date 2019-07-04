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
<section class="<!--container--> pt-10 pb-10" id="gamepage" >
<div id="tableAndCanvas" style="width:99.5%;margin:0 auto;">
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
            <th height="20" width="80" rowspan="2">期号</th>
            <th colspan="5" width="80" rowspan="2">开奖号码</th>
            <th colspan="10">万位</th>
            <th colspan="10">千位</th>
            <th colspan="10">百位</th>
            <th colspan="10">十位</th>
            <th colspan="10">个位</th>
            <th colspan="10">号码分布</th>
        </tr>
        <tr>
          <th width="20"  height="20">0</th>
          <th width="20"  height="20">1</th>
          <th width="20"  height="20">2</th>
          <th width="20"  height="20">3</th>
          <th width="20"  height="20">4</th>
          <th width="20"  height="20">5</th>
          <th width="20"  height="20">6</th>
          <th width="20"  height="20">7</th>
          <th width="20"  height="20">8</th>
          <th width="20"  height="20">9</th>

            <th width="20"  height="20">0</th>
            <th width="20"  height="20">1</th>
            <th width="20"  height="20">2</th>
            <th width="20"  height="20">3</th>
            <th width="20"  height="20">4</th>
            <th width="20"  height="20">5</th>
            <th width="20"  height="20">6</th>
            <th width="20"  height="20">7</th>
            <th width="20"  height="20">8</th>
            <th width="20"  height="20">9</th>

            <th width="20"  height="20">0</th>
            <th width="20"  height="20">1</th>
            <th width="20"  height="20">2</th>
            <th width="20"  height="20">3</th>
            <th width="20"  height="20">4</th>
            <th width="20"  height="20">5</th>
            <th width="20"  height="20">6</th>
            <th width="20"  height="20">7</th>
            <th width="20"  height="20">8</th>
            <th width="20"  height="20">9</th>

            <th width="20"  height="20">0</th>
            <th width="20"  height="20">1</th>
            <th width="20"  height="20">2</th>
            <th width="20"  height="20">3</th>
            <th width="20"  height="20">4</th>
            <th width="20"  height="20">5</th>
            <th width="20"  height="20">6</th>
            <th width="20"  height="20">7</th>
            <th width="20"  height="20">8</th>
            <th width="20"  height="20">9</th>

            <th width="20"  height="20">0</th>
            <th width="20"  height="20">1</th>
            <th width="20"  height="20">2</th>
            <th width="20"  height="20">3</th>
            <th width="20"  height="20">4</th>
            <th width="20"  height="20">5</th>
            <th width="20"  height="20">6</th>
            <th width="20"  height="20">7</th>
            <th width="20"  height="20">8</th>
            <th width="20"  height="20">9</th>

            <th width="20"  height="20">0</th>
            <th width="20"  height="20">1</th>
            <th width="20"  height="20">2</th>
            <th width="20"  height="20">3</th>
            <th width="20"  height="20">4</th>
            <th width="20"  height="20">5</th>
            <th width="20"  height="20">6</th>
            <th width="20"  height="20">7</th>
            <th width="20"  height="20">8</th>
            <th width="20"  height="20">9</th>
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