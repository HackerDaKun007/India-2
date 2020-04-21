<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 页面栏目
// +----------------------------------------------------------------------
namespace app\common\model;

use think\Exception;

class Section extends Common {
    protected $cache;
    protected $timeUpdate = true;
    protected $folderUrl = '../application/home/view/ht/';

    //展示
    public function showList($get, $where, $cache) {
        $this->cache = $cache;
        //$time_start = microtime(true);
        //1
        //$select = self::where($where)->order('section_id desc')->paginate($get['limit'], true, ['page'=>$get['page']])->each(function ($user) {
        //    $sectionsort = $this->cache::get($this->path['Sectionsort']);
        //    $user['user'] = '';
        //    foreach ($sectionsort as $v) {
        //        if($v['sectionsort_id'] == $user['sectionsort_id']) {
        //            $user['user'] = $v['username'];
        //            break;
        //        }
        //    }
        //    return $user;
        //})->toArray();

        //2
        $select = self::where($where)->order('a.section_id desc')->alias('a')->join('sectionsort b', 'a.sectionsort_id = b.sectionsort_id')->field('a.*, b.remark as user')->paginate($get['limit'], true, ['page'=>$get['page']])->toArray();

        //$time_end = microtime(true);
        //$time = $time_end - $time_start;
        //echo $time;
        //exit;
        $count = self::where($where)->alias('a')->count();
        return self::dataJson(1, 'success', [
            'data' => $select['data'],
            'count' => $count,
        ], '', true);

    }

    //添加页面信息，并创建相应文件
    public function add($data,$cache) {
        $msg = '添加失败';
        $code = 0;
        //判断名称是否存在
        $count = self::where([
            'username' => $data['username'],
            'sectionsort_id' => $data['sectionsort_id']
        ])->count();
        if($count > 0) {
            $msg = '当前页面已存在';
        }else {
            //获取分类，并写入文件
            $where = [
                'sectionsort_id' => $data['sectionsort_id'],
            ];
            $sectionsortModel = new \app\common\model\Sectionsort();
            $sectionsort = $sectionsortModel->where($where)->field('username')->find();
            $fileName = $this->folderUrl . $sectionsort['username']. '/' . $data['username'] . '.html';
            self::startTrans();
            try {
                //添加页面数据
                if (self::isUpdate(false)->allowField('username,sectionsort_id')->save($data)) {
                    $bool = false;
                    if (!file_exists($fileName)) {
                        $file = fopen($fileName, 'w');
                        if ($file) {
                            if(!empty(is_writable($fileName))){
                                $fileRes = fwrite($file , $data['text']);
                                fclose($file);
                                if ($fileRes) {
                                    $msg = '添加成功';
                                    $code = 1;
                                    $this->cacheUpdate($cache);
                                    self::commit();
                                }
                            }
                        }
                    }
                }
            } catch (Exception $e) {}
        }
        return self::dataJson($code, $msg,'','',true);
    }

    //删除页面信息，并删除相应文件
    public function del($data,$cache) {
        $msg = '删除失败';
        $code = 0;
        $fileName = 'a';
        self::startTrans();
        try {
            $bool = false;
            //删除文件
            $res = self::where('section_id', '=', $data['section_id'])->alias('a')->join('sectionsort b','a.sectionsort_id = b.sectionsort_id')->field('a.username, b.username as sort')->find();
            $fileName = $this->folderUrl . $res['sort'] . '/' . $res['username'] . '.html';
            if (file_exists($fileName)) {
                if(unlink($fileName)) {
                    $bool = true;
                }
            }
            //删除页面数据
            if (self::where('section_id', '=', $data['section_id'])->delete()) {
                if ($bool) {
                    $code = 1;
                    $msg = '删除成功';
                    self::commit();
                }
            }
        } catch (Exception $e) {
            self::rollback();
        }
        return self::dataJson($code, $msg,$fileName,'',true);
    }

    //修改
    public function edit ($data, $fileUrl, $cache) {
        $code = 0;
        $msg = '修改失败';
        $where = [
            ['section_id', 'neq', $data['section_id']],
            ['sectionsort_id', 'eq', $data['sectionsort_id']],
            ['username', 'eq', $data['username']],
        ];
        //查询是否重复的
        $count = self::where($where)->count();
        if ($count > 0) {
            $msg = '当前名称已存在，请修改！';
        } else {
            //查询数据
            $find = self::where('section_id', '=', $data['section_id'])->find();
            if ($find) {// 判断数据是否存在
                // 判断文件是否修改
                if ($data['username'] == $find['username'] && $data['sectionsort_id'] == $find['sectionsort_id']) { // 修改文件
                    $fileSort = self::where('section_id', '=', $data['section_id'])->alias('a')->join('sectionsort b', 'a.sectionsort_id = b.sectionsort_id')->field('a.username, b.username as sort')->find();
                    //修改文件内容
                    $fileName = $fileUrl . $fileSort['sort'] . '/' . $fileSort['username'] . '.html';
                    if (file_exists($fileName)) {
                        $file = fopen($fileName, 'w');
                        if ($file) {
                            if(!empty(is_writable($fileName))){
                                $fileRes = fwrite($file , $data['text']);
                                fclose($file);
                                if ($fileRes) {
                                    $msg = '修改成功';
                                    $code = 1;
                                    $this->cacheUpdate($cache);
                                }
                            }
                        }
                    }
                } else {//新增文件
                    $this->add($data, $cache);
                    $msg = '修改成功';
                    $code = 1;
                }
            }
        }
        return self::dataJson($code, $msg,'','',true);
    }

    /**页面展示
     * @param $data  数据
     * @param $url 文件地址
     * @param $title 文件名称
     * @return string 提示信息
     */
    public function show($data, $url, $title) {
        $msg = '页面不存在';
        $where = [
            ['section_id', 'eq', $data['section_id']],
        ];
        $result = self::where($where)->alias('a')->join('sectionsort b', 'a.sectionsort_id = b.sectionsort_id')->field('a.username as title, b.username as sort')->find();
        $fileUrl = $url. $result['sort'] . '/' . $title;
        if (file_exists($fileUrl)) {
            $file = fopen($fileUrl, 'r');
            if($file) {
                if(!empty(is_writable($fileUrl))) {
                    $content = '';
                    while(!feof($file)) {
                        $content .= fgets($file);
                    }
                    fclose($file);
                    return $content;
                    exit;
                }
            } else {
                $msg = '页面打开错误';
            }
        }
        return $msg;
    }

    //更新缓存
    public function cacheUpdate ($cache) {
        $data = self::select()->order('section_id desc')->toArray();
        $cache::set($this->path['Section'],$data);
        return $data;
    }

    //读取缓存
    public function readCache ($cache) {
        $data = $cache::get($this->path['Section']);
        if(!$data) {
            $data = $this->cacheUpdate($cache);
        }
        return $data;
    }

}