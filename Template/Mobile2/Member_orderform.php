{php}$webheadertitle = '个人报表';{/php}
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="MSUI: Build mobile apps with simple HTML, CSS, and JS components.">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="/favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>{$webheadertitle}</title>

<link rel="stylesheet" href="./Template/Mobile/css/sm.css">
<link rel="stylesheet" href="./Template/Mobile/css/sm-extend.min.css">
<link rel="stylesheet" href="./Template/Mobile/css/reset.css">
<link rel="stylesheet" href="./Template/Mobile/css/theme-red.css">
<script type='text/javascript' src='./Template/Mobile/js/zepto.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/config.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/sm-extend.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/way.min.js' charset='utf-8'></script>
<script type='text/javascript' src='./Template/Mobile/js/common.js' charset='utf-8'></script>
<script type="text/javascript" src="./Template/Mobile/js/member.page.js"></script>
<script type='text/javascript' src='./Template/Mobile/js/orderform.js' charset='utf-8'></script>
<style type="text/css">
      .infinite-scroll-preloader {
        margin-top:-20px;
      }
			.member-pag .r{
				padding: 0;
			}
      </style>
</head>
<body>
<div class="page-group">
      <!-- 你的html代码 -->
      <div class="page">
          {include file="Public/header" /}
          <div class="content" id="page-modal" style="background: #fff;">
  <div class="buttons-tab">
    <a href="#tab1" class="tab-link active button" data-tabid="userbets" onclick="initDownUserBetsList();allDownUserBetsList();">游戏</a>
    <a href="#tab2" class="tab-link button" data-tabid="userfuddetail" onclick="userfuddetail();">账变</a>
    <a href="#tab3" class="tab-link button" data-tabid="lotteryreport" onclick="lotteryreport();">报表</a>
    <a href="#tab4" class="tab-link button" data-tabid="rechargelist" onclick="rechargelist();">充值</a>
    <a href="#tab5" class="tab-link button" data-tabid="withdrawlist" onclick="withdrawlist();">提款</a>
  </div>
  <div class="content-block">
    <div class="tabs">
      <div id="tab1" class="tab active userBetssearchbar">
		<div class="searchbar row">
			<div class="search-input col-33">
				<input class="layriqi starTime date-input-picker" placeholder="开始时间" type="text">
			</div>
			<div class="search-input col-33">
				<input class="layriqi endTime date-input-picker" placeholder="结束时间" type="text">
			</div>
			<div class="search-input col-33">
					{php} $cplist = C('cplist.k3');{/php}
					<select class="lotteryname"><option value="">全部彩种</option>
					{foreach name="cplist" item="cpvo"}
					<option value="{$cpvo.name}">{$cpvo.title}</option>
					{/foreach}
					
					</select>
			</div>
		</div>
		<div class="searchbar row">
			<div class="search-input col-33">
				<select class="state">
					<option value="">订单状态</option>
					<option value="0">未开奖</option>
					<option value="-1">未中奖</option>
					<option value="1">已中奖</option>
					<option value="-2">已撤单</option>
				</select>
			</div>
			<div class="search-input col-33">
				<input class="in-tx-1 trano" placeholder="订单编号" type="text">
			</div>
			<a class="button button-fill button-danger col-33"  onclick="userbets()"><span class="icon icon-search"></span>查询</a>
		</div>
		<div class="list-block media-list" style="padding-top: 0; margin-top: 0">
			<p class="mark">有效投注：<b id="userbets_touzhutotal" style="color:red">0.00</b>
			奖金收入：<b id="userbets_fanjiangtotal" style="color:red">0.00</b>
			盈亏：<b id="userbets_tzyingkuitotal" style="color:red">0.00</b>
			</p>
			<ul id="userbetshistorylist"></ul>
			
		</div>
      </div>
      <div id="tab2" class="tab userfuddetailsearchbar">
		<div class="searchbar row">
			<div class="search-input col-50">
				<input class="layriqi starTime date-input-picker" placeholder="开始时间" type="text">
			</div>
			<div class="search-input col-50">
				<input class="layriqi endTime date-input-picker" placeholder="结束时间" type="text">
			</div>
		</div>
		<div class="searchbar row">
			<div class="search-input col-50">
					{php} $fuddetailtypes = C('fuddetailtypes');{/php}
					<select id="sourceModule"><option value="">全部帐变类型</option>
					{foreach name="fuddetailtypes" item="fudvo" key="fudkey"}
					<option value="{$fudkey}">{$fudvo}</option>
					{/foreach}
					
					</select>
			</div>
			<a class="button button-fill button-danger col-50"  id="userfuddetailbtn" onclick="userfuddetail();"><span class="icon icon-search"></span>查询</a>
		</div>
		<div class="list-block media-list" style="padding-top: 0; margin-top: 0">
			<ul id="accountChange"></ul>
			
		</div>
      </div>
      <div id="tab3" class="tab lotteryReportsearchbar">
		<div class="searchbar row">
			<div class="search-input col-33">
				<input class="layriqi starTime date-input-picker" placeholder="开始时间" type="text">
			</div>
			<div class="search-input col-33">
				<input class="layriqi endTime date-input-picker" placeholder="结束时间" type="text">
			</div>
			<a class="button button-fill button-danger col-33"  id="lotteryreportbtn" onclick="lotteryreport()"><span class="icon icon-search"></span>查询</a>
		</div>
		<div class="list-block media-list" style="padding-top: 0; margin-top: 0">
			<ul id="lotteryReport"></ul>
			
		</div>
      </div>
      <div id="tab4" class="tab saveRecordssearchbar">
		<div class="searchbar row">
			<div class="search-input col-33">
				<input class="layriqi starTime date-input-picker" placeholder="开始时间" type="text">
			</div>
			<div class="search-input col-33">
				<input class="layriqi endTime date-input-picker" placeholder="结束时间" type="text">
			</div>
			<div class="search-input col-33">
				<select name="" class="state">
					<option value="">所有</option>
					<option value="0">正在审核</option>
					<option value="1">已完成</option>
					<option value="-1">取消申请</option>
				</select>
			</div>
		</div>
		<div class="searchbar row">
			<div class="search-input col-50">
				<input class="trano" placeholder="订单编号" type="text">
			</div>
			<a class="button button-fill button-danger col-50"  id="lotteryreportbtn" onclick="rechargelist()"><span class="icon icon-search"></span>查询</a>
		</div>
		<div class="list-block media-list" style="padding-top: 0; margin-top: 0">
			<ul id="saveRecords"></ul>
			
		</div>
      </div>
      <div id="tab5" class="tab withdrawlistsearchbar">
		<div class="searchbar row">
			<div class="search-input col-33">
				<input class="layriqi starTime date-input-picker" placeholder="开始时间" type="text">
			</div>
			<div class="search-input col-33">
				<input class="layriqi endTime date-input-picker" placeholder="结束时间" type="text">
			</div>
			<div class="search-input col-33">
				<select name="" class="state">
					<option value="">所有</option>
					<option value="0">正在审核</option>
					<option value="1">已完成</option>
					<option value="-1">退回申请</option>
				</select>
			</div>
		</div>
		<div class="searchbar row">
			<div class="search-input col-50">
				<input class="trano" placeholder="订单编号" type="text">
			</div>
			<a class="button button-fill button-danger col-50"  id="withdrawlistbtn" onclick="withdrawlist()"><span class="icon icon-search"></span>查询</a>
		</div>
		<div class="list-block media-list" style="padding-top: 0; margin-top: 0">
			<ul id="drawRecords"></ul>
			
		</div>
      </div>
		<div class="member-pag paging"></div>
    </div>
  </div>
	
          </div>
      </div>
  </div>
{include file="Public/footer" /}

  </body>
</html>