<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 页面分类
// +----------------------------------------------------------------------
namespace app\common\model;

class Sectionsort extends Common {

    protected $timeUpdate = true;
    protected $allow = ['username','remark'];

    //展示
    public function show($get,$where) {
        $select = self::where($where)->order('sectionsort_id desc')->paginate($get['limit'], true, ['page'=>$get['page']])->toArray();
        $count = self::where($where)->count();
        return self::dataJson(1, 'success', ['data'=>$select['data'], 'count'=>$count], '', true);
    }

    //添加
    public function add($data,$cache) {
        $msg = '添加失败';
        $code = 0;
        //判断名称是否存在
        $count = self::where('username', '=', $data['username'])->count();
        if($count > 0) {
            $msg = '当前分类已存在';
        }else {
            self::startTrans();
            try {
                if(self::isUpdate(false)->allowField($this->allow)->save($data)) {
                    $msg = '添加成功';
                    $code = 1;
                    $this->cacheUpdate($cache);
                    self::commit();
                }
            }catch (Exception $e) {
                $msg = '服务器异常';
            }
        }
        return self::dataJson($code, $msg,'','',true);
    }

    //更新缓存
    public function cacheUpdate($cache) {
        $data = self::select()->order('sectionsort_id desc')->toArray();
        $cache::set($this->path['Sectionsort'],$data);
        return $data;
    }

    //读取缓存
    public function readCache($cache) {
        $data = $cache::get($this->path['Sectionsort']);
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
            ['sectionsort_id', 'neq', $data['oldsort_id']],
        ];
        $count = self::where($where)->count();
        if($count > 0) {
            $msg = '当前名称已存在';
        }else {
            self::startTrans();
            try {
                if(self::isUpdate(true)->allowField($this->allow)->save($data,['sectionsort_id'=>$data['sectionsort_id']])) {
                    $msg = '修改成功';
                    $code = 1;
                    $this->cacheUpdate($cache);
                    self::commit();
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
            if(self::where('sectionsort_id','=',$id)->delete()) {
                $msg = '删除成功';
                $code = 1;
                $this->cacheUpdate($cache);
                self::commit();
            }
        }catch (Exception $e) {
            $msg = '服务器异常';
        }
        return self::dataJson($code, $msg,'','',true);
    }


    //目录
    /**新建目录
     * @param $folderName  目录路径
     * @return bool
     */
    public function folderAdd ($folderName) {
        $msg = false;
        if (!is_dir($folderName)) {
            if (mkdir($folderName)) {
                $msg = true;
            }
        }
        return $msg;
    }

    /**删除目录
     * @param $folderName  目录路径
     * @return bool
     */
    public function folderDel ($folderName) {
        $msg = false;
        if (is_dir($folderName)) {
            if ($dh = opendir($folderName)) {
                if (count(scandir($folderName)) == 2) {//=2是因为目录.和..存在
                    rmdir($folderName);
                }
                while (($file = readdir($dh)) != false) {
                    if ($file != '.' && $file != '..') {
                        $fullpath = $folderName . '/' . $file;
                        if (is_dir($fullpath)) {
                            if (count(scandir($fullpath)) == 2) {//=2是因为目录.和..存在
                                rmdir($fullpath);
                            } else {
                                $this->folderDel($fullpath);
                            }
                        } else {
                            unlink($fullpath);
                        }
                    }
                }
                closedir($dh);
                $msg = true;
            }
        }
        return $msg;
    }

    /**修改目录名称
     * @param $folderOldName  旧目录名称
     * @param $folderNewName  新目录名称
     * @return bool
     */
    public function folderEdit ($folderOldName, $folderNewName) {
        $msg = false;
        if (file_exists($folderOldName)) {
            rename($folderOldName, $folderNewName);
            $msg = true;
        }
        return $msg;
    }

}