<?php
namespace Org\Util;
require_once "Biapi.class.php";	
class AgService{
	private $password_prefix = '';
	private $username_prefix = '';
	private $agent = 'RhE4dcEGAQK8jFyekRMEr4pnp7HF6KM3Up8wrc42umVAuEfMkpz';
    private $apiAccount="ybvuvcy7";
    private $register_url = 'http://gm.dfapi.net/api/ag/register.ashx'; //新增会员url
    private $balance_url = 'http://gm.dfapi.net/api/ag/balance.ashx'; //查询余额url
    private $trans_in_url = 'http://gm.dfapi.net/api/ag/deposit.ashx'; //存款url
    private $trans_out_url = 'http://gm.dfapi.net/api/ag/withdrawal.ashx'; //取款url
    private $login_url = 'http://gm.dfapi.net/api/ag/login.ashx'; //游戏登录url
    private $credit_url = 'http://gm.dfapi.net/api/ag/credit.ashx'; //游戏登录url
    private $betrecord_url = 'http://gm.dfapi.net/api/ag/betrecord.ashx'; //huoqujilu


	function __construct()
    {
		
	}

    function credit(){
        $salt = strtolower(substr(md5($this->apiAccount),0,5));
        $code = $salt.md5($this->agent.$this->apiAccount.$salt);
        $post_data = array(
            'apiAccount'=>$this->apiAccount,
            'code'=>$code
        );
        $res = $this->docurl($this->credit_url, $post_data);
		if($res&&$res["Code"]===0&&$res["Success"]){
				$ret=array('code'=>1,'credit'=>$res['Data']["Credit"]);
		}else{
				$ret=array('code'=>-1,'credit'=>'---');
		}
        return $ret;

    }

    function betrecord($startDate,$endDate,$pageIndex,$pageSize){
		$api=new  Biapi();
		return  $api->GetMerchantReport('AG', $startDate, $endDate, $TimeStamp, $pageIndex, $pageSize) ;
		$salt = strtolower(substr(md5($this->apiAccount),0,5));
		$code = $salt.md5($this->agent.$this->apiAccount.$startDate.$endDate.$pageIndex.$pageSize.$salt);
		$post_data = array(
		'apiAccount'=>$this->apiAccount,
		'startDate'=>$startDate,
		'endDate'=>$endDate,
		'pageIndex'=>$pageIndex,
		'pageSize'=>$pageSize,
		'code'=>$code
		);
		
		$res = $this->docurl($this->betrecord_url, $post_data);
		return $res; 
	}
	
	function balance($username,$actype=1){
		$api=new  Biapi();
		$r= $api->balances('AG',$username);
		$ret=array('code'=>1,'balance'=>$r);
		
		return $ret;
		$reg=$this->register($username);
		if($reg&&$reg["Code"]===0&&$reg["Success"]){
			
			$username = $this->username_prefix.$username;
			$password = substr(md5($this->password_prefix.$username),0,12);
			$salt = strtolower(substr(md5($this->password_prefix.$username),0,5));
			$isDemo=0;
			$code = $salt.md5($this->agent.$this->apiAccount.$username.$password.$isDemo.$salt);
			$post_data = array(
				'apiAccount'=>$this->apiAccount,
				'userName'=>$username,
				'password'=>$password,
				'isDemo'=>$isDemo,
				'code'=>$code
			);
			$res = $this->docurl($this->balance_url, $post_data);
			if($res&&$res["Code"]===0&&$res["Success"]){
				$ret=array('code'=>1,'balance'=>$res['Data']);
			}else{
				$ret=array('code'=>-1,'balance'=>'---');
			}
			
		}else{
			$ret=array('code'=>-1,'balance'=>'0.00');
		}
		
		return $ret;
		/*
		 *  成功：{“result”:true, amount: 100}  
           	失败：{“result”: true, “code”: “code”, “info”: “failed!”}  
           */ 
		
	}

    function trans_out($username,$credit,$billno){
$api=new  Biapi();
		$r= $api->zzmoney('AG',$username,'OUT',$credit);
		if ($r===true){
			$ret=array('code'=>1,'msg'=>"Success");
		}else{
			$ret=array('code'=>-1,'msg'=>$r);
		}
	return $ret;
		$reg=$this->register($username);
		if($reg&&$reg["Code"]===0&&$reg["Success"]){
			$username = $this->username_prefix.$username;
			$password = substr(md5($this->password_prefix.$username),0,12);
			$salt = strtolower(substr(md5($this->password_prefix.$username),0,5));
			$isDemo=0;
			$code = $salt.md5($this->agent.$this->apiAccount.$username.$password .$billno.$credit.$isDemo.$salt);
			$post_data = array(
				'apiAccount'=>$this->apiAccount,
				'userName'=>$username,
				'password'=>$password,
				'transSN'=>$billno,
				'amount'=>$credit,
				'isDemo'=>$isDemo,
				'code'=>$code
			);
			$res = $this->docurl($this->trans_out_url, $post_data);
			if($res&&$res["Code"]===0&&$res["Success"]){
				$ret=array('code'=>1,'msg'=>"Success");
			}else{
					$ret=array('code'=>-1,'msg'=>$res["Message"]);
			}
			
		}else{
			$ret=array('code'=>-1,'msg'=>'系统繁忙');
		}
       
        return $ret;

       
    }

    function trans_in($username,$credit,$billno){
		$api=new  Biapi();
		$r= $api->zzmoney('AG',$username,'IN',$credit);
		if ($r===true){
			$ret=array('code'=>1,'msg'=>"Success");
		}else{
			$ret=array('code'=>-1,'msg'=>$r);
		}
	return $ret;
		$reg=$this->register($username);
		if($reg&&$reg["Code"]===0&&$reg["Success"]){
			 $username = $this->username_prefix.$username;
				$password = substr(md5($this->password_prefix.$username),0,12);
				$salt = strtolower(substr(md5($this->password_prefix.$username),0,5));
				
				$code = $salt.md5($this->agent.$this->apiAccount.$username.$password .$billno.$credit.$salt);
				$post_data = array(
					'apiAccount'=>$this->apiAccount,
					'userName'=>$username,
					'password'=>$password,
					'transSN'=>$billno,
					'amount'=>$credit,
					'code'=>$code
				);
				$res = $this->docurl($this->trans_in_url, $post_data);
				if($res&&$res["Code"]===0&&$res["Success"]){
				$ret=array('code'=>1,'msg'=>"Success");
				}else{
					$ret=array('code'=>-1,'msg'=>$res["Message"]);
				}
				
		}else{
			$ret=array('code'=>-1,'msg'=>'系统繁忙');
		}
       
        return $ret;	
      

       

    }
	
	function login($username,$code=null){
		
		$api=new  Biapi();
	$r= $api->loginbi('AG',$username,$code);
	
		$ret=array('code'=>1,'msg'=>$r);
		
		return $ret;
		$reg=$this->register($username);
		if($reg&&$reg["Code"]===0&&$reg["Success"]){
			$username = $this->username_prefix.$username;
			$password = substr(md5($this->password_prefix.$username),0,12);
			$salt = strtolower(substr(md5($this->password_prefix.$username),0,5));
			$lang='zh-CN';
			$isSpeed=0;
			$isDemo=0;
			$isMobile=$this->isMobile();
			if($isMobile){
				$isMobile=1;
			}else{
				$isMobile=0;
			}
			$code = $salt.md5($this->agent.$this->apiAccount.$username.$password.$lang.$isSpeed.$isDemo.$salt);
			$post_data = array(
			'apiAccount'=>$this->apiAccount,
			'userName'=>$username,
			'password'=>$password,
			'lang'=>$lang,
			'isSpeed'=>$isSpeed,
			'isMobile'=>$isMobile,
			'isDemo'=>$isDemo,
			'mode'=>1,
			'code'=>$code
			);
			$res = $this->docurl($this->login_url, $post_data);
			if($res&&$res["Code"]===0&&$res["Success"]){
				$ret=array('code'=>1,'msg'=>$res['Data']);
			}else{
				$ret=array('code'=>-1,'msg'=>'系统繁忙');
			}
		}else{
			$ret=array('code'=>-1,'msg'=>'系统繁忙');
		}
		return $ret;
		  
	}


    function register($username,$actype=1){
       
        //参数 agent,username,password,key
        $u_name=$username;
        $username = $this->username_prefix.$username;
        $password = substr(md5($this->password_prefix.$username),0,12);
        $salt = strtolower(substr(md5($this->password_prefix.$username),0,5));
        $isDemo=0;
        $code = $salt.md5($this->agent.$this->apiAccount.$username.$password.$isDemo.$salt);
        $post_data = array(
            'apiAccount'=>$this->apiAccount,
            'userName'=>$username,
            'password'=>$password,
            'isDemo'=>$isDemo,
            'code'=>$code,
        );
        $res = $this->docurl($this->register_url, $post_data);
		return  $res ;
       
    }

	private function docurl($url,$post_data=array(),$post=true){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$res = curl_exec($ch);
		curl_close($ch);
		return json_decode($res,true);
	}
	
	function geterrorcode($code=''){
		
		$errorcode = array("10000"=>array("error info","查看具体的说明内容"),
"10016"=>array("Network error!","网络错误"),
"25004"=>array("The agent is not exist","代理商号不存在"),
"22011"=>array("The member is not exist","会员不存在"),
"44000"=>array("key error..","验证码错误或丢失"),
"44001"=>array("The parameters are not complete","参数不完整"));
		if($code){
			if(key_exists($code, $errorcode)){
				return $errorcode[$code][1];
			}else{
				return '服务器忙，请稍后重试';
			}
		}
		return $errorcode;
	}
	
	
	function logindianzi($username){
		$username = $this->username_prefix.$username;
		$password = substr(md5($this->password_prefix.$username),0,12);
		$salt = strtolower(substr(md5($this->password_prefix.$username),0,5));
		$lang='zh-CN';
		$isSpeed=0;
		$isDemo=0;
		$gameType=8;
		$code = $salt.md5($this->agent.$this->apiAccount.$username.$password.$lang.$isSpeed.$isDemo.$salt);
		$post_data = array(
		'apiAccount'=>$this->apiAccount,
		'userName'=>$username,
		'password'=>$password,
		'lang'=>$lang,
		'gameType'=>$gameType,
		'isSpeed'=>$isSpeed,
		'isDemo'=>$isDemo,
		'code'=>$code
		);
		//print_r($post_data);
		$res = $this->docurl($this->login_url, $post_data);
		$res['Data'] =str_replace('jack888.com:81','ven338.com',$res['Data']);
		//print_r($res);
		return $res;
		/*
		 *  成功：{“result”:true, “url”: “http_url”, params: “parameters”, key: “key”}  
        	失败：{“result”: true, “code”: “error_code”, “info”: “failed!”}  
		 * */  
	}	
	function loginbuyu($username){
		$username = $this->username_prefix.$username;
		$password = substr(md5($this->password_prefix.$username),0,12);
		$salt = strtolower(substr(md5($this->password_prefix.$username),0,5));
		$lang='zh-CN';
		$isSpeed=0;
		$isDemo=0;
		$gameType=6;
		$code = $salt.md5($this->agent.$this->apiAccount.$username.$password.$lang.$isSpeed.$isDemo.$salt);
		$post_data = array(
		'apiAccount'=>$this->apiAccount,
		'userName'=>$username,
		'password'=>$password,
		'lang'=>$lang,
		'gameType'=>$gameType,
		'isSpeed'=>$isSpeed,
		'isDemo'=>$isDemo,
		'code'=>$code
		);
		//print_r($post_data);
		$res = $this->docurl($this->login_url, $post_data);
		$res['Data'] =str_replace('jack888.com:81','ven338.com',$res['Data']);
		//print_r($res);
		return $res;
		/*
		 *  成功：{“result”:true, “url”: “http_url”, params: “parameters”, key: “key”}  
        	失败：{“result”: true, “code”: “error_code”, “info”: “failed!”}  
		 * */  
	}
	
	/*移动端判断*/
    function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
        {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            }
        }
        return false;
    }
}
