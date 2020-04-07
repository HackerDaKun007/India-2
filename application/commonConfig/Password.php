<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 配置加密
// +----------------------------------------------------------------------

namespace app\commonConfig;
class Password {

    /**
     * 加密
     * @param string $val 加密字符
     * @param string $key 固定加密字符
     * @return static 返回加密数据
     */
    public final function respass($txt='',$key='dakun007') {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
        $nh = rand(0,64);
        $ch = $chars[$nh];
        $mdKey = md5($key.$ch);
        $mdKey = substr($mdKey,$nh%8, $nh%8+7);
        $txt = base64_encode($txt);
        $tmp = '';
        $i=0;$j=0;$k = 0;
        for ($i=0; $i<strlen($txt); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = ($nh+strpos($chars,$txt[$i])+ord($mdKey[$k++]))%64;
            $tmp .= $chars[$j];
        }
        return urlencode($ch.$tmp);
    }

    /**
     * @param string $val 解密数据
     * @return static 返回解密后数据
     */
    public final function repassJie($txt='', $key='dakun007') {
        $txt = urldecode($txt);
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
        $ch = $txt[0];
        $nh = strpos($chars,$ch);
        $mdKey = md5($key.$ch);
        $mdKey = substr($mdKey,$nh%8, $nh%8+7);
        $txt = substr($txt,1);
        $tmp = '';
        $i=0;$j=0; $k = 0;
        for ($i=0; $i<strlen($txt); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = strpos($chars,$txt[$i])-$nh - ord($mdKey[$k++]);
            while ($j<0) $j+=64;
            $tmp .= $chars[$j];
        }
        return base64_decode($tmp);
    }

    /**
     * 用户密码加密函数
     * @param string $val 用户输入密码
     * @param string $rand 随机加密
     * @param string $str 系统固定加密字符
     * @param string 返回加密字符
     */
    public final function encrypt($val, $rand, $str='dakun007@gmail.com') {
        return md5($val . $rand .  $str);
    }

    /**
     * 随机字符
     * @param int $num 传入字符截取长度
     * @return string 返回随机字符
     */
    public final function random($num=8) {
        $str = '1234567890qwertyuiopasdfghjklzxcvbnm_+QWERTYUIOPASDFGHJKLZXCVBNM';
        return substr(str_shuffle($str), 0, $num);
    }

}

?>