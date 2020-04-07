<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 获取当前用户游览器信息
// +----------------------------------------------------------------------
namespace app\commonConfig;

class Browser {

    //是否为微信游览器
    public final function is_wx($val='') {
        if($val == '') {
            $val = $_SERVER['HTTP_USER_AGENT'];
        }
        if (strpos($val, 'MicroMessenger') !== false) {
            return true;
        } else {
            return false;
        }
    }

    //获取客户端操作系统信息包括win10
    public final function GetOs($bool=true, $agent=''){
        $random = '1998520';
        if(!$agent) {
            $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        }
        if(strpos($agent, 'windows nt')) {
            $platform = $bool?$random.'001':'windows';
        }
        elseif(strpos($agent, 'macintosh')) {
            $platform = $bool?$random.'002':'mac';
        }
        elseif(strpos($agent, 'ipod')) {
            $platform = $bool?$random.'003':'ipod';
        }
        elseif(strpos($agent, 'ipad')) {
            $platform = $bool?$random.'004':'ipad';
        }
        elseif(strpos($agent, 'iphone')) {
            $platform = $bool?$random.'005':'iphone';
        }
        elseif (strpos($agent, 'android')) {
            $platform = $bool?$random.'006':'android';
        }
        elseif(strpos($agent, 'unix')) {
            $platform = $bool?$random.'007':'unix';
        }
        elseif(strpos($agent, 'linux')) {
            $platform = $bool?$random.'008':'linux';
        }
        else {
            $platform = $bool?$random.'009':'other';
        }
        return $platform;
    }


    //返回用户游览器版本，并且返回是否要加密
    public final function GetBrowser($bool=true,$br=''){
        $random = '446690';
        if(!$br) {
            $br = $_SERVER['HTTP_USER_AGENT'];
        }
        if (preg_match('/MSIE/i',$br)) {
            $bro = $bool?$random.'010':'MSIE';
        }
        elseif (preg_match('/Firefox/i',$br)) {
            $bro = $bool?$random.'011':'Firefox';
        }
        elseif (preg_match('/Chrome/i',$br)) {
            $bro = $bool?$random.'012':'Chrome';
        }
        elseif (preg_match('/Safari/i',$br)) {
            $bro = $bool?$random.'013':'Safari';
        }
        elseif (preg_match('/Opera/i',$br)) {
            $bro = $bool?$random.'014':'Opera';
        }
        else {
            $bro = $bool?$random.'015':'Other';
        }
        return $bro;

    }

    //判断http还是https
    public function is_https() {
        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            return true;
        } elseif ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
            return true;
        } elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
            return true;
        }
        return false;
    }


    /**
     * 获取用户提交http过来的数据
     */
    public function getallheaders() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

}