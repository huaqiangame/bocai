<?php
namespace Home\Controller;
use Think\Controller;
class CesiController extends CommonController
{

    public function __construct()
    {

        parent::__construct();
    }





    Public function index()
    {
      $this->display();
    }

    function getArrSet($arrs,$_current_index=-1)
    {
        static $_total_arr;
        static $_total_arr_index;
        static $_total_count;
        static $_temp_arr;
        if($_current_index<0)
        {
            $_total_arr=array();
            $_total_arr_index=0;
            $_temp_arr=array();
            $_total_count=count($arrs)-1;
            $this->getArrSet($arrs,0);
        }
        else
        {
            foreach($arrs[$_current_index] as $v)
            {
                if($_current_index<$_total_count)
                {
                    $_temp_arr[$_current_index]=$v;
                    $this->getArrSet($arrs,$_current_index+1);
                }
                else if($_current_index==$_total_count)
                {
                    $_temp_arr[$_current_index]=$v;
                    $_total_arr[$_total_arr_index]=$_temp_arr;
                    $_total_arr_index++;
                }

            }
        }
        return $_total_arr;
    }


    // 阶乘
    protected function factorial($n)
    {
        return array_product(range(1, $n));
    }

    // 排列数
    protected function A($n,$m)
    {
        return self::factorial($n) / self::factorial($n - $m);
    }

    // 组合数
    protected function C($n, $m)
    {
        return self::A($n, $m) / self::factorial($m);
    }


    function combineArrUpdata($Number){
        $currNumber = $Number;
        for( $i = 0; $i < count($currNumber); $i++){
            for($j = 0; $j < count($currNumber[$i]); $j++){
                if($i == 0){
                    $this->d_balls[$currNumber[$i][$j]] = $currNumber[$i][$j];
                }else{
                    $this->t_balls[$currNumber[$i][$j]] = $currNumber[$i][$j];
                }
            }
            if($i == 0){
                $this->d_count = count($currNumber[$i]);
            }else{
                $this->t_count = count($currNumber[$i]);
            }
        }
    }



    // 排列
    protected function arrangement($a, $m)
    {
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
    protected function combination($a, $m)
    {
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


}