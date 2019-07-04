<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 20:19
 */

namespace Org\Api;

require_once  "Des.php";
class SANS extends Des
{
    private $actype=0;//1表示 生产  0 测试
    private $balance_url = 'http://link.api.52miduo.com/api/SANS/GetBalance';
    private $login_url = 'http://link.api.52miduo.com/api/SANS/Login';
    private $trans_url= 'http://link.api.52miduo.com/api/SANS/Transfer';
    private $betRecord_url= 'http://link.api.52miduo.com/api/SANS/GetBetRecord';

    public function login($username,$game_code = null){
        $post_data = $this->request_url($username,$this->actype);
        unset($post_data['actype']);
        if(!empty($game_code)){
            $post_data['game_code'] = $game_code;
        }
        $back_res = $this->https_request($this->login_url,$post_data);
        if(isset($back_res['pc'])&&$back_res['pc']!=''){
            if ($this->isMobile()){
                $back_arr=['code'=>1,'msg'=>'登录成功！','data'=>$back_res['mobile_hg']];
            }else{
                $back_arr=['code'=>1,'msg'=>'登录成功！','data'=>$back_res['pc']];
            }
        }else{
            $back_arr=['code'=>-1,'msg'=>$back_res['msg'],'data'=>$back_res['data']];
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
            if(is_array($res['data'])){
                $save_data = [];
                foreach ($res['data'] as $idx=>$v){
                    $save_data[] = ['BillNo'=>$v['transaction_id'],'PlayerName'=>$v['account_code'],'GameCode'=>$v['match_index'],
                        'BetAmount'=>$v['wager_stake'],'NetAmount'=>$v['win_amt'],'BetTime'=>$v['date_created'],
                        'ValidBetAmount'=>$v['final_stake'],'Flag'=>$v['betting_status'],'TableCode'=>$v['playtype_index'],
                        'result'=>"比分：".$v['score']."  队伍 A 名称:".$v['teamA_name']."队伍 B 名称:".$v['teamB_name'],
                        'RecalcuTime'=>$v['last_update'],'CreateDate'=>date('Y-m-d H:i:s'),'GameType'=>'SANS',];
                }
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