<?php

namespace Lib\kaijiang;

class pk10 {
    /*
     * * 二维数组
     * * $params 二维数组
     * * 字段列表 必须包含
     * * typeid 彩票种类（ssc,k3,Game,kl10f,pk10,keno,xy28）
     * * playid 玩法标识
     * * opencode 开奖号码
     * * tzcode 投注号码
     */

    function __construct($params = []) {
        $this->params = $params;
    }

    function check() {
        $params = $this->params;
        foreach ($params as $pk => $param) {
            $playid = '';
            $playid = $param['playid'];
            $zjcount = 0;
            if (method_exists($this, $playid)) {
                $zjcount = self::$playid($param['opencode'], $param['tzcode']);
            }
            $param['zjcount'] = $zjcount;
            $params[$pk] = $param;
        }
        return $params;
    }

    //前一复式
    function bjpk10qian1($opencode, $tzcode) {
        $opencodes = array_slice(explode(',', $opencode), 0, 1);
        $tzcodes = explode(',', $tzcode);
        $zjcount = 0;
        if (in_array($opencodes[0], $tzcodes)) {
            $zjcount++;
        }
        return $zjcount;
    }

    /*
     * * 前二复式
     */

    function bjpk10qian2($opencode, $tzcode) {
        $opencodes = array_slice(explode(',', $opencode), 0, 2);
        $tzcodes = explode('|', $tzcode);
        $as = explode(',', $tzcodes[0]);
        $bs = explode(',', $tzcodes[1]);
        $zjcount = 0;
        if (in_array($opencodes[0], $as) && in_array($opencodes[1], $bs)) {
            $zjcount++;
        }
        return $zjcount;
    }

    /*
     * * 前二单式
     */

    function bjpk10qian2ds($opencode, $tzcode) {
        $opencode = implode(',', array_slice(explode(',', $opencode), 0, 2));
        $zjcount = 0;
        $zjcount = substr_count($tzcode, $opencode);
        return $zjcount;
    }

    /*
     * * 前三复式
     */

    function bjpk10qian3($opencode, $tzcode) {
        $opencodes = array_slice(explode(',', $opencode), 0, 3);
        $tzcodes = explode('|', $tzcode);
        $zjcount = 0;
        if (in_array($opencodes[0], explode(',', $tzcodes[0])) && in_array($opencodes[1], explode(',', $tzcodes[1])) && in_array($opencodes[2], explode(',', $tzcodes[2]))) {
            $zjcount++;
        }
        return $zjcount;
    }

    /*
     * * 前三单式
     *  $opencode="10,1,4,8,6,3,9,5,2,7
     * $tzcode="10,01,04|10,04,01|06,04,09"
     */

    function bjpk10qian3ds($opencode, $tzcode) {
        $opencode = implode(',', array_slice(explode(',', $opencode), 0, 3));
        $zjcount = 0;
        $zjcount = substr_count($tzcode, $opencode);
        return $zjcount;
    }

    /*
     * * 前四复式
     */

    function bjpk10qian4($opencode, $tzcode) {
        $opencodes = array_slice(explode(',', $opencode), 0, 4);
        $tzcodes = explode('|', $tzcode);
        $zjcount = 0;
        if (in_array($opencodes[0], explode(',', $tzcodes[0])) && in_array($opencodes[1], explode(',', $tzcodes[1])) && in_array($opencodes[2], explode(',', $tzcodes[2])) && in_array($opencodes[3], explode(',', $tzcodes[3]))) {
            $zjcount++;
        }
        return $zjcount;
    }

    /*
     * * 前四单式
     *  $opencode="10,1,4,8,6,3,9,5,2,7
     * $tzcode="10,01,04,06|10,04,01,08|06,04,09,07"
     */

    function bjpk10qian4ds($opencode, $tzcode) {
        $opencode = implode(',', array_slice(explode(',', $opencode), 0, 4));
        $zjcount = 0;
        $zjcount = substr_count($tzcode, $opencode);
        return $zjcount;
    }

    /*
     * * 前五复式
     */

    function bjpk10qian5($opencode, $tzcode) {
        $opencodes = array_slice(explode(',', $opencode), 0, 5);
        $tzcodes = explode('|', $tzcode);
        $zjcount = 0;
        if (in_array($opencodes[0], explode(',', $tzcodes[0])) && in_array($opencodes[1], explode(',', $tzcodes[1])) && in_array($opencodes[2], explode(',', $tzcodes[2])) && in_array($opencodes[3], explode(',', $tzcodes[3])) && in_array($opencodes[4], explode(',', $tzcodes[4]))) {
            $zjcount++;
        }
        return $zjcount;
    }

    /*
     * * 前五单式
     *  $opencode="01,06,04,10,05,08,09,03,07,02
     * $tzcode="10,01,04,06|10,04,01,08|06,04,09,07"
     */

    function bjpk10qian5ds($opencode, $tzcode) {
        $opencode = implode(',', array_slice(explode(',', $opencode), 0, 5));
        $zjcount = 0;
        $zjcount = substr_count($tzcode, $opencode);
        return $zjcount;
    }

    /*
     * * 定位胆
     */

    function bjpk10dwd($opencode, $tzcode) {
        $opencodes = explode(',', $opencode);
        $tzcodes = explode('|', $tzcode);
        $zjcount = 0;
        if (in_array($opencodes[0], explode(',', $tzcodes[0]))) {
            $zjcount++;
        }
        if (in_array($opencodes[1], explode(',', $tzcodes[1]))) {
            $zjcount++;
        }
        if (in_array($opencodes[2], explode(',', $tzcodes[2]))) {
            $zjcount++;
        }
        if (in_array($opencodes[3], explode(',', $tzcodes[3]))) {
            $zjcount++;
        }
        if (in_array($opencodes[4], explode(',', $tzcodes[4]))) {
            $zjcount++;
        }
        if (in_array($opencodes[5], explode(',', $tzcodes[5]))) {
            $zjcount++;
        }
        if (in_array($opencodes[6], explode(',', $tzcodes[6]))) {
            $zjcount++;
        }
        if (in_array($opencodes[7], explode(',', $tzcodes[7]))) {
            $zjcount++;
        }
        if (in_array($opencodes[8], explode(',', $tzcodes[8]))) {
            $zjcount++;
        }
        if (in_array($opencodes[9], explode(',', $tzcodes[9]))) {
            $zjcount++;
        }
        return $zjcount;
    }

    // 大小第一名
    function bjpk10dxdy($opencode, $tzcode) {
        $opencodes = explode(',', $opencode);
        $tzcodes = array_unique(explode(',', $tzcode));
        $bigsmall = '';
        $zjcount = 0;
        if ($opencodes[0] >= 6) {
            $bigsmall = '大';
        } else {
            $bigsmall = '小';
        }
        if (in_array($bigsmall, $tzcodes)) {
            $zjcount = 1;
        }
        return $zjcount;
    }

    // 大小第二名
    function bjpk10dxde($opencode, $tzcode) {
        $opencodes = explode(',', $opencode);
        $tzcodes = array_unique(explode(',', $tzcode));
        $bigsmall = '';
        $zjcount = 0;
        if ($opencodes[1] >= 6) {
            $bigsmall = '大';
        } else {
            $bigsmall = '小';
        }
        if (in_array($bigsmall, $tzcodes)) {
            $zjcount = 1;
        }
        return $zjcount;
    }

    // 大小第三名
    function bjpk10dxds($opencode, $tzcode) {
        $opencodes = explode(',', $opencode);
        $tzcodes = array_unique(explode(',', $tzcode));
        $bigsmall = '';
        $zjcount = 0;
        if ($opencodes[2] >= 6) {
            $bigsmall = '大';
        } else {
            $bigsmall = '小';
        }
        if (in_array($bigsmall, $tzcodes)) {
            $zjcount = 1;
        }
        return $zjcount;
    }

    // 单双第一名
    function bjpk10dsdy($opencode, $tzcode) {
        $opencodes = explode(',', $opencode);
        $tzcodes = array_unique(explode(',', $tzcode));
        $bigsmall = '';
        $zjcount = 0;
        if ($opencodes[0] % 2 == 0) {
            $bigsmall = '双';
        } else {
            $bigsmall = '单';
        }
        if (in_array($bigsmall, $tzcodes)) {
            $zjcount = 1;
        }
        return $zjcount;
    }

    // 单双第二名
    function bjpk10dsde($opencode, $tzcode) {
        $opencodes = explode(',', $opencode);
        $tzcodes = array_unique(explode(',', $tzcode));
        $bigsmall = '';
        $zjcount = 0;
        if ($opencodes[1] % 2 == 0) {
            $bigsmall = '双';
        } else {
            $bigsmall = '单';
        }
        if (in_array($bigsmall, $tzcodes)) {
            $zjcount = 1;
        }
        return $zjcount;
    }

    // 单双第三名
    function bjpk10dsds($opencode, $tzcode) {
        $opencodes = explode(',', $opencode);
        $tzcodes = array_unique(explode(',', $tzcode));
        $bigsmall = '';
        $zjcount = 0;
        if ($opencodes[2] % 2 == 0) {
            $bigsmall = '双';
        } else {
            $bigsmall = '单';
        }
        if (in_array($bigsmall, $tzcodes)) {
            $zjcount = 1;
        }
        return $zjcount;
    }

    // 龙虎第一名
    function bjpk10lhdy($opencode, $tzcode) {
        $opencodes = explode(',', $opencode);
        $tzcodes = array_unique(explode(',', $tzcode));
        $bigsmall = '';
        $zjcount = 0;
        if ($opencodes[0] > $opencodes[9]) {
            $bigsmall = '龙';
        } else {
            $bigsmall = '虎';
        }
        if (in_array($bigsmall, $tzcodes)) {
            $zjcount = 1;
        }
        return $zjcount;
    }

    // 龙虎第二名
    function bjpk10lhde($opencode, $tzcode) {
        $opencodes = explode(',', $opencode);
        $tzcodes = array_unique(explode(',', $tzcode));
        $bigsmall = '';
        $zjcount = 0;
        if ($opencodes[1] > $opencodes[8]) {
            $bigsmall = '龙';
        } else {
            $bigsmall = '虎';
        }
        if (in_array($bigsmall, $tzcodes)) {
            $zjcount = 1;
        }
        return $zjcount;
    }

    // 龙虎第三名
    function bjpk10lhds($opencode, $tzcode) {
        $opencodes = explode(',', $opencode);
        $tzcodes = array_unique(explode(',', $tzcode));
        $bigsmall = '';
        $zjcount = 0;
        if ($opencodes[2] > $opencodes[7]) {
            $bigsmall = '龙';
        } else {
            $bigsmall = '虎';
        }
        if (in_array($bigsmall, $tzcodes)) {
            $zjcount = 1;
        }
        return $zjcount;
    }

    // 阶乘
    function factorial($n) {
        return array_product(range(1, $n));
    }

    // 排列数
    function A($n, $m) {
        return self::factorial($n) / self::factorial($n - $m);
    }

    // 组合数
    function C($n, $m) {
        return self::A($n, $m) / self::factorial($m);
    }

    // 排列
    function arrangement($a, $m) {
        $r = array();

        $n = count($a);
        if ($m <= 0 || $m > $n) {
            return $r;
        }

        for ($i = 0; $i < $n; $i++) {
            $b = $a;
            $t = array_splice($b, $i, 1);
            if ($m == 1) {
                $r[] = $t;
            } else {
                $c = self::arrangement($b, $m - 1);
                foreach ($c as $v) {
                    $r[] = array_merge($t, $v);
                }
            }
        }

        return $r;
    }

    // 组合
    function combination($a, $m) {
        $r = array();

        $n = count($a);
        if ($m <= 0 || $m > $n) {
            return $r;
        }

        for ($i = 0; $i < $n; $i++) {
            $t = array($a[$i]);
            if ($m == 1) {
                $r[] = $t;
            } else {
                $b = array_slice($a, $i + 1);
                $c = self::combination($b, $m - 1);
                foreach ($c as $v) {
                    $r[] = array_merge($t, $v);
                }
            }
        }

        return $r;
    }

    /* 传统玩法，整合，大小。 */

    //判断大
    function mda($opencode, $tzcode, $playtitle) {
        //echo substr($playtitle,-1);
        $zjcount = 0;
        if ($tzcode != "大")
            return $zjcount;

        $title = mb_substr($playtitle, 4, -1, 'utf-8');
        $ma = ['2' => '三', '3' => '四', '4' => '五', '5' => '六', '6' => '七', '7' => '八', '8' => '九', '9' => '十',];
        $key = array_search($title, $ma);
        $opencodes = explode(',', $opencode);
        if ($opencodes[$key] > 5) {
            $zjcount++;
        }
        return $zjcount;
        // echo $playtitle;
    }

    //判断小
    function mxiao($opencode, $tzcode, $playtitle) {
        //echo substr($playtitle,-1);
        $zjcount = 0;
        if ($tzcode != "小")
            return $zjcount;

        $title = mb_substr($playtitle, 4, -1, 'utf-8');
        $ma = ['2' => '三', '3' => '四', '4' => '五', '5' => '六', '6' => '七', '7' => '八', '8' => '九', '9' => '十',];
        $key = array_search($title, $ma);
        $opencodes = explode(',', $opencode);
        if ($opencodes[$key] < 5) {
            $zjcount++;
        }
        return $zjcount;
        // echo $playtitle;
    }

    //冠亚大
    function first_second_da($opencode, $tzcode, $playtitle) {
        $playtitle = explode('-', $playtitle);
        $opencodes = explode(',', $opencode);

        $zjcount = 0;

        if ($tzcode != "大")
            return $zjcount;

        if ($playtitle[1] == '冠军') {
            if ($opencodes[0] > 5) {
                $zjcount++;
            }
        } elseif ($playtitle[1] == '亚军') {
            if ($opencodes[1] > 5) {
                $zjcount++;
            }
        }
        return $zjcount;
    }

    //冠亚小
    function first_second_xiao($opencode, $tzcode, $playtitle) {
        $playtitle = explode('-', $playtitle);
        $opencodes = explode(',', $opencode);

        $zjcount = 0;

        if ($tzcode != "小")
            return $zjcount;

        if ($playtitle[1] == '冠军') {
            if ($opencodes[0] < 6) {
                $zjcount++;
            }
        } elseif ($playtitle[1] == '亚军') {
            if ($opencodes[1] < 6) {
                $zjcount++;
            }
        }
        return $zjcount;
    }

    //判断单
    function dan($opencode, $tzcode, $playtitle) {
        // echo $playtitle;exit;
        //echo substr($playtitle,-1);
        $zjcount = 0;
        if ($tzcode != "单")
            return $zjcount;

        $title = mb_substr($playtitle, 4, -1, 'utf-8');
        $ma = ['2' => '三', '3' => '四', '4' => '五', '5' => '六', '6' => '七', '7' => '八', '8' => '九', '9' => '十',];
        $key = array_search($title, $ma);
        $opencodes = explode(',', $opencode);
        if ($opencodes[$key] % 2 == 1) {
            $zjcount++;
        }
        return $zjcount;
        // echo $playtitle;
    }

    //判断双
    function shuang($opencode, $tzcode, $playtitle) {
        // echo $playtitle;exit;
        //echo substr($playtitle,-1);
        $zjcount = 0;
        if ($tzcode != "双")
            return $zjcount;

        $title = mb_substr($playtitle, 4, -1, 'utf-8');
        $ma = ['2' => '三', '3' => '四', '4' => '五', '5' => '六', '6' => '七', '7' => '八', '8' => '九', '9' => '十',];
        $key = array_search($title, $ma);
        $opencodes = explode(',', $opencode);
        if ($opencodes[$key] % 2 == 0) {
            $zjcount++;
        }
        return $zjcount;
        // echo $playtitle;
    }

    //冠亚单
    function first_second_dan($opencode, $tzcode, $playtitle) {
        $playtitle = explode('-', $playtitle);
        $opencodes = explode(',', $opencode);

        $zjcount = 0;

        if ($tzcode != "单")
            return $zjcount;
        if ($playtitle[1] == '冠军') {
            if ($opencodes[0] % 2 == 1) {
                $zjcount++;
            }
        } elseif ($playtitle[1] == '亚军') {
            if ($opencodes[1] % 2 == 1) {
                $zjcount++;
            }
        }
        return $zjcount;
    }

    //冠亚双
    function first_second_shuang($opencode, $tzcode, $playtitle) {
        $playtitle = explode('-', $playtitle);
        $opencodes = explode(',', $opencode);

        $zjcount = 0;

        if ($tzcode != "双")
            return $zjcount;
        if ($playtitle[1] == '冠军') {
            if ($opencodes[0] % 2 == 0) {
                $zjcount++;
            }
        } elseif ($playtitle[1] == '亚军') {
            if ($opencodes[1] % 2 == 0) {
                $zjcount++;
            }
        }
        return $zjcount;
    }

    //判断龙，1V10龙
    function compare_long($opencode, $tzcode, $playtitle) {
        $playtitle = explode('-', $playtitle);
        $string = mb_substr($tzcode, -1, 1, 'utf-8');
        //echo $string;
        if ($string != "龙")
            return $zjcount;

        $zjcount = 0;
        $compare = str_replace("龙", "", $tzcode);
        $compare = explode('V', $compare);

        $opencodes = explode(',', $opencode);
        $one = (int) $opencodes[$compare[0] - 1];
        $tow = (int) $opencodes[$compare[1] - 1];
        // echo $one.$tow;exit;
        if ($one > $tow) {
            $zjcount++;
        }
        return $zjcount;
        // echo $playtitle;
    }

    //判断龙，1V10虎
    function compare_hu($opencode, $tzcode, $playtitle) {
        $playtitle = explode('-', $playtitle);
        $string = mb_substr($tzcode, -1, 1, 'utf-8');
        //echo $string;
        if ($string != "虎")
            return $zjcount;

        $zjcount = 0;
        $compare = str_replace("虎", "", $tzcode);
        $compare = explode('V', $compare);

        $opencodes = explode(',', $opencode);
        $one = (int) $opencodes[$compare[0] - 1];
        $tow = (int) $opencodes[$compare[1] - 1];
        if ($one < $tow) {
            $zjcount++;
        }
        return $zjcount;
        // echo $playtitle;
    }

    //整合,冠亚和大小
    function zh_sum($opencode, $tzcode, $playtitle) {
        $opencodes = explode(',', $opencode);

        $sum = (int) $opencodes[0] + (int) $opencodes[1];
        $zjcount = 0;
        if (($tzcode == '冠亚大' || $tzcode == '大') && $sum > 11) {
            $zjcount++;
        } elseif (($tzcode == '冠亚小' || $tzcode == '小') && $sum < 12) {
            $zjcount++;
        }
        return $zjcount;
    }

    //整合,冠亚单双
    function zh_dan_shuang($opencode, $tzcode, $playtitle) {
        $opencodes = explode(',', $opencode);

        $sum = (int) $opencodes[0] + (int) $opencodes[1];
        $zjcount = 0;
        if (($tzcode == '冠亚单' || $tzcode == '单') && $sum % 2 == 1) {
            $zjcount++;
        } elseif (($tzcode == '冠亚双' || $tzcode == '双') && $sum % 2 == 0) {
            $zjcount++;
        }
        return $zjcount;
    }

    //,冠亚和值
    function gy_sum($opencode, $tzcode, $playtitle) {
        $opencodes = explode(',', $opencode);

        $sum = (int) $opencodes[0] + (int) $opencodes[1];
        $zjcount = 0;
        if ($tzcode == $sum) {
            $zjcount++;
        }
        return $zjcount;
    }

    //,冠亚和值
    function gyzh($opencode, $tzcode, $playtitle) {
        //$tzcodes = explode('-', $tzcode);
        $opencodes = explode(',', $opencode);

        $gyzh = (int) $opencodes[0] . '-' . (int) $opencodes[1];
        // echo $gyzh;exit;
        $zjcount = 0;
        if ($gyzh == $tzcode) {
            $zjcount++;
        }
        return $zjcount;
    }

    //,第1-10名
    function one_ten($opencode, $tzcode, $playtitle) {
        //$tzcodes = explode('-', $tzcode);

        $playtitles = explode('-', $playtitle);
        //echo $playtitles[2];exit;
        if ($playtitles[2] == '冠军') {
            $title = '一';
        } elseif ($playtitles[2] == '亚军') {
            $title = '二';
        } else {
            $title = mb_substr($playtitle, -2, 1, 'utf-8');
        }

        //dump($playtitles); 
        //echo $title;
        $ma = ['0' => '一', '1' => '二', '2' => '三', '3' => '四', '4' => '五', '5' => '六', '6' => '七', '7' => '八', '8' => '九', '9' => '十',];
        $key = array_search($title, $ma);
        $opencodes = explode(',', $opencode);
        // echo $gyzh;exit;
        $zjcount = 0;
        if ((int) $opencodes[$key] == $tzcode) {
            $zjcount++;
        }
        return $zjcount;
    }

}

?>