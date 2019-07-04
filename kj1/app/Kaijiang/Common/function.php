<?php
// 排列  
function arrangement($a, $m) {  
    $r = array();  
  
    $n = count($a);  
    if ($m <= 0 || $m > $n) {  
        return $r;  
    }  
  
    for ($i=0; $i<$n; $i++) {  
        $b = $a;  
        $t = array_splice($b, $i, 1);  
        if ($m == 1) {  
            $r[] = $t;  
        } else {  
            $c = arrangement($b, $m-1);  
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
  
    for ($i=0; $i<$n; $i++) {  
        $t = array($a[$i]);  
        if ($m == 1) {  
            $r[] = $t;  
        } else {  
            $b = array_slice($a, $i+1);  
            $c = combination($b, $m-1);  
            foreach ($c as $v) {  
                $r[] = array_merge($t, $v);  
            }  
        }  
    }  
  
    return $r;  
}  
function comuniquesort($a){
	$b = [];
	foreach($a as $k=>$v){
		sort($v);
		$b[implode('',$v)] = $v;
	}
	return $b;
}