<?php
namespace Admincenter\Controller;
use Think\Controller;
use Think\Db;

class ZhenrenController extends Controller {
	
	function merchant(){
		 $BbinService=new \Org\Util\BbinService();
		 $ret=$BbinService->credit();
		 if($ret&&$ret['Code']==0){
			  $bbcredit=$ret['Data']['Credit'];
		 }else{
			 $bbcredit="---";
		 }
		
		 $AgService=new \Org\Util\AgService();
		 $ret=$AgService->credit();
	
		 if($ret&&$ret['Code']==0){
			  $agcredit=$ret['credit'];
		 }else{
			 $agcredit="---";
		 }
		$this->assign('bbcredit',$bbcredit);
		$this->assign('agcredit',$agcredit);
		$this->display();
	}
	function transrecord(){
		$condition=array();
		$transType=I("transType");
		$sDate=I("sDate");
		$eDate=I("eDate");
		
		if($transType){
			$condition['trans.transType']=$transType;
			$this->assign('transType',$transType);
		}
		$username=I("username");
		if($username){
			$condition['mem.username']=$username;
			$this->assign('username',$username);
		}
		if($sDate){
			$this->assign('sDate',$sDate);
			$sDate=date("$sDate 00:00:00");
		}
		if($eDate){
			$this->assign('eDate',$eDate);
			$eDate=date("$eDate 23:59:59");
			
		}
		if($sDate&&$eDate){
			$condition['trans.transTime']=array(array("egt",$sDate),array("elt",$eDate),"and");
		}elseif($sDate){
			$condition['trans.transTime']=array("egt",$sDate);
		}elseif($eDate){
			$condition['trans.transTime']=array("elt",$eDate);
		}
		
		
		$_pagasize  = 10;
		$count      = D("Transrecord")->alias("trans")->join("caipiao_member mem on mem.id=trans.uid")->where($condition)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$dataList=D("Transrecord")->alias("trans")->join("caipiao_member mem on mem.id=trans.uid")->where($condition)->order("trans.transID desc")->select();
		$this->assign('totalcount',$count);
		$this->assign('list',$dataList);
		$this->assign('page',$show);
		$this->display();
	}
	
	function agztreport(){
	
	
		$condition=array();
		
		$sDate=I("sDate");
		$eDate=I("eDate");
		
	   
		$username=I("username");
		if($username){
		
			$condition['PlayerName']=$username;
			$this->assign('username',$username);
		}
		if($sDate){
			$this->assign('sDate',$sDate);
			$sDate=date("$sDate 00:00:00");
		}
		if($eDate){
			$this->assign('eDate',$eDate);
			$eDate=date("$eDate 23:59:59");
			
		}
		if($sDate&&$eDate){
			$condition['WagersDate']=array(array("egt",$sDate),array("elt",$eDate),"and");
		}elseif($sDate){
			$condition['WagersDate']=array("egt",$sDate);
		}elseif($eDate){
			$condition['WagersDate']=array("elt",$eDate);
		}
		
		
		$_pagasize  = 10;
		$count      = D("Agbetrecord")->where($condition)->group("PlayerName")->count();
	
		
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$dataList=D("Agbetrecord")->field("PlayerName,count(*) nums,sum(NetAmount) TNetAmount,sum(ValidBetAmount) TValidBetAmount,sum(BetAmount) TBetAmount")->where($condition)->group("PlayerName")->select();

		
		$this->assign('totalcount',$count);
		$this->assign('list',$dataList);
		$this->assign('page',$show);
		$this->display();

	}
	
	function bbtzreport(){
		
		
		$condition=array();
		
		$sDate=I("sDate");
		$eDate=I("eDate");
		
	   
		$username=I("username");
		if($username){
		
			$condition['UserName']=$username;
			$this->assign('username',$username);
		}
		if($sDate){
			$this->assign('sDate',$sDate);
			$sDate=date("$sDate 00:00:00");
		}
		if($eDate){
			$this->assign('eDate',$eDate);
			$eDate=date("$eDate 23:59:59");
			
		}
		if($sDate&&$eDate){
			$condition['BetTime']=array(array("egt",$sDate),array("elt",$eDate),"and");
		}elseif($sDate){
			$condition['BetTime']=array("egt",$sDate);
		}elseif($eDate){
			$condition['BetTime']=array("elt",$eDate);
		}
		
		
		$_pagasize  = 10;
		
		$count      = D("Bbbetrecord")->where($condition)->group("UserName")->count();
		
	
		
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$dataList=D("Bbbetrecord")->field("UserName,count(*) nums,sum(Payoff) TNetAmount,sum(BetAmount) TValidBetAmount,sum(BetAmount) TBetAmount")->where($condition)->group("UserName")->select();
		$this->assign('totalcount',$count);
		$this->assign('list',$dataList);
		$this->assign('page',$show);
		$this->display();
	

	}

	function agztrecord(){
	
	
		$condition=array();
		
		$sDate=I("sDate");
		$eDate=I("eDate");
		
	   
		$username=I("username");
		if($username){
		
			$condition['PlayerName']=$username;
			$this->assign('username',$username);
		}
		if($sDate){
			$this->assign('sDate',$sDate);
			$sDate=date("$sDate 00:00:00");
		}
		if($eDate){
			$this->assign('eDate',$eDate);
			$eDate=date("$eDate 23:59:59");
			
		}
		if($sDate&&$eDate){
			$condition['WagersDate']=array(array("egt",$sDate),array("elt",$eDate),"and");
		}elseif($sDate){
			$condition['WagersDate']=array("egt",$sDate);
		}elseif($eDate){
			$condition['WagersDate']=array("elt",$eDate);
		}
		
		
		$_pagasize  = 10;
		$count      = D("Agbetrecord")->where($condition)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$dataList=D("Agbetrecord")->where($condition)->order("agId desc")->select();
		
		$this->assign('totalcount',$count);
		$this->assign('list',$dataList);
		$this->assign('page',$show);
		$this->display();

	}
	
	function bbtzrecord(){
		$condition=array();
		$sDate=I("sDate");
		$eDate=I("eDate");
		
	   
		$username=I("username");
		if($username){
		
			$condition['UserName']=$username;
			$this->assign('username',$username);
		}
		if($sDate){
			$this->assign('sDate',$sDate);
			$sDate=date("$sDate 00:00:00");
		}
		if($eDate){
			$this->assign('eDate',$eDate);
			$eDate=date("$eDate 23:59:59");
			
		}
		if($sDate&&$eDate){
			$condition['BetTime']=array(array("egt",$sDate),array("elt",$eDate),"and");
		}elseif($sDate){
			$condition['BetTime']=array("egt",$sDate);
		}elseif($eDate){
			$condition['BetTime']=array("elt",$eDate);
		}
		
		
		$_pagasize  = 10;
		$count      = D("Bbbetrecord")->where($condition)->count();
		$Page       = new \Think\Page($count,$_pagasize);
		$show       = $Page->show();
		$dataList=D("Bbbetrecord")->where($condition)->order("bbId desc")->select();
		
		$this->assign('totalcount',$count);
		$this->assign('list',$dataList);
		$this->assign('page',$show);
		$this->display();
	

	}
	
	function getrecords(){
		$this->display();
		

	}
	
	public function Agbetrecord(){
		
		  
		   $this->display();
		
	}
	
	public function Bbbetrecord(){
		
		  
		   $this->display();
		
	}
	
	public function getAgRecord(){
		 date_default_timezone_set("UTC");
		    $n=0;
		   $startDate=date("Y-m-d 00:00:00");
		   $endDate=date("Y-m-d H:i:s");
		   $AgService=new \Org\Util\AgService();
		   $recordList=$AgService->betrecord($startDate,$endDate,1,500);
		   $zxrecordList=$recordList['Data']["Records"];
		   $dataList=array();
		   try{
			  foreach($zxrecordList as $record){
				  
				   $BillNo=$record['BillNo'];
				  //判断记录是否存在
				   $enx=D("Agbetrecord")->where(array("BillNo"=>$BillNo))->count();
				   if(empty($enx)){
					   $n++;
					   $dataList[]=array("DataType"=>$record['DataType'],"BillNo"=>$record['BillNo'],"NetAmount"=>$record['NetAmount'],
						"GameType"=>$record['GameType'],"BetAmount"=>$record['BetAmount'],
						"ValidBetAmount"=>$record['ValidBetAmount'],"Flag"=>$record['Flag'],"BetTime"=>$record['BetTime']
						,"TableCode"=>$record['TableCode'],"RecalcuTime"=>$record['RecalcuTime'],"LoginIP"=>$record['LoginIP'],
						"PlayerName"=>$record['PlayerName'],"AgentCode"=>$record['AgentCode'],"GameCode"=>$record['GameCode'],
						"CreateDate"=>$record['CreateDate'],"Round"=>$record['Round'],"BeforeCredit"=>$record['BeforeCredit']);
						
				   }
			   }
		       D("Agbetrecord")->addAll($dataList); 
	
		   }catch(Exception $e){
			   $n=0;
		   }
		   $ret=array('code'=>1,"nums"=>$n);
		   $this->ajaxReturn($ret);
	}
		 
	
	
	 public function getBbrecord(){//获取下注记录
	     date_default_timezone_set("UTC");
	       $n=0;
		   $nDate=date("Y-m-d");
		   $nTime=date("H:i:s");
		   $BbinService=new \Org\Util\BbinService();
		   $recordList=$BbinService->getGameRecord($nDate, "00:00:00" , $nTime, 3,'','',1,500);
		   $zxrecordList=$recordList['Data'];
		   $dataList=array();
		   try{
			  foreach($zxrecordList as $record){
				  
				   $WagersID=$record['WagersID'];
				  //判断记录是否存在
				   $enx=D("Bbbetrecord")->where(array("WagersID"=>$WagersID))->count();
				   if(empty($enx)){
					   $n++;
					   $dataList[]=array("UserName"=>$record['UserName'],"WagersID"=>$record['WagersID'],
						"WagersDate"=>$record['WagersDate'],"SerialID"=>$record['SerialID'],
						"RoundNo"=>$record['RoundNo'],"GameType"=>$record['GameType'],"WagerDetail"=>$record['WagerDetail']
						,"GameCode"=>$record['GameCode'],"Result"=>$record['Result'],"Card"=>$record['Card'],
						"BetAmount"=>$record['BetAmount'],"Origin"=>$record['Origin'],"Commissionable"=>$record['Commissionable'],
						"Payoff"=>$record['Payoff'],"ExchangeRate"=>$record['ExchangeRate']);
						
				   }
			   }
		       D("Bbbetrecord")->addAll($dataList); 
		   }catch(Exception $e){
			   $n=0;
		   }
		   $ret=array('code'=>1,"nums"=>$n);
		   $this->ajaxReturn($ret);
		  
		
	}

    public function gamerecord()
    {
        $post_data = I('game_type');
        $before_date = strtotime('-3 day');
        $sDate = I('sDate') ? I('sDate') : $before_date;
        $eDate = I('eDate') ? I('eDate') : time();

        $sDate = date('Y-m-d H:i:s',$sDate);
        $eDate = date('Y-m-d H:i:s',$eDate);
        $map['BetTime'] = array('between', array($sDate, $eDate));
        if (!empty(I('username'))) {
            $map['m.username'] = I('username');
        }
        $record_model = M('gamebetrecord');
        switch ($post_data) {
            case 'AG'://
                $record_data = $record_model->join('__MEMBER__ ON __MEMBER__.live_game_name = __GAMEBETRECORD__.PlayerName ','LEFT')
                    ->field('username,count(*) as num,sum(BetAmount) as BetAmount,sum(ValidBetAmount) as ValidBetAmount,sum(NetAmount) as NetAmount')
                    ->where($map)->group('PlayerName')->select();
                break;
            default:
                break;
        }

        $this->assign('list', $record_data);
        $this->assign('game_type', $post_data);
        $this->display();
    }
    public function userrecord(){
        $post_data = I('game_type');
        switch ($post_data){
            case 'AG':
                break;
            default:
                break;
        }
        $this->display();
    }
}