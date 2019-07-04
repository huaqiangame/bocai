<?php

namespace Org\Api;
class Des
{
    protected $password = '3053239b74';
    protected $private_key = '6ff7d1cb963b4b690d64ce57caf9730a';
    protected $apiAccount="w10";
    protected $password_prefix = 'p_!#%_';
    protected $username_prefix = 'usr_name_';//'usr_name_';///固定 禁止变动
    private static $_instance = NULL;
    /**
     * @return Des
     */
    public static function share()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Des();
        }
        return self::$_instance;
    }

    /**
     * 加密
     * @param string $str 要处理的字符串
     * @param string $key 加密Key，为8个字节长度
     * @return string
     */
    public function encode($str, $key)
    {
        $str = str_replace('+', '%2b', $str);
        $size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);
        $str = $this->pkcs5Pad($str, $size);
        $aaa = mcrypt_cbc(MCRYPT_DES, $key, $str, MCRYPT_ENCRYPT, $key);
        $ret = base64_encode($aaa);
        return urlencode($ret);
    }

    /**
     * 解密
     * @param string $str 要处理的字符串
     * @param string $key 解密Key，为8个字节长度
     * @return string
     */
    public function decode($str, $key)
    {
        $strBin = base64_decode($str);
        $str = mcrypt_cbc(MCRYPT_DES, $key, $strBin, MCRYPT_DECRYPT, $key);
        $str = $this->pkcs5Unpad($str);
        return $str;
    }

    public function hex2bin($hexData)
    {
        $binData = "";
        for ($i = 0; $i < strlen($hexData); $i += 2) {
            $binData .= chr(hexdec(substr($hexData, $i, 2)));
        }
        return $binData;
    }

    public function pkcs5Pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public function pkcs5Unpad($text)
    {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text))
            return false;

        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;

        return substr($text, 0, -1 * $pad);
    }

    //接口请求函数
    protected function https_request($url, $data = null,$post=true)
    {
        $curl = curl_init();//开启请求会话
        curl_setopt($curl, CURLOPT_URL, $url);  //请求的地址
        curl_setopt($curl, CURLOPT_POST, $post);
        //默认执行GET请求
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  //请求模式为get的设置
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); //请求模式为get的设置

        //执行POST请求
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);   // 设置POST请求方式
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  // 设置POST请求方式,并且加上json数据
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  //执行以后返回文件流，而不直接输出

        //执行请求
        $output = curl_exec($curl);
        //关闭资源
        curl_close($curl);
        //吧返回的JSON转成数组
        $output = json_decode($output, true);
        return $output;
    }

    /*移动端判断*/
    protected  function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA'])) {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia',
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
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }

    protected function request_url($username,$actype,$pass_status=0){
        $username = $this->username_prefix.$username;
        $md5_user_name = strtolower(substr(md5($this->password_prefix.$username),0,9));
        $password = substr(md5($this->password_prefix.$username),0,12);
        $post_data = array(
            'api_name'=>$this->apiAccount,
            'api_pass'=>$this->password,
            'private_key'=>$this->private_key,
            'username'=>$md5_user_name,
            'actype'=>$actype
        );
        if($pass_status){
            $post_data['password'] = $password;
        }
        return $post_data;
    }

    protected function docurl($url,$post_data=array(),$post=true){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $res = curl_exec($ch);
        $errno = curl_errno( $ch );
        curl_close($ch);
        return $res;
    }
}

?>