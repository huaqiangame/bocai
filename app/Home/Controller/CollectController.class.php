<?php
namespace Home\Controller;
use Think\Controller;
class CollectController extends Controller{
    public $_parent = array();
    public function index(){
        $redis = new \Think\Cache\Driver\Redis();
        $start_time = $redis->get('start_time');
        if(empty($start_time)){
            $redis->set('start_time',time());
            return false;
        }else{
            $redis->set('start_time',time());
            $now_time = time();
            $start = date("Y-m-d",$start_time).'T'.date('H:i:s',$start_time);
            $end =   date("Y-m-d",$now_time).'T'.date('H:i:s',$now_time);
        }
		set_time_limit(0);
        $game_type = [];
        $model = M('real_person');
        $data = $model->field('id,name')->cache(true)->select();
        foreach ($data as $idex=>$v){
            switch ($v['name']){
                case "AG":
                    $service = new \Org\Api\AgService();
                    $game_type=['live','egame'];
                    break;
                case 'ALLBET':
                    $service = new \Org\Api\Allbet();
                    break;
                case 'BBIN':
                    $service = new \Org\Api\Bbin();
                    $game_type=['1','2','3','4'];
                    break;
                case 'KY':
                    $service = new \Org\Api\KY();
                    break;
                case 'MG':
                    $service = new \Org\Api\MG();
                    $game_type=['live','egame'];
                    break;
                case 'PT':
                    $service = new \Org\Api\PT();
                    break;
                case 'SUNBET':
                    $service = new \Org\Api\SUNBET();
                    break;
                case 'VR':
                    $service = new \Org\Api\VR();
                    break;
                case 'DT':
                    $service = new \Org\Api\DT();
                    break;
                case 'OG':
                    $service = new \Org\Api\OG();
                    break;
                case 'SANS':
                    $service = new \Org\Api\SANS();
                    break;
            }
			if(method_exists($service,'betRecord')){
				$trans_data = $service->betRecord($start,$end);
			}else{
			   exit();	
			}
        }
		
        $bet_model =M('gamebetrecord as g');
        //$rule = M('backwater');
        $bet_data = $bet_model//->alias('g')
            ->field('g.*,m.parentid,m.parentid,m.live_fandian,m.id as mid ,m.username,f.live,f.egame,f.sport,f.lottery,f.chess')
            ->join('LEFT JOIN  __MEMBER__ as m ON g.PlayerName = m.live_game_name')
            ->join('LEFT JOIN  __RECREATION_FANDIAN__ as f ON f.member_id = m.id')
            ->where(['g.CreateDate'=>['BETWEEN',[date('Y-m-d H:i:s',$start_time),date('Y-m-d H:i:s',$now_time)]]])
            ->select();
        $all_fandian_arr = array();
        $all_fandian = M('recreation_fandian')->field('live,member_id,egame,sport,lottery,chess')->select();
        foreach ($all_fandian as $value){
            $all_fandian_arr[$value['member_id']] = $value;
        }
       // $bet_model =M('gamebetrecord as g');
        //添加会员账户明细
        if($bet_data){
            $remark ='';
            foreach ($bet_data as $value){
				if(!$value['parentid'] == 0){
					$i = 1;
					$trano = gettrano(1);
					$this->dailifandian($value['parentid'],$value['GameKind'],$value['BetAmount'],$trano,$value['mid'],$value['username'],$all_fandian_arr,$i,$value['GameType']);

					
					foreach($this->_parent as $k => $v){
						$dailidata[] = array('uid' => $v['uid'],'username'=>$v['username'],'amount'=>$v['fandianjine'],'touzhujine'=>$v['touzhujine'],'trano'=>$v['trano'],
										'fandian'=>$v['fandian'],'shenhe'=>1,'xiajiid'=>$v['xiajiid'],'xiajiuser'=>$v['xiajiuser'],'xiajifandian'=>$v['xiajifandian'],'oddtime'=>time());
										
						$amountbefor = M('Member')->where("id='{$v['uid']}'")->getField('balance');
						M('member')->where("id='{$v['uid']}'")->setInc('balance',$v['fandianjine']);
						//添加会员账户明细
						$fuddetaildata[] = array('trano'=>$v['trano'],'uid'=>$v['uid'],'username'=>$v['username'],'type'=>'live_fandian','typename'=>'佣金发放',
										   'remark'=>$remark?$remark:$v['game_type'].'佣金发放','oddtime'=>NOW_TIME,'amount'=>$v['fandianjine'],'amountbefor'=> $amountbefor,
					'amountafter'=>$amountbefor + $v['fandianjine']);
					}
				
					if($dailidata){
						M('dailifandian')->addAll($dailidata);
					}
					if($fuddetaildata){
						M('fuddetail')->addAll($fuddetaildata);
					}
				}
            }
        }
        exit();
    }

    // 递归处理代理返点
    function dailifandian($parentid,$game_kind,$amount,$trano,$xiajiid,$xiajiuser,$fandianArr,$i,$GameType){
        //查找上级的返点
        $fandian = $fandianArr[$parentid];//M('recreation_fandian')->where('member_id='.$parentid)->find();
        $fandian_param = 0;
        $current_fandian = $fandianArr[$xiajiid];
        switch ($game_kind){
            case 'egame':
                $fandian_param = $fandian['egame'];
                $cur_fandian_param = $current_fandian['egame'];
                break;
            case 'sport':
                $fandian_param = $fandian['sport'];
                $cur_fandian_param = $current_fandian['sport'];
                break;
            case 'lottery':
                $fandian_param = $fandian['lottery'];
                $cur_fandian_param = $current_fandian['lottery'];
                break;
            case 'chess':
                $fandian_param = $fandian['chess'];
                $cur_fandian_param = $current_fandian['chess'];
                break;
            case 'live':
            default:
                 $fandian_param = $fandian['live'];
                $cur_fandian_param = $current_fandian['live'];
                break;
        }
        $where['id'] = $parentid;
        $daili = M('member')->field('id,parentid,live_fandian,username')->cache(true,50)->where($where)->find();
        $fandianjine = (($fandian_param-$cur_fandian_param)/100)*$amount;          //第一次反点金额 (代理返点-下级返点)/100*下级投注金额
        $this->_parent[$i]["fandianjine"] = abs($fandianjine);
        $this->_parent[$i]["uid"] = $parentid;
        $this->_parent[$i]["fandian"] = $fandian_param;
        $this->_parent[$i]["xiajiid"] = $xiajiid;
		$this->_parent[$i]["game_type"] = $GameType;
        $this->_parent[$i]["xiajiuser"] = $xiajiuser;
        $this->_parent[$i]["xiajifandian"] = $cur_fandian_param;
        $this->_parent[$i]["username"] = $daili['username'];
        $this->_parent[$i]["touzhujine"]  = $amount;
        $this->_parent[$i]["trano"] = $trano;
        $this->_parent[$i]["oddtime"] = time();
        $i++;
        if($daili['parentid']!='0'){
            $this->dailifandian($daili['parentid'],$game_kind,$amount,$trano,$daili['id'],$daili['username'],$fandianArr,$i,$GameType);
        }
    }

  
}