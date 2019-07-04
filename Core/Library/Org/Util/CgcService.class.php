<?php
namespace Org\Util;
class CgcService{
    private $password_prefix = 'abc123';
    private $username_prefix = 'cpe123';
    private $api_key = '2Hg2OP8PwueZZL8lDBIJClCNYZEcWUMh';
    private $api_id="wnsr8168";
    private $api_url = 'http://api.cgcapi.net';
    private $api_code ;
    private $debug = 0;
    private $betLimitCode = 'A';
    private $currencyCode = 'CNY';
    private $isspeed = 0;
    private $isdemo = 0;


    function __construct($api_code)
    {
        $this->api_code = $api_code;
    }

    /*
    * 商户余额查询
    */
    function credit(){

        $post_data = array(
            'api_id'=>$this->api_id,
            'api_key'=>$this->api_key,
            'api_code' => $this->api_code,
            'method'=>'credit');

        $res = $this->docurl($this->api_url, $post_data);
        //var_dump($res);exit;
        if($res&&$res['status']["errorCode"]===0&&$res['status']["msg"]='成功'){
            $ret=array('code'=>1,'credit'=>$res['data']);
        }else{
            $ret=array('code'=>-1,'credit'=>'---');
        }
        return $ret;

    }

    /*
    * 游戏记录 http://<domain>/api/ag/betrecord.ashx
    */
    function betrecord($startDate,$endDate,$pageIndex,$pageSize){

        $post_data = array(
            'api_id'=>$this->api_id,
            'api_key'=>$this->api_key,
            'api_code' => $this->api_code,
            'start_at'=>$startDate,
            'end_at'=>$endDate,
            'page'=>$pageIndex,
            'pagesize'=>$pageSize,
            'method'=>'gamerecord');
        $res = $this->docurl($this->api_url, $post_data);

        return $res;
    }

    /*
    * 查询余额 http://<domain>/api/ag/balance.ashx
    */
    function balance($username,$actype=1){

        $reg=$this->register($username);
        if($reg||$reg['status']['errorCode']===0||$reg['status']['msg']='成功'){
            //$username = $this->username_prefix.$username;
            $password = substr(md5($this->password_prefix.$username),0,12);
            $post_data = array(
                'api_id'=>$this->api_id,
                'api_key'=>$this->api_key,
                'api_code' => $this->api_code,
                'username' => $username,
                'password'=>$password,
                'betLimitCode'=>$this->betLimitCode,
                'currencyCode'=>$this->currencyCode,
                'isSpeed'=>$this->isspeed,
                'isDemo'=>$this->isdemo,
                'method'=>'balance');

            $res = $this->docurl($this->api_url, $post_data);
            if($res&&$res['status']["errorCode"]===0&&$res['status']["msg"]='成功'){
                $ret=array('code'=>1,'balance'=>$res['data']['Data']);
            }else{
                $ret=array('code'=>-1,'balance'=>'---');
            }

        }else{
            $ret=array('code'=>-1,'balance'=>'0.00');
        }

        return $ret;

    }

    /*
     * 转入 转出 http://<domain>/api/ag/deposit.ashx
     */


    function transfer($username,$amount,$billno,$type){
        $reg=$this->register($username);
        if($reg||$reg['status']['errorCode']===0||$reg['status']['msg']='成功'){
            $password = substr(md5($this->password_prefix.$username),0,12);
            $post_data = array(
                'api_id'=>$this->api_id,
                'api_key'=>$this->api_key,
                'api_code' => $this->api_code,
                'username' => $username,
                'password'=>$password,
                'amount' => $amount,
                'type' => $type,
                'billno' => $billno,
                'method'=>'transfer');
            $res = $this->docurl($this->api_url, $post_data);
            //var_dump($post_data);
            if($res&&$res['status']["errorCode"]===0&&$res['status']["msg"]='成功'){
                $ret=array('code'=>1,'msg'=>"Success");
            }else{
                $ret=array('code'=>-1,'msg'=>$res['status']["msg"]);
            }

        }else{
            $ret=array('code'=>-1,'msg'=>'系统繁忙');
        }

        return $ret;




    }

    /*
    * 登录视讯 http://<domain>/api/ag/login.ashx
    */
    function login($username){
        $reg=$this->register($username);
        if($reg||$reg['status']['errorCode']===0||$reg['status']['msg']='成功'){
            //$username = $this->username_prefix.$username;
            $password = substr(md5($this->password_prefix.$username),0,12);
            $isMobile=$this->isMobile();
            $gameType='';
            $gameId='';
            $gameName='';

            if($isMobile){
                $is_Mobile=1;
                if ($this->api_code=='MG'){
                    $gameType=2;
                }

            }else{
                $is_Mobile=0;
                if ($this->api_code=='MG'){
                    $gameType=0;
                }
            }
            $post_data = array(
                'api_id'=>$this->api_id,
                'api_key'=>$this->api_key,
                'api_code' => $this->api_code,
                'username' => $username,
                'password'=>$password,
                'betLimitCode'=>$this->betLimitCode,
                'currencyCode'=>$this->currencyCode,
                'isSpeed'=>$this->isspeed,
                'isDemo'=>$this->isdemo,
                'method'=>'login',
                'gameType' => $gameType,
                'gameId' => $gameId,
                'gameName' => $gameName,
                'isMobile' => $is_Mobile);

            $res = $this->docurl($this->api_url, $post_data);
            //var_dump($res['data']);exit;
            if($res&&$res['status']["errorCode"]===0&&$res['status']["msg"]='成功'){
                //var_dump($res['data']);exit;
                $ret=array('code'=>1,'msg'=>$res['data']);
            }else{
                $ret=array('code'=>-1,'msg'=>'系统繁忙');
            }
        }else{
            $ret=array('code'=>-1,'msg'=>'系统繁忙');
        }
        return $ret;

    }

    /*
     * 帐号注册 http://<domain>/api/ag/register.ashx
     */
    function register($username,$actype=1){
        //$u_name=$username;
        //$username = $this->username_prefix.$username;
        $password = substr(md5($this->password_prefix.$username),0,12);
        $is_test = 0;
        $post_data = array(
            'api_id'=>$this->api_id,
            'api_key'=>$this->api_key,
            'api_code' => $this->api_code,
            'username' => $username,
            'password'=>$password,
            'betLimitCode'=>$this->betLimitCode,
            'currencyCode'=>$this->currencyCode,
            'isSpeed'=>$this->isspeed,'is_test'=>$is_test,
            'method'=>'register');

        $res = $this->docurl($this->api_url, $post_data);
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
