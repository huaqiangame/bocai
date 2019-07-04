<?php
namespace Mobile\Controller;
use Think\Controller;
class ApijiekouController extends \Common\Controller\ApijiekouController {
	public function __construct(){
		parent::__construct();
	}
	function checkislogin(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$Result = islogin();
		unset($Result['auth']);
		unset($Result['data']['isnb']);
		unset($Result['data']['password']);
		unset($Result['data']['tradepassword']);
		echo jsonreturn($Result);
	}
	function webconfigs(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$data['webtitle'] = C('webtitle');
		$data['kefuthree'] = C('kefuthree');
		$data['kefuqq'] = C('kefuqq');
		$apiparam=array();
		$apiparam['webconfigs'] = $data;
		$apiparam['sign'] = true;
		echo jsonreturn($apiparam);
	}
	//获取会员账变类型
	function getfuddetailtypes(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$fuddetailtypes = C('fuddetailtypes');
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['fuddetailtypes'] = $fuddetailtypes;
		echo jsonreturn($apiparam);
	}
	//获取第三方支付跳转地址
	function getpayhost(){
		$paytype = I('paytype');
		$bankpaylists = C('bankpaylists');
		if(!$bankpaylists[$paytype]){
			$apiparam['sign'] = false;
			$apiparam['message'] = '支付方式不存在';
			echo jsonreturn($apiparam);exit;
		}
		$redirecturl = $bankpaylists[$paytype]["configs"]['redirecturl'];
		if(!$redirecturl){
			$apiparam['sign'] = false;
			$apiparam['paysetinfo'] = $bankpaylists[$paytype];
			$apiparam['message'] = '支付接口维护中';
			echo jsonreturn($apiparam);exit;
		}
		$apiparam['sign'] = true;
		$apiparam['message'] = '获取成功';
		$apiparam['redirecturl'] = $redirecturl;
		echo jsonreturn($apiparam);exit;
	}
	//获取彩票列表 、包含最后一起的开奖
	function getLottery(){
		$lotteryname = I('lotteryname');
		$cptype = I("cptype");
		$_cplist = array_merge(C('cplist.k3'),C('cplist.ssc'),C('cplist.x5'),C('cplist.keno'),C('cplist.dpc'),C('cplist.pk10'),C('cplist.lhc'));
		$opencodes = F('opencodes');
		$cplist = [];
		foreach($_cplist as $k=>$v){
			if($v['isopen']==0)unset($_cplist[$k]);
			$v['expect'] = $opencodes[$k]['expect'];
			$v['opencode'] = $opencodes[$k]['opencode'];
			$v['opentime'] = $opencodes[$k]['opentime'];
			$cplist[] = $v;
		}
		$return['sign']=true;
		$return['message']='获取成功';
		$return['data']=$cplist;
		echo jsonreturn($return);
	}
	function gettouzhuinfo(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$trano = I('trano');
		if(!$trano){
			$return['sign'] = false;
			$return['message'] = '缺少单号';
			echo jsonreturn($return);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$apiparam['trano'] = $trano;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/gettouzhuinfo',$apiparam);
		echo jsonreturn($Result);
	}
	function chedan(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$trano = I('trano');
		if(!$trano){
			$return['sign'] = false;
			$return['message'] = '缺少单号';
			echo jsonreturn($return);exit;
		}
		if(C('iskillorder')!=1){
			$return['sign'] = false;
			$return['message'] = '平台不允许撤单';
			echo jsonreturn($return);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$apiparam['trano'] = $trano;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/chedan',$apiparam);
		echo jsonreturn($Result);
	}
	
	//获取彩票最后一期开奖
	function getLotterycode(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$lotname = I('lotname');
		$expect  = I('expect');
		if(!$lotname)return jsonreturn(['sign'=>false,'message'=>'彩票标识必不可少']);
		$apiparam=array();
		$apiparam['where'] = array(
			'name'=>$lotname,
			'expect'=>$expect,
		);
		$getLottery = parent::getLotterycode($apiparam);
		echo jsonreturn($getLottery);
	}
	//检查用户名是否存在
	function checkuername(){
		$username = I('username');
		if(!$username){
			echo jsonreturn(['sign'=>false,'message'=>'用户名不能空']);exit;
		}
		$apiparam=array();
		$apiparam['username'] = $username;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/checkuername',$apiparam);
		echo jsonreturn($Result);
	}
	
	function lotteryrates(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$typeid = 'k3';
		$Result = S('lotteryrates_'.$typeid);
		if(!$Result){
			$apiparam=array();
			$apiparam['typeid'] = $typeid;
			$_api = new \Lib\api;
			$Result = $_api->sendHttpClient('Api/Lottery/lotteryrates',$apiparam);
			S('lotteryrates_'.$typeid,$Result,300);
		}
		if($Result['data']){
			$sessionid     = session('member_sessionid');
			$auth_id       = session('member_auth_id');
			$userinfo=session('userinfo');
			if($sessionid && $auth_id && $userinfo && $userinfo['groupid']){//未登陆以玩法设置
				$membergroups = C('membergroups');
				$groupinfo = $membergroups[$userinfo['groupid']];
				if($groupinfo)foreach($Result['data'] as $k0=>$v0){
					$Result['data'][$v0['playid']]['minxf'] = $groupinfo['min_'.$v0['playid']]?$groupinfo['min_'.$v0['playid']]:($Result['data'][$v0['playid']]['minxf']?$Result['data'][$v0['playid']]['minxf']:0);
					$Result['data'][$v0['playid']]['maxxf'] = $groupinfo['max_'.$v0['playid']]?$groupinfo['max_'.$v0['playid']]:($Result['data'][$v0['playid']]['maxxf']?$Result['data'][$v0['playid']]['maxxf']:0);
				}
			}
			$Result['rates'] = $Result['data'];
			unset($Result['data']);
		}
		echo jsonreturn($Result);
	}

	function lotterytimes(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$lotteryname = I('lotteryname');
		$cptype = I("cptype");
		switch ($cptype){
			case "ssc" :
				$cplist = C('cplist.ssc');
				break;
			case "pk10" :
				$cplist = C('cplist.pk10');
				break;
			case "keno" :
				$cplist = C('cplist.keno');
				break;
			case "x5" :
				$cplist = C('cplist.x5');
				break;
			case "dpc" :
				$cplist = C('cplist.dpc');
				break;
			case "lhc" :
				$cplist = C('cplist.lhc');
				break;
			default:
				$cplist = C('cplist.k3');
				break;

		}
		$cpinfo = $cplist[$lotteryname];
		if(!$lotteryname || !$cpinfo){
			echo jsonreturn(['sign'=>false,'message'=>'彩种标识名称不得空']);exit;
		}
		//$shortName = I('lotteryname');;
		if(!$lotteryname){
			echo jsonreturn(['sign'=>false,'message'=>'参数错误1']);exit;
		}

		if($cpinfo['isopen']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'彩种已关闭']);exit;
		}
		$_classfile = COMMON_PATH . 'Lib/lotterytimes/'.$lotteryname.'.class.php';
		if(!is_file($_classfile)){
			echo jsonreturn(['sign'=>false,'message'=>'开奖时间错误']);exit;
		}
		$_lotterytimesclass = "Lib\\lotterytimes\\{$lotteryname}";
		$_lotterytimes = new $_lotterytimesclass;
		$_lottetimes = $_lotterytimes->drawtimes();
		//dump($_lotterytimes);
		//dump($_lottetimes);exit;

		if($_lottetimes['lastFullExpect']){
			$return = array_merge($_lottetimes,['shortname'=> $cpinfo['title'],'status' =>$cpinfo['isopen'],'message'=> 'OK',]);
			$apiparam['sign'] = true;
			$apiparam['message'] = '获取成功';
			$apiparam['data'] = $return;
			echo jsonreturn($apiparam);exit;
		}else{
			$apiparam['sign'] = false;
			$apiparam['message'] = '获取失败';
			echo jsonreturn($apiparam);exit;
		}

//		dump($_lottetimes);
		$apiparam=array();
		$apiparam['lotteryname'] = $lotteryname;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Lottery/lotterytimes',$apiparam);
//		dump($Result);exit;
		if(!$Result['data']['lotteryname'])$Result['data']['lotteryname'] = $lotteryname;
		echo jsonreturn($Result);


	}
	function loadopencode(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$lotteryname = I('lotteryname');
		$expect      = I('expect');
		if(!$lotteryname || !$expect){
			echo jsonreturn(['sign'=>false,'message'=>'彩种标识名称或期号不得空']);exit;
		}
		$apiparam=array();
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['expect'] = $expect;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Lottery/loadopencode',$apiparam);
		echo jsonreturn($Result);
	}
	function lotteryopencodes(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$lotteryname = I('lotteryname');
		if(!$lotteryname){
			echo jsonreturn(['sign'=>false,'message'=>'彩种标识名称或期号不得空']);exit;
		}
		$apiparam=array();
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['expect'] = $expect;
		$apiparam['num'] = 30;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Lottery/lotteryopencodes',$apiparam);
		//S('lotteryopencodes_'.$lotteryname,$Result,60);
		echo jsonreturn($Result);
	}
	function betslisttoday(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		if(!$_REQUEST['lotteryname']){
			echo jsonreturn(['sign'=>false,'message'=>'缺少彩种标识或投注期号']);exit;
		}
		if(!$sessionid || !$auth_id){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$Result = [];
		$Result = islogin();
		if($Result==false){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($Result['data']['islogin']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'登陆异常，请重新登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['lotteryname'] = $_REQUEST['lotteryname'];
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/betslisttoday',$apiparam);
		echo jsonreturn($Result);
	}
	
	//购买
	function cpbuy(){
		if(!IS_POST){
			$this->ajaxReturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		if(!$_REQUEST['expect'] || !$_REQUEST['lotteryname']){
			$this->ajaxReturn(['sign'=>false,'message'=>'缺少彩种标识或投注期号']);exit;
		}
		if(count($_REQUEST['orderList'])<1){
			$this->ajaxReturn(['sign'=>false,'message'=>'无投注注单']);exit;
		}
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			$this->ajaxReturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$Result = [];
		$Result = islogin();
		if($Result==false){
			$this->ajaxReturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($Result['data']['islogin']!=1){
			$this->ajaxReturn(['sign'=>false,'message'=>'登陆异常，请重新登陆','data'=>['islogin'=>0]]);exit;
		}
		if($Result['data']['islock']==1){
			$this->ajaxReturn(['sign'=>false,'message'=>'您的账号不允许下注，请联系客服解锁','data'=>['islogin'=>0]]);exit;
		}
		$userinfo = $Result['data'];
		$totalprice = 0;
		$sessionid     = session('member_sessionid');
		$auth_id       = session('member_auth_id');
		$userinfo=session('userinfo');
		if($sessionid && $auth_id && $userinfo && $userinfo['groupid']){//未登陆以玩法设置
			$membergroups = C('membergroups');
			$groupinfo = $membergroups[$userinfo['groupid']];
		}
		if(strstr($_REQUEST['lotteryname'],'ssc')){
			$rates = C('rate_ssc');
		}elseif(strstr($_REQUEST['lotteryname'],'pk10')){
			$rates = C('rates_pk10');
		}else{
			$rates = C('rates_k3');
		}

		foreach($_REQUEST['orderList'] as $k=>$v){
			if(!$v['playid']){
				$this->ajaxReturn(['sign'=>false,'message'=>$v['playtitle'].'缺少玩法参数或玩法无法识别']);exit;
			}
			if(intval($v['minxf'])>0 && $v['price']<$v['minxf']){
				$this->ajaxReturn(['sign'=>false,'message'=>$v['playtitle'].'最低投注金额为'.$v['minxf']]);exit;
			}
			$minxf = $maxxf = 0;
			$minxf = $groupinfo['min_'.$v['playid']]?$groupinfo['min_'.$v['playid']]:($rates[$v['playid']]['minxf']?$rates[$v['playid']]['minxf']:0);
			$maxxf = $groupinfo['max_'.$v['playid']]?$groupinfo['max_'.$v['playid']]:($rates[$v['playid']]['maxxf']?$rates[$v['playid']]['maxxf']:0);
			if(intval($minxf)>0 && $v['price']<$minxf){
				$this->ajaxReturn(['sign'=>false,'message'=>$v['playtitle'].'最低投注金额为'.$minxf]);exit;
			}
			if(intval($maxxf)>0 && $v['price']>$maxxf){
				$this->ajaxReturn(['sign'=>false,'message'=>$v['playtitle'].'最高投注金额为'.$maxxf]);exit;
			}

			if(intval($v['zhushu'])<=0){
				$this->ajaxReturn(['sign'=>false,'message'=>$v['playtitle'].'投注注数错误']);exit;
			}
			if(intval($v['totalzs'])<=0){
				$this->ajaxReturn(['sign'=>false,'message'=>$v['playtitle']."系统参数[总注数]设置错误"]);exit;
			}
			if(intval($v['zhushu'])>intval($v['totalzs'])){
				$this->ajaxReturn(['sign'=>false,'message'=>$v['playtitle']."最高{$v['totalzs']}注"]);exit;
			}

			if(strstr($_REQUEST['lotteryname'],'k3')){
				if(count(explode('#',$v['number']))!=intval($v['zhushu']) ){
					$this->ajaxReturn(['sign'=>false,'message'=>$v['playtitle']."-系统检测到您的投注注数异常1"]);exit;
				}
				$totalprice += $v['price'] * $v["zhushu"];
			}else{
				$totalprice += $v['price'];
			}
		}
		$_REQUEST['source'] = 'mobile';
		//$_REQUEST['auth']   = ["member_auth_id"=>];

		if($userinfo['balance']<$totalprice){
			$this->ajaxReturn(['sign'=>false,'message'=>"账户余额不足"]);exit;
		}
		$apiparam=array();
		$apiparam['orderList'] = $_REQUEST;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Lottery/cpbuy',$apiparam);
		$this->ajaxReturn($Result);

		//dump($_REQUEST);
	}


    //传统玩法
    function oldcpbuy(){
        if(!IS_POST){
            $this->ajaxReturn(['sign'=>false,'message'=>'非法操作']);exit;
        }
        if(!$_REQUEST['expect'] || !$_REQUEST['lotteryname']){
            $this->ajaxReturn(['sign'=>false,'message'=>'缺少彩种标识或投注期号']);exit;
        }
        if(count($_REQUEST['orderList'])<1){
            $this->ajaxReturn(['sign'=>false,'message'=>'无投注注单']);exit;
        }
        $userinfo=session('userinfo');
        $sessionid = session('member_sessionid');
        $auth_id   = session('member_auth_id');
        if(!$sessionid || !$auth_id || !$userinfo){
            $this->ajaxReturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
        }
        $Result = islogin();
        if($Result==false){
            $this->ajaxReturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
        }
        if($Result['data']['islogin']!=1){
            $this->ajaxReturn(['sign'=>false,'message'=>'登陆异常，请重新登陆','data'=>['islogin'=>0]]);exit;
        }
        if($Result['data']['islock']==1){
            $this->ajaxReturn(['sign'=>false,'message'=>'您的账号不允许下注，请联系客服解锁','data'=>['islogin'=>0]]);exit;
        }

        $_REQUEST['source'] = 'mobile';

        $apiparam=array();
        $apiparam['orderList'] = $_REQUEST;
        $apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
        $_api = new \Lib\api;

        $Result = $_api->sendHttpClient('Api/Lottery/oldcpbuy',$apiparam);
        $this->ajaxReturn($Result);

    }


	function defaultuserbankcard(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$id     = I('id');
		if(!$id){
			echo jsonreturn(['sign'=>false,'message'=>'缺少银行ID参数']);exit;
		}
		$sessionid     = session('member_sessionid');
		$auth_id       = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam = [];
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$apiparam['id'] = $id;
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/defaultuserbankcard',$apiparam);
		$return = [];
		$return['sign'] = $Result['sign'];
		$return['message'] = $Result['message'];
		echo jsonreturn($return);
	}
	function usergetbankcard(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid     = session('member_sessionid');
		$auth_id       = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam = [];
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/usergetbankcard',$apiparam);
		$return = [];
		$return['sign'] = $Result['sign'];
		$return['message'] = $Result['message'];
		$return['banklist'] = $Result['banklist'];
		$return['sysBankMaxNum'] = $Result['sysBankMaxNum'];
		echo jsonreturn($return);
	}
	function userbindbankcard(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$bankAddress           = I('bankAddress');
		$bankBranch            = I('bankBranch');
		$bankCardNumber        = I('bankCardNumber');
		$bankCode              = I('bankCode');
		$bankTradPwd           = I('bankTradPwd');
		$regbankCardNumber     = I('regbankCardNumber');
		$accountname           = I('accountname');
		$sessionid     = session('member_sessionid');
		$auth_id       = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if(strlen($bankCode)<1){
			echo jsonreturn(['sign'=>false,'message'=>'请选择银行']);exit;
		}
		$pat = '/^\d{16,19}$/';
		if(!preg_match($pat,$bankCardNumber)){
			echo jsonreturn(['sign'=>false,'message'=>'请输入16~19位银行卡账号']);exit;
		}
		if($bankCardNumber!=$regbankCardNumber){
			echo jsonreturn(['sign'=>false,'message'=>'银行卡账号两次输入不一致']);exit;
		}
		if(strlen($bankBranch)<12){
			echo jsonreturn(['sign'=>false,'message'=>'请输入正确的开户行网点']);exit;
		}
		if(strlen($bankAddress)<3){
			echo jsonreturn(['sign'=>false,'message'=>'请选择开户行地址']);exit;
		}
		if(md5(sha1($bankTradPwd))!=$userinfo['tradepassword'] && $userinfo['tradepassword']){
			echo jsonreturn(['sign'=>false,'message'=>'提款密码错误']);exit;
		}
		$apiparam = [];
		$apiparam['bankaddress']        = $bankAddress;
		$apiparam['bankbranch']           = $bankBranch;
		$apiparam['bankcode']           = $bankCode;
		$apiparam['banknumber']         = $bankCardNumber;
		$apiparam['tradepassword']      = $bankTradPwd;
		$apiparam['accountname']      = $accountname;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];

		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/userbindbankcard',$apiparam);
		$return = [];
		$return['sign'] = $Result['sign'];
		$return['message'] = $Result['message'];
		echo jsonreturn($return);
	}
	function bankcardList(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid     = session('member_sessionid');
		$auth_id       = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam = [];
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/bankcardList',$apiparam);
		$return = [];
		$return['sign'] = $Result['sign'];
		$return['message'] = $Result['message'];
		$return['banklist'] = $Result['banklist'];
		echo jsonreturn($return);
	}
	function userbindemail(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$email         = I('email');
		$tradePwd      = I('tradePwd');
		$sessionid     = session('member_sessionid');
		$auth_id       = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['email']){
			echo jsonreturn(['sign'=>false,'message'=>'邮箱已经绑定无需重复绑定']);exit;
		}
		$myreg = '/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/';
		///^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((.[a-zA-Z0-9_-]{2,3}){1,2})$/
		if(!preg_match($myreg,$email)){
			echo jsonreturn(['sign'=>false,'message'=>'邮箱格式错误']);exit;
		}
		if(md5(sha1($tradePwd))!=$userinfo['tradepassword'] && $userinfo['tradepassword']){
			echo jsonreturn(['sign'=>false,'message'=>'提款密码错误']);exit;
		}
		$apiparam = [];
		$apiparam['email']              = $email;
		$apiparam['tradepassword']      = $tradePwd;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/userbindemail',$apiparam);
		$return = [];
		$return['sign'] = $Result['sign'];
		$return['message'] = $Result['message'];
		echo jsonreturn($return);
	}
	function userbindphone(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$phone         = I('phone');
		$tradePwd      = I('tradePwd');
		$sessionid     = session('member_sessionid');
		$auth_id       = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['tel']){
			echo jsonreturn(['sign'=>false,'message'=>'手机号已经绑定无需重复绑定']);exit;
		}
		$myreg = '/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/';
		if(!preg_match($myreg,$phone)){
			echo jsonreturn(['sign'=>false,'message'=>'手机号码格式错误']);exit;
		}
		if(md5(sha1($tradePwd))!=$userinfo['tradepassword'] && $userinfo['tradepassword']){
			echo jsonreturn(['sign'=>false,'message'=>'提款密码错误']);exit;
		}
		$apiparam = [];
		$apiparam['phone']              = $phone;
		$apiparam['tradepassword']      = $tradePwd;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/userbindphone',$apiparam);
		$return = [];
		$return['sign'] = $Result['sign'];
		$return['message'] = $Result['message'];
		echo jsonreturn($return);
	}
	function changeeditquestion(){
		$sessionid     = session('member_sessionid');
		$auth_id       = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if(!$userinfo['question']){
			echo jsonreturn(['sign'=>false,'message'=>'未设置密保']);exit;
		}
		$return = [];
		$return['sign'] = true;
		$return['message'] = '操作成功';
		$return['question']['questionone'] = $userinfo['question']['questionone'];
		$return['question']['questiontwo'] = $userinfo['question']['questiontwo'];
		$return['question']['questionthree'] = $userinfo['question']['questionthree'];
		echo jsonreturn($return);exit;
	}
	function questionanscheck(){
		if(!IS_POST){
			//echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid     = session('member_sessionid');
		$auth_id       = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$answerOne     = I('editquestionans1');
		$answerTwo     = I('editquestionans2');
		$answerThree   = I('editquestionans3');
		if(!is_array($userinfo['question'])){
			echo jsonreturn(['sign'=>false,'message'=>'您未设置密保']);exit;
		}
		if(!$answerOne || !$answerTwo || !$answerThree){
			echo jsonreturn(['sign'=>false,'message'=>'密保答案不完整']);exit;
		}
		if(md5(sha1($answerOne))==$userinfo['question']['answerone'] && md5(sha1($answerTwo))==$userinfo['question']['answertwo'] && md5(sha1($answerThree))==$userinfo['question']['answerthree']){
			$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
			$apiparam['answerOne'] = $answerOne;
			$apiparam['answerTwo'] = $answerTwo;
			$apiparam['answerThree'] = $answerThree;
			$_api = new \Lib\api;
			$Result = [];$Result = $_api->sendHttpClient('Api/Account/questionanscheck',$apiparam);
			if($Result['sign']==true){
				//$_t = time();
				//$questionanscheck['quetoken'] = md5($_t);
				//$questionanscheck['quetime']  = $_t;
				session('questionanscheck',$Result['questionanscheck']);
				echo jsonreturn(['sign'=>true,'message'=>'验证成功','questoken'=>$Result['questionanscheck']['quetoken']]);exit;
			}else{
				echo jsonreturn($apiparam);exit;
			}
			//$return['sign'] = $Result['sign'];
			//$return['message'] = $Result['message'];
			//session('questionanscheck',NULL);
		}else{
			echo jsonreturn(['sign'=>false,'message'=>'密保答案验证失败']);exit;
		}
	}
	function usersecurity(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$answerOne     = I('answerOne');
		$answerTwo     = I('answerTwo');
		$answerThree   = I('answerThree');
		$questionOne   = I('questionOne');
		$questionTwo   = I('questionTwo');
		$questionThree = I('questionThree');
		$tradePwd      = I('tradePwd');
		$questoken     = I('questoken');
		if($questoken){
			$questionanscheck = session('questionanscheck');
			if($questoken!=$questionanscheck['quetoken']){
				echo jsonreturn(['sign'=>false,'message'=>'密保重置token验证失败']);exit;
			}
			$_t = time();
			if($_t-$questionanscheck['quetime']>300){
				echo jsonreturn(['sign'=>false,'message'=>'密保重置token验证超时']);exit;
			}
		}
		$sessionid     = session('member_sessionid');
		$auth_id       = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if(!$questionOne){
			echo jsonreturn(['sign'=>false,'message'=>'请选择密保问题1！']);exit;
		}
		if(!$questionTwo){
			echo jsonreturn(['sign'=>false,'message'=>'请选择密保问题2！']);exit;
		}
		if(!$questionThree){
			echo jsonreturn(['sign'=>false,'message'=>'请选择密保问题3！']);exit;
		}
		if(!$answerOne){
			echo jsonreturn(['sign'=>false,'message'=>'请填写密保答案1！']);exit;
		}
		if(!$answerTwo){
			echo jsonreturn(['sign'=>false,'message'=>'请填写密保答案2！']);exit;
		}
		if(!$answerThree){
			echo jsonreturn(['sign'=>false,'message'=>'请填写密保答案3！']);exit;
		}
		if($questionOne==$questionTwo){
			echo jsonreturn(['sign'=>false,'message'=>'密保问题1和密保问题2不能相同！']);exit;
		}
		if($questionOne==$questionThree){
			echo jsonreturn(['sign'=>false,'message'=>'密保问题1和密保问题3不能相同！']);exit;
		}
		if($questionTwo==$questionThree){
			echo jsonreturn(['sign'=>false,'message'=>'密保问题2和密保问题3不能相同！']);exit;
		}
		if($answerOne==$answerTwo){
			echo jsonreturn(['sign'=>false,'message'=>'密保答案1和密保答案2不能相同！']);exit;
		}
		if($answerOne==$answerThree){
			echo jsonreturn(['sign'=>false,'message'=>'密保答案1和密保答案3不能相同！']);exit;
		}
		if($answerTwo==$answerThree){
			echo jsonreturn(['sign'=>false,'message'=>'密保答案2和密保答案3不能相同！']);exit;
		}
		$passwordpatten = '/^[\w\W]{4,16}$/';
		if(!preg_match($passwordpatten,$tradePwd)){
			echo jsonreturn(['sign'=>false,'message'=>'提款密码应为4-16位字符']);exit;
		}
		if(md5(sha1($tradePwd))!=$userinfo['tradepassword']){
			echo jsonreturn(['sign'=>false,'message'=>'提款密码错误']);exit;
		}
		$apiparam=array();
		if($questoken){//重置
			$apiparam['questoken']  = $questoken;
			$apiparam['questionanscheck']  = $questionanscheck;
		}else{
			if($userinfo['question'] && is_array($userinfo['question'])){
				echo jsonreturn(['sign'=>false,'message'=>'您的密保已经设置无需重复设置']);exit;
			}
		}
		$apiparam['answerOne']          = $answerOne;
		$apiparam['answerTwo']          = $answerTwo;
		$apiparam['answerThree']        = $answerThree;
		$apiparam['questionOne']        = $questionOne;
		$apiparam['questionTwo']        = $questionTwo;
		$apiparam['questionThree']      = $questionThree;
		$apiparam['tradepassword']      = $tradePwd;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/usersecurity',$apiparam);
		$return = [];
		$return['sign'] = $Result['sign'];
		$return['message'] = $Result['message'];
		session('questionanscheck',NULL);
		echo jsonreturn($return);
	}
	function usereditdrawpass(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$oldpassword = I('oldpassword');
		$password    = I('password');
		$rpassword   = I('rpassword');
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$passwordpatten = '/^[\w\W]{4,16}$/';
		if(!preg_match($passwordpatten,$oldpassword)){
			echo jsonreturn(['sign'=>false,'message'=>'旧提款密码应为4-16位字符']);exit;
		}
		if(!preg_match($passwordpatten,$password)){
			echo jsonreturn(['sign'=>false,'message'=>'新提款密码应为4-16位字符']);exit;
		}
		if($password!=$rpassword){
			echo jsonreturn(['sign'=>false,'message'=>'新提款密码两次输入不一致']);exit;
		}
		if(!$userinfo['tradepassword']){
			$userinfo['tradepassword'] = $userinfo['password'];
		}
		if(md5(sha1($oldpassword))!=$userinfo['tradepassword']){
			echo jsonreturn(['sign'=>false,'message'=>'旧提款密码错误']);exit;
		}
		$apiparam=array();
		$apiparam['oldpassword']      = $oldpassword;
		$apiparam['password'] = $password;
		$apiparam['rpassword'] = $rpassword;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/usereditdrawpass',$apiparam);
		$return = [];
		$return['sign'] = $Result['sign'];
		$return['message'] = $Result['message'];
		
		echo jsonreturn($return);
	}
	function usereditpass(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$oldpassword = I('oldpassword');
		$password    = I('password');
		$rpassword   = I('rpassword');
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$passwordpatten = '/^[\w\W]{6,16}$/';
		if(!preg_match($passwordpatten,$oldpassword)){
			echo jsonreturn(['sign'=>false,'message'=>'旧密码应为6-16位字符']);exit;
		}
		if(!preg_match($passwordpatten,$password)){
			echo jsonreturn(['sign'=>false,'message'=>'新密码应为6-16位字符']);exit;
		}
		if($password!=$rpassword){
			echo jsonreturn(['sign'=>false,'message'=>'新密码两次输入不一致']);exit;
		}
		if(md5(sha1($oldpassword))!=$userinfo['password']){
			echo jsonreturn(['sign'=>false,'message'=>'旧密码错误']);exit;
		}
		$apiparam=array();
		$apiparam['oldpassword']      = $oldpassword;
		$apiparam['password'] = $password;
		$apiparam['rpassword'] = $rpassword;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/usereditpass',$apiparam);
		$return = [];
		$return['sign'] = $Result['sign'];
		$return['message'] = $Result['message'];
		
		echo jsonreturn($return);
	}
	function userbindrealname(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$realname        = I('realname');
		$tradepassword   = I('tradepassword');
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['tradepassword']==''){
			echo jsonreturn(['sign'=>false,'message'=>'请先设置提款密码']);exit;
		}
		if($userinfo['userbankname']!=''){
			echo jsonreturn(['sign'=>false,'message'=>'真实姓名绑定后不得修改']);exit;
		}
		$realnamepatten = '/^[\x80-\xff]{6,12}$/';
		$passwordpatten = '/^[\w\W]{4,16}$/';
		if(!preg_match($realnamepatten,$realname)){
			echo jsonreturn(['sign'=>false,'message'=>'真实姓名格式错误']);exit;
		}
		if(!preg_match($passwordpatten,$tradepassword)){
			echo jsonreturn(['sign'=>false,'message'=>'提款密码应为4-16位字符']);exit;
		}
		if(md5(sha1($tradepassword))!=$userinfo['tradepassword']){
			echo jsonreturn(['sign'=>false,'message'=>'提款密码错误']);exit;
		}
		$apiparam=array();
		$apiparam['realname']      = $realname;
		$apiparam['tradepassword'] = $tradepassword;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = [];$Result = $_api->sendHttpClient('Api/Account/userbindrealname',$apiparam);
		$return = [];
		$return['sign'] = $Result['sign'];
		$return['message'] = $Result['message'];
		
		echo jsonreturn($return);
	}
	function userlevel(){
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$data = [];
		if($userinfo['tradepassword']!=''){
			$data['tradepassword'] = true;
		}else{
			$data['tradepassword'] = false;
		}
		
		if($userinfo['userbankname']!=''){
			$data['userbankname'] = true;
		}else{
			$data['userbankname'] = false;
		}
		
		if($userinfo['email']!=''){
			$data['email'] = true;
		}else{
			$data['email'] = false;
		}
		
		if($userinfo['tel']!=''){
			$data['phone'] = true;
		}else{
			$data['phone'] = false;
		}
		
		if($userinfo['qq']!=''){
			$data['qq'] = true;
		}else{
			$data['qq'] = false;
		}
		
		if($userinfo['banklist'] && is_array($userinfo['banklist'])){
			$data['bindbank'] = true;
		}else{
			$data['bindbank'] = false;
		}
		
		if($userinfo['question'] && is_array($userinfo['question'])){
			$data['question'] = true;
		}else{
			$data['question'] = false;
		}
		echo jsonreturn(['sign'=>true,'message'=>'操作成功','data'=>$data]);exit;
	}
	function userbets(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$trano        = I('trano');
		$startime   = I('startime');
		$endtime   = I('endtime');
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$lotteryname   = I('lotteryname');
		$state   = I('state');
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['lotteryname'] = $lotteryname;
		$apiparam['trano'] = $trano;
		$apiparam['startime'] = $startime;
		$apiparam['endtime'] = $endtime;
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['state'] = $state;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/userbets',$apiparam);
		echo jsonreturn($Result);
	}
	function userfuddetail(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$trano        = I('trano');
		$startime   = I('startime');
		$endtime   = I('endtime');
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$type   = I('type');
		$acctype   = I('acctype');
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['trano'] = $trano;
		$apiparam['startime'] = $startime;
		$apiparam['endtime'] = $endtime;
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['type'] = $type;
		$apiparam['acctype'] = $acctype;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/userfuddetail',$apiparam);
		echo jsonreturn($Result);
	}
	function rechargelist(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$trano        = I('trano');
		$startime   = I('startime');
		$endtime   = I('endtime');
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$state   = I('state');
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['trano'] = $trano;
		$apiparam['startime'] = $startime;
		$apiparam['endtime'] = $endtime;
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['state'] = $state;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/rechargelist',$apiparam);
		echo jsonreturn($Result);
	}
	function withdrawlist(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$trano        = I('trano');
		$startime   = I('startime');
		$endtime   = I('endtime');
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$state   = I('state');
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['trano'] = $trano;
		$apiparam['startime'] = $startime;
		$apiparam['endtime'] = $endtime;
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['state'] = $state;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/withdrawlist',$apiparam);
		echo jsonreturn($Result);
	}
	function lotteryreport(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$startime   = I('startime');
		$endtime   = I('endtime');
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['startime'] = $startime;
		$apiparam['endtime'] = $endtime;
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/lotteryreport',$apiparam);
		echo jsonreturn($Result);
	}
	// 获取所有下级会员
	function getdownuser(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			$apiparam['sign']    = false;
			$apiparam['message'] = '您不是代理';
			echo jsonreturn($apiparam);exit;
		}
		$apiparam=array();
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/getdownuser',$apiparam);
		echo jsonreturn($Result);
	}
	/**代理***********************************************************************************/
	//充值量 提现量 代购量 派奖量 返点 活动
	function reportstatistics(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$beginToday= mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday  = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$startime  = I('startime');
		$endtime   = I('endtime');
		$startime  = $startime?strtotime($startime):$beginToday-86400*30;
		$endtime   = $endtime?strtotime($endtime):$endToday;
		$apiparam=array();
		$apiparam['startime'] = $startime;
		$apiparam['endtime']  = $endtime;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/reportstatistics',$apiparam);
		echo jsonreturn($Result);
		
	}
	//团队人数总金额
	function downuserports(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$beginToday= mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday  = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$startime  = I('startime');
		$endtime   = I('endtime');
		$startime  = $startime?strtotime($startime):$beginToday-86400*30;
		$endtime   = $endtime?strtotime($endtime):$endToday;
		$apiparam=array();
		$apiparam['startime'] = $startime;
		$apiparam['endtime']  = $endtime;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/downuserports',$apiparam);
		echo jsonreturn($Result);
	}
	//团队图表
	function echarts(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$beginToday= mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday  = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$startime  = I('startime');
		$endtime   = I('endtime');
		$startime  = $startime?strtotime($startime):$beginToday-86400*30;
		$endtime   = $endtime?strtotime($endtime):$endToday;
		$days      = floor(($endtime-$startime)/86400);
		if($days>31){
			$apiparam['sign']    = false;
			$apiparam['message'] = '只能查询30天内的数据'.$days;
			echo jsonreturn($apiparam);exit;
		}
		$type      = I('type','cz');// cz充值 tx提款 tz投注 fd返点 hd活动 xz新增会员
		if(!in_array($type,['cz','tx','tz','xz','fd','hd'])){
			$apiparam['sign']    = false;
			$apiparam['message'] = '操作项不存在';
			echo jsonreturn($apiparam);exit;
		}
		$apiparam=array();
		$apiparam['startime'] = $startime;
		$apiparam['endtime']  = $endtime;
		$apiparam['type']     = $type;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/echarts',$apiparam);
		echo jsonreturn($Result);
	}
	
	//注册用户名检测
	function checkaddusername(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		//echo jsonreturn(['sign'=>false,'message'=>'非法操作','records'=>10,'root'=>$root]);exit;
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$username   = I('uname');
		//验证用户名
		if(!$username || !preg_match("/^[a-zA-Z][a-zA-Z\d]{4,11}$/",$username)){
			$Result = [];
			$Result['sign']    = false;
			$Result['message'] = '请输入5-12位的用户名,必须以字母开通头!';
			echo jsonreturn($Result);exit;
		}
		$apiparam=array();
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$apiparam['username'] = $username;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/checkuername',$apiparam);
		echo jsonreturn($Result);
	}
	//代理开户
	function adduser(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			$this->ajaxReturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$username   = I('username');
		$isproxy    = I('isProxy');
		$rebate    = I('rebate');
		$maxRebate     = $this->userinfo['fandian'];
		if(!in_array($isproxy,[0,1])){
			$Result = [];
			$Result['sign']    = false;
			$Result['message'] = '请选择开户类型';
			$this->ajaxReturn($Result);exit;
		}
		if(!$username || !in_array($isproxy,[0,1]) || !is_numeric($rebate)){
			$return = ['sign'=>false,'message'=>'开户参数错误'];
			$this->ajaxReturn($return);exit;
		}
		if($rebate>$maxRebate || $rebate<0){
			$return = ['sign'=>false,'message'=>"返点必须在0~{$maxRebate}之间"];
			$this->ajaxReturn($return);exit;
		}
		//验证用户名
		$_paten = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
		if(!$username || preg_match($_paten,$username) || mb_strlen($username)<2 || mb_strlen($username)>12){
			$Result = [];
			$Result['sign']    = false;
			$Result['message'] = '用户名为2-12字母与数字组或中文的字符!';
			$this->ajaxReturn($Result);exit;
		}
		$apiparam=array();
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$apiparam['username'] = $username;
		$apiparam['isproxy']  = $isproxy;
		$apiparam['rebate']  = $rebate;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/adduser',$apiparam);
		echo jsonreturn($Result);
	}
	//开户链接
	function addsignup(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$times      = I('times');
		$isproxy    = I('isproxy');
		$rebate = I('rebate');
		$tpltype    = I('tpltype',0,'intval');
		$maxRebate     = $this->userinfo['fandian'];
		if($times>=1 && $times<=100){
		}else{
			$Result = [];
			$Result['sign']    = false;
			$Result['message'] = '使用次数只能为正整数1~100之间';
			echo jsonreturn($Result);exit;
		}
		if(!in_array($isproxy,[0,1])){
			$Result = [];
			$Result['sign']    = false;
			$Result['message'] = '请选择开户类型';
			echo jsonreturn($Result);exit;
		}
		if($rebate > $maxRebate || $rebate<0){
			$return = ['sign'=>false,'message'=>"返点必须在0~{$maxRebate}之间"];
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		if(!in_array($tpltype,[0,1,2,3])){
			$tpltype = 0;
		}
		$apiparam=array();
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$apiparam['times']    = $times;
		$apiparam['isproxy']  = $isproxy;
		$apiparam['tpltype']  = $tpltype;
		$apiparam['fandian']  = $rebate;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/addsignup',$apiparam);
		echo jsonreturn($Result);
	}
	//获取开户链接
	function signuplinklist(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$apiparam=array();
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/signuplinklist',$apiparam);
		echo jsonreturn($Result);
	}
	//删除开户链接
	function delsignuplink(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$id = I('id',0,'intval');
		if(!$id){
			echo jsonreturn(['sign'=>false,'message'=>'开户链接不存在']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$apiparam=array();
		$apiparam['id'] = $id;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/delsignuplink',$apiparam);
		echo jsonreturn($Result);
	}
	//获取下线会员
	function memberList(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$isonline       = I('isonline',0,'intval');
		$minmoney       = I('minMoney',0,'intval');
		$maxmoney       = I('maxMoney',0,'intval');
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$beginToday= mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday  = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$startime  = I('startime');
		$endtime   = I('endtime');
		$startime  = $startime?strtotime($startime):0;
		$endtime   = $endtime?strtotime($endtime):0;
		$loginname = I('loginname');
		$apiparam=array();
		
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['startime'] = $startime;
		$apiparam['endtime'] = $endtime;
		$apiparam['loginname'] = $loginname;
		$apiparam['minmoney'] = $minmoney;
		$apiparam['maxmoney'] = $maxmoney;
		$apiparam['isonline'] = $isonline;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/memberList',$apiparam);
		if($Result['sign']=='true' && $Result['root']){
			foreach($Result['root'] as $k=>$v){
				if($v['logintime']){
					$v['logintime'] = date('Y-m-d H:i',$v['logintime']);
				}
				if($v['regtime']){
					$v['regtime'] = date('Y-m-d H:i',$v['regtime']);
				}
				$Result['root'][$k] = $v;
			}
		}
		echo jsonreturn($Result);
	}
	//代理获取游戏记录
	function downuserbetslist(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$trano       = I('trano');
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$state = I('state');
		$expect = I('expect');
		$loginname = I('loginname');
		$lotteryname = I('lotteryname');

		$beginToday= mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday  = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$startime  = I('startime');
		$endtime   = I('endtime');
		$startime  = $startime?strtotime($startime):$beginToday-86400*30;
		$endtime   = $endtime?strtotime($endtime):$endToday;
		$days      = floor(($endtime-$startime)/86400);
		if($days>31){
			$apiparam['sign']    = false;
			$apiparam['message'] = '只能查询30天内的数据'.$days;
			echo jsonreturn($apiparam);exit;
		}
		$apiparam=array();
		
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['startime'] = $startime;
		$apiparam['endtime']  = $endtime;
		$apiparam['loginname']= $loginname;
		$apiparam['trano']    = $trano;
		$apiparam['state']    = $state;
		$apiparam['expect']   = $expect;
		$apiparam['lotteryname']   = $lotteryname;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/downuserbetslist',$apiparam);
		echo jsonreturn($Result);
	}
	function downuserchangelist(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$loginname = I('loginname');
		$type      = I('type');

		$beginToday= mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday  = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$startime  = I('startime');
		$endtime   = I('endtime');
		$startime  = $startime?strtotime($startime):$beginToday-86400*30;
		$endtime   = $endtime?strtotime($endtime):$endToday;
		$days      = floor(($endtime-$startime)/86400);
		if($days>31){
			$apiparam['sign']    = false;
			$apiparam['message'] = '只能查询30天内的数据'.$days;
			echo jsonreturn($apiparam);exit;
		}
		$apiparam=array();
		
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['startime'] = $startime;
		$apiparam['endtime']  = $endtime;
		$apiparam['loginname']= $loginname;
		$apiparam['type']     = $type;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/downuserchangelist',$apiparam);

		echo jsonreturn($Result);
	}
	function downuserrechargeandwithdrawlist(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$loginname = I('loginname');
		$type      = I('type');
		$trano      = I('trano');
		$state      = I('state');

		$beginToday= mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday  = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$startime  = I('startime');
		$endtime   = I('endtime');
		$startime  = $startime?strtotime($startime):$beginToday-86400*30;
		$endtime   = $endtime?strtotime($endtime):$endToday;
		$days      = floor(($endtime-$startime)/86400);
		if($days>31){
			$apiparam['sign']    = false;
			$apiparam['message'] = '只能查询30天内的数据'.$days;
			echo jsonreturn($apiparam);exit;
		}
		$apiparam=array();
		
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['startime'] = $startime;
		$apiparam['endtime']  = $endtime;
		$apiparam['loginname']= $loginname;
		$apiparam['type']     = $type;
		$apiparam['trano']     = $trano;
		$apiparam['state']     = $state;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/downuserrechargeandwithdrawlist',$apiparam);
		echo jsonreturn($Result);
	}
	function downuseraccountreportlist(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if($userinfo['proxy']!=1){
			echo jsonreturn(['sign'=>false,'message'=>'您不是代理']);exit;
		}
		$page = I('jqueryGridPage');
		$page = intval($page)>0?intval($page):1;
		$pagesize = I('jqueryGridRows');
		$pagesize = intval($pagesize)>0?intval($pagesize):10;
		$loginname = I('loginname');

		$beginToday= mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday  = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$startime  = I('startime');
		$endtime   = I('endtime');
		$startime  = $startime?strtotime($startime):$beginToday-86400*30;
		$endtime   = $endtime?strtotime($endtime):$endToday;
		$days      = floor(($endtime-$startime)/86400);
		if($days>60){
			$apiparam['sign']    = false;
			$apiparam['message'] = '只能查询60天内的数据'.$days;
			echo jsonreturn($apiparam);exit;
		}
		$apiparam=array();
		
		$apiparam['page'] = $page;
		$apiparam['pagesize'] = $pagesize;
		$apiparam['startime'] = $startime;
		$apiparam['endtime']  = $endtime;
		$apiparam['loginname']= $loginname;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/downuseraccountreportlist',$apiparam);
		echo jsonreturn($Result);
	}
	
	/***充值提款相关*********************************************************************************************/
	//获取充值方式列表
	function getrechargetypelist(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/getrechargetypelist',$apiparam);
		echo jsonreturn($Result);
	}
	//充值订单提交
	function addrecharge(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			$Result = array('sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]);
			$this->ajaxReturn($Result);exit;
		}
		$amount  = I('amount',0,'intval');
		$paytype = I('paytype');
		$userpayname = I('userpayname');
		if(!$paytype){
//			echo jsonreturn(['sign'=>false,'message'=>'请选择充值方式']);exit;
			$this->ajaxReturn(['sign'=>false,'message'=>'请选择充值方式']);exit;
		}
		if($amount<=0){
//			echo jsonreturn(['sign'=>false,'message'=>'充值金额不得低于0元']);exit;
			$this->ajaxReturn(['sign'=>false,'message'=>'充值金额不得低于0元']);exit;
		}
		if(in_array($paytype,['alipay','tenpay','weixin','linepay']) && !$userpayname){
//			echo jsonreturn(['sign'=>false,'message'=>'请输入您的支付账号']);exit;
			$this->ajaxReturn(['sign'=>false,'message'=>'请输入您的支付账号']);exit;
		}
		$apiparam=array();
		$apiparam['paytype'] = $paytype;
		$apiparam['amount'] = $amount;
		$apiparam['userpayname'] = $userpayname;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/addrecharge',$apiparam);
		if($Result['sign']==true && is_array($Result['data']) && $Result['data']['trano']){//创建缓存为下次使用
			F($Result['data']['trano'],$Result['data'],'./PayOrder/');
		}
//		echo jsonreturn($Result);
		$this->ajaxReturn($Result);
		
	}
	//第三方支付单号提交
	function sendtrano(){
		if(!IS_POST){
			//echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$orderid    = I('orderid',0,'intval');
		$trano      = I('trano');
		$threetrano = I('threetrano');
		$orderinfo= F($trano,'','./PayOrder/');
		if(!$orderinfo){
			$res = json_encode(['sign'=>false,'message'=>'订单不存在'],JSON_UNESCAPED_UNICODE);
			echo "flightHandler($res)";
		}
		if($orderinfo['uid']!=$userinfo['id'] || $orderinfo['id']!=$orderid || $orderinfo['trano']!=$trano){
			$res = json_encode(['sign'=>false,'message'=>'非法操作订单'],JSON_UNESCAPED_UNICODE);
			echo "flightHandler($res)";
		}
		if($orderinfo['threetrano']){
			//echo jsonreturn(['sign'=>false,'message'=>'第三方充值订单号无需重复提交']);exit;
			$res = json_encode(['sign'=>false,'message'=>'第三方充值订单号无需重复提交'],JSON_UNESCAPED_UNICODE);
			echo "flightHandler($res)";
		}
		$apiparam=array();
		$apiparam['orderid'] = $orderid;
		$apiparam['trano']   = $trano;
		$apiparam['threetrano']   = $threetrano;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/sendtrano',$apiparam);
		if($Result['sign']==true && is_array($Result['data']) && $Result['data']['threetrano']){//创建缓存为下次使用
			F($Result['data']['trano'],$Result['data'],'./PayOrder/');
		}
		unset($Result['data']);
			$res = json_encode($Result,JSON_UNESCAPED_UNICODE);
			echo "flightHandler($res)";
	}
	//积分兑换相关规则
	function pointexchangeamountLimit(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$return['sign'] = true;
		$return['message'] = '获取成功';
		$return['data']['pointexchangeamount'] = C('pointexchangeamount')?intval(C('pointexchangeamount')):0;
		//充值
		$return['data']['pointchongzhi'] = C('pointchongzhi')?intval(C('pointchongzhi')):0;
		$return['data']['pointchongzhiadd'] = C('pointchongzhiadd')?intval(C('pointchongzhiadd')):0;
		//投注
		$return['data']['pointtouzhu'] = C('pointtouzhu')?intval(C('pointtouzhu')):0;
		$return['data']['pointtouzhuadd'] = C('pointtouzhuadd')?intval(C('pointtouzhuadd')):0;
		//亏损
		$return['data']['pointhuisun'] = C('pointhuisun')?intval(C('pointhuisun')):0;
		$return['data']['pointhuisunadd'] = C('pointhuisunadd')?intval(C('pointhuisunadd')):0;
		echo jsonreturn($return);
	}
	//积分兑换
	function savepointchangemoney(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$point         = I('point',0,'intval');
		$tradepassword = I('jfdh_withdraw_pwd');
		//验证提款密码
		if(!$tradepassword || md5(sha1($tradepassword))!=$userinfo['tradepassword']){
			$return =['sign'=>false,'message'=>"提款密码错误"];
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		$pointexchangeamount = intval(C('pointexchangeamount'));
		if($point<=0 || $point>$userinfo['point'] || $point<$pointexchangeamount){
			$return =['sign'=>false,'message'=>"兑换积分额度错误！"];
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$apiparam['point']         = $point;
		$apiparam['tradepassword'] = $tradepassword;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/savepointchangemoney',$apiparam);
		echo jsonreturn($Result);
	}
	/* 验证是否可以提款 */
	function isUserWithdrawLimit($apiparam=array()){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		/*if(!$userinfo['userbankname']){
			echo jsonreturn(['sign'=>false,'message'=>'请先绑定真实姓名']);exit;
		}
		if(!$userinfo['banklist']){
			echo jsonreturn(['sign'=>false,'message'=>'请先绑定银行卡']);exit;
		}
		if($userinfo['xima']>0){
			echo jsonreturn(['sign'=>false,'message'=>'打码不足，洗码金额为0时可以提款']);exit;
		}*/
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/isUserWithdrawLimit',$apiparam);
		echo jsonreturn($Result);
	}
	//保存提交提款订单
	function savetikuanorder(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		if(!$userinfo['userbankname']){
			echo jsonreturn(['sign'=>false,'message'=>'请先绑定真实姓名']);exit;
		}
		$userinfo['banklist'] = M('banklist')->where(['uid'=>$userinfo['id'],'state'=>1])->select();
		if(!$userinfo['banklist']){
			echo jsonreturn(['sign'=>false,'message'=>'请先绑定银行卡']);exit;
		}
		$tikuanstart         = strtotime(GetVar('tikuanstart'));
		$tikuanend           = strtotime(GetVar('tikuanend'));
		$_t = time();
		if($tikuanstart>$tikuanend){
			$tikuanend = $tikuanend + 86400;
		}
		if($_t<$tikuanstart){
			echo json_encode(array('sign'=>false,'message'=>'请在'.date('H:i',$tikuanstart).'到'.date('H:i',$tikuanend).'时间段之内提现，谢谢配合。'),JSON_UNESCAPED_UNICODE);exit;
		}
		if($_t>$tikuanend){
			echo json_encode(array('sign'=>false,'message'=>'请在'.date('H:i',$tikuanstart).'到'.date('H:i',$tikuanend).'时间段之内提现，谢谢配合。'),JSON_UNESCAPED_UNICODE);exit;
		}
		$bankid       = I('bankid');
		$amount       = I('amount');
		$tradepassword = I('withdraw_pwd');
		
		if($amount>$userinfo['balance']){
			$return =['sign'=>false,'message'=>'可提款金额错误'];
			echo jsonreturn($return);exit;
		}
		if(!$bankid || $amount<=0 || !$tradepassword){
			$return =['sign'=>false,'message'=>'提款订单参数不完整'];
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		
		$StartTime = date('Y-m-d 00:00:00');
		$map['oddtime'] =array('egt',strtotime($StartTime));
		$map['uid']    = $userinfo['id'];

		$num = M('withdraw')->where($map)->count();
		$count = GetVar('tikuannum')-$num;
		$count = $count>0?$count:0;
		if($count<=0)
		{
			echo json_encode(['sign'=>false,'message'=>'今日提现次达到了最大限次数！'], JSON_UNESCAPED_UNICODE);exit;
		}
		if($userinfo['xima']>0){
			$return =['sign'=>false,'message'=>'打码不足，洗码余额为0时可以提款'];
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		$banklist = [];
		foreach($userinfo["banklist"] as $k=>$v){
			$banklist[$v['id']] = $v;
		}
		//$bankinfo = M('banklist')->where(['id'=>$bankid,'uid'=>$userinfo['id']])->find();
		if(!$banklist[$bankid]){
			$return =['sign'=>false,'message'=>'您的提款银行错误'];
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		if($banklist[$bankid]['state']!=1){
			$return =['sign'=>false,'message'=>'提款银行未审核，请重新选择'];
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		if($userinfo['userbankname']==''){
			$return['sign'] = false;
			$return['message'] = '为保障您的资金安全请先绑定银行真实姓名';
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		if($userinfo['userbankname']!=$banklist[$bankid]['accountname']){
			$return['sign'] = false;
			$return['message'] = '提款银行账户与真实姓名不符1';
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		//提款时间
		$tikuanstart = strtotime(GetVar('tikuanstart'));
		$tikuanend = strtotime(GetVar('tikuanend'));
		$_t = time();
		if($_t<$tikuanstart){
			echo json_encode(array('sign'=>false,'message'=>'请在'.date('H:i',$tikuanstart).'到'.date('H:i',$tikuanend).'时间段之内提现，谢谢配合'),JSON_UNESCAPED_UNICODE);exit;
		}
		if($_t>$tikuanend){
			echo json_encode(array('sign'=>false,'message'=>'请在'.date('H:i',$tikuanstart).'到'.date('H:i',$tikuanend).'时间段之内提现，谢谢配合'),JSON_UNESCAPED_UNICODE);exit;
		}
		//验证提款密码
		if(!$tradepassword || md5(sha1($tradepassword))!=$userinfo['tradepassword']){
			$return =['sign'=>false,'message'=>"提款密码错误"];
			echo json_encode($return, JSON_UNESCAPED_UNICODE);exit;
		}
		$apiparam=array();
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$apiparam['bankid'] = $bankid;
		$apiparam['amount'] = $amount;
		$apiparam['tradepassword'] = $tradepassword;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/savetikuanorder',$apiparam);
		echo jsonreturn($Result);
	}

	/*信件---------------------------------------------------------------------------*/
	//获取信件内容
	function chatcontext(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		//echo jsonreturn(['sign'=>false,'message'=>'非法操作','records'=>10,'root'=>$root]);exit;
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$id   = intval(I('id'));
		$apiparam=array();
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$apiparam['id'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/chatcontext',$apiparam);
		echo jsonreturn($Result);
	}
	//发件箱
	function chatsentlist(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		//echo jsonreturn(['sign'=>false,'message'=>'非法操作','records'=>10,'root'=>$root]);exit;
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/chatsentlist',$apiparam);
		echo jsonreturn($Result);
	}
	//收件箱
	function chatrecelist(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		//echo jsonreturn(['sign'=>false,'message'=>'非法操作','records'=>10,'root'=>$root]);exit;
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/chatrecelist',$apiparam);
		echo jsonreturn($Result);
	}
	//信件发送
	function chatsent(){
		if(!IS_POST){
			echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
		}
		//echo jsonreturn(['sign'=>false,'message'=>'非法操作','records'=>10,'root'=>$root]);exit;
		$sessionid = session('member_sessionid');
		$auth_id   = session('member_auth_id');
		$userinfo=session('userinfo');
		if(!$sessionid || !$auth_id || !$userinfo){
			echo jsonreturn(['sign'=>false,'message'=>'未登陆','data'=>['islogin'=>0]]);exit;
		}
		$context   = strip_tags(I('context'));
		$title   = strip_tags(I('title'));
		$userids   = strip_tags(I('userids'));
		if(strlen($context)<1 || strlen($context)<1 || strlen($userids)<1){
			echo jsonreturn(['sign'=>false,'message'=>'缺少信件主题或内容或收件人','data'=>['islogin'=>0]]);exit;
		}
		$apiparam=array();
		$apiparam['title']   = $title;
		$apiparam['context'] = $context;
		$apiparam['userids'] = $userids;
		$apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Member/chatsent',$apiparam);
		echo jsonreturn($Result);
	}
	//检测支付是否成功
	function checkrechargeisok(){
		/*if(!IS_POST){
			//echo jsonreturn(['sign'=>false,'message'=>'非法操作']);exit;
			$res = json_encode(['sign'=>false,'message'=>'非法操作'],JSON_UNESCAPED_UNICODE);
			echo "flightHandler($res)";exit;
		}*/
		$trano   = strip_tags(I('trano'));
		if(strlen($trano)<1){
			//echo jsonreturn(['sign'=>false,'message'=>'订单号错误']);exit;
			$res = json_encode(['sign'=>false,'message'=>'订单号错误'],JSON_UNESCAPED_UNICODE);
			echo "flightHandler($res)";exit;
		}
		$apiparam=array();
		$apiparam['trano']   = $trano;
		$_api = new \Lib\api;
		$Result = $_api->sendHttpClient('Api/Account/checkrechargeisok',$apiparam);
		$res = json_encode($Result,JSON_UNESCAPED_UNICODE);
		echo "flightHandler($res)";
	}

    function getOldPlay(){
        $apiparam=array();
        $typeid = I('typeid');
        $class1 = I('class1');
        $userinfo=session('userinfo');
        $apiparam['userinfo'] = $userinfo;
        if(!$typeid){
            $this->ajaxReturn(['sign'=>false,'message'=>'类型错误']);
        }
        $apiparam['where'][] = array('typeid'=>$typeid);
        if($class1){
            $apiparam['where'][] = array('class1'=>$class1);
        }
        $_api = new \Lib\api;
        $Result = $_api->sendHttpClient('Api/Lottery/getoldplay',$apiparam);
        return $Result;
    }


    function getZrBalance(){
        $apiparam=array();
        $sessionid = session('member_sessionid');
        $auth_id   = session('member_auth_id');
        $apiparam['auth'] = ["member_auth_id"=>$auth_id,"member_sessionid"=>$sessionid];
        $_api = new \Lib\api;
        $Result = $_api->sendHttpClient('Api/Member/getZrBalance',$apiparam);
        echo jsonreturn($Result);
    }

}
?>