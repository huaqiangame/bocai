mn<?php
namespace Org\Api;
require_once  "Des.php";
class AgService extends Des{

    private $actype=1;//1表示 生产  0 测试
    private $balance_url = 'http://link.api.52miduo.com/api/AG2/GetBalance';
    private $login_user = 'http://link.api.52miduo.com/api/AG2/Login';
    private $trans_url= 'http://link.api.52miduo.com/api/AG2/Transfer';
    private $betRecord_url= 'http://link.api.52miduo.com/api/AG2/GetBetRecord';

    public function login($username,$game_code = null){
        $post_data = $this->request_url($username,$this->actype,1);
        $post_data['lang'] = 'ZH-CN';
        if(!is_null($game_code)){
            $post_data['game_code'] = $game_code;
        }
		//$post_data['mobile'] =  $this->isMobile()?'yes':'no';
		$post_data['mobile'] = 'no';
        $res = $this->docurl($this->login_user, $post_data,false);
        $back_res = json_decode($res,true);
        if(is_array($back_res)){
            $ret=array('code'=>-1,'msg'=>$back_res['msg'],'data'=>$back_res['data']);
        }else{
            $ret=array('code'=>1,'msg'=>'成功!','data'=>$res);
        }
        return $ret;
    }

  public function balance($username){

          $login_info = $this->login($username);
          if($login_info['code']===1){
              $post_data = $this->request_url($username,$this->actype);
              $res = $this->https_request($this->balance_url, $post_data);
              if($res&&$res["result"]===1){
                  $ret=array('code'=>1,'msg'=>$res['msg'],'balance'=>$res['data']['balance'],'login_url'=>$login_info['data']);
              }else{
                  $ret=array('code'=>-1,'balance'=>'---');
              }
          }else{
              $ret =$login_info;
          }
      return $ret;
  }

  public function trans($username,$action,$point){
      $post_data = $this->request_url($username,$this->actype,1);
      $post_data['action']= $action;
      $post_data['remit']= (int)$point;
      $res = $this->https_request($this->trans_url, $post_data);
      return $res;
  }

  public function betRecord($start_time,$end_time,$game_tye='live'){
      $post_data = $this->request_url('',$this->actype,0);

      unset($post_data['username']);
      unset($post_data['actype']);
      $post_data['FromDate'] = $start_time;
      $post_data['ToDate'] = $end_time;
      $post_data['game_type'] = $game_tye;
      $res = $this->https_request($this->betRecord_url, $post_data);
      $device_type = $this->isMobile()?1:0;
      if($res['result']===1){ 
          if(is_array($res['data']['bet_data'])&&!empty($res['data']['bet_data'])){
              $save_data = [];
			  foreach ($res['data']['bet_data'] as $idx=>$v){
				  $save_data[] = ['BillNo'=>$v['transaction_id'],'PlayerName'=>$v['player_name'],'GameCode'=>$v['gameCode'],
					  'NetAmount'=>$v['win'],'BetTime'=>$v['time'],'BetAmount'=>$v['bet'],
					  'ValidBetAmount'=>$v['valid_wager'],'Flag'=>$v['flag'],'TableCode'=>$v['tableCode'],
					  'RecalcuTime'=>$v['recalcuTime'],'BeforeCredit'=>$v['beforeCredit'],'game_name'=>$v['game_id'],
					  'CreateDate'=>date('Y-m-d H:i:s'),'DeviceType'=>$v['deviceType']?$v['deviceType']:$device_type,'GameType'=>'AG',
					  'result'=>$v['Result'],'GameKind'=>$v['game_type']==1?'live':'egame'];
			  }
			 if($save_data){
				$add_res = M('gamebetrecord')->addAll($save_data); 
			 }
              
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