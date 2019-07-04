<?php
/*
function xml_encode($data, $charset = 'utf-8', $root = 'so') {
    $xml = '<?xml version="1.0" encoding="' . $charset .'"?>';
    $xml .= "<{$root}>";
    $xml .= array_to_xml($data);   
    $xml .= "</{$root}>";
    return $xml;
}

function xml_decode($xml, $root = 'so') {
    $search = '/<(' . $root . ')>(.*)<\/\s*?\\1\s*?>/s';
    $array = array();
    if(preg_match($search, $xml, $matches)){
        $array = xml_to_array($matches[2]);
    }
    return $array;
}*/

function array_to_xml($array) {
    if(is_object($array)){
        $array = get_object_vars($array);
    }
    $xml = '';
    foreach($array as $key => $value){
        $_tag = $key;
        $_id = null;
        if(is_numeric($key)){
            $_tag = 'item';
            $_id = ' id="' . $key . '"';
        }
        $xml .= "<{$_tag}{$_id}>";
        $xml .= (is_array($value) || is_object($value)) ? array_to_xml($value) : htmlentities($value);
        $xml .= "</{$_tag}>";
    }
    return $xml;
}

function xml_to_array($xml) {
    $search = '/<(\w+)\s*?(?:[^\/>]*)\s*(?:\/>|>(.*?)<\/\s*?\\1\s*?>)/s';
    $array = array ();
    if(preg_match_all($search, $xml, $matches)){
        foreach ($matches[1] as $i => $key) {
            $value = $matches[2][$i];
            if(preg_match_all($search, $value, $_matches)){
                $array[$key] = xml_to_array($value);
            }else{
                if('ITEM' == strtoupper($key)){
                    $array[] = html_entity_decode($value);
                }else{
                    $array[$key] = html_entity_decode($value);
                }
            }
        }
    }
    return $array;
}