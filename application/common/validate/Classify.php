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
namespace app\common\validate;
use think\Validate;

class Classify extends Validate {

    protected $rule = [
        'username' => 'require|length:1,32',
        'classify_id' => 'require|length:1,11|number',
    ];

    protected $message = [
        'username' => '归类名称不能大于32字也不能为空',
        'classify_id' => 'ID异常',
    ];

    protected $scene = [
        'add' => ['username'],
        'edit' => ['classify_id','classify_id'],
        'del' => ['classify_id'],
    ];

}

?>