<?php
function _t($str='',$num=20,$pad =' '){
   // $str = iconv('UTF-8','gbk',$str);
    return str_pad($str,$num,$pad);
}

function _title($title='开始采集'){
    echo "\n";
    echo _t(str_pad('-',35,'-').$title,80,'-');
    echo "\n";
    echo _t('【彩种】',15,' ')._t('【状态】',16,' ')._t('【最后更新】',16,' ')._t('【开奖号码】')."\n";
}

function _get_data($return){
    $info = array();
    preg_match('/-(.*):/i',$return,$data['date']);
    preg_match('/:(.*)$/i',$return,$data['number']);
    $info['date'] = !empty($data['date'][1])?$data['date'][1]:'';
    $info['number'] = !empty($data['number'][1])?$data['number'][1]:'';
    if(strpos($return,'采集成功') !==false){
        $info['status'] = '采集成功';
    }else{
        $info['status'] = !empty($info['number'])?'已采集':'采集错误';
    }
    return $info;
}

function _p($rule,$return){
    $data = _get_data($return);
    $str = _t($rule,10)."\t"._t('['.$data['status'].']',6)."\t"._t($data['date'],10)."\t"._t($data['number']);
    $str .= "\n";
    echo $str;
}