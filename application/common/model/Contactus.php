<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 联系我们
// +----------------------------------------------------------------------
namespace app\common\model;

class Contactus extends Common {
    /**
     * @param $data  修改数据
     * @param $cache 缓存变量
     * @return array|false|string  返回相关状态信息
     */
    public function edit($data, $cache) {
        $code = 0;
        $msg = '修改失败';
        $allow = ['username', 'content'];
        self::startTrans();
        try {
            if(self::isUpdate(true)->allowField($allow)->save($data,['contactus_id'=>1])){
                $code = 1;
                $msg = "修改成功";
                $this->cacheUpdate($cache);
                self::commit();
            }
        } catch (Exception $e) {
            $msg = "服务器异常";
        }
        return self::dataJson($code, $msg, '', '', true);
    }

    //更新缓存
    public function cacheUpdate($cache) {
        $data = self::where('contactus_id', '=', 1)->find();
        if($data) {
            $data = json_decode($data, true);
            $cache::set($this->path['Contactus'], $data);
        }
        return $data;
    }

    //读取缓存
    public function readCache($cache) {
        $data = $cache::get($this->path['Contactus']);
        if(!$data) {
            $this->cacheUpdate($cache);
        }
        return $data;
    }

}