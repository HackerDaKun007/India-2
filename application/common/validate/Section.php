<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 页面栏目验证
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class Section extends Validate {

    protected $rule = [
        'username' => 'require|length:1,32|alphaDash',
        'section_id' => 'require|length:1,11|number',
        'sectionsort_id' => 'require|length:1,11|number',
    ];

    protected $message = [
        'username.alphaDash' => '分类名称只能为字母和数字，下划线_及破折号-',
        'username.length' => '分类名称不能大于32字也不能为空',
        'section_id' => 'ID异常',
    ];

    protected $scene = [
        'add' => ['username', 'sectionsort_id'],
        'edit' => ['section_id', 'sectionsort_id', 'v_id'],
        'del' => ['section_id'],
    ];

}

?>