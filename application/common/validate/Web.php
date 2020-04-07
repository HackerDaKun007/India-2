<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 网站设置
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class Web extends Validate {

    protected $rule = [
        'username' => 'length:1,32',
        'seo' => 'length:1,150',
        'seointroduction' => 'length:1,320',
        'logo' => 'length:1,150',
        'ico' => 'length:1,150',
    ];

    protected $message = [
        'username' => '网站名称不能大于32字',
        'seo' => 'seo不能大于150字',
        'seointroduction' => 'seo介绍不能大于320字',
        'logo' => '上传logo图片异常',
        'ico' => '上传网站ico图片异常',
    ];

}

?>