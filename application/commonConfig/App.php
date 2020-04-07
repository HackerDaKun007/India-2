<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 控制/模块等都可以直接访问该模块公共方法/变量等
// +----------------------------------------------------------------------
namespace app\commonConfig;

trait App {

    /*
     * 返回信息json状态码或数组状态码
     * @param  int $code 返回状态码
     * @param string $msg  返回提示语句
     * @param arrar $data 返回相关数据
     * @param array $data 返回相关url
     * @param bool $bool false返回json码、true返回数组
     * */
    protected final function dataJson($code=1,$msg='', $data='',$url='', $bool=false) {
        $json = [
            'code' => $code
            ,'msg' => $msg
            ,'data' => $data
            ,'url' => $url
        ];
        if($bool == false) {
            return json_encode($json);
        }else {
            return $json;
        }
    }




    /*
 * 返回layui数据
 * @param $data array 结果数组
 * @param $count int 数据总长度
 * @para $page bool 正常true不正常false
 * */
    protected final function layuiJson($data=[],$count=0,$page=true,$success='success')
    {
        return json_encode([
            'code' => 0,
            'count' => $count,
            'data' => $data,
            'page' => $page,
            'success' => $success
        ]);
    }















}

?>