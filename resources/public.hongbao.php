<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>抢红包</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="__CSS__/hongbao/bao.css" rel="stylesheet" type="text/css" />
<script src="__CSS__/hongbao/jquery.js"></script>
<script src="__CSS__/hongbao/loadhb.js"></script>
</head>
<body>
<div id="msg">
<dl>
<dd>×</dd>
<dt><img src="__CSS__/hongbao/bighongbao.png') }}" width="150" height="215" /></dt>
</dl>
<span></span>
</div>
<div class="hongbao"></div>
<div class="banner">
<ul id="scrollobj" onmouseover="_stop()" onmouseout="_start()"></ul>
</div>
<div class="main1">
<div class="cenbox">
<table width="100%" border="0" cellpadding="0" cellspacing="1">
  <tr>
    <td>当天总存款</td>
    <td>可抢次数</td>
    <td>提款要求</td>
    <td>派彩方式</td>
  </tr>
  @foreach($data as $key => $item)
  <tr>
    <td>{{ $item->min_num }}-{{ $item->max_num }}</td>
    <td>{{ $item->times }}</td>
	@if($key == 0)
    <td rowspan="9">1倍流水</td>
    <td rowspan="9">即抢即送（自动到帐）</td>		
	@endif
  </tr>
  @endforeach
</table>
</div>
</div>
<div class="footbox">
<div class="cenbox">
<h1>规则与条款</h1>
<p>1、红包金额分为：8.00、88.00、888.00、8888.00</p>
<p>2、所赠红包仅1倍流水，即可提款</p>
<p>3、抢红包活动仅限当日00:00-23:59内进行，逾期无效</p>
<p>4、部分套利、违反公司条例会员不在赠送名单之内</p>
<p>5、澳门VK集团保留对活动的最终解释权</p>
</div>
</div>
<div class="hidebox"></div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
