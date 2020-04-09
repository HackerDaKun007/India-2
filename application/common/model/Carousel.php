<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 产品轮播图
// +----------------------------------------------------------------------

namespace app\common\model;
use app\commonConfig\File;
class Carousel extends Common {
    use File;
    protected $timeUpdate = true;
    protected static $all = ['username','img','url','sort'];
    //添加
    public function add($data, $cache) {
        $code = 0;
        $msg = '添加失败';

        self::startTrans();
        try {
            if(self::isUpdate(false)->allowField(self::$all)->save($data)) {
                //移动图片
                $file = $this->path['upload'] .'/'. date('Ymd'); //新的目录地址
                //目录为空则创建目录
                self::createFile($file);
                $longFile = $this->path['runtime'].'/'.$data['img'];
                if(self::fileCopy($longFile, $this->path['upload'].'/'.$data['img'])) {
                    $msg = '添加成功';
                    $code = 1;
                    self::cacheSelect(true, $cache);
                    //删除文件
                    unlink($longFile);
                    self::commit();
                }
            }
        }catch(Exception $e) {
            self::rollback();
            $msg = '数据异常';
        }
        return self::dataJson($code,$msg,'','',true);
    }

    //修改
    public function edit($data, $cache) {
        $code = 0;
        $msg = '修改失败';
        $find = self::field('img')->where('carousel_id','=',$data['carousel_id'])->find();
        if(empty($find)) {
            $msg = '数据ID异常';
        }else {
            self::startTrans();
            try {
                if(self::isUpdate(true)->allowField(self::$all)->save($data,['carousel_id'=>$data['carousel_id']])) {
                    if(!empty($data['img'])) {
                        //移动图片
                        $file = $this->path['upload'] .'/'. date('Ymd'); //新的目录地址
                        //目录为空则创建目录
                        self::createFile($file);
                        $longFile = $this->path['runtime'].'/'.$data['img'];
                        if(self::fileCopy($longFile, $this->path['upload'].'/'.$data['img'])) {
                            //删除缓存文件
                            unlink($longFile);
                            //删除原先图片
                            unlink($this->path['upload'].'/'.$find['img']);
                            //更新缓存
                            $this->cacheSelect(true, $cache);
                        }
                    }
                    $this->cacheSelect(true);
                    $msg = '修改成功';
                    $code = 1;
                    self::commit();
                }else {
                    self::rollback();
                }
            }catch(Exception $e) {
                self::rollback();
                $msg = '数据异常';
            }
        }
        return self::dataJson($code,$msg,'','',true);
    }

    //删除
    public function del($id, $cache) {
        $find = self::where('carousel_id','=',$id)->find();
        $msg = '删除失败';
        $code = 0;
        if($find) {
            self::startTrans();
            try {
                if(self::where('carousel_id','=',$id)->delete()) {
                    unlink($this->path['upload'].'/'.$find['img']);
                    $msg = '删除成功';
                    $code = 1;
                    $this->cacheSelect(true, $cache);
                    self::commit();
                }else {
                    self::rollback();
                }
            }catch (Exception $e) {
                $msg = '数据异常';
                self::rollback();
            }
        }
        return self::dataJson($code,$msg,'','',true);
    }

    /**
     * @param bool $bool 是否更新缓存
     * @return array/bool 返回数组或布尔值
     */
    public  function cacheSelect($bool=false,$cache) {
        $data = $cache::get($this->path['carouselSelect']);
        if(!$data || $bool == true) {
            $data = self::order('sort desc')->select()->toArray();
            $cache::set($this->path['carouselSelect'], $data);
        }
        return $data;
    }

    //展示数据
    public function show($get,$where=[]) {
        $select = self::where($where)->order('sort desc')->paginate($get['limit'], true, ['page'=>$get['page']])->toArray();
        $count = self::where($where)->count();
        return self::dataJson(1, 'success', ['data'=>$select['data'], 'count'=>$count], '', true);
    }

}

?>