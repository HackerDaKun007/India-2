<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | model公共模块
// +----------------------------------------------------------------------
namespace app\common\model;
use think\Model;
use app\commonConfig\App;
use think\facade\Config;
use think\facade\Cache;
class Common extends Model {
    use App;
    protected  $path;
    protected  $cache;
    protected  $cookie;

    protected $timeUpdate = false;

    public function initialize()
    {
        parent::initialize();
        $config = new Config;
        $this->cache = new Cache();
        $this->path = $config::get('path.');
        $this->autoWriteTimestamp = $this->timeUpdate;
    }


    //写入前操作,删除ID事件，因默认think PHP会有ID事件存在，但是我们定制的系统中不存在有ID，所以不需要ID，防止ID事件被触发，必须在写入之前删除掉
    protected static function init() {
        self::event('before_write', function($user) {
            unset($user['id']);
        });
    }
}

?>