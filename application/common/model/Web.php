<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 网站相关设置
// +----------------------------------------------------------------------
namespace app\common\model;
use app\commonConfig\File;
use think\Image;
class Web extends Common {

    use File;

    /**
     * @param $data 修改数据
     * @param $cache 缓存变量
     * @return array|false|string
     */
    public function edit($data,$cache) {
        $id = ['web_id' => 1];
        $msg = '修改失败';
        $code = 0;
        //设置运行写入字段
        $allow = ['username','seo','seointroduction'];
        self::startTrans();
        try {
            if(self::allowField($allow)->isUpdate(true)->save($data,$id)) {
                //判断图片logo是否存在
                if(!empty($data['logo'])) {
                    $runtime = $this->path['runtime'].$data['logo']; //获取缓存图片位置
                    $image = Image::open($runtime);
                    @unlink($this->path['default'].'logo.png');
                    @unlink($runtime);
                   $image->thumb($image->width(),$image->height())->save($this->path['default'].'logo.png');
                }
                //判断图片logo是否存在
                if(!empty($data['ico'])) {
                    $runtime = $this->path['runtime'].$data['ico']; //获取缓存图片位置
                    $image = Image::open($runtime);
                    @unlink($this->path['default'].'favicon.ico');
                    @unlink($runtime);
                    $image->thumb($image->width(),$image->height())->save($this->path['default'].'favicon.ico');
                }
                $this->cacheUpload($cache);
                $code = 1;
                $msg = '修改成功';
                self::commit();
            }
        } catch (Exception $e) {
            $msg = '服务器异常';
        }
        return self::dataJson($code,$msg,'','',true);
    }

    //更新缓存
    protected function cacheUpload($cache) {
        $data = self::where('web_id','=',1)->find();
        $cache::set($this->path['webUpload'],$data);
        return $data;
    }

    //读取缓存
    public function readCache($cache) {
        $data = $cache::get($this->path['webUpload']);
        if(!$data) {
            $data = $this->cacheUpload($cache);
        }
        return $data;
    }

}

?>