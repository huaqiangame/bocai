<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$cateinfo.catname} - {:GetVar('webtitle')}线上平台</title>
<meta name="renderer" content="webkit" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/reset.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/layout.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/font-awesome.min.css" />
<script>
var WebConfigs = {
	webtitle:"{$webconfigs.webtitle}",
	kefuthree:"{$webconfigs.kefuthree}",
	ROOT:"__ROOT__",
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

</head>

<body>

<include file="Public/header" />
<section class="container pt-10 pb-10" id="newslist" >
  <section class="cl"> 
		<div class="l catelist">
			<ul>
			<volist name="catelist" id="cats">
				<li><a <if condition="$cats['id'] eq $catid">class="cur"</if> href="{:U('News/lists',['catid'=>$cats['id']])}">{$cats.catname}</a></li>
			</volist>
			</ul>
		</div>
		<div class="r arclist">
			<volist name="arclists" id="arc">
			<div class="arcinfo <if condition="$arc['id'] eq $showid">cur</if>">
				<div class="tit cl"><p class="l">{$arc.title}</p><p class="r" style="color:grey">{$arc.oddtime|date='Y-m-d',###}</p></div>
				<div class="con">{$arc.content}</div>
			</div>
			</volist>
		</div>
	</section>
    
    
</section>

<include file="Public/footer" />
<script>
$(".arcinfo .tit").click(function(){
	$(this).next('div.con').toggle().parents(".arcinfo").siblings(".arcinfo").find('div.con').hide();
	$(this).parents(".arcinfo").addClass('cur').siblings(".arcinfo").removeClass('cur');
})
</script>
</body>
</html>