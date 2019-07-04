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
    <style>
       #chartsTable{
           width: 200%;
       }
        #dataWrap{
            overflow: auto !important;
        }
        .selectWay{
            width: 200%;
        }
    </style>
</head>

<body>
<include file="Public/header" />
<section class=" pt-10 pb-10" id="gamepage" style="margin:0 auto;width:99%;overflow: auto;" >
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
            <th style="width: 10px" height="20" rowspan="2">期<br/>号</th>
            <th colspan="20" rowspan="2">开奖号码</th>
            <th colspan="80" >开奖号码分布</th>
        </tr>
        <tr class="">
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
            <th>13</th>
            <th>14</th>
            <th>15</th>
            <th>16</th>
            <th>17</th>
            <th>18</th>
            <th>19</th>
            <th>20</th>
            <th>21</th>
            <th>22</th>
            <th>23</th>
            <th>24</th>
            <th>25</th>
            <th>26</th>
            <th>27</th>
            <th>28</th>
            <th>29</th>
            <th>30</th>
            <th>31</th>
            <th>32</th>
            <th>33</th>
            <th>34</th>
            <th>35</th>
            <th>36</th>
            <th>37</th>
            <th>38</th>
            <th>39</th>
            <th>40</th>
            <th>41</th>
            <th>42</th>
            <th>43</th>
            <th>44</th>
            <th>45</th>
            <th>46</th>
            <th>47</th>
            <th>48</th>
            <th>49</th>
            <th>50</th>
            <th>51</th>
            <th>52</th>
            <th>53</th>
            <th>54</th>
            <th>55</th>
            <th>56</th>
            <th>57</th>
            <th>58</th>
            <th>59</th>
            <th>60</th>
            <th>61</th>
            <th>62</th>
            <th>63</th>
            <th>64</th>
            <th>65</th>
            <th>66</th>
            <th>67</th>
            <th>68</th>
            <th>69</th>
            <th>70</th>
            <th>71</th>
            <th>72</th>
            <th>73</th>
            <th>74</th>
            <th>75</th>
            <th>76</th>
            <th>77</th>
            <th>78</th>
            <th>79</th>
            <th>80</th>
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