<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 产品
// +----------------------------------------------------------------------
namespace app\common\model;
use app\commonConfig\File;
class Goods extends Common {
    use File;
    protected $timeUpdate = true;
    protected $allow = ['username','home_img','content','price','orprice','freight','shelves','classify_id'];

    public function add($data) {
        $msg = '添加失败';
        $code = 0;
        self::startTrans();
        try {
            if(self::isUpdate(false)->allowField($this->allow)->save($data)) {
                /**
                 * 移动文件操作
                 */
                $file = $this->path['upload'] . date('Ymd'); //新的目录地址
                //目录为空则创建目录
                $this->createFile($file);
                $longFile = $this->path['runtime'].$data['home_img'];
                //移动文件
                if($this->fileCopy($longFile, $this->path['upload'].$data['home_img'])) {
                    //删除文件
                    @unlink($longFile);
                }
                $msg = '添加成功';
                $code = 1;
                self::commit();
            }
        }catch (Exception $e) {
            $msg = '服务器异常';
            self::rollback();
        }
        return self::dataJson($code, $msg, '', '', true);
    }

    //修改
    public function edit($data) {
        $msg = '修改失败';
        $code = 0;
        $find = '';
        if(!empty($data['home_img'])) {
            $find = self::where('goods_id','=',$data['goods_id'])->field('home_img')->find();
        }
        self::startTrans();
        try {
            if(self::isUpdate(true)->allowField($this->allow)->save($data,['goods_id'=>$data['goods_id']])) {
                if(!empty($find)) {
                    /**
                     * 移动文件操作
                     */
                    $file = $this->path['upload'] . date('Ymd'); //新的目录地址
                    //目录为空则创建目录
                    $this->createFile($file);
                    $longFile = $this->path['runtime'].$data['home_img'];
                    //移动文件
                    if($this->fileCopy($longFile, $this->path['upload'].$data['home_img'])) {
                        //删除文件
                        @unlink($longFile);
                        @unlink($this->path['upload'].$find['home_img']);
                    }
                }
                $msg = '修改成功';
                $code = 1;
                self::commit();
            }
        }catch (Exception $e) {
            $msg = '服务器异常';
            self::rollback();
        }
        return self::dataJson($code, $msg, '', '', true);
    }

    //更新全部缓存
    public function updateCache() {
//        $data = self::select()->each(function($user) {
//
//            return $user;
//        })->toArray();

    }

    //删除
    public function del($id) {
        $msg = '删除失败';
        $code = 0;
        self::startTrans();
        try {
            if(self::where('goods_id','=',$id)->delete()) {
                $msg = '删除成功';
                $code = 1;
                self::commit();
            }
        }catch (Exception $e) {
            $msg = '服务器异常';
            self::rollback();
        }
        return self::dataJson($code, $msg, '', '', true);
    }

    //展示数据
    public function show($get,$where=[]) {
        $select = self::where($where)->order('goods_id desc')->paginate($get['limit'], true, ['page'=>$get['page']])->toArray();
        $count = self::where($where)->count();
        return self::dataJson(1, 'success', ['data'=>$select['data'], 'count'=>$count], '', true);
    }

}

?>