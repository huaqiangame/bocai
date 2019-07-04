<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 8:56
 */

namespace Org\Api;

require_once  "Des.php";

class Bbin extends Des
{
    private $actype=0;//1表示 生产  0 测试
    private $balance_url = 'http://link.api.52miduo.co/api/BBIN/CheckUsrBalance';
    private $login_url = 'http://link.api.52miduo.co/api/BBIN/Login';
    private $trans_url= 'http://link.api.52miduo.co/api/BBIN/Transfer';
    private $betRecord_url = 'http://link.api.52miduo.co/api/BBIN/GetBetRecord';
    private $d_login_url = 'http://link.api.52miduo.co/api/BBIN/PlayGame';

    public function login($username,$page_site='live',$code=null){
        $post_data = $this->request_url($username,$this->actype);
        unset($post_data['actype']);
        $page_site = is_null($page_site)?'live':$page_site;
        $post_data['page_site'] = $page_site;
        $post_data['lang'] = 'zh-cn';
        $res = $this->docurl($this->login_url,$post_data);
        $back_res = json_decode($res,true);
        if(is_array($back_res)){
            $back_arr=['code'=>-1,'msg'=>$back_res['msg'],'data'=>$back_res['data']];
        }else{
            $back_arr=['code'=>1,'msg'=>'登录成功！','data'=>$res];
        }
        return $back_arr;
    }

    public function direct_login($username,$gamekind=5,$gametype=5042){
        $post_data = $this->request_url($username,$this->actype);
        unset($post_data['actype']); // gamekind=5&gametype=5010
        $post_data['gamekind'] = $gamekind;
        $post_data['gametype'] = $gametype;
        $res = $this->docurl($this->d_login_url,$post_data);
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
            $ret=array('code'=>1,'msg'=>$res['msg'],'balance'=>$res['data']['balance'],'login_url'=>'');
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

    public function betRecord($start_time,$end_time,$game_tye='1'){
        $post_data = $this->request_url('',$this->actype,0);
        unset($post_data['username']);
        unset($post_data['actype']);
        $post_data['FromDate'] = $start_time;
        $post_data['ToDate'] = $end_time;
        $post_data['rType'] =$game_tye;
        $res = $this->https_request($this->betRecord_url, $post_data);
        if($res['result']===1){
            if(is_array($res['data'])){
                $save_data = [];
                switch ($game_tye){
                    case 1:
                        $game_kind='live';
                        break;
                    case 2:
                        $game_kind='lottery';
                        break;
                    case 3:
                        $game_kind='egame';
                        break;
                    case 4:
                        $game_kind='sport';
                        break;
                    default:
                        $game_kind ='';
                        break;
                }
                foreach ($res['data'] as $idx => $v) {
                    $save_data[] = ['BillNo' => $v['WagersID'], 'PlayerName' => $v['UserName'], 'BetTime' => $v['WagersDate'],
                        'GameCode' => $v['SerialID'], 'TableCode' => $v['RoundNo'],  'result' => $v['WagerDetail'],
                        'BetAmount' => $v['BetAmount'], 'DeviceType' => $v['Origin'], 'ValidBetAmount' => $v['Commissionable'],
                        'Flag' => $v['IsPaid'], 'NetAmount' => $v['Result'],'GameKind'=>$game_kind,'CreateDate'=>date('Y-m-d H:i:s'),
                        'GameType'=>'BBIN'];
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