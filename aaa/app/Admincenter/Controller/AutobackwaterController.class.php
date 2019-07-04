<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/19
 * Time: 15:52
 */
namespace Admincenter\Controller;
use Think\Controller;

class AutobackwaterController extends Controller
{

    private function range($amount,$rang_arr){
        $back_arr = array();
        foreach ($rang_arr as $v){
            if($v['low_amount']<=$amount && $v['height_amount']>=$amount){
                $back_arr = $v;
                break;
            }
        }
        return $back_arr;
    }

    private function water_log($cp_statistical_data,$level_res,$pre_day,$end_day){
        if(!empty($cp_statistical_data)){
            $water_log = array();
            foreach ($cp_statistical_data as $v){
                if($v['amount']>0){
                    $level_arr = $this->range($v['amount'],$level_res);
                    $scale = 0;
                    $comment = '';
                    switch ($v['GameKind']){
                        case 'live':
                            $scale = $level_arr['live_scale'];
                            $comment ='直播';
                            break;
                        case 'egame':
                            $scale = $level_arr['electron_scale'];
                            $comment ='电子';
                            break;
                        case 'sports':
                            $scale = $level_arr['sports_scale'];
                            $comment ='体育';
                            break;
                        case 'lottery':
                            $scale = $level_arr['cp_scale'];
                            $comment ='彩票';
                            break;
                    }

                    if($scale>0){
                        $water_amount = $scale/100*$v['amount'];
                        $water_log[] = array('user_id'=>$v['uid'],'back_comment'=>$comment,
                            'level_id'=>$level_arr['level'],'amount'=>$v['amount'],'back_amount'=>$water_amount,
                            'back_scale'=>$scale,'back_date_start'=>strtotime($pre_day),'game_type'=>$v['GameType'],
                            'back_date_end'=>strtotime($end_day),'create_time'=>time(),'back_type'=>1,'game_kind'=>$v['GameKind']);

                    }
                }
            }
            if($water_log){
                M('water')->addAll($water_log);
            }
        }
    }

    public function auto_back_water(){
        $bck_tm = M('setting')->field('value,name')->where(['name'=>'backwatertime'])->find();
        $start_yesterday = date("Y-m-d 00:00:00", strtotime("-1 day") );
        $end_yesterday = date("Y-m-d 23:59:59", strtotime("-1 day") );
/*      $time_hour = $bck_tm?$bck_tm['value']:'14:00';
        $end_day_format = date('Y-m-d')." ".$time_hour;//结束时间
        $end_day = empty($end_day)?time():strtotime($end_day_format);
        $pre_day = strtotime('-1 day',$end_day);*/

        $level_res = M('backwater')->select();
        if(!$level_res){
            exit(json_encode(['status'=>0,'msg'=>'请填写返水规则！']));
        }
        /**
         * 本地彩票
         */
         /*$cp_statistical_data = M('touzhu')->field('uid,sum(amount) as amount')
             ->where(['oddtime'=>['between',$pre_day,$end_day],'opencode'=>['neq','']])
            ->group('uid')->select();

         $this->water_log($cp_statistical_data,$level_res,$pre_day,$end_day);*/


        /**
         * 真人游戏
         */
        $bet_model =M('gamebetrecord as g');//->alias('g')
        $bet_data = $bet_model
            ->field('m.id as uid,sum(BetAmount) as amount,g.GameKind,g.GameType')
            ->join('LEFT JOIN  __MEMBER__ as m ON g.PlayerName = m.live_game_name')
            ->where(['g.CreateDate'=>['BETWEEN',[$start_yesterday,$end_yesterday]]])
            ->group('m.id,g.GameKind')->select();
        if($bet_data){
            $this->water_log($bet_data,$level_res,$start_yesterday,$end_yesterday);
        }

        exit();
    }
}