<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 货运信息
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class Shippinginfo extends validate {
    protected $rule = [
       'username' => 'require|length:1,32',
    ];
    protected $message = [
        'username' => '标题不能为空并且不能大于32字'
    ];
}

?>