<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 产品归类
// +----------------------------------------------------------------------
namespace app\common\model;
class Classify extends Common {

    protected $timeUpdate = true;
    protected $allow = ['username'];
    //添加
    public function add($data,$cache) {
        $msg = '添加失败';
        $code = 0;
        //判断名称是否存在
        $count = self::where('username', '=', $data['username'])->count();
        if($count > 0) {
            $msg = '当前名称已存在';
        }else {
            self::startTrans();
            try {
                if(self::isUpdate(false)->allowField($this->allow)->save($data)) {
                    $msg = '添加成功';
                    $code = 1;
                    $this->cacheUpdate($cache);
                }
            }catch (Exception $e) {
                $msg = '服务器异常';
            }
        }
        return self::dataJson($code, $msg,'','',true);
    }

    //更新缓存
    public function cacheUpdate($cache) {
        $data = self::select()->order('classify_id desc')->toArray();
        $cache::set($this->path['goodsClassify'],$data);
        return $data;
    }

    //读取缓存
    public function readCache($cache) {
        $data = $cache::get($this->path['webUpload']);
        if(!$data) {
            $data = $this->cacheUpdate($cache);
        }
        return $data;
    }

    //修改
    public function edit($data,$cache) {
        $msg = '修改失败';
        $code = 0;
        //判断名称是否存在
        $where = [
            ['username', 'eq', $data['username']],
            ['classify_id', 'neq', $data['classify_id']],
        ];
        $count = self::where($where)->count();
        if($count > 0) {
            $msg = '当前名称已存在';
        }else {
            self::startTrans();
            try {
                if(self::isUpdate(true)->allowField($this->allow)->save($data,['classify_id'=>$data['classify_id']])) {
                    $msg = '修改成功';
                    $code = 1;
                    $this->cacheUpdate($cache);
                }
            }catch (Exception $e) {
                $msg = '服务器异常';
            }
        }
        return self::dataJson($code, $msg,'','',true);
    }

    //删除
    public function del($id,$cache) {
        $msg = '删除失败';
        $code = 0;
        self::startTrans();
        try {
            if(self::where('classify_id','=',$id)->delete()) {
                $msg = '删除成功';
                $code = 1;
                $this->cacheUpdate($cache);
            }
        }catch (Exception $e) {
            $msg = '服务器异常';
        }
        return self::dataJson($code, $msg,'','',true);
    }

    //展示
    public function show($get,$where) {
        $select = self::where($where)->order('classify_id desc')->paginate($get['limit'], true, ['page'=>$get['page']])->toArray();
        $count = self::where($where)->count();
        return self::dataJson(1, 'success', ['data'=>$select['data'], 'count'=>$count], '', true);
    }

}
?>