<?php
namespace Org\Util;
class BbinService{
	 private $apiAccount='FNhang294';
     private $apiKey='RhE4dcEGAQK8jFyekRMEr4pnp7HF6KM3Up8wrc42umVAuEfMkpz';
	 private $apiPasswd="ybvuvcy7";
		
    
    private $lang = 'zh-CN';//语言
    private $apiUrls  = array(
            'create' => 'http://gm.dfapi.net/api/bbin/register.ashx',
            'balance' => 'http://gm.dfapi.net/api/bbin/balance.ashx ',
            'deposit' => 'http://gm.dfapi.net/api/bbin/deposit.ashx',
            'betRecord' => 'http://gm.dfapi.net/api/bbin/betrecord.ashx',
            'withdrawal' => 'http://gm.dfapi.net/api/bbin/withdrawal.ashx',
            'credit' => 'http://gm.dfapi.net/api/bbin/credit.ashx',
            'login' => 'http://gm.dfapi.net/api/bbin/login.ashx',
            'singlelogin' => 'http://gm.dfapi.net/api/bbin/SingleLogin.ashx');

    private function getSalt($userName){
        return substr(md5($userName),0,5);
    }
    
    public function credit()
    {
        $salt =$this->getSalt($this->apiAccount);
        $code = $salt.md5($this->apiKey.$this->apiAccount.$salt);
        $postdata = array(
            'apiAccount'=>$this->apiAccount,
            'code'=>$code);
        $url = $this->apiUrls['credit'];
        return $this->sendRequest($url,$postdata);
    }   

    /** 创建用户
     * @param $userName
     * @param $password
     * @return mixed
     */
    private function create($userName)
    {
        $salt = $this->getSalt($userName);
        $password = substr(md5(md5($userName)),0,12);
        $code = $salt.md5($this->apiKey.$this->apiAccount.$userName.$password.$salt);
        $postdata = array(
            'apiAccount'=>$this->apiAccount,
            'userName'=>$userName,
            'Password'=>$password,
            'code'=>$code);
        $url = $this->apiUrls['create'];
        return $this->sendRequest($url,$postdata);
    }

    /** 用户余额
     * @param $userName
     * @param $password
     * @return mixed
     */
    public function balance($userName)
    {
		$reg=$this->create($userName);
		if(($reg&&$reg["Code"]===0&&$reg["Success"])||($reg["Message"] =='AccountExsits')){
			 $salt =$this->getSalt($userName);
			$code = $salt.md5($this->apiKey.$this->apiAccount.$userName.$salt);
			$postdata = array(
				'apiAccount'=>$this->apiAccount,
				'userName'=>$userName,
				'code'=>$code);
			$url = $this->apiUrls['balance'];
			$res=$this->sendRequest($url,$postdata);
			if($res&&$res["Code"]===0&&$res["Success"]){
				$ret=array('code'=>1,'balance'=>$res['Data']);
			}else{
				$ret=array('code'=>-1,'balance'=>'---');
			}
		}else{
			$ret=array('code'=>-1,'balance'=>'0.00');
		}
		return $ret;
	
       
    }

    /** 登陆
     * @param $userName
     * @param $password
     * @param string $site
     * @return mixed
     */
    public function login($userName)
    {   
	    $reg=$this->create($userName);
		if(($reg&&$reg["Code"]===0&&$reg["Success"])||($reg["Message"] =='AccountExsits')){
			$salt =$this->getSalt($userName);
			$isMobile=$this->isMobile();
			if($isMobile){
				$isMobile=1;
			}else{
				$isMobile=0;
			}
			$password = substr(md5(md5($userName)),0,12);
			$code = $salt.md5($this->apiKey.$this->apiAccount.$userName.$password.$this->lang.$salt);
			$postdata = array(
				'apiAccount'=>$this->apiAccount,
				'userName'=>$userName,
				'password'=>$password,
				'pageSite'=>"live",
				'isMobile'=>$isMobile,
				'lang'=>$this->lang,
				'code'=>$code);
			$codes = $this->apiKey.$this->apiAccount.$userName.$password.$salt;
			$url = $this->apiUrls['login'];
			$res=$this->sendRequest($url,$postdata);
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
	
    public function singlelogin($userName,$gamecode)
    {   
	    $reg=$this->create($userName);
		if(($reg&&$reg["Code"]===0&&$reg["Success"])||($reg["Message"] =='AccountExsits')){
			 $salt =$this->getSalt($userName);
			$password = substr(md5(md5($userName)),0,12);
			$code = $salt.md5($this->apiKey.$this->apiAccount.$userName.$password.'5'.$gamecode.$this->lang.$salt);
			$postdata = array(
				'apiAccount'=>$this->apiAccount,
				'userName'=>$userName,
				'password'=>$password,
				'gameType'=>3,
				'gameCode'=>$gamecode,
				'languageCode'=>$this->lang,
				'code'=>$code);
			$codes = $this->apiKey.$this->apiAccount.$userName.$password.$salt;
			$url = $this->apiUrls['singlelogin'];
			$res=$this->sendRequest($url,$postdata);
			
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

    /** 提现
     * @param $userName
     * @param $amount
     * @param $billno
     * @param string $method
     * @return mixed
     */
    public function withdrawal($userName,$amount,$billno)
    {
		$reg=$this->create($userName);
		if(($reg&&$reg["Code"]===0&&$reg["Success"])||($reg["Message"] =='AccountExsits')){
			 $salt =$this->getSalt($userName);
			$code = $salt.md5($this->apiKey.$this->apiAccount.$userName.$billno.$amount.$salt);
			$postdata = array(
				'apiAccount'=>$this->apiAccount,
				'userName'=>$userName,
				'transSN'=>$billno,
				'amount'=>$amount,
				'code'=>$code);
			$url = $this->apiUrls['withdrawal'];
			$res= $this->sendRequest($url,$postdata);
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
    /** 提现
     * @param $userName
     * @param $amount
     * @param $billno
     * @param string $method
     * @return mixed
     */
    public function deposit($userName,$amount,$billno)
    {
		$reg=$this->create($userName);
		if(($reg&&$reg["Code"]===0&&$reg["Success"])||($reg["Message"] =='AccountExsits')){
			 $salt =$this->getSalt($userName);
			$code = $salt.md5($this->apiKey.$this->apiAccount.$userName.$billno.$amount.$salt);
			$postdata = array(
				'apiAccount'=>$this->apiAccount,
				'userName'=>$userName,
				'transSN'=>$billno,
				'amount'=>$amount,
				'code'=>$code);
			$url = $this->apiUrls['deposit'];
			$res=$this->sendRequest($url,$postdata);
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
    
    private function sendRequest($url,$post_data=array(),$post=true){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $res = curl_exec($ch);
        curl_close($ch);
        /* 
         echo "<br>  URL ========= ".$url."<br>";
        echo "<br>  post_data ========= ".$url."<br>";
        print_r($post_data);
        echo "<br> return_data ========= <br>";  
        print_r($res);  */
        
        return json_decode($res,true);
    }  
    
    public  function getGameRecord($roundDate, $startTime , $endTime, $gameKind,$subGameKind,$gameType,$pageIndex,$pageSize){
        $salt =$this->getSalt(''.time());
         $code = $salt.md5($this->apiKey.$this->apiAccount.$roundDate.$startTime.$endTime.$gameKind.$gameType.$subGameKind.$pageIndex.$pageSize.$salt);
        $postdata = array(
            'apiAccount'=>$this->apiAccount,
            'roundDate'=>$roundDate,
            'startTime'=>$startTime,
            'endTime'=>$endTime,
            'gameKind'=>$gameKind,
            'subGameKind'=>$subGameKind,
            'gameType'=>$gameType,
            'pageIndex'=>$pageIndex,
            'pageSize'=>$pageSize,
            'code'=>$code);
			// var_dump($postdata);
        $url = $this->apiUrls['betRecord'];
        return $this->sendRequest($url,$postdata);
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
