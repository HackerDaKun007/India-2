<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 页面信息
// +----------------------------------------------------------------------
namespace app\home\model;
use think\Model;


class Ht extends Model {
    public function show ($id) {
        $section = new \app\common\model\Section();
        $res = $section::where('section_id', '=', $id)->alias('a')->join('sectionsort b', 'a.sectionsort_id = b.sectionsort_id')->field('a.username, b.username as sort')->find();
        if ($res) {
            return $res;
        }
    }
}