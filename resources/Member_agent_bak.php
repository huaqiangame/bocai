<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>代理首页</title>
<meta name="renderer" content="webkit" />
<link rel="stylesheet" type="text/css" href="/resources/css2/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/resources/css2/header.css" />
<link rel="stylesheet" type="text/css" href="/resources/css/reset.css" />
<link rel="stylesheet" type="text/css" href="/resources/css2/reset.css" />
<link rel="stylesheet" type="text/css" href="/resources/css/layout.css" />
<link rel="stylesheet" type="text/css" href="/resources/css/artDialog.css" />
<link rel="stylesheet" type="text/css" href="/resources/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="/resources/css/member.css" />
<link rel="stylesheet" type="text/css" href="/resources/css2/footer.css" />
<link rel="stylesheet" href="/resources/css2/icon.css">
<link rel="stylesheet" type="text/css" href="/resources/css2/listuse.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/base_new.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/style_new.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/swiper.min.css" />
    <link rel="stylesheet" type="text/css" href="__CSS2__/reset.css">
    <link rel="stylesheet" type="text/css" href="__CSS2__/font-awesome.min.css">
    <script type="text/javascript" src="__JS__/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="__JS__/swiper.jquery.min.js"></script>
    <script type="text/javascript" src="__JS__/jquery.ruiValidate.js"></script>
    <script type="text/javascript" src="__JS2__/layer/layer.js"></script>
    <script type="text/javascript" src="__JS2__/way.min.js"></script>
    <script type="text/javascript" src="/resources/main/common.js"></script>
<script>
var WebConfigs = {
	webtitle:"{$webconfigs.webtitle}",
	kefuthree:"{$webconfigs.kefuthree}",
	kefuqq:"{$webconfigs.kefuqq}"
};
</script>
<!--[if lt IE 9]>
<script src="/resources/js/html5shiv.js"></script>
<![endif]-->

</head>

<body  onresize=testFunc();>
<script language=javascript>
function testFunc()
{
var _width=800;//改为你要的网页宽度
var _height=600;//改为你要的网页高度
window.resizeTo(_width,_height);
}
testFunc();
//将这里的 <script> 与 <／script> 及他们之间的代码复制到你的网页上
//记得BODY这个标记里一定要加上 onresize=testFunc(); 这个属性，就像本页的BODY标记一样
//最大化都没用，窗口依然这么大
</script>
<style>
	.zclip{
		right: 47px !important;
    top: 57px !important;
	}
	.zclip embed{
    width: 50px;
    height: 50px;
	}
</style>


<script type="text/javascript" src="/resources/js/way.min.js"></script>
<script type="text/javascript" src="/resources/js/jquery.history.js"></script>
<script type="text/javascript" src="/resources/js2/jquery.zclip.min.js"></script>
<script type="text/javascript" src="/resources/main/common.js"></script>
<script type="text/javascript" src="/resources/main/index.js"></script>
<script type="text/javascript" src="/resources/js/member.page.js"></script>
<script src="/resources/js/laydate/laydate.js" type="text/javascript" ></script>
<script src="/resources/js/jquery-dateFormat.min.js" type="text/javascript"></script>
<script src="/resources/js/echarts-all.js" type="text/javascript"></script>
<script src="/resources/js/macarons.js" type="text/javascript"></script>
<script type="text/javascript" src="/resources/main/agent.js"></script>
<script type="text/javascript" src="/resources/js2/bootstrap.min.js"></script>
<section class="container pt-10 pb-10" id="memberpage" >
    <div class="memberhome">

        <div class="memhome-bottom ml-20 mr-20">
            <div class="memsubnav"></div>
            <div class="mem-main">
                <div class="m-m-cen ym-grid">
                    <div class="mem-agent m-a-one m-m-subnav tab pos-r">
                        <ul class="level2-nav tabHd">
                            <li class="cur">代理首页</li>
                            <li onclick="initAddUser();">开户中心</li>
                            <li onclick="">团队管理</li>
                            <li onclick="allUserList(1);">在线会员</li>
                           <li onclick="initDownUserBetsList();allDownUserBetsList();">游戏记录</li>
                            <li onclick="initAccountChangeList();accountChange();">账变记录</li>
                            <li onclick="initGroupDepositList();groupDeposit();">团队存提款</li>
                            <li onclick="initGroupReportList();groupReport();">团队报表</li>
                           <!-- <li onclick="backwater()">返水记录</li>
							 <li onclick="gongzi()">日工资</li>
							 <li onclick="xiajiqiyue()">下级契约</li>
							 <li onclick="xiajirigongzi()">下级日工资</li>
							 <li onclick="caipiaoqiyue()">彩票契约</li>
							 <li onclick="caipiaobb()">彩票报表</li>
							 <li onclick="zhenrenbb()">真人游戏报表</li>-->
                        </ul>
                        <div class="m-f-cuk m-f-quk tabBd">
                            <div class="tb-imte">
                                <table class="m-a-table">
                                    <tbody>
                                    <tr>
                                        <td>团队：<strong class="sty-h" way-data="downUserNum.totalnum">0</strong>人</td>
                                        <td>代理：<strong class="sty-h" way-data="downUserNum.proxynum">0</strong>人</td>
                                        <td>玩家：<strong class="sty-h" way-data="downUserNum.noproxynum">0</strong>人</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">团队余额：<strong class="sty-h"
                                                                     way-data="downUserNum.totalamount">0</strong>元&nbsp;(不包含自己)
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="m-a-nav-min tab" id="indexAgent">
                                    <div class="m-a-n-hd">
                                        <ul class="subTabHd">
                                            <li class="cur" onclick="initStatistics('lottery');">彩票娱乐</li>
                                        </ul>
                                    </div>
                                    <div class="m-a-n-bd subTabBd">
                                        <div class="">
                                            <div class="sjss">
                                                <a class="zj" href="javascript:;" onclick="indexQuickDate(-3);">最近三天</a>
                                                <a class="zj" href="javascript:;" onclick="indexQuickDate(-7);">最近七天</a>
                                                <a class="zj" href="javascript:;"
                                                   onclick="indexQuickDate(-30);">最近一个月</a>
                                                <span>&nbsp;&nbsp;时间：</span>
                                                <input class="layriqi" type="text" id="indexStartDate"
                                                       onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                       readonly="true">
                                                <span class="zhi">-</span>
                                                <input class="layriqi" type="text" id="indexEndDate"
                                                       onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                       readonly="true">
                                                <a href="javascript:;" class="in-but-l h-32"
                                                   onclick="searchStatistics();">查询</a>
                                            </div>
                                            <div class="ctsj">
                                                <dl>
                                                    <dd><span>充值量</span><b>0</b></dd>
                                                    <dd><span>提现量</span><b>0</b></dd>
                                                    <dd><span>投注量</span><b>0</b></dd>
                                                    <dd><span>派奖量</span><b>0</b></dd>
                                                    <dd><span>活动/反水</span><b>0</b></dd>
                                                </dl>
                                            </div>
                                            <div class="dzxz">
                                                <ul>
                                                    <li><input type="radio" id="cz" value="cz" placeholder=""
                                                               name="indexType" checked="checked"><label for="cz"
                                                                                                         class="checked">充值</label>
                                                    </li>
                                                    <li><input type="radio" id="tx" value="tx" placeholder=""
                                                               name="indexType"><label for="tx">提现</label></li>
                                                    <li><input type="radio" id="tz" value="tz" placeholder=""
                                                               name="indexType"><label for="tz">投注</label></li>
                                                    <li><input type="radio" id="fd" value="fd" placeholder=""
                                                               name="indexType"><label for="fd">返点</label></li>
                                                    <li><input type="radio" id="xz" value="xz" placeholder=""
                                                               name="indexType"><label for="xz">新增用户</label></li>
                                                </ul>
                                            </div>
                                            <div class="sjtu" id="tubiao" style="height:550px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tb-imte" style="display:none">
                                <div class="m-a-nav-min tab">
                                    <div class="m-a-n-hd">
                                        <ul class="tabHd">
                                            <li class="cur">普通开户</li>
                                            <li>链接开户</li>
                                            <li onclick="signuplinkList();">链接管理</li>
                                        </ul>
                                    </div>
                                    <div class="m-a-n-bd tabBd">
                                        <div class="tb-imte cur" style="display: block;">
                                            <div class="m-warm-prompt">
                                                <h5>温馨提示：</h5>
                                                <p>1. 自动注册的会员初始密码为<span class="mark">"123456"</span>。</p>
                                                <p>2. 为提高服务器效率，系统将自动清理注册一个月没有充值，或两个月未登录，并且金额低于10元的账户。</p>
                                                <p>3. 固定推广链接：<span class="mark">http://{$_SERVER['HTTP_HOST']}/Public.register.tgid.<way
                                                                way-data="user.id"></way></span></p>
                                            </div>
                                            <div class="m-a-kaihu">
                                                <dl class="ty-biaodan">
                                                    <dd>
                                                        <span class="tt">开户类别：</span>
                                                        <span>
																	<input id="addUserGeneralAgent" value="1"
                                                                           name="addUserGeneral" checked="checked"
                                                                           type="radio">
																	<label for="addUserGeneralAgent">代理</label>
																</span>
                                                        <span>
																	<input id="addUserGeneralPlayer" value="0"
                                                                           name="addUserGeneral" type="radio">
																	<label for="addUserGeneralPlayer">玩家</label>
																</span>
                                                    </dd>
                                                    <dd>
                                                        <span class="tt">用户名：</span>
                                                        <span><input value="" way-data="addUser.username"
                                                                     onkeyup="checkAddUsername(this);" maxlength="10"
                                                                     type="text"></span>
                                                        <span class="tisp" id="addUserGeneralTipsUsername">&nbsp;&nbsp;4-12位字母或数字,字母开头</span>
                                                    </dd>
                                                    <dd>
                                                        <span class="tt">彩票返点：</span>
                                                        <span><input type="text" value="" way-data="addUser.rebateid"
                                                                     onkeyup="checkAddUserRebate();"
                                                                     maxlength="7"></span>
                                                        <span class="tisp" id="addUserGeneralTipsRebate">（可分配范围 0~<way
                                                                    way-data="addUser.maxRebate">0</way>）</span>
                                                    </dd>
                                                </dl>
                                                <div class="tianjzh">
                                                    <a class="in-but-l w-16" href="javascript:;"
                                                       onclick="addUser();">添加账户</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tb-imte" style="display: none;">
                                            <div class="m-warm-prompt">
                                                <h5>温馨提示：</h5>
                                                <p>1. 生成链接不会立即扣减配额，只有用户使用该链接注册成功的时候，才会扣减配额；请确保您的配额充足，配额不足将造成用户注册不成功！</p>
                                            </div>
                                            <div class="m-a-kaihu">
                                                <dl class="ty-biaodan">
                                                    <dd>
                                                        <span class="tt">开户类别：</span>
                                                        <span>
																	<input id="addSignuplinkAgent" value="1"
                                                                           name="addSignuplink" checked="checked"
                                                                           type="radio">
																	<label for="addSignuplinkAgent">代理</label>
																</span>
                                                        <span>
																	<input id="addSignuplinkPlayer" value="0"
                                                                           name="addSignuplink" type="radio">
																	<label for="addSignuplinkPlayer">玩家</label>
																</span>
                                                    </dd>
                                                    <!--<dd>
                                                        <span class="tt">模版类型：</span>
                                                        <span>
                                                            <input id="addSignuplinkTpl0" value="0" name="addSignuplinkTpl" checked="checked" type="radio">
                                                            <label for="addSignuplinkTpl0">默认模版</label>
                                                        </span>
                                                        <span>
                                                            <input id="addSignuplinkTpl1" value="1" name="addSignuplinkTpl" type="radio">
                                                            <label for="addSignuplinkTpl1">模版1</label>
                                                        </span>
                                                        <span>
                                                            <input id="addSignuplinkTpl2" value="2" name="addSignuplinkTpl" type="radio">
                                                            <label for="addSignuplinkTpl2">模版2</label>
                                                        </span>
                                                        <span>
                                                            <input id="addSignuplinkTpl3" value="3" name="addSignuplinkTpl" type="radio">
                                                            <label for="addSignuplinkTpl3">模版3</label>
                                                        </span>
                                                    </dd>
                                                    -->
                                                    <dd>
                                                        <span class="tt">使用次数：</span>
                                                        <span><input value="" way-data="addSignuplink.times"
                                                                     onkeyup="replaceAndSetPos(this,event,/[^\d]/g,'');"
                                                                     maxlength="5" type="text"></span>
                                                        <span class="tisp">&nbsp;&nbsp;1-100的整数</span>
                                                    </dd>
                                                    <dd>
                                                        <span class="tt">彩票返点：</span>
                                                        <span><input type="text" value=""
                                                                     way-data="addSignuplink.rebateid"
                                                                     onkeyup="checkAddUserRebate();"
                                                                     maxlength="7"></span>
                                                        <span class="tisp" id="addUserGeneralTipsRebate">（可分配范围 0~<way
                                                                    way-data="addUser.maxRebate">0</way>）</span>
                                                    </dd>

                                                </dl>
                                                <a class="in-but-l w-16" href="javascript:;"
                                                   onclick="addSignuplink();">生成链接</a>
                                            </div>
                                        </div>
                                        <div class="tb-imte" id="signuplinkList" style="display: none;">
                                            <table class="mem-biao">
                                                <tbody></tbody>
                                            </table>
                                            <div class="member-pag paging"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tb-imte" id="allUserList" style="display:none">
                                <table class="mem-biao">
                                    <thead>
                                    <tr>
                                        <th colspan="8">
                                            <span>创建时间：</span>
                                            <input type="text" id="userSearchStartTime"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span>-</span>
                                            <input type="text" id="userSearchEndTime"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span>余额：</span>
                                            <input type="text" value="" id="userSearchMinMoney">
                                            <span>-</span>
                                            <input type="text" value="" id="userSearchMaxMoney">
                                            <span>用户名：</span>
                                            <input class="in-tx-1" type="text" value="" id="userSearchLoginname">
                                            <a href="javascript:;" class="in-but-l h-32" onclick="allUserList();">查询</a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<form action="" method="get">
    <div class="tableTips clearfix">
        <div class="fl tableLevel">
            本级：
                        <a href="https://www.julialt.com/user/list?userid=228342&amp;orderby=children_num&amp;sort=desc" style="font-weight:bold;">chy597823</a>                     </div>
        <h3 style="color:#ff6b71;font-size:12px;margin-bottom:10px;font-weight:normal;float:right;">注：可点击标题修改排序</h3>
    </div>
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="grayTable" id="userlistDL">
        <tbody><tr>
            <th><span class="sortBtn1  sort" orderby="username">用户名</span></th>
            <th><span class=" sort" orderby="userpoint">返点</span></th>
            <th><span class="jt_down sort" orderby="children_num">人数</span></th>
            <th><span class=" sort" orderby="availablebalance">个人余额</span></th>
            <th><span class=" sort" orderby="team_balance">团队余额</span></th>
            <th><span class=" sort" orderby="registertime">注册日期</span></th>
            <th><span class=" sort" orderby="lasttime">最后登录</span></th>
            <th width="">操作</th>
        </tr>

                <tr>
            <td><a href="https://www.julialt.com/user/list?frame=show&amp;userid=228342&amp;orderby=children_num&amp;sort=desc">chy597823</a></td>
            <td>7.8%</td>
            <td>1</td>
            <td>0.0000</td>
            <td>0.0000</td>
            <td>2018-11-06</td>
            <td>2018-12-11</td>
            <td class="handle">
                                                <a href="javascript:;" onclick="postMessage(&#39;gameinfo/newgamelist?username=chy597823&#39;,&#39;投注记录&#39;)" class="postMessage"><strong>投注记录</strong></a>
                <a href="javascript:;" onclick="postMessage(&#39;report/selfbankreport?userid=228342&#39;,&#39;账变记录&#39;)" class="postMessage"><strong>账变记录</strong></a>
            </td>
        </tr>
                <tr>
            <td><a href="https://www.julialt.com/user/list?frame=show&amp;userid=282660&amp;orderby=children_num&amp;sort=desc">toiler</a></td>
            <td>0%</td>
            <td>0</td>
            <td>0.0000</td>
            <td>0.0000</td>
            <td>2018-12-11</td>
            <td>2018-12-11</td>
            <td class="handle">
                                <a href="javascript:;" onclick="postMessage(&#39;user/upedituser?uid=282660&#39;,&#39;返点设定&#39;,600,380)"><strong>返点设定</strong></a>
                                                <a href="javascript:;" onclick="postMessage(&#39;gameinfo/newgamelist?username=toiler&#39;,&#39;投注记录&#39;)" class="postMessage"><strong>投注记录</strong></a>
                <a href="javascript:;" onclick="postMessage(&#39;report/selfbankreport?userid=282660&#39;,&#39;账变记录&#39;)" class="postMessage"><strong>账变记录</strong></a>
            </td>
        </tr>
            </tbody></table>
    <div class="list_page">
        <div class="pageinfo">总计 2 个记录,  分为 1 页, 当前第 1 页<span id="tPages">   <strong>1</strong>
 </span>
转至 <script language="javascript">function keepKeyNum(obj,evt){var  k=window.event?evt.keyCode:evt.which; if( k==13 ){ goPage(obj.value);return false; }} function goPage(iPage){if(parseInt(iPage) != iPage){alert("输入整数的页码");return false;} if(parseInt(iPage) < 0){alert("输入正整数的页码");return false;} if( !isNaN(parseInt(iPage)) ) { if(!0){ if( iPage > 1 ){alert("输入页码超出尾页页码");return false; }} window.location.href="/user/list/?number=0.8569804778501982&pn=20&p="+iPage;}}</script><input onkeypress="return keepKeyNum(this,event);" type="text" id="iGotoPage" name="iGotoPage" size="6">页 <input type="button" onclick="javascript:goPage( document.getElementById(&#39;iGotoPage&#39;).value );return false;" class="button" value="GO"></div>
    </div>
</form>
									</tbody>
                                </table>
                                <div class="member-pag paging"></div>
                            </div>
                            <div class="tb-imte" id="allOnlineUserList" style="display:none">
                                <table class="mem-biao">
                                    <thead>
                                    <tr>
                                        <th colspan="8">
                                            <span>创建时间：</span>
                                            <input type="text" id="userOnlineSearchStartTime"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span>-</span>
                                            <input type="text" id="userOnlineSearchEndTime"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span>余额：</span>
                                            <input type="text" value="" id="userOnlineSearchMinMoney">
                                            <span>-</span>
                                            <input type="text" value="" id="userOnlineSearchMaxMoney">
                                            <span>用户名：</span>
                                            <input class="in-tx-1" type="text" value="" id="userOnlineSearchLoginname">
                                            <a href="javascript:;" class="in-but-l h-32"
                                               onclick="allUserList(1);">查询</a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <div class="member-pag paging"></div>
                            </div>
                            <div class="mar-lr20 tb-imte" id="downUserBetsList" style="display:none">
                                <table class="mem-biao">
                                    <thead>
                                    <tr>
                                        <th colspan="12">
                                            <span>下单时间：</span>
                                            <input type="text" id="downUserBetsSearchStartTime"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span>-</span>
                                            <input type="text" id="downUserBetsSearchEndTime"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span>订单号：</span>
                                            <input class="in-tx-1" type="text" value=""
                                                   id="downUserBetsSearchBillno">
                                            <span>期号：</span>
                                            <input class="in-tx-1" type="text" value=""
                                                   id="downUserBetsSearchExpect">
                                            <span>用户名：</span>
                                            <input class="in-tx-1" type="text" value=""
                                                   id="downUserBetsSearchLoginname">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="5">
                                            <span>彩票种类：</span>
                                            <select id="downUserBetsSearchShortName"></select>
                                            <span>彩票状态：</span>
                                            <select id="downUserBetsSearchState">
                                                <option value="">全部</option>
                                                <option value="0">未开奖</option>
                                                <option value="-1">未中奖</option>
                                                <option value="1">已中奖</option>
                                                <option value="-2">已撤单</option>
                                            </select>
                                            <a href="javascript:;" class="in-but-l h-32"
                                               onclick="allDownUserBetsList();">查询</a>
                                        </th>
                                        <th colspan="7" style="text-align: center; font-size:16px;">
                                            <p class="mark">
                                                下注统计
                                                大：<b way-data="allDownUserBetsList.k3hzbig">0.00</b>
                                                小：<b way-data="allDownUserBetsList.k3hzsmall">0.00</b>
                                                单：<b way-data="allDownUserBetsList.k3hzodd">0.00</b>
                                                双：<b way-data="allDownUserBetsList.k3hzeven">0.00</b>
                                            </p>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <div class="member-pag paging"></div>
                            </div>

                            <!-- 帐变记录 -->
                            <div class="mar-lr20 tb-imte" id="accountChange" style="display:none">
                                <table class="mem-biao">
                                    <thead>
                                    <tr>
                                        <th colspan="8">
                                            <span>开始时间：</span>
                                            <input class="layriqi starTime" id="accountChangeStartTime" type="text"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span class="zhi">结束时间：</span>
                                            <input class="layriqi endTime" id="accountChangeEndTime" type="text"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span>用户名：</span>
                                            <input class="in-tx-1" type="text" value=""
                                                   id="accountChangeSearchLoginname">
                                            <span>账变类型：</span>
                                            <select id="sourceModule">
                                                <option value="">全部</option>
                                                <?php $fuddetailtypes = C('fuddetailtypes'); ?>
                                                <foreach name="fuddetailtypes" item="ft" key="fk">
                                                    <option value="{$fk}"
                                                    <if condition="$fk eq $type">selected</if>
                                                    {$ft}</option>
                                                </foreach>
                                            </select>
                                            <a href="javascript:;" class="in-but-l h-32"
                                               onclick="accountChange();">查询</a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <div class="member-pag paging"></div>
                            </div>

                            <div class="mar-lr20 tb-imte" id="groupDeposit" style="display:none">
                                <table class="mem-biao">
                                    <thead>
                                    <tr>
                                        <th colspan="10">
                                            <span>开始时间：</span>
                                            <input class="layriqi starTime" id="groupDepositStartTime" type="text"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span class="zhi">结束时间：</span>
                                            <input class="layriqi endTime" id="groupDepositEndTime" type="text"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span>用户名：</span>
                                            <input class="in-tx-1" type="text" value=""
                                                   id="groupDepositSearchLoginname">
                                            <span>订单号：</span>
                                            <input class="in-tx-1" type="text" value="" id="groupDepositSearchBillNo">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="10">
                                            <span>类型：</span>
                                            <select id="groupDepositType">
                                                <option value="0">充值</option>
                                                <option value="1">提款</option>
                                            </select>
                                            <span>状态：</span>
                                            <select id="groupDepositState">
                                                <option value="">全部</option>
                                                <option value="0">正在处理</option>
                                                <option value="1">审核通过</option>
                                                <option value="-1">取消申请</option>
                                            </select>
                                            <a href="javascript:;" class="in-but-l h-32"
                                               onclick="groupDeposit();">查询</a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <div class="member-pag paging"></div>
                            </div>

                            <div class="mar-lr20 tb-imte" style="display:none">
                                <table class="mem-biao" id="groupReport">
                                    <thead>
                                    <tr>
                                        <th colspan="8">
                                            <span>开始时间：</span>
                                            <input class="layriqi starTime" id="groupReportStartTime" type="text"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span class="zhi">结束时间：</span>
                                            <input class="layriqi endTime" id="groupReportEndTime" type="text"
                                                   onclick="laydate({format:'YYYY-MM-DD',isclear:false});"
                                                   readonly="true">
                                            <span>用户名：</span>
                                            <input class="in-tx-1" type="text" value="" id="groupReportSearchLoginname">

                                            <a href="javascript:;" class="in-but-l h-32" onclick="groupReport();">查询</a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
									
									
									</tbody>
                                </table>
                                <div class="member-pag paging"></div>
                            </div>
                            <div class="mar-lr20 tb-imte" id="backwater" style="display:none">

                            </div>
							<div class="mar-lr20 tb-imte" id="gongzi" style="display:none">							
<div class="title-warp"><span class="title">日工资</span><div class="sub-menu"><span class="active">我的日工资</span><span class="">下级契约</span><span class="">下级日工资</span></div></div>
<div class="rgz_warp" style="padding-top: 60px;">
    <div class="rgzqy_top clearfix">
        <b class="ruletile">我的契约</b>
        <div class="showQynr">
                        <p>◆ <span>规则一</span>：日投注额 ≥ 1元，<!-- 且活跃玩家人数 ≥ 0人， -->日工资 160元/万</p>
                    </div>
        <span class="jt_down_gz showAllRule" style="display: none;">更多<i>∨</i></span>
        
        <!-- <div class="qy_left">
            <h5>日工资契约</h5>
            <p>签订日期：  2018-11-06</p>
            <p>生效日期：  2018-11-06</p>
        </div> 
        <a href="javascript:;" class="mzsm">契约免责声明</a> -->
    </div>
    <form action="https://www.julialt.com/compact/index.php" method="GET" id="search-form">
        <input type="hidden" name="controller" value="compact">
        <input type="hidden" name="action" value="user">
        <input type="hidden" name="orderby" value="create_time">
        <input type="hidden" name="sort" value="desc">
        <div class="gy_search">
            <div class="inlineBlock">
                <label>日期：</label><div class="calendar_input_kuang1"><input type="text" value="2018-12-11" name="starttime" id="starttime"><span class="calendar_icon"></span></div><span class="z">至</span><div class="calendar_input_kuang1"><input type="text" value="2018-12-12" name="endtime" id="endtime"><span class="calendar_icon"></span></div>
            </div>
            <div class="inlineBlock">
                <select name="pstatus" class="select_text" id="gametype">
                    <option value="0" selected="" id="gametype_0">所有状态</option>
                    <option value="1" id="gametype_0">已到账</option>
                    <option value="2" id="gametype_2">未到账</option>
                </select>
            </div>
            <input name="" type="submit" value="查询" class="formCheck">
        </div>
    </form>

    <!--列表-->
    <div class="ylfh_table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th><span class=" betBtn sort" orderby="create_time">日期</span></th>
                <th><span class=" betBtn sort" orderby="bet">团队日投注额</span></th>
                <th><span class=" effective_betBtn sort" orderby="effective_bet">有效投注额</span></th>
                <!--<th><span class=" player_numBtn sort" orderby="player_num">活跃玩家</span></th>-->
                <th>日工资比例</th>
                <th><span class=" total_moneyBtn sort" orderby="total_money">日工资总额</span></th>
                <th><span class=" sub_moneyBtn sort" orderby="sub_money">下级日工资</span></th>
                <th><span class=" self_moneyBtn sort" orderby="self_money">本人日工资</span></th>
                <th>本人状态</th>
            </tr>
            </thead>
            <tbody>
                        <tr><td colspan="9" class="no-records">请选择查询条件之后进行查询</td></tr>
                        <tr class="tr_total">
                <td>本页合计</td>
                <td>0.0000</td>
                <td>0.0000</td>
                <!--<td>&#45;&#45;</td>-->
                <td>--</td>
                <td></td>
                <td></td>
                <td></td>
                <td>--</td>
            </tr>
            <tr class="tr_total">
                <td>总合计</td>
                <td>0.0000</td>
                <td>0.0000</td>
                <!--<td>&#45;&#45;</td>-->
                <td>--</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>--</td>
            </tr>
            </tbody>
        </table>
        <div class="ui-page clearfix">
            <!-- <div class="ui-page-text"><span class="font_yl">绿色</span>数值为用户盈利，<span class="font_ks">红色</span>数值为用户亏损</div> -->
            <div class="pageinfo"></div>
        </div>
        <div class="ylfh_warm-prompt">
            <h6>温馨提示:</h6>
            <p>1.日工资从契约生效日期起算流水，如满足契约要求则在次日可获得日工资；</p>
            <p>2.为了便于统计，日工资金额向下取整，精确到元，例如：计算日工资为201.9元，则实发金额为201元；</p>
            <p>3.所有日工资目前只计算前一日的彩票投注额，不计算真人、老虎机、体育等投注额；</p>
            <p>4.所有日工资每天上午自动发放，无须手动领取；</p>
            <p><strong>5.时时彩龙虎玩法日工资有别于普通日工资，具体差异请联系上级咨询。</strong></p>
        </div>
    </div>
    <!--列表结束-->
</div>
                            </div>
						     <div class="mar-lr20 tb-imte" id="xiajiqiyue" style="display:none">
<div class="mask_list">
<div>加载中，请稍后...</div>
</div>
<div id="subContent_bet_re">
<script>
    $(function(){
        var cycle = $("#cycle").val();
        $("#showcycle").html($("#cycle_"+cycle).html());
        var gamefrom = $("#gamefrom").val();
        $("#showgamefrom").html($("#gamefrom_"+gamefrom).html());
        var gametype = $("#gametype").val();
        $("#showgametype").html($("#gametype_"+gametype).html());

        $("#orderby").change(function(){
            var url = $("#orderby").val();
            window.location.href = url;
        });

    })
</script>
<div class="rgz_popup_bg"></div>
<!--创建契约弹窗-->
<div class="rgz_popup popUp1"><div class="rgz_popup_wrap">
    <span class="jiao_tl"></span><span class="jiao_tr"></span><span class="jiao_bl"></span><span class="jiao_br"></span>
    <h3 class="tit">日工资契约</h3>
    <form action="https://www.julialt.com/compact/create/1" method="post" id="createCompact">
        <div class="rgz_cjqy">
            <div class="item">
                <label class="item_left">用户名：</label>
                <div class="input_rk">
                    <input type="text" id="userNameInput" placeholder="请选择要创建契约的用户" value="">
                    <input type="hidden" id="userIdInput" name="users" value="">
                    <input type="hidden" name="tag" value="create">
                    <div class="valBox"></div>
                    <span class="shenglue">....</span>
                    <i class="xia_sj"></i>
                    <div class="xia_user_list">
                        <div class="user_list_1 check_input">
                            <label class="controlBtn"><span class="no"></span><i>全选</i></label>
                            <span class="delAll">清空 x</span>
                            <a href="javascript:;" class="x_an_submit">关闭</a>
                        </div>
                        <div class="user_list_2 check_input">
                                                    </div>
                        <div class="user_list_3"><span class="qyxts_text">提示：已经创建过契约的下级请在“下级契约列表”内查看</span><!-- <a href="javascript:;" class="x_an_cancel">取消</a> --></div>
                    </div>
                </div>
            </div>
            <!--<div class="item">-->
                <!--<label class="item_left">生效日期：</label>-->
                <!--<div class="input_rk input_time"><input type="text" value="" placeholder="请选择生效日期" name="effect_date" id="starttime1"><i class="icon_rl"></i></div>-->
            <!--</div>-->
            <div class="item2">
                <label>契约内容： <a href="javascript:;" class="add_rule add_rule1">+ 添加规则</a></label>
                <div class="ruleBox-hideInstruction ruleBox1">
                    <div class="rule_tr rule_tr1"><span>规则一</span>：日投注额 ≥<input type="text" value="" name="min_bet[]">元，<!-- 且活跃玩家人数 ≥<input type="text" name="min_player[]" value="">人，-->日工资<input type="text" name="ratio[]" value="">元/万
                        <a href="javascript:;" class="delete_rule delete_rule1"><i class="icon"></i>删除</a></div>
                </div>
                <div class="add_rule_tr"></div>
            </div>
            <div class="check_b">
                <!--<p class="check_text check_input"><input type="checkbox" id="compact2" class="agreeBtnn">我已阅读并同意<a href="javascript:;" class="open_mzPop">契约免责声明</a></p>-->
                <div class="check_box"><a href="javascript:void(0);" onclick="createCompact();" class="an_submit">创建契约</a><a href="javascript:void(0);" class="an_cancel">取消</a></div>
            </div>
        </div>
    </form>
    <a href="javascript:;" class="rgz_popup_close rgz_popup_close1">关闭</a>
</div></div>
<!--创建契约弹窗-->

<!--查看契约弹窗-->
<div class="rgz_popup popUp2"><div class="rgz_popup_wrap">
    <span class="jiao_tl"></span><span class="jiao_tr"></span><span class="jiao_bl"></span><span class="jiao_br"></span>
    <h3 class="tit">日工资契约</h3>
    <div class="rgz_cjqy">
        <div class="item">
            <label class="item_left">用户名：</label>
            <div class="text_rk modify-username"></div>
        </div>
        <div class="item">
            <label class="item_left">生效日期：</label>
            <div class="text_rk modify-edate"></div>
        </div>
        <div class="item2">
            <label>契约内容：</label>
            <div class="ruleBox" id="show-rule">

            </div>
        </div>
        <div class="check_b">
            <div class="check_box">
                <a href="javascript:;" class="an_submit an_submit2 compact-modify">修改契约</a>
                <a href="javascript:;" class="an_cancel compact-cancle" onclick="cancelContract()">取消契约</a>
                <a href="javascript:;" class="an_cancel">关闭</a>
            </div>
        </div>
    </div>
    <a href="javascript:;" class="rgz_popup_close rgz_popup_close2">关闭</a>
</div></div>
<!--查看契约弹窗-->
<!--免责声明弹窗-->
<div class="rgz_popup popUp3"><div class="rgz_popup_wrap">
    <span class="jiao_tl"></span><span class="jiao_tr"></span><span class="jiao_bl"></span><span class="jiao_br"></span>
    <h3 class="tit">契约免责声明</h3>
    <div class="rgz_qymzsm">
        <dl>
            <dt>1.杏耀娱乐“日工资契约”</dt>
            <dd>为保障代理的利益，平台推出“日工资契约”，该协议由上下级代理以自愿为原则签署，并接受平台的监督。上级为下级代理创建契约，下级确认签订后，按照契约内约定的生效日期起算日工资。已签订契约后，双方均不可单方面修改或终止契约，需联系平台处理。</dd>
        </dl>
        <dl>
            <dt>2.服务说明</dt>
            <dd>
                <p>（1）“契约日工资”是上级与下级在平台内部建立的一种日工资约定并由平台代为结算和发放，以保障下级日工资利益。</p>
                <p>（2）当前代理需要与上级签订契约，才可以给下级建立契约并签订。 </p>
                <p>（3）平台彩票日工资每日发放一次，由平台按照契约规则自动发放。</p>
                <p>（4）日工资结算后，可在“日工资-我的日工资、下级日工资”报表内查看日工资总额、下级日工资金额以及本人实际收益，日工资发放后可在“账变报表”内查看相应账变。</p></dd>
        </dl>
        <dl>
            <dt>3.免责声明</dt>
            <dd>
                <p>（1）“契约日工资协议”属于上下级代理之间的协议，一旦签订，代表上下级双方均同意契约内容及本免责声明，并授权平台代为结算及发放日工资。</p>
                <p>（2）平台不鼓励上级代理经由平台外的第三方途径发放日工资，由此出现的纠纷平台不承担任何责任和义务。</p>
                <p>（3）如用户出现对打、套利等行为，平台将立即把该用户列入黑名单，该用户投注将不再计入其本人及上级的日工资流水。</p>
                <p>（4）对于任何违反平台制度及代理利益的行为，平台一旦查实，将有权立即终止其本人及下级的日工资契约，并视情况执行相应处罚。</p>
                </dd>
        </dl>
        <dl>
            <dt>4.最终解释权</dt>
            <dd>关于本平台中所有规则与条款，本平台保留所有最终解释权。</dd>
        </dl>
    </div>
    <a href="javascript:;" class="rgz_popup_close rgz_popup_close3">关闭</a>
</div></div>
<!--免责声明弹窗-->
<div class="rgz_warp">
    <form action="https://www.julialt.com/compact/index.php" method="GET">
        <input type="hidden" name="controller" value="compact">
        <input type="hidden" name="action" value="teamcompact">
        <div class="gy_search">
            <div class="inlineBlock"><label>用户名：</label><input type="text" name="username" id="username" size="16" value="" class="input_user_name inputNospace"></div>
            <!--<div class="inlineBlock">-->
                <!--<label>日期：</label><div class="calendar_input_kuang1"><input type="text" value="2018-12-11" name="starttime" id="starttime"><span class="calendar_icon"></span></div><span class="z">至</span><div class="calendar_input_kuang1"><input type="text" value="2018-12-12" name="endtime" id="endtime"><span class="calendar_icon"></span></div>-->
            <!--</div>-->
            <div class="inlineBlock">
                <select name="pstatus" class="select_text" id="gametype">
                    <option value="0" selected="" id="gametype_0">所有状态</option>
                    <option value="1" id="gametype_0">已签订</option>
                    <!--<option value="2"  id="gametype_2">待签订</option>-->
                    <!--<option value="3"  id="gametype_2">被拒绝</option>-->
                    <option value="4" id="gametype_2">已终止</option>
                    <!-- <option value="5"  id="gametype_2">已取消</option> -->
                    <option value="8" id="gametype_2">已更新</option>
                </select>
            </div>
            <input name="" type="submit" value="查询" class="formCheck">
			<input name="" type="button" value="创建契约" class="set-up_qy">
        </div>
    </form>

    <!--列表-->
    <div class="ylfh_table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th>用户名</th>
                <th>创建日期</th>
                <th>签订时间</th>
                <th>生效日期</th>
                <th width="120">日工资比例</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                                            <tr>
                    <td>toiler</td>
                    <td>2018-12-11</td>
                                            <td>2018-12-11</td>
                                        <td>2018-12-11</td>
                    <td class="ruleRatioTd"><span class="ruleRatio">
                                                    <p class="rule_tr">150.0000元/万</p>
                                                                    </span></td>
                    <!--已签订-->
                        <td><span class="yi">已签订</span></td>
                                        <td><a href="javascript:;" class="lookDetail" onclick="showDetail(282660);">查看</a></td>
                </tr>
                                        </tbody>
        </table>
        <div class="ui-page clearfix">
            <div class="pageinfo">总计 1 个记录,  分为 1 页, 当前第 1 页<span id="tPages">   <strong>1</strong>
 </span>
转至 <script language="javascript">function keepKeyNum(obj,evt){var  k=window.event?evt.keyCode:evt.which; if( k==13 ){ goPage(obj.value);return false; }} function goPage(iPage){if(parseInt(iPage) != iPage){alert("输入整数的页码");return false;} if(parseInt(iPage) < 0){alert("输入正整数的页码");return false;} if( !isNaN(parseInt(iPage)) ) { if(!0){ if( iPage > 1 ){alert("输入页码超出尾页页码");return false; }} window.location.href="/compact/teamcompact/?number=0.8349193383685953&pn=15&p="+iPage;}}</script><input onkeypress="return keepKeyNum(this,event);" type="text" id="iGotoPage" name="iGotoPage" size="6">页 <input type="button" onclick="javascript:goPage( document.getElementById(&#39;iGotoPage&#39;).value );return false;" class="button" value="GO"></div>
        </div>
    </div>
    <!--列表结束-->

    <!--修改契约start-->
    <div class="rgz_popup popUp4"><div class="rgz_popup_wrap">
        <form action="https://www.julialt.com/compact/update/1" method="post" id="modifyCompact">
            <input type="hidden" name="flag" value="modify">
            <input type="hidden" id="userIdInput2" name="users" value="">
            <input type="hidden" id="submitTag" name="tag" value="create">
        <span class="jiao_tl"></span><span class="jiao_tr"></span><span class="jiao_bl"></span><span class="jiao_br"></span>
        <h3 class="tit">日工资契约</h3>
        <div class="rgz_cjqy">
            <div class="item">
                <label class="item_left">用户名：</label>
                <div class="item_r user_name modify-username"></div>
            </div>
            <!--<div class="item">-->
                <!--<label class="item_left" style="width: 110px;">契约生效日期：</label>-->
                <!--<div class="input_rk input_time"><input type="text" value="" name="effect_date" id="starttime2"><i class="icon_rl"></i></div>-->
            <!--</div>-->
            <div class="item2">
                <label>契约内容：<a href="javascript:;" class="add_rule add_rule2">+ 添加规则</a></label>
                <div class="ruleBox-hideInstruction ruleBox2" id="show-rule2">
                    <div class="rule_tr rule_tr2"><span>规则一</span>：日投注额 ≥<input type="text" value="">元，<!-- 且活跃玩家人数 ≥<input type="text" value="">人，-->日工资<input type="text" value="">元/万
                        <a href="javascript:;" class="delete_rule delete_rule2"><i class="icon"></i>删除</a></div>
                    <div class="rule_tr rule_tr2"><span>规则二</span>：日投注额 ≥<input type="text" value="">元，<!-- 且活跃玩家人数 ≥<input type="text" value="">人，-->日工资<input type="text" value="">元/万
                        <a href="javascript:;" class="delete_rule delete_rule2"><i class="icon"></i>删除</a></div>
                </div>
                <div class="add_rule_tr"></div>
            </div>
            <div class="check_b">
                <!--<p class="check_text check_input"><input type="checkbox" id="compact" onclick="checkRead()"><span id="must-check" class="no"></span>我已阅读并同意<a href="javascript:;" class="open_mzPop">契约免责声明</a></p>-->
                <div class="check_box"><a href="javascript:void(0);" onclick="modifyCompact();" class="an_submit"><i class="icon"></i>确定提交</a><a href="javascript:;" class="an_cancel an_cancel4">取消</a></div>
            </div>
        </div>
        <a href="javascript:;" class="rgz_popup_close rgz_popup_close4">关闭</a>
        </form>
    </div>
    </div>
    <!--修改契约end-->
    <div class="ylfh_warm-prompt" style="display: none">
        <h6>温馨提示:</h6>
        <p>1、日工资从契约生效日期起算流水，如满足契约要求则在次日可获得日工资；</p>
        <p>2、日工资契约签订后，将不可自行修改，如需进行修改请联系平台或您的上级；</p>
        <p>3、日工资领取必须同时满足投注金额条件和活跃人数条件，任一条件未满足将无法领取日工资。</p>
    </div>
</div>
<script type="text/javascript">

    var formForce = ''; // 当前表单焦点
    jQuery(document).ready(function() {
        jQuery("#starttime").dynDateTime({
            ifFormat: "%Y-%m-%d",
            daFormat: "%l;%M %p, %e %m,  %Y",
            align: "Bl",
            electric: true,
            singleClick: false,
            button: ".next()", //next sibling
            rangDay : 16,//允许选择前几天
            onSelect:function(){
                var o = this,today,sDay_f,today_s,sDay_s,rangDay_s,rangDay_d,rangDay_f,dayReduce;
                //根据format格式化
                //今天
                today = new Date($("#today").text());
                o.opts.today_f = o.opts.today_f || today;
                //被选择的那一天
                sDay_f = o.date.print(o.opts.ifFormat);
                //获取格林尼治时间到今天的毫秒数
                today_s = Date.parse(o.opts.today_f);
                //获取格林尼治时间到选择那天的毫秒数
                sDay_s = Date.parse(o.date);//获取秒
                //计算出最早一天的毫秒数
                rangDay_s = today_s - o.opts.rangDay*3600*24*1000;
                //转换成标准时间
                rangDay_d = new Date(rangDay_s);
                //根据format格式化输出被允许的指定天数的最早一天
                rangDay_f = rangDay_d.print(o.opts.ifFormat);
                //计算当前选择的那天距离今天的差值
                dayReduce = (today_s-sDay_s)/3600/24/1000;
                //如果超过指定天数
                if(dayReduce > o.opts.rangDay){
                    $.alert("最多只能查询" + o.opts.rangDay + "天的数据");
                    $("#starttime").val(rangDay_f);
                }else{
                    $("#starttime").val(sDay_f);
                }
                $("#starttime").change();
            },
            showOthers: true,
            weekNumbers: true
            //showsTime: true
        });

        jQuery(".starttime table td.day").live("click",function(){
            var start = jQuery("#starttime").val();
            var end = jQuery("#endtime").val();
            checkStartAndEnd(start,end);
        });
        jQuery("#starttime1").dynDateTime({
            ifFormat: "%Y-%m-%d",
            daFormat: "%l;%M %p, %e %m,  %Y",
            align: "Br",
            electric: true,
            singleClick: false,
            button: ".next()", //next sibling
            rangDay : 16,//允许选择前几天
            position:{"left":"382px"},
            onSelect:function(){
                var o = this,today,sDay_f,today_s,sDay_s,rangDay_s,rangDay_d,rangDay_f,dayReduce;
                //根据format格式化
                //今天
                today = new Date($("#today").text());
                o.opts.today_f = o.opts.today_f || today;
                //被选择的那一天
                sDay_f = o.date.print(o.opts.ifFormat);
                //获取格林尼治时间到今天的毫秒数
                today_s = Date.parse(o.opts.today_f);
                //获取格林尼治时间到选择那天的毫秒数
                sDay_s = Date.parse(o.date);//获取秒
                //计算出最早一天的毫秒数
                rangDay_s = today_s - o.opts.rangDay*3600*24*1000;
                //转换成标准时间
                rangDay_d = new Date(rangDay_s);
                //根据format格式化输出被允许的指定天数的最早一天
                rangDay_f = rangDay_d.print(o.opts.ifFormat);
                //计算当前选择的那天距离今天的差值
                dayReduce = (today_s-sDay_s)/3600/24/1000;
                //如果超过指定天数
                if(dayReduce > o.opts.rangDay){
                    $.alert("最多只能查询" + o.opts.rangDay + "天的数据");
                    $("#starttime1").val(rangDay_f);
                }else{
                    $("#starttime1").val(sDay_f);
                }
                $("#starttime1").change();
            },
            showOthers: true,
            weekNumbers: true,
            //showsTime: true
        });

        jQuery("#starttime2").dynDateTime({
            ifFormat: "%Y-%m-%d",
            daFormat: "%l;%M %p, %e %m,  %Y",
            align: "Br",
            electric: true,
            singleClick: false,
            button: ".next()", //next sibling
            rangDay : 16,//允许选择前几天
            position:{"left":"524px"},
            onSelect:function(){
                var o = this,today,sDay_f,today_s,sDay_s,rangDay_s,rangDay_d,rangDay_f,dayReduce;
                //根据format格式化
                //今天
                today = new Date($("#today").text());
                o.opts.today_f = o.opts.today_f || today;
                //被选择的那一天
                sDay_f = o.date.print(o.opts.ifFormat);
                //获取格林尼治时间到今天的毫秒数
                today_s = Date.parse(o.opts.today_f);
                //获取格林尼治时间到选择那天的毫秒数
                sDay_s = Date.parse(o.date);//获取秒
                //计算出最早一天的毫秒数
                rangDay_s = today_s - o.opts.rangDay*3600*24*1000;
                //转换成标准时间
                rangDay_d = new Date(rangDay_s);
                //根据format格式化输出被允许的指定天数的最早一天
                rangDay_f = rangDay_d.print(o.opts.ifFormat);
                //计算当前选择的那天距离今天的差值
                dayReduce = (today_s-sDay_s)/3600/24/1000;
                //如果超过指定天数
                if(dayReduce > o.opts.rangDay){
                    $("#starttime2").val(rangDay_f);
                }else{
                    $("#starttime2").val(sDay_f);
                }
                $("#starttime2").change();
            },
            showOthers: true,
            weekNumbers: true,
            //showsTime: true
        });

        $(".icon_rl").on("click",function(){
            $(".calendar").css("z-index","999")
            $(".calendar").css("left","382px")
            $(".calendar").css("top","212px")
        })
        function checkStartAndEnd(startTime,endTime){
            if(! validateInputDate(startTime) )
            {
                jQuery("#starttime").val('');
                $.alert("时间格式不正确,正确的格式为:2009-06-10");
            }else if( !checkdateInRange(startTime, 16) ) {
                jQuery("#starttime").val('');
                $.alert("目前仅提供查询近16天内的记录！");
            }
            if(endTime != "")
            {
                if(startTime>endTime)
                {
                    $.alert("输入的时间不符合逻辑");
                }
            }
        }
        jQuery("#endtime").dynDateTime({
            ifFormat: "%Y-%m-%d",
            daFormat: "%l;%M %p, %e %m,  %Y",
            align: "Br",
            electric: true,
            singleClick: false,
            button: ".next()", //next sibling
            onUpdate:function(){
                $("#endtime").change();
            },
            showOthers: true,
            weekNumbers: true,
            showsTime: true
        });
        jQuery("#endtime").change(function(){
            jQuery("#recentproject").attr('value','0');
            if(! validateInputDate(jQuery("#endtime").val()) )
            {
                jQuery("#endtime").val('');
                $.alert("时间格式不正确,正确的格式为:2009-06-10");
            }
            if($("#starttime").val()!="")
            {
                if($("#starttime").val()>$("#endtime").val())
                {
                    $("#starttime").val("");
                    $.alert("输入的时间不符合逻辑.");
                }
            }
        });
    });
    $(".set-up_qy").on("click",function(){
        formForce = 'createCompact';
        $(".rgz_popup_bg").show();
        $(".popUp1").slideDown(200);

    })
    $(".an_cancel").on("click",function(){
        $(".rgz_popup_bg").hide();
        $(".popUp1,.popUp2").slideUp(200);

    })

    $(".xia_sj").on("click",function(){
        $(".xia_user_list").show()
        $(".user_list_1 .controlBtn").show()
    })
    $(".delAll").on("click",function(){
        $(".input_rk").find("input").val("")
        $(".valBox").html("").hide()
        $(".user_list_2").find("span").removeClass("yes").addClass("no");
        $(".user_list_2").find("label").removeClass("hideName").addClass("showName");
        if($(".controlBtn").hasClass('quanxuan')){
            $(".controlBtn").addClass("cancel_quanxuan").removeClass("quanxuan")
            $(".controlBtn").find("span").removeClass("yes").addClass('no')
            $(".controlBtn").find("span").next("i").html("全选")
            $(".user_list_2").find("span").removeClass("yes").addClass("no")
        } 
        html = $(".valBox").html()
        uid = $("#userIdInput").val()
        showHide()
        changeColor()
        changeFont()
    })
    var point = 0
    $(".controlBtn").on("click",function(){
        if($(this).hasClass("quanxuan")){
            $(this).addClass("cancel_quanxuan").removeClass("quanxuan")
            $(".controlBtn").find("span").removeClass("yes").addClass('no')
            $(".controlBtn").find("span").next("i").html("全选")
            $(".user_list_2").find("span").removeClass("yes").addClass("no")
            html = ""
            $(".x_an_submit").html("关闭")
        }else{
            $(this).addClass("quanxuan").removeClass("cancel_quanxuan") 
            $(".controlBtn").find("span").removeClass("no").addClass('yes')
            $(".controlBtn").find("span").next("i").html("全选")
            $(".user_list_2").find("span").removeClass("no").addClass("yes")
            $(".valBox").val("")
            $(".x_an_submit").html("选好了")
        }  
        changeColor()
    })
   
    function changeColor(){
        $(".user_list_2").find(".no").next("i").css("color","#5c93fd")
        $(".user_list_2").find(".yes").next("i").css("color","#ffffff")
    }
    $(".x_an_submit").on("click",function(){
        if($(this).html() == '选好了'){ 
            $(".valBox").show()
        }
        $("#userNameInput").val('')
        var val = ""
        var uid = ""
        var num = 0
        var t = 0
        var htmlVal = ""
        var obj = $(".user_list_2").find("span")
        $.each(obj,function(index){
            if($(this).hasClass("yes")){
                t++
                if(t == $(".user_list_2").find(".yes").length){
                    // val = val + $(this).siblings('i').html()
                    uid = uid + $(this).siblings('i').attr('userid')
                    htmlVal = htmlVal +" " + "<span><a href='javascript:;' data-id="+$(this).siblings('i').attr('userid')+">"+$(this).siblings('i').html()+"</a><i data-index="+$(this).attr('data-index')+" class='delThis delThis"+$(this).attr('data-index')+"'>x</i></span>"
                }else{
                    // val = val + $(this).siblings('i').html() + ","
                    uid = uid + $(this).siblings('i').attr('userid') + ","
                    htmlVal = htmlVal +" "+"<span><a href='javascript:;' data-id="+$(this).siblings('i').attr('userid')+">"+$(this).siblings('i').html()+"</a><i data-index="+$(this).attr('data-index')+" class='delThis delThis"+$(this).attr('data-index')+"'>x</i></span>"
                }
                num++
            }

        })
        // if(num>0){
        $("#userIdInput").val(uid);
        // $("#userNameInput").val(val)
        $(".valBox").html(htmlVal)
        // }else{
            // $.alert("请选择要创建契约的用户")
        // }
        showHide()
        $(".xia_user_list").hide()
        $(".user_list_1 .controlBtn").show()
        if($("#userNameInput").val()==""){
            $(".user_list_2").find("label").removeClass("hideName").addClass("showName")
        }

    })
    $(".valBox,#userNameInput").on("click",function(event){
        $(".xia_user_list").show()
        $(".user_list_1 .controlBtn").show()
        changeFont()
    })
    $(".valBox").on("click",function(){
        point++
        if($(this).find("span").length<1){
            $(this).hide()
        }
        changeFont()
    })
    var html = $(".valBox").html()
    var uid = $("#userIdInput").val()
    for(var l=0; l<$(".user_list_2").find("label").length; l++){
        $(".user_list_2").find("label").eq(l).on("click",function(){
            var thisIndex = $(this).index()
            if($(this).find("span").hasClass("yes")){
                $(this).find("span").removeClass("yes").addClass("no")
                $(".delThis"+thisIndex).trigger("click")
                var uidyes = ""
                for(m = 0; m<$(".user_list_2").find(".yes").length; m++){
                    if($(".user_list_2").find(".yes").length<2){
                        uidyes = uidyes + $(".user_list_2").find(".yes").next("i").attr("userid")
                    }else{
                        uidyes = uidyes + "," + $(".user_list_2").find(".yes").next("i").attr("userid")
                    }  
                }
                $("#userIdInput").val(uidyes);
                uid = $("#userIdInput").val()
                html = $(".valBox").html()
            }else{
                $(this).find("span").removeClass("no").addClass("yes")
                var userid = $(this).find("i").attr("userid")
                var dataIndex = $(this).find("span").attr("data-index")
                uid = $("#userIdInput").val();
                if($(".valBox").find("span").length<1){
                    uid = uid + $(this).find('i').attr('userid')
                }else{
                    uid = uid + "," + $(this).find('i').attr('userid')
                }
                html = html + " " + "<span><a href='javascript:;' data-id="+userid+">"+$(this).find("i").html()+"</a><i data-index="+dataIndex+" class='delThis delThis"+dataIndex+"'>x</i></span>"
               $(".valBox").html(html).show()
               $("#userIdInput").val(uid);
            }
           changeColor()
           showHide()
           changeFont()
        })
    }
    function showHide(){
        if($(".valBox").find("span").length>7){
            $(".shenglue").show()
        }else{
            $(".shenglue").hide()
        }
    }
    function changeFont(){
        if($(".valBox").find("span").length<1){
            $(".x_an_submit").html("关闭")
        }else{
            $(".x_an_submit").html("选好了")
        }
    }
  //点击小标自动去除相应用户名前面的勾选
    $(".valBox").on("click",".delThis",function(){
        var thisIndex = $(this).attr("data-index")
        $(this).parent("span").remove()
        html = $(".valBox").html()
        uid = $("#userIdInput").val()
        $(".span"+thisIndex).removeClass("yes").addClass("no")
        var aHtml = ""
        var aDataId = ""
        $.each($(".valBox").find("a"),function(){
            aHtml = aHtml + $(this).html()+","
            aDataId = aDataId + $(this).attr("data-id") + ","
        })
        aHtml = aHtml.substring(0,aHtml.length-1)
        aDataId = aDataId.substring(0,aDataId.length-1)
        // $("#userNameInput").attr("value",aHtml)
        $("#userIdInput").attr("value",aDataId)
        if($(this).parent("span").length<1){
            $(".valBox").hide()
        }else{
            $(".valBox").show() 
        }
        changeColor()
        changeFont()
        showHide()
    })
    //模糊搜索
    $("#userNameInput").on("keyup",function(){
        var $this = $(".activeLi") 
        var inputVal = $(this).val()
        if(inputVal != "" ){
            $(".user_list_1 .controlBtn").hide()
            $(".user_list_2").find("label").addClass("hideName")
            var hidVal = $(".user_list_2").find("i")
            var _html =""
            var num = 0
            var reg = new RegExp(inputVal)
            $.each(hidVal,function(){
                if($(this).html().match(reg)){
                    $(this).parents("label").removeClass("hideName").addClass("showName")
                }else{
                    $(this).parents("label").removeClass("showName").addClass("hideName")
                }
            })
        }else{
            $(".user_list_1 .controlBtn").show()
            $(".user_list_2").find("label").removeClass("hideName").addClass("showName")
        }
                    
    })

    $("#userNameInput").on("focus",function(){
        if($(this).val()==""){
            $(".user_list_1 .controlBtn").show()
        }else{
            $(".user_list_1 .controlBtn").hide()
        }
    })
 
    //删除规则
    function changeN(outBox,row){
		var rule = $("."+outBox).find("."+row).find("span")
    	var bign = ""
    	$.each(rule,function(index){
    		index = index+1
    		if(index==1){
				bign = "一"
			}else if(index==2){
				bign = "二"
			}else if(index==3){
				bign = "三"
			}else if(index==4){
				bign = "四"
			}else if(index==5){
				bign = "五"
			}else if(index==6){
				bign = "六"
			}else if(index==7){
				bign = "七"
			}else if(index==8){
				bign = "八"
			}else if(index==9){
				bign = "九"
			}else if(index==10){
				bign = "十"
			}else{
				$.alert("您添加的规则已经到达上限")
			}
    		$(this).html("规则"+bign)
    	})
    }
    $(".ruleBox1").on("click",".delete_rule1",function(){
        if($(".rule_tr1").length!=1){
            $(this).parent(".rule_tr").remove()
        }else{
            $.alert("最少保留一条规则")
        }
        changeN("ruleBox1","rule_tr1")
    })
    $(".ruleBox2").on("click",".delete_rule2",function(){
        if($(".rule_tr2").length!=1){
            $(this).parent(".rule_tr").remove()
        }else{
            $.alert("最少保留一条规则")
        }
        changeN("ruleBox2","rule_tr2")
    })
    //添加规则
    function addRule(ruleBox,row,del){
        var rule = $("."+ruleBox).find("."+row)
        var bign = ""
        $.each(rule,function(index){
            index = index+2
            if(index==1){
                bign = "一"
            }else if(index==2){
                bign = "二"
            }else if(index==3){
                bign = "三"
            }else if(index==4){
                bign = "四"
            }else if(index==5){
                bign = "五"
            }else if(index==6){
                bign = "六"
            }else if(index==7){
                bign = "七"
            }else if(index==8){
                bign = "八"
            }else if(index==9){
                bign = "九"
            }else if(index==10){
                bign = "十"
            }else if(index==11){
                bign = "十一"
            }
        })
        var bodyHeight = $("body").height();
        //设置父级ifarme高度
        $("#mainFrame").setHeight({height:bodyHeight});
        if(bign=="十一"){
 			$.alert("规则已到达上限")
        	return false
        }else{
        	$("."+ruleBox).append('<div class="rule_tr '+row+'"><span>规则'+bign+'</span>：日投注额 ≥<input type="text" value="" name="min_bet[]">元，<!-- 且活跃玩家人数 ≥<input type="text" name="min_player[]" value="">人，-->日工资<input type="text" name="ratio[]" value="">元/万<a href="javascript:;" class="delete_rule '+del+'"><i class="icon"></i>删除</a></div>')
        }
    	

    }
    $(".add_rule1").on("click",function(){
        addRule("ruleBox1","rule_tr1","delete_rule1")
        $(".rule_tr1").last().find("input").focus()
    })
    $(".add_rule2").on("click",function(){
        addRule("ruleBox2","rule_tr2","delete_rule2")
        $(".rule_tr2").last().find("input").focus()
    })
    $(".open_mzPop").on("click",function(){
        $(".rgz_popup_bg").show();
        $(".popUp3").slideDown(200);
    })
    $(".rgz_popup_close1").on("click",function(){
        $(".popUp1").slideUp(200);
        $(".rgz_popup_bg").hide();
    })
    $(".rgz_popup_close2").on("click",function(){
        $(".popUp2").slideUp(200);
        $(".rgz_popup_bg").hide();
    })
    $(".rgz_popup_close3").on("click",function(){
        $(".popUp3").slideUp(200);
    })
    $(".lookDetail").on("click",function(){

    })
    $(".an_submit2").on("click",function(){
        formForce = 'modifyCompact';
        $(".popUp4").slideDown(200);
        $(".popUp2").slideUp(200);
        $(".rgz_popup_bg").show();
    })
    $(".rgz_popup_close4,.an_cancel4").on("click",function(){
        $(".popUp4").slideUp(200);
        $(".rgz_popup_bg").hide();
    })
    $(".agreeBtn").on("click",function(){
        if($(this).hasClass("yes")){
            $("#compact2").removeAttr('checked', 'checked');
            $(this).removeClass("yes").addClass('no')
        }else{
            $("#compact2").attr('checked', 'checked');
            $(this).removeClass("no").addClass("yes")
        }
    })


    function createCompact(){
        var read = $("#compact2").attr("checked");
        var uid = $("#userIdInput").val()
        var timeVal = $("#starttime1").val()
        if(uid==""){
            $.alert('请选择要创建契约的用户')
            return false;
        }
        if(timeVal==""){
            $.alert('请选择生效日期')
            return false;
        }
/*        if (!read) {
            $.alert('请阅读并同意契约免责声明');
            return false;
        }*/

        if(checkRule() == 1){
            $("#createCompact").submit();
        }
    }

    function modifyCompact(){
/*        var read = $("#compact").attr("checked");
        if (!read) {
            $.alert('请阅读并同意契约免责声明');
            return false;
        }*/

        if(checkRule() == 1){
            $("#modifyCompact").submit();
        }
        return true;
    }
    var contractId = 0;
    function showDetail(userid){
        $.get('/compact/ajaxhub/1/contract?userid='+userid, function(data){
            var data = JSON.parse(data);
            var info = data.data;
            if(data.status == 0){
                $.alert(data.msg);
                return false;
            }else{
                contractId = info.id;
                $("#userIdInput2").val(userid);
                $("#starttime2").val(info.effect_date);
                $(".modify-username").html(info.username);
                $(".modify-edate").html(info.effect_date);

                if (info.status == '8') {
                    $(".modify-edate").html(info.effect_date + '（已更新）');
                }

                $("#submitTag").attr('value', 'create');
                $(".compact-cancle").show();
                $(".compact-modify").show();

                // 已签约
                if (info.status == '1' || info.status == '8') {
                    $(".compact-cancle").hide();
                    $("#submitTag").attr('value', 'upgrade');
                } else if(info.status != '2') {//待签约
                    $(".compact-cancle").hide();
                }

                var ruleStr = '';
                var ruleStr2 = '';

                $("#show-rule").html('');
                $("#show-rule2").html('');
                $.each(info.rule, function(index, rule){
                    var ruleNum = numberMap(rule.level),
                        minBet = parseInt(rule.min_bet),
                        minPlayer = parseInt(rule.min_player),
                        ratio = parseInt(rule.ratio);

                    ruleStr2 = '<div class="rule_tr rule_tr2"><span>规则'+ruleNum+'</span>：日投注额 ≥<input type="text" name="min_bet[]" value="'+minBet+'">元，<!-- 且活跃玩家人数 ≥<input type="text" name="min_player[]" value="'+minPlayer+'">人，-->日工资<input type="text" name="ratio[]" value="'+ratio+'">元/万<a href="javascript:;" class="delete_rule delete_rule2"><i class="icon"></i>删除</a></div>';

                    ruleStr = "<div class='rule_tr'><span>规则"+ruleNum+"</span>：日投注额 ≥"+minBet+" 元，<!-- 且活跃玩家人数 ≥"+minPlayer+"人，-->日工资"+ratio+"元/万</div>";
                    $("#show-rule").append(ruleStr);
                    $("#show-rule2").append(ruleStr2);
                });

                $(".popUp2").slideDown(200);
                $(".rgz_popup_bg").show();
            }
        });
    }

    function checkRule() {
        var checkResult = 0;
        $.ajax({
            url: '/compact/ajaxhub/1/checkrule',
            data: $('#'+formForce).serialize(),
            type: 'POST',
            dataType: 'json',
            async: false,
            success: function(data){
                checkResult = data.status;
                if(data.status == 0){
                    $.alert(data.msg);
                }else if(data.status == 10001){
                    $.alert(data.message);
                }
            },
            error: function(resp){
                $.alert('表单参数验证失败'+resp);
            }
        });

        return checkResult;
    }

    $("#must-check").toggle(
        function(){
            $(this).attr('class', 'yes');
            $("#compact").attr('checked', 'checked');
        },
        function(){
            $(this).attr('class', 'no');
            $("#compact").removeAttr('checked', 'checked');
        }
    );

    function cancelContract(){
        $.confirm('确定取消该契约？', function(){
            window.location.href = '/compact/cancel/'+contractId;
        });
    }

    function numberMap(num){
        var numArr = ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十'];
        return numArr[num-1];
    }
    
    //  $(".user_list_2").find("label").on("click",function(){
    //     $("#userNameInput").val("")
    //     $("#userNameInput").attr("placeholder","继续选择或提交")
    //     if($(this).find("span").hasClass("yes")){
    //         $(this).find("span").removeClass("yes").addClass("no")
    //     }else{
    //         $(this).find("span").removeClass("no").addClass("yes")
    //     }
    //     changeColor()

    // })
</script>
</div>
<div style="clear: both"></div>
<script type="text/javascript">
if(window.top.location.href.indexOf("report")>0){
    $(".tab-first").remove();
  }
</script>
<script type="text/javascript" src="./base.js.下载"></script>
<script>
   window.onload=function(){
        // if(window.top.IFRAME_MODAL_OPENING){ 
        //     return;
        // }

        var bodyHeight = $("body").height();
        //设置父级ifarme高度
        jQuery("#mainFrame").setHeight({height:bodyHeight});
        //获取Url标题base.js中
        jQuery(".topContent ul li a").html(jQuery.getUrlParam("tit"));
        //如果有图片

        if(window.top.VERSION != 'X'){ 
            //document.write("WHAT ARE U DOING!")
        }
    }

    $(function(){
        //页码处理
        /*var len = $('.pageinfo > *').length;
        $('.pageinfo > *').each(function(i,v){
          var txt = $(v).text();
          if(i >= len - 2 && isNaN(txt))$(v).addClass('last-two');
        });*/

        //报表所有页面 搜索时 输入用户名 去掉前后空格
        $('.inputNospace').blur(function(){ 
            $(this).val($(this).val().replace(/\s*/g,''))
        })
        //声音开关
        $("#soundCtl").click(function(){
            _sound._soundCtl();
            changeClass();
        });

        //根据cookie设置class
        function changeClass(){
            if(_sound._checkCookie()){
                $("#soundCtl").removeClass().addClass('soundon');
            }else{
                $("#soundCtl").removeClass().addClass('soundoff');
            }
        }

    });

    function postMessage(url,title,width,height,modal){ 
      var width = width || 1040;
      var height = height || 580;
      if(typeof(url) == "object"){return}
      var modal = modal || 'show_modal';
        window.top.postMessage({
            action: modal,
            title: title,
            url: url,
            width: width,
            height: height
        }, '*')
    }

</script>
                            </div>
							 <div class="mar-lr20 tb-imte" id="xiajirigongzi" style="display:none">
							 <div class="rgz_warp">
    <form action="https://www.julialt.com/compact/teamsalary" method="GET" id="search-form">
        <input type="hidden" name="orderby" value="create_time">
        <input type="hidden" name="sort" value="desc">
        <div class="gy_search">
            <div class="inlineBlock"><label>用户名：</label><input type="text" name="username" id="username" size="16" value="" class="input_user_name inputNospace"></div>
            <div class="inlineBlock">
                <label>日期：</label><div class="calendar_input_kuang1"><input type="text" value="2018-12-11" name="starttime" id="starttime"><span class="calendar_icon"></span></div><span class="z">至</span><div class="calendar_input_kuang1"><input type="text" value="2018-12-12" name="endtime" id="endtime"><span class="calendar_icon"></span></div>
            </div>
            <div class="inlineBlock">
                <select name="pstatus" class="select_text" id="gametype">
                    <option value="0" selected="" id="gametype_0">所有状态</option>
                    <option value="1" id="gametype_0">已到账</option>
                    <option value="2" id="gametype_2">未到账</option>
                </select>
            </div>
            <input name="" type="submit" value="查询" class="formCheck">
        </div>
    </form>

    <!--列表-->
    <div class="ylfh_table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th><span class="sortBtn1 jt_down sort" orderby="create_time">日期</span></th>
                <th><span class="sortBtn1  sort" orderby="username">用户名</span></th>
                <th><span class="sortBtn2 sort  sort" orderby="bet">日投注额</span></th>
                <th><span class="sortBtn3 sort  sort" orderby="effective_bet">有效投注额</span></th>
                <!--<th><span class="sortBtn4 sort " orderby="player_num">活跃玩家</span></th>-->
                <th>日工资比例</th>
                <th><span class="sortBtn5 sort " orderby="total_money">日工资金额</span></th>
                <th><span class="sortBtn6 sort " orderby="sub_money">下级日工资</span></th>
                <th><span class="sortBtn7 sort " orderby="self_money">个人日工资</span></th>
                <th>个人发放状态</th>
            </tr>
            </thead>
            <tbody>
                                    <tr class="tr">
                <td>2018-12-11</td>
                <td>toiler</td>
                <td class="betVal">0.0000</td>
                <td class="effective_bet">0.0000</td>
                <!--<td class="player_num">0</td>-->
                <td>0元/万</td>
                <td class="total_money">0</td>
                <td class="sub_money">0</td>
                <td class="self_money">0</td>
                                <td><span class="gray">未到账</span></td>
                            </tr>
            
                        <tr class="tr_total">
                <td>本页合计</td>
                <td>--</td>
                <td>0.0000</td>
                <td>0.0000</td>
                <!--<td>&#45;&#45;</td>-->
                <td>--</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>--</td>
            </tr>
            <tr class="tr_total">
                <td>总合计</td>
                <td>--</td>
                <td>0.0000</td>
                <td>0.0000</td>
                <!--<td>&#45;&#45;</td>-->
                <td>--</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>--</td>
            </tr>
            </tbody>
        </table>
        <div class="ui-page clearfix">
            <div class="pageinfo">总计 1 个记录,  分为 1 页, 当前第 1 页<span id="tPages">   <strong>1</strong>
 </span>
转至 <script language="javascript">function keepKeyNum(obj,evt){var  k=window.event?evt.keyCode:evt.which; if( k==13 ){ goPage(obj.value);return false; }} function goPage(iPage){if(parseInt(iPage) != iPage){alert("输入整数的页码");return false;} if(parseInt(iPage) < 0){alert("输入正整数的页码");return false;} if( !isNaN(parseInt(iPage)) ) { if(!0){ if( iPage > 1 ){alert("输入页码超出尾页页码");return false; }} window.location.href="/compact/teamsalary/?orderby=create_time&sort=desc&username=&starttime=2018-12-11&endtime=2018-12-12&pstatus=0&pn=15&p="+iPage;}}</script><input onkeypress="return keepKeyNum(this,event);" type="text" id="iGotoPage" name="iGotoPage" size="6">页 <input type="button" onclick="javascript:goPage( document.getElementById(&#39;iGotoPage&#39;).value );return false;" class="button" value="GO"></div>
        </div>
        <div class="ylfh_warm-prompt" style="display: none;">
            <h6>温馨提示:</h6>
            <p>1. 日工资按有效投注额计算，无效投注的判定标准请咨询平台或您的上级；</p>
            <!--<p>2. 活跃玩家人数统计包括您本人在内，活跃玩家的定义请咨询平台或您的上级；</p>-->
            <p>2. 为了便于统计，日工资金额向下取整，精确到元，例如：计算日工资为201.9元，则实发金额为201元；</p>
            <p>3. 所有日工资目前只计算前一日的彩票投注额，不计算真人、老虎机、体育等投注额；</p>
            <p>4. 所有日工资每天上午自动发放，无须手动领取。</p>
            <p>5. 单挑奖金限制：用户投注如判定为单挑模式，投注盈利（返奖-投注=投注盈利）不可超过3万，低于3万按照原金额赔付。点击查看<a href="javascript:;" class="xxgz">详细规则</a>。</p>
        </div>
    </div>
    <!--列表结束-->
</div>
							 </div>
							 <div class="mar-lr20 tb-imte" id="caipiaoqiyue" style="display:none">
							 <div class="mask_list">
<div>加载中，请稍后...</div>
</div>
<div id="subContent_bet_re">
<div class="rgz_warp">
    <div class="create_msg"></div>
    <form action="https://www.julialt.com/pink/index" method="GET" id="search-form">
        <input type="hidden" name="sort" value="asc">
        <input type="hidden" name="orderby" value="pay_status">
        <div class="gy_search">
            <div class="inlineBlock"><label>用户名：</label><input type="text" name="username" id="username" size="16" value="" class="input_user_name inputNospace"></div>

            <div class="inlineBlock"><label>周期：</label>
                <select name="cycle_id" class="select_text">
                                            <option value="14" selected="">2018-12上</option>
                                            <option value="13">2018-11下</option>
                                            <option value="12">2018-11上</option>
                                            <option value="11">2018-10下</option>
                                            <option value="10">2018-10上</option>
                                            <option value="9">2018-09下</option>
                                            <option value="8">2018-09上</option>
                                            <option value="7">2018-08下</option>
                                            <option value="6">2018-08上</option>
                                            <option value="5">2018-07下</option>
                                    </select>
            </div>
            <div class="inlineBlock"><label>状态：</label>
                <select name="pay_status" class="select_text" id="gametype">
                    <option value="0" selected="" id="gametype_0">所有状态</option>
                                            <option value="2" id="gametype_0">已结清</option>
                                            <option value="1" id="gametype_0">未结清</option>
                                            <option value="4" id="gametype_0">分红取消</option>
                                            <option value="3" id="gametype_0">无分红</option>
                                            <option value="-1" id="gametype_0">无契约/终止</option>
                                    </select>
            </div>
            <input name="" type="submit" value="查询" class="formCheck">
        </div>
    </form>

		<div class="tableTips clearfix" style="font-size:12px; color:#444">
		    <div class="fl tableLevel">
                本人分红
                		    </div>
		    <div class="fr">周期：2018-12上</div>
		</div>

    <div class="ylfh_table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th>活跃</th>
                <th>周期投注额</th>
                <th>盈亏</th>
                <th>分红比例</th>
                <th>本人分红</th>
                <th>下级应发</th>
                <th>结余</th>
                <th>本人状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0</td>
                    <td class="selfId" data-id="">--</td>
                    <td>
                                                    --
                                            </td>
                    <td>--</td>
                                            <td>--</td>
                        <td>--</td>
                        <td>--</td>
                                        <td>
                                                    <span class="moren">无分红</span>
                                                <!--<span class="yi">绿色</span>-->
                        <!--<span class="dai">红色</span>-->
                        <!--<span class="upgrade">默认色</span>-->
                        <!--<span class="moren">灰色</span>-->
                    </td>
                    <td><a href="javascript:;" class="lookDetail" onclick="showDetail(228342,false);">查看契约</a></td>
                </tr>
            </tbody>
        </table>
    </div>

		<div class="tableTips clearfix" style="margin-top:30px; font-size:12px; color:#444">
		    <div class="fl tableLevel">
		        下级分红：<span style="color: #63f">实发0.00元 欠发<font style="color: #f00; font-weight: bold;">0.00</font>元</span>
		    </div>
		    <div class="fr"><font style="color: #f00">请勾选下级并点击"发放"或者直接点击"一键发放"</font>
		    	<a href="javascript:;" class="allSend">一键发放</a>
		    	<a href="javascript:;" class="oneSend">发放</a>
		    </div>
		</div>

    <!--列表-->
    <div class="ylfh_table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
                <th width="30"><input type="checkbox" name="checkbox" class="allChecked"></th>
                <th><span class=" sort" orderby="username">用户名</span></th>
                <th>周期</th>
                <th>活跃</th>
                <th><span class=" sort" orderby="bet">周期投注额</span></th>
                <th><span class=" sort" orderby="profitloss">盈亏</span></th>
                <th>分红比例</th>
                <th><span class=" sort" orderby="self_money">应发分红</span></th>
                <th>账单状态</th>
                <th>操作</th>
            </tr>
          </thead>
          <tbody>
            	                                <tr>
                    <td>
                                                		<input type="checkbox" name="checkbox" disabled="">
                                            </td>
                    <td>toiler</td>
                    <td>2018-12上</td>
                    <td>0</td>
                    <td>0.0000</td>
                    <td>
                                                    --
                                            </td>
                    <td class="ruleRatioTd">--</td>
                    <td>0.0000</td>
                    <td>
                                                    <span class="moren">无分红</span>
                                            </td>
                    <td>
                                                    <a href="javascript:;" class="lookDetail set-up_qy" data-id="282660" data-name="toiler">创建契约</a>
                                            </td>
                </tr>
                            	            	<tr class="tr_total">
                <td>&nbsp;</td>
                <td>本页合计</td>
                <td>--</td>
                <td>--</td>
                <td>0.0000</td>
                <td>
                                        --
                                    </td>
                <td>--</td>
                <td>0.0000</td>
                <td>--</td>
                <td>--</td>
	            </tr>
	            <tr class="tr_total">
                <td>&nbsp;</td>
                <td>总合计</td>
                <td>--</td>
                <td>--</td>
                <td>0.0000</td>
                <td>
                                        --
                                    </td>
                <td>--</td>
                <td>0.0000</td>
                <td>--</td>
                <td>--</td>
            	</tr>
          </tbody>
        </table>
        <div class="ui-page clearfix">
            <div class="pageinfo">总计 1 个记录,  分为 1 页, 当前第 1 页<span id="tPages">   <strong>1</strong>
 </span>
转至 <script language="javascript">function keepKeyNum(obj,evt){var  k=window.event?evt.keyCode:evt.which; if( k==13 ){ goPage(obj.value);return false; }} function goPage(iPage){if(parseInt(iPage) != iPage){alert("输入整数的页码");return false;} if(parseInt(iPage) < 0){alert("输入正整数的页码");return false;} if( !isNaN(parseInt(iPage)) ) { if(!0){ if( iPage > 1 ){alert("输入页码超出尾页页码");return false; }} window.location.href="/pink/index/?number=0.7620464216672584&pn=10&p="+iPage;}}</script><input onkeypress="return keepKeyNum(this,event);" type="text" id="iGotoPage" name="iGotoPage" size="6">页 <input type="button" onclick="javascript:goPage( document.getElementById(&#39;iGotoPage&#39;).value );return false;" class="button" value="GO"></div>
        </div>
        <div class="ylfh_warm-prompt">
            <h6>温馨提示:</h6>
            <p>1.每半月为一个分红周期，上半月周期为每月1日~15日，下半月周期为每月16日至月末；每月1日、16日为分红结算日；</p>
            <p>2.分红结算日，如尚有下级分红未发放完毕，您的账号将暂时冻结投注、提款以及彩票向第三方转账，待您给下级全部发放分红后账户状态将自动恢复；</p>
            <p>3.活跃人数定义规则请咨询上级，统计包括本人；</p>
            <p>4.分红金额向下取整，精确到元；</p>
        </div>
    </div>
    <!--列表结束-->

</div>
	<div class="rgz_popup_bg"></div>
	<!--创建契约弹窗-->
	<div class="rgz_popup popUp1 rgz_popup_create"><div class="rgz_popup_wrap">
	    <span class="jiao_tl"></span><span class="jiao_tr"></span><span class="jiao_bl"></span><span class="jiao_br"></span>
	    <h3 class="tit">分红契约</h3>
	    <form action="https://www.julialt.com/pink/create" method="post" id="createCompact">
	        <div class="rgz_cjqy">
	            <div class="item">
	                <label class="item_left">用户名：</label>
	                <div class="input_rk">
	                	<span id="childname"></span>
	                    <input type="hidden" id="userIdInput" name="userid" value="">
	                </div>
	            </div>
	            <div class="item2">
	                <label>契约内容： <a href="javascript:;" class="add_rule add_rule1">+ 添加规则</a></label>
	                <div class="ruleBox ruleBox1">
                        <!--，可获得分红 <input type="text" name="ratio[]" value="" maxlength="4" class="ruleinput1">%-->
                        <div class="rule_tr rule_tr1"><span>规则一</span>：分红比例 <select name="ratio[]"><option value="1">1%</option><option value="2">2%</option><option value="3">3%</option><option value="4">4%</option><option value="5">5%</option><option value="6">6%</option><option value="7">7%</option><option value="8">8%</option><option value="9">9%</option><option value="10">10%</option><option value="11">11%</option><option value="12">12%</option><option value="13">13%</option><option value="14">14%</option><option value="15">15%</option><option value="18">18%</option><option value="20">20%</option><option value="23">23%</option><option value="25">25%</option></select>，周期累计投注额 ≥ <input onkeyup="keyUp(this)" class="rgz_popup_create_input" type="text" value="" name="profit[]" maxlength="8">元，且活跃人数 ≥ <input onkeyup="keyUp(this)" class="rgz_popup_create_input" type="text" value="" name="people[]" maxlength="3">人
	                        <a href="javascript:;" class="delete_rule delete_rule1"><i class="icon"></i>删除</a></div>
	                </div>
	                <div class="add_rule_tr"></div>
	            </div>
	            <div class="check_b">
	            		<div style="color: #f00; line-height: 24px; font-size: 14px; margin-top: 10px;">
	                	<p>说明:</p>
	                	<p>● 分红周期指每月1-15日, 16日-月末;</p>
	                	<p>● 契约方案请按照从低至高顺序填写;</p>
	                	<p>● 契约创建成功后立即生效, 本分红周期统计完整投注额;</p>
	            		</div>
	                <div class="check_box"><a href="javascript:void(0);" onclick="createCompact();" class="an_submit">创建契约</a><a href="javascript:void(0);" class="an_cancel">取消</a></div>
	            </div>
	        </div>
	    </form>
	    <a href="javascript:;" class="rgz_popup_close rgz_popup_close1 rgz_popup_create_close">关闭</a>
	</div></div>
	<!--创建契约弹窗-->

	<!--查看契约弹窗-->
	<div class="rgz_popup popUp2"><div class="rgz_popup_wrap">
	    <span class="jiao_tl"></span><span class="jiao_tr"></span><span class="jiao_bl"></span><span class="jiao_br"></span>
	    <h3 class="tit">分红契约</h3>
	    <div class="rgz_cjqy">
	        <div class="item">
	            <label class="item_left">用户名：</label>
	            <div class="text_rk modify-username"></div>
	        </div>
	        <div class="item">
	            <label class="item_left">生效日期：</label>
	            <div class="text_rk modify-edate"></div>
	        </div>
            <div class="item" id="update-field" style="display: none;">
                <label class="item_left">更新日期：</label>
                <div class="text_rk update-time"></div>
            </div>
	        <div class="item2">
	            <label>契约内容：</label>
	            <div class="ruleBox" id="show-rule">

	            </div>
	        </div>
	        <div class="check_b">
	            <div class="check_box">
	                <a href="javascript:;" class="an_submit an_submit2 compact-modify">修改契约</a>
	                <a href="javascript:;" class="an_cancel compact-cancle" onclick="cancelContract()">取消契约</a>
	                <a href="javascript:;" class="an_cancel">关闭</a>
	            </div>
	        </div>
	    </div>
	    <a href="javascript:;" class="rgz_popup_close rgz_popup_close2">关闭</a>
	</div></div>
	<!--查看契约弹窗-->

  <!--修改契约start-->
  <div class="rgz_popup popUp4 rgz_popup_create">
  	<div class="rgz_popup_wrap">
      <form action="https://www.julialt.com/pink/update" method="post" id="modifyCompact">
          <input type="hidden" name="flag" value="modify">
          <input type="hidden" id="userIdInput2" name="userid" value="">
	        <span class="jiao_tl"></span><span class="jiao_tr"></span><span class="jiao_bl"></span><span class="jiao_br"></span>
	        <h3 class="tit">分红契约</h3>
	        <div class="rgz_cjqy">
	            <div class="item">
	                <label class="item_left">用户名：</label>
	                <div class="item_r user_name modify-username"></div>
	            </div>
	            <div class="item2">
	                <label>契约内容：<a href="javascript:;" class="add_rule add_rule2">+ 添加规则</a></label>
	                <div class="ruleBox ruleBox2" id="show-rule2">
	                    <div class="rule_tr rule_tr2"><span>规则一</span>： <select name="ratio[]"><option value="1">1%</option><option value="2">2%</option><option value="3">3%</option><option value="4">4%</option><option value="5">5%</option><option value="6">6%</option><option value="7">7%</option><option value="8">8%</option><option value="9">9%</option><option value="10">10%</option><option value="11">11%</option><option value="12">12%</option><option value="13">13%</option><option value="14">14%</option><option value="15">15%</option><option value="18">18%</option><option value="20">20%</option><option value="23">23%</option><option value="25">25%</option></select>，周期累计投注额 ≥ <input onkeyup="keyUp(this)" maxlength="8" type="text" value="">元，可获得分红 <input type="text" value="">% <a href="javascript:;" class="delete_rule delete_rule2"><i class="icon"></i>删除</a></div>
	                </div>
	                <div class="add_rule_tr"></div>
	            </div>
	            <div class="check_b">
	            		<div style="color: #f00; line-height: 24px; font-size: 14px; margin-top: 10px;">
	                	<p>说明:</p>
	                	<p>● 契约修改成功后, 本分红周期即生效</p>
	                	<p>● 修改契约只能上调待遇, 不可降低</p>
	            		</div>
	                <div class="check_box"><a href="javascript:void(0);" onclick="modifyCompact();" class="an_submit"><i class="icon"></i>确定提交</a><a href="javascript:;" class="an_cancel an_cancel4">取消</a></div>
	            </div>
	        </div>
	        <a href="javascript:;" class="rgz_popup_close rgz_popup_close4 rgz_popup_create_close">关闭</a>
      </form>
  	</div>


  </div>
  <!--修改契约end-->
<script type="text/javascript">

    var setRules =  [{"1":["",""]},{"2":["",""]},{"3":["",""]},{"4":["",""]},{"5":["",""]},{"6":["",""]},{"7":["",""]},{"8":["",""]},{"9":["",""]},{"10":["",""]},{"11":["",""]},{"12":["",""]},{"13":["",""]},{"14":["0","0"]},{"15":["150000","3"]},{"18":["450000","5"]},{"20":["4500000","10"]},{"23":["12000000","20"]},{"25":["15000000","30"]}];
    var selfMax = "25";
    var setLimit = "25";

    var rulesMax = 0;

    if(isNaN(setLimit) || setLimit == null ||setLimit == undefined || setLimit == ''  ){
        rulesMax = parseFloat(selfMax);
    }else {
        rulesMax = parseFloat(setLimit) > parseFloat(selfMax) ? parseFloat(selfMax):parseFloat(setLimit) ;
    }

    //根据唯一值 作为id，避免selector重复添加 option
    var slectunique = 0;

    //输入框 离开时，只保留数字，去掉前导0
    function keyUp(dom) {
        if($(dom).val() == '')return;
        var originvalue = $(dom).val();
        originvalue = originvalue.replace(/\D/g,'');
        if(originvalue != ''){
            originvalue=(parseInt(originvalue,10));
        }

        $(dom).val(originvalue)
    }

    //去除比 selfMax setLimit 大的值
    function init_setRule() {
        setRules = $.grep(setRules,function (n,i) {
            for(var key in n){
                if(parseFloat(key) <= parseFloat(rulesMax) ){
                    return true;
                }
            }
        })
    }
    init_setRule();

    //初始化 select option 设置周累计投注额，活跃人数 placeholder
    function init_limit(selector) {
        $.each(setRules,function (key,value) {
            $.map(value,function (mapvalue, mapindex) {
                selector.append("<option value="+mapindex+">"+mapindex+"%"+"</option>");
            });
            var temp = $(this);
            //默认选择第0个
            if(key == 0){
                $.map(value,function (mapvalue, mapindex) {
                    if(mapvalue[0]!='') selector.next().attr("placeholder","不可低于"+mapvalue[0]);
                    if(mapvalue[1]!='') selector.next().next().attr("placeholder","不可低于"+mapvalue[1]);
                })
            }
        })
    }
    init_limit($("select:[name='ratio[]']"));

    //当用户点击select的时候
    function select_change(selector) {
        selector.change(function () {
            var index = $(this).get(0).selectedIndex;

            var temp = $(this);
            //根据option 设置 最大周累计投注额 还有 活跃人数的 placeholder
            if(index == undefined || index == null || isNaN(index)|| index < 0 ||  setRules == [] || setRules == '') {
                selector.next().attr("placeholder","");
                selector.next().next().attr("placeholder","");
                return;
            }
            $.map(setRules[index],function (value,key) {
                temp.next().attr("placeholder",value[0] == '' ?"": "不可低于"+value[0]);
                temp.next().next().attr("placeholder",value[1] == '' ?"":"不可低于"+value[1]);
            })

        })
    }

    select_change($("select:[name='ratio[]']"))

    //查看契约是，找到已经选定的 option ,设置placeholder
    function findSelectedbyRitio(selector,ratio) {
        $.each(setRules,function (key, value) {
            $.map(value,function (mapvalue, mapkey) {
                if(mapkey == ratio){
                    selector.find("option[value='"+ratio+"']").attr("selected",true);
                }
            })
        })
        //找到当前选中的index
        var index = $(selector).get(0).selectedIndex;
        //遍历setRule 找到最小投注额，最小活跃人数
        if(index == undefined || index == null || isNaN(index)|| index < 0 ||  setRules == [] || setRules == '') {
            selector.next().attr("placeholder","");
            selector.next().next().attr("placeholder","");
            return;
        }
        $.map(setRules[index],function (mapvalue, mapkey) {
            selector.next().attr("placeholder",mapvalue[0] == '' ?"": "不可低于"+mapvalue[0]);
            selector.next().next().attr("placeholder",mapvalue[1] == '' ?"":"不可低于"+mapvalue[1]);
        })
    }
    //弹出框提示，自动消失
    function showReminder(msg) {
        $(".create_msg").text(msg)
        $(".create_msg").slideDown(100,function () {
            setTimeout(function (){
                $(".create_msg").slideUp(100);
            },1400)
        })
    }

    //当用户输入值，低于 不可低于值时的 提示
    function reminder(selector) {
        var amount_selector = selector.next();
        var people_selector = selector.next().next();


        amount_selector.blur(function () {
            //从placeholder中 获取值 并比较
            var amount = 0;
            if(amount_selector.attr("placeholder").replace(/\D/g,'') != ''){
                amount = parseInt( amount_selector.attr("placeholder").replace(/\D/g,'')  );
            }
            if(parseInt(amount_selector.val()) < amount){
                showReminder("不可低于 "+amount+" 元");
                amount_selector.val("")
            }
        })

        people_selector.blur(function () {
            //从placeholder中 获取值 并比较
            var people = 0;
            if(people_selector.attr("placeholder").replace(/\D/g,'') != ''){
                people =  parseInt(people_selector.attr("placeholder").replace(/\D/g,''));
            }
            if(parseInt(people_selector.val()) < people){
                showReminder("不可低于 "+people+" 人");
                people_selector.val("")
            }
        })

    }
    reminder($("select:[name='ratio[]']"))

		//排序
    $(".sort").on('click', function(){
        if($(this).hasClass("jt_up")){
            $("#search-form input[name=sort]").val('desc');
            $(this).removeClass("jt_up").addClass("jt_down")
        }else{
            $("#search-form input[name=sort]").val('asc');
            $(this).removeClass("jt_down").addClass("jt_up")
        }
        var orderby = $(this).attr('orderby');
        $("#search-form input[name=orderby]").val(orderby);
        $("#search-form").submit();
    });

    var formForce = '', alertMsg = '';

  	$('.allChecked').on('change',function(){
  		if($(this).is(':checked')){
  			$('.checkbox').prop('checked', true)
  		}
  		else{
  			$('.checkbox').prop('checked', false)
  		}
  	})

  	//一键发放分红
  	$('.allSend').on('click',function(){
  	    var count = {};
        $.ajax({
            url: '/pink/ajaxhub/countpink',
            data: '&flag=all&cycle_id=14',
            type: 'POST',
            dataType: 'json',
            async: false,
            success: function(data){
                if(data.status == 0){
                    $.alert(data.msg);
                    return;
                }
                if(data.status == 10001){
                    $.alert(data.message);
                    return;
                }
                count = data.data;
            },
            error: function(resp){
                $.alert('error');
            }
        });

        if(count[1]['bill_num'] == 0 && count[1]['self_money'] == 0){
        	$.alert('您的下级分红已发放完毕或无分红');
        	return;
        }

	  		alertMsg = '一键发放所有未发放的下级分红, 共计'+ count[1]['bill_num'] +'人, 总金额' + count[1]['self_money'] + '元,\n 将从您的账户余额扣除\n<b style="display:inline-block;margin:12px 0;">是否确认发放?</b><p>提示: 在下级分红全部发放完成前, 您的账户将冻结投注和提款</p>';
	  		$.confirm(alertMsg,function(){
	        $.ajax({
	            url: '/pink/checkout',
	            data: $('.selfId').attr('data-id')+'&flag=all&cycle_id=14',
	            type: 'POST',
	            dataType: 'json',
	            async: false,
	            success: function(data){
	                if(data.status == 0){
	                    $.alert(data.msg);
	                    return;
	                }
	                if(data.status == 10001){
	                    $.alert(data.message);
	                    return;
	                }
	                if(data.msg == '账户余额不足'){
	  								$.confirm('发放失败, 账户可用余额不足, 请充值',function(){
	  									location.href = '/emaildeposit/main';
	  								},null,null,null,'去充值','确定');
	  								return;
	                }
	                $.alert('<b>已发放成功!</b><br><br>您可在充提账变报表查看账变记录',null,function(){
	                	location.reload();
	                })
	            },
	            error: function(resp){
	                $.alert('error');
	            }
	        });
  		})
  	})

  	//多选发放分红
  	$('.oneSend').on('click',function(){
	  		var checkedLen = $('.checkbox:checked').length;
	  		var checkedVal = '', isAllSend = '', count = {};

	  		if(isAllSend != 1){
	  			$.alert('您的下级分红已发放完毕或无分红!')
	  			return;
	  		}

	  		if(checkedLen < 1){
	  			$.alert('请勾选要发放分红的用户!')
	  			return;
	  		}

        $('.checkbox:checked').each(function(){
            checkedVal += 'userid[]='+this.value+'&'
        });

        $.ajax({
            url: '/pink/ajaxhub/countpink',
            data: checkedVal + '&cycle_id=14',
            type: 'POST',
            dataType: 'json',
            async: false,
            success: function(data){
                if(data.status == 0){
                    $.alert(data.msg);
                    return;
                }
                if(data.status == 10001){
                    $.alert(data.message);
                    return;
                }
                count = data.data;
            },
            error: function(resp){
                $.alert('error');
            }
        });

        if(count[1]['bill_num'] == 0 && count[1]['self_money'] == 0){
        	$.alert('您的下级分红已发放完毕或无分红');
        	return;
        }

	  		alertMsg = '选择'+checkedLen+'人, 应发放分红'+ count[1]['self_money'] +'元, 将从您的账户余额扣除\n<b style="display:inline-block;margin:12px 0;">是否确认发放?</b><p>提示: 在下级分红全部发放完成前, 您的账户将冻结投注和提款</p>';

	  		$.confirm(alertMsg,function(){
	        $.ajax({
	            url: '/pink/checkout',
	            data: checkedVal+'cycle_id=14',
	            type: 'POST',
	            dataType: 'json',
	            async: false,
	            success: function(data){
	                if(data.status == 0){
	                    $.alert(data.msg);
	                    return;
	                }
	                if(data.status == 10001){
	                    $.alert(data.message);
	                    return;
	                }
	                if(data.msg == '账户余额不足'){
	  								$.confirm('发放失败, 账户可用余额不足, 请充值',function(){
	  									location.href = '/emaildeposit/main';
	  								},null,null,null,'去充值','确定');
	  								return;
	                }
	                $.alert('<b>已发放成功!</b><br><br>您可在充提账变报表查看账变记录',null,function(){
	                	location.reload();
	                })
	            },
	            error: function(resp){
	                $.alert('error');
	            }
	        });
  		})
  	})

    $(".set-up_qy").on("click",function(){
        formForce = 'createCompact';
        $('#childname').html($(this).attr('data-name'))
        $('#userIdInput').val($(this).attr('data-id'))
        $(".rgz_popup_bg").show();
        $(".popUp1").slideDown(200);
    })

    $(".an_cancel").on("click",function(){
        $(".rgz_popup_bg").hide();
        $(".popUp1,.popUp2").slideUp(200);

    })

    //删除规则
    function changeN(outBox,row){
			var rule = $("."+outBox).find("."+row).find("span")
    	var bign = ""
    	$.each(rule,function(index){
    		index = index+1
    		if(index==1){
  				  bign = "一"
  			}else if(index==2){
  				  bign = "二"
  			}else if(index==3){
  				  bign = "三"
  			}else if(index==4){
            bign = "四"
        }else if(index==5){
            bign = "五"
        }else if(index==6){
            bign = "六"
        }else if(index==7){
            bign = "七"
        }else if(index==8){
            bign = "八"
        }else if(index==9){
            bign = "九"
        }else if(index==10){
            bign = "十"
        }else{
  				$.alert("您添加的规则已经到达上限")
  			}
    		$(this).html("规则"+bign)
    	})
    }
    $(".ruleBox1").on("click",".delete_rule1",function(){
        if($(".rule_tr1").length!=1){
            $(this).parent(".rule_tr").remove()
        }else{
            $.alert("最少保留一条规则")
        }
        changeN("ruleBox1","rule_tr1")
    })
    $(".ruleBox2").on("click",".delete_rule2",function(){
        if($(".rule_tr2").length!=1){
            $(this).parent(".rule_tr").remove()
        }else{
            $.alert("最少保留一条规则")
        }
        changeN("ruleBox2","rule_tr2")
    })
    //添加规则
    function addRule(ruleBox,row,del){
        var rule = $("."+ruleBox).find("."+row)
        var bign = ""
        $.each(rule,function(index){
            index = index+2
            if(index==1){
                bign = "一"
            }else if(index==2){
                bign = "二"
            }else if(index==3){
                bign = "三"
            }else if(index==4){
                bign = "四"
            }else if(index==5){
                bign = "五"
            }else if(index==6){
                bign = "六"
            }else if(index==7){
                bign = "七"
            }else if(index==8){
                bign = "八"
            }else if(index==9){
                bign = "九"
            }else if(index==10){
                bign = "十"
            }else if(index==11){
                bign = "十一"
            }
        })
        var bodyHeight = $("body").height();
        //设置父级ifarme高度
        $("#mainFrame").setHeight({height:bodyHeight});

        if(bign=="十一"){
 					$.alert("规则已到达上限")
        	return false
        }else{
            //id="select_'+index+'"
        	$("."+ruleBox).append('<div class="rule_tr '+row+'"><span>规则'+bign+'</span>：分红比例 <select id="select_'+slectunique+'" name="ratio[]" ></select> ，周期累计投注额 ≥ <input onkeyup="keyUp(this)" class="rgz_popup_create_input" type="text" value="" name="profit[]" maxlength="8" class="ruleinput1">元，且活跃人数 ≥ <input onkeyup="keyUp(this)" class="rgz_popup_create_input" type="text" value="" name="people[]" maxlength="3" class="ruleinput1">人<a href="javascript:;" class="delete_rule '+del+'"><i class="icon"></i>删除</a></div>')
            //给select添加option，设置placeholder
            init_limit($("#"+"select_"+slectunique));
            select_change($("#"+"select_"+slectunique))
            reminder($("#"+"select_"+slectunique))
            slectunique ++;
        }
    }
    $(".add_rule1").on("click",function(){
        addRule("ruleBox1","rule_tr1","delete_rule1")
        $(".rule_tr1").last().find("input").focus()
    })
    $(".add_rule2").on("click",function(){
        addRule("ruleBox2","rule_tr2","delete_rule2")
        $(".rule_tr2").last().find("input").focus()
    })

    $(".rgz_popup_close1").on("click",function(){
        $(".popUp1").slideUp(200);
        $(".rgz_popup_bg").hide();
    })
    $(".rgz_popup_close2").on("click",function(){
        $(".popUp2").slideUp(200);
        $(".rgz_popup_bg").hide();
    })

    $(".an_submit2").on("click",function(){
        formForce = 'modifyCompact';
        $(".popUp4").slideDown(200);
        $(".popUp2").slideUp(200);
        $(".rgz_popup_bg").show();
    })
    $(".rgz_popup_close4,.an_cancel4").on("click",function(){
        $(".popUp4").slideUp(200);
        $(".rgz_popup_bg").hide();
    })

    function createCompact(){
        if(checkRule() == 1){
            $("#createCompact").submit();
        }
    }

    function modifyCompact(){
        if(checkRule() == 1){
            $("#modifyCompact").submit();
        }
        return true;
    }
    var contractId = 0;
    function showDetail(userid,modify){
        $("#update-field").hide();
        $.get('/pink/ajaxhub/contract?userid='+userid, function(data){
            var data = JSON.parse(data);
            var info = data.data;
            if(data.status == 0){
                $.alert(data.msg);
                return false;
            }else{
                contractId = info.id;
                $("#userIdInput2").val(userid);
                $(".modify-username").html(info.username);
                $(".modify-edate").html(info.effect_date);

                if (info.status == '8') {
                    $("#update-field").show();
                    $(".modify-edate").html(info.effect_date + '（已更新）');
                    $(".update-time").html(info.create_time);
                }

                $(".compact-cancle").show();
                if(!modify) $(".compact-modify").hide();
                else $(".compact-modify").show();

                // 已签约
                if (info.status == '1' || info.status == '8') {
                    $(".compact-cancle").hide();
                } else if(info.status != '2') {//待签约
                    $(".compact-cancle").hide();
                }

                var ruleStr = '';
                var ruleStr2 = '';

                $("#show-rule").html('');
                $("#show-rule2").html('');
                $.each(info.rule, function(index, rule){
                    var ruleNum = numberMap(rule.level),
                        minBet = parseInt(rule.profit),
                        people = parseInt(rule.people),
                        ratio = parseFloat(rule.ratio);
                    ruleStr2 = '<div class="rule_tr rule_tr2"><span>规则'+ruleNum+'</span>：分红比例 <select id="select_'+slectunique+'" name="ratio[]" ></select>， 周期累计投注额 ≥ <input onkeyup="keyUp(this)" type="text" name="profit[]" value="'+minBet+'" maxlength="8">元，且活跃人数 ≥ <input onkeyup="keyUp(this)" name="people[]" type="text" value="'+people+'" maxlength="3">人<a href="javascript:;" class="delete_rule delete_rule2"><i class="icon"></i>删除</a></div>';

                    ruleStr = "<div class='rule_tr'><span>规则"+ruleNum+"</span>：周期累计投注额 ≥ "+minBet+" 元，且活跃人数 ≥ "+people+"人，分红 "+ratio+"%</div>";

                    $("#show-rule").append(ruleStr);
                    $("#show-rule2").append(ruleStr2);

                    //添加option 选择默认的option
                    init_limit($("#"+"select_"+slectunique));
                    select_change($("#"+"select_"+slectunique))
                    findSelectedbyRitio($("#"+"select_"+slectunique),ratio);
                    reminder($("#"+"select_"+slectunique))
                    slectunique++;
                });

                $(".popUp2").slideDown(200);
                $(".rgz_popup_bg").show();
            }
        });
    }

    function checkRule() {
        var checkResult = 0;

        $.ajax({
            url: '/pink/ajaxhub/checkrule',
            data: $('#'+formForce).serialize(),
            type: 'POST',
            dataType: 'json',
            async: false,
            success: function(data){
                checkResult = data.status;
                if(data.status == 0){
                    $.alert(data.msg);
                }else if(data.status == 10001){
                    $.alert(data.message);
                }
            },
            error: function(resp){
                $.alert('表单参数验证失败'+resp);
            }
        });

        return checkResult;
    }

    function cancelContract(){
        $.confirm('确定取消该契约？', function(){

        });
    }

    function numberMap(num){
        var numArr = ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一'];
        return numArr[num-1];
    }

</script>
</div>
							 </div>
                            <div class="mar-lr20 tb-imte" id="caipiaobb" style="display:none">
<div class="mask_list">
<div>加载中，请稍后...</div>
</div>
<div id="subContent_bet_re">
<script>
    //充提记录
    function checkForm(obj)
    {
        if( jQuery.trim(obj.star_date.value) != "" )
        {
            if( false == validateInputDate(obj.star_date.value) )
            {
                $.alert("时间格式不正确");
                obj.star_date.focus();
                $(".mask_list").hide();
                return false;
            }
        }
        if( jQuery.trim(obj.end_date.value) != "" )
        {
            if( false == validateInputDate(obj.end_date.value) )
            {
                $.alert("时间格式不正确");
                obj.end_date.focus();
                $(".mask_list").hide();
                return false;
            }
        }
    }

    function GetRequest() {

        var url = location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for(var i = 0; i < strs.length; i ++) {
                theRequest[strs[i].split("=")[0]]=(strs[i].split("=")[1]);
            }
        }
        return theRequest;
    }

    $(function () {
        var Request = new Object();
        Request = GetRequest();
        var ischild = Request['ischild'];
        if(ischild>-1)
            $("input[type='radio']").eq(ischild).attr('checked',true);
        if(typeof ischild != "undefined"){
            $(".search_br span[data]").removeClass().eq(ischild).addClass("hover");
        }

        var _html='<div class="total_1024"><div><b>总合计</b><i>总投注金额：</i>0.0000<i>中奖金额：</i>0.0000<i>返点金额：</i>0.0000<i>盈亏金额：</i><font>0.0000</div></div>'
        var topifm_w=parseInt($("#iframeBox",parent.parent.document).width());
        if(topifm_w<=1024){
            $(".grayTable").next("div").html(_html);
            $("#tr_all").hide();
        }

        $(".sort").on('click', function(){
            if($(this).hasClass("jt_up")){
                $("#search-form input[name=sort]").val('desc');
                $(this).removeClass("jt_up").addClass("jt_down")
            }else{
                $("#search-form input[name=sort]").val('asc');
                $(this).removeClass("jt_down").addClass("jt_up")
            }
            var orderby = $(this).attr('orderby');
            $("#search-form input[name=orderby]").val(orderby);
            $("#search-form").submit();
        });
    });
</script>
<form action="https://www.julialt.com/gameinfo/historyteamlottery" method="get" name="search" id="search-form" onsubmit="return checkForm(this)">
    <input type="hidden" name="orderby" value="sum_deposit">
    <input type="hidden" name="sort" value="desc">
    <input type="hidden" name="userid" value="">

    <div class="gy_search">
        <div class="inlineBlock">
            <label>日期：</label>
            <span id="today" style="display:none;">2018-12-13</span>
            <div class="calendar_input_kuang1">
                <!-- <input type="text" value="" name="starttime" id="starttime"> -->
                <input type="text" value="2018-12-13" name="star_date" id="starttime" class="input_02 team">
                <span class="calendar_icon"></span>
            </div>
            <span class="z">至</span>
            <div class="calendar_input_kuang1">
                <!-- <input type="text" value="" name="endtime" id="endtime"> -->
                <input type="text" value="2018-12-13" id="endtime" name="end_date" class="input_02 team">
                <span class="calendar_icon"></span>
            </div>
        </div>
        <div class="inlineBlock">
            <label>用户名：</label>
            <input type="text" value="" name="username" id="username" class="input_user_name inputNospace">
            <!-- <input type="text" name="username" id="username" size="16" value="" class="input_user_name inputNospace"> -->
        </div>
        <div class="inlineBlock">
            <div class="search_br"><span data="team" class="hover">团队</span></div>
            <input name="" type="submit" value="查询" class="formCheck">
        </div>
    </div>
</form>

<div class="tableTips clearfix">
    <div class="fl tableLevel">
        本级：
                <a href="https://www.julialt.com/gameinfo/historyteamlottery?userid=228342&amp;star_date=2018-12-13&amp;end_date=2018-12-13&amp;ischild=" style="font-weight:bold;">chy597823</a>             </div>
    <span class="fr">注: 此处账变为彩票账变</span>
</div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="grayTable">
    <tbody><tr>
        <th><span class="sortBtn1  sort" orderby="username">用户名</span></th>
        <th><span class=" betBtn sort" orderby="sum_deposit">充值</span></th>
        <th><span class=" betBtn sort" orderby="sum_withdraw">提现</span></th>

        <th><span class=" betBtn sort" orderby="ordernum">
            注单数
        </span></th>
        <th><span class=" betBtn sort" orderby="livedate">
            活跃天数
        </span></th>

        <th><span class=" betBtn sort" orderby="sum_prize">投注金额</span></th>
        <th><span class=" betBtn sort" orderby="sum_bonus">中奖金额</span></th>
        <th><span class=" betBtn sort" orderby="sum_point">返点金额</span></th>
        <th><span class=" betBtn sort" orderby="sum_activity">活动奖金</span></th>
                <th><span class=" betBtn sort" orderby="sum_wages">日工资</span></th>
                <th><span class=" betBtn sort" orderby="profit_loss">盈亏金额</span></th>
        <th>操作</th>
        <!-- <th>活动奖金</th> -->

    </tr>
        <tr>
                <td colspan="13" class="no-records">请选择查询条件之后进行查询</td>
            </tr>
    
        <tr class="tr_total">
        <td>本页合计</td>
        <td>--</td>
        <td>--</td>
                <td>--</td>
        <td>--</td>
                <td>--</td>
        <td>0.0000</td>
        <td>0.0000</td>
        <td>0.0000</td>
        <td>0.0000</td>
                <td>0.0000</td>
                <td><font>0.0000</font></td>
        <td>--</td>
    </tr>
    
    <tr id="tr_all" class="tr_total">
        <td>总合计</td>
        <td>--</td>
        <td>--</td>
                <td>--</td>
        <td>--</td>
                <td>--</td>
        <td>0.0000</td>
        <td>0.0000</td>
        <td>0.0000</td>
        <td>0.0000</td>
                <td>0.0000</td>
                <td><font>0.0000</font></td>
        <td>--</td>
    </tr>
</tbody></table>
<div></div>
<div class="list_page">
    <div class="pageinfo"></div>
</div>
<div class="ylfh_warm-prompt">
    <h6>温馨提示:</h6>
    <p>彩票统计时间为：02:00:00--02:00:00</p>
</div>

<script type="text/javascript">
    jQuery("#starttime").dynDateTime({
        ifFormat: "%Y-%m-%d",
        //daFormat: "%l;%M %p, %e %m,  %Y",
        align: "Br",
        electric: true,
        singleClick: false,
        button: ".next()", //next sibling
        setClass : "starttime",
        rangDay : 90,//允许选择前几天
        onSelect:function(){
            var o = this,today,sDay_f,today_s,sDay_s,rangDay_s,rangDay_d,rangDay_f,dayReduce;
            //根据format格式化
            //今天
            today = new Date($("#today").text());
            o.opts.today_f = o.opts.today_f || today;
            //被选择的那一天
            sDay_f = o.date.print(o.opts.ifFormat);
            //获取格林尼治时间到今天的毫秒数
            today_s = Date.parse(o.opts.today_f);
            //获取格林尼治时间到选择那天的毫秒数
            sDay_s = Date.parse(o.date);//获取秒
            //计算出最早一天的毫秒数
            rangDay_s = today_s - o.opts.rangDay*3600*24*1000;
            //转换成标准时间
            rangDay_d = new Date(rangDay_s);
            //根据format格式化输出被允许的指定天数的最早一天
            rangDay_f = rangDay_d.print(o.opts.ifFormat);
            //计算当前选择的那天距离今天的差值
            dayReduce = (today_s-sDay_s)/3600/24/1000;
            //如果超过指定天数
            if(dayReduce > o.opts.rangDay){
                $.alert("最多只能查询" + o.opts.rangDay + "天的数据");
                $("#starttime").val(rangDay_f);
            }
            else if(dayReduce < 0){
                $.alert("开始日期不能大于今天");
            }
            else{
                $("#starttime").val(sDay_f);
            }
            $("#starttime").change();
        },
        showOthers: true,
        weekNumbers: true
        //showsTime: false
    });

    jQuery(".starttime table td.day").live("click",function(){
        var start = jQuery("#starttime").val();
        var end = jQuery("#endtime").val();
        //checkStartAndEnd(start,end);
    });

    function checkStartAndEnd(startTime,endTime){
        if(! validateInputDate(startTime) )
        {
            jQuery("#starttime").val('');
            $.alert("时间格式不正确,正确的格式为:2009-06-10 10:59");
        }else if( !checkdateInRange(startTime, 91) ) {
            jQuery("#starttime").val('');
            $.alert("目前仅提供查询近90天内的记录！");
        }
        if(endTime != "")
        {
            if(startTime>endTime)
            {
                $("#starttime").val("");
                $.alert("输入的时间不符合逻辑");
            }
        }
    }
    jQuery("#endtime").dynDateTime({
        ifFormat: "%Y-%m-%d",
        // daFormat: "%l;%M %p, %e %m,  %Y",
        align: "Br",
        electric: true,
        singleClick: false,
        button: ".next()", //next sibling
        onUpdate:function(){
            $("#endtime").change();
        },
        showOthers: true,
        weekNumbers: true
        //  showsTime: false
    });
    jQuery("#endtime").change(function(){
        if(! validateInputDate(jQuery("#endtime").val()) )
        {
            jQuery("#endtime").val('');$.alert("时间格式不正确,正确的格式为:2009-06-10 10:59");
        }
        if($("#starttime").val()!="")
        {
            if($("#starttime").val()>$("#endtime").val())
            {
                $("#endtime").val("");$.alert("输入的时间不符合逻辑");
            }
        }
    });

    // 总合计
    jQuery("#sum_lotterydailycount").click(function(){
        var	starttime = $("#starttime").val();
        var	endtime = $("#endtime").val();
        var	username = $("input[name='username']:eq(0)").val();
        var ischild = $("input[type='radio']:checked").val();
        var urlval ="/index.php?controller=gameinfo&action=historyteamlottery&star_date="+starttime+"&end_date="+endtime+"&username="+username+"&ischild="+ischild+"&istotal=1"
        $.ajax({
            type: "GET",
            url: urlval,
            dataType: "json",
            success: function(data){
                $.each(data, function(i, n){
                    $('#'+i).html(n.toFixed(4));
                });
            }
        });
    });
</script>

</div>
<div style="clear: both"></div>
<script type="text/javascript">
if(window.top.location.href.indexOf("report")>0){
    $(".tab-first").remove();
  }
</script>
<script type="text/javascript" src="./base.js.下载"></script>
<script>
   window.onload=function(){
        // if(window.top.IFRAME_MODAL_OPENING){ 
        //     return;
        // }

        var bodyHeight = $("body").height();
        //设置父级ifarme高度
        jQuery("#mainFrame").setHeight({height:bodyHeight});
        //获取Url标题base.js中
        jQuery(".topContent ul li a").html(jQuery.getUrlParam("tit"));
        //如果有图片

        if(window.top.VERSION != 'X'){ 
            //document.write("WHAT ARE U DOING!")
        }
    }

    $(function(){
        //页码处理
        /*var len = $('.pageinfo > *').length;
        $('.pageinfo > *').each(function(i,v){
          var txt = $(v).text();
          if(i >= len - 2 && isNaN(txt))$(v).addClass('last-two');
        });*/

        //报表所有页面 搜索时 输入用户名 去掉前后空格
        $('.inputNospace').blur(function(){ 
            $(this).val($(this).val().replace(/\s*/g,''))
        })
        //声音开关
        $("#soundCtl").click(function(){
            _sound._soundCtl();
            changeClass();
        });

        //根据cookie设置class
        function changeClass(){
            if(_sound._checkCookie()){
                $("#soundCtl").removeClass().addClass('soundon');
            }else{
                $("#soundCtl").removeClass().addClass('soundoff');
            }
        }

    });

    function postMessage(url,title,width,height,modal){ 
      var width = width || 1040;
      var height = height || 580;
      if(typeof(url) == "object"){return}
      var modal = modal || 'show_modal';
        window.top.postMessage({
            action: modal,
            title: title,
            url: url,
            width: width,
            height: height
        }, '*')
    }

</script>
                            </div>
                            <div class="mar-lr20 tb-imte" id="zhenrenbb" style="display:none">
<div class="mask_list">
<div>加载中，请稍后...</div>
</div>
<div id="subContent_bet_re">
<!-- 真人电子体育报表 -->
<script>
    //充提记录
    function checkForm(obj)
    {
        if( jQuery.trim(obj.starttime.value) != "" )
        {
            if( false == validateInputDate(obj.starttime.value) )
            {
                $.alert("时间格式不正确");
                obj.startDate.focus();
                $(".mask_list").hide();
                return false;
            }
        }
        if( jQuery.trim(obj.endtime.value) != "" )
        {
            if( false == validateInputDate(obj.endtime.value) )
            {
                $.alert("时间格式不正确");
                obj.endtime.focus();
                $(".mask_list").hide();
                return false;
            }
        }
    }

    function GetRequest() {

        var url = location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for(var i = 0; i < strs.length; i ++) {
                theRequest[strs[i].split("=")[0]]=(strs[i].split("=")[1]);
            }
        }
        return theRequest;
    }

    $(function () {
        var Request = new Object();
        Request = GetRequest();
        var ischild = Request['ischild'];
        if(ischild>-1)
            $("input[type='radio']").eq(ischild).attr('checked',true);
        if(typeof ischild != "undefined"){
            $(".search_br span[data]").removeClass().eq(ischild).addClass("hover");
        }
        
        var topifm_w=parseInt($("#iframeBox",parent.parent.document).width());
        if(topifm_w<=1024){
            $(".grayTable").next("div").html(_html);
            $("#tr_all").hide();
        }
        $(".sort").on('click', function(){
            if($(this).hasClass("jt_up")){
                $("#search-form input[name=order]").val('DESC');
                $(this).removeClass("jt_up").addClass("jt_down")
            }else{
                $("#search-form input[name=order]").val('ASC');
                $(this).removeClass("jt_down").addClass("jt_up")
            }
            var orderBy = $(this).attr('orderBy');
            $("#search-form input[name=ordername]").val(orderBy);
            $("#search-form").submit();
        });
    });
</script>
<form action="https://www.julialt.com/gameinfo/eprofitloss" method="get" name="search" id="search-form" onsubmit="return checkForm(this)">
    <input type="hidden" name="ordername" value="sbet">
    <input type="hidden" name="order" value="DESC">
        <div class="gy_search">
            <div class="inlineBlock">
                <label>日期：</label>
                <span id="today" style="display:none;">2018-12-13</span>
                <div class="calendar_input_kuang1">
                    <input type="text" value="2018-12-13" name="starttime" id="starttime" class="input_02 team">
                    <span class="calendar_icon"></span>
                </div>
                <span class="z">至</span>
                <div class="calendar_input_kuang1">
                    <input type="text" value="2018-12-13" id="endtime" name="endtime" class="input_02 team">
                    <span class="calendar_icon"></span>
                </div>
            </div>
            <div class="inlineBlock">
                <label>用户名：</label>
                <input type="text" value="" name="username" id="username" class="input_user_name inputNospace">
            </div>
            <div class="inlineBlock">
                <select name="cid" id="cid">
                                	<option value="0" selected="" id="gamefrom_0">所有平台</option>                 
  	    		                	<option value="1" id="gamefrom_1">PT娱乐</option>                 
  	    		                	<option value="2" id="gamefrom_2">BBIN娱乐</option>                 
  	    		                	<option value="4" id="gamefrom_4">AG娱乐</option>                 
  	    		                	<option value="3" id="gamefrom_3">沙巴体育</option>                 
  	    		                	<option value="5" id="gamefrom_5">WM娱乐</option>                 
  	    		                	<option value="100" id="gamefrom_100">真人电子</option>                 
  	    		  
                </select>
            </div>
            <div class="inlineBlock">
                <input name="" type="submit" value="查询" class="formCheck">
            </div>
        </div>
</form>

<div class="tableTips clearfix">
    <div class="fl tableLevel">
    本级:
                    <a href="https://www.julialt.com/gameinfo/eprofitloss?userid=228342&amp;starttime=2018-12-13&amp;endtime=2018-12-13&amp;cid=0" style="font-weight:bold">chy597823</a>             </div>
    <span class="fr">游戏平台: <b style="font-weight: normal; color: #f00">
        所有平台       </b></span>
</div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="grayTable">
    <tbody><tr>
        <th><span class=" sort" orderby="username">用户名</span></th>
        <th><span class="jt_down sort" orderby="sbet">总投注</span></th>
        <th><span class=" sort" orderby="seffective_bet">有效投注</span></th>
        <th><span class=" sort" orderby="sprize">中奖金额</span></th>
        <th><span class=" sort" orderby="sprofit_loss">盈亏金额</span></th>
                <th><span class=" sort" orderby="fee">渠道费</span></th>
        <th><span class=" sort" orderby="settlement">总结算</span></th>
        <th>操作</th>
    </tr>
                <tr>
            <td>chy597823</td>
            <td>0.0000</td>
            <td>0.0000</td>
            <td>0.0000</td>
            <td><span>0.0000</span></td>
                        <td>--</td>
            <td>--</td>
            <td><a href="javascript:;" onclick="postMessage(&#39;gameinfo/livetigerprojects?userid=228342&amp;platform=PT&#39;,&#39;投注记录&#39;)">投注记录</a></td>
        </tr>
        
               <tr>
        <td colspan="8" class="no-records">没有查询到数据</td>
        </tr>
            <tr class="tr_total">
        <td>本页合计</td>
        <td>0.0000</td>
        <td>0.0000</td>
        <td>0.0000</td>
        <td><span>0.0000</span></td>
                <td>--</td>
        <td>--</td>
        <td></td>
    </tr>

    <tr id="tr_all" class="tr_total">
        <td>团队合计</td>
            <td>0.0000</td>
            <td>0.0000</td>
            <td>0.0000</td>
            <td><span>0.0000</span></td>
                        <td>0</td>
            <td>0</td>
        	<td></td>
    </tr>
</tbody></table>
<div></div>
<div class="list_page">
    <div class="pageinfo">总计 0 个记录,  分为  页, 当前第 1 页<span id="tPages">    <a href="https://www.julialt.com/gameinfo/eprofitloss/?ordername=sbet&amp;order=DESC&amp;starttime=2018-12-13&amp;endtime=2018-12-13&amp;username=&amp;cid=0&amp;p=&amp;pn=10">尾页</a></span>
转至 <script language="javascript">function keepKeyNum(obj,evt){var  k=window.event?evt.keyCode:evt.which; if( k==13 ){ goPage(obj.value);return false; }} function goPage(iPage){if(parseInt(iPage) != iPage){alert("输入整数的页码");return false;} if(parseInt(iPage) < 0){alert("输入正整数的页码");return false;} if( !isNaN(parseInt(iPage)) ) { if(!0){ if( iPage > 0 ){alert("输入页码超出尾页页码");return false; }} window.location.href="/gameinfo/eprofitloss/?ordername=sbet&order=DESC&starttime=2018-12-13&endtime=2018-12-13&username=&cid=0&pn=10&p="+iPage;}}</script><input onkeypress="return keepKeyNum(this,event);" type="text" id="iGotoPage" name="iGotoPage" size="6">页 <input type="button" onclick="javascript:goPage( document.getElementById(&#39;iGotoPage&#39;).value );return false;" class="button" value="GO"></div>
</div>
<div class="ylfh_warm-prompt">

</div>

<script type="text/javascript">
    jQuery("#starttime").dynDateTime({
        ifFormat: "%Y-%m-%d",
        //daFormat: "%l;%M %p, %e %m,  %Y",
        align: "Br",
        electric: true,
        singleClick: false,
        button: ".next()", //next sibling
        setClass : "starttime",
        rangDay : 90,//允许选择前几天
        onSelect:function(){
            var o = this,today,sDay_f,today_s,sDay_s,rangDay_s,rangDay_d,rangDay_f,dayReduce;
            //根据format格式化
            //今天
            today = new Date($("#today").text());
            o.opts.today_f = o.opts.today_f || today;
            //被选择的那一天
            sDay_f = o.date.print(o.opts.ifFormat);
            //获取格林尼治时间到今天的毫秒数
            today_s = Date.parse(o.opts.today_f);
            //获取格林尼治时间到选择那天的毫秒数
            sDay_s = Date.parse(o.date);//获取秒
            //计算出最早一天的毫秒数
            rangDay_s = today_s - o.opts.rangDay*3600*24*1000;
            //转换成标准时间
            rangDay_d = new Date(rangDay_s);
            //根据format格式化输出被允许的指定天数的最早一天
            rangDay_f = rangDay_d.print(o.opts.ifFormat);
            //计算当前选择的那天距离今天的差值
            dayReduce = (today_s-sDay_s)/3600/24/1000;
            //如果超过指定天数
            if(dayReduce > o.opts.rangDay){
                $.alert("最多只能查询" + o.opts.rangDay + "天的数据");
                $("#starttime").val(rangDay_f);
            }else{
                $("#starttime").val(sDay_f);
            }
            $("#starttime").change();
        },
        showOthers: true,
        weekNumbers: true
        //showsTime: false
    });

    jQuery(".starttime table td.day").live("click",function(){
        var start = jQuery("#starttime").val();
        var end = jQuery("#endtime").val();
        checkStartAndEnd(start,end);
    });

    function checkStartAndEnd(startTime,endTime){
        if(! validateInputDate(startTime) )
        {
            jQuery("#starttime").val('');
            $.alert("时间格式不正确,正确的格式为:2009-06-10 10:59");
        }else if( !checkdateInRange(startTime, 91) ) {
            jQuery("#starttime").val('');
            $.alert("目前仅提供查询近90天内的记录！");
        }
        if(endTime != "")
        {
            if(startTime>endTime)
            {
                $("#starttime").val("");
                $.alert("输入的时间不符合逻辑");
            }
        }
    }
    jQuery("#endtime").dynDateTime({
        ifFormat: "%Y-%m-%d",
        // daFormat: "%l;%M %p, %e %m,  %Y",
        align: "Br",
        electric: true,
        singleClick: false,
        button: ".next()", //next sibling
        onUpdate:function(){
            $("#endtime").change();
        },
        showOthers: true,
        weekNumbers: true
        //  showsTime: false
    });
    jQuery("#endtime").change(function(){
        if(! validateInputDate(jQuery("#endtime").val()) )
        {
            jQuery("#endtime").val('');$.alert("时间格式不正确,正确的格式为:2009-06-10 10:59");
        }
        if($("#starttime").val()!="")
        {
            if($("#starttime").val()>$("#endtime").val())
            {
                $("#endtime").val("");$.alert("输入的时间不符合逻辑");
            }
        }
    });

</script>

</div>
                            </div>							
					  </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!--<include file="Public/footer" />-->
<script>
$(function (){
		// 我的账户信息
	var timer1 = null;
	$('.my_account,.user_login_info2_list').mouseover(function (){
		if(timer1){
			clearTimeout(timer1);
		}
		$('.user_login_info2_list').show();
	})
	$('.my_account,.user_login_info2_list').mouseout(function (){
		timer1 = setTimeout(function (){
			$('.user_login_info2_list').hide();
		},300)
	})
	// 全部彩票
	var timer2 = null;
	$('.allLottery,.backLeftLottery').mouseover(function (){
		if(timer2){
			clearTimeout(timer2);
		}
		$('.backLeftLottery').show();
	})
	$('.allLottery,.backLeftLottery').mouseout(function (){
		timer2 = setTimeout(function (){
			$('.backLeftLottery').hide();
		},300)
	})
	//余额切换
	$('.hide_money_btn').click(function () {
		$('.show_money').hide();
		$('.hide_money').show();
	})
	$('.show_money_btn').click(function () {
		$('.show_money').show();
		$('.hide_money').hide();
	})
	//余额刷新
	var index  = 0;
	$('.refresh_money').click(function () {
		index++;
		var sum = index*360;
		$(this).css('transform','rotate('+sum+'deg)');
	})
	//个人信息和昨日奖金榜以及中奖信息的名片显示
	$("[data-toggle='popover']").popover({
	trigger: "hover",
	delay: {hide: 100}
	}).on('shown.bs.popover', function (event) {
			var that = this;
			$('.popover').on('mouseenter', function () {
					$(that).attr('in', true);
			}).on('mouseleave', function () {
					$(that).removeAttr('in');
					$(that).popover('hide');
			});
	}).on('hide.bs.popover', function (event) {
			if ($(this).attr('in')) {
					event.preventDefault();
			}
	});
})

</script>

</body>
</html>