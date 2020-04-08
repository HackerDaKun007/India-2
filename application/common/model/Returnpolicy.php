<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 退货政策
// +----------------------------------------------------------------------
namespace app\common\model;

class Returnpolicy extends Common {
    /**
     * @param $data  修改数据
     * @param $cache  缓存
     * @return array|false|string
     */
    public function edit ($data, $cache) {
        $code = 0;
        $msg = "修改失败";
        $allow = ['username', 'content'];
        self::startTrans();
        try {
            if(self::isUpdate(true)->allowField($allow)->save($data, ['returnpolicy_id'=>1])) {
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
        $data = self::where('returnpolicy_id', '=', 1)->find();
        if($data) {
            $data = json_decode($data, true);
            $cache::set($this->path['Returnpolicy'], $data);
        }
        return $data;
    }

    //读取缓存
    public function readCache($cache) {
        $data = $cache::get($this->path['Returnpolicy']);
        if(!$data) {
            $this->cacheUpdate($cache);
        }
        return $data;
    }
}