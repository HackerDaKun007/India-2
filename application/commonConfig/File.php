<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 配置移动文件
// +----------------------------------------------------------------------
namespace app\commonConfig;
trait File {

    /**
     * 创建目录
     * @param string $val 目录地址
     */
    protected final function createFile($val) {
        if(empty(file_exists($val))) { //为空就创建文件夹
            if(!is_dir($val)){
                mkdir(iconv("UTF-8", "GBK", $val),0777,true);
            }
        }
    }

    /**
     * 移动文件
     * @param string $url 久文件地址
     * @param string $val 新文件地址
     * @return bool 移动成功返回true, 失败false
     */
    protected final function fileCopy($url, $val) {
        if(!empty(copy($url,$val))){
            return true;
        }
        return false;
    }


}
?>