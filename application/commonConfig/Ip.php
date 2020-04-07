<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 配置IP信息
// +----------------------------------------------------------------------
namespace app\commonConfig;
class Ip {

    /**
     * 获取真实用IP地址
     *
     */
    public final function getIp() {
        static $realip = NULL; //设置静态变量
        if($realip !== NULL) {
            return $realip;
        }
        if(getenv('HTTP_X_FROWARD_FOR')) {
            $realip = getenv('HTTP_X_FROWARD_FOR');
        } elseif(getenv('HTTP_CLIENT_IP')) {
            $realip = getenv('HTTP_CLIENT_IP');
        } else {
            $realip = getenv('REMOTE_ADDR');
        }

        return $realip;
    }

    /*
     * 返回IP相关信息
     * @param $ip string 传入ip地址
     * return 返回地区信息
     * */
    public final function Ipaddr()
    {
        static $data = NULL; //设置静态变量
        if($data !== NULL) {
            return $data;
        }
        $ip = self::getIp();
        $Ip = new \Net\IpLocation('UTFWry.dat');
        $ipadder = $Ip->getlocation($ip);
        $data['ip'] = $ip;
        if($ip == '127.0.0.1'){
            $data['country'] = '本地局网地址';
        }else{
            $data['country'] = $ipadder['country'].' '.$ipadder['area'];
        }
        return $data;
    }

    /*
     * 加密IP地址
     */
    public final function passIp($ip='') {
        if($ip=='') {
            $ip = self::getIp();
        }
        return sprintf('%u',ip2long($ip));
    }

}

?>