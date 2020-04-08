<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 产品
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class Goods extends Validate {

    protected $rule = [
        'username' => 'require|length:1,150',
        'price' => 'require|float|length:1,11|>:0',
        'home_img' => 'require|length:1,150',
        'orprice' => 'float|length:1,11',
        'freight' => 'float|length:1,11',
        'shelves' => 'require|in:1,2',
        'goods_id' => 'require|number|length:1,11',
    ];

    protected $message = [
        'username' => '产品名称不能为空并且不能大于150字',
        'home_img' => '请上传图片',
        'price' => '请输入价格，并且不能小于0',
        'orprice' => '原价异常',
        'freight' => '运费异常',
        'shelves' => '请选择上下架',
        'goods_id' => '数据异常',
    ];

    protected $scene = [
        'add' => ['username','home_img','price','orprice','freight','shelves'],
        'edit' => ['username','home_img','price','orprice','freight','shelves','goods_id'],
        'editImg' => ['username','price','orprice','freight','shelves','goods_id'],
        'del' => ['goods_id']
    ];

}
?>