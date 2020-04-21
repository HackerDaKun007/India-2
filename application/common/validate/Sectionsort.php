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

class Sectionsort extends Validate {

    protected $rule = [
        'username' => 'require|length:1,32|alpha',
        'oldname' => 'require|length:1,32|alpha',
        'sectionsort_id' => 'require|length:1,11|number',
        'remark' => 'require|length:1,32',
    ];

    protected $message = [
        'username.require' => '分类名称不能为空',
        'username.alpha' => '分类名称仅限字母',
        'username.length' => '分类名称不能大于32字也不能为空',
        'oldname' => '原来分类名称异常',
        'sectionsort_id' => 'ID异常',
        'remark.require' => '备注信息不能为空',
        'remark.length' => '备注信息不能大于32字',
    ];

    protected $scene = [
        'add' => ['username', 'remark'],
        'edit' => ['username', 'oldname', 'remark', 'sectionsort_id', 'v_id'],
        'del' => ['sectionsort_id'],
    ];

}

?>