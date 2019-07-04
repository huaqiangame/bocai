<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 19:18
 */

namespace Org\Api;
require_once  "Des.php";

class PT extends Des
{
    private $actype=0;//1表示 生产  0 测试
    private $balance_url = 'http://link.api.52miduo.com/api/PT/GetBalance';
    private $login_url = 'http://link.api.52miduo.com/api/PT/Login';
    private $trans_url= 'http://link.api.52miduo.com/api/PT/Transfer';
    private $betRecord_url= 'http://link.api.52miduo.com/api/PT/GetBetRecord';

    public function login($username,$game_code = null){
        $post_data = $this->request_url($username,$this->actype);
        unset($post_data['actype']);
        if(!is_null($game_code)){
            $post_data['game_code'] = $game_code;
        }

        $res = $this->docurl($this->login_url,$post_data);
        $back_res = json_decode($res,true);
        if(is_array($back_res)){
            $back_arr=['code'=>-1,'msg'=>$back_res['msg'],'data'=>$back_res['data']];
        }else{
            $back_arr=['code'=>1,'msg'=>'登录成功！','data'=>$res];
        }
        return $back_arr;
    }

    public function balance($username){
        $login_data = $this->login($username);
        $post_data = $this->request_url($username,$this->actype);
        unset($post_data['actype']);
        $res = $this->https_request($this->balance_url, $post_data);
        if($res&&$res["result"]===1){
            $ret=array('code'=>1,'msg'=>$res['msg'],'balance'=>$res['data']['balance'],'login_url'=>$login_data['data']);
        }else{
            $ret=array('code'=>-1,'balance'=>'---');
        }
        return $ret;
    }

    public function trans($username,$action,$point){
        $post_data = $this->request_url($username,$this->actype);
        unset($post_data['actype']);
        $post_data['action']= $action;
        $post_data['remit']= (int)$point;
        $res = $this->https_request($this->trans_url, $post_data);
        return $res;
    }
    public function betRecord($start_time,$end_time){
        $post_data = $this->request_url('',$this->actype,0);
        unset($post_data['username']);
        unset($post_data['actype']);
        $post_data['FromDate'] = $start_time;
        $post_data['ToDate'] = $end_time;
        $res = $this->https_request($this->betRecord_url, $post_data);
        if($res['result']===1){
            if(is_array($res['data']['bet_data']) && !empty($res['data']['bet_data'])){
                $save_data = [];
                foreach ($res['data']['bet_data'] as $idx=>$v){
                    $game_type = $v['game_type']=='1'?'live':'egame';
                    $save_data[] = ['PlayerName'=>$v['username'],'BetTime'=>$v['datetime'],'BillNo'=>$v['wagers_id'],
                        'GameCode'=>$v['game_code'],'BetAmount'=>$v['bet_amount'],'NetAmount'=>$v['pay_off'],
                        'ValidBetAmount'=>$v['bet_amount'],'GameKind'=>$game_type,'CreateDate'=>date('Y-m-d H:i:s'),
                        'GameType'=>'PT' ];
                }
				if($save_data)
					$add_res = M('gamebetrecord')->addAll($save_data);
                if($add_res){
                    $back_arr = array('code'=>1,'msg'=>'保存成功！');
                }else{
                    $back_arr = array('code'=>0,'msg'=>'保存失败！');
                }
            }else{
                $back_arr = array('code'=>1,'msg'=>'暂无投注数据！');
            }
        }else{
            $back_arr = array('code'=>0,'msg'=>$res['msg']);
        }
        return $back_arr;
    }
}