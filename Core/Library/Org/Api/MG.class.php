<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 19:11
 */

namespace Org\Api;
require_once  "Des.php";

class MG extends Des
{
    private $actype=0;//1表示 生产  0 测试
    private $balance_url = 'http://link.api.52miduo.com/api/MICROGAMING/GetBalance';
    private $login_url = 'http://link.api.52miduo.com/api/MICROGAMING/Login';
    private $trans_url= 'http://link.api.52miduo.com/api/MICROGAMING/Transfer';
    private $betRecord_url= 'http://link.api.52miduo.com/api/MICROGAMING/GetBetRecord';

    public function login($username,$game_code = null){
        $post_data = $this->request_url($username,$this->actype);
        unset($post_data['actype']);
       // $post_data['game_type'] = 'live';
        if(!is_null($game_code)){
            $post_data['game_code'] = $game_code;
          //  $post_data['game_type'] = 'egame';
        }else{
            $post_data['game_type'] = 'live';
        }
		$post_data['game_type'] = 'egame';
		$post_data['mobile'] = 'yes';
		//$post_data['mobile'] =  $this->isMobile()?'yes':'no';
        //$post_data['is_try'] = $this->actype;
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
    public function betRecord($start_time,$end_time,$game_type='live'){
        $post_data = $this->request_url('',$this->actype,0);
        unset($post_data['username']);
        unset($post_data['actype']);
        $post_data['FromDate'] = $start_time;
        $post_data['ToDate'] = $end_time;
        $post_data['game_type'] =$game_type;
        $res = $this->https_request($this->betRecord_url, $post_data);
        if($res['result']===1){
            if(is_array($res['data'])){
                $save_data = [];
                if($game_type=='live'){
                    foreach ($res['data'] as $idx=>$v){
                        $save_data[] = ['PlayerName'=>$v['AccountName'],'TableCode'=>$v['TableCode'],'BetTime'=>$v['Date'],
                            'BillNo'=>$v['RoundId'],'BetAmount'=>$v['Bet'],'NetAmount'=>$v['Profit'],'Flag'=>$v['TransactionStatus'],
                            'ValidBetAmount'=>$v['Bet'],'GameKind'=>$game_type,'CreateDate'=>date('Y-m-d H:i:s'),'GameType'=>'MG' ];
                    }
                }else{
                    foreach ($res['data'] as $idx=>$v){
                        $save_data[] = ['PlayerName'=>$v['AccountNumber'],'BetTime'=>$v['GameEndTime'],
                            'BetAmount'=>$v['TotalWager'],'Flag'=>$v['ProgressiveWage'],'GameKind'=>$game_type,
                            'NetAmount'=>$v['TotalPayout'],'ValidBetAmount'=>$v['TotalWager'],'CreateDate'=>date('Y-m-d H:i:s'),
                            'GameType'=>'MG' ];
                    }
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