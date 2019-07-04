

<!DOCTYPE html>
<html lang="zh">
<head>
    <title>3分彩-走势图表</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <link rel="stylesheet" href="/resources/zoushi/css/screen.css">
    <link rel="stylesheet" href="/resources/zoushi/css/chart.css?v=6">
    <link rel="stylesheet" href="/resources/zoushi/css/common.css?v=6">
    <link rel="stylesheet" href="/resources/zoushi/css/artDialog.css">
    <script src="/resources/zoushi/js/jquery.min.js"></script>
    <script type="text/javascript" src="/resources/zoushi/js/artDialog.js"></script>
    <script type="text/javascript" src="/resources/zoushi/js/NGameChart.js?v=2"></script>
    <script type="text/javascript" src="/resources/zoushi/js/NGameChart.data.js?v=8"></script>
    <script type="text/javascript" src="/resources/zoushi/js/chartLine.js?v=5"></script>
    <script src="/resources/zoushi/js/public.js?v=10"></script>
    <script type="text/javascript">
        (function() {
            if (location.href.search('CanPc') > -1) {
                sessionStorage.setItem('CanPc', 1);
            }
            var u = navigator.userAgent;
            if (!!u.match(/AppleWebKit.*Mobile.*/)
                && !sessionStorage.getItem('CanPc')) {
                // location.href='http://m.'+location.host.replace('www.','');
                //         location.href=location.href.replace('www.','').replace('http://','http://').replace(".html",'');
            }

        })();
        var UserName = '';
        (function() {
            var IEvar = '9', IEnum = navigator.userAgent.toLowerCase();
            if (IEnum.indexOf("msie") > -1) {
                if (Number(IEnum.match(/msie ([\d.]+)/)[1]) < IEvar) {
                    location.href = '/updateBrowser.html';
                }
            } else {
                if (window.localStorage && window.sessionStorage) {
                    try {
                        sessionStorage.setItem('TextLocalStorage', 'hello world');
                        sessionStorage.removeItem('TextLocalStorage');
                        localStorage.setItem('TextLocalStorage', 'hello world');
                        localStorage.removeItem('TextLocalStorage');
                    } catch (e) {
                        alert('您的浏览器太旧或者开启了隐私模式/无痕模式，无法浏览网页，请更换浏览器或使用常规模式，给您带来的不便，表示抱歉！')
                    }
                } else {
                    location.href = '/updateBrowser.html';
                }
                ;
            }
        })();
    </script>

    <style>
        .snav, .footer, .notice {
            display: none;
        }
    </style>

</head>

<body style="background: #fff;">

<div id="container" class="Trend_chart">
    <div class="select-section clearfix" style="width: 96%;">






        <div class="select-function">
            <a href="javascript:void(0)" id="showcontrol_btn"><em>收起功能区</em><i
                    class="iconfont-old"></i></a>
            <a id="" class="btn" target="_blank" href="/gameChart/downloadReport/TSFFC/SSC5?rowNumType=1">报表下载</a>
        </div>
        <div id="select_lottery" value="">
            <h3 class="select-title">彩种：3分彩</h3>
            <ul class="select-list">
                <li   class="current"  ><a href="/gameChart/TSFFC/SSC5?lotteryName=3分彩" >五星</a></li>
                <li   ><a href="/gameChart/TSFFC/SSC5XZH?lotteryName=3分彩" >五星综合</a></li>
                <li  ><a href="/gameChart/TSFFC/SSC4?lotteryName=3分彩" >四星</a></li>
                <li  ><a href="/gameChart/TSFFC/SSCQ3?lotteryName=3分彩" >前三</a></li>
                <li  ><a href="/gameChart/TSFFC/SSCZ3?lotteryName=3分彩" >中三</a></li>
                <li  ><a href="/gameChart/TSFFC/SSCH3?lotteryName=3分彩" >后三</a></li>
                <li  ><a href="/gameChart/TSFFC/SSCQ2?lotteryName=3分彩" >前二</a></li>
                <li  ><a href="/gameChart/TSFFC/SSCH2?lotteryName=3分彩" >后二</a></li>
            </ul>
        </div>


    </div>
    <div class="chart_control_cont">
        <div class="title">基本走势图</div>
        <div class="function">
            <label class="label"><input data-action="guides"
                                        class="checkbox" checked="checked" type="checkbox">辅助线</label> <label
                class="label"><input data-action="lost" class="checkbox"
                                     checked="checked" type="checkbox">遗漏</label> <label class="label"><input
                    data-action="trend" checked="checked" type="checkbox">走势</label>
        </div>




        <div class="time" id="periods-data">
            <a  href="/gameChart/TSFFC/SSC5?rowNumType=1&lotteryName=3分彩"   class="fb"  >近30期</a>
            <a  href="/gameChart/TSFFC/SSC5?rowNumType=2&lotteryName=3分彩" >近50期</a>
            <a  href="/gameChart/TSFFC/SSC5?rowNumType=3&lotteryName=3分彩" >近200期</a>
        </div>
    </div>
    <div class="chart-section" id="J-chart-area">
        <table class="chart-table" id="J-chart-area-table" width="100%"
               cellspacing="0" cellpadding="0">
            <thead class="thead">
            <tr class="title-text">
                <th rowspan="2" colspan="3" class="border-bottom border-right">期号</th>
                <th colspan="3" rowspan="2" class="border-right border-bottom">开奖号码</th>
                <th colspan="12" class="border-right">万位</th>
                <th colspan="12" class="border-right">千位</th>
                <th colspan="12" class="border-right">百位</th>
                <th colspan="12" class="border-right">十位</th>
                <th colspan="12" class="border-right">个位</th>
                <th colspan="12">号码分布</th>
            </tr>
            <tr class="title-number">
                <th class="ball-none border-bottom-header"></th>
                <th class="border-bottom-header"><i class="ball-noraml">0</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">1</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">2</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">3</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">4</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">5</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">6</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">7</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">8</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">9</i></th>
                <th class="ball-none border-bottom-header border-right"></th>
                <th class="ball-none border-bottom-header"></th>
                <th class="border-bottom-header"><i class="ball-noraml">0</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">1</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">2</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">3</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">4</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">5</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">6</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">7</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">8</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">9</i></th>
                <th class="ball-none border-bottom-header border-right"></th>
                <th class="ball-none border-bottom-header"></th>
                <th class="border-bottom-header"><i class="ball-noraml">0</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">1</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">2</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">3</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">4</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">5</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">6</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">7</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">8</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">9</i></th>
                <th class="ball-none border-bottom-header border-right"></th>
                <th class="ball-none border-bottom-header"></th>
                <th class="border-bottom-header"><i class="ball-noraml">0</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">1</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">2</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">3</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">4</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">5</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">6</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">7</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">8</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">9</i></th>
                <th class="ball-none border-bottom-header border-right"></th>
                <th class="ball-none border-bottom-header"></th>
                <th class="border-bottom-header"><i class="ball-noraml">0</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">1</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">2</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">3</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">4</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">5</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">6</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">7</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">8</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">9</i></th>
                <th class="ball-none border-bottom-header border-right"></th>
                <th class="ball-none border-bottom-header"></th>
                <th class="border-bottom-header"><i class="ball-noraml">0</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">1</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">2</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">3</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">4</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">5</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">6</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">7</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">8</i></th>
                <th class="border-bottom-header"><i class="ball-noraml">9</i></th>
                <th class="ball-none border-bottom-header border-right"></th>
            </tr>
            </thead>
            <tbody id="J-chart-content" class="chart table-guides">

            <tr class="0-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225313</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">4,6,8,3,6</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-0-0">
                    <i data-info="4,6,8,3,6"class="ball-noraml miss_data">
                        12
                    </i>
                </td>

                <td class="td-0-1">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-0-2">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-0-3">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-0-4">
                    <i data-info="4,6,8,3,6"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-0-5">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-0-6">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-0-7">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-0-8">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-0-9">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-0-0">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-0-1">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-0-2">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-0-3">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-0-4">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-0-5">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-0-6">
                    <i data-info="4,6,8,3,6"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-0-7">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-0-8">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-0-9">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-0-0">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-0-1">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-0-2">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-0-3">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-0-4">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-0-5">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-0-6">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        30

                    </i>
                </td>

                <td class="td-0-7">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-0-8">
                    <i data-info="4,6,8,3,6"class="ball-noraml

							  	 openNo ">

                        8
                    </i>
                </td>

                <td class="td-0-9">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-0-0">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-0-1">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-0-2">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-0-3">
                    <i data-info="4,6,8,3,6"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-0-4">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-0-5">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-0-6">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-0-7">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-0-8">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-0-9">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-0-0">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-0-1">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-0-2">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-0-3">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-0-4">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-0-5">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-0-6">
                    <i data-info="4,6,8,3,6"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-0-7">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-0-8">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-0-9">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-0-0">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-0-1">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-0-2">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-0-3">
                    <i data-info="4,6,8,3,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        3
                    </i>
                </td>


                <td class="td-0-4">
                    <i data-info="4,6,8,3,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        4
                    </i>
                </td>


                <td class="td-0-5">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        8

                    </i>
                </td>


                <td class="td-0-6">
                    <i data-info="4,6,8,3,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        6
                    </i>
                </td>


                <td class="td-0-7">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-0-8">
                    <i data-info="4,6,8,3,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        8
                    </i>
                </td>


                <td class="td-0-9">
                    <i data-info="4,6,8,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="1-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225314</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">5,1,4,1,6</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-1-0">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-1-1">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-1-2">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-1-3">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-1-4">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-1-5">
                    <i data-info="5,1,4,1,6"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-1-6">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-1-7">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-1-8">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-1-9">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-1-0">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-1-1">
                    <i data-info="5,1,4,1,6"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-1-2">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-1-3">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-1-4">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-1-5">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-1-6">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-1-7">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-1-8">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-1-9">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-1-0">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-1-1">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-1-2">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-1-3">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-1-4">
                    <i data-info="5,1,4,1,6"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-1-5">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-1-6">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        31

                    </i>
                </td>

                <td class="td-1-7">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-1-8">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-1-9">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-1-0">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-1-1">
                    <i data-info="5,1,4,1,6"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-1-2">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-1-3">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-1-4">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-1-5">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-1-6">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-1-7">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-1-8">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-1-9">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-1-0">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-1-1">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-1-2">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-1-3">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-1-4">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-1-5">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-1-6">
                    <i data-info="5,1,4,1,6"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-1-7">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-1-8">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-1-9">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-1-0">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-1-1">
                    <i data-info="5,1,4,1,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        1
                    </i>
                </td>


                <td class="td-1-2">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-1-3">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-1-4">
                    <i data-info="5,1,4,1,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        4
                    </i>
                </td>


                <td class="td-1-5">
                    <i data-info="5,1,4,1,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-1-6">
                    <i data-info="5,1,4,1,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        6
                    </i>
                </td>


                <td class="td-1-7">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-1-8">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-1-9">
                    <i data-info="5,1,4,1,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="2-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225315</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">0,1,6,3,6</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-2-0">
                    <i data-info="0,1,6,3,6"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-2-1">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-2-2">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-2-3">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-2-4">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-2-5">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-2-6">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-2-7">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-2-8">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-2-9">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-2-0">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-2-1">
                    <i data-info="0,1,6,3,6"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-2-2">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-2-3">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-2-4">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-2-5">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-2-6">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-2-7">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-2-8">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-2-9">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-2-0">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-2-1">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-2-2">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-2-3">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-2-4">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-2-5">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-2-6">
                    <i data-info="0,1,6,3,6"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-2-7">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-2-8">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-2-9">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-2-0">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-2-1">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-2-2">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-2-3">
                    <i data-info="0,1,6,3,6"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-2-4">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-2-5">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-2-6">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-2-7">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-2-8">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-2-9">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-2-0">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-2-1">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-2-2">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-2-3">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-2-4">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-2-5">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-2-6">
                    <i data-info="0,1,6,3,6"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-2-7">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-2-8">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-2-9">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-2-0">
                    <i data-info="0,1,6,3,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        0
                    </i>
                </td>


                <td class="td-2-1">
                    <i data-info="0,1,6,3,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-2-2">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        5

                    </i>
                </td>


                <td class="td-2-3">
                    <i data-info="0,1,6,3,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        3
                    </i>
                </td>


                <td class="td-2-4">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-2-5">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-2-6">
                    <i data-info="0,1,6,3,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        6
                    </i>
                </td>


                <td class="td-2-7">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-2-8">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-2-9">
                    <i data-info="0,1,6,3,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="3-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225316</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">1,6,7,8,6</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-3-0">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-3-1">
                    <i data-info="1,6,7,8,6"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-3-2">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-3-3">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-3-4">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-3-5">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-3-6">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-3-7">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-3-8">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-3-9">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-3-0">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-3-1">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-3-2">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-3-3">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-3-4">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-3-5">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-3-6">
                    <i data-info="1,6,7,8,6"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-3-7">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-3-8">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-3-9">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-3-0">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        25

                    </i>
                </td>

                <td class="td-3-1">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-3-2">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-3-3">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-3-4">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-3-5">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-3-6">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-3-7">
                    <i data-info="1,6,7,8,6"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-3-8">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-3-9">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-3-0">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-3-1">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-3-2">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-3-3">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-3-4">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-3-5">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-3-6">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-3-7">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-3-8">
                    <i data-info="1,6,7,8,6"class="ball-noraml

							  	 openNo ">

                        8
                    </i>
                </td>

                <td class="td-3-9">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-3-0">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-3-1">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-3-2">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-3-3">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-3-4">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-3-5">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-3-6">
                    <i data-info="1,6,7,8,6"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-3-7">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-3-8">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-3-9">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-3-0">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-3-1">
                    <i data-info="1,6,7,8,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-3-2">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        6

                    </i>
                </td>


                <td class="td-3-3">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-3-4">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-3-5">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-3-6">
                    <i data-info="1,6,7,8,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        6
                    </i>
                </td>


                <td class="td-3-7">
                    <i data-info="1,6,7,8,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        7
                    </i>
                </td>


                <td class="td-3-8">
                    <i data-info="1,6,7,8,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        8
                    </i>
                </td>


                <td class="td-3-9">
                    <i data-info="1,6,7,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="4-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225317</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">2,5,9,6,4</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-4-0">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-4-1">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-4-2">
                    <i data-info="2,5,9,6,4"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-4-3">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-4-4">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-4-5">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-4-6">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-4-7">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-4-8">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-4-9">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-4-0">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-4-1">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-4-2">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-4-3">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-4-4">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-4-5">
                    <i data-info="2,5,9,6,4"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-4-6">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-4-7">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-4-8">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-4-9">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-4-0">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        26

                    </i>
                </td>

                <td class="td-4-1">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-4-2">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-4-3">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-4-4">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-4-5">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-4-6">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-4-7">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-4-8">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-4-9">
                    <i data-info="2,5,9,6,4"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-4-0">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-4-1">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-4-2">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-4-3">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-4-4">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-4-5">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-4-6">
                    <i data-info="2,5,9,6,4"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-4-7">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-4-8">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-4-9">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-4-0">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-4-1">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-4-2">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-4-3">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-4-4">
                    <i data-info="2,5,9,6,4"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-4-5">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-4-6">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-4-7">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-4-8">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-4-9">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-4-0">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-4-1">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-4-2">
                    <i data-info="2,5,9,6,4"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        2
                    </i>
                </td>


                <td class="td-4-3">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-4-4">
                    <i data-info="2,5,9,6,4"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        4
                    </i>
                </td>


                <td class="td-4-5">
                    <i data-info="2,5,9,6,4"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-4-6">
                    <i data-info="2,5,9,6,4"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        6
                    </i>
                </td>


                <td class="td-4-7">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-4-8">
                    <i data-info="2,5,9,6,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-4-9">
                    <i data-info="2,5,9,6,4"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="5-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225318</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">0,1,1,7,2</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-5-0">
                    <i data-info="0,1,1,7,2"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-5-1">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-5-2">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-5-3">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-5-4">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-5-5">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-5-6">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-5-7">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-5-8">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-5-9">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-5-0">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-5-1">
                    <i data-info="0,1,1,7,2"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-5-2">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-5-3">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-5-4">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-5-5">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-5-6">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-5-7">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-5-8">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-5-9">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-5-0">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        27

                    </i>
                </td>

                <td class="td-5-1">
                    <i data-info="0,1,1,7,2"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-5-2">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-5-3">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-5-4">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-5-5">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-5-6">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-5-7">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-5-8">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-5-9">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-5-0">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-5-1">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-5-2">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-5-3">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-5-4">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-5-5">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-5-6">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-5-7">
                    <i data-info="0,1,1,7,2"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-5-8">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-5-9">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-5-0">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-5-1">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-5-2">
                    <i data-info="0,1,1,7,2"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-5-3">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-5-4">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-5-5">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-5-6">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-5-7">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-5-8">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-5-9">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-5-0">
                    <i data-info="0,1,1,7,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        0
                    </i>
                </td>


                <td class="td-5-1">
                    <i data-info="0,1,1,7,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        1
                    </i>
                </td>


                <td class="td-5-2">
                    <i data-info="0,1,1,7,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        2
                    </i>
                </td>


                <td class="td-5-3">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-5-4">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-5-5">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-5-6">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-5-7">
                    <i data-info="0,1,1,7,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        7
                    </i>
                </td>


                <td class="td-5-8">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-5-9">
                    <i data-info="0,1,1,7,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="6-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225319</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">7,9,0,1,5</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-6-0">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-6-1">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-6-2">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-6-3">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-6-4">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-6-5">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-6-6">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-6-7">
                    <i data-info="7,9,0,1,5"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-6-8">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-6-9">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-6-0">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-6-1">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-6-2">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-6-3">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-6-4">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-6-5">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-6-6">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-6-7">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-6-8">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-6-9">
                    <i data-info="7,9,0,1,5"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-6-0">
                    <i data-info="7,9,0,1,5"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-6-1">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-6-2">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-6-3">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-6-4">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-6-5">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-6-6">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-6-7">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-6-8">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-6-9">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-6-0">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-6-1">
                    <i data-info="7,9,0,1,5"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-6-2">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-6-3">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-6-4">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-6-5">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-6-6">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-6-7">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-6-8">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-6-9">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-6-0">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-6-1">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-6-2">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-6-3">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-6-4">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-6-5">
                    <i data-info="7,9,0,1,5"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-6-6">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-6-7">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-6-8">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-6-9">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-6-0">
                    <i data-info="7,9,0,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        0
                    </i>
                </td>


                <td class="td-6-1">
                    <i data-info="7,9,0,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-6-2">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-6-3">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-6-4">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-6-5">
                    <i data-info="7,9,0,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-6-6">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-6-7">
                    <i data-info="7,9,0,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        7
                    </i>
                </td>


                <td class="td-6-8">
                    <i data-info="7,9,0,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-6-9">
                    <i data-info="7,9,0,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="7-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225320</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">1,6,6,3,4</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-7-0">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-7-1">
                    <i data-info="1,6,6,3,4"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-7-2">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-7-3">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-7-4">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-7-5">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-7-6">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-7-7">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-7-8">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-7-9">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-7-0">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-7-1">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-7-2">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-7-3">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-7-4">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-7-5">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-7-6">
                    <i data-info="1,6,6,3,4"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-7-7">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-7-8">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-7-9">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-7-0">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-7-1">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-7-2">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-7-3">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-7-4">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-7-5">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-7-6">
                    <i data-info="1,6,6,3,4"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-7-7">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-7-8">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-7-9">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-7-0">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-7-1">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-7-2">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-7-3">
                    <i data-info="1,6,6,3,4"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-7-4">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-7-5">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-7-6">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-7-7">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-7-8">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-7-9">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-7-0">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-7-1">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-7-2">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-7-3">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-7-4">
                    <i data-info="1,6,6,3,4"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-7-5">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-7-6">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-7-7">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-7-8">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-7-9">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-7-0">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-7-1">
                    <i data-info="1,6,6,3,4"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-7-2">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-7-3">
                    <i data-info="1,6,6,3,4"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        3
                    </i>
                </td>


                <td class="td-7-4">
                    <i data-info="1,6,6,3,4"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        4
                    </i>
                </td>


                <td class="td-7-5">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-7-6">
                    <i data-info="1,6,6,3,4"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        6
                    </i>
                </td>


                <td class="td-7-7">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-7-8">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-7-9">
                    <i data-info="1,6,6,3,4"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="8-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225321</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">9,9,4,4,1</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-8-0">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-8-1">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-8-2">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-8-3">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-8-4">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-8-5">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-8-6">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-8-7">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-8-8">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-8-9">
                    <i data-info="9,9,4,4,1"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-8-0">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-8-1">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-8-2">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-8-3">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-8-4">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-8-5">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-8-6">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-8-7">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-8-8">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-8-9">
                    <i data-info="9,9,4,4,1"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-8-0">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-8-1">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-8-2">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-8-3">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-8-4">
                    <i data-info="9,9,4,4,1"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-8-5">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-8-6">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-8-7">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-8-8">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-8-9">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-8-0">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-8-1">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-8-2">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-8-3">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-8-4">
                    <i data-info="9,9,4,4,1"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-8-5">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-8-6">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-8-7">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-8-8">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-8-9">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-8-0">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-8-1">
                    <i data-info="9,9,4,4,1"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-8-2">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-8-3">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-8-4">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-8-5">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-8-6">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-8-7">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-8-8">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-8-9">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-8-0">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-8-1">
                    <i data-info="9,9,4,4,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-8-2">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-8-3">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-8-4">
                    <i data-info="9,9,4,4,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        4
                    </i>
                </td>


                <td class="td-8-5">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-8-6">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-8-7">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-8-8">
                    <i data-info="9,9,4,4,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        5

                    </i>
                </td>


                <td class="td-8-9">
                    <i data-info="9,9,4,4,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="9-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225322</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">1,7,1,5,2</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-9-0">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-9-1">
                    <i data-info="1,7,1,5,2"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-9-2">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-9-3">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-9-4">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-9-5">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-9-6">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-9-7">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-9-8">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-9-9">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-9-0">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-9-1">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-9-2">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-9-3">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-9-4">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-9-5">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-9-6">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-9-7">
                    <i data-info="1,7,1,5,2"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-9-8">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-9-9">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-9-0">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-9-1">
                    <i data-info="1,7,1,5,2"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-9-2">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-9-3">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        25

                    </i>
                </td>

                <td class="td-9-4">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-9-5">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-9-6">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-9-7">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-9-8">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-9-9">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-9-0">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-9-1">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-9-2">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-9-3">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-9-4">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-9-5">
                    <i data-info="1,7,1,5,2"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-9-6">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-9-7">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-9-8">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-9-9">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-9-0">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-9-1">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-9-2">
                    <i data-info="1,7,1,5,2"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-9-3">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-9-4">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-9-5">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-9-6">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-9-7">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-9-8">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-9-9">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-9-0">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-9-1">
                    <i data-info="1,7,1,5,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        1
                    </i>
                </td>


                <td class="td-9-2">
                    <i data-info="1,7,1,5,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        2
                    </i>
                </td>


                <td class="td-9-3">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-9-4">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-9-5">
                    <i data-info="1,7,1,5,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-9-6">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-9-7">
                    <i data-info="1,7,1,5,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        7
                    </i>
                </td>


                <td class="td-9-8">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        6

                    </i>
                </td>


                <td class="td-9-9">
                    <i data-info="1,7,1,5,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="10-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225323</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">9,9,7,7,1</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-10-0">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-10-1">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-10-2">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-10-3">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-10-4">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-10-5">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-10-6">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-10-7">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-10-8">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-10-9">
                    <i data-info="9,9,7,7,1"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-10-0">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-10-1">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-10-2">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-10-3">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-10-4">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-10-5">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-10-6">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-10-7">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-10-8">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-10-9">
                    <i data-info="9,9,7,7,1"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-10-0">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-10-1">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-10-2">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-10-3">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        26

                    </i>
                </td>

                <td class="td-10-4">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-10-5">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-10-6">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-10-7">
                    <i data-info="9,9,7,7,1"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-10-8">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-10-9">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-10-0">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-10-1">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-10-2">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-10-3">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-10-4">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-10-5">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-10-6">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-10-7">
                    <i data-info="9,9,7,7,1"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-10-8">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-10-9">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-10-0">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-10-1">
                    <i data-info="9,9,7,7,1"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-10-2">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-10-3">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-10-4">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-10-5">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-10-6">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-10-7">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-10-8">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-10-9">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-10-0">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-10-1">
                    <i data-info="9,9,7,7,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-10-2">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-10-3">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-10-4">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-10-5">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-10-6">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-10-7">
                    <i data-info="9,9,7,7,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        7
                    </i>
                </td>


                <td class="td-10-8">
                    <i data-info="9,9,7,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        7

                    </i>
                </td>


                <td class="td-10-9">
                    <i data-info="9,9,7,7,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="11-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225324</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">9,1,4,9,3</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-11-0">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-11-1">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-11-2">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-11-3">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-11-4">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-11-5">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-11-6">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-11-7">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-11-8">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-11-9">
                    <i data-info="9,1,4,9,3"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-11-0">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-11-1">
                    <i data-info="9,1,4,9,3"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-11-2">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-11-3">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-11-4">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-11-5">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-11-6">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-11-7">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-11-8">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-11-9">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-11-0">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-11-1">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-11-2">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-11-3">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        27

                    </i>
                </td>

                <td class="td-11-4">
                    <i data-info="9,1,4,9,3"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-11-5">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-11-6">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-11-7">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-11-8">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-11-9">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-11-0">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-11-1">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-11-2">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-11-3">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-11-4">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-11-5">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-11-6">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-11-7">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-11-8">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-11-9">
                    <i data-info="9,1,4,9,3"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-11-0">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-11-1">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-11-2">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-11-3">
                    <i data-info="9,1,4,9,3"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-11-4">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-11-5">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-11-6">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-11-7">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-11-8">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-11-9">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-11-0">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        5

                    </i>
                </td>


                <td class="td-11-1">
                    <i data-info="9,1,4,9,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-11-2">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-11-3">
                    <i data-info="9,1,4,9,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        3
                    </i>
                </td>


                <td class="td-11-4">
                    <i data-info="9,1,4,9,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        4
                    </i>
                </td>


                <td class="td-11-5">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-11-6">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-11-7">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-11-8">
                    <i data-info="9,1,4,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        8

                    </i>
                </td>


                <td class="td-11-9">
                    <i data-info="9,1,4,9,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="12-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225325</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">3,4,3,1,5</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-12-0">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-12-1">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-12-2">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-12-3">
                    <i data-info="3,4,3,1,5"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-12-4">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-12-5">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-12-6">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-12-7">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-12-8">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-12-9">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-12-0">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-12-1">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-12-2">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-12-3">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-12-4">
                    <i data-info="3,4,3,1,5"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-12-5">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-12-6">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-12-7">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-12-8">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-12-9">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-12-0">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-12-1">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-12-2">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-12-3">
                    <i data-info="3,4,3,1,5"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-12-4">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-12-5">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-12-6">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-12-7">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-12-8">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-12-9">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-12-0">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-12-1">
                    <i data-info="3,4,3,1,5"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-12-2">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-12-3">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-12-4">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-12-5">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-12-6">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-12-7">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-12-8">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-12-9">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-12-0">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-12-1">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-12-2">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-12-3">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-12-4">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-12-5">
                    <i data-info="3,4,3,1,5"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-12-6">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-12-7">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-12-8">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        25

                    </i>
                </td>

                <td class="td-12-9">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-12-0">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        6

                    </i>
                </td>


                <td class="td-12-1">
                    <i data-info="3,4,3,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-12-2">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-12-3">
                    <i data-info="3,4,3,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        3
                    </i>
                </td>


                <td class="td-12-4">
                    <i data-info="3,4,3,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        4
                    </i>
                </td>


                <td class="td-12-5">
                    <i data-info="3,4,3,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-12-6">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        5

                    </i>
                </td>


                <td class="td-12-7">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-12-8">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        9

                    </i>
                </td>


                <td class="td-12-9">
                    <i data-info="3,4,3,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="13-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225326</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">2,7,8,2,7</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-13-0">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-13-1">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-13-2">
                    <i data-info="2,7,8,2,7"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-13-3">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-13-4">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-13-5">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-13-6">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-13-7">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-13-8">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-13-9">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-13-0">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-13-1">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-13-2">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-13-3">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        25

                    </i>
                </td>

                <td class="td-13-4">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-13-5">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-13-6">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-13-7">
                    <i data-info="2,7,8,2,7"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-13-8">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-13-9">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-13-0">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-13-1">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-13-2">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-13-3">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-13-4">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-13-5">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-13-6">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-13-7">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-13-8">
                    <i data-info="2,7,8,2,7"class="ball-noraml

							  	 openNo ">

                        8
                    </i>
                </td>

                <td class="td-13-9">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-13-0">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-13-1">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-13-2">
                    <i data-info="2,7,8,2,7"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-13-3">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-13-4">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-13-5">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-13-6">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-13-7">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-13-8">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-13-9">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-13-0">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-13-1">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-13-2">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-13-3">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-13-4">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-13-5">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-13-6">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-13-7">
                    <i data-info="2,7,8,2,7"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-13-8">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        26

                    </i>
                </td>

                <td class="td-13-9">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-13-0">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        7

                    </i>
                </td>


                <td class="td-13-1">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-13-2">
                    <i data-info="2,7,8,2,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        2
                    </i>
                </td>


                <td class="td-13-3">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-13-4">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-13-5">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-13-6">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        6

                    </i>
                </td>


                <td class="td-13-7">
                    <i data-info="2,7,8,2,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        7
                    </i>
                </td>


                <td class="td-13-8">
                    <i data-info="2,7,8,2,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        8
                    </i>
                </td>


                <td class="td-13-9">
                    <i data-info="2,7,8,2,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="14-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225327</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">2,6,5,7,1</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-14-0">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-14-1">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-14-2">
                    <i data-info="2,6,5,7,1"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-14-3">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-14-4">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-14-5">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-14-6">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-14-7">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-14-8">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-14-9">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-14-0">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-14-1">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-14-2">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-14-3">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        26

                    </i>
                </td>

                <td class="td-14-4">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-14-5">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-14-6">
                    <i data-info="2,6,5,7,1"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-14-7">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-14-8">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-14-9">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-14-0">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-14-1">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-14-2">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-14-3">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-14-4">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-14-5">
                    <i data-info="2,6,5,7,1"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-14-6">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-14-7">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-14-8">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-14-9">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-14-0">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-14-1">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-14-2">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-14-3">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-14-4">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-14-5">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-14-6">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-14-7">
                    <i data-info="2,6,5,7,1"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-14-8">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-14-9">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-14-0">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-14-1">
                    <i data-info="2,6,5,7,1"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-14-2">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-14-3">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-14-4">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-14-5">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-14-6">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-14-7">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-14-8">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        27

                    </i>
                </td>

                <td class="td-14-9">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-14-0">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        8

                    </i>
                </td>


                <td class="td-14-1">
                    <i data-info="2,6,5,7,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-14-2">
                    <i data-info="2,6,5,7,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        2
                    </i>
                </td>


                <td class="td-14-3">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-14-4">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-14-5">
                    <i data-info="2,6,5,7,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-14-6">
                    <i data-info="2,6,5,7,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        6
                    </i>
                </td>


                <td class="td-14-7">
                    <i data-info="2,6,5,7,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        7
                    </i>
                </td>


                <td class="td-14-8">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-14-9">
                    <i data-info="2,6,5,7,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="15-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225328</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">7,0,7,5,5</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-15-0">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-15-1">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-15-2">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-15-3">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-15-4">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-15-5">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-15-6">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-15-7">
                    <i data-info="7,0,7,5,5"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-15-8">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        25

                    </i>
                </td>

                <td class="td-15-9">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-15-0">
                    <i data-info="7,0,7,5,5"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-15-1">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-15-2">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-15-3">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        27

                    </i>
                </td>

                <td class="td-15-4">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-15-5">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-15-6">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-15-7">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-15-8">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-15-9">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-15-0">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-15-1">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-15-2">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-15-3">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-15-4">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-15-5">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-15-6">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-15-7">
                    <i data-info="7,0,7,5,5"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-15-8">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-15-9">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-15-0">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-15-1">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-15-2">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-15-3">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-15-4">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-15-5">
                    <i data-info="7,0,7,5,5"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-15-6">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-15-7">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-15-8">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-15-9">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-15-0">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-15-1">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-15-2">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-15-3">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-15-4">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-15-5">
                    <i data-info="7,0,7,5,5"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-15-6">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-15-7">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-15-8">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        28

                    </i>
                </td>

                <td class="td-15-9">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-15-0">
                    <i data-info="7,0,7,5,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        0
                    </i>
                </td>


                <td class="td-15-1">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-15-2">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-15-3">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-15-4">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-15-5">
                    <i data-info="7,0,7,5,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        5
                    </i>
                </td>


                <td class="td-15-6">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-15-7">
                    <i data-info="7,0,7,5,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        7
                    </i>
                </td>


                <td class="td-15-8">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-15-9">
                    <i data-info="7,0,7,5,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="16-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225329</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">1,4,6,6,5</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-16-0">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-16-1">
                    <i data-info="1,4,6,6,5"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-16-2">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-16-3">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-16-4">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-16-5">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-16-6">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        25

                    </i>
                </td>

                <td class="td-16-7">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-16-8">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        26

                    </i>
                </td>

                <td class="td-16-9">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-16-0">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-16-1">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-16-2">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-16-3">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        28

                    </i>
                </td>

                <td class="td-16-4">
                    <i data-info="1,4,6,6,5"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-16-5">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-16-6">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-16-7">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-16-8">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-16-9">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-16-0">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-16-1">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-16-2">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-16-3">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-16-4">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-16-5">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-16-6">
                    <i data-info="1,4,6,6,5"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-16-7">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-16-8">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-16-9">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-16-0">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-16-1">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-16-2">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-16-3">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-16-4">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-16-5">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-16-6">
                    <i data-info="1,4,6,6,5"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-16-7">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-16-8">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-16-9">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-16-0">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-16-1">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-16-2">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-16-3">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-16-4">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-16-5">
                    <i data-info="1,4,6,6,5"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-16-6">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-16-7">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-16-8">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        29

                    </i>
                </td>

                <td class="td-16-9">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-16-0">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-16-1">
                    <i data-info="1,4,6,6,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-16-2">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-16-3">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-16-4">
                    <i data-info="1,4,6,6,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        4
                    </i>
                </td>


                <td class="td-16-5">
                    <i data-info="1,4,6,6,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-16-6">
                    <i data-info="1,4,6,6,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        6
                    </i>
                </td>


                <td class="td-16-7">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-16-8">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-16-9">
                    <i data-info="1,4,6,6,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        5

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="17-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225330</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">8,8,1,5,0</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-17-0">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-17-1">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-17-2">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-17-3">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-17-4">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-17-5">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-17-6">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        26

                    </i>
                </td>

                <td class="td-17-7">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-17-8">
                    <i data-info="8,8,1,5,0"class="ball-noraml

							  	 openNo ">

                        8
                    </i>
                </td>

                <td class="td-17-9">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-17-0">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-17-1">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-17-2">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        25

                    </i>
                </td>

                <td class="td-17-3">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        29

                    </i>
                </td>

                <td class="td-17-4">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-17-5">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-17-6">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-17-7">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-17-8">
                    <i data-info="8,8,1,5,0"class="ball-noraml

							  	 openNo ">

                        8
                    </i>
                </td>

                <td class="td-17-9">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-17-0">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-17-1">
                    <i data-info="8,8,1,5,0"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-17-2">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-17-3">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-17-4">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-17-5">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-17-6">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-17-7">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-17-8">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-17-9">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-17-0">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-17-1">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-17-2">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-17-3">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-17-4">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-17-5">
                    <i data-info="8,8,1,5,0"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-17-6">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-17-7">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-17-8">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-17-9">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-17-0">
                    <i data-info="8,8,1,5,0"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-17-1">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-17-2">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-17-3">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-17-4">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-17-5">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-17-6">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-17-7">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-17-8">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        30

                    </i>
                </td>

                <td class="td-17-9">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data
							  	">
                        25

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-17-0">
                    <i data-info="8,8,1,5,0"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        0
                    </i>
                </td>


                <td class="td-17-1">
                    <i data-info="8,8,1,5,0"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-17-2">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-17-3">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        5

                    </i>
                </td>


                <td class="td-17-4">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-17-5">
                    <i data-info="8,8,1,5,0"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-17-6">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-17-7">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-17-8">
                    <i data-info="8,8,1,5,0"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        8
                    </i>
                </td>


                <td class="td-17-9">
                    <i data-info="8,8,1,5,0"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        6

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="18-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225331</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">1,3,5,6,7</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-18-0">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-18-1">
                    <i data-info="1,3,5,6,7"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-18-2">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-18-3">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-18-4">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-18-5">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-18-6">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        27

                    </i>
                </td>

                <td class="td-18-7">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-18-8">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-18-9">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-18-0">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-18-1">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-18-2">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        26

                    </i>
                </td>

                <td class="td-18-3">
                    <i data-info="1,3,5,6,7"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-18-4">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-18-5">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-18-6">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-18-7">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-18-8">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-18-9">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-18-0">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-18-1">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-18-2">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-18-3">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-18-4">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-18-5">
                    <i data-info="1,3,5,6,7"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-18-6">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-18-7">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-18-8">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-18-9">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-18-0">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-18-1">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-18-2">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-18-3">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-18-4">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-18-5">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-18-6">
                    <i data-info="1,3,5,6,7"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-18-7">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-18-8">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-18-9">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-18-0">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-18-1">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-18-2">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-18-3">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-18-4">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-18-5">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-18-6">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-18-7">
                    <i data-info="1,3,5,6,7"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-18-8">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        31

                    </i>
                </td>

                <td class="td-18-9">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data
							  	">
                        26

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-18-0">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-18-1">
                    <i data-info="1,3,5,6,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-18-2">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-18-3">
                    <i data-info="1,3,5,6,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        3
                    </i>
                </td>


                <td class="td-18-4">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-18-5">
                    <i data-info="1,3,5,6,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-18-6">
                    <i data-info="1,3,5,6,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        6
                    </i>
                </td>


                <td class="td-18-7">
                    <i data-info="1,3,5,6,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        7
                    </i>
                </td>


                <td class="td-18-8">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-18-9">
                    <i data-info="1,3,5,6,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        7

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="19-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225332</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">1,2,9,7,5</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-19-0">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-19-1">
                    <i data-info="1,2,9,7,5"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-19-2">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-19-3">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-19-4">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-19-5">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-19-6">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        28

                    </i>
                </td>

                <td class="td-19-7">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-19-8">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-19-9">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-19-0">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-19-1">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-19-2">
                    <i data-info="1,2,9,7,5"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-19-3">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-19-4">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-19-5">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-19-6">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-19-7">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-19-8">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-19-9">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-19-0">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-19-1">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-19-2">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-19-3">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-19-4">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-19-5">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-19-6">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-19-7">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-19-8">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-19-9">
                    <i data-info="1,2,9,7,5"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-19-0">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-19-1">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-19-2">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-19-3">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-19-4">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-19-5">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-19-6">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-19-7">
                    <i data-info="1,2,9,7,5"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-19-8">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-19-9">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-19-0">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-19-1">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-19-2">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-19-3">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-19-4">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-19-5">
                    <i data-info="1,2,9,7,5"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-19-6">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-19-7">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-19-8">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        32

                    </i>
                </td>

                <td class="td-19-9">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data
							  	">
                        27

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-19-0">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-19-1">
                    <i data-info="1,2,9,7,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-19-2">
                    <i data-info="1,2,9,7,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        2
                    </i>
                </td>


                <td class="td-19-3">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-19-4">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-19-5">
                    <i data-info="1,2,9,7,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-19-6">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-19-7">
                    <i data-info="1,2,9,7,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        7
                    </i>
                </td>


                <td class="td-19-8">
                    <i data-info="1,2,9,7,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-19-9">
                    <i data-info="1,2,9,7,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="20-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225333</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">8,2,7,0,2</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-20-0">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-20-1">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-20-2">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-20-3">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-20-4">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-20-5">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-20-6">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        29

                    </i>
                </td>

                <td class="td-20-7">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-20-8">
                    <i data-info="8,2,7,0,2"class="ball-noraml

							  	 openNo ">

                        8
                    </i>
                </td>

                <td class="td-20-9">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-20-0">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-20-1">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-20-2">
                    <i data-info="8,2,7,0,2"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-20-3">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-20-4">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-20-5">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-20-6">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-20-7">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-20-8">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-20-9">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-20-0">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-20-1">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-20-2">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-20-3">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-20-4">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-20-5">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-20-6">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-20-7">
                    <i data-info="8,2,7,0,2"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-20-8">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-20-9">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-20-0">
                    <i data-info="8,2,7,0,2"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-20-1">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-20-2">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-20-3">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-20-4">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-20-5">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-20-6">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-20-7">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-20-8">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-20-9">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-20-0">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-20-1">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-20-2">
                    <i data-info="8,2,7,0,2"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-20-3">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-20-4">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-20-5">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-20-6">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-20-7">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-20-8">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        33

                    </i>
                </td>

                <td class="td-20-9">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data
							  	">
                        28

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-20-0">
                    <i data-info="8,2,7,0,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        0
                    </i>
                </td>


                <td class="td-20-1">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-20-2">
                    <i data-info="8,2,7,0,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        2
                    </i>
                </td>


                <td class="td-20-3">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-20-4">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-20-5">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-20-6">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-20-7">
                    <i data-info="8,2,7,0,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        7
                    </i>
                </td>


                <td class="td-20-8">
                    <i data-info="8,2,7,0,2"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        8
                    </i>
                </td>


                <td class="td-20-9">
                    <i data-info="8,2,7,0,2"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="21-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225334</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">1,9,0,7,9</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-21-0">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-21-1">
                    <i data-info="1,9,0,7,9"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-21-2">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-21-3">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-21-4">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-21-5">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-21-6">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        30

                    </i>
                </td>

                <td class="td-21-7">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-21-8">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-21-9">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-21-0">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-21-1">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-21-2">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-21-3">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-21-4">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-21-5">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-21-6">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-21-7">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-21-8">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-21-9">
                    <i data-info="1,9,0,7,9"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-21-0">
                    <i data-info="1,9,0,7,9"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-21-1">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-21-2">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-21-3">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-21-4">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-21-5">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-21-6">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-21-7">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-21-8">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-21-9">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-21-0">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-21-1">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-21-2">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-21-3">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-21-4">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-21-5">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-21-6">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-21-7">
                    <i data-info="1,9,0,7,9"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-21-8">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-21-9">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-21-0">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-21-1">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-21-2">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-21-3">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-21-4">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-21-5">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-21-6">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-21-7">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-21-8">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data
							  	">
                        34

                    </i>
                </td>

                <td class="td-21-9">
                    <i data-info="1,9,0,7,9"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-21-0">
                    <i data-info="1,9,0,7,9"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        0
                    </i>
                </td>


                <td class="td-21-1">
                    <i data-info="1,9,0,7,9"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-21-2">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-21-3">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-21-4">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        5

                    </i>
                </td>


                <td class="td-21-5">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-21-6">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-21-7">
                    <i data-info="1,9,0,7,9"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        7
                    </i>
                </td>


                <td class="td-21-8">
                    <i data-info="1,9,0,7,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-21-9">
                    <i data-info="1,9,0,7,9"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="22-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225335</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">8,4,3,0,8</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-22-0">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-22-1">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-22-2">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-22-3">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-22-4">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-22-5">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-22-6">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        31

                    </i>
                </td>

                <td class="td-22-7">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-22-8">
                    <i data-info="8,4,3,0,8"class="ball-noraml

							  	 openNo ">

                        8
                    </i>
                </td>

                <td class="td-22-9">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-22-0">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-22-1">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-22-2">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-22-3">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-22-4">
                    <i data-info="8,4,3,0,8"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-22-5">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-22-6">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-22-7">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-22-8">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-22-9">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-22-0">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-22-1">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-22-2">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        25

                    </i>
                </td>

                <td class="td-22-3">
                    <i data-info="8,4,3,0,8"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-22-4">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-22-5">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-22-6">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-22-7">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-22-8">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-22-9">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-22-0">
                    <i data-info="8,4,3,0,8"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-22-1">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-22-2">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-22-3">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-22-4">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-22-5">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-22-6">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-22-7">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-22-8">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-22-9">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-22-0">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-22-1">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-22-2">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-22-3">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-22-4">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-22-5">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-22-6">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-22-7">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-22-8">
                    <i data-info="8,4,3,0,8"class="ball-noraml

							  	 openNo ">

                        8
                    </i>
                </td>

                <td class="td-22-9">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-22-0">
                    <i data-info="8,4,3,0,8"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        0
                    </i>
                </td>


                <td class="td-22-1">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-22-2">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-22-3">
                    <i data-info="8,4,3,0,8"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        3
                    </i>
                </td>


                <td class="td-22-4">
                    <i data-info="8,4,3,0,8"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        4
                    </i>
                </td>


                <td class="td-22-5">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-22-6">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-22-7">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-22-8">
                    <i data-info="8,4,3,0,8"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        8
                    </i>
                </td>


                <td class="td-22-9">
                    <i data-info="8,4,3,0,8"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="23-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225336</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">6,7,0,9,3</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-23-0">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-23-1">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-23-2">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-23-3">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-23-4">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-23-5">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-23-6">
                    <i data-info="6,7,0,9,3"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-23-7">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-23-8">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-23-9">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-23-0">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-23-1">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-23-2">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-23-3">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-23-4">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-23-5">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-23-6">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-23-7">
                    <i data-info="6,7,0,9,3"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-23-8">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-23-9">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-23-0">
                    <i data-info="6,7,0,9,3"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-23-1">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-23-2">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        26

                    </i>
                </td>

                <td class="td-23-3">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-23-4">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-23-5">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-23-6">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-23-7">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-23-8">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-23-9">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-23-0">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-23-1">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-23-2">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-23-3">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-23-4">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-23-5">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-23-6">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-23-7">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-23-8">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-23-9">
                    <i data-info="6,7,0,9,3"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-23-0">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-23-1">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-23-2">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-23-3">
                    <i data-info="6,7,0,9,3"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-23-4">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-23-5">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-23-6">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-23-7">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-23-8">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-23-9">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-23-0">
                    <i data-info="6,7,0,9,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        0
                    </i>
                </td>


                <td class="td-23-1">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-23-2">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-23-3">
                    <i data-info="6,7,0,9,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        3
                    </i>
                </td>


                <td class="td-23-4">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-23-5">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-23-6">
                    <i data-info="6,7,0,9,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        6
                    </i>
                </td>


                <td class="td-23-7">
                    <i data-info="6,7,0,9,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        7
                    </i>
                </td>


                <td class="td-23-8">
                    <i data-info="6,7,0,9,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-23-9">
                    <i data-info="6,7,0,9,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="24-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225337</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">9,5,4,0,3</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-24-0">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-24-1">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-24-2">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-24-3">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-24-4">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-24-5">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-24-6">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-24-7">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-24-8">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-24-9">
                    <i data-info="9,5,4,0,3"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-24-0">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-24-1">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-24-2">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-24-3">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-24-4">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-24-5">
                    <i data-info="9,5,4,0,3"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-24-6">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-24-7">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-24-8">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-24-9">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-24-0">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-24-1">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-24-2">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        27

                    </i>
                </td>

                <td class="td-24-3">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-24-4">
                    <i data-info="9,5,4,0,3"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-24-5">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-24-6">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-24-7">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-24-8">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-24-9">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-24-0">
                    <i data-info="9,5,4,0,3"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-24-1">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-24-2">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-24-3">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-24-4">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-24-5">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-24-6">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-24-7">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-24-8">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-24-9">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-24-0">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-24-1">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-24-2">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-24-3">
                    <i data-info="9,5,4,0,3"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-24-4">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-24-5">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-24-6">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-24-7">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-24-8">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-24-9">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-24-0">
                    <i data-info="9,5,4,0,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        0
                    </i>
                </td>


                <td class="td-24-1">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-24-2">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-24-3">
                    <i data-info="9,5,4,0,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        3
                    </i>
                </td>


                <td class="td-24-4">
                    <i data-info="9,5,4,0,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        4
                    </i>
                </td>


                <td class="td-24-5">
                    <i data-info="9,5,4,0,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-24-6">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-24-7">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-24-8">
                    <i data-info="9,5,4,0,3"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-24-9">
                    <i data-info="9,5,4,0,3"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="25-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225338</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">4,3,4,1,5</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-25-0">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-25-1">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-25-2">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-25-3">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-25-4">
                    <i data-info="4,3,4,1,5"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-25-5">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-25-6">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-25-7">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-25-8">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-25-9">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-25-0">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-25-1">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-25-2">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-25-3">
                    <i data-info="4,3,4,1,5"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-25-4">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-25-5">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-25-6">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-25-7">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-25-8">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-25-9">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-25-0">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-25-1">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-25-2">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        28

                    </i>
                </td>

                <td class="td-25-3">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-25-4">
                    <i data-info="4,3,4,1,5"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-25-5">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-25-6">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-25-7">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-25-8">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-25-9">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-25-0">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-25-1">
                    <i data-info="4,3,4,1,5"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-25-2">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-25-3">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-25-4">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-25-5">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-25-6">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-25-7">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-25-8">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-25-9">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-25-0">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-25-1">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-25-2">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-25-3">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-25-4">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-25-5">
                    <i data-info="4,3,4,1,5"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-25-6">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-25-7">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-25-8">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-25-9">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-25-0">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-25-1">
                    <i data-info="4,3,4,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-25-2">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        5

                    </i>
                </td>


                <td class="td-25-3">
                    <i data-info="4,3,4,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        3
                    </i>
                </td>


                <td class="td-25-4">
                    <i data-info="4,3,4,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        4
                    </i>
                </td>


                <td class="td-25-5">
                    <i data-info="4,3,4,1,5"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-25-6">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-25-7">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-25-8">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-25-9">
                    <i data-info="4,3,4,1,5"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="26-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225339</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">9,5,8,9,1</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-26-0">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-26-1">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-26-2">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-26-3">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-26-4">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-26-5">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        25

                    </i>
                </td>

                <td class="td-26-6">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-26-7">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-26-8">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-26-9">
                    <i data-info="9,5,8,9,1"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-26-0">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-26-1">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-26-2">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-26-3">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-26-4">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-26-5">
                    <i data-info="9,5,8,9,1"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-26-6">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-26-7">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-26-8">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-26-9">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-26-0">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-26-1">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-26-2">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        29

                    </i>
                </td>

                <td class="td-26-3">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-26-4">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-26-5">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-26-6">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-26-7">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-26-8">
                    <i data-info="9,5,8,9,1"class="ball-noraml

							  	 openNo ">

                        8
                    </i>
                </td>

                <td class="td-26-9">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-26-0">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-26-1">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-26-2">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-26-3">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-26-4">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        18

                    </i>
                </td>

                <td class="td-26-5">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-26-6">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-26-7">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-26-8">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-26-9">
                    <i data-info="9,5,8,9,1"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-26-0">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-26-1">
                    <i data-info="9,5,8,9,1"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-26-2">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-26-3">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-26-4">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-26-5">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-26-6">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-26-7">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-26-8">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-26-9">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-26-0">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-26-1">
                    <i data-info="9,5,8,9,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-26-2">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        6

                    </i>
                </td>


                <td class="td-26-3">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-26-4">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-26-5">
                    <i data-info="9,5,8,9,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-26-6">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-26-7">
                    <i data-info="9,5,8,9,1"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-26-8">
                    <i data-info="9,5,8,9,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        8
                    </i>
                </td>


                <td class="td-26-9">
                    <i data-info="9,5,8,9,1"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="27-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225340</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">4,0,9,0,9</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-27-0">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-27-1">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-27-2">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-27-3">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-27-4">
                    <i data-info="4,0,9,0,9"class="ball-noraml

							  	 openNo ">

                        4
                    </i>
                </td>

                <td class="td-27-5">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        26

                    </i>
                </td>

                <td class="td-27-6">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-27-7">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-27-8">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-27-9">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-27-0">
                    <i data-info="4,0,9,0,9"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-27-1">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-27-2">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-27-3">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-27-4">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-27-5">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-27-6">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-27-7">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-27-8">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-27-9">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-27-0">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-27-1">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-27-2">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        30

                    </i>
                </td>

                <td class="td-27-3">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-27-4">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-27-5">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-27-6">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-27-7">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-27-8">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-27-9">
                    <i data-info="4,0,9,0,9"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-27-0">
                    <i data-info="4,0,9,0,9"class="ball-noraml

							  	 openNo ">

                        0
                    </i>
                </td>

                <td class="td-27-1">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-27-2">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-27-3">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-27-4">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        19

                    </i>
                </td>

                <td class="td-27-5">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-27-6">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-27-7">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-27-8">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-27-9">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-27-0">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-27-1">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-27-2">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-27-3">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-27-4">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-27-5">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-27-6">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-27-7">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-27-8">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-27-9">
                    <i data-info="4,0,9,0,9"class="ball-noraml

							  	 openNo ">

                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-27-0">
                    <i data-info="4,0,9,0,9"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        0
                    </i>
                </td>


                <td class="td-27-1">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-27-2">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        7

                    </i>
                </td>


                <td class="td-27-3">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-27-4">
                    <i data-info="4,0,9,0,9"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        4
                    </i>
                </td>


                <td class="td-27-5">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-27-6">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-27-7">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        4

                    </i>
                </td>


                <td class="td-27-8">
                    <i data-info="4,0,9,0,9"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-27-9">
                    <i data-info="4,0,9,0,9"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        9
                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="28-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225341</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">5,2,6,8,6</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-28-0">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        23

                    </i>
                </td>

                <td class="td-28-1">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-28-2">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-28-3">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-28-4">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-28-5">
                    <i data-info="5,2,6,8,6"class="ball-noraml

							  	 openNo ">

                        5
                    </i>
                </td>

                <td class="td-28-6">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-28-7">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        13

                    </i>
                </td>

                <td class="td-28-8">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-28-9">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-28-0">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-28-1">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-28-2">
                    <i data-info="5,2,6,8,6"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-28-3">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-28-4">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-28-5">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-28-6">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        14

                    </i>
                </td>

                <td class="td-28-7">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-28-8">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-28-9">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-28-0">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-28-1">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-28-2">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        31

                    </i>
                </td>

                <td class="td-28-3">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-28-4">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-28-5">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-28-6">
                    <i data-info="5,2,6,8,6"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-28-7">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-28-8">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-28-9">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-28-0">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-28-1">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-28-2">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-28-3">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-28-4">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        20

                    </i>
                </td>

                <td class="td-28-5">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-28-6">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-28-7">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-28-8">
                    <i data-info="5,2,6,8,6"class="ball-noraml

							  	 openNo ">

                        8
                    </i>
                </td>

                <td class="td-28-9">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-28-0">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-28-1">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-28-2">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-28-3">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-28-4">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-28-5">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-28-6">
                    <i data-info="5,2,6,8,6"class="ball-noraml

							  	 openNo ">

                        6
                    </i>
                </td>

                <td class="td-28-7">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        10

                    </i>
                </td>

                <td class="td-28-8">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-28-9">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-28-0">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-28-1">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-28-2">
                    <i data-info="5,2,6,8,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        2
                    </i>
                </td>


                <td class="td-28-3">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        3

                    </i>
                </td>


                <td class="td-28-4">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-28-5">
                    <i data-info="5,2,6,8,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        5
                    </i>
                </td>


                <td class="td-28-6">
                    <i data-info="5,2,6,8,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        6
                    </i>
                </td>


                <td class="td-28-7">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        5

                    </i>
                </td>


                <td class="td-28-8">
                    <i data-info="5,2,6,8,6"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        8
                    </i>
                </td>


                <td class="td-28-9">
                    <i data-info="5,2,6,8,6"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>

            <tr class="29-td">

                <td class="ball-none "></td>
                <td class="issue-numbers ">20190225342</td>
                <td class="ball-none border-right "></td>
                <td class="ball-none  "></td>
                <td class=""><span class="lottery-numbers">7,1,2,3,7</span></td>
                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-29-0">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        24

                    </i>
                </td>

                <td class="td-29-1">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-29-2">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-29-3">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        17

                    </i>
                </td>

                <td class="td-29-4">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-29-5">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-29-6">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-29-7">
                    <i data-info="7,1,2,3,7"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-29-8">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-29-9">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-29-0">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-29-1">
                    <i data-info="7,1,2,3,7"class="ball-noraml

							  	 openNo ">

                        1
                    </i>
                </td>

                <td class="td-29-2">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-29-3">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-29-4">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-29-5">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-29-6">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        15

                    </i>
                </td>

                <td class="td-29-7">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-29-8">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-29-9">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-29-0">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        6

                    </i>
                </td>

                <td class="td-29-1">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-29-2">
                    <i data-info="7,1,2,3,7"class="ball-noraml

							  	 openNo ">

                        2
                    </i>
                </td>

                <td class="td-29-3">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-29-4">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-29-5">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-29-6">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-29-7">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-29-8">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-29-9">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-29-0">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="td-29-1">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-29-2">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        16

                    </i>
                </td>

                <td class="td-29-3">
                    <i data-info="7,1,2,3,7"class="ball-noraml

							  	 openNo ">

                        3
                    </i>
                </td>

                <td class="td-29-4">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        21

                    </i>
                </td>

                <td class="td-29-5">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-29-6">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        11

                    </i>
                </td>

                <td class="td-29-7">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        8

                    </i>
                </td>

                <td class="td-29-8">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-29-9">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>


                <td class="td-29-0">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        12

                    </i>
                </td>

                <td class="td-29-1">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        3

                    </i>
                </td>

                <td class="td-29-2">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        9

                    </i>
                </td>

                <td class="td-29-3">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        5

                    </i>
                </td>

                <td class="td-29-4">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        22

                    </i>
                </td>

                <td class="td-29-5">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        4

                    </i>
                </td>

                <td class="td-29-6">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        1

                    </i>
                </td>

                <td class="td-29-7">
                    <i data-info="7,1,2,3,7"class="ball-noraml

							  	 openNo ">

                        7
                    </i>
                </td>

                <td class="td-29-8">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        7

                    </i>
                </td>

                <td class="td-29-9">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data
							  	">
                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>
                <!-- 号码分布 -->


                <td class="td-29-0">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-29-1">
                    <i data-info="7,1,2,3,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        1
                    </i>
                </td>


                <td class="td-29-2">
                    <i data-info="7,1,2,3,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        2
                    </i>
                </td>


                <td class="td-29-3">
                    <i data-info="7,1,2,3,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->

							  	">



                        3
                    </i>
                </td>


                <td class="td-29-4">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>


                <td class="td-29-5">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-29-6">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-29-7">
                    <i data-info="7,1,2,3,7"class="ball-noraml


							  	 openNo-1
							  	<!-- 出現兩個以上紫色球 -->
							  	openNo-2
							  	">



                        7
                    </i>
                </td>


                <td class="td-29-8">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        1

                    </i>
                </td>


                <td class="td-29-9">
                    <i data-info="7,1,2,3,7"class="ball-noraml
								 miss_data


							  	<!-- 出現兩個以上紫色球 -->

							  	">


                        2

                    </i>
                </td>

                <td class="ball-none border-right "></td>
                <td class="ball-none "></td>

            </tr>








            <tr class="0-td border-bottom">
                <td class="ball-none border-bottom"></td>
                <td class="issue-numbers border-bottom">出现总次数</td>
                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none  border-bottom"></td>
                <td class=" border-bottom"><span class="lottery-numbers"></span></td>
                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>




                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>



                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>



                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="6" class="ball-noraml ">6</i></td>

                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>



                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="11" class="ball-noraml ">11</i></td>

                <td class="td-0-0 border-bottom"><i data-info="20" class="ball-noraml ">20</i></td>

                <td class="td-0-0 border-bottom"><i data-info="9" class="ball-noraml ">9</i></td>

                <td class="td-0-0 border-bottom"><i data-info="11" class="ball-noraml ">11</i></td>

                <td class="td-0-0 border-bottom"><i data-info="12" class="ball-noraml ">12</i></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="11" class="ball-noraml ">11</i></td>

                <td class="td-0-0 border-bottom"><i data-info="14" class="ball-noraml ">14</i></td>

                <td class="td-0-0 border-bottom"><i data-info="8" class="ball-noraml ">8</i></td>

                <td class="td-0-0 border-bottom"><i data-info="11" class="ball-noraml ">11</i></td>


                <td class="ball-none border-right border-bottom"></td>

            </tr>
            <tr class="1-td border-bottom">
                <td class="ball-none border-bottom"></td>
                <td class="issue-numbers border-bottom">平均遗漏值</td>
                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none  border-bottom"></td>
                <td class=" border-bottom"><span class="lottery-numbers"></span></td>
                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="30" class="ball-noraml ">30</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="30" class="ball-noraml ">30</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="6" class="ball-noraml ">6</i></td>


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="6" class="ball-noraml ">6</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="30" class="ball-noraml ">30</i></td>

                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>



                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="30" class="ball-noraml ">30</i></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="6" class="ball-noraml ">6</i></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>

                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>

                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>

                <td class="td-0-0 border-bottom"><i data-info="30" class="ball-noraml ">30</i></td>

                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>

                <td class="td-0-0 border-bottom"><i data-info="30" class="ball-noraml ">30</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="6" class="ball-noraml ">6</i></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>



                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="30" class="ball-noraml ">30</i></td>

                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>

                <td class="td-0-0 border-bottom"><i data-info="6" class="ball-noraml ">6</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="30" class="ball-noraml ">30</i></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>


                <td class="ball-none border-right border-bottom"></td>
            </tr>
            <tr class="2-td border-bottom"><!-- 線 -->
                <td class="ball-none "></td>
                <td class="issue-numbers border-bottom">最大遗漏值</td>
                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none  border-bottom"></td>
                <td class=" border-bottom"><span class="lottery-numbers"></span></td><!-- 線 -->


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="24" class="ball-noraml ">24</i></td>

                <td class="td-0-0 border-bottom"><i data-info="8" class="ball-noraml ">8</i></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="17" class="ball-noraml ">17</i></td>

                <td class="td-0-0 border-bottom"><i data-info="24" class="ball-noraml ">24</i></td>

                <td class="td-0-0 border-bottom"><i data-info="26" class="ball-noraml ">26</i></td>

                <td class="td-0-0 border-bottom"><i data-info="23" class="ball-noraml ">23</i></td>

                <td class="td-0-0 border-bottom"><i data-info="13" class="ball-noraml ">13</i></td>

                <td class="td-0-0 border-bottom"><i data-info="17" class="ball-noraml ">17</i></td>

                <td class="td-0-0 border-bottom"><i data-info="12" class="ball-noraml ">12</i></td>



                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="17" class="ball-noraml ">17</i></td>

                <td class="td-0-0 border-bottom"><i data-info="19" class="ball-noraml ">19</i></td>

                <td class="td-0-0 border-bottom"><i data-info="18" class="ball-noraml ">18</i></td>

                <td class="td-0-0 border-bottom"><i data-info="12" class="ball-noraml ">12</i></td>

                <td class="td-0-0 border-bottom"><i data-info="19" class="ball-noraml ">19</i></td>

                <td class="td-0-0 border-bottom"><i data-info="15" class="ball-noraml ">15</i></td>

                <td class="td-0-0 border-bottom"><i data-info="9" class="ball-noraml ">9</i></td>

                <td class="td-0-0 border-bottom"><i data-info="17" class="ball-noraml ">17</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="14" class="ball-noraml ">14</i></td>

                <td class="td-0-0 border-bottom"><i data-info="12" class="ball-noraml ">12</i></td>

                <td class="td-0-0 border-bottom"><i data-info="29" class="ball-noraml ">29</i></td>

                <td class="td-0-0 border-bottom"><i data-info="12" class="ball-noraml ">12</i></td>

                <td class="td-0-0 border-bottom"><i data-info="12" class="ball-noraml ">12</i></td>

                <td class="td-0-0 border-bottom"><i data-info="14" class="ball-noraml ">14</i></td>

                <td class="td-0-0 border-bottom"><i data-info="11" class="ball-noraml ">11</i></td>

                <td class="td-0-0 border-bottom"><i data-info="9" class="ball-noraml ">9</i></td>

                <td class="td-0-0 border-bottom"><i data-info="12" class="ball-noraml ">12</i></td>

                <td class="td-0-0 border-bottom"><i data-info="14" class="ball-noraml ">14</i></td>


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>



                <td class="td-0-0 border-bottom"><i data-info="20" class="ball-noraml ">20</i></td>

                <td class="td-0-0 border-bottom"><i data-info="12" class="ball-noraml ">12</i></td>

                <td class="td-0-0 border-bottom"><i data-info="16" class="ball-noraml ">16</i></td>

                <td class="td-0-0 border-bottom"><i data-info="21" class="ball-noraml ">21</i></td>

                <td class="td-0-0 border-bottom"><i data-info="21" class="ball-noraml ">21</i></td>

                <td class="td-0-0 border-bottom"><i data-info="12" class="ball-noraml ">12</i></td>

                <td class="td-0-0 border-bottom"><i data-info="11" class="ball-noraml ">11</i></td>

                <td class="td-0-0 border-bottom"><i data-info="8" class="ball-noraml ">8</i></td>

                <td class="td-0-0 border-bottom"><i data-info="24" class="ball-noraml ">24</i></td>

                <td class="td-0-0 border-bottom"><i data-info="11" class="ball-noraml ">11</i></td>



                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="17" class="ball-noraml ">17</i></td>

                <td class="td-0-0 border-bottom"><i data-info="11" class="ball-noraml ">11</i></td>

                <td class="td-0-0 border-bottom"><i data-info="10" class="ball-noraml ">10</i></td>

                <td class="td-0-0 border-bottom"><i data-info="11" class="ball-noraml ">11</i></td>

                <td class="td-0-0 border-bottom"><i data-info="22" class="ball-noraml ">22</i></td>

                <td class="td-0-0 border-bottom"><i data-info="6" class="ball-noraml ">6</i></td>

                <td class="td-0-0 border-bottom"><i data-info="24" class="ball-noraml ">24</i></td>

                <td class="td-0-0 border-bottom"><i data-info="13" class="ball-noraml ">13</i></td>

                <td class="td-0-0 border-bottom"><i data-info="22" class="ball-noraml ">22</i></td>

                <td class="td-0-0 border-bottom"><i data-info="21" class="ball-noraml ">21</i></td>


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>



                <td class="td-0-0 border-bottom"><i data-info="8" class="ball-noraml ">8</i></td>

                <td class="td-0-0 border-bottom"><i data-info="3" class="ball-noraml ">3</i></td>

                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>

                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>

                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="6" class="ball-noraml ">6</i></td>

                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>

                <td class="td-0-0 border-bottom"><i data-info="9" class="ball-noraml ">9</i></td>

                <td class="td-0-0 border-bottom"><i data-info="7" class="ball-noraml ">7</i></td>


                <td class="ball-none border-right border-bottom"></td>
            </tr>
            <tr class="3-td border-bottom">
                <td class="ball-none border-bottom"></td>
                <td class="issue-numbers border-bottom">最大连出值</td>
                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none  border-bottom"></td>
                <td class=" border-bottom"><span class="lottery-numbers"></span></td>
                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>



                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>


                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>


                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>



                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>



                <td class="ball-none border-right border-bottom"></td>
                <td class="ball-none border-bottom"></td>



                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>

                <td class="td-0-0 border-bottom"><i data-info="8" class="ball-noraml ">8</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>

                <td class="td-0-0 border-bottom"><i data-info="6" class="ball-noraml ">6</i></td>

                <td class="td-0-0 border-bottom"><i data-info="5" class="ball-noraml ">5</i></td>

                <td class="td-0-0 border-bottom"><i data-info="4" class="ball-noraml ">4</i></td>

                <td class="td-0-0 border-bottom"><i data-info="1" class="ball-noraml ">1</i></td>

                <td class="td-0-0 border-bottom"><i data-info="2" class="ball-noraml ">2</i></td>




                <td class="ball-none border-right border-bottom"></td>
            </tr>
            </tbody>
            <tfoot class="chart table-tfoot"></tfoot>
        </table>

    </div>
</div>

</body>
</html>