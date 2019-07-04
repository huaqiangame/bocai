<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5
 * Time: 22:10
 */

namespace Admincenter\Controller;
use Think\Controller;

class LivecollectController extends Controller
{
       public function auto_collect(){
           $get_data = $_GET;
           $start_time = isset($_GET['start_time'])?$_GET['start_time']:'';
           //$start_time = $get_data['end_time'];
           if(empty($start_time)){///参数
               $start_time =  S('start_time');
           }
           if(empty($start_time)){//缓存
               $start_time =strtotime('2018-10-11 17:49:03');  //time();
           }
           $end_time = $start_time+3*60;
           if(empty($end_time) || empty($start_time)){
               exit(json_encode(['status'=>0,'msg'=>'无效的参数']));
           }
           $bet_model =M('gamebetrecord as g');
           $rule = M('backwater');
           $bet_data = $bet_model//->alias('g')
           ->field('g.*,m.parentid')
               ->join('LEFT JOIN  __MEMBER__ as m ON g.PlayerName = m.live_game_name')
               ->where(['g.CreateDate'=>['BETWEEN',[date('Y-m-d H:i:s',$start_time),date('Y-m-d H:i:s',$end_time)]]])
               ->select();
           // $rule->
           //   S('start_time',time(),array('type'=>'file'));
           foreach ($bet_data as $v){
               var_dump($v);
           }
       }

}