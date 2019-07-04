<?php
namespace Home\Controller;
use Think\Controller;
class ActivityController extends CommonController {
	public function __construct(){
		parent::__construct();
	}
	function index()
	{
		if($_SESSION['userinfo'])
		{
			$this->fanshui();
		}

		//查找所有会员组反水比例 积分 晋级奖励 跳级奖励
		$_membergroup =	 M('membergroup');
		$allbili=$_membergroup->field('fanshui,groupname,shengjiedu,jjje,tiaoji,touhan')->where('isagent<>1')->order('groupid ASC')->select();
		foreach ($allbili as $k => $v)
		{
			$_bilis[$k] = explode(';', str_replace('；', ';', $v['fanshui']));
			$_biliss[$k][0] = explode('|', $_bilis[$k][0]);
			$_biliss[$k][1] = explode('|', $_bilis[$k][1]);
			$_biliss[$k][2] = explode('|', $_bilis[$k][2]);
			$mintozhu[0] = explode('-', $_biliss[$k][0][0]);
			$mintozhu[1] = explode('-', $_biliss[$k][1][0]);
			$mintozhu[2] = explode('-', $_biliss[$k][2][0]);
			$_bilisss[$k][] = $v['groupname'];
			$_bilisss[$k][] = $_biliss[$k][0][1];
			$_bilisss[$k][] = $_biliss[$k][1][1];
			$_bilisss[$k][] = $_biliss[$k][2][1];
			$this->assign('mintozhu', $mintozhu);
			$this->assign('bilisss', $_bilisss);
			$this->assign('allbili', $allbili);
			$this->assign('maxjlje', $allbili[count($allbili)-1]['jjje']);
		}
		//查找会员是否有可领取的奖励
		$map['uid'] = $this->userinfo['id'];
		$jiangli = M("jinjijiangli")->where($map)->order("oddtime DESC")->select();
		$user = M('member')->where("id='{$this->userinfo['id']}'")->find();
		//比较会员表记录和晋级表记录取最大的会员等级为上次领取等级奖励
		$jiangli[0]['groupid'] = $jiangli[0]['groupid']>=$user['jinjijilu']?$jiangli[0]['groupid']:$user['jinjijilu'];

		//晋级
		if(empty($jiangli) && $user['jinjijilu']==1 )
		{   //如果为空则从普通会员算起,
			$jlje = $_membergroup->where("groupid = '{$this->userinfo['groupid']}'")->field('groupid,tiaoji')->find();
			if($user['groupid']<=$user['jinjijilu']){
				$this->assign('jlje',0);
			}else{
				$this->assign('jlje',$jlje['tiaoji']);
			}
		}else{
			//比较会员当前的会员等级与上次领取奖励的会员等
			if($user['groupid']<=$user['jinjijilu']){
				$this->assign('jlje',0);
			}else{
				if($user['groupid']<=$jiangli[0]['groupid'])
				{
					$this->assign('jlje',0);
				}else{
					$amount=0;
					//$user['groupid']-$jiangli[0]['groupid']==1?$a=1:$a=0;
					for ($i=($jiangli[0]['groupid']+1);$i<= $user['groupid'];$i++)
					{
						$amount +=$allbili[$i-1]['jjje'];
					}
//					if(($user['groupid']-$jiangli[0]['groupid'])>=2 && $jiangli[0]['groupid']!=1)$amount++;
					$this->assign('jlje',$amount.'.00');
				}
			}
		}
		//其它活动
		$otherhd = M('News')->cache(300)->where("catid='41'")->select();
		$this->assign('houdong1',$otherhd[5]['content']);
		$this->assign('houdong2',$otherhd[6]['content']);
		$this->assign('houdong3',$otherhd[7]['content']);
		$this->assign('houdong4',$otherhd[8]['content']);
		$this->assign('houdong5',$otherhd[9]['content']);
		$this->assign('jjlist',$jiangli);
		$this->display();
	}
	function fanshui(){
		$db = M('fanshui');
		$fsbl = M('Membergroup')->where("groupid='{$this->userinfo['groupid']}'")->getField('fanshui');
		$_yjlist = explode(';',str_replace('；',';',$fsbl));
		foreach($_yjlist as $k=>$v){
			$array = $array1 = array();
			$array = explode('|',$v);
			$array1= explode('-',$array[0]);
			$yjlist[$k]['min']  = $array1[0];
			$yjlist[$k]['max']  = $array1[1];;
			$yjlist[$k]['bilv'] = $array[1];
		}
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		//检测是否已领取
		$lastlqtime = $db->where("uid={$this->userinfo['id']}")->order('id desc')->getField('oddtime');
		$_t = time();

		if($lastlqtime)
		{
			if($_t-$lastlqtime<=86400)
			{//一天领取
				$lqtype = 1;
			}elseif($_t-$lastlqtime>86400 && $_t-$lastlqtime<86400*7)
			{//一周领取
				$lqtype = 2;
				$beginToday = $lastlqtime;
				$endToday   = $lastlqtime+86400*7;
			}else{//一月领取
				$lqtype = 3;
				$beginToday = $lastlqtime;
				$endToday   = $lastlqtime+86400*30;
			}
		}else{//未领取过
			$lqtype = 1;
		}
		$time = strtotime(date("Y-m-d",time()))-86400;
		$StartTime = strtotime(date("Y-m-d H:i:s",$time));  //昨天开始时间
		$EndTime = strtotime(date("Y-m-d ".'23:59:60',$time));//昨天结束时间


	 $touzhue = M('touzhu')->where("uid={$this->userinfo['id']} and isdraw!='-2' and isdraw!='0' and oddtime >= {$StartTime} and oddtime < {$EndTime}")->sum('amount');

		/*$touzhue = $touzhuinfo[0]['amount']?$touzhuinfo[0]['amount']:0;*/
		if($yjlist && $touzhue)foreach($yjlist as $k=>$v){
			if($v['min'] && $v['max']){
				if($touzhue>=$v['min'] && $touzhue<$v['max'])$yanyongs[]= $v;

			}elseif($v['min'] && !$v['max']){
				if($touzhue>=$v['min'])$yanyongs[]= $v;
			}
		}
		if($touzhue>0 && count($yanyongs)>=1){
			//当满足多个条件 取第一个
			$yanyongbili = current($yanyongs);
		}

		//奖励金额
		$jljine = ($yanyongbili['bilv']/100)*$touzhue;
		if($touzhue<$yjlist[0]['max'])$fanshuibili = $yjlist[0]['bilv'];
		if($touzhue>$yjlist[0]['max'] && $touzhue<$yjlist[1]['max'])$fanshuibili = $yjlist[1]['bilv'];
		if($touzhue>$yjlist[1]['max'] && $touzhue<$yjlist[2]['max'])$fanshuibili = $yjlist[2]['bilv'];
		$this->jljine = $jljine;
		$this->assign('yjlist',$yjlist);
		$this->assign('countamount',$touzhue);
		$this->assign('jiajiang',number_format($jljine,'2'));
		$this->assign('fanshuibili',$fanshuibili);

		$lqcount = $db->where("uid={$this->userinfo['id']} and oddtime < {$endToday} and oddtime >= {$beginToday}")->count();

		$this->beginToday = $beginToday;
		$this->endToday   = $endToday;
		$this->lqcount = $lqcount;
		/*领取列表*/
		$_map1 = array();
		$_map1['uid'] = array('eq',$this->userinfo['id']);
		$count      = $db->where($_map1)->count();
		$Page       = new \Think\Page($count,20);
		$this->pageshow       = $Page->show();
		$this->lqlist = $db->where($_map1)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		if(IS_AJAX)
		{
			if($this->userinfo['groupid']==10){
				$this->error('代理不能领取');
			}
			if($jljine<=0)
			{
				$this->error('暂无加奖可领取！');
			}
			switch($lqtype)
			{
				case 1:
					if($lqcount>=1)$this->error('今日已领取！');
					break;
				case 2:
					if($lqcount>=2)$this->error('非法操作！');
//					if($lqcount>=2)$this->error('下次领取时间：'.date('Y-m-d H时m分',$endToday).'以后领取！');
					break;
				case 3:
					if($lqcount>=3)$this->error('非法操作！');
//					if($lqcount>=3)$this->error('下次领取时间：'.date('Y-m-d H时m分',$endToday).'以后领取！');
					break;
			}
			$data = array();
			$data['uid']       = $this->userinfo['id'];
			$data['trano']       = gettrano();
			$data['username']  = $this->userinfo['username'];
			$data['groupname']  = $this->userinfo['groupname'];
			$data['touzhuedu'] = $touzhue;
			$data['yongjinfw'] = $yanyongbili['min'].'-'.$yanyongbili['max'].'|'.$yanyongbili['bilv'];
			$data['amount']    = $jljine;
			$data['bili']      = $yanyongbili['bilv'].'%';
			$data['oddtime']   = time();
			$data['shenhe']    = 1;
			$int = $db->data($data)->add();
			if($int){
				$logdata = [];
				$logdata['userid']   = $this->userinfo['id'];
				$logdata['username'] = $this->userinfo['username'];
				$logdata['type']     = 'fanshui';
				$logdata['info']     = "每日加奖,会员：".$this->userinfo['username'];
				$logdata['time']     = NOW_TIME;
				$logdata['ip']       = get_client_ip();
				$iparea = IParea(get_client_ip());
				$logdata['iparea']   = $iparea;
				$amountbefor = M('Member')->where("id='{$this->userinfo['id']}'")->getField('balance');
				M('member')->where("id='{$this->userinfo['id']}'")->setInc('balance',$jljine);
				//添加会员账户明细
				$fuddetaildata = [];
				$fuddetaildata['trano']      = $data['trano'];
				$fuddetaildata['uid']      = $this->userinfo['id'];
				$fuddetaildata['username'] = $this->userinfo['username'];
				$fuddetaildata['type']     = 'fanshui';
				$fuddetaildata['typename']     = '每日加奖';
				$fuddetaildata['remark']       =  '每日加奖通过';
				$fuddetaildata['oddtime']     = NOW_TIME;
				$fuddetaildata['amount']   = $jljine;
				$fuddetaildata['amountbefor']   = $amountbefor;
				$fuddetaildata['amountafter']   = $amountbefor + $jljine;
				M('fuddetail')->data($fuddetaildata)->add();
				$this->success('领取成功！');
			}else{
				$this->error('领取失败！');
			}
			return  $int;
		}
	}
	//晋级奖励
	function jinji()
	{
		if(IS_AJAX)
		{
			if($this->userinfo['groupid']==10)$this->error('代理不能领取奖励');
			//查找会员是否有可领取的奖励
			$map['uid'] = $this->userinfo['id'];
			$jiangli = M("jinjijiangli")->where($map)->order("oddtime DESC")->select();
			$user = M('member')->where("id='{$this->userinfo['id']}'")->find();
			$allgroup =	 M('membergroup');
			$jiangli[0]['groupid'] = $jiangli[0]['groupid']>=$user['jinjijilu']?$jiangli[0]['groupid']:$user['jinjijilu'];
			//晋级
			if($user['groupid']>$user['jinjijilu']){
				if(empty($jiangli))
				{   //如果为空则从普通会员算起,
					$jlje = $allgroup->where("groupid = '{$this->userinfo['groupid']}'")->field('tiaoji')->find();
					$jinji = M('')->table('__MEMBER__ m,__MEMBERGROUP__ p')->field('m.id,m.groupid,m.point,p.tiaoji,p.groupname')->where("m.groupid = p.groupid  AND m.id='{$this->userinfo['id']}' ")->find();
					$data['trano'] = gettrano();
					$data['uid']       = $this->userinfo['id'];
					$data['username']  = $this->userinfo['username'];
					$data['groupid']   = $jinji['groupid'];
					$data['beforegroupname']   =  $allgroup->where('groupid=1')->getField('groupname');
					$data['groupname']   = $jinji['groupname'];
					$data['point']   = $jinji['point'];
					$data['jlje']   = $jinji['tiaoji'];
					$data['oddtime']   = time();
					$data['shenhe']    = 0;
					$int =  M("jinjijiangli")->data($data)->add();
				}else{
					$allbili=$allgroup->field('fanshui,groupname,shengjiedu,jjje,tiaoji,touhan')->where('isagent<>1')->order('groupid ASC')->select();
					//比较会员当前的会员等级与上次领取奖励的会员等
					$user = M('member')->where("id='{$this->userinfo['id']}'")->find();
					if($user['groupid']<=$jiangli[0]['groupid'])  //如果当前会员等级小于或数椐库记录的会员等级则奖励为0
					{
						$this->assign('jlje',0);
					}else{
						$amount=0; 
						//$user['groupid']-$jiangli[0]['groupid']==1?$a=1:$a=0;
						for ($i=($jiangli[0]['groupid']+1);$i<= $user['groupid'];$i++)
						{
							$amount +=$allbili[$i-1]['jjje'];
							$groupname  = $allbili[$i-1]['groupname'];
						}
//						if(($user['groupid']-$jiangli[0]['groupid'])>=2 && $jiangli[0]!=1)$amount++;
					}
					$data['trano'] = gettrano();
					$data['uid']       = $this->userinfo['id'];
					$data['username']  = $this->userinfo['username'];
					$data['groupid']   = $user['groupid'];
					$data['beforegroupname'] =  $jiangli[0]['groupname']!=""?$jiangli[0]['groupname']:'VIP'.$jiangli[0]['groupid'];;
					$data['groupname'] = $groupname;
					$data['point']     = $user['point'];
					$data['jlje']      =  number_format($amount,2,".","");
					$data['oddtime']   = time();
					$data['shenhe']    = 0;
					$int =  M("jinjijiangli")->data($data)->add();
				}
			}else{
				$int = false;
			}
			if($int){
				$this->success('领取成功,请等待审核！');
			}else{
				$this->error('领取失败或你已经领取过！');
			}
			/*			if($int){
                            //管理操作日志
                            $logdata = [];
                            $logdata['userid']   = $this->userinfo['id'];
                            $logdata['username'] = $this->userinfo['username'];
                            $logdata['type']     = 'jinjishenhe';
                            $logdata['info']     = "晋级会员：".$this->userinfo['username'];
                            $logdata['time']     = NOW_TIME;
                            $logdata['ip']       = get_client_ip();
                            $iparea = IParea(get_client_ip());
                            $logdata['iparea']   = $iparea;
                            $amountbefor = M('Member')->where("id='{$this->userinfo['id']}'")->getField('balance');
                            M('member')->where("id='{$this->userinfo['id']}'")->setInc('balance',$data['jlje']);
                            M('member')->where("id='{$this->userinfo['id']}'")->setField('jinjijilu',$this->userinfo['groupid']);
                            //添加会员账户明细
                            $fuddetaildata = [];
                            $fuddetaildata['trano']      = $data['trano'];
                            $fuddetaildata['uid']      = $this->userinfo['id'];
                            $fuddetaildata['username'] = $this->userinfo['username'];
                            $fuddetaildata['type']     = 'jinjishenhe';
                            $fuddetaildata['typename']     = '晋级审核通过';
                            $fuddetaildata['remark']       = '晋级审核通过';
                            $fuddetaildata['oddtime']     = NOW_TIME;
                            $fuddetaildata['amount']   = $data['jlje'];
                            $fuddetaildata['amountbefor']   = $amountbefor;
                            $fuddetaildata['amountafter']   = $amountbefor + $data['jlje'];
                            M('fuddetail')->data($fuddetaildata)->add();
                            $this->success('领取成功！');
                        }else{
                            $this->error('领取失败或你已经领取过！');
                        }*/
			return  $int;


		}else{
			$this->error('非法操作');
		}
	}

	function hall(){
	    if(I('type')){
            $where['type'] =I('type');
        }
        $where['on_line'] =0;
	    $data =   M('activitie')->where($where)->order('created_at desc')->select();
        $this->assign('data',$data);
        $this->assign('type',I('type'));
		//公告
		$gonggao = M('gonggao')->field('id,title,content')->order('id desc')->find();
		$this->assign('gonggao',$gonggao);
        $this->display();
    }
    function activity_apply(){
	    if(IS_AJAX){
            $id=$_SESSION['userinfo']['id'];
            if(empty($id)){
                echo json_encode(['msg'=>'请登录']);exit;
            }
	        $activity_id = I('activity_id');
            $data['activity_id'] = $activity_id;
            $data['member_id'] = $id;
			//开始时间
			$tow = mktime(0,0,0,date('m'),date('d'),date('Y'));
			//结束时间
			$end = mktime(23,59,59,date('m'),date('d'),date('Y'));
			$data['created_at']  = array('between',array(date('Y-m-d H:i:s',$tow),date('Y-m-d H:i:s',$end)));
            $apply_id = M('activitieapply')->where($data)->getField('id');
            if($apply_id){
                echo json_encode(['msg'=>'你今天已经申请过了']);exit;
            }
            $data['created_at'] = date('Y-m-d H:i:s',time());
            $rest = M('activitieapply')->add($data);
            if($rest){
                echo json_encode(['msg'=>'申请成功请等待审核']);exit;
            }else{
                echo json_encode(['msg'=>'申请失败']);exit;
            }
        }
    }
    public function activeRecord(){
        $id = $_SESSION['userinfo']['id'];
		if(!$id){
			redirect(U("Public/login"));
		}
        $map['member_id'] = $id;
        $count      = M('activitieapply')
            ->join('caipiao_activitie ON caipiao_activitieapply.activity_id = caipiao_activitie.id')
            ->where($map)
            ->count();
        $Page       = new \Think\Page($count,9);
        startPage($Page);
        $data = M('activitieapply')
            ->where($map)
            ->join('caipiao_activitie ON caipiao_activitieapply.activity_id = caipiao_activitie.id')
            ->field('title,status,fail_reason,caipiao_activitieapply.created_at')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->order('caipiao_activitieapply.created_at desc')
            ->select();
        $this->pageshow= $Page->show();
        $this->assign('data',$data);
        $this->display();
    }
}
?>