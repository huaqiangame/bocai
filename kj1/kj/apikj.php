<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function apikj($name) {
    $gamekey = $name;
    $uid = '911';
    //试用口令,返回的开奖数据为测试数据.具体以购买接口后获得的token为准
    $token = 'e3511b01247da50b18c352700b309436';
    $api = 'apiGameList';
    $time = (string) time();
    $key = md5(md5($time . '-' . $token));
    $site = 'api.jiekouapi.com';
    $name = $gamekey . '_cache';

    //设置缓存文件
    $cache_url = dirname(__FILE__) . DIRECTORY_SEPARATOR . $name . ".php";
    $filemtime = $second = time();
    if (is_file($cache_url)) {
        //缓存文件（最后更新时间）
        $filemtime = filemtime($cache_url);
        //缓存文件（更新频率设置）
        $second = 5;
    }
    if (!is_file($cache_url) || time() - $filemtime > $second) {
        // 主要接口源,返回json
        $url = "http://api.caipiaoapi.com/hall/nodeService/api_request?uid=" . $uid . "&md5=" . $key . "&api=" . $api . "&gamekey=" . $gamekey . "&time=" . $time . "&site=" . $site;
        //print_r($url); echo '<br/>';
        $data = file_get_contents($url);
        //echo $data; //echo '<br/>';

        if (empty($data)) {
            // 备用接口源,返回json
            $url = "http://api.jiekouapi.com/hall/hallService/api_request?uid=" . $uid . "&md5=" . $key . "&api=" . $api . "&gamekey=" . $gamekey . "&time=" . $time . "&site=" . $site;
            $data = file_get_contents($url);
        }

        $array = json_decode($data, true);
        //print_r($array);
        if (is_array($array) && isset($array['errorCode']) && $array['errorCode'] == 0) {
            file_put_contents($cache_url, $data, LOCK_EX);
        }
    }

    //读取缓存
    $data = file_get_contents($cache_url);
    $array = json_decode($data, true);
    return $array;
}
