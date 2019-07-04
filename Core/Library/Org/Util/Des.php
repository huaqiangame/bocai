<?php
namespace Org\Util;
class JoDES {
 
    private static $_instance = NULL;
    /**
     * @return JoDES
     */
    public static function share() {
        if (is_null(self::$_instance)) {
            self::$_instance = new JoDES();
        }
        return self::$_instance;
    }
 
    /**
     * ����
     * @param string $str Ҫ������ַ���
     * @param string $key ����Key��Ϊ8���ֽڳ���
     * @return string
     */
    public function encode($str, $key) {
		$str=str_replace('+','%2',$str);
        $size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);
        $str = $this->pkcs5Pad($str, $size);
        $aaa = mcrypt_cbc(MCRYPT_DES, $key, $str, MCRYPT_ENCRYPT, $key);
        $ret = base64_encode($aaa);
        return urlencode($ret);
    }
 
    /**
     * ����
     * @param string $str Ҫ������ַ���
     * @param string $key ����Key��Ϊ8���ֽڳ���
     * @return string
     */
    public function decode($str, $key) {
        $strBin = base64_decode($str);
        $str = mcrypt_cbc(MCRYPT_DES, $key, $strBin, MCRYPT_DECRYPT, $key);
        $str = $this->pkcs5Unpad($str);
        return $str;
    }
 
    function hex2bin($hexData) {
        $binData = "";
        for ($i = 0; $i < strlen($hexData); $i += 2) {
            $binData .= chr(hexdec(substr($hexData, $i, 2)));
        }
        return $binData;
    }
 
    function pkcs5Pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
 
    function pkcs5Unpad($text) {
        $pad = ord($text {strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
 
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;
 
        return substr($text, 0, - 1 * $pad);
    }
 
}
?>